@if(!Request::ajax())
@extends('layouts.app')
@section('content')
    <div class="banner-inner pricing-banner" style="background-image:url({{url('/assets/images/banner_bg.jpg')}});">
        <div class="container">		
            <div class="banner-content">
                <div class="banner-image aos-init" data-aos="fade-up" data-aos-delay="100">
                </div>
                <h1 class="banner-title aos-init" data-aos="fade-up" data-aos-delay="100">
                      {{$Title}}
                </h1>
            </div>
        </div>
    </div>
@endif

<section class="aboutus_01">
    <div class="container">
        <div>
          
            <div class="inner-section cms">
                {!! $CONTENT !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
@endsection
