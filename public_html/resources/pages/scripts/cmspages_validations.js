/**
 * This method validates cms pages form fields
 * since   2016-12-24
 * author  NetQuick
 */
 var Validate = function() {
		var handleCmsPage = function() {
				 $("#frmCmsPage").validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block', // default input error message class
					ignore: [],
					rules: {
						title: { required:true,noSpace:true	},
						module:{ required:true,	noSpace:true },					
						varMetaTitle: {	required:true,noSpace:true	},
						varMetaKeyword:{ required:true, noSpace:true },
						varMetaDescription:{ required:true, noSpace:true },
						'new-alias':{
							specialCharacterCheck:true,
						},				
					},
					messages: {
						title: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
						module: Lang.get('validation.required', { attribute: Lang.get('template.selectmodule') }),
						varMetaTitle:Lang.get('validation.required', { attribute: Lang.get('template.metatitle') }),
						varMetaKeyword:Lang.get('validation.required', { attribute: Lang.get('template.metakeyword') }),
						varMetaDescription:Lang.get('validation.required', { attribute: Lang.get('template.metadescription') })
					},
					errorPlacement: function (error, element) { if (element.parent('.input-group').length) { error.insertAfter(element.parent()); } else if (element.hasClass('select2')) { error.insertAfter(element.next('span')); } else { error.insertAfter(element); } },
					invalidHandler: function(event, validator) { //display error alert on form submit
								var errors = validator.numberOfInvalids();
						    if (errors) {
						    	$.loader.close(true);
						    }   
								$('.alert-danger', $('#frmCmsPage')).show();
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
				$('#frmCmsPage input').keypress(function(e) {
						if (e.which == 13) {
								if ($('#frmCmsPage').validate().form()) {
										$('#frmCmsPage').submit(); //form validation success, call ajax form submit
								}
								return false;
						}
				});
		}	 
		return {
				//main function to initiate the module
				init: function() {
						handleCmsPage();
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
$('input[name=title]').change(function(){
	var title = $(this).val();
  var trim_title = title.trim();
  if(trim_title) {
  	$(this).val(trim_title);
  	return true;
 	}
});