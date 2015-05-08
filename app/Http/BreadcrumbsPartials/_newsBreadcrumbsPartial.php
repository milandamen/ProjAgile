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
        $breadcrumbs->push('Nieuw bericht', route('news.create'));
    });

    // Home > Nieuws > Wijzigen > [ bericht ] 
    Breadcrumbs::register('editnewsarticle', function($breadcrumbs, $article)
    {
        $breadcrumbs->parent('newsmanage');
        $breadcrumbs->push($article->title, route('news.edit', [$article->id]));
    });