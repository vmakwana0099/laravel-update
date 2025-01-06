

@php $promoSession=''; $_productIDArr=[250,238,154]; @endphp
 @php $_productID = isset($productData['relpid']) && !empty($productData['relpid']) ? $productData['relpid'] : $productData['pid']; @endphp
<input type="hidden" value="{{ $_productID }}">
 

@if (in_array($_productID, $_productIDArr))   

@if ($productData['producttype'] == "vps")
    @php if(Session::get('select-promocode')){ $promoSession = Session::get('select-promocode'); } @endphp
@if ($productData['billingcycle'] == 'triennially' || $productData['billingcycle'] == 'biennially' || $productData['billingcycle'] == 'annually')

<div class="c_c_box ccb-vps-offer">
    <h4 class="">Select any ONE of these FOUR options</h4>
    <div class="row">
        
        <div class="col-6 cart-offer-main">
            {{-- <input type="radio" class="configele" id="cpu-option1" name="promocode"> --}}
            <input type="radio" class="configele" id="vpsextraoffer-cpu-option" value="VPS21DIS5PER" {{ $promoSession == 'VPS21DIS5PER' ? "checked" : "" }} onchange="setPromocodeConfiguration(this);" name="vpsextraoffer">
            <label for="vpsextraoffer-cpu-option" class="radio_options" title="">
                <div class="cart-des">
                    <p class="cd-selected">selected</p>
                    <div class="cart-des-image-one"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/icon-discount.png"></div>
                    <p>5% OFF</p>
                </div>
            </label>
        </div>
        <div class="col-6 cart-offer-main">
            {{-- <input type="radio" class="configele" id="cpu-option2" name="promocode"> --}}
            <input type="radio" class="configele" id="vpsextraoffer-core-option" value="VPS21CPU" {{ $promoSession == 'VPS21CPU' ? "checked" : "" }} onchange="setPromocodeConfiguration(this);" name="vpsextraoffer">
            <label for="vpsextraoffer-core-option" class="radio_options" title="">
                <div class="cart-des">
                    <p class="cd-selected">selected</p>
                    <div class="cart-des-image-one"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/icon-cpu.png" alt="CPU"></div>
                    <p>+2 Core</p>
                </div>
            </label>
        </div>
        <div class="col-6 cart-offer-main">
            {{-- <input type="radio" class="configele" id="cpu-option3" name="promocode"> --}}
            <input type="radio" class="configele" id="vpsextraoffer-ram-option" value="VPS21RAM" {{ $promoSession == 'VPS21RAM' ? "checked" : "" }} onchange="setPromocodeConfiguration(this);" name="vpsextraoffer">
            <label for="vpsextraoffer-ram-option" class="radio_options" title="">
                <div class="cart-des">
                    <p class="cd-selected">selected</p>
                    <div class="cart-des-image-one"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/icon-ram.png" alt="CPU"></div>
                    <p>+2GB RAM</p>
                </div>
            </label>
        </div>
        <div class="col-6 cart-offer-main">
            {{-- <input type="radio" class="configele" id="cpu-option4" name="promocode"> --}}
            <input type="radio" class="configele" id="vpsextraoffer-hdd-option" value="VPS21HD" {{ $promoSession == 'VPS21HD' ? "checked" : "" }} onchange="setPromocodeConfiguration(this);" name="vpsextraoffer">
            <label for="vpsextraoffer-hdd-option" class="radio_options" title="">
                <div class="cart-des">
                    <p class="cd-selected">selected</p>
                    <div class="cart-des-image-one"><img src="{{Config::get('Constant.CDNURL')}}/assets/images/icon-hardisk.png" alt="CPU"></div>
                    <p>+20GB HDD</p>
                </div>
            </label>
        </div>

    </div>
    <div class="choiceisyour">
        <p>Choice Is Yours!</p>
    </div>
</div>

<script>
    function setPromocodeConfiguration(that) {
        /*alert(that.value);*/
        $.ajax({
            url: '{{url('cart/vpsExtraOffer26Feb')}}',
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {"promocode":that.value},
            beforeSend: function(){
                $('#web_loader').show();
            },
            success: function (res) {
                $('#web_loader').hide();
                console.log(res);
            }
        });
    }

    setTimeout(function(){ 

        @if (URL::to('/cart/newconfig') == url()->current())   
        tosterone("","Success! You have selected your package.","info");
        @endif

    }, 2000);

</script>

@endif
@endif
@endif