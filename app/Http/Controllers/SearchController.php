<?php 
	namespace App\Http\Controllers;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Http\Requests\Search\SearchRequest;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\IPagePanelRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IUserRepository;

	class SearchController extends Controller 
	{
		/**
		 * The IIntroductionRepository implementation.
		 * 
		 * @var IIntroductionRepository
		 */
		private $introductionRepo;

		/**
		 * The INewsRepository implementation.
		 * 
		 * @var INewsRepository
		 */
		private $newsRepo;

		/**
		 * The IPagePanelRepository implementation.
		 * 
		 * @var IPagePanelRepository
		 */
		private $pagePanelRepo;

		/**
		 * The IPageRepository implementation.
		 * 
		 * @var IPageRepository
		 */
		private $pageRepo;

		/**
		 * Creates a new SearchController instance.
		 * 
		 * @param  INewsRepository	$newsRepo
		 * @param  IPageRepository	$pageRepo
		 *
		 * @return void
		 */
		public function __construct(IIntroductionRepository $introductionRepo, INewsRepository $newsRepo, 
									IPagePanelRepository $pagePanelRepo, IPageRepository $pageRepo)
		{
			$this->introductionRepo = $introductionRepo;
			$this->newsRepo = $newsRepo;
			$this->pagePanelRepo = $pagePanelRepo;
			$this->pageRepo = $pageRepo;
		}

		/**
		 * Show the results of the search query.
		 *
		 * @param  SearchRequest $request
		 * 
		 * @return Response
		 */
		public function index(SearchRequest $request)
		{
			$query = $request->get('q');

			$news = $this->newsRepo->search($query);
			$pages = $this->pageRepo->search($query);
			
			return view('search.index', compact('query', 'news', 'pages'));
		}
	}