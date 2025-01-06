<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\GeneralSettings;
use App\Helpers\DateFormater;
use Config;

class GeneralSettingsConstants {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $arrSettings = GeneralSettings::getSettings();
        $PricearrSettings = GeneralSettings::getWHMCSPriceSettings();
//        echo "<pre>";
//        print_r($PricearrSettings);exit;
        if (!empty($arrSettings)) {
            foreach ($arrSettings as $key => $row) {
                if ($row['fieldName'] == "DEFAULT_DATE_FORMAT") {
                    Config::set('Constant' . $row['fieldName'] . '', DateFormater::fixDateFormat($row['fieldValue']));
                    Config::set('Constant.DEFAULT_DATE', DateFormater::fixDateFormat($row['fieldValue']));
                }
                Config::set('Constant.' . $row['fieldName'] . '', $row['fieldValue']);
            }
        }

        Config::set('mail.driver', Config::get('Constant.MAILER'));
        Config::set('mail.host', Config::get('Constant.SMTP_SERVER'));
        Config::set('mail.port', (int) Config::get('Constant.SMTP_PORT'));
        if (Config::get('Constant.SMTP_ENCRYPTION') == "null") {
            Config::set('mail.encryption', '');
        } else {
            Config::set('mail.encryption', Config::get('Constant.SMTP_ENCRYPTION'));
        }
        Config::set('mail.username', Config::get('Constant.SMTP_USERNAME'));
        Config::set('mail.password', Config::get('Constant.SMTP_PASSWORD'));
        Config::set('mail.from', ['address' => trim(Config::get('Constant.DEFAULT_EMAIL')), 'name' => Config::get('Constant.SMTP_SENDER_NAME')]);
        
        if (!empty($PricearrSettings)) {
            foreach ($PricearrSettings as $pkey => $prow) {
                $INR = "";
                $USD = "";
                $INR_Wrong = "";
                $USD_Wrong = "";
                $Delas_ID = "";
                $INR = str_replace(".00","",$prow->INR);
                $USD = str_replace(".00","",$prow->USD);
                $Delas_ID = str_replace(".00","",$prow->DealsID);
                $INR_Wrong = str_replace(".00","",$prow->INR_WRONG);
                $USD_Wrong = str_replace(".00","",$prow->USD_WRONG);
                Config::set('Constant.' . $prow->fieldName . '_INR', $INR);
                Config::set('Constant.' . $prow->fieldName . '_USD', $USD);
                Config::set('Constant.' . $prow->fieldName . '_DEALS', $Delas_ID);
                Config::set('Constant.' . $prow->fieldName . '_INR_WRONG', $INR_Wrong);
                Config::set('Constant.' . $prow->fieldName . '_USD_WRONG', $USD_Wrong);
            }
        }

        return $next($request);
    }

}
