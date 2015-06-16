<?php
	// Home > Wachtwoord Vergeten
	Breadcrumbs::register('password.reminder', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Wachtwoord Vergeten', route('password.reminder'));
	});

	// Home > Wachtwoord Resetten
	Breadcrumbs::register('password.reset', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Wachtwoord Resetten', route('password.reset'));
	});