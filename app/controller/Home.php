<?php
    require_once 'AuthenticationController.php';

    class Home extends Shared
    {
        private $newsdb;
        private $sidebardb;
        private $introDb;
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


            require_once '../app/repository/introductionRepository.php';
            require_once '../app/model/Introduction.php';
            $this->introDb = new IntroductionRepository();
        }

        public function index()
        {
            $this->header('Home');
            $this->menu();
            $modules = $this->homeLayoutRepository->getAll();
            $sidebarData = $this->sidebardb->getAll();
            $introduction = $this->introDb->getById(1);
            $data = array('news' => $this->newsdb->getAll(),'intro' => $introduction, 'layoutmodules' => $modules, 'sidebarRows' => $sidebarData, 'loggedIn' => $this->getAuth()->loggedIn());
            $this->view('home/index', $data);
            $this->footer();
        }

        public function editlayout()
        {

        	if($this->getAuth()->loggedIn() && $_SESSION['userGroupId'] == 1){
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
	                $introduction = $this->introDb->getById(1); 

	                $this->header('editlayout');
	                $this->menu();

	                $data = array('news' => $this->newsdb->getAll(), 'intro' => $introduction, 'layoutmodules' => $modules, 'sidebarRows' => $sidebarData, 'loggedIn' => $this->getAuth()->loggedIn());
	                $this->view('home/editlayout', $data);

	                $this->footer();
	            }
        	} else {
        		global $Base_URI;
				header('Location: ' . $Base_URI . 'Shared/noPermission');
        	}
        }


        public function editIntro(){
        	
        	if($this->getAuth()->loggedIn() && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2))
        	{

        		if($_POST){
        			$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	        		$content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
	        		$pageId = filter_var($_POST['pageId'], FILTER_VALIDATE_BOOLEAN);

        			$intro = new Introduction($pageId, $content, $title);

        			$this->introDb->update($intro);

        			global $Base_URI;
					header('Location: ' . $Base_URI . '');

        		} else {

	            $this->header('Introductie aanpassen');
	            $this->menu();
	            $this->view('intro/edit', ['intro'=>$this->introDb->getById(1)]);
	            $this->footer();
	        }
        	} else {
	        	global $Base_URI;
				header('Location: ' . $Base_URI . 'Shared/noPermission');
        	}
        }

    }