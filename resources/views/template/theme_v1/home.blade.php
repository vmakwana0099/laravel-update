<div class="content_body_bg">
   
    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?> 
    @include('template.'.$themeversion.'.services_section')
    @include('template.'.$themeversion.'.features_section')
    {{-- @include('template.'.$themeversion.'.support_section') --}}
    @include('template.'.$themeversion.'.testimonial_section')
    @include('template.'.$themeversion.'.associated_with_section')
    {{-- @include('template.'.$themeversion.'.customer_rating_section') --}}
    




