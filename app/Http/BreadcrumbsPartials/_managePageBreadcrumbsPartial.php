<?php
// Home > Manage > Pages 
Breadcrumbs::register('pages', function($breadcrumbs)
{
	$breadcrumbs->parent('manage');
	$breadcrumbs->push('Pagina\'s', route('page.index'));
});

// Home > Manage > Pages > New Page 
Breadcrumbs::register('newpage', function($breadcrumbs)
{
	$breadcrumbs->parent('pages');
	$breadcrumbs->push('Nieuwe pagina', route('page.create'));
});

//!!!!! LET OP GEEN ROUTE!
// Home > Manage > Pages > Edit Page
Breadcrumbs::register('editpage', function($breadcrumbs)
{
    $breadcrumbs->parent('pages');
    $breadcrumbs->push('Pagina wijzigen');
});

// Home > Manage > Pages > Edit Page > [ pagetitle ]
Breadcrumbs::register('editpagetitle', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('editpage');
    $breadcrumbs->push($page->title, route('page.edit', [$page->id]));
});


// Home > [ pagetitle ]
Breadcrumbs::register('showpage', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($page->title, route('page.show', [$page->id]));
});


?>