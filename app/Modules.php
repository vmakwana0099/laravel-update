<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Modules extends Model
{	

	protected $table = 'module';
	protected $fillable = [
			'id',
			'varTitle',
			'varModuleName',
			'varTableName',
			'varModelName',
			'varModuleClass',
			'decVersion',
			'intDisplayOrder',
			'chrIsFront',
			'chrIsPowerpanel',
			'chrPublish',
			'chrDelete',
			'created_at',
			'updated_at'
		];	
	
	public static function getAllModuleData($moduleName=false){
		$moduleFields=[
			'id',
			'varTitle',
			'varModuleName',
			'varTableName',
			'varModelName',
			'varModuleClass',
			'varModuleName'
		];
		$response=false;
		$response=Self::getRecords($moduleFields)
		->deleted()
		->getModuleId($moduleName)
		->first();
		return $response;
	}

	public static function getModule($moduleName=false){
		$moduleFields=['id','varModuleName'];
		$response=false;
		$response=Self::getRecords($moduleFields)
		->deleted()
		->getModuleId($moduleName)
		->orderBy('varTitle')
		->first();
		return $response;
	}

	public static function getModuleList(){
		$moduleFields=['id','varTitle','varModuleName'];
		$response = false;
		$response = Self::getRecords($moduleFields)->publish()->isFront()->deleted()->orderBy('varTitle')->get();
		return $response;
	}

	public static function getModuleListForSettings($term = ''){
		$moduleFields=['id','varTitle','varModuleName'];
		$response = false;
		$response = Self::getRecords($moduleFields)
		->publish()
		->deleted()
		->filter($term)
		->orderBy('varTitle')
		->get();
		return $response;
	}

	public static function getFrontModuleList(){
		$moduleFields=[
		'id',
		'varTitle',
		'varModelName',
		'varModuleName'];
		$response = false;
		$response = Self::getRecords($moduleFields)
		->isFront()
		->deleted()
		->publish()
		->orderBy('varTitle')
		->get();
		return $response;
	}
	
	#Database Configurations========================================
	/**
	* This method handels retrival of blog records
	* @return  Object
	* @since   2016-07-14
	* @author  NetQuick
	*/
	static function getRecords($moduleFields=false, $pageFields=false){
		$data=[];
		$response = false;
		$response = self::select($moduleFields);		
		if($pageFields!=false){
			$data['pages'] = function ($query) use ($pageFields) { $query->select($pageFields);  };
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
	* This method handels front scope
	* @return  Object
	* @since   2016-07-14
	* @author  NetQuick
	*/
	function scopeIsFront($query) {
		return $query->where(['chrIsFront' => 'Y']);
	}
	/**
	* This method handels publish scope
	* @return  Object
	* @since   2016-07-14
	* @author  NetQuick
	*/
	function scopeGetModuleId($query,$moduleName) {
		return $query->where('varModuleName' ,$moduleName);
	}

		/**
     * This method handels filter scope
     * @return  Object
     * @since   2018-01-04
     * @author  NetQuick
     */
    public function scopeFilter($query, $term = ''){
				$response = false;

				$query = $query->whereNotIn('varModuleName', [
					"settings", 
					"home", 
					"menu-type", 
					"recent-updates",
					"sitemap",
					"contact-us",
					"email-log",
					"newsletter-lead",
					"log",
					"login-history",
					"faq",
					"plugins",
					"users",
					"roles"
				]);

        if($term!=''){
        	$query = $query->where('varModuleName', 'like', "%" . $term . "%")
        	->orWhere('varTitle', 'like', "%" . $term . "%");
        }
        
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
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

	public function pages(){
		return $this->hasOne('App\CmsPage','id','intFKModuleCode');
	}
	public function log(){
		return $this->hasOne('App\Log','id','fkIntModuleId');
	}
	public function emailLog(){
		return $this->hasOne('App\EmailLog','id','fkIntModuleId');
	}
	public function banner(){
		return $this->hasOne('App\Banner','id','fkModuleId');
	}	
}
