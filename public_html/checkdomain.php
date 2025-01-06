<?php
header("Access-Control-Allow-Origin: *");
//---------------------- Testing ---------------------------------
/*define("RESELLER_API_URL","https://domaincheck.httpapi.com/api/");
define("RESELLER_API_KEY","GVS2fYf6kZxTkVPBoTmFfZBuzXUo59YQ");
define("RESELLER_API_ID","738308");*/
//---------------------- Testing ---------------------------------
/*//---------------------- Live ---------------------------------
define("RESELLER_API_URL","https://domaincheck.httpapi.com/api/");
define("RESELLER_API_KEY","mLgbpRFAtl1N2X0p0GjSJMmrQmSGOH9g");
define("RESELLER_API_ID","737693");
//---------------------- Live ---------------------------------*/

/*//---------------------- Live ---------------------------------
define("RESELLER_API_URL","https://domaincheck.httpapi.com/api/");
define("RESELLER_API_KEY","sBkJyy4Hb4X6ZrCatQJE4Kc55sbhugs7");
define("RESELLER_API_ID","411490");
//---------------------- Live ---------------------------------*/

define("RESELLER_API_URL","https://domaincheck.httpapi.com/api/");
define("RESELLER_API_KEY","uwMxtJC1R3ulylTBiZYI5i7Rk4fppsE3");
define("RESELLER_API_ID","739518");

function resellerclub_domain_availability($domainname, $tlds) {
        //check domain availability from live reseller club api
        /*$resellerclub_link = 'https://domaincheck.httpapi.com/api/';
        $resellerclub_apikey = 'GVS2fYf6kZxTkVPBoTmFfZBuzXUo59YQ';
        $resellerclub_id = '738308';*/
        $resellerclub_link = RESELLER_API_URL;
        $resellerclub_apikey = RESELLER_API_KEY; 
        $resellerclub_id = RESELLER_API_ID;
		
		$i = 0;
		$url = $resellerclub_link . 'domains/available.json?auth-userid=' . $resellerclub_id . '&api-key=' . $resellerclub_apikey;
        $domainStr = '';
        if(!empty($domainname)){
        	if(is_array($domainname)){
        		foreach($domainname as $dname){
        			$domainStr.= '&domain-name='.$dname;
        		}
        	}
        	else {
        		$domainStr.= '&domain-name='.$domainname;
        	}
        }
        if(!empty($tlds)){
        	if(is_array($tlds)){
        		foreach($tlds as $tld=>$tldval){
        			$domainStr.= '&tlds='.$tldval;
        		}
        	}
        	else 
        	{
        		$domainStr.= '&tlds='.$tlds;
        	}
        }
        $url .= $domainStr;
       	
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        $datajson = json_decode($data, TRUE);

        return $datajson;
    }
    
function resellerclub_premium_domain($domainname)
    {       
        $resellerclub_link = RESELLER_API_URL;
        $resellerclub_apikey = RESELLER_API_KEY; 
        $resellerclub_id = RESELLER_API_ID;
		
		$url = 'https://httpapi.com/api/domains/premium-check.json?auth-userid=' . $resellerclub_id . '&api-key=' . $resellerclub_apikey.'&domain-name='.$domainname;
		//echo $url;
		$url .= $domainStr;
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        
        curl_close($ch);
        $datajson = json_decode($data, TRUE);
        return $datajson;
    }
    
$dnames = isset($_REQUEST['domainname'])?$_REQUEST['domainname']:array();

$tlds = isset($_REQUEST['tlds'])?$_REQUEST['tlds']:array();

$tldlist=explode(",",$tlds);

if(empty($dnames))
{ echo json_encode(['result' => "error",'msg' => "Please provide parameters 'domainname'"]);exit; }
if(empty($tlds))
{ echo json_encode(['result' => "error",'msg' => "Please provide parameters 'tlds'"]);exit; }
if(!empty($dnames) && !empty($tlds)){
	$domainData = resellerclub_domain_availability($dnames,$tldlist);
	foreach($domainData as $key => $_d){
	    if(isset($domainData[$key]['status']) && $domainData[$key]['status'] == 'available')
	    { 
	        $premiumData = resellerclub_premium_domain($key);
	        if(isset($premiumData['premium']) && $premiumData['premium'] == true ){ $domainData[$key]['status'] = 'regthroughothers'; }
	    }
	}
	//echo '<pre>';print_r($domainData);exit;
	$strContent = date("m-d-Y H:i:s")." | ".json_encode($domainData); 
    file_put_contents('domain_check_log.txt', "\n".$strContent, FILE_APPEND);
	echo json_encode($domainData);exit;
}
exit;
?>