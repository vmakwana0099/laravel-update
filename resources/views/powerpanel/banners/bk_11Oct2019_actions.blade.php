@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                                    {!! Form::open(['method' => 'post','enctype' => 'multipart/form-data','id'=>'frmBanner']) !!}
                                    {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                                    <div class="form-body">
                                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} form-md-line-input">
                                            {!! Form::text('title', isset($banners->varTitle)?$banners->varTitle:old('title'), array('class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'title','placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
                                            <label class="form_title" for="title">{!! trans('template.common.title') !!} <span aria-required="true" class="required"> * </span></label>
                                            <span style="color:#e73d4a">
                                                {{ $errors->first('title') }}
                                            </span>
                                        </div>
                                        @if ((isset($banners->varBannerType) && $banners->varBannerType == 'home_banner') || old('banner_type') == 'home_banner')
                                        @php $checked_yes = 'checked' @endphp
                                        @else
                                        @php $checked_yes = '' @endphp
                                        @endif
                                        @if ((isset($banners->varBannerType) && $banners->varBannerType == 'inner_banner') || old('banner_type') == 'inner_banner' || (!isset($banners->varBannerType) && old('banner_type') == null))
                                        @php $ichecked_innerbaner_yes = 'checked' @endphp
                                        @else
                                        @php $ichecked_innerbaner_yes = '' @endphp
                                        @endif
                                        <div class="form-group {{ $errors->has('banner_type') ? ' has-error' : '' }}">
                                            <label class="form_title" for="banner_type">{!! trans('template.bannerModule.bannerType') !!} <span aria-required="true" class="required"> * </span></label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" {{ $checked_yes }}  value="home_banner" id="home_banner" name="banner_type" class="md-radiobtn banner">
                                                    <label for="home_banner">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> {!! trans('template.bannerModule.homeBanner') !!}
                                                    </label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" {{ $ichecked_innerbaner_yes }} value="inner_banner" id="inner_banner" name="banner_type" class="md-radiobtn banner">
                                                    <label for="inner_banner">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> {!! trans('template.bannerModule.innerBanner') !!}
                                                    </label>
                                                </div>
                                            </div>
                                            <span class="help-block">
                                                <strong>{{ $errors->first('banner_type') }}</strong>
                                            </span>
                                        </div>
                                        @if ((isset($banners->varBannerVersion) && $banners->varBannerVersion == 'img_banner') || old('bannerversion')=='img_banner' || (!isset($banners->varBannerVersion) && old('bannerversion') == null))
                                        @php $checked_yes = 'checked' @endphp
                                        @else
                                        @php $checked_yes = '' @endphp
                                        @endif
                                        @if ((isset($banners->varBannerVersion) && $banners->varBannerVersion == 'vid_banner') || old('bannerversion')=='vid_banner')
                                        @php $ichecked_vid_yes = 'checked' @endphp
                                        @else
                                        @php $ichecked_vid_yes = '' @endphp
                                        @endif
                                        <div style="display: none;" class="form-group bannerversion {{ $errors->has('bannerversion') ? ' has-error' : '' }}">
                                            <label class="form_title" for="bannerversion">{!! trans('template.bannerModule.version') !!} <span aria-required="true" class="required"> * </span></label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" {{ $checked_yes }}  value="img_banner" id="img_banner" name="bannerversion" class="md-radiobtn versionradio">
                                                    <label for="img_banner">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> {!! trans('template.bannerModule.imageBanner') !!}
                                                    </label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" {{ $ichecked_vid_yes }} value="vid_banner" disabled id="vid_banner" name="bannerversion" class="md-radiobtn versionradio">
                                                    <label for="vid_banner">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> {!! trans('template.bannerModule.videoBanner') !!}
                                                    </label>
                                                </div>
                                            </div>
                                            <span class="help-block">
                                                <strong>{{ $errors->first('bannerversion') }}</strong>
                                            </span>
                                        </div>


                                        <div class="form-group" id="pages" style="display: none;">
                                            <label class="form_title" for="pages">{!! trans('template.common.selectmodule') !!} <span aria-required="true" class="required"> * </span></label>
                                            <select class="form-control bs-select select2" name="modules" id="modules">
                                                <option value=" ">-{!! trans('template.common.selectmodule') !!}-</option>
                                                @if(count($modules) > 0)
                                                @foreach ($modules as $pagedata)
                                                @php 
                                                $permissionName = $pagedata->varModuleName.'-list';
                                                $avoidModules = array('faq','contact-us','testimonial');
                                                @endphp
                                                @permission($permissionName)
                                                @if (ucfirst($pagedata->varTitle)!='Home' && !in_array($pagedata->varModuleName,$avoidModules))
                                                <option data-model="{{ $pagedata->varModelName }}" data-module="{{ $pagedata->varModuleName }}" value="{{ $pagedata->id }}" {{ (isset($banners->fkModuleId) && $pagedata->id == $banners->fkModuleId) || $pagedata->id == old('modules')? 'selected' : '' }} >{{ $pagedata->varTitle }}</option>
                                                @endif
                                                @endpermission
                                                @endforeach
                                                @endif
                                            </select>
                                            <span style="color:#e73d4a">
                                                {{ $errors->first('modules') }}
                                            </span>
                                        </div>
                                        <div class="form-group" id="records" style="display: none;">
                                            <label class="form_title" for="pages">{!! trans('template.bannerModule.selectPage') !!} <span aria-required="true" class="required"> * </span></label>
                                            <select class="form-control bs-select select2" name="foritem" id="foritem" style="width:100%">
                                                <option value=" ">--{!! trans('template.bannerModule.selectPage') !!}--</option>
                                            </select>
                                            <span style="color:#e73d4a">
                                                {{ $errors->first('foritem') }}
                                            </span>
                                        </div>
                                        <div class="form-group {{ $errors->has('tag_line') ? ' has-error' : '' }}  form-md-line-input" id="tag_line_div">
                                            {!! Form::text('tag_line', isset($banners->varTagLine)?$banners->varTagLine:old('tag_line'), array('class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'tag_line','placeholder' => trans('template.common.tagline'),'autocomplete'=>'off')) !!}
                                            <label class="form_title" for="tag_line">{!! trans('template.common.tagline') !!} <span aria-required="true" class="required"> * </span></label>
                                            <span style="color:#e73d4a">
                                                {{ $errors->first('tag_line') }}
                                            </span>
                                        </div>
                                        <div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }}">
                                            <div class="image_thumb">
                                                <label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }} <span aria-required="true" class="required"> * </span></label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail banner_image_img" data-trigger="fileinput" style="width:100%; height:120px;position: relative;">
                                                        @if(Input::old('image_url'))
                                                        <img src="{{ Input::old('image_url') }}" />
                                                        @elseif(isset($banners->image))
                                                        <img src="{!! App\Helpers\resize_image::resize($banners->image->id,120,120) !!}" />
                                                        @else
                                                        <img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
                                                        @endif
                                                    </div>
                                                    <div class="input-group">
                                                        <a class="media_manager" onclick="MediaManager.open('banner_image');"><span class="fileinput-new"></span></a>
                                                        @if(isset($banners->image->id))
                                                        @php $imgId = $banners->image->id @endphp
                                                        @else
                                                        @php $imgId = ''  @endphp
                                                        @endif
                                                        <input class="form-control" type="hidden" id="banner_image" name="img_id" value="{{ $imgId }}" />
                                                        <input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
                                                    </div>
                                                    <div class="overflow_layer">
                                                        <a onclick="MediaManager.open('banner_image');" class="media_manager remove_img"><i class="fa fa-pencil"></i></a>
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
                                        <div id="feature_list">
                                            <div class="form-group {{ $errors->has('title_feature1') ? ' has-error' : '' }} form-md-line-input">
                                                <label class="form_title" for="title_feature1">{!! trans('template.common.features') !!} 1 <span aria-required="true" class="required"> * </span></label>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6">
                                                    {!! Form::text('title_feature1', isset($banners->varTitle_feature1)?$banners->varTitle_feature1:old('title_feature1'), array('maxlength' => 55, 'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'title_feature1','placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
                                                    <span style="color:#e73d4a">
                                                        {{ $errors->first('title_feature1') }}
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::text('feature1_icon', isset($banners->varFeature1_iconclass)?$banners->varFeature1_iconclass:old('feature1_icon'), array('class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'feature1_icon','placeholder' => trans('template.common.icon'),'autocomplete'=>'off')) !!}
                                                    <span style="color:#e73d4a">
                                                        {{ $errors->first('feature1_icon') }}
                                                    </span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group {{ $errors->has('title_feature2') ? ' has-error' : '' }} form-md-line-input">
                                                <label class="form_title" for="title_feature2">{!! trans('template.common.features') !!} 2 <span aria-required="true" class="required"> * </span></label>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6">
                                                    {!! Form::text('title_feature2', isset($banners->varTitle_feature2)?$banners->varTitle_feature2:old('title_feature2'), array('maxlength' => 55, 'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'title_feature2','placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
                                                    <span style="color:#e73d4a">
                                                        {{ $errors->first('title_feature2') }}
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::text('feature2_icon', isset($banners->varFeature2_iconclass)?$banners->varFeature2_iconclass:old('feature2_icon'), array('class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'feature2_icon','placeholder' => trans('template.common.icon'),'autocomplete'=>'off')) !!}
                                                    <span style="color:#e73d4a">
                                                        {{ $errors->first('feature2_icon') }}
                                                    </span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group {{ $errors->has('title_feature3') ? ' has-error' : '' }} form-md-line-input">
                                                <label class="form_title" for="title_feature2">{!! trans('template.common.features') !!} 3 <span aria-required="true" class="required"> * </span></label>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6">
                                                    {!! Form::text('title_feature3', isset($banners->varTitle_feature3)?$banners->varTitle_feature3:old('title_feature3'), array('maxlength' => 55, 'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'title_feature3','placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
                                                    <span style="color:#e73d4a">
                                                        {{ $errors->first('title_feature3') }}
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::text('feature3_icon', isset($banners->varFeature3_iconclass)?$banners->varFeature3_iconclass:old('feature3_icon'), array('class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'feature3_icon','placeholder' => trans('template.common.icon'),'autocomplete'=>'off')) !!}
                                                    <span style="color:#e73d4a">
                                                        {{ $errors->first('feature3_icon') }}
                                                    </span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group {{ $errors->has('title_feature4') ? ' has-error' : '' }} form-md-line-input">
                                                <label class="form_title" for="title_feature4">{!! trans('template.common.features') !!} 4 <span aria-required="true" class="required"> * </span></label>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6">
                                                    {!! Form::text('title_feature4', isset($banners->varTitle_feature4)?$banners->varTitle_feature4:old('title_feature4'), array('maxlength' => 55, 'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'title_feature4','placeholder' => trans('template.common.title'),'autocomplete'=>'off')) !!}
                                                    <span style="color:#e73d4a">
                                                        {{ $errors->first('title_feature4') }}
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::text('feature4_icon', isset($banners->varFeature4_iconclass)?$banners->varFeature4_iconclass:old('feature4_icon'), array('class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'feature4_icon','placeholder' => trans('template.common.icon'),'autocomplete'=>'off')) !!}
                                                    <span style="color:#e73d4a">
                                                        {{ $errors->first('feature4_icon') }}
                                                    </span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group @if($errors->first('button_text')) has-error @endif form-md-line-input">
                                                        {!! Form::text('button_text', isset($banners->VarButtonText)?$banners->VarButtonText:old('button_text'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','id' => 'button_text','placeholder' => trans('template.common.name'),'data-url' => 'powerpanel/products')) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.bannerModule.buttontext') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('button_text') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group @if($errors->first('button_link')) has-error @endif form-md-line-input">
                                                        {!! Form::text('button_link', isset($banners->VarButtonLink)?$banners->VarButtonLink:old('button_link'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','id' => 'button_link','placeholder' => trans('template.common.link'),'data-url' => 'powerpanel/products')) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.bannerModule.buttonlink') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('button_link') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} form-md-line-input">                                                
                                                {!! Form::text('discount_percentage',isset($banners->discount_percentage)?$banners->discount_percentage:old('discount_percentage'), array('class' => 'form-control','id'=>'discount_percentage','placeholder'=>trans('template.common.discountpercentage'),'style'=>'max-height:80px;', 'onkeypress'=>"javascript: return KeycheckOnlyPhonenumber(event);")) !!}
                                                <label class="form_title" for="discount_percentage">{!! trans('template.common.discountpercentage') !!}</label>
                                                <span style="color:#e73d4a">
                                                    {{ $errors->first('discount_percentage') }}
                                                </span>
                                            </div>
                                            <div class="form-group {{ $errors->has('special_offerTitle') ? ' has-error' : '' }} form-md-line-input">                                                
                                                {!! Form::text('special_offerTitle',isset($banners->special_offerTitle)?$banners->special_offerTitle:old('special_offerTitle'), array('class' => 'form-control','id'=>'special_offerTitle','placeholder'=>trans('template.bannerModule.specialoffertitle'),'style'=>'max-height:80px;')) !!}
                                                <label class="form_title" for="special_offerTitle">{!! trans('template.bannerModule.specialoffertitle') !!}</label>
                                                <span style="color:#e73d4a">
                                                    {{ $errors->first('special_offerTitle') }}
                                                </span>
                                            </div>                                            
                                            <div class="form-group {{ $errors->has('special_offertext') ? ' has-error' : '' }} form-md-line-input">                                                
                                                {!! Form::text('special_offertext',isset($banners->special_offertext)?$banners->special_offertext:old('special_offertext'), array('maxlength' => 10, 'class' => 'form-control','id'=>'special_offertext','placeholder'=>trans('template.bannerModule.specialoffertext'),'style'=>'max-height:80px;')) !!}
                                                <label class="form_title" for="special_offerext">{!! trans('template.bannerModule.specialoffertext') !!}</label>
                                                <span style="color:#e73d4a">
                                                    {{ $errors->first('specialoffertext') }}
                                                </span>
                                            </div>
                                        </div>

                                        <div id="feature_list_inner">
                                            <div class="form-group form-md-line-input">
                                                {!! Form::text('icon_class', isset($banners->varIcon_Class)?$banners->varIcon_Class:old('icon_class'), array('class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'icon_class','placeholder' => 'Icon Class','autocomplete'=>'off')) !!}
                                                <label class="form_title" for="icon_class">Icon Class</label>                                                
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                {!! Form::text('second_title', isset($banners->varSecond_Title)?$banners->varSecond_Title:old('second_title'), array('class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/banners','id' => 'second_title','placeholder' => 'Second Title','autocomplete'=>'off')) !!}
                                                <label class="form_title" for="second_title">Second Title</label>                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group @if($errors->first('button_text1')) has-error @endif form-md-line-input">
                                                        {!! Form::text('button_text1', isset($banners->VarButtonText1)?$banners->VarButtonText1:old('button_text1'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','id' => 'button_text1','placeholder' => trans('template.common.name'),'data-url' => 'powerpanel/products')) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.bannerModule.buttontext') }} 1</label>
                                                        <span class="help-block">
                                                            {{ $errors->first('button_text1') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group @if($errors->first('button_link1')) has-error @endif form-md-line-input">
                                                        {!! Form::text('button_link1', isset($banners->VarButtonLink1)?$banners->VarButtonLink1:old('button_link1'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','id' => 'button_link1','placeholder' => trans('template.common.link'),'data-url' => 'powerpanel/products')) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.bannerModule.buttonlink') }} 1</label>
                                                        <span class="help-block">
                                                            {{ $errors->first('button_link1') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group @if($errors->first('button_text2')) has-error @endif form-md-line-input">
                                                        {!! Form::text('button_text2', isset($banners->VarButtonText2)?$banners->VarButtonText2:old('button_text2'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','id' => 'button_text2','placeholder' => trans('template.common.name'),'data-url' => 'powerpanel/products')) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.bannerModule.buttontext') }} 2</label>
                                                        <span class="help-block">
                                                            {{ $errors->first('button_text2') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group @if($errors->first('button_link2')) has-error @endif form-md-line-input">
                                                        {!! Form::text('button_link2', isset($banners->VarButtonLink2)?$banners->VarButtonLink2:old('button_link2'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','id' => 'button_link2','placeholder' => trans('template.common.link'),'data-url' => 'powerpanel/products')) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.bannerModule.buttonlink') }} 2</label>
                                                        <span class="help-block">
                                                            {{ $errors->first('button_link2') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                        <div class="form-group imguploader {{ $errors->has('image_upload') ? ' has-error' : '' }}">
                                                                                    <div class="image_thumb">
                                                                                        <label class="form_title" for="front_logo">{!! trans('template.bannerModule.selectBanner') !!} <span aria-required="true" class="required"> * </span></label>
                                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                            <div class="fileinput-preview thumbnail banner_image_img" data-trigger="fileinput" style="width:100%; height:120px;position: relative;">
                                                                                                @if(Input::old('image_url'))
                                                                                                <img src="{{ Input::old('image_url') }}" />
                                                                                                @elseif(isset($banners->fkIntImgId) && $banners->fkIntImgId > 0)
                                                                                                <img  src="{!! App\Helpers\resize_image::resize($banners->fkIntImgId) !!}" />
                                                                                                @else
                                                                                                <img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="input-group">
                                                                                                <a class="media_manager" onclick="MediaManager.open('banner_image');"><span class="fileinput-new"></span></a>
                                                                                                <input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
                                                                                            </div>
                                                                                            <input class="form-control" type="hidden" id="banner_image" name="image_upload" value="{{ isset($banners->fkIntImgId)?$banners->fkIntImgId:old('image_upload') }}" />
                                                                                            <span id="home_recommandation" @if ( isset($banners->varBannerType) && $banners->varBannerType == 'inner_banner' || old('banner_type') == 'inner_banner') style="display:none;" @endif>(@php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{!! trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) !!}</span>.)</span>
                                                                                            <span id="inner_recommandation" @if ( isset($banners->varBannerType) && $banners->varBannerType == 'home_banner' || old('banner_type') == 'home_banner') style="display:none;" @endif>(@php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{!! trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) !!}</span>.)</span>
                                                                                        </div>
                                                                                        <div class="clearfix"></div>
                                                                                        <span style="color:#e73d4a;margin:0;display:inline;">
                                                                                            {{ $errors->first('image_upload') }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>-->

<!--                                        <div class="row viduploader">
                                            <div class="col-md-12">
                                                <div class="image_thumb">
                                                    <div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }} ">
                                                        <label class="form_title" for="front_logo">{!! trans('template.bannerModule.selectVideo') !!} <span aria-required="true" class="required"> * </span></label>
                                                        <div class="clearfix"></div>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail show_video_vid" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
                                                                @if(Input::old('video_url'))
                                                                <img src="{{ Input::old('video_url') }}" />
                                                                @else
                                                                <img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" />
                                                                @endif
                                                            </div>
                                                            <div class="input-group"> <a class="video_manager" onclick="MediaManager.openVideoManager('show_video');"><span class="fileinput-new"></span></a> </div>
                                                            @if(!empty($banners->video->varVideoName))
                                                            <input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ $banners->video->varVideoName }}.{{ $banners->video->varVideoExtension }}" />
                                                            @else
                                                            <input disabled="disabled" id="video_name" class="form-control" type="text" value="{{ isset($banners->video->varVideoName)?$banners->video->varVideoName:'' }}" />
                                                            @endif
                                                            <input class="form-control" type="hidden" id="show_video" name="video_id" value="{{ isset($banners->fkIntVideoId)?$banners->fkIntVideoId:old('video_id') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <span>({!! trans('template.bannerModule.videoReomandation') !!}.)</span> <span style="color:#e73d4a"> {{ $errors->first('video_id') }}</span> </div>
                                            </div>
                                        </div>-->
                                        <div class="form-group">
                                            <label class="form_title @if($errors->first('display_order')) has-error @endif" for="description">{!! trans('template.common.description') !!} <span aria-required="true" class="required"> * </span></label>
                                            {!! Form::textarea('description',isset($banners->txtDescription)?$banners->txtDescription:old('description'), array('class' => 'form-control','id'=>'txtDescription')) !!}
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        </div>
                                        <h3 class="form-section">{!! trans('template.common.displayinformation') !!}</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @php
                                                $display_order_attributes = array('class' => 'form-control','autocomplete'=>'off');
                                                if(!isset($banners->intDisplayOrder)){
                                                $display_order_attributes['readonly'] = "readonly";
                                                } 
                                                @endphp
                                                <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                                                    {!! Form::text('display_order',isset($banners->intDisplayOrder)?$banners->intDisplayOrder:$total_banner, $display_order_attributes) !!}
                                                    <label class="form_title" for="display_order">{!! trans('template.common.displayorder') !!} <span aria-required="true" class="required"> * </span></label>
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('display_order') }}</strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @include('powerpanel.partials.displayInfo',['display' => isset($banners->chrPublish)?$banners->chrPublish:''])
                                            </div>
<!--                                            <div class="col-md-12" style="display: none">
                                                @if (Input::old('defaultBanner') == 'Y' || (isset($banners->chrDefaultBanner) && $banners->chrDefaultBanner=='Y'))
                                                @php $dchecked_yes = 'checked' @endphp
                                                @else
                                                @php $dchecked_yes = '' @endphp
                                                @endif
                                                <div class="form-group">
                                                    <label class="control-label">{!! trans('template.common.defaultbanner') !!}</label>
                                                    <input type="checkbox" name="defaultBanner" value="Y" {{ $dchecked_yes }}/>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                                <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                                <a class="btn red btn-outline" href="{{ url('powerpanel/banners') }}">{!! trans('template.common.cancel')!!}</a>
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
@endsection
@section('scripts')
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script type="text/javascript">
                                                                window.site_url = '{!! url("/") !!}';
                                                                var selectedRecord = '{{ isset($banners->fkIntPageId)?$banners->fkIntPageId:' ' }}';
                                                                var user_action = "{{ isset($blog)?'edit':'add' }}";
</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>>
<script src="{{ url('resources/pages/scripts/banners.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
                                                                $('#modules').select2({
                                                                    placeholder: "Select Module",
                                                                    width: '100%'
                                                                }).on("change", function (e) {
                                                                    $("#modules").closest('.has-error').removeClass('has-error');
                                                                    $("#modules-error").remove();
                                                                    $('#records').show();
                                                                });
                                                                $('#foritem').select2({
                                                                    placeholder: "Select Module",
                                                                    width: '100%'
                                                                }).on("change", function (e) {
                                                                    $("#foritem").closest('.has-error').removeClass('has-error');
                                                                    $("#foritem-error").remove();
                                                                });
</script>
<script src="{{ url('resources/pages/scripts/numbervalidation.js') }}" type="text/javascript"></script>
@endsection