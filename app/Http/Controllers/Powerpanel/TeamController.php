<?php
/**
* The TeamController class handels dynamic menu configuration
* configuration  process.
* @package   Netquick powerpanel
* @license   http://www.opensource.org/licenses/BSD-3-Clause
* @version   1.1
* @since     2017-07-07
* @author    NetQuick
*/
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\Team;
use App\Alias;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Log;
use App\RecentUpdates;   
use App\CommonModel;
use App\Helpers\MyLibrary;
use Auth;
use App\Helpers\AddImageModelRel;
use App\Helpers\resize_image;
use Cache;
use Config;

class TeamController extends PowerpanelController {
	
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
 /**
 * This method handels loading process of teams
 * @return  View
 * @since   2017-07-20
 * @author  NetQuick
 */
	public function index() {
		$iTotalRecords = CommonModel::getRecordCount(); 
		$this->breadcrumb['title']=trans('template.teamModule.manageTeam');
		$breadcrumb = $this->breadcrumb;
		return view('powerpanel.team.index',compact('iTotalRecords','breadcrumb'));
	}

/**
 * This method loads team edit view
 * @param  	Alias of record
 * @return  View
 * @since   2017-07-21
 * @author  NetQuick
 */
	public function edit($alias=false)
	{
		$imageManager	 = true;
		$availableSocialLinks = Config::get('Constant.AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMBER');
		
		$teamSocialLinksOptions = array();
		if(!empty($availableSocialLinks)){
				$socialLinks = unserialize($availableSocialLinks);;
				$i = 0;
				foreach($socialLinks as $links)
				{
						$teamSocialLinksOptions[$i]['key'] = $links['key'];
						$teamSocialLinksOptions[$i]['label'] = $links['title'];
						$teamSocialLinksOptions[$i]['placeholder'] = $links['placeholder'];			
						$i++;
				}
		}
		
		if(!is_numeric($alias)){
				$total = CommonModel::getRecordCount();
				$total = $total + 1;	
				$this->breadcrumb['title']=trans('template.teamModule.addTeamMember');
				$this->breadcrumb['module']=trans('template.teamModule.manageTeam');
				$this->breadcrumb['url']='powerpanel/team';
				$this->breadcrumb['inner_title']=trans('template.teamModule.addTeamMember');
				$breadcrumb=$this->breadcrumb;
				$data = compact('total','breadcrumb','imageManager','teamSocialLinksOptions');
		}else{
				$id = $alias;
				$team = Team::getRecordById($id);
				if(count($team)==0){ return redirect()->route('powerpanel.team.add'); }
				$metaInfo = array(
				'varMetaTitle' => $team->varMetaTitle,
				'varMetaKeyword' => $team->varMetaKeyword,
				'varMetaDescription' => $team->varMetaDescription
				);
				$this->breadcrumb['title']=trans('template.teamModule.editTeamMember').' - '.$team->varTitle;		
				$this->breadcrumb['module']=trans('template.teamModule.manageTeam');
				$this->breadcrumb['url']='powerpanel/team';
				$this->breadcrumb['inner_title']=trans('template.teamModule.editTeamMember').' - '.$team->varTitle;
				$breadcrumb=$this->breadcrumb;
				$data = compact('team','alias','metaInfo','breadcrumb','imageManager','teamSocialLinksOptions');
		}
		return view('powerpanel.team.actions',$data);
	}

