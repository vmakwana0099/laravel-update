<?php

namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\Deals;
use App\ProductCategory;
use App\Products;
use App\Modules;
use App\Alias;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Log;
use App\RecentUpdates;
use App\CommonModel;
use App\Helpers\MyLibrary;
use Auth;
use Config;
use App\Helpers\resize_image;
use App\Helpers\AddImageModelRel;
use App\Helpers\AddVideoModelRel;
use Cache;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;
use URL;

class DealsController extends PowerpanelController {

    public $catModule;

    public function __construct() {
        parent::__construct();
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
    }

    /**
     * This method handels load process of news
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function index() {
        $iTotalRecords = CommonModel::getRecordCount();
        $ProductCategory = $iTotalRecords > 0 ? ProductCategory::getCatWithParent() : null;
        $this->breadcrumb['title'] = trans('template.dealsModule.manageDeals');
        $breadcrumb = $this->breadcrumb;
        return view('powerpanel.deals.index', compact('iTotalRecords', 'breadcrumb', 'ProductCategory'));
    }

    /**
     * This method loads news edit view
     * @param   Alias of record
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function edit($id = false) {

        $category = ProductCategory::getCatWithParent();
        $category = CategoryArrayBuilder::getArray($category);
        $ProductCategory = addslashes(json_encode($category));
        $moduleFields_cat = ['varTitle as text', 'id'];
//        $category = CategoryArrayBuilder::getArray($category);
        $DealsCategory = Deals::getCat($moduleFields_cat);
        $dealtype_id = Deals::getCatType($moduleFields_cat);
        $DealsCategory = json_encode($DealsCategory);
        $DealsType = json_encode($dealtype_id);

        $imageManager = true;
        $videoManager = true;
        // $categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false, false, '\App\NewsCategory');        
        $total = CommonModel::getRecordCount();
        $total = $total + 1;
        if (!is_numeric($id)) {
            $this->breadcrumb['title'] = trans('template.dealsModule.addDeals');
            $this->breadcrumb['module'] = trans('template.dealsModule.manageDeals');
            $this->breadcrumb['url'] = 'powerpanel/deals';
            $this->breadcrumb['inner_title'] = trans('template.dealsModule.addDeals');
            $breadcrumb = $this->breadcrumb;
            $data = compact('total', 'DealsCategory', 'breadcrumb', 'imageManager', 'ProductCategory', 'videoManager', 'DealsType');
        } else {
            $deals = Deals::getRecordById($id);
            // print_r($deals);exit;
            if ($deals == false) {
                return redirect()->route('powerpanel.deals.add');
            }
            /* $metaInfo = array('varMetaTitle' => $news->varMetaTitle, 'varMetaKeyword' => $news->varMetaKeyword, 'varMetaDescription' => $news->varMetaDescription); */
            $this->breadcrumb['title'] = trans('template.dealsModule.editDeals') . ' - ' . $deals->varTitle;
            $this->breadcrumb['module'] = trans('template.dealsModule.manageDeals');
            $this->breadcrumb['url'] = 'powerpanel/deals';
            $this->breadcrumb['inner_title'] = trans('template.dealsModule.editDeals') . ' - ' . $deals->varTitle;
            $breadcrumb = $this->breadcrumb;
            $data = compact('deals', 'total', 'DealsCategory', 'alias', 'metaInfo', 'breadcrumb', 'imageManager', 'videoManager', 'DealsType', 'ProductCategory');
        }
        return view('powerpanel.deals.actions', $data);
    }

    /**
     * This method stores news modifications
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function handlePost(Request $request) {
        $data = Input::get();
        // echo "<pre>";
        // print_r($data);exit;
        $rules = array(
            'title' => 'required|max:160',
            'dealscategory_id' => 'required',
            'category_id' => 'required',
            'dealtype_id' => 'required',
            'tag_line' => 'required',
            'discountType' => 'required|max:160',
            // 'discount_percentage' => 'required|max:160',
            // 'discount_fixed' => 'required|max:160',
            'promo_code' => 'required|max:160',
            'popup_title' => 'required|max:160',
            'start_date' => 'required',
            'end_date' => 'required',
            'popuptag_line' => 'required|max:160',
            'button_link' => 'required|max:160',
            'display_order' => 'required|greater_than_zero',
            'chrMenuDisplay' => 'required',
            'short_description' => 'required',
        );
        $actionMessage = trans('template.common.oppsSomethingWrong');
        $messsages = array(
            'category_id.required' => trans('template.dealsModule.categoryMessage'),
            'display_order.greater_than_zero' => trans('template.dealsModule.displayGreaterThan')
        );
        $validator = Validator::make($data, $rules, $messsages);
        $ProductCat = implode(",", $data['product_id']);
        if ($validator->passes()) {
            $DealsArr = [];
            $DealsArr['varTitle'] = trim($data['title']);
            $DealsArr['dtStart_date'] = !empty($data['start_date']) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['start_date']))) : date('Y-m-d H:i:s');
            $DealsArr['dtEnd_date'] = !empty($data['end_date']) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['end_date']))) : date('Y-m-d H:i:s');

            $DealsArr['fkdealscategory_id'] = $data['dealscategory_id'];
            $DealsArr['fkProductCategories'] = $data['category_id'];
            $DealsArr['fkdealtype_id'] = $data['dealtype_id'];
            $DealsArr['varTagLine'] = $data['tag_line'];
            $DealsArr['varListingIcon'] = $data['listing_icon'];
            $DealsArr['varDealsINRPrice'] = $data['inr_price'];
            $DealsArr['varDealsUSDPrice'] = $data['usd_price'];
            $DealsArr['varDiscountType'] = $data['discountType'];
            if ($data['discountType'] == 'Percentage') {
                $DealsArr['discount_percentage'] = $data['discount_percentage'];
            } else {
                $DealsArr['discount_percentage'] = null;
            }
            if ($data['discountType'] == 'Fixed') {
                $DealsArr['discount_fixed'] = $data['discount_fixed'];
            } else {
                $DealsArr['discount_fixed'] = null;
            }
            $DealsArr['varpromo_code'] = $data['promo_code'];
            $DealsArr['varpopup_title'] = $data['popup_title'];
            $DealsArr['chrDisplayontop'] = isset($data['displayontop']) ? $data['displayontop'] : "N";
            if ($DealsArr['chrDisplayontop'] == 'Y') {
                $DealsArr['varHomePageDealsContent'] = $data['home_page_delas_content'];
            } else {
                $DealsArr['varHomePageDealsContent'] = '';
            }
            $DealsArr['varPopupTagLine'] = $data['popuptag_line'];

            $DealsArr['varShortDescription'] = $data['short_description'];
            $DealsArr['varbutton_link'] = $data['button_link'];
            $DealsArr['fkProduct'] = $ProductCat;
            $DealsArr['varMetaTitle'] = trim('');
            $DealsArr['varMetaKeyword'] = trim('');
            $DealsArr['varMetaDescription'] = trim('');
            $DealsArr['chrPublish'] = $data['chrMenuDisplay'];
            $DealsArr['varIpAddress'] = $request->ip();
            $DealsArr['varRefURL'] = $data['varRefURL'];

            $id = $request->segment(3);
            if (is_numeric($id)) { #Edit post Handler=======
                /* if ($data['oldAlias'] != $data['alias']) {
                  Alias::updateAlias($data['oldAlias'], $data['alias']);
                  } */
                $deals = Deals::getRecordForLogById($id);
                $whereConditions = ['id' => $deals->id];
                $update = CommonModel::updateRecords($whereConditions, $DealsArr);
                if ($update) {
                    if (!empty($id)) {
                        self::swap_order_edit($data['display_order'], $deals->id);

                        $logArr = MyLibrary::logData($deals->id);
                        if (Auth::user()->can('log-advanced')) {
                            $newNewsObj = Deals::getRecordForLogById($deals->id);
                            $oldRec = $this->recordHistory($deals);
                            $newRec = $this->recordHistory($newNewsObj);
                            $logArr['old_val'] = $oldRec;
                            $logArr['new_val'] = $newRec;
                        }
                        $logArr['varTitle'] = trim($data['title']);
                        Log::recordLog($logArr);

                        if (Auth::user()->can('recent-updates-list')) {
                            if (!isset($newNewsObj)) {
                                $newNewsObj = Deals::getRecordForLogById($deals->id);
                            }
                            $notificationArr = MyLibrary::notificationData($deals->id, $newNewsObj);
                            RecentUpdates::setNotification($notificationArr);
                        }
                        self::flushCache();
                        $actionMessage = trans('template.dealsModule.updateMessage');
                    }
                }
            } else { #Add post Handler=======
                // $DealsArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
                $DealsArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
                $dealsID = CommonModel::addRecord($DealsArr);
                if (!empty($dealsID)) {
                    $id = $dealsID;
                    $newNewsObj = Deals::getRecordForLogById($id);

                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newNewsObj->varTitle;
                    Log::recordLog($logArr);

                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newNewsObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                    $actionMessage = trans('template.dealsModule.addMessage');
                }
            }

            // AddImageModelRel::sync(explode(',', $data['img_id']), $id);
            // AddVideoModelRel::sync(explode(',', $data['video_id']), $id);

            if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
                return redirect()->route('powerpanel.deals.index')->with('message', $actionMessage);
            } else {
                return redirect()->route('powerpanel.deals.edit', $id)->with('message', $actionMessage);
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    /**
     * This method loads news table data on view
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
        $filterArr['iDisplayLength'] = intval(Input::get('length'));
        $filterArr['iDisplayStart'] = intval(Input::get('start'));
        $filterArr['rangeFilter'] = !empty(Input::get('rangeFilter')) ? Input::get('rangeFilter') : '';
        if (!empty($filterArr['rangeFilter'])) {
            $date = Carbon::createFromFormat(Config::get('Constant.DEFAULT_DATE_FORMAT'), $filterArr['rangeFilter']['from']);
            $filterArr['rangeFilter']['from'] = $date->format('Y-m-d');
        }

        if (!empty($filterArr['rangeFilter'])) {
            $date = Carbon::createFromFormat(Config::get('Constant.DEFAULT_DATE_FORMAT'), $filterArr['rangeFilter']['to']);
            $filterArr['rangeFilter']['to'] = $date->format('Y-m-d');
        }
        $sEcho = intval(Input::get('draw'));
        $arrResults = Deals::getRecordList($filterArr);
        $iTotalRecords = CommonModel::getRecordCount($filterArr, true);
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

    public function tableData($value = false) {
        // print_r($value);exit;
        $details = '';
        $publish_action = '';
        if (Auth::user()->can('deals-edit')) {
            $details .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.deals.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
        }
        if (Auth::user()->can('deals-delete')) {
            $details .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="deals" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
        }

        if (Auth::user()->can('deals-publish')) {
            if (!empty($value->chrPublish) && ($value->chrPublish == 'Y')) {
                $publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/deals" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
            } else {
                $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/deals" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
            }
        }

        // $details .='<a class="without_bg_icon share" title="Share" data-table="news" data-alias="'.$value->id.'" data-link = "'.url('/news/'.$value->id).'" data-toggle="modal" data-target="#confirm_share">
        // 	<i class="fa fa-share-alt"></i></a>';



        $category = '';
        if (isset($value->txtCategories)) {
            $categoryIDs = unserialize($value->txtCategories);
            // $selCategory = NewsCategory::getParentCategoryNameBycatId($categoryIDs);
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

        if (Auth::user()->can('deals-edit')) {
            $title = '<a class="" title="Edit" href="' . route('powerpanel.deals.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
        } else {
            $title = $value->varTitle;
        }
        $records = array(
            '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">',
            $title,
            '<div class="pro-act-btn">
					<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'' . trans("template.common.description") . '\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
						<div class="highslide-maincontent">' . $value->varShortDescription . '</div>
					</div>',
            date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . '', strtotime($value->dtstart_date)),
            date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ', strtotime($value->dtend_date)),
            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
					' . $value->intDisplayOrder .
            ' <a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
            $publish_action,
            $details,
            $value->intDisplayOrder
        );
        return $records;
    }

    /**
     * This method delete multiples news
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

    public function getProductAjax() {
        $cat = Input::get('prod_catval');
        if ($cat != '') {
            $Product = Products::getProductNameDeals($cat);
            return $Product;
        }
        return 'false';
    }

    public function recordHistory($data = false) {
        $returnHtml = '';
        $returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">
				<thead>
						<tr>
								<th>' . trans("template.common.title") . '</th>
								<th>' . trans("template.common.image") . '</th>
								<th>' . trans("template.common.description") . '</th>
								<th>' . trans("template.common.dateandtime") . '</th>
								<th>' . trans("template.common.order") . '</th>
								<th>' . trans("template.common.metatitle") . '/th>
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
        $returnHtml .= '<td>' . $data->txtDescription . '</td>
								<td>' . $data->dtDateTime . '</td>
								<td>' . ($data->intDisplayOrder) . '</td>
								<td>' . $data->varMetaTitle . '</td>
								<td>' . $data->varMetaKeyword . '</td>
								<td>' . $data->varMetaDescription . '</td>
								<td>' . $data->chrPublish . '</td>
						</tr>
				</tbody>
				</table>';
        return $returnHtml;
    }

    public static function flushCache() {
        Cache::tags('deals')->flush();
        // Cache::tags('NewsCategory')->flush();
    }

}
