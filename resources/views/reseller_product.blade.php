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
            </div>
        </div>
    </div>
    @endif
    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
        <div class="container">
            <div class="row">
            @php 
            if($ProductBanner->id == 1){ @endphp
            <div class="col-sm-12">
                <div class="cms">
                <h4 class="text-center big_title blue_title">
                    High-octane Linux Hosting in India
                </h4>
                <p>Power your business with something that furnishes your website with lightning speed coupled with an intuitive control panel. Unlock the world of unlimited possibilities with a reliable Linux web hosting. Our scalable and measurable shared web hosting services have helped many businesses achieve their business-critical mission without paying high prices. Let's get your business from now to next!</p>
                <p>Our cheap Linux web hosting services are perfect for SMBs looking for an affordable yet dynamic hosting solution. It is like renting the flat and sharing resources with other tenants. This allows you to have your private space along with necessary resources at a fraction of price. We have a starter as well as economy Linux hosting plans with cPanel to match your needs.</p>
                <br />
            </div>
            </div>
            @php } elseif($ProductBanner->id == 2){ @endphp
            <div class="col-sm-12">
                <div class="cms">
                <h4 class="text-center big_title blue_title">
                    High-octane Windows Hosting in India
                </h4>
                <p>Web Hosting providers generally provide both, Windows and Linux operating system options and it can get challenging for the user to decide which one to opt for owing to the individual benefits of either of these options. The Windows Server Hosting tends to offer comparatively more options when referring to website technologies, has strong security backed by leading foreign corporations and is often found easier to configure by the beginners and thus, is considered to be the best hosting platform in spite of being the expensive one around.</p>
                <p>Windows Hosting Page is basically referred to the websites that are hosted through the means of the Windows Operating System. Ideally, Windows Web Hosting is the kind of service that should be adopted by you in case you plan to use certain specific Microsoft applications like Active Server Pages (ASP) or aim to develop your website with Microsoft FrontPage. The Windows Web Hosting is widely popular for providing extremely powerful, end-to-end management, reliability and scalability features along with its highlighting features of integrating the business with the internet and any Microsoft products to the website. Windows Hosting Plans are considerably the most preferred ones considering the highlighting features that they offer namely</p>
                <br />
            </div>
            </div>
            @php } elseif($ProductBanner->id == 12){ @endphp
            <div class="col-sm-12">
                <div class="cms">
                <h4 class="text-center big_title blue_title">
                    High-octane Windows Reseller Hosting in India
                </h4>
                <p>Reseller Hosting basically refers to the kind of web hosting service in which the account owner creates sub-packages well within the allotted bandwidth and disk space of his main hosting page and sells it to his customers with a certain amount of profit. Windows Reseller Hosting basically refers to the kind of hosting where Windows Web Hosting service is purchased in wholesale and sold to the customers by various resellers at certain rate of profit.</p>
                <p>There are various Windows Reseller Hosting Options in India competing to be the best Windows Reseller Hosting providers in the market. There are some Cheap Windows Reseller Hosting options available as well.</p>
                <p>HostItSmart offers you some of the best Windows Reseller Hosting options available in the market owing to the various features that it offers:</p>
                <br />
            </div>
            </div>
            @php } @endphp
            <div class="container">
            <div class="row">
            
            <div class="col-sm-12">
                <div class="cms">
                <h4 class="text-center big_title blue_title">
                    Cheap Linux Reseller Hosting in India
                </h4>
                <p>Reseller Hosting basically refers to the kind of web hosting service in which the account owner creates sub-packages well within the allotted bandwidth and disk space of his main hosting page and sells it to his customers with a
                certain amount of profit. Linux Reseller Hosting basically refers to the kind of hosting where Windows Web Hosting service is purchased in wholesale and sold to the customers by various resellers at certain rate of profit.</p>
                <p>The Linux Reseller Hosting can be a good option to choose as it allows its users to manage all aspects of their site quite effectively considering the better control that it provides. The users of the Linux Reseller Hosting Plans get to
                subjectively decide upon their bandwidth limit and disc space usage. In addition to the above, The Linux Reseller Hosting by HostItSmart offers an array of features like:</p>
                <br />
            </div>
            </div>
            
            </div>
     </div>
            </div>
     </div>

    <div class="vps-plan-main-div @if($ProductBanner->id == 7) vpsplan_slider_div @endif @if($ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 13 || $ProductBanner->id == 8) dedicated-plan-main-div @endif">
        <div class="container">
            <div class="row">
            
                 <div class="col-sm-12">
               <div class="cms">
                    @php if($ProductBanner->id == 8){ @endphp
                    <h4 class="text-center green_title f_weight_500">Quality hosting does not mean elephantile costs. Not atleast with our plans.</h4>
                    @php } else if($ProductBanner->id == 4){ @endphp
                    <h4 class="text-center green_title f_weight_500">Wordpress Beginner or a full grown business, we have something for you, always!</h4>
                    <p>Wordpress is amazing!. But when you have a ton to do about your business, you seldom will have the time to understand tiny technicalities of running your WordPress site. That’s where the best Wordpress hosting in India comes into the frame. Regular back up, uptime maintenance, speed, scalability, security, literally everything - is taken care of, while you put your efforts into growing your business.
                    </p>
                    @php } else if($ProductBanner->id == 1){ @endphp
                    <h4 class="text-center green_title f_weight_500">Quality hosting does not mean elephantine costs. Not with our Linux shared hosting plans at least</h4>
                    @php } else if($ProductBanner->id == 13){ @endphp
                    <h4 class="text-center green_title f_weight_500">Quality Java Hosting does not mean elephantile costs. Not atleast with our Java Hosting plans</h4>
                    @php } else if($ProductBanner->id == 2){ @endphp
                    <h4 class="text-center green_title f_weight_500">Quality Windows hosting with Plesk does not mean elephantine costs. Not with our Windows hosting plans at least!</h4>
                    @php } else { @endphp
                    <b><h4 class="text-center blue_title f_weight_500">Choose Your Linux Reseller Hosting Plan</h4></b>
                    @php } @endphp
                </div>
                </div>
                @if($ProductBanner->id == 4)
                 <div class="col-12">
                    <br />
                    <div class="dedicated-head">
                        <h4 class="server-head" data-aos="fade-up" data-aos-delay="200">Choose Your WordPress Hosting Plan</h4>
                        <span class="server-text2" data-aos="fade-up" data-aos-delay="300">(Select Server Location)</span>
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
                @if($ProductBanner->id == 6 || $ProductBanner->id == 13) {{-- Set $ProductBanner->id == 8 for dedicated server --}}
                <div class="col-12">
                    <br />
                    <div class="dedicated-head">
                        <h4 class="server-head" data-aos="fade-up" data-aos-delay="200">Select Server Location</h4>
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
                @php if($ProductBanner->id != 15){ @endphp
                <div class="switch-plan">
                    <div class="month-tab tab-left-save  aos-init" data-aos="fade-left" data-aos-delay="400">Monthly @if(!empty($ProductBanner->varSaveTextMonth)) <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextMonth}}</span> @endif </div>
                    <label class="switch aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="100">
                        <input type="checkbox" name="monthly" id="monthly" onclick="calc();"> <span class="slider round"></span>
                    </label>
                    <div class="month-tab aos-init active" data-aos="fade-right" data-aos-delay="400">Yearly @if(!empty($ProductBanner->varSaveTextYear)) <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextYear}}</span> @endif </div>
                </div>
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
                <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='monthshow'>
                    <ul class="nav nav-pills nav-vps-hosting">
                        <li><a data-toggle="pill" href="#vps-plan2" title="3 months" id='threemonths' >3 months @if(!empty($ProductBanner->varOfferTextThreeMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeMonth}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan3" title="6 months" id='sixmonths'>6 months @if(!empty($ProductBanner->varOfferTextSixMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextSixMonth}}</span></span>@endif</a></li>
                        <li><a data-toggle="pill" href="#vps-plan1" title="1 month" id='oneyear' class="active show">1 year @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                    </ul>
                </div>

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
                    <div id="vps-plan1" class="tab-pane active show">
                        <div class="plan-main-div">
                            <div class="row justify-content-center">
                                @php $class = ''; $class1 = ''; $class3 = ''; $PostShow = '4'; @endphp
                                <div class="col-md-3 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        <div class="plan-head" >{{$ProductsPackageData[0]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="StarterOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="StarterOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthINR))
                                                        <div id='StarterOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearINR))
                                                        <div id='StarterOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthUSD))
                                                        <div id='StarterOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price" id='StarterOneMonthUSD'>{{$ProductsPackageData[0]->intOldPriceOneMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearUSD))
                                                        <div id='StarterOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearUSD}} /mo*</span>
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
                                                {!!$StarterOneYearButtonText!!}
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
                                </div>
                                @php $class = ''; $class1 = '';
                                if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                $class = 'recommanded'; 
                                $class1 = 'recommanded-icon'; 
                                } @endphp
                                <div class="col-md-3 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div {{$class}}">
                                         
                                         <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="PerformOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="PerformOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthINR))
                                                        <div id='PerformOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id='PerformOneMonthINR'>{{$ProductsPackageData[1]->intOldPriceOneMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearINR))
                                                        <div id='PerformOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthUSD))
                                                        <div id='PerformOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearUSD))
                                                        <div id='PerformOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearUSD}} /mo*</span>
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
                                                {!!$PerformanceOneYearButtonText!!}
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
                                </div>
                                <div class="col-md-3 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessOneMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessOneMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthINR))
                                                        <div id='BusinessOneMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearINR))
                                                        <div id='BusinessOneYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthUSD))
                                                        <div id='BusinessOneMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearUSD))
                                                        <div id='BusinessOneYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearUSD}} /mo*</span>
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
                                                {!!$BusinessOneYearButtonText!!}
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--This Code for Three Months and Two Year-->
                    <div id="vps-plan2" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row justify-content-center">
                                <div class="col-md-3 col-xs-12 col-12 align-self-center" data-aos="fade-left" data-aos-easing="ease-out-back">
                                    <div class="vps-plan-div">
                                        <div class="plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="StarterThreeMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_3_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterTwoYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_24_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="StarterThreeMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_3_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterTwoYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_24_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeMonthINR))
                                                        <div id='StarterThreeMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceTwoYearINR))
                                                        <div id='StarterTwoYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceTwoYearINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeMonthUSD))
                                                        <div id='StarterThreeMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceTwoYearUSD))
                                                        <div id='StarterTwoYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceTwoYearUSD}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[0]->varAdditionalOffer}})</span>
                                                </div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                                    <li  id='StarterThreeMonth{{$StarterThreeMonth}}'><span>{{$Specification}}</span></li>
                                                    @if ($StarterThreeMonth >= 5)
                                                </div>
                                                @endif 
                                                @php $StarterThreeMonth++; @endphp
                                                @endforeach
                                            </ul>
                                            <a class="more-features" title="More" href="javascript:void(0)" id="StarterThreeMonth" onclick="LoadFeatures('StarterThreeMonth','{{$StarterThreeMonth}}');" style="{{$StarterThreeMonth4}}" ><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="StarterThreeMonthlyButtonText">
                                                {!!$StarterThreeMonthlyButtonText!!}
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
                                <div class="col-md-3 col-xs-12 col-12 align-self-center" data-aos="zoom-in" data-aos-easing="ease-out-back">
                                    <div class="vps-plan-div {{$class}}">
                                        <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="PerformThreeMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_3_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformTwoYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_24_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="PerformThreeMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_3_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformTwoYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_24_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeMonthINR))
                                                        <div id='PerformThreeMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceThreeMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceTwoYearINR))
                                                        <div id='PerformTwoYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceTwoYearINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeMonthUSD))
                                                        <div id='PerformThreeMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id='PerformThreeMonthUSD'>{{$ProductsPackageData[1]->intOldPriceThreeMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceTwoYearUSD))
                                                        <div id='PerformTwoYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceTwoYearUSD}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } @endphp 
                                                    </span>
                                                    <span class="price-save">({{$ProductsPackageData[1]->varAdditionalOffer}})</span>
                                                </div>
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="vps-plan-features" >
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
                                            <a class="more-features" title="More" href="javascript:void(0)" id="PerformThreeMonth" onclick="LoadFeatures('PerformThreeMonth','{{$PerformThreeMonth}}');" style="{{$PerformThreeMonth4}}" ><i class="la la-plus"></i>More</a>
                                            <div class="vps-plan-btm" id="PerformanceThreeMonthlyButtonText">
                                                {!!$PerformanceThreeMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="PerformanceTwoYearButtonText" style="display: none">
                                                {!!$PerformanceTwoYearButtonText!!}
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
                                <div class="col-md-3 col-xs-12 col-12 align-self-center" data-aos="fade-right" data-aos-easing="ease-out-back">
                                    <div class="vps-plan-div">
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessThreeMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_3_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessTwoYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_24_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessThreeMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_3_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessTwoYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_24_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeMonthINR))
                                                        <div id='BusinessThreeMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeMonthINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceTwoYearINR))
                                                        <div id='BusinessTwoYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceTwoYearINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeMonthUSD))
                                                        <div id='BusinessThreeMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceTwoYearUSD))
                                                        <div id='BusinessTwoYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[2]->intOldPriceTwoYearUSD}} /mo*</span> 
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--This Code for Six Months and Three Year-->
                    <div id="vps-plan3" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row justify-content-center">
                                <div class="col-md-3 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        <div class="plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="StarterSixMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_6_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_36_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="StarterSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_6_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_36_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceSixMonthINR))
                                                        <div id='StarterSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id="StarterSixMonthINR">{{$ProductsPackageData[0]->intOldPriceSixMonthINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                        <div id='StarterThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeYearINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceSixMonthUSD))
                                                        <div id='StarterSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceSixMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearUSD))
                                                        <div id='StarterThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeYearUSD}} /mo*</span> 
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
                                <div class="col-md-3 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div {{$class}}">
                                        <div class="plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="PerformSixMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_6_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_36_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="PerformSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_6_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_36_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceSixMonthINR))
                                                        <div id='PerformSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceSixMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                        <div id='PerformThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceThreeYearINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceSixMonthUSD))
                                                        <div id='PerformSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceSixMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearUSD))
                                                        <div id='PerformThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceThreeYearUSD}} /mo*</span> 
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
                                <div class="col-md-3 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div" >
                                        <div class="plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessSixMonthWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_6_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessThreeYearWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_36_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessSixMonthWhmcsUSD">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_6_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessThreeYearWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_36_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 

                                                        @if(!empty($ProductsPackageData[2]->intOldPriceSixMonthINR))
                                                        <div id='BusinessSixMonthINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceSixMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                        <div id='BusinessThreeYearINR' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeYearINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceSixMonthUSD))
                                                        <div id='BusinessSixMonthUSD' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceSixMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearUSD))
                                                        <div id='BusinessThreeYearUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeYearUSD}} /mo*</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@php if($ProductBanner->id == 7) { @endphp
<div class="vps-features vps-plan-features" id="StarterOneMonthFeatures" style="display: none">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">Features of Starter</h2>
                <div class="features-start d-md-block d-none">
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
                <div class="features-start d-md-block d-none">
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
                <div class="features-start d-md-block d-none">
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

@if($ProductBanner->id == 2)
<div class="aws-content">
        <div class="aws-managed-services">  
<div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="cms">
                        <h2 class="text-center aos-animate aos-init">Blazing Fast Windows Web Hosting in India</h2>
                        <div class="aws-para aos-animate aos-init">
                            <p>Get the speed you desire with our full-line of fine-tuned options for cheap Windows hosting. Choose from our high-octane Windows hosting plans in India and give your business the functionality you want.
                        </p><br />
                        </div>
                    </div>
                </div>
            </div>     
</div>
</div>
</div>
<div class="g-suite-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="g_s_l-title">Why Choose Windows Hosting?</h2>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">1</i>
                                        <h4>ASP.NET Hosting</h4>
                                        <span>This kind of hosting runs on the browser as well on the backend and thus is preferred by most and is available on Windows Web Hosting. </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>One-click Script Installs</h4>
                                        <span>Even the cheap Windows Hosting options available in the current scenario offer the option of one-click script installing, thus, minimalizing the entire process of configuration.
                                        </span>
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>MS Access and MS SQL </h4>
                                        <span>MS Access is the comparatively older database which is used for the smaller, more basic purposes whereas MS SQL is the newer, more recent version and both these versions are available on Windows Web Hosting options.</span>
                                    </div>
                                </div>
                            </div>
                         
                            </div>
                    </div>
                </div>
