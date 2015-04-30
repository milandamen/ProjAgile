<?php
// Home > Manage > Gebruikers
Breadcrumbs::register('user', function($breadcrumbs)
{
    $breadcrumbs->parent('manage');
    $breadcrumbs->push('Gebruikers', route('user.index'));
});

// Home > Manage > Gebruikers > Filter
Breadcrumbs::register('filter', function($breadcrumbs, $criteria)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push($criteria->criteria, route('user.index', [$criteria->criteria]));
});

// Home > Manage > Gebruikers > Nieuwe gebruiker
Breadcrumbs::register('adduser', function($breadcrumbs)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Nieuwe gebruiker', route('user.create'));
});

// Home > Manage > Gebruikers > Wijzigen > [ gebruikersnaam ]
Breadcrumbs::register('edituser', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push($user->username, route('user.edit', [$user->id]));
});