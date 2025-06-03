@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
@if($tld->varTitle == 'com')
    <div class="banner-inner payment-banner  domain_banner_content" style="background-image: {{url('assets/images/banner_bg.jpg')}};)">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="banner-content domain-content">
                        <h2 style="font-size=">Grab a Globally Acclaimed</h2>
                        <h3>.COM extension at a killer price.</h3>

                        <h1>Book .COM at <i class="fa fa-inr domain_rupeesicon" style="font-size: 40px;"></i> {{Config::get('Constant.TLD_COM_PRICE_INR')}} <br>for 1st Year</h1>

                        <p>Renews at  {!! Config::get('Constant.sys_currency_symbol') !!} {!! Config::get('Constant.MEGAMENU_RENEW_PRICE_INR') !!}/Yr</p>
                        <p>on purchase of 2 years and more</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="domain_images">
                        <img style="max-width: 100%;" alt=".com" src="../assets/images/com-logo1437112107.webp">
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="banner-inner payment-banner" style="background-image: {{url('assets/images/banner_bg.jpg')}};)">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-title aos-init" data-aos="fade-up" data-aos-delay="100">
                    .{{$tld->varTitle}} Domain Name
                </h1>
                <span class="banner-subtitle aos-init" data-aos="fade-up" data-aos-delay="200">

                </span>
            </div>
        </div>
    </div>
