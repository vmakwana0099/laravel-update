@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
@include('cart.cartscripts')
<script type="text/javascript">showLoader();</script>
<script src="{{url('/assets/js/jquery-ui.js')}}" type="text/javascript"></script>

<?php
 $cart_array_items = count((array)Session::get('cart'));
$currency = Config::get('Constant.sys_currency');
$currency_Code = Config::get('Constant.sys_currency_code');
$currency_symbol = Config::get('Constant.sys_currency_symbol');

function remove_all_special_char($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9.\-]/', '', $string); // Removes special chars.
}

function remove_all_special_char_with_dot($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
// echo '<pre>';print_r($domaindata);exit;
if ($domaindata["status"] != 'available') {
    $domain_list_class = "domain_list2";
    $domain_price_class = "domain_list_btn";
} else {
    $domain_list_class = "";
    $domain_price_class = "domain_price d-flex align-items-center justify-content-end";
}

$TldArray = explode(",", $_REQUEST["hide_tlddata"]);

//$DomainName = remove_all_special_char($_REQUEST["domainname"]);
$DomainName = str_replace("https://","",$_REQUEST["domainname"]);
$DomainName = str_replace("http://","",$DomainName);
$DomainName = str_replace("www.","",$DomainName);
$DomainName = remove_all_special_char($DomainName);

$ExpDomain = explode(".", $DomainName);
if (isset($ExpDomain[1])) {
    if ($ExpDomain[1] == '') {
        $Full_Domain = $ExpDomain[0] . ".com";
        $default_tld = ".com";
    } else {
        $Full_Domain = $DomainName;
        $default_tld = $ExpDomain[1];
         if(isset($ExpDomain[2]) && !empty($ExpDomain[2])){ $default_tld .= ".".$ExpDomain[2]; }
        
    }
} else {
    $Full_Domain = $ExpDomain[0] . ".com";
    $default_tld = ".com";
}


if (session()->has('cart')) {
    $cart_array = Session::get('cart');
    
    if(array_key_exists('userid',$cart_array))        { unset($cart_array['userid']); }
    if(array_key_exists('paymentmethod',$cart_array)) { unset($cart_array['paymentmethod']); }
    if(array_key_exists('recommndation',$cart_array)) { unset($cart_array['recommndation']); }            
    if(array_key_exists('prmocode',$cart_array))      { unset($cart_array['prmocode']); }
    if(array_key_exists('prmodiscount',$cart_array))  { unset($cart_array['prmodiscount']); }
    if(array_key_exists('prmomessage',$cart_array))   { unset($cart_array['prmomessage']); }


    $cartDomains = array();
    $Cart = 0;
    foreach ($cart_array as $key => $cart_data) {
        $cartDomains[] = $cart_data["domain"];
        $Cart++;
    }
    if ($Cart > 0) {
        $Display_checkout = "display:none;";
    } else {
        $Display_checkout = "display:none;";
    }
} else {
    $Cart = 0;
    $Display_checkout = "display:none;";
}
$Cart = 0; //make cart counter 0 by default on page load.
?>
<div class="banner-inner domanilist-banner">
    <div class="container">     
        <div class="banner-content d-flex justify-content-center">
            <div class="doamin_search_div">
                <div class="form-group aos-init" data-aos="fade-up" data-aos-easing="ease-out-back">
                    <div class="dropdown dropdown-bulk">
                        <button class="btn btn-default dropdown-toggle d-md-block d-none" type="button" id="menu1" data-toggle="dropdown">Single Search
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" title="Single Search">Single Search</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" title="Bulk Search" onclick="window.location.href ='{{url('/domain/bulk-domain-search')}}'">Bulk Search</a></li>
                        </ul>
                    </div>
                    <form action="{{url('/domain-checker')}}" id="domainlookupfrm" method="post" >
                        {{ csrf_field() }}
                        <input type="text" class="form-control" value="<?= remove_all_special_char($domaindata["domainname"]) ?>" name="domainname" id="domainname" placeholder="Search for a Domain Name"/>
                        <span class="domain_error"></span>
                        <input type="hidden" name="hide_tlddata" id="hide_tlddata" value="{{$Tlds}}" />
                        <input type="hidden" name="domain_search" id="domain_search" value="y" />
                        <button class="btn" title="Search" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                 <a href="javascript:void(0);" title="Continue to Cart" id="checkout_total" class="btn">Continue to Checkout</a>
            </div>
        </div>


        <div class="additemcart selected_domain_text" id="checkout_items" style="display:none">
           
            <span id="total_items" style="color: white;"> <?= $Cart ?> </span> domain selected
    </div>
</div>
</div>

<div class = "domainlist-page">
    <div class = "container">
        <div class = "row">
            <div class="col-12">
                <?php
                if ($domaindata["status"] == 'available') {
                    ?>
                    <div id="auto_id"></div>
                    <span class="domain_status_note">Yes! Your Domain is available. Buy it before someone else does.</span>
                <?php }

                ?>
               
            </div>
            <div class="col-12">
                <div class="available_main {{$domain_list_class}} d-flex flex-wrap align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-8 col-12"> 
                         <div class ="available_domain d-flex  aos-init" data-aos = "fade-right" data-aos-easing = "ease-out-back">

                            <?php
                            if ($domaindata["status"] == 'available') {
                                ?>
                                
                                <i class = "fa fa-check-circle"></i><div class="domain_name"><?= remove_all_special_char($domaindata["domainname"]) ?><span> is available</span></div>
                            <?php } else { ?>
                                <div class="domain_name"><span>Sorry! </span> <?= remove_all_special_char($domaindata["domainname"]) ?> <span> is taken</span></div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class = "col-sm-4 col-12">
                        <div class = "{{$domain_price_class}} aos-init" id="top_domain" data-aos = "fade-left" data-aos-easing = "ease-out-back">
                            @if($domaindata["status"] == 'available')
                            <form id="singleDomainFrm" name="singleDomainFrm" action="javascript:void(0);">

                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" id="producttype_main" name="producttype[]" value="domain"/>
                                <input type="hidden" id="tld_main" name="tld[]" value=".<?= $default_tld ?>">
                                <input type="hidden" id="domaintype_main" name="domaintype[]" value="register">  
                                <input type="hidden" id="regperiod_main" name="regperiod[]" value="2" class="regperiod">
                                <input type="checkbox"  style="display: none;" name="domain[]" id="domain_main" value="<?= remove_all_special_char($Full_Domain) ?>" class="checkboxtype available" >

                                <?php
                                if (session()->has('cart')) {
                                    if (in_array($Full_Domain, $cartDomains)) {
                                        $arr_key = array_keys($cartDomains, $Full_Domain)[0];
                                        ?>
                                        @if(isset($domaindata['data']) && $domaindata['data'] == 'com')
                                            <span class="price"><i class="rupees_ico"><?= $currency_symbol ?></i>{{ Config::get('Constant.TLD_COM_PRICE_INR') }}</span>
                                        @else
                                            <span class="price"><i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["reg_pricing"] ?></span>
                                        @endif
                                        <div class="listing-add-remove"> <span class="added-list"><i class="fa fa-check"></i>Added</span>
                                            <a href="javascript:;" onclick="removesingleCartItem('<?= $arr_key ?>');" class="remove-list" title="Remove"><i class="fa fa-times-circle"></i>Remove</a>
                                        </div>
                                        @if(isset($domaindata['data']) && $domaindata['data'] == 'com')
                                            <span class="renewal_txt aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">For the first year with<br>2 Years registration</span>
                                        @else
                                            <span class="renewal_txt aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">Renewal <i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["ren_pricing"] ?> for 1 year</span>
                                        @endif
                                        <?php
                                    } else {
                                        $arr_key = '';
                                        ?>
                                            @if(isset($domaindata['data']) && $domaindata['data'] != 'com')
                                            <span class="price"><i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["reg_pricing"] ?></span>
                                        @else
                                            <span class="price"><i class="rupees_ico"><?= $currency_symbol ?></i>{{ Config::get('Constant.TLD_COM_PRICE_INR') }}</span>
                                        @endif
                                            
                                            <a href = "javascript:;" class = "btn" title = "Select" id="main_cart" onclick="addsingleCartItems();">Add to Cart</a>
                                            @if(isset($domaindata['data']) && $domaindata['data'] == 'com')
                                                <span class="renewal_txt aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">For the first year with<br>2 Years registration</span>
                                            @else
                                                <span class="renewal_txt aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">Renewal <i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["ren_pricing"] ?> for 1 year</span>
                                            @endif
                                        
                                        <?php
                                    }
                                } else {
                                    ?>
                                    @if(isset($domaindata['data']) && $domaindata['data'] != 'com')
                                        <span class="price"><i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["reg_pricing"] ?></span>
                                    @else
                                        <span class="price"><i class="rupees_ico"><?= $currency_symbol ?></i>{{ Config::get('Constant.TLD_COM_PRICE_INR') }}</span>
                                    @endif
                                        
                                        <a href = "javascript:;" class = "btn" title = "Select" id="main_cart" onclick="addsingleCartItems();">Add to Cart</a>
                                        @if(isset($domaindata['data']) && $domaindata['data'] == 'com')
                                            <span class="renewal_txt aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">For the first year with<br>2 Years registration</span>
                                        @else
                                            <span class="renewal_txt aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">Renewal <i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["ren_pricing"] ?> for 1 year</span>
                                        @endif
                                    
                                <?php } ?>
                            </form>

                            @else
                            <a href = "javascript:void(0);" class = "btn"  onclick="setdomainname(this);" data-toggle="modal" data-target="#commonPopup" title="Inquiry of {{$Full_Domain}}">Inquire Now</a>
                            <a href = "{{url('/domain/domain-transfer')}}" target="_blank" class = "btn" title = "Transfer">Transfer</a>
                            @endif

                        </div>
                    </div>
                   
                   <?php if($domaindata["status"] == 'available')
                   {

                    ?>
                    <div class="more_available_items col-12 availsuggestdomain" style="display:none">
                        <div class="row">
                             <?php
                                $total=0;
                              ?>
                            @if(isset($Suggested_Tlds))
                             @if(count($Suggested_Tlds)>0)
                               
                            <div class="col-sm-6 col-md-6 col-lg-8 col-12">
                               
                                <ul>
                                 <span id="suggestDomain"></span>
                                 <span id="hiddenDomainName"></span>
                                <!-- @foreach($Suggested_Tlds as $tlddata)
                                <li>{{$paramss["domainname"]}}.{{$tlddata->varTitle}}</li>

                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                  <?php
                                    $total+=Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_INR');
                                   ?>
                                   @else
                                   <?php 
                                   $total+=Config::get('Constant.'.$tlddata->varWHMCSFieldName.'_USD');
                                   ?>
                                   @endif  
                                @endforeach -->
                                </ul>
 
                            </div>
                                @endif
                                @endif
           
                            <div class="col-sm-6 col-md-6 col-lg-4 col-12">
                                <div class="domain_price d-flex align-items-center justify-content-end aos-init" data-aos="fade-left" data-aos-easing="ease-out-back">
                                    <div class="item_price_big">
                                        <span class="price rupees">{!! Config::get('Constant.sys_currency_symbol') !!}<span class="price" id="domainSprice"></span><!-- {{$total}} --></span>
                                        <span class="renewal_txt aos-init" data-aos="fade-left" data-aos-easing="ease-out-back">for the first year</span>
                                    </div>
                                    <a href="javascript:void(0)" class="btn" id="main_cartt" onclick="addSuggestedDomainItems();" title="Add to Cart">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                     ?>

                </div>
            </div>
           <!--  <div class = "col-12">
                <div class = "available_main {{$domain_list_class}} d-flex flex-wrap align-items-center">
                    <div class = "col-sm-8 col-12">
                        <div class ="available_domain d-flex  aos-init" data-aos = "fade-right" data-aos-easing = "ease-out-back">

                            <?php
                            if ($domaindata["status"] == 'available') {
                                ?>
                                <i class = "fa fa-check-circle"></i><div class="domain_name"><?= remove_all_special_char($domaindata["domainname"]) ?><span> is available</span></div>
                            <?php } else { ?>
                                <div class="domain_name"><span>Sorry! </span> <?= remove_all_special_char($domaindata["domainname"]) ?> <span> is taken</span></div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class = "col-sm-4 col-12">
                        <div class = "{{$domain_price_class}} aos-init" id="top_domain" data-aos = "fade-left" data-aos-easing = "ease-out-back">
                            @if($domaindata["status"] == 'available')
                            <form id="singleDomainFrm" name="singleDomainFrm" action="javascript:void(0);">

                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" id="producttype_main" name="producttype[]" value="domain"/>
                                <input type="hidden" id="tld_main" name="tld[]" value=".<?= $default_tld ?>">
                                <input type="hidden" id="domaintype_main" name="domaintype[]" value="register">  
                                <input type="hidden" id="regperiod_main" name="regperiod[]" value="1" class="regperiod">
                                <input type="checkbox"  style="display: none;" name="domain[]" id="domain_main" value="<?= remove_all_special_char($Full_Domain) ?>" class="checkboxtype available" >

                                <?php
                                if (session()->has('cart')) {
                                    if (in_array($Full_Domain, $cartDomains)) {
                                        $arr_key = array_keys($cartDomains, $Full_Domain)[0];
                                        ?>
                                        <div class="listing-add-remove"> <span class="added-list"><i class="fa fa-check"></i>Added</span>
                                            <a href="javascript:;" onclick="removesingleCartItem('<?= $arr_key ?>');" class="remove-list" title="Remove"><i class="fa fa-times-circle"></i>Remove</a>

                                        </div>
                                        <?php
                                    } else {
                                        $arr_key = '';
                                        ?>
                                        <span class="price"><i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["reg_pricing"] ?></span>
                                        <a href = "javascript:;" class = "btn" title = "Select" id="main_cart" onclick="addsingleCartItems();">Select</a>
                                        <span class="renewal_txt aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">Renewal <i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["ren_pricing"] ?> for 1 year</span>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <span class="price"><i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["reg_pricing"] ?></span>
                                    <a href = "javascript:;" class = "btn" title = "Select" id="main_cart" onclick="addsingleCartItems();">Select</a>
                                    <span class="renewal_txt aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">Renewal <i class="rupees_ico"><?= $currency_symbol ?></i><?= $domaindata["ren_pricing"] ?> for 1 year</span>
                                <?php } ?>
                            </form>

                            @else
                            <a href = "javascript:void(0);" class = "btn"  onclick="setdomainname(this);" data-toggle="modal" data-target="#commonPopup" title="Inquiry of {{$Full_Domain}}">Inquire Now</a>
                            <a href = "{{url('/domain/domain-transfer')}}" target="_blank" class = "btn" title = "Transfer">Transfer</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div> -->
            </div>

        <div class = "row">
            <div class = "col-md-5">
                <div class = "domain_info_btns">
                    <a href = "javascript:;" id="ajax_replace_total"  class = "btn fill" title = "" data-aos = "fade-right" data-aos-delay = "100" onclick="show_filter_domains('all');"><span id="total_search">0</span> Results</a>
                    <a href = "javascript:;" id="ajax_replace_available" class = "btn border_btn" title = "" data-aos = "fade-right" data-aos-delay = "700" onclick="show_filter_domains('available');"><span id="total_available">0</span> Available</a>
                    <input type="hidden" name="hide_available" id="hide_available" value="0" />
                    <input type="hidden" name="hide_taken" id="hide_taken" value="0" />
                    <input type="hidden" name="total_product" id="total_product" value="" />
                    <a href = "javascript:;" id="ajax_replace_taken" class = "btn border_btn" title = "" data-aos = "fade-right" data-aos-delay = "500" onclick="show_filter_domains('taken');"><span id="total_taken">0</span> Taken</a>
                                        <!--<a href = "#" class = "btn blue_btn d-none" title = "80 Premium aos-init" data-aos = "fade-right" data-aos-delay = "300"><span>80</span> Premium</a>-->
                </div>
            </div>

<?php 
            /*<div class="col-md-7" style="<?= $Display_checkout ?>" id="checkout_items">
                <div class="additemcart d-flex align-items-center aos-init aos-animate" data-aos="fade-left" data-aos-easing="ease-out-back">
                    <i class="sprite-image cart-icon"></i>
                    You have<span id="total_items"> <?= $Cart ?> </span>item(s) selected.
                    <a href="javascript:void(0);" class="btn" id="checkout_total">Add to Cart(<?= $Cart ?>)</a>
                </div>
            </div>*/
?>
            </div>


        <div class = "row flex-lg-row-reverse">

            <div class = "col-lg-9">
                <div class = "domain_list_table aos-init" data-aos = "fade-left" data-aos-easing = "ease-out-back">


                    <form id="suggestedDomainFrm" name="suggestedDomainFrm" action="javascript:void(0);">
                        <input type="hidden" name="ext_domain" id="ext_domain" value="<?= remove_all_special_char_with_dot($ExpDomain[0]) ?>" /> 
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                        <!--<input type="hidden" id="producttype" name="producttype[]" value="domain"/>-->
                        <table id="domain_table">
                            <thead id="thead">
                                <tr>
                                    <th id="sort_domain">
                                        Domain<span class = "filter-arrow"><i class = "top-arrow" onclick="javascript:sort(true, 'sort_domain', 'domain_table');"></i><i class = "bottom-arrow" onclick="javascript:sort(false, 'sort_domain', 'domain_table');"></i></span>
                                    </th>
                                    <th id="sort_status">Status<span class = "filter-arrow"><i class = "top-arrow" onclick="javascript:sort(true, 'sort_status', 'domain_table');"></i><i class = "bottom-arrow" onclick="javascript:sort(false, 'sort_status', 'domain_table');"></i></span></th>
                                    <th class = "text-center" id="price_option">1 Year
                                         
                                        <?php /*<select class = "selectpicker" onchange="getdomainpricing('<?= $_REQUEST["hide_tlddata"] ?>', '<?= remove_all_special_char($DomainName) ?>', this.value);">*/ ?>
                                            <?php
                                            /*for ($i = 1; $i <= 10; $i++) {
                                                if ($i == 1) {
                                                    $Year = "Year";
                                                    $Yearval = 0;
                                                } else {
                                                    $Year = "Years";
                                                    $Yearval = $i;
                                                }*/
                                                

                                                ?>

                                                <?php /*<option value="<?= $i ?>">*/ ?> <?php /*echo  $i . " " . $Year*/ ?>
                                                    
                                                

                                            <?php //</option> }
                                            ?>
                                       <?php /*</select>
                                        <span class = "filter-arrow"><i class = "top-arrow" onclick="javascript:sort(true, 'price_option', 'domain_table');"></i><i class = "bottom-arrow" onclick="javascript:sort(false, 'price_option', 'domain_table');"></i></span>*/ ?>
                                    </th>

                                    <th class = "text-right">
                                        <a href = "javascript:;" onclick="addalldomains()" id="ajax_hide" class = "addall" title = "Add All +">Add All +</a>
                                    </th>

                                </tr>
                            </thead>
                            <tbody id="appenddata">

                            </tbody>
                        </table>


                        <script type="text/javascript">
                                    setTimeout(function() {
//                                all_domain_tld.remove('<?= str_replace(".", '', $default_tld) ?>');
                                    all_domain_tld.remove('<?= remove_all_special_char_with_dot($default_tld) ?>');
//                                load_suggestion('<?= remove_all_special_char($ExpDomain[0]) ?>', all_domain_tld[counter], '#appenddata');
                                            load_tlddata('<?= remove_all_special_char($ExpDomain[0]) ?>', all_domain_tld[counter], '#appenddata');
                                    }, 2000);</script>

                    </form>
                </div>

            </div>
            <div class = "col-lg-3">
                <div class = "left_panel">
                    <div class = "extension_part aos-init" data-aos = "fade-right" data-aos-easing = "ease-out-back">
                        <h3>Extensions</h3>
                        <div class = "extension_list mCustomScrollbar">
                        <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                            <?php
                            $T = 1;
                            foreach ($TldArray as $singleTld) {
                                if($singleTld != $domaindata['data']){ //hide searched tld
                                $allTld[] = $singleTld;
                                ?>
                                <div class = "name">
                                    <span class = "c-radio-btn d-flex">
                                        <label class = "custom-radio" id="allextension">
                                            <input type = "checkbox" name="selector[]"  id="checkbox_<?= $T ?>" value="<?= $singleTld ?>" >
                                            <span class = "checkmark"></span>
                                            <?= $singleTld ?>
                                        </label>
                                    </span>
                                </div>
                                <?php
                                $T++;
                                }
                            }
                            ?>
                        </div>
                        </div>
                        <a href = "javascript:void(0);" class = "clear_list_link" title = "Clear">Clear</a>
                        <div class = "lenght_div d-none">
                            <h3>Price @if(Config::get('Constant.sys_currency_code') == 1)
                                (<span class="rupee">&#8377;</span>)
                            @else 
                                ($)
                            @endif</h3>
                            <div class = "lenght-slider">
                                <div class = "slide_range">
                                    <input type = "text" class = "form-control start-price" id = "price-low" readonly>
                                    <input type = "text" class = "form-control end-price" id = "price-high" readonly>
                                </div>
                                <div id="slider-range2"></div>
                            </div>
                        </div>

                        <div class = "checkbox_div">
                            <div class = "col-12 listing d-none">
                                <span class = "c-radio-btn d-flex">
                                    <label class = "custom-radio" >
                                        <input type = "checkbox">
                                        <span class = "checkmark"></span>
                                        Show Premium
                                    </label>
                                </span>
                            </div>
                            <div class = "col-12 listing">
                                <span class = "c-radio-btn d-flex">
                                    <label class = "custom-radio" id="country_tld">
                                        <input type = "checkbox">
                                        <span class = "checkmark"></span>
                                        Country/Location
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class = "all_domain_div aos-init" data-aos = "fade-right" data-aos-easing = "ease-out-back">
                        <h3>All Domains come with...</h3>
                        <ul class = "domain_list">
                            <li><i class = "domain_sprite domainforward_icon"></i>Domain Forwarding</li>
                            <li><i class = "domain_sprite urlmasking_icon"></i>URL Masking</li>
                            <li><i class = "domain_sprite dns_icon"></i>DNS Management</li>
                            <li><i class = "domain_sprite protection_icon"></i>Domain Theft Protection</li>
                            <li><i class = "domain_sprite bulk_icon"></i>Bulk Tools</li>
                            <li><i class = "domain_sprite controlpanel_icon"></i>Easy-to-use Control Panel</li>
                            <li><i class = "domain_sprite support_icon"></i>24/7 Local Support</li>
                        </ul>
                    </div>

                    @if(!empty($ProductPrice))
                    <div class = "wphost_deal aos-init" data-aos = "fade-right" data-aos-easing = "ease-out-back">
                        <h3 class = "text-center">{{$deals_data->varTitle}} Deals</h3>
                        <div class = "info">
                            <i class = "listing-icon {{$deals_data->icon}}"></i>
                            <div class = "start-txt">Today Starting From</div>
                            <div class = "price">
                                <i class = "rupees_ico"><?= $currency_symbol ?></i>
                                <span class = "num">{{$ProductPrice}}</span>
                                <span class = "month">/mo*</span>
                            </div>
                            <a href = "{{url('/deals')}}" class = "border_btn" title = "Start Your Site Now!">Start Your Site Now!</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
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
                                        <input type="text" name="varName" id="varName" tabindex="1" class="form-control" placeholder="Please enter your name" value=""  title="Please enter valid input" pattern="[a-zA-Z\s'']+" title="Please enter valid input">
                                        @if ($errors->has('varName'))
                                        <span class="help-block">
                                        {{ $errors->first('varName') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="varEmail">EMAIL <span class="required">*</span></label>
                                        <input type="email" name="varEmail" id="varEmail" tabindex="2" class="form-control" placeholder="Please enter your email ID">
                                    </div>
                                    <div class="form-group">
                                        <label for="varPhone">Phone <span class="required">*</span></label>
                                        <input type="tel" name="varPhone" id="varPhone" tabindex="3" class="form-control" placeholder="Please enter your phone number" onkeypress="javascript: return KeycheckOnlyPhonenumber(event);">
                                    </div>
                                    <div class="form-group">
                                        <label for="varMessage">Message</label>
                                        <textarea class="form-control" id="varMessage" name="varMessage"  tabindex="5" placeholder="Please enter your message"></textarea>

                                        @if ($errors->has('varMessage'))
                                        <span class="help-block">
                                        {{ $errors->first('varMessage') }}
                                        </span>
                                        @endif 
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
<?php
$AllTlds = '"' . implode('","', $allTld) . '"';
$Country_Tlds = '"' . implode('","', $Country_Tld) . '"';
?>
<script type="text/javascript">

    jQuery(document).ready(function() {

                    if (cart_count == 0) {
                    $("#checkout_items").hide();
                    $("#checkout_total").show();
                    //$("#total_items").html(cart_count);
                    $("#cart_cout").hide();
                    //$("#cart_cout").html(cart_count);
                    }
                    else
                    {
                     $("#checkout_items").show();
                    $("#total_items").html(cart_count);
                            $("#cart_cout").html(cart_count);
                            $("#checkout_total").html('Continue to Checkout');
                    }
    });

            var totalavailable = 0;
            var taken = 0;
            var allTLDsPrice = [];
            var inc_id = '';
            var total_search = 0;
            var all_domain_tld = new Array(<?= $AllTlds; ?>);
//    var all_domain_tld = [<?= $AllTlds; ?>];
            var counter = 0;
            var loaded_domain = 0;
            var limit_domain = 10;
            var ajax_req = [];
            var remove_key = [];
            var cart_count;
            var active_req = false;
//            var cur_sym = '{!! $currency_symbol !!}';

<?php
if (session()->has('cart')) {
    ?>
        //cart_count = '<?= count($cart_array) ?>';
        cart_count = '0';
<?php } else { ?>
        cart_count = '0';
<?php } ?>

//    var country_tld = ["ca", "in", "co.in", "co.uk", "net.in", "nz"]; // add country tld here
    var country_tld = new Array(<?= $Country_Tlds ?>); // add country tld here
            var SITE_URL = {!! json_encode(url('/')) !!};
            Array.prototype.remove = function() {
            var what, a = arguments, L = a.length, ax;
                    while (L && this.length) {
            what = a[--L];
                    while ((ax = this.indexOf(what)) !== - 1) {
            this.splice(ax, 1); 
            }
            }
            return this;
            };
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

            //backup function of load_tlddata
           /* function load_tlddata(domain, tld, container) {

            loaded_domain = 0;
                    $("#view_more").parent().remove();
                    var start = counter;
                   
                    var end = parseInt(start + 10);
                    for (var i = start; i < end; i++) {
            if (i < all_domain_tld.length) {
            load_suggestion(domain, all_domain_tld[i], container);
            }

            }
            }*/
                    var i=0;
                    var domain_tld_arr=[];
               function load_tlddata(domain, tld, container) {
                    $('.availsuggestdomain').hide();
                    loaded_domain = 0;
                    //$("#view_more").parent().remove();
                    var start = counter;
                    var end = parseInt(start + 10);
                    
                    domain_tld_arr=[];
                    for(i=0;i<end;i++)
                    {
                     //all_domain_tld[0]=tld;
                     domain_tld_arr.push(all_domain_tld[i]);
            }
                  load_suggestion(domain, domain_tld_arr, container,counter);
            }


             function load_suggestion(domain, ext, container,counttld) {

    active_req = false;
            var pricingdoainsugg=0;
            var pricee = [];
            var full_domain = domain + "." + ext;
            //var loader_id = full_domain.replace(/\./g, "_");

            var token = $('#_token').val();
            //$("#ajax_hide").hide();
            showLoader();
            var req = $.ajax({
            url: "{{url('/domainsuggestion')}}",
                    data: "domainname=" + domain + "&tld=" + ext + "&currency=<?= $currency ?>" + "&loadtlds="+counttld,
                    type: "get",
                    async: true,
                    success: function(response) {
                              hideLoader();
                              var ftotal=0, status, pricing, allpricing, domain_key, dclass;
                              var total=0;
                            
                              var checked_domain
                              if (response) {
                                $('.availsuggestdomain').show();
                                $("#ajax_replace_total").click();
                                $.each(response, function (i, item) {

                                total_search++;
                                $("#total_search").html(total_search);
                                var loader_id = response[i]["domainname"].replace(/\./g, "_");
                                loaded_domain++;
                                counter++;

                                status = response[i]["status"];

                                if (status == 'available') {

                                    dclass = "";
                                    pricing = response[i]["pricing"]["available"];

                                    //display domains as suggestion
                                    $(".availsuggestdomain").show();
                                    if(counter<4)
                                    {   
                                        total += eval(pricing);
                                        $("#suggestDomain").append("<li>"+response[i]["domainname"]+"</li>");
                                            
                                        $("#hiddenDomainName").append("<input type='hidden' value="+counter+" class='domaincounter'>");  

                                        $("#domainSprice").text(total.toFixed(2));        
                                    }
                                    
                                }
                                else {
                                    dclass = "red";
                                    pricing = response[i]["pricing"]["available"];
                                }

                               
                              var str = '<tr class="listing_loader" id="loader_' + loader_id + '" ><td class="sort_domain"> <div class="c-radio-btn d-flex"><label class="custom-radio"><input type="checkbox"> <span class="checkmark"></span>' + response[i]["domainname"] + '</label></div></td><td colspan="3" class="loading_text"><i class="fa fa-spinner fa-spin"></i>&nbsp;Checking...</td></tr>';
                               $(container).append(str);

                    $("#appenddata").html();
//                 
                    allTLDsPrice[response[i]['tld']] = response[i]["allpricing"]["available"];
//                          
                    $("#loader_" + loader_id).show();
                   
                  
                    domain_key = response[i]["session_key"];
                    var appned_data;
                    
                    if (domain_key >= '0') {
                    checked_domain = "checked";
                    }
                    else{
                    checked_domain = "";
                    }
//                    appned_data += '<tr id="filter_availibity_' + counter + '">';
                  
                    appned_data += '<td class="sort_domain"> <div class="c-radio-btn d-flex"><input type="hidden" id="h_tld" name="h_tld[]" value="' + response[i]['tld'] + '"/><input type="hidden" id="tld_' + counter + '" name="tld[]" value=".' + response[i]['tld'] + '" disabled="disabled"/><input type="hidden" id="domaintype_' + counter + '" name="domaintype[]" disabled="disabled" value="register"/> <input type="hidden" id="producttype_' + counter + '" name="producttype[]" disabled="disabled" value="domain"/> <input type="hidden" id="regperiod_' + counter + '" name="regperiod[]" value="1" class="regperiod" disabled="disabled" />';
                            if (status == 'available') 
                            {
                    appned_data += '<label class="custom-radio"><input type="checkbox" name="domain[]" '+checked_domain+' id="domain_' + counter + '" value="' + domain + '.' + response[i]['tld'] + '" class="checkboxtype " onclick="addCartItems(' + counter + ', this);"> <span class="checkmark"></span>' + domain + '.' + response[i]['tld'] + '</label>';
                    } else {
                    appned_data += '<label class="custom-radio">' + response[i]["domainname"] + '</label>';
                    }

                    appned_data += '</div><span class="mobile_price d-md-none d-block"><i class="rupees_icon" id="var_price_mobile' + counter + '"><?= $currency_symbol ?></i></span></td>';
                            appned_data += '<td class="m-hide sort_status"><span class="status ' + dclass + '" id="var_available_' + counter + '"></span></td>';
                            appned_data += '<td class="text-center m-hide price_option"><span class="price" id="filter_price"><i class="rupees_icon" id="var_price_' + counter + '"><?= $currency_symbol ?></i></span></td>';
                            if (domain_key >= '0') {

                    appned_data += '<td class="text-right" id="cart_add_' + counter + '"><span class="added"><i class="fa fa-check"></i>Added</span><a href="javascript:;"  onclick="removeCartItem(' + counter + ',this,' + domain_key + ');"  class="remove-link" title="Remove"><i class="fa fa-times-circle"></i>Remove</a></td>';
                    }
                    else if (status == 'available' && !domain_key) {

                    appned_data += '<td class="text-right" id="cart_add_' + counter + '"><a href="javascript:void(0);"  class="btn addcart_btn" title="Select" onclick="addCartItems(' + counter + ', this);">Select</a></td>';
                    }
                    else {
                    var transfer_link = SITE_URL + '/domain/domain-transfer';
                            appned_data += '<td class="text-right" id="transfer_' + counter + '"><a href="javascript:void(0);" onclick="setdomainname(this);" data-toggle="modal" data-target="#commonPopup" class="btn inquiry_btn"  title="Inquiry of ' + response[i]["domainname"] + '"><i class="info_icon"></i><span class="">Inquiry</span></a><a href="' + transfer_link + '" target="_blank" class="btn transfer_btn" title="Transfer">Transfer</a> </td>';
                    }
//                    appned_data += '</tr>';
                    $("#loader_" + loader_id).html(appned_data);
//                  $(container).append(appned_data);
                    if (eval(loaded_domain) == eval(limit_domain)) {
                    $("#loader_" + loader_id).attr("class", "last_row_" + counter);
                    }
                    if (status == 'available')
                    {           
                            $("#var_available_" + counter).html("Available");
                            $("#domain_" + counter).addClass("available");
                            $("#loader_" + loader_id).attr("id", "filter_available");
                            totalavailable++;
                            $("#total_available").html(totalavailable);
                            $('#ajax_replace_available').attr('title', totalavailable + " Available");
                    }
                    else {
                    $("#var_available_" + counter).html("Not Available");
                            $("#domain_" + counter).removeClass("available");
                            $("#loader_" + loader_id).attr("id", "filter_taken");
                            taken++;
                            $("#hide_taken").val(taken);
                            $("#total_taken").html(taken);
                            $('#ajax_replace_taken').attr('title', taken + " Taken");
                    }

                    $('#var_price_' + counter).after(parseFloat(pricing));
                            $('#var_price_mobile' + counter).after(parseFloat(pricing));
//                    if (eval(loaded_domain) < eval(limit_domain) && counter != all_domain_tld.length)
//
//                    {
//
//                        if (counter <= all_domain_tld.length) {
//
//
//                            load_suggestion(domain, all_domain_tld[counter], '#appenddata');
//                        }
//
//                    }

                            if (eval(loaded_domain) == eval(limit_domain) && counter != all_domain_tld.length)

                    {
                    active_req = true;
                            $("#ajax_hide").show();
                            var div_id = "#appenddata";
                                $("#view_more").parent().remove();
                            $(".table-responsive").append('<div class="view_more aos-init aos-animate"><a href="javascript:;" onclick="load_tlddata(\'' + domain + '\',\'' + counter + '\',\'' + div_id + '\');" class="btn view_more" title="View More" id="view_more">View More..</a> </div></td></tr>');
                    }

                    if (counter == all_domain_tld.length)
                    {
                    active_req = true;
                    }



                              }); 
                         }

                    }

            });
            ajax_req.push(req);

                              
    }

     // backup function of load_suggestion       
    /*function load_suggestion(domain, ext, container) {  

    active_req = false;
    var pricingdoainsugg=0;
     var pricee = [];
            var full_domain = domain + "." + ext;
            var loader_id = full_domain.replace(/\./g, "_");
            var str = '<tr class="listing_loader" id="loader_' + loader_id + '" ><td class="sort_domain"> <div class="c-radio-btn d-flex"><label class="custom-radio"><input type="checkbox"> <span class="checkmark"></span>' + full_domain + '</label></div></td><td colspan="3" class="loading_text"><i class="fa fa-spinner fa-spin"></i>&nbsp;Checking...</td></tr>';
            total_search++;
            $("#total_search").html(total_search);
            $(container).append(str);
            var token = $('#_token').val();
            $("#ajax_hide").hide();
            var req = $.ajax({
            url: "{{url('/domainsuggestion')}}",
                    data: "domainname=" + full_domain + "&tld=" + ext + "&currency=<?= $currency ?>",
                    type: "get",
                    async: true,
                    success: function(response) {

                    counter++;
                            var checked_domain
                            loaded_domain++;
                            if (response) {
//                    $('.listing_loader').remove();
//                    $(".loader_" + loader_id).remove();
                            var ftotal=0, status, pricing, allpricing, domain_key, dclass;
                            allTLDsPrice[ext] = response["allpricing"];
//                            $("#filter_availibity_" + counter).show();
                            $("#loader_" + loader_id).show();
                            //domain = response["domainname"];
                            status = response["status"];
                            domain_key = response["session_key"];
                            var appned_data;
                            if (status == 'available') {
                               
                            $("#suggestDomain").append("<li>"+response["domainname"]+"</li>");
                            
                            pricingdoainsugg+=response["pricing"]["available"];
                            
                            $("#domainSprice").append("<span class='price' id='suggestdomainprice'>"+pricingdoainsugg+"</span>");

                    dclass = "";
                            pricing = response["pricing"]["available"];
                    }
                    else {
                    dclass = "red";
                            pricing = response["pricing"]["available"];
                    }

                    if (domain_key >= '0') {
                    checked_domain = "checked";
                    }
                    else{
                    checked_domain = "";
                    }
//                    appned_data += '<tr id="filter_availibity_' + counter + '">';

                    appned_data += '<td class="sort_domain"> <div class="c-radio-btn d-flex"><input type="hidden" id="h_tld" name="h_tld[]" value="' + ext + '"/><input type="hidden" id="tld_' + counter + '" name="tld[]" value=".' + ext + '" disabled="disabled"/><input type="hidden" id="domaintype_' + counter + '" name="domaintype[]" disabled="disabled" value="register"/> <input type="hidden" id="producttype_' + counter + '" name="producttype[]" disabled="disabled" value="domain"/> <input type="hidden" id="regperiod_' + counter + '" name="regperiod[]" value="1" class="regperiod" disabled="disabled" />';
                            if (status == 'available') {
                    appned_data += '<label class="custom-radio"><input type="checkbox" name="domain[]" '+checked_domain+' id="domain_' + counter + '" value="' + domain + '.' + ext + '" class="checkboxtype " onclick="addCartItems(' + counter + ', this);"> <span class="checkmark"></span>' + domain + '.' + ext + '</label>';
                    } else {
                    appned_data += '<label class="custom-radio">' + domain + '.' + ext + '</label>';
                    }
                    appned_data += '</div><span class="mobile_price d-md-none d-block"><i class="rupees_icon" id="var_price_mobile' + counter + '"><?= $currency_symbol ?></i></span></td>';
                            appned_data += '<td class="m-hide sort_status"><span class="status ' + dclass + '" id="var_available_' + counter + '"></span></td>';
                            appned_data += '<td class="text-center m-hide price_option"><span class="price" id="filter_price"><i class="rupees_icon" id="var_price_' + counter + '"><?= $currency_symbol ?></i></span></td>';
                            if (domain_key >= '0') {

                    appned_data += '<td class="text-right" id="cart_add_' + counter + '"><span class="added"><i class="fa fa-check"></i>Added</span><a href="javascript:;"  onclick="removeCartItem(' + counter + ',this,' + domain_key + ');"  class="remove-link" title="Remove"><i class="fa fa-times-circle"></i>Remove</a></td>';
                    }
                    else if (status == 'available' && !domain_key) {

                    appned_data += '<td class="text-right" id="cart_add_' + counter + '"><a href="javascript:void(0);"  class="btn addcart_btn" title="Select" onclick="addCartItems(' + counter + ', this);">Select</a></td>';
                    }
                    else {
                    var transfer_link = SITE_URL + '/domain/domain-transfer';
                            appned_data += '<td class="text-right" id="transfer_' + counter + '"><a href="javascript:void(0);" onclick="setdomainname(this);" data-toggle="modal" data-target="#commonPopup" class="btn inquiry_btn"  title="Inquiry of ' + full_domain + '"><i class="info_icon"></i><span class="">Inquiry</span></a><a href="' + transfer_link + '" target="_blank" class="btn transfer_btn" title="Transfer">Transfer</a> </td>';
                    }
//                    appned_data += '</tr>';
                    $("#loader_" + loader_id).html(appned_data);
//                            $(container).append(appned_data);
                            if (eval(loaded_domain) == eval(limit_domain)) {
                    $("#loader_" + loader_id).attr("class", "last_row_" + counter);
                    }
                    if (status == 'available') {
                    $("#var_available_" + counter).html("Available");
                            $("#domain_" + counter).addClass("available");
                            $("#loader_" + loader_id).attr("id", "filter_available");
                            totalavailable++;
                            $("#total_available").html(totalavailable);
                            $('#ajax_replace_available').attr('title', totalavailable + " Available");
                    }
                    else {
                    $("#var_available_" + counter).html("Not Available");
                            $("#domain_" + counter).removeClass("available");
                            $("#loader_" + loader_id).attr("id", "filter_taken");
                            taken++;
                            $("#hide_taken").val(taken);
                            $("#total_taken").html(taken);
                            $('#ajax_replace_taken').attr('title', taken + " Taken");
                    }

                    $('#var_price_' + counter).after(parseFloat(pricing));
                            $('#var_price_mobile' + counter).after(parseFloat(pricing));
//                    if (eval(loaded_domain) < eval(limit_domain) && counter != all_domain_tld.length)
//
//                    {
//
//                        if (counter <= all_domain_tld.length) {
//
//
//                            load_suggestion(domain, all_domain_tld[counter], '#appenddata');
//                        }
//
//                    }

                            if (eval(loaded_domain) == eval(limit_domain) && counter != all_domain_tld.length)

                    {
                    active_req = true;
                            $("#ajax_hide").show();
                            var div_id = "#appenddata";
                            $(".table-responsive").append('<div class="view_more aos-init aos-animate"><a href="javascript:;" onclick="load_tlddata(\'' + domain + '\',\'' + counter + '\',\'' + div_id + '\');" class="btn view_more" title="View More" id="view_more">View More..</a> </div></td></tr>');
                    }

                    if (counter == all_domain_tld.length)

                    {
                    active_req = true;
                    }

                    }

                    }

            });
            ajax_req.push(req);


    }*/

    function setdomainname(type) {
    var title = $(type).attr("title");
            var title_rep = title.split("Inquiry of");
            $("#dname").val(trim(title_rep[1]));
    }


//    function load_moreSuggestion(d)
//
//    {
//        loaded_domain = 0;
//
//        $("#view_more").parent().remove();
//
//        load_suggestion(d, all_domain_tld[counter], '#appenddata');
//    }



    function show_filter_domains(type) {

    if (type == 'available') {
    $(".view_more").hide();
            $("#appenddata tr:not(#filter_taken)").show();
            $("#appenddata tr:not(#filter_available)").hide();
//            $("#filter_available").css("display","");
            $("#ajax_replace_taken").removeClass("fill");
            $("#ajax_replace_total").removeClass("fill");
            $("#ajax_replace_available").removeClass("border_btn");
            $("#ajax_replace_available").addClass("btn fill");
            $("#ajax_replace_total").addClass("border_btn");
            $("#ajax_replace_taken").addClass("border_btn");
//            $(".loader").hide();
            $("#no_records").hide();
    }
    else if (type == 'taken') {
    $(".view_more").hide();
            $("#appenddata tr:not(#filter_taken)").hide();
            $("#appenddata tr:not(#filter_available)").show();
            $("#ajax_replace_total").removeClass("fill");
//             $("#filter_available").css("display","");
            $("#ajax_replace_available").removeClass("fill");
            $("#ajax_replace_available").addClass("border_btn");
            $("#ajax_replace_total").addClass("border_btn");
            $("#ajax_replace_taken").removeClass("border_btn");
            $("#ajax_replace_taken").addClass("btn fill");
//            $(".loader").hide();
            if ($("#appenddata").find("#filter_taken").length == 0 && $("#appenddata").find("#no_records").length == 0) {
    $("#appenddata").append("<tr id='no_records'><td colspan='4'><center>Sorry! no records are found.</center></td></tr>");
    }


    }
    else if (type == 'all') {
    $(".view_more").show();
            $("#appenddata tr:not(#filter_available)").show();
            $("#appenddata tr:not(#filter_taken)").show();
//            $("#filter_available").css("display","");
            $("#ajax_replace_taken").removeClass("fill");
            $("#ajax_replace_available").removeClass("fill");
            $("#ajax_replace_taken").addClass("border_btn");
            $("#ajax_replace_available").addClass("border_btn");
            $("#ajax_replace_total").removeClass("border_btn");
            $("#ajax_replace_total").addClass("btn fill");
//            $(".loader").hide();
            $("#no_records").hide();
    }
    }

    function addCartItemsOld(frmkey, ele) {

    if (!active_req){
    alert("Please wait until domain search process to be completed.");
    }
    else
    {
    showLoader();
            $("#domain_" + frmkey).attr("Checked", "Checked");
            $("#tld_" + frmkey).attr("disabled", false);
            $("#regperiod_" + frmkey).attr("disabled", false);
            $("#domaintype_" + frmkey).attr("disabled", false);
            $("#producttype_" + frmkey).attr("disabled", false);
//            $("#dvprocessing").show();

            //        var total_products = $("#total_product").val();
            var formData = $("#suggestedDomainFrm").serialize();
            $.ajax({
//            url: "{{url('/addtocart')}}"+"?landing=y",
            url: "{{url('cart/store?landingdomain=y')}}",
                    data: formData,
                    type: "post",
                    async: true,
                    success: function(response) {
                    if (response) {
                    hideLoader();
//                    $("#dvprocessing").hide();
                            //                    total_products++;
                            cart_count++;
                            $("#cart_cout").show();
                            $.each(response, function(key, domain) {
                            console.log("key>>" + key);
                                    console.log("domain>>" + domain);
                                    var domain_rep = domain.replace(/\./g, "_");
//                                    var org_domain = domain.replace("_", ".");
                                    var org_domain = domain.replace(/\_/g, ".");
                                    remove_key.push(key);
                                    $("#total_product").val(cart_count);
                                    $("#total_items").html(cart_count);
                                    $("#cart_cout").html(cart_count);
                                    $("#checkout_total").html('Continue to Checkout');
                                    $("#checkout_items").show();
                                    $("#cart_add_" + frmkey).empty();
                                    $("#domain_" + frmkey).replaceWith('<input type="checkbox" name="domain[]" id="domain_' + frmkey + '" value="' + org_domain + '" class="checkboxtype available" onclick="removeCartItem(' + frmkey + ',this,' + key + ');" checked="Checked">');
                                    $("#cart_add_" + frmkey).html('<span class="added"><i class="fa fa-check"></i>Added</span><a href="javascript:;"  id="' + domain_rep + '" onclick="removeCartItem(' + frmkey + ',this,' + key + ');"  class="remove-link" title="Remove"><i class="fa fa-times-circle"></i>Remove</a>');
                            });
                    }
                    }
            });
    }
    }
    var selectedDomainArr = [];
            function addCartItems(frmkey, ele) {
            active_req = true;
                    if (!active_req){ alert("Please wait until domain search process to be completed."); }
            else
            {
            showLoader();
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
                    $.ajax({
                    url: "{{url('cart/addbulkdomain')}}",
                            data: "ptype=" + ptype + "&dtype=" + dtype + "&reg=" + reg + "&tld=" + tld + "&domain=" + dname + "&i=" + selectedDomainArr.length,
                            type: "post",
                            async: true,
                            success: function(response) {
                            response = JSON.parse(response);
                                    if (response) {
                            hideLoader();
                                    cart_count++;
                                    //$("#cart_cout").show();
                                    //$.each(response, function(key, domain) {

                                    selectedDomainArr.push(response);
                                    key = selectedDomainArr.length - 1;
                                    var domain_rep = response.domain.replace(/\./g, "_");
                                    var org_domain = response.domain.replace(/\_/g, ".");
                                    remove_key.push(key);
                                    $("#total_product").val(cart_count);
                                    $("#total_items").html(cart_count);
                                    //$("#cart_cout").html(cart_count);
                                    $("#checkout_total").show();
                                    $("#checkout_total").html('Continue to Checkout');
                                    $("#checkout_items").show();
                                    $("#cart_add_" + frmkey).empty();
                                    $("#domain_" + frmkey).replaceWith('<input type="checkbox" name="domain[]" id="domain_' + frmkey + '" value="' + org_domain + '" class="checkboxtype available" onclick="removeCartItem(' + frmkey + ',this,' + key + ');" checked="Checked">');
                                    $("#cart_add_" + frmkey).html('<span class="added"><i class="fa fa-check"></i>Added</span><a href="javascript:;"  id="' + domain_rep + '" onclick="removeCartItem(' + frmkey + ',this,' + key + ');"  class="remove-link" title="Remove"><i class="fa fa-times-circle"></i>Remove</a>');
                                    //});
                            }

                            }
                    });
            }
            }


    function addRemoveLocalStorage(params, action){
    var selectedDomains = [];
            if (localStorage.hasOwnProperty('selected_domains')){
    selectedDomains = JSON.parse(localStorage.getItem('selected_domains'));
    }

    if (action == 'remove'){
    $.each(selectedDomains, function(index, itemData){
    if (itemData && itemData['domain'] == params['domain']){
    //delete selectedDomains[index]; //remove item
    selectedDomains.splice(index, 1);
    }
    });
    }

    else if (action == 'add'){
    selectedDomains.push(params);
    }

    localStorage.setItem('selected_domains', JSON.stringify(selectedDomains));
    }

    //Add Suggested Domain To Cart
    function addSuggestedDomainItems()
    {       
        /*    var domainprice=[];
            var domainname=[];
            var domaincounter=[];
        $.each($('.domainsugg'), function (index, value) {
                   domainprice=$(this).val();
        });

        $.each($('.suggestdomainname'), function (index, value) {
                   domainname=$(this).val();
        });*/

        $.each($('.domaincounter'), function (index, value) {
                   var domaincounter=$(this).val();
                  
                   addCartItems(domaincounter, this);

                       $("#main_cartt").replaceWith('<div class="listing-add-remove removeSuggesteddomain"> <span class="added-list remove_span"><i class="fa fa-check"></i>Added</span><a href="javascript:;"  onclick="removeSuggestedDomainItem();" class="remove-list top_domain"><i class="fa fa-times-circle"></i>Remove</a> </div>');
        });

        $(".more_available_items").hide();
    }

    function removeSuggestedDomainItem()
    {
        $.each($('.domaincounter'), function (index, value) {
                   var domaincounter=$(this).val();
                   
                 removesingleCartItem(domaincounter);

                       $(".removeSuggesteddomain").replaceWith('<a href="javascript:void(0)" class="btn" id="main_cartt" onclick="addSuggestedDomainItems();" title="Add to Cart">Add to Cart</a>');
                       
                       var domain_val = $("#domain_" + domaincounter).val();
                            $("#cart_add_" + domaincounter).empty();
                            $("#domain_" + domaincounter).replaceWith('<input type="checkbox" name="domain[]" id="domain_' + domaincounter + '" value="' + domain_val + '" class="checkboxtype available" onclick="addCartItems(' + domaincounter + ', this);" >');
                            $("#cart_add_" + domaincounter).html('<a href="javascript:void(0);" class="btn addcart_btn" title="Select" onclick="addCartItems(' + domaincounter + ', this);">Select</a>');
        });
    }


    function addsingleCartItems() {
    active_req = true;
            if (!active_req){
    alert("Please wait until domain search process to be completed.");
    }
    else{
    $("#domain_main").attr("Checked", "Checked");
            var formData = $("#singleDomainFrm").serialize();
            showLoader();
            
            var dname = $("#domain_main").val();
            var tld = $("#tld_main").val();
            var reg = $("#regperiod_main").val();
            var dtype = $("#domaintype_main").val();
            var ptype = $("#producttype_main").val();

            $.ajax({
            url: "{{url('cart/addbulkdomain')}}",
                    data: "ptype=" + ptype + "&dtype=" + dtype + "&reg=" + reg + "&tld=" + tld + "&domain=" + dname + "&i=" + selectedDomainArr.length,
                    //url: "{{url('cart/store?landingdomain=y')}}",
                    //data: formData,
                    type: "post",
                    async: true,
                    success: function(response) {
                    response = JSON.parse(response);
                            if (response) {
                    hideLoader();
                            cart_count++;
                            $("#total_product").val(cart_count);
                            $("#total_items").html(cart_count);
                            //$("#cart_cout").html(cart_count); $("#cart_cout").show();
                            $("#checkout_total").show();
                            $("#checkout_total").html('Continue to Checkout');
                            $("#checkout_items").show();
                            //$.each(response, function(key, domain) {
                            selectedDomainArr.push(response);
                            key = selectedDomainArr.length - 1;
                            //console.log("Add: "+ key +":" + response);
                            var main_hidden_val = $("#domain_main").val();
                            if (response.domain.replace(/\./g, "_") == main_hidden_val.replace(/\./g, "_"))
                    {
                    var domain_rep = response.domain.replace(/\./g, "_");
                            $("#top_domain").addClass("border_none");
                            $("#main_cart").replaceWith('<div class="listing-add-remove"> <span class="added-list remove_span"><i class="fa fa-check"></i>Added</span><a href="javascript:;" id="' + domain_rep + '" onclick="removesingleCartItem(' + key + ');" class="remove-list top_domain"><i class="fa fa-times-circle"></i>Remove</a> </div>');
                    }


                    //});
                    }
                    },
                    error: function(data, textStatus, errorThrown) {
                    console.log(data);
                            console.log(textStatus);
                            console.log(errorThrown);
                    }
            });
    }
    }

    function addsingleCartItemsOld() {
    if (!active_req){
    alert("Please wait until domain search process to be completed.");
    }
    else{
    $("#domain_main").attr("Checked", "Checked");
            var formData = $("#singleDomainFrm").serialize();
//            $("#dvprocessing").show();
            showLoader();
            $.ajax({
//            url: "{{url('/addtocart')}}",
            url: "{{url('cart/store?landingdomain=y')}}",
                    data: formData,
                    type: "post",
                    async: true,
                    success: function(response) {
                    if (response) {
//                    $("#dvprocessing").hide();
                    hideLoader();
                            cart_count++;
                            $("#total_product").val(cart_count);
                            $("#total_items").html(cart_count);
                            $("#cart_cout").html(cart_count);
                            $("#cart_cout").show();
                            $("#checkout_total").html('Continue to Checkout');
                            $("#checkout_items").show();
                            $.each(response, function(key, domain) {

                            var main_hidden_val = $("#domain_main").val();
                                    if (domain == main_hidden_val.replace(/\./g, "_"))
                            {
                            var domain_rep = domain.replace(/\./g, "_");
                                    $("#top_domain").addClass("border_none");
//                                $("#main_cart").replaceWith('<span class="added remove_span"><i class="fa fa-check"></i>Added</span><a href="javascript:;" id="' + domain_rep + '" onclick="removesingleCartItem(' + key + ');"  class="remove-link top_domain" title="Remove"><i class="fa fa-times-circle"></i>Remove</a>');
                                    $("#main_cart").replaceWith('<div class="listing-add-remove"> <span class="added-list remove_span"><i class="fa fa-check"></i>Added</span><a href="javascript:;" id="' + domain_rep + '" onclick="removesingleCartItem(' + key + ');" class="remove-list top_domain"><i class="fa fa-times-circle"></i>Remove</a> </div>');
                            }


                            });
                    }
                    },
                    error: function(data, textStatus, errorThrown) {
                    console.log(data);
                            console.log(textStatus);
                            console.log(errorThrown);
                    }
            });
    }
    }

    function removeCartItem(frmkey, ele, key, conf = false) {
      //var cart_count = eval($("#cart_cout").html());
        
            active_req = true;
            if (!active_req) {
                alert("Please wait until domain search process to be completed.");
            } else {

    if (conf || confirm('Are you sure, you want to remove selected item from the cart?')) {
    var formData = $("#suggestedDomainFrm").serialize();
            showLoader();
            $.ajax({
            url: "{{url('/removecart')}}",
            //url: "{{url('cart/removebulkdomain')}}",
                    data: formData + "&ele_key=" + key,
                    type: "post",
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                       selectedDomainArr.pop(response);
                    $(selectedDomainArr).each(function(index, item){
                    console.log(item.key);
                    //selectedDomainArr.pop(response);
                    // if (item.key == key){
                    // //console.log("Remove: " + index + ":" + item[key]);
                    // selectedDomainArr.splice(index, 1);
                    // }
                    });
                            if (response) {
                            hideLoader();

                            cart_count--;
                            remove_key.splice($.inArray(key, remove_key), 1);

                            if (cart_count == 0) {
                    $("#checkout_items").hide();
                    $("#checkout_total").show();
                    }
                    else
                    {
                         $("#checkout_items").show();
                    $("#total_items").html(cart_count);
                            $("#cart_cout").html(cart_count);
                            $("#checkout_total").html('Continue to Checkout');
                    }

                    var domain_val = $("#domain_" + frmkey).val();
                            $("#cart_add_" + frmkey).empty();
                            $("#domain_" + frmkey).replaceWith('<input type="checkbox" name="domain[]" id="domain_' + frmkey + '" value="' + domain_val + '" class="checkboxtype available" onclick="addCartItems(' + frmkey + ', this);" >');
                            $("#cart_add_" + frmkey).html('<a href="javascript:void(0);" class="btn addcart_btn" title="Select" onclick="addCartItems(' + frmkey + ', this);">Select</a>');
                    }
                    }
            });
    }
    }
    }

    function removeCartItemOld(frmkey, ele, key) {

    if (!active_req) {
    alert("Please wait until domain search process to be completed.");
    } else {

    if (confirm('Are you sure, you want to remove selected item from the cart?')) {
    var formData = $("#suggestedDomainFrm").serialize();
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
                    hideLoader();
                            cart_count--;
                            remove_key.splice($.inArray(key, remove_key), 1);
                            if (cart_count == 0) {
                    $("#checkout_items").hide();
                            $("#cart_cout").hide();
                    }
                    else
                    {
                         $("#checkout_items").show();
                    $("#total_items").html(cart_count);
                            $("#cart_cout").html(cart_count);
                            $("#checkout_total").html('Continue to Checkout');
                    }

                    var domain_val = $("#domain_" + frmkey).val();
                            $("#cart_add_" + frmkey).empty();
                            $("#domain_" + frmkey).replaceWith('<input type="checkbox" name="domain[]" id="domain_' + frmkey + '" value="' + domain_val + '" class="checkboxtype available" onclick="addCartItems(' + frmkey + ', this);" >');
                            $("#cart_add_" + frmkey).html('<a href="javascript:void(0);" class="btn addcart_btn" title="Select" onclick="addCartItems(' + frmkey + ', this);">Select</a>');
                    }
                    }
            });
    }
    }
    }

    function removesingleCartItem(key) {
    active_req = true;
            if (!active_req) { alert("Please wait until domain search process to be completed."); }
    else{
    
    /*if(suggestion!="")
    {
        var msg=confirm('Are you sure, you want to remove selected item from the cart?');
    }
    else
    {
        var msg="1";
    }*/

    if(confirm('Are you sure, you want to remove selected item from the cart?')) 
    {
    var formData = $("#singleDomainFrm").serialize();
            showLoader();
            $.ajax({
            url: "{{url('cart/removebulkdomain')}}",
                    //url: "{{url('/removecart')}}",
                    data: formData + "&ele_key=" + key,
                    type: "post",
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                    if (response) {
                    $(selectedDomainArr).each(function(index, item){
                    console.log(item.key);
                            if (item.key == key){
                    //console.log("Remove: " + index + ":" + item[key]);
                    selectedDomainArr.splice(index, 1);
                    }
                    });
                            hideLoader();
                            cart_count--;
                            if (cart_count == 0) {
                    $("#checkout_items").hide();
                    $("#checkout_total").show();
                    
                    }
                    else {
                         $("#checkout_items").show();
                    $("#total_items").html(cart_count);
                            $("#cart_cout").html(cart_count);
                            $("#checkout_total").html('Continue to Checkout');
                    }

                    $("#top_domain").removeClass("border_none");
//                            $(".remove_span").remove();
                            $(".listing-add-remove").replaceWith('<a href="javascript:;" class="btn" title="Inquire Now" id="main_cart" onclick="addsingleCartItems();">Select</a>');
//                            $(".top_domain").parent().remove();
                    }
                    }
            });
    }
    }
    }

    function removesingleCartItemOld(key) {
    if (!active_req) {
    alert("Please wait until domain search process to be completed.");
    }
    else{
    if (confirm('Are you sure, you want to remove selected item from the cart?')) {
    var formData = $("#singleDomainFrm").serialize();
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
//                    $("#dvprocessing").hide();
                    hideLoader();
                            cart_count--;
                            if (cart_count == 0) {
                    $("#checkout_items").hide();
                            $("#cart_cout").hide();
                    }
                    else {
                         $("#checkout_items").show();
                    $("#total_items").html(cart_count);
                            $("#checkout_total").html('Continue to Checkout');
                    }

                    $("#top_domain").removeClass("border_none");
//                            $(".remove_span").remove();
                            $(".listing-add-remove").replaceWith('<a href="javascript:;" class="btn" title="Inquire Now" id="main_cart" onclick="addsingleCartItems();">Select</a>');
//                            $(".top_domain").parent().remove();
                    }
                    }
            });
    }
    }
    }



    function getdomainpricing(tld, domainname, duration) {
        
    $("#appenddata tr").each(function(i, ele) {
    var tld2 = $(ele).find("#h_tld").val();
            var update_price;
            var availdomainprice;
            if (typeof tld2 != "undefined") {
                //alert(this.id);
    if (this.id == 'filter_taken') {
        console.log("allTLDsPrice[" + tld2 + "][transfer][Price" + duration + "]");
        update_price = allTLDsPrice[tld2]["transfer"]["Price" + duration];
        }
    else {
        console.log("allTLDsPrice[" + tld2 + "][available][Price" + duration + "]");
        update_price = allTLDsPrice[tld2]["available"]["Price" + duration];
    
    }
    //alert(duration + " - " + update_price);
    var str = '<span class="price" id="filter_price"><i class="rupees_icon"><?= $currency_symbol ?></i>' + parseFloat(update_price) + '</span>';
    console.log(this.id + " " + duration + " - " + update_price);
    console.log(str);
            $(ele).find("#filter_price").html(str);
            $(".regperiod").val(duration);
    }
    else {
    console.log("tld undefined");
    }
    });
    }

    $('#allextension input').click(function() {

    $(ajax_req).each(function(index, req) {
    req.abort();
    });
            ajax_req = [];
            $("#appenddata").remove();
            $("#view_more").parent().remove();
            $("#thead").after("<tbody id='appenddata'></tbody>");
            totalavailable = 0;
            taken = 0;
            inc_id = '';
            total_search = 0;
            counter = 0;
            loaded_domain = 0;
            limit_domain = 10;
            if ($(this).is(":checked")) {

    var ary = all_domain_tld;
            var select_ext = $(this).val();
            ary.remove(select_ext);
            all_domain_tld.unshift(select_ext);
    }
    else {
    var ary = all_domain_tld;
            var select_ext = $(this).val();
            ary.remove(select_ext);
    }

//        console.log("after" + all_domain_tld);
//        var start = counter;
//        var end = parseInt(start + 10);
//        for (var i = start; i < end; i++) {
//
//            load_suggestion($("#ext_domain").val(), all_domain_tld[i], '#appenddata');
//        }
    load_tlddata($("#ext_domain").val(), all_domain_tld[counter], '#appenddata');
    
    $("#suggestDomain").empty();
//        load_suggestion($("#ext_domain").val(), all_domain_tld[counter], '#appenddata');
    });
            $('#country_tld input').click(function() {
    $(ajax_req).each(function(index, req) {
    req.abort();
    });
            ajax_req = [];
            $("#appenddata").remove();
            $("#view_more").parent().remove();
            $("#thead").after("<tbody id='appenddata'></tbody>");
            totalavailable = 0;
            taken = 0;
            inc_id = '';
            total_search = 0;
            counter = 0;
            loaded_domain = 0;
            limit_domain = 10;
            all_domain_tld = country_tld;
//        console.log(all_domain_tld);

//        load_suggestion($("#ext_domain").val(), all_domain_tld[counter], '#appenddata');
            load_tlddata($("#ext_domain").val(), all_domain_tld[counter], '#appenddata');
            $("#suggestDomain").empty();
    });
            $('.checkboxtype').click(function() {
    var check_array = [];
            $("input:checkbox[name=checkboxtype]:checked").each(function() {
    check_array.push($(this).val());
    });
            var count_checkbox = check_array.length;
            if (count_checkbox > 0) {
    $(".addall").html(count_checkbox + " selected");
    }
    else {
    $(".addall").html(count_checkbox + " selected");
    }

    });
            function addalldomains(){
            $(".addcart_btn").each(function(i, ele){
    setTimeout(function(){ eval($(ele).attr('onclick')); },100);
            });
                    $(".addall").replaceWith('<a href="javascript:;" class="removeall" onclick="removealldomain()" title="Remove All" id="ajax_hide">Remove All</a>');
            }
    function removealldomain(){
    //console.log("removeall");
    $(".remove-link").each(function(i, ele){
    var str = $(ele).attr('onclick').toString();
            str = str.replace(");", ",true);");
            eval(str);
    });
            $(".removeall").replaceWith('<a href="javascript:;" id="ajax_hide" onclick="addalldomains()" class="addall" title="Add All +" style="">Add All +</a>');
    }

    /*$(".addall").click(function() {
     
     $(".addall").replaceWith('<a href="javascript:;" class="removeall" onclick="removeallcart();" title="Remove All" id="ajax_hide">Remove All</a>');
     $("#appenddata tr[id^='filter_available']").each(function(i, ele) {
     var total_selected = $('#appenddata tr#filter_available').length;
     var total_cart_count = parseInt(cart_count) + parseInt(total_selected);
     $("#total_items").html(total_cart_count);
     $("#checkout_total").html("CHECKOUT(" + total_cart_count + ")");
     $("#checkout_items").show();
     //            $("#appenddata tr:not(.cart_added)").each(function(i, ele) {
     
     if (cart_count != '0') {
     total_cart_count = total_cart_count;
     }
     else {
     total_cart_count = total_selected;
     }
     $("#cart_cout").html(total_cart_count);
     $("#cart_cout").show();
     var Domain_val = $(ele).find("input:checkbox[id^='domain_']").val();
     var domain_rep = Domain_val.replace(/\./g, "_");
     $(ele).find("input:checkbox[id^='domain_']").attr('checked', 'checked');
     $(ele).find("input:hidden[id^='tld_']").attr("disabled", false);
     $(ele).find("input:hidden[id^='regperiod_']").attr("disabled", false);
     $(ele).find("input:hidden[id^='domaintype_']").attr("disabled", false);
     $(ele).find("input:hidden[id^='producttype_']").attr("disabled", false);
     $(ele).find(".addcart_btn").parent().html('<span class="added"><i class="fa fa-check"></i>Added</span><a href="javascript:;" id="' + domain_rep + '"  class="remove-link" title="Remove"><i class="fa fa-times-circle"></i>Remove</a>');
     //        });
     });
     var formPostData = $("#suggestedDomainFrm").serialize();
     //            $("#dvprocessing").show();
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
     console.log(response);
     //                            $("#dvprocessing").hide();
     hideLoader();
     $.each(response, function(key, domain) {
     
     console.log(domain + ">>" + key);
     if ($("#appenddata").find("#" + domain).length > 0) {
     remove_key.push(key);
     //                        console.log(remove_key);
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
     });*/
    function removeallcart() {

    var unique_key = remove_key.unique();
            if (confirm('Are you sure? You wants to remove all item from cart!')) {
    var formData = $("#suggestedDomainFrm").serialize();
//                    $("#dvprocessing").show();
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

    $(".clear_list_link").click(function() {
        $("#suggestDomain").empty();
    $('.extension_list input:checkbox').each(function(){
    this.checked = false;
    });
//    window.location.reload();
            $(ajax_req).each(function(index, req) {
    req.abort();
    });
            ajax_req = [];
            $("#appenddata").remove();
            $("#view_more").parent().remove();
            $("#thead").after("<tbody id='appenddata'></tbody>");
            totalavailable = 0;
            taken = 0;
            total_search = 0;
            counter = 0;
            loaded_domain = 0;
            all_domain_tld = new Array(<?= $AllTlds; ?>);
            load_tlddata($("#ext_domain").val(), all_domain_tld[counter], '#appenddata');
    });
//Code updated for price issue ------------------------------------------------           
    $(function() {
        var smin = 10;
        var smax = 2500;
        $("#slider-range2").slider({
        range: true,
        min: smin,
        max: smax,
        values: [smin,smax],
        tooltip: 'always',
        slide: function(event, ui) {
                //$("#price-low").val($("#slider-range2").slider("values", 0));
                //$("#price-high").val($("#slider-range2").slider("values", 1));
                /*console.log("Min: " + ui.values[ 0 ] + "Max: " + ui.values[ 1 ]);*/
                $("#price-low").val(ui.values[ 0 ]);
                $("#price-high").val(ui.values[ 1 ]);
                
        },
        stop: function(event, ui) {
        var min = $("#price-low").val();
                //alert(min);
                var min_price = min.replace('$', '');
                var max = $("#price-high").val();
                var max_price = max.replace('$', '');
                var regperiod = $(".regperiod").val();
                $.ajax({
                url: "{{url('/pricefilter')}}",
                        data: {min: min_price, max: max_price, regperiod: regperiod, currency: '<?= $currency ?>'},
                        type: "get",
                        success: function(response) {
                        if (response == 0) {
                        alert("sorry! no any record(s) found between this price range, please search again with diffrent price range");
                                return false;
                        }
                        else {
                        $(ajax_req).each(function(index, req) {
                        req.abort();
                        });
                                ajax_req = [];
                                $("#appenddata").remove();
                                $("#view_more").parent().remove();
                                $("#thead").after("<tbody id='appenddata'></tbody>");
                                totalavailable = 0;
                                taken = 0;
                                inc_id = '';
                                total_search = 0;
                                counter = 0;
                                loaded_domain = 0;
                                limit_domain = 10;
                                all_domain_tld = response.split(',');
                                load_tlddata($("#ext_domain").val(), all_domain_tld[counter], '#appenddata');
                                $("#suggestDomain").empty();
                        }

                        }
                });
        }

});

// $( "#price-low" ).val($( "#slider-range2" ).slider("values",0));
// $( "#price-high" ).val($( "#slider-range2" ).slider("values",1));
$("#price-low").val(smin);
$("#price-high").val(smax);
});
//Code updated for price issue ------------------------------------------------
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
    unsorted = false

            for (var r = 0; r < rows.length - 1; r++)
    {
    $(".rupees_icon").html('');
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

$("#checkout_total").click(function(){
    
    if(selectedDomainArr && selectedDomainArr.length > 0){

        var postData = { };
        var vardomaintype = [];
        var vardomain = []; 
        var varproducttype = []; 
        var varregperiod = []; 
        var vartld = [];
        
        $(selectedDomainArr).each(function(index,item){
           vardomaintype.push(item.domaintype);
            vardomain.push(item.domain);
            varproducttype.push(item.producttype);
            varregperiod.push(item.regperiod);
            vartld.push(item.tld);
        });
        
        postData = {
            "domaintype":vardomaintype,"domain":vardomain,"producttype":varproducttype,"regperiod":varregperiod,"tld":vartld
            ,"_token":"{{ csrf_token() }}"
        };

        showLoader();

        $.ajax({ 
             url:"{{url('/cart/store')}}",   
            method:"post",
            data:postData,
            async:false,
            success:function(data){
                    var cart_array_items1 = '<?php echo $cart_array_items; ?>';
                    var cart_count1 = parseInt(cart_count);
                    var cart_array_items1 = parseInt(cart_array_items1)
                   if(cart_count1 == 1)
                   {
                        var limit = cart_array_items1 + 0;
                    }
                   else
                   {
                        var limit = cart_array_items1 + cart_count1 - 1;
                   }
                   
                    for(let i = cart_array_items1; i <= limit; i++) {
                        $("#auto_id").html('<button id="idprotection" onclick="addAddonsDomainNew(\'idprotection\',\'0\',\'idprotection\',\'idprotection\',\'idprotection\',this,'+i+',\'5\',\'add\',\'1\');">123</button>');
                        $("#idprotection").click();
                    }
                window.location='{{url("/cart/signin")}}';
            }  
        });
    }
    else { 
        alert("Your cart is empty. Please add something before proceeding to checkout");
        // window.location='{{url("/cart")}}';
         }
    
});


</script>

<?php //url: "{{url('/cart/store')}}", ?>

@endsection


