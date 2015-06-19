<?php
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
	use App\Repositories\RepositoryInterfaces\IAddressRepository;
	use App\Http\Requests\DistrictSection\DistrictSectionRequest;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use Auth;
	use Illuminate\Support\Facades\Redirect;
	use Input;
	use App\Models\DistrictSection;
	use App\Models\News;
	use App\Models\Page;
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
		public function __construct(IDistrictSectionRepository $districtRepo, INewOnSiteRepository $newOnSiteRepository, 
									IAddressRepository $addressRepo, IUserRepository $userRepo)
		{
			$this->districtRepo = $districtRepo;
			$this->newOnSiteRepo = $newOnSiteRepository;
			$this->addressRepo = $addressRepo;
			$this->userRepo = $userRepo;
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
				//if( (Auth::user()->hasDistrictSectionPermission($district->districtSectionId)) 
				//	|| ($this->userRepo->isUserAdministrator(Auth::user())) ) {
					
					return view('districtSection.show', compact('district'));
				//}
			}

			return view('errors.404');
		}

		public function manage(){

			if( $this->userRepo->isUserAdministrator(Auth::user()) ) {
				$districts = $this->districtRepo->getAll();
				return view('districtSection.manage', compact('districts'));
			}
			return view('errors.403');
		}

		public function create(){
			
			if( $this->userRepo->isUserAdministrator(Auth::user()) ) {
				$district = new DistrictSection();
				return view('districtSection.create', compact('district'));
			}
	
			return view('errors.403');
		}


		public function store(DistrictSectionRequest $request){

			if( $this->userRepo->isUserAdministrator(Auth::user()) ) {
				$district = $this->districtRepo->create([
					'name' 			=> $request->name,
					'generalInfo' 	=> $request->text 
				]);

				$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

				if($newOnSite)
				{
					$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
					$attributes['link'] = route('district.show', $district->name);
					$attributes['created_at'] = new \DateTime('now');
					$this->newOnSiteRepo->create($attributes);
				}

				$district->users()->attach(Auth::user()->userId);
				$district->groups()->attach(Auth::user()->usergroup->userGroupId);

				//super user id = 1
				if(Auth::user()->userId != 1)
				{
					$district->users()->attach(1);
					$district->usersView()->attach(1);
				}

				//admin group id = 1
				if(Auth::user()->usergroup->userGroupId != 1)
				{
					$district->groups()->attach(1);
					$district->groupsView()->attach(1);
				}

				return Redirect::route('district.show', $district->name);
			} 

			return view('errors.403');
		}
		/**
		 * Show the DistrictSection edit page.
		 * 
		 * @return Response
		 */
		public function edit($id)
		{
			if( (Auth::user()->hasDistrictSectionPermission($id)) 
				|| ($this->userRepo->isUserAdministrator(Auth::user())) ) {
						
				$district = $this->districtRepo->get($id);

				if($district->name === 'Home'){
					Flash::error('Home is geen deelwijk maar een algemene benaming');
					return Redirect::route('home.index');
				}
				return view('districtSection.edit', compact('district'));	
			}

			return view('errors.403');
		}

		/**
		 * Post the DistrictSection and handle the input.
		 * 
		 * @return Response
		 */
		public function update(DistrictSectionRequest $request)
		{
			if( (Auth::user()->hasDistrictSectionPermission($request->districtId)) 
				|| ($this->userRepo->isUserAdministrator(Auth::user())) ) {

				$district = $this->districtRepo->get($request->districtId);
				$district->name = $request->name;
				$district->generalInfo = $request->text;
				$this->districtRepo->update($district);

				$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

				if($newOnSite)
				{
					$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
					$attributes['link'] = route('district.show', $district->name);
					$attributes['created_at'] = new \DateTime('now');
					$this->newOnSiteRepo->create($attributes);
				}

				return Redirect::route('district.show', $district->name);
			}

			return view('errors.403');
		}


		public function destroy($id){

			if( (Auth::user()->hasDistrictSectionPermission($id)) 
				|| ($this->userRepo->isUserAdministrator(Auth::user())) ) {

				if($id === '1'){
					Flash::error('Deze deelwijk mag niet verwijderd worden')->important();
					return Redirect::route('district.manage');
				}

				$district = $this->districtRepo->get($id);

				// Reassign all news to Home
				$news = $this->districtRepo->get($id)->news;

				foreach($district->news as $new){
					$home = false;
					
					foreach($new->districtSections as $newsdistrict){
						if($newsdistrict->name === 'Home'){
							$home = true;
						}
					}

					if(!$home){
						$homedist = $this->districtRepo->get(1)->news()->attach($new->newsId);
					}
				}
				// remove all news
				$district->news()->detach();

				// remove all permissions
				$district->users()->detach();
				$district->groups()->detach();

				// reassign all adresses to Home
				$addresses = $this->addressRepo->getAll();
				foreach($addresses as $address){
					if($address->districtSectionId === $district->districtSectionId){
						$address->districtSectionId = '1';
						$this->addressRepo->update($address);
					}
				}
				
				// Reassign all pages to Home
				$pages = $this->districtRepo->get($id)->pages;

				foreach($district->pages as $page){
					$home = false;
					
					foreach($page->districtSections as $pagedistrict){
						if($pagedistrict->name === 'Home'){
							$home = true;
						}
					}

					if(!$home){
						$homedist = $this->districtRepo->get(1)->pages()->attach($page->pageId);
					}
				}
				// remove all pages
				$district->pages()->detach();

				// Delete district
				$this->districtRepo->destroy($district->districtSectionId);

				Flash::success('Deelwijk succesvol verwijderd')->important();

				return Redirect::route('district.manage');
			}

			return view('errors.403');
		}
		
	}