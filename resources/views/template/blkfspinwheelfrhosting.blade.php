{{-- spin-wheel start --}}
@if ( (Request::segment(1) == 'web-hosting') || (Request::segment(1) == 'servers') || (Request::segment(1) == 'deals') || (Request::segment(1) == '') || (Request::segment(1) == 'hosting') && (Request::segment(2) == 'linux-hosting' || Request::segment(2) == 'windows-hosting' || Request::segment(2) == 'wordpress-hosting' || Request::segment(2) == 'java-hosting' || Request::segment(2) == 'ecommerce-hosting' || empty(Request::segment(2))) )
@if (Request::cookie('spin-wheel-popup-frhosting') != 'Y' || (Request::segment(1) == 'deals'))
<div class="modal fade spin-wheel" id="spin-wheel" role="dialog" style="display:none;">
  <div class="modal-dialog modal-dialog-centered spin-wheel-dialog">
      <div class="modal-content spin-wheel-content">
          <!-- <div class="modal-header">
              <button type="button" class="close close-popup" data-dismiss="modal"></button>
          </div> -->
          <div class="modal-body spin-wheel-body">
            <div class="row align-items-center justify-content-center w-100">
                <div class="col-xl-6 col-md-12">
                    <div class="spin-wheel-main-one">
                        <div id="chart"></div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12" id="confettirightDiv">
                    <div class="spin-wheel-main-two" id="main">
                        <form action="#" id="frmspinwheel" name="frmspinwheel">
                        <div class="swm-header">
                            <p>BLACK FRIDAY</p>
                        </div>
                        <div class="swm-titl">
                            <p class="chngclr">WEB HOSTING SALE</p>
                        </div>
                        <div class="swm-desc">
                            <p>EXCITING DEALS! JUST A SPIN AWAY</p>
                        </div>
                        <div class="swm-list">
                            <p>Just Spin It!</p>
                            <ul>
                                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i> Click on “SPIN THE WHEEL” to set the wheel in motion.</li>
                                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i> The coupon claimed will be valid for 30 minutes only.</li>
                                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i> The same Email must be used while ordering.</li>
                                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i> The offer is valid only on <strong>Shared & VPS Hosting.</strong></li>
                                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i> Email & Mobile Number used once can’t be used again.</li>
                            </ul>
                        </div>
                        <div class="swm-form">
                            
                            <div id="frmspinwheel-div">
                                <div class="form-group">
                                    {{-- <input id="spin-wheel-type" type="hidden" name="spin-wheel-type" value="S"> --}}
                                    <input id="spin-wheel-name" type="text" class="form-control" name="spin-wheel-name" maxlength="100" aria-describedby="namelHelp" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <input id="spin-wheel-email" type="email" class="form-control" name="spin-wheel-email" maxlength="256" aria-describedby="emailHelp" placeholder="Enter your email">
                                </div>
                                <div class="form-group">
                                    <input id="spin-wheel-number" type="number" min="0" minlength="10" maxlength="10" class="form-control" name="spin-wheel-number" aria-describedby="numberHelp" placeholder="Enter your contact number">
                                </div>
                                {{-- <button id="tryorluck" type="button" onclick='$("#frmspinwheel").valid();' class="btn btn-dark">Get OTP</button> --}}
                            </div>
                            <div class="row otp-class" id="otp-class" style="display: none;">
                                <input type="hidden" name="is-verified-otp" id="is-verified-otp" value="false">
                                <div class="form-group col-md-8 verified-otp-div">
                                    <input id="verified-otp" name="verified-otp" type="number" min="0" minlength="4" maxlength="6" class="form-control"  placeholder="Enter your OTP.">
                                    <label id="verified-otp-msg">We have send OTP on your number.</label>
                                    {{--<span class="error" style="display:none;" id="otplblerror">OTP not verfied!! Please enter valid OTP.</span>--}}
                                </div>
                                <div class="form-group col-md-4 verified-otp-div">
                                    {{-- <button class="btn-verified-otp" type="button" id="btn-verified-otp" onclick="verificationOTP();">Verify OTP</button>
                                    <br> --}}
                                    <button class="btn-resend-otp" type="button" id="btn-resend-otp" onclick="resendOTP();">not received OTP!</button>

                                </div>
                            </div>
                                <button class="btn btn-dark" type="button" id="btn-verified-otp" onclick="verificationOTP();" style="display: none;">Verify OTP</button>
                                <button id="tryorluck" type="submit" class="btn btn-dark">SPIN THE WHEEL</button>
                        </div>
                        </form>

                        <div class="swm-close">
                            <button type="button" class="close close-popup" id="close-spin-wheel-model" data-dismiss="modal">No, I don’t want to Spin. <i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>

                    </div>
                    <div class="spin-wheel-main-two win" id="selectedDiscount" style="display: none;">
                        <div class="swm-header">
                            <p><span class="chngclr">Woo-hoo</span> You Just WON a <br><span id="ugetpromoHit"></span> <br>on Web Hosting</p>
                        </div>
                        <div class="swm-code">
                            <div class="box-main">
                                <div class="code-three" id="ugetpromoDiv" onclick="copyToClipboard('ugetpromo',$('ugetpromo').text());setTooltip('ugetpromoDiv');hideTooltip('ugetpromoDiv');" data-toggle="tooltip" title="Copy to clipboard" data-placement="top">
                                    <p id="ugetpromo">HOSTITSMART-20</p><i class="fa fa-clone" aria-hidden="true"></i>
                                </div>
                                <div class="swm-continue">
                                    <button type="button" onclick="copyToClipboard('ugetpromo',$('ugetpromo').val());update_spinwheeldata(2);">CONTINUE</button>
                                </div>
                            </div>
                        </div>
                        <div class="swm-desc term-cond">
                            <p>*This offer is applicable on Minimum Purchase of <span style="color: #ffffff;" id="blkf-promo-years-content">1, 2 OR 3 Years</span> Plans only.</p>
                        </div>
                        {{-- <div class="swm-links">
                            <a href="{{URL::to('/privacy-policy')}}" target="_blank" >*Terms & Condition</a>&nbsp;<a target="_blank"  href="http://blog.hostitsmart.com/how-to-claim-a-discount-on-web-hosting-through-spinwheel-at-host-it-smart/">*How To Claim</a>
                        </div> --}}
                    </div>

                </div>
            </div>

            <div class="bottom-links">
                <div class="swm-links">
                    <a href="{{URL::to('/privacy-policy')}}" target="_blank" >*Terms & Condition Apply</a>
                </div>
            </div>

          </div>
      </div>
  </div>
