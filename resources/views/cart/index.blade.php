 
@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
 <div class="checkout-main">
   <div class="checkout-nav">
      <div class="container">
         <div class="row">
            <div class="line">
               <div class="chckout-tab1 active" data-aos="zoom-in" data-aos-delay="100">
                     <i class="tab-icon config-icon sprite-image"></i>
                     <span class="c-tab-text d-none d-md-inline-block" title="Configuration">Configuration</span>
               </div>
               <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                  <i class="tab-icon sign-icon sprite-image"></i>
                     <span class="c-tab-text d-none d-md-inline-block" title="Sign In">Sign In / Sign up</span>
               </div>
               <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="300">
                  <i class="tab-icon card-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-inline-block" title="Payment">Payment</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="cart-check-main">
   <div class="container">
      <div class="row" id="cartMainContainer">
        <div class="col-xl-8" id="cartLeftDiv">
            @if(!empty($cartData))
            @foreach($cartData as $key => $cartItem)
                @if(!isset($cartItem['relatedpro']))
                    @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'domain')
                        @include('cart.domain',['cartItem' => $cartItem, 'key' => $key])
                    @endif
                    @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'hosting')
                        @include('cart.hosting',['cartItem' => $cartItem, 'key' => $key])
                    @endif
                    @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'email')
                        @include('cart.email',['cartItem' => $cartItem, 'key' => $key])
                    @endif
                    @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'ssl')
                        @include('cart.ssl',['cartItem' => $cartItem, 'key' => $key])
                    @endif
                    @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'dedicatedserver')
                        @include('cart.dedicatedserver',['cartItem' => $cartItem, 'key' => $key])
                    @endif
                    @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'vps')
                        @include('cart.dedicatedserver',['cartItem' => $cartItem, 'key' => $key])
                    @endif
                @endif    
            @endforeach
           @endif
           <div id="recommandedProductDiv" class="recommanded-main" data-aos="fade-right" data-aos-easing="ease-out-back"></div>
           <div id="suggestedDomainsDiv" class="matching-domain-main aos-init aos-animate" data-aos="fade-right" data-aos-easing="ease-out-back"></div>
           <div class="add-domain-div" data-aos="fade-right" data-aos-easing="ease-out-back">
            <div class="c-2" id="cartdomaindiv">
                    <h3 class="eligible-text">Add Domain</h3>
                    <div class="doamin_search_div">
                        <div class="form-group aos-init aos-animate" data-aos="fade-up" data-aos-easing="ease-out-back">
                            <input class="form-control" type="text" maxlength="60" onkeyup="return validateFreeDomainName(this);" id="cartdomaintxt" name="cartdomaintxt" name="Search domain here.." placeholder="Search domain here..">
                            <div class="dropdown dropdown-bulk">
                                <select class="selectpicker" id="selCartDomain" name="selCartDomain">
                                    @foreach($allCartTlds as $tld)
                                      <option value="{{$tld}}">{{$tld}}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <button class="btn" title="Search" onclick="return searchCartDomain();">Search</button>
                        </div>
                    </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4" id="cart_right_panel"> @include('cart.ordersummary',['cartData' => $cartDataSummary, 'addonProducts' => $addonProductsSummary])</div>
      </div>
   </div>
</div>


<div class="about-support cart-about">  
    <div class="container">
        <div class="row">   
            <div class="col-sm-4 col-12">
                <div class="support-time" data-aos="fade-right">
                    <div class="support-t">
                        <i class="support-icon support-icon1"></i>
                        <span class="small-text">Call Us</span>
                        <a class="b-text" href="tel:{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}" >{{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}</a>
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
</div>
@include('cart.cartscripts')
<script type="text/javascript">
function checkoutclick(){
    var totalDomainError = $(".domainerror").length|0;
    if(totalDomainError > 0){
      $('html, body').animate({scrollTop: parseInt($(".domainerror").first().offset().top - 200)});
      return false;
    }
    else{ window.location.href="{{url('cart/signin')}}"; }
    return false;
}
//setTimeout(function(){ loadSuggetion(); }, 3000); //load suggestion and recommandation after 3 seconds

</script>
@endsection