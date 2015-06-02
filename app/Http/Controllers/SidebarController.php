<?php
	namespace App\Http\Controllers;

	use App\Models\Sidebar;
	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
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
		public function __construct(ISidebarRepository $sidebarRepo, IMenuRepository $menuRepo, INewOnSiteRepository $newOnSiteRepository)
		{
			$this->sidebarRepo = $sidebarRepo;
			$this->menuRepo = $menuRepo;
			$this->newOnSiteRepository = $newOnSiteRepository;
		}

		public function edit($id)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_SIDEBAR))
			{
				$sidebar = $this->sidebarRepo->getByPage($id);

				if(count($sidebar) > 0)
				{
					$sidebarList = $this->sidebarRepo->getByPage($id);
					$menuList = $this->menuRepo->getAll();

					return View('sidebar.edit', compact('sidebarList', 'menuList'));
				}
			}
			return view('errors.403');
		}

		public function update($id)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_SIDEBAR))
			{
				$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
				$maxrowindex = $_POST['maxRowIndex'];
				$i=0;
				$pageId = $id;

				// first delete all old items, to prevent double items and or not deleting rows.
				$this->sidebarRepo->deleteAllFromPage($pageId);
			
				for($rows =0; $rows <= $maxrowindex; $rows++)
				{
					if(isset($_POST['sidebar'][$rows]))
					{
						$rowItems = $_POST['sidebar'][$rows];

						for($row = 0; $row < $maxrowindex; $row++)
						{
							if(isset($rowItems['text'][$row]))
							{
								echo $rowItems['text'][$row];

								if(isset($rowItems['text'][$row]))
								{
									$text = filter_var($rowItems['text'][$row], FILTER_SANITIZE_STRING);

									if($rowItems['radio1'] == 'Extern')
									{
										$extern = true;
										$link = $rowItems['pagename'][$row];
									} 
									else 
									{
										$extern = false;
										$link = $rowItems['pagename'][$row];
									}
									$newSidebarRow = new Sidebar();
									$newSidebarRow->page_pageId = $pageId;
									$newSidebarRow->rowNr = $i;
									$newSidebarRow->title= $title;
									$newSidebarRow->text = $text;
									$newSidebarRow->link= $link;
									$newSidebarRow->extern= $extern;
									$newSidebarRow->save();
									
									$i++;
								} 
								else 
								{
									echo "Vul a.u.b. alle verplichte velden in";

									return;
								}
							}
						}
					}             
				}

				$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

				if($newOnSite === true)
				{
					$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
					$attributes['created_at'] = new \DateTime('now');
					$this->newOnSiteRepository->create($attributes);
				}

				return Redirect::route('home.index');
			}
			
			return view('errors.403');
		}
	}