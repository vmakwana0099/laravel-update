<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Cache;
class Advertise extends Model {	
	protected $table = 'advertises';
	protected $fillable = [
		'id',		
		'fkIntImgId',
		'varTitle',
		'dtStartDateTime',
		'dtEndDateTime',
		'txtLink',
		'txtPosition',
		'varPages',
		'chrPublish',
		'chrDelete'
	];
		

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordList($filterArr=false){
			$response=false;
			$moduleFields=[ 
			'id', 			 
			'fkIntImgId',
			'varTitle',
			'varPages',
			'txtPosition',
			'varTitle',
			'fkIntImgId',	
			'chrPublish',
			'dtStartDateTime',
			'dtEndDateTime'
			];
			
			$response = Self::getPowerPanelRecords($moduleFields) 
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
		public static function getRecordById($id=false){
			$response=false;
			$moduleFields=[ 
				'id',				
				'varTitle',
				'varPages',
				'txtPosition',
				'fkIntImgId',
				'txtLink',
				'dtStartDateTime',
				'dtEndDateTime',
				'chrPublish'
			];
			
			$response = Self::getPowerPanelRecords($moduleFields)
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
		public static function getFrontRecordsByPage($page=false){
			$response=false;
			$response = Cache::rememberForever('getFrontRecordsByPage',function() use ($page)
      {
					$moduleFields=[ 
						'id',				
						'varTitle',
						'varPages',
						'txtPosition',
						'fkIntImgId',
						'txtLink',
						'dtStartDateTime',
						'dtEndDateTime',
						'chrPublish'
					];			
					return Self::getFrontRecords($moduleFields)
					->conditions([				
						['varPages','like','%"'.$page.'"%']
					])
					->deleted()
					->publish()
					->get();
			});
			return $response;
		}

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		protected static $fetchedOrder=[];
		protected static $fetchedOrderObj=null;
		public static function getRecordByOrder($order=false){
			$response = false;
			$moduleFields=[ 
			'id',
			'intDisplayOrder'
			];			
			if(!in_array($order, Self::$fetchedOrder)){
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
		 * This method handels retrival of event records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		static function getRecords() {
				return self::with(['alias' => function ($query) {
						$query->checkModuleCode();
				}, 'image']);
		}
		/**
		 * This method handels retrival of advertise records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		static function getFrontRecords($moduleFields=false) {
			$response = false;			
			$response = self::select($moduleFields);
			return $response;
		}

		/**
		 * This method handels retrival of advertise records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		static function getPowerPanelRecords($moduleFields=false, $imageFields=false) 
		{	
			$data=[];
			$response=false;
			$response=self::select($moduleFields);
			if($imageFields!=false){
				$data['image']= function ($query) use ($imageFields) { $query->select($imageFields);  };
			}		
			if(count($data)>0){
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
			$response = false;
			$moduleFields=['id',				
				'varTitle',
				'varPages',
				'txtPosition',
				'fkIntImgId',
				'txtLink',
				'dtStartDateTime',
				'dtEndDateTime',
				'chrPublish'];
			$response =  Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
			return $response;
		}		
		/**
		 * This method handels image relation
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function image() {
				return $this->belongsTo('App\Image', 'fkIntImgId', 'id');
		}		
		/**
		 * This method handels publish scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeConditions($query,$conditions) {
				return $query->where($conditions);
		}
		/**
		 * This method handels record id scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeCheckRecordId($query, $id) {
				return $query->where('id', $id);
		}
		/**
		 * This method handels order scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeOrderCheck($query, $order) {
				return $query->where('intDisplayOrder', $order);
		}
		/**
		 * This method handels publish scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopePublish($query) {
				return $query->where(['chrPublish' => 'Y']);
		}
		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeDeleted($query) {
				return $query->where(['chrDelete' => 'N']);
		}
		/**
		 * This method handels filter scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeFilter($query, $filterArr = false ,$retunTotalRecords = false) 
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
						$data = $query->where('chrPublish' ,$filterArr['statusFilter']);
				}
				if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
						$data = $query->where('varTitle','like', "%".$filterArr['searchFilter'] . "%");
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