@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('resources/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection
@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@section('content')
@include('powerpanel.partials.breadcrumbs')
<div class="row">
	<div class="col-sm-12">
		@if(Session::has('message'))
		<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
			{{ Session::get('message') }}
		</div>
		@endif

		{{-- @if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> {{ trans('template.common.inputProblem') }}  <br><br>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif --}}
		
		<div class="portlet light bordered">
			<div class="portlet-body">
				<div class="tabbable tabbable-tabdrop">
					<div class="tab-content">
						<div class="row">
							<div class="col-md-12">
								<div class="tab-pane active" id="general">
									<div class="portlet-body form_pattern">
										{!! Form::open(['method' => 'post','id'=>'frmEvent']) !!}
										<div class="form-body">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
														{!! Form::text('title', isset($event->varTitle)?$event->varTitle:old('title'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler', 'data-url' => 'powerpanel/events', 'placeholder'=> trans("template.common.title"))) !!}
														<label class="form_title" for="site_name">{{ trans("template.common.title") }}<span aria-required="true" class="required"> * </span></label>
														<span class="help-block">
															{{ $errors->first('title') }}
														</span>
													</div>
													<!-- code for alias -->
													{!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/events')) !!}
													{!! Form::hidden('alias', isset($event->alias->varAlias)?$event->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
													{!! Form::hidden('oldAlias', isset($event->alias->varAlias)?$event->alias->varAlias:old('alias')) !!}
													<div class="form-group alias-group {{!isset($event)?'hide':''}} ">
														<label class="form_title" for="{{ trans('template.url') }}">{{ trans('template.common.url') }} :</label>
														<a href="javascript:void;" class="alias">{!! url("/") !!}</a>
														<a href="javascript:void(0);" class="editAlias" title="Edit">
															<i class="fa fa-edit"></i>
															<a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('events/'.(isset($event->alias->varAlias) && isset($event)?$event->alias->varAlias:''))}}">
																<i class="fa fa-external-link" aria-hidden="true"></i>
															</a>
														</a>
													</div>
													<span class="help-block">
														{{ $errors->first('alias') }}
													</span>
													<!-- code for alias -->
												</div>
											</div>

											@permission('event-category-list')
												@include('powerpanel.partials.category',['categories'=>$EventCategory, 'data'=>isset($event)?$event:null])
											@endpermission

											<div class="row">
												<div class="col-md-12">
													<div class="form-group @if($errors->first('event_days')) has-error @endif">
														<label class="form_title" for="event_days">{{ trans('template.eventModule.eventDays') }} <span aria-required="true" class="required"> * </span></label>
														<select class="form-control bs-select select2" name="event_days[]" id="event_days" multiple>
															<option value="">--{{ trans('template.eventModule.selectEventDays') }}--</option>
															
															@php $event_days = !empty($event->varEventDays)?explode(',',$event->varEventDays):[]; @endphp
															<option value="weekdays" {{ (in_array('weekdays',$event_days))? 'selected':'' }} >{{ trans('template.eventModule.weekDays') }}</option>
															<option value="weekends" {{ (in_array('weekends',$event_days))? 'selected':'' }} >{{ trans('template.eventModule.weekEnd') }}</option>
															<option value="mon" {{ (in_array('mon',$event_days) )? 'selected':'' }} >{{ trans('template.eventModule.monday') }}</option>
															<option value="tue" {{ (in_array('tue',$event_days) )? 'selected':'' }} >{{ trans('template.eventModule.tuesday') }}</option>
															<option value="wed" {{ (in_array('wed',$event_days) )? 'selected':'' }} >{{ trans('template.eventModule.wednesday') }}</option>
															<option value="thu" {{ (in_array('thu',$event_days) )? 'selected':'' }} >{{ trans('template.eventModule.thursday') }}</option>
															<option value="fri" {{ (in_array('fri',$event_days) )? 'selected':'' }} >{{ trans('template.eventModule.friday') }}</option>
															<option value="sat" {{ (in_array('sat',$event_days) )? 'selected':'' }} >{{ trans('template.eventModule.saturday') }}</option>
															<option value="sun" {{ (in_array('sun',$event_days) )? 'selected':'' }} >{{ trans('template.eventModule.sunday') }}</option>
														</select>
														<span class="help-block">{{ $errors->first('event_days') }} </span> </div>
												</div>
											</div>
											@php $eventPricingType = (isset($event->varEventPriceType))?$event->varEventPriceType:'Free'; @endphp
											<div class="row">
												<div class="col-md-6">
													<div class="form-group @if($errors->first('event_pricing_type')) has-error @endif">
														<label class="form_title" for="event_pricing_type">{{ trans('template.eventModule.eventPricing') }} <span aria-required="true" class="required"> * </span></label>
														<select class="form-control bs-select select2" name="event_pricing_type" id="event_pricing_type">
															<option value="Free" {{ (isset($eventPricingType) && $eventPricingType=="Free" )? 'selected':'' }} >Free</option>
															<option value="Paid" {{ (isset($eventPricingType) && $eventPricingType=="Paid" )? 'selected':'' }} >Paid</option>
														</select>
														<span class="help-block">{{ $errors->first('event_pricing_type') }} </span> </div>
												</div>
												<div class="col-md-6">
												@php 
														$dip_pricing_box = ($eventPricingType=="Free")?'display:none':''; 
												@endphp
													<div id="pricing" style="{{ $dip_pricing_box }}">
														<div class="row">
																<div class="col-md-6">
																		<div class="form-group form-md-line-input">
																			{!! Form::text('adult_price', isset($event->fltAdultPrice)?$event->fltAdultPrice:old('adult_price'), array('id'=>'adultPrice','class' => 'form-control amountfield')) !!}
																			<label class="form_title" for="site_name">{{ trans('template.eventModule.eventAdultPrice') }} <span aria-required="true" class="required"> * </span></label>
																			<span class="help-block">
																				{{ $errors->first('adult_price') }}
																			</span>
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="form-group form-md-line-input">
																			{!! Form::text('child_price', isset($event->fltChildPrice)?$event->fltChildPrice:old('child_price'), array('id'=>'childPrice','class' => 'form-control amountfield')) !!}
																			<label class="form_title" for="site_name">{{ trans('template.eventModule.eventChildPrice') }} <span aria-required="true" class="required"> * </span></label>
																			<span class="help-block">
																				{{ $errors->first('child_price') }}
																			</span>
																		</div>
																</div>
														</div>
													</div>
												</div>
											</div>
											

											<div class="row">
												<div class="col-md-12">
													<div class="image_thumb multi_upload_images">
														<div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }}">
															<label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }}</label>
															<div class="clearfix"></div>
															<div class="fileinput fileinput-new" data-provides="fileinput">
																<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:100%; float:left; height:120px;position: relative;">
																	<img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
																</div>
																<div class="input-group">
																	<a class="media_manager multiple-selection" data-multiple=true onclick="MediaManager.open('event_image');"><span class="fileinput-new"></span></a>
																	<input class="form-control" type="hidden" id="event_image" name="img_id" value="{{ isset($event->fkIntImgId)?$event->fkIntImgId:old('img_id') }}" />
																	<input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
																</div>
															</div>
															<div class="clearfix"></div>
															@if(!empty($event->fkIntImgId) && isset($event->fkIntImgId))
															@php $imageArr = explode(',',$event->fkIntImgId)  @endphp
															<div id="event_image_img">
																<div class="multi_image_list">
																	<ul>
																	@foreach($imageArr as $key => $value)
																		<li id="{{ $value }}">
																			<span>
																				<img src="{!! App\Helpers\resize_image::resize($value,109,100) !!}" alt="Img" />
																				<a href="javascript:;" onclick="MediaManager.removeImageFromGallery('{{ $value }}');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
																			</span>
																		</li>
																	@endforeach
																	</ul>
																</div>
															</div>
															@else 
															<div id="event_image_img"></div>
															@endif
															@php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{{ trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) }}</span>
														</div>
													</div>
												</div>
											</div>

											<div class="row viduploader">
											<div class="col-md-12">
												<div class="image_thumb">
													<div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }} ">
														<label class="form_title" for="front_logo">{{ trans('template.eventModule.selectVideo') }} </label>
														<div class="clearfix"></div>
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-preview thumbnail event_video_vid" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
																@if(Input::old('video_url'))
																<img src="{{ Input::old('video_url') }}" />
																@else
																<img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" />
																@endif
															</div>
															<div class="input-group"> <a class="video_manager" onclick="MediaManager.openVideoManager('event_video');"><span class="fileinput-new"></span></a> </div>
																@if(!empty($event->video->varVideoName))
																<input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ $event->video->varVideoName }}.{{ $event->video->varVideoExtension }}" />
																@else
																<input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ isset($event->video->varVideoName)?$event->video->varVideoName:'' }}" />
																@endif
																<input class="form-control" type="hidden" id="event_video" name="video_id" value="{{ isset($event->fkIntVideoId)?$event->fkIntVideoId:old('video_id') }}" />
														</div>
													</div>
													<div class="clearfix"></div>
													<span>({{ trans('template.eventModule.videoRecommendation') }}.)</span> <span style="color:#e73d4a"> {{ $errors->first('video_id') }}</span> </div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group @if($errors->first('description')) has-error @endif ">
														<label class="control-label form_title">{{ trans('template.common.description') }}</label>
														{!! Form::textarea('description', isset($event->txtDescription)?$event->txtDescription:old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
														<span class="help-block">{{ $errors->first('description') }}</span>
													</div>
												</div>
											</div>
											@php $defaultDt = (null !== old('start_date_time'))?old('start_date_time'):date('Y-m-d g:i A'); @endphp
											<div class="row">
												<div class="col-md-6">
													<div class="form-group form-md-line-input">
														<div class="input-group date form_meridian_datetime @if($errors->first('start_date_time')) has-error @endif" data-date="{{ date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime(isset($event->dtStartDateTime)?$event->dtStartDateTime:$defaultDt)) }}">
															<span class="input-group-btn date_default">
																<button class="btn date-set fromButton" type="button">
																<i class="fa fa-calendar"></i>
																</button>
															</span>
															{!! Form::text('start_date_time', date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime(isset($event->dtStartDateTime)?$event->dtStartDateTime:$defaultDt)), array('class' => 'form-control','maxlength'=>160,'size'=>'16','id'=>'start_date_time','readonly'=>true)) !!}
															<label class="control-label form_title">{{ trans('template.common.startDateAndTime') }}<span aria-required="true" class="required"> * </span></label>
														</div>
														<span class="help-block">
															{{ $errors->first('start_date_time') }}
														</span>
													</div>
												</div>
												@php $defaultDt = (null !== old('end_date_time'))?old('end_date_time'):null; @endphp
												@if ((isset($event->dtEndDateTime)==null))
												@php 
													$expChecked_yes = 1; 
													$expclass='';
												@endphp
												@else
												@php 
													$expChecked_yes = 0;
													$expclass='no_expiry';
												@endphp
												@endif
												<div class="col-md-6">
													<div class="form-group form-md-line-input">
														<div class="input-group date  form_meridian_datetime expirydate @if($errors->first('end_date_time')) has-error @endif" data-date="{{ Carbon\Carbon::today()->format('Y-m-d') }}T15:25:00Z" @if ($expChecked_yes==1) style="display:none;" @endif>
															<span class="input-group-btn date_default">
																<button class="btn date-set toButton" type="button">
																<i class="fa fa-calendar"></i>
																</button>
															</span>
															{!! Form::text('end_date_time', isset($event->dtEndDateTime)?date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime($event->dtEndDateTime)):$defaultDt, array('class' => 'form-control','maxlength'=>160,'size'=>'16','readonly'=>true,'id'=>'end_date_time', 'data-exp'=> $expChecked_yes, 'data-newvalue')) !!}
															<label class="control-label form_title">{{ trans('template.common.endDateAndTime') }}<span aria-required="true" class="required"> * </span></label>
														</div>
														<span class="help-block">
															{{ $errors->first('end_date_time') }}
														</span>
														<label class="expdatelabel {{ $expclass }}">
															<a id="noexpiry" name="noexpiry" href="javascript:void(0);">
																<b class="expiry_lbl"></b>
															</a>
														</label>
													</div>
												</div>
											</div>
											<div class="row">
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group form-md-line-input">
														{!! Form::text('lattitude', isset($event->varLatitude)?$event->varLatitude:old('lattitude'), array('id'=>'latbox','maxlength'=>150,'class' => 'form-control')) !!}
														<label class="form_title" for="site_name">{{ trans('template.common.latitude') }}</label>
														<span class="help-block">
															{{ $errors->first('lattitude') }}
														</span>
													</div>
													<br><br>
													<div class="form-group form-md-line-input">
														{!! Form::text('longitude', isset($event->varLongitude)?$event->varLongitude:old('longitude'), array('id'=>'lonbox','maxlength'=>150,'class' => 'form-control')) !!}
														<label class="form_title" for="site_name">{{ trans('template.common.longitude') }}</label>
														<span class="help-block">
															{{ $errors->first('longitude') }}
														</span>
													</div>
												</div>
												<div class="col-md-6">
													<div id="map" style="margin-left: 0px; margin-top: 15px; margin-bottom: 10px; width:100%;height:200px;"></div>
													<p><strong>{{ trans('template.common.note') }}:</strong> {{ trans('template.common.mapPinInstruction') }}</p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label form_title">{{ trans('template.common.address') }}</label>
														{!! Form::textarea('address', isset($event->txtAddress)?$event->txtAddress:old('address'),
														array('class' => 'form-control','cols' => '40','rows' => '3','id' => 'address')) !!}
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class=" form-md-line-input nopadding">
														@php $form = 'frmEvent';  @endphp
														@include('powerpanel.partials.seoInfo',['form'=>'frmEvent','inf'=>isset($metaInfo)?$metaInfo:false])
													</div>
												</div>
											</div>
											<h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
											<div class="row">
												<div class="col-md-6">
												@php
													$display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
													if(!isset($event->intDisplayOrder)){
															$display_order_attributes['readonly'] = "readonly";
													} 
												@endphp
													<div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
														{!! Form::text('display_order', isset($event->intDisplayOrder)?$event->intDisplayOrder:$total, $display_order_attributes) !!}
														<label class="site_name form_title">{{ trans('template.common.displayorder') }}<span aria-required="true" class="required"> * </span></label>
														<span class="help-block">
															{{ $errors->first('display_order') }}
														</span>
													</div>
												</div>
												<div class="col-md-6">
													@include('powerpanel.partials.displayInfo',['display' => isset($event->chrPublish)?$event->chrPublish:null ])
												</div>
											</div>
										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-12">
													<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
													<button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
													<a class="btn btn-outline red" href="{{ url('powerpanel/events') }}">{{ trans('template.common.cancel') }}</a>
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
		</div>
	</div>
