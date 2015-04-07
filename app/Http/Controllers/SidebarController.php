<?php namespace App\Http\Controllers;

use App\Repository\SidebarRepository;
use App\Models\Sidebar;


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

		if($this->sidebarrepo->getByPage($id) != null){
			$sidebarAll = $this->sidebarrepo->getByPage($id);
			
			 return View('sidebar/update', ['sidebar' => $sidebarAll]);
		} else {
			// Totdat er een error page is. 
			return redirect('/home');
		}
	}

	public function postUpdate($id){

		$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
		$newSidebar = array();
		$maxrowindex = $_POST['maxRowIndex'];
		$i=0;
		$pageNr = $id;


		for($rows =0; $rows <= $maxrowindex; $rows++){
			echo $rows;
			if(isset($_POST['sidebar'][$rows])){
				$rowItems = $_POST['sidebar'][$rows];
				for($row = 0; $row < count($rowItems['text']); $row++){
					if($rowItems['text'][$row] != null){
						$link =  $rowItems['link'][$row];
						$extern = false;

						if($rowItems['radio1'] == 'Extern'){
							$extern = true;
							$link = $rowItems['link'][$row];
						} else {
							$link = $rowItems['pagename'][$row];
							$extern = false;
						}

						$text = filter_var($rowItems['text'][$row], FILTER_SANITIZE_STRING);
						if(isset($rowItems['rowId'])){
							$rowId = $rowItems['rowId'];
							$sideRow = $this->sidebarrepo->get($rowId);
							
							if($sideRow != null){
								$sideRow->pageNr = $pageNr;
								$sideRow->rowNr = $i;
								$sideRow->title= $title;
								$sideRow->text = $text;
								$sideRow->link= $link;
								$sideRow->extern= $extern;
								$sideRow->save();
							}
						} else {						
							$newSidebarRow = new Sidebar();
							$newSidebarRow->pageNr = $pageNr;
							$newSidebarRow->rowNr = $i;
							$newSidebarRow->title= $title;
							$newSidebarRow->text = $text;
							$newSidebarRow->link= $link;
							$newSidebarRow->extern= $extern;
							$newSidebarRow->save();
						}



						$i++;
					} else {
				 		echo "Vul a.u.b. alle verplichte velden in";
						return;
					}
				}
			} 
		}


		// $sidebarAll = $this->sidebarrepo->getByPage($id);
		// return View('sidebar/update', ['sidebar' => $sidebarAll]);
		return redirect('/home');

	}



}
