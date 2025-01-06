<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8" />
		<title>@yield('title')</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		{{-- <link href="https://https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet" type="text/css" /> --}}
		<link href="{{ url('resources/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('resources/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('resources/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('resources/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('resources/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('resources/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
		
		<link href="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css"/>
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		@yield('css')
		<link href="{{ url('resources/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ url('resources/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN THEME GLOBAL STYLES -->
		<link href="{{ url('resources/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
		<link href="{{ url('resources/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
		<!-- END THEME GLOBAL STYLES -->
		<!-- BEGIN THEME LAYOUT STYLES -->
		<link href="{{ url('resources/layouts/layout4/css/layout.min.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ url('resources/layouts/layout4/css/themes/light.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
		<link href="{{ url('resources/layouts/layout4/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/global/plugins/jquery-nestable/jquery.nestable.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/global/plugins/menu-loader/style.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ url('resources/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('resources/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('resources/global/css/colors.css') }}" rel="stylesheet" id="style_components" type="text/css" />
		<!-- END THEME LAYOUT STYLES -->
		<link rel="shortcut icon" href="{{ url('/assets/images/favicon.ico') }}" /> 
		<link rel="apple-touch-icon" sizes="144x144" href="{{ url('/assets/images/apple-touch-icon-144.png') }}" />
		<link rel="apple-touch-icon" sizes="114x114" href="{{ url('/assets/images/apple-touch-icon-114.png') }}" />
		<link rel="apple-touch-icon" sizes="72x72" href="{{ url('/assets/images/apple-touch-icon-72.png') }}" />
		<link rel="apple-touch-icon" sizes="57x57" href="{{ url('/assets/images/apple-touch-icon-57.png') }}" />
	</head>
	<!-- END HEAD -->
	<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		@include('powerpanel.partials.header')
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
				@include('powerpanel.partials.sidebar')
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">					
					@yield('content')
					@if(isset($imageManager))
						@include('powerpanel.media_manager.gallery_component') 
					@endif	
					@if(isset($videoManager))
						@include('powerpanel.media_manager.video_component') 
					@endif
					@if(isset($documentManager))
						@include('powerpanel.media_manager.documents_component') 
					@endif
				</div>
				<!-- END CONTENT BODY -->
			</div>
			<!-- END CONTENT -->
		</div>
		<!-- END CONTAINER -->
		<!--[if lt IE 9]>
<script src="../resources/global/plugins/respond.min.js"></script>
<script src="../resources/global/plugins/excanvas.min.js"></script>
<![endif]-->

<div class="new_modal new_share_popup modal fade bs-modal-md" id="aliasAlert" tabindex="-1" role="dialog" aria-hidden="true">
	 <div class="modal-dialog modal-md">
			<div class="modal-vertical">
				 <div class="modal-content">
						<div class="modal-header">							
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body delMsg text-center">
							<p>
								An alias is already exist, so we have suffixed it with a number. You can change it as per your choice by editing it.
							</p>
						</div>
						<div class="modal-footer">								
								<button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
						</div>
				 </div>
			</div>
	 </div>
