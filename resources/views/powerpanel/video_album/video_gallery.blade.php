<div class="portlet-title select_box service_select_box">

	<div class="clearfix"></div>
	<div class="portlet-body">
		<div class="row">
			@if($videoGalleryObj->count() > 0)
			<div class="col-md-6">
				<h3>{{ trans('template.common.videoGallery') }}</h3>
			</div>
			 @endif 
			 @if($videoGalleryObj->links())
				@if($videoGalleryObj->count() > 0)
					<div class="col-md-6 text-right">
						{{ $videoGalleryObj->links() }}
					</div>
				@endif
			 @endif 
		</div>	
		<div class="row text-center pg_main_border">
			@if($videoGalleryObj->count() > 0)
				@foreach ($videoGalleryObj as $key => $value)
					@if(isset($value->video))
					<div class="col-md-3 col-sm-4 col-xs-6 col-xs-small img_{{ $value->id  }}">
						<div class="team_box">			                        
							<div class="thumbnail_container">
								<div class="thumbnail video_gallery_{{ $value->id  }}">
										<!-- <img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" /> -->
							@if(!empty($value->video->youtubeId))	
								<img src='http://img.youtube.com/vi/{{ $value->video->youtubeId }}/default.jpg' />
							@else
							 	<img class="img_opacity" src="{{ url('resources\images\video_upload_file.gif') }}" />
							@endif	
								</div>
								<div class="nqimg_mask">
									<div class="nqimg_inner">
										@if(!empty($value->video->youtubeId))	
											<a class="btn btn-green-drake fancybox-buttons fancybox fancybox.iframe video_iframe_{{ $value->id  }}" data-rel="fancybox-buttons" data-fancybox-group="gallery" title="{{ $value->video->varVideoName }}" href="http://www.youtube.com/embed/{{ $value->video->youtubeId  }}?autoplay=1"><i class="fa fa-link"></i></a>
											<a onclick="MediaManager.openVideoManager('video_gallery',{{ $value->id  }});" class="btn btn-green-drake video_manager video_gallery_change_{{ $value->id  }}" title="{{ $value->video->varVideoName }}" href="javascript:void(0);"><i class="fa fa-edit"></i></a>
											<input class="video_{{ $value->id }}" type="hidden" id="video_gallery" name="video_id" value="{{ $value->fkIntVideoId }}" />
										@else 
											<a class="btn btn-green-drake fancybox-buttons  fancybox fancybox.iframe video_iframe_{{ $value->id  }}" data-rel="fancybox-buttons" data-fancybox-group="gallery" title="{{ $value->video->varVideoName }}.{{ $value->video->varVideoExtension }}" href="{{ url('/') }}/assets/videos/{{ $value->video->varVideoName }}.{{ $value->video->varVideoExtension }}"><i class="fa fa-link"></i></a>
											<a onclick="MediaManager.openVideoManager('video_gallery',{{ $value->id  }});" class="btn btn-green-drake video_manager video_gallery_change_{{ $value->id  }}" title="{{ $value->video->varVideoName }}.{{ $value->video->varVideoExtension }}" href="javascript:void(0);"><i class="fa fa-edit"></i></a>
											<input class="video_{{ $value->id }}" type="hidden" id="video_gallery" name="video_id" value="{{ $value->fkIntVideoId }}" />
										@endif			
									</div>
								</div>
							</div>
							<div class="team_desc">
								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
									<tr>
										<td colspan="2" align="left" valign="middle">
											<div class="form-group  form-md-line-input">
												<textarea id="title_{{ $value->id }}"  name="title" class="form-control edited" rows="1">{{ $value->varTitle }}</textarea>
												<label class="site_name text-left form_title">{{ trans('template.common.title') }}</label>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="left" valign="middle">
											<div class="form-group form-md-line-input">
												<input id="display_order_{{ $value->id }}" class="form-control edited" value="{{ $value->intDisplayOrder }}" name="display_order" type="text">
												<label class="site_name text-left form_title">{{ trans('template.common.displayorder') }}</label> 
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2" width="100%" align="left" valign="middle">
											<ul class="nqsocia">
												@permission('video-gallery-edit')	
													<li><a href="javascript:void(0);" onclick="update_data('{{ $value->id }}')" title="{{ trans('template.common.save') }}" class="sn"><i class="fa fa-save"></i></a>
													</li>
													@endpermission
													@permission('video-gallery-publish')	
														@if($value->chrPublish == 'Y')
															<li>
																<a href="javascript:void(0);" data-status = "{{ $value->chrPublish  }}" onclick="update_status('{{ $value->id }}')"  title="{{ trans('template.common.publish') }}" class="sn status_{{ $value->id }}"><i class="fa fa-eye"></i></a>
															</li>
														@else 
															<li>
																<a href="javascript:void(0);" data-status = "{{ $value->chrPublish  }}" onclick="update_status('{{ $value->id }}')" title="{{ trans('template.common.unpublish') }}" class="sn status_{{ $value->id }}"><i class="fa fa-eye-slash"></i></a>
															</li>
														@endif
													@endpermission
													@permission('video-gallery-delete')
													<li>
														<a href="javascript:void(0);" onclick="remove('{{ $value->id }}')" title="{{ trans('template.common.delete') }}" class="sn">
															<i class="fa fa-remove"></i>
														</a>
													</li>
													@endpermission
											</ul>
										</td>
									</tr>
								</table>			                            
							</div>
						</div>
					</div>
					@endif
				@endforeach
			  @else  
			  <div class="col-md-12">
					<h2>{{ trans('template.videoGalleryModule.uploadYourVideos') }}</h2>
				</div>
				@endif 
		</div>
		@if($videoGalleryObj->links())
		 @if($videoGalleryObj->count() > 0)
			<div class="row">
				<div class="col-md-12 text-right">
					{{ $videoGalleryObj->links() }}
				</div>
			</div>
		@endif
	  @endif 
	</div>
</div>