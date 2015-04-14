<?php
    // Home > Error
    Breadcrumbs::register('error', function($breadcrumbs) 
    {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Error', route('home.index'));
    });