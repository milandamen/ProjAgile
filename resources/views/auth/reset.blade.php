@extends('app')

@section('title')
	De Bunders - Wachtwoord Reset Aanvragen
@stop

@section('description')
	Dit is de wachtwoord reset pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
		{!! Breadcrumbs::render('password.reset') !!}
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 class="page-header">Wachtwoord Resetten</h2>
				<div class="row">
					@include('flash::message')
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						@include('errors.partials._list')
						{!! Form::open(['method' => 'POST', 'route' => 'password.update']) !!}
							{!! Form::hidden('token', $token) !!}
							<div class="col-md-12 no-padding">
								<div class="col-md-4">	
									{!! Form::label('email', 'E-mailadres:', ['class' => ' control-label']) !!}
									{!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-12 no-padding">
								<div class="col-md-4">	
									{!! Form::label('password', 'Wachtwoord:', ['class' => ' control-label']) !!}
									{!! Form::password('password', ['class' => 'form-control']) !!}
								</div>
								<div class="col-md-4">	
									{!! Form::label('password_confirmation', 'Herhaal Wachtwoord:', ['class' => ' control-label']) !!}
									{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-12 no-padding">
								<div class="col-md-12">
									{!! Form::submit('Nieuw Wachtwoord Bevestigen', ['class' => 'btn btn-primary']) !!}
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