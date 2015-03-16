<?php
    require_once 'AuthenticationController.php';

    class Home extends Shared
    {
        private $newsdb;
        private $homeLayoutRepository;

        public function __construct()
        {
            $this->setAuth(new AuthenticationController());

            require_once '../app/repository/newsRepository.php';
            $this->newsdb = new NewsRepository();

            require_once '../app/repository/homeLayoutRepository.php';
            require_once '../app/model/HomeLayoutModule.php';
            $this->homeLayoutRepository = new HomeLayoutRepository();

            require_once '../app/repository/sidebarRepository.php';
            require_once '../app/model/Sidebar.php';
            $this->sidebardb = new SidebarRepository();
        }

        public function index()
        {
            $this->header('Home');
            $this->menu();

            $modules = $this->homeLayoutRepository->getAll();

            $sidebarData = $this->sidebardb->getAll();

            $data = array('news' => $this->newsdb->getAll(), 'layoutmodules' => $modules, 'sidebarRows' => $sidebarData, 'loggedIn' => $this->getAuth()->loggedIn());

            $this->view('home/index', $data);

            $this->footer();
        }

        public function indextest($name = '')
        {
            $this->header('indextest');
            $this->menu();

            $user = $this->model('UserTest');
            $user->name = $name;

            $modules = $this->homeLayoutRepository->getAll();
            $data = array('name' => $user->name, 'layoutmodules' => $modules);
            $this->view('home/indextest', $data);

            $this->footer();
        }

        public function editlayout()
        {
            if ($_POST && isset($_POST['module-introduction']) && isset($_POST['module-news']) && isset($_POST['module-sidebar']))
            {
                $module = new HomeLayoutModule('module-introduction', $_POST['module-introduction']);
                $this->homeLayoutRepository->update($module);
                $module = new HomeLayoutModule('module-news', $_POST['module-news']);
                $this->homeLayoutRepository->update($module);
                $module = new HomeLayoutModule('module-sidebar', $_POST['module-sidebar']);
                $this->homeLayoutRepository->update($module);

                header('Location: /ProjAgile/public/');
            }
            else
            {
                $modules = $this->homeLayoutRepository->getAll();
                $sidebarData = $this->sidebardb->getAll();

                $this->header('editlayout');
                $this->menu();

                $data = array('news' => $this->newsdb->getAll(), 'layoutmodules' => $modules, 'sidebarRows' => $sidebarData, 'loggedIn' => $this->getAuth()->loggedIn());
                $this->view('home/editlayout', $data);

                $this->footer();
            }
        }

        public function error()
        {
            $this->header('Home');
            $this->menu();

            $this->view('home/error');

            $this->footer();
        }
    }