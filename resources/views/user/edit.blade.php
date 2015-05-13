@extends('app')

@section('title')
	De Bunders - Gebruiker Wijzigen
@stop

@section('description')
	Dit is de beveiligde gebruiker wijzig pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('user.edit', (object)['id' => $user->userId, 'username' => $user->username]) !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Gebruiker Wijzigen</h1>
			</div>
		</div>
		<div class="col-lg-12">
			@include('errors.partials._list')
			{!! Form::model($user, ['url' => route('user.update', [$user->userId]), 'method' => 'PATCH']) !!}
				{!! Form::hidden('userId', $user->userId) !!}
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
						{!! HTML::decode(Form::label('password', 'Wachtwoord <small><t>*alleen invullen als u het wachtwoord wilt wijzigen</small>')) !!}
						{!! Form::password('password', ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('password_confirmation', 'Herhaal Wachtwoord') !!}
						{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('postal', 'Postcode') !!}
						{!! Form::text('postal', $postal, ['class' => 'form-control']) !!}
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
						<a href="{{ route('user.index') }}" class="btn btn-danger">Annuleren</a>
						{!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop