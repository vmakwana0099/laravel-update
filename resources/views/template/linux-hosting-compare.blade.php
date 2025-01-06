<div class="vps-plan-main compare-high head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="section-heading text-center">
            <h2 class="txt-head" data-aos="fade-up">It's hard to find a match to compare us but let's try anyway...</h2>
            <span>Better Pricing • Fast SSD Storage • Hack-free Protection • Real 24/7 Technical Support</span>
            </div>
            <div class="row">
                <div class="table-relative table-responsive" data-aos="fade-left" data-aos-easing="ease-out-back" data-aos-delay="600">
                    <table class="table-plan-vps">
                        <tr>
                            <th class="title bg-none"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/logo.webp" alt="logo" class="hostitsmart-logo"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/bigrock_logo.webp" alt="bigrock_logo"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/godaddy.webp" alt="godaddy"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/hoster-gator.webp" alt="hoster-gator"></th> 
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/ideastack.webp" alt="ideastack"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/webji.webp" alt="webji"></th>
                        </tr>
                        <tr>
                            <td class="boldfonts">Plan</td>
                            <td class="bg_blue">Professional</td>
                            <td>Pro</td>
                            <td>Deluxe</td>
                            <td>Baby</td>
                            <!--<td>Value</td>-->
                            <!--<td>Premium</td>-->
                            <td>Level 2</td>
                            <!--<td>Value</td>-->
                            <td>Elite</td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Price</td>
                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                            <td class="bg_blue"><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{!! Config::get('Constant.LINUX_HOSTING_PROFESSIONAL_PRICE_36_INR') !!}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">249</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">259.59</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">249</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">68</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">750</span><span class="per-month">/mo</span></span></td>
                            @php } else { @endphp 
                            <td class="bg_blue"><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{!! Config::get('Constant.LINUX_HOSTING_PERFORMANCE_PRICE_36_USD') !!}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">3.03</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">3.16</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">3.03</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">0.83</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">9.14</span><span class="per-month">/mo</span></span></td>
                            @php } @endphp
                        </tr>
                        <tr>
                            <td class="boldfonts">Free SSL certificate</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Disk space</td>
                            <td class="bg_blue">20GB</td>
                            <td>Unlimited</td>
                            <td>50GB</td>
                            <td>Unlimited</td>
                            <td>5GB</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Bandwidth</td>
                            <td class="bg_blue">Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                            <td>50GB</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Unlimited email accounts</td>
                            <td class="bg_blue"><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Moneyback guarantee</td>
                            <td class="bg_blue">30Days</td>
                            <td>30Days</td>
                            <td>30Days</td>
                            <td>30Days</td>
                            <td>15Days</td>
                            <td>30Days</td>
                        </tr>
                         <tr>
                            <td class="boldfonts">Unlimited Databases</td>
                            <td class="bg_blue"><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Unlimited Subdomains</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td>50</td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <td class="boldfonts">24x7 Support promise</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Unlimited FTP Users</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr>
                        
                        <tr>
                            <td class="boldfonts">Instant Chat Response</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
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
                            <td><a href="{{url('/')}}/linux-hosting-bigrock-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/linux-hosting-godaddy-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/linux-hosting-hostgator-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/linux-hosting-ideastack-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/linux-hosting-b4uindia-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>