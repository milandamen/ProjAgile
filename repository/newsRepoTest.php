<?php
require_once 'newsRepository.php';
require_once '../model/news.php';

$newsrepo = new NewsRepository();

$news = $newsrepo->getAll();
echo $news[0]->title . '<br/>'  ;
echo $news[0]->content;

echo '<br/>';

$news = $newsrepo->getById(1);
echo $news[0]->title . '<br/>'  ;
echo $news[0]->content;

$n = new News(2,null,1,'Toegevoegd', 'Content', date("D-m-y H:i:s"),0);

$newsrepo->add($n);

$newsrepo->delete(2);
