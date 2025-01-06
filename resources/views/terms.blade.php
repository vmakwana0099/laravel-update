@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="inner_container cms privacy_policy_div">
    <div class="container">
        <div class="row">	
            <div class="col-md-12">
                {!!$Description!!}
                <div class="spacer_25"></div>
            </div>
        </div>
    </div>
</div>
<?php
// echo $abcd;
/*@if(!empty($FaqData) && count($FaqData) >0)
<div class="getquestion-div">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 data-aos="fade-up">Got a Question? We've the Answer!</h3>
            </div>
            <div class="col-12">
                <div id="accordion" class="accordion">
                    @php $i = 0; $previoustype = '' @endphp
                    @foreach($FaqData as $FaqCat)
                    @php
                    if ($FaqCat->CatName != $previoustype) { @endphp
                    <!--<h5 data-aos="fade-up">{{$FaqCat->CatName}}</h2>-->
                    @php $previoustype = $FaqCat->CatName;
                    }else{
                    $previoustype = '';
                    }
                    if ($i == '0'){
                    $class = 'true';
                    $class1 = '';
                    $class2 = 'display:block';
                    } else {
                    $class = 'false'; 
                    $class1 = 'collapsed'; 
                    $class2 = 'display:none';
                    }     
                    @endphp
                    <div class="card" data-aos="fade-up">
                        <h4 class="mb-0">
                            <button class="btn btn-link {{$class1}}" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="{{$class}}" aria-controls="collapse{{$i}}">
                                {{$FaqCat->varTitle}}
                            </button>
                        </h4>
                        <div id="collapse{{$i}}" class="collapse" data-parent="#accordion" style="{{$class2}}">
                            <div class="card-body">
                                {!!$FaqCat->txtDescription!!}
                            </div>
                        </div>
                    </div>
                    @php $i++;@endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif*/
?>
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
                            /*@if(!empty($testimonialvalue->fkIntImgId))
                            <img src="{!! App\Helpers\resize_image::resize($testimonialvalue->fkIntImgId,134,134) !!}" alt="{{ $testimonialvalue->varTitle }}" title="{{ $testimonialvalue->varTitle }}"/>
                            @else
                            <img src="{{url('assets/images/testimonial-m.svg')}}" alt="{{ $testimonialvalue->varTitle }}" title="{{ $testimonialvalue->varTitle }}" />
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
@endsection