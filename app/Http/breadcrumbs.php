<?php

/*----------------------------------------------------------------------
  Home 
*/
// Home
Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Home', route('home.index'));
});

// Home > Inloggen 
Breadcrumbs::register('login', function($breadcrumbs) {
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Inloggen', route('auth.login'));
});

// Home > Registreren
Breadcrumbs::register('register', function($breadcrumbs) {
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Registreren', route('auth.register'));
});



/*----------------------------------------------------------------------
  Home > News
*/

// Home > Nieuws 
Breadcrumbs::register('news', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Nieuws', route('news.index'));
});

// Home > Nieuws > Manage
Breadcrumbs::register('newsmanage', function($breadcrumbs) {
    $breadcrumbs->parent('news');
    $breadcrumbs->push('Manage', route('news.manage'));
});

// Home > Nieuws > [artikel]
Breadcrumbs::register('article', function($breadcrumbs, $article)
{
    $breadcrumbs->parent('news');
    $breadcrumbs->push($article->title, route('news.show', [$article->id]));
});

// Home > Nieuws > Nieuw bericht
Breadcrumbs::register('addnews', function($breadcrumbs)
{
    $breadcrumbs->parent('news');
    $breadcrumbs->push('Nieuw bericht');
});

// Home > Nieuws > Wijzigen
Breadcrumbs::register('editnews', function($breadcrumbs)
{
    $breadcrumbs->parent('news');
    $breadcrumbs->push('Wijzig bericht');
});

//!!!!! LET OP NOG GEEN ROUTE!
// Home > Nieuws > Wijzigen > [ bericht ] 
Breadcrumbs::register('editnewsarticle', function($breadcrumbs,$article)
{
    $breadcrumbs->parent('editnews');
    $breadcrumbs->push($article->title);
});


/*----------------------------------------------------------------------
  Home > Manage 
*/

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




?>