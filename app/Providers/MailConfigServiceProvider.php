<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (\Schema::hasTable('general_settings')) 
        {
            
            $MAILER = DB::table('general_settings')->where('fieldName','MAILER')->first()->fieldValue;
            $SMTP_SERVER = DB::table('general_settings')->where('fieldName','SMTP_SERVER')->first()->fieldValue;
            $SMTP_PORT = DB::table('general_settings')->where('fieldName','SMTP_PORT')->first()->fieldValue;
            $SMTP_ENCRYPTION = DB::table('general_settings')->where('fieldName','SMTP_ENCRYPTION')->first()->fieldValue;
            $SMTP_USERNAME = DB::table('general_settings')->where('fieldName','SMTP_USERNAME')->first()->fieldValue;
            $SMTP_PASSWORD = DB::table('general_settings')->where('fieldName','SMTP_PASSWORD')->first()->fieldValue;
            $DEFAULT_EMAIL = DB::table('general_settings')->where('fieldName','DEFAULT_EMAIL')->first()->fieldValue;
            $SMTP_SENDER_NAME = DB::table('general_settings')->where('fieldName','SMTP_SENDER_NAME')->first()->fieldValue;

            $config = array(
                'driver'     => $MAILER,
                'host'       => $SMTP_SERVER,
                'port'       => (int) $SMTP_PORT,
                'from'       => array('address' => $DEFAULT_EMAIL, 'name' => $SMTP_SENDER_NAME),
                'encryption' => ($SMTP_ENCRYPTION != "null"?$SMTP_ENCRYPTION:null),
                'username'   => $SMTP_USERNAME,
                'password'   => $SMTP_PASSWORD,
                'sendmail'   => '/usr/sbin/sendmail -bs',
                'pretend'    => false,
            );
            
            Config::set('mail', $config);
        }
    }
}