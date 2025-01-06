<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use App\NewsCategory;
use App\News;
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
use Carbon\Carbon;
use Cache;
use Config;

class NewsCategoryController extends PowerpanelController {
		
		public function __construct() {
				parent::__construct();
				if (isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}			
		}
		/**
		 * This method handels load process of newsCategory
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index() {
				$iTotalRecords = CommonModel::getRecordCount();
				$this->breadcrumb['title']=trans('template.newsCategoryModule.manageNewsCategory');
				$breadcrumb=$this->breadcrumb;
				return view('powerpanel.news_category.index', compact('iTotalRecords', 'breadcrumb'));
		}
		
		/**
		 * This method loads newsCategory edit view
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
					$this->breadcrumb['title']=trans('template.newsCategoryModule.addNewsCategory');
					$this->breadcrumb['module']=trans('template.newsCategoryModule.manageNewsCategory');
					$this->breadcrumb['url'] = 'powerpanel/news-category';
					$this->breadcrumb['inner_title']=trans('template.newsCategoryModule.addNewsCategory');
					$breadcrumb = $this->breadcrumb;
					$hasRecords = 0;
					$data = compact('total','hasRecords','breadcrumb','categories', 'isParent');
			}else{
				$id = $alias;
				$newsCategory = NewsCategory::getRecordById($id);
				if(count($newsCategory)==0){ return redirect()->route('powerpanel.news-category.add'); }
				$hasRecords = News::getCountById($newsCategory->id);
				$isParent = NewsCategory::getCountById($newsCategory->id);
				$categories=Category_builder::Parentcategoryhierarchy($newsCategory->intParentCategoryId,$newsCategory->id);
				$metaInfo = array('varMetaTitle' => $newsCategory->varMetaTitle, 'varMetaKeyword' => $newsCategory->varMetaKeyword, 'varMetaDescription' => $newsCategory->varMetaDescription);
				$this->breadcrumb['title']=trans('template.common.edit') . ' - ' . $newsCategory->varTitle;
				$this->breadcrumb['module']=trans('template.newsCategoryModule.manageNewsCategory');
				$this->breadcrumb['url'] = 'powerpanel/news-category';
				$this->breadcrumb['inner_title']=trans('template.common.edit') . ' - ' . $newsCategory->varTitle;
				$breadcrumb = $this->breadcrumb;
				$data = compact('categories','hasRecords', 'isParent','newsCategory', 'metaInfo', 'breadcrumb');
			}
			return view('powerpanel.news_category.actions', $data);
		}
		/**
		 * This method stores newsCategory modifications
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
					'chrMenuDisplay' => 'required',
					'short_description'  => 'required|max:'.(isset($settings)?$settings->short_desc_length:400),
					/*'varMetaTitle' => 'required|max:160',
					'varMetaKeyword' => 'required|max:160',
					'varMetaDescription' =>  'required|max:160',*/
					'alias'=>'required'
				);
				$messsages = array(
					'display_order.required' => trans('template.newsCategoryModule.displayOrder'),
					'display_order.greater_than_zero'=> trans('template.newsCategoryModule.displayGreaterThan'),
					//'short_description.required' => 'The short description field is required.',
					'short_description.required' => trans('template.common.shortDescription'),
					'varMetaTitle.required' => trans('template.newsCategoryModule.metaTitle'),
					'varMetaKeyword.required' => trans('template.newsCategoryModule.metaKeyword'),
					'varMetaDescription.required' => trans('template.newsCategoryModule.metaDescription')
					
			   );
				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {
						$id = $request->segment(3);
						$actionMessage = trans('template.common.oppsSomethingWrong');
						if(is_numeric($id)){ #Edit post Handler=======
							  if($data['oldAlias'] != $data['alias']){
									Alias::updateAlias($data['oldAlias'], $data['alias']);	
								}
								
								$newsCategory = NewsCategory::getRecordForLogById($id);
								$updateNewsCategoryFields =  [
								'varTitle' => trim($data['title']),
								'intParentCategoryId' => $data['parent_category_id'],
								'txtDescription'=>trim($data['description']),
								'txtShortDescription'=>$data['short_description'],
								'varMetaTitle'=>trim($data['varMetaTitle']),
								'varMetaKeyword'=>trim($data['varMetaKeyword']),
								'varMetaDescription'=>trim($data['varMetaDescription']),
								'chrPublish' => $data['chrMenuDisplay'],
								];

								$whereConditions = ['id' => $newsCategory->id];
								$update = CommonModel::updateRecords($whereConditions, $updateNewsCategoryFields);
								if ($update) {
										if (!empty($id)) {
												self::swap_order_edit($data['display_order'], $newsCategory->id);
												
												$logArr = MyLibrary::logData($newsCategory->id);
												if (Auth::user()->can('log-advanced')) {
													$newNewsObj = NewsCategory::getRecordForLogById($newsCategory->id);
													$oldRec = $this->recordHistory($newsCategory);
													$newRec = $this->recordHistory($newNewsObj);
													$logArr['old_val'] = $oldRec;
													$logArr['new_val'] = $newRec;
												}
												$logArr['varTitle'] = trim($data['title']);
												Log::recordLog($logArr);
												if (Auth::user()->can('recent-updates-list')) {
													if(!isset($newNewsObj)){
														$newNewsObj = NewsCategory::getRecordForLogById($newsCategory->id);
													}
													$notificationArr = MyLibrary::notificationData($newsCategory->id, $newNewsObj);
													RecentUpdates::setNotification($notificationArr);
												}
												self::flushCache();
												$actionMessage = trans('template.newsCategoryModule.updateMessage');
										}
								}
						}else{
								$newsCategoryArr = [];
								$newsCategoryArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
								$newsCategoryArr['varTitle'] = trim($data['title']);						
								$newsCategoryArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);						
								$newsCategoryArr['intParentCategoryId'] = $data['parent_category_id'];
								$newsCategoryArr['txtDescription'] = $data['description'];
								$newsCategoryArr['txtShortDescription'] = $data['short_description'];
								$newsCategoryArr['varMetaTitle'] = trim($data['varMetaTitle']);
								$newsCategoryArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
								$newsCategoryArr['varMetaDescription'] = trim($data['varMetaDescription']);
								$newsCategoryArr['chrPublish'] = $data['chrMenuDisplay'];
								$newsCategoryArr['created_at'] = Carbon::now();

								$newsCategoryID = CommonModel::addRecord($newsCategoryArr);						

								if (!empty($newsCategoryID)) {
										$id = $newsCategoryID;
										$newNewsObj = NewsCategory::getRecordForLogById($id);

										$logArr = MyLibrary::logData($id);
										$logArr['varTitle'] = $newNewsObj->varTitle;
										Log::recordLog($logArr);
										if (Auth::user()->can('recent-updates-list')) {
											$notificationArr = MyLibrary::notificationData($id, $newNewsObj);
											RecentUpdates::setNotification($notificationArr);
										}
										self::flushCache();
										$actionMessage = trans('template.newsCategoryModule.addedMessage');
								}
						}
						
						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.news-category.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.news-category.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads newsCategory table data on view
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
				$filterArr['newsCategoryFilter'] = !empty(Input::get('newsCategoryFilter')) ? Input::get('newsCategoryFilter') : '';
				$filterArr['personalityFilter'] = !empty(Input::get('personalityFilter')) ? Input::get('personalityFilter') : '';
				$filterArr['paymentFilter'] = !empty(Input::get('paymentFilter')) ? Input::get('paymentFilter') : '';
				$filterArr['rangeFilter'] = !empty(Input::get('rangeFilter')) ? Input::get('rangeFilter') : '';
				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart'] = intval(Input::get('start'));
				$sEcho = intval(Input::get('draw'));
				$arrResults = NewsCategory::getRecordList($filterArr);
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
		 * This method delete multiples newsCategory
		 * @return  true/false
		 * @since   2017-07-15
		 * @author  NetQuick
		 */
		public function DeleteRecord(Request $request) {
				$data = $request->all('ids');
				$update = MyLibrary::deleteMultipleRecords($data);
				self::flushCache();
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
			self::flushCache();
		}
		/**
		 * This method handels swapping of available order record while adding
		 * @param   order
		 * @return  order
		 * @since   2016-10-21
		 * @author  NetQuick
		 */
		public static function swap_order_add($order = null) {
				$response = false;
				if ($order != null) {
						$response = MyLibrary::swapOrderAdd($order);
						self::flushCache();
				}
				return $response;
		}
		/**
		 * This method handels swapping of available order record while editing
		 * @param   order
		 * @return  order
		 * @since   2016-12-23
		 * @author  NetQuick
		 */
		public static function swap_order_edit($order = null, $id = null) {
				MyLibrary::swapOrderEdit($order, $id);
				self::flushCache();
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
				self::flushCache();
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
																										$parentCateDetail = NewsCategory::getParentCategoryNameBycatId($catIDS);
																										$parentCateName = $parentCateDetail[0]->varTitle;
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
				$hasRecords = News::getCountById($value->id);
				$isParent = NewsCategory::getCountById($value->id);
				$details = '';
				$parent_category_name = ' ';
				$publish_action='';
				$titleData="";
				$details = '<a class="without_bg_icon" href="'.url('powerpanel/news/add?category='.$value->id).'" title="'.trans("template.newsCategoryModule.addNews").'"><i class="icon-notebook"></i></a>';
				if(Auth::user()->can('news-category-edit')) {
					$details.='<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="'.route('powerpanel.news-category.edit',array('alias' => $value->id)) .'"><i class="fa fa-pencil"></i></a>';
				}
				if(Auth::user()->can('news-category-delete') && $hasRecords==0 && $isParent==0) {
					$details.='&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="news-category" data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
				}

				if(Auth::user()->can('news-category-publish')) 
				{	
					if($hasRecords==0 && $isParent==0){
						if ($value->chrPublish == 'Y') {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/news-category" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
						}else{
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/news-category" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
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
					$parentCategoryName=NewsCategory::getParentCategoryNameBycatId($catIDS);	
					$parentCategoryTitle=$parentCategoryName[0]->varTitle;
				 }
				
				$records= array(				
				($hasRecords==0 && $isParent==0)?'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">':$checkbox, 				
				'<a class="without_bg_icon" title="Edit" href="' . route('powerpanel.news-category.edit', array('alias' => $value->id)) . '">' . $value->varTitle. '</a>',
				'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.shortdescription").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
					<div class="highslide-maincontent">'.nl2br($value->txtShortDescription).'</div>
				</div>',
				$parentCategoryTitle,
				($hasRecords>0)?'<a href="'.url('powerpanel/news?category='.$value->id).'">'.trans("template.common.view").'('.$hasRecords.')</a>':'-',
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
			return AddCategoryAjax::Add($data, 'NewsCategory');
		}

		public static function flushCache(){
	    Cache::tags(['News','NewsCategory'])->flush();
	  }
}