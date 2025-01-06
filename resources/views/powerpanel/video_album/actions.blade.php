@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('resources/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->
@endsection
@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@stop
@section('content')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
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
                    {!! Form::open(['method' => 'post','id'=>'frmVideoAlbum']) !!}
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                            {!! Form::text('title', (isset($video_album->varTitle)?$video_album->varTitle:Input::old('title')), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','data-url' => 'powerpanel/video-album','autocomplete'=>'off')) !!}
                            <label class="form_title" for="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
                            <span class="help-block">
                              <strong>{{ $errors->first('title') }}</strong>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <!-- code for alias -->
                          
                          {!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/video-album')) !!}
                          {!! Form::hidden('alias', (isset($video_album->alias->varAlias)?$video_album->alias->varAlias:Input::old('alias')), array('class' => 'aliasField')) !!}
                          {!! Form::hidden('oldAlias', isset($video_album->alias->varAlias)?$video_album->alias->varAlias:Input::old('alias')) !!}

                          <div class="form-group alias-group {{!isset($photo_album->alias)?'hide':''}}">
                            <label class="form_title" for="Url">{{ trans('template.common.url') }} :</label>
                            <a href="javascript:void;" class="alias">{!! url("/") !!}</a>
                            <a href="javascript:void(0);" class="editAlias">
                              <i class="fa fa-edit"></i>
                            </a>
                            &nbsp;<a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('video-album')}}/{{ (isset($video_album->alias->varAlias)?$video_album->alias->varAlias:'') }}"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                          </div>
                          <!-- code for alias -->
                          <span class="help-block">
                            <strong>{{ $errors->first('alias') }}</strong>
                          </span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="image_thumb">
                            <div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }} ">
                              <label class="form_title" for="front_logo">{{ trans('template.common.selectVideo') }} <span aria-required="true" class="required"> * </span></label>
                              <div class="clearfix"></div>
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail video_img" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
                                  @if(Input::old('video_url'))
                                  <img src="{{ Input::old('video_url') }}" />
                                  @else
                                  <img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" />
                                  @endif
                                </div>
                                <div class="input-group">
                                  <a class="video_manager" onclick="MediaManager.openVideoManager('video');"><span class="fileinput-new"></span></a>
                                </div>
                                @if(isset($video_album->video->varVideoName) && !empty($video_album->video->varVideoName))
                                <input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ $video_album->video->varVideoName }}.{{ $video_album->video->varVideoExtension }}" />
                                @else
                                <input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ (isset($video_album->video->youtubeId)?$video_album->video->youtubeId:'') }}" />
                                @endif
                                <input class="form-control" type="hidden" id="video" name="video_id" value="{{ (isset($video_album->fkIntVideoId)?$video_album->fkIntVideoId:Input::old('video_id')) }}" />
                                <input class="form-control" type="hidden" id="image_url" name="video_url" value="{{ Input::old('video_url') }}" />
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            <span>({{ trans('template.videoGalleryModule.videoRecomandation') }}.)</span>
                            <span style="color: red;">
                              <strong>{{ $errors->first('video_id') }}</strong>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group @if($errors->first('description')) has-error @endif ">
                            <label class="control-label form_title">{{ trans('template.common.description') }}</label>
                            {!! Form::textarea('description', (isset($video_album->txtDescription)?$video_album->txtDescription:Input::old('description')), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
                            <span class="help-block">{{ $errors->first('description') }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class=" form-md-line-input nopadding">
                            @include('powerpanel.partials.seoInfo',['form'=>'frmVideoAlbum','inf'=>(isset($metaInfo)?$metaInfo:false)])
                          </div>
                        </div>
                      </div>
                      <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                            @php
                             $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                             if(!isset($video_album->intDisplayOrder)){
                             $display_order_attributes['readonly'] = "readonly";
                             } 
                            @endphp
                            {!! Form::text('display_order', isset($video_album->intDisplayOrder)?$video_album->intDisplayOrder:$total, $display_order_attributes) !!}
                            <label class="form_title site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
                            <span class="help-block">
                              <strong>{{ $errors->first('display_order') }}</strong>
                            </span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          @include('powerpanel.partials.displayInfo',['display' =>  isset($video_album->chrPublish)?$video_album->chrPublish:'Y'])
                        </div>
                      </div>
                    </div>
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-12">
                          <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                          <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
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
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
window.site_url =  '{!! url("/") !!}';
var seoFormId = 'frmVideoAlbum';
var user_action="{{ isset($video_album)?'edit':'add' }}";
var moduleAlias = 'video-album';
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
<script src="{{ url('resources/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/select2/js/components-select2.min.js') }}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ url('resources/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/video_album_validations.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection