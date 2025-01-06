<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\Projects;
use App\ProjectCategory;
use App\ProjectStatus;
use App\Team;
use App\Modules;
use App\Alias;
use App\Video;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use App\Log;
use App\RecentUpdates;   
use App\CommonModel;
use App\Helpers\MyLibrary;
use Auth;
use App\Helpers\resize_image;
use Cache;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;

class ProjectController extends PowerpanelController {
			 
		public function __construct() {
				parent::__construct();
				if(isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}       
		}
		/**
		 * This method handels load process of project
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index() {
				$iTotalRecords =   CommonModel::getRecordCount();
				$projectCategory = $iTotalRecords > 0? ProjectCategory::getCatWithParent():null;
				$this->breadcrumb['title'] = trans('template.projectModule.manageProjects');
				$breadcrumb = $this->breadcrumb;
				$projectStatus = ProjectStatus::getProjectStatus();
				return view('powerpanel.projects.index', compact('projectCategory','iTotalRecords', 'breadcrumb', 'projectStatus'));
		}

		/**
		 * This method loads project edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($id=false) {
				$category = ProjectCategory::getCatWithParent();
				
				$category = CategoryArrayBuilder::getArray($category);
				//$ProjectCategory = json_encode($category);
				$ProjectCategory = $category;
				if($ProjectCategory ==false){
						$ProjectCategory = array();    
				}
				$projectStatus = ProjectStatus::getProjectStatus();
				if($projectStatus == false){
					 $projectStatus = array(); 
				}
				$projectTeam = array();
				$teamArray =array();
				if(class_exists('\\App\\Team')){
						$teamArray = Team::getFrontList(false, false, true);
				}
				
				if(count($teamArray) > 0) {
						foreach($teamArray as $team) {
								$projectTeam[] = array('id' => $team['id'], 'name' => $team['varTitle']);
						}
				}
				
				$imageManager = true;
				$videoManager  = true;
				$documentManager  = true;
				$categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false,false,'\App\ProjectCategory');

				if(!is_numeric($id)) {
						$total = CommonModel::getRecordCount();
						$total = $total + 1;
						$this->breadcrumb['title'] = trans('template.projectModule.addProject');
						$this->breadcrumb['module'] = trans('template.projectModule.manageProjects');
						$this->breadcrumb['url'] = 'powerpanel/projects';
						$this->breadcrumb['inner_title'] = trans('template.projectModule.addProject');
						$breadcrumb = $this->breadcrumb;
						$data=compact('total', 'ProjectCategory', 'breadcrumb','imageManager','videoManager','documentManager','categoryHeirarchy', 'projectStatus', 'projectTeam');
				} else {
						$project = Projects::getRecordById($id);
						$videoIDAray = explode(',', $project->fkIntVideoId);
						$videoData = Video::getVideoData($videoIDAray);
						$project->videos = $videoData;
			
						if(count($project)==0){ return redirect()->route('powerpanel.projects.add'); }
						$metaInfo = array('varMetaTitle' => $project->varMetaTitle, 'varMetaKeyword' => $project->varMetaKeyword, 'varMetaDescription' => $project->varMetaDescription);
						$this->breadcrumb['title'] = trans('template.projectModule.editProject') . ' - ' . $project->varTitle;
						$this->breadcrumb['module'] = trans('template.projectModule.manageProjects');
						$this->breadcrumb['url'] = 'powerpanel/projects';
						$this->breadcrumb['inner_title'] = trans('template.projectModule.editProject') . ' - ' . $project->varTitle;
						$breadcrumb = $this->breadcrumb;
						$data=compact('project', 'ProjectCategory', 'alias', 'metaInfo', 'breadcrumb','imageManager','videoManager','documentManager','categoryHeirarchy', 'projectStatus', 'projectTeam');
				}
				return view('powerpanel.projects.actions', $data);        
		}
		/**
		 * This method stores project modifications
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function handlePost(Request $request) {
				$data = Input::get();
				$actionMessage = trans('template.common.oppsSomethingWrong');
				$messsages = array('order.greater_than_zero' => trans('template.projectModule.displayGreaterThan'));

				$rules = array(
						'title' => 'required|max:160',
						'category' => 'required',
						'status' => 'required',
						//'team' => 'required',
						'display_order' => 'required|greater_than_zero',
						'varMetaTitle' => 'required|max:500',
						'varMetaKeyword' => 'required|max:500',
						'varMetaDescription' => 'required|max:500',
						//'sale_price' => 'required|numeric|min:0',
						//'latitude' => 'required|max:160',
						//'longitude' => 'required|max:160',
				);

				$validator = Validator::make($data, $rules, $messsages);
				if($validator->passes()) {
						$projectArr = [];
						$projectArr['varTitle'] = trim($data['title']);           
						$projectArr['intCategory'] = isset($data['category'])?$data['category']:0;
						$projectArr['intStatus'] = isset($data['status'])?$data['status']:0;
						$projectArr['varFeaturedProject'] = $data['featuredProject'];
						$projectArr['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
						$projectArr['fkIntVideoId'] = !empty($data['video_id'])?$data['video_id']:null;
						$projectArr['fkIntDocId'] = !empty($data['doc_id'])?$data['doc_id']:null;
						$projectArr['fkIntTeam'] = !empty($data['team'])?$data['team']:0;
						$projectArr['txtShortDescription'] = trim($data['short_description']);
						$projectArr['txtDescription'] = $data['description'];
						$projectArr['varMetaTitle'] = trim($data['varMetaTitle']);
						$projectArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
						$projectArr['varMetaDescription'] = trim($data['varMetaDescription']);
						$projectArr['chrPublish'] = isset($data['chrMenuDisplay'])?$data['chrMenuDisplay']:'Y';

						if(isset($data['currency'])) {
								$projectArr['varCurrency'] = $data['currency'];
						}
						$projectArr['fltSalePrice'] = $data['sale_price'];
						$projectArr['txtAddress'] = $data['address'];
						$projectArr['varLatitude'] = $data['latitude'];
						$projectArr['varLongitude'] = $data['longitude'];
						
						$projectArr['intBeds'] = $projectArr['fltBaths'] = $projectArr['fltWidth'] = $projectArr['fltDepth'] = $projectArr['fltLandSize'] = $projectArr['fltLandSize'] = 0;
						if($projectArr['intCategory'] != 0) {
								if($projectArr['intCategory'] == 1) {
										$projectArr['intBeds'] = $data['beds'];
										$projectArr['fltBaths'] = $data['baths'];
								} else if($projectArr['intCategory'] == 2) {
										$projectArr['fltBaths'] = $data['baths'];
								} else if($projectArr['intCategory'] == 3) {
										$projectArr['fltWidth'] = $data['width'];
										$projectArr['fltDepth'] = $data['depth'];
								} else {
										$projectArr['intBeds'] = $data['beds'];
										$projectArr['fltBaths'] = $data['baths'];
								}
								$projectArr['fltLandSize'] = $data['land_size'];
						}
						
						if($data['featuredProject'] == 'Y' && $data['status'] != 0) {
								$featuredProjectIds = Projects::getStatusFeaturedProjects($data['status']);
								if(count($featuredProjectIds) > 0) {
										foreach($featuredProjectIds as $featured) {
												$updateFeaturedArr['varFeaturedProject'] = 'N';
												$whereFeaturedCondition = ['intStatus' => $data['status']];
												CommonModel::updateRecords($whereFeaturedCondition, $updateFeaturedArr);
										}
								}
						}
						$id = $request->segment(3);
						if(is_numeric($id)){ #Edit post Handler=======
								if($data['oldAlias'] != $data['alias']){
												Alias::updateAlias($data['oldAlias'], $data['alias']);	
								}
								$project = Projects::getRecordForLogById($id);
								$whereConditions = ['id' => $project->id];
								$update = CommonModel::updateRecords($whereConditions, $projectArr);
								if($update) {
										if(!empty($id)) {
												self::swap_order_edit($data['display_order'], $project->id);

												$logArr = MyLibrary::logData($project->id);
												if(Auth::user()->can('log-advanced')) {
														$newProjectObj = Projects::getRecordForLogById($project->id);
														$oldRec = $this->recordHistory($project);
														$newRec = $this->recordHistory($newProjectObj);
														$logArr['old_val'] = $oldRec;
														$logArr['new_val'] = $newRec; 
												}
												$logArr['varTitle'] = trim($data['title']);
												Log::recordLog($logArr);
												if(Auth::user()->can('recent-updates-list')) {
														if(!isset($newProjectObj)) {
																$newProjectObj = Projects::getRecordForLogById($project->id);
														}
														$notificationArr = MyLibrary::notificationData($project->id, $newProjectObj);
														RecentUpdates::setNotification($notificationArr);               
												}
										}
										self::flushCache();
										$actionMessage = trans('template.projectModule.updateMessage');
								}
						} else { #Add post Handler=======
								$projectArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
								$projectArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
								$projectID = CommonModel::addRecord($projectArr);
								if(!empty($projectID)) {
										$id = $projectID;
										$newProjectObj = Projects::getRecordForLogById($id);
										$logArr = MyLibrary::logData($id);
										$logArr['varTitle'] = $newProjectObj->varTitle;
										Log::recordLog($logArr);
										if(Auth::user()->can('recent-updates-list')) {
												$notificationArr = MyLibrary::notificationData($id, $newProjectObj);
												RecentUpdates::setNotification($notificationArr);
										}
										self::flushCache();
										$actionMessage = trans('template.projectModule.addMessage');
								}
						}

						if(!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.projects.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.projects.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads project table data on view
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
				$filterArr['catFilter'] = !empty(Input::get('catValue')) ? Input::get('catValue') : '';
				$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
				$filterArr['projectFilter'] = !empty(Input::get('projectFilter')) ? Input::get('projectFilter') : '';       
				$filterArr['paymentFilter'] = !empty(Input::get('paymentFilter')) ? Input::get('paymentFilter') : '';       
				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart'] = intval(Input::get('start'));
				$sEcho = intval(Input::get('draw'));
				$arrResults = Projects::getRecordList($filterArr);
				$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
				$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				$end = $end > $iTotalRecords ? $iTotalRecords : $end;
				if(!empty($arrResults)) {
						foreach($arrResults as $key => $value) {               
								$records["data"][] = $this->tableData($value);
						}
				}
				$records["customActionStatus"] = "OK";
				$records["draw"] = $sEcho;
				$records["recordsTotal"] = $iTotalRecords;
				$records["recordsFiltered"] = $iTotalRecords;
				return json_encode($records);
		}
		public function tableData($value = false) {
				$publish_action = '';
				$details = '';
				if(Auth::user()->can('projects-edit')) {
						$details .= '<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.projects.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
				}    
				if(Auth::user()->can('projects-delete')) {
						$details.= '&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="projects" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}   
				
				if(Auth::user()->can('projects-publish')) {
						if($value->chrPublish == 'Y') {
								$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/projects" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
						} else {
								$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/projects" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
						}
				}
				
				$minus = '<span class="glyphicon glyphicon-minus"></span>';

				$imgIcon = '';
				if(isset($value->fkIntImgId) && !empty($value->fkIntImgId)) {
						$imageArr = explode(',',$value->fkIntImgId);
						if(count($imageArr) > 1) {
								$imgIcon .= '<div class="multi_image_thumb">';
								foreach($imageArr as $key => $image) {
										$imgIcon .= '<a href="' . resize_image::resize($image) . '" class="fancybox-thumb" rel="fancybox-thumb-'.$value->id.'" data-rel="fancybox-thumb">';
										$imgIcon .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) . '" src="' . resize_image::resize($image, 50, 50) . '"/>';	
										$imgIcon .= '</a>';
								}
								$imgIcon .= '</div>';					
						} else {
								$imgIcon .= '<div class="multi_image_thumb">';
								$imgIcon .= '<a href="' . resize_image::resize($value->fkIntImgId) . '" class="fancybox-buttons"  data-rel="fancybox-buttons">';
								$imgIcon .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) . '" src="' . resize_image::resize($value->fkIntImgId, 50, 50) . '"/>';	
								$imgIcon .= '</a>';
								$imgIcon .= '</div>';	
						}
				} else {
						$imgIcon .= '<span class="glyphicon glyphicon-minus"></span>';
				}
				$category = '';
				if(isset($value->intCategory)){
						//$categoryIDs =unserialize($value->txtCategories);
						$selCategory = ProjectCategory::getParentCategoryNameBycatId([$value->intCategory]);
						foreach($selCategory as $selCat) {
								if(strlen(trim($selCat)) > 0) {
										$category .= $selCat->varTitle;
								}
						}
				} else {
						$category .= $minus;
				}
				if(!empty($value->intStatus)) {
						$statusData = ProjectStatus::getStatusDetail($value->intStatus);
						$status = $statusData['varTitle'];
				} else {
						$status = $minus;
				}
				
				if($value->txtShortDescription != '') {
						$shortDesc = '<div class="pro-act-btn">
								<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.shortdescription").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
								<div class="highslide-maincontent">' . $value->txtShortDescription . '</div>
						</div>';
				} else {
						$shortDesc = '<span class="glyphicon glyphicon-minus"></span>';
				}
				$records = array(				
						'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">', 				
						'<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.projects.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>',
						$shortDesc,
						$imgIcon,
						$category,
						$status,
						'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
						'.$value->intDisplayOrder.
						' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
						//$featuredProject,
						$publish_action,
						$details,
						$value->intDisplayOrder
				);
				return $records;
		}

		/**
		 * This method delete multiples project
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
				$order = Input::get('order');
				$exOrder = Input::get('exOrder');
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
				if($order != null) {
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

		/*public function makeFeatured() {
				$id = Input::get('id');
				$featured = Input::get('featured');
				$whereConditions = ['id' => $id];
				$update = CommonModel::updateRecords($whereConditions, ['varFeaturedProject'=>$featured]);
				self::flushCache();
				echo json_encode($update);
		}*/

