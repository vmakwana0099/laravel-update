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
        <div class="container-fluid">
            <div class="shared-plan-bx-pd">
            <div class="section-heading">
                <h2 class="text_head text-center">Choose & Buy Your Desired Web Hosting Package</h2>
                <p class="text-center">Go Local or Global with Cheap Web Hosting in India & Canada!</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="wh-server-location-tab">
                        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button title="India" class="nav-link active" id="loc1" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="changeLocation('India');">
                                    <img loading="lazy" src="../assets/images/web_hosting/india-icons.webp" alt="india-icons"> India</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button title="Canada" class="nav-link" id="loc2" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="changeLocation('Canada');">
                                    <img loading="lazy" src="../assets/images/web_hosting/canada-icons.webp" alt="canada-icons"> Canada</button>
                            </li>
                           {{--  <li class="nav-item" role="presentation">
                                <button title="Germany" class="nav-link" id="loc3" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="changeLocation('Germany');">
                                    <img loading="lazy" src="../assets/images/web_hosting/germany-icons.webp" alt="germany-icons"> Germany</button>
                            </li> --}}
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
                                <div class="col-lg-3">
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-pln-box">
                                        <div class="shared-plan-price">
                                            <div class="shared-plan-nm">
                                                VPS - SM 1
                                            </div>
                                            <div class="shared-plan-cut-prc">
                                                <span class="cut-price">₹840.00</span>
                                                <span class="cut-prc-disc">Save 50%</span>
                                            </div>
                                            <div class="shared-main-price">
                                                ₹<span>420.00</span>/mo*
                                            </div>
                                            <div class="shared-plan-btn">
                                                <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a>
                                            </div>
                                            <div class="shared-plan-renew">
                                                Renews at ₹128/mo after 3 years. Cancel anytime.
                                            </div>

                                        </div>
                                        <div class="shared-plan-cnt">
                                            <ul>
                                                <li>Host 1 Website</li>
                                                <li>5 GB SSD Disk Space</li>
                                                <li class="cross-icon-li">Free Domain</li>
                                                <li>Linux Technology</li>
                                                <li>Free SSL</li>
                                                <li class="cross-icon-li">Free Backup</li>
                                                <li>Plesk</li>
                                                <li class="cross-icon-li">Terminal Access</li>
                                                <li class="cross-icon-li">Website Builder</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-3">
                                <div class="shared-plan-box-main shared-plan-most-popular" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-pln-box">
                                        <div class="shared-most-popular-cnt">
                                            MOST POPULAR
                                        </div>
                                        <div class="shared-plan-price">
                                            <div class="shared-plan-nm">
                                                VPS - SM 1
                                            </div>
                                            <div class="shared-plan-cut-prc">
                                                <span class="cut-price">₹980.00</span>
                                                <span class="cut-prc-disc">Save 50%</span>
                                            </div>
                                            <div class="shared-main-price">
                                                ₹<span>880.00</span>/mo*
                                            </div>
                                            <div class="shared-plan-btn">
                                                <a href="javascript:void(0)" class="primary-btn-sq">Choose Plan</a>
                                            </div>
                                            
                                            <div class="shared-plan-renew">
                                                Renews at ₹128/mo after 3 years. Cancel anytime.
                                            </div>
                                        </div>
                                        <div class="shared-plan-cnt">
                                            <ul>
                                                <li>Host 1 Website</li>
                                                <li>5 GB SSD Disk Space</li>
                                                <li class="cross-icon-li">Free Domain</li>
                                                <li>Linux Technology</li>
                                                <li>Free SSL</li>
                                                <li class="cross-icon-li">Free Backup</li>
                                                <li>Plesk</li>
                                                <li class="cross-icon-li">Terminal Access</li>
                                                <li class="cross-icon-li">Website Builder</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-3">
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-pln-box">
                                        <div class="shared-plan-price">
                                            <div class="shared-plan-nm">
                                                VPS - SM 1
                                            </div>
                                            <div class="shared-plan-cut-prc">
                                                <span class="cut-price">₹1280.00</span>
                                                <span class="cut-prc-disc">Save 50%</span>
                                            </div>
                                            <div class="shared-main-price">
                                                ₹<span>1820.00</span>/mo*
                                            </div>
                                            <div class="shared-plan-btn">
                                                <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a>
                                            </div>
                                            
                                            <div class="shared-plan-renew">
                                                Renews at ₹128/mo after 3 years. Cancel anytime.
                                            </div>
                                        </div>
                                        <div class="shared-plan-cnt">
                                            <ul>
                                                <li>Host 1 Website</li>
                                                <li>5 GB SSD Disk Space</li>
                                                <li class="cross-icon-li">Free Domain</li>
                                                <li>Linux Technology</li>
                                                <li>Free SSL</li>
                                                <li class="cross-icon-li">Free Backup</li>
                                                <li>Plesk</li>
                                                <li class="cross-icon-li">Terminal Access</li>
                                                <li class="cross-icon-li">Website Builder</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-3">
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-pln-box">
                                        <div class="shared-plan-price">
                                            <div class="shared-plan-nm">
                                                VPS - SM 1
                                            </div>
                                            <div class="shared-plan-cut-prc">
                                                <span class="cut-price">₹1880.00</span>
                                                <span class="cut-prc-disc">Save 50%</span>
                                            </div>
                                            <div class="shared-main-price">
                                                ₹<span>1480.00</span>/mo*
                                            </div>
                                            <div class="shared-plan-btn">
                                                <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a>
                                            </div>
                                            
                                            <div class="shared-plan-renew">
                                                Renews at ₹128/mo after 3 years. Cancel anytime.
                                            </div>
                                        </div>
                                        <div class="shared-plan-cnt">
                                            <ul>
                                                <li>Host 1 Website</li>
                                                <li>5 GB SSD Disk Space</li>
                                                <li class="cross-icon-li">Free Domain</li>
                                                <li>Linux Technology</li>
                                                <li>Free SSL</li>
                                                <li class="cross-icon-li">Free Backup</li>
                                                <li>Plesk</li>
                                                <li class="cross-icon-li">Terminal Access</li>
                                                <li class="cross-icon-li">Website Builder</li>
                                            </ul>
                                        </div>
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
                                                @elseif(strtolower(trim($Specification)) == '25,000 visits monthly')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
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
                                                @elseif(strtolower(trim($Specification)) == '50,000 visits monthly')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
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
                                                @elseif(strtolower(trim($Specification)) == '1,00,000 visits monthly')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
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
</div>

<section class="wp-ecommerce head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">Did You Know?</h2>
            {{-- <p>Sell smarter with our eCommerce-optimized WordPress hosting. It ensures a smooth online shopping experience with advanced security features.</p> --}}
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="wp-ecom-img">
                    <img width="480px" height="auto" src="../assets/images/web_hosting/web_hosting_tips.webp" alt="web_hosting_ecomm">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wp-ecom-cnt">
                    <div class="wp-ecom-box">
                        <span>Speed Sells</span>
                        <p>In 2024 alone, slow-loading websites caused businesses to lose $2.6 billion in sales! Sounds crazy, right? Don’t let yours be one of them. Choose Host IT Smart for fast and cheap hosting to keep your website quick, your visitors happy, and your sales growing.</p>
                    </div>
                    <div class="wp-ecom-box">
                        <span>Cyber Threats Are Real</span>
                        <p>In 2024, 43% of cyberattacks are targeting small businesses like yours. That means if your website isn’t properly protected, it could easily become a target for hackers. Host in our secured environment & keep your data secure & build trust with your visitors.</p>
                    </div>
                    <div class="wp-ecom-box">
                        <span>Downtime Cost is Higher</span>
                        <p>44% of businesses reveal that hourly downtime can cost anywhere from $1 million to more than $5 million. Also, 91% of organizations report that an hour of downtime on critical servers or apps leads to losses of over $300,000. Seems scary, right? That’s why our reliable hosting and server uptime is non-negotiable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="hs-platform head-tb-p-40">
    <div class="hs-platform-bg">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Explore Cheap Web Hosting Solutions in India & Canada Tailored for Every Platform and Purpose</h2>
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
                            <a href="https://www.hostitsmart.com/hosting/windows-hosting" class="primary-btn-sq" title="Explore Windows Hosting">
                                Explore Windows Hosting
                            </a>
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
                             <a href="https://www.hostitsmart.com/hosting/wordpress-hosting" class="primary-btn-sq" title="Explore WordPress Hosting">
                                Explore WordPress Hosting
                            </a>
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
                            <a href="https://www.hostitsmart.com/hosting/ecommerce-hosting" class="primary-btn-sq" title="Explore eCommerce Hosting">
                                Explore eCommerce Hosting
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="hs-platform-box">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/VPS-hosting.webp" alt="VPS-hosting">
                        </div>
                        <div class="hs-platform-tittle">
                            VPS Hosting
                        </div>
                        <div class="hs-platform-cnt">
                            Great Server Performance at Affordable Costs
                        </div>
                        <div class="hs-platform-prc-m">
                            Starting @ Just <span>₹420/mo</span>
                        </div>
                        <div class="hs-platform-explore-btn">                           
                            <a href="https://www.hostitsmart.com/servers/vps-hosting" class="primary-btn-sq" title="Explore VPS Hosting">
                                Explore VPS Hosting
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="hs-platform-box">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/windows_vps_hosting.webp" alt="windows_vps_hosting">
                        </div>
                        <div class="hs-platform-tittle">
                            Windows VPS
                        </div>
                        <div class="hs-platform-cnt">
                            Benefit of Power & Flexibility at the best costs
                        </div>
                        <div class="hs-platform-prc-m">
                            Starting @ Just <span>₹825/mo</span>
                        </div>
                        <div class="hs-platform-explore-btn">
                            
                             <a href="https://www.hostitsmart.com/servers/windows-vps-hosting" class="primary-btn-sq" title="Explore Windows VPS">
                                Explore Windows VPS
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="hs-platform-box">
                        <div class="hs-platform-img-round">
                            <img loading="lazy" src="../assets/images/web_hosting/dedicated-server.webp" alt="dedicated-server">
                        </div>
                        <div class="hs-platform-tittle">
                            Dedicated Server
                        </div>
                        <div class="hs-platform-cnt">
                            With great Server Autonomy comes great performance!
                        </div>
                        <div class="hs-platform-prc-m">
                            Starting @ Just <span>₹5202/mo</span>
                        </div>
                        <div class="hs-platform-explore-btn">                            
                            <a href="https://www.hostitsmart.com/servers/dedicated-servers" class="primary-btn-sq" title="Explore Dedicated Server">
                                Explore Dedicated Server
                            </a>
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
            <h2 class="text_head text-center">Stay Fast and Connected With Our Well-Placed Servers!</h2>
            <p class="text-center">Our server location of web hosting services are in India & Canada</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wh-server-location-img text-center">
                    <div class="wh-server-location-desk">
                        <img loading="lazy" src="{{url('assets/images/web_hosting/server_location_map2.webp')}}" alt="server_location_map">
                    </div>
                    <!-- <div class="wh-server-location-mo">
                        <img loading="lazy" src="../assets/images/web_hosting/server_location_map_new.webp" alt="server_location_map">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <div class="g-suite-lists head-tb-p-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-heading">
                                <h2 class="text_head text-center">Why Choosing the Best Web Hosting is Crucial <br>
                                For Your Business
                             </h2>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">1</span>
                                        <div class="g-list-title">Speed That Impresses Your Visitors</div>
                                        <span>In today’s fast-paced world, users expect websites to load in seconds. A reliable web hosting service like ours ensures faster loading times, keeping visitors engaged and reducing bounce rates.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">2</span>
                                        <div class="g-list-title">Protect Your Digital Assets</div>
                                        <span>A secure hosting provider offers features like SSL certificates, firewalls, and regular updates to protect your website from cyber threats. Security is vital for protecting sensitive data and building customer trust. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">3</span>
                                        <div class="g-list-title">Uptime You Can Rely On</div>
                                        <span>Frequent downtime can harm your business reputation and lead to lost opportunities. A good hosting provider offers excellent uptime guarantees, ensuring your website remains accessible around the clock. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">4</span>
                                        <div class="g-list-title">Scalable Solutions for Growing Businesses</div>
                                        <span>As your business grows, your hosting needs will change. The right hosting allows for easy scalability, ensuring your website performs optimally, even during traffic surges. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">5</span>
                                        <div class="g-list-title">Support When You Need It Most</div>
                                        <span>Technical issues can arise anytime; prompt support is crucial to resolving them. Quality hosting services like ours provide 24/7 expert assistance, minimizing downtime and ensuring smooth operations. </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <span class="list-num">6</span>
                                        <div class="g-list-title">Better SEO and Online Visibility</div>
                                        <span>Fast and reliable websites rank better on search engines. A robust hosting solution improves SEO performance, driving more organic traffic to your website.
                                        </span>
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">7</span>
                                        <div class="g-list-title">Simplified Business Operations</div>
                                        <span>Web hosting isn’t just about storage; it includes tools for managing emails, backups, and analytics. With efficient hosting, managing your online presence becomes seamless and stress-free.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">8</span>
                                        <div class="g-list-title">Regular Backups for Peace of Mind</div>
                                        <span>Data loss can result from unexpected errors or cyberattacks. The best hosting providers offer automatic backups, ensuring you can quickly recover and restore your site. </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">9</span>
                                        <div class="g-list-title">Long-Term Cost Efficiency</div>
                                        <span>Investing in quality hosting saves money in the long run by minimizing unexpected expenses like downtime and data recovery costs. It’s a smart choice for sustaining your business online. </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">10</span>
                                        <div class="g-list-title">Build a Credible Online Presence</div>
                                        <span>A fast, secure, and reliable website enhances your brand’s credibility. Customers are more likely to trust and engage with businesses that offer a seamless online experience. </span>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div> --}}

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
                            Get a free .COM domain with a web hosting plan and build your online presence easily.
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
                            Craft your digital masterpiece effortlessly with our beginner-friendly Website Builder.
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
                            Get a Free SSL with your hosting to keep your website and visitors safe.
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
                            Look more professional with your own personalized business Email.
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
                                            <p>Start your business journey using Host IT Smart's world-class cheapest web hosting services, where beginners can also use our services easily and experience reliable performance with top-notch support.</p>
                                            <li>Perfect for Simple Business Websites</li>
                                            <p>Use Host IT Smart's cheapest web hosting, specially designed to empower your simple business websites & enjoy power-packed performance with secured infrastructure to boost your online presence.</p>
                                            <li>Cheapest Month-to-Month Web Hosting</li>
                                            <p>If you are looking for a cheap web hosting solution for your business, you can try Host IT Smart's month-to-month web hosting at the best cost without committing for long years.</p>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="smart-wh-cnt">
                                        <ul>
                                            <li>Ideal For Maintaining Affordable Renewal Rates</li>
                                            <p>Just say goodbye to unexpected high price hikes at renewal time. With our budget-friendly renewal rates, you can rest assured that you will get the best value for your money for a lifetime.</p>
                                            <li>Ideal Hosting Offering Top-Notch Support</li>
                                            <p>Experience Host IT Smart's world-class 24/7 Indian support with our amazing web hosting services that deliver top-notch support to customers, ensuring their online journey is smooth and worry-free.</p>
                                            <li>Speedy Yet Pocket-friendly Hosting Services</li>
                                            <p>Host IT Smart offers a perfect blend of speed and affordability with its cheap web hosting service in India & Canada to get lightning-fast performance without expensive pricing & experiencing a seamless online experience for your business.</p>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="smart-wh-cnt">
                                        <ul>
                                            <li>Best for Websites Focused in Asia</li>
                                            <p>You can strengthen your brand visibility with Host IT Smart's specialized cheap web hosting India services focused on Asian countries by leveraging optimized performance and support for your region.</p>
                                            <li>Unbeatable Introductory Pricing</li>
                                            <p>Start your online journey with Host IT Smart's unbeatable web hosting introductory pricing. Just go for long-term commitments at an exceptional value and performance at an amazing discounted price. </p>
                                            <li>Intuitive and User-Centric Website Builder Tool</li>
                                            <p>Host IT Smart's simple and user-centric website builder tool with web hosting plans brings your creativity alive to build stunning websites that cater to your unique design needs and preferences.</p>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button class="smart-wh-prev-btn" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <img src="../assets/images/web_hosting/left_arrow.webp" title="Previous" alt="left_arrow">
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="smart-wh-next-btn" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
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
                        <h2 class="text_head">Offering a User-Friendly Control Panel For Control Without the Tech Headache!
                        </h2>
                        <p>It is quite important that managing your dream website should be super easy!</p>
                        <p>That’s exactly what you get with our easy-to-use and powerful control panel to create a website, manage your domain, set up emails, or keep things running smoothly.</p>
                        <p>At Host IT Smart, we offer user-friendly panels like Plesk (with our Basic hosting plan) and cPanel (with our other hosting plans), so you can handle everything with just a few clicks & put all the tools you need in one place to make your online journey smoother and your business stronger.</p>
                    </div>
                    <div class="wn-features-ul">
                        <div class="wn-features-cnt">
                            <ul>
                                <li><span class="wn-features-cnt-icon">One-click Installation</li>
                                <li><span class="wn-features-cnt-icon">Domain Management Tools</li>
                                <li><span class="wn-features-cnt-icon">Email Management Functionalities</li>
                                <li><span class="wn-features-cnt-icon">Simple File Management System</li>
                                <li><span class="wn-features-cnt-icon">Database Management Tools</li>
                                <li><span class="wn-features-cnt-icon">Combined With Security Features</li>
                                <li><span class="wn-features-cnt-icon">Offers Website Statistics & Analytics</li>
                                <li><span class="wn-features-cnt-icon">Support For Multiple Programming Languages</li>
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
                    <h2 class="text_head">Empowering Your Online Presence with Blazing Website Speed</h2>
                    <p>Nobody likes waiting for longgg! When your website takes forever to load, visitors lose patience & you lose potential customers; let’s be honest, they probably won’t come back.</p>
                    <p>That’s where we come in.</p>
                    <p>At Host IT Smart, we are all about speed! Our web hosting services are designed to give your website a lightning-fast boost that offers a smooth, snappy experience for keeping people coming back, creating more trust and a stronger online presence.</p>
                    <p>Till now, we have helped 1000+ businesses across India to create seamless websites by improving performance and building stronger online credibility.</p>
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
            <div class="table-responsive">
                <div class="more-features-close-icon" data-bs-dismiss="modal" title="Close">x</div>
                <table class="w-100">
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
                    <h2 class="text_head text-center" data-aos="fade-up">Why Choose Our Web Hosting?</h2>
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

                                    <span>{{$Features->varTitle}}</span>
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
<div class="dy-money-back-grnt head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dy-money-back-grnt-box text-center">
                    <h2>Looking For Something More Powerful?</h2>
                    <p>We have Indian VPS Hosting for you, boosting your online project without breaking the bank!</p>
                    <a href="{{url('/servers/vps-hosting-india')}}" title="Discover Google Workspace">Explore VPS in India</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('template.'.$themeversion.'.testimonial_section')

@include('template.'.$themeversion.'.support_section_home')

<div class="dy-money-back-grnt head-tb-p-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dy-money-back-grnt-box text-center">
                            <h2>Want to Work Smarter, Not Harder?</h2>
                            <p>Try Google Workspace that gives you all the tools you need in one place!</p>
                            <a href="https://www.hostitsmart.com/email/google-workspace-india" title="Discover Google Workspace">Discover Google Workspace</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('template.'.$themeversion.'.faq-section')
{{-- @include('template.'.$themeversion.'.two-hosting-add') --}}
<script>
$(document).ready(function(){$('#exampleModal').on('shown.bs.modal',function(){setTimeout(function(){var targetSection=document.getElementById('see_more_features');if(targetSection){targetSection.scrollIntoView({behavior:'smooth',block:'start'})}},300)})})
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the buttons and the div to be hidden
        const canadaButton = document.getElementById('loc2');
        // const germanyButton = document.getElementById('loc3');
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
        // germanyButton.addEventListener('click', hideVpsPlanDiv);
        indiaButton.addEventListener('click', showVpsPlanDiv);
    });
</script>
@endsection