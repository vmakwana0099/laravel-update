@extends('layouts.app')

@section('content')

@include('layouts.inner_banner')



<div class="inner_container cms">

    <div class="container">

        <div class="row">

            <div class="col-sm-12">

                {!!$CONTENT!!}

            </div>

        </div>

    </div>

</div>

<section class="who_we_are head-tb-p-40">
    <div class="container">
<div class="row">
    <div class="col-lg-6">
        
    </div>
    <div class="col-lg-6">        <div class="section-heading">
        <h2 class="text_head">Who We Are</h2>
        <p>We’re not just a web hosting company; we’re your friendly tech partner in the online world! Whether you are starting a blog or running an online store, we ensure that your website is fast, secure, and always up and running.

We believe hosting should be simple, reliable, and budget-friendly, which helps you grow your online presence stress-free because every business deserves a stable web home, and we are excited to support you throughout the journey!
</p>
        </div></div>
</div>
    </div>
</section>

<div class="about-main-div">

    <div class="container">

        <div class="about-div row cms">

            <div class="row">

                <div class="col-md-12">

                    <img src="{{ url('/') }}/assets/images/server2.svg" alt="We are always here to help you!" data-aos="fade-left" data-aos-delay="100">

                    <div data-aos="fade-left" data-aos-delay="300">

                        <h2 class="about-head aos-init" data-aos="fade-right" data-aos-delay="100">The <span class="green">{{ Config::get('Constant.SITE_NAME') }}</span> Story</h2>

                        <p class="about-text" data-aos="fade-right">They say, necessity is the mother of invention. Well, {{ Config::get('Constant.SITE_NAME') }} came into being, more or less in the same fashion. {{ Config::get('Constant.SITE_NAME') }} has its roots in a web development company, that started way back in 2006. The parent company offered to create websites for businesses, at a time, when the concept of 'Going Online' was pretty nascent. </p>

                        <p class="about-text">Over the years, clients begun to realise, having a website was not just about getting a website designed and developed. It begun way before that and extended way beyond that. They were faced with the challenge of reliable hosting. And so, there was this newly created demand - Why don't you do it all? </p>

                        <p class="about-text">Thus began the laying down of initial fibres of hosting. LIttle by little, one server after another, a lot of pitfalls, grilling frustration, learnings, in short, evolution, {{ Config::get('Constant.SITE_NAME') }} grew in number and nuances. Today, we have an entire fleet of servers, all set up locally, a team of nerdy experts that we could not have imagined functioning without, and over 5000+ happy clients.</p>

                        <p class="about-text">How did it all become this plush? We like to give the credit to our support team. From the day we attended to our first grievance, till date, the team has not let us down. Even now, we make the same age old promise - we use the latest tech stuff and offer round the clock support. So no matter how tiny the glitch, no matter how short the rectification time margin, we still make it a point to listen and attend to each one of those problems.</p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('template.hostadvice-award')

<div class="about-history">

    <div class="container">	

        <div class="about-history-text">

            <div class="line">

            </div>

            <div class="history-1">

                <div class="row">

                    <div class="col-md-6 col-7 history">

                        <div class="history-span justify-content-end">

                            <div class="aos-init" data-aos="fade-right" data-aos-delay="100" data-aos-easing="ease-out-back">

                                <div class="company-year">

                                    2018

                                </div>

                                <div class="company-month">

                                    JANUARY 

                                </div>

                                <div class="company-text">

                                   {{ Config::get('Constant.SITE_NAME') }} is now in partnership with Cpanel and Amazon Channel Partner with Amazon Web service is in the edge.

                                </div>

                            </div>

                            <div class="circle green" data-aos="zoom-in" data-aos-delay="100" data-aos-easing="ease-out-back">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6 col-5 history-image justify-content-start d-flex aos-init" data-aos="fade-left" data-aos-delay="100" data-aos-easing="ease-out-back">	

                        <div class="company-image">

                            <div class="thumbnail-container">

                                <div class="thumbnail">

                                    <img src="/assets/images/about_cpanel.webp" alt="2018"/>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="history-2">

                <div class="row flex-row-reverse flex-md-row">	

                    <div class="col-md-6 col-5 history-image justify-content-end d-flex aos-init" data-aos="fade-right" data-aos-delay="150" data-aos-easing="ease-out-back">

                        <div class="company-image">

                            <div class="thumbnail-container">

                                <div class="thumbnail">

                                    <img src="/assets/images/about_cloudlinux.webp" alt="2017"/>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6 col-7 history">

                        <div class="history-span justify-content-start">

                            <div class="aos-init" data-aos="fade-left" data-aos-delay="150">

                                <div class="company-year">2017</div>

                                <div class="company-month">DECEMBER </div>

                                <div class="company-text">CloudLinux has announced the partnership with {{ Config::get('Constant.SITE_NAME') }}, a Linux Operating System for hosting providers.</div>

                            </div>

                            <div class="circle blue" data-aos="zoom-in" data-aos-delay="150" data-aos-easing="ease-out-back"></div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="history-1">

                <div class="row">

                    <div class="col-md-6 col-7 history">

                        <div class="history-span">

                            <div class="aos-init" data-aos="fade-right" data-aos-delay="200" data-aos-easing="ease-out-back">

                                <div class="company-year">

                                    2016

                                </div>

                                <div class="company-month">

                                    NOVEMBER  

                                </div>

                                <div class="company-text">

                                   We became an official ICANN Accredited registrar a major stepping stone in the company's development

                                </div>

                            </div>

                            <div class="circle orange" data-aos="zoom-in" data-aos-delay="200" data-aos-easing="ease-out-back">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6 col-5 history-image aos-init" data-aos="fade-left"data-aos-delay="200" data-aos-easing="ease-out-back">	

                        <div class="company-image">

                            <div class="thumbnail-container">

                                <div class="thumbnail">

                                    <img src="/assets/images/about_icann.webp" alt="2016"/>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="history-2">

                <div class="row flex-row-reverse flex-md-row">	

                    <div class="col-md-6 col-5 history-image justify-content-end d-flex aos-init" data-aos="fade-right" data-aos-delay="250" data-aos-easing="ease-out-back">

                        <div class="company-image">

                            <div class="thumbnail-container">

                                <div class="thumbnail">

                                    <img src="/assets/images/about_partners_microsoft.webp" alt="2015"/>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6 col-7 history">

                        <div class="history-span justify-content-start">

                            <div class="aos-init" data-aos="fade-left" data-aos-delay="250" data-aos-easing="ease-out-back">

                                <div class="company-year">2015</div>

                                <div class="company-month">December  </div>

                                <div class="company-text">Partnership with Microsoft silver application development, this has bundled a comprehensive, smart and secure solution for staying empowered.</div>

                            </div>

                            <div class="circle green" data-aos="zoom-in" data-aos-delay="250" data-aos-easing="ease-out-back"></div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="history-1 d-flex justify-content-center">

                <div class="align-self-center">

                    <div class="row">

                        <div class="col-md-6 col-7 history">

                            <div class="history-span">

                                <div class="aos-init" data-aos="fade-right" data-aos-delay="300" data-aos-easing="ease-out-back">

                                    <div class="company-year">

                                        2014

                                    </div>

                                    <div class="company-month">

                                        January  

                                    </div>

                                    <div class="company-text">

                                        We have set-up our new office in Ahmedabad with technical support team of 50+ employees.

                                    </div>

                                </div>

                                <div class="circle blue" data-aos="zoom-in" data-aos-delay="300" data-aos-easing="ease-out-back">

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 col-5 history-image aos-init" data-aos="fade-left" data-aos-delay="300" data-aos-easing="ease-out-back">	

                            <div class="company-image">

                                <div class="thumbnail-container">

                                    <div class="thumbnail">

                                        <img src="/assets/images/logo.webp" alt="2014"/>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="history-2 d-flex justify-content-center">

                <div class="align-self-center">

                    <div class="row flex-row-reverse flex-md-row">	

                        <div class="col-md-6 col-5 history-image justify-content-end d-flex aos-init" data-aos="fade-right" data-aos-delay="350" data-aos-easing="ease-out-back">

                            <div class="company-image">

                                <div class="thumbnail-container">

                                    <div class="thumbnail">

                                        <img src="/assets/images/about_google_partner.webp" alt="2013"/>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 col-7 history">

                            <div class="history-span justify-content-start">	

                                <div class="aos-init" data-aos="fade-left" data-aos-delay="350" data-aos-easing="ease-out-back">

                                    <div class="company-year">2013</div>

                                    <div class="company-month">NOVEMBER</div>

                                    <div class="company-text">{{ Config::get('Constant.SITE_NAME') }} became authorised Google Partner,We transformed the working by introducing Professional business tool like email, cloud storage, meetup and more.</div>

                                </div>

                                <div class="circle orange" data-aos="zoom-in" data-aos-delay="350" data-aos-easing="ease-out-back"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="history-1 d-flex justify-content-center">

                <div class="align-self-center">

                    <div class="row">

                        <div class="col-md-6 col-7 history">

                            <div class="history-span">

                                <div class="aos-init" data-aos="fade-right" data-aos-delay="400" data-aos-easing="ease-out-back">

                                    <div class="company-year">

                                        2012

                                    </div>

                                    <div class="company-month">

                                        APRIL

                                    </div>

                                    <div class="company-text">

                                        {{ Config::get('Constant.SITE_NAME') }} was founded with the aim of providing domain and technology loaded Web Hosting service.

                                    </div>

                                </div>

                                <div class="circle green" data-aos="zoom-in" data-aos-delay="400" data-aos-easing="ease-out-back">

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 col-5 history-image aos-init" data-aos="fade-left" data-aos-delay="400" data-aos-easing="ease-out-back">	

                            <div class="company-image">

                                <div class="thumbnail-container">

                                    <div class="thumbnail">

                                        <img src="/assets/images/logo.webp" alt="2012"/>

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


<div class="about-features">

    <div class="container">

        <div class="">

            <div class="company-status">

                <div class="row">

                    <div class="col-sm-3 col-6 d-flex justify-content-center">

                        <div class="status-1 align-self-center">

                            <div class="s-icon s-hosting aos-init" data-aos="zoom-in" data-aos-delay="100"></div>

                            <div class="s-text"><div class="counter-value" data-count="4279">100</div><span class="plus-icon1">+</span></div>

                            <div class="s-content">Hosting</div>

                        </div>

                    </div>

                    <div class="col-sm-3 col-6 d-flex justify-content-center">

                        <div class="status-1 align-self-center">

                            <div class="s-icon s-domain aos-init" data-aos="zoom-in" data-aos-delay="300"></div>

                            <div class="s-text"><div class="counter-value" data-count="5777">1000</div><span class="plus-icon1">+</span></div>

                            <div class="s-content">Domain</div>

                        </div>

                    </div>

                    <div class="col-sm-3 col-6 d-flex justify-content-center">

                        <div class="status-1 align-self-center">

                            <div class="s-icon s-signups aos-init" data-aos="zoom-in" data-aos-delay="500"></div>

                            <div class="s-text"><div class="counter-value" data-count="2000">400</div><span class="plus-icon1">+</span></div>

                            <div class="s-content">New Signups</div>

                        </div>

                    </div>

                    <div class="col-sm-3 col-6 d-flex justify-content-center">

                        <div class="status-1 align-self-center">

                            <div class="s-icon s-worldwide aos-init" data-aos="zoom-in" data-aos-delay="700"></div>

                            <div class="s-text"><div class="counter-value" data-count="100000">90000</div><span class="plus-icon1">+</span></div>

                            <div class="s-content">Client Worldwide</div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="about-support">	

    <div class="container">

        <div class="row">	

            <div class="col-sm-4 col-12">

                <div class="support-time" data-aos="fade-right">

                    <i class="support-icon support-icon1"></i>

                    <span class="small-text">Call Us</span>

                    <a class="b-text" href="tel:{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}">{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}</a>

                </div>

            </div>

            <div class="col-sm-4 col-12">

                <div class="support-time" data-aos="zoom-in">

                    <i class="support-icon support-icon2"></i>

                    <span class="small-text">Chat with our</span>

                    <span class="b-text">Hosting Experts</span>

                </div>

            </div>

            <div class="col-sm-4 col-12">	

                <div class="support-time" data-aos="fade-left">

                    <i class="support-icon support-icon3"></i>

                    <span class="small-text">Email to our</span>

                    <span class="b-text">Support Team</span>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="{{ url('/') }}/assets/js/counter.js?v={{date('YmdHi')}}"></script>

@endsection