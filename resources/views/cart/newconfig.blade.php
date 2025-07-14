<?php //echo "<pre>"; print_r($INRMinPrice); exit; ?>
{{-- {{dd($productData['pricing'])}} --}}
@php
if (isset($productData['producttype']) && $productData['producttype']=="dedicatedserver" || $productData['producttype']=="vps") {
  if (isset($productData['billingcycle']) && !empty($productData['billingcycle'])) {
        $duration = $productData['billingcycle']; $months=1;
        if ($duration == 'monthly') {
            $months = 1;
        } elseif ($duration == 'quarterly') {
            $months = 3;
        } elseif ($duration == 'semi-annually') {
            $months = 6;
        } elseif ($duration == 'annually') {
            $months = 12;
        } elseif ($duration == 'biennially') {
            $months = 24;
        } elseif ($duration == 'triennially') {
            $months = 36;
        }
        $currPlanPrice=$productData['finalprice']/$months;
    }
    $productType = $productData['producttype'] ?? '';
    $billingCycle = $productData['billingcycle'] ?? '';
    
    $durationMapping = [
        'monthly' => 1,
        'quarterly' => 3,
        'semi-annually' => 6,
        'annually' => 12,
        'biennially' => 24,
        'triennially' => 36,
    ];

    $duration = $billingCycle && isset($durationMapping[$billingCycle]) ? $durationMapping[$billingCycle] : 1;
    $currPlanPrice = $duration ? $productData['finalprice'] / $duration : 0;
    $productBaseconfigArr = [];

    $plansMapping = [
        'dedicatedserver' => [
            '357' => [1184,1185,1177,1173,1170], //ds1
            '358' => [1200,1201,1193,1189,1186], //ds2
            '361' => [1248,1249,1241,1237,1234], //ds3
            '435' => [1360,1361,1353,1349,1346], //ds4
            '363' => [1280,1281,1273,1269,1266], //ds5
            '360' => [1232,1233,1225,1221,1218], //ds6
            '334' => [963,953,949,952,1522],     //ds7
            '362' => [1264,1265,1257,1250,1253], //ds8
            '364' => [1296,1297,1289,1285,1282], //ds9
            '365' => [1312,1313,1305,1301,1298], //ds10
            '438' => [1376,1377,1369,1365,1362], //ds11
            '440' => [1397,1409,1401,1394,1408], //DS-12
            '439' => [1392,1393,1385,1381,1378], //DS-13
            '337' => [1008,1009,1001,997,994],   //DS-14
            '441' => [1424,1415,1417,1413,1410,1425], //DS-15
            '443' => [1456,1457,1449,1445,1442], //DS-16
            '444' => [1472,1473,1465,1458,1461], //DS-17
            '447' => [1488,1489,1481,1477,1474], //DS-18
            '338' => [1024,1025,1017,1013,1010], //DS-19
            '339' => [1040,1041,1033,1029,1026], //DS-20
            '448' => [1504,1505,1497,1493,1490], //ds21
            '452' => [1520,1521,1513,1509,1506], //ds22
            '382' => [469,459,455,461,458], //DSS25
            '383' => [808,795,799,796,800], //DSS26
            '384' => [823,810,814,811,815], //DSS27
            '385' => [838,825,829,826,830], //DSS28
            '386' => [853,840,844,841,845], //DSS29
            '387' => [868,855,859,856,860], //DSS30
            '389' => [484,471,475,472,476], //DSS32
        ],
        'vps' => [
            //Forex
            '479' => [898,901,897,899,903,909], //Forex-vps-1
            '480' => [911,914,910,912,916,921], //Forex-vps-2
            '481' => [924,927,923,925,929,934], //Forex-vps-3
            '482' => [937,940,936,938,942,947], //Forex-vps-4
            // Linux-STD
            '394' => [503,506,505,656,751], //LIN S1
            '395' => [620,623,622,657,687], //LIN S2
            '396' => [625,628,627,658,752], //LIN S3
            '397' => [630,633,632,659,690], //LIN S4
            '398' => [637,640,639,660,702], //LIN S5
            '399' => [642,645,644,661,717], //LIN S6
            '400' => [647,650,649,662,726], //LIN S7
            '401' => [652,655,654,663,740], //LIN S8
            //Linux-ENT
            '288' => [487,486,488,492,689], //LIN E1
            '289' => [508,507,509,513,695], //LIN E2
            '290' => [516,515,517,521,706], //LIN E3
            '291' => [524,523,525,529,711], //LIN E4
            '292' => [532,531,533,537,728], //LIN E5
            '293' => [540,539,541,545,733], //LIN E6
            '294' => [548,547,549,553,745], //LIN E7
            '295' => [556,555,557,561,750], //LIN E8
            //Windows-Vps
            '483' => [1732,1731,1733,1737,1743,1738], //WIN E1
            '484' => [1745,1744,1746,1750,1756,1751], //WIN E2
            '485' => [1758,1757,1759,1763,1768,1764], //WIN E3
            '486' => [1771,1770,1772,1776,1782,1777], //WIN E4
            '487' => [1784,1783,1785,1789,1794,1790], //WIN E5
            '488' => [1797,1796,1798,1802,1807,1803], //WIN E6
            '489' => [1810,1809,1811,1815,1820,1816], //WIN E7
            '490' => [1823,1822,1824,1828,1834,1829], //WIN E8
            //Windows-vps 2025 plans
            '512' => [1946,1945,1947,1951,1957,1958], 
            '513' => [1960,1959,1961,1965,1971,1972], 
            '514' => [1974,1973,1975,1979,1985,1986], 
            '515' => [1988,1987,1989,1993,1999,2000], 
            // Linux-self managed
            '465' => [1550,1549,1551,1555,1561,1835], //LIN VPS - SM 1
            '466' => [1563,1562,1564,1568,1574,1836], //LIN VPS - SM 2
            '463' => [1524,1523,1525,1529,1535,1837], //LIN VPS - SM 3
            '464' => [1537,1536,1538,1542,1548,1838], //LIN VPS - SM 4
            '467' => [1576,1575,1577,1581,1587,1839], //LIN VPS - SM 5
            '468' => [1589,1588,1590,1594,1600,1840], //LIN VPS - SM 6
            '469' => [1602,1601,1603,1607,1613,1841], //LIN VPS - SM 7
            '470' => [1615,1614,1616,1620,1626,1842], //LIN VPS - SM 8
            //Linux-self managed 2025 plans
            '508' => [1890,1902,1889,1891,1895,1901], 
            '509' => [1904,1903,1905,1909,1915,1916], 
            '510' => [1918,1917,1919,1923,1929,1930], 
            '511' => [1932,1931,1933,1937,1943,1944], 
            //Linux-managed
            '471' => [1628,1627,1629,1633,1639,1843], //LIN VPS - M 1
            '472' => [1641,1640,1642,1646,1652,1844], //LIN VPS - M 2
            '473' => [1654,1653,1655,1659,1665,1845], //LIN VPS - M 3
            '474' => [1667,1666,1668,1672,1678,1846], //LIN VPS - M 4
            '475' => [1680,1679,1681,1685,1691,1847], //LIN VPS - M 5
            '476' => [1693,1692,1694,1698,1704,1848], //LIN VPS - M 6
            '477' => [1706,1705,1707,1711,1717,1849], //LIN VPS - M 7
            '478' => [1719,1718,1720,1724,1730,1850], //LIN VPS - M 8
             //Linux managed 2025 plans
            '516' => [2002,2001,2003,2007,2013,2014], 
            '518' => [2016,2015,2017,2021,2027,2028], 
            '519' => [2030,2029,2031,2035,2041,2042], 
            '520' => [2044,2043,2045,2049,2055,2056], 
            //Java VPS
            '539' => [2073,2072,2074,2078,2084,2075,2085], //Java VPS 1
            '540' => [2087,2086,2088,2092,2098,2099,2089], //Java VPS 2
            '541' => [2101,2100,2102,2106,2103,2112,2113], //Java VPS 3
            '542' => [2115,2114,2116,2120,2117,2126,2127], //Java VPS 4
             //cPanel VPS Hosting 2025 plans
            '543' => [2129,2128,2130,2134,2140,2141], 
            '544' => [2143,2142,2148,2154,2155,2144], 
            '545' => [2157,2156,2158,2162,2168,2169], 
            '546' => [2171,2170,2172,2176,2182,2183],
        ],
    ];
    $productBaseconfigArr = $plansMapping[$productType][$productData['pid']] ?? [];
  }
