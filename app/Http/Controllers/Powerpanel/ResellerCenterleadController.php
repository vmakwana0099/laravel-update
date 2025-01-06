<?php

namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Excel;
use Input;
use App\ResellerCenterLeads;
use App\CommonModel;
use App\Helpers\MyLibrary;
use Config;

class ResellerCenterleadController extends PowerpanelController {

    /**
     * Create a new Dashboard controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
    }

    public function index() {
        $CatData = Input::get('category');
        $iTotalRecords = CommonModel::getRecordCount();

        $interestedin = MyLibrary::getResellerCenterInterestedIn();
        $countryarr = MyLibrary::getCountrieslist();
        $businesstype = MyLibrary::getResellerCenterBusinessType();
        $payingtype = MyLibrary::getResellerCenterTotalCustomerPaying();

        $this->breadcrumb['title'] = trans('template.resellercenterModule.manageResellerLeads');
        return view('powerpanel.resellercenter_lead.list', ['iTotalRecords' => $iTotalRecords, 'breadcrumb' => $this->breadcrumb, 'CatData' => $CatData, 'interestedin' => $interestedin,'countryarr' => $countryarr,'businesstype' => $businesstype,'payingtype' => $payingtype]);
    }

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
        //$filterArr['categoryfilter'] = !empty(Input::get('customActionName_category')) ? Input::get('customActionName_category') : '';

        $sEcho = intval(Input::get('draw'));

        $arrResults = ResellerCenterLeads::getRecordList($filterArr);
        //echo "<pre>123:";print_r($arrResults); exit;
        $iTotalRecords = CommonModel::getRecordCount($filterArr, true);
        
        $end = $filterArr['iDisplayStart'] + $filterArr['iDisplayLength'];
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (!empty($arrResults)) {
            foreach ($arrResults as $key => $value) {
                $records["data"][] = $this->tableData($value);
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

    /**
     * This method handels delete leads operation
     * @return  xls file
     * @since   2016-10-18
     * @author  NetQuick
     */
    public function DeleteRecord(Request $request) {
        $data = $request->all('ids');
        $update = MyLibrary::deleteMultipleRecords($data);
        echo json_encode($update);
        exit;
    }

    /**
     * This method handels export process of contact us leads
     * @return  xls file
     * @since   2016-10-18
     * @author  NetQuick
     */
    public function ExportRecord() {

        if (Input::get('export_type') == 'selected_records') {
            $selectedIds = array();
            if (null !== Input::get('delete')) {
                $selectedIds = Input::get('delete');
            }

            $arrResults = ResellerCenterLeads::getListForExport($selectedIds);
        } else {

            $arrResults = ResellerCenterLeads::getListForExport();
        }
        if (count($arrResults) > 0) {
            foreach ($arrResults as $key => $value) {

                $selCategory = ResellerCenterLeads::getCategoriesData($value->fkIntServiceId);
        // echo '<pre>'; print_r($value); exit;
                $category='';
                if (!empty($value->varTitle)) {
                $category = $selCategory->varTitle;
                }
                $phoneNo = '-';
                $Email_Address = '-';
                if (!empty($value->varPhoneNo)) {
//                    $phoneNo = $value->varPhoneNo;
                    $phoneNo = MyLibrary::encrypt_decrypt('decrypt', $value->varPhoneNo);
                }

                $userMessage = '-';
                if (!empty($value->txtUserMessage)) {
                    $userMessage = $value->txtUserMessage;
                }
                if (!empty($value->varEmail)) {
                    $Email_Address = MyLibrary::encrypt_decrypt('decrypt', $value->varEmail);
                }

                $data[] = [
                    $value->varName,
                    $category,
                    $Email_Address,
                    $phoneNo,
                    $userMessage,
                    $value->varIpAddress,
                    date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->created_at))
                ];
            }

            $this->createContactLeadExcel($data);
        }
    }

    /**
     * This method create contact lead excel sheet
     * @return  xls file
     * @since   2016-10-18
     * @author  NetQuick
     */
    public function createContactLeadExcel($data) {

        Excel::create(Config::get('Constant.SITE_NAME') . '-' . trans("template.resellercenterModule.contactUsLeads") . '-' . date("dmy-h:i"), function($excel) use($data) {
            $excel->sheet(date('M-d-Y'), function($sheet) use($data) {
                $sheet->setAutoSize(true);
                $sheet->fromArray($data);
                $sheet->row(1, array(
                    trans('template.common.name'),
                    trans('template.resellercenterModule.type'),
                    trans('template.common.email'),
                    trans('template.resellercenterModule.phone'),
                    trans('template.resellercenterModule.message'),
                    trans('template.resellercenterModule.ipAddress'),
                    trans('template.resellercenterModule.receivedDateTime')
                ));

                $sheet->prependRow(array(
                    Config::get('Constant.SITE_NAME') . ' ' . trans("template.resellercenterModule.contactUsLeads")
                ));

                $sheet->mergeCells('A1:F1');
                $sheet->row(1, function($row) {
                    $row->setAlignment('center');
                    $row->setFontWeight('bold');
                    $row->setFontSize(12);
                });
                $sheet->row(2, function($row) {
                    $row->setAlignment('center');
                    $row->setFontWeight('bold');
                    $row->setFontSize(12);
                });
            });
        })->download('xls');
    }

    public function tableData($value) {
        $details = '';
        $phoneNo = '';
        $interestedin = MyLibrary::getResellerCenterInterestedIn($value->interestedin);
        $countryarr = MyLibrary::getCountrieslist($value->countrydata);
        $businesstype = MyLibrary::getResellerCenterBusinessType($value->businesstype);
        $payingtype = MyLibrary::getResellerCenterTotalCustomerPaying($value->totalcustomer);
        if (!empty($value->user_message)) {
            $details .= '<div class="pro-act-btn">';
            $details .= '<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Message\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
            $details .= '<div class="highslide-maincontent">' . nl2br($value->user_message);
             $details .= '</br>Company Name: '.$value->companyname;
             $details .= '</br>Company URL: '.$value->companyurl;
            $details .= '</br>Type Of Business: '.$businesstype;
            $details .= '</br>Total Customer: '.$payingtype;
            $details .= '</br>Country: '.$countryarr;
            $details .= '</div>';
            $details .='</div>';
        } else {
            $details .= '-';
        }

        if (!empty($value->phone_number)) {
            $phoneNo = MyLibrary::encrypt_decrypt('decrypt', $value->phone_number);
        } else {
            $phoneNo = '-';
        }
        $emails = MyLibrary::encrypt_decrypt('decrypt', $value->workemail);
        $records = array(
            '<input type="checkbox" name="delete[]" class="chkDelete" value="' . $value->id . '">',
            $value->fullname,
            $interestedin,
            $emails,
            $phoneNo,
            $details,
            $value->varIpAddress,
            date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->created_at))
        );

        return $records;
    }

}
