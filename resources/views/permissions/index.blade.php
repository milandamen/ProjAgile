@extends('app')

@section('title')
	De Bunders - Gebruikersgroep beheer
@stop

@section('description')
	Dit is de beveiligde gebruikersgroep beheer pagina van De Bunders.
@stop

@section('content')
	<meta name="csrf-token" content="{{ Session::token() }}">
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('permissions.index') !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">
					Gebruikersgroep Beheer
				</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-md-12">
				{!! link_to_route('permissions.createUserGroup', 'Nieuwe Gebruikersgroep', [], ['class' => 'btn btn-success white']) !!}
				{!! link_to_route('management.index', 'Terug naar Beheer', [], ['class' => 'btn btn-danger white']) !!}
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<th>Groepsnaam</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($userGroups as $userGroup)
							<tr>
								<td>{{ $userGroup->name }}</td>
								<td>
                                    @if($userGroup->userGroupId != 1 && $userGroup->userGroupId != 3)
                                        <a href="{{ route('permissions.editUserGroup', ['userGroupId' => $userGroup->userGroupId]) }}" class="left">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a href="{{ route('permissions.deleteUserGroup', ['userGroupId' => $userGroup->userGroupId]) }}">
                                            <i class="fa fa-times fa-lg text-danger"></i>
                                        </a>
                                    @endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop

