<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;
use App\TestimonialsF;

class CmsPage extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cms_page';
    protected $fillable = [
        'id',
        'intAliasId',
        'intFKModuleCode',
        'varTitle',
        'txtDescription',
        'varMetaTitle',
        'varMetaKeyword',
        'varMetaDescription',
        'chrDisplay',
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
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public static function getPageWithAlias($aliasId = false) {
//        $table_array = array("13" => "pages", "37" => "product_category",'38' => 'products');
//        $gettablename = Self::getmoduleid($aliasId);

        $response = false;
        $cmsPageFields = ['id', 'intAliasId', 'intFKModuleCode'];
        $aliasFields = ['id', 'varAlias', 'intFkModuleCode'];
        $moduleFields = ['id', 'varModuleName'];
//        foreach ($table_array as $key => $value) {
//            if (empty($gettablename)) {
//                $response = Self::getFrontPageRecord($cmsPageFields, $aliasFields, $moduleFields)->deleted()->publish()->checkAliasId($aliasId)->first();
//            } else if ($gettablename->intFkModuleCode == "13") {
        $response = Self::getFrontPageRecord($cmsPageFields, $aliasFields, $moduleFields)->deleted()->publish()->checkAliasId($aliasId)->first();
//            } else {
//                if ($gettablename->intFkModuleCode == $key) {
//                    $response = Self::getFrontOtherModuleData($gettablename->intFkModuleCode, $value, $gettablename->varAlias);
//                }
//            }
//        }
        return $response;
    }

    public static function getCategoryWithAlias() {
        $response = false;
        $response = DB::table('alias')
                ->select('varAlias')
                ->where('intFkModuleCode', "37")
                ->get();
        $result = $response->toArray();
        foreach($result as $data){
            $array[] = $data->varAlias;
        }
        return $array;
    }

    public static function getmoduleid($id) {
        $response = DB::table('alias')
                ->select('intFkModuleCode', 'varAlias')
                ->where('id', $id)
                ->first();
        return $response;
    }

    public static function getFrontOtherModuleData($module_id, $table_name, $alias) {
        $response = DB::table('alias')
                ->select('alias.id as AliasID', 'alias.varAlias', 'alias.intFKModuleCode', '' . $table_name . '.id as ProID', '' . $table_name . '.intAliasId', 'module.id', 'module.varModuleName')
                ->join($table_name, $table_name . '.intAliasId', '=', 'alias.id')
                ->join('module', 'module.id', '=', 'alias.intFkModuleCode')
                ->where($table_name . '.chrDelete', 'N')
                ->where($table_name . '.chrPublish', 'Y')
                ->where('alias.varAlias', $alias)
                ->where('alias.intFKModuleCode', $module_id)
                ->first();
//        
        $d['id'] = $response->AliasID;
        $d['varAlias'] = $response->varAlias;
        $d['intFKModuleCode'] = $response->intFKModuleCode;
        $data['alias'] = (object) $d;

        $m['id'] = $response->id;
        $m['varModuleName'] = $response->varModuleName;
        $data['modules'] = (object) $m;

        $p['id'] = $response->ProID;
        $p['intAliasId'] = $response->intAliasId;
        $data['CmsPage'] = (object) $p;

        return (object) $data;
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public static function getPageContentByPageAlias($cmsPageId) {

        $response = false;
        $response = Self::select(['txtDescription','varTitle'])->deleted()->checkAliasId($cmsPageId)->first();
        return $response;
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public static function getPageByPageId($cmsPageId) {
        $response = false;
        $response = Cache::rememberForever('getPageByPageId_' . $cmsPageId, function() use ($cmsPageId) {
                    return Self::select(['id', 'varTitle', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'])
                                    ->deleted()
                                    ->checkAliasId($cmsPageId)
                                    ->first();
                });
        return $response;
    }

    public static function getAllPageByPageId($cmsPageId) {
        $table_array = array("13" => "pages", "37" => "product_category", '38' => 'products');

        $gettablename = Self::getmoduleid($cmsPageId);
        $response = false;
        $cmsPageFields = ['id', 'intAliasId', 'intFKModuleCode'];
        $aliasFields = ['id', 'varAlias', 'intFkModuleCode'];
        $moduleFields = ['id', 'varModuleName'];
        foreach ($table_array as $key => $value) {
            if (empty($gettablename)) {
                $response = false;
                $response = Cache::rememberForever('getPageByPageId_' . $cmsPageId, function() use ($cmsPageId) {
                            return Self::select(['id', 'varTitle', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'])
                                            ->deleted()
                                            ->checkAliasId($cmsPageId)
                                            ->first();
                        });
            } else if ($gettablename->intFkModuleCode == "13") {
                $response = false;
                $response = Cache::rememberForever('getPageByPageId_' . $cmsPageId, function() use ($cmsPageId) {
                            return Self::select(['id', 'varTitle', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'])
                                            ->deleted()
                                            ->checkAliasId($cmsPageId)
                                            ->first();
                        });
            } else {
                if ($gettablename->intFkModuleCode == $key) {
                    $response = Self::getFrontOtherModuleData($gettablename->intFkModuleCode, $value, $gettablename->varAlias);
                }
            }
        }
        return $response;
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public static function getFrontPageRecord($cmsPageFields = false, $aliasFields = false, $moduleFields = false) {
        
        $data = [];
        $pageObj = Self::select($cmsPageFields);

        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields) {
                $query->select($aliasFields);
            };
        }
        if ($moduleFields != false) {
            $data['modules'] = function ($query) use ($moduleFields) {
                $query->select($moduleFields);
            };
        }
        if (count($data) > 0) {
            $pageObj = $pageObj->with($data);
        }
        return $pageObj;
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($cmsPageFields = false, $aliasFields = false, $moduleFields = false, $moduleCode = false) {
        $data = [];
        $pageObj = Self::select($cmsPageFields);
        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields, $moduleCode) {
                $query->select($aliasFields)->checkModuleCode($moduleCode);
            };
        }
        if ($moduleFields != false) {
            $data['modules'] = function ($query) use ($moduleFields) {
                $query->select($moduleFields);
            };
        }
        if (count($data) > 0) {
            $pageObj = $pageObj->with($data);
        }
        return $pageObj;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordCount($filterArr = false, $returnCounter = false) {
        $response = 0;
        $cmsPageFields = ['id'];
        $pageQuery = Self::getPowerPanelRecords($cmsPageFields);
        if ($filterArr != false) {
            $pageQuery = $pageQuery->filter($filterArr, $returnCounter);
        }
        $response = $pageQuery->deleted()->count();
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
        $cmsPageFields = ['id', 'intAliasId', 'intFKModuleCode', 'varTitle', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish', 'chrDelete'];
        $aliasFields = ['id', 'varAlias'];

        $response = Self::getPowerPanelRecords($cmsPageFields, $aliasFields)->deleted()->filter($filterArr)->get();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordsForMenu($moduleCode = false) {
        $response = false;
        $cmsPageFields = ['id', 'intAliasId', 'intFKModuleCode', 'varTitle', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish', 'chrDelete'];
        $aliasFields = ['id', 'varAlias'];
        $moduleFields = ['id', 'varModuleName'];

        $response = Self::getPowerPanelRecords($cmsPageFields, $aliasFields, $moduleFields, $moduleCode)
                ->deleted()
                ->publish()
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getPagesWithModule($moduleCode = false) {
        $response = false;
        $cmsPageFields = ['id', 'intAliasId', 'intFKModuleCode', 'varTitle', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish', 'chrDelete'];
        $moduleFields = ['id', 'varModuleName'];

        $response = Self::getPowerPanelRecords($cmsPageFields, false, $moduleFields, $moduleCode)
                ->deleted()
                ->publish()
                ->orderBy('varTitle')
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordById($id, $cmsPageFields = false, $aliasFields = false, $moduleFields = false) {
        $response = false;
        $cmsPageFields = ['id', 'intAliasId', 'intFKModuleCode', 'varTitle', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish', 'chrDelete'];
        $aliasFields = ['id', 'varAlias'];
        $moduleFields = ['id', 'varModuleName'];

        $response = Self::getPowerPanelRecords($cmsPageFields, $aliasFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    /**
     * This method handels retrival of record for delete
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordsforDeleteById($id) {
        $response = false;
        $moduleFields = ['id', 'varTitle'];
        $response = Self::getPowerPanelRecords($moduleFields)->checkRecordId($id)->first();
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
        $cmspageFields = ['id', 'intAliasId', 'intFKModuleCode', 'varTitle', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish', 'chrDelete'];
        $aliasFields = ['id', 'varAlias'];
        $moduleFields = ['id', 'varModuleName'];
        $response = Self::getPowerPanelRecords($cmspageFields, $aliasFields, $moduleFields)->deleted()->checkRecordId($id)->first();
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
     * This method handels retrival of record with id and title
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getPagesIdTitle() {
        $response = false;
        $cmsPageFields = ['id', 'varTitle'];
        $response = Self::getPowerPanelRecords($cmsPageFields)
                ->deleted()
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of record with id and title
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getHomePage() {
        $response = false;
        $cmsPageFields = ['id', 'varTitle', 'intFKModuleCode'];
        $moduleFields = ['id'];
        $response = Self::getPowerPanelRecords($cmsPageFields, false, $moduleFields)
                ->getHomePage()
                ->first();
        return $response;
    }

    /**
     * This method handels retrival of page title by page id
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getPageTitleById($id = false) {
        $response = false;
        $cmsPageFields = ['varTitle', 'intFKModuleCode'];
        $response = Self::getPowerPanelRecords($cmsPageFields)
                ->deleted()
                ->checkRecordId($id)
                ->first();
        return $response;
    }

    public static function getCmspageID($alias) {
        $data3 = DB::table('menu')
                ->select('varTitle', 'intPageId', 'txtPageUrl')
                ->where('txtPageUrl', $alias)
                ->first();

        return $data3;
    }

//                public static function getCmsPageData($cmsPageFields,$alias){
//               return   $query->select($cmsPageFields);
//               
//                }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getOptionPageList($filterArr = false) {
        $response = false;
        $cmsPageFields = ['id', 'varTitle'];
        $response = Self::getPowerPanelRecords($cmsPageFields)->pluck('varTitle', 'id');
        return $response;
    }

    /**
     * This method handels alias relation
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function alias() {
        return $this->belongsTo('App\Alias', 'intAliasId', 'id');
    }

    /**
     * This method handels module relation
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function modules() {
        return $this->belongsTo('App\Modules', 'intFKModuleCode', 'id');
    }

    /**
     * This method handels module relation
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    // public function pagehits()
    // {
    // 		return $this->belongsTo('App\Pagehit', 'intAliasId', 'fkIntAliasId');
    // }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public static function getRecords($moduleId = false) {
        return self::with(['alias' => function ($query) use ($moduleId) {
                        $query->checkModuleCode($moduleId);
                    }, 'modules']);
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
     * This method handels alias id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckModuleId($query, $id) {
        return $query->where('intFKModuleCode', $id);
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
     * This method handels order scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeOrderCheck($query, $order) {
        return $query->where('intDisplayOrder', $order);
    }

    /**
     * This method handels home page scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeGetHomePage($query) {
        return $query->where('varTitle', 'Home');
    }

    /**
     * This method handels publish scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopePublish($query) {
        return $query->where(['chrPublish' => 'Y']);
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeDeleted($query) {
        return $query->where(['chrDelete' => 'N']);
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-24
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
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }
        if (!empty($filterArr['rangeFilter']) && $filterArr['rangeFilter'] != ' ') {
            $data = $query->whereRaw('DATE(dtStartDateTime) >= DATE("' . date('Y-m-d', strtotime($filterArr['rangeFilter']['from'])) . '")  AND DATE(dtEndDateTime) <= DATE("' . date('Y-m-d', strtotime($filterArr['rangeFilter']['to'])) . '")');
        }
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

    /**
     * This method handels front search scope
     * @return  Object
     * @since   2016-08-09
     * @author  NetQuick
     */
    public function scopeFrontSearch($query, $term = '') {
        return $query->where(['varTitle', 'like', '%' . $term . '%']);
    }

    public function banners() {
        return $this->hasMany('App\Banner', 'image', 'id');
    }

    public function menu() {
        return $this->hasOne('App\Menu', 'id', 'intPageId');
    }

    public static function getHomeProducts() {
        $response = DB::table('products as p')
                ->select('p.varTitle','p.txtHomePageDesc', 'p.varTagLine', 'p.txtShortDescription', 'p.varListingIconClass', 'pc.varTitle as category', 'a.varAlias as productAlias','ca.varAlias as productCatAlias','p.varWHMCSFieldName as varWHMCSFieldName')
                ->join('product_category as pc', 'p.fkProductCategories', '=', 'pc.id')
                ->join('alias as a', 'p.intAliasId', '=', 'a.id')
                ->join('alias as ca', 'pc.intAliasId', '=', 'ca.id')
                ->where('p.chrDisplayonhomepage', 'Y')
                ->where('p.chrDelete', 'N')
                ->where('p.chrPublish', 'Y')
                ->orderby('p.intDisplayOrder', 'ASC')
                ->limit(6)
                ->get();
        return $response;
    }
    public static function getFooterProducts() {
        $response = DB::table('products as p')
                ->select('p.varTitle', 'p.varTagLine', 'p.txtShortDescription', 'p.varListingIconClass', 'pc.varTitle as category', 'a.varAlias as productAlias','ca.varAlias as productCat')
                ->join('product_category as pc', 'p.fkProductCategories', '=', 'pc.id')
                ->join('alias as a', 'p.intAliasId', '=', 'a.id')
                ->join('alias as ca', 'pc.intAliasId', '=', 'ca.id')
                ->where('p.chrDelete', 'N')
                ->where('p.chrPublish', 'Y')
                ->orderby('p.intDisplayOrder', 'ASC')
                ->limit(6)
                ->get();
        return $response;
    }

    public static function footerMenuProducts() {
        $response = DB::table('products as p')
                ->select('p.varTitle', 'pc.varTitle as category', 'a.varAlias')
                ->join('product_category as pc', 'p.fkProductCategories', '=', 'pc.id')
                ->join('alias as a', 'p.intAliasId', '=', 'a.id')
                ->where('p.chrDelete', 'N')
                ->where('p.chrPublish', 'Y')
                ->orderby('p.intDisplayOrder', 'ASC')
                ->offset(0)
                ->limit(6)
                ->get();
        return $response;
    }

    public static function getHomeNews() {

        $response = DB::table('news as n')
                ->select('n.varTitle', 'i.txtImageName', 'i.varImageExtension', 'n.fkIntImgId', 'a.varAlias')
                ->join('image as i', 'n.fkIntImgId', '=', 'i.id')
                ->join('alias as a', 'n.intAliasId', '=', 'a.id')
                ->where('n.chrDelete', 'N')
                ->where('n.chrPublish', 'Y')
                ->orderby('n.dtDateTime', 'DESC')
                ->get();

        return $response;
    }

    /*public static function getHomeTestimonials() {

        $response = DB::table('testimonials as t')
                ->select('t.varTitle', 't.txtDescription', 't.fkIntImgId')
                ->join('product_category as pc', 't.fkProductCategories', '=', 'pc.id')
                ->join('products as p', 't.fkProduct', '=', 'p.id')
                ->where('t.chrShowHomePage', 'Y')
                ->where('t.chrDelete', 'N')
                ->where('t.chrPublish', 'Y')
                ->orderby('t.dtStartDateTime', 'DESC')
                ->limit(6)
                ->get();
        return $response;
    }*/

    public static function getHomeTestimonials() {
        // $home = 'Y';
        $response = TestimonialsF::getFrontList('','','Y');
        /*echo '<pre>';print_r(count($response));exit;*/
                
        return $response;
    }

    public static function getHomecontactdata() {

        $response = DB::table('contact_info as c')
                ->select('c.varHomePageTitle', 'c.varEmail', 'c.varPhoneNo', 'c.varHomePageDescription','c.varOpenHours','c.varSchemaAddress','c.varSchemaLocality','c.varSchemaRegion','c.varSchemaPostalCode','c.varSchemaCountry')
                ->where('c.chrDelete', 'N')
                ->where('c.chrPublish', 'Y')
                ->first();
        return $response;
    }

    public static function getHometopdealsdata() {

        $now = date('Y-m-d');
        $response = DB::table('deals as d')
                ->select('d.id','d.varTitle', 'd.varTagLine', 'd.varDiscountType', 'd.discount_percentage', 'd.discount_fixed','d.varHomePageDealsContent')
                ->join('deals_category as dc', 'd.fkdealscategory_id', '=', 'dc.id')
                ->join('product_category as pc', 'd.fkProductCategories', '=', 'pc.id')
                ->join('products as p', 'd.fkProduct', '=', 'p.id')
                ->join('deals_type as dt', 'd.fkdealtype_id', '=', 'dt.id')
                ->where('d.chrDelete', 'N')
                ->where('d.chrDisplayontop', 'Y')
                ->where('d.chrPublish', 'Y')
                ->where('d.dtend_date', '>=', $now)
                ->orderby('d.id', 'DESC')
                ->first();
        return $response;
    }
    public static function MegaMenuPrice() {
        $Menu = DB::table('whmcs_prices as WP')
                 ->join('deals as D', 'WP.DealsID', '=', 'D.id')
                ->select('WP.fieldName', 'WP.DealsID','D.id','D.varTitle', 'D.varDealsINRPrice','D.varDealsUSDPrice','D.varpopup_title')
                ->where('WP.DealsID', '!=', null)
                 ->where(['D.chrDelete' => 'N'])
                ->where(['D.chrPublish' => 'Y'])
                ->get();
        return $Menu;
    }

    public static function footermenu() {
        $FooterMenu = DB::table('menu as m')
                ->select('m.varTitle', 'm.txtPageUrl')
                ->join('menu_type as mt', 'm.intPosition', '=', 'mt.id')
                ->where('m.intPosition', '2')
                ->where('m.intParentMenuId', '0')
                ->where('m.chrDelete', 'N')
                ->where('m.chrPublish', 'Y')
                ->orderby('m.intParentItemOrder', 'ASC')
                ->get();
        return $FooterMenu;
    }

    public static function sociallinks() {

        $response = DB::table('general_setting')
                        ->select('fieldValue')
                        ->whereIn('id', array(31, 34, 37, 60, 30))->get();
        return $response;
    }

    public static function getTLds() {
        $response = DB::table('tld as t')
                ->select('t.varTitle', 'a.varAlias','t.varWHMCSFieldName')
                ->join('alias as a', 't.intAliasId', '=', 'a.id')
                ->where('t.chrDelete', 'N')
                ->where('t.chrIsFeatured', 'Y')
                ->where('t.chrPublish', 'Y')
                ->orderby('t.intDisplayOrder', 'ASC')
                ->offset(0)
                ->limit(5)
                ->get();
        return $response;
    }

    public static function getSuggestedTLds($tldname) {
        $response = DB::table('tld as t')
                ->select('t.varTitle', 'a.varAlias','t.varWHMCSFieldName')
                ->join('alias as a', 't.intAliasId', '=', 'a.id')
                ->where('t.varTitle','!=',$tldname)
                ->where('t.chrDelete', 'N')
                ->where('t.chrIsFeatured', 'Y')
                ->where('t.chrPublish', 'Y')
                ->orderby('t.intDisplayOrder', 'ASC')
                ->offset(0)
                ->limit(4)
                ->get();
        return $response;
    }
    
    public static function getPageidfromaliasId($aliasId){
        $Query = DB::table('cms_page as cp')
                ->select('cp.id', 'cp.varTitle')
                ->where('cp.chrDelete', 'N')
                ->where('cp.chrPublish', 'Y');
            if (isset($aliasId) && !empty($aliasId)) {
                $Query = $Query->where('cp.intAliasId', $aliasId);
            }
        $response = $Query->get(1);
        return $response;
    }
}
