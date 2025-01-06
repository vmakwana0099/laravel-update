<?php

/**
 * The Banner class handels bannner queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.1
 * @since   	2017-07-20
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cache;

class Banner extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'banner';
    protected $fillable = [
        'varTitle',
        'fkIntImgId',
        'fkIntVideoId',
        'varBannerType',
        'fkModuleId',
        'fkIntPageId',
        'txtDescription',
        'intDisplayOrder',
        'chrPublish',
        'chrDelete',
        'chr_full_width',
        'chrDefaultBanner'
    ];

    /**
     * This method handels retrival of front banner list
     * @return  Object
     * @since   2017-10-14
     * @author  NetQuick
     */
    /*public static function getHomeBannerList() {
        $response = DB::table('banner as b')
                ->select('b.*', 'i.txtImageName','i.varImageExtension')
                ->leftjoin('image as i', 'b.fkIntImgId', '=', 'i.id')
                ->where('b.varBannerType','home_banner')
                ->where('b.chrDelete','N')
                ->where('b.chrPublish','Y')
                ->orderby('b.intDisplayOrder','ASC')
                ->get();
        
//        dd($response);

        return $response;
    }*/
    
    public static function getHomeBannerList($id='',$moduleId='') {
        // echo "<pre>";print_r($id);exit;
        $response=false;
        $Query = DB::table('banner as b')
                ->select('b.*', 'i.txtImageName','i.varImageExtension', 'v.varVideoName', 'v.varVideoExtension')
                ->leftjoin('image as i', 'b.fkIntImgId', '=', 'i.id')
                ->leftjoin('video as v', 'b.fkIntVideoId', '=', 'v.id');
                if (isset($id) && !empty($id)) {
                    $Query = $Query->where('b.varBannerType','inner_banner')
                    ->where('b.fkIntPageId', $id);
                }else{
                    $Query = $Query->where('b.varBannerType','home_banner');
                }
                if(isset($moduleId) && !empty($moduleId)){
                    $Query = $Query->where('b.fkModuleId', $moduleId);
                }
                $Query = $Query->where('b.chrDelete','N')
                ->where('b.chrPublish','Y');
                $response = $Query->orderby('b.intDisplayOrder','ASC')
                ->get();
        // dd($response);
        // echo "<pre>";print_r($response);exit;
        return $response;
    }

    /**
     * This method handels retrival of front banner list
     * @return  Object
     * @since   2017-10-14
     * @author  NetQuick
     */
    public static function getDefaultBannerList() {
        $response = false;
        $response = Cache::tags(['Banner'])->get('getDefaultBannerList');
        if (empty($response)) {
            $moduleFields = ['fkIntImgId', 'varTitle', 'txtDescription'];
            $response = Self::getFrontRecords($moduleFields)
                    ->checkDefaultBanner()
                    ->displayOrderBy('ASC')
                    ->deleted()
                    ->publish()
                    ->get();
            Cache::tags(['Banner'])->forever('getDefaultBannerList', $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front banner list
     * @return  Object
     * @since   2017-10-14
     * @author  NetQuick
     */
    public static function getInnerBannerList($pageId = false, $moduleId = false) {
        
        $response = false;
        $cacheKey = 'innerBanner_Default';
        $moduleFields = ['varTitle', 'fkIntImgId', 'txtDescription','VarButtonText1','VarButtonLink1','VarButtonText2','VarButtonLink2','varSecond_Title'];
        $Query = Self::getFrontRecords($moduleFields)
                ->deleted()
                ->publish()
                ->bannerType('inner_banner');
        if ($pageId) {
            $Query = $Query->checkByPageId($pageId);
            $cacheKey = 'innerBanner_' . $pageId;
        }
        if ($moduleId) {
            $Query = $Query->checkModuleId($moduleId);
            $cacheKey = 'innerBanner_' . $moduleId;
        }
        $response = Cache::tags(['Banner'])->get($cacheKey);
        if (empty($response)) {
            $response = $Query->get();
            Cache::tags(['Banner'])->forever($cacheKey, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of home banner record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function homeBannerCount() {
        $response = false;
        $moduleFields = ['id'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->checkHomeBannerType()
                ->deleted()
                ->count();
        return $response;
    }

    /**
     * This method handels retrival of inner banner record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function innerBannerCount() {
        $response = false;
        $moduleFields = ['id'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->CheckInnerBannerType()
                ->deleted()
                ->count();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordList($filterArr = false) {
        $response = false;
        $imageFields = false;
        $videoFields = false;
        $moduleFields = [
            'id',
            'varBannerType',
            'chrDefaultBanner',
            'chrPublish',
            'chrDefaultBanner',
            'fkIntPageId',
            'fkIntImgId',
            'fkModuleId',
            'varTitle',
            'fkIntImgId',
            'varBannerType',
            'chr_full_width',
            'intDisplayOrder'
        ];
        $pageFields = ['id', 'varTitle'];
        $mdlFields = ['id', 'varTitle'];
        $response = $response = Self::getPowerPanelRecords($moduleFields, $pageFields, $imageFields, $videoFields, $mdlFields)

                //Self::getPowerPanelRecords($moduleFields, $pageFields,$mdlFields)
                ->deleted()
                ->filter($filterArr)
                ->get();

        return $response;
    }

    /**
     * This method handels retrival of record
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordById($id = false) {
        $response = false;
        $imageFields = false;
        $moduleFields = [
            'id',
            'varTitle',
            'varBannerVersion',
            'fkModuleId',
            'fkIntImgId',
            'varBannerType',
            'fkIntVideoId',
            'txtDescription',
            'intDisplayOrder',
            'chrPublish',
            'chrDefaultBanner',
            'fkIntPageId',
            'varTagLine',
            'dasktopSourceUrl',
            'mobileSourceUrl',
            'ipadSourceUrl',
            'txt_custom_csspath',
            'txtbannerhtml',
            'varTitle_feature1',
            'varFeature1_iconclass',
            'varTitle_feature2',
            'varFeature2_iconclass',
            'varTitle_feature3',
            'varFeature3_iconclass',
            'varTitle_feature4',
            'varFeature4_iconclass',
            'VarButtonText',
            'VarButtonLink',
            'special_offerTitle',
            'special_offertext',
            'discount_percentage',
            'varSecond_Title',
            'VarButtonText',
            'VarButtonText1',
            'VarButtonLink1',
            'VarButtonText2',
            'VarButtonLink2',
            'varIcon_Class',
            'chr_full_width',
        ];
        $videoFields = [
            'id',
            'youtubeId',
            'varVideoName',
            'varVideoExtension'
        ];
        $pageFields = ['id'];
        $response = Self::getPowerPanelRecords($moduleFields, $pageFields, $imageFields, $videoFields)
                ->deleted()
                ->checkRecordId($id)
                ->first();
        return $response;
    }

    /**
     * This method handels retrival of record by id for Log Manage
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordForLogById($id) {
        $response = false;
        $moduleFields = [
            'id',
            'varTitle',
            'varBannerVersion',
            'fkModuleId',
            'fkIntImgId',
            'varBannerType',
            'fkIntVideoId',
            'txtDescription',
            'intDisplayOrder',
            'chrPublish',
            'chrDefaultBanner',
            'fkIntPageId'
        ];

        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    protected static $fetchedOrder = [];
    protected static $fetchedOrderObj = null;

    public static function getRecordByOrder($order = false) {
        $response = false;
        $moduleFields = [
            'id',
            'intDisplayOrder'
        ];
        if (!in_array($order, Self::$fetchedOrder)) {
            array_push(Self::$fetchedOrder, $order);
            Self::$fetchedOrderObj = Self::getPowerPanelRecords($moduleFields)
                    ->deleted()
                    ->orderCheck($order)
                    ->first();
        }
        $response = Self::$fetchedOrderObj;
        return $response;
    }

    /**
     * This method handels retrival of record for notification
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordNotify($id = false) {
        $response = false;
        $imageFields = false;
        $moduleFields = ['varTitle'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->deleted()
                ->checkRecordId($id)
                ->first();
        return $response;
    }

    /**
     * This method handels set/unset of default banner
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function setDefault($id = false, $flagArr = false) {
        $response = false;
        $response = Self::where('id', $id)->update($flagArr);
        return $response;
    }

    #Database Configurations========================================
    /**
     * This method handels retrival of front end records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */

    static function getFrontRecords($moduleFields = false, $imageFields = false) {
        $response = false;
        $response = self::select($moduleFields);
        return $response;
    }

    /**
     * This method handels retrival of backednd records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    static function getPowerPanelRecords($moduleFields = false, $pageFields = false, $imageFields = false, $videoFields = false, $mdlFields = false) {
        $data = [];
        $response = false;
        $response = self::select($moduleFields);
        if ($imageFields != false) {
            $data['image'] = function ($query) use ($imageFields) {
                $query->select($imageFields);
            };
        }
        if ($videoFields != false) {
            $data['video'] = function ($query) use ($videoFields) {
                $query->select($videoFields)->publish();
            };
        }
        if ($pageFields != false) {
            $data['pages'] = function ($query) use ($pageFields) {
                $query->select($pageFields);
            };
        }
        if ($mdlFields != false) {
            $data['modules'] = function ($query) use ($mdlFields) {
                $query->select($mdlFields);
            };
        }
        if (count($data) > 0) {
            $response = $response->with($data);
        }
        return $response;
    }

    /**
     * This method handels image relation
     * @return  Object
     * @since   2017-07-20
     */
    public function image() {
        $response = false;
        $response = $this->belongsTo('App\Image', 'fkIntImgId', 'id');
        return $response;
    }

    /**
     * This method handels video relation
     * @return  Object
     * @since   2017-10-04	 
     */
    public function video() {
        $response = false;
        $response = $this->belongsTo('App\Video', 'fkIntVideoId', 'id');
        return $response;
    }

    /**
     * This method handels pages relation
     * @return  Object
     * @since   2017-07-20
     */
    public function pages() {
        $response = false;
        $response = $this->belongsTo('App\CmsPage', 'fkIntPageId', 'id');
        return $response;
    }

    /**
     * This method handels pages relation
     * @return  Object
     * @since   2017-07-20
     */
    public function modules() {
        $response = false;
        $response = $this->belongsTo('App\Modules', 'fkModuleId', 'id');
        return $response;
    }

    /**
     * This method handels retrival of banners records
     * @return  Object
     * @since   2016-07-20
     */
    static function getRecords() {
        $response = false;
        $response = self::with(['image', 'pages']);
        return $response;
    }

    /**
     * This method handels record id scope
     * @return  Object
     * @since   2016-07-24
     */
    function scopeCheckRecordId($query, $id) {
        $response = false;
        $response = $query->where('id', $id);
        return $response;
    }

    function scopeCheckByPageId($query, $id) {
        $response = false;
        $response = $query->where('fkIntPageId', $id);
        return $response;
    }

    /**
     * This method handels order scope
     * @return  Object
     * @since   2016-07-20
     */
    function scopeOrderCheck($query, $order) {
        $response = false;
        $response = $query->where('intDisplayOrder', $order);
        return $response;
    }

    /**
     * This method handels publish scope
     * @return  Object
     * @since   2016-07-20
     */
    function scopePublish($query) {
        $response = false;
        $response = $query->where(['chrPublish' => 'Y']);
        return $response;
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-20
     */
    function scopeDeleted($query) {
        $response = false;
        $response = $query->where(['chrDelete' => 'N']);
        return $response;
    }

    /**
     * This method handels banner type scope
     * @return  Object
     * @since   2017-08-08
     */
    function scopeBannerType($query, $type = null) {
        $response = false;
        $response = $query->where(['varBannerType' => $type]);
        return $response;
    }

    /**
     * This method checking banner type
     * @return  Object
     * @since   2016-07-20
     */
    function scopeCheckHomeBannerType($query) {
        $response = false;
        $response = $query->where(['varBannerType' => 'home_banner']);
        return $response;
    }

    /**
     * This method checking banner type
     * @return  Object
     * @since   2016-07-14
     */
    function scopeCheckInnerBannerType($query) {
        $response = false;
        $response = $query->where(['varBannerType' => 'inner_banner']);
        return $response;
    }

    /**
     * This method checking default banner
     * @return  Object
     * @since   2016-07-14
     */
    function scopeCheckDefaultBanner($query) {
        $response = false;
        $response = $query->where(['chrDefaultBanner' => 'Y']);
        return $response;
    }

    /**
     * This method checking default banner
     * @return  Object
     * @since   2016-07-14
     */
    function scopeDisplayOrderBy($query, $orderBy) {
        $response = false;
        $response = $query->orderBy('intDisplayOrder', $orderBy);
        return $response;
    }

    function scopeCheckModuleId($query, $moduleId) {
        $response = false;
        $response = $query->where('fkModuleId', $moduleId);
        return $response;
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-14
     */
    function scopeFilter($query, $filterArr = false, $retunTotalRecords = false) {
        $response = null;
        if ($filterArr['orderByFieldName'] != null && $filterArr['orderTypeAscOrDesc'] != null) {
            $query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
        } else {
            $query = $query->orderBy('varTitle', 'ASC');
        }

        if (!$retunTotalRecords) {
            if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
                $data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
            }
        }

        if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
            $data = $query->where('chrPublish', $filterArr['statusFilter']);
        }

        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }

        if (!empty($filterArr['bannerFilter']) && $filterArr['bannerFilter'] != ' ') {
            $data = $query->where('varBannerType', '=', $filterArr['bannerFilter']);
            if ($filterArr['bannerFilter'] == 'img_banner' || $filterArr['bannerFilter'] == 'vid_banner') {
                $data = $data->orWhere('varBannerVersion', '=', $filterArr['bannerFilter']);
            }
        }

        if (!empty($filterArr['bannerFilterType']) && $filterArr['bannerFilterType'] != ' ') {
            $data = $query->where('varBannerType', $filterArr['bannerFilterType']);
        }

        if (!empty($filterArr['pageFilter']) && $filterArr['pageFilter'] != ' ') {
            $data = $query->where('fkIntPageId', '=', $filterArr['pageFilter']);
        }

        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-14
     */
    static function add_pages() {
        $response = false;
        $module_code = DB::table('modules')->where('var_module_name', '=', 'cms-page')->first();
        $response = DB::table('cms_pages')
                        ->select('cms_pages.*')
                        ->where('cms_pages.chr_delete', '=', 'N')
                        ->where('cms_pages.chr_publish', '=', 'Y')
                        ->groupBy('cms_pages.id')->get();
        return $response;
    }

}
