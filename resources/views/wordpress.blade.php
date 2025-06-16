
@extends('layouts.app')
@section('content')
 {{-- {{ dd(get_defined_vars()) }} --}} 


<?php 
$theme = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
 
<!-- @include('template.banner') -->
@include('template.'.$theme.'.banner')

<?php
// echo '<pre>'; print_r($ProductsPackageData); exit;

?>

 <div class="web-pln-box head-tb-p-40" id="pricing">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Perfect & Fastest WordPress Hosting Plans</h2>
                <p class="text-center">Go Local or Global with Cheap WordPress Hosting in India & Canada!</p>
            </div>
            <div class="row justify-content-center">


                @php if($ProductBanner->id == '10'){
                $mainclassssl = 'ssl-small';
                }else{
                $mainclassssl = '';
                } @endphp

                @php
                if ($ProductBanner->id == 1 || $ProductBanner->id == 4 || $ProductBanner->id == 6) {
                $plan_row = '';
                $box_plan_class = 'col-lg-3 col-md-6 col-sm-12';

                $_BASIC_PRICE_12_INR='_STARTER_PRICE_12_INR';
                $_BASIC_PRICE_36_INR='_BASIC_PRICE_36_INR';
                $_ESSENTIAL_PRICE_36_INR='_ESSENTIAL_PRICE_36_INR';
                $_PROFESSIONAL_PRICE_36_INR='_PROFESSIONAL_PRICE_36_INR';



                

                } else {
                $plan_row = 'justify-content-center';
                $box_plan_class = 'col-sm-6 col-md-6 col-lg-3 col-xs-12';

                
                }

                @endphp

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

                                <div class="{{$box_plan_class}}" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                                    <div class="shared-plan-box">
                                        <div class="shared_plan_price">
                                            <div class="shared-plan-head">{{$ProductsPackageData[0]->varTitle}}
                                                {{-- <div class="plan-icon-right"></div> --}}
                                            </div>
                                            <div class="shared-plan-cut-price">

                                                   {{-- @if(isset($ProductsPackageData[0]->productpricing['monthly']) && !empty($ProductsPackageData[0]->productpricing['monthly'])) --}}
                                                    <span class="shared-cut-price" id="BasicThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[0]->intOldPriceOneYearINR}}</span>
                                                    {{-- @endif --}}
                                                
                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[0]->varAdditionalOffer));
                                                @endphp


                                                <span class="shared-offer-discount" id="BasicThreeYearOffer">
                                                    @if (count($blackfridayOffArr) > 1)
                                                    {{$blackfridayOffArr[4]}}% OFF
                                                    @else
                                                    ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                    @endif


                                                </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">

{{-- @if(isset($ProductsPackageData[0]->productpricing['triennially']) && !empty($ProductsPackageData[0]->productpricing['triennially'])) --}}
                                                <span class="shared-main-price-tittle" id="StarterThreeYearWhmcsINR">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BASIC_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                                {{--{{ $ProductsPackageData[0]->productpricing['triennially'] }}--}}
                                                {{-- @endif --}}
                                                
                                            </div>

                                            <div class="shared-plan-btm" id="StarterThreeYearButtonText">
                                                {!! $StarterThreeYearButtonText !!}
                                                <!-- @if(isset($ProductsPackageData[0]->ButtonTexttriennially) && !empty($ProductsPackageData[0]->ButtonTexttriennially))
                                                    {!!$ProductsPackageData[0]->ButtonTexttriennially!!}
                                                @endif   -->                                          </div>
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip">
                                                @foreach($SpecificationData as $Specification)
                                                
                                                    @if($ProductsPackageData[0]->varTitle == 'BASIC' && strtolower(trim($Specification)) == 'free domain')
                                                    <li class="cross_free_domain"><span>{{$Specification}}</span></li>
                                                    @elseif(strtolower(trim($Specification)) == 'free ssl' || strtolower(trim($Specification)) == 'free ssl certificate')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
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
                                                        <div class="free_domain_black free_domain">{{$Specification}}
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
                                                            <span class="domain_tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x
                                                            </span>

                                                        </div>
                                                    </li>

                                                    @elseif(strtolower(trim($Specification)) == "supports python")
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13
                                                            </span>

                                                        </div>
                                                    </li>

                                                    @elseif(strtolower(trim($Specification)) == "10 databases")
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                            </span>

                                                        </div>
                                                    </li>
                                                    @else
                                                    <li><span>{{$Specification}}</span></li>
                                                    @endif
                                                @endforeach
                                            </ul>


                                            <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>

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
                                @php
                                $class = ''; $class1 = '';
                                if($ProductsPackageData[2]->chrDisplayontop == 'Y'){
                                $class = 'recommanded-main';
                                $class1 = 'recommanded-main-icon';
                                } @endphp
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
                                                {{-- @if(isset($ProductsPackageData[1]->productpricing['monthly']) && !empty($ProductsPackageData[1]->productpricing['monthly'])) --}}
                                                    <span class="shared-cut-price" id="PerformThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[1]->intOldPriceOneYearINR}}</span>
                                                   {{-- @endif --}}
                                                   {{--{{ $ProductsPackageData[1]->productpricing['monthly'] }}--}}

                                                @php
                                                $blackfridayOffArr = (explode(",",$ProductsPackageData[1]->varAdditionalOffer));
                                                @endphp


                                                <span class="shared-offer-discount" id="EssentialThreeYearOffer">
                                                    @if (count($blackfridayOffArr) > 1)
                                                    {{$blackfridayOffArr[4]}}% OFF
                                                    @else
                                                    ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                    @endif


                                                </span>
                                            </div>
                                        </div>
                                        <div class="shared-price-padding">
                                            <div class="shared-main-price clearfix">

                                                {{-- @if(isset($ProductsPackageData[1]->productpricing['triennially']) && !empty($ProductsPackageData[1]->productpricing['triennially'])) --}}
                                                <span class="shared-main-price-tittle" id="PerformThreeYearWhmcsINR">
                                                    <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_ESSENTIAL_PRICE_36_INR) }}</span>/mo*
                                                </span>
                                              {{-- @endif --}}
                                              {{-- {{ $ProductsPackageData[1]->productpricing['triennially'] }} --}}

                                            </div>
                                           
                                            <div class="shared-plan-btm" id="PerformanceThreeYearButtonText">
                                                {!! $PerformanceThreeYearButtonText !!}
                                                
                                                
                                            </div>
                                             <!-- @if(isset($ProductsPackageData[1]->ButtonTexttriennially) && !empty($ProductsPackageData[1]->ButtonTexttriennially)) --><!-- {!!$ProductsPackageData[1]->ButtonTexttriennially!!} -->
                                            <!-- @endif -->
                                            @php $SpecificationData = explode("\n",$ProductsPackageData[1]->txtSpecification); @endphp
                                            <ul class="shared-plan-features shared-plan-tooltip">
                                                @foreach($SpecificationData as $Specification)

                                                   
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
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
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
                                                <li>
                                                    <div class="free_domain free_domain_black">{{$Specification}}
                                                        <span class="domain_tooltip">Get the benefit of the latest MySQL 8.x.x Version for higher efficiency.
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "10 mssql/mysql space")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
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
                                                        <span class="domain_tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports python")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13

                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "50 databases")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                        </span>

                                                    </div>
                                                </li>
                                                
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif
                                      
                                        @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>

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

                                        <div class="shared-plan-head">{{$ProductsPackageData[2]->varTitle}}</div>
                                        <div class="{{$class1}}"></div>
                                        <div class="shared-plan-cut-price">

                                           {{-- @if(isset($ProductsPackageData[2]->productpricing['monthly']) && !empty($ProductsPackageData[2]->productpricing['monthly'])) --}}
                                            <span class="shared-cut-price" id="BusinessThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[2]->intOldPriceOneYearINR}}</span>
                                            {{-- @endif --}}
                                            {{--{{ $ProductsPackageData[2]->productpricing['monthly'] }} --}}

                                            @php
                                            $blackfridayOffArr = (explode(",",$ProductsPackageData[2]->varAdditionalOffer));
                                            @endphp


                                            <span class="shared-offer-discount" id="ProfessionalThreeYearOffer">
                                                @if (count($blackfridayOffArr) > 1)
                                                {{$blackfridayOffArr[4]}}% OFF
                                                @else
                                                ({{$ProductsPackageData[4]->varAdditionalOffer}})
                                                @endif


                                            </span>
                                        </div>
                                        {{-- <div class="plan-icon-right"></div> --}}

                                    </div>
                                    <div class="shared-price-padding">
                                        <div class="shared-main-price clearfix">
                                            
                                            {{-- @if(isset($ProductsPackageData[2]->productpricing['triennially']) && !empty($ProductsPackageData[2]->productpricing['triennially'])) --}}
                                            <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsINR">
                                                <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PROFESSIONAL_PRICE_36_INR) }}</span>/mo*
                                            </span>
                                            {{-- @endif --}}
                                            {{-- {{ $ProductsPackageData[2]->productpricing['triennially'] }} --}}


                                        </div>
                                        <!-- @if(isset($ProductsPackageData[2]->ButtonTexttriennially) && !empty($ProductsPackageData[2]->ButtonTexttriennially)) -->
                                        <!-- {!!$ProductsPackageData[2]->ButtonTexttriennially!!} -->  <!-- @endif --> 
                                        <div class="shared-plan-btm" id="BusinessThreeYearButtonText">
                                            {!! $BusinessThreeYearButtonText !!}                                                                                     
                                        </div>
                                        
                                        @php $SpecificationData = explode("\n",$ProductsPackageData[2]->txtSpecification); @endphp
                                        <ul class="shared-plan-features shared-plan-tooltip">
                                            @foreach($SpecificationData as $Specification)
                                                @if(strtolower(trim($Specification)) == 'free domain')
                                                <li>
                                                    
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">
                                                            Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                            <span class="price_domain">Your Domain Renewal Charges:<br>{!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
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
                                                @elseif(strtolower(trim($Specification)) == '50,000 visits monthly')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
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
                                                    <div class="free_domain">{{$Specification}}
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
                                                        <span class="domain_tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports python")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13

                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "250 databases")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                        </span>

                                                    </div>
                                                </li>
                                                
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif

                                            @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>

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
                                            <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce bounce"></i></a>
                                        </div>
                                        @php } @endphp
                                    </div>
                                </div>
                            </div>
                            {{-- ente --}}
                            <div class="{{$box_plan_class}}">
                                @php $class = ''; $class1 = '';
                                if($ProductsPackageData[3]->chrDisplayontop == 'Y'){
                                $class = 'recommanded-main';
                                $class1 = 'recommanded-main-icon';
                                } @endphp
                                <div class="shared-plan-box {{$class}} vps-plan-recommanded-main">
                                    <div class="shared_plan_price">

                                        <div class="shared-plan-head">{{$ProductsPackageData[3]->varTitle}}</div>
                                        <div class="{{$class1}}"></div>
                                        <div class="shared-plan-cut-price">

                                           {{-- @if(isset($ProductsPackageData[3]->productpricing['monthly']) && !empty($ProductsPackageData[3]->productpricing['monthly'])) --}}
                                            <span class="shared-cut-price" id="BusinessThreeYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}{{$ProductsPackageData[3]->intOldPriceOneYearINR}}</span>
                                           {{-- @endif --}}
                                           {{--{{ $ProductsPackageData[3]->productpricing['monthly'] }}--}}

                                            @php
                                            $blackfridayOffArr = (explode(",",$ProductsPackageData[3]->varAdditionalOffer));
                                            @endphp


                                            <span class="shared-offer-discount" id="ProfessionalThreeYearOffer">
                                                @if (count($blackfridayOffArr) > 1)
                                                {{$blackfridayOffArr[4]}}% OFF
                                                @else
                                                ({{$ProductsPackageData[3]->varAdditionalOffer}})
                                                @endif


                                            </span>
                                        </div>
                                        {{-- <div class="plan-icon-right"></div> --}}

                                    </div>
                                    <div class="shared-price-padding">
                                        <div class="shared-main-price clearfix">
                                            
                                            {{-- @if(isset($ProductsPackageData[3]->productpricing['triennially']) && !empty($ProductsPackageData[3]->productpricing['triennially'])) --}}
                                            <span class="shared-main-price-tittle" id="BusinessThreeYearWhmcsINR">
                                                <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.'_ENTERPRISE_PRICE_36_INR') }}</span>/mo*
                                            </span>
                                            {{-- @endif --}}
                                            {{--{{ $ProductsPackageData[3]->productpricing['triennially'] }}--}}

                                        </div>
                                        <!-- @if(isset($ProductsPackageData[3]->ButtonTexttriennially) && !empty($ProductsPackageData[3]->ButtonTexttriennially)) -->                                       
                                        <!-- {!!$ProductsPackageData[3]->ButtonTexttriennially!!} --><!-- @endif -->
                                        <div class="shared-plan-btm" id="BusinessThreeYearButtonText">
                                            {!! $EnterpriseThreeYearButtonText !!}                                                                                    
                                        </div>
                                        @php $SpecificationData = explode("\n",$ProductsPackageData[3]->txtSpecification); @endphp
                                        <ul class="shared-plan-features shared-plan-tooltip">
                                            @foreach($SpecificationData as $Specification)
                                                @if(strtolower(trim($Specification)) == 'free domain')
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">
                                                            Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.
                                                            <span class="price_domain">Your Domain Renewal Charges:<br>{!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr*
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
                                                @elseif(strtolower(trim($Specification)) == '1,00,000 visits monthly')
                                                    <li>
                                                        <div class="free_domain">{{$Specification}}
                                                            <span class="domain_tooltip">The visitor capacity mentioned for each shared hosting plan is an approximate estimate. The actual number may vary based on factors like website optimization, caching, content type, traffic spikes, and resource usage. We recommend monitoring your site's resource consumption and upgrading when needed for best performance.
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
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                            @if($ProductBanner->id == 3)
                                                            <span class="price_domain">Note: Per SQL Databases Size Limit = 1GB</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports node.js")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">12.x, 14.x, 16.x, 18.x, 19.x, 20.x, 22.x
                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "supports python")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">3.7, 3.8, 3.9, 3.10, 3.11, 3.12, 3.13

                                                        </span>
                                                    </div>
                                                </li>
                                                @elseif(strtolower(trim($Specification)) == "500 databases")
                                                <li>
                                                    <div class="free_domain">{{$Specification}}
                                                        <span class="domain_tooltip">You will be provided with Mariadb 10.x Version for faster performance.
                                                        </span>

                                                    </div>
                                                </li>
                                               
                                                @else
                                                <li><span>{{$Specification}}</span></li>
                                                @endif
                                            @endforeach
                                        </ul>


                                        <a href="" title="See More Features" class="shared_plan_more_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">See More Features</a>

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
                                            <a onclick="VPSFeatures('BusinessOneMonthFeatures')" href="javascript:;" data-scroll-to="#BusinessOneMonthFeatures">View Features <i class="fa fa-angle-down bounce bounce"></i></a>
                                        </div>
                                        @php } @endphp
                                    </div>
                                </div>
                            </div>
                         
</div>
</div>
</div>
 <!--See More Features section start-->
 @include('template.'.$theme.'.more_hosting_features')
 <!--See More Features section end-->
 <div class="dy-money-back-grnt head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dy-money-back-grnt-box text-center">
                    <h2>Have Big Traffic or Bigger Ambitions?</h2>
                    <p>VPS Hosting has your back to power it like a pro!</p>
                    <a href="{{url('/servers/vps-hosting-india')}}" title="Discover Google Workspace">Get Indian VPS Hosting</a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="luanchpad-wp-web head-tb-p-40">
    <div class="container-fluid">
        <div class="section-heading">
            <h2 class="text_head text-center">
                From Blank to Blast:<br>5-Step Launchpad For WordPress Website
            </h2>
            <p class="text-center">With our user-friendly & cheap WordPress hosting, create and launch your Website effortlessly in just five simple steps & bring your online vision to life.</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="lnch-box-main">
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>01</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/domain_icon.svg" alt="domain_icon">
                            <div class="launchpad-wp-tittle">Register Your Domain</div>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                            <img src="../assets/img/wordpress/domain_icon_lgt.svg" alt="domain_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">01</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Register Your Domain</span>
                            <p>The first step in launching your WordPress website is registering a perfect domain name that becomes your identity. It will be your website's address, which should be unique, easy to remember, and fully relevant to your website's topic.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">                        
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>02</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/hosting_plan_icon.svg" alt="hosting_plan_icon">
                            <div class="launchpad-wp-tittle">Choose Your Hosting Plan</div>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                                <img src="../assets/img/wordpress/hosting_plan_icon_lgt.svg" alt="hosting_plan_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">02</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Choose Your Hosting Plan</span>
                            <p>Once you have registered your domain name, the next step is to choose your hosting plan. Host IT Smart offers you the fastest WordPress hosting plans in India that help bring your vision to life by offering optimal performance and scalability.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>03</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/wordpress_icon.svg" alt="wordpress_icon">
                            {{-- <div class="launchpad-wp-tittle" style="">Install WordPress</div> --}}
                            <div class="launchpad-wp-tittle">Install <br>WordPress</div>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                                <img src="../assets/img/wordpress/wordpress_icon_lgt.svg" alt="wordpress_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">03</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Install WordPress</span>
                            <p>We made your WordPress platform installation easy! Our user-friendly 1-click installer in the panel lets you set up your WordPress website in just a few minutes, and your website will be ready to go live & rule the internet.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>04</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/theme_icon.svg" alt="theme_icon">
                            <div class="launchpad-wp-tittle">Pick a <br>Theme</div>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                                <img src="../assets/img/wordpress/theme_icon_lgt.svg" alt="theme_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">04</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Pick a Theme</span>
                            <p>We made your WordPress platform installation easy! Our user-friendly 1-click installer in the panel lets you set up your WordPress website in just a few minutes, and your website will be ready to go live & rule the internet.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                    <div class="launchpad-wp-box">
                    <div class="launchpad-wp-box-inner">
                    <div class="launchpad-wp-box-front">
                        <div class="lnch-top-frnt-hd">
                            <p>STEP <span>05</span></p>
                        </div>
                        <div class="lnch-frnt-cnt">
                            <img src="../assets/img/wordpress/publish_icon.svg" alt="publish_icon">
                            <div class="launchpad-wp-tittle">Start <br>Publishing</div>
                        </div>
                    </div>
                    <div class="launchpad-wp-box-back">
                        <div class="lnch-wp-box-hd">
                            <div class="lnch-wp-box-1">
                                <img src="../assets/img/wordpress/publish_icon_lgt.svg" alt="publish_icon_lgt">
                            </div>
                            <div class="lnch-wp-box-2">
                                <div class="lnch-box-step">STEP</div>
                                <div class="lnch-box-num">05</div>
                            </div>
                        </div>
                        <div class="lnch-box-cnt">
                            <span>Start Publishing</span>
                            <p>Once WordPress has been installed and a theme has been chosen, it’s time to start creating your site content with WordPress's easy-to-use editor for writing posts, adding images, and formatting your content that provides value to your audience.</p>
                        </div>
                    </div>
                    <div class="lnch_btm_icon"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="optmz-wp head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">
            Ensure Your SEO Success with Optimized WordPress Hosting
            </h2>
            <p>Our best & cheap WordPress hosting plans are designed to enhance your website's speed, security, and performance, delivering improved search engine rankings to attract and engage more visitors.</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="optmz-wp-box optmz-fast">
                    <div class="optmz-box-icon">
                        <img src="../assets/img/wordpress/faster_load_icon.svg" alt="faster_load_icon">
                    </div>
                    <div class="optmz-box-cnt">
                        <h3>Faster Load Times</h3>
                        <p>Search engines love websites with fast load times. Host IT Smart offers the Fastest WordPress hosting plans in India & Canada to help your website load quickly & direct more visitors for enhanced SEO performance!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="optmz-wp-box optmz-uptime">
                    <div class="optmz-box-icon">
                        <img src="../assets/img/wordpress/uptime_icon.svg" alt="uptime_icon">
                    </div>
                    <div class="optmz-box-cnt">
                        <h3>Guaranteed Uptime and Reliability</h3>
                        <p>Search engines hate websites that are frequently down. With our amazing WordPress hosting in India & Canada, we offer a 99.9% uptime guarantee that ensures your website is always available to visitors, which helps build trust and elevates your brand image!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="optmz-wp-box optmz-server">
                    <div class="optmz-box-icon">
                        <img src="../assets/img/wordpress/server_location_icon.svg" alt="server_location_icon">
                    </div>
                    <div class="optmz-box-cnt">
                        <h3>Optimized Server Location</h3>
                        <p>The physical location of your server is a crucial factor that impacts your website’s loading speed for visitors in different regions. Therefore, we have placed our WordPress hosting servers in strategic data centers like India & Canada to help your website load quickly and enhance your SEO!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="optmz-wp-box optmz-ssl">
                    <div class="optmz-box-icon">
                        <img src="../assets/img/wordpress/SSL_icon.svg" alt="SSL_icon">
                    </div>
                    <div class="optmz-box-cnt">
                        <h3>Free SSL Certificates for HTTPS</h3>
                        <p>Search engines take security seriously & that’s why they consider HTTPS a ranking factor. Our cheap WordPress hosting plans include free SSL certificates that enable HTTPS on your site, improve your SEO performance & offer secure browsing for your visitors.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="web-sec-wp head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">
            How We Ensure Your Website's Security?
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="web-sec-top">
                    <div class="web-sec-top-1">
                        <img src="../assets/img/wordpress/agile_securities.webp" alt="agile_securities">
                    </div>
                    <div class="web-sec-top-2">
                        <h3>Agile security scans</h3>
                        <p>We believe security is not a one-time task!</p>
                        <p>It’s a continuous process & that’s why we use Agile security scanning techniques to stay one step ahead of threats.</p>
                        <p>What does that mean for your website? This means your WordPress hosting is constantly monitored for suspicious activity, as if a virtual security guard watches it 24/7.</p>
                        <p><b>Our advanced security tools scan your website for:</b>
                            <ul>
                                <li>Malware infections that could harm your site or your visitors</li>
                                <li>Hacking attempts that try to break into your system</li>
                                <li>SQL injection attacks and other code-level threats that could steal data or bring your site down</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="web-sec-cnt">
                    <div class="web-sec-cnt-img">
                        <img src="../assets/img/wordpress/DDOS_protection.webp" alt="DDOS_protection">
                    </div>
                    <div class="web-sec-dt">
                        <h3>DDoS Protection</h3>
                        <p>Imagine your website as a store, and suddenly, one day, a massive crowd shows up not to shop but just to block the entrance! That’s what a DDoS attack does. It floods your website with fake traffic.</p>
                        <p><b>But don’t worry—we have got you covered!</b></p>
                        <p>Our cheapest WordPress hosting has built-in DDoS protection that watches traffic 24/7 with advanced technologies & monitoring systems and blocks suspicious activity before it becomes problematic.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="web-sec-cnt">
                    <div class="web-sec-cnt-img">
                        <img src="../assets/img/wordpress/web_app_firewall.webp" alt="web_app_firewall">
                    </div>
                    <div class="web-sec-dt">
                        <h3>Advanced Web Application Firewall</h3>
                        <p>With WordPress hosting, we have got your back with an Advanced Web Application Firewall. Whenever someone tries to visit your site, it checks their request and blocks them immediately if it looks suspicious. It protects your website from common online threats like unauthorized access, data breaches, malware injections & other shady activities.</p>
                        <p>And the best part? Our WAF keeps learning and updating itself to tackle the latest threats. So, even while you are sleeping, your website is safe and sound!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wp-ecommerce head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">Sell Smarter With Our WordPress Hosting for eCommerce.</h2>
            <p>Sell smarter with our eCommerce-optimized Fastest WordPress hosting. It ensures a smooth online shopping experience with advanced security features.</p>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="wp-ecom-img">
                    <img src="../assets/img/wordpress/wordpress_hosting_ecomm.webp" alt="wordpress_hosting_ecomm">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wp-ecom-cnt">
                    <div class="wp-ecom-box">
                        <h3>WooCommerce Optimized</h3>
                        <p>We have tailored our WordPress hosting plans in India & Canada for WooCommerce, the leading eCommerce plugin. We provide the necessary resources to set up a smooth and efficient online store. Our hosting solution is fast and integrates well to meet the unique needs of online stores, which helps you maximize sales and allows your customers to enjoy a memorable shopping experience.</p>
                    </div>
                    <div class="wp-ecom-box">
                        <h3>High-speed servers</h3>
                        <p>We understand that high speed is the key to a successful eCommerce business. Our cheapest WordPress hosting plans use high-performance servers for busy online stores that offer quick load times and a seamless customer experience, reducing the chances of cart abandonment and boosting conversions.</p>
                    </div>
                    <div class="wp-ecom-box">
                        <h3>World-Class Security</h3>
                        <p>Our WordPress hosting provides strong protection for your store and customer data by offering you SSL certificates, malware scanning, and intrusion detection as part of our security services. Our advanced technologies guard your website against threats & create a safe shopping environment with Host IT Smart!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Support section start-->
 <!-- @include('template.'.$theme.'.support_section') -->
 <!--Support section end-->
<section class="one-click-wp head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">1-Click Install: Your Effortless Way For Instant Setup</h2>
            <p>We make things convenient with 1-click installation feature with WordPress hosting!</p>
        </div>
        <div class="one-click-wp-main">
            <img src="../assets/img/wordpress/one_click_install.webp" alt="one_click_install">
        </div>
    </div>
</section>


<section class="disc-wp head-tb-p-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="disc-wp-img">
                    <img loading="lazy" src="/assets/img/wordpress/hits_wp.webp" alt="hits_wp">
                </div>
            </div>
            <div class="col-lg-6">
                <div id="accordion-box" class="accordion disc-wp-box">
                    <div class="section-heading disc-wp-head">
                        <h2 class="text_head">Why Choose Host IT Smart For Your WordPress Website?</h2>
                    </div>
                    <div id="accordion-box" class="accordion disc-wp-box">
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box0" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">11+ Years of Experience</h3>
                            </a>
                            <div id="box0" class="collapse show" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>With over 11 years of experience, Host IT Smart has established itself as a fast & cheap WordPress hosting provider in India. Through our robust infrastructure, we offer reliable, secure, and high-performance hosting services to match your unique needs for WordPress websites.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box1" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">NVMe Based Servers</h3>
                            </a>
                            <div id="box1" class="collapse" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>Host IT Smart is committed to providing exceptional performance to its users by using NVMe for our servers to achieve faster data transfer speeds & boosting the WordPress site’s SEO rankings.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box2" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Enterprise Hardware</h3>
                            </a>
                            <div id="box2" class="collapse" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>At Host IT Smart, we invest in enterprise-grade hardware like powerful processors & ample memory for optimal WordPress performance that gives your website all the resources necessary to handle even the heaviest traffic loads and delivers exceptional performance and reliability to your growing business.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box3" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">99.9% Uptime Guarantee</h3>
                            </a>
                            <div id="box3" class="collapse" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>Host IT Smart guarantees a 99.9% uptime when you buy WordPress hosting from us, which ensures that your website remains accessible to visitors around the clock. With us, you can trust that your WordPress website will stay available consistently and serve your audience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box4" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">24/7 Expert Support</h3>
                            </a>
                            <div id="box4" class="collapse" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>At Host IT Smart, we understand that website support is crucial at all times. Hence, we offer 24/7 expert support via chat, phone, WhatsApp & ticket to assist you with solving your WordPress-related concerns. With such classique support, experience the fastest & cheapest WordPress hosting and see your business grow to the next level.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box5" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">30-Day Money-Back Guarantee</h3>
                            </a>
                            <div id="box5" class="collapse" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>We want you to love it when you buy our WordPress hosting, but if, for any reason, you are not completely satisfied, we have got you covered! With our 30-Day Money-Back Guarantee, you can shop with confidence. Contact our support team, and we will take care of the rest!</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box6" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">No Overselling</h3>
                            </a>
                            <div id="box6" class="collapse" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>At Host IT Smart, you won’t have to worry about overselling, even in your dreams. We never oversell servers to hike sales, which means you will get the full power of your plan, ensuring a smooth and reliable experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box7" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Built-In Speed and Performance Enhancements</h3>
                            </a>
                            <div id="box7" class="collapse" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>Host IT Smart's Fastest WordPress hosting in india is designed to deliver exceptional speed and high performance that comes with a range of built-in optimization features, like caching mechanisms and server-side performance enhancements, to ensure the quick and efficient loading of your WordPress website and a seamless user experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 disc-wp-card accordion-item">
                            <a class="accordion-header collapsed" data-bs-toggle="collapse" href="#box8" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Free .COM Domain</h3>
                            </a>
                            <div id="box8" class="collapse" data-bs-parent="#accordion-box">
                                <div class="accordion-body white-bg">
                                    <p>When you choose our WordPress Hosting, we offer you a free .COM domain, the most recognized domain extension in the world. This means you don’t need to buy your domain name separately.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
