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
                                        {!! Form::open(['method' => 'post','id'=>'frmDeals']) !!}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @permission('deals-list')
                                                    @include('powerpanel.partials.dealscategory',['dealcategories'=>$DealsCategory, 'data'=>isset($deals)?$deals:null])
                                                    @endpermission
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @permission('product-category-list')
                                                    @include('powerpanel.partials.category',['categories'=>$ProductCategory, 'data'=>isset($deals)?$deals:null])
                                                    @endpermission
                                                </div>
                                            </div>
                                            <div class="row" id="product_div" style="display: none">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('product_id')) has-error @endif">                                                                            
                                                        <label class="form_title" for="product_id">{{ trans('template.common.selectproduct') }} <span aria-required="true" class="required"> * </span></label>
                                                        <select id="product_id" class="form-control" name="product_id[]" multiple>

                                                        </select>
                                                        <span class="help-block">
                                                            {{ $errors->first('product_id') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="dealtype_div">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('dealtype_id')) has-error @endif">                                                                            
                                                        <label class="form_title" for="dealtype_id">{{ trans('template.dealsModule.selectdealtype') }} <span aria-required="true" class="required"> * </span></label>
                                                        <select id="dealtype_id" class="form-control" name="dealtype_id">

                                                        </select>
                                                        <span class="help-block">
                                                            {{ $errors->first('dealtype_id') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                                                        {!! Form::text('title', isset($deals->varTitle)?$deals->varTitle:old('title'), array('maxlength' => 150,'id'=>'title', 'class' => 'form-control maxlength-handler','placeholder' => trans('template.common.title'),'autocomplete'=>'off','data-url' => 'powerpanel/deals')) !!}
                                                        <label class="form_title" for="title">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('title') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('tag_line') ? ' has-error' : '' }}  form-md-line-input" id="tag_line_div">
                                                        {!! Form::text('tag_line', isset($deals->varTagLine)?$deals->varTagLine:old('tag_line'), array('maxlength' => 160,'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/deals','id' => 'tag_line','placeholder' => trans('template.common.tagline'),'autocomplete'=>'off')) !!}
                                                        <label class="form_title" for="tag_line">{!! trans('template.common.tagline') !!} <span aria-required="true" class="required"> * </span></label>
                                                        <span style="color:#e73d4a">
                                                            {{ $errors->first('tag_line') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('listing_icon') ? ' has-error' : '' }}  form-md-line-input">
                                                        {!! Form::text('listing_icon', isset($deals->varListingIcon)?$deals->varListingIcon:old('listing_icon'), array('maxlength' => 160,'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/deals','id' => 'listing_icon','placeholder' => trans('template.dealsModule.listing_icon'),'autocomplete'=>'off')) !!}
                                                        <label class="form_title" for="listing_icon">{!! trans('template.dealsModule.listing_icon') !!}</label>
                                                        <span style="color:#e73d4a">
                                                            {{ $errors->first('listing_icon') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('inr_price') ? ' has-error' : '' }}  form-md-line-input">
                                                        {!! Form::text('inr_price', isset($deals->varDealsINRPrice)?$deals->varDealsINRPrice:old('inr_price'), array('maxlength' => 160,'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/deals','id' => 'inr_price','placeholder' => trans('template.dealsModule.inr_price'),'autocomplete'=>'off')) !!}
                                                        <label class="form_title" for="inr_price">{!! trans('template.dealsModule.inr_price') !!} </label>
                                                        <span style="color:#e73d4a">
                                                            {{ $errors->first('inr_price') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('usd_price') ? ' has-error' : '' }}  form-md-line-input">
                                                        {!! Form::text('usd_price', isset($deals->varDealsUSDPrice)?$deals->varDealsUSDPrice:old('usd_price'), array('maxlength' => 160,'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/deals','id' => 'usd_price','placeholder' => trans('template.dealsModule.usd_price'),'autocomplete'=>'off')) !!}
                                                        <label class="form_title" for="usd_price">{!! trans('template.dealsModule.usd_price') !!} </label>
                                                        <span style="color:#e73d4a">
                                                            {{ $errors->first('usd_price') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ((isset($deals->varDiscountType) && $deals->varDiscountType == 'Percentage') || old('Percentage_discount') == 'Percentage')
                                            @php $checked_yes = 'checked' @endphp
                                            @else
                                            @php $checked_yes = '' @endphp
                                            @endif
                                            @if ((isset($deals->varDiscountType) && $deals->varDiscountType == 'Fixed') || old('Fixed_discount') == 'Fixed' || (!isset($deals->varDiscountType) && old('Fixed_discount') == null))
                                            @php $ichecked_innerbaner_yes = 'checked' @endphp
                                            @else
                                            @php $ichecked_innerbaner_yes = '' @endphp
                                            @endif
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('discountType') ? ' has-error' : '' }}">
                                                        <label class="form_title" for="banner_type">{!! trans('template.dealsModule.discounttype') !!} <span aria-required="true" class="required"> * </span></label>
                                                        <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                <input type="radio" {{ $checked_yes }}  value="Percentage" id="Percentage_discount" name="discountType" class="md-radiobtn banner">
                                                                <label for="Percentage_discount">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> {!! trans('template.dealsModule.percentage') !!}
                                                                </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" {{ $ichecked_innerbaner_yes }} value="Fixed" id="Fixed_discount" name="discountType" class="md-radiobtn banner">
                                                                <label for="Fixed_discount">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> {!! trans('template.dealsModule.fixed') !!}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('discountType') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" id="Percentage_discount_div">
                                                    <div class="form-group {{ $errors->has('discount_percentage') ? ' has-error' : '' }} form-md-line-input">                                                
                                                        {!! Form::text('discount_percentage',isset($deals->discount_percentage)?$deals->discount_percentage:old('discount_percentage'), array('class' => 'form-control','id'=>'discount_percentage','placeholder'=>trans('template.common.discountpercentage'),'style'=>'max-height:80px;', 'onkeypress'=>"javascript: return KeycheckOnlyPhonenumber(event);")) !!}
                                                        <label class="form_title" for="discount_percentage">{!! trans('template.common.discountpercentage') !!} <span aria-required="true" class="required"> * </span></label>
                                                        <span style="color:#e73d4a">
                                                            {{ $errors->first('discount_percentage') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="Fixed_discount_div">
                                                    <div class="form-group {{ $errors->has('discount_fixed') ? ' has-error' : '' }} form-md-line-input">                                                
                                                        {!! Form::text('discount_fixed',isset($deals->discount_fixed)?$deals->discount_fixed:old('discount_fixed'), array('class' => 'form-control','id'=>'discount_fixed','placeholder'=>trans('template.common.discountfixed'),'style'=>'max-height:80px;', 'onkeypress'=>"javascript: return KeycheckOnlyPhonenumber(event);")) !!}
                                                        <label class="form_title" for="discount_fixed">{!! trans('template.common.discountfixed') !!} <span aria-required="true" class="required"> * </span></label>
                                                        <span style="color:#e73d4a">
                                                            {{ $errors->first('discount_fixed') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('promo_code') ? ' has-error' : '' }} form-md-line-input">                                                
                                                {!! Form::text('promo_code',isset($deals->varpromo_code)?$deals->varpromo_code:old('promo_code'), array('class' => 'form-control','id'=>'promo_code','placeholder'=>trans('template.dealsModule.promocode'),'style'=>'max-height:80px;')) !!}
                                                <label class="form_title" for="promo_code">{!! trans('template.dealsModule.promocode') !!} <span aria-required="true" class="required"> * </span></label>
                                                <span style="color:#e73d4a">
                                                    {{ $errors->first('promo_code') }}
                                                </span>
                                            </div>
                                            <div class="form-group {{ $errors->has('popup_title') ? ' has-error' : '' }} form-md-line-input">                                                
                                                {!! Form::text('popup_title',isset($deals->varpopup_title)?$deals->varpopup_title:old('popup_title'), array('class' => 'form-control','id'=>'popup_title', 'placeholder'=>trans('template.dealsModule.popuptitle'), 'maxlength'=> '60', 'style'=>'max-height:80px;')) !!}
                                                <label class="form_title" for="popup_title">{!! trans('template.dealsModule.popuptitle') !!} <span aria-required="true" class="required"> * </span></label>
                                                <span style="color:#e73d4a">
                                                    {{ $errors->first('popup_title') }}
                                                </span>
                                            </div>                                                                                                                                
                                            {!! Form::hidden('varRefURL',URL::previous(),null) !!}                                                                                                                                                                                                 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('short_description', isset($deals->varShortDescription)?$deals->varShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control','id'=>'varShortDescription','rows'=>'3')) !!}
                                                        <label class="form_title">Popup Description <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">{{ $errors->first('short_description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group  {{ $errors->has('start_date') ? ' has-error' : '' }}  form-md-line-input">
                                                        @php $defaultDt = (null !== old('start_date'))?old('start_date'):date('Y-m-d g:i A'); @endphp
                                                        <div class="input-group date @if($errors->first('start_date')) has-error @endif" data-date="{{ date('Y-m-d H:i:s',strtotime(isset($deals->dtstart_date)?$deals->dtstart_date:$defaultDt)) }}">
                                                            <span class="input-group-btn date_default">
                                                                <button class="btn date-set" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                            {!! Form::text('start_date', date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime(isset($deals->dtstart_date)?$deals->dtstart_date:$defaultDt)), array('class' => 'form-control','id'=>'start_date','maxlength'=>100,'size'=>'100','readonly'=>true)) !!}
                                                            <label class="control-label form_title">Start {{ trans('template.dateandtime') }} <span aria-required="true" class="required"> * </span></label>                                                                            
                                                            <span class="help-block">{{ $errors->first('start_date') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group  {{ $errors->has('end_date') ? ' has-error' : '' }}  form-md-line-input">
                                                        @php $defaultDt = (null !== old('end_date'))?old('end_date'):date('Y-m-d g:i A'); @endphp
                                                        <div class="input-group date @if($errors->first('end_date')) has-error @endif" data-date="{{ date('Y-m-d H:i:s',strtotime(isset($deals->dtend_date)?$deals->dtend_date:$defaultDt)) }}">
                                                            <span class="input-group-btn date_default">
                                                                <button class="btn date-set" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                            {!! Form::text('end_date', date(Config::get('Constant.DEFAULT_DATE_FORMAT').' g:i A',strtotime(isset($deals->dtend_date)?$deals->dtend_date:$defaultDt)), array('class' => 'form-control','id'=>'end_date','maxlength'=>100,'size'=>'100','readonly'=>true)) !!}
                                                            <label class="control-label form_title">End {{ trans('template.dateandtime') }} <span aria-required="true" class="required"> * </span></label>
                                                        </div>
                                                        <span class="help-block">{{ $errors->first('end_date') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-md-12">
                                                    @if (Input::old('displayontop') == 'Y' || (isset($deals->chrDisplayontop) && $deals->chrDisplayontop=='Y'))
                                                    @php $dchecked_yes = 'checked' @endphp
                                                    @else
                                                    @php $dchecked_yes = '' @endphp
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="control-label form_title">Display on Top ? </label>
                                                        <input class="" type="checkbox" name="displayontop" id="displayontop" value="Y" {{ $dchecked_yes }}/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="homepage" style="display: none">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('home_page_delas_content')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('home_page_delas_content', isset($deals->varHomePageDealsContent)?$deals->varHomePageDealsContent:old('home_page_delas_content'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:500,'placeholder' => trans('template.common.homepagedealscontent'), 'class' => 'form-control','id'=>'varHomePageDealsContent','rows'=>'3')) !!}
                                                         <label class="form_title" for="home_page_delas_content">{!! trans('template.common.homepagedealscontent') !!}</label>
                                                        <span class="help-block">{{ $errors->first('home_page_delas_content') }}</span>
                                                    </div>
                                                </div>
                                                 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('popuptag_line') ? ' has-error' : '' }}  form-md-line-input" id="tag_line_div">
                                                        {!! Form::text('popuptag_line', isset($deals->varPopupTagLine)?$deals->varPopupTagLine:old('popuptag_line'), array('maxlength' => 160,'class' => 'form-control input-sm maxlength-handler', 'data-url' => 'powerpanel/deals','id' => 'popuptag_line','placeholder' => 'Popup '.trans('template.common.tagline'),'autocomplete'=>'off')) !!}
                                                        <label class="form_title" for="popuptag_line">Popup {!! trans('template.common.tagline') !!} <span aria-required="true" class="required"> * </span></label>
                                                        <span style="color:#e73d4a">
                                                            {{ $errors->first('popuptag_line') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">                                                                        
                                                    <div class="form-group @if($errors->first('button_link')) has-error @endif form-md-line-input">
                                                        {!! Form::text('button_link', isset($deals->varbutton_link)?$deals->varbutton_link:old('button_link'), array('maxlength' => 150, 'class' => 'form-control','autocomplete'=>'off','id' => 'button_link','placeholder' => trans('template.common.link'),'data-url' => 'powerpanel/deals')) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.bannerModule.buttonlink') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('button_link') }}
                                                        </span>
                                                    </div>
                                                </div>                                                                    
                                            </div>

                                            <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @php
                                                    $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                                    if(!isset($deals->intDisplayOrder)){
                                                    $display_order_attributes['readonly'] = "readonly";
                                                    } 
                                                    @endphp
                                                    <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                                                        {!! Form::text('display_order',  isset($deals->intDisplayOrder)?$deals->intDisplayOrder:$total, $display_order_attributes) !!}
                                                        <label class="form_title" for="site_name">{{ trans('template.common.displayorder') }}<span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('display_order') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @include('powerpanel.partials.displayInfo',['display' => isset($deals->chrPublish)?$deals->chrPublish:null ])
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                                    <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                                    <a class="btn btn-outline red" href="{{ url('powerpanel/deals') }}">{{ trans('template.common.cancel') }}</a>
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
@include('powerpanel.partials.addCat',['module' => 'deals-category','categoryHeirarchy' =>''])
@endsection
@section('scripts')
<script type="text/javascript">
    window.site_url = '{!! url("/") !!}';
    var seoFormId = 'frmDeals';
    var user_action = "{{ isset($deals)?'edit':'add' }}";
    var moduleAlias = 'deals';
    var categoryAllowed = false;
            @permission('deals-category-list')
            categoryAllowed = true;
            @endpermission
</script>

<script type="text/javascript">
        $(document).ready(function() {
        if (document.getElementById('displayontop').checked == true)
        {
            $("#homepage").show();
        }
        $(function() {
            $("#displayontop").click(function() {
                if ($(this).is(":checked")) {
                    $("#homepage").show();
                } else {
                    $("#homepage").hide();
                }
            });
        });
    });
</script>
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<!--<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ url('resources/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ url('resources/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!--<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>-->
<script src="{{ url('resources/pages/scripts/deals_validations.js') }}" type="text/javascript"></script>
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
        format: DEFAULT_DT_FMT_FOR_DATEPICKER + ' HH:ii P'
    }).on("changeDate", function(e) {
        $("input[name=start_date]").closest('.has-error').removeClass('has-error');
        $("#start_date_time-error").remove();
    });
    $('input[name=end_date]').datetimepicker({
        autoclose: true,
        showMeridian: true,
        minuteStep: 5,
        format: DEFAULT_DT_FMT_FOR_DATEPICKER + ' HH:ii P'
    }).on("changeDate", function(e) {
        $("input[name=end_date]").closest('.has-error').removeClass('has-error');
        $("#end_date_time-error").remove();
    });
    $('.date-set,input[name=start_date]').click(function() {
        $('input[name=start_date]').datetimepicker('show');
    });
    $('.date-set,input[name=end_date]').click(function() {
        $('input[name=end_date]').datetimepicker('show');
    });
</script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection