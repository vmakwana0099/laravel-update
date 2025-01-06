@section('css')
<link href="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection
@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@php $settings = json_decode(Config::get("Constant.MODULE.SETTINGS")); @endphp
@section('content')
@include('powerpanel.partials.breadcrumbs')
<div class="row">
	<div class="col-sm-12">
		@if(Session::has('message'))
		<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
			{{ Session::get('message') }}
		</div>
		@endif
		<div class="portlet light bordered">
			<div class="portlet-body">
				<div class="tabbable tabbable-tabdrop">
					<div class="tab-content">
						<div class="row">
							<div class="col-md-12">
								<div class="tab-pane active" id="general">
									<div class="portlet-body form_pattern">
										{!! Form::open(['method' => 'post','id'=>'frmProject']) !!}
										<div class="form-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">                                                                                                                                            
													<label class="form_title" for="category_id">Select Category <span aria-required="true" class="required"> * </span></label>
													<select id="category_id" class="form-control bs-select select2" data-show-subtext="true" name="category" aria-invalid="false">
													<option value="">Select Category</option>
													<?php if(count($ProjectCategory) > 0) {
														$selectId = !empty(Request::query('category'))?Request::query('category'):1;
														foreach($ProjectCategory as $category) {
																if(isset($project)) {
																		if(isset($category['children'])) {
																				$catValue = $category['children'][0]['id'];
																				$catName = $category['children'][0]['text'];
																				if($project->intCategory == $category['children'][0]['id']) {
																						$selectId = $project->intCategory;
																				}
																		} else {
																				$catValue = $category['id'];
																				$catName = $category['text'];
																				if($project->intCategory == $category['id']) {
																						$selectId = $project->intCategory;
																				}
																		}
																} else {
																		if(isset($category['children'])) {
																				$catValue = $category['children'][0]['id'];
																				$catName = $category['children'][0]['text'];
																		} else {
																				$catValue = $category['id'];
																				$catName = $category['text'];
																		}
																}
													?>
													@if($catName !="Add Category")
													<option value="<?php echo $catValue; ?>"<?php echo $selectId == $catValue ? ' selected="selected"' : ''; ?>><?php echo $catName; ?></option>
													@endif
													<?php }
													} ?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form_title" for="status_id">Select User</label>
												<select id="team_id" class="form-control bs-select select2" data-show-subtext="true" name="team" aria-invalid="false">
												<option value="">Select User</option>
													<?php if(count($projectTeam) > 0) {
															$selectId = '';
															foreach($projectTeam as $team) {
																	if(isset($project) && $project->fkIntTeam == $team['id']) {
																			$selectId = $project->fkIntTeam;
													} ?>
													<option value="<?php echo $team['id']; ?>"<?php echo $selectId == $team['id'] ? ' selected="selected"' : ''; ?>><?php echo $team['name']; ?></option>
													<?php }
													} ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group @if($errors->first('title')) has-error @endif form-md-line-input">
												{!! Form::text('title', isset($project->varTitle)?$project->varTitle:old('title'), array('maxlength' => 150, 'class' => 'form-control hasAlias seoField maxlength-handler','autocomplete'=>'off','data-url' => 'powerpanel/projects')) !!}
												<label class="form_title" class="site_name">{{ trans('template.common.title') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('title') }}
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<!-- code for alias -->
											{!! Form::hidden(null, null, array('class' => 'hasAlias','data-url' => 'powerpanel/projects')) !!}
											{!! Form::hidden('alias', isset($project->alias->varAlias)?$project->alias->varAlias:old('alias'), array('class' => 'aliasField')) !!}
											{!! Form::hidden('oldAlias', isset($project->alias->varAlias)?$project->alias->varAlias:old('alias')) !!}
											<div class="form-group alias-group {{!isset($project)?'hide':''}}">
												<label class="form_title" for="{{ trans('template.url') }}">{{ trans('template.common.url') }} :</label>
												<a href="javascript:void;" class="alias">{!! url("/") !!}</a>
												<a href="javascript:void(0);" class="editAlias" title="Edit">
													<i class="fa fa-edit"></i>
													<a class="without_bg_icon openLink" title="Open Link" target="_blank" href="{{url('projects/'.(isset($project->alias->varAlias) && isset($project)?$project->alias->varAlias:''))}}">
														<i class="fa fa-external-link" aria-hidden="true"></i>
													</a>
												</a>
											</div>
											<span class="help-block">
												{{ $errors->first('alias') }}
											</span>
											<!-- code for alias -->
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<?php $bedsDisplayClass = $bathsDisplayClass = '';
													$widthDisplayClass = $depthDisplayClass = ' hide';
													if(isset($project)) {
															if($project->intCategory == 1) {
																	$bedsDisplayClass = '';
																	$bathsDisplayClass = '';
															} else if($project->intCategory == 2) {
																	$bedsDisplayClass = ' hide';
																	$bathsDisplayClass = '';
															} else if($project->intCategory == 3) {
																	$widthDisplayClass = '';
																	$depthDisplayClass = '';
															}
													}
												?>
												<div id="projectbedshtml" class="col-md-4<?php echo $bedsDisplayClass; ?>">
													<div class="form-group @if($errors->first('beds')) has-error @endif form-md-line-input">
														{!! Form::text('beds', (isset($project->intBeds) && $project->intBeds != 0)?$project->intBeds:old('beds'), array('class' => 'form-control amountfield','id'=>'varBeds')) !!}
														<label class="form_title">Beds</label>
														<span class="help-block">{{ $errors->first('beds') }}</span>
													</div>
												</div>
												<div id="projectbathshtml" class="col-md-4<?php echo $bathsDisplayClass; ?>">
													<div class="form-group @if($errors->first('baths')) has-error @endif form-md-line-input">
														{!! Form::text('baths', (isset($project->fltBaths) && $project->fltBaths != 0)?$project->fltBaths:old('baths'), array('class' => 'form-control amountfield','id'=>'varBaths')) !!}
														<label class="form_title">Baths</label>
														<span class="help-block">{{ $errors->first('baths') }}</span>
													</div>
												</div>
												<div id="projectwidthhtml" class="col-md-4<?php echo $widthDisplayClass; ?>">
													<div class="form-group @if($errors->first('width')) has-error @endif form-md-line-input">
														{!! Form::text('width', (isset($project->fltWidth) && $project->fltWidth != 0)?$project->fltWidth:old('width'), array('class' => 'form-control amountfield','id'=>'varWidth')) !!}
														<label class="form_title">Width</label>
														<span class="help-block">{{ $errors->first('beds') }}</span>
													</div>
												</div>
												<div id="projectdepthhtml" class="col-md-4<?php echo $depthDisplayClass; ?>">
													<div class="form-group @if($errors->first('depth')) has-error @endif form-md-line-input">
														{!! Form::text('depth', (isset($project->fltDepth) && $project->fltDepth != 0)?$project->fltDepth:old('depth'), array('class' => 'form-control amountfield','id'=>'varDepth')) !!}
														<label class="form_title">Depth</label>
														<span class="help-block">{{ $errors->first('baths') }}</span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group @if($errors->first('land_size')) has-error @endif form-md-line-input">
														{!! Form::text('land_size', (isset($project->fltLandSize) && $project->fltLandSize != 0)?$project->fltLandSize:old('land_size'), array('class' => 'form-control amountfield','id'=>'varLandSize')) !!}
														<label class="form_title">Unit Size (sq ft.)</label>
														<span class="help-block">{{ $errors->first('land_size') }}</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form_title" for="currency_id">Select Currency</label>
												<select class="form-control bs-select select2" data-show-subtext="true" name="currency" aria-invalid="false">
													<option value=""<?php echo (!isset($project)) ? ' selected="selected"' : ''; ?>>Select Currency</option>
													<option value="US$"<?php echo (isset($project) && $project->varCurrency == 'US$') ? ' selected="selected"' : ''; ?>>US$</option>
													<option value="KY$"<?php echo (isset($project) && $project->varCurrency == 'KY$') ? ' selected="selected"' : ''; ?>>KY$</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group @if($errors->first('sale_price')) has-error @endif form-md-line-input" id="sale_price_div">
												{!! Form::text('sale_price', isset($project->fltSalePrice)?$project->fltSalePrice:old('sale_price'), array('class' => 'form-control amountfield disabled','id'=>'varSalePrice')) !!}
												<label class="form_title">Price</label>
												<span class="help-block">{{ $errors->first('sale_price') }}</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group @if($errors->first('short_description')) has-error @endif form-md-line-input">
												{!! Form::textarea('short_description', isset($project->txtShortDescription)?$project->txtShortDescription:old('short_description'), array('maxlength' => 400,'class' => 'form-control seoField maxlength-handler','id'=>'varShortDescription','rows'=>'3')) !!}
												<label class="form_title">Features</label>
												<span class="help-block">{{ $errors->first('short_description') }}</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="form_title" for="status_id">Select Status <span aria-required="true" class="required"> * </span></label>
												<select id="status_id" class="form-control bs-select select2" data-show-subtext="true" size="10" name="status" aria-invalid="false">
													<option value="">Select Status</option>
													<?php if(count($projectStatus) > 0) {
													foreach($projectStatus as $status) { ?>
													<option value="<?php echo $status['id']; ?>"<?php echo (isset($project) && $project->intStatus == $status['id']) ? ' selected="selected"' : ''; ?>><?php echo $status['text']; ?></option>
													<?php }
													} ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group @if($errors->first('description')) has-error @endif ">
												<label class="control-label form_title">{{ trans('template.common.description') }}</label>
												{!! Form::textarea('description', isset($project->txtDescription)?$project->txtDescription:old('description'), array('placeholder' => trans('template.common.description'),'class' => 'form-control','id'=>'txtDescription')) !!}
												<span class="help-block">{{ $errors->first('description') }}</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class=" form-md-line-input nopadding">
												<h3 class="form-section">Address and Project Location</h3>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group @if($errors->first('address')) has-error @endif form-md-line-input">
														{!! Form::text('address', isset($project->txtAddress)?$project->txtAddress:old('address'), array('class' => 'form-control','id'=>'autocomplete','onfocus'=>'geolocate()')) !!}
														<label class="form_title">Address</label>
														<span class="help-block">{{ $errors->first('address') }}</span>
													</div>
												</div>
												<div class="col-md-12">
													<div id="map" style="margin-left: 0px; margin-top: 15px; margin-bottom: 10px; width:100%;height:220px;"></div>
													<div id="infowindow-content" style="display:none;">
														<span id="place-name"  class="title"></span><br>
														Place ID <span id="place-id"></span><br>
														<span id="place-address"></span>
													</div>
													<p style="float:right;"><strong>Note:</strong> User Map Pin to get the Latitude, Longitude automatically.</p>
												</div>
												<div class="col-md-6">
													<div class="form-group @if($errors->first('latitude')) has-error @endif form-md-line-input">
														{!! Form::text('latitude', isset($project->varLatitude)?$project->varLatitude:old('latitude'), array('id' => 'latbox', 'class' => 'form-control','readonly'=>'readonly')) !!}
														<label class="form_title" class="site_name">Latitude</label>
														<span class="help-block">
															{{ $errors->first('latitude') }}
														</span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group @if($errors->first('longitude')) has-error @endif form-md-line-input">
														{!! Form::text('longitude', isset($project->varLongitude)?$project->varLongitude:old('longitude'), array('id' => 'lonbox', 'class' => 'form-control', 'readonly'=>'readonly')) !!}
														<label class="form_title" class="site_name">Longitude</label>
														<span class="help-block">
															{{ $errors->first('longitude') }}
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="image_thumb multi_upload_images">
												<div class="form-group">
													<label class="form_title">Select Documents</label>
													<div class="clearfix"></div>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
															<img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
														</div>
														<div class="input-group">
															<a class="document_manager multiple-selection" data-multiple=true onclick="MediaManager.openDocumentManager('project');"><span class="fileinput-new"></span></a>
															<input class="form-control" type="hidden" id="project" name="doc_id" value="{{ isset($project->fkIntDocId)?$project->fkIntDocId:old('doc_id') }}" />
														</div>
													</div>
												</div>
												<div class="clearfix"></div>
												<span>Click above to upload new documents</span><br />
												<span>(Recommended documents *.txt, *.pdf, *.doc, *.docx, *.ppt, *.xls formats are supported. Document should be maximum size of 10 MB.)</span>
											</div>
										</div>
										@if(!empty($project->fkIntDocId) && isset($project->fkIntDocId))
										@php $docsArr = explode(',',$project->fkIntDocId)  @endphp
										<div class="col-md-12" id="project_documents">
											<div class="multi_image_list" id="multi_document_list">
												<ul>
													@foreach($docsArr as $key => $value)
													<li id="doc_{{ $value }}">
														<span>
															<img  src="{{ url('/assets/images/document_icon.png') }}" alt="Img" />
															<a href="javascript:;" onclick="MediaManager.removeDocumentFromGallery('{{ $value }}');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
														</span>
													</li>
													@endforeach
												</ul>
											</div>
										</div>
										@else
										<div class="col-md-12" id="project_documents"></div>
										@endif
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="image_thumb multi_upload_images">
												<div class="form-group">
													<label class="form_title" for="front_logo">{{ trans('template.common.selectimage') }}</label>
													<div class="clearfix"></div>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
															<img class="img_opacity" src="{{ url('resources\images\upload_file.gif') }}" />
														</div>
														<div class="input-group">
															<a class="media_manager multiple-selection" data-multiple=true onclick="MediaManager.open('project_image');"><span class="fileinput-new"></span></a>
															<input class="form-control" type="hidden" id="project_image" name="img_id" value="{{ isset($project->fkIntImgId)?$project->fkIntImgId:old('img_id') }}" />
															<input class="form-control" type="hidden" id="image_url" name="image_url" value="{{ Input::old('image_url') }}" />
														</div>
													</div>
													<div class="clearfix"></div>
													@if(!empty($project->fkIntImgId) && isset($project->fkIntImgId))
													@php $imageArr = explode(',',$project->fkIntImgId)  @endphp
													<div id="project_image_img">
														<div class="multi_image_list">
															<ul>
																@foreach($imageArr as $key => $value)
																<li id="{{ $value }}">
																	<span>
																		<img src="{!! App\Helpers\resize_image::resize($value,109,100) !!}" alt="Img" />
																		<a href="javascript:;" onclick="MediaManager.removeImageFromGallery('{{ $value }}');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
																	</span>
																</li>
																@endforeach
															</ul>
														</div>
													</div>
													@else
													<div  id="project_image_img"></div>
													@endif
													@php $height = isset($settings->height)?$settings->height:500; $width = isset($settings->width)?$settings->width:500; @endphp <span>Click above to upload new images</span><br /><span>{{ trans('template.common.imageSize',['height'=>$height, 'width'=>$width]) }}</span>
												</div>
											</div>
										</div>
									</div>
									<!--Multiple Video Uploader-->
									<div class="row viduploader">
										<div class="col-md-12">
											<div class="image_thumb">
												<div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }} ">
													<label class="form_title" for="front_logo">{{ trans('template.projectModule.selectVideo') }} </label>
													<div class="clearfix"></div>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail project_video_vid" data-trigger="fileinput" style="width:100%;float:left; height:120px;position: relative;">
															@if(Input::old('video_url'))
															<img src="{{ Input::old('video_url') }}" />
															@else
															<img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" />
															@endif
														</div>
														<div class="input-group">
															<a class="video_manager multiple-selection" data-multiple=true onclick="MediaManager.openVideoManager('project_video');"><span class="fileinput-new"></span></a>
															<input class="form-control" type="hidden" id="project_video" name="video_id" value="{{ isset($project->fkIntVideoId)?$project->fkIntVideoId:old('video_id') }}" />
															<input class="form-control" type="hidden" id="video_url" name="video_url" value="{{ Input::old('video_url') }}" />
														</div>
														@if(!empty($project->fkIntVideoId) && isset($project->fkIntVideoId))
														@php $imageArr = explode(',',$project->fkIntVideoId)  @endphp
														<div  id="project_video_vid" class="video_list">
															<div class="multi_image_list">
																<ul>
																	@foreach($project['videos'] as $key => $value)
																	<li id="{{ $value->id }}">
																		<span>
																			@if(!empty($value->youtubeId))
																			<img title="{{ $value->varVideoName }}" src="https://img.youtube.com/vi/{{ $value->youtubeId }}/mqdefault.jpg">
																			@else
																			<img title="{{ $value->txtVideoOriginalName }}" class="img_opacity" src="{{ url('/')}}/resources\images\video_upload_file.gif">
																			@endif
																			<a href="javascript:;" onclick="MediaManager.removeVideoFromVideoManager('{{ $value->id }}');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
																		</span>
																	</li>
																	@endforeach
																</ul>
															</div>
														</div>
														@else
														<div id="project_video_vid" class="video_list"></div>
														@endif
													</div>
												</div>
												<div class="clearfix"></div>
												<span>Click above to insert Youtube videos</span> <span style="color:#e73d4a"> {{ $errors->first('video_id') }}</span> </div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													@if ( !isset($project->varFeaturedProject) ||(isset($project->varFeaturedProject) && $project->varFeaturedProject == 'N'))
													@php $featured_checked_no = 'checked'  @endphp
													@else
													@php $featured_checked_no = '' @endphp
													@endif
													@if ((isset($project->varFeaturedProject) && $project->varFeaturedProject == 'Y') || old('featuredProject')=='Y')
													@php $featured_checked_yes = 'checked'  @endphp
													@else
													@php $featured_checked_yes = ''  @endphp
													@endif
													<label class="control-label form_title">Is Featured Project?</label>
													<div class="md-radio-inline">
														<div class="md-radio">
															<input class="md-radiobtn" type="radio" value="Y" name="featuredProject" id="featuredProjectY" {{ $featured_checked_yes }}>
															<label for="featuredProjectY"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.yes') }} </label>
														</div>
														<div class="md-radio">
															<input class="md-radiobtn" type="radio" value="N" name="featuredProject" id="featuredProjectN" {{ $featured_checked_no }}/>
															<label for="featuredProjectN"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.no') }} </label>
														</div>
													</div>
													<div class="clearfix"></div>
													<span><strong>{{ trans('template.common.note') }}: {{ trans('template.projectModule.featuredProjectNote') }}*</strong></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class=" form-md-line-input nopadding">
													@include('powerpanel.partials.seoInfo',['form'=>'frmProject','inf'=>isset($metaInfo)?$metaInfo:false])
												</div>
											</div>
										</div>
										<h3 class="form-section">{{ trans('template.common.displayinformation') }}</h3>
										<div class="row">
											<div class="col-md-6">
												@php
												$display_order_attributes = array('class' => 'form-control','maxlength'=>10,'placeholder'=>trans('template.common.displayorder'),'autocomplete'=>'off');
												/* if(!isset($project->intDisplayOrder)){
												$display_order_attributes['readonly'] = "readonly";
												} */
												@endphp
												<div class="form-group @if($errors->first('display_order')) has-error @endif form-md-line-input">
													{!! Form::text('display_order', isset($project->intDisplayOrder)?$project->intDisplayOrder:1, $display_order_attributes) !!}
													<label class="form_title" class="site_name">{{ trans('template.common.displayorder') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('display_order') }}
													</span>
												</div>
											</div>
											<div class="col-md-6">
												@include('powerpanel.partials.displayInfo',['display' => isset($project->chrPublish)?$project->chrPublish:'Y'])
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-12">
												<button type="submit" name="saveandedit" class="btn btn-green-drake" value="saveandedit">{!! trans('template.common.saveandedit') !!}</button>
												<button type="submit" name="saveandexit" class="btn btn-green-drake" value="saveandexit">{!! trans('template.common.saveandexit') !!}</button>
												<a class="btn btn-outline red" href="{{ url('powerpanel/projects') }}">{!! trans('template.common.cancel') !!}</a>
											</div>
										</div>
									</div>
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@include('powerpanel.partials.addCat',['module' => 'project-category','categoryHeirarchy' => $categoryHeirarchy])
@endsection
@section('scripts')
<script type="text/javascript">
window.site_url = '{!! url("/") !!}';
var seoFormId = 'frmProject';
var user_action = "{{ isset($project)?'edit':'add' }}";
var moduleAlias = 'projects';
var categoryAllowed = false;
@permission('project-category-list')
categoryAllowed = true;
@endpermission
</script>
<!-- Map Functionality -->
<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
var autocomplete;
function initAutocomplete() {
// Create the autocomplete object, restricting the search to geographical
// location types.
autocomplete = new google.maps.places.Autocomplete(
/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
{types: ['geocode'], componentRestrictions: {country: 'cym'}});
// When the user selects an address from the dropdown, populate the address
// fields in the form.
//autocomplete.addListener('place_changed');
}
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
if(navigator.geolocation) {
navigator.geolocation.getCurrentPosition(function(position) {
var geolocation = {
lat: position.coords.latitude,
lng: position.coords.longitude
};
var circle = new google.maps.Circle({
center: geolocation,
radius: position.coords.accuracy
});
autocomplete.setBounds(circle.getBounds());
});
}
}
</script>
<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBqof4FJWnGe2eCCG8HGXMajO1TiaxkVf4&libraries=places&callback=initAutocomplete"></script>
<script type="text/javascript">
var latval = "{{ isset($project->varLatitude)?$project->varLatitude:'' }}";
var longval = "{{ isset($project->varLongitude)?$project->varLongitude:'' }}";
if((latval == '' && longval == '')) {
var geocoder = new google.maps.Geocoder();
geocoder.geocode({
//'address': address
}, function(results, status) {
if(status == google.maps.GeocoderStatus.OK) {
latval = results[0].geometry.location.lat();
longval = results[0].geometry.location.lng();
}
});
}
if(latval == '' && longval == '') {
latval = '19.321187240779548';
longval = '-81.2274169921875';
var lat = parseFloat(latval);
var lng = parseFloat(longval);
var latlng = new google.maps.LatLng(lat, lng);
var geocoder = geocoder = new google.maps.Geocoder();
geocoder.geocode({
'latLng': latlng
}, function(results, status) {
if(status == google.maps.GeocoderStatus.OK) {
if(results[1]) {
//$('#address').blur();
}
}
});
}
var markers = [];
var defaultposition;
var mapOptions = {
zoom: 11,
streetViewControl: false,
center: new google.maps.LatLng(latval, longval),
mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(document.getElementById('map'), mapOptions);
defaultposition = new google.maps.LatLng(latval, longval);
addMarker(defaultposition);
google.maps.event.addListener(map, 'click', function(event) {
var lat = parseFloat(event.latLng.lat());
var lng = parseFloat(event.latLng.lng());
var latlng = new google.maps.LatLng(lat, lng);
var geocoder = geocoder = new google.maps.Geocoder();
geocoder.geocode({
'latLng': latlng
}, function(results, status) {
if(status == google.maps.GeocoderStatus.OK) {
if(results[0]) {
//document.getElementById("address").value = results[0].formatted_address;
//$('#address').blur();
}
}
});
clearMarkers();
addMarker(event.latLng);
document.getElementById("latbox").value = event.latLng.lat();
document.getElementById("lonbox").value = event.latLng.lng();
$('#latbox').blur();
$('#lonbox').blur();
});
function addMarker(location) {
var marker = new google.maps.Marker({
animation: google.maps.Animation.DROP,
position: location,
draggable: true,
map: map
});
markers.push(marker);
}
function clearMarkers() {
setAllMap(null);
}
function setAllMap(map) {
for(var i = 0; i < markers.length; i++) {
markers[i].setMap(map);
}
}
</script>
<script src="{{ url('resources/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script src="{{ url('resources/pages/scripts/custom.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/custom-alias/alias-generator.js') }}" type="text/javascript"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="{{ url('resources/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ url('resources/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/seo-generator/seo-info-generator.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/pages/scripts/project_validations.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection