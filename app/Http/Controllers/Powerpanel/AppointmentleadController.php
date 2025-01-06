<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Excel;
use Input;

use App\AppointmentLead;
use App\Services;
use App\CommonModel;
use App\Helpers\MyLibrary;
use Config;

class AppointmentLeadController extends PowerpanelController {
	
	/**
	* Create a new Dashboard controller instance.
	*
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
		$iTotalRecords = CommonModel::getRecordCount();
		$this->breadcrumb['title']= trans('template.appointmentleadModule.manageAppointmentLeads');
		return view('powerpanel.appointment_lead.list',['iTotalRecords'=>$iTotalRecords,'breadcrumb'=>$this->breadcrumb]);
	}

	public function get_list()
	{		
		$filterArr = [];
		$records = [];
		$records["data"] = [];
		$filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
		$filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
		$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
		$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
		$filterArr['start'] = !empty(Input::get('rangeFilter')['from']) ? Input::get('rangeFilter')['from'] : '';
		$filterArr['end'] = !empty(Input::get('rangeFilter')['to']) ? Input::get('rangeFilter')['to'] : '';	
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));

		$sEcho = intval(Input::get('draw'));

		$arrResults = AppointmentLead::getRecordList($filterArr);
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

		if(isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action"){
			$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
		}

		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
		exit;

	}

	/**
	 * This method handels delete leads operation
	 * @return  xls file
	 * @since   2016-10-18
	 * @author  NetQuick
	 */	
	public function DeleteRecord(Request $request) 
	{
		$data = $request->all('ids');
		$update = MyLibrary::deleteMultipleRecords($data);
		echo json_encode($update);
		exit;
	}

	public function saveComment(Request $request) 
	{
		$data = Input::get();
		$leadId = $data['leadId'];
		$comment = $data['varComment'];
		$leadArr['txtComments'] = strip_tags($comment);
		$whereConditions = ['id' => $leadId];
		$update          = CommonModel::updateRecords($whereConditions, $leadArr);
		echo json_encode($update);
		exit;
	}
	

	/**
 * This method handels export process of appointment us leads
 * @return  xls file
 * @since   2016-10-18
 * @author  NetQuick
 */
	public function ExportRecord() 
	{
		if (Input::get('export_type')=='selected_records') 
		{
			$selectedIds = array();	
			if (null!== Input::get('delete')) 
			{
				$selectedIds = Input::get('delete');
			}

			$arrResults = AppointmentLead::getListForExport($selectedIds);		

		} else {
			
			$arrResults = AppointmentLead::getListForExport();
		}

		if (count($arrResults) > 0) 
		{
			foreach ($arrResults as $key => $value) 
			{

				$phoneNo = '-';
				if(!empty($value->varPhoneNo)){
					$phoneNo = $value->varPhoneNo;
				}

				$comments = '-';
				if(!empty($value->txtComments)){
					$comments = $value->txtComments;
				}

				$userMessage = '-';	
				if(!empty($value->txtUserMessage)){
					$userMessage = $value->txtUserMessage;
				}

				$services = '';

				if(!empty($value->fkIntServiceId) || $value->fkIntServiceId !=null){
					$serviceIds = array($value->fkIntServiceId);
					$servicesNames = Services::getServicesNameByServicesId($serviceIds)->toArray();
					if(!empty($servicesNames)){
							$serviceList = '';
							foreach ($servicesNames as $selService) {
										$serviceList .= $selService['varTitle'].',';
							}
							$serviceList = rtrim($serviceList,',');
							$services = $serviceList;
					}else{
							$services = '-';	
					}
				}else{
					$services = '-';					
				}

				$data[] = 
				[					
					$value->varName,
					$value->varEmail,
					$phoneNo,
					$userMessage,
					$services,
					date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').'',strtotime($value->appointmentDate)),
					$comments,
					$value->varIpAddress,
					date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->created_at))
				];	

			}

