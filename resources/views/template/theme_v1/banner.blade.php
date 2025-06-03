<?php
    if(Request::segment(2) =='vps-hosting' || Request::segment(2)=='managed-vps-hosting' || Request::segment(2)=='linux-vps-hosting' || Request::segment(2) =='forex-vps-hosting' || Request::segment(2) =='windows-vps-hosting' || Request::segment(2) =='dedicated-servers'|| Request::segment(1) =='web-hosting'|| Request::segment(1) =='web-hosting-ahmedabad' || Request::segment(1) ==''){
$bannerclass="";
$bannerclass1=" ";
}
else{
$bannerclass="banner_section show aos-init";
$bannerclass1="carousel-inner  manual-class-carousel";
}
?>
<div class="{{$bannerclass}}" data-aos="fade-down">
@if(isset($bannerData) && !empty($bannerData) && count($bannerData)>0 && $bannerData[0]->varTitle != 'Diwali_offer_banner_2022' && $bannerData[0]->varTitle != 'Black_friday_sale_home_banner' && $bannerData[0]->varTitle != 'home_page_black_friday_sale_domain_offer' && $bannerData[0]->varTitle != 'Home_page_Banner_Shared-Hosting')
@php
    $bannerName=str_replace("_",'-',$bannerData[0]->varBannerType);
@endphp
@if($bannerData[0]->varTitle == 'Diwali_2023_New_banner')
@php
$diwali_2023 = 'Home_diwali_2023';
@endphp
@else
@php
$diwali_2023 = '';
@endphp
@endif

    <div>


<div class=" {{$bannerclass1}}-{{$bannerName}}">

            @if(!empty($bannerData) && count($bannerData)>0)

            <?php $Slide = 1; $extraBannerClass = ''; ?>

            @foreach($bannerData as $index => $bannerImg)

            <?php

            //echo '<pre>';print_r($bannerData);

            if ($Slide == 1) {

                $Banner_Active = "active";

            } else {

                $Banner_Active = "";

            }

            if ($bannerImg->id == 1) {

                $slider_class = "slide-3";

                $sliderinner_class = "slide3";

                $Ul_Class = "slider-listing height-auto d-none d-xl-block";

            } else if ($bannerImg->id == 2) {

                $slider_class = "slide1";

                $sliderinner_class = "";

                $Ul_Class = "slider-listing ul-check d-none d-xl-block";

            } else if ($bannerImg->id == 3) {

                $slider_class = "slider2";

                $sliderinner_class = "";

                $Ul_Class = "slider-listing ul-check d-none d-xl-block";

            }else if ($bannerImg->id == 41) {

                $slider_class = "slide1";

                $sliderinner_class = "";

                $Ul_Class = "slider-listing ul-check d-none d-xl-block";

            }else if ($bannerImg->id == 27) {

                $slider_class = "slide1";

                $sliderinner_class = "";

                $Ul_Class = "slider-listing ul-check d-none d-xl-block";

            } else {

                $slider_class = "slide-3";

                $sliderinner_class = "slide3";

                $Ul_Class = "slider-listing height-auto d-none d-xl-block";

            }

            ?>

@if ($bannerImg->varBannerVersion == "html_banner")
    @php
        $_imagePathUrl = (isset($bannerImg->fkIntImgId) && !empty($bannerImg->fkIntImgId)) ? App\Helpers\resize_image::resize($bannerImg->fkIntImgId,1920,494) : '';
    @endphp
    <div >
@else
    <div >
