<?php
	// Home > Deelwijk
	Breadcrumbs::register('district.index', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Deelwijk', route('district.index'));
	});

	// Home > Deelwijk > [Name]
	Breadcrumbs::register('district.edit', function($breadcrumbs, $district) 
	{
		$breadcrumbs->parent('district.index');
		$breadcrumbs->push($district->name, route('district.edit', [$district->id]));
	});

	// Home > Deelwijk > Deelwijk Aanmaken
	Breadcrumbs::register('district.create', function($breadcrumbs) 
	{
		$breadcrumbs->parent('district.index');
		$breadcrumbs->push('Deelwijk Aanmaken', route('district.create'));
	});