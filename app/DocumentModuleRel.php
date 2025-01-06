<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class DocumentModuleRel extends Model
{
		protected $table    = 'document_module_rel';
		protected $fillable = [
			'id',
			'varTmpId',
			'intFkDocumentId',
			'intFkModuleCode',
			'intRecordId',
			'created_at',
			'updated_at'
		];

		public static function getRecord($idArr = null){
			$response = false;
			if(!empty($idArr)){
				$response = DocumentModuleRel::select('intFkDocumentId')
				->whereIn('intFkDocumentId', $idArr)
				->get();
			}
			return $response;			
		}

		public static function addRecord($data = false){
        $response = false;
        if ($data != false && !empty($data)) {
            $recordId = DocumentModuleRel::insertGetId($data);
            if ($recordId > 0) {
                $response = $recordId;
            }
        }
        return $response;
    }

    public static function deleteRecord($whereConditions = null){
    		$response = false;
        if (!empty($whereConditions)) {
            $response = DocumentModuleRel::where($whereConditions)->delete();
        }
        return $response;	
    }
}
