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
    <div class="banner-inner hosting-banner" style="background-image:url('{!! App\Helpers\resize_image::resize($ProductBanner->fkIntImgId,1920,494) !!}')">
        <div class="container">
            <div class="banner-content">
                <div class="banner-image" data-aos="zoom-in" data-aos-delay="100"></div>
                <h1 class="banner-title" data-aos="fade-up" data-aos-delay="200">{{$ProductBanner->varTitle}}</h1>
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
    @if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
    <div class="head-tb-p-40 win-vps-hstg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="linuxEnterpriseBtncontent" class="clearfix col-12 Plan_table_Nheading section-heading">
                        <h2 class="big_title text_head text-center " title="India Based Windows VPS Hosting" id="windows-vps-hosting">India’s Cheap Windows VPS Server Plans
                        </h2>
                        <p class="fw-5 text-center">Strong, Swift & Highly Secured Servers</p>
                    </div>
                    <div class="main-plan-add main-plan-windows-vps">
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
                        <div class="vps-plan-box">
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
                                    <span class="plan-price-r-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$element->productpricing['annually']}}<span class="vps-prc-mo">/mo</span>
                                </div>
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
                                        <span class="domain_tooltip">Select your preferred control panel from cPanel, Webuzo, or Plesk. Choose the ideal panel for your specific operating system needs!</span>
                                    </li>
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
        </div>
    </div>
</div>
</div>
@endif
</div>
<div class="g-suite-lists head-tb-p-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-heading">
                                <h2 class="text_head text-center">Why Windows VPS Hosting is the Perfect Choice <br>
                                For Your Business Needs?
                             </h2>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">1</span>
                                        <h4>Familiar and Easy-to-Use Interface</h4>
                                        <span>Windows VPS hosting offers a user-friendly GUI, making it ideal for users already familiar with Windows OS. This ease of navigation ensures smooth server management, even for beginners.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">2</span>
                                        <h4>Remote Desktop Access</h4>
                                        <span>With a Windows VPS server, you can effortlessly manage your server from anywhere using the built-in Remote Desktop Protocol (RDP). This protocol allows you to fully control your server, ensuring convenience and flexibility. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">3</span>
                                        <h4>Support for Windows-Specific Applications</h4>
                                        <span>Windows VPS is optimized for applications like ASP.NET, MSSQL, and other Windows-based frameworks, making it the perfect choice for businesses relying on these technologies. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">4</span>
                                        <h4>Scalability and Flexibility</h4>
                                        <span>As your business grows, Windows VPS lets you upgrade your server resources, such as RAM, storage, and CPU, without downtime or migration hassles. </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">5</span>
                                        <h4>Effortless Integration with Microsoft Ecosystem</h4>
                                        <span>The Windows VPS server integrates seamlessly with Microsoft tools like Office 365, SharePoint, and OneDrive, enhancing collaboration and productivity for businesses that rely on these solutions. </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <span class="list-num">6</span>
                                        <h4>Integrated Security Features</h4>
                                        <span>Windows VPS has built-in tools like Windows Defender, advanced firewalls, and regular updates, ensuring top-notch protection against threats and vulnerabilities.
                                        </span>
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">7</span>
                                        <h4>Affordable Licensing for Larger Setups </h4>
                                        <span>Windows licensing offers volume discounts and enterprise-level features, making it a more budget-friendly option than Linux for larger setups.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">8</span>
                                        <h4>Easy Installation</h4>
                                        <span>Windows uses an easy-to-follow software installer, while Linux relies on more advanced package managers. </span>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
    @include('template.'.$themeversion.'.30-day-moneyback') 

