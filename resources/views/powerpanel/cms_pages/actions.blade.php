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
		<div class="portlet-body">
			<div class="tabbable tabbable-tabdrop">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
								<div class="portlet-body form_pattern">
									{!! Form::open(['method' => 'post','id'=>'frmCmsPage']) !!}
										<div class="form-body">
										   <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} form-md-line-input">
													{!! Form::text('title', (isset($Cmspage->varTitle)?$Cmspage->varTitle:Input::old('title')), array('maxlength'=>'150','class' => 'form-control input-sm hasAlias seoField maxlength-handler', 'data-url' => 'powerpanel/pages','id' => 'title','placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
													<label class="form_title" for="title">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
													<span style="color: red;">
														{{ $errors->first('title') }}
													</span>
												</div>
												<!-- code for alias -->
												{!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/pages')) !!}
												{!! Form::hidden('alias', isset($Cmspage->alias->varAlias)?$Cmspage->alias->varAlias:Input::old('alias'), array('class' => 'aliasField')) !!}
												{!! Form::hidden('oldAlias', isset($Cmspage->alias->varAlias)?$Cmspage->alias->varAlias:Input::old('alias')) !!}

												 <div class="form-group alias-group {{!isset($Cmspage->alias)?'hide':''}}">
														<label for="Url" class="form_title">{{ trans('template.common.url') }} :</label>
														<a href="javascript:void;" class="alias">{!! url("/") !!}</a>
														@if(isset($Cmspage->alias) && $Cmspage->alias->varAlias!='home')
														<a href="javascript:void(0);" class="editAlias" title="{{ trans('template.common.edit') }}">
														<i class="fa fa-edit"></i></a>
														&nbsp;<a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('/'.$Cmspage->alias->varAlias)}}"><i class="fa fa-external-link" aria-hidden="true"></i></a>
														@elseif(!isset($Cmspage->alias))
														<a href="javascript:void(0);" class="editAlias" title="{{ trans('template.common.edit') }}">
														<i class="fa fa-edit"></i></a>
														&nbsp;<a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('/')}}"><i class="fa fa-external-link" aria-hidden="true"></i></a>
														@endif
														@if(isset($Cmspage->alias) && $Cmspage->alias->varAlias=='home')
														&nbsp;<a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('/')}}"><i class="fa fa-external-link" aria-hidden="true"></i></a>
														@endif
													<span class="help-block">
											   		 {{ $errors->first('alias') }}
										     		</span>
												 </div>

												<!-- code for alias -->

												<div @if(isset($Cmspage->alias->varAlias) && $Cmspage->alias->varAlias=='home') style="display: none;" @endif class="form-group @if($errors->first('module')) has-error @endif">
												<label class="form_title" for="title">{{ trans('template.pageModule.module') }}<span aria-required="true" class="required"> * </span></label>
														<select class="form-control bs-select select2" name="module">
														<option value=" ">--{{ trans('template.common.selectmodule') }}--</option>
																@foreach ($modules as $module)
																@php $permissionName = $module->varModuleName.'-list' @endphp
																@permission($permissionName)
																	<option value="{{ $module['id'] }}" {{ ($module['id'] == (isset($Cmspage->intFKModuleCode)?$Cmspage->intFKModuleCode:''))?'selected':'' }} >{{ $module['varModuleName']== "pages"?'Default Page (CMS)':$module['varTitle'] }}</option>
																@endpermission
															@endforeach
														</select>
														<span class="help-block">
														{{ $errors->first('module') }}
														</span>
												</div>
												<div @if(isset($Cmspage->alias->varAlias) && $Cmspage->alias->varAlias=='home') style="display: none;" @endif class="form-group {{ $errors->has('contents') ? ' has-error' : '' }}">
												<label for="default_page_size" class="form_title">{{ trans('template.common.description') }}</label>
													{!! Form::textarea('contents',(isset($Cmspage->txtDescription)?$Cmspage->txtDescription:Input::old('contents')) , array('class' => 'form-control cms','id'=>'txtDescription')) !!}
												</div>

												<div class="{{ $errors->has('display') ? ' has-error' : '' }} ">
												@php  $form = 'frmCmsPage';  @endphp
												@include('powerpanel.partials.seoInfo',['form'=> 'frmCmsPage','inf'=> isset($metaInfo)?$metaInfo:false])

												@if(isset($Cmspage) && $Cmspage->alias->varAlias == 'home')
												{!! Form::hidden('chrMenuDisplay', 'Y') !!}
												@endif
												@if(isset($publishActionDisplay))
												<div class="row">
													<div class="col-md-6">
													@include('powerpanel.partials.displayInfo',['display' => (isset($Cmspage->chrPublish)?$Cmspage->chrPublish:'Y')])
													</div>
												</div>
												<span style="color: red;">
													{{ $errors->first('display') }}
												</span>
												@endif
												<div class="form-actions">
													<div class="row">
														<div class="col-md-12">
															<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
															 <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
															 <a class="btn red btn-outline" href="{{ url('powerpanel/pages') }}">{{ trans('template.common.cancel') }}</a>
														</div>
													</div>
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
@endsection
@section('scripts')
@include('powerpanel.partials.ckeditor')
<script type="text/javascript">
	window.site_url =  '{!! url("/") !!}';
	var seoFormId = 'frmCmsPage';
	var user_action = "{{ isset($Cmspage)?'edit':'add' }}";
	var moduleAlias = '';
</script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('messages.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/cmspages_validations.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$('select[name=module]').select2({
			placeholder: "Select Module",
			width: '100%'
	}).on("change", function (e) {
		$( "select[name=module]" ).closest('.has-error').removeClass('has-error');
		$( "#module-error" ).remove();
	});
	</script>
@endsection
