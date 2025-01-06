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
									{!! Form::open(['method' => 'post','id'=>'frmBlog']) !!}
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
													{!! Form::text('title', isset($blog->varTitle)?$blog->varTitle:old('title'), array('maxlength' => '150', 'class' => 'form-control hasAlias seoField maxlength-handler', 'data-url' => 'powerpanel/blogs', 'placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
													<label class="form_title" for="site_title">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('title') }}
													</span>
												</div>
											</div>
										</div>
										<!-- code for alias -->
										{!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/blogs')) !!}
										{!! Form::hidden('alias', isset($blog->alias->varAlias)?$blog->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
										{!! Form::hidden('oldAlias', isset($blog->alias->varAlias)?$blog->alias->varAlias:old('alias')) !!}
										<div class="form-group alias-group {{!isset($blog)?'hide':''}}">
											<label class="form_title" for="{{ trans('template.url') }}">{{ trans('template.common.url') }} :</label>
											<a href="javascript:void;" class="alias">{!! url("/") !!}</a>
											<a href="javascript:void(0);" class="editAlias" title="{{ trans('template.common.edit') }}">
												<i class="fa fa-edit"></i>
												
													<a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('blog/'.(isset($blog->alias->varAlias) && isset($blog)?$blog->alias->varAlias:''))}}">
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
												<div class="form-group @if($errors->first('author')) has-error @endif form-md-line-input">
													{!! Form::text('author', isset($blog->varAuthor)?$blog->varAuthor:old('author'), array('maxlength' => '150', 'class' => 'form-control maxlength-handler','placeholder' => trans('template.common.author'),'autocomplete'=>'off')) !!}
													<label class="form_title" for="author">{{ trans('template.common.author') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('author') }}
													</span>
												</div>
											</div>
										</div>
										@permission('blog-category-list')
											@include('powerpanel.partials.category',['categories'=>$BlogCategory, 'data'=>isset($blog)?$blog:null])
										@endpermission
										<div class="row">
											<div class="col-md-12">
												<div class="form-group hide @if($errors->first('external_link')) has-error @endif form-md-line-input">
													{!! Form::text('external_link', isset($blog->varExternalLink)?$blog->varExternalLink:old('external_link'), array('maxlength' => '150', 'class' => 'form-control','placeholder' => $errors->first('external_link'))) !!}
													<label class="form_title" for="site_external_link">{{ $errors->first('external_link') }}</label>
													<span class="help-block">
														{{ $errors->first('external_link') }}
													</span>
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
																<a class="media_manager multiple-selection" data-multiple=true onclick="MediaManager.open('blog_image');"><span class="fileinput-new"></span></a>
																<input class="form-control" type="hidden" id="blog_image" name="img_id" value="{{ isset($blog->fkIntImgId)?$blog->fkIntImgId:old('img_id') }}" />
																<input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
															</div>
														</div>
														<div class="clearfix"></div>
														@if(!empty($blog->fkIntImgId) && isset($blog->fkIntImgId))
														@php $imageArr = explode(',',$blog->fkIntImgId)  @endphp
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

												<!-- start Media Type -->
						<div class="row viduploader">
				<div class="col-md-12">
					<div class="image_thumb">
						<div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }} ">
							<label class="form_title" for="front_logo">{{ trans('template.blogModule.selectVideo') }}</label>
							<div class="clearfix"></div>
							<div class="fileinput fileinput-new videoUploadImg" data-provides="fileinput">
								<div class="fileinput-preview thumbnail blog_video_vid" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
									@if(Input::old('video_url'))
									<img src="{{ Input::old('video_url') }}" />
									@else
									<img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" />
									@endif
								</div>
								<div class="input-group"> <a class="video_manager" onclick="MediaManager.openVideoManager('blog_video');"><span class="fileinput-new"></span></a> </div>
								@if(!empty($blog->video->varVideoName))
								<input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ $blog->video->varVideoName }}.{{ $blog->video->varVideoExtension }}" />
								@else
								<input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ isset($blog->video->varVideoName)?$blog->video->varVideoName:'' }}" />
								@endif
								<input class="form-control" type="hidden" id="blog_video" name="video_id" value="{{ isset($blog->fkIntVideoId)?$blog->fkIntVideoId:old('video_id') }}" />
							</div>
						</div>
						<div class="clearfix"></div>
						<span>({{ trans('template.blogModule.videoRecommendation') }}.)</span> <span style="color: red;"> {{ $errors->first('video_id') }}</span> </div>
					</div>
				</div>
						<!--  End Media Type -->
						
										<div class="row">
											<div class="col-md-12">
												<div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
													{!! Form::textarea('short_description', isset($blog->txtShortDescription)?$blog->txtShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3')) !!}
													<label class="form_title">{{ trans('template.common.shortdescription') }}<span aria-required="true" class="required"> * </span></label>
													<span class="help-block">{{ $errors->first('short_description') }}</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group form-md-line-input">
													@php $defaultDt = (null !== old('start_date'))?old('start_date'):date('Y-m-d g:i A'); @endphp
													<div class="input-group date form_meridian_datetime @if($errors->first('start_date')) has-error @endif" data-date="{{ date('Y-m-d H:i:s',strtotime(isset($blog->dtStartDateTime)?$blog->dtStartDateTime:$defaultDt)) }}">
														<span class="input-group-btn date_default">
															<button class="btn date-set" type="button">
															<i class="fa fa-calendar"></i>
															</button>
														</span>
														{!! Form::text('start_date', date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime(isset($blog->dtStartDateTime)?$blog->dtStartDateTime:$defaultDt)), array('class' => 'form-control','maxlength'=>100,'size'=>'100','readonly'=>true)) !!}
														<label class="control-label form_title">{{ trans('template.publisdateandtime') }} <span aria-required="true" class="required"> * </span></label>
													</div>
													<span class="help-block">{{ $errors->first('start_date') }}</span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group @if($errors->first('description')) has-error @endif">
													<label class="form_title">{{ trans('template.common.description') }}</label>
													{!! Form::textarea('description', isset($blog->txtDescription)?$blog->txtDescription:old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
													<span class="help-block">{{ $errors->first('description') }}</span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													@if ( (isset($blog->varFeaturedBlog) && $blog->varFeaturedBlog == 'N') || Input::old('featuredBlog')=='N' || (!isset($blog->varFeaturedBlog) && Input::old('featuredBlog')==null))
														@php  $featured_checked_no = 'checked'  @endphp
													@else
														@php  $featured_checked_no = ''  @endphp
													@endif
													@if (isset($blog->varFeaturedBlog) && $blog->varFeaturedBlog == 'Y' || (Input::old('featuredBlog') == 'Y'))
														@php  $featured_checked_yes = 'checked'  @endphp
													@else
														@php  $featured_checked_yes = ''  @endphp
													@endif
													<label class="control-label form_title">{{ trans('template.blogModule.isfeaturedblog') }}?</label>
													<div class="md-radio-inline">
														<div class="md-radio">
															<input class="md-radiobtn" type="radio" value="Y" name="featuredBlog" id="featuredBlogY" {{ $featured_checked_yes }}>
															<label for="featuredBlogY"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.yes') }} </label>
														</div>
														<div class="md-radio">
															<input class="md-radiobtn" type="radio" value="N" name="featuredBlog" id="featuredBlogN" {{ $featured_checked_no }}/>
															<label for="featuredBlogN"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.no') }} </label>
														</div>
													</div>
													<div class="clearfix"></div>
													<span>{{ trans('template.common.note') }}: {{ trans('template.blogModule.featuredblognote') }}*</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="nopadding">													
													@include('powerpanel.partials.seoInfo',['form'=>'frmBlog','inf'=>isset($metaInfo)?$metaInfo:false])
												</div>
											</div>
										</div>
										
										<h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
										<div class="row">											
											<div class="col-md-6">
											@php
												$display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
												if(!isset($blog->intDisplayOrder)){
														$display_order_attributes['readonly'] = "readonly";
												} 
											@endphp
												<div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
													{!! Form::text('display_order',  isset($blog->intDisplayOrder)?$blog->intDisplayOrder:$total, $display_order_attributes) !!}
													<label class="form_title" for="site_name">{{ trans('template.common.displayorder') }}<span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('display_order') }}
													</span>
												</div>
											</div>
											<div class="col-md-6">
												@include('powerpanel.partials.displayInfo',['display' => isset($blog->chrPublish)?$blog->chrPublish:'Y' ])
											</div>
										</div>
										
										<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
										<button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
										<a class="btn btn-outline red" href="{{ url('powerpanel/blogs') }}">{{ trans('template.common.cancel') }}</a>
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
@include('powerpanel.partials.addCat',['module' => 'blog-category','categoryHeirarchy' => $categoryHeirarchy])
@endsection
@section('scripts')
<script src="{{ url('resources/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script type="text/javascript">
	window.site_url =  '{!! url("/") !!}';	
	var seoFormId = 'frmBlog';
	var user_action = "{{ isset($blog)?'edit':'add' }}";
	var moduleAlias = 'blogs';
	var categoryAllowed = false;
	@permission('blog-category-list')
	categoryAllowed = true;
		@endpermission
</script>
<script src="{{ url('resources/pages/scripts/blog_validations.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/moment.min.js') }}"></script>
<script src="{{ url('resources/global/plugins/moments-timezone.js') }}"></script>

<script type="text/javascript">
var today= moment.tz("{{Config::get('Constant.DEFAULT_TIME_ZONE')}}").format(DEFAULT_DT_FORMAT+" H:m:s");
$('input[name=start_date]').datetimepicker({
    autoclose: true,
    startDate: today,
    showMeridian: true,
    minuteStep: 5,
    format: DEFAULT_DT_FMT_FOR_DATEPICKER+' HH:ii P'
}).on("changeDate", function(e) {
    $("input[name=start_date]").closest('.has-error').removeClass('has-error');
    $("#start_date_time-error").remove();
});

$(document).on('click', '.date-set,input[name=start_date]', function(){
	$('input[name=start_date]').datetimepicker('show');
});
</script>
@endsection