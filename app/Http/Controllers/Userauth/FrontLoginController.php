<?php

namespace App\Http\Controllers\Userauth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\FrontController;
use App\Front_user;
use App\LoginLog;
use Validator;
use Auth;
use Session;
use Hash;
use Cookie;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Crawler\Url;
use App\Helpers\MyLibrary;

class FrontLoginController extends FrontController {
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
    protected $redirectTo = '/home';
    protected $redirectAfterLogout = '/home';
    protected $guard = 'front-user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        if (isset($_COOKIE['locale'])) {
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
        $date = date('Y-m-d H:i:s');
        return Front_user::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'provider' => "website",
                    'provider_id' => "",
                    'varimage' => "",
                    'chr_delete' => "N",
                    'chr_publish' => "Y",
                    'remember_token' => "",
                    'created_at' => $date,
                    'updated_at1' => $date
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, Request $request) {
        $rules = [
            'email' => 'required|email|max:255|unique:front_users',
            'password' => 'required',
        ];
        return Validator::make($data, $rules);
    }

    public function login(Request $request, Guard $auth) {
        
        $messsages = array(
            'email.required' => 'User Name is required.',
            'email.email' => 'User Name is not valid.',
            'email.handle_xss' => 'Please enter valid input.',
            'password.required' => 'Password is required.'
        );
        $rules = [
            'email' => 'required|email',
            'email.exists' => 'Email not registered',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->passes()) {
            $remember = isset($request->remember) ? true : false;
            if (Auth::guard($this->guard)->attempt(['email' => $request->email, 'password' => $request->password, 'chr_publish' => 'Y', 'chr_delete' => 'N'], $remember)) {
                /* code for set cookie for remmeber login */

                if ($remember == 1) {
                    Cookie::queue('cookie_login_email', $request->email);
                    Cookie::queue('cookie_login_password', $request->password);
                    Cookie::queue('remember', $request->remember);
                } else {

                    Cookie::queue(Cookie::forget('cookie_login_email', ''));
                    Cookie::queue(Cookie::forget('cookie_login_password', ''));
                    Cookie::queue(Cookie::forget('remember', ''));
                }

                $log = new LoginLog;
                $log['fkIntUserId'] = Auth::user()['id'];
                $log['varIpAddress'] = MyLibrary::get_client_ip();
                $log->save();
                Session::put('Front_loghistory_id', Auth::user()['id']);
                return $this->sendLoginResponse($request);
            } else {
                $exitsUserEmail = Front_user::where('email', '=', $request->email)->first();
                $exitsUserPassword = Front_user::where('password', '=', $request->password)->first();
                if (empty($exitsUserEmail)) {
                    return redirect('login')->withErrors($validator)->withInput()->withErrors(['email' => "The email address that you've entered doesn't match any records."]);
                } else {
                    if ($exitsUserEmail->chr_publish == "N") {
                        return redirect('login')->withErrors($validator)->withInput()->withErrors(['email' => "The email address that you've entered currently not active."]);
                    }
                }
                if (empty($exitsUserPassword)) {
                    return redirect('login')->withErrors($validator)->withInput()->withErrors(['password' => "The password that you've entered is incorrect."]);
                }
            }
            return redirect()->intended($this->redirectPath());
        } else {
            return redirect('login')->withErrors($validator)->withInput();
        }
    }

    public function logout(Request $request) {

        Auth::logout();
        if (null !== Session::get('Front_loghistory_id') && (Session::get('Front_loghistory_id') != "")) {
            $logid = Session::get('Front_loghistory_id');
            $log = new LoginLog;
            $log->where('id', $logid)->update(['updated_at' => date('Y-m-d H:i:s')]);
            Session::forget('key');
        }

        return redirect('login')->with('message', 'You are successfully logged out. Thank you and have a great day.');
    }

    public function showLoginForm() {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }
        return view('user.auth.login');
    }

}
