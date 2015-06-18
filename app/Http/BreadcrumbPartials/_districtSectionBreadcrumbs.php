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

	// Home > Deelwijk > [Naam] > Wijzigen
	Breadcrumbs::register('district.edit', function($breadcrumbs, $district) 
	{
		$breadcrumbs->parent('district.index');
		$breadcrumbs->push($district->name . ' wijzigen', route('district.edit', [$district->id]));
	});

	// Home > Deelwijk > Deelwijk Aanmaken
	Breadcrumbs::register('district.create', function($breadcrumbs) 
	{
		$breadcrumbs->parent('district.index');
		$breadcrumbs->push('Deelwijk Aanmaken', route('district.create'));
	});