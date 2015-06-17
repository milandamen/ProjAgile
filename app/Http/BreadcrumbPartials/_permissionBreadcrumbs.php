<?php
	// Home > Beheer > Gebruikers > Autorisatie - [ Gebruikersnaam ]
	Breadcrumbs::register('permissions.edit', function($breadcrumbs, $user)
	{
		$breadcrumbs->parent('user.index');
		$breadcrumbs->push('Autorisatie - '.$user->username, route('permissions.edit', [$user->id]));
	});

	// Home > Beheer > Gebruikersgroepen
	Breadcrumbs::register('permissions.index', function($breadcrumbs)
	{
		$breadcrumbs->parent('management.index');
		$breadcrumbs->push('Gebruikersgroepen', route('permissions.index'));
	});

	// Home > Beheer > Gebruikersgroepen > Gebruikersgroep Aanmaken
	Breadcrumbs::register('permissions.createUserGroup', function($breadcrumbs)
	{
		$breadcrumbs->parent('permissions.index');
		$breadcrumbs->push('Gebruikersgroep Aanmaken', route('permissions.createUserGroup'));
	});

	// Home > Beheer > Gebruikersgroepen > Gebruikersgroep Wijzigen
	Breadcrumbs::register('permissions.editUserGroup.prefix', function($breadcrumbs)
	{
		$breadcrumbs->parent('permissions.index');
		$breadcrumbs->push('Gebruikersgroep Wijzigen');
	});

	// Home > Beheer > Gebruikersgroepen > Gebruikersgroep Wijzigen > [ Gebruikersgroep ]
	Breadcrumbs::register('permissions.editUserGroup', function($breadcrumbs, $userGroup)
	{
		$breadcrumbs->parent('permissions.editUserGroup.prefix');
		$breadcrumbs->push($userGroup->name, route('permissions.editUserGroup', [$userGroup->id]));
	});