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
	 <div class="col-lg-12">
	 @if(Session::has('message'))
		<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
			{{ Session::get('message') }}
		</div>
		@endif
			<div class="portlet light portlet-fit portlet-datatable">
				@if($iTotalRecords > 0)				 
				 <div class="portlet-title select_box">
				 @permission('users-create') 
						<div class="pull-right">
							 <a class="btn btn-green-drake" href="{{ route('powerpanel.users.add') }}">{{ trans('template.userModule.createUser') }} </a>
						</div>
					@endpermission	
				 </div>
				 <div class="portlet-body">
						<div class="table-container">
						@if ($message = Session::get('success'))
						<div class="alert alert-success">
							 <p>{{ $message }}</p>
						</div>
						@endif
						<p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {{ trans('template.userModule.listingNote') }}</p>
						<div class="table-actions-wrapper">
										 <div class="dataTables_filter">
												<span>{{ trans('template.common.search') }}:</span>
												<input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter">
										 </div>
									</div>
							 <table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
									<thead>
										 <tr role="row" class="heading">
												<th width="2%" align="center">
													 <input type="checkbox" class="group-checkable">
												</th>
												<th width="30%" align="left">{{ trans('template.common.name') }} </th>
												<th width="23%" align="left">{{ trans('template.common.email') }} </th>
												<th width="23%" align="left">Reset</th>
												<th width="25%" align="left">{{ trans('template.common.roles') }} </th>
												<th width="15%" align="center">{{ trans('template.common.publish') }}</th>
												<th width="15%" align="right">{{ trans('template.common.actions') }} </th>
										 </tr>
									</thead>
									<tbody> </tbody>
							 </table>
							  @permission('users-delete') 
								 
									<a href="javascript:;" class="btn-sm btn red btn-outline right_bottom_btn deleteMass">{{ trans('template.common.delete') }}  
									</a>
									 
								@endpermission
						</div>
						{!! $data->render() !!}
				 </div>
				@else
					@include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/users/add')])
				@endif				
			</div>
	 </div>
</div>
@include('powerpanel.partials.deletePopup')
@endsection
@section('scripts')
<script type="text/javascript">
	window.site_url =  '{!! url("/") !!}';
	var DELETE_URL =  '{!! url("/powerpanel/users/DeleteRecord") !!}';
</script>
<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/users-datatables-ajax.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
@endsection