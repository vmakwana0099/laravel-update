<?php
namespace App\Http\Controllers\Powerpanel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerpanelController;
use Validator;
use App\User;
use App\Role;
use Hash;
use App\Role_user;
use App\RecentUpdates;
use App\Log;
use Auth;
use App\Modules;
use App\CommonModel;
use App\Helpers\MyLibrary;

class UserController extends PowerpanelController{
	public $user;
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}		
	}
	/**
	* Display a listing of the resource.
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request) {
		$iTotalRecords = CommonModel::getRecordCount();
		$data = $iTotalRecords>0 ? User::getRecordListIndex():null;
		$this->breadcrumb['title']=trans('template.userModule.manageUser');
		$breadcrumb=$this->breadcrumb;
		return view('powerpanel.users.list',compact('data','iTotalRecords','breadcrumb'))
		->with('i', ($request->input('page', 1) - 1) * 5);
	}


	/**
	 * This method loads use add/edit view
	 * @param   Alias of record
	 * @return  View
	 * @since   2017-11-03
	 * @author  NetQuick
	 */
		public function edit($id=false) 
		{	
			$roles = Role::getRecordListing('display_name','id');
			if(!is_numeric($id)){				
				$this->breadcrumb['title']=trans('template.userModule.addUser');
				$this->breadcrumb['module']=trans('template.userModule.manageUser');
				$this->breadcrumb['url']='powerpanel/users';
				$this->breadcrumb['inner_title']=trans('template.userModule.addUser');
				$breadcrumb=$this->breadcrumb;
				$data=compact('roles', 'breadcrumb');
			}else{
				$user = User::getRecordById($id);				
				if(count($user)==0){ return redirect()->route('powerpanel.users.add'); }
				$userRole = $user->roles->pluck('id','id')->toArray();
				$this->breadcrumb['title']=trans('template.userModule.editUser')." - ".$user->name;		
				$this->breadcrumb['module']=trans('template.userModule.manageUser');
				$this->breadcrumb['url']='powerpanel/users';
				$this->breadcrumb['inner_title']=trans('template.userModule.editUser')." - ".$user->name;
				$breadcrumb=$this->breadcrumb;
				$data=compact('user','roles','userRole','breadcrumb');
			}			
			return view('powerpanel.users.actions', $data);				
		}

	/**
		 * This method stores blog modifications
		 * @return  View
		 * @since   2017-11-10
		 * @author  NetQuick
		 */
		public function handlePost(Request $request) {
				$data = Input::get();	
				$id = $request->segment(3);
				$actionMessage = trans('template.common.oppsSomethingWrong');
				$rules = [
					'name' => 'required|max:160',
					'email' => 'required|email|max:160|unique:users,email,'.$id,
					'password' => 'same:confirm-password|min:6|max:20|check_passwordrules',
					'roles' => 'required'
				];
				$validator = Validator::make($data, $rules);

				if ($validator->passes()) {
						$userArr = [];
						$userArr['name'] =	trim($data['name']);
						$userArr['email'] =	trim($data['email']);						
						$userArr['chrPublish'] = $data['chrMenuDisplay'];
						
						if(is_numeric($id)){ #Edit post Handler=======
							$user = User::getRecordById($id);							
							$userArr['password'] = (!empty($data['password']))?Hash::make($data['password']):$user->password;
							$whereConditions = ['id' => $user->id];															
							Role_user::deleteUserRole($id);
							$update = CommonModel::updateRecords($whereConditions, $userArr);								

							if(!empty($data['roles'])) {
								foreach ($data['roles'] as $key => $value) {
									$user->attachRole($value);
								}	
							}
							if ($update) {
								if (!empty($id)) {
										
										$logArr = MyLibrary::logData($user['id']);
										if (Auth::user()->can('log-advanced')) {
											$newUserObj = User::getRecordById($id);
											$oldRec = $this->recordHistory($user);
											$newRec = $this->recordHistory($newUserObj);
											$logArr['old_val'] = $oldRec;
											$logArr['new_val'] = $newRec;
										}
										$logArr['varTitle'] = trim($data['name']);
										if(!empty($logArr)){
											Log::recordLog($logArr);
										}
										if (Auth::user()->can('recent-updates-list')) {
											if(!isset($newUserObj)){
												$newUserObj = User::getRecordById($id);
											}
											$notificationArr = MyLibrary::notificationData($user->id, $newUserObj);
											if(!empty($notificationArr)){
												RecentUpdates::setNotification($notificationArr);
											}
										}										
								}
								$actionMessage = trans('template.userModule.updateMessage');
							}
						}else{ #Add post Handler=======
							$userArr['password'] = Hash::make($data['password']);
							$id = CommonModel::addRecord($userArr);
							$user = User::getRecordById($id);							
							if(!empty($data['roles'])){
								foreach ($data['roles'] as $key => $value) {
									$user->attachRole($value);
								}	
							}
							if(isset($id)) {
								$newUserObj = User::getRecordById($id);
								$logArr = MyLibrary::logData($id);
								$logArr['varTitle'] = $newUserObj->name;
								if(!empty($logArr)){
									Log::recordLog($logArr);
								}
								if (Auth::user()->can('recent-updates-list')) {
									$notificationArr = MyLibrary::notificationData($id, $newUserObj);
									if(!empty($notificationArr)){
										RecentUpdates::setNotification($notificationArr);
									}
								}
								$actionMessage = trans('template.userModule.addMessage');
							}
						}
						
						if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {				
								return redirect()->route('powerpanel.users.index')->with('message', $actionMessage);
						} else {							
								return redirect()->route('powerpanel.users.edit', $id)->with('message', $actionMessage);
						}
				} else {
						return Redirect::back()->withErrors($validator)->withInput();
				}
		}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id) 
	{
		$user = User::getRecordById($id);
		$this->breadcrumb['title']=trans('template.common.shows')." - ".$user->name;
		$this->breadcrumb['module']=trans('template.userModule.manageUser');
		$this->breadcrumb['url']='powerpanel/users';
		$this->breadcrumb['inner_title']=trans('template.common.shows')." - ".$user->name;
		$breadcrumb=$this->breadcrumb;
		return view('powerpanel.users.show',compact('user','breadcrumb'));
	}

	/**
	* This method destroys Log in multiples
	* @return  Log index view
	* @since   2016-10-25
	* @author  NetQuick
	*/
	public function DeleteRecord() {
		$data = Input::get('ids');
		$update = User::deleteRecordsPermanent($data);
		exit;
	}

	public function publish(Request $request)
	{
		$alias = (int) Input::get('alias');
		$update = MyLibrary::setPublishUnpublish($alias, $request);
		echo json_encode($update);
		exit;
	}

	public function get_list() 
	{
		$filterArr = [];
		$records = [];
		$records["data"] = [];
		$filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
		$filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
		$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
		$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));
		$sEcho = intval(Input::get('draw'));
		
		
		$Users = User::getRecordList($filterArr);	
		$iTotalRecords = CommonModel::getRecordCount($filterArr,true);

		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;	

		if (!empty($Users)){			
			foreach ($Users as $key => $user) {
				$authentic = false;
				$userRole=$user->roleUser->roles[0]->name;
				if(Auth::user()->hasRole('netquick_admin') && $userRole!='netquick_admin'){
					$authentic=true;
					$currentRole='netquick_admin';					
				}elseif(Auth::user()->hasRole('netclues_admin') && $userRole!='netquick_admin' && $userRole!='netclues_admin'){
					$authentic=true;
					$currentRole='netclues_admin';					
				}elseif(Auth::user()->hasRole('client_roles') && $userRole!='netquick_admin' && $userRole!='netclues_admin' && $userRole!='client_roles'){
					$authentic=true;
					$currentRole='client_roles';					
				}
				if(Auth::user()->hasRole('netquick_admin')){
					$authentic=true;
					$currentRole='netquick_admin';
				}
				if($authentic==true){
					$records["data"][] = $this->tableData($user, $currentRole);
				}			
			}
		}

		if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
			$records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
		}

		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
		exit;

	}

	public function tableData($user = false, $currentRole=false) 
	{
			$publish_action='';			
			$roles = '<label class="label label-success">'.$user->roleUser->roles[0]->display_name.'</label>';		
			
			$actions = '';
			if(Auth::user()->can('users-edit') || $currentRole == 'netquick_admin') {		
				$actions .= '&nbsp;
				<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="'.route('powerpanel.users.edit',$user->id).'"><i class="fa fa-pencil"></i></a>';
			}

			if(Auth::user()->can('users-delete') || $currentRole == 'netquick_admin') {
				$actions .= '&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="users" data-alias = "'.$user->id.'"><i class="fa fa-times"></i></a>';
			}

			if(Auth::user()->can('users-publish') || $currentRole == 'netquick_admin') 
			{
				if($user->chrPublish == 'Y') {
					$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/users" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $user->id . '">';
				}else{
					$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/users" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $user->id . '">';
				}	
			}		
			
			if(Auth::user()->can('users-edit') || $currentRole == 'netquick_admin') {
				$title = '<a class="" title="'.trans("template.common.edit").'" href="'.route('powerpanel.users.edit',$user->id).'">'.$user->name.'</a>';
			}else {
				$title = $user->name;
			}

			$records = array(
				'<input type="checkbox" name="delete" class="chkDelete" value="' . $user->id. '">',
				$title,	
				$user->email,
				'<a href="javascript:;" class="reset-link" data-email="'.$user->email.'">Send Reset link</a>',
				$roles,
				$publish_action,
				$actions
			);

			return $records;
	}

	public function recordHistory($data=false) 
	{	
			$userRole = $data->roles->pluck('id','id')->toArray();
			$roles = '';
			if(!empty($userRole)) {
				foreach($userRole as $v) {
					$roleDetail = Role::getRecordById($v);
					$roleName = (isset($roleDetail->display_name) && $roleDetail->display_name!="")?$roleDetail->display_name:'-'; 
					$roles .= ' <label class="label label-success">'.$roleName.'</label>';
				}
			}
			$oldRec='';
			$oldRec.='<table class="new_table_desing table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>'.trans("template.common.name").'</th>
							<th>'.trans("template.common.email").'</th>
							<th>'.trans("template.common.roles").'</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>'.$data->name.'</td>
							<td>'.$data->email.'</td>
							<td>'.$roles.'</td>
						</tr>
					</tbody>
			</table>';
			return $oldRec;
	}

}