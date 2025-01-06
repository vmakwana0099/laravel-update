// JavaScript Document



(function ($) {

$(window).load(function() { 
	$("#status").fadeOut(); // will first fade out the loading animation
	$("#preloader").delay(400).fadeOut("medium"); // will fade out the white DIV that covers the website.
});

$(document).ready(function() {
    
    //Remove 300ms lag set by -webkit-browsers     
   window.addEventListener('load', function() {
		FastClick.attach(document.body);
	}, false);
	
    //Slide Menu Settings//
    $('.open-slide').click(function(){
        $('.menu-wrapper').toggleClass('hide-menu-wrapper'); 
        $('.menu-wrapper em').delay(2500).slideUp(300);
        $(this).toggleClass('active-slide');
        $('.header').toggleClass('move-header');
    });
    
    $('.menu-wrapper').addClass('hide-menu-wrapper');
    var menu_slider = $(".menu");
    menu_slider.owlCarousel({
        autoPlay: false, //Set AutoPlay to 3 seconds
        scrollPerPage:true,
        pagination:false,
        rewindSpeed:0,
        items : 15,
        itemsDesktop : [1199,6],
        itemsDesktopSmall : [979,5],
        itemsTablet:	[768,4],
        itemsMobile:	[560,3]//,
        //afterInit : function(elem){
        //     this.jumpTo(0); //for 4th slide
        //}
    });
    
    var selected_menu_item = document.getElementById( "selected" );
    var selected_menu_item_number = ($( ".menu a" ).index( selected_menu_item ) );
    menu_slider.trigger('owl.jumpTo', selected_menu_item_number);
    
    console.log(selected_menu_item_number);
    
    var scl=0; // Create a variable
    window.setInterval(function(){
       scl=0; // Reset this variable every 0.5 seconds
    }, 500);

    $('.menu').on('DOMMouseScroll mousewheel', function (e) { 
        if(e.originalEvent.detail > 0 || e.originalEvent.wheelDelta < 0) {
        while(scl==0) { 
            menu_slider.trigger('owl.next');
            scl++;
        }
    } else {
        while(scl==0) { 
            menu_slider.trigger('owl.prev');
            scl++;
        }
    }
    });
        
    //Sidebar Menu Settings//
    /* 24-4-2015 - Dixit Pandya */
    $('.deploy-submenu').click(function(){
        $(this).toggleClass('active-submenu');
        $(this).parent().find('.submenu').toggleClass('active-submenu-items');
        return false;
    }); 


	$('.swipebox').click(function(){ 
		$('.gallery').hide(0);
		$('.portfolio-wide').hide(0);
	});

	// Systems 
	$('.open-menu').click(function() {
        $('.header, .menu-wrapper').removeClass('hide-header-right');
        $('.header, .menu-wrapper').addClass('hide-header-left');
        $('.menu-wrapper').addClass('hide-menu-wrapper');   
//		$('.snap-drawers').css("position",'relative');
		$('.snap-drawers').css("transform",'translate3d(0px, 0px, 0px)');
		$('.snap-content').css("position",'fixed');
		$('.snap-content').css("overflow",'auto');
        $('.open-slide').removeClass('active-slide');
		if( snapper.state().state=="left" ){
			snapper.close();
		} else {
			snapper.open('left');
		}
		return false;
	});	
	
	$('.sidebar-close, .all-elements').click(function() {
        $('.header, .menu-wrapper').removeClass('hide-header-left');
        $('.header, .menu-wrapper').removeClass('hide-header-right');
	//	$('.snap-drawers').css("position",'');
		$('.snap-drawers').css("transform",'');
		$('.snap-content').css("position",'');
		$('.snap-content').css("overflow",'');		
        $('.menu-wrapper').addClass('hide-menu-wrapper');
        $('.open-slide').removeClass('active-slide');
		snapper.close();
	});

	var snapper = new Snap({
	  element: document.getElementById('content')
	});
					
	//Checkboxes
	
	$('.checkbox-one').click(function() {
		$(this).toggleClass('checkbox-one-checked');
		return false;
	});
	$('.checkbox-two').click(function() {
		$(this).toggleClass('checkbox-two-checked');
		return false;
	});
	$('.checkbox-three').click(function() {
		$(this).toggleClass('checkbox-three-checked');
		return false;
	});	
	$('.radio-one').click(function() {
		$(this).toggleClass('radio-one-checked');
		return false;
	});	
	$('.radio-two').click(function() {
		$(this).toggleClass('radio-two-checked');
		return false;
	});
	
	/* 28-4-2015 Dixit Pandya */
	$('.chkbox').click(function() {
		$(this).toggleClass('chkbox-checked');
		return false;
	});
	$('.radiobtn').click(function() {
		$(this).toggleClass('radiobtn-checked');
		return false;
	});			
	$('.radiobtn-checked').click(function() {
		$(this).toggleClass('radiobtn');
		return false;
	});	
	/* 29-4-2015 */
	$('.private-domain').click(function() {
		$('.chkbox2').toggleClass('chkbox2-checked');
	});
	$('.private-domain').click(function() {
		$('.chkbox').toggleClass('chkbox-checked');
	});	
	
	//Tabs 
	$('.tab-but-1').click(function() {
		$('.tab-but').removeClass('tab-active');
		$('.tab-but-1').addClass('tab-active');
		/* By Systems 
		$('.tab-content').slideUp(200);
		$('.tab-content-1').slideDown(200);	 */
		/* 30-4-2015 Me */
		$('.tab-content').slideUp(0);
		$('.tab-content-1').slideDown(0);
		return false;
	});
	
	$('.tab-but-2').click(function() {
		$('.tab-but').removeClass('tab-active');
		$('.tab-but-2').addClass('tab-active');
		$('.tab-content').slideUp(0);
		$('.tab-content-2').slideDown(0); 
		return false;
	});	
	
	$('.tab-but-3').click(function() {
		$('.tab-but').removeClass('tab-active');
		$('.tab-but-3').addClass('tab-active');
		$('.tab-content').slideUp(0);
		$('.tab-content-3').slideDown(0);	 
		return false;
	});	
	
	$('.tab-but-4').click(function() {
		$('.tab-but').removeClass('tab-active');
		$('.tab-but-4').addClass('tab-active');
		$('.tab-content').slideUp(0);
		$('.tab-content-4').slideDown(0); 
		return false;	
	});	

	$('.tab-but-5').click(function() {
		$('.tab-but').removeClass('tab-active');
		$('.tab-but-5').addClass('tab-active');
		$('.tab-content').slideUp(0);
		$('.tab-content-5').slideDown(0);	
		return false;	
	});	
	
	/* For Dual Processor Listing Tabs View 1-5-2015 */
	$('.tab-but-1-dual').click(function() {
		$('.tab-but-dual').removeClass('tab-active-dual');
		$('.tab-but-1-dual').addClass('tab-active-dual');
		$('.tab-content-dual').slideUp(0);
		$('.tab-content-1-dual').slideDown(0);	
		return false;	
	});	

	$('.tab-but-2-dual').click(function() {
		$('.tab-but-dual').removeClass('tab-active-dual');
		$('.tab-but-2-dual').addClass('tab-active-dual');
		$('.tab-content-dual').slideUp(0);
		$('.tab-content-2-dual').slideDown(0);	
		return false;	
	});	

	$('.tab-but-3-dual').click(function() {
		$('.tab-but-dual').removeClass('tab-active-dual');
		$('.tab-but-3-dual').addClass('tab-active-dual');
		$('.tab-content-dual').slideUp(0);
		$('.tab-content-3-dual').slideDown(0);	
		return false;	
	});	
	
	
	//Toggles
	
	$('.deploy-toggle-1').click(function() {
		$(this).parent().find('.toggle-content').slideToggle(200);
		$(this).toggleClass('toggle-1-active');
		return false;
	});
	
	$('.deploy-toggle-2').click(function() {
		$(this).parent().find('.toggle-content').slideToggle(200);
		$(this).toggleClass('toggle-2-active');
		return false;
	});
	
	$('.deploy-toggle-3').click(function() {
		$(this).parent().find('.toggle-content').slideToggle(200);
		$(this).find('em strong').toggleClass('toggle-3-active-ball');
		$(this).find('em').toggleClass('toggle-3-active-background');
		return false;
	});
	
	//Submenu Nav
	
	$('.submenu-nav-deploy').click(function() {
		$(this).toggleClass('submenu-nav-deploy-active');
		$(this).parent().find('.submenu-nav-items').slideToggle(200);
		return false;
	});

	// 13-5-2015
	$('.open-list').click(function() {
		$(this).parent().find('.active-list-items').slideToggle(0);
		return false;
	});
	// 14-5-2015	
	$('.open-list2').click(function() {
		$(this).parent().find('.active-list-items').slideToggle(0);
		return false;
	});	
		
	//Sliding Door
	
	$('.sliding-door-top').click(function() {
		$(this).animate({
			left:'101%'
		}, 500, 'easeInOutExpo');
		return false;
	});
	
	$('.sliding-door-bottom a em').click(function() {
		$(this).parent().parent().parent().find('.sliding-door-top').animate({
			left:'0px'
		}, 500, 'easeOutBounce');
		return false
		
	});
		
	/////////////////////////////////////////////////////////////////////////////////////////////
	//Detect user agent for known mobile devices and show hide elements for each specific element
	/////////////////////////////////////////////////////////////////////////////////////////////
	
/*	var isiPhone = 		navigator.userAgent.toLowerCase().indexOf("iphone");
	var isiPad = 		navigator.userAgent.toLowerCase().indexOf("ipad");
	var isiPod = 		navigator.userAgent.toLowerCase().indexOf("ipod");
	var isiAndroid = 	navigator.userAgent.toLowerCase().indexOf("android");
	
	if(isiPhone > -1) 	 {		 $('.ipod-detected').hide();		 $('.ipad-detected').hide();		 $('.iphone-detected').show();		 $('.android-detected').hide();	 }
	if(isiPad > -1)	 {		 	 $('.ipod-detected').hide();		 $('.ipad-detected').show();		 $('.iphone-detected').hide();		 $('.android-detected').hide();	 }
	if(isiPod > -1)	 {		 	 $('.ipod-detected').show();		 $('.ipad-detected').hide();		 $('.iphone-detected').hide();		 $('.android-detected').hide();	 }   
	if(isiAndroid > -1) {		 $('.ipod-detected').hide();		 $('.ipad-detected').hide();		 $('.iphone-detected').hide();		 $('.android-detected').show();	 }   */

	
	//Detect if iOS WebApp Engaged and permit navigation without deploying Safari
/* (function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone") */
    
});

}(jQuery));