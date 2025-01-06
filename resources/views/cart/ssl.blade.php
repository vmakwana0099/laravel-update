<form id="cart_form_{{$key}}" action="#" method="post">
        <input type="hidden" id="ele_key" name="ele_key" value="{{$key}}">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
<div class="cart-check-left" data-aos="fade-right" data-aos-easing="ease-out-back">
                <div class="cart-1">
                    <div class="cart-heading">
                        @if(isset($cartItem['groupname']))<h1 class="cart-head">{{$cartItem['groupname']}}</h1>@endif
                        <a onclick="removeCartItem('{{$key}}');" class="delete-icon" title="Delete"><i class="delete-i sprite-image"></i></a>
                    </div>
                    <span class="premium-text">{{$cartItem['planname']}}
                        <?php /*<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" class="tooltip-link"><i class="notify sprite-image" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i>
                        <ul class="dropdown-menu tooltip-link-show">
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                        </ul>
                        </a> */?>
                    </span>
                              @php
                                $varDomain = explode(".",$cartItem['domain']);
                                $d = $varDomain[0]; 
                                unset($varDomain[0]); 
                                $t = ".".implode(".",$varDomain);

                                $proicon = '';
                                if($cartItem['groupname'] == 'Linux Hosting')
                                { $proicon = 'linux-i'; }
                                else if($cartItem['groupname'] == 'Windows Hosting')
                                { $proicon = 'windows-i'; }
                                else if($cartItem['groupname'] == 'Wordpress Hosting')
                                { $proicon = 'wordpress-i'; }
                                else if($cartItem['groupname'] == 'Java Hosting')
                                { $proicon = 'java-i'; }
                                else if($cartItem['groupname'] == 'eCommerce Hosting')
                                { $proicon = 'ecommerce-i'; }
                                else if($cartItem['groupname'] == 'Linux Reseller Hosting')
                                { $proicon = 'reseller-i'; }
                                else if($cartItem['groupname'] == 'Windows Reseller Hosting')
                                { $proicon = 'reseller-i'; }
                                else if($cartItem['groupname'] == 'VPS Hosting')
                                { $proicon = 'vps-i'; }
                                else if($cartItem['groupname'] == 'Dedicated Servers')
                                { $proicon = 'dedicated-i'; }
                                else if($cartItem['groupname'] == 'SSL')
                                { $proicon = 'ssl-i'; }
                              

                              @endphp
                     <!-- Not Needed Extra code-->
                     @if(isset($cartItem['domain'])) 
                    <div class="d-md-none d-none">
                        <div class="premium-div domain-for-mobile">
                              <i class="domain-icon @php echo $proicon; @endphp"></i>
                             
                              <span class="boomyshow">{{$d}}<p class="green">{{$t}}</p></span> 
                              
                        </div>
                    </div>
                    @endif
                  <div class="m-top">
                      <div class="row">
                        @if(isset($cartItem['domain']))
                         <div class="col-xl-2 col-md-4 col-sm-12 col-12">
                            <div class="for-flex">
                               <div class="premium-div">
                                  <i class="domain-icon @php echo $proicon; @endphp"></i>
                                  <span class="boomyshow">
                                     <span class="boomyshow">{{$d}}<p class="green">{{$t}}</p></span> 
                                  </span>
                               </div>
                            </div>
                         </div>
                         @endif
                         @if(count($cartItem['pricing']))
                            @foreach($cartItem['pricing'] as $key2 => $price)
                            @if($price->price > 0)
                             @php 
                                $yousave = $cartItem['pricing'][$cartItem['regperiod']]->wrongprice - ($cartItem['pricing'][$cartItem['regperiod']]->price);
                                if($cartItem['pricing'][$cartItem['regperiod']]->wrongprice > 0)
                                { 
                                $offPer = ($yousave * 100)/$cartItem['pricing'][$cartItem['regperiod']]->wrongprice;
                                $offPer = round($offPer,2);
                                }
                                
                             @endphp
                         <div class="col-xl-2 col-md-4 col-sm-6 col-4" id="sel_hosting_{{$key}}" >
                            <div class="for-flex flex-wrap  @if($price->durationame == $cartItem['billingcycle']) active @endif">
                              <label style="display:none;"><input onclick="updateServerItem('{{$key}}','{{$key2}}');" type="radio"  id="sel_hostingregister_{{$key}}_{{$key2}}" name="sel_hostingregister_{{$key}}" value="{{$price->durationame}}" @if($price->durationame == $cartItem['billingcycle']) checked @endif />{{$price->durationame}}</label>
                               <div class="cart-box-up">
                                @if(!empty($price->wrongprice))<span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span><div class="cart-price-overline">{{$price->wrongprice}}/mo</div>@endif
                                @if(!empty($offPer)) 
                                  <div class="price-save">Save <span class="save-per">{{$offPer}}%</span></div><span class="shape"></span>
                                @endif
                                
                               </div>
                               <div class="cart-box" onclick="$('#sel_hostingregister_{{$key}}_{{$key2}}').prop('checked',true);updateServerItem('{{$key}}','{{$key2}}');">
                                @if(!empty($price->duration))  
                                <div class="cart-box-months">
                                  <div class="domain-mn"> {{$price->duration}}</div>
                                  <div class="domain-months">@if($price->duration > 1)Months @else Month @endif</div>
                                </div>
                                @endif
                                @if(!empty($price->price))
                                <div class="cart-box-price">
                                  <div class="domain-price"><span class=""> {!! Config::get('Constant.sys_currency_symbol') !!}</span>{{round(($price->price / $price->duration),2)}}</div>
                                  <div class="domain-month">/mo</div>
                                </div>
                                @endif
                               </div>
                            </div>
                           </div>
                         @endif
                            @endforeach
                        @endif
                     </div>
                  </div>
                    <div class="subtotal-main">
                        <div class="cart-subtotal text-right">
                            <div class="cart-total-text">
                            Subtotal :
                                <span class="green"><span class="rupes">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$cartItem['pricing'][$cartItem['regperiod']]->price}}</span>
                            </div>
                            <div class="blue">
                             You save <span class="rupes">{!! Config::get('Constant.sys_currency_symbol') !!}</span> {{$yousave}}
                            </div>
                        </div>
                    </div>
                </div>
                 @if(isset($cartItem['addonproducts']))
                    @foreach($cartItem['addonproducts'] as $addonkey => $item)
                    <div class="protect-box @if(isset($item['added'])) active  @endif">
                      <div class="protect-icon">
                          <i class="pro-i sprite-image"></i>
                      </div>
                      <div class="protect-text">
                         <label class="custom-radio">
                         <input onclick="addAddonsServer('{{$item['type']}}','{{$item['pid']}}','{{$item['duration']}}','{{$item['groupname']}}','{{$item['productname']}}',this,'{{$key}}','{{$addonkey}}');" type="checkbox" @if(isset($item['added'])) checked  @endif id="addonproducts_{{$key}}_{{$addonkey}}" name="addonproducts_{{$key}}_{{$addonkey}}"/>
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
                    @endforeach
                @endif
                
                @if(isset($cartItem['allowfreedomain']['freedomain']) && !empty($cartItem['allowfreedomain']['freedomain']))
                <div class="congrats-main" id="freedomaindiv">
                  <h2 class="congrats">
                    <span class="">
                    Congratulations!
                    </span>
                  </h2>
                  <div class="c-2">
                    <h3 class="eligible-text">You're eligible for a free domain!</h3>
                    <div class="doamin_search_div">
                      <div class="form-group aos-init aos-animate" data-aos="fade-up" data-aos-easing="ease-out-back">
                        <input class="form-control" maxlength="60" onkeyup="return validateFreeDomainName(this);" name="freedomaintxt_{{$key}}" id="freedomaintxt_{{$key}}" placeholder="yourdomain.com" value="">
                        @if(isset($cartItem['allowfreedomain']['freedomaintlds']) && !empty($cartItem['allowfreedomain']['freedomaintlds']))
                        @php 
                        $tlds = explode(",",$cartItem['allowfreedomain']['freedomaintlds']);
                        @endphp
                        <div class="dropdown dropdown-bulk">
                          <select class="selectpicker" id="selFreeDomain_{{$key}}" name="selFreeDomain_{{$key}}">
                            @foreach($tlds as $tld)
                              <option value="{{$tld}}">{{$tld}}</option>
                            @endforeach
                          </select>
                        </div>
                        @endif
                        <button class="btn" title="Search" onclick="return searchFreeDomain('{{$key}}');">Search</button>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            </div>
</form>