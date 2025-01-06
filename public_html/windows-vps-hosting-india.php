<!doctype html>
<html>
<head>
<script>setTimeout(function(){
	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P39GJB');
}, 6000);</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<meta name="SKYPE_TOOLBAR" content ="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/> 
<meta name="format-detection" content="telephone=no">
<title>Cheap Windows VPS Hosting India | Buy Windows VPS Server</title> 
<meta name="description" content="Looking for a cheap Windows VPS hosting plan for your business? Host IT Smart Offer Low-Cost Windows VPS Server with quality customer support. ">
<meta name="keywords" content="Cheap Windows VPS Hosting India, Buy Windows VPS, Windows VPS Hosting">

<link href="{{ url('front-media/vps_landingpage/css/style.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ url('/front-media/vps_landingpage/js/jquery-1.9.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/front-media/vps_landingpage/js/html5.js') }}"></script> 
<script type="text/javascript" src="{{ url('/front-media/vps_landingpage/js/jquery.bpopup.min.js') }}"></script>   




 <script type="text/javascript">
$(document).ready(function() {
var ie = /MSIE (\d+)/.exec(navigator.userAgent);
ie = ie ? ie[1] : null;
if (ie && ie == 9) {
//alert("ie9");
$('head').append("<link href='{{ url('front-media/vps_landingpage/Themes/ThemeDefault/css/ie9.css') }}' rel='stylesheet' type='text/css'>");
}
else if (ie && ie == 8) {
//alert("ie8");
$('head').append("<style type='text/css'>.buorg{display:block} .up_broimg{top:5px}</style>");
}
else if (ie && ie == 7) {

//alert("ie7");
$('head').append("<style type='text/css'>.buorg{display:block}</style>");
}

});


            $(document).ready(function() 
            {
                window.setInterval(function()
                {   
                    var userflag= readCookie('firsttimeuseronhosting');
                    if(userflag != 'Y')
                    {
                        var date= new Date();  
                        var expire = '1'; //days
                        createCookie('firsttimeuseronhosting','Y',expire);
                        //if(!$("#popup2").is(":visible"))
                        //{ firsttimevisitepopup();     }
                        firsttimevisitepopup(); 

                    }
                }, 10000);
            });
    
            function createCookie(cname, value, days) 
            {
                var name = 'his_'+cname;
                if (days) 
                {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    var expires = "; expires=" + date.toGMTString();
                } 
                else var expires = "";
                document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
            }
    
            function readCookie(cname) 
            {
                var name = 'his_'+cname;
                var nameEQ = escape(name) + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) 
                {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return unescape(c.substring(nameEQ.length, c.length));
                }
                return null;
            }

            function firsttimevisitepopup(listid,flag)
            {  
                $('#popup').bPopup({
                    speed: 750,
                    transition: 'slideIn',
                    transitionClose: 'slideBack'
                });
            }
            function exitpopup(){
               // $('#popup2').bPopup();   
            }
            
            $(document).ready(function() 
            {
                 $( "body" ).mouseleave(function() { 
                    var exituserflag= readCookie('exitpopup');
                    if(exituserflag != 'Y')
                    {
                        var date= new Date();  
                        var expire = '1'; //days
                        createCookie('exitpopup','Y',expire);
                        exitpopup(); 
                    }
                    
                });
                $.validator.addMethod("phonenumber", function(value, element)
                {
                    return (value == '') || (
                    value.match(/^((\+)?[1-9]{1,2})?([-\s\.])?(\(\d\)[-\s\.]?)?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}(\s*(ext|x)\s*\.?:?\s*([0-9]+))?$/)
                );
                },'Please enter a valid mobile number.');

                $(":hidden").addClass("error");
                $("#bookadomianfrm").validate({
                    ignore: ".ignore",
                    rules: {
                        var_fullname: "required",
                        var_emailid: {
                            required:true,
                            email:true
                        },
                        var_phoneno: {
                            required:true,
                            phonenumber:true,
                            minlength : 5,
                            maxlength : 20 
                        }
                    },
                    messages: 
                        {
                        var_fullname:'Please enter your name.',
                        var_emailid:{
                            required :'Please enter email id.',
                            email :'Please enter valid email id.'
                        },
                        var_phoneno:{
                            required :'Please enter the mobile number.',
                            minlength : "Mobile number should be of minimum 5 characters.",
                            maxlength : "Mobile number should be of maximum 20 characters."
                        }
                    },
                    submitHandler: function() 
                    {
                        var url= 'https://legacy.hostitsmart.com/'+"pages/buyvpspopup"; 
                        url=url+"?var_name="+$('#var_fullname').val();
                        if($('#var_emailid').val()!='')
                        {
                            url=url+"&var_emailid="+$('#var_emailid').val();
                        }
                        url=url+"&var_phoneno="+$('#var_phoneno').val();
            
                        $.ajax({
                            type: "POST",  
                            url:url,  
                            async: false,
                            success: function(data)
                            {
                                if(trim(data)=='Y')
                                {
                                    alert('Thank you for subscribing with us.');
                                    window.location.href = window.location.href;
                                }
                                else
                                {
                                    alert('Sorry! your request for subscribing is not add successfully.');
                                    return false;
                                }
                            }
                        });
                    }
                });
                /*$("#bookadomianfrm2").validate({
                    ignore: ".ignore",
                    rules: {
                        var_fullname: "required",
                        var_emailid: {
                            required:false,
                            email:true
                        },
                        var_phoneno: {
                            required:true,
                            phonenumber:true,
                            minlength : 5,
                            maxlength : 20 
                        }
                    },
                    messages: 
                        {
                        var_fullname:'Please enter your name.',
                        var_emailid:{
                            required :'Please enter email id.',
                            email :'Please enter valid email id.'
                        },
                        var_phoneno:{
                            required :'Please enter the mobile number.',
                            minlength : "Mobile number should be of minimum 5 characters.",
                            maxlength : "Mobile number should be of maximum 20 characters."
                        }
                    },
                    submitHandler: function() 
                    {
                        var url= 'https://legacy.hostitsmart.com/'+"pages/buyvpspopup"; 
                        url=url+"?var_name="+$('#var_fullname').val();
                        if($('#var_emailid').val()!='')
                        {
                            url=url+"&var_emailid="+$('#var_emailid').val();
                        }
                        url=url+"&var_phoneno="+$('#var_phoneno').val();
            
                        $.ajax({
                            type: "POST",  
                            url:url,  
                            async: false,
                            success: function(data)
                            {
                                if(trim(data)=='Y')
                                {
                                    alert('Thank you for subscribing with us.');
                                    window.location.href = window.location.href;
                                }
                                else
                                {
                                    alert('Sorry! your request for subscribing is not add successfully.');
                                    return false;
                                }
                            }
                        });
                    }
                });*/
                return false;
            });
        </script>


</head>

<body>
    
        <div id="popup" style="display: none;">
            <div class="landing_form_pop">
                <div class="land_popup">
                    <div class="landpage_headder">
                        <a title="Close" class="fancybox-item fancybox-close b-close" href="javascript:;"></a>
                        <h2>YOUR TICKET TO BEST HOSTING EXPERIENCES</h2>
                    </div>
                    <div class="landpop_contan">
                        <div class="spacer10"></div>
                        <form name="bookadomianfrm" id="bookadomianfrm" action="" onsubmit="return false;">
                            <div class="land_form">
                                <input type="text" maxlength="32" name="var_fullname" id="var_fullname" value="" placeholder="Your Name">
                            </div>
                            <div class="land_form">
                                <input type="text" maxlength="20" onkeypress="return KeycheckOnlyPhonenumber(event);" name="var_phoneno" id="var_phoneno" value="" placeholder="Your Mobile Number">
                            </div>
                            <div class="land_form">
                                <input type="text" maxlength="40" name="var_emailid" id="var_emailid" value="" placeholder="Your Email ID">
                            </div>
                            <button type="Submit" title="Submit" class="Secure_btn">Submit</button>
                        </form>
                    </div>
                    <div class="Dname_points">
                        <ul>
                            <li><a target="_blank" href="{{ url('/hosting/linux-hosting') }}" title="Amazing Offers">Amazing Offers</a></li>
                            <li><a target="_blank" href="{{ url('/hosting/linux-reseller-hosting') }}" title="Great Service">Great Service</a></li>
                            <li><a target="_blank" href="{{ url('/ssl-certificates') }}" title="Secured Hosting">Secured Hosting</a></li>
                            <li><a target="_blank" href="{{ url('/servers/dedicated-servers') }}" title="Fully Managed Servers">Fully Managed Servers</a></li>
                        </ul>
                    </div>
                <div class="pop_bottomlogo">
                    <a href="{{ url('/') }}" target="_blank" title="HostITSmart"><img src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png"></a>
                    <a class="Land_footer_call_no" href="javascript:;">079-6605 0099</a>
                </div>
                <div class="spacer10"></div>
            </div>
            </div>
        </div>
        
<div id="wrapper">

<!--Ie Note Coment Start -->

<div class="buorg">

    <div class="buorg_sec">
   
    <span>For a better experience on HostITSmart, </span>
  
     <a href="#" title="update your browser">
      <span> &nbsp; update your browser.</span>
    </a>
</div>
</div>

<!--Ie Note Coment Close -->

<header>

<div class="inercontaner">

<div class="landing_help_div">
                <div class="let_me_help">
                    <a class="Secure_btn" onclick="return firsttimevisitepopup();" href="javascript:;" title="Let Me Help You">Let Me Help You</a>
                </div>
            </div>
<div class="new_book">
<a href="{{ url('/') }}" title="Hosting Service Provider" class="logo"><img src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png" alt="HostITSmart"></a>
<div class="smart_people">Smart People, Smart Services</div>

</div>

<?php /*<div class="chat_div">
<a id="live_chat" href="javascript:void(0);" class="live-chat" title="Click to Live-chat">Live Chat &amp; Call Now </a>
</div>*/?>

<div class="head_right_no">



<a href="javascript:;" class="Land_footer_call_no">079-6605 0099</a> 

</div>


<div class="spacer20"></div>

</div>
</header>

<!--Premium Section Start-->

<section>
<div class="Premium_vps"> 

<div class="text_premium"> 
<div class="paln_man"></div>  
<div class="Choose_plan">Windows VPS in Tier 3 Indian Data Center Facility</div>
<h1 class="premium_custome_text">Let's Welcome this summer by Shopping Windows VPS</h1>
<div class="Started_pack">
    <div class="Started_pack_img_windows"></div>
<?php /*<div class="Started_pack_img">
    <div class="Strted_text">Starting Pack</div>
    <div class="special_prise">
        <div class="rupees_icon"></div>
        <div class="Land_prise"> <span>850</span> </div>
    </div>
    <div class="month_text"> MONTHLY </div>
</div> */?>
<div class="clear"></div>
</div>
<?php /*<div class="land_icon"></div>*/?>

</div>



<div class="clear"></div>
</div>

</section>

<!--Premium Section Start-->

<!-- VPS Box Start-->

<section>
    
<div class="vps_midale_box">


<div class="VPS_Order_Box">
  
<div class="box_head">
<div class="most_pop_img"></div>
 <h2 class="title">Win VPS 1 &nbsp;&nbsp;<img src="{{ url('/front-media/vps_landingpage/images/windows-vps-icon.png') }}" style="height: 100px;  width: 100px;padding-top:10px;"></h2>

<div class="prise_bg">
<div class="stration">
Starting at
</div>

<div class="rupees_icon"></div>
<div class="prise">650<sup>* /Month</sup></div>
<div class="clear"></div>
</div>

</div>

<div class="Combo_bg">
<form name="orderform_210" id="orderform_210" action="{{ url('/cart/store') }}" method="post">
	<input type="hidden" id="producttype_210" name="producttype[]" 	value="vps">
	<input type="hidden" id="pid_210" 		  name="pid[]"  		value="210">
	<input type="hidden" id="skipconfig" name="skipconfig[]" value="Y">
	<select id="billingcycle_210" name="billingcycle[]">
		<option value="quarterly">3 mo  @ 875 INR/mo</option>
		<option value="semi-annually">6 mo  @  762.5 INR/mo</option>
		<option value="annually" selected >1 yr  @ 650  INR/mo</option>
	</select>
</form> 
</div>

<div class="vpsbox_con">
<ul>
    <li>CPU: <strong>2 Core</strong></li>
<li>RAM: <strong>2 GB</strong></li>
<li>HDD: <strong>40 GB</strong></li> 
<li class="last">OS: <strong>Win 2016 Std x64</strong></li>
</ul>
<div class="clear"></div>

<div class="Ordernow_btn_div">
<a href="javascript:void(0);" onclick="document.getElementById('orderform_210').submit();" title="Order Now" class="Ordernow_btn">Order Now</a>
</div>
</div>

<div class="clear"></div>
</div>

<div class="VPS_Order_Box">

<div class="box_head">
 
<h2 class="title">Win VPS 2 <img src="{{ url('/front-media/vps_landingpage/images/windows-vps-icon.png') " style="height: 100px;  width: 100px;padding-top:10px;"></h2>

<div class="value">
<div class="stration">
Starting at
</div>

<div class="rupees_icon"></div>
<div class="prise">1050<sup>* /Month</sup></div>
<div class="clear"></div>
</div>

</div>

<div class="Combo_bg">
<form name="orderform_211" id="orderform_211" action="{{ url('/cart/store')" method="post">
	<input type="hidden" id="producttype_211" name="producttype[]" 	value="vps">
	<input type="hidden" id="pid_211" 		  name="pid[]"  		value="211">
	<input type="hidden" id="skipconfig" name="skipconfig[]" value="Y">
	<select id="billingcycle_211" name="billingcycle[]">
		<option value="quarterly" >3 mo  @ 1275 INR/mo</option>
		<option value="semi-annually">6 mo  @ 1162.5 INR/mo</option>
		<option value="annually" selected >1 yr  @ 1050 INR/mo</option>
	</select>
</form> 
</div>

<div class="vpsbox_con">
<ul>
   <li>CPU: <strong>2 Core</strong></li>
<li>RAM: <strong>4 GB</strong></li>
<li>HDD: <strong>80 GB</strong></li>
<li class="last">OS: <strong>Win 2016 Std x64</strong></li>
</ul>

<div class="clear"></div>

<div class="Ordernow_btn_div">
<a href="javascript:void(0);" onclick="document.getElementById('orderform_211').submit();" title="Order Now" class="Ordernow_btn">Order Now</a>
</div>
</div>

<div class="clear"></div>
</div>

<div class="VPS_Order_Box">

<div class="box_head">
 
<h2 class="title">Win VPS 3 <img src="{{ url('/front-media/vps_landingpage/images/windows-vps-icon.png')" style="height: 100px;  width: 100px;padding-top:10px;"></h2>

<div class="Deluxe">
<div class="stration">
Starting at
</div>

<div class="rupees_icon"></div>
<div class="prise">1550<sup>* /Month</sup></div>
<div class="clear"></div>
</div>

</div>

<div class="Combo_bg">
<form name="orderform_212" id="orderform_212" action="{{ url('/cart/store')" method="post">
	<input type="hidden" id="producttype_212" name="producttype[]" 	value="vps">
	<input type="hidden" id="pid_212" 		  name="pid[]"  		value="212">
	<input type="hidden" id="skipconfig" name="skipconfig[]" value="Y">
	<select id="billingcycle_212" name="billingcycle[]">
		<option value="quarterly">3 mo  @ 1775 INR/mo</option>
		<option value="semi-annually">6 mo  @ 1662.5 INR/mo</option>
		<option value="annually"  selected >1 yr  @ 1550 INR/mo</option>
	</select>
</form> 
</div>

<div class="vpsbox_con">
<ul>
    <li>CPU: <strong>4 Core</strong></li>
<li>RAM: <strong>8 GB</strong></li>
<li>HDD: <strong>120 GB</strong></li>
<li class="last">OS: <strong>Win 2016 Std x64</strong></li>
</ul>
<div class="clear"></div> 
<div class="Ordernow_btn_div">
<a href="javascript:void(0);" onclick="document.getElementById('orderform_212').submit();" title="Order Now" class="Ordernow_btn">Order Now</a>
</div>
</div>

<div class="clear"></div>
</div>
</div>



</section>

<!-- VPS Box Start-->

<!--  All Plans Include Start-->

<section class="all_plan_section">

<div class="inercontaner">


<div class="All_plan_box_list">

<div class="All_plan"> 
All Plans Include
</div>


<div class="All_plan_box" title="Best Service ">

<i class="best_servies_icon"></i>

<div class="Plan_Box">2 TB Bandwidth</div>

<div class="clear"></div>
</div> 

<div class="All_plan_box" title="Fully Secure">
 
<i class="fully_seq_icon"></i>

<div class="Plan_Box">Fully Secure</div>

<div class="clear"></div>
</div>

<div class="All_plan_box" title="24x7 Support">

<i class="support24x7"></i>

<div class="Plan_Box">24x7 Support </div>

<div class="clear"></div>
</div> 


<div class="All_plan_box" title="Multiple IP Addresses">

<i class="Multi_ip_icon"></i>

<div class="Plan_Box"> 1 Dedicated IP </div>

<div class="clear"></div>
</div>

<div class="All_plan_box" title="FTP Access ">

<i class="Ftp_ip_icon"></i>

<div class="Plan_Box"> 100 Mbps Speed </div>

<div class="clear"></div>
</div>

<div class="All_plan_box" title="Databases">

<i class="raid_option_icon"></i>

<div class="Plan_Box"> Databases </div>

<div class="clear"></div>
</div> 


<div class="All_plan_box" title="Full root access ">

<i class="Fool_root_icon"></i>

<div class="Plan_Box"> Full root access </div>

<div class="clear"></div>
</div> 

 

<div class="All_plan_box" title="Utilization">

<i class="Utilization_icon"></i>
 
<div class="Plan_Box"> Utilization </div>

<div class="clear"></div>
</div>

</div>

<div class="Local_internation">

<div class="Web_hosttitle"> Trusted by thousands of local & international Businesses </div>

<div class="Guys_div"><i class="samicolon"></i> 
    <div class="Guy_text">I am blessed with having found the one of the best Web Hosting company ever. Great service, great hosting, and the staff are amazing. Everyone I refer to them loves them as much as I do. - (Shakti Kathpalia)</div>
<div class="clear"></div>
<i class="Guy_arrow"></i>
</div> 
 
<a title="Host With HostITSmart Now" class="Secure_btn" href="{{ url('/servers/vps-hosting')">Host With HostITSmart Now</a>

<div class="Star">
<div class="start_reck">

<span></span>
<span></span>
<span></span>
<span></span>
<span></span>

</div>
</div>

<div class="host_contain">
<div><strong>HostITSmart</strong> is rated 5 on 5 based </div>
<div> on thousands of<strong class="real_customer"> real customers reviews</strong> </div>
</div>

</div>
<div class="clear"></div>
</div>



</section>

<!--  All Plans Include Close-->


<div class="clear"></div>

<!--Footger Start-->

<section>
<div class="Vps_footer">

<div class="inercontaner"> 

<div class="need_help_container">

<div class="white_text"> Keep in Touch </div> 

 <div class="footer_social">
<a class="facebook_icon first" title="Facebook" href="https://www.facebook.com/hostitsmart?ref=hl" target="_blank"></a>
<a class="Twitter_icon" title="Twitter" href="https://twitter.com/HostITSmart" target="_blank"></a>
<a class="google_plus_icon" title="Google +" href="https://plus.google.com/117959973503558852757/about" target="_blank"></a>
<a class="Printest_icon" title="Pinterest" href="https://www.pinterest.com/HostITSmart" target="_blank"></a>
<a class="Linkdin_icon" title="Linkedin" href="https://www.linkedin.com/company/host-it-smart" target="_blank"></a>
</div>
 
<div class="clear"></div>

</div>

</div>

<div class="clear"></div>

</div>
</section>

<!--Footger Close-->

<section class="Copy_right">

<div class="inercontaner">
<div class="Land_footer_blue">
Copyright &copy; 2019 HostITSmart, All rights reserved <br>
</div>
</div>

</section>
<!--Start of Zopim Live Chat Script-------------------------> 
    <script type="text/javascript">
            /*$(document).ready(function(){
                setTimeout(openZopim, 15000); // Wait 15 seconds
            });*/
    function openZopim(){  
       window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
            d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
                _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
        $.src='//v2.zopim.com/?1lXmJusakiXODEAGNIP6Refz9a4trf7V';z.t=+new Date;$.
            type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script'); 
    }
     openZopim();     
    </script> 
<!--End of Zopim Live Chat Script--------------------------->


</div>

</body>
</html>
