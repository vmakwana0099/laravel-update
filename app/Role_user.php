<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
		protected $table = 'role_user';
		protected $fillable = [
			'user_id',
			'role_id'
		];
    
    public $timestamps = false;


   public static function deleteUserRole($id=null){
			$response=false;						
			$response=Self::checkUserId($id)->delete();			
			return $response;
		}

	/**
		 * This method handels role id scope
		 * @return  Object
		 * @since   2016-07-24
		 * @author  NetQuick
		 */
		function scopeCheckUserId($query, $id) {
				return $query->where('user_id', $id);
		}

  /**
	 * This method handels team relation
	 * @return  Object
	 * @since   2017-08-01
	 * @author  NetQuick
	 */
	public function roles() {
		return $this->hasMany('App\Role', 'id', 'role_id');
	}

}
