<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;
use App\Pagehit;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;

class Tld extends Model {

    protected $table = 'tld';
    protected $fillable = [
        'id',
        'varTitle',
        'intAliasId',
        'varIcon',
        'varCountryName',
        'varOffer',
        'fkIntImgId',
        'chrIsFeatured',
        'chrIsLanding',
        'chrIsCountry',
        'chrIsNewTld',
        'intDisplayOrder',
        'txtShortDescription',
        'txtDescription',
        'chrDelete',
        'chrPublish',
        'created_at',
        'updated_at',
    ];

    /**
     * This method handels retrival of front blog detail
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getRecordIdByAliasID($aliasID) {
        $response = false;
        $response = Cache::tags(['Tld'])->get('getTldRecordIdByAliasID_' . $aliasID);
        if (empty($response)) {
            $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
            Cache::tags(['Tld'])->forever('getTldRecordIdByAliasID_' . $aliasID, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front tld list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontList($term = false, $page = false) {
        $response = false;
        $aliasFields = ['id', 'varAlias'];
        $tldFields = [
            'varTitle',
            'fkIntImgId',
            'intAliasId',
            'varIcon',
            'varCountryName',
            'varOffer',
            'varCategory',
            'txtShortDescription',
            'txtDescription'];
        $response = Cache::tags(['Tld'])->get('getFrontTldList_' . $page);
        if (empty($response)) {
            $response = Self::getFrontRecords($tldFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->frontFilter($term)
                    ->paginate(9);
            Cache::tags(['Tld'])->forever('getFrontTldList_' . $page, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front latest tld list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getLatestList() {
        $response = false;
        $aliasFields = ['id', 'varAlias'];
        $tldFields = [
            'varTitle',
            'fkIntImgId',
            'intAliasId',
            'varIcon',
            'varCountryName',
            'varOffer',
            'varCategory',
            'txtShortDescription',
            'txtDescription'];
        $response = Cache::tags(['Tld'])->get('getLatestTldList');
        if (empty($response)) {
            $response = Self::getFrontRecords($tldFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->latest()
                    ->take(5)
                    ->get();
            Cache::tags(['Tld'])->forever('getLatestTldList', $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front tld detail
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */

