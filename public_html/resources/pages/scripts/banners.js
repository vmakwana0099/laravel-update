/**
* This method show hides default banner fields
* since   2016-12-22
* author  NetQuick
*/
var Custom = function () {
	return {
		//main function
		init: function () {
			//initialize here something.       
		}, 
		checkType : function(){
			var radioValue = $("input[name='banner_type']:checked").val();			
			if(radioValue == 'inner_banner'){
				$('#pages').show();				
				if($('#modules').val()!=' '){
					$('#records').show();
				}				
				$('#inner_recommandation').show();
				$('#home_recommandation').hide();
				$('#imguploader').show();
				// $('.bannerfrom').hide();
				$("input[name='defaultBanner']").removeAttr('disabled');
				$("input[name='defaultBanner']").closest('.form-group').show();
				$('#tag_line_div').hide();
				$('#feature_list').hide();
				$('#feature_list_inner').show();
				$('#imguploader').show();
			}else if(radioValue == 'home_banner'){				
				$('#pages').hide();
				$('#records').hide();
				$('#home_recommandation').show();
				// $('.bannerfrom').show();
				// Custom.checkVersion();
				$('#inner_recommandation').hide();				
				$("input[name='defaultBanner']").attr('disabled',true);
				$("input[name='defaultBanner']").closest('.form-group').hide();
				$('#tag_line_div').show();
				$('#feature_list').show();
				$('#feature_list_inner').hide();
				$('#imguploader').show();
			}
		},
		checkBannerFrom : function(){
			var radioValue = $("input[name='bannerfrom']:checked").val();
			var radioValue2 = $("input[name='bannerversion']:checked").val();

			if(radioValue2 == 'img_banner' && radioValue == 'from_url'){
				$('#dsk_source_url_div').show();
				$('#mobi_source_url_div').show();
				$('#ipad_source_url_div').show();
				$('#imguploader').hide();
				$('#viduploader').hide();
			}else if(radioValue2 == 'img_banner' && radioValue == 'from_src'){
				$('#dsk_source_url_div').hide();
				$('#mobi_source_url_div').hide();
				$('#ipad_source_url_div').hide();
				$('#imguploader').show();
				$('#viduploader').hide();
			}else if(radioValue2 == 'vid_banner' && radioValue == 'from_url'){
				$('#dsk_source_url_div').show();
				$('#mobi_source_url_div').show();
				$('#ipad_source_url_div').show();
				$('#imguploader').hide();
				$('#viduploader').hide();
			}else if(radioValue2 == 'vid_banner' && radioValue == 'from_src'){
				$('#dsk_source_url_div').hide();
				$('#ipad_source_url_div').hide();
				$('#mobi_source_url_div').hide();
				$('#imguploader').hide();
				$('#viduploader').show();
			}else if(radioValue2 == 'vid_banner' && (radioValue == 'from_src' || radioValue == 'from_url') ){
				$('#dsk_source_url_div').hide();
				$('#mobi_source_url_div').hide();
				$('#ipad_source_url_div').hide();
				$('#imguploader').show();
				$('#viduploader').hide();
			}
		},
		checkVersion : function(){
			var radioValue = $("input[name='bannerversion']:checked").val();
			if(radioValue == 'html_banner'){
				setTimeout( function() { $("div[id*='cke_txtHtmlBanner'] , #txtHtmlBanner_div").show(); }, 3000);
			}else{
				setTimeout( function() { $("div[id*='cke_txtHtmlBanner'], #txtHtmlBanner_div").hide(); }, 3000);
			}
			if(radioValue == 'img_banner'){
				// alert("img_banner");
				$("div[id*='cke_txtHtmlBanner'], #txtHtmlBanner_div").hide();
				$('#dsk_source_url_div').show();
				$('#ipad_source_url_div').show();
				$('#mobi_source_url_div').show();
				$('#button_link_div').show();
				$('.bannerfrom').show();

				$('#imguploader').show();
				$('#viduploader').hide();
			}else if(radioValue == 'html_banner'){
				// alert("html_banner");
				$('#button_link_div').hide();
				$("div[id*='cke_txtHtmlBanner'], #txtHtmlBanner_div").show();
				$('#dsk_source_url_div').hide();
				$('#ipad_source_url_div').hide();
				$('#mobi_source_url_div').hide();
				$('.bannerfrom').hide();
				
				$('#imguploader').show();
				$('#viduploader').hide();
			}else if(radioValue == 'vid_banner'){
				// alert("else ");
				$('.bannerfrom').show();
				$('#imguploader').hide();
				$("div[id*='cke_txtHtmlBanner'], #txtHtmlBanner_div").hide();
				$('#dsk_source_url_div').show();
				$('#ipad_source_url_div').show();
				$('#mobi_source_url_div').show();
				$('#button_link_div').show();
				$('#viduploader').show();

				$('#imguploader').hide();
				$('#viduploader').show();
			}
			$('#modules').select2({
					placeholder: "Select Module",
					width: '100%',
					minimumResultsForSearch: 5
			});
		},
		getModuleRecords : function(moduleName, modelName){
			var ajaxUrl = site_url+'/powerpanel/banners/selectRecords';
			jQuery.ajax({
				type: "POST",
				url: ajaxUrl,
				dataType:'HTML',
				data: { "module" : moduleName, "model":modelName, 'selected':selectedRecord },
				async: false,        
				success: function(result){
					$('#foritem').html(result).select2({
						placeholder: "Select Module",
						width: '100%',
						minimumResultsForSearch: 5			
					});					
				}
			});
		}
	}
}();
/**
* This method validates banner form fields
* since   2016-12-24
* author  NetQuick
*/
var Validate = function() {
	var handleBanner = function() {
		$("#frmBanner").validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			ignore: [],
			rules: {
				title: {
					required:true,
					noSpace:true
				},
				tag_line: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},
				/*title_feature1: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},
				title_feature2: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},
				title_feature3: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},
				title_feature4: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},*/
				/*feature1_icon: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},
				feature2_icon: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},
				feature3_icon: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},
				feature4_icon: {
					required:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					},
					noSpace:{
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}
					}
				},*/
				// button_text: {
				// 	required:{
				// 		depends: function() {
				// 			if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
				// 			else{return false;}
				// 		}
				// 	},
				// 	noSpace:{
				// 		depends: function() {
				// 		if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
				// 			else{return false;}
				// 		}
				// 	}
				// },
				button_link: {
					// required:{
					// 	depends: function() {
					// 		if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
					// 		else{return false;}
					// 	}
					// },
					// noSpace:{
					// 	depends: function() {
					// 	if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
					// 		else{return false;}
					// 	}
					// },
					url: {depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){return true}
							else{return false;}
						}},
				},
				description: "required",
				display_order: {
						required: true,
						minStrict: true,
						number: true,
						noSpace:true
				},
				image_upload: {
					required: {
						depends: function() {
							return $('.versionradio[value="img_banner"]:checked').length > 0;
						}
					}
				},
				video_id:{
					required: {
						depends: function() {
							if ($('.versionradio[value="vid_banner"]:checked').length > 0) {
								if ($("input[name='bannerfrom']:checked").val() == 'from_url') { return false; }
								else if ($("input[name='bannerfrom']:checked").val() == 'from_src') { return true; }
							}else{ return false; }
						}
					}
				},
				modules: {          
					required: {
						depends: function() {
							return $('#inner_banner[value="inner_banner"]:checked').length > 0;
						}
					},
					noSpace: {
						depends: function() {
							return $('#inner_banner[value="inner_banner"]:checked').length > 0;
						}
					}
				},
				foritem: {          
					required: {
						depends: function() {
							return $('#inner_banner[value="inner_banner"]:checked').length > 0;
						}
					},
					noSpace: {
						depends: function() {
							return $('#inner_banner[value="inner_banner"]:checked').length > 0;
						}
					}
				},
				dsk_source_url: {
					required: {
						depends: function() {
							if($('#inner_banner[value="home_banner"]:checked')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}
							else{return false;}
						}
					},
					noSpace: {
						depends: function() {
							if($('#inner_banner[value="home_banner"]:checked')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}
							else{return false;}
						}
					},
					url: {
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){
							if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
						}
							else{return false;}
						}
					},
					notanull:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}
								else{return false;}
							}
					}
					
			   	},
			   	mobi_source_url: {
					required: {
						depends: function() {
							if($('#inner_banner[value="home_banner"]:checked')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}
							else{return false;}
						}
					},
					noSpace: {
						depends: function() {
							if($('#inner_banner[value="home_banner"]:checked')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}
							else{return false;}
						}
					},
					url: {
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){
							if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
						}
							else{return false;}
						}
					},
					notanull:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}
								else{return false;}
							}
					}
	
			   	},
			   	ipad_source_url: {
					required: {
						depends: function() {
							if($('#inner_banner[value="home_banner"]:checked')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}else{ console.log("else part"); return false;}
						}
					},
					noSpace: {
						depends: function() {
							if($('#inner_banner[value="home_banner"]:checked')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}
							else{return false;}
						}
					},
					url: {
						depends: function() {
						if(($('input[name=banner_type]:checked').val()=='home_banner')){
							if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
						}
							else{return false;}
						}
					},
					notanull:{
						depends: function() {
							if(($('input[name=banner_type]:checked').val()=='home_banner')){
								if($('.versionradio[value="html_banner"]:checked')){ return false; }else{ return true; }
							}
								else{return false;}
							}
					}
	
			   	}
			},
			messages: {
				title: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
				description: Lang.get('validation.required', { attribute: Lang.get('template.description') }),
				tag_line: Lang.get('validation.required', { attribute: Lang.get('template.tagline') }),
				title_feature1: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
				title_feature2: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
				title_feature3: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
				title_feature4: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
				feature1_icon: Lang.get('validation.required', { attribute: Lang.get('template.bannerModule.iconclass') }),
				feature2_icon: Lang.get('validation.required', { attribute: Lang.get('template.bannerModule.iconclass') }),
				feature3_icon: Lang.get('validation.required', { attribute: Lang.get('template.bannerModule.iconclass') }),
				feature4_icon: Lang.get('validation.required', { attribute: Lang.get('template.bannerModule.iconclass') }),
				// button_text: Lang.get('validation.required', { attribute: Lang.get('template.bannerModule.buttontext') }),
				button_link:{
							// required:Lang.get('validation.required', { attribute: Lang.get('template.bannerModule.buttonlink') }),
							url:Lang.get('validation.url', { attribute: Lang.get('template.url') })},
				image_upload: Lang.get('validation.url', { attribute: Lang.get('template.banner') }),
				modules: Lang.get('validation.required', { attribute: Lang.get('template.module') }),
				foritem: Lang.get('validation.required', { attribute: Lang.get('template.page') }),
				display_order: {
					required: Lang.get('validation.required', { attribute: Lang.get('template.displayorder') }),
					minStrict: Lang.get('validation.minStrict', { attribute: Lang.get('template.displayorder') }),
					number: Lang.get('validation.number', { attribute: Lang.get('template.displayorder') }),
					noSpace: Lang.get('validation.noSpace', { attribute: Lang.get('template.displayorder') })
				}, 
				// dsk_source_url: {
				// 		required : Lang.get('validation.required', { attribute: "Desktop Source Url" }),
				// 		url:Lang.get('validation.url', { attribute: Lang.get('template.url') })},
				// mobi_source_url: {
				// 	required : Lang.get('validation.required', { attribute: "Desktop Source Url" }),
				// 	url:Lang.get('validation.url', { attribute: Lang.get('template.url') })},
				ipad_source_url: {
					required : Lang.get('validation.required', { attribute: "Ipad Source Url" }),
					url:Lang.get('validation.url', { attribute: Lang.get('template.url') })},


			},
			errorPlacement: function (error, element) { if (element.parent('.input-group').length) { error.insertAfter(element.parent()); } else if (element.hasClass('select2')) { error.insertAfter(element.next('span')); } 
			else if (element.attr("id") == "txtHtmlBanner") {  error.insertAfter($("#cke_txtHtmlBanner")); } else { error.insertAfter(element); } },
			invalidHandler: function(event, validator) { //display error alert on form submit
				var errors = validator.numberOfInvalids();
		    if (errors) {
		    	$.loader.close(true);
		    }
				$('.alert-danger', $('#frmBanner')).show();
			},
			highlight: function(element) { // hightlight error inputs
				$(element).closest('.form-group').addClass('has-error'); // set error class to the control group
			},
			unhighlight: function(element) {
				$(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
			},
			submitHandler: function (form) { // for demo
				$('body').loader(loaderConfig);
				form.submit();
				return false;
			}
		});
		$('#frmBanner input').keypress(function(e) {
			if (e.which == 13) {
				if ($('#frmBanner').validate().form()) {
					$('#frmBanner').submit(); //form validation success, call ajax form submit
				}
				return false;
			}
		});
	}
	return {
		//main function to initiate the module
		init: function() {
			handleBanner();			
		}
	};
}();
jQuery(document).ready(function() {   
	Custom.init();	
	Custom.checkType();
	Custom.checkVersion();
	Custom.checkBannerFrom();
	Validate.init();

	$(document).on('click','.versionradio',function(e) {
		Custom.checkVersion();
		Custom.checkType();
		Custom.checkBannerFrom();
	});

	$(document).on('click','.banner',function(e) {		
		Custom.checkType();
		Custom.checkBannerFrom();
	});

	$(document).on('click','.bannerfromradio',function(e) {		
		Custom.checkBannerFrom();
	});

	$('#modules').on("change", function (e) {		
		Custom.getModuleRecords($("#modules option:selected").data('module'), $("#modules option:selected").data('model'));
	});

	jQuery.validator.addMethod("noSpace", function(value, element){
		if(value.trim().length <= 0){
			return false;   
		}else{
			return true;  
		}
	}, "This field is required");
	// vikram
	jQuery.validator.addMethod("notanull", function(value, element){
		var surl = value.trim();
		var _token = $('[name="_token"]').val();
		$.ajax({
			type: "get",
			url: Urls,
			async:false,
			data: {_token:_token, url : surl},
			success: function(data) {
				$('#numbr').val(data);	
			}	
		});
		var i = $('#numbr').val();
		if(i == 0){return false;}else{return true;}
	}, "This url has no content available");
});
jQuery.validator.addMethod("phoneFormat", function(value, element) {
	// allow any non-whitespace characters as the host part
	return this.optional( element ) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test( value );
}, 'Please enter a valid phone number.');

jQuery.validator.addMethod("minStrict", function(value, element) {
	// allow any non-whitespace characters as the host part
	if(value>0){
		return true;
	}else{
		return false;
	}
}, 'Display order must be a number higher than zero');

jQuery.validator.addMethod("noSpace", function(value, element){
		if(value.trim().length <= 0){
			return false; 	
		}else{
			return true; 	
		}
	}, "This field is required");	
$('input[name=title]').change(function(){
	var title = $(this).val();
	var trim_title = title.trim();
	if(trim_title) {
		$(this).val(trim_title);
		return true;
	}
});

$(window).load(function(){
	var radioValue = $("input[name='banner_type']:checked").val();
	if(selectedRecord>0){
		$('#modules').trigger('change');
		if(radioValue == 'home_banner')
		{
			$('#modules').select2({
					placeholder: "Select Module",
					width: '100%',
					minimumResultsForSearch: 5
			});
			$( '#records').hide();
		}
	}
});

/*********** Remove Image code start Here  *************/
		$(document).ready(function() {
		if($("input[name='img_id']").val() == ''){  
										$('.removeimg').hide();
										$('#imguploader .overflow_layer').css('display','none');
			 }else{
				 $('.removeimg').show();
						$('#imguploader .overflow_layer').css('display','block');
			 }

				 $(document).on('click', '.removeimg', function(e) 
				 {          
						$("input[name='img_id']").val('');
						$("input[name='image_url']").val('');
						$(".fileinput-new div img").attr("src",site_url+ "/resources/images/upload_file.gif");

						if($("input[name='img_id']").val() == ''){  
						$('.removeimg').hide();
										$('#imguploader .overflow_layer').css('display','none');
				}else{
				 $('.removeimg').show();
						$('#imguploader .overflow_layer').css('display','block');
				}            
		});
});
/************** Remove Images Code end ****************/ 	