<?php

namespace App\Http\Controllers;

use DB;
use Config;
use App\Helpers\MyLibrary;
use Illuminate\Http\Request;
use App\Cart;
use App\ProductCategory;
use App\user_session;
use App\ContactInfo;
use App\Helpers\Email_sender;
use Session;

class CartController extends FrontController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function getconstants() {
        Config::set('user.id', "1"); //make this constant dynamic and remove it from here.
        Config::set('user.currency', Config::get('Constant.sys_currency_code'));
        Config::set('user.currencycode', Config::get('Constant.sys_currency'));
        Config::set('user.suggestedtlds', "com,net,ca,in,info"); //suggested tlds.
        $dname = "https://www.hostitsmart.com";
        Config::set('apiurl', $dname . "/checkdomain.php?"); //suggested tlds.
        $apiUrl = config('app.api_url');
        Config::set('hitsupdatecart', $apiUrl);

        $addonServices = array();
        
        //Linux web hosting -> Dedicated Server
        $key = 179; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;


        $key = 180; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 181; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;


        //Windows Web Hosting -> VPS Hosting
        $key = 186; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 187; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 188; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        //Wordpress hosting -> Reseller linux hosting
        $key = 155; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 156; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 157; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;


        //Java Hosting -> Reseller Windows Hosting
        $key = 158; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 159; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 160; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        //Ecommerce Hosting -> VPS Hosting
        $key = 161; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 162; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 163; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        //Reseller linux hosting -> Dedicated Server
        $key = 176; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 177; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 178; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;


        //Reseller Windows Hosting -> Dedicated Server
        $key = 175; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 174; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 175; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        //VPS Hosting -> Dedicated Server
        $key = 154; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 164; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 190; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        //Dedicated Server -> VPS Hosting
        $key = 183; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 184; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 185; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        //SSL -> VPS, Dedicated Server
        $key = 195; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 196; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;

