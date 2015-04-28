<?php
//!!!!! LET OP GEEN ROUTE!
// Home > Manage > New Page 
Breadcrumbs::register('newpage', function($breadcrumbs)
{
	$breadcrumbs->parent('manage');
	$breadcrumbs->push('Nieuwe pagina');
});


// Home > Manage > Edit Page
Breadcrumbs::register('editpage', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('manage');
    $breadcrumbs->push($page->title);
});

// Home > Manage > New Page > [ pagetitle ]
Breadcrumbs::register('editpagetitle', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('editpage');
    $breadcrumbs->push($page->title);
});


?>