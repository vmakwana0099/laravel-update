@extends('layouts.app')
@section('content') 
<section class="affiliates_banner_section">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="affi_inner_banner_main">
            <div class="row">
                    <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                    <div class="affi_inner_banner_left">
                        <div class="affi_ibl_content_1">
                            <h6>Be a Successful Affiliate with</h6>
                            <h1>INDIA'S <span class="affi_ibl1_sp">TOP-NOTCH HOSTING</span> COMPANY</h1>
                        </div>

                        <div class="affi_ibl_content_2">
                            <h6>Don't Wait!</h6>
                            <p>Grab <span class="affi_ibl2_sp"><i class="fa fa-inr"></i>1250</span> as Your Sign-up Bonus.</p>
                        </div>
                        
                        <div class="affi_ibl_content_3">
                           <a href="{{Config::get('Constant.AFFILIATES_URL')}}/signup.php" target="_blank" class="affi-program-btn-1">
  <button>Become an Affiliate</button>
</a>
{{Config::get('Constant.AFFILIATES_URL')}}
                            <a href="{{Config::get('Constant.AFFILIATES_URL')}}" class="affi-program-btn-2" target="_blank">
    <button>Already an Affiliate</button>
    <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
</a>
                        </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                    <div class="affi_inner_banner_right d-flex">
                        <img src="/assets/images/affiliates/indias-top-notch-hosting-company.webp" alt="India’s Top-Notch Hosting Company
">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="container">
    <div class="row">
<div class="col-lg-12">
<div class="hm-bnnr-cstmr-rtg">
<div class="cstmr-rtg-main cst-rtg-hostadvice">
<div class="cst-rtg-tittle"><img alt="hostadvice" src="../assets/images/Homepage/hostadvice-logo.webp" /></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /></div>

<div class="cst-rtg-data">
<p>4.2 Ratings</p>
</div>
</div>

<div class="cstmr-rtg-main cst-rtg-trustpilot">
<div class="cst-rtg-tittle"><img alt="trustpilot" src="../assets/images/Homepage/trustpilot-logo.webp" /></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /></div>

<div class="cst-rtg-data">
<p>4.3 Ratings</p>
</div>
</div>

<div class="cstmr-rtg-main cst-rtg-google">
<div class="cst-rtg-tittle"><img alt="google" src="../assets/images/Homepage/google-logo.webp" /></div>

<div class="cst-rtg-star"><img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /> <img alt="star-icon" src="../assets/images/Homepage/star-icon.webp" /></div>

<div class="cst-rtg-data">
<p>4.4 Ratings</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>



{{-- 
<section class="aboutus_01">
    <div class="container">
        <div>          
            <div class="inner-section cms"> --}}
                {!! $CONTENT !!}
            {{-- </div> --}}
            <div class="clearfix"></div>
        {{-- </div>
    </div>
</section> --}}


<section class="affiliates_program">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-center">
                <div class="affi-program-data-left">
               <img src="assets/images/affiliates/have_questions.webp" alt="Have Questions">
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-left">
                <div class="affi-program-data-right">
                   <h2>Have Questions?</h2>
                  <p>For More Information<br>Read Our
                   <a href="{{url('/affiliate-policy')}}" target="block">Affiliate Policy</a> 
                     or Contact Our  Experts <br> at 
                  <a href="mailto:affiliates@hostitsmart.com">affiliates@hostitsmart.com</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

 <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')

<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true, // Enable autoplay
            autoplayTimeout: 2000, // Autoplay interval in milliseconds (5 seconds in this example)
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 2.5
                }
            }
        });
    });
</script>
@endsection