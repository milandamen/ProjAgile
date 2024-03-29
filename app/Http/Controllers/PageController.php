<?php
	namespace App\Http\Controllers;

	use App\Models\Page;
	use App\Models\PagePanel;
	use App\Models\Panel;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\ISidebarRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IPagePanelRepository;
	use App\Repositories\RepositoryInterfaces\IPanelRepository;
	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use App\Http\Requests;
	use App\Http\Requests\Page\PageRequest;
	use App\Http\Requests\Page\ContactRequest;
	use App\Http\Requests\Home\IntroductionRequest;
	use Auth;
	use Carbon\Carbon;
	use Flash;
	use Input;
	use Mail;
	use Redirect;
	use Request;
	use View;

	class PageController extends Controller
	{
		/**
		 * The IIntroductionRepository implementation.
		 * 
		 * @var IIntroductionRepository
		 */
		private $introRepo;

		/**
		 * The INewOnSiteRepository implementation.
		 * 
		 * @var INewOnSiteRepository
		 */
		private $newOnSiteRepo;

		/**
		 * The IPageRepository implementation.
		 * 
		 * @var IPageRepository
		 */
		private $pageRepo;

		/**
		 * The IPagePanelRepository implementation.
		 * 
		 * @var IPagePanelRepository
		 */
		private $pagePanelRepo;

		/**
		 * The IPanelRepository implementation.
		 * 
		 * @var IPanelRepository
		 */
		private $panelRepo;

		/**
		 * The ISidebarRepository implementation.
		 * 
		 * @var ISidebarRepository
		 */
		private $sidebarRepo;
		
		/**
		 * The IDistrictSectionRepository implementation.
		 * 
		 * @var IDistrictSectionRepository
		 */
		private $districtSectionRepo;

		/**
		 * Creates a new PageController instance.
		 *
		 * @param  IIntroductionRepository	$introRepo
		 * @param  INewOnSiteRepository		$newOnSiteRepo
		 * @param  IPageRepository			$pageRepo
		 * @param  IPagePanelRepository		$pagePanelRepo
		 * @param  IPanelRepository			$panelRepo
		 * @param  ISidebarRepository		$sidebarRepo
		 *
		 * @return void
		 */
		public function __construct(IIntroductionRepository $introRepo, INewOnSiteRepository $newOnSiteRepo,
									IPageRepository $pageRepo, IPagePanelRepository $pagePanelRepo, 
									IPanelRepository $panelRepo, ISidebarRepository $sidebarRepo,
									IDistrictSectionRepository $districtSectionRepo, IUserRepository $userRepo)
		{
			$this->introRepo = $introRepo;
			$this->pageRepo = $pageRepo;
			$this->panelRepo = $panelRepo;
			$this->pagePanelRepo = $pagePanelRepo;
			$this->sidebarRepo = $sidebarRepo;
			$this->newOnSiteRepo = $newOnSiteRepo;
			$this->districtSectionRepo = $districtSectionRepo;
			$this->userRepo = $userRepo;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{
			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->canEditPages() || Auth::user()->userGroup->canEditPages()))
			{
				$pages = $this->pageRepo->getAll();

				return view('page.index', compact('pages'));
			}
			return view('errors.403');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPermission(PermissionsController::PERMISSION_PAGE) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_PAGE)))
			{
				$pages = $this->pageRepo->getAllToList();
				$districtSections = $this->districtSectionRepo->getAllToList();

				return view('page.create', compact('pages', 'districtSections'));
			}
			return view('errors.403');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store(PageRequest $request)
		{
			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPermission(PermissionsController::PERMISSION_PAGE) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_PAGE)))
			{
				$introduction = $this->introRepo->create
				([
					'title' => $request->title,
					'subtitle' => $request->subtitle,
					'text' => $request->content,
				]);
				$introId = $introduction->introductionId;

				$page = $this->pageRepo->create
				([
					'introduction_introductionId' => $introId,
					'sidebar' => $request->sidebar,
					'publishDate' => $request->publishStartDate,
					'publishEndDate' => $request->publishEndDate,
					'visible' => $request->visible,
					'parentId' => $request->parent,
				]);

				if (count($request->panel) > 0) {
					foreach ($request->panel as $pagepanel) {
						$panel = $this->panelRepo->getBySize($pagepanel['size']);

						$this->pagePanelRepo->create
						([
							'page_id' => $page->pageId,
							'title' => $pagepanel['title'],
							'text' => $pagepanel['content'],
							'panel_id' => $panel->panelId,
						]);
					}
				}
				$pageid = $page->pageId;
				
				$districtSections = $request->districtSection;

				foreach($districtSections as $district)
				{
					$page->districtSections()->attach($district);
				}

				if ($request->sidebar) {
					$sidebar = $this->sidebarRepo->create
					([
						'page_pageId' => $pageid,
						'rowNr' => 0,
						'title' => $request->title,
						'text' => 'Home',
						'extern' => 'false',
						'link' => '/'
					]);
				}
				$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

				if ($newOnSite) {
					$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
					$attributes['link'] = route('page.show', $page->pageId);
					$attributes['created_at'] = new \DateTime('now');
					$this->newOnSiteRepo->create($attributes);
				}

				$page->users()->attach(Auth::user()->userId);
				$page->groups()->attach(Auth::user()->usergroup->userGroupId);

				//super user id = 1
				if (Auth::user()->userId != 1) {
					$page->users()->attach(1);
					$page->usersView()->attach(1);
				}

				//admin group id = 1
				if (Auth::user()->usergroup->userGroupId != 1) {
					$page->groups()->attach(1);
					$page->groupsView()->attach(1);
				}

				return Redirect::route('page.show', [$page->pageId]);
			}
			return view('errors.403');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function show($id)
		{
			if($this->redirectHome($id))
			{
				return Redirect::route('home.index');
			} 

			$page = $this->pageRepo->get($id);

			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPageViewPermission($id) || Auth::user()->userGroup->hasPageViewPermission($id)) || $page->hasDistrictSection(DistrictSectionController::HOME_DISTRICT))
			{
				$children = $this->pageRepo->getAllChildren($id);
				$isAdmin = Auth::check() && $this->userRepo->isUserAdministrator(Auth::user());

				if (isset($page) && count($page)) {
					if ($isAdmin || ($page->visible && count($this->pageRepo->show($id)))) {
						if ($page->sidebar) {
							$sidebar = $this->sidebarRepo->getByPage($page->pageId);

							return view('page.show', compact('page', 'sidebar', 'children'));
						}

						return view('page.show', compact('page', 'children'));
					}

					return view('errors.pubdate');
				}
			}
			
			return view('errors.404');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function edit($id)
		{
			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPagePermission($id) || Auth::user()->userGroup->hasPagePermission($id)))
			{
				if($this->redirectHome($id))
				{
					Flash::error('U kunt de homepage niet op deze manier wijzigen.');

					return Redirect::route('home.index');
				}

				if($id === '2')
				{
					return Redirect::route('page.contactedit');
				}
				$page = $this->pageRepo->get($id);
				$pages = $this->pageRepo->getAllToList();
				$districtSections = $this->districtSectionRepo->getAllToList();

				if(isset($page))
				{
					return view('page.edit', compact('page', 'pages', 'districtSections'));
				}

				return view('errors.404');
			}
			Flash::error('U bent niet geautoriseerd om deze pagina te wijzigen.');

			return Redirect::route('page.index');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function update($id, PageRequest $request)
		{
			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPagePermission($id) || Auth::user()->userGroup->hasPagePermission($id)))
			{
				if($this->redirectHome($id))
				{
					return Redirect::route('home.index');
				}
				$old = $this->pageRepo->get($id)->sidebar;
				$new = $request->sidebar;

				// Update introduction.
				$introduction = $this->introRepo->get($request->intro_id);
				$introduction->title = $request->title;
				$introduction->subtitle = $request->subtitle;
				$introduction->text = $request->content;

				$this->introRepo->update($introduction);

				// Update the page.
				$page = $this->pageRepo->get($id);
				$page->sidebar = $request->sidebar;
				$page->publishDate = $request->publishStartDate;
				$page->publishEndDate = $request->publishEndDate;
				$page->visible = $request->visible;
				$page->parentId = $request->parent;
				$page = $this->pageRepo->update($page);
				
				$districtSections = $request->districtSection;

				$oldDistrictSections = $page->districtSections;

				foreach($oldDistrictSections as $oldDistrict)
				{
					$page->districtSections()->detach($oldDistrict);
				}

				foreach($districtSections as $district)
				{
					$page->districtSections()->attach($district);
				}

				// Delete all old panels.
				$this->pagePanelRepo->deleteAllFromPage($id);

				// Update the panels.
				if(count($request->panel) > 0)
				{
					foreach($request->panel as $pagepanel)
					{
						$panel = $this->panelRepo->getBySize($pagepanel['size']);

						$this->pagePanelRepo->create
						([
							'page_id'	=> $page->pageId,
							'title'		=> $pagepanel['title'],
							'text'		=> $pagepanel['content'],
							'panel_id'	=> $panel->panelId
						]);
					}
				}
				$pageid = $page->pageId;
				$title = $request->title;

				$this->updateSidebar($old, $new, $pageid, $title);

				$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

				if($newOnSite)
				{
					$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
					$attributes['link'] = route('page.show', $page->pageId);
					$attributes['created_at'] = new \DateTime('now');
					$this->newOnSiteRepo->create($attributes);
				}

				if($page->pageId === 3) {
					return Redirect::route('page.about');
				}

				return Redirect::route('page.show', [$page->pageId]);
			}
			Flash::error('U bent niet geautoriseerd om deze pagina te wijzigen.');

			return Redirect::route('page.index');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function destroy($id)
		{
			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPagePermission($id) || Auth::user()->userGroup->hasPagePermission($id)))
			{
				if($this->redirectHome($id) || $id === '2' || $id == '3')
				{
					Flash::error('U kunt deze pagina niet verwijderen');

					return Redirect::route('page.index');
				}
				$page = $this->pageRepo->get($id);

				if($page->sidebar)
				{
					$this->sidebarRepo->deleteAllFromPage($id);
				}
				$this->pagePanelRepo->deleteAllFromPage($id);
				$page->districtSections()->detach();
				$this->pageRepo->destroy($id);
				$this->introRepo->destroy($page->introduction->introductionId);

				return Redirect::route('page.index');
			}
			Flash::error('U bent niet geautoriseerd om deze pagina te verwijderen.');

			return Redirect::route('page.index');
		}

		/**
		 * When old is the same as $new, both are false or true.
		 * 
		 * @param  Sidebar	$old
		 * @param  Sidebar	$new
		 * @param  int		$pageId
		 * @param  string	$title
		 *
		 * @return void
		 */
		private function updateSidebar($old, $new, $pageId, $title)
		{
			if($old != $new)
			{
				if($new)
				{
					$sidebar = $this->sidebarRepo->create
					([
						'page_pageId'	=> $pageId,
						'rowNr'			=> 0,
						'title'			=> $title,
						'text'			=> 'Home',
						'extern'		=> 'false',
						'link'			=> '/'
					]);
				} 
				else 
				{
					$this->sidebarRepo->deleteAllFromPage($pageId);
				}
			}
		}

		/**
		 * Show the about page.
		 *
		 * @return Response
		 */
		public function showAbout()
		{
			return $this->show(3);
		}

		/**
		 * Method to show the contact page.
		 *
		 * @return Response
		 */
		public function contact()
		{
			$page = $this->pageRepo->get(2);

			return view('page.contact', compact('page'));
		}

		/**
		 * Handles the contactform input and sends an email to both the contact and the management.
		 *
		 * @param  ContactRequest $request
		 * 
		 * @return Response
		 */
		public function sendContact(ContactRequest $request)
		{
			$name = $request->name;
			$email = $request->email;
			$text = $request->message;
			$subject = $request->subject;

			// verification email for sender
			Mail::send('emails.contact.verify', compact('name', 'email', 'text', 'subject'), function($message) use($name, $email)
			{
				$message->to
				(	
					$email, 
					$name
				)->subject('Bevestiging contact email');

			});

			// email to bunders
			Mail::send('emails.contact.contactform', compact('name', 'email', 'text', 'subject'), function($message) use($name, $email, $subject)
			{
				$message->from($email);
				$message->to
				(	
					env('MAIL_CONTACT_ADDRESS'),
					env('MAIL_CONTACT_NAME')
				)->subject($subject);
			});
			Flash::success('Uw e-mail is succesvol verzonden.')->important();

			return Redirect::route('page.contact');
		}

		/**
		 * The method to edit the contact page
		 *
		 * @return boolean
		 */

		public function editContact(){

			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPagePermission('2')))
			{
				$introduction = $this->pageRepo->get(2)->introduction;
				$page = $this->pageRepo->get(2);
				return view('page.editcontact', compact('page','introduction'));
			}
			
			return view('errors.403');
		}

		/**
		 * The method to save the edited contact page
		 *
		 * @param IntroductionRequest 
		 *
		 * @return redirect to view
		 */

		public function editContactSave(IntroductionRequest $request){

			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPagePermission('2')))
			{
				// Update introduction.
				$introduction = $this->introRepo->get('2');
				$introduction->title = $request->title;
				$introduction->subtitle = $request->subtitle;
				$introduction->text = $request->content;

				$this->introRepo->update($introduction);
				
				$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

				if($newOnSite)
				{
					$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
					$attributes['link'] = route('page.contact');
					$attributes['created_at'] = new \DateTime('now');
					$this->newOnSiteRepo->create($attributes);
				}

				return Redirect::route('page.contact');
			}
			
			return view('errors.403');
		}


		/**
		 * RedirectHome will redirect the user if the page is the homepage.
		 * The homepage has different edit functions and a different pageview.
		 *
		 * @param  int id 
		 *
		 * @return boolean
		 */
		private function redirectHome($id)
		{
			if((int)$id === 1)
			{
				Flash::success('U bent succesvol naar de homepagina begeleid.');

				return true;
			} 
			
			return false;
		}

		/**
		 * Switches the publish state of a page.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function switchPublish($id)
		{
			if (Auth::check() && ($this->userRepo->isUserAdministrator(Auth::user()) || Auth::user()->hasPagePermission($id) || Auth::user()->userGroup->hasPagePermission($id)))
			{
				$page = $this->pageRepo->get($id);
				$page->visible ? $page->visible = false : $page->visible = true;
				$this->pageRepo->update($page);
			}
		}

		/**
		 * Get all the pages by title name.
		 *
		 * @param  String $term
		 *
		 * @return JSON
		 */
		public function getPagesByTitle($term)
		{
			$json = [];
			$json_row = [];

			$data = $this->pageRepo->getAllLikeTerm($term);

			foreach($data as $page)
			{
				$json_row['page'] = $page;
				$json_row['introduction'] = $page->introduction;
				array_push($json, $json_row);
			}
			echo json_encode($json);
		}
	}