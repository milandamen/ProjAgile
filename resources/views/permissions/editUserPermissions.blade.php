@extends('app')

@section('title')
	De Bunders - {{ $user->username }}
@stop

@section('description')
	Dit is de {{ $user->username }} overzicht pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('user.show', $user) !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Gebruiker Autorisatie Wijzigen</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>

		<div class="row">
			<div class="col-lg-5">
				Pages
				<ul class="nav nav-list">
				@foreach($pages as $page)
					<li>{!! $page->pageId !!}</li>
				@endforeach
				</ul>
			</div>
			<div class="col-lg-5">
				Deelwijken
			</div>
		</div>
		{!! link_to_route('user.index', 'Terug naar Gebruiker Beheer', [], ['class' => 'btn btn-danger']) !!}
	</div>
@stop
