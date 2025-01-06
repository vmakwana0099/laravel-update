<?php

namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\Casestudy;
use App\Pagehit;
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
//use App\Helpers\AddVideoModelRel;
//use App\Helpers\AddDocumentModelRel;
use App\Helpers\MyLibrary;
use Auth;
use App\Helpers\resize_image;
use Cache;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;

class CasestudyController extends PowerpanelController {

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
        $this->breadcrumb['title'] = trans('template.casestudyModule.manageCasestudy');
        $breadcrumb = $this->breadcrumb;
        return view('powerpanel.casestudies.index', compact('iTotalRecords', 'breadcrumb', 'CatData'));
    }

    /**
     * This method loads product edit view
     * @param   Alias of record
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function edit($id = false) {
        
        $imageManager = true;
        $videoManager = true;
        $documentManager = true;
        if (!is_numeric($id)) {
            $total = CommonModel::getRecordCount();
            $total = $total + 1;
            $this->breadcrumb['title'] = trans('template.casestudyModule.manageCasestudy');
            $this->breadcrumb['module'] = trans('template.casestudyModule.manageCasestudy');
            $this->breadcrumb['url'] = 'powerpanel/casestudy';
            $this->breadcrumb['inner_title'] = trans('template.casestudyModule.addCasestudy');
            $breadcrumb = $this->breadcrumb;
            $data = compact('total', 'breadcrumb', 'imageManager');
        } else {
            $casestudy = Casestudy::getRecordById($id);
            //echo '<pre>';print_r($product);exit;
            if (count((array)($casestudy)) == 0) {
                return redirect()->route('powerpanel.castudy.add');
            }
            $metaInfo = array('varMetaTitle' => $casestudy->varMetaTitle, 'varMetaKeyword' => $casestudy->varMetaKeyword, 'varMetaDescription' => $casestudy->varMetaDescription);
            $this->breadcrumb['title'] = trans('template.casestudyModule.editCasestudy') . ' - ' . $casestudy->varTitle;
            $this->breadcrumb['module'] = trans('template.casestudyModule.manageCasestudy');
            $this->breadcrumb['url'] = 'powerpanel/casestudy';
            $this->breadcrumb['inner_title'] = trans('template.casestudyModule.editCasestudy') . ' - ' . $casestudy->varTitle;
            $breadcrumb = $this->breadcrumb;
            $data = compact('casestudy', 'metaInfo', 'breadcrumb', 'imageManager');
        }

        return view('powerpanel.casestudies.actions', $data);
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
            'order.greater_than_zero' => trans('template.casestudyModule.displayGreaterThan'),
            'img_id.required' => 'image field is required.',
            'varMetaTitle.required' => 'Meta Title field is required.',
            'varMetaKeyword.required' => 'Meta Keyword field is required.',
            'varMetaDescription.required' => 'Meta Description field is required.'
        );

        $rules = array(
            'title' => 'required|max:150',
            'display_order' => 'required|greater_than_zero',
            'short_description' => 'required|max:400',
            'varMetaTitle' => 'required|max:500',
            'varMetaKeyword' => 'required|max:500',
            'varMetaDescription' => 'required|max:500',
            'img_id' => 'required',
        );

        $validator = Validator::make($data, $rules, $messsages);

        if ($validator->passes()) {
            $casestudyArr = [];
            $casestudyArr['varTitle'] = trim($data['title']);
            $casestudyArr['fkIntImgId'] = !empty($data['img_id']) ? $data['img_id'] : null;
            $casestudyArr['txtShortDescription'] = trim($data['short_description']);
            $casestudyArr['txtDescription'] = $data['description'];
            $casestudyArr['txtHomePageDesc'] = $data['homepage_description'];
           
            $casestudyArr['varMetaTitle'] = trim($data['varMetaTitle']);
            $casestudyArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
            $casestudyArr['varMetaDescription'] = trim($data['varMetaDescription']);
            $casestudyArr['chrPublish'] = isset($data['chrMenuDisplay']) ? $data['chrMenuDisplay'] : 'Y';
            $casestudyArr['varTagLine'] = trim($data['tag_line']);
            $casestudyArr['varIpAddress'] = $request->ip();
            $casestudyArr['varRefURL'] = $data['varRefURL'];

            $casestudyArr['chrDisplayonhomepage'] = isset($data['displayonhome']) ? $data['displayonhome'] : "N";

            $id = $request->segment(3);
            if (is_numeric($id)) { #Edit post Handler=======
                if ($data['oldAlias'] != $data['alias']) {
                    Alias::updateAlias($data['oldAlias'], $data['alias']);
                }
                $casestudy = Casestudy::getRecordForLogById($id);
                $whereConditions = ['id' => $casestudy->id];
                $update = CommonModel::updateRecords($whereConditions, $casestudyArr);
                if ($update) {

                    if (!empty($id)) {
                        self::swap_order_edit($data['display_order'], $casestudy->id);

                        $logArr = MyLibrary::logData($casestudy->id);
                        if (Auth::user()->can('log-advanced')) {
                            $newCasestudyObj = Casestudy::getRecordForLogById($casestudy->id);
                            $oldRec = $this->recordHistory($casestudy);
                            $newRec = $this->recordHistory($newCasestudyObj);
                            $logArr['old_val'] = $oldRec;
                            $logArr['new_val'] = $newRec;
                        }
                        $logArr['varTitle'] = trim($data['title']);
                        Log::recordLog($logArr);
                        if (Auth::user()->can('recent-updates-list')) {
                            if (!isset($newCasestudyObj)) {
                                $newCasestudyObj = Casestudy::getRecordForLogById($casestudy->id);
                            }
                            $notificationArr = MyLibrary::notificationData($casestudy->id, $newCasestudyObj);
                            RecentUpdates::setNotification($notificationArr);
                        }
                    }
                    self::flushCache();
                    $actionMessage = trans('template.casestudyModule.updateMessage');
                }
            } else { 


                #Add post Handler=======
                $casestudyArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
                $casestudyArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
                $casestudyID = CommonModel::addRecord($casestudyArr);
                if (!empty($casestudyID)) {
                   
                    $id = $casestudyID;
                    $newCasestudyObj = Casestudy::getRecordForLogById($id);
                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newCasestudyObj->varTitle;

                    Log::recordLog($logArr);
                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newCasestudyObj);
                        RecentUpdates::setNotification($notificationArr);
                    }

                     self::flushCache();   
                    $actionMessage = trans('template.casestudyModule.addMessage');

                }
            }
            AddImageModelRel::sync(explode(',', $data['img_id']), $id);
//            AddVideoModelRel::sync(explode(',', $data['video_id']), $id);
//            AddDocumentModelRel::sync(explode(',', $data['doc_id']), $id);
            if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
                return redirect()->route('powerpanel.casestudy.index')->with('message', $actionMessage);
            } else {
                return redirect()->route('powerpanel.casestudy.edit', $id)->with('message', $actionMessage);
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
        //$filterArr['productFilter'] = !empty(Input::get('productFilter')) ? Input::get('productFilter') : '';
        $filterArr['paymentFilter'] = !empty(Input::get('paymentFilter')) ? Input::get('paymentFilter') : '';
        $filterArr['iDisplayLength'] = intval(Input::get('length'));
        $filterArr['iDisplayStart'] = intval(Input::get('start'));
        $filterArr['categoryfilter'] = !empty(Input::get('categoryfilter')) ? Input::get('categoryfilter') : '';

        $sEcho = intval(Input::get('draw'));

        $arrResults = Casestudy::getRecordList($filterArr);
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

        $webHits = Pagehit::where('isWeb', 'Y')->where('fkIntAliasId', $value->id)->where('intFKModuleCode','61')->count();
        $mobileHits = Pagehit::where('isWeb', 'N')->where('fkIntAliasId', $value->id)->where('intFKModuleCode','61')->count();
        
        $publish_action = '';
        $details = '';
        $titleData = '';
        $total = 0;

        if (Auth::user()->can('casestudy-edit')) {
            $details .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.casestudy.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
        }
        if (Auth::user()->can('casestudy-delete')) {
            $details .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="casestudy" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
        }
        if (Auth::user()->can('casestudy-publish')) {
           
                if ($value->chrPublish == 'Y') {
                    $publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/casestudy" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
                } else {
                    $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/casestudy" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
                }
            
        }

        $checkbox = '<a href="javascript:;" data-toggle="tooltip" data-placement="right" data-toggle="tooltip" data-original-title="' . $titleData . '" title="' . $titleData . '"><i style="color:red" class="fa fa-exclamation-triangle"></i></a>';

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
       
        $records = array(
             $checkbox,
            '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.casestudy.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>',            
            '<div class="pro-act-btn">
                <a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'' . trans("template.common.shortdescription") . '\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
                <div class="highslide-maincontent">' . $value->txtShortDescription . '</div>
                </div>',
            $imgIcon,
            $webHits,
            $mobileHits,
            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
                ' . $value->intDisplayOrder .' <a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
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
                                                        <th>' . trans("template.productModule.featuredProduct") . '</th>
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
        Cache::tags('casestuy')->flush();
    }

}
