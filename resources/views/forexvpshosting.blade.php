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
    <section class="web-pln-box head-tb-p-40" id="forex-vps-hosting">
  <div class="container-fluid">
    <div class="shared-plan-bx-pd">
      <div class="section-heading">
        <h2 class="text_head text-center">Own the Best Forex VPS Server Today!</h2>
        <p class="text-center">Run EAs Without any Obstacles with our Strong & Highly Secured Servers</p>
        </div>
      <div class="row justify-content-center">
        
        @foreach ($ProductsPackageData as $elkey => $element)

          @php
            $popular_div_class = '';
            if($elkey == 1){
              $popular_div_class = 'shared-plan-most-popular';
            }
            $planName = $element->varTitle;
            $SpecificationData = explode("\n",$element->txtSpecification);
            if ($element->txtShortDescription == 'BEST SELLER') {
              $class_best_seller = 'best-seller-div';
            }else{
              $class_best_seller = ' ';
            }
          @endphp

        
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="shared-plan-box-main {{ $popular_div_class }}" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
            <div class="shared-pln-box">
              @if($elkey == 1)
                <div class="shared-most-popular-cnt">
                  MOST POPULAR
                </div>
              @endif
              <div class="shared-plan-price">
                <div class="shared-plan-nm">
                  {{$planName}}
                </div>
                <div class="shared-plan-cut-prc">
                  {{-- <span class="cut-price">₹840.00</span> --}}                  
                  @if(Config::get('Constant.sys_currency') == 'INR')
                    @if (isset($element->productpricing['monthly']) && isset($element->productpricing['annually']))
                      <span class="cut-price" id="oneyear-sale-price{{str_replace(' ', '', $planName)}}">
                        @if(isset($element->productpricing['monthly_renewal']))
                          {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly_renewal']}}
                        @else
                          {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly']}}
                        @endif
                      </span>
                    @endif
                  @endif
                  {{-- <span class="cut-prc-disc">Save 50%</span> --}}
                  <span class="cut-prc-disc" id="offer-discount-{{str_replace(' ', '', $planName)}}">
                    @php
                      if(isset($element->productpricing['monthly_renewal'])){
                          $percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly_renewal']) * 100), 0);
                      }else{
                          $percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly']) * 100), 0);
                      }
                    @endphp
                    Save {{$percentageOff}}%
                  </span>
                </div>
                <div class="shared-main-price">
                  {{-- ₹<span>420.00</span>/mo* --}}
                  {{-- ₹<span>{{$element->productpricing['annually']}}</span>/mo* --}}
                  ₹<span>{{ number_format($element->productpricing['annually'], 2, '.', '') }}</span>/mo*
                </div>
                
                <div class="shared-plan-btn">
                  {{-- <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a> --}}
                  @if(isset($element->ButtonTextannually) && !empty($element->ButtonTextannually))
                   {!! $element->ButtonTextannually !!}
                  @endif
                </div>
                
                @if(isset($element->productpricing['monthly_renewal']))
                <div class="shared-plan-renew">
                  {{-- Renews at ₹{{ $element->productpricing['yearly_renewal_permonth'] }}/mo after 1 years. Cancel anytime. --}}
                  Renews at ₹{{ rtrim(rtrim(number_format($element->productpricing['yearly_renewal_permonth'], 2, '.', ''), '0'), '.') }}/mo after 1 year. Cancel anytime.

                </div>
                @endif
              </div>
              <div class="shared-plan-cnt">
                <ul>
                  @foreach ($SpecificationData as $key => $Specifica)
                    @php
                      $Specification = (trim($Specifica));
                    @endphp

                    @if(strtolower(trim($Specification)) == "1 vcpu core")
                      <div class="slide-toggle">
                        <li> <span><b>1</b> vCPU core</span></li>
                      </div>
                    @elseif(strtolower(trim($Specification)) == "4 gb ram")
                      <div class="slide-toggle">
                        <li> <span><b>4 GB</b> RAM</span></li>
                      </div>
                    @elseif(strtolower(trim($Specification)) == "50 gb ssd")
                      <div class="slide-toggle">
                        <li> <span><b>50GB</b> SSD</span></li>
                      </div>
                    @elseif(strtolower(trim($Specification)) == "1 dedicated ip")
                    <div class="slide-toggle">
                      <li> <span><b>1</b> Dedicated IP</span></li>
                    </div>
                    @else
                    <div class="slide-toggle">
                      <li> <span>{!!$Specification!!}</span></li>
                    </div>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</section>
    @endif
</div>
@include('template.'.$themeversion.'.testimonial_section')
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
                            <p>Choosing the perfect plan for your Forex VPS Server is crucial for optimal performance. Just select from our tailored plans for a seamless trading experience.</p>
                        </div>
                    </div>
                    <div class="hw-ds-wrk-box plc-th-order">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/place_the_order.webp" alt="place_the_order">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Place the order</h3>
                            <p>Once you have selected your desired plan, it’s time to place your order for that plan securely through our website.</p>
                        </div>
                    </div>
                    <div class="hw-ds-wrk-box dwn-trd-soft">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Download_Trading_Software.webp" alt="Download_Trading_Software">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Download Trading Software</h3>
                            <p>Download and install your favourite trading software quickly on your Forex VPS Server by connecting to the server through an RDP in just a few clicks.</p>
                        </div>
                    </div>
                    <div class="hw-ds-wrk-box conn-trd-soft">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Connect_your_trading_account_to_the software.webp" alt="Connect_your_trading_account_to_the software">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Connect your trading account to the software</h3>
                            <p>It’s time to integrate your trading account with your software to streamline your trading process & stay connected to ensure swift and efficient execution of trades.</p>
                        </div>
                    </div>
                    <div class="hw-ds-wrk-box strt-trd">
                        <div class="hw-ds-img">
                            <img loading="lazy" src="../assets/images/forex_vps_hosting/Start_Trading.webp" alt="Start_Trading">
                        </div>
                        <div class="hw-ds-data">
                            <h3>Start Trading</h3>
                            <p>The final step is to start your trading journey from our Forex VPS Server & enjoy the smooth trading experience with the aim of maximum gains.</p>
                        </div>
                    </div>
            </div>
        </div>
</section>
<section class="forex-vps-idl-trd head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">What makes Host IT Smart’s Forex VPS ideal for your trading?</h2>
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
                            <p>Auto-Startup Trading Platforms</p>
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
                <p class="text-center">Discover some well-known trading brokers our Forex VPS supports to trade efficiently.
                </p>
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
{{-- @include('template.'.$themeversion.'.help_section')  --}}
@include('template.'.$themeversion.'.support_section_home') 
@include('template.'.$themeversion.'.faq-section')
@include('template.'.$themeversion.'.two-hosting-add')
@endsection