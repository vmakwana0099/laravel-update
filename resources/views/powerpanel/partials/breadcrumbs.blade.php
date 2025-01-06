<div class="title_bar">
	<div class="page-head">
		<div class="page-title">
		<h1>{{ $breadcrumb['title']}} </h1>
		</div>
	</div>	
	<ul class="page-breadcrumb breadcrumb">
		<li>
			<span aria-hidden="true" class="icon-home"></span>
			<a href="{{ url('powerpanel') }}">{{ trans('template.common.home') }}</a>
			<i class="fa fa-circle"></i>
		</li>
		@if(isset($breadcrumb['url']))
		<li>
			<a href="{{ url($breadcrumb['url']) }}">{{ $breadcrumb['module'] }}</a>
			<i class="fa fa-circle"></i>
		</li>
		@endif
		@if(isset($breadcrumb['inner_title']))			
			<li class="active">
				{{ $breadcrumb['inner_title'] }}
			</li>
		@else
			<li class="active">
				{{ $breadcrumb['title']}}
			</li>
		@endif
	</ul>	
	@if(isset($breadcrumb['url']))
		<a class="btn btn-green-drake pull-right" href="{{ url($breadcrumb['url']) }}" style="margin: -43px 0px 0 0;">
			<span class="hidden-xs" title="Go to list">{{ trans('template.common.back') }}</span>
		</a>
	@endif
</div>