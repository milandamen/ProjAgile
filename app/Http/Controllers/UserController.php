<?php
	namespace App\Http\Controllers;

	use App\Http\Requests\User\CreateUserRequest;
	use App\Http\Requests\User\UpdateUserRequest;
	use App\Models\User;
	use App\Repositories\RepositoryInterfaces\IAddressRepository;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IHouseNumberRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IPermissionRepository;
	use App\Repositories\RepositoryInterfaces\IPostalRepository;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use App\Repositories\RepositoryInterfaces\IUserGroupRepository;
	use Auth;
	use Redirect;
	use Request;
	use View;
	use Hash;

	class UserController extends Controller
	{
		private $addressRepo;
		private $houseNumberRepo;
		private $userRepo;
		private $userGroupRepo;
		private $postalRepo;
		const ADMIN_GROUP_ID = 1;
		const CONTENT_GROUP_ID = 2;
		const RESIDENT_GROUP_ID = 3;

		public function __construct(IAddressRepository $addressRepo, IDistrictSectionRepository $districtSectionRepo, IHouseNumberRepository $houseNumberRepo,
									IUserRepository $userRepo, IUserGroupRepository $userGroupRepo, IPostalRepository $postalRepo,
									IPageRepository $pageRepo, IPermissionRepository $permissionRepo)
		{
			$this->addressRepo = $addressRepo;
			$this->houseNumberRepo = $houseNumberRepo;
			$this->userRepo = $userRepo;
			$this->userGroupRepo = $userGroupRepo;
			$this->postalRepo = $postalRepo;
			$this->pageRepo = $pageRepo;
			$this->districtSectionRepo = $districtSectionRepo;
			$this->permissionRepo = $permissionRepo;
		}

		public function index()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS))
			{
				$admins = $this->userRepo->getAllByUserGroup(self::ADMIN_GROUP_ID);
				$contentmanagers = $this->userRepo->getAllByUserGroup(self::CONTENT_GROUP_ID);
				$residents = $this->userRepo->getAllByUserGroup(self::RESIDENT_GROUP_ID);

				return view('user.index', compact('admins', 'contentmanagers', 'residents'));
			}
			return view('errors.403');
		}

		public function create()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS))
			{
				$user = new User();
				$userGroups = $this->userGroupRepo->getAll()->lists('name', 'userGroupId');

				return view('user.create', compact('user', 'userGroups'));
			}
			return view('errors.403');
		}

		public function store(CreateUserRequest $userRequest)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS))
			{
				$data = $userRequest->input();
				$user = $this->userRepo->create($data);

				//grant admins all permissions
				if($user !== null && (int)$user->userGroupId === self::ADMIN_GROUP_ID)
				{
					$this->grantAllPermissions($user->userId);
				}
				return redirect::route('user.index');
			}
			return view('errors.403');
		}

		public function edit($id)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS))
			{
				$user = $this->userRepo->get($id);
				$userGroups = $this->userGroupRepo->getAll()->lists('name', 'userGroupId');
				$postal = '';
				$houseNumber = '';
				$suffix = '';

				if ($user->addressId !== null)
				{
					$address = $this->addressRepo->get($user->addressId);

					$postal = $address->postal->code;
					$houseNumber = $address->houseNumber->houseNumber;
					$suffix = $address->houseNumber->suffix;
				}

				return view('user.edit', compact('user', 'userGroups', 'postal', 'houseNumber', 'suffix'));
			}
			return view('errors.403');
		}

		public function update(UpdateUserRequest $userRequest, $id = null)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS))
			{
				$user = ($id === null ? $this->userRepo->get(Auth::user()->userId) : $this->userRepo->get($id));
				
				$data = $userRequest->all();
				$oldUserGroupId = $user->userGroupId;

				$user->fill($data);

				//only change password when given. If the field is emtpy the password need not be changed.
				if ($userRequest->get('password') !== '')
				{
					$user->password =  Hash::make($userRequest->get('password'));
				}

				if ($userRequest->get('postal') !== '' || 
					$userRequest->get('houseNumber') !== '')
				{
					$postalId = $this->postalRepo->getByCode($attributes['postal'])->postalId;
					$houseNumberId = $this->houseNumberRepo->getByHouseNumberSuffix($attributes['houseNumber'], $attributes['suffix'] ? : null)->houseNumberId;
					$addressId = $this->addressRepo->getByPostalHouseNumber($postalId, $houseNumberId)->addressId;
					$postal = $this->postalRepo->getByCode($userRequest->get('postal'));
					//$user->postalId = $postal->postalId;
				}
				else
				{
					//$user->postalId = null;
				}

				$attributes['addressId'] = $addressId;
				$this->userRepo->update($user);

				//grant admins all permissions
				if ((int)$user->userGroupId === self::ADMIN_GROUP_ID && $oldUserGroupId !== self::ADMIN_GROUP_ID)
				{
					$this->grantAllPermissions($id);
				}

				if ($id === null)
				{
					return redirect::route('user.showProfile');
				}
				return redirect::route('user.index');
			}
			return view('errors.403');
		}

		public function show($id)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS))
			{
				$user = $this->userRepo->get($id);
				$postal = '';
				if ($user->postalId !== null)
				{
					$postal = $this->postalRepo->getById($user->postalId)->code;
				}

				if($user != null)
				{
					return view('user.show', compact('user', 'postal'));
				}
				else
				{
					return view('errors.404');
				}
			}
			return view('errors.403');
		}

		public function deactivate($id)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS))
			{
				$user = $this->userRepo->get($id);
				$user->active = false;
				$this->userRepo->update($user);

				return redirect::route('user.index');
			}
			return view('errors.403');
		}

		public function activate($id)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS))
			{
				$user = $this->userRepo->get($id);
				$user->active = true;
				$this->userRepo->update($user);

				return redirect::route('user.index');
			}
			return view('errors.403');
		}

		//personal profile functions
		public function showProfile()
		{
			if (Auth::check())
			{
				$user = $this->userRepo->get(Auth::user()->userId);
				if ($user->postalId !== null)
				{
					$postal = $this->postalRepo->getById($user->postalId)->code;
				}
				return view('user.showProfile', compact('user', 'postal'));
			}
			return view('errors.401');
		}

		public function editProfile()
		{
			if (Auth::check())
			{
				$user = $this->userRepo->get(Auth::user()->userId);
				$postal = '';
				if ($user->postalId !== null)
				{
					$postal = $this->postalRepo->getById($user->postalId)->code;
				}
				return view('user.editProfile', compact('user', 'postal'));
			}
			return view('errors.401');
		}
		//end personal profile functions

		/**
		 * Grant the given user all permissions
		 *
		 * @param $userId
		 * @return Response
		 */
		private function grantAllPermissions($userId)
		{
			$user = $this->userRepo->get($userId);

			$pages = $this->pageRepo->getAllIds();
			$districtSections = $this->districtSectionRepo->getAllIds();
			$permissions = $this->permissionRepo->getAllIds();

			$user->pages()->sync($pages);
			$user->districtSections()->sync($districtSections);
			$user->permissions()->sync($permissions);
		}

	}