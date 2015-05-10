<?php

    // Home > Manage  (( ADMIN PANEEL ))
    Breadcrumbs::register('manage', function($breadcrumbs)
    {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Beheer', route('admin.index'));
    });

    //!!!!! LET OP GEEN ROUTE!
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


    // Home > Manage > Wijzig footer
    Breadcrumbs::register('editfooter', function($breadcrumbs)
    {
        $breadcrumbs->parent('manage');
        $breadcrumbs->push('Wijzig Footer', route('footer.edit'));
    });


    // Home > Manage > Wijzig menu
    Breadcrumbs::register('editmenu', function($breadcrumbs)
    {
        $breadcrumbs->parent('manage');
        $breadcrumbs->push('Wijzig Menu', route('menu.index'));
    });