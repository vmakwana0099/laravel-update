@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@stop
@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
{!! csrf_field() !!}
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            @if($iTotalRecords > 0)
            <div class="portlet-title select_box service_select_box">
            <div class="portlet-body">
                <span class="title">{{ trans('template.common.filterby') }}:</span>
                 @if(isset($Category))
                <select class="form-control bs-select select2" id="categoryfilter" name="categoryfilter">
                    <option value=" ">--Select Type--</option>
                    @if(count($Category)>0)
                    @foreach($Category as $cat)
                    <option value="{{ $cat->id }}" {{($cat->id == Input::old('category_id') || app('request')->input('category') == $cat->id)? 'selected' : '' }}>{{ $cat->varTitle }}</option>
                    @endforeach
                    @else
                    <option value=" ">{{ trans('template.common.pleaseaddcategory') }}</option>
                    @endif
                </select>
                @endif
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <div class="dataTables_filter">
                            <span>{{ trans('template.common.search') }}: </span>
                            <input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter" name="searchfilter">
                        </div>
                    </div>
                    <table class="new_table_desing table table-striped table-bordered table-hover table-checkable dataTable" id="datatable_ajax">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%" align="center"><input type="checkbox" class="group-checkable"></th>
                                <th width="15%" align="left">{{ trans('template.common.name') }}</th>							
                                <th width="15%" align="left">{{ trans('template.contactleadModule.type') }}</th>
                                <th width="15%" align="left">{{ trans('template.common.email') }}</th>
                                <th width="13%" align="center">{{ trans('template.common.phoneno') }}</th>
                                <th width="10%" align="center">{{ trans('template.contactleadModule.message') }}</th>
                                <th width="10%" align="center">{{ trans('template.common.ip') }}</th>
                                <th width="20%" align="center">{{ trans('template.common.received_date_time') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>				
                    @permission('contact-us-delete')
                    <a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass">{{ trans('template.common.delete') }}</a>
                    @endpermission
                    <a href="#selectedRecords" class="btn-sm btn btn-green-drake right_bottom_btn ExportRecord" data-toggle="modal">{{ trans('template.contactleadModule.export') }}</a>				
                </div>
            </div>
            </div>
            @else
            @include('powerpanel.partials.addrecordsection',['marketlink' => 'https://www.netclues.com/social-media-marketing', 'type'=>'contact'])
            @endif
        </div>
    </div>
</div>
<div class="new_modal modal fade" id="noRecords" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-vertical">	
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    {{ trans('template.common.alert') }} 
                </div>
                <div class="modal-body text-center">{{ trans('template.contactleadModule.noExport') }} </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-green-drake" data-dismiss="modal">{{ trans('template.common.ok') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="new_modal modal fade" id="selectedRecords" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-vertical">	
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    {{ trans('template.common.alert') }}
                </div>
                <div class="modal-body text-center">{{ trans('template.contactleadModule.recordsExport') }}</div>
                <div class="modal-footer">
                    <div align="center">
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                <input type="radio" value="selected_records" id="selected_records" name="export_type" class="md-radiobtn" checked="checked">
                                <label for="selected_records">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> {{ trans('template.contactleadModule.selectedRecords') }}
                                </label>
                            </div>
                            <div class="md-radio">
                                <input type="radio" value="all_records" id="all_records" name="export_type" class="md-radiobtn">
                                <label for="all_records">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>{{ trans('template.contactleadModule.allRecords') }} 
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-green-drake" id="ExportRecord" data-dismiss="modal">{{ trans('template.common.ok') }} </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="new_modal modal fade" id="noSelectedRecords" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-vertical">	
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    {{ trans('template.common.alert') }} 
                </div>
                <div class="modal-body text-center">{{ trans('template.contactleadModule.leastRecord') }} </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-green-drake" data-dismiss="modal">{{ trans('template.common.ok') }} </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@include('powerpanel.partials.deletePopup')
@endsection
@section('scripts')
<script type="text/javascript">
    window.site_url = '{!! url("/") !!}';
    var DELETE_URL = '{!! url("/powerpanel/contact-us/DeleteRecord") !!}';
</script>
<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>	
<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/contactlead-datatables-ajax.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>
@endsection