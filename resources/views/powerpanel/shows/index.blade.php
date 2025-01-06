@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css"/>
<style>
    .fancybox-wrap{width:50% !important;text-align:center}
    .fancybox-inner{width:100% !important;vertical-align:middle ;height:auto !important}
</style>
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
<!-- BEGIN PAGE BASE CONTENT -->
{!! csrf_field() !!}
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="portlet light portlet-fit portlet-datatable bordered">
            @if($iTotalRecords > 0)
            <div class="portlet-title select_box">
                <span class="title">{{ trans('template.common.filterby') }}:</span>
                <select id="statusfilter" data-sort data-order class="bs-select select2">
                    <option value=" ">{{ trans('template.common.selectstatus') }}</option>
                    <option value="Y">{{ trans('template.common.publish') }}</option>
                    <option value="N">{{ trans('template.common.unpublish') }}</option>
                </select>
                @permission('show-category-list')
                @if(isset($ShowCategory))
                <select class="form-control bs-select select2" id="category_id" name="category_id">
                    <option value=" ">--{{ trans('template.common.selectcategory') }}--</option>
                    @if(count($ShowCategory)>0)
                    @foreach($ShowCategory as $category)
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
                @permission('shows-create')
                <div class="pull-right">
                    <a class="btn btn-green-drake" href="{{ url('powerpanel/shows/add') }}">{{ trans('template.showsModule.addShow') }}</a>
                </div>
                @endpermission
                <a class="btn btn-green-drake pull-right" id="refresh" title="{{ trans('template.common.altResetFilters') }}" href="javascript:;" style="margin:0 15px 0 0"><i class="fa fa-refresh"></i></a>
                <a class="btn btn-green-drake pull-right" id="showRange" href="javascript:;" style="margin:0 15px 0 0"><i class="fa fa-search"></i></a>
                <div class="event_datepicker pull-right">
                    <div class="new_date_picker input-group" data-date-format="{{Config::get('Constant.DEFAULT_DATE_FORMAT')}}">
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder="{{ trans('template.common.startdate') }}" readonly>
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <input type="text" class="form-control datepicker" id="end_date" name="end_date" placeholder="{{ trans('template.common.enddate') }}" readonly>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {{ trans('template.showsModule.listingNote') }}</p>
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <div class="dataTables_filter">
                            <span>Search:</span>
                            <input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter">
                        </div>
                    </div>
                    <table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable">
                                </th>
                                <th width="20%">{{trans("template.common.title")}}</th>
                                <th width="10%">{{trans("template.common.shortdescription")}}</th>
                                <th width="10%">{{trans("template.showsModule.dj")}}</th>
                                <th width="18%">{{trans("template.common.startDateAndTime")}}</th>
                                <th width="18%">{{trans("template.common.endDateAndTime")}}</th>
                                <th width="10%">{{trans("template.common.order")}}</th>
                                <th width="10%">{{ trans('template.showsModule.isFeatureShow') }}</th>
                                <th width="10%" align="center">{{ trans('template.common.publish') }}</th>
                                <th width="20%">{{trans("template.common.actions")}}</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                    @permission('shows-delete')
                    <a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass">{{trans("template.common.delete")}}
                    </a>
                    @endpermission
                </div>
            </div>
            @else
            @include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/shows/add')])
            @endif
        </div>
    </div>
</div>
@include('powerpanel.partials.deletePopup')
<!-- END PAGE BASE CONTENT -->
@endsection
@section('scripts')
<script type="text/javascript">
    window.site_url = '{!! url("/") !!}';
    var DELETE_URL = '{!! url("/powerpanel/shows/DeleteRecord") !!}';
</script>
<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/dataTables.editor.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/shows-datatables-ajax.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/fancybox/source/helpers/jquery.fancybox-media.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true,
            format: DEFAULT_DT_FMT_FOR_DATEPICKER
        });
    });
</script>
<script type="text/javascript">
    $('.fancybox-buttons').fancybox({
        autoWidth: true,
        autoHeight: true,
        autoResize: true,
        autoCenter: true,
        closeBtn: true,
        openEffect: 'elastic',
        closeEffect: 'elastic',
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        },
        beforeShow: function() {
            this.title = $(this.element).data("title");
        }
    });
</script>
@endsection