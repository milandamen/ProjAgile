<?php
    require_once 'AuthenticationController.php';

    class MenuController extends Shared
    {
        private $menudb;

        public function __construct()
        {
            $this->setAuth(new AuthenticationController());

            require_once '../app/repository/menuRepository.php';
            $this->menudb = new MenuRepository();
        }

        // Action
        public function index()
        {
            $this->header('Menu Beheer');
            $this->menu();
            $this->view('menu/index', ['allMenuData' =>$this->menudb->getAll()]);
            $this->footer();
        }

        public function getMenu()
        {
            return $this->menudb->getAllPublic();
        }
    }