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
    <section class="web-pln-box head-tb-p-40" id="windows-vps-hosting">
  <div class="container-fluid">
    <div class="shared-plan-bx-pd">
      <div class="section-heading">
        <h2 class="text_head text-center">India’s Affordable Windows VPS Server Plans</h2>
        <p class="text-center">Strong, Swift, & Highly Secured Servers</p>
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
@endif
</div>
    @include('template.'.$themeversion.'.30-day-moneyback') 
@include('template.'.$themeversion.'.testimonial_section')
<div class="g-suite-lists head-tb-p-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-heading">
                                <h2 class="text_head text-center">Why Windows VPS Hosting is the Perfect Choice<br>for Your Business Needs?
                             </h2>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">1</span>
                                        <h3>Feels Just Like Your Home PC</h3>
                                        <span>If you are already comfortable using Windows on your PC, managing a Windows VPS will feel like second nature but with superpowers. It is familiar, so you don’t need to learn hosting from scratch!</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">2</span>
                                        <h3>Access It Anytime, From Anywhere</h3>
                                        <span>With Remote Desktop Access, your entire setup will be in your pocket. So, whether you are at the office, home, or on vacation, you can easily access your VPS from anywhere using Remote Desktop.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">3</span>
                                        <h3>Perfect Match for Windows Apps</h3>
                                        <span>Do you have a website or software that runs on .NET, MSSQL, or other Microsoft tools? A cheap Windows VPS is made just for that, which ensures your apps run without hiccups.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">4</span>
                                        <h3>Easily Grow as Your Business Grows</h3>
                                        <span>Are you just starting? No issues at all! You can scale up as your business grows by upgrading it with just a few clicks quickly & smoothly! You just need to connect with the team when required.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">5</span>
                                        <h3>Works Great with Other Microsoft Tools</h3>
                                        <span>Need to use Microsoft Office, Outlook, or other Microsoft tools? Windows VPS server, you are already in the Microsoft ecosystem, which gives you seamless access to all your favorite apps.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                   <div class="g-list-box">
                                        <span class="list-num">6</span>
                                        <h3>Security You Can Trust</h3>
                                        <span>You don’t have to be a tech expert to protect your data. With regular Windows updates, a strong firewall, and full control over who gets access, your Windows VPS stays protected 24/7.</span>
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">7</span>
                                        <h3>Cost-Effective Licensing for Big Ambitions</h3>
                                        <span>Windows licensing offers volume discounts and enterprise-level features, making it a more budget-friendly option than Linux for larger setups.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="g_s_l-box">
                                    <div class="g-list-box">
                                        <span class="list-num">8</span>
                                        <h3>Hassle-Free Installation, Ready in Minutes</h3>
                                        <span>Windows uses an easy-to-follow software installer, while Linux relies on more advanced package managers. </span>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>

