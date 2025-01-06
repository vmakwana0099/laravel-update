<?php

namespace App\Http\Controllers;

use DB;
use Config;
use App\Helpers\MyLibrary;
use App\Banner;
use App\CmsPage;
use App\Video;
use Session;

class HomeController extends FrontController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = array();
        
        $bannerObj = Banner::getHomeBannerList();
        $ProductsObj = CmsPage::getHomeProducts();
        $NewsObj = CmsPage::getHomeNews();
        $testimonialObj = CmsPage::getHomeTestimonials();
       
        $data['bannerData'] = $bannerObj;
       
        $data['newsData'] = $NewsObj;
        $data['productData'] = $ProductsObj;
        $data['testimonialData'] = $testimonialObj;

        foreach ($data['testimonialData'] as $key => $value) {
            $value['videoIDAray'] = explode(',', $value->fkIntVideoId);
            $videoData = Video::getVideoData($value['videoIDAray']);
            $value['videoData'] = $videoData;
        }

        // echo '<pre>';print_r($data['testimonialData']);exit;
       
        return view('index',$data);
    }

}
