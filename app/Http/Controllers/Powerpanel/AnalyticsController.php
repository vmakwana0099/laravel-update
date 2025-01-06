<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Dashboard;
use App\Pagehit;
use App\CmsPage;
//use App\Faq;
use App\Blog;
use App\Newsletter;
use App\Contactus_lead;
use Input;
use DB;
use App\Alias;

class AnalyticsController extends PowerpanelController {
	
	/*
	|--------------------------------------------------------------------------
	| Dashboard Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling dashboard stats.
	|
	|
	|
	*/
	/**
	* Create a new Dashboard controller instance.
	*
	* @return void
	*/
	public function __construct() {
		parent::__construct();
		$this->middleware('auth');
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
	public function index() { 
		/*
		$arrLocations = Pagehit::select('id','var_ip_address')->where('iso_code','=',null)->get();
		if(!empty($arrLocations) && count($arrLocations)>0)
		{
			foreach ($arrLocations as $key => $value) {
				$loc=geoip($value->var_ip_address)->toArray();
				Pagehit::where('id', '=', $value->id)->update([
					'iso_code'=>$loc['iso_code'],
					'country'=>$loc['country'],
					'city' => $loc['city'],
					'state' => $loc['state'],
					'state_name' => $loc['state_name'],
					'postal_code' => $loc['postal_code'],
					'lat' => $loc['lat'],
					'lon' => $loc['lon'],
					'timezone' => $loc['timezone'],
					'continent' => $loc['continent'],
					'currency' => $loc['currency']
					]);
			}
		}*/


		$arrData = array();
		$arrData['unique_users'] = Pagehit::distinct('var_ip_address')->count('var_ip_address');
		$browsers_users = Pagehit::distinct('var_browser_info')->select('var_browser_info')->get();
		$visitor_info = Pagehit::groupBy('var_ip_address')
		->orderBy('vcount','desc')
		->select('var_ip_address', DB::raw('count(var_ip_address) as vcount'))
		->get()
		->take(5);


		$arrLocations = Pagehit::select('pagehits.*', DB::raw('count(var_ip_address) as vcount'))
		->where('iso_code','!=',null)
		->where('fk_alias_id','>',0)		
		->groupBy('var_ip_address')
		->get();

		foreach ($visitor_info as $visitor) {			
			$arrData['visitors'][] = $visitor->toArray();
		}

		$locationHits=[];		
		$geoCount=0;
		foreach ($arrLocations as $visitor) {
			array_push($locationHits, [
					'code'=>$visitor->iso_code,
					'name'=>$visitor->country,
					'value'=> $visitor->vcount,
					'color'=>'#'.dechex(rand(0x000000, 0xFFFFFF))
					]
				);
				$geoCount+=$visitor->vcount;
			}
		$arrData['locationUser']=json_encode($locationHits);
		$arrData['geoCount']=$geoCount;
		
		$arrCountry = array();
		// foreach ($arrLocations->toArray() as $key => $value) {
		// 	$temp = geoip($value['var_ip_address']);
		// 	// if(array_key_exists($temp->country, $arrCountry)){
		// 	// 	$arrCountry[$temp->country] = $arrCountry[$temp->country]+1;
		// 	// }else{
		// 	// 	$arrCountry[$temp->country] = 1;
		// 	// }
		// }
		// echo "<pre>";
		// print_r($arrCountry);
		// exit;

		$most_used_browser = array();
		$most_used_os = array();

		foreach ($browsers_users as $key => $browser) {
			$arrBrowser = $this->parse_user_agent($browser->var_browser_info);
			$topbrowser[] = $arrBrowser['browser'];
			$topOS[]  = $arrBrowser['platform'];

			$arrBrowser['browser'] = (!empty($arrBrowser['browser']))? $arrBrowser['browser']:"Unknown";
			$arrBrowser['platform'] = (!empty($arrBrowser['platform']))? $arrBrowser['platform']:"Unknown";

			if(array_key_exists($arrBrowser['browser'], $most_used_browser)){
				$most_used_browser[$arrBrowser['browser']] = $most_used_browser[$arrBrowser['browser']]+1;
			}else{
				$most_used_browser[$arrBrowser['browser']] =  1;
			}

			if(array_key_exists($arrBrowser['platform'], $most_used_os)){
				$most_used_os[$arrBrowser['platform']] = $most_used_os[$arrBrowser['platform']]+1;
			}else{
				$most_used_os[$arrBrowser['platform']] =  1;
			}

		}


		/** Browser Calcuation**/
		$arrStack =  array();

		if(array_key_exists('Firefox', $most_used_browser)){
			$arrStack[] =  array('Browser' => "Firefox", "Hits" => $most_used_browser['Firefox']);
			unset($most_used_browser['Firefox']);
		}
		if(array_key_exists('Chrome', $most_used_browser)){
			$arrStack[] = array('Browser' => "Chrome", "Hits" => $most_used_browser['Chrome']); 	
			unset($most_used_browser['Chrome']);
		}
		if(array_key_exists('Edge', $most_used_browser)){
			$arrStack[] = array('Browser' => "Edge", "Hits" => $most_used_browser['Edge']); 	
			unset($most_used_browser['Edge']);
		}
		if(array_key_exists('Safari', $most_used_browser)){
			$arrStack[] = array('Browser' => "Safari", "Hits" => $most_used_browser['Safari']);	
			unset($most_used_browser['Safari']);
		}
		if(array_key_exists('Opera', $most_used_browser)){
			$arrStack[] =  array('Browser' => "Opera", "Hits" => $most_used_browser['Opera']);
			unset($most_used_browser['Opera']);
		}		

		$arrStack[] =  array('Browser' => "Others", "Hits" => array_sum($most_used_browser));
		/** Broweser Calcution ends here**/		
		$sum_browser=array_sum($arrStack);
		usort($arrStack, array($this,'cmp'));
		reset($arrStack);
		$arrData['browsers'] = $arrStack;
		$arrData['most_used_browser'] = $arrStack[0]['Browser'];
		arsort($arrData['browsers']);
		$arrData['browsers'] = array_slice($arrData['browsers'], 0, 5, true);		
		$mostUsedBrowser=array();
		foreach ($arrData['browsers'] as $browser => $hits){				
		 	array_push($mostUsedBrowser, [
		 		'Browser'=>$browser,
		 		'Hits'=>(int)$hits//.'  ( '.round(($hits*100)/ $sum_browser).' )'
		 	]);			
		}		
		

		/** OS Calcuation**/
		$arrStackOs =  array();

		if(array_key_exists('Windows', $most_used_os)){
			$arrStackOs[] =  array('Os' => "Windows", "Hits" => $most_used_os['Windows']);
			unset($most_used_os['Windows']);
		}
		if(array_key_exists('iPhone', $most_used_os)){
			$arrStackOs[] = array('Os' => "iPhone", "Hits" => $most_used_os['iPhone']); 	
			unset($most_used_os['iPhone']);
		}
		if(array_key_exists('Android', $most_used_os)){
			$arrStackOs[] = array('Os' => "Android", "Hits" => $most_used_os['Android']); 	
			unset($most_used_os['Android']);
		}
		if(array_key_exists('Macintosh', $most_used_os)){
			$arrStackOs[] = array('Os' => "Macintosh", "Hits" => $most_used_os['Macintosh']);	
			unset($most_used_os['Macintosh']);
		}	

		$arrStackOs[] =  array('Os' => "Others", "Hits" => array_sum($most_used_os));
		/** OS Calcution ends here**/


		$arrData['operating_systems'] = $arrStackOs;		
		usort($arrStackOs, array($this,'cmp'));
		reset($arrStackOs);
		$arrData['most_used_os'] = $arrStackOs[0]['Os'];
		arsort($arrData['operating_systems']);
		$arrData['operating_systems'] = array_slice($arrData['operating_systems'], 0, 5, true);
		$arrTopOs=array();
		foreach ($arrData['operating_systems'] as $os => $hits){				
		 	array_push($arrTopOs, [
		 		'Os'=>$os,
		 		'Hits'=>(int)$hits//.'  ( '.round(($hits*100)/ $sum_os).' )'
		 	]);			
		}		
		
		$arrTopVisitors=array();
		foreach ($arrData['visitors'] as $key=>$visitors){
			 	array_push($arrTopVisitors, [
			 		'Ip'=>$arrData['visitors'][$key]['var_ip_address'],
			 		'Hits'=>(int)$arrData['visitors'][$key]['vcount']//.'  ( '.round(($hits*100)/ $sum_os).' )'
			 		]);			
		}	
		
		$arrData['sum_browser'] = $sum_browser;
		$arrData['sum_os'] = array_sum($arrStackOs);
		$arrData['browsersPie'] = json_encode($arrStack);
		$arrData['osPie'] = json_encode($arrStackOs);
		$arrData['vistorsPie'] = json_encode($arrTopVisitors);
		$arrData['mobile_hits'] = Pagehit::where('isWeb','N')->where('fk_alias_id','>',0)->count();
		$arrData['web_hits'] = Pagehit::where('isWeb','Y')->where('fk_alias_id','>',0)->count();
		$arrData['range_hits']=$this->get_range_analysis()['weekHits'];
		$arrData['range_leads']=$this->get_range_analysis()['leads'];

		$this->breadcrumb['title']=trans('template.showanalytics');
		
		return view('powerpanel.analytics.analytics_dashboard',$arrData,['breadcrumb'=>$this->breadcrumb]);

	}

	public static function cmp ($a, $b) {
    return $a['Hits'] < $b['Hits'] ? 1 : -1;
		}


	function get_range_analysis(){
		if(null !== Input::get('start') && null !== Input::get('end') ){
			$start=Input::get('start');
			$end=Input::get('end');
		}else{
			$start=date('Y-m-d', strtotime('-7 days'));
			$end=date('Y-m-d');
		}

		$arrFields = array(
		DB::raw('created_at AS created_at'),
		DB::raw('COUNT(*) AS visitor')
		);		
		$last_week_hits=Pagehit::select($arrFields)
		->whereBetween(DB::raw('DATE(created_at)'), [
			date('Y-m-d',strtotime($start)),
			date('Y-m-d',strtotime($end))
		])
		// ->whereRaw('DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)')
		// ->whereRaw('DATE(created_at) <= CURDATE()')
		->orderBy('created_at')
		->groupBy(DB::raw('DATE(created_at)'))			
		->get()->toArray();
		$weekHits=array();
		foreach ($last_week_hits as $data) {
			array_push($weekHits, [ date('m/d',strtotime($data['created_at'])),$data['visitor']]);
		}

		$analytics['weekHits']=json_encode($weekHits);
		$analytics['leads']=$this->get_range_analysis_leads($start,$end);
		return $analytics;
	}

	function get_range_analysis_leads($start=null,$end=null){
		if($start==null && $end==null ){			
			$start=date('Y-m-d', strtotime('-7 days'));
			$end=date('Y-m-d');
		}

		$arrFields = array(
		DB::raw('created_at AS created_at'),
		DB::raw('COUNT(*) AS leads')
		);		
		$last_week_hits=Contactus_lead::select($arrFields)
		->whereBetween(DB::raw('DATE(created_at)'), [
			date('Y-m-d',strtotime($start)),
			date('Y-m-d',strtotime($end))
		])
		// ->whereRaw('DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)')
		// ->whereRaw('DATE(created_at) <= CURDATE()')
		->orderBy('created_at')
		->groupBy(DB::raw('DATE(created_at)'))			
		->get()->toArray();	

		$weekHits=array();
		foreach ($last_week_hits as $data) {
			array_push($weekHits, [ date('m/d',strtotime($data['created_at'])),$data['leads']]);
		}
		return json_encode($weekHits);
	}

	function getHighestRecurrence($strs){

		/*Storage for individual words*/
		$words = Array();

		/*Process multiple strings*/
		if(is_array($strs))
			foreach($strs as $str)
			 $words = array_merge($words, explode(" ", $str));

	 /*Prepare single string*/
		else
			$words = explode(" ",$strs);

		/*Array for word counters*/
		$index = Array();

		/*Aggregate word counters*/
		foreach($words as $word)

				/*Increment count or create if it doesn't exist*/
				(isset($index[$word]))? $index[$word]++ : $index[$word] = 1;


		/*Sort array hy highest value and */
		arsort($index);

		/*Return the word*/
		return key($index);
	}


	/**
 * Parses a user agent string into its important parts
 *
 * @author Jesse G. Donat <donatj@gmail.com>
 * @link https://github.com/donatj/PhpUserAgent
 * @link http://donatstudios.com/PHP-Parser-HTTP_USER_AGENT
 * @param string|null $u_agent User agent string to parse or null. Uses $_SERVER['HTTP_USER_AGENT'] on NULL
 * @throws \InvalidArgumentException on not having a proper user agent to parse.
 * @return string[] an array with browser, version and platform keys
 */
function parse_user_agent( $u_agent = null ) {
	if( is_null($u_agent) ) {
		if( isset($_SERVER['HTTP_USER_AGENT']) ) {
			$u_agent = $_SERVER['HTTP_USER_AGENT'];
		} else {
			throw new \InvalidArgumentException('parse_user_agent requires a user agent');
		}
	}
	$platform = null;
	$browser  = null;
	$version  = null;
	$empty = array( 'platform' => $platform, 'browser' => $browser, 'version' => $version );
	if( !$u_agent ) return $empty;
	if( preg_match('/\((.*?)\)/im', $u_agent, $parent_matches) ) {
		preg_match_all('/(?P<platform>BB\d+;|Android|CrOS|Tizen|iPhone|iPad|iPod|Linux|Macintosh|Windows(\ Phone)?|Silk|linux-gnu|BlackBerry|PlayBook|X11|(New\ )?Nintendo\ (WiiU?|3?DS)|Xbox(\ One)?)
				(?:\ [^;]*)?
				(?:;|$)/imx', $parent_matches[1], $result, PREG_PATTERN_ORDER);
		$priority = array( 'Xbox One', 'Xbox', 'Windows Phone', 'Tizen', 'Android', 'CrOS', 'X11' );
		$result['platform'] = array_unique($result['platform']);
		if( count($result['platform']) > 1 ) {
			if( $keys = array_intersect($priority, $result['platform']) ) {
				$platform = reset($keys);
			} else {
				$platform = $result['platform'][0];
			}
		} elseif( isset($result['platform'][0]) ) {
			$platform = $result['platform'][0];
		}
	}
	if( $platform == 'linux-gnu' || $platform == 'X11' ) {
		$platform = 'Linux';
	} elseif( $platform == 'CrOS' ) {
		$platform = 'Chrome OS';
	}
	preg_match_all('%(?P<browser>Camino|Kindle(\ Fire)?|Firefox|Iceweasel|IceCat|Safari|MSIE|Trident|AppleWebKit|
				TizenBrowser|Chrome|Vivaldi|IEMobile|Opera|OPR|Silk|Midori|Edge|CriOS|UCBrowser|Puffin|SamsungBrowser|
				Baiduspider|Googlebot|YandexBot|bingbot|Lynx|Version|Wget|curl|
				Valve\ Steam\ Tenfoot|
				NintendoBrowser|PLAYSTATION\ (\d|Vita)+)
				(?:\)?;?)
				(?:(?:[:/ ])(?P<version>[0-9A-Z.]+)|/(?:[A-Z]*))%ix',
		$u_agent, $result, PREG_PATTERN_ORDER);
	// If nothing matched, return null (to avoid undefined index errors)
	if( !isset($result['browser'][0]) || !isset($result['version'][0]) ) {
		if( preg_match('%^(?!Mozilla)(?P<browser>[A-Z0-9\-]+)(/(?P<version>[0-9A-Z.]+))?%ix', $u_agent, $result) ) {
			return array( 'platform' => $platform ?: null, 'browser' => $result['browser'], 'version' => isset($result['version']) ? $result['version'] ?: null : null );
		}
		return $empty;
	}
	if( preg_match('/rv:(?P<version>[0-9A-Z.]+)/si', $u_agent, $rv_result) ) {
		$rv_result = $rv_result['version'];
	}
	$browser = $result['browser'][0];
	$version = $result['version'][0];
	$lowerBrowser = array_map('strtolower', $result['browser']);
	$find = function ( $search, &$key, &$value = null ) use ( $lowerBrowser ) {
		$search = (array)$search;
		foreach( $search as $val ) {
			$xkey = array_search(strtolower($val), $lowerBrowser);
			if( $xkey !== false ) {
				$value = $val;
				$key   = $xkey;
				return true;
			}
		}
		return false;
	};
	$key = 0;
	$val = '';
	if( $browser == 'Iceweasel' || strtolower($browser) == 'icecat' ) {
		$browser = 'Firefox';
	} elseif( $find('Playstation Vita', $key) ) {
		$platform = 'PlayStation Vita';
		$browser  = 'Browser';
	} elseif( $find(array( 'Kindle Fire', 'Silk' ), $key, $val) ) {
		$browser  = $val == 'Silk' ? 'Silk' : 'Kindle';
		$platform = 'Kindle Fire';
		if( !($version = $result['version'][$key]) || !is_numeric($version[0]) ) {
			$version = $result['version'][array_search('Version', $result['browser'])];
		}
	} elseif( $find('NintendoBrowser', $key) || $platform == 'Nintendo 3DS' ) {
		$browser = 'NintendoBrowser';
		$version = $result['version'][$key];
	} elseif( $find('Kindle', $key, $platform) ) {
		$browser = $result['browser'][$key];
		$version = $result['version'][$key];
	} elseif( $find('OPR', $key) ) {
		$browser = 'Opera Next';
		$version = $result['version'][$key];
	} elseif( $find('Opera', $key, $browser) ) {
		$find('Version', $key);
		$version = $result['version'][$key];
	} elseif( $find('Puffin', $key, $browser) ) {
		$version = $result['version'][$key];
		if( strlen($version) > 3 ) {
			$part = substr($version, -2);
			if( ctype_upper($part) ) {
				$version = substr($version, 0, -2);
				$flags = array( 'IP' => 'iPhone', 'IT' => 'iPad', 'AP' => 'Android', 'AT' => 'Android', 'WP' => 'Windows Phone', 'WT' => 'Windows' );
				if( isset($flags[$part]) ) {
					$platform = $flags[$part];
				}
			}
		}
	} elseif( $find(array( 'IEMobile', 'Edge', 'Midori', 'Vivaldi', 'SamsungBrowser', 'Valve Steam Tenfoot', 'Chrome' ), $key, $browser) ) {
		$version = $result['version'][$key];
	} elseif( $rv_result && $find('Trident', $key) ) {
		$browser = 'MSIE';
		$version = $rv_result;
	} elseif( $find('UCBrowser', $key) ) {
		$browser = 'UC Browser';
		$version = $result['version'][$key];
	} elseif( $find('CriOS', $key) ) {
		$browser = 'Chrome';
		$version = $result['version'][$key];
	} elseif( $browser == 'AppleWebKit' ) {
		if( $platform == 'Android' && !($key = 0) ) {
			$browser = 'Android Browser';
		} elseif( strpos($platform, 'BB') === 0 ) {
			$browser  = 'BlackBerry Browser';
			$platform = 'BlackBerry';
		} elseif( $platform == 'BlackBerry' || $platform == 'PlayBook' ) {
			$browser = 'BlackBerry Browser';
		} else {
			$find('Safari', $key, $browser) || $find('TizenBrowser', $key, $browser);
		}
		$find('Version', $key);
		$version = $result['version'][$key];
	} elseif( $pKey = preg_grep('/playstation \d/i', array_map('strtolower', $result['browser'])) ) {
		$pKey = reset($pKey);
		$platform = 'PlayStation ' . preg_replace('/[^\d]/i', '', $pKey);
		$browser  = 'NetFront';
	}
	return array( 'platform' => $platform ?: null, 'browser' => $browser ?: null, 'version' => $version ?: null );
}

}