
@extends('layouts.app')
@section('content')
 {{-- {{ dd(get_defined_vars()) }} --}} 


<?php 
$theme = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
 
<!-- @include('template.banner') -->
@include('template.'.$theme.'.banner')

<?php
// echo '<pre>'; print_r($ProductsPackageData); exit;

?>

 <div class="web-pln-box head-tb-p-40" id="pricing">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Perfect & Cheap WordPress Hosting Plans</h2>
            </div>
            <div class="row justify-content-center">


                @php if($ProductBanner->id == '10'){
                $mainclassssl = 'ssl-small';
                }else{
                $mainclassssl = '';
                } @endphp

                @php
                if ($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6) {
                $plan_row = '';
                $box_plan_class = 'col-lg-3 col-md-6 col-sm-12';

                $_BASIC_PRICE_12_INR='_STARTER_PRICE_12_INR';
                $_BASIC_PRICE_36_INR='_BASIC_PRICE_36_INR';
                $_ESSENTIAL_PRICE_36_INR='_ESSENTIAL_PRICE_36_INR';
                $_PROFESSIONAL_PRICE_36_INR='_PROFESSIONAL_PRICE_36_INR';



                

                } else {
                $plan_row = 'justify-content-center';
                $box_plan_class = 'col-sm-6 col-md-6 col-lg-3 col-xs-12';

                
                }

                @endphp

                   <div class="row">
                    <div class="col-12">
                    <!-- <br /> -->
                    <div class="wh-server-location-tab">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="loc1" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="changeLocation('India');">
                                    <img loading="eager" src="../assets/images/web_hosting/india-icons.webp" alt="india-icons"> India</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="loc2" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="changeLocation('Canada');">
                                    <img loading="eager" src="../assets/images/web_hosting/canada-icons.webp" alt="canada-icons" > Canada</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="loc3" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="changeLocation('Germany');">
                                    <img loading="eager" src="../assets/images/web_hosting/germany-icons.webp" alt="germany-icons"> Germany</button >
                            </li>
                        </ul>


                         <script type="text/javascript">
                function changeLocation(locstr) {
                    $('input[id^="location"]').each(function(i, ele) { $(this).val(locstr);
                         });
                }
            </script>
        </div>
    </div>
                </div>

                                <div class="{{$box_plan_class}}" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-plan-box">
                                        <div class="shared_plan_price">
                                            <div class="shared-plan-head">{{$ProductsPackageData[0]->varTitle}}
                                                {{-- <div class="plan-icon-right"></div> --}}
                                            </div>
                                            <div class="shared-plan-cut-price">

                                                   {{-- @if(isset($ProductsPackageData[0]->productpricing['monthly']) && !empty($ProductsPackageData[0]->productpricing['monthly'])) --}}
                                                    <span class="shared-cut-price" id="BasicThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[0]->intOldPriceOneYearINR}}</span>
                                                    {{-- @endif --}}
                                                
                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[0]->varAdditionalOffer));
                                                @endphp


                                                <span class="shared-offer-discount" id="BasicThreeYearOffer">
                                                    @if (count($blackfridayOffArr) > 1)
                                                    {{$blackfridayOffArr[4]}}% OFF
                                                    @else
                                                    ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                    @endif


                                                </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">

