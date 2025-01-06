<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\CommonModel;
use DB;
class LoginLog extends Model{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $table = 'login_history';
		protected $fillable = [			
			'id',
			'fkIntUserId',
                        'logintype',
			'varIpAddress',
			'created_at',
			'updated_at'		
		];

		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   2017-10-14
		 * @author  NetQuick
		 */
		function scopeDeleted($query) {
			return $query->where(['chrDelete' => 'N']);
		}

		/**
		 * This method handels retrival of event records
		 * @return  Object
		 * @since   2017-10-14
		 * @author  NetQuick
		 */
		static function getRecords($searchVal='') {
		
			return self::with([
				'user' => function ($query) use ($searchVal) {						
						$query->where('users.email','like','%'.$searchVal.'%')
						->orWhere('users.name','like','%'.$searchVal.'%');
					}]);
		}

		// public static function getRecordsUser() {
		
		//   return  Self::getRecords()
		// 		    	->where('fkIntUserId','=','4')
		// 			    ->deleted()
		// 			    ->publish()
		// 			    ->get();
		// }


		public static function deleteRecordsPermanent($data=false){
			self::whereIn('id',$data)->delete();
		}

		/**
		* This method handels alias relation
		* @return  Object
		* @since   2016-10-14
		* @author  NetQuick
		*/
		public function user() {
			return $this->belongsTo('App\User', 'fkIntUserId', 'id');
		}

   // public function getPermissions(){
   // 	self::where('id',$data)->delete();
   // }

		/**
		 * This method handels filter scope
		 * @return  Object
		 * @since   2017-08-02
		 * @author  NetQuick
		 */
		function scopeFilter($query, $filterArr = false ,$retunTotalRecords = false) 
		{
				$response = null;
				if ($filterArr['orderByFieldName'] != null && $filterArr['orderTypeAscOrDesc'] != null) {
					$query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
				} else {
					$query = $query->orderBy('id', 'DESC');
				}

				if (!$retunTotalRecords) {
					if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
						$data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
					}
				}
				if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
					$data = $query->where('varIpAddress' ,$filterArr['statusFilter']);
				}
				
				if (!empty($query)) {
					$response = $query;
				}
				return $response;
		}
}
