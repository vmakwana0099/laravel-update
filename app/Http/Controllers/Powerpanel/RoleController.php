<?php
namespace App\Http\Controllers\Powerpanel;
use App\Http\Controllers\PowerpanelController;
use DB;
use Auth;
use Input;
use Cache;
use Validator;
use App\Role;
use App\Permission;
use App\Permission_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Log;
use App\CommonModel;
use App\Helpers\MyLibrary;

class RoleController extends PowerpanelController {
	public $user;
	public function __construct() {		
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
		$this->user = \Auth::user();		
	}
	/**
	 * This method handels load process of roles
	 * @return  View
	 * @since   2017-08-16
	 * @author  NetQuick
	 */
	public function index(Request $request) {		
		$iTotalRecords = CommonModel::getRecordCount();
		$roles = $iTotalRecords>0 ? Role::getRecordList():null;
		$this->breadcrumb['title']=trans('template.roleModule.manageRoles');		
		return view('powerpanel.roles.index',['roles'=>$roles,'iTotalRecords'=>$iTotalRecords,'breadcrumb'=>$this->breadcrumb])
		->with('i', ($request->input('page', 1) - 1) * 5);
	}	

	/**
	 * This method loads role edit view
	 * @param   Alias of record
	 * @return  View
	 * @since   2017-10-28
	 * @author  NetQuick
	 */
	public function edit($id=false) 
	{	
		$grouppedPermission	= $this->grouppedPermission();
		if(!is_numeric($id)){
			$this->breadcrumb['title']=trans('template.roleModule.addRole');
			$this->breadcrumb['module']=trans('template.roleModule.manageRoles');
			$this->breadcrumb['url']='powerpanel/roles';
			$this->breadcrumb['inner_title']=trans('template.roleModule.addRole');
			$data=['permission'=>$grouppedPermission,'breadcrumb'=>$this->breadcrumb];
		}else{				
			$role = Role::getRecordById($id);
			if($role==false){ return redirect()->route('powerpanel.roles.add'); }
			$rolePermissions = Permission_role::getPermissionRole($id);			
			$rolePermissions = array_column($rolePermissions, 'permission_role');
			$rolePermissions = array_column($rolePermissions, 'id');

			$this->breadcrumb['title']=trans('template.roleModule.editRole').' - '.$role->display_name;		
			$this->breadcrumb['module']=trans('template.roleModule.manageRoles');
			$this->breadcrumb['url']='powerpanel/roles';
			$this->breadcrumb['inner_title']=trans('template.roleModule.editRole').' - '.$role->display_name;
			$data=['role'=>$role,'permission'=>$grouppedPermission,'rolePermissions'=>$rolePermissions,'breadcrumb'=>$this->breadcrumb];
		}			
		return view('powerpanel.roles.actions', $data);				
	}

	public function grouppedPermission(){
		$permissions = Permission::getPermissions();
		$grouppedPermission = array();
		foreach ($permissions as $data) {		
			if($data['modules']!=null){
				$id = $data['modules']['varTitle'];
				if (isset($grouppedPermission[$id])) {
					$grouppedPermission[$id][] = $data;
				} else {
					$grouppedPermission[$id] = array($data);
				}
			}
		}
		return $grouppedPermission;
	}


