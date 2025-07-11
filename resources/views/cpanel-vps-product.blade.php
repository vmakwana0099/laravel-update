@extends('layouts.app')
@section('content')
<div class="vps_main {{$ProductBanner->varBannerIconClass}}">
    @if (isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
    	<link rel="stylesheet" href="{{URL::to('/assets/css/full-width-inner-banner.css')}}">
    	<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
    	@include('template.'.$themeversion.'.banner')
	@endif
@endsection 