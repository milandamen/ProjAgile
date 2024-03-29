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
			{!! Breadcrumbs::render('permissions.edit', $user) !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Autorisatie Wijzigen - {!!$user->username!!}</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>

		{!! Form::open(['url' => route('permissions.update', $user->userId), 'method' => 'POST', 'class' => 'userPermissionsForm']) !!}
			{!! Form::hidden('pageSelection', null, ['id' => 'pageSelection']) !!}
			{!! Form::hidden('districtSectionSelection', null, ['id' => 'districtSectionSelection']) !!}
			{!! Form::hidden('permissionSelection', null, ['id' => 'permissionSelection']) !!}

			{!! Form::hidden('pageViewSelection', null, ['id' => 'pageViewSelection']) !!}
			{!! Form::hidden('districtSectionViewSelection', null, ['id' => 'districtSectionViewSelection']) !!}

			<div class="row">
				<div class="col-xs-5">
					<h3 class="text-center">Pagina's (wijzigen)</h3>
					<div class="well pages">
						<ul id="check-list-box-page" class="list-group checked-list-box">
							@foreach($pages as $page)
								@if($user->hasPagePermission($page->pageId))
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
						<h3 class="text-center">Onderdelen (wijzigen)</h3>
						<div class="well permissions">
							<ul id="check-list-box-permission" class="list-group checked-list-box">
								@foreach($permissions as $permission)
									@if($user->hasPermission($permission->permissionId))
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
						<h3 class="text-center">Nieuws per deelwijk (wijzigen)</h3>
						<div class="well district-sections">
							<ul id="check-list-box-districtSection" class="list-group checked-list-box">
								@foreach($districtSections as $districtSection)
									@if($user->hasDistrictSectionPermission($districtSection->districtSectionId))
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
				<div class="col-lg-12">
					<h3 class="page-header">Autorisatie Wijzigen - pagina's inzien</h3>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-5">
					<h3 class="text-center">Pagina's (inzien)</h3>
					<div class="well pages">
						<ul id="check-list-box-pageView" class="list-group checked-list-box">
							@foreach($pages as $page)
								@if($user->hasPageViewPermission($page->pageId))
									<li class="list-group-item checked pageView-item" id={{$page->pageId}}> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
								@else
									<li class="list-group-item pageView-item" id={{$page->pageId}}> {!! $page->pageId !!} - {!! $page->introduction->title !!}</li>
								@endif
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
								@if($user->hasDistrictSectionViewPermission($districtSection->districtSectionId))
									<li class="list-group-item checked districtSectionView-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
								@else
									<li class="list-group-item districtSectionView-item" id={{$districtSection->districtSectionId}}> {!! $districtSection->districtSectionId !!} - {!! $districtSection->name !!}</li>
								@endif
							@endforeach
						</ul>
					</div>
					<div class="form-group">
						<button class="btn btn-warning add-margin all-districtSections-view">Alle deelwijken</button>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
				{!! link_to_route('user.index', 'Terug naar Gebruiker Beheer', [], ['class' => 'btn btn-danger']) !!}
				{!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
				{!! Form::close() !!}
				</div>
			</div>

	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/permissions.js') !!}
@stop