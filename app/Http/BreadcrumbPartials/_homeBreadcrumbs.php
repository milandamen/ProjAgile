<?php
	// Home
	Breadcrumbs::register('home.index', function($breadcrumbs) 
	{
		$breadcrumbs->push('Home', route('home.index'));
	});

	// Home > Beheer > Home
	Breadcrumbs::register('home.prefix', function($breadcrumbs)
	{
		$breadcrumbs->parent('admin.index');
		$breadcrumbs->push('Home');
	});

	// Home > Beheer > Home > Introductie Wijzigen
	Breadcrumbs::register('home.editIntroduction', function($breadcrumbs)
	{
		$breadcrumbs->parent('home.prefix');
		$breadcrumbs->push('Introductie Wijzigen', route('home.editIntroduction'));
	});

	// Home > Beheer > Home > Home Layout Wijzigen
	Breadcrumbs::register('home.editLayout', function($breadcrumbs)
	{
		$breadcrumbs->parent('home.prefix');
		$breadcrumbs->push('Home Layout Wijzigen', route('home.editLayout'));
	});