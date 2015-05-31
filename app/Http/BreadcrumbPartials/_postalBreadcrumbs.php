<?php
    // Home > Beheer > Postcodes Beheren
    Breadcrumbs::register('postal.edit', function($breadcrumbs)
    {
        $breadcrumbs->parent('management.index');
        $breadcrumbs->push('Postcodes Beheren', route('postal.index'));
    });