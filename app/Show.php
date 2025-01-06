<?php
/**
 * The Show class handels show model queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.00
 * @since     2016-07-14
 * @author    NetQuick
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Show extends Model
{
		protected $table    = 'show';
		protected $fillable = [
				'id',
				'intAliasId',
				'txtCategories',
				'varTitle',
				'fkIntImgId',
				'fkIntVideoId',
				'dtStartDateTime',
				'dtEndDateTime',
				'txtDescription',
				'txtShortDescription',
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
				$response = Cache::tags(['Shows'])->get('getShowsRecordIdByAliasID_'.$aliasID);
        if(empty($response)){
					$response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
					Cache::tags(['Shows'])->forever('getShowsRecordIdByAliasID_'.$aliasID, $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of front blog list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontList($filterArr = false,$currentPage=1)
		{

				$response     = false;
				$response = Cache::tags(['Shows'])->get('getFrontShowlist_'.$currentPage);
				if(empty($response)){
					$moduleFields = ['varTitle', 'fkIntImgId', 'intAliasId', 'dtStartDateTime', 'txtShortDescription'];
					$aliasFields  = ['id', 'varAlias'];
					$response = Self::getFrontRecords($moduleFields, $aliasFields)
							->deleted()
							->publish()
							->filter($filterArr)
							->paginate(1);
							Cache::tags(['Shows'])->forever('getFrontShowlist_'.$currentPage, $response);
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
				$response = Cache::tags(['Shows'])->get('getShowsLatestList_'.$id);
				if(empty($response)){
					$response = Self::getFrontRecords($moduleFields, $aliasFields)
							->deleted()
							->publish()
							->latest($id)
							->take(5)
							->get();
					Cache::tags(['Shows'])->forever('getShowsLatestList_'.$id, $response);
				}
			return $response;
		}

		/**
		 * This method handels retrival of front latest Show list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFeaturedList()
		{
				$response     = false;
				$moduleFields = ['varTitle', 'fkIntImgId', 'intAliasId', 'dtStartDateTime'];
				$aliasFields  = ['id', 'varAlias'];
				$response = Cache::tags(['Shows'])->get('getShowFeaturedList');
				if(empty($response)){
					$response = Self::getFrontRecords($moduleFields, $aliasFields)
							->deleted()
							->publish()
							->featured('Y')
							->take(3)
							->get();
					Cache::tags(['Shows'])->forever('getShowFeaturedList', $response);
				}
				return $response;
		}

			/**
		 * This method handels featured scope
		 * @return  Object
		 * @since   2016-08-08
		 * @author  NetQuick
		 */
		function scopeFeatured($query,$flag=null) {
			$response = false;
			$response = $query->where(['varFeaturedShow' => $flag]);
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
				$moduleFields = ['varTitle', 'txtDescription', 'fkIntImgId', 'intAliasId', 'dtStartDateTime'];
				$aliasFields  = ['id', 'varAlias'];
				$response = Cache::tags(['Shows'])->get('getFrontShowsDetail_'.$id);
				if(empty($response)){
					$response  = Self::getFrontRecords($moduleFields, $aliasFields)->deleted()->checkAliasId($id)->first();
					Cache::tags(['Shows'])->forever('getFrontShowsDetail_'.$id, $response);
				}
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
						'varAuthor',
						'intAliasId',
						'id',
						'chrPublish',
						'varTitle',
						'dtStartDateTime',
						'dtEndDateTime',
						'txtDescription',
						'varFeaturedShow',
						'txtShortDescription',
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
						'txtCategories',
						'varAuthor',
						'varShowDays',
						'dtStartDateTime',
						'dtEndDateTime',
						'fkIntImgId',
						'fkIntVideoId',
						'txtShortDescription',
						'txtDescription',
						'varFeaturedShow',
						'intDisplayOrder',
						'chrPublish',
						'varMetaTitle',
						'varMetaKeyword',
						'varMetaDescription',
				];
				$aliasFields = ['id', 'varAlias'];
				$videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
				$response    = Self::getPowerPanelRecords($moduleFields, $aliasFields, $videoFields)
						->deleted()
						->checkRecordId($id)
						->first();
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
				$moduleFields = ['id',
						'varTitle',
						'txtCategories',
						'varAuthor',
						'varShowDays',
						'dtStartDateTime',
						'dtEndDateTime',
						'fkIntImgId',
						'fkIntVideoId',
						'txtShortDescription',
						'txtDescription',
						'varFeaturedShow',
						'intDisplayOrder',
						'chrPublish',
						'varMetaTitle',
						'varMetaKeyword',
						'varMetaDescription'];
				$response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
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

		#Database Configurations========================================
		/**
		 * This method handels retrival of blog records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getFrontRecords($moduleFields = false, $aliasFields = false, $imageFields = false)
		{
				$response = false;
				$data     = ['alias' => function ($query) use ($aliasFields) {
						$query->select($aliasFields);
				}];
				$response = Self::select($moduleFields)->with($data);
				return $response;
		}
		/**
		 * This method handels retrival of blog records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $videoFields = false, $imageFields = false, $categoryFields = false)
		{
				$data     = [];
				$response = false;
				$response = Self::select($moduleFields);
				if ($imageFields != false) {
						$data['image'] = function ($query) use ($imageFields) {$query->select($imageFields);};
				}
				if ($aliasFields != false) {
						$data['alias'] = function ($query) use ($aliasFields) {$query->select($aliasFields)->checkModuleCode();};
				}
				if ($videoFields != false) {
						$data['video'] = function ($query) use ($videoFields) {$query->select($videoFields)->publish();};
				}
				if ($categoryFields != false) {
						$data['blogCategory'] = function ($query) use ($categoryFields) {$query->select($categoryFields);};
				}
				if (count($data) > 0) {
						$response = $response->with($data);
				}
				return $response;
		}

		/**
		 * This method handels retrival of show records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getRecords()
		{
				return Self::with(['alias' => function ($query) {
						$query->checkModuleCode();
				}, 'image', 'video', 'team']);
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
		 * This method handels team relation
		 * @return  Object
		 * @since   2017-08-01
		 * @author  NetQuick
		 */
		public function team()
		{
				return $this->belongsTo('App\Team', 'varAuthor', 'id');
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
		 * This method handels video relation
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function showCategory()
		{
				return $this->belongsTo('App\ShowCategory', 'intCategoryId', 'id');
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
		public function scopeLatest($query, $id)
		{
				$response = false;
				$response = $query->groupBy('id')->where('id', '!=', $id)->orderBy('created_at', 'desc');
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
				if (isset($filterArr['orderByFieldName']) && $filterArr['orderByFieldName'] != null && $filterArr['orderTypeAscOrDesc'] != null) {
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
						die('sid');

						$data = $query->where('txtCategories', 'like', '%' . '"' . $filterArr['catFilter'] . '"' . '%');
				}

				if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
						$data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
				}

				if ((!empty($filterArr['start']) && $filterArr['start'] != ' ') && (!empty($filterArr['end']) && $filterArr['end'] != ' ')) {
						$data = $query->whereRaw('DATE(dtStartDateTime) >= DATE("' . date('Y-m-d', strtotime(str_replace('/','-',$filterArr['start']))) . '") AND DATE(dtEndDateTime) <= DATE("' . date('Y-m-d', strtotime(str_replace('/','-',$filterArr['end']))) . '")');
				}else if (!empty($filterArr['start']) && $filterArr['start'] != ' ') {
						$data = $query->whereRaw('DATE(dtStartDateTime) = DATE("' . date('Y-m-d', strtotime(str_replace('/', '-', $filterArr['start']))) . '")');
				}
				else if (!empty($filterArr['end']) && $filterArr['end'] != ' ') {
						$data = $query->whereRaw('DATE(dtEndDateTime) = DATE("' . date('Y-m-d', strtotime(str_replace('/', '-', $filterArr['end']))) . '") AND dtEndDateTime IS NOT null');
				}

				

				if (!empty($query)) {
						$response = $query;
				}
				return $response;
		}
}
