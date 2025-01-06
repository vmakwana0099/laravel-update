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
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="text-align: center">
                                <img src="{{url('assets/images/email-template/signup-image.jpg')}}" alt="Thanks for created account." />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding:35px 50px 25px 50px ;background: #f1f5f7;text-align: center;">
                    <table style="" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr style="padding: 0px;">
                                <td style="font-size: 15px;font-weight: 500;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;max-width: 150px;color: #034183;padding-bottom: 0px;letter-spacing: 0.6px;">Congratulations! Your account has been successfully created. Just follow this link below to confirm you email address and we hope you enjoy using our tools as much as we have enjoyed creating them.</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;font-weight: 500;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: left;padding: 25px 0 20px 0;color: #444;" align="center"><a href="javascript:void(0)" style="font-size: 16px;text-align: center;margin: 0 auto;display: block;color: #18b35c;font-weight: 400;" title="Hostitsmart">{{$confirm_link}}</a></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 22px;font-weight: 500;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';
                                    color: #115baa;padding-bottom: 17px;letter-spacing: 0.5px;">What do you get?</td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 16px;font-weight: 400;
                                    font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';color: #777777;letter-spacing: 0.3px;">{{$SITE_NAME}} leading Customer Service Team is available at info@hostitsmart.com to answer any questions you may have.</td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 16px;font-weight: 400;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';
                                    color: #777777;padding: 13px 0 0 0;">To learn how {{$SITE_NAME}} collects, uses, and safeguards the personal information you provide, please review our Privacy Policy</td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 16px;font-weight: 400;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';
                                    color: #777777;padding: 33px 0 33px 0;"><a href="{{$confirm_link}}" title="Confirm your Email!" style="padding: 12px 50px;background: #165baa;color: #fff;
                                     border-radius: 7px;text-decoration: none;letter-spacing: 2px;display: block;max-width: 300px;">Confirm your Email!</a> </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 15px;font-weight: 500;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';
                                    color: #165baa;padding: 0px;">Get in touch if you have any questions regarding our new product.Feel free to contact us 24/7. We are here to help. </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 13px;"><span style="width: 71px;height: 1px;background: #165baa;display: block;margin: 0 auto;"></span></td>
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