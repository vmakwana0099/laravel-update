@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel 
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css" />
<style>
	.fancybox-wrap{width:50% !important;text-align:center}
	.fancybox-inner{width:100% !important;vertical-align:middle ;height:auto !important}
</style>
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
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
			<div class="portlet-title select_box new_select_box">
				<span class="title">{{ trans('template.common.filterby') }}:</span>
				<select id="statusfilter" data-sort data-order class="form-control bs-select select2">
					 <option value=" ">--{{ trans('template.common.selectstatus') }}--</option>
					 <option value="Y">{{ trans('template.common.publish') }}</option>
					 <option value="N">{{ trans('template.common.unpublish') }}</option>
				</select>
				<select class="form-control bs-select select2" id="category_id" name="category_id">
					 <option value=" ">--{{ trans('template.common.selectcategory') }}--</option>
					 @if(count($BlogCategory)>0)
						 @foreach($BlogCategory as $category)					 
						 	<option value="{{ $category->id }}" {{ ($category->id == Input::old('category_id') || app('request')->input('category')==$category->id)? 'selected' : '' }}>{{ $category->varTitle }}</option>
						 @endforeach
					 @else
					 	 <option value=" " disabled="disabled">{{ trans('template.common.pleaseaddcategory') }}</option>
					 @endif
				</select>
				<span class="btn btn-icon-only green-new" type="button" id="refresh" title="Reset">
					 <i class="fa fa-refresh" aria-hidden="true"></i>
				  </span>
				@permission('blogs-create')		
					<div class="pull-right">
						<a class="btn btn-green-drake" href="{{ url('powerpanel/blogs/add') }}">{{ trans('template.addnewblog') }}</a>
					</div>
				@endpermission

				<a class="btn btn-green-drake pull-right" id="refresh" title="{{ trans('template.common.altResetFilters') }}" href="javascript:;" style="margin:0 15px 0 0"><i class="fa fa-refresh"></i></a>
				<a class="btn btn-green-drake pull-right" style="margin-right:15px;" id="eventRange" href="javascript:;"><i class="fa fa-search"></i></a>
				<div class="event_datepicker pull-right">
					<div class="new_date_picker input-group input-large date-picker input-daterange" data-date-format="{{Config::get('Constant.DEFAULT_DATE_FORMAT')}}">
						<span class="input-group-addon"><i class="icon-calendar"></i></span>
						<input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder="{{ trans('template.common.startdate') }}" readonly>
						<span class="input-group-addon"><i class="icon-calendar"></i></span>
						<input type="text" class="form-control datepicker" id="end_date" name="end_date" placeholder="{{ trans('template.common.enddate') }}" readonly>
					</div>
				</div>

			</div>
			<div class="portlet-body">
			<p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {{ trans('template.blogModule.listingNote') }}</p>					
				<div class="table-container">
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
								<th width="10%" align="left">{{ trans('template.common.title') }}</th>
								<th width="10%" align="center">{{ trans('template.common.shortdescription') }}</th>
								<th width="10%" align="left">{{ trans('template.common.author') }}</th>
								<th width="8%" align="center">{{ trans('template.common.image') }}</th>
								<th width="10%" align="center">{{ trans('template.common.category') }}</th>								
								<th width="15%" align="center">{{ trans('template.publisdateandtime') }}</th>
								<th width="8%" align="center">{{ trans('template.common.order') }}</th>
								<th width="8%" align="center">{{ trans('template.blogModule.isfeaturedblog') }}</th>
								<th width="10%" align="center">{{ trans('template.common.publish') }}</th>
								<th width="8%" align="right">{{ trans('template.common.actions') }}</th>
							</tr>
					</thead>
					<tbody> </tbody>
					</table>
					@permission('blogs-delete')		
						
						<a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass">						
							{{ trans('template.common.delete') }} 
						</a>
						
					@endpermission		
				</div>
			</div>
			@else
				@include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/blogs/add')])
			@endif		
		</div>
		<!-- End: life time stats -->
</div>
</div>
@include('powerpanel.partials.deletePopup')
@include('powerpanel.partials.onepushmodal')
<!-- END PAGE BASE CONTENT -->
@endsection
@section('scripts')
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
		var DELETE_URL =  '{!! url("/powerpanel/blogs/DeleteRecord") !!}';
	  var onePushShare = '{!! url("/powerpanel/share") !!}';
	  var onePushGetRec = '{!! url("/powerpanel/share/getrec") !!}';
	</script>
	<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>	

	<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/blog-datatables-ajax.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/sharer-validations.js') }}" type="text/javascript"></script>	
	<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/fancybox/source/helpers/jquery.fancybox-media.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
		var DELETE_URL =  '{!! url("/powerpanel/blogs/DeleteRecord") !!}';
		$(document).ready(function(){
			$('.datepicker').datepicker({
				autoclose: true,				
				format:DEFAULT_DT_FMT_FOR_DATEPICKER
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

		$(".fancybox-thumb").fancybox({
			prevEffect	: 'none',
			nextEffect	: 'none',
			helpers	: 
			{
				title	: {
					type: 'outside'
				},
				thumbs	: {
					width: 60,
					height: 50
				}
			}
		});
	</script>
@endsection