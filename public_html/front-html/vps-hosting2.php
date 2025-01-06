<?php include('Templates/header_section_inner.php') ?>
<style>
.tab-container{
margin: 5% 10%;
background-color: #c1e3d9;
padding: 3%;
border-radius: 4px;
}
.tab-menu{}
.tab-menu ul{
margin: 0;
padding: 0;
}
.tab-menu ul li{
list-style-type: none;
display: inline-block;
}
.tab-menu ul li a{
text-decoration: none;
color: rgba(0,0,0,0.4);
background-color: #b4cbc4;
padding: 7px 25px;
border-radius: 4px;
}
.tab-menu ul li a.active-a{
background-color: #588d7d;
color: #ffffff;
}
.tab{
display: none;
}
.tab h2{
color: rgba(0,0,0,.7);
}
.tab p{
color: rgba(0,0,0,0.6);
text-align: justify;
}
.tab-active{
display: block;
}
</style>
<div class="vps_main">
	<div class="banner-inner hosting-banner" style="background-image:url(assets/images/vps_hosting/vps-hosting-banner.jpg);">
			<div class="container">		
					<div class="banner-content">
						<div class="banner-image" data-aos="zoom-in" data-aos-delay="100">
						</div>
						<h1 class="banner-title" data-aos="fade-up" data-aos-delay="200">
							VPS Hosting
						</h1>
						<h2 class="banner-subtitle" data-aos="fade-up" data-aos-delay="300">
							Fast, scalable and secure.
						</h2>
						<h3 class="banner-text" data-aos="fade-up" data-aos-delay="400">
							Perfect for rapidly growing web applications, full root access.
							highly customizable guaranteed availability & reliability.
						</h3>
						<div class="banner-button" data-aos="fade-up" data-aos-delay="500">
								<a class="btn-primary" title="Choose Plan">Choose Plan</a>
								<a class="btn-primary Click-to-Bottom" title="View Features" href="#features">View Features</a>
						</div>
					</div>
			</div>
	</div>
	<div class="vps-plan-main-div">
		<div class="container">
			<div class="row">
					<div class="switch-plan">
					   <div class="month-tab active aos-init" data-aos="fade-left" data-aos-delay="400" >Monthly</div>
					   <label class="switch aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="100"><input type="checkbox"> <span class="slider round"></span></label>
					   <div class="month-tab aos-init" data-aos="fade-right" data-aos-delay="400" >Yearly <span class="save-25 aos-init" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="1000">Save <strong>25%</strong></span></div>
					</div>
					
					<div class="tab-container">
						<div class="tab-menu">
							  <ul>
								 <li><a href="#" class="tab-a active-a" data-id="tab1">TAB-1</a></li>
								 <li><a href="#" class="tab-a" data-id="tab2">TAB-2</a></li>
								 <li><a href="#" class="tab-a" data-id="tab3">TAB-3</a></li>
							  </ul>
						   </div><!--end of tab-menu-->
						   <div  class="tab tab-active" data-id="tab1">
								 <h2>heading of tab one</h2>
								 <p>Content of tab one</p>
								 
						   </div><!--end of tab one--> 

						   <div  class="tab " data-id="tab2">
								  <h2>heading of tab two</h2>
								 <p>Content of tab two</p>
						   </div><!--end of tab two--> 
							  <div  class="tab " data-id="tab3">
								  <h2>heading of tab three</h2>
								 <p>Content of tab three</p>     
						   </div><!--end of tab three--> 
					</div><!--end of container-->
			</div>
		</div>
	</div>
</div>

<div class="vps-features" id="features">
	<div class="container">
		<div class="row">
			<div class="features-main">
				<h2 class="features-title aos-init" data-aos="fade-up">Features put you in control</h2>
				<div class="features-start d-md-block d-none">
					<div class="row">
						<div class="feature-ul d-flex flex-wrap">
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="100">
									<div class="feature-icon">
										<i class="vps-features-icon vfi-1"></i>
									</div>
									<h3><a href="#" title="">Feel at home with cPanel</a></h3>
									<div class="content">
										Hit the ground running with the industry-standard control panel you
										already know & love.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="150">
									<div class="feature-icon">
										<i class="vps-features-icon vfi-2"></i>
									</div>
									<h3><a href="#" title="">Managed services come standard</a></h3>
									<div class="content">
										We take care of patching, security monitoring, backups and more so you can focus on your business.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="200">
									<div class="feature-icon">
										<i class="vps-features-icon vfi-3"></i>
									</div>
									<h3><a href="#" title="">Provisioning that’ll rock your world.</a></h3>
									<div class="content">
										Some places take hours to get your server online. We’ll have you up &
										running in minutes.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="250">
									<div class="feature-icon">
										<i class="vps-features-icon vfi-4"></i>
									</div>
									<h3><a href="#" title="">Find your roots</a></h3>
									<div class="content">
									You’re in charge with root (administrative) access to install PHP, modules, server level proxy, & much more.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="300">
									<div class="feature-icon">
										<i class="vps-features-icon vfi-5"></i>
									</div>
									<h3><a href="#" title="">Processing power to spare</a></h3>
									<div class="content">
									Our servers are amped up & ready to go with the latest-gen Intel® processors.
									</div>
								</div>
							</div>
							<div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start" data-aos="flip-left"
     data-aos-easing="ease-out-cubic" data-aos-delay="350">
									<div class="feature-icon">
										<i class="vps-features-icon vfi-6"></i>
									</div>
									<h3><a href="#" title="">Provision-free upgrades</a></h3>
									<div class="content">
									We won’t put your success on hold. Upgrade your plan anytime without having to re-provision.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!--features-start end -->
				<div class="features-start features-start-mob d-md-none d-block"> <!-- features-start-mob -->
					<div class="owl-carousel owl-theme">					    
					    <div class="item">
				    		<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic1.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Feel at home with cPanel</a></h3>
									<div class="content">
										Hit the ground running with the industry-standard control panel you
										already know & love.
									</div>
								</div>
							</div>

					    </div>
					    <div class="item">
				    		<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic2.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Managed services come standard</a></h3>
									<div class="content">
										We take care of patching, security monitoring, backups and more so you can focus on your business.
									</div>
								</div>
							</div>

					    </div>
			    	 	<div class="item">
						    <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
									<div class="content-main align-self-start">
										<div class="feature-icon">
											<img src="assets/images/vps_hosting/feature-ic3.svg" alt="" title=""/>
										</div>
										<h3><a href="#" title="">Provisioning that’ll rock your world.</a></h3>
										<div class="content">
											Some places take hours to get your server online. We’ll have you up &
											running in minutes.
										</div>
									</div>
								</div>
						</div>
						 <div class="item">
							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic4.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Find your roots</a></h3>
									<div class="content">
									You’re in charge with root (administrative) access to install PHP, modules, server level proxy, & much more.
									</div>
								</div>
							</div>
						</div>
						 <div class="item">
							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic5.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Processing power to spare</a></h3>
									<div class="content">
									Our servers are amped up & ready to go with the latest-gen Intel® processors.
									</div>
								</div>
							</div>
						</div>
						 <div class="item">
							<div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
								<div class="content-main align-self-start">
									<div class="feature-icon">
										<img src="assets/images/vps_hosting/feature-ic6.svg" alt="" title=""/>
									</div>
									<h3><a href="#" title="">Provision-free upgrades</a></h3>
									<div class="content">
									We won’t put your success on hold. Upgrade your plan anytime without having to re-provision.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- features-start-mob  end-->
			</div> <!-- features-main end -->
		</div>
	</div>
</div>

