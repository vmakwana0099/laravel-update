<?php

/**
 * The Testimonial class handels bannner queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.1
 * @since       2017-07-20
 * @author    NetQuick
 */

namespace App;

use DB;
use Illuminate\Http\Request;
//use App\Helpers\MyLibrary;
//use App\Whmcs;
use Config;
//use App\Helpers\Email_sender;

class Testhits {
    public static function getclient($data) {
        extract($data);
        if(isset($whmcsid) && !empty($whmcsid)){ 
            DB::table('front_users')->where('whmsc_id', $whmcsid)->delete();
        }
    }
    
}