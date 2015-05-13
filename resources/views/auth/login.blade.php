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
					<div class="panel-body">
						@include('errors.partials._list')
						{!! Form::open(['method' => 'POST','route' => 'auth.login']) !!}
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
								<div class="col-md-6 col-md-offset-4">
									<label>
										<input type="checkbox" name="remember"></input> Onthoud mij
									</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									{!! HTML::linkRoute('menu.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
									{!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
									{!! link_to_route('auth.register', 'Nog geen account?', [], array('class' => 'btn btn-info')) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop