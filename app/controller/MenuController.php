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
            if($_POST)
            {
                $this->updateToDB();
            }

            $this->header('Menu Beheer');
            $this->menu();
            $this->view('menu/index', ['allMenuData' =>$this->menudb->getAll()]);
            $this->footer();
        }

        public function getMenu()
        {
            return $this->menudb->getAllPublic();
    }


        private function updateToDB()
        {
            foreach($_POST['menuItem'] as $menuItem)
            {
                $menuId =       $menuItem[0];
                $menuNaam =     $menuItem[1];
                $menuUrl =      $menuItem[2];
                $menuLevels =   explode('.', $menuItem[3]);

                $parentId = '';
                $orderNr = '';
                if(count($menuLevels) == 2)
                {
                    $parentId = $menuLevels[0];
                    $orderNr = $menuLevels[1];
                }
                else
                {
                    $orderNr = $menuLevels;
                }


                $menuPublish =  $menuItem[4];

                echo("id: " . $menuId . "<br/>naam: " . $menuNaam . "<br/>url: " . $menuUrl . "<br/>Parent: " . $parentId . "<br/>Order: " . $orderNr . "<br/>publish: " . $menuPublish . "<br/>----------------");
            }
        }
    }