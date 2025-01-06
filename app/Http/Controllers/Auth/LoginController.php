<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\PowerpanelController;
use App\User;
use App\LoginLog;
use Validator;
use Auth;
use Session;
use Hash;
use Cookie;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Crawler\Url;
use App\Helpers\MyLibrary;

class LoginController extends PowerpanelController
{
		/*
		|--------------------------------------------------------------------------
		| Login Controller
		|--------------------------------------------------------------------------
		|
		| This controller handles authenticating users for the application and
		| redirecting them to your home screen. The controller uses a trait
		| to conveniently provide its functionality to your applications.
		|
		*/

		use AuthenticatesUsers;

		/**
		* Where to redirect users after login.
		*
		* @var string
		*/
		protected $redirectTo = '/powerpanel/dashboard';
		protected $redirectAfterLogout = '/powerpanel';
		protected $guard = 'web';

		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct(){
			if(isset($_COOKIE['locale'])){
					app()->setLocale($_COOKIE['locale']);
			}
			$this->middleware('guest')->except('logout');
		}


		/**
		* Create a new user instance after a valid registration.
		*
		* @param  array  $data
		* @return User
		*/
		protected function create(array $data) {
			return User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => bcrypt($data['password']),
			]);
		}

				/**
		* Get a validator for an incoming registration request.
		*
		* @param  array  $data
		* @return \Illuminate\Contracts\Validation\Validator
		*/
		protected function validator(array $data,Request $request) {
			$rules = [
				'email' => 'required|email|max:255|unique:users',
				'password' => 'required',
			];
			return Validator::make($data,$rules);
		}

		public function login(Request $request,Guard $auth)
    {
    	$messsages = array(
				'email.required' => 'User Name is required.',
				'email.email' => 'User Name is not valid.',
				'email.handle_xss' => 'Please enter valid input.',
				'password.required'=> 'Password is required.'
			);
			$rules = [
				'email' => 'required|email',
	      'email.exists' => 'Email not registered',
				'password' => 'required',
			];
			$validator = Validator::make($request->all(),$rules,$messsages);
      if($validator->passes()) {
				$remember=isset($request->remember)? true : false;
        if (Auth::guard($this->guard)->attempt(['email' => $request->email, 'password' => $request->password,'chrPublish'=>'Y','chrDelete'=>'N'],$remember)) {
        		/*code for set cookie for remmeber login */
        		 
        		 if ($remember==1) {
			    			Cookie::queue('cookie_login_email', $request->email);
								Cookie::queue('cookie_login_password', $request->password);
								Cookie::queue('remember', $request->remember);
							} else {
								
								Cookie::queue(Cookie::forget('cookie_login_email',''));
								Cookie::queue(Cookie::forget('cookie_login_password',''));
								Cookie::queue(Cookie::forget('remember',''));
							}

        		 $log = new LoginLog;
				     $log['fkIntUserId']=Auth::user()['id'];
				     $log['varIpAddress']= MyLibrary::get_client_ip();
				     $log->save();
				    Session::put('loghistory_id',Auth::user()['id']);
            return $this->sendLoginResponse($request);
        }
        else {
					$exitsUserEmail = User::where('email','=',$request->email)->first();
					$exitsUserPassword = User::where('password','=',$request->password)->first();
					if(empty($exitsUserEmail)) {
						return redirect('powerpanel/login')->withErrors($validator)->withInput()->withErrors(['email' => "The email address that you've entered doesn't match any records."]);
					}else{
						if($exitsUserEmail->chrPublish == "N"){
							return redirect('powerpanel/login')->withErrors($validator)->withInput()->withErrors(['email' => "The email address that you've entered currently not active."]);	
						}
					}
					if (empty($exitsUserPassword)) {
						return redirect('powerpanel/login')->withErrors($validator)->withInput()->withErrors(['password' => "The password that you've entered is incorrect."]);
					}
				}
				return redirect()->intended($this->redirectPath());
    }else {
			return redirect('powerpanel/login')->withErrors($validator)->withInput();
		}

    }

    public function logout(Request $request) {

			Auth::logout();
			if(null !== Session::get('loghistory_id') && (Session::get('loghistory_id') !=""))
			{
				 $logid = Session::get('loghistory_id');
				 $log = new LoginLog;
				 $log->where('id', $logid)->update(['updated_at'=>date('Y-m-d H:i:s')]);
				Session::forget('key');
			}
			
			return redirect('powerpanel/login')->with('message','You are successfully logged out. Thank you and have a great day.');
		}
	
		
}
