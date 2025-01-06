<?php

namespace App\Http\Controllers;

use App\Helpers\Email_sender;
use Config;
use App\AwsSupportLead;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Agent\Agent;
use Request;
use Session;
use Validator;
use App\Helpers\MyLibrary;

class AwsSupportController extends FrontController {

    public function store() {
        $data = Input::all();
        $messsages = array(
            'var_Fname.required' => 'First name field is required',
            'var_Fname.handle_xss' => 'Please enter valid input.',
            'var_Lname.required' => 'Last name field is required',
            'var_Lname.handle_xss' => 'Please enter valid input.',
            'var_message.required' => 'Message is required',
            'var_email.required' => 'Email is required',
            'var_phone.required' => 'Phone is required'
        );
        $rules = array(
            'var_Fname' => 'required|handle_xss',
            'var_Lname' => 'required|handle_xss',
            'var_email' => 'required|email',
            'var_phone' => 'required',
            'var_message' => 'required',
        );
        if (isset($data['var_phone'])) {
            $rules['var_phone'] = 'required';
        }

        $validator = Validator::make($data, $rules, $messsages);

        if ($validator->passes()) {
            
            $awssupport_lead = new AwsSupportLead;
            $awssupport_lead->varFirstName = strip_tags($data['var_Fname']);
            $awssupport_lead->varLastName = strip_tags($data['var_Lname']);
            $EmailID = MyLibrary::encrypt_decrypt('encrypt', $data['var_email']);
            $awssupport_lead->varEmail = $EmailID;

            if (isset($data['var_phone'])) {
                $PhoneNo = MyLibrary::encrypt_decrypt('encrypt', $data['var_phone']);
                $awssupport_lead->varPhoneNo = $PhoneNo;
            } else {
                $awssupport_lead->varPhoneNo = '';
            }
            if (isset($data['var_company'])) {
                $awssupport_lead->varCompany = strip_tags($data['var_company']);
            } else {
                $awssupport_lead->varCompany = '';
            }
            if (isset($data['var_state'])) {
                $awssupport_lead->varState = strip_tags($data['var_state']);
            } else {
                $awssupport_lead->varState = '';
            }
            if (isset($data['var_message'])) {
                $awssupport_lead->txtComments = strip_tags($data['var_message']);
            } else {
                $awssupport_lead->txtComments = '';
            }
            if (isset($data['varRefURL'])) {
                $awssupport_lead->varRefURL = $data['varRefURL'];
            } else {
                $awssupport_lead->varRefURL = null;
            }

            $awssupport_lead->varIpAddress = MyLibrary::get_client_ip();
            $awssupport_lead->save();
            /* Start this code for message */
            if (!empty($awssupport_lead->id)) {
                $recordID = $awssupport_lead->id;
                //Email_sender::AwsSupport($data, $recordID);

                //Store leads in Sales peed CRM ------------------
                $crmData = array();
                $crmData['contact_email'] = isset($data['var_email'])?strip_tags($data['var_email']):"";
                $crmData['first_name'] = isset($awssupport_lead->varFirstName)?$awssupport_lead->varFirstName:"";
                $crmData['user_message'] = isset($awssupport_lead->txtComments)?$awssupport_lead->txtComments:"";
                $crmData['phone_number'] = isset($data['var_phone'])?$data['var_phone']:"";
                //echo '<pre>';print_r($crmData);
                $crmResponse = MyLibrary::sendInquiryToCRM($crmData);
               
                //Store leads in Sales peed CRM ------------------
                //exit;
                if (Request::ajax()) {
                    return json_encode(['success' => 'Thank you for contacting us, We will get back to you shortly.']);
                } else {
//                    echo "Sdfsdfsd11111"; exit;
                    return redirect()->route('aws-support-services/thankyou')->with(['form_submit' => true, 'message' => 'Thank you for contacting us, We will get back to you shortly.']);
                }
                return redirect('/');
            } else {
                return redirect('/');
            }
        } else {
            //return contact form with errors
            if (!empty($data['back_url'])) {
                return redirect($data['back_url'] . '#aws_form')->withErrors($validator)->withInput();
            } else {
                return Redirect::route('aws-support-services')->withErrors($validator)->withInput();
            }
        }
    }

}
