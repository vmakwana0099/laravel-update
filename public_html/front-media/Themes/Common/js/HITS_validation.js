
function isNullDomain(domain)
{
   if(domain != "")  
        {return true;}
        else 
        {   
            alert(REQUIRE_DOMAIN);
            return false;
        }
}
function keyValidationForDomain(e) 
{
    var keycode = e.keyCode; 
    if(keycode == 32){return false;}
    return true;
        
}
 
     function trim(str, chars) {
    return ltrim(rtrim(str, chars), chars);
}
function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
function rtrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}
 
 
function KeycheckOnlyNumeric(e)
{
	
    var _dom = 0;
    _dom=document.all?3:(document.getElementById?1:(document.layers?2:0));
    if(document.all) e=window.event; // for IE
    var ch='';
    var KeyID = '';
    if(_dom==2){                     // for NN4
        if(e.which>0) ch='('+String.fromCharCode(e.which)+')';
        KeyID=e.which;
    }
    else
    {
        if(_dom==3){                   // for IE
            KeyID = (window.event) ? event.keyCode : e.which;
        }
        else {                       // for Mozilla
            if(e.charCode>0) ch='('+String.fromCharCode(e.charCode)+')';
            KeyID=e.charCode;
        }
    }
    /* if((KeyID >= 65 && KeyID <= 90) || (KeyID >= 97 && KeyID <= 122) || (KeyID >= 33 && KeyID <= 47) || (KeyID >= 58 && KeyID <= 64) || (KeyID >= 91 && KeyID <= 96) || (KeyID >= 123 && KeyID <= 126))*/
   
    if((KeyID >= 65 && KeyID <= 90) || (KeyID >= 97 && KeyID <= 122) || (KeyID >= 33 && KeyID <= 47) || (KeyID >= 58 && KeyID <= 64) || (KeyID >= 91 && KeyID <= 96) || (KeyID >= 123 && KeyID <= 126) || (KeyID == 32))//changed by jshah for stopping spaces
    {
        return false;
    }
    return true;
}


function KeycheckOnlyPhonenumber(e)
{
   
    var _dom = 0;
    _dom=document.all?3:(document.getElementById?1:(document.layers?2:0));
    if(document.all) e=window.event; // for IE
    var ch='';
    var KeyID = '';
    //alert(_dom);
    if(_dom==2){                     // for NN4
        //alert(e.which);
        if(e.which>0) ch='('+String.fromCharCode(e.which)+')';
        KeyID=e.which;
    }
    else
    {
        if(_dom==3){                   // for IE
            KeyID = (window.event) ? event.keyCode : e.which;
        }
        else {                       // for Mozilla
            //alert('Mozilla:' + e.charCode);
            if(e.charCode>0) ch='('+String.fromCharCode(e.charCode)+')';
            KeyID=e.charCode;
        }
    }

    if((KeyID >= 65 && KeyID <= 90) || (KeyID >= 97 && KeyID <= 122) || (KeyID >= 33 && KeyID <= 39) || (KeyID >= 42 && KeyID <= 44) || (KeyID >= 46 && KeyID <= 47) || (KeyID >= 58 && KeyID <= 64) || (KeyID >= 91 && KeyID <= 96) || (KeyID >= 123 && KeyID <= 126))	
    {
        //alert("hello");
        return false;
    }
	
    return true;
}
function checkemail(str)
{
    var testresults;
    //var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    var filter=/^([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+$/i

    if (filter.test(str))
        testresults=true
    else
        testresults=false

    return (testresults)
}
function checkvalidateSuppoertForm()
{
   
    if(trim(document.getElementById("name").value)=="")
	{
		alert("Please enter your name.");
		document.getElementById("name").focus();
		return false;
	}
	else if(trim(document.getElementById("email").value)=="")
	{
		alert("Please enter your email.");
		document.getElementById("email").focus();
		return false;
	}
	else if((trim(document.getElementById("email").value)!="") && !checkemail(trim(document.getElementById("email").value)))
	{
		alert("Please enter valid email id.");
		document.getElementById("email").focus();
		return false;
	
        }else if(trim(document.getElementById("subject").value)=="")
	{
		alert("Please enter subject.");
		document.getElementById("subject").focus(); 
		return false;
	}
        
	else if(trim(document.getElementById("message").value)=="")
	{
		alert("Please enter the message.");
		document.getElementById("message").focus();
		return false;
	}
	else if(trim(document.getElementById('enqcap').value)==''){
		alert("Please enter the captcha code exactly as mentioned in order to verify and continue.");
		document.getElementById('enqcap').focus();
		return false;
   }
   else if(document.getElementById('enqcap').value!=document.getElementById('pin_value_hdn').value){
		alert("Please enter the captcha code exactly as mentioned in order to verify and continue.");
		document.getElementById('enqcap').focus();
		return false;
   }
	document.getElementById('h_save').value='T';  
}

function checkvalidate()
{
    if(trim(document.getElementById("var_name").value)=="")
	{
		alert("Please enter your name.");
		document.getElementById("var_name").focus();
		return false;
	}
	else if(trim(document.getElementById("var_email").value)=="")
	{
		alert("Please enter your email.");
		document.getElementById("var_email").focus();
		return false;
	}
	else if((trim(document.getElementById("var_email").value)!="") && !checkemail(trim(document.getElementById("var_email").value)))
	{
		alert("Please enter valid email id.");
		document.getElementById("var_email").focus();
		return false;
	}
	else if(trim(document.getElementById("var_message").value)=="")
	{
		alert("Please enter the message.");
		document.getElementById("var_message").focus();
		return false;
	}
	else if(trim(document.getElementById('enqcap').value)==''){
		alert("Please enter the captcha code exactly as mentioned in order to verify and continue.");
		document.getElementById('enqcap').focus();
		return false;
   }
   else if(document.getElementById('enqcap').value!=document.getElementById('pin_value_hdn').value){
		alert("Please enter the captcha code exactly as mentioned in order to verify and continue.");
		document.getElementById('enqcap').focus();
		return false;
   }
	
	document.getElementById('h_save').value='T';  
}


