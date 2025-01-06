@extends('layouts.app')
@section('content')

@php
$tld_Array = $tldpricearray;
$currency = Config::get('Constant.sys_currency');
$currency_Code = Config::get('Constant.sys_currency_code');
$currency_symbol = Config::get('Constant.sys_currency_symbol');
@endphp
@if(!empty($ProductBanner) && count((array)$ProductBanner) >0)
    @if($ProductBanner->id == 14)
        <div class="banner_section show aos-init" data-aos="fade-up">
            <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active slide-3"> 
                        <div class="banner-inner hosting-banner" style="background-image:url('{{ asset('caches/1920x494/2018-07-21-15-22-53-domain-transfer-bg.jpg') }}')">
                            <div class="container">
                                <div class="banner-content">
            			            <div class="banner-image" data-aos="zoom-in" data-aos-delay="100"></div>
            			            <h1 class="banner-title" data-aos="fade-up" data-aos-delay="200">Domain Transfer</h1>
            			            <span class="banner-subtitle" data-aos="fade-up" data-aos-delay="300">The best domain prices and registrar service quality ever!  </span>
            			            <span class="banner-text" data-aos="fade-up" data-aos-delay="400">Domain management draining you out of time and money? We offer cheap domain transfer and renewal Hassles at bay with the best domain deals and a round the clock support.</span>
            
            			            <div class="banner-button" data-aos="fade-up" data-aos-delay="500"> 
            			                <a class="btn-primary" title="Web Hosting" href="{{ url('/web-hosting') }}">Web Hosting</a> 
            			                <a class="btn-primary Click-to-Bottom" title="Validation SSL" href="{{ url('/ssl-certificates') }}">Validation SSL</a>
            			            </div>
        
        			            </div>
        			        </div>
        			    </div>
                    </div>
                    <div class="carousel-item slide1"> 
                        <video id="video" muted="" autoplay="autoplay" loop="loop" style="width:100%;" preload="auto">
                            <source src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/homebanners/Domain-transfer-Inner-Banner-Offers-2020/Domain-transfer-Offers-Inner-Banner-India.m4v">
                        </video>
                    </div>
            
                    <a class="carousel-control-prev" href="#slider" data-slide="prev" title="prev">
                       <span class="arrow-border d-flex justify-content-center"><svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="26px" height="34px"><g><path d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z" fill="#FFFFFF"/></g></svg></span>
                    </a>
                    <a class="carousel-control-next" href="#slider" data-slide="next" title="next">
                       <span class="arrow-border d-flex justify-content-center"><svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="26px" height="34px"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z" fill="#FFFFFF"/></g></svg></span>
                    </a>
                </div>
            </div>
        </div>
    @else
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
@endif
<div class="startdomain-transer head-tb-p-40">
    <div class="container">
        <div class="section-heading">
        <h2 class="text_head text-center">Step towards hasslefree domain management</h2>
        <p class="text-center">Enter any domain you'd like to transfer from any registrar.</p>
    </div>
        <div class="row">
            <form id="transferDomainFrm" name="transferDomainFrm"   method="post" action="{{url('/domaintransferdata')}}" >
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>

                <div class="transfer-form d-flex flex-wrap justify-content-center" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-md-4 col-sm-4 col-4"><label class="heading">Domain</label></div>
                    <div class="col-md-4 col-sm-4 col-4"><label class="heading">Authcode</label></div>
                    <div class="col-md-3 col-sm-3 col-3" id="hide_price"><label class="heading text-center">Price</label></div>
                    <div class="col-md-1 col-sm-1 col-1"></div>


                    <div id="appenddata" class="domain_transfer_appenddata">
                        <input type="hidden" id="inc_value" value="1" />
                        <div class="domain_form d-flex flex-wrap " id="trasfer_div_1">
                            <input type="hidden" id="pricing_1" value="" name="pricing[1]" />
                            <div class="col-md-4 col-sm-4 col-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="domain[1]" id="domain_1" class="form-control" placeholder="Domain.com" onkeypress="remove_space(this.value, '1')" onblur="getprice(this.value, '1');" value="{{ old('domain.1') }}" >
                                        <input type="hidden" id="producttype_main" name="producttype[1]" value="domain"/>
                                        <input type="hidden" id="domaintype_main" name="domaintype[1]" value="transfer">  
                                        <input type="hidden" id="regperiod_main" name="regperiod[1]" value="1" class="regperiod">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="authcode_1" name="authcode[1]" placeholder="Authcode">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-3" id="tld_price_1">
                                <span class="price text-center"><i class="rp-icon">--</i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="continue_checkout d-flex flex-wrap align-items-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-md-5 col-sm-12"><a href="javascript:;" onclick="adddomaintransfer();" class="link" title="Add more Domains to Transfer"><i class="fa fa-plus"></i> Add more Domains to Transfer</a>
                    </div>
                    <div class="col-md-7 col-sm-12 d-flex flex-wrap justify-content-center  justify-content-md-end align-items-center">
                        <!--<span class="price"><i class="rp-icon">&#8377;</i>999</span>-->
                        <button type="submit" class="btn checkout_btn btn-primary" title="Continue To Checkout" onclick="validateform();">Continue To Checkout</button>
                        <!--<input type="submit" class="btn checkout_btn" name="submit" value="Continue To Checkout" />-->
                    </div>
                </div>
            </form>
        </div>
        @if(count($featured_tlds)>0)
        <div class="row justify-content-center text-center">
            <ul class="domain_list" data-aos="fade-up" data-aos-delay="200">
                @foreach ($featured_tlds as $value)
                        <li>
                            <a href="{{url("domain/".$value->varAlias)}}" title=".{{$value->varTitle}}">.{{$value->varTitle}}</a>
                            <span><i class="rp-icon"><?= $currency_symbol ?></i>{{$value->Price1}}</span>
                        </li>
                @endforeach
            </ul>
            <div class="view_more_btn" data-aos="fade-up" data-aos-delay="200">
                <a href="{{url("tld")}}" title="View All">View All</a>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="howtotransfer_div head-tb-p-40">
    <div class="container">
        <div class="section-heading">
        <h2 class="text_head text-center">Domain transfer with us is easy!</h2>
        <p class="text-center">3 quick steps, and you are done!</p>
        </div>
        <div class="row">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="info_div" data-aos="fade-up" data-aos-delay="100">
                        <h3>1. Get your authcode for present registrar</h3>
                        <div class="content">
                            You would typically find it hiding somewhere in your c-panel, or as a few have done it, you have to ask your present registrar to email it to you.
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="info_div" data-aos="fade-up" data-aos-delay="300">
                        <h3>2. Share your domain details with us</h3>
                        <div class="content">
                           That involves the domain and subdomain names and the authentication code that you got for your present registrar. Done, tadaa!!!
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="info_div" data-aos="fade-up" data-aos-delay="500">
                        <h3>3. Your registrar approves, and it’s done!</h3>
                        <div class="content">
                            The domain transfer takes around 8 days after your present registrar gives an approval to us. Enjoy the best domain transfer and renewal ever!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<div class="features-domain-div why-transfer head-tb-p-40">
    <div class="features_section domain-search">
        <div class="container">
            <div class="section-heading">
            <h3 class="text_head text-center">
                Why transfer?
            </h3>
            </div>
            <div class="row d-hide-mob">
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit pricing"></i>
                        </div>
                        <h3 class="services-head">
                            <a href="#" title="Reliable rate">Reliable rate</a>
                        </h3>
                        <div class="services-text">
                            We offer best price in industry .Domain Name comes with feature of DNS management,Privacy, Emails and Whois lookup.
                        </div>
                    </div>
                </div>
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit transfer"></i>
                        </div>
                        <h3 class="services-head">
                            <a href="#" title="Transfer your Domain">Transfer your Domain</a>
                        </h3>
                        <div class="services-text">
                            Transfer your domain is simple and efficient we provide full technical guidance 24*7 to make things going for you.
                        </div>
                    </div>
                </div>
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit domain-registration"></i>
                        </div>
                        <h3 class="services-head">
                            <a href="#" title="Bulk Domain Name Registration">Bulk Domain Name Registration</a>
                        </h3>
                        <div class="services-text">
                            Register up to 100 domains at once with the bulk domain search tool, it is simple and time efficient
                        </div>
                    </div>
                </div>
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit domain-generator"></i>
                        </div>
                        <h3 class="services-head">
                            <a href="#" title="Domain Name Generator">Domain Name Generator</a>
                        </h3>
                        <div class="services-text">
                            Search for domain name ideas matching your business vertical ,we have more that 500+ domain extensions for selecting the best suitable name for you.
                        </div>
                    </div>
                </div>
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit renew-domain"></i>
                        </div>
                        <h3 class="services-head" >
                            <a href="#" title="Renew a Domain">Renew a Domain</a>
                        </h3>
                        <div class="services-text">
                            Renew your domain name  for up to 10 years, you can manage it from your control panel making things more precise  and organized.
                        </div>
                    </div>
                </div>
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit bulk-buy"></i>
                        </div>
                        <h3 class="services-head">
                            <a href="#" title="Bulk Buy">Bulk Buy</a>
                        </h3>
                        <div class="services-text">
                            Presence in digital world is important for any business to get exposure,it is like giving feather to business . Compare pricing for several extensions for choose the right name.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="featuredomain_slider">
                        <div class="features-start features-start-mob d-md-none d-block">
                            <!-- features-start-mob -->
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit pricing"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                <a href="javascript:void(0)" title="Everything in its place.">Reliable rate</a>
                                            </h3>
                                            <div class="services-text">
                                                 We offer best price in industry .Domain Name comes with feature of DNS management,Privacy, Emails and Whois lookup.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit transfer"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                <a href="javascript:void(0)" title="Anyone can do it">Transfer your Domain</a>
                                            </h3>
                                            <div class="services-text">
                                                Transfer your domain is simple and efficient we provide full technical guidance 24*7 to make things going for you.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit domain-registration"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                <a href="javascript:void(0)" title="Bulk Domain Name Registration">Bulk Domain Name Registration</a>
                                            </h3>
                                            <div class="services-text">
                                                Register up to 100 domains at once with the bulk domain search tool, it is simple and time efficient
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit domain-generator"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                <a href="javascript:void(0)" title="Always up to date">Domain Name Generator</a>
                                            </h3>
                                            <div class="services-text">
                                               Search for domain name ideas matching your business vertical ,we have more that 500+ domain extensions for selecting the best suitable name for you.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit renew-domain"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                <a href="javascript:void(0)" title="Go worldwide">Renew a Domain</a>
                                            </h3>
                                            <div class="services-text">
                                                Renew your domain name  for up to 10 years, you can manage it from your control panel making things more precise  and organized.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit bulk-buy"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                <a href="javascript:void(0)" title="Buy in bulk">Bulk Buy</a>
                                            </h3>
                                            <div class="services-text">
                                                Presence in digital world is important for any business to get exposure,it is like giving feather to business . Compare pricing for several extensions for choose the right name.
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
</div>--}}
<div class="features-domain-div why-transfer head-tb-p-40">
    <div class="features_section domain-search">
        <div class="container">
            <div class="section-heading">
            <h3 class="text_head text-center">
                What makes our domain management services worth transferring your domains to us?
            </h3>
            </div>
            <div class="row d-hide-mob">
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit pricing"></i>
                        </div>
                        <h3 class="services-head">Awesome deals</h3>
                        <div class="services-text">
                           You will get the best domain prices with us, always. Find worth in every penny that you pay, with unbelievable monthly deals.
                       </div>
                    </div>
                </div>
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit transfer"></i>
                        </div>
                        <h3 class="services-head">Reliable support</h3>
                        <div class="services-text">
                            As a domain registrar, we ensure that your domains and subdomains are secured and managed properly, all times in a day, all days in a year.
                        </div>
                    </div>
                </div>
                <div class="features1 col-lg-4 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit domain-registration"></i>
                        </div>
                        <h3 class="services-head">Ease of process</h3>
                        <div class="services-text">
                            Transferring domain with us is really easy and very reliable. We keep you away from domain transfer nightmares, like nobody else.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="featuredomain_slider">
                        <div class="features-start features-start-mob d-md-none d-block">
                            <!-- features-start-mob -->
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit pricing"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">Awesome deals</h3>
                                            <div class="services-text">
                                                You will get the best domain prices with us, always. Find worth in every penny that you pay, with unbelievable monthly deals.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit transfer"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">Reliable support</h3>
                                            <div class="services-text">
                                                As a domain registrar, we ensure that your domains and subdomains are secured and managed properly, all times in a day, all days in a year.

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit domain-registration"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">Ease of process</h3>
                                            <div class="services-text">
                                                Transferring domain with us is really easy and very reliable. We keep you away from domain transfer nightmares, like nobody else. 

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
<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')
<div class="product_offers">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="product_offers_main">
                    <div class="product_offers_head">
                        <h2>Web Hosting</h2>
                    </div>
                    <div class="product_offers_cnt">
                        <div class="product_offers_price">
                            <ul>
                            <li class="product_offers_prc_head">Starting From</li>
                            <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>45<span class="month_icon">/mo*</span></li>
                            </ul>
                        </div>
                    </div>
                        <div class="product_offers_btn">
                            <a href="{{ url('/web-hosting') }}">Click to Host Today</a>
                        </div>
                    
                </div>
            </div>
        </div>
        </div>
    </div>

<script type="text/javascript">
    var inc_val = '1';
    var currency_symbol = '<?= $currency_symbol ?>';
    var currency = '<?= $currency ?>';
    var tld_array = '<?= $tld_Array ?>';
    function adddomaintransfer() {
        inc_val++;
        $("#inc_value").val(inc_val);


        var appenddata;
        appenddata = '<div class="domain_form d-flex flex-wrap" id="trasfer_div_' + inc_val + '">';
        appenddata += '<div class="col-md-4 col-sm-4 col-4"><input type ="hidden" name = "pricing[' + inc_val + ']" id ="pricing_' + inc_val + '" value="" /><div class="form-group"><div class="input-group"><input type="text" name="domain[' + inc_val + ']" class="form-control" placeholder="Domain.com" id="domain_' + inc_val + '" onkeypress="remove_space(this.value,' + inc_val + ')" onblur="getprice(this.value, ' + inc_val + ');">';
        appenddata += ' <input type="hidden" id="producttype_' + inc_val + '" name="producttype[' + inc_val + ']" value="domain"/><input type="hidden" id="domaintype_' + inc_val + '" name="domaintype[' + inc_val + ']" value="transfer"><input type="hidden" id="regperiod_' + inc_val + '" name="regperiod[' + inc_val + ']" value="1" class="regperiod">';
        appenddata += '</div> </div> </div>';
        appenddata += '<div class="col-md-4 col-sm-4 col-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control" id="authcode_' + inc_val + '" name="authcode[' + inc_val + ']" placeholder="Authcode"></div> </div></div>';
        appenddata += '<div class="col-md-3 col-sm-3 col-3" id="tld_price_' + inc_val + '"><span class="price text-center"><i class="rp-icon">--</i></span> </div>';
        appenddata += '<div class="col-md-1 col-sm-1 col-1"><span class="sprite-image delete_icon" onclick="remove_transfrer_div(' + inc_val + ');"></span> </div>';
        appenddata += '</div>';
        $("#appenddata").append(appenddata);
    }


    function validateform() {


        $('#transferDomainFrm').validate({// initialize the plugin


            onfocusout: function (element) {
                // "lazy" validation by default

                if (this.checkable(element)) {
                    this.element(element);
                }
            },
            errorPlacement: function (error, element) {

                for (var i = 1; i <= inc_val; i++) {
                    if (element.attr("id") == "domain_" + i) {

                        error.insertAfter(element.parent("div"));
                        return;
                    } else if (element.attr("id") == "authcode_" + i) {
                        error.insertAfter(element.parent("div"));
                        return;
                    }
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $('#transferDomainFrm')).show();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
        });
        jQuery.validator.addMethod("domainchecker", function (value, element) {
            value = value.replace("https://", "").replace("http://", "").replace("www.", "");
            return this.optional(element) || /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) || /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,14}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/.test(value);
        }, "Please enter correct domain name.");

        jQuery.validator.addMethod("noSpace", function (value, element) {
            value = value.replace(' ', '');
            if (value.trim().length <= 0) {
                return false;
            } else {
                return true;
            }
        }, "No space allowed");

        $.validator.addMethod("domainavailibity", function (value, element) {
            var check_result;
            var input_id_error = $("#" + element.id).attr('dcheck');
            if (value != '' && input_id_error != 'y') {
                showLoader();
                $.ajax({
                    type: "POST",
                    url: "{{url('/domain-checker')}}",
                    data: "domainname=" + value + "&transfer=y",
                    async: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data)
                    {
                        if (data) {

                            if (data["status"] == "available") {
                                check_result = false;
                            } else {
                                check_result = true;
                                $("#" + element.id).attr('dcheck', 'y');
                            }
                        }
                        setTimeout(function () {
                            hideLoader();
                        }, 2000);
                    }
                });
            } else {
                check_result = true;
            }

            return check_result;


        }
        , "Seems like this domain is available for registry.");
        $("[name^=domain]").each(function () {
            $(this).rules("add", {
                required: true,
                maxlength: 58,
                noSpace: true,
                domainchecker: true,
                domainavailibity: true,
                messages: {
                    required: "Domain name is require."
                }
            });
        });

        $("[name^=authcode").each(function () {
            $(this).rules("add", {
                required: true,
                minlength: 6,
                maxlength: 32,
                messages: {
                    required: "Authcode is require."
                }
            });
        });
    }





    function remove_transfrer_div(id) {
        if (confirm('Are you sure? You want to remove this domain')) {
            inc_val--;
            $("#inc_value").val(inc_val);
            if ($("#inc_value").val() == inc_val) {
                console.log("in");
                inc_val++;
            }
            $("#trasfer_div_" + id).remove();

            console.log("after remove:" + inc_val);
        }
    }

    function getprice(dtld, inc_val) {
        dtld = dtld.replace("https://", "").replace("http://", "").replace("www.", "");
        var tld1 = dtld.replace(".", "_");
        var tld2 = tld1.split(/_(.*)/s);
        var tld = tld2[1].replace("_", ".");

        // var tld = dtld.split(".");
        // tld = tld.replace(/[^\w\s]/gi, '');
        if (typeof tld != "undefined") {
            var json_parse = JSON.parse(tld_array);
            // var domain_tld_price = parseFloat(json_parse[tld]);
            
                var domain_tld_price = parseFloat(json_parse[tld]);
            if (!isNaN(domain_tld_price)) {
                $("#pricing_" + inc_val).val(domain_tld_price);
                $("#tld_price_" + inc_val).show();
                $("#tld_price_" + inc_val + " .rp-icon").html(currency_symbol + domain_tld_price);
                $("#hide_price").show();
            } else {
                $("#hide_price").hide();
                $("#tld_price_" + inc_val).hide();
            }

        }
    }

    function remove_space(domain_val, domain_id) {
        var url = domain_val.replace(' ', '');
        $('#domain_' + domain_id).val(url);
    }




</script>

<script>

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
</script>


@endsection
