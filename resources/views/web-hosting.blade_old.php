@extends('layouts.app')
@section('content')
<div class="domain_main vps_main">
    
<div class="banner_section show aos-init" data-aos="fade-up">
    <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">

        <div class="carousel-item slide1 diwali-slide diwali-slide-bg active">
            <picture>
                <source media="(max-width: 768px)" srcset="{{ URL::to('/assets/images/01-HomePage-Desktop-Banner-(BlackFriday)ComingSoon.gif') }}">
                <img src="{{ URL::to('/assets/images/01-HomePage-Desktop-Banner-(BlackFriday)ComingSoon.gif') }}" alt="SUPER BLACK FRIDAY SALE COMING SOON" title="SUPER BLACK FRIDAY SALE COMING SOON">
            </picture>
        </div>

          {{-- <div class="carousel-item slide-3"> 
                <picture>
                    <source media="(max-width: 768px)" srcset="https://d1neo0gtmjcot5.cloudfront.net/caches/1920x636_v2/2018-07-31-13-58-52-slider-1.jpg">
                    <img src="https://d1neo0gtmjcot5.cloudfront.net/caches/1920x636_v2/2018-07-31-13-58-52-slider-1.jpg" alt="The Best Web Hosting" title="The Best Web Hosting">
                </picture>
                <div class="carousel-caption container">
                    <div class="slider-box slide3">
                        <div class="offer d-none d-xl-block">ESSENTIAL HOSTING OFFER</div>
                            <h1 class="banner-head">The Best Web Hosting</h1>
                            <div class="banner-sec-head font-small">Starting at 
                            <span class="linethrogh"><i class="rupees dollar-sign">₹</i>160</span>
                            <span class="color-green"><i class="rupees dollar-sign">₹</i><strong>80</strong>/mo*</span>
                        </div>
                        <ul class="slider-listing height-auto d-none d-xl-block">
                            <li><span class="sprite-image free-web"></span>99.9% uptime with dedicated 24/7 technical support</li>
                            <li><span class="sprite-image bandwidth"></span>30 day Money Back Guarantee</li>
                            <li><span class="sprite-image host-free"></span>Unlimited Domains, Emails and Disk space</li>
                            <li><span class="sprite-image email"></span>Unlimited Webspace</li>
                        </ul>
                        <a class="btn-primary" href="/hosting/wordpress-hosting" title="Get Started Now">Get Started Now</a>
                         <p><span class="terms-slider d-none d-xl-block d-renew-class">Renewal rate will be the same. No hidden conditions.  
                         </span></p>
                    </div> 
                </div>
            </div> --}}
    
            <?php /*
            <div class="carousel-item slide1"> 
                <picture>
                    <source media="(max-width: 768px)" srcset="https://d1neo0gtmjcot5.cloudfront.net/assets/images/homebanners/Domain-Inner-Banner-Offers-2020/Domain-Offers-Inner-Banner-India.jpg">
                    <img src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/homebanners/Domain-Inner-Banner-Offers-2020/Domain-Offers-Inner-Banner-India.jpg" alt="Domain Offers" title="Domain Offers">
                </picture>
            </div>
            */ ?>

            {{-- <div class="carousel-item slide2"> 
                <video id="video" muted="" autoplay="autoplay" loop="loop" style="width:100%;" preload="auto">
                    <source src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/homebanners/Make-HostItSmart-A-One-Stop-Shop-Offers-2020/Make-HostItSmart-A-One-Stop-Shop-Offers-Inner-Banner-India.m4v">
                </video>
            </div> --}}
    
     {{-- <a class="carousel-control-prev" href="#slider" data-slide="prev" title="prev">
               <span class="arrow-border d-flex justify-content-center"><svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="26px" height="34px"><g><path d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z" fill="#FFFFFF"></path></g></svg></span>
            </a>
            <a class="carousel-control-next" href="#slider" data-slide="next" title="next">
               <span class="arrow-border d-flex justify-content-center"><svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="26px" height="34px"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z" fill="#FFFFFF"></path></g></svg></span>
            </a> --}}


        </div>
    </div>
</div>
    <?php /*@include('layouts.inner_banner') */?>

    @if(!empty($ProductData) && count($ProductData) >0)
    <div class="domain-search-main">
        <div class="services_section domain-search">
            <div class="container">
                <div class="row">
                	<h2 class="service-main-title col-12">Choose Your Web Hosting Plan</h2>
                    @foreach($ProductData as $Product)
                    <div class="service1 col-lg-4 col-6 d-flex justify-content-center">
                        <div class="services-main align-self-center aos-init" data-aos="fade-up" data-aos-delay="100">
                            <div class="services-icon aos-init" data-aos="flipaos"><i class="s-icon {{$Product->varListingIconClass}}"></i></div><h3 class="services-head" href="javascript:void(0)" title="{{$Product->varTitle}}">{{$Product->varTitle}}</h3>
                            <div class="services-text d-none d-sm-block">
                                {{ $Product->txtHostingMainPageDesc }}
                            </div>
                            <p class="starting">Starting At</p>
                            <div class="price">
                                @if(Config::get('Constant.sys_currency') == 'INR')
                                <i class="rupees_ico">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.'.$Product->varWHMCSFieldName.'_INR') }}&nbsp;<span class=""> /mo</span>
                                @else
                                <i class="rupees_ico">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.'.$Product->varWHMCSFieldName.'_USD') }}&nbsp;<span class=""> /mo</span>
                                @endif
                            </div>
                            <h3><button class="btn-primary" title="Get Started" onclick="window.location.href ='{{url($Product->catAlias.'/'.$Product->varAlias)}}';">Get Started</button></h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
	
	@if(!empty($FeaturesData) && count($FeaturesData) >0)
    <div class="features-domain-div">
        <div class="features_section domain-search">
            <div class="container">
                <h2 class="features-main-title col-12" data-aos="fade-up">Features Of Our Web Hosting</h2>
                <h4 class="features-sub-head" data-aos="fade-up">{!! $FeaturesData[0]->txtFeaturedDescription !!}</h4>
                <div class="row d-hide-mob">
                    @foreach($FeaturesData as $Features)
                    <div class="features1 col-lg-4 col-sm-6 col-12 d-flex">
                        <div class="services-main align-self-center" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                            <div class="services-icon"><i class="{{$Features->varIconClass}}"></i></div><h3 class="services-head"  title="{{$Features->varTitle}}">{{$Features->varTitle}}</h3>
                            <div class="services-text" style="text-align: justify;">{!! nl2br(e(str_limit($Features->varShortDescription, 500))) !!}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="featuredomain_slider">
                            <div class="features-start features-start-mob d-md-none d-block">
                                <!-- features-start-mob -->
                                <div class="owl-carousel owl-theme">
                                    @foreach($FeaturesData as $Features)
                                    <div class="item">
                                        <div class="features1 col-lg-4 col-12 d-flex">
                                            <div class="services-main align-self-center">
                                                <div class="services-icon"><i class="{{$Features->varIconClass}}"></i></div><h4 class="services-head"  title="{{$Features->varTitle}}">{{$Features->varTitle}}</h4>
                                                <div class="services-text" style="text-align: justify;">{!! nl2br(e(str_limit($Features->varShortDescription, 500))) !!}</div>
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
        </div>
    </div>
    @endif

    @if(!empty($catId) && isset($catId) && $catId==10)
    <div class="features-domain-div">
        <div class="features_section domain-search priority_section">
            <div class="container">
                <h3 class="features-main-title col-12 aos-animate">You're Our Priority 24x7</h3>
                     <div class="about-main-div">

    <div class="container">

        <div class="about-div row">

            <div class="row d-flex">
                <div class="col-md-5 col-12 align-self-center">

                    <h4><img src="{{ url('/') }}/assets/images/24by7_support.png" alt="You're Our Priority 24x7" class="aos-animate"></h4>
                </div>
                
                    <div class="col-md-7 col-12 align-self-center">

                    <div class="aos-animate">

                    <div data-aos="fade-left" data-aos-delay="300">

                       <div class="features1 col-lg-12 col-sm-6 col-12 d-flex">
                            <div class="services-main align-self-center aos-animate">
                                <div class="services-icon"><i class="money-back-icon"></i></div><h4 class="services-head" style="margin:inherit;" title="30 Day Money-Back Guarantee">30 Day Money-Back Guarantee </h4>
                                <div class="services-text">At HostItSmart, we believe that we are committed to provide our customers with the best possible service and web hosting solutions. Thus, if you happen to be dissatisfied with our services, we offer you with an option to initiate a refund request within a time period of 30 days.</div>
                            </div>
                        </div>

                      <div class="features1 col-lg-12 col-sm-6 col-12 d-flex">
                        <div class="services-main align-self-center aos-animate">
                            <div class="services-icon"><i class="uptime-icon" ></i></div><h4 class="services-head" style="margin:inherit;" title="99.95% Uptime">99.9% Uptime</h4>
                            <div class="services-text">A guaranteed uptime implies that the website is guaranteed to be up and functional for 99.9% of the time that is available to its visitors and sums up to be one of the most reliable features of a functional website.</div>
                        </div>
                    </div>
                
                  
                    <div class="features1 col-lg-12 col-sm-6 col-12 d-flex">
                        <div class="services-main align-self-center aos-animate">
                            <div class="services-icon"><i class="support-icon"></i></div><h4 class="services-head" style="margin:inherit;" title="24/7/365 Support">24/7 Support</h4>
                            <div class="services-text">A 24/7 strong tech support team is one of the key requirements of a reliable web hosting and can come along with a chat service or a telephone support</div>
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
    @endif

    <div class="chart-main-div">
        <div class="container">
            <div class="chart-div">
                <h5 data-aos="fade-up" data-aos-delay="100">People like us. But don't take our word for it.</h5>
                <div class="services-sub-head" data-aos="fade-up" data-aos-delay="300">Read how HostAdvice compares us to other notable hosting providers</div>
                <ul class="nav nav-pills nav-chart justify-content-center  responsive-tabs" data-aos="fade-up" data-aos-delay="400">
                    <li><a data-toggle="pill" href="#hosting_tabbing1" class="justify-content-center active" title="Overall"><span class="offer-tabbing-name">Overall                         </span></a></li>
                    <li><a data-toggle="pill" href="#hosting_tabbing2" class="justify-content-center" title="Reliability"><span class="offer-tabbing-name">Reliability</span></a></li>
                    <li><a data-toggle="pill" href="#hosting_tabbing3" class="justify-content-center" title="Tech Support"><span class="offer-tabbing-name">Tech Support</span></a></li>
                    <li><a data-toggle="pill" href="#hosting_tabbing4" class="justify-content-center" title="Likelihood to Recommend"><span class="offer-tabbing-name">Likelihood to Recommend</span></a></li>
                </ul>
                <div class="tab-content wow animated fadeIn" id="accordion-id">
                    <div id="hosting_tabbing1" class="tab-pane animated fadeIn active" data-aos="fade-up">
                        <div id="container" class="highcharrt-responsive"></div>
                    </div>
                    <div id="hosting_tabbing2" class="tab-pane animated fadeIn" data-aos="fade-up">
                        <div id="container1" class="highcharrt-responsive"></div>
                    </div>
                    <div id="hosting_tabbing3" class="tab-pane animated fadeIn" data-aos="fade-up">
                        <div id="container2" class="highcharrt-responsive"></div>
                    </div>
                    <div id="hosting_tabbing4" class="tab-pane animated fadeIn" data-aos="fade-up">
                        <div id="container3" class="highcharrt-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if(!empty($ProductData) && count($ProductData) >0)
    <div class="domain-search-main">
        <div class="services_section domain-search">
            <div class="container">
                <div class="cms">
	
				<!-- vk 15/10/2019 -->
				    <h6 class="service-main-title col-12" data-aos="fade-up" data-aos-delay="100">{!!$vertitle!!}</h6>
				    <h4 class="services-sub-head" data-aos="fade-up" data-aos-delay="300"> {!!$verdescription!!} </h4>
			    <!-- end -->
				</div>
			</div>
		</div>
	</div>
@endif

<div class="lading_bottom">
    @if(!empty($FaqData) && count($FaqData) >0)
    <div class="getquestion-div">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 data-aos="fade-up">Web Hosting : Frequently Asked Questions!</h3>
                </div>
                <div class="col-12">
                    <div id="accordion">
                        @php $i = 0; $class = ''; $class1 = ''; $class2 = ''; $class3 = '';  $class4 = ''; @endphp
                        @foreach($FaqData as $Faq)
                        @php
                        if ($i == '0'){
                        $class = 'true';
                        $class1 = 'collapsed';
                        $class2 = 'display:block';
                         $open_class = 'active-accordition';
                        } else {
                        $class = 'false'; 
                        $class1 = 'collapsed'; 
                        $class2 = 'display:none';
                         $open_class = '';
                        } 
                        if ($i > '4'){
                        $class3 = 'display:none';
                        $class4 = 'display:block';
                        } else {
                        $class3 = '';
                        $class4 = 'display:none';
                        } 
                        @endphp
                        <div class="card" data-aos="fade-up" style="{{$class3}}">
                            <h4 class="mb-0 {{$open_class}}">
                                <button class="btn btn-link {{$class1}}" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="{{$class}}" aria-controls="collapse{{$i}}">
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
                    });
                </script>
            </div>
        </div>
    </div>
    @endif
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
                            <span class="offer">Book Domains: .COM starting at<br></span>
                            <div class="price-part">
                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                    <span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">{{ Config::get('Constant.MEGAMENU_REGISTER_PRICE_INR') }}</span><span class="per-month">/mo*</span></span>
                                 @else
                                    <span class="whole-span"><span class="ruppess">&#36;</span> <span class="big-price">{{ Config::get('Constant.MEGAMENU_REGISTER_PRICE_USD') }}</span><span class="per-month">/mo*</span></span>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex"> <a href="{{url('domain')}}" class="btn align-self-center" data-aos="fade-left" title="Get Started">Get Started</a> </div>   
            </div>
        </div>
    </div>
</div>

<script src="{{url('assets/js/highcharts.js')}}"></script>
@endsection