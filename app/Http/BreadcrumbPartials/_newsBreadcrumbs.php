<?php
	// Home > Nieuws 
	Breadcrumbs::register('news.index', function($breadcrumbs) 
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Nieuws', route('news.index'));
	});

	// Home > Beheer > Nieuws > [artikel]
	Breadcrumbs::register('news.show', function($breadcrumbs, $article)
	{
		$breadcrumbs->parent('news.index');
		$breadcrumbs->push($article->title, route('news.show', [$article->id]));
	});

	// Home > Beheer > Nieuws
	Breadcrumbs::register('news.manage', function($breadcrumbs) 
	{
		$breadcrumbs->parent('admin.index');
		$breadcrumbs->push('Nieuws', route('news.manage'));
	});

	// Home > Beheer > Nieuws > Artikel Aanmaken
	Breadcrumbs::register('news.create', function($breadcrumbs)
	{
		$breadcrumbs->parent('news.manage');
		$breadcrumbs->push('Nieuws Aanmaken', route('news.create'));
	});

	// Home > Beheer > Nieuws > Artikel Wijzigen 
	Breadcrumbs::register('news.edit.prefix', function($breadcrumbs)
	{
		$breadcrumbs->parent('news.manage');
		$breadcrumbs->push('Nieuws Wijzigen');
	});

	// Home > Beheer > Nieuws > Artikel Wijzigen > [ Artikel ] 
	Breadcrumbs::register('news.edit', function($breadcrumbs, $article)
	{
		$breadcrumbs->parent('news.edit.prefix');
		$breadcrumbs->push($article->title, route('news.edit', [$article->id]));
	});