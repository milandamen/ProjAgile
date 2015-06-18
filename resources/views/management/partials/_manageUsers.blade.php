<div class="col-md-3">
	<h3>Gebruikers</h3>
	<div class="btn-group-vertical">
		{!! link_to_route('user.index', 'Beheer', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('user.create', 'Toevoegen', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('permissions.index', 'Groep Beheer', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('permissions.createUserGroup', 'Groep Toevoegen', [], ['class' => 'btn btn-default']) !!}
	</div>
</div>
