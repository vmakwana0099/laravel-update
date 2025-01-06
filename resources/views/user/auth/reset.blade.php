{{-- @extends('layouts.app')

@section('content')
<div class="reset-password-main">
    <div class="container">
        <div class="col-md-12">
            <div class="reset-title">
                <h1 data-aos="fade-up">Reset Password</h1>
                <p data-aos="fade-up">You are at the right place to reset a forgotten password, unlock your account!</p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="reset-password" data-aos="fade-up">
                <form class="reset-pass-form row" role="form" method="POST" action="{{ url('/user/update/password') }}" id="update_password">
                    {{ csrf_field() }}
                    <input id="remember_token" name="remember_token" type="hidden" value="{{ Request::segment(2) }}">
                    <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="form-text" for="newpassword">New Password<span class="required" aria-required="true"> *</span></label>
                            <input id="password" type="password" class="form-control" name="password" required="required">
                            @if ($errors->has('password'))
                            
                                <strong>{{ $errors->first('password') }}</strong>
                           
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="form-text" for="confirmpassword">Confirm Password<span class="required" aria-required="true"> *</span></label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required="required">
                            @if ($errors->has('password_confirmation'))
                            
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group text-center">        
                            <button type="submit" class="btn btn-default" title="Reset Password">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<section class="page-header-section login-box24" data-overlay="8">
    <div class="container-fluid">
        <div class="row  justify-content-center">
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
                                <p>4.5 Ratings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10 col-lg-5 login-right-col">
                <div class="login-signup-wrap bg-white rounded shadow">
                    <div class="login-box-header">
                        <div class="login-box-logo mb-5">
                            <img alt="logo" src="../assets/images/logo.webp">
                        </div>
                        <h1 class="mb-2">Reset Password</h1>
                        <p class="mb-5">You are at the right place to reset a forgotten password, unlock your account!</p>
                    </div>

                    {{-- <form id="signin-form" action="{{ url('/front-login') }}" method="post" role="form" class="login-box-form"> --}}
                      
                       <form class="login-box-form" role="form" method="POST" action="{{ url('/user/update/password') }}" id="update_password">
                    {{ csrf_field() }}
                        <input id="remember_token" name="remember_token" type="hidden" value="{{ Request::segment(2) }}">
                        <!-- Password -->
                        <div class="form-group  {{ $errors->has('loginpassword') ? ' has-error' : '' }}">
                            <!-- Label -->
                            <label class="pb-4">New Password </label>
                            <!-- Input group -->
                            <div class="input-group input-group-merge password-container">
                                <div class="input-icon">
                                    <span class="inp-grp-icon"><i class="fa-solid fa-lock"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" required="required">
                            @if ($errors->has('password'))
                         
                                <span class="error">{{ $errors->first('password') }}</span>
                           
                            @endif


                                <div class="input-group-append">
                                    <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('password', this)"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  {{ $errors->has('loginpassword') ? ' has-error' : '' }}">
                            <!-- Label -->
                            <label class="pb-4">Confirm Password </label>
                            <!-- Input group -->
                            <div class="input-group input-group-merge password-container">
                                <div class="input-icon">
                                    <span class="inp-grp-icon"><i class="fa-solid fa-lock"></i></span>
                                </div>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required="required">
                            @if ($errors->has('password_confirmation'))
                          
                                <span class="error">{{ $errors->first('password_confirmation') }}</span>
                            
                            @endif


                                <div class="input-group-append">
                                    <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('password_confirmation', this)"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Submit -->
                        <div class="d-grid sign-up-box-btn">
                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-primary my-3" value="Reset Password">

                            {{-- <button type="submit" class="btn btn-default" title="Reset Password">Reset Password</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- password-eye-icon-s -->
<script>
    function togglePasswordVisibility(inputId, iconElement) {
        const passwordInput = document.getElementById(inputId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            iconElement.classList.remove('fa-eye');
            iconElement.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            iconElement.classList.remove('fa-eye-slash');
            iconElement.classList.add('fa-eye');
        }
    }
</script>
<!-- password-eye-icon-e -->
@endsection