<?php
	/**
 * The MenuController class handels dynamic menu configuration
 * configuration  process.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause 
 * @version   1.00
 * @since     2016-10-01
 * @author    NetQuick
 */
namespace App\Http\Controllers\Powerpanel;
use Request;
use App\Http\Requests;
use App\Http\Controllers\PowerpanelController;
use App\Modules;
use App\Permission;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Auth\Guard;
use DB;
use App\Alias;
use App\Trash;
use App\Log;
use Auth;
class TrashController extends PowerpanelController {
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}	
/**
 * This method loads deleted records
 * @return  View
 * @since   2016-10-25
 * @author  NetQuick
 */
	public function index(Request $request) { 	
	    
	    $this->breadcrumb['title']=trans('template.managetrashes');
		$breadcrumb=$this->breadcrumb;

		return view('powerpanel.trash.index',compact('iTotalRecords','breadcrumb'));
	}
	/**
	* This method used when table initializes
 * @return  View
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function init() {							
		$records["data"]= array();
		$records["recordsTotal"] = 0;
		echo json_encode($records);
	}
	/**
 * This method loads faqs table data on view 
 * @return  View
 * @since   2016-10-25
 * @author  NetQuick
 */
	public function get_faq_list()
	{
		$iTotalRecords = Trash::total_deleted_faqs();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_faq($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions = '' ;
						$actions .= '<a class="without_bg_icon restore" data-alias="'.$value->id.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete" data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',
								$value->question,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
	//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads team table data on view 
 * @return  View
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function get_team_list()
	{
		$iTotalRecords = Trash::total_deleted_team();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_team($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions = '';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads banner table data on view 
 * @return  View
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function get_banner_list()
	{
		$iTotalRecords = Trash::total_deleted_banner();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_banner($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
			foreach ($arrResults as $key => $value) {
				$actions = '';
				$actions .= '<a class="without_bg_icon restore"   data-alias="'.$value->id.'"><i class="fa fa-undo"></i></a>';
				if(Auth::user()->can('trash-delete')) {
					$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
				}
				$records["data"][] = array(								
					'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',
					$value->title,								
					$actions
				);
			}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads CMS pages table data on view 
 * @return  View
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function get_cmsPage_list()
	{		
		$iTotalRecords = Trash::total_deleted_cmsPage();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_cmsPage($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
					$actions = '';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->var_title,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads users table data on view 
 * @return  View
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function get_user_list()
	{
		$iTotalRecords = Trash::total_deleted_user();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_user($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions ='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->id.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

		/**
 * This method loads CMS pages table data on view 
 * @return  View
 * @since   2016-12-10
 * @author  NetQuick
 */
	public function get_services_list()
	{		
		$iTotalRecords = Trash::total_deleted_services();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_services();
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions = '';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
								
							
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

/**
 * This method loads banner table data on view 
 * @return  View
 * @since   2017-01-04
 * @author  NetQuick
 */
	public function get_testimonial_list()
	{
		$iTotalRecords = Trash::total_deleted_testimonial();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_testimonial($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions = '';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->id.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->testimonialby,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

/**
 * This method loads contact table data on view 
 * @return  View
 * @since   2017-01-04
 * @author  NetQuick
 */
	public function get_contact_list()
	{
		$iTotalRecords = Trash::total_deleted_contacts();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_contactinfo($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->id.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
							'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
							$value->name,								
							$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

/**
 * This method loads role table data on view 
 * @return  View
 * @since   2017-01-04
 * @author  NetQuick
 */
	public function get_role_list()
	{
		$iTotalRecords = Trash::total_deleted_roles();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_roles($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions = '';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->id.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads menu table data on view 
 * @return  View
 * @since   2017-01-04
 * @author  NetQuick
 */
	public function get_menu_list()
	{
		$iTotalRecords = Trash::total_deleted_menu();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_menu($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->id.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads static block table data on view 
 * @return  View
 * @since   2017-01-04
 * @author  NetQuick
 */
	public function get_statick_block_list()
	{		
		$iTotalRecords = Trash::total_deleted_statick_blocks();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		
		$arrResults = Trash::list_statick_blocks();

		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}	
						$records["data"][] = array(								
							'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
							$value->title,								
							$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads sponsors table data on view 
 * @return  View
 * @since   2017-01-04
 * @author  NetQuick
 */
	public function get_sponsors_list()
	{
		$iTotalRecords = Trash::total_deleted_sponsors();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_sponsors($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->id.'"><i class="fa fa-undo"></i></a>';
						if(Auth::user()->can('trash-delete')) {
							$actions .= '&nbsp;<a class="without_bg_icon delete"   data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

/**
 * This method loads blog table data on view 
 * @return  View
 * @since   2017-01-04
 * @author  NetQuick
 */
	public function get_blog_list()
	{		
		$iTotalRecords = Trash::total_deleted_blogs();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_blogs($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore" data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						/*if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="btn btn-danger delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i> Delete</a>';
						}*/
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads news table data on view 
 * @return  View
 * @since   2017-01-06
 * @author  NetQuick
 */
	public function get_news_list()
	{		
		$iTotalRecords = Trash::total_deleted_news();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_news($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads news table data on view 
 * @return  View
 * @since   2017-01-06
 * @author  NetQuick
 */
	public function get_news_category_list()
	{		
		$iTotalRecords = Trash::total_deleted_news_category();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_news_category($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

/**
 * This method loads blog category table data on view 
 * @return  View
 * @since   2017-03-27
 * @author  NetQuick
 */
	public function get_blog_category_list()
	{		
		$iTotalRecords = Trash::total_deleted_blog_category();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_blog_category($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads service category table data on view 
 * @return  View
 * @since   2017-03-27
 * @author  NetQuick
 */
	public function get_service_category_list()
	{		
		$iTotalRecords = Trash::total_deleted_service_category();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::list_service_category($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads Photo album table data on view 
 * @return  View
 * @since   2017-01-09
 * @author  NetQuick
 */
	public function get_photo_album_list()
	{		
		$iTotalRecords = Trash::total_deleted_photo_album();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}		
		$arrResults = Trash::list_photo_album($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {						
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads Video album table data on view 
 * @return  View
 * @since   2017-03-27
 * @author  NetQuick
 */
	public function get_video_album_list()
	{		
		$iTotalRecords = Trash::total_deleted_video_album();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}		
		$arrResults = Trash::list_video_album($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {						
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

/**
 * This method loads deleted events on view
 * @return  View
 * @since   2017-06-15
 * @author  NetQuick
 */
	public function get_events_list()
	{		
		$iTotalRecords = Trash::total_deleted_events();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}		
		$arrResults = Trash::list_events($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {						
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}		
		$records["customActionStatus"] = "OK";		
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

/**
 * This method loads show category table data on view 
 * @return  View
 * @since   2017-03-27
 * @author  NetQuick
 */
	public function get_show_category_list()
	{		
		$iTotalRecords = Trash::total_deleted_show_category();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::get_show_category_list($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		//if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
				$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
				//$records["customActionMessage"] = "Records are listed successfully!"; // pass custom message(useful for getting status of group actions)
		//}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}


/**
 * This method loads product category table data on view 
 * @return  View
 * @since   2017-03-27
 * @author  NetQuick
 */
	public function get_product_category_list(){		
		$iTotalRecords = Trash::total_deleted_product_category();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}
		$arrResults = Trash::get_product_category_list($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}
		
		$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}


	/**
 * This method loads deleted products on view
 * @return  View
 * @since   2017-06-15
 * @author  NetQuick
 */
	public function get_products_list()
	{		
		$iTotalRecords = Trash::total_deleted_products();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}		
		$arrResults = Trash::list_products($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {						
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}		
		$records["customActionStatus"] = "OK";		
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

/**
 * This method loads deleted shows on view
 * @return  View
 * @since   2017-06-26
 * @author  NetQuick
 */
	public function get_shows_list()
	{		
		$iTotalRecords = Trash::total_deleted_shows();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}		
		$arrResults = Trash::list_shows($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {						
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->title,								
								$actions
						);
				}
		}		
		$records["customActionStatus"] = "OK";		
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
 * This method loads deleted authors on view
 * @return  View
 * @since   2017-06-26
 * @author  NetQuick
 */
	public function get_authors_list()
	{		
		$iTotalRecords = Trash::total_deleted_authors();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}		
		$arrResults = Trash::list_authors($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {						
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->name,								
								$actions
						);
				}
		}		
		$records["customActionStatus"] = "OK";		
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	
	/**
 * This method loads deleted adv_slots on view
 * @return  View
 * @since   2017-06-26
 * @author NetQuick
 */
	public function get_adv_slots_list()
	{		
		$iTotalRecords = Trash::total_deleted_adv_slots();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}		
		$arrResults = Trash::list_adv_slots($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {						
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->slot_name,								
								$actions
						);
				}
		}		
		$records["customActionStatus"] = "OK";		
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}


	/**
 * This method loads deleted adv on view
 * @return  View
 * @since   2017-06-26
 * @author NetQuick
 */
	public function get_adv_list()
	{		
		$iTotalRecords = Trash::total_deleted_adv();
		$iDisplayLength = intval(Input::get('length'));
		$iDisplayLength = $iDisplayLength<0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		/*Start code for sorting*/
		if(!empty(Input::get('order')) && !empty(Input::get('columns'))){
				$orderColumnNo = Input::get('order')[0]['column'];
				$orderByFieldName = Input::get('columns')[$orderColumnNo]['name'];
				$orderTypeAscOrDesc = Input::get('order')[0]['dir'];
		}else{
				$orderByFieldName="";
				$orderTypeAscOrDesc="";
		}
		/*End code for sorting*/
		if(!empty(Input::get('searchValue'))){
				$searchFilter = Input::get('searchValue');
		}else{
				$searchFilter = "";
		}
		$records = array();
		$records["data"] = array();
		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;
		if (!empty(Input::get('customActionName'))) {
				$emailtypeFilter = Input::get('customActionName');
		} else {
				$emailtypeFilter = "";
		}		
		$arrResults = Trash::list_adv($iDisplayStart, $iDisplayLength, $orderByFieldName, $orderTypeAscOrDesc, $searchFilter, $emailtypeFilter);
		if (!empty($arrResults) && is_array($arrResults)) {
				foreach ($arrResults as $key => $value) {						
						$actions='';
						$actions.='<a class="without_bg_icon restore"   data-alias="'.$value->alias.'"><i class="fa fa-undo"></i></a>&nbsp;';
						if(Auth::user()->can('trash-delete')) {
							$actions.='<a class="without_bg_icon delete"   data-alias = "'.$value->alias.'"><i class="fa fa-times"></i></a>';
						}
						$records["data"][] = array(								
								'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id. '">',								
								$value->ad_name,								
								$actions
						);
				}
		}		
		$records["customActionStatus"] = "OK";		
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}


/**
 * This method destroys a record
 * @return  Trash index view
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function destroy(Guard $auth)
	{
		$data = Input::get();
		if( $data['module'] == 'banners' ) { $table='banner'; $moduleName='banners'; }
		if( $data['module'] == 'cmspage' ) { $table='cms_pages'; $moduleName='cms-page'; }
		if( $data['module'] == 'faqs' ) { $table='faq'; $moduleName='faq'; }
		if( $data['module'] == 'team' ) { $table='team'; $moduleName='team'; }
		if( $data['module'] == 'user' ) { $table='users'; $moduleName='users'; }
		if( $data['module'] == 'services' ) { $table='services'; $moduleName='services'; }
		if( $data['module'] == 'testimonial' ) { $table='testimonial'; $moduleName='testimonial'; }
		if( $data['module'] == 'contact-details' ) { $table='contactinfo'; $moduleName='contact-details'; }
		if( $data['module'] == 'roles' ) { $table='roles'; $moduleName='roles'; }
		if( $data['module'] == 'menu' ) { $table='menu'; $moduleName='menu'; }
		if( $data['module'] == 'sponsors' ) { $table='sponser'; $moduleName='sponsors'; }
		if( $data['module'] == 'staticblocks' ) { $table='static_blocks'; $moduleName='staticblocks'; }
		if( $data['module'] == 'blog' ) { $table='blog'; $moduleName='blog'; }
		if( $data['module'] == 'news' ) { $table='news'; $moduleName='news'; }
		if( $data['module'] == 'news-category' ) { $table='news_category'; $moduleName='news-category'; }
		if( $data['module'] == 'blog-category' ) { $table='blog_category'; $moduleName='blog-category'; }
		if( $data['module'] == 'service-category' ) { $table='services_category'; $moduleName='services-category'; }		
		if( $data['module'] == 'photo-album' ) { $table='photo_album'; $moduleName='photo-album'; }
		if( $data['module'] == 'video-album' ) { $table='video_album'; $moduleName='video-album'; }
		if( $data['module'] == 'events' ) { $table='events'; $moduleName='events'; }
		if( $data['module'] == 'show-category' ) { $table='show_category'; $moduleName='show-category'; }
		if( $data['module'] == 'product-category' ) { $table='product_category'; $moduleName='product-category'; }
		if( $data['module'] == 'product' ) { $table='products'; $moduleName='product'; }
		if( $data['module'] == 'shows' ) { $table='shows'; $moduleName='shows'; }
		if( $data['module'] == 'author' ) { $table='authors'; $moduleName='author'; }
		if( $data['module'] == 'adv-slot' ) { $table='adv_slots'; $moduleName='adv-slot'; }
		if( $data['module'] == 'adv' ) { $table='adv'; $moduleName='adv'; }

		$module=Modules::where('var_module_name', $moduleName)->first();
		$ignore = array('users','faq','banner','testimonial','contactinfo','roles','sponser','menu');
		if( in_array($table, $ignore) ){
			$id=$data['alias'];
		}else{
			$id = slug::resolve_alias($data['alias']);	
		}
		Trash::destroySingle($id,$table,$moduleName);		
		/*Code for logs*/
		if(!empty($id)) {
				$log = new Log;
				$log['fk_user_id']=$auth->user()['id'];
				$log['fk_module_id'] = $module->int_code;
				$log['fk_record_id'] = $id;							
				$log['chr_publish']='Y';
				$log['chr_delete']='N';
				$log['action']='permanent-delete';				
				$log['ip_address']= Request::ip();
				$log->save();
		}
		/*End code for logs*/
	}

	/**
 * This method restores a record
 * @return  Trash index view
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function restore(Guard $auth)
	{
		$data = Input::get();
		if( $data['module'] == 'banners' ) { $table='banner'; $moduleName='banners'; }
		if( $data['module'] == 'cmspage' ) { $table='cms_pages'; $moduleName='cms-page'; }
		if( $data['module'] == 'faqs' ) { $table='faq'; $moduleName='faq'; }
		if( $data['module'] == 'team' ) { $table='team'; $moduleName='team'; }
		if( $data['module'] == 'user' ) { $table='users'; $moduleName='users'; }
		if( $data['module'] == 'services' ) { $table='services'; $moduleName='services'; }
		if( $data['module'] == 'testimonial' ) { $table='testimonial'; $moduleName='testimonial'; }
		if( $data['module'] == 'contact-details' ) { $table='contactinfo'; $moduleName='contact-details'; }
		if( $data['module'] == 'roles' ) { $table='roles'; $moduleName='roles'; }
		if( $data['module'] == 'menu' ) { $table='menu'; $moduleName='menu'; }
		if( $data['module'] == 'sponsors' ) { $table='sponser'; $moduleName='sponsors'; }
		if( $data['module'] == 'staticblocks' ) { $table='static_blocks'; $moduleName='staticblocks'; }
		if( $data['module'] == 'blog' ) { $table='blog'; $moduleName='blog'; }
		if( $data['module'] == 'news' ) { $table='news'; $moduleName='news'; }
		if( $data['module'] == 'news-category' ) { $table='news_category'; $moduleName='news-category'; }
		if( $data['module'] == 'blog-category' ) { $table='blog_category'; $moduleName='blog-category'; }
		if( $data['module'] == 'service-category' ) { $table='services_category'; $moduleName='services-category'; }
		if( $data['module'] == 'photo-album' ) { $table='photo_album'; $moduleName='photo-album'; }
		if( $data['module'] == 'video-album' ) { $table='video_album'; $moduleName='video-album'; }
		if( $data['module'] == 'events' ) { $table='events'; $moduleName='events'; }
		if( $data['module'] == 'show-category' ) { $table='show_category'; $moduleName='show-category'; }		
		if( $data['module'] == 'product-category' ) { $table='product_category'; $moduleName='product-category'; }
		if( $data['module'] == 'product' ) { $table='products'; $moduleName='product'; }
		if( $data['module'] == 'shows' ) { $table='shows'; $moduleName='shows'; }
		if( $data['module'] == 'author' ) { $table='authors'; $moduleName='author'; }
		if( $data['module'] == 'adv-slot' ) { $table='adv_slots'; $moduleName='adv-slot'; }
		if( $data['module'] == 'adv' ) { $table='adv'; $moduleName='adv'; }		

		$module=Modules::where('var_module_name', $moduleName)->first();		
		$ignore = array('users','faq','banner','testimonial','contactinfo','roles','sponser','menu');
		if( in_array($table, $ignore) ){
			$id=$data['alias'];
		}else{
			$id = slug::resolve_alias($data['alias']);	
		}
		
		Trash::restoreSingle($id,$table);				
		
		/*Code for logs*/
		if(!empty($id)) {
				$log = new Log;
				$log['fk_user_id']=$auth->user()['id'];
				$log['fk_module_id'] = $module->int_code;
				$log['fk_record_id'] = $id;							
				$log['chr_publish']='Y';
				$log['chr_delete']='N';
				$log['action']='restored';				
				$log['ip_address']= Request::ip();
				$log->save();
		}
		/*End code for logs*/	
	}

	/**
 * This method destroys records in multiples 
 * @return  Team index view
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function destroyAll(Guard $auth)
	{	
		$data = Input::get();		
		if( $data['module'] == 'banners' ) { $table='banner'; $moduleName='banners'; }
		if( $data['module'] == 'cmspage' ) { $table='cms_pages'; $moduleName='cms-page'; }
		if( $data['module'] == 'faqs' ) { $table='faq'; $moduleName='faq'; }
		if( $data['module'] == 'team' ) { $table='team'; $moduleName='team'; }
		if( $data['module'] == 'user' ) { $table='users'; $moduleName='users'; }
		if( $data['module'] == 'services' ) { $table='services'; $moduleName='services'; }
		if( $data['module'] == 'testimonial' ) { $table='testimonial'; $moduleName='testimonial'; }
		if( $data['module'] == 'contact-details' ) { $table='contactinfo'; $moduleName='contact-details'; }
		if( $data['module'] == 'roles' ) { $table='roles'; $moduleName='roles'; }
		if( $data['module'] == 'menu' ) { $table='menu'; $moduleName='menu'; }
		if( $data['module'] == 'sponsors' ) { $table='sponser'; $moduleName='sponsors'; }
		if( $data['module'] == 'staticblocks' ) { $table='static_blocks'; $moduleName='staticblocks'; }
		if( $data['module'] == 'blog' ) { $table='blog'; $moduleName='blog'; }
		if( $data['module'] == 'news' ) { $table='news'; $moduleName='news'; }
		if( $data['module'] == 'news-category' ) { $table='news_category'; $moduleName='news-category'; }
		if( $data['module'] == 'blog-category' ) { $table='blog_category'; $moduleName='blog-category'; }
		if( $data['module'] == 'service-category' ) { $table='services_category'; $moduleName='services-category'; }
		if( $data['module'] == 'photo-album' ) { $table='photo_album'; $moduleName='photo-album'; }
		if( $data['module'] == 'video-album' ) { $table='video_album'; $moduleName='video-album'; }
		if( $data['module'] == 'events' ) { $table='events'; $moduleName='events'; }
		if( $data['module'] == 'show-category' ) { $table='show_category'; $moduleName='show-category'; }		
		if( $data['module'] == 'product-category' ) { $table='product_category'; $moduleName='product-category'; }
		if( $data['module'] == 'product' ) { $table='products'; $moduleName='product'; }
		if( $data['module'] == 'shows' ) { $table='shows'; $moduleName='shows'; }
		if( $data['module'] == 'author' ) { $table='authors'; $moduleName='author'; }
		if( $data['module'] == 'adv-slot' ) { $table='adv_slots'; $moduleName='adv-slot'; }
		if( $data['module'] == 'adv' ) { $table='adv'; $moduleName='adv'; }

		$module=Modules::where('var_module_name', $moduleName)->first();		
		$dataid = Input::get('ids');		
		foreach ($dataid as $key=>$id) {
			Trash::destroySingle($id,$table,$moduleName);			
			/*Code for logs*/
			if(!empty($id)) {
					$log = new Log;
					$log['fk_user_id']=$auth->user()['id'];
					$log['fk_module_id'] = $module->int_code;
					$log['fk_record_id'] = $id;							
					$log['chr_publish']='Y';
					$log['chr_delete']='N';
					$log['action']='permanent-delete';					
					$log['ip_address']= Request::ip();
					$log->save();
			}
			/*End code for logs*/	
		}
	}

	/**
 * This method restores records in multiples 
 * @return  Team index view
 * @since   2016-10-26
 * @author  NetQuick
 */
	public function restoreAll(Guard $auth)
	{		
		$data = Input::get();
		if( $data['module'] == 'banners' ) { $table='banner'; $moduleName='banners'; }
		if( $data['module'] == 'cmspage' ) { $table='cms_pages'; $moduleName='cms-page'; }
		if( $data['module'] == 'faqs' ) { $table='faq'; $moduleName='faq'; }
		if( $data['module'] == 'team' ) { $table='team'; $moduleName='team'; }
		if( $data['module'] == 'user' ) { $table='users'; $moduleName='users'; }
		if( $data['module'] == 'services' ) { $table='services'; $moduleName='services'; }
		if( $data['module'] == 'testimonial' ) { $table='testimonial'; $moduleName='testimonial'; }
		if( $data['module'] == 'contact-details' ) { $table='contactinfo'; $moduleName='contact-details'; }
		if( $data['module'] == 'roles' ) { $table='roles'; $moduleName='roles'; }
		if( $data['module'] == 'menu' ) { $table='menu'; $moduleName='menu'; }
		if( $data['module'] == 'sponsors' ) { $table='sponser'; $moduleName='sponsors'; }
		if( $data['module'] == 'staticblocks' ) { $table='static_blocks'; $moduleName='staticblocks'; }
		if( $data['module'] == 'blog' ) { $table='blog'; $moduleName='blog'; }
		if( $data['module'] == 'news' ) { $table='news'; $moduleName='news'; }
		if( $data['module'] == 'news-category' ) { $table='news_category'; $moduleName='news-category'; }
		if( $data['module'] == 'blog-category' ) { $table='blog_category'; $moduleName='blog-category'; }
		if( $data['module'] == 'service-category' ) { $table='services_category'; $moduleName='services-category'; }
		if( $data['module'] == 'show-category' ) { $table='show_category'; $moduleName='show-category'; }		
		if( $data['module'] == 'product-category' ) { $table='product_category'; $moduleName='product-category'; }
		if( $data['module'] == 'photo-album' ) { $table='photo_album'; $moduleName='photo-album'; }
		if( $data['module'] == 'video-album' ) { $table='video_album'; $moduleName='video-album'; }
		if( $data['module'] == 'events' ) { $table='events'; $moduleName='events'; }
		if( $data['module'] == 'product' ) { $table='products'; $moduleName='product'; }
		if( $data['module'] == 'shows' ) { $table='shows'; $moduleName='shows'; }
		if( $data['module'] == 'author' ) { $table='authors'; $moduleName='author'; }
		if( $data['module'] == 'adv-slot' ) { $table='adv_slots'; $moduleName='adv-slot'; }
		if( $data['module'] == 'adv' ) { $table='adv'; $moduleName='adv'; }		

		$module=Modules::where('var_module_name', $moduleName)->first();
		$dataid = Input::get('ids');
		foreach ($dataid as $key=>$id) {
			Trash::restoreSingle($id,$table);			
			/*Code for logs*/
			if(!empty($id)) {
					$log = new Log;
					$log['fk_user_id']=$auth->user()['id'];
					$log['fk_module_id'] = $module->int_code;
					$log['fk_record_id'] = $id;							
					$log['chr_publish']='Y';
					$log['chr_delete']='N';
					$log['action']='restored';					
					$log['ip_address']= Request::ip();
					$log->save();
			}
			/*End code for logs*/	
		}
	}
}