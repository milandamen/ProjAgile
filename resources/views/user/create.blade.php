@extends('app')

@section('title')
	De Bunders - Gebruiker Aanmaken
@stop

@section('description')
	Dit is de beveiligde gebruiker aanmaak pagina van De Bunders.
@stop

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
		<div class="row">
			@include('flash::message')
		</div>
		<div class="col-lg-12">
			@include('errors.partials._list')
			{!! Form::model($user, ['route' => 'user.store', 'method' => 'POST']) !!}
				@include('user.partials._createEdit')
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop