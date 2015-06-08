<?php
	namespace App\Http\Controllers;

	use App\Http\Requests;
	use App\Http\Requests\Permissions\CreateUserGroupRequest;
	use App\Models\UserGroup;
	use App\Repositories\RepositoryInterfaces\IUserGroupRepository;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IPermissionRepository;
	use Illuminate\Http\Request;

	use Auth;
	use Redirect;


	class PermissionsController extends Controller {

		const PERMISSION_MENU = 1;
		const PERMISSION_FOOTER = 3;
		const PERMISSION_CAROUSEL = 4;
		const PERMISSION_HOMEPAGE = 5;
		const PERMISSION_PERMISSIONS = 6;
		const PERMISSION_USERS = 7;
		const PERMISSION_SIDEBAR = 8;
		const PERMISSION_NEWS = 9;

		public function __construct(IUserRepository $userRepo, IPageRepository $pageRepo, IDistrictSectionRepository $districtSectionRepo, IPermissionRepository $permissionRepo, IUserGroupRepository $userGroupRepo)
		{
			$this->userRepo = $userRepo;
			$this->pageRepo = $pageRepo;
			$this->districtSectionRepo = $districtSectionRepo;
			$this->pageRepo = $pageRepo;
			$this->permissionRepo = $permissionRepo;
			$this->userGroupRepo = $userGroupRepo;
		}

		public function index()
		{
			$userGroups = $this->userGroupRepo->getAll();
			return view('permissions.index', compact('userGroups'));
		}

		public function createUserGroup()
		{
			$userGroup = new Usergroup();
			$pages = $this->pageRepo->getAll();
			$districtSections = $this->districtSectionRepo->getAll();
			$permissions = $this->permissionRepo->getAll();
			return view('permissions.createUserGroup', compact('userGroup', 'pages', 'districtSections', 'permissions'));
		}

		public function storeUserGroup(CreateUserGroupRequest $request)
		{
			$data = $request->input();
			$userGroup = $this->userGroupRepo->create($data);

			//get posted permission strings and convert them into arrays.
			$pageSelectionString = $request->get('pageSelection');
			$pageSelectionArray = $this->stringToIntArray(json_decode($pageSelectionString, true));

			$districtSectionSelectionString = $request->get('districtSectionSelection');
			$districtSectionSelectionArray = $this->stringToIntArray(json_decode($districtSectionSelectionString, true));

			$permissionSelectionString = $request->get('permissionSelection');
			$permissionSelectionArray = $this->stringToIntArray(json_decode($permissionSelectionString, true));

			//update usergroup permissions in database.
			$userGroup->pages()->sync($pageSelectionArray);
			$userGroup->districtSections()->sync($districtSectionSelectionArray);
			$userGroup->permissions()->sync($permissionSelectionArray);

			return redirect::route('permissions.index');
		}

		public function editUserGroup($userGroupId)
		{
			$userGroup = $this->userGroupRepo->get($userGroupId);
			$pages = $this->pageRepo->getAll();
			$districtSections = $this->districtSectionRepo->getAll();
			$permissions = $this->permissionRepo->getAll();

			return view('permissions.editUserGroup', compact('userGroup', 'pages', 'districtSections', 'permissions'));
		}

		public function updateUserGroup($userGroupId, Request $request)
		{
			$userGroup = $this->userGroupRepo->get($userGroupId);

			//get posted permission strings and convert them into arrays.
			$pageSelectionString = $request->get('pageSelection');
			$pageSelectionArray = $this->stringToIntArray(json_decode($pageSelectionString, true));

			$districtSectionSelectionString = $request->get('districtSectionSelection');
			$districtSectionSelectionArray = $this->stringToIntArray(json_decode($districtSectionSelectionString, true));

			$permissionSelectionString = $request->get('permissionSelection');
			$permissionSelectionArray = $this->stringToIntArray(json_decode($permissionSelectionString, true));

			//update usergroup permissions in database.
			$userGroup->pages()->sync($pageSelectionArray);
			$userGroup->districtSections()->sync($districtSectionSelectionArray);
			$userGroup->permissions()->sync($permissionSelectionArray);

			return redirect::route('permissions.index');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function editUserPermissions($userId)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_PERMISSIONS))
			{
				$user = $this->userRepo->get($userId);
				$pages = $this->pageRepo->getAll();
				$districtSections = $this->districtSectionRepo->getAll();
				$permissions = $this->permissionRepo->getAll();

				return view('permissions.editUserPermissions', compact('user', 'pages', 'districtSections', 'permissions'));
			}

			return view('errors.403');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function updateUserPermissions($userId, Request $request)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_PERMISSIONS))
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

			return view('errors.403');
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
