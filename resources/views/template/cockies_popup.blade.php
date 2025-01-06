<div class="popup cockies_popup gdpr_code p16 bg-black-700 fc-white ps-fixed b0 l0 r0 z-banner"  id="js-gdpr-consent-banner" role="banner" aria-hidden="false" style="display:none;">
    <div class="section wmx10 mx-auto grid grid__center jc-spacebetween gs8 gsx" role="alertdialog" aria-label="Cookies Alert" aria-describedby="notice-message">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                    <p id="notice-message">This site uses cookies:&nbsp; <a title="This site uses cookies to serve our products/services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Your use of {{ Config::get('Constant.SITE_NAME') }} Products/Services is subject to these policies." target="_blank" href="{{url('/privacy-policy')}}">Find out more</a></p>
                    <!-- <a class="close_cookies_popup" href="javascript:void(0)" id="close-cookies" onclick="GetGDPRCLOSE()" >X</a> -->
                    <a href="javascript:void(0)" id="accept-button" class="btn" onclick="GetGDPRCLOSE()">Accept</a>
                </div>
            </div>
        </div>
    </div>
</div>