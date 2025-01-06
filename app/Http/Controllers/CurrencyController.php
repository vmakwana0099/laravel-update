<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Helpers\MyLibrary;
use Cookie;

class CurrencyController extends Controller {

    /**
     * Set currency cookie.
     *

     */
    public function set(Request $request) {
        $Currency = Request::segment(2);
        if ($Currency == 'INR') {
            $Currency_code = '1';
            $Currency_symbol = '&#8377;';
        } else {
            $Currency_code = '10';
            $Currency_symbol = '&#36;';
        }
//        $cookie = Cookie::queue(Cookie::make('sys_currency', $Currency));
        setcookie("sys_currency", $Currency, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("sys_currency_code", $Currency_code, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("sys_currency_symbol", $Currency_symbol, time() + (86400 * 30), "/"); // 86400 = 1 day
        return redirect()->back();
    }

}
