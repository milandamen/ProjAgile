<?php
	// Home > Beheer > Home > Carousel Wijzigen 
	Breadcrumbs::register('carousel.edit', function($breadcrumbs)
	{
		$breadcrumbs->parent('home.prefix');
		$breadcrumbs->push('Carousel Wijzigen', route('carousel.edit'));
	});