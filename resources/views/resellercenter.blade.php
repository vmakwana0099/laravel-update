@extends('layouts.app')

@section('content')

@include('layouts.inner_banner')

<div class="domain-landing-section reseller-program-main">

<!-- feature points section -->

	<div class="reseller-points">

		<div class="container">

			<div class="feature-start">

					<h2 class="text-center aos-init" data-aos="fade-up" data-aos-delay="100">Reseller Program</h2>

					<p class="text-center aos-init" data-aos="fade-up" data-aos-delay="200">The Reseller Program empowers you to add more variety to your current products and services and expand your business. Whether you are looking for a low-investment business opportunity, are already maintaining websites for your clients or are an IT professional, our Reseller Program is perfect. It can help you to generate additional revenue and soar your business success. The program offers:</p>

					<div class="fp-list">

						<div class="row">

							<div class="col-12 col-sm-12 aos-init" data-aos="fade-right" data-aos-delay="500">

								<ul>

									<li>Easy and intuitive solutions that bring along the ease of doing business.</li>

									<li>Complete control over resources while we stay behind-the-scenes and work hard for you 24/7.</li>

									<li>Uniquely designed Host IT Smart offerings and tools for greater business benefits.</li>

									<li>The opportunity to partner with a trusted brand that makes selling solutions to your customers easier.</li>

								</ul>

							</div>

						</div>

					</div>

			</div>

		</div>

	</div>

	<div class="reseller-details-form">

		<div class="container">

			<div class="row">

				<div class="col-lg-12 col-12 left_part d-flex justify-content-center">

					<div class="contact-left aos-init" data-aos="fade-right">	

						<h3 class="contact-title aos-init">Enterprise Reseller Application</h3>

						<p class="title-desc">Get access to the world full of opportunities and achieve the impossible in your business with our Reseller Program. Fill the form to enroll!</p>

						<div class="require-field">*(Denotes Required)</div>

						

						{!! Form::open(['method' => 'post','class'=>'form-horizontal row contact_form', 'name' => 'contact_form', 'id' => 'contact_form']) !!}

                        {!! Form::hidden('varRefURL',URL::previous(),null) !!}

							<div class="col-md-4 col-12">

								<div class="form-group">

									<label class="form-text" for="fname">Full Name<span class="required">*</span></label>

									{!! Form::text('fullname',  old('fullname') , array('id' => 'fullname', 'class' => 'form-control')) !!}

		                            @if ($errors->has('fullname'))

		                            <span class="help-block">

		                                {{ $errors->first('fullname') }}

		                            </span>

		                            @endif

								</div>

							</div>

							<div class="col-md-4 col-12">

								<div class="form-group">

									<label class="form-text" for="wmail">Work Email<span class="required">*</span></label>

									{!! Form::text('workemail',  old('workemail') , array('id' => 'workemail', 'class' => 'form-control')) !!}

		                            @if ($errors->has('workemail'))

		                            <span class="help-block">

		                                {{ $errors->first('workemail') }}

		                            </span>

		                            @endif

								</div>

							</div>

							<div class="col-md-4 col-12">

								<div class="form-group">

									<label class="form-text" for="Interested In">Interested In<span class="required">*</span></label>

									@if(isset($interestedin) && !empty($interestedin))

									<select class="selectpicker form-control" id="interestedin" name="interestedin">

											<option value="">Select</option>

											@foreach($interestedin as $key => $itm)		

												<option value="{{$key}}">{{$itm}}</option>

											@endforeach		 

									</select>

									@endif

								</div>

							</div>

							<div class="col-md-4 col-12">

								<div class="form-group"> 

									<label class="form-text" for="ccall">Phone<span class="required">*</span></label>

									{!! Form::tel('phone_number',  old('phone_number') , array('id' => 'phone_no', 'class' => 'form-control', 'maxlength'=>"20", 'onpaste'=>'return false;','ondrop'=>'return false;', 'onkeypress'=>'javascript: return KeycheckOnlyPhonenumber(event);')) !!}

		                            @if ($errors->has('phone_number'))

		                            <span class="help-block">

		                                {{ $errors->first('phone_number') }}

		                            </span>

		                            @endif

								</div>

							</div>

							<div class="col-md-4 col-12">

								<div class="form-group">

									<label class="form-text" for="cname">Company Name<span class="required">*</span></label>

									{!! Form::text('companyname',  old('companyname') , array('id' => 'companyname', 'class' => 'form-control')) !!}

		                            @if ($errors->has('companyname'))

		                            <span class="help-block">

		                                {{ $errors->first('companyname') }}

		                            </span>

		                            @endif

								</div>

							</div>

							<div class="col-md-4 col-12">

								<div class="form-group">

									<label class="form-text" for="curl">Company URL<span class="required">*</span></label>

									{!! Form::text('companyurl',  old('companyurl') , array('id' => 'companyurl', 'class' => 'form-control')) !!}

		                            @if ($errors->has('companyurl'))

		                            <span class="help-block">

		                                {{ $errors->first('companyurl') }}

		                            </span>

		                            @endif

								</div>

							</div>

							<div class="col-md-4 col-12">

								<div class="form-group"> 

									<label class="form-text" for="ccat">Type Of Business<span class="required">*</span></label>

									@if(isset($businesstype) && !empty($businesstype))

									<select class="selectpicker form-control" id="businesstype" name="businesstype">

											<option value="">Select</option>

											@foreach($businesstype as $key => $itm)		

												<option value="{{$key}}">{{$itm}}</option>

											@endforeach		 

									</select>

									@endif

								</div>

							</div>

							<div class="col-md-4 col-12">

								<div class="form-group"> 

									<label class="form-text" for="ccat">Total paying customers<span class="required">*</span></label>

									@if(isset($payingtype) && !empty($payingtype))

									<select class="selectpicker form-control" id="totalcustomer" name="totalcustomer">

										<option value="">Select</option>

											@foreach($payingtype as $key => $itm)		

												<option value="{{$key}}">{{$itm}}</option>

											@endforeach		 

									</select>

									@endif

								</div>

							</div>

							<div class="col-md-4 col-12">

								<div class="form-group"> 

									<label class="form-text" for="ccat">Country<span class="required">*</span></label>

									@if(isset($countrydata) && !empty($countrydata))

									<select class="selectpicker form-control" id="countrydata" name="countrydata">

											@foreach($countrydata as $key => $itm)		

												<option value="{{$key}}" @if($key == 'IN') selected @endif>{{$itm}}</option>

											@endforeach		 

									</select>

									@endif

								</div>

							</div>

							

							<div class="col-12">

								<div class="form-group text-center">  

									<label class="form-text" for="user_message">Message<span class="required">*</span></label>

									{!! Form::textarea('user_message', old('user_message') , array( 'class' => 'form-control', 'cols' => '40', 'rows' => '3', 'id' => 'user_message', 'spellcheck' => 'true' )) !!}

								</div>

							</div>

							 <div class="col-md-6 col-12">

                        <div class="form-group">

                            <div id="html_element" class="g-recaptcha form-text" data-sitekey="{{ Config::get('Constant.GOOGLE_CAPCHA_KEY') }}" data-callback="check_captcha"></div>

                            <div class="capphitcha">

                                @if ($errors->has('g-recaptcha-response'))

                                <span class="help-block">

                                    {{ $errors->first('g-recaptcha-response') }}

                                </span>

                                @endif

                            </div>

                        </div>

                    </div>

                    <div class="col-12">

								<div class="form-group text-center">        

									By clicking "SEND", you agree to our <a target="_blank" title="Privacy Policy" href="{{url('/privacy-policy')}}">Privacy Policy</a>.

								</div>

							</div>

                    <div class="clearfix"></div>

							<div class="col-12 col-sm-12">

								<div class="form-group text-center">        

									<button type="submit" class="send-btn btn btn-default" title="SEND">SEND</button>

								</div>

							</div>

						{!! Form::close() !!}

					</div>

				</div>

			</div>

		</div>

	</div>

	

	<div class="vps-features" id="features">

	<div class="container">

		<div class="row">

			<div class="features-main">

				<h2 class="features-title aos-init" data-aos="fade-up">Features</h2>

				<div class="features-start d-md-block d-none">

					<div class="row">

						<div class="feature-ul d-flex flex-wrap">

							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start" data-aos="flip-left"

     data-aos-easing="ease-out-cubic" data-aos-delay="100">

									<div class="feature-icon">

										<i class="vps-features-icon support24"></i>

									</div>

									<h3><a href="#" title="">Second to None Support</a></h3>

									<div class="content">

										Our 24/7 support ensures you are not left alone to manage your growing business.

									</div>

								</div>

							</div>

							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start" data-aos="flip-left"

     data-aos-easing="ease-out-cubic" data-aos-delay="150">

									<div class="feature-icon">

										<i class="vps-features-icon scale-with-ease"></i>

									</div>

									<h3><a href="#" title="">Scalability</a></h3>

									<div class="content">

										Measure the growth and get the flexibility you desire.

									</div>

								</div>

							</div>

							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start" data-aos="flip-left"

     data-aos-easing="ease-out-cubic" data-aos-delay="200">

									<div class="feature-icon">

										<i class="vps-features-icon savings"></i>

									</div>

									<h3><a href="#" title="">Multiple Options</a></h3>

									<div class="content">

										Never compromise! Our system is multi-tiered and offers the multi-currency option.



									</div>

								</div>

							</div>

							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start" data-aos="flip-left"

     data-aos-easing="ease-out-cubic" data-aos-delay="250">

									<div class="feature-icon">

										<i class="vps-features-icon dashboard"></i>

									</div>

									<h3><a href="#" title="">Intuitive Interface</a></h3>

									<div class="content">

									You won’t require to employ additional technical assistance with our user-friendly interface.

									</div>

								</div>

							</div>

							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start" data-aos="flip-left"

     data-aos-easing="ease-out-cubic" data-aos-delay="300">

									<div class="feature-icon">

										<i class="vps-features-icon payment-gateway"></i>

									</div>

									<h3><a href="#" title="">Integrated Payment Gateway</a></h3>

									<div class="content">

									Set up an independent payment gateway and define product prices, collect payment directly from the end user, and more.

									</div>

								</div>

							</div>

							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start" data-aos="flip-left"

     data-aos-easing="ease-out-cubic" data-aos-delay="350">

									<div class="feature-icon">

										<i class="vps-features-icon multiple-support"></i>

									</div>

									<h3><a href="#" title="">Manage Your Sub-sellers</a></h3>

									<div class="content">

									Leave no corner unattended! Manage your customers and sub-sellers efficiently and keep an accurate track of payouts.

									</div>

								</div>

							</div>

						</div>

					</div>

				</div> <!--features-start end -->

				<div class="features-start features-start-mob d-md-none d-block"> <!-- features-start-mob -->

					<div class="owl-carousel owl-theme">					    

					    <div class="item">

				    		<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start">

									<div class="feature-icon">

										<i class="vps-features-icon support24"></i>

									</div>

									<h3><a href="#" title="">Second to None Support</a></h3>

									<div class="content">

										Our 24/7 support ensures you are not left alone to manage your growing business.

									</div>

								</div>

							</div>



					    </div>

					    <div class="item">

				    		<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start">

									<div class="feature-icon">

										<i class="vps-features-icon scale-with-ease"></i>

									</div>

									<h3><a href="#" title="">Scalability</a></h3>

									<div class="content">

										Measure the growth and get the flexibility you desire.

									</div>

								</div>

							</div>



					    </div>

			    	 	<div class="item">

						    <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

									<div class="content-main align-self-start">

										<div class="feature-icon">

											<i class="vps-features-icon savings"></i>

										</div>

										<h3><a href="#" title="">Multiple Options</a></h3>

										<div class="content">

											Never compromise! Our system is multi-tiered and offers the multi-currency option.

										</div>

									</div>

								</div>

						</div>



						 <div class="item">

							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start">



									<div class="feature-icon">

										<i class="vps-features-icon dashboard"></i>

									</div>

									<h3><a href="#" title="">Intuitive Interface</a></h3>

									<div class="content">

									You won’t require to employ additional technical assistance with our user-friendly interface.

									</div>

								</div>

							</div>

						</div>

						 <div class="item">

							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start">

									<div class="feature-icon">

										<i class="vps-features-icon payment-gateway"></i>

									</div>

									<h3><a href="#" title="">Integrated Payment Gateway</a></h3>

									<div class="content">

									Set up an independent payment gateway and define product prices, collect payment directly from the end user, and more.

									</div>

								</div>

							</div>

						</div>

						 <div class="item">

							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

								<div class="content-main align-self-start">

									<div class="feature-icon">

										<i class="vps-features-icon multiple-support"></i>

									</div>

									<h3><a href="#" title="">Manage Your Sub-sellers</a></h3>

									<div class="content">

									Leave no corner unattended! Manage your customers and sub-sellers efficiently and keep an accurate track of payouts.	

									</div>

								</div>

							</div>

						</div>

					</div>

				</div><!-- features-start-mob  end-->

			</div> <!-- features-main end -->

		</div>

	</div>

</div>

<br />

<div class="reseller-points">

		<div class="container">

			<div class="feature-start">

					<h2 class="text-center aos-init" data-aos="fade-up" data-aos-delay="100">Overview</h2>

					<p class="text-center aos-init" data-aos="fade-up" data-aos-delay="200">

The Host IT Smart reseller program capacitates you to build and grow your own business by acquiring customers and generating sales. The program offers you a flexible management system and empowers you to brand your personal store, price your products, payouts’ calculation methods and other highly desirable functions essential to kickstart or escalate your business. You sell our products, add-ons, and domains to your end users while our 24/7 technical support ensures your customers receive the best. The program enables you to track the sales progress statistics and do so much more efficiently.

</p><br />

					

			</div>

		</div>

	</div>

<br />

	<div class="vps-features wphost-features" id="features">

		<div class="container">

			<div class="row">

				<div class="features-main">

					<h2 class="features-title aos-init" data-aos="fade-up">Reseller products</h2>

					<div class="features-start d-md-block d-none">

						<div class="row">

							<div class="feature-ul d-flex flex-wrap">

								<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

									<div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">

										<div class="feature-icon">

											<i class="vps-features-icon domain"></i>

										</div>

										<h3>Domain</h3>

										<div class="content">

											Expand your domain portfolio to offer your customers exactly what they’re looking for!

										</div>

									</div>

								</div>

								<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

									<div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="150">

										<div class="feature-icon">

											<i class="vps-features-icon containerized-server"></i>

										</div>

										<h3>Web Hosting</h3>

										<div class="content">

											Get the freedom of choosing efficient web hosting services without making the huge investments.

										</div>

									</div>

								</div>

								<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

									<div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="200">

										<div class="feature-icon">

											<i class="vps-features-icon reseller-hosting"></i>

										</div>

										<h3>Reseller Hosting</h3>

										<div class="content">

											Choose our high-performance reseller hosting service that offers unlimited cPanel accounts and more.

                                        </div>

									</div>

								</div>

								<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

									<div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="250">

										<div class="feature-icon">

											<i class="vps-features-icon vps-hosting"></i>

										</div>

										<h3>VPS Hosting</h3>

										<div class="content">Fully-scalable VPS hosting equipped with fast SSD drives, advanced security and more.</div>

									</div>

								</div>

								<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

									<div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="300">

										<div class="feature-icon">

											<i class="vps-features-icon dedicated-server"></i>

										</div>

										<h3>Dedicated Server</h3>

										<div class="content">Offer premium servers and manage them effortlessly. Start quickly and easily!</div>

									</div>

								</div>

								<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">

									<div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="350">

										<div class="feature-icon">

											<i class="vps-features-icon ssl"></i>

										</div>

										<h3>SSL</h3>

										<div class="content">Safeguard the world like we do! Resell reliable SSL certificate and gain the business credibility.</div>

									</div>

								</div>

							</div>

						</div>

					</div> <!--features-start end -->

					<div class="features-start features-start-mob d-md-none d-block"> <!-- features-start-mob -->

						<div class="feature-ul">

							<div class="owl-carousel owl-theme">					    

							    <div class="item">

						    		<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

										<div class="content-main align-self-start">

											<div class="feature-icon">

												<i class="vps-features-icon domain"></i>

											</div>

											<h3><a href="#" title="">Domain</a></h3>

											<div class="content">

												Expand your domain portfolio to offer your customers exactly what they’re looking for!

											</div>

										</div>

									</div>



							    </div>

							    <div class="item">

						    		<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

										<div class="content-main align-self-start">

											<div class="feature-icon">

												<i class="vps-features-icon containerized-server"></i>

											</div>

											<h3><a href="#" title="">Web Hosting</a></h3>

											<div class="content">

												Get the freedom of choosing efficient web hosting services without making the huge investments.

											</div>

										</div>

									</div>



							    </div>

					    	 	<div class="item">

								    <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

											<div class="content-main align-self-start">

												<div class="feature-icon">

													<i class="vps-features-icon reseller-hosting"></i>

												</div>

												<h3><a href="#" title="">Reseller Hosting</a></h3>

												<div class="content">

													Choose our high-performance reseller hosting service that offers unlimited cPanel accounts and more.

												</div>

											</div>

										</div>

								</div>

								 <div class="item">

									<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

										<div class="content-main align-self-start">

											<div class="feature-icon">

												<i class="vps-features-icon vps-hosting"></i>

											</div>

											<h3><a href="#" title="">VPS Hosting</a></h3>

											<div class="content">

											Fully-scalable VPS hosting equipped with fast SSD drives, advanced security and more.

											</div>

										</div>

									</div>

								</div>

								 <div class="item">

									<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

										<div class="content-main align-self-start">

											<div class="feature-icon">

												<i class="vps-features-icon dedicated-server"></i>

											</div>

											<h3><a href="#" title="">Dedicated Server</a></h3>

											<div class="content">

											Offer premium servers and manage them effortlessly. Start quickly and easily!

											</div>

										</div>

									</div>

								</div>

								 <div class="item">

									<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">

										<div class="content-main align-self-start">

											<div class="feature-icon">

												<i class="vps-features-icon ssl"></i>

											</div>

											<h3><a href="#" title="">SSL</a></h3>

											<div class="content">

											Safeguard the world like we do! Resell reliable SSL certificate and gain the business credibility.

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div><!-- features-start-mob  end-->

				</div> <!-- features-main end -->

			</div>

		</div>

	</div>



	<div class="reseller-features">

		<div class="container">

			<div class="row reordering">

				<div class="col-sm-12 reordering-1">

					<h2 class="text-center aos-init" data-aos="fade-up" data-aos-delay="100">Take Your Business to New Heights</h2>

				</div>

				<div class="col-12 col-sm-6 reordering-3">

					<div class="left aos-init" data-aos="fade-left" data-aos-delay="400">

						<div class="title"><p>Get the power of choosing your own profit margins!</p></div>

						<p>Ditch the programs that stringently demand of you to earn as much as others. Control not only your resources but also the money you make off each product with our Reseller Program. It’s time to become your own boss in true sense!</p>

					</div>

				</div>

				<div class="col-12 col-sm-6 reordering-2">

					<div class="right aos-init text-center" data-aos="zoom-in-right" data-aos-delay="400">

						<img src="assets/images/reseller-service.png" alt="Transfer Domain"/>

					</div>

				</div>

			</div><!-- row end -->

		</div><!-- container end -->

	</div>

</div>	

@if(!empty($FaqData) && count($FaqData) >0)

<div class="getquestion-div">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <h3 data-aos="fade-up">Got a Question? We've the Answer!</h3>

            </div>

            <div class="col-12">

                <div id="accordion">

                    @php $i = 0; $class = ''; $class1 = ''; $class2 = ''; $class3 = '';  $class4 = ''; @endphp

                    @foreach($FaqData as $Faq)

                    @php

                    if ($i == '0'){

                    $class = 'true';

                    $class1 = 'collapsed';

                    $class2 = 'display:block';

                    $open_class = 'active-accordition';

                    } else {

                    $class = 'false'; 

                    $class1 = 'collapsed'; 

                    $class2 = 'display:none';

                    $open_class = '';

                    } 

                    if ($i > '4'){

                    $class3 = 'display:none';

                    $class4 = 'display:block';

                    } else {

                    $class3 = '';

                    $class4 = 'display:none';

                    } 

                    @endphp

                    <div class="card" data-aos="fade-up" style="{{$class3}}">

                        <h4 class="mb-0 {{$open_class}}">

                            <button class="btn btn-link {{$class1}}" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="{{$class}}" aria-controls="collapse{{$i}}">

                                {{$Faq->varTitle}} 

                            </button>

                        </h4>

                        <div id="collapse{{$i}}" class="collapse" data-parent="#accordion" style="{{$class2}}">

                            <div class="card-body">

                                {!! $Faq->txtDescription !!}

                            </div>

                        </div>

                    </div>

                    @php $i++;@endphp

                    @endforeach

                </div>

            </div>



            <div class="col-12 aos-init" data-aos="fade-up" style="{{$class4}}">

                <a href="javascript:;" id="show" title="More" class="more_link">More</a>

            </div>

            <script>

                $("#show").click(function () {

                    $(".card").show();

                    $("#show").hide();

                });

            </script>

        </div>

    </div>

</div>

@endif

<div class="lading_bottom">

    @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)

    <div class="hostingtype_div">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <h3 class="title">Didn't hit your sweet spot?</h3>

                </div>

                @php $p = 0; $class = ''; $color = ''; $info = ''; @endphp

                @foreach($FeaturedProductsData as $FeaturedProducts)

                @php

                if ($p == '0'){

                $class = 'd-flex justify-content-end';

                $color = 'left_part';

                } else {

                $class = ''; 

                $color = 'right_part';

                }     

                @endphp

                <div class="col-lg-6 {{$color}} {{$class}}">

                    <div class="hosting_box d-flex">

                        <div class="image align-self-center" data-aos="fade-right" data-aos-delay="250">

                            <i class="{{$FeaturedProducts->varIconClass}}"></i>

                            <div class="hosting-price-start">Starting at 

                                 @if(Config::get('Constant.sys_currency') == 'INR')

                                <span class="color-green"><i class="rupees">&#8377;</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</strong>/mo*</span>

                                 @else

                                 <span class="color-green"><i class="rupees">&#36;</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_USD') }}</strong>/mo*</span>

                                  @endif

                            </div>

                        </div>

                        <div class="info" data-aos="fade-left" data-aos-delay="100">

                            <span class="name">{{$FeaturedProducts->varTitle}}</span>

                            <h3 class="info-text"> {{$FeaturedProducts->varShortDescription}}</h3>

                            @php $FeaturedProducts_expload = explode("\n",$FeaturedProducts->varFeature); @endphp

                            <ul class="list">

                                @foreach($FeaturedProducts_expload as $info)

                                <li> {{$info}}</li>

                                @endforeach

                            </ul>

                            <a href="{{$FeaturedProducts->varButtonLink}}" class="btn" title="{{$FeaturedProducts->varButtonName}}">{{$FeaturedProducts->varButtonName}}</a>

                        </div>

                    </div>

                </div>

                @php $p++;@endphp

                @endforeach

            </div>

        </div>

    </div>

    @endif



    {{--<div class="promotion_div">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-4 col-12">

                    <div class="row justify-content-end">

                        <div class="limited-promotion">

                            <span class="" data-aos="fade-left">Limited <br/>Time <br/>Promotion</span>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-12 padding-0">

                    <div class="new_customer">

                        <div class="offer-promo-img" data-aos="zoom-in">

                            <span class="offer-text">15% <span>Off</span>

                            </span>

                        </div>

                        <div class="combine-div">

                            <span class="offer">Today for new Customers<br></span>

                            <div class="price-part">

                                <span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">199</span><span class="per-month">/mo*</span></span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-12 d-flex">

                    <a href="#" class="btn align-self-center" data-aos="fade-left" title="Get Started">Get Started</a>

                </div>	

            </div>

        </div>

    </div>--}}

</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

<script src="{{ url('assets/js/resellercenter.js') }}"></script>

<script type="text/javascript">

	$("#businesstype, #totalcustomer, #countrydata, #interestedin").change(function(){ $("#contact_form").valid(); });

            var onloadCallback = function() {

            grecaptcha.render('html_element', {

            'sitekey' : '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}'

            });

            };	</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

@endsection