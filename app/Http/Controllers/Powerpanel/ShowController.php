<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\Show;
use App\ShowCategory;
use App\Modules;
use App\Team;
use App\Alias;
use App\Video;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use App\Helpers\AddImageModelRel;
use App\Helpers\AddVideoModelRel;
use DB;
use App\Log;
use App\RecentUpdates;   
use App\CommonModel;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use Config;
use Auth;
use Cache;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;

class ShowController extends PowerpanelController {
				
		public function __construct() {
			parent::__construct();
			if (isset($_COOKIE['locale'])) {
					app()->setLocale($_COOKIE['locale']);
			}			
		}

		/**
		 * This method handels load process of show
		 * @return  View
		 * @since   2017-08-01
		 * @author  NetQuick
		 */
		public function index() 
		{
			$iTotalRecords = CommonModel::getRecordCount();
			$ShowCategory = $iTotalRecords>0 ? ShowCategory::getCatWithParent():null;
			$this->breadcrumb['title'] = trans('template.showsModule.manageShows');
			$breadcrumb = $this->breadcrumb;
			return view('powerpanel.shows.index', compact('ShowCategory','iTotalRecords', 'breadcrumb'));
		}


		/**
		 * This method loads show edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($id=false) 
		{				
			$category = ShowCategory::getCatWithParent();
			$category = CategoryArrayBuilder::getArray($category);
			$ShowCategory = json_encode($category);
			$djObj = Team::getTeamTitlesByIds();		
			$imageManager	 = true;
			$videoManager	 = true;
			$categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false,false,'\App\ShowCategory');
			if(!is_numeric($id)){
				$total = CommonModel::getRecordCount();
				$total = $total + 1;
				$this->breadcrumb['title'] = trans('template.showsModule.addShow');
				$this->breadcrumb['module'] = trans('template.showsModule.manageShows');
				$this->breadcrumb['url'] = 'powerpanel/shows';
				$this->breadcrumb['inner_title'] = trans('template.showsModule.addShow');
				$breadcrumb = $this->breadcrumb;
				$data=compact('djObj','ShowCategory','total', 'breadcrumb','imageManager','videoManager','categoryHeirarchy');
			}else{
				$show = Show::getRecordById($id);
				if(count($show)==0){ return redirect()->route('powerpanel.shows.add'); }
				$metaInfo = array('varMetaTitle' => $show->varMetaTitle, 'varMetaKeyword' => $show->varMetaKeyword, 'varMetaDescription' => $show->varMetaDescription);
				$this->breadcrumb['title'] = trans('template.showsModule.editShow') . ' - ' . $show->varTitle;
				$this->breadcrumb['module'] = trans('template.showsModule.manageShows');
				$this->breadcrumb['url'] = 'powerpanel/shows';
				$this->breadcrumb['inner_title'] = trans('template.showsModule.editShow') . ' - ' . $show->varTitle;
				$breadcrumb = $this->breadcrumb;
				$data=compact('show', 'ShowCategory', 'djObj', 'metaInfo', 'breadcrumb','imageManager','videoManager','categoryHeirarchy');
			}			
			return view('powerpanel.shows.actions', $data);				
		}
		/**
		 * This method stores show modifications
		 * @return  View
		 * @since   2017-08-01
		 * @author  NetQuick
		 */
		public function handlePost(Request $request) 
		{
				$data = Input::get();

				$actionMessage = trans('template.common.oppsSomethingWrong');
				$messsages = $this->serverSideValidationMessages();
				$rules = $this->serverSideValidationRules($data);

				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {
						$show_days = implode(',',$data['show_days']);
						$author_by = '';
						if(isset($data['author_by'])){
							$author_by = implode(',',$data['author_by']);	
						}

						$showArr = [];
						$showArr['varShowDays'] =	$show_days;
						$showArr['varAuthor'] =	$author_by;
						$showArr['txtCategories'] = isset($data['category_id'])?serialize($data['category_id']):null;
						$showArr['varTitle'] = trim($data['title']);
						$showArr['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
						$showArr['fkIntVideoId'] = !empty($data['video_id'])?$data['video_id']:0;
						$showArr['dtStartDateTime'] = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data['start_date_time'])));
						$showArr['dtEndDateTime'] = !empty($data['end_date_time'])?date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data['end_date_time']))):null;
						$showArr['varFeaturedShow'] = $data['featuredShow'];
						$showArr['txtDescription'] = $data['description'];
						$showArr['txtShortDescription'] = $data['short_description'];						
						$showArr['varMetaTitle'] = trim($data['varMetaTitle']);
						$showArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
						$showArr['varMetaDescription'] = trim($data['varMetaDescription']);
						$showArr['chrPublish'] = $data['chrMenuDisplay'];

						$id = $request->segment(3);
						if(is_numeric($id)){ #Edit post Handler=======
						if($data['oldAlias'] != $data['alias']){
							Alias::updateAlias($data['oldAlias'], $data['alias']);	
						}
						$show = Show::getRecordForLogById($id);
						$whereConditions = ['id' => $show->id];
						$update = CommonModel::updateRecords($whereConditions, $showArr);
						if ($update) {
								if (!empty($id)) {
										self::swap_order_edit($data['display_order'], $show->id);

										$logArr = MyLibrary::logData($show->id);
										if (!Auth::user()->can('log-advanced')) 
										{
											$newShowObj = Show::getRecordForLogById($show->id);
											$oldRec = $this->recordHistory($show);
											$newRec = $this->recordHistory($newShowObj);
											$logArr['old_val'] = $oldRec;
											$logArr['new_val'] = $newRec;	
										}
										$logArr['varTitle'] = trim($data['title']);									
										Log::recordLog($logArr);

										if (Auth::user()->can('recent-updates-list')) {
											if(!isset($newShowObj)){
												$newShowObj = Show::getRecordForLogById($show->id);
											}
											$notificationArr = MyLibrary::notificationData($show->id, $newShowObj);
											RecentUpdates::setNotification($notificationArr);
											
										}	
										self::flushCache();
										Cache::forget('getShowDetail_'.$id);
										$actionMessage = trans('template.showsModule.updateMessage');								
								}
							}
							
						}else{ #Add post Handler=======
							$showArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
							$showArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
							$showID = CommonModel::addRecord($showArr);
							if (!empty($showID)) {
									$id = $showID;
									$newShowObj = Show::getRecordForLogById($id);
									
									$logArr = MyLibrary::logData($id);
									$logArr['varTitle'] = $newShowObj->varTitle;
									Log::recordLog($logArr);

									if (Auth::user()->can('recent-updates-list')) {
										$notificationArr = MyLibrary::notificationData($id, $newShowObj);
										RecentUpdates::setNotification($notificationArr);
									}
									self::flushCache();
									$actionMessage = trans('template.showsModule.addMessage');
							}
						}
						AddImageModelRel::sync(explode(',', $data['img_id']), $id);
						AddVideoModelRel::sync(explode(',', $data['video_id']), $id);
						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.shows.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.shows.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads show table data on view
		 * @return  View
		 * @since   2017-08-01
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
				$filterArr['statusFilter'] = !empty(Input::get('statusValue')) ? Input::get('statusValue') : '';
				$filterArr['catFilter'] = !empty(Input::get('catValue')) ? Input::get('catValue') : '';
				$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
				$filterArr['showFilter'] = !empty(Input::get('showFilter')) ? Input::get('showFilter') : '';
				$filterArr['start'] = !empty(Input::get('rangeFilter')['from']) ? Input::get('rangeFilter')['from'] : '';
				$filterArr['end'] = !empty(Input::get('rangeFilter')['to']) ? Input::get('rangeFilter')['to'] : '';
				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart'] = intval(Input::get('start'));
				$sEcho = intval(Input::get('draw'));
				$arrResults = Show::getRecordList($filterArr);
				$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
				$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				$end = $end > $iTotalRecords ? $iTotalRecords : $end;
				if (!empty($arrResults)) {
					foreach($arrResults as $key => $value)
					{
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
		 * This method delete multiples show
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

	public function makeFeatured() {
			$id = Input::get('id');
			$featured = Input::get('featured');
			$whereConditions = ['id' => $id];
			$update = CommonModel::updateRecords($whereConditions, ['varFeaturedShow'=>$featured]);
			self::flushCache();
			echo json_encode($update);
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
			* @since   2017-07-27
			* @author  NetQuick
			*/
		public function recordHistory($data=false) 
		{
				$videoTitle = "-";
				if($data->fkIntVideoId > 0 && $data->fkIntVideoId != null){
						$videoDetail = Video::getVideoTitleById($data->fkIntVideoId);
						if(isset($videoDetail->varVideoName))
						{
							$videoTitle = ($videoDetail->varVideoName != "") ? $videoDetail->varVideoName.".".$videoDetail->varVideoExtension:'-';	
						}
						
				}
				$returnHtml = '';
				$returnHtml.= '<table class="new_table_desing table table-striped table-bordered table-hover">
										<thead>
												<tr>
														<th>'.trans("template.common.title").'</th>
														<th>'.trans("template.common.startdate").'</th>
														<th>'.trans("template.common.enddate").'</th>
														<th>'.trans("template.common.image").'</th>
														<th>'.trans("template.common.video").'</th>
														<th>'.trans("template.common.order").'</th>
														<th>'.trans("template.common.shortDescription").'</th>
														<th>'.trans("template.common.description").'</th>
														<th>'.trans("template.showsModule.featuredShow").'</th>
														<th>'.trans("template.common.days").'</th>
														<th>'.trans("template.common.metatitle").'</th>
														<th>'.trans("template.common.metakeyword").'</th>
														<th>'.trans("template.common.metadescription").'</th>
														<th>'.trans("template.common.publish").'</th>
												</tr>
										</thead>
										<tbody>
												<tr>
														<td>' . $data->varTitle . '</td>
														<td>' . $data->dtStartDateTime . '</td>
														<td>' . $data->dtEndDateTime . '</td>';
														if($data->fkIntImgId > 0){
																$returnHtml.= '<td>'.'<img height="50" width="50" src="'.resize_image::resize($data->fkIntImgId).'" />'.'</td>';
														}else{
																$returnHtml.= '<td>-</td>';
														}
														$returnHtml.= '<td>' . $videoTitle . '</td>
														<td>' . ($data->intDisplayOrder) . '</td>
														<td>' . $data->txtShortDescription . '</td>
														<td>' . $data->txtDescription . '</td>
														<td>' . $data->varFeaturedShow . '</td>
														<td>' . $data->varShowDays . '</td>
														<td>'.$data->varMetaTitle.'</td>
														<td>'.$data->varMetaKeyword.'</td>
														<td>'.$data->varMetaDescription.'</td>
														<td>'.$data->chrPublish.'</td>
												</tr>
										</tbody>
								</table>';
				return $returnHtml;
		}
		
		public function tableData($value = false) 
		{
			$publish_action='';
				if($value->varAuthor != "")
				{
					$djIds = explode(',',$value->varAuthor);		
					$djObj = Team::getTeamTitlesByIds($djIds);
				}else{
					$djObj = [];
				}
				
				$djs = '<span class="glyphicon glyphicon-minus"></span>';
				if(count($djObj) > 0)
				{
					foreach ($djObj as $key => $dj) {
						$djs .= ' '.$dj->varTitle.',';
					}		
				}

				$details = '';
				if(Auth::user()->can('shows-edit'))
				{
						$details.= '<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.shows.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
				}    
				if(Auth::user()->can('shows-delete'))
				{
						$details.= '&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="shows" data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
				}   

				if(Auth::user()->can('shows-publish'))
				{	
					if ($value->chrPublish == 'Y') {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/shows" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
					} else {
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/shows" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
					}
				}


				$featuredBlog = '';				
				if (!empty($value->varFeaturedShow)) {
					if ($value->varFeaturedShow == 'Y') {
							$featuredBlog .= '<a href="javascript:makeFeatured('. $value->id .',\'N\');"><i class="fa fa-star" aria-hidden="true"></i></a>';
					} else {									
						$featuredBlog .= '<a href="javascript:makeFeatured('. $value->id .',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
					}
				} else {							
					$featuredBlog .= '<a href="javascript:makeFeatured('. $value->id .',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
				}


				$records = array(				
				'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">', 				
				'<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.shows.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>', 
				'<div class="pro-act-btn"><a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.shortdescription").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a><div class="highslide-maincontent">
				'.$value->txtShortDescription.'</div>
				</div>', 				
				rtrim($djs,','),
				date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'', strtotime($value->dtStartDateTime)), 
				!empty($value->dtEndDateTime)?date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'', strtotime($value->dtEndDateTime)):'-', 				
				'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				'.$value->intDisplayOrder.
				' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
				$featuredBlog,
				$publish_action,
				$details,
				$value->intDisplayOrder
				);
				return $records;
		}

		public function serverSideValidationRules($data=false)
		{	
					$rules = array(
						'title' => 'required|max:160',
						'show_days' => 'required',					
						'video_id' => 'required',
						'display_order' => 'required|greater_than_zero',
						'varMetaTitle' => 'required|max:500',
						'varMetaKeyword' => 'required|max:500',
						'varMetaDescription' =>  'required|max:500',
						'chrMenuDisplay' => 'required',
						'alias'=>'required',
						'start_date_time' => 'required',
					);	
				
				

				return $rules;
		}

		public function serverSideValidationMessages()
		{
				$messsages = [
					'title.required' => trans("template.showsModule.pleaseSelectTitleMessage"),
					'show_days.required' => trans("template.showsModule.pleaseSelectDaysMessage"),
					'video_id.required' => trans("template.showsModule.pleaseSelectVideoMessage"),
					'category_id.required' => trans("template.showsModule.pleaseSelectCategoryMessage"),
					'start_date_time.required' => trans("template.showsModule.PleaseSelectDateTimeMessage"),
					'end_date_time.required' => trans("template.showsModule.PleaseSelectDateTimeMessage"),
					'display_order.greater_than_zero'=> trans("template.showsModule.displayGreaterThan"),
					'alias.required' => trans("template.showsModule.aliasMessage"),
					'varMetaTitle.required' => trans("template.showsModule.metaTitleMessage"),
					'varMetaKeyword.required' => trans("template.showsModule.metaKeywordMessage"),
					'varMetaDescription.required' => trans("template.showsModule.metaDescriptionMessage"),
					'display_order.required' => trans("template.showsModule.displayOrderMessage"),
					'chrMenuDisplay' => trans("template.showsModule.menuDisplayMessage")
				];
				return $messsages;
		}

		public static function flushCache(){
				Cache::tags('Shows')->flush();
				Cache::tags('ShowsCategory')->flush();
		}
}
