<?php

namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\Products;
use App\ProductsPackage;
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
use App\Helpers\MyLibrary;
use Auth;
use App\Helpers\resize_image;
use Cache;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;
use DB;

class ProductsPackageController extends PowerpanelController {

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
        $CatData = Input::get('category');
        $iTotalRecords = CommonModel::getRecordCount();
        $productCategory = $iTotalRecords > 0 ? ProductCategory::getCatWithParent() : null;
        $this->breadcrumb['title'] = trans('template.productpackageModule.manageProductPackage');
        $breadcrumb = $this->breadcrumb;
        return view('powerpanel.products_package.index', compact('iTotalRecords', 'breadcrumb', 'CatData', 'productCategory'));
    }

    /**
     * This method loads product edit view
     * @param   Alias of record
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function edit($id = false) {
        $category = ProductCategory::getCatWithParent();
        $category = CategoryArrayBuilder::getArray($category);
        $ProductCategory = addslashes(json_encode($category));

        $HostingParam = array();
        $HostingPlanData = MyLibrary::laravelcallapi("getallproductsgroups", $HostingParam);

        $imageManager = true;
        $videoManager = true;
        $documentManager = true;
        $categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false, false, '\App\ProductCategory');
        if (!is_numeric($id)) {
            $total = CommonModel::getRecordCount();
            $total = $total + 1;
            $this->breadcrumb['title'] = trans('template.productpackageModule.addProductPackage');
            $this->breadcrumb['module'] = trans('template.productpackageModule.manageProductPackage');
            $this->breadcrumb['url'] = 'powerpanel/products-package';
            $this->breadcrumb['inner_title'] = trans('template.productpackageModule.addProductPackage');
            $breadcrumb = $this->breadcrumb;
            $ProductCombo = "";
            $HostingProductDataArray = "";
            $data = compact('total', 'ProductCategory', 'breadcrumb', 'imageManager', 'videoManager', 'documentManager', 'categoryHeirarchy', 'HostingPlanData', 'ProductCombo', 'HostingProductDataArray');
        } else {
            $product = ProductsPackage::getRecordById($id);

            $ProductCombo = Products::getProductName($product->fkProduct);
//            echo  $product->fkWhmcsProductCategories; exit;
            $HostingParam = array('groupid' => $product->fkWhmcsProductCategories);
//            print_r($HostingParam); exit;
            $HostingProductData = MyLibrary::laravelcallapi("getproductdetails", $HostingParam);
            $i = 0;
//            print_r($HostingProductData); exit;
            foreach ($HostingProductData['products']['product'] as $data) {
                $HostingProductDataArray[$i]['text'] = $data['name'];
                $HostingProductDataArray[$i]['id'] = $data['pid'];
                $i++;
            }

            if (count((array)($product)) == 0) {
                return redirect()->route('powerpanel.products_package.add');
            }
            $metaInfo = array('varMetaTitle' => $product->varMetaTitle, 'varMetaKeyword' => $product->varMetaKeyword, 'varMetaDescription' => $product->varMetaDescription);
            $this->breadcrumb['title'] = trans('template.productpackageModule.editProductPackage') . ' - ' . $product->varTitle;
            $this->breadcrumb['module'] = trans('template.productpackageModule.manageProductPackage');
            $this->breadcrumb['url'] = 'powerpanel/products-package';
            $this->breadcrumb['inner_title'] = trans('template.productpackageModule.editProductPackage') . ' - ' . $product->varTitle;
            $breadcrumb = $this->breadcrumb;
            $data = compact('product', 'ProductCategory',  'metaInfo', 'breadcrumb', 'imageManager', 'videoManager', 'documentManager', 'categoryHeirarchy', 'HostingPlanData', 'ProductCombo', 'HostingProductDataArray');
        }
        return view('powerpanel.products_package.actions', $data);
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
        $messsages = array(
            'order.greater_than_zero' => trans('template.productpackageModule.displayGreaterThan'),
            'category_id.required' => 'category field is required.',
            'product_id.required' => 'product field is required.',
            'whmcs_category_id.required' => 'WHMCS category field is required.',
            'whmcs_product_id.required' => 'WHMCS product field is required.'
        );

        $rules = array(
            'title' => 'required|max:160',
            'display_order' => 'required|greater_than_zero',
            'specification' => 'required|max:500',
            'additional_offer' => 'required|max:160',
            'category_id' => 'required',
            'product_id' => 'required',
            'whmcs_category_id' => 'required',
            'whmcs_product_id' => 'required'
        );

        $validator = Validator::make($data, $rules, $messsages);
        if ($validator->passes()) {
            $productArr = [];
            $productArr['varTitle'] = trim($data['title']);
            $productArr['fkProductCategories'] = $data['category_id'];
            $productArr['fkProduct'] = $data['product_id'];
            $productArr['fkWhmcsProductCategories'] = $data['whmcs_category_id'];
            $productArr['fkWhmcsProduct'] = $data['whmcs_product_id'];
            $productArr['intOldPriceOneMonthINR'] = $data['old_price_one_month_inr'];
            $productArr['intOldPriceThreeMonthINR'] = $data['old_price_three_month_inr'];
            $productArr['intOldPriceSixMonthINR'] = $data['old_price_six_month_inr'];
            $productArr['intOldPriceOneYearINR'] = $data['old_price_one_year_inr'];
            $productArr['intOldPriceTwoYearINR'] = $data['old_price_two_year_inr'];
            $productArr['intOldPriceThreeYearINR'] = $data['old_price_three_year_inr'];
            $productArr['intOldPriceOneMonthUSD'] = $data['old_price_one_month_usd'];
            $productArr['intOldPriceThreeMonthUSD'] = $data['old_price_three_month_usd'];
            $productArr['intOldPriceSixMonthUSD'] = $data['old_price_six_month_usd'];
            $productArr['intOldPriceOneYearUSD'] = $data['old_price_one_year_usd'];
            $productArr['intOldPriceTwoYearUSD'] = $data['old_price_two_year_usd'];
            $productArr['intOldPriceThreeYearUSD'] = $data['old_price_three_year_usd'];
            $productArr['varAdditionalOffer'] = $data['additional_offer'];
            $productArr['txtSpecification'] = $data['specification'];
            $productArr['txtShortDescription'] = trim($data['additional_note']);
            $productArr['txtRecommandedFeatures'] = trim($data['recommandation_note']);
            $productArr['chrDisplayontop'] = isset($data['displayontop']) ? $data['displayontop'] : "N";
            $productArr['chrPublish'] = isset($data['chrMenuDisplay']) ? $data['chrMenuDisplay'] : 'Y';
            $productArr['varIpAddress'] = $request->ip();
            $productArr['varRefURL'] = $data['varRefURL'];

            $id = $request->segment(3);
            if (is_numeric($id)) { #Edit post Handler=======
                $product = ProductsPackage::getRecordForLogById($id);
                $whereConditions = ['id' => $product->id];
                $update = CommonModel::updateRecords($whereConditions, $productArr);
                if ($update) {
                    if (!empty($id)) {
                        self::swap_order_edit($data['display_order'], $product->id);

                        $logArr = MyLibrary::logData($product->id);
                        if (Auth::user()->can('log-advanced')) {
                            $newProductObj = ProductsPackage::getRecordForLogById($product->id);
                            $oldRec = $this->recordHistory($product);
                            $newRec = $this->recordHistory($newProductObj);
                            $logArr['old_val'] = $oldRec;
                            $logArr['new_val'] = $newRec;
                        }
                        $logArr['varTitle'] = trim($data['title']);
                        Log::recordLog($logArr);
                        if (Auth::user()->can('recent-updates-list')) {
                            if (!isset($newProductObj)) {
                                $newProductObj = ProductsPackage::getRecordForLogById($product->id);
                            }
                            $notificationArr = MyLibrary::notificationData($product->id, $newProductObj);
                            RecentUpdates::setNotification($notificationArr);
                        }
                    }
                    self::flushCache();
                    $actionMessage = trans('template.productpackageModule.updateMessage');
                }
            } else { #Add post Handler=======
                $productArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
                $productID = CommonModel::addRecord($productArr);
                if (!empty($productID)) {
                    $id = $productID;
                    $newProductObj = ProductsPackage::getRecordForLogById($id);
                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newProductObj->varTitle;
                    Log::recordLog($logArr);
                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newProductObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                    $actionMessage = trans('template.productpackageModule.addMessage');
                }
            }

            if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
                return redirect()->route('powerpanel.products-package.index')->with('message', $actionMessage);
            } else {
                return redirect()->route('powerpanel.products-package.edit', $id)->with('message', $actionMessage);
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
        $filterArr['categoryfilter'] = !empty(Input::get('categoryfilter')) ? Input::get('categoryfilter') : '';

        $sEcho = intval(Input::get('draw'));
        $arrResults = ProductsPackage::getRecordList($filterArr);
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
        $publish_action = '';
        $details = '';
        if (Auth::user()->can('products-edit')) {
            $details .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.products-package.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
        }
        if (Auth::user()->can('products-delete')) {
            $details .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="products-package" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
        }
        if (Auth::user()->can('products-publish')) {
            if ($value->chrPublish == 'Y') {
                $publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/products-package" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
            } else {
                $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/products-package" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
            }
        }
        $minus = '<span class="glyphicon glyphicon-minus"></span>';

        $imgIcon = '';
        if (isset($value->fkIntImgId) && !empty($value->fkIntImgId)) {
            $imageArr = explode(',', $value->fkIntImgId);
            if (count($imageArr) > 1) {
                $imgIcon .= '<div class="multi_image_thumb">';
                foreach ($imageArr as $key => $image) {
                    $imgIcon .= '<a href="' . resize_image::resize($image) . '" class="fancybox-thumb" rel="fancybox-thumb-' . $value->id . '" data-rel="fancybox-thumb">';
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
        $ProductName = '';
        $selCategory = ProductCategory::getCategoriesData($value->fkProductCategories);

        // echo "<pre>"; print_r($selCategory->varTitle); exit;

        $Product = Products::getProductData($value->fkProduct);
        $ProductName = $Product->varTitle;
        $category .= $selCategory->varTitle;

        $specification_explode = explode("\n", $value->txtSpecification);

        $spe_data = "";
        $i = 1;
        foreach ($specification_explode as $value1) {
            $spe_data .= $i . ". " . $value1 . "</br>";
            $i++;
        }

        $records = array(
            '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">',
            '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.products-package.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>',
            '<div class="pro-act-btn">
				<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Specification\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
				<div class="highslide-maincontent">' . $spe_data . '</div>',
            $category,
            $ProductName,
            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				' . $value->intDisplayOrder .
            ' <a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
            $publish_action,
            $details,
            $value->intDisplayOrder
        );

//        echo "<pre>";
//        print_r($records);exit;

        return $records;
    }

    public function getWHMCSProductAjax() {
        $order = Input::get('whmcs_prod_catval');
        if ($order != '') {
            $HostingParam = array('groupid' => $order);
            $HostingPlanData = MyLibrary::laravelcallapi("getproductdetails", $HostingParam);
            $i = 0;
            foreach ($HostingPlanData['products']['product'] as $data) {
                $HostingPlanDataArray[$i]['text'] = $data['name'];
                $HostingPlanDataArray[$i]['id'] = $data['pid'];
                $i++;
            }
            return $HostingPlanDataArray;
        }
    }

    public function getProductAjax() {
        $order = Input::get('prod_catval');
        if ($order != '') {
            $Product = Products::getProductName($order);
            return $Product;
        }
    }
    
    public function getProductAjax_test() {
        $order = Input::get('prod_catval');
        if ($order != '') {
            $array = array("LINUX_HOSTING","WINDOWS_HOSTING","RESELLER_HOSTING","DOMAIN_VALIDATION_SSL","VPS_HOSTING","DEDICATED_SERVERS","SUPPORT_SERVICE","WORDPRESS_HOSTING","WINDOWS_RESELLER_HOSTING","JAVA_HOSTING","ECOMMERCE_HOSTING");
            $exp = "";
            foreach ($array as $data) {
                $exp = str_replace("_", " ", $data);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_STARTER_PRICE_1',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD STARTER Price Showing for " . ucfirst($exp) . " (Product Package STARTER Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_PERFORMANCE_PRICE_1',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD PERFORMANCE Price Showing for " . ucfirst($exp) . " (Product Package PERFORMANCE Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_BUSINEESS_PRICE_1',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD BUSINEESS Price Showing for " . ucfirst($exp) . " (Product Package BUSINEESS Min Price)."
                    ]);
//                    ===
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_STARTER_PRICE_3',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD STARTER Price Showing for " . ucfirst($exp) . " (Product Package STARTER Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_PERFORMANCE_PRICE_3',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD PERFORMANCE Price Showing for " . ucfirst($exp) . " (Product Package PERFORMANCE Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_BUSINEESS_PRICE_3',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD BUSINEESS Price Showing for " . ucfirst($exp) . " (Product Package BUSINEESS Min Price)."
                    ]);
//                    ===
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_STARTER_PRICE_6',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD STARTER Price Showing for " . ucfirst($exp) . " (Product Package STARTER Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_PERFORMANCE_PRICE_6',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD PERFORMANCE Price Showing for " . ucfirst($exp) . " (Product Package PERFORMANCE Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_BUSINEESS_PRICE_6',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD BUSINEESS Price Showing for " . ucfirst($exp) . " (Product Package BUSINEESS Min Price)."
                    ]);
//                    ====
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_STARTER_PRICE_12',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD STARTER Price Showing for " . ucfirst($exp) . " (Product Package STARTER Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_PERFORMANCE_PRICE_12',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD PERFORMANCE Price Showing for " . ucfirst($exp) . " (Product Package PERFORMANCE Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_BUSINEESS_PRICE_12',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD BUSINEESS Price Showing for " . ucfirst($exp) . " (Product Package BUSINEESS Min Price)."
                    ]);
//                    ===
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_STARTER_PRICE_24',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD STARTER Price Showing for " . ucfirst($exp) . " (Product Package STARTER Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_PERFORMANCE_PRICE_24',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD PERFORMANCE Price Showing for " . ucfirst($exp) . " (Product Package PERFORMANCE Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_BUSINEESS_PRICE_24',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD BUSINEESS Price Showing for " . ucfirst($exp) . " (Product Package BUSINEESS Min Price)."
                    ]);
//                    ===
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_STARTER_PRICE_36',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD STARTER Price Showing for " . ucfirst($exp) . " (Product Package STARTER Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_PERFORMANCE_PRICE_36',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD PERFORMANCE Price Showing for " . ucfirst($exp) . " (Product Package PERFORMANCE Min Price)."
                    ]);
                    DB::table('whmcs_prices')->insert([
                        'fieldName' => $data . '_BUSINEESS_PRICE_36',
                        'INR' => '10.50',
                        'USD' => '11.50',
                        'Comment' => "This INR/USD BUSINEESS Price Showing for " . ucfirst($exp) . " (Product Package BUSINEESS Min Price)."
                    ]);
//                    DB::table('whmcs_prices')->insert([
//                        'fieldName' => 'PRODUCT_' . $data . '_PRICE_USD',
//                        'fieldValue' => '10.50',
//                        'Comment' => "This USD Price Showing for " . ucfirst($exp) . " (Product Min Price)."
//                    ]);
//                    DB::table('whmcs_prices')->insert([
//                        'fieldName' => 'MEGAMENU_' . $data . '_DISCOUNT_PRICE_INR',
//                        'fieldValue' => '10.50',
//                        'Comment' => "This Discount INR Price Showing Center at Megamenu for " . ucfirst($exp) . " menu under the Servers Menu."
//                    ]);
//                    DB::table('whmcs_prices')->insert([
//                        'fieldName' => 'MEGAMENU_' . $data . '_DISCOUNT_PRICE_USD',
//                        'fieldValue' => '10.50',
//                        'Comment' => "This Discount USD Price Showing Center at Megamenu for " . ucfirst($exp) . " menu under the Servers Menu."
//                    ]);
//                    DB::table('whmcs_prices')->insert([
//                        'fieldName' => 'MEGAMENU_' . $data . '_OFFER_PRICE_INR',
//                        'fieldValue' => '10.50',
//                        'Comment' => "This Offer INR Price Showing Right Side at Megamenu for " . ucfirst($exp) . " menu under the Servers Menu."
//                    ]);
//                    DB::table('whmcs_prices')->insert([
//                        'fieldName' => 'MEGAMENU_' . $data . '_OFFER_PRICE_USD',
//                        'fieldValue' => '10.50',
//                        'Comment' => "This Offer USD Price Showing Right Side at Megamenu for " . ucfirst($exp) . " menu under the Servers Menu."
//                    ]);
            }
            echo "<pre>";
            print_r($array);
            exit;
            $Product = Products::getProductName($order);
            return $Product;
        }
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

    public function makeFeatured() {
        $id = Input::get('id');
        $featured = Input::get('featured');
        $whereConditions = ['id' => $id];
        $update = CommonModel::updateRecords($whereConditions, ['varFeaturedProduct' => $featured]);
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

    public function recordHistory($data = false) {
        $returnHtml = '';
        $returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>' . trans("template.common.title") . '</th>
														<th>' . trans("template.common.image") . '</th>
														<th>' . trans("template.common.order") . '</th>
														<th>' . trans("template.common.shortDescription") . '</th>
														<th>' . trans("template.common.description") . '</th>
														<th>' . trans("template.productpackageModule.featuredProduct") . '</th>
														<th>' . trans("template.common.metatitle") . '/th>
														<th>' . trans("template.common.metakeyword") . '</th>
														<th>' . trans("template.common.metadescription") . '</th>
														<th>' . trans("template.common.publish") . '</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>' . $data->varTitle . '</td>';
        $returnHtml .= '<td>' . '<img height="50" width="50" src="' . resize_image::resize($data->fkIntImgId) . '" />' . '</td>
														
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

    public static function flushCache() {
        Cache::tags('Product')->flush();
        Cache::tags('ProductCategory')->flush();
    }

}
