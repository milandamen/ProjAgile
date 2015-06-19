<?php
	namespace App\Http\Controllers;

	use App\Http\Requests;
	use App\Http\Requests\Permissions\CreateUserGroupRequest;
	use App\Http\Requests\Permissions\UpdateUserGroupRequest;
	use App\Models\UserGroup;
	use App\Repositories\RepositoryInterfaces\IAddressRepository;
	use App\Repositories\RepositoryInterfaces\IUserGroupRepository;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IPermissionRepository;
	use Auth;
	use Illuminate\Http\Request;
	use Redirect;

	class PermissionsController extends Controller 
	{
		const PERMISSION_MENU			= 1;
		const PERMISSION_FOOTER			= 3;
		const PERMISSION_CAROUSEL		= 4;
		const PERMISSION_HOMEPAGE		= 5;
		const PERMISSION_PERMISSIONS	= 6;
		const PERMISSION_USERS			= 7;
		const PERMISSION_SIDEBAR		= 8;
		const PERMISSION_NEWS			= 9;
		const PERMISSION_PAGE			= 10;

		const RESIDENT_USERGROUP = 3;

		/**
		 * The IDistrictSectionRepository implementation.
		 * 
		 * @var IDistrictSectionRepository
		 */
		private $districtSectionRepo;

		/**
		 * The IPageRepository implementation.
		 * 
		 * @var IPageRepository
		 */
		private $pageRepo;
		
		/**
		 * The IPermissionRepository implementation.
		 * 
		 * @var IPermissionRepository
		 */
		private $permissionRepo;

		/**
		 * The IUserRepository implementation.
		 * 
		 * @var IUserRepository
		 */
		private $userRepo;

		/**
		 * Creates a new PermissionController instance.
		 *
		 * @param  IUserRepository				$userRepo
		 * @param  IPageRepository				$pageRepo
		 * @param  IDistrictSectionRepository	$districtSectionRepo
		 * @param  IPermissionRepository		$permissionRepo
		 * @param  IUserGroupRepository			$userGroupRepo
		 * @param  IAddresssRepository			$addressRepo
		 *
		 * @return void
		 */
		public function __construct(IUserRepository $userRepo, IPageRepository $pageRepo, IDistrictSectionRepository $districtSectionRepo, IPermissionRepository $permissionRepo, IUserGroupRepository $userGroupRepo, IAddressRepository $addressRepo)
		{
			$this->userRepo = $userRepo;
			$this->pageRepo = $pageRepo;
			$this->districtSectionRepo = $districtSectionRepo;
			$this->permissionRepo = $permissionRepo;
			$this->userGroupRepo = $userGroupRepo;
			$this->addressRepo = $addressRepo;
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

		public function deleteUserGroup($userGroupId)
		{
			if($userGroupId != 1 && $userGroupId != 2 && $userGroupId != 3)
			{
				$users = $this->userRepo->getAllByUserGroup($userGroupId);
				foreach($users as $user)
				{
					$user->userGroupId = 3;
					$user->save();
				}
				$userGroup = $this->userGroupRepo->get($userGroupId);
				$userGroup->districtSections()->detach();
				$userGroup->pages()->detach();
				$userGroup->permissions()->detach();
				$userGroup->delete();
			}

			return redirect::route('permissions.index');
		}

		public function storeUserGroup(CreateUserGroupRequest $request)
		{
			$data = $request->input();
			$userGroup = $this->userGroupRepo->create($data);

			$this->updateDatabasePermissions($request, $userGroup);

			return redirect::route('permissions.index');
		}

		public function editUserGroup($userGroupId)
		{
			if($userGroupId != 1 && $userGroupId != 3)
			{
				$userGroup = $this->userGroupRepo->get($userGroupId);
				$pages = $this->pageRepo->getAll();
				$districtSections = $this->districtSectionRepo->getAll();
				$permissions = $this->permissionRepo->getAll();
				$selectedDistrictSections = $this->getSelectedDistrictSections($userGroupId);

				return view('permissions.editUserGroup', compact('userGroup', 'pages', 'districtSections', 'permissions', 'selectedDistrictSections'));
			}

			return redirect::route('permissions.index');
		}

		public function updateUserGroup($userGroupId, UpdateUserGroupRequest $request)
		{
			if($userGroupId != 1)
			{
				$userGroup = $this->userGroupRepo->get($userGroupId);
				$userGroup->name = $request->get('name');
				$this->userGroupRepo->update($userGroup);

				$this->updateDatabasePermissions($request, $userGroup);

				//get the removed district sections and reset usergroups.
				$oldSelectedDistrictSections = json_decode($request->get('selectedDistrictSections'));

				$districtSectionUserSelectionString = $request->get('districtSectionUserSelection');
				$districtSectionUserSelectionArray = $this->stringToIntArray(json_decode($districtSectionUserSelectionString, true));

				$difference = array_diff($oldSelectedDistrictSections, $districtSectionUserSelectionArray);

				$this->resetUserGroups($difference);
			}


			return redirect::route('permissions.index');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function editUserPermissions($userId)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_PERMISSIONS))
			{
				if($userId != 1)
				{
					$user = $this->userRepo->get($userId);
					$pages = $this->pageRepo->getAll();
					$districtSections = $this->districtSectionRepo->getAll();
					$permissions = $this->permissionRepo->getAll();

					return view('permissions.editUserPermissions', compact('user', 'pages', 'districtSections', 'permissions'));
				}
				return redirect::route('user.index');
			}

			return view('errors.403');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function updateUserPermissions($userId, Request $request)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_PERMISSIONS))
			{
				if($userId != 1)
				{
					$user = $this->userRepo->get($userId);

					$this->updateDatabasePermissions($request, $user);
				}

				return redirect::route('user.index');
			}

			return view('errors.403');
		}

		/**
		 * Convert array of strings to array of ints
		 *
		 * @param  array() $stringArray
		 * 
		 * @return array()
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

		/**
		 * Assign users with the given districtSectionIds to given userGroup
		 *
		 * @param array $districtSectionIds
		 * @param int $userGroupId
		 * @return Response
		 */
		private function setUserGroups($districtSectionIds, $userGroupId)
		{
			foreach($districtSectionIds as $districtSectionId)
			{
				$districtSectionUsers = $this->userRepo->getAllByDistrictSection($districtSectionId);

				foreach($districtSectionUsers as $districtSectionUser)
				{
					$districtSectionUser->userGroupId = $userGroupId;
					$this->userRepo->update($districtSectionUser);
				}
			}
		}

		/**
		 * Reset the user groups of users with the given districtSectionIds
		 *
		 * @param array $districtSectionIds
		 * @return Response
		 */
		private function resetUserGroups($districtSectionIds)
		{
			foreach($districtSectionIds as $districtSectionId)
			{
				$districtSectionUsers = $this->userRepo->getAllByDistrictSection($districtSectionId);

				foreach($districtSectionUsers as $districtSectionUser)
				{
					$districtSectionUser->userGroupId = self::RESIDENT_USERGROUP;
					$this->userRepo->update($districtSectionUser);
				}
			}
		}

		/**
		 * Loop through district sections to determine if all of the users under the district section are part of the given user group.
		 * If so, the district section is considered selected for this user group.
		 *
		 * @param int $userGroupId
		 * @return array $selectedDistrictSections
		 */
		private function getSelectedDistrictSections($userGroupId)
		{
			$selectedDistrictSections = [];
			$districtSectionIds = $this->districtSectionRepo->getAll()->lists('districtSectionId');
			$selected = true;

			foreach($districtSectionIds as $districtSectionId)
			{
				$districtSectionUsers = $this->userRepo->getAllByDistrictSection($districtSectionId);

				if (count($districtSectionUsers) !== 0)
				{
					foreach($districtSectionUsers as $districtSectionUser)
					{
						if ($districtSectionUser->userGroupId !== (int)$userGroupId)
						{
							$selected = false;
						}
					}

					if ($selected)
					{
						$selectedDistrictSections[] = $districtSectionId;
					}
				}

				$selected = true;
			}

			return $selectedDistrictSections;
		}

		private function updateDatabasePermissions($request, $model)
		{
			//get posted strings and convert them into arrays.
			$pageSelectionString = $request->get('pageSelection');
			$pageSelectionArray = $this->stringToIntArray(json_decode($pageSelectionString, true));

			$districtSectionSelectionString = $request->get('districtSectionSelection');
			$districtSectionSelectionArray = $this->stringToIntArray(json_decode($districtSectionSelectionString, true));

			$permissionSelectionString = $request->get('permissionSelection');
			$permissionSelectionArray = $this->stringToIntArray(json_decode($permissionSelectionString, true));

			//view permissions
			$pageViewSelectionString = $request->get('pageViewSelection');
			$pageViewSelectionArray = $this->stringToIntArray(json_decode($pageViewSelectionString, true));

			$districtSectionViewSelectionString = $request->get('districtSectionViewSelection');
			$districtSectionViewSelectionArray = $this->stringToIntArray(json_decode($districtSectionViewSelectionString, true));

			//assign users to user group
			if ($request->get('districtSectionUserSelection') !== null)
			{
				$districtSectionUserSelectionString = $request->get('districtSectionUserSelection');
				$districtSectionUserSelectionArray = $this->stringToIntArray(json_decode($districtSectionUserSelectionString, true));

				$this->setUserGroups($districtSectionUserSelectionArray, $model->userGroupId);
			}

			//update database
			$model->pages()->sync($pageSelectionArray);
			$model->districtSections()->sync($districtSectionSelectionArray);
			$model->permissions()->sync($permissionSelectionArray);

			//view permissions
			$model->pageViews()->sync($pageViewSelectionArray);
			$model->districtSectionViews()->sync($districtSectionViewSelectionArray);
		}
	}