<?php 
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;

	class DistrictSectionController extends Controller 
	{
		private $districtSectionRepo;

		/**
		 * Creates a new DistrictSection instance.
		 *
		 * @param IDistrictSectionRepository    $districtSectionRepo
		 *
		 * @return void
		 */
		public function __construct(IDistrictSectionRepository $districtSectionRepo)
		{
			$this->districtSectionRepo = $districtSectionRepo;
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{
			//
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store()
		{
			//
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * 
		 * @return Response
		 */
		public function show($id)
		{
			//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * 
		 * @return Response
		 */
		public function edit($id)
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * 
		 * @return Response
		 */
		public function update($id)
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * 
		 * @return Response
		 */
		public function destroy($id)
		{
			//
		}

		/**
		 * Get all the district sections.
		 *
		 * @return Json
		 */
		public function getDistrictSections() 
		{
			$data = $this->districtSectionRepo->getAll();

			return json_encode($data);
		}
	}