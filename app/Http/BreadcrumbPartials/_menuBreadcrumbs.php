<?php
	// Home > Beheer > Menu
	Breadcrumbs::register('menu.index', function($breadcrumbs)
	{
		$breadcrumbs->parent('management.index');
		$breadcrumbs->push('Menu', route('menu.index'));
	});

	// Home > Beheer > Menu > Menu Item Aanmaken
	Breadcrumbs::register('menu.create', function($breadcrumbs)
	{
		$breadcrumbs->parent('menu.index');
		$breadcrumbs->push('Menu Item Aanmaken', route('menu.create'));
	});

	// Home > Beheer > Menu > Menu Item Wijzigen
	Breadcrumbs::register('menu.edit', function($breadcrumbs)
	{
		$breadcrumbs->parent('menu.index');
		$breadcrumbs->push('Menu Item Wijzigen', route('menu.edit'));
	});