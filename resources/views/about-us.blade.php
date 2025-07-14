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
                    <h2 class="text_head">Who We Are</h2>
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
<section class="our-story-wrapper-main head-tb-p-40">
    <div class="container">
        
        <div class="section-heading text-center">
            <h2 class="text_head text-center">
                Know Our Story
            </h2>
            <p>Every business has its own story, and ours began back in 2012!</p>
            <p>It began with a simple mission: To make web hosting better, faster, and easier for everyone. At the time, we saw too
                many people struggling with slow servers, clunky dashboards, and support teams that didn’t quite solve problems. We
                knew things could be different and set out to make it happen.What started as a small team with a big vision has now grown into a trusted hosting provider serving thousands of
                websites across industries. Over the years, we have listened, learned, and leveled up, constantly evolving to meet
                the changing needs of our customers.</p>
            <p>From 2012 to now, the journey has been incredible, and we are not done yet.
                We are still growing, still improving, and still just getting started.
            </p>
        </div>
        </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
               <div class="journey-section">
        
        <div class="journey-main">
            <div class="journey-years">
                <!-- <div class="year-arrow disabled" id="year-up">▲</div> -->
                 <span id="scroll-up" class="our-story-year-prev"><i class="fa-solid fa-chevron-up"></i></span>
                <ul class="years-list" id="years-list">
                    <li class="year-item active"><span class="year-dot"></span>a</li>
                    <li class="year-item"><span class="year-dot"></span>b</li>
                    <li class="year-item"><span class="year-dot"></span>c</li>
                    <li class="year-item"><span class="year-dot"></span>d</li>
                    <li class="year-item"><span class="year-dot"></span>e</li>
                    <li class="year-item"><span class="year-dot"></span>f</li>
                    <li class="year-item"><span class="year-dot"></span>g</li>
                    <li class="year-item"><span class="year-dot"></span>h</li>
                    <li class="year-item"><span class="year-dot"></span>i</li>
                </ul>
                <span id="scroll-down" class="our-story-year-prev"><i class="fa-solid fa-chevron-down"></i></span>
                <!-- <div class="year-arrow" id="year-down">▼</div> -->
            </div>
            <div class="journey-content">
                <div class="slider-row" id="slider-row">
                    <div class="year-slider-block" id="year-block-0">
                        <div class="year-title">2025</div>
                        <div class="milestones-row">
                           
                        </div>
                    </div>
                    <div class="year-slider-block" id="year-block-1">
                        <div class="year-title">2024</div>
                        <div class="milestones-row">
                            <div class="milestone-card">
                                <div class="milestone-title">Zoho Campaigns</div>
                                <div class="milestone-desc">Zoho Campaigns launches new automation features.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</section>




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



