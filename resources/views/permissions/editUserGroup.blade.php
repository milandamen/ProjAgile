@extends('app')

@section('title')
	De Bunders - Gebruikersgroep wijzigen
@stop

@section('description')
	Dit is de beveiligde gebruikersgroep wijzig pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Gebruikersgroep wijzigen - {{$userGroup->name}}</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>

		{!! Form::open(['url' => route('permissions.updateUserGroup', $userGroup->userGroupId), 'method' => 'POST', 'class' => 'userPermissionsForm']) !!}
		{!! Form::hidden('userGroupId', $userGroup->userGroupId) !!}
		{!! Form::hidden('pageSelection', null, ['id' => 'pageSelection']) !!}
		{!! Form::hidden('districtSectionSelection', null, ['id' => 'districtSectionSelection']) !!}
		{!! Form::hidden('permissionSelection', null, ['id' => 'permissionSelection']) !!}
		{!! Form::hidden('districtSectionUserSelection', null, ['id' => 'districtSectionUserSelection']) !!}
		{!! Form::hidden('selectedDistrictSections', json_encode($selectedDistrictSections)) !!}

		@include('errors.partials._list')

		<div class="row">
			<div class="col-lg-5">
				<div class="form-group">
					{!! Form::label('name', 'Groepsnaam') !!}
					{!! Form::text('name', $userGroup->name, ['class' => 'form-control']) !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-5">
				<h3 class="text-center">Pagina's</h3>
				<div class="well pages">
					<ul id="check-list-box-page" class="list-group checked-list-box">
						@foreach($pages as $page)
							@if($userGroup->hasPagePermission($page->pageId))
								<li class="list-group-item checked page-item" id={{$page->pageId}}> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
							@else
								<li class="list-group-item page-item" id={{$page->pageId}}> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
							@endif
						@endforeach
					</ul>
				</div>
				<button class="btn btn-warning all-pages">Alle pagina's</button>
			</div>

			<div class="col-xs-5 col-xs-offset-2">
				<div class="row">
					<h3 class="text-center">Onderdelen</h3>
					<div class="well permissions">
						<ul id="check-list-box-permission" class="list-group checked-list-box">
							@foreach($permissions as $permission)
								@if($userGroup->hasPermission($permission->permissionId))
									<li class="list-group-item checked permission-item" id={{$permission->permissionId}}> {!! $permission->permissionName !!}</li>
								@else
									<li class="list-group-item permission-item" id={{$permission->permissionId}}> {!! $permission->permissionName !!}</li>
								@endif
							@endforeach
						</ul>
					</div>
					<button class="btn btn-warning all-permissions">Alle onderdelen</button>
				</div>

				<div class="row">
					<h3 class="text-center">Nieuws per deelwijk</h3>
					<div class="well district-sections">
						<ul id="check-list-box-districtSection" class="list-group checked-list-box">
							@foreach($districtSections as $districtSection)
								@if($userGroup->hasDistrictSectionPermission($districtSection->districtSectionId))
									<li class="list-group-item checked districtSection-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
								@else
									<li class="list-group-item districtSection-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
								@endif
							@endforeach
						</ul>
					</div>
					<button class="btn btn-warning all-districtSections">Alle deelwijken</button>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">Gebruikers Wijzigen</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-5">
				<div class="row">
					<h3 class="text-center">Gebruikers per deelwijk</h3>
					<div class="well district-sections">
						<ul id="check-list-box-districtSectionUsers" class="list-group checked-list-box">
							@foreach($districtSections as $districtSection)
								@if (!empty($selectedDistrictSections) && in_array($districtSection->districtSectionId, $selectedDistrictSections))
									<li class="list-group-item checked districtSectionUser-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
								@else
									<li class="list-group-item districtSectionUser-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
								@endif
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