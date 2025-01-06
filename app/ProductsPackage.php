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

class ProductsPackage extends Model {

    protected $table = 'products_package';
    protected $fillable = [
        'id',
        'intAliasId',
        'varTitle',
        'fkProductCategories',
        'fkProduct',
        'fkWhmcsProductCategories',
        'fkWhmcsProduct',
        'varAdditionalOffer',
        'intOldPriceOneMonthINR',
        'intOldPriceThreeMonthINR',
        'intOldPriceSixMonthINR',
        'intOldPriceOneYearINR',
        'intOldPriceTwoYearINR',
        'intOldPriceThreeYearINR',
        'intOldPriceOneMonthUSD',
        'intOldPriceThreeMonthUSD',
        'intOldPriceSixMonthUSD',
        'intOldPriceOneYearUSD',
        'intOldPriceTwoYearUSD',
        'intOldPriceThreeYearUSD',
        'txtSpecification',
        'txtShortDescription',
        'txtRecommandedFeatures',
        'chrDisplayontop',
        'intDisplayOrder',
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
            'varTitle',
            'fkProductCategories',
            'fkProduct',
            'intOldPriceOneMonthINR',
            'intOldPriceThreeMonthINR',
            'intOldPriceSixMonthINR',
            'intOldPriceOneYearINR',
            'intOldPriceTwoYearINR',
            'intOldPriceThreeYearINR',
            'intOldPriceOneMonthUSD',
            'intOldPriceThreeMonthUSD',
            'intOldPriceSixMonthUSD',
            'intOldPriceOneYearUSD',
            'intOldPriceTwoYearUSD',
            'intOldPriceThreeYearUSD',
            'fkWhmcsProductCategories',
            'fkWhmcsProduct',
            'varAdditionalOffer',
            'txtSpecification',
            'txtShortDescription',
            'txtRecommandedFeatures',
            'chrDisplayontop',
            'intDisplayOrder',
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
            'varTitle',
            'fkProductCategories',
            'fkProduct',
            'fkWhmcsProductCategories',
            'fkWhmcsProduct',
            'intOldPriceOneMonthINR',
            'intOldPriceThreeMonthINR',
            'intOldPriceSixMonthINR',
            'intOldPriceOneYearINR',
            'intOldPriceTwoYearINR',
            'intOldPriceThreeYearINR',
            'intOldPriceOneMonthUSD',
            'intOldPriceThreeMonthUSD',
            'intOldPriceSixMonthUSD',
            'intOldPriceOneYearUSD',
            'intOldPriceTwoYearUSD',
            'intOldPriceThreeYearUSD',
            'varAdditionalOffer',
            'txtSpecification',
            'txtShortDescription',
            'txtRecommandedFeatures',
            'chrDisplayontop',
            'intDisplayOrder',
            'chrPublish'];
        $aliasFields = ['id', 'varAlias'];
        $videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
        $response = Self::getPowerPanelRecords($moduleFields, $aliasFields, $videoFields)
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
    public static function getFrontList($limit = 10) {
        $response = false;
        $response = Cache::tags(['Products'])->get('getFrontList');
        if (empty($response)) {
            $moduleFields = [
                'id',
                'intAliasId',
                'varTitle',
                'fkProductCategories',
                'fkProduct',
                'fkWhmcsProductCategories',
                'eMonthly',
                'intOldPriceOneMonthINR',
                'intOldPriceThreeMonthINR',
                'intOldPriceSixMonthINR',
                'intOldPriceOneYearINR',
                'intOldPriceTwoYearINR',
                'intOldPriceThreeYearINR',
                'intOldPriceOneMonthUSD',
                'intOldPriceThreeMonthUSD',
                'intOldPriceSixMonthUSD',
                'intOldPriceOneYearUSD',
                'intOldPriceTwoYearUSD',
                'intOldPriceThreeYearUSD',
                'intOldPriceYeafkWhmcsProduct',
                'varAdditionalOffer',
                'txtSpecification',
                'txtShortDescription',
                'txtRecommandedFeatures',
                'chrDisplayontop',
                'intDisplayOrder'
            ];
            $aliasFields = ['id', 'varAlias'];
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->featured('Y')
                    ->displayOrderBy('DESC')
                    ->take($limit)
                    ->get();
            Cache::tags(['Products'])->forever('getFrontList', $response);
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

    /**
     * This method handels retrival of product records
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
            $data['productCategory'] = function ($query) use ($categoryFields) {
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
            'fkProductCategories',
            'fkProduct',
            'fkWhmcsProductCategories',
            'fkWhmcsProduct',
            'varAdditionalOffer',
            'intOldPriceOneMonthINR',
            'intOldPriceThreeMonthINR',
            'intOldPriceSixMonthINR',
            'intOldPriceOneYearINR',
            'intOldPriceTwoYearINR',
            'intOldPriceThreeYearINR',
            'intOldPriceOneMonthUSD',
            'intOldPriceThreeMonthUSD',
            'intOldPriceSixMonthUSD',
            'intOldPriceOneYearUSD',
            'intOldPriceTwoYearUSD',
            'intOldPriceThreeYearUSD',
            'txtSpecification',
            'txtShortDescription',
            'txtRecommandedFeatures',
            'chrDisplayontop',
            'intDisplayOrder',
            'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    public static function getProductData($id) {
        $response = false;
        $moduleFields = ['varTitle'];
        $response = Self::select($moduleFields)
                ->deleted()
                ->publish()
                ->where('id', $id)
                ->first();
        return $response;
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
    public function scopeCheckCategoryId($query, $id) {
        return $query->where('fkProductCategories', $id);
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

    public static function getProductName() {
        $response = false;
        $parentCategoryFields = ['id', 'varTitle as text'];
        $response = Self::getPowerPanelRecords($parentCategoryFields)
                ->deleted()
                ->publish()
                ->get();
        return $response;
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
    function scopeFeatured($query, $flag = null) {
        $response = false;
        $response = $query->where(['varFeaturedProduct' => $flag]);
        return $response;
    }

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

}
