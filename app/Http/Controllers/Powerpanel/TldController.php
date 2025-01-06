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
use App\Tld;
use App\Pagehit;
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

class TldController extends PowerpanelController {

    public function __construct() {
        parent::__construct();
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
    }

    /**
     * This method handels loading process of tld
     * @return  View
     * @since   2017-07-20
     * @author  NetQuick
     */
    public function index() {
        $iTotalRecords = CommonModel::getRecordCount();
        $this->breadcrumb['title'] = trans('template.tldModule.managetld');
        $breadcrumb = $this->breadcrumb;
        return view('powerpanel.tld.index', compact('iTotalRecords', 'breadcrumb'));
    }

    /**
     * This method loads tld edit view
     * @param  	Alias of record
     * @return  View
     * @since   2017-07-21
     * @author  NetQuick
     */
    public function edit($alias = false) {
        $TldCategoryselect = array();
        $moduleFields_cat = ['varTitle as text', 'id'];
        $TldCategory = Tld::getTLDCat($moduleFields_cat);
        $imageManager = true;
        if (!is_numeric($alias)) {
            $total = CommonModel::getRecordCount();
            $total = $total + 1;
            $this->breadcrumb['title'] = trans('template.tldModule.addTldMember');
            $this->breadcrumb['module'] = trans('template.tldModule.managetld');
            $this->breadcrumb['url'] = 'powerpanel/tld';
            $this->breadcrumb['inner_title'] = trans('template.tldModule.addTldMember');
            $breadcrumb = $this->breadcrumb;
            $data = compact('total', 'breadcrumb', 'imageManager', 'TldCategory', 'TldCategoryselect');
        } else {
            $id = $alias;
            $tld = Tld::getRecordById($id);
            if (!empty($tld->varCategory)) {
                $myArray = explode(',', $tld->varCategory);
                $TldCategoryselect = $myArray;
            }
            if (count((array)($tld)) == 0) {
                return redirect()->route('powerpanel.tld.add');
            }
            $metaInfo = array(
                'varMetaTitle' => $tld->varMetaTitle,
                'varMetaKeyword' => $tld->varMetaKeyword,
                'varMetaDescription' => $tld->varMetaDescription
            );
            $this->breadcrumb['title'] = trans('template.tldModule.editTldMember') . ' - ' . $tld->varTitle;
            $this->breadcrumb['module'] = trans('template.tldModule.managetld');
            $this->breadcrumb['url'] = 'powerpanel/tld';
            $this->breadcrumb['inner_title'] = trans('template.tldModule.editTldMember') . ' - ' . $tld->varTitle;
            $breadcrumb = $this->breadcrumb;
            $data = compact('tld',  'metaInfo', 'breadcrumb', 'imageManager',  'TldCategory', 'TldCategoryselect');
        }
        return view('powerpanel.tld.actions', $data);
    }

