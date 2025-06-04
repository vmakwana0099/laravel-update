<?php

namespace App\Http\Controllers\Userauth;

use App\Http\Controllers\FrontController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Front_user;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use Userauth;
use Socialite;
use Session;

class AuthController extends FrontController {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/login';
    protected $guard = 'front-user';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {

        parent::__construct();
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
        $this->middleware('guest')->except('logout');
    }

    /*     * s
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data) {

        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:front_users',
                    'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request) {
        
        $name = $request->name;
        $email = $request->email;
        $token = $request->_token;
        $date = date('Y-m-d H:i:s');
        $RegisterData = Front_user::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => '',
                    'provider' => "website",
                    'provider_id' => "website",
                    'varimage' => '',
                    'chr_delete' => "N",
                    'chr_publish' => "Y",
                    'remember_token' => $token,
                    'created_at' => $date,
                    'updated_at' => $date
        ]);
        
        if($RegisterData){
             return redirect("/");
        }
    }

    public function showLoginForm() {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }
        return view('user.auth.login');
    }

    public function redirectToProvider($provider) {

        return Socialite::driver($provider)->redirect();
    }

    public function showRegistrationForm() {

        return view('user.auth.register');
    }

    public function handleProviderCallback($provider) {
//        echo "dfs";exit;

        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        AuthController::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function login($authUser) {
//        echo "<pre/>";
//        print_r($authUser);exit;
    }

    public function findOrCreateUser($user, $provider) {

        $authUser = Front_user::where('provider_id', $user->id)->first();


        if ($authUser) {
            return $authUser;
        }
        $date = date('Y-m-d H:i:s');
        return Front_user::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => '',
                    'provider' => $provider,
                    'provider_id' => $user->id,
                    'varimage' => $user->avatar,
                    'chr_delete' => "N",
                    'chr_publish' => "Y",
                    'remember_token' => $user->token,
                    'created_at' => $date,
                    'updated_at' => $date
        ]);
    }

}
