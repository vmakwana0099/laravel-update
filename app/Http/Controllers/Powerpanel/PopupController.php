<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\PopUpContent;
use App\Log;
use App\RecentUpdates;
use Validator;
use Auth;
use App\Helpers\MyLibrary;
use App\CommonModel;
use Carbon\Carbon;
use Config;

class PopupController extends PowerpanelController {
	/**
	* Create a new controller instance.
	* @return void
	*/
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}

	public function index() 
	{
		$popup = PopUpContent::getPopupContent();
		
		$this->breadcrumb['title']=trans('template.common.edit').' Popup Content';
		$this->breadcrumb['module']=trans('template.managePopup.managepopup');		
		$this->breadcrumb['inner_title']= trans('template.common.edit').' - '.(isset($popup->varTitle)?$popup->varTitle:'');
		return view('powerpanel.managepopup.popupcontent',['popup'=> $popup,'breadcrumb'=>$this->breadcrumb]);
	}

	public function handleEditPost() {
		$postArr = Input::all();
		$rules = [
				'title' => 'required|max:160',
				'start_date_time' => 'required',			
				'chrMenuDisplay' => 'required'
		];
		
		$validator = Validator::make($postArr, $rules);
		if($validator->passes())
		{			

			$popup = PopUpContent::getPopupContent();
			$updatePopUpContentFields	= [];
			$updatePopUpContentFields['varTitle'] = trim($postArr['title']);
			$updatePopUpContentFields['txtDescription'] = $postArr['description'];
			$updatePopUpContentFields['dtStartDateTime'] = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$postArr['start_date_time'])));
			$updatePopUpContentFields['dtEndDateTime'] = (isset($postArr['end_date_time']) && $postArr['end_date_time']!="")?date('Y-m-d H:i:s', strtotime(str_replace('/','-',$postArr['end_date_time']))):null;
			$updatePopUpContentFields['chrPublish']	= $postArr['chrMenuDisplay'];
			$updatePopUpContentFields['created_at']	= Carbon::now();

			$whereConditions = ['id' => 1];
			$update = CommonModel::updateRecords($whereConditions, $updatePopUpContentFields);

			if($update)
			{
				if($popup->id>0 && !empty($popup->id)){
					
					$logArr = MyLibrary::logData($popup->id);
					if (Auth::user()->can('log-advanced')) {
						$newPopUpContentObj = PopUpContent::getRecordForLogById($popup->id);
						$oldRec = $this->recordHistory($popup);
						$newRec = $this->recordHistory($newPopUpContentObj);
						$logArr['old_val'] = $oldRec;
						$logArr['new_val'] = $newRec;
					}
					$logArr['varTitle'] = trim($postArr['title']);
					Log::recordLog($logArr);
					if (Auth::user()->can('recent-updates-list')) {
						if(!isset($newPopUpContentObj)){
								$newPopUpContentObj = PopUpContent::getRecordForLogById($popup->id);
						}
						$notificationArr = MyLibrary::notificationData($popup->id, $newPopUpContentObj);
						RecentUpdates::setNotification($notificationArr);
					}
					self::flushCache();	
				}				

				return redirect()->route('powerpanel.popup.index')->with('message', trans('template.managePopup.updateMessage'));
			}

			}else{
				return Redirect::route('powerpanel.popup.index')->withErrors($validator)->withInput();
			}
	}
	
	/**
	  * This method handels logs History records
	  * @param   $data
	  * @return  HTML
	  * @since   2017-07-27
	  * @author  NetQuick
	  */
	public function recordHistory($data=false){
		$returnHtml = '';
			$returnHtml.='<table class="new_table_desing table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>'.trans("template.common.question").'</th>						
						<th>'.trans("template.common.answer").'</th>
						<th>'.trans("template.common.displayorder").'</th>
						<th>'.trans("template.common.publish").'</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>'.$data->varTitle.'</td>						
						<td>'.$data->txtDescription.'</td>
						<td>'.($data->intDisplayOrder).'</td>
						<td>'.$data->chrPublish.'</td>
					</tr>
				</tbody>
			</table>';

		return $returnHtml;
		}

		public function flushCache(){
				//Cache::forget('getFrontRecordsByPage');
		}
}