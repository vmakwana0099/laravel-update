@extends('layouts.app')
@section('content')
@php
$themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; 
@endphp
@include('template.'.$themeversion.'.banner')
@php
    $plan_row = 'justify-content-center';
    $box_plan_class = 'col-lg-3 col-md-6 col-sm-12';
    $_BASIC_PRICE_12_INR='_STARTER_PRICE_12_INR';
                $_BASIC_PRICE_36_INR='_BASIC_PRICE_36_INR';
                $_ESSENTIAL_PRICE_36_INR='_ESSENTIAL_PRICE_36_INR';
                $_PROFESSIONAL_PRICE_36_INR='_PROFESSIONAL_PRICE_36_INR';

@endphp
<div class="vps_main linux-main" id="check_linux_plan">
  <div class="vps-plan-main-div win-pln-box head-tb-p-40">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="section-heading">
               <h2 class="text-center text_head " id="landingloc linux-hosting-plan">Go with the Linux Web Hosting Plan that Best Fits</h2>
                <p class="text-center">Our plans are designed to serve both startups and enterprises alike. Choose a plan that supports your needs!</p>
            </div>
        </div>    


      <div class="row">
                    <div class="col-12">
                    <!-- <br /> -->
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
                    $('input[id^="location"]').each(function(i, ele) { $(this).val(locstr);
                         });
                }
            </script>
        </div>
    </div>
                </div>
 <div id="vps-plan3" class="tab-pane active show"> 
                        <div class="plan-main-div">
                            <div class="row {{ $plan_row}}">
                                  {{-- basic --}}
                                  <div class="{{$box_plan_class}} " data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                   @php $vps_plan_box = ($ProductBanner->id == 13) ? 'java-plan-box' : '';@endphp

                                    <div class="shared-plan-box {{$vps_plan_box}}">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[0]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2) 
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="BasicThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[0]->intOldPriceThreeYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[0]->intOldPriceThreeYearUSD))
                                                        <span class="shared-cut-price" id="BasicThreeYearUSD">{{$ProductsPackageData[0]->intOldPriceThreeYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[0]->varAdditionalOffer));
                                                @endphp
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                            
                                            <span class="shared-offer-discount" id="BasicThreeYearOffer">
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
                                                
                                                <span class="shared-main-price-tittle" id="StarterThreeYearWhmcsINR" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="StarterThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_36_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                            </div>
                                            

                                              <div class="shared-plan-btm" id="StarterThreeYearButtonText" >
                                                {!!$StarterThreeYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
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
                                                        @elseif(strtolower(trim($Specification)) == '10,000 visits monthly')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
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
                                                {{-- <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See More Features</a> --}}

                                                <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
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
                                         @php 
                                         $class = ''; $class1 = '';
                                          if($ProductsPackageData[2]->chrDisplayontop == 'Y'){
                                          $class = 'recommanded-main'; 
                                          $class1 = 'recommanded-main-icon'; 
                                         } @endphp
                                {{-- Essi --}}
                                <div class="{{$box_plan_class}} ">
                                            @php $class = ''; $class1 = '';
                                            if($ProductsPackageData[1]->chrDisplayontop == 'Y'){
                                            $class = 'recommanded-main'; 
                                            $class1 = 'recommanded-main-icon'; 
                                            } @endphp
                                    <div class="shared-plan-box {{$class}} vps-plan-recommanded-main {{$vps_plan_box}}">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[1]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                            <div class="{{$class1}}"></div>
                                          
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="PerformThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceThreeYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[1]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="PerformThreeYearUSD">{{$ProductsPackageData[1]->intOldPriceThreeYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                   @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[1]->varAdditionalOffer));
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
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="PerformThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_36_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                           
                                         
                                            </div>
                                            
                                            <div class="shared-plan-btm" id="PerformanceThreeYearButtonText" >
                                                {!!$PerformanceThreeYearButtonText!!}
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
                                                                <span class="price_domain">Your Domain Renewal Charges:<br>Rs 949/Yr*
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
                                                    @elseif(strtolower(trim($Specification)) == "website builder")
                                                        <li> <div class="free_domain">{{$Specification}}
                                                            </div>
                                                        </li>
                                                          
                                        @elseif(strtolower(trim($Specification)) == "supports python")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11.
                                                   
                                                </span>
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
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '6.x, 8.x, 9.x, 10.x, 11.x, 12.x, 14.x, 16.x, 18.x.'; @endphp
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
                                                {{-- <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See More Features</a> --}}

                                                <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
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
                                <div class="{{$box_plan_class}} ">
                                                @php $class = ''; $class1 = '';
                                            if($ProductsPackageData[2]->chrDisplayontop == 'Y'){
                                            $class = 'recommanded-main'; 
                                            $class1 = 'recommanded-main-icon'; 
                                            } @endphp
                                    <div class="shared-plan-box {{$class}} vps-plan-recommanded-main {{$vps_plan_box}}"  >
                                        <div class="shared_plan_price">

                                        <div class="shared-plan-head">{{$ProductsPackageData[2]->varTitle}}</div>
                                            <div class="{{$class1}}"></div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30 || $ProductBanner->id == 2)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="BusinessThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceThreeYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[2]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="BusinessThreeYearUSD">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceThreeYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                 @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[2]->varAdditionalOffer));
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
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_36_USD) }}</span>/mo*
                                                </span>
                                                @php } @endphp
                                         
                                           
                                            </div>
                                            
                                              <div class="shared-plan-btm" id="BusinessThreeYearButtonText" >
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
                                                                <span class="price_domain">Your Domain Renewal Charges:<br>Rs 949/Yr*
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
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '6.x, 8.x, 9.x, 10.x, 11.x, 12.x, 14.x, 16.x, 18.x.'; @endphp
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
                                                {{-- <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See More Features</a> --}}

                                                <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
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
                                                <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce bounce"></i></a>
                                            </div>
                                            @php } @endphp 
                                        </div>
                                    </div>
                                </div>
                                 {{-- ente --}}
                                 @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                <div class="{{$box_plan_class}} ">
                                    <div class="shared-plan-box {{$vps_plan_box}}">
                                         <div class="shared_plan_price">
                                        <div class="shared-plan-head">{{$ProductsPackageData[3]->varTitle}}
                                            {{-- <div class="plan-icon-right"></div> --}}
                                        </div>
                                                <div class="shared-plan-cut-price">
                                                @if($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 30)
                                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                                    
                                                    @if(!empty($ProductsPackageData[3]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="EnterpriseThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[3]->intOldPriceThreeYearINR}}</span>
                                                    @endif
                                                @else
                                                    
                                                    @if(!empty($ProductsPackageData[3]->intOldPriceThreeYearINR))
                                                        <span class="shared-cut-price" id="EnterpriseThreeYearUSD">{{$ProductsPackageData[3]->intOldPriceThreeYearUSD}}</span>
                                                    @endif
                                                @endif
                                                @endif
                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[3]->varAdditionalOffer));
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
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_36_INR') }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="EnterpriseThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_36_USD') }}</span>/mo*
                                                </span>
                                                @php } @endphp 
                                            </div>
                                            
                                               <div class="shared-plan-btm" id="EnterpriseThreeYearButtonText" >
                                                {!!$EnterpriseThreeYearButtonText!!}
                                            </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[3]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip" >
                                                @foreach($SpecificationData as $Specification)
                                                <div class="slide-toggle">
                                                    @if(strtolower(trim($Specification)) == 'free domain')
                                                        <li> <div class="free_domain">{{$Specification}}
                                                           <span class="domain_tooltip">
                                                                Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                                <span class="price_domain">Your Domain Renewal Charges:<br>Rs 949/Yr*
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
                                                         @elseif(strtolower(trim($Specification)) == "supports node.js")
                                        <li>
                                            <div class="free_domain">{{$Specification}}
                                                <span class="domain_tooltip">
                                                 @php echo ($ProductBanner->id == 2) ? '18.18.2' : '6.x, 8.x, 9.x, 10.x, 11.x, 12.x, 14.x, 16.x, 18.x.'; @endphp
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
                                                {{-- <a href="" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See More Features</a> --}}
                                                <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>
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
                </div>
            </div>
        </div>
    </div>
