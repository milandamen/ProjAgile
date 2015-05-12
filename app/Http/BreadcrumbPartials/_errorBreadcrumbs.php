<?php
	// Home > Foutmelding [ error ]
	Breadcrumbs::register('error', function($breadcrumbs, $error) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Foutmelding ' . $error);
	});