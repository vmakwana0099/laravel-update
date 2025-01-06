<?php

namespace App\Providers;

use App\Whmcs;
use Illuminate\Support\ServiceProvider;
use Validator;
use Config;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //Schema::defaultStringLength(191);
        $this->app->bind('path.public', function() {
            return base_path() . '/public_html';
        });
        $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
        /**
         * This custom extension add a custom server side validation rule to check value > 0
         * @return  View
         * @since   2017-02-04
         * @author  NetQuick
         */
        Validator::extend('greater_than_zero', function($attribute, $value, $parameters, $validator) {
            return $value > 0;
        });

        Validator::replacer('greater_than_zero', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', '', $message);
        });

        Validator::extend('handle_xss', function($attribute, $value, $parameters, $validator) {

            $value = html_entity_decode($value);

            $value = str_replace("&#60", "&lt;", $value);
            $value = str_replace("&#62", "&gt;", $value);
            $value = str_replace("&#38", "&amp;", $value);
            $value = str_replace("&#160", "&nbsp;", $value);
            $value = str_replace("&#162", "&cent;", $value);
            $value = str_replace("&#163", "&pound;", $value);
            $value = str_replace("&#165", "&yen;", $value);
            $value = str_replace("&#8364", "&euro;", $value);
            $value = str_replace("&#169", "&copy;", $value);
            $value = str_replace("&#174", "&reg;", $value);

            if (preg_match('/((\%3C)|<)((\%2F)|\/)*[a-z0-9\%]+((\%3E)|>)/ix', $value)) {
                return false;
            } else if (preg_match('/<img|script[^>]+src/i', $value)) {
                return false;
            } else if (preg_match('/((\%3C)|<)(|\s|\S)+((\%3E)|>)/i', $value)) {
                return false;
            } else if (strstr($value, '<') != '' || strstr($value, '>') != '' || strstr($value, '&#60') != '' || strstr($value, '&#62') != '' || strstr($value, '&#x3C') != '' || strstr($value, '&#x3E') != '') {
                return false;
            } else {
                return true;
            }
        });

        Validator::replacer('handle_xss', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', '', $message);
        });


        Validator::extend('check_passwordrules', function($attribute, $value, $parameters, $validator) {
            if (preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{6,20}$/', $value)) {
                return true;
            } else {
                return false;
            }
        });

        Validator::replacer('check_passwordrules', function($message, $attribute, $rule, $parameters) {
            return 'Please follow rules for password.';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('path.public', function() {
        return base_path('public_html');
    });
    }

}
