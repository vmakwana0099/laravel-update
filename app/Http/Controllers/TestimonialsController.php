<?php

namespace App\Http\Controllers;

use App\TestimonialsF;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Http\Traits\slug;
use App\Http\Requests;
use App\CmsPage;
use App\Alias;
use App\Video;

class TestimonialsController extends FrontController {
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
// echo '<pre>';print_r("helloo");exit;
        $TestimonialsData = [];

        $TestimonialsData['TestimonialsData'] = TestimonialsF::getFrontList();

        $pagename = $request->segment(1);
         
        $aliasId = slug::resolve_alias($pagename);
        $TestimonialsData['CmsData'] = CmsPage::getPageContentByPageAlias($aliasId);

        foreach ($TestimonialsData['TestimonialsData'] as $key => $value) {
            $value['videoIDAray'] = explode(',', $value->fkIntVideoId);
            $videoData = Video::getVideoData($value['videoIDAray']);
            $value['videoData'] = $videoData;
        }

        // echo '<pre>';print_r($TestimonialsData);exit;

        return view('testimonials', $TestimonialsData);
    }

    public function detail($alias) {

        $id = slug::resolve_alias($alias);
        
        $Testimonials = TestimonialsF::getFrontDetail($id);
        
        if (count((array)($Testimonials)) > 0) {
           
            $ProId = TestimonialsF::getTestimonialsId($id);
            
            $MetaData = MyLibrary::getMetaDetails($ProId->id, 'testimonials');
        	/*echo '<pre>';print_r("hello");exit;*/
             
            $Data['PageHits'] = TestimonialsF::PageHits($ProId->id);
            
            $breadcrumb = [];
            $breadcrumb['title'] = (!empty($Testimonials->varTitle)) ? ucwords($Testimonials->varTitle) : '';
            $breadcrumb['url'] = 'testimonials';
            $breadcrumb = $breadcrumb;
            $detailPageTitle = $breadcrumb['title'];
            $META_TITLE = $MetaData->varMetaTitle;
            $META_KEYWORD = $MetaData->varMetaKeyword;
            $META_DESCRIPTION = $MetaData->varMetaDescription;
            // $videoD = Video::getVideoData($Testimonials->fkIntVideoId);
            $videoIDAray = explode(',', $Testimonials->fkIntVideoId);
            $videoData = Video::getVideoData($videoIDAray);
            $Testimonials->videos = $videoData;
            // echo "<pre>";print_r($videoData);echo "</pre>";exit;
            // echo "<pre>";print_r($Testimonials);echo "</pre>";exit;
            return view('testimonials-details', compact('detailPageTitle', 'Data', 'Testimonials', 'alias', 'breadcrumb', 'META_TITLE', 'META_DESCRIPTION', 'META_KEYWORD'));
        } else {
            abort(404);
        }
    }

}
