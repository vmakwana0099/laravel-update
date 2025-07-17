<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
use App\Helpers\MyLibrary;

class LoginController extends PowerpanelController
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/powerpanel/dashboard';
    protected $redirectAfterLogout = '/powerpanel';
    protected $guard = 'web';

    public function __construct()
    {
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request, Guard $auth)
    {
        $messages = [
            'email.required' => 'User Name is required.',
            'email.email' => 'User Name is not valid.',
            'password.required' => 'Password is required.'
        ];

        $rules = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $remember = $request->has('remember');

            if (Auth::guard($this->guard)->attempt([
                'email' => $request->email,
                'password' => $request->password,
                'chrPublish' => 'Y',
                'chrDelete' => 'N',
            ], $remember)) {

                if ($remember) {
                    Cookie::queue('cookie_login_email', $request->email);
                    Cookie::queue('cookie_login_password', $request->password);
                    Cookie::queue('remember', $request->remember);
                } else {
                    Cookie::queue(Cookie::forget('cookie_login_email'));
                    Cookie::queue(Cookie::forget('cookie_login_password'));
                    Cookie::queue(Cookie::forget('remember'));
                }

                $log = new LoginLog();
                $log->fkIntUserId = Auth::user()->id;
                $log->varIpAddress = MyLibrary::get_client_ip();
                $log->save();

                Session::put('loghistory_id', Auth::user()->id);

                return redirect()->intended($this->redirectTo);
            } else {
                $user = User::where('email', $request->email)->first();
                if (!$user) {
                    return redirect('powerpanel/login')->withErrors(['email' => "The email address that you've entered doesn't match any records."])->withInput();
                } elseif ($user->chrPublish === 'N') {
                    return redirect('powerpanel/login')->withErrors(['email' => "The email address that you've entered is currently not active."])->withInput();
                } else {
                    return redirect('powerpanel/login')->withErrors(['password' => "The password that you've entered is incorrect."])->withInput();
                }
            }
        }

        return redirect('powerpanel/login')->withErrors($validator)->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        if (Session::has('loghistory_id')) {
            $logid = Session::get('loghistory_id');
            LoginLog::where('id', $logid)->update(['updated_at' => now()]);
            Session::forget('loghistory_id');
        }

        return redirect('powerpanel/login')->with('message', 'You are successfully logged out. Thank you and have a great day.');
    }
}
