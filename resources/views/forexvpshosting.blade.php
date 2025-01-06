@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{URL::to('/assets/css/vps-page-new.css?v='.date('YmdHi'))}}">
<div class="vps_main {{$ProductBanner->varBannerIconClass}}">
    @if (isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
        <link rel="stylesheet" href="{{URL::to('/assets/css/full-width-inner-banner.css')}}">
        <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?> 
        @include('template.'.$themeversion.'.banner')
    @else
        @if(!empty($ProductBanner) && count((array)$ProductBanner) >0)
        <div class="forex_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="forex_vps_banner_left">
                            <h6>Lightning Fast Forex VPS Hosting</h6>
                            <h1>Enjoy Uninterrupted Trading </h1>
                            <div class="forex_vps_banner_left_features">
                                <p>Enterprise SSD Servers</p>
                                <p>Hosted on Tier 4 Indian Datacenter</p>
                                <p>Low Latency For Faster Trading</p>
                                <p>Robust Security For Secure Trading</p>
                                <p>No Overselling of Resources</p>
                                <p>99.9% Uptime Guarantee</p>
                            </div>
                            <button class="forex_vps_banner_left_try_btn" title="Buy Now"><a href="#linuxEnterpriseBtncontent">Get 7 Days Trial free</a></button>                            
                            <div class="forex_vps_banner_card">
                                <p>*No Credit Card Required</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="forex_vps_banner_right">
                            <img loading="lazy" src="/assets/images/forex_trading.png" alt="forex vps">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
    <div class=" dedicated-plan-main-div head-tb-p-40 forex-vps-hstg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="linuxEnterpriseBtncontent" class="clearfix col-12 section-heading">
                        <h2 class="text_head text-center" title="Own Your Forex VPS Hosting Today! " id="forex-vps-hosting">Own the Best Forex VPS Server Today!</h2>
                        <p class="fw-5 text-center">Run EAs Without any Obstacles with our Strong & Highly Secured Servers</p>
                    </div>
                    <div class="main-plan-add main-plan-windows-vps">
                        <div class="row">
                            @foreach ($ProductsPackageData as $elkey => $element)
                            @php
                            if ($element->varTitle == 'FOREX -Free Trail'){
                                $trailbutton = $element->ButtonTextmonthly;
                                continue;
                            }
                            if ($element->varTitle == 'FOREX VPS 1'){
                                $mailclass = 'free-try-div';
                                $ic = 'ic';
                                $textwhite = 'text-white';
                            }else{
                                $ic = ' ';
                                $textwhite = ' ';
                                $mailclass = 'standard-plan-card';
                            }
                            $planName = $element->varTitle;
                            $SpecificationData = explode("\n",$element->txtSpecification);
                            @endphp
                     
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
    <div class="vps-plan-box" >
        <div class="vps_plan_price">
            <div class="plan-head">{{$planName}}</div>
            @if(Config::get('Constant.sys_currency') == 'INR')
            @if (isset($element->productpricing['monthly']) && isset($element->productpricing['annually']))             
          <div class="plan-cut-price">
    <span class="cut-price" id="oneyear-sale-price{{str_replace(' ', '', $planName)}}">
        {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly']}}
    </span> 
    <span class="offer-discount" id="offer-discount-{{str_replace(' ', '', $planName)}}">
   Save {{$percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly']) * 100), 0)}}%
        </span>
          </div>
            <div class="plan-price-main" id="oneyear-price{{str_replace(' ', '', $planName)}}">
                
    <span class="plan-price-r-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$element->productpricing['annually']}}<span class="vps-prc-mo">/mo</span></div>
            @endif
             {{-- <div class="freedom-sale-offer">+15 Days Free</div> --}}
            <div class="vps-plan-conf-btn" id="oneyear-btn{{str_replace(' ', '', $planName)}}">
           {!! $element->ButtonTextannually !!}
        </div>

            @elseif(Config::get('Constant.sys_currency') == 'USD')
            @if (isset($element->productpricing['monthly']))
            <h2>{!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly']}}<span class="vps-prc-mo">/Mo</span></h2>
            @endif
           
            @endif
        </div>        
       
        <div class="vps-plan-desc">
            <ul>
                @foreach ($SpecificationData as $key => $Specifica)
                @php
                $Specification = (trim($Specifica));
                @endphp
             
                <li><span class="vps-desc-icon"><i class="fa-solid fa-circle-check"></i></span>{!!($Specification)!!}</li>
               
                @endforeach
            </ul>
        </div>
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
</div>
    @include('template.'.$themeversion.'.30-day-moneyback') 

<section class="hw-ds-wrk head-tb-p-40">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Your Confirmed Path to Owning a Forex VPS Server</h2>
                </div>
                <div class="hw-ds-wrk-main">
                    <div class="hw-ds-wrk-box slc-yr-pln">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/select_your_plan.webp" alt="select_your_plan">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Select your plan</h3>
                            <p>Choosing the perfect plan for your Forex VPS Server is crucial for optimal performance. Select from our tailored plans for a seamless trading experience.</p>
                        </div>
                    </div>
                    <div class="hw-ds-wrk-box plc-th-order">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/place_the_order.webp" alt="place_the_order">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Place the order</h3>
                            <p>Once you've selected your plan, proceed to place your order securely through our website.</p>
                        </div>
                    </div>
                    <div class="hw-ds-wrk-box dwn-trd-soft">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Download_Trading_Software.webp" alt="Download_Trading_Software">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Download Trading Software</h3>
                            <p>Download and install your favourite trading software on your Forex VPS Server. Connect to the server through a RDP in a few clicks and enhance your trading experience.</p>
                        </div>
                    </div>
                    <div class="hw-ds-wrk-box conn-trd-soft">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Connect_your_trading_account_to_the software.webp" alt="Connect_your_trading_account_to_the software">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Connect your trading account to the software</h3>
                            <p>Seamlessly integrate your trading account with your Forex VPS Server software to streamline your trading process. Connect to ensure swift and efficient execution of trades.</p>
                        </div>
                    </div>
                    <div class="hw-ds-wrk-box strt-trd">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Start_Trading.webp" alt="Start_Trading">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Start Trading</h3>
                            <p>The final step is to embark on your trading journey from your Forex VPS Server & harness the power of advanced technology and real-time data to make strategic moves. </p>
                        </div>
                    </div>
            </div>
        </div>
</section>
<section class="forex-vps-idl-trd head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">What makes Host IT Smart’s Forex VPS ideal for trading?</h2>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 col-lg-4 col-xl-4 justify-content-center d-flex">
                <div class="forex-vps-idl-main">
                    <div class="forex-vps-idl-box vpsidl-box-1">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Pocket_Friendly.webp" alt="Pocket_Friendly">
                        </div>
                        <div class="idl-box-tittle">
                            <p>Pocket Friendly</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-2">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Secured_Infrastructure.webp" alt="Secured_Infrastructure">
                        </div>
                        <div class="idl-box-tittle">
                            <p>Secured Infrastructure</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-3">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Instant_Activation.webp" alt="Instant_Activation">
                        </div>
                        <div class="idl-box-tittle">
                            <p>Instant Activation</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-4">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Supporting_all_Expert_Advisors.webp" alt="Supporting_all_Expert_Advisors">
                        </div>
                        <div class="idl-box-tittle">
                            <p>Supporting all Expert Advisors</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-5">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/KVM_Technology.webp" alt="KVM_Technology">
                        </div>
                        <div class="idl-box-tittle">
                            <p>KVM Technology</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-6">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Auto_Startup_Trading_Platforms.webp" alt="Auto_Startup_Trading_Platforms">
                        </div>
                        <div class="idl-box-tittle">
                            <p>800+ Forex VPS Clients</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-4 col-xl-4 d-none d-lg-block justify-content-center">
                <div class="forex-vps-idl-img">
                <img loading="lazy" src="../assets/images/forex_vps_hosting/forex_vps_ideal_trading.webp" alt="forex_vps_ideal_trading">
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-4 justify-content-center d-flex">
                <div class="forex-vps-idl-main">
                    <div class="forex-vps-idl-box vpsidl-box-1">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Harness_resources.webp" alt="Harness_resources">
                        </div>
                        <div class="idl-box-tittle">
                            <p>Harness 100% of the resources</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-2">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Supports_Any_Broker.webp" alt="Supports_Any_Broker">
                        </div>
                        <div class="idl-box-tittle">
                            <p>Supports Any Broker</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-3">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Supports_Any_Trading_Platform.webp" alt="Supports_Any_Trading_Platform">
                        </div>
                        <div class="idl-box-tittle">
                            <p>Supports Any Trading Platform</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-4">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/2X_Faster_Speed.webp" alt="2X_Faster_Speed">
                        </div>
                        <div class="idl-box-tittle">
                            <p>2X Faster Speed</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-5">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/India_Datacenter.webp" alt="India_Datacenter">
                        </div>
                        <div class="idl-box-tittle">
                            <p>India Datacenter</p>
                        </div>
                    </div>
                    <div class="forex-vps-idl-box vpsidl-box-6">
                        <div class="idl-box-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/247_Support.webp" alt="247_Support">
                        </div>
                        <div class="idl-box-tittle">
                            <p>24/7 Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popl-trd-brokr head-tb-p-40">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Some Popular Trading Brokers Our Forex VPS Supports</h2>
                <p class="text-center">Discover some of the popular trading brokers our Forex VPS supports,<br> empowering you to trade easily and efficiently. </p>
            </div>
            <div class="popl-trd-brokr-main">
                <div class="trd-brokr-box-ol">
                <div class="trd-brokr-box">
                <img loading="lazy" src="../assets/images/forex_vps_hosting/Olymp_Trade.webp" alt="Olymp_Trade">
                </div>
                </div>
                <div class="trd-brokr-box-ol">
                <div class="trd-brokr-box">
                <img loading="lazy" src="../assets/images/forex_vps_hosting/Octa.webp" alt="Octa">
                </div>
                </div>
                <div class="trd-brokr-box-ol">
                <div class="trd-brokr-box">
                <img loading="lazy" src="../assets/images/forex_vps_hosting/axi.webp" alt="axi">
                </div>
                </div>
                <div class="trd-brokr-box-ol">
                <div class="trd-brokr-box">
                <img loading="lazy" src="../assets/images/forex_vps_hosting/forex4you.webp" alt="forex4you">
                </div>
                </div>
                <div class="trd-brokr-box-ol">
                <div class="trd-brokr-box">
                <img loading="lazy" src="../assets/images/forex_vps_hosting/xm.webp" alt="xm">
                </div>
                </div>
            </div>
        </div>
</section>
@if(!empty($FeaturesData) && count($FeaturesData) >0)
<div class="vps-features forex-vps-features head-tb-p-40" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <div class="section-heading">
                <h2 class="text_head text-center" data-aos="fade-up">Features of Our Forex VPS Hosting</h2>
                </div>
                @php
                $featureMainDivClass;
                $featureIconDivClass;
                $featureMainDivClass="features-start d-md-block";
                $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                @endphp
                <div class="{{$featureMainDivClass}}">
                        <div class="row">
                            <div class="feature-ul d-flex flex-wrap">
                                @foreach($FeaturesData as $Features)
                                    <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                        <div class="content-main align-self-start">
                                            <div class="{{$featureIconDivClass}}">
                                                <img loading="lazy" class="win-vps-features-icon" src="../assets/images/forex_vps_hosting/{{$Features->varIconClass}}" alt="{{$Features->varIconClass}}">
                                            </div>
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
@endif
<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.testimonial_section') 
@include('template.'.$themeversion.'.faq-section')
@include('template.'.$themeversion.'.two-hosting-add')
@endsection