	/**
 * This method stores team modifications
 * @return  View
 * @since   2017-07-21
 * @author  NetQuick
 */
	public function handlePost(Request $request) {
		$data = Input::get();

		$availableSocialLinks = Config::get('Constant.AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMBER');
		$teamSocialLinksOptions = array();
		if(!empty($availableSocialLinks)){
				$socialLinks = unserialize($availableSocialLinks);;
				$i = 0;
				foreach($socialLinks as $links)
				{
						$teamSocialLinksOptions[$i]['key'] = $links['key'];
						$teamSocialLinksOptions[$i]['label'] = $links['title'];
						$teamSocialLinksOptions[$i]['placeholder'] = $links['placeholder'];			
						$i++;
				}
		}

		$messsages = array(
								'display_order.greater_than_zero' => trans('template.teamModule.displayGreaterThan'),
								"tag_line.required" => trans('template.teamModule.designationMessage')
								);
		$rules = array(
			'name' => 'required|max:160',
			'tag_line' => 'required|max:160',
			'email' => 'required|email|max:100',
			'phone_no' => 'required|min:10',
			'display_order' => 'required|greater_than_zero',
			'varMetaTitle' => 'required|max:500',
			'varMetaKeyword' => 'required|max:500',
			'varMetaDescription' =>  'required|max:500',
			'chrMenuDisplay' => 'required',
			'alias'=>'required'
		);
		$socialLink = array();
		if(isset($teamSocialLinksOptions) && !empty($teamSocialLinksOptions)){
				foreach($teamSocialLinksOptions as $value)
				{
					if(isset($data[$value['key']]) && $data[$value['key']] !=""){
						$socialLink[$value['key']] = $data[$value['key']];
						$rules[$value['key']] = 'url';
						$messsages[$value['key'].'.url'] = 'Enter valid url';
					}
				}		
		}
		$socialLink = serialize($socialLink);
		$validator = Validator::make($data, $rules, $messsages);
		if($validator->passes())
		{
			$id = $request->segment(3);
			$actionMessage = trans('template.common.oppsSomethingWrong');
			if(is_numeric($id)){ #Edit post Handler=======
				if($data['oldAlias'] != $data['alias']){
					Alias::updateAlias($data['oldAlias'], $data['alias']);	
				}
				$team = Team::getRecordForLogById($id);
				

				$updateTeamFields =  [				
					'varTitle' => trim($data['name']),
					'varTagLine' => trim($data['tag_line']),
					'fkIntImgId'=>!empty($data['img_id'])?$data['img_id']:null,				
					'txtDescription' => $data['description'],
					'varEmail' => trim($data['email']),
					'varPhoneNo' => trim($data['phone_no']),
					'textAddress' => trim($data['address']),
					'txtSocialLinks' => $socialLink,
					'varMetaTitle' => trim($data['varMetaTitle']),
					'varMetaKeyword' => trim($data['varMetaKeyword']),
					'varMetaDescription' => trim($data['varMetaDescription']),
					'chrPublish' => $data['chrMenuDisplay']
				];
				$whereConditions = ['id' => $team->id];
				$update = CommonModel::updateRecords($whereConditions, $updateTeamFields);

				if ($update) 
				{
						if (!empty($id)) 
						{
								self::swap_order_edit($data['display_order'], $team->id);

								$logArr = MyLibrary::logData($team->id);
								if (Auth::user()->can('log-advanced')) {
										$newTeamObj = Team::getRecordForLogById($team->id);
										$oldRec = $this->recordHistory($team);
										$newRec = $this->recordHistory($newTeamObj);
										$logArr['old_val'] = $oldRec;
										$logArr['new_val'] = $newRec;
								}

								$logArr['varTitle'] = trim($data['name']);
								Log::recordLog($logArr);

								if (Auth::user()->can('recent-updates-list')) {
									if(!isset($newTeamObj)){
										$newTeamObj = Team::getRecordForLogById($team->id);
									}
									$notificationArr = MyLibrary::notificationData($team->id, $newTeamObj);
									RecentUpdates::setNotification($notificationArr);
								}
								self::flushCache();				
								$actionMessage = trans('template.teamModule.updateMessage');
						}
				}
			}else{ #Add post Handler=======
				
					$teamArr = [];
					$teamArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
					$teamArr['varTitle'] = trim($data['name']);
					$teamArr['varTagLine'] = trim($data['tag_line']);
					$teamArr['fkIntImgId'] = !empty($data['img_id'])?$data['img_id']:null;
					$teamArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
					$teamArr['txtDescription'] = trim($data['description']);
					$teamArr['varEmail'] = trim($data['email']);
					$teamArr['varPhoneNo'] = trim($data['phone_no']);
					$teamArr['textAddress'] = trim($data['address']);
					$teamArr['txtSocialLinks'] =  $socialLink;
					$teamArr['chrPublish'] =  $data['chrMenuDisplay'];
					$teamArr['varMetaTitle'] =  trim($data['varMetaTitle']);
					$teamArr['varMetaKeyword'] =  trim($data['varMetaKeyword']);
					$teamArr['varMetaDescription'] =  trim($data['varMetaDescription']);
					$teamArr['created_at'] =  Carbon::now();

					$teamID = CommonModel::addRecord($teamArr);	

						if (!empty($teamID)) 
						{
								$id = $teamID;
								$newTeamObj = Team::getRecordForLogById($id);
								$logArr = MyLibrary::logData($id);
								$logArr['varTitle'] = $newTeamObj->varTitle;
								Log::recordLog($logArr);
								if (Auth::user()->can('recent-updates-list')) {
									$notificationArr = MyLibrary::notificationData($id, $newTeamObj);
									RecentUpdates::setNotification($notificationArr);
								}
								self::flushCache();								
								$actionMessage = trans('template.teamModule.addMessage');
							}
			}		
			AddImageModelRel::sync(explode(',', $data['img_id']), $id);
			if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
					return redirect()->route('powerpanel.team.index')->with('message', $actionMessage);
			} else {
					return redirect()->route('powerpanel.team.edit', $id)->with('message', $actionMessage);
			}

		}else {
			return Redirect::back()->withErrors($validator)->withInput();
		}

	}
	/**
 * This method loads team table data on view
 * @return  View
 * @since   2017-07-20
 * @author  NetQuick
 */
		public function get_list() {
				 $filterArr = [];
				 $records = [];
				 $records["data"] = [];
				 $filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
				 $filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
				 $filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
				 $filterArr['statusFilter'] = !empty(Input::get('customActionName')) ? Input::get('customActionName') : '';
				 $filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
				
				 $filterArr['iDisplayLength'] = intval(Input::get('length'));
				 $filterArr['iDisplayStart'] = intval(Input::get('start'));
				 $sEcho = intval(Input::get('draw'));
				 $arrResults = Team::getRecordList($filterArr);
				 $iTotalRecords = CommonModel::getRecordCount($filterArr,true);
				 $end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
				 $end = $end > $iTotalRecords ? $iTotalRecords : $end;
				 if (!empty($arrResults)) {
						foreach ($arrResults as $key => $value) {
								$records["data"][] = $this->tableData($value);
						}
				}
				$records["customActionStatus"] = "OK";
				$records["draw"] = $sEcho;
				$records["recordsTotal"] = $iTotalRecords;
				$records["recordsFiltered"] = $iTotalRecords;

				return json_encode($records);
		}

	public function publish(Request $request) {
				$alias = Input::get('alias');
				$update = MyLibrary::setPublishUnpublish($alias, $request);
				self::flushCache();
				echo json_encode($update);
				exit;
		}
