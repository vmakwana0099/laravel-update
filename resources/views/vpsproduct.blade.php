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
            <h2 class="text_head text-center">Powerful VPS Hosting Solutions in India For You</h2>
            <p class="text_cnt text-center"> Choose Our Cheap VPS in India with KVM Virtualization for Ultimate Performance!</p>
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
       @if(isset($element->productpricing['monthly_renewal']))
                                        {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly_renewal']}}
                                        @else
                                        {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly']}}
                                        @endif
    </span> 
    @php
                                    if(isset($element->productpricing['monthly_renewal'])){
                                        $percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly_renewal']) * 100), 0);
                                    }else{
                                        $percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly']) * 100), 0);
                                    }

                                    @endphp
                                    <span class="offer-discount" id="offer-discount-{{str_replace(' ', '', $planName)}}">
                                        Save {{$percentageOff}}%
                                    </span>
    {{-- <span class="offer-discount" id="offer-discount-{{str_replace(' ', '', $planName)}}">
   Save {{$percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly']) * 100), 0)}}%
    </span> --}}
          </div>
            <div class="plan-price-main" id="oneyear-price{{str_replace(' ', '', $planName)}}">
                
    <span class="plan-price-r-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$element->productpricing['annually']}}<span class="vps-prc-mo">/mo</span></div>
            @endif
             {{-- <div class="freedom-sale-offer">+15 Days Free</div> --}}
            <div class="vps-plan-conf-btn" id="oneyear-btn{{str_replace(' ', '', $planName)}}">
                @if(isset($element->ButtonTextannually) && !empty($element->ButtonTextannually))
           {!! $element->ButtonTextannually !!}
           @endif
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

    @include('template.'.$themeversion.'.30-day-moneyback')

    <div class="g-suite-lists head-tb-p-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-heading">
                                <h2 class="text_head text-center">What Can You Do with Our VPS Server Hosting? </h2>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">1</span>
                                        <h3>For Hosting High-Traffic Websites</h3>
                                        <span>Shared hosting isn’t enough when too many visitors land on your website. Hosting high-traffic sites on a VPS ensures speed, reliability, and no downtime, even on the busiest days of your website.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">2</span>
                                        <h3>For Forex Trading</h3>
                                        <span>Looking for a speedy space to host your trading platform so that a slight delay doesn’t become a huge loss? The high-speed VPS can be your go-to solution. Join 630+ traders who are trading smart with our <a href="../servers/forex-vps-hosting"><u>Forex VPS</u></a> </span>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">3</span>
                                        <h3>For Running Web Applications</h3>
                                        <span>To host CRM or any SaaS platform, a reliable VPS with dedicated resources can help you offer stability, customization, and scalability to improve your app's performance. In such cases, businesses prefer hosting on <a href="../servers/managed-vps-hosting"><u>Windows VPS</u></a> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">4</span>
                                        <h3>As Personal Email Server</h3>
                                        <span>Need complete control over your emails? A VPS can be your perfect control room for managing emails and setting up your email server free from spam filters and provider restrictions. Today, over 170 clients manage their emails smartly from our amazing VPS. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">5</span>
                                        <h3>As Personal Database Server</h3>
                                        <span>If you want to manage large business data, like customer records or financial transactions, a VPS can be the best & affordable solution that offers you the most secured storage as per your requirement, along with reliability. </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <span class="list-num">6</span>
                                        
                                        <h3>For Developing an API</h3>
                                        <span>Building an API requires a reliable and fast server to handle requests. For that, VPS is the best choice to host your API, ensuring high availability, fast responses, full customization, and robust security for your API endpoints.</span>
                                        
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">7</span>
                                        <h3>As Personal Web Server</h3>
                                        <span>If you are an agency or a freelancer who is looking to host multiple client projects on your server, VPS can be helpful where you will get all dedicated resources with complete control to manage your projects securely at a low cost.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">8</span>
                                        <h3>For Web Scraping or Running Bots</h3>
                                        <span>If you often collect data from websites, monitor any changes, or run automated scripts, VPS can easily automate tasks like web scraping, data collection, or running chatbots without worrying about downtime. Over 65+ clients are using our VPS for web scraping.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">9</span>
                                        <h3>For Development & Testing</h3>
                                        <span>A developer needs a safe space to test their code before deploying it to a live website or application. A VPS can help you by offering a dedicated testing environment with full control for experimenting with new codes.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">10</span>
                                        <h3>For Running an Online Store</h3>
                                        <span>Slow & steady will not win the race while running an online store. A high-speed VPS makes your store smooth & ready for peak sales hours! We are proud to help 35+ events & eCommerce websites get powerful performance.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">11</span>
                                        
                                        <h3>Using VPS as Image Server</h3>
                                        <span>If you are a graphic designer or a photographer and working with a large number of images, whether for backups or sharing, a VPS as an Image Server can make your life easier to access and serve images instantly from anywhere.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">12</span>
                                        <h3>For Training & Deploying AI Models</h3>
                                        <span>AI & ML models take too much computing power, and training them on a PC can be slow, and it may even crash. VPS can help you by offering dedicated resources to train such models. Till now, our VPS has helped 10 clients deploy AI models.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">13</span>
                                        <h3>For Backup Storage</h3>
                                        <span>You know that data loss can happen due to hardware failure, cyberattacks, accidental deletions, or system crashes. A VPS can help you as a backup solution where you can store and restore your data securely whenever required and prevent disruptions.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">14</span>
                                        <h3>As Personal Cloud Storage</h3>
                                        <span>If you are tired of relying on third-party cloud services like Google Drive or Dropbox and looking for complete control over your files, a VPS server can be a great storage solution for keeping your sensitive data fully secured & encrypted.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">15</span>
                                        <h3>For Full Root Access</h3>
                                        <span>In shared hosting, we understand you are limited in what you can do, like no custom software, advanced settings, or deep system access. By hosting on a VPS, you will get full root access, which means complete control over your hosting environment.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">16</span>
                                        <h3>To Get Remote Access</h3>
                                        <span>By using VPS, your data isn’t tied to one device. Your data is stored on a remote server that you can access from anywhere in the world. You can easily log in and manage your files, applications, or website like your personal system.</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div> 

    @include('template.'.$themeversion.'.testimonial_section')

    <!-- feature points section start -->
    <div class="dl-features-points">
        <div class="container">
            <div class="feature-start">
                <div class="section-heading">
                <h2 class="text-center text_head">Here’s What Our Amazing Indian VPS Server Offers You With Best Pricing!</h2>
                <p class="text_cnt text-center">Our Cheap VPS offering doesn’t mean that you have to sacrifice the quality!</p>
                </div>
                <div class="fp-list">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>Value that’s truly worth it!</h3></li>
                                <li><h3>India-Based Datacenter</h3></li>                                
                                <li><h3>Enterprise-Grade Hardware</h3></li>
                                <li><h3>Low latency with 2X faster speed</h3></li>
                            </ul>
                        </div>
                        
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>Full root access on server</h3></li>
                                <li><h3>Secured with DDoS protection</h3></li>
                                <li><h3>High security using custom firewall rules</h3></li>
                                <li><h3>Built-in network redundancy</h3></li>                                
                                <li><h3>99.9% uptime guarantee</h3></li>                                
                                {{-- <li style="list-style-type: none;">View Detailed Features</li>                                 --}}
                            </ul>
                        </div>
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>Secured private network</h3></li>
                                <li><h3>Install any software with 1-click</h3></li>
                                <li><h3>Optimized storage for better performance</h3></li>
                                <li><h3>24/7 expert support whenever you need</h3></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#features" title="See More Features" class="more-features shared_plan_more_btn text-dark">View Detailed Features</a>
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
                             <a href="../servers/managed-vps-hosting" title="Explore Managed VPS">Explore Managed VPS</a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- feature points section end -->     

     <section class="manage-vps-comp-main head-tb-p-40">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Self-Managed VPS or Fully Managed VPS</h2>
                <p class="text_cnt text-center">Get a clear breakdown of support & responsibilities before you choose!</p>
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

    

    <section class="web_panel_avail_main head-tb-p-40">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">Pick Your Favorite Control Panel & Stay in Charge</h2>
                <p class="text_cnt text-center">Pick the control panel that fits your style and take full control, so managing your VPS server becomes easy and never a headache!</p>
            </div>
            <div class="wb-panel-avail-box">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="wb-pnl-avl-left">
                            <div class="nav flex-row nav-pills justify-content-between" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link wb-pnl-btn active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"  role="tab" aria-controls="v-pills-home" aria-selected="true"><img class="img-fluid" src="../assets/images/vps_hosting/webuzo_icon.webp" alt="webuzo_icon"></a>
                                <a class="nav-link wb-pnl-btn" id="v-pills-admin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-admin"  role="tab" aria-controls="v-pills-admin" aria-selected="false"><img class="img-fluid" src="../assets/images/vps_hosting/DirectAdminLogo.webp" alt="DirectAdminLogo"></a>
                                <a class="nav-link wb-pnl-btn" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"  role="tab" aria-controls="v-pills-profile" aria-selected="false"><img class="img-fluid" src="../assets/images/vps_hosting/cpanel_icon.webp" alt="cpanel_icon"></a>
                                <a class="nav-link wb-pnl-btn" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"  role="tab" aria-controls="v-pills-messages" aria-selected="false"><img class="img-fluid" src="../assets/images/vps_hosting/plesk_icon.webp" alt="plesk_icon"></a>
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
                                        Webuzo makes web application management super-duper easy! You can install, set up, and manage apps without any trouble. It also helps you handle domains, automate backups, and secure your server. In short, with the Webuzo panel, everything is simple, so you can focus on GROWING!
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
                                    DirectAdmin is a control panel developed by JBMC Software that is specially designed for Linux-based servers. It lets you easily create websites, manage email accounts, and monitor server resource usage. It’s a popular choice among VPS hosting providers because it offers customers an easy-to-use interface for managing their hosting services.
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
                                        With cPanel, managing things is quite simple and stress-free! You can easily control hosting, domains, emails, and more from one of the simplest dashboards. 1-click installs and advanced metrics make everything smoother for you!
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
                                        Plesk panel is one of the best control panels for managing servers and websites super easily with its simple interface. You can easily handle domains, emails, databases, and files in one place, which makes it a great choice for web hosting companies and tech teams to manage multiple servers smoothly.
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
   
    
    <section class="vps-features  head-tb-p-40" id="features">
        @if(!empty($FeaturesData) && count($FeaturesData) >0)
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="text_head">VPS Features That Might Be Your Sole Requirements</h2>
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
                                    <div class="feature-ul d-flex flex-wrap" id="vps-all-features">
                                        @foreach($FeaturesData as $Features)
                                        
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start" @if ($uagent !="mobile" )data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100" @endif>
                                                    <div class="{{$featureIconDivClass}}"><i class="{{$Features->varIconClass}}"></i></div>
                                                    <span>{{$Features->varTitle}}</span>
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
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-godaddy.webp" alt="providers-godaddy"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-bluehost.webp" alt="providers-bluehost"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-hostinger.webp" alt="providers-hostinger"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-br.webp" alt="providers-br"></th>
                                    <th scope="col"><img src="../assets/images/vps_hosting/providers-hostgator.webp" alt="providers-hostgator"></th>
                                    
                                </tr>
                            </thead>
                            <tbody class="vps-hstg-prv-body">
                                <tr>
                                    <td>Monthly Pricing</td>
                                    <td>₹420/mo</td>
                                    <td>₹649/mo</td>
                                    <td>₹1749/mo</td>
                                    <td>₹439/mo</td>
                                    <td>₹449/mo</td>
                                    <td>₹699/mo</td>
                                </tr>
                                <tr>
                                    <td>CPU</td>
                                    <td>1vCPU</td>
                                    <td>1vCPU</td>
                                    <td>2 CPU</td>
                                    <td>1 vCPU</td>
                                    <td>2 CPU</td>
                                    <td>2 CPU</td>
                                </tr>
                                <tr>
                                    <td>RAM</td>
                                    <td>4 GB</td>
                                    <td>2 GB</td>
                                    <td>2 GB</td>
                                    <td>4 GB</td>
                                    <td>2 GB</td>
                                    <td>2 GB</td>
                                </tr>
                                <tr>
                                    <td>Storage</td>
                                    <td>50GB SSD</td>
                                    <td>40GB NVMe SSD</td>
                                    <td>30GB SSD</td>
                                    <td>50GB NVME SSD</td>
                                    <td>20GB</td>
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
 {{-- @include('template.'.$themeversion.'.help_section')
   --}}
 @include('template.'.$themeversion.'.support_section_home') 


<div class="dy-money-back-grnt head-tb-p-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dy-money-back-grnt-box text-center">
                            <h2>Your Business Needs More Than Just an Email!</h2>
                            <p>Google Workspace gives you a professional, branded inbox.</p>
                            <a href="https://www.hostitsmart.com/email/google-workspace-india" title="I Need Google Workspace">I Need Google Workspace</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
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