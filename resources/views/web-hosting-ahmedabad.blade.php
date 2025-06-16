@extends('layouts.app')
@section('content')

<?php
// echo '<pre>'; print_r($ProductBanner); exit;

?>
<div class="domain_main vps_main linux-main">
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

    <div class="vps-plan-main-div head-tb-p-40" id="web_hosting_plan">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Choose & Buy Your Desired Web Hosting Package</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <br />
                    <div class="wh-server-location-tab">
                         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button title="India" class="nav-link active" id="loc1" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="changeLocation('India');">
                                    <img loading="lazy" src="../assets/images/web_hosting/india-icons.webp" alt="india-icons"> India</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button title="Canada" class="nav-link" id="loc2" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="changeLocation('Canada');">
                                    <img loading="lazy" src="../assets/images/web_hosting/canada-icons.webp" alt="canada-icons" > Canada</button>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <button title="Germany" class="nav-link" id="loc3" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="changeLocation('Germany');">
                                    <img loading="lazy" src="../assets/images/web_hosting/germany-icons.webp" alt="germany-icons"> Germany</button >
                            </li> --}}
                        </ul>
                        <!-- <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">Start your business journey using Host IT Smart's world-class web hosting services. Even beginners can use our services easily and experience reliable performance & top-notch support.

                                Perfect for Simple Business Websites
                                Use Host IT Smart's web hosting, specially designed to empower simple business websites. Enjoy reliable performance and secured infrastructure with essential features to boost your online presence.</div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">Say goodbye to unexpected price hikes and hello to predictable, budget-friendly renewal rates. By choosing our hosting plans, you can rest assured knowing that you are getting the best value for your money.

                                Ideal Hosting Offering Top-Notch Support
                                Experience Host IT Smart's unparalleled support with web hosting services. We pride ourselves on delivering top-notch support to our customers, ensuring their online journey is smooth and worry-free.</div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">Strengthen your brand visibility with Host IT Smart's specialized web hosting services, focused on Asian and European websites. Leverage optimized performance and support for your region.

                                Unbeatable Introductory Pricing
                                Kickstart your online business journey with Host IT Smart's unbeatable web hosting introductory pricing. Don't rush for long-term commitments when you can experience exceptional value and performance at a discounted price. Give it a try today.</div>
                        </div> -->
                    </div>
                   
                    
                </div>
                <script type="text/javascript">
                    function changeLocation(locstr) {
                        if(locstr == "Canada" || locstr == "Germany"){
                            $('.feature-litespeed').hide();
                        }else{
                            $('.feature-litespeed').show();                            
                        }
                        $('input[id^="location"]').each(function(i, ele) {
                            $(this).val(locstr);
                            console.log(locstr + " " + $(this).attr("id"));
                        });
                    }
                </script>
                <!-- <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='yearshow'>
                    <ul class="nav nav-pills nav-vps-hosting @if($ProductBanner->id == 7) pb-10 @endif">
                        <li><a data-bs-toggle="pill" href="#vps-plan0" title="1 Month" id='onemonth'>1 Month @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan1" title="1 year" id='oneyear'>1 year @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan2" title="2 years" id='twoyear'>2 years @if(!empty($ProductBanner->varOfferTextTwoYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextTwoYear}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan3" title="3 years" id='threeyear' class="active show">3 years @if(!empty($ProductBanner->varOfferTextThreeYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeYear}}</span></span>@endif</a></li>
                    </ul>
                </div> -->

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
                <div class="tab-content {{$mainclassssl}}">
           
            <!--This Code for Three Year-->
            <div id="vps-plan3" class="tab-pane active show">
                <div class="plan-main-div">
                    <div class="row {{ $plan_row}}">
                        {{-- basic --}}
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
                                    {{-- <div class="freedom-sale-offer">+15 Days Free</div> --}}
                                    <div class="shared-plan-btm" id="StarterThreeYearButtonText">
                                        {!!$BasicThreeYearButtonText!!}
                                    </div>
                                    @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                    <ul class="shared-plan-features shared-plan-tooltip">
                                        @foreach($SpecificationData as $Specification)
                                        <div class="slide-toggle">
                                            @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain')
                                            <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                            
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

                                            @elseif(strtolower(trim($Specification)) == "10 databases")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                        </span>
                                                    </div>
                                                </li>

                                            @elseif(strtolower(trim($Specification)) == '10,000 visits monthly')
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
                                                        </span>
                                                    </div>
                                                </li>

                                        @elseif(strtolower(trim($Specification)) == "supports python")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13
                                                   
                                                </span>
                                            </div>
                                        </li>

                                            @else
                                            <li><span>{{$Specification}}</span></li>
                                            @endif
                                        </div>
                                        @endforeach
                                    </ul>


                                    <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>

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
                                    {{-- <div class="freedom-sale-offer">+15 Days Free</div> --}}
                                    <div class="shared-plan-btm" id="PerformanceThreeYearButtonText">
                                        {!!$EssentialThreeYearButtonText!!}
                                    </div>
                                    @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
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
                                                <span class="domain_tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x
                                                </span>
                                            </div>
                                        </li>

                                        @elseif(strtolower(trim($Specification)) == "50 databases")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
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

                                        @elseif(strtolower(trim($Specification)) == "supports python")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13
                                                   
                                                </span>
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
                                {{-- <div class="freedom-sale-offer">+15 Days Free</div> --}}
                                <div class="shared-plan-btm" id="BusinessThreeYearButtonText">
                                    {!!$ProfessionalThreeYearButtonText!!}
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
                                                <span class="domain_tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x
                                                </span>
                                            </div>
                                        </li>

                                        @elseif(strtolower(trim($Specification)) == "250 databases")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
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

                                        @elseif(strtolower(trim($Specification)) == "supports python")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13
                                                   
                                                </span>
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
                                {{-- <div class="freedom-sale-offer">+15 Days Free</div> --}}
                                <div class="shared-plan-btm" id="EnterpriseThreeYearButtonText">
                                    {!!$EnterpriseThreeYearButtonText!!}
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
                                                <span class="domain_tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x
                                                </span>
                                            </div>
                                        </li>

                                        @elseif(strtolower(trim($Specification)) == "500 databases")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
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

                                        @elseif(strtolower(trim($Specification)) == "supports python")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13
                                                   
                                                </span>
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
                            Starting @ Just <span>₹49/mo</span>
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
                            Starting @ Just <span>₹49/mo</span>
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
                            <img loading="lazy" src="../assets/images/web_hosting/VPS-hosting.png" alt="VPS-hosting">
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
                            <img loading="lazy" src="../assets/images/web_hosting/windows_vps_hosting.png" alt="windows_vps_hosting">
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
                            <img loading="lazy" src="../assets/images/web_hosting/dedicated-server.png" alt="dedicated-server">
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
                    <div class="section-heading">
                        <h2 class="text_head">Get Smart With Host IT Smart's Cheap Web Hosting Services</h2>
                    </div>
                    <div class="smart-wh-carousel">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-touch="false" data-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="smart-wh-cnt">
                                        <ul>
                                            <li>Ideal For Novices</li>
                                            <p>Start your business journey using Host IT Smart's world-class web hosting services, where beginners can also use our services easily and experience reliable performance with top-notch support.</p>
                                            <li>Perfect for Simple Business Websites</li>
                                            <p>Use Host IT Smart's web hosting, specially designed to empower your simple business websites & enjoy power-packed performance with secured infrastructure to boost your online presence.</p>
                                            <li>Cheapest Month-to-Month Web Hosting</li>
                                            <p>If you are looking for an affordable web hosting solution for your business, you can try Host IT Smart's month-to-month web hosting at the best cost without committing for long years.</p>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="smart-wh-cnt">
                                        <ul>
                                            <li>Ideal For Maintaining Affordable Renewal Rates</li>
                                            <p>Just say goodbye to unexpected high price hikes at renewal time. With our budget-friendly renewal rates, you can rest assured that you will get the best value for your money for a lifetime. </p>
                                            <li>Ideal Hosting Offering Top-Notch Support</li>
                                            <p>Experience Host IT Smart's world-class 24/7 Indian support with our amazing services that deliver top-notch support to customers, ensuring their online journey is smooth and worry-free.</p>
                                            <li>Speedy Yet Pocket-friendly Hosting Services</li>
                                            <p>Host IT Smart offers a perfect blend of speed and affordability with its web hosting service to get lightning-fast performance without expensive pricing & experiencing a seamless online experience for your business.</p>
                                        </ul>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="smart-wh-cnt">
                                        <ul>
                                            <li>Best for Websites Focused in Asia</li>
                                            <p>You can strengthen your brand visibility with Host IT Smart's specialized web hosting services focused on Asian countries by leveraging optimized performance and support for your region.</p>
                                            <li>Unbeatable Introductory Pricing</li>
                                            <p>Start your online journey with Host IT Smart's unbeatable web hosting introductory pricing. Just go for long-term commitments at an exceptional value and performance at an amazing discounted price.</p>
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
                    <p>At Host IT Smart, we are all about speed! Our web hosting services in Ahmedabad are designed to give your website a lightning-fast boost that offers a smooth, snappy experience for keeping people coming back, creating more trust and a stronger online presence.</p>
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


 <!--See More Features section start-->
 @include('template.'.$themeversion.'.more_hosting_features')
 <!--See More Features section end-->
 
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

                                        <img class="win-vps-features-icon" src="../assets/images/web_hosting/{{$Features->varIconClass}}.webp" alt="{{$Features->varIconClass}}">

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
@include('template.'.$themeversion.'.two-hosting-add')
<script>
document.addEventListener('DOMContentLoaded',function(){const canadaButton=document.getElementById('loc2');const indiaButton=document.getElementById('loc1');const vpsPlanDiv=document.getElementById('basic_three_div');function hideVpsPlanDiv(){vpsPlanDiv.classList.add('d-none')}
function showVpsPlanDiv(){vpsPlanDiv.classList.remove('d-none')}})
{{-- canadaButton.addEventListener('click',hideVpsPlanDiv);indiaButton.addEventListener('click',showVpsPlanDiv) --}}
</script>
<script>
$(document).ready(function(){$('#exampleModal').on('shown.bs.modal',function(){setTimeout(function(){var targetSection=document.getElementById('see_more_features');if(targetSection){targetSection.scrollIntoView({behavior:'smooth',block:'start'})}},300)})})
</script>
@endsection
{{-- const germanyButton=document.getElementById('loc3'); --}}
{{-- germanyButton.addEventListener('click',hideVpsPlanDiv); --}}