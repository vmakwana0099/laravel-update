<?php
namespace App\Http\Controllers;

use DB;
use Config;
use App\Helpers\MyLibrary;
use App\Whmcs;
use Illuminate\Http\Request;
use App\Cart;
//use App\ProductCategory;
use App\user_session;
//use App\ContactInfo;
use App\Helpers\Email_sender;
use Session;
use App\Testhits;
use Illuminate\Support\Facades\Storage;
use App\GeneralSettings;
use App\Blackfridayspinwheel;
use App\ContactLead;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
// use Cookie;

use Stevebauman\Location\Facades\Location;


class TesthitsController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    public function whmcspricing(Request $request){
        
$linksArr = array();

$linksArr['179'] = array("link" => "/hosting/linux-hosting","name" => "Linux Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['180'] = array("link" => "/hosting/linux-hosting","name" => "Linux Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['181'] = array("link" => "/hosting/linux-hosting","name" => "Linux Hosting", "type" => "<span style='color:green'>Business</span>");

$linksArr['186'] = array("link" => "/hosting/windows-hosting","name" => "Windows Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['187'] = array("link" => "/hosting/windows-hosting","name" => "Windows Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['188'] = array("link" => "/hosting/windows-hosting","name" => "Windows Hosting", "type" => "<span style='color:green'>Business</span>");

		
$linksArr['155'] = array("link" => "hosting/wordpress-hosting","name" => "Wordpress Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['156'] = array("link" => "hosting/wordpress-hosting","name" => "Wordpress Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['157'] = array("link" => "hosting/wordpress-hosting","name" => "Wordpress Hosting", "type" => "<span style='color:green'>Business</span>");

		
$linksArr['158'] = array("link" => "hosting/java-hosting","name" => "Java Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['159'] = array("link" => "hosting/java-hosting","name" => "Java Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['160'] = array("link" => "hosting/java-hosting","name" => "Java Hosting", "type" => "<span style='color:green'>Business</span>");

		
$linksArr['161'] = array("link" => "hosting/ecommerce-hosting","name" => "eCommerce Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['162'] = array("link" => "hosting/ecommerce-hosting","name" => "eCommerce Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['163'] = array("link" => "hosting/ecommerce-hosting","name" => "eCommerce Hosting", "type" => "<span style='color:green'>Business</span>");

		
$linksArr['169'] = array("link" => "hosting/site-lock","name" => "Site Lock", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['170'] = array("link" => "hosting/site-lock","name" => "Site Lock", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['171'] = array("link" => "hosting/site-lock","name" => "Site Lock", "type" => "<span style='color:green'>Business</span>");

$linksArr['176'] = array("link" => "hosting/linux-reseller-hosting","name" => "Linux Reseller Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['177'] = array("link" => "hosting/linux-reseller-hosting","name" => "Linux Reseller Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['178'] = array("link" => "hosting/linux-reseller-hosting","name" => "Linux Reseller Hosting", "type" => "<span style='color:green'>Business</span>");
		
$linksArr['192'] = array("link" => "hosting/windows-reseller-hosting","name" => "Windows Reseller Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['175'] = array("link" => "hosting/windows-reseller-hosting","name" => "Windows Reseller Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['174'] = array("link" => "hosting/windows-reseller-hosting","name" => "Windows Reseller Hosting", "type" => "<span style='color:green'>Business</span>");
		
$linksArr['154'] = array("link" => "servers/vps-hosting","name" => "VPS Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['236'] = array("link" => "servers/vps-hosting","name" => "VPS Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['238'] = array("link" => "servers/vps-hosting","name" => "VPS Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['250'] = array("link" => "servers/vps-hosting","name" => "VPS Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['190'] = array("link" => "servers/vps-hosting","name" => "VPS Hosting", "type" => "<span style='color:green'>Business</span>");

$linksArr['220'] = array("link" => "servers/linux-vps-hosting","name" => "Linux VPS Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['221'] = array("link" => "servers/linux-vps-hosting","name" => "Linux VPS Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['227'] = array("link" => "servers/linux-vps-hosting","name" => "Linux VPS Hosting", "type" => "<span style='color:green'>Business</span>");
		
$linksArr['222'] = array("link" => "servers/windows-vps-hosting","name" => "Windows VPS Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['224'] = array("link" => "servers/windows-vps-hosting","name" => "Windows VPS Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['225'] = array("link" => "servers/windows-vps-hosting","name" => "Windows VPS Hosting", "type" => "<span style='color:green'>Business</span>");
		
$linksArr['183'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['184'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['185'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:green'>Business</span>");
		
$linksArr['117'] = array("link" => "email/google-apps","name" => "Google Apps", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['116'] = array("link" => "email/google-apps","name" => "Google Apps", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['206'] = array("link" => "email/google-apps","name" => "Google Apps", "type" => "<span style='color:green'>Business</span>");
		
$linksArr['207'] = array("link" => "email/microsoft-office-365-suite","name" => "Office 365 Suite", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['209'] = array("link" => "email/microsoft-office-365-suite","name" => "Office 365 Suite", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['208'] = array("link" => "email/microsoft-office-365-suite","name" => "Office 365 Suite", "type" => "<span style='color:green'>Business</span>");
		
$linksArr['195'] = array("link" => "/ssl-certificates","name" => "SSL Domain", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['196'] = array("link" => "/ssl-certificates","name" => "SSL Domain", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['197'] = array("link" => "/ssl-certificates","name" => "SSL Domain", "type" => "<span style='color:green'>Business</span>");
		
$linksArr['198'] = array("link" => "/ssl-certificates","name" => "SSL Organization", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['199'] = array("link" => "/ssl-certificates","name" => "SSL Organization", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['200'] = array("link" => "/ssl-certificates","name" => "SSL Organization", "type" => "<span style='color:green'>Business</span>");

// New Dedicated server plan start april 2023
$linksArr['357'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS1</span>");
$linksArr['358'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS2</span>");
$linksArr['361'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS3</span>");
$linksArr['435'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS4</span>");
$linksArr['363'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS5</span>");
$linksArr['360'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS6</span>");
$linksArr['334'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS7</span>");
$linksArr['362'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS8</span>");
$linksArr['364'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS9</span>");
$linksArr['365'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS10</span>");
$linksArr['337'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS11</span>");
$linksArr['440'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS12</span>");
$linksArr['439'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS13</span>");
$linksArr['438'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS14</span>");
$linksArr['441'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS15</span>");
$linksArr['443'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS16</span>");
$linksArr['444'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS17</span>");
$linksArr['447'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS18</span>");
$linksArr['338'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS19</span>");
$linksArr['339'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS20</span>");
$linksArr['448'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS21</span>");
$linksArr['452'] = array("link" => "servers/dedicated-servers","name" => "Dedicated Servers", "type" => "<span style='color:blue'>DS22</span>");
// New Dedicated server plan end


$linksArr['495'] = array("link" => "web-hosting","name" => "web Hosting", "type" => "<span style='color:green'>Business</span>");
$linksArr['496'] = array("link" => "web-hosting","name" => "web Hosting", "type" => "<span style='color:green'>Business</span>");
$linksArr['497'] = array("link" => "web-hosting","name" => "web Hosting", "type" => "<span style='color:green'>Business</span>");
$linksArr['498'] = array("link" => "web-hosting","name" => "web Hosting", "type" => "<span style='color:green'>Business</span>");

$linksArr['499'] = array("link" => "servers/vps-hosting-india","name" => "VPS Hosting", "type" => "<span style='color:pink'>Starter</span>");
$linksArr['500'] = array("link" => "servers/vps-hosting-india","name" => "VPS Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['501'] = array("link" => "servers/vps-hosting-india","name" => "VPS Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['502'] = array("link" => "servers/vps-hosting-india","name" => "VPS Hosting", "type" => "<span style='color:blue'>Performance</span>");
$linksArr['503'] = array("link" => "servers/vps-hosting-india","name" => "VPS Hosting", "type" => "<span style='color:green'>Business</span>");

        $pid = isset($request->pid)?$request->pid:'';
        $cid = isset($request->curr)?$request->curr:'';
        $str = "";
        echo '<form action="">
            <h1> Product Id: "'.$pid.'"</h1> <input type="text" id="pid" name="pid" value="'.$pid.'">
            <input type="text" id="curr" name="curr" value="'.$cid.'">
            <input type="submit" id="btn" name="btn" value="Submit">
            <div><strong>All:</strong>179,180,181,186,187,188,155,156,157,158,159,160,161,162,163,169,170,171,176,177,178,192,175,174,154,164,190,220,221,227,222,224,225,183,184,185,117,116,206,207,209,208,195,196,197,198,199,200</div>
        <form>';
       
        if(empty($pid)){ echo "Product Id not found";exit; }
        $tldparams = [];
        $tldparams['currencycode'] = !empty($cid)?$cid:Config::get('Constant.sys_currency');
        if($tldparams['currencycode'] == 'INR'){ echo "<h3>Currency: ".$tldparams['currencycode']."</h3> | <a href='/testhits/whmcspricing?pid=".$pid."&curr=USD'>USD</a>"; }
        if($tldparams['currencycode'] == 'USD'){ echo "<h3>Currency: ".$tldparams['currencycode']."</h3> | <a href='/testhits/whmcspricing?pid=".$pid."&curr=INR'>INR</a>"; }
        $parr = explode(",",$pid);
        $htmlStr = "";
        
        $Tld_array = array();
        if(!empty($parr)){
            foreach($parr as $p){
                $htmlStr .= "<h3>Product: [".$linksArr[$p]['type']."] | ". $p." | <a target='_blank' href='".url($linksArr[$p]['link'])."'>".$linksArr[$p]['name']."</a></h3>";
                $htmlStr .= "<table border='1'cellpadding='5' cellspacing='0' >";
                $tldparams['productid'] = $p;
                $Tld_array[$p] = Cart::getProductPricingTemp($tldparams);     
                $t1 = "<tr>";
                $t2 = "<tr>";
                $t3 = "<tr>";
                foreach($Tld_array[$p] as $key => $slot){
                    
                    if($key == 'monthly'){  $t1 .= "<th>1 Month</th>"; }
                    else if($key == 'quarterly'){ $t1 .= "<th>3 Months</th>"; }
                    else if($key == 'semiannually'){ $t1 .= "<th>6 Months</th>"; }
                    else if($key == 'annually'){ $t1 .= "<th>1 Year</th>"; }
                    else if($key == 'biennially'){  $t1 .= "<th>2 Years</th>"; }
                    else if($key == 'triennially'){ $t1 .= "<th>3 Years</th>"; }
                    
                    if($key == 'monthly'){  $t2 .= "<td>".$slot."</td>"; }
                    else if($key == 'quarterly'){ $t2 .= "<td>".$slot."</td>"; }
                    else if($key == 'semiannually'){ $t2 .= "<td>".$slot."</td>"; }
                    else if($key == 'annually'){ $t2 .= "<td>".$slot."</td>"; }
                    else if($key == 'biennially'){  $t2 .= "<td>".$slot."</td>"; }
                    else if($key == 'triennially'){ $t2 .= "<td>".$slot."</td>"; }

                    if($key == 'monthly')
                    { if((($slot)/1) > 0){  $t3 .= "<td>".(($slot)/1)."/Month</td>"; } else { $t3 .= "<td>-</td>"; } }

                    if($key == 'quarterly')
                    { if((($slot)/3) > 0){ $t3 .= "<td>".(($slot)/3)."/Month</td>"; } else { $t3 .= "<td>-</td>"; } }
                    
                    if($key == 'semiannually')
                    { if((($slot)/6) > 0){ $t3 .= "<td>".(($slot)/6)."/Month</td>"; } else { $t3 .= "<td>-</td>"; } } 

                    if($key == 'annually')
                    { if((($slot)/12) > 0){ $t3 .= "<td>".(($slot)/12)."/Month</td>"; } else { $t3 .= "<td>-</td>"; } }
                    
                    if($key == 'biennially')
                    { if((($slot)/24) > 0){  $t3 .= "<td>".(($slot)/24)."/Month</td>"; } else { $t3 .= "<td>-</td>"; } }
                    
                    if($key == 'triennially')
                    { if((($slot)/36) > 0){ $t3 .= "<td>".(($slot)/36)."/Month</td>"; } else { $t3 .= "<td>-</td>"; } }

                }
                
                $t1 .= "</tr>";
                $t2 .= "</tr>";
                $t3 .= "</tr>";
                $htmlStr .= $t1;
                $htmlStr .= $t2;
                $htmlStr .= $t3;
                $htmlStr .= "</table>";
            }
        }
        
        echo $htmlStr;
        //echo '<pre>';print_r($Tld_array);

        echo json_encode($Tld_array);exit;
                
       
    }
    public function removeclient(Request $request) {
        // Email_sender::testMail();
        $data = array();
        if (isset($request->whmcsid)) {
            $data['whmcsid'] = $request->whmcsid;
        }
        Testhits::getclient($data);
        echo "Client Removed!";
    }

    public function thankyoutest(){
        $data['orderid'] = '123';
        return view('cart.thankyou', ['data' => $data]);
        
    }
   
    public function index(Request $request){
        $param = $_REQUEST;
        $whmcsid=$param['id'];
        $details = Cart::getClientDetails($whmcsid);
        $response = MyLibrary::laravelcallapi("orderratingupdate", $param);

        if ($response['result'] == 'success') {
             return view('rating_template.thankyou', ['headers' => $param,'details' => $details]);            // return view('rating_template.thankyou');
            // return view('rating_template.thankyou', ['message' => Session::get('message')]);
        } elseif($response['result'] == 'duplicate') {
             // return view('rating_template.thankyou', ['headers' => $param,'details' => $details]);            // return view('rating_template.thankyou');

            return view('rating_template.thankyou_exist', ['message' => Session::get('message')]);  
        } elseif($response['result'] == 'invalid data') {
            // return view('rating_template.thankyou_datanotfound', ['message' => Session::get('message')]);  
            
            return view('errors.404');
        }
    } 
    public function ratingupdate(Request $request){
       $param = $_REQUEST;
       $whmcsid=$param['id'];
       $details = Cart::getClientDetails($whmcsid);

        // $data = [];
        // $data['id']=$request['id'];
        // $data['oder_id']=$request['oder_id'];
        // $data['attentive']=$request['attentive'];
        // $data['suggestions']=$request['suggestions'];
        // $data['star']=$request['star'];
        $response = MyLibrary::laravelcallapi("orderratingupdatedata", $param);
     // echo '<pre>aa: '; print_r($response);exit;       

    if ($response['result'] == 'success') {            
             return 1;
          
        } elseif($response['result'] == 'duplicate') {              

            return 2;  
        } elseif($response['result'] == 'invalid data') {
            return 0;
        }    
       }
 public function thankyou()
 {
    echo '<pre>';print_r("123");exit;
    if(request()->isMethod('post')) {
        echo '<pre>'; 
        print_r("test");
        exit;
    } else {
        abort(404);
    }
 }    
 public function whmcspdata(){
            $params['action'] = "getactiveproductsids";
            $activePIDs = Whmcs::callapi($params);
            // echo '<pre>';print_r($activePIDs);exit;
            $pids = '';
            foreach ($activePIDs as $key => $value) {
                $pids .= $value['id'] . ','; 
            }
            $params['pid'] = rtrim($pids, ',');
            $params['action'] = 'GetProducts';
            $productsdetails = Whmcs::callapi($params);
            $data = [];
            foreach ($productsdetails['products']['product'] as $key => $value) {
                $data[$value['pid']] = $value;
            }
            

            $final_data = json_encode($data, JSON_PRETTY_PRINT);
            $filePath = storage_path('app/whmcsproduct/whmcs_response.js');

            // Ensure the directory exists in storage
            if (!File::exists(storage_path('app/whmcsproduct'))) {
                File::makeDirectory(storage_path('app/whmcsproduct'), 0755, true);
            }

            // Wrap the JSON in a JavaScript variable
            $jsContent = "window.whmcsProducts = $final_data;";

            // Save the content to the file
            File::put($filePath, $jsContent);

            // Log::info('WHMCS API response successfully stored in whmcs_response.js');
            return 0;
        
 }  
 public function removeCartItemAnalytices(Request $request){
        if (isset($_REQUEST['ele_key'])) {
        $key = $_REQUEST['ele_key'];
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            $res=$cartData[$key];
            /*echo '1 => <pre>';print_r($res);exit;*/
            echo json_encode($res);exit;
        }
        else{
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            $res=$cartData;
            /*echo '2 => <pre>';print_r($res);exit;*/
            echo json_encode($res);exit;
        }
    }
    public function testapi(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://manage.hostitsmart.com/includes/api.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query(
                array(
                    'action' => 'GetAdminDetails',
                    // See https://developers.whmcs.com/api/authentication
                    'username' => 'ZyjSSPOuTToAmyLZXN13BCaCQTSjvP8I',
                    'password' => 'plgLV63LlubL4MRig6LgNDigMvKRH4EB',
                    'responsetype' => 'json',
                )
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
echo '<pre>';print_r($response);exit;
        curl_close($ch);
    }
}
