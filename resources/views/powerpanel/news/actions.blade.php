@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
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
                                        {!! Form::open(['method' => 'post','id'=>'frmNews']) !!}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                                                        {!! Form::text('title', isset($news->varTitle)?$news->varTitle:old('title'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','placeholder' => trans('template.common.title'),'data-url' => 'powerpanel/news')) !!}
                                                        <label class="form_title" for="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('title') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- code for alias -->
                                            {!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/news')) !!}
                                            {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                                            {!! Form::hidden('alias', isset($news->alias->varAlias)?$news->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
                                            {!! Form::hidden('oldAlias', isset($news->alias->varAlias)?$news->alias->varAlias:old('alias')) !!}
                                            <div class="form-group alias-group {{!isset($news)?'hide':''}} ">
                                                <label class="form_title" for="{{ trans('template.url') }}">{{ trans('template.common.url') }} :</label>
                                                <a href="javascript:void;" class="alias">{!! url("/") !!}</a>
                                                <a href="javascript:void(0);" class="editAlias" title="{{ trans('template.common.edit') }}">
                                                    <i class="fa fa-edit"></i>

                                                    <a class="without_bg_icon openLink" title="Open Link" target="_blank" href="{{url('news/'.(isset($news->alias->varAlias) && isset($news)?$news->alias->varAlias:''))}}">
                                                        <i class="fa fa-external-link" aria-hidden="true"></i>
                                                    </a>

                                                </a>
                                            </div>
                                            <span class="help-block">
                                                {{ $errors->first('alias') }}
                                            </span>
                                            <!-- code for alias -->
                                            <!--											@permission('news-category-list')											
                                                                                                                                            @include('powerpanel.partials.category',['categories'=>$NewsCategory, 'data'=>isset($news)?$news:null])
                                                                                                                                    @endpermission-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group form-md-line-input">
                                                        @php $defaultDt = (null !== old('start_date'))?old('start_date'):date('Y-m-d g:i A'); @endphp
                                                        <div class="input-group date @if($errors->first('start_date')) has-error @endif" data-date="{{ date('Y-m-d H:i:s',strtotime(isset($news->dtDateTime)?$news->dtDateTime:$defaultDt)) }}">
                                                            <span class="input-group-btn date_default">
                                                                <button class="btn date-set" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                            {!! Form::text('start_date', date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime(isset($news->dtDateTime)?$news->dtDateTime:$defaultDt)), array('class' => 'form-control','maxlength'=>100,'size'=>'100','readonly'=>true)) !!}
                                                            <label class="control-label form_title">{{ trans('template.dateandtime') }} <span aria-required="true" class="required"> * </span></label>
                                                        </div>
                                                        <span class="help-block">{{ $errors->first('start_date') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }}">
								<div class="image_thumb">
									<label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }}</label>
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-preview thumbnail member_image_img" data-trigger="fileinput" style="width:100%; height:120px;position: relative;">
											@if(Input::old('image_url'))
											<img src="{{ Input::old('image_url') }}" />
											@elseif(isset($news->image))
											<img src="{!! App\Helpers\resize_image::resize($news->image->id,120,120) !!}" />
											@else
											<img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
											@endif
										</div>
										<div class="input-group">
											<a class="media_manager" onclick="MediaManager.open('member_image');"><span class="fileinput-new"></span></a>
											@if(isset($news->image->id))
											@php $imgId = $news->image->id @endphp
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
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('short_description', isset($news->varShortDescription)?$news->varShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3')) !!}
                                                        <label class="form_title">{{ trans('template.common.shortdescription') }}<span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">{{ $errors->first('short_description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('description')) has-error @endif">
                                                        <label class="form_title">{{ trans('template.common.description') }}</label>
                                                        {!! Form::textarea('description', isset($news->txtDescription)?$news->txtDescription:old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
                                                        <span class="help-block">{{ $errors->first('description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="nopadding">
                                                        @include('powerpanel.partials.seoInfo_custom',['form'=>'frmNews','inf'=>isset($metaInfo)?$metaInfo:false])
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @php
                                                    $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                                    if(!isset($news->intDisplayOrder)){
                                                    $display_order_attributes['readonly'] = "readonly";
                                                    } 
                                                    @endphp
                                                    <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                                                        {!! Form::text('display_order',  isset($news->intDisplayOrder)?$news->intDisplayOrder:$total, $display_order_attributes) !!}
                                                        <label class="form_title" for="site_name">{{ trans('template.common.displayorder') }}<span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('display_order') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @include('powerpanel.partials.displayInfo',['display' => isset($news->chrPublish)?$news->chrPublish:null ])
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                                    <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                                    <a class="btn btn-outline red" href="{{ url('powerpanel/news') }}">{{ trans('template.common.cancel') }}</a>
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
@include('powerpanel.partials.addCat',['module' => 'news-category','categoryHeirarchy' => $categoryHeirarchy])
@endsection
@section('scripts')
<script type="text/javascript">
                    window.site_url = '{!! url("/") !!}';
                    var seoFormId = 'frmNews';
                    var user_action = "{{ isset($news)?'edit':'add' }}";
                    var moduleAlias = 'news';
                    var categoryAllowed = false;
                    @permission('news-category-list')
                    categoryAllowed = true;
                    @endpermission
</script>
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="{{ url('resources/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ url('resources/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/news_validations.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/moment.min.js') }}"></script>
<script src="{{ url('resources/global/plugins/moments-timezone.js') }}"></script>

<script type="text/javascript">
                    var today = moment.tz("{{Config::get('Constant.DEFAULT_TIME_ZONE')}}").format(DEFAULT_DT_FORMAT + " H:m:s");
                    $('input[name=start_date]').datetimepicker({
            autoclose: true,
                    showMeridian: true,
                    minuteStep: 5,
                    format:DEFAULT_DT_FMT_FOR_DATEPICKER + ' HH:ii P'
            }).on("changeDate", function (e) {
            $("input[name=start_date]").closest('.has-error').removeClass('has-error');
                    $("#start_date_time-error").remove();
            });
                    $('.date-set,input[name=start_date]').click(function(){
            $('input[name=start_date]').datetimepicker('show');
            });
</script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection