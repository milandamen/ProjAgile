<?php

    /**
     * Home > newOnSite index
     */
    Breadcrumbs::register('newOnSiteIndex', function($breadcrumbs)
    {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Nieuw op de site', route('newOnSite.index'));
    });