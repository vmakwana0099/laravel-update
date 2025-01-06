<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\SponsorCategory;
use App\Sponsor;
use App\Alias;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Log;
use App\RecentUpdates;
use App\CommonModel;
use App\Helpers\MyLibrary;
use App\Helpers\Category_builder;
use App\Helpers\AddCategoryAjax;
use Auth;
use Cache;
use Config;

class SponsorCategoryController extends PowerpanelController {
		
		public function __construct() {
				parent::__construct();
				if (isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}     
		}
		/**
		 * This method handels load process of sposnorCategory
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index() {
				$iTotalRecords = CommonModel::getRecordCount();
				$this->breadcrumb['title']=trans('template.sponsorCategoryModule.manageSponsorCategory');
				$breadcrumb = $this->breadcrumb;
				return view('powerpanel.sponsor_category.index', compact('iTotalRecords', 'breadcrumb'));
		}
		
		/**
		 * This method stores sposnorCategory modifications
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function handlePost(Request $request) {
				$data = Input::get();
				$settings = json_decode(Config::get("Constant.MODULE.SETTINGS"));
				$rules = array(
					'title' => 'required|max:160',
					'display_order' => 'required|greater_than_zero',
					'short_description'  => 'required|max:'.(isset($settings)?$settings->short_desc_length:400),
					/*'varMetaTitle' => 'required|max:160',
					'varMetaKeyword' => 'required|max:160',
					'varMetaDescription' =>  'required|max:160',*/
					'alias'=>'required'
				);
				$messsages = array(
					'display_order.required' => trans('template.sponsorCategoryModule.displayOrder'),
					'display_order.greater_than_zero'=> trans('template.sponsorCategoryModule.displayGreaterThan'),
					'short_description.required' => trans('template.sponsorCategoryModule.shortDescription'),
					'varMetaTitle.required' => trans('template.sponsorCategoryModule.metaTitle'),
					'varMetaKeyword.required' => trans('template.sponsorCategoryModule.metaKeyword'),
					'varMetaDescription.required' => trans('template.sponsorCategoryModule.metaDescription')
					
				 );
				
				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {
					$id = $request->segment(3);
					$actionMessage = trans('template.common.oppsSomethingWrong');
					if(is_numeric($id)){ #Edit post Handler=======
						if($data['oldAlias'] != $data['alias']){
							Alias::updateAlias($data['oldAlias'], $data['alias']);  
						}
						$sponsorCategory = SponsorCategory::getRecordForLogById($id);
						$updateSponsorCategoryFields =  [
						'varTitle' => trim($data['title']),
						'intParentCategoryId' => $data['parent_category_id'],
						'chrPublish' => isset($data['chrMenuDisplay'])?$data['chrMenuDisplay']:'Y',
						'txtDescription'=>$data['description'],
						'txtShortDescription'=>trim($data['short_description']),
						'varMetaTitle'=>trim($data['varMetaTitle']),
						'varMetaKeyword'=>trim($data['varMetaKeyword']),
						'varMetaDescription'=>trim($data['varMetaDescription'])
						];

						$whereConditions = ['id' => $sponsorCategory->id];
						$update = CommonModel::updateRecords($whereConditions, $updateSponsorCategoryFields);
						if ($update) {
								if (!empty($id)) {                    
										MyLibrary::swapOrderEdit($data['display_order'], $sponsorCategory->id);
										

										$logArr = MyLibrary::logData($sponsorCategory->id);
										if (Auth::user()->can('log-advanced')) {
											$newSponsorObj = SponsorCategory::getRecordForLogById($sponsorCategory->id);
											$oldRec = $this->recordHistory($sponsorCategory);
											$newRec = $this->recordHistory($newSponsorObj);
											$logArr['old_val'] = $oldRec;
											$logArr['new_val'] = $newRec;
										}
										$logArr['varTitle'] = trim($data['title']);
										Log::recordLog($logArr);
										if (Auth::user()->can('recent-updates-list')) {
											if(!isset($newSponsorObj)){
												$newSponsorObj = SponsorCategory::getRecordForLogById($sponsorCategory->id);
											}
											$notificationArr = MyLibrary::notificationData($sponsorCategory->id, $newSponsorObj);
											RecentUpdates::setNotification($notificationArr);
										}
										$actionMessage = trans('template.sponsorCategoryModule.successMessage');
								}
								
						}
						
					}else{ #Add post Handler=======
						$sponsorCategoryArr = [];
						$sponsorCategoryArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
						$sponsorCategoryArr['varTitle'] = trim($data['title']);           
						$sponsorCategoryArr['intDisplayOrder'] = MyLibrary::swapOrderAdd($data['display_order']);
						$sponsorCategoryArr['intParentCategoryId'] = $data['parent_category_id'];
						$sponsorCategoryArr['txtDescription'] = $data['description'];
						$sponsorCategoryArr['txtShortDescription'] = trim($data['short_description']);
						$sponsorCategoryArr['varMetaTitle'] = trim($data['varMetaTitle']);
						$sponsorCategoryArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
						$sponsorCategoryArr['varMetaDescription'] = trim($data['varMetaDescription']);
						$sponsorCategoryArr['chrPublish'] = $data['chrMenuDisplay'];
						$sponsorCategoryArr['created_at'] = Carbon::now();

						$sponsorCategoryID = CommonModel::addRecord($sponsorCategoryArr);           

						if (!empty($sponsorCategoryID)) 
						{
								$id = $sponsorCategoryID;
								$newSponsorObj = SponsorCategory::getRecordForLogById($id);

								$logArr = MyLibrary::logData($id);
								$logArr['varTitle'] = $newSponsorObj->varTitle;
								Log::recordLog($logArr);
								
								if (Auth::user()->can('recent-updates-list')) {
									$notificationArr = MyLibrary::notificationData($id, $newSponsorObj);
									RecentUpdates::setNotification($notificationArr);
								}
								$actionMessage = trans('template.sponsorCategoryModule.addedMessage');
						}
						
					}

					$this->flushCache();

					if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
							return redirect()->route('powerpanel.sponsor-category.index')->with('message', $actionMessage);
					} else {
							return redirect()->route('powerpanel.sponsor-category.edit', $id)->with('message', $actionMessage);
					}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads sponsorCategory table data on view
		 * @return  View
		 * @since   2017-11-10
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
				$filterArr['sponsorCategoryFilter'] = !empty(Input::get('sponsorCategoryFilter')) ? Input::get('sponsorCategoryFilter') : '';
				$filterArr['personalityFilter'] = !empty(Input::get('personalityFilter')) ? Input::get('personalityFilter') : '';
				$filterArr['paymentFilter'] = !empty(Input::get('paymentFilter')) ? Input::get('paymentFilter') : '';
				$filterArr['rangeFilter'] = !empty(Input::get('rangeFilter')) ? Input::get('rangeFilter') : '';
				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart'] = intval(Input::get('start'));
				$sEcho = intval(Input::get('draw'));
				$arrResults = SponsorCategory::getRecordList($filterArr);
				$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
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
		/**
		 * This method delete multiples sponsorCategory
		 * @return  true/false
		 * @since   2017-07-15
		 * @author  NetQuick
		 */
		public function DeleteRecord(Request $request) {
				$data = $request->all('ids');
				$update = MyLibrary::deleteMultipleRecords($data);
				$this->flushCache();
				echo json_encode($update);
				exit;
		}
	/**
		* This method reorders banner position
		* @return  Banner index view data
		* @since   2016-10-26
		* @author  NetQuick
		*/
		public function reorder() {
			$order=Input::get('order');
			$exOrder=Input::get('exOrder');
			MyLibrary::swapOrder($order, $exOrder);
			$this->flushCache();
		}
		/**
		* This method destroys Banner in multiples
		* @return  Banner index view
		* @since   2016-10-25
		* @author  NetQuick
		*/
		public function publish(Request $request) {
				$alias = Input::get('alias');
				$update = MyLibrary::setPublishUnpublish($alias, $request);
				$this->flushCache();
				echo json_encode($update);
				exit;
		}
		/**
		* This method handels logs History records
		* @param   $data
		* @return  HTML
		* @since   2017-07-21
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
																											$parentCateName = SponsorCategory::getParentCategoryNameBycatId($catIDS);
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
				$hasRecords = Sponsor::getCountById($value->id);
				$isParent = SponsorCategory::getCountById($value->id);
				$details = '';
				$parent_category_name = ' ';
				$publish_action='';
				$titleData="";
				$details = '<a class="without_bg_icon" href="'.url('powerpanel/sponsor/add?category='.$value->id).'" title="'.trans("template.sponsorCategoryModule.addBlogs").'"><i class="icon-notebook"></i></a>';
				if(Auth::user()->can('sponsor-category-edit')) {
					$details.='<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="'.route('powerpanel.sponsor-category.edit',array('alias' => $value->id)) .'"><i class="fa fa-pencil"></i></a>';
				}
				if(Auth::user()->can('sponsor-category-delete') && $hasRecords==0 && $isParent==0) {
					$details.='&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="sponsor-category" data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
				}

				if(Auth::user()->can('sponsor-category-publish')) 
				{	
					if($hasRecords==0 && $isParent==0){
						if ($value->chrPublish == 'Y') {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/sponsor-category" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
						}else{
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/sponsor-category" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
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
					$parentCategoryName=SponsorCategory::getParentCategoryNameBycatId($catIDS);	
					$parentCategoryTitle=$parentCategoryName[0]->varTitle;
				 }
				
				$records= array(				
				($hasRecords==0 && $isParent==0)?'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">':$checkbox, 				
				'<a class="without_bg_icon" title="Edit" href="' . route('powerpanel.sponsor-category.edit', array('alias' => $value->id)) . '">' . $value->varTitle. '</a>',
				'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.shortdescription").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
					<div class="highslide-maincontent">'.nl2br($value->txtShortDescription).'</div>
				</div>',
				$parentCategoryTitle,
				($hasRecords>0)?'<a href="'.url('powerpanel/sponsor?category='.$value->id).'">'.trans("template.common.view").'('.$hasRecords.')</a>':'-',
				'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				'.$value->intDisplayOrder.
				' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
				$publish_action,
				$details,
				$value->intDisplayOrder,
			);			
		return $records;
	}


	/**
		 * This method loads sponsorCategory edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($alias=false) {
			$isParent = 0;
			if(!is_numeric($alias)){
				$categories=Category_builder::Parentcategoryhierarchy();
				$total = CommonModel::getRecordCount();
				$total = $total + 1;
				$this->breadcrumb['title']=trans('template.sponsorCategoryModule.addSponsorCategory');    
				$this->breadcrumb['module']=trans('template.sponsorCategoryModule.manageSponsorCategory');
				$this->breadcrumb['url'] = 'powerpanel/sponsor-category';
				$this->breadcrumb['inner_title']=trans('template.sponsorCategoryModule.addSponsorCategory');
				$breadcrumb = $this->breadcrumb;
				$hasRecords = 0;
				$data = compact('total', 'breadcrumb','categories','hasRecords', 'isParent');
			}else{
				$id = $alias;
				$sponsorCategory = SponsorCategory::getRecordById($id);
				if(count($sponsorCategory)==0){ return redirect()->route('powerpanel.sponsor-category.add'); }
				$hasRecords = Sponsor::getCountById($sponsorCategory->id);
				$isParent = SponsorCategory::getCountById($sponsorCategory->id);
				$categories=Category_builder::Parentcategoryhierarchy($sponsorCategory->intParentCategoryId,$sponsorCategory->id);
				$metaInfo = array('varMetaTitle' => $sponsorCategory->varMetaTitle, 'varMetaKeyword' => $sponsorCategory->varMetaKeyword, 'varMetaDescription' => $sponsorCategory->varMetaDescription);
				$this->breadcrumb['title']=trans('template.common.edit') . ' - ' . $sponsorCategory->varTitle;
				$this->breadcrumb['module']=trans('template.sponsorCategoryModule.manageSponsorCategory');
				$this->breadcrumb['url'] = 'powerpanel/sponsor-category';
				$this->breadcrumb['inner_title']=trans('template.common.edit') . ' - ' . $sponsorCategory->varTitle;
				$breadcrumb = $this->breadcrumb;
				$data = compact('categories','hasRecords', 'isParent','sponsorCategory', 'metaInfo', 'breadcrumb');
			}
			return view('powerpanel.sponsor_category.actions', $data);
		}

	/**
	* This method handels loading process of generating html menu from array data
	* @return  Html menu
	* @param  parentId, parentUrl, menu_array
	* @since   04-08-2017
	* @author  NetQuick
	*/
	public function getChildren($CatId=false) {   
		$serCats=SponsorCategory::where('intParentCategoryId',$CatId)->get();   
		$response=false;    
		$html = '';
		foreach ($serCats as $serCat) {
			if (isset($serCat->intParentCategoryId)) {      
				$html  = '<ul class="dd-list menu_list_set">';
					$html .= '<li class="dd-item">';
						$html .= $serCat->varTitle;
						$html .= $this->getChildren($serCat->id);           
					$html .= '</li>';
				$html .= '</ul>';
			}
		}
		$response=$html;
		return $response;
	}

	public function addCatAjax(){
		$data = Input::get();		
		return AddCategoryAjax::Add($data, 'SponsorCategory');
	}

	public static function flushCache(){
		Cache::tags('SponsorCategory')->flush();
	} 
}