@extends('layouts.app')
@section('content')
<?php

// echo $aaaa;
?>
<div class="whois-main">
    <div class="banner-inner whois-banner" style="background-image:url({{url('assets/images/whois-b.jpg')}})">
        <div class="container">		
            <div class="banner-content">
                <div class="banner-image aos-init" data-aos="fade-up" data-aos-delay="100">
                </div>
                <h1 class="banner-title aos-init" data-aos="fade-up" data-aos-delay="200">
                    Whois Domain Lookup Tool
                </h1>
                <span class="banner-subtitle aos-init" data-aos="fade-up" data-aos-delay="300">
                    Find out the Complete Information For Domain in a single click
                </span>
                <div class="banner-search aos-init" data-aos="fade-up" data-aos-delay="400">
                    {!! Form::open(['method' => 'post', 'class'=>'custom-search', 'autocomplete' => 'off','name' => 'whois', 'id' => 'whois']) !!}
                    {!! Form::text('domainwhois',  old('domainwhois') , array('id' => 'domainwhois', 'autocomplete' => 'off','class' => 'form-control', 'placeholder' => 'Search for a Domain Name')) !!}
                    <button type="submit" title="Search" onclick="validateform();"><i class="fa fa-search"></i></button>
                    <span class="help-block" id="domainwhois-error">
                        @if ($errors->has('domainwhois'))
                        {{ $errors->first('domainwhois') }}
                        @endif
                    </span>
                    {!! Form::close() !!}
                </div>

                <div class="banner-button aos-init" data-aos="fade-up" data-aos-delay="500">
                    <a class="" title="Domain Registration" href="{{url('/domain-registration')}}">Domain Registration</a>
                    <a class="" title="Transfer Domain" href="{{url('domain/domain-transfer')}}">Transfer Domain</a>
                    <a class="" title="Renew Domain" href="{{url('/domain-privacy-protection')}}">Domain Privacy</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function validateform() {
            $('#whois').validate({// initialize the plugin
                onfocusout: function(element) {
                    if (this.checkable(element)) {
                        this.element(element);
                    }
                },
                errorPlacement: function(error, element) {
                    if ($(element).attr('id') == 'domainwhois') {
                        error.insertAfter($("#domainwhois-error"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                invalidHandler: function(event, validator) { //display error alert on form submit   
                    $('.alert-danger', $('#whois')).show();
                },
                highlight: function(element) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                }
            });

            {{-- jQuery.validator.addMethod("domainchecker", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/.test(value);
            }, "Please enter correct domain name."); --}}

            jQuery.validator.addMethod("domainchecker", function(value, element) {
                return this.optional(element) || /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) || /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/.test(value);
            }, "Please enter correct domain name.");

            $("[name^=domainwhois]").each(function() {
                $(this).rules("add", {
                    required: true,
                    maxlength: 58,
                    domainchecker: true,
                    messages: {
                        required: "Please enter your domain name."
                    }
                });
            });
        }
    </script>
    @if(!empty($WhoisData))
    @if(!empty($WhoisData['whois']))
    <div class="inner_container whois-container head-tb-p-40">
        <div class="container">
            <div class="cms">
                @php 
                $th = 0; 
                $myArray = explode("\n", $WhoisData['whois']);
                $Newdata = str_replace('<br />',' ',$myArray)
                @endphp
                <table border="0px" class="table table-hover table-custom">
                    @foreach($Newdata as $Data)
                    @php $DataNew = trim($Data) @endphp
                        @if($DataNew != '' && !empty($DataNew))
                            @if($th == 0) 
                                <tr class="whois_data"><th>{!!str_replace('---',' ',$DataNew)!!}</th></tr>
                            @else
                                <tr class="whois_data"><td>{!!str_replace('---',' ',$DataNew)!!}</td></tr>
                            @endif
                        @endif
                    @php $th ++; @endphp 
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="inner_container whois-container head-tb-p-40">
        <div class="container">
            @php $name = $_POST["domainwhois"]; @endphp
            <h2 class="available-domain">{{ ucfirst($name) }} domain is available</h2>
        </div>
    </div>
    @endif
    @endif
    <div class="inner_container whois-container head-tb-p-40">
        <div class="container">
            <div class="bg-design">
                {!!$CONTENT!!}
            </div>
        </div>
    </div>
</div>
<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$themeversion.'.faq-section')
@endsection