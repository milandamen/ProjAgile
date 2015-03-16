<?php
/**
 * Created by PhpStorm.
 * User: SysAdmin
 * Date: 3/2/2015
 * Time: 8:49 PM
 */

require_once '../app/controller/AuthenticationController.php';

class Shared extends Controller
{
	protected $auth;

	public function __construct(){
		$this->auth = new AuthenticationController();
	}

    public function header($title)
    {
        $this->view('shared/header', ['title' => $title]);
    }

    public function menu()
    {
        $this->view('shared/menu');
    }

    public function sidebar()
    {	
    	require_once '../app/repository/sidebarRepository.php';
    	require_once '../app/model/Sidebar.php';		

    	$sidebardb = new SidebarRepository();
    	$sidebarData = $sidebardb->getAll();

    	$data = array('sidebarRows' => $sidebarData);

    	$this->view('shared/sidebar', ['sidebarRows' => $sidebarData, 'logged' => $this->login()]);
    }

    public function footer()
    {
        require_once "../app/repository/footerRepository.php";
        require_once '../app/model/Footer.php';
        $footerdb = new FooterRepository();
        $footer = $footerdb->getAll();
        $numColumns = 0;
        foreach($footer as $item)
        {
            if($item->getCol() >= $numColumns)
            {
                $numColumns = $item->getCol()+1;
            }
        }
        $footerColumns = [];
        for($i = 0; $i < $numColumns; $i++)
        {
            $footerColumns[] = [];
        }
        foreach($footer as $item)
        {
            $footerColumns[$item->getCol()][] = $item;
        }
        $this->view('shared/footer', ['footerColumns' => $footerColumns, 'logged' => $this->login()]);
    }


    protected function login(){

		$logged = false;

        if($this->auth->loggedIn()){
        	$logged = true;
        }

        return $logged;
	}

	public function noPermission(){

		$this->header('No Permission');
        $this->menu();
        $this->view('shared/permission');
        $this->footer();

	}
}