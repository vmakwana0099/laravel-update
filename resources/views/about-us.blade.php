@extends('layouts.app')

@section('content')

<?php 
$theme = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$theme.'.banner')

<section class="who_we_are head-tb-p-40">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="who_we_are_img d-flex justify-content-center justify-content-lg-start">
                    <img src="../assets/images/about_us/who_we_are.webp" alt="who_we_are">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="text_head">Who We Are i'm vinod </h2>
                    <p>We’re not just a web hosting company; we’re your friendly tech partner in the online world!
                        Whether you are starting a blog or running an online store, we ensure that your website is fast,
                        secure, and always up and running. </p>
                       <p>We believe hosting should be simple, reliable, and budget-friendly, which helps you grow your
                        online presence stress-free because every business deserves a stable web home, and we are
                        excited to support you throughout the journey!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="know-our-story head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head">Know Our Story</h2>
            <span class="know-story-sub-tittle">Every business has its own story - and ours began back in 2012!</span>
            <p>It began with a simple mission: To make web hosting better, faster, and easier for everyone. At the time, we saw too many people struggling with slow servers, clunky dashboards, and support teams that didn’t quite solve problems. We knew things could be different and set out to make it happen.</p>
            <p>What started as a small team with a big vision has now grown into a trusted hosting provider serving thousands of websites across industries. Over the years, we have listened, learned, and leveled up, constantly evolving to meet the changing needs of our customers.</p>
            <p>From 2012 to now, the journey has been incredible, and we are not done yet. We are still growing, still improving, and still just getting started.</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="know-our-story-img">
                    
                    
                </div>
            </div>
        </div>
    </div>
</section> -->


<section class="globally_img head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">Started in India, Now Present Overseas</h2>
            <p>
                We began in one corner of the world, but now we help businesses launch far and wide. From small startups
                in India to large enterprises worldwide, our hosting solutions power numerous websites!
            </p>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-12">
                <div class="globally_img_img text-center">
                    <img src="../assets/images/about_us/map.webp" alt="map">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="value-do-we-offr head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">What Value Do We Offer You?</h2>
            <p>
                We’re not just providing space on a server; we’re delivering peace of mind!
            </p>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="value-do-we-offr_img">
                    <img src="../assets/images/about_us/value.webp" alt="value">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="value-do-offr-ul">
                    <ul>
                        <li><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="30" height="29.942" viewBox="0 0 30 29.942">
                                    <defs>
                                        <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                            gradientUnits="objectBoundingBox">
                                            <stop offset="0" stop-color="#068c46" />
                                            <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                        <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                            <g id="Layer_1_copy_8" data-name="Layer 1 copy 8"
                                                transform="translate(0 0)">
                                                <g id="_1" data-name="1">
                                                    <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971"
                                                        cy="14.971" r="14.971" fill="#1dd882" />
                                                    <path id="Path_248390" data-name="Path 248390"
                                                        d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                        transform="translate(-111.7 -144.546)"
                                                        fill="url(#linear-gradient)" />
                                                    <path id="Path_248391" data-name="Path 248391"
                                                        d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                        transform="translate(-108.883 -141.084)" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span> We treat your business like our own.</li>
                        <li><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="30" height="29.942" viewBox="0 0 30 29.942">
                                    <defs>
                                        <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                            gradientUnits="objectBoundingBox">
                                            <stop offset="0" stop-color="#068c46" />
                                            <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                        <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                            <g id="Layer_1_copy_8" data-name="Layer 1 copy 8"
                                                transform="translate(0 0)">
                                                <g id="_1" data-name="1">
                                                    <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971"
                                                        cy="14.971" r="14.971" fill="#1dd882" />
                                                    <path id="Path_248390" data-name="Path 248390"
                                                        d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                        transform="translate(-111.7 -144.546)"
                                                        fill="url(#linear-gradient)" />
                                                    <path id="Path_248391" data-name="Path 248391"
                                                        d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                        transform="translate(-108.883 -141.084)" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span> Fast responses, no ticket chases.</li>
                        <li><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="30" height="29.942" viewBox="0 0 30 29.942">
                                    <defs>
                                        <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                            gradientUnits="objectBoundingBox">
                                            <stop offset="0" stop-color="#068c46" />
                                            <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                        <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                            <g id="Layer_1_copy_8" data-name="Layer 1 copy 8"
                                                transform="translate(0 0)">
                                                <g id="_1" data-name="1">
                                                    <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971"
                                                        cy="14.971" r="14.971" fill="#1dd882" />
                                                    <path id="Path_248390" data-name="Path 248390"
                                                        d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                        transform="translate(-111.7 -144.546)"
                                                        fill="url(#linear-gradient)" />
                                                    <path id="Path_248391" data-name="Path 248391"
                                                        d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                        transform="translate(-108.883 -141.084)" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span> Real humans, not bots, to assist you.</li>
                        <li><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="30" height="29.942" viewBox="0 0 30 29.942">
                                    <defs>
                                        <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                            gradientUnits="objectBoundingBox">
                                            <stop offset="0" stop-color="#068c46" />
                                            <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                        <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                            <g id="Layer_1_copy_8" data-name="Layer 1 copy 8"
                                                transform="translate(0 0)">
                                                <g id="_1" data-name="1">
                                                    <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971"
                                                        cy="14.971" r="14.971" fill="#1dd882" />
                                                    <path id="Path_248390" data-name="Path 248390"
                                                        d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                        transform="translate(-111.7 -144.546)"
                                                        fill="url(#linear-gradient)" />
                                                    <path id="Path_248391" data-name="Path 248391"
                                                        d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                        transform="translate(-108.883 -141.084)" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span> Transparency is our policy - no hidden surprises.</li>
                        <li><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="30" height="29.942" viewBox="0 0 30 29.942">
                                    <defs>
                                        <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                            gradientUnits="objectBoundingBox">
                                            <stop offset="0" stop-color="#068c46" />
                                            <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                        <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                            <g id="Layer_1_copy_8" data-name="Layer 1 copy 8"
                                                transform="translate(0 0)">
                                                <g id="_1" data-name="1">
                                                    <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971"
                                                        cy="14.971" r="14.971" fill="#1dd882" />
                                                    <path id="Path_248390" data-name="Path 248390"
                                                        d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                        transform="translate(-111.7 -144.546)"
                                                        fill="url(#linear-gradient)" />
                                                    <path id="Path_248391" data-name="Path 248391"
                                                        d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                        transform="translate(-108.883 -141.084)" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span> Guidance at every step, whether you're a beginner or a pro.</li>
                        <li><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="30" height="29.942" viewBox="0 0 30 29.942">
                                    <defs>
                                        <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                            gradientUnits="objectBoundingBox">
                                            <stop offset="0" stop-color="#068c46" />
                                            <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                        <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                            <g id="Layer_1_copy_8" data-name="Layer 1 copy 8"
                                                transform="translate(0 0)">
                                                <g id="_1" data-name="1">
                                                    <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971"
                                                        cy="14.971" r="14.971" fill="#1dd882" />
                                                    <path id="Path_248390" data-name="Path 248390"
                                                        d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                        transform="translate(-111.7 -144.546)"
                                                        fill="url(#linear-gradient)" />
                                                    <path id="Path_248391" data-name="Path 248391"
                                                        d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                        transform="translate(-108.883 -141.084)" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span> We build relationships, not just receipts.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

 
<section class="trst-tg-main head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Trusted by Industry Leaders. We Redefine Success Together</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="trst-tg-box">
                    <div class="trst-tg-box-carousel">
                        <div class="tsrt-tg-box-items">
                            <img src="{{url('assets/images/Homepage/partners_acronis.webp')}}" alt="partners_acronis" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_amazonwebservice.webp')}}" alt="partners_amazonwebservice" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_cpanel.webp')}}" alt="partners_cpanel" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_cwp.webp')}}" alt="partners_cwp" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_googlegsuite.webp')}}" alt="partners_googlegsuite" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_microsoft.webp')}}" alt="partners_microsoft" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_plesk.webp')}}" alt="partners_plesk" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_softaculous.webp')}}" alt="partners_softaculous" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_webuzo.webp')}}" alt="partners_webuzo" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_icann.webp')}}" alt="partners_icann" loading="lazy">
                       
                            <img src="{{url('assets/images/Homepage/partners_acronis.webp')}}" alt="partners_acronis" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_amazonwebservice.webp')}}" alt="partners_amazonwebservice" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_cpanel.webp')}}" alt="partners_cpanel" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_cwp.webp')}}" alt="partners_cwp" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_googlegsuite.webp')}}" alt="partners_googlegsuite" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_microsoft.webp')}}" alt="partners_microsoft" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_plesk.webp')}}" alt="partners_plesk" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_softaculous.webp')}}" alt="partners_softaculous" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_webuzo.webp')}}" alt="partners_webuzo" loading="lazy">

                            <img src="{{url('assets/images/Homepage/partners_icann.webp')}}" alt="partners_icann" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-achievement head-tb-p-40">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Our Astonishing Achievements</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="our-achivmnt-box">
                        <div class="our-achivmnt-tittle">
                            Host IT Smart Recognized With Rising Star Award
                        </div>
                        <div class="our-achivmnt-img">
                            <img src="../assets/images/about_us/rising-star-award.webp" alt="rising-star-award">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="our-achivmnt-box">
                        <div class="our-achivmnt-tittle">
                            Hallmark of Trust, Security & Performance
                        </div>
                        <div class="our-achivmnt-img">
                            <img src="../assets/images/about_us/web-hosting-award.webp" alt="web-hosting-award">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- <section class="our-cust-rev-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="our-cust-rev">
                    <div class="owl-carousel owl-theme our-rating-cr">
                        <div class="our-cust-rev-box">
                            <div class="our-cust-rev-tittle">
                                Review Tittle
                            </div>
                            <div class="our-cust-rev-cnt">
                                Switching to HOST IT SMART was the best decision for our online business. Our website now loads faster, uptime is consistent, and their customer support is responsive 24/7. Highly recommend for businesses that can't afford downtime.
                            </div>
                            <div class="our-cust-rev-user">
                                <div class="our-cust-rev-pro">
                                    <img src="/assets/images/about_us/rating-user.png" alt="rating-user">
                                </div>
                                <div class="our-cust-rev-info">
                                    <div class="our-cust-rev-name">
                                        Yashpalsinh Vaghela
                                    </div>
                                    <div class="our-cust-rev-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.328" height="25.107" viewBox="0 0 26.328 25.107">
                                            <g id="Group_18921" data-name="Group 18921" transform="translate(0 0)">
                                                <path id="Path_72728" data-name="Path 72728"
                                                    d="M25.707,20.947l-8.528-.791L13.791,12.29a.683.683,0,0,0-1.255,0L9.149,20.156l-8.528.791a.683.683,0,0,0-.388,1.194l6.434,5.652L4.784,36.148a.683.683,0,0,0,1.016.738l7.364-4.373,7.364,4.373a.683.683,0,0,0,1.016-.738L19.66,27.793l6.434-5.652A.683.683,0,0,0,25.707,20.947Z"
                                                    transform="translate(0 -11.877)" fill="#ffdc64" />
                                                <path id="Path_72729" data-name="Path 72729"
                                                    d="M13.791,12.29a.683.683,0,0,0-1.255,0L9.149,20.156l-8.528.791a.683.683,0,0,0-.388,1.194l6.434,5.652L4.784,36.148a.683.683,0,0,0,1.016.738l1.644-.976a30.14,30.14,0,0,1,8.023-19.73Z"
                                                    transform="translate(0 -11.877)" fill="#ffc850" />
                                            </g>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.328" height="25.107" viewBox="0 0 26.328 25.107">
                                            <g id="Group_18921" data-name="Group 18921" transform="translate(0 0)">
                                                <path id="Path_72728" data-name="Path 72728"
                                                    d="M25.707,20.947l-8.528-.791L13.791,12.29a.683.683,0,0,0-1.255,0L9.149,20.156l-8.528.791a.683.683,0,0,0-.388,1.194l6.434,5.652L4.784,36.148a.683.683,0,0,0,1.016.738l7.364-4.373,7.364,4.373a.683.683,0,0,0,1.016-.738L19.66,27.793l6.434-5.652A.683.683,0,0,0,25.707,20.947Z"
                                                    transform="translate(0 -11.877)" fill="#ffdc64" />
                                                <path id="Path_72729" data-name="Path 72729"
                                                    d="M13.791,12.29a.683.683,0,0,0-1.255,0L9.149,20.156l-8.528.791a.683.683,0,0,0-.388,1.194l6.434,5.652L4.784,36.148a.683.683,0,0,0,1.016.738l1.644-.976a30.14,30.14,0,0,1,8.023-19.73Z"
                                                    transform="translate(0 -11.877)" fill="#ffc850" />
                                            </g>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.328" height="25.107" viewBox="0 0 26.328 25.107">
                                            <g id="Group_18921" data-name="Group 18921" transform="translate(0 0)">
                                                <path id="Path_72728" data-name="Path 72728"
                                                    d="M25.707,20.947l-8.528-.791L13.791,12.29a.683.683,0,0,0-1.255,0L9.149,20.156l-8.528.791a.683.683,0,0,0-.388,1.194l6.434,5.652L4.784,36.148a.683.683,0,0,0,1.016.738l7.364-4.373,7.364,4.373a.683.683,0,0,0,1.016-.738L19.66,27.793l6.434-5.652A.683.683,0,0,0,25.707,20.947Z"
                                                    transform="translate(0 -11.877)" fill="#ffdc64" />
                                                <path id="Path_72729" data-name="Path 72729"
                                                    d="M13.791,12.29a.683.683,0,0,0-1.255,0L9.149,20.156l-8.528.791a.683.683,0,0,0-.388,1.194l6.434,5.652L4.784,36.148a.683.683,0,0,0,1.016.738l1.644-.976a30.14,30.14,0,0,1,8.023-19.73Z"
                                                    transform="translate(0 -11.877)" fill="#ffc850" />
                                            </g>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.328" height="25.107" viewBox="0 0 26.328 25.107">
                                            <g id="Group_18921" data-name="Group 18921" transform="translate(0 0)">
                                                <path id="Path_72728" data-name="Path 72728"
                                                    d="M25.707,20.947l-8.528-.791L13.791,12.29a.683.683,0,0,0-1.255,0L9.149,20.156l-8.528.791a.683.683,0,0,0-.388,1.194l6.434,5.652L4.784,36.148a.683.683,0,0,0,1.016.738l7.364-4.373,7.364,4.373a.683.683,0,0,0,1.016-.738L19.66,27.793l6.434-5.652A.683.683,0,0,0,25.707,20.947Z"
                                                    transform="translate(0 -11.877)" fill="#ffdc64" />
                                                <path id="Path_72729" data-name="Path 72729"
                                                    d="M13.791,12.29a.683.683,0,0,0-1.255,0L9.149,20.156l-8.528.791a.683.683,0,0,0-.388,1.194l6.434,5.652L4.784,36.148a.683.683,0,0,0,1.016.738l1.644-.976a30.14,30.14,0,0,1,8.023-19.73Z"
                                                    transform="translate(0 -11.877)" fill="#ffc850" />
                                            </g>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18.158" height="17.315" viewBox="0 0 18.158 17.315">
                                            <g id="Group_171609" data-name="Group 171609" transform="translate(0 0)">
                                                <path id="Path_72728" data-name="Path 72728"
                                                    d="M17.729,18.132l-5.881-.545L9.511,12.162a.471.471,0,0,0-.866,0L6.31,17.587l-5.881.545a.471.471,0,0,0-.268.823l4.438,3.9L3.3,28.616a.471.471,0,0,0,.7.509l5.079-3.016,5.079,3.016a.471.471,0,0,0,.7-.509l-1.3-5.762L18,18.955A.471.471,0,0,0,17.729,18.132Z"
                                                    transform="translate(0 -11.877)" fill="#f2f2f2" />
                                                <path id="Path_72729" data-name="Path 72729"
                                                    d="M9.511,12.162a.471.471,0,0,0-.866,0L6.31,17.587l-5.881.545a.471.471,0,0,0-.268.823l4.438,3.9L3.3,28.616a.471.471,0,0,0,.7.509l1.134-.673a20.787,20.787,0,0,1,5.533-13.608Z"
                                                    transform="translate(0 -11.877)" fill="#ffc850" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item"><h4>2</h4></div>
                        <div class="item"><h4>3</h4></div>
                        <div class="item"><h4>4</h4></div>
                        <div class="item"><h4>5</h4></div>
                        <div class="item"><h4>6</h4></div>
                        <div class="item"><h4>7</h4></div>
                        <div class="item"><h4>8</h4></div>
                        <div class="item"><h4>9</h4></div>
                        <div class="item"><h4>10</h4></div>
                        <div class="item"><h4>11</h4></div>
                        <div class="item"><h4>12</h4></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->


@include('template.'.$theme.'.testimonial_section')

<section class="about-features head-tb-p-40">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="about-features-cnt">
                    <div class="section-heading">
                        <h2 class="text_head">Innovation Anywhere</h2>
                        <p>Behind every fast-loading website and smooth hosting experience, there’s a wonderful team that genuinely cares. Whether it’s resolving a complex technical issue at 2 AM or supporting a small business as it takes its first steps online, our team is always there with complete dedication every single time.</p>
                        <p>Whether it’s about making your site load faster, keeping your data safer, or providing you with new tools to manage things better, we’re always working behind the scenes to help make your online journey even smoother.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-features-img d-flex justify-content-center justify-content-lg-end">
                    <img src="../assets//images/about_us/innovation.webp" alt="innovation">
                </div>
            </div>
            </div>
            <div class="row justify-content-center align-items-center flex-lg-row-reverse">
            <div class="col-lg-6">
                <div class="about-features-cnt">
                    <div class="section-heading">
                        <h2 class="text_head">A Committed Team</h2>
                        <p>Behind every fast-loading website and smooth hosting experience, there’s a wonderful team that genuinely cares. Whether it’s resolving a complex technical issue at 2 AM or supporting a small business as it takes its first steps online, our team is always there with complete dedication every single time.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-features-img">
                    <img src="../assets//images/about_us/commited_team.webp" alt="commited_team">
                </div>
            </div>
            </div>
            <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="about-features-cnt">
                    <div class="section-heading">
                        <h2 class="text_head">Our Future Goals</h2>
                    </div>
                    <div class="about-features-ul">
                        <p>We’re dreaming big, and we’re pouring our hearts into making it happen!</p>
                        <ul>
                            <li> <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                                        height="29.942" viewBox="0 0 30 29.942">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#068c46" />
                                                <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                        <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                            <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                                <g id="Layer_1_copy_8" data-name="Layer 1 copy 8" transform="translate(0 0)">
                                                    <g id="_1" data-name="1">
                                                        <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971" cy="14.971" r="14.971"
                                                            fill="#1dd882" />
                                                        <path id="Path_248390" data-name="Path 248390"
                                                            d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                            transform="translate(-111.7 -144.546)" fill="url(#linear-gradient)" />
                                                        <path id="Path_248391" data-name="Path 248391"
                                                            d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                            transform="translate(-108.883 -141.084)" fill="#fff" />
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></span> To make hosting even easier for everyone</li>
                            <li> <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                                        height="29.942" viewBox="0 0 30 29.942">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#068c46" />
                                                <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                        <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                            <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                                <g id="Layer_1_copy_8" data-name="Layer 1 copy 8" transform="translate(0 0)">
                                                    <g id="_1" data-name="1">
                                                        <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971" cy="14.971" r="14.971"
                                                            fill="#1dd882" />
                                                        <path id="Path_248390" data-name="Path 248390"
                                                            d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                            transform="translate(-111.7 -144.546)" fill="url(#linear-gradient)" />
                                                        <path id="Path_248391" data-name="Path 248391"
                                                            d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                            transform="translate(-108.883 -141.084)" fill="#fff" />
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></span> To expand into more countries and serve a larger, diverse audience</li>
                            <li> <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                                        height="29.942" viewBox="0 0 30 29.942">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#068c46" />
                                                <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                        <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                            <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                                <g id="Layer_1_copy_8" data-name="Layer 1 copy 8" transform="translate(0 0)">
                                                    <g id="_1" data-name="1">
                                                        <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971" cy="14.971" r="14.971"
                                                            fill="#1dd882" />
                                                        <path id="Path_248390" data-name="Path 248390"
                                                            d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                            transform="translate(-111.7 -144.546)" fill="url(#linear-gradient)" />
                                                        <path id="Path_248391" data-name="Path 248391"
                                                            d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                            transform="translate(-108.883 -141.084)" fill="#fff" />
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></span> To continue investing in green technology and more sustainable infrastructure</li>
                            <li> <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                                        height="29.942" viewBox="0 0 30 29.942">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775"
                                                gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#068c46" />
                                                <stop offset="1" stop-color="#068c46" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                        <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
                                            <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
                                                <g id="Layer_1_copy_8" data-name="Layer 1 copy 8" transform="translate(0 0)">
                                                    <g id="_1" data-name="1">
                                                        <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971" cy="14.971" r="14.971"
                                                            fill="#1dd882" />
                                                        <path id="Path_248390" data-name="Path 248390"
                                                            d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z"
                                                            transform="translate(-111.7 -144.546)" fill="url(#linear-gradient)" />
                                                        <path id="Path_248391" data-name="Path 248391"
                                                            d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z"
                                                            transform="translate(-108.883 -141.084)" fill="#fff" />
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></span> And most importantly, to keep listening to you, so we evolve with your needs.</li>
                        </ul>
                        <p>We’re not just here for today. We’re building for the future, and we’d love for you to be part of that journey.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-features-img d-flex justify-content-center justify-content-lg-end">
                    <img src="../assets//images/about_us/future_goals.webp" alt="future_goals">
                </div>
            </div>
        </div>
    </div>
</section>

@include('template.'.$theme.'.support_section_home')

<script>
    $('.our-rating-cr').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>


<script src="{{ url('/') }}/assets/js/counter.js?v={{date('YmdHi')}}"></script>

@endsection