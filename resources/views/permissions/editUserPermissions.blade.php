@extends('app')

@section('title')
	De Bunders - Gebruiker Autorisatie Wijzigen
@stop

@section('description')
	Dit is de beveiligde gebruiker autorisatie wijzig pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('user.show', $user) !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Autorisatie Wijzigen - {!!$user->username!!}</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>


		{!! Form::open(['url' => route('permissions.update', $user->userId), 'method' => 'POST']) !!}


		{!! Form::hidden('pageSelection', null, ['id' => 'pageSelection']) !!}

		<span id="selection"></span>

		<div class="row">
			<div class="col-xs-5">
				<h3 class="text-center">Pagina's</h3>
				<div class="well" style="max-height: 300px;overflow: auto;">
					<ul id="check-list-box" class="list-group checked-list-box">
						@foreach($pages as $page)
							<li class="list-group-item"> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
						@endforeach
					</ul>
					<br />
					<button class="btn btn-primary col-xs-12" id="get-checked-data">Get Checked Data</button>
				</div>
				<pre id="display-json"></pre>
			</div>
			<div class="col-lg-5">

			</div>
		</div>

		{!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
		{!! Form::close() !!}

		{!! link_to_route('user.index', 'Terug naar Gebruiker Beheer', [], ['class' => 'btn btn-danger']) !!}
		{{--{!! link_to_route('permissions.update', 'Opslaan', [], ['class' => 'btn btn-success']) !!}--}}
		{!! link_to_route('permissions.update', 'Opslaan', ['id' => $user->userId, 'string' => 'hallo'], ['class' => 'btn btn-success']) !!}
		{{--<a href="{{ route('home.index') }}" class="btn btn-success" id="get-checked-data">Go</a>--}}
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/permissions.js') !!}
@stop