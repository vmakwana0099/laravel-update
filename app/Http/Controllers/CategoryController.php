<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;

class CategoryController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        
    }
        public function ssl() 
	{
            echo "sdfsf";exit;
		$HostingArr = ProductCategory::getRecords();
		return view('hosting', compact('HostingArr'));
	}

    /**
     * This method handels load process of show
     * @return  View
     * @since   2017-11-10
     * @author  NetQuick
     */
    public function index() {
        $file =  \Request::route()->getName();
        $HostingArr = ProductCategory::getHostingRecords();
//        echo "<pre/>";
//        print_r($HostingArr); exit;
        if($file == 'hosting-1')
        {
            $file1 = "hosting";
        }else{
            $file1 = $file; 
        }
        return view($file1)->with('HostingArr', $HostingArr);
    }


}
