<script type="text/javascript">
    
    var __currency = '{{ isset($currency) && !empty($currency) ? $currency : "0" }}';
    var _currency='';

    function reloadCart(){
        window.location.href='{{url("/cart")}}';
    /*$.ajax({

    async:false,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/reloadcart')}}",
            data:{"_token":"{{ csrf_token() }}"},
            type:"post",
            success:function(response){

            if (response){
            $("#cartMainContainer").html(response);
                    $('.selectpicker').selectpicker('refresh');
                    syncwithWHMCSCart();
                    hideLoader();
                    AOS.init({
                    duration: 1200,
                            once: true,
                            offset: 10,
                            disable: 'mobile'
                    });
                    AOS.refresh(true);
                    loadSuggetion();
            }

            }

    });*/
            return false;
    }

    function checkPromocode(data) {
        var result;

        $.ajax({
            async:false,
            url:"{{Config::get('hitsupdatecart')}}" + "/check_promocode.php",
            data:data,
            type:"post",
            success:function(res){ 
                result=res; 
            }
        });
        return result;
    }

    function addRecommandedProducts(type, pid, billingcycle){

    // console.log(type + " " + pid + " " + billingcycle);

    $.ajax({

    async:false,
            url:"{{url('cart/store')}}",
            data:{"_token":"{{ csrf_token() }}", "producttype":[type], "pid":[pid], "billingcycle":[billingcycle]},
            type:"post",
            success:function(response){ reloadCart(); }

    });
    }
    function applyPromocodeNew(){
        var promo = $("#txtpromo").val();
        if (promo == ''){ $("#promocode_validation").text("Please enter promocode."); $("#promoafter").children().hide(); return false; }else{ $("#promocode_validation").text(""); }
        $.ajax({
        async:false,
        url:"{{Config::get('hitsupdatecart')}}" + "/hits_applypromo.php?a=applypromo",
        data:{"promocode":promo},
        type:"post",
        success:function(res1){
            // console.log("res1: "+res1);
            alert(res1);
            }
        });
    }
    @if(Session::has('WhmcsID') && Session::get('WhmcsID') != '')
    var curruserid = "{{Session::get('WhmcsID')}}";
    @else 
    var curruserid = "0";
    @endif
    function applyPromocode(){

    var promo = $("#txtpromo").val();
             if (promo == '')
            {   
                $("#promocode_validation").text("Please enter promocode.");
                $("#promoafter").children().hide();
                return false; 
            }
            else
            {
                $("#promocode_validation").text("");

            }

    var message = "";
            var response1 = null;
            var response2 = null;
            var response3 = null;
            var check_promo_validet = true;
            $.ajax({

                    beforeSend: function () { $("#loading-image").css('display','flex'); },
                    url:"{{url('cart/converttowhmcs')}}",
                    data:{"_token":"{{ csrf_token() }}"},
                    type:"post",
                    success:function(res1){
                    $('#loading-image').hide();
                    response1 = res1;
                    currstr = $("#currency").val(); 
                    
                            $.ajax({

                            async:false,
                                    url:"{{Config::get('hitsupdatecart')}}" + "/updatecart.php",
                                    data:{"poststr":response1,"cur":currstr,"uid":curruserid},
                                    type:"post",
                                    success:function(res2){

                                    response2 = res2;
                                            $.ajax({
                                                    async:false,
                                                    url:"{{Config::get('hitsupdatecart')}}" + "/hits_cart.php?a=view",
                                                    data:{"token":"3EUZK8oJ2gFQAqYtwbWM87uHYwYon6GNqS", "promocode":promo,"sid":response2},
                                                    type:"post",
                                                    success:function(res3){


                                                    var div = $('<div>').attr({"id":"divPromocodeHtml"}).html(res3);
                                                    message=checkPromocode({"promocode":promo,"uid":curruserid});
                                                    discount = '';


                                                    if($.trim(message) == 'The promotion code entered does not exist'){
                                                        message = 'Invalid promocode.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'This promotion has not yet started. Please try again later.'){
                                                        message = 'This promotion has not yet started. Please try again later.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'The promotion code entered has expired'){
                                                        message = 'The promotion code entered has expired.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'The promotion code entered has already been used'){
                                                        message = 'The promotion code entered has already been used.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'This promotion code is only valid for new customers'){
                                                        message = 'This promotion code is only valid for new customers.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'You must have an active product/service to use this code'){
                                                        message = 'You must have an active product/service to use this code.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'This code can only be used once per client'){
                                                        message = 'This code can only be used once per client.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }else{
                                                        message = $(div).find("#scrollingPanelContainer").prev().find('.alert').text();
                                                        discount = $(div).find("span#discount").text().replace("INR", "").replace("USD", "").replace("$", "").replace(".00", "");

                                                        message = $.trim(message);
                                                        if (message == 'Promotion Code Accepted! Your order total has been updated.'){
                                                            if(promo == 'SAVE'){
                                                                message = 'Success! You have saved 10% on your plan';    
                                                            }else if(promo == 'FREEDOMDEAL'){
                                                                message = ' Congratulations! Your coupon code has been applied. You got a 10% extra discount & 15 Days extra added to Your billing.';    

                                                            }
                                                            else if(promo == 'FREEDOMSALE'){
                                                                 message = 'Congratulations! Your coupon code has been applied. You got a 15% extra discount & 15 Days extra added to Your billing.';
                                                            }

                                                            else{
                                                                // message = 'Promocode applied';
                                                                // message += '<br>*This coupon code is applicable for a one-time discount only.';
                                                            

                                                            }
                                                        }
                                                            if(message == 'The promotion code you entered has been applied to your cart but no items qualify for the discount yet - please check the promotion terms'){
                                                                 message = '<span class="red">This coupon is valid only for annual plans—choose a 1-year or longer term to grab the offer. </span>';
   
                                                             htmlstr += '<span class="promo-text red">' + message + '</span>';
                                                            }


                                                        var htmlstr = '<div class="promocde-applied-left">';
                                                            htmlstr += '<a onclick="removePromocode();" class="delete-icon" title="remove"><i class="remove-icon"></i></a>';
                                                            htmlstr += '<span class="promocode">';
                                                            htmlstr += promo;
                                                            htmlstr += '</span>';
                                                            htmlstr += '<span class="promo-text">';
                                                            htmlstr += message;
                                                            htmlstr += '</span><span class="removepro"></span>';
                                                            htmlstr += '</div>';
                                                            discount = discount.toString().replace(",","");
                                                            discount = eval(discount);
                                                        if (discount > 0){
                                                            htmlstr += '<div class="subtotal-price ml-auto"> - <span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span>' + discount + '</div>';
                                                        }
                                                        if(message == 'The promotion code entered does not exist'){
                                                            message = 'Invalid promocode.';
                                                            htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                            $("#promobefore").show();
                                                        }

                                                        else {  $("#promobefore").hide(); }
                                                    }

                                                    $("#promoafter").html(htmlstr).show();
                                                    if (check_promo_validet){
                                                        updatePromoCode('add', promo, discount, message);
                                                        refreshCartAmount(response2);
                                                    }else{
                                                        @if (Request::segment(2)=='ordersummary')
                                                            removePromocode(); updatePromoCode('remove');
                                                        @endif
                                                    }
                                                }

                                            });
                                    }

                            });
                    }

            });
            htmlStr = '<a class="delete-icon" title="remove"><i class="remove-icon"></i></a><span class="promocode">' + promo + '</span><span class="promo-text">' + message + '</span>';
            $(".after-promocode").removeClass('d-done');
            $(".before-apply-promocode").addClass('d-done');
            //$(htmlStr).insertAfter("#txtpromo");

            return message;
    }

    function removePromocode(){
        showLoader();
        $("#txtpromo").val('');
        $(".removepro").append('<div id="loading-image" style="display: flex;align-items: center;"><div>Removing Promocode.</div><img style="max-width: 5%;display: inline;" src="{{Config::get('Constant.CDNURL')}}/assets/images/ajaxloader2.gif"></div>');
    $.get("{{Config::get('hitsupdatecart')}}" + "/hits_cart.php?a=removepromo", function(){
                $("#promoafter").html('').hide();
                $("#promobefore").show();
                $("#wrongPriceCart").html('');
                //refreshCartAmount();
                syncwithWHMCSCart();
                updatePromoCode('remove');
        });
        $("#loading-image").hide();
    }

    function updateDomainConfiguration(frmkey){

    var formid = "#cart_form_" + frmkey;
            var formData = $("#cart_form_" + frmkey).serialize();
            $.ajax({

            async:true,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/updatedomain')}}",
                    data:formData,
                    type:"post",
                    success:function(response){
                    hideLoader();
                            //reloadCart();
                    }

            });
    }
     function updateDomainConfigurationNew(frmkey){

    var formid = "#cart_form_" + frmkey;
            var formData = $("#cart_form_" + frmkey).serialize();
            $.ajax({

            async:true,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/updatedomain')}}",
                    data:formData,
                    type:"post",
                    success:function(response){
                            window.location.reload();
                    }

            });
    }




    function updateHostingItem(frmkey, pid){
    var formid = "#cart_form_" + frmkey;
            var formData = $("#cart_form_" + frmkey).serialize();
            $("#sel_hostingregister_" + pid).attr("checked", true);
            $.ajax({

            async:true,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/updatehosting')}}",
                    data:formData,
                    type:"post",
                    success:function(response){
                            $("#finalPrice").html('Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + response + '</span>');
                            $("#finalPrices").html('Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + response + '</span>');
                            //hideLoader();
                            //reloadCart();
                            location.reload();
                    }

            });
    }

     function updateHostingItemNew(frmkey, pid){
    var formid = "#cart_form_" + frmkey;
            var formData = $("#cart_form_" + frmkey).serialize();
            $("#sel_hostingregister_" + pid).attr("checked", true);
            $.ajax({

            async:true,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/updatehosting')}}",
                    data:formData,
                    type:"post",
                    success:function(response){
                            $("#finalPrice").html('Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + response + '</span>');
                             window.location.reload();
                    }

            });
    }



    function updateServerItem(frmkey, pid){

    var formid = "#cart_form_" + frmkey;
            var formData = $("#cart_form_" + frmkey).serialize();
            $("#sel_hostingregister_" + pid).attr("checked", true);
            $.ajax({

            async:true,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/updateserver')}}",
                    data:formData,
                    type:"post",
                    success:function(response){

                        if (response.status === 'redirect') {
                            hideLoader();
                            $(function(){ $('#cartfull-popups').modal('show'); });
                            {{-- window.location.href = response.url; --}}
                        }

                        $("#finalPrice").html('Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + response + '</span>');
                        $("#finalPrices").html('Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + response + '</span>');
                    //hideLoader();
                            //reloadCart();
                            location.reload();
                    }

            });
    }
    function updateServerItemNew(frmkey, pid){

    var formid = "#cart_form_" + frmkey;
            var formData = $("#cart_form_" + frmkey).serialize();
            $("#sel_hostingregister_" + pid).attr("checked", true);
            $.ajax({

            async:true,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/updateserver')}}",
                    data:formData,
                    type:"post",
                    success:function(response){
                        $("#finalPrice").html('Total: <span class="low-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + response + '</span>');
                            window.location.reload();
                    }

            });
    }


    function removeCartItem(frmkey){

    if (confirm('Are you sure, you want to remove selected item from the cart?')){

    var formData = $("#cart_form_" + frmkey).serialize();
    removeCartItemAnalytices(formData,frmkey);
            $.ajax({
                async:false,
                beforeSend: function () { showLoader(); },
                url:"{{url('cart/remove')}}",
                data:formData,
                type:"post",
                success:function(response){
                    /*var total = parseInt(response);
                    hideLoader();
                    reloadCart();
                    window.location.href = "{{url('cart')}}";
                if (total > 0){
                    var cart_count = $("#cart_cout").html();
                    cart_count--;
                    $("#cart_cout").html(cart_count);
                    $("#cart_form_" + frmkey).remove();
                    }
                else 
                { window.location.href = APP_URL;}*/
                    //window.location.href = "{{url('cart')}}";
                    window.location.reload();
                }

            }).then(function(data){
    hideLoader();
    });
    }

    }

    function loadRecommandedProduct(){

    $.ajax({

    
            //beforeSend: function () { showLoader(); },
            url:"{{url('cart/getrecommandation')}}",
            data:null,
            type:"get",
            async:true,
            success:function(response){
                $("#recommandedProductDiv").html(response);
                //hideLoader();
            }

    });
    }

    function loadMatchingDomains(frmkey){

    //$("#"+frmkey).html("Loading Suggested Domains...");

    $.ajax({

    async:true,
            //beforeSend: function () { showLoader(); },
            url:"{{url('cart/suggesteddomains')}}",
            data:null,
            type:"get",
            async:false,
            success:function(response){
                $("#suggestedDomainsDiv").html(response);
                //hideLoader();
            }

    });
    }

    function loadSuggetion(){
    loadMatchingDomains('matchingdomains');
            loadRecommandedProduct();
    }

    // setTimeout("loadSuggetion();",2000); //load matching domains after 2 seconds

    function addMatchingDomain(frmkey, ele){

    var formData = $("#suggestedDomainFrm_" + frmkey).serialize();
            $.ajax({

            async:true,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/store')}}",
                    data:formData,
                    type:"post",
                    success:function(response){

                    if (response){

                    if (eval(response) == 1){

                    reloadCart();
                            $(ele).parent().parent().remove();
                            hideLoader();
                    }

                    }

                    }

            });
    }

    /*function addAddonsServer(type, pid, billingcycle, groupname, productname, ele, cartitemkey, addonitemkey){

    if (type != '' && pid != '' && billingcycle != '' && $(ele).is(":checked")){
    $.ajax({

    async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/store')}}",
            data:{"_token":"{{ csrf_token() }}", "producttype":[type], "pid":[pid], "billingcycle":[billingcycle], "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]},
            type:"post",
            success:function(response){
                    $(ele).parent().parent().parent().addClass('active');
                    reloadCart();
            }

    });
    }
    else if (type != '' && pid != '' && billingcycle != '' && !$(ele).is(":checked")){
            removeAddonCartItem(cartitemkey, cartitemkey, addonitemkey,ele);
    }

    }*/
    function addAddonsServer(type, pid, billingcycle, groupname, productname, ele, cartitemkey , addonitemkey,chk,lastsessionid){
    if (type != '' && pid != '' && billingcycle != '' && $(ele).is(":checked")){
   
        $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/store')}}",
            data:{"_token":"{{ csrf_token() }}", "producttype":[type], "pid":[pid], "billingcycle":[billingcycle], "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]},
            type:"post",
            success:function(response){
                    $(ele).parent().parent().parent().addClass('active');
                    if(chk=="Y")
                    {   
                        window.location.href="{{url("cart/config")}}"+"?id=" + lastsessionid;
                    } 
                    else
                    {
                        reloadCart();    
                    }    
            }
        });
    }
    else if (type != '' && pid != '' && billingcycle != '' && !$(ele).is(":checked"))
    {
            if(chk=="Y")
            {   
                removeSitelockAddonCartItem(cartitemkey, cartitemkey, addonitemkey,ele,lastsessionid);
            }
            else
            {  
                removeAddonCartItem(cartitemkey, cartitemkey, addonitemkey,ele);
            }
            
        }
    }
    function removeSitelockAddonCartItem(frmkey, cartitemkey, addonitemkey,ele,lastsessionid){
       
    if (confirm('Are you sure, you want to remove selected item from the cart?')){
            $(ele).parent().parent().parent().removeClass('active');
            var formData = {"_token":"{{ csrf_token() }}", "id":frmkey, "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]};
            $.ajax({

            async:false,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/removeaddon')}}",
                    data:formData,
                    type:"post",
                    success:function(response){ 

                         window.location.href="{{url("cart/config")}}"+"?id=" + lastsessionid;

                    }

            });
    }

    }
    function addAddonsDomain(type, pid, billingcycle, groupname, productname, cartitemkey, addonitemkey){
    // if (type != '' && pid != '' && billingcycle != '' && $(ele).is(":checked")){
    if (type != '' && pid != '' && billingcycle != '' ){

    $.ajax({
    async:false,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/adddomainaddons')}}",
            data:{"_token":"{{ csrf_token() }}", "producttype":[type], "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]},
            type:"post",
            success:function(response){
                    //$(ele).parent().parent().parent().addClass('active');
                    //reloadCart();
                    var price=parseFloat(response['price']).toFixed(2);
                   $("#finalPrices").html('Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + price + '</span>');
                    hideLoader();
            }

    });
    }

    /*else if (type != '' && pid != '' && billingcycle != '' && !$(ele).is(":checked")){

    removeAddonsDomain(cartitemkey, cartitemkey, addonitemkey);
            //$(ele).parent().parent().parent().removeClass('active');
    }*/

    }


       function addAddonsDomainNew(type, pid, billingcycle, groupname, productname, ele, cartitemkey, addonitemkey,action,cartreload){
    if (type != '' && pid != '' && billingcycle != '' && action == 'add'){

    $.ajax({
            async:false,
            beforeSend: function () {
                if(cartreload != '' && cartreload==1){
                 showLoader(); 
                }
            },
            url:"{{url('cart/adddomainaddons')}}",
            data:{"_token":"{{ csrf_token() }}", "producttype":[type], "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]},
            type:"post",
            success:function(response){
                    if(cartreload != 1)
                    {
                    window.location.reload();
                    //$(ele).parent().parent().parent().addClass('active');
                    //reloadCart();
                    //hideLoader();
                    }
                    
            }

    });
    }

    else if (type != '' && pid != '' && billingcycle != '' && action == 'remove'){

            removeAddonsDomain(cartitemkey, cartitemkey, addonitemkey);
            window.location.reload();
            //$(ele).parent().parent().parent().removeClass('active');
    }

    }
    


    function addAddonsDomain2(type, pid, billingcycle, groupname, productname, ele, cartitemkey, addonitemkey){
    if (type != '' && pid != '' && billingcycle != ''){

    $.ajax({

    async:false,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/adddomainaddons')}}",
            data:{"_token":"{{ csrf_token() }}", "producttype":[type], "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]},
            type:"post",
            success:function(response){
            $(ele).parent().parent().parent().addClass('active');
                    reloadCart();
            }

    });
    }

    else if (type != '' && pid != '' && billingcycle != '' && !$(ele).is(":checked")){

    removeAddonsDomain(cartitemkey, cartitemkey, addonitemkey);
            //$(ele).parent().parent().parent().removeClass('active');
    }

    }

    function hideAddonsDomain(type, pid, billingcycle, groupname, productname, ele, cartitemkey, addonitemkey){
    $.ajax({

    async:false,
            //beforeSend: function () { showLoader(); },

            url:"{{url('cart/hidedomainaddons')}}",
            data:{"_token":"{{ csrf_token() }}", "producttype":[type], "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]},
            type:"post",
            success:function(response){
            $(ele).parent().remove();
            }

    });
    }

    function removeAddonsDomain(frmkey, cartitemkey, addonitemkey){

    // if (confirm('Are you sure, you want to remove selected item from the cart?')){

    var formData = {"_token":"{{ csrf_token() }}", "id":frmkey, "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]};
            $.ajax({

            async:false,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/removeaddon')}}",
                    data:formData,
                    type:"post",
                    success:function(response){ 
                        //reloadCart();
                        var price=parseFloat(response['price']).toFixed(2);
                        $("#finalPrices").html('Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!}</span>' + price + '</span>');
                        hideLoader();
                    }

            });
    // }

    }



    function removeAddonCartItem(frmkey, cartitemkey, addonitemkey,ele){

    if (confirm('Are you sure, you want to remove selected item from the cart?')){
            $(ele).parent().parent().parent().removeClass('active');
            var formData = {"_token":"{{ csrf_token() }}", "id":frmkey, "cartitemkey":[cartitemkey], "addonitemkey":[addonitemkey]};
            $.ajax({

            async:false,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/removeaddon')}}",
                    data:formData,
                    type:"post",
                    success:function(response){ reloadCart(); }

            });
    }

    }

    function loadCartSummary(deleteHide = false){
      var vardata = {};
      if(deleteHide === true){ vardata = {'deleteHide':deleteHide}; }
     
    $.ajax({    
    async:false,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/getordersummary')}}",
            data:vardata,
            type:"get",
            success:function(response){
            $("#cart_right_panel").html(response);
            }

    }).then(function(data){
    hideLoader();
    });
    }

    //loadCartSummary(false);

    function emptycart(){
    if (confirm('Are you sure, you want to empty the cart?'))

    { 
        emptyCartItemAnalytices(); 

        window.location.href = "{{url('cart/empty')}}"; }

    }

    function refreshCartAmount(sid){

        if (__currency=='10'){
            _currency='$';
        }else if(__currency=='1'){
            _currency='₹';
        }else{
            _currency='{!! Config::get('Constant.sys_currency_symbol') !!}';
        }

        $.ajax({

        async:false,
            beforeSend: function () { /*showLoader();*/ },
            url:"{{Config::get('hitsupdatecart')}}" + "/hits_cart.php?a=getcartjson",
            data:{"token":"3EUZK8oJ2gFQAqYtwbWM87uHYwYon6GNqS","sid":sid},
            type:"post",
            success:function(data){

            var subtotal = data.subtotal.toString().replace("INR", "").replace("USD", "").replace("$", "").replace(",", "").replace(",", "");
                    var taxtotal1 = data.taxtotal.toString().replace("INR", "").replace("USD", "").replace("$", "").replace(",", "");
                    var taxtotal2 = data.taxtotal2.toString().replace("INR", "").replace("USD", "").replace("$", "").replace(",", "");
                    var rawtotal = data.rawtotal.toString().replace("INR", "").replace("USD", "").replace("$", "");
                    var rawdiscount = data.rawdiscount.toString().replace("INR", "").replace("USD", "").replace("$", "").replace(",", "");
                    /*$("#cartTotalspan").html('<span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span><span class="original" >' + parseFloat(rawtotal) + '</span>');*/
                    $("#cartTotalspan").html('<span class="rupee">' + _currency + '</span><span class="original" >' + parseFloat(rawtotal) + '</span>');
                    /*$("#finalPricesinSignin").html('Total: <span class="total-price"><span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!} </span>' + parseFloat(rawtotal) + '</span>');*/
                    $("#finalPricesinSignin").html('Total: <span class="total-price"><span class="rupee"> '+_currency+' </span>' + parseFloat(rawtotal) + '</span>');
                    var taxTotal = parseFloat(taxtotal1) + parseFloat(taxtotal2);
                    /*$("#taxesSpan").html('<span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span>' + taxTotal);*/
                    var taxTotal = parseFloat(taxtotal1) + parseFloat(taxtotal2);
                    var g_total = subtotal - rawdiscount;
                    $("#grandtotalSpan").html('<span class="rupee grand_total_rupee">' + _currency + '</span>' + g_total.toFixed(2));
                    $("#taxesSpan").html('<span class="rupee">' +  _currency + '</span>' + taxTotal);
                    /*$("#subtotalSpan").html('<span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span>' + parseFloat(subtotal));*/
                    $("#subtotalSpan").html('<span class="rupee">' + _currency + '</span>' + parseFloat(subtotal));
                    $("#discountSpan").html('- <span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span>' + parseFloat(rawdiscount));
                    if (parseFloat(rawdiscount) > 0){

            $("#wrongPriceCart").html('<span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span><span class="overline" >' + subtotal + '</span>');
            }

            /*hideLoader();*/
            }

    });
    }

    function updatePromoCode(action, promo = '', amount = '', prmomessage = ''){

    var formData = {"_token":"{{ csrf_token() }}", "action":action, "promo":promo, "discount":amount, "prmomessage":prmomessage};
            $.ajax({

            async:false,
                    beforeSend: function () { /*showLoader();*/ },
                    url:"{{url('cart/updatepromo')}}",
                    data:formData,
                    type:"post",
                    success:function(response){
                        // console.log("response123 "+response);
                     hideLoader(); }

            });
    }

    function searchFreeDomain(key){

    $("#domainsuggestiondiv, #domainavaildiv").remove('');
            var domain = $("#freedomaintxt_" + key).val();
            var tld = $("#selFreeDomain_" + key).val();
            var allTlds = [];
            $("#selFreeDomain_" + key + " option").each(function(i, ele){

    allTlds.push($(ele).val());
    });
            var formData = {"_token":"{{ csrf_token() }}", "domainname":domain, "tld":tld, "alltlds":allTlds, "relproid":key};
            if (domain == ''){ alert("Please enter domain name"); }

    else {

    $.ajax({

    async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/getfreedomain')}}",
            data:formData,
            type:"post",
            success:function(response){

            $("#cart_form_"+key+" #freedomaindiv").append(response);
                    hideLoader();
            }

    });
    }

    return false;
    }



    function searchCartDomain(key){

    $("#cartdomainsuggestiondiv, #cartdomainavaildiv").remove('');
            var domain = $("#cartdomaintxt").val();
            var tld = $("#selCartDomain").val();
            var allTlds = [];
            $("#selCartDomain option").each(function(i, ele){

    allTlds.push($(ele).val());
    });
            var formData = {"_token":"{{ csrf_token() }}", "domainname":domain, "tld":tld, "alltlds":allTlds};
            if (domain == ''){ alert("Please enter domain name"); }

    else {

    $.ajax({

    async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/getsearchcartdomain')}}",
            data:formData,
            type:"post",
            success:function(response){

            $("#cartdomaindiv").append(response);
                    hideLoader();
            }

    });
    }

    return false;
    }



    function addFreeDomainInCart(frmkey, ele){

    var formData = $("#freeDomainFrm_" + frmkey).serialize();
            $.ajax({

            async:true,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/store')}}",
                    data:formData,
                    type:"post",
                    success:function(response){
                    reloadCart();
                    }

            });
            return false;
    }

    function addCartDomainInCart(frmkey, ele){

    var formData = $("#cartDomainFrm_" + frmkey).serialize();
            $.ajax({

            async:false,
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/store')}}",
                    data:formData,
                    type:"post",
                    success:function(response){
                    reloadCart();
                            hideLoader();
                    }

            });
            return false;
    }

    function syncwithWHMCSCart(){
        //console.log('syncwithWHMCSCart');

            var response1 = null;
            var response2 = null;
            var response3 = null;
            var check_promo_validet = true;
            $.ajax({
            async:false,
                    url:"{{url('cart/converttowhmcs')}}",
                    data:{"_token":"{{ csrf_token() }}"},
                    type:"post",
                    success:function(res1){
                    response1 = res1;
                    currstr = $("#currency").val();
                            $.ajax({
                            async:false,
                                    url:"{{Config::get('hitsupdatecart')}}" + "/updatecart.php",
                                    data:{"poststr":response1,"cur":currstr,"uid":curruserid},
                                    type:"post",
                                    success:function(res2){
                                        response2 = res2;
                                        var promo = $("#txtpromo").val();
                                        if(promo != ''){
                                            $.ajax({
                                                    async:false,
                                                    url:"{{Config::get('hitsupdatecart')}}" + "/hits_cart.php?a=view",
                                                    data:{"token":"3EUZK8oJ2gFQAqYtwbWM87uHYwYon6GNqS", "promocode":promo,"sid":response2},
                                                    type:"post",
                                                    success:function(res3){

                                                    //console.log(res3);

                                                    var div = $('<div>').attr({"id":"divPromocodeHtml"}).html(res3);
                                                    message=checkPromocode({"promocode":promo,"uid":curruserid});
                                                    discount = '';
                                                        // console.log("massages123:"+ message);
                                                    if(message == 'The promotion code you entered has been applied to your cart but no items qualify for the discount yet - please check the promotion terms'){
                                                        // message = '<span class="red">This coupon is valid only for annual plans—choose a 1-year or longer term to grab the offer. </span>';
   
                                                        //      htmlstr += '<span class="promo-text red">' + message + '</span>';
                                                            }

                                                    if($.trim(message) == 'The promotion code entered does not exist'){
                                                        message = 'Invalid promocode.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'This promotion has not yet started. Please try again later.'){
                                                        message = 'This promotion has not yet started. Please try again later.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'The promotion code entered has expired'){
                                                        message = 'The promotion code entered has expired.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'The promotion code entered has already been used'){
                                                        message = 'The promotion code entered has already been used.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'This promotion code is only valid for new customers'){
                                                        message = 'This promotion code is only valid for new customers.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'You must have an active product/service to use this code'){
                                                        message = 'You must have an active product/service to use this code.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }
                                                    else if($.trim(message) == 'This code can only be used once per client'){
                                                        message = 'This code can only be used once per client.';
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show(); check_promo_validet=false;
                                                    }else{
                                                        message = $(div).find("#scrollingPanelContainer").prev().find('.alert').text();
                                                        discount = $(div).find("span#discount").text().replace("INR", "").replace("USD", "").replace("$", "").replace(".00", "");
                                                        //alert(discount);

                                                        message = $.trim(message);
                                                        if (message == 'Promotion Code Accepted! Your order total has been updated.'){
                                                             if(promo == 'SAVE'){
                                                                message = 'Success! You have saved 10% on your plan';    
                                                            }else if(promo == 'FREEDOMDEAL'){
                                                                message = 'Congratulations! Your coupon code has been applied. You got a 10% extra discount & 15 Days extra added to Your billing.';   

                                                            }
                                                            else if(promo == 'FREEDOMSALE'){
                                                                 message = 'Congratulations! Your coupon code has been applied. You got a 15% extra discount & 15 Days extra added to Your billing.';
                                                            }

                                                            else{
                                                                // message = 'Promocode applied';
                                                                // message += '<br>*This coupon code is applicable for a one-time discount only.';
                                                            

                                                            }

                                                            
                                                        }
                                                        var redclass='';
                                                        if (message == "This coupon is valid only for annual plans—choose a 1-year or longer term to grab the offer.") {
                                                            
                                                            redclass='red';
                                                        } else {
                                                         redclass='';
                                                        }
                                                        var htmlstr = '<div class="promocde-applied-left">';
                                                        htmlstr += '<a onclick="removePromocode();" class="delete-icon" title="remove"><i class="remove-icon"></i></a>';
                                                        htmlstr += '<span class="promocode">';
                                                        htmlstr += promo;
                                                        htmlstr += '</span>';
                                                        htmlstr += '<span class="promo-text ' + redclass + '">';
                                                        htmlstr += message;
                                                        htmlstr += '</span>  <span class="removepro"></span>';
                                                        htmlstr += '</div>';
                                                        discount = discount.toString().replace(",","");
                                                        discount = eval(discount);
                                                        //alert(discount);

                                                        if (discount > 0){
                                                            htmlstr += '<div class="subtotal-price ml-auto"> - <span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span>' + discount + '</div>';
                                                        }
                                                        if(message == 'The promotion code entered does not exist'){
                                                            message = 'Invalid promocode.';
                                                            htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                            $("#promobefore").show();
                                                        }
                                                        else {  $("#promobefore").hide(); }
                                                    }    
                                                    $("#promoafter").html(htmlstr).show();
                                                    if (check_promo_validet){
                                                        updatePromoCode('add', promo, discount, message);
                                                        refreshCartAmount(response2);
                                                    }else{
                                                        @if (Request::segment(2)=='ordersummary')
                                                            updatePromoCode('remove'); removePromocode('1');
                                                        @elseif(Request::segment(2)=='signin')
                                                            refreshCartAmount(response2);
                                                        @endif
                                                    }
                                                    if ($('#txtpromo').val()!=''){
                                                        if ($('.original').text()=='0'){
                                                            if (check_promo_validet){
                                                                updatePromoCode('add', promo, discount, message);
                                                                refreshCartAmount(response2);
                                                            }else{
                                                                @if (Request::segment(2)=='ordersummary' || Request::segment(2)=='billinginfo' || Request::segment(2)=='paymentoptions')
                                                                    updatePromoCode('remove'); removePromocode('1');
                                                                @endif
                                                            }
                                                        }
                                                    }
                                                }

                                            });
                                        }
                                        else {
                                            refreshCartAmount(response2);
                                        }
                                        
                                    }
                            });
                    }
            });
    }
    
    setTimeout(function(){ syncwithWHMCSCart(); }, 2000); //load after 3 seconds
    
    function validateFreeDomainName(ele){
            if (ele.value.match(/[^a-zA-Z0-9- ]/g)) {
                    ele.value = ele.value.replace(/[^a-zA-Z0-9- ]/g, '');
                }
        }
    function featchPlansMessage(featchPlansData) {
        $.ajax({
            async:true,
            beforeSend: function(){ /*showLoader2('plansAlertMessage');*/ },
            url:"{{url('cart/featchplansmessage')}}",
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            data:featchPlansData,
            type:"get",
            success:function(response){
                $('#plansAlertMessage').html(response);
            }
        });
    }
</script>