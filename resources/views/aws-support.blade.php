@extends('layouts.app')
@section('content')

<div class="banner-inner aws-banner" style="background-image:url({{url('/assets/images/aws_banner_bg.jpg')}})">
    <div class="container">
        <div class="banner-content">
            <h2 class="text_head text-light" data-aos="fade-up" data-aos-delay="100">Amazon Web Service Support Provider</h2>
            <span class="banner-subtitle aos-init" data-aos="fade-up" data-aos-delay="200">Secure, Dynamic, and Cost-effective Solution</span>
            <span class="banner-subtitle aos-init" data-aos="fade-up" data-aos-delay="200">Focus on results while we administer your AWS efficiently to soar your business to the clouds. Quite literally!
            </span>
            <a href="javascript:void(0)" class="btn-primary btn-lets-talk aos-init" data-aos="fade-up" data-aos-delay="600" title="Let's Talk" data-bs-toggle="modal" data-bs-target="#all-offer">Let's Talk</a>

        </div>
    </div>
</div>

<div class="inner_container">
    <div class="aws-content">
        <div class="aws-managed-services head-tb-p-40">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-heading">
                            <h2 class="text-center text_head">AWS Support & Managed Services</h2>
                            <p>Amazon Web Service is a secure, dynamic, cost-effective, and highly-complex solution. Hence, deploying the application on this is a bit worrisome for most of the organizations but take it easy with us. We are here to help you with our competence by assisting you in configuring various instances. Whether you want AWS business support or customer support, you can rely on our expertise complemented with affordable AWS support pricing structure to overpower the technicalities involved. </p>
                            <p>We are thrilled to bring our expertise to you in cloud design and management. We are an authorized partner of AWS. With this partnership, we aim to provide various type of AWS Cloud support services. We have a dedicated team for Solution Architect, DevOps, Migration to provide you with AWS premium support. It is a one-stop AWS Cloud Solution organization.</p>
                        </div>
                    </div>
                    <div class="col-sm-8 col-12">
                        <div class="left aos-init" data-aos="fade-left" data-aos-delay="600">
                            <div class="points">
                                <ul>
                                    <li>AWS Migration & Strategy</li>
                                    <li>AWS Technical Support & Monitoring</li>
                                    <li>AWS Security & Compliance Management</li>
                                    <li>AWS DevOps Automation</li>
                                    <li>Database Migration And Management</li>
                                    <li>AWS Cost Optimization</li>
                                </ul>
                            </div>
                            @php if(Config::get('Constant.sys_currency') == 'INR'){ @endphp
                            {{--<div class="price">
                                <p class="false-price">
                                    <span class="rupee-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                    <span class="overline">{{ Config::get('Constant.PRODUCT_AWS_SUPPORT_PRICE_INR_WRONG') }}*</span>
                            /Hour
                            </p>
                            <p>
                                <span class="rupee-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                {{ Config::get('Constant.PRODUCT_AWS_SUPPORT_PRICE_INR') }}*/Hour
                            </p>
                        </div>--}}
                        @php } else { @endphp
                        {{--<div class="price">
                                <p class="false-price">
                                    <span class="rupee-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                    <span class="overline">{{ Config::get('Constant.PRODUCT_AWS_SUPPORT_PRICE_USD_WRONG') }}*</span>
                        /Hour
                        </p>
                        <p>
                            <span class="rupee-icon">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                            {{ Config::get('Constant.PRODUCT_AWS_SUPPORT_PRICE_USD') }}*/Hour
                        </p>
                    </div>--}}
                    @php } @endphp
                    <div class="start-now">
                        <a class="btn-primary btn-start-now aos-init" data-aos="fade-up" data-aos-delay="500" title="Let's Talk" data-bs-toggle="modal" data-bs-target="#all-offer">Start Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="right aos-init" data-aos="fade-right" data-aos-delay="600">
                    <img src="{{url('/')}}/assets/images/aws-support.webp" alt="AWS Services" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="vps-features head-tb-p-40 vps-plan-features" id="PerformanceOneMonthFeatures">
    <div class="container">
        <div class="row">
            <div class="features-main">
                <div class="section-heading">
                    <h2 class="text_head text-center">{{ Config::get('Constant.SITE_NAME') }} Helps You in Following Ways:</h2>
                </div>
                <div class="features-start">
                    <div class="row">
                        <div class="feature-ul d-flex flex-wrap">
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon savings"></i></div>
                                    <h3>Optimization to save cost</h3>
                                    <div class="content">Reducing cost is likely your need which may have influenced you to move towards the cloud technology. But it requires someone to analyze your AWS configuration regularly, looking for options to reduce cost and give the best performance needed.
                                    </div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon migration"></i></div>
                                    <h3>Migration to AWS</h3>
                                    <div class="content">AWS is one of the best cloud platforms you can find in the market but without experience, it's intimidating and overwhelming to move from any other platform to AWS. As you take the critical first step into the cloud we can help you with our experience and standard AWS support services to mitigate any interruption or risk in the deployment process.
                                    </div>
                                </div>
                            </div>
                            <div class="feature-box col-xs-12 col-sm-6 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-delay="100">
                                    <div class="feature-icon d-flex justify-content-center align-items-center"><i class="vps-features-icon expert"></i></div>
                                    <h3>Expertise</h3>
                                    <div class="content">It's really a challenge to get someone in-house with expertise on AWS who can set up the infrastructure you need without risk. We have AWS technical experts who work with you like your extended team.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="features-start features-start-mob d-md-none d-block">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon savings"></i></div>
                                    <h3>Optimization to save cost</h3>
                                    <div class="content">Reducing cost is likely your need which may have influenced you to move towards the cloud technology. But it requires someone to analyze your AWS configuration regularly, looking for options to reduce cost and give the best performance needed.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon migration"></i></div>
                                    <h3>Migrating to AWS</h3>
                                    <div class="content">AWS is one of the best cloud platforms you can find in the market but without experience, it's intimidating and overwhelming to move from any other platform to AWS. As you take the critical first step into the cloud we can help you with our experience and standard AWS support services to mitigate any interruption or risk in the deployment process.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-box col-xs-12 col-sm-12 col-md-4 d-flex flex-wrap justify-content-center">
                                <div class="content-main align-self-start">
                                    <div class="feature-icon"><i class="vps-features-icon expert"></i></div>
                                    <h3>Expertise</h3>
                                    <div class="content">It's really a challenge to get someone in-house with expertise on AWS who can set up the infrastructure you need without risk. We have AWS technical experts who work with you like your extended team.
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
<div class="what-we-do cms head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-heading">
                <h2 class="text-center text_head text-light">What we do?</h2>
                <p class="text-center text-light">We assist neoteric as well as mature businesses of all sizes in managing the below listed Amazon Web Services:
                </p>
                </div>
            </div>
            <div class="col-12 col-sm-4 aos-init" data-aos="fade-up" data-aos-delay="300">
                <ul class="aws-list">
                    <li>
                        Deployment of ongoing products
                    </li>
                    <li>
                        AWS EC2 Instance management
                    </li>
                    <li>
                        AWS ELB/ALB management
                    </li>
                    <li>
                        AWS Auto Scaling management
                    </li>
                    <li>
                        AWS Elastic IP
                    </li>
                    <li>
                        AWS Security Group management
                    </li>
                    <li>
                        AWS VPC management
                    </li>
                    <li>
                        AWS Route53 management
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-4 aos-init" data-aos="fade-up" data-aos-delay="300">
                <ul class="aws-list">
                    <li>
                        AWS S3 management
                    </li>
                    <li>
                        AWS RDS management
                    </li>
                    <li>
                        AWS EBS management
                    </li>
                    <li>
                        AWS Glacier management
                    </li>
                    <li>
                        AWS Lambda management
                    </li>
                    <li>
                        AWS IAM management
                    </li>
                    <li>
                        AWS Elastic Cache management
                    </li>
                    <li>
                        AWS Cloud Watch management
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-4 aos-init" data-aos="fade-up" data-aos-delay="300">
                <ul class="aws-list">
                    <li>
                        AWS Beanstalk management
                    </li>
                    <li>
                        AWS Elastic Container Service (ECS)
                    </li>
                    <li>
                        AWS Amazon Elastic Container Registry
                    </li>
                    <li>
                        AWS CloudFront
                    </li></br>
                    <li>
                        AWS CodeCommit
                    </li>
                    <li>
                        AWS CodeBuild
                    </li>
                    <li>
                        AWS CodePipeline (CI/CD)
                    </li>
                    <li>
                        AWS WAF and Shield
                    </li>
                    <li>
                        AWS SNS
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--        <div class="what-we-do cms">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="text-center aos-init" data-aos="fade-up" data-aos-delay="100">SOLUTION</h2>
                                <p class="sub-title aos-init" data-aos="fade-up" data-aos-delay="200">We assist neoteric as well as mature businesses of all sizes in managing the below listed Amazon Web Services:</p>
                            </div>
                            <div class="col-12 col-sm-4 aos-init" data-aos="fade-up" data-aos-delay="300">
                                <ul class="aws-list">
                                    <li>AMAZON ECHO SKILLS DEVELOPMENT</li>
                                    <li>DATA CENTER MIGRATION SERVICES</li>
                                    <li>CUSTOMIZE CLOUD SOLUTIONS</li>                            
                                </ul>
                            </div>                     
                        </div>
                    </div>
                </div>-->
<?php /*<div class="aws-services-faq">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 data-aos="fade-up">Our AWS Managed Services</h3>
                        <p class="sub-title" data-aos="fade-up">Having mastered the language of AWS, we strive to deliver industry-leading AWS premium support services at a pricing starting merely from Rs.300 per hour. We ensure the highest level of excellence and affordability. Our services include:</p>
                    </div>
                    <div class="col-12">
                        <div id="accordion">
                            <div class="card" data-aos="fade-up">
                                <h4 class="mb-0">
                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Build Containers with Docker
                                    </button>
                                </h4>
                                <div id="collapseOne" class="collapse" data-parent="#accordion" style="display:block;">
                                    <div class="card-body">
                                        <p>We help businesses build, manage and optimize the entire application portfolio that tightens the security of existing application, addresses their needs, accelerates transformation efforts and reduces the cost.</p>
                                        <div class="cms">
                                            <ul>
                                                <li>Assessment of cloud infrastructure for container-readiness</li>
                                                <li>Cluster design and build-out</li>
                                                <li>Orchestration tool integration (Kubernetes, AWS ECS)</li>
                                                <li>Container security services</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" data-aos="fade-up">
                                <h4 class="mb-0">
                                    <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Incident-based Solutions
                                    </button>
                                </h4>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Encountered a sudden glitch that’s affecting your business performance? With our extensive experience in the field, we will extricate you from it</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" data-aos="fade-up">
                                <h4 class="mb-0">
                                    <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Configuration for Small-to-Medium Business
                                    </button>
                                </h4>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>We offer a range of AWS configuration services like designing, migration, cost optimization, security management and more, customized to the unique needs of small as well as medium-sized businesses.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" data-aos="fade-up">
                                <h4 class="mb-0">
                                    <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                        Dedicated Technical Assistance
                                    </button>
                                </h4>
                                <div id="collapsefour" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>We will provide you a personal contact of our technical experts who will be available on hand to offer right advice tailored to your requirements.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>*/ ?>
<div class="why-choose-us head-tb-p-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-12">
                <div class="left aos-init" data-aos="fade-left" data-aos-delay="100">
                    <div class="left-in">
                        <h2>Why Choose us as your AWS Managed Services provider?</h2>
                        <div class="points">
                            <ul>
                                <li>24*7 Support</li>
                                <li>Certified Technical Expertise</li>
                                <li>Affordable and Constructive Solutions</li>
                                <li>Proactive Approach</li>
                                <li>Scalable Results</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-12 right-start aos-init" data-aos="fade-left" data-aos-delay="800">
                <div class="right">
                    <div class="right-in">
                        <h2>Partner with {{ Config::get('Constant.SITE_NAME') }} to make AWS work for you!</h2>
                        <div class="work">
                            <ul>
                                <li>
                                    <img title="Big Bang" alt="Big Bang {{ Config::get('Constant.SITE_NAME') }} AWS Work" src="{{url('/')}}/assets/images/partner1.webp">
                                </li>
                                <li>
                                    <img title="COSMONAUT" alt="COSMONAUT {{ Config::get('Constant.SITE_NAME') }} AWS Work" src="{{url('/')}}/assets/images/partner2.webp">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /*<div class="plans-services">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center aos-init" data-aos="fade-up" data-aos-delay="100">Lead the world  with the support plans elegantly designed for your business</h2>
                    </div>
                    <div class="col-sm-12 cms aos-init" data-aos="fade-up" data-aos-delay="200">
                        <table class="table table-hover">
                            <tr>
                                <th align="left" valign="middle"> </th>
                                <th align="left" valign="middle">Standard Support</th>
                                <th align="left" valign="middle">Business Support</th>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">Support of the AWS platform<br/> 100% certified AWS engineers deliver Support for AWS 24x7x365</td>
                                <td align="left" valign="middle">Yes</td>
                                <td align="left" valign="middle">Yes</td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">Technical Account Manager
                                    <br/>Personal contact for ongoing business and technical assistance</td>
                                <td align="left" valign="middle">No</td>
                                <td align="left" valign="middle">Yes</td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">Best practices and architecture
                                    <br/>A combined set of AWS and HostITSmart recommendations from certified AWS architects</td>
                                <td align="left" valign="middle">Guidance for standard use cases</td>
                                <td align="left" valign="middle">Hands-on design, customized to your specific application</td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">EC2 operating system management
                                    <br/>Configuration, optimization, patching, upgrades
                                    <br/>Includes core apps like Apache, NGINX, etc.</td>
                                <td align="left" valign="middle">One Time</td>
                                <td align="left" valign="middle">Regular</td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">Database Management Capabilities
                                    <br/>Support for AWS database services, including RDS (Aurora) and DynamoDB
                                    <br/>Expertise in AWS native tools, including Database Migration Service, Schema Conversion Tool, and Performance Insights
                                </td>
                                <td align="left" valign="middle">One Time</td>
                                <td align="left" valign="middle">Regular</td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">CloudWatch Management and Incident Response
                                    <br/>Setup of Cloudwatch monitors and response to Cloudwatch alarm 24x7x365 by certified AWS engineers
                                </td>
                                <td align="left" valign="middle">No</td>
                                <td align="left" valign="middle">Regular</td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">Account review
                                    <br/>Review AWS Trusted Advisor recommendations
                                    <br/>Review Reserved Instance and other cost optimization opportunities
                                    <br/>Technical environment review (alerts, performance)
                                </td>
                                <td align="left" valign="middle">No</td>
                                <td align="left" valign="middle">Yes</td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">Response Times</td>
                                <td align="left" valign="middle">Response time guarantees as fast as 120 minutes</td>
                                <td align="left" valign="middle">Response time guarantees as fast as 30 minutes</td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">Price flexibility</td>
                                <td align="left" valign="middle">No</td>
                                <td align="left" valign="middle">Yes</td>
                            </tr>
                            /*<tr>
                                <td align="left" valign="middle">Monthly Cost</td>
                                <td align="left" valign="middle">Rs. 350/hr</td>
                                <td align="left" valign="middle">25% of Amazon billing</td>
                            </tr>*/
/*<!--                            <tr>
                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                <td align="left" valign="middle"><strong>Monthly Cost: Rs. {{ Config::get('Constant.PRODUCT_AWS_SUPPORT_PRICE_INR') }}/hr</strong>
                                    @php } else {  @endphp 
                                <td align="left" valign="middle"><strong>Monthly Cost: U.S. {{ Config::get('Constant.PRODUCT_AWS_SUPPORT_PRICE_USD') }}/hr</strong>
                                    @php } @endphp 


                                    <a class="btn-primary btn-start-now aos-init aos-animate" data-aos="fade-up" data-aos-delay="500" title="Let's Talk" data-bs-toggle="modal" data-bs-target="#all-offer">Start Now</a></td>
                                <td align="left" valign="middle"><a class="req-qoute-btn" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#all-offer">Request a Quote</a></td>
                                <td align="left" valign="middle"><a class="req-qoute-btn" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#all-offer">Request a Quote</a></td>
                            </tr>-->
                        </table>
                    </div>
                </div>
            </div>
        </div>*/ ?>
<div class="lets-talk">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="title aos-init" data-aos="fade-left" data-aos-delay="100">Got a Project?</p>
                <a class="btn-primary btn-lets-talk aos-init" data-aos="fade-right" data-aos-delay="200" title="Let's Talk" data-bs-toggle="modal" data-bs-target="#all-offer">Let's Talk</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal fade common-popup" id="all-offer" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">AWS Support</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="common-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="require-field">*(Denotes Required)</div>
                            {!! Form::open(['method' => 'post', 'class'=>'custom-input form-group contact_form', 'autocomplete' => 'off','name' => 'aws_form', 'id' => 'aws_form']) !!}
                            {!! Form::hidden('varRefURL',URL::previous(),null) !!}
                            <!--<form id="common-form" action="" method="post" role="form" style="display: block;">-->
                            <div class="form-group">
                                <label for="comname">First Name <span class="required">*</span></label>
                                {!! Form::text('var_Fname', old('var_Fname') , array('maxlength' => 40, 'id' => 'var_Fname','pattern'=>'[a-zA-Z\s]+', 'autocomplete' => 'off','class' => 'form-control', 'placeholder' => 'Enter your first name')) !!}
                                @if ($errors->has('var_Fname'))
                                <span class="help-block">
                                    {{ $errors->first('var_Fname') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="comname">Last Name <span class="required">*</span></label>
                                {!! Form::text('var_Lname', old('var_Lname') , array('maxlength' => 40, 'id' => 'var_Lname', 'pattern'=>'[a-zA-Z\s]+','autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Enter your last name')) !!}
                                @if ($errors->has('var_Lname'))
                                <span class="help-block">
                                    {{ $errors->first('var_Lname') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="comemail">EMAIL <span class="required">*</span></label>
                                {!! Form::text('var_email', old('var_email') , array('maxlength' => 50, 'id' => 'var_email', 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Enter your email address')) !!}
                                @if ($errors->has('var_email'))
                                <span class="help-block">
                                    {{ $errors->first('var_email') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="comphone">Phone <span class="required">*</span></label>
                                {!! Form::tel('var_phone', old('var_phone') , array('maxlength' => 15, 'id' => 'var_phone', 'autocomplete' => 'off', 'class' => 'form-control', 'maxlength'=>"20", 'placeholder' => 'Enter your phone #' , 'onpaste'=>'return false;','ondrop'=>'return false;', 'onkeypress'=>'javascript: return KeycheckOnlyPhonenumber(event);')) !!}
                                @if ($errors->has('var_phone'))
                                <span class="help-block">
                                    {{ $errors->first('var_phone') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="comphone">Company</label>
                                {!! Form::text('var_company', old('var_company') , array('maxlength' => 80, 'id' => 'var_company','pattern'=>'[a-zA-Z\s]+', 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Enter your company')) !!}
                            </div>
                            <div class="form-group">
                                <label for="comphone">State</label>
                                {!! Form::text('var_state', old('var_state') , array('maxlength' => 50, 'id' => 'var_state','pattern'=>'[a-zA-Z\s]+', 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Enter your state/region')) !!}
                            </div>
                            @if ($errors->has('var_state'))
                            <span class="help-block">
                                {{ $errors->first('var_state') }}
                            </span>
                            @endif

                            <div class="form-group">
                                <label for="commessage">Message <span class="required">*</span></label>
                                {!! Form::textarea('var_message', old('var_message') , array('maxlength' => 1000, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter your message here...','cols' => '40', 'rows' => '3', 'id' => 'var_message', 'spellcheck' => 'true' )) !!}
                                @if ($errors->has('var_message'))
                                <span class="help-block">
                                    {{ $errors->first('var_message') }}
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <div id="html_element" class="g-recaptcha form-text" data-sitekey="{{ Config::get('Constant.GOOGLE_CAPCHA_KEY') }}" data-callback="check_captcha"></div>
                                    <div class="capphitcha">
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            {{ $errors->first('g-recaptcha-response') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group text-center">
                                    {{-- <form action=""> --}}
                                {{-- <input type="checkbox" id="" name="terms" required> --}}
                                <label for="">By clicking "Submit", you agree to our <a target="_blank" title="Privacy Policy" href="{{url('privacy-policy')}}">Privacy Policy</a>.</label> 
                                {{-- </form> --}}
                                </div>
                            </div>
                            <div class="aws-form-sub-btn text-center">
                            <div class="form-group submit-btn-part primary-btn-round">
                                <input type="submit" name="Submit" id="Submit" tabindex="7" class="btn text-white" value="Submit">
                            </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <script src="{{ url('assets/js/aws-support.js?v={{date('YmdHi')}}') }}"></script> --}}
        <script src="{{ url('assets/js/aws-support.js?v=' . date('YmdHi')) }}"></script>
    </div>
</div>
<script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('html_element', {
            'sitekey': '{{Config::get("Constant.GOOGLE_CAPCHA_KEY")}}'
        });
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection