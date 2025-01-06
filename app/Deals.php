<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;

class Deals extends Model {

    protected $table = 'deals';
    protected $fillable = [
        'id',        
        'varTitle',
        'varTagLine',
        'varListingIcon',
        'varDealsINRPrice',
        'varDealsUSDPrice',
        'varShortDescription',        
        'varHomePageDealsContent',        
        'intDisplayOrder',
        'chrPublish',
        'chrDelete',
        'varMetaTitle',
        'varMetaKeyword',
        'varMetaDescription',
        'varIpAddress',
        'varProductFeatures'
    ];

    /**
     * This method handels retrival of front blog detail
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getRecordIdByAliasID($aliasID) {
        $response = false;
        $response = Cache::tags(['News'])->get('getNewsRecordIdByAliasID_' . $aliasID);
        if (empty($response)) {
            $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
            Cache::tags(['News'])->forever('getNewsRecordIdByAliasID_' . $aliasID, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front service list
     * @return  Object
     * @since   2017-10-14
     * @author  NetQuick
     */
    public static function getFrontList($filterArr = false, $page = 1) {
        $response = false;
        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'varShortDescription','varProductFeatures','varHomePageDealsContent','txtDescription', 'varExternalLink'];
        $aliasFields = ['id', 'varAlias'];
        $response = Cache::tags(['News'])->get('getFrontNewsList_' . $page);
        if (empty($response)) {
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->filter($filterArr)
                    ->paginate(6);
            Cache::tags(['News'])->forever('getFrontNewsList_' . $page, $response);
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
        $moduleFields = ['id', 'varTitle'];
        $aliasFields = ['id', 'varAlias'];
        $response = Cache::tags(['News'])->get('getFrontLatestNewsList_' . $id);
        if (empty($response)) {
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->latest($id)
                    ->take(5)
                    ->get();
            Cache::tags(['News'])->forever('getFrontLatestNewsList_' . $id, $response);
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
        $moduleFields = ['id', 'varTitle', 'varShortDescription','varProductFeatures', 'txtDescription','varHomePageDealsContent', 'varExternalLink'];
        $aliasFields = ['id', 'varAlias'];
        $response = Cache::tags(['News'])->get('getFrontNewsDetail_' . $id);
        if (empty($response)) {
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->checkAliasId($id)
                    ->first();
            Cache::tags(['News'])->forever('getFrontNewsDetail_' . $id, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of record count based on category
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getCountById($categoryId = null) {
        $response = false;
        $moduleFields = ['id'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->checkCategoryId($categoryId)
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
        $moduleFields = [
            'id',
            'fkdealscategory_id',
            'fkProductCategories',
            'fkProduct',
            'fkdealtype_id',
            'varTagLine',
            'varListingIcon',
            'varDealsINRPrice',
            'varDealsUSDPrice',
            'varDiscountType',
            'varHomePageDealsContent',
            'discount_percentage',
            'discount_fixed',
            'varpromo_code',
            'varpopup_title',
            'dtstart_date',
            'dtend_date',
            'chrDisplayontop',
            'varPopupTagLine',
            'varbutton_link',
            'chrPublish',
            'varTitle',
            'varShortDescription',
            'varProductFeatures',
            'intDisplayOrder',
        ];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->deleted()
                ->filter($filterArr)
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordById($id = false) {
        $response = false;
        $moduleFields = [
            'id',        
            'varTitle',
            'fkdealscategory_id',
            'fkProductCategories',
            'fkdealtype_id',
            'varTagLine',
            'varListingIcon',
            'varDealsINRPrice',
            'varDealsUSDPrice',
            'varDiscountType',
            'varHomePageDealsContent',
            'discount_percentage',
            'discount_fixed',
            'varpromo_code',
            'varpopup_title',
            'dtstart_date',
            'dtend_date',
            'chrDisplayontop',
            'varbutton_link',
            'varPopupTagLine',
            'intDisplayOrder',
            'varShortDescription',
            'varProductFeatures',
            'fkProduct',
            'chrPublish'];
        // $aliasFields = ['id', 'varAlias'];
        // $videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->deleted()
                ->checkRecordId($id)
                ->first();
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

    #Database Configurations========================================
    /**
     * This method handels retrival of news records old version *=Delete it afterwards=*
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */

    public static function getRecords() {
        $response = false;
        $data = ['image', 'alias', 'newsCategory'];
        if (count($data) > 0) {
            $response = Self::with($data);
        }
        return $response;
    }

    /**
     * This method handels retrival of news records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($newsFields = false, $aliasFields = false) {
        $data = [
            'alias' => function ($query) use ($aliasFields) {
                $query->select($aliasFields);
            },
        ];
        return self::select($newsFields)->with($data);
    }

    /**
     * This method handels retrival of news records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $videoFields = false, $imageFields = false, $categoryFields = false) {
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
        if ($videoFields != false) {
            $data['video'] = function ($query) use ($videoFields) {
                $query->select($videoFields)->publish();
            };
        }
        if ($categoryFields != false) {
            $data['newsCategory'] = function ($query) use ($categoryFields) {
                $query->select($categoryFields);
            };
        }
        if (count($data) > 0) {
            $response = $response->with($data);
        }
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
        $moduleFields = ['id',
            'varTitle',
            'fkdealscategory_id',
            'fkProductCategories',
            'fkdealtype_id',
            'varTagLine',
            'varListingIcon',
            'varDealsINRPrice',
            'varDealsUSDPrice',
            'varDiscountType',
            'discount_percentage',
            'discount_fixed',
            'varHomePageDealsContent',
            'varpromo_code',
            'varpopup_title',        
            'dtstart_date',
            'dtend_date',                
            'intDisplayOrder',
            'varShortDescription',
            'varProductFeatures',
            'chrDisplayontop',
            'varPopupTagLine',
            'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    /**
     * This method handels retrival of front latest Show list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFeaturedList($limit = 10) {
        $response = false;
        $response = Cache::tags(['News'])->get('getNewsFeaturedList');
        if (empty($response)) {
            $moduleFields = ['varTitle', 'fkIntImgId', 'varShortDescription','varProductFeatures', 'txtDescription', 'dtDateTime', 'created_at'];
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

    /**getproduct
     * This method handels news category relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getCat($moduleFields) {
         $response = DB::table('deals_category')
                ->select($moduleFields)
                ->where(['chrPublish' => 'Y'],['chrDelete' => 'N'])
                ->get();
        return $response;
    }
    public static function getDealsData() {
        $response = DB::table('deals as D')
                ->join('deals_category as DC', 'DC.id', '=', 'D.fkdealscategory_id')
                ->join('deals_type as DT', 'DT.id', '=', 'D.fkdealtype_id')
                ->select(['D.*', 'DC.varTitle as DealsCat', 'DT.varTitle as DealsType'])
                ->where(['D.chrDelete' => 'N'])
                ->where(['D.chrPublish' => 'Y'])
                ->whereDate('D.dtend_date', '>=',date('Y-m-d'))
                // ->orderBy('D.dtend_date')
                ->orderBy('D.intDisplayOrder')
                ->get();
        return $response;
    }
     public static function getFaqRecords() {
        $response = DB::table('general_faq')
                ->select(['varTitle', 'txtDescription'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->get();
        return $response;
    }
    public static function getDealsCat() {
        $response = DB::table('deals_category')
                ->select(['varTitle','id','intDisplayOrder'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->get();
        return $response;
    }
    public static function getCatType($moduleFields) {
         $response = DB::table('deals_type')
                ->select($moduleFields)
                ->where(['chrPublish' => 'Y'],['chrDelete' => 'N'])
                ->get();
//        print_r($response);
//        exit;
        return $response;
    }

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
    public function scopeCheckCategoryId($query, $id) {
        return $query->where('txtCategories', 'like', '%' . '"' . $id . '"' . '%');
    }

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
    public function scopeLatest($query, $id = false) {
        $response = false;
        $response = $query->groupBy('id')->orderBy('dtDateTime', 'desc');
        if ($id > 0) {
            $response = $response->where('id', '!=', $id);
            //->whereRaw('dtDateTime > DATE_SUB(NOW(), INTERVAL 7 DAY)')
            //->whereRaw('dtDateTime <= NOW()');
        }

        return $response;
    }

    /**
     * This method handels front filter scope
     * @return  Object
     * @since   2016-08-30
     * @author  NetQuick
     */
    public function scopeFrontFilter($query, $id = false, $range = false) {
        if ($range != false) {
            if ($range[0] != false && $range[1] != false) {
                $query->whereBetween('dtDateTime', $range);
            }
        }
        if ($id != false) {
            return $query->where('txtCategories', 'like', '%' . '"' . $id . '"' . '%');
        }
        return $query;
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
            $data = $query->where('fkProductCategories', '=', $filterArr['catFilter']);
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
