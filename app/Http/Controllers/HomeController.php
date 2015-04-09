<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IHomeLayoutRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\ISidebarRepository;

	class HomeController extends Controller 
	{

		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct(IHomeLayoutRepository $homeLayoutrepo, IIntroductionRepository $introrepo, INewsRepository $newsrepo, ISidebarRepository $sidebarrepo)
		{
			$this->homeLayoutrepo = $homeLayoutrepo;
			$this->introrepo = $introrepo;
			$this->newsrepo = $newsrepo;
			$this->sidebarrepo = $sidebarrepo;
		}

		/**
		 * Show the application home page
		 *
		 * @return Response
		 */
		public function getIndex()
		{

			$modules = $this->homeLayoutrepo->getAll();
			$introduction = $this->introrepo->getAll();
			$data = 
			[
				'news' => $this->newsrepo->getAll(), 
				'intro'=>$introduction, 
				'layoutmodules'=>$modules
			];

			return view('home.home', $data);
		}

		/**
		 * Show the edit layout page.
		 *
		 * @return Response
		 */
		public function getEditLayout(){
			
			$modules = $this->homeLayoutrepo->getAll();
			$introduction = $this->introrepo->getAll();
			$data = 
			[
				'news' => $this->newsrepo->getAll(), 
				'intro'=> $introduction, 
				'layoutmodules'=> $modules
			];

			return view('home.editlayout', $data);
		}

		/**
		 * Show the edit layout page.
		 *
		 * @return Response
		 */
		public function postEditLayout(){

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

				return redirect('home.home');
			} 
		}

		/**
		 * Show the edit layout page.
		 *
		 * @return Response
		 */
		public function getEditIntro()
		{
			$data = 
			[
				'intro'=>$this->introrepo->getById(1)
			];

			return View('intro/edit', data);
		}

		/**
		 * Show the edit layout page.
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

	     	return redirect('home.home');
		}
	}