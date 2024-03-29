@extends('app')

@section('title')
	De Bunders - Gebruikersgroep aanmaken
@stop

@section('description')
	Dit is de beveiligde gebruikersgroep aanmaak pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('permissions.createUserGroup') !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Gebruikersgroep aanmaken</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>

		{!! Form::open(['url' => route('permissions.storeUserGroup'), 'method' => 'POST', 'class' => 'userPermissionsForm']) !!}
		{!! Form::hidden('pageSelection', null, ['id' => 'pageSelection']) !!}
		{!! Form::hidden('districtSectionSelection', null, ['id' => 'districtSectionSelection']) !!}
		{!! Form::hidden('permissionSelection', null, ['id' => 'permissionSelection']) !!}
		{!! Form::hidden('districtSectionUserSelection', null, ['id' => 'districtSectionUserSelection']) !!}

		{!! Form::hidden('pageViewSelection', null, ['id' => 'pageViewSelection']) !!}
		{!! Form::hidden('districtSectionViewSelection', null, ['id' => 'districtSectionViewSelection']) !!}

		@include('errors.partials._list')
		<div class="row">
			<div class="col-lg-5">
				<div class="form-group">
					{!! Form::label('name', 'Groepsnaam') !!}
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">Permissies</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-5">
				<h3 class="text-center">Pagina's (wijzigen)</h3>
				<div class="well pages">
					<ul id="check-list-box-page" class="list-group checked-list-box">
						@foreach($pages as $page)
							<li class="list-group-item page-item" id={{$page->pageId}}> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
						@endforeach
					</ul>
				</div>
				<button class="btn btn-warning all-pages">Alle pagina's</button>
			</div>

			<div class="col-xs-5 col-xs-offset-2">
				<div class="row">
					<h3 class="text-center">Onderdelen (wijzigen)</h3>
					<div class="well permissions">
						<ul id="check-list-box-permission" class="list-group checked-list-box">
							@foreach($permissions as $permission)
								<li class="list-group-item permission-item" id={{$permission->permissionId}}> {!! $permission->permissionName !!}</li>
							@endforeach
						</ul>
					</div>
					<button class="btn btn-warning all-permissions">Alle onderdelen</button>
				</div>

				<div class="row">
					<h3 class="text-center">Nieuws per deelwijk (wijzigen)</h3>
					<div class="well district-sections">
						<ul id="check-list-box-districtSection" class="list-group checked-list-box">
							@foreach($districtSections as $districtSection)
								<li class="list-group-item districtSection-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
							@endforeach
						</ul>
					</div>
					<button class="btn btn-warning all-districtSections">Alle deelwijken</button>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Gebruikersgroep Wijzigen - pagina's inzien</h3>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-5">
				<h3 class="text-center">Pagina's (inzien)</h3>
				<div class="well pages">
					<ul id="check-list-box-pageView" class="list-group checked-list-box">
						@foreach($pages as $page)
							<li class="list-group-item pageView-item" id={{$page->pageId}}> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
						@endforeach
					</ul>
				</div>
				<button class="btn btn-warning all-pages-view">Alle pagina's</button>
			</div>

			<div class="col-xs-5 col-xs-offset-2">
				<h3 class="text-center">Nieuws per deelwijk (inzien)</h3>
				<div class="well district-sections">
					<ul id="check-list-box-districtSectionView" class="list-group checked-list-box">
						@foreach($districtSections as $districtSection)
							<li class="list-group-item districtSectionView-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
						@endforeach
					</ul>
				</div>
				<div class="form-group">
					<button class="btn btn-warning add-margin all-districtSections-view">Alle deelwijken</button>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
					<h2 class="page-header">Gebruikers toevoegen</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-5">
				<div class="row">
					<h3 class="text-center">Gebruikers per deelwijk</h3>
					<div class="well district-sections">
						<ul id="check-list-box-districtSectionUsers" class="list-group checked-list-box">
							@foreach($districtSections as $districtSection)
								<li class="list-group-item districtSectionUser-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
							@endforeach
						</ul>
					</div>
					<div class="form-group">
						<button class="btn btn-warning add-margin all-districtSectionUsers">Alle gebruikers</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			{!! link_to_route('permissions.index', 'Terug naar Gebruikersgroepen', [], ['class' => 'btn btn-danger']) !!}
			{!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
			{!! Form::close() !!}
		</div>

	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
	{!! HTML::script('custom/js/permissions.js') !!}
@stop