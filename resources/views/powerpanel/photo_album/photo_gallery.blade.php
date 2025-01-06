<div class="portlet-title">
	@if($photoGalleryObj->count() > 0)
	<h3>{{ trans('template.photoAlbum.photoGallery') }}</h3>
	@endif
	<div class="clearfix"></div>
	<div class="portlet-body">
		<div class="row">
			@if($photoGalleryObj->links())
			@if($photoGalleryObj->count() > 0)
			<div class="col-md-6 text-right">
				{{ $photoGalleryObj->links() }}
			</div>
			<!-- <div class="col-md-6 text-right">
						View: &nbsp;&nbsp;
						<div class="btn-group">
									<input class="form-control" name="display_order" type="text">
						</div>
			</div> -->
			<div class="clearfix"></div>
			@endif
			@endif
		</div>
		<div class="row text-center pg_main_border">
			@if($photoGalleryObj->count() > 0)
			@foreach ($photoGalleryObj as $key => $value)
			<div class="col-md-3 col-sm-4 col-xs-6 col-xs-small img_{{ $value->id  }}">
				<div class="team_box">
					<div class="thumbnail_container">
						<div class="thumbnail photo_gallery_{{ $value->id }}">
							<img src="{!! App\Helpers\resize_image::resize($value->fkIntImgId,230,150) !!}" />
						</div>
						<div class="nqimg_mask">
							<div class="nqimg_inner">
								<a class="btn btn-green-drake fancybox-buttons image_iframe_{{ $value->id  }}" data-rel="fancybox-buttons" title="{{ $value->varTitle }}" href="{!! App\Helpers\resize_image::resize($value->fkIntImgId,800,800) !!}"><i class="fa fa-link"></i></a>
								<a onclick="MediaManager.open('photo_gallery',{{ $value->id  }});" class="btn btn-green-drake media_manager image_gallery_change_{{ $value->id  }}" title="{{ $value->varTitle }}" href="javascript:void(0);"><i class="fa fa-edit"></i></a>
								<input class="image_{{ $value->id }}" type="hidden" id="photo_gallery" name="img_id" value="{{ $value->fkIntImgId }}" />
							</div>
						</div>
					</div>
					<div class="team_desc">
						<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
							<tr>
								<td colspan="2" align="left" valign="middle">
									<div class="form-group form-md-line-input">
										<textarea id="title_{{ $value->id }}"  name="title" class="form-control edited" rows="1">{{ $value->varTitle }}</textarea>
										<label class="site_name form_title text-left">{{ trans('template.common.title') }}</label>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="left" valign="middle">
									<div class="form-group  form-md-line-input">
										<input id="display_order_{{ $value->id }}" class="form-control edited" value="{{ $value->intDisplayOrder }}" name="display_order" type="text">
										<label class="form_title site_name text-left">{{ trans('template.common.displayorder') }}</label>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2" width="100%" align="left" valign="middle">
									<ul class="nqsocia">
										@permission('photo-gallery-edit')
										<li><a href="javascript:void(0);" onclick="update_data('{{ $value->id }}')" title="save" class="sn"><i class="fa fa-save"></i></a>
									</li>
									@endpermission
									
									@permission('photo-gallery-publish')
										@if($value->chrPublish == 'Y')
										<li>
											<a href="javascript:void(0);" data-status = "{{ $value->chrPublish  }}" onclick="update_status('{{ $value->id }}')"  title="Publish" class="sn status_{{ $value->id }}"><i class="fa fa-eye"></i></a>
										</li>
										@else
										<li>
											<a href="javascript:void(0);" data-status = "{{ $value->chrPublish  }}" onclick="update_status('{{ $value->id }}')" title="Unpublish" class="sn status_{{ $value->id }}"><i class="fa fa-eye-slash"></i></a>
										</li>
										@endif
									@endpermission

									@permission('photo-gallery-delete')
									<li>
										<a href="javascript:void(0);" onclick="remove('{{ $value->id }}')" title="Delete" class="sn">
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
		@endforeach
		@else
		<div class="col-md-12">
			<h2>{{ trans('template.photoAlbum.uploadYourImages') }}</h2>
		</div>
		@endif
	</div>
	@if($photoGalleryObj->links())
	@if($photoGalleryObj->count() > 0)
	<div class="row">
		<div class="col-md-12 text-right">
			{{ $photoGalleryObj->links() }}
		</div>
	</div>
	@endif
	@endif
	
</div>
</div>