@endphp
@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
@include('cart.cartscripts')
<!-- <div class="checkout-main">
    <div class="checkout-nav">
        <div class="container">
            <div class="row">
                <div class="line">
                    <div class="chckout-tab1 active" data-aos="zoom-in" data-aos-delay="100">
                        <i class="tab-icon config-icon sprite-image"></i>
                        <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Configuration">Configuration</span>
                    </div>
                    <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                        <i class="tab-icon sign-icon sprite-image"></i>
                        <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Sign In">Sign In / Sign up</span>
                    </div>
                    <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                        <i class="tab-icon billinfo-icon sprite-image"></i>
                        <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="BillingInfo">Billing Info</span>
                    </div>
                    <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="300">
                        <i class="tab-icon card-icon sprite-image"></i>
                        <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Payment">Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="cart-configuration">
    <div class="container">
        <?php 

           if($productData['producttype']=="hosting" || $productData['producttype']=="email" || $productData['producttype']=="ssl" || $productData['producttype']=="dedicatedserver" || $productData['producttype']=="vps")
            {

            ?>
        @foreach($products as $keys=>$value)
        <?php 
            
            
                if(isset($value['title']) && $value['title'] == $productData['groupname'])
                {
                  ?>
        <div class="row">
            <div class="col-sm-12">
                <h3 class="c_c_title">Your Selected Plan: {{$productData['planname']}}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="field-container selectBillingCycle" id="inputBillingcycle">
                    <div class="dedi-red-note-cart-oneline">
                        <label for="inputBillingcycle" class="billingcycle">Choose Billing Cycle.</label>
                            @if ($productData['producttype'] == 'dedicatedserver')
                                <p class="dedi-red-note-cart">*(Servers are subject to availability)</p>
                            @endif
                     </div>
                    {{-- <label for="inputBillingcycle" class="billingcycle">Choose Billing Cycle</label> --}}
                    <form id="cart_form_{{$key}}" action="#" method="post">
                        <div class="row">
                            <input type="hidden" id="ele_key" name="ele_key" value="{{$key}}">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                            @php $ArrayMaxKey=0; $SelectedKey=0;$_oneMonthPlanPrice=0; $_selectedSave=0;$_maxSelectedSave=0;$_maxDuration=0;
                            @endphp
                            @php
                            if(isset($productData['extra_renewal_data'])){                                
                                if($productData['producttype'] == 'hosting'){
                                    $a = ($productData['renewal_monthly_price'] * 36) - $productData['pricing'][6]->price;
                                }else{
                                    $a = ($productData['renewal_monthly_price'] * 12) - $productData['pricing'][4]->price;
                                }
                            }else{
                                $a = '';
                            }
                            @endphp
                            @foreach($productData['pricing'] as $prokey => $pricing)
                            @if($pricing->price > 0)
                            @php
                            $ArrayMaxKey=$prokey;
                            if($productData['billingcycle'] == $pricing->durationame){
                            $SelectedKey=$prokey;
                            }
                            $_basicPercentage='100';
                            $_currentPlanDuration=$pricing->duration;
                            $_oneMonthPlanPrice=reset($productData['pricing'])->price;
                            if(isset($productData['extra_renewal_data'])){
                                $_basicPlanPrice=$productData['renewal_monthly_price']*$_currentPlanDuration;
                            }else{
                                $_basicPlanPrice=reset($productData['pricing'])->price*$_currentPlanDuration;
                            }
                            $_currentPlanPrice=$pricing->price;
                            if ($productData['billingcycle'] == $pricing->durationame) {
                                // dd($_basicPlanPrice,$_currentPlanPrice);
                            $_selectedSave=round($_basicPlanPrice - $_currentPlanPrice,2);

                            // dd($_selectedSave);
                            }
                            $_maxSelectedSave=round($_basicPlanPrice - $_currentPlanPrice,2);
                            $_maxDuration=$pricing->duration;
                            $_duration = $pricing->durationame;
                            @endphp
                            @endif
                            @endforeach
                            @php
                            $free_offer_products = array(523,524,525,527,528,529,531,532,533,535,536,537);  
                            $is_three_months_free = false;
                            if($productData['billingcycle'] == 'triennially' && in_array($productData['pid'],$free_offer_products)){
                                $is_three_months_free = true;
                            }else{
                                $is_three_months_free = false;
                            }
                            $_maxSelected='false';
                            if ($productData['pricing'][$ArrayMaxKey]->duration == $productData['pricing'][$SelectedKey]->duration) {
                            $_maxSelected='true';
                            }else{
                            $_maxSelected='false';
                            }
                            @endphp
                            @foreach($productData['pricing'] as $prokey => $pricing)

                            @if($pricing->price > 0)
                            @php
                            if ($ArrayMaxKey==$prokey){ $featchPlansParam="true"; }else{ $featchPlansParam="false"; }
                            @endphp
                            @php
                            $_basicPercentage='100';
                            $_currentPlanDuration=$pricing->duration;
                            $_basicPlanPrice=reset($productData['pricing'])->price*$_currentPlanDuration;
                            // dd($_basicPlanPrice);
                            $_currentPlanPrice=$pricing->price;
                            @endphp
                            <div class="col-sm-3 mb-4 col-6">
                                <div class="radio-cycle-box rcb-billing {{ ($productData['billingcycle'] == $pricing->durationame)?'rcb-active':'' }} ">
                                    <label class="styled-checkbox-1 styled-checkbox-cstm" for="sel_hostingregister_{{$key}}_{{$prokey}}">
                                        @if($productData['billingcycle'] == $pricing->durationame)

                                        @php $selectedPlansPrice=$pricing; @endphp
                                        <input type="radio" class="billing_cycle_input" name="sel_hostingregister_{{$key}}" id="sel_hostingregister_{{$key}}_{{$prokey}}" checked value="{{$pricing->durationame}}" @if($productData['producttype']=='vps' ) onclick="updateServerItem('{{$key}}','{{$prokey}}');addRemoveSelectedClass('{{$key}}','{{$prokey}}');featchPlansMessage({'is_three_months_free':'{{$is_three_months_free}}','selectedMax':'{{ $featchPlansParam }}','saveamount':'{{ round($_basicPlanPrice - $_currentPlanPrice,2) }}','maxselectedsave':'{{ $_maxSelectedSave }}','maxDuration':'{{ $_maxDuration }}'});" @else($productData['producttype']=='hosting' ) onclick="updateHostingItem('{{$key}}','{{$prokey}}');addRemoveSelectedClass('{{$key}}','{{$prokey}}');featchPlansMessage({'is_three_months_free':'{{$is_three_months_free}}','selectedMax':'{{ $featchPlansParam }}','saveamount':'{{ round($_basicPlanPrice - $_currentPlanPrice,2) }}','maxselectedsave':'{{ $_maxSelectedSave }}','maxDuration':'{{ $_maxDuration }}'});" @endif>
                                        @else
                                        <input type="radio" class="billing_cycle_input" name="sel_hostingregister_{{$key}}" id="sel_hostingregister_{{$key}}_{{$prokey}}" value="{{$pricing->durationame}}" @if($productData['producttype']=='vps' ) onclick="updateServerItem('{{$key}}','{{$prokey}}');addRemoveSelectedClass('{{$key}}','{{$prokey}}');featchPlansMessage({'is_three_months_free':'{{$is_three_months_free}}','selectedMax':'{{ $featchPlansParam }}','saveamount':'{{ round($_basicPlanPrice - $_currentPlanPrice,2) }}','maxselectedsave':'{{ $_maxSelectedSave }}','maxDuration':'{{ $_maxDuration }}'});" @else($productData['producttype']=='hosting' ) onclick="updateHostingItem('{{$key}}','{{$prokey}}');addRemoveSelectedClass('{{$key}}','{{$prokey}}');featchPlansMessage({'is_three_months_free':'{{$is_three_months_free}}','selectedMax':'{{ $featchPlansParam }}','saveamount':'{{ round($_basicPlanPrice - $_currentPlanPrice,2) }}','maxselectedsave':'{{ $_maxSelectedSave }}','maxDuration':'{{ $_maxDuration }}'});" @endif>
                                        @endif

                                        <span class="checkmark"></span>
                                        <div class="radio-content text-center cpbm-main">
                                            <h6>
                                                <div class="cpbm-headtext">
                                                    @if($pricing->duration > 1)
                                                    {{$pricing->duration}} Months
                                                    @else
                                                    {{$pricing->duration}} Month
                                                    @endif
                                                </div>
                                                <br>
                                                @if($pricing->duration == 1 && !isset($productData['renewal_monthly_price']))
                                                <br>
                                                @endif
                                                {{-- @if($pricing->duration > 1) --}}
                                                @if($_oneMonthPlanPrice > 0)
                                                @php
                                                $cut_price = '';
                                                $symbol = '';
                                                    if(isset($productData['renewal_monthly_price'])){
                                                        $cut_price = round($productData['renewal_monthly_price'],2);
                                                        $symbol = Config::get('Constant.sys_currency_symbol');
                                                    }

                                                    elseif($pricing->duration > 1){
                                                        $cut_price = round(str_replace(".00", "", $_oneMonthPlanPrice),2);  
                                                        $symbol = Config::get('Constant.sys_currency_symbol');

                                                    }
                                                   
                                                @endphp

                                                @if($productData['producttype'] == 'hosting')
                                                    @if($pricing->duration > 1)
                                                    <span class="linethrough cpbm-mp-cut">{!! $symbol !!}{{ $cut_price }}</span>
                                                    @elseif(in_array($productData['pid'],[534,535,536,537,522,523,524,525,530,531,532,533,526,527,528,529]))
                                                    <br>                                                
                                                    @endif
                                                @else                                                    
                                                    @if($pricing->duration == 1 && in_array($productData['pid'],[508,509,510,511,512,513,514,515]))
                                                    <br>
                                                    @else
                                                    <span class="linethrough cpbm-mp-cut">{!! $symbol !!}{{ $cut_price }}</span>                                                  
                                                    @endif
                                                @endif

                                                @elseif($productData['producttype'] == 'email')
                                                @php
                                                $cut_price = '';
                                                $symbol = '';
                                                    if(isset($productData['renewal_monthly_price'])){
                                                        $cut_price = round($productData['renewal_monthly_price'],2);
                                                        $symbol = Config::get('Constant.sys_currency_symbol');
                                                    }

                                                    elseif($pricing->duration > 1){
                                                        $cut_price = round(str_replace(".00", "", $_oneMonthPlanPrice),2);  
                                                        $symbol = Config::get('Constant.sys_currency_symbol');

                                                    }                                                                                                       
                                                @endphp
                                                @if($cut_price > 0)
                                                <span class="linethrough cpbm-mp-cut">{!! $symbol !!}{{ $cut_price }}</span>
                                                @endif
                                                
                                                @endif
                                                {{-- @endif --}}
                                                <?php 
                                                    $_pr = $pricing->price;                                                     
                                                    $strM = "";
                                                    if(isset($productData['producttype']) && $productData['producttype'] == 'ssl'){ 
                                                        $_pr = $pricing->price;  $strM = "year";
                                                    }
                                                    else if(isset($productData['producttype']) && $productData['producttype'] != 'ssl'){ 
                                                        if(!empty($pricing->price) && !empty($pricing->duration)){ 
                                                            $_pr = $pricing->price / $pricing->duration; $strM = "mo"; 
                                                        }   
                                                    }
                                                ?>
                                                <span class="cpbm-mprice">
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}{{number_format($_pr,2,'.','')}}
                                                    <small class="cpbm-mp-mnth">/{{$strM}}</small>
                                                </span>
                                            </h6>
                                            <span>
                                                <?php
                                               $discount = 100 - round($_currentPlanPrice * $_basicPercentage / $_basicPlanPrice);
                                               // echo '<pre>'; print_r($discount);
                                                ?>
                                                {{-- $pricing->duration != 1 && --}}
                                                @if (isset($productData['producttype']) && $productData['producttype'] != 'ssl' && $productData['producttype'] != 'email')

                                                @php
                                                if(isset($productData['renewal_monthly_price'])){
                                                     $per_off = round((100-($_pr / $productData['renewal_monthly_price']) * 100), 0);                                                    
                                                }else{
                                                    $per_off = (100 - round($_currentPlanPrice * $_basicPercentage / $_basicPlanPrice));
                                                }
                                                @endphp
                                                @if(isset($productData['extra_renewal_data']))
                                                @if($per_off>0)         
                                                <span class="cpbm-save {{ ($prokey != $ArrayMaxKey)?'cpbms-cc':'' }}">Save {{ $per_off }}% </span>
                                                @endif
                                                @endif

                                                @if(!isset($productData['extra_renewal_data']) && $pricing->duration != 1)
                                                    <span class="cpbm-save {{ ($prokey != $ArrayMaxKey)?'cpbms-cc':'' }}">Save {{ $per_off }}% </span>
                                                @endif
                                                @endif
                                                <br>
                                            </span>
                                            <div class="cpbm-stotal">
                                            @if($productData['producttype'] == 'vps' || $productData['producttype'] == 'email' || $productData['producttype'] == 'hosting' && in_array($productData['pid'],[534,535,536,537,522,523,524,525,530,531,532,533,526,527,528,529]))
                                                
                                            @if(isset($productData['extra_renewal_data']))
                                                @if(isset($pricing->renewal_price))
                                                <span class="subtotal">Renews at:&nbsp;<strong>{!! Config::get('Constant.sys_currency_symbol') !!}
                                                    {{round($pricing->renewal_price,2)}}/mo</strong></span>
                                                @else
                                                <span class="subtotal">Renews at:&nbsp;<strong>{!! Config::get('Constant.sys_currency_symbol') !!}
                                                    {{round($pricing->price,2)}}/mo</strong></span>
                                                @endif
                                                                                            
                                                    
                                            @elseif(!isset($productData['extra_renewal_data']))
                                            <span class="subtotal">Subtotal:&nbsp;<strong>{!! Config::get('Constant.sys_currency_symbol') !!}
                                                {{ round($_currentPlanPrice,2) }}</strong></span>

                                            @endif
                                            @else
                                                <span class="subtotal">Subtotal:&nbsp;<strong>{!! Config::get('Constant.sys_currency_symbol') !!}{{ round($_currentPlanPrice,2) }}</strong></span>
                                            @endif

                                        
                                            
                                                
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                @if($pricing->duration > 1)
                                {{-- <div class="cpbm-usv text-center">
                                    @if($_basicPlanPrice > 0)
                                    <span class="">You&nbsp;save:&nbsp;<strong>{!! Config::get('Constant.sys_currency_symbol') !!}{{ round($_basicPlanPrice - $_currentPlanPrice,2) }}</strong></span><br>
                                    @endif
                                </div> --}}
                                @endif
                            </div>
                            @endif
                            @endforeach
                            @if (isset($productData['producttype']) && $productData['producttype'] != 'ssl' && $productData['producttype'] != 'email')
                            @if ($productData['producttype'] == 'vps')
                            {{-- <div class="renew_price" id="renew_price_date">Renews at
                            <span class="rupee"> {!! Config::get('Constant.sys_currency_symbol') !!}</span>{{round(($selectedPlansPrice->price/$selectedPlansPrice->duration),2)}}/month 
                        </div> --}}
                        @endif
                            <div class="col-sm-12" id="plansAlertMessage">
                            </div>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- @if(in_array($productData['pid'], [495, 496, 497, 498,421,421,422,423,424,425,426,427,428,429,430,431,432])) --}}
                @if(in_array($productData['pid'], [534,535,536,537,522,523,524,525,530,531,532,533,526,527,528,529]))
               
    <div class="server-location-box">
        <h3 class="c_c_title">Choose Server Location</h3>
        <div class="c_c_box">
         @if(isset($productData['customfields']) && !empty($productData['customfields']))

            @foreach($productData['customfields'] as $field)
                @if($field['fieldtype'] == 'dropdown' && $field['name'] == 'Location')
                    <select name="customField[{{ $field['id'] }}]" id="customField{{ $field['id'] }}" class="c_c_box_arrow form-select" onchange="setCustomFieldValue('{{$_REQUEST['id']}}','{{$field['id']}}',this.value);">
                        {{-- @if($productData['pid'] == 495 || $productData['pid'] == 421 || $productData['pid'] == 425 || $productData['pid'] == 429)
                            <option value="India" {{ 'India' == $field['selectedOption'] ? 'selected' : '' }}>India</option>
                        @else --}}
                            @foreach(explode(',', $field['fieldoptions']) as $option)
                                <option value="{{ $option }}" {{ $option == $field['selectedOption'] ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        {{-- @endif --}}
                    </select>
                @endif
            @endforeach
@endif
            
        </div>
    </div>
@endif

                @if($productData['producttype']=="hosting" || $productData['producttype']=="email" || $productData['producttype']=="ssl")
                    <div class="c_c_box">
                        <h4 class="c_c_title c_c_blue-title">Select a domain</h4>
                        <input type="hidden" id="isproductvalid" name="isproductvalid" value="N">
                        <div class="select_domain_div">
                            <div class="form-group">
                                <label class="title">I have an existing domain name</label>
                                <div class="input-group">
                                    <input maxlength="60" class="form-control" id="ihavedomain" name="ihavedomain" value="" onkeyup="hidevalidmass();">
                                    <span id="hiddenProductId" class="not_for_deskp hiddenProductId"></span>
                                    <button class="btn" id="ihavedomainbtn" title="Use This">Use This</button>
                                </div>
                                <span id="hiddenProductId" class="not_for_mob hiddenProductId"></span>
                            </div>
                            <span class="or">OR</span>
                            <div class="form-group">
                                <label class="title">I want to register a new domain name</label>
                                <div class="input-group">
                                    <input class="form-control combo_input" maxlength="60" id="bookdomaintxt" name="bookdomaintxt" value="" onkeyup="hidevalidmass_search();">
                                    <div class="domain_combo">
                                        <div class="">
                                            <select class="selct_tld" id="selTld" name="selTld">
                                                @foreach($tlds as $tld)
                                                <option value="{{$tld}}">{{$tld}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <span id="serarchdomain" class="not_for_deskp serarchdomain"></span>
                                    <button class="btn" title="Use This" id="searchdomainbtn" name="searchdomainbtn">
                                       <div class="search-dmn-desk">Search</div>
                                       <div class="search-dmn-mo"><i class="fa-solid fa-magnifying-glass"></i></div></button>
                                </div>
                                <span id="serarchdomain" class="not_for_mob serarchdomain"></span>
                                <div class="last-step-checkout" style="display:none;" id="domainavailmsg">
                                    <span class="checkout-text">Please click on <strong> Continue to Checkout </strong> to complete this order.</span>
                                    <button class="btn" id="addconfigdomainbtn">Use this</button>
                                </div>
                            </div>
                        </div>
                        <div class="last-step-checkout" style="display:none;" id="submitbtn">
                            <span class="checkout-text">Please click on <strong> Continue to Checkout </strong> to complete this order.</span>
                            <?php /*<button class="btn" onclick="window.location.href='/cart';">Checkout</button>*/?>
                        </div>
                    </div>
                @endif                
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="c_c_box" id="sidemenu">
                    @if ($productData['producttype'] == 'dedicatedserver' || $productData['producttype'] == 'vps')
                    <h4 class="c_c_title c_c_blue-title c_c_vps_title">Order Summary</h4>
                    <div class="c_c_plan_features">
                        <ul class="base_config" id="vps_configuration_html">
                            <li>
                                <div class="plan_name_price plan-nm-line">
                                    <span>
                                        {{-- if start for extra_renewal_data is available --}}
                                        @if(isset($productData['extra_renewal_data']))
                                                @php
                                                    $m_renewal = $productData['renewal_monthly_price'];
                                                    $total_cut_price = $productData['billingcycle'] == 'annually' ? $m_renewal * 12 : $m_renewal;

                                                    // dd($productData['pricing'][1]->price);
                                                    $curr_plan_price = 0;
                                                    if($productData['billingcycle'] == 'annually'){
                                                        $curr_plan_price = $productData['pricing'][4]->price / 12;
                                                    }elseif($productData['billingcycle'] == 'monthly'){
                                                        $curr_plan_price = $productData['pricing'][1]->price / 1;
                                                    }                                                

                                                    // $new_discount = 100 - round($_currentPlanPrice * 100 / $m_renewal);
                                                    $new_discount = round((100-($curr_plan_price / $m_renewal) * 100), 0);
                                                    
                                                @endphp                                                
                                                    {{-- {{dd($pricing->duration)}} --}}
                                                    <span class="linethrough cpbm-mp-cut"><span class="rupee"> {!! Config::get('Constant.sys_currency_symbol') !!}</span>{{round($total_cut_price,2)}}</span>
                                            @endif
                                        {{-- if end for extra_renewal_data is available --}}

                                        <strong>
                                            <span class="rupee"> {!! Config::get('Constant.sys_currency_symbol') !!}</span>{{round($selectedPlansPrice->price,2)}}
                                        </strong>
                                    </span>
                                    <strong>{{$productData['planname']}}</strong>
                                </div>
                            </li>
                            @if(isset($new_discount) && $new_discount > 0)                      
                            <li><span><strong>Discount: -{{$new_discount}}% <span class="text-danger float-end">-{!! Config::get('Constant.sys_currency_symbol') !!}{{round($total_cut_price - $selectedPlansPrice->price,2)}}</span></strong></span></li>
                            @endif
                            @php
                            $productDataDomain='';
                            foreach($productData['customfields'] as $_customfield){
                            if($_customfield['id'] == 'hostname'){
                            $productDataDomain = $_customfield['selectedOption'];
                            }
                            }
                            @endphp
                            @if(isset($productDataDomain) && !empty($productDataDomain))
                            <div class="ost_product-name">{{$productDataDomain}}</div>
                            @else
                            {{-- <div class="ost_product-name host_{{$_REQUEST['id']}}">
                                <span class="red">Please provide Hostname.
                                </span>&nbsp;
                                <a class="carterr hostclick" data-id="{{$_REQUEST['id']}}" data-toggle="modal" data-target="#domainModel" title="Update Hostname" href="">Update Hostname</a>
                            </div> --}}
                            @endif
                        </ul>

                        {{-- {{dd($selectedPlansPrice->price,$selectedPlansPrice->duration)}} --}}
                        {{-- <div class="renew_price @if($productData['producttype'] != 'dedicatedserver') renew_price_date @endif" id="renew_price" style="font-size:small">Will renew at
                            <span class="rupee"> {!! Config::get('Constant.sys_currency_symbol') !!}</span>

                            @if(!isset($productData['extra_renewal_data']))
                            {{round(($selectedPlansPrice->price/$selectedPlansPrice->duration),2)}}/mo

                            @elseif(isset($productData['extra_renewal_data']))
                                @if($productData['billingcycle'] == 'annually')
                                 {{round($productData['renewal_yearlyPrice_perMonth'],2)}}/mo                                
                                @endif

                                @if($productData['billingcycle'] == 'monthly')
                                 {{round($productData['renewal_monthly_price'],2)}}/mo
                                @endif
                            @endif
                           
                        </div> --}}
                        <hr>
                        <input type="hidden" name="month" id="month" value="{{$months}}">
                        <div class="cc_sub" id="cc_sub">
                            <div style="margin: 12px 0;padding: 0;"><strong>Adddon Services</strong></div>
                            @php $bconfig_i=0; @endphp
                            <div id="configration_html">
                                @if (Session::has('d_baseconfig.'.$_REQUEST['id']))
                                @foreach (Session::get('d_baseconfig.'.$_REQUEST['id']) as $elements)
                                @if (!empty($elements))
                                <div class="stotal">
                                    @foreach ($elements as $element)
                                    @if (!empty($element))
                                    {!! $element !!} @php $bconfig_i++; @endphp
                                    @endif
                                    @endforeach
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                            <hr id="configration_html_hr" @if ($bconfig_i==0) style="display:none" @endif>
                            <script>
                            @if($bconfig_i == 0) $('#cc_sub').hide();
                            @endif
                            </script>
                        </div>
                    </div>
                    <div class="low-price-main">
                        <div class="c_c_title" id="g_total">
                            Total: <span class="low-price" id="G_total_div"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['finalprice']}}</span>
                            <span class="fw-4 fs-11 d-block">(18% GST will be applicable*)</span>
                        </div>
                    </div>
                    @else
                    <h4 class="c_c_title c_c_blue-title c_c_vps_title">Your plan includes:</h4>
                    <ul class="base_config">
                        @foreach($productData['specifications'] as $keysss=>$value)
                          @if(strtolower(trim($value)) == 'free domain')
                            @if($productData['planname'] != 'BASIC' && ($productData['billingcycle']) != 'monthly' && $productData['planname'] != 'ESSENTIAL')
                              <li> 
                                <div class="free_domain">{{$value}}
                                    <span class="domain_tooltip">
                                       Unlock the free domain on the Plan! Purchase for a 1-year or more & get a free domain for the first year. The free domain is valid for the first year only. The domain is chargeable at the renewal price from the second year onwards.
                                    <span class="price_domain" style="color: #fff;display: block;padding: 10px 0;font-weight: 600;">Your Domain Renewal Charges:<br>{!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr* </span> </span>
                                </div>
                              </li>
                            @endif
                          @else
                            @if($productData['planname'] != 'BASIC')
                              <li>{{$value}}</li>
                            @else
                              @if(strtolower(trim($value)) != 'free backup' && strtolower(trim($value)) != 'website builder'  && strtolower(trim($value)) != 'supports python')
                                <li>{{$value}}</li>
                              @endif
                            @endif
                          @endif  
                        @endforeach
                    </ul>
                    <div class="c_c_plan_features">
                        <ul class="base_config" id="vps_configuration_html">{!!$productData['confightml']!!}</ul>
                    </div>
                    <hr>
                    <div class="low-price-main">
                        <div class="c_c_title" class="total_price" id="finalPrice">
                            Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['finalprice']}}</span>
                        </div>
                    </div>
                    @endif
                </div>
                @if ($productData['producttype'] == 'vps')
                    <div class="text-center"><strong>You’re not alone! 5000+ SMBs trust Host IT Smart for VPS</strong></div>

                @endif

            </div>

            <!--display cut price start-->
            @if ($productData['pid'] == 250 || $productData['pid'] == 154)
            <script>
            $(function() {
                $('.p_p_linethrough').removeClass("d-none");
            });
            </script>
            @endif
            <!--display cut price end-->
        </div>
        <?php
                }
            

         ?>
        @endforeach
        <?php 
            if($productData['producttype']=="vps" || $productData['producttype']=="dedicatedserver")
            {

                ?>
        <div class="row">
            <div class="col-sm-12">
                <h3 class="c_c_title">Select your Operating System and Hardware Upgrades</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8">
                @if(!empty($productData['configfields']))
                {{-- vikram vps plans changes S 10/3/2022 --}}
                @if ($productData['producttype']=="dedicatedserver" || $productData['producttype']=="vps")
                {{-- vikram vps plans changes E 10/3/2022 --}}
                <div class="c_c_box">
                    <div class="">
                        <div id="featuresDiv">
                            <div class="product-info">
                                <div class="row align-items-center justify-content-around">
                                    <div class="col-md-12">
                                        <h5 class="c_c_title c_c_blue-title">Your base server config..</h5><br>
                                        <ul class="list-unstyled tech-feature-list base_config">
                                            <?php
                                            // echo '<pre>123: '; print_r($productData['configfields']); exit;
                                            ?>
                                            @foreach($productData['configfields'] as $field)
                                            @if (in_array($field['id'], $productBaseconfigArr))
                                            <div class="row align-items-center">
                                                <div class="col-sm-3 mb-3">
                                                    <span class="c_c_title-desc">{{$field['name']}}</span>
                                                </div>
                                                @php
                                                $options = $field['options'];
                                                @endphp
                                                <div class="col-sm-9 mb-3">
                                                    <span class="mb-second form-control">{{$options[0]['name']}}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($productData['groupname'] != 'Forex VPS')
                <div class="c_c_box">
                    <h5 class="c_c_title c_c_blue-title">Configurable Options</h5><br>
                    @foreach($productData['configfields'] as $field)
                    @if (!in_array($field['id'], $productBaseconfigArr))
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-3">
                            <h4 class="c_c_title-desc">{{$field['name']}}</h4>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group cart-dropdown">
                                <select class="form-control form-select" id="customfields_{{$field['id']}}" name="customfields_{{$field['id']}}" onchange="setConfigurationFieldValue('{{$_REQUEST['id']}}','{{$field['id']}}',this.value);">
                                    @php
                                    $options = $field['options'];
                                    @endphp
                                    @foreach($options as $option)
                                    @php
                                    $optStr = "";
                                    if($option['pricing']['price'][$productData['regperiod']] > 0){
                                    $optStr .= " at ".Config::get('Constant.sys_currency_symbol').round($option['pricing']['price'][$productData['regperiod']]/$months)."/mo.";
                                    }elseif($option['name'] != "None"){
                                    $optStr .= "FREE";
                                    }
                                    @endphp
                                    <option value="{{$option['id']}}" id="cpu-option{{$option['id']}}" @if(isset($field['selectedOption']) && $field['selectedOption']==$option['id']) selected="selected" @endif> {{$option['name']}}<span> {!!$optStr!!}</span>
                                    </option>
                                    @php
                                    if(isset($field['selectedOption']) && $field['selectedOption'] == $option['id']) {
                                        echo '<script type="text/javascript"> $(function() { $("#cpu-option'.$option['id'].'").val('.$field['selectedOption'].').change(); }); </script>';
                                    }
                                    @endphp
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif
                @else
                <div class="c_c_box">
                    @foreach($productData['configfields'] as $field)
                    <h4 class="c_c_title c_c_blue-title">{{$field['name']}}</h4>
                    <div class="c_c_title-desc">Select Your {{$field['name']}}</div>
                    @php
                    $options = $field['options'];
                    $validationStr[] = " configfield_".$field['id'].": { required: true }";
                    $validationMsgStr[] = " configfield_".$field['id'].": { required: 'Please select configuration option.' }";
                    @endphp
                    <div class="c_c_select-plan c_c_vps_plans">
                        <input type="hidden" id="fieldName" value="{{$field['name']}}">
                        <div class="c_c_plan-options vps-plan-options" id="configfield_{{$field['id']}}">
                            <?php 
                                    //Openvz
                                    $configoptionImgArr['578']="icon-none.png";
                                    $configoptionImgArr['579']="icon-cwp.png"; 
                                    $configoptionImgArr['1000']="icon-cwp.png";    //CWP Pro
                                    $configoptionImgArr['580']="icon-cpanel.png"; 
                                    $configoptionImgArr['571']="icon-cpu.png";
                                    $configoptionImgArr['572']="icon-cpu.png";
                                    $configoptionImgArr['573']="icon-ram.png";
                                    $configoptionImgArr['574']="icon-ram.png";
                                    $configoptionImgArr['744']="icon-ram.png"; 
                                    $configoptionImgArr['575']="icon-hardisk.png";
                                    $configoptionImgArr['576']="icon-hardisk.png";
                                    $configoptionImgArr['577']="icon-hardisk.png";
                                    $configoptionImgArr['745']="icon-hardisk.png"; 
                                    $configoptionImgArr['830']="icon-hardisk.png";
                                    $configoptionImgArr['581']="icon-centOS.png";
                                    $configoptionImgArr['582']="icon-centOS.png";
                                    $configoptionImgArr['583']="icon_debian.png";
                                    $configoptionImgArr['668']="icon-centOS.png";
                                    $configoptionImgArr['584']="icon-ubuntu.png";
                                    $configoptionImgArr['823']="icon_india.png";
                                    $configoptionImgArr['824']="icon_india.png";
                                    $configoptionImgArr['825']="icon_usa.png";
                                    $configoptionImgArr['826']="icon_usa.png";
                                    $configoptionImgArr['827']="icon_usa.png";
                                    $configoptionImgArr['997']="icon_plesk.png";
                                    $configoptionImgArr['998']="icon_plesk.png";
                                    $configoptionImgArr['999']="icon_plesk.png";
                                    
                                    //KVM
                                    $configoptionImgArr['585']="icon-cpu.png";
                                    $configoptionImgArr['598']="icon-cpu.png";     
                                    $configoptionImgArr['587']="icon-ram.png"; 
                                    $configoptionImgArr['588']="icon-ram.png";
                                    $configoptionImgArr['746']="icon-ram.png";
                                    $configoptionImgArr['589']="icon-hardisk.png";
                                    $configoptionImgArr['590']="icon-hardisk.png";
                                    $configoptionImgArr['591']="icon-hardisk.png"; 
                                    $configoptionImgArr['747']="icon-hardisk.png";
                                    $configoptionImgArr['597']="icon-none.png";
                                    $configoptionImgArr['592']="icon-cwp.png";
                                    $configoptionImgArr['1001']="icon-cwp.png";    //CWP Pro
                                    $configoptionImgArr['593']="icon-cpanel.png"; 
                                    $configoptionImgArr['594']="icon-centOS.png";
                                    $configoptionImgArr['595']="icon-centOS.png";
                                    $configoptionImgArr['596']="icon-centOS.png";
                                    $configoptionImgArr['802']="icon-ubuntu.png";
                                    $configoptionImgArr['805']="icon-none.png";
                                    $configoptionImgArr['804']="icon-sql-server.png";
                                    $configoptionImgArr['850']="icon-sql-server.png";
                                    $configoptionImgArr['851']="icon-sql-server.png";
                                    $configoptionImgArr['1018']="icon-ubuntu.png";
                                    $configoptionImgArr['1017']="icon_bandwidth.png";
                                    $configoptionImgArr['1019']="icon_debian.png";
                                    $configoptionImgArr['1020']="icon-windows.png";
                                    $configoptionImgArr['1148']="chat.png";
                                    $configoptionImgArr['1149']="chat.png";
                                    $configoptionImgArr['1150']="chat.png";
                                    $configoptionImgArr['1151']="chat.png";
                                   
                                    //Virtuozzo
                                    $configoptionImgArr['763']="icon-ram.png";
                                    $configoptionImgArr['764']="icon-ram.png";     
                                    $configoptionImgArr['765']="icon-ram.png"; 
                                    $configoptionImgArr['767']="icon-cpu.png";
                                    $configoptionImgArr['766']="icon-cpu.png";
                                    $configoptionImgArr['768']="icon-hardisk.png";
                                    $configoptionImgArr['769']="icon-hardisk.png";
                                    $configoptionImgArr['770']="icon-hardisk.png"; 
                                    $configoptionImgArr['771']="icon-hardisk.png";
                                    $configoptionImgArr['774']="icon-none.png";
                                    $configoptionImgArr['772']="icon-cwp.png";
                                    $configoptionImgArr['773']="icon-cpanel.png"; 
                                    $configoptionImgArr['775']="icon-centOS.png";
                                    $configoptionImgArr['776']="icon-ubuntu.png";
                                    $configoptionImgArr['777']="icon_debian.png";
                                    $configoptionImgArr['828']="icon-windows.png";

                                    //Starter(Dedicated)
                                    $configoptionImgArr['617']="icon-ram.png";
                                    $configoptionImgArr['618']="icon-ram.png";     
                                    $configoptionImgArr['599']="icon-ram.png"; 
                                    $configoptionImgArr['601']="icon-hardisk.png";
                                    $configoptionImgArr['642']="icon-hardisk.png";
                                    $configoptionImgArr['643']="icon-hardisk.png";
                                    $configoptionImgArr['1078']="icon-hardisk.png";
                                    $configoptionImgArr['603']="icon-centOS.png";
                                    $configoptionImgArr['604']="icon-centOS.png"; 
                                    $configoptionImgArr['605']="icon-centOS.png";
                                    $configoptionImgArr['611']="icon-windows.png";
                                    $configoptionImgArr['612']="icon-windows.png";
                                    $configoptionImgArr['613']="icon-windows.png"; 
                                    $configoptionImgArr['783']="icon-windows.png";
                                    $configoptionImgArr['784']="icon-windows.png";
                                    $configoptionImgArr['785']="icon-windows.png";
                                    $configoptionImgArr['606']="icon_bandwidth.png";
                                    $configoptionImgArr['607']="icon-none.png";
                                    $configoptionImgArr['610']="icon-cwp.png";
                                    $configoptionImgArr['608']="icon-cpanel.png";
                                    $configoptionImgArr['614']="icon_plesk.png";
                                    $configoptionImgArr['615']="icon_plesk.png";
                                    $configoptionImgArr['669']="icon_plesk.png";
                                    $configoptionImgArr['609']="icon_port.png";
                                    $configoptionImgArr['678']="icon-none.png";
                                    $configoptionImgArr['681']="icon-centOS.png";
                                    $configoptionImgArr['682']="icon-centOS.png";
                                    $configoptionImgArr['683']="icon-centOS.png";
                                    $configoptionImgArr['798']="icon-none.png";
                                    $configoptionImgArr['792']="icon-sql-server.png";
                                    $configoptionImgArr['793']="icon-sql-server.png";
                                    $configoptionImgArr['794']="icon-sql-server.png";


                                     //Performance(Dedicated)
                                    $configoptionImgArr['621']="icon-ram.png";
                                    $configoptionImgArr['637']="icon-ram.png";     
                                    $configoptionImgArr['778']="icon-ram.png"; 
                                    $configoptionImgArr['779']="icon-hardisk.png";
                                    $configoptionImgArr['641']="icon-hardisk.png";
                                    $configoptionImgArr['1077']="icon-hardisk.png";
                                    $configoptionImgArr['623']="icon-centOS.png";
                                    // $configoptionImgArr['622']="icon-centOS.png";
                                    $configoptionImgArr['622']="icon-hardisk.png";
                                    $configoptionImgArr['624']="icon-centOS.png";
                                    $configoptionImgArr['625']="icon-centOS.png"; 
                                    $configoptionImgArr['626']="icon-windows.png";
                                    $configoptionImgArr['627']="icon-windows.png";
                                    $configoptionImgArr['628']="icon-windows.png";
                                    $configoptionImgArr['780']="icon-windows.png"; 
                                    $configoptionImgArr['781']="icon-windows.png";
                                    $configoptionImgArr['782']="icon-windows.png";
                                    $configoptionImgArr['629']="icon-centOS.png";
                                    $configoptionImgArr['630']="icon-none.png";
                                    $configoptionImgArr['632']="icon-cwp.png";
                                    $configoptionImgArr['631']="icon-cpanel.png";
                                    $configoptionImgArr['633']="icon-centOS.png";
                                    $configoptionImgArr['634']="icon-centOS.png";
                                    $configoptionImgArr['635']="icon-centOS.png";
                                    $configoptionImgArr['636']="icon-centOS.png";
                                    $configoptionImgArr['640']="icon-hardisk.png";
                                    $configoptionImgArr['678']="icon-none.png";
                                    $configoptionImgArr['681']="icon-centOS.png";
                                    $configoptionImgArr['682']="icon-centOS.png";
                                    $configoptionImgArr['683']="icon-centOS.png";
                                    $configoptionImgArr['1080']="icon-centOS.png";
                                    $configoptionImgArr['639']="icon-hardisk.png";
                                    $configoptionImgArr['800']="icon-none.png";
                                    $configoptionImgArr['795']="icon-sql-server.png";
                                    $configoptionImgArr['796']="icon-sql-server.png";
                                    $configoptionImgArr['797']="icon-sql-server.png";


                                     //Business(Dedicated)
                                    $configoptionImgArr['644']="icon-centOS.png";
                                    $configoptionImgArr['645']="icon-centOS.png";     
                                    $configoptionImgArr['646']="icon-centOS.png"; 
                                    $configoptionImgArr['647']="icon-windows.png";
                                    $configoptionImgArr['648']="icon-windows.png";
                                    $configoptionImgArr['649']="icon-windows.png";
                                    $configoptionImgArr['786']="icon-windows.png";
                                    $configoptionImgArr['787']="icon-windows.png";
                                    $configoptionImgArr['788']="icon-windows.png"; 
                                    $configoptionImgArr['664']="icon-hardisk.png";
                                    $configoptionImgArr['650']="icon-hardisk.png";
                                    $configoptionImgArr['651']="icon-hardisk.png";
                                    $configoptionImgArr['1079']="icon-hardisk.png";
                                    $configoptionImgArr['653']="icon-ram.png"; 
                                    $configoptionImgArr['652']="icon-ram.png";
                                    $configoptionImgArr['654']="icon_bandwidth.png";
                                    $configoptionImgArr['655']="icon-none.png";
                                    $configoptionImgArr['657']="icon-cwp.png";
                                    $configoptionImgArr['656']="icon-cpanel.png";
                                    $configoptionImgArr['658']="icon_plesk.png";
                                    $configoptionImgArr['659']="icon_plesk.png";
                                    $configoptionImgArr['660']="icon_plesk.png";
                                    $configoptionImgArr['661']="icon_port.png";
                                    $configoptionImgArr['678']="icon-none.png";
                                    $configoptionImgArr['681']="icon_plesk.png";
                                    $configoptionImgArr['682']="icon_plesk.png";
                                    $configoptionImgArr['683']="icon_plesk.png";
                                    $configoptionImgArr['801']="icon-none.png";
                                    $configoptionImgArr['663']="icon-hardisk.png";
                                    $configoptionImgArr['662']="icon-hardisk.png";
                                    $configoptionImgArr['799']="icon-none.png";
                                    $configoptionImgArr['789']="icon-sql-server.png";
                                    $configoptionImgArr['790']="icon-sql-server.png";
                                    $configoptionImgArr['791']="icon-sql-server.png";
                                    $configoptionImgArr['829']="icon-hardisk.png";
                                    $configoptionImgArr['993']="icon_plesk.png";
                                    $configoptionImgArr['994']="icon_plesk.png";
                                    $configoptionImgArr['995']="icon_plesk.png";
                                    $configoptionImgArr['990']="icon_plesk.png";
                                    $configoptionImgArr['991']="icon_plesk.png";
                                    $configoptionImgArr['992']="icon_plesk.png";
                                    
                                    // hide config from user
                                    $configoptionHideArr[]='1413';

                                ?>
                            @foreach($options as $option)
                            @if (!in_array($option['id'], $configoptionHideArr))
                            <div class="box_radio_label">
                                <input type="radio" class="configele 123" value="{{$option['id']}}" id="cpu-option{{$option['id']}}" name="customfields_{{$field['id']}}" onclick="setConfigurationFieldValue('{{$_REQUEST['id']}}','{{$field['id']}}',this.value);" @if(isset($field['selectedOption']) && $field['selectedOption']==$option['id']) checked="true" @endif>
                                <?php 
                                    
                                     //--------------------------03 Sep 2018-------------------------------
                                     if(isset($field['selectedOption']) && $field['selectedOption'] == $option['id'])
                                     { 
                                         echo '<script type="text/javascript">$(function(){ $("#cpu-option'.$option['id'].'").click(); });</script>';
                                     }
                                     //--------------------------03 Sep 2018-------------------------------
                                    
                                    $optStr =  "";
                                    if($option['pricing']['price'][$productData['regperiod']] > 0)
                                      $optStr .= " at <span class='rupee'>". Config::get('Constant.sys_currency_symbol') ."</span>".$option['pricing']['price'][$productData['regperiod']];
                                    elseif($option['name'] != "None")   
                                      $optStr .= "FREE";
                                      if ($option['name']." ".$optStr == 'CWP FREE') {
                                        $optStr .= " For 10 Domains";
                                      }elseif( $option['id'] == 657 || $option['id'] == 610 || $option['id'] == 632 ){
                                        $optStr .= " For 10 Domains";
                                      }
                                    
                                  ?>
                                <label for="cpu-option{{$option['id']}}" class="radio_options" title="">
                                    @if(isset($configoptionImgArr[$option['id']]))
                                    <img src="{{Config::get('Constant.CDNURL')}}/assets/images/{{$configoptionImgArr[$option['id']]}}" alt="CPU" />
                                    @endif
                                    <span class="desc">{{$option['name']}}</span>
                                    <span class="extra-text">{!!$optStr!!}</span>
                                </label>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                {{-- <h3 class="c_c_title">Select Additional Software and Services</h3> --}}
                <h3 class="c_c_title">Set Your Hostname</h3>
            </div>
        </div>
        <div class="row serverconfig">
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="c_c_box">
                    @include('cart.customfields')
                </div>
            </div>
        </div>
        <?php

            }
         }
          
         elseif($productData['producttype']=="domain")
         {

              ?>
        <div class="row">
            <div class="col-sm-8">
                <h3 class="c_c_title dm_cc_title">We Have More For You!</h3>
            </div>
        </div>
        @foreach($productData['addonproducts'] as $addonkey => $addon)
        @if(isset($addon['pid']))
        @else
        <script type="text/javascript">
        var type = '<?php echo $addon['
        type ']; ?>';
        var did = '<?php echo $addon['
        did ']; ?>';
        var key = '<?php echo $key; ?>';
        var addonkey = '<?php echo $addonkey; ?>';
        addAddonsDomain(type, did, type, type, type, key, addonkey);
        </script>
        @endif
        @endforeach
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 d-flex">
                <div class="dm_c_c_box_">
                    <div class="dmcc_heading">
                        <p class="dmcc_heading_text">Don’t Miss it!</p>
                    </div>
                    <div class="dm_content_box text-center">
                        <h4 class="dm_cb_heading">Own the Most Reliable <u style="font-size: 22px; color:#18b35c">ZERO</u> Cost Hosting </h4>
                        <p class="dm_cb_text">
                            30-Day Free Trial on the Most Trusted Linux Web Hosting<br>No Compromises!<br><span style="font-size: 20px; font-weight: 600;">Experience Complete Value!</span>
                        </p>
                    </div>
                    <div class="dm_colapse_accordion">
                        <div id="accordion" class="acc_btn">
                            <div class="card border-0">
                                <div class="card-header bg-white text-center" id="headingOne">
                                    <h5 class="mb-0">
                                        <a class="btn-accordion collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">View Features</a></h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body" style="display: flex; justify-content: space-evenly">
                                        <div>
                                            <ul style="list-style-type: disc !important;">
                                                <li>
                                                    <i class="fa fa-check" aria-hidden="true"></i> Unlimited Webspace (SSD)
                                                </li>
                                                <li>
                                                    <i class="fa fa-check" aria-hidden="true"></i> Unlimited Bandwidth
                                                </li>
                                                <li>
                                                    <i class="fa fa-check" aria-hidden="true"></i> FREE SSL Certificate
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <ul>
                                                <li>
                                                    <i class="fa fa-check" aria-hidden="true"></i> 1 Subdomain
                                                </li>
                                                <li>
                                                    <i class="fa fa-check" aria-hidden="true"></i> 2 MYSQL Space
                                                </li>
                                                <li>
                                                    <i class="fa fa-check" aria-hidden="true"></i> Unlimited E-Mail IDs
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dm_btn_box">
                        <a>
                            <button class="dm_btn_fh" id="add_free_hosting">Add My Free Hosting</button></a>
                        <button style="display: none;" class="dm_btn_fh" id="remove_free_hosting">Remove Free Hosting</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="c_c_box" id="sidemenu">
                    <h4 class="c_c_title c_c_blue-title c_c_vps_title">Domain Summary</h4>
                    <div class="c_c_plan_features">
                        <ul class="base_config" id="vps_configuration_html">
                            <li>
                                <div class="plan_name_price">
                                    <span>
                                        <strong>
                                            <?php 
                                $regp = $productData['regperiod'];
                                $type = $productData['domaintype'];
                                ?>
                                            <span class="rupee"> {!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['pricing'][$regp-1]->$type}}
                                        </strong>
                                    </span>
                                    <strong>{{$productData['domain']}}</strong>
                                </div>
                            </li>
                        </ul>
                        @php
                        $proKey = $_REQUEST['id'];
                        @endphp
                        <form id="cart_form_{{$proKey}}" action="#" method="post">
                            <input type="hidden" id="ele_key" name="ele_key" value="{{$proKey}}">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                            <select id="sel_domainregister_{{$proKey}}" name="sel_domainregister_{{$proKey}}" class="newconfig_domain_dropdown" onchange="updateDomainConfigurationNew({{$proKey}});">
                                @foreach($productData['pricing'] as $price)
                                @if($price->register > 0)
                                @if($productData['domaintype'] == 'transfer')
                                @if($price->duration == 1)
                                <option value="{{$price->duration}}" @if($price->duration == $productData['regperiod']) selected @endif >{{$price->duration}} @if($price->duration > 1) years @else year @endif</option>
                                @endif
                                @else
                                <option value="{{$price->duration}}" @if($price->duration == $productData['regperiod']) selected @endif >{{$price->duration}} @if($price->duration > 1) years @else year @endif</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </form>
                        @php
                        $Reg_time = $productData['regperiod'];
                        $renew_date = date('F Y', strtotime(' + '.$Reg_time.' years'));
                        @endphp
                        <div class="renew_price" id="renew_price">Renews at
                            <span class="rupee"> {!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['pricing'][$regp-1]->renwal}} on {{$renew_date}}
                        </div>
                        <hr>
                        <input type="hidden" name="month" id="month" value="36">
                        <div class="cc_sub" id="cc_sub">
                            <div id="configration_html">
                                <div class="stotal" id="502">
                                    <span id="control-panel"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span> 0</span>
                                    <span>Linux Hosting - Starter</span>
                                </div>
                            </div>
                            <hr id="configration_html_hr" style="">
                            <script>
                            $('#cc_sub').hide();
                            </script>
                        </div>
                    </div>
                    <div class="low-price-main">
                        <div class="c_c_title" id="g_total">Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['pricing'][$regp-1]->$type}}</span><span class="fw-4 fs-11 d-block">(18% GST will be applicable*)</span></div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="javascript:void(0);" id="free_hosting_checkout" onclick="freehosting();" class="btn btn-success sm_btn_w_fh" title="Continue to Checkout">Continue <span style="color: #115baa;font-size: 16px;font-weight: bold;">With FREE</span> Hosting</a>
                    <a href="javascript:void(0);" id="without_free_hosting_checkout" onclick="performCheckout();" class="btn btn-success sm_btn_wo_fh" id="" title="Continue to Checkout">Continue Without Free Hosting</a>
                </div>
            </div>
        </div>
        <?php } 

              /*if($productData['producttype'] != "domain"){
              ?>
        <div class="row">
            <div class="col-sm-12">
                <br />
                <h3 class="c_c_title">Your Suggested Product(s)</h3>
            </div>
        </div>
        <div class="row">
            //echo "
            <pre>"; print_r($INRMinPrice); exit; 
         

             @foreach($suggestPro as $key=>$value)
             <?php 
              if(!isset($productData['groupname'])){ $productData['groupname'] = 'domain';  }

                 if(isset($value['title']) && $value['title'] != $productData['groupname'])
                  {
                    ?>
              <div class="col-sm-12 col-md-12 col-lg-4 d-flex">
               <div class="c_c_box">
                  <h4 class="c_c_title c_c_blue-title">{{$value['title']}}</h4>
                  <div class="c_c_box_text">{{$value['TagLine']}}</div>
                  <div class="c_c_box_text blue_text">{{$value['ShortDescription']}}</div>
                   <div class="c_c_plan_features">
                     <div class="c_c_title">Plans & Features:</div>
                     <ul>
                       
                     </ul>
                  </div>             
                  <dl id="suggested_product" class="dropdown">
                       <dt><a href="javascript:void(0)"><span>No Thanks</span></a></dt>
                       <dd>
                           <ul>
                               <li><a href="javascript:void(0)">No Thanks</a></li>
                                
                                 @foreach($value['whmcsProductId'] as $key => $plans)
                                  @if(isset($INRMinPrice[$key]))
                                   <li>
                                    <a href="javascript:void(0)" onclick="return addSuggestedProduct('{{$value['producttype']}}','{{$key}}','{{$INRMinPrice[$key]['billingcycle']}}','India')">
                                    @foreach($INRMinPrice as $keys=>$prices)
                                        @if($key==$keys)
                                        <span class="title">{{$plans}}</span>
                                        <span class="price">
                                          <span class="linethrough-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['oldPrice']; ?>/mo</span>
                                          <span class="final-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><?php echo $prices['newPrice']; ?>/mo</span>
                                        </span>

                                       @foreach($value['specifications'] as $keyss=>$specifications)
                                       <?php 
                                        $arr = nl2br($specifications);
                                        $arr = explode('<br />', $arr);
                                        $spec=$arr;
                                      ?>
                                        @if($key==$keyss)
                                        <div class="features">  
                                          @foreach($spec as $skey=>$svalue)
                                            <span>{{$svalue}}</span>
                                          @endforeach
                                         </div> 
                                        @endif
                                     @endforeach 

                                      @endif
                                   @endforeach
                                  </a>
                                 </li> 
                                 @endif
                                 @endforeach 

                              
                            </ul>
                       </dd>
                   </dl>
               </div>
            </div>
            <?php } ?>
              @endforeach  
            <?php } */?>


         </div>
        </div>

        <div class="secure-payment-info">
          <div class="container">
             <div class="row">
                <div class="col-sm-5 col-xs-12">
                   <div class="s_p_box d-flex">
                      <i class="s_p_icon"></i>
                      <div class="s_p_content">
                         <span class="title">SSL Secure Payment</span>
                         <span class="desc">Your encryption is protected by 256-bit SSL encryption</span>
                      </div>
                   </div>
                   <div class="payment-method-cart"></div>
                </div>
                <div class="col-sm-7 col-xs-12">
                   <div class="continue-checkout-portion">
                      <div class="c_c_p_top">
                         <div class="c_c_p_links">
                            <a title="View offer disclaimers" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#disclaimer-popup">View offer disclaimers</a>
                            <a href="javascript:void(0);" onclick="emptycart();" title="Empty Cart">Empty Cart</a>
                         </div>
                         @if($productData['producttype']=='hosting' || $productData['producttype']=='vps' || $productData['producttype']=='dedicatedserver' || $productData['producttype']=='email' || $productData['producttype']=='ssl')

                            {{-- vikram vps plans changes S 10/3/2022 --}}
                            @if ($productData['producttype']=='dedicatedserver' || $productData['producttype']=='vps') 
                              <div class="c_c_p_total" id="finalPrices">
                                Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['finalprice']}}</span>
                              </div>
                            @else
                              <div class="c_c_p_total" id="finalPrices">
                                Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$productData['finalprice']}}</span>
                              </div>
                            @endif
                            {{-- vikram vps plans changes E 10/3/2022 --}}

                        @elseif($productData['producttype']=='domain')
                        <?php 
                        $duration=$productData['regperiod'];
                        $domainType=$productData['domaintype'];
                        foreach($productData['pricing'] as $key=>$val)
                        {   
                           if($val->duration==$duration)
                           {
                               ?>
                               <div class="c_c_p_total" id="finalPrices">
                                Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$val->register}} </span>
                                </div>
                        <?php
                           }
                         }
                        ?>
                        @endif
                        @if($productData['producttype']=='domain')
                          
                        @else
                         <div class="c_c_p_btn">
                            <a href="javascript:void(0);" onclick="performCheckout();" class="btn primary-btn" title="Continue to Checkout">CONTINUE TO CHECKOUT</a>
                         </div>
                        @endif
                      </div>
                      <div class="c_c_p_terms">
                        <label for="check_terms">
                        <input type="checkbox" class="filled-in" tabindex="3" name="check_terms" id="check_terms" <?php echo (Session::has('check_term') && Session::get('check_term') == 'true' ) ? "checked" : ""; ?> >
                        <span class="checkmark-check"></span>

                         By checking this checkbox, you agree to our <a href="{{url('/terms')}}" target="_blank" title="Terms & Conditions">Terms & Conditions</a> and <a target="_blank" href="{{url('/privacy-policy')}}" title="Privacy Policy"> privacy policy.</a>
                       </label>
                         <p> <label class="check_terms_error pull-left" id="check_terms_error" style="display: none;"></label> </p>
                      </div>
                   </div>
                </div>
             </div>
          </div>
        </div>

   @include('cart.cart-about-support')

 
@if(isset($_REQUEST['hostname']) && $_REQUEST['hostname']=='1')
<script>
   $('html, body').animate({
        scrollTop: $(".serverconfig").offset().top-300
    }, '2000');
</script>
@endif
<!-- affix function start -->
<script src="{{url('/')}}/assets/js/affix.js"></script>
  
<script>
  $(document).ready(function(){
      $('#sidemenu').affix({
              offset:{
              top: 450,
              bottom: 1318
          }
      });
  });
</script>
  <!-- affix function end -->
 <script type="text/javascript">
        
          var productsid=[];   
         
          function addSuggestedProduct(producttype,packageId,billingcycle,Location,domain){
           
      var formData = {"_token":"{{ csrf_token() }}","producttype[]":producttype,"pid[]":packageId,"billingcycle[]":billingcycle,"location[]":Location,"domain[]":domain}
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/store')}}",
            data:formData,
            type:"post",
            success:function(response){
                $("#hiddenProductId").append("<input type='hidden' value="+packageId+" class='packageIdDomain'>");
                 hideLoader();
            }
        });
    }


    if($("#cpu-option802").is(':checked')){$("#cpu-option804").parent().show();$("#cpu-option850").parent().show();$("#cpu-option851").parent().show();}
    else{$("#cpu-option804").parent().show();$("#cpu-option850").parent().hide();$("#cpu-option851").parent().hide();}

    $("input[name='customfields_193']").click(function(){
      if($("#cpu-option805").is(':checked')){}else{
      $("#cpu-option805").click();}});


    if($("#cpu-option603").is(':checked') || $("#cpu-option604").is(':checked') || $("#cpu-option605").is(':checked')){
        $("#cpu-option614").parent().hide(); $("#cpu-option615").parent().hide(); $("#cpu-option669").parent().hide();
        $("#cpu-option792").parent().hide(); $("#cpu-option793").parent().hide(); $("#cpu-option794").parent().hide();}
       else{
        $("#cpu-option614").parent().show(); $("#cpu-option615").parent().show(); $("#cpu-option669").parent().show();}

        var nonevps=0;
        var ovzUbuntu=0;
        var sqlserver=0;
       
        $( document ).ready(function() {
            
            $(".configele").each(function(i,ele){
                    
                   if($("#"+ $(ele).attr("id")).is(':checked'))
                    {
                        $("#"+ $(ele).attr("id")).click();          
                    }
            });
        
        });

function defaultSelectOptionValue(fieldid) {
  var data = {
  1553: { //opsy selection id //VPS SM 1
      1552: { 6547: [6532,6543,8175, 6544, 6545,6533,6534,6535,8208,8209,8210],  //1552 is cp selection id //6547 is OSPy option id
             6548:  [6532],                                  // 6532 is cp option id
             6549: [6532,6543,8175, 6544, 6545,6533,6534,6535,8208,8209,8210],
             6555: [6532,6543,8175, 6544, 6545,6533,6534,6535,8208,8209,8210],
             6550: [6532,6533,6534,6535,8208,8209,8210],
             6556: [6532,6533,6534,6535,8208,8209,8210],
             6546: [6532,6545,6543,8175, 6544,8208,8209,8210],
             8107: [6532,6545,6543,8175, 6544,8059,6531,8060,6538,6539,8208,8209,8210],

              },
        },

    1566: {  //VPS SM 2
      1565: { 6622: [6607,6618,8176, 6619, 6620,6608,6609,6610,8211,8212,8213], 
             6623:  [6607],
             6624: [6607,6618,8176, 6619, 6620,6608,6609,6610,8211,8212,8213],
             6630: [6607,6618,8176, 6619, 6620,6608,6609,6610,8211,8212,8213],
             6629: [6607,6608,6609,6610,8211,8212,8213],
             6631: [6607,6608,6609,6610,8211,8212,8213],
             6621: [6607,6618,8176, 6619, 6620,8211,8212,8213],
             8122: [6607,6618,8176, 6619, 6620,8061,6606,8062,6613,6614,8211,8212,8213],
              },
        },

       1527: {  //VPS SM 3
      1526: { 6396: [6381,6392,8177,6393, 6394,6382,6383,6384,8214,8215,8216], 
             6397:  [6381],
             6398: [6381,6392,8177,6393, 6394,6382,6383,6384,8214,8215,8216],
             6404: [6381,6392,8177,6393, 6394,6382,6383,6384,8214,8215,8216],
             6399: [6381,6382,6383,6384,8214,8215,8216],
             6405: [6381,6382,6383,6384,8214,8215,8216],
             6395: [6381,6392,8177,6393, 6394,8214,8215,8216],
             8121: [6381,6392,8177,6393, 6394,8063,6380,8064,6387,6388,8214,8215,8216],

              },
        },

        1540: {  //VPS SM 4
            1539: { 6472: [6457,6468,8178, 6469, 6470,6458,6459,6460,8217,8218,8219], 
                    6473: [6457],
                    6474: [6457,6468,8178, 6469, 6470,6458,6459,6460,8217,8218,8219],
                    6480: [6457,6468,8178, 6469, 6470,6458,6459,6460,8217,8218,8219],
                    6479: [6457],
                    6475: [6457,6458,6459,6460,8217,8218,8219],
                    6481: [6457,6458,6459,6460,8217,8218,8219],
                    6471: [6457,6468,8178, 6469, 6470,8217,8218,8219],
                    8120: [6457,6468,8178, 6469, 6470,8065,6456,8066,6463,6464,8217,8218,8219],

                },
            },

      1579: {  //VPS SM 5
            1578: { 6696: [6681,6692,8179,6693, 6694,6682,6683,6684,8220,8221,8222], 
                    6697: [6681],
                    6698: [6681,6692,8179,6693, 6694,6682,6683,6684,8220,8221,8222],
                    6703: [6681,6692,8179,6693, 6694,6682,6683,6684,8220,8221,8222],
                    6704: [6681,6682,6683,6684,8220,8221,8222],
                    6705: [6681,6682,6683,6684,8220,8221,8222],
                    6695: [6681,6692,8179,6693, 6694,8220,8221,8222],
                    8119: [6681,6692,8179,6693, 6694,8067,6680,8068,6687,6688,8220,8221,8222],

                },
            },

       1592: {  //VPS SM 6
            1591: { 6771: [6756,6767,8180,6768, 6769,6757,6758,6759,8223,8224,8225], 
                    6772: [6756],
                    6773: [6756,6767,8180,6768, 6769,6757,6758,6759,8223,8224,8225],
                    6774: [6756,6767,8180,6768, 6769,6757,6758,6759,8223,8224,8225],
                    6779: [6756,6757,6758,6759,8223,8224,8225],
                    6780: [6756,6757,6758,6759,8223,8224,8225],
                    6770: [6756,6767,8180,6768, 6769,8223,8224,8225],
                    8118: [6756,6767,8180,6768, 6769,8069,6755,8070,6762,6763,8223,8224,8225],
                },
            },

         1605: {  //VPS SM 7
            1604: { 6846: [6831,6842,8181,6843, 6844,6832,6833,6834,8226,8227,8228], 
                    6847: [6831],
                    6848: [6831,6842,8181,6843, 6844,6832,6833,6834,8226,8227,8228],
                    6849: [6831,6842,8181,6843, 6844,6832,6833,6834,8226,8227,8228],
                    6854: [6831,6832,6833,6834,8226,8227,8228],
                    6855: [6831,6832,6833,6834,8226,8227,8228],
                    6845: [6831,6842,8181,6843, 6844,8226,8227,8228],
                    8117: [6831,6842,8181,6843, 6844,8071,6830,8072,6837,6838,8226,8227,8228],
                },
            },

       1618: {  //VPS SM 8
            1617: { 6922: [6907,6918,8182, 6919, 6920,6908,6909,6910,8229,8230,8231], 
                    6923: [6907],
                    6924: [6907,6918,8182, 6919, 6920,6908,6909,6910,8229,8230,8231],
                    6925: [6907,6918,8182, 6919, 6920,6908,6909,6910,8229,8230,8231],
                    6930: [6907,6908,6909,6910,8229,8230,8231],
                    6931: [6907,6908,6909,6910,8229,8230,8231],
                    6921: [6907,6918,8182, 6919, 6920,8229,8230,8231],
                    8116: [6907,6918,8182, 6919, 6920,8073,6906,8074,6913,6914,8229,8230,8231],
                },
            },

       1631: {  // VPS - M 1
            1630: { 6996: [6992,8168,6993, 6994,6982,6983,6984,8184,8185,8186], 
                    6998: [6992,8168,6993, 6994,6982,6983,6984,8184,8185,8186],
                    7004: [6992,8168,6993, 6994,6982,6983,6984,8184,8185,8186],
                    6999: [6982,6983,6984,8184,8185,8186],
                    7005: [6982,6983,6984,8184,8185,8186],
                    6995: [6992,8168,6993, 6994,8184,8185,8186],
                    8109: [6992,8168,6993, 6994,8075,6980,8076,6987,6988,8184,8185,8186],

                },
            }, 

       1644: {  // VPS - M 2
            1643: { 7071: [7067,8169,7068, 7069,7057,7058,7059,8187,8188,8189], 
                    7073: [7067,8169,7068, 7069,7057,7058,7059,8187,8188,8189],
                    7079: [7067,8169,7068, 7069,7057,7058,7059,8187,8188,8189],
                    7078: [7057,7058,7059,8187,8188,8189],
                    7080: [7057,7058,7059,8187,8188,8189],
                    7070: [7067,8169,7068, 7069,8187,8188,8189],
                    8108: [7067,8169,7068, 7069,8077,7055,8078,7062,7063,8187,8188,8189],

                },
            }, 

       1657: {  // VPS - M 3
            1656: { 7146: [7142,8183,7143, 7144,7132,7133,7134,8190,8191,8192], 
                    7148: [7142,8183,7143, 7144,7132,7133,7134,8190,8191,8192],
                    7154: [7142,8183,7143, 7144,7132,7133,7134,8190,8191,8192],
                    7149: [7132,7133,7134,8190,8191,8192],
                    7155: [7132,7133,7134,8190,8191,8192], 
                    7145: [7142,8183,7143, 7144,8190,8191,8192],                  
                    8110: [7142,8183,7143, 7144,8079,7130,8080,7137,7138,8190,8191,8192],                  

                },
            }, 

       1670: {  // VPS - M 4
            1669: { 7222: [7218,8170,7219, 7220,7208,7209,7210,8193,8194,8195], 
                    7224: [7218,8170,7219, 7220,7208,7209,7210,8193,8194,8195],
                    7230: [7218,8170,7219, 7220,7208,7209,7210,8193,8194,8195],
                    7225: [7208,7209,7210,8193,8194,8195],
                    7231: [7208,7209,7210,8193,8194,8195],  
                    7221: [7218,8170,7219, 7220,8193,8194,8195],                  
                    8111: [7218,8170,7219, 7220,8081,7206,8082,7213,7214,8193,8194,8195],                  

                },
            },

         1683: {  // VPS - M 5
            1682: { 7296: [7292,8171,7293, 7294,7282,7283,7284,8196,8197,8198], 
                    7298: [7292,8171,7293, 7294,7282,7283,7284,8196,8197,8198],
                    7303: [7292,8171,7293, 7294,7282,7283,7284,8196,8197,8198],
                    7304: [7282,7283,7284,8196,8197,8198],
                    7305: [7282,7283,7284,8196,8197,8198], 
                    7295: [7292,8171,7293, 7294,8196,8197,8198],                  
                    8112: [7292,8171,7293, 7294,8083,7280,8084,7287,7288,8196,8197,8198],                  

                },
            }, 

        1696: {  // VPS - M 6
            1695: { 7371: [7367,8172, 7368, 7369,7357,7358,7359,8199,8200,8201], 
                    7373: [7367,8172, 7368, 7369,7357,7358,7359,8199,8200,8201],
                    7374: [7367,8172, 7368, 7369,7357,7358,7359,8199,8200,8201],
                    7379: [7357,7358,7359,8199,8200,8201],
                    7380: [7357,7358,7359,8199,8200,8201], 
                    7370: [7367,8172, 7368, 7369,8199,8200,8201],                  
                    8113: [7367,8172, 7368, 7369,8085,7355,8086,7362,7363,8199,8200,8201],                  

                },
            }, 

       1709: {  // VPS - M 7
            1708: { 7446: [7442,8173,7443, 7444,7432,7433,7434,8202,8203,8204], 
                    7448: [7442,8173,7443, 7444,7432,7433,7434,8202,8203,8204],
                    7449: [7442,8173,7443, 7444,7432,7433,7434,8202,8203,8204],
                    7454: [7432,7433,7434,8202,8203,8204],
                    7455: [7432,7433,7434,8202,8203,8204],    
                    7445: [7442,8173,7443, 7444,8202,8203,8204],                  
                    8114: [7442,8173,7443, 7444,8087,7430,8088,7437,7438,8202,8203,8204],                  

                },
            }, 
        1722: {  // VPS - M 8
            1721: { 7522: [7518,8174,7519, 7520,7508,7509,7510,8205,8206,8207], 
                    7524: [7518,8174,7519, 7520,7508,7509,7510,8205,8206,8207],
                    7525: [7518,8174,7519, 7520,7508,7509,7510,8205,8206,8207],
                    7530: [7508,7509,7510,8205,8206,8207],
                    7531: [7508,7509,7510,8205,8206,8207],
                    7521: [7518,8174,7519, 7520,8205,8206,8207],                  
                    8115: [7518,8174,7519, 7520,8089,7506,8090,7513,7514,8205,8206,8207],                  

                },
            }, 

        1893: { //VPS SM 1 2025
      1892: { 8458: [8437,8438,8439,8440, 8448, 8453,8449,8450],  
             8457:  [8437,8448, 8453,8449,8450],                                  
             8469: [8437,8438,8439,8440, 8448, 8453,8449,8450,8451,8436,8452,8443,8444],
             8471: [8437,8451,8436,8452,8443,8444, 8448, 8453,8449,8450],
             8460: [8437,8438,8439,8440, 8448, 8453,8449,8450],
             8464: [8437,8438,8439,8440, 8448, 8453,8449,8450,8451,8436,8452,8443,8444],
             8466: [8437,8438,8439,8440, 8448, 8453,8449,8450],
             8461: [8437,8438,8439,8440],
             8467: [8437,8438,8439,8440],

              },
        },

    1907: { //VPS SM 2 2025
      1906: { 8542:[8521,8524,8523,8522, 8534, 8533,8537,8532],  
             8541: [8521,8534, 8533,8537,8532],                                  
             8544: [8521,8524,8523,8522, 8534, 8533,8537,8532],
             8548: [8521,8524,8523,8522, 8534, 8533,8537,8532,8535,8520,8536,8527,8528],
             8550: [8521,8524,8523,8522, 8534, 8533,8537,8532],
             8545: [8521,8524,8523,8522],
             8551: [8521,8524,8523,8522],
             8553: [8521,8524,8523,8522, 8534, 8533,8537,8532,8535,8520,8536,8527,8528],
             8555: [8521,8534, 8533,8537,8532,8535,8520,8536,8527,8528],

              },
        },

    1921: { //VPS SM 3 2025
      1920: { 8630:[8609,8620,8625,8621,8622,8610,8611,8612],  
             8629: [8609,8620,8625,8621,8622,],                                  
             8641: [8609,8620,8625,8621,8622,8610,8611,8612,8623,8608,8624,8615,8616],
             8643: [8609,8620,8625,8621,8622,8623,8608,8624,8615,8616],
             8632: [8609,8620,8625,8621,8622,8610,8611,8612],
             8636: [8609,8620,8625,8621,8622,8610,8611,8612,8623,8608,8624,8615,8616],
             8633: [8609,8620,8625,8621,8622,8610,8611,8612],
             8638: [8609,8610,8611,8612],
             8639: [8609,8610,8611,8612],

              },
        },

    1935: { //VPS SM 4 2025
      1934: { 8715:[8694,8695,8696,8697,8705,8710,8706,8707],  
             8714: [8694,8705,8710,8706,8707],                                  
             8726: [8694,8695,8696,8697,8705,8710,8706,8707,8708,8693,8709,8700,8701],
             8728: [8694,8705,8710,8706,8707,8708,8693,8709,8700,8701],
             8717: [8694,8695,8696,8697,8705,8710,8706,8707],
             8721: [8694,8695,8696,8697,8705,8710,8706,8707,8708,8693,8709,8700,8701],
             8718: [8694,8695,8696,8697,8705,8710,8706,8707],
             8723: [8694,8695,8696,8697],
             8724: [8694,8695,8696,8697],
              },
        },


        2005: { //VPS M1 2025
            2004: { 9148:[9128,9129,9130,9138,9143,9139,9140],  
                 9147: [9138,9143,9139,9140],                                  
                 9159: [9128,9129,9130,9138,9143,9139,9140,9141,9126,9142,9133,9134],
                 9161: [9138,9143,9139,9140,9141,9126,9142,9133,9134],
                 9150: [9128,9129,9130,9138,9143,9139,9140],
                 9154: [9128,9129,9130,9138,9143,9139,9140,9141,9126,9142,9133,9134],
                 9156: [9128,9129,9130,9138,9143,9139,9140],
                 9151: [9128,9129,9130],
                 9157: [9128,9129,9130],
                  },
            },

        2019: { //VPS M2 2025
            2018: { 9233:[9213,9214,9215,9228,9224,9225,9223],  
                 9232: [9228,9224,9225,9223],                                  
                 9244: [9213,9214,9215,9228,9224,9225,9223,9226,9211,9227,9218,9219],
                 9246: [9228,9224,9225,9223,9226,9211,9227,9218,9219],
                 9235: [9213,9214,9215,9228,9224,9225,9223],
                 9239: [9213,9214,9215,9228,9224,9225,9223,9226,9211,9227,9218,9219],
                 9241: [9213,9214,9215,9228,9224,9225,9223],
                 9242: [9213,9214,9215],
                 9236: [9213,9214,9215],
                  },
            },

        2033: { //VPS M3 2025
            2032: { 9318:[9298,9299,9300,9308,9313,9309,9310],  
                 9317: [9308,9313,9309,9310],                                  
                 9329: [9298,9299,9300,9308,9313,9309,9310,9311,9296,9312,9303,9304],
                 9331: [9308,9313,9309,9310,9311,9296,9312,9303,9304],
                 9320: [9298,9299,9300,9308,9313,9309,9310],
                 9324: [9298,9299,9300,9308,9313,9309,9310,9311,9296,9312,9303,9304],
                 9321: [9298,9299,9300,9308,9313,9309,9310],
                 9326: [9298,9299,9300],
                 9327: [9298,9299,9300],
                  },
            },

        2047: { //VPS M4 2025
            2046: { 9405:[9385,9386,9387,9395,9400,9396,9397],  
                 9404: [9395,9400,9396,9397],                                  
                 9416: [9385,9386,9387,9395,9400,9396,9397,9398,9383,9399,9390,9391],
                 9418: [9395,9400,9396,9397,9398,9383,9399,9390,9391],
                 9407: [9385,9386,9387,9395,9400,9396,9397],
                 9411: [9385,9386,9387,9395,9400,9396,9397,9398,9383,9399,9390,9391],
                 9408: [9385,9386,9387,9395,9400,9396,9397],
                 9413: [9385,9386,9387],
                 9414: [9385,9386,9387],
                  },
            },




        1188: {  // DS2
            1192: { 4860: [4881,6209,6210,6211,4884,4885,4886],
                },
            }, 
       };
  return Object.keys(data[fieldid] || {}).length > 0 ? data[fieldid] : null;
}