</div>

		<!-- BEGIN CORE PLUGINS -->
		<div class="footer_section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
						<div class="copyright">
							{!! Config::get('Constant.FOOTER_COPYRIGHTS') !!} {{ date('Y') }} {{ Config::get('Constant.SITE_NAME') }}. {{ trans('template.frontLogin.allrightreserved') }}.
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
						<div class="copyright">
							{!!  Config::get('Constant.FOOTER_DEVELOPED_BY')  !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			window.site_url =  '{!! url("/") !!}';
			var rootUrl=window.site_url;
			var CKEDITOR_APP_URL = '{{ env("APP_URL") }}';
			//var settings = JSON.parse('{!! Config::get("Constant.MODULE.SETTINGS") !!}');
		</script>
		<script src="{{ url('resources/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
		
		<script src="{{ url('resources/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->
		<!-- END PAGE LEVEL PLUGINS -->
		<script type="text/javascript">
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' } });
		</script>
		<script src="{{ url('resources/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/jquery-validation/js/jquery.validate.js') }}" type="text/javascript"></script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN THEME GLOBAL SCRIPTS -->
		<script src="{{ url('resources/global/scripts/app.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/pages/scripts/ui-blockui.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/scripts/media_manager.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/pages/scripts/form-dropzone.js') }}" type="text/javascript"></script>
		<!-- END THEME GLOBAL SCRIPTS -->
		<!-- BEGIN THEME LAYOUT SCRIPTS -->
		<script src="{{ url('resources/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/layouts/layout4/scripts/demo.min.js') }}" type="text/javascript"></script>
		<!-- END THEME LAYOUT SCRIPTS -->		
		<script src="{{ url('resources/pages/scripts/popup.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
		<script type="text/javascript">
		var DEFAULT_DATE_FORMAT = "{{ Config::get('Constant.DEFAULT_DATE_FORMAT')  }}";
		var DEFAULT_TIME_FORMAT = "{{ Config::get('Constant.DEFAULT_TIME_FORMAT') }}";
		var DEFAULT_DT_FORMAT = 'M/D/YYYY';
		var DEFAULT_DT_FMT_FOR_DTPICKER = 'M/dd/yyyy';

		if(DEFAULT_DATE_FORMAT == 'd/m/Y')
		{	
			DEFAULT_DT_FORMAT = 'D/M/YYYY';
			DEFAULT_DT_FMT_FOR_DATEPICKER = 'dd/mm/yyyy';
		}else if(DEFAULT_DATE_FORMAT == 'm/d/Y') {
			DEFAULT_DT_FORMAT = 'M/D/YYYY';
			DEFAULT_DT_FMT_FOR_DATEPICKER = 'mm/dd/yyyy';
		}else if(DEFAULT_DATE_FORMAT == 'Y/m/d') {
			DEFAULT_DT_FORMAT = 'YYYY/M/D';
			DEFAULT_DT_FMT_FOR_DATEPICKER = 'yyyy/mm/dd';
		}else if(DEFAULT_DATE_FORMAT == 'Y/d/m') {
			DEFAULT_DT_FORMAT = 'YYYY/D/M';
			DEFAULT_DT_FMT_FOR_DATEPICKER = 'yyyy/dd/mm';
		}else if(DEFAULT_DATE_FORMAT == 'M/d/Y'){
			DEFAULT_DT_FORMAT = 'M/D/YYYY';
			DEFAULT_DT_FMT_FOR_DATEPICKER = 'M/dd/yyyy';
		}

		


		$(document).ready(function(){
			$('.thumbnail > a').click(function(){	
				$('.thumbnail > a').removeClass('selected')
				$(this).addClass('selected')
			});
			$('.close-btn').click(function(){					
				$(this).closest('.info').addClass('close');	
			});
			$('.left-panel ul li a').click(function(){	
				$('.info').removeClass('close')
			});
			$('.close-btn').click(function(){	
				$('ul li').removeClass('active')
			});
		});

		setTimeout(function(){$('.alert-info').hide()}, 5000)
		setTimeout(function(){$('.alert-danger').hide()}, 5000)
		setTimeout(function(){$('.alert-success').hide()}, 5000)
		$(document).ready(function() { 
			action_bar();
		});
		$( window ).resize(function() {
			action_bar();
		});
		function action_bar() {
			var top_bar = $('.top_browser_note');
			if(top_bar.length && "fixed" == top_bar.css('position') ){
				$('.page-header').css('top',top_bar.height());
				$('.page-container').css('top',top_bar.height()); 
			}  
			if(top_bar.css('display')  == "none") {
				$('.page-header').css('top','0');
				$('.page-container').css('top','0'); 
			} 
		}
		</script>
		<script src="{{ asset('assets/global/plugins/menu-loader/jquery-loader.js') }}" type="text/javascript"></script>  
		<script src="{{ url('messages.js') }}" type="text/javascript"></script>
		<script src="{{ url('resources/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
		
		@yield('scripts')
		<script src="{{ url('resources/global/plugins/select2/js/components-select2.min.js') }}" type="text/javascript"></script>
		@yield('cat_select2_config')
		@yield('cat_select2_deal')		
		
	</body>
</html>