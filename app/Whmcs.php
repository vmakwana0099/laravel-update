<?php

/**
 * The Blog class handels blog model queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.00
 * @since       2016-07-14
 * @author    NetQuick
 */

namespace App;
use Config;
use DB;

//use Illuminate\Database\Eloquent\Model;
//use Config;
//use Cache;
//use DB;
//class Whmcs extends Model {
class Whmcs {

    /**
     * This method handels retrival of front blog detail
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function isloggedin($request) {
        $params['clientid'] = $request->clientid;
        return Whmcs::callapi($params);
    }

    public static function getProducts($request) {
        //Logic: Get whmcs products list
        //parameters: according to api requirements
        //return:  data retrieved from API calls in JSON Format

        $gid = isset($request->groupid)?$request->groupid:'';
        $pid = isset($request->productid)?$request->productid:'';
        $params = [];
        if (!empty($gid))
            $params['gid'] = $gid;
        if (!empty($pid))
            $params['pid'] = $pid;
        $params['action'] = 'GetProducts';

        return Whmcs::callapi($params);
    }

    public static function isUserExists($request) {
        //Logic: Check if user is already exists in whmcs by email id
        //parameters: email
        //return:  data retrieved from API calls in JSON Format

        $email = $request->email;
        $params = [];
        if (!empty($email))
            $params['email'] = $email;

        $params['action'] = 'isuserexists';

        return Whmcs::callapi($params);
    }

    public static function addClient($request) {
        //Logic: Create new user in WHMCS
        //parameters: fields array[]
        //return:  client id or false.

        $firstname = isset($request->firstname)?$request->firstname:'';
        $lastname = isset($request->lastname)?$request->lastname:'';
        $companyname = isset($request->companyname)?$request->companyname:'';
        $email = isset($request->email)?$request->email:'';
        $address1 = isset($request->address1)?$request->address1:'';
        $address2 = isset($request->address2)?$request->address2:'';
        $city = isset($request->city)?$request->city:'';
        $state = isset($request->state)?$request->state:'';
        $postcode = isset($request->postcode)?$request->postcode:'';
        $country = isset($request->country)?$request->country:'';
        $phonenumber = isset($request->phonenumber)?$request->phonenumber:'';
        $password2 = isset($request->password2)?$request->password2:'';
        $securityqid = isset($request->securityqid)?$request->securityqid:'';
        $securityqans = isset($request->securityqans)?$request->securityqans:'';
        $cardtype = isset($request->cardtype)?$request->cardtype:'';
        $cardnum = isset($request->cardnum)?$request->cardnum:'';
        $expdate = isset($request->expdate)?$request->expdate:'';
        $startdate = isset($request->startdate)?$request->startdate:'';
        $issuenumber = isset($request->issuenumber)?$request->issuenumber:'';
        $cvv = isset($request->cvv)?$request->cvv:'';
        $currency = isset($request->currency)?$request->currency:'';
        $groupid = isset($request->groupid)?$request->groupid:'';
        $customfields = isset($request->customfields)?$request->customfields:'';
        $language = isset($request->language)?$request->language:'';
        $clientip = isset($request->clientip)?$request->clientip:'';
        $notes = isset($request->notes)?$request->notes:'';
        $marketingoptin = isset($request->marketingoptin)?$request->marketingoptin:'';
        $noemail = isset($request->noemail)?$request->noemail:'';

        $params = [];
        if (!empty($email))
            $params['email'] = $email;
        if (!empty($country))
            $params['country'] = strtoupper($country);
        if (!empty($password2))
            $params['password2'] = $password2;
        if (!empty($firstname))
            $params['firstname'] = $firstname;
        if (!empty($lastname))
            $params['lastname'] = $lastname;
        if (!empty($companyname))
            $params['companyname'] = $companyname;
        if (!empty($address1))
            $params['address1'] = $address1;
        if (!empty($address2))
            $params['address2'] = $address2;
        if (!empty($city))
            $params['city'] = $city;
        if (!empty($state))
            $params['state'] = $state;
        if (!empty($postcode))
            $params['postcode'] = $postcode;
        if (!empty($phonenumber))
            $params['phonenumber'] = $phonenumber;
        if (!empty($securityqid))
            $params['securityqid'] = $securityqid;
        if (!empty($securityqans))
            $params['securityqans'] = $securityqans;
        if (!empty($cardtype))
            $params['cardtype'] = $cardtype;
        if (!empty($cardnum))
            $params['cardnum'] = $cardnum;
        if (!empty($expdate))
            $params['expdate'] = $expdate;
        if (!empty($startdate))
            $params['startdate'] = $startdate;
        if (!empty($issuenumber))
            $params['issuenumber'] = $issuenumber;
        if (!empty($cvv))
            $params['cvv'] = $cvv;
        if (!empty($currency))
            $params['currency'] = $currency;
        if (!empty($groupid))
            $params['groupid'] = $groupid;
        if (!empty($customfields))
            $params['customfields'] = $customfields;
        if (!empty($language))
            $params['language'] = $language;
        if (!empty($clientip))
            $params['clientip'] = $clientip;
        if (!empty($notes))
            $params['notes'] = $notes;
        if (!empty($noemail))
            $params['noemail'] = $noemail;
        if (!empty($marketingoptin))
            $params['marketingoptin'] = $marketingoptin;

        $params['skipvalidation'] = true; //Pass as true to ignore required fields validation
        $params['action'] = 'AddClient';

        return Whmcs::callapi($params);
    }

    public static function callapi($postfields) {
        //Logic: Call to whmcs external api
        //parameters: according to api requirements
        //return:  data retrieved from API calls in JSON Format


        $customAPIs = ['isuserexists', 'isuserloggedin', 'getallgroups', 'getgroupdetails', 'gettldspricing', 'generatecustomfields', 'getdomainaddonspricing','getfreedomaindetails','getorderidfrominvoicveid','getallcurrency','orderratingupdate','orderratingupdatedata','getactiveproductsids'];
        $apiname = strtolower($postfields['action']);


            //Live Credentials API User 3 ---------------------------------------------
            $postfields['identifier'] = 'ZyjSSPOuTToAmyLZXN13BCaCQTSjvP8I';
            $postfields['secret'] = 'plgLV63LlubL4MRig6LgNDigMvKRH4EB';
            //Live Credentials API User 3 ---------------------------------------------
            
        $postfields['responsetype'] = "JSON";
        $apiDomain = 'https://www.hostitsmart.com';
        $WHMCSUrl = config('app.api_url');
        if (!in_array($apiname, $customAPIs)) {
            $apiurl = $WHMCSUrl . '/includes/api.php';
        } else {
            $apiurl = $WHMCSUrl . '/includes/api/' . $apiname . '.php';
        }
        // echo "API Url: ";echo $apiurl;
        
         // if($apiname == 'getproductpricing'){ echo $apiurl;
         //    echo '<pre>123';print_r($postfields);exit;
         // } 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiurl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        $response = curl_exec($ch);
        // echo '<pre>response:  ';print_r($response);exit;
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (callapi): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        curl_close($ch);
        if ($postfields['action'] == 'AddOrder') {
            // echo '<pre>';print_r($response);exit;
        }
        $jsonData = json_decode($response, true);

        return $jsonData;
    }

    public static function updateClient($request) {
        //Logic: Update existing user in WHMCS
        //parameters: fields array[]
        //return:  client id or false.

        $clientid = isset($request->clientid)?$request->clientid:'';
        if (!empty($clientid))
            $params['clientid'] = $clientid;

        $clientemail = isset($request->clientemail)?$request->clientemail:'';
        if (!empty($clientemail))
            $params['clientemail'] = $clientemail;

        $firstname = isset($request->firstname)?$request->firstname:'';
        if (!empty($firstname))
            $params['firstname'] = $firstname;

        $lastname = isset($request->lastname)?$request->lastname:'';
        if (!empty($lastname))
            $params['lastname'] = $lastname;

        $companyname = isset($request->companyname)?$request->companyname:'';
        if (!empty($companyname))
            $params['companyname'] = $companyname;

        $email = isset($request->email)?$request->email:'';
        if (!empty($email))
            $params['email'] = $email;

        $address1 = isset($request->address1)?$request->address1:'';
        if (!empty($address1))
            $params['address1'] = $address1;

        $address2 = isset($request->address2)?$request->address2:'';
        if (!empty($address2))
            $params['address2'] = $address2;

        $city = isset($request->city)?$request->city:'';
        if (!empty($city))
            $params['city'] = $city;

        $state = isset($request->state)?$request->state:'';
        if (!empty($state))
            $params['state'] = $state;

        $postcode = isset($request->postcode)?$request->postcode:'';
        if (!empty($postcode))
            $params['postcode'] = $postcode;

        $country = isset($request->country)?$request->country:'';
        if (!empty($country))
            $params['country'] = strtoupper($country);

        $phonenumber = isset($request->phonenumber)?$request->phonenumber:'';
        if (!empty($phonenumber))
            $params['phonenumber'] = $phonenumber;

        $password2 = isset($request->password2)?$request->password2:'';
        if (!empty($password2))
            $params['password2'] = $password2;

        $securityqid = isset($request->securityqid)?$request->securityqid:'';
        if (!empty($securityqid))
            $params['securityqid'] = $securityqid;

        $securityqans = isset($request->securityqans)?$request->securityqans:'';
        if (!empty($securityqans))
            $params['securityqans'] = $securityqans;

        $cardtype = isset($request->cardtype)?$request->cardtype:'';
        if (!empty($cardtype))
            $params['cardtype'] = $cardtype;

        $cardnum = isset($request->cardnum)?$request->cardnum:'';
        if (!empty($cardnum))
            $params['cardnum'] = $cardnum;

        $expdate = isset($request->expdate)?$request->expdate:'';
        if (!empty($expdate))
            $params['expdate'] = $expdate;

        $startdate = isset($request->startdate)?$request->startdate:'';
        if (!empty($startdate))
            $params['startdate'] = $startdate;

        $issuenumber = isset($request->issuenumber)?$request->issuenumber:'';
        if (!empty($issuenumber))
            $params['issuenumber'] = $issuenumber;

        $bankcode = isset($request->bankcode)?$request->bankcode:'';
        if (!empty($bankcode))
            $params['bankcode'] = $bankcode;

        $bankacct = isset($request->bankacct)?$request->bankacct:'';
        if (!empty($bankacct))
            $params['bankacct'] = $bankacct;

        $cvv = isset($request->cvv)?$request->cvv:'';
        if (!empty($cvv))
            $params['cvv'] = $cvv;

        $currency = isset($request->currency)?$request->currency:'';
        if (!empty($currency))
            $params['currency'] = $currency;

        $groupid = isset($request->groupid)?$request->groupid:'';
        if (!empty($groupid))
            $params['groupid'] = $groupid;

        $customfields = isset($request->customfields)?$request->customfields:'';
        if (!empty($customfields))
            $params['customfields'] = $customfields;

        $language = isset($request->language)?$request->language:'';
        if (!empty($language))
            $params['language'] = $language;

        $clientip = isset($request->clientip)?$request->clientip:'';
        if (!empty($clientip))
            $params['clientip'] = $clientip;

        $notes = isset($request->notes)?$request->notes:'';
        if (!empty($notes))
            $params['notes'] = $notes;

        $paymentmethod = isset($request->paymentmethod)?$request->paymentmethod:'';
        if (!empty($paymentmethod))
            $params['paymentmethod'] = $paymentmethod;

        $marketingoptin =isset($request->marketingoptin)?$request->marketingoptin:'';
        if (!empty($marketingoptin))
            $params['marketingoptin'] = $marketingoptin;

        $clearcreditcard = isset($request->clearcreditcard)?$request->clearcreditcard:'';
        if (!empty($clearcreditcard))
            $params['clearcreditcard'] = $clearcreditcard;

        $skipvalidation = isset($request->skipvalidation)?$request->skipvalidation:'';
        if (!empty($skipvalidation))
            $params['skipvalidation'] = $skipvalidation;

        $params['skipvalidation'] = true; //Pass as true to ignore required fields validation
        $params['action'] = 'UpdateClient';

        return Whmcs::callapi($params);
    }

    public static function deleteClient($request) {
        //Logic: remove client and associalted data from WHMCS
        //parameters: clientid
        //return: client id and status
        $params['clientid'] = $request->clientid;
        $params['action'] = 'DeleteClient';

        return Whmcs::callapi($params);
    }

    public static function closeClient($request) {
        //Logic: close client status and make product disable and terminate
        //parameters: clientid
        //return: client id and status
        $params['clientid'] = $request->clientid;
        $params['action'] = 'CloseClient';

        return Whmcs::callapi($params);
    }

    public static function getClientDetails($request) {
        //Logic: Obtain the Clients details
        //parameters: clientid, email
        //return: detailed array of client's details

        $email = isset($request->email)?$request->email:'';
        if (!empty($email))
            $params['email'] = $email;

        $clientid = $request->clientid;
        if (!empty($clientid))
            $params['clientid'] = $clientid;

        $params['action'] = 'GetClientsDetails';

        return Whmcs::callapi($params);
    }

    public static function getClientsAddons($request) {
        //Logic: Obtain the Clients Product Addons that match passed criteria
        //parameters: serviceid, clientid(optional), addonid(optional)
        //return: detailed array of client's addons
        $serviceid = $request->serviceid;
        if (!empty($serviceid))
            $params['serviceid'] = $serviceid;

        $clientid = $request->clientid;
        if (!empty($clientid))
            $params['clientid'] = $clientid;

        $addonid = $request->addonid;
        if (!empty($addonid))
            $params['addonid'] = $addonid;


        $params['action'] = 'GetClientsAddons';

        return Whmcs::callapi($params);
    }

    public static function getClientsDomains($request) {
        //Logic: Obtain a list of Client Purchased Domains matching the provided criteria
        //parameters: clientid(optional), domainid(optional), domain(optional),limitstart ,limitnum  
        //return: detailed array of client's domains

        $clientid = $request->clientid;
        if (!empty($clientid))
            $params['clientid'] = $clientid;

        $domainid = $request->domainid;
        if (!empty($domainid))
            $params['domainid'] = $domainid;

        $domain = $request->domain;
        if (!empty($domain))
            $params['domain'] = $domain;

        $limitstart = $request->limitstart;
        if (!empty($limitstart))
            $params['limitstart'] = $limitstart;

        $limitnum = $request->limitnum;
        if (!empty($limitnum))
            $params['limitnum'] = $limitnum;

        $params['action'] = 'GetClientsDomains';

        return Whmcs::callapi($params);
    }

    public static function getClientsProducts($request) {
        //Logic: Obtain a list of Client Purchased Products matching the provided criteria
        //parameters: clientid(optional), serviceid(optional), pid(optional),limitstart ,limitnum    
        //return: detailed array of client's products

        $clientid = $request->clientid;
        if (!empty($clientid))
            $params['clientid'] = $clientid;

        $serviceid = $request->serviceid;
        if (!empty($serviceid))
            $params['serviceid'] = $serviceid;

        $pid = $request->pid;
        if (!empty($pid))
            $params['pid'] = $pid;

        $domain = $request->domain;
        if (!empty($domain))
            $params['domain'] = $domain;

        $limitstart = $request->limitstart;
        if (!empty($limitstart))
            $params['limitstart'] = $limitstart;

        $limitnum = $request->limitnum;
        if (!empty($limitnum))
            $params['limitnum'] = $limitnum;

        $params['action'] = 'GetClientsProducts';

        return Whmcs::callapi($params);
    }

    public static function getAllProductsGroups($request) {
        //Logic: Get list of products groups
        //parameters: null
        //return:  data retrieved from API calls in JSON Format
        $params['action'] = 'getallgroups';

        return Whmcs::callapi($params);
    }

    public static function getGroupDetails($request) {
        //Logic: Get all details about products's groups by id
        //parameters: groupid
        //return:  data retrieved from API calls in JSON Format
        $groupid = $request->groupid;

        $params = [];
        if (!empty($groupid))
            $params['groupid'] = $groupid;

        $params['action'] = 'getgroupdetails';

        return Whmcs::callapi($params);
    }

    public static function createOrder($request) {
        //Logic: Create new Order in WHMCS
        //parameters: fields array[]
        //return:  order id or false.
         $params = [];
        //$clientid = $request->clientid;
        if (isset($request->clientid) && !empty($request->clientid))
            $params['clientid'] = $request->clientid;

        //$paymentmethod = $request->paymentmethod;
        if (isset($request->paymentmethod) && !empty($request->paymentmethod))
            $params['paymentmethod'] = $request->paymentmethod;

        //$pid = $request->pid;
        if (isset($request->pid) && !empty($request->pid))
            $params['pid'] = $request->pid;

        //$domain = $request->domain;
        if (isset($request->domain) && !empty($request->domain))
            $params['domain'] = $request->domain;

        //$billingcycle = $request->billingcycle;
        if (isset($request->billingcycle) && !empty($request->billingcycle))
            $params['billingcycle'] = $request->billingcycle;

        //$domaintype = $request->domaintype;
        if (isset($request->domaintype) && !empty($request->domaintype))
            $params['domaintype'] = $request->domaintype;

        //$regperiod = $request->regperiod;
        if (isset($request->regperiod) && !empty($request->regperiod))
            $params['regperiod'] = $request->regperiod;

        //$eppcode = isset($request->eppcode)?$request->eppcode:'';
        if (isset($request->eppcode) && !empty($request->eppcode))
            $params['eppcode'] = $request->eppcode;

        //$nameserver1 = isset($request->nameserver1)?$request->nameserver1:'';
        if (isset($request->nameserver1) && !empty($request->nameserver1))
            $params['nameserver1'] = $request->nameserver1;

        //$nameserver2 = isset($request->nameserver2)?$request->nameserver2:'';
        if (isset($request->nameserver2) && !empty($request->nameserver2))
            $params['nameserver2'] = $request->nameserver2;

        //$nameserver3 = isset($request->nameserver3)?$request->nameserver3:'';
        if (isset($request->nameserver3) && !empty($request->nameserver3))
            $params['nameserver3'] = $request->nameserver3;

        //$nameserver4 = isset($request->nameserver4)?$request->nameserver4:'';
        if (isset($request->nameserver4) && !empty($request->nameserver4))
            $params['nameserver4'] = $request->nameserver4;

        //$nameserver5 = $request->nameserver5;
        if (isset($request->nameserver5) && !empty($request->nameserver5))
            $params['nameserver5'] = $request->nameserver5;

        //$customfields = $request->customfields;
        if (isset($request->customfields) && !empty($request->customfields))
            $params['customfields'] = $request->customfields;

        //$configoptions = $request->configoptions;
        if (isset($request->configoptions) && !empty($request->configoptions))
            $params['configoptions'] = $request->configoptions;

        //$priceoverride = $request->priceoverride;
        if (isset($request->priceoverride) && !empty($request->priceoverride))
            $params['priceoverride'] = $request->priceoverride;

        //$promocode = $request->promocode;
        if (isset($request->promocode) && !empty($request->promocode))
            $params['promocode'] = $request->promocode;

        //$promooverride = $request->promooverride;
        if (isset($request->promooverride) && !empty($request->promooverride))
            $params['promooverride'] = $request->promooverride;

        //$affid = $request->affid;
        if (isset($request->affid) && !empty($request->affid))
            $params['affid'] = $request->affid;

        //$noinvoice = $request->noinvoice;
        if (isset($request->noinvoice) && !empty($request->noinvoice))
            $params['noinvoice'] = $request->noinvoice;

        //$noinvoiceemail = $request->noinvoiceemail;
        if (isset($request->noinvoiceemail) && !empty($request->noinvoiceemail))
            $params['noinvoiceemail'] = $request->noinvoiceemail;

        //$noemail = $request->noemail;
        if (isset($request->noemail) && !empty($request->noemail))
            $params['noemail'] = $request->noemail;

        //$addons = $request->addons;
        if (isset($request->addons) && !empty($request->addons))
            $params['addons'] = $request->addons;

        //$hostname = $request->hostname;
        if (isset($request->hostname) && !empty($request->hostname))
            $params['hostname'] = $request->hostname;

        //$ns1prefix = $request->ns1prefix;
        if (isset($request->ns1prefix) && !empty($request->ns1prefix))
            $params['ns1prefix'] = $request->ns1prefix;

        //$ns2prefix = $request->ns2prefix;
        if (isset($request->ns2prefix) && !empty($request->ns2prefix))
            $params['ns2prefix'] = $request->ns2prefix;

        //$rootpw = $request->rootpw;
        if (isset($request->rootpw) && !empty($request->rootpw))
            $params['rootpw'] = $request->rootpw;

        //$contactid = $request->contactid;
        if (isset($request->contactid) && !empty($request->contactid))
            $params['contactid'] = $request->contactid;

        //$dnsmanagement = $request->dnsmanagement;
        if (isset($request->dnsmanagement) && !empty($request->dnsmanagement))
            $params['dnsmanagement'] = $request->dnsmanagement;

        //$domainfields = $request->domainfields;
        if (isset($request->domainfields) && !empty($request->domainfields))
            $params['domainfields'] = $request->domainfields;

        //$emailforwarding = $request->emailforwarding;
        if (isset($request->emailforwarding) && !empty($request->emailforwarding))
            $params['emailforwarding'] = $request->emailforwarding;

        //$idprotection = $request->idprotection;
        if (isset($request->idprotection) && !empty($request->idprotection))
            $params['idprotection'] = $request->idprotection;

        //$domainpriceoverride = $request->domainpriceoverride;
        if (isset($request->domainpriceoverride) && !empty($request->domainpriceoverride))
            $params['domainpriceoverride'] = $request->domainpriceoverride;

        //$domainrenewoverride = $request->domainrenewoverride;
        if (isset($request->domainrenewoverride) && !empty($request->domainrenewoverride))
            $params['domainrenewoverride'] = $request->domainrenewoverride;

        //$domainrenewals = $request->domainrenewals;
        if (isset($request->domainrenewals) && !empty($request->domainrenewals))
            $params['domainrenewals'] = $request->domainrenewals;

        //$clientip = $request->clientip;
        if (isset($request->clientip) && !empty($request->clientip))
            $params['clientip'] = $request->clientip;

        //$addonid = $request->addonid;
        if (isset($request->addonid) && !empty($request->addonid))
            $params['addonid'] = $request->addonid;

        //$serviceid = $request->serviceid;
        if (isset($request->serviceid) && !empty($request->serviceid))
            $params['serviceid'] = $request->serviceid;

        //$addonids = $request->addonids;
        if (isset($request->addonids) && !empty($request->addonids))
            $params['addonids'] = $request->addonids;

        //$serviceids = $request->serviceids;
        if (isset($request->serviceids) && !empty($request->serviceids))
            $params['serviceids'] = $request->serviceids;

        $params['action'] = 'AddOrder';

        return Whmcs::callapi($params);
    }

    public static function acceptOrder($request) {
        //Logic: Create new Order in WHMCS
        //parameters: fields array[]
        //return: data retrieved from API calls in JSON Format

        $orderid = $request->orderid;
        if (!empty($orderid))
            $params['orderid'] = $orderid;

        $serverid = $request->serverid;
        if (!empty($serverid))
            $params['serverid'] = $serverid;

        $serviceusername = $request->serviceusername;
        if (!empty($serviceusername))
            $params['serviceusername'] = $serviceusername;

        $servicepassword = $request->servicepassword;
        if (!empty($servicepassword))
            $params['servicepassword'] = $servicepassword;

        $registrar = $request->registrar;
        if (!empty($registrar))
            $params['registrar'] = $registrar;

        $sendregistrar = $request->sendregistrar;
        if (!empty($sendregistrar))
            $params['sendregistrar'] = $sendregistrar;

        $autosetup = $request->autosetup;
        if (!empty($autosetup))
            $params['autosetup'] = $autosetup;

        $sendemail = $request->sendemail;
        if (!empty($sendemail))
            $params['sendemail'] = $sendemail;

        $params['action'] = 'AcceptOrder';

        return Whmcs::callapi($params);
    }

    public static function cancelOrder($request) {
        //Logic: Cancel Order in WHMCS
        //parameters: orderid
        //return: success or false.

        $orderid = $request->orderid;
        if (!empty($orderid))
            $params['orderid'] = $orderid;

        $cancelsub = $request->cancelsub;
        if (isset($cancelsub))
            $params['cancelsub'] = $cancelsub;

        $noemail = $request->noemail;
        if (isset($noemail))
            $params['noemail'] = $noemail;


        $params['action'] = 'CancelOrder';

        return Whmcs::callapi($params);
    }

    public static function pendingOrder($request) {
        //Logic: Pending Order in WHMCS
        //parameters: orderid
        //return: success or false.

        $orderid = $request->orderid;
        if (!empty($orderid))
            $params['orderid'] = $orderid;

        $params['action'] = 'PendingOrder';

        return Whmcs::callapi($params);
    }

    public static function deleteOrder($request) {
        //Logic: Delete Order in WHMCS
        //parameters: orderid
        //return: success or false.

        $orderid = $request->orderid;
        if (!empty($orderid))
            $params['orderid'] = $orderid;

        $params['action'] = 'DeleteOrder';

        return Whmcs::callapi($params);
    }

    public static function getOrderDetails($request) {
        //Logic: Get WHMCS Order Details
        //parameters: orderid
        //return: success or false.

        $params['id'] = (isset($request->id) && !empty($request->id) ? $request->id : '');
        $params['userid'] = (isset($request->userid) && !empty($request->userid) ? $request->userid : '');
        $params['status'] = (isset($request->status) && !empty($request->status) ? $request->status : '');
        $params['limitstart'] = (isset($request->limitstart) && !empty($request->limitstart) ? $request->limitstart : '');
        $params['limitnum'] = (isset($request->limitnum) && !empty($request->limitnum) ? $request->limitnum : '');
        $params['action'] = 'GetOrders';
        return Whmcs::callapi($params);
    }

    public static function getInvoiceDetails($request) {
        //Logic: Get whmcs Invoice details
        //parameters: invoiceid
        //return:  data retrieved from API calls in JSON Format 

        $invoiceid = $request->invoiceid;
        if (!empty($invoiceid))
            $params['invoiceid'] = $invoiceid;

        $params['action'] = 'GetInvoice';

        return Whmcs::callapi($params);
    }

    public static function getUserInvoices($request) {
        //Logic: Get WHMCS Invoice details by user
        //parameters: userid or status
        //return: data retrieved from API calls in JSON Format

        $userid = $request->userid;
        if (!empty($userid))
            $params['userid'] = $userid;

        $status = $request->status;
        if (!empty($status))
            $params['status'] = $status;

        $limitstart = $request->limitstart;
        if (!empty($limitstart))
            $params['limitstart'] = $limitstart;

        $limitnum = $request->limitnum;
        if (!empty($limitnum))
            $params['limitnum'] = $limitnum;


        $params['action'] = 'GetInvoices';

        return Whmcs::callapi($params);
    }

    public static function getAllTldsPricing($request) {
        //Logic: Get pricing or tlds
        //parameters: null
        //return:  data retrieved from API calls in JSON Format

        $params['action'] = 'gettldspricing';

        $tlds = $request->tlds;
        $currency = $request->currency;
        $type = $request->type;

        if (!empty($tlds))
            $params['tlds'] = $tlds;
        if (!empty($currency))
            $params['currency'] = $currency;
        if (!empty($type))
            $params['type'] = $type;


        return Whmcs::callapi($params);
    }

    public static function resellerclub_domain_availability($domainname, $tlds) {
        //check domain availability from live reseller club api
        $resellerclub_link = Config::get('Constant.resellerclub.link');
        $resellerclub_apikey = Config::get('Constant.resellerclub.apikey');
        $resellerclub_id = Config::get('Constant.resellerclub.id');

        $i = 0;
        //$tlds = ltrim($tlds, ".");
        /* $tldstr = "";
          $tldstr.='&tlds=' . $tlds; */

