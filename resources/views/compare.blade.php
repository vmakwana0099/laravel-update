@extends('layouts.app')
@section('content')
@include('layouts.inner_banner') 
<div class="banner-inner compare-banner" style="background-image:url(assets/images/about_banner.jpg)">
    <div class="container">		
        <div class="banner-content">
            <h1 class="banner-title aos-init" data-aos="fade-up" data-aos-delay="100">
                Haven’t matched with an ideal match? Consider the following
            </h1>
            <span class="banner-subtitle aos-init" data-aos="fade-up" data-aos-delay="200">
                We believe in a service worthy of every dime that you spend.
            </span>
        </div>
    </div>
</div>
<div class="compare-main">
    <div class="compare-plan cms">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="plan-1">
                        <h3 class="compare-head" data-aos="fade-down">Choose a hosting, proved to be better</h3>
                        <span class="compare-text" data-aos="fade-down">After spending years in R&D, we have come up with the hosting plans which are pocket friendly as well as quipped with the tools and features which make us raise above our competitors.</span>
                        <div class="overlay">
                            <div class="main-plan" data-aos="fade-left" data-aos-easing="ease-out-back">
                                <div class="plan-table row">
                                    <div class="col-4">
                                   <ul>
                                        <li><h6>HEAD TO HEAD</h6></li>
                                        @foreach($pricing['features'] as $feature)
                                            <li><h6>{{$feature}}</h6></li>
                                        @endforeach    
                                    </ul>
                                </div>
                                    <div class="col-4">
                                        <ul>
                                            <li><img src="{{url('/')}}/{{$pricing['hits_logopath']}}" alt="{{$pricing['hits_logoclass']}}" class="{{$pricing['hits_logoclass']}}"></li>
                                            <li><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$pricing['hits_price']}}</span><span class="per-month">/mo</span></span></li>
                                            @foreach($pricing['hits'] as $feature)
                                                @if($feature == 'y')
                                                <li><i class="fa-regular fa-circle-check"></i></li>
                                                @elseif($feature == 'n')
                                                <li><i class="fa-regular fa-circle-xmark"></i></li>
                                                @else
                                                <li>{{$feature}}</li>
                                                @endif
                                            @endforeach
                                            @if (Session::has('variableName'))
                                            @php $Vaules =  Session::get('variableName') @endphp
                                            @else
                                            @php $Vaules =  url('/')."/".$pricing['hits_link'] @endphp
                                            @endif
                                            
                                            @if(isset($aliasId) && !empty($aliasId) && in_array($aliasId,array('434','435','436','437','438','439','440','441')))
                                            {{-- <li>
                                                <form action="{{url('/')}}/cart/store" id="form_vps_154_10" class="planform" name="form_vps_154" method="post"><input type="hidden" id="_token10" name="_token" value="q7zEJQhdHM4nVYMqO6HvNBDiCnGJOktsthFvxZHg"><input type="hidden" id="producttype10" name="producttype[]" value="vps"><input type="hidden" id="pid10" name="pid[]" value="154"><input type="hidden" id="billingcycle10" name="billingcycle[]" value="annually"><input type="hidden" name="vps_ram[]" id="vps_ram10" value="2"><input type="hidden" name="vps_cpu[]" id="vps_cpu10" value="2"><input type="hidden" name="vps_hdd[]" id="vps_hdd10" value="15"><input type="hidden" name="location[]" id="location10" value="USA">
                                                    <button class="btn" title="Start Now">Start Now</button>
                                                </form>
                                            </li> --}}
                                            <li>
                                                <form action="{{url('/')}}/cart/store" id="form_vps_394_0" class="planform" name="form_vps_394" method="post"><input type="hidden" id="_token0" name="_token" value="tpWYHrRTwRq7lfBPocMb0ZZV78Ihvovi1tYPYkCz"><input type="hidden" id="producttype0" name="producttype[]" value="vps"><input type="hidden" id="pid0" name="pid[]" value="394"><input type="hidden" id="billingcycle0" name="billingcycle[]" value="triennially"><button class="btn-primary" title="Buy Now">Start Now</button></form>
                                            </li>
                                            @else
                                            <li><button class="btn" title="Start Now" onclick="window.location.href='{{$Vaules}}'">Start Now</button></li>
                                            @endif
                                        </ul>
                                    </div>
                                   <div class="col-4">
                                        <ul>
                                            <li><img src="{{url('/')}}/{{$pricing['alt_logopath']}}" alt="logo"></li>
                                            <li><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price another-price">{{$pricing['alt_price']}}</span><span class="per-month">/mo</span></span></li>
                                            @foreach($pricing['alternative'] as $feature)
                                                @if($feature == 'y')
                                                <li><i class="fa-regular fa-circle-check"></i></li>
                                                @elseif($feature == 'n')
                                                <li><i class="fa-regular fa-circle-xmark"></i></li>
                                                @else
                                                <li>{{$feature}}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="white-overlay1 d-md-none d-block">
                                        <a href="javascript:void(0)" data-role="scroll-to-next" class="overlay_link">
                                        <i class="fa-solid fa-angles-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="compare-about cms">
        <div class="compare-plan">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="plan-1">
                            <h2 class="compare-head" data-aos="fade-down">What makes Host IT Smart stand out?</h2>
                            <span class="compare-text" data-aos="fade-up">Our hosting plans are backed by years of research and development combined with skillful veterans of the business. We have covered note only the large businesses but also the requirement of mid to small businesses and bloggers. By this, we have come up with the plans which are not only reasonable at cost but also comprises advance features that you might need.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--   <div class="chart-compare">
        <div class="container">
            <div class="chart-main">
                <h3 class="compare-head" data-aos="fade-down">People<i class="la la-heart-o"></i><span class="blue">Fast</span> Websites</h3>
                <span class="compare-text" data-aos="fade-down">
                    You may have heard that Google included a new signal in their search ranking algorithms: site speed. Speeding up your website is important — not just to search engines, but to all Internet users. Faster sites create happy users and when a site responds slowly, visitors spend less time there. At FastComet we are fully committed to provide the fastest hosting services and help you optimize your website for optimal performance.
                </span>
                <div class="chartBarsWrap chartBarsHorizontal" data-aos="fade-right" data-aos-easing="ease-out-back"> 
                    <div class="chartBars"> 
                        <ul class="bars">  
                            <li> 
                                <div data-percentage="40" class="bar greenBarFlat"></div><img src="{{url('/')}}/assets/images/logo.webp" class="hostitsmart-logo" alt="Hostitsmart"/></li>
                            <li>
                                <div data-percentage="60" class="bar orangeBarFlat"></div><img src="{{url('/')}}/assets/images/fastcomet-big.webp" alt="FastComet" /></li>
                            <li>
                                <div data-percentage="85" class="bar blueBarFlat"></div><img src="{{url('/')}}/assets/images/godaddy-big.webp" alt="godaddy"/></li>
                            <li>
                                <div data-percentage="90" class="bar purpleBarFlat"></div><img src="{{url('/')}}/assets/images/bluehost-logo-big.webp" alt="godaddy"/></li>
                            <li>
                                <div data-percentage="100"  class="bar yellowBarFlat"> </div><img src="assets/images/inmotion.svg" alt="Inmotions"/></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <?php /*<div class="what-we-offer" data-type="background" data-speed="7" style="background-position: 40% 105.571px;">
        <div class="container">
            <div class="offer-tabbing">
                <h5 class="aos-init aos-animate" data-aos="fade-up">What We Offer</h5>
                <ul class="nav nav-pills nav-offer justify-content-center aos-init" data-aos="fade-up">
                    <li><a data-toggle="pill" href="#offer1" class="justify-content-center active" title="AWS Support"><span class="bg-white-tab"><i class="offer-1-icon align-self-center compare-icon1"></i></span><span class="offer-tabbing-name">AWS Support</span></a></li>
                    <li><a data-toggle="pill" href="#offer2" class="justify-content-center" title="Virtual Private Servers"><span class="bg-white-tab"><i class="offer-1-icon align-self-center compare-icon2"></i></span><span class="offer-tabbing-name">Virtual Private Servers</span></a></li>
                    <li><a data-toggle="pill" href="#offer3" class="justify-content-center" title="Dedicated Servers"><span class="bg-white-tab"><i class="offer-1-icon compare-icon3 align-self-center"></i></span><span class="offer-tabbing-name">Dedicated Servers</span></a></li>
                    <li><a data-toggle="pill" href="#offer4" class="justify-content-center" title="24/7 Monitoring"><span class="bg-white-tab"><i class="offer-1-icon compare-icon4 align-self-center"></i></span><span class="offer-tabbing-name">24/7 Monitoring</span></a></li>
                </ul>
                <div class="tab-content aos-init cms" data-aos="fade-up" data-aos-delay="250">
                    <div id="offer1" class="tab-pane active show">
                        <div class="offer-tab-text aos-init aos-animate" data-aos="fade-up">
                            <h3>Regular updates</h3>
                            <p>The servers are updated periodically for ensuring all the accounts get latest stable security features.</p>
                            <a href="{{url('/hosting/linux-hosting')}}" class="btn-primary aos-init aos-animate" title="Start Now" data-aos="fade-up" data-aos-delay="250">Start Now</a>
                        </div>
                    </div>
                    <div id="offer2" class="tab-pane">
                        <div class="offer-tab-text aos-init aos-animate" data-aos="fade-up">
                            <h3>99.9% uptime</h3>
                            <p>With our robust infrastructure, you are assured to have 99.9% uptime.</p>
                            <a href="{{url('/hosting/linux-hosting')}}" class="btn-primary aos-init aos-animate" title="Start Now" data-aos="fade-up" data-aos-delay="250">Start Now</a>
                        </div>
                    </div>
                    <div id="offer3" class="tab-pane">
                        <div class="offer-tab-text aos-init aos-animate" data-aos="fade-up">
                            <h3>24x7 monitoring</h3>
                            <p>The servers are monitored round the clock by our hosting experts for ensuring web service status.</p>
                            <a href="{{url('/hosting/linux-hosting')}}" class="btn-primary aos-init aos-animate" title="Start Now" data-aos="fade-up" data-aos-delay="250">Start Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>*/?>
</div>
@if(!empty($testimonialData) && count($testimonialData) >0)
<div class="testomonial-section d-flex">
    <div class="container align-self-center">
        <div class="row">
            <div class="col-12">
                <h2 class="testomonial-head aos-init" data-aos="fade-up">WHAT OUR CUSTOMERS <span class="c-blue">SAY</span></h2>
                <div class="owl-carousel owl-theme" id="testomonial-owl1">
                    @foreach($testimonialData as $testimonialvalue)
                    <div class="item cms col aos-init" data-aos="fade-up">
                        <div class="features-icon">
                          <?php 
                          /*@if(!empty($testimonialvalue->fkIntImgId))
                            <img src="{!! App\Helpers\resize_image::resize($testimonialvalue->fkIntImgId,134,134) !!}" alt="{{ $testimonialvalue->varTitle }}" />
                            @else
                            <img src="{{url('assets/images/testimonial-m.svg')}}" alt="{{ $testimonialvalue->varTitle }}" />
                            @endif*/
                            ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                        <div class="features-head">
                            {{$testimonialvalue->varTitle}}
                        </div>
                        <p class="features-text">
                            {!! (str_limit($testimonialvalue->txtDescription, 1400)) !!}
                        </p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endif
{{-- <script src="{{ url('assets/js/vertical-chart.js?v={{date('YmdHi')}}') }}" type="text/javascript"></script>  --}}
<script src="{{ url('assets/js/vertical-chart.js?v=' . date('YmdHi')) }}" type="text/javascript" async defer></script>

@endsection