@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@stop
@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
<!-- BEGIN PAGE BASE CONTENT -->
{!! csrf_field() !!}
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        @if(Session::has('message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="portlet light portlet-fit portlet-datatable">
            {!! Form::hidden('categoryfilter',$CatData, array('id' => 'categoryfilter')) !!}
            @if($iTotalRecords > 0)
            <div class="portlet-title select_box">
                <span class="title">{{ trans('template.common.filterby') }}:</span>
                <select id="statusfilter" data-sort data-order class="bs-select select2">
                    <option value=" ">{{ trans('template.common.selectstatus') }}</option>
                    <option value="Y">{{ trans('template.common.publish') }}</option>
                    <option value="N">{{ trans('template.common.unpublish') }}</option>
                </select>
                 @permission('product-category-list')
                @if(isset($productCategory))
                <select class="form-control bs-select select2" id="category_id" name="category_id">
                    <option value=" ">--{{ trans('template.common.selectcategory') }}--</option>
                    @if(count($productCategory)>0)
                    @foreach($productCategory as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == Input::old('category_id') || app('request')->input('category')==$category->id)? 'selected' : '' }}>{{ $category->varTitle }}</option>
                    @endforeach
                    @else
                    <option value=" ">{{ trans('template.common.pleaseaddcategory') }}</option>
                    @endif
                </select>
                @endif
                @endpermission
                <span class="btn btn-icon-only green-new" type="button" id="refresh" title="Reset">
                    <i class="fa fa-refresh" aria-hidden="true"></i>
                </span>
                @permission('featured-products-create')
                <div class="pull-right">
                    <a class="btn btn-green-drake" href="{{ url('powerpanel/featured-products/add') }}">{{ trans('template.featuredproductsModule.addFeaturedProducts') }} </a>
                </div>
                @endpermission
            </div>
            <div class="portlet-body">
                <p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {{ trans('template.featuredproductsModule.listingNote') }}</p>
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <div class="dataTables_filter">
                            <span>{{ trans('template.common.search') }} :</span>
                            <input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter">
                        </div>
                    </div>
                    <table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%" align="center"><input type="checkbox" class="group-checkable"></th>
                                <th width="15%" align="left">{{ trans('template.common.title') }}</th>
                                <th width="15%" align="left">{{ trans('template.featuredproductsModule.productcategory') }}</th>
                                <th width="15%" align="left">{{ trans('template.featuredproductsModule.product') }}</th>
                                <th width="15%" align="center">{{ trans('template.common.shortdescription') }}</th>
                                <th width="10%" align="center">{{ trans('template.common.order') }}</th>
                                <th width="10%" align="center">{{ trans('template.common.publish') }}</th>
                                <th width="10%" align="right">{{ trans('template.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                    @permission('featured-products-delete')
                    <a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass">{{ trans('template.common.delete') }}
                    </a>
                    @endpermission
                </div>
            </div>
            @else
            @include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/featured-products/add')])
            @endif
        </div>
    </div>
</div>
@include('powerpanel.partials.deletePopup')
@endsection
@section('scripts')
<script type="text/javascript">
    window.site_url = '{!! url("/") !!}';
    var DELETE_URL = '{!! url("/powerpanel/featured-products/DeleteRecord") !!}';
</script>
<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/dataTables.editor.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/featured_products-datatables-ajax.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>
@endsection
