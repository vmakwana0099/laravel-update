<?php

namespace App;

use DB;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Whmcs;
use Config;
use App\Helpers\Email_sender;
use Session;

class Cart {
    public function __construct() {
        $dname = "https://www.hostitsmart.com";
        Config::set('apiurl', $dname."/checkdomain.php?"); //suggested tlds.
        Config::set('hitsupdatecart', "https://manage.hostitsmart.com");
    }

    public static function addtocart($request, $itemData, $User_ID = '') {
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        if(isset($cartData) && !empty($cartData)){ //check if product already existing in cart, Don't add repeated products.
            if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
            if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
            if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }          
            if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
            if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
            if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }

            foreach($cartData as $key => $cart){
                //We allowed Products to be added multiple times.
              
               /* if(isset($cart['producttype']) && $cart['producttype'] == 'domain'){ //for domain
                    if((isset($cart['domain']) && !empty($cart['domain'])) && (isset($itemData['domain']) && !empty($itemData['domain'])))
                    {

   
                        if($cart['domain'] == $itemData['domain']){ return false; }
                    }
                }*/
                /*else if(isset($cart['producttype']) && $cart['producttype'] != 'domain'){
                   //for hosting, vps, dedicated server, ssl etc...
                 if($item['producttype'] != 'vps' && $item['producttype'] != 'dedicatedserver'){
                   if((isset($cart['pid']) && !empty($cart['pid'])) && (isset($itemData['pid']) && !empty($itemData['pid'])))
                        { 
                            if($cart['pid'] == $itemData['pid']){ return false; }
                        }
                    }
                }*/
            }
        }
        
        if (!empty($itemData)) {
            $cartData[] = $itemData;
        }

        $request->session()->put('cart', $cartData);
        Self::updateCartInDb($request,$cartData); //Update current session in db
        $b = array_keys($cartData); return end($b);
        return $b;
    }
    public static function updateCartInDb($request,$cartData){
        if (!empty($request->session()->get('UserID'))) {
                $Current_Payload = $cartData;
                $User_ID = $request->session()->get('UserID');
                $date = date('Y-m-d H:i:s'); $session_id = session()->getId();
                $get_previus_data = user_session::where('user_id', '=', $User_ID)->first(); // get previously session data for user
                if ($get_previus_data) {
                     $update_payload = base64_encode(serialize($Current_Payload));
                    user_session::whereUser_id($User_ID)->update(array('id' => $session_id, 'payload' => $update_payload, 'last_activity' => $date)); //update session id 
                } else {
                    $ip_address = \Request::ip();
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    user_session::insert([
                        'id' => $session_id,
                        'user_id' => $User_ID,
                        'ip_address' => $ip_address,
                        'user_agent' => $useragent,
                        'payload' => base64_encode(serialize($Current_Payload)),
                        'last_activity' => $date,
                    ]);
                }
            }
    }
    public static function emptyCart($request) {
        $User_ID = $request->session()->get('UserID');
        if ($request->session()->has('cart')) {
            $request->session()->pull('cart');
        }
        if (!empty($User_ID)) {
            DB::table('front_session')->where('user_id', $User_ID)->delete();
            if(isset($request->cur) && isset($request->cur_id))
            { 
                Front_user::whereId($User_ID)->update(array('currency' => $request->cur,'currency_code' => $request->cur_id)); //insert token 
            }
        }
    }

    public static function removeCart($request) {
        if (isset($request->ele_key))
            $key = $request->ele_key;
        if (isset($request->ele))
            $key = $request->ele;

        if ($request->session()->has('cart.' . $key))
            { $request->session()->pull('cart.' . $key); }
        
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        if(isset($cartData) && !empty($cartData))
        {
        if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
        if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
        if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
        if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
        if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
        if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
        }

        //Remove all sub products also.
        if(!empty($cartData)){ 
            foreach($cartData as $key1 => $data){
                if (isset($data['relatedpro']) && !isset($cartData[$data['relatedpro']]))
                {
                    if ($request->session()->has('cart.' . $key1)) 
                        { $request->session()->pull('cart.' . $key1); }
                }
            }
        }
        
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        Self::updateCartInDb($request,$request->session()->get('cart')); //Update current session in db
        if(isset($cartData) && !empty($cartData))
        {
        if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
        if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
        if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
        if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
        if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
        if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
        }
        return (isset($cartData) && !empty($cartData)) ? 1 : 0;
    }

    public static function createOrder($request,$paymentgateway = 'paypal') {
        $orderId = 0;
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        //echo '<pre>';print_r($cartData);exit;
        $promo = '';
        if (isset($cartData['prmocode']) && !empty($cartData['prmocode']) ) {
            $promo = $cartData['prmocode'] ;
        }
        $uid = $request->session()->has('WhmcsID')?$request->session()->get('WhmcsID'):3428; //Whmcs userid
        $frontuid = $request->session()->has('UserID')?$request->session()->get('UserID'):0; //Front website userid
        $orderData = array();
        $orderData['clientid'] = !empty($uid) ? $uid : 3428; //loggedin user's id

        $orderData['paymentmethod'] = $paymentgateway; 
        $itemCounter = 0;
        if (!empty($cartData)) {
            if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
            if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
            if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
            
            if (isset($cartData['prmocode']) && !empty($cartData['prmocode'])) {
                    $orderData['promocode'] = $cartData['prmocode']; //get promocode from cart session
                if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
                if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
                if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
            }
           
            foreach ($cartData as $key => $item) {
                if(isset($item['producttype']) && $item['producttype'] != 'domain' && !empty($item['pid']))
                {
                    $customFieldsData = $configFieldsData = []; 
                    if (!empty($item['customfields'])) {
                    foreach ($item['customfields'] as $field) {
                        if (isset($field['selectedOption']))
                            if($field['id'] == 'hostname'){
                                $item['hostname'] = $field['selectedOption'];
                            }
                            else if($field['id'] == 'hostpass'){
                                $item['rootpw'] = $field['selectedOption'];
                            }
                            else if($field['id'] == 'ns1'){
                                $item['ns1prefix'] = $field['selectedOption'];
                            }
                            else if($field['id'] == 'ns2'){
                                $item['ns2prefix'] = $field['selectedOption'];
                            }
                            else {
                                $customFieldsData[$field['id']] = $field['selectedOption'];
                            }
                    }
                }
               
                if (!empty($item['configfields'])) {
                    foreach ($item['configfields'] as $field) {
                        if (isset($field['selectedOption']))
                            $configFieldsData[$field['id']] = $field['selectedOption'];
                    }
                }
                if (isset($item['pid']) && !empty($item['pid'])) {
                    $orderData['pid'][$itemCounter] = $item['pid'];
                }
                // if (isset($item['billingcycle']) && !empty($item['billingcycle'])) {
                //     if (isset($cartData['prmocode']) && !empty($cartData['prmocode']) && $item['pid'] == 416) {
                //         $orderData['billingcycle'][$itemCounter] = 'Free';
                //     }else{
                        $orderData['billingcycle'][$itemCounter] = str_replace("-","",$item['billingcycle']);
                //     }
                // }
                if (isset($customFieldsData) && !empty($customFieldsData)) {
                    $orderData['customfields'][$itemCounter] = base64_encode(serialize($customFieldsData));
                }
                if (isset($configFieldsData) && !empty($configFieldsData)) {
                    $orderData['configoptions'][$itemCounter] = base64_encode(serialize($configFieldsData));
                }
                if (isset($item['addons']) && !empty($item['addons'])) {
                    $orderData['addons'][$itemCounter] = implode(",", $item['addons']);
                }
                if (isset($item['hostname']) && !empty($item['hostname'])) {
                    $orderData['hostname'][$itemCounter] = $item['hostname'];
                }
                if (isset($item['ns1prefix']) && !empty($item['ns1prefix'])) {
                    $orderData['ns1prefix'][$itemCounter] = $item['ns1prefix'];
                }
                if (isset($item['ns2prefix']) && !empty($item['ns2prefix'])) {
                    $orderData['ns2prefix'][$itemCounter] = $item['ns2prefix'];
                }
                if (isset($item['rootpw']) && !empty($item['rootpw'])) {
                    $orderData['rootpw'][$itemCounter] = $item['rootpw'];
                }
                if (isset($item['domain']) && !empty($item['domain'])) {
                    $orderData['domain'][$itemCounter] = $item['domain'];
                }
                // if ($item['pid'] == 416 && $promo == 'FREETRIAL' && $item['billingcycle'] == 'monthly') {
                //     $orderData['noinvoiceemail'] = true;
                //     $orderData['noinvoice'] = true;
                //     $orderData['noemail'] = true;
                // }
                $itemCounter++;
                }
            }

            foreach ($cartData as $key => $item) {
                if(isset($item['producttype']) && $item['producttype'] == 'domain' && !empty($item['domain'])){
                $customFieldsData = $configFieldsData = [];
                if (!empty($item['customfields'])) {
                    foreach ($item['customfields'] as $field) {
                        if (isset($field['selectedOption']))
                            $customFieldsData[$field['id']] = $field['selectedOption'];
                    }
                }

                if (!empty($item['configfields'])) {
                    foreach ($item['configfields'] as $field) {
                        if (isset($field['selectedOption']))
                            $configFieldsData[$field['id']] = $field['selectedOption'];
                    }
                }
               
                if (isset($item['pid']) && !empty($item['pid'])) {
                    $orderData['pid'][$itemCounter] = $item['pid'];
                }
                if (isset($item['billingcycle']) && !empty($item['billingcycle'])) {
                    $orderData['billingcycle'][$itemCounter] = str_replace("-","",$item['billingcycle']);
                }
                if (isset($customFieldsData) && !empty($customFieldsData)) {
                    $orderData['customfields'][$itemCounter] = base64_encode(serialize($customFieldsData));
                }
                if (isset($configFieldsData) && !empty($configFieldsData)) {
                    $orderData['configoptions'][$itemCounter] = base64_encode(serialize($configFieldsData));
                }
                if (isset($item['addons']) && !empty($item['addons'])) {
                    $orderData['addons'][$itemCounter] = implode(",", $item['addons']);
                }
                if (isset($item['hostname']) && !empty($item['hostname'])) {
                    $orderData['hostname'][$itemCounter] = $item['hostname'];
                }
                if (isset($item['ns1prefix']) && !empty($item['ns1prefix'])) {
                    $orderData['ns1prefix'][$itemCounter] = $item['ns1prefix'];
                }
                if (isset($item['ns2prefix']) && !empty($item['ns2prefix'])) {
                    $orderData['ns2prefix'][$itemCounter] = $item['ns2prefix'];
                }
                if (isset($item['rootpw']) && !empty($item['rootpw'])) {
                    $orderData['rootpw'][$itemCounter] = $item['rootpw'];
                }
                if (isset($item['domain']) && !empty($item['domain'])) {
                    $orderData['domain'][$itemCounter] = $item['domain'];
                }
                if (isset($item['domaintype']) && !empty($item['domaintype'])) {
                    $orderData['domaintype'][$itemCounter] = $item['domaintype'];
                }
                if (isset($item['regperiod']) && !empty($item['regperiod']) && $item['producttype'] == 'domain') {
                    $orderData['regperiod'][$itemCounter] = $item['regperiod'];
                }
                if (isset($item['eppcode']) && !empty($item['eppcode'])) {
                    $orderData['eppcode'][$itemCounter] = $item['eppcode'];
                }
                if(!empty($item['addonproducts'])){
                    foreach($item['addonproducts'] as $addon){
                        if(isset($addon['added']) && $addon['added'] == $key){
                            if(isset($addon['type']) && $addon['type'] == 'idprotection'){ 
                                $orderData['idprotection'][$itemCounter] = 1;
                            }
                            if(isset($addon['type']) && $addon['type'] == 'emailforwarding'){ 
                                $orderData['emailforwarding'][$itemCounter] = 1;
                            }
                            if(isset($addon['type']) && $addon['type'] == 'dnsmanagement'){ 
                                $orderData['dnsmanagement'][$itemCounter] = 1;
                            }
                        }
                    }
                }
                if (isset($item['domainfields']) && !empty($item['domainfields'])) {
                    $orderData['domainfields'][$itemCounter] = $item['domainfields'];
                }
                $itemCounter++;
                }
            }
        }
        $orderData = MyLibrary::laravelcallapi("createorder", $orderData);
        if(isset($orderData['orderid']))
        {   $_ipAddress = \Request::ip();
            $ordTotal = $request->varordertotal. " " .Config::get('Constant.sys_currency');
            Cart::addFrontOrder(['user_id' =>$frontuid,'fkWhmcs_id'=> $uid,'fkWhmcsOrder' => $orderData['orderid'], 'payload' => base64_encode(serialize($cartData)),'ip_address' => $_ipAddress,'last_activity' => date('Y-m-d H:i:s'),'varOrderTotal' => $ordTotal]);
            file_put_contents("betaorderlog.txt", "\n ".date('Y/m/d H:i:s')."New order id: " . $orderData['orderid'], FILE_APPEND); 
        }
        return $orderData;
    }

    public static function getTldsPricing($paramArr = array(), $tld) {
        $params['tlds'] = isset($paramArr['tlds']) ? $paramArr['tlds'] : "";
        $params['tlds'] = ltrim($params['tlds'],".");
        $params['currency'] = isset($paramArr['currency']) ? $paramArr['currency'] : "";
        $currency = ($paramArr['currency'] == 1)? "INR":"USD";
        if (!empty($params['tlds']) && isset($params['currency'])) {
            $query = DB::table('whmcs_tlds_price')
                    ->select('whmcs_tlds_price.*')
                    ->join('tld', 'tld.id', '=', 'whmcs_tlds_price.fk_tldname');
            $query->where('whmcs_tlds_price.currency', $currency);
            $query->where('tld.varTitle', $params['tlds']);
            $response = $query->get()->toArray();
            foreach($response as $rs){
                    $tempPrice = [];
                    $tempPrice['id']            = $rs->id;
                    $tempPrice['type']          = $rs->type;
                    $tempPrice['currency']      = ($rs->currency == 'INR')? 1:10; //1 for inr and 10 for usd.
                    $tempPrice['relid']         = $rs->fk_tldname;
                    $tempPrice['msetupfee']     = $rs->Price1."|".$rs->WrongPrice1;
                    $tempPrice['qsetupfee']     = $rs->Price2."|".$rs->WrongPrice2;
                    $tempPrice['ssetupfee']     = $rs->Price3."|".$rs->WrongPrice3;
                    $tempPrice['asetupfee']     = $rs->Price4."|".$rs->WrongPrice4;
                    $tempPrice['bsetupfee']     = $rs->Price5."|".$rs->WrongPrice5;
                    $tempPrice['tsetupfee']     = 0.00;
                    $tempPrice['monthly']       = $rs->Price6."|".$rs->WrongPrice6;
                    $tempPrice['quarterly']     = $rs->Price7."|".$rs->WrongPrice7;
                    $tempPrice['semiannually']  = $rs->Price8."|".$rs->WrongPrice8;
                    $tempPrice['annually']      = $rs->Price9."|".$rs->WrongPrice9;
                    $tempPrice['biennially']    = $rs->Price10."|".$rs->WrongPrice10;
                    $tempPrice['triennially']   = 0.00;
                    $pricingDetails[] = $tempPrice;
            }
        }
        return isset($pricingDetails) ? $pricingDetails : [];
    }

    public static function getProductPricing($paramArr = array()) {
        $params['productid'] = isset($paramArr['productid']) ? $paramArr['productid'] : "";
        $params['currencycode'] = isset($paramArr['currencycode']) ? $paramArr['currencycode'] : "";

        if (!empty($params['productid']) && $params['currencycode']) {
            $pricingDetails=MyLibrary::getStaticArrayOfPrice();
        }
        //echo '<pre>';print_r($pricingDetails);exit;
        return $pricingDetails[$params['productid']];
    }
    public static function getProductPricingTemp($paramArr = array()) {
        //Delete this function leter
        $params['productid'] = isset($paramArr['productid']) ? $paramArr['productid'] : "";
        $params['currencycode'] = isset($paramArr['currencycode']) ? $paramArr['currencycode'] : "";

        if (!empty($params['productid']) && $params['currencycode']) {
            $pricingDetails = MyLibrary::laravelcallapi("getproductpricing", $params);
        }
        return $pricingDetails;
    }

    public static function mapDuration($str, $type = 'domain') {
        if ($type == 'domain') {
            switch ($str) {
                case 'msetupfee':
                    return 1;
                    break;
                case 'qsetupfee':
                    return 2;
                    break;
                case 'ssetupfee':
                    return 3;
                    break;
                case 'asetupfee':
                    return 4;
                    break;
                case 'bsetupfee':
                    return 5;
                    break;
                /* case 'tsetupfee':
                  break; */
                case 'monthly':
                    return 6;
                    break;
                case 'quarterly':
                    return 7;
                    break;
                case 'semiannually':
                    return 8;
                    break;
                case 'annually':
                    return 9;
                    break;
                case 'biennially':
                    return 10;
                    break;
                /* case 'triennially':
                  break; */
                default:
                    return 1;
                    break;
            }
        }
    }

    public static function getRegistrationPeriodByName($name) {
        $arr = ["monthly" => 1, "quarterly" => 2, "semi-annually" => 3, "annually" => 4, "biennially" => 5, "triennially" => 6];
        return isset($arr[$name]) ? $arr[$name] : "1";
    }

    public static function getDomainPricing($paramArr) {
        $arr = array();
        $tld = isset($paramArr['tlds']) ? $paramArr['tlds'] : "";
        $tld = ltrim($tld, ".");


        $pricingData = Self::getTldsPricing($paramArr, $tld);
        if (!empty($pricingData)) {
            foreach ($pricingData as $price_data) {
                $i = 1;
                if ($price_data['type'] == 'domainregister') {
                    foreach ($price_data as $key => $price) {
                        if (in_array($key, ['id', 'type', 'currency', 'relid', 'tsetupfee', 'triennially','fk_tldname'])) {
                            continue;
                        }
                        $price = str_replace(".00", "", $price);
                        $pr = explode("|",$price);
                        $or = $pr[0]; //Original price
                        $wp = $pr[1]; //Wrong price
                        $arr[$i]['duration'] = Self::mapDuration($key);
                        $arr[$i]['register'] = $or;
                        $arr[$i]['wrongprice'] = $wp;
                        $i++;
                    }
                }
                $i = 1;
                if ($price_data['type'] == 'domaintransfer') {
                    foreach ($price_data as $key => $price) {
                        if (in_array($key, ['id', 'type', 'currency', 'relid', 'tsetupfee', 'triennially','fk_tldname'])) {
                            continue;
                        }
                        $price = str_replace(".00", "", $price);
                        $pr = explode("|",$price);
                        $or = $pr[0]; //Original price
                        $wp = $pr[1]; //Wrong price
                        $arr[$i]['transfer'] = $or;
                        $i++;
                    }
                }
                $i = 1;
                if ($price_data['type'] == 'domainrenew') {
                    foreach ($price_data as $key => $price) {
                        if (in_array($key, ['id', 'type', 'currency', 'relid', 'tsetupfee', 'triennially'])) {
                            continue;
                        }
                        $price = str_replace(".00", "", $price);
                        $pr = explode("|",$price);
                        $or = $pr[0]; //Original price
                        $wp = $pr[1]; //Wrong price
                        $arr[$i]['renwal'] = $or;
                        $i++;
                    }
                }
            }
        }

        $finalArr = [];
        if (!empty($arr)) {
            foreach ($arr as $ele) {
                if (isset($ele['duration'])) {
                    $finalArr[] = (object) $ele;
                }
            }
        }
        return $finalArr;
    }

    public static function getProductOldPricing($id) {
        $productData = [];
        if (!empty($id)) {
            $productData = Self::getProductsData($id, 'all');
        }
        return $productData;
    }

    public static function getHostingPricing($paramArr, $filter = '') {
        $arr = array();
        $paramArr['productid'] = isset($paramArr['productid']) ? $paramArr['productid'] : "";
        $paramArr['currencycode'] = isset($paramArr['currencycode']) ? $paramArr['currencycode'] : "";

        $pricingData = Self::getProductPricing($paramArr);
        if($paramArr['productid'] == 238){$paramArr['productid'] = 236;} // VK 22/1/2020 
        $productPricing = Self::getProductOldPricing($paramArr['productid']);
        if (!empty($pricingData)) {
            $finalArr = array();
            $finalArr[1]['duration'] = 1;
            $finalArr[2]['duration'] = 3;
            $finalArr[3]['duration'] = 6;
            $finalArr[4]['duration'] = 12;
            $finalArr[5]['duration'] = 24;
            $finalArr[6]['duration'] = 36;

            $finalArr[1]['durationame'] = "monthly";
            $finalArr[2]['durationame'] = "quarterly";
            $finalArr[3]['durationame'] = "semi-annually";
            $finalArr[4]['durationame'] = "annually";
            $finalArr[5]['durationame'] = "biennially";
            $finalArr[6]['durationame'] = "triennially";

            $finalArr[1]['setup'] = $pricingData['msetupfee'];
            $finalArr[2]['setup'] = $pricingData['qsetupfee'];
            $finalArr[3]['setup'] = $pricingData['ssetupfee'];
            $finalArr[4]['setup'] = $pricingData['asetupfee'];
            $finalArr[5]['setup'] = $pricingData['bsetupfee'];
            $finalArr[6]['setup'] = $pricingData['tsetupfee'];

            $finalArr[1]['price'] = $pricingData['monthly'];
            $finalArr[2]['price'] = $pricingData['quarterly'];
            $finalArr[3]['price'] = $pricingData['semiannually'];
            $finalArr[4]['price'] = $pricingData['annually'];
            $finalArr[5]['price'] = $pricingData['biennially'];
            $finalArr[6]['price'] = $pricingData['triennially'];
            $strKey = 'intOldPriceOneMonth' . $paramArr['currencycode'];
            if (isset($productPricing[$paramArr['productid']]->$strKey)) {
                $finalArr[1]['wrongprice'] = $productPricing[$paramArr['productid']]->$strKey;
            }

            $strKey = 'intOldPriceThreeMonth' . $paramArr['currencycode'];
            if (isset($productPricing[$paramArr['productid']]->$strKey)) {
                $finalArr[2]['wrongprice'] = $productPricing[$paramArr['productid']]->$strKey;
            }

            $strKey = 'intOldPriceSixMonth' . $paramArr['currencycode'];
            if (isset($productPricing[$paramArr['productid']]->$strKey)) {
                $finalArr[3]['wrongprice'] = $productPricing[$paramArr['productid']]->$strKey;
            }

            $strKey = 'intOldPriceOneYear' . $paramArr['currencycode'];
            if (isset($productPricing[$paramArr['productid']]->$strKey)) {
                $finalArr[4]['wrongprice'] = $productPricing[$paramArr['productid']]->$strKey;
            }

            $strKey = 'intOldPriceTwoYear' . $paramArr['currencycode'];
            if (isset($productPricing[$paramArr['productid']]->$strKey)) {
                $finalArr[5]['wrongprice'] = $productPricing[$paramArr['productid']]->$strKey;
            }

            $strKey = 'intOldPriceThreeYear' . $paramArr['currencycode'];
            if (isset($productPricing[$paramArr['productid']]->$strKey)) {
                $finalArr[6]['wrongprice'] = $productPricing[$paramArr['productid']]->$strKey;
            }


            $finalArr[1]['wrongsetup'] = $pricingData['msetupfee'] + ($pricingData['msetupfee'] / 2);
            $finalArr[2]['wrongsetup'] = $pricingData['qsetupfee'] + ($pricingData['qsetupfee'] / 2);
            $finalArr[3]['wrongsetup'] = $pricingData['ssetupfee'] + ($pricingData['ssetupfee'] / 2);
            $finalArr[4]['wrongsetup'] = $pricingData['asetupfee'] + ($pricingData['asetupfee'] / 2);
            $finalArr[5]['wrongsetup'] = $pricingData['bsetupfee'] + ($pricingData['bsetupfee'] / 2);
            $finalArr[6]['wrongsetup'] = $pricingData['tsetupfee'] + ($pricingData['tsetupfee'] / 2);
        }
        if (!empty($finalArr)) {
            foreach ($finalArr as $key => $ele) {
                if (isset($filter) && !empty($filter)) {
                    if ($ele['price'] >= 0) {   //set only those where price is entered > 0
                        $ele['price'] = str_replace(".00", "", $ele['price']);
                        $arr[$key] = (object) $ele;
                    }
                } else {
                    $ele['price'] = str_replace(".00", "", $ele['price']);
                    $arr[$key] = (object) $ele;
                }
            }
        }
        return $arr;
    }

    public static function getProductDetails($paramArr = array()) {
        $params['productid'] = isset($paramArr['productid']) ? $paramArr['productid'] : "";
        $params['currencycode'] = isset($paramArr['currencycode']) ? $paramArr['currencycode'] : "";

        if (!empty($params['productid']) && $params['currencycode']) {
            $prouctDetails = MyLibrary::laravelcallapi("getproductdetails", $params);
        }
        return $prouctDetails;
    }

    public static function getConfigSetting($paramArr = array()) {
        $params['ids'] = isset($paramArr['ids']) ? $paramArr['ids'] : "";
        $prouctDetails = [];
        if (!empty($params['ids'])) {
            $prouctDetails = MyLibrary::laravelcallapi("generatecustomfields", $params);
        }
        return $prouctDetails;
    }

    public static function updateConfig($request) {
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        if (isset($request->productid)) {
            $productid = $request->productid;
        }
        if (isset($request->fieldid)) {
            $fieldid = $request->fieldid;
        }
        if (isset($request->optionid)) {
            $optionid = $request->optionid;
        }
        foreach ($cartData[$productid]['configfields'] as $key => $configfield) {
            if ($configfield['id'] == $fieldid) {
                $cartData[$productid]['configfields'][$key]['selectedOption'] = $optionid;
            }
        }
        $request->session()->put('cart', $cartData);
        Self::updateCartInDb($request,$cartData); //Update current session in db

    }

    public static function updateCustom($request) {
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        if (isset($request->productid)) {
            $productid = $request->productid;
        }
        if (isset($request->fieldid)) {
            $fieldid = $request->fieldid;
        }
        if (isset($request->val)) {
            $optionid = $request->val;
        }
        if($request->proname=="domain")
        {
            foreach ($cartData[$productid]['customfields'] as $key => $configfield)
            {
                if ($configfield['id'] == $fieldid[$configfield['id']])
                {
                    $cartData[$productid]['customfields'][$key]['selectedOption'] = $optionid[$configfield['id']];
                }
            }
        }
        else
        {   
        foreach ($cartData[$productid]['customfields'] as $key => $configfield) {
            if ($configfield['id'] == $fieldid) {
                $cartData[$productid]['customfields'][$key]['selectedOption'] = $request->val;
            }
            if($configfield['id'] == 'hostname'){
                $cartData[$productid]['customfields'][$key]['selectedOption'] = $request->val;
            }
        }
        }  
        $request->session()->put('cart', $cartData);
        Self::updateCartInDb($request,$cartData); //Update current session in db
    }

    public static function getRcommandedOption($arr, $index) {
        $arrTemp = explode(",", $arr[$index]);
        if (isset($arrTemp[0])) {
            return $arrTemp[0];
        }
        return false;
    }

    public static function getRecommandedProductFeatures($pid) {
        if (!empty($pid)) {
            $response = false;
            $response = DB::table('products_package')
                    ->select('products_package.id', 'products_package.fkProductCategories', 'products_package.fkWhmcsProduct', 'products_package.txtRecommandedFeatures', 'products.varTitle as groupname', 'products_package.varTitle as productname', 'products.txtShortDescription as shortDesc')
                    ->join('product_category', 'product_category.id', '=', 'products_package.fkProductCategories')
                    ->join('products', 'products.id', '=', 'products_package.fkProduct')
                    ->where('products_package.fkWhmcsProduct', $pid)
                    ->first();
            return $response;
        }
    }

    public static function getRcommandedProduct($request) {

        $recommndedArr = unserialize(Config::get('recommandedproducts'));
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        $index = isset($cartData['recommndation']) ? $cartData['recommndation'] : 0;

        //If product already exists in cart then remove from recommandation list.
        if (!empty($cartData) && !empty($recommndedArr)) {
            foreach ($cartData as $item) {
                if (isset($item['pid'])) {
                    foreach ($recommndedArr as $key => $pi) {
                        $productArr = explode(",", $pi);
                        foreach ($productArr as $key2 => $i) {
                            if ($item['pid'] == $i) {
                                unset($productArr[$key2]);
                                $recommndedArr[$key] = implode(",", $productArr);
                                if (isset($recommndedArr[$key])) {
                                    unset($recommndedArr[$key]);
                                }
                            }
                        }
                    }
                }
            }
        }
        $j = $index;
        if(isset($recommndedArr) && !empty($recommndedArr)){
            return Cart::getRcommandedOption($recommndedArr, key($recommndedArr));
        }
        return false;
    }

    public static function extractTldFromDomain($domain) {

        $arr = explode(".", $domain);
        $data['domainname'] = $arr[0];
        unset($arr[0]);
        $data['tld'] = implode(".", $arr);
        $data['fullname'] = $domain;
        return $data;
    }

    public static function checkDomainAvailability($data) {
        $urlstr = Config::get('apiurl'); 
        // $url = str_replace('checkdomain.php','manage/checkdomain.php',$urlstr);
        // $url = 'https://manage.hostitsmart.com/checkdomain.php?';
        $WHMCSUrl = config('app.api_url');
        $url = $WHMCSUrl. '/checkdomain.php?';

        // echo '<pre>url123 : '; print_r($url);exit;
        foreach ($data as $d) {
            $url .= "&domainname=" . $d['domainname'] . "&tlds=" . $d['tld'];
        } 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$url. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (checkDomainAvailability): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        curl_close($ch);
        return $response;
    }

    public static function getProductsData($pid = '', $type = '',$pro_id = '') {

        $response = false;
        if (!empty($type) && $type == 'all') {
            $query = DB::table('products_package')
                    ->select('*')
                    ->join('products', 'products.id', '=', 'products_package.fkProduct');
        } else {
            $query = DB::table('products_package')
                    ->select('products_package.id', 'products_package.fkProductCategories', 'products_package.fkWhmcsProduct', 'products_package.txtRecommandedFeatures', 'products.varTitle as groupname', 'products_package.varTitle as productname', 'products_package.txtSpecification as specifications')
                    ->join('products', 'products.id', '=', 'products_package.fkProduct');
        }
        if (!empty($pid)) {
            $query->where('products_package.fkWhmcsProduct', $pid);
        }
        if (!empty($pro_id)) {
            $query->where('products_package.fkProduct', $pro_id);
        }
        $response = $query->get()->toArray();
        $finalData = array();
        if (!empty($response)) {
            foreach ($response as $item)
                $finalData[$item->fkWhmcsProduct] = $item;
        }
        return $finalData;
    }

    public static function gethitsproducts()
    {       
        $query_product = DB::table('products_package')
                    ->select('products_package.varTitle as packages','products_package.id as proId','products_package.*','products.id as productId','products.*')
                    ->join('products', 'products.id', '=', 'products_package.fkProduct')
                    ->where(['products.chrDelete'=>"N",'products_package.chrPublish' => "Y"])
                    ->get();
        return $query_product;
    }

    public static function gethitspackages()
    {
        $query_packages = DB::table('products_package')
                    ->select('products_package.varTitle','products_package.fkWhmcsProduct','products_package.fkProduct')
                    ->join('products', 'products.id', '=', 'products_package.fkProduct')
                    ->where(['products.chrDelete'=>"N"])
                    ->get();

        return $query_packages;
    }

    public static function getDomainAddonsPricing($paramArr) {
        $params['currency'] = isset($paramArr['currency']) ? $paramArr['currency'] : "";
        if (isset($params['currency'])) {
            if($params['currency'] == 1){
            $pricingDetails['dnsmanagement'][1] = Config::get('Constant.DNSMANAGEMENT_PRICE_INR');
            $pricingDetails['emailforwarding'][1] = Config::get('Constant.EMAILFORWARDING_PRICE_INR');
            $pricingDetails['idprotection'][1] = Config::get('Constant.IDPROTECTION_PRICE_INR'); 
            } else if($params['currency'] == 10){
            $pricingDetails['dnsmanagement'][10] = Config::get('Constant.DNSMANAGEMENT_PRICE_USD');
            $pricingDetails['emailforwarding'][10] = Config::get('Constant.EMAILFORWARDING_PRICE_USD');
            $pricingDetails['idprotection'][10] = Config::get('Constant.IDPROTECTION_PRICE_USD');
            }
        }
        return $pricingDetails;
    }

    public static function convertToWHMCS($request) {
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        $whmcsHash = $request->session()->has('WhmcsHash') ? $request->session()->get('WhmcsHash') : null;
        if(isset($cartData['userid']) && !empty($cartData['userid'])){
            $uid = $cartData['userid'];
        }
        if(isset($cartData) && !empty($cartData)){
            if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
            if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
            if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
            if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
            if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
            if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
        }

        $whmcsCart = [];
        if (!empty($cartData)) {
            foreach ($cartData as $key => $item) {
                if (!isset($item['producttype']))
                    continue;
                $whmcsItem = [];
                if ($item['producttype'] == 'domain') {
                    //for domain only
                    $whmcsItem['type'] = $item['domaintype'];
                    $whmcsItem['domain'] = $item['domain'];
                    $whmcsItem['regperiod'] = $item['regperiod'];
                    $whmcsItem['isPremium'] = '';
                    $whmcsItem['producttype'] = 'domain';
                    if(!empty($item['addonproducts'])){
                        foreach($item['addonproducts'] as $addon){
                            if(isset($addon['added']) && $addon['added'] == $key){
                                if(isset($addon['type']) && $addon['type'] == 'idprotection'){ 
                                    $whmcsItem['idprotection'] = "on";
                                }
                                if(isset($addon['type']) && $addon['type'] == 'emailforwarding'){ 
                                    $whmcsItem['emailforwarding'] = "on";
                                }
                                if(isset($addon['type']) && $addon['type'] == 'dnsmanagement'){ 
                                    $whmcsItem['dnsmanagement'] = "on";
                                }
                            }
                        }
                    }
                } else {
                    //for products 
                    $customFields = $configoptions = [];
                    $whmcsItem['producttype'] = 'product';
                    $whmcsItem['pid'] = $item['pid'];
                    $whmcsItem['domain'] = $item['domain'];
                    $whmcsItem['billingcycle'] = str_replace("-", "", $item['billingcycle']);

                    if (!empty($item['customfields'])) {
                        foreach ($item['customfields'] as $itm) {
                            $val = "";
                            if (isset($itm['selectedOption'])) {
                                if ($itm['fieldtype'] == 'tickbox') { //for tickbox
                                    if ($itm['selectedOption'] == 'true') {
                                        $customFields[$itm['id']] = 'on';
                                    }
                                } else { //for any other fields like textbox, textarea etc..
                                    $customFields[$itm['id']] = $itm['selectedOption'];
                                }
                            }
                        }
                    }

                    if (!empty($item['configfields'])) {

                        foreach ($item['configfields'] as $itm) {
                            $val = "";
                            if (isset($itm['selectedOption'])) {
                                $configoptions[$itm['id']] = $itm['selectedOption']; 
                            }
                        }
                    }
                    $whmcsItem['customfields'] = $customFields;
                    $whmcsItem['configoptions'] = $configoptions;
                    $whmcsItem['addons'] = [];
                    $whmcsItem['server'] = [];
                    $whmcsItem['skipConfig'] = '';
                    if(isset($uid) && !empty($uid)){ $whmcsItem['uid'] = $uid; } //set userid for whmcs.
                    if(isset($whmcsHash) && !empty($whmcsHash)){ $whmcsItem['upw'] = $whmcsHash; } //set password for whmcs.
                }
                if (!empty($whmcsItem))
                    $whmcsCart[] = $whmcsItem;
            }
        }
        return $whmcsCart;
    }

    public static function createOrderSummary($request) {
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        return $cartData;
    }

    public static function setConfigDomain($request) {


        $productid = $request->productid;
        $domainname = $request->domainname;
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        
        /*foreach($cartData as $key => $value)
        {
           if(!empty($productid) && (isset($cartData[$key]['pid']) && $cartData[$key]['pid'] == $productid))    
           { $cartData[$key]['domain'] = $domainname; }
        } */   
        
        $cartData[$productid]['domain'] = $domainname;
        
        $request->session()->put('cart', $cartData);
        Self::updateCartInDb($request,$cartData); //Update current session in db
        return $cartData;
    }

    public static function getClientDetails($id) {
        $params['clientid'] = isset($id) ? $id : "0";
        if (isset($params['clientid'])) {
            $clientDetails = MyLibrary::laravelcallapi("getclient", $params);
        }
        return $clientDetails;
    }
    
    public static function getClientDetailsDb($whmcsid){
        $query_client = DB::table('front_users')
                    ->select('*')
                    ->where(['whmsc_id'=>$whmcsid])
                    ->get();
        return $query_client;
    }

    public static function updateClientDetails(Request $request) {
        Whmcs::updateClient($request);
    }

    public static function generateCountryCombo($sel, $name = '') {
        $countryData = MyLibrary::getCountrieslist($sel);
        if(Session::has('WhmcsID')){
           $uid = Session::get('WhmcsID'); //Whmcs userid
        }
        else{
           $uid = 3428; //Whmcs userid
        }
        
        $clientdata=Cart::getClientDetailsDb($uid);
        $selected_cuntry=$clientdata[0]->country_code;
        
        if(isset($countryData) && $countryData!="")
        {
            $readonly="readonly='true'";    
        }
        else
        {
            $readonly="";
        }
        
        if(empty($sel) || $sel == 'INR'){ $sel = 'IN'; }
       /* $html = '<select class="selectpicker" data-live-search="true" id="' . $name . '" name="' . $name . '">';
        $html .= '<option value="" selected >--- Select ---</option>';
        foreach ($countryData as $key => $country) {
            if ($selected_cuntry == $key) {
                $html .= '<option value="' . $key . '"" selected >' . $country . '</option>';
            } else {
                $html .= '<option value="' . $key . '">' . $country . '</option>';
            }
        }*/
        $html = '<input class="form-control" type ="text" value='.$countryData.' readonly="true">';
        $html .= '<input type ="hidden" value='.$sel.' id="' . $name . '" name="' . $name . '">';
        
        /*$html = '<select class="selectpicker" data-live-search="true" id="' . $name . '" name="' . $name . '" '.$readonly.'>';
        $html .= '<option value="" selected >--- Select ---</option>';
        $html .= '<option value="' . $sel . '"" selected >' . $countryData . '</option>';*/
        /*foreach ($countryData as $key => $country) {
            if ($selected_cuntry == $key) {
                $html .= '<option value="' . $key . '"" selected >' . $country . '</option>';
            } else {
                $html .= '<option value="' . $key . '">' . $country . '</option>';
            }
        }*/
        //$html .= '</select>';
        return $html;
    }

    public static function checkForFreeDomain($pid) {
        $params['productid'] = $pid;
        return MyLibrary::laravelcallapi("getfreedomaindetails", $params);
    }

    public static function getFreeDomains($params) {
        $htmlStr = $html1 = $html2 = '';
        $domainParams = [];
        extract($params);

        if (!empty($alltlds)) {
            foreach ($alltlds as $_tld) {
                $_tld = ltrim($_tld, ".");
                $domainPricing[$_tld] = Cart::getDomainPricing(['tlds' => "." . $_tld, 'currency' => Config::get('user.currency')]);
                //check for Dot in tlds. ".com"
            }
        }

        if (isset($alltlds)) {
            foreach ($alltlds as $tlds) {
                $tlds = ltrim($tlds, ".");
                $domainParams[] = array("domainname" => $domainname, "tld" => $tlds);
            }
        }
        $response = Cart::checkDomainAvailability($domainParams);
        $response = json_decode($response, true);

        $html2 .= '<div class="c-2 c-3 c-4" id="domainsuggestiondiv">
    <h3 class="eligible-text small-text">Get one of these.</h3>
    <ul class="domain-detail">';
        $counter = 0;
        foreach ($response as $key => $domain) {

            $domainDetails = Self::extractTldFromDomain($key);
            //echo $key ."==". $domainname.$tld.'</br>';
            if ($key == $domainname . $tld) {
                if ($domain['status'] == 'available') {
                    $html1 .= '<div class="c-2 c-3" id="domainavaildiv">
                        <h3 class="eligible-text small-text">Your domain is available.</h3>
                        <ul class="bg-green domain-detail">
                            <li class="d-flex"><span class="domain-name">' . $domainname . $tld . '</span><span class="domain-right"><span class="rupees d-none d-md-inline-block">' . Config::get('Constant.sys_currency_symbol') . '</span><span class="price-overline d-none d-md-inline-block">' . $domainPricing[$domainDetails['tld']][0]->wrongprice . '/mo</span><span class="original-price"><span class="rupees">' . Config::get('Constant.sys_currency_symbol') . '</span>' . $domainPricing[$domainDetails['tld']][0]->register . '<span class="light">/mo</span></span><button class="btn btn-full" title="Add" onclick="return addFreeDomainInCart(' . $counter . ',this);">Add</button><form id="freeDomainFrm_' . $counter . '" name="freeDomainFrm_' . $counter . '" action="javascript:void(0);">
    <input type="hidden" id="_token" name="_token" value="' . csrf_token() . '"/>
    <input type="hidden" id="producttype" name="producttype[]" value="domain"/>
    <input type="hidden" id="domain" name="domain[]" value="' . $key . '"/>
    <input type="hidden" id="tld" name="tld[]" value=".' . $domainDetails['tld'] . '"/>
    <input type="hidden" id="domaintype" name="domaintype[]" value="register"/>
    <input type="hidden" id="regperiod" name="regperiod[]" value="1"/>
    <input type="hidden" id="relproid" name="relproid[]" value="' . $params['relproid'] . '"/>
    
</form></span></li>
                        </ul>
                    </div>';
                }
            } else {
                $html2 .= '<li class="d-flex">' . $key . '</span>
            <span class="domain-right">
                <span class="price-overline d-none d-md-inline-block">
                    <span class="rupees">' . Config::get('Constant.sys_currency_symbol') . '</span>
                    <span class="overline">' . $domainPricing[$domainDetails['tld']][0]->wrongprice . '/mo</span>
                </span>
                <span class="original-price">
                    <span class="rupees">' . Config::get('Constant.sys_currency_symbol') . '</span>' . $domainPricing[$domainDetails['tld']][0]->register . '
                    <span class="light">/mo</span>
                </span>
                <button class="btn" title="Add" onclick="return addFreeDomainInCart(' . $counter . ',this);">Add</button><form id="freeDomainFrm_' . $counter . '" name="freeDomainFrm_' . $counter . '" action="javascript:void(0);">
    <input type="hidden" id="_token" name="_token" value="' . csrf_token() . '"/>
    <input type="hidden" id="producttype" name="producttype[]" value="domain"/>
    <input type="hidden" id="domain" name="domain[]" value="' . $key . '"/>
    <input type="hidden" id="tld" name="tld[]" value=".' . $domainDetails['tld'] . '"/>
    <input type="hidden" id="domaintype" name="domaintype[]" value="register"/>
    <input type="hidden" id="regperiod" name="regperiod[]" value="1"/>
    <input type="hidden" id="relproid" name="relproid[]" value="' . $params['relproid'] . '"/>
</form>
            </span>
        </li>';
            }
            $counter ++;
        }
        $html2 .= '</ul></div>';
        $htmlStr .= $html1 . $html2;
        return $htmlStr;
    }

    public static function getSearchCartDomains($params) {

        $htmlStr = $html1 = $html2 = '';
        $domainParams = [];
        extract($params);

        if (!empty($alltlds)) {
            foreach ($alltlds as $_tld) {
                $_tld = ltrim($_tld, ".");
                $domainPricing[$_tld] = Cart::getDomainPricing(['tlds' => "." . $_tld, 'currency' => Config::get('user.currency')]);
                //check for Dot in tlds. ".com"
            }
        }

        if (isset($alltlds)) {
            foreach ($alltlds as $tlds) {
                $tlds = ltrim($tlds, ".");
                $domainParams[] = array("domainname" => $domainname, "tld" => $tlds);
            }
        }
        $response = Cart::checkDomainAvailability($domainParams);
        
        $response = json_decode($response, true);

        $html2 .= '<div class="c-2 c-3 c-4" id="cartdomainsuggestiondiv">
    <h3 class="eligible-text small-text">Get one of these.</h3>
    <ul class="domain-detail">';
        $counter = 0;
        
        foreach ($response as $key => $domain) {

            $domainDetails = Self::extractTldFromDomain($key);
            //echo $key ."==". $domainname.$tld.'</br>';
            //echo $tld.'</br>';
            if ($key == $domainname . $tld) {
                if ($domain['status'] == 'available') {
                    $html1 .= '<div class="c-2 c-3" id="cartdomainavaildiv">
                        <h3 class="eligible-text small-text">Your domain is available.</h3>
                        <ul class="bg-green domain-detail">
                            <li class="d-flex"><span class="domain-name">' . $domainname . $tld . '</span><span class="domain-right"><span class="rupees d-none d-md-inline-block">' . Config::get('Constant.sys_currency_symbol') . '</span><span class="price-overline d-none d-md-inline-block">' . $domainPricing[$domainDetails['tld']][0]->wrongprice . '/mo</span><span class="original-price"><span class="rupees">' . Config::get('Constant.sys_currency_symbol') . '</span>' . $domainPricing[$domainDetails['tld']][0]->register . '<span class="light">/mo</span></span><button class="btn btn-full" title="Add" onclick="return addCartDomainInCart(' . $counter . ',this);">Add</button><form id="cartDomainFrm_' . $counter . '" name="cartDomainFrm_' . $counter . '" action="javascript:void(0);">
    <input type="hidden" id="_token" name="_token" value="' . csrf_token() . '"/>
    <input type="hidden" id="producttype" name="producttype[]" value="domain"/>
    <input type="hidden" id="domain" name="domain[]" value="' . $key . '"/>
    <input type="hidden" id="tld" name="tld[]" value=".' . $domainDetails['tld'] . '"/>
    <input type="hidden" id="domaintype" name="domaintype[]" value="register"/>
    <input type="hidden" id="regperiod" name="regperiod[]" value="1"/>
    </form></span></li>
                        </ul>
                    </div>';
                }
            } else {
                $html2 .= '<li class="d-flex">' . $key . '</span>
            <span class="domain-right">
                <span class="price-overline d-none d-md-inline-block">
                    <span class="rupees">' . Config::get('Constant.sys_currency_symbol') . '</span>
                    <span class="overline">' . $domainPricing[$domainDetails['tld']][0]->wrongprice . '/mo</span>
                </span>
                <span class="original-price">
                    <span class="rupees">' . Config::get('Constant.sys_currency_symbol') . '</span>' . $domainPricing[$domainDetails['tld']][0]->register . '
                    <span class="light">/mo</span>
                </span>
                <button class="btn" title="Add" onclick="return addCartDomainInCart(' . $counter . ',this);">Add</button><form id="cartDomainFrm_' . $counter . '" name="cartDomainFrm_' . $counter . '" action="javascript:void(0);">
    <input type="hidden" id="_token" name="_token" value="' . csrf_token() . '"/>
    <input type="hidden" id="producttype" name="producttype[]" value="domain"/>
    <input type="hidden" id="domain" name="domain[]" value="' . $key . '"/>
    <input type="hidden" id="tld" name="tld[]" value=".' . $domainDetails['tld'] . '"/>
    <input type="hidden" id="domaintype" name="domaintype[]" value="register"/>
    <input type="hidden" id="regperiod" name="regperiod[]" value="1"/>
    </form>
            </span>
        </li>';
            }
            $counter ++;
        }
        $html2 .= '</ul></div>';
        $htmlStr .= $html1 . $html2;
        return $htmlStr;
    }

    public static function GetTldData($paramArr = array()) {

        $currency = isset($paramArr["currency"]) ? $paramArr["currency"] : 'INR';
        $Tld = isset($paramArr["tld"]) ? $paramArr["tld"] : '';
        $domain_type = isset($paramArr["domain_type"]) ? $paramArr["domain_type"] : '';
        $featured = isset($paramArr["featured_product"]) ? $paramArr["featured_product"] : '';

        $min_price = isset($paramArr["min"]) ? $paramArr["min"] : '0';
        $max_price = isset($paramArr["max"]) ? $paramArr["max"] : '500';
        $reg_price = isset($paramArr["regperiod"]) ? $paramArr["regperiod"] : '1';

        if ($domain_type == 'both' && !empty($Tld)) {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(function($query) {
                        $query->where(['whmcs_tlds_price.type' => "domaintransfer"])->orWhere(['whmcs_tlds_price.type' => 'domainregister']);
                    })
                    ->where(['tld.varTitle' => $Tld])
                    ->orderBy('tld.id')
                    ->get();
        } else if ($Tld != '' && !empty($Tld)) {

            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => $domain_type])
                    ->where(['tld.varTitle' => $Tld])
                    ->orderBy('tld.id')
                    ->get();
        } else if ($featured == 'Y') {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID', 'alias.varAlias'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->join('alias', 'tld.intAliasId', '=', 'alias.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => $domain_type])
                    ->where(['tld.chrIsFeatured' => 'Y'])
                    ->orderBy('tld.id')
                    ->limit(10)
                    ->get();
        } else if (!empty($min_price) && !empty($max_price) && !empty($reg_price)) {
            $reg_price_field = "whmcs_tlds_price.Price" . $reg_price;
            $response_data = DB::table('tld')
                    ->select(['tld.varTitle', $reg_price_field])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->join('alias', 'tld.intAliasId', '=', 'alias.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => $domain_type])
                    ->whereBetween($reg_price_field, [$min_price, $max_price])
                    ->orderBy('tld.id')
                    ->get();
        } else {
            $response_data = DB::table('tld')
                    ->select(['whmcs_tlds_price.*', 'tld.varTitle', 'tld.id as Tld_ID'])
                    ->join('whmcs_tlds_price', 'whmcs_tlds_price.fk_tldname', '=', 'tld.id')
                    ->where(['whmcs_tlds_price.currency' => $currency])
                    ->where(['whmcs_tlds_price.type' => $domain_type])
                    ->orderBy('tld.id')
                    ->get();
        }

//        dd($response_data);
        return $response_data;
    }

    public static function getPaymentLink($postfields) {

        $siteurl = Config::get('hitsupdatecart');
        $apiurl = Config::get('hitsupdatecart') . "/getpaymentlink.php?id=" . $postfields['id'] . "&gateway=" . $postfields['gateway']."&h=".$_SERVER['HTTP_HOST'];

        //Logic: Call to whmcs external api
        //parameters: according to api requirements
        //return:  data retrieved from API calls in JSON Format  

        $fields = http_build_query($postfields);
        $ch = curl_init($apiurl);
        curl_setopt($ch, CURLOPT_POST, false);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        $result = curl_exec($ch);

        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (getPaymentLink): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    public static function getOrderIdFromInvoiceId($paramArr) {
        $params['invoiceid'] = isset($paramArr['invoiceid']) ? $paramArr['invoiceid'] : "";
        if (isset($params['invoiceid'])) {
            $data = MyLibrary::laravelcallapi("getorderidfrominvoicveid", $params);
        }
        return $data;
    }
    public static function getOrderDetails($paramArr){
        $params['id'] = isset($paramArr['id']) ? $paramArr['id'] : "";
        if (isset($params['id'])) {
            $data = MyLibrary::laravelcallapi("getordersdetails", $params);
        }
        return $data['orders']['order'][0];
    }
    public static function getInvoiceDetails($paramArr){
        $params['invoiceid'] = isset($paramArr['invoiceid']) ? $paramArr['invoiceid'] : "";
        if (isset($params['invoiceid'])) {
            $data = MyLibrary::laravelcallapi("getinvoicedetails", $params);
        }
        return $data;
    }
    public static function sendOrderEmail($orderid){
        $orderDetails = Cart::getOrderDetails(['id' => $orderid]);
        if(isset($orderDetails['invoiceid']))
        { $invoiceDetails = Cart::getInvoiceDetails(['invoiceid' => $orderDetails['invoiceid']]); }
        
        if(isset($orderDetails['userid']))
        { $userDetails = Cart::getClientDetails($orderDetails['userid']); }

        $AllData = [];
        if(isset($userDetails['fullname']) && !empty($userDetails['fullname'])) //if full name found
        { $AllData["name"] = $userDetails['fullname']; }
        else if(isset($userDetails['firstname']) && !empty($userDetails['firstname'])) //else if firstname lastname found
        { $AllData["name"] = $userDetails['firstname']. " " .$userDetails['lastname']; }
        else if(isset($userDetails['companyname']) && !empty($userDetails['companyname'])) //else company found
        { $AllData["name"] = $userDetails['companyname']; }
        else
        { $AllData["name"] = $userDetails['email']; } // last set email id.
        foreach($orderDetails['lineitems']['lineitem'] as  $key => $item){
           $str = str_replace(".00","", $item['amount']);
           $str = str_replace("INR", "",$str);
           $str = str_replace(",", "",$str);
           $orderDetails['lineitems']['lineitem'][$key]['amount'] = str_replace("USD", "", $str);
        }
        $AllData['email'] = $userDetails['email'];
        $AllData['orderid'] = $orderid;
        $AllData['orderitems'] = $orderDetails['lineitems']['lineitem'];
        $AllData['subtotal'] =  str_replace(".00", "",$invoiceDetails['subtotal']);
        $AllData['tax'] = $invoiceDetails['tax'] + $invoiceDetails['tax2'];
        $AllData['total'] = $invoiceDetails['total'];
        $AllData['currency_code'] = ($userDetails['currency_code'] == 'INR')?"&#8377;":"&#36;";
        $AllData['invoiceid'] = $orderDetails['invoiceid'];
        Email_sender::orderemail($AllData);
    }
    public static function addFrontOrder($data) {
        //Add Front side user order data for log.
        //echo '<pre>'; print_r($data); exit;
        //try { 
        DB::table('front_order')->insert($data);
        //} catch(\Illuminate\Database\QueryException $ex){ 
        //dd($ex->getMessage()); 
        //}
    }
    public static function getvpsconfiguration(){
        $configPricing = array();
        //[productid][config][configval][month][currency] = value
        
        //Open Vz
        //Open Vz CPU 2 Core----------------------
        $configPricing[154]['cpu'][2][1]['INR'] = 0;
        $configPricing[154]['cpu'][2]['quarterly']['INR'] = 0;
        $configPricing[154]['cpu'][2]['semi-annually']['INR'] = 0;
        $configPricing[154]['cpu'][2]['annually']['INR'] = 0;
        $configPricing[154]['cpu'][2][24]['INR'] = 0;
        $configPricing[154]['cpu'][2][36]['INR'] = 0;

        $configPricing[154]['cpu'][2][1]['USD'] = 0;
        $configPricing[154]['cpu'][2]['quarterly']['USD'] = 0;
        $configPricing[154]['cpu'][2]['semi-annually']['USD'] = 0;
        $configPricing[154]['cpu'][2]['annually']['USD'] = 0;
        $configPricing[154]['cpu'][2][24]['USD'] = 0;
        $configPricing[154]['cpu'][2][36]['USD'] = 0;
        //CPU------------------------------------------

        //Open Vz CPU 4 Core--------------------
        $configPricing[154]['cpu'][4][1]['INR'] = 50;
        $configPricing[154]['cpu'][4]['quarterly']['INR'] = 150;
        $configPricing[154]['cpu'][4]['semi-annually']['INR'] = 300;
        $configPricing[154]['cpu'][4]['annually']['INR'] = 600;
        $configPricing[154]['cpu'][4][24]['INR'] = 0;
        $configPricing[154]['cpu'][4][36]['INR'] = 0;

        $configPricing[154]['cpu'][4][1]['USD'] = 1;
        $configPricing[154]['cpu'][4]['quarterly']['USD'] = 3;
        $configPricing[154]['cpu'][4]['semi-annually']['USD'] = 6;
        $configPricing[154]['cpu'][4]['annually']['USD'] = 12;
        $configPricing[154]['cpu'][4][24]['USD'] = 0;
        $configPricing[154]['cpu'][4][36]['USD'] = 0;
        //CPU------------------------------------------

        //Open Vz RAM 2 GB----------------------
        $configPricing[154]['ram'][2][1]['INR'] = 0;
        $configPricing[154]['ram'][2]['quarterly']['INR'] = 0;
        $configPricing[154]['ram'][2]['semi-annually']['INR'] = 0;
        $configPricing[154]['ram'][2]['annually']['INR'] = 0;
        $configPricing[154]['ram'][2][24]['INR'] = 0;
        $configPricing[154]['ram'][2][36]['INR'] = 0;

        $configPricing[154]['ram'][2][1]['USD'] = 0;
        $configPricing[154]['ram'][2]['quarterly']['USD'] = 0;
        $configPricing[154]['ram'][2]['semi-annually']['USD'] = 0;
        $configPricing[154]['ram'][2]['annually']['USD'] = 0;
        $configPricing[154]['ram'][2][24]['USD'] = 0;
        $configPricing[154]['ram'][2][36]['USD'] = 0;
        //RAM-----------------------------------

        //Open Vz RAM 4 GB----------------------
        $configPricing[154]['ram'][4][1]['INR'] = 100;
        $configPricing[154]['ram'][4]['quarterly']['INR'] = 300;
        $configPricing[154]['ram'][4]['semi-annually']['INR'] = 600;
        $configPricing[154]['ram'][4]['annually']['INR'] = 1200;
        $configPricing[154]['ram'][4][24]['INR'] = 0;
        $configPricing[154]['ram'][4][36]['INR'] = 0;

        $configPricing[154]['ram'][4][1]['USD'] = 2;
        $configPricing[154]['ram'][4]['quarterly']['USD'] = 6;
        $configPricing[154]['ram'][4]['semi-annually']['USD'] = 12;
        $configPricing[154]['ram'][4]['annually']['USD'] = 24;
        $configPricing[154]['ram'][4][24]['USD'] = 0;
        $configPricing[154]['ram'][4][36]['USD'] = 0;
        //RAM-----------------------------------

        //Open Vz RAM 8 GB----------------------
        $configPricing[154]['ram'][8][1]['INR'] = 200;
        $configPricing[154]['ram'][8]['quarterly']['INR'] = 600;
        $configPricing[154]['ram'][8]['semi-annually']['INR'] = 1200;
        $configPricing[154]['ram'][8]['annually']['INR'] = 2400;
        $configPricing[154]['ram'][8][24]['INR'] = 0;
        $configPricing[154]['ram'][8][36]['INR'] = 0;

        $configPricing[154]['ram'][8][1]['USD'] = 4;
        $configPricing[154]['ram'][8]['quarterly']['USD'] = 12;
        $configPricing[154]['ram'][8]['semi-annually']['USD'] = 24;
        $configPricing[154]['ram'][8]['annually']['USD'] = 48;
        $configPricing[154]['ram'][8][24]['USD'] = 0;
        $configPricing[154]['ram'][8][36]['USD'] = 0;
        //RAM-----------------------------------

        //Open Vz HDD 20 GB----------------------
        $configPricing[154]['hdd'][20][1]['INR'] = 0;
        $configPricing[154]['hdd'][20]['quarterly']['INR'] = 0;
        $configPricing[154]['hdd'][20]['semi-annually']['INR'] = 0;
        $configPricing[154]['hdd'][20]['annually']['INR'] = 0;
        $configPricing[154]['hdd'][20][24]['INR'] = 0;
        $configPricing[154]['hdd'][20][36]['INR'] = 0;

        $configPricing[154]['hdd'][20][1]['USD'] = 0;
        $configPricing[154]['hdd'][20]['quarterly']['USD'] = 0;
        $configPricing[154]['hdd'][20]['semi-annually']['USD'] = 0;
        $configPricing[154]['hdd'][20]['annually']['USD'] = 0;
        $configPricing[154]['hdd'][20][24]['USD'] = 0;
        $configPricing[154]['hdd'][20][36]['USD'] = 0;
        //HDD ------------------------------------

        //Open Vz HDD 40 GB----------------------
        $configPricing[154]['hdd'][40][1]['INR'] = 100;
        $configPricing[154]['hdd'][40]['quarterly']['INR'] = 300;
        $configPricing[154]['hdd'][40]['semi-annually']['INR'] = 600;
        $configPricing[154]['hdd'][40]['annually']['INR'] = 1200;
        $configPricing[154]['hdd'][40][24]['INR'] = 0;
        $configPricing[154]['hdd'][40][36]['INR'] = 0;

        $configPricing[154]['hdd'][40][1]['USD'] = 2;
        $configPricing[154]['hdd'][40]['quarterly']['USD'] = 6;
        $configPricing[154]['hdd'][40]['semi-annually']['USD'] = 12;
        $configPricing[154]['hdd'][40]['annually']['USD'] = 24;
        $configPricing[154]['hdd'][40][24]['USD'] = 0;
        $configPricing[154]['hdd'][40][36]['USD'] = 0;
        //HDD ------------------------------------

        //Open Vz HDD 80 GB----------------------
        $configPricing[154]['hdd'][80][1]['INR'] = 200;
        $configPricing[154]['hdd'][80]['quarterly']['INR'] = 600;
        $configPricing[154]['hdd'][80]['semi-annually']['INR'] = 1200;
        $configPricing[154]['hdd'][80]['annually']['INR'] = 2400;
        $configPricing[154]['hdd'][80][24]['INR'] = 0;
        $configPricing[154]['hdd'][80][36]['INR'] = 0;

        $configPricing[154]['hdd'][80][1]['USD'] = 4;
        $configPricing[154]['hdd'][80]['quarterly']['USD'] = 12;
        $configPricing[154]['hdd'][80]['semi-annually']['USD'] = 24;
        $configPricing[154]['hdd'][80]['annually']['USD'] = 48;
        $configPricing[154]['hdd'][80][24]['USD'] = 0;
        $configPricing[154]['hdd'][80][36]['USD'] = 0;
        //HDD ------------------------------------

        //Open Vz HDD 120 GB----------------------
        $configPricing[154]['hdd'][120][1]['INR'] = 400;
        $configPricing[154]['hdd'][120]['quarterly']['INR'] = 1200;
        $configPricing[154]['hdd'][120]['semi-annually']['INR'] = 2400;
        $configPricing[154]['hdd'][120]['annually']['INR'] = 4800;
        $configPricing[154]['hdd'][120][24]['INR'] = 0;
        $configPricing[154]['hdd'][120][36]['INR'] = 0;

        $configPricing[154]['hdd'][120][1]['USD'] = 8;
        $configPricing[154]['hdd'][120]['quarterly']['USD'] = 24;
        $configPricing[154]['hdd'][120]['semi-annually']['USD'] = 48;
        $configPricing[154]['hdd'][120]['annually']['USD'] = 96;
        $configPricing[154]['hdd'][120][24]['USD'] = 0;
        $configPricing[154]['hdd'][120][36]['USD'] = 0;
        //HDD ------------------------------------

        //-----------------------------------------------------------------------

        //KVM
        //KVM CPU 2 Core----------------------
        $configPricing[164]['cpu'][2][1]['INR'] = 0;
        $configPricing[164]['cpu'][2]['quarterly']['INR'] = 0;
        $configPricing[164]['cpu'][2]['semi-annually']['INR'] = 0;
        $configPricing[164]['cpu'][2]['annually']['INR'] = 0;
        $configPricing[164]['cpu'][2][24]['INR'] = 0;
        $configPricing[164]['cpu'][2][36]['INR'] = 0;

        $configPricing[164]['cpu'][2][1]['USD'] = 0;
        $configPricing[164]['cpu'][2]['quarterly']['USD'] = 0;
        $configPricing[164]['cpu'][2]['semi-annually']['USD'] = 0;
        $configPricing[164]['cpu'][2]['annually']['USD'] = 0;
        $configPricing[164]['cpu'][2][24]['USD'] = 0;
        $configPricing[164]['cpu'][2][36]['USD'] = 0;
        //CPU------------------------------------------

        //KVM CPU 4 Core--------------------
        $configPricing[164]['cpu'][4][1]['INR'] = 100;
        $configPricing[164]['cpu'][4]['quarterly']['INR'] = 300;
        $configPricing[164]['cpu'][4]['semi-annually']['INR'] = 600;
        $configPricing[164]['cpu'][4]['annually']['INR'] = 1200;
        $configPricing[164]['cpu'][4][24]['INR'] = 0;
        $configPricing[164]['cpu'][4][36]['INR'] = 0;

        $configPricing[164]['cpu'][4][1]['USD'] = 2;
        $configPricing[164]['cpu'][4]['quarterly']['USD'] = 6;
        $configPricing[164]['cpu'][4]['semi-annually']['USD'] = 12;
        $configPricing[164]['cpu'][4]['annually']['USD'] = 24;
        $configPricing[164]['cpu'][4][24]['USD'] = 0;
        $configPricing[164]['cpu'][4][36]['USD'] = 0;
        //CPU------------------------------------------

        //KVM RAM 2 GB----------------------
        $configPricing[164]['ram'][2][1]['INR'] = 0;
        $configPricing[164]['ram'][2]['quarterly']['INR'] = 0;
        $configPricing[164]['ram'][2]['semi-annually']['INR'] = 0;
        $configPricing[164]['ram'][2]['annually']['INR'] = 0;
        $configPricing[164]['ram'][2][24]['INR'] = 0;
        $configPricing[164]['ram'][2][36]['INR'] = 0;

        $configPricing[164]['ram'][2][1]['USD'] = 0;
        $configPricing[164]['ram'][2]['quarterly']['USD'] = 0;
        $configPricing[164]['ram'][2]['semi-annually']['USD'] = 0;
        $configPricing[164]['ram'][2]['annually']['USD'] = 0;
        $configPricing[164]['ram'][2][24]['USD'] = 0;
        $configPricing[164]['ram'][2][36]['USD'] = 0;
        //RAM-----------------------------------

        //KVM RAM 4 GB----------------------
        $configPricing[164]['ram'][4][1]['INR'] = 200;
        $configPricing[164]['ram'][4]['quarterly']['INR'] = 600;
        $configPricing[164]['ram'][4]['semi-annually']['INR'] = 1200;
        $configPricing[164]['ram'][4]['annually']['INR'] = 2400;
        $configPricing[164]['ram'][4][24]['INR'] = 0;
        $configPricing[164]['ram'][4][36]['INR'] = 0;

        $configPricing[164]['ram'][4][1]['USD'] = 4;
        $configPricing[164]['ram'][4]['quarterly']['USD'] = 12;
        $configPricing[164]['ram'][4]['semi-annually']['USD'] = 24;
        $configPricing[164]['ram'][4]['annually']['USD'] = 48;
        $configPricing[164]['ram'][4][24]['USD'] = 0;
        $configPricing[164]['ram'][4][36]['USD'] = 0;
        //RAM-----------------------------------

        //KVM RAM 8 GB----------------------
        $configPricing[164]['ram'][8][1]['INR'] = 400;
        $configPricing[164]['ram'][8]['quarterly']['INR'] = 1200;
        $configPricing[164]['ram'][8]['semi-annually']['INR'] = 2400;
        $configPricing[164]['ram'][8]['annually']['INR'] = 4800;
        $configPricing[164]['ram'][8][24]['INR'] = 0;
        $configPricing[164]['ram'][8][36]['INR'] = 0;

        $configPricing[164]['ram'][8][1]['USD'] = 8;
        $configPricing[164]['ram'][8]['quarterly']['USD'] = 24;
        $configPricing[164]['ram'][8]['semi-annually']['USD'] = 48;
        $configPricing[164]['ram'][8]['annually']['USD'] = 96;
        $configPricing[164]['ram'][8][24]['USD'] = 0;
        $configPricing[164]['ram'][8][36]['USD'] = 0;
        //RAM-----------------------------------

        //KVM HDD 20 GB----------------------
        $configPricing[164]['hdd'][20][1]['INR'] = 0;
        $configPricing[164]['hdd'][20]['quarterly']['INR'] = 0;
        $configPricing[164]['hdd'][20]['semi-annually']['INR'] = 0;
        $configPricing[164]['hdd'][20]['annually']['INR'] = 0;
        $configPricing[164]['hdd'][20][24]['INR'] = 0;
        $configPricing[164]['hdd'][20][36]['INR'] = 0;

        $configPricing[164]['hdd'][20][1]['USD'] = 0;
        $configPricing[164]['hdd'][20]['quarterly']['USD'] = 0;
        $configPricing[164]['hdd'][20]['semi-annually']['USD'] = 0;
        $configPricing[164]['hdd'][20]['annually']['USD'] = 0;
        $configPricing[164]['hdd'][20][24]['USD'] = 0;
        $configPricing[164]['hdd'][20][36]['USD'] = 0;
        //HDD ------------------------------------

        //KVM HDD 40 GB----------------------
        $configPricing[164]['hdd'][40][1]['INR'] = 200;
        $configPricing[164]['hdd'][40]['quarterly']['INR'] = 600;
        $configPricing[164]['hdd'][40]['semi-annually']['INR'] = 1200;
        $configPricing[164]['hdd'][40]['annually']['INR'] = 2400;
        $configPricing[164]['hdd'][40][24]['INR'] = 0;
        $configPricing[164]['hdd'][40][36]['INR'] = 0;

        $configPricing[164]['hdd'][40][1]['USD'] = 4;
        $configPricing[164]['hdd'][40]['quarterly']['USD'] = 12;
        $configPricing[164]['hdd'][40]['semi-annually']['USD'] = 24;
        $configPricing[164]['hdd'][40]['annually']['USD'] = 48;
        $configPricing[164]['hdd'][40][24]['USD'] = 0;
        $configPricing[164]['hdd'][40][36]['USD'] = 0;
        //HDD ------------------------------------

        //KVM HDD 80 GB----------------------
        $configPricing[164]['hdd'][80][1]['INR'] = 400;
        $configPricing[164]['hdd'][80]['quarterly']['INR'] = 1200;
        $configPricing[164]['hdd'][80]['semi-annually']['INR'] = 2400;
        $configPricing[164]['hdd'][80]['annually']['INR'] = 4800;
        $configPricing[164]['hdd'][80][24]['INR'] = 0;
        $configPricing[164]['hdd'][80][36]['INR'] = 0;

        $configPricing[164]['hdd'][80][1]['USD'] = 8;
        $configPricing[164]['hdd'][80]['quarterly']['USD'] = 24;
        $configPricing[164]['hdd'][80]['semi-annually']['USD'] = 48;
        $configPricing[164]['hdd'][80]['annually']['USD'] = 96;
        $configPricing[164]['hdd'][80][24]['USD'] = 0;
        $configPricing[164]['hdd'][80][36]['USD'] = 0;
        //HDD ------------------------------------

        //KVM HDD 120 GB----------------------
        $configPricing[164]['hdd'][120][1]['INR'] = 800;
        $configPricing[164]['hdd'][120]['quarterly']['INR'] = 2400;
        $configPricing[164]['hdd'][120]['semi-annually']['INR'] = 4800;
        $configPricing[164]['hdd'][120]['annually']['INR'] = 9600;
        $configPricing[164]['hdd'][120][24]['INR'] = 0;
        $configPricing[164]['hdd'][120][36]['INR'] = 0;

        $configPricing[164]['hdd'][120][1]['USD'] = 16;
        $configPricing[164]['hdd'][120]['quarterly']['USD'] = 48;
        $configPricing[164]['hdd'][120]['semi-annually']['USD'] = 96;
        $configPricing[164]['hdd'][120]['annually']['USD'] = 192;
        $configPricing[164]['hdd'][120][24]['USD'] = 0;
        $configPricing[164]['hdd'][120][36]['USD'] = 0;
        //HDD ------------------------------------

        //-----------------------------------------------------------------------
        //Virtuzzo
        //Virtuzzo CPU 2 Core----------------------
        $configPricing[190]['cpu'][2][1]['INR'] = 0;
        $configPricing[190]['cpu'][2]['quarterly']['INR'] = 0;
        $configPricing[190]['cpu'][2]['semi-annually']['INR'] = 0;
        $configPricing[190]['cpu'][2]['annually']['INR'] = 0;
        $configPricing[190]['cpu'][2][24]['INR'] = 0;
        $configPricing[190]['cpu'][2][36]['INR'] = 0;

        $configPricing[190]['cpu'][2][1]['USD'] = 0;
        $configPricing[190]['cpu'][2]['quarterly']['USD'] = 0;
        $configPricing[190]['cpu'][2]['semi-annually']['USD'] = 0;
        $configPricing[190]['cpu'][2]['annually']['USD'] = 0;
        $configPricing[190]['cpu'][2][24]['USD'] = 0;
        $configPricing[190]['cpu'][2][36]['USD'] = 0;
        //CPU------------------------------------------

        //Virtuzzo CPU 4 Core--------------------
        $configPricing[190]['cpu'][4][1]['INR'] = 900;
        $configPricing[190]['cpu'][4]['quarterly']['INR'] = 2700;
        $configPricing[190]['cpu'][4]['semi-annually']['INR'] = 5400;
        $configPricing[190]['cpu'][4]['annually']['INR'] = 10800;
        $configPricing[190]['cpu'][4][24]['INR'] = 0;
        $configPricing[190]['cpu'][4][36]['INR'] = 0;

        $configPricing[190]['cpu'][4][1]['USD'] = 18;
        $configPricing[190]['cpu'][4]['quarterly']['USD'] = 54;
        $configPricing[190]['cpu'][4]['semi-annually']['USD'] = 108;
        $configPricing[190]['cpu'][4]['annually']['USD'] = 216;
        $configPricing[190]['cpu'][4][24]['USD'] = 0;
        $configPricing[190]['cpu'][4][36]['USD'] = 0;
        //CPU------------------------------------------

        //Virtuzzo RAM 2 GB----------------------
        $configPricing[190]['ram'][2][1]['INR'] = 0;
        $configPricing[190]['ram'][2]['quarterly']['INR'] = 0;
        $configPricing[190]['ram'][2]['semi-annually']['INR'] = 0;
        $configPricing[190]['ram'][2]['annually']['INR'] = 0;
        $configPricing[190]['ram'][2][24]['INR'] = 0;
        $configPricing[190]['ram'][2][36]['INR'] = 0;

        $configPricing[190]['ram'][2][1]['USD'] = 0;
        $configPricing[190]['ram'][2]['quarterly']['USD'] = 0;
        $configPricing[190]['ram'][2]['semi-annually']['USD'] = 0;
        $configPricing[190]['ram'][2]['annually']['USD'] = 0;
        $configPricing[190]['ram'][2][24]['USD'] = 0;
        $configPricing[190]['ram'][2][36]['USD'] = 0;
        //RAM-----------------------------------

        //Virtuzzo RAM 4 GB----------------------
        $configPricing[190]['ram'][4][1]['INR'] = 500;
        $configPricing[190]['ram'][4]['quarterly']['INR'] = 1500;
        $configPricing[190]['ram'][4]['semi-annually']['INR'] = 3000;
        $configPricing[190]['ram'][4]['annually']['INR'] = 6000;
        $configPricing[190]['ram'][4][24]['INR'] = 0;
        $configPricing[190]['ram'][4][36]['INR'] = 0;

        $configPricing[190]['ram'][4][1]['USD'] = 10;
        $configPricing[190]['ram'][4]['quarterly']['USD'] = 30;
        $configPricing[190]['ram'][4]['semi-annually']['USD'] = 60;
        $configPricing[190]['ram'][4]['annually']['USD'] = 120;
        $configPricing[190]['ram'][4][24]['USD'] = 0;
        $configPricing[190]['ram'][4][36]['USD'] = 0;
        //RAM-----------------------------------

        //Virtuzzo RAM 8 GB---------------------- 
        $configPricing[190]['ram'][8][1]['INR'] = 1000;
        $configPricing[190]['ram'][8]['quarterly']['INR'] = 3000;
        $configPricing[190]['ram'][8]['semi-annually']['INR'] = 6000;
        $configPricing[190]['ram'][8]['annually']['INR'] = 12000;
        $configPricing[190]['ram'][8][24]['INR'] = 0;
        $configPricing[190]['ram'][8][36]['INR'] = 0;

        $configPricing[190]['ram'][8][1]['USD'] = 20;
        $configPricing[190]['ram'][8]['quarterly']['USD'] = 60;
        $configPricing[190]['ram'][8]['semi-annually']['USD'] = 120;
        $configPricing[190]['ram'][8]['annually']['USD'] = 240;
        $configPricing[190]['ram'][8][24]['USD'] = 0;
        $configPricing[190]['ram'][8][36]['USD'] = 0;
        //RAM-----------------------------------

        //Virtuzzo HDD 20 GB----------------------
        $configPricing[190]['hdd'][20][1]['INR'] = 0;
        $configPricing[190]['hdd'][20]['quarterly']['INR'] = 0;
        $configPricing[190]['hdd'][20]['semi-annually']['INR'] = 0;
        $configPricing[190]['hdd'][20]['annually']['INR'] = 0;
        $configPricing[190]['hdd'][20][24]['INR'] = 0;
        $configPricing[190]['hdd'][20][36]['INR'] = 0;

        $configPricing[190]['hdd'][20][1]['USD'] = 0;
        $configPricing[190]['hdd'][20]['quarterly']['USD'] = 0;
        $configPricing[190]['hdd'][20]['semi-annually']['USD'] = 0;
        $configPricing[190]['hdd'][20]['annually']['USD'] = 0;
        $configPricing[190]['hdd'][20][24]['USD'] = 0;
        $configPricing[190]['hdd'][20][36]['USD'] = 0;
        //HDD ------------------------------------

        //Virtuzzo HDD 40 GB----------------------
        $configPricing[190]['hdd'][40][1]['INR'] = 400;
        $configPricing[190]['hdd'][40]['quarterly']['INR'] = 1200;
        $configPricing[190]['hdd'][40]['semi-annually']['INR'] = 2400;
        $configPricing[190]['hdd'][40]['annually']['INR'] = 4800;
        $configPricing[190]['hdd'][40][24]['INR'] = 0;
        $configPricing[190]['hdd'][40][36]['INR'] = 0;

        $configPricing[190]['hdd'][40][1]['USD'] = 8;
        $configPricing[190]['hdd'][40]['quarterly']['USD'] = 24;
        $configPricing[190]['hdd'][40]['semi-annually']['USD'] = 48;
        $configPricing[190]['hdd'][40]['annually']['USD'] = 96;
        $configPricing[190]['hdd'][40][24]['USD'] = 0;
        $configPricing[190]['hdd'][40][36]['USD'] = 0;
        //HDD ------------------------------------

        //Virtuzzo HDD 80 GB----------------------
        $configPricing[190]['hdd'][80][1]['INR'] = 800;
        $configPricing[190]['hdd'][80]['quarterly']['INR'] = 2400;
        $configPricing[190]['hdd'][80]['semi-annually']['INR'] = 4800;
        $configPricing[190]['hdd'][80]['annually']['INR'] = 9600;
        $configPricing[190]['hdd'][80][24]['INR'] = 0;
        $configPricing[190]['hdd'][80][36]['INR'] = 0;

        $configPricing[190]['hdd'][80][1]['USD'] = 19;
        $configPricing[190]['hdd'][80]['quarterly']['USD'] = 48;
        $configPricing[190]['hdd'][80]['semi-annually']['USD'] = 96;
        $configPricing[190]['hdd'][80]['annually']['USD'] = 192;
        $configPricing[190]['hdd'][80][24]['USD'] = 0;
        $configPricing[190]['hdd'][80][36]['USD'] = 0;
        //HDD ------------------------------------

        //Virtuzzo HDD 120 GB----------------------
        $configPricing[190]['hdd'][120][1]['INR'] = 1600;
        $configPricing[190]['hdd'][120]['quarterly']['INR'] = 4800;
        $configPricing[190]['hdd'][120]['semi-annually']['INR'] = 9600;
        $configPricing[190]['hdd'][120]['annually']['INR'] = 19200;
        $configPricing[190]['hdd'][120][24]['INR'] = 0;
        $configPricing[190]['hdd'][120][36]['INR'] = 0;

        $configPricing[190]['hdd'][120][1]['USD'] = 32;
        $configPricing[190]['hdd'][120]['quarterly']['USD'] = 96;
        $configPricing[190]['hdd'][120]['semi-annually']['USD'] = 192;
        $configPricing[190]['hdd'][120]['annually']['USD'] = 384;
        $configPricing[190]['hdd'][120][24]['USD'] = 0;
        $configPricing[190]['hdd'][120][36]['USD'] = 0;
        //HDD ------------------------------------
        return $configPricing;
    }
    public static function getHomecontactdata() {

        $response = DB::table('contact_info as c')
                ->select('c.varHomePageTitle', 'c.varEmail', 'c.varPhoneNo', 'c.varHomePageDescription','c.varOpenHours','c.varSchemaAddress','c.varSchemaLocality','c.varSchemaRegion','c.varSchemaPostalCode','c.varSchemaCountry')
                ->where('c.chrDelete', 'N')
                ->where('c.chrPublish', 'Y')
                ->first();
        return $response;
    }
}
