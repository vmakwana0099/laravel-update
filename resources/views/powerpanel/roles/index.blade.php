@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
	<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
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
		<!-- Begin: life time stats -->
			<div class="portlet light portlet-fit portlet-datatable">
			@if($iTotalRecords > 0)
				<div class="portlet-title">
					<div class="pull-right">
						@permission('roles-create')
							<a class="btn btn-green-drake" href="{{ route('powerpanel.roles.add') }}">{{ trans('template.roleModule.createRole') }}</a>
						@endpermission
					</div>
				</div>
				<div class="portlet-body">
						@if ($message = Session::get('success'))
							<div class="alert alert-success">
								<p>{{ $message }}</p>
							</div>
						@endif
						<p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {{ trans('template.roleModule.listingNote') }}</p>
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
									<th width="3%" align="center">
										<input type="checkbox" class="group-checkable">
									</th>
									<th width="40%" align="left"> {{ trans('template.common.name') }}  </th>
									<th width="40%" align="left"> {{ trans('template.common.description') }}  </th>
									<th width="17%" align="right"> {{ trans('template.common.actions') }}  </th>
								</tr>
							</thead>
						<tbody> </tbody>
					</table>
					@permission('roles-delete')							
					<a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass">Delete</a>					
					@endpermission
				</div>
			</div>
			@else
				@include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/roles/add')])
			@endif
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- /.modal -->
@include('powerpanel.partials.deletePopup')
@endsection
@section('scripts')
		<script type="text/javascript">
				window.site_url =  '{!! url("/") !!}';				
				var DELETE_URL =  '{!! url("/powerpanel/roles/DeleteRecord") !!}';
		</script>
		<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/pages/scripts/table-role_manager-ajax.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>		
@endsection

