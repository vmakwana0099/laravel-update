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
use App\Front_user;
use App\ContactLead;
use App\whmcs;
use Cookie;
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
        Config::set('hitsupdatecart', "https://manage.hostitsmart.com" );
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
                        $addons['desc'] = "DNS Management";
                    }
                    $addons['desc'] = str_replace("INR", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                    $addons['desc'] = str_replace("USD", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                } else if ($key == 'emailforwarding') {
                    if (!empty($item[Config::get('user.currency')])) {
                        $addons['desc'] = "Email Forwarding";
                    } else {
                        $addons['desc'] = "Email Forwarding";
                    }
                    $addons['desc'] = str_replace("INR", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                    $addons['desc'] = str_replace("USD", Config::get('Constant.sys_currency_symbol'), $addons['desc']);
                } else if ($key == 'idprotection') {
                    if (!empty($item[Config::get('user.currency')])) {
                        $addons['desc'] = "ID Protection <span class='rupees'>" . Config::get('user.currencycode') . "</span> " . $item[Config::get('user.currency')] . " / year";
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
        // web hosting 
        
        $productTypes[495] = 'hosting';
        $productTypes[496] = 'hosting';
        $productTypes[497] = 'hosting';
        $productTypes[498] = 'hosting';

        //Linux hosting
        $productTypes[421] = 'hosting';
        $productTypes[422] = 'hosting';
        $productTypes[423] = 'hosting';
        $productTypes[424] = 'hosting';
        //Windows Hosting
        $productTypes[186] = 'hosting';
        $productTypes[187] = 'hosting';
        $productTypes[188] = 'hosting';
        //WordPress Hosting
        $productTypes[425] = 'hosting';
        $productTypes[426] = 'hosting';
        $productTypes[427] = 'hosting';
        $productTypes[428] = 'hosting';
        //JAVA Hosting
        $productTypes[158] = 'hosting';
        $productTypes[159] = 'hosting';
        $productTypes[160] = 'hosting';
        
        //E-Commerce Hosting 
        $productTypes[429] = 'hosting';
        $productTypes[430] = 'hosting';
        $productTypes[431] = 'hosting';
        $productTypes[432] = 'hosting';
        //Windows Reseller Hosting
        $productTypes[192] = 'hosting';
        $productTypes[174] = 'hosting';
        $productTypes[175] = 'hosting';
        //Linux Reseller Hosting 
        $productTypes[176] = 'hosting';
        $productTypes[177] = 'hosting';
        $productTypes[178] = 'hosting';
        
        //Dedicated Server
        $productTypes[357] = 'dedicatedserver';
        $productTypes[358] = 'dedicatedserver';
        $productTypes[361] = 'dedicatedserver';
        $productTypes[435] = 'dedicatedserver';
        //VPS 
        $productTypes[394] = 'vps';
        $productTypes[395] = 'vps';
        $productTypes[396] = 'vps';
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
        
        return redirect('cart/signin'); //redirect customer to signin page as new cart flow.
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
    public function adddomainconfigs(Request $request)
    {   echo "123456";
        exit;
        Self::getconstants();
        Cart::updateCustom($request);
        return "1";
        return redirect('/cart/domainconfig');
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
        $lastAddedKeyArr = array();
        $productData = Cart::getProductsData(); //get products data from database.
        // echo "<pre>";print_r($productData);exit;
        if ($request->has('jsonarr')) {
            $rowData = (array) json_decode($request->jsonarr);
        } else {
            $rowData = $request->all();
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
        
        if(isset($rowData['i']))
        {
            unset($rowData['i']);
        }
        
        // echo '<pre>';print_r($rowData);exit;
        $data = array();
        if(isset($rowData['vps_cpu'][1])){ unset($rowData['vps_cpu'][1]); }
        if(isset($rowData['vps_ram'][1])){ unset($rowData['vps_ram'][1]); }
        if(isset($rowData['vps_hdd'][1])){ unset($rowData['vps_hdd'][1]); }
        if(isset($rowData['selectedPak'][1])){ unset($rowData['selectedPak'][1]); }
        // echo '<pre>';print_r($rowData);exit;
        if (!empty($rowData)) {
            if(isset($request->landingdomain) && $request->landingdomain=="y")
            {   
                foreach($rowData as $key=>$ele)
                {
                   $data[0][$key]=$ele;
                }
            }
            else
            {
            if (isset($rowData['authcode'])) {
                foreach ($rowData as $key => $ele) {
                    foreach ($ele as $i => $itm) {
                        $data[$i][$key] = $itm;
                    }
                }
            } else {
                    
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
        }
        // echo "<pre>".print_r($productData);exit;
        foreach ($data as $requestData) {
            if(isset($requestData["domain"])){
                $Domain = str_replace("https://", "", $requestData["domain"]);
                $Domain = str_replace("http://", "", $Domain);
                $Domain = str_replace("www.", "", $Domain);
            }
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
           
            if (!empty($cartData_array) && isset($requestData["domain"]) && $requestData["producttype"] == "domain") {
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
            if (isset($requestData->pro_id))
                $item['pro_id'] = $requestData->pro_id;      //powerpanel prodictid for product
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
                
                //$item['domain'] = $requestData->domain;
                $item['domain'] = str_replace("/", "", $Domain);
            } else {
                $item['domain'] = '';
            };
            if (isset($requestData->domaintype))
                $item['domaintype'] = $requestData->domaintype;   //if Domain 
            if (isset($requestData->regperiod))
                $item['regperiod'] = $requestData->regperiod;    //if Domain 
            if (isset($requestData->authcode))
                $item['eppcode'] = $requestData->authcode;    //if Domain Transfer
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
           /* $tldsarr=$requestData->tld;
            $additionalfields=MyLibrary::additionalfields();
            if(isset($tldsarr))
            {   
                foreach($additionalfields as $dname=>$value)
                {
                    if($requestData->tld==$dname)
                    {
                        foreach($value as $key=>$attribute)
                        {   
                            if(isset($attribute['Options']))
                                {
                                    $customfield_domain = array(
                                    'id' => $key, 
                                    'name' => $attribute['Name'],
                                    'description' => '',
                                    'required' => '',
                                    'fieldtype' => $attribute['Type'],
                                    'fieldoptions' => $attribute['Options'],
                                    'selectedOption' => $attribute['Default']);
                                    $item['customfields'][$key] = $customfield_domain;
                                }
                                else
                                {
                                    $customfield_domain = array(
                                    'id' => $key, 
                                    'name' => $attribute['Name'],
                                    'description' => '',
                                    'required' => '',
                                    'fieldtype' => $attribute['Type'],
                                    'fieldoptions' => '',
                                    'selectedOption' => '');
                                    $item['customfields'][$key] = $customfield_domain;
                                }
                        }
                    }
                }
            }*/
               
               /*if($countd>0)
                {       
                return view('cart.domainconfig', ['tlds'=>$tldarray,'additionalfields'=>$additionalfields]);
                }
                else
                {
                return header('Location: https://beta.hostitsmart.com/cart');
                }*/
                if ($requestData->domaintype == 'transfer') {
                    $item['pricing'] = Cart::getDomainPricing(['tlds' => "." . $transfer_tld[1], 'currency' => Config::get('user.currency')]);  //check for Dot in tlds. ".com"
                } else {
                    $item['pricing'] = Cart::getDomainPricing(['tlds' => $requestData->tld, 'currency' => Config::get('user.currency')]);  //check for Dot in tlds. ".com"
                }
            }
            if (isset($requestData->producttype) && $requestData->producttype == 'hosting') {
                $item['pricing'] = Cart::getHostingPricing(['productid' => $requestData->pid, 'currencycode' => Config::get('user.currencycode')]);
                $item['regperiod'] = Cart::getRegistrationPeriodByName($item['billingcycle']);
                $productData_groupname = cart::getProductsData($item['pid'],'',$item['pro_id']);
                if (isset($productData[$item['pid']]->groupname)) {
                    if (isset($productData_groupname) && count($productData_groupname) > 0) {
                        $item['groupname'] = $productData_groupname[$item['pid']]->groupname;
                    }else{
                        // dd($_SERVER['HTTP_REFERER']);
                        if ($_SERVER['HTTP_REFERER'] == 'https://www.hostitsmart.com/web-hosting') {
                            $item['groupname'] = "Web Hosting";
                        } else {
                            $item['groupname'] = $productData[$item['pid']]->groupname;
                        }
                        
                    }
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
                if ($requestData->producttype == 'dedicatedserver') {
                    if ($item['billingcycle'] == 'semiannually') {
                           $item['billingcycle'] = 'semi-annually'; 
                       }                          
                }
                $item['regperiod'] = Cart::getRegistrationPeriodByName($item['billingcycle']);
                // echo "<pre>".$request->selectedPak[0];exit;
                if($item['pid'] == 238){
                    //For US vps products 22 Jan 2020.
                    if (isset($productData[236]->groupname)) {
                        $item['groupname'] = $productData[236]->groupname;
                    }
                    if (isset($productData[236]->productname)) {
                        // $item['planname'] = $productData[$item[236]]->productname;
                        $item['planname'] = $request->selectedPak[0]; //for select plane which one example-> starter, perfomence, business
                    }
                }
                else{
                if (isset($productData[$item['pid']]->groupname)) {
                    $item['groupname'] = $productData[$item['pid']]->groupname;
                }
                if (isset($productData[$item['pid']]->productname)) {
                        if ($item['pid'] == 236) {
                            $item['planname'] = $request->selectedPak[0]; //for select plane which one example-> starter, perfomence, business
                        }else{
                    $item['planname'] = $productData[$item['pid']]->productname;
                            // $item['planname'] = $request->selectedPak[0]; 
                }
                    }
                }
                $productData2 = Cart::getProductDetails(['productid' => $requestData->pid, 'currencycode' => Config::get('user.currencycode')]);
                // check config 
                $params['action']="configoptionchecker";
                $notAllowedOptionIdData = Whmcs::customCallAPI($params);
                // echo '<pre>';print_r($notAllowedOptionIdData);exit;
                $_hideConfigoptionArr=[]; $_hideConfigoptionSubArr=[];
                if (count($notAllowedOptionIdData['configoptionsObj']) > 0) {
                    foreach ($notAllowedOptionIdData['configoptionsObj'] as $optkey => $optval) {
                        $_hideConfigoptionArr[] = $optval['id'];
                    }
                }
                if (count($notAllowedOptionIdData['configoptionssubObj']) > 0) {
                    foreach ($notAllowedOptionIdData['configoptionssubObj'] as $optkey => $optval) {
                        $_hideConfigoptionSubArr[] = $optval['id'];
                    }
                }
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
                        if (!in_array($field['id'],$_hideConfigoptionArr)) {
                            $configArr = array();
                            $configArr['name'] = $field['name'];
                            $configArr['id'] = $field['id'];
                            
                            //-------- 23 Aug 2019 ------------------
                            $skipfields = array(330); //Skip this Configuration field
                            if(in_array($field['id'],$skipfields)){ continue; }
                            //-------- 23 Aug 2019 ------------------
                            
                            if (!empty($field['options']['option'])) {
                                foreach ($field['options']['option'] as $option) {
                                    
                                    //-------- 23 Aug 2019 ------------------
                                    $skipOptions = array(580,593,608,631,656,996,1113,1114,1115,1148,1149,1150); //Skip this option cpanel - 996 for 16GB RAM
                                        $_hideConfigoptionSubArr=array_merge($_hideConfigoptionSubArr,$skipOptions);
                                        if(in_array($option['id'],$_hideConfigoptionSubArr)){ continue; }
                                    // if(in_array($option['id'],$skipOptions)){ continue; }
                                    //-------- 23 Aug 2019 ------------------
                                    
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
                            //--------------------- 21 Jan 2020 --------------------------
                            if(isset($requestData->vps_ram) && !empty($requestData->vps_ram) ){
                                // echo "<pre>".print_r($requestData->pid);exit;
                                if($configArr['id'] == 190){ $configArr['selectedOption'] = $requestData->vps_ram; }// RAM 
                                if($configArr['id'] == 189){ $configArr['selectedOption'] = $requestData->vps_cpu; }// CPU Core 
                                if($configArr['id'] == 191){ $configArr['selectedOption'] = $requestData->vps_hdd; }// HardDisk
                                if($configArr['id'] == 191){ $configArr['selectedOption'] = $requestData->vps_hdd; }// Pakname
                                if($requestData->pid == 236 || $requestData->pid == 238){
                                    if($configArr['id'] == 193){ $configArr['selectedOption'] = "1020"; }
                                }
                            }else{
                                // echo "<pre>".print_r($requestData);exit;
                                // if($configArr['id'] == 190){ $configArr['selectedOption'] = $requestData->vps_ram; }// RAM 
                                // if($configArr['id'] == 189){ $configArr['selectedOption'] = $requestData->vps_cpu; }// CPU Core 
                                // if($configArr['id'] == 191){ $configArr['selectedOption'] = $requestData->vps_hdd; }// HardDisk
                            }
                            //--------------------- 21 Jan 2020 --------------------------
                            $productConfigFieldsData[] = $configArr;
                            // 1020
                        }
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
                 $customfielids = [
        // '155' => 366, // WordPress -> Starter
        // '156' => 367, // WordPress -> Performance
        // '157' => 368, // WordPress -> Business
        // '158' => 360, // Java Hosting -> Starter
        // '159' => 361, // Java Hosting -> Performance
        // '160' => 362, // Java Hosting -> Business
        // '161' => 363, // Ecommerce -> Starter
        // '162' => 364, // Ecommerce -> Performance
        // '163' => 365, // Ecommerce -> Business
        '495' => 1132, // web hosting -> BASIC
        '496' => 1133, // web hosting -> ESSENTIAL
        '497' => 1134, // web hosting -> PROFESSIONAL
        '498' => 1135, // web hosting -> ENTERPRISE

        '421' => 1136, // Linux hosting -> BASIC
        '422' => 1137, // Linux hosting -> ESSENTIAL
        '423' => 1138, // Linux hosting -> PROFESSIONAL
        '424' => 1139, // Linux hosting -> ENTERPRISE

        '425' => 1140, // wordpress hosting -> BASIC
        '426' => 1141, // wordpress hosting -> ESSENTIAL
        '427' => 1142, // wordpress hosting -> PROFESSIONAL
        '428' => 1143, // wordpress hosting -> ENTERPRISE

        '429' => 1144, // ecommerce hosting -> BASIC
        '430' => 1145, // ecommerce hosting -> ESSENTIAL
        '431' => 1146, // ecommerce hosting -> PROFESSIONAL
        '432' => 1147, // ecommerce hosting -> ENTERPRISE
    ];

    // Set the custom field array
    $customfield = [
        'id' => isset($customfielids[$item['pid']]) ? $customfielids[$item['pid']] : '',
        'name' => 'Location',
        'description' => '',
        'required' => '',
        'fieldtype' => 'dropdown',
        'fieldoptions' => 'India,Canada',
        'selectedOption' => $requestData->location,
    ];

    $item['customfields'][0] = $customfield;
    
    // Print the custom field array for debugging
    // echo '<pre>2233 '; 
    // print_r($customfield); 
    // exit;
}
            if (!empty($item)) {
                //Update spinwheel start ------------------------------------
                $this->spinWheelUpdateDataInDB(['intstep' => 4]);
                //Update spinwheel end --------------------------------------
                $lastAddedKey = Cart::addtocart($request, $item);
                if($lastAddedKey === false){ return redirect('cart'); } else 
                { $lastAddedKeyArr[] = $lastAddedKey; }
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
            $vpsConfigOptArr = array();
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
                $vpsConfigOptArr['189'] = $Value;
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
                $vpsConfigOptArr['190'] = $Value_ram;
                
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
                $vpsConfigOptArr['191'] = $Value_hdd;
                Session::flash('vps_config_opt',serialize($vpsConfigOptArr));
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
                $vpsConfigOptArr['185'] = $Value;
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
                $vpsConfigOptArr['186'] = $Value_ram;
                 
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
                $vpsConfigOptArr['187'] = $Value_hdd;
                Session::flash('vps_config_opt',serialize($vpsConfigOptArr));
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
                $vpsConfigOptArr['230'] = $Value;
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
                $vpsConfigOptArr['229'] = $Value_ram;
                
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
                $vpsConfigOptArr['231'] = $Value_hdd;
                Session::flash('vps_config_opt',serialize($vpsConfigOptArr));
            }
            // For India
            if ($requestData->pid == 236 && isset($requestData->vps_cpu) && !empty($requestData->vps_cpu)) {
                //echo '</br>'.$requestData->vps_cpu;
                //echo '</br>'.$requestData->vps_ram;
                //echo '</br>'.$requestData->vps_hdd;exit;
                $vpsConfigOptArr['vps_cpu'] = $requestData->vps_cpu;
                $vpsConfigOptArr['vps_ram'] = $requestData->vps_ram;
                $vpsConfigOptArr['vps_hdd'] = $requestData->vps_hdd;
                Session::flash('vps_config_opt_236',serialize($vpsConfigOptArr));
            }
            // For USA
            if ($requestData->pid == 238 && isset($requestData->vps_cpu) && !empty($requestData->vps_cpu)) {
                $vpsConfigOptArr['vps_cpu'] = $requestData->vps_cpu;
                $vpsConfigOptArr['vps_ram'] = $requestData->vps_ram;
                $vpsConfigOptArr['vps_hdd'] = $requestData->vps_hdd;
                Session::flash('vps_config_opt_238',serialize($vpsConfigOptArr));
            }
            //Skip Configuration for Quick Order
            if(isset($requestData->skipconfig) && !empty($requestData->skipconfig )){ return redirect('cart/signin'); }
    
            return redirect('cart/newconfig?id=' . $lastAddedKey);
        
           
        } else {
            if(isset($lastAddedKey) && isset($requestData->producttype) && $requestData->producttype == 'hosting') {
                return redirect('cart/newconfig?id=' . $lastAddedKey);
            }
            //For Email Google Apps -----------------------------
            if(isset($lastAddedKey) && isset($requestData->producttype) && $requestData->producttype == 'email') {
                return redirect('cart/newconfig?id=' . $lastAddedKey);
            }
            if(isset($lastAddedKey) && isset($requestData->producttype) && $requestData->producttype == 'ssl') {
                return redirect('cart/newconfig?id=' . $lastAddedKey);
            }
           /* if(isset($lastAddedKey) && isset($requestData->producttype) && $requestData->producttype == 'domain')
            {
                return redirect('cart/domainconfig');
            }  */          
            
            if ($request->landingdomain == 'y' && $request->ajax()) {
                if(isset($session_data)){
                    return count($session_data);
                }
                else {
                    return 0;    
                }
                
            } else if ($request->ajax()) {
                return isset($lastAddedKeyArr[0])?$lastAddedKeyArr[0]:0;
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
        Session::flush();
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
        } else if ($g == "cc") { //cc avenue
            //$gateway = 'ccavenuev2';
            $gateway = 'ccavenuev2';
        } else if ($g == "pu") { //PayUMoney
            $gateway = 'payu';
        }elseif($g == "wl"){ //worldline
            $gateway = 'worldline';
        }
        elseif($g == "pl"){ //Plugnpay
            $gateway = 'plugnpayss1';
        }
        //echo "1: ".$gateway;
        $orderData = Cart::createorder($request,$gateway);
        if (isset($orderData['orderid']) && !empty($orderData['orderid'])) {
            if (isset($orderData['invoiceid']) && !empty($orderData['invoiceid'])) {
                //Cart::sendOrderEmail($orderData['orderid']); //send invoice email
                 $this->emptycart($request); // calling emptycart function
                $request->session()->put('orderid', $orderData['orderid']);
                $paymentScript = Cart::getpaymentlink(['id' => $orderData['invoiceid'], 'gateway' => $gateway]);
                // echo '<pre>1';print_r($paymentScript);exit;
                return $paymentScript;
            }else{
                $params['action'] = 'UpdateClientProduct';
                $params['serviceid'] = $orderData['serviceids'];
                $params['billingcycle'] = 'Free';
                $date = date('Y-m-d');
                $date = strtotime($date);
                $date = strtotime("+7 day", $date);
                $params['nextduedate'] = date('Y-m-d', $date);
                $result = Whmcs::callapi($params);
                $orderid = $orderData['orderid'];
                $invoiceid = 0;
                $str = '<html>
                            <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>Thank you</title></head>
                            <body onload="document.getElementById(\'frmpayment\').submit();">
                                <form method="post" id="frmpayment" name="frmpayment" action="' . url("/") . '/cart/thankyou">
                                    <input type="hidden" id="_token" name="_token" value="' . csrf_token() . '"/>
                                    <input type="hidden" id="invoiceid" name="invoiceid" value="' . $invoiceid . '"/>
                                    <input type="hidden" id="orderid" name="orderid" value="' . $orderid . '"/>
                                </form>
                                <script type="text/javascript">document.getElementById(\'frmpayment\').submit();</script>
                            </body>
                        </html>';
                echo $str;
                exit;
            }
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
        //Recalculate Final Price
        $productData = $cartData[$request->ele_key];
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
        return $finalPrice; //Retunr final price of product
    }
    public function domainconfig(Request $request) {
       Self::getconstants();
       
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
      foreach($cartDomains as $key => $tlds)
      {
          $tldarray[]=$tlds['tld'];
      } 
        $additionalfields=MyLibrary::additionalfields();
     
        foreach($cartData as $protype)
        {       
            if($protype['producttype']=="domain")
            {   
                    $counttld=0;
                    foreach($tldarray as $key)
                    {   
                        $domain=".".$key;
                        foreach($additionalfields as $keys=>$value)
                        {
                        if($keys==$domain)
                        {   
                           /* foreach($value as $keyss => $attribute)
                            {  
                                if(isset($attribute['Options']))
                                {
                                        $customfield = array(
                                    'id' => $keyss, 
                                    'name' => $attribute['Name'],
                                    'description' => '',
                                    'fieldtype' => $attribute['Type'],
                                    'fieldoptions' => $attribute['Options'],
                                    'selectedOption' => $attribute['Default']);
                                    $item['customfields'][$keyss] = $customfield;
                                }
                                else
                                {
                                        $customfield = array(
                                    'id' => $keyss, 
                                    'name' => $attribute['Name'],
                                    'description' => '',
                                    'fieldtype' => $attribute['Type'],
                                    'fieldoptions' => '',
                                    'selectedOption' => '');
                                    $item['customfields'][$keyss] = $customfield;
                                }
                                
                            }*/
                            $counttld++;
                        }
                        }
                    } 
               
            }
        }
          
            if($counttld>0)
            {       
                   
                   return view('cart.domainconfig', ['tlds'=>$tldarray,'additionalfields'=>$additionalfields]);
            }
            else
            {
                   return header('Location: https://www.hostitsmart.com/cart');
            }
             
        
       
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
        return view('cart.config', ['cartDataSitelock' => $cartDataSitelock,'productData' => $productData, "key" => $id, "tlds" => $Tlds]);
    }
        
    public function newconfig(Request $request) {
        Self::getconstants();
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        $id = $request->id;
        $contacts = ContactInfo::getContactDetails();
        $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
        $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        // redirct to the home page if cart is full
        if(isset($cartData[$id]) && !empty($cartData[$id])){} else { return redirect('/')->with('cartfull','Too many items in cart. Please remove unwanted items! <a href="'.url('/cart').'" title="Click here">Click here</a>'); }
        
        $productData = $cartData[$id];
        //$request->session()->put('cart', $cartData);
        // echo print_r(Session::get('vps_config_opt_238'));exit;
        if(Session::has('vps_config_opt'))
        { $vps_config_opt = unserialize(Session::get('vps_config_opt')); }
        
        if(Session::has('vps_config_opt_236'))
        { $vps_config_opt_236 = unserialize(Session::get('vps_config_opt_236')); }
        // echo '<pre>';print_r($vps_config_opt_236);
        if(Session::has('vps_config_opt_238'))
        { $vps_config_opt_238 = unserialize(Session::get('vps_config_opt_238')); }
        // echo '<pre>';print_r($vps_config_opt_238);
        
        //Update Default configuration options ---- 03 Sep 2018---------------------------------------------------------
        if(!empty($productData['configfields'])){
            foreach($productData['configfields'] as $ckey => $confg)
            {
                if(isset($vps_config_opt[$confg['id']]) && !empty(($vps_config_opt[$confg['id']]))){
                    $productData['configfields'][$ckey]['selectedOption'] = $vps_config_opt[$confg['id']];
                }
                else{
                    if(empty($productData['configfields'][$ckey]['selectedOption']))
                    { $productData['configfields'][$ckey]['selectedOption'] = $confg['options'][0]['id'];    }
                }
            }
            $cartData[$id] = $productData;
            $request->session()->put('cart', $cartData); //Update Default configuration options
        }
        //Update Default configuration options ---- 03 Sep 2018 ---------------------------------------------------------
        
       /* if(!empty($productData['configfields'])){
            foreach($productData['configfields'] as $ckey => $confg)
            {
                if(isset($vps_config_opt[$confg['id']]) && !empty(($vps_config_opt[$confg['id']]))){
                    $productData['configfields'][$ckey]['selectedOption'] = $vps_config_opt[$confg['id']];
             }
                else{
                    $productData['configfields'][$ckey]['selectedOption'] = $confg['options'][0]['id'];   
                }
            }
            $cartData[$id] = $productData;
            $request->session()->put('cart', $cartData); //Update Default configuration options
        }*/
        
        //echo '<pre>';print_r($productData);exit;
        $hitsproducts = Cart::gethitsproducts();
        //echo '<pre>';print_r($hitsproducts);exit;
         if(isset($productData['producttype']) && $productData['producttype'] == 'domain'){ //for Domain
            $billingcycle = $productData['regperiod']; 
        }
        else { //For products
            $billingcycle = $productData['billingcycle'];
            
        $products = array();  
        // echo "<pre>".print_r($productData);exit;
        
        if($productData['pid'] == 238){ $productData['pid'] = 236; } //For US VPS product
        $arr = Cart::getProductsData($productData['pid'])[$productData['pid']]->specifications;
            $arr = nl2br($arr);
            $arr = explode('<br />', $arr);
            $productData['specifications'] = $arr;
        $finalPrice = 0;
        $configHtmlStr = "";
        $finalPrice += $productData['pricing'][$productData['regperiod']]->price;
        
        if (!empty($productData['configfields'])) {
            foreach ($productData['configfields'] as $field) {
                $configHtmlStr .= "<li>";
                $configHtmlStr .= "<strong>".$field['name'].": </strong>";
                if (isset($field['selectedOption'])) {
                    if (!empty($field['options'])) {
                        foreach ($field['options'] as $opt) {
                            if ($opt['id'] == $field['selectedOption']) {
                                $finalPrice += $opt['pricing']['price'][$productData['regperiod']];
                                if($opt['pricing']['price'][$productData['regperiod']] > 0)
                                    { 
                                        $configHtmlStr .= $opt['name'] ." @ <span class='rupee'>".Config::get('Constant.sys_currency_symbol')."</span>".$opt['pricing']['price'][$productData['regperiod']];
                                    }
                                else
                                    { 
                                        $configHtmlStr .= $opt['name'];
                                        if(strtoupper(trim($opt['name'])) != 'NONE'){ $configHtmlStr .= " @ FREE"; }
                                    }
                            }
                        }
                    }
                }
            }
            $configHtmlStr .= "</li>";
        }
        $productData['confightml'] = $configHtmlStr;
        $productData['finalprice'] = $finalPrice;
         }
        $pricing = MyLibrary::getStaticArrayOfPrice();
       //echo '<pre>';print_r($pricing);exit;
       
       foreach($hitsproducts as $row)
       {           
                   //SSL DOMAIN Type Only from SSL 
                   if($row->fkWhmcsProduct=="198" || $row->fkWhmcsProduct=="199" || $row->fkWhmcsProduct=="200")
                   {}else{
                    $products[$row->fkProduct]['title']=$row->varTitle;
                    $products[$row->fkProduct]['TagLine']=$row->varTagLine;
                    $products[$row->fkProduct]['ShortDescription']=$row->txtShortDescription;
                    $products[$row->fkProduct]['whmcsProductId'][$row->fkWhmcsProduct]=$row->packages;
                    $products[$row->fkProduct]['specifications'][$row->fkWhmcsProduct]=$row->txtSpecification;
                   }
                        if(isset($billingcycle))
                        {
                            if(Config::get('Constant.sys_currency') == "INR")
                            { 
                                     if($billingcycle=="1"){
                                    $permonth=12;
                                    $oldPricing=$row->intOldPriceOneYearINR;
                                }elseif($billingcycle=="monthly"){
                                    $permonth=1;
                                    $oldPricing=$row->intOldPriceOneMonthINR;}
                                elseif($billingcycle=="quarterly"){
                                    $permonth=3;
                                    $oldPricing=$row->intOldPriceThreeMonthINR;}
                                elseif($billingcycle=="semiannually"){
                                    $permonth=6;
                                    $oldPricing=$row->intOldPriceSixMonthINR;}
                                elseif($billingcycle=="annually"){
                                    $permonth=12;
                                    $oldPricing=$row->intOldPriceOneYearINR;}
                                elseif($billingcycle=="biennially"){
                                    $permonth=24;
                                    $oldPricing=$row->intOldPriceTwoYearINR;}
                                elseif($billingcycle=="triennially"){
                                    $permonth=36;
                                    $oldPricing=$row->intOldPriceThreeYearINR;}
                            
                            }
                            elseif(Config::get('Constant.sys_currency') == "USD")
                            {
                                if($billingcycle=="1"){
                                    $permonth=12;
                                    $oldPricing=$row->intOldPriceOneYearUSD;
                                }elseif($billingcycle=="monthly"){
                                    $permonth=1;
                                    $oldPricing=$row->intOldPriceOneMonthUSD;}
                                elseif($billingcycle=="quarterly"){
                                    $permonth=3;
                                    $oldPricing=$row->intOldPriceThreeMonthUSD;}
                                elseif($billingcycle=="semiannually"){
                                    $permonth=6;
                                    $oldPricing=$row->intOldPriceSixMonthUSD;}
                                elseif($billingcycle=="annually"){
                                    $permonth=12;
                                    $oldPricing=$row->intOldPriceOneYearUSD;}
                                elseif($billingcycle=="biennially"){
                                    $permonth=24;
                                    $oldPricing=$row->intOldPriceTwoYearUSD;}
                                elseif($billingcycle=="triennially"){
                                    $permonth=36;
                                    $oldPricing=$row->intOldPriceThreeYearUSD;}
                            }
        
        
                        if(isset($pricing[$row->fkWhmcsProduct][$billingcycle]) && $pricing[$row->fkWhmcsProduct][$billingcycle] > 0){
                            if($row->fkProduct=="10"){
                                $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct][$billingcycle]);
                                $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$oldPricing;
                                $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']=$billingcycle;
                            }else{
                                $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct][$billingcycle] / $permonth, 2);
                                $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$oldPricing;
                                $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']=$billingcycle;
                            }
                        } elseif(isset($pricing[$row->fkWhmcsProduct]['triennially']) && $pricing[$row->fkWhmcsProduct]['triennially'] > 0){
                                $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct]['triennially']/ 36, 2);
                                $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$row->intOldPriceThreeYearINR;
                                $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']='triennially';
                            }elseif(isset($pricing[$row->fkWhmcsProduct]['biennially']) && $pricing[$row->fkWhmcsProduct]['biennially'] > 0){
                                $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct]['biennially']/ 24, 2);
                                $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$row->intOldPriceTwoYearINR;
                                $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']='biennially';
                         } elseif(isset($pricing[$row->fkWhmcsProduct]['annually']) && $pricing[$row->fkWhmcsProduct]['annually'] > 0)
                                {
                                    if($row->fkProduct=="10")
                                    {
                                        $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct]['annually']);
                                        $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$row->intOldPriceOneYearINR;
                                        $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']='annually';
                                    }
                                    else
                                    {
                                        $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct]['annually']/ 12, 2);
                                        $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$row->intOldPriceOneYearINR;
                                        $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']='annually';
                                    }
                                }
                        elseif(isset($pricing[$row->fkWhmcsProduct]['semiannually']) && $pricing[$row->fkWhmcsProduct]['semiannually'] > 0){
                                $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct]['semiannually']/ 6, 2);
                                $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$row->intOldPriceSixMonthINR;
                                $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']='semiannually';
                         }elseif(isset($pricing[$row->fkWhmcsProduct]['quarterly']) && $pricing[$row->fkWhmcsProduct]['quarterly'] > 0){
                                $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct]['quarterly']/ 3, 2);
                                $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$row->intOldPriceThreeMonthINR;
                                $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']='quarterly';
                         }elseif(isset($pricing[$row->fkWhmcsProduct]['monthly']) && $pricing[$row->fkWhmcsProduct]['monthly'] > 0)
                         {
                                $INRMinPrice[$row->fkWhmcsProduct]['newPrice'] = round($pricing[$row->fkWhmcsProduct]['monthly']);
                                $INRMinPrice[$row->fkWhmcsProduct]['oldPrice']=$row->intOldPriceOneMonthINR;
                                $INRMinPrice[$row->fkWhmcsProduct]['billingcycle']='monthly';
                         } 
                    }
                
                  
                 
            }
            
            
          //For suggested products
         if($productData['producttype'] == "domain")
          {
            $products['1']['producttype']="hosting";
            $products['21']['producttype']="email";
           
            $suggestPro[] =$products['1']; //Linux hosting
            $suggestPro[] = $products['21']; //Email
                                                              
          }   
          else if($productData['producttype']=="hosting")
          { 
            //Sitelock product's whmcs id.
              $sitelock_pid=['169','170','171'];
              
              if(in_array($productData['pid'], $sitelock_pid))
             {
                 $products['22']['producttype']="email";
                 $products['10']['producttype']="ssl";
            
                 $suggestPro[]=$products['22']; //Office 365
                 $suggestPro[]=$products['10']; //ssl
             }
             else
             {
                $products['20']['producttype']="hosting";
                $products['21']['producttype']="email";
            
                $suggestPro[]=$products['20']; //Site Lock
                $suggestPro[]=$products['21']; //Google Apps 
             }
          }
          elseif($productData['producttype']=="email")
          {
            $products['13']['producttype']="hosting";
            $products['10']['producttype']="ssl";
            $suggestPro[]=$products['13']; //java hosting
            $suggestPro[]=$products['10']; //ssl
          }
          elseif($productData['producttype']=="ssl")
          {
            $products['13']['producttype']="hosting";
            $products['10']['producttype']="ssl";
            $suggestPro[]=$products['13']; //java hosting
            $suggestPro[]=$products['10']; //ssl
          }
          elseif($productData['producttype']=="dedicatedserver")
          {
            $products['21']['producttype']="email";
            $products['10']['producttype']="ssl";
            $suggestPro[]=$products['21']; //Google Apps
            $suggestPro[]=$products['10']; //ssl                                                         
          }
          elseif($productData['producttype']=="vps")
          { 
            $products['22']['producttype']="email";
            $products['10']['producttype']="ssl";
            $suggestPro[]=$products['22']; //Office 365
            $suggestPro[]=$products['10']; //ssl
          }
          elseif ($productData['producttype']=="domain")
          {
            $products['13']['producttype']="hosting";
            $products['10']['producttype']="ssl";
            $suggestPro[]=$products['13']; //java hosting
            $suggestPro[]=$products['10']; //ssl
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

        // dd($productData['pid']);

        if($productData["producttype"] != "domain"){

            $products_with_renewal_data = array(534,535,536,537,522,523,524,525,530,531,532,533,526,527,528,529);

            if(in_array($productData['pid'], $products_with_renewal_data)){

                if(Config::get('Constant.sys_currency') == "INR"){

                    $renewal_price = DB::table('renewal_price')
                                    ->where('product_package_id', $productData['pid'])
                                    ->first(['renewal_monthly_INR', 'renewal_yearly_permonth_INR','renewal_biennially_permonth_INR','renewal_triennially_permonth_INR']);

                    if($renewal_price){
                        $productData['renewal_monthly_price'] = $renewal_price->renewal_monthly_INR;
                        $productData['renewal_yearlyPrice_perMonth'] = $renewal_price->renewal_yearly_permonth_INR;
                        $productData['renewal_biennially_permonth'] = $renewal_price->renewal_biennially_permonth_INR;
                        $productData['renewal_triennially_permonth'] = $renewal_price->renewal_triennially_permonth_INR;

                        $productData['extra_renewal_data'] = true;
                    }                    

                }elseif(Config::get('Constant.sys_currency') == "USD"){

                    $renewal_price = DB::table('renewal_price')
                                    ->where('product_package_id', $productData['pid'])
                                    ->first(['renewal_monthly_USD', 'renewal_yearly_permonth_USD','renewal_biennially_permonth_USD','renewal_triennially_permonth_USD']);

                    if($renewal_price){
                        $productData['renewal_monthly_price'] = $renewal_price->renewal_monthly_USD;
                        $productData['renewal_yearlyPrice_perMonth'] = $renewal_price->renewal_yearly_permonth_USD;
                        $productData['renewal_biennially_permonth'] = $renewal_price->renewal_biennially_permonth_USD;
                        $productData['renewal_triennially_permonth'] = $renewal_price->renewal_triennially_permonth_USD;

                        $productData['extra_renewal_data'] = true;
                    }

                }

                

                foreach ($productData['pricing'] as $key => $price) {

                    if ($price->durationame === 'monthly') {
                        $price->renewal_price = $productData['renewal_monthly_price']; 
                    }

                    if ($price->durationame === 'annually') {
                        $price->renewal_price = $productData['renewal_yearlyPrice_perMonth']; 
                    }

                    if ($price->durationame === 'biennially') {
                        $price->renewal_price = $productData['renewal_biennially_permonth']; 
                    }

                    if ($price->durationame === 'triennially') {
                        $price->renewal_price = $productData['renewal_triennially_permonth']; 
                    }

                }
            }
        }
        
        if($productData['producttype'] == 'vps'){

               if(Config::get('Constant.sys_currency') == "INR"){

                $renewal_price = DB::table('renewal_price')
                                ->where('product_package_id', $productData['pid'])
                                ->first(['renewal_monthly_INR', 'renewal_yearly_permonth_INR']);

            }elseif(Config::get('Constant.sys_currency') == "USD"){
                $renewal_price = DB::table('renewal_price')
                                ->where('product_package_id', $productData['pid'])
                                ->first(['renewal_monthly_USD', 'renewal_yearly_permonth_USD']);
            }

                                

            if($renewal_price){
                $productData['renewal_monthly_price'] = $renewal_price->renewal_monthly_INR;
                $productData['renewal_yearlyPrice_perMonth'] = $renewal_price->renewal_yearly_permonth_INR;
                $productData['extra_renewal_data'] = true;

                foreach ($productData['pricing'] as $key => $price) {

        if ($price->durationame === 'monthly') {
            $price->renewal_price = $productData['renewal_monthly_price']; 
        }

        if ($price->durationame === 'annually') {
            $price->renewal_price = $productData['renewal_yearlyPrice_perMonth']; 
        }

        }
            }         

           
        }

        if($productData['producttype'] == 'email')
        {
            $google_apps_product_id = array(117,116,206);

            if(in_array($productData['pid'], $google_apps_product_id)){

                if(Config::get('Constant.sys_currency') == "INR"){

                $renewal_price = DB::table('renewal_price')
                                ->where('product_package_id', $productData['pid'])
                                ->first(['renewal_monthly_INR','renewal_yearly_permonth_INR']);

            }elseif(Config::get('Constant.sys_currency') == "USD"){
                $renewal_price = DB::table('renewal_price')
                                ->where('product_package_id', $productData['pid'])
                                ->first(['renewal_monthly_USD','renewal_yearly_permonth_USD']);
            }

            if($renewal_price){
                $productData['renewal_monthly_price'] = $renewal_price->renewal_monthly_INR;
                $productData['renewal_yearlyPrice_perMonth'] = $renewal_price->renewal_yearly_permonth_INR;
                $productData['extra_renewal_data'] = true;

                foreach ($productData['pricing'] as $key => $price) {

                    if ($price->durationame === 'monthly') {
                        $price->renewal_price = $productData['renewal_monthly_price']; 
                    }

                    if ($price->durationame === 'annually') {
                        $price->renewal_price = $productData['renewal_yearlyPrice_perMonth']; 
                    }

                }
            }  

            }

        }
        // dd($productData);
        $reqData = $request->all();
        $viewData = ['productData' => $productData, "key" => $id, "tlds" => $Tlds,"products"=>$products,'suggestPro'=>$suggestPro];
        
        if(isset($INRMinPrice)){ $viewData['INRMinPrice'] = $INRMinPrice; }
        
        // echo "<pre/>".print_r($productData);exit;
        $viewData['contact_phonenumber']=$PhoneNumner;
        $viewData['contact_emailid']=$EmailId;
        
        $newvps=array("220","221","227","222","224","225","236", "238");
        if(isset($productData['pid']))
        {
         if(in_array($productData['pid'],$newvps)) //Skip config options page
        {   
            if(isset($vps_config_opt_236) && !empty($vps_config_opt_236) || isset($vps_config_opt_238) && !empty($vps_config_opt_238) ){
            $userid=$request->session()->get('UserID');
            if(!empty($userid) && $userid!="")
            {   
                return redirect('/cart/billinginfo');
            }
            else
            {
                return redirect('/cart/signin');
            }
            exit;
        }
        }
        else
        {
            return view('cart.newconfig',$viewData );
        }
        }
        return view('cart.newconfig',$viewData );
    }
    public function setconfigoptionvalue(Request $request) {
        Self::getconstants();
        Cart::updateConfig($request);
        $configHtmlStr = "";
        $cartData = $request->session()->has('cart') ? (array) $request->session()->get('cart') : null;
        $productData = $cartData[$request->productid];
        $finalPrice = 0;
        $finalPrice += $productData['pricing'][$productData['regperiod']]->price;
        if (!empty($productData['configfields'])) {
            foreach ($productData['configfields'] as $field) {
                $configHtmlStr .= "<li>";
                $configHtmlStr .= "<strong>".$field['name'].": </strong>";
                if (isset($field['selectedOption'])) {
                    if (!empty($field['options'])) {
                        foreach ($field['options'] as $opt) {
                            // echo '<pre>123: '; print_r($opt);exit;
                            if ($opt['id'] == $field['selectedOption']) {
                                $finalPrice += $opt['pricing']['price'][$productData['regperiod']];
                                if($opt['pricing']['price'][$productData['regperiod']] > 0)
                                    $configHtmlStr .= $opt['name'] ." @ <span class='rupee'>".Config::get('Constant.sys_currency_symbol')."</span>".$opt['pricing']['price'][$productData['regperiod']];
                                else
                                        if($opt['name']=='None'){
                                        $configHtmlStr .= $opt['name'] ."";}
                                        else{
                                        $configHtmlStr .= $opt['name'] ." @ FREE";}
                            }
                        }
                    }
                }
            }
            $configHtmlStr .= "</li>";
        }
        $divHtml=''; $pcfig_id='';
        $d_baseconfig=$request->session()->has('d_baseconfig') ? (array) $request->session()->get('d_baseconfig') : [];
        foreach ($productData['configfields'] as $i => $field) {
            if (count((array)$field['options']) == 1){ continue; }
            $options = $field['options'];
            foreach ($options as $option) {
                if ($option['id'] == $request->optionid){
                    
                    $pcfig_id=trim(MyLibrary::filterString($field['name']));
                    if($option['pricing']['price'][$productData['regperiod']] > 0){
                        $divHtml.='<span id="'.$pcfig_id.'"><span class="rupee">'.Config::get("Constant.sys_currency_symbol").'</span>';
                        $divHtml.=round($option['pricing']['price'][$productData['regperiod']]).'</span>';
                        $divHtml.='<span>'.$option['name'].'</span>';
                        $d_baseconfig[$request->productid][$field['id']][$pcfig_id]=$divHtml;
                        $request->session()->put("d_baseconfig", $d_baseconfig);
                    }else{
                        // Session::forget("d_baseconfig.".$request->productid.".".$pcfig_id, $divHtml);
                        $d_baseconfig[$request->productid][$field['id']][$pcfig_id]="";
                        $request->session()->put("d_baseconfig", $d_baseconfig);
                    }
                }
            }
        }
        // echo '<pre>';print_r($request->session()->all());exit;
        // echo '<pre>';print_r($divHtml);exit;
        $responseData['divHtml']   = Session::get('d_baseconfig.'.$request->productid);
        $responseData['confightml'] = $configHtmlStr;
        $responseData['finalprice'] = round($finalPrice,2);
        return $responseData;
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
        //Recalculate Final Price
        $productData = $cartData[$request->ele_key];
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
        return $finalPrice; //Retunr final price of product
        //return view('cart.dedicatedserver', ['cartItem' => $cartData[$request->ele_key], 'key' => $request->ele_key]);
    }
    public function view(Request $request) {
        $companyIp=['27.54.170.98','103.226.184.100'];
        $IP='';
        if(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])){
            $IP = $_SERVER['HTTP_X_REAL_IP'];
        }else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR']; 
        }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
            $IP = $_SERVER['REMOTE_ADDR']; 
        }
        if (in_array($IP,$companyIp)) {
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
        }else{
            return redirect('/');
        }
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
            // echo json_encode($finalData);exit;
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
        
        foreach($cartData[$request->cartitemkey[0]]['pricing'] as $key=>$values)
        {   
            if($values->duration==$cartData[$request->cartitemkey[0]]['regperiod'])
            {   
                 $domainPriceaddon['price']=$values->register;   
                 $domainPriceaddon['renewPrice']=($values->register/$values->duration);
                 
                 
                
            }
        }
        foreach($cartData[$request->cartitemkey[0]]['addonproducts'] as $addkey=>$addvalues)
        {
             if(isset($addvalues['added']))
             {
                $domainPriceaddon['price']+=($addvalues['price']*$cartData[$request->cartitemkey[0]]['regperiod']);
                
                 
             }   
        }
        return $domainPriceaddon;
        //return "1";
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
        //return $status;
        
        foreach($cartData[$request->cartitemkey[0]]['pricing'] as $key=>$values)
        {   
            if($values->duration==$cartData[$request->cartitemkey[0]]['regperiod'])
            {   
                 $removeAddon['price']=$values->register;   
             }
        }
        return $removeAddon;
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
         if(!empty($request->session()->get('UserID')))
        {
            $UserID=$request->session()->get('UserID');
        }
        else
        {
            $UserID='';
        }
        $whmcsid = $request->session()->get('WhmcsID');
        $details = Cart::getClientDetails($whmcsid);
        if (isset($details['currency']) && !empty($details['currency'])) {
            $currency = $details['currency'];
        }else{ $currency=''; }
        Self::getconstants();
        //display order summary
        $cartData = Cart::createOrderSummary($request);
        

        // if(array_key_exists('userid',$cartData))        { unset($cartData['userid']); }
        if (is_array($cartData) && array_key_exists('userid', $cartData)) {
            unset($cartData['userid']);
        }
        if(is_array($cartData) && array_key_exists('paymentmethod',$cartData)) { unset($cartData['paymentmethod']); }
        if(is_array($cartData) && array_key_exists('recommndation',$cartData)) { unset($cartData['recommndation']); }  
        $addonProducts = [];
        foreach ($cartData as $item) {
            if (isset($item['relatedpro'])) {
                $addonProducts[$item['relatedpro']][] = $item;
            }
        }
        $deleteBtn = $request->deleteHide;
        $displayData = ['UserID'=>$UserID,'cartData' => $cartData, 'currency'=>$currency, 'addonProducts' => $addonProducts];
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
        //echo '<pre>';print_r($params);exit;
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
        //echo '<pre>';print_r($params);
        //echo '<pre>';print_r($domainAvailData);exit;
        
        if (isset($domainAvailData[$params[0]['fullname']]['status']) && $domainAvailData[$params[0]['fullname']]['status'] == 'available') {
            $response['status'] = "available";
            $response['msg'] = $params[0]['fullname'] . " is available ";
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
        
        
        $cartData = $request->session()->all();
        if (!isset($cartData['cart'])) { $cartData['cart'] = false; }
        if (empty($cartData['cart'])) { return redirect('/'); }
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
        Self::getconstants();
        //display order summary
        $frontlogin = $request->session()->get('frontlogin');
        $userid = $request->session()->get('UserID');
        $whmcsid = $request->session()->get('WhmcsID');
        $contacts = ContactInfo::getContactDetails();
        $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
        $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        
        //Update spinwheel start ------------------------------------
        $this->spinWheelUpdateDataInDB(['intstep' => 5]);
        //Update spinwheel end --------------------------------------
                
        if (isset($frontlogin) && $frontlogin == 'Y' && isset($userid) && !empty($userid) && isset($whmcsid) && !empty($whmcsid)) {
            return redirect()->action('CartController@billinginfo');
        } else {
            return view('cart.signin', ["contact_phonenumber" => $PhoneNumner, "contact_emailid" => $EmailId , "cartData" => $cartData['cart']]);
        }
    }
    public function billinginfo(Request $request) {
        
        $cartData = $request->session()->all();
        
        //Update spinwheel start ------------------------------------
        $this->spinWheelUpdateDataInDB(['intstep' => 6]);
        //Update spinwheel end --------------------------------------
        if (!isset($cartData['cart'])) { $cartData['cart'] = false; }
        if (empty($cartData['cart'])) { return redirect('/'); }
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
        if (isset($details['currency']) && !empty($details['currency'])) {
            $currency = $details['currency'];
        }else{ $currency = ''; }
        return view('cart.billinginfo', ['clientData' => $details, 'currency' => $currency, 'countrycmb' => $countryCMB, 'clientid' => $whmcsid, "contact_phonenumber" => $PhoneNumner, "contact_emailid" => $EmailId]);
    }
    public function updatebillinginfo(Request $request) {
        Self::getconstants();
        if (isset($request->h_save) && $request->h_save == 'Y') {
            if (isset($request->gstnumber) && !empty($request->gstnumber)) {
                    $request->customfields = base64_encode(serialize(array("335" => $request->gstnumber,"336" => date('Y-m-d'))));
                }
            
            $clientdata=Cart::getClientDetails($request['clientid']);
            $request->country=$clientdata['country'];
            $request->phonenumber=$clientdata['phonenumber'];
                
            Cart::updateClientDetails($request);
                
            $displaycountryData = MyLibrary::getCountrieslist($request->country);
            Session::put('gstnumber',$request->gstnumber);
            Session::put('city',$request->city);
            Session::put('state',$request->state);
            Session::put('country',$displaycountryData);
            Session::put('postalcode',$request->postcode);
            Session::put('firstname',$request->firstname);
            Session::put('lastname',$request->lastname);
            Session::put('phonenumber',$request->phonenumber);
             
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
        //Check if OTP Verification is done
        $userOTPData = Front_user::where('chr_otpverification', '=', 'Y')->where('id', '=', $userid)->first();
        if(isset($userOTPData->chr_otpverification) && $userOTPData->chr_otpverification == 'Y')
        { }
        else
        { return redirect('/'); }
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
        
        //Update spinwheel start ------------------------------------
        $this->spinWheelUpdateDataInDB(['intstep' => 0]);
        //Update spinwheel end --------------------------------------
        
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
            if (isset($details['currency']) && !empty($details['currency'])) {
                $currency = $details['currency'];
            }else{ $currency = ''; }
        }
        $contacts = ContactInfo::getContactDetails();
        $PhoneNumner = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varPhoneNo);
        $EmailId = MyLibrary::encrypt_decrypt('decrypt', $contacts[0]->varEmail);
        return view('cart.paymentoptions', ['clientData' => $details, 'currency' => $currency, 'country' => $country ,'addressline1' => $addressline1, 'addressline2' => $addressline2, "contact_phonenumber" => $PhoneNumner, "contact_emailid" => $EmailId]);
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
        //  if ($cartData['prmocode'] == 'iv2024' && $cartData['prmodiscount'] == 0) {
        //     $cartData['prmomessage'] = 'This coupon is valid only for annual plans—choose a 1-year or longer term to grab the offer.';
        // }
         // echo '<pre>13:'; print_r($cartData); exit;
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
    public function featchplansmessage(Request $request){
        $data=$request->all();
        return view('cart.hosting-message-newconfig')->with('data',$data);
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
            $order_details = Whmcs::getOrderDetails(['id' => $orderId]);
            $userID = $order_details['orders']['order'][0]['userid'];
            $all_orders = Whmcs::getOrderDetails(['userid' => $userID]);
            foreach ($all_orders['orders']['order'] as $key => $value) {
                if ($value['status'] == 'Active') {
                    $order_staus = 'active';
                    break;
                }
            }
            if ($order_staus != 'active') {
                ?>
                    <script language="JavaScript" type="text/javascript" src="<?php echo 'https://affiliates.hostitsmart.com/sale.php?profile=72198&idev_saleamt=' . $order_details['orders']['order']['0']['amount'] . '&idev_ordernum=' . $order_details['orders']['order']['0']['id']; ?>"></script>
                <?php
            }
        }
        else{ return redirect('/'); }
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
        $productArr[421]['image'] = "linux-icon.svg";
        $productArr[186]['image'] = "wordpress-icon.svg";//windows
        $productArr[425]['image'] = "wordpress.svg";
        $productArr[429]['image'] = "ecommerce.svg";
        $productArr[394]['image'] = "vps-icon.svg";
        $productArr[357]['image'] = "dedicated.svg";
        $productArr[192]['image'] = "reseller.svg";
        $productArr[176]['image'] = "reseller.svg";
        $productArr[195]['image'] = "ssl.svg";
        // $productArr[158]['image'] = "java-i.svg";
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
                <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>Thank you</title></head>
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
        $contacts = Cart::getHomecontactdata();
        $emailId = MyLibrary::encrypt_decrypt('decrypt', $contacts->varEmail);
        $contact_phonenumber = MyLibrary::encrypt_decrypt('decrypt', $contacts->varPhoneNo);
        return view('cart.paymentfail', ['emailId' => $emailId,'contact_phonenumber' => $contact_phonenumber]);
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
        echo '<pre>Product Details of id 179:</br> https://manage.hostitsmart.com/cart.php?a=add&pid=179  </br>';print_r($Tld_array);
        
        $data['email'] = 'demo1.netclues@gmail.com';
        $data['name'] = 'demo1.netclues';
        Email_sender::testingemail($data);
    }
    public function check_terms(Request $request){
        // return $request['ischeck_term'];
        if ($request['ischeck_term']) {
            // $_SESSION['check_term'] = $request['ischeck_term'];
            Session::put('check_term', $request['ischeck_term']);
        }else{
            // $_SESSION['check_term'] = $request['ischeck_term'];
            Session::put('check_term', $request['ischeck_term']);
            
        }
        return $request['ischeck_term'];
    }
