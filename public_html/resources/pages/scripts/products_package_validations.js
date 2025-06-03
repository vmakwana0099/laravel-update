/**
 * This method validates service form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function () {
    var handleProduct = function () {
        $("#frmProductPackage").validate({
            ignore: [],
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            rules: {
                title: {
                    required: true,
                    noSpace: true
                },
                'category_id': {
                    required: true,
                    noSpace: true
                },
                'product_id': {
                    required: true,
                    noSpace: true
                },
                display_order: {
                    required: true,
                    minStrict: true,
                    number: true,
                    noSpace: true
                },
                specification: {
                    required: true,
                    noSpace: true
                },
                additional_offer: {
                    required: true,
                    noSpace: true
                },
                'whmcs_category_id': {
                    required: true,
                    noSpace: true
                },
                'whmcs_product_id': {
                    required: true,
                    noSpace: true
                },
            },
            messages: {
                title: Lang.get('validation.required', {attribute: Lang.get('template.title')}),
                'category_id': Lang.get('validation.required', {attribute: Lang.get('template.category')}),
                'product_id': Lang.get('validation.required', {attribute: Lang.get('template.product')}),
                specification: {
                    required: 'Specification field is required.',
                },
                display_order: {required: Lang.get('validation.required', {attribute: Lang.get('template.displayorder')})},
                additional_offer: Lang.get('validation.required', {attribute: Lang.get('template.additional_offer')}),
                'whmcs_category_id': Lang.get('validation.required', {attribute: Lang.get('template.whmcs_category_id')}),
                'whmcs_product_id': Lang.get('validation.required', {attribute: Lang.get('template.whmcs_product_div')}),
            },
            errorPlacement: function (error, element) {
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
            invalidHandler: function (event, validator) { //display error alert on form submit
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $.loader.close(true);
                }
                $('.alert-danger', $('#frmProductPackage')).show();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            submitHandler: function (form) {
                calculateSaleprice();
                $('body').loader(loaderConfig);
                form.submit();
                return false;
            }
        });
        $('#frmProductPackage input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#frmProductPackage').validate().form()) {
                    $('#frmProductPackage').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }
    return {
//main function to initiate the module
        init: function () {
            handleProduct();
        }
    };
}();
jQuery(document).ready(function () {
    Validate.init();
    jQuery.validator.addMethod("noSpace", function (value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "This field is required");
});
jQuery.validator.addMethod("minStrict", function (value, element) {
    // allow any non-whitespace characters as the host part
    if (value > 0) {
        return true;
    } else {
        return false;
    }
}, 'Display order must be a number higher than zero');
$('input[type=text]').change(function () {
    var input = $(this).val();
    var trim_input = input.trim();
    if (trim_input) {
        $(this).val(trim_input);
        return true;
    }
});
/*********** Remove Image code start Here  *************/
$(document).ready(function () {
    if ($("input[name='img_id']").val() == '') {
        $('.removeimg').hide();
        $('.image_thumb .overflow_layer').css('display', 'none');
    } else {
        $('.removeimg').show();
        $('.image_thumb .overflow_layer').css('display', 'block');
    }

    $(document).on('click', '.removeimg', function (e)
    {
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
function isNumberWithDescimal(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (
            (charCode != 46 || $(element).val().indexOf('.') != -1) && // â€œ.â€? CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
        return false;
    return true;
}

/*********** Remove Image code start Here  *************/
$(document).ready(function () {
    if ($("input[name='img_id']").val() == '') {
        $('.removeimg').hide();
        $('.image_thumb .overflow_layer').css('display', 'none');
    } else {
        $('.removeimg').show();
        $('.image_thumb .overflow_layer').css('display', 'block');
    }

    $(document).on('click', '.removeimg', function (e)
    {
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