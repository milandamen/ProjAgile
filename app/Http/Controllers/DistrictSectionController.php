<?php
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
	use App\Http\Requests\DistrictSection\DistrictSectionRequest;
	use Auth;
	use Illuminate\Support\Facades\Redirect;
	use Input;
	use App\Models\DistrictSection;
	use App\Models\News;
	use Flash;

	class DistrictSectionController extends Controller
	{

		/**
		 * The DistrictSectionRepository implementation.
		 * 
		 * @var DistrictSectionRepository
		 */
		private $districtRepo;

		/**
		 * The INewOnSiteRepository implementation.
		 * 
		 * @var INewOnSiteRepository
		 */
		private $newOnSiteRepo;


		/**
		 * Creates a new DistrictSectionController instance.
		 *
		 * @param 
		 *
		 * @return void
		 */
		public function __construct(IDistrictSectionRepository $districtRepo, INewOnSiteRepository $newOnSiteRepository)
		{
			$this->districtRepo = $districtRepo;
			$this->newOnSiteRepo = $newOnSiteRepository;
		}

		public function index(){

			$districts = $this->districtRepo->getAll();
			return view('districtSection.index', compact('districts'));
		}

		public function show($name){

			if($name === 'Home'){
				Flash::error('Home is geen deelwijk maar een algemene benaming');
				return Redirect::route('home.index');
			}
			
			$district = $this->districtRepo->getByName($name);
			if(isset($district) && count($district)){
					return view('districtSection.show', compact('district'));
			}

			return view('errors.404');
		}

		public function manage(){

			$districts = $this->districtRepo->getAll();
			return view('districtSection.manage', compact('districts'));
		}

		public function create(){
			
			$district = new DistrictSection();

			return view('districtSection.create', compact('district'));
		}


		public function store(DistrictSectionRequest $request){

			$district = $this->districtRepo->create([
				'name' 			=> $request->name,
				'generalInfo' 	=> $request->text 
			]);

			$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

			if($newOnSite)
			{
				$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
				$attributes['created_at'] = new \DateTime('now');
				$this->newOnSiteRepo->create($attributes);
			}

			return Redirect::route('district.show', $district->name);

		}
		/**
		 * Show the DistrictSection edit page.
		 * 
		 * @return Response
		 */
		public function edit($id)
		{
			$district = $this->districtRepo->get($id);

			if($district->name === 'Home'){
				Flash::error('Home is geen deelwijk maar een algemene benaming');
				return Redirect::route('home.index');
			}
			return view('districtSection.edit', compact('district'));	
		}

		/**
		 * Post the DistrictSection and handle the input.
		 * 
		 * @return Response
		 */
		public function update(DistrictSectionRequest $request)
		{

			$district = $this->districtRepo->get($request->districtId);
			$district->name = $request->name;
			$district->generalInfo = $request->text;
			$this->districtRepo->update($district);

			$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

			if($newOnSite)
			{
				$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
				$attributes['created_at'] = new \DateTime('now');
				$this->newOnSiteRepo->create($attributes);
			}

			return Redirect::route('district.show', $district->name);
		}


		public function destroy(){

		}
		
	}