//--------------------- Spinwheel start ---------------------------------
public function spinWheelIsEmailExists(Request $request){
        $res = DB::table('spinwheel_republic_2021')->select('id')->where("varemail",trim($request['spin-wheel-email']))->where("chrtype",$request['type'])->get();
        $res = reset($res);
        // return json_encode($res);
        if (count($res) > 0) { return json_encode(false); } 
        else { return json_encode(true); }
}
public function spinWheelUpdateData(Request $request){
    $spinId = Session::get('spinwheel-id');
    if(!empty($spinId)){    
        $step = isset($request['intstep'])?$request['intstep']:"1";
        $this->spinWheelUpdateDataInDB(['intstep' =>  $step]);
    }
    return "success". $spinId;
}
public function spinWheelUpdateDataInDB($dataArr = []){
    $spinId = Session::get('spinwheel-id');
    if(!empty($spinId)){    
        $step = isset($dataArr['intstep'])?$dataArr['intstep']:"1";
        $updateData = ['intstep' => $step];
        $spinId = DB::table('spinwheel_republic_2021')->where("id",$spinId)->update($updateData);
        Session::put('spinwheel-step', $step);
    }
    
}
public function spinWheelPostData(Request $request){
    // return $request;
   //Insert data into table
    $inserData = ['varname' => strip_tags($request['spin-wheel-name']),'varemail' => trim($request['spin-wheel-email']),'varphone' => trim($request['spin-wheel-number']),'chrtype' => trim($request['spin-wheel-type']),'intstep' => 1,'dtcreated' => date("Y-m-d H:i:s")];
    $spinId = DB::table('spinwheel_republic_2021')->insertGetId($inserData);
    $finalResults = "fail";
    try {
        if (isset($request['spin-wheel-name']) && !empty($request['spin-wheel-name']) ) {
        Session::put('spinwheel-name', $request['spin-wheel-name']); }
        if (isset($request['spin-wheel-email']) && !empty($request['spin-wheel-email']) ) {
        Session::put('spinwheel-email', $request['spin-wheel-email']); }
        if (isset($request['spin-wheel-number']) && !empty($request['spin-wheel-number']) ) {
        Session::put('spinwheel-mobile', $request['spin-wheel-number']); }
        if (isset($request['promo']) && !empty($request['promo']) ) {
        Session::put('spinwheel-promo', $request['promo']); }
        if (isset($spinId) && !empty($spinId) ) {
        Session::put('spinwheel-id', $spinId); }
        if (isset($request['spin-wheel-type']) && !empty($request['spin-wheel-type']) ) {
            Session::put('spin-wheel-type', $request['spin-wheel-type']); }
        
        $finalResults = "success";
    } catch (Exception $e) {
        $finalResults = "fail";
    }
    if (( isset($request['spin-wheel-name']) && !empty($request['spin-wheel-name']) ) &&
    ( isset($request['spin-wheel-email']) && !empty($request['spin-wheel-email']) ) &&
    ( isset($request['spin-wheel-number']) && !empty($request['spin-wheel-number']) )) {
        $this->storeContactUSSpinWheelLead($request);
    }
    return $finalResults;
    // echo $finalResults; exit;
}
public function spinWheelGetCookie(Request $request){
    $setcookiename = $request['cookiename'];
    $oneday = (60 * 24);
    Cookie::queue($setcookiename, 'Y', ($oneday * 30));
    if (Cookie::get($setcookiename) !== false) {
        return "true";
    }else{
        return "false";
    }
}
public function storeContactUSSpinWheelLead($request=''){
    
    
    
    //Create sales leads for spin wheel 
    $contactus_lead = new ContactLead;
    $contactus_lead->varName = strip_tags($request['spin-wheel-name']);
    $EmailID = MyLibrary::encrypt_decrypt('encrypt', $request['spin-wheel-email']);
    $contactus_lead->varEmail = $EmailID;
    if (isset($request['spin-wheel-number'])) {
        $PhoneNo = MyLibrary::encrypt_decrypt('encrypt', $request['spin-wheel-number']);
        $contactus_lead->varPhoneNo = $PhoneNo;
    } else {
        $contactus_lead->varPhoneNo = '';
    }
    $messageStr = "Leads generated by Spin wheel - ";
    if (isset($request['spin-wheel-type']) && !empty($request['spin-wheel-type']) ) {
        if($request['spin-wheel-type'] == 'S'){
            $messageStr .= " Web Hosting";
        }
        else if($request['spin-wheel-type'] == 'V'){
            $messageStr .= " VPS Hosting";
        }
    }
    if (isset($request['promo']) && !empty($request['promo'])) {
        $messageStr .= " Promocode - ".$request['promo'];
    }
            
    $contactus_lead->txtUserMessage = strip_tags($messageStr);
    $contactus_lead->fkIntServiceId = 1;
    $_previous = session()->get('_previous');        
    $contactus_lead->varRefURL = $_previous['url'];
    $contactus_lead->varIpAddress = MyLibrary::get_client_ip();
    $contactus_lead->save();
}
//--------------------- Spinwheel end ---------------------------------
}
