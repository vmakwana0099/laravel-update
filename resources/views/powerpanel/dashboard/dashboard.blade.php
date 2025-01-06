@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<link href="{{ url('resources/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('resources/global/plugins/highslide/highslide.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<?php

use App\Helpers\MyLibrary;
?>

<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="dashboard-stat creative_widgets new_dashboard bg-gradient-x-primary">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc" title="The counter includes web visitor viewed page in the screen having greater than H 414 * W 736">
                    <i class="widget-thumb-icon icon-screen-desktop"></i> Web Hits
                    <a class="right_btn" title="Click here to view more" href="{{url('powerpanel/pages')}}">
                        <i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="contant_detail">
                <div class="list_hits">
                    <ul>
                        <li><div class="top_count"><span>{!! (!empty($hits['web'])?$hits['web']:0) !!}</span>Total</div></li>
                        <li><div class="top_count"><span>{!! (!empty($currentMonth['web'])?$currentMonth['web']:0) !!}</span>{{date('M Y')}}</div></li>
                        <li><div class="top_count"><span>{!! (!empty($currentYear['web'])?$currentYear['web']:0) !!}</span>Year {{date('Y')}}</div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="creative_widgets dashboard-stat new_dashboard bg-gradient-x-danger">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc" title="The counter includes web visitor viewed page in the screen having greater than H 414 * W 736">
                    <i class="widget-thumb-icon icon-screen-smartphone"></i>Mobile Hits
                    <a class="right_btn" title="Click here to view more" href="{{url('powerpanel/pages')}}">
                        <i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="contant_detail">
                <div class="list_hits">
                    <ul>
                        <li><div class="top_count"><span>{!! (!empty($hits['mobile'])?$hits['mobile']:0) !!}</span>Total</div></li>
                        <li><div class="top_count"><span>{!! (!empty($currentMonth['mobile'])?$currentMonth['mobile']:0) !!}</span>{{date('M Y')}}</div></li>
                        <li><div class="top_count"><span>{!! (!empty($currentYear['mobile'])?$currentYear['mobile']:0) !!}</span>Year {{date('Y')}}</div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="creative_widgets dashboard-stat new_dashboard bg-gradient-x-warning">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc" title="The counter includes web visitor viewed page in the screen having greater than H 414 * W 736">
                    <i class="widget-thumb-icon icon-users"></i> Contact Leads
                    <a class="right_btn" title="Click here to view more" href="{{url('powerpanel/contact-us')}}">
                        <i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="contant_detail">
                <div class="list_hits">
                    <ul>
                        <li><div class="top_count"><span>{!! $contactLeadCount !!}</span>Total</div></li>
                        <li><div class="top_count"><span>{{$currentMonthContactCount}}</span>{{date('M Y')}}</div></li>
                        <li><div class="top_count"><span>{{$currentYearContactCount}}</span>Year {{date('Y')}}</div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="creative_widgets dashboard-stat new_dashboard bg-gradient-x-success">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="desc" title="The counter includes web visitor viewed page in the screen having greater than H 414 * W 736">
                    <i class="widget-thumb-icon icon-envelope "></i> AWS Support Leads
                    <a class="right_btn" title="Click here to view more" href="{{url('powerpanel/newsletter-lead')}}">
                        <i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="contant_detail">
                <div class="list_hits">
                    <ul>
                        <li><div class="top_count"><span>{!! $AwsSupportleadsCount !!}</span>Total</div></li>
                        <li><div class="top_count"><span>{{$currentMonthAwsSupportleadsCount}}</span>{{date('M Y')}}</div></li>
                        <li><div class="top_count"><span>{{$currentYearAwsSupportleadsCount}}</span>Year {{date('Y')}}</div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- END DASHBOARD STATS 1-->
