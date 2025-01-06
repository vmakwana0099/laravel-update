@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{URL::to('/assets/css/vps-page-new.css?v='.date('YmdHi'))}}">
<div class="vps_main {{$ProductBanner->varBannerIconClass}}">
    @if (isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
    <link rel="stylesheet" href="{{URL::to('/assets/css/full-width-inner-banner.css')}}">
    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
    @include('template.'.$themeversion.'.banner')
    @else
    @if(!empty($ProductBanner) && count((array)$ProductBanner) >0)
    <div class="banner-inner hosting-banner 121-{{ $ProductBanner->id }}" style="background-image:url('{!! App\Helpers\resize_image::resize($ProductBanner->fkIntImgId,1920,494) !!}')">
        <div class="container">
            <div class="banner-content">
                <div class="banner-image" data-aos="zoom-in" data-aos-delay="100"></div>
                <div class="banner-title" data-aos="fade-up" data-aos-delay="200">{{$ProductBanner->varTitle}}</div>
                <span class="banner-subtitle" data-aos="fade-up" data-aos-delay="300">{!! $ProductBanner->varTagLine !!} </span>
                <span class="banner-text" data-aos="fade-up" data-aos-delay="400">{!! $ProductBanner->txtShortDescription !!}</span>
                @if(!empty($ProductBanner->VarBannerName1) && !empty($ProductBanner->VarBannerLink1) || !empty($ProductBanner->VarBannerName2) && !empty($ProductBanner->VarBannerLink2))
                <div class="banner-button" data-aos="fade-up" data-aos-delay="500">
                    @if(!empty($ProductBanner->VarBannerName1) && !empty($ProductBanner->VarBannerLink1))
                    <a class="btn-primary" title="{{$ProductBanner->VarBannerName1}}" href="{{$ProductBanner->VarBannerLink1}}">{{$ProductBanner->VarBannerName1}}</a>
                    @endif
                    @if(!empty($ProductBanner->VarBannerName2) && !empty($ProductBanner->VarBannerLink2))
                    <a class="btn-primary Click-to-Bottom" title="{{$ProductBanner->VarBannerName2}}" href="{{$ProductBanner->VarBannerLink2}}">{{$ProductBanner->VarBannerName2}}</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
    @endif
    <section class="linux_vps_plan head-tb-p-40" id="vps-hosting">
        <div class="section-heading">
            <h2 class="text_head text-center">Powerful VPS Hosting Solutions For You</h2>
            <p class="text_cnt text-center"> Choose Our Cheap VPS with KVM Virtualization for Ultimate Performance!</p>
        </div>
        <div class="container">
            <div class="row">
               @foreach ($ProductsPackageData as $elkey => $element)

@php
$planName = $element->varTitle;
$SpecificationData = explode("\n",$element->txtSpecification);
if ($element->txtShortDescription == 'BEST SELLER') {
$class_best_seller = 'best-seller-div';
}else{
$class_best_seller = ' ';
}
@endphp
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
    <div class="vps-plan-box" >
        <div class="vps_plan_price">
            <div class="plan-head">{{$planName}}</div>
            @if(Config::get('Constant.sys_currency') == 'INR')
            @if (isset($element->productpricing['monthly']) && isset($element->productpricing['annually']))
          <div class="plan-cut-price">
    <span class="cut-price" id="oneyear-sale-price{{str_replace(' ', '', $planName)}}">
        {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly']}}
    </span> 
    <span class="offer-discount" id="offer-discount-{{str_replace(' ', '', $planName)}}">
   Save {{$percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly']) * 100), 0)}}%
    </span>
          </div>
            <div class="plan-price-main" id="oneyear-price{{str_replace(' ', '', $planName)}}">
                
    <span class="plan-price-r-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$element->productpricing['annually']}}<span class="vps-prc-mo">/mo</span></div>
            @endif
             {{-- <div class="freedom-sale-offer">+15 Days Free</div> --}}
            <div class="vps-plan-conf-btn" id="oneyear-btn{{str_replace(' ', '', $planName)}}">
           {!! $element->ButtonTextannually !!}
        </div>
            @elseif(Config::get('Constant.sys_currency') == 'USD')
            @if (isset($element->productpricing['monthly']))
            <h2>{!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly']}}<span class="vps-prc-mo">/Mo</span></h2>
            @endif
            @endif
        </div>
        <div class="vps-plan-desc">
            <ul>
                @foreach ($SpecificationData as $key => $Specifica)
                @php
                $Specification = (trim($Specifica));
                @endphp
                
                @if(strtolower(trim($Specification)) == "control panel")
                    <li class="free_domain"><span class="vps-desc-icon"><i class="fa-solid fa-circle-check"></i></span>Control Panel <i class="fa-solid fa-circle-question"></i>
                                    <span class="domain_tooltip">Select your preferred control panel from cPanel, Webuzo, or Plesk. Choose the ideal panel for your specific operating system needs!</span></li>
                @else
                <li><span class="vps-desc-icon"><i class="fa-solid fa-circle-check"></i></span>{!!($Specification)!!}</li>
                @endif
                @endforeach
            </ul>
        </div>
      
    </div>
</div>
@endforeach
            </div>
        </div>
    </section>

    <!-- feature points section start -->
    <div class="dl-features-points">
        <div class="container">
            <div class="feature-start">
                <div class="section-heading">
                <h2 class="text-center text_head">Discover What You Can Expect With Our VPS Hosting</h2>
                </div>
                <div class="fp-list">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li>Enjoy Full Root Access</li>
                                <li>Secured data with Advanced Firewall Protection</li>                                
                                <li>Shield your systems with DDoS Protection</li>
                            </ul>
                        </div>
                        
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li>Connect seamlessly through a Private Network</li>
                                <li>1-Click Software Installations</li>
                                <li>Security using Custom Firewall Rules</li>
                                <li>Ensure reliability with Built-in Redundancy</li>                                
                            </ul>
                        </div>
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li>Boost performance with Optimized Storage</li>
                                <li>Experience Ultra Low Latency</li>
                                <li>Operations with Enterprise-Grade Hardware</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature points section end -->

    @include('template.'.$themeversion.'.30-day-moneyback') 

    <div class="g-suite-lists head-tb-p-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-heading">
                                <h2 class="text_head text-center">Why VPS Hosting is the Perfect Choice <br> For Your Business Needs? </h2>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">1</span>
                                        <h4>Exclusive Resources, Just for You:</h4>
                                        <span>With VPS hosting, you will get exclusive access to your allocated RAM, CPU, and storage for optimal performance without sharing with others.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">2</span>
                                        <h4>Shielded with Rock-Solid Security:</h4>
                                        <span>The VPS server offers advanced security features that help to protect your data from unauthorized access. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">3</span>
                                        <h4>Grow Without Limits:</h4>
                                        <span>With VPS hosting, you can easily scale resources like memory and bandwidth as your business grows without interruptions. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">4</span>
                                        <h4>Premium Performance, Affordable Price:</h4>
                                        <span>VPS offers the benefits of a dedicated server at a fraction of the cost, making it budget-friendly. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">5</span>
                                        <h4>Stay Reliable, Always Online:</h4>
                                        <span>The VPS server has isolated environments, so other users’ activities won’t affect your website's uptime or speed. </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <span class="list-num">6</span>
                                        <h4>Tailored for Your Business Needs:</h4>
                                        <span>With a VPS, you will have complete root access, allowing you to customize the server settings and install software according to your business requirements.
                                        </span>
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">7</span>
                                        <h4>Blazing-Fast Performance: </h4>
                                        <span>With VPS hosting, you will experience faster load times and smoother operation, even for high-traffic websites.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">8</span>
                                        <h4>The Perfect Fit for Growth-Ready Businesses:</h4>
                                        <span>It is perfect for businesses that need more resources than shared hosting but don’t require a dedicated server. </span>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
    
    <section class="tech_exprt_main head-tb-p-40">
        <div class="container">
            <div class="tech_exprt_box">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="tech_exprt_left">
                            <img class="img-fluid" src="../assets/images/vps_hosting/tech_exprt_img.webp" alt="tech_exprt_img">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="tech_exprt_center">
                            <h2>Do you fall short of technical expertise?</h2>
                            <p>Experience the Best Managed VPS Hosting with us.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="tech_exprt_right">
                             <a href="../servers/managed-vps-hosting" title="Check Our Plans">Check Our Plans</a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="web_panel_avail_main head-tb-p-40">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Enhanced VPS Hosting through powerful Web Panels</h2>
                <p class="text_cnt text-center">Enjoy unmatched control, security, and efficiency with our revolutionary Web Panels that elevate your VPS hosting experience.</p>
            </div>
            <div class="wb-panel-avail-box">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="wb-pnl-avl-left">
                            <div class="nav flex-row nav-pills justify-content-between" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link wb-pnl-btn active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home"  role="tab" aria-controls="v-pills-home" aria-selected="true"><img class="img-fluid" src="../assets/images/vps_hosting/webuzo_icon.webp" alt="webuzo_icon"></a>
                                <a class="nav-link wb-pnl-btn" id="v-pills-admin-tab" data-toggle="pill" data-target="#v-pills-admin"  role="tab" aria-controls="v-pills-admin" aria-selected="false"><img class="img-fluid" src="../assets/images/vps_hosting/DirectAdminLogo.webp" alt="DirectAdminLogo"></a>
                                <a class="nav-link wb-pnl-btn" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile"  role="tab" aria-controls="v-pills-profile" aria-selected="false"><img class="img-fluid" src="../assets/images/vps_hosting/cpanel_icon.webp" alt="cpanel_icon"></a>
                                <a class="nav-link wb-pnl-btn" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages"  role="tab" aria-controls="v-pills-messages" aria-selected="false"><img class="img-fluid" src="../assets/images/vps_hosting/plesk_icon.webp" alt="plesk_icon"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="wb-pnl-ul">
                                    <div class="wb-pnl-img">
                                        <img src="../assets/images/vps_hosting/webuzo_icon_sm.webp" alt="webuzo_icon_sm">
                                    </div>
                                    <p class="wb-pnl-cnt">
                                        With Webuzo, web application management becomes easier. Webuzo's intuitive interface simplifies applications' installation, configuration, and management. Webuzo easily manages domains and hosting servers, automates backups, and enhances security. Webuzo provides a hassle-free experience that helps you grow.
                                    </p>
                                    <ul>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports CentOS, AlmaLinux & Ubuntu.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Compatibility with various web applications.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Softaculous Integration.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Starting @ ₹220/mo*.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-admin" role="tabpanel" aria-labelledby="v-pills-admin-tab">
                                <div class="wb-pnl-ul">
                                    <div class="wb-pnl-img">
                                        <img src="../assets/images/vps_hosting/DirectAdminLogo.webp" alt="DirectAdminLogo">
                                    </div>
                                    <p class="wb-pnl-cnt">
                                    DirectAdmin is a cPanel owned by a company called JBMC Software and works specifically with Linux-based servers where you can easily control things like creating websites, managing email accounts, and keeping track of how much of their server's resources they're using. It is designed to be user-friendly and is often used by hosting providers to offer customers an intuitive interface for managing their hosting services.
                                    </p>
                                    <ul>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports CentOS, AlmaLinux, Ubuntu, and Debian.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Consumes fewer resources, making it more lightweight</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Easy-to-use interface, ideal for beginners.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Starting at ₹450/month*.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="wb-pnl-ul">
                                    <div class="wb-pnl-img">
                                        <img src="../assets/images/vps_hosting/cpanel_icon.webp" alt="cpanel_icon">
                                    </div>
                                    <p class="wb-pnl-cnt">
                                        cPanel simplifies server administration and management. Web administrators can use an intuitive graphical interface to manage web hosting, domains, emails, files, and databases. You can easily manage websites efficiently with features like one-click installations, advanced metrics, and analytics.
                                    </p>
                                    <ul>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports Ubuntu 20.x, AlmaLinux 8.x & 9.x.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Free Backup Management facility.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Advanced File management system.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Starting @ ₹1660/mo*.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <div class="wb-pnl-ul">
                                    <div class="wb-pnl-img">
                                        <img src="../assets/images/vps_hosting/plesk_icon.webp" alt="plesk_icon">
                                    </div>
                                    <p class="wb-pnl-cnt">
                                        Plesk simplifies server and website management with its intuitive interface. Plesk manages domains, email, databases, and file systems efficiently. It’s extremely helpful for web hosting companies and tech teams because it manages multiple servers. Plesk comes with tools for building websites, monitoring, and ensuring security.
                                    </p>
                                    <ul>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports Almalinux, CentOS, Debian.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports multiple programming languages.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Offers Multi-Server Management.</li>
                                        <li><span class="wb-pnl-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Starting @ ₹1150/mo*.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sup-vps-hstg-main head-tb-p-40">
        <div class="container">
            <div class="section-heading">
            <h2 class="text_head text-center">We Have Superior VPS Hosting For You!</h2>
            </div>
            <div class="sup-vps-hstg-box">
                <div class="row justify-content-center">
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/Budget-Friendly-icon.webp" alt="Budget-Friendly-icon">
                            <h3>Pocket-Friendly</h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/Powerful-Security-icon.webp" alt="Powerful-Security-icon">
                            <h3>Robust Security</h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/Uptime-icon.webp" alt="Uptime-icon">
                            <h3>99.9% Uptime</h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/24-7-Support-icon.webp" alt="24-7-Support-icon">
                            <h3>24/7 Support</h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/Datacenter-icon.webp" alt="Datacenter-icon">
                            <h3>India Datacenter</h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/2X-Faster-Speed-icon.webp" alt="2X-Faster-Speed-icon">
                            <h3>2X Faster Speed</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sec-dt-acr-bkp win-vps-pd-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="sec-dt-acr-img">
                    <img class="img-fluid" src="../assets/images/windows_vps_hosting/Acronis_Backup_Solution.webp" alt="Acronis_Backup_Solution">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sec-dt-acr-cnt">
                    <div class="section-heading">
                        <h2 class="text_head">Secure Your Data with Acronis Backup Solution</h2>
                        <p>Enjoy peace of mind knowing your valuable data is securely backed up with our world-class backup solution tailored to suit your needs.</p>
                    </div>
                    <div class="sec-dt-acr-price">
                        <div class="sec-dt-prc-one">
                            For Just
                        </div>
                        <div class="sec-dt-prc-two">
                            ₹100/mo <span>(For 10GB Data)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section> 
    <section class="manage-vps-comp-main head-tb-p-40">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Self-Managed VPS vs Fully Managed VPS</h2>
            </div>
            <div class="manage-vps-comp-box">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="manage-vps-comp-table table-responsive">
                            <table class="table">
                                <thead class="head_top-tbl">
                                    <tr>
                                        <th scope="col">FEATURES</th>
                                        <th class="text-center" scope="col">SELF-MANAGED</th>
                                        <th class="text-center" scope="col">FULLY MANAGED</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Server provisioning and setup</th>
                                        <td><i class="fa-solid fa-check"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Server Maintenance & Updates</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Hardware related resolutions</th>
                                        <td><i class="fa-solid fa-check"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">SSL Certificate installation support</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Free server monitoring 24/7 through monitoring agent</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Control panel installation</th>
                                        <td><i class="fa-solid fa-check"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Control Panel Related Task</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Physical hardware monitoring and management</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Server resource upgradation support</th>
                                        <td><i class="fa-solid fa-check"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Best efforts in installing third-party software</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Security Firewall Setup</th>
                                        <td><i class="fa-solid fa-check"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Security Firewall Setup & Configuration</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Domain management support</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Web Server / DNS Server / Database Server / Mail Server support</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Assistance to Configure FTP and Email Clients</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Standard Support (Server Status Check, Server Start/Stop, DNS, 24/7 Ticket Support)</th>
                                        <td><i class="fa-solid fa-check"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Technical Support (From Senior Technician)</th>
                                        <td><i class="fa-solid fa-xmark"></i></td>
                                        <td><i class="fa-solid fa-check"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="vps-features  head-tb-p-40" id="features">
        @if(!empty($FeaturesData) && count($FeaturesData) >0)
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="text_head">VPS Hosting Features That Will Capture Your Admiration</h2>
                    <p class="text_cnt">Powerful VPS Servers + Cutting-Edge Features = Performance Guaranteed</p>
                </div>
                <div class="row">
                    <div class="features-main">
                        @php
                        $featureMainDivClass;
                        $featureIconDivClass;
                        
                        $featureMainDivClass="features-start ";
                        $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                        @endphp
                        <div class="{{$featureMainDivClass}}">
                            
                                <div class="row">
                                    <div class="feature-ul d-flex flex-wrap">
                                        @foreach($FeaturesData as $Features)
                                        
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start" @if ($uagent !="mobile" )data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100" @endif>
                                                    <div class="{{$featureIconDivClass}}"><i class="{{$Features->varIconClass}}"></i></div>
                                                    <h3>{{$Features->varTitle}}</h3>
                                                    <div class="content">{!! $Features->varShortDescription !!}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                               </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
    <section class="vps_hosting_prov_comp_main head-tb-p-40">
        <div class="container">
            <div class="section-heading text-center">
                <h2 class="text_head">Don’t Believe Us Yet?</h2>
                <p>Let’s see where our VPS hosting plans stand among the competition</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="vps_hstg_prv_table table-responsive">
                        <table class="table">
                            <thead class="vps-hstg-tbl-head">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/logo.webp" alt="logo"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-bluehost.webp" alt="providers-bluehost"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-godaddy.webp" alt="providers-godaddy"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-br.webp" alt="providers-br"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-hostgator.webp" alt="providers-hostgator"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-hostinger.webp" alt="providers-hostinger"></th>
                                </tr>
                            </thead>
                            <tbody class="vps-hstg-prv-body">
                                <tr>
                                    <td>Monthly Pricing</td>
                                    <td>₹720/mo</td>
                                    <td>₹1049/mo</td>
                                    <td>₹1699/mo</td>
                                    <td>₹999/mo</td>
                                    <td>₹649/mo</td>
                                    <td>₹999/mo</td>
                                </tr>
                                <tr>
                                    <td>CPU</td>
                                    <td>2vCPU</td>
                                    <td>1vCPU</td>
                                    <td>2 CPU</td>
                                    <td>1 vCPU</td>
                                    <td>1 CPU</td>
                                    <td>2 CPU</td>
                                </tr>
                                <tr>
                                    <td>RAM</td>
                                    <td>2 GB</td>
                                    <td>2 GB</td>
                                    <td>2 GB</td>
                                    <td>4 GB</td>
                                    <td>1 GB</td>
                                    <td>2 GB</td>
                                </tr>
                                <tr>
                                    <td>Storage</td>
                                    <td>40GB SSD</td>
                                    <td>40GB NVMe SSD</td>
                                    <td>30GB SSD</td>
                                    <td>50GB NVME SSD</td>
                                    <td>15GB</td>
                                    <td>20GB</td>
                                </tr>
                                <tr>
                                    <td>VPS Management</td>
                                    <td>Self-Managed</td>
                                    <td>Self-Managed</td>
                                    <td>Self-Managed</td>
                                    <td>Self-Managed</td>
                                    <td>Self-Managed</td>
                                    <td>Self-Managed</td>
                                </tr>
                                <tr>
                                    <td>Virtualization</td>
                                    <td>KVM</td>
                                    <td>KVM</td>
                                    <td>KVM</td>
                                    <td>KVM</td>
                                    <td>KVM</td>
                                    <td>KVM</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
 @include('template.'.$themeversion.'.testimonial_section') 
@include('template.'.$themeversion.'.faq-section')
@include('template.'.$themeversion.'.two-hosting-add')
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