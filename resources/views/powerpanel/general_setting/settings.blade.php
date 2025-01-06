@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('content')
@include('powerpanel.partials.breadcrumbs')
<div class="row">
	<div class="col-md-12">
		@if(Session::has('message'))
		<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
			{{ Session::get('message') }}
		</div>
		@endif
		<div class="portlet light bordered">
			<div class="portlet-body form_pattern">
				<div class="tabbable tabbable-tabdrop">
					@if(empty($tab_value))
					@php
					$general_blank_tab_active = 'active'
					@endphp
					@else
					@php
					$general_blank_tab_active = ''
					@endphp
					@endif
					@permission('settings-general-setting-management')
					@if($tab_value=='general_settings')
					@php
					$general_tab_active = 'active'
					@endphp
					@else
					@php
					$general_tab_active = ''
					@endphp
					@endif
					@endpermission
					@permission('settings-smtp-mail-setting')
					@if($tab_value=='smtp_settings')
					@php
					$smtp_tab_active = 'active'
					@endphp
					@else
					@php
					$smtp_tab_active = ''
					@endphp
					@endif
					@endpermission
					@permission('settings-seo-setting')
					@if($tab_value=='seo_settings')
					@php
					$seo_tab_active = 'active'
					@endphp
					@else
					@php
					$seo_tab_active = ''
					@endphp
					@endif
					@endpermission
					@permission('settings-social-setting')
					@if($tab_value=='social_settings')
					@php
					$social_tab_active = 'active'
					@endphp
					@else
					@php
					$social_tab_active = ''
					@endphp
					@endif
					@endpermission
					@permission('settings-social-media-share-setting')
					@if($tab_value=='social_share_settings')
					@php
					$social_share_tab_active = 'active'
					@endphp
					@else
					@php
					$social_share_tab_active = ''
					@endphp
					@endif
					@endpermission
					@permission('settings-other-setting')
					@if($tab_value=='other_settings')
					@php
					$other_tab_active = 'active'
					@endphp
					@else
					@php
					$other_tab_active = ''
					@endphp
					@endif
					@endpermission
					
					@permission('settings-maintenance-setting')
					@if($tab_value=='maintenance')
					@php
					$maintenance_tab_active = 'active'
					@endphp
					@else
					@php
					$maintenance_tab_active = ''
					@endphp
					@endif
					@endpermission
					@permission('settings-module-setting')
					@if($tab_value=='module')
					@php
					$module_tab_active = 'active';
					$general_tab_active='';
					$general_blank_tab_active='';
					@endphp
					@else
					@php
					$module_tab_active = ''
					@endphp
					@endif
					@endpermission
					<div class="notify"></div>
					<ul class="nav nav-pills tab_section">
						@permission('settings-general-setting-management')
						<li class="{{$general_tab_active}} {{$general_blank_tab_active}}">
							<a href="#general" data-toggle="tab">{{ trans('template.setting.general') }}</a>
						</li>
						@endpermission
						@permission('settings-smtp-mail-setting')
						<li class="{{$smtp_tab_active}}">
							<a href="#smtp-mail" data-toggle="tab">
							{{ trans('template.setting.SMTPMail') }} </a>
						</li>
						@endpermission
						@permission('settings-seo-setting')
						<li class="{{$seo_tab_active}}">
							<a href="#seo" data-toggle="tab">{{ trans('template.setting.seo') }}</a>
						</li>
						@endpermission
						@permission('settings-social-setting')
						<li class="{{$social_tab_active}}">
							<a href="#social" data-toggle="tab">{{ trans('template.setting.social') }}</a>
						</li>
						@endpermission
						@permission('settings-social-media-share-setting')
						<li class="{{$social_share_tab_active}}">
							<a href="#socialshare" data-toggle="tab">{{ trans('template.setting.socialMediaShare') }}</a>
						</li>
						@endpermission
						@permission('settings-other-setting')
						<li class="{{$other_tab_active}}">
							<a href="#other" data-toggle="tab">{{ trans('template.setting.otherSettings') }}</a>
						</li>
						@endpermission
						@permission('settings-maintenance-setting')
						<li class="{{$maintenance_tab_active}}">
							<a href="#maintenance" data-toggle="tab">{{ trans('template.setting.maintenance') }}</a>
						</li>
						@endpermission
						@permission('settings-module-setting')
						<li class="modulewisesettings {{$module_tab_active}}">
							<a href="#modulesettings"  data-toggle="tab">{{ trans('template.setting.modulesettings') }}</a>
						</li>
						@endpermission
					</ul>
					<div class="tab-content settings">
						@permission('settings-general-setting-management')
						<div class="tab-pane {{$general_tab_active}} {{$general_blank_tab_active}}" id="general">
							<div class="row">
								<div class="col-md-12">
									<div class="portlet-form">
										{!! Form::open(['method' => 'post','id'=>'frmSettings']) !!}
										{!! Form::hidden('tab', 'general_settings', ['id' => 'general']) !!}
										<div class="form-body">
											<div class="form-group {{ $errors->has('site_name') ? ' has-error' : '' }} form-md-line-input">
												{!! Form::text('site_name', Config::get('Constant.SITE_NAME') , array('maxlength' => '150', 'class' => 'form-control maxlength-handler', 'id' => 'site_name' , 'placeholder' => trans('template.setting.siteName'),'autocomplete'=>'off')) !!}
												<label class="form_title" for="site_name">{{ trans('template.setting.siteName') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('site_name') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('front_logo_id') ? ' has-error' : '' }}">
												<div class="image_thumb">
													<label for="front_logo" class="form_title">{{ trans('template.setting.frontLogo') }} <span aria-required="true" class="required"> * </span></label>
													<div class="clearfix"></div>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail front_logo_img" data-trigger="fileinput" style="width:100%; height:120px;position: relative;">
															@if (!empty(Config::get('Constant.FRONT_LOGO_ID')))
															<img src="{{ App\Helpers\resize_image::resize(Config::get('Constant.FRONT_LOGO_ID')) }}"/>
															@else
															<img src="{{ url('resources/images/upload_file.gif') }}"/>
															@endif
														</div>
														<div class="input-group">
															<a class="media_manager" onclick="MediaManager.open('front_logo');"><span class="fileinput-new"></span></a>
														</div>
														{!! Form::hidden('front_logo_id',!empty(Config::get('Constant.FRONT_LOGO_ID'))?Config::get('Constant.FRONT_LOGO_ID'):Input::old('image_upload') , array('class' => 'form-control', 'id' => 'front_logo')) !!}
													</div>
													<div class="clearfix"></div>
													<span>({{ trans('template.setting.imageSize') }})</span>
													<span class="help-block">
														{{ $errors->first('front_logo_id') }}
													</span>
												</div>
											</div>
											@if(!empty($timezone))
											<div class="form-group">
												<label class="form_title" for="timezone">{{ trans('template.setting.timezone') }}</label>
												<select class="form-control bs-select select2" name="timezone" id="timezone">
													@foreach ($timezone as $allzones)
													@if(!empty(Config::get('Constant.DEFAULT_TIME_ZONE')))
													@if($allzones->zone_name == Config::get('Constant.DEFAULT_TIME_ZONE'))
													@php  $selected = 'selected'  @endphp
													@else
													@php  $selected = ''  @endphp
													@endif
													@elseif($allzones->zone_name == 'America/Cayman')
													@php  $selected = 'selected'  @endphp
													@else
													@php  $selected = ''  @endphp
													@endif
													<option {{$selected}} value="{{$allzones->zone_name}}">{{$allzones->zone_name}}</option>
													@endforeach
												</select>
											</div>
											@endif

											{{--  Vk 4/12/2019 Start  --}}
											@php  $avaliable_theme = trans('template.setting.avaliable_theme');  @endphp
											<div class="form-group">
												<label class="form_title" for="theme">{{ trans('template.setting.theme') }}</label>
												<select class="form-control bs-select select2" name="theme" id="theme">
													@for ($i = 0; $i < 4; $i++)
														@if(!empty(Config::get('Constant.DEFAULT_THEME')))
															@if("theme_v".$i == Config::get('Constant.DEFAULT_THEME'))
																@php  $selected = 'selected'  @endphp
															@else
																@php  $selected = ''  @endphp
															@endif

															@if(in_array($i,$avaliable_theme))
																<option {{$selected}} value="theme_v{{$i}}">Theme_V{{$i}}</option>
															@endif
														@endif
													@endfor
												</select>
											</div>
											{{--  Vk 4/12/2019 End  --}}

											{{-- Vk 10/9/2020 start --}}
										<div class="form-group">
											<label for="banner_type" class="form_title">{{ trans('template.setting.display_maintenance') }}</label>
											<div class="md-radio-inline">
												<div class="md-radio">
													@if ((!empty(Config::get('Constant.DISPLAY_MAINTENANCE')) && Config::get('Constant.DISPLAY_MAINTENANCE') == 'Y') || (null == Input::old('DISPLAY_MAINTENANCE') || Input::old('DISPLAY_MAINTENANCE') == 'Y'))
													@php  $checked_yes = 'checked'  @endphp
													@else
													@php  $checked_yes = ''  @endphp
													@endif
													<input type="radio" {{ $checked_yes }} value="Y" id="displayYes" name="display_maintenance" class="md-radiobtn">
													<label for="displayYes">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> {{ trans('template.common.yes') }}
													</label>
												</div>
												<div class="md-radio">
													@if (Config::get('Constant.DISPLAY_MAINTENANCE') == 'N' || (!empty(Config::get('Constant.DISPLAY_MAINTENANCE')) && Config::get('Constant.DISPLAY_MAINTENANCE') == 'N'))
													@php  $checked_yes = 'checked'  @endphp
													@else
													@php  $checked_yes = ''  @endphp
													@endif
													<input type="radio" {{ $checked_yes }} value="N" id="displayNo" name="display_maintenance" class="md-radiobtn">
													<label for="displayNo">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> {{ trans('template.common.no') }}
													</label>
												</div>
											</div>
										</div>
										<div class="form-group {{ $errors->has('maintenance_text_link') ? ' has-error' : '' }} form-md-line-input" id="maintenance_text_link_div">
											{!! Form::text('maintenance_text_link', Config::get('Constant.DISPLAY_MAINTENANCE_LINK') , array('maxlength' => '500','class' => 'form-control', 'id' => 'maintenance_text_link' , 'autocomplete'=>'off')) !!}
											<label class="form_title" for="maintenance_text_link">{{ trans('template.setting.maintenance_text_link') }}</label>
											<span class="help-block">
												{{ $errors->first('maintenance_text_link') }}
											</span>
										</div>
										<div class="form-group {{ $errors->has('maintenance_text') ? ' has-error' : '' }} form-md-line-input" id="maintenance_text_div">
											{!! Form::text('maintenance_text', Config::get('Constant.MAINTENANCE_TEXT') , array('maxlength' => '500','class' => 'form-control', 'id' => 'maintenance_text' , 'autocomplete'=>'off')) !!}
											<label class="form_title" for="maintenance_text">{{ trans('template.setting.maintenance_text') }}</label>
											<span class="help-block">
												{{ $errors->first('maintenance_text') }}
											</span>
										</div>
										{{-- Vk 10/9/2020 end --}}

											<div class="form-group form-md-line-input">
												{!! Form::text('default_newsletter_email', Config::get('Constant.DEFAULT_NEWSLETTER_EMAIL') , array('maxlength' => '150','class' => 'form-control', 'id' => 'default_newsletter_email' , 'autocomplete'=>'off')) !!}
												<label class="form_title" for="default_newsletter_email">{{ trans('template.setting.newsletterEmail') }}</label>
											</div>
											<div class="form-group form-md-line-input">
												{!! Form::text('default_replyto_email', Config::get('Constant.DEFAULT_REPLYTO_EMAIL') , array('maxlength' => '150','class' => 'form-control', 'id' => 'default_replyto_email' , 'autocomplete'=>'off')) !!}
												<label class="form_title" for="default_replyto_email">{{ trans('template.setting.replyToEmail') }}</label>
											</div>
											<div class="form-group form-md-line-input">
												{!! Form::text('default_contactus_email', Config::get('Constant.DEFAULT_CONTACTUS_EMAIL') , array('maxlength' => '150','class' => 'form-control', 'id' => 'default_contactus_email' , 'autocomplete'=>'off')) !!}
												<label class="form_title" for="default_contactus_email">{{ trans('template.setting.contactUsEmail') }}</label>
											</div>
											<div class="form-group">
                                            <label class="form_title @if($errors->first('display_order')) has-error @endif" for="description">{!! trans('template.common.emergency') !!} <span aria-required="true" class="required"> * </span></label>
                                            {!! Form::textarea('emrdescription',Config::get('Constant.EMERGENCY_CONTENT_DESCRIPTION'), array('class' => 'form-control','id'=>'txtDescription')) !!}
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12">
                                                    @if (Config::get('Constant.DISPLAY_EMERGENCY_CONTENT')=="Y")
                                                    @php $dchecked_yes = 'checked' @endphp
                                                    @else
                                                    @php $dchecked_yes = '' @endphp
                                                    @endif
													<div class="form-group">
                                                        <label class="control-label form_title">Display Emergency Content on Home Page ? </label>
                                                        <input class="" type="checkbox" name="displayonhome" id="displayonhome" value="Y" {{ $dchecked_yes }}/>
                                                    </div>
                                                </div>
                                        </div>
											<button type="submit" class="btn btn-green-drake">{!! trans('template.common.saveandedit') !!}</button>
											{!! Form::close() !!}
										</div>
									</div>
								</div>
							</div>
						</div>
						@endpermission
						@permission('settings-smtp-mail-setting')
						<div class="tab-pane {{$smtp_tab_active}}" id="smtp-mail">
							<div class="row">
								<div class="col-md-12">
									<div class="portlet-form">
										{!! Form::open(['method' => 'post','id'=>'smtpForm']) !!}
										<input type="password" style="width: 0;height: 0; visibility: hidden;position:absolute;left:0;top:0;"/>
										{!! Form::hidden('tab', 'smtp_settings', ['id' => 'smtp']) !!}
										<div class="form-body">
											<div class="form-actions form-group" style="padding:0">
												<div class="pull-left">
													<button type="button" id="testSMTP" class="btn btn-green-drake">{{ trans('template.setting.testSMTPSettings') }}</button>
												</div>
											</div>
											<div class="form-group {{ $errors->has('mailer') ? ' has-error' : '' }} form-md-line-input">
												<select class="form-control bs-select select2" name="mailer" id="mailer" style="width: 100%;">
													@php $smtp_selected = '' @endphp
													@php $sent_mail = '' @endphp
													@php $mail_trap = '' @endphp
													@if (Config::get('Constant.MAILER') == 'smtp')
													@php $smtp_selected = 'selected' @endphp
													@elseif (Config::get('Constant.MAILER') == 'sentmail')
													@php $sent_mail = 'selected' @endphp
													@elseif (Config::get('Constant.MAILER') == 'mailtrap')
													@php $mail_trap = 'selected' @endphp
													@else
													@php $smtp_selected = '' @endphp
													@php $sent_mail = '' @endphp
													@php $mail_trap = '' @endphp
													@endif
													<option {{ $smtp_selected }} value="smtp">{{ trans('template.setting.smtp') }}</option>
													<option {{ $sent_mail }} value="sentmail">{{ trans('template.setting.sentMail') }}</option>
													<option {{ $mail_trap }} value="mailtrap">{{ trans('template.setting.mailtrap') }}</option>
												</select>
												<label class="form_title" for="mailer">{{ trans('template.setting.mailer') }} <span aria-required="true" class="required"> * </span></label>
											</div>
											<div class="form-group {{ $errors->has('smtp_server') ? ' has-error' : '' }} form-md-line-input">
												
												{!! Form::text('smtp_server', Config::get('Constant.SMTP_SERVER') , array('maxlength' => '150','class' => 'form-control maxlength-handler', 'id' => 'smtp_server' , 'autocomplete'=>'off')) !!}
												<label class="form_title" for="smtp_server">{{ trans('template.setting.smtpServer') }}<span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('smtp_server') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('smtp_username') ? ' has-error' : '' }} form-md-line-input">
												
												{!! Form::text('smtp_username', Config::get('Constant.SMTP_USERNAME') , array('maxlength' => '150','class' => 'form-control maxlength-handler', 'id' => 'smtp_username' , 'autocomplete'=>'off')) !!}
												<label class="form_title" for="smtp_username">{{ trans('template.setting.smtpUsername') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('smtp_username') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('smtp_password') ? ' has-error' : '' }} form-md-line-input">
												<input type="password" maxlength="150" class="form-control maxlength-handler" name="smtp_password" id="smtp_password" value="{{Config::get('Constant.SMTP_PASSWORD') }}" autocomplete="off">
												<label class="form_title" for="smtp_password">{{ trans('template.setting.smtpPassword') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('smtp_password') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('smtp_encryption') ? ' has-error' : '' }}">
												<label class="form_title" for="smtp_encryption">{{ trans('template.setting.smtpEncryption') }}<span aria-required="true" class="required"> * </span></label>
												<select class="bs-select select2" name="smtp_encryption" id="smtp_encryption">
													@php $smtp_encryption_selected = '' @endphp
													@php $null_mail = '' @endphp
													@php $tls_mail = '' @endphp
													@php $ssl_mail = '' @endphp
													@if (Config::get('Constant.SMTP_ENCRYPTION') == 'null')
													@php $smtp_encryption_selected = 'selected' @endphp
													@elseif (Config::get('Constant.SMTP_ENCRYPTION') == 'tls')
													@php $tls_mail = 'selected' @endphp
													@elseif (Config::get('Constant.SMTP_ENCRYPTION') == 'ssl')
													@php $ssl_mail = 'selected' @endphp
													@else
													@php $smtp_encryption_selected = '' @endphp
													@php $tls_mail = '' @endphp
													@php $ssl_mail = '' @endphp
													@endif
													<option {{ $smtp_encryption_selected }} value="null">{{ trans('template.setting.none') }}</option>
													<option {{ $tls_mail }} value="tls">{{ trans('template.setting.tls') }}</option>
													<option {{ $ssl_mail }} value="ssl">{{ trans('template.setting.ssl') }}</option>
												</select>
											</div>
											<div class="form-group form-md-radios">
												<label class="form_title control-label" for="form_control_1">{{ trans('template.setting.smtpAuthentication') }} <span aria-required="true" class="required"> * </span></label>
												<div class="md-radio-inline">
													<div class="md-radio">
														<input type="radio" id="yes" name="smtp_authenticattion" value="Y" class="md-radiobtn" <?php if(Config::get('Constant.SMTP_AUTHENTICATION')== "Y") { echo 'checked="checked"'; } ?> >
														<label for="yes">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>{{ trans('template.common.yes') }}
														</label>
													</div>
													<div class="md-radio">
														<input type="radio" id="no" name="smtp_authenticattion" value="N" class="md-radiobtn" <?php if(Config::get('Constant.SMTP_AUTHENTICATION')== "N") { echo 'checked="checked"'; } ?> >
														<label for="no">
															<span></span>
															<span class="check"></span>
															<span class="box"></span> {{ trans('template.common.no') }}
														</label>
													</div>
												</div>
											</div>
											<div class="form-group {{ $errors->has('smtp_port') ? ' has-error':'' }} form-md-line-input">
												{!! Form::text('smtp_port',Config::get('Constant.SMTP_PORT'), array('maxlength' => '150', 'class' => 'form-control maxlength-handler', 'id' => 'smtp_port_no')) !!}
												<label class="form_title" for="smtp_port">{{ trans('template.setting.smtpPort') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('smtp_port') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('smtp_sender_name') ? ' has-error' : '' }} form-md-line-input">
												{!! Form::text('smtp_sender_name',Config::get('Constant.SMTP_SENDER_NAME'), array('maxlength' => '150', 'class' => 'form-control maxlength-handler', 'id' => 'smtp_sender_name','autocomplete'=>'off')) !!}
												<label class="form_title" for="smtp_sender_name">{{ trans('template.setting.senderName') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('smtp_sender_name') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('smtp_sender_id') ? ' has-error' : '' }} form-md-line-input">
												{!! Form::text('smtp_sender_id',Config::get('Constant.DEFAULT_EMAIL'), array('maxlength' => '150', 'class' => 'form-control', 'id' => 'smtp_sender_id','autocomplete'=>'off')) !!}
												<label class="form_title" for="smtp_sender_id">{{ trans('template.setting.senderEmail') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('smtp_sender_id') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('mail_content') ? ' has-error' : '' }}">
												<label for="mail_content" class="form_title">{{ trans('template.setting.emailSignature') }} <span aria-required="true" class="required"> * </span></label>
												{!! Form::textarea('mail_content' , Config::get('Constant.DEFAULT_SIGNATURE_CONTENT'), array('class' => 'form-control', 'id' => 'txtDescription')) !!}
												<span class="help-block">
													{{ $errors->first('mail_content') }}
												</span>
											</div>
											<button type="submit" class="btn btn-green-drake">{!! trans('template.common.saveandedit') !!}</button>
											{!! Form::close() !!}
										</div>
									</div>
								</div>
							</div>
						</div>
						@endpermission
						@permission('settings-seo-setting')
						<div class="tab-pane {{$seo_tab_active}}" id="seo">
							<div class="row">
								<div class="col-md-12">
									<div class="portlet-form">
										{!! Form::open(['method' => 'post','id' => 'frmSeo','enctype'=>'multipart/form-data']) !!}
										{!! Form::hidden('tab', 'seo_settings', ['id' => 'seo']) !!}
										<div class="form-body">
											<div class="form-group {{ $errors->has('google_analytic_code') ? ' has-error' : '' }} form-md-line-input">
												
												{!! Form::textarea('google_analytic_code' , Config::get('Constant.GOOGLE_ANALYTIC_CODE'), array('class' => 'form-control', 'id' => 'google_analytic_code','rows' => '13')) !!}
												<label class="form_title" for="google_analytic_code">{{ trans('template.setting.googleAnalytic') }} </label>
												<span class="help-block">
													{{ $errors->first('google_analytic_code') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('google_tag_manager_for_body') ? ' has-error' : '' }} form-md-line-input">
												
												{!! Form::textarea('google_tag_manager_for_body' , Config::get('Constant.GOOGLE_TAG_MANAGER_FOR_BODY'), array('class' => 'form-control', 'id' => 'google_tag_manager_for_body', 'rows' => '4')) !!}
												<label class="form_title" for="google_tag_manager_for_body">{{ trans('template.setting.googleTagManager') }}</label>
												<span class="help-block">
													{{ $errors->first('google_tag_manager_for_body') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }} form-md-line-input">
												
												{!! Form::text('meta_title' , Config::get('Constant.DEFAULT_META_TITLE'), array('maxlength' => '150','class' => 'form-control maxlength-handler', 'id' => 'meta_title', 'autocomplete'=>"off")) !!}
												<label class="form_title" for="meta_title">{{ trans('template.common.metatitle') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('meta_title') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('meta_keyword') ? ' has-error' : '' }} form-md-line-input">
												
												{!! Form::text('meta_keyword' , Config::get('Constant.DEFAULT_META_KEYWORD'), array('maxlength' => '150','class' => 'form-control', 'id' => 'meta_keyword', 'autocomplete'=>"off")) !!}
												<label class="form_title" for="meta_keyword">{{ trans('template.common.metakeyword') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('meta_keyword') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('meta_description') ? ' has-error' : '' }} form-md-line-input">
												{!! Form::textarea('meta_description' , Config::get('Constant.DEFAULT_META_DESCRIPTION'), array('class' => 'form-control', 'id' => 'meta_description', 'rows' => '4')) !!}
												<label class="form_title" for="form_control_1">{{ trans('template.common.metadescription') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('meta_description') }}
												</span>
											</div>
											<div class="form-group {{ $errors->has('robotfile_content') ? ' has-error' : '' }} form-md-line-input">
												{!! Form::textarea('robotfile_content' , $robotFileContent, array('class' => 'form-control', 'id' => 'robotfile_content', 'autocomplete'=>"off")) !!}
												<label class="form_title" for="ROBOT_FILR">Robot TXT File Content</label>
												<span class="help-block">
													{{ $errors->first('robotfile_content') }}
												</span>
											</div>
											<div class="form-group form-md-line-input">
												{!! Form::file('xml_file' , array('class' => 'form-control', 'id' => 'bingfile','accept'=>"text/xml")) !!}
												@php
												$BingfileName = Config::get('Constant.BING_FILE_PATH');
												@endphp
												<label class="form_title" for="BingFile">Upload Bing File</label>
												<div class="clearfix"></div>
												<span>Recommended File type (.xml)</span>
												<div class="clearfix"></div>
												@if($BingfileName != "" || $BingfileName != null)
												<span>File Name:{{ $BingfileName }}</span>
												@endif
												<span class="help-block">
													{{ $errors->first('xml_file') }}
												</span>
											</div>
											<div class="form-group form-md-line-input">
												<label class="form_title" for="generate_sitemap">Sitemap:&nbsp;</label>
												<a target="_blank" href="{{url('generateSitemap')}}" class="btn default"><i class="fa fa-sitemap" aria-hidden="true"></i> Click to generate sitemap</a>
											</div>
											<button type="submit" class="btn btn-green-drake">{!! trans('template.common.saveandedit') !!}</button>
											{!! Form::close() !!}
										</div>
									</div>
								</div>
							</div>
						</div>
						@endpermission
						@permission('settings-social-setting')
						<div class="tab-pane setting {{$social_tab_active}}" id="social">
							<div class="row">
								<div class="col-md-12">
									<div class="portlet-form">
										{!! Form::open(['method' => 'post','id' => 'frmSocial']) !!}
										{!! Form::hidden('tab', 'social_settings', ['id' => 'social']) !!}
										<div class="form-body">
											<div class="form-group {{ $errors->has('fb_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-facebook"></i>
													</span>
													
													{!! Form::text('fb_link' , Config::get('Constant.SOCIAL_FB_LINK'), array('class' => 'form-control', 'id' => 'fb_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="fb_link">{{ trans('template.setting.facebookLink') }}</label>
													<span class="help-block">
														{{ $errors->first('fb_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('twitter_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-twitter"></i>
													</span>
													
													{!! Form::text('twitter_link' , Config::get('Constant.SOCIAL_TWITTER_LINK'), array('class' => 'form-control', 'id' => 'twitter_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="twitter_link">{{ trans('template.setting.twitterLink') }}</label>
													<span class="help-block">
														{{ $errors->first('twitter_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('youtube_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-youtube-play"></i>
													</span>
													
													{!! Form::text('youtube_link' , Config::get('Constant.SOCIAL_YOUTUBE_LINK'), array('class' => 'form-control', 'id' => 'youtube_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="youtube_link">{{ trans('template.setting.youtubeLink') }}</label>
													<span class="help-block">
														{{ $errors->first('youtube_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('google_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-google-plus"></i>
													</span>
													
													{!! Form::text('google_link' , Config::get('Constant.Google_Plus_Link'), array('class' => 'form-control', 'id' => 'google_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="google_link">{{ trans('template.setting.googlePlusLink') }}</label>
													<span class="help-block">
														{{ $errors->first('google_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('linkedin_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-linkedin"></i>
													</span>
													{!! Form::text('linkedin_link' , Config::get('Constant.SOCIAL_LINKEDIN_LINK'), array('class' => 'form-control', 'id' => 'linkedin_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="linkedin_link">{{ trans('template.setting.linkedinLink') }}</label>
													<span class="help-block">
														{{ $errors->first('linkedin_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('instagram_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-instagram"></i>
													</span>
													{!! Form::text('instagram_link' , Config::get('Constant.SOCIAL_INSTAGRAM_LINK'), array('class' => 'form-control', 'id' => 'instagram_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="instagram_link">{{ trans('template.setting.instagramLink') }}</label>
													<span class="help-block">
														{{ $errors->first('instagram_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('tumblr_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-tumblr"></i>
													</span>
													{!! Form::text('tumblr_link' , Config::get('Constant.SOCIAL_TUMBLR_LINK'), array('class' => 'form-control', 'id' => 'tumblr_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="tumblr_link">{{ trans('template.setting.tumblrLink') }}</label>
													<span class="help-block">
														{{ $errors->first('tumblr_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('pinterest_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-pinterest-p"></i>
													</span>
													{!! Form::text('pinterest_link' , Config::get('Constant.SOCIAL_PINTEREST_LINK'), array('class' => 'form-control', 'id' => 'pinterest_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="pinterest_link">{{ trans('template.setting.pinterestLink') }}</label>
													<span class="help-block">
														{{ $errors->first('pinterest_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('flickr_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-flickr"></i>
													</span>
													{!! Form::text('flickr_link' , Config::get('Constant.SOCIAL_FLICKR_LINK'), array('class' => 'form-control', 'id' => 'flickr_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="flickr_link">{{ trans('template.setting.flickrLink') }}</label>
													<span class="help-block">
														{{ $errors->first('flickr_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('dribbble_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-dribbble"></i>
													</span>
													{!! Form::text('dribbble_link' , Config::get('Constant.SOCIAL_DRIBBBLE_LINK'), array('class' => 'form-control', 'id' => 'dribbble_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="dribbble_link">{{ trans('template.setting.dribbbleLink') }}</label>
													<span class="help-block">
														{{ $errors->first('dribbble_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('rss_feed_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-rss"></i>
													</span>
													{!! Form::text('rss_feed_link' , Config::get('Constant.SOCIAL_RSS_FEED_LINK'), array('class' => 'form-control', 'id' => 'rss_feed_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="rss_feed_link">{{ trans('template.setting.rssfeeLink') }}</label>
													<span class="help-block">
														{{ $errors->first('rss_feed_link') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('whatsapp_link') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-whatsapp"></i>
													</span>
													{!! Form::text('whatsapp_link' , Config::get('Constant.SOCIAL_WHATSAPP_LINK'), array('class' => 'form-control', 'id' => 'whatsapp_link', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="whatsapp_link">{{ trans('template.setting.whatsapplink') }}</label>
													<span class="help-block">
														{{ $errors->first('whatsapp_link') }}
													</span>
												</div>
											</div>
											<button type="submit" class="btn btn-green-drake submit">{!! trans('template.common.saveandedit') !!}</button>
											{!! Form::close() !!}
										</div>
									</div>
								</div>
							</div>
						</div>
						@endpermission
						@permission('settings-social-media-share-setting')
						<div class="tab-pane setting {{$social_share_tab_active}}" id="socialshare">
							<div class="row">
								<div class="col-md-12">
									<div class="portlet-form">
										{!! Form::open(['method' => 'post','id' => 'frmSocialShare']) !!}
										{!! Form::hidden('tab', 'social_share_settings', ['id' => 'socialshare']) !!}
										<div class="form-body">
											<label><i class="fa fa-check"></i> {{ trans('template.setting.facebookShare') }}</label>
											<div class="form-group {{ $errors->has('fb_id') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-facebook"></i>
													</span>
													
													{!! Form::text('fb_id' , Config::get('Constant.SOCIAL_SHARE_FB_ID'), array('class' => 'form-control', 'id' => 'fb_id', 'autocomplete'=>"off", 'onkeypress' => "return isNumberKey(event)")) !!}
													<label class="form_title" for="fb_id">{{ trans('template.setting.facebookPageID') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('fb_id') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('fb_api') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-facebook"></i>
													</span>
													
													{!! Form::text('fb_api' , Config::get('Constant.SOCIAL_SHARE_FB_API_KEY'), array('class' => 'form-control', 'id' => 'fb_api', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="fb_api">{{ trans('template.setting.facebookApiKey') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('fb_api') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('fb_secret_key') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-facebook"></i>
													</span>
													{!! Form::text('fb_secret_key' , Config::get('Constant.SOCIAL_SHARE_FB_SECRET_KEY'), array('class' => 'form-control', 'id' => 'fb_secret_key', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="fb_secret_key">{{ trans('template.setting.facebookSecretKey') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('fb_secret_key') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('fb_access_token') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-facebook"></i>
													</span>
													
													{!! Form::text('fb_access_token' , Config::get('Constant.SOCIAL_SHARE_FB_ACCESS_TOKEN'), array('class' => 'form-control', 'id' => 'fb_access_token', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="fb_access_token">{{ trans('template.setting.facebookAccessToken') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('fb_access_token') }}
													</span>
												</div>
											</div>
											<div class="clearfix"></div>
											<label><i class="fa fa-check"></i> {{ trans('template.setting.twitterShare') }}</label>
											<div class="form-group {{ $errors->has('twitter_api') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-twitter"></i>
													</span>
													
													{!! Form::text('twitter_api' , Config::get('Constant.SOCIAL_SHARE_TWITTER_API_KEY'), array('class' => 'form-control', 'id' => 'twitter_api', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="twitter_api">{{ trans('template.setting.twitterApiKey') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('twitter_api') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('twitter_secret_key') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-twitter"></i>
													</span>
													
													{!! Form::text('twitter_secret_key' , Config::get('Constant.SOCIAL_SHARE_TWITTER_SECRET_KEY'), array('class' => 'form-control', 'id' => 'twitter_secret_key', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="twitter_secret_key">{{ trans('template.setting.twitterSecretKey') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('twitter_secret_key') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('twitter_access_token') ? ' has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-twitter"></i>
													</span>
													
													{!! Form::text('twitter_access_token' , Config::get('Constant.SOCIAL_SHARE_TWITTER_ACCESS_TOKEN'), array('class' => 'form-control', 'id' => 'twitter_access_token', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="twitter_access_token">{{ trans('template.setting.twitterAccessToken') }} <span aria-required="true" class="required"> * </span></label>
													<span class="help-block">
														{{ $errors->first('twitter_access_token') }}
													</span>
												</div>
											</div>
											<div class="form-group {{ $errors->has('twitter_access_token_key') ? 'has-error' : '' }} form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-twitter"></i>
													</span>
													{!! Form::text('twitter_access_token_key' , Config::get('Constant.SOCIAL_SHARE_TWITTER_ACCESS_SECRET_KEY'), array('class' => 'form-control', 'id' => 'twitter_access_token_key', 'autocomplete'=>"off")) !!}
													<label class="form_title" for="twitter_access_token_key">{{ trans('template.setting.twitterAccessTokenSceretKey') }} <span aria-required="true" class="required"> * </span>
												</label>
												<span class="help-block">
													{{ $errors->first('twitter_access_token_key') }}
												</span>
											</div>
										</div>
										<div class="clearfix"></div>
										<label><i class="fa fa-check"></i> {{ trans('template.setting.linkedinShare') }}</label>
										<div class="form-group {{ $errors->has('linkedin_api') ? ' has-error' : '' }} form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-linkedin"></i>
												</span>
												{!! Form::text('linkedin_api' , Config::get('Constant.SOCIAL_SHARE_LINKEDIN_API_KEY'), array('class' => 'form-control', 'id' => 'linkedin_api', 'autocomplete'=>"off")) !!}
												<label class="form_title" for="linkedin_api">{{ trans('template.setting.linkedinApiKey') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('linkedin_api') }}
												</span>
											</div>
										</div>
										<div class="form-group {{ $errors->has('linkedin_secret_key') ? ' has-error' : '' }} form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-linkedin"></i>
												</span>
												
												{!! Form::text('linkedin_secret_key' , Config::get('Constant.SOCIAL_SHARE_LINKEDIN_SECRET_KEY'), array('class' => 'form-control', 'id' => 'linkedin_secret_key', 'autocomplete'=>"off")) !!}
												<label class="form_title" for="linkedin_secret_key">{{ trans('template.setting.linkedinSecretKey') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('linkedin_secret_key') }}
												</span>
											</div>
										</div>
										<div class="form-group {{ $errors->has('linkedin_access_token') ? ' has-error' : '' }} form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-linkedin"></i>
												</span>
												{!! Form::text('linkedin_access_token' , Config::get('Constant.SOCIAL_SHARE_LINKEDIN_ACCESS_TOKEN'), array('class' => 'form-control', 'id' => 'linkedin_access_token', 'autocomplete'=>"off")) !!}
												<label class="form_title" for="linkedin_access_token">{{ trans('template.setting.linkedinAccessToken') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('linkedin_access_token') }}
												</span>
											</div>
										</div>
										<div class="form-group {{ $errors->has('linkedin_access_token_key') ? ' has-error' : '' }} form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-linkedin"></i>
												</span>
												{!! Form::text('linkedin_access_token_key' , Config::get('Constant.SOCIAL_SHARE_LINKEDIN_ACCESS_SECRET_KEY'), array('class' => 'form-control', 'id' => 'linkedin_access_token_key', 'autocomplete'=>"off")) !!}
												<label class="form_title" for="linkedin_access_token_key">{{ trans('template.setting.linkedinAccessTokenSceretKey') }} <span aria-required="true" class="required"> * </span></label>
												<span class="help-block">
													{{ $errors->first('linkedin_access_token_key') }}
												</span>
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-green-drake submit">{!! trans('template.common.saveandedit') !!}</button>
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
					@endpermission
					@permission('settings-other-setting')
					<div class="tab-pane setting {{$other_tab_active}}" id="other">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet-form">
									{!! Form::open(['method' => 'post','id' => 'otherSettings']) !!}
									{!! Form::hidden('tab', 'other_settings', ['id' => 'other']) !!}
									<div class="form-body">
										{{-- @php 
										<div class="form-group">
											<label class="form_title" for="default_page_size">{{ trans('template.setting.defaultPagesize') }}</label>
											<select class="form-control select2" name="default_page_size" id="default_page_size" style="width:100%">
												@php $ten_selected = '' @endphp
												@php $twenty_selected = '' @endphp
												@php $fifty_selected = '' @endphp
												@php $hundred_selected = '' @endphp
												@php $all_selected = '' @endphp
												@if (Config::get('Constant.DEFAULT_PAGE_SIZE')  == '10')
												@php $ten_selected = 'selected' @endphp
												@elseif (Config::get('Constant.DEFAULT_PAGE_SIZE') == '20')
												@php $twenty_selected = 'selected' @endphp
												@elseif (Config::get('Constant.DEFAULT_PAGE_SIZE') == '50')
												@php $fifty_selected = 'selected' @endphp
												@elseif (Config::get('Constant.DEFAULT_PAGE_SIZE') == '100')
												@php $hundred_selected = 'selected' @endphp
												@elseif (Config::get('Constant.DEFAULT_PAGE_SIZE') == 'All')
												@php $all_selected = 'selected' @endphp
												@else
												@php $ten_selected = '' @endphp
												@php $twenty_selected = '' @endphp
												@php $fifty_selected = '' @endphp
												@php $hundred_selected = '' @endphp
												@php $all_selected = '' @endphp
												@endif
												<option {{ $ten_selected }} value="10">10</option>
												<option {{ $twenty_selected }} value="20">20</option>
												<option {{ $fifty_selected }} value="50">50</option>
												<option {{ $hundred_selected }} value="100">100</option>
												<option {{ $all_selected }} value="All">{{ trans('template.common.all') }}</option>
											</select>
										</div> --}}
										<div class="clearfix"></div>
										<div class="form-group form-md-line-input">
											<select class="form-control bs-select select2" name="default_date_format" id="default_date_format" style="width:100%">
												<option value="d/m/Y" <?php if (Config::get('Constant.DEFAULT_DATE_FORMAT') == "d/m/Y") {echo 'selected="selected"';}?> >d/m/Y (Eg: {{ Carbon\Carbon::today()->format('d/m/Y') }})  </option>
												<option value="m/d/Y" <?php if (Config::get('Constant.DEFAULT_DATE_FORMAT') == "m/d/Y") {echo 'selected="selected"';}?> >m/d/Y (Eg: {{ Carbon\Carbon::today()->format('m/d/Y') }})  </option>
												<option value="Y/m/d" <?php if (Config::get('Constant.DEFAULT_DATE_FORMAT') == "Y/m/d") {echo 'selected="selected"';}?> >Y/m/d (Eg: {{ Carbon\Carbon::today()->format('Y/m/d') }})  </option>
												<option value="Y/d/m" <?php if (Config::get('Constant.DEFAULT_DATE_FORMAT') == "Y/d/m") {echo 'selected="selected"';}?> >Y/d/m (Eg: {{ Carbon\Carbon::today()->format('Y/d/m') }})  </option>
												<option value="M/d/Y" <?php if (Config::get('Constant.DEFAULT_DATE_FORMAT') == "M/d/Y") {echo 'selected="selected"';}?> >M/d/Y (Eg: {{ Carbon\Carbon::today()->format('M/d/Y') }})  </option>
											</select>
											<label class="form_title" for="default_date_format">{{ trans('template.common.defaultDateFormat') }} (d/m/Y)</label>
										</div>
										<div class="form-group form-md-line-input">
											<select class="form-control bs-select select2" name="time_format" id="time_format" style="width:100%">
												<option value="h:i A" <?php if (Config::get('Constant.DEFAULT_TIME_FORMAT') == "h:i A") {echo 'selected="selected"';}?> >12 {{ trans('template.common.hours') }}</option>
												<option value="H:i" <?php if (Config::get('Constant.DEFAULT_TIME_FORMAT') == "H:i") {echo 'selected="selected"';}?> >24 {{ trans('template.common.hours') }}</option>
											</select>
											<label class="form_title" for="time_format">{{ trans('template.common.defaultTimeFormat') }}</label>
										</div>
										<div class="form-group {{ $errors->has('google_map_key') ? ' has-error' : '' }} form-md-line-input">
											{!! Form::text('google_map_key' , Config::get('Constant.GOOGLE_MAP_KEY'), array('class' => 'form-control', 'id' => 'google_map_key', 'autocomplete'=>"off")) !!}
											<label class="form_title" for="google_map_key">{{ trans('template.setting.googleMapKey') }} <span aria-required="true" class="required"> * </span></label>
											<span class="help-block">
												{{ $errors->first('google_map_key') }}
											</span>
										</div>
										<div class="form-group {{ $errors->has('google_capcha_key') ? ' has-error' : '' }} form-md-line-input">
											{!! Form::text('google_capcha_key' ,!empty(Config::get('Constant.GOOGLE_CAPCHA_KEY'))?Config::get('Constant.GOOGLE_CAPCHA_KEY'):'', array('class' => 'form-control', 'id' => 'google_capcha_key', 'autocomplete'=>"off")) !!}
											<label class="form_title" for="google_map_key">{{ trans('template.setting.googleCapchaKey') }}  <span aria-required="true" class="required"> * </span></label>
											<span class="help-block">
												{{ $errors->first('google_capcha_key') }}
											</span>
										</div>
										<div class="form-group">
											<label for="banner_type" class="form_title">{{ trans('template.setting.filterBadWords') }}:</label>
											<div class="md-radio-inline">
												<div class="md-radio">
													@if ((!empty(Config::get('Constant.BAD_WORDS')) && Config::get('Constant.BAD_WORDS') == 'Y') || (null == Input::old('bad_words') || Input::old('bad_words') == 'Y'))
													@php  $checked_yes = 'checked'  @endphp
													@else
													@php  $checked_yes = ''  @endphp
													@endif
													<input type="radio" {{ $checked_yes }} value="Y" id="badWordsYes" name="bad_words" class="md-radiobtn">
													<label for="badWordsYes">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> {{ trans('template.common.yes') }}
													</label>
												</div>
												<div class="md-radio">
													@if (Config::get('Constant.BAD_WORDS') == 'N' || (!empty(Config::get('Constant.BAD_WORDS')) && Config::get('Constant.BAD_WORDS') == 'N'))
													@php  $checked_yes = 'checked'  @endphp
													@else
													@php  $checked_yes = ''  @endphp
													@endif
													<input type="radio" {{ $checked_yes }} value="N" id="badWordsNo" name="bad_words" class="md-radiobtn">
													<label for="badWordsNo">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> {{ trans('template.common.no') }}
													</label>
												</div>
											</div>
										</div>
										<div class="form-group {{ $errors->has('php_ini_content') ? ' has-error' : '' }} form-md-line-input">
											{!! Form::textarea('php_ini_content' , $phpIniContent, array('class' => 'form-control', 'id' => 'php_ini_content', 'autocomplete'=>"off")) !!}
											<label class="form_title" for="PHP_INI_CONTENT">{{ trans('template.setting.phpIniSettings') }}</label>
											<span class="help-block">
												{{ $errors->first('php_ini_content') }}
											</span>
										</div>
										<div class="row" style="margin-bottom: 10px;">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<label class="form_title" for="AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMEBER">Available Social Links For Team Member</label>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12 text-right">
												<a href="javascript:void(0);" class="addMoreSocial add_more" title="Add More"><i class="fa fa-plus"></i> Add Social Link</a>
											</div>
											<div class="clearfix"></div>
											<div class="multi_social_links">
												@php
												$socialcnt=0;
												$selectedSocialLinks=unserialize(Config::get('Constant.AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMBER'));
												@endphp
												@if(is_array($selectedSocialLinks) && count($selectedSocialLinks)>0 &&!empty($selectedSocialLinks))
												@foreach($selectedSocialLinks as $socialLinks)
												
												<div class="single_social_link">
													<div class="col-md-4">
														<div class="form-group {{ $errors->has('AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMEBER') ? ' has-error' : '' }} form-md-line-input">
															{!! Form::text('available_social_links_for_team['.($socialcnt).'][title]' , $socialLinks['title'], array('class' => 'form-control', 'id' => 'available_social_links_for_team'.($socialcnt).'_1', 'autocomplete'=>"off")) !!}
															<label class="form_title" for="AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMEBER">Title</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group {{ $errors->has('AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMEBER') ? ' has-error' : '' }} form-md-line-input">
															{!! Form::text('available_social_links_for_team['.($socialcnt).'][placeholder]' , $socialLinks['placeholder'], array('class' => 'form-control', 'id' => 'available_social_links_for_team'.($socialcnt).'_2', 'autocomplete'=>"off")) !!}
															<label class="form_title" for="AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMEBER">Place Holder</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group {{ $errors->has('AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMEBER') ? ' has-error' : '' }} form-md-line-input">
															{!! Form::text('available_social_links_for_team['.($socialcnt).'][class]', $socialLinks['class'], array('class' => 'form-control', 'id' => 'available_social_links_for_team'.($socialcnt).'_3', 'autocomplete'=>"off")) !!}
															<label class="form_title" for="AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMEBER">Class</label>
															<a href="javascript:void(0);" class="removeSocial add_more" title="Remove"><i class="fa fa-times"></i> Remove</a>
														</div>
													</div>
												</div>
												@php $socialcnt++; @endphp
												@endforeach
												@endif
											</div>
										</div>
										<button type="submit" class="btn btn-green-drake submit">{!! trans('template.common.saveandedit') !!}</button>
										{!! Form::close() !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					@endpermission
					@permission('settings-maintenance-setting')
					<div class="tab-pane setting {{$maintenance_tab_active}}" id="maintenance">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet-form">
									{!! Form::open(['method' => 'post','id' => 'frmMaintenance']) !!}
									{!! Form::hidden('tab', 'maintenance', ['id' => 'maintenance']) !!}
									<div class="form-body">
										<?php
										/*<div class="form-group">
											<label><i class="fa fa-refresh"></i> {{ trans('template.setting.resetCounter') }}</label>
											<a href="{{url('powerpanel/settings/getDBbackUp')}}"><i class="fa fa-hdd-o" aria-hidden="true"></i> Database Backup</a>
										</div>*/
										?>
										<div class="form-group">
											<div class="checkbox-list">
												<label class="checkbox-inline">
													{!!	Form::checkbox('reset[]', 'moblihits') !!}
													{{ trans('template.setting.resetMobileHits') }}
												</label>
												<label class="checkbox-inline">
													{!!	Form::checkbox('reset[]', 'emaillog') !!}
													{{ trans('template.setting.resetEmailLogs') }}
												</label>
												<label class="checkbox-inline">
													{!!	Form::checkbox('reset[]', 'webhits') !!}
													{{ trans('template.setting.resetWebHits') }}
												</label>
												<label class="checkbox-inline">
													{!!	Form::checkbox('reset[]', 'contactleads') !!}
													{{ trans('template.setting.resetContactLeads') }}
												</label>
												<label class="checkbox-inline">
													{!!	Form::checkbox('reset[]', 'newsletterleads') !!}
													{{ trans('template.setting.resetNewsletterLeads') }}
												</label>
												<label class="checkbox-inline">
													{!!	Form::checkbox('reset[]', 'flushAllCache') !!}
													Flush All Cache
												</label>
											</div>
											<span class="help-block">
												{{ $errors->first('reset') }}
											</span>
										</div>
										<button type="submit" class="btn btn-green-drake submit">{{ trans('template.common.reset') }}</button>
										{!! Form::close() !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					@endpermission
					@permission('settings-module-setting')
					<div class="tab-pane setting {{$module_tab_active}}" id="modulesettings">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet-form">
									<div class="col-md-6">
										{!! Form::text('search' , null, array('id' => 'moduleSearch', 'class' => 'form-control', 'placeholder'=>'Module Search', 'autocomplete'=>"off")) !!}
									</div>
									<div class="col-md-2">
										<a href="javascript:;" class="btn btn-green-drake search-module-settings submit"><i class="fa fa-search"></i></a>
										<a href="javascript:;" class="btn btn-green-drake modulewisesettings submit"><i class="fa fa-refresh"></i></a>
									</div><br/><br/><br/>
									<div class="clearfix"></div>
									<div id='moduleDiv'></div>
								</div>
							</div>
						</div>
					</div>
					@endpermission
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">window.site_url =  '{!! url("/") !!}';</script>
<script src="{{ url('resources/pages/scripts/setting.js') }}" type="text/javascript"></script>
@include('powerpanel.partials.ckeditor')
<script src="{{ url('resources/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
function isNumberKey(evt) {
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}
$(document).ready(function() {
$('#timezone').select2({
placeholder: "Select timezone",
width: '100%'
}).on("change", function(e) {
$("#timezone").closest('.has-error').removeClass('has-error');
$("#timezone-error").remove();
});
$('#mailer').select2({
placeholder: "Select mailer",
width: '100%'
}).on("change", function(e) {
$("#mailer").closest('.has-error').removeClass('has-error');
$("#mailer-error").remove();
});
$('#default_page_size').select2({
placeholder: "Select default page size",
width: '100%'
}).on("change", function(e) {
$("#default_page_size").closest('.has-error').removeClass('has-error');
$("#default_page_size-error").remove();
});
$('#default_date_format').select2({
placeholder: "Select default date format",
width: '100%'
}).on("change", function(e) {
$("#default_date_format").closest('.has-error').removeClass('has-error');
$("#default_date_format-error").remove();
});
$('#time_format').select2({
placeholder: "Select default time format",
width: '100%'
}).on("change", function(e) {
$("#time_format").closest('.has-error').removeClass('has-error');
$("#time_format-error").remove();
});
});
</script>
@endsection