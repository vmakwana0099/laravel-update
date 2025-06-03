/**
 * This method validates news form fields
 * since   2016-12-24
 * author  NetQuick
 */
 var Validate = function() {
		var handleNews = function() {
				 $("#frmDeals").validate({
					ignore: [],
					errorElement: 'span', //default input error message container
					errorClass: 'help-block', // default input error message class
					rules: {					
						title: {
							required:true,
							noSpace:true
						},
						dealscategory_id: {
							required:true,
							noSpace:true							
						},
						category_id: {
							required:true,
							noSpace:true							
						},
						tag_line: {
							required:true,
							noSpace:true							
						},
						promo_code: {
							required:true,
							noSpace:true							
						},
						popup_title: {
							required:true,
							noSpace:true							
						},
						start_date: {
							required:true,
							noSpace:true							
						},
						end_date: {
							required:true,
							noSpace:true								
						},
						popuptag_line: {
							required:true,
							noSpace:true							
						},
						button_link: {
							url:true							
						}, 
						discount_percentage: {
							required:{	depends: function() {
								if(($('input[name=discountType]:checked').val()=='Percentage')){return true}
								else{return false;}
							}	}					
						},
						discount_fixed: {
							required:{	depends: function() {
								if(($('input[name=discountType]:checked').val()=='Fixed')){return true}
								else{return false;}
								}						
							}
						},product_id: {
							required:{	depends: function() {								
								if(($('#category_id').val() != null)){return true}
								else{return false;}
								}						
							}
						},
						dealtype_id: {
							required:true							
						},
						// img_id:"required",						
						display_order: {
							required: true,
							minStrict: true,
							number: true,
							noSpace:true
						},
						// varMetaTitle: {
						// 	required:true,
						// 	noSpace:true
						// },
						short_description:{ required:true, noSpace:true },
						// varMetaKeyword:{ required:true, noSpace:true },
						// varMetaDescription:{ required:true, noSpace:true },
						// varExternalLink:{
						// 		url:true,
						// },
						// 'new-alias':{
						// 	specialCharacterCheck:true,
						// },
					},
					messages: {
						title: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
						dealscategory_id: Lang.get('validation.required', { attribute: 'Deal category'}),
						img_id: Lang.get('validation.required', { attribute: Lang.get('template.image') }),
						category_id: Lang.get('validation.required', { attribute: Lang.get('template.category') }),
						discount_percentage: Lang.get('validation.required', { attribute: Lang.get('template.dealsModule.discountpercent') }),
						discount_fixed: Lang.get('validation.required', { attribute: Lang.get('template.dealsModule.discountfixed') }),
						popup_title: Lang.get('validation.required', { attribute: Lang.get('template.dealsModule.popuptitle') }),
						promo_code: Lang.get('validation.required', { attribute: Lang.get('template.dealsModule.promocode') }),
						button_link:{ url: "Please enter a valid URL.",},
						popuptag_line: Lang.get('validation.required', { attribute: Lang.get('template.tagline') }),
						dealtype_id: Lang.get('validation.required', { attribute: Lang.get('template.dealsModule.dealstype') }),
						tag_line: Lang.get('validation.required', { attribute: Lang.get('template.tagline') }),
						short_description: Lang.get('validation.required', { attribute: Lang.get('template.short_description') }),               				
						display_order: { required: Lang.get('validation.required', { attribute: Lang.get('template.displayorder') }) },
						varMetaTitle: Lang.get('validation.required', { attribute: Lang.get('template.metatitle') }),
				   		varMetaKeyword: Lang.get('validation.required', { attribute: Lang.get('template.metakeyword') }),
				    	varMetaDescription: Lang.get('validation.required', { attribute: Lang.get('template.metadescription') }),
			      		varExternalLink:{
						url:"Please enter a valid URL.",
						}
			
					},
					errorPlacement: function (error, element) { 
						if (element.parent('.input-group').length) { 
							error.insertAfter(element.parent()); 
						} else if (element.hasClass('select2')) { 
							error.insertAfter(element.next('span'));
						}else if (element.hasClass('select2')) { 
							error.insertAfter(element.next('span'));
						}else if(element.attr('name')=='dealscategory_id'){
							error.insertAfter(element.next().next('span'));
						}else if(element.attr('name')=='category_id'){
							error.insertAfter(element.next().next('span'));
						}else if(element.attr('name')=='dealtype_id'){
							error.insertAfter(element.next().next('span'));
						} else if(element.attr('name')=='product_id'){
							error.insertAfter(element.next().next('span'));
						} else { 
							error.insertAfter(element); 
						} 
					},
					invalidHandler: function(event, validator) { //display error alert on form submit  
								var errors = validator.numberOfInvalids();
						    if (errors) {
						    	$.loader.close(true);
						    } 
								$('.alert-danger', $('#frmDeals')).show();
						},
					highlight: function(element) { // hightlight error inputs
								$(element).closest('.form-group').addClass('has-error'); // set error class to the control group
						},
					unhighlight: function(element) {
								$(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
						},
					submitHandler: function (form) {
						$('body').loader(loaderConfig);
						form.submit();
						return false;
					}
				});
				$('#frmDeals input').keypress(function(e) {
						if (e.which == 13) {
								if ($('#frmDeals').validate().form()) {
										$('#frmDeals').submit(); //form validation success, call ajax form submit
								}
								return false;
						}
				});
		}	 
		return {
				//main function to initiate the module
				init: function() {
						handleNews();
				}
		};
}();
function KeycheckOnlyPhonenumber(e) { var t = 0; t = document.all ? 3 : document.getElementById ? 1 : document.layers ? 2 : 0; if (document.all) e = window.event; var n = ""; var r = ""; if (t == 2) { if (e.which > 0) n = "(" + String.fromCharCode(e.which) + ")"; r = e.which } else { if (t == 3) { r = window.event ? event.keyCode : e.which } else { if (e.charCode > 0) n = "(" + String.fromCharCode(e.charCode) + ")"; r = e.charCode } } if (r >= 65 && r <= 90 || r >= 97 && r <= 122 || r >= 33 && r <= 39 || r >= 42 && r <= 42 || r >= 44 && r <= 44 || r >= 46 && r <= 47 || r >= 58 && r <= 64 || r >= 91 && r <= 96 || r >= 123 && r <= 126) { return false } return true }

jQuery(document).ready(function() {
	 Validate.init();	 	
		jQuery.validator.addMethod("noSpace", function(value, element){
		if(value.trim().length <= 0){
			return false; 	
		}else{
			return true; 	
		}
	}, "This field is required");	
});

jQuery(document).ready(function() {   	 
	 Validate.init();	 
	 jQuery.validator.addMethod("noSpace", function(value, element){
		if(value.trim().length <= 0){
			return false; 	
		}else{
			return true; 	
		}
	}, "This field is required");		
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
$('input[type=text]').change(function(){
	var input = $(this).val();
	var trim_input = input.trim();
	if(trim_input) {
		$(this).val(trim_input);
		return true;
	}
});

/*********** Remove Image code start Here  *************/
		$(document).ready(function() {
		if($("input[name='img_id']").val() == ''){  
										$('.removeimg').hide();
										$('.image_thumb .overflow_layer').css('display','none');
			 }else{
				 $('.removeimg').show();
						$('.image_thumb .overflow_layer').css('display','block');
			 }

				 $(document).on('click', '.removeimg', function(e) 
				 {          
						$("input[name='img_id']").val('');
						$("input[name='image_url']").val('');
						$(".fileinput-new div img").attr("src",site_url+ "/resources/images/upload_file.gif");

						if($("input[name='img_id']").val() == ''){  
						$('.removeimg').hide();
										$('.image_thumb .overflow_layer').css('display','none');
				}else{
				 $('.removeimg').show();
						$('.image_thumb .overflow_layer').css('display','block');
				}            
		});
});
/************** Remove Images Code end ****************/ 	