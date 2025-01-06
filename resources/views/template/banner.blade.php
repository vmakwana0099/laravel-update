<div class="banner_section show aos-init" data-aos="fade-up">
    <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">

        {{-- <ul>
            @foreach ($bannerData as $item)
                <li>
                    {{ $item->dasktopSourceUrl }}
                </li>
                <li>
                    {{ $item->varRefURL }}
                </li>
                <li>
                    {{ $item->varBannerVersion }}
                </li>
            @endforeach
        </ul> --}}

        <div class="carousel-inner">
            @if(!empty($bannerData) && count($bannerData)>0)
            <?php $Slide = 1; ?>
            @foreach($bannerData as $index => $bannerImg)
            <?php
            //echo '<pre>';print_r($bannerData);
            if ($Slide == 1) {
                $Banner_Active = "active";
            } else {
                $Banner_Active = "";
            }
            $Full_image = $bannerImg->txtImageName . '.' . $bannerImg->varImageExtension;

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
            }
            else if ($bannerImg->id == 27) {
                $slider_class = "slide1";
                $sliderinner_class = "";
                $Ul_Class = "slider-listing ul-check d-none d-xl-block";
            } else {
                $slider_class = "slide-3";
                $sliderinner_class = "slide3";
                $Ul_Class = "slider-listing height-auto d-none d-xl-block";
            }
            $mobilespecificbanner = '';
            if($uagent == 'mobile'){ $mobilespecificbanner = 'style="height:544px !important;"'; }
            ?>

            <div class="carousel-item {{$Banner_Active}} {{ $slider_class }}" <?php echo $mobilespecificbanner; ?>> 

                @if(!empty($bannerImg->txtImageName) && file_exists(public_path().'/assets/images/'.$bannerImg->txtImageName.'.'.$bannerImg->varImageExtension))
                
                    {{-- Manaual image Path --}}
                    {{-- @if($bannerImg->varBannerVersion == "") --}}

                    <picture>
                        <?php 
                            $imagePathStr = App\Helpers\resize_image::resize($bannerImg->fkIntImgId,1920,636);
                            $imageArr = explode("/",$imagePathStr);
                            $imageArr = end($imageArr);
                            $imagePathStrMobile = Config::get('Constant.CDNURL')."/assets/images/mobile/".$imageArr;
                            $imagePathStrDesktop = Config::get('Constant.CDNURL')."/caches/1920x636_v2/".$imageArr;

                            //$imagePathStrMobile = str_replace("https://beta.hostitsmart.com/caches/1920x636/",Config::get('Constant.CDNURL')."/assets/images/mobile/",$imagePathStr);
                        ?>
                        <source media="(max-width: 767px)" srcset="{!!$imagePathStrMobile!!}">
                        <img src="{!!$imagePathStrDesktop !!}" alt="{{ $bannerImg->varTitle }}" />
                    </picture>
                     @if (isset($bannerImg->varTitle_feature1) && !empty($bannerImg->varTitle_feature1) && $bannerImg->varTitle_feature1 != 'N/A')
                            <div class="carousel-caption container">
                                <div class="slider-box aos-init aos-animate">
                                    <div class="offer d-none d-xl-block">{{$bannerImg->varTagLine}}</div>
                                        @if ($bannerImg->varTitle == 'The Best VPS Hosting')
                                            <h1 class="banner-head">{{$bannerImg->varTitle}}</h1>
                                        @else
                                            <h2 class="banner-head">{{$bannerImg->varTitle}}</h2>
                                        @endif
                                        @if (isset($bannerImg->special_offerTitle) && !empty($bannerImg->special_offerTitle))
                                        <div class="banner-sec-head d-none d-xl-block">{{ $bannerImg->special_offerTitle }}<span class="color-green background-green">{{ $bannerImg->discount_percentage }}% Off</span></div>
                                        @endif
                                        <ul class="{{ $Ul_Class }}">
                                        <li><span class="{{ $bannerImg->varFeature1_iconclass }}"></span>{{ $bannerImg->varTitle_feature1 }}</li>
                                        <li><span class="{{ $bannerImg->varFeature2_iconclass }}"></span>{{ $bannerImg->varTitle_feature2 }}</li>
                                        <li><span class="{{ $bannerImg->varFeature3_iconclass }}"></span>{{ $bannerImg->varTitle_feature3 }}</li>
                                        <li><span class="{{ $bannerImg->varFeature4_iconclass }}"></span>{{ $bannerImg->varTitle_feature4 }}</li>
                                    </ul>
                                    
                                    <div class="col-xl-12">
                                        <div class="row flex-row flex-sm-row-reverse">
                                            @if (isset($bannerImg->special_offertext) && !empty($bannerImg->special_offertext))
                                            <span class="vps-price">
                                                Starting at
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                            <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
                                             <span class="price-500">{{ $bannerImg->special_offertext }}</span>/mo*
                                                @else
                                            <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
                                             <span class="price-500">{{ $bannerImg->special_offertext }}</span>/mo*
                                                @endif
                                            </span>
                                            @endif
                                            <a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>
                                        </div>
                                    </div>
                                    
                                    <p>{!! $bannerImg->txtDescription !!}</p>
                                </div>
                            </div>
                        @endif
                    <div class="carousel-caption container custom-caption_btn">
                            <center>
                            <a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>
                            </center>
                        </div>
                @elseif(empty($bannerImg->txtImageName) && $bannerImg->dasktopSourceUrl !== '' )

                    {{-- From Url image / Video Path --}}

                    @if ($bannerImg->varBannerVersion == "img_banner")
                        <picture>
                            @if($uagent == "mobile")
                            <source media="(max-width: 767px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
                            <source media="(max-width: 768px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
                            <img src="{{ $bannerImg->mobileSourceUrl }}" alt="{{ $bannerImg->varTagLine }}" title="{{ $bannerImg->varTagLine }}" />
                            @else
                            <source media="(max-width: 767px)" srcset="{{ $bannerImg->dasktopSourceUrl }}">
                            <source media="(max-width: 768px)" srcset="{{ $bannerImg->dasktopSourceUrl }}">
                            <img src="{{ $bannerImg->dasktopSourceUrl }}" alt="{{ $bannerImg->varTagLine }}" title="{{ $bannerImg->varTagLine }}" />
                            @endif
                        </picture>
                
                        @if (isset($bannerImg->varTitle_feature1) && !empty($bannerImg->varTitle_feature1) && $bannerImg->varTitle_feature1 != 'N/A')
                            <div class="carousel-caption container">
                                <div class="slider-box aos-init aos-animate">
                                    <div class="offer d-none d-xl-block">{{$bannerImg->varTagLine}}</div>
                                        @if ($bannerImg->varTitle == 'The Best VPS Hosting')
                                            <h1 class="banner-head">{{$bannerImg->varTitle}}</h1>
                                        @else
                                            <h2 class="banner-head">{{$bannerImg->varTitle}}</h2>
                                        @endif
                                        @if (isset($bannerImg->special_offerTitle) && !empty($bannerImg->special_offerTitle))
                                        <div class="banner-sec-head d-none d-xl-block">{{ $bannerImg->special_offerTitle }}<span class="color-green background-green">{{ $bannerImg->discount_percentage }}% Off</span></div>
                                        @endif
                                        <ul class="{{ $Ul_Class }}">
                                        <li><span class="{{ $bannerImg->varFeature1_iconclass }}"></span>{{ $bannerImg->varTitle_feature1 }}</li>
                                        <li><span class="{{ $bannerImg->varFeature2_iconclass }}"></span>{{ $bannerImg->varTitle_feature2 }}</li>
                                        <li><span class="{{ $bannerImg->varFeature3_iconclass }}"></span>{{ $bannerImg->varTitle_feature3 }}</li>
                                        <li><span class="{{ $bannerImg->varFeature4_iconclass }}"></span>{{ $bannerImg->varTitle_feature4 }}</li>
                                    </ul>
                                    
                                     <div class="col-xl-12">
                                        <div class="row flex-row flex-sm-row-reverse">
                                            @if (isset($bannerImg->special_offertext) && !empty($bannerImg->special_offertext))
                                            <span class="vps-price">
                                                Starting at
                                                @if(Config::get('Constant.sys_currency') == 'INR')
                                            <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
                                             <span class="price-500">{{ $bannerImg->special_offertext }}</span>/mo*
                                                @else
                                            <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
                                             <span class="price-500">{{ $bannerImg->special_offertext }}</span>/mo*
                                                @endif
                                            </span>
                                            @endif
                                            <a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>
                                        </div>
                                    </div>
                                    
                                    <p>{!! $bannerImg->txtDescription !!}</p>
                                </div>
                            </div>
                        @endif
                        <?php /*<div class="carousel-caption container custom-caption_btn">
                            <center>
                            <a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>
                            </center>
                        </div> */?>
                    @elseif($bannerImg->varBannerVersion == "vid_banner")
                        @if($uagent == "mobile")
                            @if(strtolower($udevice) != "ipad")
                                    <picture>
                                    <source media="(max-width: 767px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
                                    <source media="(max-width: 768px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
                                    <img src="{{ $bannerImg->mobileSourceUrl }}" alt="{{ $bannerImg->varTagLine }}" title="{{ $bannerImg->varTagLine }}" />
                                    </picture>
                                @else
                                    <?php $ipadurl = str_replace("Mobile","I-Pad",$bannerImg->mobileSourceUrl); $ipadurl = str_replace(".jpg",".mp4",$ipadurl); $ipadurlimg = str_replace("Mobile","I-Pad",$bannerImg->mobileSourceUrl);?>
                                    <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" poster="{{ $ipadurlimg }}">
                                    	<source  src="{{ $ipadurl }}"></source>
                                    </video>
                                @endif   
                            @else
                        <video id="video" muted autoplay="autoplay" loop="loop" style="width:100%;" preload="auto">
                            <source  src="{{ $bannerImg->dasktopSourceUrl }}"></source>
                        </video>
                        @endif
                        <div class="carousel-caption container custom-caption_btn">
                            <center>
                            <a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>
                            </center>
                        </div>

                    @endif
                
                @endif  
                					  
            </div>

            <?php
            $Slide++;
            ?>
            @endforeach
            
            @endif
            @if(!empty($bannerData) && count($bannerData)>1)
            <a class="carousel-control-prev" href="#slider" data-slide="prev" title="prev">
               <span class="arrow-border d-flex justify-content-center"><svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="26px" height="34px"><g><path d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z" fill="#FFFFFF"/></g></svg></span>
            </a>
            <a class="carousel-control-next" href="#slider" data-slide="next" title="next">
               <span class="arrow-border d-flex justify-content-center"><svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="26px" height="34px"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z" fill="#FFFFFF"/></g></svg></span>
            </a>
            @endif
        </div>
    </div></div>