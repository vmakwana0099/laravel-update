 
@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
 


    <div class="domain-search-main">
        <div class="services_section domain-search">
            <div class="container">
            {!! Form::open(['route' => 'cart.store']) !!}
            <div class="form-group">
                {!! Form::label('jsonarr', 'Enter JSON Array for cart items') !!}
                {!! Form::text('jsonarr', null, ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

            {!! Form::close() !!}
            </div>
        </div>
    </div>
                
@endsection