@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')

<link rel="stylesheet" href="{{ url('assets/css/career-pages.css') }}">
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<script type="text/javascript" src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>

<div class="lading_bottom">    
    <div class="getquestion-div">
        <div class="container careers_container">
            <div class="row">
                <div class="col-lg-12 col-12 left_part d-flex justify-content-end">
                    <div class="contact-left career-form">
                        <h3 class="contact-title">How Can We Help?</h3>
                        <div class="require-field float-end">*(Denotes Required)</div>
     
                        
                        <form method="post" action="{{ url('/career/details-store') }}" accept-charset="UTF-8" class="form-horizontal row careers_form" name="career_form" id="career_form" novalidate="novalidate" enctype="multipart/form-data">

                            {!! csrf_field() !!}
                            <input name="varRefURL" type="hidden" value="{{ url()->current() }}">

                            <div class="col-md-6 col-12">
                                <div class="form-group frm_cstm_wdth">
                                    <label class="form-text" for="first_name">First Name<span class="required"
                                            aria-required="true">*</span></label>
                                    <input id="first_name" class="form-control" name="first_name" type="text">

                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group frm_cstm_wdth">
                                    <label class="form-text" for="last_name">Last Name<span class="required"
                                            aria-required="true">*</span></label>
                                    <input id="last_name" class="form-control" name="last_name" type="text">

                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group frm_cstm_wdth">
                                    <label class="form-text" for="careers_email">Email<span class="required"
                                            aria-required="true">*</span></label>
                                    <input id="careers_email" class="form-control" name="careers_email"
                                        type="text">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group frm_cstm_wdth">
                                    <label class="form-text" for="phone_number">Phone #<span class="required" aria-required="true">*</span></label>
                                    <input id="phone_number" class="form-control" maxlength="10"
                                        onpaste="return false;" name="phone_number" type="tel">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group frm_cstm_wdth">
                                    <label for="career_category">Select Careers Category<span class="required" aria-required="true">*</span></label>
                                    <select class="form-control" id="career_category" name="career_category">
                                        <option value="">Select</option>
                                        @foreach ($CareersCategoryData as $key => $CareersCategory)
                                            <option value="{{ $key }}" {{ $key==$requestData['career_category']?"selected='selected'":"" }}>{{ $CareersCategory }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group frm_cstm_wdth">
                                    <label for="yearofexperience">Select Experience<span class="required" aria-required="true">*</span></label>
                                    <select class="form-control" id="yearofexperience" name="yearofexperience">
                                        <option value="">Select</option>
                                        @foreach ($Experiences as $experience)
                                            <option value="{{ $experience }}">{{ $experience }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="filename" id="filename" value="">
                            <input type="hidden" name="grecaptcha" id="grecaptcha" value="" />

                            <div class="col-12 mt-4">
                                <div class="form-group frm_cstm_wdth_s">
                                    <label class="form-text" for="cmessage">Message</label>
                                    <textarea class="form-control" cols="40" rows="3" id="user_message"
                                        spellcheck="true" name="user_message"></textarea>
                                </div>
                            </div>

                        </form>


                        <div class="clearfix"></div>
                        <div class="col-md-12 col-lg-12">
                            <div class="custom-file my-4">

                                <form method="post" action="{{ url('/career/details-fileupload') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="dropzone form-control" id="careers_fileupload" name="careers_fileupload" required>
                                    {!! csrf_field() !!}
                                    <input name="varRefURL" type="hidden" value="{{ url()->current() }}">
                                </form>
                                <label id="filename-error" class="error" for="filename" style=""></label>

                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div id="html_element" class="g-recaptcha form-text" data-sitekey="{{ Config::get('Constant.GOOGLE_CAPCHA_KEY') }}" data-callback="check_captcha"></div>
                                <div class="capphitcha">
                                    @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        {{ $errors->first('g-recaptcha-response') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <label id="grr-error" class="error" style=""></label>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-12 my-4">
                            <div class="form-group text-center">
                                By clicking "Send a message", you agree to our <a target="_blank"
                                    title="Privacy Policy"
                                    href="{{ url('/privacy-policy') }}">Privacy Policy</a>.
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-12 text-center my-4">
                            <div class="form-group">
                                <button type="button" onclick="$('#career_form').submit();" class="btn btn-default" title="Send a message">Send a message</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    Dropzone.autoDiscover = false;
    $(function () {
        var filesizeallowed = 26214400;
        var allow_file_type = ".PDF,.TXT,.JPEG,.PNG,.DOC,.DOCX";
        //alert(filesizeallowed);
        uploader = new Dropzone("#careers_fileupload", {
            url: "{{ url('/career/details-fileupload') }}",
            uploadMultiple: false,
            acceptedFiles: allow_file_type,
            addRemoveLinks: true,
            forceFallback: false,
            maxFilesize: filesizeallowed,
            maxFiles : 1,
            timeout: 180000,
            parallelUploads: 100, 
            init: function (){
                this.on("complete", function (file) {
                    var raelSize=0;
                    if (file.size > filesizeallowed) {
                        this.removeFile(file);
                        alert('Maximum 5 MB File size is allowed.');
                        return false;
                    }else{
                        raelSize = parseInt(raelSize) + parseInt(file.size);
                        if (raelSize > filesizeallowed) { 
                            this.removeFile(file);
                            alert('Maximum 5 MB File size is allowed.');
                            return false;
                        }
                    }

                });
            }
        });//end drop zone

        uploader.on("success", function (file, response) {
            //console.log(file);
            response = jQuery.parseJSON(response);
            console.log(response);
            //console.log(response.id); 
            if (response.targetfile && response.targetfile != ''){
                $("#filename").val(response.targetfile);
            }else{
                alert("file uploading error Please uploade only pdf,doc,docx with max length 5MB.");
            }
        });

    });//end jq
</script>

<script>
$(function(){
    $("#career_form").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: 255
            },
            last_name: {
                required: true,
                maxlength: 255
            },
            filename: {
                required: true,
            },
            careers_email: {
                required: true,
                email: true,
                maxlength: 255,
            },
            phone_number: {
                required: true,
                minlength:10,
                maxlength:10
            },
            career_category: {
                required: true 
            },
            yearofexperience: {
                required: true 
            },
            careers_fileupload: {
                required: true,
                maxlength: 500
            },
        },
        messages: {
            first_name: {
                required: "Please enter your first name.",
            },
            last_name: {
                required: "Please enter your last name.",
            },
            filename: {
                required: "Please uploade your resume.",
            },
            careers_email: {
                required: "Please enter your email address.",
            },
            phone_number: {
                required: "Please enter your phone number.",
            },
            career_category: {
                required: "Please select your careers category.",
            },
            yearofexperience: {
                required: "Please select your experience.",
            },
            careers_fileupload: {
                required: "Please upload your resume.",
            },
        },
        submitHandler: function (form){
            // console.log(form);
            if ($('#filename').val()==''){
                $('#filename-error').text("Please uploade your resume.").css("display","block");
                return false;
            }else{
                $('#filename-error').css("display","none");
            }

            if ($('.careers_container iframe').length > 0 && grecaptcha.getResponse() == '') {
                $('#grr-error').text("Please check google captcha.").css("display","block");
                return false;
            } else {
                $('#grr-error').css("display","none");
                $('#grecaptcha').val(grecaptcha.getResponse());
                return true;
            }
            return true;
        }
    });
});
</script>


<script type="text/javascript">
    var onloadCallbackCareers = function() {
        console.log("hello");
        grecaptcha.render('html_element', {
        'sitekey' : '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}'
        });
    };
    /*var check_captcha = () => {
        console.log("hello 2");
    }*/
    // setTimeout(function(){
    // }, 1000);
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackCareers&render=explicit" async defer></script>

@endsection