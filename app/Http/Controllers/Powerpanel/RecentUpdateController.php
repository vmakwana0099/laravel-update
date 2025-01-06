<?php
namespace App\Http\Controllers\Powerpanel;
use Input;
use App\RecentUpdates;
use App\Http\Controllers\PowerpanelController;
use App\Helpers\MyLibrary;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\UrlGenerator;

use App\Http\Traits\time;
use Carbon\Carbon;
use App\Alias;
use App\Modules;
use Crypt;
class RecentUpdateController extends PowerpanelController {
	/**
	* Create a new controller instance.
	* @return void
	*/
	public function __construct(UrlGenerator $url) 
	{
		parent::__construct();
		$this->url = $url;
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}

	/**
	 * This method handels load log grid
	 * @return  View
	 * @since   2017-08-10
	 * @author  NetQuick
	 */
	public function index(){		
		$this->breadcrumb['title']=trans('template.recentupdate');
		return view('powerpanel.recentupdates.index',['breadcrumb'=>$this->breadcrumb,'fromDate'=>Input::get('fromDate'),'toDate'=>Input::get('toDate'),'filterValue'=>Input::get('val')]);
	}

	/**
	* This method loads recent update data on view
	* @return  View
	* @since   2017-08-10
	* @author  NetQuick
	*/
	public function get_list(Guard $auth){
		$filterArr = [];
		$records = [];
		$sessionData = $auth->user();
		if(!empty($sessionData)){
			$records["data"] = [];		
			$filterArr['startDate'] = (!empty(Input::get('fromDate')) ? date('Y-m-d', strtotime(Input::get('fromDate'))) : '');
			$filterArr['endDate'] = (!empty(Input::get('toDate')) ? date('Y-m-d', strtotime(Input::get('toDate'))) : '');
			$filterArr['sort'] = (!empty(Input::get('val')) ? Input::get('val') : '');
			$filterArr['searchFilter'] = (!empty(Input::get('searchVal')) ? Input::get('searchVal') : '');
			$notificationDataArr = RecentUpdates::getRecords()->deleted()->filter($filterArr)->get();
			if(!empty($notificationDataArr)){	
				$arrData = $this->getData($notificationDataArr, $sessionData);
			}
			return view('powerpanel.recentupdates.list',['time'=>$arrData])->render();
		}
	}	

	/**
	* This method loads recent update data
	* @return  Array
	* @since   2017-08-10
	* @author  NetQuick
	*/
	public function getData($notificationDataArr, $sessionData){
		$arrData=[];
		$modules=Modules::getModuleList()->toArray();
		$modules=array_column($modules, 'varModuleName');
		foreach ($notificationDataArr as $key => $arrDateGroup){
				$date = date('Y-m-d',strtotime($arrDateGroup->updated_at));
				$arrDateGroup->time_elapsed = time::time_elapsed_string(strtotime($arrDateGroup->updated_at));
				if($arrDateGroup->time_elapsed==0 && $arrDateGroup->time_elapsed<1){
					$arrDateGroup->time_elapsed='Just Now';
				}

				if($arrDateGroup->fkIntUserId == $sessionData['id']){
					$user = 'You have';	
				}else{
					$user = $arrDateGroup->user->name.' '.'has';
				}				
				
				if(empty($arrDateGroup->user->fk_image_id)){
					$arrDateGroup->image = $this->url->to('/resources/images/user_male4.png');
				}else{
					$arrDateGroup->image = resize_image::resize($arrDateGroup->user->fk_image_id);
				}
				
				if(!empty($arrDateGroup->txtNotification) && !empty($user)){					
					$arrDateGroup->notification = sprintf($arrDateGroup->txtNotification, $user);
				}else{
					$arrDateGroup->notification = '';
				}
				
				$arrDateGroup->date = date('M',strtotime($arrDateGroup->updated_at)).' '.date('d',strtotime($arrDateGroup->updated_at));
				$arrDateGroup->chr_record_delete = $arrDateGroup->chr_record_delete;
				$moduleName=$arrDateGroup->module->varModuleName;				
				if(in_array($moduleName, $modules)){
					$model = '\\App\\'.($moduleName=='pages'?'CmsPage':$arrDateGroup->module->varModelName);
					$record = $model::getRecords()->deleted()->checkRecordId($arrDateGroup->fkIntRecordCode)->first();					
					if(count($record)>0){
						if(isset($record->intAliasId)){
							$alias=Alias::getRecords()->checkRecordId($record->intAliasId)->first();	
							$arrDateGroup->alias = $this->url->to('/powerpanel/'.$moduleName).'/'.$alias->varAlias.'/edit';
						}else{							
							$arrDateGroup->alias = $this->url->to('/powerpanel/'.$moduleName).'/'.Crypt::encrypt($record->id).'/edit';
						}
					}else{
						$arrDateGroup->alias = 'javascript:void(0);';
					}
				}

				$arrData[$date][] = $arrDateGroup;
			}
			return $arrData;
	}

	/**
  * This method destroys RecentUpdates in multiples
  * @return  RecentUpdates index view
  * @since   2016-10-25
  * @author  NetQuick
  */
	public function DeleteRecord() {
		$data = Input::get('ids');
		$update = RecentUpdates::deleteRecordsPermanent($data);
		exit;
	}
}