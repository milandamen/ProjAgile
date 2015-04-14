<?php    
    // Home > Nieuws 
    Breadcrumbs::register('news', function($breadcrumbs) 
    {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Nieuws', route('news.index'));
    });

    // Home > Nieuws > Manage
    Breadcrumbs::register('newsmanage', function($breadcrumbs) 
    {
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