@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('content')
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@include('powerpanel.partials.breadcrumbs')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div class="tabbable tabbable-tabdrop">
                    <div class="tab-content settings">
                        <div class="tab-pane active form_pattern" id="general">
                            {!! Form::open(['method' => 'post','id'=>'frmTld']) !!}
                            {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                            <div class="form-group @if($errors->first('name')) has-error @endif form-md-line-input">
                                {!! Form::text('name', isset($tld->varTitle)?$tld->varTitle:old('name'), array('maxlength'=>150, 'class' => 'hasAlias form-control seoField maxlength-handler', 'placeholder' => trans("template.common.name"),'autocomplete'=>'off','data-url' => 'powerpanel/tld')) !!}
                                <label class="form_title" for="site_name">{{ trans('template.common.name') }} <span aria-required="true" class="required"> * </span></label>
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            <!-- code for alias -->
                            {!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/tld')) !!}
                            {!! Form::hidden('alias', isset($tld->alias->varAlias)?$tld->alias->varAlias:old('alias') , array('class' => 'aliasField')) !!}
                            {!! Form::hidden('oldAlias', isset($tld->alias->varAlias)?$tld->alias->varAlias:old('alias')) !!}
                            <div class="form-group alias-group {{!isset($tld->alias->varAlias)?'hide':''}}">
                                <label class="form_title" for="Url">{{ trans('template.common.url') }} :</label>
                                <a href="javascript:void;" class="alias">{!! url("/") !!}</a>
                                <a href="javascript:void(0);" class="editAlias" title="{{ trans('template.common.edit') }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                &nbsp;
                                <a class="without_bg_icon openLink" title="{{ trans('template.common.openLink') }}" target="_blank" href="{{url('domain/'.isset($tld->alias->varAlias) && isset($tld) ? 'domain/'. $tld->alias->varAlias :'' )}}"><i class="fa fa-external-link" aria-hidden="true"></i></a>

                            </div>
                            <span class="help-block">{{ $errors->first('alias') }}</span>
                            <!-- code for alias -->
                            <div class="form-group @if($errors->first('icon')) has-error @endif form-md-line-input">
                                {!! Form::text('icon', isset($tld->varIcon)?$tld->varIcon:old('icon'), array('maxlength'=>100,'placeholder' => trans("template.tldModule.icon"),'class' => 'form-control','autocomplete'=>'off')) !!}
                                <label class="form_title" for="site_name">{{ trans('template.tldModule.icon') }}<span aria-required="true" class="required"> * </span></label>
                                <span class="help-block">{{ $errors->first('icon') }}</span>
                            </div>
                            
                            <div class="form-group @if($errors->first('offer')) has-error @endif form-md-line-input">
                                {!! Form::text('offer', isset($tld->varOffer)?$tld->varOffer:old('offer'), array('maxlength'=>100,'placeholder' => trans("template.tldModule.offer"),'class' => 'form-control','autocomplete'=>'off')) !!}
                                <label class="form_title" for="site_name">{{ trans('template.tldModule.offer') }}<span aria-required="true" class="required"> * </span></label>
                                <span class="help-block">{{ $errors->first('offer') }}</span>
                            </div>
                            
                             <div class="form-group @if($errors->first('country_name')) has-error @endif form-md-line-input">
                                {!! Form::text('country_name', isset($tld->varCountryName)?$tld->varCountryName:old('country_name'), array('maxlength'=>100,'placeholder' => trans("template.tldModule.country_name"),'class' => 'form-control','autocomplete'=>'off')) !!}
                                <label class="form_title" for="site_name">{{ trans('template.tldModule.country_name') }}<span aria-required="true" class="required"> * </span></label>
                                <span class="help-block">{{ $errors->first('country_name') }}</span>
                            </div>
                            
                            <div class="row" id="dealtype_div">
                                <div class="col-md-12">
                                    <div class="form-group @if($errors->first('TldCategory')) has-error @endif">                                                                            
                                        <label class="form_title" for="dealtype_id">{{ trans('template.tldModule.selectdealtype') }} <span aria-required="true" class="required"> * </span></label>
                                        <select id="TldCategory" class="form-control bs-select select2" name="TldCategory[]" multiple>
                                             <option value="">Select Tld Category</option>
                                            @foreach($TldCategory as $cat)
                                            <option value="{{$cat->id}}" {{ (in_array($cat->id ,$TldCategoryselect))? 'selected':'' }} >{{$cat->text}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">{{ $errors->first('TldCategory') }} </span>  
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('featured') ? ' has-error' : '' }} ">
                                        <label  class="form_title" for="featured">{{ trans('template.common.featured') }} <span aria-required="true" class="required"> * </span></label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsFeatured) && $tld->chrIsFeatured == 'Y') || (null == Input::old('featured') || Input::old('featured') == 'Y'))
                                                @php  $checked_yes = 'checked'  @endphp
                                                @else
                                                @php  $checked_yes = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_yes }} value="Y" id="radio6" name="featured" class="md-radiobtn">
                                                <label for="radio6">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Yes
                                                </label>
                                            </div>
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsFeatured) && $tld->chrIsFeatured == 'N') || old('featured')=='N')
                                                @php  $checked_no = 'checked'  @endphp
                                                @else
                                                @php  $checked_no = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_no }} value="N" id="radio7" name="featured" class="md-radiobtn">
                                                <label for="radio7">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> No
                                                </label>
                                            </div>
                                        </div>
                                        <span class="help-block">
                                            {{ $errors->first('featured') }}
                                        </span>
                                        <div class="clearfix"></div>
                                        <span style="margin-top: 5px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Featured TLDs will appear on home page*</strong></span>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('landing') ? ' has-error' : '' }} ">
                                        <label  class="form_title" for="landing">{{ trans('template.common.landing') }} <span aria-required="true" class="required"> * </span></label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsLanding) && $tld->chrIsLanding == 'Y') || (null == Input::old('landing') || Input::old('landing') == 'Y'))
                                                @php  $checked_yes = 'checked'  @endphp
                                                @else
                                                @php  $checked_yes = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_yes }} value="Y" id="radio8" name="landing" class="md-radiobtn">
                                                <label for="radio8">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Yes
                                                </label>
                                            </div>
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsLanding) && $tld->chrIsLanding == 'N') || old('landing')=='N')
                                                @php  $checked_no = 'checked'  @endphp
                                                @else
                                                @php  $checked_no = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_no }} value="N" id="radio9" name="landing" class="md-radiobtn">
                                                <label for="radio9">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> No
                                                </label>
                                            </div>
                                        </div>
                                        <span class="help-block">
                                            {{ $errors->first('landing') }}
                                        </span>
                                        <div class="clearfix"></div>
                                        <span style="margin-top: 5px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Featured TLDs will appear on landing page*</strong></span>
                                    </div>
                                </div>

                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }} ">
                                        <label  class="form_title" for="country">{{ trans('template.common.country') }} <span aria-required="true" class="required"> * </span></label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsCountry) && $tld->chrIsCountry == 'Y') || (null == Input::old('country') || Input::old('country') == 'Y'))
                                                @php  $checked_yes = 'checked'  @endphp
                                                @else
                                                @php  $checked_yes = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_yes }} value="Y" id="radio10" name="country" class="md-radiobtn">
                                                <label for="radio10">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Yes
                                                </label>
                                            </div>
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsCountry) && $tld->chrIsCountry == 'N') || old('country')=='N')
                                                @php  $checked_no = 'checked'  @endphp
                                                @else
                                                @php  $checked_no = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_no }} value="N" id="radio11" name="country" class="md-radiobtn">
                                                <label for="radio11">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> No
                                                </label>
                                            </div>
                                        </div>
                                        <span class="help-block">
                                            {{ $errors->first('country') }}
                                        </span>
                                        <div class="clearfix"></div>
                                        <span style="margin-top: 5px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Featured TLDs will appear on country page*</strong></span>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('newtld') ? ' has-error' : '' }} ">
                                        <label  class="form_title" for="newtld">{{ trans('template.common.newtld') }} <span aria-required="true" class="required"> * </span></label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsNewTld) && $tld->chrIsNewTld == 'Y') || (null == Input::old('newtld') || Input::old('newtld') == 'Y'))
                                                @php  $checked_yes = 'checked'  @endphp
                                                @else
                                                @php  $checked_yes = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_yes }} value="Y" id="radio12" name="newtld" class="md-radiobtn">
                                                <label for="radio12">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Yes
                                                </label>
                                            </div>
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsNewTld) && $tld->chrIsNewTld == 'N') || old('newtld')=='N')
                                                @php  $checked_no = 'checked'  @endphp
                                                @else
                                                @php  $checked_no = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_no }} value="N" id="radio13" name="newtld" class="md-radiobtn">
                                                <label for="radio13">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> No
                                                </label>
                                            </div>
                                        </div>
                                        <span class="help-block">
                                            {{ $errors->first('newtld') }}
                                        </span>
                                        <div class="clearfix"></div>
                                        <span style="margin-top: 5px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Featured TLDs will appear on country page*</strong></span>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('offertld') ? ' has-error' : '' }} ">
                                        <label  class="form_title" for="offertld">{{ trans('template.common.offertld') }} <span aria-required="true" class="required"> * </span></label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsoffertld) && $tld->chrIsoffertld == 'Y') || (null == Input::old('offertld') || Input::old('offertld') == 'Y'))
                                                @php  $checked_yes = 'checked'  @endphp
                                                @else
                                                @php  $checked_yes = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_yes }} value="Y" id="radio14" name="offertld" class="md-radiobtn">
                                                <label for="radio14">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Yes
                                                </label>
                                            </div>
                                            <div class="md-radio">
                                                @if ((isset($tld->chrIsoffertld) && $tld->chrIsoffertld == 'N') || old('offertld')=='N')
                                                @php  $checked_no = 'checked'  @endphp
                                                @else
                                                @php  $checked_no = ''  @endphp
                                                @endif
                                                <input type="radio" {{ $checked_no }} value="N" id="radio15" name="offertld" class="md-radiobtn">
                                                <label for="radio15">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> No
                                                </label>
                                            </div>
                                        </div>
                                        <span class="help-block">
                                            {{ $errors->first('offertld') }}
                                        </span>
                                        <div class="clearfix"></div>
                                        <span style="margin-top: 5px;display: inline-block;font-size: 13px;font-style: italic;color: rgba(16, 128, 242, 0.89);"><strong>Note: Offered TLDs will appear on pricing page under domain offer*</strong></span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group {{ $errors->has('img_id') ? ' has-error' : '' }}">
                                <div class="image_thumb">
                                    <label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }} <span aria-required="true" class="required"> * </span> </label>
                                    <div class="clearfix"></div>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail member_image_img" data-trigger="fileinput" style="width:100%; height:120px;position: relative;">
                                            @if(Input::old('image_url'))
                                            <img src="{{ Input::old('image_url') }}" />
                                            @elseif(isset($tld->image))
                                            <img src="{!! App\Helpers\resize_image::resize($tld->image->id,50,50) !!}" />
                                            @else
                                            <img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <a class="media_manager" onclick="MediaManager.open('member_image');"><span class="fileinput-new"></span></a>
                                            @if(isset($tld->image->id))
                                            @php $imgId = $tld->image->id @endphp
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
                                    <div class="form-group form-md-line-input">
                                        {!! Form::textarea('short_description', isset($tld->txtShortDescription)?$tld->txtShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:500,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3','placeholder' => trans('template.common.shortdescription'))) !!}
                                        <label class="form_title">{{ trans('template.common.shortdescription') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if($errors->first('description')) has-error @endif">
                                        <label class="form_title" for="description">{{ trans('template.common.description') }} <span aria-required="true" class="required"> * </span> </label>
                                        <span class="help-block">{{ $errors->first('description') }}
                                        </span>
                                        {!! Form::textarea('description', isset($tld->txtDescription)?$tld->txtDescription:old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription','style'=>'max-height:80px;')) !!}
                                    </div>
                                </div>
                            </div>

                            @include('powerpanel.partials.seoInfo',['form'=>'frmTld','inf'=>isset($metaInfo)?$metaInfo:false])

                            <h3>{{ trans('template.common.displayinformation') }}</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    @php
                                    $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                    if(!isset($tld->intDisplayOrder)){
                                    $display_order_attributes['readonly'] = "readonly";
                                    } 
                                    @endphp
                                    <div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
                                        {!! Form::text('display_order', isset($tld->intDisplayOrder)?$tld->intDisplayOrder:$total, $display_order_attributes) !!}
                                        <label class="form_title" class="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
                                        <span style="color: red;">
                                            <strong>{{ $errors->first('display_order') }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @include('powerpanel.partials.displayInfo',['display' => isset($tld->chrPublish)?$tld->chrPublish:null])
                                </div>
                            </div>
                            <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                            <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                            <a class="btn btn-outline red" href="{{ url('powerpanel/tld') }}">{{ trans('template.common.cancel') }}</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script src="{{ url('resources/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/form-input-mask.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script type="text/javascript">
                                                window.site_url = '{!! url("/") !!}';
                                                var seoFormId = 'frmTld';
                                                var user_action = "{{ isset($tld)?'edit':'add' }}";
                                                var moduleAlias = 'domain';
                                                 $('#TldCategory').select2({
                                                            placeholder: "Select Tld Category",
                                                                    width: '100%'
                                                            }).on("change", function (e) {
                                                            $("#TldCategory").closest('.help-block').removeClass('help-block');
                                                                    $("#TldCategory-error").remove();
                                                                    });
</script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/tld_validations.js') }}" type="text/javascript"></script>
@endsection