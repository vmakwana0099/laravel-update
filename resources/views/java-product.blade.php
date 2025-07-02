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
<section class="vps-features head-tb-p-40" id="features">
    @if(!empty($FeaturesData) && count($FeaturesData) >0)
    <div class="container">
        <div class="section-heading text-center">
            <h2 class="text_head">Managed VPS Features That Will Capture Your Admiration</h2>
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
@include('template.'.$themeversion.'.support_section_home')
@endsection