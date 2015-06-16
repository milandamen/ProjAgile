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
			<div class="col-lg-1 addmargin">
				<h1>{{ $user->username }}</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-5">
				<table class="table credentials-table">
					@include('user.partials._profile')
					<tr>
						<td class="table-left">Gebruikersgroep:</td>
						<td>
							@if(isset($user->userGroupId))
								{{ $user->userGroup->name }}
							@endif
						</td>
					</tr>
					<tr>
						<td class="table-left">Actief:</td>
						<td>
							@if($user->active)
								Ja
							@else
								Nee
							@endif
						</td>
					</tr>
				</table>
			</div>
		</div>
		{!! link_to_route('user.index', 'Terug naar Gebruiker Beheer', [], ['class' => 'btn btn-danger']) !!}
	</div>
@stop