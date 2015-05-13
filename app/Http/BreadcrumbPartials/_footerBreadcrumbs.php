<?php
	// Home > Beheer > Footer
	Breadcrumbs::register('footer.prefix', function($breadcrumbs)
	{
		$breadcrumbs->parent('management.index');
		$breadcrumbs->push('Footer');
	});

	// Home > Beheer > Footer > Footer Wijzigen
	Breadcrumbs::register('footer.edit', function($breadcrumbs)
	{
		$breadcrumbs->parent('footer.prefix');
		$breadcrumbs->push('Footer Wijzigen', route('footer.edit'));
	});