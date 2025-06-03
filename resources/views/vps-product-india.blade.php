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
            <h2 class="text_head text-center">Check Our VPS Server Price in India For You</h2>
            <p class="text_cnt text-center">Choose & buy a VPS in India according to your requirements!</p>
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

    <section style="background: #F7F7FF;" class="ser-lctn-main head-tb-p-40">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6">
                    <div class="ser-lctn-img">
                        <img src="/assets/images/vps_hosting/server-location-map.webp" alt="server-location-map">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ser-lctn-cnt">
                        <div class="section-heading">
                        <h2 class="text_head">
                        Powered by Local Indian Servers For Faster Access
                        </h2>
                        <p>You will get VPS hosting in India hosted in a Tier 3 data center that offers better speed, lower latency, and reliable local performance for your Indian users.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="g-suite-lists head-tb-p-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-heading">
                                <h2 class="text_head text-center">What Can You Do with Our Indian VPS Server Hosting? </h2>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">1</span>
                                        <h3>For Hosting High-Traffic Websites</h3>
                                        <span>Our Indian VPS can easily handle heavy website traffic without slowing down, so your visitors always get a fast and smooth experience, even on your website's busiest days.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">2</span>
                                        <h3>For Forex Trading</h3>
                                        <span>If you have Asian brokers, you can trade faster and smarter with low-latency VPS servers located in India. Over 630+ traders are trading smartly with our <a href="https://www.hostitsmart.com/servers/forex-vps-hosting"><strong>Forex VPS server</strong></a>.</span>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">3</span>
                                        <h3>For Running Web Applications</h3>
                                        <span>With our VPS server in India, you can effectively host your web apps smoothly with full control, high speed, and better security, perfectly built for businesses, tools, or custom platforms. In such cases, businesses prefer <a href="https://www.hostitsmart.com/servers/windows-vps-hosting"><strong>Windows VPS hosting</strong></a>.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">4</span>
                                        <h3>As Personal Email Server</h3>
                                        <span>You can use our VPS server to host your email accounts without relying on third-party providers, which would be private, secure, and fully in your control. Today, over 170 clients manage their emails smartly from our amazing VPS.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">5</span>
                                        <h3>As Personal Database Server</h3>
                                        <span>You can use our Indian VPS server to host your database with complete security, fully fast, and completely under your control, which is perfect for storing website data, apps, or business records like customer records or financial transactions.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <span class="list-num">6</span>
                                        
                                        <h3>For Developing an API</h3>
                                        <span>You can easily build, test, and run your APIs with full control, speed, and security on our VPS hosting, ensuring high availability, fast responses, full customization, and robust security for your API endpoints.</span>
                                        
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">7</span>
                                        <h3>As Personal Web Server</h3>
                                        <span>You can host your website or web apps without sharing resources with complete control, amazing performance, and faster load times at the best VPS server price in India to manage your projects securely at a low cost.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">8</span>
                                        <h3>For Web Scraping or Running Bots</h3>
                                        <span>If you want to collect data from websites, monitor changes, or run automated scripts, you can use our server to run your bots or scrape data smoothly without interruptions, with better speed, and full control. Over 65+ clients are using our VPS for web scraping.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">9</span>
                                        <h3>For Development & Testing</h3>
                                        <span>We know developers require a safe space to test their code before deploying it to a live website or application. For that, you can host your apps or websites on our VPS hosting to build, test, and run them in a secure, private space without affecting your live setup.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">10</span>
                                        <h3>For Running an Online Store</h3>
                                        <span>You can buy a VPS to host your eCommerce website smoothly. It offers high speed, better security, and full control, perfect for handling high traffic and transactions without lag. We are proud to help 35+ events and eCommerce websites achieve powerful performance.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">11</span>
                                        
                                        <h3>Using VPS as Image Server</h3>
                                        <span>Many graphic designers or photographers store many images for backup or sharing. You can buy our VPS to store and serve images for your project, making it easier to access and serve images instantly from anywhere.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">12</span>
                                        <h3>For Training & Deploying AI Models</h3>
                                        <span>AI & ML models take too much computing power, and training them on a PC can be slow, and it may even crash. To run & test those models smoothly, you can use our Indian VPS. Till now, our VPS has helped 10 clients deploy AI models.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">13</span>
                                        <h3>For Backup Storage</h3>
                                        <span>Data loss can happen anytime due to hardware failure, cyberattacks, accidental deletions, or system crashes. To avoid that, you can use our VPS to safely store your website files, databases, or business data, keeping it secure and always accessible when needed.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">14</span>
                                        <h3>As Personal Cloud Storage</h3>
                                        <span>If you don’t want to rely on third-party cloud services like Google Drive or Dropbox and want complete control over your files, you can buy VPS hosting to store your files, photos, and backups securely in one place and access them anytime, from anywhere.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">15</span>
                                        <h3>For Full Root Access</h3>
                                        <span>If you want full control, like being the boss of your server, where you can install what you want, change settings, and run things your way, then you can use our VPS server, where you will get full root access.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">16</span>
                                        <h3>To Get Remote Access</h3>
                                        <span>If you don’t want your data to be tied to just one device. You can use our VPS, where your data is stored on a remote server, which you can access anytime from anywhere, just like using your office computer from home.</span>
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
                <h2 class="text-center text_head">Amazing Features You Can Expect With Our VPS in India!</h2>
                {{-- <p class="text_cnt text-center">Our Cheap VPS offering doesn’t mean that you have to sacrifice the quality!</p> --}}
                </div>
                <div class="fp-list">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>Budget-friendly Indian pricing</h3></li>
                                <li><h3>Tier-3 Indian Datacenter</h3></li>                                
                                <li><h3>ISO/IEC certified infrastructure</h3></li>
                                <li><h3>Enterprise-grade data center facility</h3></li>
                            </ul>
                        </div>
                        
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>High-level physical security in datacenter</h3></li>
                                <li><h3>Latest Server Processor</h3></li>
                                <li><h3>RAID6 and RAID10 Storage</h3></li>
                                <li><h3>No overselling of servers</h3></li>                                
                                <li><h3>Low latency with 2X faster speed</h3></li>                                
                                {{-- <li style="list-style-type: none;">View Detailed Features</li>                                 --}}
                            </ul>
                        </div>
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>24/7 India-Based Support</h3></li>
                                <li><h3>99.99% uptime guarantee</h3></li>
                                <li><h3>Secured with DDoS protection</h3></li>
                                <li><h3>High security using custom firewall rules</h3></li>
                            </ul>
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
                            <h2>Are you Looking For Managed VPS hosting in India?</h2>
                            <p>Leave all the technical hardwork to us!</p>
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
                <p class="text_cnt text-center">We have stated a clear breakdown of support & responsibilities for both types.</p>
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
                                        Many Indian IT experts praised Webuzo as a ‘perfect alternative to cPanel’ where you can easily install, set up, and manage apps without any trouble at a cost-effective price.
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
                                    Many developers and resellers in India love using DirectAdmin because it has a lightweight, stable, easy-to-use interface and has cheap pricing.
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
                                        cPanel is the most popular panel among individuals and businesses and is widely used in India to manage web hosting accounts that work well with the Linux OS.
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
                                        Some Indian web developers and digital agencies prefer Plesk for its cleaner UI and integrated tools, especially those with Windows requirements.
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
                    <img class="img-fluid" src="../assets/images/vps_hosting/Acronis_Backup_Solution-2.webp" alt="Acronis_Backup_Solution-2">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sec-dt-acr-cnt">
                    <div class="section-heading">
                        <h2 class="text_head">You Can Secure Your Data With Acronis Backup Solution</h2>
                        <p>With our Indian VPS, we offer the world’s popular backup solution that secures your valuable data!</p>
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
   
    
    <!-- <section class="vps-features  head-tb-p-40" id="features">
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
    </section> -->
    <section class="vps_hosting_prov_comp_main head-tb-p-40">
        <div class="container">
            <div class="section-heading text-center">
                <h2 class="text_head">Don’t Believe Us Yet?</h2>
                <p>Let’s see where our VPS server pricing & features stand among the competition</p>
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
                            <a href="https://www.hostitsmart.com/email/google-workspace-india" title="I Need Google Workspace">I Want Google Workspace</a>
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