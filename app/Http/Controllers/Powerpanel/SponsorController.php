<?php
namespace App\Http\Controllers\Powerpanel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Input;
use App\SponsorCategory;
use App\Sponsor;
use App\Log;
use App\RecentUpdates;
use App\Alias;
use Validator;
use DB;
use App\Http\Controllers\PowerpanelController;
use Crypt;
use Auth;
use App\Helpers\MyLibrary;
use App\CommonModel;
use App\Helpers\AddImageModelRel;
use App\Helpers\resize_image;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;
use Cache;

class SponsorController extends PowerpanelController {
	/**
	* Create a new controller instance.
	* @return void
	*/
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale']))
		{
			app()->setLocale($_COOKIE['locale']);
		}
	}

	/**
	 * This method handels load sponsor grid
	 * @return  View
	 * @since   2017-07-20
	 * @author  NetQuick
	 */
	public function index() 
	{
		$total = CommonModel::getRecordCount();
		$SponsorCategory = $total > 0 ? SponsorCategory::getCatWithParent() : null;
		$this->breadcrumb['title']=trans('template.sponsorsModule.managesponsors');
		return view('powerpanel.sponsor.list',['total'=>$total,'breadcrumb'=> $this->breadcrumb,'SponsorCategory'=>$SponsorCategory]);
	}

	/**
	 * This method handels list of sponsor with filters
	 * @return  View
	 * @since   2017-07-20
	 * @author  NetQuick
	 */
	public function get_list()
	{

		/*Start code for sorting*/
		$filterArr = [];
		$records = array();
		$records["data"] = array();

		$filterArr['orderColumnNo'] = (!empty(Input::get('order') [0]['column']) ? Input::get('order') [0]['column'] : '');
		$filterArr['orderByFieldName'] = (!empty(Input::get('columns') [$filterArr['orderColumnNo']]['name']) ? Input::get('columns') [$filterArr['orderColumnNo']]['name'] : '');
		$filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order') [0]['dir']) ? Input::get('order') [0]['dir'] : '');
		$filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
		$filterArr['statusFilter'] = !empty(Input::get('statusFilter')) ? Input::get('statusFilter') : '';
		$filterArr['dateFilter'] = !empty(Input::get('dateValue')) ? Input::get('dateValue') : '';
		$filterArr['catFilter']  = !empty(Input::get('catValue')) ? Input::get('catValue') : '';
		$filterArr['iDisplayLength'] = intval(Input::get('length'));
		$filterArr['iDisplayStart'] = intval(Input::get('start'));	

		$sEcho = intval(Input::get('draw'));

		$arrResults = Sponsor::getRecordList($filterArr);

		$iTotalRecords = CommonModel::getRecordCount($filterArr,true);
		$end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		if (count($arrResults) > 0 && !empty($arrResults)){	
			foreach ($arrResults as $key => $value){
				$records["data"][] = $this->tableData($value);
			}
		}
		$records["customActionStatus"] = "OK";
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;
		echo json_encode($records);
		exit;

	}

	/**
	 * This method loads sponsor edit view
	 * @param   Alias of record
	 * @return  View
	 * @since   2017-10-26
	 * @author  NetQuick
	 */

	public function edit($alias=false){
		$imageManager = true;
		$category = SponsorCategory::getCatWithParent();
		$category = CategoryArrayBuilder::getArray($category);
		$SponsorCategory = json_encode($category);
		$categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false,false,'\App\SponsorCategory');
		if(!is_numeric($alias)){
			$total = CommonModel::getRecordCount();
			$total = $total+1;
			$this->breadcrumb['title']=trans('template.sponsorsModule.addsponsor');
			$this->breadcrumb['module']=trans('template.sponsorsModule.managesponsors');
			$this->breadcrumb['url']='powerpanel/sponsor';
			$this->breadcrumb['inner_title']=trans('template.sponsorsModule.addsponsor');
			$data = [
				'total'=>$total,
				'breadcrumb'=>$this->breadcrumb,
				'imageManager' => $imageManager,
				'SponsorCategory' => $SponsorCategory,
				'categoryHeirarchy' => $categoryHeirarchy 
			];
		}else{
			$id = $alias;
			$sponsors = Sponsor::getRecordById($id);
			if(count($sponsors)==0){ return redirect()->route('powerpanel.sponsor.add'); }
			$this->breadcrumb['title']=trans('template.common.edit').' - '.$sponsors->varTitle;		
			$this->breadcrumb['module']=trans('template.sponsorsModule.managesponsors');
			$this->breadcrumb['url']='powerpanel/sponsor';
			$this->breadcrumb['inner_title']=trans('template.common.edit').' - '.$sponsors->varTitle;
			$data = [
				'sponsors'=>$sponsors,
				'id'=>$id,
				'breadcrumb'=>$this->breadcrumb,
				'imageManager' => $imageManager,
				'SponsorCategory' => $SponsorCategory,
				'categoryHeirarchy' => $categoryHeirarchy
			];
		}
		
		return view('powerpanel.sponsor.actions',$data);
	}

	/**
	 * This method handle sponsor modifications
	 * @return  View
	 * @since   2017-11-10
	 * @author  NetQuick
	 */

	public function handlePost(Request $resquest) {
		$postArr = Input::all();
		$messsages = array('order.greater_than_zero'=>trans('template.sponsorsModule.displayGreaterThan'));
		$rules = array(
			'name' => 'required|max:160',
			'image_upload' => 'required',
			'link'=>'required',
			'display_order' => 'required|greater_than_zero',
			'chrMenuDisplay' => 'required'
		);	
		$validator = Validator::make($postArr, $rules, $messsages);
		if($validator->passes()){
			$id = $resquest->segment(3);
			$actionMessage = trans('template.common.oppsSomethingWrong');
				if(is_numeric($id)){ #Edit post Handler=======
					$sponsor = Sponsor::getRecordById($id);
					$updateSponsorFields	= [];
					$updateSponsorFields['varTitle'] = trim($postArr['name']);
					$updateSponsorFields['txtCategories']       = isset($postArr['category_id']) ? serialize($postArr['category_id']) : null;
					$updateSponsorFields['varExternalLink'] = trim($postArr['link']);
					$updateSponsorFields['fkIntImgId'] = !empty($postArr['image_upload'])?$postArr['image_upload']:null;
					$updateSponsorFields['chrPublish']	= $postArr['chrMenuDisplay'];

					$whereConditions = ['id' => $id];
					$update = CommonModel::updateRecords($whereConditions, $updateSponsorFields);
					if($update){
						if($id>0 && !empty($id)){					
							self::swap_order_edit($postArr['display_order'],$id);
							$logArr = MyLibrary::logData($id);
							if (Auth::user()->can('log-advanced')) {
								$newSponsorObj = Sponsor::getRecordById($id);		
								$oldRec = $this->recordHistory($sponsor);
								$newRec = $this->recordHistory($newSponsorObj);
								$logArr['old_val'] = $oldRec;
								$logArr['new_val'] = $newRec;
							}
							$logArr['varTitle'] = trim($postArr['name']);
							Log::recordLog($logArr);
							if (Auth::user()->can('recent-updates-list')) {
								if(!isset($newSponsorObj)){
									$newSponsorObj = Sponsor::getRecordById($id);	
								}
								$notificationArr = MyLibrary::notificationData($id, $newSponsorObj);
								RecentUpdates::setNotification($notificationArr);
							}
							self::flushCache();
							$actionMessage = trans('template.sponsorsModule.updateMessage');
						}
					}
				}else{ #Add post Handler=======
					$sponsorArr['varTitle'] = trim($postArr['name']);
					$sponsorArr['varExternalLink'] = trim($postArr['link']);
					$sponsorArr['txtCategories'] = isset($postArr['category_id']) ? serialize($postArr['category_id']) : null;
					$sponsorArr['fkIntImgId'] = !empty($postArr['image_upload'])?$postArr['image_upload']:null;
					$sponsorArr['intDisplayOrder'] = self::swap_order_add($postArr['display_order']);
					$sponsorArr['chrPublish']	= $postArr['chrMenuDisplay'];
					$sponsorArr['created_at']	= Carbon::now();

					$sponsorID = CommonModel::addRecord($sponsorArr);
					if($sponsorID){
						if(!empty($sponsorID))
						{
							$id = $sponsorID;
							$newSponsorObj = Sponsor::getRecordById($id);
							$logArr = MyLibrary::logData($id);
							$logArr['varTitle'] = $newSponsorObj->varTitle;
							Log::recordLog($logArr);
							if (Auth::user()->can('recent-updates-list')) {
								$notificationArr = MyLibrary::notificationData($id, $newSponsorObj);
								RecentUpdates::setNotification($notificationArr);
							}
							self::flushCache();
							$actionMessage = trans('template.sponsorsModule.addMessage');
						}
					}	
				}
		
		    AddImageModelRel::sync(explode(',', $postArr['image_upload']), $id);
				if(!empty($postArr['saveandexit']) && $postArr['saveandexit'] == 'saveandexit'){
					return redirect()->route('powerpanel.sponsor.index')->with('message', $actionMessage);
				}else{					
					return redirect()->route('powerpanel.sponsor.edit',$id)->with('message', $actionMessage);
				}

		}else{
			return Redirect::back()->withErrors($validator)->withInput();
		}
	}

	/**
  * This method destroys Sponsor in multiples
  * @return  Sponsor index view
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
  * This method destroys Sponsor in multiples
  * @return  Sponsor index view
  * @since   2016-10-25
  * @author  NetQuick
  */
	public function publish(Request $request)
	{

		$alias = (int) Input::get('alias');
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
 * This method handels swapping of available order record while adding
 * @param  	order
 * @return  order
 * @since   2016-10-21
 * @author  NetQuick
 */
	public static function swap_order_add($order=null) {
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
  * @since   2016-12-23
  * @author  NetQuick
  */
	public static function swap_order_edit($order=null,$id=null) {		
		MyLibrary::swapOrderEdit($order, $id);
		self::flushCache();
	}


	public function tableData($value){		
		$details = '';
		$actions = '';
		$link = '';
		$publish_action='';
		if(Auth::user()->can('sponsor-edit')) {
			$actions .= '<a class="without_bg_icon" title="'.trans("template.common.edit").'" href="'.route('powerpanel.sponsor.edit',array('alias' => $value->id)).'">
			<i class="fa fa-pencil"></i></a>';
		}
		if(Auth::user()->can('sponsor-delete')){
			$actions .= '<a class="without_bg_icon delete" title="'.trans("template.common.delete").'" data-controller="sponsor" data-alias = "'.$value->id.'"><i class="fa fa-times"></i></a>';
		}
		if(Auth::user()->can('sponsor-publish')){
			if($value->chrPublish == 'Y') {
				$publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/sponsor" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
			}else{
				$publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/sponsor" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
			}
		}

		$category = '';
		if (isset($value->txtCategories)) {
				$categoryIDs = unserialize($value->txtCategories);
				$selCategory = SponsorCategory::getParentCategoryNameBycatId($categoryIDs);

				$category .= '<div class="pro-act-btn"><a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'' . trans("template.common.category") . '\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-info"></span></a>';
				$category .= '<div class="highslide-maincontent">';
				$category .= '<ul>';
				foreach ($selCategory as $selCat) {
						if (strlen(trim($selCat)) > 0) {
								$category .= '<li>';
								$category .= $selCat->varTitle;
								$category .= '</li>';
						}
				}
				$category .= '<ul>';
				$category .= '</div>';
				$category .= '</div>';
		} else {
				$category .= '<span class="glyphicon glyphicon-minus"></span>';
		}

		$details .= '<div class="text-center">';
		if(isset($value->fkIntImgId) && !empty($value->fkIntImgId)){
			$details .= '<a href="'.resize_image::resize($value->fkIntImgId).'" class="fancybox-buttons" data-rel="fancybox-buttons">';
			$details .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) .'" src="'.resize_image::resize($value->fkIntImgId,50,50).'"/>';
			$details .= '</a>';
		}else{
			$details .= '<span class="glyphicon glyphicon-minus"></span>';
		}
		$details .= '</div>';

		$link .=	'<div class="pro-act-btn">';
		if(!empty($value->varExternalLink)){
			$link .=	'<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Link\',wrapperClassName:\'titlebar\',showCredits:false});"><span class="fa fa-info"></span></a>';
			$link .=	'<div class="highslide-maincontent">'.$value->varExternalLink.'</div>';
		}else{
			$link .= '<span class="glyphicon glyphicon-minus"></span>';
		}
		$link .= '</div>';
		if(Auth::user()->can('sponsor-edit')) {
			$name = '<a title="'.trans("template.common.edit").'" href="'.route('powerpanel.sponsor.edit',array('alias' => $value->id)).'">'.$value->varTitle.'</a>';
		}else {
			$name = $value->varTitle;
		}
		$records = array(			
			'<input type="checkbox" name="delete" class="chkDelete" value="'.$value->id.'">',			
			$name,
			$details,
			$category,
			'<a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				'.$value->intDisplayOrder.
			' <a href="javascript:;" data-order="'.$value->intDisplayOrder.'" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
			$link,
			$publish_action,
			$actions,
			$value->intDisplayOrder
		);
		return $records;
	}

	/**
  * This method handels logs History records
  * @param   $data
  * @return  HTML
  * @since   2017-07-21
  * @author  NetQuick
  */
	public function recordHistory($data =false){
		$returnHtml='';
			$returnHtml.='<table class="new_table_desing table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>'.trans("template.common.sponserName").'</th>						
						<th>'.trans("template.common.image").'</th>
						<th>'.trans("template.common.link").'</th>
						<th>'.trans("template.common.order").'</th>
						<th>'.trans("template.common.publish").'</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>'.$data->varTitle.'</td>
						<td>'.'<img height="50" width="50" src="'.resize_image::resize($data->fkIntImgId).'" />'.'</td>
						<td>'.$data->varExternalLink.'</td>
						<td>'.($data->intDisplayOrder).'</td>
						<td>'.$data->chrPublish.'</td>
					</tr>
				</tbody>
			</table>';

		return $returnHtml;
	}
	public static function flushCache(){
			Cache::tags('Sponsors')->flush();
	}
}