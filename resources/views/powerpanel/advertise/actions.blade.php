@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('resources/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection
@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp


{{-- @if (count($errors) > 0)
<div class="alert alert-danger">
	<strong>Whoops!</strong> There were some problems with your input.<br><br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif --}} 


<div class="col-md-12 settings">
	<div class="row">
		@if(Session::has('message'))
		<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
			{{ Session::get('message') }}
		</div>
		@endif
		<div class="portlet light bordered">
			<div class="portlet-body">
				<div class="tabbable tabbable-tabdrop">
					<div class="tab-content">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet-body form_pattern">
									{!! Form::open(['method' => 'post','id'=>'frmAdv']) !!}
									<div class="row">
										<div class="col-md-12">
											<div class="form-group @if($errors->first('ad_name')) has-error @endif form-md-line-input">
												{!! Form::text('ad_name', isset($advertise->varTitle)?$advertise->varTitle:old('ad_name'), array('maxlength' => 150, 'class' => 'hasAlias form-control seoField maxlength-handler','data-url' => 'powerpanel/advertise','placeholder' => trans('template.advertiseModule.advertisementName'),'autocomplete'=>'off')) !!}
												<label class="form_title" for="site_name">{!! trans('template.advertiseModule.advertisementName') !!} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													<strong>{{ $errors->first('ad_name') }}</strong>
												</span>
											</div>
										</div>
									</div>									
									
									<h3 class="form-section" style="margin-top: 5px;">{!! trans('template.advertiseModule.setAdvertisePosition') !!}</h3>
									<br/>
									<div class="form-group">																														
										<div class="row">
											<div class="col-md-6">
											@php
												$selectedPage=array();
												if(isset($advertise->varPages)){
													foreach(unserialize($advertise->varPages) as $key=>$page){
														$selectedPage[$key]=(int)$page;
													}
												}else if(null!==old('pages')){
													foreach(old('pages') as $key=>$selpage){
														$selectedPage[$key]=(int)$selpage;
													}
												}else{
														$selectedPage = old('pages');
													}											
											@endphp	

											<label class="form_title" for="advertise_type">{!! trans('template.advertiseModule.selectPage') !!}<span aria-required="true" class="required"> * </span></label>
												{!! Form::select('pages[]', $CmsPage, $selectedPage, array('id'=>'selectPages','class' => 'form-control bs-select select2','multiple')) !!}
												<span class="help-block">
													<strong>{{ $errors->first('pages') }}</strong>
												</span>
											</div>
											<div class="col-md-6">
												<label class="form_title" for="advertise_type">{!! trans('template.advertiseModule.selectPosition') !!}<span aria-required="true" class="required"> * </span></label>
												{!! Form::select('position[]', $positions,isset($advertise->txtPosition)?unserialize($advertise->txtPosition):old('position'), array('id'=>'selectPosition','class' => 'form-control bs-select select2','multiple')) !!}
												<span class="help-block">
													<strong>{{ $errors->first('position') }}</strong>
												</span>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="image_thumb">
												<div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }}">
													<label class="form_title" for="front_logo">{!! trans('template.common.selectimage') !!} <span aria-required="true" class="required"> * </span></label>
													<div class="clearfix"></div>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail advertise_image_img" data-trigger="fileinput" style="width:100%; float:left; height:120px;position: relative;">
															@if(Input::old('image_url'))
															<img src="{{ Input::old('image_url') }}" />
															@elseif(!empty($advertise->fkIntImgId) && isset($advertise->fkIntImgId))
															<img  src="{!! App\Helpers\resize_image::resize($advertise->fkIntImgId) !!}" />
															@else
															<img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
															@endif
														</div>
														<div class="input-group">
															<a class="media_manager" onclick="MediaManager.open('advertise_image');"><span class="fileinput-new"></span></a>
															<input class="form-control" type="hidden" id="advertise_image" name="img_id" value="{{ isset($advertise->fkIntImgId)?$advertise->fkIntImgId:old('img_id') }}" />
															<input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
														</div>
													</div>
													<div class="clearfix"></div>
													@php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{!! trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) !!}</span>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group @if($errors->first('link')) has-error @endif form-md-line-input">
												{!! Form::text('link', isset($advertise->txtLink)?$advertise->txtLink:old('link'), array('class' => 'form-control','placeholder' => trans('template.common.link'),'autocomplete'=>'off')) !!}
												<label class="form_title" for="site_name">{!! trans('template.common.link') !!} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													<strong>{{ $errors->first('link') }}</strong>
												</span>
											</div>
										</div>
									</div>
									@php $defaultDt = (null !== old('start_date_time'))?old('start_date_time'):date('Y-m-d g:i A'); @endphp
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group date form_meridian_datetime @if($errors->first('start_date_time')) has-error @endif" data-date="{{ date('Y-m-d g:i A',strtotime(isset($advertise->dtStartDateTime)?$advertise->dtStartDateTime:$defaultDt)) }}">
													<span class="input-group-btn date_default">
														<button class="btn date-set fromButton" type="button">
														<i class="fa fa-calendar"></i>
														</button>
													</span>
													{!! Form::text('start_date_time', date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime(isset($advertise->dtStartDateTime)?$advertise->dtStartDateTime:$defaultDt)), array('class' => 'form-control','maxlength'=>160,'size'=>'16','id'=>'start_date_time','readonly'=>true)) !!}
													<label class="control-label form_title">{!! trans('template.advertiseModule.startDateTime') !!}<span aria-required="true" class="required"> * </span></label>
													
												</div>
												<span class="help-block">
													{{ $errors->first('start_date_time') }}
												</span>
											</div>
										</div>
										@php $defaultDt = (null !== old('end_date_time'))?old('end_date_time'):null; @endphp
										@if ((isset($advertise->dtEndDateTime)==null))
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
												<div class="input-group date  form_meridian_datetime expirydate @if($errors->first('end_date_time')) has-error @endif" @if($defaultDt!=null) data-date="{{ isset($advertise->dtEndDateTime)?date('Y-m-d g:i A',strtotime($advertise->dtEndDateTime)):$defaultDt }}" @endif @if ($expChecked_yes==1) style="display:none;" @endif>
													<span class="input-group-btn date_default">														
														<button class="btn default date-set toButton" type="button">
														<i class="fa fa-calendar"></i>
														</button>
													</span>
													{!! Form::text('end_date_time', isset($advertise->dtEndDateTime)?date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime($advertise->dtEndDateTime)):$defaultDt, array('class' => 'form-control','maxlength'=>160,'size'=>'16','id'=>'end_date_time','readonly'=>true,'data-exp'=> $expChecked_yes,'data-newvalue')) !!}
													<label class="control-label form_title">{!! trans('template.advertiseModule.endDateTime') !!} <span aria-required="true" class="required"> * </span></label>
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
										<div class="col-md-6">
											@include('powerpanel.partials.displayInfo',['display' => isset($advertise->chrPublish)?$advertise->chrPublish:null ])
										</div>
									</div>
									<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
									<button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
									<a class="btn btn-outline red" href="{{ url('powerpanel/advertise') }}">{!! trans('template.common.cancel') !!}</a>
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
@endsection

