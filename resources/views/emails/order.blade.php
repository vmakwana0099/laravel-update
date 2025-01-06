<html>
    <head>
         <title>{{$SITE_NAME}}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

        <table id="Table_01" width="600" align="center"  border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td style="background: #115BA9;text-align: center;padding: 20px 0;">
            <a href="javascript:void(0)"><img src="{{url('assets/images/email-template/logo.png')}}" alt="HostITSmart"></a>
        </td>
    </tr>
    <tr>
        <td style="padding: 35px 0;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="text-align: center">
                        <strong style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 24px;color: #115BA9;letter-spacing: 1px;">Dear {{ $name }},</strong>
                        <span style="display: block;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 24px;color: #115BA9;letter-spacing: 1px;">Thank you for your order</span>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size:16px;color: #000000;text-align: center;padding-top: 20px;letter-spacing:0.75px;">
                        Here's your confirmation for order number <strong style="color: #115BA9;">#{{ $orderid }}</strong>.<br/>
                        Review your receipt and get started using your products.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="background-color: #F1F5F7;">
            <table style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                    <th style="text-align: left;padding: 13px 10px 13px 30px;font-size:  16px;color: #000000;font-family:  'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-weight:  500;border-bottom: 1px solid #B6B9BA;">Product</th>
                    <th style="text-align: center;padding: 13px 10px 13px 10px;font-size:  16px;color: #000000;font-family:  'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-weight: 500;border-bottom: 1px solid #B6B9BA;">Term</th>
                    <th style="text-align: right;padding: 13px 30px 13px 10px;font-size:  16px;color: #000000;font-family:  'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-weight: 500;border-bottom: 1px solid #B6B9BA;">Price</th>
                </tr>
                @if(isset($orderitems) && !empty($orderitems))
                    @foreach($orderitems as $item)
                      <tr>
                        <td style="padding: 15px 10px 15px 30px;border-bottom: 1px solid #B6B9BA;">
                            <a href="#" title="JalsaEvent.com" style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';color: #034183;font-size: 16px;font-weight: 500;text-decoration: none;">@if($item['type'] == 'domain') {{ $item['producttype'] }}  @endif {{ $item['product'] }}</a>
                            <span style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';display: block;font-size: 16px;font-weight: 500;color: #000000;padding: 12px 0 15px">{{ $item['domain'] }}</span>
                        </td>
                        <td style="padding: 15px 10px 15px 10px;text-align: center;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 16px;color: #000000;border-left: 1px solid #B6B9BA;vertical-align: top;border-bottom: 1px solid #B6B9BA;">{{ $item['billingcycle'] }} @if($item['type'] == 'domain') @if($item['billingcycle'] > 1) Years  @else Year  @endif @endif</td>
                        <td style="padding: 15px 30px 15px 10px;text-align: right;font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 16px;font-weight: 700;color: #000000;border-left: 1px solid #B6B9BA;vertical-align: top;border-bottom: 1px solid #B6B9BA;">{!! $currency_code !!}{{ $item['amount'] }}</td>
                    </tr>
                    @endforeach
                @endif
                
            </table>
        </td>
    </tr>
    <tr>
        <td style="background-color: #F1F5F7;">
            <table style="width:280px;float: right" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 16px;font-weight: 600;color: #000000;text-align: right;width:80px;border-bottom: 1px solid #B6B9BA;">Subtotal:</td>
                    <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 16px;font-weight: 700;color: #000000;text-align: right;border-bottom: 1px solid #B6B9BA;padding: 15px 30px 15px 0;"><i style="font-family: sans-serif;font-style: normal;font-size: 15px;">{!! $currency_code !!}</i>{{ $subtotal }}</td>
                </tr>
                <tr>
                    <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 16px;font-weight: 600;color: #000000;text-align: right;width:80px;border-bottom: 1px solid #B6B9BA;">Tax:</td>
                    <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 16px;font-weight: 700;color: #000000;text-align: right;border-bottom: 1px solid #B6B9BA;padding: 15px 30px 15px 0"><i style="font-family: sans-serif;font-style: normal;font-size: 15px;">{!! $currency_code !!}</i>{{ $tax }}</td>
                </tr>
                <tr>
                    <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 20px;font-weight: 600;color: #000000;text-align: right;width:80px;background-color: #EEECEC;">TOTAL:</td>
                    <td style="font-family: 'Segoe UI', 'Apple SD Gothic Neo', 'Lucida Grande', 'Lucida Sans Unicode', 'sans-serif';font-size: 20px;font-weight: 700;color: #18B35C;text-align: right;padding: 15px 30px 15px 0;background-color: #EEECEC;"><i style="font-family: sans-serif;font-style: normal;font-size: 19px;margin-right: 2px;">{!! $currency_code !!}</i>{{ $total }}</td>
                </tr>
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