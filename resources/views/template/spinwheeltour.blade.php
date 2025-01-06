<!-- toaster code -->

<link rel="stylesheet" href="{{URL::to('/assets/spin-wheel/css/jquery.toast.css?v=')}}{{date('YmdHi')}}">

<script src="{{URL::to('/assets/spin-wheel/js/jquery.toast.js')}}"></script>

<script type="text/javascript">

    function tosterone(txt_heading,txt_description,txt_icon) {

        $.toast({

            heading: txt_heading,

            text: txt_description, 

            showHideTransition : 'slide',  // It can be plain, fade or slide

            bgColor : '#112e49', // Background color for toast

            textColor : '#ffffff', // text color

            hideAfter : 5000, // `false` to make it sticky or time in miliseconds to hide after

            stack : 50, // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once

            position: 'top-left',

            icon: txt_icon

        })

    }

    setTimeout(function(){ 
        @if (Session::get('spin-wheel-type') == 'S')
        
             @if (Session::get('spinwheel-step') == '2')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2","Select a web hosting plan according to your needs!","info"); 
    
            @endif
            
            
            @if (Session::get('spinwheel-step') == '3')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2 - Done!","You have selected your plan.","success"); 
    
            tosterone("Step 3","Select from these 3 packages according to your needs","info"); 
    
            @endif
    
            @if (Session::get('spinwheel-step') == '4')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2 - Done!","You have selected your plan.","success"); 
    
            tosterone("Step 3 - Done!","you have selected package of your choice.","success");
    
            tosterone("Step 4","Please choose your configuration","info"); 
    
            @endif
            
            @if (Session::get('spinwheel-step') == '5')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2 - Done!","You have selected your plan.","success"); 
    
            tosterone("Step 3 - Done!","you have selected package of your choice.","success");
    
            tosterone("Step 4 - Done!","You have configued package.","success"); 
            
            tosterone("Step 5","Please Signin Or Create Account","info"); 
    
            @endif
            
             @if (Session::get('spinwheel-step') == '6')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2 - Done!","You have selected your plan.","success"); 
    
            tosterone("Step 3 - Done!","you have selected package of your choice.","success");
    
            tosterone("Step 4 - Done!","You have configued package.","success"); 
            
            tosterone("Step 5 - Done!","You are logged in now.","success"); 
            
            tosterone("Step 6","Please apply promocode  make payment!","info");
    
            @endif
            
        @endif
        @if (Session::get('spin-wheel-type') == 'V')
        
            @if (Session::get('spinwheel-step') == '3')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2 - Done!","You have selected your plan.","success"); 
    
            tosterone("Step 3","Select from these 3 packages according to your needs","info"); 
    
            @endif
    
            @if (Session::get('spinwheel-step') == '4')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2 - Done!","You have selected your plan.","success"); 
    
            tosterone("Step 3 - Done!","you have selected package of your choice.","success");
    
            tosterone("Step 4","Please choose your configuration","info"); 
    
            @endif
            
            @if (Session::get('spinwheel-step') == '5')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2 - Done!","You have selected your plan.","success"); 
    
            tosterone("Step 3 - Done!","you have selected package of your choice.","success");
    
            tosterone("Step 4 - Done!","You have configued package.","success"); 
            
            tosterone("Step 5","Please Signin Or Create Account","info"); 
    
            @endif
            
             @if (Session::get('spinwheel-step') == '6')
    
            tosterone("Step 1 - Done!","Well Done! You have won a fantastic offer.","success");
    
            tosterone("Step 2 - Done!","You have selected your plan.","success"); 
    
            tosterone("Step 3 - Done!","you have selected package of your choice.","success");
    
            tosterone("Step 4 - Done!","You have configued package.","success"); 
            
            tosterone("Step 5 - Done!","You are logged in now.","success"); 
            
            tosterone("Step 6","Please apply promocode  make payment!","info");
    
            @endif
            
        @endif

        

    }, 1000);

</script>