@section('scripts')
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/moment.min.js') }}"></script>
<script src="{{ url('resources/global/plugins/moments-timezone.js') }}"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
var DELETE_ATLEAST_ONE ="{!! trans('template.advertiseModule.endDateTime') !!}"; //'Please select atleast one record to be deleted.';
var DELETE_CONFIRM_MESSAGE = "{!! trans('template.advertiseModule.endDateTime') !!}";//'Caution! The selected records will be deleted. Press DELETE to confirm.';
var oldVal = "{{isset($advertise->dtEndDateTime)?date('Y-m-d g:i A',strtotime($advertise->dtEndDateTime)):$defaultDt}}";
	$(document).ready(function()
	{

		$('#frmAdv select option:nth-child(1)').prop('disabled',true);

		$('#selectPages').select2({
			placeholder: "Select Pages",
			width: '100%'
		}).on("change", function (e) {
				$( "#selectPages" ).closest('.has-error').removeClass('has-error');
					$( "#selectPages-error" ).remove();
				});
		
		$('#selectPosition').select2({
			placeholder: "Select Slots",
			width: '100%'
		}).on("change", function (e) {
				$( "#selectPosition" ).closest('.has-error').removeClass('has-error');
					$( "#selectPosition-error" ).remove();
				});
		
		$('#selectPosition').change(function() {
					var slotId	= $(this).val();
			if(slotId == 4){
				$('#image_recommanded').text('Recommended image size is Width 320px * Height 361px, only *.jpg, *.jpeg, *.png, *.gif, *.bmp image formats are supported.');
			}else{
				$('#image_recommanded').text("Recommended image size is Width 994px * Height 90px , only *.jpg, *.jpeg, *.png, *.gif, *.bmp image formats are supported.");
			}
		});
		
		var today= moment.tz("{{Config::get('Constant.DEFAULT_TIME_ZONE')}}").format(DEFAULT_DT_FORMAT+" H:m:s");
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
<script src="{{ url('resources/pages/scripts/advs_validations.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection