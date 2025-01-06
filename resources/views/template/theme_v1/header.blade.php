
<div class="mega-menu-fixed fixed-header" id="myHeader">
  <div class="mega-menu-top">
    <div class="header-top-menu">
      <div class="hdr-tp-lft hdr_tp_cmn">
        <ul>
          <li><a href="{{url('/web-hosting-affiliates')}}" title="Affiliates" id="affiliates_header">Affiliates</a></li>
          <li><a href="{{ url('/blog') }}" title="Blog" id="blog_header">Blog</a></li>
          <li><a href="{{ url('/manage/knowledgebase/') }}" title="Knowledgebase" id="knowledgebase_header">Knowledgebase</a></li>
        </ul>
      </div>












      <div class="hdr-tp-rgt hdr_tp_cmn">
      <ul>
          <li class="nav-item dropdown hdr_top_cntc_us">
            <a title="Contact Us" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Contact Us <i class="fa-solid fa-angle-down"></i>
            </a>
            <div class="dropdown-menu">
              @if(null!==(Config::get('Constant.DEFAULT_PHONENO')) && strlen(Config::get('Constant.DEFAULT_PHONENO')) > 0)
              <a title="Call Us on 079-3507-9700" id="phone_number_header" class="dropdown-item" target="_blank" href="tel:{{Config::get('Constant.DEFAULT_PHONENO')}}"><i class="fa-solid fa-phone"></i>{{Config::get('Constant.DEFAULT_PHONENO')}}</a>
              {{-- <a class="dropdown-item" target="_blank" href="tel:{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}"><i class="fa-solid fa-phone"></i> {{ App\Helpers\MyLibrary::encrypt_decrypt('decrypt',$contactData->varPhoneNo) }}</a> --}}
              @endif
              <a title="Live Chat" id="live_chat_header" class="dropdown-item" href="javascript:void(Tawk_API.toggle())"><i class="fa-solid fa-comments"></i> Live Chat</a>
              <a title="Raise a Ticket" id="raise_ticket_header" class="dropdown-item" target="_blank" href="{{ config('app.api_url') }}/clientarea.php"><i class="fa-solid fa-ticket"></i> Raise a Ticket</a>
            </div>
          </li>
           @unless(session()->has('frontlogin'))
          <li class="nav-item dropdown hdr_top_cntc_us">
            <a title="Account" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Register/Login <i class="fa-solid fa-angle-down"></i>
            </a>
            <div class="dropdown-menu">
              <a title="LOGIN" id="login_page_home" class="dropdown-item" href="{{url('/login')}}">
              <i class="fa-solid fa-user"></i>LOGIN</a>
              <a title="REGISTER" id="signup_page_home" class="dropdown-item createaccount" id="login_header" href="#" data-toggle="modal" data-target="#loginModal">
              <i class="fa-solid fa-user-plus"></i>REGISTER</a>
            </div>
          </li>  
          
        @endunless
        @if(session()->has('frontlogin'))
          <li class="nav-item dropdown hdr_top_cntc_us my-acc-top header-megamenu-li my-acc-top-device">
            <a class="nav-link mega-nav" href="#" role="button" data-toggle="dropdown" aria-expanded="false" title="My Account">
              My Account <i class="fa-solid fa-angle-down"></i>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item top-menu-myacc" href="javascript:void(0)" title="Host IT Smart">
                <p> Host IT Smart</p>
                <p>
                  @if(Session::has('useremail'))
                  {{ Session::get('useremail') }}
                  @endif
                </p>
              </a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/clientarea.php" title="My Profile"><i class="fa-solid fa-user"></i> My Profile</a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/clientarea.php?action=invoices" title="Invoices"><i class="fa-solid fa-file-invoice"></i> Invoices</a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/clientarea.php?action=services" title="Products"><i class="fa-solid fa-share-nodes"></i> Products/Services</a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/clientarea.php?action=domains" title="Domain"><i class="fa-solid fa-globe"></i> Domain</a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/supporttickets.php" title="Support"><i class="fa-solid fa-ticket"></i> Support</a>
              <div class="my-acc-log-out-btn">
                <a href="javascript:void(0)" id="logoutlink" onclick="do_logout();" title="Logout">LOGOUT</a>
              </div>
            </div>
          </li>
          @endif
         
          {{-- <li class="nav-item dropdown hdr_top_login header-megamenu-li hdr_top_login_mb">
            <a class="nav-link mega-nav" id="login_header" href="#" title="Login" data-toggle="modal" data-target="#loginModal">
            <i class="hdr-tp-icon fa-solid fa-user"></i> Login</a></li> --}}
         
            <li class="nav-item dropdown hdr_top_ctry_list">
            <a title="India" title="India" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              <img src="../assets/images/new_img/india_flag.webp" alt="india_flag_icon" loading="lazy">
              <span class="cntry-list-in"> India </span> <i class="fa-solid fa-angle-down"></i>
            </a>
            <div class="dropdown-menu">
              <a title="Canada" class="dropdown-item" href="https://www.hostitsmart.ca/"><img src="../assets/images/new_img/canada_flag.webp" alt="canada_flag_icon" loading="lazy">
                <p> Canada</p>
              </a>
              <a title="Global" class="dropdown-item" href="https://global.hostitsmart.com/"><img src="../assets/images/new_img/global_icon.webp" alt="global_icon" loading="lazy">
                <p> Global</p>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>

  </div>


  <div class="main_navbar_megamenu">
    <nav class="navbar navbar-expand-lg navbar-light rounded megamenu-navbar" id="navbar-nav">
      <a class="navbar-brand navbar-megamenu-logo" href="{{url('/')}}"  title="Host IT Smart"><img style=" max-height: 70px;" src="../assets/images/logo.webp" alt="logo" loading="lazy"></a>
      <button class="navbar-toggler megamenu-toggle" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class=" toggle-icon" onclick="toggleIcon()"><i id="icon" class="fa-solid fa-bars"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mega-menu">
          <li class="nav-item dropdown header-megamenu-li">
            <a class="nav-link mega-nav active" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Domains">Domains<i class="fa-solid fa-angle-down"></i></a>
            <div class="dropdown-menu header-megamenu domains-dropdown-megamenu" aria-labelledby="dropdown01">
              <ul class="mega-box-clm">
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/domain-registration')}}" title="Domain Registration">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/dmn-register.webp" alt="Domain Registration" loading="lazy"></div>
                    <div class="mega-menu-cont" >
                      <div class="mega-menu-tittle">Domain Registration</div>
                      <p>Think, search & claim your digital identity.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/domain/domain-transfer')}}" title="Domain Transfer">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/transfer-icon.webp" alt="Domain Transfer" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Domain Transfer</div>
                      <p>Effortlessly migrate your domain to a new home.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/domain/bulk-domain-search')}}"  title="Bulk Domain Search">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/search-icon.webp" alt="Bulk Domain Search" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Bulk Domain Search</div>
                      <p>Discover multiple domains at once with our Search tool.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/whois')}}" title="Whois Checker">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/check-icon.webp" alt="Whois Checker" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Whois Checker</div>
                      <p>Uncover domain details with our WHOIS Checker online.</p>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown header-megamenu-li">
            <a class="nav-link mega-nav active" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Hosting">Hosting <i class="fa-solid fa-angle-down"></i></a>
            <div class="dropdown-menu header-megamenu hosting-dropdown-megamenu" aria-labelledby="dropdown01">
              <ul class="mega-box-clm">
                                <li class="hdr_tp_menu_li">
                                    <a class="dropdown-item" href="{{url('/web-hosting')}}" title="Web Hosting ">
                                        <div class="mega-menu-icon"> <img src="../assets/images/new_img/web-hosting-icon.webp" alt="web-hosting-icon" loading="lazy"></div>
                                        <div class="mega-menu-cont">
                                            <div class="mega-menu-tittle">Web Hosting</div>
                                            <p>Experience lightning-fast and reliable web hosting for your online business.</p>
                                        </div>
                                    </a>
                                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/hosting/linux-hosting')}}" title="Linux Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/linux-hosting.webp" alt="Linux Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Linux Hosting</div>
                      <p>Perfect match for open-source lovers and coders.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/hosting/windows-hosting')}}" title="Windows Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/windows-hosting.webp" alt="Windows Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Windows Hosting</div>
                      <p>Ideal match for businesses using Windows applications.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/hosting/wordpress-hosting')}}" title="Wordpress Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/wordpress-hosting.webp" alt="WordPress Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">WordPress Hosting</div>
                      <p>Tailored web hosting solution for bloggers & creators.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/hosting/ecommerce-hosting')}}" title="Ecommerce Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/ecommerce-hosting.webp" alt="eCommerce Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">eCommerce Hosting</div>
                      <p>Optimize your eCommerce website with tailored hosting.</p>
                    </div>
                  </a>
                </li>
                <!-- <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/hosting/linux-reseller-hosting')}}" title="Reseller Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/reseller.webp" alt="Reseller Hosting"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Reseller Hosting</div>
                      <p>Unleash your web agency's potential with Reseller Hosting.</p>
                    </div>
                  </a>
                </li> -->
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/deals')}}#Web-Hosting" title="Hosting Deals">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/deals-icon.webp" alt="Hosting Deals" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Hosting Deals</div>
                      <p>Get Budget-friendly web hosting offers for everyone.</p>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown header-megamenu-li">
            <a class="nav-link mega-nav" href="" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Servers">Servers <i class="fa-solid fa-angle-down"></i></a>
            <div class="dropdown-menu header-megamenu servers-dropdown-megamenu" aria-labelledby="dropdown01">
              <ul class="mega-box-clm">

                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/servers/vps-hosting')}}" title="VPS Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/linux-hosting.webp" alt="Linux VPS Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">VPS Hosting</div>
                      <p>Fully secured and efficient self-managed hosting for Linux enthusiasts.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/servers/managed-vps-hosting')}}" title="Manage VPS Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/linux-hosting.webp" alt="Manage VPS Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Managed VPS Hosting</div>
                      <p>Leave your entire linux server technicalities to us.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/servers/windows-vps-hosting')}}" title="Windows VPS Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/windows-hosting.webp" alt="Windows VPS Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Windows VPS Hosting</div>
                      <p>Best for scaling applications & secured environment.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/servers/forex-vps-hosting')}}" title="Fores VPS Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/forex-vps.webp" alt="Forex VPS Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Forex VPS Hosting</div>
                      <p>Streamline your forex trading operations with VPS server.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/servers/dedicated-servers')}}" title="Dedicated Server Hosting">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/dedicated-server.webp" alt="Dedicated Server Hosting" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Dedicated Server Hosting</div>
                      <p>Robust & custom solutions for data-intensive applications.</p>
                    </div>
                  </a>
                </li>

                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/deals')}}#SERVERS" title="Server Deals">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/deals-icon.webp" alt="Deals Icon" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Server Deals</div>
                      <p>Get Budget-friendly server offers for everyone.</p>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item header-megamenu-li">
            <a class="nav-link mega-nav" href="{{url('/hosting/website-builder')}}" title="Website Builder">Website Builder</a>
          </li>
          <li class="nav-item dropdown header-megamenu-li">
            <a class="nav-link mega-nav" href="" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Email">Email <i class="fa-solid fa-angle-down"></i></a>
            <div class="dropdown-menu header-megamenu email-dropdown-megamenu" aria-labelledby="dropdown01">
              <ul class="mega-box-clm">
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/email/google-workspace-india')}}" title="Google Workspace">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/google-icon.webp" alt="Google Workspace" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Google Workspace</div>
                      <p>Stay connected and collaborate with Google Workspace.</p>
                    </div>
                  </a>
                </li>
                <li class="hdr_tp_menu_li">
                  <a class="dropdown-item" href="{{url('/email/microsoft-office-365-suite')}}" title="Microsoft 365">
                    <div class="mega-menu-icon"> <img src="../assets/images/new_img/microsoft365-icon.webp" alt="Microsoft 365" loading="lazy"></div>
                    <div class="mega-menu-cont">
                      <div class="mega-menu-tittle">Microsoft 365</div>
                      <p>Boost productivity with Microsoft 365 for businesses.</p>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item header-megamenu-li">
            <a class="nav-link mega-nav" href="{{url('/ssl-certificates')}}" title="SSL">SSL</a>
          </li>
          @if(session()->has('frontlogin'))
          <li class="nav-item dropdown hdr_top_cntc_us my-acc-top header-megamenu-li my-acc-top-desktop">
            <a class="nav-link mega-nav" href="#" role="button" data-toggle="dropdown" aria-expanded="false" title="My Account">
              My Account <i class="fa-solid fa-angle-down"></i>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item top-menu-myacc" href="javascript:void(0)" title="Host IT Smart">
                <p> Host IT Smart</p>
                <p>
                  @if(Session::has('useremail'))
                  {{ Session::get('useremail') }}
                  @endif
                </p>
              </a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/clientarea.php" title="My Profile"><i class="fa-solid fa-user"></i> My Profile</a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/clientarea.php?action=invoices" title="Invoices"><i class="fa-solid fa-file-invoice"></i> Invoices</a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/clientarea.php?action=services" title="Products"><i class="fa-solid fa-share-nodes"></i> Products/Services</a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/clientarea.php?action=domains" title="Domain"><i class="fa-solid fa-globe"></i> Domain</a>
              <a class="dropdown-item" href="{{ config('app.api_url') }}/supporttickets.php" title="Support"><i class="fa-solid fa-ticket"></i> Support</a>
              <div class="my-acc-log-out-btn">
                <a href="javascript:void(0)" id="logoutlink" onclick="do_logout();" title="Logout">LOGOUT</a>
              </div>
            </div>
          </li>
          @else
          {{-- <li class="nav-item dropdown hdr_top_login header-megamenu-li">
            <a class="nav-link mega-nav" id="login_header" href="#" title="Login" data-toggle="modal" data-target="#loginModal">
            <i class="hdr-tp-icon fa-solid fa-user"></i> Login</a></li> --}}
          @endif
          {{-- <li class="nav-item header-megamenu-li cart-megamenu-li">
            <a class="nav-link cart-icon-hdr-tp" href="{{url('/cart/signin')}}" title="Cart">
              <i class="fa-solid fa-cart-shopping"></i></a>
            <span class="counter" id="cart_cout"></span>
          </li> --}}
          <?php
         $url ="javascript:void(0);"; ?>
          @if (session()->has('cart'))
    @php
        $cart_array = Session::get('cart');
        // echo '<pre>123'; print_r($cart_array); exit;
        
                        if(!empty($cart_array)){
                        if(array_key_exists('userid',$cart_array))        { unset($cart_array['userid']); }
                        if(array_key_exists('paymentmethod',$cart_array)) { unset($cart_array['paymentmethod']); }
                        if(array_key_exists('recommndation',$cart_array)) { unset($cart_array['recommndation']); }            
                        if(array_key_exists('prmocode',$cart_array))      { unset($cart_array['prmocode']); }
                        if(array_key_exists('prmodiscount',$cart_array))  { unset($cart_array['prmodiscount']); }
                        if(array_key_exists('prmomessage',$cart_array))   { unset($cart_array['prmomessage']); }
                        }

        $count_array = count($cart_array);
        // echo $count_array;exit;
        $url = $count_array > 0 ? url('/cart/signin') : 'javascript:void(0);';
    @endphp
@endif

<li class="nav-item header-megamenu-li cart-megamenu-li">
    <a class="nav-link cart-icon-hdr-tp" href="{{$url}}" title="Cart">
        <i class="fa-solid fa-cart-shopping"></i>
    </a>
    <span class="counter" id="cart_cout"></span>
</li>
        </ul>
      </div>
    </nav>

  </div>
</div>

<script type="text/javascript">
  function do_logout() {
    $.get("{{ config('app.api_url') }}/hits_logout.php", function() {
        window.location.href = "{{ url('/user-logout') }}";
    });
}
  @if(isset($uagent) && $uagent == 'mobile')
  //To add sub menus items in mobile view
  var webhosting_mobile_menu = '<li class="dropdown"><a href="/hosting/linux-hosting" title="Linux Hosting" class="dropdown-toggle" data-toggle="dropdown">Linux Hosting</a></li><li class="dropdown"><a href="/hosting/windows-hosting" title="Windows Hosting" class="dropdown-toggle" data-toggle="dropdown">Windows Hosting</a></li>';
  var resellerhosting_mobile_menu = '<li class="dropdown"><a href="/hosting/linux-reseller-hosting" title="Linux Reseller Hosting" class="dropdown-toggle" data-toggle="dropdown">Linux Reseller Hosting</a></li><li class="dropdown"><a href="/hosting/windows-reseller-hosting" title="Windows Reseller Hosting" class="dropdown-toggle" data-toggle="dropdown">Windows Reseller Hosting</a></li>';
  var vpshosting_mobile_menu = '<li class="dropdown"><a href="/servers/linux-vps-hosting" title="Linux VPS Hosting" class="dropdown-toggle" data-toggle="dropdown">Linux VPS Hosting</a></li><li class="dropdown"><a href="/servers/windows-vps-hosting" title="Windows VPS Hosting" class="dropdown-toggle" data-toggle="dropdown">Windows VPS Hosting</a></li>';

  $(webhosting_mobile_menu).insertAfter($('#webhostingmenu').parent());
  $(resellerhosting_mobile_menu).insertAfter($('#resellerhostingmenu').parent());
  $(vpshosting_mobile_menu).insertAfter($('#vpshostingmenu').parent());
  @endif
</script>

<!-- bfs-23-popup-S -->
<!-- <script>
    // Function to show the modal
    function showModal() {
      var modal = document.getElementById('modal_offers_bfs_23');
      if (modal) {
        var modalInstance = new bootstrap.Modal(modal);
        modalInstance.show();
      }
    }

    // Event listener for mouseover on the top edge
    document.addEventListener('mouseover', function (event) {
      // Check if the mouse is near the top edge (adjust the threshold as needed)
      var threshold = 10; // Adjust this value as needed
      if (event.clientY <= threshold) {
        // Show the modal
        showModal();

        // Remove the event listener after showing the modal if you want it to show only once
        document.removeEventListener('mouseover', arguments.callee);
      }
    });
  </script> -->



<!-- header-scroll-S -->



<div class="cntc-tglr-box">
  <button type="button" class="cntc-tglr-btn-dropdown" name="toggle-dropdown" id="toggle-dropdown" title="Support">
    <i class="fa-solid fa-angle-left"></i>
  </button>
  
  <div class="cntc-tglr-dropdown-menu" id="dropdown-menu">
  <div class="drop-head">Stuck? Don’t worry <span><a id="cntc-tglr-close-dropdown">x</a></span></div>
  <ul class="cntc-tglr-dropdown-menu-ul">
    <li><a href="javascript:void(Tawk_API.toggle())" id="cntc-tglr-chat" title="Chat with us"><span class="cnt-icon-box"><i class="fa-solid fa-comment-dots"></i></span>Chat with us</a></li>
    <li><a href="tel:079-3507-9700" title="Call us" id="cntc-tglr-call"><span class="cnt-icon-box"><i class="fa-solid fa-phone-volume"></i></span>079-3507-9700</a></li>
  </ul>
