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

    <div class="vpsplan_slider_div dedicated-plan-main-div vps-page-new-desg">
        <div class="container">
            <div class="row">
                 <div class="col-sm-12">
                <div class="cms">
                    @php if($ProductBanner->id == 8){ @endphp
                    <h4 class="text-center green_title f_weight_500" title="Quality hosting does not mean elephantine costs. Not with our plans at least.">Quality hosting does not mean elephantine costs. Not with our plans at least.</h4>
                    @php } else if($ProductBanner->id == 4){ @endphp
                    <h4 class="text-center green_title f_weight_500" title="Wordpress Beginner or a full grown business, we have something for you, always!">Wordpress Beginner or a full grown business, we have something for you, always!</h4>
                    <span>Wordpress is amazing!. But when you have a ton to do about your business, you seldom will have the time to understand tiny technicalities of running your wordpress site. That's where managed Wordpress hosting comes into the frame. Regular back up, uptime maintenance, speed, scalability, security, literally everything - is taken care of, while you put your efforts into growing your business. 
                    </span>
                    @php } else { @endphp
                    <h4 class="text-center blue_title f_weight_500" title="Choose your VPS Hosting Plan." id="drageforwhatsnew">Choose your VPS Hosting Plan.</h4>
                    @php } @endphp
                </div>
                </div>
                
                <div class="clearfix"></div>
                <br>

                <div class="aos-init clearfix col-12" data-aos="fade-up" data-aos-delay="600" id=''>
                    <input type="checkbox" name="vpspos" value="vpspos" id="P" style="display: none;">
                    <ul class="nav nav-pills nav-vps-hosting nav-vps-hosting-wl">

                        <li><a  class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            Standard </a></li>

                        <li><a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Enterprise </a></li>
                    </ul>
                </div>

                <div class="tab-content tab-content-new-desg">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div id="linuxStandardcontent" class="clearfix col-12">
                            <div class="text">Host IT Smart’s Standard Linux VPS Hosting is OpenVZ Virtualization, a lightweight container. The standard version is the best option for start up websites built in PHP, HTML, and Wordpress. Ideal for small to medium-sized businesses. OpenVZ offers features of Full root access and freedom of installing required modules as compared to Shared hosting.  It ensures optimal utilization of resources and is easy to configure.</div>
                            <div class="text">features of Full root access and freedom of installing required modules as compared to Shared hosting.  It ensures optimal utilization of resources and is easy to configure.</div>
                        </div>
                        @php
                            // echo '<pre>';print_r($ProductsPackageData);exit; 
                            $thArr=["NAME","CPU","RAM","STORAGE","IP","Bandwidth","Price"]; 
                        @endphp
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table dedicatedserver-pricing-table">
                                <thead class="gradient-bg text-white">
                                    <tr>
                                        <th>{{ $thArr["0"] }}</th>
                                        <th>{{ $thArr["1"] }}</th>
                                        <th>{{ $thArr["2"] }}</th>
                                        <th>{{ $thArr["3"] }}</th>
                                        <th>{{ $thArr["4"] }}</th>
                                        <th>{{ $thArr["5"] }}</th>
                                        <th>{{ $thArr["6"] }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ProductsPackageData as $elkey => $element)
                                        @php
                                            $linuxPlansArr=[394,395,396,397,398,399,400,401];
                                        @endphp
                                        @if (in_array($element->fkWhmcsProduct, $linuxPlansArr))
                                            @php
                                                $planName = $element->varTitle; 
                                                $SpecificationData = explode("\n",$element->txtSpecification); 
                                            @endphp
                                            <tr class="dedicatedserver-pricing-row gray-light-bg">
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
                                                <td data-value="Price" class="text-cstm-clr">
                                                    <p class="mb-0">
                                                        <span class="price"><i class="fa fa-inr"></i>{{$element->productpricing['triennially']}}<span>/mo*</span></span>
                                                        <span class="pricing-onsale d-none">
                                                            On sale - 
                                                            <span class="badge color-3 color-3-bg line-through">{{$element->intOldPriceThreeYearINR}}
                                                            </span>
                                                        </span>
                                                    </p>
                                                </td>
                                                @elseif(Config::get('Constant.sys_currency') == 'USD')
                                                <td data-value="Price" class="text-cstm-clr">
                                                    <p class="mb-0">
                                                        <span class="price"><i class="fa fa-usd"></i>{{$element->productpricing['triennially']}}<span>/mo*</span></span>
                                                        <span class="pricing-onsale d-none">
                                                            On sale - 
                                                            <span class="badge color-3 color-3-bg line-through">{{$element->intOldPriceThreeYearUSD}}
                                                            </span>
                                                        </span>
                                                    </p>
                                                </td>
                                                @endif

                                                <td>
                                                    {!! $element->ButtonTexttriennially !!}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div id="linuxEnterpriseBtncontent" class="clearfix col-12">
                            <div class="text">The Enterprise VPS is built entirely on KVM virtualization, a robust, fully independent, and most advanced virtualization technology. Host IT Smart Enterprise Servers are designed with higher-end, super-fast enterprise hardware which is best in the market. It is not only a Kernel-based Virtualization that allows Kernel updates, but it also provides superior privacy and complete resource allocation to each virtual machine.</div>
                            <div class="text">We at Host IT Smart are continuously on the lookout for new technologies, which is why we provide the most recent operating system in our Enterprise plans.</div>
                        </div>
                        @php
                            // echo '<pre>';print_r($ProductsPackageData);exit; 
                            $thArr=["NAME","CPU","RAM","STORAGE","IP","Bandwidth","Price"]; 
                        @endphp
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table dedicatedserver-pricing-table">
                                <thead class="gradient-bg text-white">
                                    <tr>
                                        <th>{{ $thArr["0"] }}</th>
                                        <th>{{ $thArr["1"] }}</th>
                                        <th>{{ $thArr["2"] }}</th>
                                        <th>{{ $thArr["3"] }}</th>
                                        <th>{{ $thArr["4"] }}</th>
                                        <th>{{ $thArr["5"] }}</th>
                                        <th>{{ $thArr["6"] }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ProductsPackageData as $elkey => $element)
                                        @php
                                            $linuxPlansArr=[288,289,290,291,292,293,294,295];
                                        @endphp
                                        @if (in_array($element->fkWhmcsProduct, $linuxPlansArr))
                                            @php
                                                $planName = $element->varTitle; 
                                                $SpecificationData = explode("\n",$element->txtSpecification); 
                                            @endphp
                                            <tr class="dedicatedserver-pricing-row gray-light-bg">
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
                                                <td data-value="Price" class="text-cstm-clr">
                                                    <p class="mb-0">
                                                        <span class="price"><i class="fa fa-inr"></i>{{$element->productpricing['triennially']}}<span>/mo*</span></span>
                                                        <span class="pricing-onsale d-none">
                                                            On sale - 
                                                            <span class="badge color-3 color-3-bg line-through">{{$element->intOldPriceThreeYearINR}}
                                                            </span>
                                                        </span>
                                                    </p>
                                                </td>
                                                @elseif(Config::get('Constant.sys_currency') == 'USD')
                                                <td data-value="Price" class="text-cstm-clr">
                                                    <p class="mb-0">
                                                        <span class="price"><i class="fa fa-usd"></i>{{$element->productpricing['triennially']}}<span>/mo*</span></span>
                                                        <span class="pricing-onsale d-none">
                                                            On sale - 
                                                            <span class="badge color-3 color-3-bg line-through">{{$element->intOldPriceThreeYearUSD}}
                                                            </span>
                                                        </span>
                                                    </p>
                                                </td>
                                                @endif

                                                <td>
                                                    {!! $element->ButtonTexttriennially !!}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="vps-new-description">
