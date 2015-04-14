<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IHomeLayoutRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\ICarouselRepository;
    use Illuminate\Support\Facades\Redirect;
	use Auth;

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
		public function __construct(IHomeLayoutRepository $homeLayoutRepo, IIntroductionRepository $introRepo, INewsRepository $newsRepo, ICarouselRepository $carouselRepo)
		{
			$this->homeLayoutRepo = $homeLayoutRepo;
			$this->introRepo = $introRepo;
			$this->newsRepo = $newsRepo;
			$this->carouselRepo = $carouselRepo;
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
            $layoutModules = $this->homeLayoutRepo->getAll();
			$carousel = $this->carouselRepo->getAll();

            return view('home.index', compact('news', 'introduction', 'layoutModules', 'carousel'));
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

				return view('home.editLayout', compact('news', 'introduction', 'layoutModules'));
			} else {
				echo 'U heeft geen rechten om op deze pagina te komen.';
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
				echo 'U heeft geen rechten om op deze pagina te komen.';
			}
        }

        /**
         * Show the edit intro page.
         *
         * @return Response
         */
        public function editIntroduction()
        {
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				$introduction = $this->introRepo->getPageBar('1');
				return view('home.editIntroduction', compact('introduction'));
			} else {
				echo 'U heeft geen rechten om op deze pagina te komen.';
			}
        }

        /**
         * Post the edit intro page and handle the input.
         *
         * @return Response
         */
        public function updateIntroduction()
        {
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);  
				$content = filter_var($_POST['content'],FILTER_SANITIZE_STRING);
				$pageId = $_POST['pageId'];

				$intro = $this->introRepo->getPageBar($pageId);
				$intro->pageId = $pageId;
				$intro->title = $title;
				$intro->text = $content;

				$intro->save();

				return Redirect::route('home.index');
			} else {
				echo 'U heeft geen rechten om op deze pagina te komen.';
			}
        }


        public function getNews(){
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