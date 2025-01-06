<div class="footer-start">
<footer class="d-flex">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-sm-4 col-6">
                <div class="footers-links aos-init" data-aos="fade-up" data-aos-delay="100">
                    <div class="footer-head-responsive d-block d-sm-none">
                        Quick Links
                    </div>
                    @php
                    $footerDomain = ''; 
                    $footerHosting = ''; 
                    $footerServer = ''; 
                    $footerSSL = ''; 
                    $footerDeals = ''; 
                    $footerSupport = '';
                    $home_selected = '';
                    $footerawssupport = '';
                    $footeremail = '';
                    @endphp
                    @if(request()->route()->getName() == "home")
                    @php
                    $home_selected = "active";
                    @endphp
                    @endif
                    @if(Request::segment(1) == "domain" && empty(Request::segment(2)))
                    @php 
                    $footerDomain = "active";
                    @endphp
                    @elseif(Request::segment(1) == "hosting" && empty(Request::segment(2)))
                    @php 
                    $footerHosting = "active";
                    @endphp
                    @elseif(Request::segment(1) == "servers" && empty(Request::segment(2)))
                    @php 
                    $footerServer = "active";
                    @endphp
                    @elseif(Request::segment(1) == "ssl-certificates" && empty(Request::segment(2)))
                    @php
                    $footerSSL = "active";
                    @endphp    
                    @elseif(Request::segment(1) == "deals")
                    @php
                    $footerDeals = "active";
                    @endphp    
                    @elseif(Request::segment(1) == "aws-support-services")
                    @php
                    $footerawssupport = "active";
                    @endphp    
                    @elseif(Request::segment(1) == "email")
                    @php
                    $footeremail = "active";
                    @endphp    
                    @endif

                    <a class="footer-head {{$home_selected}}" href="{{url('/')}}" >Home</a>
                    <ul>
                        <li><a href="{{url($header_menu[0]->varAlias)}}" title="{{$header_menu[0]->varTitle}} Registration" class="{{$footerDomain}}">{{$header_menu[0]->varTitle}}</a></li>
                        <li><a href="{{url($header_menu[1]->varAlias)}}" title="Web {{$header_menu[1]->varTitle}}" class="{{$footerHosting}}">{{$header_menu[1]->varTitle}}</a></li>
                        <li><a href="{{url($header_menu[2]->varAlias)}}" title="{{$header_menu[2]->varTitle}}" class="{{$footerServer}}">{{$header_menu[2]->varTitle}}</a></li>
                        <li><a href="{{url($header_menu[3]->varAlias)}}" title="{{$header_menu[3]->varTitle}} Certificate" class="{{$footerSSL}}">{{$header_menu[3]->varTitle}}</a></li>
                        <li><a href="{{url("deals")}}" title="Deals"class="{{$footerDeals}}">Deals</a></li>
                        <li><a href="{{url("aws-support-services")}}" title="AWS Support" class="d-none d-sm-block {{$footerawssupport}}">AWS Support</a></li>
                        <li><a href="{{url("email/google-apps")}}" title="Email" class="d-none d-sm-block {{$footeremail}}">Email</a></li>
                    </ul>
                </div>
            </div> 
            @php 
            $about_selected = '';
            $contact_selected = '';
            $faqs_selected = '';
            $news_selected = '';
            $reseller_program = '';
            $help_selected = '';
            @endphp
            @if(Request::segment(1) == "about-us")
            @php
            $about_selected = "active";
            @endphp
            @elseif(Request::segment(1) == "contact")
            @php
            $contact_selected = "active";
            @endphp
            @elseif(Request::segment(1) == "faqs")
            @php
            $faqs_selected = "active";
            @endphp
            @elseif(Request::segment(1) == "news")
            @php
            $news_selected = "active";
            @endphp
            @elseif(Request::segment(1) == "reseller-program")
            @php
            $reseller_program = "active";
            @endphp
            @endif
            <div class="col-lg-2 col-sm-4 col-6">
                <div class="footers-links links-small second-small-links aos-init" data-aos="fade-up" data-aos-delay="200">
                    <div class="footer-head-responsive d-block d-sm-none">
                        Other Links
                    </div>
                    <div class="footer-head d-none d-sm-block">Company</div>
                    <ul>
                        <li><a href="{{url("about-us")}}" title="About Us" class="{{$about_selected}}">About Us</a></li>
                        <li><a href="{{url("contact")}}" title="Contact" class="{{$contact_selected}}">Contact</a></li>
                        <li><a href="{{url("faqs")}}" title="FAQs" class="{{$faqs_selected}}">FAQs</a></li>
                       <?php //<li><a href="{{url("news")}}" title="News" class="{{$news_selected}}">News</a></li> ?>
                        <li><a href="{{Config::get('Constant.BLOGSITE_LINK')}}" target="_blank" title="Blog">Blog</a></li>
                        <li><a href="{{url("reseller-program")}}" class="{{$reseller_program}}" title="Reseller Program">Reseller Program</a></li>
                    </ul>
                </div>
            </div>
            @php 
            $LinuxHosting = ''; 
            $WindowsHosting = ''; 
            $WordpressHosting = ''; 
            $JavaHosting = ''; 
            $VPSHosting = ''; 
            $DedicatedHosting = ''; 
            $GoogleApps = '';
            $Office365 = '';
            @endphp
            @if(Request::segment(2) == "linux-hosting")
            @php
            $LinuxHosting = "active";
            @endphp
            @elseif(Request::segment(2) == "windows-hosting")
            @php
            $WindowsHosting = "active";
            @endphp
            @elseif(Request::segment(2) == "wordpress-hosting")
            @php
            $WordpressHosting = "active";
            @endphp
            @elseif(Request::segment(2) == "java-hosting")
            @php
            $JavaHosting = "active";
            @endphp
            @elseif(Request::segment(2) == "vps-hosting")
            @php
            $VPSHosting = "active";
            @endphp
            @elseif(Request::segment(2) == "dedicated-servers")
            @php
            $DedicatedHosting = "active";
            @endphp
            @elseif(Request::segment(2) == "google-apps")
            @php
            $GoogleApps = "active";
            @endphp
            @elseif(Request::segment(2) == "microsoft-office-365-suite")
            @php
            $Office365 = "active";
            @endphp
            @endif
            <div class="col-lg-2 col-sm-4 col-6">
                <div class="footers-links links-small d-none d-sm-block aos-init" data-aos="fade-up" data-aos-delay="300">
                    <div class="footer-head">Our Products</div>
                    <ul>
                        <li><a href="{{url('hosting/linux-hosting')}}" title="Linux Hosting" class="{{$LinuxHosting}}">Linux Hosting</a></li>
                        <li><a href="{{url('hosting/windows-hosting')}}" title="Windows Hosting" class="{{$WindowsHosting}}">Windows Hosting</a></li>
                        <li><a href="{{url('hosting/wordpress-hosting')}}" title="Wordpress Hosting" class="{{$WordpressHosting}}">Wordpress Hosting</a></li>
                        <li><a href="{{url('hosting/java-hosting')}}" title="Java Hosting" class="{{$JavaHosting}}">Java Hosting</a></li>
                        <li><a href="{{url('servers/vps-hosting')}}" title="VPS Hosting" class="{{$VPSHosting}}">VPS Hosting</a></li>
                        <li><a href="{{url('servers/dedicated-servers')}}" title="Dedicated Servers" class="{{$DedicatedHosting}}">Dedicated Servers</a></li>
                        <li><a href="{{url('email/google-apps')}}" title="Google Apps" class="{{$GoogleApps}}">Gsuite</a></li>
                        <li><a href="{{url('email/microsoft-office-365-suite')}}" title="Microsoft Office 365 Suite" class="{{$Office365}}">Office 365</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-sm-4 col-6">
                <div class="footers-links links-small d-none d-sm-block aos-init" data-aos="fade-up" data-aos-delay="400">
                    @php 
                    $why_hits_selected = '';
                    $terms_selected = '';
                    $testimonial_selected = '';
                    $domain_policy_selected = '';
                    $payment_options_selected = '';
                    @endphp
                    @if(Request::segment(1) == "why-hits")
                    @php
                    $why_hits_selected = "active";
                    @endphp
                    @elseif(Request::segment(1) == "terms")
                    @php
                    $terms_selected = "active";
                    @endphp
                    @elseif(Request::segment(1) == "testimonial")
                    @php
                    $testimonial_selected = "active";
                    @endphp
                    @elseif(Request::segment(1) == "domain-policy")
                    @php
                    $domain_policy_selected = "active";
                    @endphp
                    @elseif(Request::segment(1) == "payment-options")
                    @php
                    $payment_options_selected = "active";
                    @endphp
                    @endif
                    <div class="footer-head">Quick Links</div>
                    <ul>
                        <li><a href="{{url('/why-hits')}}" title="Why HITS" class="{{$why_hits_selected}}">Why HITS</a></li>
                        <li><a href="{{url('terms')}}"   title="Terms" class="{{$terms_selected}}">Terms</a></li>
                        <li><a href="{{ Config::get('Constant.SITE_URL') }}/manage/index.php/knowledgebase" target="_blank" title="Help">Help</a></li>
                       <?php //<li><a href="{{url('testimonial')}}" class="{{$testimonial_selected}}" title="Testimonial">Testimonial</a></li> ?>
                        <li><a href="{{url('domain-policy')}}" class="{{$domain_policy_selected}}" title="Domain Policy">Domain Policy</a></li>
                        <li><a href="{{url('payment-options')}}" class="{{$payment_options_selected}}" title="Payment Options">Payment Options</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-sm-4 col-6">
                <div class="footers-links links-small d-none d-sm-block aos-init" data-aos="fade-up" data-aos-delay="400">
                    <div class="footer-head">Account</div>
                    <ul>
                        @if(session()->has('frontlogin'))
                        <li><a href="{{ Config::get('Constant.SITE_URL') }}/manage" target="_blank" title="My Account" id="my_account">My Account</a></li>
                        <li><a href="{{ Config::get('Constant.SITE_URL') }}/manage/index.php?rp=/cart/domain/renew" target="_blank" title="My Renewals">My Renewals</a></li>
                        <li><a href="javascript:void(0);" id="logoutlink" onclick="do_logout();" title="Logout">Logout</a></li>
                        @else
                        <li><a href="#" data-toggle="modal" id="createaccount" data-target="#loginModal" title="Create Account">Create Account</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-sm-8 col-12">
                <div class="footers-links d-none d-sm-block ">
                    <div class="footer-head aos-init" data-aos="fade-up" data-aos-delay="600">Get encouraged by our offers...</div>
                    <div class="search-footer aos-init" data-aos="fade-up" data-aos-delay="650">
                       <?php 
                        /*<form name="frmnewsletter" id="frmnewsletter" action="https://hostitsmart.us16.list-manage.com/subscribe/" mehod="post">
                            <input type="hidden" name="u" value="7990e101c2a34639adf512868">
                            <input type="hidden" name="id" value="23e6f604f5">
                            <input type="hidden" name="ht" value="68bcaaaa708dba16c35ab76e26b2fcead2b5e11a:MTUyNzA3NjgwMi4yNjk0">
                            <input type="hidden" name="mc_signupsource" value="hosted">
                            <input type="text" placeholder="Enter your email address" value="" autocapitalize="off" autocorrect="off" name="MERGE0" id="MERGE0" size="25">
                            <button type="submit" title="Submit">Submit</button>
                        </form>*/
                        ?>

                        <form action="https://hostitsmart.us19.list-manage.com/subscribe/post?u=f6d3566771049dcebe2b276d7&amp;id=0e3eda5761" method="post" name="frmnewsletter" id="frmnewsletter" target="_blank">
                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_f6d3566771049dcebe2b276d7_0e3eda5761" tabindex="-1" value=""></div>
                        <button value="Subscribe" name="subscribe" id="mc-embedded-subscribe">Submit</button>
                        </form>
                    </div>
                    <div class="footer-logo aos-init" data-aos="fade-up" data-aos-delay="700">&nbsp;</div>
                    <div class="footer-payment aos-init" data-aos="fade-up" data-aos-delay="750">
                        <img src="{{Config::get('Constant.CDNURL')}}/assets/images/slider-icon/footer-payment.png" alt="Payment" title="Payment"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-copyright">
    <div class="container">
        <div class="row">
            <div class="footer-left col col-md-4 col-12 align-self-center">
                @php 
                $Sitemap = ''; 
                $PrivacyPolicy = ''; 
                @endphp
                @if(Request::segment(1) == "privacy-policy")
                @php
                $PrivacyPolicy = "active";
                @endphp
                @elseif(Request::segment(1) == "sitemap")
                @php
                $Sitemap = "active";
                @endphp
                @endif
                <ul class="footer-privacy">
                    <li>
                        <a href="{{url("privacy-policy")}}" title="Privacy Policy" class="{{$PrivacyPolicy}}">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{url("sitemap")}}" title="Sitemap" class="{{$Sitemap}}">Sitemap</a>
                    </li>
                </ul>
            </div>
            <div class="footer-left col col-md-5 col-12 align-self-center footer-text-center">
                Copyright {{ date('Y') }} © Hosting World PVT. LTD. All rights reserved
            </div>
            <div class="footer-social col col-md-3 col-12">
                <ul class="justify-content-md-end d-flex justify-content-center">
                    @if(null!==(Config::get('Constant.SOCIAL_FB_LINK')) && strlen(Config::get('Constant.SOCIAL_FB_LINK')) > 0)
                    <li>
                        <a href="{{ Config::get('Constant.SOCIAL_FB_LINK') }}" target="_blank" title="Facebook" rel="nofollow" class="d-flex justify-content-center fb"><i class="fa fa-facebook"></i>
                            <span class="bg-color"></span>
                        </a>
                    </li>
                    @endif
                    @if(null!==(Config::get('Constant.Google_Plus_Link')) && strlen(Config::get('Constant.Google_Plus_Link')) > 0)
                    <li>
                        <a href="{{ Config::get('Constant.Google_Plus_Link') }}" target="_blank" title="Google Plus" rel="nofollow" class="d-flex justify-content-center google"><i class="fa fa-google-plus"></i>
                            <span class="bg-color"></span>
                        </a>
                    </li>
                    @endif
                    @if(null!==(Config::get('Constant.SOCIAL_TWITTER_LINK')) && strlen(Config::get('Constant.SOCIAL_TWITTER_LINK')) > 0)
                    <li>
                        <a href="{{ Config::get('Constant.SOCIAL_TWITTER_LINK') }}" target="_blank" title="Twitter" rel="nofollow" class="d-flex justify-content-center twitter"><i class="fa fa-twitter"></i>
                            <span class="bg-color"></span>
                        </a>
                    </li>
                    @endif
                    @if(null!==(Config::get('Constant.SOCIAL_PINTEREST_LINK')) && strlen(Config::get('Constant.SOCIAL_PINTEREST_LINK')) > 0)
                    <li>
                        <a href="{{ Config::get('Constant.SOCIAL_PINTEREST_LINK') }}" target="_blank" title="Pinterest" rel="nofollow" class="d-flex justify-content-center pinterest"><i class="fa fa-pinterest-p"></i>
                            <span class="bg-color"></span>
                        </a>
                    </li>
                    @endif
                    @if(null!==(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) && strlen(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) > 0)
                    <li>
                        <a href="{{ Config::get('Constant.SOCIAL_LINKEDIN_LINK') }}" target="_blank" title="LinkedIn" rel="nofollow" class="d-flex justify-content-center linkedin"><i class="fa fa-linkedin"></i>
                            <span class="bg-color"></span>
                        </a>
                    </li>
                    @endif
                    @if(null!==(Config::get('Constant.SOCIAL_INSTAGRAM_LINK')) && strlen(Config::get('Constant.SOCIAL_INSTAGRAM_LINK')) > 0)
                    <li>
                        <a href="{{ Config::get('Constant.SOCIAL_INSTAGRAM_LINK') }}" target="_blank" title="Instagram" rel="nofollow" class="d-flex justify-content-center linkedin"><i class="fa fa-instagram"></i>
                            <span class="bg-color"></span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
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
{{-- 
<div class="popup cockies_popup gdpr_code p16 bg-black-700 fc-white ps-fixed b0 l0 r0 z-banner"  id="js-gdpr-consent-banner" role="banner" aria-hidden="false" style="display:none;">
    <div class="section wmx10 mx-auto grid grid__center jc-spacebetween gs8 gsx" role="alertdialog" aria-describedby="notice-message">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>This site uses cookies to serve our products/services. By using our site, you acknowledge that you have read and understand our Cookie Policy, <a target="_blank" href="{{url('/privacy-policy')}}">Privacy Policy</a>. Your use of {{ Config::get('Constant.SITE_NAME') }} Products/Services is subject to these policies.</p>
                    <a class="close_cookies_popup" href="javascript:void(0)" id="close-cookies" onclick="GetGDPRCLOSE()" >X</a>
                    <a href="javascript:void(0)" id="accept-button" class="btn" onclick="GetGDPRCLOSE()">Accept</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<?php
//<a href="#home" class="scrollToTop"><div class="btn-img"></div></a>
?>
@if(null!==(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) && strlen(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) > 0)
<a href="{{Config::get('Constant.SOCIAL_WHATSAPP_LINK')}}" class="wa-float pulse" target="_blank" title="Whatsapp Support">
@endif    
<i class="fa fa-whatsapp wa-float-icon"></i>
</a>
</div>

@if(Request::segment(1)!='cart')

@endif
<div class="modal fade loginPopup" id="loginModal"  tabindex='-1'>
    <div class="modal-dialog modal-dialog-centered modal-lg login-modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="la la-close"></i></button>
            <div class="modal-body">
                <div class="modal-start row">
                    <div class="d-none d-md-block col-sm-12 col-md-6 left">
                        <div class="left-part">
                            <p class="entry-text" id="one">Welcome to {{ Config::get('Constant.SITE_NAME') }}...!!! Login to access and manage all your products.</p>
                            <p class="entry-text" id="two" style="display: none">Welcome to {{ Config::get('Constant.SITE_NAME') }}...!!! Let's create your account and start hosting.</p>
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <ul class="service-content">
                                        <li>    
                                            <div class="icon hosting-ic"></div>
                                            <div class="text">
                                                <p class="s_c_title">Secure Payments</p>
                                                <p>For ensuring safety of your personal information and peace of mind.</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon domain-ic"></div>
                                            <div class="text">
                                                <p class="s_c_title">Tighten data security</p>
                                                <p>To keep you safe from viruses, unauthorized access, SQL injection and other harmful things.</p>
                                            </div>
                                        </li>
                                      <?php  
                                      /*<li>
                                            <div class="icon server-ic"></div>
                                            <div class="text">
                                                <p class="s_c_title">Free backups</p>
                                                <p>For ensuring that you do not lose anything accidently on our shared hosting.</p>
                                            </div>
                                        </li>*/
                                        ?>
                                    </ul>
                                </div>
                                <div class="item">
                                    <ul class="service-content">
                                        <li>    
                                            <div class="icon hosting-ic"></div>
                                            <div class="text">
                                                <p class="s_c_title">Scalability</p>
                                                <p>For allocating exact amount of resources, your application needs to ensure service availability.</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon domain-ic"></div>
                                            <div class="text">
                                                <p class="s_c_title">Round the clock support</p>
                                                <p>A team of qualified and enthusiastic professionals you can rely on.</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon server-ic"></div>
                                            <div class="text">
                                                <p class="s_c_title">Robust infrastructure</p>
                                                <p>Specially designed for service delivery and providing optimum security.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="item">
                                    <ul class="service-content">
                                        <li>    
                                            <div class="icon hosting-ic"></div>
                                            <div class="text">
                                                <p class="s_c_title">cPanel</p>
                                                <p>An industry standard to make website management a piece of cake. </p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon domain-ic"></div>
                                            <div class="text">
                                                <p class="s_c_title">Free emails</p>
                                                <p>So that limitation on number of email accounts, cannot be a hurdle in your business's success</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- left part end-->
                    <div class="col-sm-12 col-md-6 col-12 right">
                        <div class="right-part">
                            <div class="panel panel-login">
                                <div class="panel-heading">
                                    <div class="row login-form-btns justify-content-center">
                                        <div class="col-xs-6">
                                            <a href="#" class="signin-btn">Login</a>
                                        </div>
                                        <!--<div class="col-xs-6">
                                            <a href="#" class="signup-btn" id="signup-form-link">Login</a>
                                        </div>-->
                                        </div>
                                    </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form id="signin-form" action="{{ url('/front-login') }}" method="post" role="form" style="display: block;">
                                                {!! csrf_field() !!}
                                                <div class="form-group {{ $errors->has('loginusername') ? ' has-error' : '' }}">
                                                    <label for="loginusername">Email</label>
                                                    @if(Cookie::get('front_cookie_login_email'))
                                                    <input type="text" name="loginusername" id="loginusername" value="{{Cookie::get('front_cookie_login_email')}}" tabindex="1" class="form-control" placeholder="Enter your Email" value="" required="required"  autocomplete=off>
                                                    @else
                                                    <input type="text" name="loginusername" id="loginusername" value="" tabindex="1" class="form-control" placeholder="Enter your Email" value="" required="required"  autocomplete=off>
                                                    @endif
                                                    @if ($errors->has('loginemail'))
                                                    <span class="help-block">
                                                        {{ $errors->first('loginemail') }}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('loginpassword') ? ' has-error' : '' }}">
                                                    <label for="loginpassword">PASSWORD</label>
                                                    @if(Cookie::get('front_cookie_login_password'))
                                                    <input type="password" name="loginpassword" id="loginpassword" value="{{Cookie::get('front_cookie_login_password')}}" tabindex="2" class="form-control" placeholder="....." required="required"  autocomplete=off>
                                                    <span toggle="#loginpassword" class="fa fa-fw field-icon toggle-password fa-eye" id="sign_in_pass"></span>
                                                    @else
                                                    <input type="password" name="loginpassword" id="loginpassword" value="" tabindex="2" class="form-control" placeholder="....." required="required"  autocomplete=off>
                                                    <span toggle="#loginpassword" class="fa fa-fw field-icon toggle-password fa-eye" id="sign_in_pass"></span>
                                                    @endif
                                                </div>
                                                <div class="form-group check-remember">
                                                    @if(Cookie::get('front_remember'))
                                                    <input type="checkbox" class="filled-in" tabindex="3" name="remember" id="remember" checked="check">
                                                    @else
                                                    <input type="checkbox" class="filled-in" tabindex="3" name="remember" id="remember" >
                                                    @endif
                                                    <label for="remember"> Remember Me</label> 
                                                </div>
                                                    
                                                <?php /*<div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <div id="html_element1" class="g-recaptcha form-text" data-sitekey="{{ Config::get('Constant.GOOGLE_CAPCHA_KEY') }}" data-callback="check_captchaSignin"></div>
                                                    <div class="capphitcha">
                                                        @if ($errors->has('g-recaptcha-response'))
                                                        <span class="help-block">
                                                            {{ $errors->first('g-recaptcha-response') }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>*/?>
                                                
                                                <div class="form-group login-btn-part">
                                                    <div class="row">
                                                        <div class="col-5 col-sm-6">
                                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Login">
                                                        </div>  
                                                        <div class="col-7 col-sm-6">
                                                            <a href="javascript:;" tabindex="5" class="forgot-password">Forgot Password ?</a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group signup-btn-part">
                                                    <div class="row">
                                                    <div class="col-12 col-sm-10">
                                                            <span style="color:#F9F9F9">New to Host IT Smart?  </span><a href="#" tabindex="5" style="text-decoration: underline; text-decoration-color: #28a745; color:#F9F9F9" class="signup-btn" id="signup-form-link">SignUp</a>
                                                        </div>  
                                                        </div>
                                                    </div>
                                            </form>
                                          
                                            <form id="otp-verification-form" action="{{ url('/') }}" method="post" role="form" style="display: none;">
                                              <?php 
                                               /* @if(Request::segment(1)=="cart")
                                                {!! csrf_field() !!}

                                                @php $diaplayCountry=''; @endphp
                                                @foreach($countryCode as $key=>$val)
                                                @if($key==Config::get('Constant.sys_country'))
                                                 @if($key==Config::get('Constant.sys_country'))
                                                    @php $diaplayCountry=$val; @endphp
                                                 @endif
                                                @endif
                                                @endforeach
                                                <div class="form-group country_select {{ $errors->has('otpcountry') ? ' has-error' : '' }}">
                                                    <label for="loginusername">Country</label>
                                                    <select class="selectpicker form-control" data-live-search="true" id="otpcountry" name="otpcountry">
                                                            <option value="">Select</option>
                                                         @php $country_count=0; @endphp
                                                         @if(isset($countryDialingCode))
                                                         @foreach($countryDialingCode as $key => $itm)
                                                            <option data-icon="flagstrap-icon {{$itm['cflag']}}" value="{{$itm['ccode']}}_{{$country_count}}" @if($diaplayCountry==$itm['cname']) selected @else @endif> (+{{$itm['ccode']}}) - {{$itm['cname']}}</option>
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

                                                <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                    <label for="loginusername">Phone no</label>
                                                    <input type="text" name="phone_number" id="phone_number" value="" tabindex="1" class="form-control" placeholder="Enter your phoneno." value="" required="required" autocomplete=off>
                                                    @if ($errors->has('phone_number'))
                                                    <span class="help-block">
                                                        {{ $errors->first('phone_number') }}
                                                    </span>
                                                    @endif
                                                <p class="forgot-desc">Please enter your phone no, We will send OTP to your phone no.</p>
                                                </div>*/
                                                ?>
                                                <?php 
                                                /*<div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <div id="html_element2" class="g-recaptcha form-text" data-sitekey="{{ Config::get('Constant.GOOGLE_CAPCHA_KEY') }}" data-callback="check_captchaOTPSend"></div>
                                                    <div class="capphitcha">
                                                        @if ($errors->has('g-recaptcha-response'))
                                                        <span class="help-block">
                                                            {{ $errors->first('g-recaptcha-response') }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group login-btn-part">
                                                    <div class="row">
                                                        <div class="col-6 col-sm-6">
                                                            <a href="javascript:;" tabindex="6" id="sendotpbtn" class="form-control btn btn-login">Send OTP</a>
                                                        </div>
                                                        <div class="col-6 col-sm-6"><a href="javascript:;" tabindex="6" class="signinusr forgot-password">Sign In</a></div>
                                                    </div>
                                                </div>*/
                                                ?>
                                                <div class="form-group login-btn-part" id="sendotpalert" style="display:none;">
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div class="alert alert-danger">
                                                          <strong>Opps!</strong> OTP not send, Please try again later.
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                           <?php
                                            /*@else
                                            <p class="forgot-desc">Please Countinue with order process for further registration.</p>
                                            @endif*/
                                            ?>
                                            </form>
                                           
                                            <form id="otp-verification-form2" action="{{ url('/') }}" method="post" role="form" style="display: none;">
                                                {!! csrf_field() !!}
                                                <p class="forgot-desc">Please enter OTP you have recieved on your phoneno.</p>
                                                <div class="form-group {{ $errors->has('txtphoneno') ? ' has-error' : '' }}">
                                                    <label for="loginusername">OTP</label>
                                                    <input type="text" name="txt_otp" id="txt_otp" value="" tabindex="1" class="form-control" placeholder="Enter your OTP." value="" required="required" autocomplete=off>
                                                    @if ($errors->has('txt_otp'))
                                                    <span class="help-block">
                                                        {{ $errors->first('txt_otp') }}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group login-btn-part">
                                                    <div class="row">
                                                        <div class="col-6 col-sm-6">
                                                            <a href="javascript:;" tabindex="6" id="verifyotpbtn" class="form-control btn btn-login">Verify OTP</a>
                                                        </div>
                                                        <div class="col-6 col-sm-6"><a href="javascript:;" tabindex="6" id="resendotplink" class="resendotplink forgot-password">Resend OTP</a></div>  
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
                                           
                                            <form id="signup-form" action="{{ url('/front-register') }}" method="post" role="form" style="display: none;" >
                                                {!! csrf_field() !!}
                                                
                                                <div class="form-group {{ $errors->has('fullname') ? ' has-error' : '' }}">
                                                    <label for="fullname">FULL NAME</label>
                                                    <input type="text" name="fullname" id="fullname" tabindex="1" class="form-control" placeholder="Enter your full name" value="" required="required"  autocomplete=off>
                                                    @if ($errors->has('fullname'))
                                                    <span class="help-block">
                                                        {{ $errors->first('fullname') }}
                                                    </span>
                                                    @endif
                                                </div>
                                               
                                                 @php $diaplayCountry=''; @endphp
                                                @foreach($countryCode as $key=>$val)
                                                @if($key==Config::get('Constant.sys_country'))
                                                 @if($key==Config::get('Constant.sys_country'))
                                                    @php $diaplayCountry=$val; @endphp
                                                 @endif
                                                @endif
                                                @endforeach


                                                <div class="form-group">
                                                                <div class="row country_select {{ $errors->has('otpcountry') ? ' has-error' : '' }}">
                                                                    <div class="col-4">
                                                                        <label for="loginusername">Country</label>
                                                                        <select class="selectpicker form-control" data-live-search="true" id="otpcountry" name="otpcountry">
                                                                        <option value="">Select</option>
                                                                        @php $country_count=0; @endphp
                                                                        @if(isset($countryDialingCode))
                                                                        @foreach($countryDialingCode as $key => $itm)
                                                                        <option data-icon="flagstrap-icon {{$itm['cflag']}}" value="{{$itm['ccode']}}_{{$country_count}}" @if($diaplayCountry==$itm['cname']) selected @else @endif> (+{{$itm['ccode']}}) - {{$itm['cname']}}</option>
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
                                                                    <div class="col-8 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                                        <label for="loginusername">Phone no</label>
                                                                        <input type="tel" name="phone_number" id="phone_number" value="" tabindex="1" class="form-control" placeholder="Enter your phoneno." value="" required="required" autocomplete=off>
                                                                        @if ($errors->has('phone_number'))
                                                                        <span class="help-block">
                                                                        {{ $errors->first('phone_number') }}
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <p class="forgot-desc phone_no_desc">Please enter your phone no, We will send OTP to your phone no.</p>
                                                                    </div>
                                                                </div>
                                                </div>


                                                <?php

                                                /*<div class="form-group country_select {{ $errors->has('otpcountry') ? ' has-error' : '' }}">
                                                    <label for="loginusername">Country</label>
                                                    <select class="selectpicker form-control" data-live-search="true" id="otpcountry" name="otpcountry">
                                                            <option value="">Select</option>
                                                        @php $country_count=0; @endphp
                                                        @if(isset($countryDialingCode))
                                                         @foreach($countryDialingCode as $key => $itm)
                                                            <option data-icon="flagstrap-icon {{$itm['cflag']}}" value="{{$itm['ccode']}}_{{$country_count}}" @if($diaplayCountry==$itm['cname']) selected @else @endif> (+{{$itm['ccode']}}) - {{$itm['cname']}}</option>
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

                                                <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                    <label for="loginusername">Phone no</label>
                                                    <input type="text" name="phone_number" id="phone_number" value="" tabindex="1" class="form-control" placeholder="Enter your phoneno." value="" required="required" autocomplete=off>
                                                    @if ($errors->has('phone_number'))
                                                    <span class="help-block">
                                                        {{ $errors->first('phone_number') }}
                                                    </span>
                                                    @endif
                                                <p class="forgot-desc">Please enter your phone no, We will send OTP to your phone no.</p>
                                                </div>*/
                                                ?>
                                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="email">EMAIL</label>
                                                    <input type="text" name="email" id="email" tabindex="2" class="form-control" placeholder="Enter your Email ID" value="" required="required"  autocomplete=off>
                                                    @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="password {{ $errors->has('password') ? ' has-error' : '' }}">PASSWORD</label>
                                                    <input type="password" name="password" id="password1" tabindex="3" class="form-control" placeholder="....." required="required"  autocomplete=off>
                                                    <span toggle="#password1" id="sign_up_pass" class="fa fa-fw field-icon toggle-password fa-eye"></span>
                                                    @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        {{ $errors->first('password') }}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group check-updates">
                                                    <input type="checkbox" class="filled-in" tabindex="4" name="tc" id="tc" checked="check" required="required">
                                                    <label for="tc" id="agree_terms">I want to receive personalized offers, updates & information about {{ Config::get('Constant.SITE_NAME') }} products & services.</label> 
                                                </div>
                                            <?php
                                            /*<div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <div id="html_element2" class="g-recaptcha form-text" data-sitekey="{{ Config::get('Constant.GOOGLE_CAPCHA_KEY') }}" data-callback="check_captchaSignup"></div>
                                                    <div class="capphitcha">
                                                        @if ($errors->has('g-recaptcha-response'))
                                                        <span class="help-block">
                                                            {{ $errors->first('g-recaptcha-response') }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>*/
                                             ?>
                                                <div class="form-group signup-btn-part">
                                                    <div class="row">
                                                        <div class="col-5 col-sm-6">
                                                            <input name="register-submit" type="button" id="register-submit" tabindex="5" class="form-control btn btn-register" value="Proceed">
                                                        </div>  
                                                        <div class="col-7 col-sm-6">
                                                            <a href="javascript:;" tabindex="6"  class="already-member">I'm already member</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <form id="reset-form" action="{{ url('/front/password/reset') }}" method="post" role="form" style="display: none;">
                                                {!! csrf_field() !!}

                                                <p class="forgot-title">Forgot Password</p>
                                                <p class="forgot-desc">Please enter your email address and we'll send you instructions on how to reset your password.</p>

                                                <div class="form-group {{ $errors->has('resetemail') ? ' has-error' : '' }}">
                                                    <label for="loginusername">Email</label>
                                                    <input type="text" name="resetemail" id="resetemail" value="" tabindex="1" class="form-control" placeholder="Enter your Email" value="" required="required" autocomplete=off>
                                                    @if ($errors->has('resetemail'))
                                                    <span class="help-block">
                                                        {{ $errors->first('resetemail') }}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group login-btn-part">
                                                    <div class="row">
                                                        <div class="col-5 col-sm-6">
                                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Submit">
                                                        </div>  
                                                        <div class="col-7 col-sm-6"><a href="javascript:;" tabindex="6" class="signinusr forgot-password">Sign In</a></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- panel body end -->
                            </div> <!-- panel end -->
                            <?php /*<div class="sign-with">
                                <p>Sign In With</p>
                                <div class="social-icons">
                                    <ul>
                                        <li><a href="{{ url('/userauth/facebook') }}" title="Facebook" class=" justify-content-center facebook"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
                                        <li><a href="{{ url('/userauth/twitter') }}" title="Twitter" class="justify-content-center twitter"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
                                        <li><a href="{{ url('/userauth/google') }}" title="Google" class=" justify-content-center google"><i class="fa fa-google-plus" aria-hidden="true"></i>Google</a></li>
                                    </ul>
                                </div>
                            </div>*/?>
                        </div> <!-- right end -->
                    </div><!-- right part end-->                        
                </div> <!-- modal start end -->
            </div> <!-- modal body end -->
        </div> <!-- modal content end -->
    </div> <!-- modal dialog end -->
