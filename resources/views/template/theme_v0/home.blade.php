@if(!empty($productData) && count($productData) >0)
<div class="services_section">
    <div class="container">
        <h3 class="service-main-title col-12 aos-init"  data-aos="fade-up">
            Whether a start-up or a giant<span class="and">,</span> <span class="green">our hosting services have you covered</span>
        </h3>
        <div class="short_desc aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">No matter what you do, taking a business online is not an easy job. We know that, and so, we promise to take on the most frustrating part - taking care of your website hosting needs, and calibrating, as your business evolves. Leave the tech-dirty lot to us, and set yourself free for the more important things.<br/><br/></div>
        <div class="row">
            @php $i = 1; $show = '';  @endphp 
            @foreach($productData as $value)
            @if($i == 1)
            @php $show = 100;  @endphp 
            @elseif($i == 2 )
            @php $show = 300;  @endphp 
            @elseif($i == 3 )
            @php $show = 600;  @endphp 
            @elseif($i == 4 )
            @php $show = 100;  @endphp 
            @elseif($i == 5 )
            @php $show = 300;  @endphp 
            @elseif($i == 6 )
            @php $show = 600;  @endphp 
            @endif
            <div class="service1 col-lg-4 col-6 d-flex justify-content-center">
                <div class="services-main align-self-center aos-init" data-aos="fade-up" data-aos-delay="{{$show}}">
                    <div class="services-icon aos-init" data-aos="flipaos">
                        <i class="s-icon {{$value->varListingIconClass}}"></i>
                    </div>
                    <h4><a class="services-head" href="{{url($value->productCatAlias.'/'.$value->productAlias)}}">{{$value->varTitle}}</a></h4>
                    <div class="services-text d-none d-sm-block">{!! nl2br(e($value->txtHomePageDesc)) !!}</div>
                    <p class="starting">Starting At</p>
                    <div class="price" title="{{$value->varWHMCSFieldName.'_INR'}}">
                        @if(Config::get('Constant.sys_currency') == 'INR')
                        <i class="rupees_ico">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.'.$value->varWHMCSFieldName.'_INR') }}
                        @else
                        <i class="rupees_ico">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.'.$value->varWHMCSFieldName.'_USD') }}
                        @endif
                        <span class="">/month&nbsp;*</span>
                    </div>
                    <button class="btn-primary" title="Get Started" onclick="window.location.href='{{url($value->productCatAlias.'/'.$value->productAlias)}}';">Get Started</button>
                </div>
            </div>
            @php $i++; @endphp
            @endforeach
        </div>
    </div>
</div>
@endif
<?php /*@if(!empty($newsData) && count($newsData) >0)
<div class="business_section"> 
    <div class="container">
        <div class="row">
            <p class="business-main-title col-12 aos-init" data-aos="fade-up">Latest <span class="green">News</span></p>
            <div class="owl-carousel owl-theme aos-init" data-aos="fade-up" id="business-owl">
                @foreach($newsData as $newsvalue)
                <div class="item col">
                    <div class="business-full">
                        <div class="business-image">	
                            <div class="thumbnail-container">
                                <div class="thumbnail">
                                    <a href="{{url('news/'.$newsvalue->varAlias)}}" title="{{$newsvalue->varTitle}}">
                                        @if(!empty($newsvalue->txtImageName) && file_exists(public_path().'/assets/images/'.$newsvalue->txtImageName.'.'.$newsvalue->varImageExtension))
                                        <img src="{!! App\Helpers\resize_image::resize($newsvalue->fkIntImgId,310,310) !!}" alt="{{ $newsvalue->varTitle }}" />
                                        @else
                                        <img src="{{Config::get('Constant.CDNURL')}}/assets/images/slider-icon/busines1.jpg" alt="{{ $newsvalue->varTitle }}" />
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="business-text">
                            <a class="business-head" href="{{url('news/'.$newsvalue->varAlias)}}" title="{{$newsvalue->varTitle}}">
                                @if(strlen($newsvalue->varTitle) > 42) 
                                    {{  substr($newsvalue->varTitle,0, 42).'...'}}
                                @else
                                    {{ $newsvalue->varTitle }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif */?>
 @if(!empty($testimonialData) && count($testimonialData) >0)
<div class="testomonial-section d-flex">
    <div class="container align-self-center">
        <div class="row">
            <div class="col-12">
                <h5 class="testomonial-head aos-init" data-aos="fade-up">WHAT OUR HOSTING CUSTOMERS <span class="c-blue">SAY</span></h5>
                <div class="owl-carousel owl-theme" id="testomonial-owl1">
                    @foreach($testimonialData as $testimonialvalue)
                    <div class="item cms col aos-init" data-aos="fade-up">
                        <div class="features-icon">
                          <?php  
                          /*@if(!empty($testimonialvalue->fkIntImgId))
                            <img src="{!! App\Helpers\resize_image::resize($testimonialvalue->fkIntImgId,134,134) !!}" alt="{{ $testimonialvalue->varTitle }}" title="{{ $testimonialvalue->varTitle }}" />
                            @else
                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/testimonial-m.svg" alt="{{ $testimonialvalue->varTitle }}" title="{{ $testimonialvalue->varTitle }}" />
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
<div class="support-section">
    <div class="container">    
        <div class="row row flex-sm-row-reverse flex-row-reverse flex-row">
            <div class="col-lg-5 col-sm-12 col-12">
                <div class="support-text1">
                    <div class="support-head aos-init" data-aos="fade-up" data-aos-delay="100">
                        {{$contactData->varHomePageTitle}}
                    </div>
                    <div class="support-text aos-init" data-aos="fade-up" data-aos-delay="120">
                        {!! nl2br(e(str_limit($contactData->varHomePageDescription, 150))) !!}
                    </div>
                    <div class="support-call aos-init" data-aos="fade-up" data-aos-delay="140">
                        <a href="tel:{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}" title="" class="support-links">{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }} </a> <span class="open_hours">{{$contactData->varOpenHours}}</span>
                    </div>
                    <div class="support-call support-mail aos-init" data-aos="fade-up" data-aos-delay="160">
                        <a href="mailto:{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varEmail) }}" title="{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varEmail) }}" class="support-links">{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varEmail) }}</a>
                    </div>
                    @if(null!==(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) && strlen(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) > 0)
                    <div class="support-call support-whatsapp aos-init" data-aos="fade-up" data-aos-delay="160">
						<a href="{{Config::get('Constant.SOCIAL_WHATSAPP_LINK')}}" title="Whatsapp Support" target="_blank" class="support-links">Whatsapp Support</a>
					</div>
					@endif
					<div class="support-call support-pin aos-init" data-aos="fade-up" data-aos-delay="160">
                        <p class="support-links">
                            {!! nl2br(e($contactData->varSchemaAddress)) !!}
                        </p>
                    </div>
                    <a title="Contact Support" href="{{url('/contact')}}" class="btn aos-init" data-aos="fade-up" data-aos-delay="200" title="Contact Support">Contact Support</a>
                    <a target="_blank" title="Submit Ticket" href="https://www.hostitsmart.com/manage/submitticket.php" class="btn aos-init" data-aos="fade-up" data-aos-delay="200" title="Submit Ticket">Submit Ticket</a>
                </div>
            </div>
            <div class="col-lg-7 col-sm-12 col-12 d-none d-md-block">
                <div class="support-image aos-init" data-aos="fade-right" data-aos-delay="500">
                    <div class="contact-image">
                        <img src="{{Config::get('Constant.CDNURL')}}/assets/images/slider-icon/contact_img_v2.png" alt="support" />
                        <div class="contact-call">	
                            <div class="call-1-support"></div>
                            <div class="waves-block">
                                <div class="waves wave-1"></div> <div class="waves wave-2"></div> <div class="waves wave-3"></div> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="partners-section">
    <div class="container"> 
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12"><p class="partners-title aos-init" data-aos="fade-up">Associated  <span class="c-blue">With</span></p></div>
<?php /*<div class="col-4 col-sm-4 col-md-2"> <a href="javascript:void(0);" title="GOOGLE GSUITE PARTNER" target="_blank"><img src="assets/images/partners_googlegsuite.png" alt="Google Gsuite Partner"/></a> </div>
<div class="col-4 col-sm-4 col-md-2"> <a href="javascript:void(0);" title="MICROSOFT PARTNER" target="_blank"><img src="assets/images/partners_microsoft.png" alt="MICROSOFT PARTNER"/></a> </div>*/?>
<div class="col-4 col-sm-4 col-md-2"> <a href="https://aws.amazon.com/partners/find/results/?keyword=Netclues" title="AMAZON PARTNER" rel="nofollow" target="_blank"><img src="assets/images/partners_amazonwebservice.png" alt="AMAZON PARTNER"/></a> </div>
<div class="col-4 col-sm-4 col-md-2"> <a href="http://www.cpanel.net/partners/partner-info.cgi?cid=3101" title="CPANEL PARTNER" rel="nofollow" target="_blank"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/partners_cpanel_v2.png" alt="Cpanel Partner"/></a></div>
<div class="col-4 col-sm-4 col-md-2"> <a href="http://centos-webpanel.com/noc-partner-list" title="CWP PARTNER" rel="nofollow" target="_blank"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/partners_cwp_v2.png" alt="CWP Partner"/></a></div>
<div class="col-4 col-sm-4 col-md-2"> <a href="https://www.domainbrothers.com/" title="Domain Brothers" rel="nofollow" target="_blank"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/Domain-Brothers_v2.png" alt="Domain Brothers"/></a> </div>
<div class="col-4 col-sm-4 col-md-2"> <a href="https://www.icann.org/search/#!/?searchText=Netclues" title="ICANN" rel="nofollow" target="_blank"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/partners_icann_v2.png" alt="icann"/></a> </div>
    </div> 
</div>
</div>
@include('template.review')
<?php

/*<div class="review">
    <div class="row">
        <div class="col-sm-3">
            <div class="review-l" data-aos="fade-right">
                <p class="review-title">8.8</p>
                <div class="review-star">
                    <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                <div class="review-text">
                    Based on 63 reviews 
                    See some of the reviews here.
                </div>
                <div class="trustpilot-image">
                    <a target="_blank" href="https://hostadvice.com/hosting-company/host-smart-reviews/"><img alt="hostadvice" title="hostadvice" src="{{Config::get('Constant.CDNURL')}}/assets/images/logo-2.png"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="owl-carousel owl-theme" id="review-owl">
                <div class="item col" data-aos="zoom-in" data-aos-delay="100">
                    <div class="review-slider">
                        <div class="review-l">
                            <p class="review-title">4.4</p>
                            <div class="review-star">
                                <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                            <div class="review-text">
                                Based on 143 reviews 
                                See some of the reviews here.
                            </div>
                            <div class="trustpilot-image">
                                <a target="_blank" href="https://www.google.com/search?num=100&rlz=1C1AVNE_enIN715IN715&ei=2YkXXMeSJ5T_wAOB6ZX4AQ&q=host+it+smart&oq=host+it+smart&gs_l=psy-ab.3..0l3j0i22i30l7.1080.3046..3688...0.0..0.238.2460.0j9j4......0....1..gws-wiz.......0i71j0i131j0i67j0i10j0i131i67.oxHhcjMtoSY#lrd=0x395e84d7c974bd5f:0x91cf8c25003fbd01,1,,"><img alt="google" title="google" src="{{Config::get('Constant.CDNURL')}}/assets/images/googlelogo-1_v2.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item col" data-aos="zoom-in" data-aos-delay="200">
                    <div class="review-slider">
                        <div class="review-l">
                            <p class="review-title">4.6</p>
                            <div class="review-star">
                                <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                            <div class="review-text">
                                Based on 235 reviews 
                                See some of the reviews here.
                            </div>
                            <div class="trustpilot-image">
                                <a target="_blank" href="https://www.facebook.com/pg/hostitsmart/reviews/?ref=page_internal"><img alt="facebook" title="facebook" src="{{Config::get('Constant.CDNURL')}}/assets/images/facebook-logo-1_v2.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item col" data-aos="zoom-in" data-aos-delay="300">
                    <div class="review-slider">
                        <div class="review-l">
                            <p class="review-title">8.8</p>
                            <div class="review-star">
                                <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                            <div class="review-text">
                                Based on 45 reviews 
                                See some of the reviews here.
                            </div>
                            <div class="trustpilot-image">
                                <a target="_blank" href="https://www.trustpilot.com/review/www.hostitsmart.com"><img alt="trustpilot" title="trustpilot" src="{{Config::get('Constant.CDNURL')}}/assets/images/trustpilot_v2.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>*/

?>