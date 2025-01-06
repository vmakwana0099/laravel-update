<?php

namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Input;
use Validator;
use App\ContactInfo;
use Crypt;
use App\Log;
use App\RecentUpdates;
use Auth;
use App\CommonModel;
use App\Helpers\AddImageModelRel;
use App\Helpers\MyLibrary;
use Carbon\Carbon;
use Config;
use Cache;
use App\Helpers\resize_image;

class ContactInfoController extends PowerpanelController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
    }

    /**
     * This method handels view of listing
     * @return  view
     * @since   2017-08-02
     * @author  NetQuick
     */
    public function index() {
        $total = CommonModel::getRecordCount();
        $this->breadcrumb['title'] = trans('template.contactModule.managecontacts');
        return view('powerpanel.contact_info.list', ['total' => $total, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * This method loads contactInfo edit view
     * @param   Alias of record
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function edit($id = false) {
        $imageManager = true;
        if (!is_numeric($id)) {
            $total = CommonModel::getRecordCount();
            $total = $total + 1;
            $this->breadcrumb['title'] = trans('template.contactModule.addnewcontact');
            $this->breadcrumb['module'] = trans('template.contactModule.managecontacts');
            $this->breadcrumb['url'] = 'powerpanel/contact-info';
            $this->breadcrumb['inner_title'] = trans('template.contactModule.addnewcontact');
            $breadcrumb = $this->breadcrumb;
            $data = ['total' => $total, 'breadcrumb' => $this->breadcrumb, 'imageManager' => $imageManager];
        } else {
            $contactInfo = ContactInfo::getRecordById($id);
            if (count((array)($contactInfo)) == 0) {
                return redirect()->route('powerpanel.contact-info.add');
            }
            $this->breadcrumb['title'] = trans('template.common.edit') . ' - ' . $contactInfo->varTitle;
            $this->breadcrumb['module'] = trans('template.contactModule.managecontacts');
            $this->breadcrumb['url'] = 'powerpanel/contact-info';
            $this->breadcrumb['inner_title'] = trans('template.common.edit') . ' - ' . $contactInfo->varTitle;
            $breadcrumb = $this->breadcrumb;
            $data = ['contactInfo' => $contactInfo, 'breadcrumb' => $this->breadcrumb, 'imageManager' => $imageManager];
        }
        return view('powerpanel.contact_info.actions', $data);
    }

    /**
     * This method handels post of edit
     * @return  view
     * @since   2017-08-02
     * @author  NetQuick
     */
    public function handlePost(Request $request) {
        $postArr = Input::all();
        
        $messsages = array('order.greater_than_zero' => trans('template.contactModule.displayGreaterThan'));

       $rules = array(
            'name' => 'required|max:255',
            'home_page_title' => 'required|max:500',
            'home_page_description' => 'required|max:500',
            'email' => 'required|email',
            'phone_no' => 'required|min:10|max:20',
            'order' => 'required|greater_than_zero',
        );
        $actionMessage = 'Opps... Something went wrong!';
        $validator = Validator::make($postArr, $rules, $messsages);
        if ($validator->passes()) {
            $contactInfoArr['varTitle'] = trim($postArr['name']);
            $contactInfoArr['varEmail'] = MyLibrary::encrypt_decrypt('encrypt', $postArr['email']);
            $contactInfoArr['varPhoneNo'] = MyLibrary::encrypt_decrypt('encrypt', $postArr['phone_no']);
            $contactInfoArr['varFaxNo'] = $postArr['fax_no'];
            $contactInfoArr['varHomePageTitle'] = $postArr['home_page_title'];
            $contactInfoArr['varOpenHours'] = $postArr['supporthours'];
            $contactInfoArr['varHomePageDescription'] = $postArr['home_page_description'];
            $contactInfoArr['varMailingAddress'] = $postArr['mailingaddress'];
            $contactInfoArr['varOfficeAddress'] = $postArr['officeaddress'];
            $contactInfoArr['varSchemaAddress'] = $postArr['schema_address'];
            $contactInfoArr['varSchemaLocality'] = $postArr['schema_locality'];
            $contactInfoArr['varSchemaRegion'] = $postArr['schema_rgion'];
            $contactInfoArr['varSchemaPostalCode'] = $postArr['schema_postalcode'];
            $contactInfoArr['varSchemaCountry'] = $postArr['schema_country'];
            $contactInfoArr['chrPublish'] = $postArr['chrMenuDisplay'];
            $contactInfoArr['varLatitude'] = $postArr['lattitude'];
            $contactInfoArr['varLongitude'] = $postArr['longitude'];
            $contactInfoArr['varIpAddress'] = $request->ip();
            $contactInfoArr['varRefURL'] = $postArr['varRefURL'];
            $contactInfoArr['created_at'] = date('Y-m-d H:i:s');
            $contactInfoArr['updated_at'] = date('Y-m-d H:i:s');
            $id = $request->segment(3);
            if (is_numeric($id)) { #Edit post Handler=======
                $contactInfo = ContactInfo::getRecordForLogById($id);
                $whereConditions = ['id' => $id];
                $update = CommonModel::updateRecords($whereConditions, $contactInfoArr);
                if ($update) {
                    if (!empty($id)) {
                        self::swap_order_edit($postArr['order'], $id);
                        $logArr = MyLibrary::logData($id);
                        if (Auth::user()->can('log-advanced')) {
                            $newContactInfo = ContactInfo::getRecordForLogById($id);
                            $oldRec = $this->recordHistory($contactInfo);
                            $newRec = $this->recordHistory($newContactInfo);
                            $logArr['old_val'] = $oldRec;
                            $logArr['new_val'] = $newRec;
                        }
                        $logArr['varTitle'] = trim($postArr['name']);
                        Log::recordLog($logArr);
                        if (Auth::user()->can('recent-updates-list')) {
                            if (!isset($newContactInfo)) {
                                $newContactInfo = ContactInfo::getRecordForLogById($id);
                            }
                            $notificationArr = MyLibrary::notificationData($id, $newContactInfo);
                            RecentUpdates::setNotification($notificationArr);
                        }
                    }
                    self::flushCache();
                    $actionMessage = 'Contact info has been successfully updated.';
                }
            } else { #Add post Handler=======	
                $contactInfoArr['intDisplayOrder'] = self::swap_order_add($postArr['order']);
                $contactInfoID = CommonModel::addRecord($contactInfoArr);
                if (!empty($contactInfoID)) {
                    $id = $contactInfoID;
                    $newContactObj = ContactInfo::getRecordForLogById($id);

                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newContactObj->varTitle;
                    Log::recordLog($logArr);
                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newContactObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                    $actionMessage = 'Contact info has been successfully added.';
                }
            }

//				AddImageModelRel::sync(explode(',', $postArr['img_id']), $id);		
            if (!empty($request->saveandexit) && $request->saveandexit == 'saveandexit') {
                return redirect()->route('powerpanel.contact-info.index')->with('message', $actionMessage);
            } else {
                return redirect()->route('powerpanel.contact-info.edit', $id)->with('message', $actionMessage);
            }
        } else {

            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    /**
     * This method handels listing
     * @return  view
     * @since   2017-08-02
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
        $arrResults = ContactInfo::getRecordList($filterArr);
        $iTotalRecords = CommonModel::getRecordCount($filterArr, true);

        $end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (!empty($arrResults)) {
            foreach ($arrResults as $key => $value) {
                $records['data'][] = $this->tableData($value);
            }
        }

        if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
        exit;
    }

    /**
     * This method handels Publish/Unpublish
     * @return  view
     * @since   2017-08-02
     * @author  NetQuick
     */
    public function publish(Request $request) {
        $id = (int) Input::get('alias');
        $update = MyLibrary::setPublishUnpublish($id, $request);
        self::flushCache();
        echo json_encode($update);
        exit;
    }

    /**
     * This method reorders position
     * @return  Banner index view data
     * @since   2016-10-26
     * @author  NetQuick
     */
    public function reorder() {
        $order = Input::get('order');
        $exOrder = Input::get('exOrder');
        MyLibrary::swapOrder($order, $exOrder);
        self::flushCache();
    }

    /**
     * This method destroys multiples records
     * @return  true/false
     * @since   03-08-2017
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
    public static function swap_order_edit($order = null, $id = null) {
        MyLibrary::swapOrderEdit($order, $id);
        self::flushCache();
    }

    /**
     * This method datatable grid data
     * @return  array
     * @since   03-08-2017
     * @author  NetQuick
     */
    public function tableData($value = false) {
        $actions = '';
        $publish_action = '';
        if (Auth::user()->can('contact-info-edit')) {
            $actions .= '<a class="without_bg_icon" title="Edit" href="' . route('powerpanel.contact-info.edit', array('id' => $value->id)) . '">
				<i class="fa fa-pencil"></i></a>';
        }

        if (Auth::user()->can('contact-info-publish')) {
//			 if (count($value) > 1) {
            if ($value->chrPublish == 'Y') {
                $publish_action .= '<input data-off-text="No" disabled data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/contact-info" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
            } else {
                $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/contact-info" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
            }
//			 }
        }

        $details = '';
        $details .= '<a href="javascript:void(0)" class="highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Details\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
        $details .= '<div class="highslide-maincontent"><b>Phone No: </b>' . MyLibrary::encrypt_decrypt('decrypt', $value->varPhoneNo) . '<hr><b>Home Page Title: </b>' . nl2br($value->varHomePageTitle) . '<hr><b>Home Page Description: </b>' . nl2br($value->varHomePageDescription) . '</div>';

        if (Auth::user()->can('contact-info-edit')) {
            $title = '<a class="" title="Edit" href="' . route('powerpanel.contact-info.edit', array('id' => $value->id)) . '">' . ucwords($value->varTitle) . '</a>';
        } else {
            $title = ucwords($value->varTitle);
        }
        $emails = MyLibrary::encrypt_decrypt('decrypt', $value->varEmail);
        $records = array(
            '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">',
            $title,
            $emails,
            $details,
            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				' . $value->intDisplayOrder .
            ' <a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
            $publish_action,
            $actions,
            $value->intDisplayOrder,
        );
        return $records;
    }

    /**
     * This method handle severside validation rules
     * @return  array
     * @since   03-08-2017
     * @author  NetQuick
     */
   
    /**
     * This method handle notification old record
     * @return  array
     * @since   2016-10-25
     * @author  NetQuick
     */
    public function recordHistory($data = false) {
        $returnHtml = '';
        $returnHtml.='<table class="new_table_desing table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>' . trans("template.common.title") . '</th>
					<th>' . trans("template.common.email") . '</th>
					<th>' . trans("template.common.phoneno") . '</th>
					<th>' . trans("template.common.publish") . '</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>' . $data->varTitle . '</td>
					<td>' . $data->varEmail . '</td>
					<td>' . $data->varPhoneNo . '</td>
					<td>' . $data->chrPublish . '</td>				
				</tr>
			</tbody>
		</table>';
        return $returnHtml;
    }

    public static function flushCache() {
        Cache::tags('ContactInfo')->flush();
    }

}
