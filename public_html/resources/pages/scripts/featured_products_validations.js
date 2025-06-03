/**
 * This method validates Product Features form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function() {
    var handleProductFeatures = function() {
        $("#frmProductFeatures").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                title: {
                    required: true,
                    noSpace: true
                },
                listing_icon: {
                    required: true,
                    noSpace: true
                },
                short_description: {
                    required: true,
                    noSpace: true
                },
                button_text: {
                    required: true,
                    noSpace: true
                },
                button_link: {
                    required: true,
                    url: true
                },
                feature: {
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
                order: {
                    required: true,
                    minStrict: true,
                    number: true,
                    noSpace: true
                },
            },
            messages: {
                title: Lang.get('validation.required', {attribute: Lang.get('template.title')}),
                listing_icon: Lang.get('validation.required', {attribute: Lang.get('template.listing_icon')}),
                short_description: Lang.get('validation.required', {attribute: Lang.get('template.short_description')}),
                button_text: Lang.get('validation.required', {attribute: Lang.get('template.buttontext')}),
                button_link: {
                    required: "Button link field is required.",
                    url: "Please enter a valid URL.",
                },
                feature: Lang.get('validation.required', {attribute: Lang.get('template.feature')}),
                'category_id': Lang.get('validation.required', {attribute: Lang.get('template.category')}),
                'product_id': Lang.get('validation.required', {attribute: Lang.get('template.product')}),
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
                $('.alert-danger', $('#frmProductFeatures')).show();
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
        $('#frmProductFeatures input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#frmProductFeatures').validate().form()) {
                    $('#frmProductFeatures').submit();
                }
                return false;
            }
        });
    }
    return {
        init: function() {
            handleProductFeatures();
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