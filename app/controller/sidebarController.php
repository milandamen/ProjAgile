<?php 

class SidebarController extends Shared {

	public function __construct(){
		require_once '../app/repository/sidebarRepository.php';
		require_once '../app/model/Sidebar.php';
		$this->sidebarDb = new SidebarRepository();
	}

	public function sidebarCreate(){
		
	}

	public function sidebarDelete(){
		
	}

	public function sidebarUpdate($pageNr){

		// -- Data collection

		$sidebarAll = $this->sidebarDb->getAll();
		$sidebarRows = array();
		foreach($sidebarAll as $sidebarItem){
			if($sidebarItem->getPageNr() == $pageNr){
				$sidebarRows[] = $sidebarItem;
			}
		}



		// --------------------- View opbouw

		$this->header('Update sitebar');
        $this->menu();
		$this->view('sidebar/sidebarUpdate', ['sidebarRows' => $sidebarRows]);
		$this->footer();
	}





}