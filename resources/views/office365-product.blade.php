@extends('layouts.app')
@section('content')

<div class="vps_main {{$ProductBanner->varBannerIconClass}}">
    @if(!empty($ProductBanner) && count((array)$ProductBanner) > 0)
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

                <?php /*<div class="banner-button" data-aos="fade-up" data-aos-delay="500">
                    <a class="btn-primary" title="Choose Plan">Choose Plan</a>
                    <a class="btn-primary Click-to-Bottom" title="View Features" href="#features">View Features</a>
                </div>*/?>
            </div>
        </div>
    </div>
    @endif

<div class="inner_container head-tb-p-40">
    <div class="aws-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="section-heading">
                        <h2 class="text-center text_head">Microsoft 365 Online - Increased Efficiency. Better Teamwork</h2>
                            <p>Transform the way you work! Leave behind the need to move around and coordinate with different people to discuss the project or a report. Give a boost to your productivity and professionalism with Microsoft 365. Microsoft 365 comprises of separate Microsoft tools aimed at automating the work and helping you collaborate directly with your colleagues or clients whether they are seven seas away or just next to your room, anytime, anywhere from any device.</p>
                            <p>Whether you are a neoteric start-up, a growing business or a large enterprise, you can buy Microsoft 365 business plan and rely on it to improve your work productivity. With a business class email in your Microsoft 365 plan, you also develop a persona of your brand and convey the brand’s professionalism.
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
    <div class="vps-plan-main-div head-tb-p-40 @if($ProductBanner->id == 7) vpsplan_slider_div @endif @if($ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 13 || $ProductBanner->id == 8) dedicated-plan-main-div @endif">
        

        <div class="container">
            <div class="row">
                
                <div class="col-sm-12">
                <div class="section-heading">
                <h4 class="text-center text_head">Surf, Select & Get Started: Microsoft 365 Business Plans and Pricing</h4>
                </div>
                </div>


                @if($ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 13) {{-- Set $ProductBanner->id == 8 for dedicated server --}}
                <div class="col-12">
                    <div class="dedicated-head">
                        <h4 class="server-head" data-aos="fade-up" data-aos-delay="200">SELECT SERVER LOCATION</h4>
                        <span class="server-text2" data-aos="fade-up" data-aos-delay="300">(Website traffic from India? Get 10x faster speed!)</span>
                        <ul class="nav-server-location">
                            <li><a href="javascript:void(0)" onclick="changeLocation('India');" title="India" class="show active-tab" id="loc1"><i class="hosting-location-icon map-india"></i></a></li>
                            <li><a href="javascript:void(0)" onclick="changeLocation('USA');" title="USA" class="" id="loc2"><i class="hosting-location-icon map-america"></i></a></li>
                        </ul>
                    </div>
                </div>
                <script type="text/javascript">
                            function changeLocation(locstr){
                                $('input[id^="location"]').each(function(i, ele){ $(this).val(locstr); console.log(locstr + " " + $(this).attr("id")); });
                            }
                </script>
                @endif	
                @php if($ProductBanner->id != 8){ @endphp
                {{-- <div class="switch-plan">
                    <div class="month-tab tab-left-save active aos-init" data-aos="fade-left" data-aos-delay="400">Monthly @if(!empty($ProductBanner->varSaveTextMonth)) <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextMonth}}</span> @endif </div>
                    <label class="switch aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="100">
                        <input type="checkbox" name="monthly" id="monthly" onclick="calc();"> <span class="slider round"></span>
                    </label>
                    <div class="month-tab aos-init" data-aos="fade-right" data-aos-delay="400">Yearly @if(!empty($ProductBanner->varSaveTextYear)) <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextYear}}</span> @endif </div>
                </div> --}}
                @php } @endphp
                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp
                <script type="text/javascript">
                            function calc()
                            {
                            if ($('#monthly').is(":checked"))
                            {
                            $("#twoyear").addClass("active show");
                                    $("#oneyear").removeClass("active show");
                                    $("#threeyear").removeClass("active show");
                                    // setTimeout(function(){
                                    // $("#vps-plan2").addClass("active show");
                                    //         $("#vps-plan1").removeClass("active show");
                                    //         $("#vps-plan3").removeClass("active show");
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
                            }
                            else
                            {
                            $("#threemonths").addClass("active show");
                                    $("#onemonths").removeClass("active show");
                                    $("#sixmonths").removeClass("active show");
                                    // setTimeout(function(){
                                    // $("#vps-plan2").addClass("active show");
                                    //         $("#vps-plan1").removeClass("active show");
                                    //         $("#vps-plan3").removeClass("active show");
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
                            }
                            }
                </script>
                @php } else {  @endphp
                <script type="text/javascript">
                    function calc()
                    {
                    if ($('#monthly').is(":checked"))
                    {
                    $("#twoyear").addClass("active show");
                            $("#oneyear").removeClass("active show");
                            $("#threeyear").removeClass("active show");
                            // setTimeout(function(){
                            // $("#vps-plan2").addClass("active show");
                            //         $("#vps-plan1").removeClass("active show");
                            //         $("#vps-plan3").removeClass("active show");
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
                    }
                    else
                    {
                    $("#threemonths").addClass("active show");
                            $("#onemonths").removeClass("active show");
                            $("#sixmonths").removeClass("active show");
                            // setTimeout(function(){
                            // $("#vps-plan2").addClass("active show");
                            //         $("#vps-plan1").removeClass("active show");
                            //         $("#vps-plan3").removeClass("active show");
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
                    }
                    }
                </script>
                @php } @endphp
                <?php /*<div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='monthshow'>
                    <ul class="nav nav-pills nav-vps-hosting @if($ProductBanner->id == 7) pb-10 @endif">
                        <li><a data-toggle="pill" href="#vps-plan1" title="1 month" id='onemonths'>1 month @if(!empty($ProductBanner->varOfferTextOneMonth))<span><span class="bg-color">{{$ProductBanner->varOfferTextOneMonth}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan2" title="3 months" id='threemonths' class="active show">3 months @if(!empty($ProductBanner->varOfferTextThreeMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeMonth}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan3" title="6 months" id='sixmonths'>6 months @if(!empty($ProductBanner->varOfferTextSixMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextSixMonth}}</span></span>@endif</a></li>
                    </ul>
                </div>
                <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='yearshow' style="display: none">
                    <ul class="nav nav-pills nav-vps-hosting @if($ProductBanner->id == 7) pb-10 @endif">
                        <li><a data-toggle="pill" href="#vps-plan1" title="1 month" id='oneyear'>1 year @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan2" title="2 months" id='twoyear' class="active show">2 years @if(!empty($ProductBanner->varOfferTextTwoYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextTwoYear}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan3" title="3 months" id='threeyear'>3 years @if(!empty($ProductBanner->varOfferTextThreeYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeYear}}</span></span>@endif</a></li>
                    </ul>
                </div> */?>

                @php if($ProductBanner->id == '10'){
                $mainclassssl = 'ssl-small';
                }else{
                $mainclassssl = '';
                } @endphp
                @php if($ProductBanner->id == '7') {  @endphp 
                        <div class="ukvtab_div">
                            <div class="tab-content">
                                <div class="tab-pane-inner">
                                    <div class="range-slider">
                                        <div class="clearfix slider-info">
                                            <label for="ghz-value1">CPU</label>
                                            <input type="text" id="ghz-value1" readonly> <small>Core</small>
                                        </div>
                                        <div id="ghz-slider1" class="value-slider"></div>
                                    </div>
                                    <div class="range-slider">
                                        <div class="clearfix slider-info">
                                            <label for="mb-value1">RAM</label>
                                            <input type="text" id="mb-value1" readonly> <small>GB</small>
                                        </div>
                                        <div id="mb-slider1" class="value-slider"></div>
                                    </div>
                                    <div class="range-slider">
                                        <div class="clearfix slider-info">
                                            <label for="gb-value1">HDD</label>
                                            <input type="text" id="gb-value1" readonly> <small>GB</small>
                                        </div>
                                        <div id="gb-slider1" class="value-slider"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @php } @endphp 
                <div class="tab-content {{$mainclassssl}}">
                    
                    <!--This Code for One Months and One Year-->
                    <div id="vps-plan1" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row">
                                @php $class = ''; $class1 = ''; $class3 = ''; $PostShow = '4'; @endphp
                                <?php /*<div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        <div class="plan-head" >{{$ProductsPackageData[0]->varTitle}}
                                            
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at 1</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="StarterOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_1_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="StarterOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="StarterOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_1_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="StarterOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthINR))
                                                        <div id='StarterOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneMonthINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearINR))
                                                        <div id='StarterOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthUSD))
                                                        <div id='StarterOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price" id='StarterOneMonthUSD'>{{$ProductsPackageData[0]->intOldPriceOneMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearUSD))
                                                        <div id='StarterOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearUSD}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[0]->varAdditionalOffer}})</span>
                                                </div>
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="StarterOneMonth" onclick="LoadFeatures('StarterOneMonth','{{$StarterOneMonth}}');" style="{{$StarterOneMonth4}}" ><i class="la la-plus"></i>More</a>
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
                                             @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('StarterOneMonthFeatures')" href="javascript:;" data-scroll-to="#StarterOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>*/?>
                                @php $class = ''; $class1 = '';
                                if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                $class = 'recommanded'; 
                                $class1 = 'recommanded-icon'; 
                                } @endphp
                                <?php /*<div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div {{$class}}">
                                         
                                         <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at 2</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="PerformOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_1_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="PerformOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_1_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthINR))
                                                        <div id='PerformOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id='PerformOneMonthINR'>{{$ProductsPackageData[1]->intOldPriceOneMonthINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearINR))
                                                        <div id='PerformOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthUSD))
                                                        <div id='PerformOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearUSD))
                                                        <div id='PerformOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearUSD}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[1]->varAdditionalOffer}})</span></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="PerformOneMonth" onclick="LoadFeatures('PerformOneMonth','{{$PerformOneMonth}}');" style="{{$PerformOneMonth4}}" ><i class="la la-plus"></i>More</a>
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
                                             @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('PerformanceOneMonthFeatures')" href="javascript:;" data-scroll-to="#PerformanceOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>*/?>
                                <?php /*<div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            
                                        </div>
                                        
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at 3</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_1_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_1_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthINR))
                                                        <div id='BusinessOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearINR))
                                                        <div id='BusinessOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthUSD))
                                                        <div id='BusinessOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearUSD))
                                                        <div id='BusinessOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearUSD}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[2]->varAdditionalOffer}})</span></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="BusinessOneMonth" onclick="LoadFeatures('BusinessOneMonth','{{$BusinessOneMonth}}');" style="{{$BusinessOneMonth4}}" ><i class="la la-plus"></i>More</a>
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
                                             @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>*/?>
                            </div>
                        </div>
                    </div>
                    <!--This Code for Three Months and Two Year-->
                    <div id="vps-plan2" class="tab-pane active show">
                        <div class="plan-main-div">
                            <div class="row">
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        <div class="plan-head" >{{$ProductsPackageData[0]->varTitle}}
                                            
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                {{-- <span class="vps-price" id="StarterOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_1_INR') }}</strong>/user/mo*
                                                </span> --}}
                                                <span class="vps-price" id="StarterOneYearWhmcsINR">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                {{-- <span class="vps-price" id="StarterOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_1_USD') }}</strong>/user/mo*
                                                </span> --}}
                                                <span class="vps-price" id="StarterOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthINR))
                                                        {{-- <div id='StarterOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneMonthINR}} /user/mo*</span> 
                                                        </div> --}}
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearINR))
                                                        <div id='StarterOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthUSD))
                                                       {{--  <div id='StarterOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price" id='StarterOneMonthUSD'>{{$ProductsPackageData[0]->intOldPriceOneMonthUSD}} /user/mo*</span> 
                                                        </div> --}}
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearUSD))
                                                        <div id='StarterOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearUSD}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[0]->varAdditionalOffer}})</span>
                                                </div>
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="StarterOneMonth" onclick="LoadFeatures('StarterOneMonth','{{$StarterOneMonth}}');" style="{{$StarterOneMonth4}}" ><i class="la la-plus"></i>More</a>
                                           {{--  <div class="vps-plan-btm" id="StarterMonthlyButtonText">
                                                {!!$StarterMonthlyButtonText!!}
                                            </div> --}}
                                            <div class="vps-plan-btm" id="StarterOneYearButtonText">
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
                                             @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('StarterOneMonthFeatures')" href="javascript:;" data-scroll-to="#StarterOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>
                                @php $class = ''; $class1 = '';
                                if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                $class = 'recommanded'; 
                                $class1 = 'recommanded-icon'; 
                                } @endphp
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div {{$class}}">
                                         
                                         <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="PerformOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_1_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="PerformOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_1_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthINR))
                                                        <div id='PerformOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id='PerformOneMonthINR'>{{$ProductsPackageData[1]->intOldPriceOneMonthINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearINR))
                                                        <div id='PerformOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthUSD))
                                                        <div id='PerformOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearUSD))
                                                        <div id='PerformOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearUSD}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[1]->varAdditionalOffer}})</span></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="PerformOneMonth" onclick="LoadFeatures('PerformOneMonth','{{$PerformOneMonth}}');" style="{{$PerformOneMonth4}}" ><i class="la la-plus"></i>More</a>
                                            {{-- <div class="vps-plan-btm" id="PerformanceMonthlyButtonText">
                                                {!!$PerformanceMonthlyButtonText!!}
                                            </div> --}}
                                            <div class="vps-plan-btm" id="PerformanceOneYearButtonText">
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
                                             @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('PerformanceOneMonthFeatures')" href="javascript:;" data-scroll-to="#PerformanceOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            
                                        </div>
                                        
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_1_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_1_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthINR))
                                                        <div id='BusinessOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearINR))
                                                        <div id='BusinessOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthUSD))
                                                        <div id='BusinessOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearUSD))
                                                        <div id='BusinessOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearUSD}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[2]->varAdditionalOffer}})</span></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="BusinessOneMonth" onclick="LoadFeatures('BusinessOneMonth','{{$BusinessOneMonth}}');" style="{{$BusinessOneMonth4}}" ><i class="la la-plus"></i>More</a>
                                            {{-- <div class="vps-plan-btm" id="BusinessMonthlyButtonText">
                                                {!!$BusinessMonthlyButtonText!!}
                                            </div> --}}
                                            <div class="vps-plan-btm" id="BusinessOneYearButtonText" >
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
                                             @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>
                                <?php /*<div class="col-md-4 col-xs-12 col-12 align-self-center" data-aos="fade-right" data-aos-easing="ease-out-back">
                                    <div class="vps-plan-div">
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at 6</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessThreeMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_3_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessTwoYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_24_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessThreeMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_3_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessTwoYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_24_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeMonthINR))
                                                        <div id='BusinessThreeMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeMonthINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceTwoYearINR))
                                                        <div id='BusinessTwoYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceTwoYearINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeMonthUSD))
                                                        <div id='BusinessThreeMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceTwoYearUSD))
                                                        <div id='BusinessTwoYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[2]->intOldPriceTwoYearUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[2]->varAdditionalOffer}})</span></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                                    <li  id='BusinessThreeMonth{{$BusinessThreeMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($BusinessThreeMonth >= 5)
                                                </div>
                                                @endif
                                                @php $BusinessThreeMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="BusinessThreeMonth" onclick="LoadFeatures('BusinessThreeMonth','{{$BusinessThreeMonth}}');" style="{{$BusinessThreeMonth4}}" ><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="BusinessThreeMonthlyButtonText">
                                                {!!$BusinessThreeMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="BusinessTwoYearButtonText" style="display: none">
                                                {!!$BusinessTwoYearButtonText!!}
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
                                            @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>*/?>
                            </div>
                        </div>
                    </div>
                    <!--This Code for Six Months and Three Year-->
                    <?php /*<div id="vps-plan3" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row">
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        <div class="plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at 7</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="StarterSixMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_6_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="StarterThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_36_INR') }}</strong>/user/mo*

                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="StarterSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_6_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="StarterThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_36_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceSixMonthINR))
                                                        <div id='StarterSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id="StarterSixMonthINR">{{$ProductsPackageData[0]->intOldPriceSixMonthINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                        <div id='StarterThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeYearINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceSixMonthUSD))
                                                        <div id='StarterSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceSixMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearUSD))
                                                        <div id='StarterThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeYearUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[0]->varAdditionalOffer}})</span></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="StarterSixMonth" onclick="LoadFeatures('StarterSixMonth','{{$StarterSixMonth}}');" style="{{$StarterSixMonth4}}" ><i class="la la-plus"></i>More</a>
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
                                            @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('StarterOneMonthFeatures')" href="javascript:;" data-scroll-to="#StarterOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp
                                        </div>
                                    </div>
                                </div>
                                @php if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                $class = 'recommanded'; 
                                $class1 = 'recommanded-icon'; 
                                } @endphp
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div {{$class}}">
                                        <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at 8</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="PerformSixMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_6_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="PerformThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_36_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="PerformSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_6_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="PerformThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_36_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceSixMonthINR))
                                                        <div id='PerformSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceSixMonthINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                        <div id='PerformThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceThreeYearINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceSixMonthUSD))
                                                        <div id='PerformSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceSixMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearUSD))
                                                        <div id='PerformThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceThreeYearUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[1]->varAdditionalOffer}})</span></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="PerformSixMonth" onclick="LoadFeatures('PerformSixMonth','{{$PerformSixMonth}}');" style="{{$PerformSixMonth4}}" ><i class="la la-plus"></i>More</a>
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
                                            @php if($ProductBanner->id == '7') {  @endphp 
                                           <div class="v-f_link">
                                                <a onclick="VPSFeatures('PerformanceOneMonthFeatures')" href="javascript:;" data-scroll-to="#PerformanceOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div" >
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at 9</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessSixMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_6_INR') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_36_INR') }}</strong>/user/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_6_USD') }}</strong>/user/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_36_USD') }}</strong>/user/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 

                                                        @if(!empty($ProductsPackageData[2]->intOldPriceSixMonthINR))
                                                        <div id='BusinessSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceSixMonthINR}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                        <div id='BusinessThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeYearINR}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceSixMonthUSD))
                                                        <div id='BusinessSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceSixMonthUSD}} /user/mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearUSD))
                                                        <div id='BusinessThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeYearUSD}} /user/mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[2]->varAdditionalOffer}})</span></div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="BusinessSixMonth" onclick="LoadFeatures('BusinessSixMonth','{{$BusinessSixMonth}}');" style="{{$BusinessSixMonth4}}" ><i class="la la-plus"></i>More</a>

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
                                            @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>*/?>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@php if($ProductBanner->id == 7) { @endphp
<div class="vps-features vps-plan-features" id="StarterOneMonthFeatures" style="display: none">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">Features of Starter</h2>
                <div class="features-start">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon containerized-server"></i></div>
                                    <h3>Containerized Based Virtualization</h3>
                                    <div class="content">Multiple secure, isolated Linux containers on a single physical server enabling better server utilization and ensuring that applications do not conflict.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon secureandrobust"></i></div>
                                    <h3>Serial SSH Console</h3>
                                    <div class="content">The serial console is a feature that enables an SSH connection through a separate IP address using a session-specific, random username and password. The serial console feature is included so that you can connect to your VPS in case you misconfigure your network configuration, firewall or anything that disables you to remotely connect the VPS.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon virtual-support"></i></div>
                                    <h3>Paravirtualization Technology</h3>
                                    <div class="content">This is a lightweight VM which shares host kernel and delivers higher performance than full virtualization because the operating system and hypervisor work together more efficiently.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon containerized-server"></i></div>
                                        <h3>Containerized Based Virtualization</h3>
                                        <div class="content">Multiple secure, isolated Linux containers on a single physical server enabling better server utilization and ensuring that applications do not conflict.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon secureandrobust"></i></div>
                                        <h3>Serial SSH Console</h3>
                                        <div class="content">The serial console is a feature that enables an SSH connection through a separate IP address using a session-specific, random username and password. The serial console feature is included so that you can connect to your VPS in case you misconfigure your network configuration, firewall or anything that disables you to remotely connect the VPS.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon virtual-support"></i></div>
                                        <h3>Paravirtualization Technology</h3>
                                        <div class="content">This is a lightweight VM which shares host kernel and delivers higher performance than full virtualization because the operating system and hypervisor work together more efficiently.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="vps-features vps-plan-features" id="PerformanceOneMonthFeatures">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">Features of Performance</h2>
                <div class="features-start">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon privacy-protected"></i></div>
                                    <h3>Security</h3>
                                    <div class="content">KVM uses a combination of security-enhanced Linux (SELinux) and secure virtualization (sVirt) for enhanced VM security and isolation. SELinux establishes security boundaries around VMs. sVirt extends SELinux's capabilities, allowing Mandatory Access Control (MAC) security to be applied to guest VMs and preventing manual labeling errors.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon migration"></i></div>
                                    <h3>Live migration</h3>
                                    <div class="content">KVM supports live migration, which is the ability to move a running VM between physical hosts with no service interruption. The VM remains powered on, network connections remain active, and applications continue to run while the VM is relocated. KVM also saves a VM's current state so it can be stored and resumed later.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon scale-with-ease"></i></div>
                                    <h3>Power & Scalability</h3>
                                    <div class="content">Kernel-based Virtual Machine (KVM) is a virtualization infrastructure for the Linux kernel that turns it into a hypervisor, a program that allows multiple independent operating systems to share a single hardware host and a great control. This gives better isolation & security to each virtual server without compromising on performance.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon privacy-protected"></i></div>
                                        <h3>Security</h3>
                                    <div class="content">KVM uses a combination of security-enhanced Linux (SELinux) and secure virtualization (sVirt) for enhanced VM security and isolation. SELinux establishes security boundaries around VMs. sVirt extends SELinux's capabilities, allowing Mandatory Access Control (MAC) security to be applied to guest VMs and preventing manual labeling errors.</div>
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon migration"></i></div>
                                        <h3>Live migration</h3>
                                    <div class="content">KVM supports live migration, which is the ability to move a running VM between physical hosts with no service interruption. The VM remains powered on, network connections remain active, and applications continue to run while the VM is relocated. KVM also saves a VM's current state so it can be stored and resumed later.</div>
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon scale-with-ease"></i></div>
                                        <h3>Power & Scalability</h3>
                                        <div class="content">Kernel-based Virtual Machine (KVM) is a virtualization infrastructure for the Linux kernel that turns it into a hypervisor, a program that allows multiple independent operating systems to share a single hardware host and a great control. This gives better isolation & security to each virtual server without compromising on performance.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="vps-features vps-plan-features" id="BusinessOneMonthFeatures" style="display: none">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">Features of Business</h2>
                <div class="features-start">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon multiple-support"></i></div>
                                    <h3>Multiple Platform Support</h3>
                                    <div class="content">Xen is a hypervisor that supports x86, x86_64, Itanium, and ARM architectures, and can run Linux, Windows, Solaris, and some of the BSDs as guests on their supported CPU architectures. It's supported by a number of companies.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon scale-with-ease"></i></div>
                                    <h3>Light Hypervisor</h3>
                                    <div class="content">Xen having a smaller foot print would probably the lightest hypervisor you may have among the popular virtualization technologies.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon virtual-support"></i></div>
                                    <h3>HVM and PV support</h3>
                                    <div class="content">Xen integrates with Hardware Virtual Machine (HVM) and Paravirtualization (PV) in the hypervisor.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon multiple-support"></i></div>
                                        <h3>Multiple Platform Support</h3>
                                    <div class="content">Xen is a hypervisor that supports x86, x86_64, Itanium, and ARM architectures, and can run Linux, Windows, Solaris, and some of the BSDs as guests on their supported CPU architectures. It's supported by a number of companies.</div>
                               </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon scale-with-ease"></i></div>
                                        <h3>Light Hypervisor</h3>
                                    <div class="content">Xen having a smaller foot print would probably the lightest hypervisor you may have among the popular virtualization technologies.</div>
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon virtual-support"></i></div>
                                        <h3>HVM and PV support</h3>
                                    <div class="content">Xen integrates with Hardware Virtual Machine (HVM) and Paravirtualization (PV) in the hypervisor.</div>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php }  @endphp 

