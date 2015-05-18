<?php
	// Home > Inloggen 
	Breadcrumbs::register('auth.login', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Inloggen', route('auth.login'));
	});

	// Home > Registreren
	Breadcrumbs::register('auth.register', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Registreren', route('auth.register'));
	});