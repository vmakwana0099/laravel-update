@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
@include('cart.cartscripts')

<div class="checkout_step">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-9 left">
                <div class="plan_step_div">
                    <div class="step_div" data-aos="fade-up" id="step_1">
                       <div class="heading first" title="Select a Plan ({{$productData['planname']}})" onclick="window.location='{{url('cart')}}';">
                           <i id="icon_step_1" class="fa fa-check-circle"></i>
                           Select a Plan ({{$productData['planname']}})
                           {{--<i class="fa fa-pencil" aria-hidden="true"></i>--}}
                       </div>
                    </div>
                    @if(isset($productData['producttype']) && ($productData['producttype'] != 'hosting' && $productData['producttype'] != 'email'  && $productData['producttype'] != 'ssl'))
                    <div class="step_div active" data-aos="fade-up" id="step_2">
                       <div class="heading in" title="Select a Plan ({{$productData['planname']}})" id="edit_btn_2">
                           <i id="icon_step_2" class="number">2</i>
                           Select your Operating System and Hardware Upgrades
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                       </div>
                       <div class="toggle_div clearfix">@include('cart.configurableoptions')</div>
                    </div>
                    <div class="step_div" data-aos="fade-up" id="step_3">
                       <div class="heading in" title="Select a Plan ({{$productData['planname']}})" id="edit_btn_3">
                           <i id="icon_step_3" class="number">3</i>
                           Select Additional Software and Services
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                       </div>
                       <div class="toggle_div clearfix" style="display:none"> @include('cart.customfields')</div>
                    </div>
                    <div class="step_div" id="step_4" onclick="$('#step_4').show();">
                        <div class="toggle_div clearfix">
                          <div class="last-step-checkout" style="display:none;" id="submitbtn">
                            <span class="checkout-text">Please click on Checkout to complete this order</span>
                            <button class="btn" onclick="window.location.href='/cart';">Checkout</button>
                          </div>
                        </div>
                    </div>
                    @else
                    <div class="step_div" id="step_4" onclick="$('#step_4').show();">
                        <div class="heading in" title="Select a Plan ({{$productData['planname']}})" id="edit_btn_4">
                            <i id="icon_step_4" class="number">2</i>
                            Select a Domain
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </div>
                        <div class="toggle_div clearfix">
                            <div class="select_domain_div">
                                <div class="form-group">
                                    <label class="title">I have an existing domain name</label>
                                    <div class="input-group">
                                        <input maxlength="60" class="form-control" id="ihavedomain" name="ihavedomain" value="">
                                        <button class="btn" id="ihavedomainbtn" title="Use This">Use This</button>
                                    </div>
                                </div>
                                <span class="or">OR</span>
                                <div class="form-group">
                                    <label class="title">I want to register a new domain name</label>
                                    <div class="input-group">
                                        <input maxlength="60" class="form-control combo_input" id="bookdomaintxt" name="bookdomaintxt" value="">
                                        <div class="domain_combo">
                                            <select class="selectpicker" id="selTld" name="selTld">
                                                @foreach($tlds as $tld)
                                                <option value="{{$tld}}">{{$tld}}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                        <button class="btn" title="Use This" id="searchdomainbtn" name="searchdomainbtn">Search</button>
                                    </div>
                                    <div class="last-step-checkout" style="display:none;" id="domainavailmsg">
                                        <span class="checkout-text">Please click on Checkout to complete this order</span>
                                        <button class="btn" id="addconfigdomainbtn">Use this</button>
                                      </div>
                                </div>
                                <?php 
                                  foreach($cartDataSitelock as $keysuitelock => $cartItems)
                                  {    
                                                    if(isset($cartItems['addonproducts']))
                                                    { 
                                                      foreach($cartItems['addonproducts'] as $addonkey => $items)
                                                      {     
                                                        if(isset($items['groupname']))
                                                           {
                                        if ( $_REQUEST['id'] == $keysuitelock)
                                        {
                                                            ?>             
                                                                        <div class="protect-box @if(isset($items['added'])) active  @endif">
                                                                        <div class="protect-icon">
                                                                        <i class="pro-i sprite-image"></i>
                                                                        </div>
                                                                        <div class="protect-text">
                                                                        <label class="custom-radio">
                                                                        <input onclick="addAddonsServer('{{$items['type']}}','{{$items['pid']}}','{{$items['duration']}}','{{$items['groupname']}}','{{$items['productname']}}',this,'{{$keysuitelock}}','{{$addonkey}}','Y','{{$_REQUEST['id']}}');" type="checkbox" @if(isset($items['added'])) checked  @endif id="addonproducts_{{$keysuitelock}}_{{$addonkey}}" name="addonproducts_{{$keysuitelock}}_{{$addonkey}}"/>
                                                                        <span class="checkmark"></span>
                                                                        {!! $items['desc'] !!}
                                                                        </label>
                                                                        </div>
                                                                        </div>
                                                            <?php 
                                                            }
                                      }
                                                      }
                                                    }
                                  }
                               ?>
                            </div>
                          <div class="last-step-checkout" style="display:none;" id="submitbtn">
                            <span class="checkout-text">Please click on Checkout to complete this order</span>
                            <button class="btn" onclick="window.location.href='/cart';">Checkout</button>
                          </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-stretch right" data-aos="fade-up">
                <div class="plan_step_right d-flex flex-column">
                    @if(!empty($productData['specifications']))
                    <div class="addon_div">
                        @if($productData['producttype'] == 'dedicatedserver')
                        <h3>YOUR BASE SERVER CONFIG</h3>
                        <ul class="addon_list">
                            @foreach($productData['specifications'] as $key1=> $specs)
                            <li><strong>@if($key1 == 0)Processor:
                              @elseif ($key1 == 1)RAM:
                              @elseif ($key1 == 2)HDD: 
                              @elseif ($key1 == 3)B/W:
                              @elseif ($key1 == 4)CPU:
                              @elseif ($key1 == 5)Core:
                              @elseif ($key1 == 6)Thread:
                              @elseif ($key1 == 7)Cache:
                              @elseif ($key1 == 8)IP:
                              @elseif ($key1 == 9)OS:
                              @endif</strong>{{$specs}}</li>
                            @endforeach    
                        </ul>
                        @elseif($productData['producttype'] == 'hosting')
                        <h3>YOUR BASE SERVER CONFIG</h3>
                        <ul class="addon_list">
                            @foreach($productData['specifications'] as $key1=> $specs)
                            <li>{{$specs}}</li>
                            @endforeach    
                        </ul>
                        @elseif($productData['producttype'] == 'email')
                        <h3>YOUR BASE SERVER CONFIG</h3>
                        <ul class="addon_list">
                            @foreach($productData['specifications'] as $key1=> $specs)
                            <li>{{$specs}}</li>
                            @endforeach    
                        </ul>
                         @elseif($productData['producttype'] == 'ssl')
                        <h3>YOUR BASE SERVER CONFIG</h3>
                        <ul class="addon_list">
                            @foreach($productData['specifications'] as $key1=> $specs)
                            <li>{{$specs}}</li>
                            @endforeach    
                        </ul>
                        @else
                        {{--<ul class="addon_list">
                            @foreach($productData['specifications'] as $key2 => $specs)
                            <li><strong>@if($key2 == 0)RAM:
                                @elseif ($key2 == 1)CPU:
                                @elseif ($key2 == 2)HDD: 
                                @elseif ($key2 == 3)IP:
                                @elseif ($key2 == 4)B/W:
                                @elseif ($key2 == 5)Speed:
                                @endif</strong>{{$specs}}</li>
                            @endforeach    
                        </ul>--}}
                        @endif
                        {{--<span class="location">
                            <strong>Location:</strong>
                            <i class="map-icon india"></i>
                        </span>--}}
                    </div>
                    @endif
          <div class="addon_div" style="display:none">
            <h3>H/W ADDONS AND OS</h3>
            <ul class="addon_list" id="config_fields_list"></ul>
          </div>
                    <div class="software_service" style="display:none">
                        <h3>SOFTWARE AND SERVICES</h3>
            <ul class="service_list" id="custom_fields_list"></ul>
                    </div>
                    <div class="total_price" id="finalPrice">
                        <strong>Total:</strong>
                        <i class="rp_icon">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{$productData['finalprice']}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setConfigurationFieldValue(proid,fieldid,val){
      if(fieldid == 193){ 
        if(val == 802) { $("#configfield_238").parent().parent().parent().find(".name,.select_box").show(); }
        else { $("#configfield_238").parent().parent().parent().find(".name,.select_box").hide();  }
      }


      $('#configfields_{{$key}}').valid();
      //alert(proid  + " " + fieldid + " " + val); 
      if(val && val != ""){
      var formData = {"_token":"{{ csrf_token() }}","productid":proid,"fieldid":fieldid,"optionid":val }
      /*showLoader();*/
      $.ajax({
            async:false,
            beforeSend: function () { /*showLoader();*/ },
            url:"{{url('cart/setconfigoptionvalue')}}",
            data:formData,
            type:"post",
            success:function(response){
                $("#finalPrice").html('<strong>Total:</strong><i class="rp_icon">{!! Config::get('Constant.sys_currency_symbol') !!}</i>' + response);
                hideLoader();
            }
        });
      }
    }
    function getconfigfinalprice(proid){
      var formData = {"_token":"{{ csrf_token() }}","productid":proid}    
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/getconfigfinalprice')}}",
            data:formData,
            type:"post",
            success:function(response){
                $("#finalPrice").html('<strong>Total:</strong><i class="rp_icon">{!! Config::get('Constant.sys_currency_symbol') !!}</i>' + response);
                hideLoader();
            }
        });
    }
    
     function setCustomFieldValue(proid,fieldid,val){
      //alert(proid  + " " + fieldid + " " + val); 
      var formData = {"_token":"{{ csrf_token() }}","productid":proid,"fieldid":fieldid,"val":val }
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/setcustomoptionvalue')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
            }
        });
    }
    
    $("#edit_btn_2").click(function(){

      $("#step_2 .toggle_div").show(); $("#step_2").addClass('active');
      $("#step_1 .toggle_div").hide();
      $("#step_3 .toggle_div").hide();
      $("#step_4 .toggle_div").hide();
      $("#icon_step_2").removeClass('fa fa-check-circle').addClass('number').html('2');
      
    });

    $("#edit_btn_3").click(function(){
      $("#step_3 .toggle_div").show(); $("#step_3").addClass('active');
      $("#step_1 .toggle_div").hide();
      $("#step_2 .toggle_div").hide();
      $("#step_4 .toggle_div").hide();
      $("#icon_step_3").removeClass('fa fa-check-circle').addClass('number').html('3');
    });
    
     $("#edit_btn_4").click(function(){
      $("#step_4 .toggle_div, #step_4 .select_domain_div").show(); $("#step_4").addClass('active');
      $("#step_1 .toggle_div").hide();
      $("#step_2 .toggle_div").hide();
      $("#step_3 .toggle_div").hide();
      $("#icon_step_4").removeClass('fa fa-check-circle').addClass('number').html('2');
      $("#submitbtn").hide();
    });

    /*$("#edit_btn_3").click(function(){
      $("#step_3 .toggle_div").show();
    });
    $("#edit_btn_4").click(function(){
      $("#step_4 .toggle_div").show();
    });*/
    
    $("#next_btn_2").click(function(){
      if(!$('#configfields_{{$key}}').valid()){ return false; }
      $("#step_2 .toggle_div").hide();
      $("#step_3 .toggle_div").show();
      $("#config_fields_list").html('');
      $(".configele").each(function(i,ele){
          var label = $(ele).parent().parent().parent().find('label').text();
          var val =  $("#"+ $(ele).attr("id") + " option:selected").html();
          if(typeof val != 'undefined')
          { $("#config_fields_list").append("<li><strong>" + label + "</strong>" + val + "</li>").parent().show(); }
      });
      $("#icon_step_2").addClass('fa fa-check-circle').removeClass('number').html('');
      $("#step_2").removeClass('active'); $("#step_3").addClass('active');
      $("#customfield_359, #customfield_358, #customfield_353, #customfield_356, #customfield_357").change();
    });
    $("#next_btn_3").click(function(){
      showLoader();
      if($("#customfield_hostname"))
      { setCustomFieldValue('{{$key}}','customfield_hostname',$("#customfield_hostname").val()); }
      showLoader();
      
      if(!$('#customfields_{{$key}}').valid()){ return false; }
      $("#step_3").removeClass('active'); $("#step_4").addClass('active');
      $("#step_3 .toggle_div").hide();
      $("#step_4 .toggle_div").show();
      $(".last-step-checkout").show();
      $("#custom_fields_list").html('');
      $(".customele").each(function(i,ele){
          //alert($(ele).attr('type'));
          if(typeof $(ele).attr('type') != 'undefined' && $(ele).attr('type') == 'checkbox' && $(ele).attr('checked'))
          { 
            var label = $(ele).parent().parent().parent().find('label').text(); 
            var val =  '';
          }
        else 
          { 
            var label = $(ele).parent().parent().find('label').text(); 
            if(label == ''){ label = $(ele).parent().parent().parent().find('label').text(); }
            var val =  $("#"+ $(ele).attr("id")).val();
          }        
          
          //var val =  $("#"+ $(ele).attr("id") + " option:selected").html();
          
          if(typeof val != 'undefined')
          { $("#custom_fields_list").append("<li><strong>" + label + "</strong>" + val + "</li>").parent().show(); }
        });
      $("#icon_step_3").addClass('fa fa-check-circle').removeClass('number').html('');

      });
    $("#ihavedomainbtn").click(function(){
      var dname = $("#ihavedomain").val();
      if(dname == ''){
        alert("Please enter your domain name.");
        return false;
      }
      console.log('Domain Key:' + '{{$key}}');
      var formData = {"_token":"{{ csrf_token() }}","productid":'{{$key}}',"domainname":$("#ihavedomain").val()}
      
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/configdomain')}}",
            data:formData,
            type:"post",
            success:function(response){
                $("#step_4 .select_domain_div").hide(); 
                $("#submitbtn").show();
                $("#icon_step_4").addClass('fa fa-check-circle').removeClass('number').html('');
                hideLoader();
            }
        });
    });
    var domaindata = null;
    $("#searchdomainbtn").click(function(){
      var dname = $("#bookdomaintxt").val();
      if(dname == ''){
        alert("Please enter your domain name.");
        return false;
      }
        var formData = {"_token":"{{ csrf_token() }}","bookdomaintxt":$("#bookdomaintxt").val(),"selTld":$("#selTld").val()}
      $.ajax({
            async:true,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/checkconfigdomainname')}}",
            data:formData,
            type:"post",
            success:function(response){
                 hideLoader();
                if(response.status == 'available'){
                  domaindata = response;
                  $("#domainavailmsg").show().find('.checkout-text').html(response.msg).css({"color":"green"});
                  $("#addconfigdomainbtn").show();
                }
                else{
                  domaindata = response;
                  $("#domainavailmsg").show().find('.checkout-text').html(response.msg).css({"color":"red"});;
                  $("#addconfigdomainbtn").hide();
                }
                
            }
        });
    });
    $("#addconfigdomainbtn").click(function(){
      var formData = {"_token":"{{ csrf_token() }}","producttype":domaindata.producttype,"domain":domaindata.domain,"tld":domaindata.tld,"domaintype":domaindata.domaintype,"regperiod":domaindata.regperiod}
       showLoader();
      $.ajax({
            url:"{{url('cart/store')}}",
            data:formData,
            type:"post",
            async:false,
            success:function(response){
              hideLoader();
                //$("#step_4 .toggle_div").hide(); 
                var formData = {"_token":"{{ csrf_token() }}","productid":'{{$key}}',"domainname":domaindata.domain[0]}
                $.ajax({
                      url:"{{url('cart/configdomain')}}",
                      data:formData,
                      type:"post",
                      success:function(response){
                          $("#step_4 .select_domain_div").hide(); 
                          $("#submitbtn").show();
                          hideLoader();
                      }
                  });
            }
        });
    });

   $('#bookdomaintxt').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9-\b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });
    $('#ihavedomain').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9-.\b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });
    $(function(){
       $("#config_fields_list").html('');
      $(".configele").each(function(i,ele){
          var label = $(ele).parent().parent().parent().find('label').text();
          var val =  $("#"+ $(ele).attr("id") + " option:selected").html();
          if(typeof val != 'undefined')
          { $("#config_fields_list").append("<li><strong>" + label + "</strong>" + val + "</li>").parent().show(); }
      });
    });
   
</script>

@endsection