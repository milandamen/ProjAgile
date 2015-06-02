<?php
	// Home > Inloggen 
	Breadcrumbs::register('auth.login', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Inloggen', route('auth.login'));
	});