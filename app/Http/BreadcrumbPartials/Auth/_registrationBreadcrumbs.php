<?php
	// Home > Registreren
	Breadcrumbs::register('registration.register', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Registreren', route('registration.register'));
	});