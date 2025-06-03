<header class="header_section"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php $curUrl = Request::segment(1);
    //if(empty($curUrl)){ ?>
    <div class="top-header text-center" id="top_bar">
				<div class="container">
				    <div class="top_buy">
                        <a id="goto_legacy" href="javascript:void(0);" title="">Our phone support will be unavailable due to scheduled maintenance, you can contact us via chat & tickets.</a>
                    </div>
                </div>
	</div>
    <?php //} ?>        
    @if(isset($dealsData))
    @if(count($dealsData)>0)
    <div class="top-header text-center aos-init" data-aos="fade-down" style="display:none;">
        <div class="container">
            <div class="top_buy">
                @if(Config::get('Constant.sys_currency') == 'INR')
                @php $FeaturedProducts_expload = explode("\n",$dealsData->varHomePageDealsContent);
                $dtext_rep = str_replace("[@INRCURRENCY]","<span class='rupee-icon'>&#8377;</span>",$FeaturedProducts_expload[0]);
                $dtexttitle = str_replace("[@INRCURRENCY]","&#8377;",$FeaturedProducts_expload[0]);
                @endphp
                @else
                @php $FeaturedProducts_expload = explode("\n",$dealsData->varHomePageDealsContent);
                $dtexttitle = str_replace("[@USDCURRENCY]","&#36;",$FeaturedProducts_expload[1]);
                $dtext_rep = str_replace("[@USDCURRENCY]","<span class='rupee-icon'>&#36;</span>",$FeaturedProducts_expload[1]);
                @endphp
                @endif
                <a id="top_greenbar" href="{{url('/deals?id=').$dealsData->id}}" title="{!!$dtexttitle!!}">{!! $dtext_rep !!}<span class="btn">Buy Now</span></a>
                <i class="la la-close" onclick="hidetopdeals();"></i>
            </div>
        </div>
    </div>
    @endif
    @endif
    <div class="mainheader">
        <div class="container">
            <div class="row">
                @if(isset($contactData))
                <div class="col-sm-2 col-4">
                    <?php /*<div class="logo aos-init" data-aos="fade-right" itemscope itemtype="http://schema.org/Organization">*/?>
                        <a href="{{url('/')}}" itemprop="url" title="{{ Config::get('Constant.SITE_NAME') }}"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/logo.png" itemprop="logo" alt="{{ Config::get('Constant.SITE_NAME') }}"/></a>
                         @if(empty(Request::segment(1)))
                        <?php /*<div  itemscope itemtype="http://schema.org/Organization">
    <span style="display:none" itemprop="name">Host IT Smart</span>
    <span style="display:none" itemprop="email">Support@HostITSmart.com</span>
    <span style="display:none" itemprop="image"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/logo.png" itemprop="image" alt="HostITSmart"></span>
    <span style="display:none" itemprop="telephone">079-6605-0099</span>
    <span style="display:none" itemprop="url">https://www.hostitsmart.com/</span>
    <span style="display:none" itemprop="description">Host IT Smart is India's leading hosting company and we offer web hosting, dedicated servers, domain registration, SSL and more in India with 24X7 support.</span>
    <div style="display:none" itemscope itemtype="http://schema.org/PostalAddress">
        <span itemprop="name">Host IT Smart - Address</span>
        <span itemprop="streetAddress">501, Mauryansh Elanza, 
    Beside Parekh&#039;s Hospital,
    Near Shyamal Cross Roads, Satellite</span>
        <span itemprop="addressRegion">Ahmedabad, Gujarat</span><span itemprop="addressCountry">India</span>
                    </div>
                    </div>*/?>
                    @endif
                <?php /*</div>*/?>
                </div>
                @endif
                <div class="col-sm-10 col-8 d-flex flex-xl-row flex-row-reverse align-items-center justify-content-lg-start justify-content-xl-end">
                    <div class="navbar-header aos-init" data-aos="fade-left" data-aos-delay="100">
                        <a href="javascript:;" class="nav-toggle"><span></span><span></span><span></span></a>
                        <!--headermenu-->@php
                        $domain_selected = "";
                        $hosting_selected = "";
                        $email_selected = "";
                        $servers_selected = "";
                        $sitelock_hosting_selected = "";
                        $ssl_selected = "";
                        $register_selected = "active";
                        $windows_hosting_selected = "active";
                        $wordpress_hosting_selected = "";
                        $java_hosting_selected = "";
                        $ecommerce_hosting_selected = "";
                        $reseller_hosting_selected = "";
                        $vps_hosting_selected = "active";
                        $dedicated_servers_selected = "";
                        $googleapps_email_selected="active";
                        $office365_selected="";
                        $deals_selected = "";
                        $home_selected = "";
                        $domain_transfer = "";
                        $bulk_domain_search_selected = "";
                        $new_extensions_selected = "";
                        $tld_selected = "";
                        $domain_policy_selected = "";
                        $whois_selected = "";
                        @endphp
                        @if(request()->route()->getName() == "home")
                        @php
                        $home_selected = "active";
                        @endphp
                        @endif
                        @if(Request::segment(1) == "deals")
                        @php
                        $deals_selected = "active";
                        @endphp
                        @endif
                        @if(request()->route()->getName() == "product_category" && !empty(Request::segment(1)) && empty(Request::segment(2)))
                        @if(Request::segment(1) == "domain")
                        @php 
                        $domain_selected = "active";
                        $register_selected = "active";
                        @endphp
                        @elseif(Request::segment(1) == "hosting")
                        @php 
                        $hosting_selected = "active";
                        $windows_hosting_selected = "active";
                        @endphp
                        @elseif(Request::segment(1) == "servers")
                        @php 
                        $servers_selected = "active";
                        $vps_hosting_selected = "active";
                        @endphp
                        @elseif(Request::segment(1) == "email")
                        @php 
                        $email_selected = "active";
                        $googleapps_email_selected = "active";
                        @endphp
                        @elseif(Request::segment(1) == "ssl")
                        @php
                        $ssl_selected = "active";
                        @endphp    
                        @endif
                        @endif
                        @if(request()->route()->getName() == "product_landing" && Request::segment(1) == "domain" && !empty(Request::segment(2)))
                        @php $register_selected = ""; @endphp
                        @if(Request::segment(2) == "domain-transfer")
                        @php 
                        $domain_transfer = "active";
                        $domain_selected = "active";
                        @endphp
                        @elseif(Request::segment(2) == "bulk-domain-search")
                        @php 
                        $bulk_domain_search_selected = "active";
                        $domain_selected = "active";
                        @endphp
                        @endif
                        @elseif(request()->route()->getName() == "product_landing" && Request::segment(1) == "hosting" && !empty(Request::segment(2)))
                        @php $windows_hosting_selected = ""; @endphp
                        @if(Request::segment(2) == "windows-hosting" || Request::segment(2) == "linux-hosting")
                        @php 
                        $windows_hosting_selected = "active";
                        $hosting_selected = "active";
                        @endphp
                        @elseif(Request::segment(2) == "wordpress-hosting")
                        @php 
                        $wordpress_hosting_selected = "active";
                        $hosting_selected = "active";
                        @endphp
                        @elseif(Request::segment(2) == "java-hosting")
                        @php 
                        $java_hosting_selected = "active";
                        $hosting_selected = "active";
                        @endphp
                        @elseif(Request::segment(2) == "ecommerce-hosting")
                        @php 
                        $ecommerce_hosting_selected = "active";
                        $hosting_selected = "active";
                        @endphp
                        @elseif(Request::segment(2) == "site-lock")
                        @php 
                        $sitelock_hosting_selected = "active";
                        $hosting_selected = "active";
                        @endphp
                        @elseif(Request::segment(2) == "windows-reseller-hosting" || Request::segment(2) == "linux-reseller-hosting")
                        @php 
                        $reseller_hosting_selected = "active";
                        $hosting_selected = "active";
                        @endphp
                        @endif

                        @elseif(request()->route()->getName() == "product_landing" && Request::segment(1) == "email" && !empty(Request::segment(2)))
                        @php $googleapps_email_selected = ""; @endphp
                        @if(Request::segment(2) == "google-apps")
                        @php 
                        $googleapps_email_selected = "active";
                        $email_selected = "active";
                        @endphp
                        @elseif(Request::segment(2) == "microsoft-office-365-suite")
                        @php 
                        $office365_selected = "active";
                        $email_selected = "active";
                        @endphp
                        @endif

                        @elseif(request()->route()->getName() == "product_landing" && Request::segment(1) == "servers" && !empty(Request::segment(2)))
                        @php $vps_hosting_selected= ""; @endphp
                        @if(Request::segment(2) == "vps-hosting" || Request::segment(2) == "linux-vps-hosting" || Request::segment(2) == "windows-vps-hosting")
                        @php 
                        $vps_hosting_selected = "active";
                        $servers_selected = "active";
                        @endphp
                        @elseif(Request::segment(2) == "dedicated-servers")
                        @php 
                        $dedicated_servers_selected = "active";
                        $servers_selected = "active";
                        @endphp
                        @endif
                        @endif
                        @if(Request::segment(1) == "new-extensions")
                        @php 
                        $new_extensions_selected = "active";
                        $domain_selected = "active";
                        $register_selected = "";
                        @endphp
                        @elseif(Request::segment(1) == "tld")
                        @php 
                        $tld_selected = "active";
                        $domain_selected = "active";
                        $register_selected = "";
                        @endphp
                        @elseif(Request::segment(1) == "domain-policy")
                        @php 
                        $domain_policy_selected = "active";
                        $domain_selected = "active";
                        $register_selected = "";
                        @endphp
                        @elseif(Request::segment(1) == "whois")
                        @php 
                        $whois_selected = "active";
                        $domain_selected = "active";
                        $register_selected = "";
                        @endphp
                        @endif <ul class="navbar" id="menu">
                            <li class="{!! $home_selected !!}"><a href="{{url('/')}}" title="Home"><i class="menu-home"></i>Home</a></li>
                            <li class="dropdown megamenu {!! $domain_selected !!}">
                                <a href="{{url('/domain-registration')}}" title="{{$header_menu[0]->varTitle}}" class="dropdown-toggle" data-toggle="dropdown"><i class="menu-domain"></i>{{$header_menu[0]->varTitle}}</a><i class="la la-plus plus-icon"></i>
                                <div class="dropdown-menu">
                                    <div class="container">
                                        <div class="menu_01">
                                            <p class="title hidden-lg-down">{{$header_menu[0]->varTitle}}</p>
                                            <ul>
                                                <li class="dropdown {!! $register_selected !!}">
                                                    <a href="{{url('/domain-registration')}}" title="Domain Registration" class="dropdown-toggle" data-toggle="dropdown">Register</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Domain Registration</p>
                                                                    <div class="content" >Your domain name is the identity of your business. Invest time and thoughts to it before you bang upon any particular domain name for your business. More importantly.</div>
