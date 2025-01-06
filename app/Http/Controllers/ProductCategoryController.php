<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\Products;
use App\Cart;
use App\CmsPage;
use App\user_session;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Helpers\Email_sender;
use App\Http\Traits\slug;
use Carbon\Carbon;
use Session;
use App\Banner;

class ProductCategoryController extends FrontController {

//    public $currency;
//    public $currency_code;
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        //Config::set('apiurl', Config::get('Constant.API_URL')."/checkdomain.php?"); //suggested tlds.
        $WHMCSUrl = config('app.api_url');
        Config::set('apiurl', $WHMCSUrl . "/checkdomain.php?");
        parent::__construct();
//        $this->currency = Config::get('Constant.sys_currency');
//        $this->currency_code = Config::get('Constant.sys_currency_code');
    }

    public function index($product_category) {
        if($product_category == 'domain'){ return redirect('/domain-registration'); }
        
        $aliasId = slug::resolve_alias_for_routes($product_category);
        $CetId = ProductCategory::getProductCategoriesId($aliasId);
        //echo $product_category. " - " .$CetId;
        if (!empty($CetId)) {
            if ($CetId->id == 1) {
                $Data = $this->Domain($CetId->id);
                $Data['CatId'] = $CetId->id;
                $Data['FeaturesData'] = Products::getFeaturesRecords(18);
                $Data['FaqData'] = Products::getFaqRecords(18);
                //echo '<pre>1';print_r($ProductData['FeaturesData']);exit;
                return view('domain', $Data);
            } 
            else if ($CetId->id == 9) { //For Domain Registration --------------
                $Data = $this->Domain($CetId->id);
                $Data['CatId'] = $CetId->id;
                $Data['FeaturesData'] = Products::getFeaturesRecords(18);
                $Data['FaqData'] = Products::getFaqRecords(18);
                //echo '<pre>2';print_r($ProductData['FeaturesData']);exit;
                return view('domain', $Data);
            } //For Domain Registration --------------
            else if ($CetId->id == 2) { //For Hosting 
               
                return redirect('/web-hosting'); //Redirect to web-hosting
                //$Data = $this->Hosting($CetId->id);
                //return view('hosting', $Data);
            }
             else if ($CetId->id == 10) { //For Web-Hosting
                // $Data = $this->Hosting($CetId->id);
                //echo '<pre>';print_r($Data);exit;
                // // vk 15/10/2019
                // $webhostingData = ProductCategory::getWebHostingRecords($CetId->id);
                // $Data['vertitle'] = $webhostingData[0]->txtShortDescription;
                // $Data['verdescription'] = $webhostingData[0]->txtDescription;
                // $Data['bannerData'] = Banner::getHomeBannerList($CetId->id);
                // // end
                // $Data['FaqData'] = ProductCategory::getFaqRecords($CetId->id);
                // $Data['CatId'] = $CetId->id;
                 $ProductData = [];
                $ProId = 29;
                $protext = "hosting"; 
                $MetaData = MyLibrary::getMetaDetails($ProId, 'products');
                $ProductData['CatId'] = $CetId->id;
                $ProductData["ProductBanner"] = Products::getProductBanner($ProId);
                $ProductData['FeaturesData'] = Products::getFeaturesRecords($ProId);
                $ProductData['FaqData'] = Products::getFaqRecords($ProId);
                $ProductData['FeaturedProductsData'] = Products::getFeaturedProductsRecords($ProId);
                $ProductData['ProductsPackageData'] = Products::getProductsPackageRecords($ProId);
                $ProductData['PageHits'] = ProductCategory::PageHits($CetId->id);
                $ProductData['META_TITLE'] = $MetaData->varMetaTitle;
                $ProductData['META_KEYWORD'] = $MetaData->varMetaKeyword;
                $ProductData['META_DESCRIPTION'] = $MetaData->varMetaDescription;
                $ProductData['bannerData'] = Banner::getHomeBannerList($ProId);
        $aliasId = slug::resolve_alias_for_routes(37);
                // echo '<pre>123: ';print_r($aliasId);exit;
                
                $ProductData['producttype'] = "hosting";
                // $ProductData['StarterMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '1',$aliasId,'',$ProId->id);

               $ProductData['BasicMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '1',$aliasId,$ProId);
                // echo '<pre>';print_r($ProductData);exit;
                $ProductData['EssentialMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '2',$aliasId,$ProId);
                $ProductData['EnterpriseMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '4',$aliasId,$ProId);
                $ProductData['ProfessionalMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '3',$aliasId,$ProId);

                $ProductData['BasicOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '1',$aliasId,$ProId);
                $ProductData['EssentialOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '2',$aliasId,$ProId);
                $ProductData['ProfessionalOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '3',$aliasId,$ProId);
                $ProductData['EnterpriseOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '4',$aliasId,$ProId);

                $ProductData['BasicTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '1',$aliasId,$ProId);
                $ProductData['EssentialTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '2',$aliasId,$ProId);
                $ProductData['ProfessionalTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '3',$aliasId,$ProId);
                $ProductData['EnterpriseTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '4',$aliasId,$ProId);

                $ProductData['BasicThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '1',$aliasId,$ProId);
                $ProductData['EssentialThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '2',$aliasId,$ProId);
                $ProductData['ProfessionalThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '3',$aliasId,$ProId);
                $ProductData['EnterpriseThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '4',$aliasId,$ProId);
                
                // echo '<pre>';print_r($ProId);exit;
                return view("web-hosting", $ProductData);

              
            }
              else if ($CetId->id == 11) { //For Web-Hosting ahm
                // $Data = $this->Hosting($CetId->id);
                // // vk 15/10/2019
                // $webhostingData = ProductCategory::getWebHostingRecords($CetId->id);
                // $Data['vertitle'] = $webhostingData[0]->txtShortDescription;
                // $Data['verdescription'] = $webhostingData[0]->txtDescription;
                // $Data['bannerData'] = Banner::getHomeBannerList($CetId->id);
                // // end
                // $Data['FaqData'] = ProductCategory::getFaqRecords($CetId->id);
                // $Data['CatId'] = $CetId->id;
                 $ProductData = [];
                $ProId = 30;
                $protext = "hosting"; 
                $MetaData = MyLibrary::getMetaDetails($ProId, 'products');
                $ProductData['CatId'] = $CetId->id;
                $ProductData["ProductBanner"] = Products::getProductBanner($ProId);
                $ProductData['FeaturesData'] = Products::getFeaturesRecords($ProId);
                $ProductData['FaqData'] = Products::getFaqRecords($ProId);
                $ProductData['FeaturedProductsData'] = Products::getFeaturedProductsRecords($ProId);
                $ProductData['ProductsPackageData'] = Products::getProductsPackageRecords($ProId);
                $ProductData['PageHits'] = ProductCategory::PageHits($CetId->id);
                $ProductData['META_TITLE'] = $MetaData->varMetaTitle;
                $ProductData['META_KEYWORD'] = $MetaData->varMetaKeyword;
                $ProductData['META_DESCRIPTION'] = $MetaData->varMetaDescription;
                $ProductData['bannerData'] = Banner::getHomeBannerList($ProId);
                
                $ProductData['producttype'] = "hosting";
                // echo '<pre>';print_r($aliasId);exit;
                // $ProductData['StarterMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '1',$aliasId,'',$ProId->id);

               $ProductData['BasicMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '1',$aliasId,$ProId);
                $ProductData['EssentialMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '2',$aliasId,$ProId);
                $ProductData['EnterpriseMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '4',$aliasId,$ProId);
                $ProductData['ProfessionalMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '3',$aliasId,$ProId);

                $ProductData['BasicOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '1',$aliasId,$ProId);
                $ProductData['EssentialOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '2',$aliasId,$ProId);
                $ProductData['ProfessionalOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '3',$aliasId,$ProId);
                $ProductData['EnterpriseOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '4',$aliasId,$ProId);

                $ProductData['BasicTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '1',$aliasId,$ProId);
                $ProductData['EssentialTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '2',$aliasId,$ProId);
                $ProductData['ProfessionalTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '3',$aliasId,$ProId);
                $ProductData['EnterpriseTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '4',$aliasId,$ProId);

                $ProductData['BasicThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '1',$aliasId,$ProId);
                $ProductData['EssentialThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '2',$aliasId,$ProId);
                $ProductData['ProfessionalThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '3',$aliasId,$ProId);
                $ProductData['EnterpriseThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '4',$aliasId,$ProId);
                // echo '<pre>';print_r($ProductData);exit;
                
                return view("web-hosting-ahmedabad", $ProductData);

              
            }
            else if ($CetId->id == 3) {
                $Data = $this->Servers($CetId->id);
                return view('server', $Data);
            } else if ($CetId->id == 4) {
                $ProductData = [];
                $ProId = 10;
                $MetaData = MyLibrary::getMetaDetails($ProId, 'products');
                $ProductData['CatId'] = $CetId->id;
                $ProductData["ProductBanner"] = Products::getProductBanner($ProId);
                $ProductData['FeaturesData'] = Products::getFeaturesRecords($ProId);
                $ProductData['FaqData'] = Products::getFaqRecords($ProId);
                $ProductData['FeaturedProductsData'] = Products::getFeaturedProductsRecords($ProId);
                $ProductData['ProductsPackageData'] = Products::getProductsPackageRecords($ProId);
                $ProductData['PageHits'] = ProductCategory::PageHits($CetId->id);
                $ProductData['META_TITLE'] = $MetaData->varMetaTitle;
                $ProductData['META_KEYWORD'] = $MetaData->varMetaKeyword;
                $ProductData['META_DESCRIPTION'] = $MetaData->varMetaDescription;
                //echo '<pre>';print_r($ProductData['ProductsPackageData']);exit;
                if ($ProId == "10") {
                    $protext = "ssl";
                } else {
                    $protext = ""; 
                }
                $ProductData['StarterMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '1');
                $ProductData['PerformanceMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '2');
                $ProductData['BusinessMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '3');
                
                $ProductData['StarterThreeMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'quarterly', url('/') . "/cart/store", 'post', '4');
                $ProductData['PerformanceThreeMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'quarterly', url('/') . "/cart/store", 'post', '5');
                $ProductData['BusinessThreeMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'quarterly', url('/') . "/cart/store", 'post', '6');
                
                $ProductData['StarterSixMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'semi-annually', url('/') . "/cart/store", 'post', '7');
                $ProductData['PerformanceSixMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'semi-annually', url('/') . "/cart/store", 'post', '8');
                $ProductData['BusinessSixMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'semi-annually', url('/') . "/cart/store", 'post', '9');
                
                $ProductData['StarterOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '10');
                
                //07 Aug Performance <=> Business error resolved bborikar
                //$ProductData['PerformanceOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '11');
                //$ProductData['BusinessOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '12');
                
                $ProductData['PerformanceOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '11');
                $ProductData['BusinessOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '12');
                
                $ProductData['StarterTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '13');
                $ProductData['PerformanceTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['4']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '14');
                $ProductData['BusinessTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['5']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '15');
                
                $ProductData['StarterThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '16');
                $ProductData['PerformanceThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '17');
                $ProductData['BusinessThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '18');
                
                //echo '<pre>';print_r($ProductData);exit;
                if ($ProId == "10") {
                    return view("sslproduct", $ProductData);
                    //return view("product", $ProductData);
                }
                else {
                    return view("product", $ProductData);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function Hosting($id) {
         $Data = [];
        $id2=$id;

        $MetaData = MyLibrary::getMetaDetails($id, 'product_category');
        //id=10 is for web hosting category.
        if(!empty($id) && $id==10){
        $Data['catId']=$id;
        $id2=2;
        }
        $Data['ProductData'] = ProductCategory::getHostingRecords($id2);
        $Data['FeaturesData'] = ProductCategory::getFeaturesRecords($id);
        $Data['FaqData'] = ProductCategory::getFaqRecords($id);
        $Data['FeaturedProductsData'] = ProductCategory::getFeaturedProductsRecords($id);
        $Data['PageHits'] = ProductCategory::PageHits($id);
        $Data['META_TITLE'] = $MetaData->varMetaTitle;
        $Data['META_KEYWORD'] = $MetaData->varMetaKeyword;
        $Data['META_DESCRIPTION'] = $MetaData->varMetaDescription;
        return $Data;
    }

    public function Servers($id) {
        $Data = [];
        $MetaData = MyLibrary::getMetaDetails($id, 'product_category');
        $Data['ProductData'] = ProductCategory::getHostingRecords($id);
        $Data['FeaturesData'] = ProductCategory::getFeaturesRecords($id);
        $Data['FaqData'] = ProductCategory::getFaqRecords($id);
        $Data['testimonialData'] = ProductCategory::getTestimonials($id);
        $Data['FeaturedProductsData'] = ProductCategory::getFeaturedProductsRecords($id);
        $Data['PageHits'] = ProductCategory::PageHits($id);
        $Data['META_TITLE'] = $MetaData->varMetaTitle;
        $Data['META_KEYWORD'] = $MetaData->varMetaKeyword;
        $Data['META_DESCRIPTION'] = $MetaData->varMetaDescription;
        return $Data;
    }

    public function Domain($id) {
      
        $Data = [];
        $MetaData = MyLibrary::getMetaDetails($id, 'product_category');
        $Data['ProductData'] = ProductCategory::getProductCatData($id);
        $Data['TLDData'] = ProductCategory::getTLDRecords();
        $Data['TLDAdData'] = ProductCategory::getTLDAdRecords();
        $Data['FaqData'] = ProductCategory::getFaqRecords($id);
        $Data['FeaturedProductsData'] = ProductCategory::getFeaturedProductsRecords($id);
        $Data['PageHits'] = ProductCategory::PageHits($id);
        $Data['META_TITLE'] = $MetaData->varMetaTitle;
        $Data['META_KEYWORD'] = $MetaData->varMetaKeyword;
        $Data['META_DESCRIPTION'] = $MetaData->varMetaDescription;
        $params = [];
        $params['currency'] = Config::get('Constant.sys_currency');
        $params['domain_type'] = "domainregister";
        $Tld_array = ProductCategory::GetTldData($params);
        
        if (!empty($Tld_array)) {
            foreach ($Tld_array as $value) {
                $Tlds[] = $value->varTitle;
            }
            $Data["Tlds"] = implode(",", $Tlds);
        }

        $TldsData = ProductCategory::GetTldCategoryData();
        foreach ($TldsData as $key => $value) {
            foreach ($Tld_array as $tld) { 
                $catArr = explode(",",$tld->varCategory);
                if(in_array($value->id, $catArr))
                {  $data[$value->varTitle][] = $tld->varTitle . "*" . $tld->varCountryName;  }
            }
        }
        $Data["tldcatdata"] = $data;
        


        return $Data;
    }

    public function DomainAvailibity(Request $request) {


        if (empty($request->domainname)) {
            return redirect('/domain');
        }

        $DomainName = str_replace("https://","",$request->domainname);
        $DomainName = str_replace("http://","",$DomainName);
        $DomainName = str_replace("www.","",$DomainName);

        $DomainName = $this->remove_all_special_char($DomainName);

        $tlddata = explode(".", $DomainName);
        if (empty($tlddata[0])) {
            return redirect('/domain')->with(['domain_error' => 'Please enter correct domain name.']);
        }


        if (!empty($tlddata[1])) {
            $tlddata[1] = $tlddata[1];
            if(isset($tlddata[2]) && !empty($tlddata[2])){ $tlddata[1] .= ".".$tlddata[2]; }
        } else {
            $tlddata[1] = "com";
        }

        $main_params['currency'] = Config::get('Constant.sys_currency');
        $main_params['tld'] = $tlddata[1];
        $main_params['domain_type'] = "domainregister";
        $Tld_Exit = ProductCategory::GetTldData($main_params);

        if ($request->transfer == 'y' && $Tld_Exit->isEmpty()) {
            return;
        } else if ($Tld_Exit->isEmpty() && $request->transfer != 'y') {  //check tld exit in our db or not
            $tlddata[1] = "com";
        } else {
            $tlddata[1] = $tlddata[1];
        }

        $params = [];
        $params['currency'] = Config::get('Constant.sys_currency');
        $params['tld'] = $tlddata[1];
        $params['domain_type'] = "all";
        $Tld_Availibity = ProductCategory::GetTldData($params);

        foreach ($Tld_Availibity as $value) {
            if ($value->type == "domainregister") {
                $register_price = $value->Price1;
            }

            if ($value->type == "domainrenew") {
                $renew_price = $value->Price1;
            }

            if ($value->type == "domaintransfer") {
                $transfer_price = $value->Price1;
            }
        }


        $DomainParam = array('domainname' => $tlddata[0], 'tlds' => $tlddata[1]);
        $domainAvailData = ProductCategory::checkDomainAvailability($DomainParam);
        // echo '<pre>'; print_r($domainAvailData);exit;
        
        if (!empty($domainAvailData)) {
            $domainAvailData = json_decode($domainAvailData);
        }


        $finalData = array();


        if (!empty($domainAvailData)) {
            foreach ($domainAvailData as $key => $domain) {
                $finalData['reg_pricing'] = $register_price;
                $finalData['trans_pricing'] = $transfer_price;
                $finalData['ren_pricing'] = $renew_price;
                $finalData['status'] = $domain->status;
                $finalData["domainname"] = $key;
                $finalData['data'] = $ctld = Cart::extractTldFromDomain($key)['tld'];
            }
        }

        $domaindata = $finalData;

        // echo '<pre>'; print_r($finalData);exit;

        if ($request->domain_search == 'y') {

            $deals_id = ProductCategory::getdeals();
            if(!empty($deals_id)){
            $deals_param = [];
            $deals_param["deals_id"] = '129';
            $deals_param["deals_cat"] = '1';
            $deals_param["deals_type"] = '1';
            $deals_param["prod_cat_id"] = '2';
            $deals_param["prod_id"] = '26,27,28';
            
            $deals_data = ProductCategory::getdealsdata($deals_param);
            // echo '<pre>'; print_r($deals_data); exit;
                if ($deals_data) {
                    $price_field = strtoupper(str_replace(" ", '_', 'Buy Wordpress Hosting For 1 Year & Get 1 Month Free'));

                    $get_price = ProductCategory::getproductprice($price_field, Config::get('Constant.sys_currency'));
                    if (!empty($get_price)) {
                        $ProductPrice = $get_price->price;
                    } else {
                        $ProductPrice = '';
                    }
                }
            }
            
             $paramss = Cart::extractTldFromDomain($_POST['domainname']);
            $domainAvailData=array();
            $params = [];
            $params['currency'] = Config::get('Constant.sys_currency');
            $params['domain_type'] = "domainregister";
            $params['domainname']=$paramss['domainname'];
            $Country_Tlds = ProductCategory::GetCountryTLD();

             //Domain Suggestions if display domain availability in domain search page.

                //$Suggested_Tlds = CmsPage::getTLds();
                if($paramss['tld']==""){
                    $paramss['tld']='com';   
                }else{
                    $paramss['tld']=$paramss['tld'];
                }

                $Suggested_Tlds = CmsPage::getSuggestedTLds($paramss['tld']);    

                /*foreach($Suggested_Tlds as $keys=>$values)
                {
                   $params['tld'] = $values->varTitle;
                   $domainAvailData[] = json_decode(ProductCategory::checkDomainAvailability($params));
                   
                   echo "<pre>";print_r($domainAvailData[0]);
                }*/

                   
                   //exit;

                    /* if (!empty($domainAvailData)) {
                                    $domainAvailData[] = json_decode($domainAvailData);
                
                            }*/

                   /* echo '<pre>';print_r($domainAvailData);
                    */   
            //exit;

            if (!empty($Country_Tlds)) {
                foreach ($Country_Tlds as $value) {
                    $CTlds[] = $value->varTitle;
                }
                $Country_Tld = $CTlds;
            }
        }

        if ($request->transfer == 'y') {
            return $finalData;
        } else {
            if ($request->domain_search != 'y') {
                return view('domainsearch', ['domaindata' => $finalData]);
            } else {
                return view('domainsearch', compact('domaindata', 'deals_data', 'ProductPrice', 'Country_Tld','Suggested_Tlds','paramss'));
            }
        }
    }


    /*public function DomainAvailibity(Request $request) {


        if (empty($request->domainname)) {
            return redirect('/domain');
        }

        $DomainName = str_replace("https://","",$request->domainname);
        $DomainName = str_replace("http://","",$DomainName);
        $DomainName = str_replace("www.","",$DomainName);

        $DomainName = $this->remove_all_special_char($DomainName);

        $tlddata = explode(".", $DomainName);
        if (empty($tlddata[0])) {
            return redirect('/domain')->with(['domain_error' => 'Please enter correct domain name.']);
        }


        if (!empty($tlddata[1])) {
            $tlddata[1] = $tlddata[1];
            if(isset($tlddata[2]) && !empty($tlddata[2])){ $tlddata[1] .= ".".$tlddata[2]; }
        } else {
            $tlddata[1] = "com";
        }

        $main_params['currency'] = Config::get('Constant.sys_currency');
        $main_params['tld'] = $tlddata[1];
        $main_params['domain_type'] = "domainregister";
        $Tld_Exit = ProductCategory::GetTldData($main_params);

        if ($request->transfer == 'y' && $Tld_Exit->isEmpty()) {
            return;
        } else if ($Tld_Exit->isEmpty() && $request->transfer != 'y') {  //check tld exit in our db or not
            $tlddata[1] = "com";
        } else {
            $tlddata[1] = $tlddata[1];
        }



        $params = [];
        $params['currency'] = Config::get('Constant.sys_currency');
        $params['tld'] = $tlddata[1];
        $params['domain_type'] = "all";
        $Tld_Availibity = ProductCategory::GetTldData($params);

        foreach ($Tld_Availibity as $value) {
            if ($value->type == "domainregister") {
                $register_price = $value->Price1;
            }

            if ($value->type == "domainrenew") {
                $renew_price = $value->Price1;
            }

            if ($value->type == "domaintransfer") {
                $transfer_price = $value->Price1;
            }
        }


        $DomainParam = array('domainname' => $tlddata[0], 'tld' => $tlddata[1]);

        $domainAvailData = ProductCategory::checkDomainAvailability($DomainParam);
        
        if (!empty($domainAvailData)) {
            $domainAvailData = json_decode($domainAvailData);
        }


        $finalData = array();
        if (!empty($domainAvailData)) {
            foreach ($domainAvailData as $key => $domain) {
                $finalData['reg_pricing'] = $register_price;
                $finalData['trans_pricing'] = $transfer_price;
                $finalData['ren_pricing'] = $renew_price;
                $finalData['status'] = $domain->status;
                $finalData["domainname"] = $key;
                $finalData['data'] = $ctld = Cart::extractTldFromDomain($key)['tld'];
            }
        }

        $domaindata = $finalData;

        if ($request->domain_search == 'y') {

            $deals_id = ProductCategory::getdeals();

            $deals_param = [];
            $deals_param["deals_id"] = $deals_id->deals_id;
            $deals_param["deals_cat"] = $deals_id->did;
            $deals_param["deals_type"] = $deals_id->type;
            $deals_param["prod_cat_id"] = $deals_id->cid;
            $deals_param["prod_id"] = $deals_id->pid;

            $deals_data = ProductCategory::getdealsdata($deals_param);

            if ($deals_data) {
                $price_field = strtoupper(str_replace(" ", '_', $deals_data->varTitle));

                $get_price = ProductCategory::getproductprice($price_field, Config::get('Constant.sys_currency'));
                if (!empty($get_price)) {
                    $ProductPrice = $get_price->price;
                } else {
                    $ProductPrice = '';
                }
            }
             $paramss = Cart::extractTldFromDomain($_POST['domainname']);
            $domainAvailData=array();
            $params = [];
            $params['currency'] = Config::get('Constant.sys_currency');
            $params['domain_type'] = "domainregister";
            $params['domainname']=$paramss['domainname'];
            $Country_Tlds = ProductCategory::GetCountryTLD();

             //Domain Suggestions if display domain availability in domain search page.
           
                //$Suggested_Tlds = CmsPage::getTLds();
                if($paramss['tld']==""){
                    $paramss['tld']='com';   
                }else{
                    $paramss['tld']=$paramss['tld'];
                }

                $Suggested_Tlds = CmsPage::getSuggestedTLds($paramss['tld']);    

              
            if (!empty($Country_Tlds)) {
                foreach ($Country_Tlds as $value) {
                    $CTlds[] = $value->varTitle;
                }
                $Country_Tld = $CTlds;
            }
        }

        if ($request->transfer == 'y') {
            return $finalData;
        } else {
            if ($request->domain_search != 'y') {
                return view('domainsearch', ['domaindata' => $finalData]);
            } else {

                return view('domainsearch', compact('domaindata', 'deals_data', 'ProductPrice', 'Country_Tld','Suggested_Tlds','paramss'));
            }
        }
    }*/


    public function domainsuggestion(Request $request) {
        
           if($request->search=="bulk")
        {
            $DomainnameArr=explode(",",$request->domainname);
            $tldlistbulk=explode(",",$request->tld);

            foreach($DomainnameArr as $key=>$domainval)
            {   
                $DomainNamebulk = str_replace("https://","",$domainval);
                $DomainNamebulk = str_replace("http://","",$DomainNamebulk);
                $DomainNamebulk = str_replace("www.","",$DomainNamebulk);
                
                $dmn=".".$tldlistbulk[$key];
                $DomainNamebulk=str_replace($dmn,"",$domainval);

                $DomainNamebulks[] = $this->remove_all_special_char($DomainNamebulk);
                
            }
            
            $domainnamebulk=$DomainNamebulks;
            
            if(count($DomainNamebulks)!='0')
            {
                $curr = $request->currency;

                $params = [];
                $params['currency'] = Config::get('Constant.sys_currency');
                $params['tld'] = $tldlistbulk;
                $params['domain_type'] = "both";
                $params['domainname'] = $domainnamebulk;
                $params['loadTlds']="";
                $params['tlds'] = $tldlistbulk;
                $domainPricing = ProductCategory::GetTldData($params);
            }
                
            if (!$domainPricing->isEmpty())
            {

                $domainAvailData = ProductCategory::checkDomainAvailabilityall($params);

                if (!empty($domainAvailData))
                {
                    $domainAvailData = json_decode($domainAvailData);
                } 

                $SuggData = array();
            if (!empty($domainAvailData)) {
                if (session()->has('cart')) {
                    $cart_array = Session::get('cart');
                    
                    if(!empty($cart_array)){
                        if(array_key_exists('userid',$cart_array))        { unset($cart_array['userid']); }
                        if(array_key_exists('paymentmethod',$cart_array)) { unset($cart_array['paymentmethod']); }
                        if(array_key_exists('recommndation',$cart_array)) { unset($cart_array['recommndation']); }            
                        if(array_key_exists('prmocode',$cart_array))      { unset($cart_array['prmocode']); }
                        if(array_key_exists('prmodiscount',$cart_array))  { unset($cart_array['prmodiscount']); }
                        if(array_key_exists('prmomessage',$cart_array))   { unset($cart_array['prmomessage']); }
                    }

                    $cartDomains = array();
                    
                    foreach ($cart_array as $key => $cart_data) {
                        $cartDomains[] = $cart_data["domain"];
                    }
                }
               
              foreach($domainAvailData as $key => $domain) {
                    
                    $SuggData[$key]["domainname"] = $key;
                    $SuggData[$key]['status'] = $domain->status;
                    $SuggData[$key]['data'] = $ctld = Cart::extractTldFromDomain($key)['tld'];
                    $SuggData[$key]['tld'] = $ctld;


                     foreach ($domainPricing as $value)
                     {
                        if($ctld==$value->varTitle)
                        {
                            $SuggData[$key]['pricing']["available"] = $value->Price1;
                            $SuggData[$key]['pricing']["transfer"] = $value->Price1;
                        }
                     }      
                    

                    if (session()->has('cart')) {
                        
                        if (in_array($key,$cartDomains)) {
                            $SuggData[$key]["session_key"] = implode(",",array_keys($cartDomains, $key));
                        }
                        else
                        {
                            $SuggData[$key]["session_key"] = '';
                        }
                    }
                }
                //All Pricing
                foreach ($domainPricing as $value)
                 {
                    $SuggData['allpricing']["available"] = $value;
                 }

            }
           
            return $SuggData;
            }
            else {
            return 'error';
            }

        }
        else
        {

//        echo $this->currency;exit;
         $DomainName = str_replace("https://","",$request->domainname);
        $DomainName = str_replace("http://","",$DomainName);
        $DomainName = str_replace("www.","",$DomainName);

        $DomainName = $this->remove_all_special_char($DomainName);
        //$Tld[] = $request->tld;

        $tldlist=explode(",",$request->tld);
        
        $tlddata = explode(".", $DomainName);
        if (!empty($DomainName)) {
            $curr = $request->currency;
//            $domainPricing[$Tld] = Cart::getDomainPricing(['tlds' => "." . $Tld, 'currency' => Config::get('user.currency')]);
            $params = [];
            $params['currency'] = Config::get('Constant.sys_currency');
            $params['tld'] = $tldlist;
            $params['domain_type'] = "both";
            $params['domainname'] = $request->domainname;
            $params['loadTlds']=$request->loadtlds;
            $domainPricing = ProductCategory::GetTldData($params);
            //$suggestedDomains = $tlddata[0] . "." . $Tld;
        }
            foreach($domainPricing as $key=>$val)
            {   
                $params['tlds'][$key]=$val->varTitle;
            }

        if (!$domainPricing->isEmpty()) {
            /*if (!empty($suggestedDomains)) {
                $params = Cart::extractTldFromDomain($suggestedDomains);
            }*/

            $domainAvailData = ProductCategory::checkDomainAvailabilityall($params);
            if (!empty($domainAvailData)) {
                $domainAvailData = json_decode($domainAvailData);
            }

            $SuggData = array();
            if (!empty($domainAvailData)) {
                if (session()->has('cart')) {
                    $cart_array = Session::get('cart');
                    
                    if(!empty($cart_array)){
                        if(array_key_exists('userid',$cart_array))        { unset($cart_array['userid']); }
                        if(array_key_exists('paymentmethod',$cart_array)) { unset($cart_array['paymentmethod']); }
                        if(array_key_exists('recommndation',$cart_array)) { unset($cart_array['recommndation']); }            
                        if(array_key_exists('prmocode',$cart_array))      { unset($cart_array['prmocode']); }
                        if(array_key_exists('prmodiscount',$cart_array))  { unset($cart_array['prmodiscount']); }
                        if(array_key_exists('prmomessage',$cart_array))   { unset($cart_array['prmomessage']); }
                    }

                    $cartDomains = array();
                    
                    foreach ($cart_array as $key => $cart_data) {
                        $cartDomains[] = $cart_data["domain"];
                    }
                }
               
                for($i=0;$i<count($params['tld']);$i++)
                {
                    $fullName=$params['domainname'].".".$params['tld'][$i];
                    
                foreach($domainAvailData as $key => $domain) {
                        $fullName = strtolower($fullName);
                        $key = strtolower($key);
                        if($fullName == $key)
                        {
                    $SuggData[$key]["domainname"] = $key;
                    $SuggData[$key]['status'] = $domain->status;
                    $SuggData[$key]['data'] = $ctld = Cart::extractTldFromDomain($key)['tld'];
                    $SuggData[$key]['tld'] = $ctld;
//                $SuggData['pricing'] = $domainPricing[$ctld][0]->register;
//                if ($domain->status == 'available') {

                     foreach ($domainPricing as $value)
                     {
                        if($ctld==$value->varTitle)
                        {
                            $SuggData[$key]['pricing']["available"] = $value->Price1;
                            $SuggData[$key]['pricing']["transfer"] = $value->Price1;
                            $SuggData[$key]['allpricing']['available']=$value;
                        }
                     }      
                     //$SuggData['allpricing']["available"] = $value;
                    /*$SuggData['pricing']["available"] = $domainPricing[$ctld][1]->Price1;
                    $SuggData['allpricing']["available"] = $domainPricing[$ctld][1];
//                } else {
                    $SuggData['pricing']["transfer"] = $domainPricing[$ctld][0]->Price1;
                    $SuggData['allpricing']["transfer"] = $domainPricing[$ctld][0];*/
//                }

                    if (session()->has('cart')) {
                        
                        if (in_array($key,$cartDomains)) {
                            $SuggData[$key]["session_key"] = implode(",",array_keys($cartDomains, $key));
                        }
                        else
                        {
                            $SuggData[$key]["session_key"] = '';
                        }
                    }
                }
                }
                }

                //All Pricing
               /* foreach ($domainPricing as $value)
                 {
                    $SuggData['allpricing']["available"] = $value;
                 }*/

            }
            return $SuggData;
        } else {
            return 'error';
        }
    }
    }

   /* public function domainsuggestion(Request $request) {
//        echo $this->currency;exit;
         $DomainName = str_replace("https://","",$request->domainname);
        $DomainName = str_replace("http://","",$DomainName);
        $DomainName = str_replace("www.","",$DomainName);

        $DomainName = $this->remove_all_special_char($DomainName);
        $Tld = $request->tld;
        $tlddata = explode(".", $DomainName);
        if (!empty($DomainName)) {
            $curr = $request->currency;
//            $domainPricing[$Tld] = Cart::getDomainPricing(['tlds' => "." . $Tld, 'currency' => Config::get('user.currency')]);
            $params = [];
            $params['currency'] = ($curr) ? $curr : 'INR';
            $params['tld'] = $Tld;
            $params['domain_type'] = "both";


            $domainPricing[$Tld] = ProductCategory::GetTldData($params);
            $suggestedDomains = $tlddata[0] . "." . $Tld;
        }

        if (!$domainPricing[$Tld]->isEmpty()) {
            if (!empty($suggestedDomains)) {
                $params = Cart::extractTldFromDomain($suggestedDomains);
            }
            $domainAvailData = ProductCategory::checkDomainAvailability($params);

            if (!empty($domainAvailData)) {
                $domainAvailData = json_decode($domainAvailData);
            }


            $SuggData = array();
            if (!empty($domainAvailData)) {
                if (session()->has('cart')) {
                    $cart_array = Session::get('cart');
                    
                    if(!empty($cart_array)){
                        if(array_key_exists('userid',$cart_array))        { unset($cart_array['userid']); }
                        if(array_key_exists('paymentmethod',$cart_array)) { unset($cart_array['paymentmethod']); }
                        if(array_key_exists('recommndation',$cart_array)) { unset($cart_array['recommndation']); }            
                        if(array_key_exists('prmocode',$cart_array))      { unset($cart_array['prmocode']); }
                        if(array_key_exists('prmodiscount',$cart_array))  { unset($cart_array['prmodiscount']); }
                        if(array_key_exists('prmomessage',$cart_array))   { unset($cart_array['prmomessage']); }
                    }

                    $cartDomains = array();
                    $SuggData["session_key"] = '';
                    foreach ($cart_array as $key => $cart_data) {
                        $cartDomains[] = $cart_data["domain"];
                    }
                }
                foreach ($domainAvailData as $key => $domain) {
                    $SuggData["domainname"] = $key;
                    $SuggData['status'] = $domain->status;
                    $SuggData['data'] = $ctld = Cart::extractTldFromDomain($key)['tld'];
                    $SuggData['tld'] = $ctld;
//                $SuggData['pricing'] = $domainPricing[$ctld][0]->register;
//                if ($domain->status == 'available') {
                    $SuggData['pricing']["available"] = $domainPricing[$ctld][1]->Price1;
                    $SuggData['allpricing']["available"] = $domainPricing[$ctld][1];
//                } else {
                    $SuggData['pricing']["transfer"] = $domainPricing[$ctld][0]->Price1;
                    $SuggData['allpricing']["transfer"] = $domainPricing[$ctld][0];
//                }
                    if (session()->has('cart')) {
                        if (in_array($suggestedDomains, $cartDomains)) {
                            $SuggData["session_key"] = array_keys($cartDomains, $suggestedDomains)[0];
                        }
                    }
                }
            }

            return $SuggData;
        } else {
            return 'error';
        }
    }
*/
    function remove_all_special_char($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9.\-]/', '', $string); // Removes special chars.
    }

    public function pricefilterdata(Request $request) {
        $params = [];
        $params['currency'] = $request->currency;
        $params['min'] = $request->min;
        $params['max'] = $request->max;
        $params['regperiod'] = $request->regperiod;
        $params['domain_type'] = "domainregister";
        $Tld_array = ProductCategory::GetTldData($params);

        if (!$Tld_array->isEmpty()) {
            foreach ($Tld_array as $value) {
                $Tlds[] = $value->varTitle;
            }
            $Data = implode(",", $Tlds);
            echo $Data;
            exit;
        } else {
            echo "0";
            exit;
        }
    }

    public function domaintransferdata(Request $request) {
        $rowData = $request->all();
        if (isset($rowData['_token'])) {
            unset($rowData['_token']);
        } //remove _token as not required further.
        if (isset($rowData['submit'])) {
            unset($rowData['submit']);
        }
        $data = array();
        if (!empty($rowData)) {
            foreach ($rowData as $key => $ele) {
                foreach ($ele as $i => $itm) {
                    $data[$i][$key] = $itm;
                }
            }
        }
        foreach ($data as $key => $requestData) {
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            if (!empty($cartData)) {
                $request_domain = $requestData["domain"];

                if(!empty($cartData)){
                    if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
                    if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
                    if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
                    if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
                    if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
                    if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
                }

                $cartDomains = array();
                foreach ($cartData as $key => $cart_data) {
                    $cartDomains[] = $cart_data["domain"];
                }
                if (in_array($request_domain, $cartDomains)) {
                    continue;
                }
            }
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            $requestData = (object) $requestData;
            $item = [];
            $item['producttype'] = "domain";
            $item['domaintype'] = "transfer";   //if Domain 
            $item['authcode'] = $requestData->authcode;
            $item['regperiod'] = "1";
            if (isset($requestData->domain))
                $item['domain'] = $requestData->domain;
            if (isset($requestData->pricing))
                $req_tld = explode(".", $requestData->domain);
//                $item['pricing'] = $requestData->pricing;
//            $item['pricing'] = Cart::getDomainPricing(['tlds' => 'net', 'currency' => 1]);

            $item['pricing'] = Cart::getDomainPricing(['tlds' => "." . $req_tld[1], 'currency' => Config::get('Constant.sys_currency_code')]);
            if (isset($requestData->authcode))
                if (!empty(Session::get('WhmcsID'))) {
                    $User_ID = Session::get('WhmcsID');
                } else {
                    $User_ID = '';
                }
            if (!empty($item)) {
                Cart::addtocart($request, $item, $User_ID);
            }
        }
        return redirect('cart');
    }

    public function addtocart(Request $request) {
        if ($request->has('jsonarr')) {
            $rowData = (array) json_decode($request->jsonarr);
        } else {
            $rowData = $request->all();
        }
        if (isset($rowData['_token'])) {
            unset($rowData['_token']);
        } //remove _token as not required further.
        if (isset($rowData["ext_domain"])) {
            unset($rowData['ext_domain']);
        } // remove ext_domain as not required further.
        if (isset($rowData["h_tld"])) {
            unset($rowData['h_tld']);
        } // remove h_tld as not required further.
        if (!empty(Session::get('WhmcsID'))) {
            $User_ID = Session::get('WhmcsID');
        } else {
            $User_ID = '';
        }
        $data = array();
        if (!empty($rowData)) {
            foreach ($rowData as $key => $ele) {
                if ($key == 'pricing') {
                    $data[$i][$key] = $ele;
                } else {
                    foreach ($ele as $i => $itm) {
                        $data[$i][$key] = $itm;
                    }
                }
            }
        }
        foreach ($data as $key => $requestData) {
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            if (!empty($cartData)) {
                $request_domain = $requestData["domain"];

                if(!empty($cartData)){
                    if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
                    if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
                    if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
                    if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
                    if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
                    if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
                }

                $cartDomains = array();
                foreach ($cartData as $key => $cart_data) {
                    $cartDomains[] = $cart_data["domain"];
                }
                if (in_array($request_domain, $cartDomains)) {
                    continue;
                }
            }
            $requestData = (object) $requestData;
            $item = [];
            if (isset($requestData->producttype))
                $item['producttype'] = $requestData->producttype;      //product type
            if (isset($requestData->pid))
                $item['pid'] = $requestData->pid;      //prodictid for product
            if (isset($requestData->billingcycle))
                $item['billingcycle'] = $requestData->billingcycle;   //if billingcycle for product
            if (isset($requestData->domain))
                $item['domain'] = $requestData->domain;     //if Domain 
            if (isset($requestData->domaintype))
                $item['domaintype'] = $requestData->domaintype;   //if Domain 
            if (isset($requestData->regperiod))
                $item['regperiod'] = $requestData->regperiod;    //if Domain 

            $item['pricing'] = Cart::getDomainPricing(['tlds' => $requestData->tld, 'currency' => Config::get('Constant.sys_currency_code')]);

            $Addcart = array();

            if (!empty($item)) {
                $Addcart = Cart::addtocart($request, $item, $User_ID);
                $Cart_Session_data = $request->session()->get('cart');
                
                if(!empty($Cart_Session_data)){
                    if(array_key_exists('userid',$Cart_Session_data))        { unset($Cart_Session_data['userid']); }
                    if(array_key_exists('paymentmethod',$Cart_Session_data)) { unset($Cart_Session_data['paymentmethod']); }
                    if(array_key_exists('recommndation',$Cart_Session_data)) { unset($Cart_Session_data['recommndation']); }            
                    if(array_key_exists('prmocode',$Cart_Session_data))      { unset($Cart_Session_data['prmocode']); }
                    if(array_key_exists('prmodiscount',$Cart_Session_data))  { unset($Cart_Session_data['prmodiscount']); }
                    if(array_key_exists('prmomessage',$Cart_Session_data))   { unset($Cart_Session_data['prmomessage']); }
                }


                foreach ($Cart_Session_data as $key => $value) {
                    if ($value["domaintype"] != 'transfer') {
                        $session_data[$key] = str_replace(".", '_', $value["domain"]);
                    }
                }
            }
        }


        if ($request->ajax()) {
            return $session_data;
        } else {
            return redirect('domain-checker');
        }
    }

    public function removecart(Request $request) {
        Cart::removeCart($request);
        return "1";
    }

    public function inquiryformdata(Request $request) {
        $AllData = $request->all();
        $name = $request->input('varName');
        $domain = $request->input('dname');
        $messsages = array(
            'varName.required' => 'Name is required.',
            'varEmail.required' => 'Email is required.',
            'varEmail.email' => 'Email is not valid.',
            'varEmail.handle_xss' => 'Please enter valid input.',
            'varPhone.required' => 'Phone is required.'
        );
        $rules = [
            'varName' => 'required',
            'varEmail' => 'required|email',
            'varPhone' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->passes()) {
            $ip_address = \Request::ip();
            $date = date('Y-m-d H:i:s');
            $Email = MyLibrary::encrypt_decrypt('encrypt', $request->input('varEmail'));
            $Phone = MyLibrary::encrypt_decrypt('encrypt', $request->input('varPhone'));
            $Message = $request->input('varMessage');
            $data = array('varName' => $name, 'varDomain' => $domain, "varEmail" => $Email, "varPhone" => $Phone, "varMessage" => $Message, "varIP" => $ip_address, "datetime" => $date);
            $insert_data = ProductCategory::insertenquirydata($data);
            Email_sender::DomainInquiry($AllData);
            return redirect('thankyou')->with(['form_submit' => true, 'message' => 'Thank you for contacting us, We will get back to you shortly.']);
        } else {
            return redirect('/');
        }
    }

    public function gettldpricing(Request $request) {  // for domain transfer 
        $params = [];
        $params['currency'] = $request->currency;
        $params['domain_type'] = "domaintransfer";
        $params['tld'] = $request->tld;
//        $pricingDetails = ProductCategory::GetDomainPricing($request->currency, $request->tlds, $type = 'domaintransfer');
        $pricingDetails = ProductCategory::GetTldData($params);
        echo $pricingDetails[0]->Price1;
        exit;
    }

    public function removeallcart(Request $request) {
        if (isset($request->ele_key)) {
            $Remove_key = explode(",", $request->ele_key);
            foreach ($Remove_key as $value) {
                if ($request->session()->has('cart.' . $value))
                    $request->session()->pull('cart.' . $value);
            }
            return "1";
        }
    }

}
