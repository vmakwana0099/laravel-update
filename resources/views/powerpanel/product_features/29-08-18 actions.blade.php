@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@stop
@section('content')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@include('powerpanel.partials.breadcrumbs')
<div class="col-md-12 settings">
    <div class="row">
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
                                <div class="portlet-body form_pattern">
                                    {!! Form::open(['method' => 'post','id'=>'frmProductFeatures']) !!}
                                    {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                                    @permission('product-category-list')
                                    @include('powerpanel.partials.category',['categories'=>$ProductCategory, 'data'=>isset($productfeatures)?$productfeatures:null])
                                    @endpermission
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('LandingPage') ? ' has-error' : '' }} ">
                                                <!--<label  class="form_title" for="LandingPage">{{ trans('template.common.LandingPage') }} <span aria-required="true" class="required"> * </span></label>-->
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        @if ((isset($productfeatures->chrLandingPage) && $productfeatures->chrLandingPage == 'Y') || (null == Input::old('LandingPage') || Input::old('LandingPage') == 'Y'))
                                                        @php  $checked_yes = 'checked'  @endphp
                                                        @else
                                                        @php  $checked_yes = ''  @endphp
                                                        @endif
                                                        <input type="radio" {{ $checked_yes }} value="Y" id="radio6" name="LandingPage" class="md-radiobtn">
                                                        <label for="radio6">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> For Landing
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        @if ((isset($productfeatures->chrLandingPage) && $productfeatures->chrLandingPage == 'N') || old('LandingPage')=='N')
                                                        @php  $checked_no = 'checked'  @endphp
                                                        @else
                                                        @php  $checked_no = ''  @endphp
                                                        @endif
                                                        <input type="radio" {{ $checked_no }} value="N" id="radio7" name="LandingPage" class="md-radiobtn">
                                                        <label for="radio7">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> For Product
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="help-block">
                                                    {{ $errors->first('LandingPage') }}
                                                </span>
                                                <div class="clearfix"></div>
                                                <span style="margin-top: 5px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Showin at Category & Product page. *</strong></span>
                                            </div>
                                        </div>
                                    </div>
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
                                            <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                                                {!! Form::text('title', isset($productfeatures->varTitle) ? $productfeatures->varTitle:old('title'), array('maxlength'=>'150','placeholder' => trans('template.productfeaturesModule.title'),'class' => 'form-control seoField maxlength-handler','autocomplete'=>'off')) !!}
                                                <label class="form_title" for="title">{{ trans('template.productfeaturesModule.title') }} <span aria-required="true" class="required"> * </span></label>
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            </div>	
                                        </div>	
                                    </div>	
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group @if($errors->first('listing_icon')) has-error @endif form-md-line-input">
                                                {!! Form::text('listing_icon', isset($productfeatures->varIconClass)?$productfeatures->varIconClass:old('listing_icon'), array('maxlength' => 150, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','placeholder' => trans('template.productfeaturesModule.listingiconclass'))) !!}
                                                <label class="form_title" class="site_name">{{ trans('template.productfeaturesModule.listingiconclass') }} <span aria-required="true" class="required"> * </span></label>
                                                <span class="help-block">
                                                    {{ $errors->first('listing_icon') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
                                                {!! Form::textarea('short_description', isset($productfeatures->varShortDescription)?$productfeatures->varShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:500,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3','placeholder' => trans('template.common.shortdescription'))) !!}
                                                <label class="form_title">{{ trans('template.common.shortdescription') }} <span aria-required="true" class="required"> * </span></label>
                                                <span class="help-block">{{ $errors->first('short_description') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>	
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @if($errors->first('order')) has-error @endif form-md-line-input">
                                                @php
                                                $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                                if(!isset($productfeatures->intDisplayOrder)){
                                                $display_order_attributes['readonly'] = "readonly";
                                                } 
                                                @endphp
                                                {!! Form::text('order', isset($productfeatures->intDisplayOrder)?$productfeatures->intDisplayOrder:$total, $display_order_attributes) !!}
                                                <label class="form_title" for="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
                                                <span style="color: red;">
                                                    <strong>{{ $errors->first('order') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @include('powerpanel.partials.displayInfo',['display' => isset($productfeatures->chrPublish)?$productfeatures->chrPublish:null])
                                        </div>
                                    </div>
                                    <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                    <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                    <a class="btn btn-outline red" href="{{ url('powerpanel/product-features') }}">{{ trans('template.common.cancel') }}</a>
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
<div class="clearfix"></div>
@endsection
@section('scripts')
<script src="{{ url('resources/pages/scripts/product_features_validations.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script type="text/javascript">
window.site_url = '{!! url("/") !!}';
var user_action = "{{ isset($productfeatures)?'edit':'add' }}";
var moduleAlias = 'product-features';
</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
@endsection