<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IHomeLayoutRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;

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
		public function __construct(IHomeLayoutRepository $homeLayoutRepo, IIntroductionRepository $introRepo, INewsRepository $newsRepo)
		{
			$this->homeLayoutRepo = $homeLayoutRepo;
			$this->introRepo = $introRepo;
			$this->newsRepo = $newsRepo;
		}

		/**
		 * Show the application home page.
		 *
		 * @return Response
		 */
		public function getIndex()
        {
            $news = $this->newsRepo->getAll();
            $introduction = $this->introRepo->getAll();
            $layoutModules = $this->homeLayoutRepo->getAll();

            return view('home.index', compact('news', 'introduction', 'layoutModules'));
        }

        /**
         * Show the edit layout page.
         *
         * @return Response
         */
        public function getEditLayout()
        {
            $news = $this->newsRepo->getAll();
            $introduction = $this->introRepo->getAll();
            $layoutModules = $this->homeLayoutRepo->getAll();

            return view('home.editLayout', compact('news', 'introduction', 'layoutModules'));
        }

        /**
         * Post the edit layout page and handle the input.
         *
         * @return Response
         */
        public function postEditLayout()
        {
            if (isset($_POST['module-introduction']) && isset($_POST['module-news']) && isset($_POST['module-sidebar']))
            {
                #intro
                $moduleIntro = $this->homeLayoutRepo->get('module-introduction');
                $moduleIntro->orderNumber = $_POST['module-introduction'];
                $this->homeLayoutRepo->update($moduleIntro);

                #news
                $moduleNews = $this->homeLayoutRepo->get('module-news');
                $moduleNews->orderNumber = $_POST['module-news'];
                $this->homeLayoutRepo->update($moduleNews);

                #sidebar
                $moduleSidebar = $this->homeLayoutRepo->get('module-sidebar');
                $moduleSidebar->orderNumber = $_POST['module-sidebar'];
                $this->homeLayoutRepo->update($moduleSidebar);

                return redirect('home.index');
            }
            else
            {
                return redirect('home.editLayout');
            }
        }

        /**
         * Show the edit intro page.
         *
         * @return Response
         */
        public function getEditIntro()
        {
            $introduction = $this->introRepo->getById(1);
            return View('intro.edit', compact('introduction'));
        }

        /**
         * Post the edit intro page and handle the input.
         *
         * @return Response
         */
        public function postEditIntro()
        {
            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
            $pageId = $_POST['pageId'];

            $intro = $this->introRepo->getPageBar($pageId);
            $intro->pageId = $pageId;
            $intro->title = $title;
            $intro->content = $content;

            $this->introRepo($intro);

            return redirect('home.home');
        }
    }