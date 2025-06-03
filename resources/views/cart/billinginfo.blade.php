 
@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')

<script src="{{ url('assets/js/statesdropdown.js') }}?v={{date('YmdHi')}}" type="text/javascript"></script>
<!-- <div class="checkout-main">
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
               <div class="chckout-tab1 active" data-aos="zoom-in" data-aos-delay="200">
                  <i class="tab-icon billinfo-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="BillingInfo">Billing Info</span>
               </div>
               <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="300">
                  <i class="tab-icon card-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-none d-lg-inline-block" title="Payment">Payment</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> -->

<div class="cart-signin-main cart-check-billing">
   <div class="container">
      <div class="row">
		<div class="col-xl-6" data-aos="fade-right">
      <form id="frmbilling" name="frmbilling" method="post" action="{{url('cart/updatebillinginfo')}}">
            <div class="billingform_div">
                <div class="row">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" id="h_save" name="h_save" value="Y"/>
                    <input type="hidden" id="clientid" name="clientid" value="{{$clientid}}"/>
                    <div class="col-md-12"><h2>Billing Information</h2></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">First Name*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $clientData['firstname'];?>">
                            </div>
                        </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">Last Name*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $clientData['lastname'];?>">
                            </div>
                        </div>        
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">Email*</label>
                            <div class="input-group">
                                <input type="text" class="form-control">
                            </div>
                        </div>        
                    </div> -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="title">Address</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="hits_address1" name="address1" value="<?php echo $clientData['address1'];?>" >
                            </div>
                        </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">Country/Region*</label>
                            <div class="input-group">
                                @php echo $countrycmb; @endphp
                            </div>
                        </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">State*</label>
                            <div class="input-group">
                            	<input id="stateinput" name="state" class="form-control form-select" type="text" value="<?php echo $clientData['statecode'];?>" >     
                            </div>
                        </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">City*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="hits_city" name="city" value="<?php echo $clientData['city'];?>"  >
                            </div>
                        </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">Postal code*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $clientData['postcode'];?>" maxlength="10"  >
                            </div>
                        </div>        
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">Phone Number*</label>
                            <div class="input-group">
                                <input type="text" onkeypress="return KeycheckOnlyPhonenumber(event);" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo isset($clientData['phonenumber'])?$clientData['phonenumber']:"";?>" maxlength="20" readonly='true' >
                            </div>
                        </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title">GST Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="gstnumber" value="<?php echo $clientData['customfields1']; ?>" name="gstnumber" maxlength="20">
                            </div>
                        </div>        
                    </div>
                     
                    <div class="col-md-12">
                        <button class="btn save_btn" title="Save">Save</button>
                    </div>
                </div>
            </div>
                </form>
      <?php /* <div class="cart-check-left cart_products_to_add" data-aos="fade-right" data-aos-easing="ease-out-back">
        <div class="title">Recommended for you</div>
        <div class="info_inner_box">
            <div class="i_i_b_row row">
              <div class="col-sm-9 col-9">
                <div class="image_col">
                  <img src="assets/images/cart_selected_product_image.png" title="Selected Product" alt="Selected Product"/>
            </div>
                <div class="content_col">
                  <div class="title">Search Engine Optimization</div>
                  <div class="desc">
                    <ul>
                      <li>Find the right search phrases for your site</li>
                      <li>Show up higher in web and local searches</li>
                      <li>Increase visitors and sales</li>
                    </ul>
		</div>
      </div>
   </div>
              <div class="i_i_col_child2 col-sm-3 col-3">
                <div class="price_col">
                  <span class="rupee">&#8377;</span>699/mo
</div>
                <div class="spacer_40"></div>
                <div class="add_btn">
                  <a href="#" title="Add" class="btn">Add</a>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="cart-check-left cart_products_to_add" data-aos="fade-right" data-aos-easing="ease-out-back">
          <div class="title">Matching Domain Available</div>
          <div class="info_inner_box">
            <div class="domains_list row">
            <div class="domain_name col-sm-6 col-6">
              <a href="#" title="livedramashow.co" class="d_l_name">livedramashow.co</a>
            </div>
            <div class="domain_price col-sm-6 col-6">
              <div class="d_p_amount">
                <span class="linethrough_price"><span class="rupee">&#8377;</span>999</span>
                <span class="rupee">&#8377;</span>650/yr per domain
              </div>
              <div class="add_btn">
                  <a href="#" title="Add" class="btn">Add</a>
                </div>
            </div>
            </div>
            <div class="domains_list row">
            <div class="domain_name col-sm-6 col-6">
              <a href="#" title="livedramashow.co" class="d_l_name">livedramashow.info</a>
            </div>
            <div class="domain_price col-sm-6 col-6">
              <div class="d_p_amount">
                <span class="linethrough_price"><span class="rupee">&#8377;</span>999</span>
                <span class="rupee">&#8377;</span>650/yr per domain
              </div>
              <div class="add_btn">
                  <a href="#" title="Add" class="btn">Add</a>
                </div>
            </div>
            </div>
          </div>
        </div>
        <div class="cart-check-left cart_products_to_add dotted_border" data-aos="fade-right" data-aos-easing="ease-out-back">
          <div class="small-title">Matching Domain Available</div>
          <div class="add_domains">
          <input type="text" placeholder="Find your perfect domain">
          <button class="btn" title="Search"><i class="fa fa-search"></i></button>
          </div>
        </div>  */?>

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
                    <a title="View offer disclaimers" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#disclaimer-popup">View offer disclaimers</a>
                    <a href="javascript:void(0);" onclick="emptycart();" title="Empty Cart">Empty Cart</a>
                 </div>
                 <div class="c_c_p_total" id="finalPricesinSignin">
                  </div>
                 <div class="c_c_p_btn">
                    <a href="javascript:void(0);" onclick="performCheckout();" class="btn primary-btn" title="Continue to Checkout">CONTINUE TO CHECKOUT</a>
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

<script src="{{ url('assets/js/billinginfo.js') }}" type="text/javascript"></script>
@include('cart.cartscripts')
<script type="text/javascript">
$( document ).on( "change", "#country", function() {
      $("#frmbilling").valid();
  });

  $( document ).on( "change", "#stateselect", function() {
      $("#frmbilling").valid();
  });

  function performCheckout(){
    if ($('#check_terms').prop("checked") == false) {
      $('#check_terms_error').html('* Please check to agree on all terms to continue.').css("display","block");
      // alert("* Please check to agree on all terms to continue.");
      return false;
    }else{
        $('#check_terms_error').css("display","none");
    }
      if($(".carterr").length){ $('html, body').animate({ scrollTop: ($('a.carterr:first').offset().top - 100) },500); }
      else {
       $("#frmbilling").submit();
     }
    }
  loadCartSummary(true);
  refreshCartAmount();
   function checkoutclick(){
     $("#frmbilling").submit();
    return false;
}
</script>
@endsection