@endif

        @if($bannerImg->varBannerVersion == "img_banner" )

            @if ( (isset($bannerImg->dasktopSourceUrl) && !empty($bannerImg->dasktopSourceUrl) ) &&
                    (isset($bannerImg->mobileSourceUrl) && !empty($bannerImg->mobileSourceUrl)) &&
                    (isset($bannerImg->ipadSourceUrl) && !empty($bannerImg->ipadSourceUrl)) )

                    @if($uagent == "mobile")
                        @if(strtolower($udevice) != "ipad") {{-- if mobile banner --}}
                            <?php $ext = pathinfo($bannerImg->mobileSourceUrl, PATHINFO_EXTENSION); ?>
                            @if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" )
                                <picture>
                                    <source media="(max-width: 767px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
                                    <source media="(max-width: 768px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
                                    <img src="{{ $bannerImg->mobileSourceUrl }}" alt="{{ $bannerImg->varTagLine }}" title="{{ $bannerImg->varTagLine }}" />
                                </picture>

                            @elseif($ext == "mp4" || $ext == "m4v" )

                                <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" alt="{{$bannerImg->ipadSourceUrl}}" poster="{{ $bannerImg->ipadSourceUrl }}">
                                    <source  src="{{ $bannerImg->ipadSourceUrl }}"></source>
                                </video>

                            @endif 

                        @else {{-- if I-Pad banner --}}

                            <?php $ext = pathinfo($bannerImg->ipadSourceUrl, PATHINFO_EXTENSION); ?>
                            @if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" )
                                <picture>
                                    <source media="(max-width: 767px)" srcset="{{ $bannerImg->ipadSourceUrl }}">
                                    <source media="(max-width: 768px)" srcset="{{ $bannerImg->ipadSourceUrl }}">
                                    <img src="{{ $bannerImg->ipadSourceUrl }}" alt="{{$bannerImg->ipadSourceUrl}}" title="{{ $bannerImg->varTagLine }}" />
                                </picture>

                            @elseif($ext == "mp4" || $ext == "m4v" )

                                <?php $ipadurl = str_replace(".jpg",".m4v",$ipadurl); ?>

                                <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" alt="{{$bannerImg->ipadSourceUrl}}" poster="{{ $bannerImg->ipadSourceUrl }}">

                                    <source  src="{{ $bannerImg->ipadSourceUrl }}"></source>

                                </video>

                            @endif 

                        @endif   

                    @else {{-- if desktop banner --}}
                        <?php $ext = pathinfo($bannerImg->dasktopSourceUrl, PATHINFO_EXTENSION) ?>
                        @if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" )
                            <picture>
                                <source media="(max-width: 767px)" srcset="{{ $bannerImg->dasktopSourceUrl }}">
                                <source media="(max-width: 768px)" srcset="{{ $bannerImg->dasktopSourceUrl }}">
                                <img src="{{ $bannerImg->dasktopSourceUrl }}" alt="{{$bannerImg->dasktopSourceUrl}}" title="{{ $bannerImg->varTagLine }}" />
                            </picture>
                        @elseif($ext == "mp4" || $ext == "m4v" )
                            <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" alt="{{$bannerImg->dasktopSourceUrl}}" poster="{{ $bannerImg->dasktopSourceUrl }}">
                                <source  src="{{ $bannerImg->dasktopSourceUrl }}"></source>
                            </video>
                        @endif

                    @endif

                    @if( isset($bannerImg->VarButtonLink) && !empty($bannerImg->VarButtonLink) ) 
                        {{-- video banner button --}}
                        <a class="btn-primary" id="btncustomcss" href="{{ $bannerImg->VarButtonLink }}" title="{{ isset($bannerImg->VarButtonText) && !empty($bannerImg->VarButtonText) ? $bannerImg->VarButtonText : "Buy Now" }}"> {{ isset($bannerImg->VarButtonText) && !empty($bannerImg->VarButtonText) ? $bannerImg->VarButtonText : "Buy Now" }}</a> 
                    @endif

                @else
                    @if (isset($bannerImg->fkIntImgId) && !empty($bannerImg->fkIntImgId))
                        <picture>
                            <source media="(max-width: 767px)" srcset="{{ App\Helpers\resize_image::resize($bannerImg->fkIntImgId,1920,494) }}">
                            <source media="(max-width: 768px)" srcset="{{ App\Helpers\resize_image::resize($bannerImg->fkIntImgId,1920,494) }}">
                            <img src="{{ App\Helpers\resize_image::resize($bannerImg->fkIntImgId,1920,494) }}" alt="{{App\Helpers\resize_image::resize($bannerImg->fkIntImgId,1920,494)}}" title="{{ $bannerImg->varTagLine }}" />
                        </picture>
                    @endif
                @endif

        @elseif($bannerImg->varBannerVersion == "vid_banner")

            @if ( (isset($bannerImg->dasktopSourceUrl) && !empty($bannerImg->dasktopSourceUrl) ) &&
                (isset($bannerImg->mobileSourceUrl) && !empty($bannerImg->mobileSourceUrl)) &&
                (isset($bannerImg->ipadSourceUrl) && !empty($bannerImg->ipadSourceUrl)) )

                @if($uagent == "mobile")
                    @if(strtolower($udevice) != "ipad") {{-- if mobile banner --}}
                        <?php $ext = pathinfo($bannerImg->mobileSourceUrl, PATHINFO_EXTENSION); ?>
                        @if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" )
                            <picture>
                                <source media="(max-width: 767px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
                                <source media="(max-width: 768px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
                                <img src="{{ $bannerImg->mobileSourceUrl }}" alt="{{ $bannerImg->varTagLine }}" title="{{ $bannerImg->varTagLine }}" />
                            </picture>

                        @elseif($ext == "mp4" || $ext == "m4v" )

                            <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" alt="{{$bannerImg->ipadSourceUrl}}" poster="{{ $bannerImg->ipadSourceUrl }}">
                                <source  src="{{ $bannerImg->ipadSourceUrl }}"></source>
                            </video>

                        @endif 

                    @else {{-- if I-Pad banner --}}

                        <?php $ext = pathinfo($bannerImg->ipadSourceUrl, PATHINFO_EXTENSION); ?>
                        @if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" )
                            <picture>
                                <source media="(max-width: 767px)" srcset="{{ $bannerImg->ipadSourceUrl }}">
                                <source media="(max-width: 768px)" srcset="{{ $bannerImg->ipadSourceUrl }}">
                                <img src="{{ $bannerImg->ipadSourceUrl }}" alt="{{$bannerImg->ipadSourceUrl}}" title="{{ $bannerImg->varTagLine }}" />
                            </picture>

                        @elseif($ext == "mp4" || $ext == "m4v" )

                            <?php $ipadurl = str_replace(".jpg",".m4v",$ipadurl); ?>

                            <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" alt="{{$bannerImg->ipadSourceUrl}}" poster="{{ $bannerImg->ipadSourceUrl }}">

                                <source  src="{{ $bannerImg->ipadSourceUrl }}"></source>

                            </video>

                        @endif 

                    @endif   

                @else {{-- if desktop banner --}}
                    <?php $ext = pathinfo($bannerImg->dasktopSourceUrl, PATHINFO_EXTENSION) ?>
                    @if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" )
                        <picture>
                            <source media="(max-width: 767px)" srcset="{{ $bannerImg->dasktopSourceUrl }}">
                            <source media="(max-width: 768px)" srcset="{{ $bannerImg->dasktopSourceUrl }}">
                            <img src="{{ $bannerImg->dasktopSourceUrl }}" alt="{{$bannerImg->dasktopSourceUrl}}" title="{{ $bannerImg->varTagLine }}" />
                        </picture>
                    @elseif($ext == "mp4" || $ext == "m4v" )
                        <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" alt="{{$bannerImg->dasktopSourceUrl}}" poster="{{ $bannerImg->dasktopSourceUrl }}">
                            <source  src="{{ $bannerImg->dasktopSourceUrl }}"></source>
                        </video>
                    @endif

                @endif

                @if( isset($bannerImg->VarButtonLink) && !empty($bannerImg->VarButtonLink) ) 
                    {{-- video banner button --}}
                    <a class="btn-primary" id="btncustomcss" href="{{ $bannerImg->VarButtonLink }}" title="{{ isset($bannerImg->VarButtonText) && !empty($bannerImg->VarButtonText) ? $bannerImg->VarButtonText : "Buy Now" }}"> {{ isset($bannerImg->VarButtonText) && !empty($bannerImg->VarButtonText) ? $bannerImg->VarButtonText : "Buy Now" }}</a> 
                @endif

            @else
                @if (isset($bannerImg->varVideoName) && !empty($bannerImg->varVideoName))
                    <video id="video" muted autoplay="autoplay" loop="loop" style="width:100%;" preload="auto" alt="{{ URL::to("/assets/videos/".$bannerImg->varVideoName.".".$bannerImg->varVideoExtension) }}" poster="{{ URL::to("/assets/videos/".$bannerImg->varVideoName.".".$bannerImg->varVideoExtension) }}">
                        <source  src="{{ URL::to("/assets/videos/".$bannerImg->varVideoName.".".$bannerImg->varVideoExtension) }}"></source>
                    </video>
                @endif
            @endif
            
        @elseif($bannerImg->varBannerVersion == "html_banner")

            {{-- <link rel="stylesheet" href="{{ isset($bannerImg->txt_custom_csspath) && !empty($bannerImg->txt_custom_csspath) ? $bannerImg->txt_custom_csspath.'?v={{date('YmdHi')}}'. : '' }}"> --}}
            <link rel="stylesheet" href="{{ isset($bannerImg->txt_custom_csspath) && !empty($bannerImg->txt_custom_csspath) ? $bannerImg->txt_custom_csspath.'?v='.date('YmdHi') : '' }}">
            
            {{-- VA 15-10-2024 Dynamic rating code--}}
             @php
    // Get the serialized string from config
    $serializedString = Config::get('Constant.CUSTOMER_RATING_REVIEW');
    // Unserialize it into an array
    $customerRatingReview = unserialize($serializedString);
@endphp

{!! 
    str_replace('@TRUSTPILOT', number_format($customerRatingReview['RATING']['TRUSTPILOT'] ?? 0, 1),
    str_replace('@HOSTADVICE', number_format($customerRatingReview['RATING']['HOSTADVICE'] ?? 0, 1),
    str_replace('@GOOGLE', number_format($customerRatingReview['RATING']['GOOGLE'] ?? 0, 1),
    $bannerImg->txtbannerhtml
    )))
!!}

            {{-- {!! $bannerImg->txtbannerhtml !!} --}}
        @endif

</div>



<?php

$Slide++;

?>

@if ( isset($bannerImg->chr_full_width) && $bannerImg->chr_full_width=='Y')
    <link rel="stylesheet" href="{{URL::to('/assets/css/full-width-inner-banner.css')}}">
@endif

@endforeach


@endif
@endif



    </div>

        

        @if(!empty($bannerData) && count($bannerData)>1)    

            <div class="slider_nav ">

                <div>

                  <a class="carousel-control-prev" href="#slider" data-slide="prev" title="Prev">

                    <i class="fa fa-caret-left"></i>

                  </a>

                  <a class="carousel-control-next" href="#slider" data-slide="next" title="Next">

                    <i class="fa fa-caret-right"></i>

                  </a>

                </div>

            </div>
                @elseif($bannerData[0]->varTitle == 'Diwali_offer_banner_2022')
                    <div class="" >
                     {!! $bannerData[0]->txtbannerhtml !!}
                    </div>
                @elseif($bannerData[0]->varTitle == 'Black_friday_sale_home_banner')
                    <div class="Black_friday_sale_home_banner">
                     {!! $bannerData[0]->txtbannerhtml !!}
                    </div>
                @elseif($bannerData[0]->varTitle == 'home_page_black_friday_sale_domain_offer')
                    <div class="Black_friday_sale_home_banner">
                     {!! $bannerData[0]->txtbannerhtml !!}
                    </div>
                @elseif($bannerData[0]->varTitle == 'Home_page_Banner_Shared-Hosting')
                <div class="Black_friday_sale_home_banner">
                 {!! $bannerData[0]->txtbannerhtml !!}
                </div>
            @endif

            

    </div>

    @if(Request::segment(1)=='' || Request::segment(1)=='web-hosting')
        {{-- <div class="christmas-chat-box">
            <p>Avail Exciting Discounts From Santa</p>
            <a class="btn-primary christmas-btn-2021" href="javascript::void(0);" onclick="$zopim.livechat.window.show();" title="Chat Now">Chat Now</a>
        </div> --}}
    @endif

    @if(request()->route()->getName() == 'home')

                <section class="find-search-box head-tb-p-40">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-sm-12">

                <div class="domain-search-wrap">

                    <div class="row justify-content-center align-items-center">

                        <div class="col-sm-12">

                            <h2 class="text-center fnd_prfct_dmn text-cstm-clr">Perfect Domain Name is Just a Search Away</h2>

                            <form class="domain-search-form" id="domainlookupfrm" onsubmit="margetlds()" autocomplete="off" name="domainlookupfrm" action="{{url('/domain-checker')}}" method="post" novalidate="novalidate">

                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

                                <input type="hidden" name="hide_tlddata" id="hide_tlddata" value="{{$Tlds}}" />

                                <input type="hidden" name="domain_search" id="domain_search" value="y" />

                                <input type="hidden" name="is_banner_form" id="is_banner_form" value="y" />

                                <input type="text" id="domain_name" name="domainname" class="form-control" placeholder="Search Your Domain" />

                                <div class="select-group domain-select-list">

                                    <select name="selcetlds" id="selcetlds" class="form-select" aria-label="Select a domain extension">

                                        @foreach($FeaturedTlds as $tlddata)

                                        <option value="{{ $tlddata->varTitle }}">.{{ $tlddata->varTitle }}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="">

                                    <button type="submit" class="secondary-btn-sq">Search</button>

                                </div>

                            </form>

                            <div class="domain-list-wrap text-center mt-4">

                                <ul class="domain-search-list">
                            @foreach($FeaturedTlds as $tlddata)
                            
                                @php
                                    $domainClass = "domain-list-1";
                                    if($tlddata->varTitle == "in"){
                                        $domainClass = "domain-list-2";
                                    }elseif($tlddata->varTitle == "net"){
                                        $domainClass = "domain-list-3";
                                    }elseif($tlddata->varTitle == "org"){
                                        $domainClass = "domain-list-4";
                                    }elseif($tlddata->varTitle == "co"){
                                        $domainClass = "domain-list-5";
                                    }  
                                @endphp
                                <li class="{{$domainClass}}">
                                    <a href="{{ url('/domain/buy-' . $tlddata->varTitle . '-domain-names') }}" title="{{ ucwords(strtolower($tlddata->varTitle)) }}" class="text-black">
                                        <span class="domain-search-title">.{{ strtolower($tlddata->varTitle) }}</span>

                                        <span class="domain-search-price">
                                             @if(Config::get('Constant.sys_currency') == 'INR')
                                            {!! Config::get('Constant.sys_currency_symbol') !!}
                                            {{ Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_INR') }}
                                        @elseif(Config::get('Constant.sys_currency') == 'CAD')
                                            {!! Config::get('Constant.sys_currency_symbol') !!}
                                            {{ Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_CAD') }}
                                        @else
                                            {!! Config::get('Constant.sys_currency_symbol') !!}
                                            {{ Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_USD') }}
                                        @endif
                                        </span>
                                    </a>


                                    </li>
                            @endforeach
                                    {{-- <li class="domain-list-1">

                                        <span class="domain-search-title">.com</span>

                                        <span class="domain-search-price">₹199/Year</span>

                                    </li>

                                    <li class="domain-list-2">

                                        <span class="domain-search-title">.in</span>

                                        <span class="domain-search-price">₹199/Year</span>

                                    </li>

                                    <li class="domain-list-3">

                                        <span class="domain-search-title">.net</span>

                                        <span class="domain-search-price">₹199/Year</span>

                                    </li>

                                    <li class="domain-list-4">

                                        <span class="domain-search-title">.org</span>

                                        <span class="domain-search-price">₹199/Year</span>

                                    </li>

                                    <li class="domain-list-5">

                                        <span class="domain-search-title">.co</span>

                                        <span class="domain-search-price">₹199/Year</span>

                                    </li> --}}

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

</section>

                @endif
    {{-- </div> --}}