function setServersVPSConfiguration(fieldid) {
  $(document).ready(function () {
    $('#customfields_' + fieldid).change(function () {
      var cpOptions = defaultSelectOptionValue(fieldid);
      var cp_id = cpOptions ? Object.keys(cpOptions)[0] : null;
      var opsy_key = $(this).val();
      var cpSelect = $('#customfields_' + cp_id);
      var cpSelect1 = 'customfields_' + cp_id;
      if (cpOptions && cp_id in cpOptions && opsy_key in cpOptions[cp_id]) {
        showCPValues(cpSelect, cpOptions[cp_id][opsy_key]);
      } else {
        showAllCPValues(cpSelect1);
      }
    });
  });

  $(document).ready(function () {
    $('select[id^="customfields_"]').each(function () {
      var fieldid = this.id.split('_')[1];
      var cpOptions = defaultSelectOptionValue(fieldid);
      var cp_id = cpOptions ? Object.keys(cpOptions)[0] : null;
      var opsy_key = $(this).val();
      var cpSelect = $('#customfields_' + cp_id);
      var cpSelect1 = 'customfields_' + cp_id;
      if (cpOptions && cp_id in cpOptions && opsy_key in cpOptions[cp_id]) {
        showCPValues(cpSelect, cpOptions[cp_id][opsy_key]);
      } else {
        showAllCPValues(cpSelect1);
      }
    });
  });
}

