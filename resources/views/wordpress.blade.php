
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
<div class="web-pln-box head-tb-p-40" id="pricing">
        <div class="container-fluid">
            <div class="shared-plan-bx-pd">
                <div class="section-heading">
                    <h2 class="text_head text-center">Perfect & Fastest WordPress Hosting Plans</h2>
                    <p class="text-center">Go Local or Global with Cheap WordPress Hosting in India & Canada!</p>
                </div>  

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="wh-server-location-tab">
                        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button title="India" class="nav-link active" id="loc1" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="changeLocation('India');">
                                    <img loading="lazy" src="../assets/images/web_hosting/india-icons.webp" alt="india-icons"> India</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button title="Canada" class="nav-link" id="loc2" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="changeLocation('Canada');">
                                    <img loading="lazy" src="../assets/images/web_hosting/canada-icons.webp" alt="canada-icons"> Canada</button>
                            </li>
                           {{--  <li class="nav-item" role="presentation">
                                <button title="Germany" class="nav-link" id="loc3" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="changeLocation('Germany');">
                                    <img loading="lazy" src="../assets/images/web_hosting/germany-icons.webp" alt="germany-icons"> Germany</button>
                            </li> --}}
                        </ul>
                        <script type="text/javascript">
                            function changeLocation(locstr) {
                                if(locstr == "Canada" || locstr == "Germany"){
                                    $('.feature-litespeed').hide();
                                }else{
                                    $('.feature-litespeed').show();                            
                                }
                                // console.log("locstr"+ locstr);
                                $('input[id^="location"]').each(function(i, ele) {
                                    $(this).val(locstr);
                                });
                            }
                        </script>
                    </div>
                </div>

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
                                            <div class="shared-plan-fr-mnth">
                                                +3 months free
                                            </div>
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
                                                                    <span class="domain-tooltip">Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.Your Domain Renewal Charges:₹ 1049/Yr*
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
                                            <div class="shared-plan-fr-mnth">
                                                +3 months free
                                            </div>
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
                                                                    <span class="domain-tooltip">Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.Your Domain Renewal Charges:₹ 1049/Yr*
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
                                                        <span class="cut-price">
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
                                            <div class="shared-plan-fr-mnth">
                                                +3 months free
                                            </div>
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
                                                                    <span class="domain-tooltip">Get Free .COM domain for 1st Year with hosting plans on purchase of 1 or more years. After 1-year, Applicable charges will be applied on domain renewal.Your Domain Renewal Charges:₹ 1049/Yr*
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
                                                                        ₹<span>49</span>/mo*
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
                                    10 GB NVMe Disk Space
                                </li>
                                <li>
                                    10000 GB Bandwidth
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