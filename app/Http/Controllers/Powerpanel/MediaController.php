<?php

namespace App\Http\Controllers\Powerpanel;

use App\CommonModel;
use App\Helpers\resize_image;
use App\Http\Controllers\PowerpanelController;
use App\Http\Traits\slug;
use App\Image;
use App\ImgModuleRel;
use App\VideoModuleRel;
use App\DocumentModuleRel;
use App\Document;
use App\Video;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Input;
use Config;

class MediaController extends PowerpanelController
{

		public $_APP_URL;
		protected $url;

		/**
		 * Create a new controller instance.
		 * @return void
		 */
		public function __construct(UrlGenerator $url)
		{
				$this->url      = $url->to('/');
				$this->_APP_URL = Config::get('Constant.ENV_APP_URL');
				parent::__construct();
				if (isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}
		}

		public function set_image_html()
		{
				$html = '<div class="title_section"><h2>Upload Image</h2></div>
									<div class="portlet light">
										<div class="scroller">
											<div class="row">
												<div class="col-md-12">
													<form name="filename"  enctype="multipart/form-data" class="drop_border dropzone dropzone-file-area" id="my-dropzone">
														<div class="dz-message needsclick">
															<div class="dropzone_icon">
																<i class="icon-cloud-upload icons"></i>
															</div>
															<h3 class="sbold">Drop files here or click to upload image</h3>
															<p>Select file to upload</p>
														</div>
													</form>
													<br/>
													<div class="text-center">
														<a href="javascript:;" onclick="MediaManager.setMyUploadTab(' . Auth::user()->id . ')" class="btn btn-green-drake">Go to User Gallery</a>
														<br/>
														<br/>
														<p><strong>Note:</strong> You can upload 15 images at one time and maximum upload file size is 10MB.</p>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>';
				echo $html;
				exit;
		}

		public function set_video_html()
		{
			
				$html = '<div class="title_section"><h2>Upload Video</h2></div>
									<div class="portlet light">
										<div class="scroller gallery">
											<div class="row">
												<div class="col-md-12">
													<form name="filename"  enctype="multipart/form-data" class="drop_border dropzone dropzone-file-area" id="my-dropzone-video">
														<div class="dz-message needsclick">
															<div class="dropzone_icon">
																<i class="icon-cloud-upload icons"></i>
															</div>
															<h3 class="sbold">Drop files here or click to upload video</h3>
															<p>Select file to upload</p>
														</div>
													</form>
													<br/>
													<div class="text-center">
														<a href="javascript:;" onclick="MediaManager.setMyVideosTab(' . Auth::user()->id . ')" class="btn btn-green-drake">Go to Video Gallery</a>
														<br/>
														<br/>
														<p><strong>Note:</strong> You can upload 15 videos at one time and maximum upload file size is 10MB.</p>
													</div>
												</div>
											</div>
										</div>
									</div>';

				echo $html;
				exit;
		}

		public function set_document_uploader()
		{
				$html = '<div class="title_section"><h2>Upload Document(s)</h2></div>
									<div class="portlet light">
										<div class="scroller">
											<div class="row">
												<div class="col-md-12">
													<form name="filename"  enctype="multipart/form-data" class="drop_border dropzone dropzone-file-area" id="my-dropzone-document">
														<div class="dz-message needsclick">
															<div class="dropzone_icon">
																<i class="icon-cloud-upload icons"></i>
															</div>
															<h3 class="sbold">Drop files here or click to upload document(s)</h3>
															<p>Select file to upload</p>
														</div>
													</form>
													<br/>
													<div class="text-center">
														<a href="javascript:;" onclick="MediaManager.setDocumentListTab('. Auth::user()->id.')" class="btn btn-green-drake">Go to User Document Gallery</a>
														<br/>
														<br/>
														<p><strong>Note:</strong> You can upload 15 document(s) at one time and maximum upload file size is 10MB.</p>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>';
				echo $html;
				exit;
		}

		public function upload_image()
		{
				$respose = false;
				if (Input::file('file')) {

						$file = Input::file('file');

						$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
						$pathinfo  = pathinfo($file->getClientOriginalName());

						$name = $timestamp . '-' . self::clean($pathinfo['filename']);

						$file->move(public_path().'/assets/images/', $name . '.' . $pathinfo['extension']);

						$imageArr                      = array();
						$imageArr['fkIntUserId']       = Auth::user()->id;
						$imageArr['txtImageName']      = trim($name);
						$imageArr['txtImgOriginalName'] = trim($pathinfo['filename']);
						$imageArr['varImageExtension'] = $pathinfo['extension'];
						$imageArr['chrIsUserUploaded'] = 'Y';
						$imageArr['created_at']        = Carbon::now();

						$imageID = CommonModel::addRecord($imageArr, '\\App\\Image');

						$response = $imageID;
				} else {
						$response = 'File Not Found';
				}
				echo $response;
				exit;
		}

		public function upload_video()
		{

				$respose = false;
				if (Input::file('file')) 
				{
						$file = Input::file('file');

						$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
						$pathinfo  = pathinfo($file->getClientOriginalName());

						$name = $timestamp . '-' . self::clean($pathinfo['filename']);

						$file->move(public_path().'/assets/videos/', $name . '.' . $pathinfo['extension']);

						$slug = slug::create_slug($name);
						$user = Auth::user();

						$video                    = new Video;
						$video->fkIntUserId       = $user->id;
						$video->varVideoExtension = $pathinfo['extension'];
						$video->varVideoName      = $name;
						$video->txtVideoOriginalName = trim($pathinfo['filename']);
						$video->chrIsUserUploaded = 'Y';
						$video->save();

						$response = $video->id;
				} else {
						$response = 'File Not Found';
				}

				echo $response;
				exit;
		}

		public function upload_documents()
		{
				$respose = false;
				if (Input::file('file')) 
				{
						$file = Input::file('file');

						$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
						$pathinfo  = pathinfo($file->getClientOriginalName());

						$name = $timestamp . '-' . self::clean($pathinfo['filename']);

						$file->move(public_path().'/documents/', $name . '.' . $pathinfo['extension']);

						$documentsFieldsArr            = array();
						$documentsFieldsArr['fkIntUserId']       = Auth::user()->id;
						$documentsFieldsArr['txtDocumentName']      = self::clean($pathinfo['filename']);
						$documentsFieldsArr['txtSrcDocumentName']      = trim($name);
						$documentsFieldsArr['varDocumentExtension'] = $pathinfo['extension'];
						$documentsFieldsArr['chrIsUserUploaded'] = 'Y';
						$documentsFieldsArr['created_at']        = Carbon::now();

						$documentID = CommonModel::addRecord($documentsFieldsArr, '\\App\\Document');

						$response = $documentID;

				} else {
						$response = 'File Not Found';
				}
				echo $response;
				exit;
		}

		public function user_uploaded_image()
		{
				$response = array();
				if (Input::get('userid')) 
				{
						$user_id    = Input::get('userid');
						$imageName  = (null !== Input::get('imageName'))?:'';
						$limit      = 18;
						$page       = 1;
						$filterArr = array();
						$filterArr['imageName'] = $imageName;
						$images     = Image::getImages($limit, $page,0,$filterArr);
						$Image_html = $this->getImageHtml($images, 'User Gallery',$filterArr);
						$response['Image_html']  = $Image_html;
						$response['imageCount']  = count($images);
				}
				//print_r($Image_html);
				//exit();

				echo json_encode($response);
				exit;
		}

		public function load_more_images($userid = false)
		{

				$response      = false;
				$item_per_page = 18;
				$page_number   = filter_var(Input::get('page'), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);


				if (!is_numeric($page_number)) {
						header('HTTP/1.1 500 Invalid page number!');
						exit();
				}

				$position    = (($page_number - 1) * $item_per_page) + 1;
				$more_images = Image::getImages($item_per_page, $page_number, $position);

				$Image_html = '';
				if ($more_images->count() > 0) {
						
						foreach ($more_images as $key => $value) {
								$img_path = public_path().'/assets/images/' . $value->txtImageName . '.' . $value->varImageExtension;
								if (file_exists($img_path)) {
										$image_url = resize_image::resize($value->id);
										$Image_html .= "<div class='img-box contains_thumb' id='media_" . $value->id . "'>
																			 <div class='thumbnail_container'>
																					<div class='thumbnail' id='media_image_" . $value->id . "'>
																					 <a  title='" . $value->txtImgOriginalName . "' href='javascript:void(0);' onclick=\"MediaManager.selectImage('" . $value->id . "')\" >
																									 <img alt='" . $value->txtImgOriginalName . "' src='" . $image_url . "'>
																									 <span class='icon-check' aria-hidden='true'></span>
																							</a>
																							</div>
																					</div>
																					<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
																			</div>";
								}
						}
				}
				
				$response['image_box'] = $Image_html;
				$response['imageCount'] = count($more_images);

				echo json_encode($response);
				exit;
		}

		public function user_uploaded_video()
		{
				$response  = false;
				$vidoeHtml = '';
				if (Input::get('userid')) 
				{
						$user_id = Input::get('userid');
						$limit   = 18;
						$page    = 1;
						$videos  = Video::getRecords()->publish()->deleted()->take($limit, $page)->orderBy('id', 'DESC')->get();
						$vidoeHtml .= '<div class="title_section">
							<h2>Video Gallery</h2>';
						$vidoeHtml .= '<div class="pull-right">';
						if ($videos->count() > 0) {
								$vidoeHtml .= '<a class="btn btn-green-drake" id="insert_video" onclick="MediaManager.insertVideo();" href="javascript:void(0);" style="padding:4px 12px">Insert Media</a>&nbsp;';
								$vidoeHtml .= '<a style="padding:4px 12px;margin-right:10px;" class="btn btn-green-drake" id="delete_video" onclick=\'MediaManager.openConfirmBox("video");\' href="javascript:void(0);" >Delete</a>';
						}
						$vidoeHtml .= '</div></div><div class="clearfix"></div>';
						if ($videos->count() > 0) {
								$vidoeHtml .= '<div class="portlet light">
									<div class="scroller gallery">
										<div id="append_user_image">';
								foreach ($videos as $key => $value) {
										if (isset($value->youtubeId) && !empty($value->youtubeId)) {
												$vidoeHtml .= "<div class='img-box video_thumb contains_thumb' data-video_name='" . $value->varVideoName . "' id='video_" . $value->id . "' data-video_type='youtube' data-video_source='".$value->youtubeId."'>
												<div class='thumbnail_container'>
													<div class='thumbnail' id='media_image_" . $value->id . "' >
														<img src='http://img.youtube.com/vi/" . $value->youtubeId . "/default.jpg' />
													</div>
												</div>
												<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
												<div class='video_overflow'>
													<a title='" . $value->varVideoName . "' href='http://www.youtube.com/embed/" . $value->youtubeId . "?autoplay=1' class='link fancybox fancybox.iframe icns_set' data-fancybox-group='gallery'><span class='fa fa-play'></span></a>
													<button title='Please select video and click on Insert Media button' class='icns_set' onclick=\"MediaManager.selectVideo('" . $value->id . "')\">
													<span class='fa fa-hand-pointer-o'></span>
													</button>
												</div>
											</div>";
										} else {
												$video_path = public_path().'/assets/videos/' . $value->varVideoName . '.' . $value->varVideoExtension;
												if (file_exists($video_path)) {
														$vidoeHtml .= "<div class='img-box video_thumb contains_thumb' data-video_name ='" . $value->txtVideoOriginalName . '.' . $value->varVideoExtension . "'  id='video_" . $value->id . "' data-video_type='normal' data-video_source='" . url('/') . '/assets/videos/' . $value->varVideoName . '.' . $value->varVideoExtension . "?autoplay=1'>
												<div class='thumbnail_container'>
													<div class='thumbnail' id='media_image_" . $value->id . "'>
														<img src='" . $this->_APP_URL . "/resources/images/video_thumb_icon.png' />
													</div>
												</div>
												<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
												<div class='video_overflow'>
													<a title='" . $value->txtVideoOriginalName . '.' . $value->varVideoExtension . "' href='" . url('/') . '/assets/videos/' . $value->varVideoName . '.' . $value->varVideoExtension . "?autoplay=1' title='" . $value->varVideoName . "' class='link fancybox fancybox.iframe icns_set' data-fancybox-group='gallery'>
														<span class='fa fa-play'></span>
													</a>
													<button title='Please select video and click on Insert Media button' class='icns_set' onclick=\"MediaManager.selectVideo('" . $value->id . "')\">
													<span class='fa fa-hand-pointer-o'></span>
													</button>
												</div>
											</div>";
												}
										}
								}
								$vidoeHtml .= '</div><div class="clearfix"></div>';
								$vidoeHtml .= '<div class="clearfix"></div></div>';
						} else {
								$vidoeHtml .= '<div class="portlet light"><h3>Videos are not available</h3></div>';
						}
						$response = $vidoeHtml;
				}
				echo $response;
				exit;
		}

		public function user_uploaded_docs()
		{
				$response  = false;
				$docsHtml = '';
				if (Input::get('userid')) 
				{
						$user_id = Input::get('userid');
						$docName  = Input::get('docName');
						$limit   = 50;
						$page    = 1;
						$filterArr = array();
						$filterArr['docName'] = $docName;
						$documentObj  = Document::getDocuments($limit, $page,0,$filterArr);
						

						$docsHtml .= '<div class="title_section">
														<h2>Documents</h2>';
						$docsHtml .= '<div class="pull-right">';
						if (count($documentObj) > 0) 
						{
								$docsHtml .= '<a class="btn btn-green-drake" id="insert_document" onclick="MediaManager.insertDocument();" href="javascript:void(0);" style="padding:4px 12px">Insert Document(s)</a>&nbsp;';
								$docsHtml .= '<a style="padding:4px 12px;margin-right:10px;" class="btn btn-green-drake" id="delete_document" onclick=\'MediaManager.openConfirmBox("document");\' href="javascript:void(0);" >Delete</a>';
						}
						$docsHtml .= '</div></div><div class="clearfix"></div>';
						if (count($documentObj) > 0) 
						{
								$docsHtml .= '<div class="portlet light">
															<div class="scroller gallery">
																<div id="append_user_image">';
																	foreach ($documentObj as $key => $value) 
																	{
																		$documentPath = public_path().'/documents/'.$value->txtSrcDocumentName.'.'.$value->varDocumentExtension;
																		if (file_exists($documentPath)) 
																		{
																				$docsHtml .= "<div class='img-box contains_thumb' id='document_".$value->id. "'>
																											 <div class='thumbnail_container'>
																													<div class='thumbnail'>
																													 <a  title='".$value->txtDocumentName."' href='javascript:void(0);' onclick=\"MediaManager.selectDocument('" . $value->id . "')\" >";
																													if($value->varDocumentExtension == "pdf")
																													{
																														$docsHtml .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/pdf.png'>";              
																													}elseif($value->varDocumentExtension == "xls"){
																														$docsHtml .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/xls.png'>";  
																													}elseif($value->varDocumentExtension == "docx" || $value->varDocumentExtension == "doc"){
																														$docsHtml .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/doc.png'>";  
																													}elseif($value->varDocumentExtension == "ppt"){
																														$docsHtml .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/ppt.png'>";  
																													}elseif($value->varDocumentExtension == "txt"){
																														$docsHtml .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/txt.png'>";  
																													}else{
																														$docsHtml .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/document_icon.png'>";
																													}    

																													$docsHtml .= "<span class='icon-check' aria-hidden='true'></span>
																															</a>
																															</div>
																													</div>
																													<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
																											</div>";
																		}
																}
								$docsHtml .= '</div><div class="clearfix"></div>';
								$docsHtml .= '<div class="clearfix"></div></div>';
						} else {
								$docsHtml .= '<div class="portlet light"><h3>Document(s) are not available</h3></div>';
						}
						$response = $docsHtml;
				}
				echo $response;
				exit;
		}
		
		public function remove_image()
		{
				$response = false;
				if (Input::get('image_id')) 
				{
						$whereCondition                     = ['id' => Input::get('image_id')];
						$updateImageFieldsArr               = [];
						$updateImageFieldsArr['chrPublish'] = 'N';
						$updateImageFieldsArr['chrDelete']  = 'Y';
						$response                           = CommonModel::updateRecords($whereCondition, $updateImageFieldsArr, false, '\\App\\Image');
				}
				echo $response;
				exit;
		}

		public function remove_multiple_image()
		{
				$response = false;
				if (Input::get('idArr')) {
					if(Input::get('identity') && Input::get('identity')=="trash"){
								$files = array();
								$filePath = public_path().'/assets/images/';
								$fileDetails = Image::select(['txtImageName','varImageExtension'])->whereIn('id', Input::get('idArr'))->get();
								if(!empty($fileDetails)){
										foreach($fileDetails as $file){
											if($file->txtImageName !="" && $file->varImageExtension!=""){
												$fileName = $file->txtImageName.'.'.$file->varImageExtension; 
												array_push($files,$fileName);
											}
										}
								}
								$response = Image::whereIn('id', Input::get('idArr'))->delete();   
								if($response){
									$this->removeFiles($filePath,$files);
								}
						}else{
							$response = Image::whereIn('id', Input::get('idArr'))->update(['chrPublish' => 'N', 'chrDelete' => 'Y']);
						}
				}
				echo $response;
				exit;
		}
		

		public function remove_multiple_documents()
		{
				$response = false;
				if (Input::get('idArr')) {
						if(Input::get('identity') && Input::get('identity')=="trash"){
								$files = array();
								$filePath = public_path().'/documents/';
								$documentsDetails = Document::select(['txtSrcDocumentName','varDocumentExtension'])->whereIn('id', Input::get('idArr'))->get();
								if(!empty($documentsDetails)){
										foreach($documentsDetails as $document){
											if($document->txtSrcDocumentName !="" && $document->varDocumentExtension!=""){
												$docName = $document->txtSrcDocumentName.'.'.$document->varDocumentExtension; 
												array_push($files,$docName);
											}
										}
								}
								$response = Document::whereIn('id', Input::get('idArr'))->delete();   
								if($response){
									$this->removeFiles($filePath,$files);
								}
						}else{
								$response = Document::whereIn('id', Input::get('idArr'))->update(['chrPublish' => 'N', 'chrDelete' => 'Y']);  
						}
				}
				echo $response;
				exit;
		}

		public function get_recent_uploaded_images()
		{
				$response = false;

				if (Input::get('user_id')) {

						$user_id           = Input::get('user_id');
						$recently_uploaded = Image::getRecentUploadedImages();

						$Image_html = '<div class="title_section">';
						$Image_html .= '<h2>Recently Uploaded</h2>';
						$Image_html .= '<div class="pull-right">';

						if ($recently_uploaded->count() > 0) {
								$Image_html .= '<a class="btn btn-green-drake" id="insert_image" onclick="MediaManager.insertMedia();" href="javascript:void(0);" style="padding:4px 12px">Insert Media</a>&nbsp;';

								$Image_html .= '<a class="btn btn-green-drake" id="delete_image" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.openConfirmBox("Image",false,"recent")\' href="javascript:void(0);" >Delete</a>';
						}
						$Image_html .= '</div></div><div class="clearfix"></div>';

						if ($recently_uploaded->count() > 0) {
								$Image_html .= '<div class="portlet light">';
								$Image_html .= '<p id="note"></p>';
								$Image_html .= '<div id="recent_upload_images">';
								foreach ($recently_uploaded as $key => $value) {
										$img_path = public_path().'/assets/images/' . $value->txtImageName . '.' . $value->varImageExtension;

										if (file_exists($img_path)) {
												$Image_html .= "<div class='img-box contains_thumb' id='media_" . $value->id . "'>
																				 <div class='thumbnail_container'>
																							<div class='thumbnail' id='media_image_" . $value->id . "'>
																						 <a  title='" . $value->txtImgOriginalName . "' href='javascript:void(0);' onclick=\"MediaManager.selectRecentUploadImage('" . $value->id . "')\" >
																								 <img alt='" . $value->txtImgOriginalName . "' src='" . resize_image::resize($value->id, 195, 195) . "'>
																								 <span class='icon-check' aria-hidden='true'></span>
																																																									</a>
																									</div>
																								</div>
																								<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
																							</div>";
										}
								}

								$Image_html .= '</div><div class="clearfix"></div><div class="clearfix"></div>';
						} else {

								$Image_html .= '<div class="portlet light"><h3>Images are not available</h3></div>';
						}
				}

				$response = $Image_html;
				echo $response;
				exit;
		}

		public function get_trash_images()
		{
				$response = false;
				if (Input::get('user_id')) {
						$user_id      = Input::get('user_id');
						$trash_images = Image::getTrashedImages();
						$Image_html   = '<div class="title_section">
															<h2>Trashed Images</h2>';
						$Image_html .= '<div class="pull-right">';
						if ($trash_images->count() > 0) {
							$Image_html .= '<a class="btn btn-green-drake" id="restore_images" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.openRestoreConfirmBox("Image",true);\' href="javascript:void(0);" >Restore</a>';
							$Image_html .= '<a class="btn btn-green-drake" id="permanent_delete_images" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.openConfirmBox("Image",true);\' href="javascript:void(0);" >Delete Permanently</a>';
							$Image_html .= '<a class="btn btn-green-drake" id="empty_trash_images" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.emptyTrash("Image");\' href="javascript:void(0);" >Empty Trash</a>';
						}
						$Image_html .= '</div><div class="clearfix"></div></div>';
						if ($trash_images->count() > 0) {
								$Image_html .= '<div class="portlet light">';
								$Image_html .= '<div id="append_image">';
								foreach ($trash_images as $key => $value) {
										$img_path = public_path().'/assets/images/' . $value->txtImageName . '.' . $value->varImageExtension;
										if (file_exists($img_path)) {
												$Image_html .= "<div class='img-box contains_thumb' id='media_" . $value->id . "'>
																	<div class='thumbnail_container'>
																		<div class='thumbnail' id='media_image_" . $value->id . "'>
																			<a  title='" . $value->txtImgOriginalName . "' href='javascript:void(0);' onclick=\"MediaManager.selectImage('" . $value->id . "')\" >
																				<img alt='" . $value->txtImgOriginalName . "' src='" . resize_image::resize($value->id, 195, 135) . "'>
																				<span class='icon-check' aria-hidden='true'></span>
																			</a>
																		</div>
																	</div>
																	<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
																</div>";
										}
								}
								$Image_html .= '</div><div class="clearfix"></div>';
						} else {
								$Image_html .= '<div class="portlet light"><h3>Images are not available</h3></div>';
						}
				}

				$response = $Image_html;
				echo $response;
				exit;
		}

		public function get_trash_videos()
		{
				$response = false;
				if (Input::get('user_id')) {
						$user_id      = Input::get('user_id');
						$videos = Video::getTrashedVideos();
						$vidoeHtml   = '<div class="title_section">
															<h2>Trashed Videos</h2>';
						$vidoeHtml .= '<div class="pull-right">';
						if ($videos->count() > 0) {
							$vidoeHtml .= '<a class="btn btn-green-drake" id="restore_videos" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.openRestoreConfirmBox("Video",true);\' href="javascript:void(0);" >Restore</a>';
							$vidoeHtml .= '<a class="btn btn-green-drake" id="permanent_delete_videos" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.openConfirmBox("video",true);\' href="javascript:void(0);" >Delete Permanently</a>';
							$vidoeHtml .= '<a class="btn btn-green-drake" id="empty_trash_videos" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.emptyTrash("Video");\' href="javascript:void(0);" >Empty Trash</a>';
						}
						$vidoeHtml .= '</div><div class="clearfix"></div></div>';
						if ($videos->count() > 0) {
								$vidoeHtml .= '<div class="portlet light">
									<div class="scroller gallery">
										<div id="append_user_image">';
								foreach ($videos as $key => $value) {
										if (isset($value->youtubeId) && !empty($value->youtubeId)) {
												$vidoeHtml .= "<div class='img-box video_thumb contains_thumb' data-video_name='" . $value->youtubeId . "' id='video_" . $value->id . "'>
												<div class='thumbnail_container'>
													<div class='thumbnail' id='media_image_" . $value->id . "'>
														<img src='http://img.youtube.com/vi/" . $value->youtubeId . "/default.jpg' />
													</div>
												</div>
												<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
												<div class='video_overflow'>
													<a title='" . $value->youtubeId . "' href='http://www.youtube.com/embed/" . $value->youtubeId . "?autoplay=1' class='link fancybox fancybox.iframe icns_set' data-fancybox-group='gallery'><span class='fa fa-play'></span></a>
													<button title='Please select video and click on Insert Media button' class='icns_set' onclick=\"MediaManager.selectVideo('" . $value->id . "')\">
													<span class='fa fa-hand-pointer-o'></span>
													</button>
												</div>
											</div>";
										} else {
												$video_path = public_path().'/assets/videos/' . $value->varVideoName . '.' . $value->varVideoExtension;
												if (file_exists($video_path)) {
														$vidoeHtml .= "<div class='img-box video_thumb contains_thumb' data-video_name ='" . $value->txtVideoOriginalName . '.' . $value->varVideoExtension . "'  id='video_" . $value->id . "'>
												<div class='thumbnail_container'>
													<div class='thumbnail' id='media_image_" . $value->id . "'>
														<img src='" . $this->_APP_URL . "/resources/images/video_thumb_icon.png' />
													</div>
												</div>
												<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
												<div class='video_overflow'>
													<a title='" . $value->txtVideoOriginalName . '.' . $value->varVideoExtension . "' href='" . url('/') . '/assets/videos/' . $value->varVideoName . '.' . $value->varVideoExtension . "?autoplay=1' title='" . $value->varVideoName . "' class='link fancybox fancybox.iframe icns_set' data-fancybox-group='gallery'>
														<span class='fa fa-play'></span>
													</a>
													<button title='Please select video and click on Insert Media button' class='icns_set' onclick=\"MediaManager.selectVideo('" . $value->id . "')\">
													<span class='fa fa-hand-pointer-o'></span>
													</button>
												</div>
											</div>";
												}
										}
								}
								$vidoeHtml .= '</div><div class="clearfix"></div>';
								$vidoeHtml .= '<div class="clearfix"></div></div>';
						} else {
								$vidoeHtml .= '<div class="portlet light"><h3>Videos are not available</h3></div>';
						}
				}

				$response = $vidoeHtml;
				echo $response;
				exit;
		}

