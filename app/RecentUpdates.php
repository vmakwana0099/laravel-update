<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use Config;
class RecentUpdates extends Model {
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $table = 'notifications';
		protected $fillable = [
			'id',
			'fkIntModuleId',
			'fkIntUserId',
			'fkIntRecordCode',
			'txtNotification',
			'txtRecentNotification',
			'chrPublish',
			'chrDelete',
			'chrRead',
			'chrRecordDelete',
			'created_at',
			'updated_at'
		];

		/**
		* This method get records 
		* @return  Object
		* @since   2016-07-14
		* @author  NetQuick
		*/
		static function getRecords($searchVal='') 
		{
			return self::with([
				'user' => function ($query) use ($searchVal) {						
						$query->where('users.email','like','%'.$searchVal.'%')
						->orWhere('users.name','like','%'.$searchVal.'%');
					},'module']);
		}

		/**
		* This method handels alias relation
		* @return  Object
		* @since   2016-07-14
		* @author  NetQuick
		*/
		public function module() {
			return $this->belongsTo('App\Modules', 'fkIntModuleId', 'id');
		}

		/**
		* This method handels alias relation
		* @return  Object
		* @since   2016-07-14
		* @author  NetQuick
		*/
		public function user() {
			return $this->belongsTo('App\User', 'fkIntUserId', 'id');
		}
		
		/**
		 * This method handels record id scope
		 * @return  Object
		 * @since   2016-07-24
		 * @author  NetQuick
		 */
		function scopeCheckRecordId($query, $id) {
				return $query->where('id', $id);
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

		function scopeFilter($query, $filterArr = false ,$retunTotalRecords = false) {
			$response = false;
				$data = '';
				$query->orderBy('updated_at',$filterArr['sort']);
				if (!empty($filterArr['startDate']) && !empty($filterArr['endDate'])) {
						if (date($filterArr['startDate']) == date($filterArr['endDate'])) {
								$data = $query->whereRaw('date(updated_at) = date("' . $filterArr['startDate'] . '")');
						} else {
								$data = $query->whereRaw('date(updated_at) BETWEEN date("' . $filterArr['startDate'] . '") AND date("' . $filterArr['endDate'] . '")');
						}
				} else {
						$data = $query->where('updated_at', '>=', Carbon::now()->subMonth());
				}				
				if (!empty($filterArr['searchFilter'])) {
						$data = $query->whereRaw('(txtRecentNotification LIKE "%' . $filterArr['searchFilter'] . '%")');
				}				
				return $response;
		}

		public static function setNotification($data = false) {
				$response = false;
				if ($data != false && !empty($data)) {
						$notificationTabel = new RecentUpdates;
						$notificationTabel->fkIntUserId = $data['fkIntUserId'];
						$notificationTabel->fkIntModuleId = $data['fkIntModuleId'];
						$notificationTabel->fkIntRecordCode = $data['fkIntRecordCode'];
						$notificationTabel->txtNotification = $data['txtNotification'];
						$notificationTabel->txtRecentNotification = $data['txtRecentNotification'];
						$notificationTabel->chrRecordDelete = isset($data['chrRecordDelete']) ? $data['chrRecordDelete'] : 'N';
						$notificationTabel->varIpAddress = $data['varIpAddress'];
						$response = $notificationTabel->save();
				}
				return $response;
		}
		static function updateRecords($id = false, $fieldsArr = false) {
				$response = false;
				if (!empty($fieldsArr) & !empty($id)) {
						$response = RecentUpdates::where([
							'fkIntRecordCode' => $id, 
							'fkIntModuleId' => Config::get('Constant.MODULE.ID') 
						])->update($fieldsArr);
				}
				return $response;
		}
}