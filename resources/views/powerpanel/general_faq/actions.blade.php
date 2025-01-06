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
                                    {!! Form::open(['method' => 'post','id'=>'frmGeneralFaqs']) !!}
                                    {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            @permission('general-faq-list')
                                            @include('powerpanel.partials.faqcategory',['faqCategory'=>$faqCategory, 'data'=>isset($generalfaq)?$generalfaq:null])
                                            @endpermission
                                        </div>
                                    </div>
                                    <div class="form-group @if($errors->first('tag_line')) has-error @endif form-md-line-input">
                                        {!! Form::text('question', isset($generalfaq->varTitle) ? $generalfaq->varTitle:old('question'), array('maxlength'=>'150','placeholder' => trans('template.common.question'),'class' => 'form-control seoField maxlength-handler','autocomplete'=>'off')) !!}
                                        <label class="form_title" for="site_name">{{ trans('template.common.question') }} <span aria-required="true" class="required"> * </span></label>
                                        <span style="color: red;">
                                            <strong>{{ $errors->first('question') }}</strong>
                                        </span>
                                    </div>	

                                    <div class="form-group @if($errors->first('tag_line')) has-error @endif form-md-line-input">
                                        <label class="form_title">{{ trans('template.common.answer') }} <span aria-required="true" class="required"> * </span></label>
                                        {!! Form::textarea('answer', isset($generalfaq->txtDescription)?$generalfaq->txtDescription:old('answer'), array('placeholder' => trans('template.common.answer'),'class' => 'form-control','id'=>'txtDescription')) !!}
                                        <span style="color: red;">{{ $errors->first('answer') }}</span>
                                    </div>
                                    <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>	
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @if($errors->first('order')) has-error @endif form-md-line-input">
                                                @php
                                                $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                                if(!isset($generalfaq->intDisplayOrder)){
                                                $display_order_attributes['readonly'] = "readonly";
                                                } 
                                                @endphp
                                                {!! Form::text('order', isset($generalfaq->intDisplayOrder)?$generalfaq->intDisplayOrder:$total, $display_order_attributes) !!}
                                                <label class="form_title" for="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
                                                <span style="color: red;">
                                                    <strong>{{ $errors->first('order') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @include('powerpanel.partials.displayInfo',['display' => isset($generalfaq->chrPublish)?$generalfaq->chrPublish:null])
                                        </div>
                                    </div>
                                    <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                    <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                    <a class="btn btn-outline red" href="{{ url('powerpanel/general-faq') }}">{{ trans('template.common.cancel') }}</a>
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
<script src="{{ url('resources/pages/scripts/general_faq_validations.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script type="text/javascript">
window.site_url = '{!! url("/") !!}';
var user_action = "{{ isset($generalfaq)?'edit':'add' }}";
var moduleAlias = 'general-faq';
</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
@endsection