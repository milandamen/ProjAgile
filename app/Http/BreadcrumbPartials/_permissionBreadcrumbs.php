<?php
	// Home > Beheer > Gebruikers > [ Gebruikersnaam ]
	Breadcrumbs::register('permissions.edit', function($breadcrumbs, $user)
	{
		$breadcrumbs->parent('user.index');
		$breadcrumbs->push('Autorisatie - '.$user->username, route('user.show', [$user->id]));
	});