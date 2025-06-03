@if(!empty($FeaturedProductsData) && count($FeaturedProductsData) >0)
<section class="most-power-plans head-tb-p-40">
    <div class="container">
        <div class="section-heading">
           @if(Request::segment(2) == 'dedicated-servers')
            <h2 class="text_head text-center">Looking For Something Else?</h2>
            @elseif(Request::segment(1) == 'web-hosting')
            <h2 class="text_head text-center">Planning to Throttle Your Project to Success?</h2>
            <p class="wh-powerplan-cnt text-center">Discover Our Robust and Powerful Solutions!</p>

           @else

            <h2 class="text_head text-center">Looking For Something Else?</h2>
        @endif
          
        </div>
        <div class="row justify-content-center">
            @foreach($FeaturedProductsData as $FeaturedProducts)
            <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-xs-12">
                <div class="most-power-card">
                    <div class="power-card-tittle">
                        <span class="power-card-t-hd">{{$FeaturedProducts->varTitle}}</span>
                        <p>{{$FeaturedProducts->varShortDescription}}</p>
                        <div class="most-power-circle-ol">
                            <div class="most-power-circle">
                                <div class="frnt-cnt">
                                    Starting @
                                </div>
                                <div class="price-cnt">
                                    @if(Config::get('Constant.sys_currency') == 'INR')
                                    ₹<span></i>{{ Config::get('Constant.'.$FeaturedProducts->varWHMCSFieldName.'_INR') }}</span>/mo*
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="power-card-data">
                        <div class="power-card-cnt">
                            @php $FeaturedProductsDec = explode("\n",$FeaturedProducts->varFeature); @endphp
                            <ul>
                                @foreach($FeaturedProductsDec as $info)
                                <li>
                                    {{$info}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="power-plans-btn">
                            @php
                                if(request()->segment(1) != 'email'){
                                $title = str_replace(' Hosting', '', $FeaturedProducts->varTitle);                              
                            }else{
                                $title = $FeaturedProducts->varTitle;                              

                            }

                                // For web hosting page, Dedicated server
                                if(request()->segment(1) == 'web-hosting' && $FeaturedProducts->varTitle == 'Dedicated Server'){
                                    $title = str_replace(' Server', ' Host', $FeaturedProducts->varTitle);
                                }       

                                $button = '';
                                if (request()->segment(2) == 'vps-hosting' && $FeaturedProducts->varTitle == 'Windows VPS Hosting') {
                                    $button = 'Check'; // For VPS Hosting page, Windows VPS Hosting
                                } elseif (request()->segment(2) == 'vps-hosting') {
                                    $button = 'Discover'; // For VPS Hosting page
                                }elseif (request()->segment(2) == 'windows-vps-hosting') {
                                    $button = 'Browse'; // For Windows VPS Hosting page
                                }elseif ((request()->segment(1) == 'web-hosting' && $FeaturedProducts->varTitle == 'Dedicated Server') || request()->segment(2) == 'vps-hosting-india') {
                                    $button = 'Get'; // For web hosting page, Dedicated server 
                                }
                                else{
                                    $button = 'Browse'; // Default all buttons title is Browse
                                }
                            @endphp
                            <a href="{{$FeaturedProducts->varButtonLink}}" class="buy-now-btn" title="{{$button}} {{$title}}">{{$button}} {{$title}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif