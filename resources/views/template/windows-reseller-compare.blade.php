<div class="vps-plan-main compare-medium">
    <div class="container">
        <div class="plan-div">
            <h2 class="vps-plan-title aos-init" data-aos="fade-up">It's hard to find a match to compare us but lets try anyway...</h2><span class="plan-second-title aos-init" data-aos="fade-up">Better Pricing • Fast SSD Storage • Hack-free Protection • Real 24/7 Technical Support</span>
            <div class="row row-posi">
                <div class="white-overlay d-md-none d-block"><a href="javascript:void(0)" data-role="scroll-to-next" class="overlay_link"><i class="la la-angle-double-right"></i></a></div>
                <div class="table-relative aos-init" data-aos="fade-left" data-aos-easing="ease-out-back" data-aos-delay="600">
                    <table class="table-plan-vps">
                        <tr>
                            <th class="title bg-none"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/logo.png" class="hostitsmart-logo" alt="logo"></th> 
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/bigrock_logo.png" alt="bigrock_logo"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/hoster-gator.png" alt="hoster-gator"></th> 
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/ideastack.png" alt="ideastack"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/go-hosting.png" alt="go-hosting"></th> 
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/b4uindia.png" alt="b4uindia"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/hostripple.png" alt="hostripple"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/resellerclub-logo.png" alt="resellerclub-logo"></th>
                        </tr>
                        <tr>
                            <td class="boldfonts">Plan</td>
                            <td class="bg_blue">Performance</td>
                            <td>Deluxe</td>
                            <td>Starter</td>
                            <td>Level 2</td>
                            <td>Standard</td>
                            <td>WR-25GB</td>
                            <td>Business</td>
                            <td>R2</td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Price</td>
                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                            <td class="bg_blue"><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{!! Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_INR') !!}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">1929</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">1325</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">618.53</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">1695</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">1200</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">2150</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">1495</span><span class="per-month">/mo</span></span></td>
                            @php } else { @endphp 
                            <td class="bg_blue"><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{!! Config::get('Constant.WINDOWS_RESELLER_HOSTING_PERFORMANCE_PRICE_36_USD') !!}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">29.18</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">18.96</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">49.56</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">24.82</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">24.82</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">26.94</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">39.42</span><span class="per-month">/mo</span></span></td>
                            @php } @endphp
                        </tr>
                        <tr>
                            <td class="boldfonts">Storage</td>
                            <td class="bg_blue">60GB</td>
                            <td>50GB</td>
                            <td>50GB</td>
                            <td>Unlimited</td>
                            <td>20GB</td>
                            <td>25GB</td>
                            <td>Unlimited</td>
                            <td>25GB</td>

                        </tr>
                        <tr>
                            <td class="boldfonts">Unlimited Bandwidth	</td>
                            <td class="bg_blue">1200GB</td>
                            <td>1000GB</td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td>500GB</td>

                        </tr>
                        <tr>
                            <td class="boldfonts">Unlimited Domains</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Unlimited Subdomains</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Unlimited Databases</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Unlimited Email Accounts</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr class="block">
                            <td colspan="7" style="visibility:hidden;"></td>
                        </tr>
                        <tr class="last-row">
                            <td class="boldfonts"></td>
                            <td class="border-radius"><a href="javascript:void(0)">See Plans</a></td>
                            @php 
                            //session_unset(); 
                            $LastUrl = Request::url(); 
                            session(['variableName' => $LastUrl]);
                            @endphp
                            <td><a href="{{url('/')}}/windows-reseller-hosting-bigrock-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/windows-reseller-hosting-hostgator-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/windows-reseller-hosting-ideastack-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/windows-reseller-hosting-go4hosting-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/windows-reseller-hosting-b4uindia-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/windows-reseller-hosting-hostripples-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/windows-reseller-hosting-resellerclub-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>