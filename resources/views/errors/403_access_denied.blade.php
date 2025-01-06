<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
    <title>Host IT Smart 404 Response Error Page - Host IT Smart</title>
    <meta name="keywords" content="Host IT Smart, 404">
    <meta name="description" content="This is the Host IT Smart 404 response page.">
    <meta name="author" content="Host IT Smart">
    <meta name="csrf-token" content="">
    <meta name="robots" content="NoIndex-NoFollow">
    <link rel="icon" href="{{url('assets/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('assets/images/apple-touch-icon-144.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('assets/images/apple-touch-icon-114.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('assets/images/apple-touch-icon-72.png')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('assets/images/apple-touch-icon-57.png')}}">
    <link rel="stylesheet" href="{{url('assets/css/main.css')}}" media="all">
    <script src="{{url('assets/js/jquery-3.3.1.min.js')}}"></script>
</head>

<body>
    <div class="not-found">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center error-main">
                        <a href="{{url('/')}}" title="HostItSmart" class="aos-init" data-aos="fade-up" data-aos-delay="100"><img class="logo" src="{{url('assets/images/white-logo.png')}}" alt="HostItSmart"></a>
                        <div class="image-error aos-init" data-aos="flip-left" data-aos-easing="ease-out-back" data-aos-delay="300"><img src="{{url('assets/images/404.png')}}" alt="404  Error"></div>
                        <div class="error-content aos-init" data-aos="fade-up" data-aos-delay="500">
                           {{--  <h1>Access Denied</h1>
                            <p>Access to the page is forbidden due to permission restrictions</p> --}}
                            <a class="btn" href="{{url('/')}}" title="Back to home">Back to Home</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{url('assets/js/main.js')}}"></script>
</html>