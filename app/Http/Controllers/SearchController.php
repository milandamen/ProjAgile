<?php 
	namespace App\Http\Controllers;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Http\Requests\Search\SearchRequest;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;

	class SearchController extends Controller 
	{
		/**
		 * The INewsRepository implementation.
		 * 
		 * @var INewsRepository
		 */
		private $newsRepo;

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
		public function __construct(INewsRepository $newsRepo, IPageRepository $pageRepo)
		{
			$this->newsRepo = $newsRepo;
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
			$query = $request->get('query');

			return view('search.index', compact('query'));
		}
	}