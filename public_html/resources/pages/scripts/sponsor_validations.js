/**
 * This method validates sponsor's form fields
 * since   2016-12-24
 * author  NetQuick
 */
 var Validate = function() {
		var handleSponsor = function() {
				 $("#frmSponsor").validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block', // default input error message class
					ignore: [],
					rules: {
						name: {
							required:true,
							noSpace:true
						},
						image_upload:"required",
						display_order: {
							required: true,
							minStrict: true,
							number: true,
							noSpace:true
						},
						link: {
							required: true,
							url: true
						}
					},
					messages: {
						name:Lang.get('validation.required', { attribute: Lang.get('template.sponserModule.sponserName') }),
						image_upload:Lang.get('validation.required', { attribute: Lang.get('template.image') }),
						display_order: { required: Lang.get('validation.required', { attribute: Lang.get('template.displayorder') }), }
					},
					errorPlacement: function (error, element) { if (element.parent('.input-group').length) { error.insertAfter(element.parent()); } else if (element.hasClass('select2')) { error.insertAfter(element.next('span')); } else { error.insertAfter(element); } },
					invalidHandler: function(event, validator) { //display error alert on form submit
							var errors = validator.numberOfInvalids();
					    if (errors) {
					    	$.loader.close(true);
					    }
							$('.alert-danger', $('#frmSponsor')).show();
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
				$('#frmSponsor input').keypress(function(e) {
						if (e.which == 13) {
								if ($('#frmSponsor').validate().form()) {
										$('#frmSponsor').submit(); //form validation success, call ajax form submit
								}
								return false;
						}
				});
		}	 
		return {
				//main function to initiate the module
				init: function() {
						handleSponsor();
				}
		};
}();
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