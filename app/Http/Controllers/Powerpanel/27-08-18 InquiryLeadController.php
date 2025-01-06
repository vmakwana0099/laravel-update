<?php

namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Excel;
use Input;
use App\InquiryLead;
use App\CommonModel;
use App\Helpers\MyLibrary;
use Config;

class InquiryLeadController extends PowerpanelController {

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
        $iTotalRecords = CommonModel::getRecordCount();
        $this->breadcrumb['title'] = trans('template.inquiryleadModule.manageInquiryLeads');
//        $this->breadcrumb['title'] = trans('test');
        return view('powerpanel.inquiry_lead.list', ['iTotalRecords' => $iTotalRecords, 'breadcrumb' => $this->breadcrumb]);
        
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
//        $filterArr['categoryfilter'] = !empty(Input::get('customActionName_category')) ? Input::get('customActionName_category') : '';

        $sEcho = intval(Input::get('draw'));

        $arrResults = InquiryLead::getRecordList($filterArr);
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

            $arrResults = InquiryLead::getListForExport($selectedIds);
        } else {

            $arrResults = InquiryLead::getListForExport();
        }

        if (count($arrResults) > 0) {
            foreach ($arrResults as $key => $value) {

                $phoneNo = '-';
                if (!empty($value->varPhone)) {
                   $phoneNo = MyLibrary::encrypt_decrypt('decrypt', $value->varPhone);
                }

                $userMessage = '-';
                if (!empty($value->varMessage)) {
                    $userMessage = $value->varMessage;
                }
                
                $Email_Address = MyLibrary::encrypt_decrypt('decrypt', $value->varEmail);

                $data[] = [
                            
                            $value->varName,
                            $Email_Address,
                            $phoneNo,
                            $userMessage,
                            $value->varIP,
                            date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->datetime))
                ];
            }

            $this->createInquiryLeadExcel($data);
        }
    }

    /**
     * This method create contact lead excel sheet
     * @return  xls file
     * @since   2016-10-18
     * @author  NetQuick
     */
    public function createInquiryLeadExcel($data) {

        Excel::create(Config::get('Constant.SITE_NAME') . '-' . trans("template.inquiryleadModule.inquiryLeads") . '-' . date("dmy-h:i"), function($excel) use($data) {
            $excel->sheet(date('M-d-Y'), function($sheet) use($data) {
                $sheet->setAutoSize(true);
                $sheet->fromArray($data);
                $sheet->row(1, array(
                    trans('template.common.name'),
                    trans('template.common.email'),
                    trans('template.inquiryleadModule.phone'),
                    trans('template.inquiryleadModule.message'),
                    trans('template.inquiryleadModule.ipAddress'),
                    trans('template.inquiryleadModule.receivedDateTime')
                ));

                $sheet->prependRow(array(
                    Config::get('Constant.SITE_NAME') . ' ' . trans("template.inquiryleadModule.inquiryLeads")
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
        
        if (!empty($value->txtUserMessage)) {
            $details .= '<div class="pro-act-btn">';
            $details .= '<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Message\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
            $details .= '<div class="highslide-maincontent">' . nl2br($value->txtUserMessage) . '</div>';
            $details .='</div>';
        } else {
            $details .= '-';
        }
       
        if (!empty($value->varPhone)) {
            $phoneNo = MyLibrary::encrypt_decrypt('decrypt', $value->varPhone);
        } else {
            $phoneNo = '-';
        }
        $emails = MyLibrary::encrypt_decrypt('decrypt', $value->varEmail);
        $records = array(
            '<input type="checkbox" name="delete[]" class="chkDelete" value="' . $value->id . '">',
            $value->varName,
            $emails,
            $phoneNo,
            $details,
            $value->varIpAddress,
            date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->datetime))
        );

        return $records;
    }

}
