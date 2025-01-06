<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{url('resources/global/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('resources/css/main.css')}}">
    <!-- Favicons ================================== -->
    <link rel="shortcut icon" href="{{url('/resources/images/favicon.ico')}}" type="image/x-icon"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('resources/images/apple-touch-icon-144.png')}}"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('resources/images/apple-touch-icon-114.png')}}"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{url('resources/images/apple-touch-icon-72.png')}}"/>
    <link rel="apple-touch-icon-precomposed" href="{{url('resources/images/touch-icon-57.png')}}"/>
    <script type="text/javascript" src="{{ url('resources/global/plugins/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('resources/global/plugins/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ url('resources/global/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('resources/global/plugins/placeholder.js') }}"></script>
    <script type="text/javascript" src="{{ url('resources/global/plugins/flowtype.js') }}"></script>
    <style type="text/css">
      .notfound_bg{background-image:url("{{url('resources/images/img_404.jpg')}}");background-color:rgba(255, 255, 255, 1)}
      @media (min-width: 768px){.notfound_01 .nq_container{max-width:750px}}
      @media (min-width: 992px){.notfound_01 .nq_container{max-width:970px}}
      @media (min-width: 1200px){.notfound_01 .nq_container{max-width:1170px;margin: auto;}}
      .notfound_01 .btn_size{margin:5px 0px;padding:8px 15px;font-size:18px;line-height:150%;text-transform:uppercase;white-space:inherit}
      .notfound_01 h1.nqtitle,.notfound_01 h2.nqtitle,.notfound_01 h3.nqtitle,
      .notfound_01 h4.nqtitle,.notfound_01 h5.nqtitle,.notfound_01 
      h6.nqtitle{font-family:"Righteous";font-weight:400;font-size:5em;line-height:100%;color:rgba(3, 155, 229, 1);text-transform:capitalize;margin:35px 0px 0px 0px}
      .notfound_01 h1,.notfound_01 h2,.notfound_01 h3,.notfound_01 h4,.notfound_01 h5,
      .notfound_01 h6{font-family:"Righteous";font-weight:400;line-height:100%;color:rgba(3, 155, 229, 1);text-transform:capitalize}
      .notfound_01 .icon{font-size:50px;line-height:100%;color:rgba(3, 155, 229, 1);text-transform:uppercase}.notfound_01 .box_border{background-color:rgba(255, 255, 255, 0.8);padding:35px 0px;max-width:600px;margin: auto;}
    </style>
    <title>404 Page</title>
  </head>
  <body class="sticky-header admin-bar notfound_bg">
    <div>
      <section class="section notfound_01">
        <div class="nq_container">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="box_border">
                <div>
                  <a href="{{url('/powerpanel')}}" title="{{$SITE_NAME}}">
                    <img alt="Alt Here" src="{!! App\Helpers\resize_image::resize($image_id,300,150) !!}">
                  </a>
                </div>
                <div class="icon">
                  <hr>Oops
                  <i class="fa fa-exclamation" aria-hidden="true"></i>
                  <hr>
                </div>
                <h2 class="nqtitle align custom_nqtitle">
                  <span>4
                    <i class="fa fa-exclamation-triangle animate fadeInDownBig load"></i>
                  4</span>
                </h2>
                <h3>The requested page not found.</h3>
                <a href="{{url('/powerpanel')}}" title="Back To Home" class="btn btn_size btn_radius btn_bg_none btn_txt_change btn_bg_change"><i class="fa fa-home"></i> Back To Home</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script type="text/javascript">
      $( "h1,h2,h3,h4,h5,h6" ).wrap( $( "<div class='titleWrap'></div>" ) );
      $('.titleWrap').flowtype({
        minimum   : 280,
        maximum   : 1920,
        minFont   : 24,
        maxFont   : 36,
        fontRatio : 35
      });
    </script>
  </body>
</html>