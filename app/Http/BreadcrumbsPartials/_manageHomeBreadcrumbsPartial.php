<?php
    //!!!!! LET OP NOG GEEN ROUTE!
    // Home > Manage  (( ADMIN PANEEL ))
    Breadcrumbs::register('manage', function($breadcrumbs)
    {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Manage');
    });

    //!!!!! LET OP NOG GEEN ROUTE!
    // Home > Manage > Wijzig Sidebar
    Breadcrumbs::register('editsidebar', function($breadcrumbs)
    {
        $breadcrumbs->parent('manage');
        $breadcrumbs->push('Wijzig Sidebar');
    });

    // Home > Manage > Wijzig sidebar > [ page ]
    Breadcrumbs::register('sidebarpage', function($breadcrumbs, $page)
    {
        $breadcrumbs->parent('editsidebar');
        $breadcrumbs->push($page->title, route('sidebar.edit', [$page->id]));
    });

    // Home > Manage > Wijzig carousel
    Breadcrumbs::register('editcarousel', function($breadcrumbs)
    {
        $breadcrumbs->parent('manage');
        $breadcrumbs->push('Wijzig Carousel', route('carousel.edit'));
    });

    // Home > Manage > Wijzig introductie
    Breadcrumbs::register('editintroduction', function($breadcrumbs)
    {
        $breadcrumbs->parent('manage');
        $breadcrumbs->push('Wijzig Introductie', route('home.editIntroduction'));
    });

    // Home > Manage > Wijzig layout
    Breadcrumbs::register('editlayout', function($breadcrumbs)
    {
        $breadcrumbs->parent('manage');
        $breadcrumbs->push('Wijzig Layout', route('home.editLayout'));
    });


    //!!!!! LET OP NOG GEEN ROUTE!
    // Home > Manage > Wijzig footer
    Breadcrumbs::register('editfooter', function($breadcrumbs)
    {
        $breadcrumbs->parent('manage');
        $breadcrumbs->push('Wijzig Footer');
    });

    //!!!!! LET OP NOG GEEN ROUTE!
    // Home > Manage > Wijzig menu
    Breadcrumbs::register('editmenu', function($breadcrumbs)
    {
        $breadcrumbs->parent('manage');
        $breadcrumbs->push('Wijzig Menu');
    });