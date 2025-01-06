@php 
$live_url = url()->current();
@endphp
@if(isset($inner_banner_data) && count($inner_banner_data) > 0)

<!-- S 10/6/2020 Vk for deal page banner -->
@if($live_url == URL::to('/deals'))
    <div class="banner_section show aos-init" data-aos="fade-up">
        <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active slide1 diwali-slide diwali-slide-bg"> 
                    <picture>
                        <img src="{{ URL::to('/assets/images/01-HomePage-Desktop-Banner-(BlackFriday)ComingSoon.gif') }}" alt="SUPER BLACK FRIDAY SALE COMING SOON" title="SUPER BLACK FRIDAY SALE COMING SOON">
                    </picture>
                </div>
            </div>
        </div>
    </div>
@else
<!-- E 10/6/2020 Vk -->
<div class="banner-inner inner-banner-height" style="background-image:url('{!! App\Helpers\resize_image::resize($inner_banner_data[0]->fkIntImgId,1920,494) !!}')">
    <div class="container">		
        <div class="banner-content">
            <h1 class="banner-title aos-init" data-aos="fade-up" data-aos-delay="100">
                {{$inner_banner_data[0]->varTitle}}
            </h1>
            <span class="banner-subtitle" data-aos="fade-up" data-aos-delay="300">{!! $inner_banner_data[0]->varSecond_Title !!} </span>
            <span class="banner-subtitle aos-init" data-aos="fade-up" data-aos-delay="200">
                {!! $inner_banner_data[0]->txtDescription !!}
            </span>
            <span class="banner-subtitle aos-init">
                <!--{{$live_url}}-->
                <!--{{URL::to('/deals')}}-->
            </span>
            <div data-aos="fade-up" data-aos-delay="250">
                @if(isset($inner_banner_data[0]->VarButtonText1) && isset($inner_banner_data[0]->VarButtonLink1)) 
                <a href="{{$inner_banner_data[0]->VarButtonLink1}}" class="btn-primary aos-init" title="{{$inner_banner_data[0]->VarButtonText1}}" data-aos="fade-up">{{$inner_banner_data[0]->VarButtonText1}}</a>
                @endif
                @if(isset($inner_banner_data[0]->VarButtonText2) && isset($inner_banner_data[0]->VarButtonLink2))
                <a href="{{$inner_banner_data[0]->VarButtonLink2}}" class="btn-primary aos-init" title="{{$inner_banner_data[0]->VarButtonText2}}" data-aos="fade-up">{{$inner_banner_data[0]->VarButtonText2}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endif
@if(isset($category_inner_banner_data) && count($category_inner_banner_data) > 0)
@php
$cur_url = Request::fullUrl();
$title = $category_inner_banner_data[0]->varTitle;
$img = url('{!! App\Helpers\resize_image::resize($category_inner_banner_data[0]->fkIntImgId) !!}');
$fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
$tw = "https://twitter.com/home?status=$title%20$cur_url";
$gp = "https://plus.google.com/share?url=$cur_url";
$pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title&media=$img";
$ln = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
@endphp
<div class="banner-inner hosting-banner inner-banner-height" style="background-image:url('{!! App\Helpers\resize_image::resize($category_inner_banner_data[0]->fkIntImgId,1920,494) !!}')">
    <div class="container">
        <div class="banner-content" >
            <h1 class="banner-title aos-init" data-aos="fade-up" data-aos-delay="100">{{$category_inner_banner_data[0]->varTitle}}</h1>
            <span class="banner-subtitle" data-aos="fade-up" data-aos-delay="300">{!! $category_inner_banner_data[0]->varSecond_Title !!} </span>
            <span class="banner-text" data-aos="fade-up" data-aos-delay="400">{!! $category_inner_banner_data[0]->txtDescription !!}</span>
            <div data-aos="fade-up" data-aos-delay="250">
                @if(isset($category_inner_banner_data[0]->VarButtonText1) && isset($category_inner_banner_data[0]->VarButtonLink1)) 
                <a href="{{$category_inner_banner_data[0]->VarButtonLink1}}" class="btn-primary aos-init" title="{{$category_inner_banner_data[0]->VarButtonText1}}" data-aos="fade-up">{{$category_inner_banner_data[0]->VarButtonText1}}</a>
                @endif
                @if(isset($category_inner_banner_data[0]->VarButtonText2) && isset($category_inner_banner_data[0]->VarButtonLink2))
                <a href="{{$category_inner_banner_data[0]->VarButtonLink2}}" class="btn-primary aos-init" title="{{$category_inner_banner_data[0]->VarButtonText2}}" data-aos="fade-up">{{$category_inner_banner_data[0]->VarButtonText2}}</a>
                @endif
            </div>
        </div>
        <div data-aos="fade-up" data-aos-delay="300" class="socialshare">
            <ul class="banner-social">
                <li><a href="{{ $fb }}" class="share-social facebook" title="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="{{ $tw }}" class="share-social twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="{{ $gp }}" class="share-social google" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="{{ $pn }}" class="share-social pinterest" title="Pinterest" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
                <li><a href="{{ $ln }}" class="share-social linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
            </ul>
            <span class="share-social sharing-icon"><i class="share-icon" title="Share"></i></span>
        </div>
    </div>
</div>
@endif

