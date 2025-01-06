<?php

/**
 * The Testimonial class handels bannner queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.1
 * @since       2017-07-20
 * @author    NetQuick
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;

class Testimonial extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'testimonials';
    protected $fillable = [
        'id',
        'varTitle',
        'fkIntImgId',
        'fkProductCategories',
        'fkProduct',
        'txtDescription',
        'chrShowHomePage',
        'dtStartDateTime',
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
        $response = Cache::tags(['Testimonial'])->get('getTestimonialRecordIdByAliasID_' . $aliasID);
        if (empty($response)) {
            $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
            Cache::tags(['Testimonial'])->forever('getTestimonialRecordIdByAliasID_' . $aliasID, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front testimonial list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontList($filterArr = false, $currentPage = 1) {
        $response = false;
        $testimonialFields = ['varTitle', 'fkIntImgId', 'fkProductCategories', 'fkProduct', 'txtDescription', 'chrShowHomePage', 'created_at', 'dtStartDateTime'];
        $response = Cache::tags(['Testimonial'])->get('getFrontTestimonialList_' . $currentPage);
        if (empty($response)) {
            $response = Self::getFrontRecords($testimonialFields)
                    ->deleted()
                    ->publish()
                    ->filter($filterArr)
                    ->paginate(2);
            Cache::tags(['Testimonial'])->forever('getFrontTestimonialList_' . $currentPage, $response);
        }
        return $response;
    }

    public static function getFeaturedProductsRecords() {
        $response = DB::table('featured_products')
                ->select(['varTitle', 'varShortDescription', 'varIconClass', 'varFeature', 'varButtonName', 'varButtonLink', 'varWHMCSFieldName'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->Where(['id' => '28'])
                ->orWhere(['id' => '27'])
                ->orderBy('intDisplayOrder')
                ->limit(2)
                ->get();
        
        return $response;
    }

    /**
     * This method handels retrival of front testimonial list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getLatestList() {
        $response = false;
        $testimonialFields = ['varTitle', 'fkIntImgId', 'fkProductCategories', 'fkProduct', 'txtDescription', 'chrShowHomePage', 'created_at', 'dtStartDateTime'];
        $response = Cache::tags(['Testimonial'])->get('getTestimonialLatestList');
        if (empty($response)) {
            $response = Self::getFrontRecords($testimonialFields)
                    ->deleted()
                    ->publish()
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            Cache::tags(['Testimonial'])->forever('getTestimonialLatestList', $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of testimonial records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($testimonialFields = false, $aliasFields = false) {
        $response = false;
        $response = self::select($testimonialFields);
        return $response;
    }

    /**
     * This method handels retrival of testimonials records
     * @return  Object
     * @since   2016-07-20
     * @author  NetQuick
     */
    public static function getRecords() {
        $response = false;
        $response = self::with([]);
        return $response;
    }

    /**
     * This method handels backend records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false) {
        $data = [];
        $response = false;
        $response = self::select($moduleFields);

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
        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'fkProductCategories', 'fkProduct', 'txtDescription', 'chrShowHomePage', 'intDisplayOrder', 'dtStartDateTime', 'chrPublish'];
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
        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'fkProductCategories', 'fkProduct', 'txtDescription', 'chrShowHomePage', 'dtStartDateTime', 'intDisplayOrder', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    public static function getTestimonialRecords() {
        $response = DB::table('testimonials')
                ->select(['varTitle', 'fkIntImgId', 'txtDescription', 'dtStartDateTime'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('dtStartDateTime')
                ->get();
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
        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'fkProductCategories', 'fkProduct', 'txtDescription', 'chrShowHomePage', 'dtStartDateTime', 'intDisplayOrder', 'chrPublish'];
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
     * @since   2016-07-20
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
     * @since   2016-07-20
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
     * @since   2016-07-20
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
            $query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
        } else {
            $query = $query->orderBy('varTitle', 'ASC');
        }
        if (!$retunTotalRecords) {
            if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
                $data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
            }
        }
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }
        if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
            $data = $query->where('chrPublish', $filterArr['statusFilter']);
        }
        if (!empty($filterArr['dateFilter'])) {
            $data = $query->whereRaw('DATE(dtStartDateTime) = "' . $filterArr['dateFilter'] . '"');
        }
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

}
