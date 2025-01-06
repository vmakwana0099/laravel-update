<?php
/**
* The MenuController class handels Video album
* configuration  process.
* @package   Netquick powerpanel
* @license   http://www.opensource.org/licenses/BSD-3-Clause
* @version   1.00
* @since     2017-08-23
* @author    NetQuick
*/
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\VideoGallery;
use App\VideoAlbum;
use App\Video;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use DB;
use Response;
use Request as AjaxRequest;
use App\Log;
use Illuminate\Contracts\Auth\Guard;
use App\RecentUpdates;
use Crypt;
use App\Alias;
use Auth;
use App\Modules;
use App\Helpers\MyLibrary;
use App\CommonModel;
use Cache;

class VideoGalleryController extends PowerpanelController 
{   
	
	public function __construct()
	{
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}

	/**
 * This method handels video gallery features
 * @param  	alias
 * @return  true/false
 * @since   2017-08-23
 * @author  NetQuick
 */
	public function index()
	{
		$album = null;
		$albumId = null;

		$albumId = Input::get('album');
		
		if($albumId != null)
		{
			$album = VideoAlbum::getRecordById($albumId);
			$videoGalleryObj = VideoGallery::getRecordByAlbumID($albumId);
		}else{
			$videoGalleryObj = VideoGallery::getRecordList();
		}

		$display_order = $videoGalleryObj->count() + 1;
		$videoAlbumObj = VideoAlbum::getRecordList()->toArray();

		$this->breadcrumb['title']=$album!==null?trans('template.videoGalleryModule.addVideo').' - '.$album->varTitle:trans('template.common.videoGallery');
		$this->breadcrumb['module']=$album!==null?trans('template.common.manageVideoAlbum'):trans('template.common.gallery');
		$this->breadcrumb['url']=$album!==null?'powerpanel/video-album':'#';
		$this->breadcrumb['inner_title']=$album!==null?trans('template.videoGalleryModule.addVideo').' - '.$album->varTitle:trans('template.common.videoGallery');

		if(AjaxRequest::ajax())
		{
			return Response::json(view('powerpanel.video_album.video_gallery', array('videoGalleryObj' => $videoGalleryObj,'display_order' => $display_order,'breadcrumb'=>$this->breadcrumb,'videoManager'=> true))->render());
		}else{
			return view('powerpanel.video_album.manage_video_gallery',array('videoAlbumObj'=>$videoAlbumObj,'videoGalleryObj' => $videoGalleryObj,'display_order' => $display_order,'breadcrumb'=>$this->breadcrumb,'videoManager'=> true));
		}

	}

	
	/**
	* This method handles create new video album function
	* @return  View
	* @since   2017-08-23
	* @author  NetQuick
	*/
	public function handlePost() 
	{
		
		$response = false;
		$data = Input::get();		
		$messsages = [
		'display_order.greater_than_zero'=>trans('template.videoGalleryModule.displayGreaterThan'),
		'title.required' => trans('template.videoGalleryModule.pleaseSelectTitleMessage'),
		'video_id.required' => trans('template.videoGalleryModule.pleaseSelectVideoMessage'),
		'display_order.required' => trans('template.videoGalleryModule.displayOrderMessage'),
		'chrMenuDisplay.required' => trans('template.common.thisFieldMessage')
		];
		$rules = array(
			'title' => 'required|max:160',
			'video_id' => 'required|max:3',
			'display_order' => 'required|greater_than_zero',
			'chrMenuDisplay' => 'required'
		);

		$validator = Validator::make($data, $rules, $messsages);

		if($validator->passes())
		{
			$albumID = null;
			if(!empty(trim($data['album_id'])) && $data['album_id'] != 'NULL')
			{
				$albumID = $data['album_id'];
			}

			$videoGalleryObj = array();
			$videoGalleryObj['varTitle'] = trim($data['title']);
			$videoGalleryObj['fkIntVideoId'] = $data['video_id'];
			$videoGalleryObj['fkIntAlbumId'] = 	$albumID;		
			$videoGalleryObj['intDisplayOrder'] = self::swap_order_add($data['display_order']);
			$videoGalleryObj['chrPublish'] = $data['chrMenuDisplay'];

			$videoGalleryID = CommonModel::addRecord($videoGalleryObj,'\\App\\VideoGallery');

			if(!empty($videoGalleryID)) 
			{
				$newVideoGalleryObj = VideoGallery::getRecordForLogById($videoGalleryID);

				$logArr = MyLibrary::logData($videoGalleryID);
				$logArr['varTitle'] = $newVideoGalleryObj->varTitle;
				Log::recordLog($logArr);
				if (Auth::user()->can('recent-updates-list')) {
					$notificationArr = MyLibrary::notificationData($videoGalleryID, $newVideoGalleryObj);
					RecentUpdates::setNotification($notificationArr);
				}
				self::flushCache();
			}			

			if($videoGalleryObj['fkIntAlbumId']>0)
			{
				return redirect()->route('powerpanel.video-gallery.index', ['album'=> $data['album_id'] ])->with('message', trans('template.videoGalleryModule.addVideoMessage'));
			}else{					
				return redirect()->route('powerpanel.video-gallery.index')->with('message', trans('template.videoGalleryModule.addVideoMessage'));
			}

		} else {
			return Redirect::route('powerpanel.video-gallery')->withErrors($validator)->withInput();
		}

	}

