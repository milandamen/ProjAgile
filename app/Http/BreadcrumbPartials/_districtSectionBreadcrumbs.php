<?php
	// Home > Deelwijk
	Breadcrumbs::register('district.index', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Deelwijken', route('district.index'));
	});

		// Home > Deelwijk > [Naam]
	Breadcrumbs::register('district.show', function($breadcrumbs, $district) 
	{
		$breadcrumbs->parent('district.index');
		$breadcrumbs->push($district->name, route('district.show', [$district->name]));
	});


	// Home > Deelwijk > [Naam]
	Breadcrumbs::register('district.edit', function($breadcrumbs, $district) 
	{
		$breadcrumbs->parent('district.index');
		$breadcrumbs->push($district->name, route('district.edit', [$district->districtSectionId]));
	});