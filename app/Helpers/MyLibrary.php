<?php

namespace App\Helpers;

use App\Alias;
use App\CmsPage;
use App\CommonModel;
use App\ModuleSettings;
use App\Http\Traits\slug;
use App\Log;
use App\Modules;
use App\RecentUpdates;
use Auth;
use Config;
use Illuminate\Http\Request;
use App\Whmcs;
use DB;
use Session;

class MyLibrary {

    use slug;

    public static function getModelNameSpace() {
        $modelName = Config::get('Constant.MODULE.MODEL_NAME');
        $modelNameSpace = '\\App\\' . $modelName;
        return $modelNameSpace;
    }

    public static function setFrontRoutes($segment = false) {
        $aliasId = slug::resolve_alias_for_routes($segment);
        
        $response = CmsPage::getPageWithAlias($aliasId);
        return $response;
    }
    
    public static function getCategoryAliasRoutes() {
        $response = CmsPage::getCategoryWithAlias();
        return $response;
    }

    public static function getBreadCrumbData() {
        
    }

    public static function setConstants($segmentsArr = false) {

        //------------------------- Set Reseller Configuration --------------------
        Config::set('Constant.resellerclub.link', 'https://domaincheck.httpapi.com/api/');
        Config::set('Constant.resellerclub.apikey', 'mLgbpRFAtl1N2X0p0GjSJMmrQmSGOH9g');
        Config::set('Constant.resellerclub.id', '737693');
        //------------------------- Set Reseller Configuration --------------------
        //------------------------- Set OTP Apikey --------------------
        Config::set('Constant.otp_apikey', '7a9009f2-d062-11e8-a895-0200cd936042');

        if (empty($segmentsArr)) {
            $module = 'home';
        } elseif ($segmentsArr[0] != 'powerpanel') {
            $module = $segmentsArr[0];
        } elseif (isset($segmentsArr[1])) {
            $module = $segmentsArr[1];
        }
        $response = false;
        if (!empty($segmentsArr) && isset($module)) {
            // if($segmentsArr[0] != 'powerpanel'){ 
            //    $arrModule = self::setFrontRoutes($module);
            //    $objModules = Modules::getAllModuleData($arrModule->modules->varModuleName);
            //     }elseif($segmentsArr[0] == 'laravel-filemanager'){
            //      $objModules = Modules::getAllModuleData($module);
            //     }else{
            //       $objModules = Modules::getAllModuleData($module);
            //     }
            $objModules = Modules::getAllModuleData($module);
            if (count((array)$objModules) > 0) {
                $settings = ModuleSettings::getSettings($objModules->id);
                Config::set('Constant.MODULE.ID', $objModules->id);
                Config::set('Constant.MODULE.TITLE', $objModules->varTitle);
                Config::set('Constant.MODULE.NAME', $objModules->varModuleName);
                Config::set('Constant.MODULE.TABLE_NAME', $objModules->varTableName);
                Config::set('Constant.MODULE.MODEL_NAME', $objModules->varModelName);
                Config::set('Constant.MODULE.CONTROLLER', $objModules->varModuleClass);
                $settings = isset($settings->txtSettings) ? $settings->txtSettings : json_encode(null);
                Config::set('Constant.MODULE.SETTINGS', $settings);
                $endSegment = collect($segmentsArr)->last();
                $action = '';
                $notificationAction = '';
                if ($endSegment == $objModules->varModuleName) {
                    $action = 'list';
                    $notificationAction = 'listed';
                } else if ($endSegment == 'add' || $endSegment == 'create') {
                    $action = 'add';
                    $notificationAction = 'added';
                } else if ($endSegment == 'edit' || $endSegment == 'update_status' || $endSegment == 'update') {
                    Config::set('Constant.RECORD.ALIAS', $segmentsArr[2]);
                    $action = 'edit';
                    $notificationAction = 'updated';
                } else if ($endSegment == "destroy" || $endSegment == "DeleteRecord") {
                    $action = 'delete';
                    $notificationAction = 'deleted';
                }
                Config::set('Constant.MODULE.ACTION', $action);
                Config::set('Constant.NOTIFICATION.ACTION', $notificationAction);
                $response = true;
            }
        }
        return $response;
    }

    public static function logData($id = false, $moduleId = false) {
        if ($moduleId == false) {
            $moduleId = Config::get('Constant.MODULE.ID');
        }
        $response = array();
        if (!empty($id)) {
            $logArr = array();
            $logArr['fk_record_id'] = $id;
            $logArr['userId'] = Auth::id();
            $logArr['moduleCode'] = $moduleId;
            $logArr['ipAddress'] = self::get_client_ip();
            $logArr['chr_publish'] = 'Y';
            $logArr['chr_delete'] = 'N';
            $logArr['action'] = Config::get('Constant.MODULE.ACTION');
            $response = $logArr;
        }
        return $response;
    }

    public static function notificationData($id = false, $data = false, $moduleId = false) {
        if ($moduleId == false) {
            $moduleId = Config::get('Constant.MODULE.ID');
        }
        $response = array();
        if (!empty($id) && count($data) > 0 && !empty($data)) {
            $verb = '';
            if (Config::get('Constant.MODULE.ACTION') == "delete") {
                $verb = 'from';
            } else if (Config::get('Constant.MODULE.ACTION') == "add") {
                $verb = 'to';
            } else if (Config::get('Constant.MODULE.ACTION') == "edit") {
                $verb = 'at';
            }
            if (isset($data->varTitle)) {
                $title = $data->varTitle;
            } else {
                $title = $data->name;
            }
            $notification = "%s " . Config::get('Constant.MODULE.ACTION') . ' ' . $title . ' ' . $verb . ' ' . Config::get('Constant.MODULE.NAME') . '.';
            $recentNotification = '%s ' . Config::get('Constant.NOTIFICATION.ACTION') . ' ' . $title . ' ' . $verb . ' ' . Config::get('Constant.MODULE.NAME') . '.';
            $notificationArr['fkIntRecordCode'] = $id;
            $notificationArr['fkIntUserId'] = Auth::id();
            $notificationArr['varIpAddress'] = self::get_client_ip();
            $notificationArr['fkIntModuleId'] = $moduleId;
            $notificationArr['txtNotification'] = $notification;
            $notificationArr['txtRecentNotification'] = $recentNotification;
            $notificationArr['chrRecordDelete'] = $verb == 'from' ? 'Y' : 'N';
            $response = $notificationArr;
        }
        return $response;
    }

    public static function deleteMultipleRecords($data = false) {
        $response = false;
        $responseAr = [];
        if (!empty($data)) {
            $modelNameSpace = self::getModelNameSpace();
            $updateFields = ['chrDelete' => 'Y', 'chrPublish' => 'N'];
            $whereINConditions = $data['ids'];
            $update = CommonModel::updateMultipleRecords($whereINConditions, $updateFields);
            foreach ($data['ids'] as $key => $id) {
                if ($update) {
                    $objModule = CommonModel::getRecordsForDeleteById($id);
                    if (isset($objModule->intDisplayOrder)) {
                        CommonModel::updateOrder($objModule);
                        $updateFields['intDisplayOrder'] = 1;
                    }
                    if (!empty($id)) {
                        $logArr = self::logData($id);
                        $title = '-';
                        if (isset($objModule->varTitle)) {
                            $title = $objModule->varTitle;
                        } else if (isset($objModule->varName)) {
                            $title = $objModule->varName;
                        } else if (isset($objModule->name)) {
                            $title = $objModule->name;
                        } else if (isset($objModule->fullname)) {
                            $title = $objModule->fullname;
                        }
                        $logArr['varTitle'] = $title;
                        Log::recordLog($logArr);
                        array_push($responseAr, $objModule->id);
                        $updateRecentUpdatesFilelds = ['chrRecordDelete' => 'Y'];
                        if (Auth::user()->can('recent-updates-list')) {
                            $notificationUpdate = RecentUpdates::updateRecords($id, $updateRecentUpdatesFilelds);
                            if ($notificationUpdate) {
                                $notificationArr = self::notificationData($id, $objModule);
                                RecentUpdates::setNotification($notificationArr);
                            }
                        }
                    }
                }
            }
            $response = $responseAr;
        }
        return $response;
    }
     public static function deleteAWSMultipleRecords($data = false) {
        $response = false;
        $responseAr = [];
        if (!empty($data)) {
            $modelNameSpace = self::getModelNameSpace();
            $updateFields = ['chrDelete' => 'Y', 'chrPublish' => 'N'];
            $whereINConditions = $data['ids'];
            $update = CommonModel::updateMultipleRecords($whereINConditions, $updateFields);
            foreach ($data['ids'] as $key => $id) {
                if ($update) {
                    $objModule = CommonModel::getRecordsForDeleteById($id);
                    if (isset($objModule->intDisplayOrder)) {
                        CommonModel::updateOrder($objModule);
                        $updateFields['intDisplayOrder'] = 1;
                    }
                    if (!empty($id)) {
                        $logArr = self::logData($id);
                        $title = '-';
                        if (isset($objModule->varFirstName)) {
                            $title = $objModule->varFirstName;
                        } else if (isset($objModule->varFirstName)) {
                            $title = $objModule->varFirstName;
                        } else if (isset($objModule->name)) {
                            $title = $objModule->name;
                        }
                        $logArr['varFirstName'] = $title;
                        Log::recordLog($logArr);
                        array_push($responseAr, $objModule->id);
                        $updateRecentUpdatesFilelds = ['chrRecordDelete' => 'Y'];
                        if (Auth::user()->can('recent-updates-list')) {
                            $notificationUpdate = RecentUpdates::updateRecords($id, $updateRecentUpdatesFilelds);
                            if ($notificationUpdate) {
                                $notificationArr = self::notificationData($id, $objModule);
                                RecentUpdates::setNotification($notificationArr);
                            }
                        }
                    }
                }
            }
            $response = $responseAr;
        }
        return $response;
    }

    public static function setPublishUnpublish($alias = false, $request) {
        $response = false;
        if (!empty($alias) && !empty($request->val)) {
            $modelNameSpace = self::getModelNameSpace();
            if (is_numeric($alias)) {
                $id = $alias;
                $whereConditions = ['id' => $id];
                //$objModule       = $modelNameSpace::getRecordById($id);
            }
            $logArr = self::logData($id);
            if (!empty($request->val) && ($request->val == 'Unpublish')) {
                $updateField = ['chrPublish' => 'N'];
                $update = CommonModel::updateRecords($whereConditions, $updateField);
                if ($update) {
                    $logArr['action'] = 'Unpublish';
                    Log::recordLog($logArr);
                    $response = $update;
                }
            }
            if (!empty($request->val) && ($request->val == 'Publish')) {
                $updateField = ['chrPublish' => 'Y'];
                $update = CommonModel::updateRecords($whereConditions, $updateField);
                if ($update) {
                    $logArr['action'] = 'publish';
                    Log::recordLog($logArr);
                    $response = $update;
                }
            }
        }
        return $response;
    }

    /**
     * This method generates events seo content
     * @return  Meta values
     * @since   2016-10-25
     * @author  NetQuick
     */
    public static function generateSeocontent($title = false, $description = false, $fromajax = false) {
        $response = '';
        if (strlen($description) > 0) {
            if ($fromajax) {
                $description = html_entity_decode(strip_tags($description));
            } else {
                $description = strip_tags($description);
            }
        }
        $meta_title = $title;
        $meta_keyword = $title;
        $meta_description = substr($description, 0, 160);
        $seo_data = $meta_title . '*****' . $meta_keyword . '*****' . $meta_description;
        $response = $seo_data;
        return $response;
    }

    /**
     * This method handels swapping of available order record while editing
     * @param      order
     * @return  order
     * @since   2016-12-23
     * @author  NetQuick
     */
    public static function swapOrderEdit($order = null, $id = null) {
        $modelNameSpace = self::getModelNameSpace();
        $recEx = CommonModel::getRecordByOrder($modelNameSpace, $order);
        // print_r($recEx->intDisplayOrder);
        // die();
        if (count((array)($recEx)) > 0) {
            $recCur = $modelNameSpace::getRecordById($id);
            if ($recCur->intDisplayOrder != $recEx->intDisplayOrder) {
                $whereConditionsForEx = ['id' => $recEx['id']];
                CommonModel::updateRecords($whereConditionsForEx, ['intDisplayOrder' => $recCur->intDisplayOrder]);
                $whereConditionsForCur = ['id' => $recCur['id']];
                CommonModel::updateRecords($whereConditionsForCur, ['intDisplayOrder' => $recEx->intDisplayOrder]);
            }
        }
    }

    /**
     * This method handels swapping of available order record while editing
     * @param      order
     * @return  order
     * @since   2016-12-23
     * @author  NetQuick
     */
    public static function swapOrder($order = null, $exOrder = null) {
        $modelNameSpace = self::getModelNameSpace();
        $recEx = CommonModel::getRecordByOrder($modelNameSpace, $exOrder);
        if (count($recEx) > 0) {
            $recCur = CommonModel::getRecordByOrder($modelNameSpace, $order);
            if ($recCur->intDisplayOrder != $recEx->intDisplayOrder) {
                $whereConditionsForEx = ['id' => $recEx['id']];
                CommonModel::updateRecords($whereConditionsForEx, ['intDisplayOrder' => $recCur->intDisplayOrder]);
                $whereConditionsForCur = ['id' => $recCur['id']];
                CommonModel::updateRecords($whereConditionsForCur, ['intDisplayOrder' => $recEx->intDisplayOrder]);
            }
        }
    }

    /**
     * This method handels swapping of available order record while adding
     * @param      order
     * @return  order
     * @since   2016-10-21
     * @author  NetQuick
     */
    public static function swapOrderAdd($order = null) {
        $response = false;
        $modelNameSpace = self::getModelNameSpace();
        $rec = CommonModel::getRecordByOrder($modelNameSpace, $order);
        if (count((array)($rec)) > 0) {
            $total = CommonModel::getRecordCount();
            $whereConditions = ['intDisplayOrder' => $order];
            CommonModel::updateRecords($whereConditions, ['intDisplayOrder' => $total + 1]);
        }
        $response = $order;
        //print_r($response);
        //die();
        return $response;
    }

    // /**
    //  * This method reorders events
    //  * @return  events index view data
    //  * @since   2016-10-11
    //  * @author  NetQuick
    //  */
    // static function reorder($data) {
    //         if (isset($data['order'])) {
    //                 $data = array_filter($data['order'], function ($value) {
    //                         return $value !== '';
    //                 });
    //                 foreach ($data as $key => $value) {
    //                         if ((int)$key != 0) {
    //                                 $whereConditions = ['id'=> $key];
    //                                 CommonModel::updateRecords($whereConditions, ['intDisplayOrder' => $value]);
    //                         }
    //                 }
    //         }
    // }
    public static function insertAlias($alias = false, $moduleCode = false) {
        $response = false;
        $moduleCode = ($moduleCode == false) ? Config::get('Constant.MODULE.ID') : $moduleCode;
        $response = Alias::addAlias($alias, $moduleCode);
        return $response;
    }

    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

    public static function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        /* $secret_key = 'This is my secret key';
          $secret_iv = 'This is my secret iv'; */
        $secret_key = '01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $secret_iv = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    // public static function getStaticArrayOfPrice()
    // {   
    //     //$myfile = Config::get('Constant.CDNURL')."/hits_price/pricing.js";
    //     if(Config::get('Constant.sys_currency') == "INR")
    //     { $myfile = Config::get('Constant.SITE_URL')."/hits_price2/pricingINR.js"; }
    //     elseif(Config::get('Constant.sys_currency') == "USD")
    //     { $myfile = Config::get('Constant.SITE_URL')."/hits_price2/pricingUSD.js"; }

    //     /*
    //     $ar = file_get_contents($myfile);
    //     $result = json_decode($ar, true);
    //     return $result;
    //     */
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $myfile);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $result = curl_exec($ch);
    //     //echo '<pre>';print_r($result);echo '</pre>';exit;
    //     curl_close($ch);
    //     return json_decode( $result, true );
    // }


     public static function getStaticArrayOfPrice()
    {
        // Get the system currency
        $currency = Config::get('Constant.sys_currency');
        
        if($currency == "INR"){
             $prices = DB::table('pricing_27125')
            ->where('currency', 'INR') // Assuming there's a column named 'currency'
            ->value('price_value');            
        }else if($currency == "USD"){
            $prices = DB::table('pricing_27125')
            ->where('currency', 'USD') // Assuming there's a column named 'currency'
            ->value('price_value'); 
        }
        // Query the database based on the currency
        // dd(json_decode( $prices));       
               return json_decode( $prices, true );

    }

//     public static function getStaticArrayOfPrice()
// {
//     // Determine the file URL based on the system currency
//     $currency = Config::get('Constant.sys_currency');
//     $baseURL = Config::get('Constant.SITE_URL');
    
//     if ($currency === "INR") {
//         $fileURL = $baseURL . "/hits_price2/pricingINR.js";
//     } elseif ($currency === "USD") {
//         $fileURL = $baseURL . "/hits_price2/pricingUSD.js";
//     } else {
//         // Fallback or error handling if the currency is unsupported
//         throw new \Exception("Unsupported currency: " . $currency);
//     }

//     // Initialize cURL session
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $fileURL);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//     // Execute cURL and handle response
//     $response = curl_exec($ch);
//     $error = curl_error($ch);
//     curl_close($ch);

//     // Check for cURL errors
//     if ($response === false) {
//         throw new \Exception("cURL error: " . $error);
//     }

//     // Decode JSON response
//     $data = json_decode($response, true);
    
//     // Check if JSON decoding was successful
//     if (json_last_error() !== JSON_ERROR_NONE) {
//         throw new \Exception("JSON decode error: " . json_last_error_msg());
//     }

//     return $data;
// }



    //  public static function laravelcallvalidatelogin($action, $postfields) {
    //     $WHMCSUrl = config('app.api_url');
    //     $apiurl = $WHMCSUrl."/validatelogin.php";
        
    //     $fields = http_build_query($postfields);
    //     $ch = curl_init($apiurl);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 900);
    //     $result = curl_exec($ch);
    //     if (curl_error($ch)) {
    //         $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
    //         file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
    //         die('Unable to connect (laravelcallvalidatelogin): ' . curl_errno($ch) . ' - ' . curl_error($ch));
    //     }
    //     curl_close($ch);
    //    return $result;
    // }

    public static function laravelcallvalidatelogin($action, $postfields) {
        // dd($postfields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://manage.hostitsmart.com/includes/api.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query(
                array(
                    'action' => 'ValidateLogin',
                    // See https://developers.whmcs.com/api/authentication
                    'username' => 'ZyjSSPOuTToAmyLZXN13BCaCQTSjvP8I',
                    'password' => 'plgLV63LlubL4MRig6LgNDigMvKRH4EB',
                    'email' => $postfields['email'],
                    'password2' => $postfields['password2'],
                    'responsetype' => 'json',
                )
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);
        if($result->result == 'error'){
            return '';
        }else{
            return $result->passwordhash;
        }
        // echo "<pre>"; print_r($result->passwordhash); exit;
    }

    // New function to call whmcs api------------------------------

    public static function laravelcallapi($action, $postfields) {
    $request = (object) $postfields;
    if($action == 'whmcs'){
        //Route::post('/whmcs'
        return ['posts'=>"test 1",'comment'=>"testing comment 1"];
    }

if($action == 'validatelogin'){
    //Route::post('/validatelogin'
    
    //Logic: Validate login in WHMCS
    //parameters: username and password2
    //return:  hash

    $email = isset($request->email)?$request->email:'';
    $password2 = isset($request->password2)?$request->password2:'';
    
    if(empty($email))
    return ['result' => "error",'msg' => "Please provide parameter 'email'"];
    if(empty($password2))
    return ['result' => "error",'msg' => "Please provide parameter 'password2'"];
    
    return Whmcs::validateLogin($request);
}

if($action == 'logintowhmcs'){
    //Route::post('/logintowhmcs'
    $manageurl = config('app.api_url');
     $whmcsurl = $manageurl."/dologin_hits.php";
     $autoauthkey = "xRr=GDK!9EJ7";
     $email = isset($request->email)?$request->email:'';
     $timestamp = time(); # Get current timestamp
     $hash = sha1($email.$timestamp.$autoauthkey); # Generate Hash
     $url = $whmcsurl."?email=".$email."&timestamp=".$timestamp."&hash=".$hash;
     echo $url;exit;
        
}

if($action == 'isloggedin'){
    //Route::post('/isloggedin'
    
    //Logic: Check is user logged in WHMCS or not. 
    //parameters: email or id
    //return:  true/false

    $result = [];
    $uid = isset($request->clientid)?$request->clientid:'';
    if(empty($uid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'clientid'"];
    
    return ["result" => "success","data" => ["loginstatus" => Whmcs::isloggedin($request)]];
}

if($action == 'getproductdetails'){
    //Route::post('/getproductdetails'
    
    //Logic: Get whmcs products list
    //parameters: groupid or products id
    //return:  data retrieved from API calls in JSON Format

    $gid = isset($request->groupid)?$request->groupid:'';
    $pid = isset($request->productid)?$request->productid:'';
    
    if(empty($gid) && empty($pid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'groupid' or 'productid'"];
    
    return Whmcs::getProducts($request);
}

if($action == 'getproductpricing'){
    //Route::post('/getproductpricing'
    
    //Logic: Get whmcs products pricing details
    //parameters: products id, currencycode 
    //return:  data retrieved from API calls in JSON Format
    
    $pid = isset($request->productid)?$request->productid:'';
    $ccode = trim($request->currencycode);

    if(empty($pid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'productid'"];
    
    $productData = Whmcs::getProducts($request);
    
    if(empty($productData['totalresults']))
    return ['result' => "error",'msg' => "Product not found for id: ".$pid];

    if(!empty($ccode) && empty($productData['products']['product'][0]['pricing'][$ccode]))
    return ['result' => "error",'msg' => "Product pricing not found for currencycode: ".$ccode];

    $finalData = !empty($ccode)?$productData['products']['product'][0]['pricing'][$ccode]:$productData['products']['product'][0]['pricing'];
    
    return $finalData;
}

if($action == 'isuserexists'){
    //Route::post('/isuserexists'
    
    //Logic: Check if user is already exists in whmcs by email id
    //parameters: email
    //return:  data retrieved from API calls in JSON Format

    $email = isset($request->email)?$request->email:'';
    if(empty($email))
    { return ['result' => "error",'msg' => "Please provide parameter 'email'"];  }
    
    return Whmcs::isUserExists($request);
}

if($action == 'addclient'){
    //Route::post('/addclient'
    
    //Logic: Create new user in WHMCS
    //parameters: fields array[]
    //return:  client id or false.

    $email = isset($request->email)?$request->email:'';
    $country = isset($request->country)?$request->country:'';
    $password2 = isset($request->password2)?$request->password2:'';
    
    if(empty($email))
    return ['result' => "error",'msg' => "Please provide parameter 'email'"];

    if(empty($country))
    return ['result' => "error",'msg' => "Please provide parameter 'country code'"];

    if(empty($password2))
    return ['result' => "error",'msg' => "Please provide parameter 'password2'"];
    
    return Whmcs::addClient($request);
}

if($action == 'getclient'){
    //Route::post('/getclient'
    
    //Logic: get Details about client in WHMCS by id
    //parameters: email or clientid
    //return:  detailed array of whmcs client.

    $email = isset($request->email)?$request->email:'';
    $clientid = isset($request->clientid)?$request->clientid:'';
    
    if(empty($email) && empty($clientid))
    return ['result' => "error",'msg' => "Please provide parameter 'email' or 'clientid'"];

    return Whmcs::getClientDetails($request);
}

if($action == 'updateclient'){
    //Route::post('/updateclient'
    
    //Logic: Update user in WHMCS
    //parameters: fields array[]
    //return:  client id or false.

    $clientid = isset($request->clientid)?$request->clientid:'';
    $clientemail = isset($request->clientemail)?$request->clientemail:'';
    
    if(empty($clientid) && empty($clientemail))
    return ['result' => "error",'msg' => "Please provide parameter 'clientemail' or 'clientid'"];

    return Whmcs::updateClient($request);
}

if($action == 'closeclient'){
    //Route::post('/closeclient'
    
    //Logic: close client status and make product disable and terminate
    //parameters: clientid
    //return: client id and status

    $clientid = isset($request->clientid)?$request->clientid:'';
    
    if(empty($clientid))
    return ['result' => "error",'msg' => "Please provide parameter 'clientid'"];

    return Whmcs::closeClient($request);
}

if($action == 'deleteclient'){
    //Route::post('/deleteclient'
    
    //Logic: remove client and associalted data from WHMCS
    //parameters: clientid
    //return: client id and status

    $clientid = isset($request->clientid)?$request->clientid:'';
    
    if(empty($clientid))
    return ['result' => "error",'msg' => "Please provide parameter 'clientid'"];

    return Whmcs::deleteClient($request);
}

if($action == 'getclientsaddons'){
    //Route::post('/getclientsaddons'
    
    //Logic: Obtain the Clients Product Addons that match passed criteria
    //parameters: serviceid, clientid(optional), addonid(optional)
    //return: detailed array of client's addons
    
    $serviceid = isset($request->serviceid)?$request->serviceid:'';
    $clientid = isset($request->clientid)?$request->clientid:'';
    $addonid = isset($request->addonid)?$request->addonid:'';
    
    if(empty($serviceid))
    return ['result' => "error",'msg' => "Please provide parameter 'serviceid'"];

    return Whmcs::getClientsAddons($request);
}

if($action == 'getclientsdomains'){
    //Route::post('/getclientsdomains'
    
    //Logic: Obtain a list of Client Purchased Domains matching the provided criteria
    //parameters: clientid(optional), domainid(optional), domain(optional),limitstart ,limitnum  
    //return: detailed array of client's domains
    
    $clientid = isset($request->clientid)?$request->clientid:'';
    $domainid = isset($request->domainid)?$request->domainid:'';
    $domain = isset($request->domain)?$request->domain:'';

    
    if(empty($clientid))
    return ['result' => "error",'msg' => "Please provide parameter 'clientid'"];

    return Whmcs::getClientsDomains($request);
}

if($action == 'getclientsproducts'){
    //Route::post('/getclientsproducts'
    
    //Logic: Obtain a list of Client Purchased Products matching the provided criteria
    //parameters: clientid(optional), serviceid(optional), pid(optional),limitstart ,limitnum    
    //return: detailed array of client's products
    
    $clientid = isset($request->clientid)?$request->clientid:'';
    $serviceid = isset($request->serviceid)?$request->serviceid:'';
    $pid = isset($request->pid)?$request->pid:'';
    $domain = isset($request->domain)?$request->domain:'';
    
    
    if(empty($clientid))
    return ['result' => "error",'msg' => "Please provide parameter 'clientid'"];

    return Whmcs::getClientsProducts($request);
}

if($action == 'getallproductsgroups'){
    //Route::post('/getallproductsgroups'
    
    //Logic: Get list of products groups
    //parameters: null
    //return:  data retrieved from API calls in JSON Format

    return Whmcs::getAllProductsGroups($request);
}

if($action == 'getgroupdetails'){
    //Route::post('/getgroupdetails'
    
    //Logic: Get all details about products's groups by id
    //parameters: groupid
    //return:  data retrieved from API calls in JSON Format

    $groupid = isset($request->groupid)?$request->groupid:'';
    if(empty($groupid))
    return ['result' => "error",'msg' => "Please provide parameter 'groupid'"];
    
    return Whmcs::getGroupDetails($request);
}

if($action == 'createorder'){
    //Route::post('/createorder'
    
    //Logic: Create new Order in WHMCS
    //parameters: fields array[]
    //return:  order id or false.

    $clientid = isset($request->clientid)?$request->clientid:'';
        if(!empty($clientid))
            $params['clientid'] = $clientid;

    $paymentmethod = isset($request->paymentmethod)?$request->paymentmethod:'';
    if(!empty($paymentmethod))
        $params['paymentmethod'] = $paymentmethod;
    
    if(empty($clientid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'clientid'"];

    if(empty($paymentmethod)) 
    return ['result' => "error",'msg' => "Please provide parameter 'paymentmethod'"];

    return Whmcs::createOrder($request);
}

if($action == 'acceptorder'){
    //Route::post('/acceptorder'
    
    //Logic: Accept Order in WHMCS
    //parameters: fields array[]
    //return:  order id or false.

    $orderid = isset($request->orderid)?$request->orderid:'';
        if(!empty($orderid))
            $params['orderid'] = $orderid;

    if(empty($orderid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'orderid'"];

    return Whmcs::acceptOrder($request);
}

if($action == 'cancelorder'){
    //Route::post('/cancelorder'
    
    //Logic: Cancel Order in WHMCS
    //parameters: orderid
    //return: success or false.

    $orderid = isset($request->orderid)?$request->orderid:'';
        if(!empty($orderid))
            $params['orderid'] = $orderid;

    if(empty($orderid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'orderid'"];

    return Whmcs::cancelOrder($request);
}

if($action == 'pendingorder'){
    //Route::post('/pendingorder'
    
    //Logic: Pending Order in WHMCS
    //parameters: orderid
    //return: success or false.

    $orderid = isset($request->orderid)?$request->orderid:'';
        if(!empty($orderid))
            $params['orderid'] = $orderid;

    if(empty($orderid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'orderid'"];

    return Whmcs::pendingOrder($request);
}

if($action == 'deleteorder'){
    //Route::post('/deleteorder'
    
    //Logic: Delete Order in WHMCS
    //parameters: orderid
    //return: success or false.

    $orderid = isset($request->orderid)?$request->orderid:'';
        if(!empty($orderid))
            $params['orderid'] = $orderid;

    if(empty($orderid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'orderid'"];

    return Whmcs::deleteOrder($request);

}

if($action == 'getordersdetails'){
    //Route::post('/getordersdetails'
    
    //Logic: Get whmcs Order details
    //parameters: id or userid or status
    //return:  data retrieved from API calls in JSON Format

    $id     = isset($request->id)?$request->id:'';
    $userid = isset($request->userid)?$request->userid:'';
    $status = isset($request->status)?$request->status:'';
    
    if(empty($id) && empty($userid) && empty($status)) 
    return ['result' => "error",'msg' => "Please provide parameter 'id' or 'userid' or 'status'"];
    
    return Whmcs::getOrderDetails($request);
}

if($action == 'getinvoicedetails'){
    //Route::post('/getinvoicedetails'

    //Logic: Get whmcs Invoice details
    //parameters: invoiceid
    //return:  data retrieved from API calls in JSON Format

    $invoiceid  = isset($request->invoiceid)?$request->invoiceid:'';
    //$userid = $request->userid;
    //$status = $request->status;
    
    if(empty($invoiceid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'invoiceid'"];
    
    return Whmcs::getInvoiceDetails($request);
}

if($action == 'getuserinvoice'){
    //Route::post('/getuserinvoice'
    
    //Logic: Get whmcs Invoice details by user
    //parameters: invoiceid 
    //return: Data retrieved from API calls in JSON Format
        $userid = isset($request->userid)?$request->userid:'';
    
    if(empty($userid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'userid'"];
    
    return Whmcs::getUserInvoices($request);
}

if($action == 'getminprice'){
    //Route::post('/getminprice'
    
    //Logic: Get Minimum price of prduct in whmcs
    //parameters: productid 
    //return:  data retrieved from API calls in JSON Format
    
    $pid = isset($request->productid)?$request->productid:'';
    $ccode = isset($request->currencycode)?$request->currencycode:'';
    $ccode = trim($ccode);
    $duration = isset($request->duration)?$request->duration:'';
    $duration = trim($duration);


    if(empty($pid)) 
    return ['result' => "error",'msg' => "Please provide parameter 'productid'"];
    if(empty($duration)) 
    return ['result' => "error",'msg' => "Please provide parameter 'duration':'msetupfee, qsetupfee, ssetupfee, asetupfee, bsetupfee, tsetupfee, monthly, quarterly, semiannually, annually, biennially, triennially'"];

    $productData = Whmcs::getProducts($request);
    
    
    if(empty($productData['totalresults']))
    return ['result' => "error",'msg' => "Product not found for id: ".$pid];

    if(!empty($ccode) && empty($productData['products']['product'][0]['pricing'][$ccode]))
    return ['result' => "error",'msg' => "Product pricing not found for currencycode: ".$ccode];

    $finalData = !empty($ccode)?$productData['products']['product'][0]['pricing'][$ccode]:$productData['products']['product'][0]['pricing'];
    $minData = [];
    
    if(!empty($ccode) && !empty($duration)){ 
        $minData[$ccode][$duration] = str_replace(".00","",$finalData[$duration]); 
    }
    else 
    {
        foreach($finalData as $key => $data){ $minData[$key][$duration] = str_replace(".00","",$finalData[$key][$duration]); }
    }
    return $minData;
}

if($action == 'gettldspricing'){
    //Route::post('/gettldspricing'
    
    //Logic: Get pricing or tlds
    //parameters: null or tlds = ".com"
    //return:  data retrieved from API calls in JSON Format
    return Whmcs::getAllTldsPricing($request);
}

if($action == 'domainavail'){
    //Route::post('/domainavail'
    
    //Logic: Domain availability check
    //parameters: null
    //return:  data retrieved from API calls in JSON date_format()
    $domainname = $tld = "";
    if(!empty($request->domainname))
            $domainname = $request->domainname;

    if(!empty($request->tlds))
            $tlds = $request->tlds; 

    if(empty($domainname))
    return ['result' => "error",'msg' => "Please provide parameters 'domainname'"];

    if(empty($tlds))
    return ['result' => "error",'msg' => "Please provide parameters 'tlds'"];
    
    return Whmcs::resellerclub_domain_availability($domainname,$tlds);
}

if($action == 'generatecustomfields'){
    //Route::post('/generatecustomfields'
    
    //Logic: Get pricing or tlds
    //parameters: null or tlds = ".com"
    //return:  data retrieved from API calls in JSON Format
    return Whmcs::generateCustomFields($request);
}

if($action == 'getdomainaddonspricing'){
    //Route::post('/getdomainaddonspricing'
    
    return Whmcs::getDomainAddonspricing($request);
}

if($action == 'orderratingupdatedata'){
    $response = Whmcs::orderratingupdatedata($request);
    return $response;
    }

if($action == 'getwhois'){
    //Route::post('/getwhois'
    
    if(!empty($request->domainname))
            $domainname = $request->domainname; 

    if(empty($domainname))
    return ['result' => "error",'msg' => "Please provide parameters 'domainname'"];

    return Whmcs::getWhois($request);
}

if($action == 'getfreedomaindetails'){
    //Route::post('/getfreedomaindetails'
    if(!empty($request->productid))
            $productid = $request->productid; 

    if(empty($productid))
    return ['result' => "error",'msg' => "Please provide parameters 'productid'"];

    return Whmcs::getFreeDomainDetails($request);
}

if($action == 'getorderidfrominvoicveid'){
    //Route::post('/getorderidfrominvoicveid'
    
    if(!empty($request->invoiceid))
            $invoiceid = $request->invoiceid; 

    if(empty($invoiceid))
    return ['result' => "error",'msg' => "Please provide parameters 'invoiceid'"];

    return Whmcs::getorderidfrominvoicveid($request);
}
if($action == 'orderratingupdate'){
    $response = Whmcs::orderratingupdate($request);
    return $response;
    }
}
//New function to call whmcs api end-----------------------------------
  
    public static function laravelcallapiOld($action, $postfields) {
        
        $siteurl = url('/');
        // $siteurl = 'https://www.hostitsmart.com';
        $apiurl = $siteurl . "/api/" . $action;
        //echo $apiurl;exit;
        //Logic: Call to whmcs external api
        //parameters: according to api requirements
        //return:  data retrieved from API calls in JSON Format  
        
        
        $fields = http_build_query($postfields);
        $ch = curl_init($apiurl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        $result = curl_exec($ch);
       
      
         //  if($action == 'setapiaction'){
         //     echo $apiurl;
         //     echo '<pre>';print_r($postfields);
         //     echo '<pre>';print_r($result);
         //     exit;
         // }
        
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch). " postdata: ".print_r($fields,true);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
             die('Unable to connect (laravelcallapi): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " Status: ".$httpcode . " postdata: ".print_r($fields,true);
        file_put_contents('curlerror_log.txt',"\n".$strContent, FILE_APPEND);
        
        curl_close($ch);
        $jsonData = json_decode($result,true);
        return $jsonData;
    }
    
    public static function getMetaDetails($id,$table_name) {
        $response = false;
        $response = DB::table($table_name)
                ->select('varMetaTitle', 'varMetaKeyword', 'varMetaDescription')
                ->where(['id' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->first();
        $response->varMetaTitle = MyLibrary::getSEOMetaPricing($id,$table_name,$response->varMetaTitle);
        $response->varMetaKeyword = MyLibrary::getSEOMetaPricing($id,$table_name,$response->varMetaKeyword);
        $response->varMetaDescription = MyLibrary::getSEOMetaPricing($id,$table_name,$response->varMetaDescription);
        return $response;
    }
    public static function getSEOMetaPricing($id,$table_name,$content){
        //echo $id." ".$table_name;
        $str = '';
        $pricing = array();
        //echo $id; 
        //echo $table_name;

        //for home page [1] is cms page alias id
         $cmsarr[1][1] =  Config::get('Constant.LINUX_HOSTING_STARTER_PRICE_36_INR');
         $cmsarr[1][10] = Config::get('Constant.LINUX_HOSTING_STARTER_PRICE_36_USD');

        //linux hosting starter 1 year
        $product[1][1] = Config::get('Constant.LINUX_HOSTING_STARTER_PRICE_36_INR');
        $product[1][10] = Config::get('Constant.LINUX_HOSTING_STARTER_PRICE_36_USD');

        //Windows hosting
        $product[2][1] = Config::get('Constant.WINDOWS_HOSTING_STARTER_PRICE_36_INR'); 
        $product[2][10] = Config::get('Constant.WINDOWS_HOSTING_STARTER_PRICE_36_USD');  

        //ecommerce hosting 
        $product[6][1] = Config::get('Constant.ECOMMERCE_HOSTING_STARTER_PRICE_36_INR');
        $product[6][10] = Config::get('Constant.ECOMMERCE_HOSTING_STARTER_PRICE_36_USD');
        
        //Dedicated Server
        $product[8][1] = Config::get('Constant.DEDICATED_SERVERS_STARTER_PRICE_6_INR');
        $product[8][10] = Config::get('Constant.DEDICATED_SERVERS_STARTER_PRICE_6_USD');

        //windows reseller hosting 
        $product[12][1] = Config::get('Constant.WINDOWS_RESELLER_HOSTING_STARTER_PRICE_36_INR'); 
        $product[12][10] = Config::get('Constant.WINDOWS_RESELLER_HOSTING_STARTER_PRICE_36_USD');

        //java hosting 
        $product[13][1] = Config::get('Constant.JAVA_HOSTING_STARTER_PRICE_36_INR');
        $product[13][10] = Config::get('Constant.JAVA_HOSTING_STARTER_PRICE_36_USD');

        //linux reseller hosting 
        $product[15][1] = Config::get('Constant.LINUX_RESELLER_HOSTING_STARTER_PRICE_36_INR'); 
        $product[15][10] = Config::get('Constant.LINUX_RESELLER_HOSTING_STARTER_PRICE_36_USD');

        //ssl
        $product[10][1] = Config::get('Constant.DOMAIN_VALIDATION_SSL_STARTER_PRICE_12_INR');
        $product[10][10] = Config::get('Constant.DOMAIN_VALIDATION_SSL_STARTER_PRICE_12_USD');

        //Hosting
        $product_category[2][1] = Config::get('Constant.LINUX_HOSTING_STARTER_PRICE_36_INR');
        $product_category[2][10] = Config::get('Constant.LINUX_HOSTING_STARTER_PRICE_36_USD');
        
        //Domain Registration
        $product_category[9][1] = Config::get('Constant.MEGAMENU_REGISTER_PRICE_INR');
        $product_category[9][10] = Config::get('Constant.MEGAMENU_REGISTER_PRICE_USD');

        $cur = Config::get('Constant.sys_currency_code');
        if(empty($cur)){  $cur = 1;}
        $sym = ($cur == 1)?"Rs.":"$ ";

        if($table_name == 'products'){
            if(isset($product[$id])){
                $str = str_replace("@price",$sym.$product[$id][$cur],$content);        
            }
            else { $str = $content; }
        }
        else if($table_name == 'product_category'){
            if(isset($product_category[$id])){
                $str = str_replace("@price",$sym.$product_category[$id][$cur],$content);        
            }
            else { $str = $content; }
        }
        else if($table_name == 'cms'){
            if(isset($cmsarr[$id])){
                $str = str_replace("@price",$sym.$cmsarr[$id][$cur],$content);        
            }
            else { $str = $content; }
        }
        else { $str = $content;  }
        
        return $str;
    }
public static function getCountryDialingCodeList($id = null){
/*$coutriesCode = Array
(
    "93" => "Afghanistan",
    "355" => "Albania",
    "213" => "Algeria",
    "1684" => "American Samoa",
    "376" => "Andorra",
    "244" => "Angola",
    "1264" => "Anguilla",
    "1268" => "Antigua and Barbuda",
    "54" => "Argentina",
    "374" => "Armenia",
    "297" => "Aruba",
    "61" => "Australia",
    "43" => "Austria",
    "994" => "Azerbaijan",
    "1242" => "Bahamas",
    "973" => "Bahrain",
    "880" => "Bangladesh",
    "1246" => "Barbados",
    "375" => "Belarus",
    "32" => "Belgium",
    "501" => "Belize",
    "229" => "Benin",
    "1441" => "Bermuda",
    "975" => "Bhutan",
    "591" => "Bolivia",
    "387" => "Bosnia and Herzegovina",
    "267" => "Botswana",
    "55" => "Brazil",
    "673" => "Brunei",
    "359" => "Bulgaria",
    "226" => "Burkina Faso",
    "257" => "Burundi",
    "855" => "Cambodia",
    "237" => "Cameroon",
    "1" => "United States",
    "238" => "Cape Verde",
    "1" => "Canada",
    "1345" => "Cayman Islands",
    "236" => "Central African Republic",
    "235" => "Chad",
    "56" => "Chile",
    "86" => "China",
    "57" => "Colombia",
    "269" => "Comoros",
    "242" => "Congo",
    "243" => "Congo Democratic Republic",
    "682" => "Cook Islands",
    "506" => "Costa Rica",
    "225" => "Cote D'Ivoire",
    "385" => "Croatia",
    "53" => "Cuba",
    "357" => "Cyprus",
    "420" => "Czech Republic",
    "45" => "Denmark",
    "253" => "Djibouti",
    "1767" => "Dominica",
    "1809" => "Dominican Republic",
    "593" => "Ecuador",
    "20" => "Egypt",
    "503" => "El Salvador",
    "240" => "Equatorial Guinea",
    "291" => "Eritrea",
    "372" => "Estonia",
    "251" => "Ethiopia",
    "298" => "Faeroe Islands",
    "500" => "Falkland Islands (Malvinas)",
    "679" => "Fiji",
    "358" => "Finland",
    "33" => "France",
    "594" => "French Guiana",
    "689" => "French Polynesia",
    "241" => "Gabon",
    "220" => "Gambia",
    "995" => "Georgia",
    "49" => "Germany",
    "233" => "Ghana",
    "350" => "Gibraltar",
    "30" => "Greece",
    "299" => "Greenland",
    "1473" => "Grenada",
    "590" => "Guadeloupe",
    "1671" => "Guam",
    "502" => "Guatemala",
    "224" => "Guinea",
    "245" => "Guinea Bissau",
    "592" => "Guyana",
    "509" => "Haiti",
    "504" => "Honduras",
    "852" => "Hong Kong",
    "36" => "Hungary",
    "354" => "Iceland",
    "91" => "India",
    "62" => "Indonesia",
    "98" => "Iran",
    "964" => "Iraq",
    "353" => "Ireland",
    "44" => "United Kingdom",
    "972" => "Israel",
    "39" => "Italy",
    "1876" => "Jamaica",
    "81" => "Japan",
    "962" => "Jordan",
    "7" => "Russia",
    "254" => "Kenya",
    "686" => "Kiribati",
    "965" => "Kuwait",
    "996" => "Kyrgyzstan",
    "856" => "Laos",
    "371" => "Latvia",
    "961" => "Lebanon",
    "266" => "Lesotho",
    "231" => "Liberia",
    "218" => "Libya",
    "423" => "Liechtenstein",
    "370" => "Lithuania",
    "352" => "Luxembourg",
    "853" => "Macao",
    "389" => "Macedonia",
    "261" => "Madagascar",
    "265" => "Malawi",
    "60" => "Malaysia",
    "960" => "Maldives",
    "223" => "Mali",
    "356" => "Malta",
    "596" => "Martinique",
    "222" => "Mauritania",
    "230" => "Mauritius",
    "52" => "Mexico",
    "691" => "Micronesia",
    "373" => "Moldova",
    "377" => "Monaco",
    "976" => "Mongolia",
    "382" => "Montenegro",
    "1664" => "Montserrat",
    "212" => "Morocco",
    "258" => "Mozambique",
    "95" => "Myanmar",
    "264" => "Namibia",
    "674" => "Nauru",
    "977" => "Nepal",
    "31" => "Netherlands",
    "599" => "Netherlands Antilles",
    "687" => "New Caledonia",
    "64" => "New Zealand",
    "505" => "Nicaragua",
    "227" => "Niger",
    "234" => "Nigeria",
    "683" => "Niue",
    "850" => "North Korea",
    "1670" => "Northern Mariana Islands",
    "47" => "Norway",
    "968" => "Oman",
    "92" => "Pakistan",
    "680" => "Palau",
    "507" => "Panama",
    "675" => "Papua New Guinea",
    "595" => "Paraguay",
    "51" => "Peru",
    "63" => "Philippines",
    "48" => "Poland",
    "351" => "Portugal",
    "974" => "Qatar",
    "262" => "Reunion",
    "40" => "Romania",
    "250" => "Rwanda",
    "1869" => "Saint Kitts And Nevis",
    "1758" => "Saint Lucia",
    "1599" => "Saint Martin",
    "508" => "Saint Pierre and Miquelon",
    "1784" => "Saint Vincent and Grenadines",
    "685" => "Samoa",
    "378" => "San Marino",
    "239" => "Sao Tome and Principe",
    "966" => "Saudi Arabia",
    "221" => "Senegal",
    "381" => "Serbia",
    "248" => "Seychelles",
    "232" => "Sierra Leone",
    "65" => "Singapore",
    "421" => "Slovakia",
    "386" => "Slovenia",
    "677" => "Solomon Islands",
    "252" => "Somalia",
    "27" => "South Africa",
    "82" => "South Korea",
    "34" => "Spain",
    "94" => "Sri Lanka",
    "249" => "Sudan",
    "597" => "Suriname",
    "268" => "Swaziland",
    "46" => "Sweden",
    "41" => "Switzerland",
    "963" => "Syria",
    "886" => "Taiwan",
    "992" => "Tajikistan",
    "255" => "Tanzania",
    "66" => "Thailand",
    "670" => "Timor Leste",
    "228" => "Togo",
    "676" => "Tonga",
    "1868" => "Trinidad and Tobago",
    "216" => "Tunisia",
    "90" => "Turkey",
    "993" => "Turkmenistan",
    "1649" => "Turks and Caicos Islands",
    "256" => "Uganda",
    "380" => "Ukraine",
    "971" => "United Arab Emirates",
    "598" => "Uruguay",
    "998" => "Uzbekistan",
    "678" => "Vanuatu",
    "58" => "Venezuela",
    "84" => "Vietnam",
    "1284" => "Virgin Islands - British",
    "1340" => "Virgin Islands - United States",
    "967" => "Yemen",
    "260" => "Zambia",
    "263" => "Zimbabwe"
);
return $coutriesCode;*/

$coutriesCode=array(
   //"ccode" => '93', //Dialing country code
   //"realccode" => '93', //Actual country code
    "0" => Array
        (
            "ccode" => '93', //Dialing country code
            "cname" => 'Afghanistan',
            "cflag" => 'flagstrap-Afghanistan', 
            "realccode" => 'AF',
        ),

    "1" => Array
        (
            "ccode" => '355',
            "cname" => 'Albania',
            "cflag" => 'flagstrap-Albania',
            "realccode" => 'AL',
        ),

    "2" => Array
        (
            "ccode" => '213',
            "cname" => 'Algeria',
            "cflag" => 'flagstrap-Algeria', 
            "realccode" => 'DZ',
        ),

    "3" => Array
        (
            "ccode" => '1684',
            "cname" => 'American Samoa',
            "cflag" => 'flagstrap-American-Samoa',
            "realccode" => 'AS',
        ),

    "4" => Array
        (
            "ccode" => '376',
            "cname" => 'Andorra',
            "cflag" => 'flagstrap-Andorra',
            "realccode" => 'AD',
        ),

    "5" => Array
        (
            "ccode" => '244',
            "cname" => 'Angola',
            "cflag" => 'flagstrap-Angola', 
            "realccode" => 'AO',
        ),

    "6" => Array
        (
            "ccode" => '1264',
            "cname" => 'Anguilla',
            "cflag" => 'flagstrap-Anguilla', 
            "realccode" => 'AI',
        ),

    "7" => Array
        (
            "ccode" => '1268',
            "cname" => 'Antigua and Barbuda',
            "cflag" => 'flagstrap-Antigua-and-Barbuda', 
            "realccode" => 'AG',
        ),

    "8" => Array
        (
            "ccode" => '54',
            "cname" => 'Argentina',
            "cflag" => 'flagstrap-Argentina', 
            "realccode" => 'AR',
        ),

    "9" => Array
        (
            "ccode" => '374',
            "cname" => 'Armenia',
            "cflag" => 'flagstrap-Armenia', 
            "realccode" => 'AM',
        ),

    "10" => Array
        (
            "ccode" => '297',
            "cname" => 'Aruba',
            "cflag" => 'flagstrap-Aruba', 
            "realccode" => 'AW',
        ),

    "11" => Array
        (
            "ccode" => '61',
            "cname" => 'Australia',
            "cflag" => 'flagstrap-Australia',
            "realccode" => 'AU',
        ),

    "12" => Array
        (
            "ccode" => '43',
            "cname" => 'Austria',
            "cflag" => 'flagstrap-Austria',
            "realccode" => 'AT',
        ),

    "13" => Array
        (
            "ccode" => '994',
            "cname" => 'Azerbaijan',
            "cflag" => 'flagstrap-Azerbaijan', 
            "realccode" => 'AZ',
        ),

    "14" => Array
        (
            "ccode" => '1242',
            "cname" => 'Bahamas',
            "cflag" => 'flagstrap-Bahamas', 
            "realccode" => 'BS',
        ),

    "15" => Array
        (
            "ccode" => '973',
            "cname" => 'Bahrain',
            "cflag" => 'flagstrap-Bahrain', 
            "realccode" => 'BH',
        ),

    "16" => Array
        (
            "ccode" => '880',
            "cname" => 'Bangladesh',
            "cflag" => 'flagstrap-Bangladesh', 
            "realccode" => 'BD',
        ),

    "17" => Array
        (
            "ccode" => '1246',
            "cname" => 'Barbados',
            "cflag" => 'flagstrap-Barbados', 
            "realccode" => 'BB',
        ),

    "18" => Array
        (
            "ccode" => '375',
            "cname" => 'Belarus',
            "cflag" => 'flagstrap-Belarus', 
            "realccode" => 'BY',
        ),

    "19" => Array
        (
            "ccode" => '32',
            "cname" => 'Belgium',
            "cflag" => 'flagstrap-Belgium', 
            "realccode" => 'BE',
        ),

    "20" => Array
        (
            "ccode" => '501',
            "cname" => 'Belize',
            "cflag" => 'flagstrap-Belize', 
            "realccode" => 'BZ',
        ),

    "21" => Array
        (
            "ccode" => '229',
            "cname" => 'Benin',
            "cflag" => 'flagstrap-Benin', 
            "realccode" => 'BJ',
        ),

    "22" => Array
        (
            "ccode" => '1441',
            "cname" => 'Bermuda',
            "cflag" => 'flagstrap-Bermuda',
            "realccode" => 'BM',
        ),

    "23" => Array
        (
            "ccode" => '975',
            "cname" => 'Bhutan',
            "cflag" => 'flagstrap-Bhutan', 
            "realccode" => 'BT',
        ),

    "24" => Array
        (
            "ccode" => '591',
            "cname" => 'Bolivia',
            "cflag" => 'flagstrap-Bolivia', 
            "realccode" => 'BO',
        ),

    "25" => Array
        (
            "ccode" => '387',
            "cname" => 'Bosnia and Herzegovina',
            "cflag" => 'flagstrap-Bosnia-and-Herzegovina', 
            "realccode" => 'BA',
        ),

    "26" => Array
        (
            "ccode" => '267',
            "cname" => 'Botswana',
            "cflag" => 'flagstrap-Botswana', 
            "realccode" => 'BW',
        ),

    "27" => Array
        (
            "ccode" => '55',
            "cname" => 'Brazil',
            "cflag" => 'flagstrap-Brazil', 
            "realccode" => 'BR',
        ),

    "28" => Array
        (
            "ccode" => '673',
            "cname" => 'Brunei',
            "cflag" => 'flagstrap-Brunei', 
            "realccode" => 'BN',
        ),

    "29" => Array
        (
            "ccode" => '359',
            "cname" => 'Bulgaria',
            "cflag" => 'flagstrap-Bulgaria', 
            "realccode" => 'BG',
        ),

    "30" => Array
        (
            "ccode" => '226',
            "cname" => 'Burkina Faso',
            "cflag" => 'flagstrap-Burkina-Faso', 
            "realccode" => 'BF',
        ),

    "31" => Array
        (
            "ccode" => '257',
            "cname" => 'Burundi',
            "cflag" => 'flagstrap-Burundi', 
            "realccode" => 'BI',
        ),

    "32" => Array
        (
            "ccode" => '855',
            "cname" => 'Cambodia',
            "cflag" => 'flagstrap-Cambodia', 
            "realccode" => 'KH',
        ),

    "33" => Array
        (
            "ccode" => '237',
            "cname" => 'Cameroon',
            "cflag" => 'flagstrap-Cameroon', 
            "realccode" => 'CM',
        ),

    "34" => Array
        (
            "ccode" => '1',
            "cname" => 'Canada',
            "cflag" => 'flagstrap-Canada', 
            "realccode" => 'CA',
        ),

    "35" => Array
        (
            "ccode" => '238',
            "cname" => 'Cape Verde',
            "cflag" => 'flagstrap-Cape-Verde', 
            "realccode" => 'CV',
        ),

    "36" => Array
        (
            "ccode" => '1345',
            "cname" => 'Cayman Islands',
            "cflag" => 'flagstrap-Cayman-Islands', 
            "realccode" => 'KY',
        ),

    "37" => Array
        (
            "ccode" => '236',
            "cname" => 'Central African Republic',
            "cflag" => 'flagstrap-Central-African-Republic', 
            "realccode" => 'CF',
        ),

    "38" => Array
        (
            "ccode" => '235',
            "cname" => 'Chad',
            "cflag" => 'flagstrap-Chad', 
            "realccode" => 'TD',
        ),

    "39" => Array
        (
            "ccode" => '56',
            "cname" => 'Chile',
            "cflag" => 'flagstrap-Chile', 
            "realccode" => 'CL',
        ),

    "40" => Array
        (
            "ccode" => '86',
            "cname" => 'China',
            "cflag" => 'flagstrap-China', 
            "realccode" => 'CN',
        ),

    "41" => Array
        (
            "ccode" => '57',
            "cname" => 'Colombia',
            "cflag" => 'flagstrap-Colombia', 
            "realccode" => 'CO',
        ),

    "42" => Array
        (
            "ccode" => '269',
            "cname" => 'Comoros',
            "cflag" => 'flagstrap-Comoros', 
            "realccode" => 'KM',
        ),

    "43" => Array
        (
            "ccode" => '242',
            "cname" => 'Congo',
            "cflag" => 'flagstrap-Congo',
            "realccode" => 'CG',
        ),

    "44" => Array
        (
            "ccode" => '243',
            "cname" => 'Congo Democratic Republic',
            "cflag" => 'flagstrap-Congo-Democratic-Republic', 
            "realccode" => 'CD',
        ),

    "45" => Array
        (
            "ccode" => '682',
            "cname" => 'Cook Islands',
            "cflag" => 'flagstrap-Cook-Islands', 
            "realccode" => 'CK',    
        ),

    "46" => Array
        (
            "ccode" => '506',
            "cname" => 'Costa Rica',
            "cflag" => 'flagstrap-Costa-Rica', 
            "realccode" => 'CR',
        ),

    "47" => Array
        (
            "ccode" => '385',
            "cname" => 'Croatia',
            "cflag" => 'flagstrap-Croatia', 
            "realccode" => 'HR',
        ),

    "48" => Array
        (
            "ccode" => '53',
            "cname" => 'Cuba',
            "cflag" => 'flagstrap-Cuba', 
            "realccode" => 'CU',
        ),

    "49" => Array
        (
            "ccode" => '357',
            "cname" => 'Cyprus',
            "cflag" => 'flagstrap-Cyprus', 
            "realccode" => 'CY',
        ),

    "50" => Array
        (
            "ccode" => '420',
            "cname" => 'Czech Republic',
            "cflag" => 'flagstrap-Czech-Republic', 
            "realccode" => 'CZ',   
        ),

    "51" => Array
        (
            "ccode" => '45',
            "cname" => 'Denmark',
            "cflag" => 'flagstrap-Denmark', 
            "realccode" => 'DK',
        ),

    "52" => Array
        (
            "ccode" => '253',
            "cname" => 'Djibouti',
            "cflag" => 'flagstrap-Djibouti', 
            "realccode" => 'DJ',
        ),

    "53" => Array
        (
            "ccode" => '1767',
            "cname" => 'Dominica',
            "cflag" => 'flagstrap-Dominica', 
            "realccode" => 'DM',
        ),

    "54" => Array
        (
            "ccode" => '1809',
            "cname" => 'Dominican Republic',
            "cflag" => 'flagstrap-Dominican-Republic', 
            "realccode" => 'DO',
        ),

    "55" => Array
        (
            "ccode" => '593',
            "cname" => 'Ecuador',
            "cflag" => 'flagstrap-Ecuador', 
            "realccode" => 'EC',
        ),

    "56" => Array
        (
            "ccode" => '20',
            "cname" => 'Egypt',
            "cflag" => 'flagstrap-Egypt', 
            "realccode" => 'EG',
        ),

    "57" => Array
        (
            "ccode" => '503',
            "cname" => 'El Salvador',
            "cflag" => 'flagstrap-El-Salvador', 
            "realccode" => 'SV',
        ),

    "58" => Array
        (
            "ccode" => '240',
            "cname" => 'Equatorial Guinea',
            "cflag" => 'flagstrap-Equatorial-Guinea',
            "realccode" => 'GQ',
        ),

    "59" => Array
        (
            "ccode" => '291',
            "cname" => 'Eritrea',
            "cflag" => 'flagstrap-Eritrea', 
            "realccode" => 'ER',
        ),

    "60" => Array
        (
            "ccode" => '372',
            "cname" => 'Estonia',
            "cflag" => 'flagstrap-Estonia', 
            "realccode" => 'EE',
        ),

    "61" => Array
        (
            "ccode" => '251',
            "cname" => 'Ethiopia',
            "cflag" => 'flagstrap-Ethiopia', 
            "realccode" => 'ET',
        ),

    "62" => Array
        (
            "ccode" => '298',
            "cname" => 'Faeroe Islands',
            "cflag" => 'flagstrap-Faeroe-Islands', 
            "realccode" => 'FO',
        ),

    "63" => Array
        (
            "ccode" => '679',
            "cname" => 'Fiji',
            "cflag" => 'flagstrap-Fiji', 
            "realccode" => 'FJ',
        ),

    "64" => Array
        (
            "ccode" => '358',
            "cname" => 'Finland',
            "cflag" => 'flagstrap-Finland', 
            "realccode" => 'FI',
        ),

    "65" => Array
        (
            "ccode" => '33',
            "cname" => 'France',
            "cflag" => 'flagstrap-France', 
            "realccode" => 'FR',
        ),

    "66" => Array
        (
            "ccode" => '594',
            "cname" => 'French Guiana',
            "cflag" => 'flagstrap-French-Guiana', 
            "realccode" => 'GF',
        ),

    "67" => Array
        (
            "ccode" => '689',
            "cname" => 'French Polynesia',
            "cflag" => 'flagstrap-French-Polynesia', 
            "realccode" => 'PG',
        ),

    "68" => Array
        (
            "ccode" => '241',
            "cname" => 'Gabon',
            "cflag" => 'flagstrap-Gabon', 
            "realccode" => 'GA',
        ),

    "69" => Array
        (
            "ccode" => '220',
            "cname" => 'Gambia',
            "cflag" => 'flagstrap-Gambia', 
            "realccode" => 'GM',
        ),

    "70" => Array
        (
            "ccode" => '995',
            "cname" => 'Georgia',
            "cflag" => 'flagstrap-Georgia', 
            "realccode" => 'GE',
        ),

    "71" => Array
        (
            "ccode" => '49',
            "cname" => 'Germany',
            "cflag" => 'flagstrap-Germany', 
            "realccode" => 'DE',
        ),

    "72" => Array
        (
            "ccode" => '233',
            "cname" => 'Ghana',
            "cflag" => 'flagstrap-Ghana', 
            "realccode" => 'GH',
        ),

    "73" => Array
        (
            "ccode" => '350',
            "cname" => 'Gibraltar',
            "cflag" => 'flagstrap-Gibraltar', 
            "realccode" => 'GI',
        ),

    "74" => Array
        (
            "ccode" => '30',
            "cname" => 'Greece',
            "cflag" => 'flagstrap-Greece', 
            "realccode" => 'GR',
        ),

    "75" => Array
        (
            "ccode" => '299',
            "cname" => 'Greenland',
            "cflag" => 'flagstrap-Greenland',
            "realccode" => 'GL',
        ),

    "76" => Array
        (
            "ccode" => '1473',
            "cname" => 'Grenada',
            "cflag" => 'flagstrap-Grenada',
            "realccode" => 'GD',
        ),

    "77" => Array
        (
            "ccode" => '590',
            "cname" => 'Guadeloupe',
            "cflag" => 'flagstrap-Guadeloupe', 
            "realccode" => 'GP',
        ),

    "78" => Array
        (
            "ccode" => '1671',
            "cname" => 'Guam',
            "cflag" => 'flagstrap-Guam', 
            "realccode" => 'GU',
        ),

    "79" => Array
        (
            "ccode" => '502',
            "cname" => 'Guatemala',
            "cflag" => 'flagstrap-Guatemala', 
            "realccode" => 'GT',
        ),

    "80" => Array
        (
            "ccode" => '224',
            "cname" => 'Guinea',
            "cflag" => 'flagstrap-Guinea', 
            "realccode" => 'GN',
        ),

    "81" => Array
        (
            "ccode" => '245',
            "cname" => 'Guinea Bissau',
            "cflag" => 'flagstrap-Guinea-Bissau', 
            "realccode" => 'GW',
        ),

    "82" => Array
        (
            "ccode" => '592',
            "cname" => 'Guyana',
            "cflag" => 'flagstrap-Guyana', 
            "realccode" => 'GY',
        ),

    "83" => Array
        (
            "ccode" => '509',
            "cname" => 'Haiti',
            "cflag" => 'flagstrap-Haiti', 
            "realccode" => 'HT',
        ),

    "84" => Array
        (
            "ccode" => '504',
            "cname" => 'Honduras',
            "cflag" => 'flagstrap-Honduras', 
            "realccode" => 'HN',
        ),

    "85" => Array
        (
            "ccode" => '852',
            "cname" => 'Hong Kong',
            "cflag" => 'flagstrap-Hong-Kong', 
            "realccode" => 'HK',
        ),

    "86" => Array
        (
            "ccode" => '36',
            "cname" => 'Hungary',
            "cflag" => 'flagstrap-Hungary', 
            "realccode" => 'HU',
        ),

    "87" => Array
        (
            "ccode" => '354',
            "cname" => 'Iceland',
            "cflag" => 'flagstrap-Iceland', 
            "realccode" => 'IS',
        ),

    "88" => Array
        (
            "ccode" => '91',
            "cname" => 'India',
            "cflag" => 'flagstrap-India', 
            "realccode" => 'IN',
        ),

    "89" => Array
        (
            "ccode" => '62',
            "cname" => 'Indonesia',
            "cflag" => 'flagstrap-Indonesia', 
            "realccode" => 'ID',
        ),

    "90" => Array
        (
            "ccode" => '98',
            "cname" => 'Iran',
            "cflag" => 'flagstrap-Iran', 
            "realccode" => 'IR',
        ),

    "91" => Array
        (
            "ccode" => '964',
            "cname" => 'Iraq',
            "cflag" => 'flagstrap-Iraq', 
            "realccode" => 'IQ',
        ),

    "92" => Array
        (
            "ccode" => '353',
            "cname" => 'Ireland',
            "cflag" => 'flagstrap-Ireland', 
            "realccode" => 'IE',
        ),

    "93" => Array
        (
            "ccode" => '44',
            "cname" => 'United Kingdom',
            "cflag" => 'flagstrap-United-Kingdom', 
            "realccode" => 'GB',
        ),

    "94" => Array
        (
            "ccode" => '972',
            "cname" => 'Israel',
            "cflag" => 'flagstrap-Israel', 
            "realccode" => 'IL',
        ),

    "95" => Array
        (
            "ccode" => '39',
            "cname" => 'Italy',
            "cflag" => 'flagstrap-Italy', 
            "realccode" => 'IT',
        ),

    "96" => Array
        (
            "ccode" => '1876',
            "cname" => 'Jamaica',
            "cflag" => 'flagstrap-Jamaica', 
            "realccode" => 'JM',
        ),

    "97" => Array
        (
            "ccode" => '81',
            "cname" => 'Japan',
            "cflag" => 'flagstrap-Japan', 
            "realccode" => 'JP',
        ),

    "98" => Array
        (
            "ccode" => '962',
            "cname" => 'Jordan',
            "cflag" => 'flagstrap-Jordan', 
            "realccode" => 'JO',
        ),

    "99" => Array
        (
            "ccode" => '7',
            "cname" => 'Russia',
            "cflag" => 'flagstrap-Russia', 
            "realccode" => 'RU',
        ),

    "100" => Array
        (
            "ccode" => '254',
            "cname" => 'Kenya',
            "cflag" => 'flagstrap-Kenya', 
            "realccode" => 'KE',
        ),

    "101" => Array
        (
            "ccode" => '686',
            "cname" => 'Kiribati',
            "cflag" => 'flagstrap-Kiribati',
            "realccode" => 'KI',
        ),

    "102" => Array
        (
            "ccode" => '965',
            "cname" => 'Kuwait',
            "cflag" => 'flagstrap-Kuwait', 
            "realccode" => 'KW',
        ),

    "103" => Array
        (
            "ccode" => '996',
            "cname" => 'Kyrgyzstan',
            "cflag" => 'flagstrap-Kyrgyzstan', 
            "realccode" => 'KG',
        ),

    "104" => Array
        (
            "ccode" => '856',
            "cname" => 'Laos',
            "cflag" => 'flagstrap-Laos', 
            "realccode" => 'LA',
        ),

    "105" => Array
        (
            "ccode" => '371',
            "cname" => 'Latvia',
            "cflag" => 'flagstrap-Latvia', 
            "realccode" => 'LV',
        ),

    "106" => Array
        (
            "ccode" => '961',
            "cname" => 'Lebanon',
            "cflag" => 'flagstrap-Lebanon', 
            "realccode" => 'LB',
        ),

    "107" => Array
        (
            "ccode" => '266',
            "cname" => 'Lesotho',
            "cflag" => 'flagstrap-Lesotho', 
            "realccode" => 'LS',
        ),

    "108" => Array
        (
            "ccode" => '231',
            "cname" => 'Liberia',
            "cflag" => 'flagstrap-Liberia', 
            "realccode" => 'LR',
        ),

    "109" => Array
        (
            "ccode" => '218',
            "cname" => 'Libya',
            "cflag" => 'flagstrap-Libya', 
            "realccode" => 'LY',
        ),

    "110" => Array
        (
            "ccode" => '423',
            "cname" => 'Liechtenstein',
            "cflag" => 'flagstrap-Liechtenstein', 
            "realccode" => 'LI',
        ),

    "111" => Array
        (
            "ccode" => '370',
            "cname" => 'Lithuania',
            "cflag" => 'flagstrap-Lithuania', 
            "realccode" => 'LT',
        ),

    "112" => Array
        (
            "ccode" => '352',
            "cname" => 'Luxembourg',
            "cflag" => 'flagstrap-Luxembourg', 
            "realccode" => 'Lu',
        ),

    "113" => Array
        (
            "ccode" => '853',
            "cname" => 'Macao',
            "cflag" => 'flagstrap-Macao',
            "realccode" => 'MO',
        ),

    "114" => Array
        (
            "ccode" => '389',
            "cname" => 'Macedonia',
            "cflag" => 'flagstrap-Macedonia', 
            "realccode" => 'MK',
        ),

    "115" => Array
        (
            "ccode" => '261',
            "cname" => 'Madagascar',
            "cflag" => 'flagstrap-Madagascar', 
            "realccode" => 'MG',
        ),

    "116" => Array
        (
            "ccode" => '265',
            "cname" => 'Malawi',
            "cflag" => 'flagstrap-Malawi', 
            "realccode" => 'MW',
        ),

    "117" => Array
        (
            "ccode" => '60',
            "cname" => 'Malaysia',
            "cflag" => 'flagstrap-Malaysia', 
            "realccode" => 'MY',
        ),

    "118" => Array
        (
            "ccode" => '960',
            "cname" => 'Maldives',
            "cflag" => 'flagstrap-Maldives',
            "realccode" => 'MV',
        ),

    "119" => Array
        (
            "ccode" => '223',
            "cname" => 'Mali',
            "cflag" => 'flagstrap-Mali', 
            "realccode" => 'ML',
        ),

    "120" => Array
        (
            "ccode" => '356',
            "cname" => 'Malta',
            "cflag" => 'flagstrap-Malta',
            "realccode" => 'MT',
        ),

    "121" => Array
        (
            "ccode" => '596',
            "cname" => 'Martinique',
            "cflag" => 'flagstrap-Martinique', 
            "realccode" => 'MQ',
        ),

    "122" => Array
        (
            "ccode" => '222',
            "cname" => 'Mauritania',
            "cflag" => 'flagstrap-Mauritania', 
            "realccode" => 'MR',
        ),

    "123" => Array
        (
            "ccode" => '230',
            "cname" => 'Mauritius',
            "cflag" => 'flagstrap-Mauritius', 
            "realccode" => 'MU',
        ),

    "124" => Array
        (
            "ccode" => '52',
            "cname" => 'Mexico',
            "cflag" => 'flagstrap-Mexico', 
            "realccode" => 'MX',
        ),

    "125" => Array
        (
            "ccode" => '691',
            "cname" => 'Micronesia',
            "cflag" => 'flagstrap-Micronesia', 
            "realccode" => 'FM',
        ),

    "126" => Array
        (
            "ccode" => '373',
            "cname" => 'Moldova',
            "cflag" => 'flagstrap-Moldova', 
            "realccode" => 'MD',
        ),

    "127" => Array
        (
            "ccode" => '377',
            "cname" => 'Monaco',
            "cflag" => 'flagstrap-Monaco', 
            "realccode" => 'MC',
        ),

    "128" => Array
        (
            "ccode" => '976',
            "cname" => 'Mongolia',
            "cflag" => 'flagstrap-Mongolia', 
            "realccode" => 'MN',
        ),

    "129" => Array
        (
            "ccode" => '382',
            "cname" => 'Montenegro',
            "cflag" => 'flagstrap-Montenegro', 
            "realccode" => 'ME',
        ),

    "130" => Array
        (
            "ccode" => '1664',
            "cname" => 'Montserrat',
            "cflag" => 'flagstrap-Montserrat', 
            "realccode" => 'MS',
        ),

    "131" => Array
        (
            "ccode" => '212',
            "cname" => 'Morocco',
            "cflag" => 'flagstrap-Morocco', 
            "realccode" => 'MA',
        ),

    "132" => Array
        (
            "ccode" => '258',
            "cname" => 'Mozambique',
            "cflag" => 'flagstrap-Mozambique', 
            "realccode" => 'MZ',
        ),

    "133" => Array
        (
            "ccode" => '95',
            "cname" => 'Myanmar',
            "cflag" => 'flagstrap-Myanmar', 
            "realccode" => 'MM',
        ),

    "134" => Array
        (
            "ccode" => '264',
            "cname" => 'Namibia',
            "cflag" => 'flagstrap-Namibia', 
            "realccode" => 'NA',
        ),

    "135" => Array
        (
            "ccode" => '674',
            "cname" => 'Nauru',
            "cflag" => 'flagstrap-Nauru', 
            "realccode" => 'NR',
        ),

    "136" => Array
        (
            "ccode" => '977',
            "cname" => 'Nepal',
            "cflag" => 'flagstrap-Nepal', 
            "realccode" => 'NP',
        ),

    "137" => Array
        (
            "ccode" => '31',
            "cname" => 'Netherlands',
            "cflag" => 'flagstrap-Netherlands', 
            "realccode" => 'NL',
        ),

    "138" => Array
        (
            "ccode" => '599',
            "cname" => 'Netherlands Antilles',
            "cflag" => 'flagstrap-Netherlands-Antilles', 
            "realccode" => 'AN',
        ),

    "139" => Array
        (
            "ccode" => '687',
            "cname" => 'New Caledonia',
            "cflag" => 'flagstrap-New-Caledonia',
            "realccode" => 'NC',
        ),

    "140" => Array
        (
            "ccode" => '64',
            "cname" => 'New Zealand',
            "cflag" => 'flagstrap-New-Zealand', 
            "realccode" => 'NZ',
        ),

    "141" => Array
        (
            "ccode" => '505',
            "cname" => 'Nicaragua',
            "cflag" => 'flagstrap-Nicaragua', 
            "realccode" => 'NI',
        ),

    "142" => Array
        (
            "ccode" => '227',
            "cname" => 'Niger',
            "cflag" => 'flagstrap-Niger', 
            "realccode" => 'NE',
        ),

    "143" => Array
        (
            "ccode" => '234',
            "cname" => 'Nigeria',
            "cflag" => 'flagstrap-Nigeria', 
            "realccode" => 'NG',
        ),

    "144" => Array
        (
            "ccode" => '683',
            "cname" => 'Niue',
            "cflag" => 'flagstrap-Niue', 
            "realccode" => 'NU',
        ),

    "145" => Array
        (
            "ccode" => '850',
            "cname" => 'North Korea',
            "cflag" => 'flagstrap-North-Korea',
            "realccode" => 'KR',
        ),

    "146" => Array
        (
            "ccode" => '1670',
            "cname" => 'Northern Mariana Islands',
            "cflag" => 'flagstrap-Northern-Mariana-Islands', 
            "realccode" => 'MP',
        ),

    "147" => Array
        (
            "ccode" => '47',
            "cname" => 'Norway',
            "cflag" => 'flagstrap-Norway', 
            "realccode" => 'NO',
        ),

    "148" => Array
        (
            "ccode" => '968',
            "cname" => 'Oman',
            "cflag" => 'flagstrap-Oman', 
            "realccode" => 'OM',
        ),

    "149" => Array
        (
            "ccode" => '92',
            "cname" => 'Pakistan',
            "cflag" => 'flagstrap-Pakistan',
            "realccode" => 'PK',
        ),

    "150" => Array
        (
            "ccode" => '680',
            "cname" => 'Palau',
            "cflag" => 'flagstrap-Palau', 
            "realccode" => 'PW',
        ),

    "151" => Array
        (
            "ccode" => '507',
            "cname" => 'Panama',
            "cflag" => 'flagstrap-Panama', 
            "realccode" => 'PA',
        ),

    "152" => Array
        (
            "ccode" => '675',
            "cname" => 'Papua New Guinea',
            "cflag" => 'flagstrap-Papua-New-Guinea', 
            "realccode" => 'PG',
        ),

    "153" => Array
        (
            "ccode" => '595',
            "cname" => 'Paraguay',
            "cflag" => 'flagstrap-Paraguay', 
            "realccode" => 'PY',
        ),

    "154" => Array
        (
            "ccode" => '51',
            "cname" => 'Peru',
            "cflag" => 'flagstrap-Peru', 
            "realccode" => 'PE',
        ),

    "155" => Array
        (
            "ccode" => '63',
            "cname" => 'Philippines',
            "cflag" => 'flagstrap-Philippines', 
            "realccode" => 'PH',
        ),

    "156" => Array
        (
            "ccode" => '48',
            "cname" => 'Poland',
            "cflag" => 'flagstrap-Poland',
            "realccode" => 'PL',
        ),

    "157" => Array
        (
            "ccode" => '351',
            "cname" => 'Portugal',
            "cflag" => 'flagstrap-Portugal', 
            "realccode" => 'PT',
        ),

    "158" => Array
        (
            "ccode" => '974',
            "cname" => 'Qatar',
            "cflag" => 'flagstrap-Qatar', 
            "realccode" => 'QA',
        ),

    "159" => Array
        (
            "ccode" => '262',
            "cname" => 'Reunion',
            "cflag" => 'flagstrap-Reunion', 
            "realccode" => 'RE',
        ),

    "160" => Array
        (
            "ccode" => '40',
            "cname" => 'Romania',
            "cflag" => 'flagstrap-Romania', 
            "realccode" => 'RO',
        ),

    "161" => Array
        (
            "ccode" => '250',
            "cname" => 'Rwanda',
            "cflag" => 'flagstrap-Rwanda', 
            "realccode" => 'RW',
        ),

    "162" => Array
        (
            "ccode" => '1869',
            "cname" => 'Saint Kitts and Nevis',
            "cflag" => 'flagstrap-Saint-Kitts-And-Nevis', 
            "realccode" => 'KN',
        ),

    "163" => Array
        (
            "ccode" => '1758',
            "cname" => 'Saint Lucia',
            "cflag" => 'flagstrap-Saint-Lucia', 
            "realccode" => 'LC',
        ),

    "164" => Array
        (
            "ccode" => '1599',
            "cname" => 'Saint Martin',
            "cflag" => 'flagstrap-Saint-Martin', 
            "realccode" => 'MF',
        ),

    "165" => Array
        (
            "ccode" => '508',
            "cname" => 'Saint Pierre and Miquelon',
            "cflag" => 'flagstrap-Saint-Pierre-and-Miquelon',
            "realccode" => 'PM',
        ),

    "166" => Array
        (
            "ccode" => '685',
            "cname" => 'Samoa',
            "cflag" => 'flagstrap-Samoa', 
            "realccode" => 'WS',
        ),

    "167" => Array
        (
            "ccode" => '378',
            "cname" => 'San Marino',
            "cflag" => 'flagstrap-San-Marino', 
            "realccode" => 'SM',
        ),

    "168" => Array
        (
            "ccode" => '239',
            "cname" => 'Sao Tome and Principe',
            "cflag" => 'flagstrap-Sao-Tome-and-Principe', 
            "realccode" => 'ST',
        ),

    "169" => Array
        (
            "ccode" => '966',
            "cname" => 'Saudi Arabia',
            "cflag" => 'flagstrap-Saudi-Arabia', 
            "realccode" => 'SA',
        ),

    "170" => Array
        (
            "ccode" => '221',
            "cname" => 'Senegal',
            "cflag" => 'flagstrap-Senegal', 
            "realccode" => 'SN',
        ),

    "171" => Array
        (
            "ccode" => '381',
            "cname" => 'Serbia',
            "cflag" => 'flagstrap-Serbia',
            "realccode" => 'RS',
        ),

    "172" => Array
        (
            "ccode" => '248',
            "cname" => 'Seychelles',
            "cflag" => 'flagstrap-Seychelles', 
            "realccode" => 'SC',
        ),

    "173" => Array
        (
            "ccode" => '232',
            "cname" => 'Sierra Leone',
            "cflag" => 'flagstrap-Sierra-Leone', 
            "realccode" => 'SL',
        ),

    "174" => Array
        (
            "ccode" => '65',
            "cname" => 'Singapore',
            "cflag" => 'flagstrap-Singapore', 
            "realccode" => 'SG',
        ),

    "175" => Array
        (
            "ccode" => '421',
            "cname" => 'Slovakia',
            "cflag" => 'flagstrap-Slovakia', 
            "realccode" => 'SK',
        ),

    "176" => Array
        (
            "ccode" => '386',
            "cname" => 'Slovenia',
            "cflag" => 'flagstrap-Slovenia', 
            "realccode" => 'SI',
        ),

    "177" => Array
        (
            "ccode" => '677',
            "cname" => 'Solomon Islands',
            "cflag" => 'flagstrap-Solomon-Islands', 
            "realccode" => 'SB',
        ),

    "178" => Array
        (
            "ccode" => '252',
            "cname" => 'Somalia',
            "cflag" => 'flagstrap-Somalia', 
            "realccode" => 'SO',
        ),

    "179" => Array
        (
            "ccode" => '27',
            "cname" => 'South Africa',
            "cflag" => 'flagstrap-South-Africa', 
            "realccode" => 'ZA',
        ),

    "180" => Array
        (
            "ccode" => '82',
            "cname" => 'South Korea',
            "cflag" => 'flagstrap-South-Korea', 
            "realccode" => 'KR',
        ),

    "181" => Array
        (
            "ccode" => '34',
            "cname" => 'Spain',
            "cflag" => 'flagstrap-Spain', 
            "realccode" => 'ES',
        ),

    "182" => Array
        (
            "ccode" => '94',
            "cname" => 'Sri Lanka',
            "cflag" => 'flagstrap-Sri-Lanka', 
            "realccode" => 'LK',
        ),

    "183" => Array
        (
            "ccode" => '249',
            "cname" => 'Sudan',
            "cflag" => 'flagstrap-Sudan', 
            "realccode" => 'SD',
        ),

    "184" => Array
        (
            "ccode" => '597',
            "cname" => 'Suriname',
            "cflag" => 'flagstrap-Suriname', 
            "realccode" => 'SR',
        ),

    "185" => Array
        (
            "ccode" => '268',
            "cname" => 'Swaziland',
            "cflag" => 'flagstrap-Swaziland', 
            "realccode" => 'SZ',
        ),

    "186" => Array
        (
            "ccode" => '46',
            "cname" => 'Sweden',
            "cflag" => 'flagstrap-Sweden', 
            "realccode" => 'EE',
        ),

    "187" => Array
        (
            "ccode" => '41',
            "cname" => 'Switzerland',
            "cflag" => 'flagstrap-Switzerland', 
            "realccode" => 'CH',
        ),

    "188" => Array
        (
            "ccode" => '963',
            "cname" => 'Syria',
            "cflag" => 'flagstrap-Syria', 
            "realccode" => 'SY',
        ),

    "189" => Array
        (
            "ccode" => '886',
            "cname" => 'Taiwan',
            "cflag" => 'flagstrap-Taiwan', 
            "realccode" => 'TW',
        ),

    "190" => Array
        (
            "ccode" => '992',
            "cname" => 'Tajikistan',
            "cflag" => 'flagstrap-Tajikistan', 
            "realccode" => 'TJ',
        ),

    "191" => Array
        (
            "ccode" => '255',
            "cname" => 'Tanzania',
            "cflag" => 'flagstrap-Tanzania', 
            "realccode" => 'TZ',
        ),

    "192" => Array
        (
            "ccode" => '66',
            "cname" => 'Thailand',
            "cflag" => 'flagstrap-Thailand',
            "realccode" => 'TH',
        ),

    "193" => Array
        (
            "ccode" => '670',
            "cname" => 'Timor Leste',
            "cflag" => 'flagstrap-Timor-Leste', 
            "realccode" => 'TL',
        ),

    "194" => Array
        (
            "ccode" => '228',
            "cname" => 'Togo',
            "cflag" => 'flagstrap-Togo', 
            "realccode" => 'TG',
        ),

    "195" => Array
        (
            "ccode" => '676',
            "cname" => 'Tonga',
            "cflag" => 'flagstrap-Tonga', 
            "realccode" => 'TO',
        ),

    "196" => Array
        (
            "ccode" => '1868',
            "cname" => 'Trinidad and Tobago',
            "cflag" => 'flagstrap-Trinidad-and-Tobago', 
            "realccode" => 'TT',
        ),

    "197" => Array
        (
            "ccode" => '216',
            "cname" => 'Tunisia',
            "cflag" => 'flagstrap-Tunisia', 
            "realccode" => 'TN',
        ),

    "198" => Array
        (
            "ccode" => '90',
            "cname" => 'Turkey',
            "cflag" => 'flagstrap-Turkey', 
            "realccode" => 'TR',
        ),

    "199" => Array
        (
            "ccode" => '993',
            "cname" => 'Turkmenistan',
            "cflag" => 'flagstrap-Turkmenistan', 
            "realccode" => 'TM',
        ),

    "200" => Array
        (
            "ccode" => '1649',
            "cname" => 'Turks and Caicos Islands',
            "cflag" => 'flagstrap-Turks-and-Caicos-Islands', 
            "realccode" => 'TC',
        ),

    "201" => Array
        (
            "ccode" => '256',
            "cname" => 'Uganda',
            "cflag" => 'flagstrap-Uganda', 
            "realccode" => 'UG',
        ),

    "202" => Array
        (
            "ccode" => '380',
            "cname" => 'Ukraine',
            "cflag" => 'flagstrap-Ukraine', 
            "realccode" => 'UA',
        ),

    "203" => Array
        (
            "ccode" => '971',
            "cname" => 'United Arab Emirates',
            "cflag" => 'flagstrap-United-Arab-Emirates', 
            "realccode" => 'AE',
        ),

    "204" => Array
        (
            "ccode" => '598',
            "cname" => 'Uruguay',
            "cflag" => 'flagstrap-Uruguay',
            "realccode" => 'UY',
        ),

    "205" => Array
        (
            "ccode" => '998',
            "cname" => 'Uzbekistan',
            "cflag" => 'flagstrap-Uzbekistan', 
            "realccode" => 'UZ',
        ),

    "206" => Array
        (
            "ccode" => '678',
            "cname" => 'Vanuatu',
            "cflag" => 'flagstrap-Vanuatu', 
            "realccode" => 'VU',
        ),

    "207" => Array
        (
            "ccode" => '58',
            "cname" => 'Venezuela',
            "cflag" => 'flagstrap-Venezuela', 
            "realccode" => 'VE',
        ),

    "208" => Array
        (
            "ccode" => '84',
            "cname" => 'Vietnam',
            "cflag" => 'flagstrap-Vietnam', 
            "realccode" => 'VN',
        ),

    "209" => Array
        (
            "ccode" => '967',
            "cname" => 'Yemen',
            "cflag" => 'flagstrap-Yemen', 
            "realccode" => 'YE',
        ),

    "210" => Array
        (
            "ccode" => '260',
            "cname" => 'Zambia',
            "cflag" => 'flagstrap-Zambia', 
            "realccode" => 'ZM',
        ),

    "211" => Array
        (
            "ccode" => '263',
            "cname" => 'Zimbabwe',
            "cflag" => 'flagstrap-Zimbabwe',
            "realccode" => 'ZW',
        ),

    "212" => Array
        (
            "ccode" => '1',
            "cname" => 'United States',
            "cflag" => 'flagstrap-United-States',
            "realccode" => 'US',
        ),

    "213" => Array
        (
            "ccode" => '255',
            "cname" => "Cote D'ivoire",
            "cflag" => 'flagstrap-Cote-D-Ivoire',
            "realccode" => 'CI',
        ),

    "214" => Array
        (
            "ccode" => '500',
            "cname" => 'Falkland Islands Malvinas',
            "cflag" => 'flagstrap-Falkland-Islands-Malvinas',
            "realccode" => 'FK',
        ),

    "215" => Array
        (
            "ccode" => '1284',
            "cname" => 'Virgin Islands British',
            "cflag" => 'flagstrap-Virgin-Islands-British',
            "realccode" => 'VG',
        ),

    "216" => Array
        (
            "ccode" => '1340',
            "cname" => 'Virgin Islands United States',
            "cflag" => 'flagstrap-Virgin-Islands-United-States',
            "realccode" => 'VI',
        )     
 
);
return $coutriesCode;
}    
public static function getCountrieslist($id = null) 
{ 
$countries = array(
"AF"=>"Afghanistan", 
"AX"=>"Aland Islands",
"AL"=>"Albania",
"DZ"=>"Algeria",
"AS"=>"American Samoa",
"AD"=>"Andorra",
"AO"=>"Angola",
"AI"=>"Anguilla",
"AQ"=>"Antarctica",
"AG"=>"Antigua And Barbuda",
"AR"=>"Argentina",
"AM"=>"Armenia",
"AW"=>"Aruba",
"AU"=>"Australia",
"AT"=>"Austria",
"AZ"=>"Azerbaijan",
"BS"=>"Bahamas",
"BH"=>"Bahrain",
"BD"=>"Bangladesh",
"BB"=>"Barbados",
"BY"=>"Belarus",
"BE"=>"Belgium",
"BZ"=>"Belize",
"BJ"=>"Benin",
"BM"=>"Bermuda",
"BT"=>"Bhutan",
"BO"=>"Bolivia",
"BA"=>"Bosnia And Herzegovina",
"BW"=>"Botswana",
"BV"=>"Bouvet Island",
"BR"=>"Brazil",
"IO"=>"British Indian Ocean Territory",
"BN"=>"Brunei Darussalam",
"BG"=>"Bulgaria",
"BF"=>"Burkina Faso",
"BI"=>"Burundi",
"KH"=>"Cambodia",
"CM"=>"Cameroon",
"CA"=>"Canada",
"CV"=>"Cape Verde",
"KY"=>"Cayman Islands",
"CF"=>"Central African Republic",
"TD"=>"Chad",
"CL"=>"Chile",
"CN"=>"China",
"CX"=>"Christmas Island",
"CC"=>"Cocos (Keeling) Islands",
"CO"=>"Colombia",
"KM"=>"Comoros",
"CG"=>"Congo",
"CD"=>"Congo, Democratic Republic",
"CK"=>"Cook Islands",
"CR"=>"Costa Rica",
"CI"=>"Cote D'Ivoire",
"HR"=>"Croatia",
"CU"=>"Cuba",
"CW"=>"Curacao",
"CY"=>"Cyprus",
"CZ"=>"Czech Republic",
"DK"=>"Denmark",
"DJ"=>"Djibouti",
"DM"=>"Dominica",
"DO"=>"Dominican Republic",
"EC"=>"Ecuador",
"EG"=>"Egypt",
"SV"=>"El Salvador",
"GQ"=>"Equatorial Guinea",
"ER"=>"Eritrea",
"EE"=>"Estonia",
"ET"=>"Ethiopia",
"FK"=>"Falkland Islands (Malvinas)",
"FO"=>"Faroe Islands",
"FJ"=>"Fiji",
"FI"=>"Finland",
"FR"=>"France",
"GF"=>"French Guiana",
"PF"=>"French Polynesia",
"TF"=>"French Southern Territories",
"GA"=>"Gabon",
"GM"=>"Gambia",
"GE"=>"Georgia",
"DE"=>"Germany",
"GH"=>"Ghana",
"GI"=>"Gibraltar",
"GR"=>"Greece",
"GL"=>"Greenland",
"GD"=>"Grenada",
"GP"=>"Guadeloupe",
"GU"=>"Guam",
"GT"=>"Guatemala",
"GG"=>"Guernsey",
"GN"=>"Guinea",
"GW"=>"Guinea-Bissau",
"GY"=>"Guyana",
"HT"=>"Haiti",
"HM"=>"Heard Island & Mcdonald Islands",
"VA"=>"Holy See (Vatican City State)",
"HN"=>"Honduras",
"HK"=>"Hong Kong",
"HU"=>"Hungary",
"IS"=>"Iceland",
"IN"=>"India",
"ID"=>"Indonesia",
"IR"=>"Iran, Islamic Republic Of",
"IQ"=>"Iraq",
"IE"=>"Ireland",
"IM"=>"Isle Of Man",
"IL"=>"Israel",
"IT"=>"Italy",
"JM"=>"Jamaica",
"JP"=>"Japan",
"JE"=>"Jersey",
"JO"=>"Jordan",
"KZ"=>"Kazakhstan",
"KE"=>"Kenya",
"KI"=>"Kiribati",
"KR"=>"Korea",
"KW"=>"Kuwait",
"KG"=>"Kyrgyzstan",
"LA"=>"Lao People's Democratic Republic",
"LV"=>"Latvia",
"LB"=>"Lebanon",
"LS"=>"Lesotho",
"LR"=>"Liberia",
"LY"=>"Libyan Arab Jamahiriya",
"LI"=>"Liechtenstein",
"LT"=>"Lithuania",
"LU"=>"Luxembourg",
"MO"=>"Macao",
"MK"=>"Macedonia",
"MG"=>"Madagascar",
"MW"=>"Malawi",
"MY"=>"Malaysia",
"MV"=>"Maldives",
"ML"=>"Mali",
"MT"=>"Malta",
"MH"=>"Marshall Islands",
"MQ"=>"Martinique",
"MR"=>"Mauritania",
"MU"=>"Mauritius",
"YT"=>"Mayotte",
"MX"=>"Mexico",
"FM"=>"Micronesia, Federated States Of",
"MD"=>"Moldova",
"MC"=>"Monaco",
"MN"=>"Mongolia",
"ME"=>"Montenegro",
"MS"=>"Montserrat",
"MA"=>"Morocco",
"MZ"=>"Mozambique",
"MM"=>"Myanmar",
"NA"=>"Namibia",
"NR"=>"Nauru",
"NP"=>"Nepal",
"NL"=>"Netherlands",
"AN"=>"Netherlands Antilles",
"NC"=>"New Caledonia",
"NZ"=>"New Zealand",
"NI"=>"Nicaragua",
"NE"=>"Niger",
"NG"=>"Nigeria",
"NU"=>"Niue",
"NF"=>"Norfolk Island",
"MP"=>"Northern Mariana Islands",
"NO"=>"Norway",
"OM"=>"Oman",
"PK"=>"Pakistan",
"PW"=>"Palau",
"PS"=>"Palestinian Territory, Occupied",
"PA"=>"Panama",
"PG"=>"Papua New Guinea",
"PY"=>"Paraguay",
"PE"=>"Peru",
"PH"=>"Philippines",
"PN"=>"Pitcairn",
"PL"=>"Poland",
"PT"=>"Portugal",
"PR"=>"Puerto Rico",
"QA"=>"Qatar",
"RE"=>"Reunion",
"RO"=>"Romania",
"RU"=>"Russian Federation",
"RW"=>"Rwanda",
"BL"=>"Saint Barthelemy",
"SH"=>"Saint Helena",
"KN"=>"Saint Kitts And Nevis",
"LC"=>"Saint Lucia",
"MF"=>"Saint Martin",
"PM"=>"Saint Pierre And Miquelon",
"VC"=>"Saint Vincent And Grenadines",
"WS"=>"Samoa",
"SM"=>"San Marino",
"ST"=>"Sao Tome And Principe",
"SA"=>"Saudi Arabia",
"SN"=>"Senegal",
"RS"=>"Serbia",
"SC"=>"Seychelles",
"SL"=>"Sierra Leone",
"SG"=>"Singapore",
"SK"=>"Slovakia",
"SI"=>"Slovenia",
"SB"=>"Solomon Islands",
"SO"=>"Somalia",
"ZA"=>"South Africa",
"GS"=>"South Georgia And Sandwich Isl.",
"ES"=>"Spain",
"LK"=>"Sri Lanka",
"SD"=>"Sudan",
"SR"=>"Suriname",
"SJ"=>"Svalbard And Jan Mayen",
"SZ"=>"Swaziland",
"SE"=>"Sweden",
"CH"=>"Switzerland",
"SY"=>"Syrian Arab Republic",
"TW"=>"Taiwan",
"TJ"=>"Tajikistan",
"TZ"=>"Tanzania",
"TH"=>"Thailand",
"TL"=>"Timor-Leste",
"TG"=>"Togo",
"TK"=>"Tokelau",
"TO"=>"Tonga",
"TT"=>"Trinidad And Tobago",
"TN"=>"Tunisia",
"TR"=>"Turkey",
"TM"=>"Turkmenistan",
"TC"=>"Turks And Caicos Islands",
"TV"=>"Tuvalu",
"UG"=>"Uganda",
"UA"=>"Ukraine",
"AE"=>"United Arab Emirates",
"GB"=>"United Kingdom",
"US"=>"United States",
"UM"=>"United States Outlying Islands",
"UY"=>"Uruguay",
"UZ"=>"Uzbekistan",
"VU"=>"Vanuatu",
"VE"=>"Venezuela",
"VN"=>"Viet Nam",
"VG"=>"Virgin Islands, British",
"VI"=>"Virgin Islands, U.S.",
"WF"=>"Wallis And Futuna",
"EH"=>"Western Sahara",
"YE"=>"Yemen",
"ZM"=>"Zambia",
"ZW"=>"Zimbabwe"
);
asort($countries);
return (!empty($id))?$countries[$id]:$countries;
}

    public static function sendOTP($mobile) {
        $otpapikey = Config::get('Constant.otp_apikey');
        $smsTemplateName = 'HostITSmart';
        $mobile="+".$mobile;
        $apiurl = "https://2factor.in/API/V1/".$otpapikey."/SMS/".$mobile."/AUTOGEN/".$smsTemplateName;

        $ch = curl_init($apiurl);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        $result = curl_exec($ch);
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (sendOTP): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        $currentTime = now(); // Current timestamp
        Session::put('otp_time', $currentTime);

        curl_close($ch);
        $jsonData = json_decode($result,true);
        return $jsonData;
    }

    public static function doOTPVerification($sess_id,$otp) {
        $otpapikey = Config::get('Constant.otp_apikey');
        $apiurl = "https://2factor.in/API/V1/".$otpapikey."/SMS/VERIFY/".$sess_id."/".$otp;
        $ch = curl_init($apiurl);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        $result = curl_exec($ch);
        
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (sendOTP): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }

        curl_close($ch);
        $jsonData = json_decode($result,true);
        return $jsonData['Details'];
    }
    public static function getResellerCenterInterestedIn($id = null){
            $interestedin = array();
            $interestedin[1] = "All Products";
            $interestedin[2] = "Domains";
            $interestedin[3] = "Shared Hosting";
            $interestedin[4] = "Reseller Hosting";
            $interestedin[5] = "Dedicated server";
            $interestedin[6] = "VPS Hosting";
            $interestedin[7] = "Email (G Suite, Office365, Microsoft365)";
            $interestedin[8] = "Website Builder";
            $interestedin[9] = "SSL Certificates";
            $interestedin[10] = "AWS Support";
            return (!empty($id))?$interestedin[$id]:$interestedin;
    }
    public static function getResellerCenterBusinessType($id = null){
        $businesstype = array();
        $businesstype[1] = "Hosting Provider"; 
        $businesstype[2] = "IT Consultant";
        $businesstype[3] = "Digital Agency";
        $businesstype[4] = "Web Developer";
        $businesstype[5] = "SaaS Platform";
        $businesstype[6] = "Other";
        return (!empty($id))?$businesstype[$id]:$businesstype;
    }
    public static function getResellerCenterTotalCustomerPaying($id = null){
       $payingtype = array();
        $payingtype[1] = "Less than 500"; 
        $payingtype[2] = "501 - 2,000";
        $payingtype[3] = "2,001 - 5,000";
        $payingtype[4] = "5000+";
       return (!empty($id))?$payingtype[$id]:$payingtype;
    }
    
    public static function additionalfields()
    {
        $_LANG=array();
$_LANG['domains']['deTermsDescription1'] = "To register a new domain, transfer or change registrant information the registrant must explicitly accept the .DE terms and conditions.";
$_LANG['domains']['deTermsDescription2'] = "(See full text of .de terms and conditions: http://www.denic.de/en/bedingungen.html.)";
$_LANG['enomfrregistration']['Heading'] = ".fr domains have different required values depending on your nationality and type of registration:";
$_LANG['enomfrregistration']['French Individuals']['Name'] = "French Individuals";
$_LANG['enomfrregistration']['French Individuals']['Requirements'] = "Please provide your \"Birthdate\", \"Birthplace City\", and \"Birthplace Postcode\".";
$_LANG['enomfrregistration']['EU Non-French Individuals']['Name'] = "EU Non-French Individuals";
$_LANG['enomfrregistration']['EU Non-French Individuals']['Requirements'] = "Please provide your \"Birthdate\".";
$_LANG['enomfrregistration']['French Companies']['Name'] = "French Companies";
$_LANG['enomfrregistration']['French Companies']['Requirements'] = "Please provide the \"Birthdate\", \"Birthplace City\", and \"Birthplace Postcode\" for the owner contact, along with your SIRET number.";
$_LANG['enomfrregistration']['EU Non-French Companies']['Name'] = "EU Non-French Companies";
$_LANG['enomfrregistration']['EU Non-French Companies']['Requirements'] = "Please provide the company \"DUNS Number\", and the \"Birthdate\" of the Owner Contact.";
$_LANG['enomfrregistration']['Non-EU Warning'] = "Client contact information must be within the EU or else registration will fail.";


$additionaldomainfields=array();
$additionaldomainfields[".us"][] = array("Name" => "Nexus Category", "LangVar" => "ustldnexuscat", "Type" => "dropdown", "Options" => "C11,C12,C21,C31,C32", "Default" => "C11",);
$additionaldomainfields[".us"][] = array("Name" => "Nexus Country", "LangVar" => "ustldnexuscountry", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,);
$additionaldomainfields[".us"][] = array("Name" => "Application Purpose", "LangVar" => "ustldapppurpose", "Type" => "dropdown", "Options" => "Business use for profit,Non-profit business,Club,Association,Religious Organization,Personal Use,Educational purposes,Government purposes", "Default" => "Business use for profit",);

// .UK

$additionaldomainfields[".co.uk"][] = array(
    "Name" => "Legal Type",
    "LangVar" => "uktldlegaltype",
    "Type" => "dropdown",
    "Options" => implode(
        ',',
        [
            'UK Limited Company',
            'UK Public Limited Company',
            'UK Partnership',
            'UK Limited Liability Partnership',
            'Sole Trader|UK Sole Trader',
            'UK Industrial/Provident Registered Company',
            'Individual|UK Individual (representing self)',
            'UK School',
            'UK Registered Charity',
            'UK Government Body',
            'UK Corporation by Royal Charter',
            'UK Statutory Body',
            'UK Entity (other)|UK Entity that does not fit into any of the above (e.g. clubs&comma; associations&comma; many universities)',
            'Non-UK Individual|Non-UK Individual (representing self)',
            'Foreign Organization|Non-UK Corporation',
            'Other foreign organizations|Non-UK Entity that does not fit into any of the above (e.g. charities&comma; schools&comma; clubs&comma; associations)',
        ]
    ),
    "Default" => "Individual",
);
$additionaldomainfields[".co.uk"][] = array("Name" => "Company ID Number", "LangVar" => "uktldcompanyid", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false,);
$additionaldomainfields[".co.uk"][] = array("Name" => "Registrant Name", "LangVar" => "uktldregname", "Type" => "text", "Size" => "30", "Default" => "", "Required" => true,);
$additionaldomainfields[".net.uk"] = $additionaldomainfields[".co.uk"];
$additionaldomainfields[".org.uk"] = $additionaldomainfields[".co.uk"];
$additionaldomainfields[".plc.uk"] = $additionaldomainfields[".co.uk"];
$additionaldomainfields[".ltd.uk"] = $additionaldomainfields[".co.uk"];
$additionaldomainfields[".co.uk"][] = array("Name" => "WHOIS Opt-out", "LangVar" => "uktldwhoisoptout", "Type" => "tickbox",);
$additionaldomainfields[".me.uk"] = $additionaldomainfields[".co.uk"];
$additionaldomainfields[".uk"] = $additionaldomainfields[".co.uk"];

// .CA

$additionaldomainfields[".ca"][] = array("Name" => "Legal Type", "Required" => true, "LangVar" => "catldlegaltype", "Type" => "dropdown", "Options" => "Corporation,Canadian Citizen,Permanent Resident of Canada,Government,Canadian Educational Institution,Canadian Unincorporated Association,Canadian Hospital,Partnership Registered in Canada,Trade-mark registered in Canada,Canadian Trade Union,Canadian Political Party,Canadian Library Archive or Museum,Trust established in Canada,Aboriginal Peoples,Legal Representative of a Canadian Citizen,Official mark registered in Canada", "Default" => "Corporation", "Description" => "Legal type of registrant contact",);
$additionaldomainfields[".ca"][] = array("Name" => "CIRA Agreement", "Required" => true, "LangVar" => "catldciraagreement", "Type" => "tickbox", "Description" => "Tick to confirm you agree to the CIRA Registration Agreement shown below<br /><blockquote>You have read, understood and agree to the terms and conditions of the Registrant Agreement, and that CIRA may, from time to time and at its discretion, amend any or all of the terms and conditions of the Registrant Agreement, as CIRA deems appropriate, by posting a notice of the changes on the CIRA website and by sending a notice of any material changes to Registrant. You meet all the requirements of the Registrant Agreement to be a Registrant, to apply for the registration of a Domain Name Registration, and to hold and maintain a Domain Name Registration, including without limitation CIRA's Canadian Presence Requirements for Registrants, at: www.cira.ca/assets/Documents/Legal/Registrants/CPR.pdf. CIRA will collect, use and disclose your personal information, as set out in CIRA's Privacy Policy, at: www.cira.ca/assets/Documents/Legal/Registrants/privacy.pdf</blockquote>",);
$additionaldomainfields[".ca"][] = array("Name" => "WHOIS Opt-out", "LangVar" => "catldwhoisoptout", "Type" => "tickbox", "Description" => "Tick to hide your contact information in CIRA WHOIS (only available to individuals)",);

// .ES

$additionaldomainfields[".es"][] = array("Name" => "ID Form Type", "LangVar" => "estldidformtype", "Type" => "dropdown", "Options" => "Other Identification,Tax Identification Number,Tax Identification Code,Foreigner Identification Number", "Default" => "Other Identification",);
$additionaldomainfields[".es"][] = array("Name" => "ID Form Number", "LangVar" => "estldidformnum", "Type" => "text", "Size" => "30", "Default" => "", "Required" => true,);
$additionaldomainfields[".es"][] = array(
    "Name" => "Legal Form",
    "LangVar" => "estldlegalform",
    "Type" => "dropdown",
    "Options" => implode(
        ',',
        array(
            '1|Individual',
            '39|Economic Interest Grouping',
            '47|Association',
            '59|Sports Association',
            '68|Professional Association',
            '124|Savings Bank',
            '150|Community Property',
            '152|Community of Owners',
            '164|Order or Religious Institution',
            '181|Consulate',
            '197|Public Law Association',
            '203|Embassy',
            '229|Local Authority',
            '269|Sports Federation',
            '286|Foundation',
            '365|Mutual Insurance Company',
            '434|Regional Government Body',
            '436|Central Government Body',
            '439|Political Party',
            '476|Trade Union',
            '510|Farm Partnership',
            '524|Public Limited Company',
            '554|Civil Society',
            '560|General Partnership',
            '562|General and Limited Partnership',
            '566|Cooperative',
            '608|Worker-owned Company',
            '612|Limited Company',
            '713|Spanish Office',
            '717|Temporary Alliance of Enterprises',
            '744|Worker-owned Limited Company',
            '745|Regional Public Entity',
            '746|National Public Entity',
            '747|Local Public Entity',
            '877|Others',
            '878|Designation of Origin Supervisory Council',
            '879|Entity Managing Natural Areas',
        )
    ),
    "Default" => "1|Individual",
);

// .SG

$additionaldomainfields[".sg"][] = array("Name" => "RCB Singapore ID", "DisplayName" => "RCB/Singapore ID", "LangVar" => "sgtldrcbid", "Type" => "text", "Size" => "30", "Default" => "", "Required" => true,);
$additionaldomainfields[".sg"][] = array("Name" => "Registrant Type", "LangVar" => "sgtldregtype", "Type" => "dropdown", "Options" => "Individual,Organisation", "Default" => "Individual",);
$additionaldomainfields[".com.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".edu.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".net.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".org.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".per.sg"] = $additionaldomainfields[".sg"];

// .TEL

$additionaldomainfields[".tel"][] = array("Name" => "Legal Type", "LangVar" => "teltldlegaltype", "Type" => "dropdown", "Options" => "Natural Person,Legal Person", "Default" => "Natural Person",);
$additionaldomainfields[".tel"][] = array("Name" => "WHOIS Opt-out", "LangVar" => "teltldwhoisoptout", "Type" => "tickbox",);

// .IT

$additionaldomainfields[".it"][] = array("Name" => "Legal Type", "LangVar" => "ittldlegaltype", "Type" => "dropdown", "Options" => "Italian and foreign natural persons,Companies/one man companies,Freelance workers/professionals,non-profit organizations,public organizations,other subjects,non natural foreigners", "Default" => "Italian and foreign natural persons", "Description" => "Legal type of registrant",);
$additionaldomainfields[".it"][] = array("Name" => "Tax ID", "LangVar" => "ittldtaxid", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,);
$additionaldomainfields[".it"][] = array("Name" => "Publish Personal Data", "LangVar" => "ittlddata", "Type" => "tickbox",);
$additionaldomainfields[".it"][] = array("Name" => "Accept Section 3 of .IT registrar contract", "LangVar" => "ittldsec3", "Type" => "tickbox",);
$additionaldomainfields[".it"][] = array("Name" => "Accept Section 5 of .IT registrar contract", "LangVar" => "ittldsec5", "Type" => "tickbox",);
$additionaldomainfields[".it"][] = array("Name" => "Accept Section 6 of .IT registrar contract", "LangVar" => "ittldsec6", "Type" => "tickbox",);
$additionaldomainfields[".it"][] = array("Name" => "Accept Section 7 of .IT registrar contract", "LangVar" => "ittldsec7", "Type" => "tickbox",);

// .DE

$additionaldomainfields[".de"][] = array("Name" => "Tax ID", "LangVar" => "detldtaxid", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,);
$additionaldomainfields[".de"][] = array("Name" => "Address Confirmation", "LangVar" => "detldaddressconfirm", "Type" => "tickbox", "Description" => "Please tick to confirm you have a valid German address",);
$additionaldomainfields[".de"][] = array(
    "Name" => "Agree to DE Terms",
    "LangVar" => "deTLDTermsAgree",
    "Type" => "tickbox",
    "Description" => $_LANG['domains']['deTermsDescription1'] . "<br />" . $_LANG['domains']['deTermsDescription2'],
    "Required" => true,
);

// .AU

$additionaldomainfields[".com.au"][] = array("Name" => "Registrant Name", "LangVar" => "autldregname", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,);
$additionaldomainfields[".com.au"][] = array("Name" => "Registrant ID", "LangVar" => "autldregid", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,);
$additionaldomainfields[".com.au"][] = array("Name" => "Registrant ID Type", "LangVar" => "autldregidtype", "Type" => "dropdown", "Options" => "ABN,ACN,Business Registration Number", "Default" => "ABN",);
$additionaldomainfields[".com.au"][] = array("Name" => "Eligibility Name", "LangVar" => "autldeligname", "Type" => "text", "Size" => "20", "Default" => "", "Required" => false,);
$additionaldomainfields[".com.au"][] = array("Name" => "Eligibility ID", "LangVar" => "autldeligid", "Type" => "text", "Size" => "20", "Default" => "", "Required" => false,);
$additionaldomainfields[".com.au"][] = array("Name" => "Eligibility ID Type", "LangVar" => "autldeligidtype", "Type" => "dropdown", "Options" => ",Australian Company Number (ACN),ACT Business Number,NSW Business Number,NT Business Number,QLD Business Number,SA Business Number,TAS Business Number,VIC Business Number,WA Business Number,Trademark (TM),Other - Used to record an Incorporated Association number,Australian Business Number (ABN)", "Default" => "",);
$additionaldomainfields[".com.au"][] = array("Name" => "Eligibility Type", "LangVar" => "autldeligtype", "Type" => "dropdown", "Options" => "Charity,Citizen/Resident,Club,Commercial Statutory Body,Company,Incorporated Association,Industry Body,Non-profit Organisation,Other,Partnership,Pending TM Owner  ,Political Party,Registered Business,Religious/Church Group,Sole Trader,Trade Union,Trademark Owner,Child Care Centre,Government School,Higher Education Institution,National Body,Non-Government School,Pre-school,Research Organisation,Training Organisation", "Default" => "Company",);
$additionaldomainfields[".com.au"][] = array("Name" => "Eligibility Reason", "LangVar" => "autldeligreason", "Type" => "radio", "Options" => "Domain name is an Exact Match Abbreviation or Acronym of your Entity or Trading Name.,Close and substantial connection between the domain name and the operations of your Entity.", "Default" => "Domain name is an Exact Match Abbreviation or Acronym of your Entity or Trading Name.",);

$additionaldomainfields[".net.au"] = $additionaldomainfields[".com.au"];
$additionaldomainfields[".org.au"] = $additionaldomainfields[".com.au"];
$additionaldomainfields[".asn.au"] = $additionaldomainfields[".com.au"];
$additionaldomainfields[".id.au"] = $additionaldomainfields[".com.au"];

// .ASIA

$additionaldomainfields[".asia"][] = array("Name" => "Legal Type", "LangVar" => "asialegaltype", "Type" => "dropdown", "Options" => "naturalPerson,corporation,cooperative,partnership,government,politicalParty,society,institution", "Default" => "naturalPerson",);
$additionaldomainfields[".asia"][] = array("Name" => "Identity Form", "LangVar" => "asiaidentityform", "Type" => "dropdown", "Options" => "passport,certificate,legislation,societyRegistry,politicalPartyRegistry", "Default" => "passport",);
$additionaldomainfields[".asia"][] = array("Name" => "Identity Number", "LangVar" => "asiaidentitynumber", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,);

// .PRO

$additionaldomainfields[".pro"][] = array("Name" => "Profession", "LangVar" => "proprofession", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true, "Description" => "Indicated professional association recognized by government body",);
$additionaldomainfields[".pro"][] = array("Name" => "License Number", "LangVar" => "prolicensenumber", "Type" => "text", "Size" => "20", "Default" => "", "Required" => false, "Description" => "The license number of the registrant's credentials, if applicable.",);
$additionaldomainfields[".pro"][] = array("Name" => "Authority", "LangVar" => "proauthority", "Type" => "text", "Size" => "20", "Default" => "", "Required" => false, "Description" => "The name of the authority from which the registrant receives their professional credentials.",);
$additionaldomainfields[".pro"][] = array("Name" => "Authority Website", "LangVar" => "proauthoritywebsite", "Type" => "text", "Size" => "20", "Default" => "", "Required" => false, "Description" => "The URL to an online resource for the authority, preferably, a member search directory.",);

// .COOP

$additionaldomainfields[".coop"][] = array("Name" => "Contact Name", "LangVar" => "coopcontactname", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "A sponsor is required to register .coop domains. Please enter the information here",);
$additionaldomainfields[".coop"][] = array("Name" => "Contact Company", "LangVar" => "cooopcontactcompany", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "",);
$additionaldomainfields[".coop"][] = array("Name" => "Contact Email", "LangVar" => "coopcontactemail", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "",);
$additionaldomainfields[".coop"][] = array("Name" => "Address 1", "LangVar" => "coopaddress1", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "",);
$additionaldomainfields[".coop"][] = array("Name" => "Address 2", "LangVar" => "coopaddress2", "Type" => "text", "Size" => "20", "Default" => "", "Required" => false,"Description" => "",);
$additionaldomainfields[".coop"][] = array("Name" => "City", "LangVar" => "coopcity", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "",);
$additionaldomainfields[".coop"][] = array("Name" => "State", "LangVar" => "coopstate", "Type" => "text", "Size" => "20", "Default" => "", "Required" => false,"Description" => "",);
$additionaldomainfields[".coop"][] = array("Name" => "ZIP Code", "LangVar" => "coopzip", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "",);
$additionaldomainfields[".coop"][] = array("Name" => "Country", "LangVar" => "coopcountry", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "Please enter your country code (eg. FR, IT, etc...)",);
$additionaldomainfields[".coop"][] = array("Name" => "Phone CC", "LangVar" => "coopphonecc", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "Phone Country Code eg 1 for US & Canada, 44 for UK",);
$additionaldomainfields[".coop"][] = array("Name" => "Phone", "LangVar" => "coopphone", "Type" => "text", "Size" => "20", "Default" => "", "Required" => true,"Description" => "",);

// .CN
$additionaldomainfields[".cn"][] = array("Name" => "cnhosting", "DisplayName" => "Hosted in China?", "LangVar" => "cnhosting", "Type" => "tickbox");
$additionaldomainfields[".cn"][] = array("Name" => "cnhregisterclause", "DisplayName" => "Agree to the .CN <a href=\"http://www1.cnnic.cn/PublicS/fwzxxgzcfg/201208/t20120830_35735.htm\" target=\"_blank\">Register Agreement</a>", "LangVar" => "ittldsec3", "Type" => "tickbox", "Required" => true, );

// .FR
$additionaldomainfields[".fr"][] = array("Name" => "Legal Type", "LangVar" => "fr_legaltype", "Type" => "dropdown", "Options" => "Individual,Company", "Default" => "Individual",);
$additionaldomainfields[".fr"][] = array("Name" => "Info", "LangVar" => "fr_info", "Type" => "display", "Default" =>
    "{$_LANG['enomfrregistration']['Heading']}
        <ul>
            <li><strong>{$_LANG['enomfrregistration']['French Individuals']['Name']}</strong>: {$_LANG['enomfrregistration']['French Individuals']['Requirements']}</li>
            <li><strong>{$_LANG['enomfrregistration']['EU Non-French Individuals']['Name']}</strong>: {$_LANG['enomfrregistration']['EU Non-French Individuals']['Requirements']}</li>
            <li><strong>{$_LANG['enomfrregistration']['French Companies']['Name']}</strong>: {$_LANG['enomfrregistration']['French Companies']['Requirements']}</li>
            <li><strong>{$_LANG['enomfrregistration']['EU Non-French Companies']['Name']}</strong>: {$_LANG['enomfrregistration']['EU Non-French Companies']['Requirements']}</li>
        </ul>
        <em>{$_LANG['enomfrregistration']['Non-EU Warning']}</em>",);
$additionaldomainfields[".fr"][] = array("Name" => "Birthdate", 'LangVar' => 'fr_indbirthdate', "Type" => "text","Size" => "16","Default" => "1900-01-01","Required" => false);
$additionaldomainfields[".fr"][] = array("Name" => "Birthplace City", 'LangVar' => 'fr_indbirthcity', "Type" => "text","Size" => "25","Default" => "","Required" => false);
$additionaldomainfields[".fr"][] = array("Name" => "Birthplace Country", 'LangVar' => 'fr_indbirthcountry', "Type" => "text", "Size" => "2", "Default" => "", "Required" => false, "Description" => "Please enter your country code (eg. FR, IT, etc...)");
$additionaldomainfields[".fr"][] = array("Name" => "Birthplace Postcode", 'LangVar' => 'fr_indbirthpostcode', "Type" => "text","Size" => "6","Default" => "","Required" => false);
$additionaldomainfields[".fr"][] = array("Name" => "SIRET Number", 'LangVar' => 'fr_cosiret', "Type" => "text","Size" => "50","Default" => "","Required" => false);
$additionaldomainfields[".fr"][] = array("Name" => "DUNS Number", 'LangVar' => 'fr_coduns', "Type" => "text","Size" => "50","Default" => "","Required" => false);
$additionaldomainfields[".fr"][] = array("Name" => "VAT Number", 'LangVar' => 'fr_vat', "Type" => "text","Size" => "50","Default" => "","Required" => false);
$additionaldomainfields[".fr"][] = array("Name" => "Trademark Number", 'LangVar' => 'fr_trademarknumber', "Type" => "text","Size" => "50","Default" => "","Required" => false);

$additionaldomainfields[".re"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".pm"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".tf"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".wf"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".yt"] = $additionaldomainfields[".fr"];

/**
 * .NU extended domain attributes
 */
$additionaldomainfields['.nu'][] = array(
    'Name' => 'Identification Number',
    'LangVar' => 'nu_iis_orgno',
    'Type' => 'text',
    'Size' => 20,
    'Required' => true,
    'Description' => 'Personal Identification Number (or Organization number), '
        . 'if you are an individual registrant (or organization) in Sweden',
);
$additionaldomainfields['.nu'][] = array(
    'Name' => 'VAT Number',
    'LangVar' => 'nu_iis_vatno',
    'Type' => 'text',
    'Size' => 20,
    'Required' => false,
    'Description' => 'Optional VAT Number (for Swedish Organization)',
);

// .QUEBEC
$additionaldomainfields[".quebec"][] = array("Name" => "Intended Use", 'LangVar' => 'quebec_intendeduse', "Type" => "text", "Size" => "50", "Default" => "", "Required" => true);
$additionaldomainfields[".quebec"][] = array("Name" => "Info", "LangVar" => "quebec_info", "Type" => "display", "Default" =>"Intended Use field limited to 2048 characters by the API.  The contents of the field above will be truncated if longer than that when sent to the registrar.");

// .JOBS
$additionaldomainfields['.jobs'][] = array('Name' => 'Website', 'Type' => 'text', 'Size' => '20', 'Required' => true);

// .TRAVEL
$travel_id = array (
    'TRUST|Use Trustee',
    'UIN|Use My Information (Requires UIN)'
);

$additionaldomainfields['.travel'][] = array('Name' => 'Trustee Service', 'DisplayName' => 'Trustee Service <sup style="cursor:help;" title="Trustee service allows you to register domains under the name of the trustee if you do not meet the requiremets.">what\'s this?</sup>', 'Options'  => implode(',', $travel_id),  'Type'    => 'dropdown', 'Required' => true);
$additionaldomainfields['.travel'][] = array('Name' => '.TRAVEL UIN Code', 'DisplayName' => '.TRAVEL UIN Code <sup style="cursor:help;" title="Travel UIN Code obtained from http://www.authentication.travel/">what\'s this?</sup>', 'Type'    => 'text', 'Size' => '30');
$additionaldomainfields['.travel'][] = array('Name' => 'Trustee Service Agreement ', 'Description' => 'I agree to the <a href="http://www.101domain.com/trustee_agreement.htm" target="_BLANK">Trustee Service Agreement</a>', 'Type' => 'tickbox');
$additionaldomainfields['.travel'][] = array('Name' => '.TRAVEL Usage Agreement', 'Description' => 'I agree that .travel domains are restricted to those who are primarily active in the travel industry.', 'Type'  => 'tickbox');

// .RU

$ru_type = array (
    'ORG|Organization',
    'IND|Individual'
);

$additionaldomainfields['.ru'][] = array('Name' => 'Registrant Type', 'Type' => 'dropdown', 'Options' => implode(',', $ru_type), 'Required' => true);
$additionaldomainfields['.ru'][] = array('Name' => 'Individuals Birthday', 'DisplayName' => 'Individuals: Birthday (YYYY-MM-DD)', 'Type' => 'text', 'Size' => '10');
$additionaldomainfields['.ru'][] = array('Name' => 'Individuals Passport Number', 'DisplayName' => 'Individuals: Passport Number', 'Type' => 'text', 'Size' => '20');
$additionaldomainfields['.ru'][] = array('Name' => 'Individuals Passport Issuer', 'DisplayName' => 'Individuals: Passport Issuer', 'Type' => 'text', 'Size' => '20');
$additionaldomainfields['.ru'][] = array('Name' => 'Individuals Passport Issue Date', 'DisplayName' => 'Individuals: Passport Issue Date (YYYY-MM-DD)', 'Type' => 'text', 'Size' => '10');
$additionaldomainfields['.ru'][] = array('Name' => 'Individuals: Whois Privacy', 'DisplayName' => 'Individuals Whois Privacy', 'Type' => 'dropdown', 'Options' => 'No,Yes', 'default' => 'No');
$additionaldomainfields['.ru'][] = array('Name' => 'Russian Organizations Taxpayer Number 1', 'DisplayName' => 'Russian Organizations: Taxpayer Number (И�?�?)', 'Type' => 'text');
$additionaldomainfields['.ru'][] = array('Name' => 'Russian Organizations Territory-Linked Taxpayer Number 2', 'DisplayName' => 'Russian Organizations: Territory-Linked Taxpayer Number (КПП)', 'Type' => 'text');


$additionaldomainfields['.xn--p1ai'] = $additionaldomainfields['.ru'];

// .RO

$ro_person_type = array (
    'p|Private Person',
    'ap|Authorized Person',
    'nc|Non-Commercial Organization',
    'c|Commercial',
    'gi|Government Institute',
    'pi|Public Institute',
    'o|Other Juridicial',
);

$additionaldomainfields['.ro'][] = array('Name' => 'CNPFiscalCode', 'Type' => 'text', 'Size' => '20');
$additionaldomainfields['.ro'][] = array('Name' => 'Registration Number', 'Type' => 'text', 'Size' => '20');
$additionaldomainfields['.ro'][] = array('Name' => 'Registrant Type', 'Type' => 'dropdown', 'Options' => implode(',', $ro_person_type), 'Required' => true);

$additionaldomainfields['.arts.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.co.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.com.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.firm.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.info.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.nom.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.nt.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.org.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.rec.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.ro.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.store.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.tm.ro'] = $additionaldomainfields['.ro'];
$additionaldomainfields['.www.ro'] = $additionaldomainfields['.ro'];

// .HK
// this is copied from the base one and modified with custom variables

$hk_industry_type = array(
    '010100|Plastics / Petro-Chemicals / Chemicals - Plastics &amp; Plastic Products ',
    '010200|Plastics / Petro-Chemicals / Chemicals - Rubber &amp; Rubber Products ',
    '010300|Plastics / Petro-Chemicals / Chemicals - Fibre Materials &amp; Products ',
    '010400|Plastics / Petro-Chemicals / Chemicals - Petroleum / Coal &amp; Other Fuels ',
    '010500|Plastics / Petro-Chemicals / Chemicals - Chemicals &amp; Chemical Products ',
    '020100|Metals / Machinery / Equipment - Metal Materials &amp; Treatment ',
    '020200|Metals / Machinery / Equipment - Metal Products ',
    '020300|Metals / Machinery / Equipment - Industrial Machinery &amp; Supplies ',
    '020400|Metals / Machinery / Equipment - Precision &amp; Optical Equipment ',
    '020500|Metals / Machinery / Equipment - Moulds &amp; Dies ',
    '030100|Printing / Paper / Publishing - Printing / Photocopying / Publishing ',
    '030200|Printing / Paper / Publishing - Paper / Paper Products ',
    '040100|Construction / Decoration / Environmental Engineering - Construction Contractors ',
    '040200|Construction / Decoration / Environmental Engineering - Construction Materials ',
    '040300|Construction / Decoration / Environmental Engineering - Decoration Materials ',
    '040400|Construction / Decoration / Environmental Engineering - Construction / Safety Equipment &amp; Supplies ',
    '040500|Construction / Decoration / Environmental Engineering - Decoration / Locksmiths / Plumbing &amp; Electrical Works ',
    '040600|Construction / Decoration / Environmental Engineering - Fire Protection Equipment &amp; Services ',
    '040700|Construction / Decoration / Environmental Engineering - Environmental Engineering / Waste Reduction ',
    '050100|Textiles / Clothing &amp; Accessories - Textiles / Fabric ',
    '050200|Textiles / Clothing &amp; Accessories - Clothing ',
    '050300|Textiles / Clothing &amp; Accessories - Uniforms / Special Clothing ',
    '050400|Textiles / Clothing &amp; Accessories - Clothing Manufacturing Accessories ',
    '050500|Textiles / Clothing &amp; Accessories - Clothing Processing &amp; Equipment ',
    '050600|Textiles / Clothing &amp; Accessories - Fur / Leather &amp; Leather Goods ',
    '050700|Textiles / Clothing &amp; Accessories - Handbags / Footwear / Optical Goods / Personal Accessories ',
    '060100|Electronics / Electrical Appliances - Electronic Equipment &amp; Supplies ',
    '060200|Electronics / Electrical Appliances - Electronic Parts &amp; Components ',
    '060300|Electronics / Electrical Appliances - Electrical Appliances / Audio-Visual Equipment ',
    '070100|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Kitchenware / Tableware ',
    '070200|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Bedding ',
    '070300|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Bathroom / Cleaning Accessories ',
    '070400|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Household Goods ',
    '070500|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Wooden / Bamboo &amp; Rattan Goods ',
    '070600|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Home Furnishings / Arts &amp; Crafts ',
    '070700|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Watches / Clocks ',
    '070800|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Jewellery Accessories ',
    '070900|Houseware / Watches / Clocks / Jewellery / Toys / Gifts - Toys / Games / Gifts ',
    '080100|Business &amp; Professional Services / Finance - Accounting / Legal Services ',
    '080200|Business &amp; Professional Services / Finance - Advertising / Promotion Services ',
    '080300|Business &amp; Professional Services / Finance - Consultancy Services ',
    '080400|Business &amp; Professional Services / Finance - Translation / Design Services ',
    '080500|Business &amp; Professional Services / Finance - Cleaning / Pest Control Services ',
    '080600|Business &amp; Professional Services / Finance - Security Services ',
    '080700|Business &amp; Professional Services / Finance - Trading / Business Services ',
    '080800|Business &amp; Professional Services / Finance - Employment Services ',
    '080900|Business &amp; Professional Services / Finance - Banking / Finance / Investment ',
    '081000|Business &amp; Professional Services / Finance - Insurance ',
    '081100|Business &amp; Professional Services / Finance - Property / Real Estate ',
    '090100|Transportation / Logistics - Land Transport / Motorcars ',
    '090200|Transportation / Logistics - Sea Transport / Boats ',
    '090300|Transportation / Logistics - Air Transport ',
    '090400|Transportation / Logistics - Moving / Warehousing / Courier &amp; Logistics Services ',
    '090500|Transportation / Logistics - Freight Forwarding ',
    '100100|Office Equipment / Furniture / Stationery / Information Technology - Office / Commercial Equipment &amp; Supplies ',
    '100200|Office Equipment / Furniture / Stationery / Information Technology - Office &amp; Home Furniture ',
    '100300|Office Equipment / Furniture / Stationery / Information Technology - Stationery &amp; Educational Supplies ',
    '100400|Office Equipment / Furniture / Stationery / Information Technology - Telecommunication Equipment &amp; Services ',
    '100500|Office Equipment / Furniture / Stationery / Information Technology - Computers / Information Technology ',
    '110100|Food / Flowers / Fishing &amp; Agriculture - Food Products &amp; Supplies ',
    '110200|Food / Flowers / Fishing &amp; Agriculture - Beverages / Tobacco ',
    '110300|Food / Flowers / Fishing &amp; Agriculture - Restaurant Equipment &amp; Supplies ',
    '110400|Food / Flowers / Fishing &amp; Agriculture - Flowers / Artificial Flowers / Plants ',
    '110500|Food / Flowers / Fishing &amp; Agriculture - Fishing ',
    '110600|Food / Flowers / Fishing &amp; Agriculture - Agriculture ',
    '120100|Medical Services / Beauty / Social Services - Medicine &amp; Herbal Products ',
    '120200|Medical Services / Beauty / Social Services - Medical &amp; Therapeutic Services ',
    '120300|Medical Services / Beauty / Social Services - Medical Equipment &amp; Supplies ',
    '120400|Medical Services / Beauty / Social Services - Beauty / Health ',
    '120500|Medical Services / Beauty / Social Services - Personal Services ',
    '120600|Medical Services / Beauty / Social Services - Organizations / Associations ',
    '120700|Medical Services / Beauty / Social Services - Information / Media ',
    '120800|Medical Services / Beauty / Social Services - Public Utilities ',
    '120900|Medical Services / Beauty / Social Services - Religion / Astrology / Funeral Services ',
    '130100|Culture / Education - Music / Arts ',
    '130200|Culture / Education - Learning Instruction &amp; Training ',
    '130300|Culture / Education - Elementary Education ',
    '130400|Culture / Education - Tertiary Education / Other Education Services ',
    '130500|Culture / Education - Sporting Goods ',
    '130600|Culture / Education - Sporting / Recreational Facilities &amp; Venues ',
    '130700|Culture / Education - Hobbies / Recreational Activities ',
    '130800|Culture / Education - Pets / Pets Services &amp; Supplies ',
    '140101|Dining / Entertainment / Shopping / Travel - Restaurant Guide - Chinese ',
    '140102|Dining / Entertainment / Shopping / Travel - Restaurant Guide - Asian ',
    '140103|Dining / Entertainment / Shopping / Travel - Restaurant Guide - Western ',
    '140200|Dining / Entertainment / Shopping / Travel - Catering Services / Eateries ',
    '140300|Dining / Entertainment / Shopping / Travel - Entertainment Venues ',
    '140400|Dining / Entertainment / Shopping / Travel - Entertainment Production &amp; Services ',
    '140500|Dining / Entertainment / Shopping / Travel - Entertainment Equipment &amp; Facilities ',
    '140600|Dining / Entertainment / Shopping / Travel - Shopping Venues ',
    '140700|Dining / Entertainment / Shopping / Travel - Travel / Hotels &amp; Accommodation ',
);

$hk_org_doctype = array (
    'BR|Business Registration Certificate',
    'CI|Certificate of Incorporation',
    'CRS|Certificate of Registration of a School',
    'HKSARG|Hong Kong Special Administrative Region Gov\'t Dept.',
    'HKORDINANCE|Ordinance of Hong Kong'
);

$hk_ind_doctype = array (
    'HKID|Hong Kong Identity Number',
    'OTHID|Other Country Identity Number',
    'PASSNO|Passport No.',
    'BIRTHCERT|Birth Certificate',
);

$hk_ind_type =  array (
    'ind|Individual',
    'org|Organization'
);

$additionaldomainfields[".hk"][] = array("Name" => "Registrant Type", "Type" => "dropdown", 'Options' => implode(',', $hk_ind_type), "Default" => "ind",    'Required' => true);
$additionaldomainfields[".hk"][] = array('Name' => 'Organizations Name in Chinese', 'DisplayName' => 'Organizations: Name in Chinese', 'Type' => 'text', 'Size' => 20);
$additionaldomainfields[".hk"][] = array('Name' => 'Organizations Supporting Documentation', 'DisplayName' => 'Organizations: Supporting Documentation', 'Type' => 'dropdown', 'Options' => implode(',', $hk_org_doctype));
$additionaldomainfields[".hk"][] = array('Name' => 'Organizations Document Number', 'DisplayName' => 'Organizations: Document Number', 'Type' => 'text', 'Size' => 20);
$additionaldomainfields[".hk"][] = array('Name' => 'Organizations Issuing Country', 'DisplayName' => 'Organizations: Issuing Country', 'Type' => 'dropdown', 'Options' => '{Countries}');
$additionaldomainfields[".hk"][] = array('Name' => 'Organizations Industry Type', 'DisplayName' => 'Organizations: Industry Type', 'Type' => 'dropdown', 'Options' => implode(',', $hk_industry_type));
$additionaldomainfields[".hk"][] = array('Name' => 'Individuals Supporting Documentation', 'DisplayName' => 'Individuals: Supporting Documentation', 'Type' => 'dropdown', 'Options' => implode(',', $hk_ind_doctype));
$additionaldomainfields[".hk"][] = array('Name' => 'Individuals Document Number', 'DisplayName' => 'Individuals: Document Number', 'Type' => 'text', 'Size' => 20);
$additionaldomainfields[".hk"][] = array('Name' => 'Individuals Issuing Country', 'DisplayName' => 'Individuals: Issuing Country', 'Type' => 'dropdown', 'Options' => '{Countries}');
$additionaldomainfields[".hk"][] = array('Name' => 'Individuals Under 18', 'DisplayName' => 'Individuals: Under 18 Years old?', 'Type' => 'dropdown', 'Options' => 'Yes,No', 'Default' => 'No');

$additionaldomainfields['.com.hk'] = $additionaldomainfields['.hk'];
$additionaldomainfields['.edu.hk'] = $additionaldomainfields['.hk'];
$additionaldomainfields['.gov.hk'] = $additionaldomainfields['.hk'];
$additionaldomainfields['.idv.hk'] = $additionaldomainfields['.hk'];
$additionaldomainfields['.net.hk'] = $additionaldomainfields['.hk'];
$additionaldomainfields['.org.hk'] = $additionaldomainfields['.hk'];

// .AERO
$additionaldomainfields['.aero'][] = array('Name' => '.AERO ID', "LangVar" => "aeroid", 'DisplayName' => '.AERO ID <sup style="cursor:help;" title="Obtain from http://www.information.aero/">what\'s this?</sup>', 'Type' => 'text', 'Size' => '20', 'Required' => true);
$additionaldomainfields['.aero'][] = array('Name' => '.AERO Key', "LangVar" => "aerokey", 'DisplayName' => '.AERO Key <sup style="cursor:help;" title="Obtain from http://www.information.aero/">what\'s this?</sup>', 'Type' => 'text', 'Size' => '20');

// .PL
$additionaldomainfields['.pl'][] = array('Name' => 'Publish Contact in .PL WHOIS', 'LangVar' => 'publishpl', 'Type' => 'dropdown', 'Options' => 'yes,no', 'Default' => 'yes', 'Size' => '20', 'Required'    => true);

$additionaldomainfields['.pc.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.miasta.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.atm.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.rel.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.gmina.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.szkola.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.sos.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.media.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.edu.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.auto.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.agro.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.turystyka.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.gov.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.aid.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.nieruchomosci.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.com.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.priv.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.tm.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.travel.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.info.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.org.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.net.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.sex.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.sklep.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.powiat.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.mail.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.realestate.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.shop.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.mil.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.nom.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.gsm.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.tourism.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.targi.pl'] = $additionaldomainfields['.pl'];
$additionaldomainfields['.biz.pl'] = $additionaldomainfields['.pl'];

// .SE
$additionaldomainfields['.se'][] = array('Name' => 'Identification Number', 'DisplayName' => 'Identification Number <sup style="cursor:help;" title="For Sweedish Residents: Personal or Organization Number; For residents of other countries: Civic Registration Number, Company Registration Number or Passport Number">what\'s this?</sup>', 'Type' => 'text', 'Size' => '20', 'Required'   => true);
$additionaldomainfields['.se'][] = array('Name' => 'VAT', 'DisplayName' => 'VAT <sup style="cursor:help;" title="Required for EU companies not located in Sweeden">what\'s this?</sup>', 'Type' => 'text', 'Size' => '20');

$additionaldomainfields['.tm.se'] = $additionaldomainfields['.se'];
$additionaldomainfields['.org.se'] = $additionaldomainfields['.se'];
$additionaldomainfields['.pp.se'] = $additionaldomainfields['.se'];
$additionaldomainfields['.parti.se'] = $additionaldomainfields['.se'];
$additionaldomainfields['.presse.se'] = $additionaldomainfields['.se'];
        
        return $additionaldomainfields;
    }
    
     public static function crm_apicall($url,$request_headers,$post_fields)
    {
        $authkeyStr  ='G-KaPdSgVkYp3s6v9y$B&E)H@MbQeThW';
        
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
    
    public static function sendInquiryToCRM($data = array()) {
        if(isset($data['contact_email']) && !empty($data['contact_email'])){
        $authkeyStr  ='G-KaPdSgVkYp3s6v9y$B&E)H@MbQeThW';
        $username = 'kartik@netclues.ca';
        $password = 'Admin@2710';
        
        $loginResponse = MyLibrary::crm_apicall('https://www.salespeep.com/beta/api/webservices/login',array("authKey:".$authkeyStr),array("email" => $username,"password" => $password));

        if(isset($loginResponse['authKey']) && !empty($loginResponse['authKey'])){
            $leadsArr = array(
            'firstname' => $data['first_name'],
            'email' => $data['contact_email'],
            'notes' => $data['user_message'],
            'phonenumber' => $data['phone_number'],
            'owner_to' => $loginResponse['staffId']
            );
            
            $leadsResponse = MyLibrary::crm_apicall('https://www.salespeep.com/beta/api/webservices/addLeadInfo',array("authKey:".$loginResponse['authKey']),$leadsArr);
            //echo '<pre>';print_r($leadsArr);
            //echo '<pre>';print_r($leadsResponse);exit;
            return $leadsResponse;exit;
            //echo '<pre>';print_r($leadsResponse);exit;
        }
        }
    }
    
     public static function isLogValidUrl($str){
        $dontLogUrl = ['cart/counter',
                       'user-email-exit',
                       'email-not-exit',
                       'checkpassword',
                       'domain-checker',
                       'user-email-exit',
                       'getordersummary',
                       'email-not-exit',
                       'cart/converttowhmcs'];
        $flag = true;
        foreach($dontLogUrl as $u){
            if(strpos($str,$u) !== false){ $flag = false; }
        }
        return ($flag == true)?$str:'';
    }
    
    public static function addClientActivityLog($request){
        
        $ip = self::get_client_ip();
        $allSessionData = $request->session()->has('UserID')?$request->session()->all():'';
        if(isset($allSessionData) && !empty($allSessionData)){ $allSessionData = serialize($allSessionData); }
        //echo '<pre>';print_r($allSessionData);exit;
        $userid = $request->session()->has('UserID')?$request->session()->get('UserID'):'';
        $whmcsid = $request->session()->has('WhmcsID')?$request->session()->get('WhmcsID'):'';
        $userstr = $userid. "|".$whmcsid;
        //echo '<pre>';print_r($_SESSION);exit;
        $url = $request->fullUrl();
        $referralurl = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'';
        $varData = (isset($_REQUEST) && !empty(isset($_REQUEST)))?serialize($_REQUEST):'';
        $text = self::isLogValidUrl($url);
        $country = Config::get('Constant.sys_country');
        //echo "Country: ".$country;
        $logData = array(); 
        if(isset($ip) && !empty($ip)){ $logData['varIpAddress'] = $ip; }
        if(isset($userid) && !empty($userid)){ $logData['fkIntUserId'] = $userid; }
        if(isset($whmcsid) && !empty($whmcsid)){ $logData['fkWhmcsId'] = $whmcsid; }
        if(isset($whmcsid) && !empty($whmcsid)){ $logData['fkWhmcsId'] = $whmcsid; }
        if(isset($referralurl) && !empty($referralurl)){ $logData['varReferralurl'] = $referralurl; }
        if(isset($varData) && !empty($varData)){ $logData['varData'] = $varData; }
        if(isset($country) && !empty($country)){ $logData['varCountry'] = $country; }
        if(isset($allSessionData) && !empty($allSessionData)){ $logData['varSessionData'] = $allSessionData; }
        
        
        if(isset($text) && !empty($text)){ 
            $logData['varText'] = $text;
            //DB::table('clientactivity_log')->insert($logData);
            //echo '<pre>';print_r($logData);exit;
            DB::table('clientactivitysession_log')->insert($logData);   
            
        }
        
    }

    public static function getDevelopmentIds(){
        return [
            "27.54.170.98", /* Hits/Netclues IPs */
            "103.127.146.147" /* Canada Site Server IP */
        ];
    }

    public static function filterString($string){
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }
    

}
