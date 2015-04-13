<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IHomeLayoutRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\ICarouselRepository;
    use Illuminate\Support\Facades\Redirect;

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

            $news = $this->newsRepo->getAll();
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
            $news = $this->newsRepo->getAll();
            $introduction = $this->introRepo->getPageBar('1');
            $layoutModules = $this->homeLayoutRepo->getAll();

            return view('home.editLayout', compact('news', 'introduction', 'layoutModules'));
        }

        /**
         * Post the edit layout page and handle the input.
         *
         * @return Response
         */
        public function updateLayout()
        {
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
        }

        /**
         * Show the edit intro page.
         *
         * @return Response
         */
        public function editIntroduction()
        {
            $introduction = $this->introRepo->getPageBar('1');
            return view('home.editIntroduction', compact('introduction'));
        }

        /**
         * Post the edit intro page and handle the input.
         *
         * @return Response
         */
        public function updateIntroduction()
        {
            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            // nl2br is needed and used to save line breaks in the submitted text.  
            $content = nl2br(htmlentities($_POST['content'], ENT_QUOTES, 'UTF-8'));
            $pageId = $_POST['pageId'];

            $intro = $this->introRepo->getPageBar($pageId);
            $intro->pageId = $pageId;
            $intro->title = $title;
            $intro->text = $content;

            $intro->save();

            return Redirect::route('home.index');
        }
    }