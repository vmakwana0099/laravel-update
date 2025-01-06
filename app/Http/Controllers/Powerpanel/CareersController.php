<?php
namespace App\Http\Controllers\Powerpanel;

use App\Alias;
use App\CommonModel;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Helpers\AddImageModelRel;
use App\Http\Controllers\PowerpanelController;
use App\Log;
use App\Modules;
use App\RecentUpdates;
use App\CareersCategory;
use App\Careers;
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
use Config;

class CareersController extends PowerpanelController
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
		 * This method handels load process of careers
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index()
		{
				$iTotalRecords             = CommonModel::getRecordCount();
				$CareersCategory          = $iTotalRecords > 0 ? CareersCategory::getCatWithParent() : null;
				$this->breadcrumb['title'] = trans('template.careerModule.manageCareers');
				$breadcrumb                = $this->breadcrumb;
				return view('powerpanel.careers.index', compact('iTotalRecords', 'CareersCategory', 'breadcrumb'));
		}
		/**
		 * This method loads career edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($id = false)
		{
				$category = CareersCategory::getCatWithParent();
				$category = CategoryArrayBuilder::getArray($category);
				$CareersCategory = json_encode($category);				 
				$imageManager	 = true;				
				#icon code======================================
				$categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false,false,'\App\CareersCategory');
				if (!is_numeric($id)) {
						$total                           = CommonModel::getRecordCount();
						$total                           = $total + 1;
						$this->breadcrumb['title']       = trans('template.careerModule.addCareer');
						$this->breadcrumb['module']      = trans('template.careerModule.manageCareers');
						$this->breadcrumb['url']         = 'powerpanel/careers';
						$this->breadcrumb['inner_title'] = trans('template.careerModule.addCareer');
						$breadcrumb                      = $this->breadcrumb;
						$data                            = compact('total', 'CareersCategory', 'breadcrumb', 'imageManager','categoryHeirarchy');
				} else {
						$career                          = Careers::getRecordById($id);
						if(count((array)$career)==0){ return redirect()->route('powerpanel.careers.add'); }
						$metaInfo                        = array('varMetaTitle' => $career->varMetaTitle, 'varMetaKeyword' => $career->varMetaKeyword, 'varMetaDescription' => $career->varMetaDescription);
						$this->breadcrumb['title']       = trans('template.careerModule.editCareer') . ' - ' . $career->varTitle;
						$this->breadcrumb['module']      = trans('template.careerModule.manageCareers');
						$this->breadcrumb['url']         = 'powerpanel/careers';
						$this->breadcrumb['inner_title'] = trans('template.careerModule.editCareer') . ' - ' . $career->varTitle;
						$breadcrumb                      = $this->breadcrumb;
						$data                            = compact('career', 'CareersCategory', 'metaInfo', 'breadcrumb', 'imageManager','categoryHeirarchy');
						$categoryIDs = unserialize($data['career']->txtCategories);
						$data['career']->fkProductCategories=$categoryIDs;
				}

				
				// echo '<pre>';print_r($data);exit;
				return view('powerpanel.careers.actions', $data);
		}

		/**
		 * This method stores career modifications
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
						'display_order'              => 'required|greater_than_zero',
						'chrMenuDisplay'     => 'required',
						'short_description'  => 'required|max:'.(isset($settings)?$settings->short_desc_length:400),
						'varMetaTitle'       => 'required|max:160',
						'varMetaKeyword'     => 'required|max:160',
						'varMetaDescription' => 'required|max:160',
						'alias'              => 'required',
				);
				$messsages = array(
						'display_order.greater_than_zero'     => trans('template.careerModule.displayGreaterThan'),
						'short_description.required'  => trans('template.careerModule.shortDescription'),
						'varMetaTitle.required'       => trans('template.careerModule.metaTitle'),
						'varMetaKeyword.required'     => trans('template.careerModule.metaKeyword'),
						'varMetaDescription.required' => trans('template.careerModule.metaDescription'),

				);

				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {
						$careerArr                        = [];
						$careerArr['varTitle']            = trim($data['title']);
						$careerArr['fkIntImgId']          = !empty($data['img_id']) ? $data['img_id'] : null;
						$careerArr['dtDateTime'] = !empty($data['start_date'])?date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['start_date']))):date('Y-m-d H:i:s');
						$careerArr['varExternalLink']     = '';
						$careerArr['txtDescription']      = $data['description'];
						$careerArr['txtShortDescription'] = trim($data['short_description']);
						$careerArr['txtCategories']       = isset($data['category_id']) ? serialize($data['category_id']) : null;
						$careerArr['varMetaTitle']        = trim($data['varMetaTitle']);
						$careerArr['varMetaKeyword']      = trim($data['varMetaKeyword']);
						$careerArr['varMetaDescription']  = trim($data['varMetaDescription']);
						$careerArr['chrPublish']          = $data['chrMenuDisplay'];
						$careerArr['created_at']          = Carbon::now();

						$id = $request->segment(3);
						if (is_numeric($id)) {
								#Edit post Handler=======
								if ($data['oldAlias'] != $data['alias']) {
										Alias::updateAlias($data['oldAlias'], $data['alias']);
								}
								$career         = Careers::getRecordForLogById($id);
								$whereConditions = ['id' => $career->id];
								$update          = CommonModel::updateRecords($whereConditions, $careerArr);
								if ($update) {
										if (!empty($id)) {
												self::swap_order_edit($data['display_order'], $career->id);

												$logArr = MyLibrary::logData($career->id);
												if (Auth::user()->can('log-advanced')) {
														$newCategoryObj     = Careers::getRecordForLogById($career->id);
														$oldRec            = $this->recordHistory($career);
														$newRec            = $this->recordHistory($newCategoryObj);
														$logArr['old_val'] = $oldRec;
														$logArr['new_val'] = $newRec;
												}
												$logArr['varTitle'] = trim($data['title']);
												Log::recordLog($logArr);
												if (Auth::user()->can('recent-updates-list')) {
														if (!isset($newCategoryObj)) {
																$newCategoryObj = Careers::getRecordForLogById($career->id);
														}
														$notificationArr = MyLibrary::notificationData($career->id, $newCategoryObj);
														RecentUpdates::setNotification($notificationArr);
												}
										}
										self::flushCache();
										$actionMessage = trans('template.careerModule.updateMessage');
								}
						} else {
								#Add post Handler=======
								$careerArr['intAliasId']          = MyLibrary::insertAlias($data['alias']);
								$careerArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
								$careerID                     = CommonModel::addRecord($careerArr);
								if (!empty($careerID)) {
										$id            = $careerID;
										$newCategoryObj = Careers::getRecordForLogById($id);

										$logArr             = MyLibrary::logData($id);
										$logArr['varTitle'] = $newCategoryObj->varTitle;
										Log::recordLog($logArr);
										if (Auth::user()->can('recent-updates-list')) {
												$notificationArr = MyLibrary::notificationData($id, $newCategoryObj);
												RecentUpdates::setNotification($notificationArr);
										}
										self::flushCache();
										$actionMessage = trans('template.careerModule.addedMessage');
								}
						}
						AddImageModelRel::sync(explode(',', $data['img_id']), $id);
						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.careers.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.careers.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads careers table data on view
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
				$filterArr['rangeFilter']        = !empty(Input::get('rangeFilter')) ? Input::get('rangeFilter') : '';
				$sEcho                           = intval(Input::get('draw'));
				$arrResults                      = Careers::getRecordList($filterArr);
				$iTotalRecords                   = CommonModel::getRecordCount($filterArr, true);
				$end                             = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				$end                             = $end > $iTotalRecords ? $iTotalRecords : $end;
				if (!empty($arrResults)) {
						$this->catModule = Modules::getModule('careers-category')->id;
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
		 * This method delete multiples careers
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

		/**
		 * This method destroys Category in multiples
		 * @return  Category index view
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
														<th>' . trans("template.common.shortDescription") . '</th>
														<th>' . trans("template.common.description") . '</th>
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
																<td>' . $data->txtShortDescription . '</td>
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

		public function tableData($value = false, $catModuleID = false)
		{
			$publish_action = '';
				if (Auth::user()->can('careers-edit')) {
						$details = '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.careers.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
				}
				if (Auth::user()->can('careers-delete')) {
						$details .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="careers" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}

				if (Auth::user()->can('careers-publish')) {
						if (!empty($value->chrPublish) && ($value->chrPublish == 'Y')) {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/careers" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
						} else {
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/careers" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
						}
				}
				 $details .='<a class="without_bg_icon share" title="Share" data-modal="Careers" data-alias="'.$value->id.'"  data-images="'.$value->fkIntImgId.'" data-link = "'.url('/careers/'.$value->alias['varAlias']).'" data-toggle="modal" data-target="#confirm_share">
				     <i class="fa fa-share-alt"></i></a>';

				if (Auth::user()->can('careers-edit')) {
						$title = '<a class="" title="Edit" href="' . route('powerpanel.careers.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
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
						$selCategory = CareersCategory::getParentCategoryNameBycatId($categoryIDs);

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

				if (Auth::user()->can('careers-edit')) {
						$title = '<a class="" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.careers.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
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
						date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'', strtotime($value->dtDateTime)),
						'<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
						<a href="javascript:;"  data-order="' . $value->intDisplayOrder . '" class="moveTo" data-module="careers">' . $value->intDisplayOrder . '</a>
						<a href="javascript:;"  data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
						$publish_action,
						$details,
						$value->intDisplayOrder,
				);
				return $records;
		}	

		public static function flushCache()
		{
			Cache::tags('Careers')->flush();
			Cache::tags('CareersCategory')->flush();
		}

}
