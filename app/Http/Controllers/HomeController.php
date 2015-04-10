<?php namespace App\Http\Controllers;

use App\Repository\SidebarRepository;
use App\Repository\IntroductionRepository;
use App\Repository\HomeLayoutRepository;
use App\Repository\NewsRepository;


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
	 */
	public function __construct(IntroductionRepository $introrepo, HomeLayoutRepository $homeLayoutrepo, NewsRepository $newsrepo)
	{
		$this->introrepo = $introrepo;
		$this->homeLayoutrepo = $homeLayoutrepo;
		$this->newsrepo = $newsrepo;
	}

	/**
	 * Show the application dashboard to the user.
	 */
	public function getIndex()
	{
		// Sidebar will be loaded through viewcomposer.
		$news = $this->newsrepo->getAll();
		$introduction = $this->introrepo->getAll();
		$modules = $this->homeLayoutrepo->getAll();
		$data = array('news' => $news, 'intro' => $introduction, 'layoutmodules' => $modules);

		return view('home/home', $data);
	}

	public function getEditlayout(){
		$news = $this->newsrepo->getAll();
		$introduction = $this->introrepo->getAll();
		$modules = $this->homeLayoutrepo->getAll();
		$data = array('news' => $news, 'intro' => $introduction, 'layoutmodules' => $modules);

		return view('home/editlayout', $data);

	}

	public function postEditlayout(){

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

			return redirect('home/home');
		} else {
			// Something went wrong..
			
			return redirect('home/editlayout');
		}
	}

	public function getEditintro(){
		return View('intro/edit', ['intro'=>$this->introrepo->getById(1)]);
	}

	public function postEditintro(){
		$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
	    $pageId = $_POST['pageId'];

        $intro = $this->introrepo->getPageBar($pageId);
        $intro->pageId = $pageId;
        $intro->title = $title;
        $intro->content = $content;
       	$intro->save();

     	return redirect('home/home');

	}
}
