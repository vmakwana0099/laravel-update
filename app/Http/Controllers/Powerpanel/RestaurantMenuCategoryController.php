<?php
/**
* The MenuController class handels blog_category
* configuration  process.
* @package   Netquick powerpanel
* @license   http://www.opensource.org/licenses/BSD-3-Clause
* @version   1.00
* @since   2018-01-09
* @author    NetQuick
*/
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\RestaurantMenuCategory;
use App\RestaurantMenu;
use App\Alias;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Config;
use App\Log;
use App\RecentUpdates;   
use App\CommonModel;
use App\Helpers\AddImageModelRel;
use App\Helpers\MyLibrary;
use Auth;
use App\Helpers\Category_builder;
use App\Helpers\AddCategoryAjax;
use Cache;

class RestaurantMenuCategoryController extends PowerpanelController {
	
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
	/**
	* This method handels load process of blog_category
	* @return  view
	* @since   2018-01-09
	* @author  NetQuick
	*/
	public function index() {
		$iTotalRecords = CommonModel::getRecordCount();
		$this->breadcrumb['title']=trans('template.restaurantMenuCategoryModule.manageRestaurantMenuCategory');
		$breadcrumb=$this->breadcrumb;
		return view('powerpanel.restaurant_menu_category.index',compact('iTotalRecords','breadcrumb'));
	}
	
	/**
	* This method loads blog_category edit view
	* @param   Alias of record
	* @return  View
	* @since   2018-01-09
	* @author  NetQuick
	*/
	public function edit($alias=false) {
		$isParent = 0;
		$imageManager = true;
		$documentManager  = true;
		if(!is_numeric($alias)){
			$total=CommonModel::getRecordCount();
			$total=$total+1;
			$this->breadcrumb['title']=trans('template.restaurantMenuCategoryModule.addRestaurantMenuCategory');
			$this->breadcrumb['inner_title']=trans('template.restaurantMenuCategoryModule.addRestaurantMenuCategory');
			$this->breadcrumb['module']=trans('template.restaurantMenuCategoryModule.manageRestaurantMenuCategory');
			$this->breadcrumb['url']='powerpanel/restaurant-menu-category';
			$breadcrumb=$this->breadcrumb;
			$hasRecords = 0;
			$isParent = 0;
			$metaInfo = array('varMetaTitle' => '', 'varMetaKeyword' => '', 'varMetaDescription' => '');
			$categories=Category_builder::Parentcategoryhierarchy('intParentCategoryId','','','listbox','blog_category');
			$data = compact('total', 'imageManager', 'documentManager','breadcrumb','categories','hasRecords','isParent');
		}else{
			$id = $alias;
			$restaurantMenuCategory = RestaurantMenuCategory::getRecordById($id);
			if(count($restaurantMenuCategory)==0){ return redirect()->route('powerpanel.restaurant-menu-category.add'); }
			$this->breadcrumb['title']=trans('template.common.edit').' - '.$restaurantMenuCategory->varTitle;
			$this->breadcrumb['inner_title']=trans('template.common.edit').' - '.$restaurantMenuCategory->varTitle;
			$this->breadcrumb['module']=trans('template.restaurantMenuCategoryModule.manageRestaurantMenuCategory');
			$this->breadcrumb['url']='powerpanel/restaurant-menu-category';
			$breadcrumb=$this->breadcrumb;
			$hasRecords = RestaurantMenu::getCountById($restaurantMenuCategory->id);
			$isParent = RestaurantMenuCategory::getCountById($restaurantMenuCategory->id);
			$metaInfo = array('varMetaTitle' => $restaurantMenuCategory->varMetaTitle, 'varMetaKeyword' => $restaurantMenuCategory->varMetaKeyword, 'varMetaDescription' => $restaurantMenuCategory->varMetaDescription);
			$categories=Category_builder::Parentcategoryhierarchy($restaurantMenuCategory->intParentCategoryId,$id);
			$alias = $restaurantMenuCategory->alias->varAlias;
			$data = compact('metaInfo', 'imageManager', 'documentManager','restaurantMenuCategory','hasRecords','isParent','alias','breadcrumb','categories');
		}
		return view('powerpanel.restaurant_menu_category.actions',$data);
	}
	/**
	* This method stores blog_category modifications
	* @return  View
	* @since   2018-01-09
	* @author  NetQuick
	*/