<div class="aws-content aws-content-vps-new" id="whatsnewloadcontentdiv">
    <div class="aws-managed-services">  
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center vps-new-txtclr aos-animate aos-init">Technical Features/Improvements:</h2>
                </div>
            </div>
                <div class="aws-para aos-animate aos-init">
                    <br/>
                    <div class="left aos-animate aos-init">
                    <div class="points">
                    <div class="vps-new-content d-md-block">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="vnc-des">
                                <div class="vnc-des-image-one"></div>
                                <p>Super Performing Enterprise-Grade Hardware.</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="vnc-des">
                                <div class="vnc-des-image-two"></div>
                                <p>2X speed with Enterprise SAS SSD</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="vnc-des">
                                <div class="vnc-des-image-three"></div>
                                <p>2X16 Core Xeon Gold Processor ( Latest in the market )</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="vnc-des">
                                <div class="vnc-des-image-five"></div>
                                <p>Hosted on Tier 4 Indian DataCenter</p>
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
<!-- E New Featured content -->
</div>

@php if($ProductBanner->id == '25') {  @endphp 
<div class="vpsconfigdiv_main vpsplan_slider_div dedicated-plan-main-div" id="vpsconfigdiv" style="display:none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="dedicated-head">
                        <h4 id="vpsconfigbtn" class="server-head aos-animate aos-init">Select your VPS Configuration below:</h4>
                    </div>
                </div>
                 <div class="col-sm-12">
                        <div class="ukvtab_div" >
                            <div class="tab-content">
                                <div class="tab-pane-inner">
                                    <div class="range-cover">
                                    <div class="range-slider">
                                        <div class="clearfix slider-info">
                                            <label for="ghz-value1">CPU</label>
                                            <input type="text" id="ghz-value1" readonly> <small>Core</small>
                                        </div>
                                        <div id="ghz-slider1" class="value-slider"></div>
                                        <div class="scale">
                                            <div class="row">
                                                <div class="col-sm-4">2</div>
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4">4</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vps-total-value">
                                        <span class="config-text" id="cpu_config_val"></span>
                                        <span class="total-price">
                                            <span class="rupee" id="cpu_rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                            <span class="price-value" id="cpu_config_price">Free</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="range-cover">
                                    <div class="range-slider">
                                        <div class="clearfix slider-info">
                                            <label for="mb-value1">RAM</label>
                                            <input type="text" id="mb-value1" readonly> <small>GB</small>
                                        </div>
                                        <div id="mb-slider1" class="value-slider"></div>
                                        <div class="scale">
                                            <div class="row">
                                                <div class="col-sm-4">2</div>
                                                <div class="col-sm-4">4</div>
                                                <div class="col-sm-4">8</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vps-total-value">
                                        <span class="config-text" id="ram_config_val"></span>
                                        <span class="total-price">
                                            <span class="rupee" id="ram_rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                            <span class="price-value" id="ram_config_price">0</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="range-cover">
                                    <div class="range-slider">
                                        <div class="clearfix slider-info">
                                            <label for="gb-value1">HDD</label>
                                            <input type="text" id="gb-value1" readonly> <small>GB</small>
                                        </div>
                                        <div id="gb-slider1" class="value-slider"></div>
                                        <div class="scale">
                                            <div class="row">
                                                <div class="col-sm-3">20</div>
                                                <div class="col-sm-3">40</div>
                                                <div class="col-sm-3">80</div>
                                                <div class="col-sm-3">120</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vps-total-value">
                                        <span class="config-text" id="hdd_config_val"></span>
                                        <span class="total-price">
                                            <span class="rupee" id="hdd_rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                            <span class="price-value" id="hdd_config_price">0</span>
                                        </span>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-12">
                            {{--<div class="vps-total-value d-flex justify-content-center align-items-center">
                                <span class="total-text" id="total_config_price">Total Price:</span>
                                <span class="total-price d-flex align-items-center">
                                    <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                    <span class="price-value"></span>
                                </span>
                            </div>
                            <div class="dedicated-head">
                                <input type="hidden" id="selectedvps" name="selectedvps" value="">
                                <button id="buynowbtn" onclick="submitVPSForm();" class="btn-primary" title="Buy Now">Buy Now</button>
                            </div>--}}
                            <div class="total-product-price">
                                   <div class="vps-total-value">
                                        <span class="total-text">Total Price:</span>
                                        <span class="total-price">
                                            <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                            <span class="price-value" id="total_config_price">0</span>
                                        </span>
                                    </div>
                                    <input type="hidden" id="selectedvps" name="selectedvps" value="">
                                    <input type="hidden" id="selectedvpsduration" name="selectedvpsduration" value="">
                                <button id="buynowbtn" onclick="submitVPSForm();" class="btn-primary" title="Buy Now">Buy Now</button>
                                </div>
                        </div>
                                </div>
                            </div>
                        </div>
                    @php } @endphp
@php if($ProductBanner->id == 25) { @endphp
<div class="vps-features vps-plan-features" id="EconomyOneMonthFeatures">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">Features Of Enterprise VPS Hosting</h2>
                <div class="features-start d-md-block d-none">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon privacy-protected"></i></div>
                                    <h3>Security</h3>
                                    <div class="content">KVM uses a combination of security-enhanced Linux (SELinux) and secure virtualization (sVirt) for enhanced VM security and isolation. SELinux establishes security boundaries around VMs. sVirt extends SELinux's capabilities, allowing Mandatory Access Control (MAC) security to be applied to guest VMs and preventing manual labeling errors.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon migration"></i></div>
                                    <h3>Live migration</h3>
                                    <div class="content">KVM supports live migration, which is the ability to move a running VM between physical hosts with no service interruption. The VM remains powered on, network connections remain active, and applications continue to run while the VM is relocated. KVM also saves a VM's current state so it can be stored and resumed later.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon scale-with-ease"></i></div>
                                    <h3>Power & Scalability</h3>
                                    <div class="content">Kernel-based Virtual Machine (KVM) is a virtualization infrastructure for the Linux kernel that turns it into a hypervisor, a program that allows multiple independent operating systems to share a single hardware host and a great control. This gives better isolation & security to each virtual server without compromising on performance.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="features-start features-start-mob d-md-none d-block">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon privacy-protected"></i></div>
                                    <h3>Security</h3>
                                    <div class="content">KVM uses a combination of security-enhanced Linux (SELinux) and secure virtualization (sVirt) for enhanced VM security and isolation. SELinux establishes security boundaries around VMs. sVirt extends SELinux's capabilities, allowing Mandatory Access Control (MAC) security to be applied to guest VMs and preventing manual labeling errors.</div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon migration"></i></div>
                                    <h3>Live migration</h3>
                                    <div class="content">KVM supports live migration, which is the ability to move a running VM between physical hosts with no service interruption. The VM remains powered on, network connections remain active, and applications continue to run while the VM is relocated. KVM also saves a VM's current state so it can be stored and resumed later.</div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon scale-with-ease"></i></div>
                                    <h3>Power & Scalability</h3>
                                    <div class="content">Kernel-based Virtual Machine (KVM) is a virtualization infrastructure for the Linux kernel that turns it into a hypervisor, a program that allows multiple independent operating systems to share a single hardware host and a great control. This gives better isolation & security to each virtual server without compromising on performance.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="vps-features vps-plan-features" id="WindowsNewVpsProduct" style="display: none">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">Features of Windows VPS</h2>
                <div class="features-start d-md-block d-none">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon privacy-protected"></i></div>
                                    <h3>Security</h3>
                                    <div class="content">KVM uses a combination of security-enhanced Linux (SELinux) and secure virtualization (sVirt) for enhanced VM security and isolation. SELinux establishes security boundaries around VMs. sVirt extends SELinux's capabilities, allowing Mandatory Access Control (MAC) security to be applied to guest VMs and preventing manual labeling errors.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon migration"></i></div>
                                    <h3>Live migration</h3>
                                    <div class="content">KVM supports live migration, which is the ability to move a running VM between physical hosts with no service interruption. The VM remains powered on, network connections remain active, and applications continue to run while the VM is relocated. KVM also saves a VM's current state so it can be stored and resumed later.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon scale-with-ease"></i></div>
                                    <h3>Power & Scalability</h3>
                                    <div class="content">Kernel-based Virtual Machine (KVM) is a virtualization infrastructure for the Linux kernel that turns it into a hypervisor, a program that allows multiple independent operating systems to share a single hardware host and a great control. This gives better isolation & security to each virtual server without compromising on performance.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon privacy-protected"></i></div>
                                        <h3>Security</h3>
                                    <div class="content">KVM uses a combination of security-enhanced Linux (SELinux) and secure virtualization (sVirt) for enhanced VM security and isolation. SELinux establishes security boundaries around VMs. sVirt extends SELinux's capabilities, allowing Mandatory Access Control (MAC) security to be applied to guest VMs and preventing manual labeling errors.</div>
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon migration"></i></div>
                                        <h3>Live migration</h3>
                                    <div class="content">KVM supports live migration, which is the ability to move a running VM between physical hosts with no service interruption. The VM remains powered on, network connections remain active, and applications continue to run while the VM is relocated. KVM also saves a VM's current state so it can be stored and resumed later.</div>
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon scale-with-ease"></i></div>
                                        <h3>Power & Scalability</h3>
                                        <div class="content">Kernel-based Virtual Machine (KVM) is a virtualization infrastructure for the Linux kernel that turns it into a hypervisor, a program that allows multiple independent operating systems to share a single hardware host and a great control. This gives better isolation & security to each virtual server without compromising on performance.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="vps-features vps-plan-features" id="LinuxNewVpsProduct" style="display: none">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">Features of Linux VPS</h2>
                <div class="features-start d-md-block d-none">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon multiple-support"></i></div>
                                    <h3>Multiple Platform Support</h3>
                                    <div class="content">Xen is a hypervisor that supports x86, x86_64, Itanium, and ARM architectures, and can run Linux, Windows, Solaris, and some of the BSDs as guests on their supported CPU architectures. It's supported by a number of companies.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon scale-with-ease"></i></div>
                                    <h3>Light Hypervisor</h3>
                                    <div class="content">Xen having a smaller foot print would probably the lightest hypervisor you may have among the popular virtualization technologies.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon virtual-support"></i></div>
                                    <h3>HVM and PV support</h3>
                                    <div class="content">Xen integrates with Hardware Virtual Machine (HVM) and Paravirtualization (PV) in the hypervisor.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon multiple-support"></i></div>
                                        <h3>Multiple Platform Support</h3>
                                    <div class="content">Xen is a hypervisor that supports x86, x86_64, Itanium, and ARM architectures, and can run Linux, Windows, Solaris, and some of the BSDs as guests on their supported CPU architectures. It's supported by a number of companies.</div>
                               </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon scale-with-ease"></i></div>
                                        <h3>Light Hypervisor</h3>
                                    <div class="content">Xen having a smaller foot print would probably the lightest hypervisor you may have among the popular virtualization technologies.</div>
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon virtual-support"></i></div>
                                        <h3>HVM and PV support</h3>
                                    <div class="content">Xen integrates with Hardware Virtual Machine (HVM) and Paravirtualization (PV) in the hypervisor.</div>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="vps-features vps-plan-features" id="PremiumVpsProduct" style="display: none">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">Features Of Standard VPS Hosting</h2>
                <div class="features-start d-md-block d-none">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon containerized-server"></i></div>
                                    <h3>Containerized Based Virtualization</h3>
                                    <div class="content">Multiple secure, isolated Linux containers on a single physical server enabling better server utilization and ensuring that applications do not conflict.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon secureandrobust"></i></div>
                                    <h3>Serial SSH Console</h3>
                                    <div class="content">The serial console is a feature that enables an SSH connection through a separate IP address using a session-specific, random username and password. The serial console feature is included so that you can connect to your VPS in case you misconfigure your network configuration, firewall or anything that disables you to remotely connect the VPS.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon virtual-support"></i></div>
                                    <h3>Paravirtualization Technology</h3>
                                    <div class="content">This is a lightweight VM which shares host kernel and delivers higher performance than full virtualization because the operating system and hypervisor work together more efficiently.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="features-start features-start-mob d-md-none d-block">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon containerized-server"></i></div>
                                    <h3>Containerized Based Virtualization</h3>
                                    <div class="content">Multiple secure, isolated Linux containers on a single physical server enabling better server utilization and ensuring that applications do not conflict.</div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon secureandrobust"></i></div>
                                    <h3>Serial SSH Console</h3>
                                    <div class="content">The serial console is a feature that enables an SSH connection through a separate IP address using a session-specific, random username and password. The serial console feature is included so that you can connect to your VPS in case you misconfigure your network configuration, firewall or anything that disables you to remotely connect the VPS.</div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon virtual-support"></i></div>
                                    <h3>Paravirtualization Technology</h3>
                                    <div class="content">This is a lightweight VM which shares host kernel and delivers higher performance than full virtualization because the operating system and hypervisor work together more efficiently.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php }  @endphp 
