<?php

namespace App\Http\Controllers\Userauth;

use App\Http\Controllers\FrontController;
use App\Front_user;
use App\user_session;
use App\Reset_password; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoginLog;
use Session;
use Cookie;
use App\Helpers\MyLibrary;
use Illuminate\Support\Facades\Mail;
//use App\Mail\SendMailable;
use App\Helpers\Email_sender;
use Hash;
use Socialite;
use DB;
use Carbon\Carbon;
use Config;
use App\Cart;

class FrontRegisterController extends FrontController {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $guard = 'front-user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
//        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                     'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:front_users',
                    'password' => 'required|string|min:6|confirmed',
        ]);
    }

    private function getCurrentTimeIST()
    {
        date_default_timezone_set('UTC');
        return gmdate("Y-m-d H:i:s", time() + 19800);
    }

    public function emailexit(Request $request) {
       $exitsUserEmail = Front_user::where('email', '=', $request->email)->first();
        if (empty($exitsUserEmail)) {
            $userData = MyLibrary::laravelcallapi("isuserexists", ['email' => $request->email]);
            if(isset($userData['id']) && !empty($userData['id'])){
                echo 'false';exit;
            }
            echo 'true';exit;
        } else {
            echo 'false';exit;
        }
        exit;
    }

    public function emailnotexit(Request $request) {
        if (!empty($request->resetemail)) {
            $Email = $request->resetemail;
        } else {
            $Email = $request->loginusername;
        }

        $exitsUserEmail = Front_user::where('email', '=', $Email)->first();
        
        if (empty($exitsUserEmail)) {
            $userData = MyLibrary::laravelcallapi("isuserexists", ['email' => $Email]);
            //echo '<pre>';print_r($userData);exit;
            if(isset($userData['id']) && !empty($userData['id'])){
                echo 'true';exit;
            }
            echo 'false';exit;
        } else {
            echo 'true';exit;
        }
        exit;
    }
   protected function reset_password(array $data) {
    
       date_default_timezone_set('UTC'); $futureTimeIST = gmdate("Y-m-d H:i:s", time() + 300 + 19800);


        $Reset_pass_data = [
                    'whmsc_id' => $data['whmsc_id'],
                    'remember_token' => $data['remember_token'],
                    'reset_flag' => 0,
                    'created_at' => $currentTime = $this->getCurrentTimeIST(),
                    'updated_at' => $futureTimeIST
                    
        ];
            // echo '<pre>'; print_r($Reset_pass_data); exit;

        return Reset_password::create($Reset_pass_data);
    }

    public function checkpassword(Request $request) {

        $exitsUserEmail1 = Front_user::where('email', '=', $request->loginusername)->first();
        if (empty($exitsUserEmail1->id)) {
            $loginValidate = MyLibrary::laravelcallapi("validatelogin", ['email' => $request->loginusername,'password2' => $request->loginpassword]);
            if(isset($loginValidate['userid']) && !empty($loginValidate['userid'])){
                $userData = MyLibrary::laravelcallapi("isuserexists", ['email' => $request->loginusername]);
                if(isset($userData['email']) && !empty($userData['email'])){
                $Requested_Data["fullname"] = $userData['name'];
                $Requested_Data["password"] = $request->loginpassword;
                $Requested_Data["email"] = $userData['email'];
                $Requested_Data["whmsc_id"] = $userData['id'];
                $Requested_Data["currency"] = Config::get('Constant.sys_currency');
                $Requested_Data["currency_code"] = Config::get('Constant.sys_currency_code');
                $insert_data = $this->createuser($Requested_Data);
                }
            }
        }

        $exitsUserEmail = Front_user::where('email', '=', $request->loginusername)->first();
        if (isset($exitsUserEmail->password) && Hash::check($request->loginpassword, $exitsUserEmail->password)) {
            echo 'true';
        } else {
            echo 'false';
        }
        exit;
    }

    public function frontregister(Request $request) {
        //$sessionAll = $request->session()->all(); echo '<pre>';print_r($sessionAll);exit;
            $_username = Session::has('fullname')?Session::get('fullname'):"";
            $_firstname = Session::has('firstname')?Session::get('firstname'):"";
            $_lastname = Session::has('lastname')?Session::get('lastname'):"";
            $_email = Session::has('email')?Session::get('email'):"";
            $_password = Session::has('password')?base64_decode(Session::get('password')):"";

        if (!empty($_email)) {

            $exitsUserEmail = Front_user::where('email', '=', $_email)->first();
            /*if ($exitsUserEmail) {
                return redirect('/')->withErrors($validator)->withInput()->withErrors(['email' => "The email address that you've entered is already exit in our database."]);
            }*/
            
            //Do not create registration if OTP Verification is failed!
            if(Session::has('otpphoneverification') && Session::get('otpphoneverification') == 1){  $Requested_Data["chr_otpverification"] =  'Y'; $Requested_Data["otpphone"] = Session::get('otpphone'); } 
            else { return redirect('/')->withErrors($validator)->withInput()->withErrors(['email' => "OTP Verification failed!"]); }
            
            $countryDialingCodeArr = Mylibrary::getCountryDialingCodeList();
            $countrySession=Session::get('otpcountry');
            $codearr= explode("_",$countrySession);
            $countrycd=$codearr['0'];
            $countrysq=$codearr['1'];
            
            $realCountryCode='';
            foreach($countryDialingCodeArr as $key=>$val){
                if($key==$countrysq){   
                    $realCountryCode=$val['realccode'];
                }
            }
                
            $_varphoneno = "";
            if(Session::has('otpphone') && Session::has('otpcountry') && !empty(Session::has('otpphone'))){
               
                $countrycode = Session::get('otpcountry');
                $cd = explode("_",$countrycode);
                $removecd="+".$cd['0'];
                $chr_otpphone = str_replace($removecd,"",Session::get('otpphone'));
                $_varphoneno = trim($chr_otpphone);
                 
            }
            
            $ccountry=$realCountryCode;
            
            //add new uer in WHMSC
            $UserParam = array('firstname' => $_firstname,'lastname' => $_lastname, 'email' => $_email, 'password2' => $_password, 'country' => $ccountry,'currency' => Config::get('Constant.sys_currency_code'));
            if(!empty($_varphoneno)){ $UserParam['phonenumber'] = $_varphoneno; }
            $Response = MyLibrary::laravelcallapi("addclient", $UserParam);
//            $Response["result"] = 'success';
            if ($Response["result"] == 'success') {
                $Requested_Data = $request->toArray();
                $Requested_Data["whmsc_id"] = $Response["clientid"];
                $Requested_Data["currency"] = Config::get('Constant.sys_currency');
                $Requested_Data["currency_code"] = Config::get('Constant.sys_currency_code');
                $Requested_Data["realCountryCode"] = $ccountry;
                $Requested_Data["fullname"]=$_username;
                $Requested_Data["email"]=$_email;
                $Requested_Data["password"]=$_password;

                $Requested_Data["realCountryCode"] = $realCountryCode;
                if(Session::has('otpphoneverification') && Session::get('otpphoneverification') == 1){  
                    $Requested_Data["chr_otpverification"] =  'Y'; 
                    $Requested_Data["otpphone"] = Session::get('otpphone'); 
                }
                $insert_data = $this->createuser($Requested_Data);
                $Token = md5($insert_data->id + time());
                Front_user::whereId($insert_data->id)->update(array('remember_token' => $Token,'chr_otpverification' => $Requested_Data["chr_otpverification"],'chr_otpphone' => $Requested_Data["otpphone"])); //insert token 
                $whmcsHash = MyLibrary::laravelcallvalidatelogin("validatelogin", array("email" => $request->email,"password2" => $request->password));
                
                //Session validation for user---------------------------
                $IP = $request->ip();
                if(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])){
                   $IP = $_SERVER['HTTP_X_REAL_IP'];
                }
                else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                   $IP = $_SERVER['HTTP_X_FORWARDED_FOR']; 
                }
                else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
                   $IP = $_SERVER['REMOTE_ADDR']; 
                }
                
                
                $WhmscLogin = self::WhmscLogin($_email, ['id'=>$Response["clientid"]]);
                Session::put([
                    'frontlogin' => 'Y',
                    'UserID' => $insert_data->id,
                    'useremail' => $_email,
                    'WhmcsID' => $Response["clientid"],
                    'WhmcsHash' => $whmcsHash,
                    'profilecur' => $Requested_Data["currency"],
                    'user_ses_ip' => $IP,
                    'whmsc_url'=> $WhmscLogin
                ]);
                $HostingParam2 = array('email' => $_email);
                // $WhmscLogin = self::WhmscLogin($_email, $HostingParam2);
                $AllData["name"] = $_username;
                $AllData["email"] = $_email;
                //Email_sender::signup($AllData); //Signup Email sender
                if (!empty($request->session()->get('UserID')) && !$request->session()->has('cart')) {
                    $User_ID = $request->session()->get('UserID');
                    $get_previus_data = user_session::where('user_id', '=', $User_ID)->first();
                    if ($get_previus_data) {
                        $prev_payload = unserialize(base64_decode($get_previus_data->payload));
                        $cartData = $prev_payload;
                        $request->session()->put('cart', $cartData);
                    }
                }

                if (!empty($request->session()->get('cart'))) {
                    
                    return redirect('/cart/billinginfo')->with('whmsc_url', [$WhmscLogin]);
                    //return redirect('/otp-verification');
                } else {
                       return redirect($_SERVER['HTTP_REFERER']);
                    //After registration redirect to otp verification page.
                    // return redirect('/'); home page
                    //return redirect('/otp-verification');
                }
            } else {
//                return redirect('/')->withErrors("Login Problem in Whmsc");
                return redirect('/')->with('2failed_login', "Login failed Please try again with enter correct username and password.");
            }
        } else {
//            return redirect('/')->withErrors($validator)->withInput();
            return redirect('/')->with('1failed_login', "Login failed Please try again with enter correct username and password.");
        }
    }
    
    public function confirmemail(Request $request) {
        $email = base64_decode($request->token);
        $convert_email = mb_convert_encoding($email, 'UTF-8', 'UTF-8');
        $exitsUserEmail = Front_user::where('email', '=', $convert_email)->first();
        if ($exitsUserEmail) {
            Front_user::whereEmail($convert_email)->update(array('email_verify' => 'Yes')); //insert token 
            return view('user.auth.confirmemail');
        } else {
            return redirect('/');
        }
    }

    public function frontlogin(Request $request) {
         $Login_messsages = array(
            'loginusername.required' => 'User Name is required.',
            'loginusername.email' => 'User Name is not valid.',
            'loginusername.handle_xss' => 'Please enter valid input.',
            'loginpassword.required' => 'Password is required.'
        );
        $Login_rules = [
            'loginusername' => 'required|email',
            'loginusername.exists' => 'Email not registered',
            'loginpassword' => 'required',
        ];
        $Login_validator = Validator::make($request->all(), $Login_rules, $Login_messsages);
        if ($Login_validator->passes()) {
            $exitsUserEmail = Front_user::where('email', '=', $request->loginusername)->first();
//            dd($exitsUserEmail);
            if (empty($exitsUserEmail)) {
                 // Redirect back to login page if email is not registered
                return redirect()->back()->withInput()->withErrors(['loginusername' => "Email ID does not exist in our record(s)!"]);
                // return redirect('/')->withErrors($Login_validator)->withInput()->withErrors(['loginusername' => "The email ID you've entered doesn't match any records."]);
            } else if (Hash::check($request->input('loginpassword'), $exitsUserEmail->password)) {
                $remember = isset($request->remember) ? true : false;
                $HostingParam2 = array('email' => $request->loginusername); 
                $whmcsHash = MyLibrary::laravelcallvalidatelogin("validatelogin", array("email" => $request->loginusername,"password2" => $request->loginpassword));
                //$whmcsHash = file_get_contents('https://www.hostitsmart.com/manage/validatelogin.php?email='.$request->loginusername.'&password2=123');
                //$whmcsHash = 'c24c82fc4818a95f18cf5bf1c342111be9bd6197';
                //echo $whmcsHash;exit;
                
                // $WhmscLogin = self::WhmscLogin($request->loginusername, $HostingParam2);
                $WhmscLogin = self::WhmscLogin($request->loginusername,['id' => $exitsUserEmail->whmsc_id]);


                if ($remember == 1) {
                    Cookie::queue(Cookie::make('front_cookie_login_email', $request->loginusername));
                    Cookie::queue(Cookie::make('front_cookie_login_password', $request->loginpassword));
                    Cookie::queue(Cookie::make('front_remember', $request->remember));
                } else {
                    Cookie::queue(Cookie::forget('front_cookie_login_email', ''));
                    Cookie::queue(Cookie::forget('front_cookie_login_password', ''));
                    Cookie::queue(Cookie::forget('front_remember', ''));
                }
                $log = new LoginLog;
                $ID = $exitsUserEmail->id;
                $WhmcsID = $exitsUserEmail->whmsc_id;
                $log['fkIntUserId'] = $ID;
                $log['varIpAddress'] = MyLibrary::get_client_ip();
                $log['logintype'] = 'front';
                $log->save();
                if(isset($WhmcsID) && !empty($WhmcsID)){ $clientDetails = Cart::getClientDetails($WhmcsID); }
                
                //Session validation for user--------------------------- 
                $IP = $request->ip();
                if(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])){
                   $IP = $_SERVER['HTTP_X_REAL_IP'];
                }
                else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                   $IP = $_SERVER['HTTP_X_FORWARDED_FOR']; 
                }
                else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
                   $IP = $_SERVER['REMOTE_ADDR']; 
                }
                 
                Session::put([
                    'frontlogin' => 'Y',
                    'UserID' => $ID,
                    'useremail' => $request->loginusername,
                    'WhmcsID' => $WhmcsID,
                    'WhmcsHash' => $whmcsHash,
                    'whmcsloginurl' => $WhmscLogin,
                    'whmsc_url' => $WhmscLogin,                    
                    'profilecur' => $clientDetails['currency_code'],
                    'user_ses_ip' => $IP
                ]);
                

                
                if (!empty($request->session()->get('UserID'))) {
                    $User_ID = $request->session()->get('UserID');
                    $Current_Payload = (array)$request->session()->get('cart');
                    if(!empty($Current_Payload)){
                            if(array_key_exists('userid',$Current_Payload))        { unset($Current_Payload['userid']); }
                            if(array_key_exists('paymentmethod',$Current_Payload)) { unset($Current_Payload['paymentmethod']); }
                            if(array_key_exists('recommndation',$Current_Payload)) { unset($Current_Payload['recommndation']); }            
                            if(array_key_exists('prmocode',$Current_Payload))      { unset($Current_Payload['prmocode']); }
                            if(array_key_exists('prmodiscount',$Current_Payload))  { unset($Current_Payload['prmodiscount']); }
                            if(array_key_exists('prmomessage',$Current_Payload))   { unset($Current_Payload['prmomessage']); }
                    }
                    $get_previus_data = user_session::where('user_id', '=', $User_ID)->first();
                    $prev_payload = [];
                    if ($get_previus_data) {
                        $prev_payload = unserialize(base64_decode($get_previus_data->payload));
                    }

                    /*echo '<pre>';print_r($Current_Payload);
                    echo "\n -------------------------------\n";
                    echo '<pre>';print_r($prev_payload);exit;*/
                    if(empty($Current_Payload)){
                        $Current_Payload['userid'] = $request->session()->get('WhmcsID');
                        $Current_Payload['paymentmethod'] = "ebs";
                        $Current_Payload['recommndation'] = '';
                    }
                    $Merge_array = array_unique(array_merge($Current_Payload, $prev_payload), SORT_REGULAR);
                    $tmpMerge_array = serialize($Merge_array);
                    if (function_exists('mb_strlen')) {
                        $size = mb_strlen($tmpMerge_array, '8bit');
                        // return $size;exit;
                    }else {
                        $size = strlen($tmpMerge_array);
                    }

                    /*
                    44147 => allow above that value,
                    48148 => last allow, checked,
                    48152 => not allow above that last checked
                    */
                    // if ($size > Config::get('Constant.DEFAULT_CARTLEN') ) {
                    // if ($size <= "49000" || $size <= "48152") {
                    if ($size > '43000') {
                        if (array_key_exists('0',$Merge_array)) {
                            unset($Merge_array[0]);
                        }
                        if (array_key_exists('1',$Merge_array)) {
                            unset($Merge_array[1]);
                        }
                        if (array_key_exists('2',$Merge_array)) {
                            unset($Merge_array[2]);
                        }
                    }
                    $request->session()->put('cart', $Merge_array);
                    Cart::updateCartInDb($request,$Merge_array);
                }

                if(isset($WhmcsID) && !empty($WhmcsID)){
                
                if(isset($clientDetails['currency_code']) && !empty($clientDetails['currency_code'])){
                    if($clientDetails['currency_code'] != Config::get('Constant.sys_currency')){
                        //set cart currecny according to profile
                        Self::setcurrency($request);
                    }
                }
                }

                if(!empty($request->session()->get('cart'))){
                            $cartData = $request->session()->get('cart');
                            if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
                            if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
                            if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
                            if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
                            if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
                            if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
                    }

                if (!empty($cartData)) {
                    return redirect('/cart/billinginfo')->with('whmsc_url', [$WhmscLogin]);
                } else {
                    $userOTPData = Front_user::where('chr_otpverification', '=', 'Y')->where('id', '=', $ID)->first();
                    if(isset($userOTPData->chr_otpverification) && $userOTPData->chr_otpverification == 'Y')
                    {
                         // return redirect($WhmscLogin); // client area
    $url = $request->previous_url;
    // echo $url;
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        // return redirect($url); // previous URL
        return redirect('/');
    } else {
        return redirect()->back(); // fallback to previous page
    }
                 }
                    else
                    { return redirect('/otp-verification'); }
                }
//                return redirect()->back();
            } else {
//                return redirect('/')->withErrors($Login_validator)->withInput();
                // return redirect('/')->with('failed_login', "Login failed Please try again with enter correct username and password.");

                // Return redirect to login page if password does not match with records                
                return redirect()->back()->withInput()->withErrors(['loginpassword' => "Password does not exist in our record(s)!"]);                

            }
        } else {
//            return redirect('/')->withErrors($Login_validator)->withInput();
            return redirect('/')->with('failed_login', "Login failed Please try again with enter correct username and password.");
        }
    }

    public function WhmscLogin($Email, $postfields) {
        $apiUrl = config('app.api_url'); 
        $apiurl_new = $apiUrl . '/logintowhmcs.php';
        //Logic: Call to whmcs external api
        //parameters: according to api requirements
        //return:  data retrieved from API calls in JSON Format
        $fields = http_build_query($postfields);
        $ch = curl_init($apiurl_new);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        $result = curl_exec($ch);
        
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl_new. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (WhmscLogin): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }

        curl_close($ch);
        return $result;
    }

    public function forgotpassword(Request $request) {
        $AllData = $request->all();
        $Login_messsages = array(
            'resetemail.required' => 'User Name is required.',
            'resetemail.email' => 'User Name is not valid.',
            'resetemail.handle_xss' => 'Please enter valid input.',
        );
        $Login_rules = [
            'resetemail' => 'required|email',
            'resetemail.exists' => 'Email not registered',
        ];
        $Reset_password_validator = Validator::make($request->all(), $Login_rules, $Login_messsages);
        if ($Reset_password_validator->passes()) {
            
            //Check if user exist in whmcs
            $userData = MyLibrary::laravelcallapi("isuserexists", ['email' => $request->resetemail]); 
            //echo '<pre>';print_r($userData);exit;
            if(isset($userData['email']) && !empty($userData['email'])){ 
                $Requested_Data["fullname"] = $userData['name'];
                $Requested_Data["password"] = '';
                $Requested_Data["email"] = $userData['email'];
                $Requested_Data["whmsc_id"] = $userData['id'];
                $Requested_Data["currency"] = Config::get('Constant.sys_currency');
                $Requested_Data["currency_code"] = Config::get('Constant.sys_currency_code');
                $insert_data = $this->createuser($Requested_Data);
            }

            $User_Data = Front_user::where('whmsc_id', '=', $userData['id'])->first();
            if(isset($User_Data['email']) && !empty($User_Data['email']))
            {
                $Requested_Data_1["remember_token"] = $User_Data->remember_token;          
               
                $Requested_Data_1["whmsc_id"] = $User_Data['whmsc_id'];
               
               $insert_data = $this->reset_password($Requested_Data_1);    // insert reset_password           

            }
            
            $exitsEmail = Front_user::where('email', '=', $request->resetemail)->first();
            if (empty($exitsEmail)) {

                return redirect('/')->withErrors($Reset_password_validator)->withInput()->withErrors(['resetemail' => "The login information you've entered doesn't match any records."]);
            } else {
//                $this->mail($exitsEmail->name, $exitsEmail->remember_token);
                $AllData["name"] = $exitsEmail->name;
                $AllData["rem_token"] = $User_Data->remember_token;
                Email_sender::forgotpass($AllData);
          return response()->json(1);

    //              return response()->json([
    //     'success' => true,
    //     'message' => 'We have sent a reset password link to your email, so kindly check your inbox.',
    //     'redirect' => 'https://www.hostitsmart.com/login'
    // ]);
                 // return 1; //for popup show
                // return redirect('thankyou')->with(['form_submit' => true, 'message' => 'We have sent reset password link in your email, so kindly check your inbox.']);
            }
        } else {
            return redirect('/')->withErrors($Reset_password_validator)->withInput();
        }
    }

    public function userlogout(Request $request) {
        if (null !== Session::get('UserID') && (Session::get('UserID') != "")) {
            Session::forget('UserID');
            Session::forget('WhmcsID');
            Session::forget('frontlogin');
            
            Session::forget('useremail');
            Session::forget('gstnumber');
            Session::forget('city');
            Session::forget('state');
            Session::forget('country');
            Session::forget('postalcode');
            Session::forget('firstname');
            Session::forget('lastname');
            Session::forget('whmsc_url');
            
            if (Session::get('cart'))
                Session::pull('cart');
        }
        return redirect('/')->with('message', 'You are successfully logged out. Thank you and have a great day.');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createuser(array $data) {
        if(isset($data['tc']) && $data['tc']=="on"){
            $market_update="Y";}
        else{
            $market_update="N";
        }
        $date = date('Y-m-d H:i:s');
        $Token = '';
        if(isset($data["whmsc_id"]) && !empty($data["whmsc_id"])){
            $Token = md5($data["whmsc_id"] . time());
        }
        $realCountryCode = '';
        if(isset($data['realCountryCode']) && !empty($data['realCountryCode'])){
            $realCountryCode = $data['realCountryCode'];
        }
        $clientData = [
                    'whmsc_id' => $data["whmsc_id"],
                    'currency' => $data['currency'],
                    'currency_code' => $data['currency_code'],
                    'country_code' => $realCountryCode,
                    'name' => $data['fullname'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'provider' => "website",
                    'provider_id' => "",
                    'varimage' => "",
                    'market_update' => $market_update,
                    'chr_delete' => "N",
                    'chr_publish' => "Y",
                    'remember_token' => $Token,
                    'varIpAddress' => MyLibrary::get_client_ip(),
                    'created_at' => $date,
                    'updated_at' => $date
        ];
        return Front_user::create($clientData);
    }

    public function resetpassword(Request $request, string $token) {
        $reset_pass_Data = Reset_password::where('remember_token', '=', $token)->latest()->first();
        $currentTime = $this->getCurrentTimeIST();
        if ($reset_pass_Data->reset_flag == 1){
            return view('errors.403_access_denied');}
        else {
                if(date("Y-m-d H:i:s", strtotime($reset_pass_Data->updated_at)) <= $currentTime){
                return view('errors.403_access_denied');
            }
                else{
                    return view('user.auth.reset');
                }
            }
        return view('user.auth.reset');
    }

    public function updatepassword(Request $request) {
        $AllData = $request->all();
        $Login_rules_update_password = array(
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        );
        $Login_messsages_update_password = array(
            'resetpassword.required' => 'password is required',
            'password_confirmation.required' => 'confirm password is required',
            'resetpassword.confirmed' => 'password not confirm'
        );
        $update_password_validator = Validator::make($request->all(), $Login_rules_update_password);
        if ($update_password_validator->passes()) {
            $update_password = Front_user::whereRemember_token($request->remember_token)->update(array('password' => bcrypt($request->password))); //update password

            $update_password = Reset_password::whereRemember_token($request->remember_token)->update(array('reset_flag' => 1)); //update Reset_flag

            $User_Data = Front_user::where('remember_token', '=', $request->remember_token)->first();
            if(isset($User_Data->whmsc_id) && !empty($User_Data->whmsc_id))
            { MyLibrary::laravelcallapi("updateclient", array('clientid' => $User_Data->whmsc_id,'password2' => $request->password)); }
            if ($update_password) {
                $AllData["name"] = $User_Data->name;
                $AllData["email"] = $User_Data->email;
                Email_sender::passwordupdate($AllData);
                return redirect('thankyou')->with(['form_submit' => true, 'message' => 'Congratulations! Your password has been successfully updated. Please login with new password in future.']);
            }
        } else {
            return redirect()->back()->withErrors($update_password_validator)->withInput();
        }
    }

//    public function mail($name, $token) {
//        $reset_link = url('/reset-passwod/' . $token);
//        $Subject = "HITS: Password Reset";
//        $blade_file = 'emails.resetpass';
//        Mail::to('nayan.parmar@netclues.com')->send(new SendMailable($name, $reset_link, $Subject, $blade_file));
//        return redirect('/')->with('message', 'Email Sent.');
//    }
//
//    public function updatepassword_email($name, $email) {
//        $reset_link = '';
//        $Subject = "HITS: Password updated successfully";
//        $blade_file = 'emails.resetpass_thankyou';
//        Mail::to("nayan.parmar@netclues.com")->send(new SendMailable($name, $reset_link, $Subject, $blade_file));
//        return redirect('/')->with('message', 'Email Sent.');
//    }
    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider, Request $request) {
        if (!empty($request->error) || !empty($request->denied)) {
            return redirect('/')->with('failed_login', "Login failed Please try again with enter correct username and password.");
        }
        //$allVar = $request->all();
        //echo '<pre>';print_r($allVar);exit;
        $user = Socialite::driver($provider)->user();
//        dd($user);
        if (!empty($user->email)) {
            $UserEmailExit = Front_user::where('email', '=', $user->email)->first();
            if ($UserEmailExit) {
                $SocialResponse["result"] = 'success';
                $Whmsc_id = $UserEmailExit->whmsc_id;
            } else {
                $SocialUserParam = array('firstname' => $user->name, 'email' => $user->email, 'password2' => 'Admin@123', 'country' => 'IN');
                $SocialResponse = MyLibrary::laravelcallapi("addclient", $SocialUserParam);
                $Whmsc_id = $SocialResponse["clientid"];
            }
            if ($SocialResponse["result"] == 'success') {
                $currency_array["currency"] = Config::get('Constant.sys_currency');
                $currency_array["currency_code"] = Config::get('Constant.sys_currency_code');

                if ($UserEmailExit) {
                    $authUser = $UserEmailExit;
                } else {
                    $authUser = $this->CreateSocialMediaUser($user, $provider, $Whmsc_id, $currency_array);
                }

                if (!empty($authUser)) {
                    $Token = md5($authUser->id + time());
                    Front_user::whereId($authUser->id)->update(array('remember_token' => $Token)); //insert token 
                    Session::put([
                        'frontlogin' => 'Y',
                        'UserID' => $authUser->id,
                        'WhmcsID' => $Whmsc_id
                    ]);

                    if (!$UserEmailExit) {
                        $AllData["name"] = $user->name;
                        $AllData["email"] = $user->email;
                        Email_sender::signup($AllData);
                    }
                    $HostingParam2 = array('email' => $authUser->email);
                    $WhmscLogin = self::WhmscLogin($authUser->email, $HostingParam2);


                }

                if (!empty($request->session()->get('UserID')) && !$request->session()->has('cart')) {
                    $User_ID = $request->session()->get('UserID');
                    $get_previus_data = user_session::where('user_id', '=', $User_ID)->first();
                    if ($get_previus_data) {
                        $prev_payload = unserialize(base64_decode($get_previus_data->payload));
                        $cartData = $prev_payload;
                        $request->session()->put('cart', $cartData);
                    }
                }

                if (!empty($request->session()->get('cart'))) {
                    return redirect('/cart/billinginfo')->with('whmsc_url', [$WhmscLogin]);
                } else {
                    $userOTPData = Front_user::where('chr_otpverification', '=', 'Y')->where('id', '=', $authUser->id)->first();
                    if(isset($userOTPData->chr_otpverification) && $userOTPData->chr_otpverification == 'Y')
                    { return redirect($WhmscLogin); }
                    else
                    { return redirect('/otp-verification'); }
                }
            } else {
                return redirect('/')->with('failed_login', "Login failed Please try again with enter correct username and password.");
            }
        } else {
            return redirect('/')->with('email_not_found', 'You need to grant email permission on your Facebook account to continue.');
        }
    }

    public function CreateSocialMediaUser($user, $provider, $WhmcsID, $currency_data) {
        $authUser = Front_user::where('provider_id', $user->id)->first();
        

        if ($authUser) {
            return $authUser;
        }

        $date = date('Y-m-d H:i:s');
        return Front_user::create([
                    'whmsc_id' => $WhmcsID,
                    'currency' => $currency_data['currency'],
                    'currency_code' => $currency_data['currency_code'],
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt("Admin@123"),
                    'provider' => $provider,
                    'provider_id' => $user->id,
                    'varimage' => $user->avatar,
                    'chr_delete' => "N",
                    'chr_publish' => "Y",
                    'remember_token' => '',
                    'created_at' => $date,
                    'updated_at' => $date
        ]);
    }

    public function CreateSessionUserID($UserID) {   // currently no any use for this but dont delete now
        if (!empty($UserID) && session()->has('cart')) {
            $session_id = session()->getId();
            $exitsUser = user_session::where('user_id', '=', $UserID)->first();
            $cart_array = Session::get('cart');
            if(!empty($cart_array)){
                if(array_key_exists('userid',$cart_array))        { unset($cart_array['userid']); }
                if(array_key_exists('paymentmethod',$cart_array)) { unset($cart_array['paymentmethod']); }
                if(array_key_exists('recommndation',$cart_array)) { unset($cart_array['recommndation']); }            
                if(array_key_exists('prmocode',$cart_array))      { unset($cart_array['prmocode']); }
                if(array_key_exists('prmodiscount',$cart_array))  { unset($cart_array['prmodiscount']); }
                if(array_key_exists('prmomessage',$cart_array))   { unset($cart_array['prmomessage']); }
            }

            $Current_Payload = $cart_array;
            if ($exitsUser) {
                $get_previus_data = user_session::where('user_id', '=', $UserID)->first(); // get previously session data for user
                $prev_payload = unserialize(base64_decode($get_previus_data->payload));
                $Merge_array = array_unique(array_merge($Current_Payload, $prev_payload), SORT_REGULAR);
                $update_payload = base64_encode(serialize($Merge_array));
                $session_data = user_session::whereUser_id($UserID)->update(array('id' => $session_id, 'payload' => $update_payload, 'last_activity' => Carbon::now())); //update session id 
                return $session_data;
            } else {
                $ip_address = \Request::ip();
                $useragent = $_SERVER['HTTP_USER_AGENT'];
                $session_data = user_session::insert([
                            'id' => $session_id,
                            'user_id' => $UserID,
                            'ip_address' => $ip_address,
                            'user_agent' => $useragent,
                            'payload' => base64_encode(serialize($Current_Payload)),
                            'last_activity' => Carbon::now(),
                ]);
            }
        } else {
            return redirect()->back();
        }
    }
    public function optverification(Request $request) {
        $errormsg = Session::get('errormsg');
        //$ccountry = $ccountry = (Config::get('Constant.sys_country'))?Config::get('Constant.sys_country'):'N/A';
        //$countryCMB = Cart::generateCountryCombo($ccountry, "country");
        $countryDialingCodeData = Mylibrary::getCountryDialingCodeList(); 
        $countryCodeData=Mylibrary::getCountrieslist();
        return view('otp.verification', ['errormsg' => $errormsg,'countryDialingCode' => $countryDialingCodeData,'countryCode' => $countryCodeData]);
    }
    public function otpverify(Request $request){
        $errormsg = Session::get('errormsg');
        return view('otp.verify', ['errormsg' => $errormsg]);
    }
    public function otpsend(Request $request) {
        $data = $request->all();
        $messsages = array('phone_number.required' => 'Phone is required','otpcountry.required'=>'Please select country');
        $rules = array('phone_number' => 'required','otpcountry' => 'required');
        if (isset($data['phone_number'])) { $rules['phone_number'] = 'required'; }
        
        $password = $fullname = $otpcountry = '';
        if(isset($data['password']) && !empty($data['password']))
        { $password=base64_encode($data['password']); }
        
        // if(isset($data['fullname']) && !empty($data['fullname']))
        // { $fullname=$data['fullname']; }

        // if(isset($data['firstname']) && !empty($data['firstname']))
        // { $firstname=$data['firstname']; }

        // if(isset($data['lastname']) && !empty($data['lastname']))
        // { $lastname=$data['lastname']; }

        if(isset($data['firstname']) && !empty($data['firstname']))
        { 
            $firstname=$data['firstname'];
        }else{
            $firstname='';            
        }

        if(isset($data['lastname']) && !empty($data['lastname']))
        { 
            $lastname=$data['lastname'];
        }else{
            $lastname='';            
        }
        
        if(isset($data['otpcountry']) && !empty($data['otpcountry']))
        { $otpcountry=$data['otpcountry']; }
        
        if(isset($data['email']) && !empty($data['email']))
        { $email=$data['email']; }
        
        $fullname = trim($firstname . ' ' . $lastname);      

         // Check if 'otp_time' exists in session
        if (isset($data['is_resend_mail']) && session()->has('otp_time')) {
            $otpTime = session()->get('otp_time');
            $currentTime = now();
            $timeDifference = $currentTime->diffInSeconds($otpTime);

            // Check if 5 minutes have passed
            if ($timeDifference < 60) { // 60 seconds = 5 minutes
                $remainingTime = 60 - $timeDifference;

                return response()->json([
                    'success' => false,
                    'message' => "You can resend the OTP in $remainingTime seconds.",
                ]);
            }
        }

        if($request->ajax()){
        $validator = Validator::make($data, $rules, $messsages);
        if ($validator->passes()) {
            $numberforverification=explode("_",$otpcountry);
            $numberforverification=$numberforverification[0];
            $numberforverification=$numberforverification.$data['phone_number'];
             $sessid = MyLibrary::sendOTP($numberforverification);
                Session::put(['otpsess' => $sessid['Details'],'otpphone' => $data['phone_number'],'otpcountry' => $otpcountry,'firstname' =>$firstname,'lastname' =>$lastname,'fullname' =>$fullname,'email' => $email,'password'=> $password]); 
                return 1;
             }
             else { return 0; }    
        }
        else{
        $validator = Validator::make($data, $rules, $messsages);
        //echo '<pre>';print_r($data);exit;
        if ($validator->passes()) {
             $phone_number=$request->otpcountry.$data['phone_number'];
             $sessid = MyLibrary::sendOTP($phone_number);
             if(isset($sessid['Status']) && $sessid['Status'] == 'Success'){ 
                Session::put(['otpsess' => $sessid['Details'],'otpphone' => $data['phone_number']]);  
                    return redirect('/otp-verify');
                }
                else{ 
                return redirect('otp-verification')->with("errormsg","OTP not sent! Please enter valid phone no.");
                }
            } else {
            //return contact form with errors
            if (!empty($data['back_url'])) {
                return redirect($data['back_url'] . '#contact_form')->withErrors($validator)->withInput();
            } else {
                return Redirect::route('otp-verification')->withErrors($validator)->withInput();
            }
        }
    }
    }
    
    
    public function otpdoverification(Request $request){
         $data = $request->all();
         // echo '<pre>';print_r($data);exit;
         $messsages = array('txt_otp.required' => 'Phone is required');
         $rules = array('txt_otp' => 'required');
         if (isset($data['txt_otp'])) { $rules['txt_otp'] = 'required'; }
         $validator = Validator::make($data, $rules, $messsages);
         if($request->ajax()){

         if ($validator->passes()) {
             $sessid = Session::get('otpsess');
             $response = MyLibrary::doOTPVerification($sessid,$data['txt_otp']);
             
             if($response == 'OTP Matched'){
                $otpphone = Session::put(['otpphoneverification' => '1']);
                $regdata['email']=Session::has('email')?Session::get('email'):"";
                $regdata['password'] = Session::has('password')?base64_decode(Session::get('password')):"";
                $regdata['fullname']=Session::has('fullname')?Session::get('fullname'):"";

                return 1;
                //return $regdata;
             }
             else{
                return 0;
             }
            } else { return 0; }

         } else {
         if ($validator->passes()) {
             $sessid = Session::get('otpsess');
             $response = MyLibrary::doOTPVerification($sessid,$data['txt_otp']);
             
             if($response == 'OTP Matched'){
                $uid = Session::get('UserID');
                $otpphone = Session::get('otpphone');
                Front_user::whereId($uid)->update(array('chr_otpverification' => 'Y','chr_otpphone' => $otpphone));
                $userDetails = Front_user::where('id', '=', $uid)->first();
                
                if(isset($userDetails->whmsc_id) && !empty($userDetails->whmsc_id)) //If user has otp verifed then update same phone no in whmcs profile as well
                { MyLibrary::laravelcallapi("updateclient", array('clientid' => $userDetails->whmsc_id,'phonenumber' => $otpphone)); }
                
                $HostingParam2 = array('email' => $userDetails->email);
                $WhmscLogin = self::WhmscLogin($userDetails->email, $HostingParam2);
                if (!empty($request->session()->get('cart'))) { return redirect('/cart/billinginfo')->with('whmsc_url', [$WhmscLogin]); }
                else{ return redirect($WhmscLogin); }
             }
             else{
                return redirect('otp-verification')->with("errormsg","OTP verification is failed! Please try again later.");
             }
            } else {
            //return contact form with errors
            if (!empty($data['back_url'])) {
                return redirect($data['back_url'] . '#contact_form')->withErrors($validator)->withInput();
            } else {
                return Redirect::route('otp-verification')->with("optfailed",["OTP verification is failed!"])->withInput();
            }
        }
        }
       
    }
    public function loginpage() {
        // echo "1234"; exit;
         return view('user.auth.login_page.login');
    // return view('login');
 }

 public function newresetpassword(Request $request) {

return view('user.auth.login_page.password-reset');

}
    public function setcurrency(Request $request){
            $pricingData = array();
            $cartData_array = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            //echo '<pre>';print_r($cartData_array);exit;
            $selectedCurr = isset($request->cur)?$request->cur:'INR'; //by default currency will be INR.
            //echo "Currency: ".$selectedCurr;
            if (isset($cartData_array) && !empty($cartData_array)) {
                if(array_key_exists('userid',$cartData_array))        { unset($cartData_array['userid']); }
                if(array_key_exists('paymentmethod',$cartData_array)) { unset($cartData_array['paymentmethod']); }
                if(array_key_exists('recommndation',$cartData_array)) { unset($cartData_array['recommndation']); }            
                if(array_key_exists('prmocode',$cartData_array))      { unset($cartData_array['prmocode']); }
                if(array_key_exists('prmodiscount',$cartData_array))  { unset($cartData_array['prmodiscount']); }
                if(array_key_exists('prmomessage',$cartData_array))   { unset($cartData_array['prmomessage']); }
                $productIds = [];
                
                foreach($cartData_array as $cart){

                    if(isset($cart['pid']) && !empty($cart['pid'])) { $productIds[] = $cart['pid']; }

                    if(isset($cart['addonproducts']) && !empty($cart['addonproducts'])){
                        foreach($cart['addonproducts'] as $addon){
                            if(isset($addon['pid']) && !empty($addon['pid'])) { $productIds[] = $addon['pid']; }       
                        }
                    }
                }
                
                $productIds = array_unique($productIds); //remove duplicate productids
                $productIds = array_filter($productIds);
                if(!empty($productIds)){
                    foreach($productIds as $proid){
                        $pricingData[$proid] = Cart::getHostingPricing(['productid' => $proid, 'currencycode' => $selectedCurr]);        
                    }
                }
                //echo '<pre>';print_r($cartData_array);exit;
                foreach($cartData_array as $key => $cart){

                    if(isset($cart['producttype']) && $cart['producttype'] == 'domain')
                    {   //for domains
                        $domainData = Cart::extractTldFromDomain($cart['domain']);
                        
                        if($selectedCurr == "INR"){
                             $cartData_array[$key]['pricing'] = Cart::getDomainPricing(['tlds' => ".".$domainData['tld'], 'currency' => 1]);  //check for Dot in tlds. ".com"
                        }
                        else if($selectedCurr == "USD"){
                             $cartData_array[$key]['pricing'] =  Cart::getDomainPricing(['tlds' => ".".$domainData['tld'], 'currency' => 10]);  //check for Dot in tlds. ".com"   
                        }
                      
                    }
                    else
                    {   //for products
                        if(isset($cart['pid']) && !empty($cart['pid']))
                        {
                            if(isset($pricingData[$cart['pid']]) && !empty($pricingData[$cart['pid']])){ 
                                $cartData_array[$key]['pricing'] = $pricingData[$cart['pid']];
                            }
                        }
                    }
                   

                    //For product addons
                    if(isset($cart['addonproducts']) && !empty($cart['addonproducts'])){
                        foreach($cart['addonproducts'] as $key2 => $addon){

                            if(isset($addon['pricing']) && !empty($addon['pricing']) && is_array($addon['pricing'])) { 
                                foreach($addon['pricing'] as $key3 => $addonPricing){
                                    $cartData_array[$key]['addonproducts'][$key2]['pricing'][$key3] = $pricingData[$addon['pid']][$key3];
                                    if(isset($cartData_array[$key]['addonproducts'][$key2]['desc']) && !empty($cartData_array[$key]['addonproducts'][$key2]['desc']))
                                    { 
                                        if(strpos($cartData_array[$key]['addonproducts'][$key2]['desc'],"only at") != false){
                                            $descstrarr = explode("only at",$cartData_array[$key]['addonproducts'][$key2]['desc']);
                                            
                                            $crrstr = ($selectedCurr == 'INR')?"&#8377;":"&#36;";
                                            if(isset($descstrarr[0]) && !empty($descstrarr[0]))
                                            {   
                                                 $cartData_array[$key]['addonproducts'][$key2]['desc'] = $descstrarr[0] . " only at <span class='rupees'>".$crrstr."</span>".$pricingData[$addon['pid']][$key3]->price ." / ".$pricingData[$addon['pid']][$key3]->duration." months"; 
                                            }

                                        }
                                    }
                                }
                            }

                            if(isset($addon['type']) && !empty($addon['type'])){
                                if($addon['type'] == 'dnsmanagement'){
                                    if($selectedCurr == 'INR'){
                                        $cartData_array[$key]['addonproducts'][$key2]['price'] = Config::get('Constant.DNSMANAGEMENT_PRICE_INR');
                                    }
                                    else if($selectedCurr == 'USD'){
                                        $cartData_array[$key]['addonproducts'][$key2]['price'] = Config::get('Constant.DNSMANAGEMENT_PRICE_USD');
                                    }    
                                }
                                else if($addon['type'] == 'emailforwarding'){
                                    if($selectedCurr == 'INR'){
                                        $cartData_array[$key]['addonproducts'][$key2]['price'] = Config::get('Constant.EMAILFORWARDING_PRICE_INR');
                                    }
                                    else if($selectedCurr == 'USD'){
                                        $cartData_array[$key]['addonproducts'][$key2]['price'] = Config::get('Constant.EMAILFORWARDING_PRICE_USD');
                                    }    
                                }
                                else if($addon['type'] == 'idprotection'){
                                    if($selectedCurr == 'INR'){
                                        $cartData_array[$key]['addonproducts'][$key2]['price'] = Config::get('Constant.IDPROTECTION_PRICE_INR'); 
                                        $cartData_array[$key]['addonproducts'][$key2]['desc'] = "Get your website Privacy Protection only at <span class='rupees'>".Config::get('Constant.IDPROTECTION_PRICE_INR')."</span> / month";
                                    }
                                    else if($selectedCurr == 'USD'){
                                        $cartData_array[$key]['addonproducts'][$key2]['price'] = Config::get('Constant.IDPROTECTION_PRICE_USD');
                                        $cartData_array[$key]['addonproducts'][$key2]['desc'] = "Get your website Privacy Protection only at <span class='rupees'>".Config::get('Constant.IDPROTECTION_PRICE_USD')."</span> / month";
                                    }    
                                }
                            }      
                        }
                    }
                }
                $request->session()->put('cart', $cartData_array);
                Cart::updateCartInDb($request,$cartData_array); //Update current session in db
        }
    }
    
    public function whmcsupdatepassword(Request $request) {
        $AllData = $request->all();
        if(isset($AllData['userid']) && !empty($AllData['userid']) && isset($AllData['password']) && !empty($AllData['password']))
            {   //echo $AllData['userid']." - ".$AllData['password'];
                //if(isset($_SERVER['HTTP_X_REAL_IP']) && $_SERVER['HTTP_X_REAL_IP'] == '35.154.207.59')
                //{ 
                    $update_password = Front_user::where(array('whmsc_id' => $AllData['userid']))->update(array('password' => bcrypt($AllData['password']))); //update password  
                //}
            }
        }

}