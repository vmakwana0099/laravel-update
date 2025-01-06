<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use App\EventCategory;
use App\Events;
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

class EventCategoryController extends PowerpanelController {
		
		public function __construct() {
				parent::__construct();
				if (isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}			
		}
		/**
		 * This method handels load process of eventCategory
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index() {
				$iTotalRecords = CommonModel::getRecordCount();
				$this->breadcrumb['title']=trans('template.eventCategoryModule.manageEventCategory');
				$breadcrumb=$this->breadcrumb;
				return view('powerpanel.event_category.index', compact('iTotalRecords', 'breadcrumb'));
		}
		
		/**
		 * This method loads eventCategory edit view
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
					$this->breadcrumb['title']=trans('template.eventCategoryModule.addEventCategory');
					$this->breadcrumb['module']=trans('template.eventCategoryModule.manageEventCategory');
					$this->breadcrumb['url'] = 'powerpanel/event-category';
					$this->breadcrumb['inner_title']=trans('template.eventCategoryModule.addEventCategory');
					$breadcrumb = $this->breadcrumb;
					$hasRecords = 0;
					$data = compact('total','hasRecords','breadcrumb','categories', 'isParent');
			}else{
				$id = $alias;
				$eventCategory = EventCategory::getRecordById($id);
				if(count($eventCategory)==0){ return redirect()->route('powerpanel.event-category.add'); }
				$hasRecords = Events::getCountById($eventCategory->id);
				$isParent = EventCategory::getCountById($eventCategory->id);
				$categories=Category_builder::Parentcategoryhierarchy($eventCategory->intParentCategoryId,$eventCategory->id);
				$metaInfo = array('varMetaTitle' => $eventCategory->varMetaTitle, 'varMetaKeyword' => $eventCategory->varMetaKeyword, 'varMetaDescription' => $eventCategory->varMetaDescription);
				$this->breadcrumb['title']=trans('template.common.edit') . ' - ' . $eventCategory->varTitle;
				$this->breadcrumb['module']=trans('template.eventCategoryModule.manageEventCategory');
				$this->breadcrumb['url'] = 'powerpanel/event-category';
				$this->breadcrumb['inner_title']=trans('template.common.edit') . ' - ' . $eventCategory->varTitle;
				$breadcrumb = $this->breadcrumb;
				$data = compact('categories','hasRecords', 'isParent','eventCategory', 'metaInfo', 'breadcrumb');
			}
			return view('powerpanel.event_category.actions', $data);
		}
		/**
		 * This method stores eventCategory modifications
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
					'display_order.required' => trans('template.eventCategoryModule.displayOrder'),
					'display_order.greater_than_zero'=> trans('template.eventCategoryModule.displayGreaterThan'),
					//'short_description.required' => 'The short description field is required.',
					'short_description.required' => trans('template.common.shortDescription'),
					'varMetaTitle.required' => trans('template.eventCategoryModule.metaTitle'),
					'varMetaKeyword.required' => trans('template.eventCategoryModule.metaKeyword'),
					'varMetaDescription.required' => trans('template.eventCategoryModule.metaDescription')
					
			   );
				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {
						$id = $request->segment(3);
						$actionMessage = trans('template.common.oppsSomethingWrong');
						if(is_numeric($id)){ #Edit post Handler=======
							  if($data['oldAlias'] != $data['alias']){
									Alias::updateAlias($data['oldAlias'], $data['alias']);	
								}
								
								$eventCategory = EventCategory::getRecordForLogById($id);
								$updateEventCategoryFields =  [
								'varTitle' => trim($data['title']),
								'intParentCategoryId' => $data['parent_category_id'],
								'txtDescription'=>trim($data['description']),
								'txtShortDescription'=>$data['short_description'],
								'varMetaTitle'=>trim($data['varMetaTitle']),
								'varMetaKeyword'=>trim($data['varMetaKeyword']),
								'varMetaDescription'=>trim($data['varMetaDescription']),
								'chrPublish' => $data['chrMenuDisplay'],
								];

								$whereConditions = ['id' => $eventCategory->id];
								$update = CommonModel::updateRecords($whereConditions, $updateEventCategoryFields);
								if ($update) {
										if (!empty($id)) {
												self::swap_order_edit($data['display_order'], $eventCategory->id);
												
												$logArr = MyLibrary::logData($eventCategory->id);
												if (Auth::user()->can('log-advanced')) {
													$newEventsObj = EventCategory::getRecordForLogById($eventCategory->id);
													$oldRec = $this->recordHistory($eventCategory);
													$newRec = $this->recordHistory($newEventsObj);
													$logArr['old_val'] = $oldRec;
													$logArr['new_val'] = $newRec;
												}
												$logArr['varTitle'] = trim($data['title']);
												Log::recordLog($logArr);
												if (Auth::user()->can('recent-updates-list')) {
													if(!isset($newEventsObj)){
														$newEventsObj = EventCategory::getRecordForLogById($eventCategory->id);
													}
													$notificationArr = MyLibrary::notificationData($eventCategory->id, $newEventsObj);
													RecentUpdates::setNotification($notificationArr);
												}
												self::flushCache();
												$actionMessage = trans('template.eventCategoryModule.updateMessage');
										}
								}
						}else{
								$eventCategoryArr = [];
								$eventCategoryArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
								$eventCategoryArr['varTitle'] = trim($data['title']);						
								$eventCategoryArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);						
								$eventCategoryArr['intParentCategoryId'] = $data['parent_category_id'];
								$eventCategoryArr['txtDescription'] = $data['description'];
								$eventCategoryArr['txtShortDescription'] = $data['short_description'];
								$eventCategoryArr['varMetaTitle'] = trim($data['varMetaTitle']);
								$eventCategoryArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
								$eventCategoryArr['varMetaDescription'] = trim($data['varMetaDescription']);
								$eventCategoryArr['chrPublish'] = $data['chrMenuDisplay'];
								$eventCategoryArr['created_at'] = Carbon::now();

								$eventCategoryID = CommonModel::addRecord($eventCategoryArr);						

								if (!empty($eventCategoryID)) {
										$id = $eventCategoryID;
										$newEventsObj = EventCategory::getRecordForLogById($id);

										$logArr = MyLibrary::logData($id);
										$logArr['varTitle'] = $newEventsObj->varTitle;
										Log::recordLog($logArr);
										if (Auth::user()->can('recent-updates-list')) {
											$notificationArr = MyLibrary::notificationData($id, $newEventsObj);
											RecentUpdates::setNotification($notificationArr);
										}
										self::flushCache();
										$actionMessage = trans('template.eventCategoryModule.addedMessage');
								}
						}
						
						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.event-category.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.event-category.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads eventCategory table data on view
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
				$filterArr['eventCategoryFilter'] = !empty(Input::get('eventCategoryFilter')) ? Input::get('eventCategoryFilter') : '';
				$filterArr['personalityFilter'] = !empty(Input::get('personalityFilter')) ? Input::get('personalityFilter') : '';
				$filterArr['paymentFilter'] = !empty(Input::get('paymentFilter')) ? Input::get('paymentFilter') : '';
				$filterArr['rangeFilter'] = !empty(Input::get('rangeFilter')) ? Input::get('rangeFilter') : '';
				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart'] = intval(Input::get('start'));
				$sEcho = intval(Input::get('draw'));
				$arrResults = EventCategory::getRecordList($filterArr);
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
		 * This method delete multiples eventCategory
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
																										$parentCateDetail = EventCategory::getParentCategoryNameBycatId($catIDS);
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
				$hasRecords = Events::getCountById($value->id);
				$isParent = EventCategory::getCountById($value->id);
				$details = '';
				$parent_category_name = ' ';
				$publish_action='';
				$titleData="";
				$details = '<a class="without_bg_icon" href="'.url('powerpanel/events/add?category='.$value->id).'" title="'.trans("template.eventCategoryModule.addEvents").'"><i class="icon-notebook"></i></a>';
				if(Auth::user()->can('event-category-edit')) {
					$details.='<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="'.route('powerpanel.event-category.edit',array('alias' => $value->id)) .'"><i class="fa fa-pencil"></i></a>';
				}
				if(Auth::user()->can('event-category-delete') && $hasRecords==0 && $isParent==0) {
					$details.='&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="event-category" data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
				}

				if(Auth::user()->can('event-category-publish')) 
				{	
					if($hasRecords==0 && $isParent==0){
						if ($value->chrPublish == 'Y') {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/event-category" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
						}else{
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/event-category" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
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
					$parentCategoryName=EventCategory::getParentCategoryNameBycatId($catIDS);	
					$parentCategoryTitle=$parentCategoryName[0]->varTitle;
				 }
				
				$records= array(				
				($hasRecords==0 && $isParent==0)?'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">':$checkbox, 				
				'<a class="without_bg_icon" title="Edit" href="' . route('powerpanel.event-category.edit', array('alias' => $value->id)) . '">' . $value->varTitle. '</a>',
				'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.shortdescription").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
					<div class="highslide-maincontent">'.nl2br($value->txtShortDescription).'</div>
				</div>',
				$parentCategoryTitle,
				($hasRecords>0)?'<a href="'.url('powerpanel/events?category='.$value->id).'">'.trans("template.common.view").'('.$hasRecords.')</a>':'-',
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
			return AddCategoryAjax::Add($data, 'EventCategory');
		}

		public static function flushCache(){
	    Cache::tags(['Events','EventCategory'])->flush();
	  }
}