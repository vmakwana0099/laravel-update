<?php
/**
* The MenuController class handels Photo album
* configuration  process.
* @package   Netquick powerpanel
* @license   http://www.opensource.org/licenses/BSD-3-Clause
* @version   1.00
* @since     2017-01-03
* @author    NetQuick
*/
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use Response;
use Request as AjaxRequest;
use Auth;
use App\Log;
use App\RecentUpdates;
use App\Alias;
use App\CommonModel;
use App\PhotoGallery;
use App\PhotoAlbum;
use App\Modules;
use App\Helpers\MyLibrary;
use App\Helpers\AddImageModelRel;
use App\Helpers\resize_image;
use Carbon\Carbon;
use Cache;


class PhotoGalleryController extends PowerpanelController {
	
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
	/**
 * This method handels photo gallery features
 * @param  	alias
 * @return  true/false
 * @since   2017-01-03
 * @author  NetQuick
 */
	public function index() 
	{	

		$album = null;
		$albumId = null;
		$albumId = Input::get('album');
		
		if($albumId != null)
		{
			$album = PhotoAlbum::getRecordById($albumId);
			$photoGalleryObj = PhotoGallery::getRecordByAlbumID($albumId);
		}else{
			$photoGalleryObj = PhotoGallery::getRecordList();
		}

		$display_order = $photoGalleryObj->count() + 1;

		$photoAlbumObj = PhotoAlbum::getRecordList()->toArray();
		$this->breadcrumb['title']=$album!==null?trans('template.photoGalleryModule.addPhoto').' - '.$album->varTitle:trans('template.common.photoGallery');
		$this->breadcrumb['module']=$album!==null?trans('template.common.managePhotoAlbums'):trans('template.common.gallery');
		$this->breadcrumb['url']=$album!==null?'powerpanel/photo-album':'#';
		$this->breadcrumb['inner_title']=$album!==null?trans('template.photoGalleryModule.addPhoto').' - '.$album->varTitle:trans('template.common.gallery');

		if(AjaxRequest::ajax()) {
			return Response::json(view('powerpanel.photo_album.photo_gallery', array('photoGalleryObj' => $photoGalleryObj,'display_order' => $display_order,'breadcrumb'=>$this->breadcrumb,'imageManager'=> true))->render());
		}else{
			return view('powerpanel.photo_album.manage_photo_gallery',array('photoAlbumObj' => $photoAlbumObj,'photoGalleryObj' => $photoGalleryObj,'display_order' => $display_order,'breadcrumb'=>$this->breadcrumb,'imageManager'=> true));
		}
	}
	/**
	* This method handles create new photo album function
	* @return  View
	* @since   2017-01-03
	* @author  NetQuick
	*/
	public function handlePost() 
	{
		$response = false;
		$data = Input::get();		
		$messsages = [
		'display_order.greater_than_zero'=>trans('template.photoGalleryModule.displayGreaterThan'),
		'title.required' => trans('template.photoGalleryModule.pleaseSelectTitleMessage'),
		'img_id.required' => trans('template.photoGalleryModule.pleaseSelectImageMessage'),
		'display_order.required' => trans('template.photoGalleryModule.displayOrderMessage'),
		'chrMenuDisplay' => trans('template.photoGalleryModule.pleaseSelectMenuMessage'),
		];
		
		$rules = [
			'title' => 'required|max:160',
			'img_id' => 'required|max:3',
			'display_order' => 'required|greater_than_zero',
			'chrMenuDisplay' => 'required'
		];

		$validator = Validator::make($data, $rules, $messsages);

		if($validator->passes())
		{	

			$albumID = NULL;

			if(!empty($data['album_id']) && is_numeric($data['album_id']))
			{
				$albumID = $data['album_id'];
			}

			$photoGalleryArr = array();
			$photoGalleryArr['varTitle'] =  trim($data['title']);
			$photoGalleryArr['fkIntAlbumId'] = $albumID; 
			$photoGalleryArr['fkIntImgId'] = $data['img_id']; 
			$photoGalleryArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
			$photoGalleryArr['chrPublish'] = $data['chrMenuDisplay'];	
			$photoGalleryArr['created_at'] = Carbon::now();				
			$photoGalleryID = CommonModel::addRecord($photoGalleryArr,'\\App\\PhotoGallery');

			if(!empty($photoGalleryID)) 
			{
				$newPhotoGalleryObj = PhotoGallery::getRecordForLogById($photoGalleryID);
				$logArr = MyLibrary::logData($photoGalleryID);
				$logArr['varTitle'] = trim($data['title']);

				Log::recordLog($logArr);
				if (Auth::user()->can('recent-updates-list')) {
					$notificationArr = MyLibrary::notificationData($photoGalleryID, $newPhotoGalleryObj);
					RecentUpdates::setNotification($notificationArr);
				}
				self::flushCache();
			}
			AddImageModelRel::sync(explode(',', $data['img_id']),$photoGalleryID);	
			if($photoGalleryArr['fkIntAlbumId']>0)
			{
				return redirect()->route('powerpanel.photo-gallery.index', ['album'=> $data['album_id'] ])->with('message', trans('template.photoGalleryModule.photoGallerySuccessMessage'));
			}else{					
				return redirect()->route('powerpanel.photo-gallery.index')->with('message', trans('template.photoGalleryModule.photoGallerySuccessMessage'));
			}

		} else {
			return Redirect::route('powerpanel.photo-gallery')->withErrors($validator)->withInput();
		}

	}

	/**
 * This method stores photo album modifications
 * @return  View
 * @since   2017-01-03
 * @author  NetQuick
 */
	public function store(Request $request) 
	{	

		$data = Input::get();

		$moduleCode = Modules::getModule('photo-gallery');
		$oldPhotoGalleryObj = PhotoGallery::getRecordForLogById($data['id']);

		$whereConditions = ['id' => $data['id']];
		$updatePhotoGalleryFields = ['varTitle' => trim($data['title']),'fkIntImgId'=> $data['imgId']];
		$update = CommonModel::updateRecords($whereConditions,$updatePhotoGalleryFields,false,"\\App\\PhotoGallery");

		if($update) 
		{
			$id = $data['id'];
			if($data['id'] > 0 && !empty($data['id'])) 
			{
				self::swap_order_edit($data['order'],$data['id']);	
				
				$logArr = MyLibrary::logData($data['id'],$moduleCode->id);
				if (Auth::user()->can('log-advanced')) {
					$newPhotoGalleryObj = PhotoGallery::getRecordForLogById($data['id']);
					$oldRec = $this->recordHistory($oldPhotoGalleryObj);
					$newRec = $this->recordHistory($newPhotoGalleryObj);
					$logArr['old_val'] = $oldRec;
					$logArr['new_val'] = $newRec;
				}
				$logArr['varTitle'] = trim($data['title']);
				$logArr['action'] = 'edit';
				Log::recordLog($logArr);

				if (Auth::user()->can('recent-updates-list')) {
					if(!isset($newPhotoGalleryObj)){
						$newPhotoGalleryObj = PhotoGallery::getRecordForLogById($data['id']);
					}
					$notificationArr = MyLibrary::notificationData($data['id'], $newPhotoGalleryObj,$moduleCode->id);
					RecentUpdates::setNotification($notificationArr);
				}
				self::flushCache();
			}
      AddImageModelRel::sync(explode(',', $data['img_id']), $id);
			$photoGalleryObj = PhotoGallery::getRecordList();	
			$display_order = $photoGalleryObj->count() + 1;
			return Response::json(view('powerpanel.photo_album.photo_gallery', array('photoGalleryObj' => $photoGalleryObj,'display_order' => $display_order,'imageManager'=> true ))->render());
		}
	}

	public function update_status(Request $request)
	{
			$response = array();
			$data = Input::get();

			$moduleCode = Modules::getModule('photo-gallery');
			if($data['status'] == 'Y')
			{
				$photoGalleryObj = PhotoGallery::getRecordForLogById($data['id']);
				$updatePhotoGalleryFields = ['chrPublish' => 'N'];
				$whereConditions = ['id' => $data['id']];
				$update = CommonModel::updateRecords($whereConditions,$updatePhotoGalleryFields,false,"\\App\\PhotoGallery");
				if($update)
				{
					$newPhotoGalleryObj = PhotoGallery::getRecordForLogById($data['id']);

					$logArr = MyLibrary::logData($data['id'],$moduleCode->id);
					if (Auth::user()->can('log-advanced')) {
						$oldRec = $this->recordHistory($photoGalleryObj);
						$newRec = $this->recordHistory($newPhotoGalleryObj);
						$logArr['old_val'] = $oldRec;
						$logArr['new_val'] = $newRec;
					}

					$logArr['varTitle'] = $newPhotoGalleryObj->varTitle;
					$logArr['action'] = 'edit';
					Log::recordLog($logArr);

					if (Auth::user()->can('recent-updates-list')) {
						$notificationArr = MyLibrary::notificationData($data['id'], $newPhotoGalleryObj,$moduleCode->id);
						RecentUpdates::setNotification($notificationArr);
					}
					self::flushCache();
					$response['unpublish'] = trans('template.photoGalleryModule.unpublishedMessage');
				}
			}	
			if($data['status'] == 'N')
			{
				$photoGalleryObj = PhotoGallery::getRecordForLogById($data['id']);
				$updatePhotoGalleryFields = ['chrPublish' => 'Y'];
				$whereConditions = ['id' => $data['id']];
				$update = CommonModel::updateRecords($whereConditions,$updatePhotoGalleryFields,false,"\\App\\PhotoGallery");
				if($update)
				{
					$newPhotoGalleryObj = PhotoGallery::getRecordForLogById($data['id']);

					$logArr = MyLibrary::logData($data['id'],$moduleCode->id);
					if (Auth::user()->can('log-advanced')) {
						$oldRec = $this->recordHistory($photoGalleryObj);
						$newRec = $this->recordHistory($newPhotoGalleryObj);
						$logArr['old_val'] = $oldRec;
						$logArr['new_val'] = $newRec;
					}
					$logArr['action'] = 'edit';
					$logArr['varTitle'] = $newPhotoGalleryObj->varTitle;

					Log::recordLog($logArr);
					if (Auth::user()->can('recent-updates-list')) {
						$notificationArr = MyLibrary::notificationData($data['id'], $newPhotoGalleryObj,$moduleCode->id);
						RecentUpdates::setNotification($notificationArr);
					}
					self::flushCache();
					$response['publish'] = trans('template.photoGalleryModule.publishedMessage');
				}
			}
			echo json_encode($response);
			exit;
	}

