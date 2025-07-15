@extends('layouts.app')
@section('content')



<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="use-our-whois-check-left">
                    <div class="usr-whois-left-img">
                          <img class="browser-img" src="/assets/images/whois_checker/enter-the-domain.webp" alt="enter-the-domain" />
                    </div>
                    <div class="usr-whois-left-cnt">
                        <span>1. Enter the Domain You are Searching for</span>
                        Just type the domain name you’re curious about, fast, simple, and no tech skills needed! You bring the name, we’ll bring the details.
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="use-our-whois-check-right">
                    <div class="usr-whois-right-box">
                        <div class="usr-whois-right-row">
                        <div class="usr-whois-right-img">
                          <img class="browser-img" src="/assets/images/whois_checker/whois-record.webp" alt="whois-record" />
                        </div>
                        <div class="usr-whois-right-cnt">
                            <span>2. We Instantly Fetch the WHOIS Record</span>
                            Our WHOIS tool digs through the data in seconds! Instantly access the latest record with all the key info, owner, dates, status, and more.
                        </div>
                        </div>
                    </div>
                    <div class="usr-whois-right-box">
                        <div class="usr-whois-right-row">
                        <div class="usr-whois-right-img">
                          <img class="browser-img" src="/assets/images/whois_checker/registration-info.webp" alt="registration-info" />
                        </div>
                        <div class="usr-whois-right-cnt">
                            <span>3. You Get Registration Info</span>
                            Find out who’s behind the domain, when it was registered, and when it’s up for renewal. All the domain details are delivered instantly and clearly!
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>








<!-- 
  <section class="container">

    <!-- Left Box -->
    <div class="step-box">
      <img class="browser-img" src="/assets/images/whois_checker/enter-the-domain.webp" alt="enter-the-domain" />
      <div class="search-badge">
        www.hostitsmart.com
      </div>
    </div>

    <!-- Right Steps -->
    <div class="right-column">
      <div class="step-right">
        <img src="https://cdn-icons-png.flaticon.com/512/709/709586.png" alt="Magnifying Glass" />
        <div class="step-text">
          <h4>2. We Instantly Fetch the WHOIS Record</h4>
          <p>Our WHOIS tool digs through the data in seconds! Instantly access the latest record with all the key info, owner, dates, status, and more.</p>
        </div>
      </div>

      <div class="step-right">
        <img src="https://cdn-icons-png.flaticon.com/512/1250/1250615.png" alt="Info Icon" />
        <div class="step-text">
          <h4>3. You Get Registration Info</h4>
          <p>Find out who’s behind the domain, when it was registered, and when it’s up for renewal. All the domain details are delivered instantly and clearly!</p>
        </div>
      </div>
    </div>
  </section> -->
<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')
@endsection