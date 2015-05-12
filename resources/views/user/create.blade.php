@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('user.create') !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Gebruiker Aanmaken</h1>
			</div>
		</div>
		<div class="col-lg-12">
			@include('errors.partials._list')
			{!! Form::model($user, ['url' => route('user.store'), 'method' => 'POST']) !!}
				<div class="col-lg-5">
					<div class="form-group">
						{!! Form::label('username', 'Gebruikersnaam') !!}
						{!! Form::text('username', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('firstName', 'Voornaam') !!}
						{!! Form::text('firstName', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('surname', 'Achternaam') !!}
						{!! Form::text('surname', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('email', 'E-mail') !!}
						{!! Form::email('email', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="col-lg-5 col-lg-offset-1">
					<div class="form-group">
						{!! Form::label('password', 'Wachtwoord') !!}
						{!! Form::password('password', ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('password_confirmation', 'Herhaal Wachtwoord') !!}
						{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('postal', 'Postcode') !!}
						{!! Form::text('postal', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('houseNumber', 'Huisnummer') !!}
						{!! Form::text('houseNumber', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						{!! Form::label('userGroupId', 'Gebruikersgroep') !!}
						{!! Form::select('userGroupId', $userGroups, $user->userGroupId, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<a href="{{route('user.index')}}" class="btn btn-danger">Annuleer</a>
						{!! Form::submit('Gebruiker Aanmaken', ['class' => 'btn btn-success']) !!}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop