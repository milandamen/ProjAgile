<?php
	// Home > Beheer > Sidebar Wijzigen
	Breadcrumbs::register('sidebar.edit.prefix', function($breadcrumbs)
	{
		$breadcrumbs->parent('admin.index');
		$breadcrumbs->push('Sidebar Wijzigen');
	});

	// Home > Beheer > Sidebar Wijzigen > [ page ]
	Breadcrumbs::register('sidebar.edit', function($breadcrumbs, $page)
	{
		$breadcrumbs->parent('sidebar.edit.prefix');
		$breadcrumbs->push($page->title, route('sidebar.edit', [$page->id]));
	});