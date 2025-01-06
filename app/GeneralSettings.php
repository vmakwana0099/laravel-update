<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;

class GeneralSettings extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'general_setting';
    protected $fillable = ['id', 'fieldName', 'fieldValue'];

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getRecords($filedArr) {
        return Self::select($filedArr);
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getSettings() {
        $response = false;
        $response = Cache::tags(['genralSettings'])->get('getSettings');
        if (empty($response)) {
            $filedArr = ['id', 'fieldName', 'fieldValue'];
            $response = Self::getRecords($filedArr)->get()->toArray();
            Cache::tags(['genralSettings'])->forever('getSettings', $response);
        }

        return $response;
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getSettingsByFieldName($fieldName) {
        $response = false;
        $response = Cache::tags(['genralSettings'])->get('getSettingsFieldname');
        if (empty($response)) {
            $filedArr = ['id', 'fieldName', 'fieldValue'];
            $response = Self::getRecords($filedArr)->checkByFieldName($fieldName)->first();
            Cache::tags(['genralSettings'])->forever('getSettingsFieldname', $response);
        }
        return $response;
    }

    /**
     * This method handels record id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckRecordId($query, $id) {
        return $query->where('id', $id);
    }

    /**
     * This method handels record id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckByFieldName($query, $fieldName) {
        return $query->where('fieldName', $fieldName);
    }

    public static function getWHMCSPriceSettings() {
        $response = false;
        $response = Cache::tags(['genralPriceSettings'])->get('getPriceSettings');
        if (empty($response)) {
            $filedArr = ['id', 'fieldName', 'INR','USD','DealsID','INR_WRONG','USD_WRONG'];
            $response = Self::getPriceRecords($filedArr)->get()->toArray();
            Cache::tags(['genralPriceSettings'])->forever('getPriceSettings', $response);
        }
        return $response;
    }
    
    public static function getPriceRecords($filedArr){
        return DB::table('whmcs_prices')->select($filedArr);
    }

    public static function deleteLogs() {
        DB::table('log')->truncate();
        DB::table('email_log')->truncate();
    }

}