</div>
</div>




<!-- cntc-tglr-dropdown-box-s -->

<script>
// Flag to track if the dropdown has been manually closed
let manuallyClosed = false;

// Function to update the visibility of the toggle button with smooth transition
function updateToggleButtonVisibility() {
  const dropdownMenu = document.getElementById('dropdown-menu');
  const toggleButton = document.getElementById('toggle-dropdown');
  
  if (dropdownMenu.classList.contains('show')) {
    toggleButton.classList.add('hide'); // Add the hide class for a smooth transition
  } else {
    toggleButton.classList.remove('hide'); // Remove the hide class for a smooth transition
  }
}

// Toggle dropdown on button click
document.getElementById('toggle-dropdown').addEventListener('click', function () {
  const dropdownMenu = document.getElementById('dropdown-menu');
  
  // Toggle the 'show' class to open/close the dropdown
  dropdownMenu.classList.toggle('show');
  
  // Update the visibility of the toggle button
  updateToggleButtonVisibility();
  
  // Reset the flag if dropdown is opened
  manuallyClosed = false;
});

// Close dropdown only when the 'x' button is clicked
document.getElementById('cntc-tglr-close-dropdown').addEventListener('click', function () {
  const dropdownMenu = document.getElementById('dropdown-menu');
  
  // Remove the 'show' class to hide the dropdown
  dropdownMenu.classList.remove('show');
  
  // Update the visibility of the toggle button
  updateToggleButtonVisibility();
  
  // Set the flag to true since the dropdown was manually closed
  manuallyClosed = true;
});

// Show dropdown menu when scrolled down to 1500px or above, only if not manually closed
window.addEventListener('scroll', function () {
  const dropdownMenu = document.getElementById('dropdown-menu');
  const toggleButton = document.getElementById('toggle-dropdown');

  if (window.scrollY >= 400 && (!manuallyClosed || window.scrollY + window.innerHeight >= document.documentElement.scrollHeight)) {
    dropdownMenu.classList.add('show');
    toggleButton.classList.add('hide'); // Hide the button with a smooth transition
    manuallyClosed = false; // Reset manual close flag
  } else if (window.scrollY < 400) {
    dropdownMenu.classList.remove('show');
    toggleButton.classList.remove('hide'); // Show the button with a smooth transition
  }
});

</script>

<!-- cntc-tglr-dropdown-box-s -->



<script>
    {
  const header = document.querySelector(".main_navbar_megamenu");
  const toggleClass = "is-sticky";

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll > 400) {
      header.classList.add(toggleClass);
    } else {
      header.classList.remove(toggleClass);
    }
  });
}

</script>
<!-- header-scroll-E -->
<!-- toggle-icon-S -->
<script>
  function toggleIcon() {
    var icon = document.getElementById('icon');

    // Toggle between 'fa-toggle-on' and 'fa-toggle-off' classes
    if (icon.classList.contains('fa-bars')) {
      icon.classList.remove('fa-bars');
      icon.classList.add('fa-xmark');
    } else {
      icon.classList.remove('fa-xmark');
      icon.classList.add('fa-bars');
    }
  }
</script>
<!-- toggle-icon-E -->

<!-- customer-delight-S -->
<script>
    $(document).ready(function() {
        $('.cust-delight-owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: false, // Enable autoplay
            autoplayTimeout: 2000, // Autoplay interval in milliseconds (5 seconds in this example)
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 2.5
                }
            }
        });
    });
</script>
<!-- customer-delight-E -->
<!-- login-page-carousel-s -->
<script>
    $(document).ready(function() {
        $('.innr-page-login-02').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true, // Enable autoplay
            autoplayTimeout: 2000, // Autoplay interval in milliseconds (5 seconds in this example)
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    });
</script>
<!-- login-page-carousel-e -->
<!-- <whatsapp-icon-hide-s> -->
<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to check if the element is close to the bottom
            function checkScroll() {
                var element = document.querySelector('.wa-float');
                if (element) {
                    var distanceFromBottom = document.body.scrollHeight - window.innerHeight - window.scrollY;

                    // If the element is less than 100px from the bottom, add the 'hidden' class
                    if (distanceFromBottom < 100) {
                        element.classList.add('hidden');
                    } else {
                        element.classList.remove('hidden');
                    }
                }
            }

            // Add event listener for scroll events
            window.addEventListener('scroll', checkScroll);
            // Call it once to set initial state
            checkScroll();
        });
    </script>
<!-- </whatsapp-icon-hide-s> -->