<div class="dy-money-back-grnt head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dy-money-back-grnt-box text-center">
                    <h2>Looking for a More Powerful Environment?</h2>
                    <p>Get a space built on Linux & boosted by a VPS server in India!</p>
                    <a href="{{url('/servers/vps-hosting-india')}}" title="Discover Google Workspace">Get Best VPS in India</a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="why-dvlp-busi head-tb-p-40">
    <div class="section-heading">
    <h2 class="text-center text_head " id="landingloc linux-hosting-plan">Why Linux Hosting?</h2>  
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="why-dvlp-img">
                    <img src="../assets/images/linux-hosting/why-dvlp-busi.webp" alt="why-dvlp-busi">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="service-cards">
                    <ul>
                        <li>
                            <div class="service-tittle">
                                <h3>Reliability is proven with over 30+ years.</h3>
                            </div>
                            <p>As an operating system, Linux is backed by 30 years of performance that offers you unmatched reliability and global trust with its stability, security, and efficiency, driving websites of all sizes to success.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>The backbone of over 80% of servers</h3>
                            </div>
                            <p>Linux web hosting powers over 80% of servers worldwide, making it a powerful backbone by offering top-notch reliability, security, and flexibility, which is essential for a robust foundation for websites of all sizes.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Cost-Effectiveness</h3>
                            </div>
                            <p>Unlike other hosting systems, Linux is an open-source OS that is free to use. So, you don’t need to pay for costly licenses, which makes it a cost-effective option</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Stability & Performance</h3>
                            </div>
                            <p>Linux hosting provides stability and high performance through which users can benefit from seamless uptime, strong security, and fast loading speeds, making it ideal for any business.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Compatibility with Popular Tools</h3>
                            </div>
                            <p>Linux web hosting ensures seamless compatibility with popular tools like WordPress, PHP, MySQL, Python, and more. With these versatile integrations, you can empower your website by making development and management smooth and efficient.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Enhanced Security</h3>
                            </div>
                            <p>Security is the top priority for your online business, and Linux hosting stands out here. It has a built-in, advanced security system that limits user access to only what they need. So, it’s harder for unauthorized users to mess around with your data.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Customization Flexibility</h3>
                            </div>
                            <p>With Linux website hosting, you will benefit from customization flexibility, with which you will have full control over the software, settings, and applications you want to install on your server to make your things run smoothly.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Scalability for Growing Businesses</h3>
                            </div>
                            <p>Linux hosting offers you scalable resources to support your growing business, with which you can easily upgrade as per your needs and expand for consistent performance and reliability even during the busiest times.</p>
                        </li>
                        <li>
                            <div class="service-tittle">
                                <h3>Beneficial For SEO</h3>
                            </div>
                            <p>Linux shared hosting boosts SEO by offering faster loading speeds, strong server performance, and improved uptime with Apache and Nginx, which work well for SEO and drives more organic traffic by attracting visitors to your website.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@include('template.'.$themeversion.'.associated_with_section_home')


<div class="vps-features head-tb-p-40" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
               
                
                <h2 class="text_head text-center">Must-Have Linux Hosting Features You Will Admire</h2>
               
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



<section class="wh-just-click head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Just click it and pick it!</h2>
            <p class="text-center">Simplify your website development…Install any of these Amazing Apps with One-Click!</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wh-just-click-img text-center">
                    <img loading="lazy" src="../assets/images/linux-hosting/one_click_.webp" alt="one_click_">
                </div>
            </div>
        </div>
    </div>
</section>

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

@include('template.'.$themeversion.'.testimonial_section')


<section class="cta-main head-tb-p-40">
        <div class="container">
            <div class="cta-box">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-cnt-box">
                        <div class="cta-cnt">
                            <h2 class="text_head">Oh, you’ve come this far!</h2>
                            <p>Clearly, you’re ready for hosting that works as hard as you do.</p>
                        </div>
                        <div class="cta-btn">
                            <a class="cta-start-btn" href="#check_linux_plan">Get Started Now</a>
                        </div>
                    </div>    
                </div>
            </div>
            </div>
        </div>
</section>
@include('template.'.$themeversion.'.more_hosting_features')


@include('template.'.$themeversion.'.faq-section')

@if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
@include('template.'.$themeversion.'.two-hosting-add')
@endif

{{-- @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
@include('template.'.$themeversion.'.two-hosting-add')
@endif --}}

 <script>
document.addEventListener('DOMContentLoaded', function () {
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