function showCPValues(cpSelect, cpValues) {
  cpSelect.find('option').each(function () {
    var cpOptionValue = parseInt($(this).val());
    $(this).toggle(cpValues.includes(cpOptionValue));
  });
}

function showAllCPValues(id) {
  $('#' + id + ' option').show();
}


        function setConfigurationFieldValue(proid,fieldid,val){
            setServersVPSConfiguration(fieldid);

        var harddisk=0;
        var ramconfig=0;
        
       //Dedicated Servers
       //Starter Plans
       if($("#cpu-option603").is(':checked') || $("#cpu-option604").is(':checked') || $("#cpu-option605").is(':checked')){
        $("#cpu-option614").parent().hide(); $("#cpu-option615").parent().hide(); $("#cpu-option669").parent().hide();}
       else{
        $("#cpu-option614").parent().show(); $("#cpu-option615").parent().show(); $("#cpu-option669").parent().show();}

        if($("#cpu-option611").is(':checked') || $("#cpu-option612").is(':checked') || $("#cpu-option613").is(':checked') || $("#cpu-option783").is(':checked') || $("#cpu-option784").is(':checked') || $("#cpu-option785").is(':checked')){
          $("#cpu-option610").parent().hide(); $("#cpu-option608").parent().hide();
          $("#cpu-option792").parent().show(); $("#cpu-option793").parent().show(); $("#cpu-option794").parent().show();}
      else{$("#cpu-option610").parent().show(); $("#cpu-option608").parent().show();
          $("#cpu-option792").parent().hide(); $("#cpu-option793").parent().hide(); $("#cpu-option794").parent().hide();}
      
      //Starter Plans Over 
      //Dedicated Server Over

      //VPS OpenVZ
      //584 = Ubuntu Operating System 
      if($("#cpu-option584").is(':checked')){ 
        $("#cpu-option579").parent().hide(); //Control Panel->CWP
        $("#cpu-option580").parent().hide(); //Control Panel->Cpanel
        //if(ovzUbuntu=="cpn"){ovzUbuntu=0;}else{ovzUbuntu="cpn";}
      }else{
        $("#cpu-option579").parent().show(); //Control Panel->CWP
        $("#cpu-option580").parent().show(); //Control Panel->Cpanel
        ovzUbuntu=0;}

      //VPS OpenVZ

      //VPS KVM Start
       //595 = Ubuntu Operating System 
      if($("#cpu-option595").is(':checked') || $("#cpu-option802").is(':checked')){ 
        $("#cpu-option592").parent().hide(); //Control Panel->CWP
        $("#cpu-option593").parent().hide(); //Control Panel->Cpanel
        //if(nonevps=="cpn"){nonevps=0;}else{nonevps="cpn";}
      }else{
        $("#cpu-option592").parent().show(); //Control Panel->CWP
        $("#cpu-option593").parent().show(); //Control Panel->Cpanel
        nonevps=0;}

       //802 = Windows Operating System
      
      //if($("#cpu-option802").is(':checked') || $("#cpu-option1018").is(':checked')){
      if($("#cpu-option1020").is(':checked')){
          
        /*$('#cpu-option590').prop('checked', true);*/
      
        $("#cpu-option589").parent().hide(); //20 GB Harddisk space Free
        //$("#cpu-option587").parent().hide(); //2 GB Ram Free
        $("#cpu-option804").parent().show(); //SQL Server 17
        $("#cpu-option850").parent().show(); // SQL Server 12
        $("#cpu-option851").parent().show(); // SQL Server 14
        if($("#cpu-option589").is(':checked')){/*$("#cpu-option590").attr('checked', 'checked');*/ $('#cpu-option590').prop('checked', true);
          harddisk++;}
        //if($("#cpu-option587").is(':checked')){$("#cpu-option588").attr('checked','checked');
          //ramconfig++;}
        }else{$("#cpu-option589").parent().show(); //20 GB Harddisk space Free
        $("#cpu-option587").parent().show(); //2 GB Ram Free
        $("#cpu-option850").parent().hide(); //SQL Server 12
        $("#cpu-option851").parent().hide(); // SQL Server 14
        $("#cpu-option804").parent().hide(); // SQL Web Edition 17
      }
      //VPS KVM end
      
      // VPS OpenVZ when Debian,Ubuntu r selected at that Control Panel show only none.
      if( $("#cpu-option583").is(':checked') || $("#cpu-option584").is(':checked') ){
        $('#cpu-option578').prop('checked', true);
        $("#cpu-option997").parent().hide();$("#cpu-option998").parent().hide();$("#cpu-option999").parent().hide();$("#cpu-option1000").parent().hide();$("#cpu-option579").parent().hide();
      }else{
        $('#cpu-option578').prop('checked', true);
        $("#cpu-option997").parent().show();$("#cpu-option998").parent().show();$("#cpu-option999").parent().show();$("#cpu-option1000").parent().show();$("#cpu-option579").parent().show();
      }
      
      if ( $("#cpu-option1020").is(':checked') || $("#cpu-option1619").is(':checked') ){
        $('#configfield_192').prop('checked', true);
        $('#cpu-option993').parent().show(); /*plesk*/ $('#cpu-option994').parent().show(); /*plesk*/ $('#cpu-option995').parent().show(); /*plesk*/

        $('#cpu-option1001').parent().hide(); /*cwp*/ $('#cpu-option1611').parent().hide(); /*cyber*/ $('#cpu-option592').parent().hide();  /*cwp*/
      }else if( $('#cpu-option802').is(':checked') || $('#cpu-option1018').is(':checked') || $('#cpu-option1681').is(':checked') || $('#cpu-option1019').is(':checked') ){
        $('#configfield_192').prop('checked', true);
        $('#cpu-option993').parent().hide(); /*plesk*/ $('#cpu-option994').parent().hide(); /*plesk*/ $('#cpu-option995').parent().hide(); /*plesk*/

        $('#cpu-option1001').parent().hide(); /*cwp*/ $('#cpu-option1611').parent().hide(); /*cyber*/ $('#cpu-option592').parent().hide();  /*cwp*/
      }else{
        $('#configfield_192').prop('checked', true);
        $('#cpu-option993').parent().show(); /*plesk*/ $('#cpu-option994').parent().show(); /*plesk*/ $('#cpu-option995').parent().show(); /*plesk*/

        $('#cpu-option1001').parent().show(); /*cwp*/ $('#cpu-option1611').parent().show(); /*cyber*/ $('#cpu-option592').parent().show();  /*cwp*/
      }
      
      
      if(val && val != ""){

      var formData = {"_token":"{{ csrf_token() }}","productid":proid,"fieldid":fieldid,"optionid":val }
      
      $.ajax({
            async:false,
            beforeSend: function () { /*showLoader();*/ },
            url:"{{url('cart/setconfigoptionvalue')}}",
            data:formData,
            type:"post",
            dataType: "json",
            success:function(response){
              /*console.log("hello");*/
              var baseConfigration=''; var checkConfigaval=false;
              $.each(response.divHtml, function (i,v){
                baseConfigration+='<div class="stotal" id="'+i+'">';
                $.each(v, function (key, val){
                  if (val!=''){ checkConfigaval=true;
                    baseConfigration+=val;
                  }
                });
                baseConfigration+='</div>';
              });
              if(!checkConfigaval){ baseConfigration=''; }
              var product_type = '{{$productData['producttype']}}';
              // console.log(product_type);

              // vikram vps plans changes S 10/3/2022
              var finalprice = response.finalprice;
              if(product_type=='dedicatedserver' || product_type=='vps'){
                /* if dedicatedserver */
                $('#configration_html').html(baseConfigration);
                // console.log("Hello:"+baseConfigration);
                if(baseConfigration==''){ 
                  $('#cc_sub').hide(); $('#configration_html_hr').hide(); 
                }else{
                  $('#cc_sub').show(); $('#configration_html_hr').show();
                }

                // ------------------------------

                configPagePriceSync(finalprice);

              }else{
                var confightml = response.confightml;

                // ------------------------------

                $("#vps_configuration_html").html(confightml);
                $("#finalPrice").html('<div class="c_c_title">Total:<span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + finalprice + '</span></div>');
                $("#finalPrices").html('Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + finalprice + '</span>');
              }
              // vikram vps plans changes S 10/3/2022

              hideLoader();
            }
        });
      }


      if(harddisk==1){$("#cpu-option590").click();}
      if(ramconfig==1){$("#cpu-option588").click();}
      if(nonevps=='cpn'){$("#cpu-option597").click();}
      if(ovzUbuntu=='cpn'){$("#cpu-option578").click();}
    }

    function configPagePriceSync(finalprice) {

      // $("#Subtotal").html('<span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>'+finalprice);
      var Gtotal = parseInt(finalprice);
      $("#g_total").html('Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>'+Gtotal+'</span><span class="fw-4 fs-11 d-block">(18% GST will be applicable*)</span>');
      $("#finalPrices").html('Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + Gtotal + '</span>');
    }

     function setCustomFieldValue(proid,fieldid,val){
      //alert(proid  + " " + fieldid + " " + val); 
      var formData = {"_token":"{{ csrf_token() }}","productid":proid,"fieldid":fieldid,"val":val }
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/setcustomoptionvalue')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
                 if(response == '1'){ $("isproductvalid").val('Y'); }
            }
        });
    }


          $("#next_btn_3").click(function(){
            showLoader();
            if($("#customfield_hostname"))
            { setCustomFieldValue('{{$_REQUEST['id']}}','customfield_hostname',$("#customfield_hostname").val()); }
            showLoader();
            
            if(!$('#customfields_{{$key}}').valid()){ return false; }
            $("#step_3").removeClass('active'); $("#step_4").addClass('active');
            $("#step_3 .toggle_div").hide();
            $("#step_4 .toggle_div").show();
            $(".last-step-checkout").show();
            $("#custom_fields_list").html('');
            $(".customele").each(function(i,ele){
                if(typeof $(ele).attr('type') != 'undefined' && $(ele).attr('type') == 'checkbox' && $(ele).attr('checked'))
                { 
                  var label = $(ele).parent().parent().parent().find('label').text(); 
                  var val =  '';
                }
              else 
                {   
                  var label = $(ele).parent().parent().find('label').text(); 
                  if(label == ''){ label = $(ele).parent().parent().parent().find('label').text(); }
                  var val =  $("#"+ $(ele).attr("id")).val();
                }        
                
                if(typeof val != 'undefined')
                  { $("#custom_fields_list").append("<li><strong>" + label + "</strong>" + val + "</li>").parent().show(); }
              });
              $("#icon_step_3").addClass('fa fa-check-circle').removeClass('number').html('');

      });


      $("#next_btn_2").click(function(){

        alert("{{$_REQUEST['id']}}");

      if(!$('#configfields_{{$key}}').valid()){ return false; }

      $("#step_2 .toggle_div").hide();
      $("#step_3 .toggle_div").show();
      $("#config_fields_list").html('');
      $(".configele").each(function(i,ele){
          var label = $(ele).parent().parent().parent().find('label').text();
          var val =  $("#"+ $(ele).attr("id") + " option:selected").html();
          if(typeof val != 'undefined')
          { $("#config_fields_list").append("<li><strong>" + label + "</strong>" + val + "</li>").parent().show(); }
      });
      $("#icon_step_2").addClass('fa fa-check-circle').removeClass('number').html('');
      $("#step_2").removeClass('active'); $("#step_3").addClass('active');
      $("#customfield_359, #customfield_358, #customfield_353, #customfield_356, #customfield_357").change();
    });

         $(function(){
       $("#config_fields_list").html('');
      $(".configele").each(function(i,ele){
            
          if(typeof val != 'undefined')
          { $("#config_fields_list").append("<li><strong>" + label + " : </strong>" + val + "</li>").parent().show(); }
      });
    });


    $("#ihavedomainbtn").click(function(){
        $("#bookdomaintxt").val('');
        $("#domainavailmsg").html('');
        var dname = $("#ihavedomain").val();

        dname = dname.replace("https://", "");
        dname = dname.replace("http://", "");
        dname = dname.replace("www.", "");
        dname = dname.replaceAll("/", "");
        dname = dname.replaceAll(" ", "");
        dname = dname.replaceAll(",", ".");
        dname = dname.replaceAll(/[\/\s,\u00A0]+/g, '');
        
        if(dname == ''){
          // alert("Please enter your domain name.");
          $(".hiddenProductId").html("Please enter your domain name").css({"color":"red"});;
          return false;
        }
        
        var formData = {"_token":"{{ csrf_token() }}","productid":'{{$_REQUEST['id']}}',"domainname":dname}
        
        $.ajax({
              async:true,
              beforeSend: function () { showLoader(); },
              url:"{{url('cart/configdomain')}}",
              data:formData,
              type:"post",
              success:function(response){
                  $("#step_4 .select_domain_div").hide(); 
                  $("#submitbtn").show();
                  $("#icon_step_4").addClass('fa fa-check-circle').removeClass('number').html('');
                  hideLoader();
                  $("#isproductvalid").val('Y');
              }
          });
    });


         var domaindata = null;
    $("#searchdomainbtn").click(function(){
      $("#searchdomainbtn").val('');
      var dname = $("#bookdomaintxt").val();
      if(dname == ''){
        // alert("Please enter your domain name.");
        $(".serarchdomain").html("Please enter your domain name.").css({"color":"red"});;
        return false;
      }
        var formData = {"_token":"{{ csrf_token() }}","bookdomaintxt":$("#bookdomaintxt").val(),"selTld":$("#selTld").val()}
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/checkconfigdomainname')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
                if(response.status == 'available'){
                  domaindata = response;
                  $("#domainavailmsg").show().find('.checkout-text').html(response.msg).css({"color":"green"});
                  $("#addconfigdomainbtn").show();
                }
                else{
                  domaindata = response;
                  $("#domainavailmsg").show().find('.checkout-text').html(response.msg).css({"color":"red"});;
                  $("#addconfigdomainbtn").hide();
                }
                
            }
        });
    });


