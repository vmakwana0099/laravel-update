<?php

namespace App\Http\Controllers;

use App\Products;
use App\CmsPage;
use App\ProductCategory;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Http\Traits\slug;
use App\Tld;
use App\ContactInfo;
use App\Banner;
use Config;
use DB;
use App\Cart;


class ProductsController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->currency = Config::get('Constant.sys_currency');

        if ($this->currency == 'INR') {
            $this->currency_code = "1";
        } else {
            $this->currency_code = "2";
        }
    }

    public function index($product_category, $product) {
         
        $cataliasId = slug::resolve_alias_for_routes($product_category);
        $aliasId = slug::resolve_alias_for_routes($product);
        $ProCatId = Products::getProductCatId($cataliasId);
        $ProId = Products::getProductId($aliasId, $ProCatId->id);
        $TLDId = Products::getTLDId($aliasId);
        
        
        if (isset($ProId->id)) {
            if ($ProId->id == 14 && empty($TLDId->id)) {
                $trasfer_data = self::domaintransfer($ProId->id);
                $MetaData = MyLibrary::getMetaDetails($ProId->id, 'products');
                $trasfer_data['ProductId'] = $ProId->id;
                $trasfer_data['META_TITLE'] = $MetaData->varMetaTitle;
                $trasfer_data['META_KEYWORD'] = $MetaData->varMetaKeyword;
                $trasfer_data['META_DESCRIPTION'] = $MetaData->varMetaDescription;
                $trasfer_data['PageHits'] = Products::PageHits($ProId->id);
                $trasfer_data['FaqData'] = Products::getFaqRecords($ProId->id);
                $trasfer_data['bannerData'] = Banner::getHomeBannerList($ProId->id);
                return view("domaintransfer", $trasfer_data);
            }
            if ($ProId->id == 16 && empty($TLDId->id)) {
                
                $bulk_data = self::bulksearch();
                $MetaData = MyLibrary::getMetaDetails($ProId->id, 'products');
                $data_array['ProductId'] = $ProId->id;
                $data_array['META_TITLE'] = $MetaData->varMetaTitle;
                $data_array['META_KEYWORD'] = $MetaData->varMetaKeyword;
                $data_array['META_DESCRIPTION'] = $MetaData->varMetaDescription;
                $data_array['PageHits'] = Products::PageHits($ProId->id);
                $data_array["ProductBanner"] = Products::getProductBanner($ProId->id);
                $data_array['bannerData'] = Banner::getHomeBannerList($ProId->id);
                $data_array['FaqData'] = Products::getFaqRecords($ProId->id);
                $data_array["tldcatdata"] = $bulk_data;
                $data_array['PageHits'] = Products::PageHits($ProId->id);
                return view("bulksearch", $data_array);
            }
        }
        if (!empty($ProId)) {
            if ($ProId->id == 9) {
                return redirect('hosting/windows-reseller-hosting');
            } if ($ProId->id == 3) {
                return redirect('hosting/windows-hosting');
            }
            $ProductData = [];
            $MetaData = MyLibrary::getMetaDetails($ProId->id, 'products');
            $ProductData['ProductId'] = $ProId->id;
            if ($ProId->id == 27) {
            $ProductData["ProductBanner"] = Products::getProductBanner(1);
           }
           else{
           $ProductData["ProductBanner"] = Products::getProductBanner($ProId->id);
           }
            // $ProductData["ProductBanner"] = Products::getProductBanner($ProId->id);
            $ProductData['bannerData'] = Banner::getHomeBannerList($ProId->id);
            $ProductData['FeaturesData'] = Products::getFeaturesRecords($ProId->id);
            $ProductData['FaqData'] = Products::getFaqRecords($ProId->id);
            $ProductData['testimonialData'] = CmsPage::getHomeTestimonials();
            $ProductData['FeaturedProductsData'] = Products::getFeaturedProductsRecords($ProId->id);
            $ProductData['ProductsPackageData'] = Products::getProductsPackageRecords($ProId->id);
            $ProductData['PageHits'] = Products::PageHits($ProId->id);
            $ProductData['META_TITLE'] = $MetaData->varMetaTitle;
            $ProductData['META_KEYWORD'] = $MetaData->varMetaKeyword;
            $ProductData['META_DESCRIPTION'] = $MetaData->varMetaDescription;
            if ($ProId->id == "8") {
                $protext = "dedicatedserver";
            } else if ($ProId->id == "7") {
                $protext = "vps";
            } else if ($ProId->id == "6" || $ProId->id == "4" || $ProId->id == "12" || $ProId->id == "9" || $ProId->id == "2" || $ProId->id == "1" || $ProId->id == "13" || $ProId->id == "15" || $ProId->id == "20" || $ProId->id == "27" || $ProId->id == "29" || $ProId->id == "30") {
                $protext = "hosting";
            }
            else if($ProId->id == "23"){
                $protext = "vps"; //For Linux VPS Hosting
            } 
            else if($ProId->id == "24" || $ProId->id == "25"){
                $protext = "vps"; //For Windows VPS Hosting
            }
            else if($ProId->id == "26"){
                $protext = "vps"; //For Forex VPS Hosting
            }
            else if($ProId->id == "28"){
                $protext = "vps"; //For Managed VPS Hosting
            }
            else if($ProId->id == "32"){
                $protext = "vps"; //For VPS Hosting India
            }
            else if($ProId->id == "21"){
                $protext = "email"; //For Google Apps
            }
            else if($ProId->id == "22"){
                $protext = "email"; //For office 365
            }
            else if ($ProId->id == "10") {
                $protext = "ssl";
            }
            else if ($ProId->id == "27") { //website builder

                $protext = "hosting"; 
            }
            
            else if ($ProId->id == "29") { //web hosting

                $protext = "hosting"; 
            }
            else if ($ProId->id == "30") { //web hosting ahm

                $protext = "hosting"; 
            }
             else {
                $protext = "";
            }

            if ($ProId->id == "8" || $ProId->id == "25" || $ProId->id == "24" || $ProId->id == "23" || $ProId->id == "7" || $ProId->id == "26" || $ProId->id == "28" || $ProId->id == "29" || $ProId->id == "30" || $ProId->id == "21" || $ProId->id == "32" ) {
                $yearsArr = ["monthly","quarterly","semi-annually","annually","biennially","triennially"]; 
                $i=0;
                foreach ($ProductData['ProductsPackageData'] as $pkey => $pval){
                    $paramsPriceArr['productid'] = $pval->fkWhmcsProduct;
                    $paramsPriceArr['currencycode'] = Config::get('Constant.sys_currency');
                    // echo '<pre>';print_r($paramsPriceArr);exit;break;
                    $pval->productpricing = Cart::getProductPricing($paramsPriceArr);
                    /*echo '<pre>';print_r($pval->productpricing);exit;break;*/
                    $divideVal = 1;
                    // dd($pval->productpricing);
                    foreach ($pval->productpricing as $priskey => $prisval) {

                        if ($priskey == 'monthly' || $priskey == 'quarterly' || $priskey == 'semiannually' || $priskey == 'annually' || $priskey == 'biennially' || $priskey == 'triennially') {
                            if ($priskey == 'monthly') {
                                $divideVal=1;
                            }elseif ($priskey == 'quarterly') {
                                $divideVal=3;
                            }elseif ($priskey == 'semiannually') {
                                $divideVal=6;
                            }elseif ($priskey == 'annually') {
                                $divideVal=12;
                            }elseif ($priskey == 'biennially') {
                                $divideVal=24;
                            }elseif ($priskey == 'triennially') {
                                $divideVal=36;
                            }
                            /*$pval->productpricing[$priskey] = ((($prisval) / $divideVal) > 0) ? round((($prisval) / $divideVal) , 2) :"";*/
                            $pval->productpricing[$priskey] = ((($prisval) / $divideVal) > 0) ? round((($prisval) / $divideVal) , 2) :"";
                            $pval->{"ButtonText".$priskey} = Products::productFormDisplay($pval->fkWhmcsProduct, $protext, $priskey, url('/') . "/cart/store", 'post', $i,$aliasId,$pval->varTitle);
                             $i++;
                        }
                    }
                }
            }else{
                $ProductData['StarterMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '1',$aliasId,'',$ProId->id);
                $ProductData['PerformanceMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '2',$aliasId,'',$ProId->id);
                $ProductData['BusinessMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '3',$aliasId,'',$ProId->id);
                if (isset($ProductData['ProductsPackageData']['3']) && !empty($ProductData['ProductsPackageData']['3'])) {
                    $ProductData['EnterpriseMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'monthly', url('/') . "/cart/store", 'post', '4',$aliasId,'',$ProId->id);
                }

                $ProductData['StarterThreeMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'quarterly', url('/') . "/cart/store", 'post', '5',$aliasId,'',$ProId->id);
                $ProductData['PerformanceThreeMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'quarterly', url('/') . "/cart/store", 'post', '6',$aliasId,'',$ProId->id);
                $ProductData['BusinessThreeMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'quarterly', url('/') . "/cart/store", 'post', '7',$aliasId,'',$ProId->id);
                if (isset($ProductData['ProductsPackageData']['3']) && !empty($ProductData['ProductsPackageData']['3'])) {
                    $ProductData['EnterpriseThreeMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'quarterly', url('/') . "/cart/store", 'post', '8',$aliasId,'',$ProId->id);
                }

                $ProductData['StarterSixMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'semi-annually', url('/') . "/cart/store", 'post', '9',$aliasId,'',$ProId->id);
                $ProductData['PerformanceSixMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'semi-annually', url('/') . "/cart/store", 'post', '10',$aliasId,'',$ProId->id);
                $ProductData['BusinessSixMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'semi-annually', url('/') . "/cart/store", 'post', '11',$aliasId,'',$ProId->id);
                if (isset($ProductData['ProductsPackageData']['3']) && !empty($ProductData['ProductsPackageData']['3'])) {
                    $ProductData['EnterpriseSixMonthlyButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'semi-annually', url('/') . "/cart/store", 'post', '12',$aliasId,'',$ProId->id);
                }

                $ProductData['StarterOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '13',$aliasId,'',$ProId->id);
                $ProductData['PerformanceOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '14',$aliasId,'',$ProId->id);
                $ProductData['BusinessOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '15',$aliasId,'',$ProId->id);
                if (isset($ProductData['ProductsPackageData']['3']) && !empty($ProductData['ProductsPackageData']['3'])) {
                    $ProductData['EnterpriseOneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '16',$aliasId,'',$ProId->id);
                }
                if(isset($ProductData['ProductsPackageData']['4']) && !empty($ProductData['ProductsPackageData']['4'])){
                    $ProductData['Enterprise1OneYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['4']->fkWhmcsProduct, $protext, 'annually', url('/') . "/cart/store", 'post', '25',$aliasId,'',$ProId->id);
                }

                $ProductData['StarterTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '17',$aliasId,'',$ProId->id);
                $ProductData['PerformanceTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '18',$aliasId,'',$ProId->id);
                $ProductData['BusinessTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '19',$aliasId,'',$ProId->id);
                if (isset($ProductData['ProductsPackageData']['3']) && !empty($ProductData['ProductsPackageData']['3'])) {
                    $ProductData['EnterpriseTwoYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'biennially', url('/') . "/cart/store", 'post', '20',$aliasId,'',$ProId->id);
                }

                $ProductData['StarterThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['0']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '21',$aliasId,'',$ProId->id);
                $ProductData['PerformanceThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['1']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '22',$aliasId,'',$ProId->id);
                $ProductData['BusinessThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['2']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '23',$aliasId,'',$ProId->id);
                if (isset($ProductData['ProductsPackageData']['3']) && !empty($ProductData['ProductsPackageData']['3'])) {
                    $ProductData['EnterpriseThreeYearButtonText'] = Products::productFormDisplay($ProductData['ProductsPackageData']['3']->fkWhmcsProduct, $protext, 'triennially', url('/') . "/cart/store", 'post', '24',$aliasId,'',$ProId->id);
                }
            }
            if ($ProId->id == "26") { //for forex vps product
                return view("forexvpshosting" ,$ProductData);
            }
            if ($ProId->id == "8") { //for dedicated server product
                return view("dedicatedserverproduct", $ProductData);
            }
            else if ($ProId->id == "7") { //for vps product
                return view("vpsproduct", $ProductData);
            }
            else if ($ProId->id == "28") { //for Managed vps product
                return view("managed-vps-hosting", $ProductData);
            }
            else if ($ProId->id == "25") { //for vps product
                // echo '<pre>';print_r($ProductData['ProductsPackageData']);exit;
                return view("economy-vps", $ProductData);
            }
            else if ($ProId->id == "23") { //for linux vps hosting product
                return view("linuxvpshosting", $ProductData);
            }
            else if ($ProId->id == "32") { //for linux vps hosting India
                // echo "<pre>";print_r($ProductData);exit;
                return view("vps-product-india", $ProductData);
                // return view("vpsproduct", $ProductData);
            }
             else if ($ProId->id == "24") { //for windows vps hosting product
                return view("windowsvpshosting", $ProductData);
            }
            else if ($ProId->id == "20") { //for sitelock product
                return view("sitelockproduct", $ProductData);
            }
            else if ($ProId->id == "21") { //for Google-apps product
                // return view("google-apps-product", $ProductData);
                return view("google-apps-products",['ProductData' => $ProductData]);
            }
            else if ($ProId->id == "22") { //for Office 365

                return view("office365-product", $ProductData);
            }
            else if ($ProId->id == "15") { //for Linux Reseller Hosting

                return view("reseller_product", $ProductData);
            }
            else if ($ProId->id == "27") { //website builder
                return view("website-builder", $ProductData);
            }
            else if ($ProId->id == "29") { //web hosting
                return view("web-hosting", $ProductData);

            }
            else if ($ProId->id == "30") { //web hosting Ahm
                return view("web-hosting-ahmedabad", $ProductData);

            }
            else if ($ProId->id == "4") { //web hosting Ahm
                return view("wordpress", $ProductData);

            }elseif($ProId->id == "1"){
                return view("product_linux", $ProductData);
            }
            else {
                return view("product", $ProductData);   
            }
        } else if (!empty($TLDId)) {
            $contacts = ContactInfo::getContactDetails();
            $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
            $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
            $MetaDataTLD = MyLibrary::getMetaDetails($TLDId->id, 'tld');
            $TLDData['PageHits'] = Tld::PageHitsTLD($TLDId->id);
            $META_TITLE = $MetaDataTLD->varMetaTitle;
            $META_KEYWORD = $MetaDataTLD->varMetaKeyword;
            $META_DESCRIPTION = $MetaDataTLD->varMetaDescription;
            $tld = Tld::getFrontDetail($TLDId->id);
            $tldPrice = Tld::getPriceDetail($TLDId->id);
            $Price = array();
            foreach ($tldPrice as $price) {
                $Price[$price->currency] = $price->Price1;
            }
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
            $Tldarray = $Data["Tlds"];
            $FeaturedDetail = Tld::getTLDFeaturedDetail();
            return view('tld-detail', compact('tld', 'TLDData', 'META_KEYWORD', 'META_TITLE', 'META_DESCRIPTION', 'PhoneNumner', 'EmailId', 'Price', 'FeaturedDetail', 'Tldarray'));
        } else {
            abort(404);
        }
    }

    public function domaintransfer($id) {

        $params = [];
        $params['currency'] = Config::get('Constant.sys_currency');
        $params['domain_type'] = "domaintransfer";

        $domainPricing = ProductCategory::GetTldData($params);
        $array = [];
        foreach ($domainPricing as $value) {
            $array[$value->varTitle] = $value->Price1;
        }
        $jason = json_encode($array);

        $params1 = [];
        $params1['currency'] = Config::get('Constant.sys_currency');
        $params1['domain_type'] = "domaintransfer";
        $params1['featured_product'] = "Y";

        $Featured_Tlds = ProductCategory::GetTldData($params1);
        $data_array = array();
        $data_array["tldpricearray"] = $jason;
        $data_array["featured_tlds"] = $Featured_Tlds;
        $data_array["ProductBanner"] = Products::getProductBanner($id);
        return $data_array;
    }

    /*public function bulksearch() {
        $TldsData = ProductCategory::GetTldCategoryData();
        foreach ($TldsData as $key => $value) {
            $data[$value->category][] = $value->varTitle."*".$value->country;
        }
        return $data;
    }*/
    public function bulksearch() {
        $params = [];
        $params['currency'] = Config::get('Constant.sys_currency');
        $params['domain_type'] = "domainregister";
        $Tld_array = ProductCategory::GetTldData($params);
        $TldsData = ProductCategory::GetTldCategoryData();
        foreach ($TldsData as $key => $value) {
            foreach ($Tld_array as $tld) { 
                $catArr = explode(",",$tld->varCategory);
                if(in_array($value->id, $catArr))
                {  $data[$value->varTitle][] = $tld->varTitle . "*" . $tld->varCountryName;  }
            }
        }
        return $data;
    }

}