	public function handlePost(Request $request) {
		$data = Input::get();
		$settings = json_decode(Config::get("Constant.MODULE.SETTINGS"));
		$rules = array(
			'title' => 'required|max:160',
			'order' => 'required|greater_than_zero',			
			'alias'=>'required',
			'short_description'  => 'required|max:400',
			/*'varMetaTitle' => 'required|max:160',
			'varMetaKeyword' => 'required|max:160',
			'varMetaDescription' =>  'required|max:160'*/
		);
		$messsages = array(
			'order.required' => trans('template.restaurantMenuCategoryModule.displayOrder'),
			'order.greater_than_zero' => trans('template.restaurantMenuCategoryModule.displayGreaterThan'),
			'varMetaTitle.required' => trans('template.restaurantMenuCategoryModule.metaTitle'),
			'varMetaKeyword.required' => trans('template.restaurantMenuCategoryModule.metaKeyword'),
			'varMetaDescription.required' => trans('template.restaurantMenuCategoryModule.metaDescription')
		);
		$validator = Validator::make($data, $rules, $messsages);
		if($validator->passes()){
			$id = $request->segment(3);
			$actionMessage = trans('template.common.oppsSomethingWrong');
			if(is_numeric($id)){ #Edit post Handler======= 

					if($data['oldAlias'] != $data['alias']){
						Alias::updateAlias($data['oldAlias'], $data['alias']);	
					}
					$restaurantMenuCategory = RestaurantMenuCategory::getRecordForLogById($id);
					$updateRestaurantMenuCategoryFields =  [
							'varTitle' => trim($data['title']),
							'intParentCategoryId' => $data['parent_category_id'],					
							'chrPublish' => isset($data['chrMenuDisplay'])?$data['chrMenuDisplay']:'Y',
							'txtDescription'=>$data['description'],
							'txtShortDescription'=>$data['short_description'],
							'varMetaTitle'=>$data['varMetaTitle'],
							'varMetaKeyword'=>$data['varMetaKeyword'],
							'varMetaDescription'=>$data['varMetaDescription']
						];		
					
					$updateRestaurantMenuCategoryFields['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
					$updateRestaurantMenuCategoryFields['fkIntDocId'] = !empty($data['doc_id'])?$data['doc_id']:null;

					$whereConditions = ['id' => $restaurantMenuCategory->id];
					$update = CommonModel::updateRecords($whereConditions, $updateRestaurantMenuCategoryFields);
					if ($update) {
							if (!empty($id)) {							
									self::swap_order_edit($data['order'],$restaurantMenuCategory->id);
									

									$logArr = MyLibrary::logData($restaurantMenuCategory->id);
									if (Auth::user()->can('log-advanced')) {
										$newRestaurantMenuCategoryObj = RestaurantMenuCategory::getRecordForLogById($restaurantMenuCategory->id);
										$oldRec = $this->recordHistory($restaurantMenuCategory);
										$newRec = $this->recordHistory($newRestaurantMenuCategoryObj);
										$logArr['old_val'] = $oldRec;
										$logArr['new_val'] = $newRec;
									}

									$logArr['varTitle'] = trim($data['title']);
									Log::recordLog($logArr);
									if (Auth::user()->can('recent-updates-list')) {
										if(!isset($newRestaurantMenuCategoryObj)){
											$newRestaurantMenuCategoryObj = RestaurantMenuCategory::getRecordForLogById($restaurantMenuCategory->id);
										}
										$notificationArr = MyLibrary::notificationData($restaurantMenuCategory->id, $newRestaurantMenuCategoryObj);
										RecentUpdates::setNotification($notificationArr);
									}
							}
							Self::flushCache();
							$actionMessage = trans('template.restaurantMenuCategoryModule.updateMessage');

					}
					
				}else{
					$restaurantMenuCategoryArr = [];
					$restaurantMenuCategoryArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
					$restaurantMenuCategoryArr['varTitle'] = trim($data['title']);
					$restaurantMenuCategoryArr['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
					$restaurantMenuCategoryArr['fkIntDocId'] = !empty($data['doc_id'])?$data['doc_id']:null;
					$restaurantMenuCategoryArr['intParentCategoryId'] =isset($data['parent_category_id'])?$data['parent_category_id']:1;		
					$restaurantMenuCategoryArr['intDisplayOrder'] = self::swap_order_add($data['order']);
					$restaurantMenuCategoryArr['chrPublish'] = $data['chrMenuDisplay'];
					$restaurantMenuCategoryArr['txtDescription'] = $data['description'];
					$restaurantMenuCategoryArr['txtShortDescription'] = $data['short_description'];
					$restaurantMenuCategoryArr['varMetaTitle'] = $data['varMetaTitle'];
					$restaurantMenuCategoryArr['varMetaKeyword'] = $data['varMetaKeyword'];
					$restaurantMenuCategoryArr['varMetaDescription'] = $data['varMetaDescription'];
					$restaurantMenuCategoryArr['created_at'] = Carbon::now();	
					
					$restaurantMenuCategoryID = CommonModel::addRecord($restaurantMenuCategoryArr);

					if (!empty($restaurantMenuCategoryID)) {
						$id = $restaurantMenuCategoryID;
						$newRestaurantMenuCategoryObj = RestaurantMenuCategory::getRecordForLogById($id);
						$logArr = MyLibrary::logData($id);
						$logArr['varTitle'] = $newRestaurantMenuCategoryObj->varTitle;
						Log::recordLog($logArr);
						
						if (Auth::user()->can('recent-updates-list')) {
							$notificationArr = MyLibrary::notificationData($id, $newRestaurantMenuCategoryObj);
							RecentUpdates::setNotification($notificationArr);
						}
						$actionMessage = trans('template.restaurantMenuCategoryModule.addedMessage');
					}
					
					Self::flushCache();
				}
				AddImageModelRel::sync(explode(',', $data['img_id']), $id);
				if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
						return redirect()->route('powerpanel.restaurant-menu-category.index')->with('message', $actionMessage);
				} else {
						return redirect()->route('powerpanel.restaurant-menu-category.edit', $id)->with('message', $actionMessage);
				}

		}else {
					return Redirect::back()->withErrors($validator)->withInput();
			}
				
	}
	/**
	* This method loads blog_category table data on view
	* @return  View
	* @since   2018-01-09
	* @author  NetQuick
	*/

	public function get_list() {
			 $filterArr = [];
			 $records = [];
			 $records["data"] = [];
			 $filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');

			 $filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
			 
			 $filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
			 $filterArr['statusFilter'] = !empty(Input::get('statusValue')) ? Input::get('statusValue') : '';

			 $filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
			
			 $filterArr['iDisplayLength'] = intval(Input::get('length'));
			 $filterArr['iDisplayStart'] = intval(Input::get('start'));
			
			 $sEcho = intval(Input::get('draw'));
			 $arrResults = RestaurantMenuCategory::getRecordList($filterArr);
			
			 // $children = RestaurantMenuCategory::where('id', '<>', $product1->id)->
		 //       where('intParentCategoryId', $product1->intParentCategoryId)->
		 //       get();

			 

			 // $total=RestaurantMenuCategory::getRecords()->deleted()->get();
			 // $parent   = $total->parent()->first();
			 // $children =$total->children()->get();

			 $iTotalRecords =  count($arrResults);

			 $end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
			 $end = $end > $iTotalRecords ? $iTotalRecords : $end;
			 if (!empty($arrResults)) {
					foreach ($arrResults as $key => $value) {
							$records["data"][] = $this->tableData($value);
					}
											

			}
			$records["customActionStatus"] = "OK";
			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			return json_encode($records);
		}

	public function publish(Request $request) {
				$alias = Input::get('alias');
				$update = MyLibrary::setPublishUnpublish($alias, $request);
				Self::flushCache();
				echo json_encode($update);
				exit;
		}

	 /**
	* This method reorders banner position
	* @return  Banner index view data
	* @since   2018-01-09
	* @author  NetQuick
	*/
	public function reorder() {
		$order=Input::get('order');
		$exOrder=Input::get('exOrder');
		MyLibrary::swapOrder($order, $exOrder);
		Self::flushCache();
	}
	

	/**
		 * This method delete multiples Team
		 * @return  true/false
		 * @since   2018-01-09
		 * @author  NetQuick
		 */
	public function DeleteRecord(Request $request) {
			$data = $request->all('ids');
			$update = MyLibrary::deleteMultipleRecords($data);
			Self::flushCache();
			echo json_encode($update);
			exit;
	}

	/**
	 * This method handels swapping of available order record while adding
	 * @param   order
	 * @return  order
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	public static function swap_order_add($order = null) {
			$response = false;
			if ($order != null) {
					$response = MyLibrary::swapOrderAdd($order);
					Self::flushCache();
			}
			return $response;
	}
	
		/**
	 * This method handels swapping of available order record while editing
	 * @param  	order
	 * @return  order
	 * @since   2018-01-09
	 * @author  NetQuick
	*/
	public static function swap_order_edit($order=null,$id=null){	
		MyLibrary::swapOrderEdit($order, $id);
		Self::flushCache();
	}

	/**
		* This method handels logs History records
		* @param   $data
		* @return  HTML
		* @since   2018-01-09
		* @author  NetQuick
		*/

	public function recordHistory($data=false) 
		{
			$returnHtml = '';
			$returnHtml.= '<table class="new_table_desing table table-striped table-bordered table-hover">
			<thead>
					<tr>
						<th>'.trans("template.common.title").'</th>
						<th>'.trans("template.common.parentCategory").'</th>
						<th>'.trans("template.common.shortDescription").'</th>
						<th>'.trans("template.common.description").'</th>
						<th>'.trans("template.common.displayorder").'</th>
						<th>'.trans("template.common.metatitle").'</th>
						<th>'.trans("template.common.metakeyword").'</th>
						<th>'.trans("template.common.metadescription").'</th>
						<th>'.trans("template.common.publish").'</th>
					</tr>
			</thead>
			<tbody>
					<tr>
							<td>' . $data->varTitle . '</td>';
							if($data->intParentCategoryId > 0){
								$catIDS[] = $data->intParentCategoryId;
								$parentCateName = RestaurantMenuCategory::getParentCategoryNameBycatId($catIDS);
								$parentCateName = $parentCateName[0]->varTitle;
								$returnHtml.='<td>'.$parentCateName.'</td>';
							}else{
								$returnHtml.='<td>-</td>';
							}
							
							$returnHtml.='<td>' . $data->txtShortDescription . '</td>
							<td>' . $data->txtDescription . '</td>
							<td>' . ($data->intDisplayOrder) . '</td>
							<td>' . $data->varMetaTitle . '</td>
							<td>' . $data->varMetaKeyword . '</td>
							<td>' . $data->varMetaDescription . '</td>
							<td>' . $data->chrPublish .'</td>
					</tr>
			</tbody>
			</table>';
			return $returnHtml;			
		}
	
	public function tableData($value = false) {				
				$hasRecords = RestaurantMenu::getCountById($value->id);
				$isParent = RestaurantMenuCategory::getCountById($value->id);
				$details = '';
				$parent_category_name = ' ';
				$publish_action='';
				$titleData="";
				$details = '<a class="without_bg_icon" href="'.url('powerpanel/restaurant-menu/add?category='.$value->id).'" title="'.trans("template.restaurantMenuCategoryModule.addRestaurantMenu").'"><i class="icon-notebook"></i></a>';
				if(Auth::user()->can('restaurant-menu-category-edit')) {
					$details.='<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="'.route('powerpanel.restaurant-menu-category.edit',array('alias' => $value->id)) .'"><i class="fa fa-pencil"></i></a>';
				}
				if(Auth::user()->can('restaurant-menu-category-delete') && $hasRecords==0 && $isParent==0) {
					$details.='&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="restaurant-menu-category" data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
				}

				if(Auth::user()->can('restaurant-menu-category-publish')) 
				{	
					if($hasRecords==0 && $isParent==0){
						if ($value->chrPublish == 'Y') {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/restaurant-menu-category" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
						}else{
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/restaurant-menu-category" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
						}
					}else{
	          $publish_action = '-';
	        }
				}

				if($hasRecords > 0){
					$titleData = 'This category is selected in '.$hasRecords.' record(s) so it can&#39;t be deleted or unpublished.';
				}

				if($isParent > 0){				
					$titleData = 'This category is selected as Parent Category in '.$isParent.' record(s) so it can&#39;t be deleted or unpublished.';
				}
				$checkbox = '<a href="javascript:;" data-toggle="tooltip" data-placement="right" data-toggle="tooltip" data-original-title="'.$titleData.'" title="'.$titleData.'"><i style="color:red" class="fa fa-exclamation-triangle"></i></a>';

				$parentCategoryTitle='-';
				if (!empty($value->intParentCategoryId) && $value->intParentCategoryId > 0) {				
					$catIDS[] = $value->intParentCategoryId;	
					$parentCategoryName=RestaurantMenuCategory::getParentCategoryNameBycatId($catIDS);	
					$parentCategoryTitle=$parentCategoryName[0]->varTitle;
				 }
				
				$records= array(				
				($hasRecords==0 && $isParent==0)?'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">':$checkbox, 				
				'<a class="without_bg_icon" title="Edit" href="' . route('powerpanel.restaurant-menu-category.edit', array('alias' => $value->id)) . '">' . $value->varTitle. '</a>',
				'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.shortdescription").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
					<div class="highslide-maincontent">'.nl2br($value->txtShortDescription).'</div>
				</div>',
				$parentCategoryTitle,
				($hasRecords>0)?'<a href="'.url('powerpanel/restaurant-menu?category='.$value->id).'">'.trans("template.common.view").'('.$hasRecords.')</a>':'-',
				'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				'.$value->intDisplayOrder.
				' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
				$publish_action,
				$details,
				$value->intDisplayOrder,
			);			
		return $records;
	}

	public function addCatAjax(){
		$data = Input::get();		
		return AddCategoryAjax::Add($data, 'RestaurantMenuCategory');
	}

	public static function flushCache(){			
		Cache::tags(['RestaurantMenuCategory','RestaurantMenu'])->flush();						
	}
}