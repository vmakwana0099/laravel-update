    <?php 
    $requiredDomainFor = ['hosting','email','ssl'];
    $requiredHostFor = ['vps','dedicatedserver']; ?>
    <div class="card-right order-section">
                <h2 class="sumary-title">Order Summary</h2>
                @foreach($cartData as $proKey => $item)
                    @if(isset($item['producttype']) && $item['producttype'] == 'domain')
                    <?php $priceStr = ""; 
                     foreach($item['pricing'] as $pr){ if($pr->duration == $item['regperiod']) { 
                        if($item['domaintype'] == 'register')
                            { $priceStr = $pr->register;  }
                        else if($item['domaintype'] == 'transfer')
                            { $priceStr = $pr->transfer;  }
                        else if($item['domaintype'] == 'renewal')
                            { $priceStr = $pr->renwal;  }
                        } 
                    }
                     ?>
                    <div class="cart-right" data-aos="fade-left" data-aos-easing="ease-out-back">
                    <div class="cart-box-1 row">
                        <div class="order-summary-text col-sm-8 col-8">
                            @if($item['domaintype'] == 'register')
                            <div class="ost_title"><a href="{{url('cart/newconfig?id=')}}{{$proKey}}">Domain Registration</a></div>
                            @elseif($item['domaintype'] == 'transfer')
                            <div class="ost_title"><a href="{{url('cart/newconfig?id=')}}{{$proKey}}">Domain Transfer</a></div>
                            @elseif($item['domaintype'] == 'renewal')
                            <div class="ost_title"><a href="{{url('cart/newconfig?id=')}}{{$proKey}}">Domain Renewal</a></div>
                            @endif
                            @if(!empty($item['domain']))<div class="ost_product">{{$item['domain']}}</div>@endif
                
                            
                            @if(isset($item['pricing']))
                            <div class="select_period select_combo">
                                <form id="cart_form_{{$proKey}}" action="#" method="post">
                                    <input type="hidden" id="ele_key" name="ele_key" value="{{$proKey}}">
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <select id="sel_domainregister_{{$proKey}}"  name="sel_domainregister_{{$proKey}}" class="form-control selectpicker" onchange="updateDomainConfigurationNew({{$proKey}});">
                                                <?php $renewalPrice = ""; $currPlanPrice = ""; ?>
                                                @foreach($item['pricing'] as $price)
                                                    <?php 
                                                    if(!empty($price->register) && $price->duration == $item['regperiod']){
                                                        $currPlanPrice = ($price->register / $price->duration);
                                                    }
                                                    if(!empty($price->renwal) && $price->duration == $item['regperiod']){
                                                        $renewalPrice = ($price->renwal / $price->duration);
                                                    }
                                                    if(empty($renewalPrice)){
                                                        $renewalPrice = $currPlanPrice;
                                                    }
                                                    ?>
                                                    @if($price->register > 0)
                                                        <option value="{{$price->duration}}" @if($price->duration == $item['regperiod']) selected @endif >{{$price->duration}} @if($price->duration > 1) years @else year @endif</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                </form>        
                            </div>
                            @endif
                            @if(isset($renewalPrice) && !empty($renewalPrice))
                            <div class="renew_price">Renews at <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$renewalPrice}}/yr</div>
                            @endif
                        </div>
                        <div class="order-summary-price col-sm-4 col-4">
                            <div class="product_price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$priceStr}}</div>
                            <?php 
                            	if(isset($item['pricing']) && $item['regperiod'] > 0){
                            	    //echo '<pre>';print_r($item['pricing'][0]->register);
                            	    $oneYear = isset($item['pricing'][0]->register)?$item['pricing'][0]->register:0;
	                                $twoYears = isset($item['pricing'][$item['regperiod']]->register)?($item['pricing'][$item['regperiod'] -1]->register - $oneYear):0;
                            	}
                            ?>
                            @if(isset($oneYear) && !empty($oneYear))
                                <div class="year_price">1st year <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$oneYear}}</div>
                                @endif
                                @if(isset($twoYears) && !empty($twoYears))
                                <div class="year_price">2+ years <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$twoYears}}</div>
                                @endif
                            <div class="delete_btn">
                                <a class="delete-icon" title="Delete" href="javascript:void(0);" onclick="removeCartItem('{{$proKey}}');">
                                    <i class="delete-i  sprite-image"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @foreach($item['addonproducts'] as $addonkey => $addon)
                               @if(isset($addon['pid']))
                               @else
                                <div class="cart-box-1 row">
                                <div class="reminder_div col-sm-9 col-9">
                                {!!$addon['desc']!!}
                                </div>
                                <div class="action_btns col-sm-3 col-3">
                               
                               @if(!isset($addon['added'])) 
                                <a class="add_btn pull-right" href="javascript:void(0)" onclick="addAddonsDomainNew('{{$addon['type']}}','{{$addon['did']}}','{{$addon['type']}}','{{$addon['type']}}','{{$addon['type']}}', this,'{{$proKey}}','{{$addonkey}}','add');" id="{{$addon['type']}}" name="{{$addon['type']}}" title="Add">Add</a>
                               @elseif(isset($addon['added']))
                               <a class="cancel_btn" href="javascript:void(0)" onclick="addAddonsDomainNew('{{$addon['type']}}','{{$addon['did']}}','{{$addon['type']}}','{{$addon['type']}}','{{$addon['type']}}', this,'{{$proKey}}','{{$addonkey}}','remove');" id="{{$addon['type']}}" name="{{$addon['type']}}" title="Cancel">
                                <i class="cancel-icon sprite-image"></i>
                                </a>
                               @endif
                                </div>
                                </div>
                               @endif
                             @endforeach    
                </div>
                @elseif(isset($item['producttype']) && $item['producttype'] != 'domain')
                <?php
                    $priceStr = "";
                    foreach($item['pricing'] as $pr){ if($pr->durationame == $item['billingcycle']) { $priceStr = $pr->price; } }
                    $item['pricing'][$item['regperiod']]->price;
                    if (!empty($item['configfields'])) {
                        foreach ($item['configfields'] as $field) {
                            if (isset($field['selectedOption'])) {
                                if (!empty($field['options'])) {
                                    foreach ($field['options'] as $opt) {
                                        if ($opt['id'] == $field['selectedOption']) {
                                            $priceStr += $opt['pricing']['price'][$item['regperiod']];
                                        }
                                    }
                                }
                            }
                        }
                    }
                ?>
             
                <div class="cart-right" data-aos="fade-left" data-aos-easing="ease-out-back">
                    <div class="cart-box-1 row">
                        <div class="order-summary-text col-sm-8 col-8">
                            <div class="ost_title"><a href="{{url('cart/newconfig?id=')}}{{$proKey}}">{{$item['groupname']}} - {{$item['planname']}}</a></div>
                            <?php if($item['producttype'] == 'vps' || $item['producttype'] == 'dedicatedserver'){
                               foreach($item['customfields'] as $_customfield){
                                    if($_customfield['id'] == 'hostname'){
                                        $item['domain'] = $_customfield['selectedOption'];
                                    }
                               }
                               //Skip host name for Quick Order process flow.
                               $skipHostQuickOrderIds = [210,211,212,214,215,216];
                               if(in_array($item['pid'],$skipHostQuickOrderIds)){ $item['domain'] = 'Quick Order'; }
                            }
                            ?>
                            @if(isset($item['domain']) && !empty($item['domain']))<div class="ost_product-name">{{$item['domain']}}</div> @endif
                            @if(in_array($item['producttype'],$requiredDomainFor) && empty($item['domain']))
                                <div class="ost_product-name red">Please provide Domain.&nbsp;<a class="carterr" href="{{url('cart/newconfig?id=')}}{{$proKey}}">Click Here</a></div>    
                            @endif
                            @if(in_array($item['producttype'],$requiredHostFor) && empty($item['domain']))
                                <div class="ost_product-name red">Please provide Hostname.&nbsp;<a class="carterr" href="{{url('cart/newconfig?id=')}}{{$proKey}}">Click Here</a></div>    
                            @endif
                            @if(isset($item['pricing']))
                            <div class="select_period select_combo">
                                <form id="cart_form_{{$proKey}}" action="#" method="post">
                                    <input type="hidden" id="ele_key" name="ele_key" value="{{$proKey}}">
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <select id="sel_hostingregister_{{$proKey}}"  name="sel_hostingregister_{{$proKey}}" class="form-control selectpicker" 
                                    @if($item['producttype'] == 'hosting')
                                        onchange="updateHostingItemNew({{$proKey}},this.value);
                                    @elseif($item['producttype'] == 'vps' || $item['producttype'] == 'dedicatedserver')
                                        onchange="updateServerItemNew({{$proKey}},this.value);    
                                    @else 
                                        onchange="updateHostingItemNew({{$proKey}},this.value);
                                    @endif   
                                    ">         
                                     <?php $currPlanPrice = ""; ?>
                                     @foreach($item['pricing'] as $optKey => $price)
                                                <?php 
                                                    
                                                    if(!empty($price->price) && $price->durationame == $item['billingcycle']){
                                                        $currPlanPrice = ($price->price / $price->duration);
                                                    }
                                                ?>
                                                    @if($price->price > 0)
                                                        <option value="{{$price->durationame}}" @if($price->durationame == $item['billingcycle']) selected @endif >{{$price->duration}} @if($price->duration > 1) months @else month @endif</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                </form>        
                            </div>
                            @endif
                           @if(isset($currPlanPrice) && !empty($currPlanPrice)) <div class="renew_price">Renews at <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$currPlanPrice}}/mo</div> @endif
                        </div>
                        <div class="order-summary-price col-sm-4 col-4">
                            <div class="product_price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$priceStr}}</div>
                            <div class="delete_btn">
                                <a class="delete-icon" title="Delete" href="javascript:void(0);" onclick="removeCartItem('{{$proKey}}');">
                                    <i class="delete-i  sprite-image"></i>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    
    <?php 
    $serverconfigHtmlStr = "";
    if($item['producttype'] == 'vps' || $item['producttype'] == 'dedicatedserver'){
        if (!empty($item['configfields'])) {
            foreach ($item['configfields'] as $field) {
                
                if (isset($field['selectedOption'])) {
                    if (!empty($field['options'])) {
                        foreach ($field['options'] as $opt) {
                            if ($opt['id'] == $field['selectedOption']) {
                                //$finalPrice += $opt['pricing']['price'][$item['regperiod']];
                                if($opt['pricing']['price'][$item['regperiod']] > 0)
                                    { 
                                        $serverconfigHtmlStr .= '<div class="cart-box-1 row">
                                            <div class="reminder_div col-sm-9 col-9">
                                                <span class="reminder_title">'.$field['name'].'</span> '.$opt['name'].' @ <span class="rupee">'.Config::get('Constant.sys_currency_symbol').'</span>'.$opt['pricing']['price'][$item['regperiod']].' 
                                            </div>
                                        </div>';
                                    }
                                else
                                    { 
                                        $serverconfigHtmlStr .= '<div class="cart-box-1 row">
                                            <div class="reminder_div col-sm-9 col-9">
                                                <span class="reminder_title">'.$field['name'].'</span> '.$opt['name'].' @ FREE 
                                            </div>
                                        </div>';
                                    }
                            }
                        }
                    }
                }
            } 
            echo $serverconfigHtmlStr;
        }
    }
            ?>

                </div>
                    @endif
                @endforeach                    
                <div class="empty_cart_section">
                    <div class="row">
                        <div class="disclaimers_link col-sm-6 col-6">
                            <a title="View offer disclaimers" href="javascript:void(0)" data-toggle="modal" data-target="#disclaimer-popup" title="View offer disclaimers">View offer disclaimers</a>
                        </div>
                        <div class="empty_cart_btn col-sm-6 col-6">
                            <a onclick="emptycart();" title="Empty Cart" class="delete_btn"><i class="delete-i sprite-image"></i> Empty Cart</a>
                        </div>
                    </div>
                </div>
                <div class="amount_section">
                    <div class="sub_total_section row">
                        <div class="sub_total_title col-sm-7 col-7">
                            Subtotal
                        </div>
                        <div class="sub_total_price col-sm-5 col-5" id="subtotalSpan">
                             <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}0</span>
                        </div>
                    </div>
                    <div class="sub_total_section taxes_included row">
                        <div class="sub_total_title col-sm-7 col-7">
							<!-- <a href="#" title="Taxes & Fees">Taxes & Fees</a> -->
							<div class="tax-cart d-flex">
								<span class="taxes">
								Taxes &amp; Fees
									<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
									<i class="notify sprite-image" title="18% GST will be applicable."></i>
									<ul class="dropdown-menu tooltip-link-show">
										<li>18% GST will be applicable.</li>
									</ul>
								</a>
								</span>
							</div>
						</div>
                        <div class="sub_total_price col-sm-5 col-5" id="taxesSpan">
                             <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>0
                        </div>
                    </div>
                    @if(isset($cartData['prmocode']) && !empty($cartData['prmocode']))
                                @if($cartData['prmomessage'] != 'The promotion code entered does not exist')
                                    
                                <div class="promocode_section row">
						<div class="col-sm-12">
							<div class="apply_promocode" id="promobefore" style="display:none;">
								<a class="title" href="{{url('/deals')}}" title="Top Deals">Click here to check top deals</a>
								<div class="promocode_input">
									 <input type="text" id="txtpromo" name="txtpromo" value="{{$cartData['prmocode']}}" placeholder="Have a promocode?">
                                            <button class="btn" title="Apply" onclick="applyPromocode();">Apply</button>
								</div>
								<div class="promocode_note">*Apply one coupon at a time</div>
							</div>
							<div class="after-promocode d-flex" id="promoafter">
								<div class="promocde-applied-left">
									<a onclick="removePromocode();" class="delete-icon" title="remove"><i class="remove-icon"></i></a>
                                            <span class="promocode">{{$cartData['prmocode']}}</span>
                                            <span class="promo-text">{{$cartData['prmomessage']}}</span>
								</div>
								@if(!empty($cartData['prmodiscount']))<div id="discountSpan" class="subtotal-price ml-auto"> - <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$cartData['prmodiscount']}}</div>@endif
							
							</div>
						</div>
						
					</div>    
                                @else 
                                
                                <div class="promocode_section row">
						<div class="col-sm-12">
							<div class="apply_promocode" id="promobefore">
								<a class="title" href="{{url('/deals')}}" title="Top Deals">Click here to check top deals</a>
								<div class="promocode_input">
									<input type="text" id="txtpromo" name="txtpromo" placeholder="Have a promocode?">
                                            <button class="btn" title="Apply" onclick="applyPromocode();">Apply</button>
								</div>
								<div class="promocode_note">*Apply one coupon at a time</div>
							</div>
							<?php 
                                    $cartData['prmomessage'] = str_replace("promotion code","promocode",$cartData['prmomessage']); 
                                    if($cartData['prmomessage'] == 'The promotion code entered does not exist'){
                                        $cartData['prmomessage'] = 'Invalid promocode.';
                                    }?>
							<div class="after-promocode d-flex" id="promoafter">
							<span class="promo-text red">{{$cartData['prmomessage']}}</span>
							</div>
						</div>
						
					</div>    
                                @endif
                                @else
                                
                                <div class="promocode_section row">
						<div class="col-sm-12">
							<div class="apply_promocode" id="promobefore">
								<a class="title" href="{{url('/deals')}}" title="Click here to check top deals">Click here to check top deals</a>
								<div class="promocode_input">
									<input type="text" id="txtpromo" name="txtpromo" placeholder="Have a promocode?">
                                            <button class="btn" title="Apply" onclick="applyPromocode();">Apply</button>
								</div>
								<div class="promocode_note">*Apply one coupon at a time</div>
							</div>
							<div class="after-promocode d-flex" id="promoafter" style="display:none;"></div>
						</div>
					</div>
					      
					@endif
					<div class="total_amount_section row">
                                    <div class="total_title col-sm-6 col-6">
                                        Total
                                    </div>
                                    <div class="total_price col-sm-6 col-6" id="cartTotalspan">
                                        <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>0
                                    </div>
                                </div>
                </div>
            </div>


          

<div class="modal fade deal-popup" id="disclaimer-popup" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-popup" data-dismiss="modal"></button>
                <h2 class="modal-title" title="Disclaimers">Disclaimers</h2>
            </div>
            <div class="modal-body">
                <div class="deal-body">
                    <ul>
                            <li class="text-left">Information contained in this website is for general information purpose only, The information is provided by HostITSmart, a property of Hosting World Pvt Ltd. While we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose.Any conviction you place on such information is therefore strictly at your own risk.</li>
                            <li class="text-left">In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website. Through this website you are able to link to other websites which are not under the control of Hosting World Pvt Ltd. We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them. Every effort is made to keep the website up and running smoothly. However, Hosting World Pvt Ltd takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>              
<script type="text/javascript">
     $(function(){
        $("#txtpromo").keypress(function(e) {
            if(e.which == 13) {
                applyPromocode();
            }
        });
    });
</script>