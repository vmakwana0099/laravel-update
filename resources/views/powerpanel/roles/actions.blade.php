@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ asset('assets/global/plugins/menu-loader/style.css') }}" rel="stylesheet" type="text/css"/>
<style type="text/css">
	.loading {
		height:20px;
		padding:0 0 0 0;
		position:relative;
		top:-5px;
		left:-15px;
	}
</style>
@endsection
@section('content')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@include('powerpanel.partials.breadcrumbs')
	<!-- @if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif -->
<div class="col-md-12 settings">
	@if(isset($role))
		{!! Form::model($role, ['id'=>'frmRole','method' => 'PATCH','route' => ['powerpanel.roles.update', $role->id]]) !!}
	@else
		{!! Form::open(array('route' => 'powerpanel.roles.add','method'=>'POST','id'=>'frmRole')) !!}
	@endif
	<div class="row">
		@if(Session::has('message'))
			<div class="alert alert-success">
				<button class="close" data-close="alert"></button>
				{{ Session::get('message') }}
			</div>
		@endif
		<div class="portlet light bordered">
			<div class="portlet-body form_pattern">
				<div class="tabbable tabbable-tabdrop">
					<div class="tab-content settings">
						<div class="form-body">
							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} form-md-line-input">
								{!! Form::text('name', null, array('maxlength'=>'150','class' => 'form-control','placeholder' => trans('template.common.name'),'autocomplete'=>'off')) !!}
								<label class="form_title" for="name">{{ trans('template.common.name') }}  <span aria-required="true" class="required"> * </span></label>
								<span style="color: red;">
									{{ $errors->first('name') }}
								</span>
							</div>							
							<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }} form-md-line-input">
								{!! Form::textarea('description', null, array('maxlength'=>'400','placeholder' => 'Description','class' => 'form-control','style'=>'height:100px','placeholder'=>trans('template.common.description'))) !!}
								<span style="color: red;">
									{{ $errors->first('description') }}
								</span>
								<label class="form_title" for="description"> {{ trans('template.common.description') }} </label>
							</div>

							@if(isset($role))
							<div class="form-group {{ $errors->has('permission') ? ' has-error' : '' }} ">
								<label class="form_title" for="permission">{{ trans('template.common.permission') }}  <span aria-required="true" class="required"> * </span></label>
								<div class="clearfix" style="height:5px;"></div>
								<div class="row">
									<div class="col-md-12">
											<div class="row">
											@foreach($permission as $key => $permissions)
												@php $permit=[]; $moduleOn=[]; @endphp
												@foreach($permissions as $pval)
													@if(Entrust::can($pval['name']) || Entrust::hasRole('netquick_admin'))
														@php
															array_push($permit, $pval['name']);
															if(in_array($pval['id'], $rolePermissions)){
																array_push($moduleOn, $pval['name']);
															}
														@endphp
													@endif
												@endforeach
													@if(count($permit)>0)
														<div class="col-md-4">
															<div class="permissions_list">
															<label class="form_title">
															<span class="checked_off_on activation">
																<input type="checkbox" name="active" id="active" class="make-switch switch-large module-activation" data-label-icon="fa fa-fullscreen"  data-on-text="Active" data-off-text="In active" {{ (count($moduleOn) > 0)?'checked' : '' }}>
														 	</span>
															{{$key}}</label>
															<span class="right_permis">
															@foreach($permissions as $value)
																	@if(Entrust::can($value['name']) || Entrust::hasRole('netquick_admin'))
																	<span class="md-checkbox {{$value['display_name']}} menu_active">
																		<input id="per-{{$value['id']}}" style="opacity:0" value="{{$value['id']}}" name="permission[{{$value['id']}}]" class="md-check" type="checkbox" {{in_array($value['id'], $rolePermissions) ? 'checked' : ''}}>
																		<label for="per-{{$value['id']}}">
																			<span class="inc"></span>
																			<span class="check tooltips" data-toggle="tooltip" data-placement="top" data-original-title="Revoke {{ucwords(str_replace('-',' ', $value['description']))}}"></span>
																			<span class="box tooltips" data-toggle="tooltip" data-placement="top" data-original-title="Grant {{ucwords(str_replace('-',' ', $value['description']))}}"></span>
																		</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	@endif
																@endforeach
															</span>
														</div>
														</div>
													@endif
												@endforeach
											</div>

										</div>
									</div>
									<span style="color: red;">
										{{ $errors->first('permission') }}
									</span>
								</div>
							@else
							<div class="form-group {{ $errors->has('permission') ? ' has-error' : '' }} ">
								<label class="form_title" for="permission">{{ trans('template.common.permission') }}  <span aria-required="true" class="required"> * </span></label>
								<div class="clearfix" style="height:5px;"></div>
								<div class="row">
									<div class="col-md-12">
											<div class="row">
											@foreach($permission as $key => $permissions)
												@php $permit=[]; @endphp
												@foreach($permissions as $pval)
													@if(Entrust::can($pval['name']) || Entrust::hasRole('netquick_admin'))
														@php
															array_push($permit, $pval['name']);
														@endphp
													@endif
												@endforeach
													@if(count($permit)>0)
														<div class="col-md-4">
															<div class="permissions_list">
															<label class="form_title">
															<span class="checked_off_on activation">
																<input type="checkbox" name="active" id="active" class="make-switch switch-large module-activation" data-label-icon="fa fa-fullscreen"  data-on-text="Active" data-off-text="In active">
														 	</span>
															{{$key}}</label>
															<span class="right_permis">
															@foreach($permissions as $value)
																	@if(Entrust::can($value['name']) || Entrust::hasRole('netquick_admin'))
																	<span class="md-checkbox {{$value['display_name']}} menu_active">
																		<input id="per-{{$value['id']}}" style="opacity:0" value="{{$value['id']}}" name="permission[{{$value['id']}}]" class="md-check" type="checkbox">
																		<label for="per-{{$value['id']}}">
																			<span class="inc"></span>
																			<span class="check tooltips" data-toggle="tooltip" data-placement="top" data-original-title="Revoke {{ucwords(str_replace('-',' ', $value['description']))}}"></span>
																			<span class="box tooltips" data-toggle="tooltip" data-placement="top" data-original-title="Grant {{ucwords(str_replace('-',' ', $value['description']))}}"></span>
																		</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	@endif
																@endforeach
															</span>
														</div>
														</div>
													@endif
												@endforeach
											</div>

										</div>
									</div>
									<span style="color: red;">
										{{ $errors->first('permission') }}
									</span>
								</div>
							@endif
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-12">
									<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
									<button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit"> {!! trans('template.common.saveandexit') !!}</button>
									<a class="btn btn-outline red" href="{{url('powerpanel/roles')}}">{{ trans('template.common.cancel') }}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
</div>
<div class="clearfix"></div>
@endsection
@section('scripts')
<script type="text/javascript">var rootUrl="{{ URL::to('/') }}"; var moduleAlias="";</script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/menu-loader/jquery-loader.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/role_validations.js') }}" type="text/javascript"></script>
@endsection
