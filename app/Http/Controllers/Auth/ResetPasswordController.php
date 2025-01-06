<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Helpers\MyLibrary;
use App\EmailLog;

class ResetPasswordController extends PowerpanelController
{
        /*
        |--------------------------------------------------------------------------
        | Password Reset Controller
        |--------------------------------------------------------------------------
        |
        | This controller is responsible for handling password reset requests
        | and uses a simple trait to include this behavior. You're free to
        | explore this trait and override any methods you wish to tweak.
        |
        */

        use ResetsPasswords;

        /**
         * Where to redirect users after resetting their password.
         *
         * @var string
         */
        protected $redirectTo = 'powerpanel/dashboard';

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
                //$this->middleware('guest');
        }

        /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required|handle_xss',
            'email' => 'required|email|handle_xss',
            'password' => 'required|confirmed|min:6|max:20|check_passwordrules|handle_xss',
        ];
    }

        public function sendResetLinkAjax(Request $request, PasswordBroker $passwords)
        {   
            if( $request->ajax() )
            {

                $this->validate($request, ['email' => 'required|email']);   
                $response = $passwords->sendResetLink($request->only('email'), function($m){
                                $m->subject('Your Password Reset Link');
                });


            
                

                switch ($response)
                {
                        case PasswordBroker::RESET_LINK_SENT:
                                 return[
                                                 'error'=>'false',
                                                 'msg'=>'A password link has been sent to your email address'
                                 ];                          

                        case PasswordBroker::INVALID_USER:
                                 return[
                                                 'error'=>'true',
                                                 'msg'=>"We can't find a user with that email address"
                                 ];
                }
            }
            return false;
        }
}
