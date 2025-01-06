<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Request;
use Session;
use Config;

class ThankyouController extends FrontController {

    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        if (Session::get('form_submit')) {
            view()->share('META_TITLE', Config::get('Constant.DEFAULT_META_TITLE'));
            view()->share('META_KEYWORD', Config::get('Constant.DEFAULT_META_KEYWORD'));
            view()->share('META_DESCRIPTION', Config::get('Constant.DEFAULT_META_DESCRIPTION'));
            return view('thankyou', ['message' => Session::get('message')]);
        } else {
            return redirect('/');
        }
    }

}
