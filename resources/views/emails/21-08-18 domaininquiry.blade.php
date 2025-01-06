<html>
    <head>
        <title>{{$SITE_NAME}}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

        <table id="Table_01" width="600" align="center"  border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="background: #115BA9;text-align: center;padding: 20px 0;">
                    <a href="{{url('/')}}"><img src="{{url('assets/images/email-template/logo.png')}}" alt="{{$SITE_NAME}}"></a>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 0 0;background: #e6eef6;">
                    <table style="width: 430px;background: #ffffff;margin-bottom: 0px;margin-top: 30px;padding: 19px;border-radius: 2px;margin-bottom: 30px;" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr><td style="font-size: 18px;font-weight: 700;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;padding-bottom: 8px;max-width: 150px;color: #333;letter-spacing: 1px;">Dear Admin,</td></tr>
                            <tr><td style="font-size: 15px;font-weight: 600;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;padding-bottom: 14px;max-width: 150px;color: #333;letter-spacing: .5px;">A person wishes to transfer his/her domain with us. Please find the details as below:</td></tr>
                            <tr>
                                <td style="padding: 9px 0; color: #221d3d; font-weight: 600; font-size: 18px;text-align:center;"><img src="{{url('assets/images/email-template/inquiry.png')}}" width="70" alt="inquiry"></td>
                            </tr>
                            <tr><td style="font-size: 22px;font-weight: 700;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;max-width: 150px;text-transform: uppercase;color: #333;letter-spacing: 1px;">Enquire Details</td></tr>
                            <tr>
                                <td>
                                    <table>
                                        <tbody><tr><td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;padding-top: 12px;"><b style="    margin-right: 5px;color: #555;"><img src="{{url('assets/images/email-template/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Name :</b>{{ $first_name }}</td></tr>
                                            <tr><td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;"><b style="    margin-right: 5px;color: #555;"><img src="{{url('assets/images/email-template/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Email Id :</b><a href="mailTo:{{ $email }}" style="color: #115ba9;">{{ $email }}</a></td></tr>
                                            <tr><td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;"><b style="    margin-right: 5px;color: #555;"><img src="{{url('assets/images/email-template/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Phone :</b>{{ $phone_number }}</td></tr>
                                            <tr><td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;"><b style="    margin-right: 5px;color: #555;"><img src="{{url('assets/images/email-template/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Domain :</b>{{ $domain }}</td></tr>
                                            @if(isset($user_message) && !empty($user_message))
                                            <tr><td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;"><b style="    margin-right: 5px;color: #555;"><img src="{{url('assets/images/email-template/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Message :</b>{{ $user_message }}</td></tr>
                                            @endif
                                        </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-top: 10px;padding-bottom: 4px;color: #333;"><b>Best Regards,</b></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 14px;color: #115ba9;font-weight: 500;letter-spacing: 0.6px;">Hostitsmart</td>
                            </tr>
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