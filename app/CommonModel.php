<?php

namespace App;

use App\Helpers\MyLibrary;
use Config;
use DB;
use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model {

    /**
     * This method handels insert of event record
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function addRecord($data = false, $modelNameSpace = false) {
        $response = false;
        if ($data != false && !empty($data)) {
            if ($modelNameSpace == false) {
                $modelNameSpace = MyLibrary::getModelNameSpace();
            }
            $recordId = $modelNameSpace::insertGetId($data);
            if ($recordId > 0) {
                $response = $recordId;
            }
        }
        return $response;
    }

    public static function updateRecords($whereCondArr = false, $data = false, $orWhereCondArr = false, $modelNameSpace = false) {
        $response = false;
        if (!empty($whereCondArr) && !empty($data)) {
            if ($modelNameSpace == false) {
                $modelNameSpace = MyLibrary::getModelNameSpace();
            }
            $update = $modelNameSpace::where($whereCondArr);
            if ($orWhereCondArr != false) {
                $update = $update->orWhere($orWhereCondArr);
            }
            $update->update($data);
            $response = $update;
        }
        return $response;
    }

    public static function updateMultipleRecords($whereCondArr = false, $data = false, $orWhereCondArr = false, $modelNameSpace = false) {
        $response = false;
        if (!empty($whereCondArr) && !empty($data)) {
            if ($modelNameSpace == false) {
                $modelNameSpace = MyLibrary::getModelNameSpace();
            }
            $update = $modelNameSpace::whereIn('id', $whereCondArr);
            if ($orWhereCondArr != false) {
                $update = $update->orWhere($orWhereCondArr);
            }
            $update->update($data);
            $response = $update;
        }
        return $response;
    }

    public static function getRecordByOrder($modelNameSpace = false, $order = false) {
        $response = false;
        $response = $modelNameSpace::getRecordByOrder($order);
        return $response;
    }

    public static function updateOrder($objects) {
        DB::update(DB::raw("UPDATE
				nq_" . Config::get('Constant.MODULE.TABLE_NAME') . " SET `intDisplayOrder` = `intDisplayOrder` - 1
				WHERE `intDisplayOrder` > " . $objects->intDisplayOrder . "
				AND chrDelete='N'
				AND chrPublish='Y'
				AND intDisplayOrder != 0 "));
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordCount($filterArr = false, $returnCounter = false, $modelNameSpace = false) {
        $response = false;
        $moduleFields = ['id'];
        if ($modelNameSpace == false) {
            $modelNameSpace = MyLibrary::getModelNameSpace();
        }
        $response = $modelNameSpace::getPowerPanelRecords($moduleFields)->deleted();
        if ($filterArr != false) {
            $response = $response->filter($filterArr, $returnCounter);
        }
        $response = $response->count();
        return $response;
    }

    /**
     * This method handels retrival of record for delete
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordsForDeleteById($id, $modelName = false, $modelNameSpace = false) {
        $response = false;
        $moduleFields = array('id');
        if ($modelName == false) {
            $modelName = Config::get('Constant.MODULE.MODEL_NAME');
        }
        $titleField = 'varTitle';
        $displayOrderField = true;
        $nameFieldModules = array('User','GoogleContactLead');
        $awsnameFieldModules = array('AwsSupportLead');
        $varNameFieldModules = array('ContactLead', 'NewsletterLead', 'RestaurantReservations');
        if (in_array($modelName, $nameFieldModules)) {
            $titleField = 'name';
        } else if (in_array($modelName, $varNameFieldModules)) {
            $titleField = 'varName';
        } else if (in_array($modelName, $awsnameFieldModules)) {
            $titleField = 'varFirstName';
        }
        array_push($moduleFields, $titleField);
        $avoidDisplayOrderFieldModules = array('Advertise', 'CmsPage', 'StaticBlocks', 'ContactInfo', 'ContactLead', 'NewsletterLead', 'RestaurantReservations', 'AwsSupportLead','GoogleContactLead');
        if (in_array($modelName, $avoidDisplayOrderFieldModules)) {
            $displayOrderField = false;
        }
        if ($displayOrderField) {
            array_push($moduleFields, 'intDisplayOrder');
        }
        if ($modelNameSpace == false) {
            $modelNameSpace = MyLibrary::getModelNameSpace();
        }
        $response = $modelNameSpace::getPowerPanelRecords($moduleFields)->checkRecordId($id)->first();
        return $response;
    }

}
