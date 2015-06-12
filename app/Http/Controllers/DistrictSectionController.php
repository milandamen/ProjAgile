<?php
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use Auth;
	use Input;
	use App\Models\DistrictSection;
	use App\Models\News;

	class DistrictSectionController extends Controller
	{

		/**
		 * The DistrictSectionRepository implementation.
		 * 
		 * @var DistrictSectionRepository
		 */
		private $districtRepo;

		/**
		 * Creates a new DistrictSectionController instance.
		 *
		 * @param 
		 *
		 * @return void
		 */
		public function __construct(IDistrictSectionRepository $districtRepo)
		{
			$this->districtRepo = $districtRepo;
		}

		public function index(){

			$districts = $this->districtRepo->getAll();