@endif
<div class="inner_container tld-content">
    <div class="container">
        <div class="row flex-lg-row-reverse">
            <div class="col-lg-9">
                <div class="registration aos-init" data-aos="fade-left" data-aos-easing="ease-out-back">
                    <div class="title">
                        <h3><span class="tld-sprite domain-reg"></span>Domain Registration</h3>
                    </div>
                    <div class="registration-content content-box">
                        <div class="inner-title-common">
                            <h4>
                                <span class="tld-sprite domain-reg2"></span>
                                .{{$tld->varTitle}}
                                <span class="domain-name">Domain Registration</span>
                            </h4>
                        </div>
                        <p class="instruction">To register your {{$tld->varTitle}} domain name, enter your domain into the box below, click the "Register" button and then follow the on screen prompts</p>
                        <form method="post" action="{{url('domain-checker')}}"  onsubmit="javascript: return joindomain();"> 
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="hide_tlddata" value="{{$Tldarray}}" />
                             <input type="hidden" name="domain_search" id="domain_search" value="y" />
                            <div class="search-domain-main">
                                <span class="url-starting">www</span>
                                <input type="text" id="domainname" name="domainname" value="" />
                                <span class="url-ending">.{{$tld->varTitle}}</span>

                            </div>
                            <span id="err_html" class="error" style=" display: none;"></span>
                            <div class="pre-register">
                                <!--<a class="pre-register-btn" href="javascript:void(0)" title="Pre-Register">Pre-Register</a>-->
                                <button type="submit" id="pre-register_id" class="btn pre-register-btn" title="Register" >Register</button>
                            </div>

                        </form>
                        <div class="text-content">
                            <span class="info-tip">?</span>
                            <p class="info-text">If you require assistance with {{$tld->varTitle}} domain registration, please contact our helpdesk via <a href="mailto:{{$EmailId}}" title="{{$EmailId}}">email</a> or <a href="tel:{{$PhoneNumner}}" title="telephone">telephone.</a>
                            </p>
                        </div>
                        <div class="more-domains">
                            <a href="{{url('/tld')}}" title="More Domains Available" target="_blank">More Domains Available</a>
                        </div>
                    </div>
                </div>
                <div class="registration_price aos-init mb-20 d-sm-none d-block" data-aos="fade-right" data-aos-easing="ease-out-back">
                    <h3 class="text-center">Registration Price</h3>
                    <div class="info">
                        <div class="selected-domain">
                            <p class="sd-name">.{{$tld->varTitle}}</p>
                        </div>
                        <div class="price">
                            <i class="rupees_ico">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
                            @if($tld->varTitle == 'com')
                                    <span class="num">{{ Config::get('Constant.TLD_COM_PRICE_INR') }}</span>
                                @else
                                    <span class="num">{{str_replace('.00','',$Price['INR'])}}</span>
                                @endif
                            {{-- <span class="num">{{str_replace('.00','',$Price['INR'])}}</span> --}}
                            <span class="year">/year</span>
                        </div>
                        {{-- <a href="{{url('/domain')}}" class="border_btn" title="Start Your Site Now!">Start Your Site Now!</a> --}}
                        <button class="border_btn" onclick="start_site();" title="Start Your Site Now!">Start Your Site Now!</button>
                    </div>
                </div>
                <div class="domain-info-section content-box aos-init" data-aos="fade-left" data-aos-easing="ease-out-back">
                    {!! $tld->txtDescription !!}
                    <div class="bulk-domain-section">
                        <div class="inner-title-common">
                            <h4>
                                <span class="tld-sprite domain-reg4"></span>
                                .{{$tld->varTitle}}
                                <span class="domain-name">Bulk Domain Registration</span>
                            </h4>
                        </div>
                        <p class="instruction">
                            Register your {{$tld->varTitle}} domain names in Bulk, simply enter your names below (one domain per line).
                        </p>
                        <form method="post"  action="{{url('domain/bulk-domain-search')}}"  onsubmit="javascript: return joinbulkdomain();"> 
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                            <div class="search-bulk-domain-main">
                                <textarea rows="4"  name="bulkdomains" id="bulkdomains" cols="50" placeholder="yourdomain1.{{$tld->varTitle}} yourdomain2.{{$tld->varTitle}}"></textarea>
                            </div>
                            <span id="bulk_err_html" class="error" style=" display: none;"></span>
                            <div class="pre-register">
                                <!--<a class="pre-register-btn" href="javascript:void(0)" title="Pre-Register">Register</a>-->
                                <button type="submit" class="pre-register-btn" />Register</button>
                            </div>

                        </form>
                    </div>
                    @if(!empty($tld->txtShortDescription))
                    <div class="gtld-info">
                        <h4 class="common-title2">gTLD Background Information</h4>
                        <hr class="common-hr"/>
                        <p class="instruction">
                            {{nl2br($tld->txtShortDescription)}}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3">
                <div class="left_panel d-sm-block d-none">
                    <div class="registration_price aos-init mb-20" data-aos="fade-right" data-aos-easing="ease-out-back">
                        <h3 class="text-center">Registration Price</h3>
                        <div class="info">
                            <div class="selected-domain">
                                <p class="sd-name">.{{$tld->varTitle}}</p>
                            </div>
                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                            
                                <div class="price">
                                    <i class="rupees_ico">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
                                    @if($tld->varTitle == 'com')
                                        <span class="num">{{ Config::get('Constant.TLD_COM_PRICE_INR') }}</span>
                                    @else
                                        <span class="num">{{str_replace('.00','',$Price['INR'])}}</span>
                                    @endif
                                    {{-- <span class="num">{{str_replace('.00','',$Price['INR'])}}</span> --}}
                                    <span class="year">/year</span>
                                </div>
                            
                            
                            @php } else { @endphp 
                            <div class="price">
                                <i class="rupees_ico">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
                                @if($tld->varTitle == 'com')
                                        <span class="num">{{ Config::get('Constant.TLD_COM_PRICE_INR') }}</span>
                                    @else
                                        <span class="num">{{str_replace('.00','',$Price['INR'])}}</span>
                                    @endif
                                {{-- <span class="num">{{str_replace('.00','',$Price['USD'])}}</span> --}}
                                <span class="year">/year</span>
                            </div>
                            @php } @endphp 
                            {{-- <a href="{{url('/domain')}}" class="border_btn" title="Start Your Site Now!">Start Your Site Now!</a> --}}
                            <button class="border_btn" onclick="start_site();" title="Start Your Site Now!">Start Your Site Now!</button>
                        </div>
                    </div>
                    <div class="extension_part aos-init" data-aos="fade-right" data-aos-easing="ease-out-back">
                        <h3>More TLDS</h3>
                        <div class="extension_list mCustomScrollbar cms">
                            <ul>
                                @foreach($FeaturedDetail as $Featured)
                                @if($Featured->varTitle == $tld->varTitle)
                                    @php $featuared_active = 'featuared_active'; @endphp
                                @else
                                     @php $featuared_active = ''; @endphp
                                @endif
                                <li>
                                    <a href="{{url('/domain')}}/{{$Featured->varAlias}}" class="{{$featuared_active}}" title=".{{$Featured->varTitle}}">.{{$Featured->varTitle}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="all_domain_div aos-init" data-aos="fade-right" data-aos-easing="ease-out-back">
                        <h3>All Domains come with...</h3>
                        <ul class="domain_list">
                            <li><i class="domain_sprite domainforward_icon"></i>Domain Forwarding</li>
                            <li><i class="domain_sprite urlmasking_icon"></i>URL Masking</li>
                            <li><i class="domain_sprite dns_icon"></i>DNS Management</li>
                            <li><i class="domain_sprite protection_icon"></i>Domain Theft Protection</li>
                            <li><i class="domain_sprite bulk_icon"></i>Bulk Tools</li>
                            <li><i class="domain_sprite controlpanel_icon"></i>Easy-to-use Control Panel</li>
                            <li><i class="domain_sprite support_icon"></i>24/7 Local Support</li>
                        </ul>
                    </div>
                    <div class="payment-method-bar aos-init" data-aos="fade-right" data-aos-easing="ease-out-back">
                        <h3>Payment Methods</h3>
                        <div class="pm-listmain">
                            <ul class="payment-icons-list">
                                <li class="payment-icons pay-icon1 aos-init" title="Visa" data-aos="zoom-in" data-aos-delay="100"></li>
                                <li class="payment-icons pay-icon2 aos-init" title="Master Card" data-aos="zoom-in" data-aos-delay="300"></li>
                                <li class="payment-icons pay-icon3 aos-init" title="Maestro" data-aos="zoom-in" data-aos-delay="500"></li>
                                <li class="payment-icons pay-icon4 aos-init" title="American Express" data-aos="zoom-in" data-aos-delay="700"></li>
                                <li class="payment-icons pay-icon5 aos-init" title="Diners Club International" data-aos="zoom-in" data-aos-delay="900"></li>
                                <li class="payment-icons pay-icon6 aos-init" title="Paypal" data-aos="zoom-in" data-aos-delay="1100"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var tld_name = '<?= $tld->varTitle ?>';
    function joindomain()
    {
        var domainname = document.getElementById('domainname').value;
        var domain_check2 = domainchecker2(domainname);
        var tld = domainname.split(".");

        if (domainname == "")
        {
            $("#err_html").html("Enter Your Desired Domain Name Here.");
            $(".error").show();
            return false;
        }

        else if (domainname.length > 60) {
            $("#err_html").html("Please enter no more than 60 characters.");
            $(".error").show();
            return false;
        }

        else if (tld[1]) {
            $("#err_html").html("Please remove domain extension.");
            $(".error").show();
            return false;
        }
        else if (domain_check2 == false) {
            $("#err_html").html("Please remove illegal characters from the domain.");
            $(".error").show();
            return false;
        }
        document.getElementById('domainname').value = trim(domainname) + "." + tld_name;

    }

    function joinbulkdomain()
    {

        var domainstr = '';
        var domainname = document.getElementById('bulkdomains').value;
        var rep_space = domainname.replace(/\s/g, "\n");
        var rep_comma = rep_space.replace(/,/g, "\n");
        var domainarray = rep_comma.split("\n");

        if (domainname == "")
        {
            $("#bulk_err_html").html("Please enter domain(s) name.");
            $("#bulk_err_html").show();
            return false;
        }
        
        //  if (domainname.length > 60) {
        //     $("#bulk_err_html").html("Please enter no more than 60 characters.");
        //      $("#bulk_err_html").show();
        //     return false;
        // }
        
       // console.log(domainarray);
        for (var j = 0; j < domainarray.length; j++)
        {
            if (domainarray[j].length > 60) {
            $("#bulk_err_html").html("Please enter no more than 60 characters.");
             $("#bulk_err_html").show();
            return false;
            }
            if (trim(domainarray[j]) != '')
            {
                var _tld = domainarray[j].split("."); 
                console.log("Before: " +  domainarray[j]);
                if(_tld[1] === undefined){ domainarray[j] = domainarray[j]+"." + "{{$tld->varTitle}}"}
                console.log("After: " +  domainarray[j]);    
                var domain_check = domainchecker(domainarray[j]);
                var tld = domainarray[j].split("."); 

                if (!tld[1]) {
                    $("#bulk_err_html").html("please enter proper domain with extension.");
                    $("#bulk_err_html").show();
                    return false;
                }
                else if (domain_check == false) {
                    $("#bulk_err_html").html("please enter proper domain.");
                    $("#bulk_err_html").show();
                    return false;
                }
                else {
                    domainstr = domainstr + domainarray[j] + "\n";
                }
            }
        }
        document.getElementById('bulkdomains').value = trim(domainstr);
    }

    function domainchecker2(value) {
        return /^[a-zA-Z0-9- ]*$/.test(value);
    }

    function domainchecker(value) {
        return  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) || /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/.test(value);
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
    function start_site() {
        document.getElementById("pre-register_id").click();
    }
</script>

@endsection