		public function get_trash_documents()
		{
				$response = false;
				if (Input::get('user_id')) 
				{
						$user_id      = Input::get('user_id');
						$trash_documents = Document::getTrashedDocuments();

						$html   = '<div class="title_section">
															<h2>Trashed Document(s)</h2> <div class="pull-right">';
						if (count($trash_documents) > 0) 
						{
							$html .= '<a class="btn btn-green-drake" id="restore_images" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.openRestoreConfirmBox("Document",true);\' href="javascript:void(0);" >Restore</a>';
							$html .= '<a class="btn btn-green-drake" id="permanent_delete_document" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.openConfirmBox("document",true);\' href="javascript:void(0);" >Delete Permanently</a>';
							$html .= '<a class="btn btn-green-drake" id="empty_trash_document" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.emptyTrash("Document");\' href="javascript:void(0);" >Empty Trash</a>';
						}
						$html .= '</div><div class="clearfix"></div></div>';
						if (count($trash_documents) > 0) 
						{
								$html .= '<div class="portlet light">';
								$html .= '<div id="append_image">';
								foreach ($trash_documents as $key => $value) 
								{
										$doc_path = public_path().'/documents/' . $value->txtSrcDocumentName . '.' . $value->varDocumentExtension;
										if (file_exists($doc_path)) 
										{
												$html .= "<div class='img-box contains_thumb' id='document_".$value->id. "'>
																	<div class='thumbnail_container'>
																		<div class='thumbnail'>
																			<a  title='" . $value->txtDocumentName . "' href='javascript:void(0);' onclick=\"MediaManager.selectDocument('" . $value->id . "')\">";
																				 if($value->varDocumentExtension == "pdf")
																					{
																						$html .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/pdf.png'>";              
																					}elseif($value->varDocumentExtension == "xls"){
																						$html .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/xls.png'>";  
																					}elseif($value->varDocumentExtension == "docx" || $value->varDocumentExtension == "doc"){
																						$html .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/doc.png'>";  
																					}elseif($value->varDocumentExtension == "ppt"){
																						$html .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/ppt.png'>";  
																					}elseif($value->varDocumentExtension == "txt"){
																						$html .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/txt.png'>";  
																					}else{
																						$html .= "<img alt='" . $value->txtDocumentName . "' src='" . $this->_APP_URL . "/assets/images/documents_logo/document_icon.png'>";
																					}  

																				$html .= "<span class='icon-check' aria-hidden='true'></span>
																			</a>
																		</div>
																		<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
																	</div>
																</div>";
										}
								}
								$html .= '</div><div class="clearfix"></div>';
						} else {
								$html .= '<div class="portlet light"><h3>Document(s) are not available</h3></div>';
						}
				}

				$response = $html;
				echo $response;
				exit;
		}

		public function empty_trash_image(){
			$response = false;
				if (Input::get('mediaType')) {
						if(Input::get('mediaType')=="Image"){
								$files = array();
								$ids = array();
								$filePath = public_path().'/assets/images/';
								$trashData = Image::getAllTrashedImagesIds();
								if(!empty($trashData)){
										foreach($trashData as $file){
												array_push($ids,$file->id);
												if($file->txtImageName !="" && $file->varImageExtension!=""){
													$fileName = $file->txtImageName.'.'.$file->varImageExtension; 
													array_push($files,$fileName);
												}
										}
								}
								if(!empty($ids)){
										$response = Image::whereIn('id', $ids)->delete();   
										if($response){
											$this->removeFiles($filePath,$files);
										}  
								}
						}
				}
				echo $response;
				exit; 
		}

		public function empty_trash_video(){
			$response = false;
				if (Input::get('mediaType')) {
						if(Input::get('mediaType')=="Video"){

								$files = array();
								$ids = array();
								$filePath = public_path().'/assets/videos/';
								$trashData = Video::getAllTrashedVideosIds();
								if(!empty($trashData)){
										foreach($trashData as $file){
												array_push($ids,$file->id);
												if($file->varVideoName !="" && $file->varVideoExtension!=""){
													$fileName = $file->varVideoName.'.'.$file->varVideoExtension; 
													array_push($files,$fileName);
												}
										}
								}
								
								if(!empty($ids)){
										$response = Video::whereIn('id', $ids)->delete();
										if($response){
											$this->removeFiles($filePath,$files);
										}
								}
						}
				}
				echo $response;
				exit;
		}

		public function empty_trash_document(){
			$response = false;
				if (Input::get('mediaType')) {
						if(Input::get('mediaType')=="Document"){
								$files = array();
								$ids = array();
								$filePath = public_path().'/documents/';
								$trashData = Document::getAllTrashedDocumentsIds();
								if(!empty($trashData)){
										foreach($trashData as $file){
												array_push($ids,$file->id);
												if($file->txtSrcDocumentName !="" && $file->varDocumentExtension!=""){
													$fileName = $file->txtSrcDocumentName.'.'.$file->varDocumentExtension; 
													array_push($files,$fileName);
												}
										}
								}
								
								if(!empty($ids)){
										$response = Document::whereIn('id', $ids)->delete();
										if($response){
											$this->removeFiles($filePath,$files);
										}
								}
						}
				}
				echo $response;
				exit;
		}


		public function insert_image_by_url()
		{
				$response = false;
				if (Input::get('url')) {

						if (!filter_var(Input::get('url'), FILTER_VALIDATE_URL) === false) {
								$filename = substr(Input::get('url'), strrpos(Input::get('url'), '/') + 1);

								if (!empty($filename)) 
								{
										$pathinfo = pathinfo(Input::get('url'));
										if (isset($pathinfo['extension'])) 
										{
												if ($pathinfo['extension'] == "jpg" || $pathinfo['extension'] == "jpeg" || $pathinfo['extension'] == "png" || $pathinfo['extension'] == "gif") 
												{
														$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
														$name      = $timestamp . '-' . self::clean($pathinfo['filename']);

														file_put_contents(public_path().'/assets/images/' . $name . '.' . $pathinfo['extension'], file_get_contents(Input::get('url')));

														$imageArr                      = array();
														$imageArr['fkIntUserId']       = Auth::user()->id;
														$imageArr['txtImageName']      = $name;
														$imageArr['txtImgOriginalName'] = $pathinfo['filename'];
														$imageArr['varImageExtension'] = $pathinfo['extension'];
														$imageArr['chrIsUserUploaded'] = 'Y';
														$imageArr['created_at']        = Carbon::now();
														$imageID                       = CommonModel::addRecord($imageArr, '\\App\\Image');
														if ($imageID) {

																$image_data = Image::getImg($imageID);
																$imagePath  = public_path().'/assets/images/' . $image_data->txtImageName . '.' . $image_data->varImageExtension;
																if (file_exists($imagePath)) {
																		$response['image_id'] = $imageID;
																} else {
																		$response['error'] = 'Image not exists in source directory.';
																}
														} else {
																$response['error'] = 'Image not inserted successfully.';
														}
												} else {
														$response['error'] = 'Image is not valid';
												}
										} else {
												$response['error'] = 'URL is not valid';
										}
								} else {
										$response['error'] = 'Please enter valid url.';
								}
						} else {
								$response['error'] = 'Please enter valid url';
						}
				}

				echo json_encode($response);
				exit;
		}

		public function insert_video_by_url()
		{
				
				$response = false;
				if (Input::get('url')) {

						if (!filter_var(Input::get('url'), FILTER_VALIDATE_URL) === false) {

						

								$youtube_id = $this->youtube_id_from_url(Input::get('url'));

								if($youtube_id) {
                     
                      $apiURL = 'https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v='. $youtube_id .'&format=json';
                        # curl options
                        $options = array(
                          CURLOPT_URL  => $apiURL,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_BINARYTRANSFER => true,
                          CURLOPT_SSL_VERIFYPEER => false,
                          CURLOPT_TIMEOUT => 5 );
                        # connect api server through cURL
                        $ch = curl_init();
                        curl_setopt_array($ch, $options);
                        # execute cURL
                        $json = curl_exec($ch) or die( curl_error($ch) );
                        # close cURL connect
                        curl_close($ch);                  
                        # decode json encoded data
                        if ($data = json_decode($json)){
                            $youTubeTitle = $data->title; 
                         }

                    /* Save file wherever you want */
										$user = Auth::user();

										$videos                    = new Video;
										// print_r($videos);
										// exit();

										$videos->fkIntUserId       = $user->id;
                    $videos->varVideoName       = !empty($youTubeTitle)?$youTubeTitle:'';
                    $videos->txtVideoOriginalName       = !empty($youTubeTitle)?$youTubeTitle:'';
                    $videos->youtubeId         = $youtube_id;
										$videos->chrIsUserUploaded = 'Y';
										$videos->save();
                   
										if ($videos->id) {
												$videoObj = Video::publish()->deleted()->checkRecordId($videos->id)->first();

												if (isset($videoObj->youtubeId)) {
														$response['html'] = "<div class='img-box video_thumb contains_thumb'>
													<div class='thumbnail_container'>
														<div class='thumbnail'>
															<img src='http://img.youtube.com/vi/" . $videoObj->youtubeId . "/default.jpg' />

														</div>
													</div>
													<div class='video_overflow'>
														<a title=". $videoObj->varVideoName ." href='http://www.youtube.com/embed/" . $videoObj->youtubeId . "?autoplay=1' class='link fancybox fancybox.iframe icns_set' data-fancybox-group='gallery'>
															<span class='fa fa-play'></span>
														</a>
														<button title='Please select video and click on Insert Media button' class='icns_set' onclick='MediaManager.selectVideo('2')'>
														<span class='fa fa-hand-pointer-o'></span>
														</button>
													</div>
												</div>";
												}
										} else {
												$response['error'] = 'Video is not available.';
										}
								} else {
										$response['error'] = 'Please enter valid youtube url';
								}
						} else {
								$response['error'] = 'Please enter valid url';
						}
				}

				echo json_encode($response);
				exit;
		}

		public function remove_multiple_videos()
		{
				$response = false;
				if (Input::get('idArr')) {
						if(Input::get('identity') && Input::get('identity')=="trash"){
								$files = array();
								$filePath = public_path().'/assets/videos/';
								$fileDetails = Video::select(['varVideoName','varVideoExtension'])->whereIn('id', Input::get('idArr'))->get();
								if(!empty($fileDetails)){
										foreach($fileDetails as $file){
												if($file->varVideoName !="" && $file->varVideoExtension!=""){
														$fileName = $file->varVideoName.'.'.$file->varVideoExtension; 
														array_push($files,$fileName);
												}
										}
								}
								$response = Video::whereIn('id', Input::get('idArr'))->delete();   
								if($response){
									$this->removeFiles($filePath,$files);
								}
						}else{
							$response = Video::whereIn('id', Input::get('idArr'))->update(['chrPublish' => 'N', 'chrDelete' => 'Y']);
						}
				}
				echo $response;
				exit;
		}

