<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 addmargin">
			<h3>{{ $title }}</h3>
			<div class="table-wrapper">
				<table class="table">
					<thead>
						<tr>
							<th>Gebruikersnaam</th>
							<th>Voornaam</th>
							<th>Achternaam</th>
							<th>Email</th>
							<th colspan="2">Acties</th>
							@if(Auth::user()->canChangePermissions())
								<th></th>
							@endif
							<th>
								<a href="#" data-toggle="modal" data-target="#myModal">
									<span class="glyphicon glyphicon-question-sign questionIcon" title="Toelichting"></span>
								</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($userTypeCollection as $userType)
							<tr class="normalRow">
								<td>{{ $userType->username }}</td>
								<td>{{ $userType->firstName }}</td>
								<td>{{ $userType->surname }}</td>
								<td>{{ $userType->email }}</td>
								<td>
									<a href="{{ route('user.show', [$userType->userId]) }}">
										<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
									</a>
								</td>
								<td>
									<a href="{{ route('user.edit', [$userType->userId]) }}" class="right">
										<i class="fa fa-pencil-square-o"></i>
									</a>
								</td>
								<td>
									@if($userType->userId != 1)
										@if($userType->active)
											<a href="{{ route('user.toggleActivation', [$userType->userId]) }}" class="text-success activate">
												<i class="fa fa-unlock-alt fa-lg"></i>
											</a>
										@else
											<a href="{{ route('user.toggleActivation', [$userType->userId]) }}" class="black deactivate">
												<i class="fa fa-lock fa-lg"></i>
											</a>
										@endif
									@endif
								</td>
								@if(Auth::user()->canChangePermissions() && $userType->userId != 1)
									<td>
										<a href="{{ route('permissions.edit', [$userType->userId]) }}" class="left black">
											<i class="fa fa-key"></i>
										</a>
									</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

{{-- Modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Toelichting</h4>
			</div>
			<div class="modal-body">
				<div>
					<i class="glyphicon glyphicon-new-window text-primary"></i>
					- Gebruiker Details
				</div>
				<div>
					<i class="fa fa-pencil-square-o"></i>
					- Gebruiker bewerken
				</div>
				<div>
					<i class="fa fa-lock fa-lg"></i>
					- Gebruiker is inactief
				</div>
				<div>
					<i class="fa fa-unlock-alt fa-lg text-success activate"></i>
					- Gebruiker Is Actief
				</div>
				<div>
					<i class="fa fa-key"></i>
					- Gebruiker Autorisatie Bewerken
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
			</div>
		</div>
	</div>
</div>