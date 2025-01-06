<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <title>{{ $SITE_NAME }}</title>
    <style>
    @media(max-width:550px) {
     .responsive_width{width:94% !important;}
    }
    </style>
  </head>
  <body style="margin:0;padding:0;background-color:#eaeff2;">
    <center>
    <table class="mobile_device" width="100%" align="center" cellpadding="15" cellspacing="0" style="background:#eaeff2;font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;width:100%;margin:auto;">
      <tbody>
        <tr>
          <td>
            <table cellpadding="10" cellspacing="0" class="responsive_width" width="550px" style="width:550px;margin:auto;background-color:#fff;text-align:center;">
              <tbody>
                <tr>
                  <td width="100%" style="padding:20px 20px 15px" align="center">
                    <a href="{{url('/')}}" target="_blank">
                      <img src="{!! App\Helpers\resize_image::resize($FRONT_LOGO_ID,300,200) !!}" alt="{{$SITE_NAME}}" style="height:34px;width:150px" />
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
            <table width="550px" cellspacing="0" class="responsive_width" cellpadding="0" style="width:550px;margin:auto;background-color:#FFF;">
              <tbody>
                <tr>
                  <td>
                    <table width="100%" cellspacing="0" cellpadding="0" style="padding:20px;background:#f4f4f4">
                    @if(isset($user_subscribe))
                      <tr>
                        <td style="font-size:16px;" align="center">
                          <span style="color:#2574db; font-size:24px; font-weight:normal; font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; display:block; text-align: center;margin-bottom: 10px;">Dear {{ $first_name }},</span>
                          <p style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;margin:15px 0 10px;padding:0;color:#333333">Welcome to {{ $SITE_NAME }}.</p>
                          <p style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;margin:15px 0 10px;padding:0;color:#333333">Thank you for subscribing to our newsletters. Before sending you any further updates, we want to be certain we have your permission to deliver updated to your inbox.</p>
                          <p style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;margin:15px 0 10px;padding:0;color:#333333">Please confirm your subscription by clicking on the following link:</p>
                          <a href="{{ $user_subscribe }}" style="background:#2574db;padding:6px 15px;display:inline-block;text-decoration:none;color:#fff;font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;font-size:16px;margin:8px 0 0 0;font-weight:bold;">SUBSCRIBE</a>
                          <p style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;margin:15px 0 10px;padding:0;color:#333333">If you do not want to confirm, simply ignore this message.<br>Thank you.</p>
                        </td>
                      </tr>
                  @elseif($user_unsubscribe)
                      <tr>
                        <td style="font-size:16px;" align="center">
                          <span style="color:#2574db; font-size:24px; font-weight:normal; font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif; display:block; text-align: center;margin-bottom: 10px;">Dear {{ $first_name }},</span>
                          <p style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;margin:15px 0 10px;padding:0;color:#333333">Welcome to {{ $SITE_NAME }}.</p>
                          <p style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;margin:15px 0 10px;padding:0;color:#333333">Thank you for subscribing to our newsletters.<br/>Your subscription has been confirmed. You've been added to our list and will hear from us soon.<br/>If you do not want to receive any future updates, please click <a href="{{ $user_unsubscribe }}">here</a> to unsubscribe.</p>
                        </td>
                      </tr>
                  @endif
                    </table>
                </td>
              </tr>
            </tbody>
          </table>
          <table cellpadding="0" cellspacing="0" class="responsive_width" width="550px" style="padding:20px;width:550px;margin:auto;">
            <tr>
              <td width="100%" style="margin: 0;padding:0px 15px 10px 5px;" align="center">
                <span>
                @if(isset($SOCIAL_FB_LINK) && !empty($SOCIAL_FB_LINK))
                  <a href="{{$SOCIAL_FB_LINK}}" style="color:#ededed;">
                  <img alt="{{$SITE_NAME}} Facebook" src="{{url('assets/images/socials/facebook_icon2.png')}}" style="display: inline-block;" width="32" height="32" border="0" title="{{$SITE_NAME}} Facebook"></a>&nbsp;
                @endif
                @if(isset($SOCIAL_TWITTER_LINK) && !empty($SOCIAL_TWITTER_LINK))
                  <a href="{{$SOCIAL_TWITTER_LINK}}" style="color:#ededed;">
                  <img alt="{{$SITE_NAME}} Twitter" src="{{url('assets/images/socials/twitter_icon2.png')}}" title="{{$SITE_NAME}} Twitter" style="display: inline-block;" width="32" height="32" border="0"></a>&nbsp;
                @endif
                @if(isset($SOCIAL_LINKEDIN_LINK) && !empty($SOCIAL_LINKEDIN_LINK))
                  <a href="{{$SOCIAL_LINKEDIN_LINK}}" style="color:#ededed;">
                  <img alt="{{$SITE_NAME}} Linkedin" src="{{url('assets/images/socials/linkedin_icon2.png')}}" title="{{$SITE_NAME}} Linkedin" style="display: inline-block;" width="32" height="32" border="0"></a>&nbsp;
                @endif
                @if(isset($SOCIAL_YOUTUBE_LINK) && !empty($SOCIAL_YOUTUBE_LINK))
                  <a href="{{$SOCIAL_YOUTUBE_LINK}}" style="color:#ededed;">
                  <img alt="{{$SITE_NAME}} Youtube" src="{{url('assets/images/socials/youtube_icon2.png')}}" title="{{$SITE_NAME}} Youtube" style="display: inline-block;" width="32" height="32" border="0"></a>&nbsp;
                @endif
                @if(isset($Google_Plus_Link) && !empty($Google_Plus_Link))
                  <a href="{{$Google_Plus_Link}}" style="color:#ededed;">
                  <img alt="{{$SITE_NAME}} Google Plus" src="{{url('assets/images/socials/google_plus_icon2.png')}}" title="{{$SITE_NAME}} Google Plus" style="display: inline-block;" width="32" height="32" border="0"></a>
                @endif  
                </span>
              </td>
            </tr>
            <tr style="width:100%">
              <td style="text-align:center;padding:0; font-size:14px; color:#484659;">
                <p style="font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;padding:0;margin:0">{!!$FOOTER_COPYRIGHTS!!} {!!$FOOTER_YEAR!!} {{$SITE_NAME}}! - All Rights Reserved.</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  </center>
</body>
</html>