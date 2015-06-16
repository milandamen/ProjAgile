<div class="col-md-3">
	<h3>Gebruikers</h3>
	<div class="btn-group-vertical">
		{!! link_to_route('user.index', 'Gebruikers Beheer', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('user.create', 'Gebruiker Toevoegen', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('permissions.index', 'Gebruikersgroep Beheer', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('permissions.createUserGroup', 'Gebruikersgroep Toevoegen', [], ['class' => 'btn btn-default']) !!}
	</div>
</div>