<script>
// --- Milestone pool for each year ---
const milestonePool = [
    [
        { icon: ` <img src="/assets/images/about_us/direct-admin.webp" alt="direct-admin">`,date:'October 2024', title: 'Official Partnership with DirectAdmin', desc: `Another panel in the mix! DirectAdmin brought simplicity and speed to server management.` },
    ],
    [
        { icon: ' <img src="/assets/images/about_us/webuzo.webp" alt="webuzo">',date:'January 2023', title: 'Joined Hands with Webuzo', desc: 'Webuzo joined the party! Our customers have more options to manage their servers.' },
    ],
    [
        { icon: ' <img src="/assets/images/about_us/acronis_cloud_backup.webp" alt="acronis_cloud_backup">',date:'March 2022', title: 'Partnered with Acronis for Data Backup Solutions', desc: 'We take Backups seriously! Acronis helped us add a strong layer of data protection.' },
    ],
    [
        { icon: ' <img src="/assets/images/about_us/microsoft-spla.webp" alt="microsoft-spla">',date:'February 2021', title: 'Added Microsoft SPLA Partnership', desc: 'Added another feather! With SPLA, we expanded our range of licensed Microsoft solutions.' },
    ],
    [
        { icon: ' <img src="/assets/images/about_us/softaculous.webp" alt="softaculous">',date:'January 2020', title: 'Partnered with Softaculous', desc: 'We bought 1-click installs for everyone! With Softaculous, we made launching apps a breeze.' },
        { icon: ' <img src="/assets/images/about_us/business-grow.webp" alt="business-grow">',date:'July 2020', title: 'July 2020', desc: 'Enabled 1500+ Businesses to Go Online During Lockdown',desc2: 'In the toughest times, we delivered solutions! We empowered over 1500 businesses to shift online and keep moving forward.' },
        
    ],
    [
        { icon: ' <img src="/assets/images/about_us/aws.webp" alt="aws">',date:'February 2019', title: 'Initiated AWS Support Services', desc: 'The cloud was calling & we answered! We started helping businesses scale with AWS support.' },
       
    ],
    [
        { icon: ' <img src="/assets/images/about_us/infrastructure.webp" alt="infrastructure">',date:'January 2018', title: 'Launched Our Own Hosting Infrastructure', desc: 'It was time to take control! We built our own hosting infrastructure to offer faster, safer services.' },
        { icon: ' <img src="/assets/images/about_us/cpanel.webp" alt="cpanel">',date:'March 2018', title: 'Official cPanel Partnership', desc: 'With cPanel in our corner, managing websites became super easy for our customers.' },
        { icon: ' <img src="/assets/images/about_us/plesk.webp" alt="plesk">',date:'June 2018', title: 'Became a Certified Plesk Partner', desc: 'More choices of panels mean more power! We partnered with Plesk to give clients flexibility in control panels.' },
       
    ],
    [
        { icon: ' <img src="/assets/images/about_us/cloudlinux-os.webp" alt="cloudlinux-os">',date:'December 2017', title: 'Entered into Partnership with CloudLinux', desc: 'We understand that strong servers need strong foundations, so we partnered with CloudLinux for better security and stability.' },        
    ],
    [
        { icon: ' <img src="/assets/images/about_us/ican.webp" alt="ican">',date:'November 2016', title: 'Accredited as an ICANN Registrar', desc: 'We got legit with domains! ICANN gave us the official nod to register domains globally.' },
    ],

    [
        { icon: ' <img src="/assets/images/about_us/microsoft.webp" alt="microsoft">',date:'December 2015', title: 'Partnered with Microsoft as a Silver Application Developer', desc: 'Silver from Microsoft? Oh yes! After that, we geared up to deliver more powerful hosting experiences.' },
    ],

     [
        { icon: ' <img src="/assets/images/about_us/inuagration_ahmedabad_office.webp" alt="inuagration_ahmedabad_office">',date:'January 2014', title: 'Inauguration of Ahmedabad Office', desc: 'From digital to physical, our first real space in Ahmedabad felt like leveling up in real life.' },
        { icon: ' <img src="/assets/images/about_us/hosted_website.webp" alt="hosted_website">',date:'July 2014', title: 'Achieved 1000+ Hosted Websites Milestone', desc: 'Our servers started getting crowded in a good way! Over 1000+ websites chose us as their home.' },
    ],

    [
        { icon: ' <img src="/assets/images/about_us/google.webp" alt="google">',date:'November 2013', title: 'Recognized as an Authorized Google Partner', desc: 'We got Google’s stamp of approval! That gave us wings to offer smarter online solutions.' },
    ],

    [
        { icon: ' <img src="/assets/images/about_us/hostitsmart.webp" alt="hostitsmart">',date:'April 2012', title: 'Establishment of Host IT Smart', desc: 'It all started with a spark and a server! Host IT Smart was born to simplify and improve web hosting.' },
    ]
];

// Create journeyData as a fixed array for each year 2025-2017
const journeyData = [
    { year: 2024, milestones: milestonePool[0] },
    { year: 2023, milestones: milestonePool[1] },
    { year: 2022, milestones: milestonePool[2] },
    { year: 2021, milestones: milestonePool[3] },
    { year: 2020, milestones: milestonePool[4] },
    { year: 2019, milestones: milestonePool[5] },
    { year: 2018, milestones: milestonePool[6] },
    { year: 2017, milestones: milestonePool[7] },
    { year: 2016, milestones: milestonePool[8] },
    { year: 2015, milestones: milestonePool[9] },
    { year: 2014, milestones: milestonePool[10] },
    { year: 2013, milestones: milestonePool[11] },
    { year: 2012, milestones: milestonePool[12] },
];

const yearsList = document.getElementById('years-list');
// const yearUp = document.getElementById('year-up');
// const yearDown = document.getElementById('year-down');
const sliderRow = document.getElementById('slider-row');

let selectedYearIdx = 0;

function renderYears() {
    yearsList.innerHTML = '';
    journeyData.forEach((item, idx) => {
        const li = document.createElement('li');
        li.className = 'year-item' + (idx === selectedYearIdx ? ' active' : '');
        li.innerHTML = `<span class='year-dot'></span>${item.year}`;
        li.onclick = () => {
            selectedYearIdx = idx;
            renderYears();
            scrollToYear(idx);
        };
        yearsList.appendChild(li);
    });
    scrollYearNavToActive();
}

function renderSlider() {
    sliderRow.innerHTML = '';
    journeyData.forEach((yearData, idx) => {
        const yearBlock = document.createElement('div');
        
        if(idx == 0 || idx == 4 || idx == 8 || idx == 12){
            yearBlock.className = 'year-slider-block our-story-24';
            
        }else if(idx == 1 || idx == 5 || idx == 9){
            yearBlock.className = 'year-slider-block our-story-23';
         
        }else if(idx == 2 || idx == 6 || idx == 10){
            yearBlock.className = 'year-slider-block our-story-22';
         
        }else if(idx == 3 || idx == 7 || idx == 11){
            yearBlock.className = 'year-slider-block our-story-21';
        }
        
        yearBlock.id = `year-block-${idx}`;
        yearBlock.innerHTML = `<div class='year-title'>${yearData.year}</div>`;
        const milestonesRow = document.createElement('div');
        milestonesRow.className = 'milestones-row';
        yearData.milestones.forEach(milestone => {
            const card = document.createElement('div');
            card.className = 'milestone-card';

            card.innerHTML =
               `<div class="our-story-box-img">${milestone.icon}</div>` +
            `<div class='milestone-year'>${milestone.date}</div>` +
                `<div class='milestone-title'>${milestone.title}</div>` +
                `<div class='milestone-desc'>${milestone.desc}</div>`;
            milestonesRow.appendChild(card);
        });
        yearBlock.appendChild(milestonesRow);
        sliderRow.appendChild(yearBlock);
    });
}

function scrollToYear(idx) {
    const block = document.getElementById(`year-block-${idx}`);
    if (block) {
        block.scrollIntoView({ behavior: 'smooth', inline: 'start', block: 'nearest' });
    }
}

function scrollYearNavToActive() {
    const active = yearsList.querySelector('.active');
    if (active) {
        active.scrollIntoView({ block: 'nearest', inline: 'nearest', behavior: 'smooth' });
         const containerTop = yearsList.getBoundingClientRect().top;
        const itemTop = active.getBoundingClientRect().top;
        const offset = itemTop - containerTop;
        const desiredPosition = yearsList.clientHeight * 0.3;
        const scrollOffset = offset - desiredPosition;
    
        yearsList.scrollBy({
            top: scrollOffset,
            behavior: 'smooth'
        });

    }
}



// yearUp.onclick = () => {
//     if (selectedYearIdx > 0) {
//         selectedYearIdx--;
//         renderYears();
//         scrollToYear(selectedYearIdx);
//     }
// };
// yearDown.onclick = () => {
//     if (selectedYearIdx < journeyData.length - 1) {
//         selectedYearIdx++;
//         renderYears();
//         scrollToYear(selectedYearIdx);
//     }
// };

function updateArrows() {
    yearUp.classList.toggle('disabled', selectedYearIdx === 0);
    yearDown.classList.toggle('disabled', selectedYearIdx === journeyData.length - 1);
}

function rerenderAll() {
    renderYears();
    renderSlider();
    updateArrows();
    setTimeout(() => scrollToYear(selectedYearIdx), 0);
}

// --- New: Sync year highlight with slider scroll ---
sliderRow.addEventListener('scroll', function () {
    // Find the year block closest to the left edge of the slider
    const sliderRect = sliderRow.getBoundingClientRect();
    let minDist = Infinity;
    let closestIdx = 0;
    journeyData.forEach((_, idx) => {
        const block = document.getElementById(`year-block-${idx}`);
        if (block) {
            const blockRect = block.getBoundingClientRect();
            // Distance from left edge of slider
            const dist = Math.abs(blockRect.left - sliderRect.left);
            if (dist < minDist) {
                minDist = dist;
                closestIdx = idx;
            }
        }
    });
    if (closestIdx !== selectedYearIdx) {
        selectedYearIdx = closestIdx;
        renderYears();
        updateArrows();
    }
});
// --- End new code ---

// Initial render
rerenderAll();

// Update arrows on year change
const observer = new MutationObserver(updateArrows);
observer.observe(yearsList, { childList: true, subtree: true });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const scrollUp = document.getElementById("scroll-up");
        const scrollDown = document.getElementById("scroll-down");
        const yearsList = document.getElementById("years-list");

        const scrollAmount = 50; // Adjust scroll step in px

        scrollUp.addEventListener("click", () => {
            yearsList.scrollBy({
                top: -scrollAmount,
                behavior: "smooth"
            });
        });

        scrollDown.addEventListener("click", () => {
            yearsList.scrollBy({
                top: scrollAmount,
                behavior: "smooth"
            });
        });
    });
    
</script>







<script src="{{ url('/') }}/assets/js/counter.js?v={{date('YmdHi')}}"></script>

@endsection