		public function publish(Request $request) {
				$alias = Input::get('alias');
				$update = MyLibrary::setPublishUnpublish($alias, $request);
				self::flushCache();
				echo json_encode($update);
				exit;
		}
		public function recordHistory($data=false) {
				$returnHtml = '';
				$returnHtml.= '<table class="new_table_desing table table-striped table-bordered table-hover">
						<thead>
								<tr>
										<th>'.trans("template.common.title").'</th>
										<th>'.trans("template.common.image").'</th>
										<th>'.trans("template.common.order").'</th>
										<th>'.trans("template.common.shortDescription").'</th>
										<th>'.trans("template.common.description").'</th>
										<!--<th>'.trans("template.projectModule.featuredProject").'</th>-->
										<th>'.trans("template.common.metatitle").'/th>
										<th>'.trans("template.common.metakeyword").'</th>
										<th>'.trans("template.common.metadescription").'</th>
										<th>'.trans("template.common.publish").'</th>
								</tr>
						</thead>
						<tbody>
								<tr>
										<td>' . $data->varTitle . '</td>';
										$returnHtml.='<td>'.'<img height="50" width="50" src="'.resize_image::resize($data->fkIntImgId).'" />'.'</td>

										<td>' . ($data->intDisplayOrder) . '</td>
										<td>' . $data->txtShortDescription . '</td>
										<td>' . $data->txtDescription . '</td>
										<!--<td>' . $data->varFeaturedProject . '</td>-->
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
				Cache::tags('Project')->flush();
				Cache::tags('ProjectCategory')->flush();
		}
}