$("#addconfigdomainbtn").click(function(){
      var formData = {"_token":"{{ csrf_token() }}","producttype":domaindata.producttype,"domain":domaindata.domain,"tld":domaindata.tld,"domaintype":domaindata.domaintype,"regperiod":domaindata.regperiod}
       showLoader();
      $.ajax({
            url:"{{url('cart/store')}}",
            data:formData,
            type:"post",
            async:false,
            success:function(response){
              hideLoader();
                //$("#step_4 .toggle_div").hide(); 
                var formData = {"_token":"{{ csrf_token() }}","productid":'{{$_REQUEST['id']}}',"domainname":domaindata.domain[0]} 
                $.ajax({
                      url:"{{url('cart/configdomain')}}",
                      data:formData,
                      type:"post",
                      success:function(response){
                          $("#step_4 .select_domain_div").hide(); 
                          $("#submitbtn").show();
                          hideLoader();
                          $("#isproductvalid").val('Y');
                      }
                  });
            }
        });
    });


  
     $('#bookdomaintxt').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9-\b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });
    $('#ihavedomain').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9-.\b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });


        $(document).ready(function() {
            $(".dropdown dt a").click(function() {
                $(this).parents('.dropdown').find("dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
               if($(this).find('.title').html()){
                  var text = $(this).find('.title').html();
                  var price = $(this).find('.final-price').html();
                   $(this).parents('.dropdown').find("dt a span").html(text + price);
                   $(".dropdown dd ul").hide();
                }else{
                   var text = $(this).html();
                   $(this).parents('.dropdown').find("dt a span").html(text);
                   $(".dropdown dd ul").hide();
                }
                
            });
            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });
        });
        function getconfigfinalprice(proid){
      var formData = {"_token":"{{ csrf_token() }}","productid":proid}    
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/getconfigfinalprice')}}",
            data:formData,
            type:"post",
            success:function(response){
                $("#finalPrice").html('<strong>Total:</strong><i class="rp_icon">{!! Config::get('Constant.sys_currency_symbol') !!}</i>' + response);
                hideLoader();
            }
        });
    }
    @if($productData['producttype'] == 'vps' || $productData['producttype'] == 'dedicatedserver')
    function performCheckout(){
      if ($('#check_terms').prop("checked") == false) {
        $('#check_terms_error').html('* Please check to agree on all terms to continue.').css("display","block");
        // alert("* Please check to agree on all terms to continue.");
        return false;
      }else{
          $('#check_terms_error').css("display","none");
      }
      if($("#customfield_hostname").val() == "") { $('html, body').animate({scrollTop: $(".serverconfig").offset().top-300}, '2000'); } //Validation for hostname
      var hostnameconfig=$("#customfield_hostname").val();
      if(hostnameconfig=='')
      {
        $("#next_btn_3").click();
        return false;
      }
      else
      { 
        $("#next_btn_3").click();
        setTimeout(function(){ window.location.href="{{url('cart/signin')}}"; }, 500);
      }
    }
    @elseif($productData['producttype'] == 'domain')
    function performCheckout(){
      if ($('#check_terms').prop("checked") == false) {
        $('#check_terms_error').html('* Please check to agree on all terms to continue.').css("display","block");
        // alert("* Please check to agree on all terms to continue.");
        return false;
      }else{
          $('#check_terms_error').css("display","none");
      }
       window.location.href="{{url('cart/signin')}}"; 
    }
    @else
    function performCheckout(){
      if ($('#check_terms').prop("checked") == false) {
        $('#check_terms_error').html('* Please check to agree on all terms to continue.').css("display","block");
        // alert("* Please check to agree on all terms to continue.");
        return false;
      }else{
          $('#check_terms_error').css("display","none");
      }
      
      if($("#isproductvalid").val() == 'Y')
      { window.location.href="{{url('cart/signin')}}"; }
      else
      {
        alert("Please select a domain.");$("#ihavedomain").focus();
        return false;
      }
    }
    @endif
    
    </script>

    {{-- hostname popup --}}
      <div class="modal fade" id="domainModel">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Host IT Smart Says</h4>
              <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              <label>Please enter hostname<span class="required">*</span></label>
              <input type="text" class="form-control customele" value="{{date('YmdHis')}}.hostitsmart.com" name="customfield_hostname" id="customfield_hostname" placeholder="Enter Hostname">
              <span class="error" id="hostnameerr"></span>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="hostpopup">Ok</button>
            </div>
            
          </div>
        </div>
      </div> 
    {{-- hostname popup end--}}
<script type="text/javascript">
    function freehosting(){
        var domain = '<?php echo $productData['domain']; ?>';
        if ($('#check_terms').prop("checked") != false) {
        addSuggestedProduct('hosting','179','monthly','India',domain);
        }
        performCheckout();
    };
    $("#add_free_hosting").click(function(){
        $('#add_free_hosting').hide();
        $('#remove_free_hosting').show();
        $('#without_free_hosting_checkout').hide();
        $('#cc_sub').show();

    });
    $("#remove_free_hosting").click(function(){
        $('#add_free_hosting').show();
        $('#remove_free_hosting').hide();
        $('#without_free_hosting_checkout').show();
        $('#cc_sub').hide();
    });
    </script>
  {{-- /*vinod changes s*/ --}}
    <script>
      hostarr = new Array();
      $(".hostclick").click(function(){
         hostarr['productid']=$(this).data("id");
      });

      $("#hostpopup").click(function(){
        // console.log("hello");
        hostarr['val']=$("#customfield_hostname").val();
        hostarr['fieldid']="customfield_hostname";

        if($("#customfield_hostname").val()=="")
        {
            $("#hostnameerr").text("Please enter hostname");
            return false;
        }
        else
        {   

            var formData = {"_token":"{{ csrf_token() }}","productid":hostarr['productid'],"fieldid":hostarr['fieldid'],"val":hostarr['val'] }
            // console.log("frdata",formData);
            $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/setcustomoptionvalue')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
                 if(response == '1')
                {
                    $(".host_"+hostarr['productid']).html("<div class='ost_product'>"+hostarr['val']+"</div>");
                }
            }
            });
        }
    });
    </script>
    <script type="text/javascript">
      function hidevalidmass(){
          var error2= document.getElementById('hiddenProductId')
          // alert("timeout")
          $(".hiddenProductId").hide();
          setTimeout(validate,4000)
      }
      </script>
                             <script type="text/javascript">
      function hidevalidmass_search(){
          var error2= document.getElementById('hiddenProductId')
          // alert("timeout")
          $(".serarchdomain").hide();
          setTimeout(validate,4000)
      }
      $(function(){
        setTimeout(function(){
            $('#domain_combo').find(".dropdown-toggle").addClass('form-control');
        }, 1000);
        var renew_price = $("input[name='sel_hostingregister_0']:checked").val();
        var featchPlansData={"is_three_months_free":'{{$is_three_months_free}}', "a":'{{$a}}',"selectedMax":'{{ $_maxSelected }}',"saveamount":'{{ $_selectedSave }}',"maxselectedsave":{{ $_maxSelectedSave }},'maxDuration':'{{ $_maxDuration }}' };
        /*console.log(featchPlansData);*/
        featchPlansMessage(featchPlansData);
    })
    </script>
    
    {{-- /*vinod changes e*/ --}}

<div class="modal fade deal-popup" id="disclaimer-popup" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" title="Disclaimers">Disclaimers</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="deal-body">
                    <ul>
                            <li class="text-left">Information contained in this website is for general information purpose only, The information is provided by HostITSmart, a property of Hosting World Pvt Ltd. While we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose.Any conviction you place on such information is therefore strictly at your own risk.</li>
                            <li class="text-left">In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website. Through this website you are able to link to other websites which are not under the control of Hosting World Pvt Ltd. We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them. Every effort is made to keep the website up and running smoothly. However, Hosting World Pvt Ltd takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection