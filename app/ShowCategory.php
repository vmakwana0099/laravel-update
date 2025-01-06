<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class ShowCategory extends Model
{
    protected $table    = 'show_category';
    protected $fillable = [
        'id',
        'intAliasId',
        'varTitle',
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
    public static function getRecordIdByAliasID($aliasID)
    {
        $response = false;
        $response = Cache::tags(['ShowsCategory'])->get('getShowsCatRecordIdByAliasID_'.$aliasID);
        if(empty($response)){
            $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
            Cache::tags(['ShowsCategory'])->forever('getShowsCatRecordIdByAliasID_'.$aliasID, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front latest service list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontList()
    {
        $response           = false;
        $response = Cache::tags(['ShowsCategory'])->get('getShowsCatFrontList');      
        if(empty($response)){
            $showCategoryFields = ['id', 'varTitle'];
            $response           = Self::getFrontRecords($showCategoryFields)
                ->deleted()
                ->publish()
                ->pluck('varTitle', 'id');
            Cache::tags(['ShowsCategory'])->forever('getShowsCatFrontList', $response);
            $response = Cache::tags(['ShowsCategory'])->get('getShowsCatFrontList');
        }
        return $response;
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($moduleFields = false)
    {
        $response = false;
        $response = Self::select($moduleFields);
        return $response;
    }

    /**
     * This method handels alias relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function alias()
    {
        $response = false;
        $response = $this->belongsTo('App\Alias', 'intAliasId', 'id');
        return $response;
    }

    /**
     * This method handels show-category relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function show()
    {
        $response = false;
        $response = $this->hasOne('App\Show', 'id', 'intCategoryId');
        return $response;
    }

    /**
     * This method handels show sub-category relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function showCategory()
    {
        $response = false;
        $response = $this->hasOne('App\ShowCategory', 'id', 'intParentCategoryId');
        return $response;
    }

    /**
     * This method handels main category relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function parentCategory()
    {
        $response = false;
        $response = $this->belongsTo('App\ShowCategory', 'intParentCategoryId', 'id');
        return $response;
    }

    /**
     * This method handels retrival of records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getRecords($moduleId = false)
    {
        $response = false;
        $response = self::with([
            'alias' => function ($query) use ($moduleId) {
                $query->checkModuleCode($moduleId);
            }, 'parentCategory']);
        return $response;
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false)
    {
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
            $data = $query->whereRaw("( varTitle LIKE '%" . $filterArr['searchFilter'] . "%')");
        } else {
            $data = $query->orderBy('id', 'ASC');
        }

        if (!empty($data)) {
            $response = $data;
        }
        return $response;
    }

    /**
     * This method handels backend records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $parentCategoryFields = false)
    {
        $data     = [];
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
    public static function getRecordList($filterArr = false)
    {
        $response     = false;
        $moduleFields = ['id', 'varTitle', 'intAliasId', 'intParentCategoryId', 'intDisplayOrder', 'txtShortDescription', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $response     = Self::getPowerPanelRecords($moduleFields)
            ->deleted()
            ->filter($filterArr)
            ->get();
        return $response;
    }

    /**
     * This method handels retrival of Parent Category record by id
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getParentCategoryNameBycatId($id)
    {
        $response       = false;
        $categoryFields = ['varTitle'];
        $response       = Self::select($categoryFields)->deleted()->checkRecordId($id)->get();
        return $response;
    }

    public static function getCatWithParent(){
        $response = false;
        $categoryFields=[ 'id', 'intParentCategoryId', 'varTitle'];
        $parentCategoryFields=[ 'id', 'varTitle'];      
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
        public static function getCountById($categoryId = null)
        {
                $response     = false;
                $moduleFields = ['id'];
                $response     = Self::getPowerPanelRecords($moduleFields)
                        ->checkCategoryId($categoryId)
                        ->deleted()
                        ->count();
                return $response;
        }

        /**
        * This method handels category id scope
        * @return  Object
        * @since   2018-01-09
        * @author  NetQuick
        */
        public function scopeCheckCategoryId($query, $id)
        {
                $response = false;
                $response = $query->where('intParentCategoryId',  $id);
                return $response;
        }

    /**
     * This method handels retrival of record by id
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordById($id)
    {
        $response     = false;
        $moduleFields = ['id', 'varTitle', 'intAliasId', 'intParentCategoryId', 'intDisplayOrder', 'txtShortDescription', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $aliasFields  = ['id', 'varAlias'];
        $response     = Self::getPowerPanelRecords($moduleFields, $aliasFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }
    /**
     * This method handels retrival of category Record
     * @return  Object
     * @since   2017-10-24
     * @author  NetQuick
     */
    public static function getCategories()
    {
        $response     = false;
        $moduleFields = ['id', 'varTitle', 'intParentCategoryId'];
        $response     = Self::select($moduleFields)
            ->deleted()
            ->publish();
        return $response;
    }

    /**
     * This method handels retrival of record by id for Log Manage
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordForLogById($id)
    {
        $response     = false;
        $moduleFields = ['id', 'varTitle', 'intParentCategoryId', 'intDisplayOrder', 'txtShortDescription', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $response     = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    protected static $fetchedOrder    = [];
    protected static $fetchedOrderObj = null;
    public static function getRecordByOrder($order = false)
    {
        $response     = false;
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
     * This method handels alias id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckAliasId($query, $id)
    {
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
    public function scopeCheckRecordId($query, $id)
    {
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
    public function scopeOrderCheck($query, $order)
    {
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
    public function scopeNotIdCheck($query, $id)
    {
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
    public function scopePublish($query)
    {
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
    public function scopeDeleted($query)
    {
        $response = false;
        $response = $query->where(['chrDelete' => 'N']);
        return $response;
    }

}
