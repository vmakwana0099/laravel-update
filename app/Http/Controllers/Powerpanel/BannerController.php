<?php

namespace App\Http\Controllers\Powerpanel;

use Auth;
use Cache;
use Crypt;
use Input;
use App\Log;
use App\Alias;
use App\Video;
use Validator;
use App\Banner;
use App\CmsPage;
use App\Modules;
use Carbon\Carbon;
use App\CommonModel;
use App\RecentUpdates;
use App\Helpers\MyLibrary;
use App\Helpers\SocialShare;
use Illuminate\Http\Request;
use App\Helpers\resize_image;
use App\Helpers\AddImageModelRel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerpanelController;

class BannerController extends PowerpanelController {

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
     * This method handels load banner grid
     * @return  View
     * @since   2017-07-20
     * @author  NetQuick
     */
    public function index() {
        $total = CommonModel::getRecordCount();
        $cms_pages = $total > 0 ? CmsPage::getPagesWithModule() : null;
        $this->breadcrumb['title'] = trans('template.bannerModule.manage');
        return view('powerpanel.banners.list', ['total' => $total, 'cms_pages' => $cms_pages, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * This method handels list of banner with filters
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
        $filterArr['bannerFilter'] = !empty(Input::get('bannerFilter')) ? Input::get('bannerFilter') : '';
        $filterArr['bannerFilterType'] = !empty(Input::get('bannerFilterType')) ? Input::get('bannerFilterType') : '';
        $filterArr['pageFilter'] = !empty(Input::get('pageFilter')) ? Input::get('pageFilter') : '';
        $filterArr['iDisplayLength'] = intval(Input::get('length'));
        $filterArr['iDisplayStart'] = intval(Input::get('start'));

        $sEcho = intval(Input::get('draw'));
        $arrResults = Banner::getRecordList($filterArr);
        $iTotalRecords = CommonModel::getRecordCount($filterArr, true);
        $end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (count($arrResults) > 0 && !empty($arrResults)) {
            $homeBannerCount = Banner::homeBannerCount();
            $innerBannerCount = Banner::innerBannerCount();
            foreach ($arrResults as $key => $value) {
                $records["data"][] = $this->tableData($value, $homeBannerCount, $innerBannerCount);
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
     * This method loads banner edit view
     * @param   Alias of record
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function edit($id = false) {
        $module = Modules::getFrontModuleList();
        
        if (!is_numeric($id)) {
            $total = CommonModel::getRecordCount();
            $total = $total + 1;
            $this->breadcrumb['title'] = trans('template.bannerModule.add');
            $this->breadcrumb['module'] = trans('template.bannerModule.manage');
            $this->breadcrumb['url'] = 'powerpanel/banners';
            $this->breadcrumb['inner_title'] = trans('template.bannerModule.add');
            $breadcrumb = $this->breadcrumb;
            $data = ['modules' => $module, 'total_banner' => $total, 'breadcrumb' => $this->breadcrumb, 'imageManager' => true, 'videoManager' => true];
        } else {
            $banners = Banner::getRecordById($id);
            if (count((array)($banners)) == 0) {
                return redirect()->route('powerpanel.banners.add');
            }
            $this->breadcrumb['title'] = trans('template.common.edit') . ' - ' . $banners->varTitle;
            $this->breadcrumb['module'] = trans('template.bannerModule.manage');
            $this->breadcrumb['url'] = 'powerpanel/banners';
            $this->breadcrumb['inner_title'] = trans('template.common.edit') . ' - ' . $banners->varTitle;
            $breadcrumb = $this->breadcrumb;
            $data = ['banners' => $banners, 'modules' => $module, 'breadcrumb' => $this->breadcrumb, 'imageManager' => true, 'videoManager' => true];
        }
        return view('powerpanel.banners.actions', $data);
    }

    // vikram 10/10/2019
    public function checkurl(Request $request){
        if($request->ajax()){
            $url = request('url');
            // echo $url;exit;
            try {
                // $data = file_get_contents($url);
                 
                // Initialize a CURL session. 
                $ch = curl_init();  
                  
                // Return Page contents. 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                  
                //grab URL and pass it to the variable. 
                curl_setopt($ch, CURLOPT_URL, $url); 
                  
                $result = curl_exec($ch); 
                // echo $result;exit;
                if ($result){
                    return 1;
                }
            } catch (\Throwable $th) {
                return 0;
            }
        }
    }
    // end

    /**
     * This method stores banner modifications
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function handlePost(Request $request) {
        $postArr = Input::all();  
        // return ($request);
               // echo "<pre>";
               // print_r($postArr);exit;
        $bannerFields = [];
        $actionMessage = trans('template.common.oppsSomethingWrong');

        $finalbanerversion = $postArr['bannerversion'];

        $rules = array(
            'title' => 'required|max:160',
            'banner_type' => 'required',
            'display_order' => 'required|greater_than_zero',
            'chrMenuDisplay' => 'required'
        );

        if (isset($postArr['banner_type']) && $postArr['banner_type'] != 'home_banner') {
            $rules['modules'] = 'required';
            $rules['foritem'] = 'required';
        }

        if ($postArr['banner_type'] == 'home_banner') {

            $rules['tag_line'] = 'required';
            // vikram 10/10/2019
            $reles['dsk_source_url'] = 'required';
            $reles['mobi_source_url'] = 'required';
            $reles['ipad_source_url'] = 'required'; 
            // end
            /*$rules['title_feature1'] = 'required';
            $rules['title_feature2'] = 'required';
            $rules['title_feature3'] = 'required';
            $rules['title_feature4'] = 'required';
            $rules['feature1_icon'] = 'required';
            $rules['feature2_icon'] = 'required';
            $rules['feature3_icon'] = 'required';
            $rules['feature4_icon'] = 'required';*/


            // $rules['button_text'] = 'required';
            // $rules['button_link'] = 'required';
            // $rules['img_id'] = 'required';
            $rules['bannerversion'] = 'required';

            // if ($postArr['bannerversion'] == 'vid_banner') {
            //     //$rules['video_id'] = 'required';
            //     $reles['dsk_source_url'] = 'required';
            //     $reles['mobi_source_url'] = 'required';
            //     $reles['ipad_source_url'] = 'required';
            //     // $postArr['img_id'] = null;
            // } else {
            //     // vikram 10/10/2019
            //     if ($postArr['bannerfrom'] == 'from_src'){
            //         $rules['img_id'] = 'required';
            //         $postArr['dsk_source_url'] = null;
            //         $postArr['mobi_source_url'] = null;
            //         $postArr['ipad_source_url'] = null;
            //     }else{
            //         $reles['dsk_source_url'] = 'required';
            //         $reles['mobi_source_url'] = 'required';
            //         $reles['ipad_source_url'] = 'required';
            //         // $postArr['img_id'] = null;
            //     }
            //     // end
            // }
            if ($postArr['bannerversion'] == 'html_banner') {
                // $rules['txt_custom_csspath'] = 'required';
                $rules['htmlbanner'] = 'required';
                /*$rules['img_id'] = 'required';*/
                $postArr['video_id'] = null;
            }elseif($postArr['bannerversion'] == 'img_banner'){
                // vikram 10/10/2019
                if ($postArr['bannerfrom'] == 'from_src'){
                    $rules['img_id'] = 'required';
                    $postArr['video_id'] = null;
                    $postArr['dsk_source_url'] = null;
                    $postArr['mobi_source_url'] = null;
                    $postArr['ipad_source_url'] = null;
                }elseif($postArr['bannerfrom'] == 'from_url'){
                    $rules['dsk_source_url'] = 'required';
                    $rules['mobi_source_url'] = 'required';
                    $rules['ipad_source_url'] = 'required';
                    $postArr['img_id'] = null;
                    $postArr['video_id'] = null;
                }
                // end
                // $postArr['img_id'] = null;
            }elseif($postArr['bannerversion'] == 'vid_banner'){
                if ($postArr['bannerfrom'] == 'from_src'){
                    $rules['video_id'] = 'required';
                    $postArr['img_id'] = null;
                    $postArr['dsk_source_url'] = null;
                    $postArr['mobi_source_url'] = null;
                    $postArr['ipad_source_url'] = null;
                }else{
                    $rules['dsk_source_url'] = 'required';
                    $rules['mobi_source_url'] = 'required';
                    $rules['ipad_source_url'] = 'required';
                    $postArr['img_id'] = null;
                    $postArr['video_id'] = null;
                }
            }

            // vikram 10/10/2019
            // if ($postArr['bannerfrom'] == 'from_src'){
            //     $rules['img_id'] = 'required';

            // }else{
            //     $reles['dsk_source_url'] = 'required';
            //     $reles['mobi_source_url'] = 'required';
            //     $reles['ipad_source_url'] = 'required';
            // }
            // end

        } elseif($postArr['banner_type'] == 'inner_banner'){

            if ($postArr['bannerversion'] == 'html_banner') {
                // $rules['txt_custom_csspath'] = 'required';
                $rules['htmlbanner'] = 'required';
                // $rules['img_id'] = 'required';
                $postArr['video_id'] = null;
            }elseif($postArr['bannerversion'] == 'img_banner'){
                // vikram 10/10/2019
                if ($postArr['bannerfrom'] == 'from_src'){
                    // $rules['img_id'] = 'required';
                    $postArr['video_id'] = null;
                    $postArr['dsk_source_url'] = null;
                    $postArr['mobi_source_url'] = null;
                    $postArr['ipad_source_url'] = null;
                }elseif($postArr['bannerfrom'] == 'from_url'){
                    $rules['dsk_source_url'] = 'required';
                    $rules['mobi_source_url'] = 'required';
                    $rules['ipad_source_url'] = 'required';
                    $postArr['img_id'] = null;
                    $postArr['video_id'] = null;
                }
                // end
                // $postArr['img_id'] = null;
            }elseif($postArr['bannerversion'] == 'vid_banner'){
                if ($postArr['bannerfrom'] == 'from_src'){
                    $rules['video_id'] = 'required';
                    $postArr['img_id'] = null;
                    $postArr['dsk_source_url'] = null;
                    $postArr['mobi_source_url'] = null;
                    $postArr['ipad_source_url'] = null;
                }else{
                    $rules['dsk_source_url'] = 'required';
                    $rules['mobi_source_url'] = 'required';
                    $rules['ipad_source_url'] = 'required';
                    $postArr['img_id'] = null;
                    $postArr['video_id'] = null;
                }
            }

        }else {
            // $rules['img_id'] = 'required';
        }

        $messsages = array(
            'img_id.required' => trans('template.bannerModule.bannerValidation'),
            'display_order.greater_than_zero' => trans('template.bannerModule.displayGreaterThan'),
            'modules.required' => trans('template.bannerModule.moduleValidationMessage'),
            'foritem.required' => trans('template.bannerModule.pageValidationMessage')
        );

        $validator = Validator::make($postArr, $rules, $messsages);
        
        if ($validator->passes()) {          
            $pageId = 0;
            if ($postArr['banner_type'] == 'inner_banner') {
                
                $moduleId = $postArr['modules'];
                $pageId = $postArr['foritem'];
                $bannerFields['fkIntImgId'] = $postArr['img_id'];
                $bannerFields['varSecond_Title'] = $postArr['second_title'];
                $bannerFields['varIcon_Class'] = $postArr['icon_class'];
                $bannerFields['VarButtonText1'] = $postArr['button_text1'];
                $bannerFields['VarButtonLink1'] = $postArr['button_link1'];
                $bannerFields['VarButtonText2'] = $postArr['button_text2'];
                $bannerFields['VarButtonLink2'] = $postArr['button_link2'];
                $bannerFields['txt_custom_csspath'] = $postArr['txt_custom_csspath'];
                $bannerFields['fkIntVideoId'] = $postArr['video_id'];
                $bannerFields['dasktopSourceUrl'] = $postArr['dsk_source_url'];
                $bannerFields['mobileSourceUrl'] = $postArr['mobi_source_url'];
                $bannerFields['ipadSourceUrl'] = $postArr['ipad_source_url'];
                $bannerFields['varTagLine'] = null;
                $bannerFields['varTagLine'] = null;
                $bannerFields['varTitle_feature1'] = null;
                $bannerFields['varFeature1_iconclass'] = null;
                $bannerFields['varTitle_feature2'] = null;
                $bannerFields['varFeature2_iconclass'] = null;
                $bannerFields['varTitle_feature3'] = null;
                $bannerFields['varFeature3_iconclass'] = null;
                $bannerFields['varTitle_feature4'] = null;
                $bannerFields['varFeature4_iconclass'] = null;
                $bannerFields['VarButtonText'] = null;      
                $bannerFields['VarButtonLink'] = null;              
                $bannerFields['special_offerTitle'] = null;
                $bannerFields['special_offertext'] = null;
                $bannerFields['discount_percentage'] = null;
            } else {
                $homePage = CmsPage::getHomePage();
                if (!empty($homePage->id)) {
                    $moduleId = $homePage->modules->id;
                    $pageId = $homePage->id;
                }
                if ($postArr['bannerversion'] == 'vid_banner') {
                    //$bannerFields['fkIntVideoId'] = $postArr['video_id'];
                    // $bannerFields['fkIntVideoId'] = null;
                    $bannerFields['fkIntVideoId'] = $postArr['video_id'];
                    $bannerFields['fkIntImgId'] = null;
                                       
                } else {
                    $bannerFields['fkIntImgId'] = $postArr['img_id'];
                    $bannerFields['fkIntVideoId'] = null;
                }
                $bannerFields['varTagLine'] = $postArr['tag_line'];

                // vikram 10/10/2019
                $bannerFields['dasktopSourceUrl'] = $postArr['dsk_source_url'];
                $bannerFields['mobileSourceUrl'] = $postArr['mobi_source_url'];
                $bannerFields['ipadSourceUrl'] = $postArr['ipad_source_url'];
                /*$bannerFields['dsk_source_class'] = isset($postArr['dsk_source_class'])&&!empty($postArr['dsk_source_class'])?$postArr['dsk_source_class']:"";
                $bannerFields['mobi_source_class'] = isset($postArr['mobi_source_class'])&&!empty($postArr['mobi_source_class'])?$postArr['mobi_source_class']:"";
                $bannerFields['ipad_source_class'] = isset($postArr['ipad_source_class'])&&!empty($postArr['ipad_source_class'])?$postArr['ipad_source_class']:"";*/
                $bannerFields['txt_custom_csspath'] = isset($postArr['txt_custom_csspath'])&&!empty($postArr['txt_custom_csspath'])?$postArr['txt_custom_csspath']:"";
                // end

                $bannerFields['varTitle_feature1'] = $postArr['title_feature1'];
                $bannerFields['varFeature1_iconclass'] = $postArr['feature1_icon'];
                $bannerFields['varTitle_feature2'] = $postArr['title_feature2'];
                $bannerFields['varFeature2_iconclass'] = $postArr['feature2_icon'];
                $bannerFields['varTitle_feature3'] = $postArr['title_feature3'];
                $bannerFields['varFeature3_iconclass'] = $postArr['feature3_icon'];
                $bannerFields['varTitle_feature4'] = $postArr['title_feature4'];
                $bannerFields['varFeature4_iconclass'] = $postArr['feature4_icon'];
                $bannerFields['VarButtonText'] = $postArr['button_text'];
                $bannerFields['VarButtonLink'] = $postArr['button_link'];
                if (isset($postArr['special_offerTitle'])){
                    $bannerFields['special_offerTitle'] = $postArr['special_offerTitle'];    
                }
                if (isset($postArr['special_offertext'])){
                    $bannerFields['special_offertext'] = $postArr['special_offertext'];    
                }
                if (isset($postArr['discount_percentage'])){
                     $bannerFields['discount_percentage'] = $postArr['discount_percentage'];
                }
                if (isset($postArr['second_title'])){
                     $bannerFields['varSecond_Title'] = $postArr['second_title'];
                }

                $bannerFields['varSecond_Title'] = null;
                $bannerFields['varIcon_Class'] = null;
            }
            
            $bannerFields['varTitle'] = trim($postArr['title']);
            $bannerFields['varBannerType'] = $postArr['banner_type'];
            $bannerFields['varBannerVersion'] = $postArr['bannerversion'];
            $bannerFields['fkIntPageId'] = $pageId;
            $bannerFields['fkModuleId'] = $moduleId;
            // $bannerFields['txtDescription'] = $postArr['description'];
            $bannerFields['txtbannerhtml'] = $postArr['htmlbanner'];
            $bannerFields['chrPublish'] = $postArr['chrMenuDisplay'];
            $bannerFields['chrDefaultBanner'] = !empty($postArr['defaultBanner']) ? $postArr['defaultBanner'] : 'N';
            $bannerFields['varIpAddress'] = $request->ip();
            $bannerFields['varRefURL'] = $postArr['varRefURL'];
            $bannerFields['chr_full_width'] = $postArr['full_width'];
            
            // echo print_r($bannerFields['ipadSourceUrl']);exit;
            
            $id = $request->segment(3);
            if (is_numeric($id)) { #Edit post Handler=======
                
                $banner = Banner::getRecordForLogById($id);
                $whereConditions = ['id' => $id];
                $update = CommonModel::updateRecords($whereConditions, $bannerFields);
                if ($update) {
                    if (!empty($id)) {

                        self::swap_order_edit($postArr['display_order'], $id);

                        $logArr = MyLibrary::logData($id);
                        if (Auth::user()->can('log-advanced')) {
                            $newBannerObj = Banner::getRecordForLogById($id);
                            $oldRec = $this->recordHistory($banner);
                            $newRec = $this->recordHistory($newBannerObj);
                            $logArr['old_val'] = $oldRec;
                            $logArr['new_val'] = $newRec;
                        }
                        $logArr['varTitle'] = trim($postArr['title']);
                        Log::recordLog($logArr);
                        if (Auth::user()->can('recent-updates-list')) {
                            if (!isset($newBannerObj)) {
                                $newBannerObj = Banner::getRecordForLogById($id);
                            }
                            $notificationArr = MyLibrary::notificationData($id, $newBannerObj);
                            RecentUpdates::setNotification($notificationArr);
                        }
                    }
                    self::flushCache();
                    $actionMessage = trans('template.bannerModule.updateMessage');
                }
            } else { #Add post Handler=======

                $bannerFields['intDisplayOrder'] = self::swap_order_add($postArr['display_order']);
                $bannerID = CommonModel::addRecord($bannerFields);
                if (!empty($bannerID)) {
                    $id = $bannerID;
                    $newBannerObj = Banner::getRecordForLogById($id);

                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newBannerObj->varTitle;
                    Log::recordLog($logArr);

                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newBannerObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                    $actionMessage = trans('template.bannerModule.addedMessage');
                }
            }

            AddImageModelRel::sync(explode(',', $postArr['img_id']), $id);

            if (!empty($postArr['saveandexit']) && $postArr['saveandexit'] == 'saveandexit') {
                return redirect()->route('powerpanel.banners.index')->with('message', $actionMessage);
            } else {
                return redirect()->route('powerpanel.banners.edit', $id)->with('message', $actionMessage);
            }
        } else {
           
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    /**
     * This method destroys Banner in multiples
     * @return  Banner index view
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
     * This method destroys Banner in multiples
     * @return  Banner index view
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
     * This method assigns default banner flag
     * @return  Banner index view data
     * @since   2016-12-10
     * @author  NetQuick
     */
    public function makeDefault() {
        $id = Input::get('alias');
        $val = Input::get('val');
        if (!empty($val) && ($val == 'rm-default')) {
            $update = Banner::setDefault($id, ['chrDefaultBanner' => 'N']);
            if ($update) {
                $logArr = MyLibrary::logData($id);
                $logArr['action'] = 'remove-default-banner';
                Log::recordLog($logArr);
                self::flushCache();
            }
        }
        if (!empty($val) && ($val == 'default')) {
            $update = Banner::setDefault($id, ['chrDefaultBanner' => 'Y']);
            if ($update) {
                $logArr = MyLibrary::logData($id);
                $logArr['action'] = 'made-default-banner';
                Log::recordLog($logArr);
                self::flushCache();
            }
        }
        echo json_encode($update);
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

    /**
     * This method handels getting category and it's records (ajax)  
     * @return  	JSON object
     * @since   	2016-12-23
     * @author  	NetQuick
     */
    public static function selectRecords() {
        $data = Input::get();
        $module = $data['module'];

        $selected = $data['selected'];
        $model = '\\App\\' . $data['model'];
        $module = Modules::getModule($module);

        $recordSelect = '<option value=" ">--' . trans('template.bannerModule.selectPage') . '--</option>';

        if ($module->varModuleName == "pages") {
            $moduleRec = $model::getPagesWithModule();
            foreach ($moduleRec as $record) {
                if (strtolower($record->varTitle) != 'home') {
                    if (Auth::user()->can($record->modules->varModuleName . '-list')) {
                        $recordSelect .= '<option data-moduleid="' . $module->id . '" value="' . $record->id . '" ' . ($record->id == $selected ? 'selected' : '') . '>' . ucwords($record->varTitle) . '</option>';
                    }
                }
            }
        } else {
            $moduleRec = $model::getRecordList();
            foreach ($moduleRec as $record) {
                if (strtolower($record->varTitle) != 'home') {
                    $recordSelect .= '<option data-moduleid="' . $module->id . '" value="' . $record->id . '" ' . ($record->id == $selected ? 'selected' : '') . '>' . ucwords($record->varTitle) . '</option>';
                }
            }
        }

        return $recordSelect;
    }

    public function tableData($value, $iTotalHomeBannerRecords, $iTotalInnerBannerRecords) {

        $image = '';
        $actions = '';
        $banner_type = '';
        $checkbox = '';
        $publish_action = '';
        if (Auth::user()->can('banners-edit')) {
            $actions .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.banners.edit', array('alias' => $value->id)) . '">
				<span><i class="fa fa-pencil"></i></a>';
        }

        if ($value->varBannerType == 'home_banner') {
            if (($iTotalHomeBannerRecords > 1)) {
                if (Auth::user()->can('banners-delete')) {
                    $actions .= '<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="banners" data-alias="' . $value->id . '"><i class="fa fa-times"></i></a>';
                }
                $checkbox = '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">';
            } else {
                $checkbox = '<a href="javascript:;" data-toggle="tooltip" data-placement="right" data-toggle="tooltip" title="This is default banner so can&#39;t be deleted."><i style="color:red" class="fa fa-exclamation-triangle"></i></a>';
            }
        }

        if ($value->varBannerType == 'inner_banner') {
            if ($value->chrDefaultBanner == 'Y') {
                if (($iTotalInnerBannerRecords > 1)) {
                    if (Auth::user()->can('banners-delete')) {
                        $actions .= '<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="banners" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
                    }
                    $checkbox = '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">';
                } else {
                    $checkbox = '<a href="javascript:;" data-toggle="tooltip" data-placement="right" data-toggle="tooltip" title="This is default banner so can&#39;t be deleted."><i style="color:red" class="fa fa-exclamation-triangle"></i></a>';
                }
            } else {
                if (Auth::user()->can('banners-delete')) {
                    $actions .= '<a class="without_bg_icon delete" title="Delete" data-controller="banners" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
                }
                $checkbox = '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">';
            }
        }

        if (Auth::user()->can('banners-publish')) {
            if ($value->chrPublish == 'Y') {
                $publish_action .= '<input  data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/banners" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
            } else {
                $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/banners" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
            }
        }

        // $tableName = DB::table('module')->select('varTableName')->where('id',$value->fkModuleId)->first();
        //    $pageNameData = DB::table($tableName->varTableName)->select('varTitle')->where('id',$value->fkIntPageId)->first();
        //    $pageName = $pageNameData->varTitle;
        $pageName = '';
        if ($value->varBannerType != "home_banner") {
            if ($value->modules->varTitle != 'Pages') {
                $pageName = isset($value->modules->varTitle) && strlen($value->modules->varTitle) > 0 ? $value->modules->varTitle : 'Default';
            } else {
                $pageName = isset($value->pages->varTitle) && strlen($value->pages->varTitle) > 0 ? $value->pages->varTitle : 'Default';
            }
        } else {
            $pageName = 'Home';
        }



//        if (isset($value->pages->varTitle) && strtolower($value->pages->varTitle) != 'home') {
//            if ($value->chrDefaultBanner == 'Y') {
//                $actions .= '<a class="without_bg_icon defaultBanner" data-controller="powerpanel/banners" title="' . trans("template.common.removeDefault") . '" data-value="rm-default" data-alias="' . $value->id . '"><i class="fa fa-ban" aria-hidden="true"></i></a>';
//            } else {
//                $actions .= '<a class="without_bg_icon defaultBanner" data-controller="powerpanel/banners" title="' . trans("template.common.makeDefault") . '" data-value="default" data-alias="' . $value->id . '"><i class="fa fa-check" aria-hidden="true"></i></a>';
//            }
//        }

        $image .= '<div class="text-center">';
        if (!empty($value->image)) {
            $image .= '<a href="' . resize_image::resize($value->fkIntImgId) . '" class="fancybox-buttons" data-rel="fancybox-buttons">';
            $image .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) . '" src="' . resize_image::resize($value->fkIntImgId, 50, 50) . '"/>';
            $image .= '</a>';
        } else {
            $image .= '<span class="glyphicon glyphicon-minus"></span>';
        }
        $image .= '</div>';

        // $pageName = '';
        // $pageName = isset($value->pages->varTitle) && strlen($value->pages->varTitle)>0?$value->pages->varTitle:'Default';


        if ($value->varBannerType == 'home_banner') {
            $banner_type = 'Home Banner';
        } else {
            $banner_type = 'Inner Banner';
        }

        if (Auth::user()->can('banners-edit')) {
            $title = '<a title="Edit" href="' . route('powerpanel.banners.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
        } else {
            $title = $value->varTitle;
        }

        $records = array(
            $checkbox,
            $title,
            $image,
            $banner_type,
            $pageName,
            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				' . $value->intDisplayOrder .
            ' <a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
            $publish_action,
            $actions,
            $value->intDisplayOrder
        );
        return $records;
    }

    /**
     * This method handels logs old records
     * @param  	$data
     * @return  order
     * @since   2017-07-21
     * @author  NetQuick
     */
    public function recordHistory($data = false) {

        $banner_type = NULL;
        if ($data->varBannerType == 'home_banner') {
            $banner_type = 'Home Banner';
        } else {
            $banner_type = 'Inner Banner';
        }
        $bannerVersion = ($data->varBannerVersion == "vid_banner") ? "Video Banner" : "Image Banner";
        if ($data->varBannerVersion == "vid_banner" && $data->fkIntVideoId != null) {
            $videoDetail = Video::getVideoTitleById($data->fkIntVideoId);
            $videoTitle = ($videoDetail->varVideoName != "") ? $videoDetail->varVideoName . "." . $videoDetail->varVideoExtension : '-';
        } else {
            $videoTitle = "-";
        }

        $pageTitle = 'Default';
        if (strlen($data->fkIntPageId) > 0) {
            $pageDetail = CmsPage::getPageTitleById($data->fkIntPageId);
            $pageTitle = $pageDetail->varTitle;
        }

        $returnHtml = '';
        $returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>' . trans("template.common.title") . '</th>
								<th>' . trans("template.bannerModule.bannerType") . '</th>
								<th>' . trans("template.bannerModule.page") . '</th>
								<th>' . trans("template.common.image") . '</th>
								<th>' . trans("template.bannerModule.version") . '</th>
								<th>' . trans("template.common.video") . '</th>
								<th>' . trans("template.common.description") . '</th>
								<th>' . trans("template.common.displayorder") . '</th>
								<th>' . trans("template.common.defaultbanner") . '</th>
								<th>' . trans("template.common.publish") . '</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>' . $data->varTitle . '</td>
								<td>' . $banner_type . '</td>
								<td>' . $pageTitle . '</td>';
        if ($data->fkIntImgId > 0) {
            $returnHtml .= '<td>' . '<img height="50" width="50" src="' . resize_image::resize($data->fkIntImgId) . '" />' . '</td>';
        } else {
            $returnHtml .= '<td>-</td>';
        }
        $returnHtml .= '<td>' . $bannerVersion . '</td>
								<td>' . $videoTitle . '</td> 
								<td>' . $data->txtDescription . '</td>
								<td>' . ($data->intDisplayOrder) . '</td>
								<td>' . $data->chrDefaultBanner . '</td>
								<td>' . $data->chrPublish . '</td>
							</tr>
						</tbody>
					</table>';

        return $returnHtml;
    }

    public static function flushCache() {
        Cache::tags('Banner')->flush();
    }

}
