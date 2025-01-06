<!-- toaster code -->

<link rel="stylesheet" href="{{URL::to('/assets/spin-wheel/css/jquery.toast.css?v=')}}{{date('YmdHi')}}">
<script src="{{URL::to('/assets/spin-wheel/js/jquery.toast.js')}}"></script>
<script type="text/javascript">
    function tosterone(txt_heading,txt_description,txt_icon,align,duration,txt_colour,bgColor) {
        $.toast({
            heading: txt_heading,
            text: txt_description, 
            showHideTransition : 'slide',
            bgColor : bgColor,
            textColor : txt_colour,
            hideAfter : duration,
            stack : 50,
            position: align,
            icon: txt_icon,
            afterHidden: function () {
                setCookie("cookie_val_showtoster", 'Y', 1);
            }
        })
    }
    function tostertwo(txt_heading,txt_description,txt_icon,align,duration,txt_colour,bgColor) {
        $.toast({
            heading: txt_heading,
            text: txt_description, 
            showHideTransition : 'slide',
            bgColor : bgColor,
            textColor : txt_colour,
            hideAfter : duration,
            stack : 50,
            position: align,
            icon: txt_icon,
        })
    }
</script>


{{-- below for Rushabh --}}
<script>
    var cookie_val_showtoster = getCookie('cookie_val_showtoster');
    var __showtoster='{{ request('t') }}';
    if (__showtoster!='1' && '{{ Request::segment(1) }}' != 'cart' && cookie_val_showtoster != 'Y'){
        tosterone("Update","You Can Call Us On Our New Support Number 079-3507-9700.","info",'bottom-right','5000','#ffffff','#112e49');
    }
    if (__showtoster=='1'){
        tostertwo("GRAB THIS OFFER","Choose your hosting package & a promo code will be added to your cart.","info",'top-right','','#ffffff','#0f8604');
    }

</script>



{{-- ====================================== --}}


<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="independence-sale-modal" role="dialog">
    <div class="modal-dialog modal-flash-sale">
      <div class="modal-content">
        <div class="modal-body">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="independence-main">
                        <div class="independence-first">
                            <img id="i-d" alt="Extra 10% OFF" title="Extra 10% OFF" src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/independence-2021/left-min.png" />
                            <img id="i-m" alt="Extra 10% OFF" title="Extra 10% OFF" src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/independence-2021/left-mo-min.png" />
                        </div>
                        <div class="independence-second">
                            <img src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/independence-2021/main-min.png" alt="Grand Freedom Days Mega Hosting Sale" title="Grand Freedom Days Mega Hosting Sale" />
                        </div>
                        <div class="independence-third">
                            <img id="i-d" alt="Extra 20% OFF" title="Extra 20% OFF" src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/independence-2021/right-min.png" />
                            <img id="i-m" alt="Extra 20% OFF" title="Extra 20% OFF" src="https://d1neo0gtmjcot5.cloudfront.net/assets/images/independence-2021/right-mo-min.png" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="independence-btn">
                        @if (in_array(url()->current(), [URL::to('/hosting/linux-hosting'),URL::to('/hosting/windows-hosting'),URL::to('/hosting/wordpress-hosting'),URL::to('/hosting/ecommerce-hosting') ]) )
                            <button>
                                <a href="{{ url()->current() }}?t=1&scrollto=vps-plan2">GRAB THIS OFFER</a>
                            </button>
                        @elseif(in_array(url()->current(), [URL::to('/domain-registration'),URL::to('/domain/domain-transfer')]))
                            <button>
                                <a href="{{ URL::to('/web-hosting') }}#hosting_plans">GRAB THIS OFFER</a>
                            </button>
                        @else
                            <button>
                                <a href="{{ url()->current() }}?t=1&scrollto=vps-plan2">GRAB THIS OFFER</a>
                            </button>
                        @endif
                    </div>
                    <div class="independence-btn-close">
                        <button type="button" class="close" data-dismiss="modal" onclick="window.location.href ='{{url()->current()}}?t=0';" >No, I Don’t Want This!</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Model show code --}}
<script type="text/javascript">
    $(function() {
        @if (  URL::to('/hosting/linux-hosting') == url()->current() 
            || URL::to('/hosting/windows-hosting') == url()->current() 
            || URL::to('/hosting/wordpress-hosting') == url()->current() 
            || URL::to('/hosting/java-hosting') == url()->current()
            || URL::to('/hosting/ecommerce-hosting') == url()->current()
            || URL::to('/domain-registration') == url()->current()
            || URL::to('/domain/domain-transfer') == url()->current()
            )
            if (__showtoster!='1' && __showtoster!='0'){
                setTimeout(function(){ 
                    $('#independence-sale-modal').modal('show');
                }, 15000);
            }
        @endif
    })
</script>

@if (URL::to('/') == url()->current() || URL::to('/web-hosting') == url()->current() || URL::to('/deals') == url()->current())
    <style type="text/css">
        @media (max-width: 1024px){
            .header_section .mainheader .cart_div {
                background: #0a4090;
            }
        }
    </style>
@endif
<style type="text/css">.jq-toast-single {font-size: 14px !important;line-height: initial;font-family: 'Poppins';}.jq-toast-wrap {width: 300px !important;}.jq-toast-single h2 {font-weight: 600;}.jq-toast-wrap.top-right {top: 150px;}@media (max-width: 500px){.jq-toast-wrap.top-right{top:inherit;bottom:20px;right:15px;left:15px;}}</style>