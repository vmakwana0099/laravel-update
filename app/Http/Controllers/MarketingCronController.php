<?php

namespace App\Http\Controllers;

use Config;
use App\Cron;
use App\Helpers\MyLibrary;
use App\Http\Traits\slug;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Response;
use App\Cart;

class MarketingCronController extends FrontController {

    public function __construct() {
        parent::__construct();
        $apiUrl = config('app.api_url'); 
		Config::set('apiurl', $apiUrl. "/checkdomain.php?");
    }

    public function index() {
//        $this->UserMail();
        $this->NewUser();
    }

    public function UserMail() {
        $Allresponse = DB::table('front_users as FU')
                ->join('front_session as FS', 'FU.id', '=', 'FS.user_id')
                ->select(['FS.*', 'FU.ReminderEmail', 'FU.email', 'FU.name','FU.currency'])
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
                                                    <a href="javascript:void(0)"><img src="' . url('') . '/assets/images/marketing-images/logo.png" alt="HostITSmart"></a>
                                    </td>
                                    </tr>
                                    <tr>
                                            <td style="padding: 35px 0;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="text-align: center">
                                                    <strong style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 24px;color: #115BA9;letter-spacing: 1px;">Dear ' . $UserData->name . ',</strong>
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
                $TotalDomain = 0;
                $TotalHosting = 0;
                foreach ($ItamArray as $Products) {
                    if ($Products['producttype'] != 'domain') {
                        foreach ($Products['pricing'] as $MainPrice) {
                            if ($Products['billingcycle'] == $MainPrice->durationame) {
                                $PlanPrice = $MainPrice->price;
                            }
                        }
                        if (isset($Products['domain'])) {
                            $AddDomain = $Products['domain'];
                        }
                        $TotalHosting += (float) $PlanPrice;
                        $table .= '<tr>
                                    <td style="padding: 15px 10px 15px 30px;border-bottom: 1px solid #B6B9BA;">
                                        <span style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';color: #034183;font-size: 16px;font-weight: 500;text-decoration: none;">' . $Products['groupname'] . ' - ' . $Products['planname'] . '</span>
                                        <span style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';display: block;font-size: 16px;font-weight: 500;color: #000000;padding: 12px 0 15px">' . $AddDomain . '</span>
                                    </td>
                                    <td style="padding: 15px 10px 15px 10px;text-align: center;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #000000;border-left: 1px solid #B6B9BA;vertical-align: top;border-bottom: 1px solid #B6B9BA;">' . ucfirst($Products['billingcycle']) . '</td>
                                    <td style="padding: 15px 30px 15px 10px;text-align: right;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;font-weight: 700;color: #000000;border-left: 1px solid #B6B9BA;vertical-align: top;border-bottom: 1px solid #B6B9BA;"><i style="font-family: sans-serif;font-style: normal;font-size: 15px;">&#8377;</i>' . $PlanPrice . '</td>
                                </tr>';
                    } else if ($Products['producttype'] == 'domain') {
                        $table .= '<tr>
                                    <td style="padding: 15px 10px 15px 30px;border-bottom: 1px solid #B6B9BA;">
                                        <span style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';color: #034183;font-size: 16px;font-weight: 500;text-decoration: none;">' . ucfirst($Products['domain']) . '</span>
                                        <span style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';display: block;font-size: 16px;font-weight: 500;color: #000000;padding: 12px 0 15px">Domain ' . $Products['domaintype'] . '</span>';
                        if (!empty($Products['addonproducts'])) {
                            $table .= '<ul>';
                            foreach ($Products['addonproducts'] as $adnKey => $addon) {
                                if (!isset($Products['addonproducts'][$adnKey]['pid']) && isset($Products['addonproducts'][$adnKey]['added'])) {

                                    $table .= '<li>' . $Products['addonproducts'][$adnKey]['desc'] . '</li>';
                                }
                            }
                            $table .= '</ul>';
                        }
                        if (isset($Products['pricing']['0']->register)) {
                            $DomainPrice = $Products['pricing']['0']->register;
                        }
                        $TotalDomain += (float) $DomainPrice;
                        $table .= '</td>
                                    <td style="padding: 15px 10px 15px 10px;text-align: center;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #000000;border-left: 1px solid #B6B9BA;vertical-align: top;border-bottom: 1px solid #B6B9BA;">' . ucfirst($Products['regperiod']) . ' year</td>
                                    <td style="padding: 15px 30px 15px 10px;text-align: right;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;font-weight: 700;color: #000000;border-left: 1px solid #B6B9BA;vertical-align: top;border-bottom: 1px solid #B6B9BA;"><i style="font-family: sans-serif;font-style: normal;font-size: 15px;">&#8377;</i>' . $DomainPrice . '</td>
                                </tr>';
                    }
                }
                $table .= '</table>
                                       </td>
                                       </tr><tr>
                                       <td style="background-color: #F1F5F7;">
                                           <table style="width:280px;float: right" cellpadding="0" cellspacing="0">
                                               <tr>
                                                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 20px;font-weight: 600;color: #000000;text-align: right;width:80px;background-color: #EEECEC;">TOTAL:</td>
                                                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 20px;font-weight: 700;color: #18B35C;text-align: right;padding: 15px 30px 15px 0;background-color: #EEECEC;"><i style="font-family: sans-serif;font-style: normal;font-size: 19px;margin-right: 2px;">&#8377;</i>' . ($TotalDomain + $TotalHosting) . '</td>
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
                                                               <td style="width: 36px;"><a href="https://twitter.com/HostITSmart" title=""><img src="' . url('') . '/assets/images/marketing-images/twitter.png" alt="Twitter"/></a></td>
                                                               <td style="width: 36px;"><a href="https://www.facebook.com/hostitsmart" title=""><img src="' . url('') . '/assets/images/marketing-images/facebook.png" alt="Facebook"/></a></td>
                                                               <td style="width: 36px;"><a href="https://www.pinterest.com/hostitsmart/" title=""><img src="' . url('') . '/assets/images/marketing-images/pinterest.png" alt="Pinterest"/></a></td>
                                                               <td style="width: 36px;"><a href="https://plus.google.com/+Hostitsmartindia" title=""><img src="' . url('') . '/assets/images/marketing-images/google+.png" alt="google"/></a></td>
                                                               <td style="width: 36px;"><a href="https://www.linkedin.com/company/host-it-smart/" title=""><img src="' . url('') . '/assets/images/marketing-images/linkedin.png" alt="linkedin"/></a></td>
                                                           </tr>
                                                       </table>
                                                   </td>
                                               </tr>
                                           </table>
                                       </td>
                                   </tr>
                               </table>
                               </body>
                               </html>';
            }
        }
        echo $table;
    }

    public function NewUser() {
        $NewUser = DB::table('front_users')
                ->select(['id', 'name', 'PendingEmail', 'email', 'currency'])
                ->where(['PendingEmail' => 'N'])
                ->get();
				
        foreach ($NewUser as $User) {
            $UserTable = '';
            $DomainParam = [];
            $DomainName = $this->remove_all_special_char($User->name);
            $suggestedTlds = array("com", "in", "net", "org", "ca", "co.in", "org.in", "co", "co.uk", "buzz");

            foreach ($suggestedTlds as $tld) {
                $DomainParam[] = array('domainname' => $DomainName, 'tld' => $tld);
            }
            $domainAvailDataJSON = Cart::checkDomainAvailability($DomainParam);
            $domainAvailData = json_decode($domainAvailDataJSON,true);
            $UserTable .='<html>
            <head>
            <title>Thank You For Your Order</title>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            </head>
            <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

            <table id="Table_01" width="600" align="center"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                            <td style="background: #115BA9;text-align: center;padding: 20px 0;">
                                    <a href="javascript:void(0)"><img src="' . url('') . '/assets/images/marketing-images/logo.png" alt="HostITSmart"></a>
                    </td>
                    </tr>';
            $array = array(
                "152" => "PRODUCT_LINUX_HOSTING_PRICE#@#Linux hosting#@#hosting/linux-hosting#@#MEGAMENU_LINUX_HOSTING_OFFER_PRICE#@#server-img.png",
                "153" => "PRODUCT_WINDOWS_HOSTING_PRICE#@#Windows hosting#@#windows-hosting#@#MEGAMENU_WINDOWS_HOSTING_OFFER_PRICE#@#window-hosting.png",
                "176" => "PRODUCT_WORDPRESS_HOSTING_PRICE#@#Wordpress hosting#@#hosting/wordpress-hosting#@#MEGAMENU_WORDPRESS_OFFER_PRICE#@#wordpress-hosting.png",
                "191" => "PRODUCT_VPS_HOSTING_PRICE#@#VPS hosting#@#servers/vps-hosting#@#MEGAMENU_VPS_HOSTING_OFFER_PRICE#@#vps-hosting.png",
                "194" => "PRODUCT_DEDICATED_SERVERS_PRICE#@#Dedicated Server#@#servers/dedicated-servers#@#MEGAMENU_DEDICATED_SERVERS_OFFER_PRICE#@#dedicated.png");
            $Id = array_rand($array);
            $FullName = $array[$Id];
            $Data = explode("#@#",$FullName);
            $ProductConstant = $Data[0];
            $ProductName = $Data[1];
            $ProductURL = $Data[2];
            $ProductOfferConstant = $Data[3];
            $ProductImage = $Data[4];

        $HostingDealsId = Config::get('Constant.'.$ProductOfferConstant.'_DEALS');
                 $HostingSelectFiled = DB::table('deals')
                    ->select(['varDiscountType','discount_percentage','discount_fixed'])
                    ->where(['id' => $HostingDealsId])
                    ->first();

        $UserTable .='
                <tr>
                        <td style="padding: 35px 0;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="text-align: center">
                                <strong style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 24px;color: #115BA9;letter-spacing: 1px;">Dear ' . $User->name . ',</strong>
                                <span style="display: block;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 20px;color: #115BA9;letter-spacing: 1px;">We have some great Domain suggestions for you</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size:16px;color: #000000;text-align: center;padding-top: 20px;letter-spacing:0.75px;">
                                I have picked some great domains for you and recommend you to book these. These domains are highly brandable.
                            </td>
                        </tr>
                    </table>
                </td>
                </tr>
                <tr>
                <td style="background-color: #F1F5F7;padding: 35px 0;">
            <span style="width: 480px;display: block;color: #000000;font-size: 16px;font-weight: 700;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';color: #000000;text-align: center;margin: 0 auto 20px;letter-spacing: 0.75px;">Act fast and save ';

             if($HostingSelectFiled->varDiscountType == 'Fixed'){ 
                     if($User->currency == "INR") {
                        $UserTable .='
                            <span style="font-size: 18px;color: #18B35C;"><i style="font-family: sans-serif;font-style: normal;font-size: 20px;font-weight: 500;">&#8377;</i>'.$HostingSelectFiled->discount_fixed.'</span> on '.$ProductName.', including these we found just for you';
                     } else {
                          $UserTable .='<span style="font-size: 18px;color: #18B35C;"><i style="font-family: sans-serif;font-style: normal;font-size: 20px;font-weight: 500;">&#36;</i>'.$HostingSelectFiled->discount_fixed.'</span> on '.$ProductName.', including these we found just for you';
                     }
                } else if($HostingSelectFiled->varDiscountType == 'Percentage'){
                    $UserTable .='<span style="font-size: 18px;color: #18B35C;">'.$HostingSelectFiled->discount_percentage.'%*</span> on '.$ProductName.', including these we found just for you';
                }                                       
            $UserTable .='</span>
            <span style="width: 78px;height: 1px;background: #334045;display: block;margin:0 auto;"></span>
            </td>
            </tr>
            <tr><td style="background-color:#115BA9;padding: 40px 0;">
                       <table style="width:100%;" cellpadding="0" cellspacing="0">
               <tr>
                  <td style="text-align: center;padding-bottom: 10px;"><img src="' . url('') . '/assets/images/marketing-images/'.$ProductImage.'" alt="Offer Of The Month"/></td>
               </tr>
               <tr>
                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 20px;font-weight: 600;text-transform: uppercase;color: #ffffff; text-align: center;letter-spacing: 1px">Offer of the Month</td>
               </tr>
               <tr>
                   <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #ffffff;text-align: center;letter-spacing: 1px;">Starts at  
                   ';
                   if($User->currency == "INR") {
                       $UserTable .='<i style="font-family: sans-serif;font-style: normal;font-size: 20px;font-weight: 500;">&#8377;</i><span style="font-weight: 700;font-size: 40px;">'. Config::get('Constant.'.$ProductConstant.'_INR') .'</span>/mo*';
                   } else { 
                       $UserTable .='<i style="font-family: sans-serif;font-style: normal;font-size: 20px;font-weight: 500;">&#36;</i><span style="font-weight: 700;font-size: 40px;">'. Config::get('Constant.'.$ProductConstant.'_USD') .'</span>/mo*';
                   } 
                   $UserTable .='<span style="width: 78px;height: 1px;background: #ffffff;display: block;margin:20px auto 20px;"></span>
                   </td>
               </tr>
                <tr>
                <td>
                    <table style="width: 90%;margin: 0 auto;" cellpadding="0" cellspacing="0"><tr>
                            <td>
                    <table style="width: 50%;float: left;" cellpadding="0" cellspacing="0">';
                         $productData = Cart::getRecommandedProductFeatures($Id);
                         $proFeatures = explode("\n", $productData->txtRecommandedFeatures);
                          $FeaturesOne = $FeaturesTwo = array();
                           $F = 0;
                              foreach ($proFeatures as $FeaturesId => $Features){
                                    if($F % 2 == 0){ 
                                        $FeaturesOne[] = $Features; 
                                        } else { 
                                        $FeaturesTwo[] = $Features; 
                                    } 
                                    $F++;
                              }
                               $CounterFeaturesOne = (count($FeaturesOne));
                                    for($ii=0; $ii<$CounterFeaturesOne; $ii++){
                                             $FeaturesRight = $FeaturesOne[$ii];
                                             if(strlen($FeaturesOne[$ii]) > 23){
                                                 $FeaturesRight = substr($FeaturesOne[$ii],0,23).'...';
                                               }
                                                if(isset($FeaturesOne[$ii]) && !empty($FeaturesOne[$ii])){  
                                                $UserTable .='<tr>
                                                                   <td style="padding: 10px 0;">
                                                                       <img src="' . url('') . '/assets/images/marketing-images/checkmark.png"/>
                                                                       <span style="font-size: 16px;color: #ffffff;letter-spacing: 1px;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';display: inline-block;vertical-align: top;padding-left: 5px;">'.$FeaturesRight.'</span>
                                                                   </td>
                                                               </tr>';

                                                }
                                    }
                                     $UserTable .='</table>
                                            <table style="width: 50%;float: right;" cellpadding="0" cellspacing="0">';
                                    $CounterFeaturesTwo = (count($FeaturesTwo));
                                    for($jj=0; $jj<$CounterFeaturesTwo; $jj++){
                                             $FeaturesLeft = $FeaturesTwo[$jj];
                                             if(strlen($FeaturesTwo[$jj]) > 23){
                                                 $FeaturesLeft = substr($FeaturesTwo[$jj],0,23).'...';
                                               }
                                                if(isset($FeaturesTwo[$jj]) && !empty($FeaturesTwo[$jj])){  
                                                $UserTable .='<tr>
                                                                   <td style="padding: 10px 0;">
                                                                       <img src="' . url('') . '/assets/images/marketing-images/checkmark.png"/>
                                                                       <span style="font-size: 16px;color: #ffffff;letter-spacing: 1px;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';display: inline-block;vertical-align: top;padding-left: 5px;">'.$FeaturesLeft.'</span>
                                                                   </td>
                                                               </tr>';

                                                }
                                            }
                                $UserTable .='</table>
                                </td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 35px 0 0;">
                            <a href="'.url('').'/'. $ProductURL .'" title="Get Started Now" style="padding: 11px 25px;background: #ffffff;color: #000000;border-radius: 5px;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';text-decoration: none;font-weight: 500;box-shadow: 2px 3px 3px rgba(0,0,0,0.3);">Get Started Now</a>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
            <tr>';
            $DealsId = Config::get('Constant.MEGAMENU_REGISTER_OFFER_PRICE_DEALS');
             $SelectFiled = DB::table('deals')
                ->select(['varDiscountType','discount_percentage','discount_fixed','varpromo_code'])
                ->where(['id' => $DealsId])
                ->first();
            if($SelectFiled->varDiscountType == 'Fixed'){ 
                 if($User->currency == "INR") {
                    $UserTable .='<td style="background-color: #F1F5F7;padding: 35px 0;">
                        <span style="width: 480px;display: block;color: #000000;font-size: 16px;font-weight: 700;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';color: #000000;text-align: center;margin: 0 auto 20px;letter-spacing: 0.75px;">Act fast and save
                        <span style="font-size: 18px;color: #18B35C;"><i style="font-family: sans-serif;font-style: normal;font-size: 20px;font-weight: 500;">&#8377;</i>'.$SelectFiled->discount_fixed.'</span> on new Domains, including these we found just for you</span>
                        <span style="width: 78px;height: 1px;background: #334045;display: block;margin:0 auto;"></span>
                    </td>';
                 } else {
                    $UserTable .='<td style="background-color: #F1F5F7;padding: 35px 0;">
                        <span style="width: 480px;display: block;color: #000000;font-size: 16px;font-weight: 700;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';color: #000000;text-align: center;margin: 0 auto 20px;letter-spacing: 0.75px;">Act fast and save
                        <span style="font-size: 18px;color: #18B35C;"><i style="font-family: sans-serif;font-style: normal;font-size: 20px;font-weight: 500;">&#36;</i>'.$SelectFiled->discount_fixed.'</span> on new Domains, including these we found just for you</span>
                        <span style="width: 78px;height: 1px;background: #334045;display: block;margin:0 auto;"></span>
                    </td>'; 
                 }
            } else if($SelectFiled->varDiscountType == 'Percentage'){
            $UserTable .='
             <td style="background-color: #F1F5F7;padding: 35px 0;">
                <span style="width: 480px;display: block;color: #000000;font-size: 16px;font-weight: 700;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';color: #000000;text-align: center;margin: 0 auto 20px;letter-spacing: 0.75px;">Act fast and save
                <span style="font-size: 18px;color: #18B35C;">'.$SelectFiled->discount_percentage.'%*</span> on new Domains, including these we found just for you</span>
                <span style="width: 78px;height: 1px;background: #334045;display: block;margin:0 auto;"></span>
            </td>';
            }
             $UserTable .='</tr>
            <tr>
                <td style="background-color: #F1F5F7;padding-bottom: 25px;">';
             $stldArrl = $stldArrr = array();
              $i1 = 0;
                    foreach ($domainAvailData as $domainname => $domaindata){
                        if($domaindata['status'] == 'available'){
                                    if($i1 % 2 == 0){ 
                                        $stldArrl[] = $domainname; 
                                        } else { 
                                        $stldArrr[] = $domainname; 
                                    } 
                                    $i1++;
                        }
                    }
                   $counterright = (count($stldArrr));
                   for($j=0; $j<$counterright; $j++){
                            
                            $DomainRight = $stldArrr[$j];
                            if(strlen($stldArrr[$j]) > 25){
                                $DomainRight = substr($stldArrr[$j],0,25).'..';
                              }
                                    if(isset($stldArrr[$j]) && !empty($stldArrr[$j])){  
                                    $UserTable .='<table style="width: 50%;float: right;"><tr>
                                          <td style="text-align: center;padding-left: 10px;padding-bottom: 8px;">
                                              <span style="display: inline-block;margin: 0 auto;background: #ffffff;border: 1px solid #115BA9;width: 258px;">
                                                  <span style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #000000;text-align: center;display: inline-block;width: 214px;padding: 10px 0;">'.$DomainRight.'</span>
                                                  <a style="float: right;" href="' . url('') . '/domain?d='.$stldArrr[$j].'" title="'.$stldArrr[$j].'"><img src="' . url('') . '/assets/images/marketing-images/cart.jpg" alt="cart"/></a>
                                              </span>
                                          </td>
                                      </tr></table>';
                                        
                                    }
                   }
                   $counterleaft = (count($stldArrl));
                        for($i=0; $i<$counterleaft; $i++){
                            $DomainLeft = $stldArrl[$i];
                            if(strlen($stldArrl[$i]) > 25){
                               $DomainLeft = substr($stldArrl[$i],0,25).'..';
                            }
                            if(isset($stldArrl[$i]) && !empty($stldArrl[$i])){
                              $UserTable .='<table style="width: 50%;float: left;"><tr>
                                    <td style="text-align: center;padding-left: 10px;padding-bottom: 8px;">
                                        <span style="display: inline-block;margin: 0 auto;background: #ffffff;border: 1px solid #115BA9;width: 258px;">
                                            <span style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #000000;text-align: center;display: inline-block;width: 214px;padding: 10px 0;">'.$DomainLeft.'</span>
                                            <a style="float: right;" href="' . url('') . '/domain?d='.$stldArrl[$i].'" title="'.$stldArrl[$i].'"><img src="' . url('') . '/assets/images/marketing-images/cart.jpg" alt="cart"/></a>
                                        </span>
                                    </td>
                                </tr></table>';
                              }
                   }
                     $UserTable .=' 
                                </td>
                                </tr>
                                <tr>
                                        <td style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 20px;color: #000000;font-weight: 600;text-transform: uppercase;background-color: #F1F5F7;text-align: center;">Use promo code</td>
                                </tr>
                                <tr>
                                        <td style="padding: 15px 0 30px;background-color: #F1F5F7;">
                                    <span style="border: 1px dashed #115BA9;display: table;margin: 0 auto;border-radius: 25px;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';">
                                        <span style="font-size: 16px;padding: 12px 18px;display: inline-block;font-weight: 600;color: #115BA9;">'.$SelectFiled->varpromo_code.'</span>
                                        <span style="font-size: 16px;padding: 12px 18px;border-left: 1px dashed #115BA9;display: inline-block;">Your Recommended Domain is a click away. <a href="' . url('/') . '" title="Book Now" style="color: #115BA9;font-weight: 600;text-decoration: none;">Book Now</a></span>
                                    </span>
                                </td>
                                </tr>
                                <tr>
                                        <td style="padding: 15px 0 40px;background-color: #F1F5F7;">
                                        <span style="display: table;margin: 0 auto;">
                                        <span style="font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;color: #000000;display: inline-block;width: 370px;float: left;border: 1px solid #115BA9;padding: 9px 15px;background: #ffffff;">Not seeing one you like?</span>
                                        <a href="' . url('/') . '" title="Search Now" style="float: left;background-color:#115BA9;color: #ffffff;padding: 8px 15px;font-family: \'Segoe UI\', \'Apple SD Gothic Neo\', \'Lucida Grande\', \'Lucida Sans Unicode\', \'sans-serif\';font-size: 16px;font-weight: 600;text-decoration: none;">Search Now<img src="' . url('') . '/assets/images/marketing-images/searchicon.png" alt="Search Now" style="vertical-align: middle;margin-left: 10px;"/></a>
                                    </span>
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
                                                        <td style="width: 36px;"><a href="https://twitter.com/HostITSmart" title=""><img src="' . url('') . '/assets/images/marketing-images/twitter.png" alt="Twitter"/></a></td>
                                                        <td style="width: 36px;"><a href="https://www.facebook.com/hostitsmart" title=""><img src="' . url('') . '/assets/images/marketing-images/facebook.png" alt="Facebook"/></a></td>
                                                        <td style="width: 36px;"><a href="https://www.pinterest.com/hostitsmart/" title=""><img src="' . url('') . '/assets/images/marketing-images/pinterest.png" alt="Pinterest"/></a></td>
                                                        <td style="width: 36px;"><a href="https://plus.google.com/+Hostitsmartindia" title=""><img src="' . url('') . '/assets/images/marketing-images/google+.png" alt="google"/></a></td>
                                                        <td style="width: 36px;"><a href="https://www.linkedin.com/company/host-it-smart/" title=""><img src="' . url('') . '/assets/images/marketing-images/linkedin.png" alt="linkedin"/></a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        </body>
                        </html>';
                    echo $UserTable;
                    exit;
        }
    }
    function remove_all_special_char($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9.\-]/', '', $string); // Removes special chars.
    }

}
