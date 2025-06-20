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
         
            </div>
            </div>
     </div>

    {{-- <div class="vps-plan-main-div win-pln-box head-tb-p-40">
        <div class="container">
            <div class="row justify-content-center"> --}}
            <div class="web-pln-box head-tb-p-40" id="web_hosting_plan">
                <div class="container-fluid">
                    <div class="shared-plan-bx-pd">
            
                 {{-- <div class="col-sm-12"> --}}
                <div class="section-heading">
                    <h2 class="text-center text_head " id="windows_hosting_plans">Choose Your Windows Hosting Plans</h2>
                </div>
                {{-- </div> --}}
                
                 @if($ProductBanner->id == 2) 
                <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='yearshow'>
                    <ul class="nav nav-pills nav-vps-hosting d-flex justify-content-center mb-4 @if($ProductBanner->id == 7) pb-10 @endif">
                        <li><a class="nav-link" data-bs-toggle="pill" href="#vps-plan0" title="1 Month" id='onemonth'>1 Month @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#vps-plan1" title="1 year" id='oneyear'>1 year @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#vps-plan2" title="2 years" id='twoyear'>2 years @if(!empty($ProductBanner->varOfferTextTwoYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextTwoYear}}</span></span>@endif</a></li>
                        <li><a class="nav-link" data-bs-toggle="pill" href="#vps-plan3" title="3 years" id='threeyear' class="active show">3 years @if(!empty($ProductBanner->varOfferTextThreeYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeYear}}</span></span>@endif</a></li>
                    </ul>
                </div>
                @endif
               
                
                    @php

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
            
                    @endphp
             <div class="tab-content">
               
                    <!--This Code for Three Year-->
                    <div id="vps-plan3" class="tab-pane active show"> 
                        <div class="plan-main-div" id="plans">
                            <div class="row {{ $plan_row}}">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back">
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
                                                        <span class="cut-price">
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
                                <div class="shared-plan-box-main shared-plan-most-popular" data-aos="fade-left" data-aos-easing="ease-out-back">
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
                                                        <span class="cut-price">
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
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back">
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
                                                        <span class="cut-price">
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
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        
    </div>
    </div>
    
    @endif


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

<div class="vps-features {{$mainclass}} head-tb-p-40" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="txt-head aos-init" data-aos="fade-up">Features of Our Windows Web Hosting Server</h2>
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


 <!--See More Features section start-->
 @include('template.theme_v1.more_hosting_features')
 <!--See More Features section end-->

@endif

@include('template.hostadvice-award')

<div class="lading_bottom">
      
  <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')
    @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
   
    <section class="most-power-plans head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Looking For Something Else?</h2>
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
    
</div>

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
 @endsection