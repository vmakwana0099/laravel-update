@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="lading_bottom">
    @if(!empty($FaqData) && count($FaqData) >0)
    <div class="getquestion-div win-vps-faq">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 data-aos="fade-up">Got a Question? We've the Answer!</h3>
                </div>
                @php $i = 0; @endphp
                @foreach($FaqCategory as $cat)
                    <div id="accordion" class="accordion faq-wrap">
                        <div class="row align-items-center">
                            <h5 data-aos="fade-up">{{$cat->CatName}}</h5>
                            <div class="col-md-12 col-lg-12">
                                <div id="accordion" class="accordion faq-wrap">
                                    @if(isset($FaqData[$cat->id]) && !empty($FaqData[$cat->id]))
                                    @foreach($FaqData[$cat->id] as $faq)
                                    @php
                                    if ($i == '0'){
                                    $class = 'true';
                                    $class1 = '';
                                    $class2 = 'show';
                                    } else {
                                    $class = 'false'; 
                                    $class1 = 'collapsed'; 
                                    $class2 = '';
                                    }     
                                    @endphp
                                        <div class="card mb-3 faqs-card" style="  ">
                                            <a class="card-header {{$class1}} " data-toggle="collapse" href="#collapse{{$i}}" aria-expanded="{{$class}}">
                                                <h4 class="mb-0 d-inline-block faqs-span">{{$faq->varTitle}}</h4>
                                            </a>
                                            <div id="collapse{{$i}}" class="collapse {{$class2}}" data-parent="#accordion" style="">
                                                <div class="card-body white-bg">
                                                    <p>{!!$faq->txtDescription!!}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                                <span class="color-green"><i class="rupees">&#8377;</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</strong>/mo*</span>
                                 @else
                                 <span class="color-green"><i class="rupees">&#36;</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_USD') }}</strong>/mo*</span>
                                  @endif
                            </div>
                        </div>
                        <div class="info" data-aos="fade-left" data-aos-delay="100">
                            <span class="name">{{$FeaturedProducts->varTitle}}</span>
                            <h3 class="info-text">{{$FeaturedProducts->varShortDescription}}</h3>
                            @php $FeaturedProducts_expload = explode("\n",$FeaturedProducts->varFeature); @endphp
                            <ul class="list">
                                @foreach($FeaturedProducts_expload as $info)
                                <li> {{$info}}</li>
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
                            <span class="offer">VPS hosting offer<br></span>
                            <div class="price-part">
                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                    <span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR') }}</span><span class="per-month">/mo*</span></span>
                                 @else
                                    <span class="whole-span"><span class="ruppess">&#36;</span> <span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD') }}</span><span class="per-month">/mo*</span></span>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex"> <a href="{{url('servers/vps-hosting')}}" class="btn align-self-center" data-aos="fade-left" title="Get Started">Get Started</a> </div>   
            </div>
        </div>
    </div>
</div>

@endsection