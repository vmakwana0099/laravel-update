@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="checkout-main">
   <div class="checkout-nav">
      <div class="container">
         <div class="row">
            <div class="line">
                  <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="100">
                     <i class="tab-icon config-icon sprite-image"></i>
                     <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Configuration">Configuration</span>
               </div>
                  <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                  <i class="tab-icon sign-icon sprite-image"></i>
                     <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Sign In">Sign In / Sign up</span>
               </div>
               <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                  <i class="tab-icon billinfo-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="BillingInfo">Billing Info</span>
               </div>
               <div class="chckout-tab1 active" data-aos="zoom-in" data-aos-delay="300">
                  <i class="tab-icon card-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Payment">Payment</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="cart-paymentinfo-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 aos-init" data-aos="fade-right">
                <?php
                /*<div class="billing_info_txt">
                    <h3>Billing Information</h3>
                    <div class="address">
                        {{$addressline1}} <br /> {{$addressline2}}&nbsp;<a href="{{url('cart/billinginfo')}}" title="Edit">Edit</a>
                    </div>
                </div>*/
                ?>
                 <div class="billing_info_txt">
                    <h3>Billing Information <a href="{{url('cart/billinginfo')}}" title="Edit">Edit</a></h3>
                    <div class="address">
                        <b>Full Name : </b>  @if(Session::has('firstname')){{ Session::get('firstname') }}@endif  @if(Session::has('lastname')){{ Session::get('lastname') }}@endif  
                    </div>
                    
                    <div class="address">
                        <b>Email : </b>@if(Session::has('useremail')){{ Session::get('useremail') }}@endif 
                    </div>
                    
                    <div class="address">
                        <b>Phone no : </b>+@if(Session::has('phonenumber')){{ Session::get('phonenumber') }}@endif 
                    </div>
                    
                    <div class="address">
                        <b>Address : </b>{{$addressline1}} &nbsp; {{$addressline2}}
                    </div>
                   
                    <div class="address">
                        <b>City : </b>@if(Session::has('city')){{ Session::get('city') }}@endif 
                    </div>
                    
                    <div class="address">
                        <b>State : </b>@if(Session::has('state')){{ Session::get('state') }}@endif 
                    </div>
                    
                    <div class="address">
                        <b>Country : </b>@if(Session::has('country')){{ Session::get('country') }}@endif 
                    </div>
                   
                    <div class="address">
                        <b>Postalcode : </b>@if(Session::has('postalcode')){{ Session::get('postalcode') }}@endif 
                    </div>
                    
                    <div class="address">
                        <b>GST no : </b>@if(Session::has('gstnumber')){{ Session::get('gstnumber') }}@endif 
                    </div>
                </div>

                <form id="paymentfrm" name="paymentfrm" action="" method="post">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" id="h_save" name="h_save" value="Y"/>
                    <input type="hidden" id="varordertotal" name="varordertotal" value="0"/>
                <div class="paymentinfo-start">
                    <h3>Payment</h3>
                     @if($country == 'india')
                    <div class="payment-section credit-section active">
                        <div class="paymentinfo-radio">
                            <div class="radio_label">
                                <input type="radio" id="payopt_ccard" name="paymentoptions" name="selector" checked value="c">
                                <label for="payopt_ccard" class="align-items-center" title="Credit Cards">Credit Cards</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <p class="card-info">You can pay us for purchase by using Visa, Mastercard, American Express Discover Card and Diners club International.</p>
                    </div>
                    <hr class="separator">
                    <div class="payment-section netbanking-section">
                        <div class="paymentinfo-radio">
                            <div class="radio_label">
                                <input type="radio" id="payopt_net" name="paymentoptions" name="selector" value="n">
                                <label for="payopt_net" class="align-items-center" title="Net Banking">Net Banking</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <p class="card-info">You can also process payment by NetBanking we have affiliation with 40+ Banks.</p>
                    </div>
                    <hr class="separator">
                    <div class="payment-section debitcard-section">
                        <div class="paymentinfo-radio">
                            <div class="radio_label">
                                <input type="radio" id="payopt_debitcart" name="paymentoptions" name="selector" value="d">
                                <label for="payopt_debitcart" class="align-items-center" title="Debit Cards">Debit Cards</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <p class="card-info">We accept Visa, Master, Rupay, Maestro, SBIPG debit card of all major banks.</p>
                    </div>
                    <?php /*<hr class="separator">
                    <div class="payment-section debitcard-section">
                        <div class="paymentinfo-radio">
                            <div class="radio_label">
                                <input type="radio" id="payopt_ccavenue" name="paymentoptions" name="selector" value="cc">
                                <label for="payopt_ccavenue" class="align-items-center" title="CCAvenue">CCAvenue</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <p class="card-info">We'll take you to your payment provider's website to complete your purchase.</p>
                    </div> */?>
                    <div class="separator">&nbsp;</div>
                    @endif
                    @if($country != 'india')
                    <?php /*<div class="payment-section credit-section active">
                        <div class="paymentinfo-radio">
                            <div class="radio_label">
                                <input type="radio" id="payopt_ccard" name="paymentoptions" name="selector" checked value="cc">
                                <label for="payopt_ccard" class="align-items-center" title="Credit Cards">Credit Cards</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <p class="card-info">You can pay us for purchase by using Visa, Mastercard, American Express Discover Card and Diners club International.</p>
                    </div>
                    <hr class="separator">
                    <div class="payment-section netbanking-section">
                        <div class="paymentinfo-radio">
                            <div class="radio_label">
                                <input type="radio" id="payopt_net" name="paymentoptions" name="selector" value="cc">
                                <label for="payopt_net" class="align-items-center" title="Net Banking">Net Banking</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <p class="card-info">You can also process payment by NetBanking we have affiliation with 40+ Banks.</p>
                    </div>
                    <hr class="separator">
                    <div class="payment-section debitcard-section">
                        <div class="paymentinfo-radio">
                            <div class="radio_label">
                                <input type="radio" id="payopt_debitcart" name="paymentoptions" name="selector" value="cc">
                                <label for="payopt_debitcart" class="align-items-center" title="Debit Cards">Debit Cards</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <p class="card-info">We accept Visa, Master, Rupay, Maestro, SBIPG debit card of all major banks.</p>
                    </div>*/?>
                    <hr class="separator">
                    <div class="payment-section paypal-section box-padding">
                        <div class="paymentinfo-radio">
                            <div class="radio_label">
                                <input type="radio" id="payopt_payment" name="paymentoptions" name="selector" checked value="p">
                                <label for="payopt_payment" class="align-items-center" title="Paypal">Paypal</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <p class="card-info">Make payment faster and more securely in India and across the globe.</p>
                    </div>
                    <div class="separator">&nbsp;</div>
                    @endif
                </div>
                </form>
            </div>

            <div class="col-xl-6" id="cart_right_panel">
            </div>
        </div>
    </div>
</div>
<div class="secure-payment-info">
  <div class="container">
     <div class="row">
        <div class="col-sm-5 col-xs-12">
           <div class="s_p_box d-flex">
              <i class="s_p_icon"></i>
              <div class="s_p_content">
                 <span class="title">SSL Secure Payment</span>
                 <span class="desc">Your encryption is protected by 256-bit SSL encryption</span>
              </div>
           </div>
           <div class="payment-method-cart"></div>
        </div>
        <div class="col-sm-7 col-xs-12">
           <div class="continue-checkout-portion">
              <div class="c_c_p_top">
                 <div class="c_c_p_links">
                    <a title="View offer disclaimers" href="javascript:void(0)" data-toggle="modal" data-target="#disclaimer-popup">View offer disclaimers</a>
                    <a href="javascript:void(0);" onclick="emptycart();" title="mpty Cart">Empty Cart</a>
                 </div>
                 <div class="c_c_p_total" id="finalPricesinSignin">
                  </div>
                 <div class="c_c_p_btn">
                    <a href="javascript:void(0);" onclick="performCheckout();" class="btn primary-btn" title="Continue to Checkout">Continue to Checkout</a>
                 </div>
              </div>
              <div class="c_c_p_terms">
                 By clicking "Continue to Checkout", you agree to our <a href="{{url('/terms')}}" target="_blank" title="Terms & Conditions">Terms & Conditions</a> and <a target="_blank" href="{{url('/privacy-policy')}}" title="Privacy Policy"> privacy policy</a>.
              </div>
           </div>
        </div>
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
</div>
<div id="paymentscriptContainer"></div>
@include('cart.cartscripts')
<script type="text/javascript">
loadCartSummary(true);
refreshCartAmount();
function performCheckout(){
        $("#varordertotal").val($("#cartTotalspan .original").text());
        if($(".carterr").length){ $('html, body').animate({ scrollTop: ($('a.carterr:first').offset().top - 100) },500); }
      else {
        var formData = $("#paymentfrm").serialize();
         $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/createorder')}}",
            data:formData,
            type:"post",
            success:function(response){
                $("#paymentscriptContainer").html(response);
                $("#paymentscriptContainer form").submit();
            } 
        });     
       }
}
</script>
@endsection