<?php
// Home > Gebruikers
Breadcrumbs::register('user', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Gebruikers', route('user.index'));
});

// Home > Gebruikers > Nieuwe gebruiker
Breadcrumbs::register('adduser', function($breadcrumbs)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Nieuwe gebruiker', route('user.create'));
});

// Home > Nieuws > Wijzigen > [ gebruikersnaam ]
Breadcrumbs::register('edituser', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push($user->username, route('user.edit', [$user->id]));
});