<?php
	namespace App\Http\Controllers;

	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use Illuminate\Http\Request;
	use App\Models\User;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use Auth;


	class PermissionsController extends Controller {

		public function __construct(IUserRepository $userRepo, IPageRepository $pageRepo, IDistrictSectionRepository $districtSectionRepo)
		{
			$this->userRepo = $userRepo;
			$this->pageRepo = $pageRepo;
			$this->districtSectionRepo = $districtSectionRepo;
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function editUserPermissions($userId)
		{
			$user = $this->userRepo->get($userId);
			$pages = $this->pageRepo->getAll();
			$districtSections = $this->districtSectionRepo->getAll();

			return view('permissions.editUserPermissions', compact('user', 'pages', 'districtSections'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function updateUserPermissions($userId, Request $request)
		{
			$pageSelectionString = $request->get('pageSelection');
			$pageSelectionArray = $this->stringToIntArray(json_decode($pageSelectionString, true));

			$districtSectionSelectionString = $request->get('districtSectionSelection');
			$districtSectionSelectionArray = $this->stringToIntArray(json_decode($districtSectionSelectionString, true));

			$otherSelectionString = $request->get('otherSelection');
			$otherSelectionArray = json_decode($otherSelectionString, true);

			var_dump($pageSelectionArray);
			var_dump($districtSectionSelectionArray);
			var_dump($otherSelectionArray);

			return 'updated user permissions';
		}

		/**
		 * Convert array of string to array of ints
		 *
		 * @param $stringArray
		 * @return array
		 */
		private function stringToIntArray($stringArray)
		{
			$intArray = [];
			foreach($stringArray as $string)
			{
				$intArray[] = (int)$string;
			}
			return $intArray;
		}

	}
