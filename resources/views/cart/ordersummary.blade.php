    <?php 
    $requiredpromo = '';
    $freetrial = '';
    $billingcycl = '';
    $requiredDomainFor = ['hosting','email','ssl'];
    $requiredHostFor = ['vps','dedicatedserver'];
    $__custom_message=false;
    $h_domain = '';
    $hideyeardiv = '';
    ?>
    
    <div class="card-right order-section">
            @foreach($cartData as $proKey => $item)   
             {{-- @if(is_array($item) && isset($item['pid']) && !empty($item['pid']) && in_array($item['pid'], [495, 496, 497, 498, 421, 422, 423, 424, 425, 426, 427, 428, 429, 430, 431, 432, 186, 187, 188]))
                <script>
                    function copyPromoCode() {
                        var promoCodeInput = document.getElementById("promoCodeInput");
                        promoCodeInput.select();
                        document.execCommand("copy");
                        var copyStatus = document.getElementById("copyStatus");
                        copyStatus.innerHTML = "Promo code copied!";
                        promoCodeInput.blur();
                        setTimeout(() => copyStatus.innerHTML = '', 5000);
                    }

                    function closePopup() {
                        if (!localStorage.getItem('modal_offers_bfs_23_closed')) {
                            $('#modal_offers_bfs_23').modal('hide');
                            localStorage.setItem('modal_offers_bfs_23_closed', 'true');
                        }
                    }

                    function shouldShowPopup() {
                        return localStorage.getItem('modal_offers_bfs_23_closed') !== 'true';
                    }

                    function showPopup() {
                        if (shouldShowPopup()) {
                            $('#modal_offers_bfs_23').modal('show');
                        }
                    }

                    $(document).ready(function() {
                        setTimeout(function() {
                            var allowedURLs = ["https://www.hostitsmart.com/cart/billinginfo"];
                            if (allowedURLs.includes(window.location.href.trim())) {
                                showPopup();
                            }
                        }, 5000);
                    });
                </script>
   
            @endif  --}} 
                @if(isset($item['producttype']))
                    @if($item['producttype'] == 'hosting')
                        <?php $h_domain = $item['domain']; ?> 
                    @endif
                @endif       

                {{-- Determine promocode based on conditions --}}


