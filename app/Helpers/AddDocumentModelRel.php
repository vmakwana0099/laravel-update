<?php
namespace App\Helpers;
use App\DocumentModuleRel;
use Validator;
use Config;

class AddDocumentModelRel {
	static function sync($documentArr, $recordId){

		$where=[];
		$where['intFkModuleCode']=Config::get('Constant.MODULE.ID');
		$where['intRecordId']=$recordId;
		DocumentModuleRel::deleteRecord($where);

		foreach ($documentArr as $documentID) {
			if(!empty($documentID)){
				$documentRel=[];
				$documentRel['intFkModuleCode']=Config::get('Constant.MODULE.ID');
				$documentRel['intRecordId']=$recordId;
				$documentRel['intFkDocumentId']=$documentID;
				DocumentModuleRel::addRecord($documentRel);
			}			
		}		
	}
}