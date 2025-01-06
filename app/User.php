<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Notifications\MailResetPasswordToken;
use DB;
class User extends Authenticatable {
	use EntrustUserTrait;
	use Notifiable;
	/**
  * The attributes that are mass assignable.
  *
  * @var array
  */
	protected $fillable = [
		'id','name', 'email','personalId','fkIntImgId', 'password',
	];
	/**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
	protected $hidden = [
		'password', 'remember_token',
	];

		/**
		 * This method handels retrival of record count based on category
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getCountById($categoryId=null){
			$response=false;
			$moduleFields=['id'];						
			$response = Self::getPowerPanelRecords($moduleFields)
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
		public static function getRecordListIndex(){
			$response=false;
			$moduleFields=[ 'id', 'name', 'email'];
			$roleUserFields=['user_id','role_id'];
			$roleFields = ['id', 'display_name'];
			$response = Self::getPowerPanelRecords($moduleFields, $roleUserFields, $roleFields)
			->deleted()			
			->orderById('DESC')
			->paginate(5);
			return $response;
		}

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordList($filterArr=false){
			$response=false;
			$moduleFields=[ 'id', 'name', 'email', 'chrPublish'];
			$roleUserFields=['user_id','role_id'];
			$roleFields = ['id', 'name','display_name'];
			$response = Self::getPowerPanelRecords($moduleFields, $roleUserFields, $roleFields)
			->deleted()
			->filter($filterArr)
			->orderById('DESC')						
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
			$moduleFields=[ 'id', 'name', 'email','password','chrPublish'];
			$roleUserFields=['user_id','role_id'];
			$roleFields = ['id', 'name','display_name'];
			$response = Self::getPowerPanelRecords($moduleFields, $roleUserFields, $roleFields)
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
		public static function getRecordByIdWithoutRole($id=false){
			$response=false;
			$moduleFields=[ 'id', 'name', 'email','password','chrPublish'];
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
		public static function getRecordByEmailID($emailID=false){
			$response=false;
			$moduleFields=[ 'id', 'name', 'email','personalId','fkIntImgId','password','chrPublish'];
			$response = Self::getPowerPanelRecords($moduleFields)
			->deleted()
			->CheckByEmail($emailID)
			->first();
			return $response;
		}

		public static function deleteRecordsPermanent($data=false){
			self::whereIn('id',$data)->delete();
		}


	#Database Configurations========================================
	/**
	 * This method handels retrival of blog records
	 * @return  Object
	 * @since   2016-07-14
	 * @author  NetQuick
	 */
	static function getPowerPanelRecords($moduleFields=false, $roleUsesrFields=false, $roleFields=false) 
	{			
		$data=[];
		$response=false;
		$response=self::select($moduleFields);
		
		if($roleUsesrFields!=false && $roleFields!=false)
		{

      $data['roleUser']  = function ($query) use ($roleUsesrFields) { $query->select($roleUsesrFields);};
		  $data['roles'] = function($query) use ($roleFields) { $query->select($roleFields)->deleted(); };
			
		}			
		
		if(count($data)>0){
			$response = $response->with($data);
		}			
		return $response;
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
	 * This method handels publish scope
	 * @return  Object
	 * @since   2016-07-14
	 * @author  NetQuick
	 */
	function scopePublish($query) {
		return $query->where(['chrPublish' => 'Y']);
	}

	/**
	 * This method handels publish scope
	 * @return  Object
	 * @since   2016-07-14
	 * @author  NetQuick
	 */
	function scopeCheckByEmail($query,$email) {
		return $query->where(['email' => $email]);
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
	 * This method handels orderby desc scope
	 * @return  Object
	 * @since   2016-07-14
	 * @author  NetQuick
	 */
	function scopeOrderById($query,$orderType) {
		return $query->orderBy('id',$orderType);
	}

	/**
	 * This method handels filter scope
	 * @return  Object
	 * @since   2016-07-14
	 * @author  NetQuick
	 */
	function scopeFilter($query, $filterArr = false ,$retunTotalRecords = false) {
		$response = null;
		if ($filterArr['orderByFieldName'] != null && $filterArr['orderTypeAscOrDesc'] != null) {
			$query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
		} else {
			$query = $query->orderBy('name', 'ASC');
		}

		if (!$retunTotalRecords) {
			if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
							$data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
			}
		}

		if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') 
		{
						$data = $query->where('name','like', '%' . $filterArr['searchFilter'] . '%');
						$data = $query->orWhere('email','like', '%' . $filterArr['searchFilter'] . '%');			
		}

		if (!empty($query)) {
						$response = $query;
		}

		return $response;
	}

	static function updateUserRecordByEmail($email,$data)
	{
			$user = self::where('email','=',$email)->update($data);
			return $user;
	}

	/**
		 * Send a password reset email to the user
		 */
		public function sendPasswordResetNotification($token)
		{
		    $this->notify(new MailResetPasswordToken($token,$this));
		}

	/**
	 * This method handels team relation
	 * @return  Object
	 * @since   2017-08-01
	 * @author  NetQuick
	 */
	public function roleUser() {
		return $this->belongsTo('App\Role_user', 'id', 'user_id');
	}

	public function log(){
		return $this->hasOne('App\Log','id','fkIntUserId');
	}

	public function emailLog(){
		return $this->hasOne('App\EmailType','id','fkIntUserId');
	}

	public function loginHistory(){
		return $this->hasOne('App\LoginLog','id','fkIntUserId');
	}
	
}