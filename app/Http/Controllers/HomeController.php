<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IHomeLayoutRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\ISidebarRepository;

	class HomeController extends Controller 
	{
		/**
		 * Creates a new controller instance.
		 *
		 * @param IHomeLayoutRepository 	$homeLayoutRepo
	     * @param IIntroductionRepository   $introRepo
	     * @param INewsRepository        	$newsRepo
	     * @param ISidebarRepository        $sidebarRepo
		 *
		 * @return void
		 */
		public function __construct(IHomeLayoutRepository $homeLayoutRepo, IIntroductionRepository $introRepo, INewsRepository $newsRepo, ISidebarRepository $sidebarRepo)
		{
			$this->homeLayoutRepo = $homeLayoutRepo;
			$this->introRepo = $introRepo;
			$this->newsRepo = $newsRepo;
			$this->sidebarRepo = $sidebarRepo;
		}

		/**
		 * Show the application home page
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
			$news = $this->newsrepo->getAll();
			$introduction = $this->introrepo->getAll();
			$layoutModules = $this->homeLayoutrepo->getAll();

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
				$moduleIntro = $this->homeLayoutrepo->get('module-introduction');
				$moduleIntro->ordernumber = $_POST['module-introduction'];
				$moduleIntro->save();

				#news
				$moduleNews = $this->homeLayoutrepo->get('module-news');
				$moduleNews->ordernumber = $_POST['module-news'];
				$moduleNews->save();

				#sidebar
				$moduleSidebar = $this->homeLayoutrepo->get('module-sidebar');
				$moduleSidebar->ordernumber = $_POST['module-sidebar'];
				$moduleSidebar->save();

				return redirect('home.index');
			} 
		}

		/**
		 * Show the edit intro page.
		 *
		 * @return Response
		 */
		public function getEditIntro()
		{
			$data = 
			[
				'intro'=>$this->introRepo->getById(1)
			];

			return View('intro.edit', data);
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

	        $intro = $this->introrepo->getPageBar($pageId);
	        $intro->pageId = $pageId;
	        $intro->title = $title;
	        $intro->content = $content;
	        $this->introrepo->update($intro);

	     	return redirect('home.index');
		}
	}