@if(!empty($FeaturesData) && count($FeaturesData) >0)
@php if($ProductBanner->id == '10' || $ProductBanner->id == '4'){
        if($ProductBanner->id == 25 ||$ProductBanner->id == 8){
            $mainclass = 'ssl-features';
        } else {
            $mainclass = '';
        }
    $mobileclass = '';
    $imageclass = 'd-flex justify-content-center align-items-center';
}   else    {
    $mainclass = '';
    $mobileclass = '';
    $imageclass = '';
} @endphp

<!-- S New Featured content -->

<div class="lading_bottom">
    @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
    <div class="hostingtype_div">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if($ProductBanner->id == 4)
                        <h3 class="title">Need to know something more? See if you find your answer here</h3>
                    @else
                        <h3 class="title">Looking for Windows VPS or Windows Dedicated?</h3>
                    @endif
                </div>
                @php $p = 0; $class = ''; $color = ''; $info = ''; @endphp
                @foreach($FeaturedProductsData as $FeaturedProducts)
                @php if ($p == '0'){
                $class = 'd-flex justify-content-end';
                $color = 'left_part';
                } else {
                $class = ''; 
                $color = 'right_part';
                } @endphp
                <div class="col-lg-6 {{$color}} {{$class}}">
                    <div class="hosting_box d-flex">
                        <div class="image align-self-center" data-aos="fade-right" data-aos-delay="250">
                            <i class="{{$FeaturedProducts->varIconClass}}"></i>
                            <div class="hosting-price-start"  title="{{ $FeaturedProducts->varWHMCSFieldName }}">Starting at 
                                @if(Config::get('Constant.sys_currency') == 'INR')
                                <span class="color-green"><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</strong>/mo*</span>
                                @else
                                <span class="color-green"><i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_USD') }}</strong>/mo*</span>
                                @endif
                            </div>
                        </div>
                        <div class="info" data-aos="fade-left" data-aos-delay="100">
                            <h2 class="name">{{$FeaturedProducts->varTitle}}</h2>
                            <h3 class="info-text">{{$FeaturedProducts->varShortDescription}}</h3>
                            @php $FeaturedProductsDec = explode("\n",$FeaturedProducts->varFeature); @endphp 
                            <ul class="list">
                                @foreach($FeaturedProductsDec as $info)
                                <li><span>{{$info}}</span></li>
                                @endforeach
                            </ul>
                            <a target="_blank" href="{{$FeaturedProducts->varButtonLink}}" class="btn" title="{{$FeaturedProducts->varButtonName}}">{{$FeaturedProducts->varButtonName}}</a>
                        </div>
                    </div>
                </div>
                @php $p++;@endphp
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>


<div class="vps-features {{$mainclass}}" id="features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                @php if($ProductBanner->id == 4){ @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features that bring a 5 star wordpress experience to your plate</h2>
                @php } else if($ProductBanner->id == 25) { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features to up your gear</h2>
                @php } else if($ProductBanner->id == 8) { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features to make you unstoppable</h2>
                @php } else { @endphp
                <h2 class="features-title aos-init" data-aos="fade-up">Features put you in control</h2>
                @php } @endphp

                <div class="features-start d-md-block d-none">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            @foreach($FeaturesData as $Features)
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon {{$imageclass}}"><i class="{{$Features->varIconClass}}"></i></div>
                                    <h3>{{$Features->varTitle}}</h3>
                                    <div class="content">{!! $Features->varShortDescription !!}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                    <div class="{{$mobileclass}}">
                        <div class="owl-carousel owl-theme">
                            @foreach($FeaturesData as $Features)
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="{{$Features->varIconClass}}"></i></div>
                                        <h3>{{$Features->varTitle}}</h3>
                                        <div class="content">{!! $Features->varShortDescription !!}</div>
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
</div>

<div class="vps-features vps-plan-features" style="display:none">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <div class="cms">
                <h3 class="text-center green_title f_weight_500" data-aos="fade-up">Infuse the performance of Kernel based Virtual Machine in your servers</h3>
                </div>
                <div class="features-start d-md-block d-none">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon containerized-server"></i></div>
                                    <h3>Security</h3>
                                    <div class="content"> A concoction of security-enhanced Linux (SELinux) and secure virtualization (sVirt) is used by KVM. This enhances VM security and isolation. SELinux  secures VMs. sVirt enhances SELinux's capabilities, making space for Mandatory Access Control (MAC) security to be applied to guest VMs and thus keeping away manual labeling errors.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon secureandrobust"></i></div>
                                    <h3>Live Migration</h3>
                                    <div class="content">KVM facilitates live migration. So you can move a running VM between physical hosts with absolutely no interruption. The VM stays powered on, networks stay active, and applications continue to stay operational, while the VM is being moved. KVM also insulates a VM's current state. So it can be resumed later.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon virtual-support"></i></div>
                                    <h3>Power and scalability</h3>
                                    <div class="content">KVM is a virtualization infrastructure for the Linux kernel that turns it into a hypervisor which in return, allows multiple unique OS to share a common hardware host. That way, each virtual server is boosted with isolation and security, without taking a toll on performance.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon containerized-server"></i></div>
                                        <h3>Security</h3>
                                        <div class="content">A concoction of security-enhanced Linux (SELinux) and secure virtualization (sVirt) is used by KVM. This enhances VM security and isolation. SELinux  secures VMs. sVirt enhances SELinux's capabilities, making space for Mandatory Access Control (MAC) security to be applied to guest VMs and thus keeping away manual labeling errors.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon secureandrobust"></i></div>
                                        <h3>Live Migration</h3>
                                        <div class="content">KVM facilitates live migration. So you can move a running VM between physical hosts with absolutely no interruption. The VM stays powered on, networks stay active, and applications continue to stay operational, while the VM is being moved. KVM also insulates a VM's current state. So it can be resumed later.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon virtual-support"></i></div>
                                        <h3>Power and scalability</h3>
                                        <div class="content">KVM is a virtualization infrastructure for the Linux kernel that turns it into a hypervisor which in return, allows multiple unique OS to share a common hardware host. That way, each virtual server is boosted with isolation and security, without taking a toll on performance.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($ProductBanner->id == 25)
