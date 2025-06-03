@extends('layouts.app')
@section('content')
{{-- @include('layouts.inner_banner') --}}
<link rel="stylesheet" href="{{ url('assets/css/career-pages.css?v='.date('YmdHi')) }}">

@if (isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?> 
    @include('template.'.$themeversion.'.banner')
@endif


<div class="lading_bottom">
	<section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cs_que">
                        <h5>How do You and Host IT Smart become a Perfect Fit?</h5>
                        <p>We are seeking individuals who are Challenge Seekers who showcase confidence in the abilities to tackle the problems. Should be customer-centric, listening to the customers and understanding that their perception is reality. Should be a team player who has an awareness of making better use of time to achieve goals. Consistent innovators who play an active part on the world stage, as well as should be keen thinkers.
                        <br><br>
                        <span> If you have these qualities, it is safe to say, <strong class="que_bold">"Well begun is half done."</strong></span>
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    @if(!empty($CareersData) && count($CareersData) >0)
	    <div class="getquestion-div head-tb-p-40">
		    <div class="container">
		        <div class="row">
		            <div class="col-12">
		                
		                
					<h3 data-aos="fade-up">Explore Career Areas In Host It Smart</h3>
		                <p class="gqd_text">( All the below positions are for Ahmedabad )</p>
		            </div>
		            <br />

		            <div class="col-12">
		                <div class="careers-accordion" id="accordion">
		                	@php $i=0; @endphp
                            @if (isset($CareersData) && count($CareersData)>0)
                                @foreach($CareersData as $careers)
                              	    @if(isset($careers['careers'])&&!empty($careers['careers']))
            		                    <span class="cam_title" title="{{$careers['varTitle']??""}}">{{$careers['varTitle']??""}}</span>
            		                    @foreach($careers['careers'] as $career)
                                            @php
                                              if ($i == '-1'){
                                                  $class = 'true';
                                                  $class1 = 'show';
                                                  $class2 = '';
                                              }else {
                                                  $class = 'false'; 
                                                  $class1 = '';
                                                  $class2 = 'collapsed';
                                              }
                                            @endphp
            			                    <div class="card">
            			                        <div class="card-header" id="heading{{$i}}">
            			                            <h5 class="mb-0" title="{{$career['varTitle']??""}} - {{$career['txtShortDescription']??""}}">
            			                                <button class="btn btn-link {{$class2}}" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="{{$class}}" aria-controls="collapse{{$i}}">
            			                                	{{$career['varTitle']??""}} - {{$career['txtShortDescription']??""}}
            			                                </button>
            			                            </h5>
            			                        </div>
            			                        <div id="collapse{{$i}}" class="collapse {{$class1}}" aria-labelledby="heading{{$i}}" data-parent="#accordion">
            		                            <div class="card-body">
            	                                @php $SpecificationData = explode("\n",$career['txtDescription']); @endphp
                                              @foreach($SpecificationData as $specKey => $Specification)
                                                  {!!$Specification??""!!}
                                              @endforeach
            	                                <br>
            	                                <div class="careers-apply">
                                                <form method="post" action="{{ url('/career/details') }}" class="form-horizontal row contact_form" name="careers_form" id="careers_form">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="career_category" value="{{ $careers['id']??"" }}">
                                                <input type="hidden" name="career_name" value="{{trim($career['varTitle'])??""}}">
                                                <div class="clearfix"></div>
                                                <div class="col-12">
                                                    <div class="form-group">        
                                                        <button type="submit" class="btn" title="Send a message">Apply Now</button>
                                                    </div>
                                                </div>
                                            	</form>
            	                                </div>
            		                            </div>
            			                        </div>
            			                    </div>
            			                    @php $i++; @endphp
            		                    @endforeach
        		                    @endif
        		                @endforeach
                            @else
                                <div class="card" data-aos="fade-up">
                                    <div class="no-record"> 
                                        <i class="no-record-icon"></i><span>No Careers Available.</span>
                                    </div>
                                </div>
                            @endif
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
    @endif
</div>
<section class="career_section d-none">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cs_interview">
                            <span class="csi_text">We Value Your Time as Much as We Value Ours</span>
                             <span class="cs_text">For that very same reason Here is our Simple and Quick Interview Process</span>
                            
                        <div class="csi">
                            <div class="row">
                            
                                <div class="col-md-4 d-flex">
                                    <div class="csi_main">
                                        <span></span>
                                        <img alt="Telephonic/Skype" src="../assets/images/themecall.webp">
                                        <h5 title="Telephonic/Skype">Telephonic/Skype</h5>
                                        <p>Our HR Team member will screen your profile by asking a few general questions related to your current job, expected salary, notice period, etc.</p>
                                    </div>
                                </div>
                            
                                <div class="col-md-4 d-flex">
                                    <div class="csi_main">
                                        <span></span>
                                        <img alt="Technical Round" src="../assets/images/themelaptop1.webp">
                                        <h5 title="Technical Round">Technical Round</h5>
                                        <p>In this round, we will ask you technical questions to gauge your technical capabilities.</p>
                                    </div>
                                </div>
                            
                                <div class="col-md-4 d-flex">
                                    <div class="csi_main">
                                        <img alt="HR (Negotiation)" src="../assets/images/themehr.webp">
                                        <h5 title="HR (Negotiation)">HR (Negotiation)</h5>
                                        <p>We give our best offer and familiarise you with our company policies. Upon accepting our offer, you will receive a written offer letter the same day.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection