<?php
/**
* The MenuController class handels dynamic menu configuration
* configuration  process.
* @package Netquick powerpanel
* @license http://www.opensource.org/licenses/BSD-3-Clause
* @version 1.00
* @since 2016-12-05
* @author NetQuick
*/
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\StaticBlocks;
use App\Alias;

use App\Modules;
use App\RecentUpdates;
use App\Log;
use App\CommonModel;
use App\Helpers\MyLibrary;
use Carbon\Carbon;
use Config;
use Cache;


class StaticBlocksController extends PowerpanelController {
	
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
  /**
  * This method handels loading process of StaticBlocks
  * @return  View
  * @since   2017-08-03
  * @author  NetQuick
  */
	public function index(Request $request) {
		$iTotalRecords = CommonModel::getRecordCount(); 
		$this->breadcrumb['title']=trans('template.staticblockModule.manage');
		return view('powerpanel.static_blocks.list',['iTotalRecords'=>$iTotalRecords,'breadcrumb'=>$this->breadcrumb]);
	}
	/**
	* This method loads StaticBlocks table data on view
	* @return  View
	* @since   2016-12-05
	* @author  NetQuick
	*/
	public function get_list() {
		
		$filterArr = [];
		$records = [];
		$records["data"] = [];
		$filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
		$filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
		$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
		$filterArr['statusFilter'] = !empty(Input::get('statusValue')) ? Input::get('statusValue') : '';
		$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));
		
		$sEcho = intval(Input::get('draw'));
		$arrResults = StaticBlocks::getRecordList($filterArr);
		$iTotalRecords = CommonModel::getRecordCount($filterArr,true);

		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		if (!empty($arrResults)) 
		{
			foreach ($arrResults as $staticBlocks) 
			{
				$records["data"][] = $this->tableData($staticBlocks);
			}
		}

		if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
			$records["customActionStatus"] = "OK";
		}
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
	}

	/**
	* This method loads StaticBlocks edit view
	* @param  	Alias of record
	* @return  View
	* @since   2016-12-05
	* @author  NetQuick
	*/
	public function edit($alias=false)  
	{
		if(!is_numeric($alias)){
				$total= CommonModel::getRecordCount();
				$total = $total + 1;
				$this->breadcrumb['title']=trans('template.staticblockModule.add');
				$this->breadcrumb['module']=trans('template.staticblockModule.manage');
				$this->breadcrumb['url']='powerpanel/static-block';
				$this->breadcrumb['inner_title']=trans('template.staticblockModule.add');
				$data = ['total'=>$total,'breadcrumb'=>$this->breadcrumb];
		}else{
				$id = $alias;
				$staticBlocks = StaticBlocks::getRecordById($id);
				if(count($staticBlocks)==0){ return redirect()->route('powerpanel.static-block.add'); }
				$this->breadcrumb['title']=trans('template.common.edit').' - '.$staticBlocks->varTitle;		
				$this->breadcrumb['module']=trans('template.staticblockModule.manage');
				$this->breadcrumb['url']='powerpanel/static-block';
				$this->breadcrumb['inner_title']=trans('template.common.edit').' - '.$staticBlocks->varTitle;
				$data = ['staticBlocks'=>$staticBlocks,'breadcrumb'=>$this->breadcrumb];
		}
		return view('powerpanel.static_blocks.actions', $data);
	}

	/**
	* This method stores StaticBlocks modifications
	* @return  View
	* @since   2016-12-05
	* @author  NetQuick
	*/
	public function handlePost(Request $request) 
	{
		$data = Input::get();
		$rules = $this->serverSideValidationRules();
		$validator = Validator::make($data, $rules);

		if($validator->passes())
		{
			$id = $request->segment(3);
			$actionMessage = trans('template.common.oppsSomethingWrong');
			Alias::updateAlias($data['oldAlias'], $data['alias']);

			if(is_numeric($id)){ #Edit post Handler=======
					$staticBlocksObj = StaticBlocks::getRecordForLogById($id);
					$updateStaticBlocksFields = [];
					$updateStaticBlocksFields = [
																				'varTitle' => trim($data['title']),
																				'txtDescription' => $data['description'],
																				'chrPublish'  =>  $data['chrMenuDisplay']
																			];

					$whereConditions = ['id' => $staticBlocksObj->id];
					$update = CommonModel::updateRecords($whereConditions, $updateStaticBlocksFields);
					if($update)
					{
						if($id>0) 
						{
							$logArr = MyLibrary::logData($staticBlocksObj->id);
							if (Auth::user()->can('log-advanced')) {
								$newStaticBlocksObj = StaticBlocks::getRecordForLogById($staticBlocksObj->id);
								$oldRec = $this->recordHistory($staticBlocksObj);
								$newRec = $this->recordHistory($newStaticBlocksObj);
								$logArr['old_val'] = $oldRec;
								$logArr['new_val'] = $newRec;
							}
							$logArr['varTitle'] = trim($data['title']);
							Log::recordLog($logArr);
							if (Auth::user()->can('recent-updates-list')) {
								if(!isset($newStaticBlocksObj)){
									$newStaticBlocksObj = StaticBlocks::getRecordForLogById($staticBlocksObj->id);
								}
								$notificationArr = MyLibrary::notificationData($staticBlocksObj->id, $newStaticBlocksObj);
								RecentUpdates::setNotification($notificationArr);
							}
							self::flushCache();
							$actionMessage = trans('template.staticblockModule.staticUpdated');
						}
					}
			}else{ #Add post Handler=======

					$staticBlocksArr = [];
					$staticBlocksArr['varTitle'] = trim($data['title']);
					$staticBlocksArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
					$staticBlocksArr['txtDescription'] = $data['description']; 
					$staticBlocksArr['chrPublish']  = $data['chrMenuDisplay'];
					$staticBlocksArr['created_at']  = Carbon::now();

					$staticBlockID = CommonModel::addRecord($staticBlocksArr);						

					if(!empty($staticBlockID) && $staticBlockID > 0)
					{
						$id = $staticBlockID;
						$newstaticBlockObj = StaticBlocks::getRecordForLogById($id);
						
						$logArr = MyLibrary::logData($id);
						$logArr['varTitle'] = $newstaticBlockObj->varTitle;
						Log::recordLog($logArr);
						if (Auth::user()->can('recent-updates-list')) {
							$notificationArr = MyLibrary::notificationData($id, $newstaticBlockObj);
							RecentUpdates::setNotification($notificationArr);
						}
						self::flushCache();
						$actionMessage = trans('template.staticblockModule.staticAdded');
					}
			}

			if(!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit'){
				return redirect()->route('powerpanel.static-block.index')->with('message', $actionMessage);
			}else{
				return redirect()->route('powerpanel.static-block.edit',$id)->with('message', $actionMessage);
			}
			
		} else {
			return Redirect::back()->withErrors($validator)->withInput();
		}
	}
	/**
	* This method loads StaticBlocks table data on view
	* @return  View
	* @since   2017-08-03
	* @author  NetQuick
	*/	
	public function publish(Request $request)
	{
		$alias = Input::get('alias');
		$update = MyLibrary::setPublishUnpublish($alias, $request);
		self::flushCache();
		echo json_encode($update);
		exit;
	}

	/**
	* This method destroy single StaticBlocks
	* @return  StaticBlocks index view
	* @since   2016-12-05
	* @author  NetQuick
	*/
	public function destroy() 
	{
		$data = Input::get();
		$update = MyLibrary::deleteRecord($data);
		self::flushCache();
		echo json_encode($update);
		exit;
	}

	/**
	* This method destroys multiples StaticBlocks 
	* @return  StaticBlocks index view
	* @since   2016-10-25
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
	* This method handle table data
	* @return  array
	* @since   2016-10-25
	* @author  NetQuick
	*/
	public function tableData($staticBlocks)
	{
				$actions = '';
				$details = '';
				$publish_action = '';
				if(Auth::user()->can('static-block-edit')) {
					$actions .= '<a class="without_bg_icon" title="Edit" href="'.route('powerpanel.static-block.edit',array('alias'=> $staticBlocks->id)) .'">
					<i class="fa fa-pencil"></i></a>';
				}
				if(Auth::user()->can('static-block-delete')) {
					$actions .= '&nbsp;<a class="without_bg_icon delete" title="Delete" data-controller="static-block" data-alias = "'.$staticBlocks->id.'"><i class="fa fa-times"></i></a>';
				}
				if(Auth::user()->can('static-block-publish')) {
					if($staticBlocks->chrPublish == 'Y') {
						$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/static-block" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $staticBlocks->id . '">';
						
					}else{
						$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/static-block" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $staticBlocks->id . '">';
					}
				}
				$minus='<span class="glyphicon glyphicon-minus"></span>';
				if(strlen($staticBlocks->txtDescription)>0){
					$details .=	'<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\''.trans("template.common.description").'\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
					$details .=	'<div class="highslide-maincontent">'.html_entity_decode($staticBlocks->txtDescription).'</div>';
				}else{
					$details .=	$minus;
				}

				if(Auth::user()->can('static-block-edit')) {
					$title = '<a title="Edit" href="'.route('powerpanel.static-block.edit',array('alias'=>$staticBlocks->id)) .'">'.$staticBlocks->varTitle.'</a>';
				}	else {
					$title = $staticBlocks->varTitle;
				}
				$records = array(
					'<input type="checkbox" name="delete" class="chkDelete" value="'.$staticBlocks->id.'">',
					$title,
					$details,
					date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'', strtotime($staticBlocks->created_at)),
					$publish_action,
					$actions
				);
			return $records;
	}


	/**
	* This method handle serveside validation rules
	* @return  array
	* @since   2016-10-25
	* @author  NetQuick
	*/
	public function serverSideValidationRules()
	{
			
			$rules = array(
				'title' => 'required|max:160',
				/*'alias'=>'required'*/
			);
			return $rules;
	}

	/**
	* This method handle notification old record
	* @return  array
	* @since   2016-10-25
	* @author  NetQuick
	*/
	public function recordHistory($data=false) 
	{
				$returnHtml='';
				$returnHtml.='<table class="new_table_desing table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>' . trans("template.common.title") . '</th>
							<th>' . trans("template.common.description") . '</th>
							<th>' . trans("template.common.publish") . '</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>'.$data->varTitle.'</td>
							<td>'.$data->txtDescription.'</td>
							<td>'.$data->chrPublish.'</td>				
						</tr>
					</tbody>
				</table>';
			return $returnHtml;
	}
	public function flushCache(){
				//Cache::forget('getFrontRecordsByPage');
	}
}