<div class="row">
    @permission('aws-support-leads-list')
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light">
            <div class="portlet-title dash-title">
                <div class="caption">
                    <i class="icon-share font-green_drark hide"></i>
                    <span class="caption-subject font-green_drark bold uppercase"
                          title="AWS Support Leads">AWS Support Leads</span>
                </div>
            </div>
            <div class="portlet-body dash-table">
                <div class="table-scrollable">
                    <table class="new_table_desing table table-condensed table-hover">
                        <thead>
                            <tr>
                                    <!-- <th width="30%" align="left" title="Name"> Name </th> -->
                                <th width="15%" align="left" title="{{ trans('template.powerPanelDashboard.firstname') }}"> Name</th>
                                <th width="15%" align="left" title="{{ trans('template.powerPanelDashboard.email') }}">{{ trans('template.powerPanelDashboard.email') }}</th>
                                <th width="15%" align="left" title="{{ trans('template.powerPanelDashboard.phone') }}">{{ trans('template.powerPanelDashboard.phone') }}</th>
                                <th width="13%" align="left" title="{{ trans('template.powerPanelDashboard.date') }}">{{ trans('template.powerPanelDashboard.date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($AwsSupportleads->isEmpty() && count($AwsSupportleads) < 1)
                            <tr>
                                <td align="center" colspan="5">{{ trans('template.powerPanelDashboard.noNewsLetter') }} <a target="_blank" href="https://www.netclues.com/social-media-marketing"> {{ trans('template.powerPanelDashboard.here') }} </a>
                                    {{ trans('template.powerPanelDashboard.newsLetterLead') }}
                                </td>
                            </tr>
                            @else
                            @foreach ($AwsSupportleads as $key => $AwsSupportleads)
                            @if($key<=4)
                            <tr>
                                <td align="left">{{ $AwsSupportleads->varFirstName }} {{ $AwsSupportleads->varLastName }}</td>
                                <td align="left">{{  MyLibrary::encrypt_decrypt('decrypt', $AwsSupportleads->varEmail) }} </td>
                                <td align="left">{{ MyLibrary::encrypt_decrypt('decrypt', $AwsSupportleads->varPhoneNo) }}</td>
                                <td align="left">{{ date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').' '.Config::get('Constant.DEFAULT_TIME_FORMAT').'',strtotime($AwsSupportleads->created_at)) }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if(isset($AwsSupportleads) && !empty($AwsSupportleads) && count((array)$AwsSupportleads) > 0)
            <div class="pull-right">
                <a class="btn btn-green-drake" href="{{ url('powerpanel/aws-support-leads') }}" title="{{ trans('template.powerPanelDashboard.seeAllRecords') }}">{{ trans('template.powerPanelDashboard.seeAllRecords') }}</a>
            </div>
            @endif
        </div>
        <!-- END PORTLET-->
    </div>
    @endpermission
    @permission('contact-us-list')
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light">
            <div class="portlet-title dash-title">
                <div class="caption">
                    <i class="icon-share font-green_drark hide"></i>
                    <span class="caption-subject font-green_drark bold uppercase" title="Contact Us Leads">
                        {{ trans('template.sidebar.contactuslead') }}</span>
                </div>
            </div>
            <div class="portlet-body dash-table">
                <div class="table-scrollable">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th width="30%" align="left" title="{{ trans('template.common.name') }}"> {{ trans('template.common.name') }} </th>
                                <th width="30%" align="left" title="{{ trans('template.common.emailid') }}"> {{ trans('template.common.emailid') }} </th>
                                <th width="10%" align="center" title="{{ trans('template.common.details') }}"> {{ trans('template.common.details') }} </th>
                                <th width="40%" align="right" title="{{ trans('template.powerPanelDashboard.receivedDateTime') }}"> {{ trans('template.powerPanelDashboard.receivedDateTime') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($leads->isEmpty())
                            <tr>
                                <td align="center" colspan="4">{{ trans('template.powerPanelDashboard.noContactLead') }} <a target="_blank" href="https://www.netclues.com/social-media-marketing"> {{ trans('template.powerPanelDashboard.here') }}</a> {{ trans('template.powerPanelDashboard.findContactLead') }} </td>
                            </tr>
                            @else
                            @foreach ($leads as $key=>$lead)
                            @if($key<=4)
                            <tr>
                                <td>{!! $lead->varName !!}</td>
                                <td align="left">{!! MyLibrary::encrypt_decrypt('decrypt',$lead->varEmail)!!}</td>
                                <td align="left" class='numeric text-center'>
                                    <a data-toggle='modal' class="contactUsLead" id="{!! $lead->id !!}" href='#DetailsLeads{!! $lead->id !!}' title="{{ trans('template.powerPanelDashboard.clickDetails') }}">
                                        <span class='icon-magnifier-add' aria-hidden='true'></span>
                                    </a>
                                </td>
                                <td align="right">{{ date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').'  '.Config::get('Constant.DEFAULT_TIME_FORMAT').'', strtotime($lead->created_at)) }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if(isset($leads) && !empty($leads) && count($leads) > 0 )
            <div class="pull-right">
                <a class="btn btn-green-drake" href="{{ url('powerpanel/contact-us') }}" title="{{ trans('template.powerPanelDashboard.seeAllRecords') }}">{{ trans('template.powerPanelDashboard.seeAllRecords') }}</a>
            </div>
            @endif
        </div>
        <!-- END PORTLET-->
    </div>

    @endpermission

    @permission('inquiry-leads-list')
    <div class="col-md-12 col-sm-12">
        <div class="portlet light">
            <div class="portlet-title dash-title">
                <div class="caption">
                    <i class="icon-share font-green_drark hide"></i>
                    <span class="caption-subject font-green_drark bold uppercase" title="Inquiry Leads">
                        Domain Transfer Inquiry Leads</span>
                </div>
            </div>
            <div class="portlet-body dash-table">
                <div class="table-scrollable">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th width="30%" align="left" title="{{ trans('template.common.name') }}"> {{ trans('template.common.name') }} </th>
                                <th width="30%" align="left" title="{{ trans('template.common.name') }}"> {{ trans('template.inquiryleadModule.domain') }} </th>
                                <th width="30%" align="left" title="{{ trans('template.common.emailid') }}"> {{ trans('template.common.emailid') }} </th>
                                <th width="30%" align="left" title="{{ trans('template.common.emailid') }}"> {{ trans('template.common.phoneno') }} </th>
                                <th width="10%" align="center" title="{{ trans('template.inquiryleadModule.message') }}"> {{ trans('template.inquiryleadModule.message') }} </th>
                                <th width="40%" align="right" title="{{ trans('template.powerPanelDashboard.receivedDateTime') }}"> {{ trans('template.powerPanelDashboard.receivedDateTime') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($inquiryleads->isEmpty())
                            <tr>
                                <td align="center" colspan="4">{{ trans('template.powerPanelDashboard.noContactLead') }} <a target="_blank" href="https://www.netclues.com/social-media-marketing"> {{ trans('template.powerPanelDashboard.here') }}</a> {{ trans('template.powerPanelDashboard.findContactLead') }} </td>
                            </tr>
                            @else
                            @foreach ($inquiryleads as $key=>$lead)
                            @if($key<=4)
                            <tr>
                                <td>{!! $lead->varName !!}</td>
                                <td>{!! $lead->varDomain !!}</td>
                                <td align="left">{!! MyLibrary::encrypt_decrypt('decrypt',$lead->varEmail)!!}</td>
                                <td align="left">{!! MyLibrary::encrypt_decrypt('decrypt',$lead->varPhone)!!}</td>
                                <td align="left" class='numeric text-center'>
                                    <div class="pro-act-btn">
                                        <a href="javascript:void(0)" class="without_bg_icon"  onclick="return hs.htmlExpand(this,{width:300,headingText:'Message',wrapperClassName:'titlebar',showCredits:false});"><span aria-hidden="true" class="icon-envelope"></span></a>
                                        <div class="highslide-maincontent">{!! nl2br($lead->varMessage) !!}</div>
                                    </div>
                                </td>
                                <td align="right">{{ date(''.Config::get('Constant.DEFAULT_DATE_FORMAT').'  '.Config::get('Constant.DEFAULT_TIME_FORMAT').'', strtotime($lead->datetime)) }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if(isset($inquiryleads) && !empty($inquiryleads) && count($inquiryleads) > 0 )
            <div class="pull-right">
                <a class="btn btn-green-drake" href="{{ url('powerpanel/inquiry-leads') }}" title="{{ trans('template.powerPanelDashboard.seeAllRecords') }}">{{ trans('template.powerPanelDashboard.seeAllRecords') }}</a>
            </div>
            @endif
        </div>
    </div>
    @endpermission
</div>
<!-- END CONTENT BODY -->
<div class="new_modal modal fade detailsCmsPage" tabindex="-1" aria-hidden="true">
</div>
<div class="new_modal modal fade detailsContactUsLead" tabindex="-1" aria-hidden="true">
</div>
<div class="new_modal modal fade detailsinquiryLead" tabindex="-1" aria-hidden="true">
</div>
<div class="new_modal modal fade BlogDetails" tabindex="-1" aria-hidden="true">
</div>
@endsection
@section('scripts')
<script type="text/javascript">window.site_url = '{!! url("/") !!}';</script>
<script src="{{ url('resources/pages/scripts/dashboard-ajax.js') }}" type="text/javascript"></script>
<script src="{{ url('resources/global/plugins/highslide/highslide-with-html.js') }}" type="text/javascript"></script>

<script type="text/javascript">
            @if (Session::has('alert-success'))
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
            @if (Session::has('alert-success'))
            $("#topMsg").show().delay(5000).fadeOut();
            $("#topMsg").fadeOut("slow", function() {
    $('.page-header').css('top', '0');
            $('.page-container').css('top', '0');
    });
            @endif
            $(document).on('click', '#close_icn', function(e){
    $("#topMsg").hide();
            $('.page-header').css('top', '0');
            $('.page-container').css('top', '0');
    });
</script>
@endsection