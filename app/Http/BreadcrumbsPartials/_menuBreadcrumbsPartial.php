<?php
// Home > Menu > Overzicht
Breadcrumbs::register('newMenuItem', function($breadcrumbs)
{
    $breadcrumbs->parent('editmenu');
    $breadcrumbs->push('Nieuw Menu Item', route('menu.create'));
});

// Home > Menu > Overzicht
Breadcrumbs::register('editMenuItem', function($breadcrumbs)
{
    $breadcrumbs->parent('editmenu');
    $breadcrumbs->push('Menu Item  Wijzigen', route('menu.edit'));
});



