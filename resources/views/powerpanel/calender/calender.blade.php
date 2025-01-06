@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@stop
@section('breadcrumb')	
<div class="title_bar">
	<div class="page-head">
		<div class="page-title">
			<h1>{{ trans('template.mycalendar') }}</h1>
		</div>
	</div>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span aria-hidden="true" class="icon-home"></span>
		<a href="{{ url('powerpanel') }}">{{ trans('template.home') }}</a>
		<i class="fa fa-circle"></i>
	</li>
	<li class="active">
		{{ trans('template.mycalendar') }}
	</li>
</ul>
</div>
@stop
@section('css')
	<link href="{{ url('resources/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css"/>
	<style type="text/css">
		#calendar .popover{
			position: absolute;
			width: 100%;
			top: 0px;
			right: 0px;
		}
		#calendar .fc-time{
  	 display : none;
		}
	</style> 
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit calendar">
			<div class="portlet-title">
				<div class="caption calendar_search">
					<div class="search_input">
					  <input type="text" id="searchdata" class="form-control" placeholder="Search">
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="row" style="margin-top: 5%;">
					<div class="col-md-12 col-sm-12">
						<div class="loader" style="display: none;">
							<center>
						  	<img class="loading-image" src="{{url('assets/global/img/loading-spinner-grey.gif')}}" alt="loading...">
						  </center>
						</div>
						<div id="calendar" class="has-toolbar n-cal main_calendar"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
	<script src="{{ url('resources/global/plugins/moment.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/pages/scripts/calendar.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
	</script>
@endsection   