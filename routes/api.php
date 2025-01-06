<?php

use Illuminate\Http\Request;
use App\Whmcs;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});*/

/*Route::post('/whmcs', 					'WhmcsController@index');
Route::post('/logintowhmcs', 			'WhmcsController@logintowhmcs');
Route::post('/isloggedin', 				'WhmcsController@isloggedin');
Route::post('/getproductdetails', 		'WhmcsController@getproductdetails');
Route::post('/getproductpricing', 		'WhmcsController@getproductpricing');
Route::post('/isuserexists', 			'WhmcsController@isuserexists');
Route::post('/addclient', 				'WhmcsController@addclient');
Route::post('/getclient', 				'WhmcsController@getclient');
Route::post('/updateclient', 			'WhmcsController@updateclient');
Route::post('/closeclient', 				'WhmcsController@closeclient');
Route::post('/deleteclient', 			'WhmcsController@deleteclient');
Route::post('/getclientsaddons', 		'WhmcsController@getclientsaddons');
Route::post('/getclientsdomains', 		'WhmcsController@getclientsdomains');
Route::post('/getclientsproducts', 		'WhmcsController@getclientsproducts');
Route::post('/getallproductsgroups',		'WhmcsController@getallproductsgroups');
Route::post('/getgroupdetails',			'WhmcsController@getgroupdetails');
Route::post('/createorder',				'WhmcsController@createorder');
Route::post('/acceptorder',				'WhmcsController@acceptorder');
Route::post('/cancelorder',				'WhmcsController@cancelorder');
Route::post('/pendingorder',				'WhmcsController@pendingorder');
Route::post('/deleteorder',				'WhmcsController@deleteorder');
Route::post('/getordersdetails',			'WhmcsController@getordersdetails'); 
Route::post('/getinvoicedetails',		'WhmcsController@getinvoicedetails');
Route::post('/getuserinvoice',			'WhmcsController@getuserinvoice');
Route::post('/getminprice',				'WhmcsController@getminprice');
Route::post('/gettldspricing',			'WhmcsController@gettldspricing');
Route::post('/domainavail',				'WhmcsController@domainavail');*/

Route::post('/whmcs', 					function(Request $request){
	return response()->json(array('posts'=>"test 1",'comment'=>"testing comment 1"));
});
Route::post('/validatelogin', 				function(Request $request){
	//Logic: Validate login in WHMCS
	//parameters: username and password2
	//return:  hash

	$email = $request->email;
	$password2 = $request->password2;
	
	if(empty($email))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'email'"]); 
	if(empty($password2))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'password2'"]); 
	
	return Response::json(Whmcs::validateLogin($request));
});
Route::post('/logintowhmcs', 			function(Request $request){
    
	 $whmcsurl = url('/') . "/dev/whmcs/dologin.php";
	 $autoauthkey = "xRr=GDK!9EJ7";
	 $email = $request->email;
	 $timestamp = time(); # Get current timestamp
	 $hash = sha1($email.$timestamp.$autoauthkey); # Generate Hash
	 $url = $whmcsurl."?email=".$email."&timestamp=".$timestamp."&hash=".$hash;
	 echo $url;exit;
		
});

Route::post('/isloggedin', 				function(Request $request){
	//Logic: Check is user logged in WHMCS or not. 
	//parameters: email or id
	//return:  true/false

	$result = [];
	$uid = $request->clientid;
	if(empty($uid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'clientid'"]);
	
	return Response::json(["result" => "success","data" => ["loginstatus" => Whmcs::isloggedin($request)]]);
});
Route::post('/getproductdetails', 		function(Request $request){
	//Logic: Get whmcs products list
	//parameters: groupid or products id
	//return:  data retrieved from API calls in JSON Format

	$gid = $request->groupid;
	$pid = $request->productid;
	
	if(empty($gid) && empty($pid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'groupid' or 'productid'"]);
	
	return Response::json(Whmcs::getProducts($request));
});
Route::post('/getproductpricing', 		function(Request $request){
	//Logic: Get whmcs products pricing details
	//parameters: products id, currencycode	
	//return:  data retrieved from API calls in JSON Format
	
	$pid = $request->productid;
	$ccode = trim($request->currencycode);

	if(empty($pid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'productid'"]);
	
	$productData = Whmcs::getProducts($request);
	
	if(empty($productData['totalresults']))
	return Response::json(['result' => "error",'msg' => "Product not found for id: ".$pid]);

	if(!empty($ccode) && empty($productData['products']['product'][0]['pricing'][$ccode]))
	return Response::json(['result' => "error",'msg' => "Product pricing not found for currencycode: ".$ccode]);

	$finalData = !empty($ccode)?$productData['products']['product'][0]['pricing'][$ccode]:$productData['products']['product'][0]['pricing'];
	
	return Response::json($finalData);
});
Route::post('/isuserexists', 			function(Request $request){
	//Logic: Check if user is already exists in whmcs by email id
	//parameters: email
	//return:  data retrieved from API calls in JSON Format

	$email = $request->email;
	if(empty($email))
	{ return Response::json(['result' => "error",'msg' => "Please provide parameter 'email'"]);  }
	
	return Whmcs::isUserExists($request);
});
Route::post('/addclient', 				function(Request $request){
	//Logic: Create new user in WHMCS
	//parameters: fields array[]
	//return:  client id or false.

	$email = $request->email;
	$country = $request->country;
	$password2 = $request->password2;
	
	if(empty($email))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'email'"]); 

	if(empty($country))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'country code'"]); 

	if(empty($password2))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'password2'"]); 
	
	return Response::json(Whmcs::addClient($request));
});
Route::post('/getclient', 				function(Request $request){
	//Logic: get Details about client in WHMCS by id
	//parameters: email or clientid
	//return:  detailed array of whmcs client.

	$email = $request->email;
	$clientid = $request->clientid;
	
	if(empty($email) && empty($clientid))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'email' or 'clientid'"]); 

	return Response::json(Whmcs::getClientDetails($request));
});
Route::post('/updateclient', 			function(Request $request){
	//Logic: Update user in WHMCS
	//parameters: fields array[]
	//return:  client id or false.

	$clientid = $request->clientid;
	$clientemail = $request->clientemail;
	
	if(empty($clientid) && empty($clientemail))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'clientemail' or 'clientid'"]); 

	return Response::json(Whmcs::updateClient($request));
});
Route::post('/closeclient', 			function(Request $request){
	//Logic: close client status and make product disable and terminate
	//parameters: clientid
	//return: client id and status

	$clientid = $request->clientid;
	
	if(empty($clientid))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'clientid'"]); 

	return Response::json(Whmcs::closeClient($request));
});
Route::post('/deleteclient', 			function(Request $request){
	//Logic: remove client and associalted data from WHMCS
	//parameters: clientid
	//return: client id and status

	$clientid = $request->clientid;
	
	if(empty($clientid))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'clientid'"]); 

	return Response::json(Whmcs::deleteClient($request));
});
Route::post('/getclientsaddons', 		function(Request $request){
	//Logic: Obtain the Clients Product Addons that match passed criteria
	//parameters: serviceid, clientid(optional), addonid(optional)
	//return: detailed array of client's addons
	
	$serviceid = $request->serviceid;
	$clientid = $request->clientid;
	$addonid = $request->addonid;
	
	if(empty($serviceid))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'serviceid'"]); 

	return Response::json(Whmcs::getClientsAddons($request));
});
Route::post('/getclientsdomains', 		function(Request $request){
	//Logic: Obtain a list of Client Purchased Domains matching the provided criteria
	//parameters: clientid(optional), domainid(optional), domain(optional),limitstart ,limitnum	 
	//return: detailed array of client's domains
	
	$clientid = $request->clientid;
	$domainid = $request->domainid;
	$domain = $request->domain;

	
	if(empty($clientid))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'clientid'"]); 

	return Response::json(Whmcs::getClientsDomains($request));
});
Route::post('/getclientsproducts', 		function(Request $request){
	//Logic: Obtain a list of Client Purchased Products matching the provided criteria
	//parameters: clientid(optional), serviceid(optional), pid(optional),limitstart ,limitnum	 
	//return: detailed array of client's products
	
	$clientid = $request->clientid;
	$serviceid = $request->serviceid;
	$pid = $request->pid;
	$domain = $request->domain;
	
	
	if(empty($clientid))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'clientid'"]); 

	return Response::json(Whmcs::getClientsProducts($request));
});
Route::post('/getallproductsgroups',	function(Request $request){
	//Logic: Get list of products groups
	//parameters: null
	//return:  data retrieved from API calls in JSON Format

	return Response::json(Whmcs::getAllProductsGroups($request));
});
Route::post('/getgroupdetails',			function(Request $request){
	//Logic: Get all details about products's groups by id
	//parameters: groupid
	//return:  data retrieved from API calls in JSON Format

	$groupid = $request->groupid;
	if(empty($groupid))
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'groupid'"]); 
	
	return Response::json(Whmcs::getGroupDetails($request));
});
Route::post('/createorder',				function(Request $request){
	//Logic: Create new Order in WHMCS
	//parameters: fields array[]
	//return:  order id or false.

	$clientid = $request->clientid;
		if(!empty($clientid))
			$params['clientid'] = $clientid;

	$paymentmethod = $request->paymentmethod;
	if(!empty($paymentmethod))
		$params['paymentmethod'] = $paymentmethod;
	
	if(empty($clientid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'clientid'"]);

	if(empty($paymentmethod)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'paymentmethod'"]);

	return Response::json(Whmcs::createOrder($request));
});
Route::post('/acceptorder',				function(Request $request){
	//Logic: Accept Order in WHMCS
	//parameters: fields array[]
	//return:  order id or false.

	$orderid = $request->orderid;
		if(!empty($orderid))
			$params['orderid'] = $orderid;

	if(empty($orderid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'orderid'"]);

	return Response::json(Whmcs::acceptOrder($request));
});
Route::post('/cancelorder',				function(Request $request){
	//Logic: Cancel Order in WHMCS
	//parameters: orderid
	//return: success or false.

	$orderid = $request->orderid;
		if(!empty($orderid))
			$params['orderid'] = $orderid;

	if(empty($orderid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'orderid'"]);

	return Response::json(Whmcs::cancelOrder($request));
});
Route::post('/pendingorder',			function(Request $request){
	//Logic: Pending Order in WHMCS
	//parameters: orderid
	//return: success or false.

	$orderid = $request->orderid;
		if(!empty($orderid))
			$params['orderid'] = $orderid;

	if(empty($orderid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'orderid'"]);

	return Response::json(Whmcs::pendingOrder($request));
});
Route::post('/deleteorder',				function(Request $request){
	//Logic: Delete Order in WHMCS
	//parameters: orderid
	//return: success or false.

	$orderid = $request->orderid;
		if(!empty($orderid))
			$params['orderid'] = $orderid;

	if(empty($orderid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'orderid'"]);

	return Response::json(Whmcs::deleteOrder($request));

});
Route::post('/getordersdetails',		function(Request $request){
	//Logic: Get whmcs Order details
	//parameters: id or userid or status
	//return:  data retrieved from API calls in JSON Format

	$id 	= $request->id;
	$userid = $request->userid;
	$status = $request->status;
	
	if(empty($id) && empty($userid) && empty($status)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'id' or 'userid' or 'status'"]);
	
	return Response::json(Whmcs::getOrderDetails($request));
}); 
Route::post('/getinvoicedetails',		function(Request $request){
	//Logic: Get whmcs Invoice details
	//parameters: invoiceid
	//return:  data retrieved from API calls in JSON Format

	$invoiceid 	= $request->invoiceid;
	//$userid = $request->userid;
	//$status = $request->status;
	
	if(empty($invoiceid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'invoiceid'"]);
	
	return Response::json(Whmcs::getInvoiceDetails($request));
});
Route::post('/getuserinvoice',			function(Request $request){
	//Logic: Get whmcs Invoice details by user
	//parameters: invoiceid 
	//return: Data retrieved from API calls in JSON Format
		$userid = $request->userid;
	
	if(empty($userid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'userid'"]);
	
	return Response::json(Whmcs::getUserInvoices($request));
});
Route::post('/getminprice',				function(Request $request){
    
     
	//Logic: Get Minimum price of prduct in whmcs
	//parameters: productid	
	//return:  data retrieved from API calls in JSON Format
	
	$pid = $request->productid;
	$ccode = trim($request->currencycode);
	$duration = trim($request->duration);


	if(empty($pid)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'productid'"]);
	if(empty($duration)) 
	return Response::json(['result' => "error",'msg' => "Please provide parameter 'duration':'msetupfee, qsetupfee, ssetupfee, asetupfee, bsetupfee, tsetupfee, monthly, quarterly, semiannually, annually, biennially, triennially'"]);

	$productData = Whmcs::getProducts($request);
	
	
	if(empty($productData['totalresults']))
	return Response::json(['result' => "error",'msg' => "Product not found for id: ".$pid]);

	if(!empty($ccode) && empty($productData['products']['product'][0]['pricing'][$ccode]))
	return Response::json(['result' => "error",'msg' => "Product pricing not found for currencycode: ".$ccode]);

	$finalData = !empty($ccode)?$productData['products']['product'][0]['pricing'][$ccode]:$productData['products']['product'][0]['pricing'];
	$minData = [];
	
	if(!empty($ccode) && !empty($duration)){ 
		$minData[$ccode][$duration] = str_replace(".00","",$finalData[$duration]); 
	}
	else 
	{
		foreach($finalData as $key => $data){ $minData[$key][$duration] = str_replace(".00","",$finalData[$key][$duration]); }
	}
	return Response::json($minData);
});
Route::post('/gettldspricing',			function(Request $request){
	//Logic: Get pricing or tlds
	//parameters: null or tlds = ".com"
	//return:  data retrieved from API calls in JSON Format
	return Response::json(Whmcs::getAllTldsPricing($request));
});
Route::post('/domainavail',				function(Request $request){
	//Logic: Domain availability check
	//parameters: null
	//return:  data retrieved from API calls in JSON date_format()
	$domainname = $tld = "";
	if(!empty($request->domainname))
			$domainname = $request->domainname;

	if(!empty($request->tlds))
			$tlds = $request->tlds;	

	if(empty($domainname))
	return Response::json(['result' => "error",'msg' => "Please provide parameters 'domainname'"]);	

	if(empty($tlds))
	return Response::json(['result' => "error",'msg' => "Please provide parameters 'tlds'"]);	
	
	return Response::json(Whmcs::resellerclub_domain_availability($domainname,$tlds));
});

Route::post('/generatecustomfields', function(Request $request){
	//Logic: Get pricing or tlds
	//parameters: null or tlds = ".com"
	//return:  data retrieved from API calls in JSON Format
	return Response::json(Whmcs::generateCustomFields($request));
});
Route::post('/getdomainaddonspricing', function(Request $request){
	return Response::json(Whmcs::getDomainAddonspricing($request));
});

Route::post('/getwhois', function(Request $request){
	if(!empty($request->domainname))
			$domainname = $request->domainname; 

	if(empty($domainname))
	return Response::json(['result' => "error",'msg' => "Please provide parameters 'domainname'"]);	

	return Response::json(Whmcs::getWhois($request));
});

Route::post('/getfreedomaindetails', function(Request $request){
	if(!empty($request->productid))
			$productid = $request->productid; 

	if(empty($productid))
	return Response::json(['result' => "error",'msg' => "Please provide parameters 'productid'"]);	

	return Response::json(Whmcs::getFreeDomainDetails($request));
});

Route::post('/getorderidfrominvoicveid', function(Request $request){
	if(!empty($request->invoiceid))
			$invoiceid = $request->invoiceid; 

	if(empty($invoiceid))
	return Response::json(['result' => "error",'msg' => "Please provide parameters 'invoiceid'"]);	

	return Response::json(Whmcs::getorderidfrominvoicveid($request));
});