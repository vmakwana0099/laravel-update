@extends('layouts.app')
@section('content')
<div class="domain_main vps_main">
    @include('layouts.inner_banner')
</div>
<div class="server_landing_div">
    @if(!empty($ProductData) && count($ProductData) >0)
    <div class="lading_bottom">
        <div class="hostingtype_div head-tb-p-40">
            <div class="container-fluid">
                <div class="row">
                    @php $p = 0; $class = ''; $color = ''; $info = ''; @endphp
                    @foreach($ProductData as $Product)
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
                                <i class="hosting-type {{$Product->varListingIconClass}}"></i>
                                <div class="hosting-price-start">Starting at 
                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                    <span class="color-green"><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$Product->varWHMCSFieldName.'_INR') }}</strong>/mo*</span>
                                    @else
                                    <span class="color-green"><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$Product->varWHMCSFieldName.'_USD') }}</strong>/mo*</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info" data-aos="fade-left" data-aos-delay="100">
                                <h2 class="name">{{$Product->varTitle}}</h2>
                                <h3 class="info-text">{{$Product->varTagLine}}</h3>
                                <div class="content_info">
                                    @php $FeaturedProducts_expload = explode("\n",$Product->txtShortDescription); @endphp
                                    <ul class="list">
                                        @foreach($FeaturedProducts_expload as $info)
                                        <li><h6>{{$info}}</h6></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="{{url($Product->catAlias.'/'.$Product->varAlias)}}" class="btn" title="Learn More">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    @php $p++;@endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(!empty($FeaturesData) && count($FeaturesData) >0)
    <div class="vps-features server-landing-feature">
        <div class="container">
            <div class="row">
                <div class="features-main">
                    <div class="col-sm-12">
                    <div class="cms">
                    <h2 class="features-title aos-init" data-aos="fade-up">Resilient, high quality and robust hardware </h2>
                    {!! $FeaturesData[0]->txtFeaturedDescription !!}
                    </div>

                    @php
                        $featureMainDivClass;
                        $featureIconDivClass;
                        if ($uagent == "mobile") {
                            $featureMainDivClass="features-start features-start-mob d-md-none d-block";
                            $featureIconDivClass="feature-icon";
                        }else{
                            $featureMainDivClass="features-start d-md-block d-none";
                            $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                        }
                    @endphp

                    <div class="{{$featureMainDivClass}}">

                        @if ($uagent == "mobile")
                        <div class="owl-carousel owl-theme">
                            {{-- <div class="item"> --}}
                        @else
                        <div class="row">
                            <div class="feature-ul d-flex flex-wrap">
                        @endif
                            @foreach($FeaturesData as $Features)
                            @if ($uagent == "mobile") <div class="item"> @endif
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" @if ($uagent != "mobile")data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100" @endif>
                                    <div class="feature-icon d-flex justify-content-center align-items-center">
                                        <i class="{{$Features->varIconClass}}"></i>
                                    </div>
                                    <h3 title="{{$Features->varTitle}}">{{$Features->varTitle}}</h3>
                                    <div class="content">
                                        {!! nl2br(e(str_limit($Features->varShortDescription, 800))) !!}
                                    </div>
                                </div>
                            </div>
                            @if ($uagent == "mobile") </div> @endif
                            @endforeach
                        @if ($uagent == "mobile")
                        </div>
                        @else
                            </div>
                        </div>
                        @endif
                    </div> 


                </div> <!-- features-main end -->
            </div>
        </div>
    </div>
    @endif
    @include('template.vps-compare')
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
                    $("#show").click(function () {
                        $(".card").show();
                        $("#show").hide();
                    });
                </script>
            </div>
        </div>
    </div>
    @endif
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
                             /*@if(!empty($testimonialvalue->txtImageName) && file_exists(public_path().'/assets/images/'.$testimonialvalue->txtImageName.'.'.$testimonialvalue->varImageExtension))
                                <img src="{!! App\Helpers\resize_image::resize($testimonialvalue->fkIntImgId,134,134) !!}" alt="{{ $testimonialvalue->varTitle }}" />
                                @else
                                <img src="{{url('assets/images/slider-icon/busines1.jpg')}}" alt="{{ $testimonialvalue->varTitle }}" />
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
</div>
@endsection