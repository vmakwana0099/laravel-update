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
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Helpers\resize_image;
use App\Helpers\MyLibrary;
use App\Log;
use App\PhotoAlbum;
use App\RecentUpdates;
use App\Alias;
use Config;
use App\CommonModel;
use App\Helpers\AddImageModelRel;
use App\PhotoGallery;
use Cache;

class PhotoAlbumController extends PowerpanelController 
{
	
	public function __construct() 
	{
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}

 /**
 * This method handels load process of photo album
 * @return  view
 * @since   2017-01-03
 * @author  NetQuick
 */
	public function index() 
	{		
		$iTotalRecords = CommonModel::getRecordCount();
		$this->breadcrumb['title']=trans('template.photoAlbum.managePhotoAlbums');
		return view('powerpanel.photo_album.list',['iTotalRecords'=>$iTotalRecords,'breadcrumb'=>$this->breadcrumb]);
	}

	/**
	 * This method loads photo album table data on view
	 * @return  View
	 * @since   2017-01-03
	 * @author  NetQuick
	 */
	public function get_list() 
	{
		$filterArr = [];
		$records = [];
		$records["data"] = [];
		$filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
		$filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
		$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
		$filterArr['statusFilter'] = !empty(Input::get('customActionName')) ? Input::get('customActionName') : '';
		$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
		$filterArr['showFilter'] = !empty(Input::get('showFilter')) ? Input::get('showFilter') : '';
		$filterArr['rangeFilter'] = !empty(Input::get('rangeFilter')) ? Input::get('rangeFilter') : '';
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		
		$arrResults = PhotoAlbum::getRecordList($filterArr);
		$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		if (!empty($arrResults) && count($arrResults) > 0) 
		{
				foreach ($arrResults as $key => $value) 
				{
					$records["data"][] = $this->tableData($value);
				}
		}
		$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);		
	}


