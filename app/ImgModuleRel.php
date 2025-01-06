<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class ImgModuleRel extends Model
{
		protected $table    = 'image_module_rel';
		protected $fillable = [
			'id',
			'varTmpId',
			'intFkImgId',
			'intFkModuleCode',
			'intRecordId',
			'created_at',
			'updated_at'
		];
		protected static $fetchedID  = [];
		protected static $fetchedImg = null;

		public static function getRecord($idArr = null){
			$response = false;
			if(!empty($idArr)){
				$response = ImgModuleRel::select('intFkImgId')
				->whereIn('intFkImgId', $idArr)
				->get();
			}
			return $response;			
		}

		public static function addRecord($data = false){
        $response = false;
        if ($data != false && !empty($data)) {
            $recordId = ImgModuleRel::insertGetId($data);
            if ($recordId > 0) {
                $response = $recordId;
            }
        }
        return $response;
    }

    public static function deleteRecord($whereConditions = null){
    		$response = false;
        if (!empty($whereConditions)) {
            $response = ImgModuleRel::where($whereConditions)->delete();
        }
        return $response;	
    }
}
