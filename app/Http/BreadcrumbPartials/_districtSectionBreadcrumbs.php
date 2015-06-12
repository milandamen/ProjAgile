<?php
	// Home > Deelwijk
	Breadcrumbs::register('district.index', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Deelwijken', route('district.index'));
	});

	// Home > Deelwijk > [Name]
	Breadcrumbs::register('district.show', function($breadcrumbs, $district) 
	{
		$breadcrumbs->parent('district.index');
		$breadcrumbs->push($district->name, route('district.show', [$district->name]));
	});