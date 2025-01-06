@php
    $Bigrock_vps_compare=unserialize(Config::get('Constant.BIGROCK_VPS_COMPARE'));
    $Godaddy_vps_compare=unserialize(Config::get('Constant.GODADDY_VPS_COMPARE'));
    $Hostgator_vps_compare=unserialize(Config::get('Constant.HOSTGATOR_VPS_COMPARE'));
    $Milesweb_vps_compare=unserialize(Config::get('Constant.MILESWEB_VPS_COMPARE'));
    $Hostinger_vps_compare=unserialize(Config::get('Constant.HOSTINGER_VPS_COMPARE'));
    $Ideastack_vps_compare=unserialize(Config::get('Constant.IDEASTACK_VPS_COMPARE'));
    $Go4hosting_vps_compare=unserialize(Config::get('Constant.GO4HOSTING_VPS_COMPARE'));
    $B4uindia_vps_compare=unserialize(Config::get('Constant.B4UINDIA_VPS_COMPARE'));
    $right_icon='<i class="fa fa-check-circle"></i>';
    $wrong_icon='<span class="sprite-image cancel-ic"></span>';
@endphp

@if (
        ( isset($Bigrock_vps_compare) && !empty($Bigrock_vps_compare) ) &&
        ( isset($Godaddy_vps_compare) && !empty($Godaddy_vps_compare) ) &&
        ( isset($Hostgator_vps_compare) && !empty($Hostgator_vps_compare) ) &&
        ( isset($Milesweb_vps_compare) && !empty($Milesweb_vps_compare) ) &&
        ( isset($Hostinger_vps_compare) && !empty($Hostinger_vps_compare) ) &&
        ( isset($Ideastack_vps_compare) && !empty($Ideastack_vps_compare) ) &&
        ( isset($Go4hosting_vps_compare) && !empty($Go4hosting_vps_compare) ) &&
        ( isset($B4uindia_vps_compare) && !empty($B4uindia_vps_compare) )
    )
    
