<?php
	// Home > Nieuw op de Website
	Breadcrumbs::register('newOnSite.index', function($breadcrumbs)
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Nieuw op de Website', route('newOnSite.index'));
	});