</div>
<script src="{{URL::to('/assets/spin-wheel/js/confetti.js')}}"></script>
<script src="{{URL::to('/assets/spin-wheel/js/spin-wheel.js')}}"></script>
<link rel="stylesheet" href="{{URL::to('/assets/spin-wheel/css/spin-wheel.css?v='.date('YmdHi'))}}">
<script> $(function(){ setTimeout(function(){ $('#spin-wheel').fadeIn(200).modal('show'); },6000); }) </script>
<script>
    $(function(){
        $('#close-spin-wheel-model').click(function(){
            var responseData2 = $.ajax({ type: "GET", datatype: "html", data: {"cookiename":"spin-wheel-popup-frhosting"}, url: "{{url('cart/spinWheelGetCookie')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, async: false }).responseText;
            // console.log(responseData2);
        });
    })
    function updateajaxpromocode(formdata) {
        // alert(postdata);
        var res = $.ajax({ type: "POST", datatype: "html", data: formdata, url: "{{url('cart/spinWheelPostData')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, async: false }).responseText;
        // console.log(res);
        if (res=="success") {
            $('#close-spin-wheel-model').click();
            $(location).attr('href', '{{URL::to('/web-hosting')}}');
        }
    }
</script>
<script>
// spin wheel js start
    var verificationid='';var $sendonceOTP=1;
    $(function(){
        $("#frmspinwheel").validate({
            errorClass: "error",
            errorElement: "span",
            rules: {
              "spin-wheel-email": { 
                  required: true,
                  maxlength: 255,
                  remote: {
                    url: "{{url('cart/bfSpinWheelIsEmailExists')}}",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: "POST",
                    /*data: {
                        type: function(){
                          return "S";
                        },
                    },*/
                  },
              },
              "verified-otp": {
                required: true
              },
              "spin-wheel-name": { required: true },
              "spin-wheel-number": { required: true,
                remote: {
                    url: "{{url('cart/bfSpinWheelIsPhoneExists')}}",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: "POST",
                    /*data: {
                        type: function(){
                          return "S";
                        },
                    },*/
                  },
              },
              
            },
            messages: {
              "spin-wheel-email": { required: "Please enter email.", remote: "Your email already exists! Please try another email."},
              "spin-wheel-name": { required: "Please enter name."},
              "spin-wheel-number": { required: "Please enter contact number.", remote: "Your contactno already exists! Please try another contact number."},
              "verified-otp": { required: "Please Verify your OTP.&nbsp;" }
            },
            submitHandler: function (form) {
                $('#frmspinwheel-div').hide();$('#otp-class').show();
                if ($sendonceOTP==1) {
                    $.ajax({ 
                        type: "get",
                        data: { phoneno: $('#spin-wheel-number').val() },
                        url: "{{url('cart/spinwheel_sendopt')}}", 
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, 
                        async: false,
                        success:function(res){
                            var obj = jQuery.parseJSON(res);
                            // console.log(obj);
                            if (obj.status == "success") {
                                $('#tryorluck').hide();$('#btn-verified-otp').show();
                                $('#tryorluck').prop("disabled",true);
                                $sendonceOTP=0;
                                $('#is-verified-otp').val(obj.id);
                            }else{console.log("error in send otp."); }
                        }
                    });
                }
                if (verificationid && verificationid.length>0) {
                    spin(this);   
                }else{ console.log("error in validation."+verificationid+" "+verificationid.length); }
            },
        });
    });

    function resendOTP(){
      $sendonceOTP=1;$('#tryorluck').prop("disabled",false);$('#btn-verified-otp').hide();$('#tryorluck').show();
      $('#frmspinwheel-div').show();$('#otp-class').hide();$('#tryorluck').html("SPIN THE WHEEL");
    }

    function verificationOTP() {
        if($('#verified-otp').val() != ""){
        $.ajax({ 
            type: "get",
            data: { id: $('#is-verified-otp').val(), otp: $('#verified-otp').val() },
            url: "{{url('cart/spinwheel_verifyopt')}}", 
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, 
            async: false,
            success:function(res){
                var obj = jQuery.parseJSON(res);
                // console.log(obj);
                if (obj.status == "success") {
                    $('#tryorluck').prop("disabled",false);
                    verificationid=$('#is-verified-otp').val();
                    $('#btn-verified-otp').text("OTP Verified").prop("disabled",true);
                    //$("#otplblerror").hide();
                    $("#verified-otp-msg").html('OTP Verified!');
                    $('#tryorluck').click();
                }else{
                    console.log("error in otp verification."); 
                    $('#verified-otp-msg').text('Incorrect OTP.');
                    //$("#otplblerror").show().html("OTP not verfied!! Please enter valid OTP.");
                }
            }
            });
        }
        else { /*$("#otplblerror").show().html("Please enter your OTP.");*/ }
    }
    var spinStatus=true;
    
    var $i=0;
    var padding = {top:20, right:40, bottom:0, left:0};
    @if ($uagent == "mobile")
        var w = 500 - padding.left - padding.right;
        var h = 500 - padding.top  - padding.bottom;
    @else
        if( $(window).width() <= 1370 ){
            var w = 500 - padding.left - padding.right;
            var h = 500 - padding.top  - padding.bottom;
        }else{
            var w = 600 - padding.left - padding.right;
            var h = 600 - padding.top  - padding.bottom;
        }
    @endif
    r = Math.min(w, h)/2,
    rotation = 0,
    oldrotation = 0,
    picked = 100000,
    oldpick = [],
    //color = d3.scale.category20();//category20c()
    color = function (idx) {
        colorsCode = ["#ff0000","#000000","#ff0000","#000000","#ff0000","#000000","#ff0000","#000000","#ff0000","#000000","#ff0000","#000000"]
                return colorsCode[idx]; };
        var data = [
            {"label":"30% Discount", "promocode":"BFSALE30", "displaycontent":"30% Discount Coupon",  "value":1}, //nesting
            {"label":"FLAT300", "promocode":"BFLAT300", "displaycontent":"FLAT ₹300 BACK", "value":2}, //bottom
            {"label":"3 Years + 3 Months", "promocode":"BFEXTRA3M", "displaycontent":"3 EXTRA MONTH FREE", "value":3}, //sans-serif

            {"label":"20% Discount", "promocode":"BFSALE20", "displaycontent":"20% Discount Coupon", "value":4}, //font-weight
            {"label":"FLAT200", "promocode":"BFLAT200", "displaycontent":"FLAT ₹200 BACK", "value":5}, //font-size
            {"label":"2 Years + 2 Months", "promocode":"BFEXTRA2M", "displaycontent":"2 EXTRA MONTH FREE", "value":6}, //background-color

            {"label":"10% Discount", "promocode":"BFSALE10", "displaycontent":"10% Discount Coupon", "value":7}, // padding
            {"label":"FLAT150", "promocode":"BFLAT150", "displaycontent":"FLAT ₹150 BACK", "value":8}, //font-family
            {"label":"1 Year + 1 Month", "promocode":"BFEXTRA1M", "displaycontent":"1 EXTRA MONTH FREE", "value":9}, //color
            {"label":"50% Discount", "promocode":"BFSALE50", "displaycontent":"50% Discount Coupon", "value":10}, //bottom
        ];
        var svg = d3.select('#chart')
            .append("svg")
            .data([data])
            .attr("width",  w + padding.left + padding.right)
            .attr("height", h + padding.top + padding.bottom);
        var container = svg.append("g")
            .attr("class", "chartholder spin-wheel-spin-btn")
            .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");
        var vis = container
            .append("g");
            
        var pie = d3.layout.pie().sort(null).value(function(d){return 1;});
        // declare an arc generator function
        var arc = d3.svg.arc().outerRadius(r);
        // select paths, use arc generator to draw
        var arcs = vis.selectAll("g.slice")
            .data(pie)
            .enter()
            .append("g")
            .attr("class", "slice");
            
        arcs.append("path")
            .attr("fill", function(d, i){ return color(i); })
            .attr("d", function (d) { return arc(d); }).attr('stroke', 'white').attr('stroke-width', 6);
        // add the text

        if( $(window).width() <= 1370 ){
            arcs.append("text").attr("transform", function(d){
                    d.innerRadius = 0;
                    d.outerRadius = r;
                    d.angle = (d.startAngle + d.endAngle)/2;
                    return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
                })
                .attr("text-anchor", "end")
                .style({"font-size":"18px", "fill":"#ffffff", "color":"#ffffff"})
                .text( function(d, i) {
                    return data[i].label;
                });
        }else{
            arcs.append("text").attr("transform", function(d){
                    d.innerRadius = 0;
                    d.outerRadius = r;
                    d.angle = (d.startAngle + d.endAngle)/2;
                    return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
                })
                .attr("text-anchor", "end")
                .style({"font-size":"21px", "fill":"#ffffff", "color":"#ffffff"})
                .text( function(d, i) {
                    return data[i].label;
                });
        }
            
        //$('#tryorluck').on("click", spin); 
        function spin(d){
            //$('#tryorluck').on("click", null);
            //all slices have been seen, all done
            // console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
            var  ps       = 360/data.length,
                 pieslice = Math.round(1440/data.length),
                 rng      = Math.floor((Math.random() * 1440) + 360);
            rotation = (Math.round(rng / ps) * ps);
            picked = Math.round(data.length - (rotation % 360)/ps);
            picked = picked >= data.length ? (picked % data.length) : picked;
            // while (picked==0||picked==1||picked==2||picked==9||picked==10){
            // while (picked==3||picked==4||picked==5||picked==6||picked==7||picked==8||picked==9||picked==10){
            while (picked==9){
                rng      = Math.floor((Math.random() * 1440) + 360);
                rotation = (Math.round(rng / ps) * ps);
                // console.log("rotation "+rotation);
                picked = Math.round(data.length - (rotation % 360)/ps);
                // console.log("Fpicked "+picked);
                picked = picked >= data.length ? (picked % data.length) : picked;
            }
            if (data[picked].value !== 10) {
                if (oldpick.length>0) {
                    oldpick.length = data.length;
                }
            }
            if (data[picked].value === 10) {$i=1;}
            if ($i==0) {
                if (data[picked].value !== 10) {
                    if(oldpick.length == data.length){
                        console.log("done");
                        $('#tryorluck').on("click", null);
                        return;
                    }
                }
            }

            if(oldpick.indexOf(picked) !== -1){
                d3.select(this).call(spin);
                return;
            } else {
                oldpick.push(picked);
            }
            rotation += 90 - Math.round(ps/2);
            vis.transition()
                .duration(6000)
                .attrTween("transform", rotTween)
                .each("end", function(){
                    //mark question as seen
                    d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                        .attr("fill", "#000080").style({"fill":"#ffffff","color":"#ffffff"});
                    //populate question
                    d3.select(".slice:nth-child(" + (picked + 1) + ") text").style({"fill":"#000","color":"#ffffff"});
                    d3.select("#question h1").text(data[picked].question);
                    oldrotation = rotation;
              
                    /* Get the result value from object "data" */
                    // console.log("print_val "+data[picked].value); 
                    var formdata = $("#frmspinwheel").serialize() + "&promo=" + data[picked].promocode;
                    var responseData = $.ajax({ type: "POST", datatype: "html", data: formdata, url: "{{url('cart/bfSpinWheelPostData')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, async: false }).responseText;
                    /*alert("responseData => "+responseData);*/
                    if (responseData == "success") {
                        if(data[picked].value=='3'){ /* 3 Years */
                            $('#blkf-promo-years-content').text("3 Years");
                        }else if(data[picked].value=='6'){ /* 2 Years */
                            $('#blkf-promo-years-content').text("2 Years");
                        }else if(data[picked].value=='9'){ /* 1 Year */
                            $('#blkf-promo-years-content').text("1 Year");
                        }
                        $('#ugetpromo').text(data[picked].promocode);
                        $('#ugetpromoHit').text(data[picked].displaycontent);
                        $('#main').hide();$('#selectedDiscount').show();
                        var responseData2 = $.ajax({ type: "GET", datatype: "html", data: {"cookiename":"spin-wheel-popup-frhosting"}, url: "{{url('cart/spinWheelGetCookie')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, async: false }).responseText;

                        confetti();
                        setTimeout(() => { confetti(); }, 500);
                        setTimeout(() => { confetti(); }, 1200);
                    }
                    // console.log(responseData);
                    if (data[picked].value !== 10) { $('.spin-wheel-main-one').css("opacity", '0.2'); $i=0; }         
                    /* Comment the below line for restrict spin to sngle time */
                    //$('#tryorluck').on("click", spin);
                });
        }
        
        
        //make arrow
        svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
            .style({"fill":"#ff0000"});
        //draw spin circle
        container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 50)
            .style({"fill":"#ffffff","cursor":"pointer",});
        //spin text
        container.append("text")
            .attr("x", 0)
            .attr("y", 0)
            .attr("text-anchor", "middle")
            .attr('id','verticletxt')
            .text("SPIN")
            .style({"font-weight":"bold", "font-size":"18px","fill":"#000000"});
        
        
        function rotTween(to) {
          var i = d3.interpolate(oldrotation % 360, rotation);
          return function(t) {
            return "rotate(" + i(t) + ")";
          };
        }
        
        
        function getRandomNumbers(){
            var array = new Uint16Array(1000);
            var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);
            if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){
                window.crypto.getRandomValues(array);
                // console.log("works");
            } else {
                //no support for crypto, get crappy random numbers
                for(var i=0; i < 1000; i++){
                    array[i] = Math.floor(Math.random() * 100000) + 1;
                }
            }
            return array;
        }
        function update_spinwheeldata(step){
            /*var responseData = $.ajax({ type: "POST", datatype: "html", data:{"intstep":step}, url: "{{url('cart/spinWheelUpdateData')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, async: false }).responseText;*/
            $('#close-spin-wheel-model').click();

            if('{{ Request::segment(1) }}'==''){
                scrollTo('serviceDiv0');
            }else if('{{ Request::segment(1) }}'=='web-hosting'){
                scrollTo('hosting_plans');
            }else if('{{ Request::segment(1) }}'=='hosting' && '{{ Request::segment(2) }}'=='linux-hosting'){
                scrollTo('StarterThreeYearWhmcsINR');
            }else if('{{ Request::segment(1) }}'=='hosting' && '{{ Request::segment(2) }}'=='windows-hosting'){
                scrollTo('StarterThreeYearWhmcsINR');
            }else if('{{ Request::segment(1) }}'=='hosting' && '{{ Request::segment(2) }}'=='wordpress-hosting'){
                scrollTo('StarterThreeYearWhmcsINR');
            }else if('{{ Request::segment(1) }}'=='hosting' && '{{ Request::segment(2) }}'=='java-hosting'){
                scrollTo('StarterThreeYearWhmcsINR');
            }else if('{{ Request::segment(1) }}'=='hosting' && '{{ Request::segment(2) }}'=='ecommerce-hosting'){
                scrollTo('StarterThreeYearWhmcsINR');
            }else if('{{ Request::segment(1) }}'=='servers' && '{{ Request::segment(2) }}'=='vps-hosting'){
                scrollTo('StarterThreeYearWhmcsINR');
            }else if('{{ Request::segment(1) }}'=='deals'){
                $(location).attr('href', "{{URL::to('/#serviceDiv0')}}");
            }
        }
        // spin wheel js end
</script>
@endif
@endif

{{-- spin-wheel end --}}