	/**
	 * This method stores blog modifications
	 * @return  View
	 * @since   2017-11-10
	 * @author  NetQuick
	 */
	public function handlePost(Request $request) {
			$data = Input::get();	
			$actionMessage = trans('template.common.oppsSomethingWrong');
			$id = $request->segment(3);
			$rules = array(
				'name' => 'required|unique:roles,name',				
				'permission' => 'required'
			);
			
			if(is_numeric($id)){
				unset($rules['name']);
			}

			$validator = Validator::make($data, $rules);
			if ($validator->passes()) 
			{
					if(is_numeric($id)){ #Edit post Handler=======
						$role = Role::find($id);
						$role->display_name = trim($data['name']);
						$role->name =  str_replace(" ","_",strtolower(trim($data['name'])));
						$role->description = trim($data['description']);
						$role->save();
						Permission_role::deletePermissionRole($id);
						foreach ($data['permission'] as $value) {
							$role->attachPermission($value);
						}	
						/*$newRoleObj = Role::getRecordById($id);	
						$oldRec = $this->recordHistory($role);
						$newRec = $this->recordHistory($newRoleObj);
						$logArr = MyLibrary::logData($newRoleObj->id);
						$logArr['old_val'] = $oldRec;
						$logArr['new_val'] = $newRec;
						$logArr['varTitle'] = $newRoleObj->display_name;	
						$logArr['action'] = "edit";	
						Log::recordLog($logArr);*/					
						$actionMessage = trans('template.roleModule.updateMessage');						
					}else{ #Add post Handler=======						
						$role = new Role();						
						$role->display_name = trim($data['name']);
						$role->name =  str_replace(" ","_",strtolower(trim($data['name'])));
						$role->description = trim($data['description']);
						$role->save();
						foreach ($data['permission'] as $value) {
							$role->attachPermission($value);
						}
						if (!empty($role->id)) {
								$id=$role->id;
								$newRoleObj = Role::getRecordForLogById($id);	
								$logArr = MyLibrary::logData($newRoleObj->id);	
								$logArr['varTitle'] = $newRoleObj->display_name;	
								Log::recordLog($logArr);					
								$actionMessage = trans('template.roleModule.addMessage');
						}
					}

					if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
							return redirect()->route('powerpanel.roles.index')->with('message', $actionMessage);
					} else {							
							return redirect()->route('powerpanel.roles.edit', $id)->with('message', $actionMessage);
					}
			} else {
					return Redirect::back()->withErrors($validator)->withInput();
			}
	}

	/**
	* This method loads events table data on view
	* @return  View
	* @since   2017-08-16
	* @author  NetQuick
	*/
	public function get_list() {
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
		$arrResults = Role::getRecordList($filterArr);
		$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;		
		if (!empty($arrResults)) {
				foreach ($arrResults as $key => $value) {
					$allowed=false;
					if(Auth::user()->hasRole('netquick_admin') && $value->name!='netquick_admin'){
						$allowed=true;
					}elseif(Auth::user()->hasRole('netclues_admin') && $value->name!='netquick_admin' && $value->name!='netclues_admin'){
						$allowed=true;
					}elseif(Auth::user()->hasRole('client_roles') && $value->name!='netquick_admin' && $value->name!='netclues_admin' && $value->name!='client_roles'){
						$allowed=true;
					}
					if(Auth::user()->hasRole('netquick_admin')){
						$allowed=true;	
					}					
					if($allowed==true){
						$records["data"][] = $this->tableData($value);
					}
				}
		}
		$records["customActionStatus"] = "OK";
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		return json_encode($records);
	}

	public function tableData($role = false) 
	{	
			$actions = '';
			$actions .= '<a class="without_bg_icon" title="'.trans("template.common.show").'" href="'.route('powerpanel.roles.show',$role->id).'">
			<i class="fa fa-search-plus" aria-hidden="true"></i></a>&nbsp;';
			if(Auth::user()->can('roles-edit')) {
				$actions .='<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="'.route('powerpanel.roles.edit',$role->id).'">
				<i class="fa fa-pencil"></i></a>';	
			}
			if(Auth::user()->can('roles-delete')) {
				$actions .='&nbsp;<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="roles" data-alias = "'.$role->id.'"><i class="fa fa-times"></i></a>';
			}
			if(Auth::user()->can('roles-edit')) {
				$display_name = '<a class="" title="'.trans("template.common.edit").'" href="'.route('powerpanel.roles.edit',$role->id).'">'.$role->display_name.'</a>';
			}else{
				$display_name = $role->display_name;
			}
			$records = array(
			'<input type="checkbox" name="delete" class="chkDelete" value="' . $role->id. '">',
			$display_name,
			$role->description,
			$actions
			);			
			return $records;
	}

	/**
	* This method loads a role data on view
	* @return  View
	* @since   2017-08-16
	* @author  NetQuick
	*/
	public function show($id=false) {		
		$role = Role::getRecordById($id);
		$rolePermissions = Permission_role::getPermissionRole($id);		
		$this->breadcrumb['title']=trans('template.roleModule.shows');		
		$this->breadcrumb['module']=trans('template.roleModule.manageRoles');
		$this->breadcrumb['url']='powerpanel/roles';
		$this->breadcrumb['inner_title']=trans('template.roleModule.shows').' - '.$role->display_name;
		$breadcrumb=$this->breadcrumb;
		return view('powerpanel.roles.show',compact('role','rolePermissions','breadcrumb'));
	}	
	/**
	* This method destroys roles in multiples
	* @return  Banner index view
	* @since   2016-11-10
	* @author  NetQuick
	*/
	public function DeleteRecord(Request $request) {
		$data = $request->all('ids');
		foreach ($data['ids'] as $key=>$id) {
			$newRoleObj = Role::getRecordById($id);
			Permission_role::deletePermissionRole($id);
			$update = Role::updateRecord($id,['chr_publish' => 'N','chr_delete' => 'Y']);	
			if($update){
				$logArr = MyLibrary::logData($newRoleObj->id);	
				$logArr['varTitle'] = $newRoleObj->display_name;	
				Log::recordLog($logArr);
			}
			echo json_encode($update);
		}
	}

	/**
		* This method handels logs History records
		* @param   $data
		* @return  HTML
		* @since   2017-07-21
		* @author  NetQuick
		*/
		public function recordHistory($data=false) 
		{
				$returnHtml = '';
				$returnHtml.= '
					<table class="new_table_desing table table-striped table-bordered table-hover">
						<thead>
								<tr>
										<th>'.trans("template.common.title").'</th>
										<th>'.trans("template.common.description").'</th>
								</tr>
						</thead>
						<tbody>
								<tr>
										<td>'.$data->display_name.'</td>
										<td>'.$data->description.'</td>
								</tr>
						</tbody>
				</table>';
				return $returnHtml;
		}
}