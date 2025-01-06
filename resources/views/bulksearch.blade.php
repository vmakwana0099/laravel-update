@extends('layouts.app')
@section('content')
@php
$currency = Config::get('Constant.sys_currency');
$currency_Code = Config::get('Constant.sys_currency_code');
$currency_symbol = Config::get('Constant.sys_currency_symbol');
@endphp
@if(!empty($ProductBanner) && count((array)$ProductBanner) >0)
<div class="vps_main bulksearch-main">
    <div class="banner-inner bulksearch-banner" style="background-image:url('{!! App\Helpers\resize_image::resize($ProductBanner->fkIntImgId,1920,494) !!}')">
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
</div>
@endif
<?php
if (isset($_REQUEST["bulkdomains"])) {
    $Domain_array2 = explode("\n", $_REQUEST["bulkdomains"]);
    $trimmed_array2 = array_map('trim', $Domain_array2);
    $AllTlds = '"' . implode('","', $trimmed_array2) . '"';
}
?>
<div class="bulksearch_section head-tb-p-40">
    <div class="container">
        <form method="post"  class="row" onsubmit="javascript: return joindomain();"> 
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" id="bulk_search" name="bulk_search" value="y"/>
            <div class="col-md-12">
                <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                    <textarea class="form-control textarea-height" id="bulkdomains" name="bulkdomains" placeholder="Each name must be on a separate line.
Example:
example.com
example.in
                    " ><?php echo (isset($_REQUEST["bulkdomains"]) ? $_REQUEST["bulkdomains"] : '') ?></textarea>
                </div>
                <span id="err_html" class="error" style="display: none;"> </span>
                <div class="tld_radio" data-aos="fade-up" data-aos-delay="300">
                    <div class="tld_radio" data-aos="fade-up" data-aos-delay="300">
                        <div class="radio_label">
                            <input type="radio" id="f-option1" name="selector" checked="checked" value="d" onclick="togglediv('d');">
                            <label for="f-option1" title="I entered complete domain names with TLDs.">I entered complete domain names with TLDs.</label>
                            <div class="check"></div>
                        </div>
                        <div class="radio_label">
                            <input type="radio" id="f-option2"  value="t" name="selector" onclick="togglediv('t');">
                            <label for="f-option2" title="Choose TLDs to search for">Choose TLDs to search for</label>
                            <div class="check"></div>
                        </div>
                    </div>
                </div>

                <div class="" id="tld_search" style="display: none;">

                    <div class="checked_domain_list" style="display: none;">
                        <div class="tlds_show btn" id="checked_tlds" title="Hide Tlds" data-aos="fade-up" data-aos-delay="500">
                            <span>Hide Tlds</span><i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </div>
                        <div class="bulktage_list" data-aos="fade-up" data-aos-delay="700">
                            <!--<span class="tag">.in<i class="fa fa-times"></i></span>-->    

                        </div>
                    </div>

                    <div class="domain-landing-section bulksearch_tabing">
                        <div class="country-filter-main">
                            <div class="country-main">
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
                                            <a data-toggle="tab" href="#<?= str_replace(" ", "_", $key) ?>" class="{{$cat_display}}"><span>{{$key}}</span></a>
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
                                                            @foreach ($value as $tld)

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
                                                                        {{$country}} <input type="checkbox" name="c_tld[]" id="{!! str_replace('.', '_', $Tld_Main[0]) !!}" class="tld_checkbox" value="{{$Tld_Main[0]}}"> <span class="checkmark"></span>
                                                                    </label>
                                                                    <span class="domain-country ml-auto">.{{$Tld_Main[0]}}
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
                    <hr/>
                </div>
                <div class="">
                    <!--<a href="#" class="btn" title="Search Domain" data-aos="fade-up">Search Domain</a>-->
                    <button type="submit" class="btn bulkserachbtn" title="Search Domain" >Search Domain</button>
                </div>
    </div>
        </form>

        <div class="domain_search_result">

            <?php
            if (isset($_REQUEST["bulkdomains"])) {
                ?>
                <script type="text/javascript">
                    setTimeout(function() {
                        load_tlddata(0, 10);
                    }, 2000);

                </script>
              <div class="clearfix"><span id="domainvalidation" class="red"></span>

               <div class="d-flex d-sm-inline-flex float-end">
                    <button id="checkoutbutton" class="btn btn-secondary pull-right" title="CONTINUE TO CHECKOUT">CONTINUE TO CHECKOUT</button>
                </div>
              </div>

                <div class="domainlist-page">

                    <div class="domain_list_table aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">
                        <form id="suggestedDomainFrm" name="suggestedDomainFrm" action="javascript:void(0);">

                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                            <!--<input type="hidden" id="producttype" name="producttype[]" value="domain"/>-->

                            <table id="domain_table">
                                <thead id="thead">
                                    <tr>
                                        <th id="sort_domain">
                                            Domain<span class = "filter-arrow"><i class = "top-arrow" onclick="javascript:sort(true, 'sort_domain', 'domain_table');"></i><i class = "bottom-arrow" onclick="javascript:sort(false, 'sort_domain', 'domain_table');"></i></span>
                                        </th>
                                        <th id="sort_status">Status<span class = "filter-arrow"><i class = "top-arrow" onclick="javascript:sort(true, 'sort_status', 'domain_table');"></i><i class = "bottom-arrow" onclick="javascript:sort(false, 'sort_status', 'domain_table');"></i></span></th>
                                        <th class = "text-center" id="price_option">
                                            <select class = "selectpicker" onchange="getdomainpricing(this.value);">
                                                <?php
                                                for ($i = 1; $i <= 10; $i++) {
                                                    if ($i == 1) {
                                                        $Year = "Year";
                                                        $Yearval = 0;
                                                    } else {
                                                        $Year = "Years";
                                                        $Yearval = $i;
                                                    }
                                                    ?>
                                                    <option value="<?= $i ?>"> <?= $i . " " . $Year ?></option>
                                                <?php }
                                                ?>

                                            </select>
                                            <span class = "filter-arrow"><i class = "top-arrow" onclick="javascript:sort(true, 'price_option', 'domain_table');"></i><i class = "bottom-arrow" onclick="javascript:sort(false, 'price_option', 'domain_table');"></i></span>
                                        </th>

                                        <th class = "text-right">
                                            <a href = "javascript:;" class = "addall" title = "Add All +">Add All +</a>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody id="appenddata">


                                </tbody>
                            </table>

                        </form>
                    </div>

                </div>

            <?php } ?>
        </div>
    </div>
</div>
@if(isset($FeaturesData))
<div class="vps-features bulksearch_features">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <h2 class="features-title aos-init" data-aos="fade-up">All Domains come with</h2>
                <div class="features-start d-md-block d-none">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            
                            @foreach($FeaturesData as $Features)
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon">
                                        <i class="{{$Features->varIconClass}}"></i>
                                    </div>
                                    <h3 title="{{$Features->varTitle}}">{{$Features->varTitle}}</h3>
                                    <div class="content">{!! $Features->varShortDescription !!}</div>
                                    </div>
                                </div>
                            @endforeach
                            
                            </div>
                                    </div>
                </div> <!--features-start end -->
                <div class="features-start features-start-mob d-md-none d-block"> <!-- features-start-mob -->
                    <div class="owl-carousel owl-theme">	
                    				    
                    @foreach($FeaturesData as $Features)				    
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon">
                                        <i class="{{$Features->varIconClass}}"></i>
                                    </div>
                                    <h3 title="{{$Features->varTitle}}">{{$Features->varTitle}}</h3>
                                    <div class="content">{!! $Features->varShortDescription !!}</div>
                                    </div>
                                </div>

                        </div>
                         @endforeach
                        
                </div>
                </div><!-- features-start-mob  end-->
            </div> <!-- features-main end -->
        </div>
	</div>
</div>
@endif
<div class="common-div cms">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cms">
                <h3 class="common-title">So what are you waiting for?</h3>
                <p class="text-center">Search multiple domains and buy them in just a few clicks!</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')

    <div class="modal fade common-popup" id="commonPopup" role="dialog" tabindex='-1'>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-popup" data-dismiss="modal"></button>
                    <h2 class="modal-title">How Can We Help?</h2>
                </div>
                <div class="modal-body">
                    <div class="common-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="inquiry-form" action="{{url('inquirydata')}}" method="post" role="form" >
                                    <input type="hidden" name="dname" id="dname" value="" />
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                                    <div class="form-group">
                                        <label for="varName">NAME <span class="required">*</span></label>
                                        <input type="text" name="varName" id="varName" tabindex="1" class="form-control" placeholder="Please enter your name" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="varEmail">E-MAIL <span class="required">*</span></label>
                                        <input type="email" name="varEmail" id="varEmail" tabindex="2" class="form-control" placeholder="Please enter your email address">
                                    </div>
                                    <div class="form-group">
                                        <label for="varPhone">Phone <span class="required">*</span></label>
                                        <input type="number" name="varPhone" id="varPhone" tabindex="3" class="form-control" placeholder="Please enter your phone number" onkeypress="javascript: return KeycheckOnlyPhonenumber(event);">
                                    </div>
                                    <div class="form-group">
                                        <label for="varMessage">Message</label>
                                        <textarea class="form-control" id="varMessage" name="varMessage"  tabindex="5" placeholder="Please enter your message"></textarea>
                                    </div>
                                    <div class="col-12">
                                    	<div class="form-group text-center">        
                                    		By clicking "Submit", you agree to our <a target="_blank" title="Privacy Policy" href="{{url('privacy-policy')}}">Privacy Policy</a>.
                                    	</div>
                                    </div>
                                    <div class="form-group submit-btn-part">
                                        <input type="submit" name="submit" id="submit" tabindex="7" class="btn" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
         $("#checkoutbutton").click(function(){


            var domainlen=selectedDomainArr.length;

            if(domainlen!="0")
            {
                $("#domainvalidation").text("");
            window.location="{{url('/cart/signin')}}";return false;
            }
            else
            {
                $("#domainvalidation").text("Please select atleast one domain");
                 return false;   
            }
        });
    });
    var allTLDsPrice = [];
    var counter = 0;
    var remove_key = [];
    var tld_Array = [];
    var cart_count;
    var loaded_domain = 0;
    var limit_domain = 10;
    var active_req = false;
<?php
if (isset($_REQUEST["bulkdomains"])) {
    ?>
        var all_domain = new Array(<?= $AllTlds ?>);
    <?php
}
if (session()->has('cart')) {
    $cart_array = Session::get('cart');
    if(array_key_exists('userid',$cart_array))        { unset($cart_array['userid']); }
if(array_key_exists('paymentmethod',$cart_array)) { unset($cart_array['paymentmethod']); }
if(array_key_exists('recommndation',$cart_array)) { unset($cart_array['recommndation']); }            
if(array_key_exists('prmocode',$cart_array))      { unset($cart_array['prmocode']); }
if(array_key_exists('prmodiscount',$cart_array))  { unset($cart_array['prmodiscount']); }
if(array_key_exists('prmomessage',$cart_array))   { unset($cart_array['prmomessage']); }
    ?>
        cart_count = '<?= count($cart_array) ?>';
<?php } else { ?>
        cart_count = '0';
<?php } ?>
    var SITE_URL = {!! json_encode(url('/')) !!};
    Array.prototype.unique = function()
    {
        return this.reduce(function(previous, current, index, array)
        {
            previous[current.toString() + typeof (current)] = current;
            return array.length - 1 == index ? Object.keys(previous).reduce(function(prev, cur)
            {
                prev.push(previous[cur]);
                return prev;
            }, []) : previous;
        }, {});
    };

    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };
    function togglediv(type) {
        if (type == 'd') {
            $("#tld_search").hide();
            $("#f-option1").attr("checked", true);
            $("#f-option2").attr("checked", false);
        }
        else if (type == 't') {
            $("#tld_search").show();
            $("#f-option2").attr("checked", true);
            $("#f-option1").attr("checked", false);
        }
    }

    function load_tlddata(start, end) {

        loaded_domain = 0;
        // var dnamearray=[];
        // var dtldarray=[];

        $("#view_more").parent().remove();
        for (var i = start; i < end; i++) {
            if (i < all_domain.length) {
                console.log(all_domain + " " + i);
                var dname = all_domain[i].toString().replace("https://","").replace("http://","").replace("www.","");
                //dnamearray.push(dname);
                var tld = dname.split(".");
                var dtld;
                if (tld[2]) {
                    dtld = tld[1] + "." + tld[2];
                }
                else {
                    dtld = tld[1];
                }
                //dtldarray.push(dtld);
                
                load_suggestion(dname, dtld, "#appenddata");
            }
        }

        
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

        if (domainname == "")
        {
            $("#err_html").html("Please enter domain name.");
            $(".error").show();
            return false;
        }


        var type = $("input[name='selector']:checked").val();

        if (type == "d") {
            for (var j = 0; j < domainarray.length; j++)
            {
                if (trim(domainarray[j]) != '')
                {
                    var domain_check = domainchecker(domainarray[j]);
                    var tld = domainarray[j].split(".");
                    console.log(tld);
                    if (!tld[1]) {
                        $("#err_html").html("please enter proper domain with extension.");
                        $(".error").show();
                        return false;
                    }
                    else if (!tld[0] || tld[0] == '') {
                         $("#err_html").html("please enter proper domain.");
                        $(".error").show();
                        return false;
                    }
                    else if (domain_check == false) {
                        
                        $("#err_html").html("please enter proper domain.");
                        $(".error").show();
                        return false;
                    }
                    else {
                        domainstr = domainstr + domainarray[j] + "\n";
                    }
                }
            }
        }
        else 
        {

            if (tld_Array.length == 0) {
                $("#err_html").html("Please select atleast one domain extenstion.");
                $(".error").show();
                return false;
            }

            for (var i = 0; i < tld_Array.length; i++)
            {

                for (var j = 0; j < domainarray.length; j++)
                {
                    if (trim(domainarray[j]) != '')
                    {
                        var domain_check2 = domainchecker2(domainarray[j]);
                        domainarray[j] = domainarray[j].replace("https://","").replace("http://","").replace("www.","");
                        var tld = domainarray[j].split(".");
                        if (tld[1]) {
                            $("#err_html").html("Please remove domain extension as you have select tld option.");
                             $('html, body').animate({
                            scrollTop: $('#err_html').offset().top
                            }, 'slow');
                            $(".error").show();
                            return false;
                        }

                        else if (domain_check2 == false) {
                            $("#err_html").html("Please remove illegal characters from the domain.");
                            $(".error").show();
                            return false;
                        }

                        else {

                            domainstr = domainstr + domainarray[j] + "." + tld_Array[i] + "\n";
                        }
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
        value = value.replace("https://","").replace("http://","").replace("www.","");
        return /^[a-zA-Z0-9- ]*$/.test(value);
    }

    function load_suggestion(domain, ext, container) {

       /* $.each(domain, function(index, item) {
               var full_domain = item; 
              var loader_id=item.replace(/\./g, "_");

               var str = '<tr class="listing_loader" id="loader_' + loader_id + '"><td> <div class="c-radio-btn d-flex"><label class="custom-radio"><input type="checkbox"> <span class="checkmark"></span>' + full_domain + '</label></div></td><td colspan="3"><i class="fa fa-spinner fa-spin"></i>&nbsp;Checking...</td></tr>';
                $(container).append(str);
           
        });*/

        active_req = false;
        //domain = domain.replace("https://","").replace("http://","").replace("www.","");
        // var full_domain = domain;
         //var loader_id = domain.replace(/\./g, "_");
//        var ext1 = full_domain.split(".");

        // var str = '<tr class="listing_loader" id="loader_' + loader_id + '"><td> <div class="c-radio-btn d-flex"><label class="custom-radio"><input type="checkbox"> <span class="checkmark"></span>' + full_domain + '</label></div></td><td colspan="3"><i class="fa fa-spinner fa-spin"></i>&nbsp;Checking...</td></tr>';
        // $(container).append(str);
       // showLoader();
        $.ajax({
            url: "{{url('/domainsuggestion')}}",
            data: "&domainname=" + domain + "&tld=" + ext + "&currency=<?= $currency ?>&search=bulk",
            type: "get",
            async: true,
            success: function(response) {
                
               if(response=="error")
                {  
                     $("#domainvalidation").append("<li class='red' style='margin:-1px'>( "+ext+" ) TLD not found.</li>");
                     $('html, body').animate({
                            scrollTop: $('#bulkdomains').offset().top
                            }, 'slow');
                    //hideLoader();
                }

                if (trim($('#appenddata').html()) == "")
                {
                hideLoader();
                }
                else
                {
                showLoader();
                }
                
                console.log(response);
                if (response) {

                        var status, pricing, allpricing, domain_key, dclass;
                        var appned_data;
                
                         //$.each(response, function (i, item) {
                        var loader_id=domain.replace(/\./g, "_");
                                 counter++;

                             //$("#loader_" + loader_id).remove();
                    loaded_domain++;
                            status = response[domain]["status"];

                                //pricing = response[i]["pricing"];

                                domain_key = response[domain]["session_key"];
                             
                    if (status == 'available') {
                        dclass = "";
                                pricing = response[domain]["pricing"]["available"];
                    }
                    else {
                        dclass = "red";
                                pricing = response[domain]["pricing"]["transfer"];
                    }

                             $("#appenddata").html();

                             allTLDsPrice[response[domain]['tld']] = response["allpricing"];

                             $("#loader_" + loader_id).show();

                    appned_data += '<tr id="filter_availibity_' + counter + '">';
                            appned_data += '<input type="hidden" id="h_tld" name="h_tld[]" value="' + response[domain]['tld'] + '"/>';
                            appned_data += '<td class="sort_domain"> <div class="c-radio-btn d-flex"><input type="hidden" id="tld_' + counter + '" name="tld[]" value=".' + response[domain]['tld'] + '" disabled="disabled"/><input type="hidden" id="domaintype_' + counter + '" name="domaintype[]" disabled="disabled" value="register"/> <input type="hidden" id="producttype_' + counter + '" name="producttype[]" disabled="disabled" value="domain"/> <input type="hidden" id="regperiod_' + counter + '" name="regperiod[]" value="1" class="regperiod" disabled="disabled" />';


                    if (status == 'available') {
                        appned_data += '<label class="custom-radio"><input type="checkbox" name="domain[]" id="domain_' + counter + '" value=' + domain + ' class="checkboxtype " onclick="addCartItems(' + counter + ', this);"> <span class="checkmark"></span>' + domain + '</label>';
                    }
                    else {
                            appned_data += '<label class="custom-radio">' + response[domain]["domainname"] + '</label>';
                    }

                    appned_data += '</div><span class="mobile_price d-md-none d-block"><i class="rupees_icon" id="var_price_mobile' + counter + '"><?= $currency_symbol ?></i></span></td>';
                    appned_data += '<td class="m-hide sort_status"><span class="status ' + dclass + '" id="var_available_' + counter + '"></span></td>';
                    appned_data += '<td class="text-center m-hide price_option"><span class="price" id="filter_price"><i class="rupees_icon" id="var_price_' + counter + '"><?= $currency_symbol ?></i></span></td>';


                    if (domain_key >= '0') {

                        appned_data += '<td class="text-right" id="cart_add_' + counter + '"><span class="added"><i class="fa fa-check"></i>Added</span><a href="javascript:;"  onclick="removeCartItem(' + counter + ',this,' + domain_key + ');"  class="remove-link" title="Remove"><i class="fa fa-times-circle"></i>Remove</a></td>';
                    }
                    else if (status == 'available' && !domain_key) {

                        appned_data += '<td class="text-right" id="cart_add_' + counter + '"><a href="javascript:void(0);"  class="btn addcart_btn" title="Add to Cart" onclick="addCartItems(' + counter + ', this);">Add to Cart</a></td>';
                    }
                    else {
                        var transfer_link = SITE_URL + '/domain/domain-transfer';
                        appned_data += '<td class="text-right" id="transfer_' + counter + '"><a href="javascript:void(0);" class="btn inquiry_btn" title="Inquiry of ' + response[domain]["domainname"] + '" onclick="setdomainname(this);" data-toggle="modal" data-target="#commonPopup"><i class="info_icon"></i><span class="">Inquiry</span></a><a href="' + transfer_link + '" class="btn transfer_btn" title="Transfer" target="_blank">Transfer</a> </td>';
                    }

                    appned_data += '</tr>';
                    $(container).append(appned_data);

                    if (status == 'available') {
                        $("#var_available_" + counter).html("Available");
                        $("#domain_" + counter).addClass("available");
                        $("#filter_availibity_" + counter).attr("id", "filter_available");
                    }
                    else {
                        $("#var_available_" + counter).html("Not Available");
                        $("#domain_" + counter).removeClass("available");
                        $("#filter_availibity_" + counter).attr("id", "filter_taken");
                    }

                    if (eval(loaded_domain) == eval(limit_domain) && counter != all_domain.length)
                    {
                        active_req = true;
                        $(".table-responsive").append('<div class="view_more aos-init aos-animate"><a href="javascript:;" onclick="load_tlddata(' + counter + ',' + parseInt(counter + 10) + ');" class="btn view_more" title="View More" id="view_more">View More..</a> </div></td></tr>');
                    }

                    if (counter == all_domain.length)
                    {
                        active_req = true;
                    }

                    $('#var_price_' + counter).after(parseFloat(pricing));
                    $('#var_price_mobile' + counter).after(parseFloat(pricing));

                         //});

                }

                    if(!active_req) {

                        showLoader();
            }
                    else
                    {
                        hideLoader();
                    }
                }
        });
    }


    function setcountrydata(val) {
        $(".tab-pane").removeClass("active");
        $(".tab-pane").removeClass("show");

        $("#" + val).addClass("active show in");
    }

    function getdomainpricing(duration) {

        $("#appenddata tr:not(.listing_loader)").each(function(i, ele) {
            var tld2 = $(ele).find("#h_tld").val();
            var update_price;

            if (typeof tld2 != "undefined") {
                if (this.id == 'filter_taken') {
                    update_price = allTLDsPrice[tld2]["transfer"]["Price" + duration];
                }
                else {
                    update_price = allTLDsPrice[tld2]["available"]["Price" + duration]
                }
                var str = '<span class="price" id="filter_price"><i class="rupees_icon" id="var_price_0"><?= $currency_symbol ?></i>' + parseFloat(update_price) + '</span>';
                $(ele).find("#filter_price").html(str);
                $(".regperiod").val(duration);
            }
            else {
                console.log("tld undefined");
            }
        });
    }
    function setdomainname(type) {
        var title = $(type).attr("title");
        var title_rep = title.split("Inquiry of");
        $("#dname").val(trim(title_rep[1]));
    }

    var selectedDomainArr = [];
    function addCartItems(frmkey, ele) {
       
        if (!active_req) {
            alert("Please wait until domain search process to be completed.");
        }
        else {
            $("#domain_" + frmkey).attr("Checked", "Checked");
            $("#tld_" + frmkey).attr("disabled", false);
            $("#regperiod_" + frmkey).attr("disabled", false);
            $("#domaintype_" + frmkey).attr("disabled", false);
            $("#producttype_" + frmkey).attr("disabled", false);

            var dname = $("#domain_" + frmkey).val();
            var tld = $("#tld_" + frmkey).val();
            var reg = $("#regperiod_" + frmkey).val();
            var dtype = $("#domaintype_" + frmkey).val();
            var ptype = $("#producttype_" + frmkey).val();
            var formData = $("#suggestedDomainFrm").serialize();


//        $("#dvprocessing").show();
            showLoader();
//        var total_products = $("#total_product").val();
            //var formData = $("#suggestedDomainFrm").serialize();
            $.ajax({
//            url: "{{url('/addtocart')}}",
                url: "{{url('cart/store?landingdomain=y')}}",
                //data: "ptype=" + ptype + "&dtype=" + dtype + "&reg=" + reg + "&tld=" + tld + "&domain=" + dname + "&i=" + selectedDomainArr.length,
                data: "producttype=" + ptype + "&domaintype=" + dtype + "&regperiod=" + reg + "&tld=" + tld + "&domain=" + dname + "&i=" + selectedDomainArr.length +"&singledomain=y",
                //data: formData,
                type: "post",
                success: function(response) {
                    if (response) {
                        //key = response;
                        hideLoader();
                        cart_count++;
                        key=cart_count-1;
                         selectedDomainArr.push(response);
                         domainkey = selectedDomainArr.length;

                         if(domainkey>0)
                         {
                            $("#domainvalidation").text("");
                         }
                         else
                         {
                            $("#domainvalidation").text("Please select atleast one domain");  
                         }

                        $("#cart_cout").html(cart_count);
                        $("#cart_cout").show();
                        //$.each(response, function(key, domain) {
                            //alert('hi1');
                            //var domain_rep = domain.replace(/\./g, "_");
                            //var org_domain = domain.replace(/\_/g, ".");
                            remove_key.push(key);
                            //alert("#cart_add_" + frmkey);
                            //$("#cart_add_" + frmkey).empty();
                            $("#cart_add_" + frmkey).html('<span class="added"><i class="fa fa-check"></i>Added</span><a href="javascript:;" onclick="removeCartItem(' + frmkey + ',this,' + key + ');"  class="remove-link" title="Remove"><i class="fa fa-times-circle"></i>Remove</a>');
                            $("#domain_" + frmkey).replaceWith('<input type="checkbox" name="domain[]" id="domain_' + frmkey + '" value="'+dname+'" class="checkboxtype available" onclick="removeCartItem(' + frmkey + ',this,' + key + ');" checked="Checked">');
                            
                        //});
                    }

                }
            });
        }
    }

    function stripHtml(html) {
        var temporalDivElement = document.createElement("div");
        // Set the HTML content with the providen
        temporalDivElement.innerHTML = html;
        // Retrieve the text property of the element (cross-browser support)
        return temporalDivElement.textContent || temporalDivElement.innerText || "";
    }

    function sort(ascending, columnClassName, tableId)
    {

        var tbody = document.getElementById(tableId).getElementsByTagName("tbody")[0];
        var rows = tbody.getElementsByTagName("tr");
        var unsorted = true;
        while (unsorted)
        {
            $(".rupees_icon").html('');
            unsorted = false

            for (var r = 0; r < rows.length - 1; r++)
            {
                var row = rows[r];
                var nextRow = rows[r + 1];
                var value = row.getElementsByClassName(columnClassName)[0].innerHTML;
                var nextValue = nextRow.getElementsByClassName(columnClassName)[0].innerHTML;
                value = value.replace(',', ''); // in case a comma is used in float number
                value = stripHtml(value);
                nextValue = nextValue.replace(',', '');
                nextValue = stripHtml(nextValue);
                if (!isNaN(value))
                {
                    value = parseFloat(value);
                    nextValue = parseFloat(nextValue);
                }

//                console.log(value);
                if (ascending ? value > nextValue : value < nextValue)
                {
                    tbody.insertBefore(nextRow, row);
                    unsorted = true;
                }
            }
        }
        $(".rupees_icon").html('<?= $currency_symbol ?>');
    }
    ;
    function removeCartItem(frmkey, ele, key) {

        if (!active_req) {
            alert("Please wait until domain search process to be completed.");
        }
        else {

            if (confirm('Are you sure, you want to remove selected item from the cart?')) {
                var formData = $("#suggestedDomainFrm").serialize();
//            $("#dvprocessing").show();
                showLoader();
                $.ajax({
                    url: "{{url('/removecart')}}",
                    data: formData + "&ele_key=" + key,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response) {
                            selectedDomainArr.pop(response);
                            cart_count--;
                            $("#cart_cout").html(cart_count);
//                        $("#dvprocessing").hide();
                            hideLoader();

                            if (cart_count <= 0) {
                                $("#cart_cout").hide();
                            }
                             var domain_val = $("#domain_" + frmkey).val();
                            remove_key.splice($.inArray(key, remove_key), 1);
                            $("#domain_" + frmkey).attr("Checked", false);
                            $("#cart_add_" + frmkey).empty();
                            $("#domain_" + frmkey).replaceWith('<input type="checkbox" name="domain[]" id="domain_' + frmkey + '" value="' + domain_val + '" class="checkboxtype available" onclick="addCartItems(' + frmkey + ', this);" >');
                            $("#cart_add_" + frmkey).html('<a href="javascript:void(0);" class="btn addcart_btn" title="Add to Cart" onclick="addCartItems(' + frmkey + ', this);">Add to Cart</a>');
                        }
                    }
                });
            }
        }
    }

    $(".addall").click(function() {

        
        $("#appenddata tr[id^='filter_available']").each(function(i, ele) {
           
            var cnt=i+1;
           
            var Domain_val = $(ele).find("input:checkbox[id^='domain_']").val();
            var domain_rep = Domain_val.replace(/\./g, "_");
            var total_selected = $('#appenddata tr#filter_available').length;
            var total_cart_count = parseInt(cart_count) + parseInt(total_selected);
            if (cart_count != '0') {
                var domaincnt=eval(i) + eval(cart_count);
                total_cart_count = total_cart_count;
            }
            else {
                var domaincnt=eval(i) + eval(cart_count);
                total_cart_count = total_selected;
            }
            selectedDomainArr.push(domaincnt);
             remove_key.push(domaincnt);

            $("#cart_cout").html(total_cart_count);
            $("#cart_cout").show();
            $(ele).find("input:checkbox[id^='domain_']").attr('checked', 'checked');
            $(ele).find("input:hidden[id^='tld_']").attr("disabled", false);
            $(ele).find("input:hidden[id^='regperiod_']").attr("disabled", false);
            $(ele).find("input:hidden[id^='domaintype_']").attr("disabled", false);
            $(ele).find("input:hidden[id^='producttype_']").attr("disabled", false);
            $(ele).find(".addcart_btn").parent().html('<span class="added"><i class="fa fa-check"></i>Added</span><a href="javascript:;" onclick="removeCartItem('+cnt+',this,'+domaincnt+');" id="' + domain_rep + '"  class="remove-link" title="Remove"><i class="fa fa-times-circle"></i>Remove</a>');
//        });
        });
        var formPostData = $("#suggestedDomainFrm").serialize();
        showLoader();
        $.ajax({
//            url: "{{url('/addtocart')}}",
            url: "{{url('cart/store?landingdomain=y')}}",
            data: formPostData,
            type: "post",
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                 hideLoader();
                if(response.toString() == '0'){  alert('No domain available to add into cart!'); return false; }
                $(".addall").replaceWith('<a href="javascript:;" class="removeall" onclick="removeallcart();" title="Remove All">Remove All</a>');
                
                $("#domainvalidation").text("");
              
                $.each(response, function(key, domain) {

                   
                    if ($("#appenddata").find("#" + domain).length > 0) {

                        var parent_id = $("#" + domain).parent().attr('id');
                        var parent_id_repalce = parent_id.replace("cart_add_", "");
                        $("#" + domain).attr("href", "javascript:;removeCartItem('" + parent_id_repalce + "',this,'" + key + "');");
                    }
                });
            },
            error: function(data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    });

    function removeallcart() {
        var unique_key = remove_key.unique();
        console.log(unique_key);
        if (confirm('Are you sure? You wants to remove all item from cart!')) {
            var formData = $("#suggestedDomainFrm").serialize();
//            $("#dvprocessing").show();
            showLoader();
            $.ajax({
                url: "{{url('/removeallcart')}}",
                data: formData + "&ele_key=" + unique_key,
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response) {
                        window.location.reload();
                    }
                }
            });
        }
    }

    $('.tld_checkbox').click(function() {
        var check_tld = $(this).val();
        var rep_tld = check_tld.replace(".", "_");
        if ($(this).prop('checked') == true) {
            $(".bulktage_list").append('<span class="tag" id="' + rep_tld + '">.' + check_tld + '<i class="fa fa-times" onclick=removetag("' + rep_tld + '");></i></span>');
            $(".checked_domain_list").show();

            tld_Array.push(check_tld);
//            console.log(tld_Array);
        }

        else if ($(this).prop('checked') == false)
        {
            $("#" + rep_tld).remove();

            tld_Array.remove(check_tld);
//            console.log(tld_Array);
            var numItems = $('.bulktage_list .tag').length;
            if (numItems == 0) {
                $(".checked_domain_list").hide();
            }
        }
    });

    function removetag(tag) {
        $("#" + tag).remove();
        var rep_tld = tag.replace("_", ".");
        tld_Array.remove(rep_tld);
        $("#" + tag).prop('checked', false);
        var numItems = $('.bulktage_list .tag').length;
        if (numItems == 0) {
            $(".checked_domain_list").hide();
        }
    }

<?php
if (isset($_REQUEST["bulk_search"])) {
    ?>

        $('html, body').animate({
            scrollTop: $(".domain_list_table").offset().top
        }, 2000);
<?php } ?>

</script>

@endsection
