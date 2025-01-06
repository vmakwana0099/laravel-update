<?php

namespace App\Http\Controllers;

use App\GeneralFaq;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;

class FaqController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $Data = [];
        $faqs = GeneralFaq::getFaqRecords();
        $FaqsData = [];
        foreach($faqs as $faq){
            $FaqsData[$faq->fkCategory][] = $faq;
        }
        //echo '<pre>';print_r($FaqsData);exit;
        $Data['FaqData'] = $FaqsData;
        $Data['FaqCategory'] = GeneralFaq::getFaqCategories();
        $Data['FeaturedProductsData'] = GeneralFaq::getFeaturedProductsRecords();
        return view('faq', $Data);
    }

}