    /**
     * This method handels alias relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function alias() {
        $response = false;
        $response = $this->belongsTo('App\Alias', 'intAliasId', 'id');
        return $response;
    }

    /**
     * This method handels image relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function image() {
        $response = false;
        $response = $this->belongsTo('App\Image', 'fkIntImgId', 'id');
        return $response;
    }

    /**
     * This method handels alias relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getRecords() {
        $response = false;
        $response = self::with(['alias' => function ($query) {
                        $query->checkModuleCode();
                    }, 'image']);
        return $response;
    }

    /**
     * This method handels retrival of tld records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($tldFields = false, $aliasFields = false) {
        $response = false;
        $data = [
            'alias' => function ($query) use ($aliasFields) {
                $query->select($aliasFields);
            },
        ];
        $response = self::select($tldFields)->with($data);
        return $response;
    }

    /**
     * This method handels backend records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $imageFields = false) {
        $data = [];
        $response = false;
        $response = self::select($moduleFields);
        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields) {
                $query->select($aliasFields)->checkModuleCode();
            };
        }
        if ($imageFields != false) {
            $data['image'] = function ($query) use ($imageFields) {
                $query->select($imageFields);
            };
        }

        if (count($data) > 0) {
            $response = $response->with($data);
        }
        return $response;
    }

    /**
     * This method handels retrival of backend record list
     * @return  Object
     * @since   2017-10-24
     * @author  NetQuick
     */
    public static function getRecordList($filterArr = false) {
        $response = false;
        $moduleFields = ['id', 'intAliasId', 'varTitle', 'chrIsFeatured', 'chrIsLanding', 'chrIsCountry', 'chrIsNewTld','fkIntImgId', 'intDisplayOrder','varCategory', 'txtShortDescription', 'txtDescription', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->deleted()
                ->filter($filterArr)
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of record by id
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordById($id) {
        $response = false;
        $moduleFields = ['id', 'intAliasId', 'varTitle', 'varIcon','varCountryName', 'varOffer','fkIntImgId', 'intDisplayOrder','varCategory', 'txtShortDescription', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrIsLanding', 'chrIsCountry', 'chrIsNewTld','chrPublish', 'chrIsFeatured'];
        $aliasFields = ['id', 'varAlias'];
        $imageFields = ['id', 'txtImageName', 'varImageExtension'];
        $response = Self::getPowerPanelRecords($moduleFields, $aliasFields, $imageFields)->deleted()->checkRecordId($id)->first();
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
        $moduleFields = ['id', 'intAliasId', 'varTitle', 'varIcon', 'varCountryName','varOffer','fkIntImgId', 'intDisplayOrder','varCategory', 'txtShortDescription', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    public static function getTLD() {
        $response = false;
        $response = DB::table('tld as TLD')
                ->join('whmcs_tlds_price as Price', 'TLD.id', '=', 'Price.fk_tldname')
                ->join('alias as AL', 'TLD.intAliasId', '=', 'AL.id')
                ->select('TLD.id', 'TLD.varTitle', 'Price.type', 'Price.currency', 'Price.Price1', 'AL.varAlias', 'TLD.varCategory')
                ->where('TLD.chrDelete', 'N')
                ->where('TLD.chrPublish', 'Y')
                ->orderBy('TLD.intDisplayOrder', 'asc')
                ->paginate(90);
        return $response;
    }
    
    
     public static function getTLDFeatured() {
        $response = false;
        $response = DB::table('tld as TLD')
                ->join('whmcs_tlds_price as Price', 'TLD.id', '=', 'Price.fk_tldname')
                ->join('alias as AL', 'TLD.intAliasId', '=', 'AL.id')
                ->select('TLD.id', 'TLD.varTitle', 'Price.type', 'Price.currency', 'Price.Price1', 'AL.varAlias','TLD.varOffer')
                ->where('TLD.chrIsFeatured', 'Y')
                ->where('TLD.chrDelete', 'N')
                ->where('TLD.chrPublish', 'Y')
                ->orderBy('TLD.intDisplayOrder', 'asc')
                ->get();
        return $response;
    }
    public static function getTLDOffer() {
        $response = false;
        $response = DB::table('tld as TLD')
                ->join('whmcs_tlds_price as Price', 'TLD.id', '=', 'Price.fk_tldname')
                ->join('alias as AL', 'TLD.intAliasId', '=', 'AL.id')
                ->select('TLD.id','TLD.chrIsoffertld','TLD.varTitle', 'Price.type', 'Price.currency', 'Price.Price1', 'AL.varAlias','TLD.varOffer','Price.offerPrice')
                ->where('TLD.chrIsoffertld', 'Y')
                ->where('TLD.chrDelete', 'N')
                ->where('TLD.chrPublish', 'Y')
                ->orderBy('TLD.intDisplayOrder', 'asc')
                ->get();
        return $response;
    }
     public static function getTLDCatName($id) {
        $response = false;
        $response = DB::table('tld_category')
                ->select('id', 'varTitle')
                ->where('chrDelete', 'N')
                ->where('chrPublish', 'Y')
                ->whereIn('id', explode(',',$id))
                ->orderBy('intDisplayOrder', 'asc')
                ->get();
        return $response;
    }
    
    public static function getTLDNew(){
        $response = false;
        $response = DB::table('tld as TLD')
                ->join('whmcs_tlds_price as Price', 'TLD.id', '=', 'Price.fk_tldname')
                ->join('alias as AL', 'TLD.intAliasId', '=', 'AL.id')
                ->select('TLD.id', 'TLD.varTitle', 'Price.type', 'Price.currency', 'Price.Price1', 'AL.varAlias', 'TLD.varCategory')
                ->where('TLD.chrDelete', 'N')
                ->where('TLD.chrPublish', 'Y')
                ->where('TLD.chrIsNewTld', 'Y')
                ->orderBy('TLD.intDisplayOrder', 'asc')
                ->paginate(90);
        return $response;
    }

   
    public static function getTLDFeaturedNew() {
        $response = false;
        $response = DB::table('tld as TLD')
                ->join('whmcs_tlds_price as Price', 'TLD.id', '=', 'Price.fk_tldname')
                ->join('alias as AL', 'TLD.intAliasId', '=', 'AL.id')
                ->select('TLD.id', 'TLD.varTitle', 'Price.type', 'Price.currency', 'Price.Price1', 'AL.varAlias','TLD.varOffer')
                ->where('TLD.chrIsFeatured', 'Y')
                ->where('TLD.chrDelete', 'N')
                ->where('TLD.chrPublish', 'Y')
                ->where('TLD.chrIsNewTld', 'Y')
                ->orderBy('TLD.intDisplayOrder', 'asc')
                ->get();
        return $response;
    }
   
    public static function getTLDCatNameNew($id) {
        $response = false;
        $response = DB::table('tld_category')
                ->select('id', 'varTitle')
                ->where('chrDelete', 'N')
                ->where('chrPublish', 'Y')
                ->whereIn('id', explode(',',$id))
                ->orderBy('intDisplayOrder', 'asc')
                ->get();
        return $response;
    }
    

    public static function getTLDFeaturedDetail() {
        $response = false;
        $response = DB::table('tld as TLD')
                ->join('alias as AL', 'TLD.intAliasId', '=', 'AL.id')
                ->select('TLD.id', 'TLD.varTitle', 'AL.varAlias')
                ->where('TLD.chrIsFeatured', 'Y')
                ->where('TLD.chrDelete', 'N')
                ->where('TLD.chrPublish', 'Y')
                ->orderBy('TLD.intDisplayOrder', 'asc')
                ->limit(6)
                ->get();
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

    /**
     * This method handels retrival of backend record list
     * @return  Object
     * @since   2017-10-24
     * @author  NetQuick
     */
//    public static function getFrontDetail_old($id) {
//        $response = false;
//        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'varIcon', 'intAliasId', 'txtDescription'];
//        $aliasFields = ['id', 'varAlias'];
//        $response = Cache::tags(['Tld'])->get('getFrontNewsDetail_' . $id);
//        if (empty($response)) {
//            $response = Self::getFrontRecords($moduleFields, $aliasFields)
//                    ->deleted()
//                    ->checkAliasId($id)
//                    ->first();
//            Cache::tags(['Tld'])->forever('getFrontNewsDetail_' . $id, $response);
//        }
//        return $response;
//    }

    public static function getFrontDetail($id) {
        $response = false;
        $response = DB::table('tld')
                ->select('alias.varAlias', 'alias.id', 'tld.id', 'tld.varTitle', 'tld.fkIntImgId', 'tld.varIcon', 'tld.intAliasId', 'tld.txtDescription', 'tld.txtShortDescription')
                ->join('alias', 'tld.intAliasId', '=', 'alias.id')
                ->where('tld.chrDelete', 'N')
                ->where('tld.chrPublish', 'Y')
                ->where('tld.id', $id)
                ->first();
        return $response;
    }

    public static function getPriceDetail($id) {
        $response = false;
        $response = DB::table('whmcs_tlds_price')
                ->select('Price1', 'currency')
                ->where('type', 'domainregister')
                ->where('fk_tldname', $id)
                ->get();
        return $response;
    }

    public static function getTLDCat($moduleFields) {
        $response = DB::table('tld_category')
                ->select($moduleFields)
                ->where('chrPublish', 'Y')
                ->where('chrDelete', 'N')
                ->get();
        return $response;
    }

    public static function PageHitsTLD($id) {
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
//            $isExist = Pagehit::select('id')->where(['fkIntAliasId' => $aliasID, 'intFKModuleCode' => '53', 'varIpAddress' => $ip_address, 'isWeb' => $device])->first();
//
//            if (!isset($isExist->id)) {
                Pagehit::insert([
                    'fkIntAliasId' => $aliasID,
                    'intFKModuleCode' => "53",
                    'varBrowserInfo' => $sever_info,
                    'isWeb' => $device,
                    'varIpAddress' => $ip_address,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
//            }
        }
    }

    public static function getTldTitlesByIds($ids = false) {
        $response = false;
        $moduleFields = ['id', 'varTitle'];
        $query = Self::select($moduleFields)->deleted();
        if ($ids != false) {
            $query = $query->CheckRecordIds($ids);
        }
        $response = $query->orderBy('varTitle')->get();
        return $response;
    }

    /**
     * This method handels id scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeCheckAliasId($query, $id) {
        $response = false;
        $response = $query->where('intAliasId', $id);
        return $response;
    }

    /**
     * This method handels record id scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeCheckRecordId($query, $id) {
        $response = false;
        $response = $query->where('id', $id);
        return $response;
    }

    /**
     * This method handels multiple record id scope
     * @return  Object
     * @since   2017-08-01
     * @author  NetQuick
     */
    public function scopeCheckRecordIds($query, $ids) {
        $response = false;
        $response = $query->whereIn('id', $ids);
        return $response;
    }

    /**
     * This method handels order scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeOrderCheck($query, $order) {
        $response = false;
        $response = $query->where('intDisplayOrder', $order);
        return $response;
    }

    /**
     * This method handels publish scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopePublish($query) {
        $response = false;
        $response = $query->where(['chrPublish' => 'Y']);
        return $response;
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeDeleted($query) {
        $response = false;
        $response = $query->where(['chrDelete' => 'N']);
        return $response;
    }

    public function scopeDisplayOrderBy($query, $orderBy) {
        $response = false;
        $response = $query->orderBy('intDisplayOrder', $orderBy);
        return $response;
    }

    /**
     * This method handels Latest scope
     * @return  Object
     * @since   2016-08-30
     * @author  NetQuick
     */
    public function scopeLatest($query, $id = false) {
        $response = false;
        $response = $query
                //->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)')
                //->whereRaw('created_at <= NOW()')
                ->groupBy('id')
                ->orderBy('created_at', 'desc');
        return $response;
    }

    /**
     * This method handels front filter scope
     * @return  Object
     * @since   2016-08-30
     * @author  NetQuick
     */
    public function scopeFrontFilter($query, $term = false) {
        $response = false;
        if ($term != false) {
            $query->where('varTitle', 'like', '%' . $term . '%');
            $query->orWhere('varIcon', 'like', '%' . $term . '%');
        }
        $response = $query;
        return $response;
    }

    public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false) {
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
        if (!empty($filterArr['featuredfilter']) && $filterArr['featuredfilter'] != ' ') {
            $data = $query->where('chrIsFeatured', $filterArr['featuredfilter']);
        }
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

}
