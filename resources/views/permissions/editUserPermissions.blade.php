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
		{!! Form::hidden('districtSectionSelection', null, ['id' => 'districtSectionSelection']) !!}
		{!! Form::hidden('otherSelection', null, ['id' => 'otherSelection']) !!}

		<div class="row">
			<div class="col-xs-5 col-xs-offset-7">
				<h3 class="text-center">Onderdelen</h3>
				<div class="well" style="max-height: 300px;overflow: auto;">
					<ul id="check-list-box-other" class="list-group checked-list-box">
						<li class="list-group-item"> Homepage</li>
						<li class="list-group-item"> Menu</li>
						<li class="list-group-item"> Carousel</li>
						<li class="list-group-item"> Footer</li>
					</ul>
					<br />
					<button class="btn btn-primary col-xs-12" id="get-checked-data">Get Checked Data</button>
				</div>
				<pre id="display-json-other"></pre>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-5">
				<h3 class="text-center">Pagina's</h3>
				<div class="well" style="max-height: 300px;overflow: auto;">
					<ul id="check-list-box-page" class="list-group checked-list-box">
						@foreach($pages as $page)
							<li class="list-group-item" id={{$page->pageId}}> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
						@endforeach
					</ul>
					<br />
					<button class="btn btn-primary col-xs-12" id="get-checked-data-page">Get Checked Data</button>
				</div>
				<pre id="display-json-page"></pre>
			</div>

			<div class="col-xs-5 col-xs-offset-2">
				<h3 class="text-center">Nieuws per deelwijk</h3>
				<div class="well" style="max-height: 300px;overflow: auto;">
					<ul id="check-list-box-districtSection" class="list-group checked-list-box">
						@foreach($districtSections as $districtSection)
							<li class="list-group-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
						@endforeach
					</ul>
					<br />
					<button class="btn btn-primary col-xs-12" id="get-checked-data">Get Checked Data</button>
				</div>
				<pre id="display-json-districtSection"></pre>
			</div>
		</div>

		{!! link_to_route('user.index', 'Terug naar Gebruiker Beheer', [], ['class' => 'btn btn-danger']) !!}
		{!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
		{!! Form::close() !!}

	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/permissions.js') !!}
@stop