</div> <!-- popup main end -->
<!-- lucky draw offer popup -->
@if(Request::segment(1) == '')
<div class="modal fade deal-popup" id="lucky-draw-popup" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close close-popup" data-dismiss="modal"></button>
              <p class="modal-title">Spinning please wait...</p>
            </div>
            <div class="modal-body">
                <div class="spinner-body" id="spinner-div">
                    <img src="{{Config::get('Constant.CDNURL')}}/assets/images/spinner.png" alt="Wait to check your luck offer" class="spinner"/>
                </div>
                <div class="deal-body" id="lucky-draw-content">
                    <div class="deal-promo">Copy and paste this promocode at Checkout.</div>
                    <div class="promo">
                        <form action="#" class="custom-input form-group">
                              <div class="input-group">
                                <input type="text" value="" id="dedicatedoffercode" class="form-control" >
                                <p class="link-copy btn dedicatedoffercode" title="Copy" onclick="copyPromocCode('dedicatedoffercode');">Copy</p>
                              </div>
                              <a href='{{ Config::get("Constant.SITE_URL") }}/manage/cart.php?a=add&pid=182' title="Grab This Deals Now!" class="btn">Grab This Deals Now!</a>

                        </form>
                    </div>
                    <div class="deal-discount">
                        Surprise Dedicated Server Offer
                    </div>
                    <div class="deal-text">
                        Please proceed with the order by using the promo code you got. Once the order is placed you will get an email within 30 minutes about the surprise configuration you want.
                    </div>
                    <div class="offer-end">
                        * Server configuration is subject to availability, Limited Period Offer
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div id="browsernote" style="display:none;position:fixed;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:9999;top:0;left:0;font-size:18px;">
    <div style="font-size:18px;color:#fff;background:#18b35c;padding:15px;text-align:center;height:60px;z-index:9999;position:fixed;width:100%;top:0;margin:auto;">For a better experience on <strong style="color:#000;">{{ Config::get('Constant.SITE_NAME') }},</strong><a href="https://support.apple.com/downloads" style="cursor:pointer;color: #ffffff;font-size:14px;margin-left:10px;display:inline-block;" target="_blank">update your browser.</a>
    </div>
