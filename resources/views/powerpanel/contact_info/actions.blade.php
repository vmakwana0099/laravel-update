@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('content')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@include('powerpanel.partials.breadcrumbs')
<?php 
use App\Helpers\MyLibrary;


?>
<style type="text/css">
    .removePhone, .removeEmail, .removePhone:hover, .removeEmail:hover{ color: #e73d4a; }
</style>

<div class="col-md-12 settings">
    @if(Session::has('message'))
    <div class="row">
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            {{ Session::get('message') }}
        </div>
    </div>
    @endif
    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div class="tabbable tabbable-tabdrop">
                    <div class="tab-content">
                        <div class="form_pattern">
                            {!! Form::open(['method' => 'post','id'=>'frmContactUS']) !!}
                            {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                            <div class="form-body">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} form-md-line-input">
                                    {!! Form::text('name',isset($contactInfo->varTitle)?$contactInfo->varTitle:old('name'), array('class' => 'form-control input-sm maxlength-handler', 'placeholder'=>'Name', 'maxlength'=>'150','id' => 'name','autocomplete'=>'off')) !!}
                                    <label class="form_title" for="name">{{ trans('template.common.name') }} <span aria-required="true" class="required"> * </span></label>
                                    <span class="help-block">
                                        {{ $errors->first('name') }}
                                    </span>
                                </div>
                                <?php if(isset($contactInfo)){  $Email = MyLibrary::encrypt_decrypt('decrypt',$contactInfo->varEmail); } ?>
                                <div class="multi-email">
                                    <div class="emailField form-group {{ $errors->has('email') ? 'has-error' : '' }} form-md-line-input">
                                        {!! Form::text('email',isset($Email)?$Email:old('email'), array('class' => 'form-control input-sm email', 'maxlength'=>'100','id' => 'email','placeholder' => 'Email','autocomplete'=>'off')) !!}
                                        <label class="form_title" for="email">{{ trans('template.common.email') }}<span aria-required="true" class="required"> * </span></label>
                                        <!--<a href="javascript:void(0);" class="addMoreEmail add_more" title="Add More"><i class="fa fa-plus"></i> Add More</a>-->
                                        <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                                    </div>
                                </div>
                                <?php if(isset($contactInfo)){  $Phone = MyLibrary::encrypt_decrypt('decrypt',$contactInfo->varPhoneNo);} ?>
                                <div class="multi-phone">
                                    <div class="phoneField form-group {{ $errors->has('phone_no') ? 'has-error' : '' }} form-md-line-input">
                                        {!! Form::text('phone_no', isset($Phone)?$Phone:old('phone_no'), array('class' => 'form-control input-sm','id' => 'phone_no','placeholder' => 'Phone No','autocomplete'=>'off', 'onpaste' => 'return false'  ,'ondrag' => "return false",  'ondrop' => "return false", 'maxlength'=>"20", 'onkeypress'=>"javascript: return KeycheckOnlyPhonenumber(event);")) !!}
                                        <label class="form_title" for="phone_no">{{ trans('template.common.phoneno') }} <span aria-required="true" class="required"> * </span></label>
                                        <!--<a href="javascript:void(0);" class="addMorePhone add_more" title="Add More"><i class="fa fa-plus"></i> Add More</a>-->
                                        <span class="help-block">
                                            {{ $errors->first('phone_no') }}
                                        </span>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input  {{ $errors->has('fax_no') ? 'has-error' : '' }}">
                                            {!! Form::text('fax_no',isset($contactInfo->varFaxNo)?$contactInfo->varFaxNo:old('fax_no'), array('class' => 'form-control','id'=>'fax_no','placeholder'=>'Fax No', 'autocomplete'=>'off','onpaste' => 'return false'  ,'ondrag' => "return false",  'ondrop' => "return false", 'style'=>'max-height:80px;', 'onkeypress'=>"javascript: return KeycheckOnlyPhonenumber(event);")) !!}
                                            <label class="form_title" for="fax_no">{{ trans('template.common.faxno') }}</label>
                                            <span class="help-block">
                                                {{ $errors->first('fax_no') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('supporthours') ? 'has-error' : '' }} form-md-line-input">
                                    {!! Form::text('supporthours',isset($contactInfo->varOpenHours)?$contactInfo->varOpenHours:old('supporthours'), array('class' => 'form-control input-sm maxlength-handler', 'placeholder'=>'Support Hours', 'maxlength'=>'150','id' => 'supporthours','autocomplete'=>'off')) !!}
                                    <label class="form_title" for="supporthours">{{ trans('template.common.supporthours') }}</label>
                                    <span class="help-block">
                                        {{ $errors->first('supporthours') }}
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input {{ $errors->has('home_page_title') ? 'has-error' : '' }}">
                                            {!! Form::textarea('home_page_title',isset($contactInfo->varHomePageTitle)?$contactInfo->varHomePageTitle:old('home_page_title'), array('class' => 'form-control','id'=>'home_page_title','placeholder'=>'Home Page Title','style'=>'max-height:80px;')) !!}
                                            <label class="form_title" for="home_page_title">{{ trans('template.common.homepagetitle') }} <span aria-required="true" class="required"> * </span></label>
                                            <span class="help-block"> {{ $errors->first('home_page_title') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input {{ $errors->has('home_page_description') ? 'has-error' : '' }}">
                                            {!! Form::textarea('home_page_description',isset($contactInfo->varHomePageDescription)?$contactInfo->varHomePageDescription:old('home_page_description'), array('maxlength' => 130, 'class' => 'form-control','id'=>'home_page_description','placeholder'=>'Home Page Description','style'=>'max-height:80px;')) !!}
                                            <label class="form_title" for="home_page_description">{{ trans('template.common.homepagedescription') }} <span aria-required="true" class="required"> * </span></label>
                                            <span class="help-block">
                                                {{ $errors->first('home_page_description') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input">
                                            {!! Form::textarea('mailingaddress',isset($contactInfo->varMailingAddress)?$contactInfo->varMailingAddress:old('mailingaddress'), array('class' => 'form-control','id'=>'mailingaddress','placeholder'=>'Mailing Address','style'=>'max-height:80px;')) !!}
                                            <label class="form_title" for="mailingaddress">{{ trans('template.common.mailingaddress') }} </label>
                                            <span class="help-block">
                                                {{ $errors->first('mailingaddress') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input">
                                            {!! Form::textarea('officeaddress',isset($contactInfo->varOfficeAddress)?$contactInfo->varOfficeAddress:old('officeaddress'), array('class' => 'form-control','id'=>'officeaddress','placeholder'=>'Office Address','style'=>'max-height:80px;')) !!}
                                            <label class="form_title" for="officeaddress">{{ trans('template.common.officeaddress') }} </label>
                                            <span class="help-block">
                                                {{ $errors->first('officeaddress') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input">
                                            {!! Form::textarea('schema_address',isset($contactInfo->varSchemaAddress)?$contactInfo->varSchemaAddress:old('schema_address'), array('class' => 'form-control','id'=>'schema_address','placeholder'=>' Schema Address','style'=>'max-height:80px;')) !!}
                                            <label class="form_title" for="schema_address">{{ trans('template.common.schemaaddress') }} </label>
                                            <span class="help-block">
                                                {{ $errors->first('schema_address') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('schema_locality',isset($contactInfo->varSchemaLocality)?$contactInfo->varSchemaLocality:old('schema_locality'), array('class' => 'form-control input-sm maxlength-handler', 'placeholder'=>'Schema Locality', 'maxlength'=>'150','id' => 'schema_locality','autocomplete'=>'off')) !!}
                                    <label class="form_title" for="schema_locality">{{ trans('template.common.schemalocality') }} </label>
                                    <span class="help-block">
                                        {{ $errors->first('schema_locality') }}
                                    </span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('schema_rgion',isset($contactInfo->varSchemaRegion)?$contactInfo->varSchemaRegion:old('schema_rgion'), array('class' => 'form-control input-sm maxlength-handler', 'placeholder'=>'Schema Region', 'maxlength'=>'150','id' => 'schema_rgion','autocomplete'=>'off')) !!}
                                    <label class="form_title" for="schema_rgion">{{ trans('template.common.schemaregion') }} </label>
                                    <span class="help-block">
                                        {{ $errors->first('schema_rgion') }}
                                    </span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('schema_postalcode',isset($contactInfo->varSchemaPostalCode)?$contactInfo->varSchemaPostalCode:old('schema_postalcode'), array('class' => 'form-control input-sm maxlength-handler', 'placeholder'=>'Schema Postal Code', 'maxlength'=>'150','id' => 'schema_postalcode','autocomplete'=>'off')) !!}
                                    <label class="form_title" for="schema_postalcode">{{ trans('template.common.schemapostalcode') }} </label>
                                    <span class="help-block">
                                        {{ $errors->first('schema_postalcode') }}
                                    </span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('schema_country',isset($contactInfo->varSchemaCountry)?$contactInfo->varSchemaCountry:old('schema_country'), array('class' => 'form-control input-sm maxlength-handler', 'placeholder'=>'Schema Country', 'maxlength'=>'150','id' => 'schema_country','autocomplete'=>'off')) !!}
                                    <label class="form_title" for="schema_country">{{ trans('template.common.schemacountry') }} </label>
                                    <span class="help-block">
                                        {{ $errors->first('schema_country') }}
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" value="{{ isset($contactInfo->varLatitude)?$contactInfo->varLatitude:old('lattitude') }}" name="lattitude" id="latbox"/>
                                        <input type="hidden" value="{{ isset($contactInfo->varLongitude)?$contactInfo->varLongitude:old('longitude') }}" name="longitude" id="lonbox"/>

                                        <div id="map" style="margin-left: 0px; margin-top: 15px; margin-bottom: 10px; width:100%;height:220px;"></div>
                                        <p style="float:right;"><strong>Note:</strong> User Map Pin to get the Latitude, Longitude automatically.</p>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        {!! Form::text('order', isset($contactInfo->intDisplayOrder)?$contactInfo->intDisplayOrder:$total, array('maxlength'=>10,'placeholder' => trans('template.common.order'),'class' => 'form-control','autocomplete'=>'off')) !!}
                                        <label class="form_title" class="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
                                        <span style="color: red;">
                                            <strong>{{ $errors->first('order') }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    @include('powerpanel.partials.displayInfo',['s'=> isset($contactInfo->chrPublish)?$contactInfo->chrPublish:null])
                                </div>
                            </div> 
                            </div>
                            

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                        <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                        <a class="btn btn-outline red" href="{{ url('powerpanel/contact-info') }}">{{ trans('template.common.cancel') }}</a>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@endsection
@section('scripts')
<script src="{{ url('resources/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>

<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBqof4FJWnGe2eCCG8HGXMajO1TiaxkVf4"></script>
<script type="text/javascript">
                                                    var latval = "{{ isset($contactInfo->varLatitude)?$contactInfo->varLatitude:'' }}";
                                                    var longval = "{{ isset($contactInfo->varLongitude)?$contactInfo->varLongitude:'' }}";
                                                    var address = "{{ isset($contactInfo->varTitle)?$contactInfo->varTitle:'' }}";


                                                    if ((latval == '' && longval == '') && address != '') {
                                                        var geocoder = new google.maps.Geocoder();
                                                        geocoder.geocode({
                                                            'address': address
                                                        }, function(results, status) {
                                                            if (status == google.maps.GeocoderStatus.OK) {
                                                                latval = results[0].geometry.location.lat();
                                                                longval = results[0].geometry.location.lng();
                                                            }
                                                        });
                                                    }


                                                    if (latval == '' && longval == '' || address == '') {
                                                        latval = '19.321187240779548';
                                                        longval = '-81.2274169921875';
                                                        var lat = parseFloat(latval);
                                                        var lng = parseFloat(longval);
                                                        var latlng = new google.maps.LatLng(lat, lng);
                                                        var geocoder = geocoder = new google.maps.Geocoder();
                                                        geocoder.geocode({
                                                            'latLng': latlng
                                                        }, function(results, status) {
                                                            if (status == google.maps.GeocoderStatus.OK) {
                                                                if (results[1]) {
                                                                    $('#address').blur();
                                                                }
                                                            }
                                                        });
                                                    }
                                                    var markers = [];
                                                    var defaultposition;
                                                    var mapOptions = {
                                                        zoom: 11,
                                                        streetViewControl: false,
                                                        center: new google.maps.LatLng(latval, longval),
                                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                                    };
                                                    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
                                                    defaultposition = new google.maps.LatLng(latval, longval);
                                                    addMarker(defaultposition);
                                                    google.maps.event.addListener(map, 'click', function(event) {
                                                        var lat = parseFloat(event.latLng.lat());
                                                        var lng = parseFloat(event.latLng.lng());
                                                        var latlng = new google.maps.LatLng(lat, lng);
                                                        var geocoder = geocoder = new google.maps.Geocoder();
                                                        geocoder.geocode({
                                                            'latLng': latlng
                                                        }, function(results, status) {
                                                            if (status == google.maps.GeocoderStatus.OK) {
                                                                if (results[0]) {
                                                                    document.getElementById("address").value = results[0].formatted_address;
                                                                    $('#address').blur();
                                                                }
                                                            }
                                                        });
                                                        clearMarkers();
                                                        addMarker(event.latLng);
                                                        document.getElementById("latbox").value = event.latLng.lat();
                                                        document.getElementById("lonbox").value = event.latLng.lng();
                                                        $('#latbox').blur();
                                                        $('#lonbox').blur();
                                                    });

                                                    function addMarker(location) {
                                                        var marker = new google.maps.Marker({
                                                            animation: google.maps.Animation.DROP,
                                                            position: location,
                                                            draggable: true,
                                                            map: map
                                                        });
                                                        markers.push(marker);
                                                    }

                                                    function clearMarkers() {
                                                        setAllMap(null);
                                                    }

                                                    function setAllMap(map) {
                                                        for (var i = 0; i < markers.length; i++) {
                                                            markers[i].setMap(map);
                                                        }
                                                    }


                                                    var emcnt = '{{ isset($emcnt)?$emcnt:0}}';
                                                    var phcnt = '{{ isset($phcnt)?$phcnt:0}}';

</script>
<script src="{{ url('resources/pages/scripts/contacts_validations.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/numbervalidation.js') }}" type="text/javascript"></script>
<script type="text/javascript">window.site_url = '{!! url("/") !!}';</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
@endsection