<section class="disc-full-power head-tb-p-40">
    <div class="container">
        <div class="section-heading disc-power-head">
            <h2 class="text_head">How Can You Make the<br>Most of Your Windows VPS Server?</h2>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div id="accordion-box" class="accordion faq-wrap">
                    <div class="row align-items-center">

                        <div class="col-md-12 col-lg-12">
                            <div id="accordion-box" class="accordion faq-wrap">

                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box0" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Hosting Your Website</h3>
                                    </a>
                                    <div id="box0" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Hosting your website is one of the most common and smartest ways to use Windows VPS hosting. It is a solid choice for a personal blog or a business website. At Host IT Smart, over 750+ clients host their websites on our Windows server.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box1" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">To Run eCommerce Platforms</h3>
                                    </a>
                                    <div id="box1" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>If you have an online store, our Windows VPS gives you the power and flexibility to run online stores like Magento, WooCommerce or even custom-built eCommerce sites smoothly in a strong and stable hosting environment.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box2" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Hosting Your Application</h3>
                                    </a>
                                    <div id="box2" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Do you have web apps built using Microsoft’s .NET framework that you want to run 24/7 without relying on your personal computer? You can host on our Windows VPS with a stable & always-on environment. Our 350+ clients are running their business applications on our server.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box3" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For RD Browsing</h3>
                                    </a>
                                    <div id="box3" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>One of the coolest things you can do with Windows VPS is Remote Desktop (RD) browsing, like your personal computer, where you can install your business softwares, browse the internet safely & run programs without worrying about your local device’s performance.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box4" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Data storage</h3>
                                    </a>
                                    <div id="box4" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>You can use your Windows VPS server as your personal locker in the cloud, which would be more powerful to store all your important files, documents, and software setups. The best part is that it is accessible from anywhere in the world.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box5" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Using Collaboration Tools</h3>
                                    </a>
                                    <div id="box5" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Do you have a team that works from different locations? With Windows VPS server in India, you can run tools like Microsoft Teams, Zoom, Slack, or any project management software for better team communication and work coordination.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box6" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Backup</h3>
                                    </a>
                                    <div id="box6" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>With our secured Windows VPS hosting solution, you can store your valuable data securely as a backup and easily access it whenever needed. With that, you won't have to worry about data loss or system failure.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box7" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">For Running CRM</h3>
                                    </a>
                                    <div id="box7" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>If you use CRM tools like Zoho, Salesforce, or your custom-built CRM, Windows VPS can be the perfect place to host and manage them where all your customer details, sales history, and follow-ups live, which is always online, secure, and accessible</p>
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
                                    <div class="icon-blnk-dv"></div>Detachable Events Overview Screen
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
                                <td>Supported</td>
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
<section class="whdo-win-vps-inc head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="text_head">What You Are Going To Get with Our Windows VPS</h2>
                    <p>To make your operations smoother, we have included all the essential features with Windows VPS to help your online work run better and faster</p>
                    <p></p>
                </div>
                <div class="wb-pnl-ul">
                    <div class="wb-pnl-tp-cnt">
                        <ul>
                            <li><span class="wb-pnl-cnt-icon">Migration Assistance</li>
                            <li><span class="wb-pnl-cnt-icon">Server Firewall Setup</li>
                            <li><span class="wb-pnl-cnt-icon">KVM Virtualization</li>
                            <li><span class="wb-pnl-cnt-icon">RAID 6 Disk Arrays</li>
                            <li><span class="wb-pnl-cnt-icon">Full Remote Desktop Access</li>
                            <li><span class="wb-pnl-cnt-icon">Unlimited SQL Databases</li>
                            <li><span class="wb-pnl-cnt-icon">Windows Server 2019/2022</li>
                            <li><span class="wb-pnl-cnt-icon">Supports all MVC Frameworks</li>
                            <li><span class="wb-pnl-cnt-icon">DDR4 RAM</li>
                            <li><span class="wb-pnl-cnt-icon">Control Panel Installation</li>
                            <li><span class="wb-pnl-cnt-icon">Server Resource Upgradation Support</li>
                            <li><span class="wb-pnl-cnt-icon">Latest ASP.Net, .Net Core, PHP</li>
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
                        <h2 class="text_head">Offering You Plesk for Easy Windows VPS Management</h2>
                        <p class="text_cnt">You can choose to add the Plesk panel during checkout to easily manage your VPS, with multiple package options available to match your requirements.</p>
                    </div>
                    <div class="wb-pnl-avl-left">
                        <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link wb-pnl-btn active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <img loading="lazy" class="img-fluid web-pnl-tittle-icon" src="../assets/images/windows_vps_hosting/Web_Admin_Edition.webp" alt="Web_Admin_Edition">Web Admin Edition
                            </a>
                            <a class="nav-link wb-pnl-btn" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                <img loading="lazy" class="img-fluid web-pnl-tittle-icon" src="../assets/images/windows_vps_hosting/Web_Pro_Edition.webp" alt="Web_Pro_Edition">Web Pro Edition
                            </a>
                            <a class="nav-link wb-pnl-btn" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
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
                                            <div class="price">₹1150<span class="win-hstg-price-mo">/mo</span></div>
                                        </div>
                                        <li><span class="wb-pnl-cnt-icon">Manage up to 10 domains.</li>
                                        <li><span class="wb-pnl-cnt-icon">Power-user view (Server + Site Admin)</li>
                                        <li><span class="wb-pnl-cnt-icon">Plesk mobile manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Security Core with ModSecurity Rules</li>
                                        <li><span class="wb-pnl-cnt-icon">Let's Encrypt SSL Certificate</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="wb-pnl-ul">
                                <div class="wb-pnl-tp-cnt">
                                    <ul>
                                        <div class="win-hstg-tittle">
                                            <div class="price">₹1700<span class="win-hstg-price-mo">/mo</span></div>
                                        </div>
                                        <li><span class="wb-pnl-cnt-icon">Manage up to 30 domains.</li>
                                        <li><span class="wb-pnl-cnt-icon">Subscription management</li>
                                        <li><span class="wb-pnl-cnt-icon">Account management</li>
                                        <li><span class="wb-pnl-cnt-icon">Power-user view (Server + Site Admin)</li>
                                        <li><span class="wb-pnl-cnt-icon">Cgroups Manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Service Provider View</li>
                                        <li><span class="wb-pnl-cnt-icon">Restricted Mode</li>
                                        <li><span class="wb-pnl-cnt-icon">WP Toolkit</li>
                                        <li><span class="wb-pnl-cnt-icon">PostgreSQL and MSSQL management modules</li>
                                        <li><span class="wb-pnl-cnt-icon">Plesk mobile manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Offers DNSSEC</li>
                                        <li><span class="wb-pnl-cnt-icon">Let's Encrypt SSL Certificate</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <div class="wb-pnl-ul">
                                <div class="wb-pnl-tp-cnt">
                                    <ul>
                                        <div class="win-hstg-tittle">
                                            <div class="price">₹3100<span class="win-hstg-price-mo">/mo</span></div>
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
                                        <li><span class="wb-pnl-cnt-icon">PostgreSQL and MSSQL management modules</li>
                                        <li><span class="wb-pnl-cnt-icon">Plesk mobile manager</li>
                                        <li><span class="wb-pnl-cnt-icon">Offers DNSSEC</li>
                                        <li><span class="wb-pnl-cnt-icon">Let's Encrypt SSL Certificate</li>
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

<section class="self-managed-vps-assist whdo-win-vps-inc head-tb-p-40">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="text_head">Despite purchasing a self-managed VPS, we continue to assist in the following</h2>
                </div>
                <div class="wb-pnl-ul">
                    <div class="wb-pnl-tp-cnt">
                        <ul>
                            <li><span class="wb-pnl-cnt-icon">Server Provisioning And Setup</li>
                            <li><span class="wb-pnl-cnt-icon">Hardware-Related Resolutions</li>
                            <li><span class="wb-pnl-cnt-icon">Control Panel Installation</li>
                            <li><span class="wb-pnl-cnt-icon">Server Resource Upgradation Support</li>
                            <li><span class="wb-pnl-cnt-icon">Security Firewall Setup</li>
                            <li><span class="wb-pnl-cnt-icon">Standard Support</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="wp-pnl-first">
                    <div class="wp-pml-first-img">
                        <img class="img-fluid" loading="lazy" src="../assets/images/windows_vps_hosting/Self_Managed_VPS.webp" alt="Self_Managed_VPS">
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

@if(!empty($FeaturesData) && count($FeaturesData) >0)
<div class="vps-features head-tb-p-40" id="features">
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



{{-- <section class="sup-vps-hstg-main head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">We Have Superior Windows VPS Hosting For You!</h2>
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
</section> --}}




<section class="vps_hosting_prov_comp_main head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">Don’t Believe Us Yet?</h2>
            <p>Let’s see where our Windows VPS stand among the competition.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="vps_hstg_prv_table table-responsive">
                    <table class="table">
                        <thead class="vps-hstg-tbl-head">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"><img src="../assets/images/windows_vps_hosting/logo.webp" alt="logo"></th>
                                    <th scope="col"><img src="../assets/images/windows_vps_hosting/hostingraja_.webp" alt="hostingraja_"></th>
                                    <th scope="col"><img src="../assets/images/windows_vps_hosting/square_brothers_.webp" alt="square_brothers_"></th>
                                    <th scope="col"><img src="../assets/images/windows_vps_hosting/logo-everdata-new-1.webp" alt="logo-everdata-new-1"></th>
                                    <th scope="col"><img src="../assets/images/windows_vps_hosting/providers-godaddy.webp" alt="providers-godaddy"></th>
                                    <th scope="col"><img src="../assets/images/windows_vps_hosting/mw-logo.webp" alt="mw-logo"></th>
                                    
                                </tr>
                            </thead>
                            <tbody class="vps-hstg-prv-body">
                                <tr>
                                    <td>Monthly Pricing</td>
                                    <td>₹825/mo</td>
                                    <td>₹814/mo</td>
                                    <td>₹799/mo</td>
                                    <td>₹849/mo</td>
                                    <td>₹1299/mo</td>
                                    <td>₹999/mo</td>
                                </tr>
                                <tr>
                                    <td>CPU</td>
                                    <td>1vCPU</td>
                                    <td>2vCPU</td>
                                    <td>2CPU</td>
                                    <td>1vCPU</td>
                                    <td>2vCPU</td>
                                    <td>1vCPU</td>
                                </tr>
                                <tr>
                                    <td>RAM</td>
                                    <td>4GB</td>
                                    <td>2GB</td>
                                    <td>4GB</td>
                                    <td>2GB</td>
                                    <td>4GB</td>
                                    <td>4GB</td>
                                </tr>
                                <tr>
                                    <td>Storage</td>
                                    <td>50GB SSD</td>
                                    <td>70GB NVMe SSD</td>
                                    <td>50GB SSD</td>
                                    <td>30GB SSD</td>
                                    <td>100GB SSD</td>
                                    <td>50GB SSD</td>
                                </tr>
                                <tr>
                                    <td>Bandwidth</td>
                                    <td>4TB</td>
                                    <td>1TB</td>
                                    <td>2TB</td>
                                    <td>200GB</td>
                                    <td>–</td>
                                    <td>4TB</td>
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
                                    <td>–</td>
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
 @include('template.'.$themeversion.'.support_section_home') 
 {{-- @include('template.'.$themeversion.'.help_section')  --}}

 <div class="dy-money-back-grnt head-tb-p-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dy-money-back-grnt-box text-center">
                            <h2>Your Business Deserves a Professional Email!</h2>
                            <p>Google Workspace gives you a professional, branded inbox.</p>
                            <a href="https://www.hostitsmart.com/email/google-workspace-india" title="Try Google Workspace">Try Google Workspace</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
@include('template.'.$themeversion.'.faq-section')
@include('template.'.$themeversion.'.two-hosting-add')
@endsection