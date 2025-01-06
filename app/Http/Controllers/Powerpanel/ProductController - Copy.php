<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\Products;
use App\ProductCategory;
use App\Modules;
use App\Alias;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use App\Log;
use App\RecentUpdates;   
use App\CommonModel;
use App\Helpers\AddImageModelRel;
use App\Helpers\AddVideoModelRel;
use App\Helpers\AddDocumentModelRel;
use App\Helpers\MyLibrary;
use Auth;
use App\Helpers\resize_image;
use Cache;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;
use DB;

class ProductController extends PowerpanelController {
		   
		public function __construct() {
			parent::__construct();
			if (isset($_COOKIE['locale'])) {
					app()->setLocale($_COOKIE['locale']);
			} 			
		}
		/**
		 * This method handels load process of product
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function index() {
			$iTotalRecords =   CommonModel::getRecordCount();
			$productCategory = $iTotalRecords > 0? ProductCategory::getCatWithParent():null;			
			$this->breadcrumb['title'] = trans('template.productModule.manageProducts');
			$breadcrumb = $this->breadcrumb;
			return view('powerpanel.products.index', compact('productCategory','iTotalRecords', 'breadcrumb'));
		}
		
		/**
		 * This method loads product edit view
		 * @param   Alias of record
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function edit($id=false) 
		{ 
			$category = ProductCategory::getCatWithParent();
			$category = CategoryArrayBuilder::getArray($category);
			$ProductCategory = json_encode($category);

			$imageManager = true;
			$videoManager  = true;
			$documentManager  = true;
			$categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false,false,'\App\ProductCategory');
			if(!is_numeric($id))
			{
				$total = CommonModel::getRecordCount();
				$total = $total + 1;
				$this->breadcrumb['title'] = trans('template.productModule.addProduct');
				$this->breadcrumb['module'] = trans('template.productModule.manageProducts');
				$this->breadcrumb['url'] = 'powerpanel/products';
				$this->breadcrumb['inner_title'] = trans('template.productModule.addProduct');
				$breadcrumb = $this->breadcrumb;
				$data=compact('total', 'ProductCategory', 'breadcrumb','imageManager','videoManager','documentManager','categoryHeirarchy');
			}else{        
				$product = Products::getRecordById($id);
				if(count($product)==0){ return redirect()->route('powerpanel.products.add'); }
				$metaInfo = array('varMetaTitle' => $product->varMetaTitle, 'varMetaKeyword' => $product->varMetaKeyword, 'varMetaDescription' => $product->varMetaDescription);
				$this->breadcrumb['title'] = trans('template.productModule.editProduct') . ' - ' . $product->varTitle;
				$this->breadcrumb['module'] = trans('template.productModule.manageProducts');
				$this->breadcrumb['url'] = 'powerpanel/products';
				$this->breadcrumb['inner_title'] = trans('template.productModule.editProduct') . ' - ' . $product->varTitle;
				$breadcrumb = $this->breadcrumb;
				$data=compact('product', 'ProductCategory', 'alias', 'metaInfo', 'breadcrumb','imageManager','videoManager','documentManager','categoryHeirarchy');
			}     
			return view('powerpanel.products.actions', $data);        
		}
		/**
		 * This method stores product modifications
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function handlePost(Request $request) {
				$data = Input::get();
				$actionMessage = trans('template.common.oppsSomethingWrong');
				$messsages = array('order.greater_than_zero' => trans('template.productModule.displayGreaterThan'));

				$rules = array(
					'title' => 'required|max:160',
				  'display_order' => 'required|greater_than_zero',
				  'varMetaTitle' => 'required|max:160',
					'varMetaKeyword' => 'required|max:160',
					'varMetaDescription' => 'required|max:160',
					'regular_price' => 'numeric|min:0',
					'sale_price' => 'numeric|min:0',
					'discount_value' => 'numeric',
				);
				
				$validator = Validator::make($data, $rules, $messsages);
				if ($validator->passes()) {
						$productArr = [];
						$productArr['varTitle'] = trim($data['title']);           
						$productArr['txtCategories'] = isset($data['category_id'])?serialize($data['category_id']):null;
						$productArr['varFeaturedProduct']=$data['featuredProduct'];
						$productArr['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
						$productArr['fkIntVideoId'] = !empty($data['video_id'])?$data['video_id']:null;
						$productArr['fkIntDocId'] = !empty($data['doc_id'])?$data['doc_id']:null;
						$productArr['txtShortDescription'] = trim($data['short_description']);
						$productArr['txtDescription'] = $data['description'];
						$productArr['varMetaTitle'] = trim($data['varMetaTitle']);
						$productArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
						$productArr['varMetaDescription'] = trim($data['varMetaDescription']);
						$productArr['chrPublish'] = isset($data['chrMenuDisplay'])?$data['chrMenuDisplay']:'Y';

						$productArr['fltRegularPrice'] = $data['regular_price'];
						$productArr['fltSalePrice'] = $data['sale_price'];
						$productArr['varDiscountType'] = ($data['regular_price'] > 0)?$data['discountType']:'';

						if($data['discountType'] == ""){
							$productArr['fltDiscountValue'] = '';
							$productArr['fltSalePrice'] = $data['regular_price'];
						}else{
							if($data['discountType'] == "flat" && $data['regular_price'] > 0){
								if( $data['discount_value']<= $data['regular_price'] ){
										$productArr['fltDiscountValue'] = $data['discount_value'];
								}else{
										$productArr['fltDiscountValue'] = $data['regular_price'];
								}
							}else if($data['discountType'] == "percentage" && $data['regular_price'] > 0){
									if($data['discount_value'] < 100){
										$productArr['fltDiscountValue'] =  $data['discount_value'];
									}else{
										$productArr['fltDiscountValue'] = 100;
									}
							}else{
									$productArr['fltDiscountValue'] = 0;
							}
							
						}

						$id = $request->segment(3);
						if(is_numeric($id)){ #Edit post Handler=======
							if($data['oldAlias'] != $data['alias']){
								Alias::updateAlias($data['oldAlias'], $data['alias']);	
							}
							$product = Products::getRecordForLogById($id);
							$whereConditions = ['id' => $product->id];
							$update = CommonModel::updateRecords($whereConditions, $productArr);
							if ($update) {
								if (!empty($id)) {
									self::swap_order_edit($data['display_order'], $product->id);

									$logArr = MyLibrary::logData($product->id);
									if (Auth::user()->can('log-advanced')) {
										$newProductObj = Products::getRecordForLogById($product->id);
										$oldRec = $this->recordHistory($product);
										$newRec = $this->recordHistory($newProductObj);
										$logArr['old_val'] = $oldRec;
										$logArr['new_val'] = $newRec; 
									}
									$logArr['varTitle'] = trim($data['title']);
									Log::recordLog($logArr);
									if (Auth::user()->can('recent-updates-list')) {
										if(!isset($newProductObj)){
											$newProductObj = Products::getRecordForLogById($product->id);
										}
										$notificationArr = MyLibrary::notificationData($product->id, $newProductObj);
										RecentUpdates::setNotification($notificationArr);               
									}
								}
								self::flushCache();
								$actionMessage = trans('template.productModule.updateMessage');
							}
						}else{ #Add post Handler=======
						$productArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
						$productArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
						$productID = CommonModel::addRecord($productArr);
						if (!empty($productID)) {
								$id=$productID;
								$newProductObj = Products::getRecordForLogById($id);
								$logArr = MyLibrary::logData($id);
								$logArr['varTitle'] = $newProductObj->varTitle;
								Log::recordLog($logArr);
								if (Auth::user()->can('recent-updates-list')) {
									$notificationArr = MyLibrary::notificationData($id, $newProductObj);
									RecentUpdates::setNotification($notificationArr);
								}
								self::flushCache();
								$actionMessage = trans('template.productModule.addMessage');
							}
						}
						AddImageModelRel::sync(explode(',', $data['img_id']), $id);
						AddVideoModelRel::sync(explode(',', $data['video_id']), $id);
						AddDocumentModelRel::sync(explode(',', $data['doc_id']), $id);

						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
								return redirect()->route('powerpanel.products.index')->with('message', $actionMessage);
						} else {
								return redirect()->route('powerpanel.products.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}
		/**
		 * This method loads product table data on view
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
				$filterArr['productFilter'] = !empty(Input::get('productFilter')) ? Input::get('productFilter') : '';       
				$filterArr['paymentFilter'] = !empty(Input::get('paymentFilter')) ? Input::get('paymentFilter') : '';       
				$filterArr['iDisplayLength'] = intval(Input::get('length'));
				$filterArr['iDisplayStart'] = intval(Input::get('start'));
				$sEcho = intval(Input::get('draw'));
				$arrResults = Products::getRecordList($filterArr);
				$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
				$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				$end = $end > $iTotalRecords ? $iTotalRecords : $end;
				if (!empty($arrResults)) {
						foreach ($arrResults as $key => $value) {               
								$records["data"][] = $this->tableData($value);
						}
				}
				$records["customActionStatus"] = "OK";
				$records["draw"] = $sEcho;
				$records["recordsTotal"] = $iTotalRecords;
				$records["recordsFiltered"] = $iTotalRecords;
				return json_encode($records);
		}
		public function tableData($value = false) 
		{
			$publish_action='';
				$details = '';
				if(Auth::user()->can('products-edit')){
					$details.= '<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.products.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
				}    
				if(Auth::user()->can('products-delete')){
					$details.= '&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="products" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}

				$featuredProduct = '';
				if (!empty($value->varFeaturedProduct)) {
					if ($value->varFeaturedProduct == 'Y') {
						$featuredProduct .= '<a href="javascript:makeFeatured('. $value->id .',\'N\');"><i class="fa fa-star" aria-hidden="true"></i></a>';
					} else {
						$featuredProduct .= '<a href="javascript:makeFeatured('. $value->id .',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
					}
				} else {
					$featuredProduct .= '<a href="javascript:makeFeatured('. $value->id .',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
				}

				if(Auth::user()->can('products-publish')){
					if ($value->chrPublish == 'Y') {
						$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/products" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
					} else {
						$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/products" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
					}
				}
				$details .='<a class="without_bg_icon share" title="Share" data-modal="Products" data-alias="'.$value->id.'"  data-images="'.$value->fkIntImgId.'" data-link = "'.url('/products/'.$value->alias['varAlias']).'" data-toggle="modal" data-target="#confirm_share">
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
				$category='';
				if(isset($value->txtCategories)){
					$categoryIDs =unserialize($value->txtCategories);
				 	$selCategory = ProductCategory::getParentCategoryNameBycatId($categoryIDs);	
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
					$category .= $minus;
				}
				
				$records = array(				
				'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">', 				
				'<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.products.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>', 
				'<div class="pro-act-btn">
				<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.shortdescription").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
				<div class="highslide-maincontent">' . $value->txtShortDescription . '</div>
				</div>',				
				$imgIcon,
				$category,
				'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				'.$value->intDisplayOrder.
				' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
				$featuredProduct,
				$publish_action,
				$details,
				$value->intDisplayOrder
				);
				return $records;
		}
		
		/**
		 * This method delete multiples product
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
			$update = CommonModel::updateRecords($whereConditions, ['varFeaturedProduct'=>$featured]);
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
		public function recordHistory($data=false) 
		{
				$returnHtml = '';
				$returnHtml.= '<table class="new_table_desing table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>'.trans("template.common.title").'</th>
														<th>'.trans("template.common.image").'</th>
														<th>'.trans("template.common.order").'</th>
														<th>'.trans("template.common.shortDescription").'</th>
														<th>'.trans("template.common.description").'</th>
														<th>'.trans("template.productModule.featuredProduct").'</th>
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
														<td>' . $data->varFeaturedProduct . '</td>
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
				Cache::tags('Product')->flush();
				Cache::tags('ProductCategory')->flush();
		}
		
}
