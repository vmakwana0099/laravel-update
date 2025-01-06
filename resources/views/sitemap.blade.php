@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')

<div class="inner_container sitemap_sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-6">
                <div class="sitemap-m">
                    <h6>Home</h6>
                    <ul>
                        <li><a href="{{ url('/') }}" title="Home">Host IT Smart Homepage</a></li>
                    </ul>
                    </div>
                
                    <div class="sitemap-m">
                    <h6>Servers</h6>
                    <ul>
                        <li><a href="{{ url('/servers/vps-hosting') }}" title="VPS Hosting">VPS Hosting</a></li>
                        <li><a href="{{ url('/servers/linux-vps-hosting') }}" title="Linux VPS Hosting">Linux VPS Hosting</a></li>
                        <li><a href="{{ url('/servers/windows-vps-hosting') }}" title="Windows VPS Hosting">Windows VPS Hosting</a></li>
                        <li><a href="{{ url('/servers/managed-vps-hosting') }}" title="Managed VPS Hosting">Managed VPS Hosting</a></li>
                        <li><a href="{{ url('/servers/forex-vps-hosting') }}" title="Forex VPS Hosting">Forex VPS Hosting</a></li>
                        <li><a href="{{ url('/servers/dedicated-servers') }}" title="Dedicated Server Hosting">Dedicated Server Hosting</a></li>
                    </ul>
                </div>
                    
                    
            <div class="sitemap-m">
                <h6>Other Products</h6>
                <ul>
                    <li><a href="{{ url('/hosting/website-builder') }}" title="Website Builder">Website Builder</a></li>
                    <li><a href="{{ url('/ssl-certificates') }}" title="SSL Certificate">SSL Certificate</a></li>
                    <li><a href="{{ url('/aws-support-services') }}" title="AWS Support">AWS Support</a></li>
                    <li><a href="{{ url('/email/google-workspace-india') }}" title="Google Workspace">Google Workspace</a></li>
                    <li><a href="{{ url('/email/microsoft-office-365-suite') }}" title="Microsoft 365">Microsoft 365</a></li>
                </ul>
            </div>
            </div>

            <div class="col-lg-3 col-md-3 col-6">
                <div class="sitemap-m">
                    <h6>Domain</h6>
                    <ul>
                        <li><a href="{{ url('/domain-registration') }}" title="Domain Register">Domain Register</a></li>
                        <li><a href="{{ url('/domain/domain-transfer') }}" title="Domain Transfer">Domain Transfer</a></li>
                        <li><a href="{{ url('domain/bulk-domain-search') }}" title="Bulk Domain Search">Domain Bulk Search</a></li>
                        <li><a href="{{ url('/tld') }}" title="Domain Pricing">Domain Pricing</a></li>
                        <li><a href="{{ url('/domain-privacy-protection') }}" title="Domain Privacy">Domain Privacy</a></li>
                        <li><a href="{{ url('/new-extensions') }}" title="New Extensions">New Domain Extensions</a></li>
                        <li><a href="{{ url('/whois') }}" title="Whois">Whois Checker</a></li>
                    </ul>
                </div>
                
            <div class="sitemap-m">
                <h6>Deals & Offers</h6>
                <ul>
                    <li><a href="{{ url('/deals') }}" title="Deals">Deals</a></li>
                </ul>
            </div>
            
            <div class="sitemap-m">
                <h6>Account</h6>
                <ul>
                    <li><a href="{{ url('/login') }}" title="Login">Login</a></li>
                </ul>
            </div>

            </div>

            <div class="col-lg-3 col-md-3 col-6">
                <div class="sitemap-m">
                    <h6>Hosting</h6>
                    <ul>
                        <li><a href="{{ url('/web-hosting') }}" title="Web Hosting">Web Hosting</a></li>
                        <li><a href="{{ url('/hosting/linux-hosting') }}" title="Linux Hosting">Linux Hosting</a></li>
                        <li><a href="{{ url('/hosting/windows-hosting') }}" title="Windows Hosting">Windows Hosting</a></li>
                        <li><a href="{{ url('/hosting/wordpress-hosting') }}" title="Wordpress Hosting">Wordpress Hosting</a></li>
                        <li><a href="{{ url('/hosting/ecommerce-hosting') }}" title="eCommerce Hosting">eCommerce Hosting</a></li>
                        <li><a href="{{ url('/hosting/java-hosting') }}" title="Java Hosting">Java Hosting</a></li>
                        <li><a href="{{ url('/hosting/linux-reseller-hosting') }}" title="Linux Reseller Hosting">Linux Reseller Hosting</a></li>
                        <li><a href="{{ url('/hosting/windows-reseller-hosting') }}" title="Windows Reseller Hosting">Windows Reseller Hosting</a></li>
                    </ul>
                </div>
                
            <div class="sitemap-m">
                <h6>Resources</h6>
                <ul>
                    <li><a href="{{ url('/blog') }}" title="Blog">Blog</a></li>
                    <li><a href="{{ url('/manage/knowledgebase/') }}" title="Knowledgebase">Knowledgebase</a></li>
                    {{-- <li><a href="https://www.youtube.com/playlist?list=PLH-E6HR4144OtJbgJFadteerb7sw5ZsmO" title="Video Tutorials">Video Tutorials</a></li> --}}
                    <li><a href="{{ Config::get('Constant.SOCIAL_YOUTUBE_LINK') }}" title="Video Tutorials">Video Tutorials</a></li>
                </ul>
            </div>
            </div>

            <div class="col-lg-3 col-md-3 col-6">
            <div class="sitemap-m">
                        <h6>Company</h6>
                        <ul>
                            <li><a href="{{ url('/about-us') }}" title="About Us">About Us</a>
                            <li><a href="{{ url('/contact') }}" title="Contact Us">Contact Us</a>
                            <li><a href="{{ url('/careers') }}" title="Careers">Careers</a>
                            <li><a href="{{ url('/testimonials') }}" title="Testimonials">Testimonials</a>
                            <li><a href="{{ url('/terms') }}" title="Terms">Terms</a>
                            <li><a href="{{ url('/privacy-policy') }}" title="Privacy Policy">Privacy Policy</a>
                        </ul>
                    </div>
                <div class="sitemap-m">
                <h6>Social Media</h6>
                <ul>
                    <li><a href="{{ Config::get('Constant.SOCIAL_FB_LINK') }}" target="_blank" title="Facebook">Facebook</a></li>
                    <li><a href="{{ Config::get('Constant.SOCIAL_TWITTER_LINK') }}" target="_blank" title="Twitter">Twitter</a></li>
                    <li><a href="{{ Config::get('Constant.SOCIAL_PINTEREST_LINK') }}" target="_blank" title="Pinterest">Pinterest</a></li>
                    <li><a href="{{ Config::get('Constant.SOCIAL_LINKEDIN_LINK') }}" target="_blank" title="Linkedin">Linkedin</a></li>
                    <li><a href="{{ Config::get('Constant.SOCIAL_INSTAGRAM_LINK') }}" target="_blank" title="Instagram">Instagram</a> </li>
                </ul>
            </div>
            
            <div class="sitemap-m">
                <h6>Sitemap</h6>
                <ul>
                    <li><a href="{{ url('/sitemap.xml') }}" target="_blank" title="Sitemap.xml">Sitemap.xml</a> </li>
                </ul>
            </div>
            </div>





          





        </div>
    </div>
</div>
@endsection