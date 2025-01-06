@extends('layouts.app')
@section('content')

<?php
// echo '<pre>'; print_r($ProductBanner); exit;

?>
<div class="web-hstg-main">
    @if (isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
    <link rel="stylesheet" href="{{URL::to('/assets/css/full-width-inner-banner.css')}}">
    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
    @include('template.'.$themeversion.'.banner')
    @else
    @if(!empty($ProductBanner) && count((array)$ProductBanner) >0)
    <div class="banner-inner hosting-banner 121-{{ $ProductBanner->id }}" style="background-image:url('{!! App\Helpers\resize_image::resize($ProductBanner->fkIntImgId,1920,494) !!}')">
        <div class="container">
            <div class="banner-content">
                <div class="banner-image" data-aos="zoom-in" data-aos-delay="100"></div>
                <h1 class="banner-title" data-aos="fade-up" data-aos-delay="200">{{$ProductBanner->varTitle}}</h1>
                <span class="banner-subtitle" data-aos="fade-up" data-aos-delay="300">{!! $ProductBanner->varTagLine !!} </span>
                <span class="banner-text" data-aos="fade-up" data-aos-delay="400">{!! $ProductBanner->txtShortDescription !!}</span>
                @if(!empty($ProductBanner->VarBannerName1) && !empty($ProductBanner->VarBannerLink1) || !empty($ProductBanner->VarBannerName2) && !empty($ProductBanner->VarBannerLink2))
                <div class="banner-button" data-aos="fade-up" data-aos-delay="500">
                    @if(!empty($ProductBanner->VarBannerName1) && !empty($ProductBanner->VarBannerLink1))
                    <a class="btn-primary" title="{{$ProductBanner->VarBannerName1}}" href="{{$ProductBanner->VarBannerLink1}}">{{$ProductBanner->VarBannerName1}}</a>
                    @endif
                    @if(!empty($ProductBanner->VarBannerName2) && !empty($ProductBanner->VarBannerLink2))
                    <a class="btn-primary Click-to-Bottom" title="{{$ProductBanner->VarBannerName2}}" href="{{$ProductBanner->VarBannerLink2}}">{{$ProductBanner->VarBannerName2}}</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
        <!-- Freedom-sale-banner-2022 -->
        <!-- <span class="fsb-tca">* T & C Apply</span> -->
        <!-- End-freedome-sale-banner-2022 -->
    </div>
    @endif
    @endif

    <div class="web-pln-box head-tb-p-40" id="web_hosting_plan">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Choose & Buy Your Web Hosting Package</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="wh-server-location-tab">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button title="India" class="nav-link active" id="loc1" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="changeLocation('India');">
                                    <img loading="lazy" src="../assets/images/web_hosting/india-icons.webp" alt="india-icons"> India</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button title="Canada" class="nav-link" id="loc2" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="changeLocation('Canada');">
                                    <img loading="lazy" src="../assets/images/web_hosting/canada-icons.webp" alt="canada-icons"> Canada</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button title="Germany" class="nav-link" id="loc3" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="changeLocation('Germany');">
                                    <img loading="lazy" src="../assets/images/web_hosting/germany-icons.webp" alt="germany-icons"> Germany</button>
                            </li>
                        </ul>
                        <script type="text/javascript">
                            function changeLocation(locstr) {
                                if(locstr == "Canada" || locstr == "Germany"){
                                    $('.feature-litespeed').hide();
                                }else{
                                    $('.feature-litespeed').show();                            
                                }
                                // console.log("locstr"+ locstr);
                                $('input[id^="location"]').each(function(i, ele) {
                                    $(this).val(locstr);
                                });
                            }
                        </script>
                    </div>
                </div>



                @php if($ProductBanner->id == '10'){
                $mainclassssl = 'ssl-small';
                }else{
                $mainclassssl = '';
                } @endphp

                @php
                if ($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6) {
                $plan_row = '';
                $box_plan_class = 'col-lg-3 col-md-6 col-sm-12';
                $_BASIC_PRICE_1_INR='_BASIC_PRICE_1_INR';
                $_BASIC_PRICE_12_INR='_BASIC_PRICE_12_INR';
                $_BASIC_PRICE_1_USD='_BASIC_PRICE_1_USD';
                $_BASIC_PRICE_12_USD='_BASIC_PRICE_12_USD';
                $_ESSENTIAL_PRICE_1_INR='_ESSENTIAL_PRICE_1_INR';
                $_ESSENTIAL_PRICE_12_INR='_ESSENTIAL_PRICE_12_INR';
                $_ESSENTIAL_PRICE_1_USD='_ESSENTIAL_PRICE_1_USD';
                $_ESSENTIAL_PRICE_12_USD='_ESSENTIAL_PRICE_12_USD';
                $_PROFESSIONAL_PRICE_1_INR='_PROFESSIONAL_PRICE_1_INR';
                $_PROFESSIONAL_PRICE_12_INR='_PROFESSIONAL_PRICE_12_INR';
                $_PROFESSIONAL_PRICE_1_USD='_PROFESSIONAL_PRICE_1_USD';
                $_PROFESSIONAL_PRICE_12_USD='_PROFESSIONAL_PRICE_12_USD';

                $_BASIC_PRICE_3_INR='_BASIC_PRICE_3_INR';
                $_BASIC_PRICE_24_INR='_BASIC_PRICE_24_INR';
                $_BASIC_PRICE_3_USD='_BASIC_PRICE_3_USD';
                $_BASIC_PRICE_24_USD='_BASIC_PRICE_24_USD';
                $_ESSENTIAL_PRICE_3_INR='_ESSENTIAL_PRICE_3_INR';
                $_ESSENTIAL_PRICE_24_INR='_ESSENTIAL_PRICE_24_INR';
                $_ESSENTIAL_PRICE_3_USD='_ESSENTIAL_PRICE_3_USD';
                $_ESSENTIAL_PRICE_24_USD='_ESSENTIAL_PRICE_24_USD';
                $_PROFESSIONAL_PRICE_3_INR='_PROFESSIONAL_PRICE_3_INR';
                $_PROFESSIONAL_PRICE_24_INR='_PROFESSIONAL_PRICE_24_INR';
                $_PROFESSIONAL_PRICE_3_USD='_PROFESSIONAL_PRICE_3_USD';
                $_PROFESSIONAL_PRICE_24_USD='_PROFESSIONAL_PRICE_24_USD';

                $_BASIC_PRICE_6_INR='_BASIC_PRICE_6_INR';
                $_BASIC_PRICE_36_INR='_BASIC_PRICE_36_INR';
                $_BASIC_PRICE_6_USD='_BASIC_PRICE_6_USD';
                $_BASIC_PRICE_36_USD='_BASIC_PRICE_36_USD';
                $_ESSENTIAL_PRICE_6_INR='_ESSENTIAL_PRICE_6_INR';
                $_ESSENTIAL_PRICE_36_INR='_ESSENTIAL_PRICE_36_INR';
                $_ESSENTIAL_PRICE_6_USD='_ESSENTIAL_PRICE_6_USD';
                $_ESSENTIAL_PRICE_36_USD='_ESSENTIAL_PRICE_36_USD';
                $_PROFESSIONAL_PRICE_6_INR='_PROFESSIONAL_PRICE_6_INR';
                $_PROFESSIONAL_PRICE_36_INR='_PROFESSIONAL_PRICE_36_INR';
                $_PROFESSIONAL_PRICE_6_USD='_PROFESSIONAL_PRICE_6_USD';
                $_PROFESSIONAL_PRICE_36_USD='_PROFESSIONAL_PRICE_36_USD';

                } else {
                $plan_row = 'justify-content-center';
                $box_plan_class = 'col-sm-6 col-md-6 col-lg-3 col-xs-12';

                $_BASIC_PRICE_1_INR='_STARTER_PRICE_1_INR';
                $_BASIC_PRICE_12_INR='_STARTER_PRICE_12_INR';
                $_BASIC_PRICE_1_USD='_STARTER_PRICE_1_USD';
                $_BASIC_PRICE_12_USD='_STARTER_PRICE_12_USD';
                $_ESSENTIAL_PRICE_1_INR='_PERFORMANCE_PRICE_1_INR';
                $_ESSENTIAL_PRICE_12_INR='_PERFORMANCE_PRICE_12_INR';
                $_ESSENTIAL_PRICE_1_USD='_PERFORMANCE_PRICE_1_USD';
                $_ESSENTIAL_PRICE_12_USD='_PERFORMANCEL_PRICE_12_USD';
                $_PROFESSIONAL_PRICE_1_INR='_BUSINEESS_PRICE_1_INR';
                $_PROFESSIONAL_PRICE_12_INR='_BUSINEESS_PRICE_12_INR';
                $_PROFESSIONAL_PRICE_1_USD='_BUSINEESS_PRICE_1_USD';
                $_PROFESSIONAL_PRICE_12_USD='_BUSINEESS_PRICE_12_USD';

                $_BASIC_PRICE_3_INR='_STARTER_PRICE_3_INR';
                $_BASIC_PRICE_24_INR='_STARTER_PRICE_24_INR';
                $_BASIC_PRICE_3_USD='_STARTER_PRICE_3_USD';
                $_BASIC_PRICE_24_USD='_STARTER_PRICE_24_USD';
                $_ESSENTIAL_PRICE_3_INR='_PERFORMANCE_PRICE_3_INR';
                $_ESSENTIAL_PRICE_24_INR='_PERFORMANCE_PRICE_24_INR';
                $_ESSENTIAL_PRICE_3_USD='_PERFORMANCE_PRICE_3_USD';
                $_ESSENTIAL_PRICE_24_USD='_PERFORMANCE_PRICE_24_USD';
                $_PROFESSIONAL_PRICE_3_INR='_BUSINEESS_PRICE_3_INR';
                $_PROFESSIONAL_PRICE_24_INR='_BUSINEESS_PRICE_24_INR';
                $_PROFESSIONAL_PRICE_3_USD='_BUSINEESS_PRICE_3_USD';
                $_PROFESSIONAL_PRICE_24_USD='_BUSINEESS_PRICE_24_USD';

                $_BASIC_PRICE_6_INR='_STARTER_PRICE_6_INR';
                $_BASIC_PRICE_36_INR='_STARTER_PRICE_36_INR';
                $_BASIC_PRICE_6_USD='_STARTER_PRICE_6_USD';
                $_BASIC_PRICE_36_USD='_STARTER_PRICE_36_USD';
                $_ESSENTIAL_PRICE_6_INR='_PERFORMANCE_PRICE_6_INR';
                $_ESSENTIAL_PRICE_36_INR='_PERFORMANCE_PRICE_36_INR';
                $_ESSENTIAL_PRICE_6_USD='_PERFORMANCE_PRICE_6_USD';
                $_ESSENTIAL_PRICE_36_USD='_PERFORMANCE_PRICE_36_USD';
                $_PROFESSIONAL_PRICE_6_INR='_BUSINEESS_PRICE_6_INR';
                $_PROFESSIONAL_PRICE_36_INR='_BUSINEESS_PRICE_36_INR';
                $_PROFESSIONAL_PRICE_6_USD='_BUSINEESS_PRICE_6_USD';
                $_PROFESSIONAL_PRICE_36_USD='_BUSINEESS_PRICE_36_USD';
                }

                @endphp

                                <div class="{{$box_plan_class}}" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-plan-box">
                                        <div class="shared_plan_price">
                                            <div class="shared-plan-head">{{$ProductsPackageData[0]->varTitle}}
                                                {{-- <div class="plan-icon-right"></div> --}}
                                            </div>
                                            <div class="shared-plan-cut-price">

                                                @if(Config::get('Constant.sys_currency') == 'INR')

                                                @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                <span class="shared-cut-price" id="BasicThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[0]->intOldPriceThreeYearINR}}</span>
                                                @endif
                                                @else

                                                @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearUSD))
                                                <span class="shared-cut-price" id="BasicThreeYearUSD">{{$ProductsPackageData[0]->intOldPriceThreeYearUSD}}</span>
                                                @endif

                                                @endif
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

                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp

                                                <span class="shared-main-price-tittle" id="StarterThreeYearWhmcsINR">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.'WEB_HOSTING_BASIC_PRICE_36_INR') }}</span>/mo*
                                                </span>
                                                @php } else { @endphp

                                                <span class="shared-main-price-tittle" id="StarterThreeYearWhmcsUSD">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.'WEB_HOSTING_BASIC_PRICE_36_USD') }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                            </div>

                                            <div class="shared-plan-btm" id="StarterThreeYearButtonText">
                                                {!!$BasicThreeYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip">
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain' || strtolower(trim($Specification)) == 'free backup' || strtolower(trim($Specification)) == 'website builder' || strtolower(trim($Specification)) == 'supports python' || strtolower(trim($Specification)) == 'terminal access')
                                                    <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    @elseif(strtolower(trim($Specification)) == "litespeed")
                                                    <li class="cross_free_domain feature-litespeed"><span>{{$Specification}}</span></li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl' || strtolower(trim($Specification)) == 'free ssl certificate')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                        </div>
                                                    </li>
                                                     @elseif(strtolower(trim($Specification)) == 'plesk')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Our basic web hosting package includes a Plesk panel for managing your websites, domains, emails, and more.
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

                                                @if(Config::get('Constant.sys_currency') == 'INR')

                                                @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                <span class="shared-cut-price" id="PerformThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceThreeYearINR}}</span>
                                                @endif
                                                @else

                                                @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                <span class="shared-cut-price" id="PerformThreeYearUSD">{{$ProductsPackageData[1]->intOldPriceThreeYearUSD}}</span>
                                                @endif
                                                @endif

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

                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp

                                                <span class="shared-main-price-tittle" id="PerformThreeYearWhmcsINR">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.'WEB_HOSTING_ESSENTIAL_PRICE_36_INR') }}</span>/mo*
                                                </span>
                                                @php } else { @endphp

                                                <span class="shared-main-price-tittle" id="PerformThreeYearWhmcsUSD">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.'WEB_HOSTING_ESSENTIAL_PRICE_36_USD') }}</span>/mo*
                                                </span>
                                                @php } @endphp


                                            </div>

                                            <div class="shared-plan-btm" id="PerformanceThreeYearButtonText">
                                                {!!$EssentialThreeYearButtonText!!}
                                            </div>
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
                                                 @elseif(strtolower(trim($Specification)) == "cpanel + 1 click installer")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "litespeed")
                                                <li class="feature-litespeed"><span>{{$Specification}}</span></li>
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif
                                        </div>
                                        @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See More Features</a>

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

                                            @if(Config::get('Constant.sys_currency') == 'INR')

                                            @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                            <span class="shared-cut-price" id="BusinessThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceThreeYearINR}}</span>
                                            @endif
                                            @else

                                            @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                            <span class="shared-cut-price" id="BusinessThreeYearUSD">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceThreeYearUSD}}</span>
                                            @endif
                                            @endif

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
                                            @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp

                                            <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsINR">
                                                <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.'WEB_HOSTING_PROFESSIONAL_PRICE_36_INR') }}</span>/mo*
                                            </span>
                                            @php } else { @endphp

                                            <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsUSD">
                                                <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.'WEB_HOSTING_PROFESSIONAL_PRICE_36_USD') }}</span>/mo*
                                            </span>
                                            @php } @endphp


                                        </div>

                                        <div class="shared-plan-btm" id="BusinessThreeYearButtonText">
                                            {!!$ProfessionalThreeYearButtonText!!}
                                        </div>
                                        @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                        <ul class="shared-plan-features shared-plan-tooltip">
                                            @foreach($SpecificationData as $Specification)
                                            <div class="slide-toggle">
                                               @if(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                 @elseif(strtolower(trim($Specification)) == "cpanel + 1 click installer")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "litespeed")
                                                <li class="feature-litespeed"><span>{{$Specification}}</span></li>
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif
                                            </div>
                                            @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See More Features</a>

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
                                <div class="shared-plan-box">
                                    <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[3]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                        <div class="shared-plan-cut-price">

                                            @if(Config::get('Constant.sys_currency') == 'INR')

                                            @if(!empty($ProductsPackageData[3]->intOldPriceThreeYearINR))
                                            <span class="shared-cut-price" id="EnterpriseThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[3]->intOldPriceThreeYearINR}}</span>
                                            @endif
                                            @else

                                            @if(!empty($ProductsPackageData[3]->intOldPriceThreeYearINR))
                                            <span class="shared-cut-price" id="EnterpriseThreeYearUSD">{{$ProductsPackageData[3]->intOldPriceThreeYearUSD}}</span>
                                            @endif

                                            @endif
                                            @php
                                            $blackfridayOffArr = (explode(",",$ProductsPackageData[3]->varAdditionalOffer));
                                            @endphp


                                            <span class="shared-offer-discount" id="EnterpriseThreeYearOffer">
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

                                            @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp

                                            <span class="shared-main-price-tittle" id="EnterpriseThreeYearWhmcsINR">
                                                <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.'WEB_HOSTING_ENTERPRISE_PRICE_36_INR') }}</span>/mo*
                                            </span>
                                            @php } else { @endphp

                                            <span class="shared-main-price-tittle" id="EnterpriseThreeYearWhmcsUSD">
                                                <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.'WEB_HOSTING_ENTERPRISE_PRICE_36_USD') }}</span>/mo*
                                            </span>
                                            @php } @endphp
                                        </div>

                                        <div class="shared-plan-btm" id="EnterpriseThreeYearButtonText">
                                            {!!$EnterpriseThreeYearButtonText!!}
                                        </div>
                                        @php $SpecificationData = explode("\n",$ProductsPackageData[3]->txtSpecification); @endphp
                                        <ul class="shared-plan-features shared-plan-tooltip">
                                            @foreach($SpecificationData as $Specification)
                                            <div class="slide-toggle">
                                                @if(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                @elseif(strtolower(trim($Specification)) == "unlimited mysql db's" || strtolower(trim($Specification)) =="20 mysql db's")
                                                <li>
                                                    <div class="free_domain free_domain_black">{{$Specification}}
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
                                                 @elseif(strtolower(trim($Specification)) == "cpanel + 1 click installer")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "litespeed")
                                                <li class="feature-litespeed"><span>{{$Specification}}<span></li>
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif
                                            </div>
                                            @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See More Features</a>

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
                                            <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                        </div>
                                        @php } @endphp
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


</div>
</div>
</div>
</div>


<section class="hs-platform head-tb-p-40">
    <div class="hs-platform-bg">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Explore Cheap Hosting Solutions Tailored for Every <br> Platform and Purpose</h2>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-4 col-xl-4">
                    <div class="hs-platform-box">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/windows_hosting_icon_1.webp" alt="windows_hosting_icon_1">
                        </div>
                        <div class="hs-platform-tittle">
                            Windows Hosting
                        </div>
                        <div class="hs-platform-cnt">
                            Want to use MSSQL or ASP.NET?<br> Windows Hosting Should Be Your Choice!
                        </div>
                        <div class="hs-platform-prc-m">
                            Starting @ Just <span>₹90/mo</span>
                        </div>
                        <div class="hs-platform-explore-btn">
                            <button onclick="window.location.href='{{ url('/hosting/windows-hosting') }}'" title="Explore">Explore</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="hs-platform-box">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/wordpress_hosting_icon2.webp" alt="wordpress_hosting_icon2">
                        </div>
                        <div class="hs-platform-tittle">
                            WordPress Hosting
                        </div>
                        <div class="hs-platform-cnt">
                            Raving over your WordPress?<br> Boost it with Top WordPress Web hosting!
                        </div>
                        <div class="hs-platform-prc-m">
                            Starting @ Just <span>₹45/mo</span>
                        </div>
                        <div class="hs-platform-explore-btn">
                            <button onclick="window.location.href='{{ url('/hosting/wordpress-hosting') }}'" title="Explore">Explore</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="hs-platform-box">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/ecommerce_hosting_icon3.webp" alt="ecommerce_hosting_icon3">
                        </div>
                        <div class="hs-platform-tittle">
                            eCommerce Hosting
                        </div>
                        <div class="hs-platform-cnt">
                            Operating an Online Store?<br> eCommerce Hosting is Meant For You!
                        </div>
                        <div class="hs-platform-prc-m">
                            Starting @ Just <span>₹45/mo</span>
                        </div>
                        <div class="hs-platform-explore-btn">
                            <button onclick="window.location.href='{{ url('/hosting/ecommerce-hosting') }}'" title="Explore">Explore</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wh-server-location-img head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Experience Unmatched Speed and Reliability With Our Strategically Positioned Server Locations</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wh-server-location-img text-center">
                    <div class="wh-server-location-desk">
                        <img loading="lazy" src="../assets/images/web_hosting/server_location_map.webp" alt="server_location_map">
                    </div>
                    <div class="wh-server-location-mo">
                        <img loading="lazy" src="../assets/images/web_hosting/server_location_map_new.webp" alt="server_location_map">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pf-online-presn head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Professional Features for a Powerful Online Presence</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pf-online-presn-row">
                    <div class="pf-online-box pf-online-presn-box-1">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/domain_icon1.webp" alt="domain_icon1">
                        </div>
                        <div class="hs-platform-tittle">
                            Free .COM Domain
                        </div>
                        <div class="hs-platform-cnt">
                            Establish your digital foothold with a free .COM domain with web hosting plans.
                        </div>
                    </div>
                    <div class="pf-online-box pf-online-presn-box-2">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/website_builder_icon2.webp" alt="website_builder_icon2">
                        </div>
                        <div class="hs-platform-tittle">
                            Free Website Builder
                        </div>
                        <div class="hs-platform-cnt">
                            Craft your digital masterpiece effortlessly with our user-friendly Website Builder.
                        </div>
                    </div>
                    <div class="pf-online-box pf-online-presn-box-3">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/ssl_icon3.webp" alt="ssl_icon3">
                        </div>
                        <div class="hs-platform-tittle">
                            Free SSL Certificate
                        </div>
                        <div class="hs-platform-cnt">
                            Safeguard Your website and visitors, absolutely Free with web hosting.
                        </div>
                    </div>
                    <div class="pf-online-box pf-online-presn-box-4">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/business_email.webp" alt="business_email">
                        </div>
                        <div class="hs-platform-tittle">
                            Business Email
                        </div>
                        <div class="hs-platform-cnt">
                            Elevate your professionalism with personalized business email solutions.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="smart-wh-service head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex">
                <div class="smart-wh-left-col">
                    <div class="">
                        <h2 class="text_head">Get Smart With<br>Host IT Smart's Cheap Web Hosting Services</h2>
                    </div>
                    <div class="smart-wh-carousel">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-touch="false" data-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="smart-wh-cnt">
                                        <ul>
                                            <li>Ideal For Novices</li>
                                            <p>Start your business journey using Host IT Smart's world-class web hosting services. Even beginners can use our services easily and experience reliable performance & top-notch support.</p>
                                            <li>Perfect for Simple Business Websites</li>
                                            <p>Use Host IT Smart's web hosting, specially designed to empower simple business websites. Enjoy reliable performance and secured infrastructure with essential features to boost your online presence.</p>
                                            <li>Cheapest Month-to-Month Web Hosting</li>
                                            <p>If you want an affordable hosting solution for your business, try Host IT Smart's month-to-month web hosting today. Crack our introductory deals without committing long years. Great rates, quality, and performance are assured.</p>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="smart-wh-cnt">
                                        <ul>
                                            <li>Ideal For Maintaining Affordable Renewal Rates</li>
                                            <p>Say goodbye to unexpected price hikes and hello to predictable, budget-friendly renewal rates. By choosing our hosting plans, you can rest assured knowing that you are getting the best value for your money.</p>
                                            <li>Ideal Hosting Offering Top-Notch Support</li>
                                            <p>Experience Host IT Smart's unparalleled support with web hosting services. We pride ourselves on delivering top-notch support to our customers, ensuring their online journey is smooth and worry-free.</p>
                                            <li>Speedy Yet Pocket-friendly Hosting Services</li>
                                            <p>Host IT Smart offers a perfect blend of speed and affordability with its web hosting service. Enjoy lightning-fast performance without exorbitant rates & experience a seamless online experience for your business.</p>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="smart-wh-cnt">
                                        <ul>
                                            <li>Best for Websites Focused in Asia & Europe</li>
                                            <p>Strengthen your brand visibility with Host IT Smart's specialized web hosting services, focused on Asian and European websites. Leverage optimized performance and support for your region.</p>
                                            <li>Unbeatable Introductory Pricing</li>
                                            <p>Kickstart your online business journey with Host IT Smart's unbeatable web hosting introductory pricing. Don't rush for long-term commitments when you can experience exceptional value and performance at a discounted price. Give it a try today.</p>
                                            <li>Intuitive and User-Centric Website Builder Tool</li>
                                            <p>Host IT Smart's intuitive and user-centric website builder tool with web hosting plans brings your creativity alive. Build stunning and flawless websites with our user-friendly builder that caters to your unique design needs and preferences.</p>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button class="smart-wh-prev-btn" type="button" data-target="#carouselExampleControls" data-slide="prev">
                                <img src="../assets/images/web_hosting/left_arrow.webp" title="Previous" alt="left_arrow">
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="smart-wh-next-btn" type="button" data-target="#carouselExampleControls" data-slide="next">
                                <img src="../assets/images/web_hosting/right_arrow.webp" title="Next" alt="right_arrow">
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex">
                <div class="smart-wh-right-col">
                    <img loading="lazy" src="../assets/images/web_hosting/web_hosting_services_box.webp" alt="web_hosting_services_box">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ds-self-manage-assist wh-control-pnl head-tb-p-40">
    <div class="container">
        <div class="wh-control-panel-box">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="wp-pnl-first">
                        <div class="wp-pml-first-img">
                            <img loading="lazy" src="../assets/images/web_hosting/control_panel_box.webp" alt="control_panel_box">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2 class="text_head">Let Our Robust and User-Friendly Control Panel
                            Simplify Your Website Management</h2>
                        <p>Manage your website effortlessly with our robust and user-friendly control panel. Our control panel enhances your online business presence while ensuring smooth operations and an enriched user experience.</p>
                        <p>As a Host It Smart user, your privilege is to experience seamless website management with our advanced, robust, and user-friendly control panel.</p>
                        <p>Our control panel simplifies tasks like website creation, domain management, email setup, and more. What more can you expect when you have a series of power-packed features to manage your online presence effortlessly? We travel that extra mile to smoothen your operations and deliver optimal performance while you focus on elevating your business to the next level.</p>
                    </div>
                    <div class="wn-features-ul">
                        <div class="wn-features-cnt">
                            <ul>
                                <li><span class="wn-features-cnt-icon">One-click Installation</li>
                                <li><span class="wn-features-cnt-icon">Domain management tools</li>
                                <li><span class="wn-features-cnt-icon">Email management functionalities</li>
                                <li><span class="wn-features-cnt-icon">Simple File management system</li>
                                <li><span class="wn-features-cnt-icon">Database Management tools</li>
                                <li><span class="wn-features-cnt-icon">Combined With Security Features</li>
                                <li><span class="wn-features-cnt-icon">Offers Website Statistics & Analytics</li>
                                <li><span class="wn-features-cnt-icon">Free Website Builder Integration</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="empower-web-speed head-tb-p-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="text_head">Empower Your Online Presence With Our Blazing Website Speed</h2>
                    <p>We understand the pain most businesses face during the slow website loading times and the damage it causes to their online presence. Even the visitors are reluctant to return to your website.</p>
                    <p>Align with Host IT Smart’s web hosting services in india to experience blazing website speed that accelerates your online presence & bid farewell to boredom and slow loading times. Thanks to our top-notch infrastructure, which has helped millions of businesses deliver seamless user experiences, boosted their website's efficiency, empowered their online presence, and created brand credibility that is par excellence.</p>
                    <p>We deploy speed optimization techniques on our robust hosting servers to ensure the quick loading of your websites. Keeping your visitors engaged and happy is the primary purpose behind offering superior speed and enhanced server performance.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="emp-web-speed-right-col">
                    <img loading="lazy" src="../assets/images/web_hosting/blazing_website_speed.webp" alt="blazing_website_speed">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wh-just-click head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Just click it and pick it!</h2>
            <p class="text-center">Simplify your website development…Install any of these Amazing Apps with One-Click!</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wh-just-click-img text-center">
                    <img loading="lazy" src="../assets/images/web_hosting/one_click_box.webp" alt="one_click_box">
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade more_feature" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content more_feature_modal">
            <h2 class="htwo-prime1 plntbl-hdrttl">Host IT Smart Shared Hosting Features</h2>
            <div class="">
                <div class="more-features-close-icon" data-dismiss="modal" title="Close">x</div>
                <table class="table-responsive">
                    <thead>
                    </thead>

                    <tbody>
                        <tr class="more-features-shadow">
                            <th class=""></th>
                            <th>BASIC</th>
                            <th>ESSENTIAL</th>
                            <th>PROFESSIONAL</th>
                            <th>ENTERPRISE</th>
                        </tr>
                        <tr>
                            <td>Host Website </td>
                            <td>1</td>
                            <td>5</td>
                            <td>20</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>SSD Disk Space </td>
                            <td>5</td>
                            <td>20</td>
                            <td>50</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Free Domain </td>
                            <td> <i class="more-features-no-icon"></i></td>
                            <td> <i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Free SSL </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Free Backup </td>
                            <td><i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Control Panel</td>
                            <td>Plesk</i></td>
                            <td>cPanel</i></td>
                            <td>cPanel</td>
                            <td>cPanel</td>
                        </tr>
                        <tr>
                            <td>Website Builder </td>
                            <td><i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>1-Click Installer </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>WordPress Optimized </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Bandwidth </td>
                            <td>50GB</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Email Accounts </td>
                            <td>5</td>
                            <td>10</td>
                            <td>60</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>MySQL DB's </td>
                            <td>2</td>
                            <td>10</td>
                            <td>20</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>SSD Disk Space </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Subdomains </td>
                            <td>5</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                        </tr>
                       {{--  <tr>
                            <td>Parked domains </td>
                            <td>5</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                        </tr> --}}
                        <tr>
                            <td>FTP users </td>
                            <td>5</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Supports Node.js</td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td id="see_more_features">Supports Python</td>
                            <td><i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr class="more-features-plan-features" id="see_more_features">
                            <td colspan="5">Server Features</td>
                        </tr>
                        <tr>
                            <td>Apache with LiteSpeed </td>
                            <td><i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>HTTP/2 </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>PHP 5.5, 5.6, 7.0, 7.1, 7.2, 7.3, 7.4, 8.0 ,8.1</td>
                            <td>(7.1,7.2,7.3,7.4,8.0,8.1)</i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>MySQL 8.x.x </td>
                            <td>(Mariadb 10.x)</i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>CGI </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Javascript </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Leverage Browser Caching </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Gzip Compression </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>KeepAlive </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>

                    </tbody>


                    <tbody>
                        <tr class="more-features-plan-features">
                            <td colspan="5">cPanel Features</td>
                        </tr>
                        <tr>
                            <td>FTP Account Management </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Virus Scanner </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>IP Deny Manager </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Index Manager </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Leech Protect </td>
                            <td><i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Mailman List Manager </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>MIME Types Manager </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Network Tools </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Redirect Manager </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Change Language </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Multiple PHP Support </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Customizable php.ini </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Cron Jobs </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Simple DNS Zone Editor </td>
                            <td><i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Advanced DNS Zone Editor </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Backup Manager </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Git Version Control </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Resource Usage Monitoring </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>User Manager </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Style and Preferences Management </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Custom Error Pages </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>PHP MyAdmin </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>RAM</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>Concurrent connections (EP) </td>
                            <td>20</td>
                            <td>20</td>
                            <td>40</td>
                            <td>60</td>
                        </tr>
                        <tr>
                            <td>Number of processes (nPROC) </td>
                            <td>40</td>
                            <td>40</td>
                            <td>80</td>
                            <td>120</td>
                        </tr>
                        <tr>
                            <td>IO Limit </td>
                            <td>1 MBPS</td>
                            <td>1 MBPS</td>
                            <td>1 MBPS</td>
                            <td>1 MBPS</td>
                        </tr>
                        <tr>
                            <td>File (Inode) Limit </td>
                            <td>50000</td>
                            <td>75000</td>
                            <td>100000</td>
                            <td>200000</td>
                        </tr>

                    </tbody>

                    <tbody>
                        <tr class="more-features-plan-features">
                            <td colspan="5">Security Solutions</td>
                        </tr>
                        <tr>
                            <td>Network Firewall </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Web Application Firewall </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Brute-force Protection </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Exploits and Malware Protect </td>
                            <td><i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Malware Scan and Reports </td>
                            <td><i class="more-features-no-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Two-Factor Authentication (2FA </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        {{-- <tr>
            <td>BitNinja Server Security </td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
            <td><i class="more-features-yes-icon"></i></td>
        </tr> --}}
                        <tr>
                            <td>Account Isolation </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>CageFS Security </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>CloudLinux Servers </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Power / Network / Hardware Redundancy </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>

                    </tbody>

                    <tbody>
                        <tr class="more-features-plan-features">
                            <td colspan="5">Install Popular Software with 1-Click</td>
                        </tr>
                        <tr>
                            <td>WordPress </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Joomla </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>phpBB </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>SMF </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Drupal </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Blogs </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Portals </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Content Management System </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Customer Support </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Discussion Boards </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>eCommerce </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Site Builders </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>

                    </tbody>

                    <tbody>
                        <tr class="more-features-plan-features">
                            <td colspan="5">Email Features</td>
                        </tr>
                        <tr>
                            <td>Email Accounts </td>
                            <td>5</td>
                            <td>10</td>
                            <td>60</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Email Forwarders </td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Email Autoresponders </td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Attachment Limit </td>
                            <td>25 MB</td>
                            <td>25 MB</td>
                            <td>25 MB</td>
                            <td>25 MB</td>
                        </tr>
                        <tr>
                            <td>Webmail (Horde & RoundCube) </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>SMTP, POP3, IMAP </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>SpamAssassin </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Mailing Lists </td>
                            <td>10</td>
                            <td>20</td>
                            <td>20</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Catch-all Emails </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Email Aliases </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>SPF and DKIM Support </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Domain Keys </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>BoxTrapper </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Individual Mailbox Storage </td>
                            <td>250 MB</td>
                            <td>250 MB</td>
                            <td>250 MB</td>
                            <td>250 MB</td>
                        </tr>
                        <tr>
                            <td>Overall Mailbox Storage </td>
                            <td>1 GB</td>
                            <td>2 GB</td>
                            <td>10 GB</td>
                            <td>50 GB</td>
                        </tr>
                        <tr>
                            <td>Email Sends Per Hour </td>
                            <td>20</td>
                            <td>20</td>
                            <td>20</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>CSV Import (Email & Forwarders) </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Mobile Compatibility </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Email Calendar </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Webmail in Gmail </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>
                        <tr>
                            <td>Outlook / Thunderbird / Mac Mail </td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                            <td><i class="more-features-yes-icon"></i></td>
                        </tr>

                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>
<div class="vps-features head-tb-p-40" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <div class="section-heading">
                    <h2 class="text_head text-center" data-aos="fade-up">Features of Our Web Hosting</h2>
                </div>
                @php
                $featureMainDivClass;
                $featureIconDivClass;
                // if ($uagent == "mobile") {
                // $featureMainDivClass="features-start features-start-mob d-md-none d-block";
                // $featureIconDivClass="feature-icon";
                // }else{
                $featureMainDivClass="features-start d-md-block";
                $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                // }
                @endphp

                <div class="{{$featureMainDivClass}}">

                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap justify-content-center">

                            @foreach($FeaturesData as $Features)

                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="{{$featureIconDivClass}}">

                                        <img class="win-vps-features-icon" src="../assets/images/web_hosting/{{$Features->varIconClass}}.webp" alt="{{$Features->varIconClass}}" loading="lazy">

                                    </div>

                                    <h3>{{$Features->varTitle}}</h3>
                                    <div class="content">{!! $Features->varShortDescription !!}</div>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.testimonial_section')
@include('template.'.$themeversion.'.faq-section')
@include('template.'.$themeversion.'.two-hosting-add')
<script>
$(document).ready(function(){$('#exampleModal').on('shown.bs.modal',function(){setTimeout(function(){var targetSection=document.getElementById('see_more_features');if(targetSection){targetSection.scrollIntoView({behavior:'smooth',block:'start'})}},300)})})
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
@endsection