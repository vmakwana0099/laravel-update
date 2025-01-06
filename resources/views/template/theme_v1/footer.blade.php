<style>
    .search-footer label{  margin-top: 15px; }
</style>
<div class="footer-start">
    @if(!empty(Request::segment(1)))
    @php $footer_bg = 'footer_bg_class footer'; @endphp
    @else
    @php $footer_bg = ' '; @endphp
    @endif
    <script type="text/javascript" src="//app.icontact.com/icp/static/form/javascripts/validation-captcha.js"></script>
    {{-- <script type="text/javascript" src="//app.icontact.com/icp/static/form/javascripts/tracking.js"></script>  --}}
    <section class="get_encourage_offers head-tb-p-40">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-5">
                    <div class="encrg-offers-img">
                        <img loading="lazy" src="../assets/images/new_img/Offers_img.webp" class="tt-cta-img img-fluid" alt="Offers_img">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-7">
                    <div class="encrg-offers-cnt">
                        <h2>Get Encouraged by Our Offers</h2>
                        <form id="ic_signupform" method="POST" action="https://app.icontact.com/icp/core/mycontacts/signup/designer/form/?id=176&cid=487250&lid=59438" captcha-key="6LeCZCcUAAAAALhxcQ5fN80W6Wa2K3GqRQK6WRjA" captcha-theme="light" new-captcha="true">
                            <div class="encrg-box-email" id="encrg-box-email">
                                <input type="email" class="email" id="email" name="data[email]" aria-describedby="emailHelp" placeholder="Enter email">
                                <div class="submit-container"></div>
                                <button type="submit" class="btn-submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" title="Subscribe"><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <span id="error-message" style="color: red;"></span> <!-- Span for email error messages -->
                            <div class="g-recaptcha" data-sitekey="6LeCZCcUAAAAALhxcQ5fN80W6Wa2K3GqRQK6WRjA" id="subs-g-recaptcha"></div>
                            <span id="captcha-message" style="color: red;"></span> <!-- Span for CAPTCHA error messages -->

                            <div class="encrg-offers-box" id="encrg-offers-box">
                                <input type="checkbox" id="subs-checkbox" name="data[listGroups][]" value="138098">
                                <label for="subs-checkbox">By clicking “Subscribe,” you agree to Host IT Smart's privacy policy and consent to Host IT Smart using your contact data for newsletter purposes.</label><br>
                            </div>
                            <span id="checkbox-message" style="color: red;"></span> <!-- Span for checkbox error messages -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="head-tb-p-40">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-2">
                    <div class="footer-content">
                        <h6 class="accordion-toggle text-white">DOMAIN</h6>
                        <ul class="footer-links accordion-content">
                            <li><a href="../domain-registration" title="Domain Registration">Domain Registration</a></li>
                            <li><a href="../domain/domain-transfer" title="Domain Transfer">Domain Transfer</a></li>
                            <li><a href="../tld" title="Domain TLDs">Domain TLDs</a></li>
                            <li><a href="../domain/bulk-domain-search" title="Bulk Domain Search">Bulk Domain Search</a></li>
                            <li><a href="../whois" title="WHOIS Checker">WHOIS Checker</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-content">
                        <h6 class="accordion-toggle text-white">HOSTING</h6>
                        <ul class="footer-links accordion-content">
                            <li><a href="../web-hosting" title="Shared Hosting">Shared Hosting</a></li>
                            <li><a href="../hosting/linux-hosting" title="Linux Hosting">Linux Hosting</a></li>
                            <li><a href="../hosting/windows-hosting" title="Windows Hosting">Windows Hosting</a></li>
                            <li><a href="../hosting/wordpress-hosting" title="WordPress Hosting">WordPress Hosting</a></li>
                            <li><a href="../hosting/ecommerce-hosting" title="eCommerce Hosting">eCommerce Hosting</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">

                    <div class="footer-content">
                        <h6 class="accordion-toggle text-white">SERVER</h6>
                        <ul class="footer-links accordion-content">
                            <li><a href="../servers/vps-hosting" title="Self-managed VPS">Self-managed VPS</a></li>
                            <li><a href="../servers/managed-vps-hosting" title="Managed VPS Hosting">Managed VPS</a></li>
                            <li><a href="../servers/linux-vps-hosting" title="Linux VPS Hosting">Linux VPS</a></li>
                            <li><a href="../servers/windows-vps-hosting" title="Windows VPS Hosting">Windows VPS</a></li>
                            <li><a href="../servers/forex-vps-hosting" title="Forex VPS Hosting">Forex VPS Hosting</a></li>
                            <li><a href="../servers/dedicated-servers" title="Dedicated Server">Dedicated Server</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-content">
                        <h6 class="accordion-toggle text-white">OTHER PRODUCTS</h6>
                        <ul class="footer-links accordion-content">
                            <li><a href="../hosting/website-builder" title="Website Builder">Website Builder</a></li>
                            <li><a href="../ssl-certificates" title="SSL Certificate">SSL Certificate</a></li>
                            <li><a href="../aws-support-services" title="AWS Support">AWS Support</a></li>
                            <li><a href="../email/google-workspace-india" title="Google Workspace">Google Workspace</a></li>
                            <li><a href="../email/microsoft-office-365-suite" title="Microsoft 365">Microsoft 365</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-content">
                        <h6 class="accordion-toggle text-white">COMPANY</h6>
                        <ul class="footer-links accordion-content">
                            <li><a href="../about-us" title="About Us">About Us</a></li>
                            <li><a href="../contact" title="Contact Us">Contact Us</a></li>
                            <li><a href="../careers" title="Careers">Careers</a></li>
                            <li><a href="../testimonials" title="Testimonials">Testimonials</a></li>
                            <li><a href="../terms" title="Terms" rel="nofollow">Terms</a></li>
                        </ul>
                    </div>
                    <div class="footer-content">
                        <h6 class="accordion-toggle text-white">AFFILIATE PROGRAM</h6>
                        <ul class="footer-links accordion-content">
                            <li><a href="../web-hosting-affiliates" title="Refer & Earn">Refer & Earn</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-content">
                        <h6 class="accordion-toggle text-white">RESOURCES</h6>
                        <ul class="footer-links accordion-content">
                            <li><a href="../blog/" title="Blog">Blog</a></li>
                            <li><a href="../manage/knowledgebase/" title="Knowledgebase">Knowledgebase</a></li>
                            <li><a href="{{ Config::get('Constant.SOCIAL_YOUTUBE_LINK') }}" title="Video Tutorials">Video Tutorials</a></li>
                        </ul>
                    </div>
                    <div class="footer-content">
                        <h6 class="accordion-toggle text-white">ACCOUNT</h6>
                        <ul class="footer-links accordion-content">
                            @if(session()->has('frontlogin'))
                            <li><a href="{{Config::get('Constant.API_URL')}}" title="My Account" id="my_account">My Account</a></li>
                            <li><a href="{{Config::get('Constant.API_URL')}}/index.php?rp=/cart/domain/renew" title="My Renewals">My Renewals</a></li>
                            <li><a href="javascript:void(0);" id="logoutlink" title="Logout" onclick="do_logout();" id="my_account">Logout</a></li>
                            @else
                            <li><a href="#" data-toggle="modal" data-target="#loginModal" title="Create Account">Create Account</a></li>
                            <li><a href="{{ config('app.api_url') }}/clientarea.php" title="Client Area">Client Area</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="social-icon-main">
                <div class="social-icon-row">
                    <div class="social-icon-box"><ul style="list-style-type: none;">
                       @if(null!==(Config::get('Constant.SOCIAL_FB_LINK')) && strlen(Config::get('Constant.SOCIAL_FB_LINK')) > 0)
                       <li><a href="{{ Config::get('Constant.SOCIAL_FB_LINK') }}" title="Follow Us On Facebook" target="_blank" rel="nofollow">
                        <i class="fa-brands fa-facebook-f"></i></a></li>
                        @endif
                        @if(null!==(Config::get('Constant.SOCIAL_TWITTER_LINK')) && strlen(Config::get('Constant.SOCIAL_TWITTER_LINK')) > 0)
                        <li><a href="{{ Config::get('Constant.SOCIAL_TWITTER_LINK') }}" title="Follow Us On Twitter" target="_blank" rel="nofollow">
                            <i class="fa-brands fa-x-twitter"></i></a></li>
                            @endif
                            @if(null!==(Config::get('Constant.SOCIAL_PINTEREST_LINK')) && strlen(Config::get('Constant.SOCIAL_PINTEREST_LINK')) > 0)
                            <li><a href="{{ Config::get('Constant.SOCIAL_PINTEREST_LINK') }}" title="Follow Us On Pinterest" target="_blank" rel="nofollow">
                                <i class="fa-brands fa-pinterest-p"></i></a></li>
                                @endif
                                @if(null!==(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) && strlen(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) > 0)
                                <li><a href="{{ Config::get('Constant.SOCIAL_LINKEDIN_LINK') }}" title="Follow Us On Linkdin" target="_blank" rel="nofollow">
                                    <i class="fa-brands fa-linkedin-in"></i></a></li>
                                    @endif 
                                    <li><a href="https://www.instagram.com/hostitsmart/" title="Follow Us On Instagram" target="_blank" rel="nofollow">
                                        <i class="fa-brands fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-btm-row">
                            <div class="row justify-content-center">
                                <div class="col-lg-2">
                                    <div class="footer-btm-cnt">
                                        <a href="../privacy-policy" title="Privacy Policy">Privacy Policy</a>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="footer-btm-cnt">
                                        <p>Copyright 2024 © Hosting World PVT. LTD. All rights reserved.</p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="footer-btm-cnt">
                                        <a href="../sitemap" title="Sitemap">Sitemap</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dv-hst">
                            <p>Proudly Developed and Hosted in India</p>
                        </div>
                    </div>

                </footer>

            </div>
            <script language="javascript">
    //Hide Old Price from every Places.
               $('.line-through').addClass('d-none');
               $('.price-overline-text').addClass('d-none');
               $('.p_p_linethrough').addClass('d-none');
               $('.linethrough-price').addClass('d-none');
               function setCookie(c_name,value,exdays){var exdate=new Date();exdate.setDate(exdate.getDate()+exdays);var c_value=escape(value)+((exdays==null)?"":"; expires="+exdate.toUTCString());document.cookie=c_name+"="+c_value}function getCookie(c_name){var i,x,y,ARRcookies=document.cookie.split(";");for(i=0;i<ARRcookies.length;i++){x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);x=x.replace(/^\s+|\s+$/g,"");if(x==c_name){return unescape(y)}}}function checkCookie(){var popups=getCookie("hits");if(popups!='Y'){document.getElementById('js-gdpr-consent-banner').style.display=''}else{document.getElementById('js-gdpr-consent-banner').style.display='none';jQuery("#js-gdpr-consent-banner").html('');$('.gdpr_code').css('padding','0')}}function GetGDPRCLOSE(){setCookie("hits",'Y',365);document.getElementById('js-gdpr-consent-banner').style.display='none';jQuery("#js-gdpr-consent-banner").html('');$('.gdpr_code').css('padding','0');return false}function bclose(){parent.$("#popupContact2").bPopup().close();disablePopup();return false}
           </script>

           @include('template.cockies_popup')

           <a href="#home" class="scrollToTop " title="Scroll To Top"><div class="btn-img"></div></a>
       </div>

       @if(null!==(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) && strlen(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) > 0)
       <a href="{{Config::get('Constant.SOCIAL_WHATSAPP_LINK')}}" class="wa-float waves-block aos-init" data-aos="flip-left" target="_blank" title="Whatsapp Support">
        @endif 

        <i class="fa fa-whatsapp wa-float-icon"></i>
    </a>


    <div class="modal fade loginPopup signup-box-24" id="loginModal" tabindex='-1'>

        <div class="modal-dialog modal-dialog-centered modal-lg login-modal-dialog">

            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6 col-lg-6 login-left-col">
                                <div class="login-box-flex">
                                    <div class="login-box-right">
                                        <div class="login-box-right-head">
                                            <h3>Our Clients Speak for Us!</h3>
                                        </div>
                                        <div class="login-box-ratings">
                                            <div class="login-box-ratings-box">
                                                <div class="login-box-ratings-main">
                                                    <div class="login-box-circle">
                                                        <span class="cir-span-1"></span>
                                                        <span class="cir-span-2"></span>
                                                        <span class="cir-span-3"></span>
                                                    </div>
                                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators login-box-carousel-indicators">
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                                        </ol>
                                                        <div class="carousel-inner">
                                                            <div class="login-box-carousel-item carousel-item active">
                                                                <p>I have been using Host IT Smart for almost a year now, and there is only one sentence to say "THE BEST HOSTING COMPANY EVER." The support and service are BEYOND EXCELLENT. I want to say especially thanks to Jay, who gave me support too quick and was very helpful on my requirements.</p>
                                                                <div class="login-box-rating-star">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                </div>
                                                                <h2>Shivang Kareliya</h2>
                                                            </div>
                                                            <div class="login-box-carousel-item carousel-item">
                                                                <p>Exceptional help center! Quick and effective solutions provided with a friendly and knowledgeable team. They made my experience smooth and hassle-free. Definitely my go-to for assistance.</p>
                                                                <div class="login-box-rating-star">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                </div>
                                                                <h2>s2 TECH INDIA</h2>
                                                            </div>
                                                            <div class="login-box-carousel-item carousel-item">
                                                                <p>Considering hosting services, Host IT Smart stands out with its excellent quality, competitive pricing, and reliable support. When compared to Big Rock, Host IT Smart consistently delivers top-notch service at the best prices. Experience unmatched hosting with Host IT Smart for a seamless and cost-effective online presence.</p>
                                                                <div class="login-box-rating-star">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                </div>
                                                                <h2>Laxmi Ayyavari</h2>
                                                            </div>
                                                            <div class="login-box-carousel-item carousel-item">
                                                                <p>One of the best service providers. Extremely satisfied with their customer service and cost effectiveness. Using their services for quite a long and have never faced any delays in taking action against issues. Thanks much!! </p>
                                                                <div class="login-box-rating-star">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                </div>
                                                                <h2>Urvashi Shrivastava</h2>
                                                            </div>
                                                            <div class="login-box-carousel-item carousel-item">
                                                                <p>I have been using their services quite a lot for the last 6 months. I like the ease of use they provided while working with VPS. Also, In case of any issues, the resolution is quite fast.</p>
                                                                <div class="login-box-rating-star">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                    <img loading="lazy" src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                </div>
                                                                <h2>Divyanshu Agarwal</h2>
                                                            </div>
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="login-ratings-row">
                                            <div class="login-rtng-box">
                                                <div class="login-rtng-img-logo">
                                                    <img loading="lazy" src="../assets/images/new_img/HostAdvice-rating-logo_new.webp" alt="HostAdvice-rating-logo_new">
                                                </div>
                                                <div class="login-rtng-img-star">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                </div>
                                                <p>4.2 Ratings</p>
                                            </div>
                                            <div class="login-rtng-box">
                                                <div class="login-rtng-img-logo">
                                                    <img loading="lazy" src="../assets/images/new_img/Trustpilot-rating-logo_new.webp" alt="Trustpilot-rating-logo_new">
                                                </div>
                                                <div class="login-rtng-img-star">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                </div>
                                                <p>4.0 Ratings</p>
                                            </div>
                                            <div class="login-rtng-box">
                                                <div class="login-rtng-img-logo">
                                                    <img loading="lazy" src="../assets/images/new_img/google-rating-logo_new.webp" alt="google-rating-logo_new">
                                                </div>
                                                <div class="login-rtng-img-star">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                    <img loading="lazy" src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                </div>
                                                <p>4.4 Ratings</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-10 col-lg-6 login-right-col">
                                <div class="login-signup-wrap bg-white rounded shadow">
                                    <div class="login-box-header">
                                        <div class="login-box-logo mb-5">
                                            <img loading="lazy" alt="logo" src="../assets/images/logo.webp">
                                        </div>
                                    </div>
                                    <form class="login-box-form" id="signup-form" action="{{ url('/front-register') }}" method="post" role="form" style="display: block;">
                                        {!! csrf_field() !!}
                                        <div class="form-group mb-4 name-form-grp {{ $errors->has('fullname') ? ' has-error' : '' }}">
                                            <!-- Label -->
                                            <label class="pb-3">FULL NAME <span class="required"> *</span></label>
                                            <!-- Input group -->
                                            <div class="input-group input-group-merge">
                                            <!-- <div class="input-icon">
                                    <span class="inp-grp-icon"><i class="fa-solid fa-envelope"></i></span>
                                    </div> -->
                                    <input type="text" name="fullname" id="fullname" tabindex="1" class="form-control" placeholder="full name" value="" required="required" autocomplete=off pattern="[a-zA-Z\s'']+" title="Please enter valid input">
                                    @if ($errors->has('fullname'))
                                    <span>
                                        {{ $errors->first('fullname') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @php $diaplayCountry=''; @endphp
                            @foreach($countryCode as $key=>$val)
                            @if($key==Config::get('Constant.sys_country'))
                            @if($key==Config::get('Constant.sys_country'))
                            @php $diaplayCountry=$val; @endphp
                            @endif
                            @endif
                            @endforeach
                            <div class="mob-nmbr-col">
                                <div class="row">
                                    <div class="col-lg-4 col-4">
                                        <div class="code-row">
                                            <div class="form-group mb-4 {{ $errors->has('otpcountry') ? ' has-error' : '' }}">
                                                <label class="pb-3" for="exampleFormControlSelect1">COUNTRY</label>
                                                <div class="input-group input-group-merge">
                                                    <select class=" form-control" data-live-search="true" id="exampleFormControlSelect1" name="otpcountry">
                                                        <option value="">Select</option>
                                                        @php $country_count=0; @endphp
                                                        @if(isset($countryDialingCode))
                                                        @foreach($countryDialingCode as $key => $itm)
                                                        <option data-icon="flagstrap-icon {{$itm['cflag']}}" value="{{$itm['ccode']}}_{{$country_count}}" @if($diaplayCountry==$itm['cname']) selected @else @endif> {{$itm['cname']}} (+{{$itm['ccode']}})</option>
                                                        @php $country_count++; @endphp
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @if ($errors->has('otpcountry'))
                                                    <span class="help-block">
                                                        {{ $errors->first('otpcountry') }}
                                                    </span>
                                                    @endif
                                                    <span id="country_error_msg"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-8 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                        <div class="number-row">
                                            <div class="form-group mb-4">
                                                <label class="pb-3"> PHONE NO<span class="required"> * </span></label>
                                                <div class="input-group input-group-merge">
                                                    <input type="tel" name="phone_number" id="hits_phone_number" value="" tabindex="1" class="form-control" placeholder="Phone Number" value="" required="required" pattern="^(?!(?:\D*0)+\D*$)\(?([0-9]{3})\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$" autocomplete=off>
                                                    @if ($errors->has('phone_number'))
                                                    <span class="help-block">
                                                        {{ $errors->first('phone_number') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <!-- Label -->
                                <label class="pb-3"> Email Address <span class="required"> * </span></label>
                                <!-- Input group -->
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="inp-grp-icon"><i class="fa-solid fa-envelope"></i></span>
                                    </div>
                                    <input type="text" name="email" id="gt_hits_email" tabindex="2" class="form-control" placeholder="Email ID" value="" required="required" autocomplete=off>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <!-- Label -->
                                <label class="pb-3"> Password <span class="required"> * </span></label>
                                <!-- Input group -->
                                <div class="input-group input-group-merge password-container">
                                    <div class="input-icon">
                                        <span class="inp-grp-icon"><i class="fa-solid fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password1" tabindex="3" class="form-control" placeholder="Enter your password" required="required" autocomplete=off>
                                    <span toggle="#password1" id="sign_up_pass" class=""></span>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}
                                    </span>
                                    @endif
                                    {{-- <input type="password" id="password" class="form-control" placeholder="Enter your password" /> --}}
                                    <div class="input-group-append">
                                        <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('password1', this)"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group login-box-terms">
                                {{-- <input type="checkbox" id="check-remember" name="check-remember" value="Bike"> --}}
                                <input type="checkbox" tabindex="4" name="tc" id="tc" checked="check" required="required">
                                <label for="check-terms"> I want to receive personalized offers, updates & information about Host IT Smart's products & services. <span class="required"> * </span></label><br>
                            </div>

                            <div class="form-group captcha-box">
                                <div class="form-group">
                                    <div id="html_element123" class="g-recaptcha form-text" data-sitekey="{{ Config::get('Constant.GOOGLE_CAPCHA_KEY') }}" data-callback="check_captcha"></div>
                                    <div class="capphitcha">
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            {{ $errors->first('g-recaptcha-response') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="d-grid sign-up-box-btn">
                                <input name="register-submit" type="button" id="register-submit" tabindex="5" class="btn btn-primary mt-3 mb-3" value="Proceed">
                                <a href="javascript:;" tabindex="6" class="already-member">I'm already member</a>
                                <!-- sign-up-form-e -->

                            </div>


                        </form>
                        <!-- OTP-form-s -->
                        <form id="otp-verification-form2" class="otp-box-form" action="{{ url('/') }}" method="post" role="form" style="display:none;">

                            {!! csrf_field() !!}
                            <p>Please enter OTP you have recieved on your mobile number.</p>
                            <div class="otp-row">
                                <div class="form-group mb-4 {{ $errors->has('txtphoneno') ? ' has-error' : '' }}">
                                    <label class="pb-3"> OTP* </label>
                                    <div class="input-group input-group-merge">
                                        {{-- <input type="tel" class="form-control" name="tel" placeholder="Enter your OTP."> --}}
                                        <input type="text" name="txt_otp" id="txt_otp" tabindex="1" class="form-control" placeholder="Enter your OTP." value="" required="required" autocomplete=off>
                                        @if ($errors->has('txt_otp'))
                                        <span class="help-block">
                                            {{ $errors->first('txt_otp') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid sign-up-box-btn">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-6">

                                        <a href="javascript:;" tabindex="6" id="verifyotpbtn" class="btn btn-login text-white">Verify OTP</a>
                                    </div>
                                    <div class="col-lg-6 col-6 text-center">
                                        <a href="javascript:;" tabindex="6" id="resendotplink" class="resendotplink forgot-password">Resend OTP</a>
                                    </div>
                                </div>
                            </div>
                            <div class="resend-otp-cnt" id="reotp-cnt" style="display: none;">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="otp-cnt" >
                                            You've requested a resend! Please check your SMS inbox for the OTP. It may take a few moments to arrive.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group login-btn-part" id="verifyotpalert" style="display:none;">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger">
                                            <strong>Opps!</strong> OTP not verified, Please try again later.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <!-- sign-in-form-s -->
                        {{-- <form class="login-box-form d-none">  --}}
                            <form class="login-box-form " id="signin-form" action="{{ url('/front-login') }}" method="post" role="form" style="display:none;">
                                {!! csrf_field() !!}

                                <div class="form-group mb-4 {{ $errors->has('loginusername') ? ' has-error' : '' }}">
                                    <label class="pb-4"> Email Address </label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-icon">
                                            <span class="inp-grp-icon"><i class="fa-solid fa-envelope"></i></span>
                                        </div>
                                        @if(Cookie::get('front_cookie_login_email'))
                                        <input type="text" name="loginusername" id="loginusername" value="{{Cookie::get('front_cookie_login_email')}}" tabindex="1" class="form-control" placeholder="Enter your Email" value="" required="required" autocomplete=off>
                                        @else
                                        <input type="text" name="loginusername" id="loginusername" value="" tabindex="1" class="form-control" placeholder="name@address.com" value="" required="required" autocomplete=off>
                                        @endif
                                        @if ($errors->has('loginemail'))
                                        <span class="help-block">
                                            {{ $errors->first('loginemail') }}
                                        </span>
                                        @endif
                                        {{-- <input type="email" class="form-control" placeholder="name@address.com" /> --}}
                                    </div>
                                </div>




                                <div class="form-group {{ $errors->has('loginpassword') ? ' has-error' : '' }}">
                                    <label class="pb-4"> Password </label>
                                    <div class="input-group input-group-merge password-container">
                                        <div class="input-icon">
                                            <span class="inp-grp-icon"><i class="fa-solid fa-lock"></i></span>
                                        </div>
                                        @if(Cookie::get('front_cookie_login_password'))
                                        <input type="password" name="loginpassword" id="loginpassword" value="{{Cookie::get('front_cookie_login_password')}}" tabindex="2" class="form-control" placeholder="....." required="required" autocomplete=off>
                                        <span toggle="#loginpassword" class="" id="sign_in_pass"></span>
                                        @else
                                        <input type="password" name="loginpassword" id="loginpassword" value="" tabindex="2" class="form-control" placeholder="....." required="required" autocomplete=off>
                                        <span toggle="#loginpassword" class="" id="sign_in_pass"></span>
                                        @endif

                                        {{-- <input type="password" id="password" class="form-control" placeholder="Enter your password" /> --}}
                                        <div class="input-group-append">
                                            <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('loginpassword', this)"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group login-box-checkbox">
                                    {{-- <input type="checkbox" id="check-remember" name="check-remember" value="Bike"> --}}
                                    {{-- <label for="check-remember"> Remember me</label><br> --}}

                                    @if(Cookie::get('front_remember'))
                                    <input type="checkbox" class="filled-in" tabindex="3" name="remember" id="remember" checked="check">
                                    @else
                                    <input type="checkbox" class="filled-in" tabindex="3" name="remember" id="remember">
                                    @endif
                                    <label for="remember"> Remember Me</label> <br>

                                </div>
                                <div class="captcha-box">
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

                                <div class="d-grid sign-up-box-btn">

                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-login my-3" value="Sign in">

                                </div>
                                   {{--  <div class="forgot-password-box">
                                        <a href="javascript:;" tabindex="5" class="forgot-password">Forgot Password ?</a>
                                    </div> --}}
                                </form>
                                <!-- sign-in-form-e -->

                                <!-- forgot-password-form-s -->

                                <form class="login-box-form" id="reset-form" action="{{ url('/front/password/reset') }}" method="post" role="form" style="display: none;">
                                    {!! csrf_field() !!}

                                    <div class="login-box-header">
                                        <span class="mb-2 text-left">Oops, forgot your secret key? No worries, we’ve got you covered! </span>
                                        <p class="mb-5">Enter your email address below to begin the reset process & return to your digital kingdom!</p>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="pb-4">Enter Your Email Address* </label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="inp-grp-icon"><i class="fa-solid fa-envelope"></i></span>
                                            </div>
                                            <input type="text" name="resetemail" id="resetemail" value="" tabindex="1" class="form-control" placeholder="name@address.com" value="" required="required" autocomplete=off>
                                            @if ($errors->has('resetemail'))
                                            <span class="help-block">
                                                {{ $errors->first('resetemail') }}
                                            </span>
                                            @endif


                                        </div>
                                    </div>
                                    <div class="d-grid sign-up-box-btn">


                                        <input type="submit" name="login-submit" id="reset-password" tabindex="4" class="btn btn-login my-3" value="Send Reset Link">

                                    </div>
                                    <div class="forgot-password-box">
                                        {{-- <a href="/reset-passwod">Sign in</a> --}}
                                        <a href="javascript:;" tabindex="6" class="signinusr forgot-password">Sign In</a>
                                    </div>
                                </form>
                                <!-- forgot-password-form-e -->

                                <!-- password-reset-link-s -->
                                <form action="javascript:;" class="thank-you-box" style="display: none;" id="password-reset-link">
                                    <h2>Password Reset Link Sent</h2>

                                    <p><strong>We have sent a password reset link to your email. Please check your inbox to proceed with resetting your password. If you do not see the email, be sure to check your spam or junk folder.</strong></p>
                                    <div class="d-grid sign-up-box-btn">
                                        <input type="submit" name="" id="closedpopup" tabindex="4" class="btn btn-login my-3" value="Back to Login">
                                    </div>
                                </form>
                                <!-- password-reset-link-e -->

                                <!-- thank-you-box-s -->
                                <form action="javascript:;" class="thank-you-box" style="display: none;" id="thank_you_box">
                                    <h2>Thank You for Joining Host IT Smart!</h2>
                                    <p>Welcome to the Host IT Smart family! Your journey to smarter web hosting starts now, and we are thrilled to have you join us.</p>
                                    <p>Need any help? Our support team is here for you 24/7.</p>
                                    <p><strong>Happy Hosting!</strong></p>
                                    <div class="d-grid sign-up-box-btn">
                                        <input type="submit" name="" id="closedpopup1" tabindex="4" class="btn btn-login my-3 text-white" value="Start Exploring & Purchasing">
                                    </div>
                                </form>
                                <!-- thank-you-box-e -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<button id="scrollToTopBtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>
<div id="browsernote" style="display:none;position:fixed;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:9999;top:0;left:0;font-size:18px;">
    <div style="font-size:18px;color:#fff;background:#18b35c;padding:15px;text-align:center;height:60px;z-index:9999;position:fixed;width:100%;top:0;margin:auto;">For a better experience on <strong style="color:#000;">{{ Config::get('Constant.SITE_NAME') }},</strong><a href="https://support.apple.com/downloads" style="cursor:pointer;color: #ffffff;font-size:14px;margin-left:10px;display:inline-block;" target="_blank">update your browser.</a>
    </div>
</div>




<script type="text/javascript">

    $(window).on('load resize change', function () {

        var account_name = $("#otpcountry option:selected").text();
        var account_array = account_name.split("-");
        var account_num = account_array[0];

        $(".country_select  .filter-option-inner").html(account_num);

    });

    $(window).on("load resize", function () {
        if ($(window).width() < 767) {
            $(".loginPopup .modal-dialog-centered").removeClass("modal-dialog-centered");
        }
        else{
            $(".loginPopup .modal-dialog").addClass("modal-dialog-centered");
        }
    });            
    $("#createaccount").click(function(){
        $("#signup-form-link").click();
    });
    var APP_URL = {!! json_encode(url('/')) !!};
    function copyPromocCode(val){var copyText=document.getElementById(val);copyText.select();document.execCommand("copy");$("."+val).html("Copied")}
    <?php if(isset(Request()->offer) && Request()->offer == 'dedicatedserver') { ?>
        $('#slider').carousel(3);$('#slider').carousel('pause');setTimeout(function(){$("#lucky-draw-popup").modal('show')},1000);
    <?php } ?>
    $('#lucky-draw-popup').on('show.bs.modal',function(e){$('#spinner-div').show();$('#lucky-draw-content').hide();$(".dedicatedoffercode").html("Copy");$('#lucky-draw-popup .modal-title').text('Spinning please wait...');setTimeout(function(){var offercode=$.ajax({type:"GET",url:"getoffercode.php",async:false}).responseText;$("#dedicatedoffercode").val(offercode);$('#spinner-div').hide();$('#lucky-draw-content').show();$('#lucky-draw-popup .modal-title').text('You won your luck..')},3000)});

</script>
<?php
if (session()->has('whmsc_url')) {
    ?>
    <script type="text/javascript">
        var WHMSC_URL = '<?= session()->get('whmsc_url')[0] ?>';
        var res_whmsc = WHMSC_URL.replace("http://", "https://");
        $.ajax({url:res_whmsc,type:"get",async:true,headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},success:function(response){},error:function(data,textStatus,errorThrown){console.log(data)},});
    </script>
<?php } ?>


<?php if (session()->has('failed_login')) { ?>
    <script type="text/javascript">
        alert("<?= session()->get('failed_login') ?>");
    </script>
<?php } elseif (session()->has('email_not_found')) { ?>
    <script type="text/javascript">
        alert("<?= session()->get('email_not_found') ?>");
    </script>
<?php } ?>

<script src="{{Config::get('Constant.CDNURL')}}/assets/js/common_v12.js?v={{date('YmdHi')}}" type="text/javascript" ></script>

<script type="text/javascript">
    var baseUrl = "{{ url('/') }}";
    $("#signup-form-link").click(function () {
        $(".signin-btn").text("Create Account"), $("#signup-form").show();
    });
    function hidetopdeals() {
        $(".top-header").hide();
    }
    function getcurrency(i) {
        "INR" == i
            ? confirm("Are you sure? You wants to move to india location website.")
                ? (window.location = baseUrl)
                : ($("#currency").val("USD"), $("#currency").selectpicker("refresh"))
            : confirm("Are you sure? You wants to move to Global location website.")
            ? (window.location = "https://global.hostitsmart.com")
            : ($("#currency").val("INR"), $("#currency").selectpicker("refresh")),
            $("#currency").selectpicker("refresh");
    }
    $(".forgot-password").click(function () {
        $("#reset-form").show(), $("#signin-form").hide(), $(".sign-with").hide();
    }),
        $(".already-member,.signinusr").click(function () {
            $(".signin-btn").text("Login"),
                $("#reset-form").hide(),
                $("#signup-form").hide(),
                $("#otp-verification-form").hide(),
                $("#signin-form").show(),
                $(".signup-btn").removeClass("active"),
                $(".signin-btn").addClass("active"),
                $(".sign-with").show();
        }),
        $("#signin-form-link").click(function () {
            $("#signin-form-link").text("Login"), $("#otp-verification-form2,#reset-form, #signup-form,.sign-with").hide(), $("#signin-form").show();
            return false;
        }),
        $("#signup-form-link").click(function () {
            $("#reset-form, #signin-form, .sign-with").hide(), $(".signin-btn").removeClass("active"), $(".signup-btn").addClass("active");
            return false;
        }),
        $("#signup-form-link").click(function () {
            $("#fullname").focus();
            $("#one").hide(), $("#two").show();
        }),
        $("#signin-form-link").click(function () {
            $("#one").show(), $("#two").hide();
        });

    $(document).ready(function () {
        $(".more-features").click(function () {
            var txt = $(this).text();
            if (txt == "More") {
                $(this)
                    .parent()
                    .find(".slide-toggle")
                    .each(function () {
                        $(this).slideDown().find("li").slideDown();
                    });
                $(this).html("<i class='la la-minus'></i>Less");
            } else if (txt == "Less") {
                $(this)
                    .parent()
                    .find(".slide-toggle")
                    .each(function () {
                        $(this).slideUp().find("li").slideUp();
                    });
                $(this).html("<i class='la la-plus'></i>More");
            }
        });
    });

    $("#otp-verification-form").submit(function (e) {
        var arr = $("#otpcountry").val().split("_");
        var cuntrycd = "+" + arr["0"];
        var pno = $("#phone_number").val().split(cuntrycd);
        $("#phone_number").val(pno["1"]);
    });

    $("#sendotpbtn").click(function () {
        $("#signup-form").submit();
    });
    $("#verifyotpbtn").click(function () {
        $("#otp-verification-form2").submit();
    });

    var form = $("#signup-form");

    function sendOtp(formData) {
        $("#sendotpbtn").text("Sending...");

        $.ajax({
            url: "{{url('/otp-send')}}", // Assuming the same endpoint for both initial send and resend
            data: formData,
            type: "post",
            success: function (response) {
                if (eval(response) == 1) {
                    $("#signin-form, #signup-form, #otp-verification-form, #otp-verification-form2, #reset-form").hide();
                    $("#otp-verification-form2").show();
                    // $("#thank_you_box").show();
                } else {
                    $("#sendotpbtn").text("Send OTP");
                    $("#sendotpalert").show();
                }
            },
        });
    }
    $("#register-submit").click(function () {
        if ($("#signup-form").valid()) {
            var formData = $("#signup-form").serialize();
            sendOtp(formData);
        }
    });

    $("#resendotplink").click(function () {
        var formData = $("#signup-form").serialize(); // Adjust this if different data is needed for resending OTP
        sendOtp(formData);
        $("#reset-form").hide();
        $("#reotp-cnt").show(); // Show the resend OTP message
        $("#otp-verification-form2").show(); // Ensure the OTP verification form is shown
    });

    $(document).ready(function () {
        var popupshow = localStorage.getItem("popupshow") || 0;

        $("#otp-verification-form2").validate({
            rules: {
                txt_otp: {
                    required: true,
                },
            },
            messages: {
                txt_otp: {
                    required: "Please enter OTP.",
                },
            },
            submitHandler: function () {
                $("#verifyotpbtn").text("Verifying...");

                var formData = $("#otp-verification-form2").serialize();
                $.ajax({
                    url: "/otp-doverification", // Correct URL
                    data: formData,
                    type: "post",
                    success: function (response) {
                        if (response && response == 1) {
                            // OTP is correct, submit the signup form
                            $("#signup-form").submit();
                            localStorage.setItem("popupshow", "11"); // Store popupshow value
                        } else {
                            // OTP is incorrect, show alert and reset button text
                            $("#verifyotpalert").show(); // Show wrong OTP alert message
                            $("#verifyotpbtn").text("Verify OTP"); // Revert button text
                        }
                    },
                    error: function () {
                        // Handle any errors from the AJAX request
                        $("#verifyotpalert").show(); // Show alert if there's a request failure
                        $("#verifyotpbtn").text("Verify OTP"); // Revert button text
                    },
                });

                return false; // Prevent form from submitting normally
            },
        });

        if (popupshow == "11") {
            setTimeout(function () {
                $("#signin-form, #otp-verification-form, #otp-verification-form2, #reset-form, #signup-form").hide();
                $("#loginModal").modal("show");
                $("#thank_you_box").show();

                // Close popup when close button is clicked
                $(".close, #closedpopup,#closedpopup1").click(function () {
                    $("#thank_you_box").hide();
                    $("#loginModal").modal("hide");
                    localStorage.setItem("popupshow", "0"); // Update localStorage to prevent showing popup again
                });

                // Close popup when clicking outside the popup or on a blank area
                $(document).on("click", function (event) {
                    if (!$(event.target).closest("#thank_you_box").length) {
                        $("#thank_you_box").hide();
                        $("#loginModal").modal("hide");
                        localStorage.setItem("popupshow", "0"); // Update localStorage to prevent showing popup again
                    }
                });
            }, 1000);
        }
    });
</script>

    <script type="text/javascript">
            // Close popup when close button is clicked
        $("#close-cartfull-popup").click(function() {            
           $("#cartfull-popup").modal('hide');
       });
   </script>


   <?php if(strpos(url()->current(),"servers/vps-hosting") !== false){ ?>
    <script src="{{Config::get('Constant.CDNURL')}}/assets/js/vps-range-jquery-ui.js"></script>
<?php } ?>
{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
<script async defer src="https://www.google.com/recaptcha/api.js?onload=onLoadCallback&render=explicit"></script>

<script type="text/javascript">
    function validateForm(){let e=$("#email").val(),s=$("#subs-checkbox").is(":checked"),t=grecaptcha.getResponse(),a=!0;return/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e)?$("#error-message").html(""):(a=!1,$("#error-message").html("*Please enter a valid email address.")),s?$("#checkbox-message").html(""):(a=!1,$("#checkbox-message").html("*You must agree to the terms.")),0===t.length?(a=!1,$("#captcha-message").html("*Captcha is required.")):$("#captcha-message").html(""),a}document.getElementById("ic_signupform").addEventListener("submit",function(e){e.preventDefault(),validateForm()&&this.submit()}),$("#email").on("input",function(){$("#error-message").html("")}),$("#subs-checkbox").on("change",function(){$("#checkbox-message").html("")}),$("#subs-g-recaptcha").on("change",function(){$("#captcha-message").html("")});

    $(document).ready(function(){if($('#signin-form-link').hasClass('active')){$("#one").show();$("#two").hide()}else{$("#one").hide();$("#two").show()}if($.cookie("header_deals_close")!="Y"){$.cookie("header_deals_close","N")}if($.cookie("header_deals_close")=="N"){$(".top-header").show()}});function hidetopdeals(){$(".top-header").hide();$.cookie("header_deals_close","Y")}

    @if (\Request::is('domain'))
    superplaceholder({el:domainname,sentences:['Search for a Domain Name','Search for a Domain Name','Search for a Domain Name'],options:{letterDelay:180,loop:true,startOnFocus:false}});
    @endif
    $(function(){$('#bulkdomains').keyup(function(event){if(event.keyCode=='13'){$('#bulksearchfrm').submit()}})});

    var loadDeferredStyles=function(){var addStylesNode=document.getElementById("deferred-styles");var replacement=document.createElement("div");replacement.innerHTML=addStylesNode.textContent;document.body.appendChild(replacement);addStylesNode.parentElement.removeChild(addStylesNode)};var raf=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame;if(raf)raf(function(){window.setTimeout(loadDeferredStyles,0)});else window.addEventListener('load',loadDeferredStyles);
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/62b3fcc37b967b1179961023/1g67h6nc3';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    },5000);
</script>
<!--End of Tawk.to Script-->
<script type="text/javascript">
    $(window).scroll(function() {  
        if($(window).scrollTop() < 200) { $("#top_bar").css({"position":"relative","top":"0","width":"100%","z-index":"9999"}); }
        else { $("#top_bar").css({"position":"fixed","top":"0","width":"100%","z-index":"9999"});     }
    });
</script>
<script type="text/javascript">
    var isCaptchaRendered = false;
    var onloadCallbackSignin = function() {
        grecaptcha.render('html_element', {
            'sitekey': '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}'
        });
    // grecaptcha.render('html_element2456', {
    //     'sitekey': '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}'
    // });
    };
    function check_captchaSignin() {
        $('#signin-form').valid();
    }



    function loadRecaptchaScript() {
        var script = document.createElement('script');
        script.src = 'https://www.google.com/recaptcha/api.js?onload=onloadCallbackSignin&render=explicit';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }
// Load the reCAPTCHA script immediately
    loadRecaptchaScript();
    $.getScript("{{url('cart/counter')}}", function (data) {
        if (data) {
            data = parseInt(data);

            if (data > 0) {
                $('#cart_cout_m').html(data).show();
                $('#cart_cout').html(data).show();
            } else {
                $('#cart_cout_m').hide().removeClass('counter');
                $('#cart_cout').hide().removeClass('counter');
            }
        }
    });
    <?php if (session()->has('whmcsloginurl')) { $_url = session()->get('whmcsloginurl'); ?>
    $.getScript("<?php echo trim($_url); ?>",function(data){});
<?php } ?>

</script>
@include('template.seoschema')
{{-- @include('template.blkfspinwheelfrhosting') --}}
{{-- @include('template.vps-extra-offer-tour')
@include('template.spinwheelfrhosting')
@include('template.spinwheelfrvps')
@include('template.spinwheeltour') --}}
{{-- @include('template.independece-day-2021') --}}

{{-- christmas-2021 start --}}
{{-- <link rel="stylesheet" href="{{URL::to('/assets/css/jquery.toast.css?v=')}}{{date('YmdHi')}}">
<script src="{{URL::to('/assets/js/jquery.toast.js')}}"></script> --}}
<script type="text/javascript">




    @if(Request::segment(1)!='cart')
        /*$(function(){
            tosterone("","Select from these 3 packages according to your needs.","success","bottom-left");
        });*/
        /*setTimeout(function(){
            tosterone("","Select from these 3 packages according to your needs.","success","bottom-left");
        }, 7000);*/
    @endif
</script>
{{-- js for password validation --}}

<!-- scroll-to-top-button-S -->
<script>
    function scrollFunction(){let o=document.getElementById("scrollToTopBtn");o&&(document.body.scrollTop>20||document.documentElement.scrollTop>20?o.style.display="block":o.style.display="none")}window.onscroll=function(){scrollFunction()},document.addEventListener("DOMContentLoaded",function(){let o=document.getElementById("scrollToTopBtn");o&&o.addEventListener("click",function(){document.body.scrollTop=0,document.documentElement.scrollTop=0})});
</script>
<script>
// Show signup form and hide signin form when "Create Account" button is clicked
    $(document).ready(function(){$(".createaccount").click(function(){$("#signup-form").show(),$("#signin-form").hide(),$("#loginModalLabel").text("Create Account")}),$(".loginpopup").click(function(){$("#signup-form").hide(),$("#signin-form").show(),$("#loginModalLabel").text("Sign in")})});
</script>
<script>
    function togglePasswordVisibility(s,e){let a=document.getElementById(s);"password"===a.type?(a.type="text",e.classList.remove("fa-eye"),e.classList.add("fa-eye-slash")):(a.type="password",e.classList.remove("fa-eye-slash"),e.classList.add("fa-eye"))}
</script>
<!-- scroll-to-top-button-E -->
<!-- footer-menu-for-mobile-view-s -->
<script>
// JavaScript to toggle accordion content for mobile view only
    document.addEventListener("DOMContentLoaded",function(){let e=document.querySelectorAll(".accordion-toggle");e.forEach(t=>{t.addEventListener("click",function(){if(window.innerWidth<=992){e.forEach(e=>{e!==t&&(e.classList.remove("active"),e.nextElementSibling.style.display="none")}),this.classList.toggle("active");let i=this.nextElementSibling;"block"===i.style.display?i.style.display="none":i.style.display="block"}})}),window.addEventListener("resize",function(){window.innerWidth>992&&e.forEach(e=>{e.classList.remove("active");let t=e.nextElementSibling;t.style.display=""})})});
</script>
    <!-- footer-menu-for-mobile-view-e -->