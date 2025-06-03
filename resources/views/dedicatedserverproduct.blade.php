@extends('layouts.app')
@section('content')
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
        <!-- Freedom-sale-banner-2022 -->
        <!-- <span class="fsb-tca">* T & C Apply</span> -->
        <!-- End-freedome-sale-banner-2022 -->
    </div>
    @endif
    @endif
</div>
<div class="vps_main {{$ProductBanner->varBannerIconClass}}">

    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
    <!-- <div class="cms">
        <div class="container">
            <div class="row">
                 <div class="col-sm-12">
                    <h4 class="text-center big_title blue_title">
                    Cheap Dedicated Servers
                </h4>
            </div>
                
            <div class="col-12 col-sm-12 order-xs-3">
                <div class="left">
                    <div class="title">
                        <p>A dedicated server is functionally equivalent to an in-house server, only much more cost-efficient. It is exclusively dedicated to your requirement giving you the control over resources and hardware on rent. Give your ever growing business wings to soar. Enjoy amazing scalability and absolutely no restraint on customer service with our cheap dedicated server hosting in India. G-Suite apps are influential yet uncomplicated and apt for any business size - big or small.</p>
                        <p>{{ Config::get('Constant.SITE_NAME') }} offers a secure and single-tenant dedicated server, customized to your mission-critical business. Our Linux and Windows dedicated server hosting render you added flexibility, maximum control, and administration access to support you in your business goal at an affordable cost.
                        </p>
                        <p>We are also well-known for providing unmanaged dedicated servers. We provide network-monitoring, internet connectivity, web server, and equipment and you take control for software and security, applying patches and others.
                        </p>
                            <br />
                    </div>
                    
                </div>
            </div>
            </div>
        </div>
    </div> -->
    <div class="head-tb-p-40 @if($ProductBanner->id == 7) vpsplan_slider_div @endif @if($ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 13 || $ProductBanner->id == 8) dedicated-plan-main-div @endif" id="dedicated_server_plan">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="section-heading">
                        @php if($ProductBanner->id == 8){ @endphp
                        <h2 class="text-center text_head ">Choose & Buy a Cheap Dedicated Server Plan</h2>
                        <p class="text-center">Secure your seamless hosting experience now for smooth sailing online</p>
                          <p class="text-center dedi-red-note">*(Servers are subject to availability)</p>
                        @php } else if($ProductBanner->id == 4){ @endphp
                        <h4 class="text-center green_title f_weight_500" title="Wordpress Beginner or a full grown business, we have something for you, always!">Wordpress Beginner or a full grown business, we have something for you, always!</h4>
                        <span>Wordpress is amazing!. But when you have a ton to do about your business, you seldom will have the time to understand tiny technicalities of running your wordpress site. That's where managed Wordpress hosting comes into the frame. Regular back up, uptime maintenance, speed, scalability, security, literally everything - is taken care of, while you put your efforts into growing your business.
                        </span>
                        @php } else { @endphp
                        <h4 class="text-center green_title f_weight_500">Dedicated Server Plans and Pricing in India</h4>
                        <p>Quality hosting does not mean elephantine costs. Not with our plans at least.</p>
                        @php } @endphp
                    </div>
                </div>

                @if($ProductBanner->id == 4 || $ProductBanner->id == 6 || $ProductBanner->id == 13) {{-- Set $ProductBanner->id == 8 for dedicated server --}}
                <div class="col-12">
                    <div class="dedicated-head">
                        <h4 class="server-head" data-aos="fade-up" data-aos-delay="200">SELECT SERVER LOCATION</h4>
                        <span class="server-text2" data-aos="fade-up" data-aos-delay="300">(Website traffic from India? Get 10x faster speed!)</span>
                        <ul class="nav-server-location">
                            <li><a href="javascript:void(0)" onclick="changeLocation('India');" title="India" class="show active-tab" id="loc1"><i class="hosting-location-icon map-india"></i></a></li>
                            <li><a href="javascript:void(0)" onclick="changeLocation('USA');" title="USA" class="" id="loc2"><i class="hosting-location-icon map-america"></i></a></li>
                        </ul>
                    </div>
                </div>
                <script type="text/javascript">
                    function changeLocation(locstr) {
                        $('input[id^="location"]').each(function(i, ele) {
                            $(this).val(locstr);
                            console.log(locstr + " " + $(this).attr("id"));
                        });
                    }
                </script>
                @endif
                @php if($ProductBanner->id != 8){ @endphp
                <div class="switch-plan">
                    <div class="month-tab tab-left-save active aos-init" data-aos="fade-left" data-aos-delay="400">Monthly @if(!empty($ProductBanner->varSaveTextMonth)) <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextMonth}}</span> @endif </div>
                    <label class="switch aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="100">
                        <input type="checkbox" name="monthly" id="monthly" onclick="calc();"> <span class="slider round"></span>
                    </label>
                    <div class="month-tab aos-init" data-aos="fade-right" data-aos-delay="400">Yearly @if(!empty($ProductBanner->varSaveTextYear)) <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">{{$ProductBanner->varSaveTextYear}}</span> @endif </div>
                </div>
                @php } @endphp


                @php
                
                    $thArr=["NAME","Model","CPU","RAM","STORAGE","Bandwidth","IP","Price"]; 
                @endphp
                {{-- Dedicated server new design start --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ds-plans-table table-responsive">
                        <table class="table dedicatedserver-pricing-table">
                            <thead class="">
                                <tr>
                                    <th><img loading="eager" src="../assets/images/dedicated_server/name_icon.webp" alt="name_icon"> {{ $thArr["0"] }}</th>
                                    <th><img loading="eager" src="../assets/images/dedicated_server/model_icon.webp" alt="model_icon"> {{ $thArr["1"] }}</th>
                                    <th><img loading="eager" src="../assets/images/dedicated_server/core_icon.webp" alt="core_icon"> {{ $thArr["2"] }}</th>
                                    <th><img loading="eager" src="../assets/images/dedicated_server/ram_icon.webp" alt="ram_icon"> {{ $thArr["3"] }}</th>
                                    <th><img loading="eager" src="../assets/images/dedicated_server/storage_icon.webp" alt="storage_icon"> {{ $thArr["4"] }}</th>
                                    <th><img loading="eager" src="../assets/images/dedicated_server/bandwith_icon.webp" alt="bandwith_icon"> {{ $thArr["5"] }}</th>
                                    <th><img loading="eager" src="../assets/images/dedicated_server/ip_icon.webp" alt="ip_icon"> {{ $thArr["6"] }}</th>
                                    <th><img loading="eager" src="../assets/images/dedicated_server/price_icon.webp" alt="price_icon"> {{ $thArr["7"] }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ProductsPackageData as $elkey => $element)
                                @php
                                    $planName = $element->varTitle; 
                                    $SpecificationData = explode("\n",$element->txtSpecification); 
                                @endphp
                                    <tr class="dedicatedserver-pricing-row">
                                        <td data-value="{{$thArr["0"]}}" class="text-cstm-clr">{{$planName}} </td>
                                        @foreach ($SpecificationData as $key => $Specifica)
                                            @if ( (count($thArr) - 1) > $key)
                                                @php 
                                                    $Specification = trim($Specifica);
                                                    foreach ($thArr as $ele){
                                                        $Specification=str_replace(strtolower(trim($ele)), "", strtolower($Specification));
                                                    }
                                                @endphp
                                                <td data-value="{{($thArr[($key+1)])}}" class="text-cstm-clr">{!!strtoupper($Specification)!!}</td>
                                            @endif
                                        @endforeach
                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                        <td data-value="Price" class="ds-plan-price">
                                            <p class="mb-0">
                                                <span class="price"><i class="fa fa-inr"></i>{{$element->productpricing['semiannually']}}<span>/mo*</span></span>
                                                <span class="pricing-onsale d-none">
                                                    On sale - 
                                                    <span class="badge color-3 color-3-bg line-through">{{$element->intOldPriceSixMonthINR}}
                                                    </span>
                                                </span>
                                            </p>
                                        </td>
                                        @elseif(Config::get('Constant.sys_currency') == 'USD')
                                        <td data-value="Price" class="ds-plan-price">
                                            <p class="mb-0">
                                                <span class="price"><i class="fa fa-usd"></i>{{$element->productpricing['semiannually']}}<span>/mo*</span></span>
                                                <span class="pricing-onsale d-none">
                                                    On sale - 
                                                    <span class="badge color-3 color-3-bg line-through">{{$element->intOldPriceSixMonthUSD}}
                                                    </span>
                                                </span>
                                            </p>
                                        </td>
                                        @endif

                                        <td class="ds-plan-conf-btn">
                                            {!! $element->ButtonTextsemiannually !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                {{-- Dedicated server new design end --}}
            </div>
        </div>
    </div>
    @endif
</div>

<!-- <div class="g-suite-lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="g_s_l-title">Why buy dedicated servers?</h2>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">1</i>
                                        <h4>Complete Root Access</h4>
                                        <span>No restraints, no limitations! Get maximum flexibility in setting up and configuring your web server. We offer you administrative-level of root access to ensure you take charge of your server.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <i class="list-num">2</i>
                                        <h4>Host Unlimited Websites</h4>
                                        <span>Host as many websites as you want on our affordable dedicated server. There is no limitation! In addition, you could also shift your website from VPS or shared hosting server to dedicated server.
                                        </span>
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">3</i>
                                        <h4>Dedicated IP</h4>
                                        <span>We offer a dedicated IP along with our cheap dedicated server in India allowing you to access you to create a professional impact and access the server settings without changing the DNS settings.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">4</i>
                                        <h4>High-traffic Websites</h4>
                                        <span>Your rapidly growing online business means more potential customers visiting your website. A dedicated server power up your website to burden the load seamlessly and offer a great user experience.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">5</i>
                                        <h4>Top-notch Management</h4>
                                        <span>Our cheap dedicated servers come with cPanel and WHM to offer advanced management of every function and configuration. </span>
                                    </div>
                                </div>
                            </div>
                              <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <i class="list-num">6</i>
                                        <h4>Maximum Control</h4>
                                        <span>Take the reins of your business servers in your hands. Get maximum customization, configuration, and installation control.</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div> -->

                                            <section class="ds-control-panel-main head-tb-p-40">
                                                <div class="container">
                                                    <div class="section-heading">
                                                        <h2 class="text_head text-center">Elevate Your Dedicated Server with Advanced Control Panels</h2>
                                                        <p class="text_cnt text-center">Control your Dedicated server with our cutting-edge web panels. Leverage their unmatched security and efficiency for an elevated experience.</p>
                                                    </div>
                                                    <div class="ds-control-panel-box">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-lg-3">
                                                                <div class="ds-control-panel-left">
                                                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                        <a class="nav-link ds-control-panel-btn active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><img src="../assets/images/vps_hosting/webuzo_icon.webp" alt="webuzo_icon" loading="eager"></a>
                                                                        <a class="nav-link ds-control-panel-btn" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><img loading="eager" src="../assets/images/vps_hosting/cpanel_icon.webp" alt="cpanel_icon"></a>
                                                                        <a class="nav-link ds-control-panel-btn" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><img loading="eager" src="../assets/images/vps_hosting/plesk_icon.webp" alt="plesk_icon"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-lg-9">
                                                                <div class="tab-content" id="v-pills-tabContent">
                                                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                        <div class="ds-control-panel-ul">
                                                                            <div class="ds-control-panel-img">
                                                                                <img loading="eager" src="../assets/images/vps_hosting/webuzo_icon_sm.webp" alt="webuzo_icon_sm">
                                                                            </div>
                                                                            <p class="ds-control-panel-cnt">
                                                                            Webuzo simplifies web application management, making it more user-friendly. It offers an intuitive interface that streamlines application installation, setup, and administration. Additionally, Webuzo efficiently handles domain and hosting server management, automates backups, and boosts security measures. This user-friendly platform offers a seamless experience to support your growth.
                                                                            </p>
                                                                            <ul>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports CentOS, AlmaLinux & Ubuntu.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Compatibility with various web applications.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Softaculous Integration.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Starting @ ₹500/mo*.</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                                        <div class="ds-control-panel-ul">
                                                                            <div class="ds-control-panel-img">
                                                                                <img loading="eager" src="../assets/images/vps_hosting/cpanel_icon.webp" alt="cpanel_icon">
                                                                            </div>
                                                                            <p class="ds-control-panel-cnt">
                                                                            Through its easy-to-use graphical interface, cPanel streamlines server administration and management. It allows web administrators to manage web hosting, domains, emails, files, and databases. cPanel's user-friendly features, including one-click installations, advanced metrics, and analytics, ensure efficient and effective website management.
                                                                            </p>
                                                                            <ul>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports Ubuntu 20.x, AlmaLinux 8.x & 9.x.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Free Backup Management facility.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Advanced File management system.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Starting @ ₹1660/mo*.</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                                        <div class="ds-control-panel-ul">
                                                                            <div class="ds-control-panel-img">
                                                                                <img loading="eager" src="../assets/images/vps_hosting/plesk_icon.webp" alt="plesk_icon">
                                                                            </div>
                                                                            <p class="ds-control-panel-cnt">
                                                                            A Plesk server and website management interface simplifies the process. Because it manages multiple servers, Plesk is an excellent choice for web hosting companies and technical teams because it efficiently manages domains, e-mail, databases, and file systems. In addition, Plesk provides tools for building websites, monitoring, and security.
                                                                            </p>
                                                                            <ul>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports Almalinux, CentOS, Debian.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Supports multiple programming languages.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Offers Multi-Server Management.</li>
                                                                                <li><span class="ds-control-panel-cnt-icon"><i class="fa-regular fa-circle-check"></i></span> Starting @ ₹880/mo*.</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <section class="dedctd-ser-speed-perfmncs head-tb-p-40">
                                                    <div class="container">
                                                        <div class="section-heading">
                                                            <h2 class="text-center text_head">Unparalleled Speed And Performance Metrics At Your Fingertips!</h2>
                                                            <p class="text-center">Take a look at the super-fast speeds and strong performance of our dedicated servers!</p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="speed-perfmncs-main-img text-center">
                                                                    <img loading="eager" src="../assets/images/dedicated_server/speed_and_performance.webp" alt="speed_and_performance">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </section>

                                            <section class="disc-full-power head-tb-p-40">
                                                <div class="container">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-5">
                                                                    <div class="section-heading disc-power-head">
                                                        <h2 class="text_head">Potential of Dedicated Servers - Multiple Avenues</h2>
                                                    </div>
                                                                        <div id="accordion-box" class="accordion faq-wrap">

                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box0" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Website Hosting</h3>
                                                                                </a>
                                                                                <div id="box0" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>Our Dedicated servers offer optimal website performance and top-end Security tailored to your needs.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box1" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Running eCommerce Platforms</h3>
                                                                                </a>
                                                                                <div id="box1" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>Our dedicated servers power your eCommerce websites for seamless transactions, high-speed performance, robust security, and scalability.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box2" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Database Management</h3>
                                                                                </a>
                                                                                <div id="box2" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>With our dedicated servers, you can experience optimized database management for fast data processing, secure storage, efficient backups, and reliable performance.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box3" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For ERP Management</h3>
                                                                                </a>
                                                                                <div id="box3" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>Enjoy efficient operations with our dedicated servers. Experience enhanced ERP management, streamlined workflows, real-time data processing, secure access, scalability, and customized integrations.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box4" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Application Hosting</h3>
                                                                                </a>
                                                                                <div id="box4" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>Experience seamless application hosting on our dedicated servers with fast loading times, efficient computing, secure environments, and scalability.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box5" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Running Media Streaming</h3>
                                                                                </a>
                                                                                <div id="box5" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>Enjoy power media streaming on our dedicated servers, which offer high-quality content delivery, low latency, reliable bandwidth, secure data handling, and seamless scalability.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box6" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Data Analytics Software</h3>
                                                                                </a>
                                                                                <div id="box6" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>Our dedicated servers stand tall in the bustling world of data analytics, ensuring swift processing power for cutting-edge software applications.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box7" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Managing Data Storage</h3>
                                                                                </a>
                                                                                <div id="box7" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>Amidst the digital tangle, dedicated servers safeguard and organize vast data storage. We ensure seamless access and optimal security protocols for your business data.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box8" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Managing IoT Backend Infrastructure</h3>
                                                                                </a>
                                                                                <div id="box8" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>At the heart of the IoT revolution, dedicated servers power and streamline complex backend infrastructures, enabling seamless connectivity and efficiency.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 faqs-card">
                                                                                <a class="card-header collapsed" data-bs-toggle="collapse" href="#box9" aria-expanded="false">
                                                                                    <h3 class="mb-0 d-inline-block faqs-span">For Machine Learning</h3>
                                                                                </a>
                                                                                <div id="box9" class="collapse" data-parent="#accordion-box">
                                                                                    <div class="card-body white-bg">
                                                                                        <p>In the era of intelligent technology, dedicated servers are the lifeline for complex machine learning algorithms, optimizing performance and innovation.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                        <div class="col-lg-7">
                                                            <div class="disc-full-power-img">
                                                                <img loading="lazy" src="../assets/images/dedicated_server/multiple_avenues.webp" alt="multiple_avenues">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <section class="ds-self-manage-assist self-managed-vps-assist whdo-win-vps-inc head-tb-p-40">
                                                <div class="container">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6">
                                                            <div class="wp-pnl-first">
                                                                <div class="wp-pml-first-img">
                                                                    <img loading="lazy" src="../assets/images/dedicated_server/server_support.webp" alt="server_support">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="section-heading">
                                                                <h2 class="text_head">Despite purchasing a self-managed dedicated server, we continue to assist in the following</h2>
                                                            </div>
                                                            <div class="wn-features-ul">
                                                                <div class="wn-features-cnt">
                                                                    <ul>
                                                                        <li><span class="wn-features-cnt-icon">Server Provisioning And Setup</li>
                                                                        <li><span class="wn-features-cnt-icon">Hardware Related Resolutions</li>
                                                                        <li><span class="wn-features-cnt-icon">Control Panel Installation</li>
                                                                        <li><span class="wn-features-cnt-icon">Server Resource Upgradation</li>
                                                                        <li><span class="wn-features-cnt-icon">Security Firewall Setup</li>
                                                                        <li><span class="wn-features-cnt-icon">Standard Support</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>



                @if(!empty($FeaturesData) && count($FeaturesData) >0)
                <div class="vps-features head-tb-p-40" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <div class="section-heading">
                <h2 class="text_head text-center" data-aos="fade-up">Features of Our Dedicated Server</h2>
                </div>
                @php
                $featureMainDivClass;
                $featureIconDivClass;
                
                $featureMainDivClass="features-start d-md-block";
                $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                
                @endphp

                <div class="{{$featureMainDivClass}}">
                    
                        <div class="row">
                            <div class="feature-ul d-flex justify-content-center flex-wrap">
                                
                                @foreach($FeaturesData as $Features)
                               
                                    <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                        <div class="content-main align-self-start">
                                            <div class="{{$featureIconDivClass}}">
                                              
                                                <img class="win-vps-features-icon" src="../assets/images/dedicated_server/{{$Features->varIconClass}}.svg" alt="{{$Features->varIconClass}}" loading="eager">

                                            </div>

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
</div>

<section class="sec-dt-acr-bkp ds-acr-bkp head-tb-p-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="sec-dt-acr-cnt">
                    <div class="section-heading">
                        <h2 class="text_head">Acronis Backup Solution: Your Data Security Assurance</h2>
                        <p class="ds-acr-mb">Get your valuable data securely backed-up on our top-notch customised backup solution for your requirements.</p>
                        <p class="ds-acr-desk">At Host IT Smart, we understand the paramount importance of protecting your data. That's why we are thrilled to offer you an unparalleled backup solution: Acronis Backup with our Dedicated Server hosting.</p>
                        <p class="ds-acr-desk">With Acronis, your data is in safe hands as it covers all bases, ensuring the safety of your files, databases, applications, and entire system configurations. It also enables swift recovery, minimizing downtime and ensuring business continuity.</p>
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
            <div class="col-lg-6 d-flex justify-content-end">
                <div class="sec-dt-acr-img">
                    <img loading="lazy" src="../assets/images/dedicated_server/Acronis_Backup_Solution.webp" alt="Acronis_Backup_Solution">
                </div>
            </div>
        </div>
    </div>
</section>



@endif

<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.testimonial_section') 
@include('template.'.$themeversion.'.faq-section')

<div class="dy-money-back-grnt head-tb-p-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dy-money-back-grnt-box text-center">
                            <h2>Your Email, Your Brand!</h2>
                            <p>Get a professional email with Google Workspace for your business.</p>
                            <a href="https://www.hostitsmart.com/email/google-workspace-india" title="I Want Google Workspace">I Want Google Workspace</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('template.'.$themeversion.'.two-hosting-add')




    @endsection
