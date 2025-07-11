@extends('layouts.app')
@section('content')

<?php 
$theme = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?>
@include('template.'.$theme.'.banner')


































@endsection