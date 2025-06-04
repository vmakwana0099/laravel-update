<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class RestaurantMenuCategory extends Model
{
		protected $table    = 'restaurant_menu_category';
		protected $fillable = [				
				'intAliasId',
				'fkIntImgId',
				'fkIntDocId',
				'varTitle',
				'intParentCategoryId',
				'intDisplayOrder',
				'txtShortDescription',
				'txtDescription',
				'varMetaTitle',
				'varMetaKeyword',
				'varMetaDescription',
				'chrPublish',
				'chrDelete',
				'created_at',
				'updated_at',
		];
		
	 /**
   * This method handels retrival of front restaurantMenu detail
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
   
  public static function getRecordIdByAliasID($aliasID)
  {
      $response = false;
      $response = Cache::tags(['RestaurantMenuCategory'])->get('getRestaurantMenuCategoryRecordIdByAliasID_'.$aliasID);
      if(empty($response)){
      	$response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
      	Cache::tags(['RestaurantMenuCategory'])->forever('getRestaurantMenuCategoryRecordIdByAliasID_'.$aliasID, $response);
      }
      return $response;
  }

	/**
	 * This method handels retrival of front latest service list
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	public static function getFrontList(){
		$response = false;		
		$serviceFields=['id','varTitle'];
		$response = Cache::tags(['RestaurantMenuCategory'])->get('getRestaurantMenuCategoryFrontList');		
		if(empty($response)){
			$response = Self::getFrontRecords($serviceFields)
			->deleted()
			->publish()
			->get()
			->pluck('varTitle','id');
			Cache::tags(['RestaurantMenuCategory'])->forever('getRestaurantMenuCategoryFrontList', $response);
			$response = Cache::tags(['RestaurantMenuCategory'])->get('getRestaurantMenuCategoryFrontList');
		}
		return $response;
	}

	/**
	 * This method handels retrival of restaurantMenu records
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	static function getFrontRecords($moduleFields=false) {
		$response = false;
		$response = self::select($moduleFields);
		return $response;
	}

	/**
	 * This method handels retrival of restaurantMenu records
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	static function getRecords($moduleId=false) {
		$response = false;
		$response = self::with([
				'alias' => function ($query) use ($moduleId){
					$query->checkModuleCode($moduleId);
				},'parentCategory']);
		return $response;
	}


	public function alias() {
		$response = false;
		$response = $this->belongsTo('App\Alias', 'intAliasId', 'id');
		return $response;
	}


	/**
	 * This method handels alias id scope
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	function scopeCheckAliasId($query, $id) {
		$response = false;
		$response = $query->where('intAliasId', $id);
		return $response;
	}
	
	/**
	* This method handels service alias relation
	* @return  Object
	* @since   2018-01-09
	* @author  NetQuick
	*/
	public function restaurantMenu(){
		$response = false;
		$response = $this->hasOne('App\RestaurantMenu','id','intCategoryId');
		return $response;
	}

	/**
		* This method handels service sub-category relation
		* @return  Object
		* @since   2018-01-09
		* @author  NetQuick
		*/
		public function restaurantMenuCategory(){
			$response = false;
			$response = $this->hasOne('App\RestaurantMenuCategory','id','intParentCategoryId');
			return $response;
		}

		/**
		* This method handels main category relation
		* @return  Object
		* @since   2018-01-09
		* @author  NetQuick
		*/
		public function parentCategory() {
			$response = false;
			$response = $this->belongsTo('App\RestaurantMenuCategory', 'intParentCategoryId', 'id');
			return $response;
		}

	/**
	 * This method handels retrival of restaurantMenu records
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	static function getPowerPanelRecords( $categoryFields=false, $aliasFields = false ,$parentCategoryFields=false) 
	{			
		$data=[];
		$response = false;
		$response=self::select($categoryFields);
		if ($aliasFields != false) {
			$data['alias'] = function ($query) use ($aliasFields) {
				$query->select($aliasFields)->checkModuleCode();
			};
		}
				
		if ($parentCategoryFields != false) {
			$data['parentCategory'] = function ($query) use ($parentCategoryFields) {
				$query->select($parentCategoryFields);
			};
		}  

		if(count($data)>0){
			$response = $response->with($data);
		}			
		return $response;
	}

	/**
	 * This method handels retrival of record count
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	public static function getRecordList($filterArr=false){
		$response = false;
		$moduleFields=[ 'id', 'varTitle' , 'intAliasId', 'fkIntDocId', 'intParentCategoryId','intDisplayOrder','txtShortDescription','txtDescription','varMetaTitle','varMetaKeyword','varMetaDescription','chrPublish'];
		$aliasFields = ['id', 'varAlias'];
		$response = Self::getPowerPanelRecords($moduleFields,$aliasFields)
		->deleted()
		->filter($filterArr)
		->get();
		return $response;
	}

	/**
	 * This method handels retrival of record by id
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	public static function getRecordById($id)
	{
		$response = false;
		$categoryFields=['id', 'varTitle' , 'fkIntImgId', 'fkIntDocId', 'intAliasId', 'intParentCategoryId','intDisplayOrder','txtShortDescription','txtDescription','varMetaTitle','varMetaKeyword','varMetaDescription','chrPublish'];
		$aliasFields = ['id','varAlias'];
		$response =  Self::getPowerPanelRecords($categoryFields,$aliasFields)->deleted()->checkRecordId($id)->first();
		return $response;
	}

	/**
	 * This method handels retrival of record by id for Log Manage
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	public static function getRecordForLogById($id)
	{
		$response = false;
		$moduleFields=['id', 'varTitle', 'fkIntDocId', 'intParentCategoryId','intDisplayOrder','txtShortDescription','txtDescription','varMetaTitle','varMetaKeyword','varMetaDescription','chrPublish'];
		$response =  Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
		return $response;
	}
	/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2018-01-09
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
	/**
	 * This method handels retrival of Parent Category record by id
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	public static function getParentCategoryNameBycatId($ids)
	{
		$response = false;
		$categoryFields=['varTitle'];
		$response =  Self::getPowerPanelRecords($categoryFields)->deleted()->whereIn('id',$ids)->get();
		return $response;
	}

	/**
	 * This method handels retrival of record for category item
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	public static function getRecordsForItem()
	{
		$response = false;
		$restaurantMenuCategoryPageFields=['id', 'varTitle' , 'fkIntDocId', 'intAliasId', 'intParentCategoryId'];
		$aliasFields = ['id','varAlias'];
		$response =  Self::getPowerPanelRecords($restaurantMenuCategoryPageFields,$aliasFields)
		->deleted()
		->publish()
		->get()
		->toArray();
		return $response;
	}

	public static function getCatWithParent(){
		$response = false;
		$categoryFields=[ 'id', 'intParentCategoryId', 'varTitle'];
		$parentCategoryFields=[ 'id', 'varTitle' ];		
		$response = Self::getPowerPanelRecords($categoryFields, false, $parentCategoryFields) 
		->deleted()
		->publish()		
		->get();
		return $response;
	}

	/**
		* This method handels retrival of record count based on category
		* @return  Object
		* @since   2018-01-09
		* @author  NetQuick
		*/
		public static function getCountById($categoryId = null)
		{
				$response     = false;
				$moduleFields = ['id'];
				$response     = Self::getPowerPanelRecords($moduleFields)
						->checkCategoryId($categoryId)
						->deleted()
						->count();
				return $response;
		}

	/**
	 * This method handels retrival of category Record
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	public static function getCategories(){
		$response = false;
		$moduleFields=[ 'id', 'varTitle','intParentCategoryId' ];
		$response = Self::select($moduleFields)
		->deleted()
		->publish(); 
		return $response;
	}

	/**
	 * This method handels alias id scope
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	function scopeCheckParentCategoryId($query, $id) {
		$response = false;
		$response = $query->where('id', $id);
		return $response;
	}

	/**
	 * This method handels record id scope
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	function scopeCheckRecordId($query, $id) {
		$response = false;
		$response = $query->where('id', $id);
		return $response;
	}

	/**
	 * This method handels order scope
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	function scopeOrderCheck($query, $order) {
		$response = false;
		$response = $query->where('intDisplayOrder', $order);
		return $response;
	}
	/**
	 * This method handels publish scope
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	function scopePublish($query) {
		$response = false;
		$response = $query->where(['chrPublish' => 'Y']);
		return $response;
	}
	/**
	 * This method handels delete scope
	 * @return  Object
	 * @since   2018-01-09
	 * @author  NetQuick
	 */
	function scopeDeleted($query) {
		$response = false;
		$response = $query->where(['chrDelete' => 'N']);
		return $response;
	}

	function scopeGroupByTitle($query) {
		$response = false;
		$response = $query->groupBy('varTitle');
		return $response;
	}
	function scopeOrderByDisplay($query) {
		$response = false;
		$response = $query->orderBy('intDisplayOrder','ASC');
		return $response;
	}
	/**
		* This method handels category id scope
		* @return  Object
		* @since   2018-01-09
		* @author  NetQuick
		*/
		public function scopeCheckCategoryId($query, $id)
		{
				$response = false;
				$response = $query->where('intParentCategoryId',  $id);
				return $response;
		}	
	function scopeFilter($query, $filterArr = false ,$retunTotalRecords = false) {
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
		if (!empty($query)) {
				$response = $query;
		}
		return $response;
	}

}