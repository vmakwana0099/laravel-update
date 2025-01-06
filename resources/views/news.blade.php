@extends('layouts.app')
@section('content')
@if(!empty($NewsData) && count($NewsData) >0)
@include('layouts.inner_banner')
<div class="breadcrub-section">
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="d-md-flex d-none d-md-block justify-content-start mr-auto">
                <ul class="breadcrumb-style2 align-self-center">
                    <li><a href="{{url('/')}}" title="Home"><i class="la la-home"></i></a></li>
                    <li class="active"><a href="{{url('/')}}">News</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="aboutus_01">
    <div class="container">
        <div>
            <div class="inner-section cms">
              {!! $CmsData->txtDescription !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

<div class="inner_container cms news_listing">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center top-pagination">
                    <ul class="ac-pagination">
                        {{$NewsData->links()}}
                    </ul>
                </div>
            </div>
            @php $i = '0'; $class = ''; $class1 = ''; @endphp
            @foreach($NewsData as $News)
            @php
            if ($i % 2 == 0) {
            $class = "";
            $class1 = "fade-left";
            } else {
            $class = "flex-row-reverse";
            $class1 = "fade-right";
            }
            $i++;
            @endphp
            <div class="col-sm-12">
                <div class="news_box d-sm-flex {{$class}} align-items-stretch">
                    <div class="image image_hover aos-init" data-aos="zoom-in">
                        <div class="thumbnail-container">
                            <div class="thumbnail">
                                <a href="{{url('news/'.$News->alias->varAlias)}}" title="{{$News->varTitle}}"><img src="{!! App\Helpers\resize_image::resize($News->fkIntImgId,600,600) !!}" alt="News 01"> 
                                    <span class="mask"><i class="fa fa-search" aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="news_info aos-init" data-aos="{{$class1}}">
                        <h2><a href="{{url('news/'.$News->alias->varAlias)}}" title="{{$News->varTitle}}">{{$News->varTitle}}</a></h2>
                        <div class="date"><i class="la la-calendar-o"></i>{{ Carbon\Carbon::parse($News->dtDateTime)->format('M d, Y') }}</div>
                        <div class="info">
                            <p>{{nl2br($News->varShortDescription)}}</p>
                        </div><a href="{{url('news/'.$News->alias->varAlias)}}" class="btn" title="Read More">Read More</a>
                        @php
                        $cur_url = Request::fullUrl();
                        $title = $News->varTitle;
                        $img = url('{!! App\Helpers\resize_image::resize($News->fkIntImgId) !!}');
                        $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                        $tw = "https://twitter.com/home?status=$title%20$cur_url";
                        $gp = "https://plus.google.com/share?url=$cur_url";
                        $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title&media=$img";
                        $ln = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                        @endphp
                        <div class="share-news">
                            <div class="socialshare">
                                <span class="share-social sharing-icon" title="Share"><i class="share-icon"></i></span>
                                <ul class="banner-social">
                                    <li><a href="{{ $fb }}" target="_blank" class="share-social facebook" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{ $gp }}" target="_blank" class="share-social google" title="Google"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="{{ $tw }}" target="_blank" class="share-social twitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{ $pn }}" target="_blank" class="share-social pinterest" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                    <li><a href="{{ $ln }}" target="_blank" class="share-social linkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-sm-12">
                <div class="text-center">
                    <ul class="ac-pagination">
                        {{$NewsData->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection