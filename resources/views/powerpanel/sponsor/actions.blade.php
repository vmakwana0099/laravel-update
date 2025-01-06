@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection
@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection

@section('content')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@include('powerpanel.partials.breadcrumbs')
<div class="col-md-12 settings">
@if(Session::has('message'))
<div class="alert alert-success">
<button class="close" data-close="alert"></button>
{{ Session::get('message') }}
</div>
@endif
<div class="row">
<div class="portlet light bordered">
<div class="portlet-body form_pattern">
<div class="tabbable tabbable-tabdrop">
<div class="tab-content row">
	<div class="col-md-12">
		<div class="portlet-body">
		
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
			{!! Form::open(['method' => 'post','id'=>'frmSponsor']) !!}
				<div class="form-body">
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} form-md-line-input">
						{!! Form::text('name',isset($sponsors->varTitle)?$sponsors->varTitle:old('name'),array('class' => 'form-control input-sm seoField maxlength-handler','maxlength'=>'150','id' => 'name','placeholder' => trans('template.common.name'))) !!}
						<label class="form_title" for="name">{{ trans('template.common.name') }}  <span aria-required="true" class="required"> * </span></label>
						<span style="color: red;">
							{{ $errors->first('name') }}		
						</span>
					</div>
					@permission('sponsor-category-list')											
						@include('powerpanel.partials.category',['categories'=>$SponsorCategory, 'data'=>isset($sponsors)?$sponsors:null])
					@endpermission
					<div class="form-group {{ $errors->has('image_upload') ? ' has-error' : '' }}">
						<div class="image_thumb">
							<label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }} <span aria-required="true" class="required"> * </span></label>
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-preview thumbnail sponsor_image_img" data-trigger="fileinput" style="width:100%; height:120px;position: relative;">
										@if(Input::old('image_url')) 
											<img src="{{ Input::old('image_url') }}" />
										@elseif(isset($sponsors->fkIntImgId) && !empty($sponsors->fkIntImgId))
											<img  src="{!! App\Helpers\resize_image::resize($sponsors->fkIntImgId) !!}" />
										@else
											<img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
										@endif
									</div>    
									<div class="input-group">     
										<a class="media_manager" onclick="MediaManager.open('sponsor_image');"><span class="fileinput-new"></span></a>
										<input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />	
									</div>
									<input class="form-control" type="hidden" id="sponsor_image" name="image_upload" value="{{ isset($sponsors->fkIntImgId)?$sponsors->fkIntImgId:old('image_upload') }}" />
								</div>
								<div class="clearfix"></div>
								@php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{{ trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) }}</span>
								<span style="color: red;">
								  <strong>{{ $errors->first('image_upload') }}</strong>
								</span>
							</div>
						</div>
						<div class="form-group @if($errors->first('link')) has-error @endif form-md-line-input">
						{!! Form::text('link',isset($sponsors->varExternalLink)?$sponsors->varExternalLink:old('link'),array('class' => 'form-control input-sm','maxlength'=>'150','id' => 'link','placeholder' => trans('template.common.link'))) !!}
						<label class="form_title" for="link">{{ trans('template.common.link') }}<span aria-required="true" class="required"> * </span></label>
						<span style="color: red;">
                         <strong>{{ $errors->first('link') }}</strong>
                        </span>
					</div>	
					<h3>{{ trans('template.common.displayinformation') }}</h3>	
					<div class="row">									
					<div class="col-md-6">
					@php
						$display_order_attributes = array('class' => 'form-control edited','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
						if(!isset($sponsors->intDisplayOrder)){
								$display_order_attributes['readonly'] = "readonly";
						} 
					@endphp
					<div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
						{!! Form::text('display_order',isset($sponsors->intDisplayOrder)?$sponsors->intDisplayOrder:$total, $display_order_attributes) !!}
						<label class="form_title" for="display_order">{{ trans('template.common.displayorder') }}<span aria-required="true" class="required"> * </span></label>
						<span class="help-block">
							<strong>{{ $errors->first('display_order') }}</strong>
						</span>
					</div>
				</div>
				 <div class="col-md-6">
						@include('powerpanel.partials.displayInfo',['display' => isset($sponsors->chrPublish)?$sponsors->chrPublish:null])
					</div>
				</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-12">
							<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
							<button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
							<a class="btn btn-outline red" href="{{ url('powerpanel/sponsor') }}">{{ trans('template.common.cancel') }}</a>	
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
@include('powerpanel.partials.addCat',['module' => 'sponsor-category','categoryHeirarchy' => $categoryHeirarchy])
@endsection
@section('scripts')
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	window.site_url =  '{!! url("/") !!}'; 
	var moduleAlias = 'sponsors'; 
	var user_action = "{{ isset($sponsors)?'edit':'add' }}";	</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/sponsor_validations.js') }}" type="text/javascript"></script>
@endsection   