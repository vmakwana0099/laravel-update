@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('resources/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->
@endsection
@extends('powerpanel.layouts.app')
@section('title')
	{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@stop
@section('breadcrumb')
<div class="title_bar">
	<div class="page-head">
		<div class="page-title">
			<h1>Plugins</h1>
		</div>
	</div>
	<ul class="page-breadcrumb breadcrumb">
		<li>
			<span aria-hidden="true" class="icon-home"></span>
			<a href="{{ url('powerpanel') }}">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li class="active">
			Plugins
		</li>
	</ul>
	<a class="btn btn-green-drake pull-right" href="{{ url('powerpanel/photo-album') }}" style="margin: -43px 0px 0 0;">
	<span class="hidden-xs" title="Go to list">Back</span>
</a>
</div>

@stop
@section('content')
<div class="row">
	 <div class="col-sm-12">
			<div class="portlet light bordered">
				 <div class="portlet-body">
					@if(!empty($arrModules))
						@foreach($arrModules as $module)

							<div class="col-lg-4">
									<div class="portlet mt-element-ribbon light portlet-fit bordered">
											<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
													<div class="ribbon-sub ribbon-clip ribbon-right"></div> {{$module->chr_version}} -
											</div>
											<div class="portlet-title">
													<div class="caption">
															<i class=" icon-layers font-green"></i>
															<span class="caption-subject font-green bold uppercase">{{$module->module_name}}</span>
													</div>
											</div>
											<div class="portlet-body"> {{$module->short_description}} </div>
											<div class="pull-right">
													@if(isset($installedModules[$module->module_slug] ) )
														@if($installedModules[$module->module_slug]->chr_version < $module->chr_version )
															<a href="javascript:" class="action_update" id="{{$module->module_slug}}"  >Update</a>
														@else
															Installed
														@endif
													@else
														<a href="javascript:" class="read_more" id="{{$module->module_slug}}"  >Install</a>
													@endif
											</div>
									</div>
							</div>
						@endforeach
					@endif
				 </div>
			</div>
	 </div>
</div>
<div class="popup cms modal fade" id="nqpopup" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <a class="close" data-dismiss="modal">&times;</a>
            <div class="modal-body text-center">
                <div class="row module_details">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
   window.site_url =  '{!! url("/") !!}';
   var API_URL =  '{{ env("API_URL") }}';

</script>
<script src="{{ url('resources/global/plugins/netquick.js') }}" type="text/javascript"></script>

@endsection