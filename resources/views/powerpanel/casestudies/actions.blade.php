@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
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
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div class="tabbable tabbable-tabdrop">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-pane active" id="general">
                                    <div class="portlet-body form_pattern">
                                        {!! Form::open(['method' => 'post','id'=>'frmProduct']) !!}
                                        <div class="form-body">
                                           <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                                                        {!! Form::text('title', isset($casestudy->varTitle)?$casestudy->varTitle:old('title'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/casestudy','placeholder' => trans('template.common.title'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('title') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- code for alias -->
                                                    {!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/casestudy')) !!}
                                                    {!! Form::hidden('alias', isset($casestudy->alias->varAlias)?$casestudy->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
                                                    {!! Form::hidden('oldAlias', isset($casestudy->alias->varAlias)?$casestudy->alias->varAlias:old('alias')) !!}
                                                    {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                                                    <div class="form-group alias-group {{!isset($casestudy)?'hide':''}}">
                                                        <label class="form_title" for="{{ trans('template.url') }}">{{ trans('template.common.url') }} :</label>
                                                        <a href="javascript:void;" class="alias">{!! url("/") !!}</a>
                                                        <a href="javascript:void(0);" class="editAlias" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                            <a class="without_bg_icon openLink" title="Open Link" target="_blank" href="{{url('casestudy/'.(isset($casestudy->alias->varAlias) && isset($casestudy)?$casestudy->alias->varAlias:''))}}">
                                                                <i class="fa fa-external-link" aria-hidden="true"></i>
                                                            </a>
                                                        </a>
                                                    </div>
                                                    <span class="help-block">
                                                        {{ $errors->first('alias') }}
                                                    </span>
                                                    <!-- code for alias -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('tag_line')) has-error @endif form-md-line-input">
                                                        {!! Form::text('tag_line', isset($casestudy->varTagLine)?$casestudy->varTagLine:old('tag_line'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/casestudy','placeholder' => trans('template.common.tagline'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.common.tagline') }}</label>
                                                        <span class="help-block">
                                                            {{ $errors->first('tag_line') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }}">
                                                <div class="image_thumb">
                                                    <label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }} <span aria-required="true" class="required"> * </span> </label>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail member_image_img" data-trigger="fileinput" style="width:100%; height:120px;position: relative;">
                                                            @if(Input::old('image_url'))
                                                            <img src="{{ Input::old('image_url') }}" />
                                                            @elseif(isset($casestudy->image))
                                                            <img src="{!! App\Helpers\resize_image::resize($casestudy->image->id,120,120) !!}" />
                                                            @else
                                                            <img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
                                                            @endif
                                                        </div>
                                                        <div class="input-group">
                                                            <a class="media_manager" onclick="MediaManager.open('member_image');"><span class="fileinput-new"></span></a>
                                                            @if(isset($casestudy->image->id))
                                                            @php $imgId = $casestudy->image->id @endphp
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
                                                        {!! Form::textarea('short_description', isset($casestudy->txtShortDescription)?$casestudy->txtShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3','placeholder' => trans('template.common.shortdescription'))) !!}
                                                        <label class="form_title">{{ trans('template.common.shortdescription') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">{{ $errors->first('short_description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('description')) has-error @endif ">
                                                        <label class="control-label form_title">{{ trans('template.common.description') }}</label>
                                                        {!! Form::textarea('description', isset($casestudy->txtDescription)?$casestudy->txtDescription:old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
                                                        <span class="help-block">{{ $errors->first('description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if (Input::old('displayonhome') == 'Y' || (isset($casestudy->chrDisplayonhomepage) && $casestudy->chrDisplayonhomepage=='Y'))
                                                    @php $dchecked_yes = 'checked' @endphp
                                                    @else
                                                    @php $dchecked_yes = '' @endphp
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="control-label form_title">Display on Home Page ? </label>
                                                        <input class="" type="checkbox" name="displayonhome" id="displayonhome" value="Y" {{ $dchecked_yes }}/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('homepage_description')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('homepage_description', isset($casestudy->txtHomePageDesc)?$casestudy->txtHomePageDesc:old('homepage_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varhomepagedescription','rows'=>'3','placeholder' => trans('template.common.homepagedescription'))) !!}
                                                        <label class="form_title">{{ trans('template.common.homepagedescription') }} </label>
                                                        <span class="help-block">{{ $errors->first('homepage_description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('mainpage_description')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('mainpage_description', isset($casestudy->txtHostingMainPageDesc)?$casestudy->txtHostingMainPageDesc:old('mainpage_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varmainpagedescription','rows'=>'3','placeholder' => trans('template.common.mainpagedescription'))) !!}
                                                        <label class="form_title">{{ trans('template.common.mainpagedescription') }} </label>
                                                        <span class="help-block">{{ $errors->first('mainpage_description') }}</span>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class=" form-md-line-input nopadding">
                                                        @include('powerpanel.partials.seoInfo',['form'=>'frmProduct','inf'=>isset($metaInfo)?$metaInfo:false])
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @php
                                                    $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                                    if(!isset($casestudy->intDisplayOrder)){
                                                    $display_order_attributes['readonly'] = "readonly";
                                                    }
                                                    @endphp
                                                    <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                                                        {!! Form::text('display_order', isset($casestudy->intDisplayOrder)?$casestudy->intDisplayOrder:$total, $display_order_attributes) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('display_order') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @include('powerpanel.partials.displayInfo',['display' => isset($casestudy->chrPublish)?$casestudy->chrPublish:'Y'])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                                    <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                                    <a class="btn btn-outline red" href="{{ url('powerpanel/casestudy') }}">{{ trans('template.common.cancel') }}</a>
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
    window.site_url = '{!! url("/") !!}';
    var seoFormId = 'frmProduct';
    var user_action = "{{ isset($casestudy)?'edit':'add' }}";
    var moduleAlias = '';
    var categoryAllowed = false;
    @permission('product-category-list')
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

<script src="{{ url('resources/pages/scripts/product_validations.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection