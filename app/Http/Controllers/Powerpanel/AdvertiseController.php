<?php
namespace App\Http\Controllers\Powerpanel;

use App\Advertise;
use App\Alias;
use App\CmsPage;
use App\CommonModel;
use App\Helpers\AddImageModelRel;
use App\ModuleSettings;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Http\Controllers\PowerpanelController;
use App\Log;
use App\RecentUpdates;
use Auth;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Cache;

class AdvertiseController extends PowerpanelController{
		public function __construct(){
				parent::__construct();
				if (isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}
		}
		/**
		 * This method handels load process of advertise
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index(){
			$iTotalRecords             = CommonModel::getRecordCount();
			$this->breadcrumb['title'] = trans('template.advertiseModule.manage');
			$breadcrumb                = $this->breadcrumb;
			return view('powerpanel.advertise.index', compact('iTotalRecords', 'breadcrumb'));
		}
		/**
		 * This method loads advertise edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($id = false){			
			$CmsPages      = CmsPage::getPagesWithModule();			
			$CmsPage = array();
			$CmsPage[' '] = '--Select Pages--';
			if(count($CmsPages) > 0)
			{
					foreach($CmsPages as $page)
					{
							if(Auth::user()->can($page->modules->varModuleName.'-list'))
							{
									$CmsPage[$page->id] = $page->varTitle;
							}
					}
			}
			$positions    = [' ' => '--Select Positions--', 'top' => 'Header', 'bottom' => 'Footer', 'section_107' => 'Top of News Section', 'section_100' => 'Top of Event Section', 'section_100_grid' => 'Right of Event Section', 'section_103' => 'Top of Contact Section', 'mobile_app_advt' => 'Sponsor (Mobile App Advt.)'];
			$imageManager = true;
			if (!is_numeric($id)) {
					$total                           = CommonModel::getRecordCount();
					$total                           = $total + 1;
					$this->breadcrumb['title']       = trans('template.advertiseModule.add');
					$this->breadcrumb['module']      = trans('template.advertiseModule.manage');
					$this->breadcrumb['url']         = 'powerpanel/advertise';
					$this->breadcrumb['inner_title'] = trans('template.advertiseModule.add');
					$breadcrumb                      = $this->breadcrumb;
					$data                            = compact('total', 'CmsPage', 'positions', 'breadcrumb', 'imageManager');
			} else {
					$advertise                       = Advertise::getRecordById($id);
					if(count($advertise)==0){ return redirect()->route('powerpanel.advertise.add'); }
					$this->breadcrumb['title']       = trans('template.advertiseModule.edit') . ' - ' . $advertise->varTitle;
					$this->breadcrumb['module']      = trans('template.advertiseModule.manage');
					$this->breadcrumb['url']         = 'powerpanel/advertise';
					$this->breadcrumb['inner_title'] = trans('template.advertiseModule.edit') . ' - ' . $advertise->varTitle;
					$breadcrumb                      = $this->breadcrumb;
					$data                            = compact('advertise', 'CmsPage', 'positions', 'alias', 'breadcrumb', 'imageManager');
			}
			return view('powerpanel.advertise.actions', $data);
		}

		/**
		 * This method stores advertise modifications
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function handlePost(Request $request){
				$data          = Input::get();
				$actionMessage = trans('template.common.oppsSomethingWrong');
				$messsages     = array(
						'order.greater_than_zero'     => trans('template.advertiseModule.displayGreaterThan'),
						'start_date_time.date_format' => trans('template.advertiseModule.startDateErrorMessage'),
				);
				
				$rules = array(
						'ad_name'         => 'required|max:160',
						'start_date_time' => 'required',
						'img_id'          => 'required',
						'pages'           => 'required',
						'position'        => 'required',
				);
				
				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {
						$advertiseArr['varTitle']        = trim($data['ad_name']);
						$advertiseArr['dtStartDateTime'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['start_date_time'])));
						$advertiseArr['dtEndDateTime']   = (isset($data['end_date_time']) && $data['end_date_time'] !="") ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['end_date_time']))) : null;
						$advertiseArr['fkIntImgId']      = !empty($data['img_id']) ? $data['img_id'] : 0;
						$advertiseArr['txtLink']         = trim($data['link']);
						$advertiseArr['txtPosition']     = serialize($data['position']);
						$advertiseArr['varPages']        = serialize($data['pages']);
						$advertiseArr['chrPublish']      = $data['chrMenuDisplay'];

						$id = $request->segment(3);
						if (is_numeric($id)) {
								#Edit post Handler=======
								$advertise       = Advertise::getRecordForLogById($id);
								$whereConditions = ['id' => $advertise->id];
								$update          = CommonModel::updateRecords($whereConditions, $advertiseArr);
								if ($update) {
										if (!empty($id)) {

												$logArr = MyLibrary::logData($advertise->id);
												if (Auth::user()->can('log-advanced')) {
														$newAdvertiseObj   = Advertise::getRecordForLogById($advertise->id);
														$oldRec            = $this->recordHistory($advertise);
														$newRec            = $this->recordHistory($newAdvertiseObj);
														$logArr['old_val'] = $oldRec;
														$logArr['new_val'] = $newRec;
												}
												$logArr['varTitle'] = trim($data['ad_name']);
												Log::recordLog($logArr);
												if (Auth::user()->can('recent-updates-list')) {
														if (!isset($newAdvertiseObj)) {
																$newAdvertiseObj = Advertise::getRecordForLogById($advertise->id);
														}
														$notificationArr = MyLibrary::notificationData($advertise->id, $newAdvertiseObj);
														RecentUpdates::setNotification($notificationArr);
												}
										}
										self::flushCache();
										$actionMessage = trans('template.advertiseModule.updateMessage');
								}
						} else {
								$advertiseID = CommonModel::addRecord($advertiseArr);
								if (!empty($advertiseID)) {
										$id                 = $advertiseID;
										$newAdvertiseObj    = Advertise::getRecordForLogById($id);
										$logArr             = MyLibrary::logData($id);
										$logArr['varTitle'] = $newAdvertiseObj->varTitle;
										Log::recordLog($logArr);

										if (Auth::user()->can('recent-updates-list')) {
												$notificationArr = MyLibrary::notificationData($id, $newAdvertiseObj);
												RecentUpdates::setNotification($notificationArr);
										}
										self::flushCache();
										$actionMessage = trans('template.advertiseModule.addedMessage');
								}
						}
						AddImageModelRel::sync(explode(',', $data['img_id']), $id);
						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.advertise.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.advertise.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads advertise table data on view
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function get_list(){
				$filterArr                       = [];
				$records                         = [];
				$records["data"]                 = [];
				$filterArr['orderColumnNo']      = (!empty(Input::get('order')[0]['column']) ? Input::get('order')[0]['column'] : '');
				$filterArr['orderByFieldName']   = (!empty(Input::get('columns')[$filterArr['orderColumnNo']]['name']) ? Input::get('columns')[$filterArr['orderColumnNo']]['name'] : '');
				$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order')[0]['dir']) ? Input::get('order')[0]['dir'] : '');
				$filterArr['statusFilter']       = !empty(Input::get('statusValue')) ? Input::get('statusValue') : '';
				$filterArr['searchFilter']       = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
				$filterArr['advertiseFilter']    = !empty(Input::get('advertiseFilter')) ? Input::get('advertiseFilter') : '';
				$filterArr['personalityFilter']  = !empty(Input::get('personalityFilter')) ? Input::get('personalityFilter') : '';
				$filterArr['paymentFilter']      = !empty(Input::get('paymentFilter')) ? Input::get('paymentFilter') : '';

				$filterArr['start'] = !empty(Input::get('rangeFilter')['from']) ? Input::get('rangeFilter')['from'] : '';
				$filterArr['end']   = !empty(Input::get('rangeFilter')['to']) ? Input::get('rangeFilter')['to'] : '';

				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart']  = intval(Input::get('start'));
				$sEcho                       = intval(Input::get('draw'));
				$arrResults                  = Advertise::getRecordList($filterArr);
				$iTotalRecords               = CommonModel::getRecordCount($filterArr,true);
				$CmsPage                     = CmsPage::getOptionPageList()->toArray();
				$end                         = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				$end                         = $end > $iTotalRecords ? $iTotalRecords : $end;
				if (!empty($arrResults)) {
						foreach ($arrResults as $key => $value) {
								$records["data"][] = $this->tableData($value, $CmsPage);
						}
				}
				$records["customActionStatus"] = "OK";
				$records["draw"]               = $sEcho;
				$records["recordsTotal"]       = $iTotalRecords;
				$records["recordsFiltered"]    = $iTotalRecords;
				return json_encode($records);
		}

		/**
		 * This method delete multiples advertise
		 * @return  true/false
		 * @since   2017-07-15
		 * @author  NetQuick
		 */
		public function DeleteRecord(Request $request){
				$data   = $request->all('ids');
				$update = MyLibrary::deleteMultipleRecords($data);
				self::flushCache();
				echo json_encode($update);
				exit;
		}
		/**
		 * This method destroys Banner in multiples
		 * @return  Banner index view
		 * @since   2016-10-25
		 * @author  NetQuick
		 */
		public function publish(Request $request){
				$alias  = Input::get('alias');
				$update = MyLibrary::setPublishUnpublish($alias, $request);
				self::flushCache();
				echo json_encode($update);
				exit;
		}
		public function recordHistory($data = false){
				$pageTitles    = [];
				$CmsPage       = CmsPage::getOptionPageList()->toArray();
				$selectedPages = unserialize($data->varPages);
				if (!empty($selectedPages)) {
						foreach ($CmsPage as $key => $page) {
								if (in_array($key, $selectedPages)) {
										array_push($pageTitles, $page);
								}
						}
						$pageTitles = implode(',', $pageTitles);
				} else {
						$pageTitles = 'No page selected';
				}
				$position    = [];
				$selectedPos = unserialize($data->txtPosition);
				if (!empty($selectedPos)) {
						$positions = [' ' => '--Select Positions--', 'top' => 'Header', 'bottom' => 'Footer', 'section_107' => 'Top of News Section', 'section_100' => 'Top of Event Section', 'section_100_grid' => 'Right of Event Section', 'section_103' => 'Top of Contact Section', 'mobile_app_advt' => 'Sponsor (Mobile App Advt.)'];
						foreach ($positions as $key => $pos) {
								if (in_array($key, $selectedPos)) {
										array_push($position, $pos);
								}
						}
						$position = implode(',', $position);
				} else {
						$position = 'No position selected';
				}

				$returnHtml = '';
				'<table class="new_table_desing table table-striped table-bordered table-hover">
														<thead>
																<tr>
																		<th>' . trans("template.common.title") . '</th>
																		<th>' . trans("template.common.pages") . '</th>
																		<th>' . trans("template.common.positions") . '</th>
																		<th>' . trans("template.common.image") . '</th>
																		<th>' . trans("template.common.link") . '</th>
																		<th>' . trans("template.common.startDateAndTime") . '</th>
																		<th>' . trans("template.common.endDateAndTime") . '</th>
																		<th>' . trans("template.common.publish") . '</th>
																</tr>
														</thead>
														<tbody>
																<tr>
																		<td>' . $data->varTitle . '</td>
																		<td>' . $pageTitles . '</td>
																		<td>' . $position . '</td>';
				if ($data->fkIntImgId > 0) {
						$returnHtml .= '<td>' . '<img height="50" width="50" src="' . resize_image::resize($data->fkIntImgId, 50, 50) . '" />' . '</td>';
				} else {
						$returnHtml .= '<td>-</td>';
				}
				$returnHtml .= '<td>' . $data->txtLink . '</td>
																		<td>' . $data->dtStartDateTime . '</td>
																		<td>' . (($data->dtEndDateTime != null) ? $data->dtEndDateTime : "No Expiry") . '</td>
																		<td>' . $data->chrPublish . '</td>
																</tr>
														</tbody>
												</table>';
				return $returnHtml;
		}

