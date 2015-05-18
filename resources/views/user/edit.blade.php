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
		<div class="row">
			@include('flash::message')
		</div>
		<div class="col-lg-12">
			@include('errors.partials._list')
			{!! Form::model($user, ['route' => ['user.update', $user->userId], 'method' => 'PATCH']) !!}
				{!! Form::hidden('userId', $user->userId) !!}
				@include('user.partials._createEdit', ['editMode' => true])
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop