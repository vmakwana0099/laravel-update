@extends('layouts.app')

@section('content')

<div class="domain_main vps_main">

    @include('layouts.inner_banner')

    @if(!empty($ProductData) && count($ProductData) >0)

    <div class="domain-search-main">

        <div class="services_section domain-search">

            <div class="container">

                <h2 class="service-main-title col-12" data-aos="fade-up" data-aos-delay="100">{!!$ProductData[0]->Title!!}</h2>

                <h4 class="services-sub-head" data-aos="fade-up" data-aos-delay="300">{!!$ProductData[0]->txtDescription!!}</h4>

                <div class="row">

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

                            <button class="btn-primary" title="Get Started" onclick="window.location.href ='{{url($Product->catAlias.'/'.$Product->varAlias)}}';">Get Started</button>

                        </div>

                    </div>

                    @endforeach

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

    @if(!empty($FeaturesData) && count($FeaturesData) >0)

    <div class="features-domain-div">

        <div class="features_section domain-search">

            <div class="container">

                <h3 class="features-main-title col-12" data-aos="fade-up">Features that give you an edge</h3>

                <h4 class="features-sub-head" data-aos="fade-up">{!! $FeaturesData[0]->txtFeaturedDescription !!}</h4>

                <div class="row d-hide-mob">

                    @foreach($FeaturesData as $Features)

                    <div class="features1 col-lg-4 col-sm-6 col-12 d-flex">

                        <div class="services-main align-self-center" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">

                            <div class="services-icon"><i class="{{$Features->varIconClass}}"></i></div><h4 class="services-head"  title="{{$Features->varTitle}}">{{$Features->varTitle}}</h4>

                            <div class="services-text">{!! nl2br(e(str_limit($Features->varShortDescription, 500))) !!}</div>

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

                                                <div class="services-text">{!! nl2br(e(str_limit($Features->varShortDescription, 500))) !!}</div>

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

   
<div class="lading_bottom">

    @if(!empty($FaqData) && count($FaqData) >0)

    <div class="getquestion-div">

        <div class="container">

            <div class="row">

                <div class="col-12">

                    <h3 data-aos="fade-up">Got a Question? We've the Answer!</h3>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.1.0/highcharts.js"></script>

<script src="{{url('assets/js/highcharts.js')}}"></script>

@endsection