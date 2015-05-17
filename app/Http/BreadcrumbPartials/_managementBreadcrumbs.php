<?php
	// Home > Beheer
	Breadcrumbs::register('management.index', function($breadcrumbs)
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Beheer', route('management.index'));
	});