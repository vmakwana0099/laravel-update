<?php
// echo '<pre>'; print_r($value->varWHMCSFieldName);exit;
?>
<section class="pricing-section pricing-cstm-section head-tb-p-40 gray-light-bg" id="pricing-section-homepage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="section-heading text-center" id="services_section_plan">
                    <h2 class="text_head">Pick your Perfect Hosting Plan <span class="space_br"> Promising Performance at Affordable Prices!</span></h2>
                    <p class="text_cnt">Offering Secure and Stable Servers to Host all your Dreams...</p>
                </div>
            </div>
        </div>
        <div class="row">
        @php $i = 1; $show = '';  @endphp 
				@foreach($productData as $_key => $value)
				<?php
				// echo '<pre>'; print_r($value);  
// echo '<pre>'; print_r($value->varWHMCSFieldName);exit;
				
				?> 
					@if($i == 1)
						@php $show = 600;  @endphp 
					@elseif($i == 2 )
						@php $show = 300;  @endphp 
					@elseif($i == 3 )
						@php $show = 100;  @endphp 
					@elseif($i == 4 )
						@php $show = 100;  @endphp 
					@elseif($i == 5 )
						@php $show = 300;  @endphp 
					@elseif($i == 6 )
						@php $show = 600;  @endphp 
					@endif

                    @php 
                            $width = 0;
                            $height = 0;

                            if ($value->varListingIconClass == "shared_hosting") {
                                $width = 48;
                                $height = 55;
                            } elseif ($value->varListingIconClass == "wordpress") {
                                $width = 55;
                                $height = 55;
                            } elseif ($value->varListingIconClass == "vps") {
                                $width = 48;
                                $height = 57;
                            } elseif ($value->varListingIconClass == "window_vps") {
                                $width = 66;
                                $height = 57;
                            } elseif ($value->varListingIconClass == "dedicated_server") {
                                $width = 58;
                                $height = 57;
                            } else {
                                $width = 54;
                                $height = 54;
                            }
                    @endphp

            <div class="col-lg-4 col-md-6">
                <div class="box" data-aos="fade-down" data-aos-delay="{{$show}}" >
                    <div class="popular-price  pricing-new-wrapper ">
                        <div class="pricing-icon text-center">
                            <img src="../assets/images/Homepage/{{ $value->varListingIconClass }}.webp" alt="{{ $value->varListingIconClass }}" width="{{$width}}" height="{{$height}}">

                        </div>                        
                    <div class="text-center">
                      <a class="package-title text-center" href="{{url($value->productCatAlias.'/'.$value->productAlias)}}"> 
                    <div class="package-title-fw text-center"> <span> {{ explode(' ', $value->varTitle)[0] }} </span>{{ explode(' ', $value->varTitle)[1] }} @isset(explode(' ', $value->varTitle)[2])
    {{ explode(' ', $value->varTitle)[2] }}
@endisset</div></a>
                    </div>
                       {!! $value->txtHomePageDesc !!}
                        {{-- <p class="small mb-2"> Economical</p>
                        <p class="small mb-2"> Easy Administration</p>
                        <p class="small mb-2"> High Durability</p> --}}
                        <div class="pricing-price pt-4">
                            <small>Starting at</small>
                            <div class="home-page-plans-cutprice line-through">
                                <span class="small">₹{{Config::get('Constant.'.$value->varWHMCSFieldName.'_INR_WRONG')}}</span><span class="price-cycle">/mo</span> <br>
                               
                            </div>
                            <div class="h2">
                                @if(Config::get('Constant.sys_currency') == 'INR')
                                {!! Config::get('Constant.sys_currency_symbol') !!}{{ Config::get('Constant.'.$value->varWHMCSFieldName.'_INR') }}<span class="price-cycle h4">/mo</span>                               
                                @elseif(Config::get('Constant.sys_currency') == 'CAD')
                                {!! Config::get('Constant.sys_currency_symbol') !!}{{ Config::get('Constant.'.$value->varWHMCSFieldName.'_CAD') }}<span class="price-cycle h4">/mo</span>
                                @else
                                {!! Config::get('Constant.sys_currency_symbol') !!}</i> {{ Config::get('Constant.'.$value->varWHMCSFieldName.'_USD') }}<span class="price-cycle h4">/mo</span>
                                @endif
                            </div>
                           
                        </div>
                    </div>
                    <span class="box_p_1"></span>
                    <span class="box_p_11"></span>
                    <span class="box_p_3"></span>
                    <span class="box_p_4"></span>
                    <span class="box_p_2"></span>
                    <span class="box_p_20"></span>
                    <span class="box_p_21"></span>
                    <span class="box_p_22"></span>

                    <a href='{{ url($value->productCatAlias.'/'.$value->productAlias) }}'class="btn_bottom"  id="{{ isset($value->varTitle) && !empty($value->varTitle)?strtolower(str_replace(" ", "_", $value->varTitle)):"" }}" title="Get Started Now"><span class="btn_p"></span>Get Started Now</a>

                    {{-- <button class="btn_bottom a" id="{{ isset($value->varTitle) && !empty($value->varTitle)?strtolower(str_replace(" ", "_", $value->varTitle)):"" }}" title="Get Started Now"  onclick="window.location.href='{{url($value->productCatAlias.'/'.$value->productAlias)}}';"> --}}


                    <!--Button For Mobile-->
                    <a href="{{ url($value->productCatAlias.'/'.$value->productAlias) }}" class="btn_bottom_for_mbl" title="Get Started Now">Get Started Now</a>
                    <!--End-->
                </div>
            </div>
            @php $i++; @endphp
@endforeach
        </div>

    </div>
</section>