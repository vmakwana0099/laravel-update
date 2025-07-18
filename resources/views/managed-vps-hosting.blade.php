@extends('layouts.app')
@section('content')
{{--
<pre>{{print_r($ProductsPackageData)}}</pre> --}}
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
    <section class="web-pln-box head-tb-p-40" id="managed-vps-hosting">
  <div class="container-fluid">
    <div class="shared-plan-bx-pd">
      <div class="section-heading">
        <h2 class="text_head text-center">Managed VPS Hosting Plans</h2>
        <p class="text-center">Choose Our VPS with KVM Virtualization for Ultimate Performance!</p>
        </div>
      <div class="row justify-content-center">
        @foreach ($ProductsPackageData as $elkey => $element)

          @php
            $popular_div_class = '';
            if($elkey == 1){
              $popular_div_class = 'shared-plan-most-popular';
            }
            $planName = $element->varTitle;
            $SpecificationData = explode("\n",$element->txtSpecification);
            if ($element->txtShortDescription == 'BEST SELLER') {
              $class_best_seller = 'best-seller-div';
            }else{
              $class_best_seller = ' ';
            }
          @endphp

        
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="shared-plan-box-main {{ $popular_div_class }}" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
            <div class="shared-pln-box">
              @if($elkey == 1)
                <div class="shared-most-popular-cnt">
                  MOST POPULAR
                </div>
              @endif
              <div class="shared-plan-price">
                <div class="shared-plan-nm">
                  {{$planName}}
                </div>
                <div class="shared-plan-cut-prc">
                  {{-- <span class="cut-price">₹840.00</span> --}}                  
                  @if(Config::get('Constant.sys_currency') == 'INR')
                    @if (isset($element->productpricing['monthly']) && isset($element->productpricing['annually']))
                      <span class="cut-price" id="oneyear-sale-price{{str_replace(' ', '', $planName)}}">
                        @if(isset($element->productpricing['monthly_renewal']))
                          {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly_renewal']}}
                        @else
                          {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly']}}
                        @endif
                      </span>
                    @endif
                  @endif
                  {{-- <span class="cut-prc-disc">Save 50%</span> --}}
                  <span class="cut-prc-disc" id="offer-discount-{{str_replace(' ', '', $planName)}}">
                    @php
                      if(isset($element->productpricing['monthly_renewal'])){
                          $percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly_renewal']) * 100), 0);
                      }else{
                          $percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly']) * 100), 0);
                      }
                    @endphp
                    Save {{$percentageOff}}%
                  </span>
                </div>
                <div class="shared-main-price">
                  {{-- ₹<span>420.00</span>/mo* --}}
                  ₹<span>{{$element->productpricing['annually'] + 220}}.00</span>/mo*
                </div>
                
                <div class="shared-plan-btn">
                  {{-- <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a> --}}
                  @if(isset($element->ButtonTextannually) && !empty($element->ButtonTextannually))
                   {!! $element->ButtonTextannually !!}
                  @endif
                </div>
                
                @if(isset($element->productpricing['monthly_renewal']))
                <div class="shared-plan-renew">
                  {{-- Renews at ₹{{ $element->productpricing['yearly_renewal_permonth'] }}/mo after 1 year. Cancel anytime. --}}
                  Renews at ₹{{ rtrim(rtrim(number_format($element->productpricing['yearly_renewal_permonth'], 2, '.', ''), '0'), '.') }}/mo after 1 year. Cancel anytime.

                </div>
                @endif
              </div>
              <div class="shared-plan-cnt">
                <ul>
                  @foreach ($SpecificationData as $key => $Specifica)
                    @php
                      $Specification = (trim($Specifica));
                    @endphp

                    @if(strtolower(trim($Specification)) == "1 vcpu core")
                      <div class="slide-toggle">
                        <li> <span><b>1</b> vCPU core</span></li>
                      </div>
                    @elseif(strtolower(trim($Specification)) == "4 gb ram")
                      <div class="slide-toggle">
                        <li> <span><b>4 GB</b> RAM</span></li>
                      </div>
                    @elseif(strtolower(trim($Specification)) == "50 gb ssd")
                      <div class="slide-toggle">
                        <li> <span><b>50GB</b> SSD</span></li>
                      </div>
                    @elseif(strtolower(trim($Specification)) == "1 dedicated ip")
                    <div class="slide-toggle">
                      <li> <span><b>1</b> Dedicated IP</span></li>
                    </div>
                    @else
                    <div class="slide-toggle">
                      <li> <span>{!!$Specification!!}</span></li>
                    </div>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</section>
    @include('template.'.$themeversion.'.testimonial_section')
    @include('template.'.$themeversion.'.30-day-moneyback') 
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
                            <h2>Want to Take Complete Charge of Your Server Hosting?</h2>
                            <p>Get Self-Managed VPS Hosting For Your Project</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="tech_exprt_right">
                            <a href="../servers/vps-hosting" title="Check Our Plans">Check Our Plans</a>
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
            <h2 class="text_head text-center">We Have Superior Managed VPS Hosting For You!</h2>
            </div>
            <div class="sup-vps-hstg-box">
                <div class="row justify-content-center">
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/Budget-Friendly-icon.webp" alt="Budget-Friendly-icon">
                            <p>Pocket-Friendly</p>
                        </div>
                    </div>  
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/Powerful-Security-icon.webp" alt="Powerful-Security-icon">
                            <p>Robust Security</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/Uptime-icon.webp" alt="Uptime-icon">
                            <p>99.9% Uptime</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/24-7-Support-icon.webp" alt="24-7-Support-icon">
                            <p>24/7 Support</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/Datacenter-icon.webp" alt="Datacenter-icon">
                            <p>India Datacenter</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="sup_vps_box_cnt">
                            <img src="../assets/images/vps_hosting/2X-Faster-Speed-icon.webp" alt="2X-Faster-Speed-icon">
                            <p>2X Faster Speed</p>
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
                <h2 class="text_head text-center">Self-Managed vs Fully Managed </h2>
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
                                        <th scope="row">Security Firewall Configuration & Management</th>
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
    
    <section class="vps-features head-tb-p-40" id="features">
        @if(!empty($FeaturesData) && count($FeaturesData) >0)
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="text_head">Managed VPS Features That Will Capture Your Admiration</h2>
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
    {{-- <section class="vps_hosting_prov_comp_main head-tb-p-40">
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
                                    <td>₹3470/mo</td>
                                    <td>₹7549/mo</td>
                                    <td>₹1699/mo</td>
                                    <td>₹999/mo</td>
                                    <td>₹2149/mo</td>
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
                                    <td>Managed</td>
                                    <td>Managed</td>
                                    <td>Managed</td>
                                    <td>Self-Managed</td>
                                    <td>Managed</td>
                                    <td>Managed</td>
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
                                <tr>
                                    <td>Management Cost</td>
                                    <td>Included</td>
                                    <td>Included</td>
                                    <td>₹5499/mo</td>
                                    <td>-</td>
                                    <td>Rs 5999/mo</td>
                                    <td>Rs 5999/mo</td>
                                </tr>
                                <tr>
                                    <td>Total Cost</td>
                                    <td>₹3470/mo</td>
                                    <td>₹7549/mo</td>
                                    <td>₹7198/mo</td>
                                    <td>₹999/mo (Self-Managed)</td>
                                    <td>₹8148/mo</td>
                                    <td>₹6998/mo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.help_section') 

<div class="dy-money-back-grnt head-tb-p-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dy-money-back-grnt-box text-center">
                            <h2>Want to Look Professional in Every Email?</h2>
                            <p>Get a custom email with Google Workspace for your business.</p>
                            <a href="https://www.hostitsmart.com/email/google-workspace-india" title="Boost With Google Workspace">Boost With Google Workspace</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('template.'.$themeversion.'.faq-section')
@include('template.'.$themeversion.'.two-hosting-add')
 
    @endsection