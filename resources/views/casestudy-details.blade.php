@extends('layouts.app')
@section('content')
@if(!empty($Casestudies) && count($Casestudies) >0)
<script src="{{ URL::to('/assets/js/jquery.fancybox.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::to('/assets/css/jquery.fancybox.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::to('/assets/css/testimonial.css') }}">
<link rel="stylesheet" href="{{ URL::to('/assets/images/svg') }}" media="all" />
<!-- /public_html/assets/images/svg -->
<div class="banner-inner" style="background-image:url('{{ asset('assets/images/domain_search/banner-bg-hosting.jpg') }}');">
    <div class="container">
        <div class="banner-content">
            <h1 class="banner-title">
            {{$Casestudies->varTitle}}
            </h1>
        </div>
    </div>
</div>

<div class="breadcrub-section">
    <div class="container">
        <div class="d-flex justify-content-around">
            
            <div class="d-md-flex d-none d-md-block justify-content-start mr-auto">
                <ul class="breadcrumb-style2 align-self-center">
                    <li><a href="{{url('/')}}" title="Home"><i class="la la-home"></i></a></li>
                    <li class=""><a href="{{url('/testimonials')}}">Testimonials</a></li>
                    <li class="active">{{$breadcrumb['title']}}</li>
                </ul>
            </div>
            <div class="d-flex justify-content-end justify-content-around">
                <a class="btn-primary backtolist align-self-center" title="Back To Listing" href="{{url('/testimonials')}}">Back To Listing</a>
            </div>
        </div>
    </div>
</div>
<div class="inner_container cms news_detail review-video-main">
    <div class="container">
        <div class="news_box review-video-main__item">
            <div class="row">
                <div class="col-lg-5">
                    @php
                        if(isset($Casestudies->video['youtubeId']) && !empty($Casestudies->video['youtubeId']))
                        {
                            $videoId=$Casestudies->video['youtubeId'];
                            $imgthumnail = "https://img.youtube.com/vi/$videoId/sddefault.jpg";
                    @endphp
                            <div class="thumbnail-container image-main">
                            <div class="thumbnail">
                            <img alt="Madan Kumar" title="Madan Kumar" src="{{$imgthumnail}}" alt="{{$Casestudies->varTitle}}">
                            </div>
                    @php
                        }
                        else{
                    @endphp    
                            <div class="thumbnail-container image-main">
                            <div class="thumbnail">
                            <img alt="Madan Kumar" title="Madan Kumar" src="{!! App\Helpers\resize_image::resize($Casestudies->fkIntImgId,600,600) !!}" alt="{{$Casestudies->varTitle}}">
                            </div>
                    @php
                        }
                    @endphp
                    @php
                    if(isset($Casestudies->video['varVideoName']) && !empty($Casestudies->video['varVideoName']) && empty($Casestudies->video['youtubeId'])){
                    @endphp
                        <div class="review-video-main__item__play">
                            <a data-fancybox="images" data-caption="" data-src="{{ url('/') }}/assets/videos/{{ $Casestudies->video['varVideoName'] }}.{{ $Casestudies->video['varVideoExtension'] }}" title="Play"><i class="fa fa-play-circle" aria-hidden="true"></i></a>
                        </div>
                    @php
                    }
                    elseif(isset($Casestudies->video['youtubeId']) && !empty($Casestudies->video['youtubeId']))
                    {
                    @endphp
                        <div class="review-video-main__item__play">
                            <a data-fancybox="images" data-caption="" data-src="https://www.youtube.com/watch?v={{$Casestudies->video['youtubeId']}}" title="Play"><i class="fa fa-play-circle" aria-hidden="true"></i></a>
                        </div>
                    
                    @php
                    }
                    @endphp
                    </div>
                    @php
                    $cur_url = Request::fullUrl();
                    $title = $Casestudies->varTitle;
                    $img = url('{!! App\Helpers\resize_image::resize($Casestudies->fkIntImgId) !!}');
                    $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                    $tw = "https://twitter.com/home?status=$title%20$cur_url";
                    $gp = "https://plus.google.com/share?url=$cur_url";
                    $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title&media=$img";
                    $ln = "https://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                    @endphp
                    <div class="image-text">
                            <div class="date">
                                <i class="la la-calendar-o"></i>{{ Carbon\Carbon::parse($Casestudies->dtDateTime)->format('M d, Y') }}
                            </div>
                            <div class="share-news">
                                <div class="socialshare">
                                    <ul class="banner-social">
                                        <li><a href="{{ $fb }}" target="_blank" class="share-social facebook" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="{{ $gp }}" target="_blank" class="share-social google" title="Google"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="{{ $tw }}" target="_blank" class="share-social twitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="{{ $pn }}" target="_blank" class="share-social pinterest" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                        <li><a href="{{ $ln }}" target="_blank" class="share-social linkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                    <span class="share-social sharing-icon" title="Share"><i class="share-icon"></i></span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-7">
                    <div class="news_info aos-init" data-aos="fade-left">
                        <div class="info">
                            @php 
                                if(!empty($Casestudies->txtDescription)) {
                            @endphp
                            {!! $Casestudies->txtDescription !!}
                            @php  }else{  @endphp
                                {{ nl2br($Casestudies->txtShortDescription) }}
                            @php } @endphp      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else 
<div class="inner_container cms news_detail">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                No Record Found
            </div>
        </div>
    </div>
</div>
@endif
@endsection