@if(!empty($FeaturesData) && count($FeaturesData) >0)
<section class="web_panel_avail_main head-tb-p-40">
    <div class="container">
        <div class="wb-panel-avail-box windows-hstg-plns-pnl">
            <div class="row">
                <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                    <div class="wp-pnl-first">
                        <div class="wp-pml-first-img">
                            <img class="img-fluid" loading="lazy" src="../assets/images/windows_vps_hosting/Control_Panel_for_Windows_VPS.webp" alt="Control_Panel_for_Windows_VPS">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                    <div class="section-heading">
                        <h2 class="text_head">Get Plesk Control Panel For Your Windows VPS Hosting</h2>
                        <p class="text_cnt">Experience unparalleled efficiency and performance with industry's best control panel. Select one today according to your needs. </p>
                    </div>
                    <div class="wb-pnl-avl-left">
                        <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link wb-pnl-btn active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <img loading="lazy" class="img-fluid web-pnl-tittle-icon" src="../assets/images/windows_vps_hosting/Web_Admin_Edition.webp" alt="Web_Admin_Edition">Web Admin Edition
                            </a>
                            <a class="nav-link wb-pnl-btn" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                <img loading="lazy" class="img-fluid web-pnl-tittle-icon" src="../assets/images/windows_vps_hosting/Web_Pro_Edition.webp" alt="Web_Pro_Edition">Web Pro Edition
                            </a>
                            <a class="nav-link wb-pnl-btn" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <img loading="lazy" class="img-fluid web-pnl-tittle-icon" src="../assets/images/windows_vps_hosting/Web_Host_Edition.webp" alt="Web_Host_Edition">Web Host Edition
                            </a>
                        </div>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="wb-pnl-ul">
                                <div class="wb-pnl-tp-cnt">
                                    <ul>
                                        <div class="win-hstg-tittle">
                                            <h3>₹1150<span class="win-hstg-price-mo">/mo</span></h3>
                                        </div>
                                        <li><span class="wb-pnl-cnt-icon">Manage up to 10 domains.</li>
                                        <li><span class="wb-pnl-cnt-icon">Plesk mobile manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Security Core with ModSecurity Rules</li>
                                        <li><span class="wb-pnl-cnt-icon">Let's Encrypt SSL Certificate</li>
                                        <li><span class="wb-pnl-cnt-icon">Power-user view (Server + Site Admin)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="wb-pnl-ul">
                                <div class="wb-pnl-tp-cnt">
                                    <ul>
                                        <div class="win-hstg-tittle">
                                            <h3>₹1700<span class="win-hstg-price-mo">/mo</span></h3>
                                        </div>
                                        <li><span class="wb-pnl-cnt-icon">Manage up to 30 domains.</li>
                                        <li><span class="wb-pnl-cnt-icon">Subscription management</li>
                                        <li><span class="wb-pnl-cnt-icon">Account management</li>
                                        <li><span class="wb-pnl-cnt-icon">Cgroups Manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Service Provider View</li>
                                        <li><span class="wb-pnl-cnt-icon">Restricted Mode</li>
                                        <li><span class="wb-pnl-cnt-icon">WP Toolkit</li>
                                        <li><span class="wb-pnl-cnt-icon">Plesk mobile manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Offers DNSSEC</li>
                                        <li><span class="wb-pnl-cnt-icon">Let's Encrypt SSL Certificate</li>
                                        <li><span class="wb-pnl-cnt-icon">Power-user view (Server + Site Admin)</li>
                                        <li><span class="wb-pnl-cnt-icon">PostgreSQL and MSSQL management modules</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <div class="wb-pnl-ul">
                                <div class="wb-pnl-tp-cnt">
                                    <ul>
                                        <div class="win-hstg-tittle">
                                            <h3>₹3100<span class="win-hstg-price-mo">/mo</span></h3>
                                        </div>
                                        <li><span class="wb-pnl-cnt-icon">Unlimited Domains</li>
                                        <li><span class="wb-pnl-cnt-icon">Reseller management</li>
                                        <li><span class="wb-pnl-cnt-icon">Subscription management</li>
                                        <li><span class="wb-pnl-cnt-icon">Account management</li>
                                        <li><span class="wb-pnl-cnt-icon">Cgroups Manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Power-user View</li>
                                        <li><span class="wb-pnl-cnt-icon">Service Provider View</li>
                                        <li><span class="wb-pnl-cnt-icon">Restricted Mode</li>
                                        <li><span class="wb-pnl-cnt-icon">WP Toolkit</li>
                                        <li><span class="wb-pnl-cnt-icon">Plesk mobile manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Offers DNSSEC</li>
                                        <li><span class="wb-pnl-cnt-icon">Let's Encrypt SSL Certificate</li>
                                        <li><span class="wb-pnl-cnt-icon">PostgreSQL and MSSQL management modules</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section class="whdo-win-vps-inc head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="text_head">Explore a host of Powerful Features with all our Windows VPS Plans</h2>
                    <p>Experience new heights with our cheap Windows VPS Hosting plans. Discover powerful features to unleash your online project’s full potential today.</p>
                    <p></p>
                </div>
                <div class="wb-pnl-ul">
                    <div class="wb-pnl-tp-cnt">
                        <ul>
                            <li><span class="wb-pnl-cnt-icon">Migration Assistance</li>
                            <li><span class="wb-pnl-cnt-icon">Server firewall setup</li>
                            <li><span class="wb-pnl-cnt-icon">KVM Virtualization</li>
                            <li><span class="wb-pnl-cnt-icon">RAID 6 Disk arrays</li>
                            <li><span class="wb-pnl-cnt-icon">Full Remote Desktop Access</li>
                            <li><span class="wb-pnl-cnt-icon">Unlimited SQL Databases</li>
                            <li><span class="wb-pnl-cnt-icon">Windows Server 2019/2022</li>
                            <li><span class="wb-pnl-cnt-icon">Supports all MVC Frameworks</li>
                            <li><span class="wb-pnl-cnt-icon">DDR4 RAM</li>
                            <li><span class="wb-pnl-cnt-icon">Control Panel Installation</li>
                            <li><span class="wb-pnl-cnt-icon">Latest ASP.Net, .Net Core, PHP</li>
                            <li><span class="wb-pnl-cnt-icon">Server Resource Upgradation Support</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-md-flex justify-content-end">
                <div class="wp-pnl-first">
                    <div class="wp-pml-first-img">
                        <img class="img-fluid" loading="lazy" src="../assets/images/windows_vps_hosting/Windows_VPS_Inclusion.webp" alt="Windows_VPS_Inclusion">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tablse section start -->

<div class="g-apps-features-box head-tb-p-40" id="allFeaturesTable">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Explore Our Windows Hosting Distributions</h2>
            <!-- <p class="text-center">From Easy document creation to efficient communication, Discover a comprehensive suite of powerful apps within Google Workspace for businesses. This suite is designed for seamless collaboration and productivity with teams across devices.</p> -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="g-apps-tbl table-responsive">
                    <table class="table g-apps-ftrs-tbl table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">Core Aspects</th>
                                <th class="text-center" scope="col">Windows Server 2019</th>
                                <th class="text-center" scope="col">Windows Server 2022</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="gmail-icon-main">
                                    <div class="gmail-icon">
                                        <!-- <img src="../assets/img/google_workspace/gmail-icon.png" alt=""></div> -->
                                        Automatic Windows Admin Center Updates
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Customizable Columns for VM Information
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Detachable Events Overview Screen
                                </th>
                                <td>Configurable</td>
                                <td>Built-in</td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div>Configurable Destination Virtual Switch
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th>Event Workspace to track data</th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Automated Extension Lifecycle Management
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>                                                                                                
                        </tbody>
                    </table>
                    <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_01" class="show-more-btn">Security Features</button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Hardware-enforced Stack Protection
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> TLS
                                </th>
                                <td>Supports 1.2</td>
                                <td>1.3 Is Enabled by Default</td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Secured-core server
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr>
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Hypervisor-based code integrity
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_02" class="show-more-btn">Hybrid Cloud Features</button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Azure Arc
                                </th>
                                <td>supported</td>
                                <td>1.3 Is Enabled by Default</td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Storage Migration Service
                                </th>
                                <td>Supported</td>
                                <td>Deployment and Management Is Simplified</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_03" class="show-more-btn">Platform Features</button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Uncompressed Image Size
                                </th>
                                <td>Approx. 3.7 GB</td>
                                <td>Approx. 2.7 GB</td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Virtualized Time Zone
                                </th>
                                <td>Mirrors Host Timezone</td>
                                <td>Configurable Within Container</td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Group Managed Service Accounts (gMSA) Requires Domain Joining
                                </th>
                                <td><i class="fa-solid fa-check"></i></td>                                
                                <td><i class="fa-solid fa-minus"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> DSR Routing
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>

                     <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_03" class="show-more-btn">Know About Kubernetes Experience</button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> HostProcess containers
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Multiple Subnets Per Windows Worker Node
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="g-apps-show-more-btn">
                        <button id="showMoreBtn_03" class="show-more-btn">Upgraded Hyper V Manager</button>
                    </div>
                    <table class="table g-apps-ftrs-tbl table-bordered table-responsive">
                        <tbody>
                           <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Action Bar
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> New Partitioning Tool
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Live Storage Migration
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Running Workloads Between Server
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> Affinity and Anti-Affinity Rules
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                            <tr class="first-rows">
                                <th class="icon-blnk">
                                    <div class="icon-blnk-dv"></div> VM Clones
                                </th>
                                <td><i class="fa-solid fa-minus"></i></td>
                                <td><i class="fa-solid fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tablse section end -->

<section class="sup-vps-hstg-main head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">We Have Superior VPS Hosting For You!</h2>
        </div>
        <div class="sup-vps-hstg-box">
            <div class="row justify-content-center">
                <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                    <div class="sup_vps_box_cnt">
                        <img loading="lazy" src="../assets/images/vps_hosting/Budget-Friendly-icon.webp" alt="Budget-Friendly-icon">
                        <h3>Pocket-Friendly</h3>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                    <div class="sup_vps_box_cnt">
                        <img loading="lazy" src="../assets/images/vps_hosting/Powerful-Security-icon.webp" alt="Powerful-Security-icon">
                        <h3>Robust Security</h3>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                    <div class="sup_vps_box_cnt">
                        <img loading="lazy" src="../assets/images/vps_hosting/Uptime-icon.webp" alt="Uptime-icon">
                        <h3>99.9% Uptime</h3>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                    <div class="sup_vps_box_cnt">
                        <img loading="lazy" src="../assets/images/vps_hosting/24-7-Support-icon.webp" alt="24-7-Support-icon">
                        <h3>24/7 Support</h3>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                    <div class="sup_vps_box_cnt">
                        <img loading="lazy" src="../assets/images/vps_hosting/Datacenter-icon.webp" alt="Datacenter-icon">
                        <h3>India Datacenter</h3>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                    <div class="sup_vps_box_cnt">
                        <img loading="lazy" src="../assets/images/vps_hosting/2X-Faster-Speed-icon.webp" alt="2X-Faster-Speed-icon">
                        <h3>2X Faster Speed</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sec-dt-acr-bkp head-tb-p-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="sec-dt-acr-img">
                    <img class="img-fluid" loading="lazy" src="../assets/images/windows_vps_hosting/Acronis_Backup_Solution.webp" alt="Acronis_Backup_Solution">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sec-dt-acr-cnt">
                    <div class="section-heading">
                        <h2 class="text_head">Secure Your Data with Acronis Backup Solution</h2>
                        <p>Enjoy peace of mind knowing your valuable data is securely backed up with our world-class backup solution tailored to suit your needs in our Windows VPS server hosting.</p>
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
<section class="disc-full-power head-tb-p-40">
    <div class="container">
        <div class="section-heading disc-power-head">
            <h2 class="text_head">Discover When to Choose our<br>Windows VPS to Unleash its Full Power</h2>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div id="accordion-box" class="accordion faq-wrap">
                    <div class="row align-items-center">

                        <div class="col-md-12 col-lg-12">
                            <div id="accordion-box" class="accordion faq-wrap">

                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-toggle="collapse" href="#box0" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Hosting Your Website</h3>
                                    </a>
                                    <div id="box0" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Choosing our Windows VPS will transform website hosting. The Windows OS combines flexibility and affordability with the reliability and user-friendliness of the servers. We will ensure your website runs smoothly with lightning-fast performance, seamless compatibility and robust security measures.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-toggle="collapse" href="#box1" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">To Run eCommerce Platforms</h3>
                                    </a>
                                    <div id="box1" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Our Windows VPS offers unmatched performance, scalability, seamless compatibility, secure transactions, a proven user interface management with full control over the server, and optimized performance based on your needs to run popular eCommerce applications. The best part is the security features that help protecting against security threats.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-toggle="collapse" href="#box2" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Hosting Your Application</h3>
                                    </a>
                                    <div id="box2" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Our efficient and reliable Windows VPS Hosting solution is designed to deliver excellent lightning-fast performance, robust security, and seamless compatibility for application hosting with guaranteed uptime, ensuring that your application always remains accessible to users without interruptions.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-toggle="collapse" href="#box3" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For RD Browsing</h3>
                                    </a>
                                    <div id="box3" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>A Windows VPS is an excellent choice for Remote Desktop (RD) browsing for several reasons. It offers robust performance, minimum latency, and stability, ensuring smooth and uninterrupted browsing experiences with comprehensive security features, making it an ideal solution for individuals and businesses.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-toggle="collapse" href="#box4" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Data storage</h3>
                                    </a>
                                    <div id="box4" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>With its robust file management system and ample storage capacity, we offer Windows VPS with robust infrastructure as a reliable and secure solution for your critical files and data to deliver excellent performance. You will get advanced security measures, including firewalls and encryption protocols.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-toggle="collapse" href="#box5" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Using Collaboration Tools</h3>
                                    </a>
                                    <div id="box5" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>It is easy to use Microsoft SharePoint, Microsoft Teams, and other PMS through a Windows VPS. It streamlines project management and enhances collaboration. With Windows VPS' flexibility and scalability, you can efficiently manage any project. Share documents, collaborate, and coordinate tasks.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-toggle="collapse" href="#box6" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Backup</h3>
                                    </a>
                                    <div id="box6" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>With our secured Windows VPS hosting solution, you can store your valuable data securely as a backup and easily access it whenever needed. With that, you won't have to worry about data loss or system failure. Businesses can rely entirely on our server to protect their precious data & enjoy full peace of mind.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-toggle="collapse" href="#box7" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Running CRM</h3>
                                    </a>
                                    <div id="box7" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Many CRM software solutions are designed to run specifically on Windows operating systems. Our Windows VPS Server offers top-notch performance and reliability to run CRM softwares. It offers reliable performance and smooth functionality, ensuring that your CRM system operates smoothly without lag or downtime.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="disc-full-power-img">
                    
                    <img class="img-fluid" loading="lazy" src="../assets/images/windows_vps_hosting/When_to_Choose_Windows_VPS.webp" alt="When_to_Choose_Windows_VPS">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="self-managed-vps-assist whdo-win-vps-inc head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="wp-pnl-first">
                    <div class="wp-pml-first-img">
                        <img class="img-fluid" loading="lazy" src="../assets/images/windows_vps_hosting/Self_Managed_VPS.webp" alt="Self_Managed_VPS">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="text_head">Despite purchasing a self-managed VPS, we continue to assist in the following</h2>
                </div>
                <div class="wb-pnl-ul">
                    <div class="wb-pnl-tp-cnt">
                        <ul>
                            <li><span class="wb-pnl-cnt-icon">Server Provisioning And Setup</li>
                            <li><span class="wb-pnl-cnt-icon">Hardware Related Resolutions</li>
                            <li><span class="wb-pnl-cnt-icon">Control Panel Installation</li>
                            <li><span class="wb-pnl-cnt-icon">Server Resource Upgradation</li>
                            <li><span class="wb-pnl-cnt-icon">Security Firewall Setup</li>
                            <li><span class="wb-pnl-cnt-icon">Standard Support</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(!empty($FeaturesData) && count($FeaturesData) >0)
<div class="vps-features" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <div class="section-heading">
                <h2 class="text_head text-center" data-aos="fade-up">Features of Our Windows VPS Server</h2>
                </div>
                @php
                $featureMainDivClass;
                $featureIconDivClass;
                $featureMainDivClass="features-start d-md-block";
                $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                @endphp
                <div class="{{$featureMainDivClass}}">
                        <div class="row">
                            <div class="feature-ul d-flex flex-wrap">
                                @foreach($FeaturesData as $Features)
                                    <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                        <div class="content-main align-self-start">
                                            <div class="{{$featureIconDivClass}}">
                                                <img loading="lazy" class="win-vps-features-icon" src="../assets/images/windows_vps_hosting/{{$Features->varIconClass}}.svg" alt="{{$Features->varIconClass}}">
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
@endif
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
                                <th scope="col"><img loading="lazy" src="../assets/images/windows_vps_hosting/logo.webp" alt="logo"></th>
                                <th scope="col"><img loading="lazy" src="../assets/images/windows_vps_hosting/hostingraja.webp" alt="hostingraja"></th>
                                <th scope="col"><img loading="lazy" src="../assets/images/windows_vps_hosting/square_brothers.webp" alt="square_brothers"></th>
                                <th scope="col"><img loading="lazy" src="../assets/images/windows_vps_hosting/everdata.webp" alt="everdata"></th>
                                <th scope="col"><img loading="lazy" src="../assets/images/windows_vps_hosting/godaddy.webp" alt="godaddy"></th>
                                <th scope="col"><img loading="lazy" src="../assets/images/windows_vps_hosting/milesweb.webp" alt="milesweb"></th>
                            </tr>
                        </thead>
                        <tbody class="vps-hstg-prv-body">
                            <tr>
                                <td>Monthly Pricing</td>
                                <td>₹1300/mo</td>
                                <td>₹2299/mo</td>
                                <td>₹1399/mo</td>
                                <td>₹1099/mo</td>
                                <td>₹2849/mo</td>
                                <td>₹1400/mo</td>
                            </tr>
                            <tr>
                                <td>CPU</td>
                                <td>2vCPU</td>
                                <td>2vCPU</td>
                                <td>2 CPU</td>
                                <td>2 vCPU</td>
                                <td>2 vCPU</td>
                                <td>1 vCPU</td>
                            </tr>
                            <tr>
                                <td>RAM</td>
                                <td>2 GB</td>
                                <td>2 GB</td>
                                <td>4 GB</td>
                                <td>4 GB</td>
                                <td>4 GB</td>
                                <td>4 GB</td>
                            </tr>
                            <tr>
                                <td>Storage</td>
                                <td>40GB SSD</td>
                                <td>70GB NVMe SSD</td>
                                <td>50GB SSD</td>
                                <td>40GB SSD</td>
                                <td>100GB SSD</td>
                                <td>50GB SSD</td>
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
                                <td>Hyper-V</td>
                                <td>XEN</td>
                                <td>-</td>
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
@endsection