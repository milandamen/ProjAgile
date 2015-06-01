<?php
	// Home > Beheer > Gebruikers > Autorisatie - [ Gebruikersnaam ]
	Breadcrumbs::register('permissions.edit', function($breadcrumbs, $user)
	{
		$breadcrumbs->parent('user.index');
		$breadcrumbs->push('Autorisatie - '.$user->username, route('permissions.edit', [$user->id]));
	});