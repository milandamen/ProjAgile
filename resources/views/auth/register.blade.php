@extends('app')

@section('title')
	De Bunders - Registreren
@stop

@section('description')
	Dit is de registratie pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
		{!! Breadcrumbs::render('auth.register') !!}
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2 class="page-header">Registreren</h2>
				<div class="row">
					@include('flash::message')
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						@include('errors.partials._list')
						{!! Form::open(['method' => 'POST','route' => 'auth.register']) !!}
							<div class="form-group">
								{!! Form::label('username', 'Gebruikersnaam:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('username', old('username'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('password', 'Wachtwoord:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::password('password', ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('password_confirmation', 'Herhaal Wachtwoord:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('firstName', 'Voornaam:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('firstName', old('firstName'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('insertion', 'Tussenvoegsel:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('insertion', old('insertion'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('surname', 'Achternaam:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('surname', old('surname'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('houseNumber', 'Huisnummer', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('houseNumber', old('houseNumber'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('suffix', 'Toevoeging', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('suffix', old('suffix'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('postal', 'Postcode:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('postal', old('postal'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('email', 'E-mailadres:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('email_confirmation', 'Herhaal E-mailadres:', ['class' => 'col-md-4 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('email_confirmation', old('email_confirmation'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
								</div>
								<div class="col-md-6">
									{!! Recaptcha::render() !!}
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									{!! Form::submit('Registreren', ['class' => 'btn btn-primary']) !!}
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