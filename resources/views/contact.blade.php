@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
 <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
<div class="contact_form">
    <div class="container-fluid">
        <div class="row">	
            <div class="col-lg-6 col-12 left_part d-flex justify-content-end">
                <div class="contact-left aos-init" data-aos="fade-right">	
                    <h3 class="contact-title aos-init">How Can We Help?</h3>
                    <div class="require-field">*(Denotes Required)</div>
                    {!! Form::open(['method' => 'post','class'=>'form-horizontal row contact_form', 'name' => 'contact_form','autocomplete' => 'off', 'id' => 'contact_form']) !!}
                    {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-text" for="cname">Name<span class="required">*</span></label>
                            {!! Form::text('first_name',  old('first_name') , array('id' => 'first_name', 'class' => 'form-control','pattern'=>'[a-zA-Z\s]+')) !!}
                            @if ($errors->has('first_name'))
                            <span class="help-block">
                                {{ $errors->first('first_name') }}
                            </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-text" for="cmail">Email<span class="required">*</span></label>
                            {!! Form::text('contact_email',  old('contact_email') , array('id' => 'contact_email', 'class' => 'form-control')) !!}
                            @if ($errors->has('contact_email'))
                            <span class="help-block">
                                {{ $errors->first('contact_email') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group"> 
                            <label class="form-text" for="ccall">Phone #<span class="required">*</span></label>
                            {!! Form::tel('phone_number',  old('phone_number') , array('id' => 'phone_no', 'class' => 'form-control', 'maxlength'=>"20", 'onpaste'=>'return false;','ondrop'=>'return false;', 'onkeypress'=>'javascript: return KeycheckOnlyPhonenumber(event);')) !!}
                            @if ($errors->has('phone_number'))
                            <span class="help-block">
                                {{ $errors->first('phone_number') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group"> 
                            <label class="form-text" for="ccat">Choose Category<span class="required">*</span></label>
                            {!! $Category !!}
                            <span class="help-block" id="Select_cat_err">
                                @if ($errors->has('var_Category'))
                                {{ $errors->first('var_Category') }}
                                @endif
                            </span>
                        </div>
                    </div>
                     
                    <div class="col-12">
                        <div class="form-group">  
                            <label class="form-text" for="cmessage">Message</label>
                            {!! Form::textarea('user_message', old('user_message') , array( 'class' => 'form-control', 'cols' => '40', 'rows' => '3','pattern'=>'[a-zA-Z\s]+', 'id' => 'user_message', 'spellcheck' => 'true' )) !!}
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
                    		By clicking "Send a message", you agree to our <a target="_blank" title="Privacy Policy" href="{{url('privacy-policy')}}">Privacy Policy</a>.
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-12">
                        <div class="form-group">        
                            <button type="submit" class="btn btn-default" title="Send a message">Send a message</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-lg-6 col-12 right_part right_part">
                <div class="contact-right aos-init">
                    <h3 class="contact-title" data-aos="fade-left">Contact Info</h3>
                    <div class="contact-details">
                        <div class="row">

                            @if(isset($PhoneNumner))
                            <div class="col-md-6" data-aos="fade-right">
                                <div class="contact-box-1">
                                <i class="fa-solid fa-phone"></i>
                                    <span class="contact-head d-md-block d-none">Phone Number</span>
                                    <a href="tel:{{$PhoneNumner}}" class="contact-text" title="{{$PhoneNumner}}">{{$PhoneNumner}}</a>
                                </div>
                            </div>
                            @endif
                            @if(isset($EmailId))
                            <div class="col-md-6" data-aos="fade-left">	
                                <div class="contact-box-1">
                                <i class="fa-solid fa-envelope"></i>
                                    <span class="contact-head d-md-block d-none">Email Address</span>
                                    <a href="mailto:{{$EmailId}}" class="contact-text" title="{{$EmailId}}">{{$EmailId}}</a>
                                </div>
                            </div>
                            @endif
                            @if(isset($contact_info[0]->varOfficeAddress))
                            <div class="col-md-6" data-aos="fade-right">
                                <div class="contact-box-1">	
                                <i class="fa-solid fa-location-dot"></i>
                                    <span class="contact-head d-md-block d-none">Company Address</span>
                                    <span class="c-address contact-text">
                                        {!! nl2br($contact_info[0]->varOfficeAddress) !!}    
                                    </span>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6" data-aos="fade-left">
                                <div class="contact-box-1 contact-box-minheight">
                                <i class="fa-solid fa-heart"></i>
                                    <span class="contact-head d-md-block d-none">Follow Us</span>
                                    <ul class="social">
                                        @if(null!==(Config::get('Constant.SOCIAL_FB_LINK')) && strlen(Config::get('Constant.SOCIAL_FB_LINK')) > 0)
                                        <li><a href="{{ Config::get('Constant.SOCIAL_FB_LINK') }}" target="_blank" title="Facebook" class="d-flex justify-content-center fb"><i class="fa fa-facebook"></i> <span class="bg-color"></span></a></li>
                                        @endif
                                        @if(null!==(Config::get('Constant.Google_Plus_Link')) && strlen(Config::get('Constant.Google_Plus_Link')) > 0)
                                        <li><a href="{{ Config::get('Constant.Google_Plus_Link') }}" title="Google" target="_blank" class="d-flex justify-content-center google"><i class="fa fa-google-plus"></i> <span class="bg-color"></span></a></li>
                                        @endif
                                        @if(null!==(Config::get('Constant.SOCIAL_TWITTER_LINK')) && strlen(Config::get('Constant.SOCIAL_TWITTER_LINK')) > 0)
                                        <li><a href="{{ Config::get('Constant.SOCIAL_TWITTER_LINK') }}" title="Twitter" target="_blank" class="d-flex justify-content-center twitter"><i class="fa-brands fa-x-twitter"></i> <span class="bg-color"></span></a></li>
                                        @endif
                                        @if(null!==(Config::get('Constant.SOCIAL_PINTEREST_LINK')) && strlen(Config::get('Constant.SOCIAL_PINTEREST_LINK')) > 0)
                                        <li><a href="{{ Config::get('Constant.SOCIAL_PINTEREST_LINK') }}" title="Pinterest" target="_blank" class="d-flex justify-content-center pinterest"><i class="fa fa-pinterest-p"></i> <span class="bg-color"></span></a></li>
                                        @endif
                                        @if(null!==(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) && strlen(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) > 0)
                                        <li><a href="{{ Config::get('Constant.SOCIAL_LINKEDIN_LINK') }}" title="Linkedin" target="_blank" class="d-flex justify-content-center linkedin"><i class="fa fa-linkedin"></i> <span class="bg-color"></span></a></li>
                                        @endif
                                        @if(null!==(Config::get('Constant.SOCIAL_INSTAGRAM_LINK')) && strlen(Config::get('Constant.SOCIAL_INSTAGRAM_LINK')) > 0)
                                        <li><a href="{{ Config::get('Constant.SOCIAL_INSTAGRAM_LINK') }}" title="Instagram" target="_blank" class="d-flex justify-content-center instagram"><i class="fa fa-instagram"></i> <span class="bg-color"></span></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6 d-xs-flex">
                                <div class="chat" data-aos="fade-right">
                                   <a href="javascript:void(Tawk_API.toggle())" title="Click Here">
                                        <span></span>
                                        <p>Need Help?</p>
                                        {{-- <a target="_blank" href="https://tawk.to/chat/62b3fcc37b967b1179961023/1g67h6nc3" title="Click Here">Click Here - Live Chat</a> --}}
                                         <a href="javascript:void(Tawk_API.toggle())" title="Click Here">Click Here - Live Chat</a>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 d-xs-flex">
                               <?php $apiUrl = config('app.api_url'); ?>
                               <a href="<?php echo $apiUrl; ?>/clientarea.php" title="Click Here"> <div class="ticket" data-aos="fade-left">
                                    <span></span>
                                    <p>Submit a Ticket</p>
                                </div></a>
                            </div>
                            @if(null!==(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) && strlen(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) > 0)
                            <div class="col-12">
								<div class="whatsapp" data-aos="fade-left">
                                    <a href="{{Config::get('Constant.SOCIAL_WHATSAPP_LINK')}}" title="Click Here">
									<span></span>
									<p>Whatsapp Support</p>
                                </a>
								</div>
							</div>
							@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
@include('template.'.$themeversion.'.faq-section')

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
 {{-- <script src="{{ url('assets/js/contact.js?v={{date('YmdHi')}}') }}"></script> --}}
 <script src="{{ url('assets/js/contact.js?v=' . date('YmdHi')) }}"></script>

 {{-- <script type="text/javascript">
    // Move the rendering logic outside the onloadCallbackContact function
    var renderRecaptcha = function() {
        grecaptcha.render('html_element123', {
            'sitekey' : '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}'
        });
    };

    var onloadCallbackContact = function() {
        // Call the rendering function after the reCAPTCHA script is loaded
        renderRecaptcha();
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackContact&render=explicit" async defer></script>
 --}}

{{-- <script src="https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&render=explicit&hl=iw" async defer></script> --}}
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackContact&render=explicit" async defer></script>
    <script type="text/javascript">
      var recaptchaCallback = function () {
        grecaptcha.render("html_element", {
            sitekey: '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}',
            callback: function () {
            }
        });
      }
    </script>

@endsection