{{-- @if(isset($ProductsPackageData[0]->productpricing['triennially']) && !empty($ProductsPackageData[0]->productpricing['triennially'])) --}}
                                                <span class="shared-main-price-tittle" id="StarterThreeYearWhmcsINR">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                {{--{{ $ProductsPackageData[0]->productpricing['triennially'] }}--}}
                                                {{-- @endif --}}
                                                
                                            </div>

                                            <div class="shared-plan-btm" id="StarterThreeYearButtonText">
                                                {!! $StarterThreeYearButtonText !!}
                                                <!-- @if(isset($ProductsPackageData[0]->ButtonTexttriennially) && !empty($ProductsPackageData[0]->ButtonTexttriennially))
                                                    {!!$ProductsPackageData[0]->ButtonTexttriennially!!}
                                                @endif   -->                                          </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip">
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain' || strtolower(trim($Specification)) == 'free backup' || strtolower(trim($Specification)) == 'website builder' || strtolower(trim($Specification)) == 'supports python' )
                                                    <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl' || strtolower(trim($Specification)) == 'free ssl certificate')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                        </div>
                                                    </li>
                                                    @elseif(strtolower(trim($Specification)) == "2 mysql db's")
                                                    <li>
                                                        <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                    @elseif(strtolower(trim($Specification)) == "1 mssql/mysql space")
                                                    <li>
                                                        <div class="free_domain_black free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                    @elseif(strtolower(trim($Specification)) == "supports node.js")
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">21.7.3 & 20.15.0
                                                            </span>

                                                        </div>
                                                    </li>
                                                    @else
                                                    <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>


                                            <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See More Features</a>

                                            @php $AdditionalNote = explode("\n",$ProductsPackageData[0]->txtShortDescription); @endphp
                                            <div class="plan-text-slider">
                                                <div class="owl-carousel owl-theme">
                                                    @foreach($AdditionalNote as $Additional)
                                                    <div class="item">
                                                        <span class="plan-ssl">
                                                            {{$Additional}}
                                                        </span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @php if($ProductBanner->id == '7') { @endphp
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('StarterOneMonthFeatures')" href="javascript:;" data-scroll-to="#StarterOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp
                                        </div>
                                    </div>
                                </div>
                                @php
                                $class = ''; $class1 = '';
                                if($ProductsPackageData[2]->chrDisplayontop == 'Y'){
                                $class = 'recommanded-main';
                                $class1 = 'recommanded-main-icon';
                                } @endphp
                                {{-- Essi --}}
                                <div class="{{$box_plan_class}}">
                                    @php $class = ''; $class1 = '';
                                    if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                    $class = 'recommanded-main';
                                    $class1 = 'recommanded-main-icon';
                                    } @endphp
                                    <div class="shared-plan-box {{$class}} vps-plan-recommanded-main">
                                        <div class="shared_plan_price">
                                            <div class="shared-plan-head">{{$ProductsPackageData[1]->varTitle}}
                                                {{-- <div class="plan-icon-right"></div> --}}
                                                <div class="{{$class1}}"></div>

                                            </div>
                                            <div class="shared-plan-cut-price">
                                                {{-- @if(isset($ProductsPackageData[1]->productpricing['monthly']) && !empty($ProductsPackageData[1]->productpricing['monthly'])) --}}
                                                    <span class="shared-cut-price" id="PerformThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceOneYearINR}}</span>
                                                   {{-- @endif --}}
                                                   {{--{{ $ProductsPackageData[1]->productpricing['monthly'] }}--}}

                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[1]->varAdditionalOffer));
                                                @endphp


                                                <span class="shared-offer-discount" id="EssentialThreeYearOffer">
                                                    @if (count($blackfridayOffArr) > 1)
                                                    {{$blackfridayOffArr[4]}}% OFF
                                                    @else
                                                    ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                    @endif


                                                </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">

                                                {{-- @if(isset($ProductsPackageData[1]->productpricing['triennially']) && !empty($ProductsPackageData[1]->productpricing['triennially'])) --}}
                                                <span class="shared-main-price-tittle" id="PerformThreeYearWhmcsINR">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                              {{-- @endif --}}
                                              {{-- {{ $ProductsPackageData[1]->productpricing['triennially'] }} --}}

                                            </div>
                                           
                                            <div class="shared-plan-btm" id="PerformanceThreeYearButtonText">
                                                {!! $PerformanceThreeYearButtonText !!}
                                                
                                                
                                            </div>
                                             <!-- @if(isset($ProductsPackageData[1]->ButtonTexttriennially) && !empty($ProductsPackageData[1]->ButtonTexttriennially)) --><!-- {!!$ProductsPackageData[1]->ButtonTexttriennially!!} -->
                                            <!-- @endif -->
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip">
                                                @foreach($SpecificationData as $Specification)

                                                <div class="slide-toggle">
                                                   @if($ProductsPackageData[1]->varTitle == 'ESSENTIAL' && strtolower(trim($Specification)) == 'free domain')
                                                   <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    {{-- @if(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                    <span class="domain_tooltip">
                                                        Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.                                                       
                                                        <span class="price_domain">Your Domain Renewal Charges:<br>{!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                            </span>
                                                    </span>
                                                </div>
                                                </li> --}}

                                                @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "10 mysql db's")
                                                <li>
                                                    <div class="free_domain free_domain_black">{{$Specification}}
                                                        <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "10 mssql/mysql space")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                            @if($ProductBanner->id == 2)
                                                            <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports node.js")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">6.x, 8.x, 9.x, 10.x, 11.x, 12.x, 14.x, 16.x, 18.x.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports python")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11.

                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "website builder")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                    </div>
                                                </li>
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif
                                        </div>
                                        @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>

                                        @php $AdditionalNote = explode("\n",$ProductsPackageData[1]->txtShortDescription); @endphp
                                        <div class="plan-text-slider">
                                            <div class="owl-carousel owl-theme">
                                                @foreach($AdditionalNote as $Additional)
                                                <div class="item">
                                                    <span class="plan-ssl">
                                                        {{$Additional}}
                                                    </span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @php if($ProductBanner->id == '7') { @endphp
                                        <div class="v-f_link">
                                            <a onclick="VPSFeatures('PerformanceOneMonthFeatures')" href="javascript:;" data-scroll-to="#PerformanceOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                        </div>
                                        @php } @endphp
                                    </div>
                                </div>
                            </div>
                            {{-- prof --}}
                            <div class="{{$box_plan_class}}">
                                @php $class = ''; $class1 = '';
                                if($ProductsPackageData[2]->chrDisplayontop == 'Y'){
                                $class = 'recommanded-main';
                                $class1 = 'recommanded-main-icon';
                                } @endphp
                                <div class="shared-plan-box {{$class}} vps-plan-recommanded-main">
                                    <div class="shared_plan_price">

                                        <div class="shared-plan-head">{{$ProductsPackageData[2]->varTitle}}</div>
                                        <div class="{{$class1}}"></div>
                                        <div class="shared-plan-cut-price">

                                           {{-- @if(isset($ProductsPackageData[2]->productpricing['monthly']) && !empty($ProductsPackageData[2]->productpricing['monthly'])) --}}
                                            <span class="shared-cut-price" id="BusinessThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceOneYearINR}}</span>
                                            {{-- @endif --}}
                                            {{--{{ $ProductsPackageData[2]->productpricing['monthly'] }} --}}

                                            @php
                                            $blackfridayOffArr = (explode(",",$ProductsPackageData[2]->varAdditionalOffer));
                                            @endphp


                                            <span class="shared-offer-discount" id="ProfessionalThreeYearOffer">
                                                @if (count($blackfridayOffArr) > 1)
                                                {{$blackfridayOffArr[4]}}% OFF
                                                @else
                                                ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                @endif


                                            </span>
                                        </div>
                                        {{-- <div class="plan-icon-right"></div> --}}

                                    </div>
                                    <div class="shared-price-padding">
                                        <div class="shared-main-price clearfix">
                                            
                                            {{-- @if(isset($ProductsPackageData[2]->productpricing['triennially']) && !empty($ProductsPackageData[2]->productpricing['triennially'])) --}}
                                            <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsINR">
                                                <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_36_INR) }}</span>/mo*
                                            </span>
                                            {{-- @endif --}}
                                            {{-- {{ $ProductsPackageData[2]->productpricing['triennially'] }} --}}


                                        </div>
                                        <!-- @if(isset($ProductsPackageData[2]->ButtonTexttriennially) && !empty($ProductsPackageData[2]->ButtonTexttriennially)) -->
                                        <!-- {!!$ProductsPackageData[2]->ButtonTexttriennially!!} -->  <!-- @endif --> 
                                        <div class="shared-plan-btm" id="BusinessThreeYearButtonText">
                                            {!! $BusinessThreeYearButtonText !!}                                                                                     
                                        </div>
                                        
                                        @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                        <ul class="shared-plan-features shared-plan-tooltip">
                                            @foreach($SpecificationData as $Specification)
                                            <div class="slide-toggle">
                                                @if(strtolower(trim($Specification)) == 'free domain')
                                                <li>
                                                    
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">
                                                            Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                            <span class="price_domain">Your Domain Renewal Charges:<br>{!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                            </span>
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "20 mysql db's")
                                                <li>
                                                    <div class="free_domain free_domain_black">{{$Specification}}
                                                        <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "20 mssql/mysql space")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                            @if($ProductBanner->id == 2)
                                                            <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports node.js")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">6.x, 8.x, 9.x, 10.x, 11.x, 12.x, 14.x, 16.x, 18.x.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports python")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11.

                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "website builder")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                    </div>
                                                </li>
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif
                                            </div>
                                            @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>

                                        @php $AdditionalNote = explode("\n",$ProductsPackageData[2]->txtShortDescription); @endphp
                                        <div class="plan-text-slider">
                                            <div class="owl-carousel owl-theme">
                                                @foreach($AdditionalNote as $Additional)
                                                <div class="item">
                                                    <span class="plan-ssl">
                                                        {{$Additional}}
                                                    </span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @php if($ProductBanner->id == '7') { @endphp
                                        <div class="v-f_link">
                                            <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce bounce"></i></a>
                                        </div>
                                        @php } @endphp
                                    </div>
                                </div>
                            </div>
                            {{-- ente --}}
                            <div class="{{$box_plan_class}}">
                                @php $class = ''; $class1 = '';
                                if($ProductsPackageData[3]->chrDisplayontop == 'Y'){
                                $class = 'recommanded-main';
                                $class1 = 'recommanded-main-icon';
                                } @endphp
                                <div class="shared-plan-box {{$class}} vps-plan-recommanded-main">
                                    <div class="shared_plan_price">

                                        <div class="shared-plan-head">{{$ProductsPackageData[3]->varTitle}}</div>
                                        <div class="{{$class1}}"></div>
                                        <div class="shared-plan-cut-price">

                                           {{-- @if(isset($ProductsPackageData[3]->productpricing['monthly']) && !empty($ProductsPackageData[3]->productpricing['monthly'])) --}}
                                            <span class="shared-cut-price" id="BusinessThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[3]->intOldPriceOneYearINR}}</span>
                                           {{-- @endif --}}
                                           {{--{{ $ProductsPackageData[3]->productpricing['monthly'] }}--}}

                                            @php
                                            $blackfridayOffArr = (explode(",",$ProductsPackageData[3]->varAdditionalOffer));
                                            @endphp


                                            <span class="shared-offer-discount" id="ProfessionalThreeYearOffer">
                                                @if (count($blackfridayOffArr) > 1)
                                                {{$blackfridayOffArr[4]}}% OFF
                                                @else
                                                ({{$ProductsPackageData[3]->varAdditionalOffer}})
                                                @endif


                                            </span>
                                        </div>
                                        {{-- <div class="plan-icon-right"></div> --}}

                                    </div>
                                    <div class="shared-price-padding">
                                        <div class="shared-main-price clearfix">
                                            
                                            {{-- @if(isset($ProductsPackageData[3]->productpricing['triennially']) && !empty($ProductsPackageData[3]->productpricing['triennially'])) --}}
                                            <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsINR">
                                                <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_36_INR') }}</span>/mo*
                                            </span>
                                            {{-- @endif --}}
                                            {{--{{ $ProductsPackageData[3]->productpricing['triennially'] }}--}}

                                        </div>
                                        <!-- @if(isset($ProductsPackageData[3]->ButtonTexttriennially) && !empty($ProductsPackageData[3]->ButtonTexttriennially)) -->                                       
                                        <!-- {!!$ProductsPackageData[3]->ButtonTexttriennially!!} --><!-- @endif -->
                                        <div class="shared-plan-btm" id="BusinessThreeYearButtonText">
                                            {!! $EnterpriseThreeYearButtonText !!}                                                                                    
                                        </div>
                                        @php $SpecificationData = explode("\n",$ProductsPackageData[3]->txtSpecification); @endphp
                                        <ul class="shared-plan-features shared-plan-tooltip">
                                            @foreach($SpecificationData as $Specification)
                                            <div class="slide-toggle">
                                                @if(strtolower(trim($Specification)) == 'free domain')
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">
                                                            Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                            <span class="price_domain">Your Domain Renewal Charges:<br>{!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                            </span>
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "20 mysql db's")
                                                <li>
                                                    <div class="free_domain free_domain_black">{{$Specification}}
                                                        <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "20 mssql/mysql space")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                            @if($ProductBanner->id == 3)
                                                            <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports node.js")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">6.x, 8.x, 9.x, 10.x, 11.x, 12.x, 14.x, 16.x, 18.x.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports python")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11.

                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "website builder")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                    </div>
                                                </li>
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif
                                            </div>
                                            @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>

                                        @php $AdditionalNote = explode("\n",$ProductsPackageData[3]->txtShortDescription); @endphp
                                        <div class="plan-text-slider">
                                            <div class="owl-carousel owl-theme">
                                                @foreach($AdditionalNote as $Additional)
                                                <div class="item">
                                                    <span class="plan-ssl">
                                                        {{$Additional}}
                                                    </span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @php if($ProductBanner->id == '7') { @endphp
                                        <div class="v-f_link">
                                            <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce bounce"></i></a>
                                        </div>
                                        @php } @endphp
                                    </div>
                                </div>
                            </div>
                         
</div>
</div>
</div>
 <!--See More Features section start-->
 @include('template.'.$theme.'.more_hosting_features')
 <!--See More Features section end-->
<section class="luanchpad-wp-web head-tb-p-40">
    <div class="container-fluid">
        <div class="section-heading">
            <h2 class="text_head text-center">
                From Blank to Blast:<br>5-Step Launchpad For WordPress Website
            </h2>
            <p class="text-center">With our user-friendly & cheap WordPress hosting, create and launch your Website effortlessly in just five simple steps & bring your online vision to life.</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="lnch-box-main">
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>01</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/domain_icon.svg" alt="domain_icon">
                            <h2>Register Your Domain</h2>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                            <img src="../assets/img/wordpress/domain_icon_lgt.svg" alt="domain_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">01</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Register Your Domain</span>
                            <p>The first step in launching your WordPress site is to register a domain name. Your domain name is your website's address, which should be unique and easy to remember. Choose a domain name that is relevant to your site's topic.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">                        
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>02</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/hosting_plan_icon.svg" alt="hosting_plan_icon">
                            <h2>Choose Your Hosting Plan</h2>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                                <img src="../assets/img/wordpress/hosting_plan_icon_lgt.svg" alt="hosting_plan_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">02</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Choose Your Hosting Plan</span>
                            <p>Once you’ve registered your domain name, the next step is to choose your hosting plan. Host IT Smart offers premium WordPress hosting plans in India that help to bring your vision to life. Anticipate your site's traffic and resource needs, and choose a plan that supports optimal performance and scalability.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>03</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/wordpress_icon.svg" alt="wordpress_icon">
                            {{-- <h2 style="">Install WordPress</h2> --}}
                            <h2>Install <br>WordPress</h2>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                                <img src="../assets/img/wordpress/wordpress_icon_lgt.svg" alt="wordpress_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">03</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Install WordPress</span>
                            <p>We made installing WordPress easy! Our user-friendly 1-click installer in the panel lets you set up your WordPress website in just a few minutes. With a simple click, you can install your WordPress, and your website is ready to go live.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>04</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/theme_icon.svg" alt="theme_icon">
                            <h2>Pick a <br>Theme</h2>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                                <img src="../assets/img/wordpress/theme_icon_lgt.svg" alt="theme_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">04</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Pick a Theme</span>
                            <p>WordPress has a great collection of free and premium themes. Select the theme that enhances the overall look, feel, and aesthetic of your WordPress site. With our fastest WordPress hosting in India, your chosen theme will load quickly and provide a seamless user experience.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>05</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/publish_icon.svg" alt="publish_icon">
                            <h2>Start <br>Publishing</h2>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                                <img src="../assets/img/wordpress/publish_icon_lgt.svg" alt="publish_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">05</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Start Publishing</span>
                            <p>Once you’ve installed WordPress and chosen a theme, it’s time to start creating your site content. Use WordPress's intuitive editor to write posts, add images, and format your content. Invest time in researching and drafting content that provides value to your audience, ensuring it aligns with their needs and interests.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="optmz-wp head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">
            Ensure Your SEO Success with Optimized WordPress Hosting
            </h2>
            <p>Our WordPress hosting plans are designed to enhance your website's speed, security, and performance, delivering improved search engine rankings. With fast loading times and seamless integration, you can attract and engage more visitors.</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="optmz-wp-box optmz-fast">
                    <div class="optmz-box-icon">
                        <img src="../assets/img/wordpress/faster_load_icon.svg" alt="faster_load_icon">
                    </div>
                    <div class="optmz-box-cnt">
                        <h3>Faster Load Times</h3>
                        <p>Search engines appreciate websites that have fast load times. Host IT Smart offers optimized WordPress hosting plans in India, Canada & Germany to help your website load quickly. Direct more visitors to your website with faster load times and engage with them for enhanced SEO performance!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="optmz-wp-box optmz-uptime">
                    <div class="optmz-box-icon">
                        <img src="../assets/img/wordpress/uptime_icon.svg" alt="uptime_icon">
                    </div>
                    <div class="optmz-box-cnt">
                        <h3>Guaranteed Uptime and Reliability</h3>
                        <p>Search engines don't love websites that frequently face downtime. With our WordPress hosting, we offer a 99.9% uptime guarantee. We make sure that your website is always available to visitors. Consistent uptime will help you build trust and elevate your brand image!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="optmz-wp-box optmz-server">
                    <div class="optmz-box-icon">
                        <img src="../assets/img/wordpress/server_location_icon.svg" alt="server_location_icon">
                    </div>
                    <div class="optmz-box-cnt">
                        <h3>Optimized Server Location</h3>
                        <p>The physical location of your hosting server is a crucial factor that impedes your website's loading speed for visitors in different regions. We have placed our WordPress hosting servers in strategic data centers to help your website load quickly and enhance your SEO efforts!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="optmz-wp-box optmz-ssl">
                    <div class="optmz-box-icon">
                        <img src="../assets/img/wordpress/SSL_icon.svg" alt="SSL_icon">
                    </div>
                    <div class="optmz-box-cnt">
                        <h3>Free SSL Certificates for HTTPS</h3>
                        <p>Search engines consider HTTPS to be a ranking factor. Our WordPress hosting plans include free SSL certificates that enable HTTPS on your site and improve your SEO & provide a secure browsing experience for your visitors.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="web-sec-wp head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">
            How We Ensure Your Website's Security?
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="web-sec-top">
                    <div class="web-sec-top-1">
                        <img src="../assets/img/wordpress/agile_securities.png" alt="agile_securities">
                    </div>
                    <div class="web-sec-top-2">
                        <h3>Agile Security Scans</h3>
                        <p>We use Agile security scanning techniques to identify and address potential vulnerabilities present in your WordPress website. Our advanced security tools continuously monitor your site for traces of malicious activity, such as hacking attempts, malware infections, and SQL injection attacks.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="web-sec-cnt">
                    <div class="web-sec-cnt-img">
                        <img src="../assets/img/wordpress/DDOS_protection.png" alt="DDOS_protection">
                    </div>
                    <div class="web-sec-dt">
                        <h3>DDoS Protection</h3>
                        <p>DDoS, also known as Distributed Denial of Service, attacks your website with malicious traffic, rendering it inaccessible to genuine visitors. Our WordPress hosting solutions incorporate robust DDoS protection measures to safeguard your website from these attacks. We use advanced technologies and monitoring systems to mitigate DDoS threats effectively. This is to ensure your website remains online and accessible to genuine visitors, even during peak traffic or targeted attacks.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="web-sec-cnt">
                    <div class="web-sec-cnt-img">
                        <img src="../assets/img/wordpress/web_app_firewall.png" alt="web_app_firewall">
                    </div>
                    <div class="web-sec-dt">
                        <h3>Advanced Web Application Firewall</h3>
                        <p>Our cheap WordPress hosting solutions come with an advanced web application firewall (WAF) to safeguard your website from various cyber threats. The WAF acts as a security shield. It analyzes incoming traffic and blocks malicious requests before they can reach your website. Our WAF continuously monitors the traffic for vulnerabilities and potential attacks. Our WAF helps prevent unauthorized access, data breaches, and other security incidents, ensuring the safety and integrity of your online presence.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wp-ecommerce head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">Sell Smarter With Our WordPress Hosting for eCommerce.</h2>
            <p>Sell smarter with our eCommerce-optimized WordPress hosting. It ensures a smooth online shopping experience with advanced security features.</p>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="wp-ecom-img">
                    <img src="../assets/img/wordpress/wordpress_hosting_ecomm.png" alt="wordpress_hosting_ecomm">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wp-ecom-cnt">
                    <div class="wp-ecom-box">
                        <h3>WooCommerce Optimized</h3>
                        <p>We have tailored our WordPress hosting plans for WooCommerce, the leading eCommerce plugin. We provide the necessary resources to set up a smooth and efficient online store. Our hosting solution is fast and integrates well. It meets the unique needs of online stores, which helps you maximize sales and allows your customers to enjoy a memorable shopping experience.</p>
                    </div>
                    <div class="wp-ecom-box">
                        <h3>High-speed Servers</h3>
                        <p>High speed is the key to a successful eCommerce business. Our WordPress hosting uses high-performance servers for busy online stores. It provides quick load times and a seamless customer experience that reduces cart abandonment and boosts conversions.</p>
                    </div>
                    <div class="wp-ecom-box">
                        <h3>World-Class Security</h3>
                        <p>Security is crucial for any website. Our WordPress hosting offers strong protection for your store and customer data. We offer SSL certificates, malware scanning, and intrusion detection as part of our security services. Our advanced technologies guard your site against threats. Create a safe shopping environment with Host IT Smart!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Support section start-->
 <!-- @include('template.'.$theme.'.support_section') -->
 <!--Support section end-->
<section class="one-click-wp head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">One-Click Install: Your Effortless Strategy to Instant Setup</h2>
            <p>Start building your online presence today with our convenient one-click installation!</p>
        </div>
        <div class="one-click-wp-main">
            <img src="../assets/img/wordpress/one_click_install.png" alt="one_click_install">
        </div>
    </div>
</section>


<section class="disc-wp head-tb-p-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="disc-wp-img">
                    <img loading="lazy" src="/assets/img/wordpress/hits_wp.png" alt="hits_wp">
                </div>
            </div>
            <div class="col-lg-6">
                <div id="accordion-box" class="accordion disc-wp-box">
                    <div class="section-heading disc-wp-head">
                        <h2 class="text_head">Why Choose Host IT Smart For Your WordPress Website?</h2>
                    </div>
                    <div id="accordion-box" class="accordion disc-wp-box">
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box0" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">11+ Years of Experience</h3>
                            </a>
                            <div id="box0" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>With over 11 years of experience, Host IT Smart has established itself as a fast & cheap WordPress hosting provider in India. Through our robust infrastructure, we offer reliable, secure, and high-performance hosting services customized to match your unique needs for WordPress websites.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box1" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">SSD Based Servers</h3>
                            </a>
                            <div id="box1" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>Host IT Smart is committed to providing exceptional performance to its users. We use solid-state drives (SSDs) for our servers to achieve faster data transfer speeds. These SSDs boost the WordPress site’s SEO rankings and allow our users to enjoy a smooth digital experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box2" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Enterprise Hardware</h3>
                            </a>
                            <div id="box2" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>With Host IT Smart, invest in enterprise-grade hardware for optimal WordPress performance. This gives your website all the resources necessary to handle even the heaviest traffic loads. From powerful processors and ample memory to robust infrastructure, we deliver exceptional performance and reliability to your growing business.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box3" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">99.9% Uptime Guarantee</h3>
                            </a>
                            <div id="box3" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>Host IT Smart guarantees a 99.9% uptime when you buy WordPress hosting from us. We ascertain your website remains accessible to visitors around the clock. With Host IT Smart, you can trust that your WordPress website will stay available consistently and serve your audience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box4" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">24/7 Expert Support</h3>
                            </a>
                            <div id="box4" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>At Host IT Smart, we understand that website support is crucial at all times. Hence, we offer 24/7 expert support to assist you with solving your WordPress-related concerns. With Host IT Smart's classique support, experience the fastest & cheapest web hosting for WordPress and see your business grow to the next level.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box5" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">30-Day Money-Back Guarantee</h3>
                            </a>
                            <div id="box5" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>We leave no stone unturned to satisfy our users with our cheapest WordPress hosting. We offer a 30-day money-back guarantee - no questions asked. If you're not completely happy with your purchase, you may request a refund within the first 30 days.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box6" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">No Overselling</h3>
                            </a>
                            <div id="box6" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>Host IT Smart safeguards its users against performance issues with its no overselling policy. At Host IT Smart, we strictly adhere to a no overselling policy, which means we allocate only a reasonable number of accounts per server. It ensures that each website receives the resources it needs to perform optimally. Choose Host IT Smart to avoid slow load times and performance issues.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box7" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Built-In Speed and Performance Enhancements</h3>
                            </a>
                            <div id="box7" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>Host IT Smart's premium WordPress hosting in india is designed to deliver exceptional speed and high performance. Our cheap WordPress hosting platform comes with a range of built-in optimization features, like caching mechanisms and server-side performance enhancements, to ensure the quick and efficient loading of your WordPress website and a seamless user experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 disc-wp-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box8" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Free .COM Domain</h3>
                            </a>
                            <div id="box8" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>When you choose Host IT Smart as your WordPress hosting service partner, you will receive a Free .COM domain name for the 1st year. This valuable addition will help you establish a professional online presence and help users find your website easily.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <script>
document.addEventListener('DOMContentLoaded', function () {
    // Get references to the buttons and the div to be hidden
    const canadaButton = document.getElementById('loc2');
    const germanyButton = document.getElementById('loc3');
    const indiaButton = document.getElementById('loc1');
        const vpsPlanDiv = document.getElementById('basic_three_div');

    
    // Function to hide the vps-plan3 div
    function hideVpsPlanDiv() {
        vpsPlanDiv.classList.add('d-none');
    }
    
    // Function to show the vps-plan3 div
    function showVpsPlanDiv() {
        vpsPlanDiv.classList.remove('d-none');
    }
    
    // Add event listeners to the buttons
    canadaButton.addEventListener('click', hideVpsPlanDiv);
    germanyButton.addEventListener('click', hideVpsPlanDiv);
    indiaButton.addEventListener('click', showVpsPlanDiv);
});

</script>

 
 <!--testimonial section start-->
 @include('template.'.$theme.'.testimonial_section')
 <!--testimonial section end-->

@include('template.'.$theme.'.faq-section')

@endsection