@if(!empty($FeaturesData) && count($FeaturesData) >0)
@php if($ProductBanner->id == '10' || $ProductBanner->id == '4'){
        if($ProductBanner->id == 7 ||$ProductBanner->id == 8){
            $mainclass = 'ssl-features';
        } else {
            $mainclass = '';
        }
    $mobileclass = '';
    $imageclass = 'd-flex justify-content-center align-items-center';
}   else    {
    $mainclass = '';
    $mobileclass = '';
    $imageclass = '';
} @endphp
<div class="vps-features {{$mainclass}}" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                @php if($ProductBanner->id == 4){ @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features that bring a 5 star wordpress experience to your plate</h2>
                @php } else if($ProductBanner->id == 7) { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features to up your gear</h2>
                @php } else if($ProductBanner->id == 8) { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features to make you unstoppable</h2>
                @php } else if($ProductBanner->id == 22) { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Tools that Put You in Control</h2>
                @php } else { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features put you in control</h2>
                @php } @endphp

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
                                <div class="content-main align-self-start" @if ($uagent != "mobile")data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100" @endif>
                                    <div class="{{$featureIconDivClass}}"><i class="{{$Features->varIconClass}}"></i></div>
                                    <h3>{{$Features->varTitle}}</h3>
                                    <div class="content">{!! $Features->varShortDescription !!}</div>
                                </div>
                            </div>
                            @if ($uagent == "mobile") </div> @endif
                            @endforeach
                    @if ($uagent == "mobile")
                    </div>
                    @else
                        </div>
                    </div>
                    @endif
                </div>

                {{-- <div class="features-start features-start-mob d-md-none d-block">
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
<?php /*@if($ProductBanner->id != 8)
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
                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                        <p>Account will be deployed on an IP which are not shared among other users.</p><span>Get a dedicated IP for stronger brand recognition at {!! Config::get('Constant.sys_currency_symbol') !!} {{ Config::get('Constant.DEDICATED_IP_PRICE_INR') }}/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                         @php } else { @endphp 
                        <p>Account will be deployed on an IP which are not shared among other users.</p><span>Get a dedicated IP for stronger brand recognition at {!! Config::get('Constant.sys_currency_symbol') !!} {{ Config::get('Constant.DEDICATED_IP_PRICE_USD') }}/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                         @php } @endphp
                </div>
                <div id="offer2" class="tab-pane">
                    <div class="offer-tab-text" data-aos="fade-up">
                        <h3>SSL</h3>
                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                        <p>SSL certificate encrytps the data between user and web-server, making it imposible to trace back user's sensitive information</p><span>Get the security of Positive SSL for single domain at {!! Config::get('Constant.sys_currency_symbol') !!} {{ Config::get('Constant.SSL_PRICE_INR') }}/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                        @php } else { @endphp 
                        <p>SSL certificate encrytps the data between user and web-server, making it imposible to trace back user's sensitive information</p><span>Get the security of Positive SSL for single domain at {!! Config::get('Constant.sys_currency_symbol') !!} {{ Config::get('Constant.SSL_PRICE_USD') }}/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                        @php } @endphp
                </div>
                @else
                <div id="offer1" class="tab-pane active show">
                    <div class="offer-tab-text" data-aos="fade-up">
                        <h3>CodeGuard</h3>
                         @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                        <p> Code guard monitors your website and gives you an option to restore in case you get something deleted accidently.</p><span>Get the protection of code guard at {!! Config::get('Constant.sys_currency_symbol') !!} {{ Config::get('Constant.CODEGAURD_PRICE_INR') }}/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                         @php } else { @endphp 
                        <p> Code guard monitors your website and gives you an option to restore in case you get something deleted accidently.</p><span>Get the protection of code guard at {!! Config::get('Constant.sys_currency_symbol') !!} {{ Config::get('Constant.CODEGAURD_PRICE_USD') }}/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                         @php } @endphp
                </div>
                <div id="offer2" class="tab-pane">
                    <div class="offer-tab-text" data-aos="fade-up">
                        <h3>Site Lock</h3>
                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                        <p>SiteLock automatically scans your website for malware 24x7 to ensure they are not being blocked or spammed</p><span>Get the protection of code guard at {!! Config::get('Constant.sys_currency_symbol') !!} {{ Config::get('Constant.SITELOCK_PRICE_INR') }}/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                        @php } else { @endphp 
                        <p>SiteLock automatically scans your website for malware 24x7 to ensure they are not being blocked or spammed</p><span>Get the protection of code guard at {!! Config::get('Constant.sys_currency_symbol') !!} {{ Config::get('Constant.SITELOCK_PRICE_USD') }}/yr</span> <a href="<?= $renew_link ?>" <?= $login_attr ?> <?= $target ?> class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a></div>
                        
                         @php } @endphp
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif */?>
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
        <div class="row stretch-height">
            <div class="banner-1 justify-content-end d-flex">
                <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">Special Package Offer</span>
                <div class="banner-wp-blue-logo"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12 z-index-0 padding-0">
        <div class="row">
            <div class="banner-text2">
                <span class="starting-from">Linux Hosting & Domain+Managed</br>Support</span> 
                <span class="whole-span">
                    @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SPECIAL_PACKAGE_OFFER_1_INR') }}</span><span class="per-month">/user/mo*</span>
                     @php } else { @endphp 
                    <span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SPECIAL_PACKAGE_OFFER_1_USD') }}</span><span class="per-month">/user/mo*</span>
                      @php } @endphp
                </span>
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
            <div class="row stretch-height">
                <div class="banner-1 justify-content-end d-flex">
                    <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">VPS hosting Deals</span>
                    <div class="banner-wp-blue-logo"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 z-index-0 padding-0">
            <div class="row">
                 @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_INR') }}</span><span class="per-month">/user/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_USD') }}</span><span class="per-month">/user/mo*</span></span>
                 @php } @endphp

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 padding-0 d-flex">
            <div class="row align-self-center" data-aos="fade-right">
                <div class="banner-button"><a href="{{url('servers/vps-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
            </div>
        </div>
    </div>
    </div>
@endif


<div class="vps-features head-tb-p-40" id="features">
                    <div class="container">
                        <div class="row">
                            <div class="features-main">
                                <div class="section-heading">
                                <h2 class="text_head text-center">Tools that Put You in Control</h2>
                                </div>
                                <div class="features-start">
                                    <div class="row">
                                        <div class="feature-ul d-flex flex-wrap">
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_exchange mail-at-company"></i>
                                                    </div>
                                                    <h3>Exchange</h3>
                                                    <div class="content">A one-stop email, calendaring, contact, scheduling and collaboration platform for fast track work.</div>
                                                </div>
                                            </div>
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_onedrive meetings"></i>
                                                    </div>
                                                    <h3>OneDrive</h3>
                                                    <div class="content">Store, sync, and share various types of files and access them seamlessly from your Windows, Mac OS, iOS, and Android devices.</div>
                                                </div>
                                            </div>
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_sharepoint video-call"></i>
                                                    </div>
                                                    <h3>SharePoint</h3>
                                                    <div class="content">Store everything that matters from documents to videos at one, centralized platform and make information easily accessible for your employees.</div>
                                                </div>
                                            </div>
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_team meetings"></i>
                                                    </div>
                                                    <h3>Microsoft Teams</h3>
                                                    <div class="content">A platform that combines workplace chat, file sharing, meetings and other notes to help collaborate efficiently.</div>
                                                </div>
                                            </div>
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_doc meetings"></i>
                                                    </div>
                                                    <h3>Document</h3>
                                                    <div class="content">Create, edit, and share files, sheets, and presentations from anywhere, anytime and any device.</div>
                                                </div>
                                            </div>
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_access meetings"></i>
                                                    </div>
                                                    <h3>Access</h3>
                                                    <div class="content">A database management tool that helps refer, report, and analyze a large amount of information and manage it more efficiently.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--features-start end -->
                                <div class="features-start features-start-mob d-md-none d-block">
                                    <!-- features-start-mob -->
                                    <div class="owl-carousel owl-theme">
                                        <div class="item">
                                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_exchange mail-at-company"></i>
                                                    </div>
                                                    <h3>Exchange</h3>
                                                    <div class="content">A one-stop email, calendaring, contact, scheduling and collaboration platform for fast track work.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_onedrive meetings"></i>
                                                    </div>
                                                    <h3>OneDrive</h3>
                                                    <div class="content">Store, sync, and share various types of files and access them seamlessly from your Windows, Mac OS, iOS, and Android devices.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_sharepoint video-call"></i>
                                                    </div>
                                                    <h3>SharePoint</h3>
                                                    <div class="content">Store everything that matters from documents to videos at one, centralized platform and make information easily accessible for your employees.</div>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="item">
                                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_team video-call"></i>
                                                    </div>
                                                    <h3>Microsoft Teams</h3>
                                                    <div class="content">A platform that combines workplace chat, file sharing, meetings and other notes to help collaborate efficiently.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_doc video-call"></i>
                                                    </div>
                                                    <h3>Document</h3>
                                                    <div class="content">Create, edit, and share files, sheets, and presentations from anywhere, anytime and any device.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start">
                                                    <div class="feature-icon">
                                                        <i class="vps-features-icon office-365-features ms_access video-call"></i>
                                                    </div>
                                                    <h3>Access</h3>
                                                    <div class="content">A database management tool that helps refer, report, and analyze a large amount of information and manage it more efficiently.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- features-start-mob  end-->
                            </div>
                            <!-- features-main end -->
                        </div>
                    </div>
                </div>

<div class="g-suite-lists head-tb-p-40 office365-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-heading">
                                <h2 class="text_head text-center">Your Office - Anytime, Anywhere</h2>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-icons first-impression"></div>
                                    <div class="g-list-box">
                                        <h4>A great first impression</h4>
                                        <span>Show customers you mean business with your professional business email</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-icons autosync"></div>
                                    <div class="g-list-box">
                                        <h4>Automatic sync</h4>
                                        <span>Let not syncing your devices for email be one of the things you need to worry about</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-icons rt-collaboration"></div>
                                    <div class="g-list-box">
                                        <h4>Real-time Collaboration</h4>
                                        <span>Work with your team across seven seas or next room, smoothly and edit docs and presentations together in real-time.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-icons easywork"></div>
                                    <div class="g-list-box">
                                        <h4>Work made easy</h4>
                                        <span>Work on-the-go with Microsoft 365 online. So, set up your office wherever you are</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-icons reducecost"></div>
                                    <div class="g-list-box">
                                        <h4>Reduced cost</h4>
                                        <span>Avoid huge up-front cost with the monthly subscription of Microsoft 365</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-icons workspace"></div>
                                    <div class="g-list-box">
                                        <h4>Collaborative workspace</h4>
                                        <span>Work better as a team by creating a well-informed environment and document and calendar sharing</span>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-icons scalebusiness"></div>
                                    <div class="g-list-box ">
                                        <h4>Scale your business</h4>
                                        <span>Company growing rapidly? Purchase an additional license to accommodate your needs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                    
<div class="lading_bottom">
  <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
        @include('template.'.$themeversion.'.faq-section')
    @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
    <div class="hostingtype_div">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                     @if($ProductBanner->id == 4)
                    <h3 class="title">Need to know something more? See if you find your answer here</h3>
                    @else
                    <h3 class="title">Didn't hit your sweet spot?</h3>
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
                            <div class="hosting-price-start" title="{{ $FeaturedProducts->varWHMCSFieldName }}">Starting at 10
                                @if(Config::get('Constant.sys_currency') == 'INR')
                                <span class="color-green" title=""><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</strong>/user/mo*</span>
                                @else
                                <span class="color-green"><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_USD') }}</strong>/user/mo*</span>
                                @endif
                            </div>
                        </div>
                        <div class="info" data-aos="fade-left" data-aos-delay="100">
                            <h2 class="name">{{$FeaturedProducts->varTitle}}</h2>
                            <h3 class="info-text">{{$FeaturedProducts->varShortDescription}}</h3>
                            @php $FeaturedProductsDec = explode("\n",$FeaturedProducts->varFeature); @endphp 
                            <ul class="list">
                                @foreach($FeaturedProductsDec as $info)
                                <li><h6>{{$info}}</h6></li>
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
    @if($ProductBanner->id == 2  || $ProductBanner->id == 6)
    <div class="promotion_div">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-4 col-12">
                    <div class="row justify-content-end stretch-height">
                        <div class="limited-promotion">
                            <span class="" data-aos="fade-left">Limited <br/>Time <br/>Promotion</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 padding-0">
                    <div class="new_customer">
                        <div class="offer-promo-img" data-aos="zoom-in">
                            <span class="offer-text">25% <span>Off</span>
                            </span>
                        </div>
                        <div class="combine-div">
                            <span class="offer">on shared hosting<br></span>
                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                            <div class="price-part">
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SHARED_HOSTING_OFFER_2_INR') }}</span><span class="per-month">/user/mo*</span></span>
                            </div>
                            @php } else { @endphp 
                             <div class="price-part">
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SHARED_HOSTING_OFFER_2_USD') }}</span><span class="per-month">/user/mo*</span></span>
                            </div>
                            @php } @endphp
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex"> <a href="{{url('hosting/linux-hosting')}}" class="btn align-self-center" data-aos="fade-left" title="Get Started">Get Started</a> </div>	
            </div>
        </div>
    </div>
    @elseif($ProductBanner->id == 4)
    <div class="promotion_div">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-4 col-12">
                    <div class="row justify-content-end stretch-height">
                        <div class="limited-promotion">
                            <span class="" data-aos="fade-left">Limited <br/>Time <br/>Promotion</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 padding-0">
                    <div class="new_customer">
                        <div class="offer-promo-img" data-aos="zoom-in">
                            <span class="offer-text">50% <span>Off</span>
                            </span>
                        </div>
                        <div class="combine-div">
                            <span class="offer">Book Domains: .life, .world, .rocks, .today<br></span>
                            <div class="price-part">
                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                	<span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">{{ Config::get('Constant.HOSTING_PAGE_DOMAIN_OFFER_1_INR') }}</span><span class="per-month">/user/mo*</span></span>
                                 @else
                                	<span class="whole-span"><span class="ruppess">&#36;</span> <span class="big-price">{{ Config::get('Constant.HOSTING_PAGE_DOMAIN_OFFER_1_USD') }}</span><span class="per-month">/user/mo*</span></span>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex"> <a href="{{url('domain')}}" class="btn align-self-center" data-aos="fade-left" title="Get Started">Get Started</a> </div>   
            </div>
        </div>
    </div>
    @elseif($ProductBanner->id == 1 )
        <div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
        <div class="col-lg-4 col-12 z-index-1 padding-0">
            <div class="row stretch-height">
                <div class="banner-1 justify-content-end d-flex">
                    <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">Dedicated Hosting</span>
                    <div class="banner-wp-blue-logo"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 z-index-0 padding-0">
            <div class="row">
                 @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.DEDICATED_HOSTING_OFFER_1_INR') }}</span><span class="per-month">/user/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.DEDICATED_HOSTING_OFFER_1_USD') }}</span><span class="per-month">/user/mo*</span></span>
                 @php } @endphp

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 padding-0 d-flex">
            <div class="row align-self-center" data-aos="fade-right">
                <div class="banner-button"><a href="{{url('servers/vps-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
            </div>
        </div>
    </div>
    </div>
    @elseif($ProductBanner->id == 12 || $ProductBanner->id == 13)
        <div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
        <div class="col-lg-4 col-12 z-index-1 padding-0">
            <div class="row stretch-height">
                <div class="banner-1 justify-content-end d-flex">
                    <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">VPS hosting Deals</span>
                    <div class="banner-wp-blue-logo"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 z-index-0 padding-0">
            <div class="row">
                 @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_INR') }}</span><span class="per-month">/user/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_USD') }}</span><span class="per-month">/user/mo*</span></span>
                 @php } @endphp

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 padding-0 d-flex">
            <div class="row align-self-center" data-aos="fade-right">
                <div class="banner-button"><a href="{{url('servers/vps-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
            </div>
        </div>
    </div>
    </div>
    @endif
