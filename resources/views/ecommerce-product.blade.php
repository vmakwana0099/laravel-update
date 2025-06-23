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
    @endif
    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
        <div class="lin-plns-cntnr head-tb-p-40">
    <div class="container">
            <div class="row ">
            
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
            </div>
            </div>
     </div>
@php

     @endphp

    {{-- <div class="vps-plan-main-div win-pln-box head-tb-p-40">
        <div class="container">
            <div class="row justify-content-center"> --}}
            <div class="web-pln-box head-tb-p-40" id="web_hosting_plan">
                <div class="container-fluid">
                    <div class="shared-plan-bx-pd">
            
                 {{-- <div class="col-sm-12"> --}}
               <div class="section-heading">
                <h2 class="text-center text_head " id="landingloc">Choose Your eCommerce Hosting Plan</h2>
                </div>
                {{-- </div> --}}
                
               
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
                @php if($ProductBanner->id == '10'){
                $mainclassssl = 'ssl-small';
                }else{
                $mainclassssl = '';
                } @endphp
               
                    @php
                        if ($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6) {
                            $plan_row = 'justify-content-center';
                            $box_plan_class = 'col-lg-3 col-md-6 col-sm-12';
                           

                            $_BASIC_PRICE_36_INR='_BASIC_PRICE_36_INR';
                            $_BASIC_PRICE_36_USD='_BASIC_PRICE_36_USD';
                            $_ESSENTIAL_PRICE_36_INR='_ESSENTIAL_PRICE_36_INR';
                            $_ESSENTIAL_PRICE_36_USD='_ESSENTIAL_PRICE_36_USD';
                            $_PROFESSIONAL_PRICE_36_INR='_PROFESSIONAL_PRICE_36_INR';
                            $_PROFESSIONAL_PRICE_36_USD='_PROFESSIONAL_PRICE_36_USD';
                            
                        }
                         
                    @endphp
             <div class="tab-content {{$mainclassssl}}">
                    
                    <!--This Code for Three Year-->
                    {{-- <div id="vps-plan3" class="tab-pane active show"> 
                        <div class="plan-main-div" id="plans"> --}}
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
                                                        <span class="cut-price" >
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
                                                        <span class="cut-price" >
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
                                                        <span class="cut-price" >
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
                                <div class="shared-plan-box-main" data-aos="fade-left" data-aos-easing="ease-out-back">
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
                                                        <span class="cut-price" >
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

<div class="vps-features {{$mainclass}} head-tb-p-40" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="txt-head aos-init" data-aos="fade-up">Features of our eCommerce Hosting</h2>

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

@endif


@include('template.hostadvice-award')

<div class="lading_bottom">
     
  <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')
    @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
  
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
    
</div>

@if(isset($_REQUEST['combooffer']) && $_REQUEST['combooffer']=='1')
<script>
   $('html, body').animate({
        scrollTop: $("#comboofferplan").offset().top-200
    }, '2000'); 
</script>
@endif
<script>

</script>
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