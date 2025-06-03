<div class="banner_section show aos-init" data-aos="fade-down">

<div id="slider" class="carousel slide carousel-fade manual-height-home-banner" data-ride="carousel">



<?php if ($uagent == "mobile") { ?>

		<?php if(strtolower($udevice) == "ipad") { ?>

			<style type="text/css">

				#domain_name-error{

					color:red;

					left: -60%;

					top: 5px;

				}

			</style>

		<?php } else{ ?>

			<style type="text/css">

				#domain_name-error{

					color:red;

					left:20px;

					top: 60px !important;

					position:absolute;				}

			</style>

		<?php } ?>

	<?php }else { ?>

		<style type="text/css">

			#domain_name-error{

				color:red;

				left: -63%;

				top: 5px;

			}

		</style>

	<?php } ?>

<div class="carousel-inner manual-class-carousel-inner-home-banner">

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

            if($uagent == 'mobile'){ $mobilespecificbanner = 'style=""'; }

            ?>

            @if($uagent == "mobile")
				@if(strtolower($udevice) != "ipad")
					{{-- mobile class --}}
					@php $extraBannerClass = "mobile-class" @endphp
				@else
					{{-- ipad class --}}
					@php $extraBannerClass = "ipad-class" @endphp
				@endif  
			@else
				{{-- desktop class --}}
				@php $extraBannerClass = "desktop-class" @endphp
			@endif