        $key = 197; //product id
        $addons = array('pid' => 176, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        $addons = array('pid' => 175, 'desc' => "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;
        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array('pid' => 170, 'desc' => "Get @groupname '@productname' only at  <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price", 'type' => 'hosting');
        $addonServices[$key][] = $addons;



        Config::set('user.addonforproducts', serialize($addonServices)); //addon suggetion uncomment this line
        //------------------- Domain Addons ---------------------------
        $domainaddonServices = array();

        $addons = array();
        $addons['pid'] = 176;
        $addons['desc'] = "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span> @price ";
        $addons['type'] = "hosting";
        $domainaddonServices[0][] = $addons;

        $addons = array();
        $addons['pid'] = 175;
        $addons['desc'] = "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span>  @price ";
        $addons['type'] = "hosting";
        $domainaddonServices[0][] = $addons;

        //For Site lock Business Plan --------------------27 Feb----by bb------------
        $addons = array();
        $addons['pid'] = 170;
        $addons['desc'] = "Get @groupname '@productname' only at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span>  @price ";
        $addons['type'] = "hosting";
        $domainaddonServices[0][] = $addons;

        $domainAddonsPricing = Cart::getDomainAddonsPricing(['currency' => Config::get('user.currency')]);
        //echo '<pre>';print_r($domainAddonsPricing);exit;

        if (!empty($domainAddonsPricing)) {
            foreach ($domainAddonsPricing as $key => $item) {
                //if (!empty($item[Config::get('user.currency')])) {
                $addons = array();
                $addons['did'] = 0;
                if ($key == 'dnsmanagement') {
                    if (!empty($item[Config::get('user.currency')])) {
                        $addons['desc'] = "Get your website DNS Management only at <span class='rupees'>" . Config::get('user.currencycode') . "</span> " . $item[Config::get('user.currency')] . " / month";
                    } else {
                        $addons['desc'] = "Get your website DNS Management for FREE";
                    }
                    $addons['desc'] = str_replace("INR", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                    $addons['desc'] = str_replace("USD", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                } else if ($key == 'emailforwarding') {
                    if (!empty($item[Config::get('user.currency')])) {
                        $addons['desc'] = "Get your website Email Forwarding only at <span class='rupees'>" . Config::get('user.currencycode') . "</span> " . $item[Config::get('user.currency')] . " / month";
                    } else {
                        $addons['desc'] = "Get your website Email Forwarding for FREE";
                    }
                    $addons['desc'] = str_replace("INR", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                    $addons['desc'] = str_replace("USD", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                } else if ($key == 'idprotection') {
                    if (!empty($item[Config::get('user.currency')])) {
                        $addons['desc'] = "Get your website Privacy Protection only at <span class='rupees'>" . Config::get('user.currencycode') . "</span> " . $item[Config::get('user.currency')] . " / month";
                    } else {
                        $addons['desc'] = "Get your website Email Forwarding for FREE";
                    }
                    $addons['desc'] = str_replace("INR", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                    $addons['desc'] = str_replace("USD", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                }
                $addons['type'] = $key;
                $addons['price'] = $item[Config::get('user.currency')];
                $domainaddonServices[0][] = $addons;
                //}
            }
        }

        Config::set('user.addonfordomains', serialize($domainaddonServices)); //addon domain suggetion --uncomment this line

        $recommandation = array();
        $recommandation[] = "179,180,181"; //linuxhosting
        $recommandation[] = "186,187,188"; //windowshosting
        $recommandation[] = "176,177,178"; //linuxresellerhosting
        $recommandation[] = "192,174,175"; //windowsresellerhosting
        $recommandation[] = "155,156,157"; //wordpresshosting
        $recommandation[] = "158,159,160"; //javahosting
        $recommandation[] = "161,162,163"; //ecommercehosting
        $recommandation[] = "183,184,185"; //dedicatedserver
        $recommandation[] = "154,164,190"; //vps
        $recommandation[] = "195,196,197"; //ssl
        


        $recommndedStr = serialize($recommandation);
        Config::set('recommandedproducts', $recommndedStr); //recommanded hosting --uncomment this line

        $productTypes = array();
        
        //Linux hosting
        $productTypes[179] = 'hosting';
        $productTypes[180] = 'hosting';
        $productTypes[181] = 'hosting';
        
        //Windows Hosting
        $productTypes[186] = 'hosting';
        $productTypes[187] = 'hosting';
        $productTypes[188] = 'hosting';
        
        //WordPress Hosting
        $productTypes[155] = 'hosting';
        $productTypes[156] = 'hosting';
        $productTypes[157] = 'hosting';
    
        //JAVA Hosting
        $productTypes[158] = 'hosting';
        $productTypes[159] = 'hosting';
        $productTypes[160] = 'hosting';
        
        //E-Commerce Hosting 
        $productTypes[161] = 'hosting';
        $productTypes[162] = 'hosting';
        $productTypes[163] = 'hosting';

        //Windows Reseller Hosting
        $productTypes[192] = 'hosting';
        $productTypes[174] = 'hosting';
        $productTypes[175] = 'hosting';

        //Linux Reseller Hosting 
        $productTypes[176] = 'hosting';
        $productTypes[177] = 'hosting';
        $productTypes[178] = 'hosting';
        
        //Dedicated Server
        $productTypes[183] = 'dedicatedserver';
        $productTypes[184] = 'dedicatedserver';
        $productTypes[185] = 'dedicatedserver';

        //VPS 
        $productTypes[154] = 'vps';
        $productTypes[164] = 'vps';
        $productTypes[190] = 'vps';

        //SSL
        $productTypes[195] = 'ssl';
        $productTypes[196] = 'ssl';
        $productTypes[197] = 'ssl';
        Config::set('producttypesArr', serialize($productTypes)); //product types
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        Self::getconstants();
        //Update Session from Database -----------------------------------
        if (!empty($request->session()->get('UserID'))) {
                $User_ID = $request->session()->get('UserID');
                $get_previus_data = user_session::where('user_id', '=', $User_ID)->first(); // get previously session data for user
                if(!empty($get_previus_data)){ $prev_payload = unserialize(base64_decode($get_previus_data->payload)); }
                if(!empty($prev_payload)){
                    //echo '<pre>';print_r($prev_payload);exit;
                    $request->session()->put('cart', $prev_payload);
                }
                

            }
       //Update Session from Database End-----------------------------------     




        $cartData = $request->session()->all();

        $User_ID = $request->session()->get('UserID');
        $Whmcs_ID = $request->session()->get('WhmcsID');

        if (!isset($cartData['cart'])) {
            $cartData['cart'] = false;
        }

        if (empty($cartData['cart'])) {
            return redirect('/');
        }

        if(isset($cartData['cart'])){
        $cartTemp = $cartData['cart'];

        if(array_key_exists('userid',$cartTemp))        { unset($cartTemp['userid']); }
        if(array_key_exists('paymentmethod',$cartTemp)) { unset($cartTemp['paymentmethod']); }
        if(array_key_exists('recommndation',$cartTemp)) { unset($cartTemp['recommndation']); }            
        if(array_key_exists('prmocode',$cartTemp))      { unset($cartTemp['prmocode']); }
        if(array_key_exists('prmodiscount',$cartTemp))  { unset($cartTemp['prmodiscount']); }
        if(array_key_exists('prmomessage',$cartTemp))   { unset($cartTemp['prmomessage']); }

        if (empty($cartTemp)) { return redirect('/'); }

        }

        //set free domain details ------------------------------------- 
        foreach ($cartData['cart'] as $key => $item) {
            if (isset($item['pid']) && $item['producttype'] != 'domain') {
                if (isset($cartData['cart'][$key]['allowfreedomain'])) {
                    unset($cartData['cart'][$key]['allowfreedomain']);
                }
                $freeDomainData = Cart::checkForFreeDomain($item['pid']);
                //echo '<pre>';print_r($freeDomainData);exit;
                if (!empty($freeDomainData['freedomain'])) {
                    $payterms = explode(",", $freeDomainData['freedomainpaymentterms']);
                    $billingStr = str_replace("-", "", $item['billingcycle']);
                    if (in_array($billingStr, $payterms)) {
                        $cartData['cart'][$key]['allowfreedomain'] = $freeDomainData;
                    }
                }
            }
        }
        //set free domain details ------------------------------------- 
        //Get all tlds ------------------------------------------------
        $tldparams = [];
        $tldparams['currency'] = Config::get('Constant.sys_currency');
        $tldparams['domain_type'] = "domainregister";
        $Tld_array = Cart::GetTldData($tldparams);
        $allCartTlds = [];
        $counter = 0;
        if (!empty($Tld_array)) {
            foreach ($Tld_array as $value) {
                if ($counter > 5) {
                    continue;
                }
                $allCartTlds[] = "." . $value->varTitle;
                $counter++;
            }
        }

        //-------------------------------------------------------------
        //Load cart right summary -------------------------------------
        $cartDataSummary = Cart::createOrderSummary($request);

        if(array_key_exists('userid',$cartDataSummary))        { unset($cartDataSummary['userid']); }
        if(array_key_exists('paymentmethod',$cartDataSummary)) { unset($cartDataSummary['paymentmethod']); }
        if(array_key_exists('recommndation',$cartDataSummary)) { unset($cartDataSummary['recommndation']); }            
        //if(array_key_exists('prmocode',$cartDataSummary))      { unset($cartDataSummary['prmocode']); }
        //if(array_key_exists('prmodiscount',$cartDataSummary))  { unset($cartDataSummary['prmodiscount']); }
        //if(array_key_exists('prmomessage',$cartDataSummary))   { unset($cartDataSummary['prmomessage']); }

        $addonProductsSummary = [];
        foreach ($cartDataSummary as $item) {
            if (isset($item['relatedpro'])) {
                $addonProductsSummary[$item['relatedpro']][] = $item;
            }
        }
        //---------------------------------------------------------------
        //$arrTemp = array_reverse($cartData['cart']);
        $arrTemp = $cartData['cart'];
        return view('cart.index', ['cartData' => $arrTemp, 'allCartTlds' => $allCartTlds, 'cartDataSummary' => $cartDataSummary, 'addonProductsSummary' => $addonProductsSummary]);
    }

    public function reloadcart(Request $request) {
        Self::getconstants();
        $cartData = $request->session()->all();

        $User_ID = $request->session()->get('UserID');
        $Whmcs_ID = $request->session()->get('WhmcsID');

        if (!isset($cartData['cart'])) {
            $cartData['cart'] = false;
        }


        if (empty($cartData['cart'])) {
            return redirect('/');
        }

        //set free domain details ------------------------------------- 
        foreach ($cartData['cart'] as $key => $item) {
            if (isset($item['pid']) && $item['producttype'] != 'domain') {
                if (isset($cartData['cart'][$key]['allowfreedomain'])) {
                    unset($cartData['cart'][$key]['allowfreedomain']);
                }
                $freeDomainData = Cart::checkForFreeDomain($item['pid']);
                //echo '<pre>';print_r($freeDomainData);exit;
                if (!empty($freeDomainData['freedomain'])) {
                    $payterms = explode(",", $freeDomainData['freedomainpaymentterms']);
                    if (in_array($item['billingcycle'], $payterms)) {
                        $cartData['cart'][$key]['allowfreedomain'] = $freeDomainData;
                    }
                }
            }
        }
        //set free domain details ------------------------------------- 
        //Get all tlds ------------------------------------------------
        $tldparams = [];
        $tldparams['currency'] = Config::get('Constant.sys_currency');
        $tldparams['domain_type'] = "domainregister";
        $Tld_array = Cart::GetTldData($tldparams);
        $allCartTlds = [];
        $counter = 0;
        if (!empty($Tld_array)) {
            foreach ($Tld_array as $value) {
                if ($counter > 5) {
                    continue;
                }
                $allCartTlds[] = "." . $value->varTitle;
                $counter++;
            }
        }

        //-------------------------------------------------------------
        //Load cart right summary -------------------------------------
        $cartDataSummary = Cart::createOrderSummary($request);
        
        if(array_key_exists('userid',$cartDataSummary))        { unset($cartDataSummary['userid']); }
        if(array_key_exists('paymentmethod',$cartDataSummary)) { unset($cartDataSummary['paymentmethod']); }
        if(array_key_exists('recommndation',$cartDataSummary)) { unset($cartDataSummary['recommndation']); }            
        if(array_key_exists('prmocode',$cartDataSummary))      { unset($cartDataSummary['prmocode']); }
        if(array_key_exists('prmodiscount',$cartDataSummary))  { unset($cartDataSummary['prmodiscount']); }
        if(array_key_exists('prmomessage',$cartDataSummary))   { unset($cartDataSummary['prmomessage']); }

        $addonProductsSummary = [];
        foreach ($cartDataSummary as $item) {
            if (isset($item['relatedpro'])) {
                $addonProductsSummary[$item['relatedpro']][] = $item;
            }
        }
        //---------------------------------------------------------------
        return view('cart.cartreload', ['cartData' => $cartData['cart'], 'allCartTlds' => $allCartTlds, 'cartDataSummary' => $cartDataSummary, 'addonProductsSummary' => $addonProductsSummary]);
    }

    public function add(Request $request) {
        Self::getconstants();
        return view('cart.add');
    }

    public function addbulkdomain(Request $request) {

        /* $finalData = array();
          $finalData[$request->i + 1] = array("key" => $request->i,"domain" => $request->domain, "domaintype" => $request->dtype,"producttype" => $request->ptype,"regperiod" => $request->reg,"tld" => $request->tld);
          return json_encode($finalData); */
        return json_encode(array("key" => $request->i, "domain" => $request->domain, "domaintype" => $request->dtype, "producttype" => $request->ptype, "regperiod" => $request->reg, "tld" => $request->tld));
    }

    public function removebulkdomain(Request $request) {
        return 1;
    }

    public function store(Request $request) {

        Self::getconstants();
        
        $productData = Cart::getProductsData(); //get products data from database.

        if ($request->has('jsonarr')) {
            $rowData = (array) json_decode($request->jsonarr);
        } else {
            $rowData = $request->all();
            //echo '<pre>';print_r($rowData);exit; 
        }

        if (isset($rowData['_token'])) {
            unset($rowData['_token']);
        } //remove _token as not required further.

        if (isset($rowData['h_tld'])) {
            unset($rowData['h_tld']);
        }
        if (isset($rowData['ext_domain'])) {
            unset($rowData['ext_domain']);
        }
        if (isset($rowData['landingdomain'])) {
            unset($rowData['landingdomain']);
        }

        if (isset($rowData['submit'])) {
            unset($rowData['submit']);
        }
        
        //echo '<pre>';print_r($rowData);exit;
        $data = array();
        if(isset($rowData['vps_cpu'][1])){ unset($rowData['vps_cpu'][1]); }
        if(isset($rowData['vps_ram'][1])){ unset($rowData['vps_ram'][1]); }
        if(isset($rowData['vps_hdd'][1])){ unset($rowData['vps_hdd'][1]); }
        //echo '<pre>';print_r($rowData);exit;
        if (!empty($rowData)) {

            if (isset($rowData['authcode'])) {
                foreach ($rowData as $key => $ele) {
                    foreach ($ele as $i => $itm) {
                        $data[$i][$key] = $itm;
                    }
                }
            } else {
//                echo '<pre>';print_r($rowData);exit;
                foreach ($rowData as $key => $ele) {
                    if ($key == 'pricing') {
                        $data[$i][$key] = $ele;
                    } else {
                        foreach ($ele as $i => $itm) {
                            $data[$i][$key] = $itm;
                        }
                    }
                }
            }
        }


        foreach ($data as $requestData) {

            if (isset($requestData["domaintype"])) {

                $Domain = str_replace("https://", "", $requestData["domain"]);
                $Domain = str_replace("http://", "", $Domain);
                $Domain = str_replace("www.", "", $Domain);

                if ($requestData["domaintype"] == 'transfer') {
                    $transfer_tld = explode(".", $Domain);
                    $transfer_tld[1] = $this->remove_all_special_char($transfer_tld[1]);
                }
            }


            $cartData_array = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            if (!empty($cartData_array) && isset($requestData["domain"])) {
                $request_domain = $requestData["domain"];
                
                if(array_key_exists('userid',$cartData_array))        { unset($cartData_array['userid']); }
                if(array_key_exists('paymentmethod',$cartData_array)) { unset($cartData_array['paymentmethod']); }
                if(array_key_exists('recommndation',$cartData_array)) { unset($cartData_array['recommndation']); }            
                if(array_key_exists('prmocode',$cartData_array))      { unset($cartData_array['prmocode']); }
                if(array_key_exists('prmodiscount',$cartData_array))  { unset($cartData_array['prmodiscount']); }
                if(array_key_exists('prmomessage',$cartData_array))   { unset($cartData_array['prmomessage']); }

                $cartdomainsdata = array();
                foreach ($cartData_array as $key => $cart_data) {
                    $cartdomainsdata[] = $cart_data["domain"];
                }
                if (in_array($request_domain, $cartdomainsdata)) {
                    continue;
                }
            }

            $requestData = (object) $requestData;
            $item = [];
            if (isset($requestData->producttype))
                $item['producttype'] = $requestData->producttype;      //product type
            if (isset($requestData->pid))
                $item['pid'] = $requestData->pid;      //prodictid for product
            if (isset($requestData->billingcycle))
                $item['billingcycle'] = $requestData->billingcycle;   //if billingcycle for product
            if (isset($requestData->customfields))
                $item['customfields'] = $requestData->customfields;   //if product having custom fields
            if (isset($requestData->configoptions))
                $item['configoptions'] = $requestData->configoptions;  //if product having configure options
            if (isset($requestData->addons))
                $item['addons'] = $requestData->addons;     //if addons
            if (isset($requestData->hostname))
                $item['hostname'] = $requestData->hostname;   //if product VPS/Dedicated server
            if (isset($requestData->ns1prefix))
                $item['ns1prefix'] = $requestData->ns1prefix;    //if product VPS/Dedicated server
            if (isset($requestData->ns2prefix))
                $item['ns2prefix'] = $requestData->ns2prefix;    //if product VPS/Dedicated server
            if (isset($requestData->rootpw))
                $item['rootpw'] = $requestData->rootpw;     //if product VPS/Dedicated server

            if (isset($requestData->domain)) {
                $item['domain'] = str_replace("/", "", $Domain);
            } else {
                $item['domain'] = '';
            };
            if (isset($requestData->domaintype))
                $item['domaintype'] = $requestData->domaintype;   //if Domain 
            if (isset($requestData->regperiod))
                $item['regperiod'] = $requestData->regperiod;    //if Domain 
            if (isset($requestData->eppcode))
                $item['eppcode'] = $requestData->eppcode;    //if Domain Transfer
            if (isset($requestData->dnsmanagement) && $requestData->dnsmanagement == true)
                $item['dnsmanagement'] = $requestData->dnsmanagement;  //if Domain support DNS management , Boolean value
            if (isset($requestData->emailforwarding) && $requestData->emailforwarding == true)
                $item['emailforwarding'] = $requestData->emailforwarding;  //if Domain support Email forwarding, Boolean value
            if (isset($requestData->idprotection) && $requestData->idprotection == true)
                $item['idprotection'] = $requestData->idprotection;   //if Domain support DNS idprotection, Boolean value
            if (isset($requestData->domainfields))
                $item['domainfields'] = $requestData->domainfields;   //if domain country specific
            if (isset($requestData->pricing) && !isset($requestData->authcode))
                $item['pricing'] = $requestData->pricing;      //pricing

            if (isset($requestData->producttype) && $requestData->producttype == 'domain') {
                if ($requestData->domaintype == 'transfer') {
                    $item['pricing'] = Cart::getDomainPricing(['tlds' => "." . $transfer_tld[1], 'currency' => Config::get('user.currency')]);  //check for Dot in tlds. ".com"
                } else {
                    $item['pricing'] = Cart::getDomainPricing(['tlds' => $requestData->tld, 'currency' => Config::get('user.currency')]);  //check for Dot in tlds. ".com"
                }
            }

            if (isset($requestData->producttype) && $requestData->producttype == 'hosting') {
                $item['pricing'] = Cart::getHostingPricing(['productid' => $requestData->pid, 'currencycode' => Config::get('user.currencycode')]);
                $item['regperiod'] = Cart::getRegistrationPeriodByName($item['billingcycle']);

                if (isset($productData[$item['pid']]->groupname)) {
                    $item['groupname'] = $productData[$item['pid']]->groupname;
                }
                if (isset($productData[$item['pid']]->productname)) {
                    $item['planname'] = $productData[$item['pid']]->productname;
                }
                // if(isset($requestData->groupname)) $item['groupname']                     = $requestData->groupname; 
                // if(isset($requestData->planname)) $item['planname']                     = $requestData->planname; 
            }

            //For email Google Apps ---------------------------
            if (isset($requestData->producttype) && $requestData->producttype == 'email') {
                $item['pricing'] = Cart::getHostingPricing(['productid' => $requestData->pid, 'currencycode' => Config::get('user.currencycode')]);
                $item['regperiod'] = Cart::getRegistrationPeriodByName($item['billingcycle']);
                 
                if (isset($productData[$item['pid']]->groupname)) {
                    $item['groupname'] = $productData[$item['pid']]->groupname;
                }
                if (isset($productData[$item['pid']]->productname)) {
                    $item['planname'] = $productData[$item['pid']]->productname;
                }
            }

            if (isset($requestData->producttype) && ($requestData->producttype == 'dedicatedserver' || $requestData->producttype == 'ssl' || $requestData->producttype == 'vps')) {
                $item['pricing'] = Cart::getHostingPricing(['productid' => $requestData->pid, 'currencycode' => Config::get('user.currencycode')]);
                $item['regperiod'] = Cart::getRegistrationPeriodByName($item['billingcycle']);

                if (isset($productData[$item['pid']]->groupname)) {
                    $item['groupname'] = $productData[$item['pid']]->groupname;
                }
                if (isset($productData[$item['pid']]->productname)) {
                    $item['planname'] = $productData[$item['pid']]->productname;
                }

                $productData2 = Cart::getProductDetails(['productid' => $requestData->pid, 'currencycode' => Config::get('user.currencycode')]);
                if (isset($productData2['products']['product'][0]['customfields']['customfield'])) {
                    $ids = [];
                    foreach ($productData2['products']['product'][0]['customfields']['customfield'] as $field) {
                        $ids[] = $field['id'];
                    }
                    $fields = Cart::getConfigSetting(['ids' => implode(",", $ids)]);

                    foreach ($productData2['products']['product'][0]['customfields']['customfield'] as $field) {
                        $field['fieldtype'] = $fields[$field['id']]['fieldtype'];
                        $field['fieldoptions'] = $fields[$field['id']]['fieldoptions'];
                        $productCustomFieldsData[] = $field;
                    }
                }
                if (isset($productData2['products']['product'][0]['configoptions']['configoption'])) {

                    foreach ($productData2['products']['product'][0]['configoptions']['configoption'] as $field) {
                        $configArr = array();
                        $configArr['name'] = $field['name'];
                        $configArr['id'] = $field['id'];

                        if (!empty($field['options']['option'])) {
                            foreach ($field['options']['option'] as $option) {
                                $opt = array();
                                $opt['name'] = $option['name'];
                                $opt['id'] = $option['id'];
                                $pricingData = [];
                                if (isset($option['pricing'][Config::get('user.currencycode')])) {
                                    $pricingData['setup'][1] = $option['pricing'][Config::get('user.currencycode')]['msetupfee'];
                                    $pricingData['setup'][2] = $option['pricing'][Config::get('user.currencycode')]['qsetupfee'];
                                    $pricingData['setup'][3] = $option['pricing'][Config::get('user.currencycode')]['ssetupfee'];
                                    $pricingData['setup'][4] = $option['pricing'][Config::get('user.currencycode')]['asetupfee'];
                                    $pricingData['setup'][5] = $option['pricing'][Config::get('user.currencycode')]['bsetupfee'];
                                    $pricingData['setup'][6] = $option['pricing'][Config::get('user.currencycode')]['tsetupfee'];

                                    $pricingData['price'][1] = $option['pricing'][Config::get('user.currencycode')]['monthly'];
                                    $pricingData['price'][2] = $option['pricing'][Config::get('user.currencycode')]['quarterly'];
                                    $pricingData['price'][3] = $option['pricing'][Config::get('user.currencycode')]['semiannually'];
                                    $pricingData['price'][4] = $option['pricing'][Config::get('user.currencycode')]['annually'];
                                    $pricingData['price'][5] = $option['pricing'][Config::get('user.currencycode')]['biennially'];
                                    $pricingData['price'][6] = $option['pricing'][Config::get('user.currencycode')]['triennially'];
                                }
                                $opt['pricing'] = $pricingData;
                                $configArr['options'][] = $opt;
                            }
                        }
                        $productConfigFieldsData[] = $configArr;
                    }
                }

                $productCustomFieldsData[] = array('id' => 'hostname',
                    'name' => 'Hostname',
                    'description' => 'Enter your hostname',
                    'required' => '*',
                    'fieldtype' => 'text',
                    'fieldoptions' => '',
                    'selectedOption' => '');

                /*$productCustomFieldsData[] = array('id' => 'hostpass',
                    'name' => 'Password',
                    'description' => 'Enter your password',
                    'required' => '*',
                    'fieldtype' => 'password',
                    'fieldoptions' => '');

                $productCustomFieldsData[] = array('id' => 'ns1',
                    'name' => 'NS1Prefix',
                    'description' => 'Enter your NS1 Prefix',
                    'required' => '*',
                    'fieldtype' => 'text',
                    'fieldoptions' => '');

                $productCustomFieldsData[] = array('id' => 'ns2',
                    'name' => 'NS2Prefix',
                    'description' => 'Enter your NS2 Prefix',
                    'required' => '*',
                    'fieldtype' => 'text',
                    'fieldoptions' => '');*/

                if (!empty($productCustomFieldsData)) {
                    $item['customfields'] = $productCustomFieldsData;
                }
                if (!empty($productConfigFieldsData)) {
                    $item['configfields'] = $productConfigFieldsData;
                }
            }

            // if($item['producttype'] == 'domain'){
            //     $addonProducts = unserialize(Config::get('user.addonforproducts'));
            //     $domainAddonsPricing = Cart::getDomainAddonsPricing(['currency' => Config::get('user.currency')]);
            // }

            if (isset($item['pid']) && $item['producttype'] != 'domain') {
                $addonProducts = unserialize(Config::get('user.addonforproducts'));
                if (isset($addonProducts[$item['pid']]) && !empty($addonProducts[$item['pid']])) {
                    foreach ($addonProducts[$item['pid']] as $key => $product) {
                        $desc = $product['desc'];
                        $pricing = Cart::getHostingPricing(['productid' => $product['pid'], 'currencycode' => Config::get('user.currencycode')]);
                        // echo '<pre>';print_r($pricing);exit; 
                        //echo '<pre>';print_r($pricing[$item['regperiod']]);exit; 

                        if (isset($pricing[$item['regperiod']]) && ($pricing[$item['regperiod']]->price > 0)) {
                            $addonProducts[$item['pid']][$key]['pricing'][$item['regperiod']] = $pricing[$item['regperiod']];
                            $priceStr = $addonProducts[$item['pid']][$key]['pricing'][$item['regperiod']]->price . " / " . $addonProducts[$item['pid']][$key]['pricing'][$item['regperiod']]->duration . " month";
                            $addonProducts[$item['pid']][$key]['duration'] = $addonProducts[$item['pid']][$key]['pricing'][$item['regperiod']]->durationame;
                        } else {
                            $addonProducts[$item['pid']][$key]['pricing'] = Cart::getHostingPricing(['productid' => $product['pid'], 'currencycode' => Config::get('user.currencycode')], "filderbyzero");
                            $first_key = key($addonProducts[$item['pid']][$key]['pricing']);

                            $priceStr = $addonProducts[$item['pid']][$key]['pricing'][$first_key]->price . " / " . $addonProducts[$item['pid']][$key]['pricing'][$first_key]->duration . " month";
                            $addonProducts[$item['pid']][$key]['duration'] = $addonProducts[$item['pid']][$key]['pricing'][$first_key]->durationame;
                        }

                        if (isset($productData[$product['pid']]->groupname)) {
                            $addonProducts[$item['pid']][$key]['groupname'] = $productData[$product['pid']]->groupname;
                        }
                        if (isset($productData[$item['pid']]->productname)) {
                            $addonProducts[$item['pid']][$key]['productname'] = $productData[$product['pid']]->productname;
                        }

                        $desc = str_replace("@price", $priceStr, $desc);
                        $desc = str_replace("@groupname", $addonProducts[$item['pid']][$key]['groupname'], $desc);
                        $desc = str_replace("@productname", $addonProducts[$item['pid']][$key]['productname'], $desc);
                        $addonProducts[$item['pid']][$key]['desc'] = $desc;


                        $addonProducts[$item['pid']][$key]['type'] = $product['type'];
                    }
                }
                if (isset($addonProducts[$item['pid']]) && !empty($addonProducts[$item['pid']])) {
                    $item['addonproducts'] = $addonProducts[$item['pid']];
                }
            }
            //------------------------ Domain Addons products --------------------------------
            if ($item['producttype'] == 'domain') {
                $addonProducts = unserialize(Config::get('user.addonfordomains'));

                if (isset($addonProducts[0]) && !empty($addonProducts[0])) {

                    foreach ($addonProducts[0] as $key => $product) {
                        if (!isset($product['pid']) || empty($product['pid'])) {
                            continue;
                        }
                        $desc = $product['desc'];
                        $pricing = Cart::getHostingPricing(['productid' => $product['pid'], 'currencycode' => Config::get('user.currencycode')]);

                        if (isset($pricing[$item['regperiod']]) && ($pricing[$item['regperiod']]->price > 0)) {
                            $addonProducts[0][$key]['pricing'][$item['regperiod']] = $pricing[$item['regperiod']];
                            $priceStr = $addonProducts[0][$key]['pricing'][$item['regperiod']]->price . " / " . $addonProducts[0][$key]['pricing'][$item['regperiod']]->duration . " month";
                            $addonProducts[0][$key]['duration'] = $addonProducts[0][$key]['pricing'][$item['regperiod']]->durationame;
                        } else {
                            $addonProducts[0][$key]['pricing'] = Cart::getHostingPricing(['productid' => $product['pid'], 'currencycode' => Config::get('user.currencycode')], "filderbyzero");
                            $first_key = key($addonProducts[0][$key]['pricing']);

                            $priceStr = $addonProducts[0][$key]['pricing'][$first_key]->price . " / " . $addonProducts[0][$key]['pricing'][$first_key]->duration . " month";
                            $addonProducts[0][$key]['duration'] = $addonProducts[0][$key]['pricing'][$first_key]->durationame;
                        }

                        if (isset($productData[$product['pid']]->groupname)) {
                            $addonProducts[0][$key]['groupname'] = $productData[$product['pid']]->groupname;
                        }
                        if (isset($productData[$product['pid']]->productname)) {
                            $addonProducts[0][$key]['productname'] = $productData[$product['pid']]->productname;

                            $desc = str_replace("@price", $priceStr, $desc);
                            $desc = str_replace("@groupname", $addonProducts[0][$key]['groupname'], $desc);
                            $desc = str_replace("@productname", $addonProducts[0][$key]['productname'], $desc);
                            $addonProducts[0][$key]['desc'] = $desc;
                            $addonProducts[0][$key]['type'] = $product['type'];
                        }
                    }
                }
                if (isset($addonProducts[0]) && !empty($addonProducts[0])) {
                    $item['addonproducts'] = $addonProducts[0];
                }
            }



            //echo '<pre>';print_r($item);exit;  
            if (isset($request->cartitemkey[0])) {
                $item['relatedpro'] = $request->cartitemkey[0];
            }

            if (isset($requestData->relproid)) {
                $item['free'] = 1;
            } //if domain is free with other plan

             if((!empty($item['producttype']) && $item['producttype'] == 'hosting') && (isset($requestData->location) && !empty($requestData->location))){

                $customfielids['155'] = 366; //Wordpress -> Starter
                $customfielids['156'] = 367; //Wordpress -> Performace
                $customfielids['157'] = 368; //Wordpress -> Business

                $customfielids['158'] = 360; //Java Hosting -> Starter 
                $customfielids['159'] = 361; //Java Hosting -> Performance
                $customfielids['160'] = 362; //Java Hosting -> Business
                
                $customfielids['161'] = 363; //Ecommerce -> Starter
                $customfielids['162'] = 364; //Ecommerce -> Performace
                $customfielids['163'] = 365; //Ecommerce -> Business
                
                

                $customfield = array(
                        'id' => isset($customfielids[$item['pid']])?$customfielids[$item['pid']]:'', 
                        'name' => 'Location',
                        'description' => '',
                        'required' => '',
                        'fieldtype' => 'dropdown',
                        'fieldoptions' => 'India,USA',
                        'selectedOption' => $requestData->location );
                $item['customfields'][0] = $customfield;

                }



            if (!empty($item)) {
                $lastAddedKey = Cart::addtocart($request, $item);
                if($lastAddedKey === false){ return redirect('cart'); }
            }



            if (isset($request->cartitemkey) && isset($request->addonitemkey)) {
                $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
                $cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['added'] = $request->cartitemkey[0];


                $request->session()->put('cart', $cartData);
                Cart::updateCartInDb($request,$cartData); //Update current session in db
            }

            if ($request->landingdomain == 'y') {

                $Cart_Session_data = $request->session()->get('cart');
                
            if(array_key_exists('userid',$Cart_Session_data))        { unset($Cart_Session_data['userid']); }
            if(array_key_exists('paymentmethod',$Cart_Session_data)) { unset($Cart_Session_data['paymentmethod']); }
            if(array_key_exists('recommndation',$Cart_Session_data)) { unset($Cart_Session_data['recommndation']); }          
            if(array_key_exists('prmocode',$Cart_Session_data))      { unset($Cart_Session_data['prmocode']); }
            if(array_key_exists('prmodiscount',$Cart_Session_data))  { unset($Cart_Session_data['prmodiscount']); }
            if(array_key_exists('prmomessage',$Cart_Session_data))   { unset($Cart_Session_data['prmomessage']); }

                $session_data = [];
                foreach ($Cart_Session_data as $key => $value) {
                    if ($value["producttype"] == 'domain' && !empty($value["domain"])) {
                        if ($value["domaintype"] != 'transfer') {
                            $last_array = end($Cart_Session_data);
                            $domian_key = key($Cart_Session_data);
//                            $session_data[$key] = str_replace(".", '_', $value["domain"]);
                            $session_data[$domian_key] = str_replace(".", '_', $last_array["domain"]);
                        }
                    }
                }
            }

            //if adding free domain
            if (isset($requestData->relproid)) {
                $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
                $cartData[$requestData->relproid]['domain'] = $requestData->domain;
                $request->session()->put('cart', $cartData);
                Cart::updateCartInDb($request,$cartData); //Update current session in db
            }
        }
         // echo "<pre>Product Type: ";
         // print_r($item['producttype']);
         // exit;

        

        if (isset($lastAddedKey) && isset($item) && ($item['producttype'] == 'vps' || $item['producttype'] == 'dedicatedserver')) {
            if (isset($requestData->location)) {
                Session::flash('config_loc', $requestData->location);
            }

            if ($requestData->pid == 164) {

                //for CPU
                if ($requestData->vps_cpu == 2) {
                    $Value = "585";
                } else if ($requestData->vps_cpu == 4) {
                    $Value = '598';
                } else {
                    $Value = '585';
                }
                Session::flash('vps_cpu_select', $Value);

                //for RAM
                if ($requestData->vps_ram == 2) {
                    $Value_ram = "587";
                } else if ($requestData->vps_ram == 4) {
                    $Value_ram = '588';
                } else if ($requestData->vps_ram == 8) {
                    $Value_ram = '746';
                } else {
                    $Value_ram = '587';
                }
                Session::flash('vps_ram_select', $Value_ram);
                
                //for HDD 
                if ($requestData->vps_hdd == 20) {
                    $Value_hdd = "589";
                } else if ($requestData->vps_hdd == 40) {
                    $Value_hdd = '590';
                } else if ($requestData->vps_hdd == 80) {
                    $Value_hdd = '591';
                } else if ($requestData->vps_hdd == 120) {
                    $Value_hdd = '747';
                } else {
                    $Value_hdd = '589';
                }
                Session::flash('vps_hdd_select', $Value_hdd);

            }

            if ($requestData->pid == 154) {

                //for CPU
                if ($requestData->vps_cpu == 2) {
                    $Value = "571";
                } else if ($requestData->vps_cpu == 4) {
                    $Value = '572';
                } else {
                    $Value = '571';
                }
                Session::flash('vps_cpu_select', $Value);

                //for RAM
                if ($requestData->vps_ram == 2) {
                    $Value_ram = "573";
                } else if ($requestData->vps_ram == 4) {
                    $Value_ram = '574';
                } else if ($requestData->vps_ram == 8) {
                    $Value_ram = '744';
                } else {
                    $Value_ram = '573';
                }
                Session::flash('vps_ram_select', $Value_ram);
                 
                //for HDD
                if ($requestData->vps_hdd == 20) {
                    $Value_hdd = "575";
                } else if ($requestData->vps_hdd == 40) {
                    $Value_hdd = '576';
                } else if ($requestData->vps_hdd == 80) {
                    $Value_hdd = '577';
                } else if ($requestData->vps_hdd == 120) {
                    $Value_hdd = '745';
                } else {  
                    $Value_hdd = '575'; 
                }
                Session::flash('vps_hdd_select', $Value_hdd);
            }

            if ($requestData->pid == 190) {
                //echo '</br>'.$requestData->vps_cpu;
                //echo '</br>'.$requestData->vps_ram;
                //echo '</br>'.$requestData->vps_hdd;exit;
                //for CPU
                if ($requestData->vps_cpu == 2) {
                    $Value = "767";
                } else if ($requestData->vps_cpu == 4) {
                    $Value = '766';
                } else {
                    $Value = '767';
                }
                //echo '</br>cpy'.$Value;
                Session::flash('vps_cpu_select', $Value);

                //for RAM
                if ($requestData->vps_ram == 2) {
                    $Value_ram = "763";
                } else if ($requestData->vps_ram == 4) {
                    $Value_ram = '764';
                } else if ($requestData->vps_ram == 8) {
                    $Value_ram = '765';
                } else {
                    $Value_ram = '763';
                }
                Session::flash('vps_ram_select', $Value_ram);
                
                //for HDD 
                if ($requestData->vps_hdd == 20) {
                    $Value_hdd = "768";
                } else if ($requestData->vps_hdd == 40) {
                    $Value_hdd = '769';
                } else if ($requestData->vps_hdd == 80) {
                    $Value_hdd = '770';
                } else if ($requestData->vps_hdd == 120) {
                    $Value_hdd = '771';
                } else {
                    $Value_hdd = '768';
                }
                Session::flash('vps_hdd_select', $Value_hdd);

            }



            return redirect('cart/config?id=' . $lastAddedKey);
        } else {

            if(isset($lastAddedKey) && isset($requestData->producttype) && $requestData->producttype == 'hosting') {
                return redirect('cart/config?id=' . $lastAddedKey);
            }

            //For Email Google Apps -----------------------------
            if(isset($lastAddedKey) && isset($requestData->producttype) && $requestData->producttype == 'email') {
                return redirect('cart/config?id=' . $lastAddedKey);
            }

            if(isset($lastAddedKey) && isset($requestData->producttype) && $requestData->producttype == 'ssl') {
                return redirect('cart/config?id=' . $lastAddedKey);
            }

            if ($request->landingdomain == 'y' && $request->ajax()) {
                if(isset($session_data)){
                    return count($session_data);
                }
                else {
                    return 0;    
                }
                
            } else if ($request->ajax()) {
                return "1";
            } else {
                return redirect('cart');
            }
        }
    }

    public function viewcart(Request $request) {
        //Self::getconstants();
        //$cartData = $request->session()->all();
    }

    public function emptycart(Request $request) {
        Self::getconstants();
        Cart::emptyCart($request);
        return redirect('/');
    }

    public function removecart(Request $request) {
        Self::getconstants();
        return Cart::removeCart($request);
        //return view('cart.remove');
    }

    public function createorder(Request $request) {
        Self::getconstants();
        $g = $request->paymentoptions;
        $gateway = "paypal";

        if ($g == "p") { //Paypal
            $gateway = 'paypal';
        } // paypal
        else if ($g == "c") { //credit cart
            //$gateway = 'ccavenuev2';
            $gateway = 'ebs';
        } else if ($g == "d") { //debit cart
            //$gateway = 'ccavenuev2';
            $gateway = 'ebs';
        } else if ($g == "n") { //net banking
            //$gateway = 'ccavenuev2';
            $gateway = 'ebs';
        }
        //echo "1: ".$gateway;
        $orderData = Cart::createorder($request,$gateway);
        if (isset($orderData['orderid']) && !empty($orderData['orderid'])) {
            //Cart::sendOrderEmail($orderData['orderid']); //send invoice email
            $request->session()->put('orderid', $orderData['orderid']);
            $paymentScript = Cart::getpaymentlink(['id' => $orderData['invoiceid'], 'gateway' => $gateway]);
            return $paymentScript;
        } else {
            return "error";
        }
    }

    public function generateorder(Request $request) {
        Self::getconstants();
        //echo "asda";exit;

        $orderId = Cart::createorder($request);
        echo '<pre>Order Id:';
        print_r($orderId);
        // echo '<a target="_blank" href="https://new.hostitsmart.com/manage/admin/orders.php?action=view&id=' . $orderId['orderid'] . '">View Order</a>';
        exit;
        //return redirect('cart');
    }

    public function updatedomain(Request $request) {
        Self::getconstants();
        $eleStr = 'sel_domainregister_' . $request->ele_key;
        $cartData = null;
        if (isset($request->$eleStr)) {
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            $cartData[$request->ele_key]['regperiod'] = $request->$eleStr;
        }
        $request->session()->put('cart', $cartData);
        Cart::updateCartInDb($request,$cartData); //Update current session in db
        //return view('cart.domain', ['cartItem' => $cartData[$request->ele_key], 'key' => $request->ele_key]);
        return 1;
    }

    public function updatehosting(Request $request) {
        Self::getconstants();
        $eleStr = 'sel_hostingregister_' . $request->ele_key;

        if (isset($request->$eleStr)) {
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            $cartData[$request->ele_key]['billingcycle'] = $request->$eleStr;
            $cartData[$request->ele_key]['regperiod'] = Cart::getRegistrationPeriodByName($request->$eleStr);
            //set free domain details ------------------------------------- 
            if (isset($cartData[$request->ele_key]['allowfreedomain'])) {
                unset($cartData[$request->ele_key]['allowfreedomain']);
            }

            if (isset($cartData[$request->ele_key]['pid']) && $cartData[$request->ele_key]['producttype'] != 'domain') {
                $freeDomainData = Cart::checkForFreeDomain($cartData[$request->ele_key]['pid']);

                if (!empty($freeDomainData['freedomain'])) {
                    $payterms = explode(",", $freeDomainData['freedomainpaymentterms']);
                    if (in_array($cartData[$request->ele_key]['billingcycle'], $payterms)) {
                        $cartData[$request->ele_key]['allowfreedomain'] = $freeDomainData;
                        if (!empty($cartData[$request->ele_key]['domain'])) {
                            foreach ($cartData as $itmkey => $itm) {
                                if (isset($itm['producttype']) && $itm['producttype'] == 'domain' && $itm['domain'] == $cartData[$request->ele_key]['domain']) {
                                    $cartData[$itmkey]['free'] = 1;
                                }
                            }
                        }
                    } else {
                        if (!empty($cartData[$request->ele_key]['domain'])) {
                            foreach ($cartData as $itmkey => $itm) {

                                if (isset($itm['producttype']) && $itm['producttype'] == 'domain' && $itm['domain'] == $cartData[$request->ele_key]['domain']) {
                                    if (isset($cartData[$itmkey]['free']))
                                        unset($cartData[$itmkey]['free']);
                                }
                            }
                        }
                    }
                }
                else {
                    if (!empty($cartData[$request->ele_key]['domain'])) {
                        foreach ($cartData as $itmkey => $itm) {
                            if (isset($itm['producttype']) && $itm['producttype'] == 'domain' && $itm['domain'] == $cartData[$request->ele_key]['domain']) {
                                if (isset($cartData[$itmkey]['free']))
                                    unset($cartData[$itmkey]['free']);
                            }
                        }
                    }
                }
            }
            //set free domain details ------------------------------------- 
            $request->session()->put('cart', $cartData);
            Cart::updateCartInDb($request,$cartData); //Update current session in db
        }
        return "1";
        //return view('cart.hosting', ['cartItem' => $cartData[$request->ele_key], 'key' => $request->ele_key]);
    }

    public function config(Request $request) {
        Self::getconstants();
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
         // echo "vps_cpu_select: ".Session::get('vps_cpu_select');
         // echo "vps_ram_select: ".Session::get('vps_ram_select');
         // echo "vps_hdd_select:".Session::get('vps_hdd_select');
         // echo '<pre>';print_r($cartData);
         // exit;
        $id = $request->id;
        $productData = $cartData[$id];
        $arr = Cart::getProductsData($productData['pid'])[$productData['pid']]->specifications;
        $arr = nl2br($arr);
        $arr = explode('<br />', $arr);
        $productData['specifications'] = $arr;
        $finalPrice = 0;
        $finalPrice += $productData['pricing'][$productData['regperiod']]->price;


        if (!empty($productData['configfields'])) {
            foreach ($productData['configfields'] as $field) {
                if (isset($field['selectedOption'])) {
                    if (!empty($field['options'])) {
                        foreach ($field['options'] as $opt) {
                            if ($opt['id'] == $field['selectedOption']) {
                                $finalPrice += $opt['pricing']['price'][$productData['regperiod']];
                            }
                        }
                    }
                }
            }
        }
        $params = [];
        $params['currency'] = Config::get('Constant.sys_currency');
        $params['domain_type'] = "domainregister";
        $Tld_array = ProductCategory::GetTldData($params);

        if (!empty($Tld_array)) {
            foreach ($Tld_array as $value) {
                $Tlds[] = $value->varTitle;
            }
        }

        $productData['finalprice'] = $finalPrice;


        $reqData = $request->all();
        
        //Site lock Changes ---------------------------
        $cartDataSitelock = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        return view('cart.config', ['productData' => $productData, "key" => $id, "tlds" => $Tlds,'cartDataSitelock' => $cartDataSitelock]);
        
    }

    public function setconfigoptionvalue(Request $request) {
        Self::getconstants();
        Cart::updateConfig($request);

        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        $productData = $cartData[$request->productid];

        $finalPrice = 0;
        $finalPrice += $productData['pricing'][$productData['regperiod']]->price;
        if (!empty($productData['configfields'])) {
            foreach ($productData['configfields'] as $field) {
                if (isset($field['selectedOption'])) {
                    if (!empty($field['options'])) {
                        foreach ($field['options'] as $opt) {
                            if ($opt['id'] == $field['selectedOption']) {
                                $finalPrice += $opt['pricing']['price'][$productData['regperiod']];
                            }
                        }
                    }
                }
            }
        }
        $productData['finalprice'] = $finalPrice;


        return $finalPrice;
    }
    public function getconfigfinalprice(Request $request){
        //Self::getconstants();
        //echo '<pre>';print_r($request->all());exit;
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        $productData = $cartData[$request->productid];

        $finalPrice = 0;
        $finalPrice += $productData['pricing'][$productData['regperiod']]->price;
        if (!empty($productData['configfields'])) {
            foreach ($productData['configfields'] as $field) {
                if (isset($field['selectedOption'])) {
                    if (!empty($field['options'])) {
                        foreach ($field['options'] as $opt) {
                            if ($opt['id'] == $field['selectedOption']) {
                                $finalPrice += $opt['pricing']['price'][$productData['regperiod']];
                            }
                        }
                    }
                }
            }
        }
        $productData['finalprice'] = $finalPrice;


        return $finalPrice;
    }    
    public function setcustomoptionvalue(Request $request) {
        echo '<pre>123: ';print_r($request->all());exit;
        Self::getconstants();
        Cart::updateCustom($request);
        return "1";
    }

    public function updateserver(Request $request) {
        Self::getconstants();
        $eleStr = 'sel_hostingregister_' . $request->ele_key;

        if (isset($request->$eleStr)) {
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            $cartData[$request->ele_key]['billingcycle'] = $request->$eleStr;
            $cartData[$request->ele_key]['regperiod'] = Cart::getRegistrationPeriodByName($request->$eleStr);

            //set free domain details ------------------------------------- 
            if (isset($cartData[$request->ele_key]['pid']) && $cartData[$request->ele_key]['producttype'] != 'domain') {
                $freeDomainData = Cart::checkForFreeDomain($cartData[$request->ele_key]['pid']);
                if (!empty($freeDomainData['freedomain'])) {
                    $payterms = explode(",", $freeDomainData['freedomainpaymentterms']);
                    $billingStr = str_replace("-", "", $cartData[$request->ele_key]['billingcycle']);
                    if (in_array($billingStr, $payterms)) {
                        $cartData[$request->ele_key]['allowfreedomain'] = $freeDomainData;
                    }
                }
            }
            //set free domain details ------------------------------------- 
            $request->session()->put('cart', $cartData);
            Cart::updateCartInDb($request,$cartData); //Update current session in db
        }
        return view('cart.dedicatedserver', ['cartItem' => $cartData[$request->ele_key], 'key' => $request->ele_key]);
    }

    public function view(Request $request) {
        Self::getconstants();
        //echo '<pre>';
        //print_r($_SERVER);
        //$allRequest = $request->all();
        //echo '<pre>';
        //print_r($allRequest);
        //$final_cart_array = $request->session()->has('WhmcsID') ? (array) $request->session()->get('WhmcsID') : null;
        $final_cart_array = $request->session()->all();
        echo "<pre/>";
        print_r($final_cart_array);
        exit;
    }

    public function getrecommandation(Request $request) {
        Self::getconstants();
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        $productid = Cart::getRcommandedProduct($request);

        if ($productid != false) {
            $productData = Cart::getRecommandedProductFeatures($productid);
            $productPricing = Cart::getHostingPricing(['productid' => $productid, 'currencycode' => Config::get('user.currencycode')]);

            $proFeatures = explode("\n", $productData->txtRecommandedFeatures);

            $finalData = ["pid" => $productid, "groupname" => $productData->groupname, "productname" => $productData->productname, "features" => $proFeatures];

            if (!empty($productPricing)) {
                foreach ($productPricing as $key => $price) {
                    if ($price->price > 0) {
                        if (!isset($finalData['pricing'])) {
                            $finalData['pricing'] = $price;
                        }
                    }
                }
            }

            return view('cart.recommanded', ['product' => $finalData]);
            //echo json_encode($finalData);exit;
        }
    }

    public function suggesteddomains(Request $request) {
        Self::getconstants();
        $tldsArr = explode(",", Config::get('user.suggestedtlds'));

        if (!empty($tldsArr)) {
            foreach ($tldsArr as $tld) {
                $domainPricing[$tld] = Cart::getDomainPricing(['tlds' => "." . $tld, 'currency' => Config::get('user.currency')]);
                //check for Dot in tlds. ".com"
            }
        }

        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        
        if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
        if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
        if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
        if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
        if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
        if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }


        $cartDomains = array();
        if (!empty($cartData)) {
            foreach ($cartData as $item) {
                if ($item['producttype'] == 'domain') {
                    $cartDomains[] = Cart::extractTldFromDomain($item['domain']);
                }
            }
        }

        if (!isset($cartDomains) || empty($cartDomains)) {
            return "";
            exit;
        }
        $suggestedDomains = array();
        if (!empty($cartDomains)) {
            foreach ($cartDomains as $domain) {
                foreach ($tldsArr as $tld) {
                    $suggestedDomains[] = $domain['domainname'] . "." . $tld;
                }
            }
        }

        $suggestedDomains = array_filter($suggestedDomains);
        $suggestedDomains = array_unique($suggestedDomains);
        //echo '<pre>Before: ';print_r($suggestedDomains);
        if (!empty($cartDomains)) {
            foreach ($cartDomains as $domain) {
                foreach ($suggestedDomains as $key => $dn) {
                    //echo $domain['fullname']. " - " .$dn."\n";
                    if ($domain['fullname'] == $dn) {
                        // echo $domain['fullname']. " - " .$dn."\n";
                        unset($suggestedDomains[$key]); //remove already existing domain
                    }
                }
            }
        }

        $params = array();
        if (!empty($suggestedDomains)) {
            foreach ($suggestedDomains as $item) {
                $params[] = Cart::extractTldFromDomain($item);
            }
        }
        $domainAvailData = Cart::checkDomainAvailability($params);
        if (!empty($domainAvailData)) {
            $domainAvailData = json_decode($domainAvailData);
        }

        $finalData = array();
        if (!empty($domainAvailData)) {
            foreach ($domainAvailData as $key => $domain) {
                if ($domain->status == 'available' && in_array($key, $suggestedDomains)) {
                    $finalData[$key]['status'] = $domain->status;
                    $finalData[$key]['data'] = $ctld = Cart::extractTldFromDomain($key)['tld'];
                    $finalData[$key]['tld'] = $ctld;
                    $finalData[$key]['pricing'] = $domainPricing[$ctld][0]; //if domain not selling at 3rd year then set pricing of 1st year by default
                }
            }
        }
        return view('cart.suggesteddomains', ['domains' => $finalData]);
    }

    public function adddomainaddons(Request $request) {
        Self::getconstants();
        $cartitemkey = $request->cartitemkey;
        $addonitemkey = $request->addonitemkey;
        if (isset($request->cartitemkey) && isset($request->addonitemkey)) {
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            $cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['added'] = $request->cartitemkey[0];
            $request->session()->put('cart', $cartData);
            Cart::updateCartInDb($request,$cartData); //Update current session in db
        }
        return "1";
    }

    public function hidedomainaddons(Request $request) {
        Self::getconstants();
        $cartitemkey = $request->cartitemkey;
        $addonitemkey = $request->addonitemkey;
        if (isset($request->cartitemkey) && isset($request->addonitemkey)) {
            $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
            $cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['hide'] = 1;
            $request->session()->put('cart', $cartData);
            Cart::updateCartInDb($request,$cartData); //Update current session in db
        }
        return "1";
    }

    public function removeaddon(Request $request) {
        Self::getconstants();
        // $postData = $request->all();
        // echo '<pre>';print_r($postData);exit;
        $status = 0;
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;

        if (isset($request->id)) {
            $id = $request->id;
        }

        $cartitemkey = $request->cartitemkey[0];
        $addonitemkey = $request->addonitemkey[0];
        $proId = '';
        if (isset($request->cartitemkey) && isset($request->addonitemkey)) {
            if (isset($cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['added'])) {
                $proId = isset($cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['pid']) ? $cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['pid'] : '';
                unset($cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['added']);
                $status ++;
            }
        }

        if (!empty($cartData) && !empty($proId)) {
            foreach ($cartData as $key => $cart) {
                if (isset($cart['relatedpro']) && $cart['relatedpro'] == $id && $proId == $cart['pid']) {
                    unset($cartData[$key]);
                    $status ++;
                }
            }
        }

        $request->session()->put('cart', $cartData);
        Cart::updateCartInDb($request,$cartData); //Update current session in db
        return $status;
    }

    public function removedomainaddon(Request $request) {
        Self::getconstants();
        $status = 0;
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;

        if (isset($request->id)) {
            $id = $request->id;
        }

        $cartitemkey = $request->cartitemkey[0];
        $addonitemkey = $request->addonitemkey[0];

        if (isset($request->cartitemkey) && isset($request->addonitemkey)) {
            if (isset($cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['added'])) {
                unset($cartData[$request->cartitemkey[0]]['addonproducts'][$request->addonitemkey[0]]['added']);
                $status ++;
            }
            $request->session()->put('cart', $cartData);
            Cart::updateCartInDb($request,$cartData); //Update current session in db
        }

        return $status;
    }

    public function converttowhmcs(Request $request) {
        Self::getconstants();
        //this will convert laravel cart to WHMCS.
        return Cart::convertToWHMCS($request);
    }

    public function getordersummary(Request $request) {

        Self::getconstants();
        //display order summary
        $cartData = Cart::createOrderSummary($request);
        
        if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
        if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
        if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }  

        $addonProducts = [];
        foreach ($cartData as $item) {
            if (isset($item['relatedpro'])) {
                $addonProducts[$item['relatedpro']][] = $item;
            }
        }

        $deleteBtn = $request->deleteHide;
        $displayData = ['cartData' => $cartData, 'addonProducts' => $addonProducts];
        if (isset($request->deleteHide)) {
            $displayData['deleteHide'] = 1;
        }
        return view('cart.ordersummary', $displayData);
    }

    public function configdomain(Request $request) {
        Self::getconstants();
        Cart::setConfigDomain($request);
        return 1;
    }

    public function checkconfigdomainname(Request $request) {
        Self::getconstants();
        $params[0]['domainname'] = $request->bookdomaintxt;
        $params[0]['tld'] = $request->selTld;
        $params[0]['fullname'] = $request->bookdomaintxt . "." . $request->selTld;

        //echo '<pre>';print_r($params);
        $domainAvailData = Cart::checkDomainAvailability($params);
        //echo '<pre>';print_r($domainAvailData);exit;
        $domainAvailData = json_decode($domainAvailData, true);
        

        $tldparams = [];
        $tldparams['currency'] = Config::get('Constant.sys_currency');
        $tldparams['tld'] = $params[0]['tld'];
        $tldparams['domain_type'] = "domainregister";
        $Tld_Availibity = ProductCategory::GetTldData($tldparams);
        
        $priceingStr = "";
        if(isset($Tld_Availibity[0]->Price1) && !empty($Tld_Availibity[0]->Price1)){
            $priceingStr = "at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span>".$Tld_Availibity[0]->Price1. "/ Year";
        }
        else if(isset($Tld_Availibity[0]->Price2) && !empty($Tld_Availibity[0]->Price2)){
            $priceingStr = "at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span>".$Tld_Availibity[0]->Price2. "/ 2 Years";
        }
        else if(isset($Tld_Availibity[0]->Price3) && !empty($Tld_Availibity[0]->Price3)){
            $priceingStr = "at <span class='rupees'>" . Config::get('Constant.sys_currency_symbol') . "</span>".$Tld_Availibity[0]->Price3. "/ 3 Years";
        }
        else {  $priceingStr = ""; }

        $response = array();
        $params[0]['fullname'] = trim($params[0]['fullname']);
        $params[0]['fullname'] = strtolower($params[0]['fullname']);
        if (isset($domainAvailData[$params[0]['fullname']]['status']) && $domainAvailData[$params[0]['fullname']]['status'] == 'available') {
            $response['status'] = "available";
            $response['msg'] = $params[0]['fullname'] . " is available " . $priceingStr;
            $response['producttype'] = ['domain'];
            $response['domain'] = [$params[0]['fullname']];
            $response['tld'] = ["." . $params[0]['tld']];
            $response['domaintype'] = ["register"];
            $response['regperiod'] = ["1"];
        } else {
            $response['status'] = "unavailable";
            $response['msg'] = $params[0]['fullname'] . " is not available.";
        }
        return $response;
    }

    public function cartsignin(Request $request) {
        Self::getconstants();
        //display order summary
        $frontlogin = $request->session()->get('frontlogin');
        $userid = $request->session()->get('UserID');
        $whmcsid = $request->session()->get('WhmcsID');
        $contacts = ContactInfo::getContactDetails();
        $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
        $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        if (isset($frontlogin) && $frontlogin == 'Y' && isset($userid) && !empty($userid) && isset($whmcsid) && !empty($whmcsid)) {
            return redirect()->action('CartController@billinginfo');
        } else {
            return view('cart.signin', ["contact_phonenumber" => $PhoneNumner, "contact_emailid" => $EmailId]);
        }
    }

    public function billinginfo(Request $request) {
        Self::getconstants();
        //Update Session from Database -----------------------------------
        if (!empty($request->session()->get('UserID'))) {
                $User_ID = $request->session()->get('UserID');
                $get_previus_data = user_session::where('user_id', '=', $User_ID)->first(); // get previously session data for user
                if(!empty($get_previus_data)){ $prev_payload = unserialize(base64_decode($get_previus_data->payload)); }
                if(!empty($prev_payload)){
                    //echo '<pre>';print_r($prev_payload);exit;
                    $request->session()->put('cart', $prev_payload);
                }
                

            }
       //Update Session from Database End----------------------------------- 

        $userid = $request->session()->get('UserID');
        $whmcsid = $request->session()->get('WhmcsID');

        //if user not logged in
        if(empty($userid) || empty($whmcsid)){ return redirect()->action('CartController@index'); }
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;

        if(!empty($cartData)){ 
        //if there is not item in cart
        if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
        if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
        if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
        if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
        if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
        if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
        }

        if(empty($cartData) || count($cartData) < 1){ return redirect()->action('CartController@index'); }

        $details = Cart::getClientDetails($whmcsid);
        $countryCMB = Cart::generateCountryCombo($details['country'], "country");
        $contacts = ContactInfo::getContactDetails();
        $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
        $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        return view('cart.billinginfo', ['clientData' => $details, 'countrycmb' => $countryCMB, 'clientid' => $whmcsid, "contact_phonenumber" => $PhoneNumner, "contact_emailid" => $EmailId]);
    }

    public function updatebillinginfo(Request $request) {
        Self::getconstants();
        if (isset($request->h_save) && $request->h_save == 'Y') {
            Cart::updateClientDetails($request);
            return redirect()->action('CartController@paymentoptions');
        }
    }

    public function paymentoptions(Request $request) {
        Self::getconstants();
        //Update Session from Database -----------------------------------
        if (!empty($request->session()->get('UserID'))) {
                $User_ID = $request->session()->get('UserID');
                $get_previus_data = user_session::where('user_id', '=', $User_ID)->first(); // get previously session data for user
                if(!empty($get_previus_data)){ $prev_payload = unserialize(base64_decode($get_previus_data->payload)); }
                if(!empty($prev_payload)){
                    //echo '<pre>';print_r($prev_payload);exit;
                    $request->session()->put('cart', $prev_payload);
                }
                

            }
       //Update Session from Database End----------------------------------- 
        $userid = $request->session()->get('UserID');
        $whmcsid = $request->session()->get('WhmcsID');


         //if user not logged in
        if(empty($userid) || empty($whmcsid)){ return redirect()->action('CartController@index'); }
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;

       if(!empty($cartData)){ 
            //if there is not item in cart
            if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
            if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
            if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
            if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
            if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
            if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
        }


        if(empty($cartData) || count($cartData) < 1){ return redirect()->action('CartController@index'); }

        $details = Cart::getClientDetails($whmcsid);
        $addressline1 = $addressline2 = '';
        if (!empty($details)) {
            if (isset($details['address1']) && !empty($details['address1'])) {
                $addressline1 .= $details['address1'];
            }
            if (isset($details['address2']) && !empty($details['addressaddress21'])) {
                $addressline1 .= ", " . $details['address2'];
            }
            if (isset($details['city']) && !empty($details['city'])) {
                $addressline2 .= $details['city'];
            }
            if (isset($details['state']) && !empty($details['state'])) {
                $addressline2 .= ", " . $details['state'];
            }
            if (isset($details['countryname']) && !empty($details['countryname'])) {
                $addressline2 .= ", " . $details['countryname'];
                $country = strtolower($details['countryname']);
            }
            if (isset($details['postcode']) && !empty($details['postcode'])) {
                $addressline2 .= " " . $details['postcode'];
            }
        }
        $contacts = ContactInfo::getContactDetails();
        $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
        $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        return view('cart.paymentoptions', ['clientData' => $details,'country' => $country ,'addressline1' => $addressline1, 'addressline2' => $addressline2, "contact_phonenumber" => $PhoneNumner, "contact_emailid" => $EmailId]);
    }

    public function orderinfo(Request $request) {
        Self::getconstants();
        return view('cart.orderinfo', ['clientData' => $details, 'addressline1' => $addressline1, 'addressline2' => $addressline2]);
    }

    public function updatepromo(Request $request) {
        Self::getconstants();
        $action = $discount = $promo = $prmomessage = NULL;
        if (isset($request->action)) {
            $action = $request->action;
        }

        if (isset($request->promo)) {
            $promo = $request->promo;
        }

        if (isset($request->discount)) {
            $discount = $request->discount;
        }

        if (isset($request->prmomessage)) {
            $prmomessage = $request->prmomessage;
        }



        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        if ($action == 'add') {
            $cartData['prmocode'] = $promo;
            $cartData['prmodiscount'] = $discount;
            $cartData['prmomessage'] = $prmomessage;
        } else {
            unset($cartData['prmocode']);
            unset($cartData['prmodiscount']);
            unset($cartData['prmomessage']);
        }
        $request->session()->put('cart', $cartData);
        Cart::updateCartInDb($request,$cartData); //Update current session in db
    }

    public function getfreedomain(Request $request) {
        Self::getconstants();
        $params = [];
        if (isset($request->domainname)) {
            $params['domainname'] = $request->domainname;
        }
        if (isset($request->tld)) {
            $params['tld'] = $request->tld;
        }
        if (isset($request->alltlds)) {
            $params['alltlds'] = $request->alltlds;
        }
        if (isset($request->relproid)) {
            $params['relproid'] = $request->relproid;
        }
        echo Cart::getFreeDomains($params);
        exit;
    }

    public function getsearchcartdomain(Request $request) {
        Self::getconstants();
        $params = [];
        if (isset($request->domainname)) {
            $params['domainname'] = $request->domainname;
        }
        if (isset($request->tld)) {
            $params['tld'] = $request->tld;
        }
        if (isset($request->alltlds)) {
            $params['alltlds'] = $request->alltlds;
        }

        echo Cart::getSearchCartDomains($params);
        exit;
    }

    public function thankyou(Request $request) {

        Self::getconstants();
        $data = [];
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;

        // $domain = "";
        if(!empty($cartData)){
        if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
        if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
        if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
        if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
        if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
        if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
        }


        $orderId = "";
        if (isset($request->orderid)) {
            $orderId = $request->orderid;
        } else if (isset($request->invoiceid)) {
            $orderIdData = Cart::getOrderIdFromInvoiceId(['invoiceid' => $request->invoiceid]);
            if (isset($orderIdData['id'])) {
                $orderId = $orderIdData['id'];
            }
        }

        if (isset($orderId)) {
            $data['orderid'] = $orderId;
            file_put_contents("betaorderlog.txt", "\n ".date('Y/m/d H:i:s')." payment Done for order id: " . $orderId, FILE_APPEND);
        }
        else{ return abort(404); }
        //echo $data['orderid'];exit;
        //Cart::sendOrderEmail($data['orderid']); //send invoice email
        //------------------------------------------Domain Suggestion----------------------------------------------------
        $tldsArr = explode(",", Config::get('user.suggestedtlds'));
        if (!empty($tldsArr)) {
            foreach ($tldsArr as $tld) {
                $domainPricing[$tld] = Cart::getDomainPricing(['tlds' => "." . $tld, 'currency' => Config::get('user.currency')]);
                //check for Dot in tlds. ".com"
            }
        }
        $productExistsCart = array();
        $cartDomains = array();
        //echo '<pre>';print_r($cartData);exit;
        if (!empty($cartData)) {
            foreach ($cartData as $item) {
                if (isset($item['producttype']) && $item['producttype'] == 'domain') {
                    $cartDomains[] = Cart::extractTldFromDomain($item['domain']);
                } else {
                    $productExistsCart[] = $item['pid'];
                }
            }
        }

        $suggestedDomains = array();
        if (!empty($cartDomains)) {
            foreach ($cartDomains as $domain) {
                foreach ($tldsArr as $tld) {
                    $suggestedDomains[] = $domain['domainname'] . "." . $tld;
                }
            }
        }

        $suggestedDomains = array_filter($suggestedDomains);
        $suggestedDomains = array_unique($suggestedDomains);
        if (!empty($cartDomains)) {
            foreach ($cartDomains as $domain) {
                foreach ($suggestedDomains as $key => $dn) {
                    //echo $domain['fullname']. " - " .$dn."\n";
                    if ($domain['fullname'] == $dn) {
                        // echo $domain['fullname']. " - " .$dn."\n";
                        unset($suggestedDomains[$key]); //remove already existing domain
                    }
                }
            }
        }
        $finalData = array();
        $params = array();
        if (!empty($suggestedDomains)) {
            foreach ($suggestedDomains as $item) {
                $params[] = Cart::extractTldFromDomain($item);
            }
        }
        if (!empty($params)) {
            $domainAvailData = Cart::checkDomainAvailability($params);
            if (!empty($domainAvailData)) {
                $domainAvailData = json_decode($domainAvailData);
            }


            if (!empty($domainAvailData)) {
                foreach ($domainAvailData as $key => $domain) {

                    if ($domain->status == 'available' && in_array($key, $suggestedDomains)) {
                        $finalData[$key]['status'] = $domain->status;
                        $finalData[$key]['data'] = $ctld = Cart::extractTldFromDomain($key)['tld'];
                        $finalData[$key]['tld'] = $ctld;
                        $finalData[$key]['pricing'] = $domainPricing[$ctld][0]; //if domain not selling at 3rd year then set pricing of 1st year by default
                    }
                }
            }
        }
        //---------------------------------------------------------------------------------------------------------------


        $productArr = array();
        $productArr[179]['image'] = "linux-icon.svg";

        $productArr[186]['image'] = "wordpress-icon.svg";

        $productArr[175]['image'] = "reseller.svg";

        $productArr[176]['image'] = "reseller.svg";

        $productArr[155]['image'] = "wordpress.svg";

        $productArr[158]['image'] = "java-i.svg";

        $productArr[161]['image'] = "ecommerce.svg";

        $productArr[183]['image'] = "dedicated.svg";

        //$productArr[154]['image'] = "vps-icon.svg";

        $productArr[195]['image'] = "ssl.svg";

        $productData = [];

        if (!empty($productArr)) {
            foreach ($productArr as $key => $productId) {
                if (!in_array($key, $productExistsCart)) {
                    $proData = Cart::getRecommandedProductFeatures($key);
                    $proPricing = Cart::getHostingPricing(['productid' => $key, 'currencycode' => Config::get('user.currencycode')]);
                    $productData[] = ["data" => $proData, "pricing" => $proPricing, "image" => $productArr[$key]['image']];
                }
            }
        }
        $data['proData'] = $productData;
        //echo '<pre>';print_r($data['proData']);exit;
        $cartData = [];
        $request->session()->put('cart', $cartData);
        Cart::updateCartInDb($request,$cartData); //Update current session in db
        $contacts = ContactInfo::getContactDetails();
        $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
        $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        //echo '<pre>';print_r($data);exit;
        return view('cart.thankyou', ['data' => $data, "domainData" => $finalData, "contact_phonenumber" => $PhoneNumner, "contact_emailid" => $EmailId]);
    }

   public function paypalsuccess(Request $request) {
    /*Self::getconstants();
    $postData = $request->all();
    
    file_put_contents('paypaldata_log.txt', "\n------------------- Date".date("m-d-YY")." -----------------\n".print_r($postData,true), FILE_APPEND);
    if(isset($postData['custom'])){ $invoiceid = $postData['custom']; }
    
    if(empty($invoiceid)){
        $item_nam = "";
        if (isset($postData['item_name'])) {
            $item_nam = $postData['item_name'];
        }
        $arr = explode("#", $item_nam);
        $invoiceid = $arr[1];
    }*/
    $invoiceid = '';
    $str = '<html>
                <head><title>Thank you</title></head>
                <body onload="document.getElementById(\'frmpayment\').submit();">
                    <form method="post" id="frmpayment" name="frmpayment" action="' . url("/") . '/cart/thankyou">
                        <input type="hidden" id="_token" name="_token" value="' . csrf_token() . '"/>
                        <input type="hidden" id="invoiceid" name="invoiceid" value="' . $invoiceid . '"/>
                    </form>
                    <script type="text/javascript">document.getElementById(\'frmpayment\').submit();</script>
                </body>
            </html>';
    echo $str;
    exit;
    //echo '<pre>';print_r($postData);
}

    public function ccavenuesuccess(Request $request) {
        Self::getconstants();
        $postData = $request->all();
        echo '<pre>';
        print_r($postData);
    }

    public function orderemail(Request $request) {
        Self::getconstants();
        $orderid = $request->orderid;
        $orderDetails = Cart::getOrderDetails(['id' => $orderid]);
        if (isset($orderDetails['invoiceid'])) {
            $invoiceDetails = Cart::getInvoiceDetails(['invoiceid' => $orderDetails['invoiceid']]);
        }

        if (isset($orderDetails['userid'])) {
            $userDetails = Cart::getClientDetails($orderDetails['userid']);
        }
        //echo '<pre>';print_r($userDetails);exit;

        $AllData = [];
        if (isset($userDetails['fullname']) && !empty($userDetails['fullname'])) { //if full name found
            $AllData["name"] = $userDetails['fullname'];
        } else if (isset($userDetails['firstname']) && !empty($userDetails['firstname'])) { //else if firstname lastname found
            $AllData["name"] = $userDetails['firstname'] . " " . $userDetails['lastname'];
        } else if (isset($userDetails['companyname']) && !empty($userDetails['companyname'])) { //else company found
            $AllData["name"] = $userDetails['companyname'];
        } else {
            $AllData["name"] = $userDetails['email'];
        } // last set email id.
        foreach ($orderDetails['lineitems']['lineitem'] as $key => $item) {
            $str = str_replace(".00", "", $item['amount']);
            $str = str_replace("INR", "", $str);
            $str = str_replace(",", "", $str);
            $orderDetails['lineitems']['lineitem'][$key]['amount'] = str_replace("USD", "", $str);
        }
        $AllData['email'] = $userDetails['email'];
        $AllData['orderid'] = $orderid;
        $AllData['orderitems'] = $orderDetails['lineitems']['lineitem'];
        $AllData['subtotal'] = str_replace(".00", "", $invoiceDetails['subtotal']);
        $AllData['tax'] = $invoiceDetails['tax'] + $invoiceDetails['tax2'];
        $AllData['total'] = $invoiceDetails['total'];
        $AllData['currency_code'] = ($userDetails['currency_code'] == 'INR') ? "&#8377;" : "&#36;";
        $AllData['invoiceid'] = $orderDetails['invoiceid'];

        Email_sender::orderemail($AllData);
    }

    public function paymentfail() {
        $contacts = Cart::getContactDetails();
        $emailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        return view('cart.paymentfail', ['emailId' => $emailId]);
    }

    function remove_all_special_char($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9.\-]/', '', $string); // Removes special chars.
    }

    function getvpsconfig(Request $request){
        $result  = array();
        $vpsconfig = Cart::getvpsconfiguration();
        $postData = $request->all();

        $proid = $config = $configval = $duration = $currency = null;
        if(!empty($postData['productid'])){ $proarr = explode("_",$postData['productid']); $proid = $proarr[2]; }
        if(!empty($postData['config'])){ $config = $postData['config']; }
        if(!empty($postData['configval'])){ $configval = $postData['configval']; }
        if(!empty($postData['duration'])){ $duration = $postData['duration']; }
        
        $params = array();
        if(isset($postData['default']) && $postData['default'] == 1){
             if(isset($postData['productid']) && !empty($postData['productid'])){
                $vpsPricing = Cart::getProductPricing(array('productid' => $proid,'currencycode' => Config::get('Constant.sys_currency')));
                
                $currency = Config::get('Constant.sys_currency');
                $result['cpu'] = $result['ram'] = $result['hdd'] = 0;
                //CPU
                if(isset($vpsconfig[$proid]['cpu']['2'][$duration][$currency])){
                    $result['cpu'] = $vpsconfig[$proid]['cpu']['2'][$duration][$currency];
                    $result['cpuconfig'] = "2 Core";
                }
                
                //RAM
                if(isset($vpsconfig[$proid]['ram']['2'][$duration][$currency])){
                    $result['ram'] = $vpsconfig[$proid]['ram']['2'][$duration][$currency];
                    $result['ramconfig'] = "2 GB";
                }

                //HDD
                if(isset($vpsconfig[$proid]['hdd']['20'][$duration][$currency])){
                    $result['hdd'] = $vpsconfig[$proid]['hdd']['20'][$duration][$currency];
                    $result['hddconfig'] = "20 GB";
                }
                
            }
        }
        else {
            if(isset($postData['productid']) && !empty($postData['productid'])){
                $vpsPricing = Cart::getProductPricing(array('productid' => $proid,'currencycode' => Config::get('Constant.sys_currency')));

                if($config == 'cpu')
                { $result['config'] = $configval. " Core"; } 
                else 
                { $result['config'] = $configval. " GB"; } 
                $currency = Config::get('Constant.sys_currency');
                if(isset($vpsconfig[$proid][$config][$configval][$duration][$currency])){
                    $result[$config] = $vpsconfig[$proid][$config][$configval][$duration][$currency];
                }
                else{
                    $result[$config] = 0;
                }
            }
        }


        $result['plan'] = 0;
        $duration = str_replace("-","",$duration);
        if(!empty($vpsPricing)){
            if(isset($vpsPricing[$duration]) && !empty($vpsPricing[$duration])){
                $result['plan'] = $vpsPricing[$duration];
            }
        }
        
        return json_encode($result);
    }
    public function getitemscounter(Request $request) {
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        if(isset($cartData) && !empty($cartData)){
            //if there is not item in cart
            if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
            if(array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
            if(array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }            
            if(array_key_exists('prmocode',$cartData))      { unset($cartData['prmocode']); }
            if(array_key_exists('prmodiscount',$cartData))  { unset($cartData['prmodiscount']); }
            if(array_key_exists('prmomessage',$cartData))   { unset($cartData['prmomessage']); }
            return count($cartData);
        }
        else{ return 0; }
    }

     public function testapi() {
        $tldparams = [];
        $tldparams['currencycode'] = Config::get('Constant.sys_currency');
        $tldparams['productid'] = "179";
        $Tld_array = Cart::getProductPricing($tldparams);
        echo '<pre>Product Details of id 179:</br> https://www.hostitsmart.com/manage/cart.php?a=add&pid=179  </br>';print_r($Tld_array);
        
        $data['email'] = 'demo1.netclues@gmail.com';
        $data['name'] = 'demo1.netclues';
        Email_sender::testingemail($data);
        
        
    }

}
