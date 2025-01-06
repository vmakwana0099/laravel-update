@extends('layouts.app')
@section('content')
@include('layouts.inner_banner') 
<div class="inner_container cms">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                {!!$CONTENT!!}
            </div>
        </div>
    </div>
</div>
<div class="whyhits-div">
    <?php /* <div class="help_div cms">
      <div class="container">
      <div class="row">
      <div class="col-md-12">
      <img src="{{ url('/') }}/assets/images/why-hits.png" alt="We are always here to help you!" data-aos="zoom-in-up">
      <div data-aos="fade-left" data-aos-delay="300">
      <h2 title="Quality hosting, now made affordable">Quality hosting, now made <span>affordable</span></h2>
      <p>Host IT Smart has been responsible for impeccable web hosting services since it was set up years back. Timeless experience gives us the capacity to serve our customers like no one else. After having faced years of grilling challenges, we are experts at it today.</p>
      <p>It is not at all easy to host a website and keep it up and going throughout years together without a complaint ringing against our name. But then, that is what our uniqueness is! We stand for excellence when it comes to uninterrupted and flawless web hosting services.</p>
      <p>Host IT Smart has been responsible for impeccable web hosting services since it was set up years back. Timeless experience gives us the capacity to serve our customers like no one else. After having faced years of grilling challenges, we are experts at it today.</p>
      <p>It is not at all easy to host a website and keep it up and going throughout years together without a complaint ringing against our name. But then, that is what our uniqueness is! We stand for excellence when it comes to uninterrupted and flawless web hosting services.</p>
      </div>
      </div>
      </div>
      </div>
      </div> */ ?>
    <div class="Hits_advantages">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 data-aos="fade-left">The <span>{{ Config::get('Constant.SITE_NAME') }}</span> edge</h2>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme why-hits-owl-crsl">
                        <div class="item">
                            <div class="advantage_box" data-aos="fade-up" data-aos-delay="100">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <i class="support-icon"></i>
                                </div>
                                
                                <h3 title="Round the clock support">Round the clock support</h3>
                                <div class="info">
                                    Yeah, we know all of them say that. But here’s the catch. We locate your tech hiccups and fix them within an hour! Promise!
                                </div>

                            </div>
                        </div>
                        <div class="item">
                            <div class="advantage_box" data-aos="fade-up" data-aos-delay="600">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <i class="uptime-icon"></i>
                                </div>
                                
                                <h3 title="99.99% uptime">99.99% uptime</h3>
                                <div>  
                                <div class="info">
                                    Your website is hosted at local server locations. So you get speed, resilience and yes, uninterrupted uptime.
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="item">
                            <div class="advantage_box" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <i class="cheapest-icon"></i>
                                </div>
                                <h3 title="A modern website builder">A modern website builder</h3>
                                <div class="info">
                                    And that’s for free! You just don’t need to worry about finding a template, or a developer anymore. We got that sorted.
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="advantage_box" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <i class="website-builder"></i>
                                </div>
                                <h3 title="Unparalleled affordability">Unparalleled affordability</h3>
                                <div class="info">
                                    We won’t say we are the cheapest, but the best never comes the cheapest, does it? We however, smoothen things for your pocket.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php /* <div class="domain_main">
        <div class="what-we-offer" data-type="background" data-speed="7">
            <div class="container">
                <div class="offer-tabbing">
                    <h5 class="" data-aos="fade-up">What We Offer</h5>
                    <ul class="nav nav-pills nav-offer justify-content-center " data-aos="fade-up">
                        <li><a data-toggle="pill" href="#offer1" class="justify-content-center active" title="CodeGuard"><span class="bg-white-tab"><i class="offer-1-icon align-self-center"></i></span><span class="offer-tabbing-name">CodeGuard</span></a></li>
                        <li><a data-toggle="pill" href="#offer2" class="justify-content-center" title="Site Lock"><span class="bg-white-tab"><i class="offer-1-icon offer-2-icon align-self-center"></i></span><span class="offer-tabbing-name">Site Lock</span></a></li>
                        <li><a data-toggle="pill" href="#offer3" class="justify-content-center" title="G Suite"><span class="bg-white-tab"><i class="offer-1-icon offer-3-icon align-self-center"></i></span><span class="offer-tabbing-name">G Suite</span></a></li>
                        <li><a data-toggle="pill" href="#offer4" class="justify-content-center" title="Domain Privacy"><span class="bg-white-tab"><i class="offer-1-icon offer-4-icon align-self-center"></i></span><span class="offer-tabbing-name">Domain Privacy</span></a></li>
                    </ul>
                    <div class="tab-content aos-init" data-aos="fade-up" data-aos-delay="250">
                        <div id="offer1" class="tab-pane active show">
                            <div class="offer-tab-text" data-aos="fade-up">
                                <h3 >CodeGuard</h3>
                                <p>CodeGuard is the fastest and most reliable website backup service. It keeps a track of daily changes made on your website so that you never lose a fraction of your data.</p>
                                <span>Available for purchase at checkout</span>
                                <a class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a>
                            </div>
                        </div>
                        <div id="offer2" class="tab-pane">
                            <div class="offer-tab-text" data-aos="fade-up">
                                <h3>Site Lock</h3>
                                <p>The SiteLock SMART will continuously monitor your website from all angles, and if malware is detected, it will automatically remove it, so your website stays safe and secure.</p>
                                <span>Available for purchase at checkout</span>
                                <a class="btn-primary" title="Checkout" data-aos="fade-up" data-aos-delay="250">Checkout</a>
                            </div>
                        </div>
                        <div id="offer3" class="tab-pane">
                            <div class="offer-tab-text" data-aos="fade-up">
                                <h3 >G Suite</h3>
                                <p>We are proud to introduce google cloud for your business, enabling you to connect, create, access and control you work all in one suite.</p>
                                <span>Available for purchase at checkout</span>
                                <a class="btn-primary" title="Checkout">Checkout</a>
                            </div>
                        </div>
                        <div id="offer4" class="tab-pane">	
                            <div class="offer-tab-text" data-aos="fade-up">
                                <h3>Domain Privacy</h3>
                                <p>When you buy a domain, the registrant information will be stored in whois database which can be accessed globally. The domain privacy will mask the original contact information and thus, save you from unwanted marketing calls.</p>
                                <span>Available for purchase at checkout</span>
                                <a class="btn-primary" title="Checkout">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>*/?>

    <?php /* <div class="vps-plan-main">
      <div class="container">
      <div class="plan-div">
      <h2 class="vps-plan-title aos-init" data-aos="fade-up">It's hard to find a match to compare us but lets try anyway...</h2>
      <span class="plan-second-title aos-init" data-aos="fade-up">Better Pricing • Fast SSD Storage • Hack-free Protection • Real 24/7 Technical Support</span>
      <div class="row row-posi">
      <div class="white-overlay d-md-none d-block">
      <a href="javascript:void(0)" data-role="scroll-to-next" class="overlay_link">
      <i class="la la-angle-double-right"></i>
      </a>
      </div>
      <div class="table-relative aos-init" data-aos="fade-left" data-aos-easing="ease-out-back" data-aos-delay="600">
      <table class="table-plan-vps">
      <tr>
      <th class="title bg-none"></th>
      <th class="title"><img src="{{ url('/') }}/assets/images/logo.png" class="hostitsmart-logo"></th>
      <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/fast-comet.png"></th>
      <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/godaddy.png"></th>
      <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/bluehost.png"></th>
      <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/hoster-gator.png"></th>
      <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/inmotion.png"></th>
      </tr>
      <tr>
      <td class="boldfonts">Regular Price</td>
      <td class="bg_blue"><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">49</span><span class="per-month">/mo</span></span></td>
      <td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">99</span><span class="per-month">/mo</span></span></td>
      <td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">199</span><span class="per-month">/mo</span></span></td>
      <td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">399</span><span class="per-month">/mo</span></span></td>
      <td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">149</span><span class="per-month">/mo</span></span></td>
      <td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">299</span><span class="per-month">/mo</span></span></td>
      </tr>
      <tr>
      <td class="boldfonts">SSD Only servers</td>
      <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
      <td><i class="fa fa-check-circle"></i></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      </tr>
      <tr>
      <td class="boldfonts bg-blue-color">RocketBooster</td>
      <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
      <td class="bg-blue-color"><span class="sprite-image cancel-ic"></span></td>
      <td class="bg-blue-color"><span class="sprite-image cancel-ic"></span></td>
      <td class="bg-blue-color"><i class="fa fa-check-circle"></i></td>
      <td class="bg-blue-color"><span class="sprite-image cancel-ic"></span></td>
      <td class="bg-blue-color"><i class="fa fa-check-circle"></i></td>

      </tr>
      <tr>
      <td class="boldfonts">Web Application Firewall</td>
      <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
      <td>Paid</td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td>Paid</td>
      <td><i class="fa fa-check-circle"></i></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      </tr>
      <tr>
      <td class="boldfonts">Free Daily Backups</td>
      <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
      <td>Paid</td>
      <td>Paid</td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td>Paid</td>
      </tr>
      <tr>
      <td class="boldfonts">Cloudflare CDN Caching</td>
      <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><i class="fa fa-check-circle"></i></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      </tr>
      <tr>
      <td class="boldfonts">Instant chat response</td>
      <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><i class="fa fa-check-circle"></i></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      <td><span class="sprite-image cancel-ic"></span></td>
      </tr>
      <tr class="block">
      <td colspan="7" style="visibility:hidden;"></td>
      </tr>
      <tr class="last-row">
      <td class="boldfonts"></td>
      <td class="border-radius"><a href="javascript:void(0)">See Plans</a></td>
      <td><a href="{{url('/')}}/fastcomet-alternative">Compare <span class="d-none d-xl-block">Head to Head</span></a></td>
      <td><a href="{{url('/')}}/godaddy-alternative">Compare <span class="d-none d-xl-block">Head to Head</span></a></td>
      <td><a href="{{url('/')}}/bluehost-alternative">Compare <span class="d-none d-xl-block">Head to Head</span></a></td>
      <td><a href="{{url('/')}}/hostgator-alternative">Compare <span class="d-none d-xl-block">Head to Head</span></a></td>
      <td><a href="{{url('/')}}/inmotion-alternative">Compare <span class="d-none d-xl-block">Head to Head</span></a></td>
      </tr>
      </table>
      </div>
      </div>
      </div>
      </div>
      </div> */ ?>
{{-- @include('template.review') --}}
<section class="affiliate_rating_sec">
<div class="container">
<h2>Ratings By Host IT Smart Clients on Renowned Platform</h2>

<div class="row">
<div class="col-lg-12">
<div class="hm-bnnr-cstmr-rtg">
<div class="cstmr-rtg-main cst-rtg-hostadvice">
<div class="cst-rtg-tittle"><img alt="hostadvice" src="../assets/images/Homepage/hostadvice-logo.png"></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"></div>

<div class="cst-rtg-data">
<p>4.2 Ratings</p>
</div>
</div>

<div class="cstmr-rtg-main cst-rtg-trustpilot">
<div class="cst-rtg-tittle"><img alt="trustpilot" src="../assets/images/Homepage/trustpilot-logo.png"></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"></div>

<div class="cst-rtg-data">
<p>4.3 Ratings</p>
</div>
</div>

<div class="cstmr-rtg-main cst-rtg-google">
<div class="cst-rtg-tittle"><img alt="google" src="../assets/images/Homepage/google-logo.png"></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"> <img alt="star-icon" src="../assets/images/Homepage/star-icon.png"></div>

<div class="cst-rtg-data">
<p>4.4 Ratings</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
    <div class="help_div cms">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade-left" data-aos-delay="300">
                        <h2 class="text-center" title="Quality hosting, now made affordable">We are obsessed <span>with safety</span></h2>
                        <p>Well, we are sort of proud of it. Your data, and your customers’ privacy are super important to us. We are stringent about hosting security standards, and all our hosting solutions are made secure with SSL certifications. </p>
                        <p><a href="/ssl-certificates" class="btn" title="Know more about SSL certification">Know more about SSL certification</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="help_div cms">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div data-aos="fade-left" data-aos-delay="300">
                            <h2 title="Quality hosting, now made affordable">Awards for hosting <span>excellence:</span></h2>
                            <p><img src="{{ url('/') }}/assets/images/hosting-certificates.png"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    <div class="award-partners">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Awards for hosting <span>excellence:</span></h2>
                </div>
                <div class="col-sm-12">
                    <div class="award-outter">
                        <div class="award-box">
                            <img src="{{ url('/') }}/assets/images/award1.jpg" alt="Global Cloud Xchange Partner"/>
                        </div>
                        <div class="award-box">
                            <img src="{{ url('/') }}/assets/images/award2.jpg" alt="Google Partner"/>
                        </div>
                        <div class="award-box">
                            <img src="{{ url('/') }}/assets/images/award3.jpg" alt="ICANN Accredited Registrar"/>
                        </div>
                        <div class="award-box">
                            <img src="{{ url('/') }}/assets/images/award4.jpg" alt="Microsoft Partner"/>
                        </div>
                        <div class="award-box">
                            <img src="{{ url('/') }}/assets/images/award5.jpg" alt="SAS70 Certified DATACENTER">
                        </div>
                        <div class="award-box">
                            <img src="{{ url('/') }}/assets/images/award6.jpg" alt="cPanel Authorized Partner"/>
                        </div>
                        <div class="award-box">
                            <img src="{{ url('/') }}/assets/images/award7.jpg" alt="Symantec SECURE ONE Partner"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty($testimonialData) && count($testimonialData) >0)
