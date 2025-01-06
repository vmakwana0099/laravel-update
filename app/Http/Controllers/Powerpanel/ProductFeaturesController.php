<?php



namespace App\Http\Controllers\Powerpanel;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Input;

use App\ProductFeatures;

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

use Carbon\Carbon;

use Cache;

use App\Helpers\Category_builder;

use App\Helpers\CategoryArrayBuilder;



class ProductFeaturesController extends PowerpanelController {



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

     * This method handels load ProductFeatures grid

     * @return  View

     * @since   2017-07-20

     * @author  NetQuick

     */

    public function index() {



        $total = CommonModel::getRecordCount();

        $this->breadcrumb['title'] = trans('template.productfeaturesModule.manageProductFeatures');

        return view('powerpanel.product_features.index', ['iTotalRecords' => $total, 'breadcrumb' => $this->breadcrumb]);

    }



    /**

     * This method handels list of faq with filters

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

        $filterArr['statusFilter'] = !empty(Input::get('customActionName')) ? Input::get('customActionName') : '';

        $filterArr['iDisplayLength'] = intval(Input::get('length'));

        $filterArr['iDisplayStart'] = intval(Input::get('start'));

//        echo $filterArr['searchFilter']; exit;searchFilter

        $sEcho = intval(Input::get('draw'));

        $arrResults = ProductFeatures::getRecordList($filterArr);



        $iTotalRecords = CommonModel::getRecordCount($filterArr, true);

        $end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];

        $end = $end > $iTotalRecords ? $iTotalRecords : $end;



        if (count($arrResults) > 0 && !empty($arrResults)) {

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

     * This method loads Product Features edit view

     * @param  	Alias of record

     * @return  View

     * @since   2017-07-21

     * @author  NetQuick

     */

    public function edit($alias = false) {



        $category = ProductCategory::getCatWithParent();

        $category = CategoryArrayBuilder::getArray($category);

        $ProductCategory = addslashes(json_encode($category));



        $categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false, false, '\App\ProductCategory');

        if (!is_numeric($alias)) {



            $total = CommonModel::getRecordCount();

            $total = $total + 1;

            $this->breadcrumb['title'] = trans('template.productfeaturesModule.addProductFeatures');

            $this->breadcrumb['module'] = trans('template.productfeaturesModule.manageProductFeatures');

            $this->breadcrumb['url'] = 'powerpanel/product-features';

            $this->breadcrumb['inner_title'] = trans('template.productfeaturesModule.addProductFeatures');

            $data = ['total' => $total, 'breadcrumb' => $this->breadcrumb, 'ProductCategory' => $ProductCategory, 'ProductCombo' => "", 'categoryHeirarchy' => $categoryHeirarchy];

        } else {

            $id = $alias;

            $productfeatures = ProductFeatures::getRecordById($id);

            $Product = Products::getProductName($productfeatures->fkProduct);

            if (count((array)($productfeatures)) == 0) {

                return redirect()->route('powerpanel.product-features.add');

            }

            $this->breadcrumb['title'] = trans('template.productfeaturesModule.editProductFeatures') . ' - ' . $productfeatures->varTitle;

            $this->breadcrumb['module'] = trans('template.productfeaturesModule.manageProductFeatures');

            $this->breadcrumb['url'] = 'powerpanel/product-features';

            $this->breadcrumb['inner_title'] = trans('template.productfeaturesModule.editProductFeatures') . ' - ' . $productfeatures->varTitle;

            $data = ['productfeatures' => $productfeatures, 'id' => $id, 'breadcrumb' => $this->breadcrumb, 'ProductCategory' => $ProductCategory, 'ProductCombo' => $Product, 'categoryHeirarchy' => $categoryHeirarchy];

        }

        return view('powerpanel.product_features.actions', $data);

    }



    public function getProductAjax() {

        $order = Input::get('prod_catval');

        if ($order != '') {

            $Product = Products::getProductName($order);

            return $Product;

        }

    }



    /**

     * This method stores ProductFeatures modifications

     * @return  View

     * @since   2017-07-21

     * @author  NetQuick

     */

    public function handlePost(Request $resquest) {



        $postArr = Input::all();

        $messsages = ['display_order.greater_than_zero' => trans('template.productfeaturesModule.displayGreaterThan')];

        $rules = [

            'title' => 'required|max:160',

            'listing_icon' => 'required|max:255',

            'short_description' => 'required|max:500',

            'order' => 'required|greater_than_zero',

            'chrMenuDisplay' => 'required'

        ];

        $validator = Validator::make($postArr, $rules, $messsages);

        if ($validator->passes()) {

            $id = $resquest->segment(3);

            $actionMessage = trans('template.common.oppsSomethingWrong');

            if (is_numeric($id)) { #Edit post Handler=======

                $productfeatures = ProductFeatures::getRecordForLogById($id);

                $updateProductFeaturesFields = [];

                $updateProductFeaturesFields['varTitle'] = trim($postArr['title']);

                $updateProductFeaturesFields['fkProductCategories'] = $postArr['category_id'];

                $updateProductFeaturesFields['varIconClass'] = $postArr['listing_icon'];

                $updateProductFeaturesFields['varShortDescription'] = $postArr['short_description'];

                $updateProductFeaturesFields['chrLandingPage'] = $postArr['LandingPage'];

                $updateProductFeaturesFields['varIpAddress'] = $resquest->ip();

                $updateProductFeaturesFields['varRefURL'] = $postArr['varRefURL'];

                if ($postArr['LandingPage'] == "N") {

                    $updateProductFeaturesFields['fkProduct'] = $postArr['product_id'];

                } else {

                    $updateProductFeaturesFields['fkProduct'] = "0";

                }

                $updateProductFeaturesFields['chrPublish'] = $postArr['chrMenuDisplay'];

                $whereConditions = ['id' => $id];

                $update = CommonModel::updateRecords($whereConditions, $updateProductFeaturesFields);

                if ($update) {

                    if ($id > 0 && !empty($id)) {

                        self::swap_order_edit($postArr['order'], $id);



                        $logArr = MyLibrary::logData($id);

                        if (Auth::user()->can('log-advanced')) {

                            $newProductFeaturesObj = ProductFeatures::getRecordForLogById($id);

                            $oldRec = $this->recordHistory($productfeatures);

                            $newRec = $this->recordHistory($newProductFeaturesObj);

                            $logArr['old_val'] = $oldRec;

                            $logArr['new_val'] = $newRec;

                        }



                        $logArr['varTitle'] = trim($postArr['title']);

                        Log::recordLog($logArr);



                        if (Auth::user()->can('recent-updates-list')) {

                            if (!isset($newProductFeaturesObj)) {

                                $newProductFeaturesObj = ProductFeatures::getRecordForLogById($id);

                            }

                            $notificationArr = MyLibrary::notificationData($id, $newProductFeaturesObj);

                            RecentUpdates::setNotification($notificationArr);

                        }

                        self::flushCache();

                        $actionMessage = trans('template.productfeaturesModule.updateMessage');

                    }

                }

            } else { #Add post Handler=======

                $productfeaturesArr['varTitle'] = trim($postArr['title']);

                $productfeaturesArr['fkProductCategories'] = $postArr['category_id'];

                if ($postArr['LandingPage'] == "N") {

                    $productfeaturesArr['fkProduct'] = $postArr['product_id'];

                } else {

                    $productfeaturesArr['fkProduct'] = "0";

                }

                $productfeaturesArr['varIconClass'] = $postArr['listing_icon'];

                $productfeaturesArr['chrLandingPage'] = $postArr['LandingPage'];

                $productfeaturesArr['varShortDescription'] = $postArr['short_description'];

                $productfeaturesArr['varIpAddress'] = $resquest->ip();

                $productfeaturesArr['varRefURL'] = $postArr['varRefURL'];

                $productfeaturesArr['intDisplayOrder'] = self::swap_order_add($postArr['order']);

                $productfeaturesArr['chrPublish'] = $postArr['chrMenuDisplay'];

                $productfeaturesArr['created_at'] = Carbon::now();



                $productfeaturesID = CommonModel::addRecord($productfeaturesArr);

                if (!empty($productfeaturesID)) {

                    $id = $productfeaturesID;

                    $newProductFeaturesObj = ProductFeatures::getRecordForLogById($id);

                    $logArr = MyLibrary::logData($id);

                    $logArr['varTitle'] = $newProductFeaturesObj->varTitle;

                    Log::recordLog($logArr);

                    if (Auth::user()->can('recent-updates-list')) {

                        $notificationArr = MyLibrary::notificationData($id, $newProductFeaturesObj);

                        RecentUpdates::setNotification($notificationArr);

                    }

                    self::flushCache();

                    $actionMessage = trans('template.productfeaturesModule.addMessage');

                }

            }



            if (!empty($postArr['saveandexit']) && $postArr['saveandexit'] == 'saveandexit') {

                return redirect()->route('powerpanel.product-features.index')->with('message', $actionMessage);

            } else {

                return redirect()->route('powerpanel.product-features.edit', $id)->with('message', $actionMessage);

            }

        } else {

            return Redirect::back()->withErrors($validator)->withInput();

        }

    }



    /**

     * This method destroys ProductFeatures in multiples

     * @return  ProductFeatures index view

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

     * This method destroys ProductFeatures in multiples

     * @return  ProductFeatures index view

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



    public function tableData($value) {

        $actions = '';

        $answer = '';

        $publish_action = '';

        $ProductCategory = ProductCategory::getCategoriesData($value->fkProductCategories);

        $CategoryName = $ProductCategory->varTitle;

        if ($value->fkProduct != 0) {

            $Product = Products::getProductData($value->fkProduct);

            $ProductName = $Product->varTitle;

        } else {

            $ProductName = "-";

        }

        if (Auth::user()->can('faq-edit')) {

            $actions .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.product-features.edit', array('alias' => $value->id)) . '">

				<i class="fa fa-pencil"></i></a>';

        }



        if (Auth::user()->can('faq-delete')) {

            $actions .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="faq" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';

        }



        if (Auth::user()->can('faq-publish')) {

            if ($value->chrPublish == 'Y') {

                $publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/product-features" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';

            } else {

                $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/product-features" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';

            }

        }

        $answer .= '<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Answer\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="fa fa-commenting-o"></span></a>';

        $answer .= '<div class="highslide-maincontent">' . $value->varShortDescription . '</div>';

        if (Auth::user()->can('faq-edit')) {

            $title = '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.product-features.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';

        } else {

            $title = $value->varTitle;

        }

        $records = array(

            '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">',

            $title,

            $CategoryName,

            $ProductName,

            $answer,

            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 

				' . $value->intDisplayOrder .

            ' <a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',

            $publish_action,

            $actions,

            $value->intDisplayOrder,

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

        $returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">

				<thead>

					<tr>

						<th>' . trans('template.common.title') . '</th>						

						<th>' . trans('template.common.answer') . '</th>

						<th>' . trans('template.common.displayorder') . '</th>

						<th>' . trans("template.common.publish") . '</th>

					</tr>

				</thead>

				<tbody>

					<tr>

						<td>' . $data->varTitle . '</td>						

						<td>' . $data->varShortDescription . '</td>

						<td>' . ($data->intDisplayOrder) . '</td>

						<td>' . $data->chrPublish . '</td>

					</tr>

				</tbody>

			</table>';



        return $returnHtml;

    }



    public static function flushCache() {

        Cache::tags('ProductFeatures')->flush();

    }



}

