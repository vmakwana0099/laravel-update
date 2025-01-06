@extends('layouts.app')
<?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?> 
@section('content')
@include('template.'.$themeversion.'.banner')
@include('template.'.$themeversion.'.home')
@endsection
