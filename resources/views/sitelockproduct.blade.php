@extends('layouts.app')
@section('content')

<div class="{{$ProductBanner->varBannerIconClass}} vps_main">
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

    <?php
                            $plan_row = 'justify-content-center';
                            $box_plan_class = 'col-lg-3 col-md-6 col-sm-12';
                                                        
                            $_SITELOCK_HOSTING_PERFORMANCE_PRICE_36_INR='_PERFORMANCE_PRICE_36_INR';
                            $_SITELOCK_HOSTING_PERFORMANCE_PRICE_36_USD='_PERFORMANCE_PRICE_36_USD';
                            $_SITELOCK_HOSTING_BUSINEESS_PRICE_36_INR='_BUSINEESS_PRICE_36_INR';
                            $_SITELOCK_HOSTING_BUSINEESS_PRICE_36_USD='_BUSINEESS_PRICE_36_USD';
                            $_SITELOCK_HOSTING_STARTER_PRICE_36_INR='_STARTER_PRICE_36_INR';
                            $_SITELOCK_HOSTING_STARTER_PRICE_36_USD='_STARTER_PRICE_36_USD';
                            
                    ?>

                      

    <div class="gsuite-intro">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 order-xs-1">
                <h2 class="text-center intro-title"><span>High-octane Security & Malware Protection</span> for your website</h2>
            </div>
            <div class="col-12 col-sm-8 order-xs-3">
                <div class="left">
                    <div class="cms">
                        <p>Did you know that 230,000 new malware samples are produced every day? With such enormous figures of perils encircling the virtual world, your website needs a robust security strategy irrespective of how large or small it is. SiteLock security scans your website for any peculiarity that shouldn’t be there like malware, malicious codes, etc. and automatically alerts you via email.
                        </p>
                        <p>Our security service helps keep your website safe from online threats retaining your peace of mind. In addition, you also get the SiteLock™ Trust Seal to display on the website. It is a recognized ‘green signal’ for the e-commerce customers and helps boost your conversion rates and sales.</p>
                    </div>
                    <?php /*<div class="get-started-btn">
                        <a class="btn-primary" title="Get Started">Get Started</a>
                    </div>*/?>
                </div>
            </div>
            <div class="col-12 col-sm-4 order-xs-2">
                <div class="right">
                    <img src="/assets/images/sitelock-web-security.webp" alt="sitelock-web-security" title="sitelock-web-security">
                </div>
            </div>
        </div><!-- row end -->
    </div><!-- container end -->
</div>

     <!-- <div class="aws-content">
        <div class="aws-managed-services">   
<div class="container">
                <div class="row">

                    <div class="col-sm-12">
                        <h2 class="text-center aos-init" data-aos="fade-up" data-aos-delay="100">Overview</h2>
                    
                        <div class="aws-para aos-animate aos-init">
                            <p ><b>Website security & malware protection for your website</b>
                              </p>
                            <p>SiteLock™, the global leader in website security, protects your website to give you peace of mind.
                            </p><br />
                            <p>SiteLock's Daily Malware Scanning identifies vulnerabilities and known malicious code and automatically removes it from your website to protect your website and visitors against threats.</p>
                            <br />
                            <p>Plus you get the SiteLock Trust Seal which builds customer confidence and is proven to increase sales and conversion rates.</p>
                        </div>
                    </div>
                   
                   
                </div>
            </div>  
       </div>
   </div> -->

    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
    <div class="vps-plan-main-div site_lock_plan @if($ProductBanner->id == 7) vpsplan_slider_div @endif @if($ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 13 || $ProductBanner->id == 8) dedicated-plan-main-div @endif">
        <div class="container">
            <div class="row">
                 <div class="col-sm-12">
                 <div class="cms">
                <div class="section-heading">
                    
                    <h2 class="text-center text_head">Quality hosting does not mean elephantile costs. Not atleast with our plans.</h2>
                    
                </div>
                </div>
                </div>

                <div class="tab-content" >
                    <!--This Code for Three Year-->
                    <div id="vps-plan3" class="tab-pane active show">
                        <div class="plan-main-div">
                            <div class="row {{ $plan_row}}">
                                  
                                         @php 
                                         $class = ''; $class1 = '';
                                          if($ProductsPackageData[0]->chrDisplayontop == 'Y'){
                                          $class = 'recommanded-main'; 
                                          $class1 = 'recommanded-main-icon'; 
                                         } @endphp
                                {{-- Essi --}}
                                <div class="{{$box_plan_class}}">
                                            @php $class = ''; $class1 = '';
                                            if($ProductsPackageData[0]->chrDisplayontop == 'Y'){
                                            $class = 'recommanded-main'; 
                                            $class1 = 'recommanded-main-icon'; 
                                            } @endphp
                                    <div class="shared-plan-box {{$class}} vps-plan-recommanded-main">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                            <div class="{{$class1}}"></div>
                                          
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="PerformThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[0]->intOldPriceThreeYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="PerformThreeYearUSD">{{$ProductsPackageData[0]->intOldPriceThreeYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                   @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[0]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                            
                                            <span class="shared-offer-discount" id="EssentialThreeYearOffer">
                                                @if (count($blackfridayOffArr) > 1)  
                                                    {{$blackfridayOffArr[4]}}% OFF
                                                @else
                                                    ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                @endif
                                         
                                            @endif
                                        </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="PerformThreeYearWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_SITELOCK_HOSTING_STARTER_PRICE_36_INR) }}</span>/mo*

                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="PerformThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_SITELOCK_HOSTING_STARTER_PRICE_36_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                           
                                         
                                            </div>
                                            
                                            <div class="shared-plan-btm" id="PerformanceThreeYearButtonText" >
                                                {!!$StarterThreeYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if($ProductsPackageData[0]->varTitle == 'ESSENTIAL' && strtolower(trim($Specification)) == 'free domain')
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
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "10 mssql/mysql space")
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                <a onclick="VPSFeatures('PerformanceOneMonthFeatures')" href="javascript:;" data-scroll-to="#PerformanceOneMonthFeatures">View Features <i class="fa fa-angle-down bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>

                                {{-- 2 --}}
                                 <div class="{{$box_plan_class}}">
                                                @php $class = ''; $class1 = '';
                                            if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                            $class = 'recommanded-main'; 
                                            $class1 = 'recommanded-main-icon'; 
                                            } @endphp
                                    <div class="shared-plan-box {{$class}} vps-plan-recommanded-main" >
                                        <div class="shared_plan_price">

                                        <div class="shared-plan-head">{{$ProductsPackageData[1]->varTitle}}</div>
                                            <div class="{{$class1}}"></div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="BusinessThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceThreeYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="BusinessThreeYearUSD">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceThreeYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                 @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[1]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                            
                                            <span class="shared-offer-discount" id="ProfessionalThreeYearOffer">
                                                @if (count($blackfridayOffArr) > 1)  
                                                    {{$blackfridayOffArr[4]}}% OFF
                                                @else
                                                    ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                @endif
                                          
                                            @endif
                                        </span>
                                            </div>
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        
                                    </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_SITELOCK_HOSTING_PERFORMANCE_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_SITELOCK_HOSTING_PERFORMANCE_PRICE_36_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                         
                                           
                                            </div>
                                            
                                              <div class="shared-plan-btm" id="BusinessThreeYearButtonText" >
                                                {!!$PerformanceThreeYearButtonText!!} 
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
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
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
                                                            <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                            </span>
                                                            </div>
                                                        </li>
                                                         @elseif(strtolower(trim($Specification)) == "20 mssql/mysql space")
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>

                                {{-- 3 --}}

                                <div class="{{$box_plan_class}}">
                                    <div class="shared-plan-box">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[2]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="EnterpriseThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceThreeYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="EnterpriseThreeYearUSD">{{$ProductsPackageData[2]->intOldPriceThreeYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[2]->varAdditionalOffer));
                                                @endphp
                                            @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                            
                                            <span class="shared-offer-discount" id="EnterpriseThreeYearOffer">
                                                @if (count($blackfridayOffArr) > 1)  
                                                    {{$blackfridayOffArr[4]}}% OFF
                                                @else
                                                    ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                @endif
                                          
                                            @endif
                                        </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">
                                               
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="EnterpriseThreeYearWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_SITELOCK_HOSTING_BUSINEESS_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="EnterpriseThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_SITELOCK_HOSTING_BUSINEESS_PRICE_36_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp 
                                            </div>
                                            
                                               <div class="shared-plan-btm" id="EnterpriseThreeYearButtonText" >
                                                {!!$BusinessThreeYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
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
                                                        <li> <div class="free_domain">{{$Specification}}
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
                                                        <li> <div class="free_domain free_domain_black">{{$Specification}}
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
                                                        <li> <div class="free_domain">{{$Specification}}
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

                            </div>
                        </div>
                    </div>
                </div>
                

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
                                    <div class="vps-plan-div">
                                        <div class="plan-head" >{{$ProductsPackageData[0]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="StarterOneMonthWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_1_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterOneYearWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="StarterOneMonthWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_1_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterOneYearWhmcsUSD" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthINR))
                                                        <div id='StarterOneMonthINR' class="spacehide" style="display: none" >
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearINR))
                                                        <div id='StarterOneYearINR' class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price">{{$ProductsPackageData[0]->intOldPriceOneYearINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneMonthUSD))
                                                        <div id='StarterOneMonthUSD' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="overline-price" id='StarterOneMonthUSD'>{{$ProductsPackageData[0]->intOldPriceOneMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceOneYearUSD))
                                                        <div id='StarterOneYearUSD'  class="spacehide">
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
                                            <div class="vps-plan-btm" id="StarterMonthlyButtonText" style="display: none">
                                                {!!$StarterMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="StarterOneYearButtonText" >
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
                                            <div class="plan-icon-right"></div>
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="PerformOneMonthWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_1_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="PerformOneMonthWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_1_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformOneYearWhmcsUSD" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthINR))
                                                        <div id='PerformOneMonthINR' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id='PerformOneMonthINR'>{{$ProductsPackageData[1]->intOldPriceOneMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearINR))
                                                        <div id='PerformOneYearINR'  class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneYearINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneMonthUSD))
                                                        <div id='PerformOneMonthUSD' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceOneMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceOneYearUSD))
                                                        <div id='PerformOneYearUSD'  class="spacehide">
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
                                            <div class="vps-plan-btm" id="PerformanceMonthlyButtonText" style="display: none">
                                                {!!$PerformanceMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="PerformanceOneYearButtonText" >
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
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessOneMonthWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_1_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessOneMonthWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_1_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessOneYearWhmcsUSD" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_12_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp 
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthINR))
                                                        <div id='BusinessOneMonthINR' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearINR))
                                                        <div id='BusinessOneYearINR'  class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneYearINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneMonthUSD))
                                                        <div id='BusinessOneMonthUSD' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceOneMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceOneYearUSD))
                                                        <div id='BusinessOneYearUSD'  class="spacehide">
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
                                            <div class="vps-plan-btm" id="BusinessMonthlyButtonText" style="display: none">
                                                {!!$BusinessMonthlyButtonText!!}
                                            </div>
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
                            </div>
                        </div>
                    </div>
                    <?php /*
                    <!--This Code for Three Months and Two Year-->
                    <div id="vps-plan2" class="tab-pane active show">
                        <div class="plan-main-div">
                            <div class="row">
                                <div class="col-md-4 col-xs-12 col-12 align-self-center" data-aos="fade-left" data-aos-easing="ease-out-back">
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
                                <div class="col-md-4 col-xs-12 col-12 align-self-center" data-aos="zoom-in" data-aos-easing="ease-out-back">
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
                                <div class="col-md-4 col-xs-12 col-12 align-self-center" data-aos="fade-right" data-aos-easing="ease-out-back">
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
                    */ ?>
                    <div id="vps-plan3" class="tab-pane">
                        <div class="plan-main-div">
                            <div class="row">
                                <div class="col-md-4 col-xs-12 col-12 align-self-center">
                                    <div class="vps-plan-div">
                                        <div class="plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="StarterSixMonthWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_6_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterThreeYearWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_36_INR') }}</strong>/mo*

                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="StarterSixMonthWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_6_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="StarterThreeYearWhmcsUSD" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_STARTER_PRICE_36_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceSixMonthINR))
                                                        <div id='StarterSixMonthINR' class="spacehide" style="display: none";>
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price" id="StarterSixMonthINR">{{$ProductsPackageData[0]->intOldPriceSixMonthINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                        <div id='StarterThreeYearINR'  class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceThreeYearINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceSixMonthUSD))
                                                        <div id='StarterSixMonthUSD' style="display: none" class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[0]->intOldPriceSixMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearUSD))
                                                        <div id='StarterThreeYearUSD'  class="spacehide">
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
                                            <div class="vps-plan-btm" id="StarterSixMonthlyButtonText" style="display: none">
                                                {!!$StarterSixMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="StarterThreeYearButtonText" >
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
                                            <div class="plan-icon-right"></div>
                                            <div class="{{$class1}}"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="PerformSixMonthWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_PERFORMANCE_PRICE_6_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="PerformThreeYearWhmcsINR" >
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
                                                        <div id='PerformSixMonthINR' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceSixMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                        <div id='PerformThreeYearINR'  class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceThreeYearINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceSixMonthUSD))
                                                        <div id='PerformSixMonthUSD' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[1]->intOldPriceSixMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearUSD))
                                                        <div id='PerformThreeYearUSD'  class="spacehide">
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
                                            <div class="vps-plan-btm" id="PerformanceSixMonthlyButtonText" style="display: none">
                                                {!!$PerformanceSixMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="PerformanceThreeYearButtonText" >
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
                                            <div class="plan-icon-right"></div>
                                        </div>
                                        <div class="vps-price-padding">
                                            <div class="plan-price clearfix">
                                                <span class="vps-start d-none d-md-block">Starting at </span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="vps-price" id="BusinessSixMonthWhmcsINR" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_6_INR') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessThreeYearWhmcsINR" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_36_INR') }}</strong>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                <span class="vps-price" id="BusinessSixMonthWhmcsUSD" style="display: none">
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_6_USD') }}</strong>/mo*
                                                </span>
                                                <span class="vps-price" id="BusinessThreeYearWhmcsUSD" >
                                                    <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><strong>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_BUSINEESS_PRICE_36_USD') }}</strong>/mo*
                                                </span>
                                                @php } @endphp
                                                <div class="price-overline-text">
                                                    <span class="price-grey">
                                                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 

                                                        @if(!empty($ProductsPackageData[2]->intOldPriceSixMonthINR))
                                                        <div id='BusinessSixMonthINR' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceSixMonthINR}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                        <div id='BusinessThreeYearINR'  class="spacehide">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceThreeYearINR}} /mo*</span>
                                                        </div>
                                                        @endif
                                                        @php } else { @endphp 
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceSixMonthUSD))
                                                        <div id='BusinessSixMonthUSD' class="spacehide" style="display: none">
                                                            <span class="price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline-price">{{$ProductsPackageData[2]->intOldPriceSixMonthUSD}} /mo*</span> 
                                                        </div>
                                                        @endif
                                                        @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearUSD))
                                                        <div id='BusinessThreeYearUSD'  class="spacehide">
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

                                            <div class="vps-plan-btm" id="BusinessSixMonthlyButtonText" style="display: none">
                                                {!!$BusinessSixMonthlyButtonText!!}
                                            </div>
                                            <div class="vps-plan-btm" id="BusinessThreeYearButtonText" >
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
</div>
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
                <h2 class="features-title aos-init" data-aos="fade-up">Smart Features:</h2>
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
                    <span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SPECIAL_PACKAGE_OFFER_1_INR') }}</span><span class="per-month">/mo*</span>
                     @php } else { @endphp 
                    <span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SPECIAL_PACKAGE_OFFER_1_USD') }}</span><span class="per-month">/mo*</span>
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
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_INR') }}</span><span class="per-month">/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_USD') }}</span><span class="per-month">/mo*</span></span>
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


<div class="g-suite-lists site-lock-lists">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="g_s_l-title">Website Hacked?</h2>
            </div>
            <div class="aws-para aos-animate aos-init">
                            <h4>Fix it with SiteLock Emergency Response</h4>
                            <p>A website attack is a severe threat to the business reputation and needs emergency assistance for quick recovery. If your website has been compromised, here’s how SiteLock Emergency Response assists:</p>
            <br /><br />
            </div>

            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-icons s-icons malware-scan"></div>
                    <div class="g-list-box">
                        <h4>Malware Scan</h4>
                        <span>Automatically assesses and alerts you about any malware that is detected on the website.</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-icons s-icons vul-scan"></div>
                    <div class="g-list-box">
                        <h4>Vulnerability Scan</h4>
                        <span>Scans vulnerabilities proactively to secure your web-based applications and keep them up-to-date.
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-icons s-icons sitelock-seal"></div>
                    <div class="g-list-box">
                        <h4>OWASP Protection</h4>
                        <span>Get protection against the top 10 security flaws in the web applications as recognized by the Open Web Application Security Project.</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-icons s-icons sitelock-seal"></div>
                    <div class="g-list-box">
                        <h4>SiteLock™ Badge</h4>
                        <span>Give your audience a chance to confide in your services and products with the SiteLock protection badge on the website.
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-icons s-icons protect"></div>
                    <div class="g-list-box">
                        <h4>Protect your reputation</h4>
                        <span>Daily scans help detect malware early before search engines have a chance to find it and blacklist your site.</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-icons s-icons cdn"></div>
                    <div class="g-list-box">
                        <h4>Bolster your reputation</h4>
                        <span>Continuous scans help detect malware before search engines can find it. Thus, it prevents your site from blacklisting and keeps your reputation intact.</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-icons s-icons malware-removal"></div>
                    <div class="g-list-box">
                        <h4>Automated setup</h4>
                        <span>Activate protection for your website within a few minutes with the quick and fully-automated installation.</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12">
                <div class="g_s_l-box">
                    <div class="g-icons s-icons malware-removal"></div>
                    <div class="g-list-box">
                        <h4>Boost site speed</h4>
                        <span>Increase your website speed as much as 50%. It distributes the website globally and enables your visitors to connect to the closest location for quick page load.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<div class="lading_bottom">
    @if(!empty($FaqData) && count($FaqData) >0)
    {{-- FAQs code start --}}
    <div class="lading_bottom">
        <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
        {{-- @include('template.'.$themeversion.'.testimonial_section')  --}}
        @include('template.'.$themeversion.'.faq-section')

        @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
        <div class="hostingtype_div">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h3 class="title">Didn't hit your sweet spot?</h3>
                    </div>
                    @php $p = 0; $class = ''; $color = ''; $info = ''; @endphp
                    @foreach($FeaturedProductsData as $FeaturedProducts)
                    @php
                    if ($p == '0'){
                    $class = 'd-flex justify-content-end';
                    $color = 'left_part';
                    } else {
                    $class = '';
                    $color = 'right_part';
                    }
                    @endphp
                    <div class="col-lg-6 {{$color}} {{$class}}">
                        <div class="hosting_box d-flex">
                            <div class="image align-self-center" data-aos="fade-right" data-aos-delay="250">
                                <i class="{{$FeaturedProducts->varIconClass}}"></i>
                                <div class="hosting-price-start">Starting at
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
                                @php $FeaturedProducts_expload = explode("\n",$FeaturedProducts->varFeature); @endphp
                                <ul class="list">
                                    @foreach($FeaturedProducts_expload as $info)
                                    <li>
                                        <h6>{{$info}}</h6>
                                    </li>
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
        {{-- <div class="product_offers">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="product_offers_main">
                        <div class="product_offers_head">
                            <h2>Domain Registration</h2>
                        </div>
                        <div class="product_offers_cnt">
                            <div class="product_offers_price">
                                <ul>
                                <li class="product_offers_prc_head">Get .COM At</li>
                                <li class="product_off_prc_pr"><span class="rupees_icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span> {!! Config::get('Constant.MEGAMENU_REGISTER_PRICE_INR') !!}<span class="month_icon">/year*</span></li>
                                </ul>
                            </div>
                        </div>
                            <div class="product_offers_btn">
                                <a href="https://www.hostitsmart.com/domain/buy-com-domain-names">Go Online Today</a>
                            </div>
                        
                    </div>
                </div>
            </div>
            </div>
        </div> --}}
    </div>
    {{-- FAQs code end --}}
    {{-- <div class="getquestion-div">
        <div class="container">
            <div class="row">
                <div class="col-12">
                	@php if($ProductBanner->id == 4){ @endphp
                    <h3 data-aos="fade-up">Need to know something more? See if you find your answer here:</h3>
                    @php } else if($ProductBanner->id == 8){ @endphp
                    <h3 data-aos="fade-up">Need to know more about our dedicated hosting plans? See if we got them answered already:</h3>
                    @php } else { @endphp
                    <h3 data-aos="fade-up">Frequently Asked Questions</h3>
                    @php } @endphp

                </div>
                <div class="col-12">
                    <div id="accordion">
                        @php $i = 0; $class = ''; $class1 = ''; $class2 = ''; $class3 = '';  $class4 = ''; @endphp
                        @foreach($FaqData as $Faq)
                        @php if ($i == '0'){
                        $class = 'true';
                        $class1 = 'collapsed';
                        $class2 = 'display:block';
                        $open_class = 'active-accordition';
                        } else {
                        $class = 'false'; 
                        $class1 = 'collapsed'; 
                        $class2 = 'display:none';
                        $open_class = '';
                        } if ($i > '4'){
                        $class3 = 'display:none';
                        $class4 = 'display:block';
                        } else {
                        $class3 = '';
                        $class4 = 'display:none';
                        } @endphp
                        <div class="card" data-aos="fade-up" style="{{$class3}}">
                            <h4 class="mb-0 {{$open_class}}">
                                <button class="btn btn-link {{$class1}}" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                    {{$Faq->varTitle}} 
                                </button>
                            </h4>
                            <div id="collapse{{$i}}" class="collapse" data-parent="#accordion" style="{{$class2}}">
                                <div class="card-body">
                                    {!! $Faq->txtDescription !!}
                                </div>
                            </div>
                        </div>
                        @php $i++;@endphp
                        @endforeach
                    </div>
                </div>
                <div class="col-12 aos-init" data-aos="fade-up" style="{{$class4}}">
                    <a href="javascript:;" id="show" title="More" class="more_link">More</a>
                </div>
                <script>
                    $("#show").click(function() {
                    $(".card").show();
                    $("#show").hide();
            });</script>
            </div>
        </div>
    </div> --}}
    @endif
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
                            <div class="hosting-price-start" title="{{ $FeaturedProducts->varWHMCSFieldName }}">Starting at10 
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
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SHARED_HOSTING_OFFER_2_INR') }}</span><span class="per-month">/mo*</span></span>
                            </div>
                            @php } else { @endphp 
                             <div class="price-part">
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SHARED_HOSTING_OFFER_2_USD') }}</span><span class="per-month">/mo*</span></span>
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
                                	<span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">{{ Config::get('Constant.HOSTING_PAGE_DOMAIN_OFFER_1_INR') }}</span><span class="per-month">/mo*</span></span>
                                 @else
                                	<span class="whole-span"><span class="ruppess">&#36;</span> <span class="big-price">{{ Config::get('Constant.HOSTING_PAGE_DOMAIN_OFFER_1_USD') }}</span><span class="per-month">/mo*</span></span>
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
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.DEDICATED_HOSTING_OFFER_1_INR') }}</span><span class="per-month">/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.DEDICATED_HOSTING_OFFER_1_USD') }}</span><span class="per-month">/mo*</span></span>
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
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_INR') }}</span><span class="per-month">/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_USD') }}</span><span class="per-month">/mo*</span></span>
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
                    <h2>Windows Hosting</h2>
                </div>
                <div class="product_offers_cnt">
                    <div class="product_offers_price">
                        <ul>
                        <li class="product_offers_prc_head">Starting From</li>
                        <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>90<span class="month_icon">/mo*</span></li>
                        </ul>
                    </div>
                </div>
                    <div class="product_offers_btn">
                        <a href="https://www.hostitsmart.com/hosting/windows-hosting">Click to Host Today</a>
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
    $(function(){
        $("#monthly").prop('checked', false);
        setTimeout(function(){ $("#monthly").click(); $("#threeyear").click(); },1000); //set 3 year pricing
    });
 </script>

<script type="text/javascript">
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
</script>

 @endsection