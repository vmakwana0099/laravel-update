@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="inner_container cms privacy_policy_div">
    <div class="container">
        <div class="row">	
            <div class="col-md-12">
                {!!$Description!!}
                <div class="spacer_25"></div>
            </div>
        </div>
    </div>
</div>
@endsection