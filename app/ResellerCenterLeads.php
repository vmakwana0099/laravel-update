<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Request;
use App\Helpers\MyLibrary;

class ResellerCenterLeads extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resellercenter_lead';
    protected $fillable = [
        'id',
        'fkIntServiceId',
        'varName',
        'varEmail',
        'varPhoneNo',
        'txtUserMessage',
        'chrDelete',
        'varIpAddress',
        'chrIsPrimary',
        'created_at',
        'updated_at'
    ];

    public static function getCurrentMonthCount() {
        $response = false;
        $response = Self::getRecords()
                ->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')
                ->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
                ->count();
        return $response;
    }

    public static function getCurrentYearCount() {
        $response = false;
        $response = Self::getRecords()
                ->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
                ->count();
        return $response;
    }

    /**
     * This method handels retrival of event records
     * @return  Object
     * @since   2017-08-02
     * @author  NetQuick
     */
    static function getRecords() {
        return self::with([]);
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordById($id, $moduleFields = false) {
        $response = false;
        $moduleFields = ['id','user_message','phone_number','workemail','fullname','interestedin','companyname','companyurl','businesstype','totalcustomer','countrydata', 'chrDelete', 'varIpAddress', 'created_at', 'updated_at'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    /**
     * This method handels backend records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    static function getPowerPanelRecords($moduleFields = false) {
        $data = [];
        $response = false;
        $response = self::select($moduleFields);
        if (count($data) > 0) {
            $response = $response->with($data);
        }
        return $response;
    }

    public static function getCategoriesData($id) {
        $response = false;
        $moduleFields = ['varTitle'];
        $response = DB::table('contact_type')
                ->select($moduleFields)
                ->where(['id' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->first();
        return $response;
    }
    public static function getCategoriesAllData() {
        $response = false;
        $moduleFields = ['varTitle','id'];
        $response = DB::table('contact_type')
                ->select($moduleFields)
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of backend record list
     * @return  Object
     * @since   2017-10-24
     * @author  NetQuick
     */
    public static function getRecordList($filterArr = false) {
        $response = false;
        $moduleFields = ['id','user_message','phone_number','workemail','fullname','interestedin','companyname','companyurl','businesstype','totalcustomer','countrydata','varIpAddress','created_at'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->deleted()
                //->filter($filterArr)
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of backend record list for Export
     * @return  Object
     * @since   2017-10-24
     * @author  NetQuick
     */
    public static function getListForExport($selectedIds = false) {
        $response = false;
        $moduleFields = [ 'id','user_message','phone_number','workemail','fullname','interestedin','companyname','companyurl','businesstype','totalcustomer','countrydata','created_at'];
        $query = Self::getPowerPanelRecords($moduleFields)->deleted();
        if (!empty($selectedIds) && count($selectedIds) > 0) {
            $query->checkMultipleRecordId($selectedIds);
        }
        $response = $query->orderByCreatedAtDesc()->get();
        return $response;
    }

    public static function getContactType() {
        $response = DB::table('contact_type')
                ->select(['varTitle', 'id'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->get();
        $returnHtml = '';
        $returnHtml .="<select id=\"var_Category\" name=\"var_Category\" class=\"selectpicker form-control\">";
        $returnHtml .="<option value=''>Choose Category</option>";
        foreach ($response as $row) {
            $returnHtml .='<option value="' . $row->id . '">' . $row->varTitle . '</option>';
        }
        $returnHtml .="</select>";
        return $returnHtml;
    }

    public static function getContactTypeName($id) {
        $response = DB::table('contact_type')
                ->select(['varTitle'])
                ->where(['id' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->first();
        return $response;
    }
    //Shrey Add ->where(['fkCategory'=> '17'])
    public static function getFaqRecords() {
        $response = DB::table('general_faq')
                ->select(['varTitle', 'txtDescription'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->where(['fkCategory'=> '17'])
                ->orderBy('intDisplayOrder')
                ->get();
        return $response;
    }
    //Shrey

    public static function getFeaturedProductsRecords() {
        $response = DB::table('featured_products')
                ->select(['varTitle', 'varShortDescription', 'varIconClass', 'varFeature', 'varButtonName', 'varButtonLink', 'varWHMCSFieldName'])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->limit(2)
                ->get();
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
     * @since   2017-08-02
     * @author  NetQuick
     */
    function scopePublish($query) {
        return $query->where(['chrPublish' => 'Y']);
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2017-08-02
     * @author  NetQuick
     */
    function scopeDeleted($query) {
        return $query->where(['chrDelete' => 'N']);
    }

    /**
     * This method check multiple records id
     * @return  Object
     * @since   2017-08-02
     * @author  NetQuick
     */
    function scopeCheckMultipleRecordId($query, $Ids) {
        return $query->whereIn('id', $Ids);
    }

    /**
     * This method handle order by query
     * @return  Object
     * @since   2017-08-02
     * @author  NetQuick
     */
    function scopeOrderByCreatedAtDesc($query) {
        return $query->orderBy('created_at', 'DESC');
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2017-08-02
     * @author  NetQuick
     */
    function scopeFilter($query, $filterArr = false, $retunTotalRecords = false) {
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
        if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
            $data = $query->where('chrPublish', $filterArr['statusFilter']);
        }
        if (isset($filterArr['searchFilter']) && !empty($filterArr['searchFilter'])) {
            $emails = MyLibrary::encrypt_decrypt('encrypt', $filterArr['searchFilter']);
            $data = $query->where('varName', 'like', '%' . $filterArr['searchFilter'] . '%')->orwhere('varEmail', 'like', '%' . $emails . '%');
        }
        if (!empty($filterArr['categoryfilter']) && $filterArr['categoryfilter'] != ' ') {
            $data = $query->where('fkIntServiceId', $filterArr['categoryfilter']);
        }
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

}
