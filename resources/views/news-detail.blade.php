@extends('layouts.app')
@section('content')
@if(!empty($news) && count($news) >0)
<div class="banner-inner" style="background-image:url('{{ url('assets/images/domain_search/banner-bg-hosting.jpg') }}');">
    <div class="container">     
        <div class="banner-content">
            <h1 class="banner-title">
                {{$breadcrumb['title']}}
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
                    <li class=""><a href="{{url('/news')}}">News</a></li>
                    <li class="active">{{$breadcrumb['title']}}</li>
                </ul>
            </div>
            <div class="d-flex justify-content-end justify-content-around">
                <a class="btn-primary backtolist align-self-center" title="Back To Listing" href="{{url('/news')}}">Back To Listing</a>
            </div>
        </div>
    </div>
</div>
<div class="inner_container cms news_detail">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="news_box">
                    <div class="image image_hover aos-init" data-aos="zoom-in">
                        <div class="thumbnail-container">
                            <div class="thumbnail">
                                <a href="javascript:;" title="{{$news->varTitle}}">
                                    <img src="{!! App\Helpers\resize_image::resize($news->fkIntImgId,600,600) !!}" alt="{{$news->varTitle}}">
                                </a>
                            </div>
                        </div>
                        @php
                        $cur_url = Request::fullUrl();
                        $title = $news->varTitle;
                        $img = url('{!! App\Helpers\resize_image::resize($news->fkIntImgId) !!}');
                        $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                        $tw = "https://twitter.com/home?status=$title%20$cur_url";
                        $gp = "https://plus.google.com/share?url=$cur_url";
                        $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title&media=$img";
                        $ln = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                        @endphp
                        <div class="image-text">
                            <div class="date"><i class="la la-calendar-o"></i>{{ Carbon\Carbon::parse($news->dtDateTime)->format('M d, Y') }}</div>
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
                    <div class="news_info aos-init" data-aos="fade-left">
                        <div class="info">
                            @php 
                            if(!empty($news->txtDescription)) {
                            @endphp
                                {!! $news->txtDescription !!}
                           @php  }else{  @endphp
                                {{ nl2br($news->varShortDescription) }}
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