<?php
require_once 'newsRepository.php';
require_once '../model/news.php';

$newsrepo = new NewsRepository();

$news = $newsrepo->getAll();
echo $news[0]->getTitle() . '<br/>'  ;
echo $news[0]->getContent();

echo '<br/>';

$news = $newsrepo->getById(1);
echo $news->getTitle() . '<br/>'  ;
echo $news->getContent();

$n = new News(2,null,1,'Toegevoegd', 'Content', date("D-m-y H:i:s"),0);

$newsrepo->add($n);

$n->setContent('UPDATED CONTENT');
$n->setTitle('UPDATED TITLE');
$newsrepo->update($n);

//$newsrepo->delete(2);
