<?php include('Templates/header_section_inner.php') ?>

<div class="checkout-main">
   <div class="checkout-nav">
      <div class="container">
         <div class="row">
            <div class="line">
               <div class="chckout-tab1 active" data-aos="zoom-in" data-aos-delay="100">
                  <i class="tab-icon order-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-inline-block" title="Order Summary">Order Summary</span>
               </div>
               <div class="chckout-tab1" data-aos="zoom-in" data-aos-delay="200">
                  <i class="tab-icon sign-icon sprite-image"></i>
                  <span class="c-tab-text d-none d-md-inline-block" title="Sign In">Sign In</span>
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

<div class="cart-payment-option">
   <div class="container">
      <div class="row">
		<div class="col-xl-8 left" data-aos="fade-right">
            <div class="payment_select">
                <h3>Payment</h3>
                <div class="payment-radio active">
                    <div class="radio_label">
                        <input type="radio" id="f-option1" name="selector">
                        <label for="f-option1" class="d-flex align-items-center" title="Ending with 4532"><span class="payment_sprite visa-icon"></span>Ending with 4532</label>
                        <div class="check"></div>
                    </div>
                    <div class="security_code">
                        <div class="form-group">
                            <label class="title">Security Code*</label>
                            <input class="form-control" type="number">
                        </div>
                    </div>
                </div>
                <div class="payment-radio">
                    <div class="radio_label">
                        <input type="radio" id="f-option2" name="selector">
                        <label for="f-option2" class="d-flex align-items-center" title="Ending with 6598"><span class="payment_sprite mastercard-icon"></span>Ending with 6598</label>
                        <div class="check"></div>
                    </div>
                    <div class="security_code">
                        <div class="form-group">
                            <label class="title">Security Code*</label>
                            <input class="form-control" type="number">
                        </div>
                    </div>
                </div>
                <div class="payment-radio">
                    <div class="radio_label">
                        <input type="radio" id="f-option3" name="selector">
                        <label for="f-option3" class="d-flex align-items-center" title="Ending with 5763"><span class="payment_sprite maestro-icon"></span>Ending with 5763</label>
                        <div class="check"></div>
                    </div>
                </div>
                <div class="payment-radio">
                    <div class="radio_label">
                        <input type="radio" id="f-option4" name="selector">
                        <label for="f-option4" class="d-flex align-items-center" title="Ending with 7845"><span class="payment_sprite aexpress-icon"></span>Ending with 7845</label>
                        <div class="check"></div>
                    </div>
                    <div class="security_code">
                        <div class="form-group">
                            <label class="title">Security Code*</label>
                            <input class="form-control" type="number">
                        </div>
                    </div>
                </div>
                <div class="payment-radio">
                    <div class="radio_label">
                        <input type="radio" id="f-option5" name="selector">
                        <label for="f-option5" class="d-flex align-items-center" title="Ending with 8754"><span class="payment_sprite discover-icon"></span>Ending with 8754</label>
                        <div class="check"></div>
                    </div>
                    <div class="security_code">
                        <div class="form-group">
                            <label class="title">Security Code*</label>
                            <input class="form-control" type="number">
                        </div>
                    </div>
                </div>
                
                <div class="addpayment_btn">
                    <a href="#" class="btn" title="Add Payment"><i class="fa fa-plus"></i>Add Payment</a>
                </div>
            </div>
            <div class="billing_info_txt">
                <h3>Billing Information</h3>
                <div class="address">
                    701, Mauryansh Elanza, 5th Floor, Nr Parekh Hospital,<br/> Nr Shyamal Cross Road, Satellite, Ahmedabad, Gujarat 380015. <a href="#" title="Edit">Edit</a>
                </div>
            </div>
		</div>
		<div class="col-xl-4">
				<div class="card-right">
					<div class="cart-right" data-aos="fade-left" data-aos-easing="ease-out-back">
						<div class="cart-box-1 row">
							<div class="order-summary-main col-xl-12 col-md-6 col-12">
								<h2 class="sumary-title">Order Summary</h2>
								<div class="summary-box">
									<div class="domain-cart-details">
										<div class="summary-1 d-flex">
											<div class="purchased-category">
											VPS Hosting
											</div>
											<div class="purchased-domain-price ml-auto">
												<span class="rupees">&#8377;</span>3588
											</div>
										</div>
										<div class="summary-2">
											<div class="row-2 d-flex flex-wrap">
												<div class="premium-in d-flex">
													<span class="pre-head">Premium Package</span> 
													<a class="delete-icon ml-auto" title="Delete"><i class="delete-i  sprite-image"></i></a>
												</div>
												<span class="purchased-name">BookMyShow<span class="green">.com</span></span>
											</div>
											<div class="row-3 d-flex flex-wrap">
												<ul class="additional-benefit">
													<li>SSL Certificate Activation - 1 yr</li>
												</ul>
												<div class="purchased-domain-price  ml-auto">
													<span class="rupees">&#8377;</span>349
												</div>
											</div>
										</div>
										<div class="pro d-flex">
											<div class="pro-left">
												<div class="pro-text">
													SpamAssassin Protection
												</div>
												<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												<i class="notify sprite-image" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i>
												<ul class="dropdown-menu tooltip-link-show" x-placement="bottom-start" style="position: absolute; transform: translate3d(200px, 204px, 0px); top: 0px; left: 0px; will-change: transform;">
													<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
												</ul>
												</a>
											</div>
											<div class="pro-right ml-auto">
											Free
											</div>
										</div>
									</div>
									<div class="security d-flex">
										<div class="secure-left">
										Just a reminder Your information will be public
											<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												<i class="notify sprite-image" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i>
												<ul class="dropdown-menu tooltip-link-show" x-placement="bottom-start" style="position: absolute; transform: translate3d(200px, 204px, 0px); top: 0px; left: 0px; will-change: transform;">
													<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
												</ul>
											</a>
										</div>
										<div class="p-text d-flex align-items-stretch flex-wrap">
											<div class="align-self-center">
												<span class="p-head">Domain privacy</span>
												<div class="p-price-whole">
													<span class="p-price">
														<span class="rupee">&#8377;</span>49/<span class="light">yr</span>
													</span> 
													<span class="p-overline-price">
														<span class="rupee">&#8377;</span>449
													</span> 
												</div>
												<button class="btn" title="Add">Add</button>
											</div>
										</div>
									<a class="ml-auto delete-icon" title="remove"><i class="remove-icon"></i></a>
									</div>
								</div>
							</div>
							<div class="subtotal-main-right col-xl-12 col-md-6 col-12">
								<div class="subtotal-div">
									<div class="subtotal-final d-flex">
										<span class="subtotal-head">Subtotal</span>
										<span class="subtotal-price ml-auto"><span class="rupee">&#8377;</span>648</span>
									</div>
									<div class="tax-cart d-flex">
										<span class="taxes">
										Taxes &amp; Fees
											<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
											<i class="notify sprite-image" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i>
											<ul class="dropdown-menu tooltip-link-show">
												<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
											</ul>
										</a>
										</span>
										<span class="subtotal-price ml-auto"><span class="rupee">&#8377;</span>1149</span>
									</div>
									<div class="cart-promocode">
										<div class="before-apply-promocode">
											<div class="promocode-input">
												<input type="text" placeholder="Have a Coupon Code?">
												<button class="btn" title="Apply">Apply</button>
											</div>
											<div class="promocode-text">
											*Apply one coupon at a time
											</div>
										</div>
										<div class="after-promocode d-flex">
											<div class="promocde-applied-left">
												<a class="delete-icon" title="remove"><i class="remove-icon"></i></a>
												<span class="promocode">
													HOST001
												</span>
												<span class="promo-text">
													Promo code applied
												</span>
											</div>
											<div class="subtotal-price ml-auto"> - <span class="rupee">&#8377;</span>49</div>
										</div>
									</div>
								</div>
								<div class="cart-c">
									<div class="cart-total d-flex">
										<span class="total-text">Total</span>
										<span class="total-price ml-auto d-flex align-items-center">
											<span class="total-overline d-flex align-items-center">
												<span class="rupee">&#8377;</span>
												<span class="overline">11548</span>
											</span>
											<span class="total-green d-flex align-items-center">
												<span class="rupee">&#8377;</span>
												<span class="original">5634</span>
											</span>
										</span>
									</div>
									<div class="checkout-div">
										<button class="btn" title="Continue to Checkout">Continue to Checkout</button>
										<div class="checkout-privacy">
										By clicking "Continue to Checkout", you agree to our
											<a class="highlight" title="Terms And Conditions">Terms &amp; Conditions</a> and <a class="highlight" title="privacy policy">privacy policy</a>
										</div>
										<div class="empty-cart-div d-flex">
											<a class="disclaimer" title="View offer disclaimers" href="javascript:void(0)">
											View offer disclaimers
											</a>
											<button class="empty-cart ml-auto" title="Empty Cart"><i class="delete-i sprite-image"></i>Empty Cart</button>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="cart-box-2" data-aos="fade-left" data-aos-easing="ease-out-back">
						<div class="cart-payment">
							<ul class="payment-icons-list">
								<!--<li class="payment-icons pay-icon1" title="visa"></li>
								<li class="payment-icons pay-icon2" title="master card"></li>
								<li class="payment-icons pay-icon3" title="maestro"></li>
								<li class="payment-icons pay-icon4" title="american express"></li>
								<li class="payment-icons pay-icon5" title="dinner club"></li>-->
								<img src="assets/images/payment-method-cart.png" alt="Payment">
							</ul>
						</div>
						<div class="cart-ssl d-flex">
							<i class="ssl-icon sprite-image"></i>
							<div class="ssl-text">
								<div class="ssl-head">SSL Secure Payment</div>
								<span class="ssl-t">Your encryption is protected by 256-bit SSL encryption</span>
							</div>
						</div>
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
						<span class="b-text">079-6605-0099</span>
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

<?php include('Templates/footer_section.php') ?>
<script src="assets/js/main.js"></script>
</body>
</html>