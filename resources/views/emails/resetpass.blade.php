<html>
<head>
<title>{{$SITE_NAME}}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table id="Table_01" width="600" align="center"  border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="background: #115BA9;text-align: center;padding: 20px 0;">
			<a href="{{url('/')}}"><img src="{{url('assets/images/email-template/logo.png')}}"  alt="{{$SITE_NAME}}"></a>
        </td>
	</tr>
	<tr>
		<td style="padding: 0px 0 0;background: #e6eef6;">
			<table style="width: 430px;background: #ffffff;margin-bottom: 0px;margin-top: 30px;padding: 19px;border-radius: 2px;" align="center" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td style="padding: 9px 0; color: #221d3d; font-weight: 600; font-size: 18px;text-align:center;"><img src="{{url('assets/images/email-template/padlock.png')}}"  width="100" alt="Forgot Password"></td>
					</tr>
					<tr><td style="font-size: 22px;font-weight: 700;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;max-width: 150px;text-transform: uppercase;color: #333;letter-spacing: 1px;">Forgot</td></tr>
					<tr><td style="font-size: 18px;font-weight: 700;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;padding-bottom: 14px;max-width: 150px;text-transform: uppercase;color: #333;letter-spacing: 1px;">your Password?</td></tr>
					<tr><td style="font-size: 14px;font-weight: 500;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;color: #444;">No worry , we got you! Let's get you a new password.</td></tr>
					<tr><td align="center" style="padding: 21px 0 14px 0;"><a href="{{$reset_link}}" style="background: #115ba9;padding:14px 16px;width: auto;color: #fff;text-decoration: none;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';border-radius: 31px;text-align: center;
					margin: 0 auto;letter-spacing: 1px;font-size: 14px;text-transform: uppercase;display: block;width: auto;max-width: 170px;" title="Reset Password">Reset Password</a></td></tr>
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td style="padding: 0px 0 0;background: #e6eef6;">
			<table style="width: 430px;background: #ffffff;margin-bottom: 30px;margin-top: 10px;
				padding: 23px;border-radius: 2px;" align="center" cellpadding="0" cellspacing="0">
				<tbody>
					<tr><td style="font-size: 15px;font-weight: 700;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif'; text-align: left;
					max-width: 150px;color: #333;">What is Hostitsmart</td></tr>
					<tr><td style="font-size: 13px;font-weight: 500;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: left;
					padding-top: 6px;color: #444;">Host IT Smart aims at providing top-scale domain and hosting services to its clients. Their online success is our priority and ultimate goal.</td></tr>
					<tr><td align="center" style="padding: 10px 0 2px 0;text-align: left;"><a href="{{url('/')}}" style="padding: 0px;width: auto;color: #115ba9;text-decoration: none;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';border-radius: 31px;text-align: left;font-size: 14px;font-weight: 600;text-transform: uppercase;" title="Learn More">Learn More</a></td></tr>
				</tbody>
			</table>
		</td>
	</tr>
    <tr>
        <td style="background-color:#115BA9;padding: 25px 0 25px 30px">
            <table style="width: 100%;" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        {!!$DEFAULT_SIGNATURE_CONTENT!!}
                    </td>
                    <td>
                        <table style="width: 100%;" cellpadding="0" cellspacing="0">
                            <tr>
                                        @if(isset($SOCIAL_FB_LINK) && !empty($SOCIAL_FB_LINK))
                                        <td style="width: 36px;"><a href="{{$SOCIAL_FB_LINK}}" title="{{$SITE_NAME}} Facebook"><img src="{{url('assets/images/email-template/facebook.png')}}" alt="{{$SITE_NAME}} Facebook"/></a></td>
                                        @endif
                                        @if(isset($SOCIAL_TWITTER_LINK) && !empty($SOCIAL_TWITTER_LINK))
                                        <td style="width: 36px;"><a href="{{$SOCIAL_TWITTER_LINK}}" title="{{$SITE_NAME}} Twitter"><img src="{{url('assets/images/email-template/twitter.png')}}" alt="{{$SITE_NAME}} Twitter"/></a></td>
                                        @endif
                                        @if(isset($SOCIAL_PINTEREST_LINK) && !empty($SOCIAL_PINTEREST_LINK))
                                        <td style="width: 36px;"><a href="{{$SOCIAL_PINTEREST_LINK}}" title="{{$SITE_NAME}} Pinterest"><img src="{{url('assets/images/email-template/pinterest.png')}}" alt="{{$SITE_NAME}} Pinterest"/></a></td>
                                        @endif
                                        @if(isset($Google_Plus_Link) && !empty($Google_Plus_Link))
                                        <td style="width: 36px;"><a href="{{$Google_Plus_Link}}" title="{{$SITE_NAME}} Google+"><img src="{{url('assets/images/email-template/google+.png')}}" alt="{{$SITE_NAME}} Google+"/></a></td>
                                        @endif
                                        @if(isset($SOCIAL_LINKEDIN_LINK) && !empty($SOCIAL_LINKEDIN_LINK))
                                        <td style="width: 36px;"><a href="{{$SOCIAL_LINKEDIN_LINK}}" title="{{$SITE_NAME}} Linkedin"><img src="{{url('assets/images/email-template/linkedin.png')}}" alt="{{$SITE_NAME}} Linkedin"/></a></td>
                                        @endif
                                    </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>