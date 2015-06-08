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
					</thead>
					<tbody>
						@foreach($userGroups as $userGroup)
							<tr>
								<td>{{ $userGroup->name }}</td>
								<td>
									<a href="{{ route('permissions.index') }}" class="left">
										<i class="fa fa-pencil-square-o"></i>
									</a>
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

