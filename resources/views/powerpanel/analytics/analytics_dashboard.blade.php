@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection

@section('content')
@include('powerpanel.partials.breadcrumbs')
@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


<!-- BEGIN DASHBOARD STATS 1-->
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="fa fa-comments"></i>
				</div>
				<div class="details">
					<div class="number">
						<span data-counter="counterup" data-value="{{ $unique_users }}">{{ $unique_users }}</span>
					</div>
					<div class="desc" title="Unique Users">Unique Users</div>
				</div>
			</div>
		</div>
	
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="fa fa-comments"></i>
				</div>
				<div class="details">
					<div class="number">
						<span data-counter="counterup" data-value="{{ $web_hits }}">{{ $web_hits }}</span>
					</div>
					<div class="desc" title="Web Hits">Web Hits</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="fa fa-comments"></i>
				</div>
				<div class="details">
					<div class="number">
						<span data-counter="counterup" data-value="{{ $mobile_hits }}">{{ $mobile_hits }}</span>
					</div>
					<div class="desc" title="Mobile Hits">Mobile Hits</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="fa fa-comments"></i>
				</div>
				<div class="details">
					<div class="number">
						<span data-counter="counterup" data-value="{{ $most_used_browser }}">{{ $most_used_browser }}/{{ $most_used_os }}</span>
					</div>
					<div class="desc" title="Most Used Browser/Most Used OS">Most Used Browser/Most Used OS</div>
				</div>
			</div>
		</div>
	
	</div>
	<div class="clearfix"></div>
	<!-- END DASHBOARD STATS 1-->
	<div class="row">

		<div class="col-md-6 col-sm-6">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title dash-title">
					<div class="caption">
						<i class="icon-share font-green_drark hide"></i>
						<span class="caption-subject font-green_drark bold uppercase" title="Top Browsers">Top Browsers</span>
					</div>
				</div>			
				<div class="portlet-body">
					<div id="chart_browser_hits" class="chart"></div>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>

		<div class="col-md-6 col-sm-6">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title dash-title">
					<div class="caption">
						<i class="icon-share font-green_drark hide"></i>
						<span class="caption-subject font-green_drark bold uppercase" title="Top Browsers">Top Operating Systems</span>
					</div>
				</div>			
				<div class="portlet-body">
					<div id="chart_os_hits" class="chart"></div>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>

		
		{{-- <div class="col-md-3 col-sm-3">			
			<div class="portlet light">
				<div class="portlet-title dash-title">
					<div class="caption">
						<i class="icon-share font-green_drark hide"></i>
						<span class="caption-subject font-green_drark bold uppercase" title="Top Browsers">Top Operating Systems</span>
					</div>
				</div>
				<div class="portlet-body dash-table">
					<div class="table-scrollable">
						<table class="new_table_desing table table-condensed table-hover">
							<thead>
								<tr>                        
									<th width="50%" align="left" title="Browser">Operatin System</th>
									<th width="50%" align="left" title="Browser">Page Hits</th>
								</tr>
							</thead>
							<tbody>
								@if(empty($operating_systems))
								<tr>
									<td  colspan="5">{!! trans('template.norecordsavailable') !!}</td>
								</tr>
								@else
									@foreach ($operating_systems as $os => $hits)
										<tr>
											<td >{{ $os }} </td>
											<td >{{ $hits }} ({{  round(($hits*100)/ $sum_os) }}%) </td>
										</tr>                   
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>  
		
			</div>
			
		</div>


		<div class="col-md-3 col-sm-3">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title dash-title">
					<div class="caption">
						<i class="icon-share font-green_drark hide"></i>
						<span class="caption-subject font-green_drark bold uppercase" title="Top Browsers">Most Visited By</span>
					</div>
				</div>
				<div class="portlet-body dash-table">
					<div class="table-scrollable">
						<table class="new_table_desing table table-condensed table-hover">
							<thead>
								<tr>                        
									<th width="50%" align="left" title="Browser">IP Address</th>
									<th width="50%" align="left" title="Browser">Total Visits</th>
								</tr>
							</thead>
							<tbody>
								@if(empty($visitors))
								<tr>
									<td  colspan="5">{!! trans('template.norecordsavailable') !!}</td>
								</tr>
								@else
									@foreach ($visitors as $visitor)
										<tr>
											<td >{{ $visitor['var_ip_address']  }}</td>
											<td >{{ $visitor['vcount'] }}</td>
										</tr>                   
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>  
		
			</div>
			<!-- END PORTLET-->
		</div> --}}
		
	</div>

<div class="clearfix"></div>
<div class="row">


