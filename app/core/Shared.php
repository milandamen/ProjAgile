<?php
/**
 * Created by PhpStorm.
 * User: SysAdmin
 * Date: 3/2/2015
 * Time: 8:49 PM
 */

class Shared extends Controller
{
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

    	//$sidebar = new Sidebar('home', 'Test text', 'http://test-link.nl');
    	  for($i = 0; $i < 4; $i++)
        {
            $sideColumns[] = new Sidebar('home', 'Meer informatie','Test text', 'http://test-link.nl');
        }


    	$data = array('sidebarRows' => $sideColumns);

    	$this->view('shared/sidebar', $data);
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
        $this->view('shared/footer', ['footerColumns' => $footerColumns]);
    }
}