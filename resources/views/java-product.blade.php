@extends('layouts.app')
@section('content')
<?php 
	$themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; 
?>
@if(isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
    @include('template.'.$themeversion.'.banner');
@endif
<div class="web-pln-box head-tb-p-40" id="web_hosting_plan">
    <div class="container-fluid">
        <div class="shared-plan-bx-pd">
            <div class="section-heading">
                <h2 class="text-center text_head " id="windows_hosting_plans">Choose Your Windows Hosting Plans</h2>
            </div>
            <div class="tab-content">
                <!--This Code for Three Year-->
                <div id="vps-plan3" class="tab-pane active show">
                    <div class="plan-main-div" id="plans">
                        <div class="row justify-content-center">
                        	@php
                        		$_STARTER_PRICE_36_INR='_STARTER_PRICE_36_INR';
                        		$_PERFORMANCE_PRICE_36_INR='_PERFORMANCE_PRICE_36_INR';
                        		$_BUSINEESS_PRICE_36_INR='_BUSINEESS_PRICE_36_INR';
                        	@endphp
                        	@if(!empty($ProductsPackageData) && count($ProductsPackageData) >0)
                        		@foreach($ProductsPackageData as $products)
	                        		<div class="col-lg-3 col-md-6 col-sm-12">
	                        			@if($products->chrDisplayontop == 'Y')
	                        				<?php $popular = 'shared-plan-most-popular'; ?>
	                        			@else
	                        				<?php $popular = ' '; ?>
	                        			@endif
		                                <div class="shared-plan-box-main {{$popular}}" data-aos="fade-left" data-aos-easing="ease-out-back">
		                                    <div class="shared-pln-box">
		                                    	@if($products->chrDisplayontop == 'Y')
			                                    	<div class="shared-most-popular-cnt">
			                                            MOST POPULAR
			                                        </div>
		                                        @endif
		                                        <div class="shared-plan-price">
		                                            <div class="shared-plan-nm">
		                                            	{{$products->varTitle}}
		                                            </div>
		                                            @php
                                                    	$off_per = (explode(",",$products->varAdditionalOffer));
                                                    @endphp
		                                            <div class="shared-plan-cut-prc">
		                                                <span class="cut-prc-disc">{{$off_per[2]}}</span>
		                                            </div>
		                                            @if($products->varTitle == 'Starter')
			                                            <div class="shared-main-price">
			                                                {!! Config::get('Constant.sys_currency_symbol') !!}<span>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_STARTER_PRICE_36_INR) }}.00</span>/mo*
			                                            </div>
			                                        @elseif($products->varTitle == 'Performance')
			                                        	<div class="shared-main-price">
			                                                {!! Config::get('Constant.sys_currency_symbol') !!}<span>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_PERFORMANCE_PRICE_36_INR) }}.00</span>/mo*
			                                            </div>
			                                        @elseif($products->varTitle == 'Business')
			                                        	<div class="shared-main-price">
			                                                {!! Config::get('Constant.sys_currency_symbol') !!}<span>{{ Config::get('Constant.'.$ProductBanner->varWHMCSPackageFieldName.$_BUSINEESS_PRICE_36_INR) }}.00</span>/mo*
			                                            </div>
		                                            @endif
		                                            <div class="shared-plan-btn">
		                                            	@if($products->varTitle == 'Starter')
		                                                	{!!$StarterThreeYearButtonText!!}
		                                                @elseif($products->varTitle == 'Performance')
		                                                	{!!$PerformanceThreeYearButtonText!!}
		                                                @elseif($products->varTitle == 'Business')
		                                                	{!!$BusinessThreeYearButtonText!!}
		                                                @endif
		                                            </div>
		                                        </div>
		                                        <div class="shared-plan-cnt">
		                                            <ul>
		                                            	@php $SpecificationData = explode("\n",$ProductsPackageData[0]->txtSpecification); 
		                                            	@endphp
                                                        @foreach($SpecificationData as $Specification)
			                                                <div class="slide-toggle">
			                                                    <li>
			                                                    	<span>{{$Specification}}</span>
			                                                    </li>
			                                                </div>
			                                            @endforeach
		                                            </ul>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
	                            @endforeach
							@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="self-mng-jv-vps-main head-tb-p-40">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<div class="self-mng-jv-vps-img">
					<img src="/assets/images/java_hosting/self-managed-java-vps.webp" alt="self-managed-java-vps">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="self-mng-vps-cnt">
					<h2 class="text_head">Even With Our Self-Managed Java VPS, You Still Get These Extras!</h2>
					<ul>
						<li><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12.589" viewBox="0 0 18 12.589">
									<g id="Group_20342" data-name="Group 20342" transform="translate(2.536 0.435)">
										<path id="Path_72730" data-name="Path 72730"
											d="M6.294,12.928a.881.881,0,0,1-.625-.259L.259,7.258A.883.883,0,0,1,1.508,6.009L6.294,10.8,16.492.6a.883.883,0,0,1,1.249,1.249L6.919,12.669A.881.881,0,0,1,6.294,12.928Zm0,0"
											transform="translate(-2.536 -0.774)" />
									</g>
								</svg></span>Hardware-Related Resolutions</li>
								<li><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12.589" viewBox="0 0 18 12.589">
									<g id="Group_20342" data-name="Group 20342" transform="translate(2.536 0.435)">
										<path id="Path_72730" data-name="Path 72730"
											d="M6.294,12.928a.881.881,0,0,1-.625-.259L.259,7.258A.883.883,0,0,1,1.508,6.009L6.294,10.8,16.492.6a.883.883,0,0,1,1.249,1.249L6.919,12.669A.881.881,0,0,1,6.294,12.928Zm0,0"
											transform="translate(-2.536 -0.774)" />
									</g>
								</svg></span>Server Resource Upgradation Support</li>
						<li><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12.589" viewBox="0 0 18 12.589">
									<g id="Group_20342" data-name="Group 20342" transform="translate(2.536 0.435)">
										<path id="Path_72730" data-name="Path 72730"
											d="M6.294,12.928a.881.881,0,0,1-.625-.259L.259,7.258A.883.883,0,0,1,1.508,6.009L6.294,10.8,16.492.6a.883.883,0,0,1,1.249,1.249L6.919,12.669A.881.881,0,0,1,6.294,12.928Zm0,0"
											transform="translate(-2.536 -0.774)" />
									</g>
								</svg></span>Pre-installed Free CWP Panel for Tomcat & Java</li>

						
						<li><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12.589" viewBox="0 0 18 12.589">
									<g id="Group_20342" data-name="Group 20342" transform="translate(2.536 0.435)">
										<path id="Path_72730" data-name="Path 72730"
											d="M6.294,12.928a.881.881,0,0,1-.625-.259L.259,7.258A.883.883,0,0,1,1.508,6.009L6.294,10.8,16.492.6a.883.883,0,0,1,1.249,1.249L6.919,12.669A.881.881,0,0,1,6.294,12.928Zm0,0"
											transform="translate(-2.536 -0.774)" />
									</g>
								</svg></span>Security Firewall Setup</li>
														<li><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12.589" viewBox="0 0 18 12.589">
									<g id="Group_20342" data-name="Group 20342" transform="translate(2.536 0.435)">
										<path id="Path_72730" data-name="Path 72730"
											d="M6.294,12.928a.881.881,0,0,1-.625-.259L.259,7.258A.883.883,0,0,1,1.508,6.009L6.294,10.8,16.492.6a.883.883,0,0,1,1.249,1.249L6.919,12.669A.881.881,0,0,1,6.294,12.928Zm0,0"
											transform="translate(-2.536 -0.774)" />
									</g>
								</svg></span>Pre-installed Tomcat & Java via CWP Panel</li>
						<li><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12.589" viewBox="0 0 18 12.589">
									<g id="Group_20342" data-name="Group 20342" transform="translate(2.536 0.435)">
										<path id="Path_72730" data-name="Path 72730"
											d="M6.294,12.928a.881.881,0,0,1-.625-.259L.259,7.258A.883.883,0,0,1,1.508,6.009L6.294,10.8,16.492.6a.883.883,0,0,1,1.249,1.249L6.919,12.669A.881.881,0,0,1,6.294,12.928Zm0,0"
											transform="translate(-2.536 -0.774)" />
									</g>
								</svg></span>Standard Support</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="dl-features-points">
        <div class="container">
            <div class="feature-start">
                <div class="section-heading">
                <h2 class="text-center text_head">Discover What You Can Expect With Our Java Hosting Server</h2>
                </div>
                <div class="fp-list">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>Value that’s truly worth it!</h3></li>
                                <li><h3>India-Based Datacenter</h3></li>                                
                                <li><h3>Enterprise-Grade Hardware</h3></li>
                                <li><h3>Low latency with 2X faster speed</h3></li>
                            </ul>
                        </div>
                        
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>Full root access on server</h3></li>
                                <li><h3>Secured with DDoS protection</h3></li>
                                <li><h3>High security using custom firewall rules</h3></li>
                                <li><h3>Built-in network redundancy</h3></li>                                
                                <li><h3>99.9% uptime guarantee</h3></li>                                
                            </ul>
                        </div>
                        <div class="col-12 col-sm-4">
                            <ul>
                                <li><h3>Secured private network</h3></li>
                                <li><h3>Install any software with 1-click</h3></li>
                                <li><h3>Optimized storage for better performance</h3></li>
                                <li><h3>24/7 expert support whenever you need</h3></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('template.'.$themeversion.'.30-day-moneyback')

<section class="disc-full-power head-tb-p-40">
    <div class="container">
        <div class="section-heading disc-power-head">
            <h2 class="text_head text-center">Here’s Why We Choose KVM for Our Java VPS (And You Should Too)</h2>
        </div>
        <div class="row">
            <div class="col-lg-5">
                            <div id="accordion-box" class="accordion faq-wrap">

                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box0" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">Full Virtualization</h3>
                                    </a>
                                    <div id="box0" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>With KVM, your server acts like a physical machine, without any sharing issues. You get complete control over your OS, settings, and resources. With full virtualization, you can enjoy smoother app performance and fewer bottlenecks.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box1" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">Isolated & Secure Environment</h3>
                                    </a>
                                    <div id="box1" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>If you want a secure environment, KVM for Java Application Hosting gives you a safe, isolated zone where you don’t have to share resources with other sites or worry about uptime. Your Java applications can run in a clean and reliable environment.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box2" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">Better Performance Under Load</h3>
                                    </a>
                                    <div id="box2" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>As a Java app developer, you would be aware that Java apps consume a lot of resources when under workload pressure. But KVM is designed to manage workloads and perform without delays. Hence, KVM manages these spikes and keeps everything fast, responsive, and under control.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box3" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">Efficient Memory Management</h3>
                                    </a>
                                    <div id="box3" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Java app developers like KVM for hosting Java Web Applications because it offers smart tools. These tools help them manage resources and memory. Here, your Java apps get what they need, and you get better speeds, fewer memory-related issues, and superior performance.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box4" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">Supports Live Migration</h3>
                                    </a>
                                    <div id="box4" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>Live migration is the toughest job for any Java developer. If you need to move your server without shutting down your app, switch to KVM, which supports live migration. Happily, your apps keep running smoothly during the transit, and you get flexibility without the downtime.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box5" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">Stability</h3>
                                    </a>
                                    <div id="box5" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>KVM delivers a rock-solid Linux foundation that is tested, trusted, and refined for serious workloads. If you are considering a stable and robust platform for your continuously running Java apps, KVM will be a game-changer for you.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 faqs-card">
                                    <a class="card-header collapsed" data-bs-toggle="collapse" href="#box6" aria-expanded="false">
                                        <h3 class="mb-0 d-inline-block faqs-span">Cost Efficient</h3>
                                    </a>
                                    <div id="box6" class="collapse" data-parent="#accordion-box">
                                        <div class="card-body white-bg">
                                            <p>KVM comes with a technology that offers performance that is similar to a dedicated server, but also saves you from the high price tag. So you get great value for money while your Java apps thrive in that environment.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            <div class="col-lg-7">
                <div class="disc-full-power-img d-flex justify-content-center justify-content-lg-end">
                    <img class="img-fluid" loading="lazy" src="../assets/images/java_hosting/kvm-java-hosting.webp" alt="kvm-java-hosting">
                </div>
            </div>
        </div>
    </div>
</section>


<section class="java-hstg-bnfts-main head-tb-p-40">
	<div class="container">
		<div class="section-heading">
			<h2 class="text_head text-center">Built for Java, Tailored for performance.
				A cheap Java hosting that cares for your apps
			</h2>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<div class="java-hstg-bnfts-cnt">
					<ul>
						<li>Web-based Tomcat manager</li>
						<li>Unlimited JSP & non-JSP sites</li>
						<li>JVM Monitor</li>
						<li>Cross-platform capability</li>
						<li>Tomcat 10.x, 9.x, 8.x</li>
						<li>JDK Version 1.8.x</li>
						<li>JVM Version 1.8.x</li>
						<li>MariaDB, MongoDB, PostgreSQL</li>
						<li>FTP accounts</li>
						<li>Java Servlet Support</li>
						<li>JVM, JDK and JRE support</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="java-hstg-bnfts-img">
					<img src="/assets/images/java_hosting/java-hosting-benefits.webp" alt="java-hosting-benefits">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="java-hstg-bnfts-cnt">
					<ul>
						<li>Control Panel to deploy your war files easily and quickly</li>
						<li>GUI interface: restart your private Tomcat server</li>
						<li>Spring Framework (Java)</li>
						<li>JDBC Driver – to connect to the database</li>
						<li>Java with MySQL, MongoDB, and PostgreSQL support</li>
						<li>POP3, IMAP, and SMTP support</li>
						<li>Multiple WAR file deployment for Java applications</li>
						<li>Start and Stop using the Web Interface</li>
						<li>Checking the Error log and Tomcat log using the web Interface</li>
						<li>Individual port for Tomcat applications, a Unique port number to each client</li>
					</ul>
				</div></div>
		</div>
	</div>
</section>

<section class="sec-dt-acr-bkp head-tb-p-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="sec-dt-acr-img">
                    <img class="img-fluid" loading="lazy" src="../assets/images/java_hosting/acronis_backup.webp" alt="acronis_backup">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sec-dt-acr-cnt">
                    <div class="section-heading">
                        <h2 class="text_head">Secure Your Data with Acronis Backup Solution</h2>
                        <p>Enjoy peace of mind knowing your valuable data is securely backed up with our world-class backup solution tailored to suit your needs.</p>
                    </div>
                    <div class="sec-dt-acr-price">
                        <div class="sec-dt-prc-one">
                            For Just
                        </div>
                        <div class="sec-dt-prc-two">
                            ₹100/mo <span>(For 10GB Data)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="vps-features head-tb-p-40" id="features">
    @if(!empty($FeaturesData) && count($FeaturesData) >0)
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">Java VPS Features That Will Capture Your Admiration</h2>
            <p class="text_cnt">Powerful VPS Servers + Cutting-Edge Features = Performance Guaranteed</p>
        </div>
        <div class="row">
            <div class="features-main">
                @php
                $featureMainDivClass;
                $featureIconDivClass;
                $featureMainDivClass="features-start ";
                $featureIconDivClass="feature-icon d-flex justify-content-center align-items-center";
                @endphp
                <div class="{{$featureMainDivClass}}">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            @foreach($FeaturesData as $Features)
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" @if ($uagent !="mobile" )data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100" @endif>
                                    <div class="{{$featureIconDivClass}}"><i class="{{$Features->varIconClass}}"></i></div>
                                    <h3>{{$Features->varTitle}}</h3>
                                    <div class="content">{!! $Features->varShortDescription !!}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@include('template.'.$themeversion.'.testimonial_section')
@include('template.'.$themeversion.'.support_section_home')
@endsection