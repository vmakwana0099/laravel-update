@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css"/>
<style>
	 .fancybox-wrap{width:50% !important;text-align:center}
	 .fancybox-inner{width:100% !important;vertical-align:middle ;height:auto !important}
</style>
<!-- END PAGE LEVEL PLUGINS -->
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
		@if($iTotalRecords > 0)
			<div class="portlet-title select_box event_select_box">
				 <div class="col-md-12 nopadding">
				 		@permission('advertise-create')
						<div class="pull-right">
							 <a class="btn btn-green-drake" href="{{ url('powerpanel/advertise/add') }}" title="{{trans('template.advertiseModule.add')}}">{{trans('template.advertiseModule.add')}}</a>
						</div>
						@endpermission
						<a class="btn btn-green-drake pull-right" id="refresh" title="{!! trans('template.common.altResetFilters') !!}" href="javascript:;" style="margin:0 15px 0 0"><i class="fa fa-refresh"></i></a>
						<a class="btn btn-green-drake pull-right" style="margin-right:15px;" id="eventRange" href="javascript:;"><i class="fa fa-search"></i></a>
						<div class="event_datepicker pull-right">
							<div class="new_date_picker input-group " data-date-format="{{Config::get('Constant.DEFAULT_DATE_FORMAT')}}">
								<span class="input-group-addon"><i class="icon-calendar"></i></span>
							
							{!! Form::text('start_date',null, array('class' => 'form-control datepicker','id' => 'start_date','placeholder' => trans('template.common.startdate'), 'readonly' => 'readonly')) !!}
								
							<span class="input-group-addon"><i class="icon-calendar"></i></span>
								
							{!! Form::text('end_date',null, array('class' => 'form-control datepicker','id' => 'end_date','placeholder' => trans('template.common.enddate'), 'readonly' => 'readonly')) !!}

							</div>
						</div>
				 </div>
				 <div class="clearfix"></div>
				 <div class="portlet-body">
				 <p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {!! trans('template.staticblockModule.listingNote') !!}</p>
						<div class="table-container">
							 <div class="table-actions-wrapper">
									<div class="dataTables_filter">
										 <span>{!! trans('template.common.search') !!}:</span>
										 <input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter">
									</div>
							 </div>
							 <table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
									<thead>
										 <tr role="row" class="heading">
												<th width="2%" align="center">
													 <input type="checkbox" class="group-checkable">
												</th>
												<th width="23%" align="left">{!! trans('template.common.name') !!}</th>
												<th width="10%" align="center">{!! trans('template.common.image') !!}</th>
												<th width="15%" align="left">{!! trans('template.common.startdate') !!}</th>
												<th width="15%" align="left">{!! trans('template.common.enddate') !!}</th>
												<th width="10%" align="center">{{trans('template.advertiseModule.pages')}}</th>
												<th width="10%" align="center">{{trans('template.advertiseModule.positions')}}</th>
												<th width="10%" align="center">{!! trans('template.common.publish') !!}</th>
												<th width="15%" align="right">{!! trans('template.common.actions') !!}</th>
										 </tr>
									</thead>
									<tbody> </tbody>
							 </table>
							 @permission('advertise-delete')
								 
									<a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass"> {!! trans('template.common.delete') !!}</a>
								 
							 @endpermission
						</div>
				 </div>
			</div>
		@else
			@include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/advertise/add')])
		@endif		
			<!-- End: life time stats -->
	 </div>
</div>
<!-- /.modal -->
@include('powerpanel.partials.deletePopup')
<!-- END PAGE BASE CONTENT -->
@endsection
@section('scripts')
<script type="text/javascript">
	 window.site_url =  '{!! url("/") !!}';
	 var DELETE_URL =  '{!! url("/powerpanel/advertise/DeleteRecord") !!}';
</script>

<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
		var DELETE_URL =  '{!! url("/powerpanel/advertise/DeleteRecord") !!}';
		$(document).ready(function(){
			$('.datepicker').datepicker({
				autoclose: true,				
				format:DEFAULT_DT_FMT_FOR_DATEPICKER
			});
		});
	</script>

<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/dataTables.editor.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/all-adds-datatables-ajax.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
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
@endsection