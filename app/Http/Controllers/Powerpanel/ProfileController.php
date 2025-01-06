<?php 
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\Guard;
use Validator;
use App\Image;
use App\RecentUpdates;
use App\User;
use Hash;
use Illuminate\Routing\UrlGenerator;
use DB;
use Auth;
use App\Modules;
use App\Helpers\resize_image;
use App\Helpers\MyLibrary;

class ProfileController extends PowerpanelController 
{

	public function __construct(UrlGenerator $url) 
	{
		parent::__construct();
		$this->url = $url;
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}	
	public function index(Guard $auth) 
	{

		$userEmailID = $auth->user()['email'];
		$user_data = User::getRecordByEmailID($userEmailID);
		$logo = Image::getImg($user_data->fkIntImgId);
		
   
		if(!empty($logo)) 
		{
			$logo_url = resize_image::resize($logo->id);
		} else {
			$logo_url  = $this->url->to('resources/images/upload_file.gif');
		}
		$this->breadcrumb['title']=trans('template.header.myProfile');
		return view('powerpanel.profile.change_profile',['user_data'=>$user_data,'user_photo'=>$logo_url,'breadcrumb'=>$this->breadcrumb,'imageManager'=> true]);

	}
	static function changeprofile(Request $request,Guard $auth) 
	{
		$data = Input::get();
		$rules = array(
			'name' => 'required|max:150', 
			'email' => 'required|email|max:100',
			'personalId' => 'required|email|max:100'
		);
		$validator = Validator::make($data, $rules);
		$userEmailID = $auth->user()['email'];
		if($validator->passes())
		{
			$data = [
				'name' => $request->name,
				'email' => $request->email,
				'personalId' => $request->personalId,
				'fkIntImgId' => (!empty($request->user_photo)?$request->user_photo:null)
			];

			$user = User::updateUserRecordByEmail($userEmailID,$data);
			return Redirect::route('powerpanel/changeprofile')->with('message','The record has been successfully edited and saved.');
		}else{
			return Redirect::route('powerpanel/changeprofile')->withErrors($validator)->withInput();
		}
	}
	public function changepassword() 
	{
		$this->breadcrumb['title']=trans('template.header.changePassword');
		return view('powerpanel.profile.change_password',['breadcrumb'=>$this->breadcrumb]);
	}
	public function handle_changepassword(Request $request,Guard $auth){
		$data = Input::get();
		$moduleCode = Modules::getModule('users');
		$rules = array(
			'old_password' => 'required|max:20', 
			'new_password' => 'required|max:20|min:6|check_passwordrules',
			'confirm_password' => 'required|same:new_password|max:20|min:6|check_passwordrules',
		);
		$validator = Validator::make($data, $rules);
		$userEmailID = $auth->user()['email'];
		$user_data = User::getRecordByEmailID($userEmailID);
		if($validator->passes()) 
		{
			if (Hash::check($request->old_password,$user_data->password)) 
			{
				if ($request->old_password != $request->new_password) 
				{
					$data =['password' => bcrypt($request->new_password)];
					$user = User::updateUserRecordByEmail($userEmailID,$data);
					if($user) 
					{
						$userObj = User::getRecordByIdWithoutRole($user_data->id);
						if (Auth::user()->can('recent-updates-list')) {
							$notificationArr = MyLibrary::notificationData($user_data->id, $userObj,$moduleCode->id);
							RecentUpdates::setNotification($notificationArr);
						}
					}
				} else {
					return Redirect::route('powerpanel/changepassword')->with('error','Password is already exists please choose another password.');
				}
			} else {
				return Redirect::route('powerpanel/changepassword')->with('error','Old Password is not valid please enter valid password.');
			}
			return Redirect::route('powerpanel/changepassword')->with('message','The record has been successfully edited and saved.');
		}else{
			return Redirect::route('powerpanel/changepassword')->withErrors($validator)->withInput();
		}
	}
}