{{-- @php
    $sharedPlans = ['495', '496', '497', '498', '421', '422', '423', '424', '186', '187', '188', '425', '426', '427', '428', '429', '430', '431', '432'];
    $vpsPlans = ['465', '466', '463', '464', '467', '468', '469', '470', '471', '472', '473', '474', '475', '476', '477', '478', '483', '484', '485', '486', '487', '488', '489', '490', '479', '480', '481', '482'];
    

    
    if (isset($item['producttype']) && !empty($item['producttype'])) {
        if (isset($item['pid']) && !empty($item['pid']) && in_array($item['pid'], $sharedPlans)) {
            $promocode = ($item['billingcycle'] == 'annually' || $item['billingcycle'] == 'biennially' || $item['billingcycle'] == 'triennially') ? 'BFSALE10' : '';
        }
    }
@endphp

@if(isset($promocode) && !empty($promocode))
    <script type="text/javascript">
        $('#txtpromo').val('{{ $promocode }}');
        applyPromocode();
    </script>
@else
    <script type="text/javascript">
        removePromocode();
    </script>
@endif --}}

  

                {{-- @if(isset($h_domain))
                    @if(isset($item['producttype']) && !empty($item['producttype']) && $item['producttype'] == 'domain' && $item['domain'] != $h_domain)
                        <script type="text/javascript">
                            $('#txtpromo').val('BFDEAL22');
                            applyPromocode();
                        </script>  
                    @endif
                @endif --}}
                @if(isset($item['producttype']) && $item['producttype']=='hosting')
                    @php $requiredpromo="hosting"; @endphp
                @endif
                @if (isset($item['pid']) && !empty($item['pid']) && $item['pid'] == 416)
                   @php $freetrial="forex"; @endphp
                @endif
                @php
                    if( (isset($item['producttype']) && $item['producttype']=='hosting') ){
                        if (($item['billingcycle'] == 'quarterly' || $item['billingcycle'] == 'semi-annually')) {
                            $__custom_message=true;
                        }
                    }
                @endphp
                @if(isset($item['billingcycle']) && $item['billingcycle']=='triennially')
                    @php $billingcycl="triennially"; @endphp
                @elseif(isset($item['billingcycle']) && $item['billingcycle']=='biennially')
                    @php $billingcycl="biennially"; @endphp
                @elseif(isset($item['billingcycle']) && $item['billingcycle']=='annually')
                    @php $billingcycl="annually"; @endphp
                @endif
            @endforeach
        
                <h2 class="sumary-title">Order Summary</h2>
                @php 
                    $combooffer_domain=""; 
                @endphp
                @foreach($cartData as $proKey => $item)
                
                @if(isset($item['pid']))
                    @if($item['pid']=='218')
                       @php $combooffer_domain=$item['domain']; @endphp
                    @endif
                        @if( $item['pid'] == '497' || $item['pid'] == '498' || $item['pid'] == '423' || $item['pid'] == '424'  || $item['pid'] == '427' || $item['pid'] == '428' || $item['pid'] == '431' || $item['pid'] == '432')
                                @if($item['billingcycle'] == 'triennially' || $item['billingcycle'] == 'biennially' || $item['billingcycle'] == 'annually')
                                    <?php
                                        $tld = substr($item['domain'], -3);
                                        if($tld == 'com'){
                                            $combooffer_domain=$item['domain'];
                                        }
                                    ?>
                                @endif
                        @endif
                    @php
                        $domain_tld = substr($item['domain'], -3, 3);
                    @endphp
                @endif
                    
                    @if(isset($item['producttype']) && $item['producttype'] == 'domain')
                    <?php $priceStr = "";
                    if($item['domain']==$combooffer_domain)
                        {
                            foreach($item['pricing'] as $pr){ 
                            if($pr->duration == 1) {
                                $priceStr=0;
                                
                              // echo 'yes: '; print_r($hideyeardiv);
                            }
                            else{
                                if($pr->duration == $item['regperiod']) { 
                            if($item['domaintype'] == 'register')
                                { $priceStr = $pr->register - 199;  }
                            else if($item['domaintype'] == 'transfer')
                                { $priceStr = $pr->transfer;  }
                            else if($item['domaintype'] == 'renewal')
                                { $priceStr = $pr->renwal;  }
                            } 

                            }
                           }

                        }
                        else
                        {

                            foreach($item['pricing'] as $pr){ if($pr->duration == $item['regperiod']) { 
                            if($item['domaintype'] == 'register')
                                { $priceStr = $pr->register;  }
                            else if($item['domaintype'] == 'transfer')
                                { $priceStr = $pr->transfer;  }
                            else if($item['domaintype'] == 'renewal')
                                { $priceStr = $pr->renwal;  }
                            } 
                        }
                    }
                     ?>
                    <div class="cart-right" data-aos="fade-left" data-aos-easing="ease-out-back">
                    <div class="cart-box-1 row">
                        <div class="order-summary-text col-sm-8 col-8">
                            @if($item['domaintype'] == 'register')
                            <div class="ost_title">Domain Registration</div>
                            @elseif($item['domaintype'] == 'transfer')
                            <div class="ost_title">Domain Transfer</div>
                            @elseif($item['domaintype'] == 'renewal')
                            <div class="ost_title">Domain Renewal</div>
                            @endif
                            @if(!empty($item['domain']))<div class="ost_product-name">{{$item['domain']}}</div>@endif

                            @if($item['domain'] == $combooffer_domain)
                                <?php $hideyeardiv = 'd-none'; ?>
                            @else
                                <?php $hideyeardiv = ' '; ?>
                            @endif

                            @if(isset($item['pricing']))
                            <div class="select_period select_combo {{$hideyeardiv}}">
                                <form id="cart_form_{{$proKey}}" action="#" method="post">
                                    <input type="hidden" id="ele_key" name="ele_key" value="{{$proKey}}">
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    
                                    <select id="sel_domainregister_{{$proKey}}" name="sel_domainregister_{{$proKey}}" class="form-control form-select " onchange="updateDomainConfigurationNew({{$proKey}});">
                                        <?php $currPlanPrice = ""; ?>
                                        @foreach($item['pricing'] as $price)

                                        <?php
                                       
                                            if(!empty($price->register) && $price->duration == $item['regperiod']){
                                                $currPlanPrice = ($price->register / $price->duration);
                                                $RenewsPlanPrice = ($price->renwal / $price->duration);
                                            }
                                            ?>
                                        @if($price->register > 0)
                                        @if($item['domaintype'] == 'transfer')
                                        @if($price->duration == 1)
                                        <option value="{{$price->duration}}" @if($price->duration == $item['regperiod']) selected @endif >{{$price->duration}} @if($price->duration > 1) years @else year @endif</option>
                                        @endif
                                        @else
                                        <option value="{{$price->duration}}" @if($price->duration == $item['regperiod']) selected @endif >{{$price->duration}} @if($price->duration > 1) years @else year @endif</option>
                                        @endif
                                        @endif
                                        @endforeach
                                    </select>
                                   
                                </form>
                            </div>
                            @endif
                            
                            @if(isset($currPlanPrice) && !empty($currPlanPrice))
                            <div class="renew_price">Renews at <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{round($RenewsPlanPrice)}}/yr*</div>
                            @endif
                        </div>
                        @foreach($item['addonproducts'] as $addonkey => $addon)
                            @if(isset($addon['pid']))
                            @else
                                @if(isset($addon['added']))
                                    <?php 
                                        //$priceStr += ($addon['price']*$item['regperiod']);
                                          $privacy_price=($addon['price']*$item['regperiod']);
                                    ?>
                                @endif
                            @endif
                        @endforeach
                        <div class="order-summary-price col-sm-4 col-4">
                            <div class="product_price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$priceStr}}</div>
                            <?php 
                                if(isset($item['pricing']) && $item['regperiod'] > 0){
                                    //echo '<pre>';print_r($item['pricing'][0]->register);
                                    $oneYear = isset($item['pricing'][0]->register)?$item['pricing'][0]->register:0;
                                    $twoYears = isset($item['pricing'][$item['regperiod']]->register)?($item['pricing'][$item['regperiod'] -1]->register - $oneYear):0;
                                }
                            ?>
                                <?php
                                /*@if(isset($oneYear) && !empty($oneYear))
                                <div class="year_price">1st year <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$oneYear}}</div>
                                @endif
                                @if(isset($twoYears) && !empty($twoYears))
                                <div class="year_price">2+ years <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$twoYears}}</div>
                                @endif*/
                                ?>
                            <div class="delete_btn">
                                <a class="delete-icon" title="Delete" href="javascript:void(0);" onclick="removeCartItem('{{$proKey}}');">
                                    <i class="delete-i  sprite-image"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @foreach($item['addonproducts'] as $addonkey => $addon)
                               @if(isset($addon['pid']))
                               
                               @elseif($addon['price'] != 0)
                                <div class="cart-box-1 row">
                                <div class="reminder_div col-sm-8 col-8">
                                {!!$addon['desc']!!}
                                </div>
                                <div class="action_btns col-sm-4 col-4 d-flex justify-content-end">
                               
                                @if(!isset($addon['added'])) 
                                <a class="add_btn pull-right" href="javascript:void(0)" onclick="addAddonsDomainNew('{{$addon['type']}}','{{$addon['did']}}','{{$addon['type']}}','{{$addon['type']}}','{{$addon['type']}}', this,'{{$proKey}}','{{$addonkey}}','add');" id="{{$addon['type']}}" name="{{$addon['type']}}" title="Add">Add</a>
                                @elseif(isset($addon['added']))
                                <span class="mr-4">@if($addon['price'] == 0) Free @else<span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span> {{$privacy_price}} @endif</span> 
                                <a class="" href="javascript:void(0)" onclick="addAddonsDomainNew('{{$addon['type']}}','{{$addon['did']}}','{{$addon['type']}}','{{$addon['type']}}','{{$addon['type']}}', this,'{{$proKey}}','{{$addonkey}}','remove');" id="{{$addon['type']}}" name="{{$addon['type']}}" title="Cancel">
                                <i class="fa fa-times" aria-hidden="true"></i>
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
                            <div class="ost_title"><a href="{{url('cart/newconfig?id=')}}{{$proKey}}@if(in_array($item['producttype'],$requiredHostFor) && empty($item['domain']))&hostname=1 @endif">{{$item['groupname']}} - {{$item['planname']}}</a></div>
                            
                            @if(isset($item['domain']) && !empty($item['domain']))<div class="ost_product-name">{{$item['domain']}}</div> @endif
                            @if(in_array($item['producttype'],$requiredDomainFor) && empty($item['domain']))
                                <div class="ost_product-name red">Please provide Domain.&nbsp;<a class="carterr" href="{{url('cart/newconfig?id=')}}{{$proKey}}">Click Here</a></div>    
                            @endif
                            @if(in_array($item['producttype'],$requiredHostFor) && empty($item['domain']))
                            <?php
                            //<div class="ost_product-name red">Please provide Hostname.&nbsp;<a class="carterr" href="{{url('cart/newconfig?id=')}}{{$proKey}}&hostname=1">Click Here</a></div>    
                            ?>
                            <div class="ost_product-name host_{{$proKey}}"><span class="red">Please provide Hostname.</span>&nbsp;@if($item['producttype'] == 'vps' || $item['producttype'] == 'dedicatedserver')<a class="carterr hostclick" data-id="{{$proKey}}" data-bs-toggle="modal" data-bs-target="#domainModel" title="Update Hostname" href="">Update Hostname</a>@endif</div>    
                            @endif
                            <?php
                            /*@if(in_array($item['producttype'],$requiredHostFor) && empty($item['domain']))
                                <div class="ost_product-name red">Please provide Hostname.&nbsp;<a class="carterr" href="{{url('cart/newconfig?id=')}}{{$proKey}}&hostname=1">Click Here</a></div>    
                            @endif*/
                            ?>
                            @if(isset($item['pricing']))
                            <div class="select_period select_combo">
                                <form id="cart_form_{{$proKey}}" action="#" method="post">
                                    <input type="hidden" id="ele_key" name="ele_key" value="{{$proKey}}">
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    
                                    <select id="sel_hostingregister_{{$proKey}}"  name="sel_hostingregister_{{$proKey}}" class="form-control form-select" 
                                    @if($item['producttype'] == 'hosting')
                                        onchange="updateHostingItemNew({{$proKey}},this.value);
                                    @elseif($item['producttype'] == 'vps' || $item['producttype'] == 'dedicatedserver')
                                        onchange="updateServerItemNew({{$proKey}},this.value);    
                                    @else 
                                        onchange="updateHostingItemNew({{$proKey}},this.value);
                                    @endif   
                                    ">         
                                     <?php $currPlanPrice = ""; $renewalPrice?>
                                     @foreach($item['pricing'] as $optKey => $price)
                                                <?php 
                                                    
                                                    if(!empty($price->price) && $price->durationame == $item['billingcycle']){
                                                        $currPlanPrice = ($price->price / $price->duration);
                                                    }

                                                     if(isset($price->renewal_price) && $price->durationame == $item['billingcycle']){
                                                        $renewalPrice = $price->renewal_price;
                                                    }
                                                ?>
                                                    @if($price->price > 0)
                                                        <option value="{{$price->durationame}}" @if($price->durationame == $item['billingcycle']) selected @endif >{{$price->duration}} @if($price->duration > 1) months @else month @endif</option>
                                                        <?php $timeduration = $price->duration; ?> <?php /* 11/3/2020 this is for vps product for renewval price update patch */ ?>
                                                    @endif
                                                @endforeach
                                        </select>
                                </form>        
                            </div>
                            @endif
                           @if(isset($currPlanPrice) && !empty($currPlanPrice))

                                {{-- Diwali offer Start --}}
                               {{--  @php $newArrProductForDiwali = 
                                [
                                // Linux Hosting
                                179 => 
                                    ["annually" => 120, 'biennially' => 100, 'triennially' => 80],
                                180 => 
                                    ["annually" => 240, 'biennially' => 200, 'triennially' => 160],
                                181 => 
                                    ["annually" => 480, 'biennially' => 400, 'triennially' => 320],

                                // Windows Hosting
                                186 => 
                                    ["annually" => 140, 'biennially' => 120, 'triennially' => 100],
                                187 => 
                                    ["annually" => 380, 'biennially' => 350, 'triennially' => 300],
                                188 => 
                                    ["annually" => 540, 'biennially' => 500, 'triennially' => 400],

                                // Wordpress Hosting
                                155 => 
                                    ["annually" => 120, 'biennially' => 100, 'triennially' => 80],
                                156 => 
                                    ["annually" => 240, 'biennially' => 200, 'triennially' => 160],
                                157 => 
                                    ["annually" => 480, 'biennially' => 400, 'triennially' => 320],

                                // E-commerce Hosting
                                161 => 
                                    ["annually" => 120, 'biennially' => 100, 'triennially' => 80],
                                162 => 
                                    ["annually" => 240, 'biennially' => 200, 'triennially' => 160],
                                163 => 
                                    ["annually" => 480, 'biennially' => 400, 'triennially' => 320],

                                // Java Hosting
                                158 => 
                                    ["annually" => 120, 'biennially' => 100, 'triennially' => 80],
                                159 => 
                                    ["annually" => 240, 'biennially' => 200, 'triennially' => 160],
                                160 => 
                                    ["annually" => 480, 'biennially' => 400, 'triennially' => 320],

                                ]; 
                                @endphp
                                @php $newArrProductCycleForDiwali = [ 'annually', 'biennially', 'triennially']; @endphp --}}
                                {{-- Diwali offer End --}}

                           <div class="renew_price text-danger">Renews at <span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                           <?php /* {{round($currPlanPrice,2)}}/mo */ ?>
                           @if( $item['pid'] == 236 || $item['pid'] == 238 )
                                {{round( $priceStr / $item['pricing'][$item['regperiod']]->duration,2 )}}/mo
                            {{-- Diwali offer Start --}}
                            {{-- @elseif(array_key_exists($item['pid'],$newArrProductForDiwali) && in_array($item['billingcycle'], $newArrProductCycleForDiwali) )
                                        {{round( $newArrProductForDiwali[$item['pid']][$item['billingcycle']],2 )}}/mo --}}
                            {{-- Diwali offer End --}}

                           @else
                           @php 
                                    $currentDate = new DateTime(); // Get the current date
                                    $newDate = clone $currentDate; // Clone to avoid modifying the original object

                                    if ($item['billingcycle'] == 'monthly') {
                                        $newDate->modify('+1 month');
                                    } elseif ($item['billingcycle'] == 'annually') {
                                        $newDate->modify('+1 year');
                                    }elseif ($item['billingcycle'] == 'biennially') {
                                        $newDate->modify('+2 year');
                                    }elseif ($item['billingcycle'] == 'triennially') {
                                        $newDate->modify('+3 year');
                                    }
                                @endphp
                                {{-- {{dd($renewalPrice,123)}} --}}
                            @if(isset($renewalPrice) && !empty($renewalPrice))
                            @php 
                            // dd($item['pid']);
                                $google_apps_product_id = array(117,116,206,534,535,536,537,522,523,524,525);
                            @endphp
                               @if($item['producttype'] == 'vps' || (in_array($item['pid'], $google_apps_product_id)))
                                {{ round($renewalPrice, 2) }}/mo on {{ $newDate->format('d-m-Y') }}
                                @else
                                {{ round($renewalPrice, 2) }}/mo
                                @endif 
                            @else
                                {{ round($currPlanPrice, 2) }}/mo 
                            @endif
                           @endif
                       
                           </div> 
                           @endif
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
                // echo '<pre>'; print_r($field);
                
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
                                        if($opt['name']=="None")
                                        {
                                            $serverconfigHtmlStr .= '<div class="cart-box-1 row">
                                            <div class="reminder_div col-sm-9 col-9">
                                                <span class="reminder_title">'.$field['name'].'</span> '.$opt['name'].' 
                                            </div>
                                        </div>';
                                        }
                                        else
                                        {
                                            $serverconfigHtmlStr .= '<div class="cart-box-1 row">
                                            <div class="reminder_div col-sm-9 col-9">
                                                <span class="reminder_title">'.$field['name'].'</span> '.$opt['name'].' 
                                            </div>
                                        </div>';        
                                        }
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
                            <a title="View offer disclaimers" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#disclaimer-popup" title="View offer disclaimers">View offer disclaimers</a>
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
                    {{-- @if(!empty($UserID)) --}}
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
                                <div id="loading-image" style="display: none;align-items: center;"><div>Validating Promocode.</div><img style="max-width: 5%;display: inline;" src="{{Config::get('Constant.CDNURL')}}/assets/images/ajaxloader2.gif"></div>
                                <span class="red" id="promocode_validation"></span>
                                {{-- @if ($freetrial == "forex")
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: FREETRIAL" onclick="$('#txtpromo').val('FREETRIAL');applyPromocode();">To claim a Trial For 7-Days, Apply a promo code - FREETRIAL</a>
                                @endif --}}

                                @if( $requiredpromo == "hosting" )
                               {{--  <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HOSTITSMART-20');applyPromocode();">Get 20% on shared hosting applicable On Annual,Bi-Annual,Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}

                                {{-- @if( $billingcycl == "triennially") --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL3M" onclick="$('#txtpromo').val('CARNVL3M');applyPromocode();">Great Job! Click Here to Grab Extra 3 MONTHS FREE</a> --}}

                                @if($billingcycl == "biennially" || $billingcycl == "triennially")

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HostITSmart-20');applyPromocode();">2-3 Years Get 20% on shared hosting applicable On Bi-Annual and Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL2M" onclick="$('#txtpromo').val('CARNVL2M');applyPromocode();">Great Job! Click Here to Grab Extra 2 MONTHS FREE</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: FREEDOM20" onclick="$('#txtpromo').val('FREEDOM20');applyPromocode();">Spot on! You are just 1-click away to grab a 20% Discount. <br> Click Here to apply promo code: FREEDOM20.</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-30" onclick="$('#txtpromo').val('HostITSmart-30');applyPromocode();">3 Year Get 30% on shared hosting applicable On Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-30</a> --}}
                                {{-- @elseif($billingcycl == "biennially") --}}
                                @elseif($billingcycl == "annually")
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-10" onclick="$('#txtpromo').val('HostITSmart-10');applyPromocode();">1 Year Get 10% on shared hosting applicable On Annual Subscription, Click here to apply promocode: HOSTITSMART-10</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL1M" onclick="$('#txtpromo').val('CARNVL1M');applyPromocode();">Great Job! Click Here to Grab Extra 1 MONTH FREE</a> --}}
                                    
                                     {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: FREEDOM10" onclick="$('#txtpromo').val('FREEDOM10');applyPromocode();">Spot on! You are just 1-click away to grab a 10% Discount. <br> Click Here to apply promo code: FREEDOM10.</a> --}}
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HostITSmart-20');applyPromocode();">2 Years Get 20% on shared hosting applicable On Bi-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}
                                @else
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-25" onclick="$('#txtpromo').val('HostITSmart-25');applyPromocode();">1-2 Year Get 25% on shared hosting applicable On Annual,Bi-Annual Subscription, Click here to apply promocode: HOSTITSMART-25</a> --}}
                                @endif

                                {{-- @if( $billingcycl == "triennially" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF90" onclick="$('#txtpromo').val('HITSBF90');applyPromocode();">3 Years Get 90% on shared hosting applicable On Ti-Annual Subscription, Click here to apply promocode: HITSBF90</a>
                                @elseif( $billingcycl == "biennially" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF80" onclick="$('#txtpromo').val('HITSBF80');applyPromocode();">2 Years Get 80% on shared hosting applicable On Bi-Annual Subscription, Click here to apply promocode: HITSBF80</a>
                                @elseif( $billingcycl == "annually" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF70" onclick="$('#txtpromo').val('HITSBF70');applyPromocode();">1 Year Get 70% on shared hosting applicable On Annual Subscription, Click here to apply promocode: HITSBF70</a>
                                @endif --}}

                                <?php /*<a class="title" href="javascript:void(0);" title="Apply promocode: HITSXMAS" onclick="$('#txtpromo').val('HITSXMAS');applyPromocode();">Web Hosting Offer Flat 50 % Discount + Extra 40 % Discount, Click here to apply promocode: HITSXMAS</a> */ ?>
                                @endif  
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
                                <div id="loading-image" style="display: none;align-items: center;"><div>Validating Promocode.</div><img style="max-width: 5%;display: inline;" src="{{Config::get('Constant.CDNURL')}}/assets/images/ajaxloader2.gif"></div>
                                <span class="red" id="promocode_validation"></span>
                                 {{-- @if ($freetrial == "forex")
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: FREETRIAL" onclick="$('#txtpromo').val('FREETRIAL');applyPromocode();">To claim a Trial For 7-Days, Apply a promo code - FREETRIAL</a>
                                @endif --}}
                                
                                @if( $requiredpromo == "hosting" )
                               {{--  <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HOSTITSMART-20');applyPromocode();">Get 20% on shared hosting applicable On Annual,Bi-Annual,Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}
                                {{-- @if( $billingcycl == "triennially") --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL3M" onclick="$('#txtpromo').val('CARNVL3M');applyPromocode();">Great Job! Click Here to Grab Extra 3 MONTHS FREE</a> --}}

                                @if($billingcycl == "biennially" || $billingcycl == "triennially")
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HostITSmart-20');applyPromocode();">2-3 Years Get 20% on shared hosting applicable On Bi-Annual and Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL2M" onclick="$('#txtpromo').val('CARNVL2M');applyPromocode();">Great Job! Click Here to Grab Extra 2 MONTHS FREE</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: FREEDOM20" onclick="$('#txtpromo').val('FREEDOM20');applyPromocode();">Spot on! You are just 1-click away to grab a 20% Discount. <br> Click Here to apply promo code: FREEDOM20.</a> --}}
                                    
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-30" onclick="$('#txtpromo').val('HostITSmart-30');applyPromocode();">3 Year Get 30% on shared hosting applicable On Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-30</a> --}}
                                {{-- @elseif($billingcycl == "biennially") --}}
                                @elseif($billingcycl == "annually")
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-10" onclick="$('#txtpromo').val('HostITSmart-10');applyPromocode();">1 Year Get 10% on shared hosting applicable On Annual Subscription, Click here to apply promocode: HOSTITSMART-10</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL1M" onclick="$('#txtpromo').val('CARNVL1M');applyPromocode();">Great Job! Click Here to Grab Extra 1 MONTH FREE</a> --}}
                                    
                                     {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: FREEDOM10" onclick="$('#txtpromo').val('FREEDOM10');applyPromocode();">Spot on! You are just 1-click away to grab a 10% Discount. <br> Click Here to apply promo code: FREEDOM10.</a> --}}
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HostITSmart-20');applyPromocode();">2 Years Get 20% on shared hosting applicable On Bi-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}
                                @else
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-25" onclick="$('#txtpromo').val('HostITSmart-25');applyPromocode();">1-2 Year Get 25% on shared hosting applicable On Annual,Bi-Annual Subscription, Click here to apply promocode: HOSTITSMART-25</a> --}}
                                @endif

                                {{-- @if( $billingcycl == "triennially" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF90" onclick="$('#txtpromo').val('HITSBF90');applyPromocode();">3 Years Get 90% on shared hosting applicable On Ti-Annual Subscription, Click here to apply promocode: HITSBF90</a>
                                @elseif( $billingcycl == "biennially" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF80" onclick="$('#txtpromo').val('HITSBF80');applyPromocode();">2 Years Get 80% on shared hosting applicable On Bi-Annual Subscription, Click here to apply promocode: HITSBF80</a>
                                @elseif( $billingcycl == "annually" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF70" onclick="$('#txtpromo').val('HITSBF70');applyPromocode();">1 Year Get 70% on shared hosting applicable On Annual Subscription, Click here to apply promocode: HITSBF70</a>
                                @endif --}}

                                <?php /*<a class="title" href="javascript:void(0);" title="Apply promocode: HITSXMAS" onclick="$('#txtpromo').val('HITSXMAS');applyPromocode();">Web Hosting Offer Flat 50 % Discount + Extra 40 % Discount, Click here to apply promocode: HITSXMAS</a> */ ?>
                                @endif 
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
                                <?php /*<a class="title" href="{{url('/deals')}}" title="Click here to check top deals">Click here to check top deals</a> */ ?>
                                
                                <div class="promocode_input">
                                    <input type="text" id="txtpromo" name="txtpromo" placeholder="Have a promocode?">
                                            <button class="btn" title="Apply" onclick="applyPromocode();">Apply</button>
                                </div>
                                <div class="promocode_note">*Apply one coupon at a time</div>
                                <div id="loading-image" style="display: none;align-items: center;"><div>Validating Promocode.</div><img style="max-width: 5%;display: inline;" src="{{Config::get('Constant.CDNURL')}}/assets/images/ajaxloader2.gif"></div>
                                <span class="red" id="promocode_validation"></span>
                                 {{-- @if ($freetrial == "forex")
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: FREETRIAL" onclick="$('#txtpromo').val('FREETRIAL');applyPromocode();">To claim a Trial For 7-Days, Apply a promo code - FREETRIAL</a>
                                @endif --}}
                                
                                @if( $requiredpromo == "hosting" )
                               {{--  <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HOSTITSMART-20');applyPromocode();">Get 20% on shared hosting applicable On Annual,Bi-Annual,Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}
                                {{-- @if( $billingcycl == "triennially") --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL3M" onclick="$('#txtpromo').val('CARNVL3M');applyPromocode();">Great Job! Click Here to Grab Extra 3 MONTHS FREE</a> --}}

                                @if($billingcycl == "biennially" || $billingcycl == "triennially")
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HostITSmart-20');applyPromocode();">2-3 Years Get 20% on shared hosting applicable On Bi-Annual and Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL2M" onclick="$('#txtpromo').val('CARNVL2M');applyPromocode();">Great Job! Click Here to Grab Extra 2 MONTHS FREE</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: FREEDOM20" onclick="$('#txtpromo').val('FREEDOM20');applyPromocode();">Spot on! You are just 1-click away to grab a 20% Discount. <br> Click Here to apply promo code: FREEDOM20.</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-30" onclick="$('#txtpromo').val('HostITSmart-30');applyPromocode();">3 Year Get 30% on shared hosting applicable On Ti-Annual Subscription, Click here to apply promocode: HOSTITSMART-30</a> --}}
                                {{-- @elseif($billingcycl == "biennially") --}}
                                @elseif($billingcycl == "annually")
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-10" onclick="$('#txtpromo').val('HostITSmart-10');applyPromocode();">1 Year Get 10% on shared hosting applicable On Annual Subscription, Click here to apply promocode: HOSTITSMART-10</a> --}}

                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: CARNVL1M" onclick="$('#txtpromo').val('CARNVL1M');applyPromocode();">Great Job! Click Here to Grab Extra 1 MONTH FREE</a> --}}
                                    
                                     {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: FREEDOM10" onclick="$('#txtpromo').val('FREEDOM10');applyPromocode();">Spot on! You are just 1-click away to grab a 10% Discount. <br> Click Here to apply promo code: FREEDOM10.</a> --}}
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-20" onclick="$('#txtpromo').val('HostITSmart-20');applyPromocode();">2 Years Get 20% on shared hosting applicable On Bi-Annual Subscription, Click here to apply promocode: HOSTITSMART-20</a> --}}
                                @else
                                    {{-- <a class="title" href="javascript:void(0);" title="Apply promocode: HOSTITSMART-25" onclick="$('#txtpromo').val('HostITSmart-25');applyPromocode();">1-2 Year Get 25% on shared hosting applicable On Annual,Bi-Annual Subscription, Click here to apply promocode: HOSTITSMART-25</a> --}}
                                @endif

                                {{-- @if( $billingcycl == "triennially" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF90" onclick="$('#txtpromo').val('HITSBF90');applyPromocode();">3 Years Get 90% on shared hosting applicable On Ti-Annual Subscription, Click here to apply promocode: HITSBF90</a>
                                @elseif( $billingcycl == "biennially" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF80" onclick="$('#txtpromo').val('HITSBF80');applyPromocode();">2 Years Get 80% on shared hosting applicable On Bi-Annual Subscription, Click here to apply promocode: HITSBF80</a>
                                @elseif( $billingcycl == "annually" )
                                    <a class="title" href="javascript:void(0);" title="Apply promocode: HITSBF70" onclick="$('#txtpromo').val('HITSBF70');applyPromocode();">1 Year Get 70% on shared hosting applicable On Annual Subscription, Click here to apply promocode: HITSBF70</a>
                                @endif --}}

                                <?php /*<a class="title" href="javascript:void(0);" title="Apply promocode: HITSXMAS" onclick="$('#txtpromo').val('HITSXMAS');applyPromocode();">Web Hosting Offer Flat 50 % Discount + Extra 40 % Discount, Click here to apply promocode: HITSXMAS</a> */ ?>
                                @endif 
                            </div>
                            <div class="after-promocode d-flex" id="promoafter" style="display:none;"></div>
                        </div>
                    </div>
                    @endif
                    {{-- @endif --}}
                    <div class="grand_total_section row">
                        <div class="grand_total_title col-sm-7 col-7">
                            Net Amount
                        </div>
                        <div class="grand_total_price col-sm-5 col-5" id="grandtotalSpan"><span class="rupee grand_total_rupee">{!! Config::get('Constant.sys_currency_symbol') !!} </span> 0</div>
                    </div>
                    <div class="sub_total_section taxes_included row">
                        <div class="sub_total_title col-sm-7 col-7">
                            <!-- <a href="#" title="Taxes & Fees">Taxes & Fees</a> -->
                            <div class="tax-cart d-flex">
                                <span class="taxes">
                                Taxes &amp; Fees
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
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

                    @if ($__custom_message == true)
                        {{-- <div style="font-size: 12px;font-weight: 600;line-height: 150%;letter-spacing: .5px;color: #4d4d4d;">
                            Don’t Miss It! Grab Extra Discounts. To get this benefit, select 1 or 2 or 3-year Package from the dropdown.
                        </div> --}}
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
                <h2 class="modal-title" title="Disclaimers">Disclaimers</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
<!-- The Modal -->
  <div class="modal fade" id="domainModel">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">HostITsmart Says</h4>
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <label>Please enter hostname<span class="required">*</span></label>
          <input type="text" class="form-control customele" value="{{date('YmdHis')}}.hostitsmart.com" name="customfield_hostname" id="customfield_hostname" placeholder="Enter Hostname">
          <span class="error" id="hostnameerr"></span>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="hostpopup">Ok</button>
        </div>
        
      </div>
    </div>
  </div> 
<!-- popup html start -->
<div class="offers_ads_23">
    <div class="modal fade modal_offers_bfs_23" id="modal_offers_bfs_23" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="ofads-cross_btn">
                    <button type="button" class="close" data-bs-dismiss="modal" onclick="closePopup()" aria-label="Close" id="closeButton" title="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">

                            <div class="ofads-wt">
                                Surprise Savings
                            </div>
                            <div class="col-lg-6">
                                <div class="ofads-right">

                                    <div class="ofads_top">
                                        <div class="ofads-main-circle">
                                            <div class="ofads-spc">
                                                <img src="../assets/images/popup/Suprise-Savings-cpn.png" alt="Suprise-Savings-cpn" loading="lazy">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ofads-cnt">
                                        You’ve Got a<br>
                                        <span>Golden Ticket</span> to<br>
                                        Awesome Discount!
                                    </div>
                                    <div class="ofads-cpn">
                                        <input type="text" value="SAVE" id="promoCodeInput" readonly>
                                        <button onclick="copyPromoCode()">
                                            <i class="fa-regular fa-copy"></i>
                                        </button>
                                    </div>
                                    <div id="copyStatus"></div>
                                    <p id="copyStatus"></p>
                                    <div class="ofads-grb">
                                    Note : Copy & Apply this Promocode at Checkout*
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="ofads-left">
                                    <div class="of-ads-left-vector">
                                        <img src="../assets/images/popup/Suprise-Savings-2024.png" alt="popup-vector" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popup html end -->
<script type="text/javascript">
 hostarr = new Array();
   
     $(".hostclick").click(function(){
         hostarr['productid']=$(this).data("id");
      });
      $("#hostpopup").click(function(){
        hostarr['val']=$("#customfield_hostname").val();
        hostarr['fieldid']="customfield_hostname";

        if($("#customfield_hostname").val()=="")
        {
            $("#hostnameerr").text("Please enter hostname");
            return false;
        }
        else
        {   

            var formData = {"_token":"{{ csrf_token() }}","productid":hostarr['productid'],"fieldid":hostarr['fieldid'],"val":hostarr['val'] }
            $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/setcustomoptionvalue')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
                 if(response == '1')
                {
                    $(".host_"+hostarr['productid']).html("<div class='ost_product'>"+hostarr['val']+"</div>");
                }
            }
            });
        }
    });
    
     $(function(){
        $("#txtpromo").keypress(function(e) {
            if(e.which == 13) {
                applyPromocode();
            }
        });
    });
</script>