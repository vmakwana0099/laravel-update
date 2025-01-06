@php $customer = unserialize(Config::get('Constant.CUSTOMER_RATING_REVIEW')); @endphp

<div class="review">
    <div class="row">
        <div class="col-sm-3">
            <div class="review-l" data-aos="fade-right">
                <p class="review-title">{{ !empty($customer['RATING']['HOSTADVICE']) ? $customer['RATING']['HOSTADVICE'] : "" }}</p>
                <div class="review-star">
                    <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                <div class="review-text">
                    Based on {{-- 136 --}} {{ !empty($customer['REVIEW']['HOSTADVICE']) ? $customer['REVIEW']['HOSTADVICE'] : "" }} reviews 
                    See some of the reviews here.
                </div>
                <div class="trustpilot-image">
                    <a target="_blank" href="https://hostadvice.com/hosting-company/host-it-smart-reviews/" rel="nofollow"><img alt="hostadvice" title="hostadvice" src="{{Config::get('Constant.CDNURL')}}/assets/images/logo-2.png"></a>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="owl-carousel owl-theme rating-owl-crsl" id="review-owl">
                <div class="item col" data-aos="zoom-in" data-aos-delay="100">
                    <div class="review-slider">
                        <div class="review-l">
                            <p class="review-title">{{ !empty($customer['RATING']['GOOGLE']) ? $customer['RATING']['GOOGLE'] : "" }}</p>
                            <div class="review-star">
                                <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                            <div class="review-text">
                                Based on {{-- 283 --}} {{ !empty($customer['REVIEW']['GOOGLE']) ? $customer['REVIEW']['GOOGLE'] : "" }} reviews See some of the reviews here.
                            </div>
                            <div class="trustpilot-image">
                                <a target="_blank" rel="nofollow" href="https://www.google.com/search?num=100&rlz=1C1AVNE_enIN715IN715&ei=2YkXXMeSJ5T_wAOB6ZX4AQ&q=host+it+smart&oq=host+it+smart&gs_l=psy-ab.3..0l3j0i22i30l7.1080.3046..3688...0.0..0.238.2460.0j9j4......0....1..gws-wiz.......0i71j0i131j0i67j0i10j0i131i67.oxHhcjMtoSY#lrd=0x395e84d7c974bd5f:0x91cf8c25003fbd01,1,,"><img alt="google" title="google" src="{{Config::get('Constant.CDNURL')}}/assets/images/googlelogo-1_v2.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item col" data-aos="zoom-in" data-aos-delay="200">
                    <div class="review-slider">
                        <div class="review-l">
                            <p class="review-title">{{-- 4.6 --}} {{ !empty($customer['RATING']['FACEBOOK']) ? $customer['RATING']['FACEBOOK'] : "" }}</p>
                            <div class="review-star">
                                <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                            <div class="review-text">
                                Based on {{-- 245 --}} {{ !empty($customer['REVIEW']['FACEBOOK']) ? $customer['REVIEW']['FACEBOOK'] : "" }} reviews See some of the reviews here.
                            </div>
                            <div class="trustpilot-image">
                                <a target="_blank" rel="nofollow" href="https://www.facebook.com/pg/hostitsmart/reviews/?ref=page_internal"><img alt="facebook" title="facebook" src="{{Config::get('Constant.CDNURL')}}/assets/images/facebook-logo-1_v2.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="item col" data-aos="zoom-in" data-aos-delay="300">
                    <div class="review-slider">
                        <div class="review-l">
                            <p class="review-title">7.6</p>
                            <div class="review-star">
                                <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                            <div class="review-text">
                                Based on review posted, Please
                                read Complete Reviews Here
                            </div>
                            <div class="trustpilot-image">
                                <a target="_blank" rel="nofollow" href="https://hosting.review/hosting-provider/hostitsmart/"><img alt="Hosting.review" title="Hosting.review" src="{{Config::get('Constant.CDNURL')}}/assets/images/hosting-review.png"></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="item col" data-aos="zoom-in" data-aos-delay="300">
                    <div class="review-slider">
                        <div class="review-l">
                            <p class="review-title">{{-- 4.6 --}}  {{ !empty($customer['RATING']['TRUSTPILOT']) ? $customer['RATING']['TRUSTPILOT'] : "" }}</p>
                            <div class="review-star">
                                <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star"></i> <i class="la la-star-half-o"></i> </div>
                            <div class="review-text">
                                Based on {{-- 156 --}} {{ !empty($customer['REVIEW']['TRUSTPILOT']) ? $customer['REVIEW']['TRUSTPILOT'] : "" }} reviews See some of the reviews here.
                            </div>
                            <div class="trustpilot-image">
                                <a target="_blank" rel="nofollow" href="https://www.trustpilot.com/review/www.hostitsmart.com"><img alt="trustpilot" title="trustpilot" src="{{Config::get('Constant.CDNURL')}}/assets/images/trustpilot_v2.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Initialize Owl Carousel
    $(document).ready(function () {
        $(".rating-owl-crsl").owlCarousel({
            items: 3, // Display 4 items at a time
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1 // Display 1 item on small screens
                },
                600: {
                    items: 1 // Display 2 items on medium screens
                },
                1000: {
                    items: 3 // Display 4 items on larger screens
                }
            }
        });
    });
</script>