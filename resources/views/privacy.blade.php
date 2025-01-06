@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="privacy-main head-tb-p-40">
    <div class="container">
        <div class="privacy-c cms">
            <div class="row">
                <div class="col-md-7 col-12">
                    <div class="privacy-left" data-aos="fade-right">
                        {!!$Description!!}
                        @if(session()->has('frontlogin'))
                        <?php $apiUrl = config('app.api_url'); ?>
                        <a class="btn" title="Get domain protection today" target="_blank" href="<?php echo $apiUrl; ?>/clientarea.php?action=domains">Get domain protection today</a>
                         @else
                         <a class="btn" title="Get domain protection today" data-toggle="modal" data-target="#loginModal" href="javascript:;">Get domain protection today</a>
                         @endif
                        
                    </div>
                </div>
                <div class="col-md-5 col-12">
                    <div class="privacy-right" data-aos="fade-left">
                        <div class="privacy-box red" id="Off-Privacy">
                            <div class="privacy-box1">
                                <span>Registrant Name</span>
                                <span><b>Ravi Varma</b></span>
                            </div>
                            <div class="privacy-box1">
                                <span>Organization</span>
                                <span><b>Ravie & Co. Textiles</b></span>
                            </div>
                            <div class="privacy-box1">
                                <span>Address</span>
                                <span><b>Mumbai, Maharashtra, India</b></span>
                            </div>
                            <div class="privacy-box1">
                                <span>Phone Number</span>
                                <span><b>+45 36946676</b></span>
                            </div>
                            <div class="privacy-box1">
                                <span>Email</span>
                                <span><b>Ravivarma@gmail.com</b></span>
                            </div>
                        </div>

                        <div class="privacy-box green" id="On-Privacy" style="display: none">
                            <div class="privacy-box1">
                                <span>Registrant Name</span>
                                <span><b>Domain Admin</b></span>
                            </div>
                            <div class="privacy-box1">
                                <span>Organization</span>
                                <span><b>Privacy Protection Service INC</b></span>
                            </div>
                            <div class="privacy-box1">
                                <span>Address</span>
                                <span><b>C/O ID#10760, PO Box 16, AU</b></span>
                            </div>
                            <div class="privacy-box1">
                                <span>Phone Number</span>
                                <span><b>+45 3694667645</b></span>
                            </div>
                            <div class="privacy-box1">
                                <span>Email</span>
                                <span><b>yourdomain@hostitsmart.com</b></span>
                            </div>
                        </div>

                        <div class="switch-plan">
                            <div class="month-tab active aos-init aos-animate" data-aos="fade-left" data-aos-delay="400">PRIVACY OFF</div>
                            <label class="switch aos-init aos-animate" data-aos="zoom-in" data-aos-easing="ease-out-back" data-aos-delay="100">
                                <input type="checkbox" name="on" id="on" onclick="calc();">
                                <span class="slider round"></span>
                            </label>
                            <div class="month-tab aos-init aos-animate" data-aos="fade-right" data-aos-delay="400">PRIVACY ON
                            </div>
                            <script type="text/javascript">
                                function calc()
                                {
                                    if ($('#on').is(":checked")) {
                                        $('#Off-Privacy').hide();
                                        $('#On-Privacy').show();
                                    } else {
                                        $('#Off-Privacy').show();
                                        $('#On-Privacy').hide();
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="privacy-2 head-tb-p-40">
    <div class="container">
        <div class="privacy-text">
            <div class="section-heading">
            <h3 class="text_head text-center text-light">How Can My Public Details Be Mis-used</h3>
            </div>
            <div class="privacy-box row">
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="box-1" data-aos="zoom-in" data-aos-delay="100">
                        <div class="box-support">
                            <i class="box-icon hijack-icon"></i>
                            <span class="">DOMAIN HIJACKING</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="box-1" data-aos="zoom-in" data-aos-delay="200">
                        <div class="box-support">
                            <i class="box-icon spam-icon"></i>
                            <span class="">SPAM CALLS,EMAILS &amp; SMSES</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="box-1" data-aos="zoom-in" data-aos-delay="300">
                        <div class="box-support">
                            <i class="box-icon identity-icon"></i>
                            <span class="">IDENTITY THEFT</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="box-1" data-aos="zoom-in" data-aos-delay="400">
                        <div class="box-support">
                            <i class="box-icon phising-icon"></i>
                            <span class="">PHISHING ATTACKS</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="box-1" data-aos="zoom-in" data-aos-delay="500">
                        <div class="box-support">
                            <i class="box-icon domain-spam-icon"></i>
                            <span class="">DOMAIN-RELATED SPAM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="secure-privacy-main head-tb-p-40">
    <div class="container">
        <div class="secure-privacy">
            <h3 class="privacy-head" data-aos="fade-down"><i class="lock"></i>SECURE YOUR <span class="green">PRIVACY</span> TODAY!</h3>
            <ul class="nav nav-pills" data-aos="fade-down">
                <li class="active"><a data-toggle="pill" href="#privacy1" class="" title="New Domains">New Domains</a></li>
                <li><a data-toggle="pill" href="#privacy2" class="active show" title="Existing Domains">
                        Existing Domains</a>
                </li>
            </ul>
            <div class="tab-content" data-aos="fade-left">
                <div id="privacy1" class="tab-pane" data-aos="fade-left1" >
                    <div class="anim" data-aos="fade-left1">
                        <h4 class="privacy-tab-text" >Get Privacy Protext on a new domain name</h4>
                        <span class="privacy-text">Privacy Protect will be added automatically on your Cart Checkout Page</span>
                        <div class="banner-search aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                            <form id="domainlookupfrm" class="custom-search" autocomplete="off" name="domainlookupfrm" action="{{url('/domain-checker')}}" method="post">
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" name="hide_tlddata" id="hide_tlddata" value="{{$Tlds}}" />
                                <input type="hidden" name="domain_search" id="domain_search" value="y" />
                                <input type="text" class="form-control" placeholder="Find your perfect domain name" id="domain_name" name="domainname">
                                <button type="submit" title="Search" class="domain_error"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="privacy2" class="tab-pane active show">
                    <div class="anim" data-aos="fade-left1">
                        <h4 class="privacy-tab-text">Looking to add privacy protect to your existing domain name?</h4>
                        <span class="privacy-text">Login to your Control Panel, view your desired Domain Name and Click on 'Enable Privacy Protect'</span>
                        @if(session()->has('frontlogin'))
                        <?php $apiUrl = config('app.api_url'); ?>
                        <a href="<?php echo $apiUrl; ?>" target="_blank" class="btn" title="My Account" id="my_account">My Account</a>
                        @else
                        <a href="#" data-toggle="modal" class="btn" data-target="#loginModal" title="Create Account">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<div class="getquestion-div">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 data-aos="fade-up">Got a Question? We've the Answer!</h3>
            </div>
            <div class="col-12">
                <div id="accordion">
                    <div class="card" data-aos="fade-up">
                        <h4 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What is WordPress Hosting?
                            </button>
                        </h4>
                        <div id="collapseOne" class="collapse" data-parent="#accordion" style="display:block;">
                            <div class="card-body">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card" data-aos="fade-up">
                        <h4 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Can I upgrade my Wordpress Hosting plan?
                            </button>
                        </h4>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card" data-aos="fade-up">
                        <h4 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Can I add more sites to an existing plan?
                            </button>
                        </h4>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card" data-aos="fade-up">
                        <h4 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                Can I use an external email service with Wordpress Hosting?
                            </button>
                        </h4>
                        <div id="collapsefour" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card" data-aos="fade-up">
                        <h4 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                Can I use an existing certificate with my blog?
                            </button>
                        </h4>
                        <div id="collapsefive" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card" data-aos="fade-up">
                        <h4 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                Will Wordpress be updated automatically?
                            </button>
                        </h4>
                        <div id="collapsesix" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 aos-init" data-aos="fade-up">
                <a href="#" title="More" class="more_link">More</a>
            </div>
        </div>
    </div>
</div>-->

@if(!empty($FaqData) && count($FaqData) >0)
<div class="getquestion-div head-tb-p-40">
        <div class="container">
            <div class="row">
                <div class="section-heading">
                    <h3 class="text_head text-center">Still have questions? See if our answer database solves your query already</h3>
                </div>
                <div class="col-12">
                    <div id="accordion">
                        @php $i = 0; $class = ''; $class1 = ''; $class2 = ''; $class3 = '';  $class4 = ''; @endphp
                        @foreach($FaqData as $FaqCat)
                        @php
                        if ($i == '0'){
                        $class = 'true';
                        $class1 = 'collapsed';
                        $class2 = 'display:block';
                        $open_class = 'active-accordition';
                        } else {
                        $class = 'false'; 
                        $class1 = 'collapsed'; 
                        $class2 = 'display:none';
                        $open_class = '';
                        }     
                        if ($i > '4'){
                        $class3 = 'display:none';
                        $class4 = 'display:block';
                        } else {
                        $class3 = '';
                        $class4 = 'display:none';
                        } 
                        @endphp
                        <div class="accordion-item" data-aos="fade-up" style="{{$class3}}">
                            <h4 class="accordion-header mb-0 {{$open_class}}">
                                <button class="accordion-button btn btn-link {{$class1}}" type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                    {{$FaqCat->varTitle}}
                                </button>
                            </h4>
                            <div id="collapse{{$i}}" class="accordion-collapse collapse" data-parent="#accordion" style="{{$class2}}">
                                <div class="accordion-body">
                                    {!! $FaqCat->txtDescription !!}
                                </div>
                            </div>
                        </div>
                        @php $i++;@endphp
                        @endforeach
                    </div>
                </div>
                <div class="col-12 aos-init" data-aos="fade-up" style="{{$class4}}">
                    <a href="javascript:;" id="show" title="More" class="more_link">More</a>
                </div>
                <script>
                    $("#show").click(function () {
                        $(".card").show();
                        $("#show").hide();
                    });
                </script>
            </div>
        </div>
    </div>
@endif
 
@if(!empty($testimonialData) && count($testimonialData) >0)
<div class="testomonial-section d-flex">
    <div class="container align-self-center">
        <div class="row">
            <div class="col-12">
                <h2 class="testomonial-head aos-init" data-aos="fade-up">WHAT OUR CUSTOMERS <span class="c-blue">SAY</span></h2>
                <div class="owl-carousel owl-theme" id="testomonial-owl1">
                    @foreach($testimonialData as $testimonialvalue)
                    <div class="item cms col aos-init" data-aos="fade-up">
                        <div class="features-icon">
                         <?php
                            /*@if(!empty($testimonialvalue->fkIntImgId))
                            <img src="{!! App\Helpers\resize_image::resize($testimonialvalue->fkIntImgId,134,134) !!}" alt="{{ $testimonialvalue->varTitle }}" title="{{ $testimonialvalue->varTitle }}"/>
                            @else
                            <img src="{{url('assets/images/testimonial-m.svg')}}" alt="{{ $testimonialvalue->varTitle }}" title="{{ $testimonialvalue->varTitle }}" />
                            @endif*/
                        ?>
                        <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                        <div class="features-head">
                            {{$testimonialvalue->varTitle}}
                        </div>
                        <p class="features-text">
                            {!! (str_limit($testimonialvalue->txtDescription, 1400)) !!}
                        </p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection