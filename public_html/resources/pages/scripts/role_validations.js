/**
 * This method validates Role form fields
 * since   2016-12-24
 * author  NetQuick
 */

var modalMenuItemId;
var loaderConfig={
	autoCheck: false,
	size: 16,
	bgColor: 'rgba(0, 0, 0, 0.25)',
	bgOpacity: 0.5,
	fontColor: 'rgba(16, 128, 242, 90)',
	title: 'Loading...'
};

 var Validate = function() {
		var handleRole = function() {
				 $("#frmRole").validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block', // default input error message class
					ignore:[],
					rules: {
						name: {
							required:true,
							noSpace:true
						},
						display_name: {
							required:true,
							noSpace:true
						},
						permission:"required"
					},
					messages: {
						name:"Name is required",
						display_name: "Display name is required",	
						permission:"Permission is required"
						
					},
					errorPlacement: function (error, element) { if (element.parent('.input-group').length) { error.insertAfter(element.parent()); } else if (element.hasClass('select2')) { error.insertAfter(element.next('span')); } else { error.insertAfter(element); } },
					invalidHandler: function(event, validator) { //display error alert on form submit
								var errors = validator.numberOfInvalids();
						    if (errors) {
						    	$.loader.close(true);
						    }   
								$('.alert-danger', $('#frmRole')).show();
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
				$('#frmRole input').keypress(function(e) {
						if (e.which == 13) {
								if ($('#frmRole').validate().form()) {
										$('#frmRole').submit(); //form validation success, call ajax form submit
								}
								return false;
						}
				});
		}	 
		return {
				//main function to initiate the module
				init: function() {
						handleRole();
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
$('input[type=text]').change(function(){
	var input = $(this).val();
	var trim_input = input.trim();
	if(trim_input) {
		$(this).val(trim_input);
		return true;
	}
});

var prevent=false;
$('.module-activation').on('switchChange.bootstrapSwitch', function (event, state) {		
		$($(this).parent().parent().parent().parent().parent()).loader(loaderConfig);
		var switchState=$(this).bootstrapSwitch('state');
		if(switchState) {			
			if(!prevent){
				$(this).parent().parent().parent().parent().parent().find('.right_permis input[type=checkbox]').prop('checked', true);
			}
		} else {
			$(this).parent().parent().parent().parent().parent().find('.right_permis input[type=checkbox]').prop('checked', false);
			prevent=false;
		}		
	 setTimeout(function(){ $.loader.close(true); }, 1000);		
});

$('.right_permis input[type=checkbox]').on('click', function (event, state) {		
		if($(this).parent().parent().children().children('input[type=checkbox]:checked').length < 1) {
			$(this).parent().parent().parent().find('.module-activation').bootstrapSwitch('state', false);
			prevent=false;
		}else{
			prevent=true;			
			$(this).parent().parent().parent().find('.module-activation').bootstrapSwitch('state', true);
		}		
});