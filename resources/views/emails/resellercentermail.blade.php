<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

        <table id="Table_01" width="600" align="center"  border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="background: #115BA9;text-align: center;padding: 20px 0;">
                    <a href="{{url('/')}}"><img src="{{url('assets/images/email-images/logo.png')}}" alt="{{$SITE_NAME}}"></a>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 0 0;background: #e6eef6;">
                    <table style="width: 430px;background: #ffffff;margin-bottom: 0px;margin-top: 30px;padding: 19px;border-radius: 2px;margin-bottom: 30px;" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            @if($user=='admin')
                            <tr><td style="font-size: 18px;font-weight: 700;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;padding-bottom: 8px;max-width: 150px;color: #333;letter-spacing: 1px;">Dear Administrator,</td></tr>
                            <tr><td style="font-size: 15px;font-weight: 600;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;padding-bottom: 14px;max-width: 150px;color: #333;letter-spacing: .5px;">A new person has contacted us via reseller inquiry form, below are the details of that person:</td></tr>
                            @else
                            <tr><td style="font-size: 18px;font-weight: 700;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;padding-bottom: 8px;max-width: 150px;color: #333;letter-spacing: 1px;">Dear {{ $fullname }},</td></tr>
                            <tr><td style="font-size: 15px;font-weight: 600;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;padding-bottom: 14px;max-width: 150px;color: #333;letter-spacing: .5px;">We have received your reseller inquiry which has been forwarded to concern authorities.<br/>You should receive a reply within 48 hours from one of our executive asking for more details on your reseller inquiry if needed.</td></tr>
                            @endif
                            @if($user=='admin')
                            <tr>
                                <td style="padding: 9px 0; color: #221d3d; font-weight: 600; font-size: 18px;text-align:center;"><img src="{{url('assets/images/email-images/inquiry.png')}}" width="70"></td>
                            </tr>
                            <tr><td style="font-size: 22px;font-weight: 700;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';text-align: center;max-width: 150px;text-transform: uppercase;color: #333;letter-spacing: 1px;">Enquire Details</td></tr>
                            <tr>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;padding-top: 12px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Name: </b>{{$fullname}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Work Email: </b><a href="mailto:{{$workemail}}" style="color: #115ba9;">{{$workemail}}</a>
                                                </td>
                                            </tr>
                                            @if(isset($interestedin) && !empty($interestedin))
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">interestedIn: </b>{{$interestedin}}
                                                </td>
                                            </tr>
                                            @endif

                                            @if(isset($phone_number) && !empty($phone_number))
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Phone # :</b>{{$phone_number}}
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;padding-top: 12px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Company Name: </b>{{$companyname}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;padding-top: 12px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Company URL: </b>{{$companyurl}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;padding-top: 12px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Type Of Business: </b>{{$businesstype}}
                                                </td>
                                            </tr>
                                             <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;padding-top: 12px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Total paying customers: </b>{{$totalcustomer}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;padding-top: 12px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Country: </b>{{$countrydata}}
                                                </td>
                                            </tr>
                                            
                                            @if(isset($user_message) && !empty($user_message))
                                            <tr>
                                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-bottom: 7px;">
                                                    <b style="margin-right: 5px;color: #555;">
                                                    <img src="{{url('assets/images/email-images/bullet.png')}}" width="11" alt="" style="margin-right: 6px;opacity: 0.7;">Message :</b>{{$user_message}}
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody></table>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';padding-top: 10px;padding-bottom: 4px;color: #333;"><b>Best Regards,</b></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 14px;color: #115ba9;font-weight: 500;letter-spacing: 0.6px;">{{$SITE_NAME}}</td>
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
                                <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 20px;font-weight: 700;color: #ffffff;">Thanks,</td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 16px;color: #ffffff;">Support Team</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                    <tr>
                                        @if(null!==(Config::get('Constant.SOCIAL_FB_LINK')) && strlen(Config::get('Constant.SOCIAL_FB_LINK')) > 0)
                                            <td style="width: 36px;"><a href="{{ Config::get('Constant.SOCIAL_FB_LINK') }}" title="Facebook"><img src="{{url('assets/images/email-images/facebook.png')}}" alt=""/></a></td>
                                        @endif
                                        @if(null!==(Config::get('Constant.Google_Plus_Link')) && strlen(Config::get('Constant.Google_Plus_Link')) > 0)
                                            <td style="width: 36px;"><a href="{{ Config::get('Constant.Google_Plus_Link') }}" title=""><img src="{{url('assets/images/email-images/google+.png')}}" alt="Facebook"/></a></td>
                                        @endif
                                        @if(null!==(Config::get('Constant.SOCIAL_TWITTER_LINK')) && strlen(Config::get('Constant.SOCIAL_TWITTER_LINK')) > 0)
                                            <td style="width: 36px;"><a href="{{ Config::get('Constant.SOCIAL_TWITTER_LINK') }}" title=""><img src="{{url('assets/images/email-images/twitter.png')}}" alt=""/></a></td>
                                        @endif
                                        @if(null!==(Config::get('Constant.SOCIAL_PINTEREST_LINK')) && strlen(Config::get('Constant.SOCIAL_PINTEREST_LINK')) > 0)
                                            <td style="width: 36px;"><a href="{{ Config::get('Constant.SOCIAL_PINTEREST_LINK') }}" title=""><img src="{{url('assets/images/email-images/pinterest.png')}}" alt=""/></a></td>
                                        @endif
                                        @if(null!==(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) && strlen(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) > 0)
                                            <td style="width: 36px;"><a href="{{ Config::get('Constant.SOCIAL_LINKEDIN_LINK') }}" title=""><img src="{{url('assets/images/email-images/linkedin.png')}}" alt=""/></a></td>
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