<div class="price_div">
    <span class="startat">.COM Starts at</span> @if(Config::get('Constant.sys_currency') == 'INR')<div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_REGISTER_PRICE_INR') }}<span class="month">/yr*</span></div>
    <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_REGISTER_PRICE_INR_WRONG') }}<span class="month">/yr*</span></div>
    @else
    <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_REGISTER_PRICE_USD') }}<span class="month">/yr*</span></div>
    <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_REGISTER_PRICE_USD_WRONG') }}<span class="month">/yr*</span></div>
    @endif
</div><a href="{{url('/domain-registration')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_REGISTER_DISCOUNT_PRICE'])) <div class="buybox text-center"><span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_REGISTER_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_REGISTER_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_REGISTER_DISCOUNT_PRICE']->varpopup_title}}</a></p><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_REGISTER_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']->varpopup_title}}</a></h4> @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']->varDealsINRPrice)) <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']->varDealsINRPrice)) <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_REGISTER_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {{$domain_transfer}}">
                                                    <a href="{{url('domain/domain-transfer')}}" title="Domain Transfer" class="dropdown-toggle" data-toggle="dropdown">Transfer</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Domain Transfer</p>
                                                                    <div class="content" >Transfer your domains and subdomains quickly. A short and simple transfer process, and amazing service quality can make your life a lot easier!</div>
                                                                    <?php /*<div class="price_div"><span class="startat">.COM Starts at</span> @if(Config::get('Constant.sys_currency') == 'INR') <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_TRANSFER_PRICE_INR') }}<span class="month">/yr*</span></div> <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_TRANSFER_PRICE_INR_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @else <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_TRANSFER_PRICE_USD') }}<span class="month">/yr*</span></div> <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_TRANSFER_PRICE_USD_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @endif 
                                                                    </div>*/?> 
                                                                    <a href="{{url('domain/domain-transfer')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_TRANSFER_DISCOUNT_PRICE'])) <div class="buybox text-center"> <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_TRANSFER_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_TRANSFER_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_TRANSFER_DISCOUNT_PRICE']->varpopup_title}}</a></p> <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_TRANSFER_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']))
                                                                    <div class="buybox text-center"> <span class="hotofr-icon"></span> <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']->varpopup_title}}</a></h4> @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']->varDealsINRPrice)) <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']->varDealsUSDPrice)) <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_TRANSFER_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {{$bulk_domain_search_selected}}">
                                                    <a href="{{url('domain/bulk-domain-search')}}" title="Bulk Domain Search" class="dropdown-toggle" data-toggle="dropdown">Bulk Search</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Bulk Domain Search</p>
                                                                    <div class="content" >Claim multiple domains of your choice, before someone else gets them. We offer assorted names and extensions at jaw dropping prices.</div>
                                                                    <?php /*<div class="price_div">
                                                                        <span class="startat">.COM Starts at</span> @if(Config::get('Constant.sys_currency') == 'INR') <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_BULK_DOMAIN_SEARCH_PRICE_INR') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_BULK_DOMAIN_SEARCH_PRICE_INR_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_BULK_DOMAIN_SEARCH_PRICE_USD') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_BULK_DOMAIN_SEARCH_PRICE_USD_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @endif 
                                                                    </div>*/?>
                                                                    <a href="{{url('domain/bulk-domain-search')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']->varDealsUSDPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif 
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_BULK_DOMAIN_SEARCH_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>                                                                                                                                                      
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {{$tld_selected}}">
                                                    <a href="{{url('tld')}}" title="Domain Pricing" class="dropdown-toggle" data-toggle="dropdown">Pricing</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Pricing</p>
                                                                    <div class="content" >Save big on domain, extensions of choice, bulk domains, domain forwarding and transfer. See which plan suits your needs best and get started today.</div>
                                                                    <?php /*<div class="price_div">
                                                                        <span class="startat">.COM Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_PRICING_PRICE_INR') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_PRICING_PRICE_INR_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_PRICING_PRICE_USD') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_PRICING_PRICE_USD_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @endif 
                                                                    </div>*/?>
                                                                    <a href="{{url('tld')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_PRICING_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_PRICING_DISCOUNT_PRICE']->id}}" title="Buy 3 Domains and Get 25% Off">{{$MegaMenu['MEGAMENU_PRICING_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_PRICING_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_PRICING_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_PRICING_OFFER_PRICE']->id}}" title="Cheapest .COM domain sale. Buy it today!">{{$MegaMenu['MEGAMENU_PRICING_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_PRICING_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_PRICING_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_PRICING_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_PRICING_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_PRICING_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {{$domain_policy_selected}}">
                                                    <a href="{{url('domain-policy')}}" title="Domain Privacy" class="dropdown-toggle" data-toggle="dropdown">Privacy</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Special domains</p>
                                                                    <div class="content" >Each business is unique. We believe, your's is too! Find out the name that matches closest to your business and get started with a bang today!</div>
                                                                    <?php /*<div class="price_div">
                                                                        <span class="startat">.COM Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_PRIVACY_PRICE_INR') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_PRIVACY_PRICE_INR_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_PRIVACY_PRICE_USD') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_PRIVACY_PRICE_USD_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @endif
                                                                    </div>*/?>
                                                                    <a href="{{url('domain-policy')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_PRIVACY_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_PRIVACY_DISCOUNT_PRICE']->id}}" title="Buy 3 Domains and Get 25% Off">{{$MegaMenu['MEGAMENU_PRIVACY_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_PRIVACY_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_PRIVACY_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_PRIVACY_OFFER_PRICE']->id}}" title="Cheapest .COM domain sale. Buy it today!">{{$MegaMenu['MEGAMENU_PRIVACY_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_PRIVACY_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_PRIVACY_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_PRIVACY_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_PRIVACY_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_PRIVACY_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {{$new_extensions_selected}}">
                                                    <a href="{{url('new-extensions')}}" title="New Domain Extensions" class="dropdown-toggle" data-toggle="dropdown">New Extensions</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">New Domain Extensions</p>
                                                                    <div class="content" >We keep our extensions library absolutely updated to keep you in tandem with what's trending. Bag your extension of choice at prices like never before!</div>
                                                                    <?php /*<div class="price_div">
                                                                        <span class="startat">.COM Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_NEW_DOMAIN_EXTENSIONS_PRICE_INR') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_NEW_DOMAIN_EXTENSIONS_PRICE_INR_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_NEW_DOMAIN_EXTENSIONS_PRICE_USD') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_NEW_DOMAIN_EXTENSIONS_PRICE_USD_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @endif
                                                                    </div>*/?>
                                                                    <a href="{{url('new-extensions')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_DISCOUNT_PRICE'])) <div class="buybox text-center"> <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_NEW_DOMAIN_EXTENSIONS_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {{$whois_selected}}">
                                                    <a href="{{url('whois')}}" title="Whois" class="dropdown-toggle" data-toggle="dropdown">Whois</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Whois</p>
                                                                    <div class="content" >Insistent on a domain that’s taken? Find out more about its ownership, tenure of present ownership and other bits of necessary information.</div>
                                                                    <?php /*<div class="price_div">
                                                                        <span class="startat">.COM Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WHOIS_PRICE_INR') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WHOIS_PRICE_INR_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WHOIS_PRICE_USD') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WHOIS_PRICE_USD_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @endif
                                                                    </div>*/?>
                                                                    <a href="{{url('whois')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_WHOIS_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_WHOIS_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_WHOIS_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_WHOIS_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_WHOIS_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_WHOIS_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="{{url('deals')}}" title="Deals" class="dropdown-toggle" data-toggle="dropdown">Deals</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Deals</p>
                                                                    <div class="content" >Offers and deals that you just can’t overlook! We keep offering discount plans, throughout the year. Check out what’s the big thing today, and avail of amazing offers.</div>
                                                                    <?php /*<div class="price_div">
                                                                        <span class="startat">.COM Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_DEALS_PRICE_INR') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_DEALS_PRICE_INR_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_DEALS_PRICE_USD') }}<span class="month">/yr*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_DEALS_PRICE_USD_WRONG') }}<span class="month">/yr*</span></div>
                                                                        @endif
                                                                    </div>*/?>
                                                                    <a href="{{url('deals')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>                                                                                                                                  
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_DOMAINS_DEALS_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_DOMAINS_DEALS_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_DOMAINS_DEALS_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_DOMAINS_DEALS_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_DOMAINS_DEALS_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_DOMAINS_DEALS_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="rating_div row">
                                                <span class="rating_title">Check out our customer Reviews</span>
                                                <img src="{{Config::get('Constant.CDNURL')}}/assets/images/rating1.png" alt="Rating">
                                            </div>
                                        </div>
                                        <div class="menu_04">
                                            <?php /*<div class="month-offer text-center">
                                                <span class="offer-icon"></span>
                                                <p class="menu_offer_title">Hot deals</p>
                                                <span class="tagline">Get DESI .LIFE .ROCKS onboard</span>
                                                <div class="price_text"> @if(Config::get('Constant.sys_currency') == 'INR') Start at <span class="rs-ico">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="rupees">{{ Config::get('Constant.MEGAMENU_DOMAIN_OFFER_SIDE_PRICE_INR') }}</span><span class="permonth">/yr*</span>
                                                    @else Start at <span class="rs-ico">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="rupees">{{ Config::get('Constant.MEGAMENU_DOMAIN_OFFER_SIDE_PRICE_USD') }}</span><span class="permonth">/yr*</span>
                                                    @endif
                                                </div>
                                                <ul class="offer_list">
                                                    <li>.DESI .LIFE .ROCKS Domain Name</li> <li>Create a Stunning Website</li> <li>Launch your website in minutes!</li> </ul>
                                                <a href="{{url('/domain-registration')}}" class="btn" title="Get Start Now">Get Start Now</a>
                                            </div> */?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown megamenu {!! $hosting_selected !!}">
                                <a href="{{url($header_menu[1]->varAlias)}}" title="Web Hosting" class="dropdown-toggle" data-toggle="dropdown"><i class="menu-hosting"></i>{{$header_menu[1]->varTitle}}</a><i class="la la-plus plus-icon"></i>
                                <div class="dropdown-menu">
                                    <div class="container">
                                        <div class="menu_01">
                                            <p class="title hidden-lg-down">{{$header_menu[1]->varTitle}}</p>
                                            <ul>
                                                <li class="dropdown {!! $windows_hosting_selected !!}">
                                                    <a href="{{url('/web-hosting')}}" id="webhostingmenu" title="Web Hosting" class="dropdown-toggle" data-toggle="dropdown">Web Hosting</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                 <div class="optimized_hosting menu_wrap">
                                                                    <i class="menu-icon linux-hosting-icon"></i>
                                                                    <p class="o_h_title">Linux Hosting</p>
                                                                    <div class="content">Open source and security put together, nothing can be better than a Linux website. We offer Linux hosting plans, as sturdy as Linux.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_LINUX_HOSTING_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_LINUX_HOSTING_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_LINUX_HOSTING_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_LINUX_HOSTING_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('hosting/linux-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_02 for-border">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <i class="menu-icon  web-hosting-icon"></i>
                                                                    <p class="o_h_title">Windows Hosting</p>
                                                                    <div class="content">A plethora of features, the fluidity of Plesk and an array of stunning addons to get started with, all supported flawlessly.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WINDOWS_HOSTING_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WINDOWS_HOSTING_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WINDOWS_HOSTING_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WINDOWS_HOSTING_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('hosting/windows-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {!! $wordpress_hosting_selected !!}">
                                                    <a href="{{url('hosting/wordpress-hosting')}}" title="Wordpress Hosting" class="dropdown-toggle" data-toggle="dropdown">Wordpress</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Optimized Hosting For<span>
                                                                            <img src="{{Config::get('Constant.CDNURL')}}/assets/images/wp-logo.png" alt="Optimized Hosting For Wordpress"></span></p>
                                                                    <div class="content">Raving over your Wordpress website? Boost it with Wordpress hosting, proven to perform</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WORDPRESS_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WORDPRESS_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WORDPRESS_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WORDPRESS_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('hosting/wordpress-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_WORDPRESS_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_WORDPRESS_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_WORDPRESS_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_WORDPRESS_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_WORDPRESS_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_WORDPRESS_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {!! $java_hosting_selected !!}">
                                                    <a href="{{url('hosting/java-hosting')}}" title="Java Hosting" class="dropdown-toggle" data-toggle="dropdown">Java</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <i class="menu-icon  java-i"></i>
                                                                    <p class="o_h_title">Java Hosting</p>
                                                                    <div class="content">Before going for a server to host your JAVA based application. Consider an option to host it on shared hosting.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_JAVA_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_JAVA_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_JAVA_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_JAVA_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('hosting/java-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_JAVA_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_JAVA_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_JAVA_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_JAVA_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_JAVA_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_JAVA_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {!! $ecommerce_hosting_selected !!}">
                                                    <a href="{{url('hosting/ecommerce-hosting')}}" title="eCommerce Hosting" class="dropdown-toggle" data-toggle="dropdown">eCommerce</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="menu_ecommerce_icon optimized_hosting menu_wrap">
                                                                    <i class="menu-icon menu_ecommerce_icon"></i>
                                                                    <p class="o_h_title">eCommerce</p>
                                                                    <div class="content">Give your business an online presence with a hosting plan specially designed for ecommerce websites</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_ECOMMERCE_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_ECOMMERCE_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_ECOMMERCE_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_ECOMMERCE_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('hosting/ecommerce-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {!! $sitelock_hosting_selected !!}">
    <a href="{{url('hosting/site-lock')}}" title="Site Lock" class="dropdown-toggle" data-toggle="dropdown">Site Lock</a>
    <div class="dropdown-menu">
        <div class="d-flex">
            <div class="menu_02">
                <div class="menu_sitelock_icon optimized_hosting menu_wrap">
                    <i class="menu-icon menu_sitelock_icon"></i>
                    <p class="o_h_title">Site Lock</p>
                    <div class="content">Don’t fall prey to malware and other security threats that are lethal for your online reputation.</div>
                    <div class="price_div">
                        <span class="startat">Starts at</span>
                        @if(Config::get('Constant.sys_currency') == 'INR')
                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_SITELOCK_HOSTING_PRICE_INR') }}<span class="month">/mo*</span></div>
                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_SITELOCK_HOSTING_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                        @else
                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_SITELOCK_HOSTING_PRICE_USD') }}<span class="month">/mo*</span></div>
                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_SITELOCK_HOSTING_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                        @endif
                    </div>
                    <a href="{{url('hosting/site-lock')}}" class="btn" title="Get Started">Get Started</a>
                </div>
            </div>
            <div class="menu_03">
                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE'])) <div class="buybox text-center">
                        <span class="hotofr-icon"></span>
                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_ECOMMERCE_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                    </div>
                    @endif
                    @if(isset($MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']))
                    <div class="buybox text-center">
                        <span class="hotofr-icon"></span>
                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varpopup_title}}</a></h4>
                        @if(Config::get('Constant.sys_currency') == 'INR')
                        @if(!empty($MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varDealsINRPrice))
                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varDealsINRPrice}}</div>
                        @endif
                        @else
                        @if(!empty($MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varDealsINRPrice))
                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->varDealsUSDPrice}}</div>
                        @endif
                        @endif
                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_ECOMMERCE_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</li>
                                                <li class="dropdown {!! $reseller_hosting_selected !!}">
                                                    <a href="{{url('hosting/linux-reseller-hosting')}}" title="Reseller" id="resellerhostingmenu" class="dropdown-toggle" data-toggle="dropdown">Reseller</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <i class="menu-icon linux-hosting-icon"></i>
                                                                    <p class="o_h_title">Linux Reseller Hosting</p>
                                                                    <div class="content">Boost your hosting business with the power of Linux combine with WHM/cPanel.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_LINUX_RESELLER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_LINUX_RESELLER_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_LINUX_RESELLER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_LINUX_RESELLER_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('hosting/linux-reseller-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_02">
                                                                
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <i class="menu-icon web-hosting-icon"></i>
                                                                    <p class="o_h_title">Windows Reseller Hosting</p>
                                                                    <div class="content">Take your business to a new heigh while we manage the technical aspects of it. Become a reseller with us.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WINDOWS_RESELLER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WINDOWS_RESELLER_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WINDOWS_RESELLER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_WINDOWS_RESELLER_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('hosting/windows-reseller-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="{{url('deals')}}" title="Deals" class="dropdown-toggle" data-toggle="dropdown">Deals</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <i class="menu-icon menu_deals_icon"></i>
                                                                    <p class="o_h_title">Deals</p>
                                                                    <div class="content">Offers and deals that you just can't overlook! We keep offering discount plans, throughout the year. Check out what's the big thing today, and avail of amazing offers</div>
                                                                    <div class="price_div" style="display:none;">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_HOSTING_DEALS_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_HOSTING_DEALS_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_HOSTING_DEALS_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_HOSTING_DEALS_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('deals')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div"> @if(isset($MegaMenu['MEGAMENU_HOSTING_DEALS_DISCOUNT_PRICE'])) <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <p class="menu_offer_title"><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_HOSTING_DEALS_DISCOUNT_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_HOSTING_DEALS_DISCOUNT_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_HOSTING_DEALS_DISCOUNT_PRICE']->varpopup_title}}</a></p>
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_HOSTING_DEALS_DISCOUNT_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset($MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']))
                                                                    <div class="buybox text-center">
                                                                        <span class="hotofr-icon"></span>
                                                                        <h4><a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']->id}}" title="{{$MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']->varpopup_title}}">{{$MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']->varpopup_title}}</a></h4>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        @if(!empty($MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']->varDealsINRPrice}}</div>
                                                                        @endif
                                                                        @else
                                                                        @if(!empty($MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']->varDealsINRPrice))
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']->varDealsUSDPrice}}</div>
                                                                        @endif
                                                                        @endif
                                                                        <a href="{{url('/deals?id=').$MegaMenu['MEGAMENU_HOSTING_DEALS_OFFER_PRICE']->id}}" class="btn" title="Shop Now">Shop Now</a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="rating_div row">
                                                <span class="rating_title">Check out our customer Reviews</span>
                                                <img src="{{Config::get('Constant.CDNURL')}}/assets/images/rating1.png" alt="Rating">
                                            </div>
                                        </div>
                                        <div class="menu_04">
                                            <div class="month-offer text-center" style="display:none;">
                                                <span class="offer-icon"></span>
                                                <p class="menu_offer_title">Offer of the Month</p>
                                                <span class="tagline">The best web Hosting</span>
                                                <div class="price_text">
                                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                                    Start at <span class="rs-ico">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="rupees">{{ Config::get('Constant.MEGAMENU_HOSTING_OFFER_SIDE_PRICE_INR') }}</span><span class="permonth">/mo*</span>
                                                    @else
                                                    Start at <span class="rs-ico">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="rupees">{{ Config::get('Constant.MEGAMENU_HOSTING_OFFER_SIDE_PRICE_USD') }}</span><span class="permonth">/mo*</span>
                                                    @endif
                                                </div>
                                                <ul class="offer_list">
                                                    <li>Unlimited Domains</li> <li>Unmetered bandwidth</li> <li>Unmetered hosting space</li> <li>Unlimited email accounts</li> </ul>
                                                <a href="#" class="btn" title="Get Start Now">Get Start Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown megamenu {!! $servers_selected !!}">
                                <a href="{{url($header_menu[2]->varAlias)}}" title="{{$header_menu[2]->varTitle}}" class="dropdown-toggle" data-toggle="dropdown"><i class="menu-domain"></i>{{$header_menu[2]->varTitle}}</a><i class="la la-plus plus-icon"></i>
                                <div class="dropdown-menu">
                                    <div class="container">
                                        <div class="menu_01">
                                            <p class="title hidden-lg-down">{{$header_menu[2]->varTitle}}</p>
                                            <ul>
                                                <li class="dropdown {!! $vps_hosting_selected !!}">
                                                    <a href="{{url('servers/vps-hosting')}}" title="VPS Hosting" id="vpshostingmenu" class="dropdown-toggle" data-toggle="dropdown">VPS Hosting</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Freedom of Choosing VPS Technology & Customization</p>
                                                                    <div class="content" >Choose any of the latest Virtualization technology like OpenVZ, KVM or Virtuozzo Cloud and customize it as you like.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_HOSTING_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_HOSTING_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_HOSTING_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_HOSTING_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('servers/vps-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php
                                                           
                                                            /*<div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Linux VPS Hosting</p>
                                                                     <div class="content">Being experienced and trusted VPS hosting services provider, we ensure that businesses meet their full capability without splurging by offering cheap Windows and Linux VPS hosting solutions.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_STARTER_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_STARTER_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('servers/linux-vps-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Windows VPS Hosting</p>
                                                                     <div class="content">Being experienced and trusted VPS hosting services provider, we ensure that businesses meet their full capability without splurging by offering cheap Windows and Windows VPS hosting solutions.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('servers/windows-vps-hosting')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>*/
                                                            ?>
                                                            
                                                            <div class="menu_03">
                                                                <div class="buy_div">
                                                                    <div class="buybox text-center" style="padding-bottom:10px !important;">
                                                                        <span class="hotofr-icon linux_vps"></span>
                                                                        <p class="b_b_titile"><a href="{{url('servers/linux-vps-hosting')}}" title="">CPU:<strong>2Core</strong>, RAM:<strong>2GB</strong>, HDD:<strong>20GB SSD</strong></a></p>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                        <a href="{{url('servers/linux-vps-hosting')}}" class="btn" title="Quick Order">Quick Order</a>
                                                                    </div>
                                                                    <div class="buybox text-center" style="padding-bottom:10px !important;">
                                                                        <span class="hotofr-icon windows_vps"></span>
                                                                        <p class="b_b_titile"><a href="{{url('servers/windows-vps-hosting')}}" title="">CPU:<strong>2Core</strong>, RAM:<strong>2GB</strong>, HDD:<strong>40GB SSD</strong></a></p>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                        <a href="{{url('servers/windows-vps-hosting')}}" class="btn" title="Quick Order">Quick Order</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown {!! $dedicated_servers_selected !!}">
                                                    <a href="{{url('servers/dedicated-servers')}}" title="Dedicated Servers" class="dropdown-toggle" data-toggle="dropdown">Dedicated Servers</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Dedicated Servers</p>
                                                                    <div class="content" >Give your ever growing business wings to soar, with servers dedicated just to you. Enjoy amazing scalability, flexibility and absolutely no restraint on customer service with HostITSmart  dedicated servers.</div>
                                                                    <div class="price_div">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_DEDICATED_SERVERS_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_DEDICATED_SERVERS_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_DEDICATED_SERVERS_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_DEDICATED_SERVERS_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('servers/dedicated-servers')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div">
                                                                    <div class="buybox text-center" style="padding-bottom:10px !important;">
                                                                        <span class="hotofr-icon linux_vps"></span>
                                                                        <p class="b_b_titile""><a href="{{url('servers/linux-vps-hosting')}}" title="">CPU:<strong>2Core</strong>, RAM:<strong>2GB</strong>, HDD:<strong>20GB SSD</strong></a></p>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                        <a href="{{url('servers/linux-vps-hosting')}}" class="btn" title="Quick Order">Quick Order</a>
                                                                    </div>
                                                                    <div class="buybox text-center" style="padding-bottom:10px !important;">
                                                                        <span class="hotofr-icon windows_vps"></span>
                                                                        <p class="b_b_titile"><a href="{{url('servers/windows-vps-hosting')}}" title="">CPU:<strong>2Core</strong>, RAM:<strong>2GB</strong>, HDD:<strong>40GB SSD</strong></a></p>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                        <a href="{{url('servers/windows-vps-hosting')}}" class="btn" title="Quick Order">Quick Order</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="{{url('deals')}}" title="Deals" class="dropdown-toggle" data-toggle="dropdown">Deals</a>
                                                    <div class="dropdown-menu">
                                                        <div class="d-flex">
                                                            <div class="menu_02">
                                                                <div class="optimized_hosting menu_wrap">
                                                                    <p class="o_h_title">Deals</p>
                                                                    <div class="content" >Offers and deals that you just can't overlook! We keep offering discount plans, throughout the year. Check out what's the big thing today, and avail of amazing offers</div>
                                                                    <div class="price_div" style="display:none;">
                                                                        <span class="startat">Starts at</span>
                                                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_SERVERS_DEALS_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_SERVERS_DEALS_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_SERVERS_DEALS_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_SERVERS_DEALS_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                    </div>
                                                                    <a href="{{url('deals')}}" class="btn" title="Get Started">Get Started</a>
                                                                </div>
                                                            </div>
                                                            <div class="menu_03">
                                                                <div class="buy_div">
                                                                    <div class="buybox text-center" style="padding-bottom:10px !important;">
                                                                        <span class="hotofr-icon linux_vps"></span>
                                                                        <p class="b_b_titile""><a href="{{url('servers/linux-vps-hosting')}}" title="">CPU:<strong>2Core</strong>, RAM:<strong>2GB</strong>, HDD:<strong>20GB SSD</strong></a></p>
                                                                         @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_LINUX_HOSTING_STARTER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                        <a href="{{url('servers/linux-vps-hosting')}}" class="btn" title="Quick Order">Quick Order</a>
                                                                    </div>
                                                                    <div class="buybox text-center" style="padding-bottom:10px !important;">
                                                                        <span class="hotofr-icon windows_vps"></span>
                                                                        <p class="b_b_titile"><a href="{{url('servers/windows-vps-hosting')}}" title="">CPU:<strong>2Core</strong>, RAM:<strong>2GB</strong>, HDD:<strong>40GB SSD</strong></a></p>
                                                                         @if(Config::get('Constant.sys_currency') == 'INR')
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_INR') }}<span class="month">/mo*</span></div>
                                                                        @else
                                                                        <div class="offer-price"><span>Only</span><i>{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.MEGAMENU_VPS_WINDOWS_HOSTING_STARTER_PRICE_USD') }}<span class="month">/mo*</span></div>
                                                                        @endif
                                                                         <a href="{{url('servers/windows-vps-hosting')}}" class="btn" title="Quick Order">Quick Order</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="rating_div row">
                                                <span class="rating_title">Check out our customer Reviews</span>
                                                <img src="{{Config::get('Constant.CDNURL')}}/assets/images/rating1.png" alt="Rating">
                                            </div>
                                        </div>
                                       
                                       <?php
                                        /*<div class="menu_04">
                                            <div class="month-offer text-center">
                                                <span class="offer-icon"></span> 
                                                <p class="menu_offer_title">Offer of the Month</p>
                                                <span class="tagline">Cheapest Dedicated Challenge</span>
                                                <div class="price_text">
                                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                                    Start at <span class="rs-ico">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="rupees">{{ Config::get('Constant.MEGAMENU_DEDICATED_SERVERS_OFFER_PRICE_INR') }}</span><span class="permonth">/mo*</span>
                                                    @else
                                                    Start at <span class="rs-ico">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="rupees">{{ Config::get('Constant.MEGAMENU_DEDICATED_SERVERS_OFFER_PRICE_USD') }}</span><span class="permonth">/mo*</span>
                                                    @endif
                                                </div>
                                                <ul class="offer_list">
                                                    <li>Processor: Xeon L5420</li> <li>SSD: 250GB - 2TB SATA (Variable)</li> <li>RAM: 8GB - 24GB (Variable)</li> <li>Bandwidth: 33TB/Month</li> </ul>
                                                <a target="_blank" href="https://www.hostitsmart.com/manage/cart.php?a=add&pid=182" class="btn" title="Get Start Now">Get Start Now</a>
                                            </div>
                                        </div>*/
                                        ?>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown megamenu {!! $email_selected !!}">
    <a href="{{url('email/google-apps')}}" title="{{$header_menu[4]->varTitle}}" class="dropdown-toggle" data-toggle="dropdown"><i class="menu-hosting"></i>{{$header_menu[4]->varTitle}}</a><i class="la la-plus plus-icon"></i>
    <div class="dropdown-menu">
        <div class="container">
            <div class="menu_01">
                <p class="title hidden-lg-down">{{$header_menu[4]->varTitle}}</p>
                <ul>
                    <li class="dropdown {!! $googleapps_email_selected !!}">
                        <a href="{{url('email/google-apps')}}" title="Google Apps" class="dropdown-toggle" data-toggle="dropdown">Google Apps</a>
                        <div class="dropdown-menu">
                            <div class="d-flex">
                                <div class="menu_02">
                                     <div class="optimized_hosting menu_wrap">
                                        <i class="menu-icon menu_gsuite_icon"></i>
                                        <p class="o_h_title">G-suite for Work</p>
                                        <div class="content">Make sharing, working, and chatting fun, seamless, and secure with the collaborative G-Suite for businesses, powered by Google Cloud.</div>
                                        <div class="price_div">
                                            <span class="startat">Starts at</span>
                                            @if(Config::get('Constant.sys_currency') == 'INR')
                                            <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_GOOGLEAPP_EMAIL_PRICE_INR') }}<span class="month">/mo*</span></div>
                                            <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_GOOGLEAPP_EMAIL_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
                                            @else
                                            <div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_GOOGLEAPP_EMAIL_PRICE_USD') }}<span class="month">/mo*</span></div>
                                            <div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_GOOGLEAPP_EMAIL_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
                                            @endif
                                        </div>
                                        <a href="{{url('email/google-apps')}}" class="btn" title="Get Started">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown {!! $office365_selected !!}">
	<a href="{{url('email/microsoft-office-365-suite')}}" title="Office 365" class="dropdown-toggle" data-toggle="dropdown">Office 365</a>
	<div class="dropdown-menu">
		<div class="d-flex">
			<div class="menu_02">
				<div class="optimized_hosting menu_wrap">
                    <i class="menu-icon menu_office_icon"></i>
					<p class="o_h_title">Microsoft Office 365 Suite<span></p>
					<div class="content">Simple Set Up, 24x7 Expert Assistance, Seamless Integration and More.</div>
					<div class="price_div">
						<span class="startat">Starts at</span>
						@if(Config::get('Constant.sys_currency') == 'INR')
						<div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_OFFICE365_EMAIL_PRICE_INR') }}<span class="month">/mo*</span></div>
						<div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_OFFICE365_EMAIL_PRICE_INR_WRONG') }}<span class="month">/mo*</span></div>
						@else
						<div class="pricepermonth"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_OFFICE365_EMAIL_PRICE_USD') }}<span class="month">/mo*</span></div>
						<div class="pricepermonth line-through"><span class="rupees_sign">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{ Config::get('Constant.MEGAMENU_OFFICE365_EMAIL_PRICE_USD_WRONG') }}<span class="month">/mo*</span></div>
						@endif
					</div>
					<a href="{{url('email/microsoft-office-365-suite')}}" class="btn" title="Get Started">Get Started</a>
				</div>
			</div>
		</div>
	</div>
</li>
                </ul>
                <div class="rating_div row">
                    <span class="rating_title">Check out our customer Reviews</span>
                    <img src="{{Config::get('Constant.CDNURL')}}/assets/images/rating1.png" alt="Rating">
                </div>
            </div>
        </div>
    </div>
</li>
                            <li class="{!! $ssl_selected !!}"><a href="{{url($header_menu[3]->varAlias)}}" title="SSL Certificate"><i class="menu-ssl"></i>{{$header_menu[3]->varTitle}}</a></li>    
                            <li class="{!! $deals_selected !!}"><a href="{{url("deals")}}" title="Deals"><i class="menu-deals"></i>Deals</a></li>
                            <li><a href="{{url("aws-support-services")}}" title="AWS Support"><i class="menu-aws"></i>AWS Support</a></li>
                            <div class="menu-links-responsive d-block d-xl-none row">
                               <ul class="col-12">
                                    <li>
                                        <a href="{{url("/hosting/linux-reseller-hosting")}}" title="Linux VPS Quick Order">Linux VPS Quick Order</a>
                                    </li>
                                    <li>
                                        <a href="{{url("/hosting/windows-reseller-hosting")}}" title="Windows VPS Quick Order">Windows VPS Quick Order</a>
                                    </li> 
                                </ul>  
                            </div>
                            <div class="menu-links-responsive d-block d-xl-none row">
                                <ul class="col-6">
                                    <li><a href="{{url("about-us")}}" title="About Us">About Us</a></li> <?php //<li><a href="{{url("news")}}" title="News">News</a></li> ?> <li><a href="{{Config::get('Constant.BLOGSITE_LINK')}}" target="_blank" title="Blog">Blog</a></li> <li><a href="{{url("faqs")}}" title="FAQs Us">FAQs</a></li> </ul>
                                <ul class="col-6">
                                    <?php $apiUrl = config('app.api_url'); ?>
                                    @if(session()->has('frontlogin'))
                                        <li><a href="<?php echo $apiUrl; ?>" target="_blank" title="My Account">My Account</a></li> 
                                        <li><a href="<?php echo $apiUrl; ?>/index.php?rp=/cart/domain/renew" title="My Renewals">My Renewals</a></li>
                                    @else 
                                        <li><a href="" data-toggle="modal" data-target="#loginModal" title="Create Account">Create Account</a></li> 
                                    @endif 
                                        <li><a href="{{url("contact")}}" title="Contact Us">Contact Us</a></li>
                                </ul>
                                <div class="responsive-signup">
                                    
                                    @if(session()->has('frontlogin'))
                                    <a id="logoutlink" onclick="do_logout();" href="javascript:void(0);" class="btn" title="Logout">Logout</a>
                                    @else
                                     <a href="#" class="btn" title="Sign Up" data-toggle="modal" data-target="#loginModal">Sign In</a>
                                    @endif
                                </div>
                            </div>
                        </ul>
                    </div> 
                    @if(session()->has('frontlogin'))
                    <div class="login_part d-md-flex d-none align-self-md-center aos-init" data-aos="fade-left" data-aos-delay="200">
                        <?php /*<a id="logoutlink" onclick="do_logout();" href="javascript:void(0);" class="btn" title="Logout">Logout</a>*/?>
                        <?php 
                        //<a id="myaccountheaderlink" target="_blank" href="{{url('https://www.hostitsmart.com/manage')}}" class="btn" title="My account">My Account</a>
                        ?>
<div class="dropdown my_account_dropdown">
<button id="myaccountheaderlink" type="button" title="My account" class="btn btn-primary dropdown-toggle d-none d-sm-block" data-toggle="dropdown"> My Account </button>
<button type="button" class="btn btn-primary dropdown-toggle d-block d-sm-none" data-toggle="dropdown"> <i class="fa fa-user" ></i></button>
<div class="dropdown-menu dropdown-menu-right">
<div class="user_info">
<?php
/*<div class="thumbnail-container">
<div class="thumbnail"><img src="assets/images/testi2.jpg" alt="com"></div>
</div>*/
?>
<div class="detail_box"><h3>Host IT Smart</h3>
@if(Session::has('useremail'))
    {{ Session::get('useremail') }}
@endif
</div>
<div class="clearfix"></div>
</div>
<?php $apiUrl = config('app.api_url'); ?>
<ul>
    <li><a href="<?php echo $apiUrl; ?>"><i class="fa fa-user"></i> My Profile</a></li>
    <li><a href="<?php echo $apiUrl; ?>/clientarea.php?action=invoices"><i class="fa fa-file-text-o"></i> Invoices</a></li>
    <li><a href="<?php echo $apiUrl; ?>/clientarea.php?action=services"><i class="fa fa-cogs"></i> Products/Services</a></li>
    <li><a href="<?php echo $apiUrl; ?>/clientarea.php?action=domains"><i class="fa fa-globe"></i> Domain</a></li>
    <li><a href="<?php echo $apiUrl; ?>/supporttickets.php"><i class="fa fa-life-ring"></i> Support</a></li>
</ul>
<div class="menu_footer"><a href="javascript:void(0);" class="btn" id="logoutlink" onclick="do_logout();" title="Logout">Logout</a></div>
</div>
</div>
                    </div>
                    @else
                    <div class="login_part d-md-flex d-none align-self-md-center aos-init" data-aos="fade-left" data-aos-delay="200">
                        <a href="#" class="btn" title="Login" data-toggle="modal" data-target="#loginModal">Login</a>
                    </div>
                    @endif
                    <a href="{{url('/cart/signin')}}" class="cart_div d-flex align-self-md-center aos-init" data-aos="fade-left" data-aos-delay="300" title="Cart">
                        <span class="sprite-image cart_icon"></span>
                        @if (session()->has('cart'))
                        @php
                        $cart_array = Session::get('cart');
                        if(!empty($cart_array)){
                        if(array_key_exists('userid',$cart_array))        { unset($cart_array['userid']); }
                        if(array_key_exists('paymentmethod',$cart_array)) { unset($cart_array['paymentmethod']); }
                        if(array_key_exists('recommndation',$cart_array)) { unset($cart_array['recommndation']); }            
                        if(array_key_exists('prmocode',$cart_array))      { unset($cart_array['prmocode']); }
                        if(array_key_exists('prmodiscount',$cart_array))  { unset($cart_array['prmodiscount']); }
                        if(array_key_exists('prmomessage',$cart_array))   { unset($cart_array['prmomessage']); }
                        }

                        $count_array = count($cart_array);
                        @endphp
                        <span class="counter" id="cart_cout" {{ $count_array == '0' ? 'style=display:none' : '' }} >{{ $count_array == '0' ? '' : $count_array }}</span>
                        @else
                        {{-- <span class="counter" id="cart_cout" style="display: none;">0</span> --}}
                        @endif
                    </a>
                    @if (!session()->has('UserID'))
                    <div class="currency_div cust_currency_div d-block d-md-block aos-init" data-aos="fade-left" data-aos-delay="400">
                        <select class="form-control selectpicker" id="currency" onchange="getcurrency(this.value);">
                            <option data-icon="icon-inr"  value="INR" {{(Config::get('Constant.sys_currency') == 'INR') ? 'selected' : '' }}>INDIA</option>
                            <option data-icon="icon-global"  value="USD" {{(Config::get('Constant.sys_currency') == 'USD') ? 'selected' : '' }}>GLOBAL</option>
                        </select>
                    </div>
                    @elseif(session()->has('profilecur'))
                    <div class="currency_div aos-init" data-aos="fade-left" data-aos-delay="400">
                        <input type="hidden" id="currency" value="{{session()->get('profilecur')}}"/>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>  
    @if(request()->route()->getName() == 'home')
    <div class="searchdomain_div aos-init" data-aos="fade-up" data-aos-delay="100">
        <div class="container">
            <div class="row flex-row flex-sm-row-reverse">
                <div class="col-xl-6 col-md-5 col-12">
                    <div class="form-group aos-init" data-aos="fade-left" data-aos-delay="800">
                        <form id="domainlookupfrm" autocomplete="off" name="domainlookupfrm" action="{{url('/domain-checker')}}" method="post">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="hide_tlddata" id="hide_tlddata" value="{{$Tlds}}" />
                            <input type="hidden" name="domain_search" id="domain_search" value="y" />
                            <input type="text" class="form-control" placeholder="Search for your perfect domain..." id="domain_name" name="domainname">
                            <button class="btn domain_error" type="submit">Search Domain</button>
                        </form>
                    </div>
                </div>
                @if(isset($FeaturedTlds))
                @if(count($FeaturedTlds)>0)
                <div class="col-xl-6 col-md-7 col-12">
                    <ul class="d-flex aos-init" data-aos="fade-right" data-aos-delay="800">
                        @foreach($FeaturedTlds as $tlddata)
                        <li>
                            <a href="{{url('/domain').'/'.$tlddata->varAlias}}" title="{{$tlddata->varTitle}}">.{{$tlddata->varTitle}}</a>
                            <span>
                                @if(Config::get('Constant.sys_currency') == 'INR')
                                <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_INR') }}@else
                                <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{ Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_USD') }}@endif
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
    @endif
    <script type="text/javascript">
        function do_logout() { $.get("{{url('https://manage.hostitsmart.com/hits_logout.php')}}", function () {
                window.location.href = "{{ url('/user-logout') }}"; }); }
        @if(isset($uagent) && $uagent == 'mobile')
	//To add sub menus items in mobile view
	var webhosting_mobile_menu = '<li class="dropdown"><a href="/hosting/linux-hosting" title="Linux Hosting" class="dropdown-toggle" data-toggle="dropdown">Linux Hosting</a></li><li class="dropdown"><a href="/hosting/windows-hosting" title="Windows Hosting" class="dropdown-toggle" data-toggle="dropdown">Windows Hosting</a></li>';
	var resellerhosting_mobile_menu = '<li class="dropdown"><a href="/hosting/linux-reseller-hosting" title="Linux Reseller Hosting" class="dropdown-toggle" data-toggle="dropdown">Linux Reseller Hosting</a></li><li class="dropdown"><a href="/hosting/windows-reseller-hosting" title="Windows Reseller Hosting" class="dropdown-toggle" data-toggle="dropdown">Windows Reseller Hosting</a></li>';
	var vpshosting_mobile_menu = '<li class="dropdown"><a href="/servers/linux-vps-hosting" title="Linux VPS Hosting" class="dropdown-toggle" data-toggle="dropdown">Linux VPS Hosting</a></li><li class="dropdown"><a href="/servers/windows-vps-hosting" title="Windows VPS Hosting" class="dropdown-toggle" data-toggle="dropdown">Windows VPS Hosting</a></li>';

	$(webhosting_mobile_menu).insertAfter($('#webhostingmenu').parent());
	$(resellerhosting_mobile_menu).insertAfter($('#resellerhostingmenu').parent());
	$(vpshosting_mobile_menu).insertAfter($('#vpshostingmenu').parent());
@endif        
    </script>
</header>