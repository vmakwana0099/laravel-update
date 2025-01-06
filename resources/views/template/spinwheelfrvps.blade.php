{{-- spin-wheel start --}}
@if ( (Request::segment(1) == 'servers') && (Request::segment(2) == 'vps-hosting' || empty(Request::segment(2))) )

@if (Request::cookie('spin-wheel-popup-frvps') != 'Y')

<div class="modal fade spin-wheel" id="spin-wheel" role="dialog" style="display:none;">
  <div class="modal-dialog modal-dialog-centered spin-wheel-dialog">
      <div class="modal-content spin-wheel-content">
          <!-- <div class="modal-header">
              <button type="button" class="close close-popup" data-dismiss="modal"></button>
          </div> -->
          <div class="modal-body spin-wheel-body">
            <div class="row align-items-center w-100">
                <div class="col-xl-4 col-md-12">
                    <div class="spin-wheel-main-one">
                        <div id="chart"></div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-12">
                    <div class="spin-wheel-main-two" id="main">
                    <form action="#" id="frmspinwheel" name="frmspinwheel">

                        <div class="swm-img">
                            <img alt="Right To Hosting Sale" title="Right To Hosting Sale" src="{{URL::to('/assets/spin-wheel/images/spin-wheel-popup.png')}}">
                        </div>
                        <div class="swm-header">
                            <p>This Republic Month<br><span class="chngclr">Spin & Save!</span></p>
                        </div>
                        <div class="swm-desc">
                            <p>Ready To Get Big Offers On VPS Hosting</p>
                        </div>
                        <div class="swm-list">
                            <ul>
                                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i> Click on “Try Your Luck” to spin the wheel.</li>
                                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i> If you win, Coupon can be claimed for 30 mins only.</li>
                                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i> The same Email must be used while ordering.</li>
                            </ul>
                        </div>
                        <div class="swm-form">
                            
                            <div id="frmspinwheel-div">
                                <div class="form-group">
                                    <input id="spin-wheel-type" type="hidden" name="spin-wheel-type" value="V">
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
                                    <button class="btn-verified-otp" type="button" id="btn-verified-otp" onclick="verificationOTP();">Verify OTP</button>
                                </div>
                            </div>
                                <button id="tryorluck" type="submit" class="btn btn-dark">Get OTP</button>
                        </div>
                        <div class="swm-close">
                            <button type="button" class="close close-popup" id="close-spin-wheel-model" data-dismiss="modal">No, I don't feel lucky <i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                        <div class="swm-links">
                            <a href="{{URL::to('/privacy-policy')}}">*Terms & Condition</a> &nbsp; <a href="http://blog.hostitsmart.com/how-to-claim-a-discount-on-vps-hosting-through-spinwheel-at-host-it-smart/">*How To Claim</a>
                        </div>

                    </form>
                    </div>
                    
                    <div class="spin-wheel-main-two win" id="4CORE" style="display: none;">
                        <div class="swm-header">
                            <p><span class="chngclr">Congratulations!</span> You’ve hit +2 CORE CPU.</p>
                        </div>
                        <div class="swm-code">
                            <div class="box-main">
                                <div class="code-three">
                                    <p>RPD21CPU</p>
                                </div>
                                <div class="swm-continue">
                                    <button type="button" onclick="update_spinwheeldata(3);">CONTINUE</button>
                                </div>
                            </div>
                             <?php /*
                            <div class="swm-desc last">
                                    <p>Looking For a Long term Plan?</p>
                                </div>
                            <div class="code-one" onclick="updateajaxpromocode({'promo': 'RPD21RAM'})">
                                <p>Get + 2GB RAM on 1 Year Package</p>
                                <p class="brdr-das">RPD21RAM</p>
                            </div>
                            <div class="option">Or</div>
                            <div class="code-two" onclick="updateajaxpromocode({'promo': 'RPD21HD'})">
                                <p>Get + 20GB HD on 1 Year Package</p>
                                <p class="brdr-das">RPD21HD</p>
                            </div> */?>
                        </div>
                        <div class="swm-desc term-cond">
                            <p>*This offer is applicable on 1 Years Plans only.</p>
                        </div>
                        <div class="swm-links">
                            <a href="{{URL::to('/privacy-policy')}}" target="_blank">*Terms & condition</a>&nbsp;<a target="_blank" href="http://blog.hostitsmart.com/how-to-claim-a-discount-on-vps-hosting-through-spinwheel-at-host-it-smart/">*How To Claim</a>
                        </div>
                    </div>

                    <div class="spin-wheel-main-two win" id="4GBRAM" style="display: none;">
                        <div class="swm-header">
                            <p><span class="chngclr">Congratulations!</span> You’ve hit +2GB RAM.</p>
                        </div>
                        <div class="swm-code">
                            <div class="box-main">
                                <div class="code-three">
                                    <p>RPD21RAM</p>
                                </div>
                                <div class="swm-continue">
                                    <button type="button" onclick="update_spinwheeldata(3);">CONTINUE</button>
                                </div>
                            </div>
                           <?php /* <div class="swm-desc last">
                                <p>Looking For a Long term Plan?</p>
                            </div>
                            <div class="code-two" onclick="updateajaxpromocode({'promo': 'RPD21HD'})">
                                <p>Get +20GB HD on 1 Year Package</p>
                                <p class="brdr-das">RPD21HD</p>
                            </div> */?>
                        </div>
                        <div class="swm-desc term-cond">
                            <p>*This offer is applicable on 1 Years Plans only.</p>
                        </div>
                        <div class="swm-links">
                            <a href="{{URL::to('/privacy-policy')}}" target="_blank">*Terms & condition</a>&nbsp;<a target="_blank" href="http://blog.hostitsmart.com/how-to-claim-a-discount-on-vps-hosting-through-spinwheel-at-host-it-smart/">*How To Claim</a>
                        </div>
                    </div>

                    <div class="spin-wheel-main-two win" id="4GBHDD" style="display: none;">
                        <div class="swm-header">
                            <p><span class="chngclr">Congratulations!</span> You’ve hit +20GB HDD.</p>
                        </div>
                        <div class="swm-code">
                            <div class="box-main">
                                <div class="code-three">
                                    <p>RPD21HD</p>
                                </div>
                                <div class="swm-continue">
                                    <button type="button" onclick="update_spinwheeldata(3);">CONTINUE</button>
                                </div>
                            </div>
                        </div>
                        <div class="swm-desc term-cond">
                            <p>*This offer is applicable on 1 Years Plans only.</p>
                        </div>
                        <div class="swm-links">
                            <a href="{{URL::to('/privacy-policy')}}" target="_blank">*Terms & Condition</a>&nbsp;<a target="_blank" href="http://blog.hostitsmart.com/how-to-claim-a-discount-on-vps-hosting-through-spinwheel-at-host-it-smart/">*How To Claim</a>
                        </div>
                    </div>

                    <div class="spin-wheel-main-two win" id="5-OFF" style="display: none;">
                        <div class="swm-header">
                            <p><span class="chngclr">Congratulations!</span> You’ve hit 5% OFF On Vps Products. </p>
                        </div>
                        <div class="swm-code">
                            <div class="box-main">
                                <div class="code-three">
                                    <p>RPD21DIS5PER</p>
                                </div>
                                <div class="swm-continue">
                                    <button type="button" onclick="update_spinwheeldata(2);">CONTINUE</button>
                                </div>
                            </div>
                        </div>
                        <div class="swm-desc term-cond">
                            <p>*This offer is applicable on 1 Years Plans only.</p>
                        </div>
                        <div class="swm-links">
                            <a href="{{URL::to('/privacy-policy')}}" target="_blank">*Terms & Condition</a>&nbsp;<a target="_blank" href="http://blog.hostitsmart.com/how-to-claim-a-discount-on-vps-hosting-through-spinwheel-at-host-it-smart/">*How To Claim</a>
                        </div>
                    </div>

                </div>
            </div>
          </div>
      </div>
  </div>
