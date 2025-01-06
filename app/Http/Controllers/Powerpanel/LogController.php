<?php
namespace App\Http\Controllers\Powerpanel;
use Input;
use App\Log;
use App\Http\Controllers\PowerpanelController;
use App\Helpers\MyLibrary;
use Config;
use Excel;
class LogController extends PowerpanelController {
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
	 * This method handels load log grid
	 * @return  View
	 * @since   2017-07-20
	 * @author  NetQuick
	 */
	public function index(){
		$total = Log::getRecords('')->deleted()->count();
		$this->breadcrumb['title']=trans('template.logManagerModule.manage');
		return view('powerpanel.logmanager.log_manager',['total'=>$total,'breadcrumb'=> $this->breadcrumb]);		
	}

	/**
	 * This method handels list of log with filters
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
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		$arrResults = Log::getRecords($filterArr['searchFilter'])->deleted()->filter($filterArr)->get();
		$iTotalRecords = Log::getRecords($filterArr['searchFilter'])->deleted()->filter($filterArr, true)->count();
		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		if (count($arrResults) > 0 && !empty($arrResults)){	
			foreach ($arrResults as $key => $value){
				if(isset($value->user)){
					$records["data"][] = $this->tableData($value);
				}
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
	* This method destroys Log in multiples
	* @return  Log index view
	* @since   2016-10-25
	* @author  NetQuick
	*/
	public function DeleteRecord() {
		$data = Input::get('ids');
		$update = Log::deleteRecordsPermanent($data);
		exit;
	}

	public function tableData($value){
	//echo json_encode($value);exit();		
		$old_val ='';
		$new_val ='';
		$link = '';
		if(strlen($value->txtOldVal)> 0 && strtolower($value->varAction)=='edit'){
			$old_val .=	'<a href="javascript:void(0)" class="without_bg_icon " onclick="return hs.htmlExpand(this,{width:300,headingText:\'Old Value\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
			$old_val .=	'<div class="highslide-maincontent">'.$value->txtOldVal.'</div>';
		}else{$old_val .=	'-';}
		if(strlen($value->txtNewVal)>0 && strtolower($value->varAction)=='edit'){				
		$new_val .=	'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'New Value\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
		$new_val .=	'<div class="highslide-maincontent">'.$value->txtNewVal.'</div>';
		}else{$new_val .=	'-';}
		if($value->module->varTitle=='contact') {
			$link	.= '<a href="'.url('powerpanel/'.'contacts').'">'.ucfirst($value->module->varTitle).'</a>';
		}elseif ($value->module->varTitle=='testimonial') {
			$link	.= '<a href="'.url('powerpanel/'.'testimonials').'">'.ucfirst($value->module->varTitle).'</a>';
		}else{
			$link .= '<a href="'.url('powerpanel/'.$value->module->varModuleName).'">'.ucfirst($value->module->varTitle).'</a>';
		}			
		$records = array(
			'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',
			$value->user->name.' &lt'.$value->user->email.'&gt',			
			$link,
			$old_val,
			$new_val,
			($value->varTitle !=null) ? $value->varTitle:'-',
			ucfirst($value->varAction),
			$value->varIpAddress,
			date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->created_at))
		);		
		return $records;
	}

	/**
 * This method handels export process of Logs
 * @return  xls file
 * @since   2016-10-18
 * @author  NetQuick
 */
	public function ExportRecord() 
	{
		if (Input::get('export_type')=='selected_records') {
			$selectedIds = '';	
			if (null!== Input::get('delete')) {
				$selectedIds = Input::get('delete');
			}
			$arrResults = Log::getListForExport($selectedIds);		
		} else {
			$arrResults = Log::getListForExport();
		}

		if (count($arrResults) > 0) 
		{
			foreach ($arrResults as $key => $value) 
			{
				$userName = $value->user->name;
				$useremail = $value->user->email;
				$action = $value->varAction;
				$moduleName = $value->module->varTitle;	
				
				$data[] = 
				[					
					$userName,
					$useremail,
					$action,
					$moduleName,
					$value->varIpAddress,
					date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->created_at))
				];
			}
			$this->createContactLeadExcel($data);
		}	
	}

	/**
	 * This method create contact lead excel sheet
	 * @return  xls file
	 * @since   2016-10-18
	 * @author  NetQuick
	 */	
	public function createContactLeadExcel($data)
	{

	Excel::create(Config::get('Constant.SITE_NAME').'-'. 'logdata' .'-'.date("dmy-h:i"), 
		function($excel) use($data)
		{			
				$excel->sheet(date('M-d-Y'), function($sheet) use($data) 
				{
					$sheet->setAutoSize(true);
					$sheet->fromArray($data);
					$sheet->row(1, array(						
						trans('template.common.name'),
						trans('template.common.email'),
						'Action',
						'ModuleName',
						'IP Address',
						'RECEIVED DATE/TIME'
					));

					$sheet->prependRow(array(
						Config::get('Constant.SITE_NAME').' Log Details'
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


}