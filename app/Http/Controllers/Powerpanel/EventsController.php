<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use App\Events;
use App\Alias;
use App\EventCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use App\Log;
use App\RecentUpdates;
use App\CommonModel;
use App\Helpers\MyLibrary;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;
use Auth;
use Config;
use Carbon\Carbon;
use App\Helpers\resize_image;
use App\Helpers\AddImageModelRel;
use App\Helpers\AddVideoModelRel;
use Cache;

class EventsController extends PowerpanelController {
		
		public function __construct() {
				parent::__construct();
				if (isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}
		}
		/**
		 * This method handels load process of events
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index() {
				$iTotalRecords = CommonModel::getRecordCount();
				$EventCategory = $iTotalRecords>0 ? EventCategory::getCatWithParent():null;
				$this->breadcrumb['title'] = trans('template.eventModule.manageEvents');
				$breadcrumb = $this->breadcrumb;
				return view('powerpanel.events.index', compact('iTotalRecords', 'breadcrumb','EventCategory'));
		}

		/**
		 * This method loads events edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($id=false) 
		{	
			$category = EventCategory::getCatWithParent();
			$category = CategoryArrayBuilder::getArray($category);
			$EventCategory = json_encode($category);

			$categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false,false,'\App\EventCategory');			
			$imageManager = true;
			$videoManager  = true;
			if(!is_numeric($id))
			{
				$total = CommonModel::getRecordCount();
				$total = $total + 1;
				$this->breadcrumb['title'] = trans('template.eventModule.addEvent');
				$this->breadcrumb['module'] = trans('template.eventModule.manageEvents');
				$this->breadcrumb['url'] = 'powerpanel/events';
				$this->breadcrumb['inner_title'] = trans('template.eventModule.addEvent');
				$breadcrumb = $this->breadcrumb;
				$data=compact('total', 'EventCategory', 'breadcrumb','imageManager','videoManager','categoryHeirarchy');
			}else{				
				$event = Events::getRecordById($id);
				if(count($event)==0){ return redirect()->route('powerpanel.events.add'); }
				$metaInfo = array('varMetaTitle' => $event->varMetaTitle, 'varMetaKeyword' => $event->varMetaKeyword, 'varMetaDescription' => $event->varMetaDescription);
				$this->breadcrumb['title'] = trans('template.eventModule.editEvent') . ' - ' . $event->varTitle;
				$this->breadcrumb['module'] = trans('template.eventModule.manageEvents');
				$this->breadcrumb['url'] = 'powerpanel/events';
				$this->breadcrumb['inner_title'] = trans('template.eventModule.editEvent') . ' - ' . $event->varTitle;
				$breadcrumb = $this->breadcrumb;
				$data=compact('event', 'EventCategory', 'metaInfo', 'breadcrumb','imageManager','videoManager','categoryHeirarchy');
			}			
			return view('powerpanel.events.actions', $data);				
		}

		/**
		 * This method stores events modifications
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function handlePost(Request $request) {
				$data = Input::get();
				$actionMessage = trans('template.common.oppsSomethingWrong');

				$rules = array(
						'title' => 'required|max:160', 
						'start_date_time' => 'required',
						'display_order' => 'required|greater_than_zero', 
						'varMetaTitle' => 'required|max:160', 
						'varMetaKeyword' => 'required|max:160', 
						'varMetaDescription' => 'required|max:160',
						'event_days' => 'required',
				);
				
				if($data['event_pricing_type'] == "Paid"){
						$rules['adult_price'] = 'numeric|min:0';
						$rules['child_price'] = 'numeric|min:0';	
				}

				$messsages = array('display_order.greater_than_zero' => trans('template.eventModule.displayGreaterThan'), 'start_date_time.date_format' => trans('template.eventModule.startDateErrorMessage'),
				 'end_date_time.date_format' => trans('template.eventModule.endDateErrorMessage'),
					'event_days.required' => trans('template.eventModule.eventDaysErrorMessage'),
					'adult_price.numeric' => trans('template.eventModule.adultPriceNumerisErrorMessage'),
					'child_price.numeric' => trans('template.eventModule.childPriceNumerisErrorMessage'),
				);

				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {

						$event_days = implode(',',$data['event_days']);

						$eventArr['varTitle'] = trim($data['title']); 
						$eventArr['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
						$eventArr['fkIntVideoId'] = !empty($data['video_id']) ? $data['video_id'] : null; 
						$eventArr['dtStartDateTime'] = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data['start_date_time']))); 
						$eventArr['dtEndDateTime'] = !empty($data['end_date_time'])?date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data['end_date_time']))):null;
						$eventArr['txtDescription'] = $data['description']; 
						$eventArr['txtCategories'] = isset($data['category_id'])?serialize($data['category_id']):null;
						$eventArr['varLatitude'] = !empty($data['lattitude'])?trim($data['lattitude']):''; 
						$eventArr['varLongitude'] = !empty($data['longitude'])?trim($data['longitude']):'';
						$eventArr['txtAddress'] = !empty($data['address'])?trim($data['address']):'';
						$eventArr['varMetaTitle'] = trim($data['varMetaTitle']); 
						$eventArr['varMetaKeyword'] = trim($data['varMetaKeyword']); 
						$eventArr['varMetaDescription'] = trim($data['varMetaDescription']); 
						$eventArr['chrPublish'] = $data['chrMenuDisplay'];

						if($data['adult_price'] > 0 || $data['child_price'] > 0)
							$eventArr['varEventPriceType'] = 'Paid';
						else
							$eventArr['varEventPriceType'] = 'Free';

						$eventArr['fltAdultPrice'] = ($data['event_pricing_type']=="Paid")?$data['adult_price']:0;
						$eventArr['fltChildPrice'] = ($data['event_pricing_type']=="Paid")?$data['child_price']:0;

						$eventArr['varEventDays'] =	$event_days;


						$id = $request->segment(3);
						if(is_numeric($id)){ #Edit post Handler=======
							if($data['oldAlias'] != $data['alias']){
								Alias::updateAlias($data['oldAlias'], $data['alias']);	
							}
							$event = Events::getRecordForLogById($id);
							$whereConditions = ['id' => $event->id];
							$update = CommonModel::updateRecords($whereConditions, $eventArr);
							if ($update) {
								if (!empty($id)) {
										self::swap_order_edit($data['display_order'], $event->id);
										
										$logArr = MyLibrary::logData($event->id);
										if (Auth::user()->can('log-advanced')) {
											$newEventObj = Events::getRecordForLogById($event->id);
											$oldRec = $this->recordHistory($event);
											$newRec = $this->recordHistory($newEventObj);
											$logArr['old_val'] = $oldRec;
											$logArr['new_val'] = $newRec;
										}

										$logArr['varTitle'] = trim($data['title']);	
										Log::recordLog($logArr);

										if (Auth::user()->can('recent-updates-list')) {
											if(!isset($newEventObj)){
													$newEventObj = Events::getRecordForLogById($event->id);
											}
											$notificationArr = MyLibrary::notificationData($event->id, $newEventObj);
											RecentUpdates::setNotification($notificationArr);
										}
										self::flushCache();	
										$actionMessage = trans('template.eventModule.updateMessage');										
								}
								
							}
						}else{ #Add post Handler=======
							$eventArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
							$eventArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
							$eventArr['created_at'] = Carbon::now();
							$eventID = CommonModel::addRecord($eventArr);
							if (!empty($eventID)) {
								$id=$eventID;
								$newEventObj = Events::getRecordForLogById($id);
								$logArr = MyLibrary::logData($id);
								$logArr['varTitle'] = $newEventObj->varTitle;
								Log::recordLog($logArr);								
								if (Auth::user()->can('recent-updates-list')) {
									$notificationArr = MyLibrary::notificationData($id, $newEventObj);
									RecentUpdates::setNotification($notificationArr);
								}
								self::flushCache();	
								$actionMessage = trans('template.eventModule.addMessage');	
							}
						}
						AddImageModelRel::sync(explode(',', $data['img_id']), $id);
						AddVideoModelRel::sync(explode(',', $data['video_id']), $id);
						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.events.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.events.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads events table data on view
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
				$filterArr['catFilter'] = !empty(Input::get('catValue')) ? Input::get('catValue') : '';
				$filterArr['start'] = !empty(Input::get('rangeFilter')['from']) ? Input::get('rangeFilter')['from'] : '';
				$filterArr['end'] = !empty(Input::get('rangeFilter')['to']) ? Input::get('rangeFilter')['to'] : '';
				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart'] = intval(Input::get('start'));
				$sEcho = intval(Input::get('draw'));
				$arrResults = Events::getRecordList($filterArr);
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
		 * This method delete multiples events
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
																<th>'.trans("template.common.image").'</th>
																<th>'.trans("template.common.description").'</th>
																<th>'.trans("template.common.startdate").'</th>
																<th>'.trans("template.common.enddate").'</th>
																<th>'.trans("template.common.latitude").'</th>
																<th>'.trans("template.common.longitude").'</th>
																<th>'.trans("template.common.address").'</th>
																<th>'.trans("template.common.order").'</th>
																<th>'.trans("template.common.metatitle").'/th>
																<th>'.trans("template.common.metakeyword").'</th>
																<th>'.trans("template.common.metadescription").'</th>
																<th>'.trans("template.common.publish").'</th>
														</tr>
												</thead>
												<tbody>
														<tr>
																<td>' . $data->varTitle . '</td>';
																if($data->fkIntImgId > 0){
																		$returnHtml.= '<td>'.'<img height="50" width="50" src="'.resize_image::resize($data->fkIntImgId).'" />'.'</td>';
																}else{
																		$returnHtml.= '<td>-</td>';
																}
																$returnHtml.= '<td>' . $data->txtDescription . '</td>
																<td>' . $data->dtStartDateTime . '</td>
																<td>' . $data->dtEndDateTime . '</td>
																<td>' . $data->varLatitude . '</td>
																<td>' . $data->varLongitude . '</td>
																<td>' . $data->txtAddress . '</td>
																<td>' . ($data->intDisplayOrder) . '</td>
																<td>' . $data->varMetaTitle . '</td>
																<td>' . $data->varMetaKeyword . '</td>
																<td>' . $data->varMetaDescription . '</td>
																<td>' . $data->chrPublish . '</td>
														</tr>
												</tbody>
										</table>';
				return $returnHtml;
		}
		
		public function tableData($value = false) 
		{
			$publish_action='';
				$details = '';
				if(Auth::user()->can('events-edit'))
				{
						$details.= '<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.events.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
				}    
				if(Auth::user()->can('events-delete'))
				{
						$details.= '&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="events" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}   

				if(Auth::user()->can('events-publish'))
				{	
					if ($value->chrPublish == 'Y') {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/events" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
					} else {
						$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/events" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
					}
				}

				$category = '';
				if(isset($value->txtCategories)){
					$categoryIDs =unserialize($value->txtCategories);
					$selCategory = EventCategory::getParentCategoryNameBycatId($categoryIDs);
					$category.='<div class="pro-act-btn"><a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.category").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-info"></span></a>';
						$category.='<div class="highslide-maincontent">';
							$category.='<ul>';
							foreach ($selCategory as $selCat) {
								if(strlen(trim($selCat))>0){
									$category.='<li>';
										$category.= $selCat->varTitle;
									$category.='</li>';
								}
							}	
							$category.='<ul>';
						$category.='</div>';
					$category.='</div>';
				}else{
					$category .= '<span class="glyphicon glyphicon-minus"></span>';
				}
				
				$dateFormat=Config::get('Constant.DEFAULT_DATE_FORMAT');
				$timeFormat=Config::get('Constant.DEFAULT_TIME_FORMAT');
				
				$dateFormat=isset($dateFormat)?$dateFormat:'Y-m-d';
				$timeFormat=isset($timeFormat)?$timeFormat:'g:i A';

				$records = array(				
				'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">', 				
				'<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.events.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>', 
				'<div class="pro-act-btn">
								<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.description").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
				<div class="highslide-maincontent">' . $value->txtDescription . '</div>
				</div>',
				$category,
				date(''.$dateFormat.' '.$timeFormat.'', strtotime($value->dtStartDateTime)), 
				(!empty($value->dtEndDateTime) || $value->dtEndDateTime!=null)?date(''.$dateFormat.' '.$timeFormat.'', strtotime($value->dtEndDateTime)):'-', 
				'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
				'.$value->intDisplayOrder.
				' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
				$publish_action,
				$details,
				$value->intDisplayOrder);
				return $records;
		}
		public static function flushCache(){				
				Cache::tags('Events')->flush();
		}
}