/**
 * This method loads photo album edit view
 * @param   Alias of record
 * @return  View
 * @since   2017-01-03
 * @author  NetQuick
 */
	public function edit($alias = false) 
	{
		$id = $alias;
		$imageManager	 = true;
		if(is_numeric($id) && !empty($id))
		{
			$photo_album = PhotoAlbum::getRecordById($id);
			if(count($photo_album)==0){ return redirect()->route('powerpanel.photo-album.add'); }
			$metaInfo = array(
				'varMetaTitle' => $photo_album->varMetaTitle,
				'varMetaKeyword' => $photo_album->varMetaKeyword,
				'varMetaDescription' => $photo_album->varMetaDescription
			);
			$this->breadcrumb['title']=trans('template.common.edit').' - '.$photo_album->varTitle;
			$this->breadcrumb['module']=trans('template.photoAlbum.managePhotoAlbums');
			$this->breadcrumb['url']='powerpanel/photo-album';
			$this->breadcrumb['inner_title']=trans('template.common.edit').' - '.$photo_album->varTitle;	
			$breadcrumb = $this->breadcrumb;

			$data = compact('photo_album', 'metaInfo', 'breadcrumb','imageManager');

		}else{

			$total= CommonModel::getRecordCount();				
			$total=$total+1;
			$this->breadcrumb['title']=trans('template.photoAlbum.addPhotoAlbum');
			$this->breadcrumb['module']=trans('template.photoAlbum.managePhotoAlbums');
			$this->breadcrumb['url']='powerpanel/photo-album';
			$this->breadcrumb['inner_title']=trans('template.photoAlbum.addPhotoAlbum');
			$breadcrumb = $this->breadcrumb;
			$data=compact('total', 'breadcrumb','imageManager');

		}
		
		return view('powerpanel.photo_album.actions',$data);
	}

	/**
 * This method stores photo album modifications
 * @return  View
 * @since   2017-01-03
 * @author  NetQuick
 */
	public function handlePost(Request $request) 
	{

		$data = Input::get();
		$actionMessage = trans('template.common.oppsSomethingWrong');
		$messsages = $this->serverSideValidationMessages();
		$rules = $this->serverSideValidationRules();
		$validator = Validator::make($data, $rules, $messsages);
		if($validator->passes())
		{

			$photoAlbumArr = [];
			$photoAlbumArr['varTitle'] = trim($data['title']);
			$photoAlbumArr['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
			$photoAlbumArr['txtDescription'] = $data['description'];
			$photoAlbumArr['intDisplayOrder'] = self::swap_order_add($request->display_order);
			$photoAlbumArr['chrPublish'] = $data['chrMenuDisplay'];
			$photoAlbumArr['varMetaTitle'] = trim($data['varMetaTitle']);
			$photoAlbumArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
			$photoAlbumArr['varMetaDescription'] = trim($data['varMetaDescription']);
			

			$id = $request->segment(3);

			if(is_numeric($id) && !empty($id))
			{
				if($data['oldAlias'] != $data['alias']){
					Alias::updateAlias($data['oldAlias'], $data['alias']);	
				}
				$photoAlbumObj = PhotoAlbum::getRecordForLogById($id);
				$whereConditions = ['id' => $photoAlbumObj->id];
				$update = CommonModel::updateRecords($whereConditions, $photoAlbumArr);	
				if($update) 
				{

					if($photoAlbumObj->id > 0 && !empty($photoAlbumObj->id)) 
					{
						Self::swap_order_edit($data['display_order'],$photoAlbumObj->id);
						
						$logArr = MyLibrary::logData($photoAlbumObj->id);
						if (Auth::user()->can('log-advanced')) {
							$newPhotoAlbumObj = PhotoAlbum::getRecordForLogById($photoAlbumObj->id);
							$oldRec = $this->recordHistory($photoAlbumObj);
							$newRec = $this->recordHistory($newPhotoAlbumObj);
							$logArr['old_val'] = $oldRec;
							$logArr['new_val'] = $newRec;
						}

						$logArr['varTitle'] = trim($data['title']);
						Log::recordLog($logArr);
						if (Auth::user()->can('recent-updates-list')) {
							if(!isset($newPhotoAlbumObj)){
								$newPhotoAlbumObj = PhotoAlbum::getRecordForLogById($photoAlbumObj->id);
							}
							$notificationArr = MyLibrary::notificationData($photoAlbumObj->id, $newPhotoAlbumObj);
							RecentUpdates::setNotification($notificationArr);
						}
						self::flushCache();
					}
					$actionMessage = trans('template.photoAlbum.updateMessage');
				}

			}else{
					$photoAlbumArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
					$photoAlbumArr['created_at'] = Carbon::now();
					$photoAlbumID = CommonModel::addRecord($photoAlbumArr);
					if(!empty($photoAlbumID)) 
					{
						$id=$photoAlbumID;
						$newPhotoAlbumObj = PhotoAlbum::getRecordForLogById($id);

						$logArr = MyLibrary::logData($id);
						$logArr['varTitle'] = $newPhotoAlbumObj->varTitle;
						Log::recordLog($logArr);
						
						if (Auth::user()->can('recent-updates-list')) {
							$notificationArr = MyLibrary::notificationData($id, $newPhotoAlbumObj);
							RecentUpdates::setNotification($notificationArr);
						}
						self::flushCache();
						$actionMessage = trans('template.photoAlbum.addedMessage');
					}

			}
			AddImageModelRel::sync(explode(',', $data['img_id']), $id);
			if(!empty($request->saveandexit) && $request->saveandexit == 'saveandexit'){
				return redirect()->route('powerpanel.photo-album.index')->with('message', $actionMessage);
			}else{					
				return redirect()->route('powerpanel.photo-album.edit',$id)->with('message', $actionMessage);
			}

		} else {
			return Redirect::back()->withErrors($validator)->withInput();
		}
	}
	
	public function publish(Request $request)
	{
		$alias = Input::get('alias');
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
 * This method destroys photo album in multiples
 * @return  photo album index view
 * @since   2017-01-03
 * @author  NetQuick
 */
	public function DeleteRecord(Request $request)
	{
		$data = $request->all('ids');
		$update = MyLibrary::deleteMultipleRecords($data);
		self::flushCache();
		echo json_encode($update);
		exit;
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
		$response = false;
		if ($order != null) {
				$response = MyLibrary::swapOrderAdd($order);
				self::flushCache();
		}
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
			MyLibrary::swapOrderEdit($order, $id);
			self::flushCache();
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
													<th>'.trans("template.common.description") . '</th>
													<th>'.trans("template.common.metatitle") . '</th>
													<th>'.trans("template.common.metakeyword") . '</th>
													<th>'.trans("template.common.metadescription") . '</th>
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
													<td>' . $data->txtDescription . '</td>
													<td>'.$data->varMetaTitle.'</td>
													<td>'.$data->varMetaKeyword.'</td>
													<td>'.$data->varMetaDescription.'</td>
													<td>'.$data->chrPublish.'</td>
											</tr>
									</tbody>
							</table>';
			return $returnHtml;
	}

	public function tableData($value)
	{
			$details = '';
			$publish_action='';
			if(Auth::user()->can('photo-album-edit')) {
				$details.='<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="'.route('powerpanel.photo-album.edit',array('alias' => $value->id)) .'"><i class="fa fa-pencil"></i></a>';
			}
			
			if(Auth::user()->can('photo-album-delete')) {
				$details.='&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="photo-album" data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
			}

			if(Auth::user()->can('photo-album-publish')) 
			{
				if(!empty($value->chrPublish) && ($value->chrPublish == 'Y')){
					$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/photo-album" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
				}else{
					$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/photo-album" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
				}
			}	

			$imgIcon='';
			if(!empty($value->fkIntImgId) && $value->fkIntImgId > 0)
			{
				$imgIcon .= '<a href="'.resize_image::resize($value->fkIntImgId).'" class="fancybox-buttons" data-rel="fancybox-buttons">';
				$imgIcon .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) .'" src="'.resize_image::resize($value->fkIntImgId,50,50).'"/>';
				$imgIcon .= '</a>';
			}else{
				$imgIcon .= '<span class="glyphicon glyphicon-minus"></span>';
			}

			if(Auth::user()->can('photo-album-edit')) {	
				$title = '<a class="" title="'.trans("template.common.edit").'" href="'.route('powerpanel.photo-album.edit',array('alias' => $value->id)) .'">'.$value->varTitle.'</a>';
			}else{
				$title = $value->varTitle;
			}

			$albumImagesCount = PhotoGallery::getCountById($value->id);
			if(Auth::user()->can('photo-gallery-create')) {
				$photoGallery = '<a class="" title="'.trans("template.photoAlbum.addViewPhotos").'" href="'.url('powerpanel/photo-gallery?album='. $value->id).'">'.trans("template.photoAlbum.addViewPhotos").' ('.$albumImagesCount.')</a>';
			}else{
				$photoGallery = '-';
			}

			$records = array(					
					'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',					
					$title,
					'<div class="pro-act-btn">
					<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.description").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
					<div class="highslide-maincontent">' . $value->txtDescription . '</div>
					</div>',
					$imgIcon,					
					$photoGallery,
					'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
					'.$value->intDisplayOrder.
					' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
					$publish_action,
					$details,
					$value->intDisplayOrder
			);

			return $records;
	}

	public function serverSideValidationRules()
		{
				$rules = array(
					'title' => 'required|max:160',
					'img_id' => 'required|max:3',
					'display_order' => 'required|greater_than_zero',
					'chrMenuDisplay' => 'required',
					'varMetaTitle' => 'required|max:500',
					'varMetaKeyword' => 'required|max:500',
					'varMetaDescription' =>  'required|max:500',
					'alias'=>'required'
				);

				return $rules;
		}

		public function serverSideValidationMessages()
		{
				$messsages = array(
					'img_id.required'=> trans('template.photoAlbum.ImageValidation'),
					'display_order.greater_than_zero' => trans('template.photoAlbum.displayGreaterThan'),
					'short_description.required'  => trans('template.photoAlbum.shortDescription'),
					'varMetaTitle.required'       => trans('template.photoAlbum.metaTitle'),
					'varMetaKeyword.required'     => trans('template.photoAlbum.metaKeyword'),
					'varMetaDescription.required' => trans('template.photoAlbum.metaDescription'),
											);
				return $messsages;
		}

		public Static function flushCache(){				
			Cache::tags('PhotoAlbum')->flush();
		}

}