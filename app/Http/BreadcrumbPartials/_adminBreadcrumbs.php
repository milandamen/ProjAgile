<?php
	// Home > Beheer
	Breadcrumbs::register('admin.index', function($breadcrumbs)
	{
		$breadcrumbs->parent('home.index');
		$breadcrumbs->push('Beheer', route('admin.index'));
	});