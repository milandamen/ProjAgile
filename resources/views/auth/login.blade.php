@extends('app')

@section('title')
	De Bunders - Inloggen
@stop

@section('description')
	Dit is de inlog pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
		{!! Breadcrumbs::render('auth.login') !!}
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2 class="page-header">Inloggen</h2>
				<div class="panel panel-default">
					<div class="row">
						@include('flash::message')
					</div>
					<div class="panel-body">
						@include('errors.partials._list')
						{!! Form::open(['method' => 'POST', 'route' => 'auth.login']) !!}
							<div class="form-group">
								{!! Form::label('username', 'Gebruikersnaam:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6 addmargin">
									{!! Form::text('username', old('username'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('password', 'Wachtwoord:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6 addmargin">
									{!! Form::password('password', ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('remember', 'Onthoud mij:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6 addmargin">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default">
											<input type="radio" name="remember" value="true">
											Ja
										</label>
										<label class="btn btn-default active">
											<input type="radio" name="remember" value="false" checked="true">
											Nee
										</label>
									</div>
								</div>
							</div>
							@if(session('enableReCaptcha') !== null && session('enableReCaptcha'))
								<div class="form-group">
									<div class="col-md-4 col-md-offset-4 addmargin">
										{!! Recaptcha::render() !!}
									</div>
								</div>
							@endif
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4 addmargin">
									{!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									{!! link_to_route('registration.register', 'Nog geen account?', [], ['class' => 'btn btn-info']) !!}
									{!! link_to_route('password.reminder', 'Wachtwoord vergeten?', [], ['class' => 'btn btn-info']) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop