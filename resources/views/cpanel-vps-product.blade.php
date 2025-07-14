@extends('layouts.app')
@section('content')
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
@endif
@endsection