@endif
@if($ProductBanner->id == 12)
                <div class="g-suite-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="g_s_l-title">Choose HostITSmart To Start Your Own Business!</h2>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">1</i>
                                        <h4>Flexibility</h4>
                                        <span>HostItSmart has a comfortable level of flexibility with its tools and resources. </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>Scalability</h4>
                                        <span>HostItSmart offers you scalability options wherein you can increase or decrease the resources as per your subjective requirements.
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>Instant provisioning</h4>
                                        <span>We at HostItSmart provide you with instant provisioning enabling you to get started with the website as soon as you purchase it.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <i class="list-num">4</i>
                                        <h4>Fast & simple</h4>
                                        <span>The Windows Reseller Hosting interface offered by HostItSmart is extremely fast, simple and easy to use and easy to adapt to.
                                        </span>
                                    </div>
                                </div>
                            </div>
                           </div>
                    </div>
                </div>          
@endif
@if(Request::segment(2)=='linux-hosting')
	<!-- combo offer section start -->
	<div class="combo-offer-section" id="comboofferplan">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="combo_main_title">Linux Hosting Combo Offer</h3>
					<p class="combo_sub_text">This combo makes it easy for you to get one stop solution to start a website. Few steps and you can make your own professional website. Get Domain, Free SSL with Hosting & Five Emails all in one combo pack.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-3 col-12">
					<div class="combo_item">
						<div class="combo_title"><i class="combo_icon c_i_domain"></i> Domain</div>
						<div class="combo_features">
							<ul>
								<li>.com / .in</li>
								<li>DNS Management</li>
								<li>Domain Forwarding</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-3 col-12">
					<div class="combo_item">
						<div class="combo_title"><i class="combo_icon c_i_hosting"></i> Hosting</div>
						<div class="combo_icon"></div>
						<div class="combo_features">
							<ul>
								<li>1 Domain Hosting</li>
								<li>10 GB Storage</li>
								<li>1 MySql Database</li>
								<li>5 Emails</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-3 col-12">
					<div class="combo_item combo_item_last">
						<div class="combo_title"><i class="combo_icon c_i_ssl"></i> SSL Certificate</div>
						<div class="combo_icon"></div>
						<div class="combo_features">
							<ul>
								<li>Single Domain</li>
								<li>Domain Validation</li>
								<li>Free Let's Encrypt SSL</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-3 col-12">
					<div class="combo_item_price">
						<div class="c_i_p_border">
							<span class="sub_text">At Just</span>
							<div class="c_i_amount_part">
								<span class="ruppess">&#8377;</span> <span class="combo_i_price">180</span><span class="pmon">/mo</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<form action="https://www.hostitsmart.com/cart/store" method="post" name="form_hosting_218" id="form_hosting_218" class="planform">
                       <input type="hidden" id="producttype" name="producttype[]" value="hosting">
                       <input type="hidden" id="pid" name="pid[]" value="218">
                       <input type="hidden" id="billingcycle" name="billingcycle[]" value="annually">
                       <input type="hidden" id="location" name="location[]" value="India">
                       <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                      <button type="submit"  title="Grab Now!" class="btn-primary" title="Grab Now!">Grab Now!</button> 
                     </form>
				</div>
			</div>
		</div>
	</div>
	<!-- combo offer section end -->
@endif
@php if($ProductBanner->id == 4){ @endphp
<div class="aws-content">
<div class="aws-managed-services">  
<div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="cms">
                        <h2 class="text-center aos-animate aos-init">Blazing Best WordPress Hosting in India</h2>
                        <div class="aws-para aos-animate aos-init">
                            <p>WordPress Hosting refers to any particular form of web hosting that has been specifically optimized to function with the websites made with the help of WordPress. Certain websites that have been built with the help of the WordPress platform can face some functionality-based issues if not used optimized properly. This can basically lead to issues in certain elements loading properly, increased load time or even the website becoming unreachable altogether.
                            </p>
                            <p>WordPress Hosting is basically a shared, optimized web hosting used for running WordPress sites in particular. This type of hosting is largely and widely preferred by more and more WordPress users owing to its wide spectrum of highlighting characteristics like overall highlighting performance inclusive of security, reliability, effectiveness and a great loading speed amongst others. Using the WordPress platform to build and architect your website is one of the most simplified ways to launch your new business or blog. You have multiple options based on the type of project you plan to launch thus, providing you with a number of WordPress Web Hosting plans to choose from. There are four broad types of WordPress Hosting namely:
                            </p>
                        <br />
                        </div>
                    </div>
                </div>
            </div>     
</div>
</div>
</div>

<div class="g-suite-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                               
                            </div>
                        <div class="col-sm-6 col-12">
                            <div class="g_s_l-box">
                                <div class="g-list-box">
                                <i class="list-num">1</i>
                                <h4>Free WordPress Hosting</h4>
                                <span>This kind of WordPress Hosting is offered by some companies for free but which rarely is actually good. This WordPress hosting plan is ideally not preferred by anyone looking out for real business or a noteworthy online presence taking into consideration the multiple drawbacks of this type of hosting.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>Shared WordPress Hosting</h4>
                                        <span>Here multiple users host their individual sites on the same server which is being administered by the hosting provider. It is comparatively a cheap WordPress hosting option as
                                        compared to the others.</span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>VPS WordPress Hosting</h4>
                                        <span>Here, more privileges are offered to the users by allowing them to run multiple WordPress sites and make more profits in addition to being a much faster, stable and advanced method.</span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">4</i>
                                        <h4>Managed WordPress Hosting</h4>
                                        <span>Here, the hosting provider takes care of the entire management of all the technical aspects like the site backup, server activation, continuous optimization, monitoring and maintenance
                                        and thus in more expensive as compared to the other hosting options available. Managed WordPress Hosting arguably is considered to be the best web hosting for WordPress.</span>
                                    </div>
                                </div>
                        </div>
            </div>
     </div>
</div>

<div class="g-suite-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="g_s_l-title">Why Choose WordPress Hosting?</h2>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">1</i>
                                        <h4>Optimized for High-Performance</h4>
                                        <span>Several performance degrading factors such as the WordPress configuration, hosting environment, software versions, etc. can degrade or affect the overall performance of your
                                        WordPress website or blog. Whether you have a high traffic WordPress or a small, shared hosting blog, it is very important to optimize your account and the server to avoid such situations.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>Backup Solutions</h4>
                                        <span>Backups can be the biggest relief in case of unforeseen dire situations like accidently signing out of your site or a case of hacking where you might lose all your data. There are a number of free and paid WordPress backup plugins available in WordPress Hosting India
                                        and most of them are quite easy to use.</span>
                                    </div>
                                </div>
                            </div>

                             <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>Automatic Updates</h4>
                                        <span>WordPress 3.7 introduced the feature of automatic updates with the specific purpose of improving the security and the site administration. Broadly there are four typologies of updates in the WordPress automatic updates namely- the Core updates, the Plugin updates, the theme updates and the updates for the Transition Files.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">4</i>
                                        <h4>Easy site management</h4>
                                        <span>There are numerous WordPress management tools available that make it extremely easy to manage multiple WordPress websites from a solo dashboard which is beneficial as it helps you to
                                        install and keep all the WordPress plugins up to date.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">5</i>
                                        <h4>Faster sites and better performance</h4>
                                        <span>The popularity and traffic on your website or blog largely depends on the overall loading speed of your website and if it takes long to upload on the user’s systems, it will result
                                        in a considerable decrease in the traffic received by your site. But with WordPress Hosting, powered by SSD, your website loads quickly on the viewer’s systems and helps increase your google search rankings and increase the traffic.</span>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">6</i>
                                        <h4>One-Click Staging Environments</h4>
                                        <span>WordPress offers you with a site staging option which can be effectively used to make safe plugin updates and any other alterations before going live.</span>
                                    </div>
                                </div>
                            </div>
                             
                            </div>
                    </div>
                </div>
@php } @endphp
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
                @php } else { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features Of Our Reseller Linux Hosting</h2>
                @php } @endphp

                @php
                    $featureMainDivClass;
                    $featureIconDivClass;
                    if ($uagent == "mobile") {
                        $featureMainDivClass="features-start features-start-mob d-md-none d-block";
                        $featureIconDivClass="feature-icon";
                    }else{
                        $featureMainDivClass="features-start d-md-block d-none";
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
<br />
<div class="g-suite-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="g_s_l-title">Why Choose Linux Reseller Hosting?</h2>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">1</i>
                                        <h4>Host Unlimited Website</h4>
                                        <span>It has the option of unlimited Linux reseller hosting which allows the users to host unlimited websites under the same hosting plan.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>100% SSD Storage</h4>
                                        <span>It offers a vast, 100% Solid State Data storage which is one its most beneficial factors.</span>
                                    </div>
                                </div>
                            </div>

                             <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>Web Host Manager</h4>
                                        <span>It allows its users and administrative access to the back end of the cPanel with the help of the Web Host Manager.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">4</i>
                                        <h4>One-Click Installer</h4>
                                        <span>HostItSmart offers you a cheap Linux Reseller Hosting plan that comes along with an auto-installer which aids you to install over 400 web applications and scripts with the one-click feature</span>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">5</i>
                                        <h4>Malware Scan & Protection</h4>
                                        <span>HostItSmart has a strong Malware Scan and protection system which keeps any kind of internal.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">6</i>
                                        <h4>Datacenter Choice</h4>
                                        <span>The users are offered with a choice for their preferred Datacenter like that of USA or Singapore amongst others.</span>
                                    </div>
                                </div>
                            </div>
                             
                            </div>
                    </div>
                </div>
@php if($ProductBanner->id == 12){ @endphp
<div class="vps-features {{$mainclass}}" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
               <h2 class="features-title aos-init" data-aos="fade-up">Why Choose HostITSmart Windows Reseller Hosting?</h2>
                <div class="features-start d-md-block d-none">
                    <div class="row">
                       
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon hosting-features-icon cpanel"><i class="hosting-features-icon cpanel"></i></div>
                                    <h3>Host Unlimited Websites</h3>
                                    <div class="content">With HostItSmart Windows Reseller, you have a freehand to host as many sites as you with to. This is referred to as unlimited Windows Reseller Hosting </div>
                                </div>
                            </div>
                        
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon hosting-features-icon cpanel"><i class="hosting-features-icon cpanel"></i></div>
                                    <h3>Efficient Control Panel</h3>
                                    <div class="content">Windows Reseller Web Hosting is powered by the Plesk Control Panel which allows for a convenient interface.</div>
                                </div>
                            </div>
                       
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon hosting-features-icon cpanel"><i class="hosting-features-icon cpanel"></i></div>
                                    <h3>India Datacenter</h3>
                                    <div class="content">The Windows Reseller Web Hosting offered by HostItSmart is tied up to the Indian Datacenter which offers quite good security and efficiency. </div>
                                </div>
                            </div>
                        
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon hosting-features-icon cpanel"><i class="hosting-features-icon cpanel"></i></div>
                                    <h3>Malware Scan and Removal</h3>
                                    <div class="content">The Windows Reseller Web Hosting Scans all the malware preventing it from entering your server and protecting it.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="features-start features-start-mob d-md-none d-block">
                    <div class="{{$mobileclass}}">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="hosting-features-icon cpanel"></i></div>
                                        <h3>Host Unlimited Websites</h3>
                                        <div class="content">With HostItSmart Windows Reseller, you have a freehand to host as many sites as you with to. This is referred to as unlimited Windows Reseller Hosting</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="hosting-features-icon lastest-server"></i></div>
                                        <h3>Efficient Control Panel</h3>
                                        <div class="content">Windows Reseller Web Hosting is powered by the Plesk Control Panel which allows for a convenient interface.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="hosting-features-icon support24"></i></div>
                                        <h3>India Datacenter</h3>
                                        <div class="content">The Windows Reseller Web Hosting offered by HostItSmart is tied up to the Indian Datacenter which offers quite good security and efficiency.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="hosting-features-icon support24"></i></div>
                                        <h3>Malware Scan and Removal</h3>
                                        <div class="content">The Windows Reseller Web Hosting Scans all the malware preventing it from entering your server and protecting it.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>
</div>

    </div>
</div>


@php }
@endphp
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
<div class="intall_apps">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 cms">
                <div class="big_title blue_title">Install These Apps in One-Click</div>
            </div>
        </div>
        <div class="owl-carousel owl-theme row">
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_drupal.png" title="drupal" alt="drupal"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_cubecart.png" title="cubecart" alt="cubecart"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_dolphinpro.png" title="dolphinpro" alt="dolphinpro"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_joomla.png" title="joomla" alt="joomla"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_mybb.png" title="mybb" alt="mybb"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_oxywall.png" title="oxywall" alt="oxywall"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_phpbb.png" title="phpbb" alt="phpbb"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_prestashop.png" title="prestashop" alt="prestashop"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_wordpress.png" title="wordpress" alt="wordpress"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_roundcube.png" title="roundcube" alt="roundcube"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_concrete5.png" title="concrete5" alt="concrete5"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 item">
                <div class="i_app_image">
                    <div class="thumbnail-container">
                        <div class="thumbnail">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_cloudlinux.png" title="cloudlinux" alt="cloudlinux"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                <span class="starting-from">Java Hosting</span> 
                <span class="whole-span">
                    @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.JAVA_HOSTING_STARTER_PRICE_36_INR') }}</span><span class="per-month">/mo*</span>
                     @php } else { @endphp 
                    <span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.JAVA_HOSTING_STARTER_PRICE_36_USD') }}</span><span class="per-month">/mo*</span>
                      @php } @endphp
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12 padding-0 d-flex">
        <div class="row align-self-center" data-aos="fade-right">
            <div class="banner-button"><a href="{{url('hosting/java-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
        </div>
    </div>
</div>
@elseif($ProductBanner->id == 15)

@endif
<div class="lading_bottom">
      @if($ProductBanner->id == 1)
    @if(!empty($testimonialData) && count($testimonialData) >0)
<div class="testomonial-section d-flex">
    <div class="container align-self-center">
        <div class="row">
            <div class="col-12">
                <h2 class="testomonial-head aos-init" data-aos="fade-up">WHAT OUR CUSTOMERS <span class="c-blue">SAY</span></h2>
                <div class="owl-carousel owl-theme" id="testomonial-owl1">
                    @foreach($testimonialData as $testimonialvalue)
                    <div class="item cms col aos-init" data-aos="fade-up">
                        <div class="features-icon">
                         <?php  /*@if(!empty($testimonialvalue->fkIntImgId))
                            <img src="{!! App\Helpers\resize_image::resize($testimonialvalue->fkIntImgId,134,134) !!}" alt="{{ $testimonialvalue->varTitle }}" title="{{ $testimonialvalue->varTitle }}"/>
                            @else
                            <img src="{{url('assets/images/testimonial-m.svg')}}" alt="{{ $testimonialvalue->varTitle }}" title="{{ $testimonialvalue->varTitle }}" />
                            @endif*/
                            ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                        <div class="features-head">
                            {{$testimonialvalue->varTitle}}
                        </div>
                        <p class="features-text">
                            {!! (str_limit($testimonialvalue->txtDescription, 1400)) !!}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
    @endif
    
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
                            <div class="hosting-price-start" title="{{ $FeaturedProducts->varWHMCSFieldName }}">Starting at 
                                @if(Config::get('Constant.sys_currency') == 'INR')
                                <span class="color-green" title=""><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</strong>/mo*</span>
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
    <div class="product_offers">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="product_offers_main">
                    <div class="product_offers_head">
                        <h2>VPS Hosting</h2>
                    </div>
                    <div class="product_offers_cnt">
                        <div class="product_offers_price">
                            <ul>
                            <li class="product_offers_prc_head">Starting From</li>
                            <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR') }}<span class="month_icon">/mo*</span></li>
                            </ul>
                        </div>
                    </div>
                        <div class="product_offers_btn">
                            <a href="https://www.hostitsmart.com/servers/vps-hosting">Click to Host Today</a>
                        </div>
                    
                </div>
            </div>
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
                            <span class="offer-text">50% <span>Off</span>
                            </span>
                        </div>
                        <div class="combine-div">
                            <span class="offer">On Linux Shared Hosting<br></span>
                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                            <div class="price-part">
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.LINUX_HOSTING_STARTER_PRICE_36_INR') }}</span><span class="per-month">/mo*</span></span>
                            </div>
                            @php } else { @endphp 
                             <div class="price-part">
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.LINUX_HOSTING_STARTER_PRICE_36_USD') }}</span><span class="per-month">/mo*</span></span>
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
                            <span class="offer">Book Domains: .COM starting at<br></span>
                            <div class="price-part">
                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                	<span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">{{ Config::get('Constant.MEGAMENU_REGISTER_PRICE_INR') }}</span><span class="per-month">/mo*</span></span>
                                 @else
                                	<span class="whole-span"><span class="ruppess">&#36;</span> <span class="big-price">{{ Config::get('Constant.MEGAMENU_REGISTER_PRICE_USD') }}</span><span class="per-month">/mo*</span></span>
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
                    <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">VPS Hosting</span>
                    <div class="banner-wp-blue-logo"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 z-index-0 padding-0">
            <div class="row">
                 @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR') }}</span><span class="per-month">/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD') }}</span><span class="per-month">/mo*</span></span>
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
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR') }}</span><span class="per-month">/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD') }}</span><span class="per-month">/mo*</span></span>
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

@if($ProductBanner->id == 1)
{{-- <script src="{{Config::get('Constant.CDNURL')}}/assets/js/linux-hosting.js"></script> --}}
<link rel="stylesheet" href="{{Config::get('Constant.CDNURL')}}/assets/css/linux-hosting.css"/>
@endif
@if(isset($_REQUEST['combooffer']) && $_REQUEST['combooffer']=='1')
<script>
   $('html, body').animate({
        scrollTop: $("#comboofferplan").offset().top-200
    }, '2000'); 
</script>
@endif
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
 @endsection