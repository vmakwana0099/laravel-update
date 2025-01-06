@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection

@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css" />
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
		<div class="portlet light portlet-fit portlet-datatable">
			@if($total > 0)
			<div class="portlet-title select_box">
				<span class="title">{{ trans('template.common.filterby') }}:</span>
				<select id="statusfilter" data-sort data-order class="form-control bs-select select2">
				  <option value=" ">{{ trans('template.common.selectstatus') }}</option>
					<option value="Y">{{ trans('template.common.publish') }}</option>
					<option value="N">{{ trans('template.common.unpublish') }}</option>
				</select>
				@permission('sponsor-category-list')
						<select class="form-control bs-select select2" id="category_id" name="category_id">

							 @if(count($SponsorCategory)>0)
							 <option value=" ">--{{ trans('template.common.selectcategory') }}--</option>
								 @foreach($SponsorCategory as $category)
								 	<option value="{{ $category->id }}" {{ ($category->id == Input::old('category_id') || app('request')->input('category')==$category->id)? 'selected' : '' }}>{{ $category->varTitle }}</option>
								 @endforeach
							 @else
							 	 <option value=" " disabled="disabled">{{ trans('template.common.pleaseaddcategory') }}</option>
							 @endif
						</select>
				@endpermission
				<span class="btn btn-icon-only green-new" type="button" id="refresh" title="Reset">
			  <i class="fa fa-refresh" aria-hidden="true"></i>
			</span>
				@permission('sponsor-create')
					<div class="pull-right">
						<a class="btn btn-green-drake" href="{{ url('powerpanel/sponsor/add') }}">
						{{ trans('template.sponsorsModule.addsponsor') }} </a>
					</div>
				@endpermission
			</div>
			<div class="portlet-body">
			<p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {{ trans('template.sponsorsModule.listingNote') }}</p>
				<div class="table-container">
					<div class="table-actions-wrapper">
						<div class="dataTables_filter">
							 <span>{{ trans('template.common.search') }}:</span>
							<input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter">
						</div>
					</div>
					<table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="sponsor_datatable_ajax">
						<thead>
							<tr role="row" class="heading">
								<th width="2%" align="center"><input type="checkbox" class="group-checkable"></th>
								<th width="38%" align="left">{{ trans('template.common.name') }}</th>
								<th width="10%" align="center">{{ trans('template.common.image') }}</th>
								<th width="10%" align="center">{{ trans('template.common.category') }}</th>
								<th width="10%" align="center">{{ trans('template.common.order') }}</th>
								<th width="10%" align="center">{{ trans('template.common.link') }}</th>
								<th width="10%" align="center">{{ trans('template.common.publish') }}</th>
								<th width="15%" align="right">{{ trans('template.common.actions') }}</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					@permission('sponsor-delete')
						<a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass">{{ trans('template.common.delete') }}
						</a>
					@endpermission
				</div>
			</div>
			@else
			@include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/sponsor/add')])
			@endif
		</div>
	</div>
</div>
@include('powerpanel.partials.deletePopup')
@endsection
@section('scripts')
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
		var DELETE_URL =  '{!! url("/powerpanel/sponsor/DeleteRecord") !!}';
	</script>
	<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/table-sponsor-ajax.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/select2/js/components-select2.min.js') }}" type="text/javascript"></script>
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
	<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>
@endsection
