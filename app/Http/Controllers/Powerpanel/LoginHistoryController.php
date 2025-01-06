<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Excel;
use Input;
use App\Http\Traits\slug;
use App\LoginLog;
use App\Helpers\MyLibrary;
use Session;
use Config;

class LoginHistoryController extends PowerpanelController {
	
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
		$iTotalRecords = LoginLog::getRecords()->deleted()->count();
		$this->breadcrumb['title']= trans('Login History');
		//$permissions = LoginLog::getPermissions()->get();
		//echo "<pre>";
		//print_r($permissions);
		//exit;
		return view('powerpanel.login_history.list',['iTotalRecords'=>$iTotalRecords,'breadcrumb'=>$this->breadcrumb]);
	}

	/**
	* This method destroys Log in multiples
	* @return  Log index view
	* @since   2016-10-25
	* @author  NetQuick
	*/
	public function DeleteRecord() {
		$data = Input::get('ids');
		$update = LoginLog::deleteRecordsPermanent($data);
		exit;
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
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));

		$sEcho = intval(Input::get('draw'));

		$arrResults = LoginLog::getRecords()->deleted()->filter($filterArr)->get();
		$iTotalRecords = LoginLog::getRecords($filterArr['searchFilter'])->deleted()->filter($filterArr,true)->count();	
		

		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		if (!empty($arrResults)) 
		{			
			foreach ($arrResults as $key => $value) 
			{
				if(isset($value->user)){
					$records["data"][] = $this->tableData($value);
				}
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

	public function tableData($value)
	{
			$details = '';
			$phoneNo = '';
			$records =[];
			
			if(!empty($value->txtUserMessage) )
			{
				$details .=	'<div class="pro-act-btn">';
				$details .=	'<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Message\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
				$details .=	'<div class="highslide-maincontent">'.nl2br($value->txtUserMessage).'</div>';
				$details .='</div>';	
			}else{
				$details .= '-';				
			}
			if(null !== Session::get('loghistory_id') && (Session::get('loghistory_id') !="") && Session::get('loghistory_id')==$value->id)
			{
				$user_logouttime = "You are currently logged In";
				$user_log_delete_checkbox = '';
			}else{
				$user_logouttime = date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->updated_at));
				$user_log_delete_checkbox = '<input type="checkbox" name="delete[]" class="chkDelete" value="' .$value->id. '">';
			}

			$records = array(
				$user_log_delete_checkbox,
				$value->user->name,
				$value->user->email,
				$value->varIpAddress,
				date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($value->created_at)),
				$user_logouttime
			);
			return $records;
	}
}