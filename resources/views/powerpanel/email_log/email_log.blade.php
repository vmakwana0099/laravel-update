@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit portlet-datatable">
		@if($iTotalRecords > 0)
			<div class="portlet-title pull-right select_box">
				<span class="title">Filter By:</span>
				<select id="emailtypefilter" data-sort data-order class="bs-select select2 orm-control input-inline input-large input-sm">
						<option value=" ">Select Email Type</option>
					@foreach ($emailTypes as $types)
						<option value="{{ $types->id }}">{{ $types->varEmailType }}</option>
					@endforeach
				</select>
			</div>
			<div class="portlet-body">
				<div class="table-container">
					<div class="table-actions-wrapper">
						<div class="dataTables_filter">
							<span>Search:</span>
							<input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter">
						</div>
					</div>
					<table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="email_log_datatable_ajax">
						<thead>
							<tr role="row" class="heading">
								<th width="2%" align="center"><input type="checkbox" class="group-checkable"></th>
								<th width="10%" align="left">{{ trans('template.emailLogModule.emailType') }}</th>
								<th width="20%" align="left">{{ trans('template.common.from') }}</th>
								<th width="20%" align="left">{{ trans('template.common.to') }}</th>
								<th width="5%" align="left">{{ trans('template.emailLogModule.isSent') }}</th>
								<th width="5%" align="center">{{ trans('template.common.attachment') }}</th>
								<th width="10%" align="center">{{ trans('template.emailLogModule.dateTime') }}</th>
								<!-- <th width="15%">Action</th> -->
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					@permission('email-log-delete')						
							<a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass"> Delete
							</a>						
					@endpermission	
				</div>
			</div>
		@else
			@include('powerpanel.partials.addrecordsection')
		@endif			
		</div>
	</div>
</div>
<div class="new_modal modal fade DetailsEmailLog" tabindex="-1" aria-hidden="true">
</div>
@include('powerpanel.partials.deletePopup')
@endsection
@section('scripts')
<script type="text/javascript">
	window.site_url =  '{!! url("/") !!}';
	var DELETE_URL =  '{!! url("/powerpanel/email-log/DeleteRecord") !!}';
</script>
<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/table-email-log-ajax.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {    
		$('#emailtypefilter').select2({
			placeholder: "Select Email Type"
		});
	});
</script>
@endsection