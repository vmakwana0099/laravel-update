@extends('layouts.app')
@section('content')

<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
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
                                                    <img loading="eager" src="../assets/images/web_hosting/canada-icons.webp" alt="canada-icons"> Canada</button>
                                            </li>
                                            {{-- <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="loc3" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="changeLocation('Germany');">
                                                    <img loading="eager" src="../assets/images/web_hosting/germany-icons.webp" alt="germany-icons"> Germany</button>
                                            </li> --}}
                                        </ul>
                                        <script type="text/javascript">
                                        function changeLocation(locstr) {
                                            if (locstr == "Canada" || locstr == "Germany") {
                                                $('.feature-litespeed').hide();
                                            } else {
                                                $('.feature-litespeed').show();
                                            }
                                            $('input[id^="location"]').each(function(i, ele) {
                                                $(this).val(locstr);
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
                                                                    <div class="slide-toggle">
                                                                        <li> <span> {{$Specification}}</span></li>
                                                                    </div>
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
                                                                    <div class="slide-toggle">
                                                                        <li> <span> {{$Specification}}</span></li>
                                                                    </div>
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
                                                                    <div class="slide-toggle">
                                                                        <li> <span> {{$Specification}}</span></li>
                                                                    </div>
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
                                                                    <div class="slide-toggle">
                                                                        <li> <span> {{$Specification}}</span></li>
                                                                    </div>
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
@include('template.'.$themeversion.'.30-day-moneyback') 
<section class="vps-features head-tb-p-40" id="features">
        @if(!empty($FeaturesData) && count($FeaturesData) >0)
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="text_head">Managed VPS Features That Will Capture Your Admiration</h2>
                    <p class="text_cnt">Powerful VPS Servers + Cutting-Edge Features = Performance Guaranteed</p>
                </div>
                <div class="row">
                    <div class="features-main">
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
        @endif
    </section>
    @include('template.'.$themeversion.'.support_section_home')
@endsection