<?php

/**
 * The Product class handels product model queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.00
 * @since        2016-07-14
 * @author    NetQuick
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;
use App\Pagehit;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;

class Testimonials extends Model {

    protected $table = 'testimonials';
    protected $fillable = [
        'id',
        'intAliasId',
        'varTitle',
        'fkIntImgId',
        'fkIntVideoId',
        'varRatings',
        'txtShortDescription',
        'txtDescription',
        'txtHomePageDesc',
        'chrDisplayonhomepage',
        'intDisplayOrder',
        'varMetaTitle',
        'varMetaKeyword',
        'varMetaDescription',
        'varIpAddress',
        'chrPublish',
        'chrDelete',
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
        $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
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
            'chrPublish',
            'fkIntImgId',
            'fkIntVideoId',
            'varTitle',
            'varRatings',
            'txtShortDescription',
            'txtHomePageDesc',
            'chrDisplayonhomepage',
            'intDisplayOrder',
        ];
        $filterArr = [
            'orderByFieldName' => 'intDisplayOrder',
            'orderTypeAscOrDesc' => 'ASC',
        ];
        $aliasFields = ['id', 'varAlias'];
        $response = Self::getPowerPanelRecords($moduleFields, $aliasFields)
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
            'intAliasId',
            'varTitle',
            'fkIntImgId',
            'fkIntVideoId',
            'txtClientUrl',
            'varRatings',
            'txtShortDescription',
            'txtDescription',
            'txtHomePageDesc',            
            'chrDisplayonhomepage',
            'intDisplayOrder',
            'varMetaTitle',
            'varMetaKeyword',
            'varMetaDescription',
            'chrPublish'];
        $aliasFields = ['id', 'varAlias'];
        $videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
        $response = Self::getPowerPanelRecords($moduleFields, $aliasFields , $videoFields)
                ->deleted()
                ->checkRecordId($id)
                ->first();
        return $response;
    }

    /**
     * This method handels retrival of front Sponsor list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
   /* public static function getFrontList($limit = 10) {
        $response = false;
        $response = Cache::tags(['Casestudy'])->get('getFrontList');
        if (empty($response)) {
            $moduleFields = [
                'id',
                'intAliasId',
                'varTitle',
                'fkIntImgId',
                'varTagLine',
                'txtShortDescription',
                'txtHomePageDesc',                
                'chrDisplayonhomepage',
                'txtDescription',
                'intDisplayOrder'
            ];
            $aliasFields = ['id', 'varAlias'];
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->displayOrderBy('DESC')
                    ->take($limit)
                    ->get();
            Cache::tags(['Casestudy'])->forever('getFrontList', $response);
        }
        return $response;
    }*/

    public static function getFrontList($filterArr = false, $page = 1) {
        $response = false;
        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'intAliasId', 'txtShortDescription', 'txtDescription'];
        $aliasFields = ['id', 'varAlias'];
        $response = Cache::tags(['Testimonials'])->get('getFrontCasestudyList_' . $page);
        if (empty($response)) {
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->filter($filterArr)
                    ->paginate(3);
            Cache::tags(['Testimonials'])->forever('getFrontCasestudyList_' . $page, $response);
        }
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
     * This method handels retrival of product records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */

    public static function getFrontRecords($moduleFields = false, $aliasFields = false, $imageFields = false) {
        $response = false;
        $data = [
            'alias' => function ($query) use ($aliasFields) {
        $query->select($aliasFields);
    },
            'image' => function ($query) use ($imageFields) {
        $query->select($imageFields);
    },
        ];
        $response = self::select($moduleFields)->with($data);
        return $response;
    }



    public static function getFrontDetail($id) {
        $response = false;
        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'intAliasId', 'txtDescription','txtShortDescription'];
        $aliasFields = ['id', 'varAlias'];
        $response = Cache::tags(['Testimonials'])->get('getFrontCasestudyDetail_' . $id);
        if (empty($response)) {
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->checkAliasId($id)
                    ->first();
            Cache::tags(['Testimonials'])->forever('getFrontCasestudyDetail_' . $id, $response);
        }
        return $response;
    }

   

    /**
     * This method handels retrival of product records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $videoFields = false, $imageFields = false) {
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
          $data['video'] = function ($query) use ($videoFields) {$query->select($videoFields)->publish();};
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
        // echo $id;exit;
        $response = false;
        $moduleFields = ['id', 'varTitle', 'fkIntImgId','fkIntVideoId', 'txtShortDescription', 'txtDescription', 'intDisplayOrder', 'chrDisplayonhomepage', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }


    public static function productFormDisplay($whmcsproid, $category, $pakagetime, $cartURL, $method, $count) {
        $returnHtml = '';
        $returnHtml .= '<form action="' . $cartURL . '" id="form_' . $category . '_' . $whmcsproid . '_' . $count . '" class="planform" name="form_' . $category . '_' . $whmcsproid . '" method="' . $method . '">';
        $csrftoken = csrf_token();
//        $returnHtml .= '<input type="hidden" id="vpsform' . $count . '" name="vpsform' . $count . '" value="' . $count . '"/>';
        $returnHtml .= '<input type="hidden" id="_token' . $count . '" name="_token" value="' . $csrftoken . '"/>';
        $returnHtml .= '<input type="hidden" id="producttype' . $count . '" name="producttype[]" value="' . $category . '"/>';
        $returnHtml .= '<input type="hidden" id="pid' . $count . '" name="pid[]" value="' . $whmcsproid . '"/>';
        $returnHtml .= '<input type="hidden" id="billingcycle' . $count . '" name="billingcycle[]" value="' . $pakagetime . '"/>';
        if(!empty($category) && ($category == 'dedicatedserver' || $category == 'hosting')){
            $returnHtml .= '<input type="hidden" id="location' . $count . '" name="location[]" value="India"/>';
        }
        if(!empty($category) && $category == 'vps'){
            $returnHtml .= '<input type="hidden" name="vps_ram[]" id="vps_ram' . $count . '" value="2">';
            $returnHtml .= '<input type="hidden" name="vps_cpu[]" id="vps_cpu' . $count . '" value="2">';
            $returnHtml .= '<input type="hidden" name="vps_hdd[]" id="vps_hdd' . $count . '" value="15">';
            $returnHtml .= '<input type="hidden" name="location[]" id="location' . $count . '" value="India"/>';
        }
        
        $buttonText = "Buy Now";
        if(!empty($category) && ($category == 'vps' || $category == 'dedicatedserver')){ $buttonText = "Configure"; }
        
        if(!empty($category) && ($category == 'vps')){ 
            $returnHtml .= "<button onclick='return calltoVPSConfiguration(this);' class='btn-primary' title='Buy Now'>".$buttonText."</button>";
        }
        else{ $returnHtml .= "<button class='btn-primary' title='Buy Now'>".$buttonText."</button>"; }
        $returnHtml .= '</form>';
        $ButtonName = 'form_' . $category . '_' . $whmcsproid;
        return $returnHtml;
    }

    /**
     * This method handels retrival of product records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getRecords() {
        return self::with(['alias' => function ($query) {
                $query->checkModuleCode();
            }, 'image']);
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
    /*public function scopeCheckCategoryId($query, $id) {
        return $query->where('fkProductCategories', $id);
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


    /*public static function getProductName($id) {
        $response = false;
        $parentCategoryFields = ['id', 'varTitle as text'];
        $response = Self::getPowerPanelRecords($parentCategoryFields)
                ->deleted()
                ->publish()
                ->CheckCategoryId($id)
                ->get();
        return $response;
    }*/

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
     * This method handels Popular Service scope
     * @return  Object
     * @since   2016-08-30
     * @author  NetQuick
     */
    public function scopeLatest($query, $id = false) {
        return $query
                        //->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)')
                        //->whereRaw('created_at <= NOW()')
                        ->groupBy('id')
                        ->orderBy('created_at', 'desc');
    }

    /**
     * This method handels featured scope
     * @return  Object
     * @since   2016-08-08
     * @author  NetQuick
     */
   /* function scopeFeatured($query, $flag = null) {
        $response = false;
        $response = $query->where(['varFeaturedProduct' => $flag]);
        return $response;
    }*/

    /**
     * This method handels orderBy scope
     * @return  Object
     * @since   2016-08-08
     * @author  NetQuick
     */
    public function scopeDisplayOrderBy($query, $orderBy) {
        $response = false;
        $response = $query->orderBy('intDisplayOrder', $orderBy);
        return $response;
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
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
        if (!empty($filterArr['catFilter']) && $filterArr['catFilter'] != ' ') {
            $data = $query->where('fkProductCategories', $filterArr['catFilter']);
        }
        if (!empty($filterArr['categoryfilter']) && $filterArr['categoryfilter'] != ' ') {
            $data = $query->where('fkProductCategories', $filterArr['categoryfilter']);
        }
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }

        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

    public static function PageHits($id) {
        $aliasID = null;
        $sever_info = Request::server('HTTP_USER_AGENT');
        $ip_address = Request::ip();
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
//            $isExist = Pagehit::select('id')->where(['fkIntAliasId' => $aliasID, 'intFKModuleCode' => '38', 'varIpAddress' => $ip_address, 'isWeb' => $device])->first();
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

}
