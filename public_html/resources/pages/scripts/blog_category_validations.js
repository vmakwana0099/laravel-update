/**
* This method validates news form fields
* since   2017-01-31
* author  Vishal Agrawal
*/
var Validate = function() {
	var handleBlogsCategory = function() {
		$("#frmBlogCategory").validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			rules: {					
				title: {
					required:true,
					noSpace:true
				},
				display_order: {
					required: true,
					minStrict: true,
					number: true,
					noSpace:true
				},
				short_description:{
					required:true,
					noSpace:true
				},
				varMetaTitle: {
					/*required:true,
					noSpace:true*/
				},
				varMetaKeyword:{
					/*required:true,
					noSpace:true*/
				},
				varMetaDescription:{
					/*required:true,
					noSpace:true*/
				},
				'new-alias':{
					specialCharacterCheck:true,
				},
			},
			messages: {
				title: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
				display_order: Lang.get('validation.required', { attribute: Lang.get('template.displayorder') }),
				short_description: Lang.get('validation.required', { attribute: Lang.get('template.shortdescription') }),
				varMetaTitle: Lang.get('validation.required', { attribute: Lang.get('template.metatitle') }),
				varMetaKeyword: Lang.get('validation.required', { attribute: Lang.get('template.metakeyword') }),
				varMetaDescription: Lang.get('validation.required', { attribute: Lang.get('template.metadescription') })
			},
			errorPlacement: function (error, element) { if (element.parent('.input-group').length) { error.insertAfter(element.parent()); } else if (element.hasClass('select2')) { error.insertAfter(element.next('span')); } else { error.insertAfter(element); } },
			invalidHandler: function(event, validator) { //display error alert on form submit   
				$('.alert-danger', $('#frmBlogCategory')).show();
			},
			highlight: function(element) { // hightlight error inputs
				var errors = validator.numberOfInvalids();
		    if (errors) {
		    	$.loader.close(true);
		    }
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
		$('#frmBlogCategory input').keypress(function(e) {
			if (e.which == 13) {
				if ($('#frmBlogCategory').validate().form()) {
					$('#frmBlogCategory').submit(); //form validation success, call ajax form submit
				}
				return false;
			}
		});
	}	 
	return {
		//main function to initiate the module
		init: function() {
			handleBlogsCategory();
		}
	};
}();

jQuery.validator.addMethod("minStrict", function(value, element) {
	// allow any non-whitespace characters as the host part
	if(value>0){
		return true;
	}else{
		return false;
	}
}, 'Display order must be a number higher than zero');

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
$('input[name=title]').change(function(){
	var title = $(this).val();
	var trim_title = title.trim();
	if(trim_title) {
		$(this).val(trim_title);
		return true;
	}
});