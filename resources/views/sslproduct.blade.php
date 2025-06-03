@extends('layouts.app')
@section('content')
<div class="vps_main {{$ProductBanner->varBannerIconClass}}">
    @if(!empty($ProductBanner) && count((array)$ProductBanner) >0)
    {{-- @if($ProductBanner->id == 10)
        @if($uagent == 'mobile')
            @if(strtolower($udevice) == "ipad")
                <picture>
                    <source media="(max-width: 767px)" srcset="{{Config::get('Constant.CDNURL')}}/assets/images/homebanners/Halloween-Special-Offer-2020/Halloween-Special-Offer-I-Pad-Banner-India.jpg">
    <source media="(max-width: 768px)" srcset="{{Config::get('Constant.CDNURL')}}/assets/images/homebanners/Halloween-Special-Offer-2020/Halloween-Special-Offer-I-Pad-Banner-India.jpg">
    <img src="{{Config::get('Constant.CDNURL')}}/assets/images/homebanners/Halloween-Special-Offer-2020/Halloween-Special-Offer-I-Pad-Banner-India.jpg" alt="Halloween Special Offer" title="Halloween Special Offer">
    </picture>
    @else
    <picture>
        <source media="(max-width: 767px)" srcset="{{Config::get('Constant.CDNURL')}}/assets/images/homebanners/Halloween-Special-Offer-2020/Halloween-Special-Offer-Mobile-Banner-India.jpg">
        <source media="(max-width: 768px)" srcset="{{Config::get('Constant.CDNURL')}}/assets/images/homebanners/Halloween-Special-Offer-2020/Halloween-Special-Offer-Mobile-Banner-India.jpg">
        <img src="{{Config::get('Constant.CDNURL')}}/assets/images/homebanners/Halloween-Special-Offer-2020/Halloween-Special-Offer-Mobile-Banner-India.jpg" alt="Halloween Special Offer" title="Halloween Special Offer">
    </picture>
    @endif
    @elseif($uagent == 'pc')
    <video id="video" muted="" autoplay="autoplay" loop="loop" style="width:100%;" preload="auto" title="Halloween Special Offer">
        <source src="{{Config::get('Constant.CDNURL')}}/assets/images/homebanners/Halloween-Special-Offer-2020/Halloween-Special-Offer-Banner-India.m4v">
    </video>
    @endif
    @else --}}
    <div class="banner-inner hosting-banner" style="background-image:url('{!! App\Helpers\resize_image::resize($ProductBanner->fkIntImgId,1920,494) !!}')">
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
    </div>
    {{-- @endif --}}
    @endif
    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
    <div class="vps-plan-main-div head-tb-p-40">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-heading">
                        @php if($ProductBanner->id == 8){ @endphp
                        <h4 class="text-center text_head" title="Quality hosting does not mean elephantile costs. Not atleast with our plans.">Quality ssl certificates does not mean elephantile costs. Not atleast with our plans.</h4>
                        @php } else if($ProductBanner->id == 4){ @endphp
                        <h4 class="text-center green_title f_weight_500" title="Wordpress Beginner or a full grown business, we have something for you, always!">Wordpress Beginner or a full grown business, we have something for you, always!</h4>
                        <p>Wordpress is amazing!. But when you have a ton to do about your business, you seldom will have the time to understand tiny technicalities of running your wordpress site. That's where managed Wordpress hosting comes into the frame. Regular back up, uptime maintenance, speed, scalability, security, literally everything - is taken care of, while you put your efforts into growing your business.
                        </p>
                        @php } else { @endphp
                        <h4 class="text-center text_head" title="Quality hosting does not mean elephantile costs. Not atleast with our plans.">Quality ssl certificates does not mean elephantile costs. Not atleast with our plans.</h4>
                        @php } @endphp
                    </div>
                </div>
                <div class="switch-plan">
                    <div class="month-tab tab-left-save active aos-init" data-aos="fade-left" data-aos-delay="400">Domain @if(!empty($ProductBanner->varSaveTextMonth)) <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextMonth}}</span> @endif </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="monthly" id="monthly" onclick="calc();"> <span class="slider round"></span>
                    </div>

                    <!-- <label class="switch aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="100">
                        <input type="checkbox" name="monthly" id="monthly" onclick="calc();"> <span class="slider round"></span>
                    </label> -->
                    <div class="month-tab aos-init" data-aos="fade-right" data-aos-delay="400">Organisation @if(!empty($ProductBanner->varSaveTextYear)) <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextYear}}</span> @endif </div>
                </div>
                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                <script>
                    function calc() {
                        if ($('#monthly').is(":checked")) {
                            $("#twoyear").addClass("active show");
                            $("#oneyear").removeClass("active show");
                            $("#threeyear").removeClass("active show");
                            // setTimeout(function(){
                            // $("#vps-plan2").addClass("active show");
                            // $("#vps-plan1").removeClass("active show");
                            // $("#vps-plan3").removeClass("active show");
                            // }, 1000);
                            $('#yearshow').show();
                            $('#monthshow').hide();
                            $('#StarterOneYearButtonText').show();
                            $('#StarterMonthlyButtonText').hide();
                            $('#PerformanceOneYearButtonText').show();
                            $('#PerformanceMonthlyButtonText').hide();
                            $('#BusinessOneYearButtonText').show();
                            $('#BusinessMonthlyButtonText').hide();
                            $('#StarterTwoYearButtonText').show();
                            $('#StarterThreeMonthlyButtonText').hide();
                            $('#PerformanceTwoYearButtonText').show();
                            $('#PerformanceThreeMonthlyButtonText').hide();
                            $('#BusinessTwoYearButtonText').show();
                            $('#BusinessThreeMonthlyButtonText').hide();
                            $('#StarterThreeYearButtonText').show();
                            $('#StarterSixMonthlyButtonText').hide();
                            $('#PerformanceThreeYearButtonText').show();
                            $('#PerformanceSixMonthlyButtonText').hide();
                            $('#BusinessThreeYearButtonText').show();
                            $('#BusinessSixMonthlyButtonText').hide();
                            $('#StarterOneMonthINR').hide();
                            $('#StarterOneYearINR').show();
                            $('#PerformOneMonthINR').hide();
                            $('#PerformOneYearINR').show();
                            $('#BusinessOneMonthINR').hide();
                            $('#BusinessOneYearINR').show();
                            $('#StarterThreeMonthINR').hide();
                            $('#StarterTwoYearINR').show();
                            $('#PerformThreeMonthINR').hide();
                            $('#PerformTwoYearINR').show();
                            $('#BusinessThreeMonthINR').hide();
                            $('#BusinessTwoYearINR').show();
                            $('#StarterSixMonthINR').hide();
                            $('#StarterThreeYearINR').show();
                            $('#PerformSixMonthINR').hide();
                            $('#PerformThreeYearINR').show();
                            $('#BusinessSixMonthINR').hide();
                            $('#BusinessThreeYearINR').show();
                            $('#StarterOneMonthWhmcsINR').hide();
                            $('#StarterOneYearWhmcsINR').show();
                            $('#PerformOneMonthWhmcsINR').hide();
                            $('#PerformOneYearWhmcsINR').show();
                            $('#BusinessOneMonthWhmcsINR').hide();
                            $('#BusinessOneYearWhmcsINR').show();
                            $('#StarterThreeMonthWhmcsINR').hide();
                            $('#StarterTwoYearWhmcsINR').show();
                            $('#PerformThreeMonthWhmcsINR').hide();
                            $('#PerformTwoYearWhmcsINR').show();
                            $('#BusinessThreeMonthWhmcsINR').hide();
                            $('#BusinessTwoYearWhmcsINR').show();
                            $('#StarterSixMonthWhmcsINR').hide();
                            $('#StarterThreeYearWhmcsINR').show();
                            $('#PerformSixMonthWhmcsINR').hide();
                            $('#PerformThreeYearWhmcsINR').show();
                            $('#BusinessSixMonthWhmcsINR').hide();
                            $('#BusinessThreeYearWhmcsINR').show();

                            $('#StarterFeaturesDomain').hide();
                            $('#StarterFeaturesOrganisation').show();

                            $('#PerformanceFeaturesDomain').hide();
                            $('#PerformanceFeaturesOrganisation').show();

                            $('#BusinessFeaturesDomain').hide();
                            $('#BusinessFeaturesOrganisation').show();

                            $('#StarterLogoDomain').hide();
                            $('#StarterLogoOrganisation').show();

                            $('#BusinessLogoDomain').hide();
                            $('#BusinessLogoOrganisation').show();

                            $('#PerformanceLogoDomain').hide();
                            $('#PerformanceLogoOrganisation').show();


                        } else {
                            $("#threemonths").addClass("active show");
                            $("#onemonths").removeClass("active show");
                            $("#sixmonths").removeClass("active show");
                            // setTimeout(function(){
                            // $("#vps-plan2").addClass("active show");
                            // $("#vps-plan1").removeClass("active show");
                            // $("#vps-plan3").removeClass("active show");
                            // }, 1000);
                            $('#yearshow').hide();
                            $('#monthshow').show();
                            $('#StarterOneYearButtonText').hide();
                            $('#StarterMonthlyButtonText').show();
                            $('#PerformanceOneYearButtonText').hide();
                            $('#PerformanceMonthlyButtonText').show();
                            $('#BusinessOneYearButtonText').hide();
                            $('#BusinessMonthlyButtonText').show();
                            $('#StarterTwoYearButtonText').hide();
                            $('#StarterThreeMonthlyButtonText').show();
                            $('#PerformanceTwoYearButtonText').hide();
                            $('#PerformanceThreeMonthlyButtonText').show();
                            $('#BusinessTwoYearButtonText').hide();
                            $('#BusinessThreeMonthlyButtonText').show();
                            $('#StarterThreeYearButtonText').hide();
                            $('#StarterSixMonthlyButtonText').show();
                            $('#PerformanceThreeYearButtonText').hide();
                            $('#PerformanceSixMonthlyButtonText').show();
                            $('#BusinessThreeYearButtonText').hide();
                            $('#BusinessSixMonthlyButtonText').show();
                            $('#StarterOneMonthINR').show();
                            $('#StarterOneYearINR').hide();
                            $('#PerformOneMonthINR').show();
                            $('#PerformOneYearINR').hide();
                            $('#BusinessOneMonthINR').show();
                            $('#BusinessOneYearINR').hide();
                            $('#StarterThreeMonthINR').show();
                            $('#StarterTwoYearINR').hide();
                            $('#PerformThreeMonthINR').show();
                            $('#PerformTwoYearINR').hide();
                            $('#BusinessThreeMonthINR').show();
                            $('#BusinessTwoYearINR').hide();
                            $('#StarterSixMonthINR').show();
                            $('#StarterThreeYearINR').hide();
                            $('#PerformSixMonthINR').show();
                            $('#PerformThreeYearINR').hide();
                            $('#BusinessSixMonthINR').show();
                            $('#BusinessThreeYearINR').hide();
                            $('#StarterOneMonthWhmcsINR').show();
                            $('#StarterOneYearWhmcsINR').hide();
                            $('#PerformOneMonthWhmcsINR').show();
                            $('#PerformOneYearWhmcsINR').hide();
                            $('#BusinessOneMonthWhmcsINR').show();
                            $('#BusinessOneYearWhmcsINR').hide();
                            $('#StarterThreeMonthWhmcsINR').show();
                            $('#StarterTwoYearWhmcsINR').hide();
                            $('#PerformThreeMonthWhmcsINR').show();
                            $('#PerformTwoYearWhmcsINR').hide();
                            $('#BusinessThreeMonthWhmcsINR').show();
                            $('#BusinessTwoYearWhmcsINR').hide();
                            $('#StarterSixMonthWhmcsINR').show();
                            $('#StarterThreeYearWhmcsINR').hide();
                            $('#PerformSixMonthWhmcsINR').show();
                            $('#PerformThreeYearWhmcsINR').hide();
                            $('#BusinessSixMonthWhmcsINR').show();
                            $('#BusinessThreeYearWhmcsINR').hide();

                            $('#StarterFeaturesDomain').show();
                            $('#StarterFeaturesOrganisation').hide();

                            $('#PerformanceFeaturesDomain').show();
                            $('#PerformanceFeaturesOrganisation').hide();

                            $('#BusinessFeaturesDomain').show();
                            $('#BusinessFeaturesOrganisation').hide();

                            $('#StarterLogoDomain').show();
                            $('#StarterLogoOrganisation').hide();

                            $('#BusinessLogoDomain').show();
                            $('#BusinessLogoOrganisation').hide();

                            $('#PerformanceLogoDomain').show();
                            $('#PerformanceLogoOrganisation').hide();


                        }
                    }
                </script>
                @php } else { @endphp
                <script>
                    function calc() {
                        if ($('#monthly').is(":checked")) {
                            $("#twoyear").addClass("active show");
                            $("#oneyear").removeClass("active show");
                            $("#threeyear").removeClass("active show");
                            // setTimeout(function(){
                            // $("#vps-plan2").addClass("active show");
                            // $("#vps-plan1").removeClass("active show");
                            // $("#vps-plan3").removeClass("active show");
                            // }, 1000);
                            $('#yearshow').show();
                            $('#monthshow').hide();
                            $('#StarterOneYearButtonText').show();
                            $('#StarterMonthlyButtonText').hide();
                            $('#PerformanceOneYearButtonText').show();
                            $('#PerformanceMonthlyButtonText').hide();
                            $('#BusinessOneYearButtonText').show();
                            $('#BusinessMonthlyButtonText').hide();
                            $('#StarterTwoYearButtonText').show();
                            $('#StarterThreeMonthlyButtonText').hide();
                            $('#PerformanceTwoYearButtonText').show();
                            $('#PerformanceThreeMonthlyButtonText').hide();
                            $('#BusinessTwoYearButtonText').show();
                            $('#BusinessThreeMonthlyButtonText').hide();
                            $('#StarterThreeYearButtonText').show();
                            $('#StarterSixMonthlyButtonText').hide();
                            $('#PerformanceThreeYearButtonText').show();
                            $('#PerformanceSixMonthlyButtonText').hide();
                            $('#BusinessThreeYearButtonText').show();
                            $('#BusinessSixMonthlyButtonText').hide();
                            $('#StarterOneMonthUSD').hide();
                            $('#StarterOneYearUSD').show();
                            $('#PerformOneMonthUSD').hide();
                            $('#PerformOneYearUSD').show();
                            $('#BusinessOneMonthUSD').hide();
                            $('#BusinessOneYearUSD').show();
                            $('#StarterThreeMonthUSD').hide();
                            $('#StarterTwoYearUSD').show();
                            $('#PerformThreeMonthUSD').hide();
                            $('#PerformTwoYearUSD').show();
                            $('#BusinessThreeMonthUSD').hide();
                            $('#BusinessTwoYearUSD').show();
                            $('#StarterSixMonthUSD').hide();
                            $('#StarterThreeYearUSD').show();
                            $('#PerformSixMonthUSD').hide();
                            $('#PerformThreeYearUSD').show();
                            $('#BusinessSixMonthUSD').hide();
                            $('#BusinessThreeYearUSD').show();
                            $('#StarterOneMonthWhmcsUSD').hide();
                            $('#StarterOneYearWhmcsUSD').show();
                            $('#PerformOneMonthWhmcsUSD').hide();
                            $('#PerformOneYearWhmcsUSD').show();
                            $('#BusinessOneMonthWhmcsUSD').hide();
                            $('#BusinessOneYearWhmcsUSD').show();
                            $('#StarterThreeMonthWhmcsUSD').hide();
                            $('#StarterTwoYearWhmcsUSD').show();
                            $('#PerformThreeMonthWhmcsUSD').hide();
                            $('#PerformTwoYearWhmcsUSD').show();
                            $('#BusinessThreeMonthWhmcsUSD').hide();
                            $('#BusinessTwoYearWhmcsUSD').show();
                            $('#StarterSixMonthWhmcsUSD').hide();
                            $('#StarterThreeYearWhmcsUSD').show();
                            $('#PerformSixMonthWhmcsUSD').hide();
                            $('#PerformThreeYearWhmcsUSD').show();
                            $('#BusinessSixMonthWhmcsUSD').hide();
                            $('#BusinessThreeYearWhmcsUSD').show();

                            $('#StarterFeaturesDomain').show();
                            $('#StarterFeaturesOrganisation').hide();

                            $('#PerformanceFeaturesDomain').show();
                            $('#PerformanceFeaturesOrganisation').hide();

                            $('#BusinessFeaturesDomain').show();
                            $('#BusinessFeaturesOrganisation').hide();

                            $('#StarterLogoDomain').show();
                            $('#StarterLogoOrganisation').hide();

                            $('#BusinessLogoDomain').show();
                            $('#BusinessLogoOrganisation').hide();

                            $('#PerformanceLogoDomain').show();
                            $('#PerformanceLogoOrganisation').hide();
                        } else {
                            $("#threemonths").addClass("active show");
                            $("#onemonths").removeClass("active show");
                            $("#sixmonths").removeClass("active show");
                            // setTimeout(function(){
                            // $("#vps-plan2").addClass("active show");
                            // $("#vps-plan1").removeClass("active show");
                            // $("#vps-plan3").removeClass("active show");
                            // }, 1000);
                            $('#yearshow').hide();
                            $('#monthshow').show();
                            $('#StarterOneYearButtonText').hide();
                            $('#StarterMonthlyButtonText').show();
                            $('#PerformanceOneYearButtonText').hide();
                            $('#PerformanceMonthlyButtonText').show();
                            $('#BusinessOneYearButtonText').hide();
                            $('#BusinessMonthlyButtonText').show();
                            $('#StarterTwoYearButtonText').hide();
                            $('#StarterThreeMonthlyButtonText').show();
                            $('#PerformanceTwoYearButtonText').hide();
                            $('#PerformanceThreeMonthlyButtonText').show();
                            $('#BusinessTwoYearButtonText').hide();
                            $('#BusinessThreeMonthlyButtonText').show();
                            $('#StarterThreeYearButtonText').hide();
                            $('#StarterSixMonthlyButtonText').show();
                            $('#PerformanceThreeYearButtonText').hide();
                            $('#PerformanceSixMonthlyButtonText').show();
                            $('#BusinessThreeYearButtonText').hide();
                            $('#BusinessSixMonthlyButtonText').show();
                            $('#StarterOneMonthUSD').show();
                            $('#StarterOneYearUSD').hide();
                            $('#PerformOneMonthUSD').show();
                            $('#PerformOneYearUSD').hide();
                            $('#BusinessOneMonthUSD').show();
                            $('#BusinessOneYearUSD').hide();
                            $('#StarterThreeMonthUSD').show();
                            $('#StarterTwoYearUSD').hide();
                            $('#PerformThreeMonthUSD').show();
                            $('#PerformTwoYearUSD').hide();
                            $('#BusinessThreeMonthUSD').show();
                            $('#BusinessTwoYearUSD').hide();
                            $('#StarterSixMonthUSD').show();
                            $('#StarterThreeYearUSD').hide();
                            $('#PerformSixMonthUSD').show();
                            $('#PerformThreeYearUSD').hide();
                            $('#BusinessSixMonthUSD').show();
                            $('#BusinessThreeYearUSD').hide();
                            $('#StarterOneMonthWhmcsUSD').show();
                            $('#StarterOneYearWhmcsUSD').hide();
                            $('#PerformOneMonthWhmcsUSD').show();
                            $('#PerformOneYearWhmcsUSD').hide();
                            $('#BusinessOneMonthWhmcsUSD').show();
                            $('#BusinessOneYearWhmcsUSD').hide();
                            $('#StarterThreeMonthWhmcsUSD').show();
                            $('#StarterTwoYearWhmcsUSD').hide();
                            $('#PerformThreeMonthWhmcsUSD').show();
                            $('#PerformTwoYearWhmcsUSD').hide();
                            $('#BusinessThreeMonthWhmcsUSD').show();
                            $('#BusinessTwoYearWhmcsUSD').hide();
                            $('#StarterSixMonthWhmcsUSD').show();
                            $('#StarterThreeYearWhmcsUSD').hide();
                            $('#PerformSixMonthWhmcsUSD').show();
                            $('#PerformThreeYearWhmcsUSD').hide();
                            $('#BusinessSixMonthWhmcsUSD').show();
                            $('#BusinessThreeYearWhmcsUSD').hide();

                            $('#StarterFeaturesDomain').hide();
                            $('#StarterFeaturesOrganisation').show();

                            $('#PerformanceFeaturesDomain').hide();
                            $('#PerformanceFeaturesOrganisation').show();

                            $('#BusinessFeaturesDomain').hide();
                            $('#BusinessFeaturesOrganisation').show();

                            $('#StarterLogoDomain').hide();
                            $('#StarterLogoOrganisation').show();

                            $('#BusinessLogoDomain').hide();
                            $('#BusinessLogoOrganisation').show();

                            $('#PerformanceLogoDomain').hide();
                            $('#PerformanceLogoOrganisation').show();
                        }
                    }
                </script>
                @php } @endphp
                <!--<div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='monthshow'>
                    <ul class="nav nav-pills nav-vps-hosting">
                        <li><a data-toggle="pill" href="#vps-plan1" title="1 month" id='onemonths'>1 month @if(!empty($ProductBanner->varOfferTextOneMonth))<span><span class="bg-color">{{$ProductBanner->varOfferTextOneMonth}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan2" title="3 months" id='threemonths' class="active show">3 months @if(!empty($ProductBanner->varOfferTextThreeMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeMonth}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan3" title="6 months" id='sixmonths'>6 months @if(!empty($ProductBanner->varOfferTextSixMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextSixMonth}}</span></span>@endif</a></li>
                    </ul>
                </div>
                <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='yearshow' style="display: none">
                    <ul class="nav nav-pills nav-vps-hosting">
                        <li><a data-toggle="pill" href="#vps-plan1" title="1 month" id='oneyear'>1 year @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan2" title="2 months" id='twoyear' class="active show">2 years @if(!empty($ProductBanner->varOfferTextTwoYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextTwoYear}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan3" title="3 months" id='threeyear'>3 years @if(!empty($ProductBanner->varOfferTextThreeYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeYear}}</span></span>@endif</a></li>
                    </ul>
                </div>-->
                @php if($ProductBanner->id == '10'){
                $mainclassssl = 'ssl-small';
                }else{
                $mainclassssl = '';
                } @endphp
                <div class="tab-content {{$mainclassssl}}">
                    <!--This Code for One Months and One Year-->
                    <div id="vps-plan1" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row">
                                @php $class = ''; $class1 = ''; $class3 = ''; $PostShow = '4'; @endphp
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div aos-init" data-aos="fade-right-custom">
                                        <div class="plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="StarterOneMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_1_INR') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="StarterOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_INR') * 12 }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="StarterOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_1_USD') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="StarterOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_USD') * 12 }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthINR))
                                                        <div id='StarterOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneMonthINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearINR))
                                                        <div id='StarterOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthUSD))
                                                        <div id='StarterOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price" id='StarterOneMonthUSD'>{{$ProductsPackageData[0]->intOldPriceOneMonthUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearUSD))
                                                        <div id='StarterOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[0]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2"><img title="Pro1" src="assets/images/comodo-PS.webp" alt="comodo" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="vps-plan-features">
                                                @php $StarterOneMonth = 1; $StarterOneMonth3 = ''; $StarterOneMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php if ($StarterOneMonth > $PostShow){
                                                $StarterOneMonth3 = 'display:none';
                                                $StarterOneMonth4 = 'display:block';
                                                } else {
                                                $StarterOneMonth3 = '';
                                                $StarterOneMonth4 = 'display:none';
                                                } @endphp
                                                @if ($StarterOneMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li style="{{$StarterOneMonth3}}" id='StarterOneMonth{{$StarterOneMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($StarterOneMonth >= 5)
                                                </div>
                                                @endif
                                                @php $StarterOneMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="StarterOneMonth" onclick="LoadFeatures('StarterOneMonth','{{$StarterOneMonth}}');" style="{{$StarterOneMonth4}}"><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="StarterMonthlyButtonText">
                                                {!!$StarterMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="StarterOneYearButtonText" style="display: none">
                                                {!!$StarterOneYearButtonText!!}
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                @php $class = ''; $class1 = '';
                                if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                $class = 'recommanded';
                                $class1 = 'recommanded-icon';
                                } @endphp
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div {{$class}}" data-aos="zoom-inn">
                                        <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="PerformOneMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_1_INR') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_INR') * 12 }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="PerformOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_1_USD') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_USD') * 12 }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthINR))
                                                        <div id='PerformOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id='PerformOneMonthINR'>{{$ProductsPackageData[1]->intOldPriceOneMonthINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearINR))
                                                        <div id='PerformOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthUSD))
                                                        <div id='PerformOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneMonthUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearUSD))
                                                        <div id='PerformOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[1]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2"><img title="pro2" src="assets/images/comodo-PS.webp" alt="comodo" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="vps-plan-features">
                                                @php $PerformOneMonth = 1; $PerformOneMonth3 = ''; $PerformOneMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php if ($PerformOneMonth > $PostShow){
                                                $PerformOneMonth3 = 'display:none';
                                                $PerformOneMonth4 = 'display:block';
                                                } else {
                                                $PerformOneMonth3 = '';
                                                $PerformOneMonth4 = 'display:none';
                                                } @endphp
                                                @if ($PerformOneMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li style="{{$PerformOneMonth3}}" id='PerformOneMonth{{$PerformOneMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($PerformOneMonth >= 5)
                                                </div>
                                                @endif
                                                @php $PerformOneMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="PerformOneMonth" onclick="LoadFeatures('PerformOneMonth','{{$PerformOneMonth}}');" style="{{$PerformOneMonth4}}"><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="PerformanceMonthlyButtonText">
                                                {!!$PerformanceMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="PerformanceOneYearButtonText" style="display: none">
                                                {!!$PerformanceOneYearButtonText!!}
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div" data-aos="fade-left-custom">
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="BusinessOneMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_1_INR') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_INR') * 12 }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="BusinessOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_1_USD') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_USD') * 12 }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthINR))
                                                        <div id='BusinessOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearINR))
                                                        <div id='BusinessOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthUSD))
                                                        <div id='BusinessOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearUSD))
                                                        <div id='BusinessOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[2]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2"><img title="pro3" src="assets/images/comodo-PS.webp" alt="comodo" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="vps-plan-features">
                                                @php $BusinessOneMonth = 1; $BusinessOneMonth3 = ''; $BusinessOneMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php if ($BusinessOneMonth > $PostShow){
                                                $BusinessOneMonth3 = 'display:none';
                                                $BusinessOneMonth4 = 'display:block';
                                                } else {
                                                $BusinessOneMonth3 = '';
                                                $BusinessOneMonth4 = 'display:none';
                                                } @endphp
                                                @if ($BusinessOneMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li style="{{$BusinessOneMonth3}}" id='BusinessOneMonth{{$BusinessOneMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($BusinessOneMonth >= 5)
                                                </div>
                                                @endif
                                                @php $BusinessOneMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="BusinessOneMonth" onclick="LoadFeatures('BusinessOneMonth','{{$BusinessOneMonth}}');" style="{{$BusinessOneMonth4}}"><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="BusinessMonthlyButtonText">
                                                {!!$BusinessMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="BusinessOneYearButtonText" style="display: none">
                                                {!!$BusinessOneYearButtonText!!}
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--This Code for Three Months and Two Year-->
                    <div id="vps-plan2" class="tab-pane active show">
                        <div class="plan-main-div">
                            <div class="row">
                                <div class="col-md-4 col-xs-12 col-12 align-self-center" data-aos="fade-left" data-aos-easing="ease-out-back">
                                    <div class="vps-plan-div" data-aos="fade-right-custom">
                                        <div class="plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="StarterThreeMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_INR') * 12) }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="StarterTwoYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_24_INR') * 12) }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="StarterThreeMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_USD') * 12) }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="StarterTwoYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_24_USD') * 12) }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearINR))
                                                        <div id='StarterThreeMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[3]->intOldPriceTwoYearINR))
                                                        <div id='StarterTwoYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[3]->intOldPriceTwoYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearUSD))
                                                        <div id='StarterThreeMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[3]->intOldPriceTwoYearUSD))
                                                        <div id='StarterTwoYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[3]->intOldPriceTwoYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[0]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2" id="StarterLogoDomain"><img title="pro-fastssl" src="assets/images/ssl-certificates/pro-fastssl.webp" alt="pro-fastssl" /></div>
                                                <div class="plan-logo-2" style="display:none;" id="StarterLogoOrganisation"><img title="pro-fastssl" src="assets/images/ssl-certificates/pro-fastssl.webp" alt="pro-fastssl" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp

                                            <ul class="vps-plan-features" id="StarterFeaturesDomain">
                                                @php $StarterThreeMonth = 1; $StarterThreeMonth3 = ''; $StarterThreeMonth4 = ''; @endphp

                                                @foreach($SpecificationData as $Specification)
                                                @php if ($StarterThreeMonth > $PostShow){
                                                $StarterThreeMonth3 = 'display:none';
                                                $StarterThreeMonth4 = 'display:block';
                                                } else {
                                                $StarterThreeMonth3 = '';
                                                $StarterThreeMonth4 = 'display:none';
                                                } @endphp
                                                @if ($StarterThreeMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li id='StarterThreeMonth{{$StarterThreeMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($StarterThreeMonth >= 5)
                                                </div>
                                                @endif
                                                @php $StarterThreeMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[3]->txtSpecification); @endphp

                                            <ul class="vps-plan-features" id="StarterFeaturesOrganisation" style="display: none">
                                                @php $StarterThreeMonth = 1; $StarterThreeMonth3 = ''; $StarterThreeMonth4 = ''; @endphp

                                                @foreach($SpecificationData as $Specification)
                                                @php if ($StarterThreeMonth > $PostShow){
                                                $StarterThreeMonth3 = 'display:none';
                                                $StarterThreeMonth4 = 'display:block';
                                                } else {
                                                $StarterThreeMonth3 = '';
                                                $StarterThreeMonth4 = 'display:none';
                                                } @endphp
                                                @if ($StarterThreeMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li id='StarterThreeMonth{{$StarterThreeMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($StarterThreeMonth >= 5)
                                                </div>
                                                @endif
                                                @php $StarterThreeMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="StarterThreeMonth" onclick="LoadFeatures('StarterThreeMonth','{{$StarterThreeMonth}}');" style="{{$StarterThreeMonth4}}"><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="StarterThreeMonthlyButtonText">
                                                {!!$StarterOneYearButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="StarterTwoYearButtonText" style="display: none">
                                                {!!$StarterTwoYearButtonText!!}
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                @php $class = ''; $class1 = '';
                                if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                $class = 'recommanded';
                                $class1 = 'recommanded-icon';
                                } @endphp
                                <div class="col-md-4 col-xs-12 col-12 align-self-center" data-aos="zoom-in" data-aos-easing="ease-out-back">
                                    <div class="vps-plan-div {{$class}}" data-aos="zoom-inn">
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="PerformThreeMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_INR') * 12) }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="PerformTwoYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_24_INR') * 12) }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="PerformThreeMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_USD') * 12) }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="PerformTwoYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_24_USD') * 12) }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearINR))
                                                        <div id='PerformThreeMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[4]->intOldPriceTwoYearINR))
                                                        <div id='PerformTwoYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[4]->intOldPriceTwoYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearUSD))
                                                        <div id='PerformThreeMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id='PerformThreeMonthUSD'>{{$ProductsPackageData[2]->intOldPriceOneYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[4]->intOldPriceTwoYearUSD))
                                                        <div id='PerformTwoYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[4]->intOldPriceTwoYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[2]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2" id="PerformanceLogoDomain"><img title="Positive SSL Wildcard" src="assets/images/ssl-certificates/comodo-MDS.webp" alt="Positive SSL Wildcard" /></div>
                                                <div class="plan-logo-2" style="display:none;" id="PerformanceLogoOrganisation"><img title="InstantSSL Pro" src="assets/images/ssl-certificates/comodo-ISP.webp" alt="InstantSSL Pro" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" id="PerformanceFeaturesDomain">
                                                @php $PerformThreeMonth = 1; $PerformThreeMonth3 = ''; $PerformThreeMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php if ($PerformThreeMonth > $PostShow){
                                                $PerformThreeMonth3 = 'display:none';
                                                $PerformThreeMonth4 = 'display:block';
                                                } else {
                                                $PerformThreeMonth3 = '';
                                                $PerformThreeMonth4 = 'display:none';
                                                } @endphp
                                                @if ($PerformThreeMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li id='PerformThreeMonth{{$PerformThreeMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($PerformThreeMonth >= 5)
                                                </div>
                                                @endif
                                                @php $PerformThreeMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[4]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" id="PerformanceFeaturesOrganisation" style="display: none">
                                                @php $PerformThreeMonth = 1; $PerformThreeMonth3 = ''; $PerformThreeMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php if ($PerformThreeMonth > $PostShow){
                                                $PerformThreeMonth3 = 'display:none';
                                                $PerformThreeMonth4 = 'display:block';
                                                } else {
                                                $PerformThreeMonth3 = '';
                                                $PerformThreeMonth4 = 'display:none';
                                                } @endphp
                                                @if ($PerformThreeMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li id='PerformThreeMonth{{$PerformThreeMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($PerformThreeMonth >= 5)
                                                </div>
                                                @endif
                                                @php $PerformThreeMonth++; @endphp
                                                @endforeach
                                            </ul>

                                            <a class="more-features" title="More" href="javascript:void(0)" id="PerformThreeMonth" onclick="LoadFeatures('PerformThreeMonth','{{$PerformThreeMonth}}');" style="{{$PerformThreeMonth4}}"><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="PerformanceThreeMonthlyButtonText">
                                                {!!$PerformanceOneYearButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="PerformanceTwoYearButtonText" style="display: none">
                                                {!!$PerformanceTwoYearButtonText!!}
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 col-12 align-self-center" data-aos="fade-right" data-aos-easing="ease-out-back">
                                    <div class="vps-plan-div" data-aos="fade-left-custom">
                                        <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="BusinessThreeMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_INR') * 12) }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="BusinessTwoYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_24_INR') * 12 ) }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="BusinessThreeMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_USD') * 12) }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="BusinessTwoYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ round(Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_24_USD') * 12) }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearINR))
                                                        <div id='BusinessThreeMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[5]->intOldPriceTwoYearINR))
                                                        <div id='BusinessTwoYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[5]->intOldPriceTwoYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearUSD))
                                                        <div id='BusinessThreeMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[5]->intOldPriceTwoYearUSD))
                                                        <div id='BusinessTwoYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[5]->intOldPriceTwoYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[1]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2" id="BusinessLogoDomain"><img title="Business" src="assets/images/ssl-certificates/comodo-PSW.webp" alt="Business" /></div>
                                                <div class="plan-logo-2" style="display:none;" id="BusinessLogoOrganisation"><img title="Multi Domain" src="assets/images/ssl-certificates/comodo-MDS.webp" alt="Multi Domain" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" id="BusinessFeaturesDomain">
                                                @php $BusinessThreeMonth = 1; $BusinessThreeMonth3 = ''; $BusinessThreeMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php if ($BusinessThreeMonth > $PostShow){
                                                $BusinessThreeMonth3 = 'display:none';
                                                $BusinessThreeMonth4 = 'display:block';
                                                } else {
                                                $BusinessThreeMonth3 = '';
                                                $BusinessThreeMonth4 = 'display:none';
                                                } @endphp
                                                @if ($BusinessThreeMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li id='BusinessThreeMonth{{$BusinessThreeMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($BusinessThreeMonth >= 5)
                                                </div>
                                                @endif
                                                @php $BusinessThreeMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[5]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" id="BusinessFeaturesOrganisation" style="display: none">
                                                @php $BusinessThreeMonth = 1; $BusinessThreeMonth3 = ''; $BusinessThreeMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php if ($BusinessThreeMonth > $PostShow){
                                                $BusinessThreeMonth3 = 'display:none';
                                                $BusinessThreeMonth4 = 'display:block';
                                                } else {
                                                $BusinessThreeMonth3 = '';
                                                $BusinessThreeMonth4 = 'display:none';
                                                } @endphp
                                                @if ($BusinessThreeMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li id='BusinessThreeMonth{{$BusinessThreeMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($BusinessThreeMonth >= 5)
                                                </div>
                                                @endif
                                                @php $BusinessThreeMonth++; @endphp
                                                @endforeach
                                            </ul>



                                            <a class="more-features" title="More" href="javascript:void(0)" id="BusinessThreeMonth" onclick="LoadFeatures('BusinessThreeMonth','{{$BusinessThreeMonth}}');" style="{{$BusinessThreeMonth4}}"><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="BusinessThreeMonthlyButtonText">
                                                {!!$BusinessOneYearButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="BusinessTwoYearButtonText" style="display: none">
                                                {!!$BusinessTwoYearButtonText!!}
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--This Code for Six Months and Three Year-->
                    <div id="vps-plan3" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row">
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div" data-aos="fade-right-custom" data-aos-easing="ease-out-back">
                                        <div class="plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="StarterSixMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_6_INR') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="StarterThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_126_INR') * 12 }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="StarterSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_6_USD') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="StarterThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_126_USD') * 12 }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceSixMonthINR))
                                                        <div id='StarterSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id="StarterSixMonthINR">{{$ProductsPackageData[0]->intOldPriceSixMonthINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                        <div id='StarterThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceSixMonthUSD))
                                                        <div id='StarterSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceSixMonthUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearUSD))
                                                        <div id='StarterThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[0]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2"><img title="pro7" src="assets/images/comodo-PS.webp" alt="comodo" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="vps-plan-features">
                                                @php $StarterSixMonth = 1; $StarterSixMonth3 = ''; $StarterSixMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php if ($StarterSixMonth > $PostShow){
                                                $StarterSixMonth3 = 'display:none';
                                                $StarterSixMonth4 = 'display:block';
                                                } else {
                                                $StarterSixMonth3 = '';
                                                $StarterSixMonth4 = 'display:none';
                                                } @endphp
                                                @if ($StarterSixMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li style="{{$StarterSixMonth3}}" id='StarterSixMonth{{$StarterSixMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($StarterSixMonth >= 5)
                                                </div>
                                                @endif
                                                @php $StarterSixMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="StarterSixMonth" onclick="LoadFeatures('StarterSixMonth','{{$StarterSixMonth}}');" style="{{$StarterSixMonth4}}"><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="StarterSixMonthlyButtonText">
                                                {!!$StarterSixMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="StarterThreeYearButtonText" style="display: none">
                                                {!!$StarterThreeYearButtonText!!}
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                @php if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                $class = 'recommanded';
                                $class1 = 'recommanded-icon';
                                } @endphp
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div {{$class}}" data-aos="zoom-inn" data-aos-easing="ease-out-back">
                                        <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="PerformSixMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_6_INR') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="PerformThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_126_INR') * 12 }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="PerformSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_6_USD') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="PerformThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_126_USD') * 12 }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceSixMonthINR))
                                                        <div id='PerformSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceSixMonthINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                        <div id='PerformThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceThreeYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceSixMonthUSD))
                                                        <div id='PerformSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceSixMonthUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearUSD))
                                                        <div id='PerformThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceThreeYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[1]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2"><img title="pro8" src="assets/images/comodo-PS.webp" alt="comodo" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="vps-plan-features">
                                                @php $PerformSixMonth = 1; $PerformSixMonth3 = ''; $PerformSixMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php
                                                if ($PerformSixMonth > $PostShow){
                                                $PerformSixMonth3 = 'display:none';
                                                $PerformSixMonth4 = 'display:block';
                                                } else {
                                                $PerformSixMonth3 = '';
                                                $PerformSixMonth4 = 'display:none';
                                                }
                                                @endphp
                                                @if ($PerformSixMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li style="{{$PerformSixMonth3}}" id='PerformSixMonth{{$PerformSixMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($PerformSixMonth >= 5)
                                                </div>
                                                @endif
                                                @php $PerformSixMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="PerformSixMonth" onclick="LoadFeatures('PerformSixMonth','{{$PerformSixMonth}}');" style="{{$PerformSixMonth4}}"><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="PerformanceSixMonthlyButtonText">
                                                {!!$PerformanceSixMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="PerformanceThreeYearButtonText" style="display: none">
                                                {!!$PerformanceThreeYearButtonText!!}
                                            </div>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div" data-aos="fade-left-custom" data-aos-easing="ease-out-back">
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                <span class="vps-price" id="BusinessSixMonthWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_6_INR') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="BusinessThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_126_INR') * 12 }}</strong>/yr*
                                                </span>
                                                @php } else { @endphp
                                                <span class="vps-price" id="BusinessSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_6_USD') * 12 }}</strong>/yr*
                                                </span>
                                                <span class="vps-price" id="BusinessThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_126_USD') * 12 }}</strong>/yr*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp

                                                        @if(!empty($ProductsPackageData[2]->intOldPriceSixMonthINR))
                                                        <div id='BusinessSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceSixMonthINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                        <div id='BusinessThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeYearINR}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceSixMonthUSD))
                                                        <div id='BusinessSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceSixMonthUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearUSD))
                                                        <div id='BusinessThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeYearUSD}} /yr*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[2]->varAdditionalOffer}})</span>
                                                </div>
                                                <div class="plan-logo-2"><img title="pro9" src="assets/images/comodo-PS.webp" alt="comodo" /></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="vps-plan-features">
                                                @php $BusinessSixMonth = 1; $BusinessSixMonth3 = ''; $BusinessSixMonth4 = ''; @endphp
                                                @foreach($SpecificationData as $Specification)
                                                @php
                                                if ($BusinessSixMonth > $PostShow){
                                                $BusinessSixMonth3 = 'display:none';
                                                $BusinessSixMonth4 = 'display:block';
                                                } else {
                                                $BusinessSixMonth3 = '';
                                                $BusinessSixMonth4 = 'display:none';
                                                }
                                                @endphp
                                                @if ($BusinessSixMonth >= 5)
                                                <div class="slide-toggle" style="display:none">
                                                    @endif
                                                    <li style="{{$BusinessSixMonth3}}" id='BusinessSixMonth{{$BusinessSixMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($BusinessSixMonth >= 5)
                                                </div>
                                                @endif
                                                @php $BusinessSixMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="BusinessSixMonth" onclick="LoadFeatures('BusinessSixMonth','{{$BusinessSixMonth}}');" style="{{$BusinessSixMonth4}}"><i class="la la-plus"></i>More</a>

                                            <div class="vps-plan-btm" id="BusinessSixMonthlyButtonText">
                                                {!!$BusinessSixMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="BusinessThreeYearButtonText" style="display: none">
                                                {!!$BusinessThreeYearButtonText!!}
                                            </div>
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
    @endif
</div>
@if(!empty($FeaturesData) && count($FeaturesData) >0)
@php if($ProductBanner->id == '10' || $ProductBanner->id == '4'){
if($ProductBanner->id == 7 ||$ProductBanner->id == 8){
$mainclass = 'ssl-features';}else{$mainclass = '';
}
$mobileclass = 'feature-ul';
$imageclass = 'd-flex justify-content-center align-items-center';
}else{
$mainclass = '';
$mobileclass = '';
$imageclass = '';
} @endphp
<div class="inner_container head-tb-p-40">
    <div class="aws-content">
        <div class="aws-managed-services ">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-sm-12 ">
                        <div class="section-heading">
                            <h2 class="text-center text_head">SSL HTTPS- What is it?</h2>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="right aos-animate aos-init text-center">
                            <img src="{{url('/')}}/assets/images/ssl-certificates/SSL-img01.webp" alt="SSL HTTPS- What is it?">
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="section-heading">
                            <div class="aws-para aos-animate aos-init">
                                <p>Secure Socket Layer (SSL) are basically cryptographic protocols designed so as to provide security for communications over a particular computer network. Hypertext Transfer Protocol Secure (HTTPS) is basically an extension of the Hypertext Transfer Protocol (HTTP) and is made with the purpose of being used to secure communication over a computer network. The communication protocol in HTTPS is encrypted using Transport Layer Security (TLS) or its predecessor Secure Sockets Layer (SSL) and is thus, referred to as HTTP over SSL.</p>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>

                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-sm-12 ">
                        <div class="section-heading">
                            <h2 class="text-center text_head">HTTPS vs HTTP: What's the difference?
                            </h2>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 ">
                        <div class="right aos-animate aos-init text-center">
                            <img src="{{url('/')}}/assets/images/ssl-certificates/SSL-img02.webp" alt="HTTPS vs HTTP: What's the difference?">
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="section-heading">

                            <div class="aws-para aos-animate aos-init">
                                <p>Hypertext Transfer Protocol (HTTP) is basically extended to Hypertext Transfer Protocol Secure (HTTPS) so as to enhance its security feature. HTTPS unlike HTTP has the encryption and works like a Transport Layer unlike an Application Layer as in the case of HTTP. HTTPS needs to buy SSL Certificates which is not the case with the HTTP. A Secure Sockets Layer (SSL) Certificate can be referred to as a digital certificate. It basically ensures that all the data that is passed in between the website and the visitor’s browser are encrypted and protected from hackers and thus is secured and kept private.</p>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-sm-12">
                        <div class="section-heading">
                            <h2 class="text-center text_head">How does cheap SSL/TLS certificate work?
                            </h2>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="right aos-animate aos-init text-center">
                            <img src="{{url('/')}}/assets/images/ssl-certificates/SSL-img03.webp" alt="How does cheap SSL/TLS certificate work?">
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="section-heading">

                            <div class="aws-para aos-animate aos-init">
                                <p>Purchasing an SSL Certificate is a must for the website security, especially if yours is a site that sells products and services and sees monetary transactions via credit cards online. There are multiple SSL Certificate providers in the current market who provide for the SSL Certificates for the websites, competing for providing the best SSL Certificate. There are various SSL Certificate Providers who provide with cheap SSL Certificate options. -
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="g-suite-lists head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-heading">
                <h2 class="text_head text-center">Why SSL Certificates</h2>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-list-box">
                        <i class="list-num">1</i>
                        <h4>Rock-Solid Security</h4>
                        <span>SSL tries to provide rock-solid security making it safe and secure to transmit private information like personal data, payment or login information.</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-list-box">
                        <i class="list-num">2</i>
                        <h4>Avoid 'Not Secure' Warning</h4>
                        <span>Major browsers such as Google Chrome, Firefox, etc clearly display whether the website accessed by the users is through a secure connection or not where the users get access to more details about the SSL Certificate simply by clicking on it; assuring them about its security while doing so.
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-list-box">
                        <i class="list-num">3</i>
                        <h4>Boost Google Ranking</h4>
                        <span>Since SSL assures for the safety and security of the Website and its users naturally boosting its Google ranking.</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-list-box">
                        <i class="list-num">4</i>
                        <h4>Build your Brand Smart</h4>
                        <span>The SSL/TLS certificates basically work by tying cryptographic key to a particular company’s information, allowing them to encrypt data transfers in ways that they cannot be deciphered by third parties.</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="vps-features {{$mainclass}} head-tb-p-40" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <div class="section-heading">
                @php if($ProductBanner->id == 4){ @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features that bring a 5 star wordpress experience to your plate</h2>
                @php } else if($ProductBanner->id == 7) { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features to up your gear</h2>
                @php } else if($ProductBanner->id == 8) { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features to make you unstoppable</h2>
                @php } else { @endphp
                <h2 class="text_head text-center" data-aos="fade-up">Features put you in control</h2>
                @php } @endphp
                </div>
                @php
                $featureMainDivClass;
                $featureIconDivClass;
                if ($uagent == "mobile") {
                $featureMainDivClass="features-start features-start-mob d-md-none d-block";
                $featureIconDivClass="feature-icon";
                }else{
                $featureMainDivClass="features-start ";
                $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                }
                @endphp

                <div class="{{$featureMainDivClass}}">
                    @if ($uagent == "mobile")
                    <div class="owl-carousel owl-theme">
                        @else
                        <div class="row">
                            <div class="feature-ul d-flex flex-wrap">
                                @endif
                                @foreach($FeaturesData as $Features)
                                @if ($uagent == "mobile") <div class="item"> @endif
                                    <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                        <div class="content-main align-self-start" @if ($uagent !="mobile" )data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100" @endif>
                                            <div class="{{$featureIconDivClass}}"><i class="{{$Features->varIconClass}}"></i></div>
                                            <h3>{{$Features->varTitle}}</h3>
                                            <div class="content">{!! $Features->varShortDescription !!}</div>
                                        </div>
                                    </div>
                                    @if ($uagent == "mobile")
                                </div> @endif
                                @endforeach
                                @if ($uagent == "mobile")
                            </div>
                            @else
                        </div>
                    </div>
                    @endif
                </div>

                {{-- <div class="features-start features-start-mob">
                    <div class="{{$mobileclass}}">
                <div class="owl-carousel owl-theme">
                    @foreach($FeaturesData as $Features)
                    <div class="item">
                        <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                            <div class="content-main align-self-start">
                                <div class="feature-icon"><i class="{{$Features->varIconClass}}"></i></div>
                                <h3>{{$Features->varTitle}}</h3>
                                <div class="content">{!! $Features->varShortDescription !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div> --}}

    </div>
</div>

</div>

</div>
<?php
/*<div class="common-div cms">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cms">
                <h4 class="common-title">And it does not cost a lot!</h4>
                <p class="text-center"> We offer cheap ssl certificates in India.</p>
                </div>
            </div>
        </div>
    </div>
</div>*/
?>
<?php /*
<div class="what-we-offer" data-type="background" data-speed="7">
    <div class="container">
        @if(session()->has('frontlogin'))
        @php
        $renew_link = url('https://manage.hostitsmart.com/clientarea.php?action=domains');
        $login_attr = '';
        $target = 'target="_blank"';
        @endphp
        @else
        @php
        $login_attr = 'data-toggle="modal" data-target="#loginModal"';
        $renew_link = 'javascript:;';
        $target ='';
        @endphp
        @endif

        <div class="offer-tabbing">
            <h5 class="" data-aos="fade-up">What We Offer</h5>
            <ul class="nav nav-pills nav-offer justify-content-center" data-aos="fade-up">
                @if($ProductBanner->id == 15 || $ProductBanner->id == 12)
                <li><a data-toggle="pill" href="#offer1" class="justify-content-center active" title="Dedicated IP"><span class="bg-white-tab"><i class="offer-1-icon align-self-center"></i></span><span class="offer-tabbing-name">Dedicated IP</span></a></li>
                <li><a data-toggle="pill" href="#offer2" class="justify-content-center" title="SSL"><span class="bg-white-tab"><i class="offer-1-icon offer-2-icon align-self-center"></i></span><span class="offer-tabbing-name">SSL</span></a></li>
                @else
                <li><a data-toggle="pill" href="#offer1" class="justify-content-center active" title="CodeGuard"><span class="bg-white-tab"><i class="offer-1-icon align-self-center"></i></span><span class="offer-tabbing-name">CodeGuard</span></a></li>
                <li><a data-toggle="pill" href="#offer2" class="justify-content-center" title="Site Lock"><span class="bg-white-tab"><i class="offer-1-icon offer-2-icon align-self-center"></i></span><span class="offer-tabbing-name">Site Lock</span></a></li>
                @endif
            </ul>
            <div class="tab-content aos-init" data-aos="fade-up" data-aos-delay="250">
                 @if($ProductBanner->id == 15 || $ProductBanner->id == 12)
                <div id="offer1" class="tab-pane active show">
                    <div class="offer-tab-text" data-aos="fade-up">
                        <h3>Dedicated IP</h3>
                        <p>Account will be deployed on an IP which are not shared among other users.</p><span>Get a dedicated IP for stronger brand recognition at 1300/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                </div>
                <div id="offer2" class="tab-pane">
                    <div class="offer-tab-text" data-aos="fade-up">
                        <h3>SSL</h3>
                        <p>SSL certificate encrytps the data between user and web-server, making it imposible to trace back user's sensitive information</p><span>Get the security of Positive SSL for single domain at 730.88/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                </div>
                @else
                <div id="offer1" class="tab-pane active show">
                    <div class="offer-tab-text" data-aos="fade-up">
                        <h3>CodeGuard</h3>
                        <p> Code guard monitors your website and gives you an option to restore in case you get something deleted accidently.</p><span>Get the protection of code guard at 730/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                </div>
                <div id="offer2" class="tab-pane">
                    <div class="offer-tab-text" data-aos="fade-up">
                        <h3>Site Lock</h3>
                        <p>SiteLock automatically scans your website for malware 24x7 to ensure they are not being blocked or spammed</p><span>Get the protection of code guard at 730/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div> */ ?>
@endif
@if($ProductBanner->id == 7)
@include('template.vps-compare')
@elseif($ProductBanner->id == 15)
@include('template.linux-reseller-compare')
@elseif($ProductBanner->id == 12)
@include('template.windows-reseller-compare')
@elseif($ProductBanner->id == 1)
@include('template.linux-hosting-compare')
@endif

@if($ProductBanner->id == 2)
<div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
    <div class="col-lg-4 col-12 z-index-1 padding-0">
        <div class="row">
            <div class="banner-1 justify-content-end d-flex">
                <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">Special Package Offer</span>
                <div class="banner-wp-blue-logo"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12 z-index-0 padding-0">
        <div class="row">
            <div class="banner-text2"><span class="starting-from">Linux Hosting & Domain+Managed</br>Support</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">899</span><span class="per-month">/yr*</span></span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12 padding-0 d-flex">
        <div class="row align-self-center" data-aos="fade-right">
            <div class="banner-button"><a href="{{url('hosting/linux-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
        </div>
    </div>
</div>
@elseif($ProductBanner->id == 15)
<div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
    <div class="col-lg-4 col-12 z-index-1 padding-0">
        <div class="row">
            <div class="banner-1 justify-content-end d-flex">
                <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">Dedicated Hosting</span>
                <div class="banner-wp-blue-logo"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12 z-index-0 padding-0">
        <div class="row">
            <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">2500</span><span class="per-month">/yr*</span></span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12 padding-0 d-flex">
        <div class="row align-self-center" data-aos="fade-right">
            <div class="banner-button"><a href="{{url('servers/vps-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
        </div>
    </div>
</div>
@endif
<div class="lading_bottom">
    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
    @include('template.'.$themeversion.'.faq-section')
    @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
    <div class="hostingtype_div head-tb-p-40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if($ProductBanner->id == 4)
                    <h3 class="text_head text-center">Need to know something more? See if you find your answer here</h3>
                    @else
                    <div class="section-heading">
                    <h3 class="text_head text-center">Didn't hit your sweet spot?</h3>
                </div>
                    @endif
                </div>
                @php $p = 0; $class = ''; $color = ''; $info = ''; @endphp
                @foreach($FeaturedProductsData as $FeaturedProducts)
                @php if ($p == '0'){
                $class = 'd-flex justify-content-end';
                $color = 'left_part';
                } else {
                $class = '';
                $color = 'right_part';
                } @endphp
                <div class="col-lg-6 {{$color}} {{$class}}">
                    <div class="hosting_box d-flex">
                        <div class="image align-self-center" data-aos="fade-right" data-aos-delay="250">
                            <i class="{{$FeaturedProducts->varIconClass}}"></i>
                            <div class="hosting-price-start" title="{{ $FeaturedProducts->varWHMCSFieldName }}">Starting at
                                @if(Config::get('Constant.sys_currency') == 'INR')
                                <span class="color-green"><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</strong>/mo*</span>
                                @else
                                <span class="color-green"><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_USD') }}</strong>/mo*</span>
                                @endif
                            </div>
                        </div>
                        <div class="info" data-aos="fade-left" data-aos-delay="100">
                            <h2 class="name">{{$FeaturedProducts->varTitle}}</h2>
                            <h3 class="info-text">{{$FeaturedProducts->varShortDescription}}</h3>
                            @php $FeaturedProductsDec = explode("\n",$FeaturedProducts->varFeature); @endphp
                            <ul class="list">
                                @foreach($FeaturedProductsDec as $info)
                                <li><span>{{$info}}</span></li>
                                @endforeach
                            </ul>
                            <a href="{{$FeaturedProducts->varButtonLink}}" class="btn" title="{{$FeaturedProducts->varButtonName}}">{{$FeaturedProducts->varButtonName}}</a>
                        </div>
                    </div>
                </div>
                @php $p++;@endphp
                @endforeach
            </div>
        </div>
    </div>
    @endif


    <div class="product_offers">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-10">
                    <div class="product_offers_main">
                        <div class="product_offers_head">
                            <h2>Web Hosting</h2>
                        </div>
                        <div class="product_offers_cnt">
                            <div class="product_offers_price">
                                <ul>
                                    <li class="product_offers_prc_head">Starting From</li>
                                    <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>45<span class="month_icon">/mo*</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product_offers_btn">
                            <a href="https://www.hostitsmart.com/web-hosting">Click to Host Today</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function LoadFeatures(fea, count) {
            //                                                                            var i;
            //                                                                                    for (i = 5; i < count; i++) {
            //                                                                            $("#" + fea + i).show();
            //                                                                            }
            //                                                                            $("#" + fea).hide();
        }
    </script>
    <script type="text/javascript">
        $("#monthly").prop('checked', false);
    </script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false
                }
            }
        })
    </script>




    @endsection