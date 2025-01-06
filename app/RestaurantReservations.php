<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class RestaurantReservations extends Model 
{	
	protected $table = 'restaurant_reservations_lead';
	protected $fillable = [
		'id',
		'varName',
		'varEmail',
		'varPhoneNo',
		'dtDateTime',
		'varOccasions',
		'txtSplRequests',
		'chrPublish',
		'chrDelete',
    'varIpAddress'
	];
	
  public static function getCurrentMonthCount(){
    $response = false;
    $response = Self::getRecords()
    ->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())') 
    ->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
    ->count();
    return $response;
  }

  public static function getCurrentYearCount(){
    $response = false;
    $response = Self::getRecords()    
    ->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
    ->count();
    return $response;
  }
  
	/**
   * This method handels retrival of records
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  static function getRecords() {
      return self::with([]);
  }

  /**
   * This method handels backend records
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  static function getPowerPanelRecords( $moduleFields=false ) 
  {     
    $data=[];
    $response = false;
    $response=self::select($moduleFields);
    if(count($data)>0){
      $response = $response->with($data);
    }     
    return $response;
  }

  /**
   * This method handels retrival of backend record list
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  public static function getRecordList($filterArr=false){
    $response = false;
    $moduleFields=[
      'id',
      'varName',
      'varEmail',
      'varPhoneNo',
       'intPeople',
      'dtDateTime',
      'varOccasions',
      'txtSplRequests',
      'chrPublish',
      'chrDelete',
      'varIpAddress'
    ];
    $response = Self::getPowerPanelRecords($moduleFields)
    ->deleted()
    ->OrderByCreatedAtDesc()
    ->filter($filterArr)
    ->get();
    return $response;
  }

  /**
   * This method handels retrival of backend record list for Export
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  public static function getListForExport($selectedIds=false){
    $response = false;
    $moduleFields=[
      'id',
      'varName',
      'varEmail',
      'varPhoneNo',
      'dtDateTime',
      'varOccasions',
      'txtSplRequests',
      'chrPublish',
      'chrDelete',
      'varIpAddress'
    ];
    $query = Self::getPowerPanelRecords($moduleFields)->deleted();
    if(!empty($selectedIds) && count($selectedIds) > 0){
      $query->checkMultipleRecordId($selectedIds);
    }
    $response = $query->orderByCreatedAtDesc()->get();
    return $response;
  }
    
  /**
   * This method handels record id scope
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  function scopeCheckRecordId($query, $id) {
      return $query->where('id', $id);
  }

  /**
   * This method handels publish scope
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  function scopePublish($query) {
      return $query->where(['chrPublish' => 'Y']);
  }
  /**
   * This method handels delete scope
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  function scopeDeleted($query) {
      return $query->where(['chrDelete' => 'N']);
  }

  /**
   * This method check multiple records id
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  function scopeCheckMultipleRecordId($query,$Ids) 
  {
      return $query->whereIn('id',$Ids);
  }

   /**
   * This method handle order by query
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  function scopeOrderByCreatedAtDesc($query) {
      return $query->orderBy('created_at','DESC');
  }

  /**
   * This method handels filter scope
   * @return  Object
   * @since   2018-01-09
   * @author  NetQuick
   */
  function scopeFilter($query, $filterArr = false ,$retunTotalRecords = false) 
  {
        $response = null;
        if ($filterArr['orderByFieldName'] != null && $filterArr['orderTypeAscOrDesc'] != null) {
            $query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
        } else {
            $query = $query->orderBy('varName', 'ASC');
        }

        if (!$retunTotalRecords) {
            if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
                $data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
            }
        }

        if(isset($filterArr['searchFilter']) && !empty($filterArr['searchFilter'])){
            $data = $query->where('varEmail','like','%'.$filterArr['searchFilter'].'%')
            ->orWhere('varName','like','%'.$filterArr['searchFilter'].'%')
            ->orWhere('varPhoneNo','like','%'.$filterArr['searchFilter'].'%')
            ->orWhere('txtSplRequests','like','%'.$filterArr['searchFilter'].'%')
            ->orWhere('varOccasions','like','%'.$filterArr['searchFilter'].'%');
        }

        if (!empty($query)) {
            $response = $query;
        }
        return $response;
  }

}