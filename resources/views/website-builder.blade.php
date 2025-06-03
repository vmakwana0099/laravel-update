@extends('layouts.app')
@section('content')
{{-- banner --}}

  {{-- VA 15-10-2024 Dynamic rating code--}}
@php
    // Get the serialized string from config
    $serializedString = Config::get('Constant.CUSTOMER_RATING_REVIEW');
    // Unserialize it into an array
    $customerRatingReview = unserialize($serializedString);
@endphp
<section class="web_build_banner">
<div class="review-top-main">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="review-top-bx">Our Customers Love Us
<div class="review-star-icon"><img alt="star-icon-1" src="../assets/images/Homepage/star-icon-1.png"><img alt="star-icon-1" src="../assets/images/Homepage/star-icon-1.png"><img alt="star-icon-1" src="../assets/images/Homepage/star-icon-1.png"><img alt="star-icon-1" src="../assets/images/Homepage/star-icon-1.png"><img alt="star-icon-1" src="../assets/images/Homepage/star-icon-1.png"></div>
4.5 out of 5 based on 1500+ Reviews</div>
</div>
</div>
</div>
</div>
    <div class="web-build-bnnr">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 d-flex align-items-center">
                <div data-aos="fade-left" class="web_build_inner_left">
                    <div class="wbl_heading">
                        <h6>Use Host IT Smart's Site Builder To</h6>
                        <h1>Create your SMART Website
                            <br>in Minutes.</h1>
                    </div>
                    <div class="wbl_content">
                        <p>
                            Creating a professional-looking website with simple,
                            <br> static pages becomes child’s play with our awesome Website Builder
                        </p>
                    </div>
                    <div class="wbl_btn_01">
                        <a href="#threeyear"> <button>Start Building</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 d-flex justify-content-center align-items-center">
                <div class="web_build_inner_right">
                    <img width="800" height="600" src="/assets/images/website_builder/web_build_banner.webp" alt="your business online">
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container">
 <div class="row">
<div class="col-lg-12">
<div class="hm-bnnr-cstmr-rtg">
<div class="cstmr-rtg-main cst-rtg-hostadvice">
<div class="cst-rtg-tittle"><img alt="hostadvice" src="../assets/images/Homepage/hostadvice-logo.png" /></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /></div>

<div class="cst-rtg-data">
<p>{{  number_format($customerRatingReview['RATING']['HOSTADVICE'] ?? 0, 1)}} Ratings</p>
</div>
</div>

<div class="cstmr-rtg-main cst-rtg-trustpilot">
<div class="cst-rtg-tittle"><img alt="trustpilot" src="../assets/images/Homepage/trustpilot-logo.png" /></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /></div>

<div class="cst-rtg-data">
<p>{{  number_format($customerRatingReview['RATING']['TRUSTPILOT'] ?? 0, 1)}} Ratings</p>
</div>
</div>

<div class="cstmr-rtg-main cst-rtg-google">
<div class="cst-rtg-tittle"><img alt="google" src="../assets/images/Homepage/google-logo.png" /></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /></div>

<div class="cst-rtg-data">
<p>{{  number_format($customerRatingReview['RATING']['GOOGLE'] ?? 0, 1)}} Ratings</p>
</div>
</div>
</div>
</div>
</div>
</div> 
</section>
{{-- banner end--}}
{{-- Plans start --}}
<div class="vps_main linux-main head-tb-p-40">
    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
    <div class="vps-plan-main-div web-site-build-container windows-main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="" id="threeyear">
                        <b>
                            <h2 class="text-center text_head" id="landingloc">Start Building Your Website Hassle-Free</h2>
                        </b>
                    </div>
                </div>
                @php if($ProductBanner->id != 8){ @endphp
                {{-- <div class="switch-plan">
                    <div class="month-tab tab-left-save active aos-init" data-aos="fade-left" data-aos-delay="400">Monthly @if(!empty($ProductBanner->varSaveTextMonth))
                        <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextMonth}}</span> @endif </div>
                    <label class="switch aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="100">
                        <input type="checkbox" name="monthly" id="monthly" onclick="calc();">
                        <span class="slider round"></span>
                    </label>
                    <div class="month-tab aos-init" data-aos="fade-right" data-aos-delay="400">Yearly @if(!empty($ProductBanner->varSaveTextYear))
                        <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextYear}}</span> @endif </div>
                </div> --}}
                @php } @endphp
                
               {{--  <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='monthshow'>
                    <ul class="nav nav-pills nav-vps-hosting @if($ProductBanner->id == 7) pb-10 @endif">
                        <li><a data-bs-toggle="pill" href="#vps-plan1" title="1 month" id='onemonths'>1 month @if(!empty($ProductBanner->varOfferTextOneMonth))<span><span class="bg-color">{{$ProductBanner->varOfferTextOneMonth}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan2" title="3 months" id='threemonths'>3 months @if(!empty($ProductBanner->varOfferTextThreeMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeMonth}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan3" title="6 months" id='sixmonths' class="active show">6 months @if(!empty($ProductBanner->varOfferTextSixMonth)) <span><span class="bg-color">{{$ProductBanner->varOfferTextSixMonth}}</span></span>@endif</a></li>
                    </ul>
                </div> --}}
                {{-- <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id='yearshow'>
                    <ul class="nav nav-pills nav-vps-hosting @if($ProductBanner->id == 7) pb-10 @endif">
                        <li><a data-bs-toggle="pill" href="#vps-plan0" title="1 Month" id='onemonth'>1 Month @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan1" title="1 year" id='oneyear'>1 year @if(!empty($ProductBanner->varOfferTextOneYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextOneYear}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan2" title="2 years" id='twoyear'>2 years @if(!empty($ProductBanner->varOfferTextTwoYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextTwoYear}}</span></span>@endif</a></li>
                        <li><a data-bs-toggle="pill" href="#vps-plan3" title="3 years" id='threeyear' class="active show">3 years @if(!empty($ProductBanner->varOfferTextThreeYear)) <span><span class="bg-color">{{$ProductBanner->varOfferTextThreeYear}}</span></span>@endif</a></li>
                    </ul>
                </div> --}}
                <div class="row">
                <div class="col-12">
                    <br />
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
  
              
                 <?php
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
                    ?>
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
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="PerformThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_36_USD) }}</span>/mo*
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
                                 {{-- prof --}}
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
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_36_USD) }}</span>/mo*
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
                                 {{-- ente --}}
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
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_36_INR') }}</span>/mo*
                                                </span>
                                                @php } else { @endphp 
                                                
                                                <span class="shared-main-price-tittle" id="EnterpriseThreeYearWhmcsUSD" >
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_36_USD') }}</span>/mo*
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
            </div>
        </div>
    </div>
</div>
    @endif
    {{-- plan end --}}
    {{-- See More Features code --}}
    <div class="modal fade more_feature" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content more_feature_modal">
                <h2 class="htwo-prime1 plntbl-hdrttl">Host IT Smart Website Builder Features</h2>
                <div class="table-responsive">
                    <div class="more-features-close-icon" data-bs-dismiss="modal">x</div>
                    <table class="w-100">
                        <thead>
                        </thead>
                        <tbody>
                            <tr class="more-features-shadow">
                                <th class=""></th>
                                <th>ESSENTIAL</th>
                                <th>PROFESSIONAL</th>
                                <th>ENTERPRISE</th>
                            </tr>
                            <tr>
                                <td>Host Website </td>
                                <td>5</td>
                                <td>20</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>SSD Disk Space </td>
                                <td>20</td>
                                <td>50</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>Free Domain </td>
                                <td>
                                    <i class="more-features-no-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Free SSL </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Free Backup </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Control Panel</td>
                                <td>cPanel</i>
                                </td>
                                <td>cPanel</td>
                                <td>cPanel</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Website Builder </td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                            </tr>
                            <td>1-Click Installer </td>
                            <td>
                                <i class="more-features-yes-icon"></i>
                            </td>
                            <td>
                                <i class="more-features-yes-icon"></i>
                            </td>
                            <td>
                                <i class="more-features-yes-icon"></i>
                            </td>
                            </tr>
                            <tr>
                                <td>WordPress Optimized </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Bandwidth </td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>Email Accounts </td>
                                <td>10</td>
                                <td>60</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>MySQL DB's </td>
                                <td>10</td>
                                <td>20</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>SSD Disk Space </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Subdomains </td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                            </tr>
                           
                            <tr>
                                <td>FTP users </td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>Supports Node.js</td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                            </tr>
                            <tr>
                                <td id="see_more_features">Supports Python</td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                                <td><i class="more-features-yes-icon"></i></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="more-features-plan-features">
                                <td colspan="5">Server Features</td>
                            </tr>
                            <tr>
                                <td>Apache with LiteSpeed </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>HTTP/2 </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>PHP 5.5, 5.6, 7.0, 7.1, 7.2, 7.3, 7.4, 8.0 ,8.1</td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>MySQL 8.x.x </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>CGI </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Javascript </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Leverage Browser Caching </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Gzip Compression </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>KeepAlive </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="more-features-plan-features">
                                <td colspan="5">cPanel Features</td>
                            </tr>
                            <tr>
                                <td>FTP Account Management </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Virus Scanner </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>IP Deny Manager </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Index Manager </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Leech Protect </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Mailman List Manager </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>MIME Types Manager </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Network Tools </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Redirect Manager </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Change Language </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Multiple PHP Support </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Customizable php.ini </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Cron Jobs </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Simple DNS Zone Editor </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Advanced DNS Zone Editor </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Backup Manager </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Git Version Control </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Resource Usage Monitoring </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>User Manager </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Style and Preferences Management </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Custom Error Pages </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>PHP MyAdmin </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>RAM</td>
                                <td>1</td>
                                <td>1</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Concurrent connections (EP) </td>
                                <td>20</td>
                                <td>40</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>Number of processes (nPROC) </td>
                                <td>40</td>
                                <td>80</td>
                                <td>120</td>
                            </tr>
                            <tr>
                                <td>IO Limit </td>
                                <td>1 MBPS</td>
                                <td>1 MBPS</td>
                                <td>1 MBPS</td>
                            </tr>
                            <tr>
                                <td>File (Inode) Limit </td>
                                <td>75000</td>
                                <td>100000</td>
                                <td>200000</td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="more-features-plan-features">
                                <td colspan="5">Security Solutions</td>
                            </tr>
                            <tr>
                                <td>Network Firewall </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Web Application Firewall </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Brute-force Protection </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Exploits and Malware Protect </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Malware Scan and Reports </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Two-Factor Authentication (2FA </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Account Isolation </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>CageFS Security </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>CloudLinux Servers </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Power / Network / Hardware Redundancy </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="more-features-plan-features">
                                <td colspan="5">Install Popular Software with 1-Click</td>
                            </tr>
                            <tr>
                                <td>WordPress </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Joomla </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>phpBB </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>SMF </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Drupal </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Blogs </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Portals </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Content Management System </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Customer Support </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Discussion Boards </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>E-Commerce </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Site Builders </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="more-features-plan-features">
                                <td colspan="5">Email Features</td>
                            </tr>
                            <tr>
                                <td>Email Accounts </td>
                                <td>10</td>
                                <td>60</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>Email Forwarders </td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>Email Autoresponders </td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>Attachment Limit </td>
                                <td>25 MB</td>
                                <td>25 MB</td>
                                <td>25 MB</td>
                            </tr>
                            <tr>
                                <td>Webmail (Horde & RoundCube) </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>SMTP, POP3, IMAP </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>SpamAssassin </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Mailing Lists </td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                            </tr>
                            <tr>
                                <td>Catch-all Emails </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Email Aliases </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>SPF and DKIM Support </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Domain Keys </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>BoxTrapper </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Individual Mailbox Storage </td>
                                <td>500 MB</td>
                                <td>1 GB</td>
                                <td>5 GB</td>
                            </tr>
                            <tr>
                                <td>Overall Mailbox Storage </td>
                                <td>2 GB</td>
                                <td>10 GB</td>
                                <td>50 GB</td>
                            </tr>
                            <tr>
                                <td>Email Sends Per Hour </td>
                                <td>25</td>
                                <td>25</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>CSV Import (Email & Forwarders) </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Mobile Compatibility </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Email Calendar </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Webmail in Gmail </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Outlook / Thunderbird / Mac Mail </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                                <td>
                                    <i class="more-features-yes-icon"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- See More Features code end --}}
    {{-- contains start--}}
    <section class="way-build-web-main">
        <h2>Quick Way To Build a Website</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                    <div class="wbw-step-01-main wbw-sep-main">
                        <div class="wbw-step-01">
                            <h3>Coding Skills - You Don&#39;t Need Them</h3>
                            <p>Our Website Builder is created for smart people. You don&rsquo;t need to be a skilled coder to create
                                your website. Drag the elements from the left panel and drop them at the right place, and you
                                are on your path to creating a simple yet awesome website.</p>
                        </div>
                        <div class="wbw-step-01-image">
                            <img alt="don't need coding skills" src="/assets/images/website_builder/wbw-s01.webp" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="wbw-step-02-main  wbw-sep-main">
                        <div class="wbw-step-02-image">
                            <img alt="one stop solution" src="/assets/images/website_builder/wbw-s02.webp" />
                        </div>
                        <div class="wbw-step-02">
                            <h3>One Stop Solution</h3>
                            <p>Domain, Hosting, Website and Security, Find a Complete Solution in One Place.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                    <div class="wbw-step-03-main  wbw-sep-main">
                        <div class="wbw-step-03">
                            <h3>Let&#39;s Build Your Ecommerce Store From Scratch</h3>
                            <p>Ecommerce website is a different story. Bring your ecommerce store online, manage your inventory,
                                handle abandoned carts and integrate payment gateways with our user-friendly and intuitive Website
                                Builder.</p>
                        </div>
                        <div class="wbw-step-03-image">
                            <img alt="eCommerce store from scratch " src="/assets/images/website_builder/wbw-s03.webp" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="wbw-step-04-main  wbw-sep-main">
                        <div class="wbw-step-04-image">
                            <img alt="come online almost instantly" src="/assets/images/website_builder/wbw-s04.webp" />
                        </div>
                        <div class="wbw-step-04">
                            <h3>Come Online Almost Instantly</h3>
                            <p>Smart and efficient Website Builder from Host IT Smart places all the components to get your website
                                up and running instantly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="web-online-steps">
        <h2>With Our Website Builder
            <br /> Take Your Website Online In 1-2-3 Steps
        </h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="web-on-s01">
                        <div class="steps-icon">
                            <img alt="pick your best" src="/assets/images/website_builder/pick-best.webp" />
                        </div>
                        <h4>Pick Your Best</h4>
                        <p>Select from our collection of classic responsive themes to match your business. Customize it to match
                            your taste.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="web-on-s02">
                        <div class="steps-icon">
                            <img alt="plan modify" src="/assets/images/website_builder/plan-modify.webp" />
                        </div>
                        <h4>Plan &amp; Modify</h4>
                        <p>Add/Edit the webpage layout. Use our smart widgets. Insert customized content, images, and videos.
                            Place correct banners and sliders to add value to your website.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="web-on-s03">
                        <div class="steps-icon">
                            <img alt="grand launch" src="/assets/images/website_builder/grand-launch.webp" />
                        </div>
                        <h4>Grand Launch</h4>
                        <p>Preview your website. Buy your unique Domain, select the best hosting plan, add a security certificate
                            and take your website online.</p>
                    </div>
                </div>
            </div>
        </div>
        <h3>Begin Your Online journey
            <br /> Build Your
            <span>BRAND</span>.
        </h3>
    </section>
    <section class="themes_sec text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sc_para">
                        <h3>Pick up From Our Marvelous Collection of Customizable Themes.</h3>
                        <p>Look no further as we bring you our choicest collection of 800+ responsive and customizable themes.
                            Choose the one that tunes well with your business type. Our huge collection can cater to websites
                            created for blogs, e-commerce stores, retail outlets, educational institutions, creative portfolios,
                            etc.</p>
                    </div>
                    <h3>WE can&#39;t wait to see your business succeed.</h3>
                </div>
                <div class="col-md-4">
                    <a href="https://sitepad.com/themes/" target="_blank">
                        <img alt="theme-01" src="/assets/images/website_builder/theme-01.webp" /> </a>
                </div>
                <div class="col-md-4">
                    <a href="https://sitepad.com/themes/" target="_blank">
                        <img alt="theme-02" src="/assets/images/website_builder/theme-02.webp" /> </a>
                </div>
                <div class="col-md-4">
                    <a href="https://sitepad.com/themes/" target="_blank">
                        <img alt="theme-03" src="/assets/images/website_builder/theme-03.webp" /> </a>
                </div>
                <div class="col-md-4">
                    <a href="https://sitepad.com/themes/" target="_blank">
                        <img alt="theme-04" src="/assets/images/website_builder/theme-04.webp" /> </a>
                </div>
                <div class="col-md-4">
                    <a href="https://sitepad.com/themes/" target="_blank">
                        <img alt="theme-05" src="/assets/images/website_builder/theme-05.webp" /> </a>
                </div>
                <div class="col-md-4">
                    <a href="https://sitepad.com/themes/" target="_blank">
                        <img alt="theme-06" src="/assets/images/website_builder/theme-06.webp" /> </a>
                </div>
                <div class="col-md-12 text-center">
                    <div class="theme-btn-01">
                        <a href="https://sitepad.com/themes/" target="_blank"> <button>View More Themes</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="web-build-features">
        <h2 class="text_head text-center">Exclusive Features</h2>
        <div class="container">
            <div class="web_build_content">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="pick customize & publish" src="/assets/images/website_builder/wbf_pick_01.webp" />
                            <h4>Pick, Customize &amp; Publish</h4>
                            <p>Our Website Builder doesn&#39;t need you to have any HTML or Coding expertise. You can pick up
                                a theme, drag and drop the widgets, customize the overall website, preview it and publish
                                it in one click.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="wide range of categories" src="/assets/images/website_builder/wbf_wide_02.webp" />
                            <h4>Wide Range of Categories</h4>
                            <p>Our Website Builder caters to different types of business website. We have themes and widgets
                                for your Blogs, Retail Stores, Ecommerce Websites, Restaurants, Travel, and Vacation Homes,
                                and not all. You can have multiple pages and menus of your choice.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="responsive & mobile device friendly" src="/assets/images/website_builder/wbf_responsive_03.webp" />
                            <h4>Responsive &amp; Mobile Device Friendly</h4>
                            <p>With our Website Builder, Create responsive and mobile-friendly websites. Such websites look
                                great on all screen sizes. Ranging from mobile to computer desktops, enjoy SEO-frindly websites
                                with jaw-dropping features.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="eCommerce built-In" src="/assets/images/website_builder/wbf_ecom_04.webp" />
                            <h4>Ecommerce Built-In</h4>
                            <p>Ecommerce website creation requires a different set of tools. Our Website Builder has it all.
                                Create product pages based on their categories, set up inventory management modules, and
                                integrate payment gateways without specific technical skills. You get to have a simple yet
                                amazingly beautiful ecommerce website.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="easily customizable" src="/assets/images/website_builder/wbf_easy_05.webp" />
                            <h4>Easily Customizable</h4>
                            <p>With Host IT Smart’s Website Builder, create and customize your website just the way you want, from themes and pages to widgets and menus. Build multiple pages, organize subpages, and design responsive, trendy websites that turn visitors into loyal customers. Craft your online presence with creativity and purpose!</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="dynamic editor" src="/assets/images/website_builder/wbf_dynamic_06.webp" />
                            <h4>Dynamic Editor</h4>
                            <p>Why limit your creative sense when you have well equipped built-in Template Editor, multiple
                                customizable themes, and an elite collection of menu styles and font types to choose from?
                                Play your game your way.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="over 800+ color themes for templates" src="/assets/images/website_builder/wbf_over_07.webp" />
                            <h4>Over 800+ Color Themes for Templates</h4>
                            <p>Choose from over 800+ color themes for your website template. Customize it to match your needs
                                while you build your website from scratch.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="40+ widgets" src="/assets/images/website_builder/wbf_widgets_08.webp" />
                            <h4>40+ Widgets</h4>
                            <p>Whoever said you need brilliant coding skills to develop a personal website? Simply drag-drop
                                the widgets, customize them and place them where they belong on your website.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="850+ professional fonts" src="/assets/images/website_builder/wbf_xyz_09.webp" />
                            <h4>850+ Professional Fonts</h4>
                            <p>Similar to creative designs, designer fonts add value to your website. Our Website Builder comes
                                with a collection of 850+ fonts to match your need and taste. Unleash your creative attitude.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="SEO marketing features" src="/assets/images/website_builder/wbf_seo_10.webp" />
                            <h4>SEO Marketing Features</h4>
                            <p>Boost each web page with tools from our Marketing arsenal. You are free to add Meta Titles and
                                Descriptions to each page. Add keyword-rich content to make your website a Traffic Magnet.
                                Our Website Builder is here to improve the site&#39;s ranking on Google, Bing, and Yahoo.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="control panel integration" src="/assets/images/website_builder/wbf_controlp_11.webp" />
                            <h4>Control Panel Integration</h4>
                            <p>We offer integrated cPanel with our Website Builder. cPanel is our power-packed tool to control
                                your website. Manage every page, each module, and the complete workflow of your website.
                                Get the best insights and performance statistics with our cPanel.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="wbf_feature_box">
                            <img alt="free SSL certificate" src="/assets/images/website_builder/wbf_free_12.webp" />
                            <h4>Free Let’s encrypt SSL Certificate</h4>
                            <p>Hackers won&#39;t spare you for your negligence, and neither will you get a second chance. Say
                                YES to SSL Certificate. Secure your website with our SSL certificate and protect your data
                                with end-to-end encryption.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="why_hits_section">
        <h2>Why Build Website With Host IT Smart</h2>
        <div class="why_hits_web_build">
            <div class="whwb_boxes">
                <div class="whwb_img">
                    <img alt="world-class infrastructure" src="/assets/images/website_builder/why_hits_1.webp" />
                </div>
                <div class="whwb-title">World-class infrastructure</div>
            </div>
            <div class="whwb_boxes">
                <div class="whwb_img">
                    <img alt="99.9% uptime" src="/assets/images/website_builder/why_hits_2.webp" />
                </div>
                <div class="whwb-title">99.9% Uptime</div>
            </div>
            <div class="whwb_boxes">
                <div class="whwb_img">
                    <img alt="easy-to-Use" src="/assets/images/website_builder/why_hits_3.webp" />
                </div>
                <div class="whwb-title">Easy-to-Use</div>
            </div>
            <div class="whwb_boxes">
                <div class="whwb_img">
                    <img alt="30-day money-back guarantee" src="/assets/images/website_builder/why_hits_4.webp" />
                </div>
                <div class="whwb-title">30-Day Money-Back Guarantee</div>
            </div>
            <div class="whwb_boxes">
                <div class="whwb_img">
                    <img alt="complete control" src="/assets/images/website_builder/why_hits_5.webp" />
                </div>
                <div class="whwb-title">Complete Control</div>
            </div>
        </div>
    </section>
    <section class="web_build_knock_cta">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <div class="wbkc_left_part">
                        <span style="font-size: 44px;">Knock! Knock!</span>
                        <p>Design your stupendous website
                            <br /> With our Free
                            <span>Website Builder</span>
                            <br /> Today.
                        </p>
                        <a href="#threeyear"> <button>GET STARTED FOR FREE</button></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="wbks_right_part">
                        <img alt="Knock! knock!" src="/assets/images/website_builder/knock-01.webp" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- contains end--}}
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
        <div class="product_offers">
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
        </div>
    </div>
    {{-- FAQs code end --}}
    <script type="text/javascript">
    $("#monthly").prop('checked', false);
    setTimeout(function() {
        $("#monthly").click();
        $("#threeyear").click();
    }, 1000); //set 3 year pricing

    $("#form_hosting_158_1,#form_hosting_159_2,#form_hosting_160_3,#form_hosting_158_4,#form_hosting_159_5,#form_hosting_160_6,#form_hosting_158_7,#form_hosting_159_8,#form_hosting_160_9,#form_hosting_158_10,#form_hosting_159_11,#form_hosting_160_12,#form_hosting_158_13,#form_hosting_159_14,#form_hosting_160_15,#form_hosting_158_16,#form_hosting_159_17,#form_hosting_160_18").find('.btn-primary')
        .css({ "background": "gray" }).text("Out of Stock").removeAttr("onclick").prop('title', 'Out of Stock')
        .click(function() { alert("Product is Out of Stock!!"); return false; });
    </script>
    <script>
$(document).ready(function(){$('#exampleModal').on('shown.bs.modal',function(){setTimeout(function(){var targetSection=document.getElementById('see_more_features');if(targetSection){targetSection.scrollIntoView({behavior:'smooth',block:'start'})}},300)})})
</script>
    @endsection