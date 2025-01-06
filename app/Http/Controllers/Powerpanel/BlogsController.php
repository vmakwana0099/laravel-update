<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\Blogs;
use App\BlogCategory;
use App\Modules;
use App\Alias;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use App\Log;
use App\RecentUpdates;   
use App\CommonModel;
use App\Helpers\MyLibrary;
use Auth;
use Config;
use Cache;
use App\Helpers\resize_image;
use App\Helpers\AddImageModelRel;
use App\Helpers\AddVideoModelRel;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;

class BlogsController extends PowerpanelController {		
		public function __construct() {
			parent::__construct();
			if (isset($_COOKIE['locale'])) {
					app()->setLocale($_COOKIE['locale']);
			}			
		}
		/**
		 * This method handels load process of blog
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index() {
			$iTotalRecords = CommonModel::getRecordCount();
			$BlogCategory= $iTotalRecords>0 ? BlogCategory::getCatWithParent():null;
			$this->breadcrumb['title'] = trans('template.blogModule.manage');
			$breadcrumb = $this->breadcrumb;
			return view('powerpanel.blog.index', compact('BlogCategory','iTotalRecords', 'breadcrumb'));
		}		
		
		/**
		 * This method loads blog edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($id=false) 
		{	
			$category = BlogCategory::getCatWithParent();
			$category = CategoryArrayBuilder::getArray($category);			
			$BlogCategory = json_encode($category);
			

			$imageManager = true;
			$videoManager  = true;
			$categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false,false,'\App\BlogCategory');
			if(!is_numeric($id))
			{
				$total = CommonModel::getRecordCount()+1;
				$this->breadcrumb['title'] = trans('template.blogModule.add');
				$this->breadcrumb['module'] = trans('template.blogModule.manage');
				$this->breadcrumb['url'] = 'powerpanel/blogs';
				$this->breadcrumb['inner_title'] = trans('template.blogModule.add');
				$breadcrumb = $this->breadcrumb;
				$data=compact('total', 'BlogCategory', 'breadcrumb','imageManager','videoManager','categoryHeirarchy');
			}else{				
				$blog = Blogs::getRecordById($id);
				if(count($blog)==0){ return redirect()->route('powerpanel.blogs.add'); }
				$metaInfo = array('varMetaTitle' => $blog->varMetaTitle, 'varMetaKeyword' => $blog->varMetaKeyword, 'varMetaDescription' => $blog->varMetaDescription);
				$this->breadcrumb['title'] = trans('template.blogModule.edit') . ' - ' . $blog->varTitle;
				$this->breadcrumb['module'] = trans('template.blogModule.manage');
				$this->breadcrumb['url'] = 'powerpanel/blogs';
				$this->breadcrumb['inner_title'] = trans('template.blogModule.edit') . ' - ' . $blog->varTitle;
				$breadcrumb = $this->breadcrumb;
				$data=compact('blog', 'BlogCategory', 'alias', 'metaInfo', 'breadcrumb','imageManager','videoManager','categoryHeirarchy');
			}			
			return view('powerpanel.blog.actions', $data);				
		}

		/**
		 * This method stores blog modifications
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function handlePost(Request $request) {
				$data = Input::get();	
				$actionMessage = trans('template.common.oppsSomethingWrong');
				$settings = json_decode(Config::get("Constant.MODULE.SETTINGS"));
				$messsages = array('display_order.greater_than_zero' => trans('template.blogModule.displayGreaterThan'), 'start_date_time.date_format' => trans('template.blogModule.startDateErrorMessage'), 'end_date_time.date_format' => trans('template.blogModule.endDateErrorMessage'));
				$rules = array(
					'title' => 'required|max:160', 
					'start_date' => 'required', 
					'display_order' => 'required|greater_than_zero', 
					'varMetaTitle' => 'required|max:160', 
					'varMetaKeyword' => 'required|max:160', 
					'varMetaDescription' => 'required|max:160',
					'short_description'  => 'required|max:'.(isset($settings)?$settings->short_desc_length:400)
				);
				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) 
				{
						$blogFields['varTitle'] = trim($data['title']);
						$blogFields['varAuthor']  =  trim($data['author']);
						$blogFields['txtCategories']  =  isset($data['category_id'])?serialize($data['category_id']):null;
						$blogFields['varExternalLink'] = $data['external_link'];
						$blogFields['varFeaturedBlog'] = $data['featuredBlog'];
						$blogFields['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
						$blogFields['fkIntVideoId'] = !empty($data['video_id'])?$data['video_id']:null;
						$blogFields['dtStartDateTime'] = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data['start_date'])));
						$blogFields['txtShortDescription'] = trim($data['short_description']);
						$blogFields['txtDescription'] = $data['description'];
						$blogFields['varMetaTitle'] = trim($data['varMetaTitle']);
						$blogFields['varMetaKeyword'] = trim($data['varMetaKeyword']);
						$blogFields['varMetaDescription'] = trim($data['varMetaDescription']);
						$blogFields['chrPublish'] = $data['chrMenuDisplay'];
						$id = $request->segment(3);
						if(is_numeric($id)){ #Edit post Handler=======
							if($data['oldAlias'] != $data['alias']){
								Alias::updateAlias($data['oldAlias'], $data['alias']);	
							}
							$blog = Blogs::getRecordForLogById($id);
							$whereConditions = ['id' => $blog->id];
							$update = CommonModel::updateRecords($whereConditions, $blogFields);							
							if ($update) {
								if (!empty($id)) {
										self::swap_order_edit($data['display_order'], $blog->id);

										$logArr = MyLibrary::logData($blog->id);
										if (Auth::user()->can('log-advanced')) {
												$newBlogObj = Blogs::getRecordForLogById($blog->id);
												$oldRec = $this->recordHistory($blog);
												$newRec = $this->recordHistory($newBlogObj);
												$logArr['old_val'] = $oldRec;
												$logArr['new_val'] = $newRec;
										}
										$logArr['varTitle'] = trim($data['title']);
										Log::recordLog($logArr);										
										if (Auth::user()->can('recent-updates-list')) {
											if(!isset($newBlogObj)){
												$newBlogObj = Blogs::getRecordForLogById($blog->id);
											}
											$notificationArr = MyLibrary::notificationData($blog->id, $newBlogObj);
											RecentUpdates::setNotification($notificationArr);
										}										
								}
								self::flushCache();
								$actionMessage = trans('template.blogModule.updateMessage');
							}
						}else{ #Add post Handler=======
							$blogFields['intAliasId'] = MyLibrary::insertAlias($data['alias']);
							$blogFields['intDisplayOrder'] = self::swap_order_add($data['display_order']);
							$blogID = CommonModel::addRecord($blogFields);
							if (!empty($blogID)) {
									$id=$blogID;
									$newBlogObj = Blogs::getRecordForLogById($id);
									$logArr = MyLibrary::logData($id);									
									$logArr['varTitle'] = $newBlogObj->varTitle;
									Log::recordLog($logArr);
									if (Auth::user()->can('recent-updates-list')) {
										$notificationArr = MyLibrary::notificationData($id, $newBlogObj);									
										RecentUpdates::setNotification($notificationArr);
									}
									self::flushCache();
									$actionMessage = trans('template.blogModule.addMessage');
							}
						}

						AddImageModelRel::sync(explode(',', $data['img_id']), $id);
						AddVideoModelRel::sync(explode(',', $data['video_id']), $id);

						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {				
								return redirect()->route('powerpanel.blogs.index')->with('message', $actionMessage);
						} else {							
								return redirect()->route('powerpanel.blogs.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		
		/**
		 * This method loads blog table data on view
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
				$filterArr['blogFilter'] = !empty(Input::get('blogFilter')) ? Input::get('blogFilter') : '';
				$filterArr['personalityFilter'] = !empty(Input::get('personalityFilter')) ? Input::get('personalityFilter') : '';
				$filterArr['paymentFilter'] = !empty(Input::get('paymentFilter')) ? Input::get('paymentFilter') : '';
				$filterArr['start'] = !empty(Input::get('rangeFilter')['from']) ? Input::get('rangeFilter')['from'] : '';
				$filterArr['end'] = !empty(Input::get('rangeFilter')['to']) ? Input::get('rangeFilter')['to'] : '';
				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart'] = intval(Input::get('start'));
				$sEcho = intval(Input::get('draw'));
				$arrResults = Blogs::getRecordList($filterArr);
				$iTotalRecords = CommonModel::getRecordCount($filterArr, true);
				$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				$end = $end > $iTotalRecords ? $iTotalRecords : $end;
				if (!empty($arrResults)) {						
						$counts = array_count_values(
						    array_column($arrResults->toArray(), 'varFeaturedBlog')
						);
						$final = array_filter($counts, function($a) {
						   return $a;
						});
						$fcnt = isset($final['Y'])?$final['Y']:0;
						foreach ($arrResults as $key => $value) {								
								$records["data"][] = $this->tableData($value, $fcnt);
						}
				}
				$records["customActionStatus"] = "OK";
				$records["draw"] = $sEcho;
				$records["recordsTotal"] = $iTotalRecords;
				$records["recordsFiltered"] = $iTotalRecords;
				return json_encode($records);
		}
		/**
		 * This method delete multiples blog
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
		 * This method reorders blog
		 * @return  blog index view data
		 * @since   2016-10-11
		 * @author  NetQuick
		 */
		public function reorder() {
			$order=Input::get('order');
			$exOrder=Input::get('exOrder');
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

		
		public function makeFeatured() {
			$id = Input::get('id');
			$featured = Input::get('featured');
			$whereConditions = ['id' => $id];
			$update = CommonModel::updateRecords($whereConditions, ['varFeaturedBlog'=>$featured]);
			self::flushCache();						
			echo json_encode($update);
		}
		
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
		* @since   2017-07-21
		* @author  NetQuick
		*/
		public function recordHistory($data=false) 
		{
			$returnHtml = '';
			$returnHtml.= '<table class="new_table_desing table table-striped table-bordered table-hover">
						<thead>
								<tr>
										<th>'.trans("template.common.title").'</th>
										<th>'.trans("template.common.author").'</th>
										<th>'.trans("template.common.image").'</th>
										<th>'.trans("template.common.order").'</th>
										<th>'.trans("template.blogModule.publishDateandTime").' </th>
										<th>'.trans("template.common.shortDescription").'</th>
										<th>'.trans("template.common.description").'</th>
										<th>'.trans("template.blogModule.isfeaturedblog").'</th>
										<th>'.trans("template.common.metatitle").'/th>
										<th>'.trans("template.common.metakeyword").'</th>
										<th>'.trans("template.common.metadescription").'</th>
										<th>'.trans("template.common.publish").'</th>
								</tr>
						</thead>
						<tbody>
								<tr>
										<td>' . $data->varTitle . '</td>
										<td>' . $data->varAuthor . '</td>';

										if($data->fkIntImgId > 0){
												$returnHtml.= '<td>'.'<img height="50" width="50" src="'.resize_image::resize($data->fkIntImgId).'" />'.'</td>';
										}else{
												$returnHtml.= '<td>-</td>';
										}
										
										$returnHtml.= '<td>' . ($data->intDisplayOrder) . '</td>
										<td>' . date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'', strtotime($data->dtStartDateTime)) . '</td>
										<td>' . $data->txtShortDescription . '</td>
										<td>' . $data->txtDescription . '</td>
										<td>' . $data->varFeaturedBlog . '</td>
										<td>' . $data->varMetaTitle . '</td>
										<td>' . $data->varMetaKeyword . '</td>
										<td>' . $data->varMetaDescription . '</td>
										<td>' . $data->chrPublish . '</td>
								</tr>
						</tbody>
				</table>';
			return $returnHtml;
		}
		
		public function tableData($value = false, $fcnt=false) 
		{		
			$publish_action='';
				if(Auth::user()->can('blogs-edit')) {
					$title = '<a title="' . trans("template.common.edit") . '" href="' . route('powerpanel.blogs.edit', array('alias' => $value->id)) . '">'.$value->varTitle.'</a>';
				}else {
					$title = $value->varTitle;
				}

				$details = '';
				if(Auth::user()->can('blogs-edit'))
				{
						$details.= '<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.blogs.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
				}    
				if(Auth::user()->can('blogs-delete'))
				{
						$details.= '&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="blogs" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}  

				if(Auth::user()->can('blogs-publish'))
				{
					if ($value->chrPublish == 'Y') {
							$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/blogs" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
					} else {
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/blogs" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
					}
				}	
				
				 $details .='<a class="without_bg_icon share" title="Share" data-modal="Blogs" data-alias="'.$value->id.'"  data-images="'.$value->fkIntImgId.'" data-link = "'.url('/blogs/'.$value->alias['varAlias']).'" data-toggle="modal" data-target="#confirm_share">
				     <i class="fa fa-share-alt"></i></a>';

				$minus='<span class="glyphicon glyphicon-minus"></span>';
				
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
				if(isset($value->txtCategories))
				{
					
					$categoryIDs =unserialize($value->txtCategories);
					$selCategory = BlogCategory::getParentCategoryNameBycatId($categoryIDs);

					$category.='<div class="pro-act-btn"><a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.category").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-info"></span></a>';
						$category.='<div class="highslide-maincontent">';
							$category.='<ul>';
							foreach ($selCategory as $selCat) {
								if(strlen(trim($selCat))>0){
									$category.='<li>';
										$category.= $selCat->varTitle;
									$category.='</li>';
								}
							}	
							$category.='<ul>';
						$category.='</div>';
					$category.='</div>';
				}else{
					$category .= '<span class="glyphicon glyphicon-minus"></span>';
				}

				$featuredBlog = '';				
					if (!empty($value->varFeaturedBlog)) {
							if ($value->varFeaturedBlog == 'Y') {
									$featuredBlog .= '<a href="javascript:makeFeatured('. $value->id .',\'N\');"><i class="fa fa-star" aria-hidden="true"></i></a>';
							} else {
									if($fcnt < 3){
										$featuredBlog .= '<a href="javascript:makeFeatured('. $value->id .',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
									}else{
										$featuredBlog .= '<span class="glyphicon glyphicon-minus" title="'.trans('template.blogModule.featuredblognote').'"></span>';												
									}
							}
					} else {
							if($fcnt < 3) {
								$featuredBlog .= '<a href="javascript:makeFeatured('. $value->id .',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
							}else{
									$featuredBlog .= '<span class="glyphicon glyphicon-minus" title="'.trans('template.blogModule.featuredblognote').'"></span>';		
							}
					}

				$records = array(				
				'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">', 				
				$title,
				'<div class="pro-act-btn">
				<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.shortdescription").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
				<div class="highslide-maincontent">' . $value->txtShortDescription . '</div>
				</div>',
				ucfirst($value->varAuthor),				
				$imgIcon,
				$category, 
				date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'', strtotime($value->dtStartDateTime)),
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

		public static function flushCache(){
			Cache::tags('Blogs')->flush();
			Cache::tags('BlogCategory')->flush();						
		}
}
