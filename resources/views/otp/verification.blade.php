@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="contact_form">
    <div class="container">
        <div class="row">	
            <div class="col-lg-6 col-12 left_part d-flex justify-content-end">
                <div class="contact-left aos-init" data-aos="fade-right">	
                    <div class="section-heading mb-2">
                    <h2 class="text_head text-start">OTP Verification</h2>
                    </div>
                    <div class="require-field">*(Denotes Required)</div>
                    {!! Form::open(['method' => 'post','url' => '/otp-send','class'=>'form-horizontal row contact_form', 'name' => 'contact_form', 'id' => 'contact_form']) !!}
                    {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                     @php $diaplayCountry=''; @endphp
                    @foreach($countryCode as $key=>$val)
                    @if($key==Config::get('Constant.sys_country'))
                    @if($key==Config::get('Constant.sys_country'))
                    @php $diaplayCountry=$val; @endphp
                    @endif
                    @endif
                    @endforeach
                    
                <div class="col-md-12 col-12">
                     <div class="form-group">
                <label for="loginusername">Country</label>
                <select class="form-select" data-live-search="true" id="otpcountry" name="otpcountry">
                <option value="">Select</option>
                @php $country_count=0; @endphp
                @if(isset($countryDialingCode))
                @foreach($countryDialingCode as $key => $itm)
                <option data-icon="flagstrap-icon {{$itm['cflag']}}" value="{{$itm['ccode']}}" @if($diaplayCountry==$itm['cname']) selected @else @endif> (+{{$itm['ccode']}}) - {{$itm['cname']}}</option>
                @php $country_count++; @endphp
                @endforeach
                @endif       
                </select>
                @if ($errors->has('otpcountry'))
                <span class="help-block">
                {{ $errors->first('otpcountry') }}
                </span>
                @endif
                <span id="countryerrormsg"></span>
                </div>
                </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label class="form-text" for="cname">Enter your Phone no.<span class="required">*</span></label>
                            {!! Form::text('phone_number',  old('phone_number') , array('id' => 'phone_number', 'class' => 'form-control')) !!}
                            @if ($errors->has('phone_number'))
                            <span class="help-block">
                                {{ $errors->first('phone_number') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-12">
                        <div class="form-group">        
                            <button type="submit" class="btn btn-default" title="Send OTP">Send OTP</button>
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
<script src="{{ url('assets/js/otpverification2.js') }}"></script>
<script>
$("#otpcountry").change(function(){
   $("#contact_form").valid(); 
});
</script>
@endsection