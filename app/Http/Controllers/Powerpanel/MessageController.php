<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\Message;
use App\Alias;
use Validator;

use Illuminate\Contracts\Auth\Guard;
use App\Http\Traits\time;
use Carbon\Carbon;
use Illuminate\Routing\UrlGenerator;
class MessageController extends PowerpanelController{
		
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
	public function index(Guard $auth){
		$response = array();
		$messagesData = Message::messages();
		$response =  $this->get_Messagehtml($messagesData);
	 	echo json_encode($response);
	 	exit;
	}
	public function get_Messagehtml($messagesData=false){
		$messageArr = array();
		if(!empty($messagesData)){
			foreach($messagesData as $key => $value){
				$lastModifiedDate=$value->updated_at;
				$timeformat=strtotime($lastModifiedDate);
				$messageArr[$key]['time'] = time::time_elapsed_string($timeformat);
				if($messageArr[$key]['time']==0 && $messageArr[$key]['time']<1){
					$messageArr[$key]['time']='Just Now';
				}
				if(empty($value->txt_image_alt_tag)){
					$image = $this->url->to('/resources/images/user_male4.png');
        }else{
					$image = $value->txt_image_url.'/'.$value->txt_image_alt_tag.'.'.$value->var_image_extension;
				}
				if(!empty($value->txt_message) && !empty($image)){
					$messageArr[$key]['messagehtml'] = sprintf($value->txt_message,$image);
				}else{
					$messageArr[$key]['messagehtml'] = '';
				}
				
				$messageArr[$key]['id'] = $value->id;
				$messageArr[$key]['chr_read'] = $value->chr_read;
				$messageArr[$key]['alias'] = $this->url->to('/powerpanel/contactlead');
			}
		}else{
			$messageArr['error'] = 'Messages are not available.';		
		}
		return $messageArr;
	}
	public function update_read_status(Request $request){
		$response = 'false';
		if(!empty($request->message_id)){	
			$response = Message::update_read_status($request->message_id);
			$response = 'true';
		}
		echo $response;
		exit;
	}
	public function get_read_message_count(){
		$response = false;
		$response = Message::messageCount();
		echo $response;
		exit;
	}
}