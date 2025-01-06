@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('content')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@include('powerpanel.partials.breadcrumbs')
<div class="row">
	<div class="col-md-12">
		@if(Session::has('message'))
		<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
			{{ Session::get('message') }}
		</div>
		@endif
		<div class="portlet light bordered">
			<div class="portlet-body">
				<div class="tabbable tabbable-tabdrop">
					<div class="tab-content settings">
						<div class="tab-pane active form_pattern" id="general">
							{!! Form::open(['method' => 'post','id'=>'frmTeam']) !!}
							<div class="form-group @if($errors->first('name')) has-error @endif form-md-line-input">
								{!! Form::text('name', isset($team->varTitle)?$team->varTitle:old('name'), array('maxlength'=>150, 'class' => 'hasAlias form-control seoField maxlength-handler', 'placeholder' => trans("template.common.name"),'autocomplete'=>'off','data-url' => 'powerpanel/team')) !!}
								<label class="form_title" for="site_name">{{ trans('template.common.name') }} <span aria-required="true" class="required"> * </span></label>
								<span style="color: red;">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							</div>
							<!-- code for alias -->
							{!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/team')) !!}
							{!! Form::hidden('alias', isset($team->alias->varAlias)?$team->alias->varAlias:old('alias') , array('class' => 'aliasField')) !!}
							{!! Form::hidden('oldAlias', isset($team->alias->varAlias)?$team->alias->varAlias:old('alias')) !!}
							<div class="form-group alias-group {{!isset($team->alias->varAlias)?'hide':''}}">
								<label class="form_title" for="Url">{{ trans('template.common.url') }} :</label>
								<a href="javascript:void;" class="alias">{!! url("/") !!}</a>
								<a href="javascript:void(0);" class="editAlias" title="{{ trans('template.common.edit') }}">
									<i class="fa fa-edit"></i>
								</a>
								&nbsp;
								<a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('team/'.isset($team->alias->varAlias) && isset($team) ?$team->alias->varAlias :'' )}}"><i class="fa fa-external-link" aria-hidden="true"></i></a>
								
							</div>
							<span class="help-block">
								<strong>{{ $errors->first('alias') }}</strong>
							</span>
							<!-- code for alias -->
							<div class="form-group @if($errors->first('tag_line')) has-error @endif form-md-line-input">
								{!! Form::text('tag_line', isset($team->varTagLine)?$team->varTagLine:old('tag_line'), array('maxlength'=>100,'placeholder' => trans("template.teamModule.designation"),'class' => 'form-control','autocomplete'=>'off')) !!}
								<label class="form_title" for="site_name">{{ trans('template.teamModule.designation') }}<span aria-required="true" class="required"> * </span></label>
								<span style="color: red;">
									<strong>{{ $errors->first('tag_line') }}</strong>
								</span>
							</div>
							
							<div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }}">
								<div class="image_thumb">
									<label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }}</label>
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-preview thumbnail member_image_img" data-trigger="fileinput" style="width:100%; height:120px;position: relative;">
											@if(Input::old('image_url'))
											<img src="{{ Input::old('image_url') }}" />
											@elseif(isset($team->image))
											<img src="{!! App\Helpers\resize_image::resize($team->image->id,120,120) !!}" />
											@else
											<img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
											@endif
										</div>
										<div class="input-group">
											<a class="media_manager" onclick="MediaManager.open('member_image');"><span class="fileinput-new"></span></a>
											@if(isset($team->image->id))
											@php $imgId = $team->image->id @endphp
											@else
											@php $imgId = ''  @endphp
											@endif
											<input class="form-control" type="hidden" id="member_image" name="img_id" value="{{ $imgId }}" />
											<input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
										</div>
										<div class="overflow_layer">
											<a onclick="MediaManager.open('member_image');" class="media_manager remove_img"><i class="fa fa-pencil"></i></a>
											<a href="javascript:;" class="fileinput-exists remove_img removeimg" data-dismiss="fileinput"><i class="fa fa-trash-o"></i></a>
										</div>
									</div>
									<div class="clearfix"></div>
									@php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{{ trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) }}</span>
									<span style="color: red;">
										<strong>{{ $errors->first('img_id') }}</strong>
									</span>
									
								</div>
							</div>
							<div class="form-group @if($errors->first('description')) has-error @endif">
								<label class="form_title">{{ trans('template.common.description') }}</label>
								{!! Form::textarea('description', isset($team->txtDescription)?$team->txtDescription:old('description'), array('maxlength'=>400,'placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
								<span style="color: red;">{{ $errors->first('description') }}</span>
							</div>
							<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} form-md-line-input">
								{!! Form::text('email',isset($team->varEmail)?$team->varEmail:old('email'), array('class' => 'form-control input-sm', 'maxlength'=>'300','id' => 'email','placeholder' => trans('template.common.email'),'autocomplete'=>'off')) !!}
								<label class="form_title" for="email">{{ trans('template.common.email') }} <span aria-required="true" class="required"> * </span></label>
								<span style="color: red;">
									{{ $errors->first('email') }}
								</span>
							</div>
							<div class="form-group {{ $errors->has('phone_no') ? 'has-error' : '' }} form-md-line-input">
								{!! Form::tel('phone_no',isset($team->varPhoneNo)?$team->varPhoneNo:old('phone_no'), array('class' => 'form-control input-sm','id' => 'phone_no','placeholder' => trans('template.common.phoneno'),'autocomplete'=>'off', 'onkeypress'=>'javascript: return KeycheckOnlyPhonenumber(event);')) !!}
								<label class="form_title" for="phone_no">{{ trans('template.common.phoneno') }} <span aria-required="true" class="required"> * </span></label>
								<span style="color: red;">
									{{ $errors->first('phone_no') }}
								</span>
							</div>
							<div class="form-group form-md-line-input">
								{!! Form::textarea('address',isset($team->textAddress)?$team->textAddress:old('address'), array('class' => 'form-control','id'=>'address','rows'=>'3','placeholder'=>trans('template.common.address'),'styel'=>'max-height:80px;')) !!}
								<label class="form_title" for="address">{{ trans('template.common.address') }}</label>
							</div>

							@if(!empty($teamSocialLinksOptions))
							@if(isset($team->txtSocialLinks))
								@php	$socialLinks = unserialize($team->txtSocialLinks) @endphp
							@endif
									@foreach($teamSocialLinksOptions as $value)
											@php 
												$linkKey = $value['key'];
												$linkLabel = $value['label'];
												$linkPlaceholder = $value['placeholder'];
											@endphp
											@if(isset($team->txtSocialLinks))
														@php $selectedValue = isset($socialLinks[$linkKey])?$socialLinks[$linkKey]:''; @endphp
											@endif
											@if($linkKey!="" && $linkLabel!="")
											<div class="form-group @if($errors->first($linkKey)) has-error @endif form-md-line-input">
												{!! Form::text($linkKey, isset($selectedValue)?$selectedValue:old($linkKey), array('class' => 'form-control','autocomplete'=>'off','placeholder' => $linkPlaceholder,'id'=>$linkKey)) !!}
												<label class="form_title" for="site_name">{{ $linkLabel }}</label>
												<span style="color: red;">
													<strong>{{ $errors->first($linkKey) }}</strong>
												</span>
											</div>
											@endif
									@endforeach
							@endif
														
							@include('powerpanel.partials.seoInfo',['form'=>'frmTeam','inf'=>isset($metaInfo)?$metaInfo:false])
							
							<h3>{{ trans('template.common.displayinformation') }}</h3>
							<div class="row">
								<div class="col-md-6">
									@php
										$display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
										if(!isset($team->intDisplayOrder)){
												$display_order_attributes['readonly'] = "readonly";
										} 
									@endphp
									<div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
										{!! Form::text('display_order', isset($team->intDisplayOrder)?$team->intDisplayOrder:$total, $display_order_attributes) !!}
										<label class="form_title" class="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
										<span style="color: red;">
											<strong>{{ $errors->first('display_order') }}</strong>
										</span>
									</div>
								</div>
								<div class="col-md-6">
									@include('powerpanel.partials.displayInfo',['display' => isset($team->chrPublish)?$team->chrPublish:null])
								</div>
							</div>
							<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
							<button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
							<a class="btn btn-outline red" href="{{ url('powerpanel/team') }}">{{ trans('template.common.cancel') }}</a>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')

<script src="{{ url('resources/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/form-input-mask.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script type="text/javascript">
	window.site_url =  '{!! url("/") !!}';	
	var seoFormId = 'frmTeam';
	var user_action = "{{ isset($team)?'edit':'add' }}";
	var moduleAlias = 'team';
</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/team_validations.js') }}" type="text/javascript"></script>
@endsection