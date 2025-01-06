<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Client extends Model
{
		protected $table    = 'client';
		protected $fillable = [
				'id',
				'varTitle',
				'intAliasId',				
				'fkIntImgId',
				'intDisplayOrder',
				'txtDescription',
				'txtLink',
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
		public static function getRecordIdByAliasID($aliasID)
		{
				$response = false;
				$response = Cache::tags(['Client'])->get('getClientRecordIdByAliasID_'.$aliasID);
				if(empty($response)){
					$response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
					Cache::tags(['Client'])->forever('getClientRecordIdByAliasID_'.$aliasID, $response);
				}
				return $response;
		}
		/**
		 * This method handels retrival of front client list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontList($term=false, $page=false)
		{		
				$response   = false;
				$aliasFields = ['id', 'varAlias'];
				$clientFields = [
						'varTitle',
						'fkIntImgId',
						'intAliasId',						
						'txtDescription',						
						'varPhoneNo',
						'textAddress',
						'txtLink'];
				$response = Cache::tags(['Client'])->get('getFrontClientList_'.$page);
				if(empty($response)){
					$response = Self::getFrontRecords($clientFields, $aliasFields)
					->deleted()
					->publish()
					->frontFilter($term)
					->paginate(9);
					Cache::tags(['Client'])->forever('getFrontClientList_'.$page, $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of front latest client list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getLatestList()
		{
				$response   = false;
				$aliasFields = ['id', 'varAlias'];
				$clientFields = [
						'varTitle',
						'fkIntImgId',
						'intAliasId',						
						'txtDescription',						
						'txtLink'								
					];
				$response = Cache::tags(['Client'])->get('getLatestClientList');
				if(empty($response)){
					$response = Self::getFrontRecords($clientFields, $aliasFields)
					->deleted()
					->publish()
					->latest()
					->take(5)
					->get();
					Cache::tags(['Client'])->forever('getLatestClientList', $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of front client detail
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontDetail($id)
		{
				$response   = false;
				$aliasFields = ['id', 'varAlias'];
				$clientFields = [
						'varTitle',
						'fkIntImgId',
						'intAliasId',
						'txtDescription',						
						'txtLink',
						'varMetaTitle',
						'varMetaKeyword',
						'varMetaDescription'
					];
				$response = Cache::tags(['Client'])->get('getFrontClientDetail_'.$id);
				if(empty($response)){
					$response = Self::getFrontRecords($clientFields, $aliasFields)
					->deleted()
					->checkAliasId($id)
					->first();
					Cache::tags(['Client'])->forever('getFrontClientDetail_'.$id, $response);
				}
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
		 * This method handels image relation
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function image()
		{
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
		public static function getRecords()
		{
				$response = false;
				$response = self::with(['alias' => function ($query) {
						$query->checkModuleCode();
				}, 'image']);
				return $response;
		}

		/**
		 * This method handels retrival of client records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getFrontRecords($clientFields = false, $aliasFields = false)
		{
				$response = false;
				$data     = [
						'alias' => function ($query) use ($aliasFields) {$query->select($aliasFields);},
				];
				$response = self::select($clientFields)->with($data);
				return $response;
		}

		/**
		 * This method handels backend records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $imageFields = false)
		{
				$data     = [];
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
		public static function getRecordList($filterArr = false)
		{
				$response     = false;
				$moduleFields = ['id', 'intAliasId', 'varTitle', 'fkIntImgId', 'intDisplayOrder', 'txtDescription', 'chrPublish'];
				$response     = Self::getPowerPanelRecords($moduleFields)
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
		public static function getRecordById($id)
		{
				$response     = false;
				$moduleFields = ['id', 'intAliasId', 'txtLink', 'varTitle', 'fkIntImgId', 'intDisplayOrder', 'txtDescription','chrPublish'];
				$aliasFields  = ['id', 'varAlias'];
				$imageFields  = ['id', 'txtImageName', 'varImageExtension'];
				$response     = Self::getPowerPanelRecords($moduleFields, $aliasFields, $imageFields)->deleted()->checkRecordId($id)->first();
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
				$moduleFields = ['id', 'intAliasId','varTitle', 'fkIntImgId', 'intDisplayOrder', 'txtDescription', 'txtLink', 'chrPublish'];
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
		 * This method handels retrival of backend record list
		 * @return  Object
		 * @since   2017-10-24
		 * @author  NetQuick
		 */
		public static function getClientTitlesByIds($ids = false)
		{
				$response     = false;
				$moduleFields = ['id', 'varTitle'];
				$query        = Self::select($moduleFields)->deleted();
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
		public function scopeCheckAliasId($query, $id)
		{
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
		public function scopeCheckRecordId($query, $id)
		{
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
		public function scopeCheckRecordIds($query, $ids)
		{
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
		public function scopeOrderCheck($query, $order)
		{
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

		public function scopeDisplayOrderBy($query, $orderBy)
		{
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
		public function scopeLatest($query, $id = false)
		{
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
		public function scopeFrontFilter($query, $term = false)
		{
				$response = false;
				if ($term != false) {
						$query->where('varTitle', 'like', '%' . $term . '%');
						$query->orWhere('varPhoneNo', 'like', '%' . $term . '%');
				}
				$response = $query;
				return $response;
		}

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
