<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IHomeLayoutRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
    use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
    use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\ICarouselRepository;
    use Illuminate\Support\Facades\Redirect;
    use App\Http\Requests\Home\IntroductionRequest;
	use Auth;
	use Request;

	class HomeController extends Controller 
	{
		/**
		 * Creates a new HomeController instance.
		 *
		 * @param IHomeLayoutRepository 	$homeLayoutRepo
	     * @param IIntroductionRepository   $introRepo
	     * @param INewsRepository        	$newsRepo
		 *
		 * @return void
		 */
		public function __construct(IHomeLayoutRepository $homeLayoutRepo, IIntroductionRepository $introRepo,
                                    INewsRepository $newsRepo, ICarouselRepository $carouselRepo, INewOnSiteRepository $newOnSiteRepository)
		{
			$this->homeLayoutRepo = $homeLayoutRepo;
			$this->introRepo = $introRepo;
			$this->newsRepo = $newsRepo;
			$this->carouselRepo = $carouselRepo;
            $this->newOnSiteRepository = $newOnSiteRepository;
		}

		/**
		 * Show the application home page.
		 *
		 * @return Response
		 */
		public function index()
        {
            $news = $this->getNews();
            $introduction = $this->introRepo->getPageBar('1');
            htmlspecialchars($introduction);
            $layoutModules = $this->homeLayoutRepo->getAll();
			$carousel = $this->carouselRepo->getAll();
            $newOnSite = $this->newOnSiteRepository->getAllOrdered();

            return view('home.index', compact('news', 'introduction', 'layoutModules', 'carousel', 'newOnSite'));
        }

        /**
         * Show the edit layout page.
         *
         * @return Response
         */
        public function editLayout()
        {
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				$news = $this->getNews();
				$introduction = $this->introRepo->getPageBar('1');
				$layoutModules = $this->homeLayoutRepo->getAll();
				$newOnSite = $this->newOnSiteRepository->getAllOrdered();

				return view('home.editLayout', compact('news', 'introduction', 'layoutModules', 'newOnSite'));
			} else {
				return view('errors.403');
			}
        }

        /**
         * Post the edit layout page and handle the input.
         *
         * @return Response
         */
        public function updateLayout()
        {
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				if (isset($_POST['module-introduction']) && isset($_POST['module-news']) && isset($_POST['module-sidebar']))
				{
					$modules = $this->homeLayoutRepo->getAll();
					foreach ($modules as $module) {
						$module->orderNumber = $_POST[$module->moduleName];
						$module->save();
					}

					return Redirect::route('home.index');
				}
				else
				{
					return Redirect::route('home.editLayout');
				}
			} else {
				return view('errors.403');
			}
        }

        /**
         * Show the edit intro page.
         *
         * @return Response
         */
        public function editIntroduction()
        {
			if (Auth::check() && (Auth::user()->usergroup->name === 'Administrator'  || Auth::user()->usergroup->name === 'Content Beheerder')) {
				$introduction = $this->introRepo->getPageBar('1');
				return view('home.editIntroduction', compact('introduction'));
			} else {
				return view('errors.403');
			}
        }

        /**
         * Post the edit intro page and handle the input.
         *
         * @return Response
         */
        public function updateIntroduction(IntroductionRequest $request)
        {
			if (Auth::check() && (Auth::user()->usergroup->name === 'Administrator'  || Auth::user()->usergroup->name === 'Content Beheerder')) {

				$intro = $this->introRepo->getPageBar($request->pageId);
				$intro->pageId = $request->pageId;
				$intro->title = $request->title;
				$intro->text = $request->content;

				$this->introRepo->update($intro);

                $newOnSite = filter_var($_POST['toNewOnSite'], FILTER_VALIDATE_BOOLEAN);

                if($newOnSite === true)
                {
                    $attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
                    $attributes['created_at'] = new \DateTime('now');

                    $this->newOnSiteRepository->create($attributes);
                }

				return Redirect::route('home.index');
			} else {
				return view('errrors/403');
			}
        }
		
		/**
         * Show the results of the search query.
         *
         * @return Response
         */
		public function search(Request $request) {
			
			// TODO search results.
			return view('errors/404');
		}
		

        private function getNews(){
        	$news = $this->newsRepo->getAll();
        	$newsList = array();

        	foreach($news as $newsItem){
        		if($newsItem->top){
        			$newsList[] = $newsItem;
        		}
        	}

        	foreach($news as $newsItem){
        		if(!$newsItem->top){
        			$newsList[] = $newsItem;
        		}
        	}

        	$modulenews = array_slice($newsList, 0, 5);
        	
        	return $modulenews;

        }
    }