</div>
<div class="new_modal modal fade bs-modal-sm" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-vertical">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">{{ trans('template.common.alert') }}</h4>
				</div>
				<div class="modal-body">
					<p>{{ trans('template.common.pleaseSelectProperDateRange') }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@include('powerpanel.partials.addCat',['module' => 'event-category','categoryHeirarchy' => $categoryHeirarchy])
@endsection

@section('scripts')
<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBqof4FJWnGe2eCCG8HGXMajO1TiaxkVf4"></script>
<script type="text/javascript">
	var latval = "{{ isset($event->varLatitude)?$event->varLatitude:'' }}";
	var longval = "{{ isset($event->varLongitude)?$event->varLongitude:'' }}";
	var address = "{{ isset($event->txtAddress)?$event->txtAddress:'' }}";
	if (latval == '' && longval == '' || address == '') {
		latval = '19.321187240779548';
		longval = '-81.2274169921875';
		var lat = parseFloat(latval);
var lng = parseFloat(longval);
		var latlng = new google.maps.LatLng(lat, lng);
var geocoder = geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'latLng': latlng }, function (results, status) {
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
	google.maps.event.addListener(map, 'click', function (event) {
		var lat = parseFloat(event.latLng.lat());
var lng = parseFloat(event.latLng.lng());
var latlng = new google.maps.LatLng(lat, lng);
var geocoder = geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'latLng': latlng }, function (results, status) {
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
</script>
<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
	var seoFormId = 'frmEvent';
	var user_action = "{{ isset($event)?'edit':'add' }}";
	var moduleAlias = 'events';
	@permission('event-category-list')
	categoryAllowed = true;
	@endpermission
</script>
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/moment.min.js') }}"></script>
<script src="{{ url('resources/global/plugins/moments-timezone.js') }}"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script type="text/javascript">
var today= moment.tz("{{Config::get('Constant.DEFAULT_TIME_ZONE')}}").format(DEFAULT_DT_FORMAT+" H:m:s");
$(document).ready(function() {
	$('#event').select2({
		placeholder: "Select an event",
		width: '100%'
	});

$('#event_days').select2({
										placeholder: "Select Show Days",
										width: '100%'
									}).on("change", function (e) {
									$( "#event_days" ).closest('.has-error').removeClass('has-error');
									$( "#event_days-error" ).remove();
						});

	$('#start_date_time').datetimepicker({
		autoclose: true,
startDate:today,
showMeridian: true,
minuteStep: 5,
format:DEFAULT_DT_FMT_FOR_DATEPICKER+' HH:ii P'
}).on("changeDate", function (e) {
		$( "#start_date_time" ).closest('.has-error').removeClass('has-error');
			$( "#start_date_time-error" ).remove();
			var startdate = moment($('#start_date_time').val());
			startdate = moment(startdate).add(1, 'hours').format(DEFAULT_DT_FORMAT+" H:m:s");
						$('#end_date_time').datetimepicker('setStartDate',startdate);
	});
var startdate = moment($('#start_date_time').val());
	startdate = moment(startdate).add(1, 'hours').format(DEFAULT_DT_FORMAT+" H:m:s");
$('#end_date_time').datetimepicker({
		autoclose: true,
startDate:startdate,
showMeridian: true,
minuteStep: 5,
format:DEFAULT_DT_FMT_FOR_DATEPICKER+' HH:ii P'
}).on("changeDate", function (e) {
		$( "#end_date_time" ).closest('.has-error').removeClass('has-error');
			$( "#end_date_time-error" ).remove();
		});

		$('.fromButton,#start_date_time').click(function(){
			$('#start_date_time').datetimepicker('show');
		});
		$('.toButton,#end_date_time').click(function(){
			$('#end_date_time').datetimepicker('show');
		});
});
</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/event_validations.js') }}" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
@endsection