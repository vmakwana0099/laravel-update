<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
		protected $table    = 'documents';
		protected $fillable = [
				'id',
				'fkIntUserId',
				'txtDocumentName',
				'txtSrcDocumentName',
				'varDocumentExtension',
				'chrIsUserUploaded',
				'chrPublish',
				'chrDelete',
		];

		public static function getDocuments($limit, $page, $position = 0,$filter=false)
		{
				$response       = false;
				$documentFields = ['id', 'txtDocumentName', 'txtSrcDocumentName', 'varDocumentExtension', 'chrPublish'];
				$response       = Self::select($documentFields)
						->publish()
						->deleted()
						->skip($position);
						if(isset($filter['docName'])){
								$response = $response->searchByName($filter['docName']);
						}						
						$response = $response->take($limit, $page)
						->orderBy('id', 'DESC')
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
				$response       = false;
				$documentFields = ['id', 'txtDocumentName', 'txtSrcDocumentName', 'varDocumentExtension', 'chrIsUserUploaded', 'chrPublish'];
				$response       = Self::select($documentFields)->checkRecordId($id)->publish()->deleted()->first();
				return $response;
		}

		public static function getRecentUploadedImages()
		{
				$response       = false;
				$documentFields = ['id', 'txtDocumentName', 'txtSrcDocumentName', 'varDocumentExtension'];
				$response       = Self::select($documentFields)
						->publish()
						->deleted()
						->orderBy('id', 'DESC')
						->take(10)
						->get();

				return $response;
		}

		public static function getTrashedDocuments()
		{
				$response       = false;
				$documentFields = ['id', 'txtDocumentName', 'txtSrcDocumentName', 'varDocumentExtension'];
				$fetchedDoc     = Self::select($documentFields)
						->deletedYes()
						->take(15)
						->get();

				$response = $fetchedDoc;
				return $response;
		}

		public static function getAllTrashedDocumentsIds()
		{
				$response       = false;
				$documentFields = ['id', 'txtDocumentName', 'txtSrcDocumentName', 'varDocumentExtension'];
				$fetchedDocs     = Self::select($documentFields)
						->deletedYes()
						->get();

				$response = $fetchedDocs;
				return $response;
		}

		public static function getRecordCount()
		{
				$response      = false;
				$moduleFields  = ['id'];
				$moduleRecords = Self::select($moduleFields);
				$response      = $moduleRecords->deleted()->count();
				return $response;
		}

		/**
		 * This method handels search by image name query
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopeSearchByName($query, $docName = false)
		{
				if (!empty($docName) && $docName != false) 
				{
						return $query->where('txtDocumentName', 'like', ''.$docName.'%');
				} else {
						return false;
				}
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
		 * This method handels publish scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopePublish($query)
		{
				return $query->where('chrPublish', 'Y');
		}
		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopeDeleted($query)
		{
				return $query->where('chrDelete', 'N');
		}

		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function scopeDeletedYes($query)
		{
				return $query->where(['chrDelete' => 'Y']);
		}
		/**
		 * This method handle order by query
		 * @return  Object
		 * @since   2017-08-02
		 * @author  NetQuick
		 */
		public function scopeOrderByDesc($query)
		{
				return $query->orderBy('id', 'DESC');
		}

}
