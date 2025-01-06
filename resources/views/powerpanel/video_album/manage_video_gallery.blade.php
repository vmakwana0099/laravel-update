@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/css/photo-gallery.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@stop
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
		<div class="portlet light bordered">
			<div class="portlet-body">
				<div class="tabbable tabbable-tabdrop">
					<div class="tab-content">
						<div class="row">
							<div class="col-md-12">
								<div class="tab-pane active" id="general">
									<div class="portlet-body form_pattern">
										<form method="POST" id="frmVideoGallery" action="{{url('powerpanel/video-gallery/add')}}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="form-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
															{!! Form::text('title', null, array('maxlength' => 150, 'class' => 'form-control seoField maxlength-handler','data-url' => 'powerpanel/video-album','placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
															<label class="form_title" for="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
															<span class="help-block">
																<strong>{{ $errors->first('title') }}</strong>
															</span>
														</div>
													</div>
												</div>
												@permission('video-album-list')
												
												<div class="row">
													<div class="col-md-12">
														<div class="form-group @if($errors->first('album_id')) has-error @endif">
															<label class="form_title" for="album_id">{{ trans('template.common.selectAlbum') }}</label>
															<br>
															<select class="form-control bs-select select2" name="album_id">
																@if(count($videoAlbumObj)>0)
																<option value=NULL>--- {{ trans('template.common.pleaseSelectAlbum') }} ---</option>
																@foreach($videoAlbumObj as $category)
																@php
																@endphp
																	<option data-alias="{{ $category['id'] }}" {{ (app('request')->input('album')==$category['id'] )?'selected':'' }} value="{{ $category['id'] }}" >{{ $category['varTitle'] }}</option>
																@endforeach
																@else
																	<option value=" ">{{ trans('template.common.pleaseAddVideoAlbum') }}</option>
																@endif
															</select>
															<span class="help-block">
																{{ $errors->first('album_id') }}
															</span>
														</div>
													</div>
												</div>
												@endpermission
												<div class="row">
													<div class="col-md-12">
														<div class="image_thumb">
															<div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }} ">
																<label class="form_title" for="front_logo">{{ trans('template.common.selectVideo') }} <span aria-required="true" class="required"> * </span></label>
																<div class="clearfix"></div>
																<div class="fileinput fileinput-new" data-provides="fileinput">
																	<div class="fileinput-preview thumbnail video_gallery_img" data-trigger="fileinput" style="border:1px solid rgb(221, 221, 221)">
																		@if(Input::old('video_url'))
																		<img src="{{ Input::old('video_url') }}" />
																		@else
																		<img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
																		@endif
																	</div>
																	<div class="input-group">
																		<a class="video_manager" onclick="MediaManager.openVideoManager('video_gallery');"><span class="fileinput-new"></span></a>
																	</div>
																	<input class="form-control" disabled="disabled" type="text" id="video_name" value="" />
																	<input class="form-control" type="hidden" id="video_gallery" name="video_id" value="{{ Input::old('video_id') }}" />
																	<input class="form-control" type="hidden" id="image_url" name="video_url" value="{{ Input::old('video_url') }}" />
																</div>
															</div>
															<div class="clearfix"></div>
															<span>({{ trans('template.videoGalleryModule.videoRecomandation') }}.)</span>
															<span style="color: red;">
																<strong>{{ $errors->first('img_id') }}</strong>
															</span>
														</div>
													</div>
												</div>
												<h3>{{ trans('template.common.displayinformation') }}</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
															{!! Form::text('display_order', $display_order, array('class' => 'form-control edited','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'))) !!}
															<label class="form_title" class="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
															<span class="help-block">
																<strong>{{ $errors->first('display_order') }}</strong>
															</span>
														</div>
													</div>
													<div class="col-md-6">
														@include('powerpanel.partials.displayInfo')
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-12">
														<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{{ trans('template.common.save') }}</button>
														<a class="btn btn-outline red" href="{{ url('powerpanel/video-album') }}">{{ trans('template.common.cancel') }}</a>
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
					@permission('video-album-list')
						<div class="row">
						<div class="col-md-12 col-sm-12"><br/>
						<div class="select_box service_select_box">
							<label class="form_title">{{ trans('template.common.albumFilter') }}: </label>&nbsp;
							<select class="form-control bs-select select2 bs-select" name="albumfilter">
							<option value=" ">{{ trans('template.common.filterByAlbum') }}</option>
								@if(count($videoAlbumObj)>0)
								@foreach($videoAlbumObj as $category)
									<option data-alias="{{$category['id'] }}" {{ (app('request')->input('album')==$category['id'] )?'selected':'' }} value="{{ $category['id'] }}" >{{ $category['varTitle'] }}</option>
								@endforeach
								@endif
							</select>
							</div>
						</div>
						</div>
					@endpermission
					<div class="posts">
						@include('powerpanel.video_album.video_gallery')
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('scripts')
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
	</script>
	<script type="text/javascript">
			$('select[name=albumfilter]').change( function () {
			if($(this).find('option:selected').data('alias') == undefined){
				window.location="{{url('powerpanel/video-gallery')}}";	
			}else{
				window.location="{{url('powerpanel/video-gallery?album=')}}"+$(this).find('option:selected').data('alias');
			}	
		});
	</script>
	<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
	<!-- BEGIN CORE PLUGINS -->
	<script src="{{ url('resources/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/video_gallery_validations.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/fancybox/source/helpers/jquery.fancybox-media.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/video_gallery.js') }}" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	@endsection