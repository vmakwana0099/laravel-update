@extends('layouts.app')
@section('content')
{{-- <style>
    .plan-price .price-overline-text { display:none !important; }
</style> --}}
<div class="vps_main {{$ProductBanner->varBannerIconClass}}">
    @if(isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
        <?php
        $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
        @include('template.'.$themeversion.'.banner');
    @else
        @if(!empty($ProductBanner) && count((array)$ProductBanner) > 0 && $ProductBanner->id != 1 )
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
        @elseif($ProductBanner->id == 1)
        <div class="hosting_banner_main linux-hosting-banner-main linux-hosting-section">
                <div class="container">
                    <div class="web-hosting-main-top">
                        <div class="row  align-items-center">
                            <div class="col-lg-6">
                                <div class="web-hosting-banner-left">
                                    <h1>Most Trusted Linux Web Hosting</h1>
                                    <h2>Modest & Rich Featured Hosting Solution</h2>
                                    <div class="web-hosting-features">
                                        <ul>
                                            <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>Fully Secured Servers</li>
                                            <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>High-Speed SSD Server</li>
                                            {{-- <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>Free Website Builder</li> --}}
                                            <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>99.9% Uptime Guarantee</li>
                                            <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>1-Click Script Installs</li>
                                        </ul>
                                    </div>
                                    <p class="linux-hosting_pricing">Starting @ <span> Rs 49/mo</span></p>
                                    <div class="web-hosting-plans">
                                        <a href="#plans">
                                        <!-- <a href="{{url('/hosting/linux-hosting#plans')}}"> -->
                                            <button>Get Started</button>
                                        </a></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="web-hosting-banner-left">
                                    <img src="{{url('/assets/images/Linux_Hosting-2.webp')}}" / alt="Linux Hosting" width="600" height="600">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($ProductBanner->id == 2)
            <div class="hosting_banner_main linux-hosting-banner-main windows-hosting-section">
                <div class="container">
                    <div class="web-hosting-main-top">
                        <div class="row  align-items-center">
                            <div class="col-lg-6">
                                <div class="web-hosting-banner-left">
                                    <h1>India’s Best Windows Web Hosting</h1>
                                    <h2>Most Compatible Solution for ASP.NET Websites</h2>
                                    <div class="web-hosting-features">
                                        <ul>
                                            <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>DDoS Protection</li>
                                            <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>99.95% Uptime Guarantee</li>
                                            <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>Fully Secured Emails</li>
                                            <li><i class="fa fa-check-circle web-hosting-features-icon" aria-hidden="true"></i>Plesk For Data Management</li>
                                        </ul>
                                    </div>
                                    <div class="web-hosting-plans">
                                    <p class="linux-hosting_pricing">Starting @ <span> Rs 90/mo</span></p>
                                        <a href="{{url('/hosting/linux-hosting#yearshow')}}">
                                            <button>Get Started</button>
                                        </a>
                                    </div>
                                    <div class="wind-h-banner-talk-to-exprt">
                                        <p>Talk To Our Experts <span>24/7 Chat & Telephonic Support</span></p>
                                    <img src="{{url('/assets/images/chat-icon-2.png')}}" / alt="Windows Hosting">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="web-hosting-banner-left">
                                    <img src="{{url('/assets/images/Windows_Hosting-2.png')}}" / alt="Windows Hosting">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
        <div class="lin-plns-cntnr head-tb-p-40">
    <div class="container">
            <div class="row ">
            @php 
            if($ProductBanner->id == 1){ @endphp
            <div class="col-sm-12">
                <div class="section-heading">
                <h2 class="text_head text-center">
                    High-Octane Linux Hosting in India
                </h2>
                <p class="text-center">Power your business with something that furnishes your website with lightning speed coupled with an intuitive control panel. Unlock the world of unlimited possibilities with a reliable Linux web hosting. Our scalable and measurable shared web hosting services have helped many businesses achieve their business-critical mission without paying high prices. Let's get your business from now to next!</p>
                <p class="text-center">Our cheap Linux web hosting services are perfect for SMBs looking for an affordable yet dynamic hosting solution. It is like renting the flat and sharing resources with other tenants. This allows you to have your private space along with necessary resources at a fraction of price. We have a starter as well as economy Linux hosting plans with cPanel to match your needs.</p>
                 
            </div>
            </div>
            @php } elseif($ProductBanner->id == 4){ @endphp
            <div class="col-sm-12">
                <div class="section-heading mb-0">
                <h2 class="text-center text_head">
                    India’s Best WordPress Hosting
                </h2>
                <p class="text-center">Wordpress is amazing!. But when you have a ton to do about your business, you seldom will have the time to understand tiny technicalities of running your WordPress site. That’s where the best Wordpress hosting in India comes into the frame. Regular back up, uptime maintenance, speed, scalability, security, literally everything - is taken care of, while you put your efforts into growing your business.</p>
                 
            </div>
            </div>
            @php } elseif($ProductBanner->id == 2){ @endphp
            <div class="col-sm-12">
                <div class="section-heading mb-0">
                <h2 class="text-center text_head">
                    High-Octane Windows Web Hosting in India
                </h2>
                <p class="text-center">Web Hosting providers generally provide both Windows and Linux operating system options. It can get challenging for the user to decide which one to opt for, owing to the individual benefits of either of these options. Windows Server Hosting tends to offer comparatively more options when referring to website technologies, has strong security backed by leading foreign corporations, and is often found easier to configure by beginners. Thus, it is considered the best hosting platform despite being the most expensive one.</p>
                <p class="text-center">Windows web hosting is basically referred to the websites that are hosted through the means of the Windows Operating System. Ideally, Windows Web Hosting is the kind of service that should be adopted by you in case you plan to use certain specific Microsoft applications like Active Server Pages (ASP) or aim to develop your website with Microsoft FrontPage. Windows Web Hosting is widely popular for providing extremely powerful, end-to-end management, reliability, and scalability features along with its highlighting features of integrating the business with the internet and any Microsoft products to the website. Windows Hosting Plans are considerably the most preferred ones considering the highlighting features that they offer namely.
</p>
                 
            </div>
            </div>
            @php } elseif($ProductBanner->id == 12){ @endphp
            <div class="col-sm-12">
                <div class="cms">
                <h4 class="text-center big_title blue_title">
                    High-Octane Windows Reseller Hosting in India
                </h4>
                <p>Reseller Hosting basically refers to the kind of web hosting service in which the account owner creates sub-packages well within the allotted bandwidth and disk space of his main hosting page and sells it to his customers with a certain amount of profit. Windows Reseller Hosting basically refers to the kind of hosting where Windows Web Hosting service is purchased in wholesale and sold to the customers by various resellers at certain rate of profit.</p>
                <p>There are various Windows Reseller Hosting Options in India competing to be the best Windows Reseller Hosting providers in the market. There are some Cheap Windows Reseller Hosting options available as well.</p>
                <p>HostItSmart offers you some of the best Windows Reseller Hosting options available in the market owing to the various features that it offers:</p>
                 
            </div>
            </div>
             @php } elseif($ProductBanner->id == 13){ @endphp
            <div class="col-sm-12">
                <div class="cms">
                <h2 class="text-center big_title blue_title">
                    Cheapest Java Hosting Solution
                </h2>
                <p>Java tends to be one of the most popular programming languages across the globe, preferred by majority of the programmers. Java is mainly used for designing software along with hosting other web applications. Java Web Hosting basically refers to a service which provides for a hosting platform allowing you to host your Java based website or application. This kind of web hosting option offers an array of advanced Java Hosting server technologies. Suck kind of Java Hosting Plans facilitate you to install and configure any standard java application without facing any sort of difficulties.</p>
                 
            </div>
            </div>
            @php } elseif($ProductBanner->id == 6){ @endphp
            <div class="col-sm-12">
                <div class="section-heading mt-5">
                <h2 class="text-center text_head">
                    eCommerce Hosting Solutions On Fast Servers
                </h2>
                <p class="text-center">eCommerce hosting is a specialized hosting plan designed specifically for online businesses and eCommerce stores. It offers the infrastructure and features crucial for supporting and managing an online store that allows businesses to smoothly sell products or services to customers over the Internet.</p>
                <p class="text-center">Host IT Smart offers a robust, reliable & fast eCommerce hosting environment, which is a necessity to ensure optimal performance. Since online stores often handle high traffic, it is crucial to have a hosting solution that can handle high volumes of visitors and offers a high-speed website.</p>
                <p class="text-center">We also take Security very seriously as online stores deal with sensitive customer information like payment details and personal data. Our eCommerce hosting solution incorporates robust security measures, including SSL certificates, firewalls, and malware scanning, to maintain a secure website experience.</p>
                <p class="text-center">Additionally, You are not alone when a technical issue arises. Host IT Smart’s customer support assists you with every technical issue or concern that may occur. We ensure timely and knowledgeable support to help customers quickly resolve any issues and maintain smooth operations.</p>
                <p class="text-center">Don’t stress about pricing! Hosting eCommerce websites can be an expensive affair, but Host IT Smart offers some of the cheapest eCommerce hosting options in the market.</p> 
            </div>
            </div>
            @php } @endphp
            </div>
            </div>
     </div>
@php
        if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6){
            $black_friday_2022 = '';
        }else{
            $black_friday_2022 = 'windows-main';
        }

     @endphp

    {{-- <div class="vps-plan-main-div win-pln-box head-tb-p-40">
        <div class="container">
            <div class="row justify-content-center"> --}}
            <div class="web-pln-box head-tb-p-40" id="web_hosting_plan">
                <div class="container-fluid">
                    <div class="shared-plan-bx-pd">
            
                 {{-- <div class="col-sm-12"> --}}
               <div class="section-heading">
                    @php if($ProductBanner->id == 8){ @endphp
                    <h2 class="text-center text_head ">Quality hosting does not mean elephantile costs. Not atleast with our plans.</h2>
                    @php } else if($ProductBanner->id == 4){ @endphp
                    <h2 class="text-center text_head " id="wordPress_hosting_plan">Choose Your WordPress Hosting Plan</h2>
                    @php } else if($ProductBanner->id == 1){ @endphp
                    <h2 class="text-center text_head " id="linux_hosting_plans">Choose Your Linux Hosting Plans</h2>
                    @php } else if($ProductBanner->id == 12){ @endphp
                    <h2 class="text-center text_head " id="landingloc">Choose Your Windows Reseller Hosting Plans</h2>
                    @php } else if($ProductBanner->id == 13){ @endphp
                    <h2 class="text-center text_head " id="landingloc">Choose your Java Hosting Plan</h2>
                    @php } else if($ProductBanner->id == 2){ @endphp
                    <h2 class="text-center text_head " id="windows_hosting_plans">Choose Your Windows Hosting Plans</h2>
                    @php } else if($ProductBanner->id == 6){ @endphp
                    <h2 class="text-center text_head " id="landingloc">Choose Your eCommerce Hosting Plan</h2>
                    @php } else { @endphp
                    <h2 class="text-center text_head " id="landingloc">Quality hosting does not mean elephantile costs. Not atleast with our plans</h2>
                    @php } @endphp
                </div>
                {{-- </div> --}}
                @if($ProductBanner->id == 4)
                 {{-- <div class="col-12">
                     
                    <div class="dedicated-head">
                        <h2 class="server-head" data-aos="fade-up" data-aos-delay="200" id="landingloc">Choose Your WordPress Hosting Plan</h2>
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
                </script> --}}
                @endif
                @if($ProductBanner->id == 6)
                 {{-- <div class="col-12">
                     
                    <div class="dedicated-head"> --}}
                        <!-- <h4 class="server-head" data-aos="fade-up" data-aos-delay="200">Choose Your eCommerce Hosting Plan</h4> -->
                        {{-- <span class="server-text2" data-aos="fade-up" data-aos-delay="300">(Select Server Location)</span>
                        <ul class="nav-server-location">
                            <li><a href="javascript:void(0)" onclick="changeLocation('India');" title="India" class="show active-tab" id="loc1"><i class="hosting-location-icon map-india"></i></a></li>
                            <li><a href="javascript:void(0)" onclick="changeLocation('USA');" title="USA" class="" id="loc2"><i class="hosting-location-icon map-america"></i></a></li>
                        </ul>
                    </div>
                </div> --}}
                @endif
                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6) {{-- Set $ProductBanner->id == 1 for Linux hosting --}}
                 <div class="row">
                <div class="col-12">
                     
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
                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="loc3" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="changeLocation('Germany');">
                                    <img loading="eager" src="../assets/images/web_hosting/germany-icons.webp" alt="germany-icons"> Germany</button >
                            </li> --}}
                        </ul>


                         <script type="text/javascript">
                function changeLocation(locstr) {
                     if(locstr == "Canada" || locstr == "Germany"){
                            $('.feature-litespeed').hide();
                        }else{
                            $('.feature-litespeed').show();                            
                        }
                    $('input[id^="location"]').each(function(i, ele) { $(this).val(locstr);
                         });
                }
            </script>
            </div>
        </div>
  
                @endif  
                
                <!-- <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='monthshow' style="display: none">
                    <ul class="nav nav-pills nav-vps-hosting @if($ProductBanner->id == 7) pb-10 @endif">
                        <li><a data-bs-toggle="pill" href="#vps-plan1" title="1 month" id='onemonths'>1 month @if(!empty($ProductBanner->varOfferTextOneMonth))<span><span class="bg-color">{{$ProductBanner->varOfferTextOneMonth}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan2" title="3 months" id='threemonths' class="active show">3 months @if(!empty($ProductBanner->varOfferTextThreeMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeMonth}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan3" title="6 months" id='sixmonths'>6 months @if(!empty($ProductBanner->varOfferTextSixMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextSixMonth}}</span></span>@endif</a></li>
                    </ul>
                </div> -->
                 @if($ProductBanner->id == 2) 
                {{-- <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='yearshow'>
                    <ul class="nav nav-pills nav-vps-hosting d-flex justify-content-center mb-4 @if($ProductBanner->id == 7) pb-10 @endif">
                        <li><a class="nav-link" data-bs-toggle="pill" href="#vps-plan0" title="1 Month" id='onemonth'>1 Month @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#vps-plan1" title="1 year" id='oneyear'>1 year @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#vps-plan2" title="2 years" id='twoyear'>2 years @if(!empty($ProductBanner->varOfferTextTwoYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextTwoYear}}</span></span>@endif</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#vps-plan3" title="3 years" id='threeyear' class="active show">3 years @if(!empty($ProductBanner->varOfferTextThreeYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeYear}}</span></span>@endif</a></li>
                    </ul>
                </div> --}}
                @endif
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
                    @php
                        if ($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6) {
                            $plan_row = 'justify-content-center';
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
                            
                        }
                         else {
                            $plan_row = 'justify-content-center';
                            $box_plan_class = 'col-md-6 col-lg-3 col-xs-12';
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
                <!--This Code for One Months-->
                       @if($ProductBanner->id == 2)
                    <div id="vps-plan0" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row {{ $plan_row}}">

                                @php $class = ''; $class1 = ''; $class3 = ''; @endphp
                                  {{-- basic --}}
                                <div class="{{$box_plan_class}}">
                                    <div class="shared-plan-box">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                              
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="shared-main-price-tittle" id="StarterOneMonthWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_1_INR) }}</span>/mo*
                                                </span>
                                                
                                                @php } else { @endphp 
                                                <span class="shared-main-price-tittle" id="StarterOneMonthWhmcsUSD">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_1_USD) }}</span>/mo*
                                                </span>
                                                
                                                @php } @endphp 
                                           
                                        </div>
                                            @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[0]->varAdditionalOffer));
                                                @endphp 
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)                                        
                                            
                                            @endif
                                              
                                            </div>
                                        </div>
                                            <div class="shared-plan-btm" id="StarterMonthlyButtonText">
                                                {!!$StarterMonthlyButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip">
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain' || strtolower(trim($Specification)) == 'free backup' || strtolower(trim($Specification)) == 'website builder' || strtolower(trim($Specification)) == 'supports python' )
                                                        <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl' || strtolower(trim($Specification)) == 'free ssl certificate')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "2 mysql db's")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "1 mssql/mysql space")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == '25 e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Starter Windows hosting plan has a mail storage capacity limit of 250MB per mailbox.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                </span>
                                            </div>
                                        </li>
                                                         @else
                                                        <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                            
                                            
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">

                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="shared-main-price-tittle" id="PerformOneMonthWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_1_INR) }}</span>/mo*
                                                </span>
                                               
                                                @php } else { @endphp 
                                                <span class="shared-main-price-tittle" id="PerformOneMonthWhmcsUSD">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_1_USD) }}</span>/mo*
                                                </span>
                                                
                                                @php } @endphp
                                                </div>
                                                 @php
                                                    $blackfridayOffArr = (explode(",",$ProductsPackageData[1]->varAdditionalOffer));
                                                @endphp
                                            
                                                
                                            </div>
                                        </div>
                                            <div class="shared-plan-btm" id="PerformanceMonthlyButtonText">
                                                {!!$PerformanceMonthlyButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
                                                @foreach($SpecificationData as $Specification)
                                               <div class="slide-toggle">
                                                   @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain')
                                                        <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    @elseif(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                           <span class="domain_tooltip">
                                                                Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                                </span>
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "10 mysql db's")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "10 mssql/mysql space")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == 'unlimited e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Performance Windows hosting plan has a mail storage capacity limit of 2GB per mailbox.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                    </span>

                                            </div>
                                        </li>

                                                         @else
                                                        <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                            
                                            
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                 {{-- prof --}}
                                <div class="{{$box_plan_class}}">
                                    @php $class = ''; $class1 = '';
                                    if($ProductsPackageData[2]->chrDisplayontop == 'Y'){
                                    $class = 'recommanded-main'; 
                                    $class1 = 'recommanded-main-icon'; 
                                    } @endphp
                                    <div class="shared-plan-box {{$class}} vps-plan-recommanded-main">
                                        <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="shared-main-price-tittle" id="BusinessOneMonthWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_1_INR) }}</span>/mo*
                                                </span>
                                                
                                                @php } else { @endphp 
                                                <span class="shared-main-price-tittle" id="BusinessOneMonthWhmcsUSD">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_1_USD) }}</span>/mo*
                                                </span>
                                                
                                                @php } @endphp 
                                          
                                            @php
                                                    $blackfridayOffArr = (explode(",",$ProductsPackageData[2]->varAdditionalOffer));
                                                @endphp
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)                                           
                                            @endif
                                               
                                            </div>
                                        </div>
                                        </div>
                                          <div class="shared-plan-btm" id="BusinessMonthlyButtonText">
                                                {!!$BusinessMonthlyButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >                      
                                                @foreach($SpecificationData as $Specification)                    
                                                <div class="slide-toggle"> 
                                               @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain')
                                                        <li class="cross_free_domain"><span>{{$Specification}}</span></li>                            
                                                    @elseif(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                           <span class="domain_tooltip">
                                                                Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                                </span>
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "20 mysql db's")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "20 mssql/mysql space")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Business Windows hosting plan has an unlimited mail storage capacity per mailbox. 
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                    </span>

                                            </div>
                                        </li>
                                                         @else
                                                        <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>                                                
                                                @endforeach
                                            </ul>                                            
                                          
                                           
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                 {{-- ente --}}
                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                <div class="{{$box_plan_class}}">
                                    <div class="shared-plan-box">
                                        <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[3]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                        
                                               
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="shared-main-price-tittle" id="EnterpriseOneMonthWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_1_INR') }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="shared-main-price-tittle" id="EnterpriseOneMonthWhmcsUSD">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_1_USD') }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                         
                                            @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[3]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                            
                                            @endif
                                               </div>
                                            </div>
                                        </div>
                                         <div class="shared-plan-btm" id="EnterpriseMonthlyButtonText">
                                                {!!$EnterpriseMonthlyButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[3]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle"> 
                                                    @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain' )
                                                        <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    @elseif(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                           <span class="domain_tooltip">
                                                                Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                                </span>
                                                               
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "unlimited mysql db's" || strtolower(trim($Specification)) =="20 mysql db's")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            </div>
                                                        </li>
                                                         @else
                                                        <li><span>{{$Specification}}</span></li>
                                                    @endif                                                    
                                                @endforeach
                                            </ul>
                                           
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                             @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 

                                        </div>
                                    </div>
                                
                                @endif
                            </div>
                        
                    </div>
                    </div>
                    @endif
                    <!-- this code for one year -->
                    @if($ProductBanner->id == 2)
                    <div id="vps-plan1" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row {{ $plan_row}}">
                                @php $class = ''; $class1 = ''; $class3 = ''; @endphp
                                {{-- basic --}}
                                <div class="{{$box_plan_class}}">
                                    <div class="shared-plan-box">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                    @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceOneYearINR))
                                                    <span class="shared-cut-price" id="BasicOneYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[0]->intOldPriceOneYearINR}}</span>
                                                    @endif
                                                    @else
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceOneYearINR))
                                                    <span class="shared-cut-price" id="BasicOneYearUSD">{{$ProductsPackageData[0]->intOldPriceOneYearUSD}}</span>
                                                    @endif
                                                    @endif
                                                    @endif
                                                     @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[0]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                <span class="shared-offer-discount" id="BasicOneYearOffer">
                                                    @if (count($blackfridayOffArr) > 1)
                                                    {{$blackfridayOffArr[2]}}% OFF
                                                    @else
                                                    ({{$ProductsPackageData[2]->varAdditionalOffer}})
                                                    @endif
                                              
                                                @endif
                                            </span>
                                                </div>

                                            </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                    @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                    <span class="shared-main-price-tittle" id="StarterOneYearWhmcsINR">
                                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_12_INR) }}</span>/mo*
                                                    </span>
                                                    @php } else { @endphp
                                                    <span class="shared-main-price-tittle" id="StarterOneYearWhmcsUSD">
                                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_12_USD) }}</span>/mo*
                                                    </span>
                                                    @php } @endphp
                                                
                                               
                                                
                                            </div>
                                             <div class="shared-plan-btm" id="StarterOneYearButtonText" >
                                                {!!$StarterOneYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip">
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain' || strtolower(trim($Specification)) == 'free backup' || strtolower(trim($Specification)) == 'website builder' )
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
                                                        <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                     @elseif(strtolower(trim($Specification)) == '25 e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Starter Windows hosting plan has a mail storage capacity limit of 250MB per mailbox.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                               <span class="domain_tooltip">
                                                @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                </span>
                                            </div>
                                        </li>
                                                    @else

                                                    <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                            
                                           
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                            <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearINR))
                                                        <span class="shared-cut-price" id="PerformOneYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceOneYearINR}}</span>
                                                        @endif
                                                    @else
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearINR))
                                                        <span class="shared-cut-price" id="PerformOneYearUSD">{{$ProductsPackageData[1]->intOldPriceOneYearUSD}}</span>
                                                        @endif
                                                    @endif
                                                     @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[1]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                <span class="shared-offer-discount" id="EssentialOneYearOffer">
                                                    @if (count($blackfridayOffArr) > 1)
                                                    {{$blackfridayOffArr[2]}}% OFF
                                                    @else
                                                    ({{$ProductsPackageData[2]->varAdditionalOffer}})
                                                    @endif
                                               
                                                @endif
                                            </span>
                                                </div>
                                            </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                    @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                    
                                                    <span class="shared-main-price-tittle" id="PerformOneYearWhmcsINR">
                                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_12_INR) }}</span>/mo*
                                                    </span>
                                                    @php } else { @endphp
                                                    <span class="shared-main-price-tittle" id="PerformOneYearWhmcsUSD" >
                                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_12_USD) }}</span>/mo*
                                                    </span>
                                                    @php } @endphp
                                                
                                               
                                               
                                            </div>
                                              <div class="shared-plan-btm" id="PerformanceOneYearButtonText" >
                                                {!!$PerformanceOneYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip">
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if($ProductsPackageData[1]->varTitle == 'ESSENTIAL' && strtolower(trim($Specification)) == 'free domain')
                                                     <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    {{-- @if(strtolower(trim($Specification)) == 'free domain')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">
                                                                Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
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
                                                        <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                        </div>
                                                    </li>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Performance Windows hosting plan has a mail storage capacity limit of 2GB per mailbox.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                    </span>

                                            </div>
                                        </li>
                                                    @else

                                                    <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                           
                                          
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                            <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                        <div class="shared-plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                            <div class="{{$class1}}"></div>
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceOneYearINR))
                                                    <span class="shared-cut-price" id="BusinessOneYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceOneYearINR}}</span>
                                                    @endif
                                                    @else
                                                   
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceOneYearINR))
                                                    <span class="shared-cut-price" id="BusinessOneYearUSD">{{$ProductsPackageData[2]->intOldPriceOneYearUSD}}</span>
                                                    @endif
                                                    @endif
                                                     @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[2]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                <span class="shared-offer-discount" id="ProfessionalOneYearOffer">
                                                    @if (count($blackfridayOffArr) > 1)
                                                    {{$blackfridayOffArr[2]}}% OFF
                                                    @else
                                                    ({{$ProductsPackageData[2]->varAdditionalOffer}})
                                                    @endif
                                               
                                                @endif
                                            </span>
                                                </div>
                                            </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                    @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                    
                                                    <span class="shared-main-price-tittle" id="BusinessOneYearWhmcsINR">
                                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_12_INR) }}</span>/mo*
                                                    </span>
                                                    @php } else { @endphp
                                                    
                                                    <span class="shared-main-price-tittle" id="BusinessOneYearWhmcsUSD" >
                                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_12_USD) }}</span>/mo*
                                                    </span>
                                                    @php } @endphp
                                             
                                               
                                               
                                            </div>

                                            <div class="shared-plan-btm" id="BusinessOneYearButtonText" >
                                                {!!$BusinessOneYearButtonText!!}
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
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
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
                                                        <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                        </div>
                                                    </li>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Business Windows hosting plan has an unlimited mail storage capacity per mailbox. 
                                                            </span>
                                                            </div>
                                                        </li>
                                                   
                                                     @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                    </span>

                                            </div>
                                        </li>
                                         @else
                                                    <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                          
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                            <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp
                                        </div>
                                    </div>
                                </div>
                                {{-- ente --}}
                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                <div class="{{$box_plan_class}}">
                                    <div class="shared-plan-box">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[3]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                                    @if(!empty($ProductsPackageData[3]->intOldPriceOneYearINR))
                                                    <span class="shared-cut-price" id="EnterpriseOneYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[3]->intOldPriceOneYearINR}}</span>
                                                    @endif
                                                    @else
                                                    
                                                    @if(!empty($ProductsPackageData[3]->intOldPriceOneYearINR))
                                                    <span class="shared-cut-price" id="EnterpriseOneYearUSD">{{$ProductsPackageData[3]->intOldPriceOneYearUSD}}</span>
                                                    @endif
                                                    @endif
                                                      @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[3]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                <span class="shared-offer-discount" id="EnterpriseOneYearOffer">
                                                    @if (count($blackfridayOffArr) > 1)
                                                    {{$blackfridayOffArr[2]}}% OFF
                                                    @else
                                                    ({{$ProductsPackageData[2]->varAdditionalOffer}})
                                                    @endif
                                              
                                                @endif
                                            </span>
                                                </div>
                                            </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                    @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                                                    
                                                    <span class="shared-main-price-tittle" id="EnterpriseOneYearWhmcsINR" >
                                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_12_INR') }}</span>/mo*
                                                    </span>
                                                    @php } else { @endphp
                                                    
                                                    <span class="shared-main-price-tittle" id="EnterpriseOneYearWhmcsUSD" >
                                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_12_USD') }}</span>/mo*
                                                    </span>
                                                    @php } @endphp
                                               
                                              
                                              
                                            </div>
                                             <div class="shared-plan-btm" id="EnterpriseOneYearButtonText" >
                                                {!!$EnterpriseOneYearButtonText!!}
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
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
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
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                        </div>
                                                    </li>
                                                     @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                    </span>

                                            </div>
                                        </li>
                                                    @else
                                                    <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                    @endforeach
                                            </ul>
                                            
                                           
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                            <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    <!--This Code for Two Year-->
                    @if($ProductBanner->id == 2)
                    <div id="vps-plan2" class="tab-pane ">
                        <div class="plan-main-div">
                            <div class="row {{ $plan_row}}">
                                  {{-- basic --}}
                                <div class="{{$box_plan_class}}" data-aos="fade-left" data-aos-easing="ease-out-back">
                                    <div class="shared-plan-box">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2) 
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceTwoYearINR))
                                                        <span class="shared-cut-price" id="BasicTwoYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[0]->intOldPriceTwoYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceTwoYearUSD))
                                                        <span class="shared-cut-price" id="BasicTwoYearUSD">{{$ProductsPackageData[0]->intOldPriceTwoYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[0]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                            
                                            <span class="shared-offer-discount" id="BasicTwoYearOffer">
                                                @if (count($blackfridayOffArr) > 1)  
                                                    {{$blackfridayOffArr[3]}}% OFF
                                                @else
                                                    ({{$ProductsPackageData[3]->varAdditionalOffer}})
                                                @endif
                                          
                                            @endif
                                        </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="StarterTwoYearWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_24_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="StarterTwoYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_24_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                            </div>
                                              <div class="shared-plan-btm" id="StarterTwoYearButtonText" >
                                                {!!$StarterTwoYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain' || strtolower(trim($Specification)) == 'free backup' || strtolower(trim($Specification)) == 'website builder')
                                                        <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl' || strtolower(trim($Specification)) == 'free ssl certificate')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "2 mysql db's")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "1 mssql/mysql space")
                                                        <li> <div class="free_domain_black free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == '25 e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Starter Windows hosting plan has a mail storage capacity limit of 250MB per mailbox.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                        @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                        </span>

                                            </div>
                                        </li>
                                                         @else

                                                        <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                            
                                          
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                {{-- Essi --}}
                                <div class="{{$box_plan_class}}" data-aos="zoom-in" data-aos-easing="ease-out-back">
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
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[1]->intOldPriceTwoYearINR))
                                                        <span class="shared-cut-price" id="PerformTwoYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceTwoYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[1]->intOldPriceTwoYearINR))
                                                        <span class="shared-cut-price" id="PerformTwoYearUSD">{{$ProductsPackageData[1]->intOldPriceTwoYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                 @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[1]->varAdditionalOffer));
                                            @endphp
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                            
                                            <span class="shared-offer-discount" id="EssentialTwoYearOffer">
                                                @if (count($blackfridayOffArr) > 1)  
                                                    {{$blackfridayOffArr[3]}}% OFF
                                                @else
                                                    ({{$ProductsPackageData[3]->varAdditionalOffer}})
                                                @endif
                                         
                                            @endif
                                        </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="PerformTwoYearWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_24_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="PerformTwoYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_24_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                          
                                            </div>
                                             <div class="shared-plan-btm" id="PerformanceTwoYearButtonText" >
                                                {!!$PerformanceTwoYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if($ProductsPackageData[1]->varTitle == 'ESSENTIAL' && strtolower(trim($Specification)) == 'free domain')
                                                     <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    {{-- @if(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                           <span class="domain_tooltip">
                                                                Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                                </span>
                                                            </span>
                                                            </div>
                                                        </li> --}}
                                                        
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "10 mysql db's")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "10 mssql/mysql space")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == 'unlimited e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Performance Windows hosting plan has a mail storage capacity limit of 2GB per mailbox.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                    </span>

                                            </div>
                                        </li>
                                                         @else
                                                        <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                            
                                           
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                 {{-- prof --}}
                                <div class="{{$box_plan_class}}" data-aos="fade-right" data-aos-easing="ease-out-back">
                                         @php $class = ''; $class1 = '';
                                         if($ProductsPackageData[2]->chrDisplayontop == 'Y'){
                                                $class = 'recommanded-main'; 
                                                $class1 = 'recommanded-main-icon'; 
                                         } @endphp
                                    <div class="shared-plan-box {{$class}} vps-plan-recommanded-main">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[2]->varTitle}}   </div>
                                            {{-- <div class="plan-icon-right"></div> --}}
                                            <div class="{{$class1}}"></div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceTwoYearINR))
                                                        <span class="shared-cut-price" id="BusinessTwoYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceTwoYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceTwoYearINR))
                                                        <span class="shared-cut-price" id="BusinessTwoYearUSD">{{$ProductsPackageData[2]->intOldPriceTwoYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                 @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[2]->varAdditionalOffer));
                                            @endphp
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                            
                                            <span class="shared-offer-discount" id="ProfessionalTwoYearOffer">
                                                @if (count($blackfridayOffArr) > 1)  
                                                    {{$blackfridayOffArr[3]}}% OFF
                                                @else
                                                    ({{$ProductsPackageData[3]->varAdditionalOffer}})
                                                @endif
                                           
                                            @endif
                                        </span>
                                            </div>
                                     </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="BusinessTwoYearWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_24_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="BusinessTwoYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_24_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                          
                                                   
                                            </div>
                                             <div class="shared-plan-btm" id="BusinessTwoYearButtonText" >
                                                {!!$BusinessTwoYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                           <span class="domain_tooltip">
                                                                Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                                </span>
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                            </div>
                                                        </li>
                                                        @elseif(strtolower(trim($Specification)) == "20 mysql db's")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "20 mssql/mysql space")
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited e-mail ids')
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">The Business Windows hosting plan has an unlimited mail storage capacity per mailbox. 
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                    </span>

                                            </div>
                                        </li>
                                                    @else
                                                        <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                            
                                           
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                 {{-- ente --}}
                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                <div class="{{$box_plan_class}}">
                                    <div class="shared-plan-box">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[3]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                   
                                                    @if(!empty($ProductsPackageData[3]->intOldPriceTwoYearINR))
                                                        <span class="shared-cut-price" id="EnterpriseTwoYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[3]->intOldPriceTwoYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[3]->intOldPriceTwoYearINR))
                                                        <span class="shared-cut-price" id="EnterpriseTwoYearUSD">{{$ProductsPackageData[3]->intOldPriceTwoYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                 @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[3]->varAdditionalOffer));
                                                @endphp
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                            
                                            <span class="shared-offer-discount" id="EnterpriseTwoYearOffer">
                                                @if (count($blackfridayOffArr) > 1)  
                                                    {{$blackfridayOffArr[3]}}% OFF
                                                @else
                                                    ({{$ProductsPackageData[3]->varAdditionalOffer}})
                                                @endif
                                          
                                            @endif
                                        </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="EnterpriseTwoYearWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_24_INR') }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="EnterpriseTwoYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_24_USD') }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                           
                                               
                                            </div>
                                             <div class="shared-plan-btm" id="EnterpriseTwoYearButtonText" >
                                                {!!$EnterpriseTwoYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[3]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                           <span class="domain_tooltip">
                                                                Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                                <span class="price_domain">Your Domain Renewal Charges:<br> {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
                                                                </span>
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl certificate' || strtolower(trim($Specification)) == 'free ssl')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">Don’t Compromise with your website’s security! Keep your website protected with a Let’s Encrypt SSL Shield to gain search engine & users' trust & protect your site’s sensitive information.
                                                            </span>
                                                            </div>
                                                        </li>
                                        @elseif(strtolower(trim($Specification)) == "unlimited mysql db's" || strtolower(trim($Specification)) =="20 mysql db's")

                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                                @if($ProductBanner->id == 2)
                                                                   <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '21.7.3 & 20.15.0'; @endphp
                                                    </span>

                                            </div>
                                        </li>
                                                         @else
                                                        <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </ul>
                                            
                                           
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                            @endif
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
                                             @php if($ProductBanner->id == '7') {  @endphp 
                                            <div class="v-f_link">
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    <!--This Code for Three Year-->
                    {{-- <div id="vps-plan3" class="tab-pane active show"> 
                        <div class="plan-main-div" id="plans"> --}}
                            <div class="row {{ $plan_row}}">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-pln-box">
                                        <div class="shared-plan-price">
                                            <div class="shared-plan-nm">
                                                {{-- VPS - SM 1 --}}
                                                {{$ProductsPackageData[0]->varTitle}}
                                            </div>
                                            <div class="shared-plan-cut-prc">
                                                {{-- <span class="cut-price">₹840.00</span> --}}
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceThreeMonthINR))
                                                        <span class="cut-price">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[0]->intOldPriceThreeMonthINR}}</span>
                                                    @endif
                                                @else
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceThreeMonthUSD))
                                                        <span class="cut-price" id="BasicThreeYearUSD">
                                                        {{$ProductsPackageData[0]->intOldPriceThreeMonthUSD}}</span>
                                                    @endif
                                                @endif
                                                

                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[0]->varAdditionalOffer));
                                                @endphp

                                                {{-- <span class="cut-prc-disc">Save 50%</span> --}}

                                                @if (count($blackfridayOffArr) > 1)
                                                    <span class="cut-prc-disc">{{$blackfridayOffArr[4]}}% OFF</span>
                                                @else
                                                    <span class="cut-prc-disc">({{$ProductsPackageData[4]->varAdditionalOffer}})</span>
                                                @endif
                                            </div>
                                            <div class="shared-main-price">
                                                {{-- ₹<span>420.00</span>/mo* --}}
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}<span>
                                                    {{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_36_INR) }}.00</span>/mo*
                                                @else
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}<span>
                                                    {{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_36_USD) }}</span>/mo*
                                                @endif
                                                
                                            </div>
                                            <div class="shared-plan-fr-mnth invisible">
                                                +0 month free
                                            </div>
                                            <div class="shared-plan-btn">
                                                {{-- <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a> --}}
                                                {{-- {!!$BasicThreeYearButtonText!!} --}}
                                                {!!$StarterThreeYearButtonText!!}
                                            </div>

                                            @if(Config::get('Constant.sys_currency') == 'INR')
                                                @if(isset($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                    <div class="shared-plan-renew">                                                
                                                        Renews at {!! Config::get('Constant.sys_currency_symbol') !!}
                                                        {{$ProductsPackageData[0]->intOldPriceThreeYearINR}}/mo after 3 years. Cancel anytime.
                                                    </div>
                                                @endif
                                            @else
                                                @if(isset($ProductsPackageData[0]->intOldPriceThreeYearUSD))
                                                    <div class="shared-plan-renew">                                                
                                                        Renews at {!! Config::get('Constant.sys_currency_symbol') !!}
                                                        {{$ProductsPackageData[0]->intOldPriceThreeYearUSD}}/mo after 3 years. Cancel anytime.
                                                    </div>
                                                @endif
                                            @endif

                                        </div>
                                        <div class="shared-plan-cnt">
                                            <ul>
                                                @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                                @foreach($SpecificationData as $Specification)
                                                    @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain')
                                                        <div class="slide-toggle">                                         
                                                            <li class="cross-icon-li"> <span> {{$Specification}}</span></li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '10,000 visits monthly')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    <b>10,000</b> visits monthly
                                                                    <span class="domain-tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance. </span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'supports node.js')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'supports python')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '10 databases')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    <b>10</b> Databases
                                                                    <span class="domain-tooltip">You will be provided with Mariadb 10.x Version for faster performance.</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'host 1 website')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                Host <b>1</b> Website
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '10 gb nvme ssd')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>10 GB</b> NVMe SSD
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '5 subdomains')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>5</b> subdomains
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '5 ftp users')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>5</b> FTP users
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '5 email accounts')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>5 Email</b> Accounts
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '10,000 gb bandwidth')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>10,000 GB</b> Bandwidth
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '2,00,000 inodes')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>2,00,000</b> INODES
                                                            </li>   
                                                        </div>
                                                    @else
                                                        <div class="slide-toggle"><li> <span> {{$Specification}}</span></li></div>
                                                    @endif
                                                @endforeach                                                
                                            </ul>
                                            <a href="" title="See More Features" class="shared-plan-more-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                  <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="shared-plan-box-main shared-plan-most-popular" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-pln-box">
                                        <div class="shared-most-popular-cnt">
                                            MOST POPULAR
                                        </div>
                                        <div class="shared-plan-price">
                                            <div class="shared-plan-nm">
                                                {{-- VPS - SM 1 --}}
                                                {{$ProductsPackageData[1]->varTitle}}
                                            </div>
                                            <div class="shared-plan-cut-prc">
                                                {{-- <span class="cut-price">₹980.00</span> --}}
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                                    @if(!empty($ProductsPackageData[1]->intOldPriceThreeMonthINR))
                                                        <span class="cut-price">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceThreeMonthINR}}</span>
                                                    @endif
                                                @else
                                                    @if(!empty($ProductsPackageData[1]->intOldPriceThreeMonthUSD))
                                                        <span class="cut-price" id="BasicThreeYearUSD">
                                                        {{$ProductsPackageData[1]->intOldPriceThreeMonthUSD}}</span>
                                                    @endif
                                                @endif

                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[1]->varAdditionalOffer));
                                                @endphp

                                                {{-- <span class="cut-prc-disc">Save 50%</span> --}}

                                                @if (count($blackfridayOffArr) > 1)
                                                    <span class="cut-prc-disc">{{$blackfridayOffArr[4]}}% OFF</span>
                                                @else
                                                    <span class="cut-prc-disc">({{$ProductsPackageData[4]->varAdditionalOffer}})</span>
                                                @endif

                                            </div>
                                            <div class="shared-main-price">
                                                {{-- ₹<span>880.00</span>/mo* --}}
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}<span>
                                                    {{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_36_INR) }}.00</span>/mo*
                                                @else
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}<span>
                                                    {{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_36_USD) }}</span>/mo*
                                                @endif
                                                
                                            </div>
                                            @if(Request::segment(2) == "ecommerce-hosting")
                                                <div class="shared-plan-fr-mnth">
                                                    +3 months free
                                                </div>
                                            @else <div class="shared-plan-fr-mnth invisible">
                                                +0 month free
                                            </div>
                                            @endif
                                            <div class="shared-plan-btn">
                                                {{-- <a href="javascript:void(0)" class="primary-btn-sq">Choose Plan</a> --}}
                                                {{-- {!!$EssentialThreeYearButtonText!!} --}}
                                                {!!$PerformanceThreeYearButtonText!!}

                                            </div>
                                            
                                             @if(Config::get('Constant.sys_currency') == 'INR')
                                                @if(isset($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                    <div class="shared-plan-renew">                                                
                                                        Renews at {!! Config::get('Constant.sys_currency_symbol') !!}
                                                        {{$ProductsPackageData[1]->intOldPriceThreeYearINR}}/mo after 3 years. Cancel anytime.
                                                    </div>
                                                @endif
                                            @else
                                                @if(isset($ProductsPackageData[1]->intOldPriceThreeYearUSD))
                                                    <div class="shared-plan-renew">                                                
                                                        Renews at {!! Config::get('Constant.sys_currency_symbol') !!}
                                                        {{$ProductsPackageData[1]->intOldPriceThreeYearUSD}}/mo after 3 years. Cancel anytime.
                                                    </div>
                                                @endif
                                            @endif
                                            
                                        </div>
                                        <div class="shared-plan-cnt">
                                            <ul>
                                                @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                                @foreach($SpecificationData as $Specification)                              
                                                    @if(strtolower(trim($Specification)) == '25,000 visits monthly')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    <b>25,000</b> visits monthly
                                                                    <span class="domain-tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance. </span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'supports node.js')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'free domain')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
                                                                    </span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'supports python')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '50 databases')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    <b>50</b> Databases
                                                                    <span class="domain-tooltip">You will be provided with Mariadb 10.x Version for faster performance.</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'host 5 websites')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                Host <b>5</b> Websites
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '25 gb nvme ssd')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>25 GB</b> NVMe SSD
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited subdomains')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>Unlimited</b> subdomains
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited ftp users')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>Unlimited</b> FTP users
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '25 email accounts')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>25 Email</b> Accounts
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '25,000 gb bandwidth')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>25,000 GB</b> Bandwidth
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '4,00,000 inodes')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>4,00,000</b> INODES
                                                            </li>   
                                                        </div>
                                                    @else
                                                        <div class="slide-toggle"><li> <span> {{$Specification}}</span></li></div>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <a href="" title="See More Features" class="shared-plan-more-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                         
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-pln-box">
                                        <div class="shared-plan-price">
                                            <div class="shared-plan-nm">
                                                {{-- VPS - SM 1 --}}
                                                {{$ProductsPackageData[2]->varTitle}}
                                            </div>
                                            <div class="shared-plan-cut-prc">
                                                {{-- <span class="cut-price">₹1280.00</span> --}}
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceThreeMonthINR))
                                                        <span class="cut-price">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceThreeMonthINR}}</span>
                                                    @endif
                                                @else
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceThreeMonthUSD))
                                                        <span class="cut-price" id="BasicThreeYearUSD">
                                                        {{$ProductsPackageData[2]->intOldPriceThreeMonthUSD}}</span>
                                                    @endif
                                                @endif

                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[2]->varAdditionalOffer));
                                                @endphp

                                                {{-- <span class="cut-prc-disc">Save 50%</span> --}}

                                                @if (count($blackfridayOffArr) > 1)
                                                    <span class="cut-prc-disc">{{$blackfridayOffArr[4]}}% OFF</span>
                                                @else
                                                    <span class="cut-prc-disc">({{$ProductsPackageData[4]->varAdditionalOffer}})</span>
                                                @endif
                                            </div>
                                            <div class="shared-main-price">
                                                {{-- ₹<span>1820.00</span>/mo* --}}
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}<span>
                                                    {{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_36_INR) }}.00</span>/mo*
                                                @else
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}<span>
                                                    {{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_36_USD) }}</span>/mo*
                                                @endif
                                                
                                            </div>
                                            @if(Request::segment(2) == "ecommerce-hosting")
                                            <div class="shared-plan-fr-mnth">
                                                +3 months free
                                            </div>@else <div class="shared-plan-fr-mnth invisible">
                                                +0 month free
                                            </div>
                                            @endif
                                            <div class="shared-plan-btn">
                                                {{-- <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a> --}}
                                                {!!$BusinessThreeYearButtonText!!}
                                                
                                            </div>
                                            
                                             @if(Config::get('Constant.sys_currency') == 'INR')
                                                @if(isset($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                    <div class="shared-plan-renew">                                                
                                                        Renews at {!! Config::get('Constant.sys_currency_symbol') !!}
                                                        {{$ProductsPackageData[2]->intOldPriceThreeYearINR}}/mo after 3 years. Cancel anytime.
                                                    </div>
                                                @endif
                                            @else
                                                @if(isset($ProductsPackageData[2]->intOldPriceThreeYearUSD))
                                                    <div class="shared-plan-renew">                                                
                                                        Renews at {!! Config::get('Constant.sys_currency_symbol') !!}
                                                        {{$ProductsPackageData[2]->intOldPriceThreeYearUSD}}/mo after 3 years. Cancel anytime.
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="shared-plan-cnt">
                                            <ul>
                                                @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                                @foreach($SpecificationData as $Specification)                              
                                                    @if(strtolower(trim($Specification)) == '50,000 visits monthly')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    <b>50,000</b> visits monthly
                                                                    <span class="domain-tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance. </span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'supports node.js')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'free domain')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
                                                                    </span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'supports python')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '250 databases')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    <b>250</b> Databases
                                                                    <span class="domain-tooltip">You will be provided with Mariadb 10.x Version for faster performance.</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'host 25 websites')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                Host <b>25</b> Websites
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '50 gb nvme ssd')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>50 GB</b> NVMe SSD
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited subdomains')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>Unlimited</b> subdomains
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited ftp users')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>Unlimited</b> FTP users
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '60 email accounts')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>60 Email</b> Accounts
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '1,00,000 gb bandwidth')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>1,00,000 GB</b> Bandwidth
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '6,00,000 inodes')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>6,00,000</b> INODES
                                                            </li>   
                                                        </div>
                                                    @else
                                                        <div class="slide-toggle"><li> <span> {{$Specification}}</span></li></div>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <a href="" title="See More Features" class="shared-plan-more-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                @if(Request::segment(2) == "ecommerce-hosting")
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-pln-box">
                                        <div class="shared-plan-price">
                                            <div class="shared-plan-nm">
                                                {{-- VPS - SM 1 --}}
                                                {{$ProductsPackageData[3]->varTitle}}
                                            </div>
                                            <div class="shared-plan-cut-prc">
                                                {{-- <span class="cut-price">₹1880.00</span> --}}
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                                    @if(!empty($ProductsPackageData[3]->intOldPriceThreeMonthINR))
                                                        <span class="cut-price">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[3]->intOldPriceThreeMonthINR}}</span>
                                                    @endif
                                                @else
                                                    @if(!empty($ProductsPackageData[3]->intOldPriceThreeMonthUSD))
                                                        <span class="cut-price" id="BasicThreeYearUSD">
                                                        {{$ProductsPackageData[3]->intOldPriceThreeMonthUSD}}</span>
                                                    @endif
                                                @endif

                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[3]->varAdditionalOffer));
                                                @endphp

                                                {{-- <span class="cut-prc-disc">Save 50%</span> --}}

                                                @if (count($blackfridayOffArr) > 1)
                                                    <span class="cut-prc-disc">{{$blackfridayOffArr[4]}}% OFF</span>
                                                @else
                                                    <span class="cut-prc-disc">({{$ProductsPackageData[4]->varAdditionalOffer}})</span>
                                                @endif
                                            </div> 
                                            <div class="shared-main-price">
                                                {{-- ₹<span>1480.00</span>/mo* --}}
                                                
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}<span>
                                                    {{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_36_INR') }}.00</span>/mo*
                                                @else
                                                    {!! Config::get('Constant.sys_currency_symbol') !!}<span>
                                                    {{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_36_USD') }}</span>/mo*
                                                @endif
                                            </div>
                                            @if(Request::segment(2) == "ecommerce-hosting")
                                            <div class="shared-plan-fr-mnth">
                                                +3 months free
                                            </div>
                                            @endif
                                            <div class="shared-plan-btn">
                                                {{-- <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a> --}}
                                                {!!$EnterpriseThreeYearButtonText!!}

                                            </div>
                                            
                                             @if(Config::get('Constant.sys_currency') == 'INR')
                                                @if(isset($ProductsPackageData[3]->intOldPriceThreeYearINR))
                                                    <div class="shared-plan-renew">                                                
                                                        Renews at {!! Config::get('Constant.sys_currency_symbol') !!}
                                                        {{$ProductsPackageData[3]->intOldPriceThreeYearINR}}/mo after 3 years. Cancel anytime.
                                                    </div>
                                                @endif
                                            @else
                                                @if(isset($ProductsPackageData[3]->intOldPriceThreeYearUSD))
                                                    <div class="shared-plan-renew">                                                
                                                        Renews at {!! Config::get('Constant.sys_currency_symbol') !!}
                                                        {{$ProductsPackageData[3]->intOldPriceThreeYearUSD}}/mo after 3 years. Cancel anytime.
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="shared-plan-cnt">
                                            <ul>
                                                @php $SpecificationData = explode("\n",$ProductsPackageData[3]->txtSpecification); @endphp
                                                @foreach($SpecificationData as $Specification)                              
                                                    @if(strtolower(trim($Specification)) == '1,00,000 visits monthly')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    <b>1,00,000</b> visits monthly
                                                                    <span class="domain-tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance. </span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'supports node.js')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'free domain')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
                                                                    </span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'supports python')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    {{$Specification}}
                                                                    <span class="domain-tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '500 databases')
                                                        <div class="slide-toggle">                                         
                                                            <li>
                                                                <div class="free-domain">
                                                                    <b>500</b> Databases
                                                                    <span class="domain-tooltip">You will be provided with Mariadb 10.x Version for faster performance.</span>
                                                                </div>
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'host 50 websites')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                Host <b>50</b> Websites
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '100 gb nvme ssd')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>100 GB</b> NVMe SSD
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited subdomains')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>Unlimited</b> subdomains
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == 'unlimited ftp users')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>Unlimited</b> FTP users
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '100 email accounts')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>100 Email</b> Accounts
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '2,00,000 gb bandwidth')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>2,00,000 GB</b> Bandwidth
                                                            </li>   
                                                        </div>
                                                    @elseif(strtolower(trim($Specification)) == '8,00,000 inodes')
                                                        <div class="slide-toggle">                                         
                                                            <li>                                                                
                                                                <b>8,00,000</b> INODES
                                                            </li>   
                                                        </div>
                                                    @else
                                                        <div class="slide-toggle"><li> <span> {{$Specification}}</span></li></div>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <a href="" title="See More Features" class="shared-plan-more-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
                                        </div>
                                    </div>
                                </div>
                                </div>  
                                @endif
                            </div>
                        {{-- </div>
                    </div> --}}
                </div>
            </div>
        </div>
        
        @if ($ProductBanner->id == '13')
            <style>.oos-box a:hover {color: #03305d !important;text-decoration: underline;}.oos-box a {text-decoration: underline;font-size: 20px;font-weight: 600;color: #115baa;}</style>
            <div class="oos-box" style="margin:10px 0 0 0;text-align: center;">
                <p style="color: #000000;font-size: 18px;">
                <span class="oos-star" style="font-size: 20px; font-weight: 500;">*</span>Our Java Hosting Plans have been temporarily disabled. We will be back with an enhancement to our product very soon. Keep checking back for more information!
                <br>
                Alternatively, you may check out our <a href="{{url('/servers/vps-hosting')}}" style="color: #115baa;">KVM VPS PLANS</a> to operate a Java-based website or application.
                </p>
            </div>
        @endif
        
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
<div class="g-suite-lists head-tb-p-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-heading">
                                <h2 class="text_head text-center">Why Choose Windows Web Hosting?</h2>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">1</i>
                                        <div class="g-list-title">ASP.NET Hosting</div>
                                        <span>This kind of hosting runs on the browser as well on the backend and thus is preferred by most and is available on Windows Web Hosting. </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <div class="g-list-title">One-click Script Installs</div>
                                        <span>Even the cheap Windows Hosting options available in the current scenario offer the option of one-click script installing, thus, minimalizing the entire process of configuration.
                                        </span>
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <div class="g-list-title">MS Access and MS SQL </div>
                                        <span>MS Access is the comparatively older database which is used for the smaller, more basic purposes whereas MS SQL is the newer, more recent version and both these versions are available on Windows Web Hosting options.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">4</i>
                                        <div class="g-list-title">Fast & Best</div>
                                        <span>Get the speed you desire with our full-line of fine-tuned options for cheap Windows hosting. Choose from our high-octane Windows hosting plans in India and give your business the functionality you want. </span>
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
<!-- <div class="combo-offer-section" id="comboofferplan">
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
                                <li>.com Only</li>
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
                                <span class="ruppess">&#8377;</span> <span class="combo_i_price" style="font-size:33px" >159</span><span class="pmon">/mo</span>
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
    </div> -->
    <!-- combo offer section end -->
@endif
@php if($ProductBanner->id == 4){ @endphp
<div class="aws-content head-tb-p-40"> 
<div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-heading">
                        <h2 class="text-center text_head">Blazing Best WordPress Hosting in India</h2>
                            <p>WordPress hosting refers to any particular form of web hosting that has been specifically optimized to function with the websites made with the help of WordPress. Certain websites that have been built with the help of the WordPress platform can face some functionality-based issues if not optimized properly. This can basically lead to issues in certain elements not loading properly, increased load time, or even the website becoming unreachable altogether.
                            </p>
                            <p>WordPress hosting is basically a shared, optimized web hosting used for running WordPress sites in particular. This type of hosting is largely and widely preferred by more and more WordPress users owing to its wide spectrum of highlighting characteristics like inclusive of security, reliability, effectiveness, and a great loading speed, amongst others. Using the WordPress platform to build and architect your website is one of the most simplified ways to launch your new business or blog. You have multiple options based on the type of project you plan to launch, thus, providing you with a number of WordPress Web Hosting plans to choose from. There are four broad types of WordPress Hosting, namely:
                            </p>
                    </div>
            </div>     
</div>
</div>

<div class="g-suite-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                               
                            </div>
                        {{-- <div class="col-sm-6 col-12">
                            <div class="g_s_l-box">
                                <div class="g-list-box">
                                <i class="list-num">1</i>
                                <h4>Free WordPress Hosting</h4>
                                <span>This kind of WordPress Hosting is offered by some companies for free but which rarely is actually good. This WordPress hosting plan is ideally not preferred by anyone looking out for real business or a noteworthy online presence taking into consideration the multiple drawbacks of this type of hosting.</span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">1</i>
                                        <h4>Shared WordPress Hosting</h4>
                                        <span>Here multiple users host their individual sites on the same server which is being administered by the hosting provider. It is comparatively a cheap WordPress hosting option as
                                        compared to the others.</span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>VPS WordPress Hosting</h4>
                                        <span>Here, more privileges are offered to the users by allowing them to run multiple WordPress sites and make more profits in addition to being a much faster, stable and advanced method.</span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>Dedicated WordPress Server Hosting</h4>
                                        <span>A Dedicated WordPress server hosting is a hosting solution where an entire physical server is exclusively allocated to your single website running on the WordPress platform.</span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>Managed WordPress Hosting</h4>
                                        <span>Here, the hosting provider manages all the technical aspects like site backup, server activation, continuous optimization, monitoring, and maintenance. This is more expensive compared to the other hosting options available. Managed WordPress Hosting arguably is considered to be the best web hosting for WordPress.</span>
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
                                <h2 class="text_head text-center">Why Choose WordPress Hosting?</h2>
                                </div>
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
<div class="vps-features {{$mainclass}} head-tb-p-40" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                @php if($ProductBanner->id == 4){ @endphp
                <h2 class="txt-head aos-init" data-aos="fade-up">Features Of Our WordPress Hosting</h2>
                @php } else if($ProductBanner->id == 7) { @endphp
                <h2 class="txt-head aos-init" data-aos="fade-up">Features to up your gear</h2>
                @php } else if($ProductBanner->id == 8) { @endphp
                <h2 class="txt-head aos-init" data-aos="fade-up">Features to make you unstoppable</h2>
                 @php } else if($ProductBanner->id == 6) { @endphp
                <h2 class="txt-head aos-init" data-aos="fade-up">Features of our eCommerce Hosting</h2>
                @php } else if($ProductBanner->id == 13) { @endphp
                <h2 class="txt-head aos-init" data-aos="fade-up">Features of our Java Hosting</h2>
                @php } else if($ProductBanner->id == 2) { @endphp
                <h2 class="txt-head aos-init" data-aos="fade-up">Features of Our Windows Web Hosting Server</h2>
                @php } else if($ProductBanner->id == 1) { @endphp
                <h2 class="txt-head txt-head aos-init" data-aos="fade-up">Features Of Our Linux Hosting</h2>
                @php } else if($ProductBanner->id == 12) { @endphp
                <h2 class="txt-head aos-init" data-aos="fade-up">Features Of Our Windows Reseller Hosting</h2>
                @php } else { @endphp
                <h2 class="txt-head aos-init" data-aos="fade-up">Features put you in control</h2>
                @php } @endphp
                        @php
                        $featureMainDivClass;
                        $featureIconDivClass;
                        $featureMainDivClass="features-start ";
                        $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                        @endphp
                        <div class="{{$featureMainDivClass}}">                            
                                <div class="row">
                                    <div class="feature-ul d-flex flex-wrap">
                                        @foreach($FeaturesData as $Features)                                        
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start" @if ($uagent !="mobile" )data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100" @endif>
                                                    <div class="{{$featureIconDivClass}}"><i class="{{$Features->varIconClass}}"></i></div>
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
@php if($ProductBanner->id == 13){ @endphp
<div class="g-suite-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                <h2 class="g_s_l-title">Developer Friendly Java Hosting</h2>
                            </div>
                            </div>
                        <div class="col-sm-6 col-12">
                            <div class="g_s_l-box">
                                <div class="g-list-box">
                                <i class="list-num">1</i>
                                <h4>1-Click Setup</h4>
                                <span>With HostItSmart, get to setup your java software with just a single click using the 1-click setup. Update your Java install with the single click feature by HostItSmart about which you will be notified via an email post it is updated. We also have the option of a user-friendly auto-installer feature that can be purchased by you in advance, absolutely for free.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>High Performance</h4>
                                        <span>The SEO rankings, conversion rate and bounce rate are greatly dependent on the loading speed of your page. A delay of even 1 second can lead to losing out on your rankings but with HostItSmart and its turbo fast servers, free SSD’s and many other highlighting features, you will be exempted from these minor issues.</span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>Custom Solution</h4>
                                        <span>HostItSmart understands that every user can have individual needs and thus offers to design and construct your desired server according to your customized preferences. This ensures that you pay for actually what you want. </span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">4</i>
                                        <h4>Developer Friendly</h4>
                                        <span>Java as a programming language is generally and widely preferred by a majority of developers. Thus, the Java Hosting tends to be a developer friendly setup. </span>
                                    </div>
                                </div>
                        </div>
            </div>
     </div>
</div>
@php } @endphp

 <!--See More Features section start-->
 @include('template.theme_v1.more_hosting_features')
 <!--See More Features section end-->

@php if($ProductBanner->id == 6){ @endphp
<div class="g-suite-lists head-tb-p-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="section-heading">
                                <h2 class="text_head text-center">Expert Support</h2>
                                </div>
                            </div>
                        <div class="col-sm-6 col-12">
                            <div class="g_s_l-box">
                                <div class="g-list-box">
                                <i class="list-num">1</i>
                                <h4>eCommerce Expertise Support</h4>
                                <span>Host IT Smart offers 24/7 support from expert sources in the field ensuring a fully backed-up, end-to-end system.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>24/7 Availability</h4>
                                        <span>An eCommerce hosting never runs down. It naturally expects a lot of traffic and can have a tendency to slow down and loose functionality. But hosting eCommerce on HostItSmart offers the user a 24/7 server and support availability.</span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>Quick Resolutions</h4>
                                        <span>Host IT Smart with its experienced hands-on support team ensures that customers get quick resolutions to their respective issues.</span>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">4</i>
                                        <h4>Livechat, Helpdesk & Phone</h4>
                                        <span>Host IT Smart offers one of the best eCommerce Hosting options with a variety of support systems backing it. Features like live chat and helpdesk offer interactive support, help, and guidance when users require them.</span>
                                    </div>
                                </div>
                        </div>
            </div>
     </div>
</div>
@php } @endphp
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
        $login_attr = 'data-bs-toggle="modal" data-bs-target="#loginModal"';
        $renew_link = 'javascript:;';
        $target ='';
        @endphp
        @endif

        <div class="offer-tabbing">
            <h5 class="" data-aos="fade-up">What We Offer</h5>
            <ul class="nav nav-pills nav-offer justify-content-center" data-aos="fade-up">
                @if($ProductBanner->id == 15 || $ProductBanner->id == 12)
                <li><a data-bs-toggle="pill" href="#offer1" class="justify-content-center active" title="Dedicated IP"><span class="bg-white-tab"><i class="offer-1-icon align-self-center"></i></span><span class="offer-tabbing-name">Dedicated IP</span></a></li>
                <li><a data-bs-toggle="pill" href="#offer2" class="justify-content-center" title="SSL"><span class="bg-white-tab"><i class="offer-1-icon offer-2-icon align-self-center"></i></span><span class="offer-tabbing-name">SSL</span></a></li>
                @else
                <li><a data-bs-toggle="pill" href="#offer1" class="justify-content-center active" title="CodeGuard"><span class="bg-white-tab"><i class="offer-1-icon align-self-center"></i></span><span class="offer-tabbing-name">CodeGuard</span></a></li>
                <li><a data-bs-toggle="pill" href="#offer2" class="justify-content-center" title="Site Lock"><span class="bg-white-tab"><i class="offer-1-icon offer-2-icon align-self-center"></i></span><span class="offer-tabbing-name">Site Lock</span></a></li>
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
<div class="intall_apps head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-heading text-center">
                <h2 class="text_head">Install These Apps in One-Click</h2>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_drupal.png" title="drupal" alt="drupal"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_cubecart.png" title="cubecart" alt="cubecart"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_dolphinpro.png" title="dolphinpro" alt="dolphinpro"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_joomla.png" title="joomla" alt="joomla"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_mybb.png" title="mybb" alt="mybb"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_oxywall.png" title="oxywall" alt="oxywall"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_phpbb.png" title="phpbb" alt="phpbb"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_prestashop.png" title="prestashop" alt="prestashop"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_wordpress.png" title="wordpress" alt="wordpress"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_roundcube.png" title="roundcube" alt="roundcube"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_concrete5.png" title="concrete5" alt="concrete5"/>
                </div>
            </div>
            <div class="col-sm-2 col-6">
                <div class="i_app_image">
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/lh_cloudlinux.png" title="cloudlinux" alt="cloudlinux"/>
                </div>
            </div>
        </div>
    </div>
</div>
@include('template.linux-hosting-compare')
@endif

@if($ProductBanner->id == 2)

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
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR') }}</span><span class="per-month">/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_USD') }}</span><span class="per-month">/mo*</span></span>
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

@include('template.hostadvice-award')

<div class="lading_bottom">
      @if($ProductBanner->id == 1)
    @if(!empty($testimonialData) && count($testimonialData) >0)
<div class="testomonial-section d-flex">
    <div class="container align-self-center">
        <div class="row">
            <div class="col-12">
                {{-- <h2 class="testomonial-head aos-init" data-aos="fade-up">Linux Hosting - Our Customers <span class="c-blue">Love Us!</span></h2> --}}
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
   {{--  <div class="hostingtype_div head-tb-p-40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                     @if($ProductBanner->id == 4)
                    <span class="title">Didn't hit your sweet spot?</span>
                    @else
                    <span class="title">Didn't hit your sweet spot?</span>
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
                            <div class="info-text">{{$FeaturedProducts->varShortDescription}}</div>
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
    </div> --}}
    <section class="most-power-plans head-tb-p-40">
    <div class="container">
        <div class="section-heading">
           @if(Request::segment(2) == 'dedicated-servers')
            <h2 class="text_head text-center">Looking For Something Else?</h2>
            @elseif(Request::segment(1) == 'web-hosting')
            <h2 class="text_head text-center">Planning to Throttle Your Project to Success?</h2>
            <p class="wh-powerplan-cnt text-center">Discover Our Robust and Powerful Solutions!</p>

           @else

            <h2 class="text_head text-center">Looking For Something Else?</h2>
        @endif
          
        </div>
        <div class="row justify-content-center">
            @foreach($FeaturedProductsData as $FeaturedProducts)
            <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-xs-12">
                <div class="most-power-card">
                    <div class="power-card-tittle">
                        <h2 class="text-light">{{$FeaturedProducts->varTitle}}</h2>
                        <p>{{$FeaturedProducts->varShortDescription}}</p>
                        <div class="most-power-circle-ol">
                            <div class="most-power-circle">
                                <div class="frnt-cnt">
                                    Starting @
                                </div>
                                <div class="price-cnt">
                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                    ₹<span></i>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</span>/mo*
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="power-card-data">
                        <div class="power-card-cnt">
                            @php $FeaturedProductsDec = explode("\n",$FeaturedProducts->varFeature); @endphp
                            <ul>
                                @foreach($FeaturedProductsDec as $info)
                                <li>
                                    {{$info}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="power-plans-btn">
                            <a href="{{$FeaturedProducts->varButtonLink}}" class="buy-now-btn" title="{{$FeaturedProducts->varButtonName}}">{{$FeaturedProducts->varButtonName}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
    @endif
    @if($ProductBanner->id == 2) 
   {{--  <div class="product_offers">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-10">
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
    </div> --}}
    @elseif($ProductBanner->id == 1)
    <div class="product_offers">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-10">
                <div class="product_offers_main">
                    <div class="product_offers_head">
                        <h2>Wordpress Hosting</h2>
                    </div>
                    <div class="product_offers_cnt">
                        <div class="product_offers_price">
                            <ul>
                            <li class="product_offers_prc_head">Starting From</li>
                            <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>49<span class="month_icon">/mo*</span></li>
                            </ul>
                        </div>
                    </div>
                        <div class="product_offers_btn">
                            <a href="https://www.hostitsmart.com/hosting/wordpress-hosting">Click to Host Today</a>
                        </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    @elseif($ProductBanner->id == 6)
    <div class="product_offers">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-10">
                <div class="product_offers_main">
                    <div class="product_offers_head">
                        <h2>Linux Hosting</h2>
                    </div>
                    <div class="product_offers_cnt">
                        <div class="product_offers_price">
                            <ul>
                            <li class="product_offers_prc_head">Starting From</li>
                            <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>49<span class="month_icon">/mo*</span></li>
                            </ul>
                        </div>
                    </div>
                        <div class="product_offers_btn">
                            <a href="https://www.hostitsmart.com/hosting/linux-hosting">Click to Host Today</a>
                        </div>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
    @elseif($ProductBanner->id == 4)
    <div class="product_offers">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-10">
                <div class="product_offers_main">
                    <div class="product_offers_head">
                        <h2>Linux Hosting</h2>
                    </div>
                    <div class="product_offers_cnt">
                        <div class="product_offers_price">
                            <ul>
                            <li class="product_offers_prc_head">Starting From</li>
                            <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>49<span class="month_icon">/mo*</span></li>
                            </ul>
                        </div>
                    </div>
                        <div class="product_offers_btn">
                            <a href="https://www.hostitsmart.com/hosting/linux-hosting">Click to Host Today</a>
                        </div>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
    @elseif($ProductBanner->id == 1 )
        <!-- <div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting" >
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
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_USD') }}</span><span class="per-month">/mo*</span></span>
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
    </div> -->
   {{--  <div class="product_offers">
        <div class="container">
        <div class="row">
            <div class="col-lg-12 col-10">
                <div class="product_offers_main">
                    <div class="product_offers_head">
                        <h2>VPS Hosting</h2>
                    </div>
                    <div class="product_offers_cnt">
                        <div class="product_offers_price">
                            <ul>
                            <li class="product_offers_prc_head">Today starting from</li>
                            <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>234<span class="month_icon">/mo*</span></li>
                            </ul>
                        </div>
                    </div>
                        <div class="product_offers_btn">
                            <a href="javascript:void(0)">Start Your Site Now!</a>
                        </div>
                    
                </div>
            </div>
        </div>
        </div>
    </div> --}}

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
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_USD') }}</span><span class="per-month">/mo*</span></span>
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
{{-- <script src="{{Config::get('Constant.CDNURL')}}/assets/js/linux-hosting.js?v={{date('YmdHi')}}"></script> --}}
<link rel="stylesheet" href="{{Config::get('Constant.CDNURL')}}/assets/css/linux-hosting.css?v={{date('YmdHi')}}"/>
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
<script src="{{ url('/') }}/assets/js/vps-range-jquery-ui.js?v={{date('YmdHi')}}"></script>
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
     
     $("#form_hosting_158_1,#form_hosting_159_2,#form_hosting_160_3,#form_hosting_158_5,#form_hosting_159_6,#form_hosting_160_7,#form_hosting_158_9,#form_hosting_159_10,#form_hosting_160_11,#form_hosting_158_13,#form_hosting_159_14,#form_hosting_160_15,#form_hosting_158_17,#form_hosting_159_18,#form_hosting_160_19,#form_hosting_158_21,#form_hosting_159_22,#form_hosting_160_23")
    .find('.shared-hstg-plan-btn')
    .css({"background":"gray"})
    .text("Out of Stock")
    .removeAttr("onclick")
    .prop('title','Out of Stock')
    .click(function(){ return false; });
 </script>
 <script>
    // const germanyButton=document.getElementById('loc3');
    // germanyButton.addEventListener('click',hideVpsPlanDiv);
document.addEventListener('DOMContentLoaded',function(){const canadaButton=document.getElementById('loc2');const indiaButton=document.getElementById('loc1');const vpsPlanDiv=document.getElementById('basic_three_div');function hideVpsPlanDiv(){vpsPlanDiv.classList.add('d-none')}
function showVpsPlanDiv(){vpsPlanDiv.classList.remove('d-none')}
})
{{-- canadaButton.addEventListener('click',hideVpsPlanDiv);indiaButton.addEventListener('click',showVpsPlanDiv) --}}
</script>
<script>
$(document).ready(function(){$('#exampleModal').on('shown.bs.modal',function(){setTimeout(function(){var targetSection=document.getElementById('see_more_features');if(targetSection){targetSection.scrollIntoView({behavior:'smooth',block:'start'})}},300)})})
</script>

<!-- <script>
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
})
</script>  -->


 @endsection