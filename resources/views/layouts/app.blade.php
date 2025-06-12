<!DOCTYPE html>
<html lang="en-in">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
@if(Request::segment(1) =='login')
           <?php 
$META_TITLE ='Host IT Smart Web Hosting Login';
$META_DESCRIPTION ='Secure and easy login to Host IT Smart web hosting. Access your hosting account to manage domains, websites, and email. Login now for reliable hosting services.';
            ?>
         @endif
         <?php 
$live_url = url()->current();
$global_url = str_replace("www","global",$live_url);
$setnoindex = array("linux-hosting-godaddy-alternative","linux-hosting-hostgator-alternative","linux-hosting-ideastack-alternative","linux-hosting-b4uindia-alternative","linux-reseller-hosting-bigrock-alternative","linux-reseller-hosting-hostgator-alternative","linux-reseller-hosting-milesweb-alternative","linux-reseller-hosting-ideastack-alternative","linux-reseller-hosting-go4hosting-alternative","linux-reseller-hosting-hostingraja-alternative","windows-reseller-hosting-bigrock-alternative","linux-reseller-hosting-hostgator-alternative","windows-reseller-hosting-hostgator-alternative","windows-reseller-hosting-ideastack-alternative","windows-reseller-hosting-go4hosting-alternative","windows-reseller-hosting-b4uindia-alternative","windows-reseller-hosting-hostripples-alternative","windows-reseller-hosting-resellerclub-alternative","vps-hosting-bigrock-alternative","vps-hosting-godaddy-alternative","vps-hosting-hostgator-alternative","vps-hosting-milesweb-alternative","vps-hosting-hostinger-alternative","vps-hosting-ideastack-alternative","vps-hosting-go4hosting-alternative","vps-hosting-b4uindia-alternative");
$canada_url = str_replace("com","ca",$live_url);
$alternative = array("linux-hosting-b4uindia-alternative","linux-hosting-bigrock-alternative", "linux-hosting-godaddy-alternative","linux-hosting-hostgator-alternative","linux-hosting-ideastack-alternative","linux-reseller-hosting-bigrock-alternative","linux-reseller-hosting-go4hosting-alternative","linux-reseller-hosting-hostgator-alternative","linux-reseller-hosting-hostingraja-alternative","linux-reseller-hosting-ideastack-alternative","linux-reseller-hosting-milesweb-alternative","vps-hosting-b4uindia-alternative","vps-hosting-bigrock-alternative","vps-hosting-go4hosting-alternative","vps-hosting-godaddy-alternative","vps-hosting-hostgator-alternative","vps-hosting-hostinger-alternative","vps-hosting-ideastack-alternative","vps-hosting-milesweb-alternative","windows-reseller-hosting-b4uindia-alternative","windows-reseller-hosting-bigrock-alternative","windows-reseller-hosting-go4hosting-alternative","windows-reseller-hosting-hostgator-alternative","windows-reseller-hosting-hostripples-alternative","windows-reseller-hosting-ideastack-alternative","windows-reseller-hosting-resellerclub-alternative","affiliate-policy","careers","web-hosting-affiliates","web-hosting-ahmedabad");
            $testimonial = array("abhishek-dutta","arnav-trivedi","artos-bible-quiz","aryan-ahuja","dheeraj-balpathak","kamlesh-gawali-2","mayank-goswami","muclix-systems","mute-break","pulkit-shah","zayka-grains","buy-io-domain-names","forex-vps-hosting","nirmal-paradkar","ivaylo-nikolov","divyanshu-agarwal","sameer-shaikh","shatrughan-saravagi","s2-tech-india","nikhil-jain","shivang-kareliya","learntez","prahlad-shukla");
            $canada_domain = "https://www.hostitsmart.ca";
            $canada_urls = array("{$canada_domain}/domain-registration","{$canada_domain}/domain/domain-transfer","{$canada_domain}/whois-checker","{$canada_domain}/hosting/shared-hosting","{$canada_domain}/hosting/wordpress-hosting","{$canada_domain}/hosting/windows-hosting","{$canada_domain}/servers/vps-hosting","{$canada_domain}/servers/windows-vps-hosting","{$canada_domain}/servers/dedicated-servers","{$canada_domain}/ssl-certificates","{$canada_domain}/web-hosting","{$canada_domain}/tld","{$canada_domain}/about-us","{$canada_domain}/why-hits","{$canada_domain}/contact","{$canada_domain}/faqs","{$canada_domain}/domain-policy","{$canada_domain}/terms","{$canada_domain}/payment-options","{$canada_domain}/privacy-policy","{$canada_domain}/deals","{$canada_domain}/servers/linux-vps-hosting");?>
        <!-- Google Tag Manager -->
<script>setTimeout(function(){(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-P39GJB');}, 6000);</script>
        <!-- End Google Tag Manager -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  {{-- font cdn  St--}}
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
   {{-- font cdn end--}}
<meta name="msvalidate.01" content="1FF75C85A9329C6232704ED8A37D9260" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $META_TITLE }}</title>
{{-- <meta name="keywords" content="{{ $META_KEYWORD }}"> --}}
<meta name="description" content="{{ $META_DESCRIPTION }}">
@if (in_array(Request::segment(1), $setnoindex))
<meta name="robots" content="noindex">
@endif
@if($live_url == "https://www.hostitsmart.com/servers")
<?php  $live_url = "https://www.hostitsmart.com/servers/";?>
@endif
@if(Request::segment(1) == 'web-hosting-ahmedabad')
<link rel="canonical" href="https://www.hostitsmart.com/web-hosting" />
<link rel="alternate" href="https://www.hostitsmart.com/web-hosting-ahmedabad" hreflang="en-in" />
<link rel="canonical" href="https://www.hostitsmart.com/web-hosting-ahmedabad" />
@endif
@if(Request::segment(1) != 'testimonials' && Request::segment(1) != 'tld' && Request::segment(1) != 'web-hosting-ahmedabad')
<link rel="canonical" href="{{ $live_url }}" />
<link rel="alternate" href="{{ $live_url }}" hreflang="en-in" />
@endif
@if (!in_array(Request::segment(1), $alternative)) 
@if(!in_array(Request::segment(2),$testimonial))
<link rel="alternate" hreflang="x-default" href="{{$global_url}}" />  
<link rel="alternate" href="{{$global_url}}" hreflang="en-us" />
@endif
@if(Request::segment(2) =='linux-hosting')
<?php $canada_url=str_replace("linux-hosting","shared-hosting",$canada_url);?>
@endif
@if(in_array($canada_url,$canada_urls))
<link rel="alternate" href="{{$canada_url}}" hreflang="en-ca" />
@endif
@endif
@if(Request::segment(1) == 'testimonials' && !in_array(Request::segment(2), ['nirmal-paradkar','ivaylo-nikolov','divyanshu-agarwal', 'sameer-shaikh','shatrughan-saravagi','s2-tech-india','nikhil-jain','shivang-kareliya','learntez']))
<?php $test_page = request()->query('page'); ?>
@if($test_page == 0)
<link rel="canonical" href="{{$live_url}}" />
<link rel="next" href="{{$live_url}}?page={{ $test_page + 2 }}">
<link rel="alternate" href="{{ $live_url }}" hreflang="en-in" />
@elseif($test_page == 2)
<link rel="canonical" href="{{$live_url}}" />
<link rel="prev" href="{{$live_url}}">
<link rel="alternate" href="{{$live_url}}?page={{ $test_page }}" hreflang="en-in" />
@elseif($test_page == 3)
<link rel="canonical" href="{{$live_url}}" />
<link rel="prev" href="{{$live_url}}?page={{ $test_page - 1 }}">
<link rel="alternate" href="{{$live_url}}?page={{ $test_page }}" hreflang="en-in" />
@endif
@endif
@if(Request::segment(1) == 'tld' )
<?php $test_page = request()->query('page'); ?>
@if($test_page == 0)
<link rel="canonical" href="{{$live_url}}" />
<link rel="next" href="{{$live_url}}?page={{ $test_page + 2 }}">
<link rel="alternate" href="{{ $live_url }}" hreflang="en-in" />
@else   
@for($i = $test_page - 1; $i <= $test_page + 1; $i++)
@if($i > 0 && $i <= 35)
@if($i == $test_page)
<link rel="canonical" href="{{ $live_url }}" />
<link rel="alternate" href="{{$live_url}}?page={{ $test_page }}" hreflang="en-in" />
@elseif($i == $test_page - 1)
<link rel="prev" href="{{ $live_url }}?page={{ $i }}" />
@elseif($i == $test_page + 1)
<link rel="next" href="{{ $live_url }}?page={{ $i }}" />
@elseif($i == 35)
<link rel="prev" href="{{ $live_url }}?page={{ $i - 1 }}" />
@endif
@endif
@endfor
@endif
@endif
<meta name="author" content="">
<meta property="og:url" content="{{ Request::fullUrl() }}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $META_TITLE }}" />
<meta property="og:description" content="{{ $META_DESCRIPTION }}" />
<meta property="og:image" content="{{Config::get('Constant.CDNURL')}}/assets/images/logo.png" />
<meta name="twitter:card" content="{{ $META_DESCRIPTION }}" />
<meta name="twitter:title" content="{{ $META_TITLE }}" />
<meta name="twitter:url" content="{{ Request::fullUrl() }}" />
<meta name="twitter:description" content="{{ $META_DESCRIPTION }}" />
<meta name="twitter:image" content="{{Config::get('Constant.CDNURL')}}/assets/images/logo.png" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="google-site-verification" content="IurlRF0tvcVVq0ym55i9VqLQpk4krZyXaruZBPu2jvs" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

<!-- <link rel="stylesheet" href="{{Config::get('Constant.CDNURL')}}/assets/images/logo.png"/> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" ></script>
     
        

<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?> 
@if ( $live_url ==  URL::to('/') )
<!-- <link rel="stylesheet" href="{{ Config::get('Constant.CDNURL').'/assets/'.$themeversion.'/home_'.$themeversion.'.css' }}?v={{date('YmdHi')}}" media="all" /> -->
<link rel="preload" as="image" href="../assets/images/new_img/black-friday-bnnr2.webp">
<link rel="preload" as="image" href="../assets/images/new_img/black-friday-BG.webp">
@else
<!-- <link rel="stylesheet" href="{{ Config::get('Constant.CDNURL').'/assets/'.$themeversion.'/main_'.$themeversion.'.css' }}?v={{date('YmdHi')}}" media="all" /> -->
@endif
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/custom.css?v={{date('YmdHi')}}" media="all" />
<link rel="stylesheet" href="/assets/css/common.css?v={{date('YmdHi')}}" media="all" />

@if(Request::segment(2)=='website-builder')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/website-builder.css?v={{date('YmdHi')}}" media="all" />

             @endif
<?php /* <link rel="stylesheet" href="{{ Config::get('Constant.CDNURL').'/assets/'.$themeversion.'/aos_'.$themeversion.'123.css' }}" media="all" /> */ ?>
{{--  Vk 4/12/2019 End  --}}
<link rel="stylesheet" href="{{Config::get('Constant.CDNURL')}}/assets/css/domain-landing.css?v={{date('YmdHi')}}" media="all" />
@if(Request::segment(2)=='linux-hosting' || Request::segment(1)=='linux-hosting-godaddy-alternative' || Request::segment(1)=='linux-hosting-bigrock-alternative' || Request::segment(1)=='linux-hosting-hostgator-alternative' || Request::segment(1)=='linux-hosting-ideastack-alternative' || Request::segment(1)=='linux-hosting-b4uindia-alternative')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/linux-hosting.css?v={{date('YmdHi')}}" media="all" />
<link rel="stylesheet" href="{{Config::get('Constant.CDNURL')}}/assets/css/combo-offer.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(1)=='linux-hosting-godaddy-alternative' || Request::segment(1)=='linux-hosting-bigrock-alternative' || Request::segment(1)=='linux-hosting-hostgator-alternative' || Request::segment(1)=='linux-hosting-ideastack-alternative' || Request::segment(1)=='linux-hosting-b4uindia-alternative')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/linux-compare.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(2)=='newconfig' || Request::segment(2)=='signin'|| Request::segment(2)=='billinginfo' || Request::segment(2)=='paymentoptions')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/newconfig.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(1)=='web-hosting' || Request::segment(1)=='web-hosting-ahmedabad' || Request::segment(2)=='linux-hosting')

@endif
<link rel="icon" href="{{Config::get('Constant.CDNURL')}}/assets/images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" sizes="144x144" href="{{Config::get('Constant.CDNURL')}}/assets/images/apple-touch-icon-144.png" />
<link rel="apple-touch-icon" sizes="114x114" href="{{Config::get('Constant.CDNURL')}}/assets/images/apple-touch-icon-114.png" />
<link rel="apple-touch-icon" sizes="72x72" href="{{Config::get('Constant.CDNURL')}}/assets/images/apple-touch-icon-72.png" />
<link rel="apple-touch-icon" sizes="57x57" href="{{Config::get('Constant.CDNURL')}}/assets/images/apple-touch-icon-57.png" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



        <!-- owl-carousel-cdn-s -->

         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

         <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
         
        <!-- owl-carousel-cdn-e -->


        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.js"></script>


        {{-- <script src="{{Config::get('Constant.CDNURL')}}/assets/js/jquery-3.3.1.min.js"></script> --}}
{!! (!empty(Config::get('Constant.GOOGLE_ANALYTIC_CODE'))?Config::get('Constant.GOOGLE_ANALYTIC_CODE'):'') !!}
        {{-- <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800&display=swap" rel="stylesheet"> --}}
@if(Request::segment(1)=='web-hosting-affiliates')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/affiliate.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(1)=='affiliate-policy')
<link rel="stylesheet" href="../assets/css/affiliate_policy.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(2)=='java-hosting')
<link rel="stylesheet" href="../assets/css/java-hosting.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(1)=='why-hits')
<link rel="stylesheet" href="../assets/css/why-hits.css?v={{date('YmdHi')}}" media="all" />
@endif
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/new-header23.css?v={{date('YmdHi')}}" media="all" />
@if(Request::segment(1) == '')
<link rel="stylesheet" href="../assets/css/homepage.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(1)=='domain-registration'|| Request::segment(1)=='domain')
<link rel="stylesheet" href="../assets/css/domain_registration.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(2)=='domain-transfer')
<link rel="stylesheet" href="../assets/css/domain-transfer.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(1)=='domain-checker')
<link rel="stylesheet" href="../assets/css/domain-checker.css?v={{date('YmdHi')}}"/>
@endif
@if(Request::segment(1)=='tld')
<link rel="stylesheet" href="../assets/css/tld.css?v={{date('YmdHi')}}"/>
@endif
@if(Request::segment(2)=='thankyou')
<link rel="stylesheet" href="../assets/css/thankyou_page.css?v={{date('YmdHi')}}"/>
@endif
@if(Request::segment(2)=='bulk-domain-search')
<link rel="stylesheet" href="../assets/css/bulk-domain-search.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(1)=='whois')
<link rel="stylesheet" href="../assets/css/whois.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(1)=='domain-privacy-protection')
<link rel="stylesheet" href="../assets/css/domain-privacy-protection.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(2)=='vps-hosting' || Request::segment(2)=='managed-vps-hosting' || Request::segment(2)=='linux-vps-hosting' || Request::segment(2)=='vps-hosting-india')
<link rel="stylesheet" href="../assets/css/linux_vps_hosting.css?v={{date('YmdHi')}}"/>
     
@endif
@if(Request::segment(2)=='windows-hosting')
<link rel="stylesheet" href="../assets/css/windows_hosting.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(2)=='wordpress-hosting')
<link rel="stylesheet" href="../assets/css/wordpress-hosting.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(2)=='ecommerce-hosting')
<link rel="stylesheet" href="../assets/css/ecommerce-hosting.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(1)=='deals')
<link rel="stylesheet" href="../assets/css/deals.css?v={{date('YmdHi')}}"/>

@endif
@if(Request::segment(2)=='windows-vps-hosting')
<link rel="stylesheet" href="../assets/css/windows_vps_hosting.css?v={{date('YmdHi')}}"/>
<link rel="stylesheet" href="../assets/css/windows_vps_banner-24.css?v={{date('YmdHi')}}" media="all" />

@endif
@if(Request::segment(2)=='forex-vps-hosting')
<link rel="stylesheet" href="../assets/css/forex_vps_hosting.css?v={{date('YmdHi')}}"/>
<link rel="stylesheet" href="../assets/css/forex_vps_banner-24.css?v={{date('YmdHi')}}" media="all" />

@endif
@if(Request::segment(2)=='dedicated-servers')
<link rel="stylesheet" href="../assets/css/dedicated_server.css?v={{date('YmdHi')}}"/>
<link rel="stylesheet" href="../assets/css/dedicated_server_banner_24.css?v={{date('YmdHi')}}"/>  
      
@endif
@if(Request::segment(2)=='google-workspace-india')
<link rel="stylesheet" href="../assets/css/g-apps.css?v={{date('YmdHi')}}"/>
<link rel="stylesheet" href="../assets/css/google-apps.css?v={{date('YmdHi')}}"/>
      
@endif
@if(Request::segment(2)=='microsoft-office-365-suite')
<link rel="stylesheet" href="../assets/css/microsoft-office.css?v={{date('YmdHi')}}"/>
      
@endif
@if(Request::segment(1)=='ssl-certificates')
<link rel="stylesheet" href="../assets/css/ssl-certificates.css?v={{date('YmdHi')}}"/>
      
@endif
@if(Request::segment(2)=='site-lock')
<link rel="stylesheet" href="../assets/css/site-lock.css?v={{date('YmdHi')}}"/>
      
@endif
@if(Request::segment(1)=='aws-support-services')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/aws-support.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(2)=='newconfig')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/newconfig.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(1)=='about-us')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/about-us.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(1)=='contact')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/contact-us.css?v={{date('YmdHi')}}" media="all" />
@endif
@if(Request::segment(1)=='terms' || Request::segment(1)=='privacy-policy')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/terms.css?v={{date('YmdHi')}}" media="all" />
@endif

    @if(Request::segment(1)=='domain')
    <link rel="stylesheet" href="../assets/css/buy-com-domain-names.css?v={{date('YmdHi')}}" />
    @endif
@if(Request::segment(1)=='web-hosting' || Request::segment(1)=='web-hosting-ahmedabad')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/Web_Hosting.css?v={{date('YmdHi')}}" media="all" />
<link rel="stylesheet" href="../assets/css/web_hosting_banner_24.css?v={{date('YmdHi')}}"/>    
<link rel="preload" as="image" href="../assets/images/new_img/black-friday-bnnr2.webp">
<link rel="preload" as="image" href="../assets/images/new_img/black-friday-BG.webp">    
@endif
@if(Request::segment(2)=='billinginfo')
<link rel="stylesheet" href="{{URL::to('/')}}/assets/css/popup_banner_shared_hosting_24.css?v={{date('YmdHi')}}" media="all" />
@endif
<script src="https://www.hostitsmart.com/assets/js/vendors/magnific-popup.min.js?v=202311040647"></script>
<script src="https://www.hostitsmart.com/assets/js/vendors/hs.megamenu.js?v=202311040647"></script>
<script src="https://www.hostitsmart.com/assets/js/vendors/jquery.rcounterup.js?v=202311040647"></script>
<script src="https://www.hostitsmart.com/assets/js/vendors/owl.carousel.min.js?v=202311031254"></script>






<style type="text/css">
        /*---------SSL certificate------------*/
    
.Brand-Smart-icon,.data-protection-icon,.google-ranking-icon,.padlock-icon,.warning-icon{align-self:center;display:block;margin:auto}.ssl-crtificate-main hr{margin-top:3rem;margin-bottom:2rem}.padlock-icon{background:url(/assets/images/ssl-sprite.png) left top no-repeat;width:50px;height:50px}.google-ranking-icon{background:url(/assets/images/ssl-sprite.png) -51px top no-repeat;width:50px;height:50px}.warning-icon{background:url(/assets/images/ssl-sprite.png) -104px top no-repeat;width:45px;height:49px}.Brand-Smart-icon{background:url(/assets/images/ssl-sprite.png) left -52px no-repeat;width:50px;height:52px}.data-protection-icon{background:url(/assets/images/ssl-sprite.png) -50px -52px no-repeat;width:51px;height:44px}.credibility-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") left top no-repeat;width:53px;height:56px;display:block}.brand-building-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") -54px top no-repeat;width:51px;height:48px;display:block}.about_description .about-text{padding-left:45px;position:relative}.about_description .about-text i.domain-registration-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") -106px top no-repeat;width:33px;height:33px;position:absolute;left:0;top:3px}.data-security-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") -142px top no-repeat;width:54px;height:49px;display:block}.cPanel-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") 0 -58px no-repeat;width:64px;height:43px;display:block}.managed-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") -66px -58px no-repeat;width:52px;height:52px;display:block}.fast-setting-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") -120px -58px no-repeat;width:54px;height:54px;display:block}.processors-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") left -104px no-repeat;width:54px;height:53px;display:block}.scalability-icon{background:url("{{url('/')}}/assets/images/domain-registration-sprite.png") -56px -113px no-repeat;width:54px;height:57px;display:block}#sidemenu.affix,#sidemenu.affix-top{position:static}#sidemenu.affix-bottom{position:relative}@media (min-width:1025px){#sidemenu.affix{position:fixed;top:150px;max-width:443px}}
/*===============domain-registration-icon==========*/
/*===============21-sept-icon==========*/
.uptime-icon{background:url("{{url('/')}}/assets/images/hosting-sprite.png") -1px -232px no-repeat;width:55px;height:56px;display:block}.firewall-protection-icon{background:url("{{url('/')}}/assets/images/hosting-sprite.png") -59px -232px no-repeat;width:75px;height:42px;display:block}.hidden-charges-icon{background:url("{{url('/')}}/assets/images/hosting-sprite.png") -137px -230px no-repeat;width:53px;height:53px;display:block}.fast-java-web-hosting-icon{background:url("{{url('/')}}/assets/images/hosting-sprite.png") -64px -110px no-repeat;width:59px;height:71px;display:block}
/*===============21-sept-icon==========*/
</style>
<script>
var doc=document.documentElement;doc.setAttribute("data-useragent",navigator.userAgent);
</script>
@include('template.faq_seoschema')
{{-- christmas-2021 start --}}
{{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
{{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Denk+One&display=swap" rel="stylesheet"> --}}
{{-- christmas-2021 end --}}
<?php /*<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet"> */?><?php /*<link rel="stylesheet" href="{{Config::get('Constant.CDNURL')}}/assets/css/main_v28.css" media="all" />*/?>
<?php /*<link rel="stylesheet" href="{{url('/')}}/assets/css/main_v3.css" media="all" />*/?>
</head>
    <?php 
        $bodyCls = "";
        $segment =  Request::segment(1);  
        if(isset($segment) && $segment == 'domain-checker'){ 
            //remove hideheader class for make sticky domain search bar and display header on front.
            //$bodyCls = "hideheader";
            $bodyCls ="";
             }
    ?>
<body onload="checkCookie();" class="{{$bodyCls}}">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P39GJB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<noscript id="deferred-styles"></noscript>
{!! (!empty(Config::get('Constant.GOOGLE_TAG_MANAGER_FOR_BODY'))?Config::get('Constant.GOOGLE_TAG_MANAGER_FOR_BODY'):'') !!}
<div class="loader" id="web_loader" style="display: none; z-index: 10001">
<div class="UpdateProgress123" id="loadertext">
<img alt="loader" src="{{Config::get('Constant.CDNURL')}}/assets/images/ajaxloader2.gif" loading="lazy"/> </div>
</div>
<div id="transfer_loading"></div>
<script type="text/javascript">function showLoader() { $("#web_loader").show(); } function hideLoader() { $("#web_loader").hide(); }</script>
        <!-- <div id="buorg" class="buorg">
            <div class="buorg01"><i class="fa fa-exclamation-triangle"></i>&nbsp;
                <div class="buorg02">For a better experience on <strong>Host IT Smarts,</strong> <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie" class="buorg03" style="cursor:pointer" target="_blank">update your browser.</a> </div></div>
        </div> -->
        <div id="wrapper">

        @php
            if ($themeversion == 'theme_v1')
                if (Request::segment(2) == "forex-vps-hosting") {
                    $theme_header_class = 'forex_header';
                }else{
                    $theme_header_class = 'inner_header';
                }
            else
                $theme_header_class = '';
        @endphp

        {{-- header start from here  --}}
        {{-- cart full alert popup start --}}
        @if ($message = Session::get('cartfull'))
        <div class="modal fade cartfull-popup" id="cartfull-popup" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close close-popup" id="close-cartfull-popup" data-bs-dismiss="modal">X</button>
                      <h2 class="modal-title">Cart alert!</h2>
                  </div>
                  <div class="modal-body">
                    <h2 class="modal-title">{!! $message !!}</h2>
                  </div>
              </div>
          </div>
        </div>
        <script> $(function(){ $('#cartfull-popup').modal('show'); }) </script>
        @endif
        {{-- cart full alert popup end --}}


        <header class="header_section {{ $theme_header_class }}">
            {{-- Display maintenance start --}}
            @if (!empty(Config::get('Constant.DISPLAY_MAINTENANCE')) && Config::get('Constant.DISPLAY_MAINTENANCE') === "Y" && !empty(Config::get('Constant.MAINTENANCE_TEXT')) )
            <div class="top-header text-center" id="top_bar" style="z-index:9999 !important;">
                <div class="container">
                <div class="top_buy">
                    <a id="goto_legacy" href="{{ !empty(Config::get('Constant.DISPLAY_MAINTENANCE_LINK')) ? Config::get('Constant.DISPLAY_MAINTENANCE_LINK') : 'javascript:void(0);' }}" title="" style="color:#fff !important;">
                    {!! !empty(Config::get('Constant.MAINTENANCE_TEXT')) ? Config::get('Constant.MAINTENANCE_TEXT') : "" !!}
                    </a>
                </div>
                </div>
            </div>	
            @endif
            {{-- Display maintenance end --}}
            <script> var ajax_uagent='{{$uagent}}'; </script>
              @if(Request::segment(1) != "login" && Request::segment(1) != "reset-passwod" && Request::segment(1) != "forgot-password")
            @include('template.'.$themeversion.'.header')
            @endif
            @yield('content')
              @if(Request::segment(1) != "login" && Request::segment(1) != "reset-passwod" && Request::segment(1) != "forgot-password")
            @include('template.'.$themeversion.'.footer')
            @endif

            <!-- S vk script 29_9_2002 check terms -->
            {{-- <script src="{{ asset("assets/js/countdown.min.js?v=".date('YmdHi')) }}"></script>
            <script>
                setTimeout(() => {
                    $('#clock').countdown('2021/11/15 11:59:59', function (event) {
                        $(this).html(event.strftime('' + '<div class="row">' + '<div class="col">' + '<h2 class="mb-0">%-D</h2>' + '<h5 class="mb-0">Day%!d</h5>' + '</div>' + '<div class="col">' + '<h2 class="mb-0">%H</h2>' + '<h5 class="mb-0">Hours</h5>' + '</div>' + '<div class="col">' + '<h2 class="mb-0">%M</h2>' + '<h5 class="mb-0">Minutes</h5>' + '</div>' + '<div class="col">' + '<h2 class="mb-0">%S</h2>' + '<h5 class="mb-0">Seconds</h5>' + '</div>' + '</div>'));
                    });
                }, 1000);
            </script> --}}
            <script src="{{URL::to('/')}}/assets/js/custom.js?v={{date('YmdHi')}}"></script>
            <script>var _scrollto_id = "{{!empty(request('scrollto')) ? '#'.request('scrollto') : ''}}";</script>
            <!-- E vk script 29_9_2002 check terms -->
        </div>
        {{-- timmer S --}}
         
        {{-- timmer E --}}
             
              @if(Request::segment(1) == "login" || Request::segment(1) == "forgot-password" || Request::segment(1) == "reset-password")
    <!-- <script src="{{ Config::get('Constant.CDNURL') }}/assets/js/common_v12.js?v={{date('YmdHi')}}" type="text/javascript"></script> -->
         <script src="{{url('/')}}/assets/js/common_v12.js?v={{date('YmdHi')}}" type="text/javascript"></script>
    <script>
        var APP_URL = 'https://www.hostitsmart.com';
    </script>
@endif
 {{-- @if (Request::segment(1) != 'cart' && Request::segment(2) != 'paymentoptions') --}}
            @include('cart.google-analytics-code')
            {{-- @endif   --}}
</body>
 
    </body>
</html>