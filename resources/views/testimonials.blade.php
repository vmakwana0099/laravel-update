

@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ URL::to('/assets/css/testimonial.css') }}">

@include('layouts.inner_banner')
<?php  
// echo '<pre>'; print_r($TestimonialsData); exit; 
?>
@if(!empty($TestimonialsData) && count($TestimonialsData) >0)

<div class="breadcrub-section">

    <div class="container">

        <div class="d-flex justify-content-center">

            <div class="d-md-flex d-none d-md-block justify-content-start mr-auto">

                <ul class="breadcrumb-style2 align-self-center">

                    <li><a href="{{url('/')}}" title="Home"><i class="la la-home"></i></a></li>

                    <li class="active"><a href="{{url('/')}}">Testimonials</a></li>

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

            @foreach($TestimonialsData as $Testimonials)

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

                        /*echo '<pre>after for loop....';print_r($Testimonials);exit;*/

                            /*echo print_r($Testimonials['videoData'][0]->youtubeId);*/

                            if(isset($Testimonials['videoData'][0]->youtubeId) && !empty($Testimonials['videoData'][0]->youtubeId) && empty($Testimonials->fkIntImgId))

                            {

                                $videoId = $Testimonials['videoData'][0]->youtubeId;

                                $imgthumnail = "https://img.youtube.com/vi/$videoId/sddefault.jpg";

                        @endphp

                                <div class="image image_hover">

                                    <div class="thumbnail-container">

                                        <div class="thumbnail">

                                            <a href="{{url('testimonials/'.$Testimonials->alias->varAlias)}}" title="{{$Testimonials->varTitle}}">

                                                <img src="{{$imgthumnail}}" alt="{{$Testimonials->varTitle}} Testimonials Image">

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

                                            <a href="{{url('testimonials/'.$Testimonials->alias->varAlias)}}" title="{{$Testimonials->varTitle}}">

                                                <img src="{!! App\Helpers\resize_image::resize($Testimonials->fkIntImgId,600,600) !!}" alt="{{$Testimonials->varTitle}} Testimonials Image">

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

                        <h3 class="deal-title"><a href="{{url('testimonials/'.$Testimonials->alias->varAlias)}}" title="{{$Testimonials->varTitle}}">{{$Testimonials->varTitle}}</a></h3>

                        

                        <span class="deals-text">

                            <p>{{nl2br($Testimonials->txtShortDescription)}}</p>

                        </span>

                        </div>

                        @if(isset($Testimonials['videoData'][0]->youtubeId))

                            <a href="{{url('testimonials/'.$Testimonials->alias->varAlias)}}" class="btn white-btn" title="Read More">Watch a Video</a>

                        @else

                            <a href="{{url('testimonials/'.$Testimonials->alias->varAlias)}}" class="btn white-btn" title="Read More">Read a Review</a>

                        @endif

                        @php

                        $cur_url = Request::fullUrl();

                        $title = $Testimonials->varTitle;

                        $img = url('{!! App\Helpers\resize_image::resize($Testimonials->fkIntImgId) !!}');

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

                    <ul class="ac-pagination text-center">

                        {{$TestimonialsData->links()}}

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

@endsection





