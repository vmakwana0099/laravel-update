@extends('layouts.app')
@section('content') 

<section class="frgt-pass-section">
<div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-6 col-lg-7 login-left-col">
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
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                </div>
                                                <h2>Shivang Kareliya</h2>
                                            </div>
                                            <div class="login-box-carousel-item carousel-item">
                                                <p>Exceptional help center! Quick and effective solutions provided with a friendly and knowledgeable team. They made my experience smooth and hassle-free. Definitely my go-to for assistance.</p>
                                                <div class="login-box-rating-star">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                </div>
                                                <h2>s2 TECH INDIA</h2>
                                            </div>
                                            <div class="login-box-carousel-item carousel-item">
                                                <p>Considering hosting services, Host IT Smart stands out with its excellent quality, competitive pricing, and reliable support. When compared to Big Rock, Host IT Smart consistently delivers top-notch service at the best prices. Experience unmatched hosting with Host IT Smart for a seamless and cost-effective online presence.</p>
                                                <div class="login-box-rating-star">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                </div>
                                                <h2>Laxmi Ayyavari</h2>
                                            </div>
                                            <div class="login-box-carousel-item carousel-item">
                                                <p>One of the best service providers. Extremely satisfied with their customer service and cost effectiveness. Using their services for quite a long and have never faced any delays in taking action against issues. Thanks much!! </p>
                                                <div class="login-box-rating-star">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                </div>
                                                <h2>Urvashi Shrivastava</h2>
                                            </div>
                                            <div class="login-box-carousel-item carousel-item">
                                                <p>I have been using their services quite a lot for the last 6 months. I like the ease of use they provided while working with VPS. Also, In case of any issues, the resolution is quite fast.</p>
                                                <div class="login-box-rating-star">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                    <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
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

                            <div class="login-box-ratings-img">
                            <img src="../assets/images/new_img/login-image.webp" alt="login_img">
                            </div>
                        </div>
                        <div class="login-ratings-row">
                            <div class="login-rtng-box">
                                <div class="login-rtng-img-logo">
                                <img src="../assets/images/new_img/HostAdvice-rating-logo_new.webp" alt="HostAdvice-rating-logo_new">
                                </div>
                                <div class="login-rtng-img-star">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                </div>
                                <p>4.2 Ratings</p>
                            </div>
                            <div class="login-rtng-box">
                                <div class="login-rtng-img-logo">
                                <img src="../assets/images/new_img/Trustpilot-rating-logo_new.webp" alt="Trustpilot-rating-logo_new">
                                </div>
                                <div class="login-rtng-img-star">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                </div>
                                <p>4.3 Ratings</p>
                            </div>
                            <div class="login-rtng-box">
                                <div class="login-rtng-img-logo">
                                <img src="../assets/images/new_img/google-rating-logo_new.webp" alt="google-rating-logo_new">
                                </div>
                                <div class="login-rtng-img-star">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                </div>
                                <p>4.4 Ratings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10 col-lg-5 login-right-col">
                <div class="login-signup-wrap p-5 bg-white rounded shadow">
                    
                   
                        <form class="login-box-form" id="reset-form" action="/front/password/reset" method="post" role="form">
    {!! csrf_field() !!}
    <div class="login-box-header">
        <div class="login-box-logo mb-5">
            <img alt="logo" src="../assets/images/logo.webp">
        </div>
        <span class="mb-2">Oops, forgot your secret key? No worries, we’ve got you covered!</span>
        <h1 class="d-none">Oops, forgot your secret key?</h1>
        <p class="mb-5">Enter your email address below to begin the reset process & return to your digital kingdom!</p>
    </div>
    <div class="form-group mb-4 {{ $errors->has('resetemail') ? ' has-error' : '' }}">
        <label class="pb-4">Enter Your Email Address*</label>
        <div class="input-group input-group-merge">
            <div class="input-icon">
                <span class="inp-grp-icon"><i class="fa-solid fa-envelope"></i></span>
            </div>
            <input type="email" name="resetemail" id="resetemail" tabindex="1" class="form-control" placeholder="name@address.com" required autocomplete="off">
            @if ($errors->has('resetemail'))
            <span class="help-block">
                {{ $errors->first('resetemail') }}
            </span>
            @endif
        </div>
    </div>
    <div class="d-grid sign-up-box-btn">
        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-login my-3" value="Send Reset Link">
    </div>
    <div class="forgot-password-box">
        <a href="/login">Sign in</a>
    </div>
</form>

                </div>
            </div>
        </div>

    </div>
</section>
 <div class="modal fade loginPopup signup-box-24" id="loginModal" tabindex='-1'>

    <div class="modal-dialog modal-dialog-centered modal-lg login-modal-dialog">

        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="la la-close"></i></button>

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
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                            </div>
                                                            <h2>Shivang Kareliya</h2>
                                                        </div>
                                                        <div class="login-box-carousel-item carousel-item">
                                                            <p>Exceptional help center! Quick and effective solutions provided with a friendly and knowledgeable team. They made my experience smooth and hassle-free. Definitely my go-to for assistance.</p>
                                                            <div class="login-box-rating-star">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                            </div>
                                                            <h2>s2 TECH INDIA</h2>
                                                        </div>
                                                        <div class="login-box-carousel-item carousel-item">
                                                            <p>Considering hosting services, Host IT Smart stands out with its excellent quality, competitive pricing, and reliable support. When compared to Big Rock, Host IT Smart consistently delivers top-notch service at the best prices. Experience unmatched hosting with Host IT Smart for a seamless and cost-effective online presence.</p>
                                                            <div class="login-box-rating-star">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                            </div>
                                                            <h2>Laxmi Ayyavari</h2>
                                                        </div>
                                                        <div class="login-box-carousel-item carousel-item">
                                                            <p>One of the best service providers. Extremely satisfied with their customer service and cost effectiveness. Using their services for quite a long and have never faced any delays in taking action against issues. Thanks much!! </p>
                                                            <div class="login-box-rating-star">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                            </div>
                                                            <h2>Urvashi Shrivastava</h2>
                                                        </div>
                                                        <div class="login-box-carousel-item carousel-item">
                                                            <p>I have been using their services quite a lot for the last 6 months. I like the ease of use they provided while working with VPS. Also, In case of any issues, the resolution is quite fast.</p>
                                                            <div class="login-box-rating-star">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
                                                                <img src="../assets/images/new_img/star-rating-g.webp" alt="star-rating-g">
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
                                                <img src="../assets/images/new_img/HostAdvice-rating-logo_new.webp" alt="HostAdvice-rating-logo_new">
                                            </div>
                                            <div class="login-rtng-img-star">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                            </div>
                                            <p>4.2 Ratings</p>
                                        </div>
                                        <div class="login-rtng-box">
                                            <div class="login-rtng-img-logo">
                                                <img src="../assets/images/new_img/Trustpilot-rating-logo_new.webp" alt="Trustpilot-rating-logo_new">
                                            </div>
                                            <div class="login-rtng-img-star">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                            </div>
                                            <p>4.3 Ratings</p>
                                        </div>
                                        <div class="login-rtng-box">
                                            <div class="login-rtng-img-logo">
                                                <img src="../assets/images/new_img/google-rating-logo_new.webp" alt="google-rating-logo_new">
                                            </div>
                                            <div class="login-rtng-img-star">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
                                                <img src="../assets/images/new_img/star-rating.webp" alt="star-rating">
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
                                        <img alt="logo" src="../assets/images/logo.webp">
                                    </div>
                                </div>
                                 <form action="javascript:;" class="thank-you-box" style="display: none;" id="password-reset-link">
                                    <h2>Password Reset Link Sent</h2>

                                    <p><strong>We have sent a password reset link to your email. Please check your inbox to proceed with resetting your password. If you do not see the email, be sure to check your spam or junk folder.</strong></p>
                                    <div class="d-grid sign-up-box-btn">
                                        <input type="submit" name="" id="closedpopup" tabindex="4" class="btn btn-login my-3" value="Back to Login">
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- jQuery (necessary for AJAX and DOM manipulation) -->
<script language="javascript">
    //Hide Old Price from every Places.
         $('.line-through').addClass('d-none');
         $('.price-overline-text').addClass('d-none');
         $('.p_p_linethrough').addClass('d-none');
         $('.linethrough-price').addClass('d-none');
    function setCookie(c_name,value,exdays){var exdate=new Date();exdate.setDate(exdate.getDate()+exdays);var c_value=escape(value)+((exdays==null)?"":"; expires="+exdate.toUTCString());document.cookie=c_name+"="+c_value}function getCookie(c_name){var i,x,y,ARRcookies=document.cookie.split(";");for(i=0;i<ARRcookies.length;i++){x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);x=x.replace(/^\s+|\s+$/g,"");if(x==c_name){return unescape(y)}}}function checkCookie(){var popups=getCookie("hits");if(popups!='Y'){document.getElementById('js-gdpr-consent-banner').style.display=''}else{document.getElementById('js-gdpr-consent-banner').style.display='none';jQuery("#js-gdpr-consent-banner").html('');$('.gdpr_code').css('padding','0')}}function GetGDPRCLOSE(){setCookie("hits",'Y',365);document.getElementById('js-gdpr-consent-banner').style.display='none';jQuery("#js-gdpr-consent-banner").html('');$('.gdpr_code').css('padding','0');return false}function bclose(){parent.$("#popupContact2").bPopup().close();disablePopup();return false}
</script>
@include('template.cockies_popup')
<script>
$(document).ready(function() {
    var popupshow = localStorage.getItem('popupshow') || 0;

    // Validate and submit form using jQuery Validation
      $("#reset-form").validate({
        rules: {
            "resetemail": {
                required: true,
                email: true
            }
        },
        messages: {
            "resetemail": {
                required: "Please enter your email address.",
                email: "Please enter a valid email address."
            }
        },
        submitHandler: function (form) {
            // Serialize form data
            var formData = $(form).serialize();

            // Make Ajax request to handle password reset logic
            $.ajax({
                url: "/front/password/reset",  // Use the form's action attribute for the URL
                data: formData,
                type: "POST",
                dataType: "json", // Expect JSON response
                success: function (response) {
                    if (response === 1) {
                        localStorage.setItem('popupshow', '11'); // Store popupshow value
                        $("#loginModal").modal('show');
                        $("#password-reset-link").show(); // Show success popup
                    } else {
                        alert('Unexpected response. Please try again.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    alert('There was a problem with the reset request. Please try again later.');
                }
            });

            return false; // Prevent the default form submit
        }
    });

    // Show popup if popupshow is set to '11'
    if (popupshow == '11') {
        setTimeout(function() {
            $("#signin-form, #otp-verification-form, #otp-verification-form2, #reset-form, #signup-form").hide();
            $("#loginModal").modal('show');
            $("#password-reset-link").show();

            // Close popup when close button is clicked
            $("#close, #closedpopup").click(function() {
                $("#password-reset-link").hide();
                $("#loginModal").modal('hide');
                localStorage.setItem('popupshow', '0'); // Update localStorage to prevent showing popup again
            });

            // Close popup when clicking outside the popup or on a blank area
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#password-reset-link').length) {
                    $("#password-reset-link").hide();
                    localStorage.setItem('popupshow', '0'); // Update localStorage to prevent showing popup again
                }
            });

        }, 1000);
    }

    // Handle click event on "Back to Login" button in success popup
    $("#password-reset-link").on("click", "#closedpopup", function() {
        // Redirect to login page
        window.location.href = "/login";
    });
});

</script>



{{-- <script src="https://d1neo0gtmjcot5.cloudfront.net/assets/js/common_v12.js" type="text/javascript"></script> --}}
@endsection