@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css"/>
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
    <div class="row">
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            {{ Session::get('message') }}
        </div>
    </div>
    @endif
    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div class="tabbable tabbable-tabdrop">
                    <div class="tab-content row form_pattern">
                        <div class="col-md-12">
                            <div class="portlet-body">
                                {!! Form::open(['method' => 'post','id'=>'frmTestimonial']) !!}
                                  {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                                <div class="form-body">
                                       @permission('product-category-list')
                                    @include('powerpanel.partials.category',['categories'=>$ProductCategory, 'data'=>isset($testimonials)?$testimonials:null])
                                    @endpermission
                                    <div class="row" id="product_div" style="display: none">
                                        <div class="col-md-12">
                                            <div class="form-group @if($errors->first('product_id')) has-error @endif">                                                                            
                                                <label class="form_title" for="product_id">{{ trans('template.common.selectproduct') }} <span aria-required="true" class="required"> * </span></label>
                                                <select id="product_id" class="form-control" name="product_id">

                                                </select>
                                                <span class="help-block">
                                                    {{ $errors->first('product_id') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-md-line-input">
                                                {!! Form::text('title',isset($testimonials->varTitle) ? $testimonials->varTitle:old('title') ,array('class' => 'form-control input-sm seoField maxlength-handler','maxlength'=>'150','id' => 'title','placeholder' => trans('template.testimonialModule.title'),'autocomplete'=>'off')) !!}
                                                <label class="form_title" for="title">{{ trans('template.testimonialModule.title') }} <span aria-required="true" class="required"> * </span></label>
                                                <span style="color: red;">
                                                    {{ $errors->first('title') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input">
                                                <div class="input-group date-picker" data-date-format="{{Config::get('Constant.DEFAULT_DATE_FORMAT')}}">
                                                    <span class="input-group-btn date_default">
                                                        <span class="btn date-set">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control datepicker" id="testimonialdate" name="testimonialdate" value="{{isset($testimonials->dtStartDateTime)?date(Config::get('Constant.DEFAULT_DATE_FORMAT'),strtotime(str_replace('/','-',$testimonials->dtStartDateTime))):date(Config::get('Constant.DEFAULT_DATE_FORMAT'))}}" readonly>

                                                    <label class="form_title" for="testimonial">{{ trans('template.testimonialModule.testimonialDate') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="image_thumb">
                                                <div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }} ">
                                                    <label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }}</label>
                                                    <div class="clearfix"></div>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail testimonial_image_img" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
                                                            @if(Input::old('image_url'))
                                                            <img src="{{ Input::old('image_url') }}" />
                                                            @elseif(!empty($testimonials->fkIntImgId) && $testimonials->fkIntImgId > 0)
                                                            <img src="{!! App\Helpers\resize_image::resize($testimonials->fkIntImgId) !!}" />
                                                            @else
                                                            <img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
                                                            @endif
                                                        </div>
                                                        <div class="input-group">
                                                            <a class="media_manager" onclick="MediaManager.open('testimonial_image');"><span class="fileinput-new"></span></a>
                                                        </div>
                                                        <input class="form-control" type="hidden" id="testimonial_image" name="img_id" value="{{ (isset($testimonials->fkIntImgId)?$testimonials->fkIntImgId:Input::old('img_id')) }}" />
                                                        <input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                @php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>{{ trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) }}</span>
                                                <span style="color: red;">
                                                    <strong>{{ $errors->first('img_id') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group @if($errors->first('testimonial')) has-error @endif">
                                                <label class="form_title" for="testimonial">{{ trans('template.testimonialModule.testimonial') }} <span aria-required="true" class="required"> * </span></label>
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('testimonial') }}</strong>
                                                </span>
                                                {!! Form::textarea('testimonial',isset($testimonials->txtDescription)?$testimonials->txtDescription:old('testimonial'),array('class' => 'form-control','id'=>'txtDescription','palceholder'=>trans('template.testimonialModule.testimonial'),'style'=>'max-height:80px;')) !!}
                                            </div>
                                        </div>
                                    </div>
                                
                                     <div class="row">
                                         <div class="col-md-12">
                                            @if(isset($testimonials->id))
                                            @php $dchecked = '' @endphp
                                            @else
                                            @php $dchecked = 'checked' @endphp
                                            @endif
                                            @if (Input::old('chrShowHomePage') == 'Y' || (isset($testimonials->chrShowHomePage) && $testimonials->chrShowHomePage=='Y'))
                                            @php $dchecked_yes = 'checked' @endphp
                                            @else
                                            @php $dchecked_yes = '' @endphp
                                            @endif
                                            <div class="form-group">
                                                <label class="form_title" for="testimonial">{{ trans('template.testimonialModule.displayinhomepage') }}</label>
                                                    <input type="checkbox" id="testimonial" name="chrShowHomePage" value="Y" {{$dchecked}} {{ $dchecked_yes }}/>
                                            </div>
                                        </div>
                                    </div>

                                    <h3>{{ trans('template.common.displayinformation') }}</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @php
                                            $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                            if(!isset($testimonials->intDisplayOrder)){
                                            $display_order_attributes['readonly'] = "readonly";
                                            } 
                                            @endphp
                                            <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                                                {!! Form::text('display_order', isset($testimonials->intDisplayOrder)?$testimonials->intDisplayOrder:$total, $display_order_attributes) !!}
                                                <label class="form_title" for="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
                                                <span style="color: red;">
                                                    <strong>{{ $errors->first('display_order') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @include('powerpanel.partials.displayInfo',['display' => isset($testimonials->chrPublish)?$testimonials->chrPublish:null])
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                            <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                            <a class="btn btn-outline red" href="{{ url('powerpanel/testimonial') }}">{{ trans('template.common.cancel') }}</a>
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
@endsection
@section('scripts')
@include('powerpanel.partials.ckeditor')
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/testimonial_validations.js') }}" type="text/javascript"></script>
<script type="text/javascript">
                                                                window.site_url = '{!! url("/") !!}';
                                                                var moduleAlias = 'testimonials';
                                                                $(document).ready(function() {
                                                                    $('.datepicker').datepicker({
                                                                        autoclose: true,
                                                                        endDate: new Date(),
                                                                        format: DEFAULT_DT_FMT_FOR_DATEPICKER
                                                                    });
                                                                });
                                                                $('.date-set,.datepicker').click(function() {
                                                                    $('.datepicker').datepicker('show');
                                                                });
</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
@endsection