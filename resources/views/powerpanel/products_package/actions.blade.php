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
                                        {!! Form::open(['method' => 'post','id'=>'frmProductPackage']) !!}
                                        <div class="form-body">
                                            {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                                            @permission('product-category-list')
                                            @include('powerpanel.partials.category',['categories'=>$ProductCategory, 'data'=>isset($product)?$product:null])
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
                                                    <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                                                        {!! Form::text('title', isset($product->varTitle)?$product->varTitle:old('title'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.common.title'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('title') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                             
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_one_month_inr')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_one_month_inr', isset($product->intOldPriceOneMonthINR)?$product->intOldPriceOneMonthINR:old('old_price_one_month_inr'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpriceonemonthinr'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpriceonemonthinr') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_one_month_inr') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_three_month_inr')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_three_month_inr', isset($product->intOldPriceThreeMonthINR)?$product->intOldPriceThreeMonthINR:old('old_price_three_month_inr'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpricethreemonthinr'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpricethreemonthinr') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_three_month_inr') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_six_month_inr')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_six_month_inr', isset($product->intOldPriceSixMonthINR)?$product->intOldPriceSixMonthINR:old('old_price_six_month_inr'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpricesixmonthinr'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpricesixmonthinr') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_six_month_inr') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_one_year_inr')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_one_year_inr', isset($product->intOldPriceOneYearINR)?$product->intOldPriceOneYearINR:old('old_price_one_year_inr'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpriceoneyearinr'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpriceoneyearinr') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_one_year_inr') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_two_year_inr')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_two_year_inr', isset($product->intOldPriceTwoYearINR)?$product->intOldPriceTwoYearINR:old('old_price_two_year_inr'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpricetwoyearinr'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpricetwoyearinr') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_two_year_inr') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_three_year_inr')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_three_year_inr', isset($product->intOldPriceThreeYearINR)?$product->intOldPriceThreeYearINR:old('old_price_three_year_inr'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpricethreeyearinr'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpricethreeyearinr') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_three_year_inr') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_one_month_usd')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_one_month_usd', isset($product->intOldPriceOneMonthUSD)?$product->intOldPriceOneMonthUSD:old('old_price_one_month_usd'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpriceonemonthusd'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpriceonemonthusd') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_one_month_usd') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_three_month_usd')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_three_month_usd', isset($product->intOldPriceThreeMonthUSD)?$product->intOldPriceThreeMonthUSD:old('old_price_three_month_usd'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpricethreemonthusd'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpricethreemonthusd') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_three_month_usd') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_six_month_usd')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_six_month_usd', isset($product->intOldPriceSixMonthUSD)?$product->intOldPriceSixMonthUSD:old('old_price_six_month_usd'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpricesixmonthusd'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpricesixmonthusd') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_six_month_usd') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_one_year_usd')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_one_year_usd', isset($product->intOldPriceOneYearUSD)?$product->intOldPriceOneYearUSD:old('old_price_one_year_usd'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpriceoneyearusd'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpriceoneyearusd') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_one_year_usd') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_two_year_usd')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_two_year_usd', isset($product->intOldPriceTwoYearUSD)?$product->intOldPriceTwoYearUSD:old('old_price_two_year_usd'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpricetwoyearusd'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpricetwoyearusd') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_two_year_usd') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group @if($errors->first('old_price_three_year_usd')) has-error @endif form-md-line-input">
                                                        {!! Form::text('old_price_three_year_usd', isset($product->intOldPriceThreeYearUSD)?$product->intOldPriceThreeYearUSD:old('old_price_three_year_usd'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.oldpricethreeyearusd'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.oldpricethreeyearusd') }} </label>
                                                        <span class="help-block">
                                                            {{ $errors->first('old_price_three_year_usd') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('additional_offer')) has-error @endif form-md-line-input">
                                                        {!! Form::text('additional_offer', isset($product->varAdditionalOffer)?$product->varAdditionalOffer:old('additional_offer'), array('maxlength' => 160, 'class' => 'form-control maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/products-package','placeholder' => trans('template.productpackageModule.additionaloffer'))) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.productpackageModule.additionaloffer') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('additional_offer') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('specification')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('specification', isset($product->txtSpecification)?$product->txtSpecification:old('specification'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:500,'class' => 'form-control maxlength-handler','id'=>'specification','rows'=>'3','placeholder' => trans('template.productpackageModule.specification'))) !!}
                                                        <label class="form_title">{{ trans('template.productpackageModule.specification') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">{{ $errors->first('specification') }}</span>
                                                        <div class="clearfix"></div>
                                                        <span style="margin-top: 20px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Please press enter key to add new specification*</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('additional_note')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('additional_note', isset($product->txtShortDescription)?$product->txtShortDescription:old('additional_note'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control maxlength-handler','id'=>'additional_note','rows'=>'3','placeholder' => trans('template.productpackageModule.additionalnote'))) !!}
                                                        <label class="form_title">{{ trans('template.productpackageModule.additionalnote') }}</label>
                                                        <span class="help-block">{{ $errors->first('additional_note') }}</span>
                                                        <div class="clearfix"></div>
                                                        <span style="margin-top: 20px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Please press enter key to add new additional note*</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('recommandation_note')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('recommandation_note', isset($product->txtRecommandedFeatures)?$product->txtRecommandedFeatures:old('recommandation_note'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control maxlength-handler','id'=>'recommandation_note','rows'=>'3','placeholder' => trans('template.productModule.recommndationnote'))) !!}
                                                        <label class="form_title">{{ trans('template.productModule.recommndationnote') }}</label>
                                                        <span class="help-block">{{ $errors->first('recommandation_note') }}</span>
                                                        <div class="clearfix"></div>
                                                        <span style="margin-top: 20px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Please press enter key to add new recommandation features*</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('whmcs_category_id')) has-error @endif">
                                                        <label class="form_title" for="whmcs_category_id">Select WHMCS Category <span aria-required="true" class="required"> * </span></label>
                                                        <select id="whmcs_category_id" class="form-control" name="whmcs_category_id" onchange="getwhmcsProduct();">	
                                                            <option value=" ">Select WHMCS Product Category</option>

                                                            @if(count($HostingPlanData['groups']) > 0)
                                                            @foreach ($HostingPlanData['groups'] as $hostdata)

                                                            <option data-model="{{ $hostdata['name'] }}" data-module="{{ $hostdata['name'] }}" value="{{ $hostdata['id'] }}" {{ (isset($product->fkWhmcsProductCategories) && $hostdata['id'] == $product->fkWhmcsProductCategories) ? 'selected' : '' }} >{{ $hostdata['name'] }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="help-block">
                                                            {{ $errors->first('whmcs_category_id') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                            if(isset($product->fkWhmcsProduct)){
                                            $whm_div = "";
                                            } else {
                                            $whm_div = "display: none";
                                            }
                                            @endphp
                                            <div class="row" id="whmcs_product_div" style="{{$whm_div}}">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('whmcs_product_id')) has-error @endif">                                                                            
                                                        <label class="form_title" for="whmcs_product_id">Select WHMCS Product <span aria-required="true" class="required"> * </span></label>
                                                        <select id="whmcs_product_id" class="form-control" name="whmcs_product_id">
                                                            @if(isset($product->fkWhmcsProduct))
                                                            <option value=" ">Select WHMCS Product</option>
                                                            @if(count($HostingProductDataArray) > 0)
                                                            @foreach ($HostingProductDataArray as $hostdata)

                                                            <option data-model="{{ $hostdata['text'] }}" data-module="{{ $hostdata['text'] }}" value="{{ $hostdata['id'] }}" {{ (isset($product->fkWhmcsProduct) && $hostdata['id'] == $product->fkWhmcsProduct) ? 'selected' : '' }} >{{ $hostdata['text'] }}</option>
                                                            @endforeach
                                                            @endif
                                                            @endif
                                                        </select>
                                                        <span class="help-block">
                                                            {{ $errors->first('whmcs_product_id') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if (Input::old('displayontop') == 'Y' || (isset($product->chrDisplayontop) && $product->chrDisplayontop=='Y'))
                                                    @php $dchecked_yes = 'checked' @endphp
                                                    @else
                                                    @php $dchecked_yes = '' @endphp
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="control-label form_title">Display as a Recommended? </label>
                                                        <input class="" type="checkbox" name="displayontop" id="displayontop" value="Y" {{ $dchecked_yes }}/>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @php
                                                    $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                                    if(!isset($product->intDisplayOrder)){
                                                    $display_order_attributes['readonly'] = "readonly";
                                                    }
                                                    @endphp
                                                    <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                                                        {!! Form::text('display_order', isset($product->intDisplayOrder)?$product->intDisplayOrder:$total, $display_order_attributes) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            {{ $errors->first('display_order') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @include('powerpanel.partials.displayInfo',['display' => isset($product->chrPublish)?$product->chrPublish:'Y'])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                                    <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                                    <a class="btn btn-outline red" href="{{ url('powerpanel/products-package') }}">{{ trans('template.common.cancel') }}</a>
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
@include('powerpanel.partials.addCat',['module' => 'product-category','categoryHeirarchy' => $categoryHeirarchy])
@endsection
@section('scripts')
<script type="text/javascript">
    window.site_url = '{!! url("/") !!}';
    var seoFormId = 'frmProductPackage';
    var user_action = "{{ isset($product)?'edit':'add' }}";
    var moduleAlias = 'products-package';
    var categoryAllowed = false;
            @permission('product-category-list')
            categoryAllowed = true;
            @endpermission

            function getwhmcsProduct() {
                jQuery.ajax({
                    type: "POST",
                    url: window.site_url + '/powerpanel/products-package/getWHMCSProductAjax',
                    data: {
                        "whmcs_prod_catval": $('#whmcs_category_id').val(),
                    },
                    async: false,
                    success: function(result) {
                        if (result != '' && result != 'false') {
                            $('#whmcs_product_div').show();
                            $("#whmcs_product_id").select2().empty();
                            $.when(
                                    $("#whmcs_product_id").select2({
                                placeholder: "Select WHMCS Product",
                                dataAdapter: customAdapter,
                                data: result
                            }).on("select2:opening select2:closing", function(e) {
                                //$('.select2-dropdown li[role=group] strong').hide();			
                            }).on("change.select2", function(e) {
                                setSelectedOptions(result);
                            })
                                    ).done(function() {

                                $("#whmcs_product_id").select2('val', selectedPro);
                            });
                        }
                    }
                });
            }
</script>

<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>

<!-- BEGIN CORE PLUGINS -->
<script src="{{ url('resources/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ url('resources/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ url('resources/pages/scripts/products_package_validations.js') }}" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
@endsection