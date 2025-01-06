@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="payment-failed-main">
	<div class="container">
		<div class="row">
			<div class="payment-card">
				<div class="payment-failed-bg">
					<div class="failed-t">
						<img src="{{Config::get('Constant.CDNURL')}}/assets/images/payment-failed.png" alt="Payment Failed" title="Payment Failed" />
						<h1 class="">
						Payment Failed
						</h1>
						<span class="">Your payment could not be processed</span>
					</div>
				</div>
				<div class="failed-text">
					<div class="">	
						<span class="">It seems there was an error while attempting to process your payment.</span>
						<ul>
							<li>If your credit card has been denied by our system, try using a different credit card or another payment method.</li>
							<li>But don't be concerned! Things happen; we understand. If you prefer, you can email us at <a href="mailto:{{$emailId}}">{{$emailId}}</a> or call us at <a href="tel:{{$contact_phonenumber}}">{{$contact_phonenumber}},</a> and we will be more than happy to assist you with the further payment process.</li>
						</ul>
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
@endsection