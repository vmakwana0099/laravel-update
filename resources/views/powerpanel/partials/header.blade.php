<div class="top_browser_note" id="topMsg" style="display: none;">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="browser_note">{{ trans('template.header.siteView') }} <strong>I.E 8+</strong>, 
				<strong>Mozilla 46+</strong>, <strong>Google Chrome 5+</strong>, <strong>Safari 5.0 +</strong>
				</div>
			</div>
		</div>
	</div>
	<div class="close_icn">
		<i class="fa fa-times" id="close_icn" style="cursor:pointer"></i>
	</div>
</div>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="{{ url('/powerpanel') }}">
				<img src="{{ App\Helpers\resize_image::resize(Config::get('Constant.FRONT_LOGO_ID')) }}" alt="{{ Config::get('Constant.SITE_NAME') }}">
			</a>
			<div class="menu-toggler sidebar-toggler">
				<i class="fa fa-bars"></i>
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
	<!-- 	<form class="search-form search-form-expanded" id="searchForm">
				<div class="input-group">
					<input type="text" class="form-control" id="inputsearch" placeholder="{{ trans('template.header.globalsearch') }}..." autocomplete="off" style="color: #fff;">
					<span class="input-group-btn">
						<a href="javascript:;" class="btn" id="globalsearch" title="Search">
							<i class="icon-magnifier"></i>
						</a>
					</span>
				</div>
				<div class="list search-sugg-list">
				</div> 
			</form> -->

		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
			
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="separator hide"> </li>
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-extended hide">						
						<form id="setLocale" class="language_select">
							<select class="select2" name="locale">
							{{-- @php 
							 	@foreach($allLocale as $locale)
									<option value="{{ $locale }}" @php $cnt=0; foreach($_COOKIE as $key=>$cookie){ if($cookie==$locale){ echo 'selected'; $cnt++; } elseif(strtolower($locale)=='en' && $cnt==0){echo 'selected'; $cnt++;} } @endphp >{{ strtoupper($locale) }}</option>
								@endforeach								
							@endphp --}}	
								<option value="en" selected>English</option>		
							</select>							
							{{ Form::token() }}
						</form>
					</li>
					<!-- <li class="dropdown dropdown-extended dropdown-notification">
						<a href="javascript:;" class="dropdown-toggle" id="notification" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-bell"></i>
							<span class="notification-count"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="external notification-count-bold"></li>
							<li id="notification_html">
							</li>
						</ul>
					</li> -->
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- <li class="separator hide"> </li> -->
					<!-- BEGIN INBOX DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<!-- <li class="dropdown dropdown-extended dropdown-notification">
						<a href="javascript:;" class="dropdown-toggle" id="message" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-envelope-open"></i>
							<span class="message-count">
							</span>
						</a>
						<ul class="dropdown-menu">
							<li class="external message-count-bold"></li>
							<li id="message_html">
							</li>
						</ul>
					</li> -->
					<li class="dropdown dropdown-user viewsitemobile"> 
						<a href="https://analytics.google.com/" target="_blank" class="dropdown-toggle viewsite" title="View Site">
							<span class="username"> {{ trans('template.header.googleAnalytic') }} </span> 
						</a>
					</li>
					<li class="dropdown dropdown-user viewsitemobile"> 
						<a href="{{url('/')}}" target="_blank" class="dropdown-toggle viewsite" title="View Site"> 
							<span class="username username-hide-on-mobile"> {{ trans('template.header.viewSite') }} </span> 
						</a>
					</li>
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" title="{{ auth()->user()->name }}">
							<span class="username username-hide-on-mobile"> {{ auth()->user()->name }}</span>
							
							@if (!empty($User_logo_url))
								<img class="img-circle" src="{{ $User_logo_url }} "/>
							@endif
						</a>	
						<ul class="dropdown-menu dropdown-menu-default">
							@permission('changeprofile-edit')
								<li>
									<a title="{{ trans('template.myprofile') }}" href="{{ url('/powerpanel/changeprofile') }}">
										<i class="icon-user"></i> {{ trans('template.header.myProfile') }} 
									</a>
								</li>
							@endpermission
							@permission('settings-general-setting-management')
								<li>
									<a href="{{ url('/powerpanel/settings') }}">
										<i class="icon-settings"></i> {{ trans('template.header.settings') }}
									</a>
								</li>
							@endpermission
							<!-- @permission('my-calender')
								<li>
									<a href="{{ url('/powerpanel/calender') }}">
										<i class="icon-calendar"></i> {{ trans('template.mycalendar') }} 
									</a>
								</li>
							@endpermission -->
							@permission('changeprofile-change-password')
								<li>
									<a title="{{ trans('template.changePassword') }}" href="{{ url('/powerpanel/changepassword') }}">
										<i class="icon-lock"></i> {{ trans('template.header.changePassword') }}
									</a>
								</li>
							@endpermission	
							<li>
								<a title="{{ trans('template.logOut') }}" href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									<i class="icon-key"></i> {{ trans('template.header.logOut') }} </a>
							</li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->