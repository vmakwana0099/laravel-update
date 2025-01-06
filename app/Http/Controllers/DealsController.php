<?php

namespace App\Http\Controllers;

use App\Deals;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Http\Traits\slug;
use Config;

class DealsController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $manageurl = config('app.api_url');
        Config::set('hitsupdatecart', $manageurl);
    }

    public function index() {
        $Data = [];
        $Data['DealsData'] = Deals::getDealsData();
        $Data['DealsCat'] = Deals::getDealsCat();
        $Data['FaqData'] = Deals::getFaqRecords();
        //echo '<pre>';print_r($Data['DealsData']);exit;
        return view('deals', $Data);
    }

}
