<div class="support-section">
		<div class="container">    
				<div class="row row flex-sm-row-reverse flex-row-reverse flex-row">
								<div class="col-lg-5 col-md-6 col-sm-12 col-12">
									<div class="support-text1">
										<h4 class="support-head aos-init" data-aos="fade-down" data-aos-delay="100">
											{{$contactData->varHomePageTitle}}
										</h4>
										<div class="support-text aos-init" data-aos="fade-down" data-aos-delay="120">
											{!! nl2br(e(str_limit($contactData->varHomePageDescription, 150))) !!}
										</div>
										<div class="support-call aos-init" data-aos="fade-down" data-aos-delay="140">
											<a href="tel:{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}" title="{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }} {{$contactData->varOpenHours}}" class="support-links">{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}   <span>{{$contactData->varOpenHours}}</span></a>
										</div>
										<div class="support-call support-mail aos-init" data-aos="fade-down" data-aos-delay="160">
											<a href="mailto:{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varEmail) }}" title="{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varEmail) }}" class="support-links">{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varEmail) }}</a>
										</div>
										@if(null!==(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) && strlen(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) > 0)
											<div class="support-call support-whatsapp aos-init" data-aos="fade-down" data-aos-delay="160">
												<a href="{{Config::get('Constant.SOCIAL_WHATSAPP_LINK')}}" title="Whatsapp Support" target="_blank" class="support-links">Whatsapp Support</a>
											</div>
										@endif
										<div class="support-call support-pin aos-init" data-aos="fade-down" data-aos-delay="160">
											<p class="support-links" title="{!! e($contactData->varSchemaAddress) !!}">
												{!! nl2br(e($contactData->varSchemaAddress)) !!}
											</p>
										</div>
										<a href="{{url('/contact')}}" class="btn aos-init" id="contact_support_home_banner" data-aos="fade-down" data-aos-delay="200" title="Contact Support">Contact Support <i class="fa fa-caret-right"></i></a>
										<a href="{{Config::get('Constant.API_URL')}}/submitticket.php" id="submit_ticket_home_banner" class="btn aos-init" data-aos="fade-down" data-aos-delay="200" title="Submit Ticket">Submit Ticket <i class="fa fa-caret-right"></i></a>
									</div>
								</div>
								<div class="col-lg-7 col-md-6 col-sm-12 col-12 d-none d-md-block">
									<div class="support-image aos-init" data-aos="fade-right" data-aos-delay="500">
										 <div class="contact-image">
												<img src="{{Config::get('Constant.CDNURL')}}/assets/images/support-img.png" alt="support" />
												<div class="contact-call">	
													<div class="call-1-support"></div>
													<div class="pulse1"></div>
  <div class="pulse2"></div>
  <div class="pulse3"></div>
  <div class="pulse4"></div>
												</div>
										 </div>
									</div>
								</div>
				</div>
		</div>
</div>	