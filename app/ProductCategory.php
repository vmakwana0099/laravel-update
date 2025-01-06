<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Pagehit;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use Config;

class ProductCategory extends Model {

    protected $table = 'product_category';
    protected $fillable = [
        'id',
        'intAliasId',
        'varTitle',
        'txtFeaturedDescription',
        'intParentCategoryId',
        'intDisplayOrder',
        'chrPublish',
        'chrDelete',
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

    public function product() {
        $response = false;
        $response = $this->hasOne('App\Product', 'id', 'intCategoryId');
        return $response;
    }

    /**
     * This method handels sub-category relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function productCategory() {
        $response = false;
        $response = $this->hasOne('App\ProductCategory', 'id', 'intParentCategoryId');
        return $response;
    }

    /**
     * This method handels main category relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function parentCategory() {
        $response = false;
        $response = $this->belongsTo('App\ProductCategory', 'intParentCategoryId', 'id');
        return $response;
    }

    /**
     * This method handels retrival of records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getRecords($moduleId = false) {
        $response = false;
        $response = self::with([
                    'alias' => function ($query) use ($moduleId) {
                $query->checkModuleCode($moduleId);
            }, 'parentCategory']);
        return $response;
    }

    /**
     * This method handels backend records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $parentCategoryFields = false) {
        $data = [];
        $response = false;
        $response = self::select($moduleFields);
        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields) {
                $query->select($aliasFields)->checkModuleCode();
            };
        }
        if ($parentCategoryFields != false) {
            $data['parentCategory'] = function ($query) use ($parentCategoryFields) {
                $query->select($parentCategoryFields);
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
        $moduleFields = ['id', 'varTitle', 'intAliasId', 'intParentCategoryId', 'intDisplayOrder', 'txtShortDescription', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
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
        $moduleFields = ['id', 'varTitle', 'intAliasId', 'intParentCategoryId', 'intDisplayOrder', 'txtShortDescription', 'txtFeaturedDescription', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $aliasFields = ['id', 'varAlias'];
        $response = Self::getPowerPanelRecords($moduleFields, $aliasFields)->deleted()->checkRecordId($id)->first();
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
     * This method handels retrival of Parent Category record by id
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getParentCategoryNameBycatId($ids) {
        $response = false;
        $categoryFields = ['varTitle'];
        $response = Self::getPowerPanelRecords($categoryFields)->deleted()->whereIn('id', $ids)->get();
        return $response;
    }

    /**
     * This method handels retrival of Parent Category record by id
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getCategoryNameBycatIds($ids) {
        $response = false;
        $categoryFields = ['varTitle'];
        $response = Self::select($categoryFields)
                ->deleted()
                ->whereIn('id', $ids)
                ->get();
        return $response;
    }

    public static function getCatWithParent() {
        $response = false;
        $categoryFields = ['id', 'intParentCategoryId', 'varTitle'];
        $parentCategoryFields = ['id', 'varTitle'];
        $response = Self::getPowerPanelRecords($categoryFields, false, $parentCategoryFields)
                ->deleted()
                ->publish()
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of record count based on category
     * @return  Object
     * @since   2018-01-09
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

    public static function getCategoryCountById($categoryId = null, $table_name) {
        $response = false;
        $moduleFields = ['id'];
        $response = DB::table($table_name)
                ->select($moduleFields)
                ->where(['fkProductCategories' => $categoryId])
                ->where(['chrDelete' => 'N'])
                ->count();
        return $response;
    }

    public static function getHostingRecords($id) {
        $response = DB::table('products')
                ->join('product_category', 'product_category.id', '=', 'products.fkProductCategories')
                ->join('alias', 'products.intAliasId', '=', 'alias.id')
                ->join('alias as ca', 'product_category.intAliasId', '=', 'ca.id')
                ->select('products.*', 'product_category.txtDescription', 'product_category.txtShortDescription as Title', 'alias.varAlias as varAlias', 'ca.varAlias as catAlias', 'products.varListingIconClass', 'products.txtShortDescription', 'products.varTitle', 'products.varWHMCSFieldName')
                ->where(['products.fkProductCategories' => $id])
                ->where(['products.chrDelete' => 'N'])
                ->where(['products.chrPublish' => 'Y'])
                ->where(['products.chrDisplayonmenu' => 'Y'])
                ->orderBy('products.intDisplayOrder')
                ->limit(6)
                ->get();
        return $response;
    }

    public static function getFeaturesRecords($id) {
        $response = DB::table('product_features')
                ->join('product_category', 'product_category.id', '=', 'product_features.fkProductCategories')
                ->select('product_features.*', 'product_category.txtFeaturedDescription')
                ->where(['product_features.fkProductCategories' => $id])
                ->where(['product_features.chrDelete' => 'N'])
                ->where(['product_features.chrLandingPage' => 'Y'])
                ->where(['product_features.chrPublish' => 'Y'])
                ->orderBy('product_features.intDisplayOrder')
                ->limit(7)
                ->get();
        return $response;
    }

    public static function getTestimonials($id) {
        $response = DB::table('testimonials as t')
                ->select('t.varTitle', 't.txtDescription', 'i.txtImageName', 'i.varImageExtension', 't.fkIntImgId')
                ->join('image as i', 't.fkIntImgId', '=', 'i.id')
                ->join('product_category as pc', 't.fkProductCategories', '=', 'pc.id')
                ->join('products as p', 't.fkProduct', '=', 'p.id')
                ->where('t.chrDelete', 'N')
                ->where('t.fkProductCategories', $id)
                ->where('t.chrPublish', 'Y')
                ->orderby('t.dtStartDateTime', 'DESC')
                ->get();
        return $response;
    }

    public static function getProductCatData($id) {
        $response = DB::table('product_category')
                ->select(['txtFeaturedDescription', 'txtShortDescription', 'txtDescription'])
                ->where(['id' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->get();
        return $response;
    }

    public static function getFaqRecords($id) {
        $response = DB::table('faq')
                ->select(['varTitle', 'txtDescription'])
                ->where(['fkProductCategories' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrLandingPage' => 'Y'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->get();
        return $response;
    }

    public static function getFaqDomainTransfer($id) {
        $response = DB::table('faq')
                ->select(['varTitle', 'txtDescription'])
                ->where(['fkProduct' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrLandingPage' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->get();
        return $response;
    }

    public static function getFeaturedProductsRecords($id) {
        $response = DB::table('featured_products')
                ->select(['varTitle', 'varShortDescription', 'varIconClass', 'varFeature', 'varButtonName', 'varButtonLink', 'varWHMCSFieldName'])
                ->where(['fkProductCategories' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrLandingPage' => 'Y'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->limit(2)
                ->get();
        return $response;
    }

    public static function getTLDRecords() {
        $response = DB::table('tld')
                ->select(['alias.varAlias', 'alias.id', 'tld.varTitle', 'tld.varIcon', 'tld.intAliasId', 'tld.fkIntImgId', 'tld.chrIsFeatured', 'tld.varWHMCSFieldName'])
                ->join('alias', 'tld.intAliasId', '=', 'alias.id')
                ->where(['tld.chrDelete' => 'N'])
                ->where(['tld.chrPublish' => 'Y'])
                ->where(['tld.chrIsLanding' => 'Y'])
                ->orderBy('tld.intDisplayOrder')
                ->get();
        return $response;
    }

     public static function getTLDAdRecords() {
        $tldArr=['com','in','co.in','org','net','co'];

        $response = DB::table('tld')
                ->select(['alias.varAlias', 'alias.id', 'tld.varTitle', 'tld.varIcon', 'tld.intAliasId', 'tld.fkIntImgId', 'tld.chrIsFeatured', 'tld.varWHMCSFieldName'])
                ->join('alias', 'tld.intAliasId', '=', 'alias.id')
                ->where(['tld.chrDelete' => 'N'])
                ->where(['tld.chrPublish' => 'Y'])
                ->whereIn('tld.varTitle',$tldArr)
                ->orderBy('tld.intDisplayOrder')
                ->get();
        return $response;
    }
    
    public function scopeCheckCategoryId($query, $id) {
        $response = false;
        $response = $query->where('intParentCategoryId', $id);
        return $response;
    }

    /**
     * This method handels retrival of category Record
     * @return  Object
     * @since   2017-10-24
     * @author  NetQuick
     */
    public static function getCategories() {
        $response = false;
        $moduleFields = ['id', 'varTitle', 'intParentCategoryId'];
        $response = Self::select($moduleFields)
                ->deleted()
                ->publish();
        return $response;
    }

    public static function getProductCategoriesId($id) {
        $response = false;
        $moduleFields = ['id'];
        $response = Self::select($moduleFields)
                ->deleted()
                ->publish()
                ->where('intAliasId', $id)
                ->first();
        return $response;
    }

    public static function getCategoriesData($id) {
        $response = false;
        $moduleFields = ['varTitle'];
        if(!empty($id))
        { 
            $response = Self::select($moduleFields)
                ->deleted()
                ->publish()
                ->where('id', $id)
                ->first();
            }
            else{
                $response = Self::select($moduleFields)
                ->deleted()
                ->publish()
                ->first();
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
        $moduleFields = ['id', 'varTitle', 'intParentCategoryId', 'intDisplayOrder', 'txtShortDescription', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    /**
     * This method handels alias id scope
     * @return  Object
     * @since   2016-07-24
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
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckRecordId($query, $id) {
        $response = false;
        $response = $query->where('id', $id);
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
     * This method handels current id scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeNotIdCheck($query, $id) {
        $response = false;
        $response = $query->where('id', '!=', $id);
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

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false) {
        $response = null;
        if (!empty($filterArr['orderByFieldName']) && !empty($filterArr['orderTypeAscOrDesc'])) {
            $data = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
        } else {
            $data = $query->orderBy('id', 'ASC');
        }
        if (!$retunTotalRecords) {
            if (!empty($filterArr['limit']) && $filterArr['limit'] > 0) {
                $data = $query->skip($filterArr['start'])->take($filterArr['limit']);
            }
        }
        if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
            $data = $query->where('chrPublish', $filterArr['statusFilter']);
        }
        if (!empty($filterArr['searchFilter'])) {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        } else {
            $data = $query->orderBy('id', 'ASC');
        }
        if (!empty($data)) {
            $response = $data;
        }
        return $response;
    }

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
//            $isExist = Pagehit::select('id')->where(['fkIntAliasId' => $aliasID, 'intFKModuleCode' => '51', 'varIpAddress' => $ip_address, 'isWeb' => $device])->first();
//            if (!isset($isExist->id)) {
            Pagehit::insert([
                'fkIntAliasId' => $aliasID,
                'intFKModuleCode' => "51",
                'varBrowserInfo' => $sever_info,
                'isWeb' => $device,
                'varIpAddress' => $ip_address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
//            }
        }
    }


    public static function checkDomainAvailability($data) {

        $apiurl = Config::get('apiurl');
            // echo "API : ".$apiurl; exit;
            
                $url = $apiurl . "&domainname=" . $data["domainname"] . "&tlds=" . $data['tlds'];
           


        $url = str_replace("http:","https:",$url);
        // echo $url;exit;
//        return file_get_contents($url);
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        $response = curl_exec($ch);
        //echo '<pre>Response';print_r($response);exit;
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (checkDomainAvailability): ' . curl_errno($ch) . ' - ' . curl_error($ch));
            }

        curl_close($ch);
        //return file_get_contents($url);


        return $response;
    }

    public static function checkDomainAvailabilityall($data) {

        $apiurl = Config::get('apiurl');
            
                $tldlist=$data['tlds'];
        if(is_array($tldlist))
        {
                $tldlist=implode(",",$tldlist);
        }
        else
        {
            $tldlist=$tldlist;
        }

        $domainnamearray=$data['domainname'];

        if(is_array($domainnamearray))
        {   
            foreach($domainnamearray as $key=>$values)
            {
                //$tldlist=$data['tlds'];
        //$tldlist=implode(",",$tldlist);
        $url = $apiurl . "&domainname=" . $values . "&tlds=" . $tldlist;

        $url = str_replace("http:","https:",$url);
        
//        return file_get_contents($url);
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));

        $response = curl_exec($ch);
        
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (checkDomainAvailability): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }

        curl_close($ch);
         return $response;
        //return file_get_contents($url);
        }    

            //$domainname=implode(",",$domainnamearray);
        }
        else
        {
            $domainname=$domainnamearray;

            //$tldlist=$data['tlds'];
        //$tldlist=implode(",",$tldlist);
        $url = $apiurl . "&domainname=" . $domainname . "&tlds=" . $tldlist;

        $url = str_replace("http:","https:",$url);

//        return file_get_contents($url);
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));

        $response = curl_exec($ch);
        
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (checkDomainAvailability): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }

        curl_close($ch);
        //return file_get_contents($url);
        return $response;

    }

        


        
    }

    /* public static function checkDomainAvailabilitys($data) {
        
        
                
                $apiurl = Config::get('apiurl');
                $url = $apiurl . "&domainname=" . $data["domainname"] . "&tlds=" . $tldlist;
                $url = str_replace("http:","http:",$url);
                
                //return file_get_contents($url);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, 900);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
                 $response = curl_exec($ch);   
                
                echo "<pre>";print_r($response);exit;
               
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (checkDomainAvailability): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }

        curl_close($ch);
        //return file_get_contents($url);


        return $response;
    }*/

    public static function resellerclub_domain_availability($domainname, $tlds) {

        $resellerclub_link = 'https://domaincheck.httpapi.com/api/';
//        $resellerclub_apikey = 'mLgbpRFAtl1N2X0p0GjSJMmrQmSGOH9g';  for live
//        $resellerclub_id = '737693';
        $resellerclub_apikey = 'GVS2fYf6kZxTkVPBoTmFfZBuzXUo59YQ';  // for local
        $resellerclub_id = '738308';

        $i = 0;
        $url = $resellerclub_link . 'domains/available.json?auth-userid=' . $resellerclub_id . '&api-key=' . $resellerclub_apikey;
        $domainStr = '';
        if (!empty($domainname)) {
            $domainStr.= '&domain-name=' . $domainname;
        }
        if (!empty($tlds)) {
            $domainStr.= '&tlds=' . $tlds;
        }
        $url .= $domainStr;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$url. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (resellerclub_domain_availability): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }

        curl_close($ch);
        $datajson = json_decode($data, TRUE);
        return $datajson;
    }

    public static function GetCountryTLD() {
        $Country_data = DB::table('tld')
                ->select(['varTitle'])
                ->where(['chrIsCountry' => 'Y'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('id')
                ->get();
        return $Country_data;
    }

     public static function GetSuggestionTldData($paramArr=array())
     {
         $domain_type = isset($paramArr["domain_type"]) ? $paramArr["domain_type"] : '';   
         $currency = isset($paramArr["currency"]) ? $paramArr["currency"] : 'INR';

        if ($domain_type == 'both') {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(function($query) {
                        $query->where(['whmcs_tlds_price.type' => "domaintransfer"])->orWhere(['whmcs_tlds_price.type' =>"domainregister"]);
                    })
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->get();
        }

        return $response_data;
     }

    public static function GetTldData($paramArr = array()) {


        $currency = isset($paramArr["currency"]) ? $paramArr["currency"] : 'INR';
        $Tld = isset($paramArr["tld"]) ? $paramArr["tld"] : '';
        $domain_type = isset($paramArr["domain_type"]) ? $paramArr["domain_type"] : '';
        $featured = isset($paramArr["featured_product"]) ? $paramArr["featured_product"] : '';
        $min_price = isset($paramArr["min"]) ? $paramArr["min"] : '0';
        $max_price = isset($paramArr["max"]) ? $paramArr["max"] : '500';
        $reg_price = isset($paramArr["regperiod"]) ? $paramArr["regperiod"] : '1';

        //Load Tlds
        $loadTlds=isset($paramArr['loadTlds']) ? $paramArr['loadTlds'] : '0';
        
        if ($domain_type == 'both' && !empty($Tld)) {

            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(function($query) {
                        $query->where(['whmcs_tlds_price.type' => "domaintransfer"])/*->orWhere(['whmcs_tlds_price.type' => 'domainregister'])*/;
                    })
                    ->whereIn('tld.varTitle', $Tld)
                    /*->where(['tld.varTitle' => $Tld])*/
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->skip($loadTlds)
                    ->take(10)
                    ->get();
        } else if ($domain_type == 'all' && !empty($Tld)) {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(function($query) {
                        $query->where(['whmcs_tlds_price.type' => "domaintransfer"])->orWhere(['whmcs_tlds_price.type' => 'domainregister'])->orWhere(['whmcs_tlds_price.type' => 'domainrenew']);
                    })
                    ->where(['tld.varTitle' => $Tld])
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->get();
        } else if ($Tld != '' && !empty($Tld)) {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => $domain_type])
                    ->where(['tld.varTitle' => $Tld])
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->get();
        } else if ($featured == 'Y') {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID', 'alias.varAlias'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->join('alias', 'tld.intAliasId', '=', 'alias.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => $domain_type])
                    ->where(['tld.chrIsFeatured' => 'Y'])
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->limit(9)
                    ->get();
        } else if (!empty($min_price) && !empty($max_price) && !empty($reg_price)) {
            $reg_price_field = "whmcs_tlds_price.Price" . $reg_price;
            $response_data = DB::table('tld')
                    ->select(['tld.varTitle', $reg_price_field])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->join('alias', 'tld.intAliasId', '=', 'alias.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => $domain_type])
                    ->whereBetween($reg_price_field, [$min_price, $max_price])
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->get();
        } else {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID','tld.varCategory','tld.varCountryName'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => $domain_type])
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->get();
        }
//        dd($response_data);
        return $response_data;
    }

    public static function GetDomainPricing($currency, $Tld = '') {  //delete thid function if no any more require
        if ($Tld != '' && !empty($Tld)) {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.Price1', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => 'domaintransfer'])
                    ->where(['tld.varTitle' => $Tld])
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->get();
        } else {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.Price1', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => 'domaintransfer'])
                    ->where(['tld.chrDelete' => 'N'])
                    ->where(['tld.chrPublish' => 'Y'])
                    ->orderBy('tld.id')
                    ->get();
        }
        return $response_data;
    }

    /*public static function GetTldCategoryData() {
        $result = DB::table('tld as t')
                        ->select(['t.varTitle', 't.chrIsCountry', 't.id as Tld_ID', 't.varCountryName as country', 'tc.varTitle as category'])
                        ->leftJoin('tld_category as tc', function ($join) {
                            $join->on('tc.id', '=', 't.varCategory')
//                            $join->on('FIND_IN_SET(tc.id, t.varCategory)')
                            ->where(['t.chrDelete' => 'N'])
                            ->where(['t.chrPublish' => 'Y']);
                        })->orderBy('tc.id', 'asc')->get();
                        //echo DB::last_query();exit;
        return $result;
    }*/
     public static function GetTldCategoryData() {
        return DB::table('tld_category as t')
            ->select(['t.varTitle', 't.id'])
            ->where(['t.chrDelete' => 'N'])
            ->where(['t.chrPublish' => 'Y'])
            ->orderBy('t.intDisplayOrder', 'asc')->get();
                        
    }

    public static function getdeals() {
        $response_data = DB::table('deals')
                        ->select(['varTitle', 'id as deals_id', 'fkdealscategory_id as did', 'fkdealtype_id as type', 'fkProductCategories as cid', 'fkProduct as pid'])
                        ->where(['chrDelete' => 'N', 'chrPublish' => 'Y'])->inRandomOrder()->first();
        return $response_data;
    }

    public static function getdealsdata($deals_param) {


        $p_id = explode(",", $deals_param["prod_id"]);

        $deals_id = $deals_param["deals_id"];
        $deals_type = $deals_param["deals_type"];
        $deals_category = $deals_param["deals_cat"];
        $prod_cat_id = $deals_param["prod_cat_id"];
        $Product_id = $p_id[0];

        $response_data = DB::table('deals as d')
                        ->select(['p.varTitle', 'p.varListingIconClass as icon'])
                        ->leftjoin('deals_category as dc', 'd.fkdealscategory_id', '=', 'dc.id')
                        ->leftjoin('deals_type as dt', 'd.fkdealtype_id', '=', 'dt.id')
                        ->leftjoin('product_category as pc', 'd.fkProductCategories', '=', 'pc.id')
                        ->leftJoin('products as p', function ($join) {
                            $join->on('d.fkProduct', '=', 'p.id')
                            ->where(['p.chrDelete' => 'N'])
                            ->where(['p.chrPublish' => 'Y']);
                        })->where(['d.chrDelete' => 'N', 'd.chrPublish' => 'Y', 'p.id' => $Product_id])->first();
        return $response_data;
    }

    public static function getproductprice($param, $curr) {
        $where_field = $param . "_STARTER_PRICE_1";
        $response_data = DB::table('whmcs_prices')
                ->select(["$curr as price"])
                ->where(['fieldName' => $where_field])
                ->first();
        return $response_data;
    }

    public static function insertenquirydata($data) {
        DB::table('domain_inquiry')->insert($data);
    }
    
    // vk 15/10/2019
    public static function getWebHostingRecords($id) {

        $response = DB::table('product_category')
                ->select('*')
                ->where(['product_category.id' => $id])
                ->limit(6)
                ->get();

        return $response;
    }
    // end

}
