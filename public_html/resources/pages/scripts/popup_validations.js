/**
 * This method validates blog form fields
 * since   2016-12-24
 * author  NetQuick
 */
 var Validate = function() 
 {
		var handleBlog = function() {
				 $("#frmPopup").validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block', // default input error message class
					ignore:[],
					rules: {
						title:{required:true, noSpace:true},
						start_date_time: {required:true},
						end_date_time: {
										daterange: {
												required: {
													depends: function() {
														var isChecked = $('#end_date_time').attr('data-exp');
														if (isChecked==0) {
															return $('input[name=end_date_time]').val().length > 0;
														}
															
													}
														
												}
										}
						}
					},
					messages: {
						title: Lang.get('validation.required', { attribute: Lang.get('template.title') }),
						start_date_time: Lang.get('validation.required', { attribute: Lang.get('template.managePopup.startDateTime') }),
						end_date_time: Lang.get('validation.required', { attribute: Lang.get('template.managePopup.endDateTime') }),
					},
					errorPlacement: function (error, element) { if (element.parent('.input-group').length) { error.insertAfter(element.parent()); } else if (element.hasClass('select2')) { error.insertAfter(element.next('span')); } else { error.insertAfter(element); } },
					invalidHandler: function(event, validator) { //display error alert on form submit 
						var errors = validator.numberOfInvalids();
				    if (errors) {
				    	$.loader.close(true);
				    }  
						$('.alert-danger', $('#frmPopup')).show();
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
				$('#frmPopup input').keypress(function(e) {
						if (e.which == 13) {
								if ($('#frmPopup').validate().form()) {
										$('#frmPopup').submit(); //form validation success, call ajax form submit
								}
								return false;
						}
				});
		}  
		return {
				//main function to initiate the module
				init: function() {
						handleBlog();
				}
		};
}();

jQuery(document).ready(function() 
{      
	 Validate.init();
	 jQuery.validator.addMethod("noSpace", function(value, element){
		if(!$(element).hasClass('select2')){
		value = value.trim();
		}
		if(value.length <= 0){
			return false;   
		}else{
			return true;  
		}
	}, "This field is required");
	var isChecked = $('#end_date_time').attr('data-exp');
		if (isChecked==1) {
			$('.expdatelabel').removeClass('no_expiry');
			$('.expiry_lbl').text('Set Expiry');
			$(".expirydate").hide();	
			$('#end_date_time').attr('disabled','disabled');
		}else{	
			$('.expdatelabel').addClass('no_expiry');
			$('.expiry_lbl').text('No Expiry');
			$('#end_date_time').removeAttr('disabled');
		}
});

jQuery.validator.addMethod("phoneFormat", function(value, element) {
	// allow any non-whitespace characters as the host part
	return this.optional( element ) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test( value );
}, 'Please enter a valid phone number.');

jQuery.validator.addMethod("minStrict", function(value, element) 
{
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

jQuery.validator.addMethod("daterange", function(value, element){
var fromDateTime = $('#start_date_time').val();
var toDateTime = $("#end_date_time").val();
var isChecked = $('#end_date_time').attr('data-exp');
if (isChecked==0) {
	toDateTime = new Date(toDateTime); 
	fromDateTime = new Date(fromDateTime);
	return toDateTime >= fromDateTime && fromDateTime < toDateTime;
}else{
	return true;
}
// var fromDate=moment(fromDateTime, ["YYYY-M-D h:mm A"]).format("YYYY-M-D HH:mm");
// var toDate=moment(toDateTime, ["YYYY-M-D h:mm A"]).format("YYYY-M-D HH:mm");
//return (toDate < fromDate);
}, "The end date & time must be a date after start date & time.");

$('.fromButton').click(function() {
		$('#start_date_time').datetimepicker('show');
});
$('.toButton').click(function() {
		$('#end_date_time').datetimepicker('show');
});

$(document).on("change",'#end_date_time',function(){
	$(this).attr('data-newvalue',$(this).val());
});



$('#noexpiry').click(function() {
		var isChecked = $('#end_date_time').attr('data-exp');

		if (isChecked == 0) {
				$('.expdatelabel').removeClass('no_expiry');
				$('.expiry_lbl').text('Set Expiry');
				$('#end_date_time').attr('data-exp','1');
				$('#end_date_time').attr('disabled','disabled');
				$(".expirydate").hide();
				$("#end_date_time").val(null);
				$('#end_date_time').val('').datetimepicker("update");
				$('.expirydate').next('span.help-block').html('');
				$('.expirydate').parent('.form-group').removeClass('has-error');
		} else {
			$('.expdatelabel').addClass('no_expiry');
			$('.expiry_lbl').text('No Expiry');
			$('#end_date_time').attr('data-exp','0');
			$('#end_date_time').removeAttr('disabled');
				$(".expirydate").show();
				if ($('#end_date_time').attr('data-newvalue').length > 0) {
					$("#end_date_time").val($('#end_date_time').attr('data-newvalue'));
				}else{
					$("#end_date_time").val(oldVal);	
				}
		}
});