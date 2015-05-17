<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;

	class NewOnSiteController extends Controller
	{

		public function __construct(INewOnSiteRepository $newOnSiteRepository)
		{
			$this->newOnSiteRepository = $newOnSiteRepository;
		}

		public function index()
		{
			$items = $this->newOnSiteRepository->getAll();

			return view('newOnSite.index', compact('items'));
		}
	}