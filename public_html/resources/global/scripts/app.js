/**
Core script to handle the entire theme and core functions
**/
var App = function() {
	// IE mode
	var isRTL = false;
	var isIE8 = false;
	var isIE9 = false;
	var isIE10 = false;
	var resizeHandlers = [];
	var assetsPath = '../assets/';
	var globalImgPath = 'global/img/';
	var globalPluginsPath = 'global/plugins/';
	var globalCssPath = 'global/css/';
	// theme layout color set
	var brandColors = {
		'blue': '#89C4F4',
		'red': '#F3565D',
		'green': '#1bbc9b',
		'purple': '#9b59b6',
		'grey': '#95a5a6',
		'yellow': '#F8CB00'
	};
	// initializes main settings
	var handleInit = function() {
		if ($('body').css('direction') === 'rtl') {
			isRTL = true;
		}
		isIE8 = !!navigator.userAgent.match(/MSIE 8.0/);
		isIE9 = !!navigator.userAgent.match(/MSIE 9.0/);
		isIE10 = !!navigator.userAgent.match(/MSIE 10.0/);
		if (isIE10) {
			$('html').addClass('ie10'); // detect IE10 version
		}
		if (isIE10 || isIE9 || isIE8) {
			$('html').addClass('ie'); // detect IE10 version
		}
	};
	// runs callback functions set by App.addResponsiveHandler().
	var _runResizeHandlers = function() {
		// reinitialize other subscribed elements
		for (var i = 0; i < resizeHandlers.length; i++) {
			var each = resizeHandlers[i];
			each.call();
		}
	};
	// handle the layout reinitialization on window resize
	var handleOnResize = function() {
		var resize;
		if (isIE8) {
			var currheight;
			$(window).resize(function() {
				if (currheight == document.documentElement.clientHeight) {
					return; //quite event since only body resized not window.
				}
				if (resize) {
					clearTimeout(resize);
				}
				resize = setTimeout(function() {
					_runResizeHandlers();
				}, 50); // wait 50ms until window resize finishes.                
				currheight = document.documentElement.clientHeight; // store last body client height
			});
		} else {
			$(window).resize(function() {
				if (resize) {
					clearTimeout(resize);
				}
				resize = setTimeout(function() {
					_runResizeHandlers();
				}, 50); // wait 50ms until window resize finishes.
			});
		}
	};


		// Handles custom checkboxes & radios using jQuery Uniform plugin
		var handleUniform = function() {
			if (!$().uniform) {
				return;
			}
			var test = $("input[type=checkbox]:not(.toggle, .md-check, .md-radiobtn, .make-switch, .icheck), input[type=radio]:not(.toggle, .md-check, .md-radiobtn, .star, .make-switch, .icheck)");
			if (test.size() > 0) {
				test.each(function() {
					if ($(this).parents(".checker").size() === 0) {
						$(this).show();
						$(this).uniform();
					}
				});
			}
		};
		// Handlesmaterial design checkboxes
		var handleMaterialDesign = function() {
			// Material design ckeckbox and radio effects
			$('body').on('click', '.md-checkbox > label, .md-radio > label', function() {
				var the = $(this);
				// find the first span which is our circle/bubble
				var el = $(this).children('span:first-child');
				// add the bubble class (we do this so it doesnt show on page load)
				el.addClass('inc');
				// clone it
				var newone = el.clone(true);  
				// add the cloned version before our original
				el.before(newone);  
				// remove the original so that it is ready to run on next click
				$("." + el.attr("class") + ":last", the).remove();
			}); 
			if ($('body').hasClass('page-md')) { 
				// Material design click effect
				// credit where credit's due; http://thecodeplayer.com/walkthrough/ripple-click-effect-google-material-design       
				var element, circle, d, x, y;
				$('body').on('click', 'a.btn, button.btn, input.btn, label.btn', function(e) { 
					element = $(this);
					if(element.find(".md-click-circle").length == 0) {
						element.prepend("<span class='md-click-circle'></span>");
					}
					circle = element.find(".md-click-circle");
					circle.removeClass("md-click-animate");
					if(!circle.height() && !circle.width()) {
						d = Math.max(element.outerWidth(), element.outerHeight());
						circle.css({height: d, width: d});
					}
					x = e.pageX - element.offset().left - circle.width()/2;
					y = e.pageY - element.offset().top - circle.height()/2;
					circle.css({top: y+'px', left: x+'px'}).addClass("md-click-animate");
					setTimeout(function() {
						circle.remove();      
					}, 1000);
				});
			}
			// Floating labels
			var handleInput = function(el) {
				if (el.val() != "") {
					el.addClass('edited');
				} else {
					el.removeClass('edited');
				}
			} 
			$('body').on('keydown', '.form-md-floating-label .form-control', function(e) { 
				handleInput($(this));
			});
			$('body').on('blur', '.form-md-floating-label .form-control', function(e) { 
				handleInput($(this));
			});        
			$('.form-md-floating-label .form-control').each(function()
			{
				if ($('.form-md-floating-label .form-control').val().length > 0) {
					$(this).addClass('edited');
				}
			});
		}
		// Handles custom checkboxes & radios using jQuery iCheck plugin
		var handleiCheck = function() {
			if (!$().iCheck) {
				return;
			}
			$('.icheck').each(function() {
				var checkboxClass = $(this).attr('data-checkbox') ? $(this).attr('data-checkbox') : 'icheckbox_minimal-grey';
				var radioClass = $(this).attr('data-radio') ? $(this).attr('data-radio') : 'iradio_minimal-grey';
				if (checkboxClass.indexOf('_line') > -1 || radioClass.indexOf('_line') > -1) {
					$(this).iCheck({
						checkboxClass: checkboxClass,
						radioClass: radioClass,
						insert: '<div class="icheck_line-icon"></div>' + $(this).attr("data-label")
					});
				} else {
					$(this).iCheck({
					checkboxClass: checkboxClass,
					radioClass: radioClass
					});
				}
			});
		};
		// Handles Bootstrap switches
		var handleBootstrapSwitch = function() {
			if (!$().bootstrapSwitch) {
				return;
			}
			$('.make-switch').bootstrapSwitch();
		};
		// Handles Bootstrap confirmations
		var handleBootstrapConfirmation = function() {
			if (!$().confirmation) {
				return;
			}
			$('[data-toggle=confirmation]').confirmation({ container: 'body', btnOkClass: 'btn btn-sm btn-success', btnCancelClass: 'btn btn-sm btn-danger'});
		}
		// Handles Bootstrap Accordions.
		var handleAccordions = function() {
			$('body').on('shown.bs.collapse', '.accordion.scrollable', function(e) {
				App.scrollTo($(e.target));
			});
		};
		// Handles Bootstrap Tabs.
		var handleTabs = function() {
			//activate tab if tab id provided in the URL
			if (location.hash) {
				var tabid = encodeURI(location.hash.substr(1));
				$('a[href="#' + tabid + '"]').parents('.tab-pane:hidden').each(function() {
					var tabid = $(this).attr("id");
					$('a[href="#' + tabid + '"]').click();
				});
				$('a[href="#' + tabid + '"]').click();
			}
			if ($().tabdrop) {
				$('.tabbable-tabdrop .nav-pills, .tabbable-tabdrop .nav-tabs').tabdrop({
					text: '<i class="fa fa-ellipsis-v"></i>&nbsp;<i class="fa fa-angle-down"></i>'
				});
			}
		};
		// Handles Bootstrap Modals.
		var handleModals = function() {        
			// fix stackable modal issue: when 2 or more modals opened, closing one of modal will remove .modal-open class. 
			$('body').on('hide.bs.modal', function() {
				if ($('.modal:visible').size() > 1 && $('html').hasClass('modal-open') === false) {
					$('html').addClass('modal-open');
				} else if ($('.modal:visible').size() <= 1) {
					$('html').removeClass('modal-open');
				}
			});
			// fix page scrollbars issue
			$('body').on('show.bs.modal', '.modal', function() {
				if ($(this).hasClass("modal-scroll")) {
					$('body').addClass("modal-open-noscroll");
				}
			});
			// fix page scrollbars issue
			$('body').on('hide.bs.modal', '.modal', function() {
				$('body').removeClass("modal-open-noscroll");
			});
			// remove ajax content and remove cache on modal closed 
			$('body').on('hidden.bs.modal', '.modal:not(.modal-cached)', function () {
				$(this).removeData('bs.modal');
			});
		};
		// Handles Bootstrap Tooltips.
		var handleTooltips = function() {
			// global tooltips
			$('.tooltips').tooltip();
			// portlet tooltips
			$('.portlet > .portlet-title .fullscreen').tooltip({
				container: 'body',
				title: 'Fullscreen'
			});
			$('.portlet > .portlet-title > .tools > .reload').tooltip({
				container: 'body',
				title: 'Reload'
			});
			$('.portlet > .portlet-title > .tools > .remove').tooltip({
				container: 'body',
				title: 'Remove'
			});
			$('.portlet > .portlet-title > .tools > .config').tooltip({
				container: 'body',
				title: 'Settings'
			});
			$('.portlet > .portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip({
				container: 'body',
				title: 'Collapse/Expand'
			});
		};
		// Handles Bootstrap Dropdowns
		var handleDropdowns = function() {
			/*
				Hold dropdown on click  
			*/
			$('body').on('click', '.dropdown-menu.hold-on-click', function(e) {
				e.stopPropagation();
			});
		};
		var handleAlerts = function() {
			$('body').on('click', '[data-close="alert"]', function(e) {
				$(this).parent('.alert').hide();
				$(this).closest('.note').hide();
				e.preventDefault();
			});
			$('body').on('click', '[data-close="note"]', function(e) {
				$(this).closest('.note').hide();
				e.preventDefault();
			});
			$('body').on('click', '[data-remove="note"]', function(e) {
				$(this).closest('.note').remove();
				e.preventDefault();
			});
		};
		// Handle Hower Dropdowns
		var handleDropdownHover = function() {
			$('[data-hover="dropdown"]').not('.hover-initialized').each(function() {
				$(this).dropdownHover();
				$(this).addClass('hover-initialized');
			});
		};
		// Handle textarea autosize 
		var handleTextareaAutosize = function() {
			if (typeof(autosize) == "function") {
				autosize(document.querySelector('textarea.autosizeme'));
			}
		}
		// Handles Bootstrap Popovers
		// last popep popover
		var lastPopedPopover;
		var handlePopovers = function() {
			$('.popovers').popover();
			// close last displayed popover
			$(document).on('click.bs.popover.data-api', function(e) {
				if (lastPopedPopover) {
					lastPopedPopover.popover('hide');
				}
			});
		};
		// Handles scrollable contents using jQuery SlimScroll plugin.
		var handleScrollers = function() {
			App.initSlimScroll('.scroller');
		};
		// Handles Image Preview using jQuery Fancybox plugin
		var handleFancybox = function() {
			if (!jQuery.fancybox) {
				return;
			}
			if ($(".fancybox-button").size() > 0) {
				$(".fancybox-button").fancybox({
					groupAttr: 'data-rel',
					prevEffect: 'none',
					nextEffect: 'none',
					closeBtn: true,
					helpers: {
						title: {
							type: 'inside'
						}
					}
				});
			}
		};
		// Handles counterup plugin wrapper
		var handleCounterup = function() {
			if (!$().counterUp) {
				return;
			}
			$("[data-counter='counterup']").counterUp({
				delay: 10,
				time: 1000
			});
		};
		// Fix input placeholder issue for IE8 and IE9
		var handleFixInputPlaceholderForIE = function() {
			//fix html5 placeholder attribute for ie7 & ie8
			if (isIE8 || isIE9) { // ie8 & ie9
				// this is html5 placeholder fix for inputs, inputs with placeholder-no-fix class will be skipped(e.g: we need this for password fields)
				$('input[placeholder]:not(.placeholder-no-fix), textarea[placeholder]:not(.placeholder-no-fix)').each(function() {
					var input = $(this);
					if (input.val() === '' && input.attr("placeholder") !== '') {
						input.addClass("placeholder").val(input.attr('placeholder'));
					}
					input.focus(function() {
						if (input.val() == input.attr('placeholder')) {
							input.val('');
						}
					});
					input.blur(function() {
						if (input.val() === '' || input.val() == input.attr('placeholder')) {
							input.val(input.attr('placeholder'));
						}
					});
				});
			}
		};
		// Handle Select2 Dropdowns
		var handleSelect2 = function() {
			if ($().select2) {
				$.fn.select2.defaults.set("theme", "bootstrap");
				$('.select2me').select2({
					placeholder: "Select",
					width: 'auto', 
					allowClear: true
				});
			}
		};
		// handle group element heights
	 	var handleHeight = function() {
			$('[data-auto-height]').each(function() {
				var parent = $(this);
				var items = $('[data-height]', parent);
				var height = 0;
				var mode = parent.attr('data-mode');
				var offset = parseInt(parent.attr('data-offset') ? parent.attr('data-offset') : 0);
				items.each(function() {
					if ($(this).attr('data-height') == "height") {
						$(this).css('height', '');
					} else {
						$(this).css('min-height', '');
					}
					var height_ = (mode == 'base-height' ? $(this).outerHeight() : $(this).outerHeight(true));
					if (height_ > height) {
						height = height_;
					}
				});
				height = height + offset;
				items.each(function() {
					if ($(this).attr('data-height') == "height") {
					$(this).css('height', height);
					} else {
						$(this).css('min-height', height);
					}
			});
			if(parent.attr('data-related')) {
				$(parent.attr('data-related')).css('height', parent.height());
			}
		});       
	}

	// Handles portlet tools & actions
var handlePortletTools = function() {

		$('#gallary_component').removeClass('on');
		$('#gallary_component').removeClass('portlet-fullscreen');
		$('#gallary_component').removeClass('page-portlet-fullscreen');

    $('body').on('click', '.media_manager', function(e) 
    {

    			 e.preventDefault();   
    			 
    			 var imgIDs = $('input[name="img_id"]').val();
    			 if(imgIDs != null && imgIDs != undefined && imgIDs != '')
    			 {
    			 		MediaManager.setMyUploadTab(window.user_id,imgIDs);
    			 }else{
    			 	MediaManager.setImageUploadTab();	
    			 }


    			 var portlet = $('#gallary_component > .portlet-title').closest("#gallary_component");
    			 portlet.css('display','block');

    			 portlet.removeClass('portlet-fullscreen');

    			 if (portlet.hasClass('portlet-fullscreen')) {
    			 		
            	$('#gallary_component > .portlet-title').removeClass('on');
            	portlet.removeClass('portlet-fullscreen');
            	$('body').removeClass('page-portlet-fullscreen');
            	portlet.children('#gallary_component .portlet-body').css('height', 'auto');

		        } else {
		            var height = App.getViewPort().height -
		                portlet.children('#gallary_component .portlet-title').outerHeight() -
		                parseInt(portlet.children('.portlet-body').css('padding-top')) -
		                parseInt(portlet.children('.portlet-body').css('padding-bottom'));

		            $('#gallary_component > .portlet-title').addClass('on');
		            portlet.addClass('portlet-fullscreen');
		            $('body').addClass('page-portlet-fullscreen');
		            portlet.children('#gallary_component .portlet-body').css('height', height);
		        } 

    });

    // handle portlet remove
    $('body').on('click', '#gallary_component > .portlet-title > .tools > a.remove', function(e) {

        e.preventDefault();
        var portlet = $(this).closest("#gallary_component");

        if ($('body').hasClass('page-portlet-fullscreen')) {
            $('body').removeClass('page-portlet-fullscreen');
        }

        portlet.find('#gallary_component .portlet-title .fullscreen').tooltip('destroy');
        portlet.find('#gallary_component .portlet-title > .tools > .reload').tooltip('destroy');
        portlet.find('#gallary_component .portlet-title > .tools > .remove').tooltip('destroy');
        portlet.find('#gallary_component .portlet-title > .tools > .config').tooltip('destroy');
        portlet.find('#gallary_component .portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip('destroy');
        portlet.hide();
    });

    //for video manager start
    $('#video_component').removeClass('on');
		$('#video_component').removeClass('portlet-fullscreen');
		$('#video_component').removeClass('page-portlet-fullscreen');

    $('body').on('click', '.video_manager', function(e) 
    {
    			 e.preventDefault();

    			var videoIDs = $('input[name="video_id"]').val();
           if(videoIDs != null && videoIDs != undefined && videoIDs != '')
            {
                MediaManager.setMyVideosTab(window.user_id,videoIDs);
           }else{
              MediaManager.setMyUploadVideoTab(); 
              //  MediaManager.setVideoFromUrlTab(); 
           }



    			 var portlet = $('#video_component > .portlet-title').closest("#video_component");
    			 portlet.css('display','block');

    			 portlet.removeClass('portlet-fullscreen');

    			 if (portlet.hasClass('portlet-fullscreen')) {
    			 		
            	$('#video_component > .portlet-title').removeClass('on');
            	portlet.removeClass('portlet-fullscreen');
            	$('body').removeClass('page-portlet-fullscreen');
            	portlet.children('#video_component .portlet-body').css('height', 'auto');

		        } else {
		            var height = App.getViewPort().height -
		                portlet.children('#video_component .portlet-title').outerHeight() -
		                parseInt(portlet.children('.portlet-body').css('padding-top')) -
		                parseInt(portlet.children('.portlet-body').css('padding-bottom'));

		            $('#video_component > .portlet-title').addClass('on');
		            portlet.addClass('portlet-fullscreen');
		            $('body').addClass('page-portlet-fullscreen');
		            portlet.children('#video_component .portlet-body').css('height', height);
		        } 

    });

    // handle portlet remove
    $('body').on('click', '#video_component > .portlet-title > .tools > a.remove', function(e)
     {

        e.preventDefault();	
        var portlet = $(this).closest("#video_component");

        if ($('body').hasClass('page-portlet-fullscreen')) {
            $('body').removeClass('page-portlet-fullscreen');
        }

        portlet.find('#video_component .portlet-title .fullscreen').tooltip('destroy');
        portlet.find('#video_component .portlet-title > .tools > .reload').tooltip('destroy');
        portlet.find('#video_component .portlet-title > .tools > .remove').tooltip('destroy');
        portlet.find('#video_component .portlet-title > .tools > .config').tooltip('destroy');
        portlet.find('#video_component .portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip('destroy');
        portlet.hide();
    });

    //for video manager end

    //for document manager start

    $('#document_component').removeClass('on');
		$('#document_component').removeClass('portlet-fullscreen');
		$('#document_component').removeClass('page-portlet-fullscreen');

    $('body').on('click', '.document_manager', function(e) 
    {
    			 e.preventDefault();
    			 var docIDs = $('input[name="doc_id"]').val();
    			 if(docIDs != null && docIDs != undefined && docIDs != '')
    			 {
    			 		MediaManager.setDocumentListTab(window.user_id,docIDs);
    			 }else{
    			 		MediaManager.setDocumentUploadTab();
    			 }
    			 
    			 var portlet = $('#document_component > .portlet-title').closest("#document_component");
    			 portlet.css('display','block');

    			 portlet.removeClass('portlet-fullscreen');

    			 if (portlet.hasClass('portlet-fullscreen')) {
    			 		
            	$('#document_component > .portlet-title').removeClass('on');
            	portlet.removeClass('portlet-fullscreen');
            	$('body').removeClass('page-portlet-fullscreen');
            	portlet.children('#document_component .portlet-body').css('height', 'auto');

		        } else {
		            var height = App.getViewPort().height -
		                portlet.children('#document_component .portlet-title').outerHeight() -
		                parseInt(portlet.children('.portlet-body').css('padding-top')) -
		                parseInt(portlet.children('.portlet-body').css('padding-bottom'));

		            $('#document_component > .portlet-title').addClass('on');
		            portlet.addClass('portlet-fullscreen');
		            $('body').addClass('page-portlet-fullscreen');
		            portlet.children('#document_component .portlet-body').css('height', height);
		        } 

    });

    // handle portlet remove
    $('body').on('click', '#document_component > .portlet-title > .tools > a.remove', function(e) {

        e.preventDefault();	
        var portlet = $(this).closest("#document_component");

        if ($('body').hasClass('page-portlet-fullscreen')) {
            $('body').removeClass('page-portlet-fullscreen');
        }

        portlet.find('#document_component .portlet-title .fullscreen').tooltip('destroy');
        portlet.find('#document_component .portlet-title > .tools > .reload').tooltip('destroy');
        portlet.find('#document_component .portlet-title > .tools > .remove').tooltip('destroy');
        portlet.find('#document_component .portlet-title > .tools > .config').tooltip('destroy');
        portlet.find('#document_component .portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip('destroy');
        portlet.hide();
    });

    //for document manager end
   
   };
   
	//* END:CORE HANDLERS *//
	return {
		//main function to initiate the theme
		init: function() {
			//IMPORTANT!!!: Do not modify the core handlers call order.
			//Core handlers
			handleInit(); // initialize core variables
			handleOnResize(); // set and handle responsive    
			//UI Component handlers     
			handleMaterialDesign(); // handle material design       
			//handleUniform(); // hanfle custom radio & checkboxes
			handleiCheck(); // handles custom icheck radio and checkboxes
			handleBootstrapSwitch(); // handle bootstrap switch plugin
			handleScrollers(); // handles slim scrolling contents 
			handleFancybox(); // handle fancy box
			handleSelect2(); // handle custom Select2 dropdowns
			handlePortletTools(); // handles portlet action bar functionality(refresh, configure, toggle, remove)
			handleAlerts(); //handle closabled alerts
			handleDropdowns(); // handle dropdowns
			handleTabs(); // handle tabs
			handleTooltips(); // handle bootstrap tooltips
			handlePopovers(); // handles bootstrap popovers
			handleAccordions(); //handles accordions 
			handleModals(); // handle modals
			handleBootstrapConfirmation(); // handle bootstrap confirmations
			handleTextareaAutosize(); // handle autosize textareas
			handleCounterup(); // handle counterup instances
			//Handle group element heights
			this.addResizeHandler(handleHeight); // handle auto calculating height on window resize
			// Hacks
			handleFixInputPlaceholderForIE(); //IE8 & IE9 input placeholder issue fix
		},
		//main function to initiate core javascript after ajax complete
		initAjax: function() {
			handleUniform(); // handles custom radio & checkboxes     
			handleiCheck(); // handles custom icheck radio and checkboxes
			handleBootstrapSwitch(); // handle bootstrap switch plugin
			handleDropdownHover(); // handles dropdown hover       
			handleScrollers(); // handles slim scrolling contents 
			handleSelect2(); // handle custom Select2 dropdowns
			handleFancybox(); // handle fancy box
			handleDropdowns(); // handle dropdowns
			handleTooltips(); // handle bootstrap tooltips
			handlePopovers(); // handles bootstrap popovers
			handleAccordions(); //handles accordions 
			handleBootstrapConfirmation(); // handle bootstrap confirmations
		},
		//init main components 
		initComponents: function() {
			this.initAjax();
		},
		//public function to remember last opened popover that needs to be closed on click
		setLastPopedPopover: function(el) {
			lastPopedPopover = el;
		},
		//public function to add callback a function which will be called on window resize
		addResizeHandler: function(func) {
			resizeHandlers.push(func);
		},
		//public functon to call _runresizeHandlers
		runResizeHandlers: function() {
			_runResizeHandlers();
		},
		// wrApper function to scroll(focus) to an element
		scrollTo: function(el, offeset) {
			var pos = (el && el.size() > 0) ? el.offset().top : 0;
			if (el) {
				if ($('body').hasClass('page-header-fixed')) {
					pos = pos - $('.page-header').height();
				} else if ($('body').hasClass('page-header-top-fixed')) {
					pos = pos - $('.page-header-top').height();
				} else if ($('body').hasClass('page-header-menu-fixed')) {
					pos = pos - $('.page-header-menu').height();
				}
				pos = pos + (offeset ? offeset : -1 * el.height());
			}
			$('html,body').animate({
				scrollTop: pos
			}, 'slow');
		},
		initSlimScroll: function(el) {
			$(el).each(function() {
			if ($(this).attr("data-initialized")) {
				return; 
			}
			var height;
			if ($(this).attr("data-height")) {
				height = $(this).attr("data-height");
			} else {
				height = $(this).css('height');
			}
			$(this).slimScroll({
				allowPageScroll: true, // allow page scroll when the element scroll is ended
				size: '7px',
				color: ($(this).attr("data-handle-color") ? $(this).attr("data-handle-color") : '#bbb'),
				wrapperClass: ($(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : 'slimScrollDiv'),
				railColor: ($(this).attr("data-rail-color") ? $(this).attr("data-rail-color") : '#eaeaea'),
				position: isRTL ? 'left' : 'right',
				height: height,
				alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
				railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
				disableFadeOut: true
			});
			$(this).attr("data-initialized", "1");
		});
	},
	destroySlimScroll: function(el) {
		$(el).each(function() {
		if ($(this).attr("data-initialized") === "1") { // destroy existing instance before updating the height
			$(this).removeAttr("data-initialized");
			$(this).removeAttr("style");
			var attrList = {};
			// store the custom attribures so later we will reassign.
			if ($(this).attr("data-handle-color")) {
				attrList["data-handle-color"] = $(this).attr("data-handle-color");
			}
			if ($(this).attr("data-wrapper-class")) {
				attrList["data-wrapper-class"] = $(this).attr("data-wrapper-class");
			}
			if ($(this).attr("data-rail-color")) {
				attrList["data-rail-color"] = $(this).attr("data-rail-color");
			}
			if ($(this).attr("data-always-visible")) {
				attrList["data-always-visible"] = $(this).attr("data-always-visible");
			}
			if ($(this).attr("data-rail-visible")) {
				attrList["data-rail-visible"] = $(this).attr("data-rail-visible");
			}
			$(this).slimScroll({
				wrapperClass: ($(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : 'slimScrollDiv'),
				destroy: true
			});
			var the = $(this);
			// reassign custom attributes
			$.each(attrList, function(key, value) {
				the.attr(key, value);
			});
		}
	});
},
// function to scroll to the top
scrollTop: function() {
	App.scrollTo();
},
// wrApper function to  block element(indicate loading)
blockUI: function(options) {
	options = $.extend(true, {}, options);
	var html = '';
	if (options.animate) {
		html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '">' + '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' + '</div>';
	} else if (options.iconOnly) {
		html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""></div>';
	} else if (options.textOnly) {
		html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
	} else {
		html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
	}
	if (options.target) { // element blocking
		var el = $(options.target);
		if (el.height() <= ($(window).height())) {
			options.cenrerY = true;
		}
		el.block({
			message: html,
			baseZ: options.zIndex ? options.zIndex : 1000,
			centerY: options.cenrerY !== undefined ? options.cenrerY : false,
			css: {
				top: '10%',
				border: '0',
				padding: '0',
				backgroundColor: 'none'
			},
			overlayCSS: {
				backgroundColor: options.overlayColor ? options.overlayColor : '#555',
				opacity: options.boxed ? 0.05 : 0.1,
				cursor: 'wait'
			}
		});
	} else { // page blocking
		$.blockUI({
			message: html,
			baseZ: options.zIndex ? options.zIndex : 1000,
			css: {
				border: '0',
				padding: '0',
				backgroundColor: 'none'
			},
			overlayCSS: {
				backgroundColor: options.overlayColor ? options.overlayColor : '#555',
				opacity: options.boxed ? 0.05 : 0.1,
				cursor: 'wait'
			}
		});
	}
},

				// wrApper function to  un-block element(finish loading)
				unblockUI: function(target) {
						if (target) {
								$(target).unblock({
										onUnblock: function() {
												$(target).css('position', '');
												$(target).css('zoom', '');
										}
								});
						} else {
								$.unblockUI();
						}
				},

				startPageLoading: function(options) {
						if (options && options.animate) {
								$('.page-spinner-bar').remove();
								$('body').append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
						} else {
								$('.page-loading').remove();
								$('body').append('<div class="page-loading"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif"/>&nbsp;&nbsp;<span>' + (options && options.message ? options.message : 'Loading...') + '</span></div>');
						}
				},

				stopPageLoading: function() {
						$('.page-loading, .page-spinner-bar').remove();
				},

				alert: function(options) {

						options = $.extend(true, {
								container: "", // alerts parent container(by default placed after the page breadcrumbs)
								place: "append", // "append" or "prepend" in container 
								type: 'success', // alert's type
								message: "", // alert's message
								close: true, // make alert closable
								reset: true, // close all previouse alerts first
								focus: true, // auto scroll to the alert after shown
								closeInSeconds: 0, // auto close after defined seconds
								icon: "" // put icon before the message
						}, options);

						var id = App.getUniqueID("App_alert");

						var html = '<div id="' + id + '" class="custom-alerts alert alert-' + options.type + ' fade in">' + (options.close ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' : '') + (options.icon !== "" ? '<i class="fa-lg fa fa-' + options.icon + '"></i>  ' : '') + options.message + '</div>';

						if (options.reset) {
								$('.custom-alerts').remove();
						}

						if (!options.container) {
								if ($('.page-fixed-main-content').size() === 1) {
										$('.page-fixed-main-content').prepend(html);
								} else if (($('body').hasClass("page-container-bg-solid") || $('body').hasClass("page-content-white")) && $('.page-head').size() === 0) {
										$('.page-title').after(html);
								} else {
										if ($('.page-bar').size() > 0) {
												$('.page-bar').after(html);
										} else {
												$('.page-breadcrumb, .breadcrumbs').after(html);
										}
								}
						} else {
								if (options.place == "append") {
										$(options.container).append(html);
								} else {
										$(options.container).prepend(html);
								}
						}

						if (options.focus) {
								App.scrollTo($('#' + id));
						}

						if (options.closeInSeconds > 0) {
								setTimeout(function() {
										$('#' + id).remove();
								}, options.closeInSeconds * 1000);
						}

						return id;
				},

				// initializes uniform elements
				initUniform: function(els) {
						if (els) {
								$(els).each(function() {
										if ($(this).parents(".checker").size() === 0) {
												$(this).show();
												$(this).uniform();
										}
								});
						} else {
								handleUniform();
						}
				},

				//wrApper function to update/sync jquery uniform checkbox & radios
				updateUniform: function(els) {
						$.uniform.update(els); // update the uniform checkbox & radios UI after the actual input control state changed
				},

				//public function to initialize the fancybox plugin
				initFancybox: function() {
						handleFancybox();
				},

				//public helper function to get actual input value(used in IE9 and IE8 due to placeholder attribute not supported)
				getActualVal: function(el) {
						el = $(el);
						if (el.val() === el.attr("placeholder")) {
								return "";
						}
						return el.val();
				},

				//public function to get a paremeter by name from URL
				getURLParameter: function(paramName) {
						var searchString = window.location.search.substring(1),
								i, val, params = searchString.split("&");

						for (i = 0; i < params.length; i++) {
								val = params[i].split("=");
								if (val[0] == paramName) {
										return unescape(val[1]);
								}
						}
						return null;
				},

				// check for device touch support
				isTouchDevice: function() {
						try {
								document.createEvent("TouchEvent");
								return true;
						} catch (e) {
								return false;
						}
				},

				// To get the correct viewport width based on  http://andylangton.co.uk/articles/javascript/get-viewport-size-javascript/
				getViewPort: function() {
						var e = window,
								a = 'inner';
						if (!('innerWidth' in window)) {
								a = 'client';
								e = document.documentElement || document.body;
						}

						return {
								width: e[a + 'Width'],
								height: e[a + 'Height']
						};
				},

				getUniqueID: function(prefix) {
						return 'prefix_' + Math.floor(Math.random() * (new Date()).getTime());
				},

				// check IE8 mode
				isIE8: function() {
						return isIE8;
				},

				// check IE9 mode
				isIE9: function() {
						return isIE9;
				},

				//check RTL mode
				isRTL: function() {
						return isRTL;
				},

				// check IE8 mode
				isAngularJsApp: function() {
						return (typeof angular == 'undefined') ? false : true;
				},

				getAssetsPath: function() {
						return assetsPath;
				},

				setAssetsPath: function(path) {
						assetsPath = path;
				},

				setGlobalImgPath: function(path) {
						globalImgPath = path;
				},

				getGlobalImgPath: function() {
						return assetsPath + globalImgPath;
				},

				setGlobalPluginsPath: function(path) {
						globalPluginsPath = path;
				},

				getGlobalPluginsPath: function() {
						return assetsPath + globalPluginsPath;
				},

				getGlobalCssPath: function() {
						return assetsPath + globalCssPath;
				},

				// get layout color code by color name
				getBrandColor: function(name) {
						if (brandColors[name]) {
								return brandColors[name];
						} else {
								return '';
						}
				},

				getResponsiveBreakpoint: function(size) {
						// bootstrap responsive breakpoints
						var sizes = {
								'xs' : 480,     // extra small
								'sm' : 768,     // small
								'md' : 992,     // medium
								'lg' : 1200     // large
						};

						return sizes[size] ? sizes[size] : 0; 
				}
		};
}();
jQuery(document).ready(function() {    
 	App.init(); // init metronic core componets
});
/*Start code for global search*/
function search(){
	var searchData = '';
	var value = $('#inputsearch').val();
	if(value!=''){
		searchData = value;
	}else{
		searchData = '';
	}
	if((searchData.length)>2){
		$.ajax({
			type : "POST",
			autoFocus:true,
			url: site_url+'/powerpanel/global',
			data: ({searchValue:searchData}),
			success: function(data) {
				var response = $.parseJSON(data);
				displayList(response.results, response.guess_words);
				App.initSlimScroll('.scroller');
			},
		});
	}
}
$('#inputsearch').keyup(function(){	
	search();
});
$('#globalsearch').click(function(){
	search();
});
function displayList(list, guess_words){
	var html = '';
	if(list != ''){
		html += '<li class="mean">Did you mean: <a href="javascript:void(0);" id="suggestion"><b>'+guess_words+'</b></a></li>';
		html += '<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible="1" data-rail-color="black" data-handle-color="#32c5d2">';
		html += '<ul class="dropdown-menu-list">';
		for(i=0;i<list.length;i++){
			html += '<li><a title="'+list[i].name+'" href="'+site_url+'/powerpanel/'+list[i].type.split(" ")[0].toLowerCase()+'/'+list[i].alias_name+'/edit'+'"><div class="img"><img src="'+list[i].image_url+'"/></div><span>'+list[i].name+'</span><label>'+list[i].title+'</label></a></li>';
		}
		html +='</ul>';
		html +='</div>';
		$('.list').html($(html));
	}else{
		html += '<li style="text-align: center; padding: 8px; list-style-type:none;">No records found.</li>';		
		$('.list').html($(html));
	}
}
$('body').on('click',function(e){
	var className = e.target.className;
	if(className!='form-control' && className!='icon-magnifier' && className!=''){
		$('.list ul').remove(); 	
	}
});
$(document).on('click','#suggestion',function(){
	$('#inputsearch').val($('#suggestion b').text());
	search();
});
/*End code for global search*/
/*Start notification for hover*/
$('#notification').hover(function(){
	$.ajax({
		type : "POST",
		url: site_url+'/powerpanel/'+'notification',
		success: function(data){
			var response = $.parseJSON(data);
			var html = '';
			if(response.error){
				html	=	html + '<ul class="dropdown-menu-list" style="height: 250px;" data-handle-color="#637283">';
				html	=	html +'<li>';	
				html	=	html + '<center><span class="details">'+ response.error +'</span></center>';
				html	=	html + '</li>'
				html	=	html + '</ul>';
				$('#notification_html').html(html);
			}else{
				html = html + '<li class="msg-btn" style="margin:-10.4% 0 0 78%;padding: 0 0 3% 0 !important;">';
				html = html + '<a href="'+site_url+'/powerpanel/recentupdate" title="See all" class="btn btn-sm default">See all</a>';
				html = html + '</li>';
				html = html + '<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible="1" data-rail-color="black" data-handle-color="#32c5d2">';
				html = html + '<ul class="dropdown-menu-list">';
				$.each(response, function(key, value){	
					if(value.chr_read == 'N'){
						var unread = "unread";
					}else{
						var unread = "";
					}
					if(value.chr_record_delete!='Y'){
						html = html + '<li id='+ value.id +' class="'+unread+'">';
						html = html + '<a href="'+value.alias+'">';
						html = html + '<span class="time">'+ value.time +'</span>';
						html = html +	'<span class="details">';
						html = html +  value.notificationhtml;
						html = html + '</span></a>';
						html = html + '</li>';		
					}else{
						html = html + '<li id='+ value.id +' class="'+unread+'">';
						html = html + '<a href="'+value.link+'">';
						html = html + '<span class="time">'+ value.time +'</span>';
						html = html +	'<span class="details">';
						html = html +  value.notificationhtml;
						html = html + '</span></a>';
						html = html + '</li>';		
					}
				});
				var html = html + '</ul></div>';
				$('#notification_html').html(html);
					$('#notification_html ul li').hover(function(){
						var notification_id = this.id;
						if($(this).hasClass('unread')){
							$.ajax({
								type: "POST",
								cache: true,
								url: site_url+'/powerpanel/notification/update_read_status',
								data:{'notification_id':notification_id},
								success: function(data){		
									App.initSlimScroll('.scroller');
									if(data == 'true'){
										$('#notification_html ul #'+notification_id).removeClass('unread');
										get_notification_count();
									}	
								},
								error: function(xhr, ajaxOptions, thrownError){
									
								},
									async: false
							});
						}
					},function(){
						return false;
				});
			}
			App.initSlimScroll('.scroller');
		}
	});
},function(){
	$('.dropdown-notification').removeClass('open');  	
});
function get_notification_count()
{
	$.ajax({
		type: "POST",
		cache: true,
		url: site_url+'/powerpanel/notification/get_read_notification_count',
		success: function(data) {	
			if(data > 0){
				$('.notification-count').text(data).addClass('badge badge-success');
				$('.notification-count-bold').html('<h3><span class="bold">'+data+' Pending</span> notifications</h3>');
			}else{
				$('.notification-count').hide();
				$('.notification-count-bold').html('<h3><span class="bold">Notifications</span></h3>');
			}	
		},
		error: function(xhr, ajaxOptions, thrownError){
			
		},
		async: false
	});
}	
//get_notification_count();
/*End notification for hover*/
/*Start message for hover*/
$('#message').hover(function(){
	$.ajax({
		type : "POST",
		url: site_url+'/powerpanel/'+'message',
		success: function(data){
			var response = $.parseJSON(data);
			var html = '';
			if(response.error){
				html	=	html + '<ul class="dropdown-menu-list" style="height: 250px;" data-handle-color="#637283">';
				html	=	html +'<li>';	
				html	=	html + '<center><span class="details">'+ response.error +'</span></center>';
				html	=	html + '</li>';
				html	=	html + '</ul>';
				$('#message_html').html(html);
			}else{
				html = html + '<li class="msg-btn" style="margin: -10.4% 0 0 78%;padding: 0 0 3% 0 !important;">';
				html = html +	'<a href="'+site_url+'/powerpanel/contactlead" title="See all" class="btn btn-sm default">See all</a>';
				html = html +	'</li>';
				html = html + '<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible="1" data-rail-color="black" data-handle-color="#32c5d2">';
				html = html + '<ul class="dropdown-menu-list">';
				$.each(response, function(key, value){	
					if(value.chr_read == 'N'){
						var unread = "unread";
					}else{
						var unread = "";
					}
					html = html + '<li id='+ value.id +' class="'+unread+'">';
					html = html + '<a href="'+value.alias+'">';
					html = html + '<span class="time">'+ value.time +'</span>';
					html = html +	'<span class="details">'+ value.messagehtml +'</span>';
					html = html + '</a>';
					html = html + '</li>';		
				});
				var html = html + '</ul></div>';
				$('#message_html').html(html);
					$('#message_html ul li').hover(function(){
						var message_id = this.id;
						if($(this).hasClass('unread')){
							$.ajax({
								type: "POST",
								cache: true,
								url: site_url+'/powerpanel/message/update_read_status',
								data:{'message_id':message_id},
								success: function(data){		
									App.initSlimScroll('.scroller');
									if(data == 'true'){
										$('#message_html ul #'+message_id).removeClass('unread');
										get_message_count();
									}	
								},
								error: function(xhr, ajaxOptions, thrownError){
									
								},
									async: false
							});
						}
					},function(){
						return false;
				});
			}
			App.initSlimScroll('.scroller');
		}
	});
},function(){
	$('.dropdown-message').removeClass('open');  	
});
function get_message_count(){
	$.ajax({
		type: "POST",
		cache: true,
		url: site_url+'/powerpanel/message/get_read_message_count',
		success: function(data) {	
			if(data > 0){
				$('.message-count').text(data).addClass('badge badge-danger');
				$('.message-count-bold').html('<h3><span class="bold">'+data+' New</span> messages</h3>');
			}else{
				$('.message-count').hide();
				$('.message-count-bold').html('<h3><span class="bold">Messages</span></h3>');
			}	
		},
		error: function(xhr, ajaxOptions, thrownError){
			
		},
		async: false
	});
}	
//get_message_count();
/*End message for hover*/
$(window).load(function(){
	if($("body.page-md").hasClass("page-sidebar-closed")==true) {
		$('.sidebar-toggler').attr('title','Click here to expand menu and show the titles');
	}else{
		$('.sidebar-toggler').attr('title','Click here to collapse menu and hide the titles');
	}
});
$('.sidebar-toggler').click(function(){
	if($("body.page-md").hasClass("page-sidebar-closed")==true) {
		$('div.sidebar-toggler').attr('title','Click here to collapse menu and hide the titles');
	}else{
		$('.sidebar-toggler').attr('title','Click here to expand menu and show the titles');
	}
});

/*Start languages*/
$('select[name=locale]').change(function(){
	document.cookie = "locale=; expires=Thu, 31 Dec 1970 12:00:00 UTC";		
	document.cookie = "locale="+$('select[name=locale]').val()+"; expires=Thu, 31 Dec 2020 12:00:00 UTC";		
	window.location.reload();	
});
