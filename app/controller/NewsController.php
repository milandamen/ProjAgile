<?php
    require_once 'AuthenticationController.php';

    class NewsController extends Shared
    {
        private $newsdb;

        public function __construct()
        {
            require_once '../app/repository/newsRepository.php';
            $this->newsdb = new NewsRepository();
        }

        public function show($id)
        {
            $this->setAuth(new AuthenticationController());

            $this->header('Nieuws | ' . $this->newsdb->getById($id)->getTitle());
            $this->menu();
            $data = array('news' => $this->newsdb->getById($id));
            $this->view('news/show', ['newsdata' => $data, 'logged' => $this->getAuth()->loggedIn()]);
            $this->footer();
        }
    }