	/**
 * This method stores video album modifications
 * @return  View
 * @since   2017-08-23
 * @author  NetQuick
 */
	public function store(Request $request,Guard $auth) 
	{
			$data = Input::get();
			
			$moduleCode = Modules::getModule('video-gallery');
			$oldVideoGalleryObj = VideoGallery::getRecordForLogById($data['id']);
			$whereConditions = ['id' => $data['id']];

			$updateVideoGalleryFields = ['varTitle' => trim($data['title']),'fkIntVideoId'=> $data['videoId']];
			$update = CommonModel::updateRecords($whereConditions,$updateVideoGalleryFields,false,"\\App\\VideoGallery");

			if($update) 
			{

				if($data['id'] > 0 && !empty($data['id'])) 
				{
					self::swap_order_edit($data['order'],$data['id']);

					$newVideoGalleryObj = VideoGallery::getRecordForLogById($data['id']);
					$logArr = MyLibrary::logData($data['id'],$moduleCode->id);
					if (Auth::user()->can('log-advanced')) {
						$newVideoGalleryObj = VideoGallery::getRecordForLogById($data['id']);
						$oldRec = $this->recordHistory($oldVideoGalleryObj);
						$newRec = $this->recordHistory($newVideoGalleryObj);
						$logArr['old_val'] = $oldRec;
						$logArr['new_val'] = $newRec;
					}
					$logArr['varTitle'] = trim($data['title']);
					$logArr['action'] = 'edit';

					Log::recordLog($logArr);
					if (Auth::user()->can('recent-updates-list')) {
						if(!isset($newVideoGalleryObj)){
							$newVideoGalleryObj = VideoGallery::getRecordForLogById($data['id']);
						}
						$notificationArr = MyLibrary::notificationData($data['id'], $newVideoGalleryObj,$moduleCode->id);
						RecentUpdates::setNotification($notificationArr);
					}

					$videoGalleryObj = VideoGallery::getRecordList();
					$display_order = $videoGalleryObj->count() + 1;				
				}
				self::flushCache();
			}
			return Response::json(view('powerpanel.video_album.video_gallery', array('videoGalleryObj' => $videoGalleryObj,'display_order' => $display_order,'videoManager'=> true))->render());
			
	}

	public function update_status(Request $request,Guard $auth)
	{

			$response = array();
			$data = Input::get();

			$moduleCode = Modules::getModule('video-gallery');
			if($data['status'] == 'Y')
			{
				$videoGalleryObj = VideoGallery::getRecordForLogById($data['id']);
				$updateVideoGalleryFields = ['chrPublish' => 'N'];
				$whereConditions = ['id' => $data['id']];
				$update = CommonModel::updateRecords($whereConditions,$updateVideoGalleryFields,false,"\\App\\VideoGallery");

				if($update)
				{
					$newVideoGalleryObj = VideoGallery::getRecordForLogById($data['id']);
					$logArr = MyLibrary::logData($data['id'],$moduleCode->id);

					if (Auth::user()->can('log-advanced')) {
						$oldRec = $this->recordHistory($videoGalleryObj);
						$newRec = $this->recordHistory($newVideoGalleryObj);
						$logArr['old_val'] = $oldRec;
						$logArr['new_val'] = $newRec;
					}
					$logArr['varTitle'] = trim($newVideoGalleryObj->varTitle);
					$logArr['action'] = 'edit';

					Log::recordLog($logArr);
					/*End code for logs*/
					if (Auth::user()->can('recent-updates-list')) {
						$notificationArr = MyLibrary::notificationData($data['id'], $newVideoGalleryObj,$moduleCode->id);
						RecentUpdates::setNotification($notificationArr);
					}
					self::flushCache();
					$response['unpublish'] = trans('template.videoGalleryModule.unpublishedMessage');
				}
			}	

			if($data['status'] == 'N')
			{
				$videoGalleryObj = VideoGallery::getRecordForLogById($data['id']);
				$updateVideoGalleryFields = ['chrPublish' => 'Y'];
				$whereConditions = ['id' => $data['id']];
				$update = CommonModel::updateRecords($whereConditions,$updateVideoGalleryFields,false,"\\App\\VideoGallery");
				if($update)
				{
					$newVideoGalleryObj = VideoGallery::getRecordForLogById($data['id']);

					$logArr = MyLibrary::logData($data['id'],$moduleCode->id);
					if (Auth::user()->can('log-advanced')) {
						$oldRec = $this->recordHistory($videoGalleryObj);
						$newRec = $this->recordHistory($newVideoGalleryObj);
						$logArr['old_val'] = $oldRec;
						$logArr['new_val'] = $newRec;
					}
					$logArr['varTitle'] = $newVideoGalleryObj->varTitle;
					$logArr['action'] = 'edit';

					Log::recordLog($logArr);
					if (Auth::user()->can('recent-updates-list')) {
						$notificationArr = MyLibrary::notificationData($data['id'], $newVideoGalleryObj,$moduleCode->id);
						RecentUpdates::setNotification($notificationArr);
					}
					self::flushCache();
					$response['publish'] = trans('template.videoGalleryModule.publishedMessage');
				}
			}

		echo json_encode($response);
		exit;
	}


	/**
 * This method destroys video album
 * @return  video album index view
 * @since   2017-08-23
 * @author  NetQuick
 */
	public function destroy(Request $request,Guard $auth) 
	{
			$response = array();
			$data = Input::get();
			$id = $data['id'];

			if(!empty($id)) 
			{
				$newVideoGalleryObj = VideoGallery::getRecordById($data['id']);
				
				$moduleCode = Modules::getModule('video-gallery');
				$logArr = MyLibrary::logData($data['id'],$moduleCode->id);
				$logArr['varTitle'] = $newVideoGalleryObj->varTitle;
				Log::recordLog($logArr);

				if (Auth::user()->can('recent-updates-list')) {
					$notificationArr = MyLibrary::notificationData($data['id'], $newVideoGalleryObj,$moduleCode->id);
					RecentUpdates::setNotification($notificationArr);
				}

				$delete = VideoGallery::where('id',$id)->update(['chrPublish' => 'N','chrDelete' => 'Y']);
				if($delete)
				{
					$videoGalleryObj = VideoGallery::getRecordList();
					$display_order = $videoGalleryObj->count() + 1;
					self::flushCache();				
					return Response::json(view('powerpanel.video_album.video_gallery', array('videoGalleryObj' => $videoGalleryObj,'display_order' => $display_order,'videoManager'=> true))->render());

				}		
			}						
	}

	/**
 * This method handels swapping of available order record while adding
 * @param  	order
 * @return  order
 * @since   2017-08-23
 * @author  NetQuick
 */
	public static function swap_order_add($order=null)
	{
		$response=false;
		$order=$order;
		$rec = VideoGallery::getRecordByOrder($order);
		if(count($rec) > 0){
			$total = VideoGallery::where(['chrDelete' => 'N', 'chrPublish' => 'Y'])->count();								
			VideoGallery::where('intDisplayOrder',$order)->update(['intDisplayOrder'=>$total+1]);
			self::flushCache();
		}
		$response=$order;
		return $response;
	}

	/**
 * This method handels swapping of available order record while editing
 * @param  	order
 * @return  order
 * @since   2017-08-23
 * @author  NetQuick
 */
	public static function swap_order_edit($order=null,$id=null)
	{		
		$response=false;		
		$recEx = VideoGallery::where('intDisplayOrder',$order);
		if($recEx->count() > 0)
		{
			$recEx = $recEx->first();
			$recCur = VideoGallery::where('id',$id)->first();
			VideoGallery::where('id',$recEx['id'] )->update(['intDisplayOrder'=>$recCur->intDisplayOrder]);
			VideoGallery::where('id',$recCur['id'])->update(['intDisplayOrder'=>$recEx->intDisplayOrder]);
			self::flushCache();
		}	
	}

	/**
		* This method handels logs History records
		* @param   $data
		* @return  HTML
		* @since   2017-07-27
		* @author  NetQuick
		*/
	public function recordHistory($data=false) 
	{
		/*if($data->fkIntAlbumId > 0 && $data->fkIntAlbumId != null){
				$albumDetail = VideoAlbum::getAlbumTitleById($data->fkIntAlbumId);
				$albumTitle = ($albumDetail->varTitle != "") ? $albumDetail->varTitle:'-';
		}else{
				$albumTitle = "-";
		}*/
		if($data->fkIntVideoId > 0 && $data->fkIntVideoId != null){
				$videoDetail = Video::getVideoTitleById($data->fkIntVideoId);
				$videoTitle = ($videoDetail->varVideoName != "") ? $videoDetail->varVideoName.".".$videoDetail->varVideoExtension:'-';
		}else{
				$videoTitle = "-";
		}
			
			$returnHtml = '';
			$returnHtml.= '<table class="new_table_desing table table-striped table-bordered table-hover">
									<thead>
											<tr>
													<th>'.trans("template.common.title").'</th>
													<th>'.trans("template.common.video").'</th>
													<th>'.trans("template.common.order").'</th>
													<th>'.trans("template.common.publish").'</th>
											</tr>
									</thead>
									<tbody>
											<tr>
													<td>' . $data->varTitle . '</td>
													<td>' . $videoTitle . '</td>';
													$returnHtml.= '<td>' . ($data->intDisplayOrder) . '</td>
													<td>'.$data->chrPublish.'</td>
											</tr>
									</tbody>
							</table>';
			return $returnHtml;
	}	
	public static function flushCache(){
			Cache::tags(['VideoAlbums','VideoGallery'])->flush();
	}
}