
<div class="col-xl-8" id="cartLeftDiv">
    @if(!empty($cartData))
    @foreach($cartData as $key => $cartItem)
        @if(!isset($cartItem['relatedpro']))
            @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'domain')
                @include('cart.domain',['cartItem' => $cartItem, 'key' => $key])
            @endif
            @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'hosting')
                @include('cart.hosting',['cartItem' => $cartItem, 'key' => $key])
            @endif
            @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'ssl')
                @include('cart.ssl',['cartItem' => $cartItem, 'key' => $key])
            @endif
            @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'dedicatedserver')
                @include('cart.dedicatedserver',['cartItem' => $cartItem, 'key' => $key])
            @endif
            @if(isset($cartItem['producttype']) && $cartItem['producttype'] == 'vps')
                @include('cart.dedicatedserver',['cartItem' => $cartItem, 'key' => $key])
            @endif
        @endif    
    @endforeach
   @endif
   <div id="recommandedProductDiv" class="recommanded-main" data-aos="fade-right" data-aos-easing="ease-out-back"></div>
   <div id="suggestedDomainsDiv" class="matching-domain-main aos-init aos-animate" data-aos="fade-right" data-aos-easing="ease-out-back"></div>
   <div class="add-domain-div" data-aos="fade-right" data-aos-easing="ease-out-back">
    <div class="c-2" id="cartdomaindiv">
            <h3 class="eligible-text">Add Domain</h3>
            <div class="doamin_search_div">
                <div class="form-group aos-init aos-animate" data-aos="fade-up" data-aos-easing="ease-out-back">
                    <input class="form-control" type="text" id="cartdomaintxt" name="cartdomaintxt" name="Search domain here.." placeholder="Search domain here..">
                    <div class="dropdown dropdown-bulk">
                        <select class="selectpicker" id="selCartDomain" name="selCartDomain">
                            @foreach($allCartTlds as $tld)
                              <option value="{{$tld}}">{{$tld}}</option>
                            @endforeach
                          </select>
                    </div>
                    <button class="btn" title="Search" onclick="return searchCartDomain();">Search</button>
                </div>
            </div>
    </div>
  </div>
</div>
<div class="col-xl-4" id="cart_right_panel"> @include('cart.ordersummary',['cartData' => $cartDataSummary, 'addonProducts' => $addonProductsSummary])</div>