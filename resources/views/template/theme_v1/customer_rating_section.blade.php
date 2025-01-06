@php $customer = unserialize(Config::get('Constant.CUSTOMER_RATING_REVIEW')); @endphp

<div class="customer_rating_section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="aos-init" data-aos="fade-right">Customer Ratings</h2>
				<div class="features-start">
					<div class="row">
						<div class="col-lg-6 col-12 aos-init" data-aos="fade-right">
							<ul class="rating_list">
								<li>
									<div class="rating_star_box">
										<span class="rating">{{ !empty($customer['RATING']['HOSTADVICE']) ? $customer['RATING']['HOSTADVICE'] : "" }} {{-- 8.1 --}}</span>
										<div class="rating-icon">
													
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												</div>
									</div>
									<div class="rating_info_box"><a rel="nofollow" target="_blank" href="https://hostadvice.com/hosting-company/host-it-smart-reviews/"><img alt="Customer Ratings" src="{{Config::get('Constant.CDNURL')}}/assets/images/rating-logo01.png"></a>Based on {{ !empty($customer['REVIEW']['HOSTADVICE']) ? $customer['REVIEW']['HOSTADVICE'] : "" }} reviews See some of the reviews here.</div>
								</li>
								<li>
									<div class="rating_star_box">

										<!-- <span class="rating">{{ !empty($customer['RATING']['GOOGLE']) ? $customer['RATING']['GOOGLE'] : "" }}</span> -->
										<span class="rating">{{ !empty($customer['RATING']['GOOGLE']) ? number_format($customer['RATING']['GOOGLE'], 1) : "" }}</span>

										<div class="rating-icon">
													
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												</div>
									</div>
									<div class="rating_info_box"><a rel="nofollow" target="_blank" href="https://www.google.com/search?num=100&rlz=1C1AVNE_enIN715IN715&ei=2YkXXMeSJ5T_wAOB6ZX4AQ&q=host+it+smart&oq=host+it+smart&gs_l=psy-ab.3..0l3j0i22i30l7.1080.3046..3688...0.0..0.238.2460.0j9j4......0....1..gws-wiz.......0i71j0i131j0i67j0i10j0i131i67.oxHhcjMtoSY#lrd=0x395e84d7c974bd5f:0x91cf8c25003fbd01,1,,"><img alt="Customer Ratings" src="{{Config::get('Constant.CDNURL')}}/assets/images/rating-logo02.png"></a>Based on {{ !empty($customer['REVIEW']['GOOGLE']) ? $customer['REVIEW']['GOOGLE'] : "" }} {{-- 283 --}} reviews See some of the reviews here.</div>
								</li>
								<li>
									<div class="rating_star_box">
										<span class="rating">{{ !empty($customer['RATING']['FACEBOOK']) ? $customer['RATING']['FACEBOOK'] : "" }}{{-- 4.6 --}}</span>
										<div class="rating-icon">
													
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												</div>
									</div>
									<div class="rating_info_box"><a rel="nofollow" target="_blank" href="https://www.facebook.com/pg/hostitsmart/reviews/?ref=page_internal"><img alt="Customer Ratings" src="{{Config::get('Constant.CDNURL')}}/assets/images/rating-logo03.png"></a>Based on {{ !empty($customer['REVIEW']['FACEBOOK']) ? $customer['REVIEW']['FACEBOOK'] : "" }} {{-- 245 --}} reviews See some of the reviews here.</div>
								</li>
								{{-- <li>
									<div class="rating_star_box">
										<span class="rating">7.6</span>
										<div class="rating-icon">
													
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												</div>
									</div>
									<div class="rating_info_box"><a rel="nofollow" target="_blank" href="https://hosting.review/hosting-provider/hostitsmart/"><img alt="Hosting.review" src="{{Config::get('Constant.CDNURL')}}/assets/images/hosting-review.png"></a>Based on review posted, Please read Complete Reviews here.</div>
								</li> --}}
								<li>
									<div class="rating_star_box">
										<span class="rating">{{ !empty($customer['RATING']['TRUSTPILOT']) ? $customer['RATING']['TRUSTPILOT'] : "" }}{{-- 4.6 --}}</span>
										<div class="rating-icon">
													
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
												</div>
									</div>
									<div class="rating_info_box"><a rel="nofollow" target="_blank" href="https://www.trustpilot.com/review/www.hostitsmart.com"><img alt="Customer Ratings" src="{{Config::get('Constant.CDNURL')}}/assets/images/rating-logo04.png"></a>Based on {{ !empty($customer['REVIEW']['TRUSTPILOT']) ? $customer['REVIEW']['TRUSTPILOT'] : "" }}{{-- 156 --}} reviews See some of the reviews here.</div>
								</li>
								<li>
									<div class="rating_star_box">
										<span class="rating">{{ !empty($customer['RATING']['FIXTHEPHOTO']) ? $customer['RATING']['FIXTHEPHOTO'] : "" }}{{-- 4.6 --}}</span>
										<div class="rating-icon">
													
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<!-- <i class="fa fa-star-half-o" aria-hidden="true"></i> -->
												</div>
									</div>
									<div class="rating_info_box"><a target="blank" href="https://fixthephoto.com/top-wordpress-hosting-services.html#host-it-smart-wordpress-hosting-service"><img alt="Customer Ratings" rel="dns-prefetch" src="{{Config::get('Constant.CDNURL')}}/assets/images/fixthephoto.png"></a>Based on this website Review.</div>
								</li>
							</ul>

						</div>
						<div class="col-lg-6 col-12 text-center">
							<!-- <img alt="Customer Ratings" src="{{Config::get('Constant.CDNURL')}}/assets/images/rating-vactor.png" class="img_1"> -->
							<p class="hsd-title">Hallmark of Trust, Security & Performance</p>
                            <a target="_blank" href="https://hostadvice.com/hosting-company/host-it-smart-reviews/" target="_blank">
                                <img alt="Customer Ratings" src="{{Config::get('Constant.HOSTADVICE_AWARD_LOGO_LINK')}}" class="img_1">
                            </a>
                            <div class="haas-desc-home">
                                <p class="hsd-desc">Looking for a hosting partner that offers superior performance, robust security, and tireless support? {{Config::get('Constant.SITE_NAME')}} checks off all the boxes that you can think of when it comes to extraordinary hosting services. We have served our clients for years & that is how we earned their precious trust. Thanks to their love and support, we are a proud recipient of this award.</p>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>