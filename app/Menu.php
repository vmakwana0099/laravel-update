<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Cache;
use DB;

class Menu extends Model
{	

	protected $table = 'menu';
	protected $fillable = [
		'id',
		'intParentMenuId',
		'intItemOrder',
		'intParentItemOrder',
		'chrInMobile',
		'chrInWeb',
		'intAliasId',
		'intPageId',
		'varTitle',
		'txtPageUrl',
		'intPosition',
		'chrActive',
		'chrMegaMenu',
		'chrDelete',
		'chrPublish',
		'created_at',
		'updated_at'
	];


	public static function getFrontList(){		
		$response=null;

		$response = Cache::tags(['Menu'])->get('getFrontMenuList');

		if(empty($response)){
			$menuTypeFields=['id','varTitle','chrPublish'];
			$menuFields=[
			'id',
			'varTitle',
			'intItemOrder',
			'intParentItemOrder',
			'chrInWeb',
			'chrInMobile',
			'chrActive',
			'intParentMenuId',
			'intPosition',
			'txtPageUrl',
			'chrMegaMenu'];
			$menuObj = Self::getRecords($menuFields, $menuTypeFields)->deleted();
			if(strtolower(Request::segment(1))!='powerpanel'){
				$menuObj = $menuObj->publish()->active();
			}
			$menuObj = $menuObj->orderBy('intParentItemOrder','ASC')
			->orderBy('intItemOrder', 'ASC')
//                        ->limit(4)->offset(4)    
			->get();

//                        DB::enableQueryLog();
			if(!empty($menuObj)){
				$response = array();
				foreach ($menuObj as $data) {				
				  $id = $data->intPosition;
				  if (isset($response[$id])) {
				     $response[$id][] = $data;
				  } else {
				     $response[$id] = array($data);
				  }
				}
				asort($response);
			}
			Cache::tags(['Menu'])->forever('getFrontMenuList', $response);		
		}
		return $response;
	}
        
        
        public static function getTopMenuData(){
                $data = DB::table('product_category')
                        ->select('product_category.varTitle','product_category.id','alias.varAlias')
                        ->leftJoin('alias', 'product_category.intAliasId', '=', 'alias.id')
                        ->whereIn('product_category.id', [1, 2, 3, 4, 8])
                        ->orderby('product_category.id','asc')
                        ->get();
                return $data;
        }


	/**
	 * This method handels retrival of record count
	 * @return  Object
	 * @since   2017-10-16
	 * @author  NetQuick
	 */
	public static function getRecordById($id=false){
		$response=null;		
		$response = Self::getMenuItem($id);
		return $response;
	}
        
        public static function getMegaMenuData(){
                $data = DB::table('menu')
                        ->select('varTitle','id','txtPageUrl')
                        ->where('intParentMenuId','3')
                        ->orderby('id','asc')
                        ->get();
                return $data;
              
        }

        public static function getMenuItem($itemId=false){
		$response=null;
		$menuFields=['id', 'varTitle', 'txtPageUrl'];
		$response = Self::getRecords($menuFields)
		->checkRecordId($itemId)
		->first();
		return $response;
	}

	public static function getItemCount($whereArr=false){
		$response=null;
		$menuFields=['id'];		
		$response = Self::getRecords($menuFields)
		->whereCheck($whereArr)
		->count();
		return $response;
	}

	public static function checkHasChild($parentId=false){
		$response=null;
		$menuFields=['id'];		
		$response = Self::getRecords($menuFields)
		->deleted()
		->publish()
		->checkParentRecordId($parentId)
		->first();
		return $response;
	}


	#Config############################################################################
	/**
	 * This method handels alias relation
	 * @return  Object
	 * @since   04-08-2017
	 * @author  NetQuick
	 */
	public function alias() {
			return $this->belongsTo('App\Alias', 'intAliasId', 'id');
	}

	/**
	 * This method handels cms page relation
	 * @return  Object
	 * @since   04-08-2017
	 * @author  NetQuick
	 */
	public function page() {
		return $this->belongsTo('App\CmsPage', 'intPageId', 'id');
	}

	/**
	 * This method handels menu type relation
	 * @return  Object
	 * @since   04-08-2017
	 * @author  NetQuick
	 */
	public function menuType() {
		return $this->belongsTo('App\MenuType', 'intPosition', 'id');
	}

		/**
		 * This method handels retrival of menu records
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		static function getRecords($menuFields=false, $menuTypeFields=false, $aliasFields=false, $CmsPageFields=false) {
			$data=[];
			$response=null;
			if($menuFields!=false){
				$response=Self::select($menuFields);
				if($aliasFields!=false){
                                   
					$data['alias'] = function ($query) use ($aliasFields) { $query->select($aliasFields)->checkModuleCode(); };
				}
				if($menuTypeFields!=false){
                                   
					$data['menuType']= function ($query) use ($menuTypeFields) { $query->select($menuTypeFields);  };
				}
				if($CmsPageFields!=false){
                                   
					$data['page']=function ($query) use ($CmsPageFields) { $query->select($CmsPageFields);  };
				}
				if(count($data)>0){
					$response = $response->with($data);
				}
			}
			return $response;
		}

		
		/**
		 * This method handels record id scope
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopeCheckRecordId($query, $id) {
				return $query->where('id', $id);
		}

		/**
		 * This method handels parent record id scope
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopeCheckParentRecordId($query, $id) {
				return $query->where('intParentMenuId', $id);
		}

		/**
		 * This method handels alias id scope
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopeCheckAliasId($query, $id) {
				return $query->where('intAliasId', $id);
		}
		/**
		 * This method handels item order scope
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopeItemOrderCheck($query, $order) {
				return $query->where('intItemOrder', $order);
		}
		/**
		 * This method handels parent item order scope
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopeItemParentItemOrderCheck($query, $order) {
			return $query->where('intParentItemOrder', $order);
		}
		/**
		 * This method handels scope for various where get calls
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopeWhereCheck($query, $whereArray) {
			return $query->where($whereArray);
		}		
		/**
		 * This method handels publish scope
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopePublish($query) {
				return $query->where(['chrPublish' => 'Y']);
		}
		/**
		 * This method handels active scope
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopeActive($query) {
				return $query->where(['chrActive' => 'Y']);
		}
		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   04-08-2017
		 * @author  NetQuick
		 */
		function scopeDeleted($query) {
				return $query->where(['chrDelete' => 'N']);
		}

		/**
		 * This method handels menu type check scope
		 * @return  Object
		 * @since   11-10-2017
		 * @author  NetQuick
		 */
		function scopeCheckMenuType($query,$position) {
				return $query->where(['intPosition' => $position])
				->orderBy('intParentItemOrder', 'ASC')
				->orderBy('intItemOrder', 'ASC');
		}

	#End Config##################################################################

	/**
	* This method loads menu data for powerpanel side
	* @return  Object
	* @since   04-08-2017
	* @author  NetQuick
	*/
	public static function getMenuObject($position){
		$response = false;
		$response = DB::select(DB::raw('SELECT *
		FROM `nq_menu`
		WHERE intPosition = '.$position.'
		AND	chrDelete="N"
		ORDER BY `intParentItemOrder` ASC, `intItemOrder` ASC')
		);
		return $response;
	}

	/**
	* This method loads menu data for front side
	* @return  Object
	* @since   09-08-2017
	* @author  NetQuick
	*/
        
       
	public static function getMenuObjectFront($position){
		$response = false;
		$response = DB::select(DB::raw('SELECT *
		FROM `nq_menu`
		WHERE intPosition = '.$position.'
		AND `chrDelete` = "N"
		AND `chrPublish` = "Y"
		AND `chrActive` = "Y" 
		ORDER BY `intParentItemOrder` ASC, `intItemOrder` ASC')
		);
		return $response;
	}	
}