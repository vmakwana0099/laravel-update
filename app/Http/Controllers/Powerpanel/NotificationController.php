<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\Notification;
use App\Alias;
use Validator;

use Illuminate\Contracts\Auth\Guard;
use App\Http\Traits\time;
use Carbon\Carbon;
use Illuminate\Routing\UrlGenerator;
use Crypt;
class NotificationController extends PowerpanelController{
		
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
	* Show the application dashboard.
	* @return \Illuminate\Http\Response
	*/
	public function index(Guard $auth){
		$response = array();
		$sessionID = $auth->user()['id'];
		$sessionData = $auth->user();
		$notificationsData = Notification::notifications($sessionID);
		$response =  $this->get_notificationhtml($notificationsData,$sessionData);
	 	echo json_encode($response);
	 	exit;
	}
	public function get_notificationhtml($notificationsData = false,$sessionData = false){
		$notificationArr = array();
		if(!empty($notificationsData)){
			foreach($notificationsData as $key => $value){
				$lastModifiedDate=$value->updated_at;
				$timeformat=strtotime($lastModifiedDate);
				$notificationArr[$key]['time'] = time::time_elapsed_string($timeformat);
				if($notificationArr[$key]['time']==0 && $notificationArr[$key]['time']<1){
					$notificationArr[$key]['time']='Just Now';
				}
				if($value->fk_user_id == $sessionData['id']){
					$user = 'You have';	
				}else{
					$user = $value->name.' '.'has';
				}
				if(empty($value->txt_image_alt_tag)){
					$image = $this->url->to('/resources/images/user_male4.png');
        }else{
					$image = $value->txt_image_url.'/'.$value->txt_image_alt_tag.'.'.$value->var_image_extension;
				}
				if(!empty($value->txt_notification) && !empty($image) && !empty($user)){
					$notificationArr[$key]['notificationhtml'] = sprintf($value->txt_notification,$image,$user);	
				}else{
					$notificationArr[$key]['notificationhtml'] = '';
				}
				$notificationArr[$key]['id'] = $value->id;
				$notificationArr[$key]['chr_read'] = $value->chr_read;
				$notificationArr[$key]['chr_record_delete'] = $value->chr_record_delete;
				if($value->chr_record_delete == 'Y'){
					$notificationArr[$key]['link'] = $this->url->to('/powerpanel/recentupdate');
				}
				if($value->var_module_name=='banners'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/banners').'/'.Crypt::encrypt($value->fk_record_id).'/edit';
				}elseif($value->var_module_name=='cms-page'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/pages').'/'.$value->alias.'/edit';
				}elseif($value->var_module_name=='team'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/team').'/'.$value->alias.'/edit';	
				}elseif($value->var_module_name=='faq'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/faq').'/'.Crypt::encrypt($value->fk_record_id).'/edit';		
				}elseif($value->var_module_name=='users'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/users').'/'.Crypt::encrypt($value->fk_record_id).'/edit';
				}elseif($value->var_module_name=='services'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/services').'/'.$value->alias.'/edit';
				}elseif ($value->var_module_name=='staticblocks'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/staticblocks').'/'.$value->alias.'/edit';
				}elseif ($value->var_module_name=='event'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/events').'/'.$value->alias.'/edit';
				}elseif ($value->var_module_name=='blog'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/blog').'/'.$value->alias.'/edit';
				}elseif ($value->var_module_name=='testimonial'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/testimonials').'/'.Crypt::encrypt($value->fk_record_id).'/edit';
				}elseif ($value->var_module_name=='sponsors'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/sponsors').'/'.Crypt::encrypt($value->fk_record_id).'/edit';
				}elseif ($value->var_module_name=='contact'){
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel/contacts').'/'.Crypt::encrypt($value->fk_record_id).'/edit';
				}else{
					$notificationArr[$key]['alias'] = $this->url->to('/powerpanel');
				}
			}
		}else{
			$notificationArr['error'] = 'Notifications are not available.';		
		}
		return $notificationArr;
	}
	public function update_read_status(Request $request){
		$response = 'false';
		if(!empty($request->notification_id)){	
			$response = Notification::update_read_status($request->notification_id);
			$response = 'true';
		}
		echo $response;
		exit;
	}
	public function get_read_notification_count(Guard $auth){
		$response = false;
		$response = Notification::notificationCount($auth->user()['id']);
		echo $response;
		exit;
	}
}
