@extends('layouts.app')
@section('content')
<div class="domain_main vps_main">
    @include('layouts.inner_banner')
</div>
<div class="domain-landing-section">
    <div class="banner-inner domain-banner">
        <div class="container">
            <div class="banner-content">
                <?php /*<div class="banner-image aos-init" data-aos="fade-up" data-aos-delay="100"></div>*/ ?>
                <h1 class="banner-title aos-init" data-aos="fade-up" data-aos-delay="200" title="">Cheap Domain Name Registration</h1>
                <span class="banner-subtitle aos-init" data-aos="fade-up" data-aos-delay="300" title="">Your domain name is the identity of your business. Invest time and thoughts to it before you bang upon any particular domain name for your business.</span>
                <div class="banner-search aos-init" data-aos="fade-up" data-aos-delay="400">
                    <form action="{{url('/domain-checker')}}" class="custom-search" id="domainlookupfrm" method="post" >
                        <div class="custom-search">
                            {{ csrf_field() }}
                            <input type="text" placeholder="Search for a Domain Name" name="domainname" id="domainname">
                            <input type="hidden" name="hide_tlddata" id="hide_tlddata" value="{{$Tlds}}" />
                            <input type="hidden" name="domain_search" id="domain_search" value="y" />
                            <button type="submit" title="Search"><i class="fa fa-search"></i></button>
                            @if(session()->has('domain_error'))
                            <span class="error">Please enter proper domain name.</span>
                            @endif
                        </div>
                        <span class="domain_error"></span>
                    </form>
                </div>

                <div class="banner-button aos-init" data-aos="fade-up" data-aos-delay="500"><a  href="{{url('domain/bulk-domain-search')}}" class="" title="Bulk Search">Bulk Search</a> <a href="{{url('domain/domain-transfer')}}" class="" title="Transfer Domain" >Transfer Domain</a> 
                    @if(session()->has('frontlogin'))
                    @php
                        $apiUrl = config('app.api_url');
                        $renew_link = $apiUrl . '/index.php?rp=/cart/domain/renew';
                    @endphp

                    <a class="" title="Renew Domain" target="_blank" href="{{$renew_link}}">Renew Domain</a>
                    @else
                    <a class="" title="Renew Domain" href="javascript:;" data-toggle="modal" data-target="#loginModal">Renew Domain</a>
                    @endif
                </div>
                <div>
                   <div class="col-sm-12 d-md-block d-none" data-aos="fade-up" data-aos-delay="300">
                    <div class="ext-showcase">
                        <div class="row">
                    
                    <div class="banner-button banner-button-domain">
                    <?php
                    foreach($TLDAdData as $valTLD)
                    {     
                        ?>  <a class="banner_domain-lists" alt=".{{$valTLD->varTitle}}" title=".{{$valTLD->varTitle}}" href="{{url("domain/".$valTLD->varAlias)}}">
                                    @if($valTLD->varTitle=='com')
                                    <img alt=".{{$valTLD->varTitle}}"  src="assets/images/domain_transfer/domain-com.webp"/> 
                                    @elseif($valTLD->varTitle=='in')
                                    <img alt=".{{$valTLD->varTitle}}" src="assets/images/domain_transfer/domain-in.webp"/>
                                    @elseif($valTLD->varTitle=='co.in')
                                    <img alt=".{{$valTLD->varTitle}}" src="assets/images/domain_transfer/domain-co-in.webp"/> 
                                    @elseif($valTLD->varTitle=='org')
                                    <img alt=".{{$valTLD->varTitle}}" src="assets/images/domain_transfer/domain-org.webp"/>
                                    @elseif($valTLD->varTitle=='net')
                                    <img alt=".{{$valTLD->varTitle}}" src="assets/images/domain_transfer/domain-net.webp"/>
                                    @elseif($valTLD->varTitle=='co')
                                    <img alt=".{{$valTLD->varTitle}}" src="assets/images/domain_transfer/domain-co.webp"/> 
                                    @endif 
                                        <span class="b_domain-price"> 
                                               @if(Config::get('Constant.sys_currency') == 'INR')
                                                <span class="rupee">&#8377;</span>
                                                    {{ Config::get('Constant.'.$valTLD->varWHMCSFieldName.'_INR') }}
                                                @else
                                                <span>&#36;{{ Config::get('Constant.'.$valTLD->varWHMCSFieldName.'_USD') }}</span>
                                                @endif
                                        </span>

                            </a>
                        <?php
                    }
                    ?>
                    </div>
                   </div>
               </div>
           </div>
                </div>
            </div>
        </div>
    </div>
    <!-- extension section -->
    @if(!empty($TLDData) && count((array)$TLDData) >0)
    <div class="extension-section">
        <div class="container">
            <div class="row">
                <div class="title text-center" data-aos="fade-up" data-aos-delay="100">
                    {!!$ProductData[0]->txtDescription!!}
                </div>
                <div class="col-sm-12 d-md-block d-none" data-aos="fade-up" data-aos-delay="300">
                    <div class="ext-showcase">
                        <div class="row">
                            @foreach($TLDData as $TLD)
                            <div class="col-md-4 col-lg-3 col-xl-2" data-aos="fade-up">
                                <a class="extension-container" href="{{url("domain/".$TLD->varAlias)}}" title="{{$TLD->varTitle}}">
                                    <div class="ext-item">
                                        <div class="ext-img">
                                            <div class="thumbnail-container">
                                                <div class="thumbnail"><img src="{!! App\Helpers\resize_image::resize($TLD->fkIntImgId, 204, 137) !!}" alt="{{$TLD->varTitle}}">
                                                    <div class="caption-title">
                                                        <p>{{$TLD->varTitle}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ext-img-text">
                                            <div class="img-text">
                                                <p class="text-center">{{$TLD->varTitle}} 
                                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                                    <span>From <i class="tld_rupees_ico">&#8377;</i>{{ Config::get('Constant.'.$TLD->varWHMCSFieldName.'_INR') }}</span>
                                                    @else
                                                    <span>From &#36;{{ Config::get('Constant.'.$TLD->varWHMCSFieldName.'_USD') }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            <div class="col-md-4 col-lg-3 col-xl-2" data-aos="fade-up">
                                <a class="extension-container" href="{{url('/tld')}}" title="View All">
                                    <div class="ext-item">
                                        <div class="ext-img">
                                            <div class="thumbnail-container">
                                                <div class="thumbnail">
                                                    <img src="{{url('/assets/images/domain-deals.png')}}" alt="View All"/>
                                                    <div class="caption-title">
                                                        <p>Domain <br/>Deals</p> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ext-img-text">
                                            <div class="img-text">
                                                <p class="text-center">
                                                    View All<i class="la la-arrow-right"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- row end -->
                    </div>
                </div>
                <!-- domain names for responsive start -->
                <div class="col-12 d-md-none d-block">
                    <div class="extension-slider aos-init" data-aos="fade-up" data-aos-delay="500s">
                        <div class="owl-carousel owl-theme">
                            @foreach($TLDData as $TLD)
                            <div class="item">
                                <a class="extension-container" href="{{url("domain/".$TLD->varAlias)}}" title="{{$TLD->varTitle}}">
                                    <div class="ext-item">
                                        <div class="ext-img">
                                            <div class="thumbnail-container">
                                                <div class="thumbnail"><img src="{!! App\Helpers\resize_image::resize($TLD->fkIntImgId, 204, 137) !!}" alt="{{$TLD->varTitle}}">
                                                    <div class="caption-title">
                                                        <p>{{$TLD->varTitle}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ext-img-text">
                                            <div class="img-text">
                                                <p class="text-center">{{$TLD->varTitle}} <span>From $99.99</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            <div class="item">
                                <a class="extension-container" href="{{url('/tld')}}" title="">
                                    <div class="ext-item">
                                        <div class="ext-img">
                                            <div class="thumbnail-container">
                                                <div class="thumbnail">
                                                    <img src="{{url('/assets/images/domain-deals.png')}}" alt="View All"/>
                                                    <div class="caption-title">
                                                        <p>View All<i class="la la-arrow-right"></i></p>	
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ext-img-text">
                                            <div class="img-text">
                                                <p class="text-center">
                                                    View All
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- carousel end -->
                    </div>
                    <!-- extension-slider end -->
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- extension section end -->
    <!-- feature points section -->
    <div class="dl-features-points head-tb-p-40">
        <div class="container">
            <div class="feature-start">
                <div class="section-heading">
                <h2 class="text-center text-light text_head">Included with all Host IT Smart Domains</h2>
                <p class="text-center text-light">Register your domain name with Host IT Smart for a full featured experience</p>
                </div>
                <div class="fp-list">
                    <div class="row">
                        <div class="col-12 col-sm-6 aos-init" data-aos="fade-right" data-aos-delay="500">
                            <ul>
                                <li>Who's privacy is included to secure your personal information</li>
                                <li>Easy to use Control Panel</li>
                                <li>Facility to book Premium Domains</li>
                                <li>Free URL Forwarding</li>
                                <li>Advanced DNS management</li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-6 aos-init" data-aos="fade-left" data-aos-delay="500">
                            <ul>
                                <li>24/7 customer support</li>
                                <li>Bulk domain name search facility</li>
                                <li>Secure your domain from hijacking risks with domain lock</li>
                                <li>Choose Domain TLDs that matches your profession (like.photo, .music, .photography)</li>
                                <li>Multiple year registration</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Domain Price -->
    <div class="domain-price" style="display: none">
        <div class="container">
            <div class="domain-price-main">
                <h5 class="aos-init" data-aos="fade-up" data-aos-delay="100">Looking to buy Premium Domains at cheap price?</h5>
                <div class="domain-price-boxes-main">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="domain-boxes aos-init" data-aos="fade-left" data-aos-easing="ease-out-back" data-aos-delay="200">
                                <div class="price-header">Editors Choice</div>
                                <div class="domain-box">
                                    <div class="domain-price-table">
                                        <table class="table-domain-price">
                                            <tr>
                                                <th class="title">Domain Name</th>
                                                <th class="title">Deal Time</th>
                                                <th class="title">Price</th>
                                            </tr>
                                            <tr>
                                                <td>Bonding.ca</td>
                                                <td>26 days left</td>
                                                <td>$3,500</td>
                                            </tr>
                                            <tr>
                                                <td>Fastcabs.ca</td>
                                                <td>13 days left</td>
                                                <td>$21000</td>
                                            </tr>
                                            <tr>
                                                <td>Wive.ca</td>
                                                <td>12 days left</td>
                                                <td class="green-price">$4,500</td>
                                            </tr>
                                            <tr>
                                                <td>Dryfruit.ca</td>
                                                <td>10 days left</td>
                                                <td>$12,45</td>
                                            </tr>
                                            <tr>
                                                <td>Hijack.ca</td>
                                                <td>15 days left</td>
                                                <td>$3,850</td>
                                            </tr>
                                            <tr>
                                                <td>Databay.ca</td>
                                                <td>07 days left</td>
                                                <td>$3,500</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Redflagdeal.ca</td>
                                                <td>19 days left</td>
                                                <td>$3,50</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Humid.ca</td>
                                                <td>20 days left</td>
                                                <td class="green-price">$4,500</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Hamiltonmap.ca</td>
                                                <td>27 days left</td>
                                                <td>$2,450</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Torontoislands.ca</td>
                                                <td>13 days left</td>
                                                <td>$3,850</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><a class="btn btn-table" title="See All Domains">See All Domains</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="domain-boxes aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="200">
                                <div class="price-header">Ending Soon</div>
                                <div class="domain-box">
                                    <div class="domain-price-table">
                                        <table class="table-domain-price">
                                            <tr>
                                                <th class="title">Domain Name</th>
                                                <th class="title">Deal Time</th>
                                                <th class="title">Price</th>
                                            </tr>
                                            <tr>
                                                <td>Bonding.ca</td>
                                                <td>26 days left</td>
                                                <td>$3,500</td>
                                            </tr>
                                            <tr>
                                                <td>Fastcabs.ca</td>
                                                <td>13 days left</td>
                                                <td>$21000</td>
                                            </tr>
                                            <tr>
                                                <td>Wive.ca</td>
                                                <td>12 days left</td>
                                                <td>$4,500</td>
                                            </tr>
                                            <tr>
                                                <td>Dryfruit.ca</td>
                                                <td>10 days left</td>
                                                <td>$12,45</td>
                                            </tr>
                                            <tr>
                                                <td>Hijack.ca</td>
                                                <td>15 days left</td>
                                                <td class="green-price">$3,850</td>
                                            </tr>
                                            <tr>
                                                <td>Databay.ca</td>
                                                <td>07 days left</td>
                                                <td>$3,500</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Redflagdeal.ca</td>
                                                <td>19 days left</td>
                                                <td>$3,50</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Humid.ca</td>
                                                <td>20 days left</td>
                                                <td class="green-price">$4,500</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Hamiltonmap.ca</td>
                                                <td>27 days left</td>
                                                <td>$2,450</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Torontoislands.ca</td>
                                                <td>13 days left</td>
                                                <td>$3,850</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><a class="btn btn-table" title="See All Domains">See All Domains</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12">
                            <div class="domain-boxes aos-init" data-aos="fade-right" data-aos-easing="ease-out-back" data-aos-delay="200">
                                <div class="price-header">Featured Domains</div>
                                <div class="domain-box">
                                    <div class="domain-price-table">
                                        <table class="table-domain-price">
                                            <tr>
                                                <th class="title">Domain Name</th>
                                                <th class="title">Deal Time</th>
                                                <th class="title">Price</th>
                                            </tr>
                                            <tr>
                                                <td>Bonding.ca</td>
                                                <td>26 days left</td>
                                                <td>$3,500</td>
                                            </tr>
                                            <tr>
                                                <td>Fastcabs.ca</td>
                                                <td>13 days left</td>
                                                <td class="green-price">$21000</td>
                                            </tr>
                                            <tr>
                                                <td>Wive.ca</td>
                                                <td>12 days left</td>
                                                <td>$4,500</td>
                                            </tr>
                                            <tr>
                                                <td>Dryfruit.ca</td>
                                                <td>10 days left</td>
                                                <td>$12,45</td>
                                            </tr>
                                            <tr>
                                                <td>Hijack.ca</td>
                                                <td>15 days left</td>
                                                <td>$3,850</td>
                                            </tr>
                                            <tr>
                                                <td>Databay.ca</td>
                                                <td>07 days left</td>
                                                <td>$3,500</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Redflagdeal.ca</td>
                                                <td>19 days left</td>
                                                <td>$3,50</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Humid.ca</td>
                                                <td>20 days left</td>
                                                <td>$4,500</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Hamiltonmap.ca</td>
                                                <td>27 days left</td>
                                                <td>$2,450</td>
                                            </tr>
                                            <tr class="d-none d-sm-block">
                                                <td>Torontoislands.ca</td>
                                                <td>13 days left</td>
                                                <td class="green-price">$3,850</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><a class="btn btn-table" title="See All Domains">See All Domains</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Transfer domains section -->
    <!-- <div class="transfer-domain">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    {{--<h2 class="text-center aos-init" data-aos="fade-up" data-aos-delay="100">Transfer Domains to Host It Smart Domains Fast and Easy</h2></div>
                <div class="col-12 col-sm-8">
                    <div class="left aos-init" data-aos="fade-left" data-aos-delay="400">
                        <div class="title">
                            <p>Transfer your domain to Host It Smart and benefit from advantages like:</p>
                        </div>
                        <div class="points">
                            <ul>
                                <li>State-of-the-art domain tools, DNS Management, domain forwarding and much more</li>
                                <li>The lowest prices</li>
                                <li>24/7 Support</li>
                            </ul>
                        </div>
                        <div class="tranfer-btn"><a href="{{url('/domain/domain-transfer')}}" class="btn-primary" title="Transfer Domains">Transfer Domains</a></div>
                    </div>
                </div>--}}
                <div class="col-12 col-sm-4">
                  {{--<div class="right aos-init" data-aos="zoom-in-right" data-aos-delay="400"><img src="assets/images/domain_landing/transfer-domain.png" alt="Transfer Domain"></div>--}}
                </div>
                <div class="col-sm-12">
                    <div class="partner">
                        <div class="title aos-init" data-aos="fade-up" data-aos-delay="500">
                            <p>Host IT Smart is a recognized partner of:</p>
                        </div>
                        <div class="partner-slider aos-init" data-aos="fade-up" data-aos-delay="600">
                            <div class="owl-carousel partner-slider-owl owl-theme">
                                <div class="item">
                                    <div class="p-logo"><img alt=".biz" title=".biz" src="assets/images/domain_transfer/biz.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".click" title=".click" src="assets/images/domain_transfer/click.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".club" title=".club" src="assets/images/domain_transfer/club.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".co" title=".co" src="assets/images/domain_transfer/co.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".diet" title=".diet" src="assets/images/domain_transfer/diet.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".eu" title=".eu" src="assets/images/domain_transfer/eu.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".flower" title=".flower" src="assets/images/domain_transfer/flower.webp"></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".host" title=".host" src="assets/images/domain_transfer/host.webp"></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".hosting" title=".hosting" src="assets/images/domain_transfer/hosting.webp"></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".link" title=".link" src="assets/images/domain_transfer/link.webp"></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".online" title=".online" src="assets/images/domain_transfer/online.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".org" title=".org" src="assets/images/domain_transfer/org.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".photo" title=".photo" src="assets/images/domain_transfer/photo.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".pw" title=".pw" src="assets/images/domain_transfer/pw.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".radio" title=".radio" src="assets/images/domain_transfer/radio.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".tattoo" title=".tattoo" src="assets/images/domain_transfer/tattoo.webp"></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".tech" title=".tech" src="assets/images/domain_transfer/tech.webp"></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".tickets" title=".tickets" src="assets/images/domain_transfer/tickets.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".tld" title=".tld" src="assets/images/domain_transfer/tld.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".us" title=".us" src="assets/images/domain_transfer/us.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".website" title=".website" src="assets/images/domain_transfer/website.webp" ></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".ws" title=".ws" src="assets/images/domain_transfer/ws.webp"></div>
                                </div>
                                <div class="item">
                                    <div class="p-logo"><img alt=".xyz" title=".xyz" src="assets/images/domain_transfer/xyz.webp" ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Transfer domains section end -->
    <!-- Domain Registry Memberships start-->
    <div class="domain-membership head-tb-p-40">
        <div class="container">
            <div class="row">
                <div class="section-heading">
                    <h2 class="text_head text-center">Domain Registry Memberships</h2>
                </div>
                <div class="col-sm-12">
                    <div class="members-outter">
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member1.webp" alt="Domain Registry Member" title="Verisign"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member2.webp" alt="Domain Registry Member" title="Uniregistry"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member3.webp" alt="Domain Registry Member" title="Donuts"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member4.webp" alt="Domain Registry Member" title="Your Public Interest Registry"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member5.webp" alt="Domain Registry Member" title="Neustar"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member6.webp" alt="Domain Registry Member" title="Famous for media"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member7.webp" alt="Domain Registry Member" title="Central Nic"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member8.webp" alt="Domain Registry Member" title=".Co"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member9.webp" alt="Domain Registry Member" title="Global Authentication"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member10.webp" alt="Domain Registry Member" title="Certified Registrar"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member11.webp" alt="Domain Registry Member" title=".Ca"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member12.webp" alt="Domain Registry Member" title="Radix"/>
                        </div>
                        <div class="members-box">
                            <img src="assets/images/domain_transfer/member13.webp" alt="Domain Registry Member" title="Nixi"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Domain Registry Memberships end -->
    <!---Country Filter-->
    <div class="country-filter-main head-tb-p-40">
        <div class="container">
            <div class="country-main">
                <div class="filter-head">
                    <div class="row">
                        <div class="mr-auto">
                            <div class="text_head text-center">Countries</div>
                        </div>
                        <div class="country-search text-center">
                            <div class="banner-search aos-init" data-aos="fade-right">
                                <form action="{{url('/domain/bulk-domain-search')}}" class="custom-search" method="post" id="bulksearchfrm" onsubmit="javascript: return joindomain();">
                                    <!--<input type="text" placeholder="Enter upto 100 names, seperated by spaces or commas.." name="bulkdomains" id="bulkdomains">-->
                                    <textarea class="countries-search" placeholder="Enter upto 100 names, seperated by spaces or commas.."  name="bulkdomains" id="bulkdomains"></textarea>
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                                    <span id="err_html" class="error" style="display: none;"> </span>
                                    <button type="submit" title="Search"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-tabbing aos-init" data-aos="fade-left" data-aos-easing="ease-out-back" data-aos-delay="600">
                    <ul class="nav nav-tabs nav-country d-none d-md-block">
                        @php
                        $k = 1;
                        @endphp
                        @foreach ($tldcatdata as $key => $value)
                        <?php
                        if ($k == 1)
                            $cat_display = "active";
                        else
                            $cat_display = "";
                        ?>
                        <li>
                            <a data-toggle="tab" href="#<?= str_replace(" ", "_", $key) ?>" class="{{$cat_display}}" title="{{$key}}"><span>{{$key}}</span></a>
                        </li>
                        @php
                        $k++;
                        @endphp
                        @endforeach
                    </ul>
                    <div class="mob-country-combo d-md-none d-block">
                        <div class="col-12">
                            <select class="selectpicker" onchange="setcountrydata(this.value);">
                                @foreach ($tldcatdata as $key => $value)
                                <option value="<?= str_replace(" ", "_", $key) ?>">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="tab-content">

                        @php
                        $t = 1;
                        @endphp

                        @foreach ($tldcatdata as $key => $value)

                        @if($t == 1)
                        @php
                        $div_display = "in active";
                        @endphp
                        @else
                        @php
                        $div_display = "";
                        @endphp
                        @endif
                        @php
                        $rep_key =  str_replace(" ","_",$key);
                        @endphp


                        <div id="{{$rep_key}}" class="tab-pane {{$div_display}}">
                            <div class="country_tabbing-main">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="country-main-tabbing row">
                                            @php
                                            $p = 1;
                                            $count = 1;
                                            $color_code = 1;
                                            @endphp
                                            @foreach ($value as  $tld)
                                            @php
                                            $Tld_Main = explode('*',$tld);

                                            $exp_tld = explode('.',$Tld_Main[0]);

                                            if(!empty($Tld_Main[1])){
                                            $country = $Tld_Main[1];
                                            }
                                            else{
                                            $country = $Tld_Main[0];
                                            }
                                            $rep_tld = substr($exp_tld[0],0,4);
                                            if($color_code == 1){
                                            $color = 'flag-yellow';
                                            }
                                            elseif($color_code == 2){
                                            $color = 'flag-pink';
                                            }
                                            elseif($color_code == 3){
                                            $color = 'flag-purple';
                                            }
                                            elseif($color_code == 4){
                                            $color = 'flag-orange';
                                            }
                                            elseif($color_code == 5){
                                            $color = 'flag-green';
                                            }
                                            elseif($color_code == 6){
                                            $color = 'flag-red';
                                            }
                                            elseif($color_code == 7){
                                            $color = 'flag-sky';
                                            }
                                            elseif($color_code == 8){
                                            $color = 'flag-lighty';
                                            }

                                            @endphp

                                            <div class="col-12">
                                                <div class="c-radio-btn d-flex">
                                                    <label class="custom-radio">
                                                        <div class="common-map custom-flag {{$color}}">{{$rep_tld}}</div>
                                                        {{$country}} <input type="checkbox" name="c_tld[]" id="c_tld_{{$count}}" class="tld_checkbox" value="{{$Tld_Main[0]}}"> <span class="checkmark"></span>
                                                    </label>
                                                    <span class="domain-country ms-auto">.{{$Tld_Main[0]}}
                                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php
                                            $p++;
                                            $color_code++;
                                            if ($p == 12) {
                                                echo "</div></div><div class='col-lg-4 col-sm-6 col-12'><div class='country-main-tabbing row'>";
                                                $p = 1;
                                            }

                                            if ($color_code == 9) {
                                                $color_code = 1;
                                            }
                                            $count++;
                                            ?>

                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @php
                        $t++;

                        @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="promotional-banner row for-green-banner-col-width">
    <div class="col-lg-4 col-12 z-index-1 padding-0">
        <div class="row">
            <div class="banner-1 justify-content-end d-flex">
                <div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">WordPress hosting Deals</span>
                <div class="banner-wp-blue-logo"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12 z-index-0 padding-0">
        <div class="row">
            <div class="banner-text2"><span class="starting-from">Today Starting From</span> <span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">100</span><span class="per-month">/mo*</span></span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12 padding-0 d-flex">
        <div class="row align-self-center" data-aos="fade-right">
            <div class="banner-button"><a href="{{url('hosting/wordpress-hosting')}}" class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
        </div>
    </div>
</div>-->
<div class="about-main-div head-tb-p-40">
    <div class="container">
        <div class="about-div row cms">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                    <img src="{{url('/')}}/assets/images/domain_transfer/server2.webp" alt="We are always here to help you!" class="" style="max-width: 70px;">
                    <h2 class="about-head text_head">Tips To Find The<span class="green"> Best Domain Name </span></h2>
                        <div class="clearfix"></div>
                    
                    <div class="about_description">
                        
                        
                        <p class="about-text"><i class="domain-registration-icon"></i>A domain is basically referred to as a location of a Website. It contains a group of computers which can be accessed and administered with a common set of rules. It basically refers to a particular distinct subset of the Internet where a common suffix is shared by certain addresses or is under the control of a particular organisation or an individual.</p>
                        <p class="about-text"><i class="domain-registration-icon"></i>When a number of computers and devices are administered as a single unit with common rules and procedures attached to them on a network, it forms a Domain. These Domains are defined by an IP address and all the devices sharing a common section of an IP address are considered to be on the same domain. </p>
                        <p class="about-text"><i class="domain-registration-icon"></i>The Domain name acts as the face of your website. Thus, it is very important from the point of view of your website for you to have a good Domain name.</p>
                        <p class="about-text"><i class="domain-registration-icon"></i>Although there is nothing like the best domain name or an ideal domain name, a good domain generally must have certain highlighting characteristics as mentioned below.</p>
                        <p class="about-text"><i class="domain-registration-icon"></i>It must be short. It is very important for a good domain name to be short and crisp. The main reason for this is that a shorter name is anytime much easier to remember and has a better recall value. Ideally, a domain name should be below 10 characters. It is for the same reason that the shorter domains like .com and .in are already taken away. </p>
                        <p class="about-text"><i class="domain-registration-icon"></i>Most of the users of the internet simply memorize the domain names of their preferred websites and reach out to them as and when required. Thus, a good domain name must be one that is easy to remember. If at all you have a complicated domain name that might be difficult to memorize, you might end up losing a number of visitors which can be a great loss. Easy to remember domain names help in the domain name search which is a big bonus to have. </p>
                        <p class="about-text"><i class="domain-registration-icon"></i> It must be uncomplicated and easy to spell. Many a times, websites happen to choose complicated combinations of words, foreign terms or difficult words in general. This can lead to loss of visitors if at all they cannot reach you. Losing your visitors for a reason that they misspelled your domain name is the last thing that you want. 
                        </p>
                        <p class="about-text"><i class="domain-registration-icon"></i>It should describe the essence of you and your website. Visitors come across your website while they are searching via the search engine. They will choose to enter your website only if the domain name explains and details regarding the same. Thus, a descriptive domain name can ensure you more visitors and help improve your SEO ratings as well.
                        </p>
                        <p class="about-text"><i class="domain-registration-icon"></i>A good domain name does not have numbers or hyphens. Generally, domain names with hyphens or numbers are monetarily cheap domain names. Such domain names can lead to confusion and can lead to you lose your visitors.
                        </p>
                        <p class="about-text"><i class="domain-registration-icon"></i>A good domain name is brandable. This means that it has an interesting combination of letters and an attractive pronunciation, helping the visitors identify and associate with your website, its ideology and content.
                        </p>
                        <p class="about-text"><i class="domain-registration-icon"></i>It is believed that a .com extension to your domain name can make it one of the best domain names. Generally, organisations prefer a .org extension. It is understood as a fact that the .com extension is the most popular and well recognized extension and is the one that people generally, attach to your website name. To search and buy a domain online, all you have to do is simply enter the desired name in a domain name checker or a domain name finder and press enter. You will be presented with a list of domains in tandem with your search. Some of the websites choose to buy cheap domain names from certain domain name finders and must ensure the legitimacy and safety of such names. There are various benefits of registering a domain name to your website.
                        </p>
                        <p class="about-text"><i class="domain-registration-icon"></i>The process of domain registration in India is extremely easy. The web address generally begins with www. You are allowed to buy and register a domain name for a minimum of one year to and maximum of ten years. Once purchased the above domain name, you get access and ownership for the said period of time.</p>
                        <p class="about-text"><i class="domain-registration-icon"></i>
                        There is no such thing as free domain registration. Though, there have been certain domain name checkers and domain name finders that do offer free or cheap domain registration. However, it must be understood that this is only for a certain time period and gradually comes to a point where you have to start paying for the same. However, you do have an option where you can buy or purchase cheap domain names as there are many portals offering this service. While most of these are reputable vendors, it is crucial to take precautions and
                        make sure that you are engaging with a legitimate source.
                        </p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="vps-features vps-plan-features head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <div class="section-heading">
                <h3 class="text-center text_head">Why Does a Website Need to Have a Domain Name?</h3>
                </div>
                <div class="features-start d-md-block d-none">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start aos-animate aos-init">
                                    <div class="feature-icon d-flex justify-content-center align-items-center">
                                        <i class="credibility-icon"></i>
                                    </div>
                                    <h3>Credibility</h3>
                                    <div class="content">A domain name is a critical part of your brand identity. It helps in creating a distinct and memorable online presence. A unique and relevant domain name contributes to the overall branding strategy, making it easier for users to remember and revisit your site.</div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start aos-animate aos-init">
                                    <div class="feature-icon d-flex justify-content-center align-items-center">
                                        <i class="vps-features-icon secureandrobust"></i>
                                    </div>
                                    <h3>Mobility</h3>
                                    <div class="content">If you think of changing your hosting provider or moving your website to a different server in the future, At that moment, having your own domain name makes the process much smoother. You can continue to access your website using your domain, no matter where your website is hosted. </div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start aos-animate aos-init">
                                    <div class="feature-icon d-flex justify-content-center align-items-center">
                                        <i class="brand-building-icon"></i>
                                    </div>
                                    <h3>Brand Building</h3>
                                    <div class="content">A domain name is the most important part of your brand identity. It creates a unique & memorable online presence. A relevant domain name makes it easier for users to remember & revisit your website, which contributes to the overall branding strategy.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                        <div class="owl-carousel owl-theme owl-loaded owl-drag">
                        <div class="owl-stage-outer"><div class="owl-stage" style="left: 0px;"><div class="owl-item"><div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon containerized-server"></i></div>
                                        <h3>Credibility</h3>
                                        <div class="content">A Domain name attaches credibility to your Website and helps your website to come across as a genuine and professional one; something that a generic URL would never be capable of. A registered Domain name ensures the authenticity and increases the credibility of your website.</div>
                                    </div>
                                </div>
                            </div></div><div class="owl-item"><div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon secureandrobust"></i></div>
                                        <h3>Mobility</h3>
                                        <div class="content">Buying a website domain adds a level of mobility to your presence on the Web, enabling you to transfer and shift your respective web hosts. If you haven’t purchased a domain name, you will have to pick up a new URL altogether which might nullify the entire branding previously done by your initial address. </div>
                                    </div>
                                </div>
                            </div></div><div class="owl-item"><div class="item">
                                <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                    <div class="content-main align-self-start">
                                        <div class="feature-icon"><i class="vps-features-icon virtual-support"></i></div>
                                        <h3>Brand Building</h3>
                                       <div class="content">Buying a domain name helps to build and brand your website, thus increasing the recall value of your Website name.</div>
                                    </div>
                                </div>
                            </div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                            <!-- <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button></div> -->
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="features-domain-div why-transfer">
    <div class="features_section domain-search head-tb-p-40">
        <div class="container">
            <div class="section-heading">
            <h3 class="features-main-title text-center text_head">
                Domain Registration service offered by us:
            </h3>
            </div>
            <div class="row d-hide-mob">
                <div class="features1 col-lg-3 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit transfer"></i>
                        </div>
                        <h3 class="services-head" title="Transfer your Domain">Transfer your Domain</h3>
                        <div class="services-text">
                            Transfer your domain and avail amazing offer,it is simple and efficient.
                        </div>
                    </div>
                </div>
                <div class="features1 col-lg-3 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit domain-registration"></i>
                        </div>
                        <h3 class="services-head" title="Bulk Domain Name Registration">Bulk Domain Name Registration</h3>
                        <div class="services-text">
                            Checking domain name availability has became hassle-free with us buy domain at cheaper price and Register up to 100 domains at once 
                        </div>
                    </div>
                </div>
                <div class="features1 col-lg-3 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit renew-domain"></i>
                        </div>
                        <h3 class="services-head" title="Renew a Domain">Renew a Domain</h3>
                        <div class="services-text">
                          Renew your domain name for up to 10 years
                        </div>
                    </div>
                </div>
                 
                <div class="features1 col-lg-3 col-sm-6 col-12">
                    <div class="services-main align-self-center" data-aos="flip-left">
                        <div class="services-icon d-flex align-items-center justify-content-center">
                            <i class="why_transfer_sprit pricing"></i>
                        </div>
                        <h3 class="services-head" title="View Domain Pricing">View Domain Pricing</h3>
                        <div class="services-text">
                          Compare pricing for several extensions
                        </div>
                    </div>
                </div>
                 
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="featuredomain_slider">
                        <div class="features-start features-start-mob d-md-none d-block">
                            <!-- features-start-mob -->
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit transfer"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                Transfer your Domain
                                            </h3>
                                            <div class="services-text">
                                                 Transfer your domain and avail amazing offer,it is simple and efficient.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit domain-registration"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                Bulk Domain Name Registration
                                            </h3>
                                            <div class="services-text">
                                                Checking domain name availability has became hassle-free with us buy domain at cheaper price and Register up to 100 domains at once
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit renew-domain"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                Renew a Domain
                                            </h3>
                                            <div class="services-text">
                                                Renew your domain name for up to 10 years
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="features1 col-lg-4 col-12 d-flex">
                                        <div class="services-main align-self-center">
                                            <div class="services-icon d-flex align-items-center justify-content-center">
                                                <i class="why_transfer_sprit pricing"></i>
                                            </div>
                                            <h3 class="services-head d-flex align-items-center">
                                                View Domain Pricing
                                            </h3>
                                            <div class="services-text">
                                               Compare pricing for several extensions
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
    </div>
</div>
{{-- <div class="lading_bottom">
    @if(!empty($FaqData) && count($FaqData) >0)
    <div class="getquestion-div">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 data-aos="fade-up">Domain Registration: Frequently Asked Questions</h3>
                </div>
                <div id="accordion" class="accordion faq-wrap">
            <div class="row align-items-center">
                
                <div class="col-md-12 col-lg-12">
                    <div id="accordion" class="accordion faq-wrap">
                        @php $i = 0; $class = ''; $class1 = ''; $class2 = ''; $class3 = '';  $class4 = ''; @endphp

                        @foreach($FaqData as $Faq)
                        @php if ($i == '0'){
                            $class = 'show'; $class1 = ''; $class2 = 'display:block';
                            $open_class = 'active-accordition';
                        } else {
                            $class = ''; $class1 = 'collapsed'; $class2 = 'display:none';
                            $open_class = '';
                        } if ($i > '4'){
                            $class3 = 'display:none'; $class4 = 'display:block';
                        } else {
                            $class3 = ''; $class4 = 'display:none';
                        } @endphp
                        <div class="card mb-3 faqs-card"  style=" {{ $class3 }} ">
                            <a class="card-header collapsed {{ $class1 }}" data-toggle="collapse" href="#collapse{{ $i }}" aria-expanded="false">

                                 

                                <h4 class="mb-0 d-inline-block faqs-span">{!! isset($Faq->varTitle) && !empty($Faq->varTitle) ? str_replace("@sitename", Config::get('Constant.SITE_NAME'), $Faq->varTitle) : "" !!} </h4>
                            </a>
                            <div id="collapse{{ $i }}" class="collapse {{ $class }}" data-parent="#accordion" style="">
                                <div class="card-body white-bg">
                                    {!!
                                    isset($Faq->txtDescription) && !empty($Faq->txtDescription) ?
                                    str_replace('@sitename',Config::get('Constant.SITE_NAME'),
                                    str_replace('@siteurl',url('/'),
                                    str_replace('@sys_currency_symbol',Config::get('Constant.sys_currency_symbol'),$Faq->txtDescription)
                                    )
                                    )
                                    :""
                                    !!}
                                   
                                </div>
                            </div>
                        </div>
                        @php $i++;@endphp
                        @endforeach
                    </div>                     
                </div>
                <div class="col-12 aos-init" data-aos="fade-up" style="{{$class4}}">
                    <a href="javascript::void(0);" id="show" title="More" class="btn btn-outline-brand-02 mt-3 mr-2">More</a>
                </div>
                <script> $("#show").click(function () { $(".card").show(); $("#show").hide(); }); </script>
            </div>
        </div>
            </div>
        </div>
    </div>
    @endif --}}
<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')

    @if(!empty($FeaturedProductsData) && count($FeaturedProductsData) > 0)
    <div class="hostingtype_div">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h3 class="title">Didn't hit your sweet spot?</h3>
                </div>
                @php $p = 0; $classpro = ''; $color = ''; $info = ''; @endphp
                @foreach($FeaturedProductsData as $FeaturedProducts)
                @php
                if ($p == '0'){
                $classpro = 'd-flex justify-content-end';
                $color = 'left_part';
                } else {
                $classpro = ''; 
                $color = 'right_part';
                }     
                @endphp
                <div class="col-lg-6 {{$color}} {{$classpro}}">
                    <div class="hosting_box d-flex">
                        <div class="image align-self-center" data-aos="fade-right" data-aos-delay="250">
                            <i class="{{$FeaturedProducts->varIconClass}}"></i>
                            <div class="hosting-price-start">Starting at 
                                @if(Config::get('Constant.sys_currency') == 'INR')
                                <span class="color-green"><i class="rupees">&#8377;</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</strong>/mo*</span>
                                @else
                                <span class="color-green"><i class="rupees">&#36;</i><strong>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_USD') }}</strong>/mo*</span>
                                @endif
                            </div>
                        </div>
                        <div class="info" data-aos="fade-left" data-aos-delay="100">
                            <h2 class="name">{{$FeaturedProducts->varTitle}}</h2>
                            <h3 class="info-text">{{$FeaturedProducts->varShortDescription}}</h3>
                            @php $FeaturedProducts_expload = explode("\n",$FeaturedProducts->varFeature); @endphp
                            <ul class="list">
                                @foreach($FeaturedProducts_expload as $info)
                                <li><h6>{{$info}}</h6></li>
                                @endforeach
                            </ul>
                            <a href="{{$FeaturedProducts->varButtonLink}}" class="btn" title="{{$FeaturedProducts->varButtonName}}">{{$FeaturedProducts->varButtonName}}</a>
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

<div class="product_offers">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-10">
            <div class="product_offers_main">
                <div class="product_offers_head">
                    <h2>Web Hosting</h2>
                </div>
                <div class="product_offers_cnt">
                    <div class="product_offers_price">
                        <ul>
                        <li class="product_offers_prc_head">Starting From</li>
                        <li class="product_off_prc_pr"><span class="rupees_icon">₹</span>45<span class="month_icon">/mo*</span></li>
                        </ul>
                    </div>
                </div>
                    <div class="product_offers_btn">
                        <a href="{{ url('/web-hosting') }}">Click to Host Today</a>
                    </div>
                
            </div>
        </div>
    </div>
    </div>
</div>

<script type="text/javascript">
    var domain_tld_array = [];
    Array.prototype.remove = function () {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };
    function setcountrydata(val) {
        $(".tab-pane").removeClass("active");
        $(".tab-pane").removeClass("show");

        $("#" + val).addClass("active show in");
    }

    function trim(str, chars) {
        return ltrim(rtrim(str, chars), chars);
    }
    function ltrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
    }
    function rtrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
    }
    function joindomain()
    {

        var domainstr = '';
        var domainname = document.getElementById('bulkdomains').value;
        var rep_space = domainname.replace(/\s/g, "\n");
        var rep_comma = rep_space.replace(/,/g, "\n");
        var domainarray = rep_comma.split("\n");

        if (trim(domainname) == "")
        {
            $("#err_html").html("Please enter domain name.");
            $(".error").show();
            return false;
        }
        if (domain_tld_array.length > 0) {
            for (var i = 0; i < domain_tld_array.length; i++)
            {

                for (var j = 0; j < domainarray.length; j++)
                {
                    if (trim(domainarray[j]) != '')
                    {
                        var domain_check2 = domainchecker2(domainarray[j]);
                        var tld = domainarray[j].split(".");
                        if (tld[1]) {
                            $("#err_html").html("Please remove domain extension as you have already choose tld option.");
                            $(".error").show();
                            return false;
                        } else if (domain_check2 == false) {
                            $("#err_html").html("Please remove illegal characters from the domain.");
                            $(".error").show();
                            return false;
                        } else {

                            domainstr = domainstr + domainarray[j] + "." + domain_tld_array[i] + "\n";
                        }
                    }
                }
            }
        } else {

            for (var j = 0; j < domainarray.length; j++)
            {
                if (trim(domainarray[j]) != '')
                {
                    var domain_check = domainchecker(domainarray[j]);
                    var tld = domainarray[j].split(".");
                    if (!tld[1]) {
                        $("#err_html").html("please enter proper domain with extension.");
                        $(".error").show();
                        return false;
                    } else if (domain_check == false) {
                        $("#err_html").html("please enter proper domain.");
                        $(".error").show();
                        return false;
                    } else {
                        domainstr = domainstr + domainarray[j] + "\n";
                    }
                }
            }
        }

        document.getElementById('bulkdomains').value = trim(domainstr);
    }

    function domainchecker(value) {
        return  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) || /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/.test(value);
    }

    function domainchecker2(value) {
        return /^[a-zA-Z0-9- ]*$/.test(value);
    }

    $('.tld_checkbox').click(function () {
        var check_tld = $(this).val();
        var rep_tld = check_tld.replace(".", "_");
        if ($(this).prop('checked') == true) {
            domain_tld_array.push(check_tld);
            console.log(domain_tld_array);
        } else if ($(this).prop('checked') == false)
        {
            domain_tld_array.remove(check_tld);
            console.log(domain_tld_array);
        }
    });


</script>

<script>
    $(document).ready(function() {
        $('.partner-slider-owl').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true, // Enable autoplay
            autoplayTimeout: 2000, // Autoplay interval in milliseconds (5 seconds in this example)
            responsive: {
                0: {
                    items: 5
                },
                600: {
                    items: 6
                },
                1000: {
                    items: 8
                }
            }
        });
    });
</script>
@endsection
