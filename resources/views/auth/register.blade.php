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
			<div class="col-md-10 col-md-offset-1">
				<h2 class="page-header">Registreren</h2>
				<div class="row">
					@include('flash::message')
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						@include('errors.partials._list')
						{!! Form::open(['method' => 'POST','route' => 'auth.register']) !!}
							
							<div class="col-md-12 no-padding addmargin">
								<div class="col-md-12 addmargin">	
									<div class="col-md-6">	
									{!! Form::label('username', 'Gebruikersnaam:', ['class' => ' control-label']) !!}
									{!! Form::text('username', old('username'), ['class' => 'form-control']) !!}
									</div>
								</div>
								<div class="col-md-12 addmargin">
									<div class="col-md-6">
										{!! Form::label('password', 'Wachtwoord:', ['class' => 'control-label']) !!}
										{!! Form::password('password', ['class' => 'form-control']) !!}
									</div>
									<div class="col-md-6">
										{!! Form::label('password_confirmation', 'Herhaal Wachtwoord:', ['class' => 'control-label']) !!}
										{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
									</div>
								</div>
								<div class="col-md-12 addmargin">
									<div class="col-md-6">
										{!! Form::label('email', 'E-mailadres:', ['class' => 'control-label']) !!}
										{!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
									</div>
									<div class="col-md-6">
										{!! Form::label('email_confirmation', 'Herhaal E-mailadres:', ['class' => 'control-label']) !!}
										{!! Form::text('email_confirmation', old('email_confirmation'), ['class' => 'form-control']) !!}
									</div>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<div class="col-md-12 addmargin no-padding">
									<div class="col-md-4">
										{!! Form::label('firstName', 'Voornaam:', ['class' => 'control-label']) !!}
										{!! Form::text('firstName', old('firstName'), ['class' => 'form-control']) !!}
									</div>
									<div class="col-md-3">
										{!! Form::label('insertion', 'Tussenvoegsel:', ['class' => 'control-label']) !!}
										{!! Form::text('insertion', old('insertion'), ['class' => 'form-control']) !!}
									</div>
									<div class="col-md-5">
										{!! Form::label('surname', 'Achternaam:', ['class' => 'control-label']) !!}
										{!! Form::text('surname', old('surname'), ['class' => 'form-control']) !!}
									</div>
								</div>

								<div class="col-md-12 addmargin no-padding">
									<div class="col-md-4">
										{!! Form::label('houseNumber', 'Huisnummer', ['class' => 'control-label']) !!}
										{!! Form::text('houseNumber', old('houseNumber'), ['class' => 'form-control']) !!}
									</div>
									<div class="col-md-3">
										{!! Form::label('suffix', 'Toevoeging', ['class' => 'control-label']) !!}
										{!! Form::text('suffix', old('suffix'), ['class' => 'form-control']) !!}
									</div>
									<div class="col-md-5">
										{!! Form::label('postal', 'Postcode:', ['class' => 'ccontrol-label']) !!}
										{!! Form::text('postal', old('postal'), ['class' => 'form-control']) !!}
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="col-md-4 floatCenter addmargin">
									{!! Recaptcha::render() !!}
								</div>
								</div>
								
							</div>
							<div class="form-group">
								<div class="floatRight">
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