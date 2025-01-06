<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\Alias;
use Validator;
use App\GlobalSearch;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\UrlGenerator;

use App\Http\Traits\time;
use Carbon\Carbon;
use DB;
class GlobalSearchController extends PowerpanelController{
		
	/**
  * Create a new controller instance.
  * @return void
  */
	public function __construct(UrlGenerator $url) {
		parent::__construct();
		$this->url = $url;
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
	/**
	* Show the application dashboard.
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request,Guard $auth) {
		$response = array();
		$module_team =	DB::table('modules')->where('var_module_name','=','team')->first();
		$team_code = $module_team->int_code;
		$module_faq =	DB::table('modules')->where('var_module_name','=','faq')->first();
		$faq_code = $module_faq->int_code;
		$module_pages =	DB::table('modules')->where('var_module_name','=','cms-page')->first();
		$cmspage_code = $module_pages->int_code;
		$module_banner =	DB::table('modules')->where('var_module_name','=','banners')->first();
		$banner_code = $module_banner->int_code;
		$module_service =	DB::table('modules')->where('var_module_name','=','services')->first();
		$service_code = $module_service->int_code;
		$module_staticblock =	DB::table('modules')->where('var_module_name','=','staticblocks')->first();
		$staticblock_code = $module_staticblock->int_code;
		/*$module_event =	DB::table('modules')->where('var_module_name','=','event')->first();
		$event_code = $module_event->int_code;*/
		$module_blog =	DB::table('modules')->where('var_module_name','=','blog')->first();
		$blog_code = $module_blog->int_code;
		$module_testimonial =	DB::table('modules')->where('var_module_name','=','testimonial')->first();
		$testimonial_code = $module_testimonial->int_code;
		/*$module_sponsor =	DB::table('modules')->where('var_module_name','=','sponsors')->first();
		$sponsor_code = $module_sponsor->int_code;*/
		$module_contact =	DB::table('modules')->where('var_module_name','=','contact')->first();
		$contact_code = $module_contact->int_code;
		$image_url = $this->url->to('assets/images/default.png');
		if (!empty($request->searchValue)) {
			$searchGlobalValue = $request->searchValue;
		} else {
			$searchGlobalValue = '';
		}
	  $globalSearchData = GlobalSearch::global_search($searchGlobalValue,$team_code,$faq_code,$cmspage_code,$banner_code,$service_code,$staticblock_code,$blog_code,$testimonial_code,$contact_code,$image_url);
	  $sortArr = $this->sort_arr_of_obj($globalSearchData['matches'],'name','asc');
	  $response['results'] = $sortArr;
	  $response['guess_words'] = $globalSearchData['guess_words'];
	 	echo json_encode($response);
	}
	function sort_arr_of_obj($array,$sortby,$direction='asc'){
    $sortedArr = array();
    $tmp_Array = array();
    foreach($array as $k => $v) {
      $tmp_Array[] = strtolower($v[$sortby]);
    }
    if($direction=='asc'){
      asort($tmp_Array);
    }else{
      arsort($tmp_Array);
    }
    foreach($tmp_Array as $k=>$tmp){
      $sortedArr[] = $array[$k];
    }
	  return $sortedArr;
	}
}