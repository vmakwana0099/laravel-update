<link rel="stylesheet" href="{{URL::to('/assets/css/jquery.toast.css?v=')}}{{date('YmdHi')}}">
<script src="{{URL::to('/assets/js/jquery.toast.js')}}"></script>

<script type="text/javascript">

    function tosterone(txt_heading,txt_description,txt_icon) {

        $.toast({
            heading: txt_heading,
            text: txt_description,
            showHideTransition : 'slide',
            bgColor : '#112e49',
            textColor : '#ffffff',
            hideAfter : 15000,
            stack : 50,
            position: 'top-right',
            icon: txt_icon,
        });
    }
    setTimeout(function(){ 

        @if (URL::to('/servers/vps-hosting') == url()->current() && request('viewmessage') == "true")   
        tosterone("","Select from these 3 packages according to your needs.","info");
        @endif

    }, 2000);

</script>