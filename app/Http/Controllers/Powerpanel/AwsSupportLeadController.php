<?php

namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Excel;
use Input;
use App\AwsSupportLead;
use App\CommonModel;
use App\Helpers\MyLibrary;
use Config;

class AwsSupportLeadController extends PowerpanelController {

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
        $this->breadcrumb['title'] = trans('template.awssupportleadModule.manageAwsSupportLeads');
        return view('powerpanel.aws_support_lead.list', ['iTotalRecords' => $iTotalRecords, 'breadcrumb' => $this->breadcrumb]);
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

        $sEcho = intval(Input::get('draw'));

        $arrResults = AwsSupportLead::getRecordList($filterArr);
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
        // echo '<pre>2233: '; print_r($records); exit;

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
        $update = MyLibrary::deleteAWSMultipleRecords($data);
        print_r($update);
        exit;
        echo json_encode($update);
        exit;
    }

    /**
     * This method handels export process of AwsSupportLead us leads
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

            $arrResults = AwsSupportLead::getListForExport($selectedIds);
        } else {

            $arrResults = AwsSupportLead::getListForExport();
        }

        if (count($arrResults) > 0) {
            foreach ($arrResults as $key => $value) {

                if (!empty($value->varPhoneNo)) {
                    $phoneNo = MyLibrary::encrypt_decrypt('decrypt', $value->varPhoneNo);
                } else {
                    $phoneNo = '-';
                }
                $emails = MyLibrary::encrypt_decrypt('decrypt', $value->varEmail);

                $userMessage = '-';
                if (!empty($value->txtComments)) {
                    $userComments = $value->txtComments;
                }

                if (!empty($value->varState)) {
                    $State = $value->varState;
                } else {
                    $State = '-';
                }
                if (!empty($value->varCompany)) {
                    $Company = $value->varCompany;
                } else {
                    $Company = '-';
                }
                
                
                $data[] = [
                    $value->varFirstName,
                    $value->varLastName,
                    $emails,
                    $phoneNo,
                    $State,
                    $Company,
                    $userComments,
                    date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->created_at))
                ];
            }

            $this->createAWSSupportLeadExcel($data);
        }
    }

    /**
     * @return  xls file
     * @since   2016-10-18
     * @author  NetQuick
     */
    public function createAWSSupportLeadExcel($data) {

        Excel::create(Config::get('Constant.SITE_NAME') . '-' . trans("template.awssupportleadModule.awssupportLeads") . '-' . date("dmy-h:i"), function($excel) use($data) {
            $excel->sheet(date('M-d-Y'), function($sheet) use($data) {
                $sheet->setAutoSize(true);
                $sheet->fromArray($data);
                $sheet->row(1, array(
                    trans('template.powerPanelDashboard.firstname'),
                    trans('template.powerPanelDashboard.lastname'),
                    trans('template.common.email'),
                    trans('template.awssupportleadModule.phone'),
                    trans('template.awssupportleadModule.state'),
                    trans('template.awssupportleadModule.company'),
                    trans('template.awssupportleadModule.comments'),
                    //trans('template.awssupportleadModule.ipAddress'),
                    trans('template.awssupportleadModule.receivedDateTime')
                ));

                $sheet->prependRow(array(
                    Config::get('Constant.SITE_NAME') . ' ' . trans("template.awssupportleadModule.awssupportLeads")
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
        if (!empty($value->txtComments)) {
            $details .= '<div class="pro-act-btn">';
            $details .= '<a href="javascript:void(0)" class="without_bg_icon" onclick="return hs.htmlExpand(this,{width:300,headingText:\'Message\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>';
            $details .= '<div class="highslide-maincontent">' . nl2br($value->txtComments) . '</div>';
            $details .='</div>';
        } else {
            $details .= '-';
        }

        if (!empty($value->varPhoneNo)) {
            $phoneNo = MyLibrary::encrypt_decrypt('decrypt', $value->varPhoneNo);
        } else {
            $phoneNo = '-';
        }
        if (!empty($value->varState)) {
            $State = $value->varState;
        } else {
            $State = '-';
        }
        if (!empty($value->varCompany)) {
            $Company = $value->varCompany;
        } else {
            $Company = '-';
        }
        $emails = MyLibrary::encrypt_decrypt('decrypt', $value->varEmail);
        $records = array(
            '<input type="checkbox" name="delete[]" class="chkDelete" value="' . $value->id . '">',
            $value->varFirstName,
            $value->varLastName,
            $emails,
            $phoneNo,
            $State,
            $Company,
            $details,
//            $value->varIpAddress,
            date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->created_at))
        );

        return $records;
    }

}
