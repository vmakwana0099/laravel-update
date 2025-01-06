<?php

namespace App\Http\Controllers;

use App\Cron;
use App\Helpers\MyLibrary;
use App\Http\Traits\slug;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Response;

class MarketingCronController extends FrontController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "SDfsdf"; exit;  
        $this->UserMail();
    }

    public function UserMail() {
        $Allresponse = DB::table('front_users as FU')
                ->join('front_session as FS', 'FU.id', '=', 'FS.user_id')
                ->select(['FS.*', 'FU.ReminderEmail', 'FU.email', 'FU.name'])
                ->where(['FU.ReminderEmail' => 'N'])
                ->get();
        if (!empty($Allresponse)) {
            $table = '';
            foreach ($Allresponse as $UserData) {
                 $table .= '<html>
                            <head>
                            <title>Thank You For Your Order</title>
                            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                            </head>
                            <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

                            <table id="Table_01" width="600" align="center"  border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                            <td style="background: #115BA9;text-align: center;padding: 20px 0;">
                                                    <a href="javascript:void(0)"><img src="images/logo.png" alt="HostITSmart"></a>
                                    </td>
                                    </tr>
                                    <tr>
                                            <td style="padding: 35px 0;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="text-align: center">
                                                    <strong style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 24px;color: #115BA9;letter-spacing: 1px;">Dear '.$UserData->name.',</strong>
                                                    <span style="display: block;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 24px;color: #115BA9;letter-spacing: 1px;">REMINDER</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    </tr><tr>
                                            <td style="background-color: #F1F5F7;">
                                        <table style="width:100%;" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <th style="text-align: left;padding: 13px 10px 13px 30px;font-size:  16px;color: #000000;font-family:  \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-weight:  500;border-bottom: 1px solid #B6B9BA;">Product</th>
                                                <th style="text-align: center;padding: 13px 10px 13px 10px;font-size:  16px;color: #000000;font-family:  \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-weight: 500;border-bottom: 1px solid #B6B9BA;">Term</th>
                                                <th style="text-align: right;padding: 13px 30px 13px 10px;font-size:  16px;color: #000000;font-family:  \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-weight: 500;border-bottom: 1px solid #B6B9BA;">Price</th>
                                            </tr>';
                                        $ItamArray = unserialize(base64_decode($UserData->payload));
                                        foreach ($ItamArray as $Products) {
                        //                                echo $Products['groupname'];
                                                        echo "<pre>";
                                                        print_r($Products);
                                            $table .= '<tr>
                                                        <td style="padding: 15px 10px 15px 30px;border-bottom: 1px solid #B6B9BA;">
                                                            <a href="#" title="JalsaEvent.com" style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';color: #034183;font-size: 16px;font-weight: 500;text-decoration: none;">' . $Products['groupname'] . '</a>
                                                            <span style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';display: block;font-size: 16px;font-weight: 500;color: #000000;padding: 12px 0 15px"></span>
                                                        </td>
                                                        <td style="padding: 15px 10px 15px 10px;text-align: center;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #000000;border-left: 1px solid #B6B9BA;vertical-align: top;border-bottom: 1px solid #B6B9BA;">'.$Products['billingcycle'].'</td>
                                                        <td style="padding: 15px 30px 15px 10px;text-align: right;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;font-weight: 700;color: #000000;border-left: 1px solid #B6B9BA;vertical-align: top;border-bottom: 1px solid #B6B9BA;"><i style="font-family: sans-serif;font-style: normal;font-size: 15px;">&#8377;</i>349</td>
                                                    </tr>';
                                        }
                    $table .= '</table>
                                       </td>
                                       </tr><tr>
                                       <td style="background-color: #F1F5F7;">
                                           <table style="width:280px;float: right" cellpadding="0" cellspacing="0">
                                               <tr>
                                                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;font-weight: 600;color: #000000;text-align: right;width:80px;border-bottom: 1px solid #B6B9BA;">Subtotal:</td>
                                                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;font-weight: 700;color: #000000;text-align: right;border-bottom: 1px solid #B6B9BA;padding: 15px 30px 15px 0;"><i style="font-family: sans-serif;font-style: normal;font-size: 15px;">&#8377;</i>3937</td>
                                               </tr>
                                               <tr>
                                                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;font-weight: 600;color: #000000;text-align: right;width:80px;border-bottom: 1px solid #B6B9BA;">Tax:</td>
                                                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;font-weight: 700;color: #000000;text-align: right;border-bottom: 1px solid #B6B9BA;padding: 15px 30px 15px 0"><i style="font-family: sans-serif;font-style: normal;font-size: 15px;">&#8377;</i>1144</td>
                                               </tr>
                                               <tr>
                                                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 20px;font-weight: 600;color: #000000;text-align: right;width:80px;background-color: #EEECEC;">TOTAL:</td>
                                                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 20px;font-weight: 700;color: #18B35C;text-align: right;padding: 15px 30px 15px 0;background-color: #EEECEC;"><i style="font-family: sans-serif;font-style: normal;font-size: 19px;margin-right: 2px;">&#8377;</i>5086</td>
                                               </tr>
                                           </table>
                                       </td>
                                   </tr>

                                   <tr>
                                       <td style="background-color: #115BA9;padding: 25px 0 25px 30px">
                                           <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                               <tr>
                                                   <td>
                                                       <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                                           <tr>
                                                               <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 20px;font-weight: 700;color: #ffffff;">Thanks,</td>
                                                           </tr>
                                                           <tr>
                                                               <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #ffffff;">Support Team</td>
                                                           </tr>
                                                           <tr>
                                                               <td><a href="mailto:support@hostitsmart.com" title="support@hostitsmart.com" style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #ffffff;text-decoration: none">support@hostitsmart.com</td>
                                                           </tr>
                                                       </table>
                                                   </td>
                                                   <td>
                                                       <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                                           <tr>
                                                               <td style="width: 36px;"><a href="#" title=""><img src="images/twitter.png" alt="Twitter"/></a></td>
                                                               <td style="width: 36px;"><a href="#" title=""><img src="images/facebook.png" alt="Facebook"/></a></td>
                                                               <td style="width: 36px;"><a href="#" title=""><img src="images/pinterest.png" alt="Pinterest"/></a></td>
                                                               <td style="width: 36px;"><a href="#" title=""><img src="images/google+.png" alt="google"/></a></td>
                                                               <td style="width: 36px;"><a href="#" title=""><img src="images/linkedin.png" alt="linkedin"/></a></td>
                                                           </tr>
                                                       </table>
                                                   </td>
                                               </tr>
                                           </table>
                                       </td>
                                   </tr>
                               </table>
                               <!-- End Save for Web Slices -->
                               </body>
                               </html>';
            }
           
        }
        echo $table;
    }

}
