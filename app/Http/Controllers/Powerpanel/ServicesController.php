<?php
namespace App\Http\Controllers\Powerpanel;
use Config;
use App\Alias;
use App\CommonModel;
use App\Helpers\AddImageModelRel;
use App\Helpers\AddVideoModelRel;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Http\Controllers\PowerpanelController;
use App\Log;
use App\Modules;
use App\RecentUpdates;
use App\ServiceCategory;
use App\Services;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Cache;
use DB;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;
use App\video;

class ServicesController extends PowerpanelController
{

		public $catModule;
		public function __construct()
		{
				parent::__construct();
				if (isset($_COOKIE['locale'])) {
						app()->setLocale($_COOKIE['locale']);
				}				
		}
		/**
		 * This method handels load process of services
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index()
		{
				$iTotalRecords             = CommonModel::getRecordCount();
				$ServicesCategory          = $iTotalRecords > 0 ? ServiceCategory::getCatWithParent() : null;
				$this->breadcrumb['title'] = trans('template.serviceModule.manageServices');
				$breadcrumb                = $this->breadcrumb;
				return view('powerpanel.services.index', compact('iTotalRecords', 'ServicesCategory', 'breadcrumb'));
		}
		/**
		 * This method loads service edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($id = false)
		{
				$imageManager	 = true;
				$videoManager	 = true;
				
				$category = ServiceCategory::getCatWithParent();
				$category = CategoryArrayBuilder::getArray($category);
				$ServiceCategory = json_encode($category);

				#icon code======================================
				$categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false,false,'\App\ServiceCategory');
				if (!is_numeric($id)) {
						$total                           = CommonModel::getRecordCount();
						$total                           = $total + 1;
						$this->breadcrumb['title']       = trans('template.serviceModule.addService');
						$this->breadcrumb['module']      = trans('template.serviceModule.manageServices');
						$this->breadcrumb['url']         = 'powerpanel/services';
						$this->breadcrumb['inner_title'] = trans('template.serviceModule.addService');
						$breadcrumb                      = $this->breadcrumb;
						$data                            = compact('total', 'ServiceCategory', 'breadcrumb', 'imageManager','imageManager','videoManager','categoryHeirarchy');
				} else {
						$service                         = Services::getRecordById($id);
						$videoIDAray = explode(',', $service->fkIntVideoId);
						$videoData = video::getVideoData($videoIDAray);
						$service->videos = $videoData;

						if(count($service)==0){ return redirect()->route('powerpanel.services.add'); }
						$metaInfo                        = array('varMetaTitle' => $service->varMetaTitle, 'varMetaKeyword' => $service->varMetaKeyword, 'varMetaDescription' => $service->varMetaDescription);
						$this->breadcrumb['title']       = trans('template.serviceModule.editService') . ' - ' . $service->varTitle;
						$this->breadcrumb['module']      = trans('template.serviceModule.manageServices');
						$this->breadcrumb['url']         = 'powerpanel/services';
						$this->breadcrumb['inner_title'] = trans('template.serviceModule.editService') . ' - ' . $service->varTitle;
						$breadcrumb                      = $this->breadcrumb;
						$data                            = compact('service', 'ServiceCategory', 'alias', 'metaInfo', 'breadcrumb', 'imageManager','videoManager','categoryHeirarchy');
				}
				return view('powerpanel.services.actions', $data);
		}

		/**
		 * This method stores service modifications
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function handlePost(Request $request)
		{
				$data          = Input::get();
				$actionMessage = trans('template.common.oppsSomethingWrong');
				$settings = json_decode(Config::get("Constant.MODULE.SETTINGS"));
				
				//    $messsages = array('display_order.greater_than_zero'=>'Display order must greater than zero');
				$rules = array(
						'title'              => 'required|max:160',
						'display_order'      => 'required|greater_than_zero',
						'chrMenuDisplay'     => 'required',
						'short_description'  => 'required|max:'.(isset($settings)?$settings->short_desc_length:400),
						'alias'              => 'required',
				);				
				$rules['varMetaTitle']       = 'required|max:160';
				$rules['varMetaKeyword']     = 'required|max:160';
				$rules['varMetaDescription'] = 'required|max:160';			

				$messsages = array(
						'display_order.greater_than_zero'     => trans('template.serviceModule.displayGreaterThan'),
						'short_description.required'  => trans('template.serviceModule.shortDescription'),
						'varMetaTitle.required'       => trans('template.serviceModule.metaTitle'),
						'varMetaKeyword.required'     => trans('template.serviceModule.metaKeyword'),
						'varMetaDescription.required' => trans('template.serviceModule.metaDescription'),
				);

				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {
						$serviceArr                        = [];
						$serviceArr['varTitle']            = trim($data['title']);
						$serviceArr['fkIntImgId']          = !empty($data['img_id']) ? $data['img_id'] : null;
						$serviceArr['fkIntVideoId']        = !empty($data['video_id']) ? $data['video_id'] : null;
						$serviceArr['varExternalLink']     = '';
						$serviceArr['varFontAwesomeIcon']  = $data['font_awesome_icon'];
						$serviceArr['txtDescription']      = $data['description'];
						$serviceArr['txtShortDescription'] = trim($data['short_description']);
						$serviceArr['txtCategories']       = isset($data['category_id']) ? serialize($data['category_id']) : null;
						$serviceArr['varPreferences']      = '';
						$serviceArr['chrFeaturedService']  = $data['featuredService'];
						$serviceArr['chrPublish']          = $data['chrMenuDisplay'];
						$serviceArr['created_at']          = Carbon::now();

					
							$serviceArr['varMetaTitle']        = trim($data['varMetaTitle']);
							$serviceArr['varMetaKeyword']      = trim($data['varMetaKeyword']);
							$serviceArr['varMetaDescription']  = trim($data['varMetaDescription']);
					

						$id = $request->segment(3);
						if (is_numeric($id)) {
								#Edit post Handler=======
								if ($data['oldAlias'] != $data['alias']) {
										Alias::updateAlias($data['oldAlias'], $data['alias']);
								}
								$service         = Services::getRecordForLogById($id);
								$whereConditions = ['id' => $service->id];
								$update          = CommonModel::updateRecords($whereConditions, $serviceArr);
								if ($update) {
										if (!empty($id)) {
												self::swap_order_edit($data['display_order'], $service->id);

												$logArr = MyLibrary::logData($service->id);
												if (Auth::user()->can('log-advanced')) {
														$newServiceObj     = Services::getRecordForLogById($service->id);
														$oldRec            = $this->recordHistory($service);
														$newRec            = $this->recordHistory($newServiceObj);
														$logArr['old_val'] = $oldRec;
														$logArr['new_val'] = $newRec;
												}
												$logArr['varTitle'] = trim($data['title']);
												Log::recordLog($logArr);
												if (Auth::user()->can('recent-updates-list')) {
														if (!isset($newServiceObj)) {
																$newServiceObj = Services::getRecordForLogById($service->id);
														}
														$notificationArr = MyLibrary::notificationData($service->id, $newServiceObj);
														RecentUpdates::setNotification($notificationArr);
												}
										}
										self::flushCache();
										$actionMessage = trans('template.serviceModule.updateMessage');
								}
						} else {
								#Add post Handler=======
								$serviceArr['intAliasId']          = MyLibrary::insertAlias($data['alias']);
								$serviceArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
								$serviceID                     = CommonModel::addRecord($serviceArr);
								if (!empty($serviceID)) {
										$id            = $serviceID;
										$newServiceObj = Services::getRecordForLogById($id);

										$logArr             = MyLibrary::logData($id);
										$logArr['varTitle'] = $newServiceObj->varTitle;
										Log::recordLog($logArr);
										if (Auth::user()->can('recent-updates-list')) {
												$notificationArr = MyLibrary::notificationData($id, $newServiceObj);
												RecentUpdates::setNotification($notificationArr);
										}
										self::flushCache();
										$actionMessage = trans('template.serviceModule.addedMessage');
								}
						}
						AddImageModelRel::sync(explode(',', $data['img_id']), $id);
						AddVideoModelRel::sync(explode(',', $data['video_id']), $id);
						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.services.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.services.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads services table data on view
		 * @return  View
		 * @since   2017-11-10
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
				$filterArr['statusFilter']       = !empty(Input::get('statusValue')) ? Input::get('statusValue') : '';
				$filterArr['catFilter']          = !empty(Input::get('catValue')) ? Input::get('catValue') : '';
				$filterArr['searchFilter']       = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
				$filterArr['iDisplayLength']     = intval(Input::get('length'));
				$filterArr['iDisplayStart']      = intval(Input::get('start'));
				$sEcho                           = intval(Input::get('draw'));
				$arrResults                      = Services::getRecordList($filterArr);
				$iTotalRecords                   = CommonModel::getRecordCount($filterArr, true);
				$end                             = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				$end                             = $end > $iTotalRecords ? $iTotalRecords : $end;
				if (!empty($arrResults)) {
						$this->catModule = Modules::getModule('service-category')->id;
						foreach ($arrResults as $key => $value) {
								$records["data"][] = $this->tableData($value, $this->catModule);
						}
				}
				$records["customActionStatus"] = "OK";
				$records["draw"]               = $sEcho;
				$records["recordsTotal"]       = $iTotalRecords;
				$records["recordsFiltered"]    = $iTotalRecords;
				return json_encode($records);
		}
		/**
		 * This method delete multiples services
		 * @return  true/false
		 * @since   2017-07-15
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
		 * This method reorders banner position
		 * @return  Banner index view data
		 * @since   2016-10-26
		 * @author  NetQuick
		 */
		public function reorder()
		{
				$order   = Input::get('order');
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
		 * @param   order
		 * @return  order
		 * @since   2016-12-23
		 * @author  NetQuick
		 */
		public static function swap_order_edit($order = null, $id = null)
		{
				MyLibrary::swapOrderEdit($order, $id);
				self::flushCache();
		}


		public function makeFeatured() {
			$id = Input::get('id');
			$featured = Input::get('featured');
			$whereConditions = ['id' => $id];
			$update = CommonModel::updateRecords($whereConditions, ['chrFeaturedService'=>$featured]);
			self::flushCache();
			echo json_encode($update);
		}

		/**
		 * This method destroys Service in multiples
		 * @return  Service index view
		 * @since   2016-10-25
		 * @author  NetQuick
		 */
		public function publish(Request $request)
		{
				$alias  = Input::get('alias');
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
		public function recordHistory($data = false)
		{
				$returnHtml = '';
				$returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>' . trans("template.common.title") . '</th>
														<th>' . trans("template.common.image") . '</th>
														<th>' . trans("template.common.displayorder") . '</th>
														<th>' . trans("template.common.serviceIcon") . '</th>
														<th>' . trans("template.common.shortDescription") . '</th>
														<th>' . trans("template.common.description") . '</th>
														<th>' . trans("template.serviceModule.featuredService") . '</th>
														<th>' . trans("template.common.metatitle") . '</th>
														<th>' . trans("template.common.metakeyword") . '</th>
														<th>' . trans("template.common.metadescription") . '</th>
														<th>' . trans("template.common.publish") . '</th>
													</tr>
												</thead>
												<tbody>
														<tr>
																<td>' . $data->varTitle . '</td>';

				if ($data->fkIntImgId > 0) {
						$returnHtml .= '<td>' . '<img height="50" width="50" src="' . resize_image::resize($data->fkIntImgId) . '" />' . '</td>';
				} else {
						$returnHtml .= '<td>-</td>';
				}
				$returnHtml .= '<td>' . ($data->intDisplayOrder) . '</td>
																<td>' . $data->varFontAwesomeIcon . '</td>
																<td>' . $data->txtShortDescription . '</td>
																<td>' . $data->txtDescription . '</td>
																<td>' . $data->chrFeaturedService . '</td>
																<td>' . $data->varMetaTitle . '</td>
																<td>' . $data->varMetaKeyword . '</td>
																<td>' . $data->varMetaDescription . '</td>
																<td>' . $data->chrPublish . '</td>
														</tr>
												</tbody>
										</table>';
				return $returnHtml;
		}

		public function tableData($value = false, $catModuleID = false)
		{
			$publish_action = '';
				if (Auth::user()->can('services-edit')) {
						$details = '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.services.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
				}
				if (Auth::user()->can('services-delete')) {
						$details .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="services" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}

				if (Auth::user()->can('services-publish')) {
						if (!empty($value->chrPublish) && ($value->chrPublish == 'Y')) {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/services" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
						} else {
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/services" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
						}
				}

				 $details .='<a class="without_bg_icon share" title="Share" data-modal="Services" data-alias="'.$value->id.'"  data-images="'.$value->fkIntImgId.'" data-link = "'.url('/services/'.$value->alias['varAlias']).'" data-toggle="modal" data-target="#confirm_share">
				     <i class="fa fa-share-alt"></i></a>';

				if (Auth::user()->can('services-edit')) {
						$title = '<a class="" title="Edit" href="' . route('powerpanel.services.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
				} else {
						$title = $value->varTitle;
				}
				$imgIcon = '';
				if (isset($value->fkIntImgId) && !empty($value->fkIntImgId)) 
				{
						$imageArr = explode(',',$value->fkIntImgId);
						if(count($imageArr) > 1)
						{	
							$imgIcon .= '<div class="multi_image_thumb">';
								foreach ($imageArr as $key => $image) 
								{			
									$imgIcon .= '<a href="' . resize_image::resize($image) . '" class="fancybox-thumb" rel="fancybox-thumb-'.$value->id.'" data-rel="fancybox-thumb">';
									$imgIcon .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) . '" src="' . resize_image::resize($image, 50, 50) . '"/>';	
									$imgIcon .= '</a>';
								}
							$imgIcon .= '</div>';					
						}else{
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
				if (isset($value->txtCategories)) {
						$categoryIDs = unserialize($value->txtCategories);
						$selCategory = ServiceCategory::getParentCategoryNameBycatId($categoryIDs);

						$category .= '<div class="pro-act-btn"><a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'' . trans("template.common.category") . '\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-info"></span></a>';
						$category .= '<div class="highslide-maincontent">';
						$category .= '<ul>';
						foreach ($selCategory as $selCat) {
								if (strlen(trim($selCat)) > 0) {
										$category .= '<li>';
										$category .= $selCat->varTitle;
										$category .= '</li>';
								}
						}
						$category .= '<ul>';
						$category .= '</div>';
						$category .= '</div>';
				} else {
						$category .= '<span class="glyphicon glyphicon-minus"></span>';
				}

				$fontAwesomeIcon = '';
				if (!empty($value->varFontAwesomeIcon)) {
						//$fontAwesomeIcon .= ucfirst($value->varFontAwesomeIcon);
						$fontAwesomeIcon .= '<i class="fa ' . strtolower($value->varFontAwesomeIcon) . '"></i>';
				} else {
						$fontAwesomeIcon .= '<span class="glyphicon glyphicon-minus"></span>';
				}
				

						$featuredService = '';				
					if (!empty($value->chrFeaturedService)) {
							if ($value->chrFeaturedService == 'Y') {
									$featuredService .= '<a href="javascript:makeFeatured('. $value->id .',\'N\');"><i class="fa fa-star" aria-hidden="true"></i></a>';
							} else {									
										$featuredService .= '<a href="javascript:makeFeatured('. $value->id .',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
									
							}
					} else {							
								$featuredService .= '<a href="javascript:makeFeatured('. $value->id .',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
							
					}

				if (Auth::user()->can('services-edit')) {
						$title = '<a class="" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.services.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
				} else {
						$title = $value->varTitle;
				}
				$records = array(
						'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">',
						$title,
						'<div class="pro-act-btn">
					<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'' . trans("template.common.shortdescription") . '\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
						<div class="highslide-maincontent">' . nl2br($value->txtShortDescription) . '</div>
					</div>',
						$imgIcon,
						$category,						
						$fontAwesomeIcon,
						'<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
						<a href="javascript:;"  data-order="' . $value->intDisplayOrder . '" class="moveTo" data-module="services">' . $value->intDisplayOrder . '</a>
						<a href="javascript:;"  data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
						$featuredService,
						$publish_action,
						$details,
						$value->intDisplayOrder,
				);
				return $records;
		}	

		public static function flushCache()
		{
			Cache::tags('Services')->flush();
			Cache::tags('ServiceCategory')->flush();
		}

}
