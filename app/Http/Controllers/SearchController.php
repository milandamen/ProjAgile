<?php 
	namespace App\Http\Controllers;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Http\Requests\Search\SearchRequest;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\IPagePanelRepository;
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
		 * Creates a new SearchController instance.
		 * 
		 * @param  INewsRepository	$newsRepo
		 * @param  IPageRepository	$pageRepo
		 *
		 * @return void
		 */
		public function __construct(IIntroductionRepository $introductionRepo, INewsRepository $newsRepo, IPagePanelRepository $pagePanelRepo)
		{
			$this->introductionRepo = $introductionRepo;
			$this->newsRepo = $newsRepo;
			$this->pagePanelRepo = $pagePanelRepo;
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
			$introductions = $this->introductionRepo->search($query);
			$pagePanels = $this->pagePanelRepo->search($query);
			$pages = compact('introductions', 'pagePanels');

			$categories = compact('news', 'pages');

			return view('search.index', compact('query', 'categories'));
		}
	}