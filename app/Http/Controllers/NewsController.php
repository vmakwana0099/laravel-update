<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Http\Traits\slug;
use App\Http\Requests;
use App\CmsPage;

class NewsController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $NewsData = [];
        $NewsData['NewsData'] = News::getFrontList();
        $pagename = $request->segment(1);
        $aliasId = slug::resolve_alias($pagename);
        $NewsData['CmsData'] = CmsPage::getPageContentByPageAlias($aliasId);
        return view('news', $NewsData);
    }

    public function detail($alias) {
        $id = slug::resolve_alias($alias);
        $news = News::getFrontDetail($id);
        if (count($news) > 0) {
            $ProId = News::getNewsId($id);
            if(!empty($ProId->id)){
            $MetaData = MyLibrary::getMetaDetails($ProId->id, 'news');
            $Data['PageHits'] = News::PageHits($ProId->id);
            $breadcrumb = [];
            $breadcrumb['title'] = (!empty($news->varTitle)) ? ucwords($news->varTitle) : '';
            $breadcrumb['url'] = 'news';
            $breadcrumb = $breadcrumb;
            $detailPageTitle = $breadcrumb['title'];
            $META_TITLE = $MetaData->varMetaTitle;
            $META_KEYWORD = $MetaData->varMetaKeyword;
            $META_DESCRIPTION = $MetaData->varMetaDescription;
            return view('news-detail', compact('detailPageTitle', 'Data', 'news', 'alias', 'breadcrumb', 'META_TITLE', 'META_DESCRIPTION', 'META_KEYWORD'));
            }   
            else { abort(404); }
        } else {
            abort(404);
        }
    }

}
