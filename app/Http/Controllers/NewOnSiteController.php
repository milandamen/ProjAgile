<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;

	class NewOnSiteController extends Controller
	{
		/**
		 * The INewOnSiteRepository implementation.
		 * 
		 * @var INewOnSiteRepository
		 */
		private $newOnSiteRepo;

		/**
		 * Creates a new NewOnSiteController instance.
		 *
		 * @param INewOnSiteRepository $newOnSiteRepo
		 *
		 * @return void
		 */
		public function __construct(INewOnSiteRepository $newOnSiteRepo)
		{
			$this->newOnSiteRepo = $newOnSiteRepo;
		}

		/**
		 * Show the new on site overview page.
		 *
		 * @return Response
		 */
		public function index()
		{
			$items = $this->newOnSiteRepo->getAll();

			return view('newOnSite.index', compact('items'));
		}
	}