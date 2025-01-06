<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use App\Pagehit;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use App\Modules;

class TestimonialsF extends Model {

    protected $table = 'testimonials';
    protected $fillable = [
        'id',
        'intAliasId',
        'fkIntImgId',
        'fkIntVideoId',
        'varTitle',
        'txtClientUrl',
        'txtShortDescription',
        'txtDescription',
        'intDisplayOrder',
        'chrPublish',
        'chrDelete',
        'varMetaTitle',
        'varMetaKeyword',
        'varMetaDescription',
        'varIpAddress',
        'chrDisplayonhomepage',
    ];

    /**
     * This method handels retrival of front blog detail
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
   /* public static function getRecordIdByAliasID($aliasID) {
        $response = false;
        $response = Cache::tags(['News'])->get('getNewsRecordIdByAliasID_' . $aliasID);
        if (empty($response)) {
            $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
            Cache::tags(['News'])->forever('getNewsRecordIdByAliasID_' . $aliasID, $response);
        }
        return $response;
    }*/

    /**
     * This method handels retrival of front service list
     * @return  Object
     * @since   2017-10-14
     * @author  NetQuick
     */
    public static function getFrontList($filterArr = false, $page = 1 , $home = false) {
        $response = false;
        $moduleFields = ['id', 'varTitle', 'fkIntImgId','txtClientUrl','varRatings','fkIntVideoId', 'intAliasId', 'txtShortDescription', 'txtDescription'];
        $aliasFields = ['id', 'varAlias'];
        $response = Cache::tags(['TestimonialsF'])->get('getFrontCasestudyList_' . $page);
        $filterArr = [
            'orderByFieldName' => 'intDisplayOrder',
            'orderTypeAscOrDesc' => 'DESC',
        ];
        if (empty($response)) {
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->filter($filterArr);
                    if (!empty($home) && $home == "Y") {
                        $response = $response->CheckDisplayonhomepage($home);
                    }
                    $response = $response->paginate(9);
            Cache::tags(['TestimonialsF'])->forever('getFrontCasestudyList_' . $page, $response);
        }
        return $response;
    }



    /**
     * This method handels retrival of front latest news list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getLatestList($id = false) {
        $response = false;
        $moduleFields = ['id', 'varTitle', 'txtDescription','txtClientUrl', 'fkIntImgId','fkIntVideoId', 'intAliasId'];
        $aliasFields = ['id', 'varAlias'];
        $filterArr = [
        'orderByFieldName' => 'intDisplayOrder',
        'orderTypeAscOrDesc' => 'ASC',
        ];
        $response = Cache::tags(['TestimonialsF'])->get('getFrontLatestCasestudyList_' . $id);

        if (empty($response)) {
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->latest($id)
                    ->take(5)
                    ->get();
            Cache::tags(['TestimonialsF'])->forever('getFrontLatestCasestudyList_' . $id, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front news detail
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontDetail($id) {
        $response = false;
        $moduleFields = ['id', 'varTitle','txtClientUrl', 'fkIntImgId','fkIntVideoId', 'intAliasId', 'txtDescription','txtShortDescription'];
        $aliasFields = ['id', 'varAlias'];

        $response = Cache::tags(['TestimonialsF'])->get('getFrontCasestudyDetail_' . $id);
        if (empty($response)) {
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->checkAliasId($id)
                    ->first();
            Cache::tags(['TestimonialsF'])->forever('getFrontCasestudyDetail_' . $id, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of record count based on category
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
   /* public static function getCountById($categoryId = null) {
        $response = false;
        $moduleFields = ['id'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->checkCategoryId($categoryId)
                ->deleted()
                ->count();
        return $response;
    }*/

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
   /* public static function getRecordList($filterArr = false) {
        $response = false;
        $moduleFields = [
            'id',
            'fkIntImgId',
            'varExternalLink',
            'chrPublish',
            'varTitle',
            'dtDateTime',
            'txtCategories',
            'txtDescription',
            'intDisplayOrder',
        ];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->deleted()
                ->filter($filterArr)
                ->get();
        return $response;
    }
*/
    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    /*public static function getRecordById($id = false) {
        $response = false;
        $moduleFields = [
            'id',
            'intAliasId',
            'varTitle',
            'fkIntImgId',
            'fkIntVideoId',
            'dtDateTime',
            'txtCategories',
            'varExternalLink',
            'intDisplayOrder',
            'txtDescription',
            'txtShortDescription',
            'varMetaTitle',
            'varMetaKeyword',
            'varMetaDescription',
            'chrPublish'];
        $aliasFields = ['id', 'varAlias'];
        $videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
        $response = Self::getPowerPanelRecords($moduleFields, $aliasFields, $videoFields)
                ->deleted()
                ->checkRecordId($id)
                ->first();
        return $response;
    }*/

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    protected static $fetchedOrder = [];
    protected static $fetchedOrderObj = null;

    /*public static function getRecordByOrder($order = false) {
        $response = false;
        $moduleFields = [
            'id',
            'intDisplayOrder',
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
*/
    public static function getTestimonialsId($id) {
        $response = false;
        $moduleFields = ['id'];
        $response = Self::select($moduleFields)
                ->deleted()
                ->publish()
                ->where('intAliasId', $id)
                ->first();
        return $response;
    }

    #Database Configurations========================================
    /**
     * This method handels retrival of news records old version *=Delete it afterwards=*
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */

   /* public static function getRecords() {
        $response = false;
        $data = ['image', 'alias', 'newsCategory'];
        if (count($data) > 0) {
            $response = Self::with($data);
        }
        return $response;
    }
*/
    /**
     * This method handels retrival of news records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($casestudyFields = false, $aliasFields = false) {
        $data = [
            'alias' => function ($query) use ($aliasFields) {
        $query->select($aliasFields);
    },
        ];
        return self::select($casestudyFields)->with($data);
    }

    /**
     * This method handels retrival of news records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
   /* public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $imageFields = false) {

        $data = [];
        $response = false;

        $response = self::select($moduleFields);
        if ($imageFields != false) {
            $data['image'] = function ($query) use ($imageFields) {
                $query->select($imageFields);
            };
        }
        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields) {
                $query->select($aliasFields)->checkModuleCode();
            };
        }
        
        if (count($data) > 0) {
            $response = $response->with($data);
        }
        return $response;
    }*/

    /**
     * This method handels retrival of record by id for Log Manage
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
   /* public static function getRecordForLogById($id) {
        $response = false;
        $moduleFields = ['id',
            'varTitle',
            'fkIntImgId',
            'dtDateTime',
            'txtCategories',
            'varExternalLink',
            'intDisplayOrder',
            'txtDescription',
            'txtShortDescription',
            'varMetaTitle',
            'varMetaKeyword',
            'varMetaDescription',
            'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }
*/
    /**
     * This method handels retrival of front latest Show list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
   /* public static function getFeaturedList($limit = 10) {
        $response = false;
        $response = Cache::tags(['News'])->get('getNewsFeaturedList');
        if (empty($response)) {
            $moduleFields = ['varTitle', 'fkIntImgId', 'txtShortDescription', 'txtDescription', 'intAliasId', 'dtDateTime', 'created_at'];
            $aliasFields = ['id', 'varAlias'];
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->take($limit)
                    ->get();
            Cache::tags(['News'])->forever('getNewsFeaturedList', $response);
        }
        return $response;
    }
*/
    /**
     * This method handels alias relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function alias() {
        return $this->belongsTo('App\Alias', 'intAliasId', 'id');
    }

    /**
     * This method handels image relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function image() {
        return $this->belongsTo('App\Image', 'fkIntImgId', 'id');
    }

    /**
     * This method handels video relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function video() {
        return $this->belongsTo('App\Video', 'fkIntVideoId', 'id');
    }

    /**
     * This method handels news category relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
   /* public function newsCategory() {
        return $this->belongsTo('App\NewsCategory', 'intCategoryId', 'id');
    }*/

