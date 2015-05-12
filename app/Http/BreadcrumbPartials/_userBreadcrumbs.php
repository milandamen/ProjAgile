<?php
	// Home > Beheer > Gebruikers
	Breadcrumbs::register('user.index', function($breadcrumbs)
	{
		$breadcrumbs->parent('admin.index');
		$breadcrumbs->push('Gebruikers', route('user.index'));
	});

	// Home > Beheer > Gebruikers > [ Gebruikersnaam ]
	Breadcrumbs::register('user.show', function($breadcrumbs, $user)
	{
		$breadcrumbs->parent('user.index');
		$breadcrumbs->push($user->username, route('user.show', [$user->id]));
	});

	// Home > Beheer > Gebruikers > Filter
	Breadcrumbs::register('user.index.filter', function($breadcrumbs, $criteria)
	{
		$breadcrumbs->parent('user.index');
		$breadcrumbs->push($criteria->criteria, route('user.index', [$criteria->criteria]));
	});

	// Home > Beheer > Gebruikers > Gebruiker Aanmaken
	Breadcrumbs::register('user.create', function($breadcrumbs)
	{
		$breadcrumbs->parent('user.index');
		$breadcrumbs->push('Gebruiker Aanmaken', route('user.create'));
	});

	// Home > Beheer > Gebruikers > Wijzigen
	Breadcrumbs::register('user.edit.prefix', function($breadcrumbs)
	{
		$breadcrumbs->parent('user.index');
		$breadcrumbs->push('Gebruiker Wijzigen');
	});

	// Home > Beheer > Gebruikers > Wijzigen > [ Gebruikersnaam ]
	Breadcrumbs::register('user.edit', function($breadcrumbs, $user)
	{
		$breadcrumbs->parent('user.index');
		$breadcrumbs->push($user->username, route('user.edit', [$user->id]));
	});