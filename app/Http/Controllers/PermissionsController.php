<?php
	namespace App\Http\Controllers;

	use App\Http\Requests;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IPermissionRepository;
	use Illuminate\Http\Request;

	use Auth;
	use Redirect;


	class PermissionsController extends Controller {

		public function __construct(IUserRepository $userRepo, IPageRepository $pageRepo, IDistrictSectionRepository $districtSectionRepo, IPermissionRepository $permissionRepo)
		{
			$this->userRepo = $userRepo;
			$this->pageRepo = $pageRepo;
			$this->districtSectionRepo = $districtSectionRepo;
			$this->pageRepo = $pageRepo;
			$this->permissionRepo = $permissionRepo;
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
			$permissions = $this->permissionRepo->getAll();

			return view('permissions.editUserPermissions', compact('user', 'pages', 'districtSections', 'permissions'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function updateUserPermissions($userId, Request $request)
		{
			//get posted strings and convert them into arrays.
			$pageSelectionString = $request->get('pageSelection');
			$pageSelectionArray = $this->stringToIntArray(json_decode($pageSelectionString, true));

			$districtSectionSelectionString = $request->get('districtSectionSelection');
			$districtSectionSelectionArray = $this->stringToIntArray(json_decode($districtSectionSelectionString, true));

			$permissionSelectionString = $request->get('permissionSelection');
			$permissionSelectionArray = $this->stringToIntArray(json_decode($permissionSelectionString, true));

			//update database
			$user = $this->userRepo->get($userId);
			$user->pages()->sync($pageSelectionArray);
			$user->districtSections()->sync($districtSectionSelectionArray);
			$user->permissions()->sync($permissionSelectionArray);

			return redirect::route('user.index');
		}

		/**
		 * Convert array of strings to array of ints
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