</div>
<script src="{{URL::to('/assets/spin-wheel/js/spin-wheel.js')}}"></script>
<link rel="stylesheet" href="{{URL::to('/assets/spin-wheel/css/spin-wheel.css?v='.date('YmdHi'))}}">

<script> $(function(){ setTimeout(function(){ $('#spin-wheel').fadeIn(200).modal('show'); },2000); }) </script>

<script>
    $(function(){
        $('#close-spin-wheel-model').click(function(){
            var responseData2 = $.ajax({ type: "GET", datatype: "html", data: {"cookiename":"spin-wheel-popup-frvps"}, url: "{{url('cart/spinWheelGetCookie')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, async: false }).responseText;
            // console.log(responseData2);
        });
    })
    function updateajaxpromocode(formdata) {
        // alert(postdata);
        var res = $.ajax({ type: "POST", datatype: "html", data: formdata, url: "{{url('cart/spinWheelPostData')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, async: false }).responseText;
        // console.log(res);
        if (res=="success") {
            $('#close-spin-wheel-model').click();
            $(location).attr('href', '{{URL::to('/servers/vps-hosting')}}');
        }
    }
</script>
<script>
    // spin wheel js start
    var verificationid='';
    $(function(){
        var $sendonceOTP=1;
        $("#frmspinwheel").validate({
            errorClass: "error",
            errorElement: "span",
            rules: {
              "spin-wheel-email": { 
                  required: true,
                  remote: {
                    url: "{{url('cart/spinWheelIsEmailExists')}}",
                    type: "post",
                    data: {
                        type: function(){
                          return "V";
                        },
                    },
                  },
              },
              "verified-otp": {
                required: true
              },
              "spin-wheel-name": { required: true },
              "spin-wheel-number": { required: true,
              remote: {
                    url: "{{url('cart/spinWheelIsPhoneExists')}}",
                    type: "post",
                    data: {
                        type: function(){
                          return "V";
                        },
                    },
                  },
              },
              
            },
            messages: {
              "spin-wheel-email": { required: "Please enter email.",remote: "Your email already exists! Please try another email."},
              "spin-wheel-name": { required: "Please enter name."},
              "spin-wheel-number": { required: "Please enter contact number.", remote: "Your contact number already exists! Please try another contact number."},
              "verified-otp": { required: "Please Verify your OTP.&nbsp;" }
            },
            submitHandler: function (form) {

                $('#frmspinwheel-div').hide();
                $('#otp-class').show();
                $('#tryorluck').html("TRY YOUR LUCK");

                if ($sendonceOTP==1) {
                    $.ajax({ 
                        type: "get",
                        data: { phoneno: $('#spin-wheel-number').val() },
                        url: "{{url('cart/spinwheel_sendopt')}}", 
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, 
                        async: false,
                        success:function(res){
                            var obj = jQuery.parseJSON(res);
                            console.log(obj);
                            if (obj.status == "success") {
                                $('#tryorluck').prop( "disabled", true );
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
                console.log(obj);
                if (obj.status == "success") {
                    $('#tryorluck').prop( "disabled", false );
                    verificationid=$('#is-verified-otp').val();
                    //$("#otplblerror").hide();
                    $("#verified-otp-msg").html('OTP Verified! Please click on "TRY YOUR LUCK" button below.');
                    $('#tryorluck').click();

                }else{
                    console.log("error in otp verification."); 
                    //$("#otplblerror").show().html("OTP not verfied!! Please enter valid OTP.");
                    }
                }
            });
        }
        else { /*$("#otplblerror").show().html("Please enter your OTP.");*/ }
    }

    var spinStatus=true;
    
    var $i=0;
    var padding = {top:20, right:40, bottom:0, left:0},

    @if ($uagent == "mobile")
        w = 500 - padding.left - padding.right,
        h = 500 - padding.top  - padding.bottom,
    @else
        w = 600 - padding.left - padding.right,
        h = 600 - padding.top  - padding.bottom,
    @endif

    r = Math.min(w, h)/2,
    rotation = 0,
    oldrotation = 0,
    picked = 100000,
    oldpick = [],
    //color = d3.scale.category20();//category20c()
    color = function (idx) {
         colorsCode = ["#3aab39","#FF9933","#3aab39","#FF9933","#3aab39","#FF9933","#3aab39","#FF9933","#3aab39","#FF9933"]
                return colorsCode[idx]; };
        var data = [
            {"label":"+ 2 Core", "promocode":"RPD21CPU",  "value":1}, // core start 940 + 40
            {"label":"+ 2GB RAM", "promocode":"RPD21RAM",  "value":2}, //RAM
            {"label":"+ 20GB HDD", "promocode":"RPD21HD",  "value":3}, //HDD
            {"label":"5% Off", "promocode":"RPD21DIS5PER",  "value":4}, // core start 1060 + 40
            {"label":"+ 2GB RAM", "promocode":"RPD21RAM",  "value":5}, //RAM 
            {"label":"+ 20GB HDD", "promocode":"RPD21HD",  "value":6}, //HDD
            {"label":"5% Off", "promocode":"RPD21DIS5PER",  "value":7}, // core start 1180 + 40
            {"label":"+ 2GB RAM", "promocode":"RPD21RAM",  "value":8}, //RAM
            {"label":"+ 20GB HDD", "promocode":"RPD21HD",  "value":9}, //HDD
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
            .attr("d", function (d) { return arc(d); }).attr('stroke', 'white').attr('stroke-width', 8);
        // add the text
        arcs.append("text").attr("transform", function(d){
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle)/2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
            })
            .attr("text-anchor", "end")
            .style({"font-size":"26px"})
            .text( function(d, i) {
                return data[i].label;
            });
            
        //$('#tryorluck').on("click", spin); 
        function spin(d){
            //$('#tryorluck').on("click", null);
            //all slices have been seen, all done
            console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
            var  ps       = 360/data.length,
                 pieslice = Math.round(1440/data.length),
                 rng      = Math.floor((Math.random() * 1440) + 360);
            rotation = (Math.round(rng / ps) * ps);
            // ps => 40 pieslice => 160 rng => 1322 rotation => 1320
            picked = Math.round(data.length - (rotation % 360)/ps);
            picked = picked >= data.length ? (picked % data.length) : picked;
            
            // for skip 4 core condition start
            
            // console.log(picked);
            // if (picked === 0 || picked === 3 || picked === 6) {  }

            while (picked === 0) {
              picked = picked + 1; rotation = rotation + 40;

              picked = Math.round(data.length - (rotation % 360)/ps);
              picked = picked >= data.length ? (picked % data.length) : picked;
              // console.log("in while "+picked);
            }
            // for skip 4 core condition end

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
                .duration(3000)
                .attrTween("transform", rotTween)
                .each("end", function(){
                    //mark question as seen
                    d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                        .attr("fill", "#000080").style({"fill":"#ffffff","color":"#ffffff"});
                    //populate question
                    d3.select("#question h1")
                        .text(data[picked].question);
                    oldrotation = rotation;
              
                    /* Get the result value from object "data" */
                    console.log("print_val "+data[picked].value);
                    var formdata = $("#frmspinwheel").serialize() + "&promo=" + data[picked].promocode;
                    var responseData = $.ajax({ type: "POST", datatype: "html", data: formdata, url: "{{url('cart/spinWheelPostData')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, async: false }).responseText;

                    if (responseData == "success") {
                        if (data[picked].value == 1) {
                            // for 20%
                            $('#main').hide();$('#4GBHDD').hide();$('#4GBRAM').hide();$('#5-OFF').hide();$('#4CORE').show();
                        }else if(data[picked].value == 4 || data[picked].value == 7){
                            // 5-OFF
                            $('#main').hide();$('#4GBHDD').hide();$('#4GBRAM').hide();$('#4CORE').hide();$('#5-OFF').show();
                        }else if (data[picked].value == 2 || data[picked].value == 5 || data[picked].value == 8){
                            // for 25%
                            $('#main').hide();$('#4GBHDD').hide();$('#4CORE').hide();$('#5-OFF').hide();$('#4GBRAM').show();
                        }else if (data[picked].value == 3 || data[picked].value == 6 || data[picked].value == 9){
                            // for 30%
                            $('#main').hide();$('#4CORE').hide();$('#4GBRAM').hide();$('#5-OFF').hide();$('#4GBHDD').show();
                        }
                    }

                    console.log(responseData);
                    if (data[picked].value !== 10) {$('.spin-wheel-main-one').css("opacity", '0.2'); $i=0;}         
                    /* Comment the below line for restrict spin to sngle time */
                    //$('#tryorluck').on("click", spin);
                });
        }
        
        
        //make arrow
        svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
            .style({"fill":"#f9bf1a"});
        //draw spin circle
        container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 50)
            .style({"fill":"rgb(31 31 123)","cursor":"pointer",});
        //spin text
        container.append("text")
            .attr("x", 0)
            .attr("y", 0)
            .attr("text-anchor", "middle")
            .attr('id','verticletxt')
            .text("SPIN")
            .style({"font-weight":"bold", "font-size":"18px","fill":"white"});
        
        
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
                console.log("works");
            } else {
                //no support for crypto, get crappy random numbers
                for(var i=0; i < 1000; i++){
                    array[i] = Math.floor(Math.random() * 100000) + 1;
                }
            }
            return array;
        }
        
        function update_spinwheeldata(step){
            var responseData = $.ajax({ type: "POST", datatype: "html", data:{"intstep":step}, url: "{{url('cart/spinWheelUpdateData')}}", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, async: false }).responseText;
            $('#close-spin-wheel-model').click();
            $(location).attr('href', "{{URL::to('/servers/vps-hosting')}}");	
        }
        // spin wheel js end
</script>
@endif
@endif
{{-- spin-wheel end --}}


