<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;

class TestimonialController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $TestimonialData = [];
        $TestimonialData['TestimonialData'] = Testimonial::getFrontList();
        $TestimonialData['FeaturedProductsData'] = Testimonial::getFeaturedProductsRecords();

        return view('testimonials', $TestimonialData);
    }

}