    /**
     * This method handels alias id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckAliasId($query, $id) {
        return $query->where('intAliasId', $id);
    }

    /**
     * This method handels Check Display on homepage scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckDisplayonhomepage($query,$home) {
        // echo '<pre>';print_r($home);exit;
        if (isset($home)) {
            return $query->where(['chrDisplayonhomepage' => $home]);
        }
    }

    /**
     * This method handels record id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckRecordId($query, $id) {
        return $query->where('id', $id);
    }

    /**
     * This method handels category id scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
   /* public function scopeCheckCategoryId($query, $id) {
        return $query->where('txtCategories', 'like', '%' . '"' . $id . '"' . '%');
    }*/

    /**
     * This method handels order scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeOrderCheck($query, $order) {
        return $query->where('intDisplayOrder', $order);
    }

    /**
     * This method handels publish scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopePublish($query) {
        return $query->where(['chrPublish' => 'Y']);
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeDeleted($query) {
        return $query->where(['chrDelete' => 'N']);
    }

    /**
     * This method handels Popular Event scope
     * @return  Object
     * @since   2016-08-30
     * @author  NetQuick
     */
    /*public function scopeLatest($query, $id = false) {
        $response = false;
        $response = $query->groupBy('id')->orderBy('dtDateTime', 'desc');
        if ($id > 0) {
            $response = $response->where('id', '!=', $id);
            //->whereRaw('dtDateTime > DATE_SUB(NOW(), INTERVAL 7 DAY)')
            //->whereRaw('dtDateTime <= NOW()');
        }

        return $response;
    }*/

    /**
     * This method handels front filter scope
     * @return  Object
     * @since   2016-08-30
     * @author  NetQuick
     */
  /*  public function scopeFrontFilter($query, $id = false, $range = false) {
        if ($range != false) {
            if ($range[0] != false && $range[1] != false) {
                $query->whereBetween('dtDateTime', $range);
            }
        }
        if ($id != false) {
            return $query->where('txtCategories', 'like', '%' . '"' . $id . '"' . '%');
        }
        return $query;
    }*/

    public static function PageHits($id) {
        $aliasID = null;
        $sever_info = Request::server('HTTP_USER_AGENT');
        $ip_address = Request::ip();
        //$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $agent = new Agent;
        $device = '';
        if ($agent->is('iPad')) {
            $device = 'Y';
        } elseif ($agent->isMobile()) {
            $device = 'N';
        } else {
            $device = 'Y';
        }

        if (isset($id)) {
            $aliasID = $id;
        }
        if (!empty($sever_info) && !empty($device) && !empty($ip_address)) {
            $moduleName = Request::segment(1);
            $moduleData = Modules::getModule($moduleName); $moduleId = $moduleData['id'];
//            $isExist = Pagehit::select('id')->where(['fkIntAliasId' => $aliasID, 'intFKModuleCode' => '19', 'varIpAddress' => $ip_address, 'isWeb' => $device])->first();
//
//            if (!isset($isExist->id)) {
                Pagehit::insert([
                    'fkIntAliasId' => $aliasID,
                    'intFKModuleCode' => $moduleId,
                    'varBrowserInfo' => $sever_info,
                    'isWeb' => $device,
                    'varIpAddress' => $ip_address,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
//            }
        }
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false) {

        $response = null;
        if (!empty($filterArr['orderByFieldName']) && !empty($filterArr['orderTypeAscOrDesc'])) {
            $query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
        } else {
            $query = $query->orderBy('varTitle', 'ASC');
        }
        if ($retunTotalRecords) {
            if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
                $data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
            }
        }
        if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
            $data = $query->where('chrPublish', $filterArr['statusFilter']);
        }
        if (!empty($filterArr['catFilter']) && $filterArr['catFilter'] != ' ') {
            $data = $query->where('txtCategories', 'like', '%' . '"' . $filterArr['catFilter'] . '"' . '%');
        }
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }
        if (!empty($filterArr['rangeFilter']['from']) && $filterArr['rangeFilter']['to']) {
            $data = $query->whereRaw('DATE(dtDateTime) BETWEEN "' . $filterArr['rangeFilter']['from'] . '" AND "' . $filterArr['rangeFilter']['to'] . '"');
        }
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

}