@include('template.vps-compare')
@elseif($ProductBanner->id == 15)
@include('template.linux-reseller-compare')
@elseif($ProductBanner->id == 12)
@include('template.windows-reseller-compare')
@elseif($ProductBanner->id == 1)
@include('template.linux-hosting-compare')
@endif
@if($ProductBanner->id == 2)
<div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
    <div class="col-lg-4 col-12 z-index-1 padding-0">
        <div class="row">
            <div class="banner-1 justify-content-end d-flex">
                <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">Special Package Offer</span>
                <div class="banner-wp-blue-logo"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12 z-index-0 padding-0">
        <div class="row">
            <div class="banner-text2">
                <span class="starting-from">Linux Hosting & Domain+Managed</br>Support</span> 
                <span class="whole-span">
                    @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SPECIAL_PACKAGE_OFFER_1_INR') }}</span><span class="per-month">/mo*</span>

                     @php } else { @endphp 
                    <span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SPECIAL_PACKAGE_OFFER_1_USD') }}</span><span class="per-month">/mo*</span>
                      @php } @endphp
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12 padding-0 d-flex">
        <div class="row align-self-center" data-aos="fade-right">
            <div class="banner-button"><a href="{{url('hosting/linux-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
        </div>
    </div>
</div>
@elseif($ProductBanner->id == 15)
<div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
    <div class="col-lg-4 col-12 z-index-1 padding-0">
        <div class="row stretch-height">
            <div class="banner-1 justify-content-end d-flex">
                <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">Dedicated Hosting</span>
                <div class="banner-wp-blue-logo"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12 z-index-0 padding-0">
        <div class="row">
             @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.DEDICATED_HOSTING_OFFER_1_INR') }}</span><span class="per-month">/mo*</span></span>
             @php } else { @endphp 
                <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.DEDICATED_HOSTING_OFFER_1_USD') }}</span><span class="per-month">/mo*</span></span>
             @php } @endphp
             
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12 padding-0 d-flex">
        <div class="row align-self-center" data-aos="fade-right">
            <div class="banner-button"><a href="{{url('servers/vps-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
        </div>
    </div>
