@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@stop
@section('css')
	<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('resources/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('resources/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
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
				<span class="title">{!! trans('template.common.filterby') !!}:</span>
				<select id="statusfilter" data-sort data-order class="bs-select select2">
					<option value=" ">{!! trans('template.common.selectstatus') !!}</option>
					<option value="Y">{!! trans('template.common.publish') !!}</option>
					<option value="N">{!! trans('template.common.unpublish') !!}</option>
				</select>
				@if(count($cms_pages)>0)
					<select id="pageFilter" data-sort placeholder="Select Page" data-order class="bs-select select2">
						<option value=" ">{!! trans('template.bannerModule.selectPage') !!}</option>
						@foreach ($cms_pages as $cms_page)
							@permission($cms_page->modules->varModuleName.'-list')
								<option value="{{ $cms_page->id }}">{{ $cms_page->varTitle }}</option>
							@endpermission
						@endforeach
					</select>
				@endif
				<select id="bannerFilter" data-sort placeholder="{!! trans('template.bannerModule.selectMediaType') !!}" data-order class="bs-select select2">
					<option value=" ">{!! trans('template.bannerModule.selectMediaType') !!}</option>
					<!-- <option value="home_banner">Home Banner</option>
					<option value="inner_banner">Inner Banner</option> -->
					<option value="img_banner">{!! trans('template.common.image') !!}</option>
					<option value="vid_banner">{!! trans('template.common.video') !!}</option>
				</select>
				<select id="bannerFilterType" data-sort placeholder="{!! trans('template.bannerModule.selectMediaType') !!}" data-order class="bs-select select2">
					 <option value=" "> Select Banner Type </option>
					 <option value="home_banner">Home Banner</option>
					 <option value="inner_banner">Inner Banner</option>
				</select>
				<span class="btn btn-icon-only green-new" type="button" id="refresh" title="Reset">
					<i class="fa fa-refresh" aria-hidden="true"></i>
				</span>				
				@permission('banners-create')
					<div class="pull-right">
						<a class="btn btn-green-drake" href="{{ url('powerpanel/banners/add') }}">{!! trans('template.bannerModule.add') !!}</a>
					</div>
				@endpermission
			</div>
			<div class="portlet-body">
			<p style="background:rgba(16, 128, 242,0.08);color:rgba(16, 128, 242, 1);width:100%;padding:10px 15px"> {!! trans('template.bannerModule.listingNote') !!}</p>
				<div class="table-container">
					<div class="table-actions-wrapper">
						<div class="dataTables_filter">
							<span>{!! trans('template.common.search') !!}:</span>
							<input type="search" class="form-control form-control-solid placeholder-no-fix" id="searchfilter">
						</div>
					</div>


					<table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="banners_datatable_ajax">
						<thead>
							<tr role="row" class="heading">
								<th width="3%" align="center"><input type="checkbox" class="group-checkable"></th>
								<th width="25%" align="left">{!! trans('template.common.title') !!}</th>
								<th width="10%" align="center">{!! trans('template.common.image') !!}</th>
								<th width="15%" align="left">{!! trans('template.bannerModule.bannerType') !!}</th>
								<th width="10%" align="left">{!! trans('template.bannerModule.page') !!}</th>
								<th width="12%" align="left">{!! trans('template.common.displayorder') !!}</th>
								<th width="10%" align="center">{!! trans('template.common.publish') !!}</th>
								<th width="15%" align="right">{!! trans('template.common.actions') !!}</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					@permission('banners-delete')

						<a href="javascript:;" class="btn-sm btn red btn-outline right_bottom_btn deleteMass">
							{!! trans('template.common.delete') !!}
						</a>

					@endpermission
				</div>
			</div>
			@else
				@include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/banners/add')])
			@endif
		</div>
	</div>
</div>
@include('powerpanel.partials.deletePopup')
<div class="new_modal new_share_popup modal fade bs-modal-md" id="confirm_share" tabindex="-1" role="dialog" aria-hidden="true">
	 <div class="modal-dialog modal-md">
			<div class="modal-vertical">
				 <div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body delMsg text-center">
							 <form role="form" id='frmshareoption'>
									<div class="form-body">
										 <div class="form-group">
												<input name="varTitle" class="form-control spinner" placeholder="{!! trans('template.bannerModule.processSomething') !!}" type="text">
										 </div>
										 <div class="form-group">
												<textarea name="txtDescription" class="form-control" placeholder="{!! trans('template.common.shortdescription') !!}" rows="3"></textarea>
										 </div>
										 <div class="form-group">
												<div class="checkbox-list">
													 <label class="checkbox-inline">
													 <input name="socialmedia[]" type="checkbox" value="facebook">
													 <i class="fa fa-facebook"></i>&nbsp; {!! trans('template.bannerModule.facebook') !!}
													 </label>
													 <label class="checkbox-inline">
													 <input name="socialmedia[]" type="checkbox" value="twitter">
													 <i class="fa fa-twitter"></i>&nbsp; {!! trans('template.bannerModule.twitter') !!}
													 </label>
													 <label class="checkbox-inline">
													 <input name="socialmedia[]" type="checkbox" value="linkedin">
													 <i class="fa fa-linkedin"></i>&nbsp; {!! trans('template.bannerModule.linkedin') !!}
													 </label>
												</div>
										 </div>
											<button type="submit" class="btn btn-green-drake">{!! trans('template.common.submit') !!}</button>
									</div>
							 </form>
						</div>
				 </div>
			</div>
	 </div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
		var DELETE_URL =  '{!! url("/powerpanel/banners/DeleteRecord") !!}';
		var onePushShare = '{!! url("/powerpanel/banners/share") !!}'
	</script>
	<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/table-banners-ajax.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/banners-index-validations.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/fancybox/source/helpers/jquery.fancybox-media.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		$('.fancybox-buttons').fancybox({
			autoWidth: true,
			autoHeight: true,
			autoResize: true,
			autoCenter: true,
			autoDimensions: false,
			closeBtn: true,
			'maxHeight' : 380,
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
				this.width = $('.fancybox-iframe').contents().find('html').width();
				this.height = $('.fancybox-iframe').contents().find('html').height();
			}
	});
		$(document).on('click','.share', function(e){
		e.preventDefault();
		$('.new_share_popup').modal('show');
		$('#confirm_share').modal({ backdrop: 'static', keyboard: false })
			.one('click', '#share', function() {
					deleteItem(url,alias);
				});
			});
	</script>
@endsection
