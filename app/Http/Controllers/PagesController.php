<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactInfo;
use App\CmsPage;
use App\Tld;
use App\GeneralFaq;
use App\Http\Traits\slug;
use App\Helpers\MyLibrary;
use Config;

//use App\Helpers\breadcrumb;
class PagesController extends FrontController {
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {

        $pagename = $request->segment(1);
        $aliasId = slug::resolve_alias($pagename);
        if(isset($aliasId) && !empty($aliasId)){ $data['aliasid'] = $aliasId; }
        $pageContent = CmsPage::getPageContentByPageAlias($aliasId);
        
        $Alternative = array(416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437,438,439,440,441);
//        echo $aliasId;
//        exit;
//        $this->breadcrumb = breadcrumb::getbreadcrumb($pagename);
        if ($aliasId == 2) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            return view('about-us', ['CONTENT' => $CONTENT]);
        } else if ($aliasId == 55) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            return view('aws-support', ['CONTENT' => $CONTENT]);
        }
        else if ($aliasId == 937) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            $data['Description'] = $CONTENT;
            return view('affiliates_policy', $data);

        } else if ($aliasId == 53) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            $testimonialObj = CmsPage::getHomeTestimonials();
            $data['testimonialData'] = $testimonialObj;
            $data['Description'] = $CONTENT;
            $data['FaqData'] = GeneralFaq::getProductsFaqRecords(19); //Fix for Domain privacy.
            return view('privacy', $data);
        } else if ($aliasId == 137) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            $testimonialObj = CmsPage::getHomeTestimonials();
            $data['testimonialData'] = $testimonialObj;
            $data['Description'] = $CONTENT;
            $data['FaqData'] = GeneralFaq::getFaqRecords();
            return view('privacy-policy', $data);
        } else if ($aliasId == 391) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            $testimonialObj = CmsPage::getHomeTestimonials();
            $data['testimonialData'] = $testimonialObj;
            $data['Description'] = $CONTENT;
            $data['FaqData'] = GeneralFaq::getFaqRecords();
            return view('terms', $data);
        } else if ($aliasId == 56) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
             $testimonialObj = CmsPage::getHomeTestimonials();
            return view('why-hits', ['CONTENT' => $CONTENT, 'testimonialData' => $testimonialObj]);
        } else if ($aliasId == 120) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            $contacts = ContactInfo::getContactDetails();
            $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
            $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
            return view('payment-options', [
                'contact_info' => $contacts,
                'PhoneNumner' => $PhoneNumner,
                'CONTENT' => $CONTENT,
                'EmailId' => $EmailId]);
        } else if ($aliasId == 121) {
            $CONTENT = "";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            return view('sitemap', ['CONTENT' => $CONTENT]);
        } else if (in_array($aliasId ,$Alternative)) {
            
            $testimonialObj = CmsPage::getHomeTestimonials();
            $data['testimonialData'] = $testimonialObj;
            $data['aliasId'] = $aliasId;
            //echo "aliasid: ".$aliasId;
            
            if($aliasId == 416) //linux hosting bigrock alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/bigrock_logo.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'249':'3.03';


                $data['pricing']['features'][] = 'Regular Price';
                $data['pricing']['features'][] = 'Free SSL certificate';
                $data['pricing']['features'][] = 'Disk space';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited email accounts';

                $data['pricing']['features'][] = 'Moneyback guarantee';
                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Subdomains';
                $data['pricing']['features'][] = '24x7 Support promise';
                $data['pricing']['features'][] = 'Unlimited FTP Users';
                $data['pricing']['features'][] = 'Instant Chat Response';

                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = '20GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = '30Days';

                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = '30Days';

                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = 'y';
            }
            else if($aliasId == 417) //linux hosting godaddy alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/godaddy.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'259.59':'3.16';


                $data['pricing']['features'][] = 'Regular Price';
                $data['pricing']['features'][] = 'Free SSL certificate';
                $data['pricing']['features'][] = 'Disk space';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited email accounts';

                $data['pricing']['features'][] = 'Moneyback guarantee';
                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Subdomains';
                $data['pricing']['features'][] = '24x7 Support promise';
                $data['pricing']['features'][] = 'Unlimited FTP Users';
                $data['pricing']['features'][] = 'Instant Chat Response';

                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = '20GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = '30Days';

                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = '50';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = '30Days';

                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = '50';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = 'y';
            }    
            else if($aliasId == 418) //linux hosting hostgator alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/hoster-gator.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'249':'3.03';


                $data['pricing']['features'][] = 'Regular Price';
                $data['pricing']['features'][] = 'Free SSL certificate';
                $data['pricing']['features'][] = 'Disk space';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited email accounts';

                $data['pricing']['features'][] = 'Moneyback guarantee';
                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Subdomains';
                $data['pricing']['features'][] = '24x7 Support promise';
                $data['pricing']['features'][] = 'Unlimited FTP Users';
                $data['pricing']['features'][] = 'Instant Chat Response';

                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = '20GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = '30Days';

                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

               $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = '30Days';

                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
            }  
             else if($aliasId == 419) //linux hosting ideastack alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/ideastack.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'68':'0.83';


                $data['pricing']['features'][] = 'Regular Price';
                $data['pricing']['features'][] = 'Free SSL certificate';
                $data['pricing']['features'][] = 'Disk space';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited email accounts';

                $data['pricing']['features'][] = 'Moneyback guarantee';
                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Subdomains';
                $data['pricing']['features'][] = '24x7 Support promise';
                $data['pricing']['features'][] = 'Unlimited FTP Users';
                $data['pricing']['features'][] = 'Instant Chat Response';

                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = '20GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = '30Days';

                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = '5GB';
                $data['pricing']['alternative'][] = '50GB';
                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = '15Days';

                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = 'y';
            }
            else if($aliasId == 420) //linux hosting webji alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/webji.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'750':'9.14';


                $data['pricing']['features'][] = 'Regular Price';
                $data['pricing']['features'][] = 'Free SSL certificate';
                $data['pricing']['features'][] = 'Disk space';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited email accounts';

                $data['pricing']['features'][] = 'Moneyback guarantee';
                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Subdomains';
                $data['pricing']['features'][] = '24x7 Support promise';
                $data['pricing']['features'][] = 'Unlimited FTP Users';
                $data['pricing']['features'][] = 'Instant Chat Response';

                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = '20GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = '30Days';

                $data['pricing']['hits'][] = 'n';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = '30Days';

                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
            }
            else if($aliasId == 421) //linux-reseller-hosting-bigrock-alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/bigrock_logo.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1349':'29.18';


                $data['pricing']['features'][] = 'Regular Price';
                
                $data['pricing']['features'][] = 'Storage';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited Domains';
                $data['pricing']['features'][] = 'Unlimited Subdomains';

                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Email Accounts';
                
                $data['pricing']['hits'][] = '100GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

                $data['pricing']['alternative'][] = '100GB';
                $data['pricing']['alternative'][] = '2000GB';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = ' ';
                $data['pricing']['alternative'][] = 'y';
                
            }
            else if($aliasId == 422) //linux-reseller-hosting-hostgator-alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/hoster-gator.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1345':'18.96';


                $data['pricing']['features'][] = 'Regular Price';
                
                $data['pricing']['features'][] = 'Storage';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited Domains';
                $data['pricing']['features'][] = 'Unlimited Subdomains';

                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Email Accounts';
                
                $data['pricing']['hits'][] = '100GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

                $data['pricing']['alternative'][] = '80GB';
                $data['pricing']['alternative'][] = '700GB';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                
            }
            else if($aliasId == 423) //linux-reseller-hosting-milesweb-alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/milesweb.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'648':'49.56';


                $data['pricing']['features'][] = 'Regular Price';
                
                $data['pricing']['features'][] = 'Storage';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited Domains';
                $data['pricing']['features'][] = 'Unlimited Subdomains';

                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Email Accounts';
                
                $data['pricing']['hits'][] = '100GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

                $data['pricing']['alternative'][] = '500GB';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                
            }
            else if($aliasId == 424) //linux-reseller-hosting-ideastack-alternative
            {
                $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
                $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
                $data['pricing']['hits_link'] = '/hosting';

                $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/ideastack.png';
                $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
                $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'6000':'24.82';


                $data['pricing']['features'][] = 'Regular Price';
                
                $data['pricing']['features'][] = 'Storage';
                $data['pricing']['features'][] = 'Bandwidth';
                $data['pricing']['features'][] = 'Unlimited Domains';
                $data['pricing']['features'][] = 'Unlimited Subdomains';

                $data['pricing']['features'][] = 'Unlimited Databases';
                $data['pricing']['features'][] = 'Unlimited Email Accounts';
                
                $data['pricing']['hits'][] = '100GB';
                $data['pricing']['hits'][] = 'Unlimited';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';
                $data['pricing']['hits'][] = 'y';

                $data['pricing']['alternative'][] = '100GB';
                $data['pricing']['alternative'][] = 'Unlimited';
                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = 'n';
                $data['pricing']['alternative'][] = 'y';
                $data['pricing']['alternative'][] = 'y';
                
            }
            else if($aliasId == 425) //linux-reseller-hosting-go4hosting-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/go-hosting.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1695':'26.94';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '100GB';
        $data['pricing']['hits'][] = 'Unlimited';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = '20GB';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 426) //linux-reseller-hosting-hostingraja-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.LINUX_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/hostingraja.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1200':'39.42';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '100GB';
        $data['pricing']['hits'][] = 'Unlimited';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = '75GB';
        $data['pricing']['alternative'][] = 'Unlimited';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        
    }
    else if($aliasId == 427) //windows-reseller-hosting-bigrock-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/bigrock_logo.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1929':'29.18';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Unlimited Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '60GB';
        $data['pricing']['hits'][] = '1200GB';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = '50GB';
        $data['pricing']['alternative'][] = '1000GB';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 428) //windows-reseller-hosting-hostgator-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/hoster-gator.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1325':'18.96';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Unlimited Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '60GB';
        $data['pricing']['hits'][] = '1200GB';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = '50GB';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 429) //windows-reseller-hosting-ideastack-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/ideastack.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'618.53':'49.56';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Unlimited Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '60GB';
        $data['pricing']['hits'][] = '1200GB';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = 'Unlimited';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'n';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 430) //windows-reseller-hosting-go4hosting-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/go-hosting.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1695':'24.82';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Unlimited Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '60GB';
        $data['pricing']['hits'][] = '1200GB';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = '20GB';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 431) //windows-reseller-hosting-b4uindia-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/b4uindia.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1200':'24.82';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Unlimited Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '60GB';
        $data['pricing']['hits'][] = '1200GB';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = '25GB';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'n';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 432) //windows-reseller-hosting-hostripples-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/hostripple.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'2150':'26.94';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Unlimited Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '60GB';
        $data['pricing']['hits'][] = '1200GB';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = 'Unlimited';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 433) //windows-reseller-hosting-resellerclub-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/resellerclub-logo.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'1495':'39.42';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Unlimited Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '60GB';
        $data['pricing']['hits'][] = '1200GB';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = '25GB';
        $data['pricing']['alternative'][] = '500GB';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 433) //windows-reseller-hosting-resellerclub-alternative
    {
        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR'):Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD');
        $data['pricing']['hits_link'] = '/hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/resellerclub-logo.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = (Config::get('Constant.sys_currency') == 'INR')?'':'';


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'Storage';
        $data['pricing']['features'][] = 'Unlimited Bandwidth';
        $data['pricing']['features'][] = 'Unlimited Domains';
        $data['pricing']['features'][] = 'Unlimited Subdomains';

        $data['pricing']['features'][] = 'Unlimited Databases';
        $data['pricing']['features'][] = 'Unlimited Email Accounts';
        
        $data['pricing']['hits'][] = '60GB';
        $data['pricing']['hits'][] = '1200GB';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'y';

        $data['pricing']['alternative'][] = '25GB';
        $data['pricing']['alternative'][] = '500GB';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = 'y';
    }
else if($aliasId == 434) //vps-hosting-bigrock-alternative
    {
        $Bigrock_vps_compare=unserialize(Config::get('Constant.BIGROCK_VPS_COMPARE'));

        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR'):Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD');
        $data['pricing']['hits_link'] = '/vps-hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/bigrock_logo.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = $Bigrock_vps_compare['Price'][Config::get('Constant.sys_currency')];


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'HardDisk';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Pre-installed panel';
        $data['pricing']['features'][] = 'Processor Core';
        $data['pricing']['features'][] = 'RAM';
        $data['pricing']['features'][] = 'Free SSL';
        // $data['pricing']['features'][] = 'Server management console';
        //$data['pricing']['features'][] = 'KVM';
        $data['pricing']['features'][] = 'Region';
        
        $data['pricing']['hits'][] = '20 GB';
        $data['pricing']['hits'][] = '2 TB Transfer';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = 'y';
        // $data['pricing']['hits'][] = 'y';
        //$data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'India';


        $data['pricing']['alternative'][] = $Bigrock_vps_compare['HardDisk'];
        $data['pricing']['alternative'][] = $Bigrock_vps_compare['Bandwidth'];
        $data['pricing']['alternative'][] = $Bigrock_vps_compare['Pre-installed panel'];
        $data['pricing']['alternative'][] = $Bigrock_vps_compare['Processor Core'];
        $data['pricing']['alternative'][] = $Bigrock_vps_compare['RAM'];
        $data['pricing']['alternative'][] = $Bigrock_vps_compare['Free SSL'];
        // $data['pricing']['alternative'][] = $Bigrock_vps_compare['Server management console'];
        $data['pricing']['alternative'][] = $Bigrock_vps_compare['Region'];
        //$data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 435) //vps-hosting-godaddy-alternative
    {
        $Godaddy_vps_compare=unserialize(Config::get('Constant.GODADDY_VPS_COMPARE'));

        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR'):Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD');
        $data['pricing']['hits_link'] = '/vps-hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/godaddy.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = $Godaddy_vps_compare['Price'][Config::get('Constant.sys_currency')];


        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'HardDisk';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Pre-installed panel';
        $data['pricing']['features'][] = 'Processor Core';
        $data['pricing']['features'][] = 'RAM';
        $data['pricing']['features'][] = 'Free SSL';
        // $data['pricing']['features'][] = 'Server management console';
        //$data['pricing']['features'][] = 'KVM';
        $data['pricing']['features'][] = 'Region';
        
        $data['pricing']['hits'][] = '20 GB';
        $data['pricing']['hits'][] = '2 TB Transfer';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = 'y';
        // $data['pricing']['hits'][] = 'y';
        //$data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'India';


        $data['pricing']['alternative'][] = $Godaddy_vps_compare['HardDisk'];
        $data['pricing']['alternative'][] = $Godaddy_vps_compare['Bandwidth'];
        $data['pricing']['alternative'][] = $Godaddy_vps_compare['Pre-installed panel'];
        $data['pricing']['alternative'][] = $Godaddy_vps_compare['Processor Core'];
        $data['pricing']['alternative'][] = $Godaddy_vps_compare['RAM'];
        $data['pricing']['alternative'][] = $Godaddy_vps_compare['Free SSL'];
        // $data['pricing']['alternative'][] = $Godaddy_vps_compare['Server management console'];
        //$data['pricing']['alternative'][] = 'y';
        $data['pricing']['alternative'][] = $Godaddy_vps_compare['Region'];
    }
    else if($aliasId == 436) //vps-hosting-hostgator-alternative
    {
        $Hostgator_vps_compare=unserialize(Config::get('Constant.HOSTGATOR_VPS_COMPARE'));

        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR'):Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD');
        $data['pricing']['hits_link'] = '/vps-hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/hoster-gator.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = $Hostgator_vps_compare['Price'][Config::get('Constant.sys_currency')];

        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'HardDisk';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Pre-installed panel';
        $data['pricing']['features'][] = 'Processor Core';
        $data['pricing']['features'][] = 'RAM';
        $data['pricing']['features'][] = 'Free SSL';
        // $data['pricing']['features'][] = 'Server management console';
        //$data['pricing']['features'][] = 'KVM';
        $data['pricing']['features'][] = 'Region';

        $data['pricing']['hits'][] = '20 GB';
        $data['pricing']['hits'][] = '2 TB Transfer';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = 'y';
        //$data['pricing']['hits'][] = 'y';
        //$data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'India';


        $data['pricing']['alternative'][] = $Hostgator_vps_compare['HardDisk'];
        $data['pricing']['alternative'][] = $Hostgator_vps_compare['Bandwidth'];
        $data['pricing']['alternative'][] = $Hostgator_vps_compare['Pre-installed panel'];
        $data['pricing']['alternative'][] = $Hostgator_vps_compare['Processor Core'];
        $data['pricing']['alternative'][] = $Hostgator_vps_compare['RAM'];
        $data['pricing']['alternative'][] = $Hostgator_vps_compare['Free SSL'];
        // $data['pricing']['alternative'][] = $Hostgator_vps_compare['Server management console'];
        $data['pricing']['alternative'][] = $Hostgator_vps_compare['Region'];
        //$data['pricing']['alternative'][] = 'y';
    }
    else if($aliasId == 437) //vps-hosting-milesweb-alternative
    {
        $Milesweb_vps_compare=unserialize(Config::get('Constant.MILESWEB_VPS_COMPARE'));

        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR'):Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD');
        $data['pricing']['hits_link'] = '/vps-hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/milesweb.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = $Milesweb_vps_compare['Price'][Config::get('Constant.sys_currency')];

        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'HardDisk';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Pre-installed panel';
        $data['pricing']['features'][] = 'Processor Core';
        $data['pricing']['features'][] = 'RAM';
        $data['pricing']['features'][] = 'Free SSL';
        // $data['pricing']['features'][] = 'Server management console';
        //$data['pricing']['features'][] = 'KVM';
        $data['pricing']['features'][] = 'Region';

        $data['pricing']['hits'][] = '20 GB';
        $data['pricing']['hits'][] = '2 TB Transfer';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = 'y';
        // $data['pricing']['hits'][] = 'y';
        //$data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'India';


        $data['pricing']['alternative'][] = $Milesweb_vps_compare['HardDisk'];
        $data['pricing']['alternative'][] = $Milesweb_vps_compare['Bandwidth'];
        $data['pricing']['alternative'][] = $Milesweb_vps_compare['Pre-installed panel'];
        $data['pricing']['alternative'][] = $Milesweb_vps_compare['Processor Core'];
        $data['pricing']['alternative'][] = $Milesweb_vps_compare['RAM'];
        $data['pricing']['alternative'][] = $Milesweb_vps_compare['Free SSL'];
        // $data['pricing']['alternative'][] = $Milesweb_vps_compare['Server management console'];
        $data['pricing']['alternative'][] = $Milesweb_vps_compare['Region'];
           
    }
    else if($aliasId == 438) //vps-hosting-hostinger-alternative
    {
        $Hostinger_vps_compare=unserialize(Config::get('Constant.HOSTINGER_VPS_COMPARE'));

        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR'):Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD');
        $data['pricing']['hits_link'] = '/vps-hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/hostinger.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = $Hostinger_vps_compare['Price'][Config::get('Constant.sys_currency')];

        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'HardDisk';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Pre-installed panel';
        $data['pricing']['features'][] = 'Processor Core';
        $data['pricing']['features'][] = 'RAM';
        $data['pricing']['features'][] = 'Free SSL';
        // $data['pricing']['features'][] = 'Server management console';
        //$data['pricing']['features'][] = 'KVM';
        $data['pricing']['features'][] = 'Region';

        $data['pricing']['hits'][] = '20 GB';
        $data['pricing']['hits'][] = '2 TB Transfer';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = 'y';
        // $data['pricing']['hits'][] = 'y';
        //$data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'India';


        $data['pricing']['alternative'][] = $Hostinger_vps_compare['HardDisk'];
        $data['pricing']['alternative'][] = $Hostinger_vps_compare['Bandwidth'];
        $data['pricing']['alternative'][] = $Hostinger_vps_compare['Pre-installed panel'];
        $data['pricing']['alternative'][] = $Hostinger_vps_compare['Processor Core'];
        $data['pricing']['alternative'][] = $Hostinger_vps_compare['RAM'];
        $data['pricing']['alternative'][] = $Hostinger_vps_compare['Free SSL'];
        // $data['pricing']['alternative'][] = $Hostinger_vps_compare['Server management console'];
        $data['pricing']['alternative'][] = $Hostinger_vps_compare['Region'];
           
    }
    else if($aliasId == 439) //vps-hosting-ideastack-alternative
    {
        $Ideastack_vps_compare=unserialize(Config::get('Constant.IDEASTACK_VPS_COMPARE'));

        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR'):Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD');
        $data['pricing']['hits_link'] = '/vps-hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/ideastack.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = $Ideastack_vps_compare['Price'][Config::get('Constant.sys_currency')];

        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'HardDisk';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Pre-installed panel';
        $data['pricing']['features'][] = 'Processor Core';
        $data['pricing']['features'][] = 'RAM';
        $data['pricing']['features'][] = 'Free SSL';
        // $data['pricing']['features'][] = 'Server management console';
        //$data['pricing']['features'][] = 'KVM';
        $data['pricing']['features'][] = 'Region';

        $data['pricing']['hits'][] = '20 GB';
        $data['pricing']['hits'][] = '2 TB Transfer';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = 'y';
        // $data['pricing']['hits'][] = 'y';
        //$data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'India';


        $data['pricing']['alternative'][] = $Ideastack_vps_compare['HardDisk'];
        $data['pricing']['alternative'][] = $Ideastack_vps_compare['Bandwidth'];
        $data['pricing']['alternative'][] = $Ideastack_vps_compare['Pre-installed panel'];
        $data['pricing']['alternative'][] = $Ideastack_vps_compare['Processor Core'];
        $data['pricing']['alternative'][] = $Ideastack_vps_compare['RAM'];
        $data['pricing']['alternative'][] = $Ideastack_vps_compare['Free SSL'];
        // $data['pricing']['alternative'][] = $Ideastack_vps_compare['Server management console'];
        $data['pricing']['alternative'][] = $Ideastack_vps_compare['Region'];
    }
    else if($aliasId == 440) //vps-hosting-go4hosting-alternative
    {
        $Go4hosting_vps_compare=unserialize(Config::get('Constant.GO4HOSTING_VPS_COMPARE'));

        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR'):Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD');
        $data['pricing']['hits_link'] = '/vps-hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/go-hosting.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = $Go4hosting_vps_compare['Price'][Config::get('Constant.sys_currency')];

        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'HardDisk';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Pre-installed panel';
        $data['pricing']['features'][] = 'Processor Core';
        $data['pricing']['features'][] = 'RAM';
        $data['pricing']['features'][] = 'Free SSL';
        // $data['pricing']['features'][] = 'Server management console';
        //$data['pricing']['features'][] = 'KVM';
        $data['pricing']['features'][] = 'Region';

        $data['pricing']['hits'][] = '20 GB';
        $data['pricing']['hits'][] = '2 TB Transfer';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = 'y';
        // $data['pricing']['hits'][] = 'y';
        //$data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'India';

        $data['pricing']['alternative'][] = $Go4hosting_vps_compare['HardDisk'];
        $data['pricing']['alternative'][] = $Go4hosting_vps_compare['Bandwidth'];
        $data['pricing']['alternative'][] = $Go4hosting_vps_compare['Pre-installed panel'];
        $data['pricing']['alternative'][] = $Go4hosting_vps_compare['Processor Core'];
        $data['pricing']['alternative'][] = $Go4hosting_vps_compare['RAM'];
        $data['pricing']['alternative'][] = $Go4hosting_vps_compare['Free SSL'];
        // $data['pricing']['alternative'][] = $Go4hosting_vps_compare['Server management console'];
        $data['pricing']['alternative'][] = $Go4hosting_vps_compare['Region'];
    }
    else if($aliasId == 441) //vps-hosting-b4uindia-alternative
    {
        $B4uindia_vps_compare=unserialize(Config::get('Constant.B4UINDIA_VPS_COMPARE'));

        $data['pricing']['hits_logopath'] = 'assets/images/logo.png';
        $data['pricing']['hits_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['hits_price'] = (Config::get('Constant.sys_currency') == 'INR')?Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR'):Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD');
        $data['pricing']['hits_link'] = '/vps-hosting';

        $data['pricing']['alt_logopath'] = 'assets/images/vps_hosting/webji.png';
        $data['pricing']['alt_logoclass'] = 'hostitsmart-logo';
        $data['pricing']['alt_price'] = $B4uindia_vps_compare['Price'][Config::get('Constant.sys_currency')];

        $data['pricing']['features'][] = 'Regular Price';
        
        $data['pricing']['features'][] = 'HardDisk';
        $data['pricing']['features'][] = 'Bandwidth';
        $data['pricing']['features'][] = 'Pre-installed panel';
        $data['pricing']['features'][] = 'Processor Core';
        $data['pricing']['features'][] = 'RAM';
        $data['pricing']['features'][] = 'Free SSL';
        // $data['pricing']['features'][] = 'Server management console';
        //$data['pricing']['features'][] = 'KVM';
        $data['pricing']['features'][] = 'Region';

        $data['pricing']['hits'][] = '20 GB';
        $data['pricing']['hits'][] = '2 TB Transfer';
        $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = '1';
        $data['pricing']['hits'][] = 'y';
        // $data['pricing']['hits'][] = 'y';
        $data['pricing']['hits'][] = 'India';


        $data['pricing']['alternative'][] = $B4uindia_vps_compare['HardDisk'];
        $data['pricing']['alternative'][] = $B4uindia_vps_compare['Bandwidth'];
        $data['pricing']['alternative'][] = $B4uindia_vps_compare['Pre-installed panel'];
        $data['pricing']['alternative'][] = $B4uindia_vps_compare['Processor Core'];
        $data['pricing']['alternative'][] = $B4uindia_vps_compare['RAM'];
        $data['pricing']['alternative'][] = $B4uindia_vps_compare['Free SSL'];
        // $data['pricing']['alternative'][] = $B4uindia_vps_compare['Server management console'];
        $data['pricing']['alternative'][] = $B4uindia_vps_compare['Region'];
    
    }
            return view('compare', $data);
        } else if ($aliasId == 134) {
            $WhoisData = '';

            $WhoisObj = CmsPage::getRecordIdByAliasID($aliasId);
            
            if(!empty($WhoisObj))
            {
                if (!empty($request->domainwhois)) {
                $DomainName = $this->remove_all_special_char($request->domainwhois);
                $ProductPricing = array('domainname' => $DomainName);
                $WhoisData = MyLibrary::laravelcallapi("getwhois", $ProductPricing);
                }
                $CONTENT = "";
                if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
                }

                //$Data = GeneralFaq::getFaqRecords();
                $Data = GeneralFaq::getFaqRecordsByIds([5,6,7,8]);

                return view('whois', ['CONTENT' => $CONTENT, 'FaqData' => $Data, 'WhoisData' => $WhoisData]);
            }
            else
            {
                return view('errors.404');
            }

        }

        else if ($aliasId == 936) { //affiliates page
            $AffiliatesData = '';

            $AffiliatesObj = CmsPage::getRecordIdByAliasID($aliasId);
            
            if(!empty($AffiliatesObj))
            {
                if (!empty($request->domainAffiliates)) {
                $DomainName = $this->remove_all_special_char($request->domainAffiliates);
                $ProductPricing = array('domainname' => $DomainName);
                $AffiliatesData = MyLibrary::laravelcallapi("getAffiliates", $ProductPricing);
                }
                $CONTENT = "";
                if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
                }
                $testimonialObj = CmsPage::getHomeTestimonials();
                 $data['testimonialData'] = $testimonialObj;

                //$Data = GeneralFaq::getFaqRecords();

                $Data = GeneralFaq::getFaqRecordsByIds([17]);

                return view('affiliate', ['CONTENT' => $CONTENT, 'FaqData' => $Data, 'AffiliatesData' => $AffiliatesData,'testimonialData' => $testimonialObj]);
            }
            
            else
            {
                return view('errors.404');
            }
        }
         else if ($aliasId == 135) {
            $Data = [];
            $Data['TLDData'] = Tld::getTLDNew();
            $Data['TLDFeatured'] = Tld::getTLDOffer();
            $FinalTld = array();
            $TldName = array();
            foreach ($Data['TLDData'] as $Tld) {
                $FinalTld[$Tld->id][$Tld->currency][$Tld->type] = $Tld->Price1;
                $TldName[$Tld->id] = $Tld->varTitle;
                $TldAliasName[$Tld->id] = $Tld->varAlias;
                $CatName = '';
                if ($Tld->varCategory != '') {
                    $CatName = Tld::getTLDCatNameNew($Tld->varCategory);
                }
                $TldCategory[$Tld->id] = $CatName;
            }
            $Data['ProductData'] = $FinalTld;
            $TLDFeatured = array();
            foreach ($Data['TLDFeatured'] as $TldFeatured) {
                $TLDFeatured[$TldFeatured->id][$TldFeatured->currency][$TldFeatured->type] = $TldFeatured->Price1;
                $TldNameFeatured[$TldFeatured->id] = $TldFeatured->varTitle;
                $TldAliasFeatured[$TldFeatured->id] = $TldFeatured->varAlias;
                $TldOfferFeatured[$TldFeatured->id] = $TldFeatured->varOffer;
            }

            $Data['ProductData'] = $FinalTld;
            $Data['TldName'] = $TldName;
            $Data['TldAliasName'] = $TldAliasName;
            $Data['TldCategory'] = $TldCategory;
            $Data['TLDFeatured'] = $TLDFeatured;
            $Data['TLDNameFeatured'] = $TldNameFeatured;
            $Data['TldAliasFeatured'] = $TldAliasFeatured;
            $Data['TldOfferFeatured'] = $TldOfferFeatured;
            return view('new-extensions', $Data);
        } else {
            $Title = $pageContent->varTitle;
            $CONTENT = "<h1>No Content Available</h1>";
            if (!empty($pageContent->txtDescription)) {
                $CONTENT = $pageContent->txtDescription;
            }
            return view('pages', ['CONTENT' => $CONTENT, 'Title' => $Title]);
        }
    }

    function remove_all_special_char($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9.\-]/', '', $string); // Removes special chars.
    }

}