        $resellerclub_link = 'https://domaincheck.httpapi.com/api/';
        /* $url = $resellerclub_link . 'domains/available.json?auth-userid=' . $resellerclub_id . '&api-key=' . $resellerclub_apikey . '&domain-name=' . $domainname . $tldstr; */

        $url = $resellerclub_link . 'domains/available.json?auth-userid=' . $resellerclub_id . '&api-key=' . $resellerclub_apikey;

        $domainStr = '';
        if (!empty($domainname)) {
            if (is_array($domainname)) {
                foreach ($domainname as $dname) {
                    $domainStr .= '&domain-name=' . $dname;
                }
            } else {
                $domainStr .= '&domain-name=' . $domainname;
            }
        }
        if (!empty($tlds)) {
            if (is_array($domainname)) {
                foreach ($tlds as $tld) {
                    $domainStr .= '&tlds=' . $tld;
                }
            } else {
                $domainStr .= '&tlds=' . $tlds;
            }
        }
        $url .= $domainStr;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        $datajson = json_decode($data, TRUE);
        return $datajson;
    }

    public static function generateCustomFields($request) {
        //Logic: Get custom field data
        //parameters: ids string
        //return:  data retrieved from API calls in JSON Format

        $params['action'] = 'generatecustomfields';

        $ids = $request->ids;

        if (!empty($ids))
            $params['ids'] = $ids;

        return Whmcs::callapi($params);
    }

    public static function getDomainAddonspricing($request) {
        //Logic: Get pricing or domain addons
        //parameters: currency
        //return:  data retrieved from API calls in JSON Format

        $params['action'] = 'getdomainaddonspricing';

        $tlds = $request->tlds;
        $currency = $request->currency;

        if (!empty($currency))
            $params['currency'] = $currency;

        return Whmcs::callapi($params);
    }

    public static function removeaddon($request) {
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        $id = $request->id;
        return $id;
    }

    public static function getWhois($request) {
        //Logic: Get whmcs Whois details
        //parameters: domain
        //return:  data retrieved from API calls in JSON Format 

        $domainname = $request->domainname;
        if (!empty($domainname))
            $params['domain'] = $domainname;

        $params['action'] = 'DomainWhois';
        return Whmcs::callapi($params);
    }

    public static function getFreeDomainDetails($request) {
        //Logic: Get product free domain details
        //parameters: productid
        //return:  data retrieved from API calls in JSON Format

        $params['action'] = 'getfreedomaindetails';

        $productid = $request->productid;
        
        if (!empty($productid))
            $params['productid'] = $productid;

        return Whmcs::callapi($params);
    }
    public static function getorderidfrominvoicveid($request) {
        $params['action'] = 'getorderidfrominvoicveid';
        
        $invoiceid = $request->invoiceid;
        
        if (!empty($invoiceid))
            $params['invoiceid'] = $invoiceid;

        return Whmcs::callapi($params);
    }
    public static function orderratingupdate($request) {
        $params['action'] = 'orderratingupdate';
        $params['id'] = $request->id;
        $params['o_id'] = $request->o_id;
        $params['s'] = $request->s;
        $response = Whmcs::callapi($params); 
        return $response;
    }

    public static function orderratingupdatedata($request) {
        $params['action'] = 'orderratingupdatedata';
        $params['id'] = $request->id;
        $params['o_id'] = $request->oder_id;
        $params['s'] = $request->star;
        $params['attentive'] = $request->attentive;
        $params['suggestions'] = $request->suggestions;
        // echo '<pre>req: '; print_r($request);exit;

        $response = Whmcs::callapi($params); 
        return $response;
    }
    
    public static function validateLogin($request) {
        //Logic: Validate login in WHMCS
        //parameters: username and password2
        //return:  hash
        $email = $request->email;
        $password2 = $request->password2;
        
        $params = [];
        if (!empty($email))
            $params['email'] = $email;
        if (!empty($password2))
            $params['password2'] = $password2;

        $params['action'] = 'ValidateLogin';

        return Whmcs::callapi($params);
    }

    public static function customCallAPI($postfields) {
        //Logic: Call to whmcs external api
        //parameters: according to api requirements
        //return:  data retrieved from API calls in JSON Format

        $apiname = strtolower($postfields['action']);

        //Live Credentials API User 3 ---------------------------------------------
        $postfields['identifier'] = 'ZyjSSPOuTToAmyLZXN13BCaCQTSjvP8I';
        $postfields['secret'] = 'plgLV63LlubL4MRig6LgNDigMvKRH4EB';
        //Live Credentials API User 3 ---------------------------------------------
            
        $postfields['responsetype'] = "JSON";
        $apiDomain = 'https://www.hostitsmart.com';
        /*$apiDomain = Config::get('Constant.API_DOMAIN');*/
        $WHMCSUrl = config('app.api_url');
        $apiurl = $WHMCSUrl.'/includes/api/' . $apiname . '.php';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiurl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        $response = curl_exec($ch);
        
        if (curl_error($ch)) {
            $strContent = date("m-d-Y H:i:s")." Url: ".$apiurl. " ErrorNo: ".curl_errno($ch) . ' - ' . curl_error($ch);
            file_put_contents('curlerror_log.txt', "\n".$strContent, FILE_APPEND);
            die('Unable to connect (callapi): ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        
        curl_close($ch);
        // Decode response
        $jsonData = json_decode($response, true);

        return $jsonData;
    }


}
