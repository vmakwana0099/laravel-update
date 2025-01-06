<?php
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table    = 'roles';
    protected $fillable = ['id', 'name', 'display_name', 'description', 'created_at', 'updated_at','chr_delete','chr_publish'];
	
	/**
	 * This method handels retrival of record count
	 * @return  Object
	 * @since   2017-10-16
	 * @author  NetQuick
	 */
	public static function getRecordList($filterArr=false){
			$response=false;
			$moduleFields=[
				'id',
				'name',
				'display_name',
				'description'
			];			
			$response = Self::getPowerPanelRecords($moduleFields)
			->deleted()
			->filter($filterArr)
			->get();
			return $response;
		}

		/**
	 * This method handels retrival of record count
	 * @return  Object
	 * @since   2017-10-16
	 * @author  NetQuick
	 */
	public static function getRecordListing($filterArr=false){
			$response=false;
			$moduleFields=[
				'id',				
				'display_name'				
			];			
			$response = Self::getPowerPanelRecords($moduleFields)
			->deleted()			
			->pluck('display_name','id');
			return $response;
		}
	
		/**
		 * This method handels retrival of record
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordById($id=false){
			$response=false;			
			$moduleFields=[
				'id',
				'name',
				'display_name',
				'description'
			];
			$pageFields=['id'];			
			$response = Self::getPowerPanelRecords($moduleFields)
			->deleted()
			->checkRecordId($id)
			->first();
			return $response;
		}
		/**
		 * This method handels update record
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function updateRecord($id=false, $data=false){
			$response=false;			
			$response = Self::where('id',$id)->update($data);
			return $response;
		}

		/**
		 * This method handels retrival of record by id for Log Manage
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getRecordForLogById($id)
		{
			$response = false;
			$moduleFields=[
				'id',
				'name',
				'display_name',
				'description'];
			$response =  Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
			return $response;
		}


	#Database Configurations========================================
	/**
	 * This method handels retrival of front end records
	 * @return  Object
	 * @since   2016-07-14
	 * @author  NetQuick
	 */
	static function getFrontRecords($moduleFields=false) {
		$response = false;
		$response = self::select($moduleFields);
		return $response;
	}

	/**
	 * This method handels retrival of backednd records
	 * @return  Object
	 * @since   2016-07-14
	 * @author  NetQuick
	 */
	static function getPowerPanelRecords($moduleFields=false){
		$data=[];
		$response = false;
		$response = self::select($moduleFields);
		return $response;
	}
    /**
     * This method get records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getRecords($searchVal = '')
    {
        return self::with([]);
    }
    /**
     * This method handels record id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckRecordId($query, $id)
    {
        return $query->where('id', $id);
    }
    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeDeleted($query)
    {
        return $query->where(['chr_delete' => 'N']);
    }

    public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false)
    {
        $response = null;
        if ($filterArr['orderByFieldName'] != null && $filterArr['orderTypeAscOrDesc'] != null) {
            $query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
        } else {
            $query = $query->orderBy('name', 'DESC');
        }
        if (!$retunTotalRecords) {
            if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
                $data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
            }
        }
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('name', 'like', "%" . $filterArr['searchFilter'] . "%");
            $data = $query->orWhere('display_name', 'like', "%" . $filterArr['searchFilter'] . "%");
        }
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }
}
