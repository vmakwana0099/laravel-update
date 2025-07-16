@extends('layouts.app')
@section('content')
<div class="vps_main {{$ProductBanner->varBannerIconClass}}">
    @if (isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
    	<link rel="stylesheet" href="{{URL::to('/assets/css/full-width-inner-banner.css')}}">
    	<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
    	@include('template.'.$themeversion.'.banner')


<section class="web-pln-box head-tb-p-40">
        <div class="container-fluid">
            <div class="shared-plan-bx-pd">
                <div class="section-heading">
                    <h2 class="text_head text-center">Check Cheap cPanel VPS Plans For Your Business</h2>
                </div>
                <div class="row justify-content-center">
                    @foreach ($ProductsPackageData as $elkey => $element)
                    @php
                    $popular_div_class = '';
                    if($elkey == 1){
                    $popular_div_class = 'shared-plan-most-popular';
                    }
                    $planName = $element->varTitle;
                    $SpecificationData = explode("\n",$element->txtSpecification);
                    if ($element->txtShortDescription == 'BEST SELLER') {
                    $class_best_seller = 'best-seller-div';
                    }else{
                    $class_best_seller = ' ';
                    }
                    @endphp
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="shared-plan-box-main {{ $popular_div_class }}" data-aos="fade-left" data-aos-easing="ease-out-back" id="basic_three_div">
                            <div class="shared-pln-box">
                                @if($elkey == 1)
                                <div class="shared-most-popular-cnt">
                                    MOST POPULAR
                                </div>
                                @endif
                                <div class="shared-plan-price">
                                    <div class="shared-plan-nm">
                                        {{$planName}}
                                    </div>
                                    <div class="shared-plan-cut-prc">
                                        {{-- <span class="cut-price">₹840.00</span> --}}
                                        @if(Config::get('Constant.sys_currency') == 'INR')
                                        @if (isset($element->productpricing['monthly']) && isset($element->productpricing['annually']))
                                        <span class="cut-price" id="oneyear-sale-price{{str_replace(' ', '', $planName)}}">
                                            @if(isset($element->productpricing['monthly_renewal']))
                                            {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly_renewal']}}
                                            @else
                                            {!! Config::get('Constant.sys_currency_symbol') !!}{{$element->productpricing['monthly']}}
                                            @endif
                                        </span>
                                        @endif
                                        @endif
                                        {{-- <span class="cut-prc-disc">Save 50%</span> --}}
                                        <span class="cut-prc-disc" id="offer-discount-{{str_replace(' ', '', $planName)}}">
                                            @php
                                            if(isset($element->productpricing['monthly_renewal'])){
                                            $percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly_renewal']) * 100), 0);
                                            }else{
                                            $percentageOff = round((100-($element->productpricing['annually'] / $element->productpricing['monthly']) * 100), 0);
                                            }
                                            @endphp
                                            Save {{$percentageOff}}%
                                        </span>
                                    </div>
                                    <div class="shared-main-price">
                                        {{-- ₹<span>420.00</span>/mo* --}}
                                        ₹<span>{{$element->productpricing['annually']}}.00</span>/mo*
                                    </div>
                                    <div class="shared-plan-btn">
                                        {{-- <a href="javascript:void(0)" class="primary-btn-sq-bdr">Choose Plan</a> --}}
                                        @if(isset($element->ButtonTextannually) && !empty($element->ButtonTextannually))
                                        {!! $element->ButtonTextannually !!}
                                        @endif
                                    </div>
                                    @if(isset($element->productpricing['monthly_renewal']))
                                    <div class="shared-plan-renew">
                                        Renews at ₹{{ $element->productpricing['yearly_renewal_permonth'] }}/mo after 1 year. Cancel anytime.
                                    </div>
                                    @endif
                                </div>
                                <div class="shared-plan-cnt">
                                    <ul>
                                        @foreach ($SpecificationData as $key => $Specifica)
                                        @php
                                        $Specification = (trim($Specifica));
                                        @endphp
                                        <div class="slide-toggle">
                                            <li> <span>{!! $Specification !!}</span></li>
                                        </div>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

	<section class="cpanel-mngmnt-prom-main head-tb-p-40">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
			<div class="">
				<h2 class="text_head">
					cPanel Management Promotion
				</h2>
				<p>How cPanel Makes VPS Management Super Easy!
					Learn how cPanel VPS makes your server management easy, even if you’re not a tech expert
				</p>
			</div>
					<div class="cpanel-mngmnt-left">
						<div class="cpanel-mngmnt-cnt-row">
							<div class="cpanel-mngmnt-cnt-box">
								<div class="cpanel-mngmnt-title">
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28" height="26"
										viewBox="0 0 28 26">
										<defs>
											<linearGradient id="linear-gradient01" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
												<stop offset="0" stop-color="#3838ff" />
												<stop offset="1" stop-color="#d32a2d" />
											</linearGradient>
										</defs>
										<g id="Group_172515" data-name="Group 172515" transform="translate(-2 -3)">
											<path id="Path_251071" data-name="Path 251071"
												d="M4,29h9a2,2,0,0,0,2-2V19a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v8a2,2,0,0,0,2,2ZM4,19h9v8H4Zm25,9H17a1,1,0,0,1,0-2H29a1,1,0,0,1,0,2Zm0-4H17a1,1,0,0,1,0-2H29a1,1,0,0,1,0,2Zm0-4H17a1,1,0,0,1,0-2H29a1,1,0,0,1,0,2ZM28,3H4A2,2,0,0,0,2,5v9a2,2,0,0,0,2,2H28a2,2,0,0,0,2-2V5a2,2,0,0,0-2-2Zm0,11H4V5H28Z"
												fill="url(#linear-gradient01)" />
										</g>
									</svg></span>User-friendly Interface
								</div>
								<div class="cpanel-mngmnt-data">If you are not a tech expert, using cPanel’s clean and user-friendly interface, you can navigate your VPS with ease to make your task management effortless.</div>
							</div>
							<div class="cpanel-mngmnt-cnt-box">
								<div class="cpanel-mngmnt-title">
									<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24.524"
											height="26" viewBox="0 0 24.524 26">
											<defs>
												<linearGradient id="linear-gradient02" x1="0.029" y1="0.538" x2="1" y2="0.551"
													gradientUnits="objectBoundingBox">
													<stop offset="0" stop-color="#3838ff" />
													<stop offset="1" stop-color="#d32a2d" />
												</linearGradient>
											</defs>
											<g id="Group_172519" data-name="Group 172519" transform="translate(-9.973 -7.021)">
												<g id="Group_172518" data-name="Group 172518" transform="translate(9.973 7.021)">
													<path id="Path_251073" data-name="Path 251073"
														d="M18.632,7.021a14.755,14.755,0,0,0-5.921,1.117,5.941,5.941,0,0,0-1.927,1.3,2.76,2.76,0,0,0-.81,1.87l.006,5.742q0,.029-.006.058c0,.069,0,.139.006.2l.012,5.5a.7.7,0,0,0-.017.1,2.129,2.129,0,0,0,.017.278L10,29.01a.7.7,0,0,0,.012.116c.226,1.32,1.412,2.246,2.946,2.888a15.2,15.2,0,0,0,5.69,1.007c3.189,0,5.967-.741,7.524-2.1.133.006.266.012.4.012a7.814,7.814,0,0,0,1.378-.121.7.7,0,0,0,.533-.451l.37-1.042q.294-.106.579-.237l1,.475a.7.7,0,0,0,.7-.058,7.935,7.935,0,0,0,1.939-1.945.7.7,0,0,0,.058-.695l-.474-1c.092-.185.168-.382.243-.573l1.042-.37a.7.7,0,0,0,.451-.533A8.442,8.442,0,0,0,34.5,23a8.318,8.318,0,0,0-.116-1.372.7.7,0,0,0-.451-.538l-1.042-.37q-.106-.292-.237-.573l.475-1a.7.7,0,0,0-.058-.695,8.06,8.06,0,0,0-1.945-1.945.7.7,0,0,0-.7-.058l-1,.475q-.284-.131-.579-.237l-.371-1.042a.7.7,0,0,0-.532-.451,6.124,6.124,0,0,0-.654-.087c.006-1.308.012-2.587.017-3.8a2.755,2.755,0,0,0-.816-1.875,5.967,5.967,0,0,0-1.928-1.3,14.759,14.759,0,0,0-5.933-1.111Zm0,1.389a13.544,13.544,0,0,1,5.36.99,4.857,4.857,0,0,1,1.487.984,1.349,1.349,0,0,1,.44.926,1.348,1.348,0,0,1-.44.926,4.857,4.857,0,0,1-1.487.984,13.443,13.443,0,0,1-5.36.984,13.483,13.483,0,0,1-5.348-.99A4.857,4.857,0,0,1,11.8,12.23a1.341,1.341,0,0,1-.434-.92,1.341,1.341,0,0,1,.434-.92,4.657,4.657,0,0,1,1.488-.984,13.571,13.571,0,0,1,5.348-1ZM11.368,13.7a7.131,7.131,0,0,0,1.343.781,14.759,14.759,0,0,0,5.921,1.111,14.659,14.659,0,0,0,5.933-1.111,7.1,7.1,0,0,0,1.343-.775c0,.463,0,.914-.006,1.395a6.076,6.076,0,0,0-.706.093.7.7,0,0,0-.533.451l-.37,1.036c-.2.075-.388.151-.579.243l-1-.475a.7.7,0,0,0-.7.058,7.934,7.934,0,0,0-1.939,1.945.7.7,0,0,0-.058.695l.382.8a.7.7,0,0,0-.185-.012q-.791.071-1.586.069a13.475,13.475,0,0,1-5.348-1,4.754,4.754,0,0,1-1.487-.978,1.48,1.48,0,0,1-.429-.793Zm15.194,2.761h.006a6.487,6.487,0,0,1,.747.046l.336.949a.7.7,0,0,0,.457.434,5.5,5.5,0,0,1,.99.411.7.7,0,0,0,.631.017l.909-.434a6.638,6.638,0,0,1,1.048,1.048l-.434.915a.7.7,0,0,0,.017.625,5.153,5.153,0,0,1,.411,1,.7.7,0,0,0,.434.457l.949.336a5.95,5.95,0,0,1,0,1.482l-.949.342a.7.7,0,0,0-.434.451,5.49,5.49,0,0,1-.411.99.7.7,0,0,0-.017.631l.434.909a6.432,6.432,0,0,1-1.048,1.053l-.915-.434a.7.7,0,0,0-.625.012,5.28,5.28,0,0,1-.99.417.7.7,0,0,0-.457.428l-.336.949a6.5,6.5,0,0,1-.747.052c-.243,0-.492-.023-.741-.046l-.336-.955a.7.7,0,0,0-.457-.428,5.28,5.28,0,0,1-.99-.417.7.7,0,0,0-.625-.012l-.915.434a6.627,6.627,0,0,1-1.048-1.048l.434-.915a.7.7,0,0,0-.017-.625,5.545,5.545,0,0,1-.411-1,.7.7,0,0,0-.434-.457l-.949-.336a5.95,5.95,0,0,1,0-1.482l.949-.336a.7.7,0,0,0,.434-.457,5.156,5.156,0,0,1,.411-1,.7.7,0,0,0,.017-.625l-.434-.915A6.407,6.407,0,0,1,22.5,17.885l.909.434a.7.7,0,0,0,.631-.017,5.376,5.376,0,0,1,1-.411.7.7,0,0,0,.452-.434l.342-.949a6.169,6.169,0,0,1,.729-.046Zm-15.188,3.05a7.032,7.032,0,0,0,1.337.77A14.778,14.778,0,0,0,18.632,21.4h.214a.7.7,0,0,0-.087.232,8.186,8.186,0,0,0,0,2.744.7.7,0,0,0,.451.538l1.042.37c.064.18.139.353.22.527a.7.7,0,0,0-.324-.058q-.756.071-1.516.069a13.5,13.5,0,0,1-5.348-1,4.753,4.753,0,0,1-1.487-.984,1.453,1.453,0,0,1-.417-.741Zm.006,5.811a7.166,7.166,0,0,0,1.331.77,14.758,14.758,0,0,0,5.921,1.117c.451,0,.9-.017,1.331-.046a.7.7,0,0,0,.116.388A7.853,7.853,0,0,0,22.024,29.5a.7.7,0,0,0,.695.058l1-.475c.191.087.382.168.579.237l.347.978a12.713,12.713,0,0,1-6,1.337,13.834,13.834,0,0,1-5.151-.9c-1.291-.538-1.991-1.25-2.107-1.806Z"
														transform="translate(-9.973 -7.021)" fill="url(#linear-gradient02)" />
													<path id="Path_251074" data-name="Path 251074"
														d="M70.326,60.206a4.356,4.356,0,1,0,4.359,4.359A4.369,4.369,0,0,0,70.326,60.206Zm0,1.389a2.957,2.957,0,1,1-2.1.866A2.961,2.961,0,0,1,70.326,61.6Z"
														transform="translate(-53.738 -48.589)" fill="url(#linear-gradient02)" />
												</g>
											</g>
										</svg></span>Powerful Management via WHM
								</div>
								<div class="cpanel-mngmnt-data">With WHM, you will get an easy-to-use and powerful server management tool to manage
									your server and create accounts, manage settings, and tweak performance from one place.</div>
							</div>
							</div>
							<div class="cpanel-mngmnt-cnt-row">
								<div class="cpanel-mngmnt-cnt-box">
									<div class="cpanel-mngmnt-title">
										<span>
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18.66"
												height="26" viewBox="0 0 18.66 26">
												<defs>
													<linearGradient id="linear-gradient03" y1="0.554" x2="1" y2="0.578"
														gradientUnits="objectBoundingBox">
														<stop offset="0" stop-color="#3838ff" />
														<stop offset="1" stop-color="#d32a2d" />
													</linearGradient>
												</defs>
												<g id="Group_172523" data-name="Group 172523" transform="translate(-72.267)">
													<path id="Path_251081" data-name="Path 251081"
														d="M88.642,10.664a2.274,2.274,0,0,0-.842.161A2.286,2.286,0,0,0,84.754,9.3a2.29,2.29,0,0,0-.73-1.143,5.332,5.332,0,1,0-6.807,1.991v4.361l-.4-.4a2.666,2.666,0,0,0-3.77,3.77l4.291,4.291,1.466,3.37a.762.762,0,0,0,.7.458h9.144a.762.762,0,0,0,.723-.521,31.2,31.2,0,0,0,1.559-9.729v-2.8A2.288,2.288,0,0,0,88.642,10.664ZM77.217,5.332V8.379a3.809,3.809,0,1,1,5.332-.762,2.275,2.275,0,0,0-.762.131V5.332a2.285,2.285,0,0,0-4.57,0ZM89.4,15.75a29.747,29.747,0,0,1-1.314,8.727H80l-1.324-3.045a.761.761,0,0,0-.16-.235L74.124,16.8a1.142,1.142,0,0,1,1.616-1.616l1.7,1.7a.762.762,0,0,0,1.3-.539V5.332a.762.762,0,0,1,1.523,0v7.617a.762.762,0,0,0,1.523,0V9.9a.762.762,0,1,1,1.523,0v3.047a.762.762,0,1,0,1.523,0V11.426a.762.762,0,0,1,1.523,0v1.523a.762.762,0,1,0,1.523,0,.762.762,0,1,1,1.523,0v2.8Z"
														fill="url(#linear-gradient03)" />
												</g>
											</svg>
										</span>1-Click Installations
									</div>
									<div class="cpanel-mngmnt-data">If you want to install WordPress or any other app, cPanel offers a 1-click
										installation, eliminating the need for coding and other hassles.</div>
								</div>
								<div class="cpanel-mngmnt-cnt-box">
									<div class="cpanel-mngmnt-title">
										<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26.865"
												height="26" viewBox="0 0 26.865 26">
												<defs>
													<linearGradient id="linear-gradient04" x1="0.033" y1="0.397" x2="1" y2="0.391"
														gradientUnits="objectBoundingBox">
														<stop offset="0" stop-color="#3838ff" />
														<stop offset="1" stop-color="#d32a2d" />
													</linearGradient>
												</defs>
												<g id="Group_172524" data-name="Group 172524" transform="translate(-0.949 -8.326)">
													<path id="Path_251082" data-name="Path 251082"
														d="M15.969,20.116a.84.84,0,0,0-.488.762V21.6h-.26V18.867a2.1,2.1,0,1,0-1.679,0V21.6h-.259v-.716a.84.84,0,0,0-.488-.762,3.795,3.795,0,1,1,3.174,0Zm-1.587-2.753a.422.422,0,1,0-.422-.422A.422.422,0,0,0,14.382,17.364Zm1.486,6.716H12.9v-.806h2.97v.806ZM14.382,11.195A5.474,5.474,0,0,0,11.6,21.386v.343a.839.839,0,0,0-.386.706V24.16a1.6,1.6,0,0,0,1.6,1.6h3.13a1.6,1.6,0,0,0,1.6-1.6V22.434a.839.839,0,0,0-.386-.706v-.343a5.474,5.474,0,0,0-2.779-10.191ZM26.136,26.162V10.792a.787.787,0,0,0-.787-.787H3.415a.788.788,0,0,0-.787.787V26.162a.788.788,0,0,0,.787.787H25.348a.787.787,0,0,0,.787-.787Zm-10.6,3.9H13.227l.09-1.438h2.13l.09,1.438Zm2.956,2.582H10.271v-.9h8.222v.9ZM25.348,8.326H3.415A2.469,2.469,0,0,0,.949,10.792V26.161a2.469,2.469,0,0,0,2.466,2.466h8.22l-.09,1.438H10.218a1.629,1.629,0,0,0-1.627,1.627v1.795a.84.84,0,0,0,.84.84h9.9a.839.839,0,0,0,.84-.84V31.692a1.628,1.628,0,0,0-1.626-1.627H17.219l-.09-1.438h8.219a2.467,2.467,0,0,0,2.466-2.466V10.792a2.467,2.467,0,0,0-2.466-2.466Z"
														fill-rule="evenodd" fill="url(#linear-gradient04)" />
												</g>
											</svg></span>Resource Monitoring
									</div>
									<div class="cpanel-mngmnt-data">With cPanel VPS, you can keep an eye on your server’s usage in real-time to know how much CPU, RAM, and bandwidth you are using to stay in control.</div>
								</div>
							</div>
							<div class="cpanel-mngmnt-cnt-row">
								<div class="cpanel-mngmnt-cnt-box">
									<div class="cpanel-mngmnt-title">
										<span>
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24.644"
												height="26" viewBox="0 0 24.644 26">
												<defs>
													<linearGradient id="linear-gradient05" x1="0.5" x2="0.5" y2="1"
														gradientUnits="objectBoundingBox">
														<stop offset="0" stop-color="#3838ff" />
														<stop offset="1" stop-color="#d32a2d" />
													</linearGradient>
												</defs>
												<g id="Group_172525" data-name="Group 172525" transform="translate(-2.59 -1.115)">
													<path id="Path_251083" data-name="Path 251083"
														d="M6.315,10.076A2.527,2.527,0,1,1,8.843,7.548,2.529,2.529,0,0,1,6.315,10.076Zm0-3.676A1.149,1.149,0,1,0,7.464,7.548,1.15,1.15,0,0,0,6.315,6.4Z"
														transform="translate(-0.097 -0.316)" fill="url(#linear-gradient05)" />
													<circle id="Ellipse_750" data-name="Ellipse 750" cx="0.689" cy="0.689" r="0.689"
														transform="translate(25.324 25.133)" fill="url(#linear-gradient05)" />
													<path id="Path_251084" data-name="Path 251084"
														d="M14.914,27.234a12.357,12.357,0,0,1-10.706-6.22l1.2-.684a10.976,10.976,0,0,0,9.509,5.525,10.866,10.866,0,0,0,7.176-2.683.689.689,0,1,1,.931,1.016,12.241,12.241,0,0,1-8.107,3.044Zm10.706-6.22-1.2-.684a10.948,10.948,0,0,0-5.774-15.7.694.694,0,0,1-.444-.845.687.687,0,0,1,.88-.462,12.327,12.327,0,0,1,6.535,17.7ZM5.65,9.1a10.849,10.849,0,0,0-1.507,7.747.69.69,0,0,1-1.351.285,12.727,12.727,0,0,1-.2-2.215,12.186,12.186,0,0,1,2-6.718,1.772,1.772,0,0,0,1.057.9ZM14.914,2.59V3.969A10.977,10.977,0,0,0,7.865,6.542a1.812,1.812,0,0,0-1.029-.919,12.2,12.2,0,0,1,6.994-2.978,10.577,10.577,0,0,1,1.084-.055Z"
														transform="translate(0 -0.12)" fill="url(#linear-gradient05)" />
													<path id="Path_251085" data-name="Path 251085"
														d="M13.566,5.1a.689.689,0,0,1,.163-.961L14.8,3.378a.177.177,0,0,0,.076-.153.172.172,0,0,0-.085-.147l-1.119-.7a.689.689,0,0,1,.73-1.169l1.119.7A1.559,1.559,0,0,1,15.6,4.5l-1.076.765a.689.689,0,0,1-.961-.163Zm10.7,13.129a.689.689,0,0,1,.664.713l-.047,1.32a.176.176,0,0,0,.074.153.171.171,0,0,0,.168.022l1.236-.464a.689.689,0,1,1,.485,1.29l-1.236.464A1.557,1.557,0,0,1,23.5,20.215l.047-1.32a.689.689,0,0,1,.713-.664ZM7.232,20.618a.689.689,0,0,1-.874.432l-1.251-.424a.18.18,0,0,0-.238.183l.09,1.317a.689.689,0,0,1-1.375.094L3.495,20.9A1.56,1.56,0,0,1,5.55,19.32l1.251.424a.689.689,0,0,1,.432.874Zm7.755,1.3a7.122,7.122,0,1,1,7.122-7.122A7.131,7.131,0,0,1,14.987,21.917Zm0-12.866a5.744,5.744,0,1,0,5.744,5.744A5.751,5.751,0,0,0,14.987,9.051Z"
														transform="translate(-0.073)" fill="url(#linear-gradient05)" />
													<path id="Path_251086" data-name="Path 251086"
														d="M15.737,22.495c-1.961,0-2.987-3.583-2.987-7.122S13.776,8.25,15.737,8.25s2.987,3.583,2.987,7.122S17.7,22.495,15.737,22.495Zm0-12.866c-.481,0-1.608,1.954-1.608,5.744s1.128,5.744,1.608,5.744,1.608-1.954,1.608-5.744S16.217,9.629,15.737,9.629Z"
														transform="translate(-0.823 -0.578)" fill="url(#linear-gradient05)" />
													<path id="Path_251087" data-name="Path 251087" d="M9,15.25H21.866v1.379H9Z"
														transform="translate(-0.519 -1.145)" fill="url(#linear-gradient05)" />
												</g>
											</svg>
										</span>Robust Ecosystem
									</div>
									<div class="cpanel-mngmnt-data">cPanel offers numerous tools and add-ons, creating a robust ecosystem that provides flexibility and features to help you grow your website.</div>
								</div>
								<div class="cpanel-mngmnt-cnt-box">
									<div class="cpanel-mngmnt-title">
										<span>
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26"
												height="26" viewBox="0 0 26 26">
												<defs>
													<linearGradient id="linear-gradient06" x1="0.089" y1="0.444" x2="0.917" y2="0.457"
														gradientUnits="objectBoundingBox">
														<stop offset="0" stop-color="#3838ff" />
														<stop offset="1" stop-color="#d32a2d" />
													</linearGradient>
												</defs>
												<g id="Group_172526" data-name="Group 172526" transform="translate(0)">
													<path id="Path_251088" data-name="Path 251088"
														d="M2.311,8.423.652,8.415a.655.655,0,0,1,.005-1.31l1.653.008V3.8A1.28,1.28,0,0,1,3.591,2.52H7.105v0L7.113.652a.655.655,0,1,1,1.31.007L8.415,2.52h1.3v0L9.725.652a.655.655,0,1,1,1.31.007L11.026,2.52h1.318v0L12.352.652a.655.655,0,1,1,1.31.007L13.654,2.52h1.3v0L14.965.652a.655.655,0,1,1,1.31.007L16.266,2.52h1.31v0L17.585.652a.655.655,0,1,1,1.31.007L18.886,2.52h3.449a1.355,1.355,0,0,1,1.355,1.356v3.23l1.658.007a.655.655,0,1,1-.007,1.31l-1.652-.007v1.3l1.658.008a.655.655,0,1,1-.007,1.31l-1.652-.008v1.316l1.658.008a.655.655,0,1,1-.007,1.31l-1.652-.008v1.3l1.658.008a.655.655,0,1,1-.007,1.31l-1.652-.008v1.31l1.658.008a.655.655,0,1,1-.007,1.31l-1.652-.008v3.259a1.23,1.23,0,0,1-1.229,1.229H18.887c.005.035,0,1.973,0,1.973a.655.655,0,1,1-1.31-.007s.012-1.934.017-1.966H16.275c.005.035,0,1.973,0,1.973a.655.655,0,1,1-1.31-.007s.012-1.934.017-1.966H13.649c.005.035,0,1.973,0,1.973a.655.655,0,1,1-1.31-.007s.012-1.934.017-1.966h-1.32c.005.035,0,1.973,0,1.973a.655.655,0,1,1-1.31-.007s.012-1.934.017-1.966H8.416c.005.035,0,1.973,0,1.973a.655.655,0,1,1-1.31-.007s.012-1.934.017-1.966H3.541a1.23,1.23,0,0,1-1.23-1.23V18.893L.652,18.887a.655.655,0,1,1,.005-1.31l1.653.007v-1.3L.652,16.275a.655.655,0,0,1,.005-1.31l1.653.008V13.656L.652,13.648a.655.655,0,0,1,.005-1.31l1.653.008v-1.3L.652,11.035a.655.655,0,0,1,.005-1.31l1.653.008Zm1.31,13.642H22.379V3.876a.045.045,0,0,0-.013-.033.046.046,0,0,0-.031-.013H3.621ZM20.849,6.521V19.479a1.381,1.381,0,0,1-1.381,1.381H6.51A1.382,1.382,0,0,1,5.13,19.479V6.521A1.382,1.382,0,0,1,6.51,5.14H19.469a1.381,1.381,0,0,1,1.381,1.381Zm-1.205,0a.176.176,0,0,0-.176-.176H6.51a.176.176,0,0,0-.176.176V19.479a.176.176,0,0,0,.176.176H19.469a.176.176,0,0,0,.176-.176Z"
														transform="translate(0 0)" fill-rule="evenodd" fill="url(#linear-gradient06)" />
													<path id="Path_251089" data-name="Path 251089"
														d="M138.967,143.959a.655.655,0,1,1,0-1.31h5.524a.655.655,0,1,1,0,1.31Zm11.135-7.328a.655.655,0,0,1-1.31,0v-2.482l-2.376-.051a.654.654,0,1,1,.029-1.309l3.017.064a.655.655,0,0,1,.641.655Zm-11.135,4.708a.655.655,0,0,1,0-1.31h3.5a.655.655,0,0,1,0,1.31Z"
														transform="translate(-131.207 -125.967)" fill-rule="evenodd"
														fill="url(#linear-gradient06)" />
												</g>
											</svg>
										</span>Centralized Control
									</div>
									<div class="cpanel-mngmnt-data">With cPanel, you can avoid rushing between tools and tabs & enjoy centralized controls for emails, databases, files, and domains from one place.</div>
								</div>
							</div>
							</div>
							</div>
				<div class="col-lg-5">
					<div class="cpanel-mngmnt-img">
						<img src="/assets/images/cpanel_hosting/cpanel_management_promotion.webp" alt="cpanel_management_promotion">
					</div>
				</div>
			</div>
		</div>
	</section>



	<section class="cpanel-sec-ftr-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="cpanel-sec-ftr-img">
					<img src="/assets/images/cpanel_hosting/cpanel-security-features.webp" alt="cpanel-security-features">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="cpanel-sec-ftr-cnt">
						<div class="cpanel-sec-ftr-box">
							<div class="cpanel-sec-ftr-title">
							<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="29.942" viewBox="0 0 30 29.942">
  <defs>
    <linearGradient id="linear-gradient" x1="0.196" y1="0.021" x2="0.857" y2="0.775" gradientUnits="objectBoundingBox">
      <stop offset="0" stop-color="#068c46"/>
      <stop offset="1" stop-color="#068c46" stop-opacity="0"/>
    </linearGradient>
  </defs>
  <g id="Group_171414" data-name="Group 171414" transform="translate(0.466 0.466)">
    <g id="Layer_2" data-name="Layer 2" transform="translate(-0.466 -0.466)">
      <g id="Layer_1_copy_8" data-name="Layer 1 copy 8" transform="translate(0 0)">
        <g id="_1" data-name="1">
          <circle id="Ellipse_538" data-name="Ellipse 538" cx="14.971" cy="14.971" r="14.971" fill="#1dd882"/>
          <path id="Path_248390" data-name="Path 248390" d="M141.7,161.573a14.869,14.869,0,0,1-9.749,12.216l-12.476-12.476L119,159.891l.136-1.286.8-.711,1.617-.178,1.034.478L125,160.609l6.308-6.307,1.709-.432,1.407.432Z" transform="translate(-111.7 -144.546)" fill="url(#linear-gradient)"/>
          <path id="Path_248391" data-name="Path 248391" d="M128.5,150.84l-6.308,6.307-2.417-2.417a2.2,2.2,0,0,0-3.116,3.116l3.837,3.837c.041.049.085.1.131.144a2.218,2.218,0,0,0,3.128,0c.046-.046.09-.095.131-.144l7.729-7.728a2.2,2.2,0,1,0-3.116-3.116Z" transform="translate(-108.883 -141.084)" fill="#fff"/>
        </g>
      </g>
    </g>
  </g>
</svg></span>	Two-Factor Authentication
							</div>
							<div class="cpanel-sec-ftr-title">
								You don’t have to worry about when you can add that extra layer of login security with a simple code received on your phone
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>




@endif
 <section class="vps-features  head-tb-p-40" id="features">
        @if(!empty($FeaturesData) && count($FeaturesData) >0)
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="text_head">Features Of Our Cpanel VPS Hosting</h2>
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
                                    <div class="feature-ul d-flex flex-wrap" id="vps-all-features">
                                        @foreach($FeaturesData as $Features)
                                        
                                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                                <div class="content-main align-self-start" @if ($uagent !="mobile" )data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100" @endif>
                                                    <div class="{{$featureIconDivClass}}"><i class="{{$Features->varIconClass}}"></i></div>
                                                    <span>{{$Features->varTitle}}</span>
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
@endsection
