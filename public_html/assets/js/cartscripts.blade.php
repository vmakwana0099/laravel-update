<script type="text/javascript">
   
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
        if (promo == ''){ alert("Please enter promocode."); return false; }
        $.ajax({
        async:false,
        url:"{{Config::get('hitsupdatecart')}}" + "/hits_applypromo.php?a=applypromo",
        data:{"promocode":promo},
        type:"post",
        success:function(res1){
            alert(res1);
            }
        });
    }
    function applyPromocode(){

    var promo = $("#txtpromo").val();
            if (promo == ''){ alert("Please enter promocode."); return false; }

    var message = "";
            var response1 = null;
            var response2 = null;
            var response3 = null;
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
                                    data:{"poststr":response1,"cur":currstr},
                                    type:"post",
                                    success:function(res2){

                                    response2 = res2;
                                            $.ajax({

                                            async:false,
                                                    url:"{{Config::get('hitsupdatecart')}}" + "/hits_cart.php?a=view",
                                                    data:{"token":"19a7b0aa888e02da3fcebd2ca4a5b822cdb6fc3e", "promocode":promo,"sid":response2},
                                                    type:"post",
                                                    success:function(res3){

                                                    //console.log(res3);

                                                    var div = $('<div>').attr({"id":"divPromocodeHtml"}).html(res3);
                                                            message = $(div).find("#scrollingPanelContainer").prev().find('.alert').text();
                                                            discount = $(div).find("span#discount").text().replace("INR", "").replace("USD", "").replace("$", "").replace(".00", "");
                                                            //alert(discount);

                                                            message = $.trim(message);
                                                            if (message == 'Promotion Code Accepted! Your order total has been updated.'){

                                                    message = 'Promo code applied';
                                                    }

                                                    var htmlstr = '<div class="promocde-applied-left">';
                                                            htmlstr += '<a onclick="removePromocode();" class="delete-icon" title="remove"><i class="remove-icon"></i></a>';
                                                            htmlstr += '<span class="promocode">';
                                                            htmlstr += promo;
                                                            htmlstr += '</span>';
                                                            htmlstr += '<span class="promo-text">';
                                                            htmlstr += message;
                                                            htmlstr += '</span>'

                                                            htmlstr += '</div>';
                                                            if (discount > 0){

                                                    htmlstr += '<div class="subtotal-price ml-auto"> - <span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span>' + discount + '</div>';
                                                    }
                                                    if(message == 'The promotion code entered does not exist'){
                                                        htmlstr = '<span class="promo-text red">' + message + '</span>';
                                                        $("#promobefore").show();
                                                    }
                                                    else {  $("#promobefore").hide(); }
                                                           
                                                            $("#promoafter").html(htmlstr).show();
                                                            refreshCartAmount(response2);
                                                            updatePromoCode('add', promo, discount, message);
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

    $.get("{{Config::get('hitsupdatecart')}}" + "/hits_cart.php?a=removepromo", function(){
                $("#promoafter").html('').hide();
                $("#promobefore").show();
                $("#wrongPriceCart").html('');
                //refreshCartAmount();
                syncwithWHMCSCart();
                updatePromoCode('remove');
        });
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
                            reloadCart();
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
                    hideLoader();
                            reloadCart();
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
                    hideLoader();
                            reloadCart();
                    }

            });
    }



    function removeCartItem(frmkey){

    if (confirm('Are you sure, you want to remove selected item from the cart?')){

    var formData = $("#cart_form_" + frmkey).serialize();
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
                    window.location.href = "{{url('cart')}}";
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

    function addAddonsServer(type, pid, billingcycle, groupname, productname, ele, cartitemkey, addonitemkey){

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

    }

    function addAddonsDomain(type, pid, billingcycle, groupname, productname, ele, cartitemkey, addonitemkey){
    if (type != '' && pid != '' && billingcycle != '' && $(ele).is(":checked")){

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
            $(ele).parent().parent().parent().removeClass('active');
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
            $(ele).parent().parent().parent().removeClass('active');
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

    if (confirm('Are you sure, you want to remove selected item from the cart?')){

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

    { window.location.href = "{{url('cart/empty')}}"; }

    }

    function refreshCartAmount(sid){

    $.ajax({

    async:false,
            beforeSend: function () { /*showLoader();*/ },
            url:"{{Config::get('hitsupdatecart')}}" + "/hits_cart.php?a=getcartjson",
            data:{"token":"19a7b0aa888e02da3fcebd2ca4a5b822cdb6fc3e","sid":sid},
            type:"post",
            success:function(data){

            var subtotal = data.subtotal.toString().replace("INR", "").replace("USD", "").replace("$", "").replace(",", "");
                    var taxtotal1 = data.taxtotal.toString().replace("INR", "").replace("USD", "").replace("$", "").replace(",", "");
                    var taxtotal2 = data.taxtotal2.toString().replace("INR", "").replace("USD", "").replace("$", "").replace(",", "");
                    var rawtotal = data.rawtotal.toString().replace("INR", "").replace("USD", "").replace("$", "");
                    var rawdiscount = data.rawdiscount.toString().replace("INR", "").replace("USD", "").replace("$", "").replace(",", "");
                    $("#cartTotalspan").html('<span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span><span class="original" >' + parseFloat(rawtotal) + '</span>');
                    var taxTotal = parseFloat(taxtotal1) + parseFloat(taxtotal2);
                    $("#taxesSpan").html('<span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span>' + taxTotal);
                    $("#subtotalSpan").html('<span class="rupee">' + '{!! Config::get('Constant.sys_currency_symbol') !!}' + '</span>' + parseFloat(subtotal));
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
                    beforeSend: function () { showLoader(); },
                    url:"{{url('cart/updatepromo')}}",
                    data:formData,
                    type:"post",
                    success:function(response){ hideLoader(); }

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
        console.log('syncwithWHMCSCart');
            var response1 = null;
            var response2 = null;
            var response3 = null;
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
                                    data:{"poststr":response1,"cur":currstr},
                                    type:"post",
                                    success:function(res2){
                                    response2 = res2;
                                            refreshCartAmount(response2);
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
</script>