<div class="vps-plan-main compare-high">
    <div class="container">
        <div class="plan-div">
            @if(Request::segment(2)=='windows-vps-hosting')
            <h2 class="vps-plan-title aos-init" data-aos="fade-up">Don’t believe us yet. Let’s see where our Windows VPS hosting plans stand among competition.</h2><span class="plan-second-title aos-init" data-aos="fade-up">Better Pricing • Fast SSD Storage • Hack-free Protection • Real 24/7 Technical Support</span>
            @elseif(Request::segment(2)=='linux-vps-hosting')
            <h2 class="vps-plan-title aos-init" data-aos="fade-up">Don’t believe us yet. Let’s see where our Linux VPS hosting plans stand among competition.</h2><span class="plan-second-title aos-init" data-aos="fade-up">Better Pricing • Fast SSD Storage • Hack-free Protection • Real 24/7 Technical Support</span>
            @else
            <h4 class="vps-plan-title aos-init" data-aos="fade-up">Don’t believe us yet. Let’s see where our VPS hosting plans stand among competition.</h4><span class="plan-second-title aos-init" data-aos="fade-up">Better Pricing • Fast SSD Storage • Hack-free Protection • Real 24/7 Technical Support</span>
            @endif
            
            <div class="row row-posi">
                <div class="white-overlay d-md-none d-block"><a href="javascript:void(0)" data-role="scroll-to-next" class="overlay_link"><i class="la la-angle-double-right"></i></a></div>
                <div class="table-relative aos-init" data-aos="fade-left" data-aos-easing="ease-out-back" data-aos-delay="600">
                    <table class="table-plan-vps">
                        <tr>
                            <th class="title bg-none"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/logo.png" class="hostitsmart-logo" alt="{{ Config::get('Constant.SITE_NAME') }}"></th> 
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/bigrock_logo.png" alt="bigrock"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/godaddy.png" alt="godaddy"></th> 
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/hoster-gator.png" alt="hoster-gator"></th> 
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/milesweb.png" alt="milesweb"></th> 
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/hostinger.png" alt="hostinger"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/ideastack.png" alt="ideastack"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/go-hosting.png" alt="go-hosting"></th>
                            <th class="title"><img src="{{ url('/') }}/assets/images/vps_hosting/webji.png" alt="b4uindia"></th>
                        </tr>
                        <tr>
                            <td class="boldfonts">Plan</td>
                            <td class="bg_blue">STD LIN</td>
                            <td>{{$Bigrock_vps_compare['Plan']}}</td>
                            <td>{{$Godaddy_vps_compare['Plan']}}</td>
                            <td>{{$Hostgator_vps_compare['Plan']}}</td>
                            <td>{{$Milesweb_vps_compare['Plan']}}</td>
                            <td>{{$Hostinger_vps_compare['Plan']}}</td>
                            <td>{{$Ideastack_vps_compare['Plan']}}</td>
                            <td>{{$Go4hosting_vps_compare['Plan']}}</td>
                            <td>{{$B4uindia_vps_compare['Plan']}}</td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Price</td>
                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                            <td class="bg_blue">
                                <span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{!! Config::get('Constant.VPS_HOSTING_STARTER_PRICE_36_INR') !!}<span class="per-month">/mo</span></span></span>
                            </td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Bigrock_vps_compare['Price']['INR']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Godaddy_vps_compare['Price']['INR']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Hostgator_vps_compare['Price']['INR']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Milesweb_vps_compare['Price']['INR']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Hostinger_vps_compare['Price']['INR']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Ideastack_vps_compare['Price']['INR']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Go4hosting_vps_compare['Price']['INR']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$B4uindia_vps_compare['Price']['INR']}}</span><span class="per-month">/mo</span></span></td>
                            @php } 
                            else { @endphp 
                            <td class="bg_blue"><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{!! Config::get('Constant.VPS_HOSTING_STARTER_PRICE_12_USD') !!}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Bigrock_vps_compare['Price']['USD']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Godaddy_vps_compare['Price']['USD']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Hostgator_vps_compare['Price']['USD']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Milesweb_vps_compare['Price']['USD']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Hostinger_vps_compare['Price']['USD']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Ideastack_vps_compare['Price']['USD']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$Go4hosting_vps_compare['Price']['USD']}}</span><span class="per-month">/mo</span></span></td>
                            <td><span class="whole-span"><span class="ruppess">{!! Config::get('Constant.sys_currency_symbol') !!}</span> <span class="big-price">{{$B4uindia_vps_compare['Price']['USD']}}</span><span class="per-month">/mo</span></span></td>
                            @php } @endphp
                        </tr>
                        <tr>
                            <td class="boldfonts">HardDisk</td>
                            <td class="bg_blue">20 GB</td>
                            <td>{{$Bigrock_vps_compare['HardDisk']}}</td>
                            <td>{{$Godaddy_vps_compare['HardDisk']}}</td>
                            <td>{{$Hostgator_vps_compare['HardDisk']}}</td>
                            <td>{{$Milesweb_vps_compare['HardDisk']}}</td>
                            <td>{{$Hostinger_vps_compare['HardDisk']}}</td>
                            <td>{{$Ideastack_vps_compare['HardDisk']}}</td>
                            <td>{{$Go4hosting_vps_compare['HardDisk']}}</td>
                            <td>{{$B4uindia_vps_compare['HardDisk']}}</td>

                        </tr>
                        <tr>
                            <td class="boldfonts">Bandwidth</td>
                            <td class="bg_blue">2 TB Transfer</td>
                            <td>{{$Bigrock_vps_compare['Bandwidth']}}</td>
                            <td>{{$Godaddy_vps_compare['Bandwidth']}}</td>
                            <td>{{$Hostgator_vps_compare['Bandwidth']}}</td>
                            <td>{{$Milesweb_vps_compare['Bandwidth']}}</td>
                            <td>{{$Hostinger_vps_compare['Bandwidth']}}</td>
                            <td>{{$Ideastack_vps_compare['Bandwidth']}}</td>
                            <td>{{$Go4hosting_vps_compare['Bandwidth']}}</td>
                            <td>{{$B4uindia_vps_compare['Bandwidth']}}</td>

                        </tr>
                        <tr>
                            <td class="boldfonts">Pre-installed panel</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td>{!! $Bigrock_vps_compare['Pre-installed panel']=='y' ? $right_icon : $wrong_icon !!}</td>
                            <td>{!! $Godaddy_vps_compare['Pre-installed panel']=='y' ? $right_icon : $wrong_icon!!}</td>
                            <td>{!! $Hostgator_vps_compare['Pre-installed panel']=='y' ? $right_icon : $wrong_icon!!}</td>
                            <td>{!! $Milesweb_vps_compare['Pre-installed panel']=='y' ? $right_icon : $wrong_icon!!}</td>
                            <td>{!! $Hostinger_vps_compare['Pre-installed panel']=='y' ? $right_icon : $wrong_icon!!}</td>
                            <td>{!! $Ideastack_vps_compare['Pre-installed panel']=='y' ? $right_icon : $wrong_icon!!}</td>
                            <td>{!! $Go4hosting_vps_compare['Pre-installed panel']=='y' ? $right_icon : $wrong_icon!!}</td>
                            <td>{!! $B4uindia_vps_compare['Pre-installed panel']=='y' ? $right_icon : $wrong_icon!!}</td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Processor Core</td>
                            <td class="bg_blue">1</td>
                            <td>{{$Bigrock_vps_compare['Processor Core']}}</td>
                            <td>{{$Godaddy_vps_compare['Processor Core']}}</td>
                            <td>{{$Hostgator_vps_compare['Processor Core']}}</td>
                            <td>{{$Milesweb_vps_compare['Processor Core']}}</td>
                            <td>{{$Hostinger_vps_compare['Processor Core']}}</td>
                            <td>{{$Ideastack_vps_compare['Processor Core']}}</td>
                            <td>{{$Go4hosting_vps_compare['Processor Core']}}</td>
                            <td>{{$B4uindia_vps_compare['Processor Core']}}</td>
                        </tr>
                        <tr>
                            <td class="boldfonts">RAM</td>
                            <td class="bg_blue">1</td>
                            <td>{{$Bigrock_vps_compare['RAM']}}</td>
                            <td>{{$Godaddy_vps_compare['RAM']}}</td>
                            <td>{{$Hostgator_vps_compare['RAM']}}</td>
                            <td>{{$Milesweb_vps_compare['RAM']}}</td>
                            <td>{{$Hostinger_vps_compare['RAM']}}</td>
                            <td>{{$Ideastack_vps_compare['RAM']}}</td>
                            <td>{{$Go4hosting_vps_compare['RAM']}}</td>
                            <td>{{$B4uindia_vps_compare['RAM']}}</td>
                        </tr>
                        <tr>
                            <td class="boldfonts">Free SSL</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td>{!! $Bigrock_vps_compare['Free SSL']=='y' ? $right_icon : $wrong_icon !!}</td>
                            <td>{!! $Godaddy_vps_compare['Free SSL']=='y' ? $right_icon :
                                ($Godaddy_vps_compare['Free SSL']=='n') ? $wrong_icon : $Godaddy_vps_compare['Free SSL']
                                !!}
                            <td>{!! $Hostgator_vps_compare['Free SSL']=='y' ? $right_icon : $wrong_icon !!}</td>
                            <td>{!! $Milesweb_vps_compare['Free SSL']=='y' ? $right_icon : $wrong_icon !!}</td>
                            <td>{!! $Hostinger_vps_compare['Free SSL']=='y' ? $right_icon : $wrong_icon !!}</td>
                            <td>{!! $Ideastack_vps_compare['Free SSL']=='y' ? $right_icon : $wrong_icon !!}</td>
                            <td>{!! $Go4hosting_vps_compare['Free SSL']=='y' ? $right_icon : $wrong_icon !!}</td>
                            <td>{!! $B4uindia_vps_compare['Free SSL']=='y' ? $right_icon : $wrong_icon !!}</td>
                        </tr>
                        {{-- <tr>
                            <td class="boldfonts">Server management console</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                        </tr> --}}
                        <!-- <tr>
                            <td class="boldfonts">KVM</td>
                            <td class="bg_blue"><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><span class="sprite-image cancel-ic"></span></td>
                        </tr> -->
                        <tr>
                            <td class="boldfonts">Region</td>
                            <td class="bg_blue">India</td>
                            <td>{{$Bigrock_vps_compare['Region']}}</td>
                            <td>{{$Godaddy_vps_compare['Region']}}</td>
                            <td>{{$Hostgator_vps_compare['Region']}}</td>
                            <td>{{$Milesweb_vps_compare['Region']}}</td>
                            <td>{{$Hostinger_vps_compare['Region']}}</td>
                            <td>{{$Ideastack_vps_compare['Region']}}</td>
                            <td>{{$Go4hosting_vps_compare['Region']}}</td>
                            <td>{{$B4uindia_vps_compare['Region']}}</td>
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
                            <td><a href="{{url('/')}}/vps-hosting-bigrock-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/vps-hosting-godaddy-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/vps-hosting-hostgator-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/vps-hosting-milesweb-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/vps-hosting-hostinger-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/vps-hosting-ideastack-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/vps-hosting-go4hosting-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                            <td><a href="{{url('/')}}/vps-hosting-b4uindia-alternative" >Compare <span class="d-none d-xl-block">Now</span></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endif