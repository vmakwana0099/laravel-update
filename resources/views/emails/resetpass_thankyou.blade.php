<html>
    <head>
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
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="text-align: center">
                                <img src="{{url('assets/images/email-template/signup-image.jpg')}}" alt="{{$SITE_NAME}}" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding:35px 50px 25px 50px ;background: #f1f5f7;text-align: center;">
                    <table style="" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="text-align: center">
                                    <strong style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 24px;color: #115BA9;letter-spacing: 1px;">Dear {{ $name }},</strong>

                                </td>
                            </tr>
                            <tr style="padding: 0px;">
                                <td style="font-size: 15px;font-weight: 500;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;color: #034183;padding-bottom: 0px;letter-spacing: 0.6px;">Congratulations!  Your password has been successfully updated. Please <a href="{{url('/login')}}" target="_blank">login</a> with new password in future.</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #115BA9;padding: 25px 0 25px 30px">
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