<?php

namespace App\Http\Controllers;

use App\ContactInfo;
use App\GoogleContactLead;
use App\Helpers\Email_sender;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Agent\Agent;
use Request;
use Session;
use Validator;
use App\Helpers\MyLibrary;
use App\Http\Controllers\ProductsController;

class GoogleContactController extends FrontController {

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
        $ConactType = GoogleContactLead::getContactType();
        $controller = new ProductsController();
        $ProductData = $controller->index('email','google-apps');
        return view('google-apps-products', [
            'contact_info' => $contacts,
            'PhoneNumner' => $PhoneNumner,
            'EmailId' => $EmailId,
            'Category' => $ConactType,
            'deviceType' => $deviceType,
            'ProductData' => $ProductData,
            'FaqData' => $FaqData]);
    }
    public function FaqData() {
        $Data = GoogleContactLead::getFaqRecords();
        return $Data;
    }
    public function ProductData() {
       $ProductData = GoogleContactLead::getFeaturedProductsRecords();
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
        // Get all input from the request
        $data = request()->all(); // Use request helper

        // Validation rules
        // handle_xss
        $rules = array(
            'name' => 'required|regex:/^[a-zA-Z\s\'-]{2,50}$/',  // Ensure 'handle_xss' is defined as a custom validation rule
            'email' => 'required|email',
            'phone_number' => 'required|regex:/^\+?[0-9\s-]{7,20}$/',
            'companyname' => "required|regex:/^[a-zA-Z0-9&\s\'-]{2,100}$/",
            'domain' => 'required|regex:/^(?!:\/\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/',
            'licenses_no' => 'required|regex:/^[1-9][0-9]*$/',
            'message' => "regex:/^[a-zA-Z0-9\s.,_'!?;:@#%&()-*]*$/",
            'g-recaptcha-response' => 'required'
        );

        // Custom error messages
        $messages = array(
            'name.required' => 'Name field is required',
            'name.regex' => 'Enter valid input.',
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email address.',
            'phone_number.required' => 'Phone number is required',
            'phone_number.regex' => 'Enter a valid phone number.',
            'companyname.required' => 'Company name is required',
            'companyname.regex' => 'Enter valid input.',
            'domain.required' => 'Domain is required',
            'domain.regex' => 'Enter a valid domain (e.g., xyz.com or xyz.co.in).',
            'licenses_no.required' => 'Number of licenses is required',
            'licenses_no.regex' => 'Enter a valid positive number of licenses.',
            'message.regex' => 'Enter a valid message.',
            'g-recaptcha-response.required' => 'Captcha is required',
        );
                    // 'name.handle_xss' => 'Please enter valid input.',

        // Perform validation
        $validator = Validator::make($data, $rules, $messages);
        // If validation fails, return errors



        if ($validator->passes()) {
            $googlecontactus_lead = new GoogleContactLead;
            $googlecontactus_lead->name = strip_tags($data['name']);
            $EmailID = MyLibrary::encrypt_decrypt('encrypt', $data['email']);
            $googlecontactus_lead->varDomain = $data['domain'];
            $googlecontactus_lead->varCompanyName = $data['companyname'];
            $googlecontactus_lead->NoOfLicenses = $data['licenses_no'];
            $googlecontactus_lead->varRefURL = $data['varRefURL'];
            $googlecontactus_lead->varEmail = $EmailID;


            if (isset($data['phone_number'])) {
                $data['phone_number'] = $data['country_code'] . " " .$data['phone_number']; 
                $PhoneNo = MyLibrary::encrypt_decrypt('encrypt', $data['phone_number']);
                $googlecontactus_lead->varPhoneNo = $PhoneNo;
            } else {
                $googlecontactus_lead->varPhoneNo = '';
            }
            if (isset($data['message'])) {
                $googlecontactus_lead->txtUserMessage = strip_tags($data['message']);
            } else {
                $googlecontactus_lead->txtUserMessage = '';
            }

            $googlecontactus_lead->varIpAddress = MyLibrary::get_client_ip();
            $googlecontactus_lead->save();
           
            $this->sendInquiryToCRM($data); //Save inquiry leads to CRM.
            /* Start this code for message */
            if (!empty($googlecontactus_lead->id)) {
                $recordID = $googlecontactus_lead->id;
                Email_sender::googlecontactUs($data, $googlecontactus_lead->id);
                if (Request::ajax()) {
                    return json_encode(['success' => 'Thank you for contacting us, We will get back to you shortly.']);
                } else {
                    return redirect()->route('googlecontact/thankyou')->with(['form_submit' => true, 'message' => 'Thank you for contacting us, We will get back to you shortly.']);
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
