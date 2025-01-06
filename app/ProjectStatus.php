<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $table    = 'project_status';
    protected $fillable = [
        'id',
        'varTitle',
        'intDisplayOrder',
        'chrPublish',
        'chrDelete',
    ];

    /**
     * This method handels backend records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false) {
        $data     = [];
        $response = false;
        $response = self::select($moduleFields);
        if (count($data) > 0) {
            $response = $response->with($data);
        }
        return $response;
    }

    public static function getProjectStatus() {
        $response = false;
        $statusFields = ['id', 'varTitle', 'intDisplayOrder'];
        $statusData = Self::getPowerPanelRecords($statusFields)->get();
        $statusArray = array();
        if(count($statusData) > 0) {
            foreach($statusData as $status) {
                $statusArray[] = array('id' => $status['id'], 'text' => $status['varTitle']);
            }
            $response = $statusArray;
        }
        return $response;
    }
    
    public static function getStatusDetail($id = false) {
        $response = false;
        if(is_numeric($id)) {
            $statusFields = ['id', 'varTitle', 'intDisplayOrder'];
            $statusData = Self::getPowerPanelRecords($statusFields)->where('id', $id)->first();
            $response = $statusData;
        }
        return $statusData;
    }
}
