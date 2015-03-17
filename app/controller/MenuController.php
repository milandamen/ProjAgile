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
            $this->menudb->truncateTable();

            foreach($_POST['menuItem'] as $menuItem)
            {
                $menuId =       $menuItem[0];
                $menuNaam =     $menuItem[1];
                $menuUrl =      $menuItem[2];
                $menuLevels =   explode('.', $menuItem[3]);

                $parentId = '0';

                if(count($menuLevels) == 2)
                {
                    $parentId = $menuLevels[0];
                    $orderNr = $menuLevels[1];
                }
                else
                {
                    $orderNr = $menuLevels[0];
                    $parentId = 'null';
                }

                if(isset($menuItem[4]) && $menuItem[4] == 'on')
                {
                    $menuPublish = '1';
                }
                else
                {
                    $menuPublish = '0';
                }

                $menu = new Menu($menuId, $parentId, $menuNaam, $menuUrl, $orderNr, $menuPublish);

                /*$parameters = array(
                    ':menuId' => $menuItem->getMenuId(),
                    ':parentId' => $menuItem->getParentId(),
                    ':name' => $menuItem->getName(),
                    ':relativeUrl' => $menuItem->getRelativeUrl(),
                    ':menuOrder' => $menuItem->getMenuOrder(),
                    ':publish'=> $menuItem-> getPublish()
                );*/




                $this->menudb->add($menu);

                //echo("id: " . $menuId . "<br/>naam: " . $menuNaam . "<br/>url: " . $menuUrl . "<br/>Parent: " . $parentId . "<br/>Order: " . $orderNr . "<br/>publish: " . $menuPublish . "<br/>----------------<br/>");
            }
        }
    }