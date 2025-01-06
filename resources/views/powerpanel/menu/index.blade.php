@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
@if ($message = Session::get('success'))
<div class="alert alert-success">
	 <p>{{ $message }}</p>
</div>
@endif
<div class="row">
	 <div class="col-lg-4 menu_padding_setting">
			<div class="portlet box green_dark">
				 <div class="portlet-title">
						<div class="caption">
							 {{ trans('template.menuModule.menuItem') }}
						</div>
						<div class="tools">							
							<a href="javascript:;" class="config" data-placement="bottom" data-original-title="{{ trans('template.menuModule.menuItemHelp') }}" title="{{ trans('template.menuModule.menuItemHelp') }}"><i class="fa fa-question"></i></a>
						</div>
				 </div>
				 <div class="portlet-body form">
						<form class="form-horizontal manualMenu" role="form">
							 <div class="form-body">
									<div class="form-group">
										 <div class="col-md-12">
												<label class="form_title" for="menuTitle">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
												<input type="text" maxlength="50" class="form-control" name="menuTitle" id="menuTitle" placeholder="{{ trans('template.common.title') }}" />
												<span id="menuTitleErr" style="color: red;"></span>
										 </div>
									</div>
									<div class="form-group">
										 <div class="col-md-12">
												<label class="form_title" for="link">{{ trans('template.common.url') }} <span aria-required="true" class="required"> * </span></label>
												<input type="text" class="form-control" name="menuLink" id="menuLink" placeholder="http://www.samplewebsite.com/mychoicepage" />
												<span id="menuLinkErr" style="color: red;"></span>					
												<p style="color:#333;margin:8px 0 5px;font-size:12px;">{{ trans('template.menuModule.menuUrlHelp') }}</i></p>

										 </div>
									</div>
							 </div>
							 <div class="form-actions right1">            
									<a href="javascript:;" id="add-menu-item" class="btn btn-green-drake">
									{{ trans('template.common.add') }} 
									</a>
							 </div>
						</form>
				 </div>
			</div>
			<div class="portlet box green_dark ">
				 <div class="portlet-title">
						<div class="caption">
							 {{ trans('template.sidebar.pages') }} 
						</div>
						<div class="tools">							
							<a href="javascript:;" class="config" data-placement="top" data-original-title="{{ trans('template.menuModule.menuPageHelp') }}" title="{!! trans('template.menuModule.menuPageHelp') !!}"><i class="fa fa-question"></i></a>
						</div>
				 </div>
				 <div class="portlet-body form cmsPages">
						<form class="form-horizontal" role="form">
							 <div class="form-body">
									@if($cmsPages->isEmpty())
									<p class="text-center">{{ trans('template.menuModule.noPageIsAvailable') }} </p>
									@else
									<div class="form-group">
										 <ul class="checkbox-list menu_pages_list service-list-checks">												
												@foreach ($cmsPages as $cmsPage)
													@permission($cmsPage->modules->varModuleName.'-list')
														<li class="{{ strlen($cmsPage->varTitle) > 17 ? 'col-md-12' : 'col-md-6'  }}">
															 <label>
															 <input class="frontPage" type="checkbox" data-title="{{ $cmsPage->varTitle }}" name="pages[]" value="{{ $cmsPage->alias->varAlias }}_{{ $cmsPage->id }}">
															 {!! $cmsPage->varTitle !!}
															 </label>
														</li>
													@endpermission

												@endforeach
												<li id="frontPageSelect" class="col-md-12" style="color: red;display: none;">
													{{ trans('template.menuModule.frontPageSelect') }}													
												</li>
												<li id="frontPageExists" class="col-md-12" style="color: red;display: none;">
													{{ trans('template.menuModule.frontPageExists') }}													
												</li>
										 </ul>
									</div>
									@endif
							 </div>
							 @if(!$cmsPages->isEmpty())
							 <div class="form-actions right1">                           
									<a href="javascript:;" id="addAllMenuItem" class="btn btn-green-drake">
									Assign
									</a>                
							 </div>
							 @endif							
						</form>
				 </div>
			</div>
	 </div>
	 <div class="col-lg-8">
			<div class="portlet light portlet_light menuBody overflow_visible">
				 <div class="portlet-title">
						<div class="caption">
							 <span class="caption-subject font-green_drark sbold uppercase">{{trans('template.menuModule.headerMenu')}} </span>
						</div>
						<div class="form-group pull-right">                    
							 <button id="deleteMenu" type="button" class="btn red btn-outline" style="display: none;">{{trans('template.common.delete')}}</button>
							 @permission('menu-type-create')<a href="#new-menu-add" class="btn btn-green-drake" data-toggle="modal">{{trans('template.menuModule.createNew')}}</a>@endpermission
							 <button id="saveMenu" type="button" class="btn btn-green-drake">{{trans('template.common.save')}}</button> 
						</div>
				 </div>
				 <div class="portlet-body ">
						<div class="row">
							 <div class="col-md-3 col-sm-4 padding_right_set">
									<div class="form-group select_box">
										 <div class="overflow_select">
												<select class="form-control menu_control" size="{{count($menuTypes)<2?2:count($menuTypes)}}" id="menuPosition">
												@foreach ($menuTypes as $menuType)
												<option value="{{ $menuType['id'] }}" @if($menuType['id']==1) selected @endif>{{ $menuType['varTitle'] }}</option>
												@endforeach
												</select>
										 </div>
									</div>
									<div class="icon_title">{{trans('template.menuModule.guide')}}</div>
									<div class="information_icons">
										<ul>
											<li>
												<span><i class="fa fa-pencil"></i></span>{{trans('template.common.edit')}}
												<ul class="hover_info hide">
													<li>
														<span class="fa fa-pencil"></span>
														<div class="sub_info_title">{{trans('template.menuModule.editMenu')}}</div>
														<p>{{trans('template.menuModule.editOtherName')}} </p>
													</li>
												</ul>
											</li>
											<li>
												<span><i class="fa fa-trash"></i></span>{{trans('template.common.delete')}}
												<ul class="hover_info hide">
													<li>
														<span class="fa fa-trash"></span>
														<div class="sub_info_title">{{trans('template.menuModule.deleteMenu')}}</div>
														<p>{{trans('template.menuModule.clickDeleteMenu')}}</p>
													</li>
												</ul>
											</li>
											<li>
												<span><i class="fa fa-check"></i></span>{{trans('template.common.active')}}
												<ul class="hover_info hide">
													<li>
														<span class="fa fa-check"></span>
														<div class="sub_info_title">{{trans('template.menuModule.activeDeactive')}}</div>
														<p>{{trans('template.menuModule.clickActiveDeactive')}}</p>
													</li>
												</ul>
											</li>
											<li>
												<span><i class="fa fa-mobile"></i></span>{{trans('template.menuModule.mobile')}}
												<ul class="hover_info hide">
													<li>
														<span class="fa fa-mobile"></span>
														<div class="sub_info_title">{{trans('template.menuModule.mobile')}}</div>
														<p>{{trans('template.menuModule.mobileShowHide')}}</p>
													</li>
												</ul>
											</li>
											<li>
												<span><i class="fa fa-desktop"></i></span>{{trans('template.menuModule.desktop')}}
												<ul class="hover_info hide">
													<li>
														<span class="fa fa-desktop"></span>
														<div class="sub_info_title">{{trans('template.menuModule.desktop')}}</div>
														<p>{{trans('template.menuModule.desktopShowHide')}}</p>
													</li>
												</ul>
											</li>
											<li>
												<span><i class="fa fa-list-alt"></i></span>{{trans('template.menuModule.megaMenu')}} 
												<ul class="hover_info hide">
													<li>
														<span class="fa fa-list-alt"></span>
														<div class="sub_info_title">{{trans('template.menuModule.megaMenu')}}</div>
														
														<p>{{trans('template.menuModule.mobileActiveDeactive')}}</p>
														<a href="{{url('assets\images\mega-menu-preview.png')}}" title="Click here to view mega menu sample" class="fancybox-buttons" data-rel="fancybox-buttons"><span><i class="fa fa-info"></i></span>{{trans('template.menuModule.megaMenuPreview')}}</a>
													</li>
												</ul>
											</li>
											<!-- <li> 
											<ul class="hover_info">
												<li>
													<span class="fa fa-list-alt"></span>
													<div class="sub_info_title">Mega Menu</div>
													<p>Click to button mobile Active & deactive and side icons click view Mega Menu</p>
												</li>
											</ul>
										</li> -->
									</ul>
									</div>
							 </div>
							 <div class="col-md-9 col-sm-8 padding_left_set">
							 		<span></span>
									<div class="mt-element-ribbon bg-grey-steel">
										 <div class="checked_off_on activation">										 	
												<input type="checkbox" name="active" id="active" class="make-switch switch-large" data-label-icon="fa fa-fullscreen"  {{-- data-on-text="Active" data-off-text="In active" --}} >
										 </div>
										 <div class="clearfix"></div>
										 <div class="dd" id="nestable_list_1">
												{!! $menu !!}
										 </div>
										 <div class="clearfix" style="height:10px;"></div>
									</div>
							 </div>
						</div>
				 </div>
			</div>
	 </div>
</div>
<div class="modal fade bs-modal-sm" id="menu-item-edit" tabindex="-1" role="dialog" aria-hidden="true">
	 <div class="modal-dialog modal-sm">
			<div class="modal-content">
				 <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">{{trans('template.common.edit')}}</h4>
				 </div>
				 <div class="modal-body">
						<div class="col-md-12">
							 <br/>
							 <div class="form-group">
									<div>
										 <label class="control-label form_title">{{trans('template.common.title')}}</label>
										 <input type="hidden" id="menuItemId"/>
										 <input type="text" maxlength="50" class="form-control" name="menuTitle" id="menuTitleEdit" placeholder="{{trans('template.common.title')}}" />
										 <span id="menuTitleErrE" style="color: red;"></span>
									</div>
							 </div>
							 <div class="form-group">
									<div>
										 <label class="control-label form_title">{{trans('template.pageModule.url')}}</label>
										 <input type="text" class="form-control" name="menuLink" id="menuLinkEdit" placeholder="Link" />
										 <span id="menuLinkErrE" style="color: red;"></span>
									</div>
							 </div>
						</div>
				 </div>
				 <div class="modal-footer">
						<button type="button" class="btn dark btn-outline" data-dismiss="modal">{{trans('template.common.close')}}</button>
						<button type="button" class="btn green" id="saveMenuItem">{{trans('template.common.savechanges')}} </button>
				 </div>
			</div>
	 </div>
