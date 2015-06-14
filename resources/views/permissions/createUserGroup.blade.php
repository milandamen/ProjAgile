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
				<h3 class="text-center">Pagina's</h3>
				<div class="well pages">
					<ul id="check-list-box-page" class="list-group checked-list-box">
						@foreach($pages as $page)
							<li class="list-group-item" id={{$page->pageId}}> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
						@endforeach
					</ul>
				</div>
			</div>

			<div class="col-xs-5 col-xs-offset-2">
				<div class="row">
					<h3 class="text-center">Onderdelen</h3>
					<div class="well permissions">
						<ul id="check-list-box-permission" class="list-group checked-list-box">
							@foreach($permissions as $permission)
								<li class="list-group-item" id={{$permission->permissionId}}> {!! $permission->permissionName !!}</li>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="row">
					<h3 class="text-center">Nieuws per deelwijk</h3>
					<div class="well district-sections">
						<ul id="check-list-box-districtSection" class="list-group checked-list-box">
							@foreach($districtSections as $districtSection)
								<li class="list-group-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
							@endforeach
						</ul>
					</div>
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
								<li class="list-group-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			{!! link_to_route('user.index', 'Terug naar Gebruikersgroepen', [], ['class' => 'btn btn-danger']) !!}
			{!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
			{!! Form::close() !!}
		</div>

	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
	{!! HTML::script('custom/js/permissions.js') !!}
@stop