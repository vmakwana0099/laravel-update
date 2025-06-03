/**
 * This method validates service form fields
 * since   2016-12-24
 * author  NetQuick
 */
 var Validate = function() {
		var handleService = function() {
				 $("#frmVideoAlbum").validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block', // default input error message class
					ignore: [],
					rules: {					
						title: {
							required:true,
							noSpace:true
						},
						video_id:{
							required:true
						},
						display_order: {
							required: true,
							minStrict: true,
							number: true,
							noSpace:true
						},						
						varMetaTitle: {
							required:true,
							noSpace:true
						},
						varMetaKeyword:{ required:true, noSpace:true },
						varMetaDescription:{ required:true, noSpace:true },
						'new-alias':{
							specialCharacterCheck:true,
						},
					},
					messages: {
						title: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
						video_id: Lang.get('validation.required', { attribute: Lang.get('template.video') }),
						display_order: { required: Lang.get('validation.required', { attribute: Lang.get('template.displayorder') }) },
						varMetaTitle: Lang.get('validation.required', { attribute: Lang.get('template.metatitle') }),
						varMetaKeyword: Lang.get('validation.required', { attribute: Lang.get('template.metakeyword') }),
						varMetaDescription: Lang.get('validation.required', { attribute: Lang.get('template.metadescription') })
					},
					invalidHandler: function(event, validator) { //display error alert on form submit
								var errors = validator.numberOfInvalids();
						    if (errors) {
						    	$.loader.close(true);
						    }   
								$('.alert-danger', $('#frmVideoAlbum')).show();
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
				$('#frmService input').keypress(function(e) {
						if (e.which == 13) {
								if ($('#frmVideoAlbum').validate().form()) {
										$('#frmVideoAlbum').submit(); //form validation success, call ajax form submit
								}
								return false;
						}
				});
		}	 
		return {
				//main function to initiate the module
				init: function() {
						handleService();
				}
		};
}();
jQuery(document).ready(function() 
{ 	 
	 Validate.init();	
	 jQuery.validator.addMethod("noSpace", function(value, element){
		if(value.trim().length <= 0){
			return false; 	
		}else{
			return true; 	
		}
	}, "No space please and don't leave it empty"); 	
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