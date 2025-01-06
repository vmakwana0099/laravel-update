<?php

namespace App\Http\Controllers\Powerpanel;

use App\Alias;
use App\CmsPage;
use App\CommonModel;
use App\Helpers\MyLibrary;
use App\Http\Controllers\PowerpanelController;
use App\Log;
use App\Modules;
use App\Pagehit;
use App\RecentUpdates;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Input;
use Validator;
use Cache;

class CmsPagesController extends PowerpanelController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
    }

    /**
     * This method handles list view
     * @return  View
     * @since   2017-07-24
     * @author  NetQuick
     */
    public function index() {
        $iTotalRecords = CommonModel::getRecordCount();
        $this->breadcrumb['title'] = trans('template.pageModule.manage');
        return view('powerpanel.cms_pages.list', ['iTotalRecords' => $iTotalRecords, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * This method fetch list of pages
     * @return  json
     * @since   2017-07-24
     * @author  NetQuick
     */
    public function get_list() {

        $filterArr = [];
        $records = [];
        $records["data"] = [];
        $filterArr['orderColumnNo'] = (!empty(Input::get('order')[0]['column']) ? Input::get('order')[0]['column'] : '');
        $filterArr['orderByFieldName'] = (!empty(Input::get('columns')[$filterArr['orderColumnNo']]['name']) ? Input::get('columns')[$filterArr['orderColumnNo']]['name'] : '');
        $filterArr['orderTypeAscOrDesc'] = (!empty(Input::get('order')[0]['dir']) ? Input::get('order')[0]['dir'] : '');
        $filterArr['statusFilter'] = !empty(Input::get('customActionName')) ? Input::get('customActionName') : '';
        $filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
        $filterArr['iDisplayLength'] = intval(Input::get('length'));
        $filterArr['iDisplayStart'] = intval(Input::get('start'));

        $iDisplayLength = intval(Input::get('length'));
        $iDisplayStart = intval(Input::get('start'));
        $sEcho = intval(Input::get('draw'));

        $arrResults = CmsPage::getRecordList($filterArr);
        // print_r($arrResults);
        // exit();
        $iTotalRecords = CommonModel::getRecordCount($filterArr, true);
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (!empty($arrResults)) {
            foreach ($arrResults as $key => $value) {
                //if(Auth::user()->can($value->modules->varModuleName.'-list'))
                //{
                $records['data'][] = $this->tableData($value);
                //}
            }
        }


        if (!empty(Input::get("customActionType")) && Input::get("customActionType") == "group_action") {
            $records["customActionStatus"] = "OK";
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
        exit;
    }

    public function edit($id = false) {
        $modules = Modules::getModuleList();
        $templateData = array();
        if (is_numeric($id) && !empty($id)) {
            $Cmspage = CmsPage::getRecordById($id);
            if (count((array)($Cmspage)) == 0) {
                return redirect()->route('powerpanel.pages.add');
            }
            $templateData['Cmspage'] = $Cmspage;
            $metaInfo['varMetaTitle'] = $Cmspage['varMetaTitle'];
            $metaInfo['varMetaKeyword'] = $Cmspage['varMetaKeyword'];
            $metaInfo['varMetaDescription'] = $Cmspage['varMetaDescription'];

            $this->breadcrumb['title'] = trans('template.common.edit') . ' - ' . $Cmspage->varTitle;
            $this->breadcrumb['inner_title'] = trans('template.common.edit') . ' - ' . $Cmspage->varTitle;
            if ($Cmspage->alias->varAlias != 'home') {
                $templateData['publishActionDisplay'] = true;
            }
        } else {

            $this->breadcrumb['title'] = trans('template.pageModule.add');
            $this->breadcrumb['inner_title'] = trans('template.pageModule.add');
            $templateData['publishActionDisplay'] = true;
        }

        $this->breadcrumb['module'] = trans('template.pageModule.manage');
        $this->breadcrumb['url'] = 'powerpanel/pages';
        $templateData['modules'] = $modules;
        $templateData['breadcrumb'] = $this->breadcrumb;
        $templateData['metaInfo'] = (!empty($metaInfo) ? $metaInfo : '');



        return view('powerpanel.cms_pages.actions', $templateData);
    }

    public function handlePost(Request $request, Guard $auth) {

        $data = Input::get();
        $rules = array(
            'title' => 'required|max:160',
            'module' => 'required',
            'varMetaTitle' => 'required|max:500',
            'varMetaKeyword' => 'required|max:500',
            'varMetaDescription' => 'required|max:500',
            'chrMenuDisplay' => 'required',
            'alias' => 'required',
        );
        $messsages = array(
            'varMetaTitle.required' => trans('template.pageModule.metaTitle'),
            'varMetaKeyword.required' => trans('template.pageModule.metaKeyword'),
            'varMetaDescription.required' => trans('template.pageModule.metaDescription'),
        );
        $validator = Validator::make($data, $rules, $messsages);
        if ($validator->passes()) {

            $moduleCode = $data['module'];
            $cmsPageArr = [];
            $cmsPageArr['varTitle'] = trim($data['title']);
            $cmsPageArr['intFKModuleCode'] = $moduleCode;
            $cmsPageArr['txtDescription'] = $data['contents'];
            $cmsPageArr['chrPublish'] = $data['chrMenuDisplay'];
            $cmsPageArr['varMetaTitle'] = trim($data['varMetaTitle']);
            $cmsPageArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
            $cmsPageArr['varMetaDescription'] = trim($data['varMetaDescription']);

            $id = $request->segment(3);
            if (is_numeric($id) && !empty($id)) {
                #Edit post Handler=======
                $cmsPage = CmsPage::getRecordForLogById($id);

                if ($data['oldAlias'] != $data['alias']) {
                    Alias::updateAlias($data['oldAlias'], $data['alias']);
                }
                $whereConditions = ['id' => $cmsPage->id];
                $update = CommonModel::updateRecords($whereConditions, $cmsPageArr);
                if ($update) {
                    $newCmsPageObj = CmsPage::getRecordForLogById($cmsPage->id);

                    #Update record in menu
                    $whereConditions = ['txtPageUrl' => $data['oldAlias']];
                    $updateMenuFields = [
                        'varTitle' => $newCmsPageObj->varTitle,
                        'txtPageUrl' => $newCmsPageObj->alias->varAlias,
                        'chrPublish' => $data['chrMenuDisplay'],
                        'chrActive' => $data['chrMenuDisplay']
                    ];
                    CommonModel::updateRecords($whereConditions, $updateMenuFields, false, '\\App\\Menu');
                    #Update record in menu

                    $logArr = MyLibrary::logData($cmsPage->id);
                    if (Auth::user()->can('log-advanced')) {
                        $oldRec = $this->recordHistory($cmsPage);
                        $newRec = $this->recordHistory($newCmsPageObj);
                        $logArr['old_val'] = $oldRec;
                        $logArr['new_val'] = $newRec;
                    }

                    $logArr['varTitle'] = $newCmsPageObj->varTitle;
                    Log::recordLog($logArr);

                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($cmsPage->id, $newCmsPageObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                }
            } else {

                #Add post Handler=======
                $cmsPageArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
                $cmsPageArr['created_at'] = Carbon::now();
                $id = CommonModel::addRecord($cmsPageArr);
                if (isset($id) && !empty($id)) {
                    $newCmsPageObj = CmsPage::getRecordForLogById($id);
                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newCmsPageObj->varTitle;
                    Log::recordLog($logArr);

                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newCmsPageObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                }
            }

            if (!empty($request->saveandexit) && $request->saveandexit == 'saveandexit') {
                return redirect()->route('powerpanel.pages.index')->with('message', trans('template.pageModule.pageUpdate'));
            } else {
                return redirect()->route('powerpanel.pages.edit', $id)->with('message', trans('template.pageModule.pageUpdate'));
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    /**
     * This method destroys Banner in multiples
     * @return  Banner index view
     * @since   2016-10-25
     * @author  NetQuick
     */
    public function DeleteRecord(Request $request) {
        $data = $request->all('ids');
        foreach ($data['ids'] as $update) {
            $Cmspage = CmsPage::getRecordById($update);
            $whereConditions = ['txtPageUrl' => $Cmspage->alias->varAlias];
            $updateMenuFields = ['chrDelete' => 'Y', 'chrPublish' => 'N', 'chrActive' => 'N', 'chrDelete' => 'Y'];
            CommonModel::updateRecords($whereConditions, $updateMenuFields, false, '\\App\\Menu');
        }
        $updates = MyLibrary::deleteMultipleRecords($data);
        self::flushCache();
        echo json_encode($updates);
        exit;
    }

    /**
     * This method handle publish-unpublish features.
     * @return  true/false
     * @since   2017-07-24
     * @author  NetQuick
     */
    public function publish(Request $request) {
        $alias = Input::get('alias');
        $update = MyLibrary::setPublishUnpublish($alias, $request);
        $pageId = $alias;
        $state = Input::get('val') == 'Unpublish' ? 'N' : 'Y';
        $whereConditions = ['intPageId' => $pageId];
        $updateMenuFields = ['chrPublish' => $state, 'chrActive' => $state];
        CommonModel::updateRecords($whereConditions, $updateMenuFields, false, '\\App\\Menu');
        self::flushCache();
        echo json_encode($update);
        exit;
    }

    public function tableData($value = false) {

        //if(Auth::user()->can($value->modules->varModuleName.'-list'))
        //{
        $webHits = Pagehit::where('isWeb', 'Y')->where('fkIntAliasId', $value->id)->count();
        $mobileHits = Pagehit::where('isWeb', 'N')->where('fkIntAliasId', $value->id)->count();
        $actions = '';
        $publish_action = '';
//        $actions = '<a class="without_bg_icon" href="' . url('powerpanel/menu') . '" title="Add to menu"><i class="fa fa-list"></i></a>';
        if ($value->modules->varModuleName == "pages" || $value->modules->varModuleName == "sitemap") {
            $manageRecordsLink = $value->modules->varTitle;
        } else {
            $manageRecordsLink = '<a class="" title="' . trans("template.common.manageRecords") . '" href="' . url('powerpanel/' . $value->modules->varModuleName) . '">' . $value->modules->varTitle . '</a>';
        }


        if (Auth::user()->can('pages-edit')) {
            $actions .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.pages.edit', array('alias' => $value->id)) . '">
							<i class="fa fa-pencil"></i></a>';
        }

        if (Auth::user()->can('pages-publish')) {
            if ($value->alias->varAlias != 'home') {
                if ($value->chrPublish == 'Y') {
                    $publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/pages" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
                } else {
                    $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/pages" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
                }
            }
        }

        if (Auth::user()->can('pages-delete')) {
            if ($value->alias->varAlias != 'home') {
                if ($value->modules->varModuleName == "pages") {
                    $actions .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="pages" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
                }
            }
        }

        $checkbox = '<a href="javascript:;" data-toggle="tooltip" data-placement="right" data-toggle="tooltip" title="This is module page so can&#39;t be deleted."><i style="color:red" class="fa fa-exclamation-triangle"></i></a>';
        if ($value->modules->varModuleName == "pages") {
            if ($value->alias->varAlias != "home") {
                $checkbox = '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">';
            }
        }

        $title = $value->varTitle;
        if (Auth::user()->can('pages-edit')) {
            $title = '<a class="" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.pages.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
        }

        $records = array(
            $checkbox,
            $title,
            $manageRecordsLink,
            $webHits,
            $mobileHits,
            $publish_action,
            $actions,
        );
        //}

        return $records;
    }

    /**
     * This method handels logs History records
     * @param   $data
     * @return  HTML
     * @since   2017-07-27
     * @author  NetQuick
     */
    public function recordHistory($data = false) {
        $returnHtml = '';
        $returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>' . trans("template.common.title") . '</th>
						<th>' . trans("template.common.modulename") . '</th>
						<th>' . trans("template.common.content") . '</th>
						<th>' . trans("template.common.metatitle") . '</th>
						<th>' . trans("template.common.metakeyword") . '</th>
						<th>' . trans("template.common.metadescription") . '</th>
						<th>' . trans("template.common.publish") . '</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>' . $data->varTitle . '</td>
						<td>' . $data->modules->varModuleName . '</td>
						<td>' . $data->txtDescription . '</td>
						<td>' . $data->varMetaTitle . '</td>
						<td>' . $data->varMetaKeyword . '</td>
						<td>' . $data->varMetaDescription . '</td>
						<td>' . $data->chrPublish . '</td>
					</tr>
				</tbody>
			</table>';
        return $returnHtml;
    }

    public function flushCache() {
        Cache::forget('getPageByPageId');
    }

}