<div class="testomonial-section d-flex">
    <div class="container align-self-center">
        <div class="row">
            <div class="col-12">
                <h2 class="testomonial-head aos-init" data-aos="fade-up">People are talking about us. <span class="c-blue">Here’s what they have to say!</span></h2>
                <div class="owl-carousel owl-theme" id="testomonial-owl1">
                    @foreach($testimonialData as $testimonialvalue)
                    <div class="item cms col aos-init" data-aos="fade-up">
                        <div class="features-icon">
                         <?php
                           /* @if(!empty($testimonialvalue->fkIntImgId))
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
<div class="product_offers">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="product_offers_main">
                    <div class="product_offers_head">
                        <h2>VPS Hosting</h2>
                    </div>
                    <div class="product_offers_cnt">
                        <div class="product_offers_price">
                            <ul>
                            <li class="product_offers_prc_head">Starting From</li>
                            <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>{{Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_INR')}}<span class="month_icon">/mo*</span></li>
                            </ul>
                        </div>
                    </div>
                        <div class="product_offers_btn">
                            <a href="{{ url('/servers/vps-hosting') }}">Click to Host Today</a>
                        </div>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
{{-- <div class="lading_bottom">
<div class="promotion_div">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="row justify-content-end">
                        <div class="limited-promotion">
                            <span class="" data-aos="fade-left">Managed <br/>VPS <br/>Hosting</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 padding-0">
                    <div class="new_customer">
                        <div class="offer-promo-img" data-aos="zoom-in">
                            <span class="offer-text">80% <span>Off</span>
                            </span>
                        </div>
                        <div class="combine-div">
                            <span class="offer">Special offer on VPS<br></span>
                            <div class="price-part">
                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                    <span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_INR') }}</span><span class="per-month">/mo*</span></span>
                                 @else
                                    <span class="whole-span"><span class="ruppess">&#36;</span> <span class="big-price">{{ Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD') }}</span><span class="per-month">/mo*</span></span>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex">
                    <a href="{{url('servers/vps-hosting')}}" class="btn align-self-center" data-aos="fade-left" title="Get Started">Get Started</a>
                </div>	
            </div>
        </div>
    </div>
    </div> --}}
    <script>
    // Initialize Owl Carousel
    $(document).ready(function () {
        $(".why-hits-owl-crsl").owlCarousel({
            items: 4, // Display 4 items at a time
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1 // Display 1 item on small screens
                },
                600: {
                    items: 2 // Display 2 items on medium screens
                },
                1000: {
                    items: 4 // Display 4 items on larger screens
                }
            }
        });
    });
</script>
@endsection