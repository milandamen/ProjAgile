@extends('app')

@section('title')
	De Bunders - Gebruiker Beheer
@stop

@section('description')
	Dit is de beveiligde gebruiker beheer pagina van De Bunders.
@stop

@section('content')
	<meta name="csrf-token" content="{{ Session::token() }}">
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('user.index') !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">
					Gebruiker Beheer
				</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-9">
				<div class="form-group">
					{!! Form::text('search', old('search'), ['id' => 'search', 'class' => 'form-control', 'placeholder' => 'filter', 'autocomplete' => 'off']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				{!! link_to_route('user.create', 'Nieuwe Gebruiker', [], ['class' => 'btn btn-success white']) !!}
				{!! link_to_route('management.index', 'Terug naar Beheer', [], ['class' => 'btn btn-danger white']) !!}
				<a href="#">Link</a>
			</div>
		</div>
		@include('user.partials._userGroup', ['title' => 'Administrators', 'userTypeCollection' => $admins])
		@include('user.partials._userGroup', ['title' => 'Contentbeheerders', 'userTypeCollection' => $contentmanagers])
		@include('user.partials._userGroup', ['title' => 'Bewoners', 'userTypeCollection' => $residents])
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/filterUserTables.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop

