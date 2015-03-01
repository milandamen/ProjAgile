<?php
require_once 'newsRepository.php';

$newsrepo = new NewsRepository();

$news = $newsrepo->getAll('news');

echo $news[0]->title . '<br/>'  ;
echo $news[0]->content;