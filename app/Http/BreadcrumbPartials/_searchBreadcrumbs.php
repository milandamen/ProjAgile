<?php
	// Home > Zoeken 
	Breadcrumbs::register('search.prefix', function($breadcrumbs)
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Zoeken');
	});

	// Home > Zoeken > [ Query ]
	Breadcrumbs::register('search.index', function($breadcrumbs, $query)
	{
		$breadcrumbs->parent('search.prefix');
		$breadcrumbs->push($query);
	});