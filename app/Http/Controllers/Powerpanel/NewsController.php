<?php

namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Carbon\Carbon;
use App\News;
use App\NewsCategory;
use App\Modules;
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
use Config;
use App\Helpers\resize_image;
use App\Helpers\AddImageModelRel;
use App\Helpers\AddVideoModelRel;
use Cache;
use App\Helpers\Category_builder;
use App\Helpers\CategoryArrayBuilder;
use URL;

class NewsController extends PowerpanelController {

    public $catModule;

    public function __construct() {
        parent::__construct();
        if (isset($_COOKIE['locale'])) {
            app()->setLocale($_COOKIE['locale']);
        }
    }

    /**
     * This method handels load process of news
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function index() {
        $iTotalRecords = CommonModel::getRecordCount();
        $NewsCategory = $iTotalRecords > 0 ? NewsCategory::getCatWithParent() : null;
        $this->breadcrumb['title'] = trans('template.newsModule.manageNews');
        $breadcrumb = $this->breadcrumb;
        return view('powerpanel.news.index', compact('NewsCategory', 'iTotalRecords', 'breadcrumb'));
    }

    /**
     * This method loads news edit view
     * @param   Alias of record
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function edit($id = false) {
        $category = NewsCategory::getCatWithParent();
        $category = CategoryArrayBuilder::getArray($category);
        $NewsCategory = json_encode($category);

        $imageManager = true;
        $videoManager = true;
        $categoryHeirarchy = Category_builder::Parentcategoryhierarchy(false, false, '\App\NewsCategory');
        if (!is_numeric($id)) {
            $total = CommonModel::getRecordCount();
            $total = $total + 1;
            $this->breadcrumb['title'] = trans('template.newsModule.addNews');
            $this->breadcrumb['module'] = trans('template.newsModule.manageNews');
            $this->breadcrumb['url'] = 'powerpanel/news';
            $this->breadcrumb['inner_title'] = trans('template.newsModule.addNews');
            $breadcrumb = $this->breadcrumb;
            $data = compact('total', 'NewsCategory', 'breadcrumb', 'imageManager', 'videoManager', 'categoryHeirarchy');
        } else {
            $news = News::getRecordById($id);
            if ($news == false) {
                return redirect()->route('powerpanel.news.add');
            }
            $metaInfo = array('varMetaTitle' => $news->varMetaTitle, 'varMetaKeyword' => $news->varMetaKeyword, 'varMetaDescription' => $news->varMetaDescription);
            $this->breadcrumb['title'] = trans('template.newsModule.editNews') . ' - ' . $news->varTitle;
            $this->breadcrumb['module'] = trans('template.newsModule.manageNews');
            $this->breadcrumb['url'] = 'powerpanel/news';
            $this->breadcrumb['inner_title'] = trans('template.newsModule.editNews') . ' - ' . $news->varTitle;
            $breadcrumb = $this->breadcrumb;
            $data = compact('news', 'NewsCategory',  'metaInfo', 'breadcrumb', 'imageManager', 'videoManager', 'categoryHeirarchy');
        }
        return view('powerpanel.news.actions', $data);
    }

    /**
     * This method stores news modifications
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function handlePost(Request $request) {
        $data = Input::get();
        $rules = array(
            'title' => 'required|max:160',
            'display_order' => 'required|greater_than_zero',
            'chrMenuDisplay' => 'required',
            'varMetaTitle' => 'required|max:500',
            'varMetaKeyword' => 'required|max:500',
            'varMetaDescription' => 'required|max:500',
            'short_description' => 'required',
            'alias' => 'required'
        );
        $actionMessage = trans('template.common.oppsSomethingWrong');
        $messsages = array(
            'category_id.required' => trans('template.newsModule.categoryMessage'),
            'display_order.greater_than_zero' => trans('template.newsModule.displayGreaterThan')
        );
        $validator = Validator::make($data, $rules, $messsages);
        if ($validator->passes()) {
            $newsArr = [];
            $newsArr['varTitle'] = trim($data['title']);
            $newsArr['fkIntImgId'] = !empty($data['img_id']) ? $data['img_id'] : null;
            $newsArr['fkIntVideoId'] = !empty($data['video_id']) ? $data['video_id'] : null;
            $newsArr['dtDateTime'] = !empty($data['start_date']) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['start_date']))) : date('Y-m-d H:i:s');
            $newsArr['txtCategories'] = isset($data['category_id']) ? serialize($data['category_id']) : null;
            $newsArr['txtDescription'] = $data['description'];
            $newsArr['varShortDescription'] = $data['short_description'];
            $newsArr['varExternalLink'] = !empty($data['varExternalLink']) ? $data['varExternalLink'] : '';
            $newsArr['varMetaTitle'] = trim($data['varMetaTitle']);
            $newsArr['varMetaKeyword'] = trim($data['varMetaKeyword']);
            $newsArr['varMetaDescription'] = trim($data['varMetaDescription']);
            $newsArr['chrPublish'] = $data['chrMenuDisplay'];
            // print_r($clientIP = \Request::ip());exit;
            $newsArr['varIpAddress'] = $request->ip();
            $newsArr['varRefURL'] = $data['varRefURL'];
// print_r($newsArr);exit;
            $id = $request->segment(3);
            if (is_numeric($id)) { #Edit post Handler=======
                if ($data['oldAlias'] != $data['alias']) {
                    Alias::updateAlias($data['oldAlias'], $data['alias']);
                }
                $news = News::getRecordForLogById($id);
                $whereConditions = ['id' => $news->id];
                $update = CommonModel::updateRecords($whereConditions, $newsArr);
                if ($update) {
                    if (!empty($id)) {
                        self::swap_order_edit($data['display_order'], $news->id);

                        $logArr = MyLibrary::logData($news->id);
                        if (Auth::user()->can('log-advanced')) {
                            $newNewsObj = News::getRecordForLogById($news->id);
                            $oldRec = $this->recordHistory($news);
                            $newRec = $this->recordHistory($newNewsObj);
                            $logArr['old_val'] = $oldRec;
                            $logArr['new_val'] = $newRec;
                        }
                        $logArr['varTitle'] = trim($data['title']);
                        Log::recordLog($logArr);

                        if (Auth::user()->can('recent-updates-list')) {
                            if (!isset($newNewsObj)) {
                                $newNewsObj = News::getRecordForLogById($news->id);
                            }
                            $notificationArr = MyLibrary::notificationData($news->id, $newNewsObj);
                            RecentUpdates::setNotification($notificationArr);
                        }
                        self::flushCache();
                        $actionMessage = trans('template.newsModule.updateMessage');
                    }
                }
            } else { #Add post Handler=======
                $newsArr['intAliasId'] = MyLibrary::insertAlias($data['alias']);
                $newsArr['intDisplayOrder'] = self::swap_order_add($data['display_order']);
                $newsID = CommonModel::addRecord($newsArr);
                if (!empty($newsID)) {
                    $id = $newsID;
                    $newNewsObj = News::getRecordForLogById($id);

                    $logArr = MyLibrary::logData($id);
                    $logArr['varTitle'] = $newNewsObj->varTitle;
                    Log::recordLog($logArr);

                    if (Auth::user()->can('recent-updates-list')) {
                        $notificationArr = MyLibrary::notificationData($id, $newNewsObj);
                        RecentUpdates::setNotification($notificationArr);
                    }
                    self::flushCache();
                    $actionMessage = trans('template.newsModule.addMessage');
                }
            }

            AddImageModelRel::sync(explode(',', $data['img_id']), $id);
            // AddVideoModelRel::sync(explode(',', $data['video_id']), $id);

            if (!empty($data['saveandexit']) && $data['saveandexit'] == 'saveandexit') {
                return redirect()->route('powerpanel.news.index')->with('message', $actionMessage);
            } else {
                return redirect()->route('powerpanel.news.edit', $id)->with('message', $actionMessage);
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    /**
     * This method loads news table data on view
     * @return  View
     * @since   2017-11-10
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
        $filterArr['catFilter'] = !empty(Input::get('catValue')) ? Input::get('catValue') : '';
        $filterArr['searchFilter'] = !empty(Input::get('searchValue')) ? Input::get('searchValue') : '';
        $filterArr['iDisplayLength'] = intval(Input::get('length'));
        $filterArr['iDisplayStart'] = intval(Input::get('start'));
        $filterArr['rangeFilter'] = !empty(Input::get('rangeFilter')) ? Input::get('rangeFilter') : '';
        if (!empty($filterArr['rangeFilter'])) {
            $date = Carbon::createFromFormat(Config::get('Constant.DEFAULT_DATE_FORMAT'), $filterArr['rangeFilter']['from']);
            $filterArr['rangeFilter']['from'] = $date->format('Y-m-d');
        }

        if (!empty($filterArr['rangeFilter'])) {
            $date = Carbon::createFromFormat(Config::get('Constant.DEFAULT_DATE_FORMAT'), $filterArr['rangeFilter']['to']);
            $filterArr['rangeFilter']['to'] = $date->format('Y-m-d');
        }
        $sEcho = intval(Input::get('draw'));
        $arrResults = News::getRecordList($filterArr);
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

    public function tableData($value = false) {
        $details = '';
        $publish_action = '';
        $webHits = Pagehit::where('isWeb', 'Y')->where('fkIntAliasId', $value->id)->where('intFKModuleCode','19')->count();
        $mobileHits = Pagehit::where('isWeb', 'N')->where('fkIntAliasId', $value->id)->where('intFKModuleCode','19')->count();
        if (Auth::user()->can('news-edit')) {
            $details .= '<a class="without_bg_icon" title="' . trans("template.common.edit") . '" href="' . route('powerpanel.news.edit', array('alias' => $value->id)) . '"><i class="fa fa-pencil"></i></a>';
        }
        if (Auth::user()->can('news-delete')) {
            $details .= '&nbsp;<a class="without_bg_icon delete" title="' . trans("template.common.delete") . '" data-controller="news" data-alias = "' . $value->id . '"><i class="fa fa-times"></i></a>';
        }

        if (Auth::user()->can('news-publish')) {
            if (!empty($value->chrPublish) && ($value->chrPublish == 'Y')) {
                $publish_action .= '<input data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/news" title="' . trans("template.common.publishedRecord") . '" data-value="Unpublish" data-alias="' . $value->id . '">';
            } else {
                $publish_action .= '<input checked="" data-off-text="No" data-on-text="Yes" class="make-switch publish" class="make-switch publish" data-off-color="info" data-on-color="primary" type="checkbox" data-controller="powerpanel/news" title="' . trans("template.common.unpublishedRecord") . '" data-value="Publish" data-alias="' . $value->id . '">';
            }
        }

        // $details .='<a class="without_bg_icon share" title="Share" data-table="news" data-alias="'.$value->id.'" data-link = "'.url('/news/'.$value->id).'" data-toggle="modal" data-target="#confirm_share">
        // 	<i class="fa fa-share-alt"></i></a>';

        $minus = '<span class="glyphicon glyphicon-minus"></span>';
        $imgIcon = '';
        $imgIcon = '<div class="text-center">';
        if (!empty($value->fkIntImgId)) {
            $imgIcon .= '<a href="' . resize_image::resize($value->fkIntImgId) . '" class="fancybox-buttons" data-rel="fancybox-buttons">';
            $imgIcon .= '<img height="30" width="30" title="' . preg_replace('/[^A-Za-z0-9\-]/', '-', $value->varTitle) . '" src="' . resize_image::resize($value->fkIntImgId, 50, 50) . '"/>';
            $imgIcon .= '</a>';
        } else {
            $imgIcon .= '<span class="glyphicon glyphicon-minus"></span>';
        }
        $imgIcon .= '</div>';

        $category = '';
        if (isset($value->txtCategories)) {
            $categoryIDs = unserialize($value->txtCategories);
            $selCategory = NewsCategory::getParentCategoryNameBycatId($categoryIDs);
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

        if (Auth::user()->can('news-edit')) {
            $title = '<a class="" title="Edit" href="' . route('powerpanel.news.edit', array('alias' => $value->id)) . '">' . $value->varTitle . '</a>';
        } else {
            $title = $value->varTitle;
        }
        $records = array(
            '<input type="checkbox" name="delete" class="chkDelete" value="' . $value->id . '">',
            $title,
            '<div class="pro-act-btn">
					<a href="javascript:void(0)" class="without_bg_icon highslide-active-anchor" onclick="return hs.htmlExpand(this,{width:300,headingText:\'' . trans("template.common.description") . '\',wrapperClassName:\'titlebar\',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
						<div class="highslide-maincontent">' . $value->txtDescription . '</div>
					</div>',
            $imgIcon,
            date('' . Config::get('Constant.DEFAULT_DATE_FORMAT') . ' ' . Config::get('Constant.DEFAULT_TIME_FORMAT') . '', strtotime($value->dtDateTime)),
            $webHits,
            $mobileHits,
            $category,
//            '<a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveUp"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 
//					' . $value->intDisplayOrder .
//            ' <a href="javascript:;" data-order="' . $value->intDisplayOrder . '" class="moveDwn"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>',
            $publish_action,
            $details,
            $value->intDisplayOrder
        );
        return $records;
    }

    /**
     * This method delete multiples news
     * @return  true/false
     * @since   2017-07-15
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
     * This method handels swapping of available order record while adding
     * @param   order
     * @return  order
     * @since   2016-10-21
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
     * @param   order
     * @return  order
     * @since   2016-12-23
     * @author  NetQuick
     */
    public static function swap_order_edit($order = null, $id = null) {
        MyLibrary::swapOrderEdit($order, $id);
        self::flushCache();
    }

    /**
     * This method destroys Banner in multiples
     * @return  Banner index view
     * @since   2016-10-25
     * @author  NetQuick
     */
    public function publish(Request $request) {
        $alias = Input::get('alias');
        $update = MyLibrary::setPublishUnpublish($alias, $request);
        self::flushCache();
        echo json_encode($update);
        exit;
    }

    public function recordHistory($data = false) {
        $returnHtml = '';
        $returnHtml .= '<table class="new_table_desing table table-striped table-bordered table-hover">
				<thead>
						<tr>
								<th>' . trans("template.common.title") . '</th>
								<th>' . trans("template.common.image") . '</th>
								<th>' . trans("template.common.description") . '</th>
								<th>' . trans("template.common.dateandtime") . '</th>
								<th>' . trans("template.common.order") . '</th>
								<th>' . trans("template.common.metatitle") . '/th>
								<th>' . trans("template.common.metakeyword") . '</th>
								<th>' . trans("template.common.metadescription") . '</th>
								<th>' . trans("template.common.publish") . '</th>
						</tr>
				</thead>
				<tbody>
						<tr>
								<td>' . $data->varTitle . '</td>';
        if ($data->fkIntImgId > 0) {
            $returnHtml .= '<td>' . '<img height="50" width="50" src="' . resize_image::resize($data->fkIntImgId) . '" />' . '</td>';
        } else {
            $returnHtml .= '<td>-</td>';
        }
        $returnHtml .= '<td>' . $data->txtDescription . '</td>
								<td>' . $data->dtDateTime . '</td>
								<td>' . ($data->intDisplayOrder) . '</td>
								<td>' . $data->varMetaTitle . '</td>
								<td>' . $data->varMetaKeyword . '</td>
								<td>' . $data->varMetaDescription . '</td>
								<td>' . $data->chrPublish . '</td>
						</tr>
				</tbody>
				</table>';
        return $returnHtml;
    }

    public static function flushCache() {
        Cache::tags('News')->flush();
        Cache::tags('NewsCategory')->flush();
    }

}
