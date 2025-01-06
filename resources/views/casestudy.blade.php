@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('/assets/css/testimonial.css') }}">

@include('layouts.inner_banner')
@if(!empty($CasestudyData) && count($CasestudyData) >0)
<div class="breadcrub-section">
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="d-md-flex d-none d-md-block justify-content-start mr-auto">
                <ul class="breadcrumb-style2 align-self-center">
                    <li><a href="{{url('/')}}" title="Home"><i class="la la-home"></i></a></li>
                    <li class="active"><a href="{{url('/testimonials')}}">Testimonials</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="deals-main case-study-main"> 
    <div class="container">
        <div class="deals-tabbing">
            <div class="deal-boxes">
                <div class="row">
            @php $i = '0'; $class = ''; $class1 = ''; @endphp
            @foreach($CasestudyData as $Casestudy)
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
            <div class="col-lg-4 col-sm-6 col-12 d-flex justify-content-center">
                    <div class="deal-box">
                        @php
                            // echo print_r($Casestudy['videoData'][0]->youtubeId);
                            if(isset($Casestudy['videoData'][0]->youtubeId) && !empty($Casestudy['videoData'][0]->youtubeId) && empty($Casestudy->fkIntImgId))
                            {
                                $videoId = $Casestudy['videoData'][0]->youtubeId;
                                $imgthumnail = "https://img.youtube.com/vi/$videoId/sddefault.jpg";
                                /*print_r($videoId);*/
                        @endphp
                                <div class="image image_hover">
                                    <div class="thumbnail-container">
                                        <div class="thumbnail">
                                            <a href="{{URL::to('testimonials/'.$Casestudy->alias->varAlias)}}" title="{{$Casestudy->varTitle}}">
                                                <img src="{{$imgthumnail}}" alt="Casestudy Image">
                                                <span class="mask"><i class="fa fa-link" aria-hidden="true"></i></span> 
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        @php
                            }
                            else{
                        @endphp    
                                <div class="image image_hover">
                                    <div class="thumbnail-container">
                                        <div class="thumbnail">
                                            <a href="{{URL::to('testimonials/'.$Casestudy->alias->varAlias)}}" title="{{$Casestudy->varTitle}}">
                                                <img src="{!! App\Helpers\resize_image::resize($Casestudy->fkIntImgId,600,600) !!}" alt="Casestudy Image">
                                                <span class="mask"><i class="fa fa-link" aria-hidden="true"></i></span> 
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        @php
                            }
                        @endphp

                    <div class="c_s_content">
                        <div class="align-self-center">
                        <h3 class="deal-title"><a href="{{url('testimonials/'.$Casestudy->alias->varAlias)}}" title="{{$Casestudy->varTitle}}">{{$Casestudy->varTitle}}</a></h3>
                        
                        <span class="deals-text">
                            <p>{{nl2br($Casestudy->txtShortDescription)}}</p>
                        </span>
                        </div>
                        <a href="{{url('testimonials/'.$Casestudy->alias->varAlias)}}" class="btn white-btn" title="Read More">Read More</a>
                        @php
                        $cur_url = Request::fullUrl();
                        $title = $Casestudy->varTitle;
                        $img = url('{!! App\Helpers\resize_image::resize($Casestudy->fkIntImgId) !!}');
                        $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                        $tw = "https://twitter.com/home?status=$title%20$cur_url";
                        $gp = "https://plus.google.com/share?url=$cur_url";
                        $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title&media=$img";
                        $ln = "https://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                        @endphp
                    
                    </div>
                </div>
            </div>

            @endforeach
            </div>
</div>
</div>
</div>
<br />
            <div class="col-sm-12">
                <div class="text-center">
                    <ul class="ac-pagination">
                        {{$CasestudyData->links()}}
                    </ul>
                </div>
            </div>
</div>
            
      @else
           <div class="testimonials-null">
        <div class="container">
                <div class="deal-boxes">
                    <div class="row">
                        <div class="col-12">
                            <div class="no-record"> <i class="no-record-icon"></i>
                                <span>No Testimonials</span>
                            </div>
                        </div>
                    </div>
                </div>
           </div> 
        </div> 
       
@endif

<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>

@include('template.'.$themeversion.'.customer_rating_section')

@endsection


