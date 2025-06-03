/**
 * This method validates contacts's form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function() {
    var handleContact = function() {
        $("#frmContactUS").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            rules: {
                name: {
                    required: true,
                    noSpace: true
                },
                email: {
                    required: true,
                    email: true
                },
                order: {
                    required: true,
                    minStrict: true,
                    number: true,
                    noSpace: true
                },
                address: {
                    required: true
                },
                home_page_title: {
                    required: true
                },
                phone_no: {
                    required: true
                },
                home_page_description: {
                    required: true
                }
            },
            messages: {
                name: Lang.get('validation.required', {
                    attribute: Lang.get('template.name')
                }),
                order: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.displayorder')
                    })
                },
                address: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.contactModule.address')
                    })
                },
                home_page_title: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.contactModule.homepagetitle')
                    })
                },
                
                home_page_description: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.contactModule.homepagedescription')
                    })
                },
                phone_no: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.contactModule.phone_no')
                    })
                },
                email: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.contactModule.email')
                    })
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $.loader.close(true);
                }
                $('.alert-danger', $('#frmContactUS')).show();
            },
            highlight: function(element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            submitHandler: function(form) {
                $('body').loader(loaderConfig);
                form.submit();
                return false;
            }
        });
        $('#frmContactUS input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#frmContactUS').validate().form()) {
                    $('#frmContactUS').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }
    return {
        //main function to initiate the module
        init: function() {
            handleContact();
        }
    };
}();
jQuery(document).ready(function() {
    Validate.init();


    $.validator.addMethod("phonenumber", function(value, element) {
        var newVal = value.replace(/^\D+/g, '');
        if (parseInt(newVal) <= 0 || newVal.match(/\d+/g) == null) {
            return false;
        } else {
            return true;
        }
    }, 'Please enter a valid phone number.');
    jQuery.validator.addMethod("noSpace", function(value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "This field is required");
});
jQuery.validator.addMethod("phoneFormat", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test(value);
}, 'Please enter a valid phone number.');

jQuery.validator.addMethod("minStrict", function(value, element) {
    // allow any non-whitespace characters as the host part
    if (value > 0) {
        return true;
    } else {
        return false;
    }
}, 'Display order must be a number higher than zero');

$('input[type=text]').change(function() {
    var input = $(this).val();
    var trim_input = input.trim();
    if (trim_input) {
        $(this).val(trim_input);
        return true;
    }

});
/*********** Remove Image code start Here  *************/
$(document).ready(function() {
    if ($("input[name='img_id']").val() == '') {
        $('.removeimg').hide();
        $('.image_thumb .overflow_layer').css('display', 'none');
    } else {
        $('.removeimg').show();
        $('.image_thumb .overflow_layer').css('display', 'block');
    }

    $(document).on('click', '.removeimg', function(e) {
        $("input[name='img_id']").val('');
        $("input[name='image_url']").val('');
        $(".fileinput-new div img").attr("src", site_url + "/resources/images/upload_file.gif");

        if ($("input[name='img_id']").val() == '') {
            $('.removeimg').hide();
            $('.image_thumb .overflow_layer').css('display', 'none');
        } else {
            $('.removeimg').show();
            $('.image_thumb .overflow_layer').css('display', 'block');
        }
    });
});
/************** Remove Images Code end ****************/