</div>
<div class="product_offers">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
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
//    var i;
//            for (i = 5; i < count; i++) {
//    $("#" + fea + i).show();
//    }
//    $("#" + fea).hide();
}
</script>
   @php if($ProductBanner->id == '7') {  @endphp 
<script src="{{ url('/') }}/assets/js/vps-range-jquery-ui.js"></script>
<script>
    function VPSFeatures(id){
        if(id == 'StarterOneMonthFeatures'){
              $('#StarterOneMonthFeatures').show();
              $('#PerformanceOneMonthFeatures').hide();
              $('#BusinessOneMonthFeatures').hide();
        } else if (id == 'PerformanceOneMonthFeatures'){
             $('#StarterOneMonthFeatures').hide();
             $('#PerformanceOneMonthFeatures').show();
             $('#BusinessOneMonthFeatures').hide();
        } else if (id == 'BusinessOneMonthFeatures'){
             $('#StarterOneMonthFeatures').hide();
             $('#PerformanceOneMonthFeatures').hide();
             $('#BusinessOneMonthFeatures').show();
        }
    }
    
    $("[data-scroll-to]").click(function() {
        var $this = $(this),
            $toElement      = $this.attr('data-scroll-to'),
            $focusElement   = $this.attr('data-scroll-focus'),
            $offset         = $this.attr('data-scroll-offset') * 1 || 0,
            $speed          = $this.attr('data-scroll-speed') * 1 || 500;

        $('html, body').animate({
          scrollTop: $($toElement).offset().top + $offset
        }, $speed);

        if ($focusElement) $($focusElement).focus();
      });
      
</script>
<script>
    $(document).ready(function() {   
        $( ".planform" ).each(function( index ) {
            var id = $( this ).attr('id');
            var form_id = id.split('_');
            $("#"+id).append("<input type='hidden' name='vps_cpu[]' id='vps_cpu"+form_id[3]+"' value='2' /> ");
            $("#"+id).append("<input type='hidden' name='vps_ram[]' id='vps_ram"+form_id[3]+"' value='2' /> ");
            $("#"+id).append("<input type='hidden' name='vps_hdd[]' id='vps_hdd"+form_id[3]+"' value='15' /> ");
           });
    });
    
     $( function() {
    $( "#ghz-slider1" ).slider({
      min: 2,
      max: 6,
      step: 2,
      value: 2,
      slide: function( event, ui ) {
        $( ".planform" ).each(function( index ) {
            var id = $( this ).attr('id');
            var form_id = id.split('_');
            $("#vps_cpu"+form_id[3]).val(ui.value);
           });
           $( "#ghz-value1" ).val( ui.value );
      }
    });
    $( "#ghz-value1" ).val( $( "#ghz-slider1" ).slider( "value" ) );
  });
  
   $( function() {
    $( "#mb-slider1" ).slider({
      min: 2,
      max: 6,
      step: 2,
      value: 2,
      slide: function( event, ui ) {
           $( ".planform" ).each(function( index ) {
            var id = $( this ).attr('id');
            var form_id = id.split('_');
            $("#vps_ram"+form_id[3]).val(ui.value);
           });
           $( "#mb-value1" ).val( ui.value );
      }
    });
     $( "#mb-value1" ).val( $( "#mb-slider1" ).slider( "value" ) );
  });
  
  $( function() {
    $( "#gb-slider1" ).slider({
      min: 15,
      max: 50,
      value: 15,
      slide: function( event, ui ) {
           $( ".planform" ).each(function( index ) {
            var id = $( this ).attr('id');
            var form_id = id.split('_');
            $("#vps_hdd"+form_id[3]).val(ui.value);
           });
           $( "#gb-value1" ).val( ui.value );
      }
    });
    $( "#gb-value1" ).val( $( "#gb-slider1" ).slider( "value" ) );
  });
  </script>
 @php }  @endphp 
 <script type="text/javascript">
     $("#monthly").prop('checked', false);
     setTimeout(function(){ $("#monthly").click(); $("#threeyear").click(); },1000); //set 3 year pricing
 </script>
 @endsection