			$this->createAppointmentLeadExcel($data);
		}
		
	}

	/**
	 * This method create appointment lead excel sheet
	 * @return  xls file
	 * @since   2016-10-18
	 * @author  NetQuick
	 */	
	public function createAppointmentLeadExcel($data)
	{

	Excel::create(Config::get('Constant.SITE_NAME').'-'. trans("template.appointmentleadModule.appointmentLeads") .'-'.date("dmy-h:i"), 
		function($excel) use($data)
		{			
				$excel->sheet(date('M-d-Y'), function($sheet) use($data) 
				{
					$sheet->setAutoSize(true);
					$sheet->fromArray($data);
					$sheet->row(1, array(						
						trans('template.common.name'),
						trans('template.common.email'),
						trans('template.appointmentleadModule.phone'),
						trans('template.appointmentleadModule.message'),
						trans('template.appointmentleadModule.service'),
						trans('template.appointmentleadModule.appointmentDate'),
						'Comment',
						trans('template.appointmentleadModule.ipAddress'),
						trans('template.appointmentleadModule.receivedDateTime')
					));

					$sheet->prependRow(array(
						Config::get('Constant.SITE_NAME').' '.trans("template.appointmentleadModule.appointmentLeads")
					));

					$sheet->mergeCells('A1:F1');
					$sheet->row(1, function($row) {
						$row->setAlignment('center');
						$row->setFontWeight('bold');
						$row->setFontSize(12);
					});
					$sheet->row(2, function($row) {
						$row->setAlignment('center');
						$row->setFontWeight('bold');
						$row->setFontSize(12);
					});

				});				
			})->download('xls');
					
	}

	public function tableData($value)
	{
			$details = '';
			$phoneNo = '';
			$services = '';
			$commentAction = '';
			if(!empty($value->txtUserMessage))
			{
				$details .=	'<div class="pro-act-btn">';
				$details .=	'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Message\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
				$details .=	'<div class="highslide-maincontent">'.nl2br($value->txtUserMessage).'</div>';
				$details .='</div>';	
			}else{
				$details .= '-';				
			}
			if(!empty($value->txtComments))
			{
				$commentAction .=	'<div class="pro-act-btn">';
				$commentAction .=	'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Comment\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-info"></span></a>';
				$commentAction .=	'<div class="highslide-maincontent">'.nl2br($value->txtComments).'</div>';
				$commentAction .='</div>';
				$commentAction .= '<a href="javascript:;" class="commentAction" data-action="edit" data-oldComment="'.$value->txtComments.'" data-lid="'.$value->id.'">Edit</a>';
			}else{
				$commentAction = '<a href="javascript:;" class="commentAction" data-action="add" data-lid="'.$value->id.'">Add</a>';
			}

			if(!empty($value->fkIntServiceId) || $value->fkIntServiceId !=null)
			{
				$serviceIds = array($value->fkIntServiceId);
				$servicesNames = Services::getServicesNameByServicesId($serviceIds)->toArray();
				if(!empty($servicesNames)){ 
						$services .=	'<div class="pro-act-btn">';
						$services .=	'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Message\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-info"></span></a>';
						$services .=	'<div class="highslide-maincontent">';
				
						$services .= '<ul>';
						foreach ($servicesNames as $selService) {
										$services .= '<li>';
										$services .= $selService['varTitle'];
										$services .= '</li>';
						}
						$services .= '<ul>';	
						$services .= '</div>';
						$services .='</div>';	
				}else{
					$services .= '-';				
				}
			}else{
				$services .= '-';				
			}

			if(!empty($value->varPhoneNo))
			{
				$phoneNo = $value->varPhoneNo;
			}else{
				$phoneNo = '-';
			}

			$records = array(
				'<input type="checkbox" name="delete[]" class="chkDelete" value="' .$value->id. '">',
				$value->varName,
				$value->varEmail,
				$phoneNo,
				$details,
				$services,
				date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' ',strtotime($value->appointmentDate)),
				$commentAction,
				date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->created_at))
			);

			return $records;
	}
}