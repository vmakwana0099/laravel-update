
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
                  <span class="c-tab-text d-none d-md-inline-block" title="Configuration">Configuration</span>
               </div>
               <div class="chckout-tab1 active" data-aos="zoom-in" data-aos-delay="200">
                  <i class="tab-icon sign-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-inline-block" title="Sign In">Sign In / Sign up</span>
               </div>
                <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                     <i class="tab-icon billinfo-icon sprite-image"></i>
                     <span class="c-tab-text d-none d-md-inline-block" title="BillingInfo">BillingInfo</span>
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

<div class="cart-check-main cart-signin-main">
   <div class="container">
      <div class="row">
		<div class="col-xl-6">
			<div class="cart-check-left cart-signin" data-aos="fade-right" data-aos-easing="ease-out-back">
			   <div class="sign-in">
				  <h1 class="signin-title">Sign in</h1>
				  <div class="signin-main">
					 <div class="row">
						<div class="col-sm-6 col-12">
						   <div class="signin">
							  <h3 class="signin-head">Have an account?</h3>
							  <span class="signin-text">Sign in now.</span>
							  <button class="btn loginpopup" title="Sign in" data-toggle="modal" data-target="#loginModal">Sign in</button>
						   </div>
						</div>
						<div class="col-sm-6 col-12">
						   <div class="signin signup">
							  <h3 class="signin-head">New to Host IT Smart?</h3>
							  <span class="signin-text">Create an account now.</span>
							  <button class="btn createaccount" title="Create Account" data-toggle="modal" data-target="#loginModal">Create Account</button>
						   </div>
						</div>
					 </div>
				  </div>
			   </div>
			</div>
         @foreach ($cartData as $element)
            @if (isset($element['pid']) && !empty($element['pid']) && $element['pid'] == 416)
               {{-- <p class="free-trial-signin-p">Sign in or Sign up and get free trial, use this coupon code <span class="free-trial-signin-span">FREETRIAL</span></p> --}}
               <?php break; ?>
            @endif
         @endforeach
		</div>
		<div class="col-xl-6" id="cart_right_panel"></div>
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
                    <a href="javascript:void(0);" onclick="emptycart();" title="Empty Cart">Empty Cart</a>
                 </div>
                 <div class="c_c_p_total" id="finalPricesinSignin">
                  </div>
                 <div class="c_c_p_btn">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" class="btn primary-btn ctcout" title="Continue to Checkout">Continue to Checkout</a>
                 </div>
              </div>
              <div class="c_c_p_terms">
                <label for="check_terms">
                <input type="checkbox" class="filled-in" tabindex="3" name="check_terms" id="check_terms" <?php echo (Session::has('check_term') && Session::get('check_term') == 'true' ) ? "checked" : ""; ?> >
                <span class="checkmark-check"></span>

                 By checking this checkbox, you agree to our <a href="{{url('/terms')}}" target="_blank" title="Terms & Conditions">Terms & Conditions</a> and <a target="_blank" href="{{url('/privacy-policy')}}" title="Privacy Policy"> privacy policy.</a>
                 </label>
                 <p> <label class="check_terms_error pull-left" id="check_terms_error" style="display: none;"></label> </p>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>

@include('cart.cart-about-support')

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

@include('cart.cartscripts')
<script type="text/javascript">
$(".createaccount").click(function(){
    $("#signup-form-link").click();
  });

  $(".loginpopup").click(function(){
    $("#signin-form-link").click();
  });
 $(".ctcout").click(function(){
    $("#signin-form-link").click();
 });
    
    function performCheckout(){
      if ($('#check_terms').prop("checked") == false) {
        $('#check_terms_error').html('* Please check to agree on all terms to continue.').css("display","block");
        // alert("* Please check to agree on all terms to continue.");
        return false;
      }else{
          $('#check_terms_error').css("display","none");
      }
       window.location.href="{{url('cart/signin')}}"; 
    }
    
	/*function performCheckout(){
      if($(".carterr").length){ $('html, body').animate({ scrollTop: ($('a.carterr:first').offset().top - 100) },500); }
      else { $('#loginModal').modal('show'); }
    }*/
  loadCartSummary(true);
  refreshCartAmount();
</script>
@endsection