@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Register</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/front-register') }}">
							<input type="password" style="width: 0;height: 0; visibility: hidden;position:absolute;left:0;top:0;"/>
							{!! csrf_field() !!}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="off">
									@if ($errors->has('name'))
										<span class="help-block">
											{{ $errors->first('name') }}
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off">
									@if ($errors->has('email'))
										<span class="help-block">
											{{ $errors->first('email') }}
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" autocomplete="off">
									@if ($errors->has('password'))
										<span class="help-block">
											{{ $errors->first('password') }}
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
								<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off">
									@if ($errors->has('password_confirmation'))
										<span class="help-block">
											{{ $errors->first('password_confirmation') }}
										</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-btn fa-user"></i> Register
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection