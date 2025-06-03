<?php 
$themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; 
$META_TITLE = $ProductData['META_TITLE'];
$META_KEYWORD = $ProductData['META_KEYWORD'];
$META_DESCRIPTION = $ProductData['META_DESCRIPTION'];
?>
@php 
$ProductId = $ProductData['ProductId'];
$bannerData =  $ProductData['bannerData'];
$FaqData = $ProductData['FaqData'];
@endphp
@extends('layouts.app')
@section('content')
@include('template.'.$themeversion.'.banner')
<div class="vps_main linux-main head-tb-p-40" id="pricing-google-workspace">
    <div class="vps-plan-main-div web-site-build-container windows-main" >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="section-heading">
                        <h2 class="text_head text-center" id="landingloc">Find the Perfect India’s Google Workspace Plan<br> For Your Business Needs</h2>
                        <!-- <span class="text-right"><small>*Offer Valid for the first 20 users for 12 months</small></span> -->
                      
                    </div>
                </div>
                        <div class=" text-center g-apps-pln-titl-box"><small>*Offer Valid for the first 20 users for 12 months</small></div>
                      
                <!-- //col-sm-6 col-md-6 col-lg-4 col-xs-12 -->
                @foreach($ProductData['ProductsPackageData'] as $product)
                    <div class="col-lg-3 col-md-6 col-sm-12" id="{{ $product->varTitle }}_three_div"> 
                        <div class="shared-plan-box">
                            <div class="shared_plan_price">
                                <div class="shared-plan-head">{{$product->varTitle}}
                                </div>
                                <!-- <div class="shared-plan-cut-price">
                                    <span class="shared-cut-price" id="{{ $product->varTitle }}OneYearINR">{!! Config::get('Constant.sys_currency_symbol') !!}100.10</span>
                                    <span class="shared-offer-discount" id="{{ $product->varTitle }}OneYearOffer">
                                        80% OFF
                                    </span>
                                </div> -->
                                <!-- <span class="mt-1">
                                       <b>Only For</b>
                                    </span> -->
                            </div>
                            <div class="shared-price-padding">
                                <div class="shared-main-price clearfix">
                                    <span class="shared-main-price-tittle" id="{{ $product->varTitle }}OneYearWhmcs">
                                        <span class="shared-price-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="shared-price-main">{{$product->productpricing['annually']}}</span>/mo*
                                    </span>
                                </div>
                                <div class="shared-plan-btm" id="{{ $product->varTitle }}OneYearButtonText">
                                    {!!$product->ButtonTextannually!!}
                                    {{-- <button class="shared-hstg-plan-btn" title="Buy Now" >Buy Now</button> --}}
                                    <!-- <a class="shared-hstg-plan-btn" href="#google_contact_form" title="Get Quote">Get Quote</a> -->
                                </div>
                                @php 
                                    $SpecificationData = explode("\n", $product->txtSpecification); 
                                @endphp
                                <div class="product-box">
                                    <ul class="shared-plan-features shared-plan-tooltip">
                                        @foreach($SpecificationData as $key => $Specification)
                                        <!-- <div class="slide-toggle {{ $key >= 5 ? 'hidden-spec' : '' }}"> -->
                                            <li><span>{{$Specification}}</span></li>
                                        <!-- </div> -->
                                        @endforeach
                                    </ul>
                                    <a href="#allFeaturesTable" title="See More Features" class="more-features shared_plan_more_btn">See More Features</a>

                                    <!-- See More/See Less Button -->
                                    <!-- @if($key > 5) -->
                                    <!-- <a href="javascript:void(0);" title="See More Features" class="more-features shared_plan_more_btn" data-id="{{ $loop->index }}" id="seeMoreBtn{{ $loop->index }}">See More Features</a> -->
                                    <!-- @endif -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach        
                <div class="g-apps-pln-nt">
                <small class="mb-1">*Business Starter, Business Standard, and Business Plus plans can be purchased for up to 20 users.
                </small><small class="mb-1">*This offer is available to new Google Workspace customers only. The introductory price applies for 12 months and is valid for the first 20 users added. Standard pricing will apply to all users after 12 months.
                </small><small class="mb-1">*For offers applicable to more than 20 users, please contact our Sales Team.
                </small><small>*Taxes are extra as applicable.</small>
                </div>        
            </div>
        </div>
    </div>
</div>
<div class="dy-money-back-grnt head-tb-p-40 g-apps-features-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dy-money-back-grnt-box text-center">
                            <h2 class="text_head text-center">Need Workspace for 20+ Users?</h2>
                            <p>Get the best Google Workspace pricing in India!</p>
                            <a href="#google_contact_form" title="Request your quote">Request Your Quote</a>
                        </div>
                    </div>
                </div>
            </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        // Initially hide specifications over the 5th one for each product box
        $('.product-box').each(function() {
            $(this).find('.hidden-spec').hide();
        });

        // See More / See Less functionality for each product box
        $('.shared_plan_more_btn').click(function() {
            var button = $(this);
            var productBox = button.closest('.product-box');
            var text = button.text();

            if (text === 'See More Features') {
                // Show hidden specifications only in this product box
                productBox.find('.hidden-spec').slideDown();
                button.text('See Less Features');
            } else {
                // Hide extra specifications only in this product box
                productBox.find('.hidden-spec').slideUp();
                button.text('See More Features');
            }
        });
    });
</script>
<div class="g-apps-features-box head-tb-p-40" id="allFeaturesTable">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Google Workspace Features to Watch For</h2>
            <!-- <p class="text-center">From Easy document creation to efficient communication, Discover a comprehensive suite of powerful apps within Google Workspace for businesses. This suite is designed for seamless collaboration and productivity with teams across devices.</p> -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="g-apps-tbl table-responsive">
                    <table class="table g-apps-ftrs-tbl table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">Features</th>
                                <th class="text-center" scope="col">Business Starter <span>INR 1920.00* / User / Year</span></th>
                                <th class="text-center" scope="col">Business Standard <span>INR 10260.00* / User / Year</span></th>
                                <th class="text-center" scope="col">Business Plus <span>INR 20100.00* / User / Year</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="gmail-icon-main">
                                    <div class="gmail-icon">
                                        <!-- <img src="../assets/img/google_workspace/gmail-icon.png" alt=""></div> -->
                                        Gmail business email
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Custom email for your business
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Phishing and spam protection that blocks more than 99.9% of attacks
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Ad-free email experience
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th>Meet Video and voice conferencing</th>
                                <td>100 Participants</td>
                                <td>150 Participants</td>
                                <td>500 Participants</td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Meeting length (maximum)
                                </th>
                                <td>24 Hours</td>
                                <td>24 Hours</td>
                                <td>24 Hours</td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> US or international dial-in phone numbers
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Digital whiteboarding
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Noise cancellation
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Meeting recordings saved to Google Drive
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Polling and Q&A
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Moderation controls
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Hand raising
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Breakout rooms
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Attendance tracking
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> In-domain live streaming
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-minus"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_01" class="show-more-btn">Show More<i class="fa-solid fa-chevron-down"></i></button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th class="gmail-icon-main">
                                    <div class="gmail-icon">
                                        <!-- <img src="../assets/img/google_workspace/gmail-icon.png" alt=""></div> -->
                                        Drive Secure cloud storage
                                </th>
                                <td>30 GB per user</td>
                                <td>2 TB per user</td>
                                <td>5 TB per user</td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Drive for desktop
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="second-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Support for over 100 file types
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="second-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Shared drives for your team
                                </th>
                                <td>Fundamental</td>
                                <td>Advanced</td>
                                <td>Advanced</td>
                            </tr>
                            <tr class="second-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Target audience sharing
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_02" class="show-more-btn">Show More<i class="fa-solid fa-chevron-down"></i></button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th class="gmail-icon-main">
                                    <div class="gmail-icon">
                                        <!-- <img src="../assets/img/google_workspace/gmail-icon.png" alt=""></div> -->
                                        Chat Team messaging
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Turn history on or off by default
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Auto-accept invitations
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="third-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> One-to-one external chat
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="third-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Advanced chat rooms, including threaded rooms and guest access
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_03" class="show-more-btn">Show More<i class="fa-solid fa-chevron-down"></i></button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th class="gmail-icon-main">
                                    <div class="gmail-icon">
                                        <!-- <img src="../assets/img/google_workspace/gmail-icon.png" alt=""></div> -->
                                        Calendar Shared calendars
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Appointment booking pages
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Browse and reserve conference rooms
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th class="gmail-icon-main">
                                    <div class="gmail-icon">
                                        <!-- <img src="../assets/img/google_workspace/gmail-icon.png" alt=""></div> -->
                                        Docs, Sheets, Slides Collaborative content creation
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Keep shared notes
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Sites website builder
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="gmail-icon-main">
                                    <div class="gmail-icon">
                                        <!-- <img src="../assets/img/google_workspace/gmail-icon.png" alt=""></div> -->
                                        Forms survey builder
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Interoperability with Office files
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Easier analysis with Smart Fill, Smart Cleanup and answers
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="fourth-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Writing assistance with Smart Compose, grammar suggestions and spelling auto-correct
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="fourth-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Connected sheets
                                </th>
                                <td>Fundamental</td>
                                <td>Fundamental</td>
                                <td>Fundamental</td>
                            </tr>
                            <tr class="fourth-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Custom branding for document and form templates
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_04" class="show-more-btn">Show More<i class="fa-solid fa-chevron-down"></i></button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th class="gmail-icon-main">
                                    <div class="gmail-icon">
                                        <!-- <img src="../assets/img/google_workspace/gmail-icon.png" alt=""></div> -->
                                        AppSheet Build apps without code
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- g-apps features section end -->
<div class="gapps-panel-avail-box head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Why Google Workspace?</h2>
            <p class="text-center">Know how Google Workspace makes your life easier with amazing tools to manage your business smoothly.</p>
        </div>
        <div class="row align-items-center">
            <div class="col-12 col-sm-4 col-lg-4">
                <div class="gapps-pnl-avl-left">
                    <div class="nav flex-column nav-pills justify-content-between" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="gapps-pnl-btn active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Your All-in-One Email and Workspace Solution!</button>
                        <button class="gapps-pnl-btn" id="v-pills-admin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-admin" type="button" role="tab" aria-controls="v-pills-admin" aria-selected="false">Empowering Your Business Anytime, Anywhere!</button>
                        <button class="gapps-pnl-btn" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Powering your business growth with Google Workspace!</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-lg-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="gapps-pnl-ul">
                            <p class="gapps-pnl-cnt">
                                <span>Get professional with Gmail</span>
                                Just ditch the old @gmail.com and use your domain, like you@yourcompany.com, to create a strong first impression and add credibility to your communication amongst your clients.
                            </p>
                            <p class="gapps-pnl-cnt">
                                <span>Smarter Communication on the Go</span>
                                Gmail lets you chat and mail on the move, but Google Workspace makes you smarter. With this, you will get a custom email ID, and all tools (Gmail, Meet, Chat) will work smoothly under your brand.
                            </p>
                            <p class="gapps-pnl-cnt">
                                <span>Collaboration Made Easy</span>
                                Google Workspace gives you everything Gmail has with amazing advanced tools made for teams. You will get Shared Drives that belong to the team (not just one person), so files stay even if someone leaves. You can also use smart suggestions in Docs with workspace. 
                            </p>
                            <p class="gapps-pnl-cnt">
                                <span>For Boosting Productivity</span>
                                Google Workspace takes productivity to the next level by providing you with professional tools like custom email domains, enhanced storage, and seamless collaboration to work together on Docs, Sheets, and Slides in real time, making teamwork smoother.
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-admin" role="tabpanel" aria-labelledby="v-pills-admin-tab">
                        <div class="gapps-pnl-ul">
                            <p class="gapps-pnl-cnt">
                                <span>Easy Accessibility</span>
                                As mentioned above, purchasing Google Workspace takes it a step further by giving you easy access to a whole suite of tools, including Google Drive, Docs, Sheets, Meet, and Calendar, all in one place to help teams collaborate smoothly.
                            </p>
                            <p class="gapps-pnl-cnt">
                                <span>For Better Security</span>
                                Google Workspace ensures your data is always protected with advanced security features like 2-factor authentication and encryption. These features lock your information behind strong security measures, keeping it safe from unauthorized access and giving you peace of mind. 
                            <p class="gapps-pnl-cnt">
                                <span>AI-Powered Workflow Optimization</span>
                                Google Workspace allows you to use the latest AI and machine learning tools, like Gemini AI, to improve your work processes, which helps you stay ahead by adapting to your needs and evolving with time to make your workflow smarter and more efficient.
                            </p>
                            <p class="gapps-pnl-cnt">
                                <span>More Storage Management</span>
                                Google Workspace plans offer more storage, so you don’t have to worry about space running out. All your emails, files, and data stay safely stored and are easy to access, helping your team stay organized and work without limits.
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="gapps-pnl-ul">
                            <p class="gapps-pnl-cnt">
                                <span>Scalability</span>
                                Whether you are a team of 5 or 500, with Google Workspace plans, you can grow. You can start small and add users, storage, or features anytime without switching platforms to keep your workflow smoother. 
                            </p>
                            <p class="gapps-pnl-cnt">
                                <span>Smart Search</span>
                                Locating important information shouldn't be an issue with Google's powerful search capabilities. You can grab your emails, files, calendar schedules, notes, and contacts with a few clicks with feature-packed apps when you buy Google Workspace email solutions.
                            </p>
                            <p class="gapps-pnl-cnt">
                                <span>Eco-friendly</span>
                                Google Workspace runs on Google’s energy-efficient cloud, which uses renewable energy to power its data centers, which means every email you send or file you save creates less carbon impact than traditional IT systems.
                            </p>
                            <p class="gapps-pnl-cnt">
                                <span>Easy Administration</span>
                                Google presents a convenient admin console that helps streamline your IT operations by overseeing user accounts, settings, and security from a single location. Explore the various Google Workspace Plans in India to enhance your organizational and technical efficiency.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pwrfl-apps-wrkspc head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">
                Check Out a Suite of Powerful Apps From Google Workspace
            </h2>
            <p class="text-center">
                From Easy document creation to efficient communication, discover a comprehensive suite of powerful apps within Google workspace designed for seamless collaboration and productivity for businesses.
            </p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="powerfull-apps-img">
                    <img src="/assets/img/google_workspace/powerfull-apps-img.webp" alt="powerfull-apps-img">
                </div>
            </div>
        </div>
    </div>
</div>


<section class="disc-full-power head-tb-p-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="disc-full-power-img">
                    <img loading="lazy" src="/assets/img/google_workspace/g-apps-wrk-accrdn-2.webp" alt="When_to_Choose_Windows_VPS">
                </div>
            </div>
            <div class="col-lg-5">
                <div id="accordion-container" class="accordion why-g-apps-workspace">
                    <div class="section-heading disc-power-head">
                        <h2 class="text_head">Why Host IT Smart For Google Workspace?</h2>
                        <p class="text-center">Apart from the best Google Workspace pricing in India, know what else you can expect from us!</p>
                    </div>
                    <div id="accordion-box" class="accordion why-g-apps-workspace">
                        <div class="card mb-3 g-apps-wrk-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box0" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Expert Guidance From Team to Boost Your Business </h3>
                            </a>
                            <div id="box0" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>At Host IT Smart, our team of Google Workspace experts is always available to guide you. We can help you set up and optimize your tools, ensuring that everything runs smoothly so you can focus on growing your business.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 g-apps-wrk-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box1" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Local Tech Support You Can Trust</h3>
                            </a>
                            <div id="box1" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>At Host IT Smart, you will get reliable tech support from our dedicated team based right here in India. So whether you are facing a minor glitch or need detailed assistance, we are just a call away! Our team ensures you understand everything clearly, offering help in your local language for a smooth experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 g-apps-wrk-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box2" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Always Happy to Help You</h3>
                            </a>
                            <div id="box2" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>At Host IT Smart, we are always here for you, day or night. Our team is ready 24/7 to assist you with any questions or issues related to Google Workspace. So, you can count on us to ensure everything runs smoothly, no matter what!</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 g-apps-wrk-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box3" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Migrated 500+ Companies to Google Workspace Globally</h3>
                            </a>
                            <div id="box3" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>At Host IT Smart, we have helped over 500 companies worldwide migrate to Google Workspace smoothly and effortlessly. So, whether you are a small startup or a growing enterprise, our expert team ensures a flawless migration process.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 g-apps-wrk-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box4" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Delivering Value and Quality With Our Affordable Pricing</h3>
                            </a>
                            <div id="box4" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>At Host IT Smart, great tools shouldn’t have a hefty price tag. That’s why our Google Workspace plans in india are priced to fit every budget without cutting corners on features or support. Whether a small startup or a growing business, you’ll get top-notch value at a smart price.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 g-apps-wrk-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box5" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Smooth On-Demand Migration</h3>
                            </a>
                            <div id="box5" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>If you are switching to Google Workspace, we move your email and data easily with no stress and no downtime. Just tell us when, and we will handle the migration smoothly while you continue working.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 g-apps-wrk-card">
                            <a class="card-header collapsed" data-bs-toggle="collapse" href="#box6" aria-expanded="false">
                                <h3 class="mb-0 d-inline-block faqs-span">Enhanced Security For Peace of Mind</h3>
                            </a>
                            <div id="box6" class="collapse" data-bs-parent="#accordion-box">
                                <div class="card-body white-bg">
                                    <p>Host IT Smart provides strong security features and advanced tools with Google Workspace, which offers you full control and protection to protect your data.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('template.'.$themeversion.'.support_section_home')

 <div class="g-apps-cont-us head-tb-p-40" id="google_contact_form">
    <div class="container">
        <div class="g-apps-cont-main">
            <div class="row">
                <div class="col-lg-4">
                    <div class="cont-us-cnt">
                        <div class="section-heading">
                            <h2 class="text_head">Get in Touch</h2>
                            <p>Say Hello to Smarter Workdays!</p>
                        </div>
                        <div class="cont-us-cnt-img">
                            <img src="/assets/img/google_workspace/cont-us-img.webp" alt="cont-us-img">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8"> 
                    <div class="cont-us-cnt-rgt">
                        {!! Form::open(['method' => 'post','class'=>'contact-us-form123']) !!}
                            {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="name" class="form-label">Name*</label>
                                    {!! Form::text('name', old('name') , array('id' => 'name', 'class' => 'form-control' , 'placeholder' => 'Enter Name')) !!}
                                    @if ($errors->has('name'))
                                    <span class="error">
                                        {{ $errors->first('name') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label for="email" class="form-label">Work Email*</label>
                                    {!! Form::text('email', old('email') , array('id' => 'email', 'class' => 'form-control' , 'placeholder' => 'Enter Email')) !!}
                                    @if ($errors->has('email'))
                                    <span class="error">
                                        {{ $errors->first('email') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label for="companyname" class="form-label">Company Name*</label>
                                    {!! Form::text('companyname', old('companyname') , array('id' => 'companyname', 'class' => 'form-control' , 'placeholder' => 'Company Name')) !!}
                                    @if ($errors->has('companyname'))
                                    <span class="error">
                                        {{ $errors->first('companyname') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label for="domain" class="form-label">Domain*</label>
                                    {!! Form::text('domain', old('domain') , array('id' => 'domain', 'class' => 'form-control' , 'placeholder' => 'Enter Domain')) !!}
                                    @if ($errors->has('domain'))
                                    <span class="error">
                                        {{ $errors->first('domain') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-3">
                                    <label for="countryCodeSelect" class="form-label">Phone Number*</label>
                                    @php 
                                        $countryOptions = []; 
                                        $defaultCountry = '+91'; // Default to India (country code +91)
                                        
                                        foreach($countryDialingCode as $key => $itm) {
                                            // Use the country dialing code as the key (with '+' prefix)
                                            $countryOptions['+' . $itm['ccode']] = $itm['cname'];
                                        }
                                    @endphp
                                    {!! Form::select('country_code', $countryOptions, $defaultCountry, [
                                        'class' => 'form-select', 
                                        'id' => 'countryCodeSelect', 
                                        'required' => 'required'
                                    ]) !!}
                                </div>
                                <div class="col-lg-4 d-flex align-items-end">
                                    {!! Form::tel('phone_number', old('phone_number') , array('id' => 'phoneNumber', 'class' => 'form-control', 'maxlength'=>"20", 'value' => "+93",'onpaste'=>'return false;','ondrop'=>'return false;', 'onkeypress'=>'javascript: return KeycheckOnlyPhonenumber(event);', 'placeholder' => 'Enter Phone Number')) !!}
                                    <span id="phoneError" class="error" style="display: none;"></span>
                                </div>
                                <div class="col-lg-5">
                                    <label for="licenses_no" class="form-label">No. of Licenses Required*</label>
                                    {!! Form::text('licenses_no', old('licenses_no') , array('id' => 'licenses_no', 'class' => 'form-control' , 'placeholder' => 'No. of Licenses Required')) !!}
                                    @if ($errors->has('licenses_no'))
                                    <span class="error phone_error">
                                        {{ $errors->first('licenses_no') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                                    {!! Form::textarea('message', old('message') , array( 'class' => 'form-control', 'cols' => '40', 'rows' => '3', 'id' => 'message', 'spellcheck' => 'true' )) !!}
                                </div>
                                <div class="col-sm-12 form-group mt-2">
                                    <div id="gform" class="g-recaptchas" data-sitekey="{{ Config::get('Constant.GOOGLE_CAPCHA_KEY') }}" data-callback="check_captcha_g"></div>                                    
                                </div>
                                   @if ($errors->has('g-recaptcha-response'))
                                    <span class="error">
                                        {{ $errors->first('g-recaptcha-response') }}
                                    </span>
                                   @endif
                                <div class="col-12 text-center">
                                    <button class="g-apps-submit-btn" type="submit">Submit</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div> 

@include('template.'.$themeversion.'.faq-section')

@if(isset($ProductData['FeaturedProductsData']))
@php $FeaturedProductsData = $ProductData['FeaturedProductsData'];  @endphp

@include('template.'.$themeversion.'.two-hosting-add')
@endif

<script>

     var contactCaptchaWidgetId;
var onloadCallbackGoogleContactForm = function() {
    contactCaptchaWidgetId = grecaptcha.render('gform', {
        'sitekey': '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}',
        'callback': check_captcha_g
    });
};

        function check_captcha_g() { $('.contact-us-form123').valid(); }

        setTimeout(function() { $.getScript("https://www.google.com/recaptcha/api.js?onload=onloadCallbackGoogleContactForm&render=explicit"); },5000);    
            
        function loadRecaptchaScriptG() {
            var script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?onload=onloadCallbackGoogleContactForm&render=explicit';
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }

        // Load the reCAPTCHA script immediately
        loadRecaptchaScriptG(); 

    document.addEventListener("DOMContentLoaded", function () {

        // Select the form
        const form = document.querySelector('.contact-us-form123');

        form.addEventListener("submit", function (e) {
            // Prevent form submission for validation

            e.preventDefault();
            
            let isValid = true;

              const captchaResponse = grecaptcha.getResponse(contactCaptchaWidgetId);
        if (captchaResponse === '') {
            console.log(123);
            displayError(document.getElementById('gform'), "Captcha is required.");
            isValid = false;
        } else {
            removeError(document.getElementById('gform'));
        }

            // Validate Name
            const name = document.getElementById("name");
            const namePattern = /^[a-zA-Z\s'-]{2,50}$/;
            if (name.value.trim() === "") {
                displayError(name, "Name is required.");
                isValid = false;
            } else if (!namePattern.test(name.value.trim())) {
                displayError(name, "Enter valid input.");
                isValid = false;
            }else {
                removeError(name);
            }

            // Validate Email
            const email = document.getElementById("email");
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (email.value.trim() === "") {
                displayError(email, "Email is required.");
                isValid = false;
            } else if (!emailPattern.test(email.value)) {
                displayError(email, "Enter a valid email address.");
                isValid = false;
            } else {
                removeError(email);
            }

            // Validate Company Name
            const companyname = document.getElementById("companyname");
            const companyNamePattern = /^[a-zA-Z0-9&\s'-]{2,100}$/; //letters, numbers, spaces, hyphens, and ampersands
            if (companyname.value.trim() === "") {
                displayError(companyname, "Company name is required.");
                isValid = false;
            }  else if (!companyNamePattern.test(companyname.value.trim())) {
                displayError(companyname, "Enter valid input.");
                isValid = false;
            } else {
                removeError(companyname);
            }

            // Validate Message
            const message = document.getElementById("message");
            const messagePattern = /^[a-zA-Z0-9\s.,_'!?;:@#%&()\-\*]*$/;
           if (!messagePattern.test(message.value.trim())) {
                displayError(message, "Enter valid input.");
                isValid = false;
            } else {
                removeError(message);
            }

            // Validate Domain
            const domain = document.getElementById("domain");
            const domainPattern = /^(?!:\/\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,6}(\.[a-zA-Z]{2,6})?$/;
            if (domain.value.trim() === "") {
                displayError(domain, "Domain is required.");
                isValid = false;
            } else if (!domainPattern.test(domain.value)) {
                displayError(domain, "Enter a valid domain (e.g., xyz.com or xyz.co.in).");
                isValid = false;
            } else {
                removeError(domain);
            }

            // Validate Phone Number
              const phoneNumber = document.getElementById("phoneNumber");
            const phoneError = document.getElementById("phoneError"); // Get the error span
            const phonePattern = /^\+?[1-9][0-9\s-]{6,19}$/;
            if (!phonePattern.test(phoneNumber.value)) {
                phoneError.style.display = 'block'; // Show the error message
                phoneError.className = "error phone_error"; // Set the error class
                phoneError.textContent = "Enter a valid phone number."; // Set the error message text
                isValid = false;
            } else {
                phoneError.style.display = 'none'; // Hide the error message if valid
                phoneError.textContent = ''; // Clear the text
            }

            // Validate Licenses Number
            const licensesNo = document.getElementById("licenses_no");
            const licensesPattern = /^[1-9][0-9]*$/;
            if (licensesNo.value.trim() === "" || isNaN(licensesNo.value) || licensesNo.value <= 0) {
                displayError(licensesNo, "Enter a valid number of licenses.");
                isValid = false;
            } else if (!licensesPattern.test(licensesNo.value.trim())) {
                displayError(licensesNo, "Enter a valid positive number of licenses.");
                isValid = false;
            } else {
                removeError(licensesNo);
            }

            // If all validations pass, submit the form
            if (isValid) {                
                form.submit();
            }
        });

    // Function to display error
        function displayError(element, message) {
            let errorSpan = element.parentNode.querySelector(".error");
            if (!errorSpan) {
                errorSpan = document.createElement("span");
                errorSpan.className = "error";
                if (element.id === 'gform') {
             errorSpan.classList.add("mt-1");
            }
            if (element.id === 'message') {
             errorSpan.classList.add("mt-1");
             var captchaBox = document.getElementById('gform');
             captchaBox.classList.add('mt-4');
            }
                element.parentNode.appendChild(errorSpan);
            }
            errorSpan.textContent = message;
            element.classList.add("is-invalid");
        }

        // Function to remove error
        function removeError(element) {
            const errorSpan = element.parentNode.querySelector(".error");
            if (errorSpan) {
                errorSpan.remove();
            }
            element.classList.remove("is-invalid");
        }
    });
</script>

<script>
document.getElementById('countryCodeSelect').addEventListener('change', function() {
    // Get the selected option
    var selectedOption = this.options[this.selectedIndex];
    // Get the country code from data-code attribute
    var countryCode = selectedOption.getAttribute('data-code');
    if (countryCode.charAt(0) !== '+') {
        countryCode = '+' + countryCode;
    }
    // Update the phone number input with the new country code
    document.getElementById('phoneNumber').value = countryCode;
});
</script>
<script>
$(document).ready(function() {
    $("#showMoreBtn_01").click(function() {
        $(".first-rows").toggle(); // Toggle visibility of extra rows
        var buttonText = $("#showMoreBtn_01").text() === "Show More" ? "Show Less" : "Show More";
        $("#showMoreBtn_01").text(buttonText); // Change button text
    });
});
</script>
<script>
$(document).ready(function() {
    $("#showMoreBtn_02").click(function() {
        $(".second-rows").toggle(); // Toggle visibility of extra rows
        var buttonText = $("#showMoreBtn_02").text() === "Show More" ? "Show Less" : "Show More";
        $("#showMoreBtn_02").text(buttonText); // Change button text
    });
});
</script>
<script>
$(document).ready(function() {
    $("#showMoreBtn_03").click(function() {
        $(".third-rows").toggle(); // Toggle visibility of extra rows
        var buttonText = $("#showMoreBtn_03").text() === "Show More" ? "Show Less" : "Show More";
        $("#showMoreBtn_03").text(buttonText); // Change button text
    });
});
</script>
<script>
$(document).ready(function() {
    $("#showMoreBtn_04").click(function() {
        $(".fourth-rows").toggle(); // Toggle visibility of extra rows
        var buttonText = $("#showMoreBtn_04").text() === "Show More" ? "Show Less" : "Show More";
        $("#showMoreBtn_04").text(buttonText); // Change button text
    });
});
</script>
<script src="{{ url('assets/js/contact.js?v='.date('YmdHi')) }}"></script>
@endsection