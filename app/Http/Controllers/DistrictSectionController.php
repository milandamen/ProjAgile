<?php
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use Auth;
	use Illuminate\Support\Facades\Redirect;
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
			return view('districtSection.index', compact('districts'));
		}

		public function show($name){
			$district = $this->districtRepo->getByName($name);
			
			if(isset($district) && count($district)){
					return view('districtSection.show', compact('district'));
			}

			return view('errors.404');
		}

		/**
		 * Show the DistrictSection edit page.
		 * 
		 * @return Response
		 */
		public function edit($id)
		{
			
		}

		/**
		 * Post the DistrictSection and handle the input.
		 * 
		 * @return Response
		 */
		public function update()
		{

		}
		
	}