		public function tableData($value = false, $CmsPage = false){
				$actions = '';
				$details = '';
				$img     = '';
				$publish_action='';
				if (Auth::user()->can('advertise-edit')) {
						$actions .= '<a class="without_bg_icon" title="Edit"  href="' . route('powerpanel.advertise.edit', array('alias' => $value->id)) . '">
										<i class="fa fa-pencil"></i></a>';
				}
				if (Auth::user()->can('advertise-delete')) {
						$actions .= '&nbsp;<a class="without_bg_icon delete" title="Delete" data-controller="advertise" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}

				if (Auth::user()->can('advertise-publish')) {
						if ($value->chrPublish == 'Y') {
								$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/advertise" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
						} else {
								$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/advertise" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
						}
				}

				if (Auth::user()->can('advertise-edit')) {
						$title = '<a class="" title="Edit"  href="' . route('powerpanel.advertise.edit', array('alias' => $value->id)) . '">
										' . $value->varTitle . '</a>';
				} else {
						$title = $value->varTitle;
				}
				$pagesUl = '<a href="javascript:void(0)" class="without_bg_icon  highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Pages\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-book-open"></span></a>';
				$pagesUl .= '<div class="highslide-maincontent">';
				$pagesUl .= '<ul>';
				$selectedPages = unserialize($value->varPages);
				if (!empty($selectedPages)) {
						foreach ($CmsPage as $key => $page) {
								if (in_array($key, $selectedPages)) {
										$pagesUl .= '<li>' . $page . '</li>';
								}
						}
				} else {
						$pagesUl .= '<li>No page selected</li>';
				}
				$pagesUl .= '</ul>';
				$pagesUl .= '</div>';
				$pagesUl .= '<div class="text-center">';
				$slotUl = '<a href="javascript:void(0)" class="without_bg_icon  highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Slots\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-info"></span></a>';
				$slotUl .= '<div class="highslide-maincontent">';
				$slotUl .= '<ul>';
				$selectedPos = unserialize($value->txtPosition);
				if (!empty($selectedPos)) {
						$positions = [' ' => '--Select Positions--', 'top' => 'Header', 'bottom' => 'Footer', 'section_107' => 'Top of News Section', 'section_100' => 'Top of Event Section', 'section_100_grid' => 'Right of Event Section', 'section_103' => 'Top of Contact Section', 'mobile_app_advt' => 'Sponsor (Mobile App Advt.)'];
						foreach ($positions as $key => $pos) {
								if (in_array($key, $selectedPos)) {
										$slotUl .= '<li>' . $pos . '</li>';
								}
						}
				} else {
						$slotUl .= '<li>No position selected</li>';
				}
				$slotUl .= '</ul>';
				$slotUl .= '</div>';
				$slotUl .= '<div class="text-center">';
				if (!empty($value->fkIntImgId)) {
						$imageURL = resize_image::resize($value->fkIntImgId, 800, 533);
						$img .= '<a href="' . $imageURL . '" class="fancybox-buttons" data-rel="fancybox-buttons">';
						$img .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) . '" src="' . $imageURL . '"/>';
						$img .= '</a>';
				} else {
						$img .= '<span class="glyphicon glyphicon-minus"></span>';
				}
				$img .= '</div>';
				$records = array(
						'<input type="checkbox" name="delete[]" class="chkDelete" value="' . $value->id . '">',
						$title,
						$img,
						date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->dtStartDateTime)),
						!empty($value->dtEndDateTime) ? date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->dtEndDateTime)) : '-',
						$pagesUl,
						$slotUl,
						$publish_action,
						$actions,
				);
				return $records;
		}

		public function flushCache(){
				Cache::forget('getFrontRecordsByPage');
		}

}