		public function youtube_id_from_url($url)
		{

				$pattern = '%^# Match any youtube URL
												(?:https?://)?  # Optional scheme. Either http or https
												(?:www\.)?      # Optional www subdomain
												(?:             # Group host alternatives
													youtu\.be/    # Either youtu.be,
												| youtube\.com  # or youtube.com
													(?:           # Group path alternatives
														/embed/     # Either /embed/
													| /v/         # or /v/
													| /watch\?v=  # or /watch\?v=
													)             # End path alternatives.
												)               # End host alternatives.
												([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
												$%x';

				$result = preg_match($pattern, $url, $matches);
				if ($result) {
						return $matches[1];
				}
				return false;
		}

		public static function clean($string)
		{
				$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
				return preg_replace('/[^A-Za-z0-9\-.]/', '', $string); // Removes special chars.
		}

		public function is_url_exist($url)
		{
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
				$raw = curl_exec($ch);
				curl_close($ch);

				var_dump($raw);
				die();
		}

		public function getImageHtml($imageObj, $title,$filter=false)
		{

				$allImageCount = Image::getRecordCount();

				$Image_html = '<div class="title_section">';
				$Image_html .= '<h2>' . $title . '</h2>';
				$Image_html .= '<div class="pull-right">';

				if ($imageObj->count() > 0) {
						$Image_html .= '<a class="btn btn-green-drake" id="insert_image" onclick="MediaManager.insertMedia();" href="javascript:void(0);" style="padding:4px 12px">Insert Media</a>&nbsp;';
						$Image_html .= '<a class="btn btn-green-drake" id="delete_image" style="padding:4px 12px;margin-right:10px;" onclick=\'MediaManager.openConfirmBox("Image");\' href="javascript:void(0);" >Delete</a>';
				}

				$Image_html .= '</div></div><div class="clearfix"></div>';

				if ($imageObj->count() > 0) 
				{
						$Image_html .= '<div class="portlet light">';
						$Image_html .= '<p id="note"></p>';
						$Image_html .= '<div class="scroller gallery">';
						$Image_html .= '<div id="append_user_image">';
						foreach ($imageObj as $key => $value) {
								$img_path = public_path().'/assets/images/' . $value->txtImageName . '.' . $value->varImageExtension;
								if (file_exists($img_path)) 
								{
										$Image_html .= "<div class='img-box contains_thumb' id='media_" . $value->id . "' data-order='".$key."'>
																		 <div class='thumbnail_container'>
																				<div class='thumbnail' id='media_image_" . $value->id . "' data-image_big_source='" . url('/assets/images/'. $value->txtImageName . '.' . $value->varImageExtension) . "' data-image_title = '" . $value->txtImgOriginalName . "'>
																				 <a  title='" . $value->txtImgOriginalName . "' href='javascript:void(0);' onclick=\"MediaManager.selectImage('" . $value->id . "')\" >
																								 <img alt='" . $value->txtImgOriginalName . "' src='" . resize_image::resize($value->id, 195, 195) . "'>
																								 <span class='icon-check' aria-hidden='true'></span>
																						</a>
																						</div>
																				</div>
																				<a class='right_check' href='javascript:void(0)' ><i class=''></i></a>
																		</div>";
								}
						}
						$Image_html .= '</div>';
						if ($allImageCount > 18) 
						{
								if(!isset($filter['imageName']) && empty($filter['imageName']))
								{
									$Image_html .= '<a class="btn btn-green-drake upload_image_load" id="load_more_images"  onclick="MediaManager.getMoreImages('.Auth::user()->id.');" href="javascript:void(0);">Load More Images</a>&nbsp;';
								} 
						}
						$Image_html .= '</div><div class="clearfix"></div></div>';
						$Image_html .= '<input type="hidden" id="page" name="page" value="1">';
				} else {
						$Image_html .= '<div class="portlet light"><h3>Images are not available</h3></div>';
				}
				return $Image_html;
		}

		public function removeFiles($filePath=false,$files=false){
				$response = false;
				if($filePath){
						if(is_array($files)){
								foreach($files as $file){
										$fileExistPath = $filePath.$file;
										if($this->filePathExist($fileExistPath)){
												unlink($fileExistPath);
										}
								}
						}else{
								$fileExistPath = $filePath.$files;
								if($this->filePathExist($fileExistPath)){
										unlink($fileExistPath);
								}
						}
						$response = true;
				}
				return $response;
		}
		public function filePathExist($filepath=false){
				$response = false;
				if(file_exists($filepath)){
					$response = true;   
				}
				return $response; 
		}

		public static function checkedUsedImg(){
			$response = [];
			$exists = ImgModuleRel::getRecord(Input::get('idArr'))->toArray();							
			if(!empty($exists)){
				$response=[];
				$response['usedImg'] = $exists;
				$response['message'] = "Image(s) cannot be deleted as it has been assigned in one or more records!";
				$response = json_encode($response);
			}
			return $response;
		}

		public static function checkedUsedVideo(){
			$response = [];
			$exists = VideoModuleRel::getRecord(Input::get('idArr'))->toArray();							
			if(!empty($exists)){
				$response=[];
				$response['usedVideo'] = $exists;
				$response['message'] = "Video(s) cannot be deleted as it has been assigned in one or more records!";
				$response = json_encode($response);
			}
			return $response;
		}

		public static function checkedUsedDocument(){
			$response = [];
			$exists = DocumentModuleRel::getRecord(Input::get('idArr'))->toArray();							
			if(!empty($exists)){
				$response=[];
				$response['usedDocument'] = $exists;
				$response['message'] = "Document(s) cannot be deleted as it has been assigned in one or more records!";
				$response = json_encode($response);
			}
			return $response;
		}

		public function restore_multiple_image(){
			$response = false;
			if (Input::get('idArr')) {
				$response = Image::whereIn('id', Input::get('idArr'))->update(['chrPublish' => 'Y', 'chrDelete' => 'N']);
			}
			echo $response;
			exit;
		}

		public function restore_multiple_videos(){
			$response = false;
			if (Input::get('idArr')) {
				$response = Video::whereIn('id', Input::get('idArr'))->update(['chrPublish' => 'Y', 'chrDelete' => 'N']);
			}
			echo $response;
			exit;
		}

		public function restore_multiple_document(){
			$response = false;
			if (Input::get('idArr')) {
				$response = Document::whereIn('id', Input::get('idArr'))->update(['chrPublish' => 'Y', 'chrDelete' => 'N']);
			}
			echo $response;
			exit;
		}

}
