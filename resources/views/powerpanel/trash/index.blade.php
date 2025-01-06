@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
<!-- BEGIN PAGE BASE CONTENT -->
{!! csrf_field() !!}
<div class="row">
	<div class="col-md-12">
	<!-- Begin: life time stats -->
		<div class="portlet light portlet-fit portlet-datatable">
			<div class="portlet-title">
				<div class="pull-right select_box">
						<span class="title">Recycle from: </span>
						<select id="moduleFilter" data-sort data-order class="bs-select select2">
							<option value=" ">Select Module</option>
							@if(Auth::user()->can('banner-delete'))
							<option value="/powerpanel/trash/get_banner_list" data-module="banners">Banner Module</option>
							@endif
							@if(Auth::user()->can('pages-delete'))
							<option value="/powerpanel/trash/get_cmsPage_list" data-module="cmspage" selected>CMS Page Module</option>
							@endif
							@if(Auth::user()->can('blog-delete'))
							<option value="/powerpanel/trash/get_blog_list" data-module="blog">Blog Module</option>
							@endif
							@if(Auth::user()->can('faq-delete'))
							<option value="/powerpanel/trash/get_faq_list" data-module="faqs">FAQs Module</option>
							@endif
							@if(Auth::user()->can('team-delete'))
							<option value="/powerpanel/trash/get_team_list" data-module="team">Team Module</option>
							@endif
							@if(Auth::user()->can('user-delete'))
							<option value="/powerpanel/trash/get_user_list" data-module="user">User Module</option>
							@endif
							@if(Auth::user()->can('services-delete'))
							<option value="/powerpanel/trash/get_services_list" data-module="services">Services Module</option>
							@endif
							@if(Auth::user()->can('testimonial-delete'))
							<option value="/powerpanel/trash/get_testimonial_list" data-module="testimonial">Testimonial Module</option>
							@endif
							@if(Auth::user()->can('contact-delete'))
							<option value="/powerpanel/trash/get_contact_list" data-module="contact-details">Contacts Module</option>
							@endif
							@if(Auth::user()->can('role-delete'))
							<option value="/powerpanel/trash/get_role_list" data-module="roles">Roles Module</option>
							@endif
							
							<option value="/powerpanel/trash/get_menu_list" data-module="menu">Menu Module</option>
							<!-- <option value="/powerpanel/trash/get_statick_block_list" data-module="staticblocks">Static Blocks Module</option> -->
							@if(Auth::user()->can('delete-sponser'))
							<option value="/powerpanel/trash/get_sponsors_list" data-module="sponsors">Sponsors Module</option>
							@endif
							@if(Auth::user()->can('news-delete'))
							<option value="/powerpanel/trash/get_news_list" data-module="news">News Module</option>
							@endif
							@if(Auth::user()->can('photo-gallery-delete'))
							<option value="/powerpanel/trash/get_photo_album_list" data-module="photo-album">Photo Album Module</option>
							@endif
							@if(Auth::user()->can('video-album-delete'))
							<option value="/powerpanel/trash/get_video_album_list" data-module="video-album">Video Album Module</option>
							@endif
							@if(Auth::user()->can('news-category-delete'))
							<option value="/powerpanel/trash/get_news_category_list" data-module="news-category">News Category Module</option>
							@endif
							@if(Auth::user()->can('blog-category-delete'))
							<option value="/powerpanel/trash/get_blog_category_list" data-module="blog-category">Blog Category Module</option>
							@endif
							@if(Auth::user()->can('services-category-delete'))
							<option value="/powerpanel/trash/get_service_category_list" data-module="service-category">Service Category Module</option>
							@endif
							@if(Auth::user()->can('show-category-delete'))
							<option value="/powerpanel/trash/get_show_category_list" data-module="show-category">Show Category Module</option>
							@endif
							@if(Auth::user()->can('product-category-delete'))
							<option value="/powerpanel/trash/get_product_category_list" data-module="product-category">Product Category Module</option>
							@endif
							@if(Auth::user()->can('event-delete'))
							<option value="/powerpanel/trash/get_events_list" data-module="events">Events Module</option>
							@endif
							@if(Auth::user()->can('product-delete'))
							<option value="/powerpanel/trash/get_products_list" data-module="product">Products Module</option>
							@endif
							
							<option value="/powerpanel/trash/get_shows_list" data-module="shows">Shows Module</option>
							<option value="/powerpanel/trash/get_adv_slots_list" data-module="adv-slot">Adv Slot Module</option>
							<option value="/powerpanel/trash/get_adv_list" data-module="adv">Advertise Module</option>														
							

						</select>
					</div>	
			</div>
				<div class="portlet-body">
				<div class="table-container">
					<table class="new_table_desing table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
						<thead>
							<tr role="row" class="heading">
								<th width="3%" align="center">
									<input type="checkbox" class="group-checkable">
								</th>
								<th width="62%" align="left">Information</th>
								<th width="35%" align="center">Action</th>
							</tr>
					</thead>
					<tbody> </tbody>
					</table>
					@permission('trash-delete')
						<a href="javascript:;" class="btn-sm btn btn-outline red right_bottom_btn deleteMass" style="padding:9px 18px">Delete 
						</a>
					@endpermission
					<a href="javascript:;" class="btn btn-green-drake right_bottom_btn restoreMass">Restore 
					</a>
					
				</div>
				</div>

			</div>
		</div>
		<!-- End: life time stats -->
</div>
<!-- /.modal -->
<div class="new_modal modal fade bs-modal-md" id="confirm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-vertical">
			<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							Confirm
					</div>
					<div class="modal-body text-center delMsg"></div>
					<div class="modal-footer">
							<button type="button" id="delete" class="btn red btn-outline">Delete</button>
							<button type="button" class="btn btn-green-drake" data-dismiss="modal">Close</button>       
					</div>
			</div>
		</div>
	</div>
</div>
<div class="new_modal modal fade bs-modal-md" id="restore-item" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
		<div class="modal-vertical">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								Confirm
						</div>
						<div class="modal-body resMsg text-center"></div>
						<div class="modal-footer">
								<button type="button" id="restore-it" class="btn btn-green-drake">Restore</button>
								<button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
						</div>
				</div>
				<!-- /.modal-content -->
			</div>
		</div>
		<!-- /.modal-dialog -->
</div>
<!-- END PAGE BASE CONTENT -->
@endsection
@section('scripts')
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';		
	</script>
	<script src="{{ url('resources/global/scripts/datatable.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>	
	<script src="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>	
	<script src="{{ url('resources/pages/scripts/trash-datatables-ajax.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/trash-functions.js') }}" type="text/javascript"></script>	
	<script src="{{ url('resources/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/select2/js/components-select2.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function() {    
		$('#moduleFilter').select2({
			placeholder: "Select Module"
		});
	});
</script>
@endsection