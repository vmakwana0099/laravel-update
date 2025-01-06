<?php
namespace App\Helpers;
use App\ImgModuleRel;
use Validator;
use Config;

class AddImageModelRel {
	static function sync($imgArr, $recordId){

		$where=[];
		$where['intFkModuleCode']=Config::get('Constant.MODULE.ID');
		$where['intRecordId']=$recordId;
		ImgModuleRel::deleteRecord($where);

		foreach ($imgArr as $imageID) {
			if(!empty($imageID)){
				$imageRel=[];
				$imageRel['intFkModuleCode']=Config::get('Constant.MODULE.ID');
				$imageRel['intRecordId']=$recordId;
				$imageRel['intFkImgId']= $imageID;
				ImgModuleRel::addRecord($imageRel);
			}
		}		
	}
}