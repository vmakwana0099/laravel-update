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
		                                            <div class="shared-plan-cut-prc">
		                                                <span class="cut-prc-disc">60% OFF</span>
		                                            </div>
		                                            <div class="shared-main-price">
		                                                ₹<span>
		                                                    90.00</span>/mo*
		                                            </div>
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