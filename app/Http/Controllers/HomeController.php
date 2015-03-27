<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(SidebarRepository $sidebarrepo, IntroductionRepository $introrepo, HomeLayoutRepo $homeLayoutrepo, NewsRepository $newsrepo)
	{
		$this->sidebarrepo = $sidebarrepo;
		$this->introrepo = $introrepo;
		$this->homeLayoutrepo = $homeLayoutrepo;
		$this->newsrepo = $newsrepo;

		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$modules = $this->homeLayoutrepo->getAll();
		$sidebarData = $this->sidebarrepo->getAll();
		$introduction = $this->introrepo->getAll();
		$data = array('news' => $this->newsrepo->getAll(), 'intro'=>$introduction, 'layoutmodules'=>$modules, 'sidebarRows'=>$sidebar);

		return view('home', $data);
	}

	public function getEditLayout(){
		
		$modules = $this->homeLayoutrepo->getAll();
		$sidebarData = $this->sidebarrepo->getAll();
		$introduction = $this->introrepo->getAll();
		$data = array('news' => $this->newsrepo->getAll(), 'intro'=>$introduction, 'layoutmodules'=>$modules, 'sidebarRows'=>$sidebar);

		return view('home/editlayout', $data);

	}

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

			return redirect('home');
		} else {
			// Niet alles is goed gegaan.
		}
	}

	public function getEditIntro(){
		return View('intro/edit', ['intro'=>$this->introrepo->getById(1)]);
	}

	public function postEditIntro(){
		$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
	    $pageId = $_POST['pageId'];

        $intro = $this->introrepo->getPageBar($pageId);
        $intro->pageId = $pageId;
        $intro->title = $title;
        $intro->content = $content;
       	$intro->save();

     	return redirect('home');

	}
}
