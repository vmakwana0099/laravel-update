<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Dashboard;
use App\Pagehit;
use App\CmsPage;
use App\User_subscribers;
use App\ContactLead;
use Input;
use DB;
use App\Helpers\MyLibrary;
use App\Alias;

class DashboardController extends PowerpanelController {
	
	/*
	|--------------------------------------------------------------------------
	| Dashboard Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling dashboard stats.
	|
	|
	|
	*/
	/**
	* Create a new Dashboard controller instance.
	*
	* @return void
	*/
	public function __construct() {
		parent::__construct();
		$this->middleware('auth');
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
	public function index() { 
		$hits = Pagehit::getHits()->toArray();
		$currentMonth = Pagehit::getHitsCurrentMonth()->toArray();
		$currentYear = Pagehit::getHitsCurrentYear()->toArray();
		$leads = ContactLead::getRecordList();		
		
		$newsleads = null;
		$currentMonthNewsLetterCount = null;
		$currentYearNewsLetterCount = null;
		$AwsSupportleads = null;
		if(class_exists('\\App\\NewsletterLead')){
			$newsleads = \App\NewsletterLead::getRecordList();
			$currentMonthNewsLetterCount = \App\NewsletterLead::getCurrentMonthCount();		
			$currentYearNewsLetterCount = \App\NewsletterLead::getCurrentYearCount();
		}

		if(class_exists('\\App\\AppointmentLead')){
			$AwsSupportleads = \App\AppointmentLead::getRecordList();
		}		

		if(class_exists('\\App\\AwsSupportLead')){
			$AwsSupportleads = \App\AwsSupportLead::getRecordList();
                        $currentMonthAwsSupportleadsCount = \App\AwsSupportLead::getCurrentMonthCount();
                        $currentYearAwsSupportleadsCount = \App\AwsSupportLead::getCurrentYearCount();
		}		

		$contactLeadCount=count($leads);
		$subscriberLeadCount=count($newsleads);
		$AwsSupportleadsCount=count($AwsSupportleads);

		$currentMonthContactCount = ContactLead::getCurrentMonthCount();		
		$currentYearContactCount = ContactLead::getCurrentYearCount();
		

		return view('powerpanel.dashboard.dashboard',compact(
			'hits',
			'currentMonth',
			'currentYear',
			'tbody',
			'leads',
			'newsleads',
			'AwsSupportleads',
			'contactLeadCount',
			'subscriberLeadCount',
			'AwsSupportleadsCount',
			'currentYearAwsSupportleadsCount',
			'currentMonthAwsSupportleadsCount',
			'currentMonthNewsLetterCount',
			'currentYearNewsLetterCount',
			'currentMonthContactCount',
			'currentYearContactCount')
		);
	}

	public function ajaxcall() 
	{
		$data = Input::all();
		switch ($data['type']) {
			case 'contactuslead':
				$contactusleadID = $data['id'];
				$contactusLeadRecord = ContactLead::getRecordById($contactusleadID);
                                $contactData['varName'] = $contactusLeadRecord->varName;
                                $contactData['varPhoneNo'] = MyLibrary::encrypt_decrypt('decrypt',$contactusLeadRecord->varPhoneNo);
                                $contactData['txtUserMessage'] = $contactusLeadRecord->txtUserMessage;
                                $contactData['varEmail'] = MyLibrary::encrypt_decrypt('decrypt',$contactusLeadRecord->varEmail);
				echo json_encode($contactData);
			break;
			default:
				echo "error";
			break;
		}
	}
}