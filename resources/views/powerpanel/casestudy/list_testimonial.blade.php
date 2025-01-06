@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css"/>
<style>
    .fancybox-wrap{width:50% !important;text-align:center}
    .fancybox-inner{width:100% !important;vertical-align:middle ;height:auto !important}
</style>
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="portlet light portlet-fit portlet-datatable bordered">
            @if($total > 0)			
            <div class="portlet-title select_box">
                <div class="col-md-4 nopadding">
                    <span class="title">{{ trans('template.common.filterby') }}:</span>
                    <select id="statusfilter" data-sort data-order class="bs-select select2">
                        <option value=" ">{{ trans('template.common.selectstatus') }}</option>
                        <option value="Y">{{ trans('template.common.publish') }}</option>
                        <option value="N">{{ trans('template.common.unpublish') }}</option>
                    </select>
                    <span class="btn btn-icon-only green-new" type="button" id="refresh" title="Reset">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </span>	
                </div>


                <div class="col-md-8 nopadding">
                    @permission('testimonial-create')
                    <div class="pull-right">
                        <a class="btn btn-green-drake" title="{{ trans('template.testimonialModule.addTestimonial') }}" href="{{ url('powerpanel/testimonial/add') }}">{{ trans('template.testimonialModule.addTestimonial') }}</a>
                    </div>
                    @endpermission
                    <button class="btn btn-green-drake pull-right" title="{{ trans('template.common.altResetFilters') }}" id="resetFilter" style="margin:0 15px 0 0">
                        <i class="fa fa-refresh"></i>
                    </button>
                    <button class="btn btn-green-drake pull-right" title="{{ trans('template.common.search') }}" id="dateFilter" style="margin:0 15px 0 0">
                        <i class="fa fa-search"></i>
                    </button>
                    <div class="event_datepicker pull-right">
                        <div class="new_date_picker input-group input-large date-picker" data-date-format="{{Config::get('Constant.DEFAULT_DATE_FORMAT')}}">
                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                            <input type="text" class="form-control datepicker" id="testimonialdate" name="testimonialdate" value="{{date(Config::get('Constant.DEFAULT_DATE_FORMAT'))}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {{ trans('template.testimonialModule.listingNote') }}</p>
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <div class="dataTables_filter">
                            <span>{{ trans('template.common.search') }}:</span>
                            <input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter">
                        </div>
                    </div>
                    <table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="testimonial_datatable_ajax">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="3%" align="center"><input type="checkbox" class="group-checkable"></th>								
                                <th width="15%" align="left">{{ trans('template.testimonialModule.title') }}</th>
                                <th width="10%" align="left">{{ trans('template.testimonialModule.productcategory') }}</th>
                                <th width="10%" align="left">{{ trans('template.testimonialModule.product') }}</th>
                                <th width="8%">{{ trans('template.testimonialModule.displayinhome') }}</th>
                                <th width="10%" align="left">{{ trans('template.common.description') }}</th>
                                <th width="10%" align="center">{{ trans('template.common.image') }}</th>								
                                <th width="10%" align="left">{{ trans('template.testimonialModule.testimonialDate') }}</th>
                                <th width="5%" align="center">{{ trans('template.common.order') }}</th>
                                <th width="10%" align="center">{{ trans('template.common.publish') }}</th>
                                <th width="10%" align="right">{{ trans('template.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    @permission('testimonial-delete')						
                    <a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass">{{ trans('template.common.delete') }}</a>						
                    @endpermission
                </div>
            </div>
            @else
            @include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/testimonial/add')])
            @endif		
        </div>
    </div>
</div>

@include('powerpanel.partials.deletePopup')

@endsection
@section('scripts')
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script type="text/javascript">
window.site_url = '{!! url("/") !!}';
var DELETE_URL = '{!! url("/powerpanel/testimonial/DeleteRecord") !!}';
$(document).ready(function() {
    $('.datepicker').datepicker({
        autoclose: true,
        endDate: new Date(),
        format: DEFAULT_DT_FMT_FOR_DATEPICKER
    });
});
</script>
<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/table-testimonial-ajax.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/fancybox/source/helpers/jquery.fancybox-media.js') }}" type="text/javascript"></script>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#statusfilter').select2({
            placeholder: "Select status"
        });
    });
</script>
@endsection