</div>
</div>
@endif
<div class="lading_bottom">
    @if(!empty($FaqData) && count($FaqData) >0)
    <div class="getquestion-div">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    @php if($ProductBanner->id == 4){ @endphp
                    <h3 data-aos="fade-up">Need to know something more? See if you find your answer here:</h3>
                    @php } else if($ProductBanner->id == 8){ @endphp
                    <h3 data-aos="fade-up">Need to know more about our dedicated hosting plans? See if we got them answered already:</h3>
                    @php } else { @endphp
                    <h3 data-aos="fade-up">Still have questions? See if our answer database solves your query already:</h3>
                    @php } @endphp

                </div>
                <div class="col-12">
                    <div id="accordion">
                        @php $i = 0; $class = ''; $class1 = ''; $class2 = ''; $class3 = '';  $class4 = ''; @endphp
                        @foreach($FaqData as $Faq)
                        @php if ($i == '0'){
                        $class = 'true';
                        $class1 = 'collapsed';
                        $class2 = 'display:block';
                        $open_class = 'active-accordition';
                        } else {
                        $class = 'false'; 
                        $class1 = 'collapsed'; 
                        $class2 = 'display:none';
                        $open_class = '';
                        } if ($i > '4'){
                        $class3 = 'display:none';
                        $class4 = 'display:block';
                        } else {
                        $class3 = '';
                        $class4 = 'display:none';
                        } @endphp
                        <div class="card" data-aos="fade-up" style="{{$class3}}">
                            <h4 class="mb-0 {{$open_class}}">
                                <button class="btn btn-link {{$class1}}" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                    {{$Faq->varTitle}} 
                                </button>
                            </h4>
                            <div id="collapse{{$i}}" class="collapse" data-parent="#accordion" style="{{$class2}}">
                                <div class="card-body">
                                    {!! $Faq->txtDescription !!}
                                </div>
                            </div>
                        </div>
                        @php $i++;@endphp
                        @endforeach
                    </div>
                </div>
                <div class="col-12 aos-init" data-aos="fade-up" style="{{$class4}}">
                    <a href="javascript:;" id="show" title="More" class="more_link">More</a>
                </div>
                <script>
                    $("#show").click(function() {
                    $(".card").show();
                    $("#show").hide();
            });</script>
            </div>
        </div>
    </div>
    @endif
    @if($ProductBanner->id == 2 || $ProductBanner->id == 13 || $ProductBanner->id == 6)
    <div class="promotion_div">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-4 col-12">
                    <div class="row justify-content-end stretch-height">
                        <div class="limited-promotion">
                            <span class="" data-aos="fade-left">Limited <br/>Time <br/>Promotion</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 padding-0">
                    <div class="new_customer">
                        <div class="offer-promo-img" data-aos="zoom-in">
                            <span class="offer-text">25% <span>Off</span>
                            </span>
                        </div>
                        <div class="combine-div">
                            <span class="offer">on shared hosting<br></span>
                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                            <div class="price-part">
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SHARED_HOSTING_OFFER_2_INR') }}</span><span class="per-month">/mo*</span></span>
                            </div>
                            @php } else { @endphp 
                             <div class="price-part">
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.SHARED_HOSTING_OFFER_2_USD') }}</span><span class="per-month">/mo*</span></span>
                            </div>
                            @php } @endphp
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex"> <a href="{{url('hosting/linux-hosting')}}" class="btn align-self-center" data-aos="fade-left" title="Get Started">Get Started</a> </div>   
            </div>
        </div>
    </div>
    @elseif($ProductBanner->id == 4)
    <div class="promotion_div">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-4 col-12">
                    <div class="row justify-content-end stretch-height">
                        <div class="limited-promotion">
                            <span class="" data-aos="fade-left">Limited <br/>Time <br/>Promotion</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 padding-0">
                    <div class="new_customer">
                        <div class="offer-promo-img" data-aos="zoom-in">
                            <span class="offer-text">50% <span>Off</span>
                            </span>
                        </div>
                        <div class="combine-div">
                            <span class="offer">Book Domains: .life, .world, .rocks, .today<br></span>
                            <div class="price-part">
                                 @if(Config::get('Constant.sys_currency') == 'INR')
                                    <span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">{{ Config::get('Constant.HOSTING_PAGE_DOMAIN_OFFER_1_INR') }}</span><span class="per-month">/mo*</span></span>
                                 @else
                                    <span class="whole-span"><span class="ruppess">&#36;</span> <span class="big-price">{{ Config::get('Constant.HOSTING_PAGE_DOMAIN_OFFER_1_USD') }}</span><span class="per-month">/mo*</span></span>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex"> <a href="{{url('domain')}}" class="btn align-self-center" data-aos="fade-left" title="Get Started">Get Started</a> </div>   
            </div>
        </div>
    </div>
    @elseif($ProductBanner->id == 1)
        <div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
        <div class="col-lg-4 col-12 z-index-1 padding-0">
            <div class="row stretch-height">
                <div class="banner-1 justify-content-end d-flex">
                    <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">Dedicated Hosting</span>
                    <div class="banner-wp-blue-logo"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 z-index-0 padding-0">
            <div class="row">
                 @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.DEDICATED_HOSTING_OFFER_1_INR') }}</span><span class="per-month">/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.DEDICATED_HOSTING_OFFER_1_USD') }}</span><span class="per-month">/mo*</span></span>
                 @php } @endphp

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 padding-0 d-flex">
            <div class="row align-self-center" data-aos="fade-right">
                <div class="banner-button"><a href="{{url('servers/vps-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
            </div>
        </div>
    </div>
    </div>
    @elseif($ProductBanner->id == 12)
        <div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
        <div class="col-lg-4 col-12 z-index-1 padding-0">
            <div class="row stretch-height">
                <div class="banner-1 justify-content-end d-flex">
                    <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">VPS hosting Deals</span>
                    <div class="banner-wp-blue-logo"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12 z-index-0 padding-0">
            <div class="row">
                 @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_INR') }}</span><span class="per-month">/mo*</span></span>
                 @php } else { @endphp 
                    <div class="banner-text2"><span class="starting-from"> Today starting from</span> <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="big-price">{{ Config::get('Constant.VPS_HOSTING_DEALS_1_USD') }}</span><span class="per-month">/mo*</span></span>
                 @php } @endphp

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 padding-0 d-flex">
            <div class="row align-self-center" data-aos="fade-right">
                <div class="banner-button"><a href="{{url('servers/vps-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
            </div>
        </div>
    </div>
    </div>
    @endif
</div>


  <script type="text/javascript">

     $(function(){
        $("#oneyear, #sixmonths, #threemonths").click(function(){
            $("#vpsconfigdiv").hide();
            $("#WindowsNewVpsProduct, #LinuxNewVpsProduct").hide();
         });
     });
     function getvpsconfig(proid,dur,config,configval){

        var vpsc=0;
       
        $.ajax({
            method:"post",
            url: "{{url('/cart/getvpsconfig')}}",
            data: {"productid":proid,"duration":dur,"config":config,"configval":configval,"currency":"{{Config::get('Constant.sys_currency')}}"},
            async: true,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                    response = JSON.parse(response);
                    console.log("#"+config+"_config_val" + ": " + response[config] + "#"+config+"_config_price: " + response.config);
                    $("#"+config+"_config_val").html(response.config + " : ");
                    
                    $("#"+config+"_config_price").html(response[config]);

                    if($("#cpu_config_price").text()=="Free" || $("#cpu_config_price").text()=="0"){   
                        $("#cpu_rupee").hide();
                        $("#cpu_config_price").text("Free");
                        var cpuconfigp=eval(0);}
                    else{   $("#cpu_rupee").show();
                        var cpuconfigp=eval($("#cpu_config_price").text());}
                    
                    if($("#ram_config_price").text()=="Free" || $("#ram_config_price").text()=="0"){
                        $("#ram_rupee").hide();
                        $("#ram_config_price").text("Free");
                        var ramconfigp=eval(0);}
                    else{$("#ram_rupee").show();
                        var ramconfigp=eval($("#ram_config_price").text());}
                    
                    if($("#hdd_config_price").text()=="Free" || $("#hdd_config_price").text()=="0"){
                        $("#hdd_rupee").hide();
                        $("#hdd_config_price").text("Free");
                        var hddconfigp=eval(0);}
                    else{$("#hdd_rupee").show();
                        var hddconfigp=eval($("#hdd_config_price").text());}

                    //var total = eval($("#cpu_config_price").text()) +  eval($("#ram_config_price").text()) + eval($("#hdd_config_price").text()) + eval(response.plan.toString());

                    var total = cpuconfigp + ramconfigp + hddconfigp + eval(response.plan.toString());

                    $("#total_config_price").html((total).toFixed(2));

                    console.log(total);
                    console.log(response.plan);

                }
            });

        }

        function getvpsconfigDefault(proid,dur){

        $.ajax({
            method:"post",
            url: "{{url('/cart/getvpsconfig')}}",
            data: {"default":1,"productid":proid,"duration":dur,"currency":"{{Config::get('Constant.sys_currency')}}"},
            async: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {

                    response = JSON.parse(response);
                    
                    $("#cpu_config_val").html(response.cpuconfig + " : ");
                    
                    $("#cpu_config_price").html(response["cpu"]);

                    $("#ram_config_val").html(response.ramconfig + " : ");
                    $("#ram_config_price").html(response["ram"]);

                    $("#hdd_config_val").html(response.hddconfig + " : ");
                    $("#hdd_config_price").html(response["hdd"]);

                    var total = eval($("#cpu_config_price").text()) +  eval($("#ram_config_price").text()) + eval($("#hdd_config_price").text()) + eval(response.plan.toString());
                    $("#total_config_price").html(total);

                    console.log(total);
                    console.log(response.plan);
                   
                   if($("#cpu_config_price").text()=="0"){
                        $("#cpu_config_price").text("Free");
                        $("#cpu_rupee").hide();}
                    else{
                        $("#hdd_config_price").html(response["cpu"]);
                        $("#cpu_rupee").show();}

                     if($("#ram_config_price").text()=="0"){
                        $("#ram_config_price").text("Free");
                        $("#ram_rupee").hide();}
                    else{   $("#hdd_config_price").html(response["ram"]);
                        $("#ram_rupee").show();}

                    if($("#hdd_config_price").text()=="0"){
                        $("#hdd_config_price").text("Free");
                        $("#hdd_rupee").hide();}
                    else{$("#hdd_config_price").html(response["hdd"]);
                        $("#hdd_rupee").show();}
                     
                     //$("#vpsconfigdiv").show();
                     //$('html, body').animate({ scrollTop: $("#vpsconfigbtn").offset().top }, 100);
                }
            });
        }
        $(".price-overline-text").hide();

        $("#form_vps_190_12,#form_vps_190_9,#form_vps_190_6").find('.btn-primary').css({"background":"gray"}).text("Coming Soon").removeAttr("onclick").click(function(){ alert("Product is Coming Soon!!"); return false; });





    // S for scroll in new
    $(".whatsnewloadcontent").click(function (){
        $('html, body').animate({
            scrollTop: $("#whatsnewloadcontentdiv").offset().top - 200
        }, 1500);
    });
    // E for scroll in new

 </script>
 
@endsection