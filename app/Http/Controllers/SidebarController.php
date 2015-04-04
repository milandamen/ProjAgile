<?php namespace App\Http\Controllers;

use App\Repository\SidebarRepository;



class SidebarController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct(SidebarRepository $sidebarrepo)
	{
		$this->sidebarrepo = $sidebarrepo;
	}



	public function getIndex()
	{

		
	}

	public function getUpdate($id){

		$sidebarAll = $this->sidebarrepo->getByPage($id);
		
		 $this->view('sidebar/sidebarUpdate', ['sidebarRows' => $sidebarAll);

	}

	public function postUpdate($id){

		$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
		$newsidebar = array();
		$maxrowindex = $_POST['maxRowIndex'];
		$i=0;

		foreach($rows =0; $rows < $maxrowindex; $rows++){
			if(isset($_POST['sidebar'][$rows])){

				$rowItems = $_POST['sidebar'][$rows];
				for($row = 0; $row < count($row['text']); $row++){
					if($rowItems['text'][$row] != null){

						$in; $out;

						if(isset($rowItems['radio1']) && isset($rowItems['link'][$row])){
							if($rowItems['radio1'] === 'Extern'){
								$in = null;
								$out = filter_var($rowItems['link'][$row], FILTER_SANITIZE_STRING);
							}
							else if($rowItems['radio1'] === 'Intern'){
								$in = filter_var($rowItems['link'][$row], FILTER_SANITIZE_STRING);
								$out = null;
							}
						} else if(isset($rowItems['radio1']) && !isset($rowItems['link'][$row])){
							if($rowItems['radio1'] === 'Extern'){
								$in = null;
								$out = "#";
							} else if($rowItems['radio1'] === 'Intern'){
								$in = "#";
								$out = null;
							}
						}

						$newSidebar[] = new Sidebar($pageNr, $i, $title, filter_var($rowItems['text'][$row], FILTER_SANITIZE_STRING), $in, $out);
						$i++;
					} else {
				 		echo "Vul a.u.b. alle verplichte velden in";
						return;
					}
				}
			} 
		}

		// Delete all former menu-items to make sure everything will be correct
		$this->sidebarrepo->deleteAllFromPage($pageNr);
		
		// Insert all menu-items.
		foreach($newSidebar as $entry){
			$this->sidebarrepo->add($entry);
		}



	}



}