{{-- <div class="col-md-3 col-sm-3">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title dash-title">
					<div class="caption">
						<i class="icon-share font-green_drark hide"></i>
						<span class="caption-subject font-green_drark bold uppercase" title="Top Browsers">Most Visited By</span>
					</div>
				</div>
				<div class="portlet-body dash-table">
					<div class="table-scrollable">
						<table class="new_table_desing table table-condensed table-hover">
							<thead>
								<tr>                        
									<th width="50%" align="left" title="Browser">IP Address</th>
									<th width="50%" align="left" title="Browser">Total Visits</th>
								</tr>
							</thead>
							<tbody>
								@if(empty($visitors))
								<tr>
									<td  colspan="5">{!! trans('template.norecordsavailable') !!}</td>
								</tr>
								@else
									@foreach ($visitors as $visitor)
										<tr>
											<td >{{ $visitor['var_ip_address']  }}</td>
											<td >{{ $visitor['vcount'] }}</td>
										</tr>                   
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>  
		
			</div>
			<!-- END PORTLET-->
</div> --}}


		<div class="col-md-12 col-sm-12">
	<!-- BEGIN PORTLET-->
		<div class="portlet light bordered">
				<div class="portlet-title">
						<div class="caption">
								<i class="icon-bar-chart font-green"></i>
								<span class="caption-subject font-green bold uppercase">Site Visits</span>
								<!-- <span class="caption-helper">weekly stats...</span> -->
						</div>
						<div class="actions">
								<div class="btn-group btn-group-devided" data-toggle="buttons">
									<div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height green" data-placement="top" data-original-title="Change dashboard date range">
										<i class="icon-calendar"></i>&nbsp;
										<span class="thin uppercase hidden-xs"></span>&nbsp;
										<i class="fa fa-angle-down"></i>
									</div>
								</div>
						</div>
				</div>
				<div class="portlet-body">
						<div id="site_statistics_loading">
								<img src="../assets/global/img/loading.gif" alt="loading" /> </div>
						<div id="site_statistics_content" class="display-none">
								<div id="site_statistics" class="chart"> </div>
						</div>
				</div>
		</div>
	<!-- END PORTLET-->
	</div>
	<!-- <div class="col-md-6 col-sm-6">
			
			<div class="portlet light">
				<div class="portlet-title dash-title">
					<div class="caption">
						<i class="icon-share font-green_drark hide"></i>
						<span class="caption-subject font-green_drark bold uppercase" title="Top Browsers">Most Visited By</span>
					</div>
				</div>			
				<div class="portlet-body">
					<div id="chart_vistor_hits" class="chart"></div>
				</div>
			</div>
			
	</div> -->
</div>
<div class="clearfix"></div>

<div class="row">
		<div class="col-md-12">
				<!-- BEGIN CHART PORTLET-->
				<div class="portlet light bordered">
						<div class="portlet-title">
								<div class="caption">
										<i class="icon-bar-chart font-green-haze"></i>
										<span class="caption-subject bold uppercase font-green-haze"> Global Hits - {{$geoCount}}</span>										
								</div>
								
						</div>
						<div class="portlet-body">
								<div id="chart_10" class="chart" style="height: 600px;"> </div>
						</div>
				</div>
				<!-- END CHART PORTLET-->
		</div>
</div>

<!-- BEGIN INTERACTIVE CHART PORTLET-->
	<!-- <div class="row">
		<div class="col-md-12 col-sm-12">
		  <div class="portlet light portlet-fit bordered">
		      <div class="portlet-title">
		          <div class="caption">
		              <i class="icon-settings font-dark"></i>
		              <span class="caption-subject font-dark sbold uppercase">Interactive Chart</span>
		          </div>
		          <div class="actions">
		              
		          </div>
		      </div>
		      <div class="portlet-body">
		          <div id="chart_2" class="chart"> </div>
		      </div>
		  </div>
	 </div>
	</div> -->
  <!-- END INTERACTIVE CHART PORTLET-->


<!-- END DASHBOARD STATS 1-->
<div class="clearfix"></div>
<!-- END CONTENT BODY -->
	<div class="new_modal modal fade detailsCmsPage" tabindex="-1" aria-hidden="true">
	</div>
	<div class="new_modal modal fade detailsContactUsLead" tabindex="-1" aria-hidden="true">
	</div>
	<div class="new_modal modal fade FAQDetails" tabindex="-1" aria-hidden="true">
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
		window.site_url =  '{!! url("/") !!}';
		var visitors =	'{!! $range_hits !!}';
		var range_leads =	'{!! $range_leads !!}';		
		var topBrowserPie = '{!! $browsersPie !!}';
		var topOsPie = '{!! $osPie !!}';
		var topVisitorPie = '{!! $vistorsPie !!}';
		var locationUser= '{!! $locationUser !!}';
	</script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="{{ url('resources/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/moment.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>	
	<script src="{{ url('resources/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>		
	<script src="{{ url('resources/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
	
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>	
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.stack.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.crosshair.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.axislabels.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/flot/jquery.flot.time.min.js') }}" type="text/javascript"></script>
	

	<script src="{{ url('resources/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
	<script src="{{ url('resources/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>

	<script src="{{ url('resources/pages/scripts/dashboard-analytics-ajax.js') }}" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script type="text/javascript">
		@if(Session::has('alert-success'))
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"positionClass": "toast-top-right",
				"onclick": null,
				"showDuration": "1000",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}
			toastr.success("{{Session::get('alert-success')}} Welcome to {{Config::get('Constant.SITE_NAME')}}.");
		@endif
		@if(Session::has('alert-success'))
			$("#topMsg").show().delay(5000).fadeOut();
			$("#topMsg").fadeOut("slow", function() {
				$('.page-header').css('top','0');
				$('.page-container').css('top','0'); 
			});
		@endif
		$(document).on('click','#close_icn', function(e){
			$("#topMsg").hide();
			$('.page-header').css('top','0');
			$('.page-container').css('top','0'); 
		});
	</script>
@endsection