<div class="carousel-item {{$Banner_Active}} {{ $slider_class }} {{$extraBannerClass}} {{'banner-item-'.$index}}" <?php echo $mobilespecificbanner; ?>>



	@if(!empty($bannerImg->txtImageName) && file_exists(public_path().'/assets/images/'.$bannerImg->txtImageName.'.'.$bannerImg->varImageExtension))

		@if (isset($bannerImg->varTitle_feature1) && !empty($bannerImg->varTitle_feature1) && $bannerImg->varTitle_feature1 != 'N/A')

			<div class="carousel-caption container">

				<div class="row">

					<div class="slider-box col-xl-7 col-md-6 col-12">

						<div class="align-self-center">

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

								@if (isset($bannerImg->special_offertext) && !empty($bannerImg->special_offertext))

								<span class="vps-price"> Starting at 

									@if(Config::get('Constant.sys_currency') == 'INR')

									<i class="fa fa-inr"></i> 

									<span class="price-500">{{ $bannerImg->special_offertext }}</span>/mo* 

									@else

									<i class="fa fa-inr"></i> 

									<span class="price-500">{{ $bannerImg->special_offertext }}</span>/mo*

									@endif

								</span> 

								@endif

								<a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a> 

							</div>

							<p></p>

							<p><span class="terms-slider d-none d-xl-block">{!! $bannerImg->txtDescription !!}</span></p>

							<p></p>

						</div>

					</div>



					<div class=" col-xl-5 col-md-6 col-12 d-sm-flex d-none justify-content-center" >

							<div class="align-self-center">

								<div class="carousel-caption container custom-caption_btn">

									<center>

									<a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>

									</center>

								</div>

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

							</div>

						</div>



				</div>	

			</div>

		@endif

				

		@elseif(empty($bannerImg->txtImageName) && $bannerImg->dasktopSourceUrl !== '' )



			@if ($bannerImg->varBannerVersion == "img_banner")



				@if (isset($bannerImg->varTitle_feature1) && !empty($bannerImg->varTitle_feature1) && $bannerImg->varTitle_feature1 != 'N/A')

					<div class="carousel-caption container">

						<div class="row">

							<div class="slider-box col-xl-7 col-md-6 col-12">

								<div class="align-self-center">

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

										@if (isset($bannerImg->special_offertext) && !empty($bannerImg->special_offertext))

										<span class="vps-price"> Starting at 

											@if(Config::get('Constant.sys_currency') == 'INR')

											<i class="fa fa-inr"></i> 

											<span class="price-500">{{ $bannerImg->special_offertext }}</span>/mo* 

											@else

											<i class="fa fa-inr"></i> 

											<span class="price-500">{{ $bannerImg->special_offertext }}</span>/mo*

											@endif

										</span> 

										@endif

										<a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a> 

									</div>

									<p></p>

									<p><span class="terms-slider d-none d-xl-block">{!! $bannerImg->txtDescription !!}</span></p>

									<p></p>

								</div>

							</div>



							<div class=" col-xl-5 col-md-6 col-12 d-sm-flex d-none justify-content-center" >

								<div class="align-self-center">

									<div class="carousel-caption container custom-caption_btn">

										<?php /*<center>

										<a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>

										</center> */ ?>

									</div>

									<picture>

										<?php $bannerImg->mobileSourceUrl = "https://d1neo0gtmjcot5.cloudfront.net/assets/images/banner-vactor.png"; ?>

										<?php $bannerImg->dasktopSourceUrl = "https://d1neo0gtmjcot5.cloudfront.net/assets/images/banner-vactor.png"; ?>

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

								</div>

							</div>



						</div>	

					</div>

				@endif



			@elseif($bannerImg->varBannerVersion == "vid_banner")

					@if($uagent == "mobile")

						@if(strtolower($udevice) != "ipad")
						<!-- for mobile -->
						{{-- <picture>
							<source media="(max-width: 767px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
							<source media="(max-width: 768px)" srcset="{{ $bannerImg->mobileSourceUrl }}">
							<img src="{{ $bannerImg->mobileSourceUrl }}" alt="{{ $bannerImg->varTagLine }}" title="{{ $bannerImg->varTagLine }}" />
						</picture> --}}

						<div class="carousel-caption container">
						<div class="row h-100 justify-content-center align-items-center">
						<div class="col-sm-12">
						<div class="valentine-banner-main">
						<div class="vbm-one" title="Your Website is Incomplete Without Hosting">Your Website is Incomplete<br />
						Without Hosting</div>

						<div class="vbm-two" title="Leave the matchmaking to Host IT Smart">Leave the matchmaking<br />
						to Host IT Smart</div>

						<div class="vbm-six"><a class="btn-primary cstm-banner-btn" href="{{ URL::to('/?scrollto=serviceDiv1') }}" title="SHOP NOW">SHOP NOW</a></div>
						</div>
						</div>
						</div>
						</div>

						@else
						<!-- for ipad -->
							<?php $ipadurl = str_replace("Mobile","I-Pad",$bannerImg->mobileSourceUrl); 

                            $ipadurlimg = str_replace("Mobile","I-Pad",$bannerImg->mobileSourceUrl);

                            $ext = pathinfo($bannerImg->ipadSourceUrl, PATHINFO_EXTENSION); ?>

							

                            @if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif" )

                            	{{-- <picture>
                                	<source media="(max-width: 767px)" srcset="{{ $bannerImg->ipadSourceUrl }}">
                                    <source media="(max-width: 768px)" srcset="{{ $bannerImg->ipadSourceUrl }}">
                                    <img src="{{ $bannerImg->ipadSourceUrl }}" alt="{{$bannerImg->ipadSourceUrl}}" title="{{ $bannerImg->varTagLine }}" />
                                </picture> --}}

                                <div class="carousel-caption container">
								<div class="row h-100 justify-content-center align-items-center">
								<div class="col-sm-12">
								<div class="valentine-banner-main">
								<div class="vbm-one" title="Your Website is Incomplete Without Hosting">Your Website is Incomplete<br />
								Without Hosting</div>

								<div class="vbm-two" title="Leave the matchmaking to Host IT Smart">Leave the matchmaking<br />
								to Host IT Smart</div>

								<div class="vbm-six"><a class="btn-primary cstm-banner-btn" href="{{ URL::to('/?scrollto=serviceDiv1') }}" title="SHOP NOW">SHOP NOW</a></div>
								</div>
								</div>
								</div>
								</div>


                            @elseif($ext == "mp4" || $ext == "m4v" )

                                <?php $ipadurl = str_replace(".jpg",".m4v",$ipadurl); ?>

                                <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" alt="{{$bannerImg->ipadSourceUrl}}" poster="{{ $bannerImg->ipadSourceUrl }}">

                                    <source  src="{{ $bannerImg->ipadSourceUrl }}"></source>

                                </video>

                            @endif 

						@endif   

					@else
						<?php $_ext = pathinfo($bannerImg->dasktopSourceUrl, PATHINFO_EXTENSION) ?>
						@if($_ext == "jpg" || $_ext == "png" || $_ext == "jpeg" || $_ext == "gif" )
						<!-- for desktop -->

	                        {{-- <picture>
	                        	<source media="(max-width: 767px)" srcset="{{ $bannerImg->dasktopSourceUrl }}">
	                            <source media="(max-width: 768px)" srcset="{{ $bannerImg->dasktopSourceUrl }}">
	                            <img src="{{ $bannerImg->dasktopSourceUrl }}" alt="{{$bannerImg->dasktopSourceUrl}}" title="{{ $bannerImg->varTagLine }}" />
							</picture> --}}

							<div class="carousel-caption container">
							<div class="row h-100 justify-content-center align-items-center">
							<div class="col-sm-12">
							<div class="valentine-banner-main">
							<div class="vbm-one" title="Your Website is Incomplete Without Hosting">Your Website is Incomplete<br />
							Without Hosting</div>

							<div class="vbm-two" title="Leave the matchmaking to Host IT Smart">Leave the matchmaking<br />
							to Host IT Smart</div>

							<div class="vbm-six"><a class="btn-primary cstm-banner-btn" href="{{ URL::to('/?scrollto=serviceDiv1') }}" title="SHOP NOW">SHOP NOW</a></div>
							</div>
							</div>
							</div>
							</div>
							
	                    @elseif($_ext == "mp4" || $_ext == "m4v" )
	                        <video id="video" muted autoplay="autoplay" loop="loop" controls="true" style="width:100%;" preload="auto" alt="{{$bannerImg->dasktopSourceUrl}}" poster="{{ $bannerImg->dasktopSourceUrl }}">
	                            <source  src="{{ $bannerImg->dasktopSourceUrl }}"></source>
	                        </video>
	                    @endif
					<?php /* <div class="carousel-caption container custom-caption_btn">

						<center>

						<a class="btn-primary" style="left: -133%;bottom: -128px;" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>

						</center>

					</div> */ ?> 
					@endif
					@if($bannerImg->varBannerVersion == "vid_banner")
						{{-- <a class="btn-primary" id="btncustomcss" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>  --}}
					@endif
					<!-- <div class="carousel-caption container custom-caption_btn">
						<center>
						<a class="btn-primary" href="{{ $bannerImg->VarButtonLink }}" title="{{ $bannerImg->VarButtonText }}">{{ $bannerImg->VarButtonText }}</a>
						</center>
					</div> --> 
			@endif
	@endif
</div>



<?php

$Slide++;

?>

@endforeach



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

		@endif

			

	</div>



	@if(request()->route()->getName() == 'home')

				<div class="searchdomain_div aos-init" data-aos="fade-up" data-aos-delay="100">

						<div class="container">

							<div class="row flex-row row_bg">

								<div class="col-xl-5 col-12">

									<h2>Search your <br>perfect domain name</h2>

									

								</div>

								<div class="col-xl-7 col-12">

									<form id="domainlookupfrm" onsubmit="margetlds()" autocomplete="off" name="domainlookupfrm" action="{{url('/domain-checker')}}" method="post">

									<div class="form-group aos-init" data-aos="fade-left" data-aos-delay="800">

											<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>

											<input type="hidden" name="hide_tlddata" id="hide_tlddata" value="{{$Tlds}}" />

											<input type="hidden" name="domain_search" id="domain_search" value="y" />

											<input type="text" class="form-control" placeholder="Search for your perfect domain..." id="domain_name" name="domainname">

											<select name="selcetlds" id="selcetlds" class="form-control selectpicker" data-show-content="true">	

												<option value="com">.com</option>

												<option value="info">.info</option>

												<option value="org">.org</option>

												<option value="in">.in</option>

												<option value="net">.net</option>

												<option value="co.in">.co.in</option>

											</select>

										<button class="btn domain_error" type="submit" title="Search Now">Search Now</button>

									</div>



									<?php /* Start Search tlds with select option marge code */ ?>

									<script type="text/javascript">

										function margetlds(){selectedtlds = $("#selcetlds").val();$domainname = $("#domain_name").val();

											if($domainname != '' ){ if ($domainname.indexOf(".") == "-1") {$finaldoaminname = $domainname+"."+selectedtlds;}else{$finaldoaminname = $domainname;}}$("#domain_name").val($finaldoaminname);

										}

									</script>

									<?php /* End Search tlds with select option marge code */ ?>

	

									@if(isset($FeaturedTlds))

									@if(count($FeaturedTlds)>0)

									<ul class="domain_list aos-init" data-aos="fade-right" data-aos-delay="800">

										@foreach($FeaturedTlds as $tlddata)

											<li>

											<a href="{{url('/domain').'/'.$tlddata->varAlias}}" title="{{$tlddata->varTitle}}">.{{$tlddata->varTitle}}

											<span>

												@if(Config::get('Constant.sys_currency') == 'INR')

													<i class="fa fa-inr"></i> {{ Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_INR') }}

												@else

													<i class="fa fa-inr"></i> {{ Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_USD') }}

												@endif

											</span>

											</a>

											</li>

										@endforeach

									</ul>

									@endif

									@endif

								</form>	

								</div>

							</div>

						</div>

					</div>

				@endif
	</div>

