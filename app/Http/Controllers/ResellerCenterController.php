<?php

namespace App\Http\Controllers;

use App\ContactInfo;
use App\ResellerCenterLeads;
use App\Helpers\Email_sender;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Agent\Agent;
use Request;
use Session;
use Validator;
use App\Helpers\MyLibrary;

class ResellerCenterController extends FrontController {

    public function create() {
        $agent = new Agent;
        if ($agent->isMobile()) {
            $deviceType = 'mobile';
        } else {
            $deviceType = 'pc';
        }
        
        $FaqData = $this->FaqData();
        $interestedin = MyLibrary::getResellerCenterInterestedIn();
        $countryarr = MyLibrary::getCountrieslist();
        $businesstype = MyLibrary::getResellerCenterBusinessType();
        $payingtype = MyLibrary::getResellerCenterTotalCustomerPaying();
        
        return view('resellercenter', [
            'countrydata' => $countryarr,
            'interestedin' => $interestedin,
            'businesstype' => $businesstype,
            'payingtype' => $payingtype,
            'deviceType' => $deviceType,
            'FaqData' => $FaqData]);
    }
    public function FaqData() {
        $Data = ResellerCenterLeads::getFaqRecords();
        return $Data;
    }
    public function ProductData() {
       $ProductData = ResellerCenterLeads::getFeaturedProductsRecords();
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
        $data = Input::all();

        $messsages = array(
            'fullname.required' => 'Full Name is required',
            'fullname.handle_xss' => 'Please enter valid input.',
            'workemail.required' => 'Work Email is required',
            'phone_number.required' => 'Phone is required'
        );
        $rules = array(
            'fullname' => 'required|handle_xss',
            'workemail' => 'required|email',
            'phone_number' => 'required',
        );
        if (isset($data['phone_number'])) {
            $rules['phone_number'] = 'required';
        }

        $validator = Validator::make($data, $rules, $messsages);

        if ($validator->passes()) {
//            echo "<pre>";
//            print_r($data); exit;
            $contactus_lead = new ResellerCenterLeads;
            $contactus_lead->fullname = strip_tags($data['fullname']);
            $EmailID = MyLibrary::encrypt_decrypt('encrypt', $data['workemail']);
            $contactus_lead->workemail = $EmailID;

            $contactus_lead->companyname = strip_tags($data['companyname']);
            $contactus_lead->companyurl = strip_tags($data['companyurl']);

            if (isset($data['phone_number'])) {
                $PhoneNo = MyLibrary::encrypt_decrypt('encrypt', $data['phone_number']);
                $contactus_lead->phone_number = $PhoneNo;
            } else {
                $contactus_lead->phone_number = '';
            }
            if (isset($data['user_message'])) {
                $contactus_lead->user_message = strip_tags($data['user_message']);
            } else {
                $contactus_lead->user_message = '';
            }
            if (isset($data['interestedin'])) {
                $contactus_lead->interestedin = $data['interestedin'];
            } else {
                $contactus_lead->interestedin = null;
            }
            if (isset($data['businesstype'])) {
                $contactus_lead->businesstype = $data['businesstype'];
            } else {
                $contactus_lead->businesstype = null;
            }
            if (isset($data['totalcustomer'])) {
                $contactus_lead->totalcustomer = $data['totalcustomer'];
            } else {
                $contactus_lead->totalcustomer = null;
            }
            if (isset($data['countrydata'])) {
                $contactus_lead->countrydata = $data['countrydata'];
            } else {
                $contactus_lead->countrydata = null;
            }

            if (isset($data['varRefURL'])) {
                $contactus_lead->varRefURL = $data['varRefURL'];
            } else {
                $contactus_lead->varRefURL = null;
            }

            $contactus_lead->varIpAddress = MyLibrary::get_client_ip();
            $contactus_lead->save();
           
            //$this->sendInquiryToCRM($data); //Save inquiry leads to CRM.
            /* Start this code for message */
            if (!empty($contactus_lead->id)) {
                $recordID = $contactus_lead->id;
                Email_sender::resellerCenter($data, $contactus_lead->id);
                if (Request::ajax()) {
                    return json_encode(['success' => 'Thank you for contacting us, We will get back to you shortly.']);
                } else {
                    return redirect()->route('reseller-program/thankyou')->with(['form_submit' => true, 'message' => 'Thank you for contacting us, We will get back to you shortly.']);
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
