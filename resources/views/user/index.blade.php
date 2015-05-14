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
			@if(isset($criteria))
				{!! Breadcrumbs::render('user.index.filter', (object)['criteria' => $criteria]) !!}
			@else
				{!! $criteria = null; !!}
				{!! Breadcrumbs::render('user.index') !!}
			@endif
		</div>
		<div clss="row">
			@include('errors.partials._list')
		</div>
		@if(isset($count) && $count === 0)
			<div class="row">
				<h3>Sorry! Uw vraag heeft geen zoekresultaten opgeleverd.</h3>
				{!! link_to_route('user.index', 'Terug naar Gebruiker Beheer', [], ['class' => 'btn btn-danger white']) !!}
			</div>
		@else
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-header">
						Gebruiker Beheer
					</h2>
				</div>
			</div>		
			<div class="row">
				<div class="col-md-12">
					{!! Form::open(['url' => route('user.filter'), 'method' => 'POST', 'class' => 'navbar-form navbar-right']) !!}
						<div class="form-group">
							{!! Form::text('search', null, ['id' => 'search', 'class' => 'form-control', 'placeholder' => 'filter', 'autocomplete' => 'off']) !!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{!! link_to_route('user.create', 'Nieuwe Gebruiker', [], ['class' => 'btn btn-success white']) !!}
					{!! link_to_route('management.index', 'Terug naar Beheer', [], ['class' => 'btn btn-danger white']) !!}
				</div>
			</div>
			@include('user.partials._userGroup', ['title' => 'Administrators', 'userTypeCollection' => $admins])
			@include('user.partials._userGroup', ['title' => 'Contentbeheerders', 'userTypeCollection' => $contentmanagers])
			@include('user.partials._userGroup', ['title' => 'Bewoners', 'userTypeCollection' => $residents])
		@endif
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/filterUserTables.js') !!}
@stop