<div class="vps-plan-main">
	<div class="container">
		<div class="plan-div">
			<h2 class="vps-plan-title aos-init" data-aos="fade-up">It's hard to find a match to compare us but lets try anyway...</h2>
			<span class="plan-second-title aos-init" data-aos="fade-up">Better Pricing • Fast SSD Storage • Hack-free Protection • Real 24/7 Technical Support</span>
			<div class="row row-posi">
				<div class="white-overlay d-md-none d-block">
					<a href="javascript:void(0)" data-role="scroll-to-next" class="overlay_link">
						<i class="la la-angle-double-right"></i>
					</a>
				</div>
				<div class="table-relative aos-init" data-aos="fade-left" data-aos-easing="ease-out-back" data-aos-delay="600">
					<table class="table-plan-vps">
						<tr>
							<th class="title bg-none"></th>
							<th class="title"><img src="assets/images/logo.png" class="hostitsmart-logo"></th> 
							<th class="title"><img src="assets/images/vps_hosting/fast-comet.png"></th>
							<th class="title"><img src="assets/images/vps_hosting/godaddy.png"></th> 
							<th class="title"><img src="assets/images/vps_hosting/bluehost.png"></th> 
							<th class="title"><img src="assets/images/vps_hosting/hoster-gator.png"></th> 
							<th class="title"><img src="assets/images/vps_hosting/inmotion.png"></th>
						</tr>
						<tr>
							<td class="boldfonts">Regular Price</td>
							<td class="bg_blue"><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">49</span><span class="per-month">/mo</span></span></td>
							<td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">99</span><span class="per-month">/mo</span></span></td>
							<td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">199</span><span class="per-month">/mo</span></span></td>
							<td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">399</span><span class="per-month">/mo</span></span></td>
							<td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">149</span><span class="per-month">/mo</span></span></td>
							<td><span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">299</span><span class="per-month">/mo</span></span></td>
						</tr>
						<tr>
							<td class="boldfonts">SSD Only servers</td>
							<td class="bg_blue"><i class="fa fa-check-circle"></i></td>
							<td><i class="fa fa-check-circle"></i></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><span class="sprite-image cancel-ic"></span></td>
						</tr>
						<tr>
							<td class="boldfonts bg-blue-color">RocketBooster</td>
							<td class="bg_blue"><i class="fa fa-check-circle"></i></td>
							<td class="bg-blue-color"><span class="sprite-image cancel-ic"></span></td>
							<td class="bg-blue-color"><span class="sprite-image cancel-ic"></span></td>
							<td class="bg-blue-color"><i class="fa fa-check-circle"></i></td>
							<td class="bg-blue-color"><span class="sprite-image cancel-ic"></span></td>
							<td class="bg-blue-color"><i class="fa fa-check-circle"></i></td>
								
						</tr>
						<tr>
							<td class="boldfonts">Web Application Firewall</td>
							<td class="bg_blue"><i class="fa fa-check-circle"></i></td>
							<td>Paid</td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td>Paid</td>
							<td><i class="fa fa-check-circle"></i></td>
							<td><span class="sprite-image cancel-ic"></span></td>
						</tr>
						<tr>
							<td class="boldfonts">Free Daily Backups</td>
							<td class="bg_blue"><i class="fa fa-check-circle"></i></td>
							<td>Paid</td>
							<td>Paid</td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td>Paid</td>
						</tr>
						<tr>
							<td class="boldfonts">Cloudflare CDN Caching</td>
							<td class="bg_blue"><i class="fa fa-check-circle"></i></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><i class="fa fa-check-circle"></i></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><span class="sprite-image cancel-ic"></span></td>
						</tr>
						<tr>
							<td class="boldfonts">Instant chat response</td>
							<td class="bg_blue"><i class="fa fa-check-circle"></i></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><i class="fa fa-check-circle"></i></td>
							<td><span class="sprite-image cancel-ic"></span></td>
							<td><span class="sprite-image cancel-ic"></span></td>
						</tr>
						<tr class="block">
							<td colspan="7" style="visibility:hidden;"></td>
						</tr>
						<tr class="last-row">
							<td class="boldfonts"></td>
							<td class="border-radius"><a href="javascript:void(0)">See Plans</a></td>
							<td><a href="javascript:void(0)">Compare <span class="d-none d-xl-block">Head to Head</span></a></td>
							<td><a href="javascript:void(0)">Compare <span class="d-none d-xl-block">Head to Head<span></a></td>
							<td><a href="javascript:void(0)">Compare <span class="d-none d-xl-block">Head to Head<span></a></td>
							<td><a href="javascript:void(0)">Compare <span class="d-none d-xl-block">Head to Head<span></a></td>
							<td><a href="javascript:void(0)">Compare <span class="d-none d-xl-block">Head to Head<span></a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="promotional-banner row for-green-banner-col-width banner-for-vps-hosting">
			   <div class="col-lg-4 col-12 z-index-1 padding-0" >
				  <div class="row">
					 <div class="banner-1 justify-content-end d-flex"><div class="banner-wp-logo-green"></div><span class="banner-text" data-aos="fade-left">VPS Hosting Deals</span><div class="banner-wp-blue-logo"></div></div>
				  </div>
			   </div>
			   <div class="col-lg-3 col-12 z-index-0 padding-0">
						<div class="row">
								<div class="banner-text2"><span class="starting-from">Today Starting From</span> <span class="whole-span"><span class="ruppess">&#8377;</span> <span class="big-price">199</span><span class="per-month">/mo*</span></span></div>
						</div>
			   </div>
			   <div class="col-lg-4 col-12 padding-0 d-flex">
					<div class="row align-self-center" data-aos="fade-right">
							<div class="banner-button"><a class="btn-primary align-self-center" title="Start Your Site Now!">Start Your Site Now!</a></div>
					</div>
			  </div>
</div>

<?php include('Templates/common_landing.php') ?>
<?php include('Templates/footer_section.php') ?>

<script>
    jQuery('.tab-a').click(function(){  
      jQuery(".tab").removeClass('tab-active');
      jQuery(".tab[data-id='"+$(this).attr('data-id')+"']").addClass("tab-active");
      jQuery(".tab-a").removeClass('active-a');
      jQuery(this).parent().find(".tab-a").addClass('active-a');
     });
</script>
