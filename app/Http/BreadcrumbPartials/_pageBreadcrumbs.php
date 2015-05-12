<?php
	// Home > Beheer > Pagina's 
	Breadcrumbs::register('page.index', function($breadcrumbs)
	{
		$breadcrumbs->parent('admin.index');
		$breadcrumbs->push('Pagina\'s', route('page.index'));
	});

	// Home > [ PageTitle ]
	Breadcrumbs::register('page.show', function($breadcrumbs, $page)
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push($page->title, route('page.show', [$page->id]));
	});

	// Home > Beheer > Pagina's > Pagina Aanmaken
	Breadcrumbs::register('page.create', function($breadcrumbs)
	{
		$breadcrumbs->parent('page.index');
		$breadcrumbs->push('Pagina Aanmaken', route('page.create'));
	});

	// Home > Beheer > Pagina's > Pagina Wijzigen
	Breadcrumbs::register('page.edit.prefix', function($breadcrumbs)
	{
		$breadcrumbs->parent('page.index');
		$breadcrumbs->push('Pagina wijzigen');
	});

	// Home > Beheer > Pagina's > Pagina Wijzigen > [ PageTitle ]
	Breadcrumbs::register('page.edit', function($breadcrumbs, $page)
	{
		$breadcrumbs->parent('page.edit.prefix');
		$breadcrumbs->push($page->title, route('page.edit', [$page->id]));
	});