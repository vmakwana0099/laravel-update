<?php
namespace App\Http\Controllers\Powerpanel;
use Input;
use App\EmailLog;
use App\EmailType;
use App\Http\Controllers\PowerpanelController;
use App\Helpers\MyLibrary;
use Config;
use App\CommonModel;
class EmailLogController extends PowerpanelController {
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

	/**
	 * This method handels load emailLog grid
	 * @return  View
	 * @since   2017-07-20
	 * @author  NetQuick
	 */
	public function index(){
		$total = CommonModel::getRecordCount();
		$emailTypes = $total>0 ? EmailType::getEmailTypes():null;
		$this->breadcrumb['title']=trans('template.emailLogModule.manage');		
		return view('powerpanel.email_log.email_log',['emailTypes'=>$emailTypes,'iTotalRecords'=>$total,'breadcrumb'=> $this->breadcrumb]);		
	}

	/**
	 * This method handels list of emailLog with filters
	 * @return  View
	 * @since   2017-07-20
	 * @author  NetQuick
	 */
	public function get_list(){
		/*Start code for sorting*/
		$filterArr = [];
		$records = array();
		$records["data"] = array();
		$filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
		$filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
		$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
		$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';		
		$filterArr['emailtypeFilter'] = !empty(Input::get('emailtypeValue')) ? Input::get('emailtypeValue') : '';
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		$arrResults = EmailLog::getRecordList($filterArr);
		$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		if (count($arrResults) > 0 && !empty($arrResults)){	
			foreach ($arrResults as $key => $value){				
				$records["data"][] = $this->tableData($value);				
			}
		}
		$records["customActionStatus"] = "OK";
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
		exit;
	}
	/**
  * This method destroys EmailLog in multiples
  * @return  EmailLog index view
  * @since   2016-10-25
  * @author  NetQuick
  */
	public function DeleteRecord() {
		$data = Input::get('ids');
		$update = EmailLog::deleteRecordsPermanent($data);
		exit;
	}

	public function tableData($value){
		//echo json_encode($value);exit();
		$details='';
		
		if ($value->emailType->varEmailType == 'Project Approved') {
				$to = '<label title="'.str_replace("</br>","\n",$value->txtTo).'">'.trans('template.emailLogModule.subscriberGroup').'</label>'; 
		} else {
				$to = $value->txtTo; 
		}
		$records = array(
				'<input type="checkbox" class="chkDelete" name="delete" value="'.$value->id.'">',				
				$value->emailType->varEmailType,
				$value->varFrom,
				$to,
				strtoupper($value->chrIsSent),
				$value->chrAttachment,
				date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->created_at))
			);
			return $records;
	}

	public function ajax() {
			$emaillogpage_id = Input::get('emaillogpage_id');
			if ($emaillogpage_id>0) {
				$emailpageID = $emaillogpage_id;
				$emailLogPageRecord = EmailLog::getRecordById($emailpageID);
				$emailArr = [];
				if(!empty($emailLogPageRecord) && count($emailLogPageRecord)>0){					
					$emailArr['txt_subject']=$emailLogPageRecord->txtSubject;
					$emailArr['txt_to']=$emailLogPageRecord->txtTo;
					$emailArr['date']=date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($emailLogPageRecord->created_at));
				}
				echo json_encode($emailArr);
			}
	}
}