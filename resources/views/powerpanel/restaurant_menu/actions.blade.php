@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
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
					<div class="tab-content settings">
						<div class="tab-pane active form_pattern" id="general">
							<div class="row">
								<div class="col-md-12">
									{!! Form::open(['method' => 'post','id'=>'frmRestaurantMenu']) !!}
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
													{!! Form::text('title', isset($restaurant_menu->varTitle)?$restaurant_menu->varTitle:old('title'), array('maxlength' => '150', 'class' => 'form-control hasAlias seoField maxlength-handler', 'data-url' => 'powerpanel/blogs', 'placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
													<label class="form_title" for="site_title">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('title') }}
													</span>
												</div>
											</div>
										</div>
										<!-- code for alias -->
										{!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/blogs')) !!}
										{!! Form::hidden('alias', isset($restaurant_menu->alias->varAlias)?$restaurant_menu->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
										{!! Form::hidden('oldAlias', isset($restaurant_menu->alias->varAlias)?$restaurant_menu->alias->varAlias:old('alias')) !!}
										<div class="form-group alias-group {{!isset($restaurant_menu)?'hide':''}}">
											<label class="form_title" for="{{ trans('template.url') }}">{{ trans('template.common.url') }} :</label>
											<a href="javascript:void;" class="alias">{!! url("/") !!}</a>
											<a href="javascript:void(0);" class="editAlias" title="{{ trans('template.common.edit') }}">
												<i class="fa fa-edit"></i>
												
													<a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('blog/'.(isset($restaurant_menu->alias->varAlias) && isset($restaurant_menu)?$restaurant_menu->alias->varAlias:''))}}">
														<i class="fa fa-external-link" aria-hidden="true"></i>
													</a>
												
											</a>
										</div>
										<span class="help-block">
											{{ $errors->first('alias') }}
										</span>
										<!-- code for alias -->
										<div class="row">
											<div class="col-md-12">
												<div class="form-group @if($errors->first('price')) has-error @endif form-md-line-input">
													{!! Form::text('price', isset($restaurant_menu->intPrice)?$restaurant_menu->intPrice:old('price'), array('maxlength' => '150', 'class' => 'form-control maxlength-handler','placeholder' => trans('template.common.price'),'autocomplete'=>'off')) !!}
													<label class="form_title" for="price">{{ trans('template.common.price') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('price') }}
													</span>
												</div>
											</div>
										</div>
										@permission('restaurant-menu-category-list')										
											@include('powerpanel.partials.category',['categories'=>$RestaurantMenuCategory, 'data'=>isset($restaurant_menu)?$restaurant_menu:null])
										@endpermission										
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
																<a class="media_manager multiple-selection" data-multiple=true onclick="MediaManager.open('blog_image');"><span class="fileinput-new"></span></a>
																<input class="form-control" type="hidden" id="blog_image" name="img_id" value="{{ isset($restaurant_menu->fkIntImgId)?$restaurant_menu->fkIntImgId:old('img_id') }}" />
																<input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
															</div>
														</div>
														<div class="clearfix"></div>
														@if(!empty($restaurant_menu->fkIntImgId) && isset($restaurant_menu->fkIntImgId))
														@php $imageArr = explode(',',$restaurant_menu->fkIntImgId)  @endphp
														<div id="blog_image_img">
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
														<div id="blog_image_img"></div>
														@endif
														@php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{{ trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) }}</span>
													</div>
												</div>
											</div>
										</div>
										
						
										<div class="row">
											<div class="col-md-12">
												<div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
													{!! Form::textarea('short_description', isset($restaurant_menu->txtShortDescription)?$restaurant_menu->txtShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3')) !!}
													<label class="form_title">{{ trans('template.common.shortdescription') }}<span aria-required="true" class="required"> * </span></label>
													<span class="help-block">{{ $errors->first('short_description') }}</span>
												</div>
											</div>
										</div>
									

										<div class="row">
											<div class="col-md-12">
												<div class="form-group @if($errors->first('description')) has-error @endif">
													<label class="form_title">{{ trans('template.common.description') }}</label>
													{!! Form::textarea('description', isset($restaurant_menu->txtDescription)?$restaurant_menu->txtDescription:old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
													<span class="help-block">{{ $errors->first('description') }}</span>
												</div>
											</div>
										</div>

										<h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
										<div class="row">											
											<div class="col-md-6">
												<div class="form-group @if($errors->first('order')) has-error @endif form-md-line-input">
													@php
													 $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
													 if(!isset($restaurant_menu->intDisplayOrder)){
													 $display_order_attributes['readonly'] = "readonly";
													 } 
													@endphp
													{!! Form::text('order',  isset($restaurant_menu->intDisplayOrder)?$restaurant_menu->intDisplayOrder:$total, $display_order_attributes) !!}
													<label class="form_title" for="site_name">{{ trans('template.common.displayorder') }}<span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('order') }}
													</span>
												</div>
											</div>
											<div class="col-md-6">
												@include('powerpanel.partials.displayInfo',['display' => isset($restaurant_menu->chrPublish)?$restaurant_menu->chrPublish:'Y' ])
											</div>
										</div>
										
										<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
										<button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
										<a class="btn btn-outline red" href="{{ url('powerpanel/restaurant-menu') }}">{{ trans('template.common.cancel') }}</a>
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
@include('powerpanel.partials.addCat',['module' => 'restaurant-menu-category','categoryHeirarchy' => $categoryHeirarchy])
@endsection
@section('scripts')
<script src="{{ url('resources/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script type="text/javascript">
	window.site_url =  '{!! url("/") !!}';
	var user_action = "{{ isset($restaurant_menu)?'edit':'add' }}";
	var moduleAlias = 'restaurant-menu';
	var categoryAllowed = false;
	@permission('restaurant-menu-category-list')
	categoryAllowed = true;
	@endpermission
</script>

<script src="{{ url('resources/pages/scripts/restaurant-menu-validations.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
@endsection