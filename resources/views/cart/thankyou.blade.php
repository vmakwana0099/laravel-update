@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="banner-inner ty-detail-banner" style="background-image:url(../assets/images/ty-detail-bg.jpg);">
    <div class="container">
        <div class="banner-content">
            <div class="banner-image" data-aos="zoom-in" data-aos-delay="100">
            </div>
            @if(isset($data['orderid']) && !empty($data['orderid']))
            <span class="order-title" data-aos="fade-up" data-aos-delay="200">Order#: {{$data['orderid']}}</span>
            <script language="JavaScript" type="text/javascript" src="https://affiliates.hostitsmart.com/sale.php?profile=72198&idev_saleamt=XXX&idev_ordernum={{$data['orderid']}}"></script>
            @endif
            <h1 class="thankyou-text" data-aos="fade-up" data-aos-delay="300">
                Thank you for your purchase!
            </h1>
            <span class="banner-subtitle" data-aos="fade-up" data-aos-delay="400">
                Your order is being set up.<br>
            </span>
        </div>
    </div>
</div>
<div class="ty-detail-main">
    <div class="next-steps">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title" data-aos="fade-up">
                        <h2>What's More on Host IT Smart?</h2>
                    </div>
                </div>
                @if(!empty($domainData))
	                <div class="col-sm-12">
	                    <div class="row pd-70-60 flex-sm-row-reverse">
	                        <div class="col-lg-6 col-md-6 centerprop" data-aos="fade-left">
	                            <div class="steps-image-area">
	                                <span class="dot-circle top-dot dotleft"></span>
	                                <span class="horizontal-line hleft"></span>
	                                <img src="/assets/images/ty-step1.png" alt="Matching Domains Available" title="Matching Domains Available" />
	                            </div>
	                        </div>
	                        <div class="col-lg-6 col-md-6" data-aos="fade-right">
	                            <div class="steps-content">
	                                <div class="step-no">
	                                    <h3><span>1.</span>Matching Domains Available</h3>
	                                </div>
	                                @foreach($domainData as $key => $domain)
	                                @php
	                                $t = str_replace(".","-",$key);
	                                @endphp
	                                <div class="matching-domains d-flex align-items-center">
	                                    <form id="suggestedDomainFrm_{{$t}}" name="suggestedDomainFrm_{{$t}}" action="javascript:void(0);">
	                                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
	                                        <input type="hidden" id="producttype" name="producttype[]" value="domain" />
	                                        <input type="hidden" id="domain" name="domain[]" value="{{$key}}" />
	                                        <input type="hidden" id="tld" name="tld[]" value=".{{$domain['tld']}}" />
	                                        <input type="hidden" id="domaintype" name="domaintype[]" value="register" />
	                                        <input type="hidden" id="regperiod" name="regperiod[]" value="1" />
	                                    </form>
	                                    <div class="domain-name">
	                                        {{$key}}
	                                    </div>
	                                    <div class="domain-price">
	                                        <span><i class="rp-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$domain['pricing']->register}}</span>/yr
	                                    </div>
	                                    <div class="add-btn">
	                                        <a href="javascript:void(0);" title="Add to cart" onclick="addMatchingDomain('{{$t}}',this);">Add to Cart</a>
	                                    </div>
	                                </div>
	                                @endforeach
	                            </div>
	                        </div>
	                    </div>
	                </div>
                @endif
                @if(isset($data['proData']))
                @foreach($data['proData'] as $key => $product)
	                @if(isset($product['data']->groupname))
		                @if($key % 2 == 0)
			                <div class="col-sm-12">
			                    <div class="row pd-70-60">
			                        <div class="col-lg-6 col-md-6" data-aos="fade-right">
			                            <div class="steps-image-area centerprop">
			                                <span class="dot-circle dotright"></span>
			                                <span class="horizontal-line hright"></span>
			                                <img src="/assets/images/{{$product['image']}}" alt="Build a Website" title="Build a Website" />
			                            </div>
			                        </div>
			                        <div class="col-lg-6 col-md-6" data-aos="fade-left">
			                            <div class="steps-content left-pd">
			                                <div class="step-no">
			                                    <h3><span>@if(!empty($domainData)){{$key}} @else {{$key + 1}} @endif.</span>{{$product['data']->groupname}} - {{$product['data']->productname}}</h3>
			                                </div>
			                                <div class="steps-inner">
			                                    <p class="steps-para">
			                                        {{$product['data']->shortDesc}}
			                                    </p>
			                                    <p class="steps-mainp">
			                                        Add {{$product['data']->groupname}} from just
			                                    </p>
			                                    <p class="just-price">
			                                        just<span><i class="rp-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
			                                            @if($product['pricing'][6]->price > 0)
			                                            {{$product['pricing'][6]->price/36}}/mo
			                                            @elseif($product['pricing'][5]->price > 0)
			                                            {{$product['pricing'][5]->price/24}}/mo
			                                            @elseif($product['pricing'][4]->price > 0)
			                                            @if($product['data']->groupname == "SSL Certificate")
			                                            {{$product['pricing'][4]->price}}/yr
			                                            @else
			                                            {{$product['pricing'][4]->price/12}}/mo
			                                            @endif
			                                            @elseif($product['pricing'][3]->price > 0)
			                                            {{$product['pricing'][3]->price/6}}/mo
			                                            @elseif($product['pricing'][2]->price > 0)
			                                            {{$product['pricing'][2]->price/3}}/mo
			                                            @elseif($product['pricing'][1]->price > 0)
			                                            {{$product['pricing'][1]->price}}/mo
			                                            @endif
			                                        </span>
			                                    </p>
			                                    @php
			                                    $protype = '';
			                                    $recomArr = unserialize(Config::get('producttypesArr'));
			                                    if(isset($product['data']->fkWhmcsProduct)){
			                                    $protype = $recomArr[$product['data']->fkWhmcsProduct];
			                                    //echo $protype . "-".$product['data']->fkWhmcsProduct;
			                                    }
			                                    @endphp
			                                    <div class="add-btn">
			                                        @if($product['pricing'][1]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][1]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][2]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][2]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][3]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][3]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][4]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][4]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][5]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][5]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][6]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][6]->durationame}}',this);">Add to Cart</a>
			                                        @endif
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
		                @else
			                <div class="col-sm-12">
			                    <div class="row pd-70-60 flex-sm-row-reverse">
			                        <div class="col-lg-6 col-md-6 centerprop" data-aos="fade-left">
			                            <div class="steps-image-area">
			                                <span class="dot-circle dotleft"></span>
			                                <span class="horizontal-line hleft"></span>
			                                <img src="/assets/images/{{$product['image']}}" alt="Host your Website in Wordpress" title="Host your Website in Wordpress" />
			                            </div>
			                        </div>
			                        <div class="col-lg-6 col-md-6" data-aos="fade-right">
			                            <div class="steps-content">
			                                <div class="step-no">
			                                    <h3><span>@if(!empty($domainData)){{$key}} @else {{$key + 1}} @endif.</span>
			                                        {{$product['data']->groupname}} - {{$product['data']->productname}}</h3>
			                                </div>
			                                <div class="steps-inner">
			                                    <p class="steps-para">
			                                        {{$product['data']->shortDesc}}
			                                    </p>
			                                    <p class="steps-mainp">
			                                        Add {{$product['data']->groupname}} from just
			                                    </p>
			                                    <p class="just-price">
			                                        just<span><i class="rp-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</i>
			                                            @if($product['pricing'][6]->price > 0)
			                                            {{$product['pricing'][6]->price/36}}/mo
			                                            @elseif($product['pricing'][5]->price > 0)
			                                            {{$product['pricing'][5]->price/24}}/mo
			                                            @elseif($product['pricing'][4]->price > 0)
			                                            @if($product['data']->groupname == "SSL Certificate")
			                                            {{$product['pricing'][4]->price}}/yr
			                                            @else
			                                            {{$product['pricing'][4]->price/12}}/mo
			                                            @endif
			                                            @elseif($product['pricing'][3]->price > 0)
			                                            {{$product['pricing'][3]->price/6}}/mo
			                                            @elseif($product['pricing'][2]->price > 0)
			                                            {{$product['pricing'][2]->price/3}}/mo
			                                            @elseif($product['pricing'][1]->price > 0)
			                                            {{$product['pricing'][1]->price}}/mo
			                                            @endif
			                                    </p>
			                                    @php
			                                    $protype = '';
			                                    $recomArr = unserialize(Config::get('producttypesArr'));
			                                    if(isset($product['data']->fkWhmcsProduct)){
			                                    $protype = $recomArr[$product['data']->fkWhmcsProduct];
			                                    //echo $protype . "-".$product['data']->fkWhmcsProduct;
			                                    }
			                                    @endphp
			                                    <div class="add-btn">
			                                        @if($product['pricing'][1]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][1]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][2]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][2]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][3]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][3]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][4]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][4]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][5]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][5]->durationame}}',this);">Add to Cart</a>
			                                        @elseif($product['pricing'][6]->price > 0)
			                                        <a href="javascript:void(0);" title="Add to cart" onclick="addRecommandedProducts('{{$protype}}','{{$product['data']->fkWhmcsProduct}}','{{$product['pricing'][6]->durationame}}',this);">Add to Cart</a>
			                                        @endif
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
		                @endif
	                @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
{{-- <div class="about-support cart-about">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-12">
                <div class="support-time" data-aos="fade-right">
                    <div class="support-t">
                        <i class="support-icon support-icon1"></i>
                        <span class="small-text">Call Us</span>
                        <span class="b-text">{{$contact_phonenumber}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="support-time" data-aos="zoom-in">
                    <div class="support-t">
                        <i class="support-icon support-icon2"></i>
                        <span class="small-text">Chat with our</span>
                        <span class="b-text">Hosting Experts</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="support-time" data-aos="fade-left">
                    <div class="support-t">
                        <i class="support-icon support-icon3"></i>
                        <span class="small-text">Email to our</span>
                        <span class="b-text">Support Team</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
<script type="text/javascript">
function addMatchingDomain(frmkey, ele) {
    var formData = $("#suggestedDomainFrm_" + frmkey).serialize();
    $.ajax({
        async: true,
        beforeSend: function() { showLoader(); },
        url: "{{url('cart/store')}}",
        data: formData,
        type: "post",
        success: function(response) {
            if (response) {
                if (eval(response) == 1) {
                    hideLoader();
                    $(ele).parent().parent().remove();
                    alert("Product Added to Cart");
                }
            }
        }
    });
}

function addRecommandedProducts(type, pid, billingcycle, ele) {
    showLoader();
    $.ajax({
        async: false,
        beforeSend: function() { showLoader(); },
        url: "{{url('cart/store')}}",
        data: { "_token": "{{ csrf_token() }}", "producttype": [type], "pid": [pid], "billingcycle": [billingcycle] },
        type: "post",
        success: function(response) { hideLoader();
            $(ele).parent().parent().parent().parent().parent().parent().hide(); }
    });
}
</script>