</section>

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
    {{-- canadaButton.addEventListener('click', hideVpsPlanDiv); --}}
    // germanyButton.addEventListener('click', hideVpsPlanDiv);
    {{-- indiaButton.addEventListener('click', showVpsPlanDiv); --}}
});

</script>

 
 <!--testimonial section start-->
 @include('template.'.$theme.'.testimonial_section')
 @include('template.'.$theme.'.support_section_home')
 <!--testimonial section end-->

 <div class="dy-money-back-grnt head-tb-p-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dy-money-back-grnt-box text-center">
                            <h2>Need a Professional Email Solution?</h2>
                            <p>Google Workspace makes your inbox smarter and more organized!</p>
                            <a href="https://www.hostitsmart.com/email/google-workspace-india" title="Explore Google Workspace">Explore Google Workspace</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('template.'.$theme.'.faq-section')

<section class="most-power-plans head-tb-p-40">
    <div class="container">
        <div class="section-heading">
           
            <h2 class="text_head text-center">Looking For Something Else?</h2>
                  
        </div>
        <div class="row justify-content-center">
                        <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-xs-12">
                <div class="most-power-card">
                    <div class="power-card-tittle">
                        <h2 class="text-white">Linux Hosting</h2>
                        <p>Built for Linux-powered performance</p>
                        <div class="most-power-circle-ol">
                            <div class="most-power-circle">
                                <div class="frnt-cnt">
                                    Starting @
                                </div>
                                <div class="price-cnt">
                                                                        ₹<span>45</span>/mo*
                                                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="power-card-data">
                        <div class="power-card-cnt">
                            <ul>
                                <li>
                                    Host 1 Website
                                </li>
                                <li>
                                    5 GB NVMe Disk Space
                                </li>
                                <li>
                                    50GB Bandwidth
                                </li>
                                <li>
                                    5 Email Accounts
                                </li>
                                <li>
                                    5 subdomains
                                </li>
                                <li>
                                    5 FTP users
                                </li>
                                <li>
                                    Free SSL
                                </li>
                            </ul>
                        </div>
                        <div class="power-plans-btn">
                            <a href="https://www.hostitsmart.com/hosting/linux-hosting" class="buy-now-btn" title="Buy Now">Discover Linux Hosting</a>
                        </div>
                    </div>
                </div>
            </div>
                        <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-xs-12">
                <div class="most-power-card">
                    <div class="power-card-tittle">
                        <h2 class="text-white">Windows Hosting</h2>
                        <p>Hosting crafted for Windows users</p>
                        <div class="most-power-circle-ol">
                            <div class="most-power-circle">
                                <div class="frnt-cnt">
                                    Starting @
                                </div>
                                <div class="price-cnt">
                                                                        ₹<span>90</span>/mo*
                                                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="power-card-data">
                        <div class="power-card-cnt">
                            <ul>
                                <li>
                                5GB Webspace (NVMe)
                                </li>
                                <li>
                                50 GB Bandwidth
                                </li>
                                <li>
                                1 Website
                                </li>
                                <li>
                                1 Subdomain
                                </li>
                                <li>
                                1 MSSQL/MYSQL Space
                                </li>
                                <li>
                                25 E-Mail IDs
                                </li>
                                <li>
                                FREE SSL
                                </li>
                            </ul>
                        </div>
                        <div class="power-plans-btn">
                            <a href="https://www.hostitsmart.com/hosting/windows-hosting" class="buy-now-btn" title="Buy Now">Discover Windows Hosting</a>
                        </div>
                    </div>
                </div>
            </div>
                    </div>
    </div>
</section>

@endsection