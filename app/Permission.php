<?php 
namespace App;
use Zizaco\Entrust\EntrustPermission;
class Permission extends EntrustPermission{


	public static function getPermissions(){
		$response=false;
		$permissionFields=['id','name','display_name','description','intFKModuleCode'];
		$moduleFields=['id','varTitle'];
		$response=Self::getPowerPanelRecords($permissionFields, $moduleFields)
		->get()		
		->toArray();
		return $response;
	}

	/**
	* This method get records 
	* @return  Object
	* @since   2016-08-16
	* @author  NetQuick
	*/
	static function getPowerPanelRecords($permissionFields=false, $moduleFields=false) {
		$response=false;
		$response=Self::select($permissionFields);
		if($moduleFields!=false){
			$data['modules'] = function ($query) use ($moduleFields) { $query->select($moduleFields); };
		}
		if(count($data)>0){
			$response = $response->with($data);
		}
		return $response;
	}

	/**
	 * This method handels module relation
	 * @return  Object
	 * @since   2016-07-24
	 * @author  NetQuick
	 */
	public function modules() {
			return $this->belongsTo('App\Modules', 'intFKModuleCode', 'id');
	}

	public function permissionRole(){
		return $this->hasOne('App\Permission_role','id','permission_id');
	}
}