<?php

/**
 * This helper generates email sender
 * @package   Netquick
 * @version   1.00
 * @since     2016-11-14
 */

namespace App\Helpers;

use App\Alias;
use App\Http\Controllers\Controller;
use App\Pagehit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;

class Page_hits extends Controller {

    public static function insertHits($page) {
        $aliasID = null;
        $sever_info = Request::server('HTTP_USER_AGENT');
        $ip_address = Request::ip();
        //$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $agent = new Agent;
        $device = '';
        if ($agent->is('iPad')) {
            $device = 'Y';
        } elseif ($agent->isMobile()) {
            $device = 'N';
        } else {
            $device = 'Y';
        }

        if (isset($page->id)) {
            $aliasID = $page->id;
        }
        if (!empty($sever_info) && !empty($device) && !empty($ip_address)) {
//            $isExist = Pagehit::select('id')->where(['fkIntAliasId' => $aliasID,'intFKModuleCode' => '13', 'varIpAddress' => $ip_address, 'isWeb' => $device])->first();
//            if (!isset($isExist->id)) {
                Pagehit::insert([
                    'fkIntAliasId' => $aliasID,
                    'intFKModuleCode' => "13",
                    'varBrowserInfo' => $sever_info,
                    'isWeb' => $device,
                    'varIpAddress' => $ip_address,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
//            }
        }
    }

    public static function insertDetailPageHits($segmentTwo) {


        $aliasID = null;
        $sever_info = Request::server('HTTP_USER_AGENT');
        $ip_address = Request::ip();
        $agent = new Agent;
        $device = '';

        if ($agent->is('iPad')) {
            $device = 'Y';
        } elseif ($agent->isMobile()) {
            $device = 'N';
        } else {
            $device = 'Y';
        }
        if (!empty($segmentTwo)) {
            $aliasObj = Alias::getAlias($segmentTwo);
            if (!empty($aliasObj) && isset($aliasObj->id)) {
                $aliasID = $aliasObj->id;
            }
        }
        if (!empty($sever_info) && !empty($device) && !empty($ip_address)) {

            // $isExist = Pagehit::select('id')->where(['fkIntAliasId' => $aliasID, 'varIpAddress' => $ip_address,'isWeb' => $device])->first();
            // if(!isset($isExist->id)){
            if (!empty($aliasID)) {
                //  if(($segmentTwo!='thankyou') || ($segmentTwo!='subscription')) {
//                 Pagehit::insert([
//                    'fkIntAliasId'   => $aliasID,
//                    'varBrowserInfo' => $sever_info,
//                    'isWeb'          => $device,
//                    'varIpAddress'   => $ip_address,
//                    'created_at'     => Carbon::now(),
//                    'updated_at'     => Carbon::now(),
//                ]);
            }
            //}   
        }
    }

}
