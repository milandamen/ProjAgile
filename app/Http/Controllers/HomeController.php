<?php 
	namespace App\Http\Controllers;

	use App\Http\Requests\Home\IntroductionRequest;
	use App\Repositories\RepositoryInterfaces\ICarouselRepository;
	use App\Repositories\RepositoryInterfaces\IHomeLayoutRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\ISidebarRepository;
	use Auth;
	use Illuminate\Support\Facades\Redirect;
	use Request;

	class HomeController extends Controller 
	{
		/**
		 * The ICarouselRepository implementation.
		 * 
		 * @var ICarouselRepository
		 */
		private $carouselRepo;

		/**
		 * The IHomeLayoutRepository implementation.
		 * 
		 * @var IHomeLayoutRepository
		 */
		private $homeLayoutRepo;

		/**
		 * The IIntroductionRepository implementation.
		 * 
		 * @var IIntroductionRepository
		 */
		private $introductionRepo;

		/**
		 * The INewOnSiteRepository implementation.
		 * 
		 * @var INewOnSiteRepository
		 */
		private $newOnSiteRepository;

		/**
		 * The INewsRepository implementation.
		 * 
		 * @var INewsRepository
		 */
		private $newsRepo;

		/**
		 * The IPageRepository implementation.
		 * 
		 * @var IPageRepository
		 */
		private $pageRepo;

		/**
		 * The ISidebarRepository implementation.
		 * 
		 * @var ISidebarRepository
		 */
		private $sidebarRepo;

		/**
		 * Creates a new HomeController instance.
		 *
		 * @param IHomeLayoutRepository 	$homeLayoutRepo
		 * @param IIntroductionRepository   $introductionRepo
		 * @param INewsRepository        	$newsRepo
		 *
		 * @return void
		 */
		public function __construct(ICarouselRepository $carouselRepo, IHomeLayoutRepository $homeLayoutRepo, IIntroductionRepository $introductionRepo, 
									INewOnSiteRepository $newOnSiteRepository, INewsRepository $newsRepo, IPageRepository $pageRepo,
									ISidebarRepository $sidebarRepo)
		{
			$this->carouselRepo = $carouselRepo;
			$this->homeLayoutRepo = $homeLayoutRepo;
			$this->introductionRepo = $introductionRepo;
			$this->newOnSiteRepository = $newOnSiteRepository;
			$this->newsRepo = $newsRepo;
			$this->pageRepo = $pageRepo;
			$this->sidebarRepo = $sidebarRepo;
		}

		/**
		 * Show the application home page.
		 *
		 * @return Response
		 */
		public function index()
		{
			$news = $this->getNews();
			$introduction = $this->pageRepo->get(1)->introduction;
			$sidebar = $this->sidebarRepo->getByPage(1);
			htmlspecialchars($introduction);
			$layoutModules = $this->homeLayoutRepo->getAll();
			$carousel = $this->carouselRepo->getAllFiltered();
			$newOnSite = $this->newOnSiteRepository->getAllOrdered();

			return view('home.index', compact('news', 'introduction', 'sidebar', 'layoutModules', 'carousel', 'newOnSite'));
		}

		/**
		 * Show the edit layout page.
		 *
		 * @return Response
		 */
		public function editLayout()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_HOMEPAGE))
			{
				$news = $this->getNews();
				$introduction = $this->pageRepo->get(1)->introduction;
				$layoutModules = $this->homeLayoutRepo->getAll();
				$newOnSite = $this->newOnSiteRepository->getAllOrdered();
				$sidebar = $this->sidebarRepo->getByPage(1);
				
				return view('home.editLayout', compact('news', 'introduction', 'layoutModules', 'newOnSite', 'sidebar'));
			}
			
			return view('errors.403');
		}

		/**
		 * Post the edit layout page and handle the input.
		 *
		 * @return Response
		 */
		public function updateLayout()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_HOMEPAGE))
			{
				if (isset($_POST['module-introduction']) && isset($_POST['module-news']) && isset($_POST['module-sidebar'])) {
					$modules = $this->homeLayoutRepo->getAll();

					foreach ($modules as $module) {
						$module->orderNumber = $_POST[$module->moduleName];
						$module->save();
					}

					return Redirect::route('home.index');
				}

				return Redirect::route('home.editLayout');
			}
			
			return view('errors.403');
		}

		/**
		 * Show the edit intro page.
		 *
		 * @return Response
		 */
		public function editIntroduction()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_HOMEPAGE))
			{
				$introduction = $this->pageRepo->get(1)->introduction;

				return view('home.editIntroduction', compact('introduction'));
			}
			
			return view('errors.403');
		}

		/**
		 * Post the edit intro page and handle the input.
		 *
		 * @return Response
		 */
		public function updateIntroduction(IntroductionRequest $request)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_HOMEPAGE))
			{
				$intro = $this->pageRepo->get($request->pageId)->introduction;
				$intro->title = $request->title;
				$intro->subtitle = $request->subtitle;
				$intro->text = $request->content;

				$this->introductionRepo->update($intro);

				$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

				if ($newOnSite === true) {
					$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
					$attributes['link'] = route('home.index');
					$attributes['created_at'] = new \DateTime('now');
					$this->newOnSiteRepository->create($attributes);
				}

				return Redirect::route('home.index');
			}
			
			return view('errrors.403');
		} 
		
		/**
		 * Returns the five most important news items.
		 * 
		 * @return Collection -> News
		 */
		private function getNews()
		{
			$news = $this->newsRepo->getAll();
			$newsList = [];

			foreach($news as $newsItem)
			{
				if($newsItem->top)
				{
					$newsList[] = $newsItem;
				}
			}

			foreach($news as $newsItem)
			{
				if(!$newsItem->top)
				{
					$newsList[] = $newsItem;
				}
			}
			$modulenews = array_slice($newsList, 0, 5);
			
			return $modulenews;
		}
	}