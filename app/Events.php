<?php
/**
 * The Events class handels events model queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.00
 * @since       2016-07-14
 * @author    NetQuick
 */
namespace App;
use Illuminate\Database\Eloquent\Model;
use Cache;
class Events extends Model
{
		protected $table    = 'event';
		protected $fillable = [
				'id',
				'intAliasId',
				'varTitle',
				'fkIntImgId',
				'fkIntVideoId',
				'varEventDays',
				'varEventPriceType',
				'fltAdultPrice',
				'fltChildPrice',
				'dtStartDateTime',
				'dtEndDateTime',
				'txtDescription',
				'txtCategories',
				'varLatitude',
				'varLongitude',
				'txtAddress',
				'varMetaTitle',
				'varMetaKeyword',
				'varMetaDescription',
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
		public static function getRecordIdByAliasID($aliasID)
		{
				$response = false;
				$response = Cache::tags(['Events'])->get('getEventsRecordIdByAliasID_'.$aliasID);
				if(empty($response)){
					$response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
					Cache::tags(['Events'])->forever('getEventsRecordIdByAliasID_'.$aliasID, $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of front blog list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontList($filterArr = false, $page = 1)
		{
				$response     = false;
				$moduleFields = ['id', 'varTitle', 'fkIntImgId', 'intAliasId', 'dtStartDateTime'];
				$aliasFields  = ['id', 'varAlias'];				
				$response = Cache::tags(['Events'])->get('getEventFrontList_'.$page);
				if(empty($response)){
					$response = Self::getFrontRecords($moduleFields, $aliasFields)
					->deleted()
					->publish()
					->filter($filterArr)
					->paginate(1);
					Cache::tags(['Events'])->forever('getEventFrontList_'.$page, $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of front latest blog list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getLatestList($id = false)
		{
				$response     = false;
				$moduleFields = ['varTitle', 'fkIntImgId', 'intAliasId', 'dtStartDateTime'];
				$aliasFields  = ['id', 'varAlias'];
				$response = Cache::tags(['Events'])->get('getEventgetLatestList_'.$id);
				if(empty($response)){
					$response = Self::getFrontRecords($moduleFields, $aliasFields)
					->deleted()
					->publish()
					->latest($id)
					->take(5)
					->get();
					Cache::tags(['Events'])->forever('getEventgetLatestList_'.$id, $response);				
				}
				return $response;
		}

		/**
		 * This method handels retrival of front latest blog list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFeaturedList()
		{
				$response = false;
				$response = Cache::tags(['Events'])->get('getEventFeaturedList');
				if(empty($response)){
					$moduleFields = ['varTitle', 'fkIntImgId', 'intAliasId', 'dtStartDateTime'];
					$aliasFields  = ['id', 'varAlias'];
					$response = Self::getFrontRecords($moduleFields, $aliasFields)
					->deleted()
					->publish()
					->take(10)
					->get();
					Cache::tags(['Events'])->forever('getEventFeaturedList', $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of front blog detail
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontDetail($id)
		{
				$response     = false;
				$moduleFields = ['id', 'varTitle', 'txtDescription', 'txtCategories', 'fkIntImgId', 'intAliasId', 'dtStartDateTime'];
				$aliasFields  = ['id', 'varAlias'];
				$response = Cache::tags(['Events'])->get('getEventsFrontDetail_'.$id);
				if(empty($response)){
					$response = Self::getFrontRecords($moduleFields, $aliasFields)
					->deleted()
					->checkAliasId($id)
					->first();
					Cache::tags(['Events'])->forever('getEventsFrontDetail_'.$id, $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordList($filterArr = false)
		{
				$response     = false;
				$moduleFields = [
						'id',
						'varTitle',
						'fkIntImgId',
						'intAliasId',
						'chrPublish',
						'dtStartDateTime',
						'dtEndDateTime',
						'txtDescription',
						'txtCategories',
						'intDisplayOrder',
				];
				$aliasFields = ['id', 'varAlias'];
				$response    = Self::getPowerPanelRecords($moduleFields, $aliasFields)
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
		public static function getRecordById($id = false)
		{
				$response     = false;
				$moduleFields = [
						'id',
						'intAliasId',
						'varTitle',
						'fkIntImgId',
						'fkIntVideoId',
						'txtDescription',
						'txtCategories',
						'varEventDays',
						'varEventPriceType',
						'fltAdultPrice',
						'fltChildPrice',
						'dtStartDateTime',
						'dtEndDateTime',
						'varLatitude',
						'varLongitude',
						'txtAddress',
						'intDisplayOrder',
						'chrPublish',
						'txtAddress',
						'varMetaTitle',
						'varMetaKeyword',
						'varMetaDescription'];
				$aliasFields = ['id', 'varAlias'];
				$videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
				$response    = Self::getPowerPanelRecords($moduleFields, $aliasFields,$videoFields)
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

		#Database Configurations========================================
		/**
		 * This method handels retrival of blog records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getFrontRecords($moduleFields = false, $aliasFields = false)
		{
				$response = false;
				$data     = [
						'alias' => function ($query) use ($aliasFields) {$query->select($aliasFields);},
				];
				$response = self::select($moduleFields)->with($data);
				return $response;
		}
		/**
		 * This method handels retrival of blog records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $videoFields = false,$imageFields = false)
		{
				$data     = [];
				$response = false;
				$response = self::select($moduleFields);
				if ($imageFields != false) {
						$data['image'] = function ($query) use ($imageFields) {$query->select($imageFields);};
				}
				if ($aliasFields != false) {
						$data['alias'] = function ($query) use ($aliasFields) {$query->select($aliasFields)->checkModuleCode();};
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
		public static function getRecordForLogById($id)
		{
				$response     = false;
				$moduleFields = ['id', 'varTitle',
						'fkIntImgId',
						'txtDescription',
						'txtCategories',
						'dtStartDateTime',
						'dtEndDateTime',
						'varLatitude',
						'varLongitude',
						'txtAddress',
						'intDisplayOrder',
						'chrPublish',
						'txtAddress',
						'varMetaTitle',
						'varMetaKeyword',
						'varMetaDescription'];
				$response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
				return $response;
		}

		/**
		 * This method handels retrival of event records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getRecords()
		{
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
		public function alias()
		{
				return $this->belongsTo('App\Alias', 'intAliasId', 'id');
		}
		/**
		 * This method handels image relation
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function image()
		{
				return $this->belongsTo('App\Image', 'fkIntImgId', 'id');
		}

		/**
     * This method handels video relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function video()
    {
            return $this->belongsTo('App\Video', 'fkIntVideoId', 'id');
    }

		/**
		 * This method handels alias id scope
		 * @return  Object
		 * @since   2016-07-24
		 * @author  NetQuick
		 */
		public function scopeCheckAliasId($query, $id)
		{
				return $query->where('intAliasId', $id);
		}
		/**
		 * This method handels record id scope
		 * @return  Object
		 * @since   2016-07-24
		 * @author  NetQuick
		 */
		public function scopeCheckRecordId($query, $id)
		{
				return $query->where('id', $id);
		}
		/**
		 * This method handels order scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopeOrderCheck($query, $order)
		{
				return $query->where('intDisplayOrder', $order);
		}
		/**
		 * This method handels publish scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopePublish($query)
		{
				return $query->where(['chrPublish' => 'Y']);
		}
		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopeDeleted($query)
		{
				return $query->where(['chrDelete' => 'N']);
		}

		/**
		 * This method handels Popular Blogs scope
		 * @return  Object
		 * @since   2016-08-30
		 * @author  NetQuick
		 */
		public function scopeLatest($query, $id = false)
		{
				$response = false;
				$response = $query->groupBy('id')->orderBy('created_at', 'desc');
				if ($id > 0) {
						$response = $response->where('id', '!=', $id);
				}
				//->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)')
				//->whereRaw('created_at <= NOW()')
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
		 * This method handels filter scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false)
		{

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
				if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
						$data = $query->where('chrPublish', $filterArr['statusFilter']);
				}
				if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
						$data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
				}

				if (!empty($filterArr['catFilter']) && $filterArr['catFilter'] != ' ') {
						$data = $query->where('txtCategories', 'like', '%' . '"' . $filterArr['catFilter'] . '"' . '%');
				}

				if (!empty($filterArr['start']) && $filterArr['start'] != ' ') {
						$data = $query->whereRaw('	DATE(dtStartDateTime) = DATE("' . date('Y-m-d', strtotime(str_replace('/', '-', $filterArr['start']))) . '")');
				}

				if (!empty($filterArr['end']) && $filterArr['end'] != ' ') {
						$data = $query->whereRaw('DATE(dtEndDateTime) = DATE("' . date('Y-m-d', strtotime(str_replace('/', '-', $filterArr['end']))) . '") AND dtEndDateTime IS NOT null');
				}
				if (!empty($query)) {
						$response = $query;
				}
				return $response;
		}
}
