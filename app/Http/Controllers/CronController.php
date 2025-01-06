<?php

namespace App\Http\Controllers;

use App\Cron;
use App\Helpers\MyLibrary;
use App\Http\Traits\slug;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use App\Cart;
use Response;
use App\Testhits;

class CronController extends FrontController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
         
      // //For Domains TLds
   	  //$this->GetWhmcsTldNames();
   	  //$this->GetTldPrice(); 
  	  //$this->GetMegaMenuDomainPrice();
		 
         
      // //For Products
		 //$this->GetProductPricing();
         //$this->GetProductPackagePrice();
         //$this->GetMegaMenuProductPrice();
		   

		  // //Update JS Price
         //$this->writePricingJS_INR();
         //$this->writePricingJS_USD();
		  
         
    }
    public function testcronrun(){
        file_put_contents("cronlogmydata.txt", "\n cron run at:".date("d/m/Y H:i:s"), FILE_APPEND);
    }
    public function GetMegaMenuDomainPrice() {
        $Allresponse = DB::table('tld')
                ->select(['varTitle', 'id'])
                ->where(['varTitle' => 'com'])
                ->first();
        $SelectFiled = DB::table('whmcs_tlds_price')
                ->select(['*'])
                ->where(['fk_tldname' => $Allresponse->id])
                ->get();
        $RegisterPriceINR = $SelectFiled[0]->Price1;
        $RegisterPriceUSD = $SelectFiled[3]->Price1;
        $TransferPriceINR = $SelectFiled[1]->Price1;
        $TransferPriceUSD = $SelectFiled[4]->Price1;
        $DomainArray = array(
            array("inr" => $RegisterPriceINR, "usd" => $RegisterPriceUSD, "field" => "MEGAMENU_REGISTER_PRICE"),
            array("inr" => $TransferPriceINR, "usd" => $TransferPriceUSD, "field" => "MEGAMENU_TRANSFER_PRICE"),
            array("inr" => $RegisterPriceINR, "usd" => $RegisterPriceUSD, "field" => "MEGAMENU_BULK_DOMAIN_SEARCH_PRICE"),
            array("inr" => $RegisterPriceINR, "usd" => $RegisterPriceUSD, "field" => "MEGAMENU_PRICING_PRICE"),
            array("inr" => $RegisterPriceINR, "usd" => $RegisterPriceUSD, "field" => "MEGAMENU_PRIVACY_PRICE"),
            array("inr" => $RegisterPriceINR, "usd" => $RegisterPriceUSD, "field" => "MEGAMENU_NEW_DOMAIN_EXTENSIONS_PRICE"),
            array("inr" => $RegisterPriceINR, "usd" => $RegisterPriceUSD, "field" => "MEGAMENU_WHOIS_PRICE"),
            array("inr" => $RegisterPriceINR, "usd" => $RegisterPriceUSD, "field" => "MEGAMENU_DEALS_PRICE"),
        );
        foreach ($DomainArray as $Value) {
            DB::table('whmcs_prices')
                    ->where('fieldName', $Value['field'])
                    ->update(['INR' => $Value['inr'], 'USD' => $Value['usd'],'INR_WRONG' => ($Value['inr'] * 2), 'USD_WRONG' => ($Value['usd'] * 2)]);
        }
    }

    public function GetMegaMenuProductPrice() {
        //Lowest price product id
        $array = array(
             array("id" => "179", "duration" => "triennially", "months" => "36", "varname" => "MEGAMENU_LINUX_HOSTING_PRICE"),
            // array("id" => "186", "duration" => "triennially", "months" => "36", "varname" => "MEGAMENU_WINDOWS_HOSTING_PRICE"),
             array("id" => "155", "duration" => "triennially", "months" => "36", "varname" => "MEGAMENU_WORDPRESS_PRICE"),
            // array("id" => "176", "duration" => "triennially", "months" => "36", "varname" => "MEGAMENU_LINUX_RESELLER_PRICE"),
            // array("id" => "183", "duration" => "semiannually", "months" => "6", "varname" => "MEGAMENU_DEDICATED_SERVERS_PRICE"),
            // array("id" => "154", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_VPS_HOSTING_PRICE"),
             array("id" => "158", "duration" => "triennially", "months" => "36", "varname" => "MEGAMENU_JAVA_PRICE"),
             array("id" => "161", "duration" => "triennially", "months" => "36", "varname" => "MEGAMENU_ECOMMERCE_PRICE"),
            // array("id" => "192", "duration" => "triennially", "months" => "36", "varname" => "MEGAMENU_WINDOWS_RESELLER_PRICE"),
             array("id" => "179", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_HOSTING_DEALS_PRICE"),
            // array("id" => "183", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_SERVERS_DEALS_PRICE"),
            // array("id" => "117", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_GOOGLEAPP_EMAIL_PRICE"),
            // array("id" => "169", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_SITELOCK_HOSTING_PRICE"),
            // array("id" => "154", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_VPSSTARTER_OFFER_PRICE"),
            // array("id" => "164", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_VPSPERFORMACNCE_OFFER_PRICE"),
            // array("id" => "154", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_VPS_HOSTING_OFFER_SIDE_PRICE"),
            // array("id" => "207", "duration" => "annually", "months" => "12", "varname" => "MEGAMENU_OFFICE365_EMAIL_PRICE"),
            
            
            
        );
        foreach ($array as $key => $value) {
            $INRMinPrice = "";
            $USDMinPrice = "";
            $ProductPricing = array('productid' => $value['id']);
            $jsonData = MyLibrary::laravelcallapiOld("getproductpricing", $ProductPricing);
            //echo "1: ".$value . " " .$key."</br>";
            
            $INRMinPrice = $USDMinPrice = 0;
            if(isset($jsonData['INR']['monthly']) && $jsonData['INR']['monthly'] > 0)
              { $INRMinPrice = round($jsonData['INR']['monthly'] / 1, 2); }
            else if(isset($jsonData['INR']['quarterly']) && $jsonData['INR']['quarterly'] > 0)
              { $INRMinPrice = round($jsonData['INR']['quarterly'] / 3, 2); }
            else if(isset($jsonData['INR']['semiannually']) && $jsonData['INR']['semiannually'] > 0)
              { $INRMinPrice = round($jsonData['INR']['semiannually'] / 6, 2); }
            else if(isset($jsonData['INR']['annually']) && $jsonData['INR']['annually'] > 0)
              { $INRMinPrice = round($jsonData['INR']['annually'] / 12, 2); }
            else if(isset($jsonData['INR']['biennially']) && $jsonData['INR']['biennially'] > 0)
              { $INRMinPrice = round($jsonData['INR']['biennially'] / 24, 2); }            
            else if(isset($jsonData['INR']['triennially']) && $jsonData['INR']['triennially'] > 0)
              { $INRMinPrice = round($jsonData['INR']['triennially'] / 36, 2); }       

              //if specific month provided so set that price  
            if(isset($value['duration']) && isset($jsonData['INR'][$value['duration']]) && $jsonData['INR'][$value['duration']] > 0)
                { $INRMinPrice = round($jsonData['INR'][$value['duration']] / $value['months'], 2);  }               
             
              DB::table('whmcs_prices')
                    ->where('fieldName', $value['varname'])
                    ->update(['INR' => $INRMinPrice, 'INR_WRONG' => ($INRMinPrice * 2)]);
              //echo "1: ".$value['id'] . " " .$value['txt']. " ". $INRMinPrice."</br>";      
            
            if(isset($jsonData['USD']['monthly']) && $jsonData['USD']['monthly'] > 0)
              { $USDMinPrice = round($jsonData['USD']['monthly'] / 1, 2); }
            else if(isset($jsonData['USD']['quarterly']) && $jsonData['USD']['quarterly'] > 0)
              { $USDMinPrice = round($jsonData['USD']['quarterly'] / 3, 2); }
            else if(isset($jsonData['USD']['semiannually']) && $jsonData['USD']['semiannually'] > 0)
              { $USDMinPrice = round($jsonData['USD']['semiannually'] / 6, 2); }
            else if(isset($jsonData['USD']['annually']) && $jsonData['USD']['annually'] > 0)
              { $USDMinPrice = round($jsonData['USD']['annually'] / 12, 2); }
            else if(isset($jsonData['USD']['biennially']) && $jsonData['USD']['biennially'] > 0)
              { $USDMinPrice = round($jsonData['USD']['biennially'] / 24, 2); }            
            else if(isset($jsonData['USD']['triennially']) && $jsonData['USD']['triennially'] > 0)
              { $USDMinPrice = round($jsonData['USD']['triennially'] / 36, 2); }            

            //if specific month provided so set that price
          if(isset($value['duration']) && isset($jsonData['USD'][$value['duration']]) && $jsonData['USD'][$value['duration']] > 0)
                { $USDMinPrice = round($jsonData['USD'][$value['duration']] / $value['months'], 2);  }

                DB::table('whmcs_prices')
                    ->where('fieldName', $value['varname'])
                    ->update(['USD' => $USDMinPrice,'USD_WRONG' => ($USDMinPrice * 2)]);
            
        }
    }
    public function GetProductPricing() {
        //Lowest price product id
    $array = array(
      array("id" => "179", "duration" => "triennially", "months" => "36","varname" => "PRODUCT_LINUX_HOSTING_PRICE"),
     // array("id" => "186", "duration" => "triennially", "months" => "36","varname" => "PRODUCT_WINDOWS_HOSTING_PRICE"),
     // array("id" => "176", "duration" => "triennially", "months" => "36","varname" => "PRODUCT_RESELLER_HOSTING_PRICE"),
     // array("id" => "176", "duration" => "triennially", "months" => "36","varname" => "PRODUCT_LINUX_RESELLER_HOSTING_PRICE"),
     // array("id" => "192", "duration" => "triennially", "months" => "36","varname" => "PRODUCT_WINDOWS_RESELLER_HOSTING_PRICE"),
     // array("id" => "195",  "duration" => "annually", "months" => "12","varname"    => "PRODUCT_DOMAIN_VALIDATION_SSL_PRICE"),
     // array("id" => "154", "duration" => "annually", "months" => "12","varname"    => "PRODUCT_VPS_HOSTING_PRICE"),
     // array("id" => "183", "duration" => "semiannually", "months" => "6","varname" => "PRODUCT_DEDICATED_SERVERS_PRICE"),
      array("id" => "155", "duration" => "triennially", "months" => "36","varname" => "PRODUCT_WORDPRESS_HOSTING_PRICE"),
      array("id" => "158", "duration" => "triennially", "months" => "36","varname" => "PRODUCT_JAVA_HOSTING_PRICE"),
      array("id" => "161", "duration" => "triennially", "months" => "36","varname" => "PRODUCT_ECOMMERCE_HOSTING_PRICE"),
     // array("id" => "117", "duration" => "annually", "months" => "12","varname" => "PRODUCT_GOOGLEAPP_EMAIL_PRICE"),
     // array("id" => "169", "duration" => "annually", "months" => "12","varname" => "PRODUCT_SITELOCK_HOSTING_PRICE"),
     // array("id" => "207", "duration" => "annually", "months" => "12","varname" => "PRODUCT_OFFICE365_EMAIL_PRICE")
        );

        foreach ($array as $key => $value) {
            $INRMinPrice = "";
            $USDMinPrice = "";
            $ProductPricing = array('productid' => $value['id']);
            $jsonData = MyLibrary::laravelcallapiOld("getproductpricing", $ProductPricing);
            
            //echo '<pre>';print_r($jsonData);exit;
              if(isset($jsonData['INR']['monthly']) && $jsonData['INR']['monthly'] > 0)
              { $INRMinPrice = round($jsonData['INR']['monthly'] / 1, 2); }
            else if(isset($jsonData['INR']['quarterly']) && $jsonData['INR']['quarterly'] > 0)
              { $INRMinPrice = round($jsonData['INR']['quarterly'] / 3, 2); }
            else if(isset($jsonData['INR']['semiannually']) && $jsonData['INR']['semiannually'] > 0)
              { $INRMinPrice = round($jsonData['INR']['semiannually'] / 6, 2); }
            else if(isset($jsonData['INR']['annually']) && $jsonData['INR']['annually'] > 0)
              { $INRMinPrice = round($jsonData['INR']['annually'] / 12, 2); }
            else if(isset($jsonData['INR']['biennially']) && $jsonData['INR']['biennially'] > 0)
              { $INRMinPrice = round($jsonData['INR']['biennially'] / 24, 2); }            
            else if(isset($jsonData['INR']['triennially']) && $jsonData['INR']['triennially'] > 0)
              { $INRMinPrice = round($jsonData['INR']['triennially'] / 36, 2); }        
          
            //if specific month provided so set that price  
            if(isset($value['duration']) && isset($jsonData['INR'][$value['duration']]) && $jsonData['INR'][$value['duration']] > 0)
                { $INRMinPrice = round($jsonData['INR'][$value['duration']] / $value['months'], 2);  }
               
            
            DB::table('whmcs_prices')
                    ->where('fieldName', $value['varname'])
                    ->update(['INR' => $INRMinPrice]);
           

            if(isset($jsonData['USD']['monthly']) && $jsonData['USD']['monthly'] > 0)
              { $USDMinPrice = round($jsonData['USD']['monthly'] / 1, 2); }
            else if(isset($jsonData['USD']['quarterly']) && $jsonData['USD']['quarterly'] > 0)
              { $USDMinPrice = round($jsonData['USD']['quarterly'] / 3, 2); }
            else if(isset($jsonData['USD']['semiannually']) && $jsonData['USD']['semiannually'] > 0)
              { $USDMinPrice = round($jsonData['USD']['semiannually'] / 6, 2); }
            else if(isset($jsonData['USD']['annually']) && $jsonData['USD']['annually'] > 0)
              { $USDMinPrice = round($jsonData['USD']['annually'] / 12, 2); }
            else if(isset($jsonData['USD']['biennially']) && $jsonData['USD']['biennially'] > 0)
              { $USDMinPrice = round($jsonData['USD']['biennially'] / 24, 2); }            
            else if(isset($jsonData['USD']['triennially']) && $jsonData['USD']['triennially'] > 0)
              { $USDMinPrice = round($jsonData['USD']['triennially'] / 36, 2); } 

          //if specific month provided so set that price
          if(isset($value['duration']) && isset($jsonData['USD'][$value['duration']]) && $jsonData['USD'][$value['duration']] > 0)
                { $USDMinPrice = round($jsonData['USD'][$value['duration']] / $value['months'], 2);  }

            
            DB::table('whmcs_prices')
                    ->where('fieldName', $value['varname'])
                    ->update(['USD' => $USDMinPrice]);
            
        }
    }
    public function GetTldPrice() {
        $Allresponse = DB::table('tld')
                ->select(['varTitle', 'id'])
                ->get();

        foreach ($Allresponse as $key => $value) {
            $field_name = strtoupper("TLD_" . $value->varTitle . "_PRICE");
            $SelectFiled = DB::table('whmcs_prices')
                    ->select(['fieldName'])
                    ->where(['fieldName' => $field_name])
                    ->first();
            $INRTLDPrice = "";
            $USDTLDPrice = "";
            $TldData = array('tlds' => "." . $value->varTitle, 'type' => 'domainregister');
            $jsonData = MyLibrary::laravelcallapiOld("gettldspricing", $TldData);
            $INRTLDPrice = $jsonData[$value->varTitle][0]['msetupfee'];
            $USDTLDPrice = $jsonData[$value->varTitle][1]['msetupfee'];
            if (empty($SelectFiled->fieldName)) {
                $pid = DB::table('whmcs_prices')->insertGetId(
                        ['fieldName' => $field_name, 'INR' => $INRTLDPrice, 'USD' => $USDTLDPrice, 'INR_WRONG' => ($INRTLDPrice * 2),'USD_WRONG' =>  ($USDTLDPrice * 2), 'Comment' => 'This INR/USD Price Showing for ' . strtoupper($value->varTitle) . ' (TLD Min Price).']
                );
            } else {
                $Update = DB::table('whmcs_prices')
                        ->where('fieldName', $field_name)
                        ->update(['INR' => $INRTLDPrice, 'USD' => $USDTLDPrice,'INR_WRONG' => ($INRTLDPrice * 2), 'USD_WRONG' => ($USDTLDPrice * 2)]);
            }
        }
    }

    public function GetWhmcsTldNames() {
        $HostingParam = array();
        $tldsArr = MyLibrary::laravelcallapiOld("gettldspricing", $HostingParam);
        //echo '<pre>';print_r($tldsArr);exit;
        //echo "Count: ".count($tldsArr);exit;
        $Allresponse = DB::table('tld')
                ->select(['varTitle', 'id'])
                ->get();

        foreach ($tldsArr as $key => $value) {
            $price = "";
            $response = DB::table('tld')
                    ->select(['varTitle', 'id'])
                    ->where(['varTitle' => $key])
                    ->first();
            if (!empty($response->varTitle)) {
                foreach ($value as $data) {
                    if ($data['currency'] == "1") {
                        $price = "INR";
                    } else {
                        $price = "USD";
                    }
                    $pid = DB::table('whmcs_tlds_price')
                            ->where('fk_tldname', $response->id)
                            ->where('currency', $price)
                            ->where('type', $data['type'])
                            ->update(['fk_tldname' => $response->id, 'type' => $data['type'], 'currency' => $price, 'Price1' => $data['msetupfee'], 'Price2' => $data['qsetupfee'], 'Price3' => $data['ssetupfee'], 'Price4' => $data['asetupfee'], 'Price5' => $data['bsetupfee'], 'Price6' => $data['monthly'], 'Price7' => $data['quarterly'], 'Price8' => $data['semiannually'], 'Price9' => $data['annually'], 'Price10' => $data['biennially']]
                    );
                    
                    //Update Tlds Meta details
                    /*
                    $metaTitle = ".".$key."Domain Registration | Buy Your Domain Name - Host IT Smart";
                    $metaDesc = "Buy ".$key." domain names. Buy one of the most popular domain extensions on the Internet with domain theft protection and 24/7 local support";
                    $Update = DB::table('tld')
                    ->where('id', $response->id)
                    ->update(["varMetaTitle" => $metaTitle, "varMetaDescription" => $metaDesc, "varCategory" => 1, "varCountryName" => "World"]);
                    */
                    //.com 
                    //Buy .com domain names. Buy one of the most popular domain extensions on the Internet with domain theft protection and 24/7 local support.
                    //varCategory = 1 for global
                }
            } else {
                $Allresponse_1 = DB::table('tld')
                        ->select("*")
                        ->max('intDisplayOrder');

                $Alias = DB::table('alias')->insertGetId(
                        ['varAlias' => "buy-" . $key . "-domain-names", 'intFkModuleCode' => '53']
                );

                $DisplayOrder = $Allresponse_1 + 1;

                $metaTitle = ".".$key."Domain Registration | Buy Your Domain Name - Host IT Smart";
                $metaDesc = "Buy ".$key." domain names. Buy one of the most popular domain extensions on the Internet with domain theft protection and 24/7 local support";
                    
                $id = DB::table('tld')->insertGetId(
                        ['varTitle' => $key, 'intAliasId' => $Alias, 'intDisplayOrder' => $DisplayOrder, 'varWHMCSFieldName' => strtoupper("TLD_" . $key . "_PRICE"),"varMetaTitle" => $metaTitle, "varMetaDescription" => $metaDesc, "varCategory" => 1, "varCountryName" => "World"]
                );
                foreach ($value as $data) {
                    if ($data['currency'] == "1") {
                        $price = "INR";
                    } else {
                        $price = "USD";
                    }
                    $pid = DB::table('whmcs_tlds_price')->insertGetId(
                            ['fk_tldname' => $id, 'type' => $data['type'], 'currency' => $price, 'Price1' => $data['msetupfee'], 'Price2' => $data['qsetupfee'], 'Price3' => $data['ssetupfee'], 'Price4' => $data['asetupfee'], 'Price5' => $data['bsetupfee'], 'Price6' => $data['monthly'], 'Price7' => $data['quarterly'], 'Price8' => $data['semiannually'], 'Price9' => $data['annually'], 'Price10' => $data['biennially']]
                    );
                }
            }
            $Tlds[] = $key;
        }
        $array2['name'] = array();
        $array2['id'] = array();
        foreach ($Allresponse as $key => $res) {
            $array2['name'][] = $res->varTitle;
            $array2['id'][] = $res->id;
        }

        $notIn2 = array_diff($array2['name'], $Tlds);
        foreach ($notIn2 as $key => $row) {
            $rowid = $array2['id'][$key];
            $Update = DB::table('tld')
                    ->where('id', $rowid)
                    ->update(['chrDelete' => "Y", 'chrPublish' => "N", 'intDisplayOrder' => "0"]);
//            $delete = DB::table('tld')->where('id', $rowid)->delete();
            $delete = DB::table('whmcs_tlds_price')->where('fk_tldname', $rowid)->delete();
        }
    }
    public function AllProductsIds(){
        // //Linux Hosting
        //  $masterArr['LINUX_HOSTING']['STARTER'] = 179; //Starter
        //  $masterArr['LINUX_HOSTING']['PERFORMANCE'] = 180; //Performace
        //  $masterArr['LINUX_HOSTING']['BUSINEESS'] = 181; //Business

        // //Windows Hosting
        //  $masterArr['WINDOWS_HOSTING']['STARTER'] = 186; //Starter
        //  $masterArr['WINDOWS_HOSTING']['PERFORMANCE'] = 187; //Performance
        //  $masterArr['WINDOWS_HOSTING']['BUSINEESS'] = 188; //Business

        // //WordPress Hosting
        //  $masterArr['WORDPRESS_HOSTING']['STARTER'] = 155; //Starter
        //  $masterArr['WORDPRESS_HOSTING']['PERFORMANCE'] = 156; //Performance
        //  $masterArr['WORDPRESS_HOSTING']['BUSINEESS'] = 157; //Business

        // //JAVA Hosting
        //  $masterArr['JAVA_HOSTING']['STARTER'] = 158; //Starter
        //  $masterArr['JAVA_HOSTING']['PERFORMANCE'] = 159; //Performance
        //  $masterArr['JAVA_HOSTING']['BUSINEESS'] = 160; //Business

        //  //E-Commerce Hosting
        //  $masterArr['ECOMMERCE_HOSTING']['STARTER'] = 161; //Starter
        //  $masterArr['ECOMMERCE_HOSTING']['PERFORMANCE'] = 162; //Performance
        //  $masterArr['ECOMMERCE_HOSTING']['BUSINEESS'] = 163; //Business

        //  // Site Lock
        //  $masterArr['SITELOCK_HOSTING']['STARTER'] = 169; //Starter
        //  $masterArr['SITELOCK_HOSTING']['PERFORMANCE'] = 170; //Performance
        //  $masterArr['SITELOCK_HOSTING']['BUSINEESS'] = 171; //Business

        //   //Linux Reseller Hosting
        //  $masterArr['LINUX_RESELLER_HOSTING']['STARTER'] = 176; //Starter
        //  $masterArr['LINUX_RESELLER_HOSTING']['PERFORMANCE'] = 177; //Performace
        //  $masterArr['LINUX_RESELLER_HOSTING']['BUSINEESS'] = 178; //Business

        //  //Windows Reseller Hosting
        //  $masterArr['WINDOWS_RESELLER_HOSTING']['STARTER'] = 192; //Starter
        //  $masterArr['WINDOWS_RESELLER_HOSTING']['PERFORMANCE'] = 174; //Performace
        //  $masterArr['WINDOWS_RESELLER_HOSTING']['BUSINEESS'] = 175; //Business

        // //VPS hosting
        //  $masterArr['VPS_HOSTING']['STARTER'] = 154; //OpenVZ (Hidden)
        //  $masterArr['VPS_HOSTING']['PERFORMANCE'] = 164; //KVM (Hidden)
        //  $masterArr['VPS_HOSTING']['BUSINEESS'] = 190; //Cloud VPS - Virtuzzo(Hidden)

        // //Dedicated Servers
        //  $masterArr['DEDICATED_SERVERS']['STARTER'] = 183; //Starter
        //  $masterArr['DEDICATED_SERVERS']['PERFORMANCE'] = 184; //Performace
        //  $masterArr['DEDICATED_SERVERS']['BUSINEESS'] = 185; //Business

        // // Email Google Apps
        //  $masterArr['GOOGLEAPP_EMAIL']['STARTER'] = 117; //Starter
        //  $masterArr['GOOGLEAPP_EMAIL']['PERFORMANCE'] = 116; //Performance
        //  $masterArr['GOOGLEAPP_EMAIL']['BUSINEESS'] = 206; //Business
        
        // // // Office 365
        //  $masterArr['OFFICE365_EMAIL']['STARTER'] = 207; //Office365 Business Essential
        //  $masterArr['OFFICE365_EMAIL']['PERFORMANCE'] = 209; //Office365 Business Suite
        //  $masterArr['OFFICE365_EMAIL']['BUSINEESS'] = 208; //Office365 Business Premium

        // // //Domain Validation SSL
        // $masterArr['DOMAIN_VALIDATION_SSL']['STARTER'] = 195; //PositiveSSL 
        // $masterArr['DOMAIN_VALIDATION_SSL']['PERFORMANCE'] = 196; //PositiveSSL Wildcard
        // $masterArr['DOMAIN_VALIDATION_SSL']['BUSINEESS'] = 197; //PositiveSSL Multi-Domain

        // // //Organizational Validation SSL
        // $masterArr['ORG_VALIDATION_SSL']['STARTER'] = 198; //PositiveSSL 
        // $masterArr['ORG_VALIDATION_SSL']['PERFORMANCE'] = 199; //PositiveSSL Wildcard
        // $masterArr['ORG_VALIDATION_SSL']['BUSINEESS'] = 200; //PositiveSSL Multi-Domain
        //  return $masterArr;
        $apiUrl = config('app.api_url');
        $dataStr = file_get_contents($apiurl . '/includes/api/getproductsids.php');
        $dataStr = str_replace("[","",$dataStr);
        $dataStr = str_replace("]","",$dataStr);
        $dataArr = explode(",",$dataStr);
        //echo '<pre>Data: ';print_r($dataArr); echo '</pre>';
        return $dataArr;
    }
    public function writePricingJS_INR(){
       $tldparams['currencycode'] = "INR";
       $Tld_array = array();
       $proIds = $this->AllProductsIds();
       //echo '<pre>';print_r($proIds);echo '</pre>';exit;
       if(!empty($proIds)){
          foreach($proIds as $pi){
            $parr[] = trim($pi);
          }
       }
       if(!empty($parr)){
            foreach($parr as $p){
                $tldparams['productid'] = $p;
                $Tld_array[$p] = Cart::getProductPricingTemp($tldparams);     
            }
        }
        $jsonData = json_encode($Tld_array);
        //echo '<pre>';print_r($jsonData);exit;
        file_put_contents('hits_price/pricing'.$tldparams['currencycode'].'.js',$jsonData);
        //echo '<pre>';print_r($Tld_array);
    }
     public function writePricingJS_USD(){
       $tldparams['currencycode'] = "USD";
       $Tld_array = array();
       $proIds = $this->AllProductsIds();
       /*
       if(!empty($proIds)){
          foreach($proIds as $pi){
            foreach($pi as $p){
              $parr[] = $p;
            }
          }
       }
       */
       if(!empty($proIds)){
          foreach($proIds as $pi){
            $parr[] = trim($pi);
          }
       }
       if(!empty($parr)){
            foreach($parr as $p){
                $tldparams['productid'] = $p;
                $Tld_array[$p] = Cart::getProductPricingTemp($tldparams);     
            }
        }
        $jsonData = json_encode($Tld_array);
        //echo '<pre>';print_r($jsonData);exit;
        file_put_contents('hits_price/pricing'.$tldparams['currencycode'].'.js',$jsonData);
        //echo '<pre>';print_r($Tld_array);
    }
    public function GetProductPackagePrice() {
        $masterArr = array();
        //Set whmcs product for pricing
        $masterArr = $this->AllProductsIds();
        

         $wrongpricePercentage = []; //If wrong price is not 50% then add product id and % so it will count as given.
         $wrongpriceSkip = []; //add product id if you wants to skip update wrong price
         //$wrongpricePercentage['179'] = 80;
         //$wrongpricePercentage['183'] = 80;
         //$wrongpricePercentage['184'] = 80;
         //$wrongpricePercentage['185'] = 80;
         //$wrongpriceSkip = [154,164,190,183,184,185,195,196,197];


        $billingcycle = [1 => "monthly", 3 => "quarterly", 6 => "semiannually", 12 => "annually", 24 => "biennially", 36 => "triennially"];
        $proWrongpriceArrINR[1] = 'intOldPriceOneMonthINR';
        $proWrongpriceArrINR[3] = 'intOldPriceThreeMonthINR';
        $proWrongpriceArrINR[6] = 'intOldPriceSixMonthINR';
        $proWrongpriceArrINR[12] = 'intOldPriceOneYearINR';
        $proWrongpriceArrINR[24] = 'intOldPriceTwoYearINR';
        $proWrongpriceArrINR[36] = 'intOldPriceThreeYearINR';
        $proWrongpriceArrUSD[1] = 'intOldPriceOneMonthUSD';
        $proWrongpriceArrUSD[3] = 'intOldPriceThreeMonthUSD';
        $proWrongpriceArrUSD[6] = 'intOldPriceSixMonthUSD';
        $proWrongpriceArrUSD[12] = 'intOldPriceOneYearUSD';
        $proWrongpriceArrUSD[24] = 'intOldPriceTwoYearUSD';
        $proWrongpriceArrUSD[36] = 'intOldPriceThreeYearUSD';
        $proWrongpriceArr = [];
        $updateData = array();
        foreach ($masterArr as $proKey => $val) {
            foreach ($val as $key => $data) {
                $jsonData = MyLibrary::laravelcallapiOld("getproductpricing", array('productid' => $data));
                // echo '<pre>';print_r($jsonData);exit;
                $monthinr = array();
                $monthusd = array();

                foreach ($billingcycle as $i => $yr) {
                    $inr = $jsonData['INR'][$yr] / $i;
                    $usd = $jsonData['USD'][$yr] / $i;
                    $monthinr[$proKey . "_" . $key . "_PRICE_" . $i] = $inr;
                    
                    if ($inr != '0') {
                        if (!empty($monthinr)) {
                            foreach ($billingcycle as $iinr => $yrinr) {
                                if ($iinr < $i) {
                                    if ($monthinr[$proKey . "_" . $key . "_PRICE_" . $iinr] == '0') {
                                        $monthinr[$proKey . "_" . $key . "_PRICE_" . $iinr] = $inr;
                                    }
                                }
                            }
                        }
                    }
                    $monthusd[$proKey . "_" . $key . "_PRICE_" . $i] = $usd;
                    
                    if ($usd != '0') {
                        if (!empty($monthusd)) {
                            foreach ($billingcycle as $iusd => $yrusd) {
                                if ($iusd < $i) {
                                    if ($monthusd[$proKey . "_" . $key . "_PRICE_" . $iusd] == '0') {
                                        $monthusd[$proKey . "_" . $key . "_PRICE_" . $iusd] = $usd;
                                    }
                                }
                            }
                        }
                    }
                }
                
               
                
                

                foreach ($monthinr as $keyinr => $valuesinr) {
                    if($valuesinr <= 0){ $valuesinr = 0; }
                    $inrArr = ['INR' => $valuesinr];
                    if(!in_array($data,$wrongpriceSkip)) { 
                      $pr = 50;
                      if(isset($wrongpricePercentage[$data])) { $pr = $wrongpricePercentage[$data];}
                      $pr2 = 100 - $pr; $wrongINR = (100 * $valuesinr)/$pr2;
                      $inrArr["INR_WRONG"] = $wrongINR;
                      $k1 = explode("_",$keyinr); $i1 = end($k1);
                      $proWrongpriceArr[$proWrongpriceArrINR[$i1]] = round($wrongINR,2);
                    }
                    
                    DB::table('whmcs_prices')
                            ->where('fieldName', $keyinr)
                            ->update($inrArr);
                }

                foreach ($monthusd as $keyusd => $valuesusd) {
                    if($valuesusd <= 0){ $valuesusd = 0; }
                    $usdArr = ['USD' => $valuesusd];
                    if(!in_array($data,$wrongpriceSkip)) { 
                      $pr = 50;
                      if(isset($wrongpricePercentage[$data])) { $pr = $wrongpricePercentage[$data];}
                      $pr2 = 100 - $pr; $wrongUSD = (100 * $valuesusd)/$pr2;
                      $usdArr["USD_WRONG"] = $wrongUSD;
                      $k1 = explode("_",$keyusd); $i1 = end($k1);
                      $proWrongpriceArr[$proWrongpriceArrUSD[$i1]] = round($wrongUSD,2);
                    }

                    DB::table('whmcs_prices')
                            ->where('fieldName', $keyusd)
                            ->update($usdArr);
                }

                 //Update Wrong pricing in Product Package
                //echo '<pre>';print_r($proWrongpriceArr);exit;
                DB::table('products_package')
                            ->where('fkWhmcsProduct', $data)
                            ->update($proWrongpriceArr);
            }
        }
    }
}
