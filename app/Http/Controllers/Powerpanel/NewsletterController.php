<?php 
/**
* The SubscriptionController class handels subscription functions for front end
* configuration  process.
* @package   Netquick powerpanel
* @license   http://www.opensource.org/licenses/BSD-3-Clause 
* @version   1.00
* @since     2017-11-10
* @author    NetQuick
*/
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\NewsletterLead;
use App\Modules;
use Excel;
use App\CommonModel;
use App\Helpers\MyLibrary;
use Config;


class NewsletterController extends PowerpanelController {
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
	/**
	* This method load all subscription view
	* @return  View
	* @since   2016-11-25
	* @author  NetQuick
	*/
	public function index() {
		$total= CommonModel::getRecordCount();
		$this->breadcrumb['title']=trans('template.newslettersModule.manageNewsletterLeads');
		return view('powerpanel.newsletter_lead.index',['total'=>$total,'breadcrumb'=>$this->breadcrumb]);
	}
	/**
	* This method loads team table data on view 
	* @return  View
	* @since   2016-11-14
	* @author  NetQuick
	*/
	public function get_list() 
	{
		$filterArr = [];
		$records = [];
		$records["data"] = [];
		$filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
		$filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
		$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
		$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';	
		$filterArr['emailtypeFilter'] = !empty(Input::get('customActionName'))?Input::get('customActionName'):'';
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));
		
		$sEcho = intval(Input::get('draw'));
		$arrResults = NewsletterLead::getRecordList($filterArr);
		$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;	
		if (!empty($arrResults)) 
		{
			foreach ($arrResults as $key => $value) 
			{
				$records["data"][] = $this->tableData($value);
			}
		}
		if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
			$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
		}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}
	public function DeleteRecord(Request $request) {
		$data = $request->all('ids');
		$update = MyLibrary::deleteMultipleRecords($data);
		echo json_encode($update);
		exit;
	}
	/**
	* This method handels send subscribe email function
	* @return  View
	* @since   2017-11-10
	* @author  NetQuick
	*/
	public function send_email() {
		$data = NewsletterLead::getRecords()->publish()->deleted();		
		if($data->count() > 0) {
			$data = $data->get()->first()->toArray();
			$id=Crypt::encrypt($data['id']);		
			Email_sender::contactUs($data,$id);
			echo	'email sent!';
			//return view('emails.feedback');
		}
	}
	/**
	* This method handels export process of newsletter leads
	* @return  xls file
	* @since   2017-05-12
	* @author  NetQuick
	*/
	public function ExportRecord() 
	{
		if(Input::get('export_type')=='selected_records') 
		{
			if(null!== Input::get('delete'))
			{	
				$selectedIds = Input::get('delete');
			}else{
				$selectedIds=false;
			}
			$arrResults = NewsletterLead::getListForExport($selectedIds);
		}else	{
			$arrResults = NewsletterLead::getListForExport();
		}
			if (count($arrResults)>0) 
			{
				foreach ($arrResults as $key => $value) {
					$subscribe = '-';
					if($value->chrSubscribed=='Y'){
						$subscribe = 'Subscribe';
					}elseif($value->chrSubscribed=='N'){
						$subscribe = 'Unsubscribe';
					}
					$data[] = [
						$value->varEmail,
						$subscribe,
						$value->varIpAddress,
						date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->created_at))
					];	
				}
				$this->createExcel($data);
			}
	}
	public function createExcel($data)
	{
			Excel::create(Config::get('Constant.SITE_NAME').'-'. trans("template.newslettersModule.newslettersLeads") .'-'. date("dmy-h:i") , function($excel) use($data) 
			{
					$excel->sheet(date('M-d-Y'), function($sheet) use($data) 
					{
						$sheet->setAutoSize(true);
						$sheet->fromArray($data);
						$sheet->row(1, array(
							trans('template.common.email'),
							trans('template.newslettersModule.subscribed'),
							trans('template.newslettersModule.ipAddress'),
							trans('template.newslettersModule.receivedDateTime')
						));
						$sheet->prependRow(array(
							Config::get('Constant.SITE_NAME').' Newsletter Leads'
						));
						$sheet->mergeCells('A1:D1');
						$sheet->row(2, function($row) {
							$row->setAlignment('center');
							$row->setFontWeight('bold');
							$row->setFontSize(12);
						});
						$sheet->row(1, function($row) {
							$row->setAlignment('center');
							$row->setFontWeight('bold');
							$row->setFontSize(12);
						});
					});
				})->download('xls');
	}
	public function tableData($value)
	{
			$name = '';
			if(!empty($value->varName)){
				$name .= $value->varName;
			}else{
				$name .= '-';
			}
			$records = array(
				'<input type="checkbox" name="delete[]" class="chkDelete" value="' . $value->id. '">',
				/*$name,*/
				$value->varEmail,
				$value->chrSubscribed,
				$value->varIpAddress,								
				date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->created_at))				
			);
			return $records;
	}
}