    /**
     * This method stores team modifications
     * @return  View
     * @since   2017-07-21
     * @author  NetQuick
     */
    public function handlePost(Request $request) {
        $data = Input::get();
        $cat = implode(",", $data['TldCategory']);
        $messsages = array(
            'display_order.greater_than_zero' => trans('template.tldModule.displayGreaterThan'),
        );
        $rules = array(
            'name' => 'required|max:160',
            'icon' => 'required|max:160',
            'offer' => 'required|max:160',
            'description' => 'required',
            'img_id' => 'required',
            'display_order' => 'required|greater_than_zero',
            'varMetaTitle' => 'required|max:500',
            'varMetaKeyword' => 'required|max:500',
            'varMetaDescription' => 'required|max:500',
            'chrMenuDisplay' => 'required',
            'alias' => 'required'
        );
        $validator = Validator::make($data, $rules, $messsages);
        if ($validator->passes()) {
            $id = $request->segment(3);
            $actionMessage = trans('template.common.oppsSomethingWrong');
            if (is_numeric($id)) { #Edit post Handler=======
                if ($data['oldAlias'] != $data['alias']) {
                    Alias::updateAlias($data['oldAlias'], $data['alias']);
                }
                $tld = Tld::getRecordForLogById($id);
                $updateTldFields = [
                    'varTitle' => trim($data['name']),
                    'varIcon' => trim($data['icon']),
                    'varCountryName' => trim($data['country_name']),
                    'varOffer' => trim($data['offer']),
                    'fkIntImgId' => !empty($data['img_id']) ? $data['img_id'] : null,
                    'txtDescription' => $data['description'],
                    'txtShortDescription' => $data['short_description'],
                    'chrIsFeatured' => $data['featured'],
                    'chrIsLanding' => $data['landing'],
                    'chrIsCountry' => $data['country'],
                    'chrIsNewTld' => $data['newtld'],
                    'chrIsoffertld' => $data['offertld'],
                    'varCategory' => $cat,
                    'varIpAddress' => $request->ip(),
                    'varRefURL' => $data['varRefURL'],
                    'varMetaTitle' => trim($data['varMetaTitle']),
                    'varMetaKeyword' => trim($data['varMetaKeyword']),
                    'varMetaDescription' => trim($data['varMetaDescription']),
                    'chrPublish' => $data['chrMenuDisplay']
                ];
                $whereConditions = ['id' => $tld->id];
                $update = CommonModel::updateRecords($whereConditions, $updateTldFields);

                if ($update) {
                    if (!empty($id)) {
                        self::swap_order_edit($data['display_order'], $tld->id);

                        $logArr = MyLibrary::logData($tld->id);
                        if (Auth::user()->can('log-advanced')) {
                            $newTldObj = Tld::getRecordForLogById($tld->id);
                            $oldRec = $this->recordHistory($tld);
                            $newRec = $this->recordHistory($newTldObj);
                            $logArr['old_val'] = $oldRec;
                            $logArr['new_val'] = $newRec;
                        }

                        $logArr['varTitle'] = trim($data['name']);
                        Log::recordLog($logArr);

                        if (Auth::user()->can('recent-updates-list')) {
                            if (!isset($newTldObj)) {
                                $newTldObj = Tld::getRecordForLogById($tld->id);
                            }
                            $notificationArr = MyLibrary::notificationData($tld->id, $newTldObj);
                            RecentUpdates::setNotification($notificationArr);
                        }
                        self::flushCache();
                        $actionMessage = trans('template.tldModule.updateMessage');
                    }
                }
            } else { #Add post Handler=======
                $tldArr = [];
                $tldArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
                $tldArr['varTitle'] = trim($data['name']);
                $tldArr['varIcon'] = trim($data['icon']);
                $tldArr['varCountryName'] = trim($data['country_name']);
                $tldArr['varOffer'] = trim($data['offer']);
                $tldArr['chrIsFeatured'] = $data['featured'];
                $tldArr['chrIsLanding'] = $data['landing'];
                $tldArr['chrIsCountry'] = $data['country'];
                $tldArr['chrIsNewTld'] = $data['newtld'];
                $tldArr['chrIsoffertld'] = $data['offertld'];
                $tldArr['fkIntImgId'] = !empty($data['img_id']) ? $data['img_id'] : null;
                $tldArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
                $tldArr['txtDescription'] = trim($data['description']);
                $tldArr['txtShortDescription'] = trim($data['short_description']);
                $tldArr['varCategory'] = $cat;
                $tldArr['chrPublish'] = $data['chrMenuDisplay'];
                $tldArr['varIpAddress'] = $request->ip();
                $tldArr['varRefURL'] = $data['varRefURL'];
                $tldArr['varMetaTitle'] = trim($data['varMetaTitle']);
                $tldArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
                $tldArr['varMetaDescription'] = trim($data['varMetaDescription']);
                $tldArr['created_at'] = Carbon::now();

                $tldID = CommonModel::addRecord($tldArr);

                if (!empty($tldID)) {
                    $id = $tldID;
                    $newTldObj = Tld::getRecordForLogById($id);
                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newTldObj->varTitle;
                    Log::recordLog($logArr);
                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newTldObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                    $actionMessage = trans('template.tldModule.addMessage');
                }
            }
            AddImageModelRel::sync(explode(',', $data['img_id']), $id);
            if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
                return redirect()->route('powerpanel.tld.index')->with('message', $actionMessage);
            } else {
                return redirect()->route('powerpanel.tld.edit', $id)->with('message', $actionMessage);
            }
        } else {
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
        $filterArr['featuredfilter'] = !empty(Input::get('customActionName_feature')) ? Input::get('customActionName_feature') : '';
        $filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';

        $filterArr['iDisplayLength'] = intval(Input::get('length'));
        $filterArr['iDisplayStart'] = intval(Input::get('start'));
        $sEcho = intval(Input::get('draw'));
//        echo "<pre>";
//        print_r($filterArr);
//        exit;
        $arrResults = Tld::getRecordList($filterArr);
        $iTotalRecords = CommonModel::getRecordCount($filterArr, true);
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
        $order = Input::get('order');
        $exOrder = Input::get('exOrder');
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
    public static function swap_order_edit($order = null, $id = null) {
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
    public function makeFeatured() {
        $id = Input::get('id');
        $featured = Input::get('featured');
        $whereConditions = ['id' => $id];
        $update = CommonModel::updateRecords($whereConditions, ['chrIsFeatured' => $featured]);
        self::flushCache();
        echo json_encode($update);
    }

    public function recordHistory($data = false) {
        $returnHtml = '';
        $returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">
        <thead>
                <tr>
                                <th>' . trans("template.common.title") . '</th>
                                <th>' . trans("template.tldModule.tagline") . '</th>
                                <th>' . trans("template.common.order") . '</th>
                                <th>' . trans("template.common.description") . '</th>
                                <th>' . trans("template.common.image") . '</th>
                                <th>' . trans("template.common.metatitle") . '/th>
                                <th>' . trans("template.common.metakeyword") . '</th>
                                <th>' . trans("template.common.metadescription") . '</th>
                                <th>' . trans("template.common.publish") . '</th>
                </tr>
        </thead>
        <tbody>
                <tr>
                        <td>' . $data->varTitle . '</td>
                        <td>' . $data->varIcon . '</td>
                        <td>' . ($data->intDisplayOrder) . '</td>
                        <td>' . $data->txtDescription . '</td>';
        if ($data->fkIntImgId > 0) {
            $returnHtml .= '<td>' . '<img height="50" width="50" src="' . resize_image::resize($data->fkIntImgId) . '" />' . '</td>';
        } else {
            $returnHtml .= '<td>-</td>';
        }
        $returnHtml .= '<td>' . $data->varMetaTitle . '</td>
											<td>' . $data->varMetaKeyword . '</td>
											<td>' . $data->varMetaDescription . '</td>
											<td>' . $data->chrPublish . '</td>
										</tr>
									</tbody>
								</table>';
        return $returnHtml;
    }

    public function tableData($value = false) {
        $publish_action = '';
        $details = '';
        $webHits = Pagehit::where('isWeb', 'Y')->where('fkIntAliasId', $value->id)->count();
        $mobileHits = Pagehit::where('isWeb', 'N')->where('fkIntAliasId', $value->id)->count();
        if (Auth::user()->can('tld-edit')) {
            $details .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '"  href="' . route('powerpanel.tld.edit', array('alias' => $value->id)) . '">
					<i class="fa fa-pencil"></i></a>';
        }
        if (Auth::user()->can('tld-delete')) {
            $details .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="tld" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
        }

        if (Auth::user()->can('tld-publish')) {
            if ($value->chrPublish == 'Y') {
                $publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/tld" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
            } else {
                $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/tld" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
            }
        }

        $image = '<div class="text-center">';
        if (!empty($value->fkIntImgId)) {
            $image .= '<a href="' . resize_image::resize($value->fkIntImgId, 204, 137) . '" class="fancybox-buttons" data-rel="fancybox-buttons">';
            $image .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) . '" src="' . resize_image::resize($value->fkIntImgId, 50, 50) . '"/>';
            $image .= '</a>';
        } else {
            $image .= '<span class="glyphicon glyphicon-minus"></span>';
        }
        $image .= '</div>';

        $Featured = '';
        if (!empty($value->chrIsFeatured)) {
            if ($value->chrIsFeatured == 'Y') {
                $Featured .= '<div style="text-align:center"><a href="javascript:makeFeatured(' . $value->id . ',\'N\');"><i class="fa fa-star" aria-hidden="true" ></i></a></div>';
            } else {
                $Featured .= '<div style="text-align:center"><a href="javascript:makeFeatured(' . $value->id . ',\'Y\');"><i class="fa fa-star-o" aria-hidden="true" ></i></a></div>';
            }
        } else {
            $Featured .= '<div style="text-align:center"><a href="javascript:makeFeatured(' . $value->id . ',\'Y\');"><i class="fa fa-star-o" aria-hidden="true"></i></a></div>';
        }
        $records = array(
            '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">',
            '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.tld.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>',
            '<div class="pro-act-btn">
				<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'' . trans("template.common.description") . '\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
				<div class="highslide-maincontent">' . $value->txtDescription . '</div>
				</div>',
            $Featured,
            $image,
            $webHits,
            $mobileHits,
            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
				' . $value->intDisplayOrder .
            ' <a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
            $publish_action,
            $details,
            $value->intDisplayOrder,
        );
        return $records;
    }

    public static function flushCache() {
        Cache::tags('Tld')->flush();
    }

}
