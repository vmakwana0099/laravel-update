@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<link href="{{ url('resources/global/plugins/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->
@endsection
@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@if (count($errors) > 0)  
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
@endif
<?php
// echo "<pre>";
// print_r($service);
// exit();
?>

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
                    {!! Form::open(['method' => 'post','id'=>'frmService']) !!}
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                            {!! Form::text('title', isset($service->varTitle)?$service->varTitle:old('title'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/services')) !!}
                            <label class="form_title" for="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
                            <span class="help-block">
                              {{ $errors->first('title') }}
                            </span>
                          </div>
                        </div>
                      </div>
                      <!-- code for alias -->
                      {!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/services')) !!}
                      {!! Form::hidden('alias', isset($service->alias->varAlias)?$service->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
                      {!! Form::hidden('oldAlias', isset($service->alias->varAlias)?$service->alias->varAlias:old('alias')) !!}
                      <div class="form-group alias-group {{!isset($service)?'hide':''}}">
                        <label class="form_title" for="{{ trans('template.url') }}">{{ trans('template.common.url') }} :</label>
                        <a href="javascript:void;" class="alias">{!! url("/") !!}</a>
                        <a href="javascript:void(0);" class="editAlias" title="Edit">
                          <i class="fa fa-edit"></i>
                          <a class="without_bg_icon openLink" title="Open Link" target="_blank" href="{{url('services/'.(isset($service->alias->varAlias) && isset($service)?$service->alias->varAlias:''))}}">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                          </a>
                        </a>
                      </div>
                      <span class="help-block">
                        {{ $errors->first('alias') }}
                      </span>
                      <!-- code for alias -->

                      
                      @permission('service-category-list')  
                                          
                        @include('powerpanel.partials.category',['categories'=>$ServiceCategory, 'data'=>isset($service)?$service:null])

                      @endpermission
                      

                      <div class="row">
                        <div class="col-md-12 ">
                          <div class="form-group font_icons_file @if($errors->first('font_awesome_icon')) has-error @endif ">
                            <label class="form_title" for="font_awesome_icon">{{ trans('template.common.serviceIcon') }}</label>
                            {!! Form::text('font_awesome_icon', isset($service->varFontAwesomeIcon)?$service->varFontAwesomeIcon:old('font_awesome_icon'), array('id'=>"e4_element", 'data-placement'=>"bottomRight", 'class' => 'form-control icp icp-auto','placeholder' => trans('template.common.selectIcon'),'autocomplete'=>'off','readonly'=> 'readonly')) !!}
                            <span class="input-group-addon"></span>
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
                                <div class="fileinput-preview thumbnail"  data-trigger="fileinput" style="width:100%; float:left; height:120px;position: relative;">
                                  <img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
                                </div>
                                <div class="input-group">
                                  <a class="media_manager multiple-selection" data-multiple=true  onclick="MediaManager.open('service_image');"><span class="fileinput-new"></span></a>
                                  <input class="form-control" type="hidden" id="service_image" name="img_id" value="{{ isset($service->fkIntImgId)?$service->fkIntImgId:old('img_id') }}" />
                                  <input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              @if(!empty($service->fkIntImgId) && isset($service->fkIntImgId))
                              @php $imageArr = explode(',',$service->fkIntImgId)  @endphp
                              <div  id="service_image_img">
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
                              <div id="service_image_img"></div>
                              @endif

                              @php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{{ trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) }}</span>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      

                      
                      <div class="row viduploader">
                        <div class="col-md-12">
                          <div class="image_thumb">
                            <div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }} ">
                              <label class="form_title" for="front_logo">{{ trans('template.serviceModule.selectVideo') }} </label>
                              <div class="clearfix"></div>
                               <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail service_video_vid" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
                                  @if(Input::old('video_url'))
                                  <img src="{{ Input::old('video_url') }}" />
                                  @else
                                  <img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" />
                                  @endif
                                </div>
                                <div class="input-group"> 
                                  <a class="video_manager multiple-selection" data-multiple=true onclick="MediaManager.openVideoManager('service_video');"><span class="fileinput-new"></span></a> 

                                  <input class="form-control" type="hidden" id="service_video" name="video_id" value="{{ isset($service->fkIntVideoId)?$service->fkIntVideoId:old('video_id') }}" />
                                  
                                  <input class="form-control" type="hidden" id="video_url" name="video_url" value="{{ Input::old('video_url') }}" />


                                </div>
                               {{--  @if(!empty($service->video->varVideoName)) --}}
                          @if(!empty($service->fkIntVideoId) && isset($service->fkIntVideoId))
                              @php $imageArr = explode(',',$service->fkIntVideoId)  @endphp
                               <div  id="service_video_vid" class="video_list">
                                <div class="multi_image_list">
                                  <ul>
                                    @foreach($service['videos'] as $key => $value)
                                       
                                    <li id="{{ $value->id }}">
                                      <span>
                                       @if(!empty($value->youtubeId))
                                       <img title="{{ $value->varVideoName }}" src="https://img.youtube.com/vi/{{ $value->youtubeId }}/mqdefault.jpg">
                                        @else
                                         <img title="{{ $value->txtVideoOriginalName }}" class="img_opacity" src="{{ url('/')}}/resources\images\video_upload_file.gif">
                                        @endif
                                        <a href="javascript:;" onclick="MediaManager.removeVideoFromVideoManager('{{ $value->id }}');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
                                      </span>
                                    </li>
                                    @endforeach
                                  </ul>
                                </div>
                              </div>

                                {{-- <input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ $service->video->varVideoName }}.{{ $service->video->varVideoExtension }}" /> --}}
                          @else
                          <div id="service_video_vid" class="video_list"></div>
                                {{-- <input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ isset($service->video->varVideoName)?$service->video->varVideoName:'' }}" /> --}}
                          @endif

                               

                              </div>
                            </div>
                            <div class="clearfix"></div>
                            <span>({{ trans('template.serviceModule.videoRecommendation') }}.)</span> <span style="color:#e73d4a"> {{ $errors->first('video_id') }}</span> </div>
                          </div>
                        </div>
                      
                        
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
                              {!! Form::textarea('short_description', isset($service->txtShortDescription)?$service->txtShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3')) !!}
                              <label class="form_title">{{ trans('template.common.shortdescription') }}<span aria-required="true" class="required"> * </span></label>
                              <span class="help-block">{{ $errors->first('short_description') }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group @if($errors->first('description')) has-error @endif">
                              <label class="form_title">{{ trans('template.common.description') }}</label>
                              {!! Form::textarea('description', isset($service->txtDescription)?$service->txtDescription:old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
                              <span class="help-block">{{ $errors->first('description') }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                              @if ( (isset($service->chrFeaturedService) && $service->chrFeaturedService == 'N') || Input::old('featuredService')=='N' || (!isset($service->chrFeaturedService) && Input::old('featuredService')==null))
                              @php  $featured_checked_no = 'checked'  @endphp
                              @else
                              @php  $featured_checked_no = ''  @endphp
                              @endif
                              @if (isset($service->chrFeaturedService) && $service->chrFeaturedService == 'Y' || (Input::old('featuredService') == 'Y'))
                              @php  $featured_checked_yes = 'checked'  @endphp
                              @else
                              @php  $featured_checked_yes = ''  @endphp
                              @endif
                              <label class="control-label form_title">{{ trans('template.serviceModule.isFeaturedService') }}?</label>
                              <div class="md-radio-inline">
                                <div class="md-radio">
                                  <input class="md-radiobtn" type="radio" value="Y" name="featuredService" id="featuredServiceY" {{ $featured_checked_yes }}>
                                  <label for="featuredServiceY"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.yes') }} </label>
                                </div>
                                <div class="md-radio">
                                  <input class="md-radiobtn" type="radio" value="N" name="featuredService" id="featuredServiceN" {{ $featured_checked_no }}/>
                                  <label for="featuredServiceN"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.no') }} </label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <span>{{ trans('template.serviceModule.featuredServiceNote') }}*</span>
                            </div>
                          </div>
                        </div>
                        

                        
                        <div class="row">
                          <div class="col-md-12">
                            <div class="nopadding">
                              @include('powerpanel.partials.seoInfo',['form'=>'frmService','inf'=>isset($metaInfo)?$metaInfo:false])
                            </div>
                          </div>
                        </div>
                        

                        <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
                        <div class="row">
                          <div class="col-md-6">
                          
                          @php
                            $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                            if(!isset($service->intDisplayOrder)){
                                $display_order_attributes['readonly'] = "readonly";
                            } 
                          @endphp

                            <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                              {!! Form::text('display_order',  isset($service->intDisplayOrder)?$service->intDisplayOrder:$total, $display_order_attributes) !!}
                              <label class="form_title" for="site_name">{{ trans('template.common.displayorder') }}<span aria-required="true" class="required"> * </span></label>
                              <span class="help-block">
                                {{ $errors->first('display_order') }}
                              </span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            @include('powerpanel.partials.displayInfo',['display' => isset($service->chrPublish)?$service->chrPublish:null ])
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-12">
                            <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                            <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                            <a class="btn btn-outline red" href="{{ url('powerpanel/services') }}">{{ trans('template.common.cancel') }}</a>
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
  @include('powerpanel.partials.addCat',['module' => 'service-category','categoryHeirarchy' => $categoryHeirarchy])
  @endsection
  @section('scripts')
  <script type="text/javascript">
    window.site_url =  '{!! url("/") !!}';
    var seoFormId = 'frmService';
    var user_action = "{{ isset($service)?'edit':'add' }}";
    var moduleAlias = 'services';
    var categoryAllowed = false;
    @permission('services-category-list')
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
  <script src="{{ url('resources/pages/scripts/service_validations.js') }}" type="text/javascript"></script>
  
  <script src="{{ url('resources/global/plugins/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js')}}" type="text/javascript"></script>
  <script>
  $(function() {
  $('.icp-auto').iconpicker({
    hideOnSelect: true
  });
  });
  </script>
  <!-- END PAGE LEVEL SCRIPTS -->
  @endsection