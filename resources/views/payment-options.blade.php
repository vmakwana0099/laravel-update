@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
@if($CONTENT != '')
 <div class="inner_container cms">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                {!!$CONTENT!!}
            </div>
        </div>
    </div>
</div>
@endif
<div class="inner_container">
    <div class="payment-content">
        <div class="payment-opt">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <div class="right text-center">
                            <div class="icon aos-init" data-aos="fade-up" data-aos-delay="300">
                                <img src="{{ url('/') }}/assets/images/credit-cards.png" alt="Credit Cards" title="Credit Cards"/>
                            </div>
                            <div class="description aos-init" data-aos="fade-up" data-aos-delay="400">
                                <h2 class="text-center">Credit Cards</h2>
                                <p>You can pay us for purchase by using Visa, Mastercard, American Express Discover Card and Diners club International</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="right text-center">
                            <div class="icon aos-init" data-aos="fade-up" data-aos-delay="300">
                                <img src="{{ url('/') }}/assets/images/debit-card.png" alt="Debit Cards" title="Debit Cards"/>
                            </div>
                            <div class="description aos-init" data-aos="fade-up" data-aos-delay="400">
                                <h2 class="text-center">Debit Cards</h2>
                                <p>We accept Visa, Master, Rupay, Maestro, SBIPG debit card of all major banks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="right text-center">
                            <div class="icon aos-init" data-aos="fade-up" data-aos-delay="300">
                                <img src="{{ url('/') }}/assets/images/net-banking.png" alt="Net Banking" title="Net Banking"/>
                            </div>
                            <div class="description aos-init" data-aos="fade-up" data-aos-delay="400">
                                <h2 class="text-center">Net Banking</h2>
                                <p>You can also process payment by NetBanking we have affiliation with 40+ Banks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="left text-center">
                            <div class="icon aos-init" data-aos="fade-up" data-aos-delay="300">
                                <img src="{{ url('/') }}/assets/images/paypal-icon.png" alt="Paypal" title="Paypal"/>
                            </div>
                            <div class="description aos-init" data-aos="fade-up" data-aos-delay="400">
                                <h2 class="text-cente">Paypal</h2>
                                <p>Make payment faster and more securely in India and across the globe.</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="payment-methods">
                            <ul class="payment-icons-outter">
                                <li class="payment-icons pay-icon1 aos-init" data-aos="zoom-in" data-aos-delay="100"></li>
                                <li class="payment-icons pay-icon2 aos-init" data-aos="zoom-in" data-aos-delay="300"></li>
                                <li class="payment-icons pay-icon3 aos-init" data-aos="zoom-in" data-aos-delay="500"></li>
                                <li class="payment-icons pay-icon4 aos-init" data-aos="zoom-in" data-aos-delay="700"></li>
                                <li class="payment-icons pay-icon5 aos-init" data-aos="zoom-in" data-aos-delay="900"></li>
                                <li class="payment-icons pay-icon6 aos-init" data-aos="zoom-in" data-aos-delay="1100"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-features payment-about-features">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="cms">
                        <div class="title text-center">
                            <h2 class="aos-init" data-aos="fade-up" data-aos-delay="100">
                                See how company relies on {{ Config::get('Constant.SITE_NAME') }} services to process millions of secure transactions each month
                            </h2>
                            <p class="aos-init" data-aos="fade-up" data-aos-delay="200">Budget-friendly, quick, headache-free solution has made us stand out from the crowd and to build business of your dream.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
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
        </div>
        <div class="payment-support">	
            <div class="container">
                <div class="row">	
                    <div class="col-sm-4 col-12">
                        <div class="support-time" data-aos="fade-right">
                            <i class="support-icon support-icon1"></i>
                            <span class="small-text">Call Us</span>
                            <span class="b-text">{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}<small>(24x7)</small></span>
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
    </div>
</div>
<script src="{{ url('/') }}/assets/js/counter.js"></script>
@endsection