	/**
 * This method destroys photo album
 * @return  photo album index view
 * @since   2017-01-03
 * @author  NetQuick
 */
	public function destroy(Request $request) 
	{
			$response = array();
			$data = Input::get();

			$id = $data['id'];
			if(!empty($id)) 
			{
				$newPhotoGalleryObj = PhotoGallery::getRecordById($data['id']);

				$moduleCode = Modules::getModule('photo-gallery');
				$logArr = MyLibrary::logData($data['id'],$moduleCode->id);
				$logArr['varTitle'] = $newPhotoGalleryObj->varTitle;
				Log::recordLog($logArr);
			
				if (Auth::user()->can('recent-updates-list')) {
					$notificationArr = MyLibrary::notificationData($data['id'], $newPhotoGalleryObj,$moduleCode->id);
					RecentUpdates::setNotification($notificationArr);
				}
				$delete = PhotoGallery::where('id',$id)->update(['chrPublish' => 'N','chrDelete' => 'Y']);
				if($delete)
				{
					$photoGalleryObj = PhotoGallery::getRecordList();
					$display_order = $photoGalleryObj->count() + 1;
					self::flushCache();
					return Response::json(view('powerpanel.photo_album.photo_gallery', array('photoGalleryObj' => $photoGalleryObj,'display_order' => $display_order,'imageManager'=> true ))->render());
				}	
			}	
	}						
	/**
 * This method handels swapping of available order record while adding
 * @param  	order
 * @return  order
 * @since   2017-01-03
 * @author  NetQuick
 */
	public static function swap_order_add($order=null)
	{
		$response=false;
		$order=$order;
		$rec = PhotoGallery::getRecordByOrder($order);
		if(count($rec) > 0){
			$total = PhotoGallery::where(['chrDelete' => 'N', 'chrPublish' => 'Y'])->count();								
			PhotoGallery::where('intDisplayOrder',$order)->update(['intDisplayOrder'=>$total+1]);
			self::flushCache();
		}
		$response=$order;
		return $response;
	}

	/**
 * This method handels swapping of available order record while editing
 * @param  	order
 * @return  order
 * @since   2017-01-03
 * @author  NetQuick
 */
	public static function swap_order_edit($order=null,$id=null)
	{		
		$response=false;		
		$recEx = PhotoGallery::getRecordByOrder($order);
		if(count($recEx) > 0)
		{
			$recEx = $recEx;
			$recCur = PhotoGallery::getRecordById($id);
			PhotoGallery::where('id',$recEx['id'])->update(['intDisplayOrder'=>$recCur->intDisplayOrder]);
			PhotoGallery::where('id',$recCur['id'])->update(['intDisplayOrder'=>$recEx->intDisplayOrder]);
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
			
			$returnHtml = '';
			$returnHtml.= '<table class="new_table_desing table table-striped table-bordered table-hover">
									<thead>
											<tr>
													<th>'.trans("template.common.title").'</th>
													<th>'.trans("template.common.image").'</th>
													<th>'.trans("template.common.order").'</th>
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
													$returnHtml.= '<td>' . ($data->intDisplayOrder) . '</td>
													<td>'.$data->chrPublish.'</td>
											</tr>
									</tbody>
							</table>';
			return $returnHtml;
	}

	public static function flushCache(){		
		Cache::tags('PhotoGallery')->flush();		
	}

}