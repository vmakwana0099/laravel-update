<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\Alias;
use App\Calender;
use App\Newsletter;
use Validator;

use Illuminate\Contracts\Auth\Guard;
use Carbon\Carbon;
use Illuminate\Routing\UrlGenerator;

class CalenderController extends PowerpanelController
{

	
	/**
	* Create a new controller instance.
	* @return void
	*/
	public function __construct(UrlGenerator $url){
		parent::__construct();
		$this->url = $url;
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
	/**
	* Show the application dashboard.
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return view('powerpanel.calender.calender');
	}
	public function get_activity(Request $request){
		$response =array();
		if(!empty($request->searchValue)){
			$searchCalendarFilter = $request->searchValue;
		}else{
			$searchCalendarFilter = "";
		}
		$arrData = Calender::get_data_for_calender($searchCalendarFilter);
		if(!empty($arrData)){
			foreach ($arrData as $data) {
				$data->color='#4B77BE';
				$response[] = $arrData = array(
					'title'	=> "#".$data->id."-".$data->name,
					'start' => $data->created_at,
					'backgroundColor' => $data->color,
					'msg' =>'<div>
										<div class="pop-row">
											<label><b>Contact Person:</b></label>
											<span>'.ucwords($data->name).'</span>    
										</div>
										<div class="pop-row">
										  <label><b>Email:</b></label>
											<span>'.($data->email).'</span>    
										</div>
										<div class="pop-row">
										  <label><b>Phone no:</b></label>
											<span>'.$data->phone_no.'</span>    
										</div>
										<div class="pop-row">
										  <label><b>Date:</b></label>
											<span>
												'.date('m-d-Y',strtotime($data->created_at)).'
											</span>    
										</div>
										<div class="pop-row">
											<label><b>Message:</b></label>
											<span>'.$data->user_message.'</span>    
										</div>
										<ul class="table-tab">
											<li>
												<i class="fa fa-html5"></i>
												<a target="_blank" href="'.$this->url->to('/powerpanel/contactlead').'">
													Visit List
												</a>
											</li>
											<li>
												<i class="fa fa-external-link"></i>
												<a target="_blank" href="'.$this->url->to('/powerpanel').'">
													Visit Site
												</a>
											</li>
										</ul>
									</div>'
				);
			}			
		}
		echo json_encode($response);
	}
}

