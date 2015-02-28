<?php
require_once "projagile/repository/newsRepository.php";

$newsrepo = new NewsRepository();

$newsrepo->getAllNews();

