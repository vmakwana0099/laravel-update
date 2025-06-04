<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class PhotoAlbum extends Model
{

		protected $table    = 'photo_album';
		protected $fillable = ['id', 'intAliasId', 'fkIntImgId', 'varTitle', 'txtDescription', 'intDisplayOrder', 'cheDisplay', 'chrPublish', 'chrDelete', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'created_at', 'updated_at'];

		/**
		 * This method handels retrival of front blog detail
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getRecordIdByAliasID($aliasID)
		{
				$response = false;
				$response = Cache::tags(['PhotoAlbum'])->get('getPhotoAlbumRecordIdByAliasID_'.$aliasID);
				if(empty($response)){
					$response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
					Cache::tags(['PhotoAlbum'])->forever('getPhotoAlbumRecordIdByAliasID_'.$aliasID, $response);					
				}
				return $response;
		}

		/**
		 * This method handels retrival of front photoAlbum list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontList($range = false, $filterArr = false, $page=1)
		{
				$photoAlbumFields  = ['id', 'varTitle', 'fkIntImgId', 'intAliasId', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'];
				$aliasFields       = ['id', 'varAlias'];
				$imageFields       = ['id'];
				$photoGalaryFields = ['fkIntAlbumId'];
				$response = Cache::tags(['PhotoAlbum'])->get('getPhotoAlbumFrontList_'.$page);				
				if(empty($response)){
					$response = Self::getFrontRecords($photoAlbumFields, $aliasFields, $imageFields, $photoGalaryFields)->orderBy('created_at', 'desc')
					->deleted()
					->publish()
					->filter($filterArr)->displayOrderBy('ASC')
					->paginate($range);
					Cache::tags(['PhotoAlbum'])->forever('getPhotoAlbumFrontList_'.$page, $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of front photoAlbum list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontDropDownList($range = false, $filterArr = false)
		{
				$photoAlbumFields = ['id', 'varTitle'];
				$response = Cache::tags(['PhotoAlbum'])->get('getPhotoAlbumgetFrontDropDownList');				
				if(empty($response)){
					$response = Self::getFrontRecords($photoAlbumFields)->orderBy('created_at', 'desc')
					->deleted()
					->publish()
					->get()
					->pluck('varTitle', 'id')
					->toArray();
					Cache::tags(['PhotoAlbum'])->forever('getPhotoAlbumgetFrontDropDownList', $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of front photoAlbum list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getAlbumForGalaryList($id = null)
		{
				$photoAlbumFields = ['id', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'];
				$response = Cache::tags(['PhotoAlbum'])->get('getPhotoAlbumForGalaryList_'.$id);					
				if(empty($response)){	
					$response = Self::select($photoAlbumFields)->checkAliasId($id)->publish()
					->deleted()
					->get();
					Cache::tags(['PhotoAlbum'])->forever('getPhotoAlbumForGalaryList_'.$id, $response);
				}
				return $response;
		}

		/**
		 * This method handels retrival of photoAlbum records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getFrontRecords($photoAlbumFields = false, $aliasFields = false, $imageFields = false, $photoGalleryFields = false)
		{
				$data     = [];
				$response = false;
				$response = self::select($photoAlbumFields);
				if ($imageFields != false) {
						$data['image'] = function ($query) use ($imageFields) {
								$query->select($imageFields);
						};
				}
				if ($aliasFields != false) {
						$data['alias'] = function ($query) use ($aliasFields) {
								$query->select($aliasFields);
						};
				}
				if ($photoGalleryFields != false) {
						$data['photoGallery'] = function ($query) use ($photoGalleryFields) {
								$query->select($photoGalleryFields);
						};
				}

				if (count($data) > 0) {
						$response = $response->with($data);
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
				$response         = false;
				$photoAlbumFields = ['id', 'intAliasId', 'fkIntImgId', 'varTitle', 'txtDescription', 'intDisplayOrder', 'chrPublish'];
				$response         = Self::getPowerPanelRecords($photoAlbumFields)->deleted()
						->filter($filterArr)->get();
				return $response;
		}

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordsWithAlias()
		{
				$response         = false;
				$photoAlbumFields = ['id', 'intAliasId', 'fkIntImgId', 'varTitle', 'txtDescription', 'intDisplayOrder', 'chrPublish'];
				$aliasFields      = ['id', 'varAlias'];
				$response         = Self::getPowerPanelRecords($photoAlbumFields, $aliasFields)->deleted()
						->get();
				return $response;
		}

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordById($id)
		{
				$response         = false;
				$photoAlbumFields = ['id', 'intAliasId', 'fkIntImgId', 'varTitle', 'txtDescription', 'intDisplayOrder', 'chrPublish', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'];
				$aliasFields      = ['id', 'varAlias'];
				$response         = Self::getPowerPanelRecords($photoAlbumFields, $aliasFields)->deleted()
						->checkRecordId($id)->first();
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
				$moduleFields = ['id', 'fkIntImgId', 'varTitle', 'txtDescription', 'intDisplayOrder', 'chrPublish', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'];
				$response     = Self::getPowerPanelRecords($moduleFields)->deleted()
						->checkRecordId($id)->first();
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
				$moduleFields = ['id', 'intDisplayOrder'];
				if (!in_array($order, Self::$fetchedOrder)) {
						array_push(Self::$fetchedOrder, $order);
						Self::$fetchedOrderObj = Self::getPowerPanelRecords($moduleFields)->deleted()
								->orderCheck($order)->first();
				}
				$response = Self::$fetchedOrderObj;
				return $response;
		}

		/**
		 * This method handels retrival of blog records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getPowerPanelRecords($photoAlbumFields = false, $aliasFields = false, $photoGalleryFields = false)
		{
				$data = [];
				if ($aliasFields != false) {
						$data['alias'] = function ($query) use ($aliasFields) {
								$query->select($aliasFields);
						};
				}
				if ($photoGalleryFields != false) {
						$data['photoGallery'] = function ($query) use ($photoGalleryFields) {
								$query->select($photoGalleryFields);
						};
				}
				return self::select($photoAlbumFields)->with($data);
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

		public function photoGallery()
		{
				return $this->hasMany('App\PhotoGallery', 'fkIntAlbumId', 'id');
		}

		/**
		 * This method handels retrival of show records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getRecords()
		{
				return self::with(['alias', 'image']);
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
		 * This method handels delete scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopeDisplayOrderBy($query, $orderBy)
		{
				return $query->orderBy('intDisplayOrder', $orderBy);
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
				if (!empty($query)) {
						$response = $query;
				}
				return $response;
		}

}
