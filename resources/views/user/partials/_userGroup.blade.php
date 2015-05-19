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
							<th colspan="3">Acties</th>
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
									@if($userType->active)
										<a href="{{ route('user.deactivate', [$userType->userId]) }}" class="black deactivate">
											<i class="fa fa-lock fa-lg"></i>
										</a>
									@elseif(!$userType->active)
										<a href="{{ route('user.activate', [$userType->userId]) }}" class="text-success activate">
											<i class="fa fa-unlock-alt fa-lg"></i>
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
</div>