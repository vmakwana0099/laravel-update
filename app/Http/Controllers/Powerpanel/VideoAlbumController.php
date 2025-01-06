<?php
/**
 * The MenuController class handels video album
 * configuration  process.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.00
 * @since     2017-01-03
 * @author    NetQuick
 */
namespace App\Http\Controllers\Powerpanel;

use App\Alias;
use App\CommonModel;
use App\Helpers\MyLibrary;
use App\Http\Controllers\PowerpanelController;
use App\Log;
use App\RecentUpdates;
use App\VideoAlbum;
use App\VideoGallery;
use App\Video;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\AddVideoModelRel;
use Validator;
use Cache;

class VideoAlbumController extends PowerpanelController
{

		public function __construct()
		{
				parent::__construct();
				if (isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}
		}
		/**
		 * This method handels load process of video album
		 * @return  view
		 * @since   2017-01-03
		 * @author  NetQuick
		 */
		public function index()
		{
				$iTotalRecords             = CommonModel::getRecordCount();
				$this->breadcrumb['title'] = trans('template.videoAlbum.manageVideoAlbum');
				return view('powerpanel.video_album.list', ['iTotalRecords' => $iTotalRecords, 'breadcrumb' => $this->breadcrumb]);
		}
		

		
	/**
	 * This method loads video album edit view
	 * @param   Alias of record
	 * @return  View
	 * @since   2017-01-03
	 * @author  NetQuick
	 */
		public function edit($alias = false)
		{

				$id = $alias;
				$videoManager	 = true;
				if (is_numeric($id) && !empty($id)) {
						$video_album = VideoAlbum::getRecordById($id);
						if(count($video_album)==0){ return redirect()->route('powerpanel.video-album.add'); }
						$metaInfo    = array(
								'varMetaTitle'       => $video_album->varMetaTitle,
								'varMetaKeyword'     => $video_album->varMetaKeyword,
								'varMetaDescription' => $video_album->varMetaDescription,
						);
						$this->breadcrumb['title']       = trans('template.common.edit') . ' - ' . $video_album->varTitle;
						$this->breadcrumb['module']      = trans('template.videoAlbum.manageVideoAlbum');
						$this->breadcrumb['url']         = 'powerpanel/video-album';
						$this->breadcrumb['inner_title'] = trans('template.common.edit') . ' - ' . $video_album->varTitle;
						$breadcrumb                      = $this->breadcrumb;

						$data = compact('video_album', 'metaInfo', 'breadcrumb','videoManager');

				} else {

						$total                           = CommonModel::getRecordCount();
						$total                           = $total + 1;
						$this->breadcrumb['title']       = trans('template.videoAlbum.addVideoAlbum');
						$this->breadcrumb['module']      = trans('template.videoAlbum.manageVideoAlbum');
						$this->breadcrumb['url']         = 'powerpanel/video-album';
						$this->breadcrumb['inner_title'] = trans('template.videoAlbum.addVideoAlbum');
						$breadcrumb                      = $this->breadcrumb;

						$data = compact('breadcrumb', 'total','videoManager');

				}
				return view('powerpanel.video_album.actions', $data);
		}

		/**
		 * This method stores video album modifications
		 * @return  View
		 * @since   2017-01-03
		 * @author  NetQuick
		 */
		public function handlePost(Request $request)
		{

				$data          = Input::get();
				$actionMessage = trans('template.common.oppsSomethingWrong');
				$messsages     = $this->serverSideValidationMessages();
				$rules         = $this->serverSideValidationRules();

				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {

						$videoAlbumArr                       = array();
						$videoAlbumArr['varTitle']           = trim($data['title']);
						$videoAlbumArr['fkIntVideoId']       = !empty($data['video_id']) ? $data['video_id'] : null;
						$videoAlbumArr['txtDescription']     = $data['description'];
						$videoAlbumArr['intDisplayOrder']    = self::swap_order_add($request->display_order);
						$videoAlbumArr['chrPublish']         = $data['chrMenuDisplay'];
						$videoAlbumArr['varMetaTitle']       = trim($data['varMetaTitle']);
						$videoAlbumArr['varMetaKeyword']     = trim($data['varMetaKeyword']);
						$videoAlbumArr['varMetaDescription'] = trim($data['varMetaDescription']);

						$id = $request->segment(3);

						if (is_numeric($id) && !empty($id)) {
								if($data['oldAlias'] != $data['alias']){
								Alias::updateAlias($data['oldAlias'], $data['alias']);	
							}
								$videoAlbumObj = VideoAlbum::getRecordForLogById($id);

								$whereConditions = ['id' => $videoAlbumObj->id];
								$update          = CommonModel::updateRecords($whereConditions, $videoAlbumArr);

								if ($update) {
										if ($videoAlbumObj->id > 0 && !empty($videoAlbumObj->id)) {
												self::swap_order_edit($data['display_order'], $videoAlbumObj->id);

												$logArr = MyLibrary::logData($videoAlbumObj->id);
												if (Auth::user()->can('log-advanced')) {
													$newVideoAlbumObj = VideoAlbum::getRecordForLogById($videoAlbumObj->id);
													$oldRec = $this->recordHistory($videoAlbumObj);
													$newRec = $this->recordHistory($newVideoAlbumObj);
													$logArr['old_val'] = $oldRec;
													$logArr['new_val'] = $newRec;
												}
												$logArr['varTitle'] = trim($data['title']);
												Log::recordLog($logArr);
												if (Auth::user()->can('recent-updates-list')) {
													if(!isset($newVideoAlbumObj)){
															$newVideoAlbumObj = VideoAlbum::getRecordForLogById($videoAlbumObj->id);
													}
													$notificationArr = MyLibrary::notificationData($videoAlbumObj->id, $newVideoAlbumObj);
													RecentUpdates::setNotification($notificationArr);
												}
												self::flushCache();
										}
										$actionMessage = trans('template.videoAlbum.updateMessage');

								}

						} else {
								$videoAlbumArr['intAliasId']         = MyLibrary::insertAlias($data['alias']);
								$videoAlbumArr['created_at'] = Carbon::now();
								$videoAlbumID                  = CommonModel::addRecord($videoAlbumArr);

								if (!empty($videoAlbumID)) 
								{
										$id     = $videoAlbumID;
										$newVideoAlbumObj = VideoAlbum::getRecordForLogById($id);
										
										$logArr = MyLibrary::logData($id);
										$logArr['varTitle'] = $newVideoAlbumObj->varTitle;
										Log::recordLog($logArr);

										if (Auth::user()->can('recent-updates-list')) {
											$notificationArr  = MyLibrary::notificationData($id, $newVideoAlbumObj);
											RecentUpdates::setNotification($notificationArr);
										}
										self::flushCache();
										$actionMessage = trans('template.videoAlbum.addMessage');
								}
						}
						AddVideoModelRel::sync(explode(',', $data['video_id']), $id);
						if (!empty($request->saveandexit) && $request->saveandexit == 'saveandexit') 
						{
								return redirect()->route('powerpanel.video-album.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.video-album.edit', $id)->with('message', $actionMessage);
						}

				} else {
						return Redirect::back()->withErrors($validator)->withInput();

				}

		}

	/**
	 * This method loads video album table data on view
	 * @return  View
	 * @since   2017-01-03
	 * @author  NetQuick
	 */
		public function get_list()
		{
				$filterArr                       = [];
				$records                         = [];
				$records["data"]                 = [];
				$filterArr['orderColumnNo']      = (!empty(Input::get('order')[0]['column']) ? Input::get('order')[0]['column'] : '');
				$filterArr['orderByFieldName']   = (!empty(Input::get('columns')[$filterArr['orderColumnNo']]['name']) ? Input::get('columns')[$filterArr['orderColumnNo']]['name'] : '');
				$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order')[0]['dir']) ? Input::get('order')[0]['dir'] : '');
				$filterArr['statusFilter']       = !empty(Input::get('customActionName')) ? Input::get('customActionName') : '';
				$filterArr['searchFilter']       = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
				$filterArr['showFilter']         = !empty(Input::get('showFilter')) ? Input::get('showFilter') : '';
				$filterArr['rangeFilter']        = !empty(Input::get('rangeFilter')) ? Input::get('rangeFilter') : '';
				$filterArr['iDisplayLength']     = intval(Input::get('length'));
				$filterArr['iDisplayStart']      = intval(Input::get('start'));
				$sEcho                           = intval(Input::get('draw'));

				$arrResults    = VideoAlbum::getRecordList($filterArr);
				$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
				$end           = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				$end           = $end > $iTotalRecords ? $iTotalRecords : $end;

				if (!empty($arrResults) && count($arrResults) > 0) {
						foreach ($arrResults as $key => $value) {
								$records["data"][] = $this->tableData($value);
						}
				}
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				$records["draw"]               = $sEcho;
				$records["recordsTotal"]       = $iTotalRecords;
				$records["recordsFiltered"]    = $iTotalRecords;
				echo json_encode($records);
		}

		public function publish(Request $request)
		{
				$alias  = Input::get('alias');
				$update = MyLibrary::setPublishUnpublish($alias, $request);
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
		 * This method destroys video album in multiples
		 * @return  video album index view
		 * @since   2017-01-03
		 * @author  NetQuick
		 */
		public function DeleteRecord(Request $request)
		{
				$data   = $request->all('ids');
				$update = MyLibrary::deleteMultipleRecords($data);
				self::flushCache();
				echo json_encode($update);
				exit;
		}

		/**
		 * This method handels swapping of available order record while adding
		 * @param      order
		 * @return  order
		 * @since   2017-01-03
		 * @author  NetQuick
		 */
		public static function swap_order_add($order = null)
		{
				$response = false;
				if ($order != null) {
						$response = MyLibrary::swapOrderAdd($order);
						self::flushCache();
				}
				return $response;
		}

		/**
		 * This method handels swapping of available order record while editing
		 * @param      order
		 * @return  order
		 * @since   2017-01-03
		 * @author  NetQuick
		 */
		public static function swap_order_edit($order = null, $id = null)
		{
				MyLibrary::swapOrderEdit($order, $id);
				self::flushCache();
		}

		public function serverSideValidationRules()
		{
				$rules = array(
						'title'              => 'required|max:160',
						'video_id'           => 'required|max:3',
						'display_order'      => 'required|greater_than_zero',
						'chrMenuDisplay'     => 'required',
						'varMetaTitle'       => 'required|max:500',
						'varMetaKeyword'     => 'required|max:500',
						'varMetaDescription' => 'required|max:500',
						'alias'              => 'required',
				);

				return $rules;
		}

		public function serverSideValidationMessages()
		{
				$messsages = array(
						'display_order.greater_than_zero' => trans('template.videoAlbum.displayGreaterThan'),
						'title.required'                  => trans('template.videoAlbum.pleaseSelectTitleMessage'),
						'video_id.required'               => trans('template.videoAlbum.pleaseSelectVideoMessage'),
						'display_order.required'          => trans('template.videoAlbum.displayOrderMessage'),
						'chrMenuDisplay.required'         => trans('template.videoAlbum.thisFieldMessage'),
						'varMetaTitle.required'           => trans('template.videoAlbum.metaTitleMessage'),
						'varMetaDescription.required'     => trans('template.videoAlbum.metaDescriptionMessage'),
						'alias.required'                  => trans('template.videoAlbum.aliasMessage'),
						'varMetaKeyword.required'         => trans('template.videoAlbum.metaKeywordMessage'),
				);
				return $messsages;
		}

		public function tableData($value)
		{

				$details = '';
				$publish_action='';
				if (Auth::user()->can('video-album-edit')) {
						$details .= '<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.video-album.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
				}
				if (Auth::user()->can('video-album-delete')) {
						$details .= '&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="video-album" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}
				if (!empty($value->chrPublish) && ($value->chrPublish == 'Y')) {
						$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/video-album" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
				} else {
						$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/video-album" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
				}

				$videoIcon = '';
				if (!empty($value->fkIntVideoId)) {
						if (!empty($value->video->youtubeId) && isset($value->video->youtubeId)) {
								$videoIcon .= '<a href="http://www.youtube.com/embed/' . $value->video->youtubeId . '?autoplay=1" class="fancybox-buttons fancybox fancybox.iframe" data-rel="fancybox-buttons" data-fancybox-group="gallery">';
								$videoIcon .= '<span style="margin-top:5px;" class="fa fa-play-circle-o"></span>';
								$videoIcon .= '</a>';
						} else {
								$videoIcon .= '<a href="' . url('/') . '/assets/videos/' . $value->video->varVideoName . '.' . $value->video->varVideoExtension . '" class="fancybox-buttons fancybox fancybox.iframe" data-rel="fancybox-buttons" data-fancybox-group="gallery">';
								$videoIcon .= '<span style="margin-top:5px;" class="fa fa-play-circle-o"></span>';
								$videoIcon .= '</a>';
						}
				} else {
						$videoIcon .= '<span class="glyphicon glyphicon-minus"></span>';
				}

				if (Auth::user()->can('video-album-edit')) {
						$title = '<a class="" title="'.trans("template.common.edit").'" href="' . route('powerpanel.video-album.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
				} else {
						$title = $value->varTitle;
				}

				$albumVideoCount = VideoGallery::getCountById($value->id);
				if (Auth::user()->can('video-gallery-create')) {
						$videoGallery = '<a class="" title="'.trans("template.videoAlbum.addViewVideos").'" href="' . url('powerpanel/video-gallery?album=' . $value->id) . '">'.trans("template.videoAlbum.addViewVideos").' (' . $albumVideoCount . ')</a>';
				} else {
						$videoGallery = '-';
				}

				$records = array(
						'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',					
					$title,
					'<div class="pro-act-btn">
					<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.description").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
					<div class="highslide-maincontent">' . $value->txtDescription . '</div>
					</div>',
					$videoIcon,					
					$videoGallery,
					'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
					'.$value->intDisplayOrder.
					' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
					$publish_action,
					$details,
					$value->intDisplayOrder
				);
				return $records;
		}

		/**
		 * This method handels logs History records
		 * @param   $data
		 * @return  HTML
		 * @since   2017-07-27
		 * @author  NetQuick
		 */
		public function recordHistory($data = false)
		{
				if($data->fkIntVideoId > 0 && $data->fkIntVideoId != null){
								$videoDetail = Video::getVideoTitleById($data->fkIntVideoId);
								$videoTitle = ($videoDetail->varVideoName != "") ? $videoDetail->varVideoName.".".$videoDetail->varVideoExtension:'-';
				}else{
								$videoTitle = "-";
				}

				$returnHtml = '';
				$returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">
									<thead>
											<tr>
													<th>'.trans("template.common.title").'</th>
													<th>'.trans("template.common.video").'</th>
													<th>'.trans("template.common.order").'</th>
													<th>'.trans("template.common.description").'</th>
													<th>'.trans("template.common.metatitle").'/th>
													<th>'.trans("template.common.metakeyword").'</th>
													<th>'.trans("template.common.metadescription").'</th>
													<th>'.trans("template.common.publish").'</th>
											</tr>
									</thead>
									<tbody>
											<tr>
													<td>' . $data->varTitle . '</td>
													<td>' . $videoTitle . '</td>
													<td>' . ($data->intDisplayOrder) . '</td>
													<td>' . $data->txtDescription . '</td>
													<td>' . $data->varMetaTitle . '</td>
													<td>' . $data->varMetaKeyword . '</td>
													<td>' . $data->varMetaDescription . '</td>
													<td>' . $data->chrPublish . '</td>
											</tr>
									</tbody>
							</table>';
				return $returnHtml;
		}

		public static function flushCache(){
				Cache::tags(['VideoAlbums','VideoGallery'])->flush();
		}

}