/**
  * This method reorders banner position
	* @return  Banner index view data
	* @since   2016-10-26
	* @author  NetQuick
	*/
	public function reorder() {
		$order=Input::get('order');
		$exOrder=Input::get('exOrder');
		MyLibrary::swapOrder($order, $exOrder);
		self::flushCache();
	}
		/**
		 * This method delete multiples Team
		 * @return  true/false
		 * @since   2017-07-22
		 * @author  NetQuick
		 */
	public function DeleteRecord(Request $request) {
			$data = $request->all('ids');
			$update = MyLibrary::deleteMultipleRecords($data);
			self::flushCache();
			echo json_encode($update);
			exit;
	}
	
	/**
	 * This method handels swapping of available order record while adding
	 * @param  	order
	 * @return  order
	 * @since   2017-07-22
	 * @author  NetQuick
	 */
	public static function swap_order_add($order = null) {
			$response = false;
			if ($order != null) {
					$response = MyLibrary::swapOrderAdd($order);
					self::flushCache();
			}
			return $response;
		}

	/**
	 * This method handels swapping of available order record while editing
	 * @param  	order
	 * @return  order
	 * @since   2017-07-22
	 * @author  NetQuick
	 */
	public static function swap_order_edit($order=null,$id=null){	
		MyLibrary::swapOrderEdit($order, $id);
		self::flushCache();		
	}

	/**
  * This method handels logs History records
  * @param   $data
  * @return  HTML
  * @since   2017-07-27
  * @author  NetQuick
  */
		public function recordHistory($data = false) 
		{
			$returnHtml='';
						$returnHtml.='<table class="new_table_desing table table-striped table-bordered table-hover">
									<thead>
										<tr>
												<th>'.trans("template.common.title").'</th>
												<th>'.trans("template.teamModule.tagline").'</th>
												<th>'.trans("template.common.order").'</th>
												<th>'.trans("template.common.description").'</th>
												<th>'.trans("template.common.image").'</th>
												<th>'.trans("template.common.email").'</th>
												<th>'.trans("template.teamModule.phone").'</th>
												<th>'.trans("template.common.address").'</th>
												<th>'.trans("template.teamModule.facebook").'</th>
												<th>'.trans("template.teamModule.twitter").'</th>
												<th>'.trans("template.teamModule.linkedin").'</th>
												<th>'.trans("template.teamModule.googleplus").'</th>
												<th>'.trans("template.common.metatitle").'/th>
												<th>'.trans("template.common.metakeyword").'</th>
												<th>'.trans("template.common.metadescription").'</th>
												<th>'.trans("template.common.publish").'</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>'.$data->varTitle.'</td>
											<td>'.$data->varTagLine.'</td>
											<td>'.($data->intDisplayOrder).'</td>
											<td>'.$data->txtDescription.'</td>';										
											if($data->fkIntImgId > 0){
																$returnHtml.= '<td>'.'<img height="50" width="50" src="'.resize_image::resize($data->fkIntImgId).'" />'.'</td>';
														}else{
																$returnHtml.= '<td>-</td>';
														}
											$returnHtml.= '<td>'.$data->varEmail.'</td>
											<td>'.$data->varPhoneNo.'</td>
											<td>'.$data->textAddress.'</td>
											<td>'.$data->varFacebook.'</td>
											<td>'.$data->varTwitter.'</td>
											<td>'.$data->varLinkedin.'</td>
											<td>'.$data->varGooglePlus.'</td>
											<td>'.$data->varMetaTitle.'</td>
											<td>'.$data->varMetaKeyword.'</td>
											<td>'.$data->varMetaDescription.'</td>
											<td>'.$data->chrPublish.'</td>
										</tr>
									</tbody>
								</table>';
			return $returnHtml;

		}

	public function tableData($value = false) 
		{
				$publish_action='';
				$details = '';
				if(Auth::user()->can('team-edit'))
				{
						$details.='<a class="without_bg_icon" title="'.trans("template.common.edit").'"  href="'.route('powerpanel.team.edit',array('alias' => $value->id)) .'">
					<i class="fa fa-pencil"></i></a>';
				}    
				if(Auth::user()->can('team-delete'))
				{
						$details.= '&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="team" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
				}   
				
				if(Auth::user()->can('team-publish'))
				{	
					if ($value->chrPublish == 'Y') {
						$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/team" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
					} else {
							$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/team" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
					}
				}
				
				$image = '<div class="text-center">';
					if(!empty($value->fkIntImgId)){
						$image .= '<a href="'.resize_image::resize($value->fkIntImgId).'" class="fancybox-buttons" data-rel="fancybox-buttons">';
						$image .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) .'" src="'.resize_image::resize($value->fkIntImgId,50,50).'"/>';
						$image .= '</a>';
					}else{
						$image .= '<span class="glyphicon glyphicon-minus"></span>';
					}
				$image .= '</div>';


				$records = array(				
				'<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">', 				
				'<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="' . route('powerpanel.team.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>', 
				'<div class="pro-act-btn">
				<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.description").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
				<div class="highslide-maincontent">' . $value->txtDescription . '</div>
				</div>',				
				$value->varTagLine,
				$image,
				'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				'.$value->intDisplayOrder.
				' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
				$publish_action,
				$details,
				$value->intDisplayOrder,
				);
				return $records;
		}
		
		public static function flushCache(){
			Cache::tags('Team')->flush();
		}
}