</div>
<div class="modal new_modal fade bs-modal-sm" id="new-menu-add" tabindex="-1" role="dialog" aria-hidden="true">
	 <div class="modal-dialog modal-sm">
			<div class="modal-vertical">
				 <div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							 <h4 class="modal-title">{{trans('template.menuModule.newMenu')}} </h4>
						</div>
						<div class="modal-body">
							 <div class="form-group">
									<label class="control-label form_title">{{trans('template.common.title')}} <span aria-required="true" class="required"> * </span></label>                     
									<input type="text" maxlength="50" class="form-control hasAlias" data-url = 'powerpanel/menu' name="newMenuTitle" id="newMenuTitle" placeholder="{{trans('template.common.title')}}" />
									<span id="menuTitleErrT" style="color: red;"></span>
									{!! Form::hidden('alias', null, array('class' => 'aliasField')) !!}
							 </div>
						</div>
						<div class="modal-footer">
							 <button type="button" class="btn red btn-outline " data-dismiss="modal">{{trans('template.common.close')}} </button>
							 <button type="button" class="btn btn-green-drake" id="saveNewMenu">{{trans('template.common.add')}} </button>
						</div>
				 </div>
			</div>
	 </div>
</div>
<div class="modal new_modal fade bs-modal-md" id="confirm" tabindex="-1" role="dialog" aria-hidden="true">
	 <div class="modal-dialog modal-md">
			<div class="modal-vertical">
				 <div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							 {{trans('template.common.confirm')}}
						</div>
						<div class="modal-body text-center">
							 {{trans('template.common.areyosureyouwanttodelete')}}  <span class="delMsg"></span>?
						</div>
						<div class="modal-footer">
							 <button type="button" id="delete" class="btn red btn-outline">{{trans('template.common.delete')}}</button>
							 <button type="button" class="btn btn-green-drake" data-dismiss="modal">{{trans('template.common.close')}}</button>       
						</div>
				 </div>
			</div>
	 </div>
</div>
@endsection
@section('scripts')
<!-- Dragabale menu scripts -->
<script type="text/javascript">var rootUrl="{{ URL::to('/') }}"; var moduleAlias=""; var user_action ='add'</script>
<script src="{{ asset('assets/global/plugins/jquery-nestable/jquery.nestable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-nestable/ui-nestable.js') }}" type="text/javascript"></script>  
<script src="{{ asset('assets/global/plugins/jquery-nestable/nestable.config.js') }}" type="text/javascript"></script>  
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- End dragabale menu scripts -->

<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>
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
@endsection