</div>                    
<!-- Main Wrapper E -->
<?php /*
    <script src="{{Config::get('Constant.CDNURL')}}/assets/js/main_v8.js" type="text/javascript"></script>
    <script src="{{ Config::get('Constant.CDNURL').'/assets/'.$themeversion.'/aos_theme_v0.js' }}"></script>
*/?>
<script src="{{ Config::get('Constant.CDNURL').'/assets/'.$themeversion.'/main_theme_v0.js' }}"></script>


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
$("#combo_offer_closed").click(function(){
        $(".dmnofer").remove(); 
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
<script type="text/javascript">
<?php if (session()->has('failed_login')) { ?>
        alert("<?= session()->get('failed_login') ?>");

<?php } elseif (session()->has('email_not_found')) { ?>
        alert("<?= session()->get('email_not_found') ?>");
<?php } ?>
</script>

<script src="{{Config::get('Constant.CDNURL')}}/assets/js/common_v9.js" type="text/javascript"></script>
<script type="text/javascript">
  var baseUrl = "{{ url('/') }}";
$("#signup-form-link").click(function(){
    
        $(".signin-btn").text("Create Account");
  
        $("#signup-form").show();
});

  function hidetopdeals(){ $(".top-header").hide()}function getcurrency(i){"INR"==i?confirm("Are you sure? You wants to move to india location website.")?window.location=baseUrl:($("#currency").val("USD"),$("#currency").selectpicker("refresh")):confirm("Are you sure? You wants to move to Global location website.")?window.location="https://global.hostitsmart.com":($("#currency").val("INR"),$("#currency").selectpicker("refresh")),$("#currency").selectpicker("refresh")}$(".forgot-password").click(function(){$("#reset-form").show(),$("#signin-form").hide(),$(".sign-with").hide()}),$(".already-member,.signinusr").click(function(){$(".signin-btn").text("Login"),$("#reset-form").hide(),$("#signup-form").hide(),$("#otp-verification-form").hide(),$("#signin-form").show(),$(".signup-btn").removeClass("active"),$(".signin-btn").addClass("active"),$(".sign-with").show()}),$("#signin-form-link").click(function(){$("#signin-form-link").text("Login"),$("#otp-verification-form2,#reset-form, #signup-form,.sign-with").hide(),$("#signin-form").show(); return false;}),$("#signup-form-link").click(function(){ $("#reset-form, #signin-form, .sign-with").hide(),$(".signin-btn").removeClass('active'),$(".signup-btn").addClass('active'); return false;}),$("#signup-form-link").click(function(){$("#fullname").focus(); $("#one").hide(),$("#two").show()}),$("#signin-form-link").click(function(){$("#one").show(),$("#two").hide()});

  $( document ).ready(function() {

   /*if($("#otpcountry").val()!="")
    {
     var arr= $("#otpcountry").val().split('_');
     $("#phone_number").val("+"+arr['0']);    
    }
    else
    {
        $("#phone_number").val("");
    }*/
});

 $( document ).on( "change", "#otpcountry", function() {
    /* if($("#otpcountry").val()!="")
    {
     var arr= $("#otpcountry").val().split('_');
     $("#phone_number").val("+"+arr['0']);
    }
    else
    {
        $("#phone_number").val("");
    }*/
    
  });
  
  $("#otp-verification-form").submit(function(e) {
      var arr= $("#otpcountry").val().split('_');
      var cuntrycd="+"+arr['0'];
      var pno=$("#phone_number").val().split(cuntrycd);
     $("#phone_number").val(pno['1']);
  });
  
  $("#sendotpbtn").click(function(){
      $("#signup-form").submit();
  });
   $("#verifyotpbtn").click(function(){
        $("#otp-verification-form2").submit();
  });
   
   var form = $("#signup-form"); 

    $("#register-submit").click(function() {
     
     if(form.valid())
     {   
          $("#sendotpbtn").text("Sending...");
            var formData = $("#signup-form").serialize();
            $.ajax({
                url: "{{url('/otp-send')}}",
                data: formData,
                type: "post",
                success: function(response) {
                if(eval(response) == 1){
                            $("#signin-form, #signup-form, #otp-verification-form, #otp-verification-form2, #reset-form").hide();
                            $("#otp-verification-form2").show();
                        }
                        else {
                            $("#sendotpbtn").text("Send OTP");
                            $("#sendotpalert").show();
                        }
                }
            });
     }
    });
  
  
    /*$("#signup-form").validate({
        ignore:".ignore",errorElement:"span",errorClass:"error",
        rules:{ 
            otpcountry:{required:!0},
            phone_number:{required:!0,noSpace:!0,xssProtection:!0,maxlength:15,minlength:10},
            email:{required:!0,emailFormat:!0,remote:{url:"https://new.hostitsmart.com/user-email-exit",type:"get"},maxlength:50},
            password:{required:!0,noSpace:!0,minlength:6,regex1:/^(?=.*?[A-Z])(?=.*?[a-z])/,regex2:/^(?=.*?[0-9])/,regex3:/^(?=.*?[#?!@$%^&*-])/,xssProtection:!0,no_url:!0},
            tc:{required:!0}},
        messages:{
                otpcountry:{required:"Please select country"},
                phone_number:{required:"Please enter Phone no.",xssProtection:"Please enter valid Input."},
                email:{required:"Please enter your email.",remote:"Email already in use!"},
                password:{required:"Please enter your password.",xssProtection:"Please enter valid Input."},
                tc:{required:"Please click on checkbox to agree terms & condition."}},
              
        errorPlacement: function(error, element) {
         if (element.attr("id") == "otpcountry") {
            error.insertAfter($("#country_error_msg"));
         }
         else
         {
            error.insertAfter(element);
         }
        },
        submitHandler:function(){
           
            $("#sendotpbtn").text("Sending...");
            var formData = $("#signup-form").serialize();
            $.ajax({
                url: "{{url('/otp-send')}}",
                data: formData,
                type: "post",
                success: function(response) {
                    $("#sendotpbtn").text("Send OTP");
                    if (response) {
                        if(eval(response) == 1){

                            $("#signin-form, #signup-form, #otp-verification-form, #otp-verification-form2, #reset-form").hide();
                            $("#otp-verification-form2").show();
                        }
                        else {
                            $("#sendotpbtn").text("Send OTP");
                            $("#sendotpalert").show();
                        }
                    }
                }
            });
        }
    });*/
  
  <?php
   /* $("#otp-verification-form").validate({
        rules:{ "otpcountry": { "required":true }, "phone_number": { "required":true,"minlength":10,"maxlength":15 }},
        messages:{ "otpcountry": { "required":"Please select country." }, "phone_number": { "required":"Please enter Phone no."}},
        errorPlacement: function(error, element) {
         if (element.attr("id") == "otpcountry") {
            error.insertAfter($("#country_error_msg"));
         }
         else
         {
            error.insertAfter(element);
         }
        },
        submitHandler:function(){
           
            $("#sendotpbtn").text("Sending...");
            var formData = $("#otp-verification-form").serialize();
            $.ajax({
                url: "{{url('/otp-send')}}",
                data: formData,
                type: "post",
                success: function(response) {
                    $("#sendotpbtn").text("Send OTP");
                    if (response) {
                        if(eval(response) == 1){

                            $("#signin-form, #signup-form, #otp-verification-form, #otp-verification-form2, #reset-form").hide();
                            $("#otp-verification-form2").show();
                        }
                        else {
                            $("#sendotpbtn").text("Send OTP");
                            $("#sendotpalert").show();
                        }
                    }
                }
            });
        }
    });*/
    
    ?>
    
   
    $("#otp-verification-form2").validate({
        rules:{ "txt_otp": { "required":true }},
        messages:{ "txt_otp": { "required":"Please enter OTP." }},
        submitHandler:function(){
            $("#verifyotpbtn").text("Verifying...");
             var formData = $("#otp-verification-form2").serialize();
            $.ajax({
                url: "{{url('/otp-doverification')}}",
                data: formData,
                type: "post",
                success: function(response) {
                     $("#verifyotpbtn").text("Verify OTP");
                    if (response) {
                       if(eval(response) == 1){
                             $(".close").click();
                            $("#signup-form").submit();

                        }
                        else {
                            $("#verifyotpbtn").text("Verify OTP");
                            $("#verifyotpalert").show();
                        }
                        }
                        
                    }
            });
        }
    });
   
    $("#resendotplink").click(function(){
        $("#signin-form, #otp-verification-form, #otp-verification-form2, #reset-form").hide();
        $("#signup-form").show();
    });
  
</script>
<?php 

/*<script src="{{url('/')}}/assets/js/common_v4.js" type="text/javascript"></script> */

?>
<?php if(strpos(url()->current(),"servers/vps-hosting") !== false){ ?>
<script src="{{Config::get('Constant.CDNURL')}}/assets/js/vps-range-jquery-ui.js"></script>
<?php } ?>
<?php if(strpos(url()->current(),"email/google-apps") !== false){ ?>
<script src="{{Config::get('Constant.CDNURL')}}/assets/js/google-apps.js"></script>
<?php } ?>
<script type="text/javascript">
    $("#frmnewsletter").validate({rules:{"MERGE0":{"required":true,"email":true}},messages:{"MERGE0":{"required":"Please enter your email address.","email":"Please enter valid email address."}}});$(document).ready(function(){if($('#signin-form-link').hasClass('active')){$("#one").show();$("#two").hide()}else{$("#one").hide();$("#two").show()}if($.cookie("header_deals_close")!="Y"){$.cookie("header_deals_close","N")}if($.cookie("header_deals_close")=="N"){$(".top-header").show()}});function hidetopdeals(){$(".top-header").hide();$.cookie("header_deals_close","Y")}
    @if (\Request::is('domain'))
    superplaceholder({el:domainname,sentences:['Search for a Domain Name','Search for a Domain Name','Search for a Domain Name'],options:{letterDelay:180,loop:true,startOnFocus:false}});
    @endif
    $(function(){$('#bulkdomains').keyup(function(event){if(event.keyCode=='13'){$('#bulksearchfrm').submit()}})});

  var loadDeferredStyles=function(){var e=document.getElementById("deferred-styles"),n=document.createElement("div");n.innerHTML=e.textContent,document.body.appendChild(n),e.parentElement.removeChild(e)},raf=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame;raf?raf(function(){window.setTimeout(loadDeferredStyles,0)}):window.addEventListener("load",loadDeferredStyles);
</script>
<script type="text/javascript">
   $(document).ready(function(){$("*").not(".banner_section, .searchdomain_div, .logo, .navbar-header, .login_part, .cart_div, .currency_div").removeAttr("data-aos");$("*").not(".banner_section, .searchdomain_div, .navbar-header, .login_part, .cart_div, .currency_div").removeAttr("data-aos-delay");$("*").removeAttr("data-aos-easing");$("*").removeAttr("data-aos-duration");$("*").not(".banner_section, .searchdomain_div, .logo, .navbar-header, .login_part, .cart_div, .currency_div").removeClass("aos-init");$("*").not(".banner_section, .searchdomain_div, .logo, .navbar-header, .login_part, .cart_div, .currency_div").removeClass("aos-animate")});
</script>
<?php /*<!-- Drift script start ------------------------------------>
<script>
    setTimeout(function(){
"use strict";

!function() {
var t = window.driftt = window.drift = window.driftt || [];
if (!t.init) {
if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
t.factory = function(e) {
  return function() {
    var n = Array.prototype.slice.call(arguments);
    return n.unshift(e), t.push(n), t;
  };
}, t.methods.forEach(function(e) {
  t[e] = t.factory(e);
}), t.load = function(t) {
  var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
  o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
  var i = document.getElementsByTagName("script")[0];
  i.parentNode.insertBefore(o, i);
};
}
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('2pz87niuf6hr');
},5000);
</script>
<!-- Drift script end --------------------------------------> */?>

<!--Start of Zopim Live Chat Script-------------------------> 
<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(openZopim, 2000); // Wait 2 seconds
		});
function openZopim(){  
   window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
			_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
	$.src='//v2.zopim.com/?1lXmJusakiXODEAGNIP6Refz9a4trf7V';z.t=+new Date;$.
		type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script'); 
}
//openZopim();
</script> 
<!--End of Zopim Live Chat Script--------------------------->



<?php /*<script src="https://d1neo0gtmjcot5.cloudfront.net/assets/js/countdown.min.js"></script>*/?>
<script src="https://d1neo0gtmjcot5.cloudfront.net/assets/js/countdown.jquery.js"></script>

<script type="text/javascript">
    $(window).scroll(function() {  
        if($(window).scrollTop() < 200) { $("#top_bar").css({"position":"relative","top":"0","width":"100%","z-index":"9999"}); }
        else { $("#top_bar").css({"position":"fixed","top":"0","width":"100%","z-index":"9999"});     }
    });
    $("#countdown-add-options").countdown({year:2019,month:12,day:02,hour:12,minute:30});
</script>

<script type="text/javascript">
            <?php /*var onloadCallbackSingin = function() {
                grecaptcha.render('html_element1', {
                'sitekey' : '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}'
                });
            };*/?>
            <?php /*var onloadCallbackSingup = function() {
                grecaptcha.render('html_element2', {
                'sitekey' : '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}'
                });
            }; */?>
			<?php /*function check_captchaSignin() { $('#signin-form').valid(); }*/?>
			<?php /*function check_captchaSignup() { $('#signup-form').valid(); }
            function check_captchaOTPSend() { $('#otp-verification-form').valid(); }
            setTimeout(function() { $.getScript("https://www.google.com/recaptcha/api.js?onload=onloadCallbackSingup&render=explicit"); },5000); */?>

//Update latest Cart item counter            
$.getScript("{{url('cart/counter')}}",function(data){data&&(data=eval(data),data>0?$("#cart_cout").html(data).show():$("#cart_cout").hide())});
<?php if (session()->has('whmcsloginurl')) { $_url = session()->get('whmcsloginurl'); ?>
$.getScript("<?php echo trim($_url); ?>",function(data){});
<?php } ?>

</script>

<?php /*<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackSingin&render=explicit" async defer></script>*/?>
<?php /*<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackSingup&render=explicit" async defer></script>*/?> 
@include('template.seoschema')
{{--
</body>
</html>
--}}