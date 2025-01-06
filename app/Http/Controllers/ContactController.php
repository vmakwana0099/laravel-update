<?php

namespace App\Http\Controllers;

use App\ContactInfo;
use App\ContactLead;
use App\Helpers\Email_sender;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Agent\Agent;
use Request;
use Session;
use Validator;
use App\Helpers\MyLibrary;

class ContactController extends FrontController {

    public function create() {

        $agent = new Agent;
        if ($agent->isMobile()) {
            $deviceType = 'mobile';
        } else {
            $deviceType = 'pc';
        }
        $contacts = ContactInfo::getContactDetails();
        $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
        $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        $FaqData = $this->FaqData();
        $ProductData = $this->ProductData();
        $ConactType = ContactLead::getContactType();
        return view('contact', [
            'contact_info' => $contacts,
            'PhoneNumner' => $PhoneNumner,
            'EmailId' => $EmailId,
            'Category' => $ConactType,
            'deviceType' => $deviceType,
            //'FeaturedProductsData' => $ProductData,
            'FaqData' => $FaqData]);
    }
    public function FaqData() {
        $Data = ContactLead::getFaqRecords();
        return $Data;
    }
    public function ProductData() {
       $ProductData = ContactLead::getFeaturedProductsRecords();
        return $ProductData;
    }
    public function crm_apicall($url,$request_headers,$post_fields)
    {
        $authkeyStr  ='G-KaPdSgVkYp3s6v9y$B&E)H@MbQeThW';
        // echo $url;
        // echo '<pre>';print_r($request_headers);
        // echo '<pre>';print_r($post_fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);

        if ($post_fields && !empty($post_fields)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        }
    
        $curl_data = curl_exec($ch);
    
        if (curl_errno($ch)) {
            print "Error: " . curl_error($ch);
            exit();
        }
        
        return json_decode($curl_data,true);
    } 
    
    public function sendInquiryToCRM($data = array()) {
        if(isset($data['contact_email']) && !empty($data['contact_email'])){
        $authkeyStr  ='G-KaPdSgVkYp3s6v9y$B&E)H@MbQeThW';
        $username = 'kartik@netclues.ca';
        $password = 'Admin@2710';
        
        $loginResponse = $this->crm_apicall('https://www.salespeep.com/beta/api/webservices/login',array("authKey:".$authkeyStr),array("email" => $username,"password" => $password));

        if(isset($loginResponse['authKey']) && !empty($loginResponse['authKey'])){
            $leadsArr = array(
            'firstname' => $data['first_name'],
            'email' => $data['contact_email'],
            'notes' => $data['user_message'],
            'phonenumber' => $data['phone_number'],
            'owner_to' => $loginResponse['staffId']
            );
            
            $leadsResponse = $this->crm_apicall('https://www.salespeep.com/beta/api/webservices/addLeadInfo',array("authKey:".$loginResponse['authKey']),$leadsArr);
            return $leadsResponse;exit;
            //echo '<pre>';print_r($leadsResponse);exit;
        }
       
        
        }
    }
    public function store() {
       $arrRequest = $data = Input::all();
        //echo '<pre>';print_r($data);
        //---------------- Google Captcha validation --------------

if(isset($arrRequest['g-recaptcha-response']) && !empty($arrRequest['g-recaptcha-response'])){ $captcha=$arrRequest['g-recaptcha-response']; }
else { return false; }
$captcha = trim($captcha);
$secretKey = Config::get('Constant.GOOGLE_CAPCHA_SECRATE');
$secretKey = trim($secretKey);
$gcaptchaurl = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
// $response = file_get_contents($gcaptchaurl);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $gcaptchaurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
//echo '<pre>';print_r($result);echo '</pre>';exit;
curl_close($ch);
// $response = json_decode( $result, true );
$responseKeys = json_decode( $result, true );
// echo '<pre>';print_r($responseKeys);
if($responseKeys["success"]) { } else { echo "Invalid Captcha";exit; }
//---------------- Google Captcha validation end--------------


        $messsages = array(
            'first_name.required' => 'Name field is required',
            'first_name.handle_xss' => 'Please enter valid input.',
            'contact_email.required' => 'Email is required',
            'phone_number.required' => 'Phone is required'
        );
        $rules = array(
            'first_name' => 'required|handle_xss',
            'contact_email' => 'required|email',
            'phone_number' => 'required',
        );
        if (isset($data['phone_number'])) {
            $rules['phone_number'] = 'required';
        }

        $validator = Validator::make($data, $rules, $messsages);

        if ($validator->passes()) {
//            echo "<pre>";
//            print_r($data); exit;
            $contactus_lead = new ContactLead;
            $contactus_lead->varName = strip_tags($data['first_name']);
            $EmailID = MyLibrary::encrypt_decrypt('encrypt', $data['contact_email']);
            $contactus_lead->varEmail = $EmailID;

            if (isset($data['phone_number'])) {
                $PhoneNo = MyLibrary::encrypt_decrypt('encrypt', $data['phone_number']);
                $contactus_lead->varPhoneNo = $PhoneNo;
            } else {
                $contactus_lead->varPhoneNo = '';
            }
            if (isset($data['user_message'])) {
                $contactus_lead->txtUserMessage = strip_tags($data['user_message']);
            } else {
                $contactus_lead->txtUserMessage = '';
            }
            if (isset($data['var_Category'])) {
                $contactus_lead->fkIntServiceId = $data['var_Category'];
            } else {
                $contactus_lead->fkIntServiceId = null;
            }
            if (isset($data['varRefURL'])) {
                $contactus_lead->varRefURL = $data['varRefURL'];
            } else {
                $contactus_lead->varRefURL = null;
            }

            $contactus_lead->varIpAddress = MyLibrary::get_client_ip();
            $contactus_lead->save();
           
            $this->sendInquiryToCRM($data); //Save inquiry leads to CRM.
            /* Start this code for message */
            if (!empty($contactus_lead->id)) {
                $recordID = $contactus_lead->id;
                Email_sender::contactUs($data, $contactus_lead->id);
                if (Request::ajax()) {
                    return json_encode(['success' => 'Thank you for contacting us, We will get back to you shortly.']);
                } else {
                    return redirect()->route('contact/thankyou')->with(['form_submit' => true, 'message' => 'Thank you for contacting us, We will get back to you shortly.']);
                }
                return redirect('/');
            } else {
                return redirect('/');
            }
        } else {
            //return contact form with errors
            if (!empty($data['back_url'])) {
                return redirect($data['back_url'] . '#contact_form')->withErrors($validator)->withInput();
            } else {
                return Redirect::route('contact')->withErrors($validator)->withInput();
            }
        }
    }

}
