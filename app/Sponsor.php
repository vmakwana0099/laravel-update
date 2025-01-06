<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Sponsor extends Model
{
		protected $table    = 'sponsor';
		protected $fillable = [
				'id',
				'fkIntImgId',
				'varTitle',
				'txtCategories',
				'varExternalLink',
				'txtDescription',
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
				$response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
				return $response;
		}
		/**
		 * This method handels retrival of sponsor records
		 * @return  Object
		 * @since   2016-07-20
		 * @author  NetQuick
		 */
		public static function getRecords()
		{
				$response = false;
				$response = self::with(['image']);
				return $response;
		}

		/**
		 * This method handels image relation
		 * @return  Object
		 * @since   2017-07-20
		 * @author  NetQuick
		 */
		public function image()
		{
				$response = false;
				$response = $this->belongsTo('App\Image', 'fkIntImgId', 'id');
				return $response;
		}

		/**
		 * This method handels backend records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getPowerPanelRecords($moduleFields = false)
		{
				$data     = [];
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
		public static function getRecordList($filterArr = false)
		{
				$response     = false;
				$moduleFields = ['id', 'varTitle', 'fkIntImgId', 'txtCategories', 'varExternalLink', 'intDisplayOrder', 'chrPublish'];
				$response     = Self::getPowerPanelRecords($moduleFields)
						->deleted()
						->filter($filterArr)
						->get();
				return $response;
		}

		/**
     * This method handels retrival of front Sponsor list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontList($limit=10)
    {
        $response     = false;
        $response = Cache::tags(['Sponsors'])->get('getFrontList');
        if(empty($response)){
            $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'txtCategories', 'varExternalLink', 'intDisplayOrder', 'chrPublish'];
            $response = Self::getFrontRecords($moduleFields)
                    ->deleted()
                    ->publish()
                    ->take($limit)
                    ->get();
            Cache::tags(['Sponsors'])->forever('getFrontList', $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of Sponsors records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($moduleFields = false, $aliasFields = false)
    {
    	$response = false;
    	$data = [];
    	$response = self::select($moduleFields);
    	if(count($data) > 0){
    		$response = self::select($moduleFields)->with($data); 
    	}
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
				$moduleFields = ['id', 'varTitle', 'fkIntImgId','txtCategories', 'varExternalLink', 'intDisplayOrder', 'chrPublish'];
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
		 * @since   2016-07-20
		 * @author  NetQuick
		 */
		public function scopeOrderCheck($query, $order)
		{
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
		public function scopePublish($query)
		{
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
		public function scopeDeleted($query)
		{
				$response = false;
				$response = $query->where(['chrDelete' => 'N']);
				return $response;
		}

		/**
     * This method handels category id scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeCheckCategoryId($query, $id)
    {
        return $query->where('txtCategories', 'like', '%' . '"' . $id . '"' . '%');
    }

		/**
     * This method handels retrival of record count based on category
     * @return  Object
     * @since   2017-10-16
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
		 * This method handels filter scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false)
		{
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
				if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
						$data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
				}
				if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
						$data = $query->where('chrPublish', $filterArr['statusFilter']);
				}
				if (!empty($filterArr['catFilter']) && $filterArr['catFilter'] != ' ') {
						$data = $query->where('txtCategories', 'like', '%' . '"' . $filterArr['catFilter'] . '"' . '%');
				}
				if (!empty($filterArr['dateFilter']) && $filterArr['dateFilter'] != ' ') {
						$data = $query->whereRaw('DATE(dtStartDateTime) = DATE("' . date('Y-m-d', strtotime($filterArr['dateFilter'])) . '")');
						// $data = $query->orWhereRaw('DATE(dtStartDateTime) <= DATE("' . date('Y-m-d', strtotime($filterArr['dateFilter']['to'])) . '")');
				}
				if (!empty($query)) {
						$response = $query;
				}
				return $response;
		}
}
