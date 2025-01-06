@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
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
    <div class="col-md-12"> @if(Session::has('message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            {{ Session::get('message') }} </div>
        @endif
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div class="tabbable tabbable-tabdrop">
                    <div class="tab-content settings">
                        <div class="tab-pane active form_pattern" id="general"> {!! Form::open(['method' => 'post','id'=>'frmShows']) !!}

                            <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                                {!! Form::text('title', isset($show->varTitle)?$show->varTitle:old('title'), array('maxlength'=>150, 'placeholder' => 'Name','class' => 'hasAlias form-control seoField maxlength-handler', 'placeholder' => trans('template.common.name'),'autocomplete'=>'off','data-url' => 'powerpanel/shows')) !!}
                                <label class="form_title" for="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
                                <span style="color: red;"> {{ $errors->first('title') }} </span>
                            </div>

                            <!-- code for alias -->
                            {!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/shows')) !!}
                            {!! Form::hidden('alias', isset($show->alias->varAlias)?$show->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
                            {!! Form::hidden('oldAlias', isset($show->alias->varAlias)?$show->alias->varAlias:old('alias')) !!}
                            <div class="form-group alias-group {{!isset($show)?'hide':''}}">
                                <label class="form_title" for="{{ trans('template.url') }}">{{ trans('template.common.url') }} :</label>
                                <a href="javascript:void;" class="alias">{!! url("/") !!}</a>
                                <a href="javascript:void(0);" class="editAlias" title="{{ trans('template.common.edit') }}">
                                    <i class="fa fa-edit"></i>

                                    <a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('shows/'.(isset($show->alias->varAlias) && isset($show)?$show->alias->varAlias:''))}}">
                                        <i class="fa fa-external-link" aria-hidden="true"></i>
                                    </a>

                                </a>
                            </div>
                            <span class="help-block">
                                {{ $errors->first('alias') }}
                            </span>
                            <!-- code for alias -->
                            @permission('show-category-list')
                            @include('powerpanel.partials.category',['categories'=>$ShowCategory, 'data'=>isset($show)?$show:null])
                            @endpermission
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @if($errors->first('author_by')) has-error @endif">
                                        <label class="form_title" for="author_by">{{ trans('template.showsModule.performer') }}</label>
                                        <select class="form-control bs-select select2" id="dj_options" name="author_by[]" multiple>
                                            @php $author_by = !empty($show->varAuthor)?explode(',',$show->varAuthor):''; @endphp
                                            @if(!$djObj->isEmpty())
                                            @foreach($djObj as $dj)
                                            @if(!empty($author_by) && in_array($dj->id,$author_by))
                                            @php  $selected_dj = 'selected' @endphp
                                            @else
                                            @php  $selected_dj = ''  @endphp
                                            @endif
                                            <option value="{{ $dj->id }}" {{ $selected_dj }} >{{ $dj->varTitle }}</option>
                                            @endforeach
                                            @else
                                            <option value="">{{ trans('template.showsModule.pleaseAddPerformer') }}</option>
                                            @endif
                                        </select>
                                        <span class="help-block">{{ $errors->first('author_by') }} </span> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @if($errors->first('show_days')) has-error @endif">
                                        <label class="form_title" for="show_days">Show Days <span aria-required="true" class="required"> * </span></label>
                                        <select class="form-control bs-select select2" name="show_days[]" id="show_days" style="width: 99%;" multiple>
                                            <option value="">--{{ trans('template.showsModule.selectShowDays') }}--</option>

                                            @php $show_days = !empty($show->varShowDays)?explode(',',$show->varShowDays):[]; @endphp
                                            <option value="weekdays" {{ (in_array('weekdays',$show_days))? 'selected':'' }} >{{ trans('template.showsModule.weekDays') }}</option>
                                            <option value="weekends" {{ (in_array('weekends',$show_days))? 'selected':'' }} >{{ trans('template.showsModule.weekEnd') }}</option>
                                            <option value="mon" {{ (in_array('mon',$show_days) )? 'selected':'' }} >{{ trans('template.showsModule.monday') }}</option>
                                            <option value="tue" {{ (in_array('tue',$show_days) )? 'selected':'' }} >{{ trans('template.showsModule.tuesday') }}</option>
                                            <option value="wed" {{ (in_array('wed',$show_days) )? 'selected':'' }} >{{ trans('template.showsModule.wednesday') }}</option>
                                            <option value="thu" {{ (in_array('thu',$show_days) )? 'selected':'' }} >{{ trans('template.showsModule.thursday') }}</option>
                                            <option value="fri" {{ (in_array('fri',$show_days) )? 'selected':'' }} >{{ trans('template.showsModule.friday') }}</option>
                                            <option value="sat" {{ (in_array('sat',$show_days) )? 'selected':'' }} >{{ trans('template.showsModule.saturday') }}</option>
                                            <option value="sun" {{ (in_array('sun',$show_days) )? 'selected':'' }} >{{ trans('template.showsModule.sunday') }}</option>
                                        </select>
                                        <span class="help-block">{{ $errors->first('show_days') }} </span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group date form_meridian_datetime @if($errors->first('start_date_time')) has-error @endif" data-date="{{ Carbon\Carbon::today()->format('Y-m-d') }}T15:25:00Z">
                                            <span class="input-group-btn date_default">
                                                <button class="btn date-set fromButton" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                            {!! Form::text('start_date_time', isset($show->dtStartDateTime)?date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime($show->dtStartDateTime)):date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A'), array('readonly'=>true,'class' => 'form-control','id'=>'start_date_time')) !!}
                                            <label class="control-label form_title">{{ trans('template.common.startDateAndTime') }}<span aria-required="true" class="required"> * </span></label>
                                        </div>
                                        <span class="help-block">
                                            {{ $errors->first('start_date_time') }}
                                        </span>
                                    </div>
                                </div>
                                @php $defaultDt = (null !== old('end_date_time'))?old('end_date_time'):null; @endphp
                                @if ((isset($show->dtEndDateTime)==null))
                                @php 
                                $expChecked_yes = 1; 
                                $expclass='';
                                @endphp
                                @else
                                @php 
                                $expChecked_yes = 0;
                                $expclass='no_expiry';
                                @endphp
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group date  form_meridian_datetime expirydate @if($errors->first('end_date_time')) has-error @endif" data-date="{{ Carbon\Carbon::today()->format('Y-m-d') }}T15:25:00Z" @if ($expChecked_yes==1) style="display:none;" @endif>
                                             <span class="input-group-btn date_default">
                                                <button class="btn date-set toButton" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                            {!! Form::text('end_date_time', isset($show->dtEndDateTime)?date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime($show->dtEndDateTime)):$defaultDt, array('readonly'=>true,'class' => 'form-control','id'=>'end_date_time','data-exp'=> $expChecked_yes,'data-newvalue')) !!}
                                            <label class="control-label form_title">{{ trans('template.common.endDateAndTime') }} <span aria-required="true" class="required"> * </span></label>
                                        </div>
                                        <span class="help-block">
                                            {{ $errors->first('end_date_time') }}
                                        </span>
                                        <label class="expdatelabel {{ $expclass }}">
                                            <a id="noexpiry" name="noexpiry" href="javascript:void(0);">
                                                <b class="expiry_lbl"></b>
                                            </a>
                                        </label>
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
                                                    <a class="media_manager multiple-selection" data-multiple=true onclick="MediaManager.open('show_image');"><span class="fileinput-new"></span></a>
                                                    <input class="form-control" type="hidden" id="show_image" name="img_id" value="{{ isset($show->fkIntImgId)?$show->fkIntImgId:old('img_id') }}" />
                                                    <input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            @if(!empty($show->fkIntImgId) && isset($show->fkIntImgId))
                                            @php $imageArr = explode(',',$show->fkIntImgId)  @endphp
                                            <div id="show_image_img">
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
                                            <div id="show_image_img"></div>
                                            @endif
                                            @php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{{ trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="image_thumb">
                                        <div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }} ">
                                            <label class="form_title" for="front_logo">{{ trans('template.common.selectVideo') }} <span aria-required="true" class="required"> * </span></label>
                                            <div class="clearfix"></div>
                                            <div class="fileinput fileinput-new videoUploadImg" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail show_video_vid" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
                                                    @if(Input::old('video_url'))
                                                    <img src="{{ Input::old('video_url') }}" />
                                                    @else
                                                    <img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" />
                                                    @endif
                                                </div>
                                                <div class="input-group"> <a class="video_manager" onclick="MediaManager.openVideoManager('show_video');"><span class="fileinput-new"></span></a> </div>
                                                @if(!empty($show->video->varVideoName))
                                                <input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ $show->video->varVideoName }}.{{ $show->video->varVideoExtension }}" />
                                                @else
                                                <input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ isset($show->video->varVideoName)?$show->video->varVideoName:'' }}" />
                                                @endif
                                                <input class="form-control" type="hidden" id="show_video" name="video_id" value="{{ isset($show->fkIntVideoId)?$show->fkIntVideoId:old('video_id') }}" />
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <span>({{ trans('template.showsModule.viderecomandation') }}.)</span> <span style="color: red;"> {{ $errors->first('video_id') }}</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
                                        {!! Form::textarea('short_description', isset($show->txtShortDescription)?$show->txtShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3','placeholder'=>trans('template.common.shortdescription'))) !!}
                                        <label class="form_title">{{ trans('template.common.shortdescription') }}</label>
                                        <span class="help-block">{{ $errors->first('short_description') }}</span> </div>
                                </div>
                            </div>
                            <div class="form-group @if($errors->first('description')) has-error @endif">
                                <label class="form_title">{{ trans('template.common.description') }}</label>
                                {!! Form::textarea('description', isset($show->txtDescription)?$show->txtDescription:old('description'), array('placeholder' =>trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!} <span style="color: red;">{{ $errors->first('description') }}</span>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        @if ( (isset($show->varFeaturedShow) && $show->varFeaturedShow == 'N') || Input::old('featuredShow')=='N' || (!isset($show->varFeaturedShow) && Input::old('featuredShow')==null))
                                        @php  $featured_checked_no = 'checked'  @endphp
                                        @else
                                        @php  $featured_checked_no = ''  @endphp
                                        @endif
                                        @if (isset($show->varFeaturedShow) && $show->varFeaturedShow == 'Y' || (Input::old('featuredShow') == 'Y'))
                                        @php  $featured_checked_yes = 'checked'  @endphp
                                        @else
                                        @php  $featured_checked_yes = ''  @endphp
                                        @endif
                                        <label class="control-label form_title">{{ trans('template.showsModule.isFeatureShow') }}</label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input class="md-radiobtn" type="radio" value="Y" name="featuredShow" id="featuredShowY" {{ $featured_checked_yes }}>
                                                <label for="featuredShowY"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.yes') }} </label>
                                            </div>
                                            <div class="md-radio">
                                                <input class="md-radiobtn" type="radio" value="N" name="featuredShow" id="featuredShowN" {{ $featured_checked_no }}/>
                                                <label for="featuredShowN"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.no') }} </label>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <span>{{ trans('template.common.note') }}: {{ trans('template.showsModule.featureShowNote') }}*</span> </div>
                                </div>
                            </div>

                            @include('powerpanel.partials.seoInfo',['form'=>'frmShows','inf'=>isset($metaInfo)?$metaInfo:false])
                            <h3>Display Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    @php
                                    $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                    if(!isset($show->intDisplayOrder)){
                                    $display_order_attributes['readonly'] = "readonly";
                                    } 
                                    @endphp
                                    <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                                        {!! Form::text('display_order',  isset($show->intDisplayOrder)?$show->intDisplayOrder:$total, $display_order_attributes) !!}
                                        <label class="form_title" for="site_name">{{ trans('template.common.displayorder') }}<span aria-required="true" class="required"> * </span></label>
                                        <span class="help-block">
                                            {{ $errors->first('display_order') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @include('powerpanel.partials.displayInfo',['display' => isset($show->chrPublish)?$show->chrPublish:null ])
                                </div>
                            </div>
                            <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                            <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                            <a class="btn btn-outline red" href="{{ url('powerpanel/shows') }}">{{ trans('template.common.cancel') }}</a> {!! Form::close() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('powerpanel.partials.addCat',['module' => 'show-category','categoryHeirarchy' => $categoryHeirarchy])
@endsection
@section('scripts')
<script src="{{ url('resources/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/form-input-mask.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script src="{{ url('resources/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/moment.min.js') }}"></script>
<script src="{{ url('resources/global/plugins/moments-timezone.js') }}"></script>

<script type="text/javascript">
                                                                    window.site_url = '{!! url("/") !!}';
                                                                    var seoFormId = 'frmShows';
                                                                    var user_action = "{{ isset($show)?'edit':'add' }}";
                                                                    var oldVal = "{{isset($show->dtEndDateTime)?date('Y-m-d g:i A',strtotime($show->dtEndDateTime)):$defaultDt}}";
                                                                    var moduleAlias = 'shows';
                                                                    var categoryAllowed = false;
                                                                    @permission('show-category-list')
                                                                    categoryAllowed = true;
                                                                    @endpermission
                                                                    $(document).ready(function()
                                                            {
                                                            $('#dj_options').select2({
                                                            placeholder: "Select DJ's",
                                                                    width: '100%'
                                                            });
                                                                    $('#show_days').select2({
                                                            placeholder: "Select Show Days",
                                                                    width: '100%'
                                                            }).on("change", function (e) {
                                                            $("#show_days").closest('.has-error').removeClass('has-error');
                                                                    $("#show_days-error").remove();
                                                                    });
                                                                    var today = moment.tz("{{Config::get('Constant.DEFAULT_TIME_ZONE')}}").format(DEFAULT_DT_FORMAT + " H:m:s");
                                                                    $('#start_date_time').datetimepicker({
                                                            autoclose: true,
                                                                    startDate:today,
                                                                    showMeridian: true,
                                                                    minuteStep: 5,
                                                                    format:DEFAULT_DT_FMT_FOR_DATEPICKER + ' HH:ii P'
                                                            }).on("changeDate", function (e) {
                                                            $("#start_date_time").closest('.has-error').removeClass('has-error');
                                                                    $("#start_date_time-error").remove();
                                                                    var startdate = moment($('#start_date_time').val());
                                                                    startdate = moment(startdate).add(1, 'hours').format(DEFAULT_DT_FORMAT + " H:m:s");
                                                                    $('#end_date_time').datetimepicker('setStartDate', startdate);
                                                            });
                                                                    var startdate = moment($('#start_date_time').val());
                                                                    startdate = moment(startdate).add(1, 'hours').format(DEFAULT_DT_FORMAT + " H:m:s");
                                                                    $('#end_date_time').datetimepicker({
                                                            autoclose: true,
                                                                    startDate:startdate,
                                                                    showMeridian: true,
                                                                    minuteStep: 5,
                                                                    format:DEFAULT_DT_FMT_FOR_DATEPICKER + ' HH:ii P'
                                                            }).on("changeDate", function (e) {
                                                            $("#end_date_time").closest('.has-error').removeClass('has-error');
                                                                    $("#end_date_time-error").remove();
                                                            });
                                                            });
                                                                    $('.fromButton,#start_date_time').click(function(){
                                                            $('#start_date_time').datetimepicker('show');
                                                                    });
                                                                    $('.toButton,#end_date_time').click(function(){
                                                            $('#end_date_time').datetimepicker('show');
                                                                    });</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/shows_validations.js') }}" type="text/javascript"></script>
@endsection