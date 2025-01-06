<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class PhotoGallery extends Model
{

		protected $table    = 'photo_gallery';
		protected $fillable = [
				'id',
				'fkIntAlbumId',
				'fkIntImgId',
				'varTitle',
				'intDisplayOrder',
				'chrDisplay',
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
				$response = Cache::tags(['PhotoGallery'])->get('getPhotoGalleryRecordByAliasID_'.$aliasID);
				if(empty($response)){
					$response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
					Cache::tags(['PhotoGallery'])->forever('getPhotoGalleryRecordByAliasID_'.$aliasID, $response);					
				}
				return $response;
		}

		/**
		 * This method handels retrival of front photoGallery list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontList($range = null, $albumId = null, $page = 1)
		{
			$response = false;
			$photoGalleryFields = ['varTitle', 'fkIntImgId', 'fkIntAlbumId'];
			$photoAlbumFields   = ['id', 'txtDescription'];
			$response = Cache::tags(['PhotoGallery'])->get('getPhotogalleryFrontList_'.$albumId.'_'.$page);
			if(empty($response)){
					$gallery = Self::getFrontRecords($photoGalleryFields, $photoAlbumFields)
					->publish()
					->deleted()
					->displayOrderBy('ASC');
					if ($albumId != null) {
						$gallery = $gallery->checkByAlbumId($albumId);
					}
					if ($range != null) {
						$gallery = $gallery->paginate($range);
					}else{
						$gallery = $gallery->get();
					}
					$response = $gallery;
					Cache::tags(['PhotoGallery'])->forever('getPhotogalleryFrontList_'.$albumId.'_'.$page, $response);					
			}
			return $response;
		}
		/**
		 * This method handels retrival of photoGallery records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getFrontRecords($photoGalleryFields = false, $photoAlbumFields = false)
		{
				$data = [];
				if ($photoAlbumFields != false) {
						$data['photoAlbum'] = function ($query) use ($photoAlbumFields) {
								$query->select($photoAlbumFields);
						};
				}
				return Self::select($photoGalleryFields)->with($data);
		}

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordByAlbumID($albumID)
		{
				$response           = false;
				$photoGalleryFields = ['id', 'fkIntAlbumId', 'fkIntImgId', 'varTitle', 'intDisplayOrder', 'chrPublish'];
				$response           = Self::getPowerPanelRecords($photoGalleryFields)
						->checkByAlbumId($albumID)
						->deleted()
						->displayOrderBy('ASC')
						->paginate(9);
				return $response;
		}

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordList()
		{
				$response           = false;
				$photoGalleryFields = ['id', 'fkIntAlbumId', 'fkIntImgId', 'varTitle', 'intDisplayOrder', 'chrPublish'];
				$response           = Self::getPowerPanelRecords($photoGalleryFields)
						->deleted()
						->displayOrderBy('ASC')
						->paginate(9);
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
				$photoAlbumFields = ['id', 'fkIntAlbumId', 'fkIntImgId', 'varTitle', 'intDisplayOrder', 'chrPublish'];
				$response         = Self::getPowerPanelRecords($photoAlbumFields)->deleted()->checkRecordId($id)->first();
				return $response;
		}
		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordByOrder($order)
		{
				$response         = false;
				$photoAlbumFields = ['id', 'intDisplayOrder'];
				$response         = Self::getPowerPanelRecords($photoAlbumFields)->deleted()->checkByDisplayOrder($order)->first();
				return $response;
		}

		/**
		 * This method handels retrival of blog records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public static function getPowerPanelRecords($photoGalleryFields = false, $aliasFields = false, $photoAlbumFields = false)
		{
				$data = [];

				if ($photoAlbumFields != false) {
						$data['photoAlbum'] = function ($query) use ($photoAlbumFields) {
								$query->select($photoAlbumFields);
						};
				}
				return Self::select($photoGalleryFields)->with($data);
		}

		/**
		 * This method handels retrival of record count based on album
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getCountById($albumId = null)
		{
				$response     = false;
				$moduleFields = ['id'];
				$response     = Self::getPowerPanelRecords($moduleFields)
						->checkByAlbumId($albumId)
						->deleted()
						->count();
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
				$moduleFields = ['id', 'fkIntAlbumId', 'fkIntImgId', 'varTitle', 'intDisplayOrder', 'chrPublish'];
				$response     = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
				return $response;
		}

		/**
		 * This method handels retrival of show records
		 * @return  Object
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public static function getRecords()
		{
				return self::with(['image', 'photoAlbum']);
		}

		/**
		 * This method handels image relation
		 * @return  Object
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public function image()
		{
				return $this->belongsTo('App\Image', 'fkIntImgId', 'id');
		}

		/**
		 * This method handels image relation
		 * @return  Object
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public function photoAlbum()
		{
				return $this->belongsTo('App\PhotoAlbum', 'fkIntAlbumId', 'id');
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
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public function scopeOrderCheck($query, $order)
		{
				return $query->where('intDisplayOrder', $order);
		}
		/**
		 * This method handels publish scope
		 * @return  Object
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public function scopePublish($query)
		{
				return $query->where(['chrPublish' => 'Y']);
		}

		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public function scopeDeleted($query)
		{
				return $query->where(['chrDelete' => 'N']);
		}

		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public function scopeCheckByDisplayOrder($query, $displayOrder)
		{
				return $query->where(['intDisplayOrder' => $displayOrder]);
		}

		/**
		 * This method handels order by display order
		 * @return  Object
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public function scopeDisplayOrderBy($query, $orderBy)
		{
				return $query->orderBy('intDisplayOrder', $orderBy);
		}

		/**
		 * This method handels order by display order
		 * @return  Object
		 * @since   2017-08-22
		 * @author  NetQuick
		 */
		public function scopeCheckByAlbumId($query, $albumId)
		{
				return $query->where('fkIntAlbumId', $albumId);
		}

}
