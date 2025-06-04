<?php

/**
 * The FrontController class handels email functions
 * configuration  process (ORM code Updates).
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.1
 * @since     2017-08-17
 * @author    NetQuick
 */

namespace App\Helpers;

use App\EmailLog;
use App\EmailType;
use App\GeneralSettings;
use Config;
use Illuminate\Support\Facades\Mail;
use Request;
use App\ContactLead;
use App\Helpers\MyLibrary;

class Email_sender {

    /**
     * This method handels test email process
     * @return  JSON Object
     * @since   2017-08-17
     * @author  NetQuick
     */
    public static function testMail() {
        $settings = Self::getSettings();
        $settings["subject"] = "Test email";
        $settings['emailType'] = EmailType::getRecords()->checkEmailType('General')->first()->id;
        $settings['from'] = $settings['DEFAULT_EMAIL'];
        $settings['to'] = "testhitsone@gmail.com";
        $settings['sender'] = $settings['SMTP_SENDER_NAME'];
        $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
        $settings['txtBody'] = view('emails.default', $settings)->render();
        $settings['attachmentUrl'] = "https://www.hostitsmart.com/backups/Invoice-209514.pdf";
        $logId = Self::recodLog($settings);
        unset($settings['txtBody']);
        //echo '<pre>';print_r($settings);exit;
        Self::sendEmail('emails.default', $settings, $logId);
        
    }

    /**
     * This method handels contact email process for admin and user
     * @return  Flag contactUs
     * @since   2017-08-17
     * @author  NetQuick
     */
    public static function contactUs($data = null) {
        if ($data != null) {
//            echo "<pre>";
//            print_r($data); exit;
            $ConactTypeName = ContactLead::getContactTypeName($data["var_Category"]);

            $settings = Self::getSettings();
            $settings["user"] = 'admin';
            $settings["first_name"] = $data["first_name"];
            $settings["email"] = $data['contact_email'];
            $settings["var_Category"] = $ConactTypeName->varTitle;
            $settings["phone_number"] = (isset($data["phone_number"]) ? $data["phone_number"] : '');
            $settings["user_message"] = (isset($data["user_message"])) ? $data["user_message"] : "";

            #Admin Email================================
            $data['user'] = 'admin';
            $settings["subject"] = "New Contact Enquiry Received - " . $settings['SITE_NAME'];
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Contact Us Lead')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $settings['DEFAULT_CONTACTUS_EMAIL'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.contactmail', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.contactmail', $settings, $logId);

            #User Email================================
            $settings['user'] = 'user';
            $settings["subject"] = $settings['SITE_NAME']." - Thank you for contacting";
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Contact Us Lead')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $data['contact_email'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['first_name'];
            $settings['txtBody'] = view('emails.contactmail', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.contactmail', $settings, $logId);
        }
    }

     public static function googlecontactUs($data = null) {
        if ($data != null) {
//            echo "<pre>";
//            print_r($data); exit;

            $settings = Self::getSettings();
            $settings["user"] = 'admin';
            $settings["first_name"] = $data["name"];
            $settings["email"] = $data['email'];
            $settings["companyname"] = $data['companyname'];
            $settings["domain"] = $data['domain'];
            $settings["licenses_no"] = $data['licenses_no'];
            $settings["phone_number"] = (isset($data["phone_number"]) ? $data["phone_number"] : '');
            $settings["user_message"] = (isset($data["message"])) ? $data["message"] : "";

            #Admin Email================================
            $data['user'] = 'admin';
            $settings["subject"] = "New Google Contact Enquiry Received - " . $settings['SITE_NAME'];
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Google Contact Us Lead')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $settings['DEFAULT_EMAIL'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.googlecontactmail', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.googlecontactmail', $settings, $logId);

            #User Email================================
            $settings['user'] = 'user';
            $settings["subject"] = "Thank You for Your Google Workspace Purchase Request!";
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Google Contact Us Lead')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $data['email'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['first_name'];
            $settings['txtBody'] = view('emails.googlecontactmail', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.googlecontactmail', $settings, $logId);
        }
    }

    public static function careersMail($data = null) {
        if ($data != null){
            // echo '<pre>';print_r($data['insertedData']);exit;
            $settings = Self::getSettings();
            // echo '<pre>';print_r($settings);exit;

            $settings["first_name"] = $data['insertedData']->varfirstname;
            $settings["email"] = MyLibrary::encrypt_decrypt('decrypt', $data['insertedData']->varemail);
            $settings["var_Category"] = $data['insertedData']->careerscategory->varMetaTitle;
            $settings["phone_number"] = $data['insertedData']->intphonenumber;
            $settings["user_message"] = $data['insertedData']->txtmessage;
            $settings["experience"] = $data['insertedData']->varexperience;

            $settings["subject"] = "New Careers Enquiry Received - " . $settings['SITE_NAME'] . " - " . $settings['email'];
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Careers Lead')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $settings['DEFAULT_CAREERS_EMAIL'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['attachmentUrl'] = public_path('/careers_uploads/'.date('Y')).'/'.$data['insertedData']->txtfile;
            $settings['attachment'] = $settings['attachmentUrl'];
            $settings['txtBody'] = view('emails.careerstemplate', $settings)->render();

            // echo '<pre>';print_r($settings);exit;

            $logId = Self::recodLog($settings);
            Self::sendEmail('emails.careerstemplate', $settings, $logId);
        }
    }

    public static function resellerCenter($data = null) {
        if ($data != null) {
            
            $interestedin = MyLibrary::getResellerCenterInterestedIn($data["interestedin"]);
            $businesstype = MyLibrary::getResellerCenterBusinessType($data["businesstype"]);
            $totalcustomer = MyLibrary::getResellerCenterTotalCustomerPaying($data["totalcustomer"]);
            $countrydata = MyLibrary::getCountrieslist($data["countrydata"]);

            $settings = Self::getSettings();
            $settings["user"] = 'admin';
            $settings["fullname"] = $data["fullname"];
            $settings["workemail"] = $data['workemail'];
            $settings["interestedin"] = $interestedin;
            $settings["businesstype"] = $businesstype;
            $settings["totalcustomer"] = $totalcustomer;
            $settings["countrydata"] = $countrydata;
            $settings["companyname"] = $data['companyname'];
            $settings["companyurl"] = $data['companyurl'];
            $settings["phone_number"] = (isset($data["phone_number"]) ? $data["phone_number"] : '');
            $settings["user_message"] = (isset($data["user_message"])) ? $data["user_message"] : "";

            #Admin Email================================
            $data['user'] = 'admin';
            $settings["subject"] = "New Reseller Enquiry Received - " . $settings['SITE_NAME'];
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Contact Us Lead')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $settings['DEFAULT_CONTACTUS_EMAIL'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.resellercentermail', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.resellercentermail', $settings, $logId);

            #User Email================================
            $settings['user'] = 'user';
            $settings["subject"] = $settings['SITE_NAME']." - Thank you for contacting";
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Contact Us Lead')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $data['workemail'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['fullname'];
            $settings['txtBody'] = view('emails.resellercentermail', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.resellercentermail', $settings, $logId);
        }
    }

    public static function AwsSupport($data = null) {
        if ($data != null) {
            $settings = Self::getSettings();
            $settings["user"] = 'admin';
            $settings["var_Fname"] = $data["var_Fname"];
            $settings["var_Lname"] = $data["var_Lname"];
            $settings["var_email"] = $data['var_email'];
            $settings["var_phone"] = (isset($data["var_phone"]) ? $data["var_phone"] : '');
            $settings["var_company"] = (isset($data["var_company"]) ? $data["var_company"] : '');
            $settings["var_state"] = (isset($data["var_state"]) ? $data["var_state"] : '');
            $settings["var_message"] = (isset($data["var_message"])) ? $data["var_message"] : "";

            #Admin Email================================
            $data['user'] = 'admin';
            $settings["subject"] = $settings['SITE_NAME']." - New Contact Enquiry Received";
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Aws Support Lead')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $settings['DEFAULT_CONTACTUS_EMAIL'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.aws', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.aws', $settings, $logId);
        }
    }

    public static function DomainInquiry($data = null) {
        if ($data != null) {
            $settings = Self::getSettings();
            $settings["user"] = 'admin';
            $settings["first_name"] = $data["varName"];
            $settings["email"] = $data['varEmail'];
            $settings["domain"] = $data['dname'];

            $settings["phone_number"] = (isset($data["varPhone"]) ? $data["varPhone"] : '');
            $settings["user_message"] = (isset($data["varMessage"])) ? $data["varMessage"] : "";

            #Admin Email================================
            $data['user'] = 'admin';
            $settings["subject"] = $settings['SITE_NAME']." - New Domain Transfer Enquiry Received";
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Domain transfer Inquiry')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $settings['DEFAULT_CONTACTUS_EMAIL'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.domaininquiry', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.domaininquiry', $settings, $logId);
        }
    }

    public static function signup($data = null) {
        if ($data != null) {
            $settings = Self::getSettings();
            //echo '<pre>';print_r($settings);exit;
            $settings["first_name"] = $data["name"];
            $settings["email"] = $data['email'];
            $settings["confirm_link"] = url('/')."/email-confirm/".base64_encode($data['email']);
            

            #Admin Email================================
            $settings["subject"] = "Welcome to ".$settings['SITE_NAME'];
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('SignUp')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $data['email'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.signup', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.signup', $settings, $logId);
        }
    }

    public static function forgotpass($data = null) {
        //echo '<pre>';print_r($data);exit;
        
        if ($data != null) {
            $settings = Self::getSettings();
            $settings["user"] = 'admin';
            $settings["first_name"] = $data["name"];

            $settings["reset_link"] = url('/reset-passwod/' . $data["rem_token"]);

            #Admin Email================================
            $data['user'] = 'admin';
            $settings["subject"] = $settings['SITE_NAME']." - Action required: Reset your password";
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Domain transfer Inquiry')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            //$settings['to'] = $settings['DEFAULT_CONTACTUS_EMAIL'];
            $settings['to'] = $data['resetemail'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.resetpass', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.resetpass', $settings, $logId);
        }
    }

    public static function passwordupdate($data = null) {
        if ($data != null) {
            $settings = Self::getSettings();
            $settings["user"] = 'admin';
            $settings["name"] = $data["name"];
            $settings["email"] = $data["email"];

            #Admin Email================================
            $data['user'] = 'admin';
            $settings["subject"] = $settings['SITE_NAME']." - Password updated successfully";
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Domain transfer Inquiry')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $data["email"];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.resetpass_thankyou', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            Self::sendEmail('emails.resetpass_thankyou', $settings, $logId);
        }
    }

    /**
     * This method sends email
     * @return  Flag
     * @since   2017-08-17
     * @author  NetQuick
     */
    public static function sendEmail($view = null, $settings = null, $logId = null) {
        if (!empty($settings) && $logId > 0 && $view != null) {

            if(!empty($settings['attachmentUrl'])){
                $sent = Mail::send($view, $settings, function ($message) use ($settings) {
                        $message->from($settings['from'], $settings['sender']);
                        $message->to($settings['to'], $settings['receiver'])->replyTo(Config::get('Constant.DEFAULT_REPLYTO_EMAIL'), Config::get('Constant.SMTP_SENDER_NAME'))->subject($settings['subject'])->attach($settings['attachmentUrl']);
                    });
            }
            else {
                $sent = Mail::send($view, $settings, function ($message) use ($settings) {
                        $message->from($settings['from'], $settings['sender']);
                        $message->to($settings['to'], $settings['receiver'])->replyTo(Config::get('Constant.DEFAULT_REPLYTO_EMAIL'), Config::get('Constant.SMTP_SENDER_NAME'))->subject($settings['subject']);
                        
                    });
                
            }
            //Log::debug(Mail::failures());
            //Log::debug('done emailing');
            //echo '<pre>';print_r($sent);exit;
                     
            if ($sent) {
                EmailLog::updateEmailLog(['id' => $logId], ['chrIsSent' => 'Y']);
            }
        }
    }

    /**
     * This method loads general settings
     * @return  Settings array
     * @since   2017-08-17
     * @author  NetQuick
     */
    public static function getSettings() {
        $settings = [];
        $generalSettings = GeneralSettings::getSettings();
        if (!empty($generalSettings)) {
            foreach ($generalSettings as $key => $value) {
                $settings[$value['fieldName']] = $value['fieldValue'];
            }
        }
        return $settings;
    }

    /**
     * This method stores email log data in database
     * @return  Flag
     * @since   2017-08-17
     * @author  NetQuick
     */
    public static function recodLog($mailData = null) {
        if ($mailData != null) {
            $logData = [];
            $logData['intFkUserId'] = isset($mailData['userId']) ? $mailData['userId'] : 1;
            $logData['intFkEmailType'] = $mailData['emailType'];
            $logData['chrReceiverType'] = isset($mailData['chrReceiverType']) ? $mailData['chrReceiverType'] : '-';
            $logData['intFkModuleId'] = isset($mailData['intFkModuleId']) ? $mailData['intFkModuleId'] : 1;
            $logData['intFkRecordId'] = isset($mailData['chrReceiverType']) ? $mailData['chrReceiverType'] : 0;
            $logData['varFrom'] = $mailData['from'];
            $logData['txtTo'] = $mailData['to'];
            $logData['txtCc'] = isset($mailData['cc']) ? $mailData['cc'] : '-';
            $logData['txtBcc'] = isset($mailData['bcc']) ? $mailData['bcc'] : '-';
            $logData['txtSubject'] = $mailData['subject'];
            $logData['body'] = $mailData['txtBody'];
            $logData['chrAttachment'] = isset($mailData['attachment']) ? $mailData['attachment'] : '-';
            $logData['chrIsSent'] = 'N';
            $logData['chrPublish'] = 'Y';
            $logData['chrDelete'] = 'N';
            $logData['chrIpAddress'] = MyLibrary::get_client_ip();
            $logData['varBrowserInfo'] = Request::header('User-Agent');
            $logData['created_at'] = date('Y-m-d H:i:s');
            $recordId = EmailLog::logEmail($logData);
            return $recordId;
        }
    }

     public static function orderemail($data = null) {
        if ($data != null) {
            $settings = Self::getSettings();
            $settings["name"] = $data["name"];
            $settings["orderid"] = $data["orderid"];
            $settings["email"] = $data['email'];
            $settings["orderitems"] = $data['orderitems'];
            $settings["subtotal"] = $data['subtotal'];
            $settings["tax"] = $data['tax'];
            $settings["total"] = $data['total'];
            $settings["currency_code"] = $data['currency_code'];
            $settings["invoiceid"] = $data['invoiceid'];
            
            #User Email================================
            $settings["subject"] = "Your new order #".$data['orderid']." created";
            $settings['emailType'] = EmailType::getRecords()->checkEmailType('Order')->first()->id;
            $settings['from'] = $settings['DEFAULT_EMAIL'];
            $settings['to'] = $data['email'];
            $settings['sender'] = $settings['SMTP_SENDER_NAME'];
            $settings['receiver'] = $settings['SMTP_SENDER_NAME'];
            $settings['txtBody'] = view('emails.order', $settings)->render();
            $logId = Self::recodLog($settings);
            unset($settings['txtBody']);
            //$settings['attachmentUrl'] = Config::get('Constant.API_URL')."/dlpdf.php?type=i&id=".$data['invoiceid'];
            Self::sendEmail('emails.order', $settings, $logId);
        }
    }

}
