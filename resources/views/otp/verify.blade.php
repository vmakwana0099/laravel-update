@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="contact_form">
    <div class="container-fluid">
        <div class="row">	
            <div class="col-lg-6 col-12 left_part d-flex justify-content-end">
                <div class="contact-left aos-init" data-aos="fade-right">	
                    <h3 class="contact-title aos-init">OTP Verification</h3>
                    <div class="require-field">*(Denotes Required)</div>
                    {!! Form::open(['method' => 'post','url' => '/otp-doverification','class'=>'form-horizontal row contact_form', 'name' => 'contact_form', 'id' => 'contact_form']) !!}
                    {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label class="form-text" for="cname">Enter OTP Code<span class="required">*</span></label>
                            {!! Form::text('txt_otp',  old('txt_otp') , array('id' => 'txt_otp', 'class' => 'form-control')) !!}
                            @if ($errors->has('txt_otp'))
                            <span class="help-block">
                                {{ $errors->first('txt_otp') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-12">
                        <div class="form-group">        
                            <button type="submit" class="btn btn-default" title="Verify OTP">Verify OTP</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php /*<div class="col-12">
                        <div class="form-group">        
                            <a href="{{url('/')}}">Skip</a>
                        </div>
                    </div>*/?>
                    @if(!empty($errormsg))
                    <label class="alert error">{{$errormsg}}</label>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script src="{{ url('assets/js/otpverify.js') }}"></script>
@endsection