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
            </div>
        @endif
    @endif
    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
      

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
                
                    @php

                            $plan_row = 'justify-content-center';
                            $box_plan_class = 'col-md-6 col-lg-3 col-xs-12';
                            

                            $_BASIC_PRICE_36_INR='_STARTER_PRICE_36_INR';
                            $_BASIC_PRICE_36_USD='_STARTER_PRICE_36_USD';
                            $_ESSENTIAL_PRICE_36_INR='_PERFORMANCE_PRICE_36_INR';
                            $_ESSENTIAL_PRICE_36_USD='_PERFORMANCE_PRICE_36_USD';
                            $_PROFESSIONAL_PRICE_36_INR='_BUSINEESS_PRICE_36_INR';
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






<section class="winds-supprt-vid-main head-tb-p-40">
    <div class="container">
        <div class="win-support-php head-tb-p-40">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="win-supprt-vid-cnt">
                    <div class="win-supprt-tittle">
                        Currently Supported PHP Versions
                    </div>
                    <div class="win-supprt-txt">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="win-support-video">
                    <!-- <video autoplay muted playsinline>
                        <source src="/assets/images/windows_hosting/php-versions.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video> -->
                    <img src="/assets/images/windows_hosting/01.webp" alt="01">
                </div>
            </div>
        </div>
        </div>
        <div class="win-support-dot-net head-tb-p-40">
        <div class="row align-items-center flex-lg-row-reverse">
            <div class="col-lg-6">
                <div class="win-supprt-vid-cnt">
                    <div class="win-supprt-tittle">
                        Available .NET Core Versions
                    </div>
                    <div class="win-supprt-txt">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="win-support-video">
                    <!-- <video autoplay muted playsinline>
                        <source src="/assets/images/windows_hosting/php-versions.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video> -->
                    <img src="/assets/images/windows_hosting/02.webp" alt="01">
                </div>
            </div>
        </div>
        </div>
        <div class="win-support-database head-tb-p-40">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="win-supprt-vid-cnt">
                    <div class="win-supprt-tittle">
                        Database Servers
                    </div>
                    <div class="win-supprt-txt">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="win-support-video">
                    <!-- <video autoplay muted playsinline>
                        <source src="/assets/images/windows_hosting/php-versions.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video> -->
                    <img src="/assets/images/windows_hosting/03.webp" alt="01">
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

<section class="why-dvlp-busi head-tb-p-40">
    <div class="section-heading">
    <h2 class="text-center text_head " id="landingloc linux-hosting-plan">Who Should Use Windows Hosting?</h2>  
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="why-dvlp-img">
                    <img src="../assets/images/windows_hosting/why_shld_win.webp" alt="why_shld_win">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="service-cards">
                    <ul>
                        <li>
                            <div class="service-tittle">
                                <h3>ASP.NET & .NET Core Developers</h3>
                            </div>
                            <p>If your website or app is built using ASP.NET or .NET Core, Windows hosting should be your go-to solution. It offers native support and will lead to fewer compatibility issues, stability, and a performance-driven environment.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>MSSQL Database Users</h3>
                            </div>
                            <p>If you rely on Microsoft SQL Server (MSSQL) databases for your websites, Windows web hosting will simplify your work. It runs most efficiently on a Windows environment as a Microsoft product, offering smooth performance and seamless compatibility.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Businesses Using the Microsoft Ecosystem</h3>
                            </div>
                            <p>If you are part of a business that relies heavily on Microsoft technologies, Windows shared hosting is your first and perfect choice for a smooth connection and flawless performance. You don’t need to switch platforms or change the way you work. </p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Companies Running Enterprise-Level Applications</h3>
                            </div>
                            <p>If you run resource-intensive applications, you need a stable and powerful hosting environment to achieve your outcome. Windows hosting is a highly competent platform that can handle demanding workloads with ease and deliver high performance with Sureshot reliability.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Running on VBScript or Classic ASP Applications</h3>
                            </div>
                            <p>If you still use legacy applications like VBScript or Classic ASP, the Windows hosting environment can fully support them. Windows hosting not only keeps your legacy applications running smoothly but also saves you from rebuilding the application from scratch. </p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Users Requiring Full .NET Framework Support</h3>
                            </div>
                            <p>If your organization develops apps requiring the full .NET Framework for smooth functioning, Windows hosting has you covered. With the full support for all .NET components, everything runs exactly the way you want with seamless compatibility and optimized performance. </p>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>








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
@endif

@include('template.'.$themeversion.'.testimonial_section');
@include('template.'.$themeversion.'.support_section_home');


<div class="lading_bottom">
      
  <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')
    @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
   
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