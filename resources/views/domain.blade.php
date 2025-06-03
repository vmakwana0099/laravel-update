@extends('layouts.app')
@section('content')
<section class="domain-reg-banner-main head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="domain-reg-box">
                    <div class="section-heading">
                        <h2 class="text_head text-center">
                            Search & Register Your Domain Name That Defines You
                        </h2>
                        <p class="text-center">Begin your branding journey by buying a perfect domain name at low-cost to Launch your dream website.</p>
                        <div class="domain-reg-input-box">
                            <form action="{{url('/domain-checker')}}" class="custom-search" id="domainlookupfrm" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="hide_tlddata" id="hide_tlddata" value="{{$Tlds}}" />
                                <input type="hidden" name="domain_search" id="domain_search" value="y" />
                                <input class="form-control" type="text" name="domainname" id="domainname" placeholder="Enter your desired domain…" aria-label="">
                                <span class="domain_error"></span>
                                <button class="primary-btn-sq" type="submit" title="Search"><span class="search-icon-desk"> Search </span> <span class="search-icon-mo"><i class="fa fa-search"></i></span></button>
                            </form>
                        </div>
                        <div class="domain-reg-dmn-sq">
                            <?php
                            $box_class = 'domain-reg-dmn-box box-1';
                            $box_class_count = 0;
                            foreach($TLDAdData as $valTLD)
                            {     
                                $box_class_count++;
                               
                                    $box_class = 'box-' . $box_class_count;
                                
                                ?> <a class="banner_domain-lists" alt=".{{$valTLD->varTitle}}" title=".{{$valTLD->varTitle}}" href="{{url("domain/".$valTLD->varAlias)}}">
                                <div class="domain-reg-dmn-box {{$box_class}}">
                                    <span>.{{$valTLD->varTitle}}</span>
                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                    &#8377;{{ Config::get('Constant.'.$valTLD->varWHMCSFieldName.'_INR') }}/Year
                                    @else
                                    &#36;{{ Config::get('Constant.'.$valTLD->varWHMCSFieldName.'_USD') }}/Year
                                    @endif
                                </div>
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
</section>
<section class="domain-reg-extn head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">
                Check out the Most Popular Generic Domain Extensions
            </h2>
            <p class="text-center">These are the ones everyone loves to use! Find the best option for your brand with cheap domain registration in India that fits your needs.</p>
        </div>
        <div class="row">
            @php 
                $d_count = 0;
            @endphp
            @foreach($TLDData as $TLD)
                @php $d_count ++; @endphp
                <div class="col-lg-3 col-md-4">
                    <div class="domain-reg-extn-box box-{{$d_count}}">
                        <div class="domain-reg-extn-title">
                            .{{$TLD->varTitle}}
                        </div>
                        {{-- <div class="domain-reg-extn-cut-price">
                            $10.00 <span>SAVE 73%</span>
                        </div> --}}
                        <div class="domain-reg-extn-price">
                            @if(Config::get('Constant.sys_currency') == 'INR')
                            <span>&#8377;</span>{{ Config::get('Constant.'.$TLD->varWHMCSFieldName.'_INR') }}<span>/Year</span>
                            @else
                            <span>&#36;</span>{{ Config::get('Constant.'.$TLD->varWHMCSFieldName.'_USD') }}<span>/Year</span>
                            @endif
                        </div>
                        <div class="domain-reg-extn-btn">
                            <a class="blk-btn-sq" href="{{url("domain/".$TLD->varAlias)}}" title="{{$TLD->varTitle}}">Register</a>
                        </div>
                    </div>
                </div>
                @if($d_count == 8)
                <?php break; ?>
                @endif
            @endforeach
        </div>
    </div>
</section>
<section class="perf-dmn-main head-tb-p-40">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-7 col-md-7">
                <div class="perf-dmn-cnt">
                    <div class="perf-dmn-title">
                        Have you got <span class="txt-type" data-wait="3000" data-words='["a perfect", "an amazing", "an awesome", "a fantastic", "a great"]'></span> <br>domain name?
                    </div>
                    <div class="perf-dmn-txt">
                        Transfer it now to enjoy better peace of mind!
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 text-center">
                <div class="perf-dmn-btn">
                    <a class="primary-btn-round" href="{{url('/domain/domain-transfer')}}">Transfer Your Domain</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dmn-ext-busi-main head-tb-p-40">
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">
                Which Domain Extension is Best for Your Business?Let’s Find Out!
            </h2>
            <p>Picking the right domain extension is super important as it gives people a quick hint about your business. So before you lock one in, ask yourself: Does it match your brand vibe, speak to your audience, and fit your goals?</p>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="dmn-ext-busi-img">
                    <img src="/assets/images/domain_registration/domain-ext-busi.webp" alt="domain-ext-busi">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="dmn-ext-busi-rgt">
                    <div class="row">
                        <div class="col-lg-6 d-flex">
                            <div class="dmn-ext-busi-box box-1">
                                <div class="dmn-ext-busi-cnt">
                                    Understand Your Business Type
                                </div>
                                <div class="dmn-ext-busi-txt">
                                    Before picking a domain extension, think about what kind of business you are running. If you are into photography, a .photography domain could be a perfect fit. It instantly tells people what you do! So if you are not tied to a .com, go for something that matches your vibe.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex">
                            <div class="dmn-ext-busi-box box-2">
                                <div class="dmn-ext-busi-cnt">
                                    Target Audience & Location
                                </div>
                                <div class="dmn-ext-busi-txt">
                                    When picking a domain extension, think about who you are trying to reach and where they are. If your business is focused on a specific country, you can go for a country-specific extension. For example, if you're targeting people in India, .in works great. Selling to folks in Canada? Try .ca.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex">
                            <div class="dmn-ext-busi-box box-3">
                                <div class="dmn-ext-busi-cnt">
                                    Trust & Credibility
                                </div>
                                <div class="dmn-ext-busi-txt">
                                    You can also use <u><a class="text-dark" href="https://www.hostitsmart.com/blog/do-domain-extensions-impact-seo/">popular domain extensions</a></u> like .com, .online, .store, or .co for your business. These are widely recognized, so people instantly feel more comfortable and trust your brand. It’s a safe and smart choice if you want to build credibility right from the start.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex">
                            <div class="dmn-ext-busi-box box-4">
                                <div class="dmn-ext-busi-cnt">
                                    SEO & Visibility
                                </div>
                                <div class="dmn-ext-busi-txt">
                                    You should know that your <u><a class="text-dark" href="https://www.hostitsmart.com/blog/do-domain-extensions-impact-seo/">domain extension doesn’t directly impact a website’s SEO</a></u> or visibility. But if you are targeting a local audience, using country-specific extensions like .in for India or .au for Australia can actually help you show up better in local search results.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex">
                            <div class="dmn-ext-busi-box box-5">
                                <div class="dmn-ext-busi-cnt">
                                    Branding & Uniqueness
                                </div>
                                <div class="dmn-ext-busi-txt">
                                    If you want to add a unique twist to your brand, you can use niche domain extensions like .tech, .studio, or .store. They are a great way to grab attention and set your business apart from the crowd.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex">
                            <div class="dmn-ext-busi-box box-6">
                                <div class="dmn-ext-busi-cnt">
                                    Think Long Term
                                </div>
                                <div class="dmn-ext-busi-txt">
                                    Buying a domain isn’t something you do all the time, so it’s really important to pick an extension that can grow with your business. For example, even if you start by selling handmade candles in your town, you might one day want to reach customers across the country or even worldwide. So, plan things accordingly & make the right decision.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="domain-nm-prcts-main head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">
                Things to Take Care of Before Registering Your Domain Name
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Short & Snappy Wins the Race
                    </div>
                    <div class="domain-nm-prc-txt">
                        Try to pick a short and snappy domain name. Think about names like Zomato.com or Cred.club that are easy to type, easy to remember, and look super clean. The shorter the domain name, the easier it is for people to find and recall your website!
                    </div>
                </div>
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Spell It Like You Say It
                    </div>
                    <div class="domain-nm-prc-txt">
                        When picking a domain name, keep it simple and easy to spell. Go with what people expect! For example, if your brand sounds like ‘cool bites,’ make sure it’s spelled that way—not ‘koolbytez’ or ‘kewlbitez.’
                    </div>
                </div>
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Let Keywords Work Their Magic
                    </div>
                    <div class="domain-nm-prc-txt">
                        Consider the words your customers might search when looking for a business like yours. If you run a bakery that makes custom cakes, a domain like ‘sweettreatscakes.com’ is more helpful than “sweettreats.com.”
                    </div>
                </div>
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Pick the Perfect Dot
                    </div>
                    <div class="domain-nm-prc-txt">
                        When you take your business online, why stop at local customers? By choosing domain extensions like .store, .online, or .global, you can make your brand look ready for the world, not just your neighborhood.
                    </div>
                </div>
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        No Numbers, No Hyphens, No Confusion
                    </div>
                    <div class="domain-nm-prc-txt">
                        Adding numbers, hyphens, or special characters to your domain name might sound creative, but it can confuse people. It’s harder to remember and even trickier to say out loud. It’s best to keep it simple!
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="domain-nm-prcts-img">
                    <img src="/assets/images/domain_registration/domain-name-practice.webp" alt="domain-name-practice">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Make It a Brand Rockstar
                    </div>
                    <div class="domain-nm-prc-txt">
                        Before domain registration, take some time to do your homework. See what words are trending in your industry, then create something unique that sounds like a total brand rockstar!
                    </div>
                </div>
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Avoid Name Clashes
                    </div>
                    <div class="domain-nm-prc-txt">
                        Before you lock in your domain name, take a quick online search. Ensure it doesn’t look or sound too much like someone else’s brand, as this could lead to a potential legal dispute.
                    </div>
                </div>
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Think Future-Proof
                    </div>
                    <div class="domain-nm-prc-txt">
                        Buzzwords and trendy words are fun while they last, but honestly, they don’t stick around for long. Once the hype dies down, most people forget them pretty quickly. So, avoiding using trendy words that might be forgotten tomorrow is smarter.
                    </div>
                </div>
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Give It a Local Vibe
                    </div>
                    <div class="domain-nm-prc-txt">
                        Lots of folks like to support local businesses in meeting their daily needs. So, if your business mainly serves people nearby, it’s smart to pick a domain name that feels local. You can include your city or state name to connect better.
                    </div>
                </div>
                <div class="domain-nm-prc-box">
                    <div class="domain-nm-prc-cnt">
                        Grab It Before It’s Gone
                    </div>
                    <div class="domain-nm-prc-txt">
                        If you have got your perfect business name in mind, don’t wait too long. Grab that domain fast before someone else snatches it! You can easily and safely register your domain with Host IT Smart, and the best part? It won’t cost you much.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="domain-privacy-protct-main">
    <div class="dmn-prvcy-bg head-tb-p-40">
        <div class="container">
            <div class="section-heading">
                <h2 class="text_head text-center">
                    Don’t Forget to Protect Your Private Data! Just Turn On Privacy, Turn Off Worries!
                </h2>
                <p class="text-center">Protect your personal info from prying eyes by keeping it hidden from WHOIS searches by adding a domain name privacy protection in the cart!</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="domain-privacy-nav">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="protect-data-tab" data-bs-toggle="tab" data-bs-target="#protect-data-tab-pane" type="button" role="tab" aria-controls="protect-data-tab-pane" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" id="Group_169793" data-name="Group 169793" width="12.021" height="12.021" viewBox="0 0 12.021 12.021">
                                        <path id="Path_239800" data-name="Path 239800" d="M16,9.414,7.4,18.021,5.983,16.607,14.589,8H7V6H18V17H16Z" transform="translate(-5.983 -6)" fill="#fff" />
                                    </svg> Protect Your Personal Data</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="avoid-un-tab" data-bs-toggle="tab" data-bs-target="#avoid-un-tab-pane" type="button" role="tab" aria-controls="avoid-un-tab-pane" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" id="Group_169793" data-name="Group 169793" width="12.021" height="12.021" viewBox="0 0 12.021 12.021">
                                        <path id="Path_239800" data-name="Path 239800" d="M16,9.414,7.4,18.021,5.983,16.607,14.589,8H7V6H18V17H16Z" transform="translate(-5.983 -6)" fill="#fff" />
                                    </svg> Avoid Unwanted Spam & Calls</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="enhanced-sec-tab" data-bs-toggle="tab" data-bs-target="#enhanced-sec-tab-pane" type="button" role="tab" aria-controls="enhanced-sec-tab-pane" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" id="Group_169793" data-name="Group 169793" width="12.021" height="12.021" viewBox="0 0 12.021 12.021">
                                        <path id="Path_239800" data-name="Path 239800" d="M16,9.414,7.4,18.021,5.983,16.607,14.589,8H7V6H18V17H16Z" transform="translate(-5.983 -6)" fill="#fff" />
                                    </svg> Enhanced Security</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="stay-sec-tab" data-bs-toggle="tab" data-bs-target="#stay-sec-tab-pane" type="button" role="tab" aria-controls="stay-sec-tab-pane" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" id="Group_169793" data-name="Group 169793" width="12.021" height="12.021" viewBox="0 0 12.021 12.021">
                                        <path id="Path_239800" data-name="Path 239800" d="M16,9.414,7.4,18.021,5.983,16.607,14.589,8H7V6H18V17H16Z" transform="translate(-5.983 -6)" fill="#fff" />
                                    </svg> Stay Compliant</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="maint-img-sec-tab" data-bs-toggle="tab" data-bs-target="#maint-img-sec-tab-pane" type="button" role="tab" aria-controls="maint-img-sec-tab-pane" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" id="Group_169793" data-name="Group 169793" width="12.021" height="12.021" viewBox="0 0 12.021 12.021">
                                        <path id="Path_239800" data-name="Path 239800" d="M16,9.414,7.4,18.021,5.983,16.607,14.589,8H7V6H18V17H16Z" transform="translate(-5.983 -6)" fill="#fff" />
                                    </svg> Maintain Your Professional Image</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 d-none d-lg-block">
                    <div class="domain-privacy-prtc-box">
                        <div class="dmn-prvcy-of dmn-prvcy-data" id="privacy-of">
                            <ul>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        01
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Registrant Name
                                        <span>John Doe</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        02
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Organization
                                        <span>John Books Mart</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        03
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Address
                                        <span>Texas, United States</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        04
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Phone Number
                                        <span>+45 36545466</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        05
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Email
                                        <span>johndoe@gmail.com</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="dmn-prvcy-on dmn-prvcy-data" id="privacy-on">
                            <ul>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        01
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Registrant Name
                                        <span>Domain Admin</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        02
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Organization
                                        <span>Privacy Protection Service INC</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        03
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Address
                                        <span>C/O ID#10760, PO Box 16, AU</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        04
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Phone Number
                                        <span>+45 3694667645</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="dmn-prvcy-data-sr">
                                        05
                                    </div>
                                    <div class="dmn-prvcy-data-cnt">
                                        Email
                                        <span>yourdomain@hostitsmart.com</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="dmn-prvcy-data-btn">
                            <div class="dmn-switch-content">
                                <label class="switch m5">
                                    <input type="checkbox">
                                    <small></small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="dmn-prvcy-rgt">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="protect-data-tab-pane" role="tabpanel" aria-labelledby="protect-data-tab" tabindex="0">
                                <div class="dmn-prvcy-rgt-box">
                                    <div class="dmn-prvcy-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.255" height="25.32" viewBox="0 0 26.255 25.32">
                                            <g id="Group_169760" data-name="Group 169760" transform="translate(0.601 0.75)">
                                                <g id="Group_169759" data-name="Group 169759" transform="translate(0 0)">
                                                    <path id="Path_243735" data-name="Path 243735" d="M15.49,10.631,22.631,3.49M24.1,7.049A5.049,5.049,0,1,1,19.049,2,5.049,5.049,0,0,1,24.1,7.049Z" transform="translate(0.806 -2)" fill="none" stroke="#3838ff" stroke-linecap="round" stroke-width="1.5" />
                                                    <path id="Path_243736" data-name="Path 243736" d="M5.176,17.911c2.765,4.787,6.162,9.013,12.006,7.243a3.211,3.211,0,0,0,1.752-4.441l-1.2-2.842a2.569,2.569,0,0,0-4.153-.848l-.071.067a2.4,2.4,0,0,1-2.287.593,4,4,0,0,1-2.828-4.9A2.4,2.4,0,0,1,10.053,11.1l.093-.027a2.569,2.569,0,0,0,1.342-4.022L9.627,4.594a3.211,3.211,0,0,0-4.721-.7C.451,8.068,2.411,13.123,5.176,17.911Z" transform="translate(-2.271 -1.702)" fill="none" stroke="#3838ff" stroke-width="1.5" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="dmn-prvcy-cnt">
                                        <span>Protect Your Personal Data</span>
                                        When you register a domain, your personal information, such as your name, phone number, and address, becomes public. Adding the Domain Privacy Shield with domain registration allows you to hide these details so strangers or spammers can't misuse them.
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="avoid-un-tab-pane" role="tabpanel" aria-labelledby="avoid-un-tab" tabindex="0">
                                <div class="dmn-prvcy-rgt-box">
                                    <div class="dmn-prvcy-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.255" height="25.32" viewBox="0 0 26.255 25.32">
                                            <g id="Group_169760" data-name="Group 169760" transform="translate(0.601 0.75)">
                                                <g id="Group_169759" data-name="Group 169759" transform="translate(0 0)">
                                                    <path id="Path_243735" data-name="Path 243735" d="M15.49,10.631,22.631,3.49M24.1,7.049A5.049,5.049,0,1,1,19.049,2,5.049,5.049,0,0,1,24.1,7.049Z" transform="translate(0.806 -2)" fill="none" stroke="#3838ff" stroke-linecap="round" stroke-width="1.5" />
                                                    <path id="Path_243736" data-name="Path 243736" d="M5.176,17.911c2.765,4.787,6.162,9.013,12.006,7.243a3.211,3.211,0,0,0,1.752-4.441l-1.2-2.842a2.569,2.569,0,0,0-4.153-.848l-.071.067a2.4,2.4,0,0,1-2.287.593,4,4,0,0,1-2.828-4.9A2.4,2.4,0,0,1,10.053,11.1l.093-.027a2.569,2.569,0,0,0,1.342-4.022L9.627,4.594a3.211,3.211,0,0,0-4.721-.7C.451,8.068,2.411,13.123,5.176,17.911Z" transform="translate(-2.271 -1.702)" fill="none" stroke="#3838ff" stroke-width="1.5" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="dmn-prvcy-cnt">
                                        <span>Avoid Unwanted Spam & Calls</span>
                                        Domain Registration without privacy protection means that details like email and phone numbers become publicly available, making it easier for spammers and telemarketers to target you. With Privacy Protection, your info stays hidden.
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="enhanced-sec-tab-pane" role="tabpanel" aria-labelledby="enhanced-sec-tab" tabindex="0">
                                <div class="dmn-prvcy-rgt-box">
                                    <div class="dmn-prvcy-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.255" height="25.32" viewBox="0 0 26.255 25.32">
                                            <g id="Group_169760" data-name="Group 169760" transform="translate(0.601 0.75)">
                                                <g id="Group_169759" data-name="Group 169759" transform="translate(0 0)">
                                                    <path id="Path_243735" data-name="Path 243735" d="M15.49,10.631,22.631,3.49M24.1,7.049A5.049,5.049,0,1,1,19.049,2,5.049,5.049,0,0,1,24.1,7.049Z" transform="translate(0.806 -2)" fill="none" stroke="#3838ff" stroke-linecap="round" stroke-width="1.5" />
                                                    <path id="Path_243736" data-name="Path 243736" d="M5.176,17.911c2.765,4.787,6.162,9.013,12.006,7.243a3.211,3.211,0,0,0,1.752-4.441l-1.2-2.842a2.569,2.569,0,0,0-4.153-.848l-.071.067a2.4,2.4,0,0,1-2.287.593,4,4,0,0,1-2.828-4.9A2.4,2.4,0,0,1,10.053,11.1l.093-.027a2.569,2.569,0,0,0,1.342-4.022L9.627,4.594a3.211,3.211,0,0,0-4.721-.7C.451,8.068,2.411,13.123,5.176,17.911Z" transform="translate(-2.271 -1.702)" fill="none" stroke="#3838ff" stroke-width="1.5" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="dmn-prvcy-cnt">
                                        <span>Enhanced Security</span>
                                        When you register a domain, your details become publicly visible in the <a class="text-light" href="https://www.hostitsmart.com/blog/guide-to-whois-lookup/"><u>WHOIS Lookup</u></a>. Domain Privacy Protection hides this sensitive information and adds an extra layer of security.
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="stay-sec-tab-pane" role="tabpanel" aria-labelledby="stay-sec-tab" tabindex="0">
                                <div class="dmn-prvcy-rgt-box">
                                    <div class="dmn-prvcy-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.255" height="25.32" viewBox="0 0 26.255 25.32">
                                            <g id="Group_169760" data-name="Group 169760" transform="translate(0.601 0.75)">
                                                <g id="Group_169759" data-name="Group 169759" transform="translate(0 0)">
                                                    <path id="Path_243735" data-name="Path 243735" d="M15.49,10.631,22.631,3.49M24.1,7.049A5.049,5.049,0,1,1,19.049,2,5.049,5.049,0,0,1,24.1,7.049Z" transform="translate(0.806 -2)" fill="none" stroke="#3838ff" stroke-linecap="round" stroke-width="1.5" />
                                                    <path id="Path_243736" data-name="Path 243736" d="M5.176,17.911c2.765,4.787,6.162,9.013,12.006,7.243a3.211,3.211,0,0,0,1.752-4.441l-1.2-2.842a2.569,2.569,0,0,0-4.153-.848l-.071.067a2.4,2.4,0,0,1-2.287.593,4,4,0,0,1-2.828-4.9A2.4,2.4,0,0,1,10.053,11.1l.093-.027a2.569,2.569,0,0,0,1.342-4.022L9.627,4.594a3.211,3.211,0,0,0-4.721-.7C.451,8.068,2.411,13.123,5.176,17.911Z" transform="translate(-2.271 -1.702)" fill="none" stroke="#3838ff" stroke-width="1.5" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="dmn-prvcy-cnt">
                                        <span>Stay Compliant</span>
                                        ICANN rules require your contact details to be valid and accurate. Domain Privacy keeps you compliant while protecting your information online. It replaces your details with the registrar’s generic ones to ensure compliance with the rules.
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="maint-img-sec-tab-pane" role="tabpanel" aria-labelledby="maint-img-sec-tab" tabindex="0">
                                <div class="dmn-prvcy-rgt-box">
                                    <div class="dmn-prvcy-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.255" height="25.32" viewBox="0 0 26.255 25.32">
                                            <g id="Group_169760" data-name="Group 169760" transform="translate(0.601 0.75)">
                                                <g id="Group_169759" data-name="Group 169759" transform="translate(0 0)">
                                                    <path id="Path_243735" data-name="Path 243735" d="M15.49,10.631,22.631,3.49M24.1,7.049A5.049,5.049,0,1,1,19.049,2,5.049,5.049,0,0,1,24.1,7.049Z" transform="translate(0.806 -2)" fill="none" stroke="#3838ff" stroke-linecap="round" stroke-width="1.5" />
                                                    <path id="Path_243736" data-name="Path 243736" d="M5.176,17.911c2.765,4.787,6.162,9.013,12.006,7.243a3.211,3.211,0,0,0,1.752-4.441l-1.2-2.842a2.569,2.569,0,0,0-4.153-.848l-.071.067a2.4,2.4,0,0,1-2.287.593,4,4,0,0,1-2.828-4.9A2.4,2.4,0,0,1,10.053,11.1l.093-.027a2.569,2.569,0,0,0,1.342-4.022L9.627,4.594a3.211,3.211,0,0,0-4.721-.7C.451,8.068,2.411,13.123,5.176,17.911Z" transform="translate(-2.271 -1.702)" fill="none" stroke="#3838ff" stroke-width="1.5" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="dmn-prvcy-cnt">
                                        <span>Maintain Your Professional Image</span>
                                        When someone looks up your domain, your info shows up. With Domain Privacy Protection, that data stays hidden, and your brand looks clean and trustworthy, which makes it look professional while keeping things private.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why-dmn-wth-main head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">
                So Many Cheap Domain Registrars! <br> Why Should You Register a Domain in India With Host IT Smart?
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="why-dmn-box">
                    <div class="why-dmn-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70.915" height="71" viewBox="0 0 70.915 71">
                            <g id="Group_169714" data-name="Group 169714" transform="translate(-2.037 -1.998)">
                                <path id="Path_243656" data-name="Path 243656" d="M64.861,8.743V32.92H2.037V8.733A6.733,6.733,0,0,1,8.772,2H58.118a6.737,6.737,0,0,1,6.745,6.744Z" transform="translate(0 0)" fill="#454545" />
                                <path id="Path_243657" data-name="Path 243657" d="M55.022,2H30.356V62.291H53.785a7.979,7.979,0,0,0,7.98-7.972V8.743A6.737,6.737,0,0,0,55.022,2Z" transform="translate(3.096 0)" fill="#2c2c2c" />
                                <path id="Path_243658" data-name="Path 243658" d="M64.861,18.477V53.255a7.978,7.978,0,0,1-7.98,7.972H8.772a6.733,6.733,0,0,1-6.734-6.735V18.466a6.733,6.733,0,0,1,6.735-6.734H58.116a6.737,6.737,0,0,1,6.745,6.744Z" transform="translate(0 1.064)" fill="#e8edf2" />
                                <path id="Path_243659" data-name="Path 243659" d="M55.022,11.732H30.356v49.5H53.785a7.979,7.979,0,0,0,7.98-7.972V18.477a6.737,6.737,0,0,0-6.744-6.745Z" transform="translate(3.096 1.064)" fill="#c4d3e4" />
                                <path id="Path_243660" data-name="Path 243660" d="M13.014,6.856v.011A1.841,1.841,0,0,1,11.17,8.7H9.639A1.841,1.841,0,0,1,7.793,6.866v-.01A1.841,1.841,0,0,1,9.638,5.021h1.531a1.841,1.841,0,0,1,1.846,1.835Zm8.344,0v.011A1.841,1.841,0,0,1,19.513,8.7H17.982a1.841,1.841,0,0,1-1.846-1.836v-.01a1.841,1.841,0,0,1,1.846-1.835h1.531a1.841,1.841,0,0,1,1.846,1.835Zm8.343,0v.011A1.841,1.841,0,0,1,27.857,8.7H26.326A1.841,1.841,0,0,1,24.48,6.866v-.01a1.841,1.841,0,0,1,1.845-1.835h1.531A1.841,1.841,0,0,1,29.7,6.856ZM3.432,53.238V51.776a1.471,1.471,0,0,1,.422-1.032,1.472,1.472,0,0,1,2.524,1.032v1.462a1.473,1.473,0,1,1-2.945,0Zm0-6.258v-9.9a1.469,1.469,0,0,1,.422-1.031,1.472,1.472,0,0,1,2.524,1.031v9.9a1.473,1.473,0,1,1-2.945,0Z" transform="translate(0.153 0.33)" fill="#fff" />
                                <path id="Path_243661" data-name="Path 243661" d="M11.171,36h-.211a1.99,1.99,0,0,0-1.985,1.985v.128a1.916,1.916,0,0,0,.582,1.4,1.945,1.945,0,0,0,1.4.584h.212a1.992,1.992,0,0,0,1.985-1.985v-.128A1.99,1.99,0,0,0,11.171,36Zm9.287-5.189a3.363,3.363,0,0,1,1,.122,7.077,7.077,0,0,1,1.057.459,1.6,1.6,0,0,0,2-.3,1.62,1.62,0,0,0,.455-1.123,1.649,1.649,0,0,0-.793-1.414,8.149,8.149,0,0,0-1.68-.811,6.666,6.666,0,0,0-2.2-.333,6.791,6.791,0,0,0-3.19.771,6.043,6.043,0,0,0-2.378,2.241,6.959,6.959,0,0,0,0,6.809A6.04,6.04,0,0,0,17.1,39.476a6.8,6.8,0,0,0,3.19.77,6.669,6.669,0,0,0,2.2-.332,8.148,8.148,0,0,0,1.686-.814,1.646,1.646,0,0,0,.788-1.411,1.62,1.62,0,0,0-.455-1.123,1.6,1.6,0,0,0-1.98-.307,7.333,7.333,0,0,1-1.076.468,3.357,3.357,0,0,1-1,.122,3.062,3.062,0,0,1-2.3-.813,3.411,3.411,0,0,1,0-4.412,3.057,3.057,0,0,1,2.3-.813Zm14.047-2.594a6.954,6.954,0,0,0-6.493,0,5.554,5.554,0,0,0-2.21,2.307,7.586,7.586,0,0,0,0,6.609,5.557,5.557,0,0,0,2.21,2.307,6.952,6.952,0,0,0,6.492,0,5.629,5.629,0,0,0,2.219-2.3,7.482,7.482,0,0,0,0-6.618,5.635,5.635,0,0,0-2.219-2.3ZM28.969,35.61a4.213,4.213,0,0,1,0-3.583,2.324,2.324,0,0,1,.97-.948,2.981,2.981,0,0,1,2.644,0,2.378,2.378,0,0,1,.983.954,3.451,3.451,0,0,1,.407,1.775,3.508,3.508,0,0,1-.406,1.8,2.45,2.45,0,0,1-.993.97,2.884,2.884,0,0,1-2.628,0,2.407,2.407,0,0,1-.976-.964Zm27-5.581a4.345,4.345,0,0,0-1.438-1.864,4.016,4.016,0,0,0-2.459-.752,5.036,5.036,0,0,0-3.825,1.562,4.687,4.687,0,0,0-.806-.765,4.086,4.086,0,0,0-2.514-.8,4.685,4.685,0,0,0-2.612.683q-.222.146-.429.312a1.757,1.757,0,0,0-1.554-.881,1.719,1.719,0,0,0-1.236.521,1.737,1.737,0,0,0-.5,1.244v9.1A1.715,1.715,0,0,0,39.1,39.63a1.8,1.8,0,0,0,2.485.011,1.707,1.707,0,0,0,.529-1.254v-6.13a4.533,4.533,0,0,1,.96-1.078,2.019,2.019,0,0,1,1.3-.389,1.343,1.343,0,0,1,1.036.328,2.587,2.587,0,0,1,.329,1.545v5.724a1.713,1.713,0,0,0,.508,1.242,1.784,1.784,0,0,0,2.485.011,1.707,1.707,0,0,0,.529-1.254v-6.13a4.515,4.515,0,0,1,.96-1.078,2.011,2.011,0,0,1,1.3-.389,1.341,1.341,0,0,1,1.035.328,2.593,2.593,0,0,1,.329,1.545v5.724a1.739,1.739,0,0,0,1.752,1.753,1.753,1.753,0,0,0,1.239-.5,1.7,1.7,0,0,0,.532-1.254V32.282a5.89,5.89,0,0,0-.44-2.252Z" transform="translate(0.759 2.778)" fill="#e9293a" />
                                <path id="Path_243662" data-name="Path 243662" d="M69.084,50.575V56a1.589,1.589,0,0,1-1.212,1.54L65.1,58.2l1.486,2.424a1.58,1.58,0,0,1-.229,1.944L62.534,66.4a1.581,1.581,0,0,1-1.944.229l-2.424-1.486L57.5,67.91a1.581,1.581,0,0,1-1.532,1.21h-5.42A1.588,1.588,0,0,1,49,67.909l-.663-2.776-2.424,1.494a1.58,1.58,0,0,1-1.945-.229l-3.834-3.835a1.59,1.59,0,0,1-.229-1.944L41.4,58.2l-2.774-.663a1.589,1.589,0,0,1-1.212-1.54V50.581a1.581,1.581,0,0,1,1.212-1.539l2.774-.663L39.91,45.947a1.58,1.58,0,0,1,.229-1.937l3.834-3.835a1.58,1.58,0,0,1,1.945-.229l2.424,1.494L49,38.666a1.59,1.59,0,0,1,1.54-1.212h5.42A1.58,1.58,0,0,1,57.5,38.666l.671,2.759,2.424-1.479a1.581,1.581,0,0,1,1.945.229l3.827,3.835a1.571,1.571,0,0,1,.227,1.937l-1.479,2.424,2.76.671a1.579,1.579,0,0,1,1.212,1.531Z" transform="translate(3.868 3.876)" fill="#108be1" />
                                <path id="Path_243663" data-name="Path 243663" d="M45.72,41.885a.881.881,0,0,1-.266.635L42.483,45.49a.884.884,0,0,1-.635.266.871.871,0,0,1-.635-.266.9.9,0,0,1,0-1.278l2.962-2.962a.919.919,0,0,1,1.278,0,.866.866,0,0,1,.266.635Z" transform="translate(4.254 4.263)" fill="#4db6ff" />
                                <path id="Path_243664" data-name="Path 243664" d="M66.311,49.042l-2.76-.67,1.48-2.424a1.569,1.569,0,0,0-.23-1.937l-3.827-3.835a1.581,1.581,0,0,0-1.944-.229l-2.424,1.479-.671-2.759A1.581,1.581,0,0,0,54.4,37.455H51.689V69.122H54.4a1.581,1.581,0,0,0,1.532-1.211l.671-2.768,2.424,1.486a1.582,1.582,0,0,0,1.945-.229L64.8,62.566a1.58,1.58,0,0,0,.229-1.944L63.544,58.2l2.767-.663a1.589,1.589,0,0,0,1.212-1.541V50.575a1.581,1.581,0,0,0-1.212-1.532Z" transform="translate(5.428 3.876)" fill="#0c6bc3" />
                                <path id="Path_243665" data-name="Path 243665" d="M61.026,52.568a8.5,8.5,0,1,1-2.488-6.013,8.5,8.5,0,0,1,2.488,6.013Z" transform="translate(4.591 4.599)" fill="#fabb53" />
                                <path id="Path_243666" data-name="Path 243666" d="M60.189,52.568a8.5,8.5,0,0,1-8.5,8.5v-17a8.5,8.5,0,0,1,8.5,8.5Z" transform="translate(5.428 4.599)" fill="#f99944" />
                            </g>
                        </svg>
                    </div>
                    <div class="why-dmn-cnt">
                        3,000+ Domains Registered
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="why-dmn-box">
                    <div class="why-dmn-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="77.956" height="71" viewBox="0 0 77.956 71">
                            <g id="Group_169726" data-name="Group 169726" transform="translate(-2.545 -4.682)">
                                <path id="Path_243667" data-name="Path 243667" d="M74.91,22.331V61.244H5.026V22.331a7.228,7.228,0,0,1,7.239-7.223H67.687a7.213,7.213,0,0,1,7.223,7.224Z" transform="translate(1.556 6.538)" fill="#5b5e8b" />
                                <path id="Path_243668" data-name="Path 243668" d="M74.914,56.342v4.8H5.03V22.226a7.216,7.216,0,0,1,5.243-6.944,7.075,7.075,0,0,0-.329,2.145v29.5a9.413,9.413,0,0,0,9.414,9.413H74.914Z" transform="translate(1.558 6.647)" fill="#312e4b" />
                                <path id="Path_243669" data-name="Path 243669" d="M72.659,51.354H10.385a7.841,7.841,0,0,1-7.839-7.838v-.054H80.5v.052a7.841,7.841,0,0,1-7.841,7.839Z" transform="translate(0.001 24.319)" fill="#5b5e8b" />
                                <path id="Path_243670" data-name="Path 243670" d="M17.021,51.361H10.438a7.9,7.9,0,0,1-7.893-7.895H9.127a7.9,7.9,0,0,0,7.893,7.895Z" transform="translate(0 24.321)" fill="#312e4b" />
                                <path id="Path_243671" data-name="Path 243671" d="M8.049,51.245V21.322a3.2,3.2,0,0,1,3.2-3.2H64.908a3.2,3.2,0,0,1,3.2,3.2V51.245a3.2,3.2,0,0,1-3.2,3.2H11.246a3.2,3.2,0,0,1-3.2-3.2Z" transform="translate(3.452 8.43)" fill="#65b9ff" />
                                <path id="Path_243672" data-name="Path 243672" d="M14.111,54.448H11.244A3.2,3.2,0,0,1,8.05,51.254V21.331a3.2,3.2,0,0,1,3.194-3.21h2.867a3.2,3.2,0,0,0-3.194,3.21V51.254A3.188,3.188,0,0,0,14.111,54.448Z" transform="translate(3.452 8.428)" fill="#3e7fff" />
                                <path id="Path_243673" data-name="Path 243673" d="M45.236,71.728a1.533,1.533,0,0,1-1.526,1.525H28.955a1.525,1.525,0,0,1,0-3.049H43.709a1.533,1.533,0,0,1,1.525,1.525ZM61.861,8.348v42.4A3.666,3.666,0,0,1,58.2,54.411H14.482a3.666,3.666,0,0,1-3.666-3.666V8.348a3.666,3.666,0,0,1,3.666-3.666H58.2a3.666,3.666,0,0,1,3.666,3.666Z" transform="translate(5.187 0)" fill="#deddff" />
                                <path id="Path_243674" data-name="Path 243674" d="M18.071,54.406H14.479a3.669,3.669,0,0,1-3.666-3.666V8.351a3.669,3.669,0,0,1,3.666-3.666h3.593a3.661,3.661,0,0,0-3.666,3.666V50.74a3.661,3.661,0,0,0,3.666,3.666Z" transform="translate(5.185 0.002)" fill="#c6c6f7" />
                                <path id="Path_243675" data-name="Path 243675" d="M61.865,8.351v5.09H10.813V8.351a3.669,3.669,0,0,1,3.666-3.666H58.2a3.661,3.661,0,0,1,3.666,3.666Z" transform="translate(5.185 0.002)" fill="#fcb73e" />
                                <path id="Path_243676" data-name="Path 243676" d="M18.071,4.685a3.661,3.661,0,0,0-3.666,3.666v5.09H10.813V8.351a3.669,3.669,0,0,1,3.666-3.666Z" transform="translate(5.185 0.002)" fill="#e87f21" />
                                <circle id="Ellipse_491" data-name="Ellipse 491" cx="1.391" cy="1.391" r="1.391" transform="translate(21.626 7.23)" fill="#deddff" />
                                <circle id="Ellipse_492" data-name="Ellipse 492" cx="1.391" cy="1.391" r="1.391" transform="translate(26.322 7.23)" fill="#deddff" />
                                <circle id="Ellipse_493" data-name="Ellipse 493" cx="1.391" cy="1.391" r="1.391" transform="translate(31.016 7.23)" fill="#deddff" />
                                <path id="Path_243677" data-name="Path 243677" d="M14.559,19.147l-.013-4.64a2.118,2.118,0,0,1,2.118-2.125h6.074a2.119,2.119,0,0,1,2.12,2.12v4.64a2.119,2.119,0,0,1-2.12,2.12H16.678A2.119,2.119,0,0,1,14.559,19.147Z" transform="translate(7.526 4.829)" fill="#e83d62" />
                                <path id="Path_243678" data-name="Path 243678" d="M14.559,27.072l-.013-4.64a2.118,2.118,0,0,1,2.118-2.125h6.074a2.119,2.119,0,0,1,2.12,2.118v4.642a2.119,2.119,0,0,1-2.12,2.118H16.678A2.118,2.118,0,0,1,14.559,27.072Z" transform="translate(7.526 9.798)" fill="#65b9ff" />
                                <path id="Path_243679" data-name="Path 243679" d="M14.559,35l-.013-4.642a2.118,2.118,0,0,1,2.118-2.125h6.074a2.119,2.119,0,0,1,2.12,2.118v4.642a2.119,2.119,0,0,1-2.12,2.12H16.678A2.119,2.119,0,0,1,14.559,35Z" transform="translate(7.526 14.768)" fill="#46cc6b" />
                                <path id="Path_243680" data-name="Path 243680" d="M18.877,21.263h-2.2a2.122,2.122,0,0,1-2.118-2.12L14.546,14.5a2.122,2.122,0,0,1,2.12-2.118h2.2A2.121,2.121,0,0,0,16.744,14.5l.016,4.642a2.119,2.119,0,0,0,2.117,2.118Z" transform="translate(7.526 4.829)" fill="#ce2955" />
                                <path id="Path_243681" data-name="Path 243681" d="M18.877,29.191h-2.2a2.122,2.122,0,0,1-2.118-2.12l-.016-4.642a2.122,2.122,0,0,1,2.12-2.118h2.2a2.121,2.121,0,0,0-2.118,2.118l.016,4.642A2.12,2.12,0,0,0,18.877,29.191Z" transform="translate(7.526 9.8)" fill="#3e7fff" />
                                <path id="Path_243682" data-name="Path 243682" d="M18.877,37.109h-2.2a2.107,2.107,0,0,1-2.118-2.1l-.016-4.644a2.126,2.126,0,0,1,2.12-2.135h2.2a2.124,2.124,0,0,0-2.118,2.135l.016,4.644A2.105,2.105,0,0,0,18.877,37.109Z" transform="translate(7.526 14.766)" fill="#179c5f" />
                                <path id="Path_243683" data-name="Path 243683" d="M24.948,16.76v-.067a.626.626,0,0,1,.623-.625h.112a.627.627,0,0,1,.623.625v.065a.627.627,0,0,1-.623.625h-.112a.625.625,0,0,1-.623-.623Z" transform="translate(14.049 7.14)" fill="#5b5e8b" />
                                <path id="Path_243684" data-name="Path 243684" d="M25.746,19.282h-.114a.788.788,0,0,1-.784-.786V18.43a.789.789,0,0,1,.786-.788h.111a.79.79,0,0,1,.788.788v.065a.789.789,0,0,1-.788.788Zm-.114-1.313a.464.464,0,0,0-.459.46v.065a.465.465,0,0,0,.46.462h.111a.464.464,0,0,0,.462-.46V18.43a.464.464,0,0,0-.462-.46Zm1.928-1.723A2.854,2.854,0,0,1,30.531,13.3a3.142,3.142,0,0,1,1.814.534.442.442,0,0,1,.094.7.416.416,0,0,1-.539.073,2.359,2.359,0,0,0-1.281-.358,1.889,1.889,0,0,0-2.049,2,1.888,1.888,0,0,0,2.049,2,2.367,2.367,0,0,0,1.281-.356.414.414,0,0,1,.539.073.44.44,0,0,1-.094.695,3.15,3.15,0,0,1-1.814.535,2.857,2.857,0,0,1-2.971-2.95Z" transform="translate(13.986 5.403)" fill="#5b5e8b" />
                                <path id="Path_243685" data-name="Path 243685" d="M29.55,19.423a3.021,3.021,0,0,1-3.135-3.113A3.02,3.02,0,0,1,29.55,13.2a3.317,3.317,0,0,1,1.9.56.606.606,0,0,1,.127.944.583.583,0,0,1-.737.106,2.191,2.191,0,0,0-1.2-.337,1.726,1.726,0,0,0-1.886,1.84,1.726,1.726,0,0,0,1.887,1.84,2.2,2.2,0,0,0,1.2-.338.583.583,0,0,1,.732.107.606.606,0,0,1-.124.942,3.31,3.31,0,0,1-1.9.561Zm0-5.9a2.7,2.7,0,0,0-2.812,2.787A2.7,2.7,0,0,0,29.55,19.1a2.979,2.979,0,0,0,1.726-.508.279.279,0,0,0,.062-.446A.251.251,0,0,0,31,18.1a2.532,2.532,0,0,1-1.359.377,2.049,2.049,0,0,1-2.21-2.167,2.047,2.047,0,0,1,2.21-2.167,2.521,2.521,0,0,1,1.354.376.249.249,0,0,0,.345-.037.278.278,0,0,0-.062-.449,2.984,2.984,0,0,0-1.725-.509Zm2.914,2.786a2.852,2.852,0,1,1,5.7,0,2.852,2.852,0,1,1-5.7,0Zm4.686-.01a1.824,1.824,0,0,0-1.835-2.014A1.8,1.8,0,0,0,33.478,16.3a1.821,1.821,0,0,0,1.837,2.037A1.842,1.842,0,0,0,37.151,16.3Z" transform="translate(14.969 5.34)" fill="#5b5e8b" />
                                <path id="Path_243686" data-name="Path 243686" d="M33.044,19.423a2.891,2.891,0,0,1-3.01-3.113,3.013,3.013,0,1,1,6.024,0A2.906,2.906,0,0,1,33.044,19.423Zm0-5.9a2.569,2.569,0,0,0-2.685,2.787,2.689,2.689,0,1,0,5.374,0,2.585,2.585,0,0,0-2.69-2.787Zm0,4.976a1.981,1.981,0,0,1-2-2.2,2.007,2.007,0,1,1,4,0A2,2,0,0,1,33.044,18.5Zm0-4.051A1.645,1.645,0,0,0,31.37,16.3a1.687,1.687,0,1,0,3.35,0A1.665,1.665,0,0,0,33.044,14.448ZM37.307,18.7V13.929a.5.5,0,0,1,.5-.513.512.512,0,0,1,.513.513v.456a2.119,2.119,0,0,1,1.892-1.023,1.8,1.8,0,0,1,1.7,1.147,2.242,2.242,0,0,1,2.049-1.147A1.924,1.924,0,0,1,45.822,15.5V18.7a.5.5,0,0,1-.511.5.493.493,0,0,1-.5-.5V15.7c0-.9-.255-1.4-1.136-1.4a1.764,1.764,0,0,0-1.6,1.067V18.7a.5.5,0,0,1-.513.5.491.491,0,0,1-.5-.5V15.7c0-.906-.26-1.4-1.136-1.4a1.764,1.764,0,0,0-1.6,1.067V18.7a.5.5,0,0,1-.513.5.491.491,0,0,1-.5-.5Z" transform="translate(17.238 5.34)" fill="#5b5e8b" />
                                <path id="Path_243687" data-name="Path 243687" d="M48.49,19.368a.651.651,0,0,1-.664-.664V15.7c0-.994-.342-1.24-.973-1.24a1.589,1.589,0,0,0-1.44.952V18.7a.669.669,0,0,1-1.337,0V15.7c0-1-.343-1.24-.973-1.24a1.593,1.593,0,0,0-1.442.952V18.7a.668.668,0,0,1-1.336,0V13.929a.668.668,0,0,1,1.336,0v0a2.161,2.161,0,0,1,1.731-.734,1.953,1.953,0,0,1,1.725.983,2.389,2.389,0,0,1,2.024-.983,2.084,2.084,0,0,1,2.022,2.3V18.7a.661.661,0,0,1-.674.662Zm-1.637-5.234c.981,0,1.3.581,1.3,1.565V18.7a.343.343,0,0,0,.687,0V15.5a1.767,1.767,0,0,0-1.7-1.975,2.068,2.068,0,0,0-1.907,1.067l-.171.283-.12-.308a1.643,1.643,0,0,0-1.551-1.041,1.959,1.959,0,0,0-1.759.953l-.3.421v-.971a.344.344,0,1,0-.688,0V18.7a.344.344,0,0,0,.688,0V15.32l.023-.039A1.926,1.926,0,0,1,43.1,14.134c.983,0,1.3.584,1.3,1.565V18.7a.345.345,0,0,0,.69,0V15.32l.021-.039a1.93,1.93,0,0,1,1.741-1.147ZM24.965,32.05v-.068a.647.647,0,0,1,.644-.646h.116a.646.646,0,0,1,.646.646v.068a.646.646,0,0,1-.646.646h-.114A.646.646,0,0,1,24.965,32.05Z" transform="translate(14.06 5.34)" fill="#5b5e8b" />
                                <path id="Path_243688" data-name="Path 243688" d="M25.788,27.666h-.114a.81.81,0,0,1-.809-.809v-.068a.809.809,0,0,1,.807-.809h.116a.809.809,0,0,1,.807.809v.068a.807.807,0,0,1-.807.809Zm-.114-.325h.114a.483.483,0,0,0,.483-.483v-.068a.485.485,0,0,0-.483-.482h-.114a.485.485,0,0,0-.485.482v.068a.484.484,0,0,0,.483.483Zm2.465-.332V22.064a.517.517,0,0,1,.517-.529.529.529,0,0,1,.53.529v.472a2.711,2.711,0,0,1,2.143-1.058,2.069,2.069,0,0,1,2.063,2.257v3.274a.518.518,0,0,1-.53.517.509.509,0,0,1-.519-.517V23.852q0-1.408-1.266-1.407a2.425,2.425,0,0,0-1.891,1.106v3.458a.521.521,0,0,1-.53.517.509.509,0,0,1-.517-.517Z" transform="translate(13.997 10.533)" fill="#5b5e8b" />
                                <path id="Path_243689" data-name="Path 243689" d="M31.663,27.753a.67.67,0,0,1-.68-.683V23.913c0-.846-.351-1.241-1.106-1.241a2.228,2.228,0,0,0-1.726,1v3.4a.687.687,0,0,1-1.373,0V22.128a.687.687,0,0,1,1.373,0V22.2a2.7,2.7,0,0,1,1.982-.825A2.23,2.23,0,0,1,32.356,23.8v3.274A.681.681,0,0,1,31.663,27.753Zm-1.787-5.408c.654,0,1.432.273,1.432,1.569V27.07a.362.362,0,0,0,.724,0V23.8a1.91,1.91,0,0,0-1.9-2.094,2.55,2.55,0,0,0-2.024,1.006l-.281.312v-.895a.363.363,0,1,0-.726,0v4.945a.363.363,0,0,0,.726,0V23.557l.034-.044a2.577,2.577,0,0,1,2.018-1.168ZM33.6,24.593a2.745,2.745,0,0,1,2.753-3.052,2.705,2.705,0,0,1,2.743,2.9.5.5,0,0,1-.53.519H34.66a1.806,1.806,0,0,0,2.014,1.705,3.248,3.248,0,0,0,1.557-.358.477.477,0,0,1,.529.081.451.451,0,0,1-.161.748,3.6,3.6,0,0,1-2.018.506A2.755,2.755,0,0,1,33.6,24.593Zm4.458-.485a1.686,1.686,0,0,0-1.705-1.681,1.66,1.66,0,0,0-1.692,1.681Z" transform="translate(15.196 10.47)" fill="#5b5e8b" />
                                <path id="Path_243690" data-name="Path 243690" d="M34.015,28.145A2.917,2.917,0,0,1,30.87,24.93a2.905,2.905,0,0,1,2.916-3.215,2.865,2.865,0,0,1,2.9,3.065.662.662,0,0,1-.692.68H32.282a1.637,1.637,0,0,0,1.826,1.381A3.035,3.035,0,0,0,35.59,26.5a.648.648,0,0,1,.714.107.611.611,0,0,1-.19,1.009,3.753,3.753,0,0,1-2.1.53Zm-.229-6.1a2.589,2.589,0,0,0-2.592,2.89,2.6,2.6,0,0,0,2.821,2.891,3.446,3.446,0,0,0,1.94-.488c.264-.151.262-.361.13-.487a.317.317,0,0,0-.35-.054,3.389,3.389,0,0,1-1.627.374,1.969,1.969,0,0,1-2.177-1.852l-.021-.179H36a.341.341,0,0,0,.368-.358,2.541,2.541,0,0,0-2.581-2.738Zm1.879,2.568H31.919l.011-.172a1.862,1.862,0,0,1,3.723,0Zm-3.392-.325h3.039a1.529,1.529,0,0,0-3.039,0Zm5.984,2.18V22.889h-.818a.225.225,0,0,1-.114-.417l1.565-1.531c.207-.207.415-.06.415.127v.921h1.3a.433.433,0,0,1,.451.449.444.444,0,0,1-.449.451h-1.3v3.479c0,.3.07.49.212.569a1.5,1.5,0,0,0,1.1.031.436.436,0,0,1,.42.109.423.423,0,0,1-.137.7,2.253,2.253,0,0,1-.957.207c-1.123,0-1.682-.5-1.682-1.52Z" transform="translate(17.763 10.133)" fill="#5b5e8b" />
                                <path id="Path_243691" data-name="Path 243691" d="M43.649,28.208c-1.207,0-1.845-.581-1.845-1.682v-3.41h-.656a.388.388,0,0,1-.215-.708l1.552-1.518a.386.386,0,0,1,.692.244v.757h1.139a.6.6,0,0,1,.612.612.6.6,0,0,1-.612.613H43.178v3.316c0,.228.049.381.132.43a1.374,1.374,0,0,0,.97.013.607.607,0,0,1,.576.148.589.589,0,0,1-.174.96,2.438,2.438,0,0,1-1.032.226ZM42.8,21.074a.114.114,0,0,0-.083.046l-1.569,1.534c-.094.075-.057.137,0,.137h.98v3.734c0,.927.483,1.359,1.521,1.359a2.075,2.075,0,0,0,.888-.194.262.262,0,0,0,.094-.431.294.294,0,0,0-.277-.067,1.68,1.68,0,0,1-1.209-.049.752.752,0,0,1-.293-.711V22.791h1.464A.281.281,0,0,0,44.6,22.5a.272.272,0,0,0-.288-.286H42.852V21.133a.075.075,0,0,0-.021-.054.1.1,0,0,0-.033,0ZM24.954,38.349v-.068a.631.631,0,0,1,.631-.631H25.7a.633.633,0,0,1,.631.631v.068a.633.633,0,0,1-.631.63h-.114a.631.631,0,0,1-.631-.63Z" transform="translate(14.053 10.071)" fill="#5b5e8b" />
                                <path id="Path_243692" data-name="Path 243692" d="M25.761,34.385h-.114a.791.791,0,0,1-.792-.792v-.068a.792.792,0,0,1,.792-.794h.114a.794.794,0,0,1,.792.794v.068a.794.794,0,0,1-.792.792Zm-.114-1.329a.469.469,0,0,0-.469.469v.068a.468.468,0,0,0,.469.467h.114a.468.468,0,0,0,.469-.467v-.068a.47.47,0,0,0-.469-.469ZM27.6,31.314a2.888,2.888,0,1,1,5.773,0,2.887,2.887,0,1,1-5.771,0Zm4.748-.011a1.869,1.869,0,1,0-3.721,0,1.871,1.871,0,1,0,3.721,0Z" transform="translate(13.991 14.828)" fill="#5b5e8b" />
                                <path id="Path_243693" data-name="Path 243693" d="M29.489,34.527a2.926,2.926,0,0,1-3.048-3.15,3.05,3.05,0,1,1,6.1,0A2.938,2.938,0,0,1,29.489,34.527Zm0-5.975a2.607,2.607,0,0,0-2.724,2.825,2.726,2.726,0,1,0,5.449,0A2.618,2.618,0,0,0,29.489,28.552Zm0,5.039a2.011,2.011,0,0,1-2.021-2.226,2.03,2.03,0,1,1,4.043,0A2.025,2.025,0,0,1,29.489,33.592Zm0-4.1a1.67,1.67,0,0,0-1.7,1.878,1.71,1.71,0,1,0,3.4,0A1.68,1.68,0,0,0,29.489,29.488ZM33.807,33.8V28.964a.506.506,0,0,1,.508-.517.516.516,0,0,1,.519.517v.485A2.221,2.221,0,0,1,36.6,28.39h.057a.488.488,0,0,1,.5.508.482.482,0,0,1-.517.485h-.059a2.069,2.069,0,0,0-1.746.993V33.8a.508.508,0,0,1-.519.508.5.5,0,0,1-.508-.508Z" transform="translate(14.985 14.765)" fill="#5b5e8b" />
                                <path id="Path_243694" data-name="Path 243694" d="M31.538,34.472a.661.661,0,0,1-.669-.67V28.964a.674.674,0,0,1,1.349,0V29a2.183,2.183,0,0,1,1.608-.773h.057a.659.659,0,1,1-.021,1.318H33.8a1.91,1.91,0,0,0-1.586.879V33.8a.669.669,0,0,1-.68.67Zm0-5.862a.343.343,0,0,0-.345.355V33.8a.35.35,0,0,0,.7,0V30.324l.028-.041A2.239,2.239,0,0,1,33.8,29.22h.057a.321.321,0,0,0,.355-.322.329.329,0,0,0-.334-.345h-.057a2.084,2.084,0,0,0-1.64.993l-.293.4v-.976a.355.355,0,0,0-.355-.355Zm3.912,7.761a.472.472,0,0,1-.073-.716.445.445,0,0,1,.524-.1,4.1,4.1,0,0,0,1.861.43q1.723,0,1.725-1.839v-.755a2.543,2.543,0,0,1-1.928.857,2.755,2.755,0,0,1-2.729-2.932,2.769,2.769,0,0,1,2.729-2.93,2.544,2.544,0,0,1,1.928.856v-.281a.507.507,0,0,1,.508-.517.518.518,0,0,1,.519.517V34c0,1.8-.866,2.955-2.651,2.955a5.286,5.286,0,0,1-2.413-.586Zm4.035-3.889V30.158a2.244,2.244,0,0,0-1.712-.833,1.812,1.812,0,0,0-1.917,1.995,1.812,1.812,0,0,0,1.917,2,2.249,2.249,0,0,0,1.713-.835Z" transform="translate(17.762 14.765)" fill="#5b5e8b" />
                                <path id="Path_243695" data-name="Path 243695" d="M36.4,37.121a5.437,5.437,0,0,1-2.5-.609.637.637,0,0,1-.111-.968.588.588,0,0,1,.7-.135,4.005,4.005,0,0,0,1.8.417c1.064,0,1.562-.532,1.562-1.676v-.374a2.673,2.673,0,0,1-1.765.639A2.912,2.912,0,0,1,33.2,31.32a2.931,2.931,0,0,1,2.89-3.093,2.67,2.67,0,0,1,1.77.644.676.676,0,0,1,1.346.093V34c0,1.868-.921,3.116-2.81,3.116Zm-2.367-1.354a.308.308,0,0,0,.037.465,5.139,5.139,0,0,0,2.33.563c1.679,0,2.486-1.071,2.486-2.79V28.964a.351.351,0,1,0-.7,0v.695l-.28-.3a2.366,2.366,0,0,0-1.809-.805,2.6,2.6,0,0,0-2.566,2.768,2.6,2.6,0,0,0,2.566,2.769,2.676,2.676,0,0,0,2.089-1.106V34.15c0,1.31-.651,2-1.886,2a4.272,4.272,0,0,1-1.933-.446A.278.278,0,0,0,34.032,35.767Zm2.276-2.288a1.972,1.972,0,0,1-2.078-2.159,1.97,1.97,0,0,1,2.078-2.158,2.4,2.4,0,0,1,1.829.882l.046.049v2.455l-.046.047A2.408,2.408,0,0,1,36.309,33.479Zm0-3.991a1.648,1.648,0,0,0-1.754,1.832,1.649,1.649,0,0,0,1.754,1.834,2.054,2.054,0,0,0,1.551-.739v-2.19A2.059,2.059,0,0,0,36.309,29.488Z" transform="translate(19.226 14.765)" fill="#5b5e8b" />
                                <path id="Path_243696" data-name="Path 243696" d="M17.754,16.959l-1.071-1.071a.558.558,0,1,1,.789-.789l.675.675,1.746-1.746a.559.559,0,1,1,.789.791l-2.14,2.14a.558.558,0,0,1-.789,0Zm0,13.326-1.071-1.071a.558.558,0,1,1,.789-.789l.675.675,1.746-1.746a.558.558,0,1,1,.789.789l-2.14,2.141A.558.558,0,0,1,17.754,30.285Zm0,13.324-1.071-1.069a.558.558,0,1,1,.789-.789l.675.675,1.746-1.746a.558.558,0,1,1,.789.789l-2.14,2.14a.558.558,0,0,1-.789,0Z" transform="translate(8.763 5.759)" fill="#deddff" />
                            </g>
                        </svg>
                    </div>
                    <div class="why-dmn-cnt">
                        500+ Domain Extensions
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="why-dmn-box">
                    <div class="why-dmn-img">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="83.822" height="70" viewBox="0 0 83.822 70">
                            <defs>
                                <linearGradient id="linear-gradient2" x1="0.146" y1="0.146" x2="0.854" y2="0.854" gradientUnits="objectBoundingBox">
                                    <stop offset="0" stop-color="#ffc23c" />
                                    <stop offset="1" stop-color="#ff5a5e" />
                                </linearGradient>
                            </defs>
                            <g id="Group_169732" data-name="Group 169732" transform="translate(1501.891 -558.138)">
                                <g id="Group_169728" data-name="Group 169728" transform="translate(-1501.891 558.138)">
                                    <path id="Path_243702" data-name="Path 243702" d="M112.109,77.138a35,35,0,1,0,35,35A35.04,35.04,0,0,0,112.109,77.138Zm21.715,13.886a61.615,61.615,0,0,1-10.479,2.154,38.781,38.781,0,0,0-3.724-10.4,30.316,30.316,0,0,1,14.2,8.247Zm-30.059,15.912a83.28,83.28,0,0,1,.914-8.664c2.43.184,4.939.28,7.491.28,2.513,0,4.982-.093,7.377-.271a85.959,85.959,0,0,1,1.018,11.51H103.653q.034-1.442.112-2.855h0Zm-4.224-5.766q-.316,2.748-.465,5.511h0q-.085,1.554-.122,3.11H81.9a30.119,30.119,0,0,1,5.326-14.92A60.686,60.686,0,0,0,100,97.795q-.262,1.682-.455,3.375Zm-.585,13.316q.037,1.56.122,3.11h0q.149,2.75.463,5.487.194,1.7.457,3.4a60.683,60.683,0,0,0-12.775,2.925,30.121,30.121,0,0,1-5.326-14.92Zm4.809,2.855h0q-.076-1.412-.112-2.855h16.912A85.991,85.991,0,0,1,119.547,126q-3.682-.273-7.377-.271c-2.552,0-5.061.1-7.491.28a83.282,83.282,0,0,1-.914-8.664Zm21.5-2.855h17.061a30.12,30.12,0,0,1-5.3,14.884,61.1,61.1,0,0,0-12.8-2.9,92.4,92.4,0,0,0,1.037-11.98Zm0-4.7a92.411,92.411,0,0,0-1.037-11.98,61.1,61.1,0,0,0,12.8-2.9,30.118,30.118,0,0,1,5.3,14.884Zm-7.721-20c.4,1.2.761,2.488,1.085,3.843a93.7,93.7,0,0,1-13.027-.008c.119-.5.242-.99.371-1.468l.037-.136q.1-.374.211-.745c.033-.113.066-.226.1-.337q.161-.538.338-1.071.16-.487.334-.968.092-.254.185-.5a16.191,16.191,0,0,1,3.209-5.618,3.292,3.292,0,0,1,1.393-.9q.051-.013.1-.022l.045-.007a1.209,1.209,0,0,1,.185-.015c1.39,0,3.609,2.46,5.432,7.955ZM104.6,82.777a38.763,38.763,0,0,0-3.72,10.386,61.179,61.179,0,0,1-10.454-2.168A30.313,30.313,0,0,1,104.6,82.777Zm-14.175,50.5a61.183,61.183,0,0,1,10.454-2.168A38.764,38.764,0,0,0,104.6,141.5,30.315,30.315,0,0,1,90.422,133.281Zm21.57,9.155-.068-.009a1.281,1.281,0,0,1-.147-.029h0a3.29,3.29,0,0,1-1.393-.9,16.18,16.18,0,0,1-3.207-5.614q-.163-.429-.314-.862-.175-.5-.337-1.013-.107-.334-.208-.67c-.033-.111-.066-.224-.1-.336-.072-.247-.143-.5-.212-.748l-.036-.133q-.2-.732-.371-1.469a93.828,93.828,0,0,1,13.027-.008c-.325,1.355-.686,2.641-1.085,3.843-1.823,5.5-4.041,7.955-5.432,7.955C112.071,142.442,112.032,142.439,111.992,142.436Zm7.629-.936a38.787,38.787,0,0,0,3.724-10.4,61.59,61.59,0,0,1,10.479,2.154,30.317,30.317,0,0,1-14.2,8.247Z" transform="translate(-77.109 -77.138)" fill-rule="evenodd" fill="url(#linear-gradient2)" />
                                </g>
                                <g id="Group_169731" data-name="Group 169731" transform="translate(-1475.98 562.241)">
                                    <path id="_35-Checked" data-name="35-Checked" d="M103.7,103.668l-.631-1.075C98.33,94.525,85.734,77.387,85.607,77.215l-.369-.5,4.739-4.681,13.56,9.469a155.986,155.986,0,0,1,21.6-22.973,78.5,78.5,0,0,1,9.5-7.175l.171-.1h8.349l-1.414,1.259c-17.856,15.9-37.227,49.737-37.42,50.077Z" transform="translate(-85.238 -51.249)" fill="#4e4feb" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="why-dmn-cnt">
                        ICANN-Accredited Registrar
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="why-dmn-box">
                    <div class="why-dmn-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="88.945" height="70" viewBox="0 0 88.945 70">
                            <g id="Group_169733" data-name="Group 169733" transform="translate(-8.422 -15.928)">
                                <path id="Path_243704" data-name="Path 243704" d="M116.6,312.728H103.96l-9.594-32.893H109.99Z" transform="translate(-78.321 -226.8)" fill="#414952" />
                                <path id="Path_243705" data-name="Path 243705" d="M139.41,127.972l-49.249,13.98v11.576l31.614,2.129,17.634-2.129Z" transform="translate(-75.057 -108.931)" fill="#d9d9d9" />
                                <path id="Path_243706" data-name="Path 243706" d="M90.161,240.414v12.109L139.41,266.5V240.414Z" transform="translate(-75.057 -196.203)" fill="#b3b3b3" />
                                <path id="Path_243707" data-name="Path 243707" d="M303.948,114.064H289.969v28.669l6.24,1.221,7.74-1.221Z" transform="translate(-230.14 -98.136)" fill="#7e8596" />
                                <path id="Path_243708" data-name="Path 243708" d="M289.969,240.414h13.98v29.2h-13.98Z" transform="translate(-230.14 -196.203)" fill="#636978" />
                                <path id="Path_243709" data-name="Path 243709" d="M76.333,178.46H60.312v14.254l7.623,1.221,8.4-1.221Z" transform="translate(-51.89 -148.117)" fill="#ff8870" />
                                <path id="Path_243710" data-name="Path 243710" d="M60.312,240.414H76.333V255.2H60.312Z" transform="translate(-51.89 -196.203)" fill="#ff583e" />
                                <path id="Path_243711" data-name="Path 243711" d="M413.285,225.527h-12.8v3.525l6.4,1.017,6.4-1.017Z" transform="translate(-315.917 -184.649)" fill="#fff" />
                                <path id="Path_243712" data-name="Path 243712" d="M400.485,241.276h12.8v3.554h-12.8Z" transform="translate(-315.917 -196.872)" fill="#ff583e" />
                                <path id="Path_243713" data-name="Path 243713" d="M375.18,149.457l9.05-9.049,4.647,4.647-9.049,9.049Z" transform="translate(-296.277 -118.583)" fill="#fff" />
                                <path id="Path_243714" data-name="Path 243714" d="M379.879,283.29l9.049,9.049-4.647,4.647-9.05-9.049Z" transform="translate(-296.317 -229.482)" fill="#ff583e" />
                                <path id="Path_243715" data-name="Path 243715" d="M4.647,0,13.7,9.049,9.05,13.7,0,4.647Z" transform="translate(92.612 24.955) rotate(90)" fill="#ff583e" />
                            </g>
                        </svg>
                    </div>
                    <div class="why-dmn-cnt">
                        Local & Global Reach
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="why-dmn-box">
                    <div class="why-dmn-img">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64.458" height="70" viewBox="0 0 64.458 70">
                            <defs>
                                <linearGradient id="linear-gradient3" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
                                    <stop offset="0.016" stop-color="#e65233" />
                                    <stop offset="1" stop-color="#f9a82d" />
                                </linearGradient>
                            </defs>
                            <g id="Group_169734" data-name="Group 169734" transform="translate(-41.895 -23.491)">
                                <path id="Path_243716" data-name="Path 243716" d="M101.474,24.919V39.082a1.129,1.129,0,0,0,1.129,1.129h3.751L96.512,52.565,86.67,40.211H90.42a1.129,1.129,0,0,0,1.129-1.129V24.919ZM58,40.36H77.153A35.355,35.355,0,0,0,80.728,33.7a25.3,25.3,0,0,0,1.689-6.058,24.141,24.141,0,0,1-2.773-1.709c-1.457-.989-2.913-1.977-3.993-2-.994-.025-2.06.85-3.126,1.726-1.39,1.142-2.781,2.284-4.608,2.238-1.742-.045-3.472-1.219-5.2-2.393-1.457-.989-2.913-1.977-3.993-2.005-.994-.025-2.06.85-3.126,1.726a10.117,10.117,0,0,1-3.206,2.034,20.553,20.553,0,0,0,1.558,5.935A34.612,34.612,0,0,0,58,40.36Zm21.371,7.891A55.506,55.506,0,0,1,90.81,67.4c2.3,6.572,2.962,12.747.953,16.227a15.826,15.826,0,0,1-5.951,5.618c-4.906,2.832-11.583,4.245-18.277,4.242s-13.369-1.422-18.271-4.252a15.813,15.813,0,0,1-5.944-5.608c-2.243-3.886-1.666-9.747.534-15.866A56.481,56.481,0,0,1,56.1,48.3c5.52,0,6.435-.027,23.277-.054ZM55.909,58.995a15.277,15.277,0,1,0,10.8-4.475A15.277,15.277,0,0,0,55.909,58.995ZM78.72,42.619H56.127a1.713,1.713,0,1,0,0,3.427H78.72a1.713,1.713,0,1,0,0-3.427Zm-2.8,17.974a13.018,13.018,0,1,1-9.205-3.813A13.018,13.018,0,0,1,75.916,60.592Zm-7.35,1.836a5.223,5.223,0,0,0-.726-.209V61.195a1.13,1.13,0,1,0-2.259,0V62.22a5.229,5.229,0,0,0-.726.209A4.164,4.164,0,0,0,61.993,66.5c0,3.417,2.235,3.9,4.473,4.393,1.351.295,2.7.59,2.7,2.207a2,2,0,0,1-1.379,1.95,3.233,3.233,0,0,1-2.159,0,2,2,0,0,1-1.379-1.95,1.13,1.13,0,0,0-2.259,0,4.164,4.164,0,0,0,2.862,4.068,5.23,5.23,0,0,0,.726.209V78.4a1.13,1.13,0,0,0,2.259,0V77.374a5.224,5.224,0,0,0,.726-.209A4.164,4.164,0,0,0,71.428,73.1c0-3.434-2.244-3.924-4.486-4.413C65.6,68.39,64.252,68.1,64.252,66.5a2,2,0,0,1,1.379-1.95,3.236,3.236,0,0,1,2.159,0,2,2,0,0,1,1.379,1.95,1.129,1.129,0,0,0,2.259,0,4.162,4.162,0,0,0-2.861-4.067Z" transform="translate(0 0)" fill-rule="evenodd" fill="url(#linear-gradient3)" />
                            </g>
                        </svg>
                    </div>
                    <div class="why-dmn-cnt">
                        Competitive rates with No Hidden Fees
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="why-dmn-box">
                    <div class="why-dmn-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 70 70">
                            <g id="Group_169735" data-name="Group 169735" transform="translate(-1.998 -1.998)">
                                <path id="Path_243717" data-name="Path 243717" d="M44.234,4.045,45.406,13.7H28.591l1.17-9.652a2.029,2.029,0,0,1,1.8-1.774,54.157,54.157,0,0,1,10.864,0A2.027,2.027,0,0,1,44.234,4.045ZM29.761,69.951,28.591,60.3H45.406l-1.17,9.652a2.027,2.027,0,0,1-1.8,1.774,54.158,54.158,0,0,1-10.864,0,2.027,2.027,0,0,1-1.8-1.774ZM18.813,8.581l7.654,6L14.577,26.466l-6-7.653A2.027,2.027,0,0,1,8.6,16.283,54.158,54.158,0,0,1,16.284,8.6a2.027,2.027,0,0,1,2.53-.022ZM55.182,65.417l-7.653-6,11.89-11.891,6,7.654a2.027,2.027,0,0,1-.022,2.531,54.158,54.158,0,0,1-7.682,7.681,2.027,2.027,0,0,1-2.531.022ZM4.045,29.762,13.7,28.591V45.407L4.045,44.235a2.027,2.027,0,0,1-1.774-1.8,54.157,54.157,0,0,1,0-10.864,2.027,2.027,0,0,1,1.774-1.8ZM69.951,44.235,60.3,45.407V28.591l9.652,1.171a2.028,2.028,0,0,1,1.774,1.8,54.144,54.144,0,0,1,0,10.864A2.027,2.027,0,0,1,69.951,44.235ZM8.58,55.183l6-7.654L26.467,59.42l-7.654,6a2.027,2.027,0,0,1-2.531-.022A54.157,54.157,0,0,1,8.6,57.713a2.027,2.027,0,0,1-.022-2.53ZM65.417,18.815l-6,7.654L47.531,14.578l7.653-6a2.027,2.027,0,0,1,2.531.022,54.157,54.157,0,0,1,7.681,7.682A2.025,2.025,0,0,1,65.417,18.815Z" transform="translate(0 0)" fill="#5cbeff" />
                                <circle id="Ellipse_494" data-name="Ellipse 494" cx="27.644" cy="27.644" r="27.644" transform="translate(9.354 9.354)" fill="#5cbeff" />
                                <circle id="Ellipse_495" data-name="Ellipse 495" cx="18.768" cy="18.768" r="18.768" transform="translate(18.231 18.231)" fill="#079cff" />
                                <circle id="Ellipse_496" data-name="Ellipse 496" cx="13.648" cy="13.648" r="13.648" transform="translate(23.35 23.35)" fill="#fff" />
                                <path id="Path_243718" data-name="Path 243718" d="M27.455,32.969a2.131,2.131,0,0,1,3.012,0l2.577,2.577,5.832-5.829a2.131,2.131,0,0,1,3.012,3.012L34.55,40.064a2.13,2.13,0,0,1-3.012,0l-4.083-4.083a2.129,2.129,0,0,1,0-3.012Z" transform="translate(2.327 2.542)" fill="#435e88" />
                            </g>
                        </svg>
                    </div>
                    <div class="why-dmn-cnt">
                        Instant Setup and Easy Controls
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="why-dmn-box">
                    <div class="why-dmn-img">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Group_169736" data-name="Group 169736" width="69.611" height="70" viewBox="0 0 69.611 70">
                            <path id="Path_243719" data-name="Path 243719" d="M69.611,6.118A6.118,6.118,0,0,0,63.493,0H6.118A6.118,6.118,0,0,0,0,6.118V18.354l1.36,1.36H68.251l1.36-1.36Z" fill="#0052c2" />
                            <path id="Path_243720" data-name="Path 243720" d="M290.805,6.118V18.354l-1.36,1.36H256V0h28.687A6.119,6.119,0,0,1,290.805,6.118Z" transform="translate(-221.195)" fill="#003481" />
                            <path id="Path_243721" data-name="Path 243721" d="M345.276,60H333.039a2.039,2.039,0,1,0,0,4.079h12.236a2.039,2.039,0,1,0,0-4.079Z" transform="translate(-285.998 -51.842)" fill="#0052c2" />
                            <ellipse id="Ellipse_497" data-name="Ellipse 497" cx="2.2" cy="1.76" rx="2.2" ry="1.76" transform="translate(24.247 8.409)" fill="#f03800" />
                            <ellipse id="Ellipse_498" data-name="Ellipse 498" cx="2.2" cy="1.76" rx="2.2" ry="1.76" transform="translate(16.328 8.409)" fill="#fdbf00" />
                            <ellipse id="Ellipse_499" data-name="Ellipse 499" cx="2.2" cy="1.76" rx="2.2" ry="1.76" transform="translate(8.409 8.409)" fill="#37d742" />
                            <path id="Path_243722" data-name="Path 243722" d="M0,135v41.059a6.125,6.125,0,0,0,6.118,6.118H63.493a6.125,6.125,0,0,0,6.118-6.118V135Z" transform="translate(0 -116.646)" fill="#e0f4ff" />
                            <path id="Path_243723" data-name="Path 243723" d="M290.805,135v41.059a6.126,6.126,0,0,1-6.118,6.118H256V135Z" transform="translate(-221.195 -116.646)" fill="#b8e0f5" />
                            <path id="Path_243724" data-name="Path 243724" d="M75.767,180.056a2.039,2.039,0,0,0-2.473,1.484l-.921,3.685-1.522-2.282a2.041,2.041,0,0,0-3.394,0l-1.522,2.282-.921-3.685a2.039,2.039,0,0,0-3.957.989l2.039,8.158a2.039,2.039,0,0,0,3.675.637l2.382-3.573,2.382,3.573a2.039,2.039,0,0,0,3.675-.637l2.039-8.158A2.039,2.039,0,0,0,75.767,180.056Zm18.354,0a2.039,2.039,0,0,0-2.473,1.484l-.921,3.685-1.522-2.282a2.041,2.041,0,0,0-3.394,0l-1.522,2.282-.921-3.685a2.039,2.039,0,0,0-3.957.989l2.039,8.158a2.039,2.039,0,0,0,3.675.637l2.382-3.573,2.382,3.573a2.039,2.039,0,0,0,3.675-.637l2.039-8.158A2.039,2.039,0,0,0,94.122,180.056Z" transform="translate(-52.704 -155.523)" fill="#00b8f0" />
                            <path id="Path_243725" data-name="Path 243725" d="M264.1,182.529l-2.039,8.158a2.039,2.039,0,0,1-3.675.636L256,187.75v-5.714a2.022,2.022,0,0,1,1.7.907l1.521,2.283.922-3.686a2.039,2.039,0,1,1,3.956.99Zm16.871-2.473a2.039,2.039,0,0,0-2.473,1.484l-.921,3.685-1.521-2.282a2.04,2.04,0,0,0-3.394,0l-1.522,2.282-.921-3.685a2.039,2.039,0,0,0-3.957.989l2.039,8.158a2.039,2.039,0,0,0,3.675.637l2.382-3.573,2.382,3.573a2.039,2.039,0,0,0,3.675-.636l2.039-8.158A2.039,2.039,0,0,0,280.967,180.056Z" transform="translate(-221.195 -155.523)" fill="#0097f0" />
                            <ellipse id="Ellipse_500" data-name="Ellipse 500" cx="14.078" cy="14.518" rx="14.078" ry="14.518" transform="translate(20.728 40.964)" fill="#37d742" />
                            <path id="Path_243726" data-name="Path 243726" d="M270.276,316.276A14.291,14.291,0,0,1,256,330.551V302A14.291,14.291,0,0,1,270.276,316.276Z" transform="translate(-221.195 -260.941)" fill="#16a659" />
                            <path id="Path_243727" data-name="Path 243727" d="M217.406,377.6a2.04,2.04,0,0,0-2.884,0l-5.084,5.084-1.957-1.957a2.039,2.039,0,0,0-2.884,2.884l3.4,3.4a2.039,2.039,0,0,0,2.884,0l6.526-6.526a2.039,2.039,0,0,0,0-2.884Z" transform="translate(-176.264 -325.745)" fill="#e0f4ff" />
                            <path id="Path_243728" data-name="Path 243728" d="M262.337,380.484,256,386.821v-5.769l3.452-3.453a2.04,2.04,0,1,1,2.885,2.885Z" transform="translate(-221.195 -325.746)" fill="#b8e0f5" />
                        </svg>
                    </div>
                    <div class="why-dmn-cnt">
                        Multi-Year Registration
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="why-dmn-box">
                    <div class="why-dmn-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="69" height="69" viewBox="0 0 69 69">
                            <g id="Group_169738" data-name="Group 169738" transform="translate(-2 -2)">
                                <circle id="Ellipse_501" data-name="Ellipse 501" cx="34.5" cy="34.5" r="34.5" transform="translate(2 2)" fill="#0588e2" />
                                <path id="Path_243729" data-name="Path 243729" d="M19.832,54.174H48.516A34.565,34.565,0,0,0,62.348,42.657V33.826A7.835,7.835,0,0,0,54.522,26h-40.7A7.835,7.835,0,0,0,6,33.826v8.831A34.554,34.554,0,0,0,19.832,54.174Z" transform="translate(2.261 13.566)" fill="#0075d3" />
                                <circle id="Ellipse_502" data-name="Ellipse 502" cx="29.5" cy="29.5" r="29.5" transform="translate(7 7)" fill="#eff3f9" />
                                <path id="Path_243730" data-name="Path 243730" d="M34.739,9.7A29.723,29.723,0,0,1,64.36,37.087c.061-.776.119-1.556.119-2.348A29.739,29.739,0,0,0,5,34.739c0,.792.058,1.571.119,2.348A29.723,29.723,0,0,1,34.739,9.7ZM14.391,37.87a7.817,7.817,0,0,0-7.709,6.659,29.7,29.7,0,0,0,56.114,0,7.816,7.816,0,0,0-7.709-6.659Z" transform="translate(1.696 1.696)" fill="#cfe0f3" />
                                <path id="Path_243731" data-name="Path 243731" d="M24.565,31.783A1.565,1.565,0,0,1,23,30.218V14.565a1.565,1.565,0,1,1,3.13,0V30.218A1.565,1.565,0,0,1,24.565,31.783Z" transform="translate(11.87 6.218)" fill="#0d3b8d" />
                                <path id="Path_243732" data-name="Path 243732" d="M29.087,26.13H16.565a1.565,1.565,0,0,1,0-3.13H29.087a1.565,1.565,0,1,1,0,3.13Z" transform="translate(7.348 11.87)" fill="#0d3b8d" />
                                <circle id="Ellipse_503" data-name="Ellipse 503" cx="3.5" cy="3.5" r="3.5" transform="translate(33 33)" fill="#0ca0f2" />
                                <g id="Group_169737" data-name="Group 169737" transform="translate(9.826 9.826)">
                                    <path id="Path_243733" data-name="Path 243733" d="M33.609,13.261A1.565,1.565,0,0,1,32.044,11.7V8.565a1.565,1.565,0,0,1,3.13,0V11.7A1.565,1.565,0,0,1,33.609,13.261ZM22.652,14.632a1.565,1.565,0,0,1-2.138-.573L19.732,12.7a1.565,1.565,0,1,1,2.711-1.565l.783,1.356A1.565,1.565,0,0,1,22.652,14.632Zm-8.02,8.02a1.565,1.565,0,0,1-2.138.573l-1.355-.783A1.565,1.565,0,1,1,12.7,19.732l1.355.783a1.565,1.565,0,0,1,.573,2.138Zm29.934-8.02a1.565,1.565,0,0,0,2.138-.573l.783-1.355a1.565,1.565,0,1,0-2.711-1.565l-.783,1.356A1.565,1.565,0,0,0,44.566,14.632Zm8.02,8.02a1.565,1.565,0,0,0,2.138.573l1.355-.783a1.565,1.565,0,1,0-1.565-2.711l-1.355.783a1.565,1.565,0,0,0-.573,2.138Zm1.371,10.957a1.565,1.565,0,0,1,1.565-1.565h3.13a1.565,1.565,0,0,1,0,3.13h-3.13A1.565,1.565,0,0,1,53.957,33.609ZM7,33.609a1.565,1.565,0,0,1,1.565-1.565H11.7a1.565,1.565,0,1,1,0,3.13H8.565A1.565,1.565,0,0,1,7,33.609Z" transform="translate(-7 -7)" fill="#7eafd0" />
                                </g>
                                <rect id="Rectangle_23754" data-name="Rectangle 23754" width="57" height="28" rx="5" transform="translate(8 43)" fill="#0ca0f2" />
                                <rect id="Rectangle_23755" data-name="Rectangle 23755" width="50" height="22" rx="3" transform="translate(11 46)" fill="#eff3f9" />
                                <path id="Path_243734" data-name="Path 243734" d="M16.261,32.565h-4.7a1.565,1.565,0,1,0,0,3.13h4.7v3.13H13.13A3.134,3.134,0,0,0,10,41.956v3.13a3.134,3.134,0,0,0,3.13,3.13h4.7a1.565,1.565,0,1,0,0-3.13h-4.7v-3.13h3.13a3.134,3.134,0,0,0,3.13-3.13V35.7A3.134,3.134,0,0,0,16.261,32.565Zm14.087,0a1.565,1.565,0,0,0-1.565,1.565v4.7h-3.13v-4.7a1.565,1.565,0,0,0-3.13,0v4.7a3.134,3.134,0,0,0,3.13,3.13h3.13v4.7a1.565,1.565,0,1,0,3.13,0V34.13A1.565,1.565,0,0,0,30.348,32.565Zm9.7-1.534A1.565,1.565,0,0,0,38.2,32.258l-3.13,15.652a1.564,1.564,0,1,0,3.068.615l3.13-15.652a1.565,1.565,0,0,0-1.227-1.842ZM50,32.565H46a1.565,1.565,0,0,0,0,3.13h4L46.1,46.1a1.567,1.567,0,0,0,2.932,1.1l3.9-10.407A3.132,3.132,0,0,0,50,32.567Z" transform="translate(4.522 16.392)" fill="#0d3b8d" />
                            </g>
                        </svg>
                    </div>
                    <div class="why-dmn-cnt">
                        24/7 Expert Support
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="domain-reg-mmbr-main head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">Domain Registry Memberships</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="dmn-reg-mmbr-box">
                    <div class="dmn-reg-mmbr-box-carousel">
                        <div class="dmn-reg-mmbr-box-items">
                            <img src="{{url('assets/images/domain_registration/verisign-icon.webp')}}" alt="verisign-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/uniregistry-icon.webp')}}" alt="uniregistry-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/donuts-icon.webp')}}" alt="donuts-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/public-interest-registry-icon.webp')}}" alt="public-interest-registry-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/neustar-icon.webp')}}" alt="neustar-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/famous-four-india-icon.webp')}}" alt="famous-four-india-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/centralnic-icon.webp')}}" alt="centralnic-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/com-icon.webp')}}" alt="com-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/global-icon.webp')}}" alt="global-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/ca-icon.webp')}}" alt="ca-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/verisign-icon.webp')}}" alt="verisign-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/uniregistry-icon.webp')}}" alt="uniregistry-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/donuts-icon.webp')}}" alt="donuts-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/public-interest-registry-icon.webp')}}" alt="public-interest-registry-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/neustar-icon.webp')}}" alt="neustar-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/famous-four-india-icon.webp')}}" alt="famous-four-india-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/centralnic-icon.webp')}}" alt="centralnic-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/com-icon.webp')}}" alt="com-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/global-icon.webp')}}" alt="global-icon" loading="lazy">
                            <img src="{{url('assets/images/domain_registration/ca-icon.webp')}}" alt="ca-icon" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="add-service-main head-tb-p-40">
    <div class="container">
        <div class="section-heading">
            <h2 class="text_head text-center">
                We Don’t Just Sell Cheap Domains! <br>
                Check Out Our Smart Services That Help You
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="add-service-box-main">
                    <div class="add-services-box box-1">
                        <a class="add-services-img" href="{{url('hosting/website-builder')}}"></a>
                        <div class="add-service-box-cnt">
                            <p>Website Builder</pack>
                        </div>
                        <div class="add-service-box-title">
                            <p>Website Builder</pack>
                        </div>
                    </div>
                    <div class="add-services-box box-2 active">
                        <a class="add-services-img" href="{{url('/web-hosting')}}"></a>
                        <div class="add-service-box-cnt">
                            <p>Shared Hosting</p>
                        </div>
                        <div class="add-service-box-title">
                            <p>Shared Hosting</p>
                        </div>
                    </div>
                    <div class="add-services-box box-3">
                        <a class="add-services-img" href="{{url('servers/vps-hosting')}}"></a>
                        <div class="add-service-box-cnt">
                            <p>VPS Hosting</p>
                        </div>
                        <div class="add-service-box-title">
                            <p>VPS Hosting</p>
                        </div>
                    </div>
                    <div class="add-services-box box-4">
                        <a class="add-services-img" href="{{url('servers/dedicated-servers')}}"></a>
                        <div class="add-service-box-cnt">
                            <p>Dedicated Server</p>
                        </div>
                        <div class="add-service-box-title">
                            <p>Dedicated Server</p>
                        </div>
                    </div>
                    <div class="add-services-box box-5">
                        <a class="add-services-img" href="{{url('/ssl-certificates')}}"></a>
                        <div class="add-service-box-cnt">
                            <p>SSL Certificate</p>
                        </div>
                        <div class="add-service-box-title">
                            <p>SSL Certificate</p>
                        </div>
                    </div>
                    <div class="add-services-box box-6">
                        <a class="add-services-img" href="{{url('email/google-workspace-india')}}"></a>
                        <div class="add-service-box-cnt">
                            <p>Google Workspace</p>
                        </div>
                        <div class="add-service-box-title">
                            <p>Google Workspace</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.support_section_home')
@include('template.'.$themeversion.'.testimonial_section_home')
@include('template.'.$themeversion.'.faq-section')
<script>
class TypeWriter {
    constructor(txtElement, words, wait = 3000) {
        this.txtElement = txtElement;
        this.words = words;
        this.txt = '';
        this.wordIndex = 0;
        this.wait = parseInt(wait, 8);
        this.type();
        this.isDeleting = false;
    }

    type() {
        // Current index of word
        const current = this.wordIndex % this.words.length;
        // Get full text of current word
        const fullTxt = this.words[current];

        // Check if deleting
        if (this.isDeleting) {
            // Remove char
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            // Add char
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        // Insert txt into element
        this.txtElement.innerHTML = `<span class="txt">${this.txt}</span>`;

        // Initial Type Speed
        let typeSpeed = 100;

        if (this.isDeleting) {
            typeSpeed /= 2;
        }

        // If word is complete
        if (!this.isDeleting && this.txt === fullTxt) {
            // Make pause at end
            typeSpeed = this.wait;
            // Set delete to true
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            // Move to next word
            this.wordIndex++;
            // Pause before start typing
            typeSpeed = 300;
        }

        setTimeout(() => this.type(), typeSpeed);
    }
}

// Init On DOM Load
document.addEventListener('DOMContentLoaded', init);

// Init App
function init() {
    const txtElement = document.querySelector('.txt-type');
    const words = JSON.parse(txtElement.getAttribute('data-words'));
    const wait = txtElement.getAttribute('data-wait');
    // Init TypeWriter
    new TypeWriter(txtElement, words, wait);
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.querySelector('.dmn-prvcy-data-btn input[type="checkbox"]');
    const privacyOn = document.getElementById('privacy-on');
    const privacyOf = document.getElementById('privacy-of');

    checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            privacyOn.style.display = 'block';
            privacyOf.style.display = 'none';
        } else {
            privacyOn.style.display = 'none';
            privacyOf.style.display = 'block';
        }
    });

    // Initialize visibility
    if (checkbox.checked) {
        privacyOn.style.display = 'block';
        privacyOf.style.display = 'none';
    } else {
        privacyOn.style.display = 'none';
        privacyOf.style.display = 'block';
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const boxes = document.querySelectorAll('.add-services-box');

    boxes.forEach(box => {
        box.addEventListener('mouseenter', function() {
            boxes.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
@endsection