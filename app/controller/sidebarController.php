<?php 

require_once 'AuthenticationController.php';

class SidebarController extends Shared {

	public function __construct(){
		parent::__construct();
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

		if($_POST){
		//	var_dump($_POST);
			$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
			$newSidebar = array();
			
			$maxRowIndex = $_POST['maxRowIndex'];
			
			$i =0;
			for($rows = 0; $rows <= $maxRowIndex; $rows++)
			{
				if (isset($_POST['sidebar'][$rows])) {
					$row = $_POST['sidebar'][$rows];
						
					for($rowN = 0; $rowN < count($row['text']); $rowN++)
					{
						if($row['text'][$rowN] != null){
							$in; $out; $radio1; $radio2;
							

							var_dump($row['radio1']);

							
							if(isset($row['radio1']) && isset($row['link'][$rowN])){
								if($row['radio1'] === 'Extern'){
									$in = null;
									$out = filter_var($row['link'][$rowN], FILTER_SANITIZE_STRING);
								} else if($row['radio1'] === 'Intern'){
									$in = filter_var($row['link'][$rowN], FILTER_SANITIZE_STRING);
									$out = null;
								}
							} else if(isset($row['radio1']) && isset($row['link'][$rowN])){
								if($row['radio1'] === 'Extern'){
									$in = null;
									$out = "#";
								} else if($row['radio1'] === 'Intern'){
									$in = "#";
									$out = null;
								}

							}


							
							$newSidebar[] = new Sidebar($pageNr, $i, $title, filter_var($row['text'][$rowN], FILTER_SANITIZE_STRING), $in, $out);
							$i++;
						} else{
							echo "Vul a.u.b. alle verplichte velden in";
							return;
						}
					}
				}
			}

			$this->sidebarDb->deleteAllFromPage($pageNr);

			foreach($newSidebar as $entry)
			{
				//echo 'pageNr ' . $entry->getPageNr() . ' rowNr ' . $entry->getRowNr() . ' title ' . $entry->getTitle() . ' text ' . $entry->getText() . ' in ' . $entry->getInternLink() . ' out ' . $entry->getExternLink();
				$this->sidebarDb->add($entry);
			}

		//	global $Base_URI;
	//			header('Location: ' . $Base_URI);

			return;
		// end if($_POST)
		} else {
			// --------------------- View opbouw
			$this->header('Wijzig sidebar');
        	$this->menu();
			$this->view('sidebar/sidebarUpdate', ['sidebarRows' => $sidebarRows, 'logged' => $this->login()]);
			$this->footer();
		}
	}




}