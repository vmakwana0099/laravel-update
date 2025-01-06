@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
<div class="page-content-wrapper proj-detail-wrap recent_update">
	<div class="portlet light">
		<div class="col-md-4 col-sm-6 nopadding">
			<div class="event_datepicker">
			<div class="new_date_picker input-group input-large date-picker input-daterange" data-date-format="{{Config::get('Constant.DEFAULT_DATE_FORMAT')}}">
	      <span class="input-group-addon"><i class="icon-calendar"></i></span>	     
	      	<input type="text" class="form-control datepicker" id="from" placeholder="From" value="{{Carbon\Carbon::today()->subMonth()->format(Config::get('Constant.DEFAULT_DATE_FORMAT'))}}" readonly>
	     	<span class="input-group-addon set_dash">{{ trans('template.common.to') }}</span>
	     		<input type="text" class="form-control datepicker" id="to" placeholder="To" value="{{Carbon\Carbon::today()->format(Config::get('Constant.DEFAULT_DATE_FORMAT'))}}" readonly> 
	     </div>
	    </div>
	  </div>
	  <div class="col-md-8 col-sm-6 nopadding">
	 		<div class="pull-right recent_btn">	
				<input type="submit" value="Search" name="search" class="btn btn-green-drake pull-right search">
			</div>	
	 		<div class="pull-right recent_search">
				<input type="search" class="form-control" id="searchfilter" placeholder="Search">
			</div>			
	  	<div class="pull-right recent_select">				  
			  <select id="selectfilter" data-sort data-order class="bs-select select2">
					<option value="DESC">Sort by latest</option>
					<option value="ASC">Sort by earlier</option>
				</select>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-blue-ebonyclay bold uppercase">{{ trans('template.common.activity') }}</span>
				</div>
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="loader" style="display: none;">
					<center>
						<img class="loading-image" src="{{url('assets/global/img/loading-spinner-grey.gif')}}" alt="loading...">
					</center>
				</div>
			</div>
			<div class="portlet-title" id="recentList"></div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="new_modal modal fade bs-modal-sm" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-vertical">
			<div class="modal-content"> 
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">{{ trans('template.alert')}}</h4>
				</div>
				<div class="modal-body">
					<p>{{ trans('template.daterange')}}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{ url('resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/select2/js/components-select2.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
window.site_url =  '{!! url("/") !!}';
$('.datepicker').datepicker({autoclose:true,format:"yyyy/mm/dd"});
</script>
<script src="{{ url('resources/pages/scripts/recentupdate.js') }}" type="text/javascript"></script>
@endsection