<?php
	namespace App\Http\Controllers;

	use App\Models\Page;
	use App\Models\Panel;
	use App\Models\PagePanel;
	use App\Repositories\RepositoryInterfaces\ISidebarRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IPanelRepository;
	use App\Repositories\RepositoryInterfaces\IPagePanelRepository;
	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
	use App\Http\Requests;
	use App\Http\Requests\Page\PageRequest;
	use Flash;
	use Auth;
	use Redirect;
	use Request;
	use View;

	class PageController extends Controller
	{

		public function __construct(IIntroductionRepository $introrepo, IPageRepository $pagerepo,  INewOnSiteRepository $newOnSiteRepository,
									IPanelRepository $panelrepo, IPagePanelRepository $pagepanelrepo, ISidebarRepository $sidebarrepo)
		{
			$this->introrepo = $introrepo;
			$this->pagerepo = $pagerepo;
			$this->panelrepo = $panelrepo;
			$this->pagepanelrepo = $pagepanelrepo;
			$this->sidebarrepo = $sidebarrepo;
			$this->newOnSiteRepository = $newOnSiteRepository;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */


		public function index()
		{	
			$pages = $this->pagerepo->getAll();
			return view('page.index', compact('pages'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			$pages = $this->introrepo->getAllToList();
			return view('page.create', compact('pages'));
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store(PageRequest $request)
		{
			$introduction = $this->introrepo->create([
				'title' => $request->title, 
				'subtitle' => $request->subtitle,
				'text' => $request->content,
				]);

			$introId = $introduction->introductionId;

			$page = $this->pagerepo->create([
				'introduction_introductionId' => $introId,
				'sidebar' => $request->sidebar,
				]);

			if(count($request->panel) > 0){
			foreach($request->panel as $pagepanel){
				$panel = $this->panelrepo->getBySize($pagepanel['size']);

				$this->pagepanelrepo->create([
					'page_id' => $page->pageId,
					'title' => $pagepanel['title'],
					'text' => $pagepanel['content'],
					'panel_id' =>$panel->panelId
				]);
			}
		}

		    $pageid = $page->pageId;

		    if($request->sidebar){
		    	$sidebar = $this->sidebarrepo->create([
		    		'page_pageId' => $pageid,
		    		'rowNr' => 0,
		    		'title' => $request->title,
		    		'text' => 'Home',
		    		'extern' => 'false',
		    		'link' => '/'
		    		]);
		    }


			$newOnSite = filter_var($_POST['toNewOnSite'], FILTER_VALIDATE_BOOLEAN);

			if($newOnSite === true)
			{
				$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
				$attributes['created_at'] = new \DateTime('now');
				$this->newOnSiteRepository->create($attributes);
			}

			return Redirect::route('page.show', [$page->pageId]);
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function show($id)
		{
		    
			if($this->redirectHome($id)){
				return Redirect::route('home.index');
			} 

			$page = $this->pagerepo->get($id);
			if(isset($page)){
				if($page->sidebar){
					$sidebar = $this->sidebarrepo->getByPage($page->pageId);
					return View('page.show', compact('page', 'sidebar'));
				} else {
					return View('page.show', compact('page'));
				}
			} else {
				return view('errors.404');
			} 
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function edit($id)
		{
			if($this->redirectHome($id)){
				Flash::error('U kunt de homepage niet op deze manier wijzigen.');
				return Redirect::route('home.index');
			}

			$page = $this->pagerepo->get($id);
			if(isset($page)){
				return View('page.edit', compact('page'));
			} else {
				return view('errors.404');
			}

		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function update($id, PageRequest $request)
		{
			if($this->redirectHome($id)){
				return Redirect::route('home.index');
			}

			$old = $this->pagerepo->get($id)->sidebar;
			$new = $request->sidebar;

			// update introduction
			$introduction = $this->introrepo->get($request->intro_id);
			$introduction->title = $request->title;	
			$introduction->subtitle = $request->subtitle;
			$introduction->text = $request->content;

			$this->introrepo->update($introduction);

			// update page

			$page = $this->pagerepo->get($id);	
			$page->sidebar = $request->sidebar;
			$this->pagerepo->update($page);

			// delete all old panels 
			$this->pagepanelrepo->deleteAllFromPage($id);

			// update panels 
			if(count($request->panel) > 0)
			{
				foreach($request->panel as $pagepanel)
				{
					$panel = $this->panelrepo->getBySize($pagepanel['size']);
						
					$this->pagepanelrepo->create(
					[
						'page_id' => $page->pageId,
						'title' => $pagepanel['title'],
						'text' => $pagepanel['content'],
						'panel_id' =>$panel->panelId
					]);					
				}
			}
			$pageid = $page->pageId;
			$title = $request->title;
			$this->updateSidebar($old, $new, $pageid, $title);

			$newOnSite = filter_var($_POST['toNewOnSite'], FILTER_VALIDATE_BOOLEAN);

			if($newOnSite)
			{
				$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
				$attributes['created_at'] = new \DateTime('now');

				$this->newOnSiteRepository->create($attributes);
			}
			
			return Redirect::route('page.show', [$page->pageId]);
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * 
		 * @return Response
		 */
		public function destroy($id)
		{
			if($this->redirectHome($id))
			{
				Flash::error('U kunt de homepagina niet verwijderen');

				return Redirect::route('home.index');
			}

			$page = $this->pagerepo->get($id);

			if($page->sidebar)
			{
				$this->sidebarrepo->deleteAllFromPage($id);
			}
			$this->pagepanelrepo->deleteAllFromPage($id);
			$this->pagerepo->destroy($id);
			$this->introrepo->destroy($page->introduction->introductionId);

			return Redirect::route('page.index');
		}

		/**
		 * When old is the same as $new, both are false or true
		 *	
		 */
		private function updateSidebar($old, $new, $pageid, $title)
		{
			if($old != $new)
			{
				if($new)
				{
					$sidebar = $this->sidebarrepo->create(
					[
						'page_pageId' => $pageid,
						'rowNr' => 0,
						'title' => $title,
						'text' => 'Home',
						'extern' => 'false',
						'link' => '/'
					]);
				} 
				else 
				{
					$this->sidebarrepo->deleteAllFromPage($pageid);
				}
			}
		}

		/* 
		 * redirectHome will redirect if the page is the homepage.
		 * The homepage has different edit functions and a different pageview.
		 * 
		 */
		private function redirectHome($id)
		{
			if($id === '1')
			{
				Flash::success('U bent succesvol naar de homepagina begeleid.');

				return true;
			} 
			
			return false;
		}
	}