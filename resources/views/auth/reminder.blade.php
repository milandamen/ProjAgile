@extends('app')

@section('title')
	De Bunders - Wachtwoord Vergeten
@stop

@section('description')
	Dit is de wachtwoord vergeten pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
		{!! Breadcrumbs::render('password.reminder') !!}
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 class="page-header">Wachtwoord Vergeten</h2>
				<div class="row">
					@include('flash::message')
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						@include('errors.partials._list')
						{!! Form::open(['method' => 'POST', 'route' => 'password.request']) !!}
							<div class="col-md-12 no-padding">
								<div class="col-md-4">	
									{!! Form::label('email', 'E-mailadres:', ['class' => ' control-label']) !!}
									{!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-12 no-padding">
								<div class="col-md-12">
									{!! Form::submit('Wachtwoord Reset Aanvragen', ['class' => 'btn btn-primary']) !!}
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