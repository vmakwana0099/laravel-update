/**
 * This method validates team form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function() {
    var handleTeam = function() {
        $("#frmTeam").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            rules: {
                name: {
                    required: true,
                    noSpace: true
                },                
                email: {
                    required: true,
                    emailFormat: true
                },
                phone_no: {
                    required: true,
                    noSpace: true,
                    minlength: 5,
                    maxlength: 20,
                    phonenumber: true
                },
                facebook: {
                    url: true
                },
                twitter: {
                    url: true
                },
                linkedin: {
                    url: true
                },
                google_plus: {
                    url: true
                },
                order: {
                    required: true,
                    minStrict: true,
                    number: true,
                    noSpace: true
                },
                varMetaTitle: {
                    required: true,
                    noSpace: true
                },
                varMetaKeyword: {
                    required: true,
                    noSpace: true
                },
                varMetaDescription: {
                    required: true,
                    noSpace: true
                },
                'new-alias':{
                    specialCharacterCheck:true,
                },
            },
            messages: {
                name: Lang.get('validation.required', {
                    attribute: Lang.get('template.name')
                }),                
                email: Lang.get('validation.required', {
                    attribute: Lang.get('template.email')
                }),
                phone_no: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.phone')
                    }),
                    minlength: 'Phone number must be at least 5 characters long',
                    maxlength: 'Phone number must be less then 20 characters'
                },
                order: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.displayorder')
                    })
                },
                varMetaTitle: Lang.get('validation.required', {
                    attribute: Lang.get('template.metatitle')
                }),
                varMetaKeyword: Lang.get('validation.required', {
                    attribute: Lang.get('template.metakeyword')
                }),
                varMetaDescription: Lang.get('validation.required', {
                    attribute: Lang.get('template.metadescription')
                })

            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('select2')) {
                    error.insertAfter(element.next('span'));
                } else {
                    error.insertAfter(element);
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit 
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $.loader.close(true);
                }
                $('.alert-danger', $('#frmTeam')).show();
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
        $('#frmTeam input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#frmTeam').validate().form()) {
                    $('#frmTeam').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }
    return {
        //main function to initiate the module
        init: function() {
            handleTeam();
        }
    };
}();

function KeycheckOnlyPhonenumber(e) {
    var t = 0;
    t = document.all ? 3 : document.getElementById ? 1 : document.layers ? 2 : 0;
    if (document.all) e = window.event;
    var n = "";
    var r = "";
    if (t == 2) {
        if (e.which > 0) n = "(" + String.fromCharCode(e.which) + ")";
        r = e.which
    } else {
        if (t == 3) {
            r = window.event ? event.keyCode : e.which
        } else {
            if (e.charCode > 0) n = "(" + String.fromCharCode(e.charCode) + ")";
            r = e.charCode
        }
    }
    if (r >= 65 && r <= 90 || r >= 97 && r <= 122 || r >= 33 && r <= 39 || r >= 42 && r <= 42 || r >= 44 && r <= 44 || r >= 46 && r <= 47 || r >= 58 && r <= 64 || r >= 91 && r <= 96 || r >= 123 && r <= 126) {
        return false
    }
    return true
}

jQuery(document).ready(function() {
    Validate.init();
    jQuery.validator.addMethod("noSpace", function(value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "This field is required");
});


$.validator.addMethod("phonenumber", function(value, element) {
    var numberPattern = /\d+/g;
    var newVal = value.replace(/\D/g, 0);
    if (parseInt(newVal) <= 0 || newVal.match(/\d+/g) == null) {
        return false;
    } else {
        return true;
    }
}, 'Please enter a valid phone number.');

/*jQuery.validator.addMethod("urlFormat", function(url) {
	return /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
},'Enter valid url format');*/

jQuery.validator.addMethod("emailFormat", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(value);
}, 'Enter valid email format');

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