<div class="free-domain-div" data-aos="fade-right" data-aos-easing="ease-out-back">
    <form id="cart_form_{{$key}}" action="#" method="post">
        <input type="hidden" id="ele_key" name="ele_key" value="{{$key}}">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <div class="padding-div">
            <div class="free-domain-heading d-flex">
                @if(isset($cartItem['freedomainproid']))
                @if ($cartItem['domaintype'] == 'register')
                <h3 class="free-domain-head"><span class="green">Free</span>Domain Registration</h3>
                @elseif ($cartItem['domaintype'] == 'transfer')
                <h3 class="free-domain-head"><span class="green">Free</span>Domain Transfer</h3>
                @elseif ($cartItem['domaintype'] == 'renewal')
                <h3 class="free-domain-head"><span class="green">Free</span>Domain Renewal</h3>
                @endif
                @else

                @if ($cartItem['domaintype'] == 'register')
                <h3 class="free-domain-head"><span class="green">Domain</span> Registration</h3>
                @elseif ($cartItem['domaintype'] == 'transfer')
                <h3 class="free-domain-head"><span class="green">Domain</span> Transfer</h3>
                @elseif ($cartItem['domaintype'] == 'renewal')
                <h3 class="free-domain-head"><span class="green">Domain</span> Renewal</h3>
                @endif
                @endif

                <a onclick="removeCartItem('{{$key}}');" class="delete-icon ml-auto" title="Delete"><i class="delete-i sprite-image"></i></a>
            </div>
            @php
            $varDomain = explode(".",$cartItem['domain']); $d = $varDomain[0]; unset($varDomain[0]); $t = ".".implode(".",$varDomain);
            @endphp
            <span class="free-domain-text">{{$d}}<span class="green">{{$t}}</span></span>
        </div>
        <div class="domain-registratiopn-details">  
            <div class="row">
                <div class="col-sm-3 col-6 d-flex justify-content-center">
                    <div class="free-domain-1"> 
                        <div class="free-domain-head">
                            Domain
                        </div>
                        <i class="domain-icon"></i>
                    </div>
                </div>
                <div class="col-sm-3 col-6 d-flex justify-content-center">
                    <div class="free-domain-1"> 
                        <div class="free-domain-head">
                            Period
                        </div>
                        <div class="dropdown dropdown-custom">
                            <div class="select_box">
                               
                                <select class="selectpicker" onchange="updateDomainConfiguration('{{$key}}');" id="sel_domainregister_{{$key}}"  name="sel_domainregister_{{$key}}">
                                    @if ($cartItem['domaintype'] == 'transfer')
                                        <option selected value="1">1 yr</option>
                                    @else
                                        @foreach($cartItem['pricing'] as $price)
                                            @if(isset($price->duration) && isset($price->register))<option 
                                                @if($price->duration == $cartItem['regperiod']) selected @endif
                                                value="{{$price->duration}}">{{$price->duration}} yr</option>@endif
                                        @endforeach
                                    @endif   
                                </select>
                               

                            </div>
                        </div>
                        @if(isset($cartItem['pricing'][0]->renwal))
                        <span class="renew-price">Renews at <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span> {{$cartItem['pricing'][0]->renwal}}/yr</span>
                        @endif
                    </div>
                </div>
                @if(isset($cartItem['pricing'][0]->renwal))

                @php 
                //echo '<pre>';print_r($cartItem['pricing']);exit;
                $yousave = $cartItem['pricing'][$cartItem['regperiod'] - 1]->wrongprice - $cartItem['pricing'][$cartItem['regperiod'] - 1 ]->register;
                @endphp

                @php
                if(!empty($cartItem['pricing'][$cartItem['regperiod'] - 1]->wrongprice)){
                $offPer = ($yousave * 100)/$cartItem['pricing'][$cartItem['regperiod'] - 1]->register;
                $offPer = round($offPer,2);
                }
                @endphp
                @php
                if(isset($cartItem['freedomainproid'])){
                $offPer = 0;
                }
                @endphp
                <div class="col-sm-3 col-6 d-flex justify-content-center">
                    <div class="free-domain-1"> 
                        @if($offPer > 0)<div class="free-percentage" data-aos="fade-up" data-aos-delay="200" data-aos-easing="ease-out-back">{{$offPer}}% OFF</div>@endif
                        <div class="free-domain-head">
                            Price
                        </div>
                        <span class="actual-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><b>
                                @if(isset($cartItem['freedomainproid']))
                                0
                                @else
                                {{$cartItem['pricing'][$cartItem['regperiod'] - 1]->register}}
                                @endif  
                            </b>/yr</span>
                        <span class="overline-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline">{{$cartItem['pricing'][$cartItem['regperiod'] - 1]->wrongprice}}/yr</span></span>
                    </div>
                </div>
                @endif
                @if(isset($cartItem['pricing'][$cartItem['regperiod'] - 1 ]->register))
                <div class="col-sm-3 col-6 d-flex justify-content-center">
                    <div class="free-domain-1"> 
                        <div class="free-domain-head">
                            Subtotal
                        </div>
                        <span class="actual-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span><b>
                                @if(isset($cartItem['freedomainproid']))
                                0
                                @else
                                {{$cartItem['pricing'][$cartItem['regperiod'] - 1 ]->register}}
                                @endif  

                            </b>/yr</span>
                        @if(!empty($yousave)) <span class="green-price">You save <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>  {{$yousave}}</span>@endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="hide-info">
            @if(isset($cartItem['addonproducts']))
            @foreach($cartItem['addonproducts'] as $addonkey => $item)
            @if(isset($item['pid']))

            <div class="protect-box @if(isset($item['added'])) active  @endif">
                <div class="protect-icon">
                    <i class="pro-i sprite-image"></i>
                </div>
                <div class="protect-text">
                    <label class="custom-radio">
                        <input onclick="addAddonsServer('{{$item['type']}}','{{$item['pid']}}','{{$item['duration']}}','{{$item['groupname']}}','{{$item['productname']}}', this,'{{$key}}','{{$addonkey}}');" type="checkbox" @if(isset($item['added'])) checked  @endif id="addonproducts_{{$key}}_{{$addonkey}}" name="addonproducts_{{$key}}_{{$addonkey}}"/>
                               <span class="checkmark"></span>
                        {!! $item['desc'] !!}
                    </label>
                    <?php /*<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="notify sprite-image" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i>
                        <ul class="dropdown-menu tooltip-link-show">
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                        </ul>
                    </a>*/?>
                </div>
            </div>

            @else

            <div class="protect-box @if(isset($item['added'])) active  @endif">
                <div class="protect-icon">
                    <i class="pro-i sprite-image"></i>
                </div>
                <div class="protect-text">
                    <label class="custom-radio">
                        <input onclick="addAddonsDomain('{{$item['type']}}','{{$item['did']}}','{{$item['type']}}','{{$item['type']}}','{{$item['type']}}', this,'{{$key}}','{{$addonkey}}');" type="checkbox" @if(isset($item['added'])) checked  @endif id="addonproducts_{{$key}}_{{$addonkey}}" name="addonproducts_{{$key}}_{{$addonkey}}"/>
                               <span class="checkmark"></span>
                        {!! $item['desc'] !!}
                    </label>
                    <?php /*<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="notify sprite-image" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i>
                        <ul class="dropdown-menu tooltip-link-show">
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                        </ul>
                    </a>*/?>
                </div>
            </div>

            @endif
            @endforeach
            @endif
        </div>
    </form>
</div>        