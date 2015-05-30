<?php
	// Home > Beheer > Menu
	Breadcrumbs::register('postal.index', function($breadcrumbs)
    {
        $breadcrumbs->parent('management.index');
        $breadcrumbs->push('Postcode beheer', route('postal.index'));
    });