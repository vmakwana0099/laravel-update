<?php

if (!function_exists('indian_format')) {
    /**
     * Format a number in Indian number system
     * Example: 1234567.89 => 12,34,567.89
     */
    function indian_format($number) {
        $number = round($number, 2);
        $decimal = '';
        if (strpos($number, '.') !== false) {
            list($number, $decimal) = explode('.', $number);
            $decimal = '.' . $decimal;
        }
        $last3 = substr($number, -3);
        $restUnits = substr($number, 0, -3);
        if ($restUnits != '') {
            $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);
            $number = $restUnits . "," . $last3;
        }
        return $number . $decimal;
    }
}
