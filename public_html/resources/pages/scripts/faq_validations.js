/**
 * This method validates FAQs form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function() {
    var handleFaqs = function() {
        $("#frmFaqs").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                question: {
                    required: true,
                    noSpace: true
                },
                'category_id': {
                    required: true,
                    noSpace: true
                },
                'product_id': {
                    required: {
                        depends: function() {
                            var radioValue = $("input[name='LandingPage']:checked").val();
                            if (radioValue == "N") {
                                return true;
                            }
                        }
                    }
                },
                answer: "required",
                order: {
                    required: true,
                    minStrict: true,
                    number: true,
                    noSpace: true
                },
            },
            messages: {
                question: Lang.get('validation.required', {attribute: Lang.get('template.question')}),
                'category_id': Lang.get('validation.required', {attribute: Lang.get('template.category')}),
                'product_id': Lang.get('validation.required', {attribute: Lang.get('template.product')}),
                answer: Lang.get('validation.required', {attribute: Lang.get('template.answer')}),
                order: {required: Lang.get('validation.required', {attribute: Lang.get('template.displayorder')})}
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('select2')) {
                    error.insertAfter(element.next('span'));
                } else if (element.attr("id") == "category_id") {
                    error.insertAfter(element.next('span'));
                } else if (element.attr("id") == "product_id") {
                    error.insertAfter(element.next('span'));
                } else {
                    error.insertAfter(element);
                }
            },
            invalidHandler: function(event, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $.loader.close(true);
                }
                $('.alert-danger', $('#frmFaqs')).show();
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $('body').loader(loaderConfig);
                form.submit();
                return false;
            }
        });
        $('#frmFaqs input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#frmFaqs').validate().form()) {
                    $('#frmFaqs').submit();
                }
                return false;
            }
        });
    }
    return {
        init: function() {
            handleFaqs();
        }
    };
}();
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
jQuery.validator.addMethod("phoneFormat", function(value, element) {
    return this.optional(element) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test(value);
}, 'Please enter a valid phone number.');
jQuery.validator.addMethod("noSpace", function(value, element) {
    if (value.trim().length <= 0) {
        return false;
    } else {
        return true;
    }
}, "This field is required");
jQuery.validator.addMethod("minStrict", function(value, element) {
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