<?php

namespace App\Http\Controllers\Powerpanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\Testimonial;
use App\ProductCategory;
use App\Products;
use App\Log;
use App\RecentUpdates;
use App\Alias;
use Validator;
use DB;
use App\Http\Controllers\PowerpanelController;
use Crypt;
use Auth;
use App\Helpers\MyLibrary;
use App\CommonModel;
use Config;
use Carbon\Carbon;
use Cache;
use App\Helpers\AddImageModelRel;
use App\Helpers\resize_image;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;

class TestimonialController extends PowerpanelController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
    }

    /**
     * This method handels load testimonial grid
     * @return  View
     * @since   2017-07-20
     * @author  NetQuick
     */
    public function index() {
        $total = CommonModel::getRecordCount();
        $this->breadcrumb['title'] = trans('template.testimonialModule.manageTestimonials');
        return view('powerpanel.testimonial.list_testimonial', ['total' => $total, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * This method handels list of testimonial with filters
     * @return  View
     * @since   2017-07-20
     * @author  NetQuick
     */
    public function get_list() {

        /* Start code for sorting */
        $filterArr = [];
        $records = array();
        $records["data"] = array();

        $filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
        $filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
        $filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
        $filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
        $filterArr['statusFilter'] = !empty(Input::get('statusFilter')) ? Input::get('statusFilter') : '';
        $filterArr['dateFilter'] = !empty(Input::get('dateValue')) ? Input::get('dateValue') : '';
        $filterArr['iDisplayLength'] = intval(Input::get('length'));
        $filterArr['iDisplayStart'] = intval(Input::get('start'));
     
        if(!empty($filterArr['dateFilter'])){
        $date = Carbon::createFromFormat(Config::get('Constant.DEFAULT_DATE_FORMAT'), $filterArr['dateFilter']);
        $filterArr['dateFilter'] = $date->format('Y-m-d');}
        
        $sEcho = intval(Input::get('draw'));

        $arrResults = Testimonial::getRecordList($filterArr);
        $iTotalRecords = CommonModel::getRecordCount($filterArr, true);
        $end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if ($arrResults != false && !empty($arrResults)) {
            foreach ($arrResults as $key => $value) {
                $records["data"][] = $this->tableData($value);
            }
        }
        $records["customActionStatus"] = "OK";
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
        exit;
    }

    /**
     * This method loads testimonial edit view
     * @param  	Alias of record
     * @return  View
     * @since   2017-07-21
     * @author  NetQuick
     */
    public function edit($alias = false) {
        
        $imageManager = true;
        $category = ProductCategory::getCatWithParent();
        $category = CategoryArrayBuilder::getArray($category);
        $ProductCategory = addslashes(json_encode($category));
        if (!is_numeric($alias)) {
            $total = CommonModel::getRecordCount();
            $total = $total + 1;
            $this->breadcrumb['title'] = trans('template.testimonialModule.addTestimonial');
            $this->breadcrumb['module'] = trans('template.testimonialModule.manageTestimonials');
            $this->breadcrumb['url'] = 'powerpanel/testimonial';
            $this->breadcrumb['inner_title'] = trans('template.testimonialModule.addTestimonial');
            $data = [
                'total' => $total,
                'ProductCategory' => $ProductCategory,
                'ProductCombo' => '',
                'breadcrumb' => $this->breadcrumb,
                'imageManager' => 'imageManager'
            ];
        } else {
            $id = $alias;
            $testimonial = Testimonial::getRecordById($id);
            if ($testimonial == false) {
                return redirect()->route('powerpanel.testimonial.add');
            }
            $Product = Products::getProductName($testimonial->fkProduct);
            $this->breadcrumb['title'] = trans('template.testimonialModule.editTestimonial') . ' - ' . $testimonial->varTitle;
            $this->breadcrumb['module'] = trans('template.testimonialModule.manageTestimonials');
            $this->breadcrumb['url'] = 'powerpanel/testimonial';
            $this->breadcrumb['inner_title'] = trans('template.testimonialModule.editTestimonial') . ' - ' . $testimonial->varTitle;
            $data = [
                'testimonials' => $testimonial,
                'id' => $id,
                'ProductCategory' => $ProductCategory,
                'ProductCombo' => '',
                'breadcrumb' => $this->breadcrumb,
                'imageManager' => 'imageManager'
            ];
        }
        return view('powerpanel.testimonial.actions', $data);
    }

    /**
     * This method stores testimonial modifications
     * @return  View
     * @since   2017-07-21
     * @author  NetQuick
     */
    
    public function handlePost(Request $request) {
        $postArr = Input::all();

        $rules = array(
            'title' => 'required|max:160',
            'testimonial' => 'required',
            'category_id' => 'required',
            'product_id' => 'required',
            'display_order' => 'required|greater_than_zero',
            'chrMenuDisplay' => 'required'
        );
        $messsages = array(
            'title.required' => trans('template.testimonialModule.titleMessage'),
            'display_order.greater_than_zero' => trans('template.testimonialModule.displayGreaterThan')
        );
        $validator = Validator::make($postArr, $rules, $messsages);
        if ($validator->passes()) {
            $id = $request->segment(3);
            $actionMessage = trans('template.common.oppsSomethingWrong');
            if (is_numeric($id)) { #Edit post Handler=======
                $testimonial = Testimonial::getRecordForLogById($id);
                $updateTestimonialFields = [];
                $updateTestimonialFields['varTitle'] = trim($postArr['title']);
                $updateTestimonialFields['fkIntImgId'] = !empty($postArr['img_id']) ? $postArr['img_id'] : null;
                $updateTestimonialFields['txtDescription'] = $postArr['testimonial'];
                $updateTestimonialFields['fkProductCategories'] = $postArr['category_id'];
                $updateTestimonialFields['fkProduct'] = $postArr['product_id'];
                $updateTestimonialFields['varRefURL'] = $postArr['varRefURL'];
                $updateTestimonialFields['varIpAddress'] = $request->ip();
                $updateTestimonialFields['chrShowHomePage'] = !empty($postArr['chrShowHomePage']) ? $postArr['chrShowHomePage'] : 'N';
                $updateTestimonialFields['dtStartDateTime'] = date('Y-m-d', strtotime(str_replace('/', '-', $postArr['testimonialdate'])));
                $updateTestimonialFields['chrPublish'] = $postArr['chrMenuDisplay'];

                $whereConditions = ['id' => $id];
                $update = CommonModel::updateRecords($whereConditions, $updateTestimonialFields);
                if ($update) {
                    if ($id > 0 && !empty($id)) {
                        self::swap_order_edit($postArr['display_order'], $id);

                        $logArr = MyLibrary::logData($id);
                        if (Auth::user()->can('log-advanced')) {
                            $newTestimonialObj = Testimonial::getRecordForLogById($id);
                            $oldRec = $this->recordHistory($testimonial);
                            $newRec = $this->recordHistory($newTestimonialObj);
                            $logArr['old_val'] = $oldRec;
                            $logArr['new_val'] = $newRec;
                        }

                        $logArr['varTitle'] = trim($postArr['title']);
                        Log::recordLog($logArr);
                        if (Auth::user()->can('recent-updates-list')) {
                            if (!isset($newTestimonialObj)) {
                                $newTestimonialObj = Testimonial::getRecordForLogById($id);
                            }
                            $notificationArr = MyLibrary::notificationData($id, $newTestimonialObj);
                            RecentUpdates::setNotification($notificationArr);
                        }
                        self::flushCache();
                        $actionMessage = trans('template.testimonialModule.updateMessage');
                    }
                }
            } else { #Add post Handler=======
                $testimonialArr['varTitle'] = trim($postArr['title']);
                $testimonialArr['fkIntImgId'] = !empty($postArr['img_id']) ? $postArr['img_id'] : null;
                $testimonialArr['txtDescription'] = $postArr['testimonial'];
                $testimonialArr['fkProductCategories'] = $postArr['category_id'];
                $testimonialArr['fkProduct'] = $postArr['product_id'];
                $testimonialArr['varRefURL'] = $postArr['varRefURL'];
                $testimonialArr['varIpAddress'] = $request->ip();
                $testimonialArr['chrShowHomePage'] = !empty($postArr['chrShowHomePage']) ? $postArr['chrShowHomePage'] : 'N';
                $testimonialArr['intDisplayOrder'] = self::swap_order_add($postArr['display_order']);
                $testimonialArr['dtStartDateTime'] = date('Y-m-d', strtotime(str_replace('/', '-', $postArr['testimonialdate'])));
                $testimonialArr['chrPublish'] = $postArr['chrMenuDisplay'];
                $testimonialArr['created_at'] = Carbon::now();

                $testimonialID = CommonModel::addRecord($testimonialArr);
                if (!empty($testimonialID)) {
                    $id = $testimonialID;
                    $newTestimonialObj = Testimonial::getRecordForLogById($id);

                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newTestimonialObj->varTitle;
                    Log::recordLog($logArr);
                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newTestimonialObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                    $actionMessage = trans('template.testimonialModule.addMessage');
                }
            }
            AddImageModelRel::sync(explode(',', $postArr['img_id']), $id);
            if (!empty($postArr['saveandexit']) && $postArr['saveandexit'] == 'saveandexit') {
                return redirect()->route('powerpanel.testimonial.index')->with('message', $actionMessage);
            } else {
                return redirect()->route('powerpanel.testimonial.edit', $id)->with('message', $actionMessage);
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

      public function getProductAjax() {
        Cache::tags('Testimonial')->flush();
        $order = Input::get('prod_catval');
        if ($order != '') {
            $Product = Products::getProductName($order);
            return $Product;
        }
    }
    /**
     * This method destroys Testimonial in multiples
     * @return  Testimonial index view
     * @since   2016-10-25
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
     * This method destroys Testimonial in multiples
     * @return  Testimonial index view
     * @since   2016-10-25
     * @author  NetQuick
     */
    public function publish(Request $request) {

        $alias = (int) Input::get('alias');
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
        $order = Input::get('order');
        $exOrder = Input::get('exOrder');
        MyLibrary::swapOrder($order, $exOrder);
        self::flushCache();
    }

    /**
     * This method handels swapping of available order record while adding
     * @param  	order
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
     * @param  	order
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
        $update = CommonModel::updateRecords($whereConditions, ['chrShowHomePage' => $featured]);
        self::flushCache();
        echo json_encode($update);
    }

    public function tableData($value) {
        $details = '';
        $actions = '';
        $publish_action = '';
         $ProductCategory = ProductCategory::getCategoriesData($value->fkProductCategories);
        $CategoryName = $ProductCategory->varTitle;
        $Product = Products::getProductData($value->fkProduct);
        $ProductName = $Product->varTitle;
        $imgIcon = '';
        if (!empty($value->fkIntImgId) && $value->fkIntImgId > 0) {
            $imgIcon .= '<a href="' . resize_image::resize($value->fkIntImgId) . '" class="fancybox-buttons" data-rel="fancybox-buttons">';
            $imgIcon .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) . '" src="' . resize_image::resize($value->fkIntImgId, 50, 50) . '"/>';
            $imgIcon .= '</a>';
        } else {
            $imgIcon .= '<span class="glyphicon glyphicon-minus"></span>';
        }

        if (Auth::user()->can('testimonial-edit')) {
            $actions .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.testimonial.edit', array('alias' => $value->id)) . '">
					<i class="fa fa-pencil"></i></a>';
        }
        if (Auth::user()->can('testimonial-delete')) {
            $actions .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="testimonial" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
        }

        if (Auth::user()->can('testimonial-publish')) {
            if ($value->chrPublish == 'Y') {
                $publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/testimonial" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
            } else {
                $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/testimonial" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
            }
        }

        if (Auth::user()->can('testimonial-edit')) {
            $title = '<a class="" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.testimonial.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
        } else {
            $title = $value->varTitle;
        }
         $HomePage = '';
        if (!empty($value->chrShowHomePage)) {
            if ($value->chrShowHomePage == 'Y') {
                $HomePage .= '<div style="text-align:center"><a href="javascript:makeFeatured(' . $value->id . ',\'N\');"><i class="fa fa-star" aria-hidden="true" ></i></a></div>';
            } else {
                $HomePage .= '<div style="text-align:center"><a href="javascript:makeFeatured(' . $value->id . ',\'Y\');"><i class="fa fa-star-o" aria-hidden="true" ></i></a></div>';
            }
        } else {
            $HomePage .= '<div style="text-align:center"><a href="javascript:makeFeatured(' . $value->id . ',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a></div>';
        }
        $records = array(
            '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">',
            $title,
            $CategoryName,
            $ProductName,
            $HomePage,
            '<div class="pro-act-btn">
					<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'' . trans("template.common.description") . '\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
					<div class="highslide-maincontent">' . $value->txtDescription . '</div>
					</div>',
            $imgIcon,
            date(Config::get('Constant.DEFAULT_DATE_FORMAT'), strtotime($value->dtStartDateTime)),
            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
					' . $value->intDisplayOrder .
            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
            $publish_action,
            $actions,
            $value->intDisplayOrder
        );
        return $records;
    }

    /**
     * This method handels logs History records
     * @param   $data
     * @return  HTML
     * @since   2017-07-21
     * @author  NetQuick
     */
    public function recordHistory($data = false) {

        $returnHtml = '';
        $returnHtml.='<table class="new_table_desing table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>' . trans("template.testimonialModule.title") . '</th>
						<th>' . trans("template.testimonialModule.testimonialDate") . '</th>						
						<th>' . trans("template.common.description") . '</th>
						<th>' . trans("template.common.order") . '</th>
						<th>' . trans("template.common.publish") . '</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>' . $data->varTitle . '</td>
						<td>' . date(Config::get('Constant.DEFAULT_DATE_FORMAT'), strtotime($data->dtStartDateTime)) . '</td>						
						<td>' . $data->txtDescription . '</td>
						<td>' . ($data->intDisplayOrder) . '</td>
						<td>' . $data->chrPublish . '</td>
					</tr>
				</tbody>
			</table>';

        return $returnHtml;
    }

    public static function flushCache() {
        Cache::tags('Testimonial')->flush();
    }

}
