<?php

/**
 * The Faq class handels bannner queries
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

class GeneralFaq extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'general_faq';
    protected $fillable = [
        'id',
        'varTitle',
        'fkCategory',
        'txtDescription',
        'intDisplayOrder',
        'chrPublish',
        'chrDelete',
    ];

    /**
     * This method handels retrival of faqs records
     * @return  Object
     * @since   2016-07-20
     * @author  NetQuick
     */
    public static function getRecords() {
        $response = false;
        $response = Cache::tags(['GeneralFaq'])->get('getGeneralFaqRecords');
        if (empty($response)) {
            $response = Self::Select(['id', 'varTitle', 'fkCategory', 'txtDescription', 'intDisplayOrder', 'chrPublish'])
                    ->deleted()
                    ->publish()
                    ->paginate(10);
            Cache::tags(['GeneralFaq'])->forever('getGeneralFaqRecords', $response);
        }
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
        $moduleFields = ['id', 'varTitle', 'fkCategory', 'txtDescription', 'intDisplayOrder', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->deleted()
                ->filter($filterArr)
                ->get();
        return $response;
    }

    public static function getCat() {
        $response = DB::table('faq_category')
                ->select(['varTitle as text', 'id'])
                ->where(['chrPublish' => 'Y'], ['chrDelete' => 'N'])
                ->get();

        return $response;
    }
    
    public static function getFAQCatData($cat) {
        $response = DB::table('faq_category')
                ->select(['varTitle'])
                ->where(['id' => $cat])
                ->first();
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
        $moduleFields = ['id', 'varTitle', 'fkCategory', 'txtDescription', 'intDisplayOrder', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
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
        $moduleFields = ['id', 'varTitle', 'fkCategory', 'txtDescription', 'intDisplayOrder', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }
    
    public static function getFaqRecords() {
        $response = DB::table('general_faq')
                ->join('faq_category', 'general_faq.fkCategory', '=', 'faq_category.id')
                ->select('general_faq.*', 'faq_category.varTitle as CatName')
                ->where(['general_faq.chrDelete' => 'N'])
                ->where(['general_faq.chrPublish' => 'Y'])
                ->orderBy('faq_category.intDisplayOrder')
                ->orderBy('general_faq.intDisplayOrder')
                ->get();
        return $response;
    }
    
    public static function getFaqRecordsByIds($ids = array()) {
        $response = DB::table('general_faq')
                ->join('faq_category', 'general_faq.fkCategory', '=', 'faq_category.id')
                ->select('general_faq.*', 'faq_category.varTitle as CatName')
                ->where(['general_faq.chrDelete' => 'N'])
                ->where(['general_faq.chrPublish' => 'Y'])
                ->whereIn('faq_category.id',$ids)
                ->orderBy('faq_category.intDisplayOrder')
                ->orderBy('general_faq.intDisplayOrder')
                ->get();
        return $response;
    }
    
    public static function getFaqCategories() {
        $response = DB::table('faq_category')
                ->select('faq_category.id', 'faq_category.varTitle as CatName')
                ->where(['faq_category.chrDelete' => 'N'])
                ->where(['faq_category.chrPublish' => 'Y'])
                ->orderBy('faq_category.intDisplayOrder')
                ->get();
        return $response;
    }
    public static function getProductsFaqRecords($id) {
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
     public static function getFeaturedProductsRecords() {
        $response = DB::table('featured_products')
                ->select(['varTitle', 'varShortDescription', 'varIconClass', 'varFeature', 'varButtonName', 'varButtonLink','varWHMCSFieldName'])
                ->where(['fkProductCategories' => '2'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrLandingPage' => 'Y'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
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
     * @since   2016-07-20
     * @author  NetQuick
     */
    public function scopeOrderCheck($query, $order) {
        return $query->where('intDisplayOrder', $order);
    }

    /**
     * This method handels publish scope
     * @return  Object
     * @since   2016-07-20
     * @author  NetQuick
     */
    public function scopePublish($query) {
        return $query->where(['chrPublish' => 'Y']);
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-20
     * @author  NetQuick
     */
    public function scopeDeleted($query) {
        return $query->where(['chrDelete' => 'N']);
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
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

}
