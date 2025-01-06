<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_role extends Model
{
  	protected $table = 'permission_role';    
    public $timestamps = false;
    
	  public static function getPermissionRole($id=null){
			$response=false;			
			$moduleFields=['permission_id', 'role_id'];
			$permissionFields=['id','name', 'display_name'];
			$response=Self::getPowerPanelRecords($permissionFields, $moduleFields)
			->checkRoleId($id)
			->get()
			->toArray();
			return $response;
		}

		public static function deletePermissionRole($id=null){
			$response=false;						
			$response=Self::checkRoleId($id)->delete();
			return $response;
		}

   #Database Configurations========================================
    /**
		* This method get records 
		* @return  Object
		* @since   2016-08-16
		* @author  NetQuick
		*/
		static function getPowerPanelRecords($permissionFields=false, $moduleFields=false) {
			$response=false;
			$response=Self::select($moduleFields);
			if($moduleFields!=false){
				$data['permissionRole'] = function ($query) use ($permissionFields) { $query->select($permissionFields); };
			}
			if(count($data)>0){
				$response = $response->with($data);
			}
			return $response;
		}


    /**
		 * This method handels role-permission relation
		 * @return  Object
		 * @since   2016-08-16
		 * @author  NetQuick
		 */
		public function permissionRole() {
				return $this->belongsTo('App\Permission', 'permission_id', 'id');
		}
		/**
		* This method get records 
		* @return  Object
		* @since   2016-08-16
		* @author  NetQuick
		*/
		static function getRecords() {
			return self::with(['permissionRole']);
		}
		/**
		 * This method handels role id scope
		 * @return  Object
		 * @since   2016-07-24
		 * @author  NetQuick
		 */
		function scopeCheckRoleId($query, $id) {
				return $query->where('role_id', $id);
		}
}
