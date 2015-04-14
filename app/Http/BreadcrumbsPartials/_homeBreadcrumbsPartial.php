<?php
    // Home
    Breadcrumbs::register('home', function($breadcrumbs) 
    {
        $breadcrumbs->push('Home', route('home.index'));
    });

    // Home > Inloggen 
    Breadcrumbs::register('login', function($breadcrumbs) 
    {
    	$breadcrumbs->parent('home');
        $breadcrumbs->push('Inloggen', route('auth.login'));
    });

    // Home > Registreren
    Breadcrumbs::register('register', function($breadcrumbs) 
    {
    	$breadcrumbs->parent('home');
        $breadcrumbs->push('Registreren', route('auth.register'));
    });