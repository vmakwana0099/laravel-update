<?php

/**
 * The FrontController class handels Preloaded data for front side
 * configuration  process (ORM code Updates).
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.1
 * @since     2017-08-09
 * @author    NetQuick
 */

namespace App\Http\Controllers;

use Config;
use App\Http\Controllers\Controller;
use App\Banner;
use App\CmsPage;
use App\Helpers\MenuBuilder;
use App\Helpers\time_zone;
use App\Http\Traits\slug;
use App\Menu;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;
use App\Helpers\MyLibrary;
use App\Helpers\Page_hits;
use Stevebauman\Location\Facades\Location;
use Cookie;
use App\user_session;
use App\ProductCategory;
use App\Front_user;
use Session;

class FrontController extends Controller {

    use slug;

    protected $breadcrumb = [];
    protected $agent;
    protected $sitemap_content;

    public function __construct() {
          
        $this->middleware(function ($request, $next) {
            
            //Session validation for user---------------------------
            if (!empty($request->session()->get('UserID'))) {
                $IP = Request::ip();
                $ipx = $ipf = $ipr = "";
                if(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])){
                   $IP = $_SERVER['HTTP_X_REAL_IP'];
                   $ipx = $_SERVER['HTTP_X_REAL_IP']; 
                }
                else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                   $IP = $_SERVER['HTTP_X_FORWARDED_FOR']; 
                   $ipf = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
                   $IP = $_SERVER['REMOTE_ADDR']; 
                   $ipr = $_SERVER['REMOTE_ADDR']; 
                }
                $sess_ip = $request->session()->has('user_ses_ip')?$request->session()->get('user_ses_ip'):"";
                
                if($IP != $sess_ip){ 
                file_put_contents("ipconflict.txt", "\n Date: ".date("Y-m-d H:i:s")." IP: ".$IP." ipx: ".$ipx." ipf: ".$ipf." ipr: ".$ipr." - SessIP: ".$sess_ip." - User: ".$request->session()->get('UserID'), FILE_APPEND); 
                redirect('/user-logout'); exit; 
                }
            }
            //Session validation for user---------------------------
            
            if (!empty($request->session()->get('UserID')) && !empty($request->session()->get('frontlogin'))) {
                $Session_UserID = Session::get('UserID');
                $User_Data = Front_user::where('id', '=', $Session_UserID)->first();
                Config::set('Constant.sys_currency', $User_Data->currency);
                Config::set('Constant.sys_currency_code', $User_Data->currency_code);
                //echo "1";
                if ($User_Data->currency_code == '1') {
                    Config::set('Constant.sys_currency_symbol', "&#8377;");
                } else {
                    Config::set('Constant.sys_currency_symbol', "&#36;");
                }
            } else {
               
                
                if (empty($_COOKIE["sys_currency"])) {
                    
                     time_zone::time_zone();
                       if ($_SERVER['HTTP_HOST'] == "localhost") {
                           $IP = "27.54.170.98";
                           //file_put_contents("locationapilog.txt",,mode,context)
                           //--------------------- Code need to comment ----------
                            $position['countryCode'] = 'IN';
                            $position = (object)$position; 
                          //--------------------- Code need to comment ----------
                          // file_put_contents("locationapilog.txt", "\n Date: ".date("Y-m-d H:i:s")." IP: ".$IP." - Location: ".$position->countryCode, FILE_APPEND);
                       } else {
                           $IP = Request::ip();
                           if(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])){
                               $IP = $_SERVER['HTTP_X_REAL_IP'];
                            }
                            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                               $IP = $_SERVER['HTTP_X_FORWARDED_FOR']; 
                            }
                            else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
                               $IP = $_SERVER['REMOTE_ADDR']; 
                            }
                           $position = Location::get($IP);
                           //echo $IP;
                           //echo '<pre>';print_r($position); echo '</pre>'; 
                           if(isset($position->countryCode) && !empty($position->countryCode))
                           { file_put_contents("locationapilog.txt", "\n API called Date: ".date("Y-m-d H:i:s")." IP: ".$IP." - ".$position->countryCode, FILE_APPEND); }
                           else { file_put_contents("locationapilog.txt", "\n API called Date Country not found!: ".date("Y-m-d H:i:s")." IP: ".$IP." - ".$position->countryCode, FILE_APPEND); }
                       }
                       if(isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT'])){
                        //If google bot then set country to India.
                        if(strpos($_SERVER['HTTP_USER_AGENT'],"Googlebot") !== false){ $position->countryCode = "IN"; } 
                     }
                    $clientCountry = ''; 
                    if(isset($position->countryCode) && !empty($position->countryCode)) { 
                        setcookie("sys_country", $position->countryCode, time() + (86400 * 30), "/"); // 86400 = 1 day 
                        $clientCountry = $position->countryCode;
                    }
                    
                    if ($position->countryCode == "IN") {
                        setcookie("sys_currency", "INR", time() + (86400 * 30), "/"); // 86400 = 1 day
                        setcookie("sys_currency_code", "1", time() + (86400 * 30), "/"); // 86400 = 1 day
                        setcookie("sys_currency_symbol", "&#8377;", time() + (86400 * 30), "/"); // 86400 = 1 day
                    } else {
                        //echo "123"; 
                        if(isset($_REQUEST['location']) && !empty($_REQUEST['location'])){
                            setcookie("sys_countryloc", "IN", time() + (86400 * 30), "/"); // 86400 = 1 day
                            echo '<script type="text/javascript">window.location="' . url('/') . '";</script>';exit;
                        }
                        
                        if(isset($_COOKIE["sys_countryloc"]) && !empty($_COOKIE["sys_countryloc"])){
                            if($_COOKIE["sys_countryloc"] == 'IN'){
                                setcookie("sys_currency", "USD", time() + (86400 * 30), "/"); // 86400 = 1 day
                                setcookie("sys_currency_code", "10", time() + (86400 * 30), "/"); // 86400 = 1 day
                                setcookie("sys_currency_symbol", "&#36;", time() + (86400 * 30), "/"); // 86400 = 1 day        
                            }
                            else{ 
                                if (!empty($position->countryCode) && $position->countryCode != "IN") { 
                                    file_put_contents("locationapilog.txt", "\n Redirection 1 Date: ".date("Y-m-d H:i:s")." IP: ".$IP." - ".$position->countryCode, FILE_APPEND);
                                    echo '<script type="text/javascript">window.location="https://global.hostitsmart.com'.$_SERVER['REQUEST_URI'].'"</script>';exit;  
                                }
                            }
                        }
                        else { 
                            if (!empty($position->countryCode) && $position->countryCode != "IN")
                            { 
                                /*file_put_contents("locationapilog.txt", "\n Redirection 2 Date: ".date("Y-m-d H:i:s")." IP: ".$IP." - ".$position->countryCode, FILE_APPEND);
                                echo '<script type="text/javascript">window.location="https://global.hostitsmart.com'.$_SERVER['REQUEST_URI'].'"</script>';exit;  */
                            }
                        }
                        
                        setcookie("sys_currency", "INR", time() + (86400 * 30), "/"); // 86400 = 1 day
                        setcookie("sys_currency_code", "1", time() + (86400 * 30), "/"); // 86400 = 1 day
                        setcookie("sys_currency_symbol", "&#8377;", time() + (86400 * 30), "/"); // 86400 = 1 day
                    }
                    if (!empty($position->countryCode) && $position->countryCode == "IN") {
                        $Curr = "INR";
                        $Curr_code = '1';
                        $currency_symbol = "&#8377;";
                    } 
                    else if (!empty($position->countryCode) && $position->countryCode != "IN") {
                        $Curr = "USD";
                        $Curr_code = '10';
                        $currency_symbol = "&#36;";
                    }
                    else {
                        $Curr = "INR";
                        $Curr_code = '1';
                        $currency_symbol = "&#8377;";
                    }
                    
                    Config::set('Constant.sys_currency', $Curr);
                    Config::set('Constant.sys_currency_code', $Curr_code);
                    Config::set('Constant.sys_currency_symbol', $currency_symbol);
                    Config::set('Constant.sys_country', $clientCountry);
                    //echo "2";
                } else {

                    if (!empty($_COOKIE["sys_currency"])) {
                        Config::set('Constant.sys_currency', $_COOKIE["sys_currency"]);
                        Config::set('Constant.sys_currency_code', $_COOKIE["sys_currency_code"]);
                        Config::set('Constant.sys_currency_symbol', $_COOKIE["sys_currency_symbol"]);
                        if(isset($_COOKIE["sys_country"]) && !empty($_COOKIE["sys_country"]))
                        { Config::set('Constant.sys_country', $_COOKIE["sys_country"]); }
                        
                        //echo "3";
                    } else {
                        if ($position->countryCode == "IN") {
                            $Curr = "INR";
                            $Curr_code = '1';
                            $currency_symbol = "&#8377;";
                        } else {
                            $Curr = "USD";
                            $Curr_code = '10';
                            $currency_symbol = "&#36;";
                        }
                        Config::set('Constant.sys_currency', $Curr);
                        Config::set('Constant.sys_currency_code', $Curr_code);
                        Config::set('Constant.sys_currency_symbol', $currency_symbol);
                        if(isset($position->countryCode) && !empty($position->countryCode))
                        { Config::set('Constant.sys_country', $position->countryCode); }
                        //echo "4";
                    
                    }
                }
            }
            
            // Session::put([
            //         'sys_currency' => "INR",
            //         'sys_currency_code' => Config::get('Constant.sys_currency_code'),
            //         'sys_currency_symbol' => Config::get('Constant.sys_currency_symbol')
            //     ]);
            
            MyLibrary::addClientActivityLog($request); //Client Log
            return $next($request);

        });
        
         
        //echo phpinfo();
        $data = [];
        $this->agent = new Agent;
        $cmsPageId = slug::resolve_alias_for_routes(!empty(Request::segment(1)) ? Request::segment(1) : 'home');
        $header_menu = Menu::getTopMenuData();
        $FooterProducts = CmsPage::getFooterProducts();
        if (is_numeric($cmsPageId)) {
            $pageCms = CmsPage::getAllPageByPageId($cmsPageId);
        }
        if (isset($pageCms->alias->varAlias) && strtolower($pageCms->alias->varAlias) != 'home' && $pageCms->modules->id == "37") {
            $innerBanner = Banner::getInnerBannerList($pageCms->CmsPage->id, $pageCms->modules->id);
            $data['category_inner_banner_data'] = $innerBanner;
        }else{
            $tmpcmsPageRealData = CmsPage::getPageidfromaliasId($cmsPageId);
            $cmsPageRealData = (array)reset($tmpcmsPageRealData); $cmsPageRealData = reset($cmsPageRealData);
            // echo "<pre>";print_r($cmsPageRealData->id);exit;
            if (isset($cmsPageRealData->id) && !empty($cmsPageRealData->id)) {
                $data['bannerData'] = Banner::getHomeBannerList($cmsPageRealData->id);
            }
        }
        $data['sociallinks'] = CmsPage::sociallinks();
        $contactObj = CmsPage::getHomecontactdata();
        $data['header_menu'] = $header_menu;
        $data['ProductDataFooter'] = $FooterProducts;
        $data['contactData'] = $contactObj;
        $Featured_Tlds = CmsPage::getTLds();
        $data['FeaturedTlds'] = $Featured_Tlds;
        $TopdealsObj = CmsPage::getHometopdealsdata();
        $data['dealsData'] = $TopdealsObj;
        $MegaMenu = CmsPage::MegaMenuPrice();
        $data['countryDialingCode'] = Mylibrary::getCountryDialingCodeList(); 
        $data['countryCode']=Mylibrary::getCountrieslist();
        
        $MegaMenuPrice = array();
        foreach ($MegaMenu as $DealsData) {
            $MegaMenuPrice[$DealsData->fieldName] = $DealsData;
        }
        $data['uagent'] = $this->agent->isMobile()?"mobile":"pc";
        $data['udevice'] = $this->agent->device(); //Get device.
        $data['MegaMenu'] = $MegaMenuPrice;
        
        
        if (Request::is('/') || $cmsPageId == 53 || $cmsPageId == 'domain-checker') {
            $params = [];
            $params['currency'] = Config::get('Constant.sys_currency');
            $params['domain_type'] = "domainregister";
            $Tld_array = ProductCategory::GetTldData($params);
            if (!empty($Tld_array)) {
                foreach ($Tld_array as $value) {
                    $Tlds[] = $value->varTitle;
                }
                $data["Tlds"] = implode(",", $Tlds);
            }
        }
        if(request('themepreview')!=''){
            $_SESSION['themepreview'] = request('themepreview');
            $data['themepreview'] = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview'];
        } //VK 9/12/2019
        //echo "cur: ".Config::get('Constant.sys_currency');exit;
        view()->share($data);

        $this->shareData();
    }
    public function setInnerBanner($pageObj = false) {
        $innerBannerArr = [];
        $innerBannerArr['currentPageTitle'] = (isset($pageObj->varTitle) ? $pageObj->varTitle : Request::segment(1));
        $defaultBanner = Banner::getDefaultBannerList();
        $innerBanner = $defaultBanner;
        if (isset($pageObj->id)) {
            if (null !== Request::segment(1) && null == Request::segment(2)) {
                $innerBanner = Banner::getInnerBannerList($pageObj->id);
                if (count($innerBanner) < 1) {
                    $innerBanner = $defaultBanner;
                }
            }
            if (null !== Request::segment(2)) {
                $id = slug::resolve_alias_for_routes(Request::segment(2));
                $MODEL = '\\App\\' . Config::get('Constant.MODULE.MODEL_NAME');
                if (is_numeric($id)) {
                    $recordID = $MODEL::getRecordIdByAliasID($id);
                    $innerBanner = Banner::getInnerBannerList($recordID, Config::get('Constant.MODULE.ID'));
                    if (count($innerBanner) < 1) {
                        $innerBanner = $defaultBanner;
                    }
                }
            }
        } else {
            $innerBanner = $defaultBanner;
        }
        $innerBannerArr['inner_banner_data'] = $innerBanner;
        return $innerBannerArr;
    }

    public function shareData() {
        $shareData = [];
        $pageCms = null;
        $cmsPageId = slug::resolve_alias_for_routes(!empty(Request::segment(1)) ? Request::segment(1) : 'home');

        if (is_numeric($cmsPageId)) {
            $pageCms = CmsPage::getPageByPageId($cmsPageId);
        }
//        echo "<pre>";
//        print_r($pageCms);exit;
        if (!empty($pageCms->id)) {
            Page_hits::insertHits($pageCms);
        }
        if (!Request::ajax()) {
            if (isset($pageCms->varTitle) && strtolower($pageCms->varTitle) != 'home') {
                $shareData = $this->setInnerBanner($pageCms);
            } else {
                $shareData = $this->setInnerBanner();
            }
        }
//        if (!Request::ajax()) {
//            if (isset($pageCms->varTitle) && strtolower($pageCms->varTitle) != 'home') {
//                $shareData = $this->setInnerBanner($pageCms);
//            } else {
//                $shareData = $this->setInnerBanner();
//            }
//
//            if (class_exists('\\App\\Advertise')) {
//                $advertise = \App\Advertise::getFrontRecordsByPage($cmsPageId);
//                if (!empty($advertise)) {
//                    foreach ($advertise as $ad) {
//                        $sectionArr = unserialize($ad->txtPosition);
//                        if (in_array('top', $sectionArr)) {
//                            $shareData['topAd'][] = $ad;
//                        }
//                        if (in_array('section_100', $sectionArr)) {
//                            $shareData['section_100'][] = $ad;
//                        }
//                        if (in_array('section_100_grid', $sectionArr)) {
//                            $shareData['section_100_grid'][] = $ad;
//                        }
//                        if (in_array('section_107', $sectionArr)) {
//                            $shareData['section_107'][] = $ad;
//                        }
//                    }
//                }
//            }
//
//
//            if (class_exists('\\App\\Testimonial')) {
//                $testimonialObj = \App\Testimonial::getLatestList();
//                if (!empty($testimonialObj)) {
//                    $shareData['testimonialArr'] = $testimonialObj;
//                }
//            }
//
//            if (class_exists('\\App\\ContactInfo')) {
//                $contacts = \App\ContactInfo::getContactDetails();
//                foreach ($contacts as $contact) {
//                    if (isset($contact->chrIsPrimary) && $contact->chrIsPrimary == 'Y') {
//                        $objContactInfo = $contact;
//                    }
//                    if (isset($contact->chrIsPrimary) && $contact->chrIsPrimary == 'N') {
//                        $secondaryaddress = $contact;
//                    }
//                }
//                $shareData['objContactInfo'] = (!empty($objContactInfo)) ? $objContactInfo : '';
//                $shareData['secondaryaddress'] = (!empty($secondaryaddress)) ? $secondaryaddress : '';
//            }
//
//
//
//            if (!in_array(Request::segment(1), ['login', 'logout'])) {
//                if (!empty(Request::segment(2))) {
//                    Page_hits::insertDetailPageHits(Request::segment(2));
//                    // 	print_r($test);
//                    // exit();
//                } else {
//                    Page_hits::insertHits($pageCms);
//                    // print_r($test);
//                    // exit();
//                }
//            }
//        }
//        if (!Request::ajax()) {
//            if (isset($pageCms->varTitle) && strtolower($pageCms->varTitle) != 'home') {
//                $shareData = $this->setInnerBanner($pageCms);
//            } else {
//                $shareData = $this->setInnerBanner();
//            }
//            if (class_exists('\\App\\Advertise')) {
//                $advertise = \App\Advertise::getFrontRecordsByPage($cmsPageId);
//                if (!empty($advertise)) {
//                    foreach ($advertise as $ad) {
//                        $sectionArr = unserialize($ad->txtPosition);
//                        if (in_array('top', $sectionArr)) {
//                            $shareData['topAd'][] = $ad;
//                        }
//                        if (in_array('section_100', $sectionArr)) {
//                            $shareData['section_100'][] = $ad;
//                        }
//                        if (in_array('section_100_grid', $sectionArr)) {
//                            $shareData['section_100_grid'][] = $ad;
//                        }
//                        if (in_array('section_107', $sectionArr)) {
//                            $shareData['section_107'][] = $ad;
//                        }
//                    }
//                }
//            }
//            if (class_exists('\\App\\Testimonial')) {
//                $testimonialObj = \App\Testimonial::getLatestList();
//                if (!empty($testimonialObj)) {
//                    $shareData['testimonialArr'] = $testimonialObj;
//                }
//            }
//
//            if (class_exists('\\App\\ContactInfo')) {
//                $contacts = \App\ContactInfo::getContactDetails();
//                foreach ($contacts as $contact) {
//                    if (isset($contact->chrIsPrimary) && $contact->chrIsPrimary == 'Y') {
//                        $objContactInfo = $contact;
//                    }
//                    if (isset($contact->chrIsPrimary) && $contact->chrIsPrimary == 'N') {
//                        $secondaryaddress = $contact;
//                    }
//                }
//                $shareData['objContactInfo'] = (!empty($objContactInfo)) ? $objContactInfo : '';
//                $shareData['secondaryaddress'] = (!empty($secondaryaddress)) ? $secondaryaddress : '';
//            }
//            if (!in_array(Request::segment(1), ['login', 'logout'])) {
//                if (!empty(Request::segment(2))) {
//                    Page_hits::insertDetailPageHits(Request::segment(2));
//                    // 	print_r($test);
//                    // exit();
//                } else {
////                    Page_hits::insertHits($pageCms);
//                    // print_r($test);
//                    // exit();
//                }
//            }
//        }

       if(isset($pageCms->varTitle)){ $pageCms->varTitle = MyLibrary::getSEOMetaPricing($cmsPageId,'cms',$pageCms->varTitle); }
       if(isset($pageCms->varMetaTitle)){ $pageCms->varMetaTitle = MyLibrary::getSEOMetaPricing($cmsPageId,'cms',$pageCms->varMetaTitle); }
       if(isset($pageCms->varMetaKeyword)){ $pageCms->varMetaKeyword = MyLibrary::getSEOMetaPricing($cmsPageId,'cms',$pageCms->varMetaKeyword); }
       if(isset($pageCms->txtDescription)){ $pageCms->txtDescription = MyLibrary::getSEOMetaPricing($cmsPageId,'cms',$pageCms->txtDescription); } 

        $shareData['currentPageTitle'] = (isset($pageCms->varTitle) ? $pageCms->varTitle : Request::segment(1));
        $shareData['META_TITLE'] = isset($pageCms->varMetaTitle) ? $pageCms->varMetaTitle : ucfirst(Request::segment(1));
        $shareData['META_KEYWORD'] = isset($pageCms->varMetaKeyword) ? $pageCms->varMetaKeyword : Config::get('Constant.META_KEYWORD');
        $shareData['META_DESCRIPTION'] = isset($pageCms->varMetaDescription) ? trim($pageCms->varMetaDescription) : Config::get('Constant.DEFAULT_META_DESCRIPTION');
        $shareData['PAGE_CONTENT'] = isset($pageCms->txtDescription) ? $pageCms->txtDescription : Config::get('Constant.PAGE_CONTENT');
        $shareData['agent'] = $this->agent;
        $seg1 = Request::segment(1);
        $seg2 = Request::segment(2);
        //echo "Segment: ".$seg1 . " " . $seg2;
        if(isset($seg1))
        {
            if($seg1 == 'domain-checker')
            {
                $shareData['META_TITLE'] = 'Domain Checker - HostITSmart';
                $shareData['META_KEYWORD'] = 'Domain Checker - HostITSmart';
                $shareData['META_DESCRIPTION'] = 'Domain Checker - HostITSmart';
            }

            if($seg1 == 'cart' && empty($seg2))
            {
                $shareData['META_TITLE'] = 'Cart - HostITSmart';
                $shareData['META_KEYWORD'] = 'Cart - HostITSmart';
                $shareData['META_DESCRIPTION'] = 'Cart - HostITSmart';
            }

            if($seg1 == 'cart' && $seg2 == 'signin')
            {
                $shareData['META_TITLE'] = 'Signin - HostITSmart';
                $shareData['META_KEYWORD'] = 'Signin - HostITSmart';
                $shareData['META_DESCRIPTION'] = 'Signin - HostITSmart';
            }

            if($seg1 == 'cart' && $seg2 == 'billinginfo')
            {
                $shareData['META_TITLE'] = 'Billinginfo - HostITSmart';
                $shareData['META_KEYWORD'] = '';
                $shareData['META_DESCRIPTION'] = '';
            }

            if($seg1 == 'cart' && $seg2 == 'paymentoptions')
            {
                $shareData['META_TITLE'] = 'Payment Options - HostITSmart';
                $shareData['META_KEYWORD'] = '';
                $shareData['META_DESCRIPTION'] = '';
            }

            if($seg1 == 'otp-verification')
            {
                $shareData['META_TITLE'] = 'OTP Verification - HostITSmart';
                $shareData['META_KEYWORD'] = '';
                $shareData['META_DESCRIPTION'] = '';
            }
        }
        //echo '<pre>';print_r($shareData);exit;
        view()->share($shareData);
    }

}
