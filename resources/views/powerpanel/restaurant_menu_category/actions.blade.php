@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
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
                                        {!! Form::open(['method' => 'post','id'=>'frmRestaurantMenuCategory']) !!}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
                                                        {!! Form::text('title', isset($restaurantMenuCategory->varTitle)?$restaurantMenuCategory->varTitle:old('title'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','data-url' => 'powerpanel/blog-category','placeholder' => 'Title','autocomplete'=>'off')) !!}
                                                        <label class="form_title" for="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- code for alias -->
                                                    {!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/blog-category')) !!}
                                                    {!! Form::hidden('alias', isset($restaurantMenuCategory->alias->varAlias) ? $restaurantMenuCategory->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
                                                    {!! Form::hidden('oldAlias', isset($restaurantMenuCategory->alias->varAlias) ? $restaurantMenuCategory->alias->varAlias:old('alias')) !!}
                                                    <div class="form-group alias-group {{!isset($restaurantMenuCategory->alias->varAlias)?'hide':''}}">
                                                        <label class="form_title" for="Url">Url :</label>
                                                        <a href="javascript:void;" class="alias">{!! url("/") !!}</a>
                                                        <a href="javascript:void(0);" class="editAlias" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('alias') }}</strong>
                                                    </span>
                                                    <!-- code for alias -->
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
                                                                    <input class="form-control" type="hidden" id="show_image" name="img_id" value="{{ isset($restaurantMenuCategory->fkIntImgId)?$restaurantMenuCategory->fkIntImgId:old('img_id') }}" />
                                                                    <input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            @if(!empty($restaurantMenuCategory->fkIntImgId) && isset($restaurantMenuCategory->fkIntImgId))
                                                            @php $imageArr = explode(',',$restaurantMenuCategory->fkIntImgId)  @endphp
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
                                                    <div class="image_thumb multi_upload_images">
                                                        <div class="form-group">
                                                            <label class="form_title">Select Documents</label>
                                                            <div class="clearfix"></div>
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
                                                                    <img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
                                                                </div>
                                                                <div class="input-group">
                                                                    <a class="document_manager multiple-selection" data-multiple=true onclick="MediaManager.openDocumentManager('product');"><span class="fileinput-new"></span></a>
                                                                    <input class="form-control" type="hidden" id="product" name="doc_id" value="{{ isset($restaurantMenuCategory->fkIntDocId)?$restaurantMenuCategory->fkIntDocId:old('doc_id') }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <span>(Recommended documents *.txt, *.pdf, *.doc, *.docx, *.ppt, *.xls formats are supported. Document should be maximum size of 10 MB.)</span>
                                                    </div>
                                                </div>
                                                @if(!empty($restaurantMenuCategory->fkIntDocId) && isset($restaurantMenuCategory->fkIntDocId))
                                                @php $docsArr = explode(',',$restaurantMenuCategory->fkIntDocId)  @endphp
                                                <div class="col-md-12" id="product_documents">
                                                    <div class="multi_image_list" id="multi_document_list">
                                                        <ul>
                                                            @foreach($docsArr as $key => $value)
                                                            <li id="doc_{{ $value }}">
                                                                <span>
                                                                    <img  src="{{ url('/assets/images/document_icon.png') }}" alt="Img" />
                                                                    <a href="javascript:;" onclick="MediaManager.removeDocumentFromGallery('{{ $value }}');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
                                                                </span>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="col-md-12" id="product_documents"></div>
                                                @endif
                                            </div>



                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form_title" for="parent_category_id">{{ trans('template.common.selectparentcategory') }}</label>
                                                        @php echo $categories; @endphp
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
                                                        {!! Form::textarea('short_description', isset($restaurantMenuCategory->txtShortDescription)?$restaurantMenuCategory->txtShortDescription:old('short_description'), array('maxlength' => isset($settings->short_desc_length)?$settings->short_desc_length:400,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3')) !!}
                                                        <label class="form_title">{{ trans('template.common.shortdescription') }} <span aria-required="true" class="required"> * </span></label>
                                                        <span class="help-block">{{ $errors->first('short_description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group @if($errors->first('description')) has-error @endif ">
                                                        <label class="control-label form_title">{{ trans('template.common.description') }}</label>
                                                        {!! Form::textarea('description', isset($restaurantMenuCategory->txtDescription) ? $restaurantMenuCategory->txtDescription : old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
                                                        <span class="help-block">{{ $errors->first('description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class=" form-md-line-input nopadding">															
                                                        @include('powerpanel.partials.seoInfo',['form'=>'frmRestaurantMenuCategory','inf'=>isset($metaInfo)?$metaInfo:false,'metaRequired'=>false])
                                                    </div>
                                                </div>
                                            </div>																										
                                            <h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
                                            <div class="row">	
                                                <div class="col-md-6">
                                                    @php
                                                    $display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
                                                    if(!isset($restaurantMenuCategory->intDisplayOrder)){
                                                    $display_order_attributes['readonly'] = "readonly";
                                                    } 
                                                    @endphp
                                                    <div class="form-group @if($errors->first('order')) has-error @endif form-md-line-input">
                                                        {!! Form::text('order', isset($restaurantMenuCategory->intDisplayOrder)?$restaurantMenuCategory->intDisplayOrder:$total, $display_order_attributes) !!}
                                                        <label class="form_title" class="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label> 
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('order') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>																												 	

                                                @if($hasRecords==0 && $isParent==0)
                                                <div class="col-md-6">												  
                                                    @include('powerpanel.partials.displayInfo',['display' => isset($blog->chrPublish)?$blog->chrPublish:null])
                                                </div>														
                                                @else
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label form_title"> Publish/ Unpublish </label>

                                                        @if($hasRecords > 0)
                                                        <p><b>NOTE:</b> This category is selected in {{$hasRecords}} record(s) so it can&#39;t be unpublished.</p>
                                                        @endif

                                                        @if($isParent > 0)
                                                        <p><b>NOTE:</b> This category is selected as Parent Category in {{$isParent}} record(s) so it can&#39;t be deleted or unpublished.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
                                                    <button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
                                                    <a class="btn btn-outline red" href="{{ url('powerpanel/restaurant-menu-category') }}">{{ trans('template.common.cancel') }}</a>
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
                            var seoFormId = 'frmRestaurantMenuCategory';
                            var user_action = "{{ isset($restaurantMenuCategory)?'edit':'add' }}";
                            var moduleAlias = 'restaurant-menu';</script>
@include('powerpanel.partials.ckeditor')
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="{{ url('resources/pages/scripts/restaurant-menu-category-validations.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection