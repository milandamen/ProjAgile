<?php
    namespace App\Http\Controllers;

    use App\Models\Sidebar;
    use App\Repositories\RepositoryInterfaces\ISidebarRepository;
    use App\Repositories\RepositoryInterfaces\IMenuRepository;
    use Illuminate\Support\Facades\Redirect;
	use Auth;

    class SidebarController extends Controller
    {
	
		private $sidebarRepo;

		/**
		* Create a new SidebarController instance.
		*
		* @parm ISidebarRepository $sidebarRepo
		*
		* @return void
		*/
		public function __construct(ISidebarRepository $sidebarRepo, IMenuRepository $menuRepo)
		{
			$this->sidebarRepo = $sidebarRepo;
			$this->menuRepo = $menuRepo;
		}

		public function edit($id)
		{
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {

				$sidebar = $this->sidebarRepo->getByPage($id);
				if(count($sidebar) > 0)
				{
					$sidebarList = $this->sidebarRepo->getByPage($id);
					$menuList = $this->menuRepo->getAll();
					return View('sidebar.edit', compact('sidebarList', 'menuList'));
				} else {
					// Totdat er een error page is.
					//return Redirect::route('home.index');
					return view('errors.404');
				}
			} else {
				return view('errors.403');
			}
		}

		public function update($id)
		{
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
				$maxrowindex = $_POST['maxRowIndex'];
				$i=0;
				$pageNr = $id;

				// first delete all old items, to prevent double items and or not deleting rows.
				$this->sidebarRepo->deleteAllFromPage($pageNr);
			

				for($rows =0; $rows <= $maxrowindex; $rows++)
				{
					if(isset($_POST['sidebar'][$rows]))
					{
						$rowItems = $_POST['sidebar'][$rows];
						for($row = 0; $row < $maxrowindex; $row++)
						{
							if(isset($rowItems['text'][$row])){
								echo $rowItems['text'][$row];

								if(isset($rowItems['text'][$row])){
									$text = filter_var($rowItems['text'][$row], FILTER_SANITIZE_STRING);
									$link =  $rowItems['link'][$row];
									$extern = false;

									if($rowItems['radio1'] == 'Extern'){
										$extern = true;
										$link = $rowItems['link'][$row];
									} else {
										if($rowItems['pagename'][$row] != ''){
											$link = $rowItems['pagename'][$row];
										} else {
											$link = $rowItems['link'][$row];
										}
										$extern = false;
									}

									$newSidebarRow = new Sidebar();
									$newSidebarRow->pageNr = $pageNr;
									$newSidebarRow->rowNr = $i;
									$newSidebarRow->title= $title;
									$newSidebarRow->text = $text;
									$newSidebarRow->link= $link;
									$newSidebarRow->extern= $extern;
									$newSidebarRow->save();
									
									$i++;
								} else {
									echo "Vul a.u.b. alle verplichte velden in";
									return;
								}
							}
						}
					}             
				}
				return Redirect::route('home.index');
			} else {
				return view('errors.403');
			}
		}
    }