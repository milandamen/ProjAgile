<?php
	namespace App\Http\Controllers;

	use App\Http\Requests\User\UserRequest;
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
	use Hash;
	use Redirect;
	use Request;
	use View;
	
	class UserController extends Controller
	{
		const ADMIN_GROUP_ID 	= 1;
		const CONTENT_GROUP_ID 	= 2;
		const RESIDENT_GROUP_ID = 3;

		/**
		 * The IAddressRepository implementation.
		 * 
		 * @var IAddressRepository
		 */
		private $addressRepo;

		/**
		 * The IDistrictSectionRepository implementation.
		 * 
		 * @var IDistrictSectionRepository
		 */
		private $districtSectionRepo;

		/**
		 * The IHouseNumberRepository implementation.
		 * 
		 * @var IHouseNumberRepository
		 */
		private $houseNumberRepo;

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
		 * The IPostalRepository implementation.
		 * 
		 * @var IPostalRepository
		 */
		private $postalRepo;

		/**
		 * The IUserGroupRepository implementation.
		 * 
		 * @var IUserGroupRepository
		 */
		private $userGroupRepo;

		/**
		 * The IUserRepository implementation.
		 * 
		 * @var IUserRepository
		 */
		private $userRepo;
		
		/**
		* Creates a new UserController instance.
		*
		* @param  IAddressRepository 			$addressRepo
		* @param  IDistrictSectionRepository 	$districtSectionRepo
		* @param  IHouseNumberRepository 		$houseNumberRepo
		* @param  IPageRepository 				$pageRepo
		* @param  IPermissionRepository 		$permissionRepo
		* @param  IPostalRepository 			$postalRepo
		* @param  IUserGroupRepository 			$userGroupRepo
		* @param  IUserRepository 				$userRepo
		*
		* @return void
		*/
		public function __construct(IAddressRepository $addressRepo, IDistrictSectionRepository $districtSectionRepo, IHouseNumberRepository $houseNumberRepo,
									IPageRepository $pageRepo, IPermissionRepository $permissionRepo, IPostalRepository $postalRepo,
									IUserGroupRepository $userGroupRepo, IUserRepository $userRepo)
		{
			$this->addressRepo 			= $addressRepo;
			$this->districtSectionRepo 	= $districtSectionRepo;
			$this->houseNumberRepo 		= $houseNumberRepo;
			$this->pageRepo 			= $pageRepo;
			$this->permissionRepo 		= $permissionRepo;
			$this->postalRepo 			= $postalRepo;
			$this->userGroupRepo 		= $userGroupRepo;
			$this->userRepo 			= $userRepo;
		}

		/**
		 * Show the user overview page.
		 *
		 * @return Response
		 */
		public function index()
		{
			if(Auth::check() && (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_USERS)))
			{
				$admins = $this->userRepo->getAllByUserGroup(self::ADMIN_GROUP_ID);
				$contentmanagers = $this->userRepo->getAllByUserGroup(self::CONTENT_GROUP_ID);
				$residents = $this->userRepo->getAllByUserGroup(self::RESIDENT_GROUP_ID);

				return view('user.index', compact('admins', 'contentmanagers', 'residents'));
			}

			return view('errors.403');
		}

		/**
		 * Show the create user page.
		 *
		 * @return Response
		 */
		public function create()
		{
			if(Auth::check() && (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_USERS)))
			{
				$user = new User();
				$userGroups = $this->userGroupRepo->getAllToList();

				return view('user.create', compact('user', 'userGroups'));
			}

			return view('errors.403');
		}

		/**
		 * Stores the created user in the database.
		 * 
		 * @param  UserRequest $request
		 * 
		 * @return Response
		 */
		public function store(UserRequest $request)
		{
			if(Auth::check() && (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_USERS)))
			{
				$data = $request->all();
				$user = $this->userRepo->create($data);

				// Grant admins all permissions
				if($user !== null && $user->userGroupId === self::ADMIN_GROUP_ID)
				{
					$this->grantAllPermissions($user->userId);
				}

				return Redirect::route('user.index');
			}

			return view('errors.403');
		}

		/**
		 * Show the user.
		 *
		 * @return Response
		 */
		public function show($id)
		{
			if(Auth::check() && (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_USERS)))
			{
				$user = $this->userRepo->get($id);

				if($user->addressId !== null)
				{
					$address = $this->addressRepo->get($user->addressId);
					$districtSection = $address->districtSection;
					$postal = $this->postalRepo->get($address->postalId);
					$houseNumber = $this->houseNumberRepo->get($address->houseNumberId);
				}

				if(isset($user) && !empty($user))
				{
					return view('user.show', compact('user', 'districtSection', 'postal', 'houseNumber'));
				}
				
				return view('errors.404');
			}

			return view('errors.403');
		}

		/**
		 * Show the edit user page.
		 *
		 * @return Response
		 */
		public function edit($id)
		{
			if(Auth::check() && (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_USERS)) && (int)$id !== Auth::user()->userId)
			{
				$user = $this->userRepo->get($id);
				$userGroups = $this->userGroupRepo->getAllToList();

				if($user->addressId !== null)
				{
					$address = $this->addressRepo->get($user->addressId);
					$postal = $this->postalRepo->get($address->postalId);
					$houseNumber = $this->houseNumberRepo->get($address->houseNumberId);
				}

				return view('user.edit', compact('user', 'userGroups', 'postal', 'houseNumber'));
			}

			return view('errors.403');
		}

		/**
		 * Updates the existing user in the database.
		 * 
		 * @param  UserRequest	$request
		 * @param  int			$id
		 * 
		 * @return Response
		 */
		public function update(UserRequest $request, $id = null)
		{
			if(Auth::check() && (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_USERS)))
			{
				$user = ($id === null ? Auth::user() : $this->userRepo->get($id));
				
				$data = $request->only
				(
					'firstName',
					'insertion',
					'surname',
					'email'
				);

				if($user->userId !== Auth::user()->userId)
				{
					$data += $request->only
					(
						'username',
						'userGroupId'
					);
				}
				$oldUserGroupId = $user->userGroupId;
				$user->fill($data);

				// Only change password when given. If the field is emtpy the password need not be changed.
				if($request->get('password') !== '')
				{
					$user->password = Hash::make($request->get('password'));
				}

				if($user->userId !== Auth::user()->userId)
				{
					if($request->get('postal') !== '' || $request->get('houseNumber') !== '')
					{
						$postalId = $this->postalRepo->getByCode($request->get('postal'))->postalId;
						$houseNumberId = $this->houseNumberRepo->getByHouseNumberSuffix($request->get('houseNumber'), $request->get('suffix') ? : null)->houseNumberId;
						$addressId = $this->addressRepo->getByPostalHouseNumber($postalId, $houseNumberId)->addressId;

						$user->addressId = $addressId;
					}
				}
				$this->userRepo->update($user);

				// Grant admins all permissions
				if($user->userGroupId === self::ADMIN_GROUP_ID && $oldUserGroupId !== self::ADMIN_GROUP_ID)
				{
					$this->grantAllPermissions($id);
				}

				if($id === null)
				{
					return Redirect::route('user.showProfile');
				}

				return Redirect::route('user.index');
			}

			return view('errors.403');
		}

		/**
		 * Show the user profile page.
		 * 
		 * @return Response
		 */
		public function showProfile()
		{
			if(Auth::check())
			{
				$user = $this->userRepo->get(Auth::user()->userId);

				if($user->addressId !== null)
				{
					$address = $this->addressRepo->get($user->addressId);
					$districtSection = $address->districtSection;
					$postal = $this->postalRepo->get($address->postalId);
					$houseNumber = $this->houseNumberRepo->get($address->houseNumberId);
				}

				return view('user.showProfile', compact('user', 'districtSection', 'postal', 'houseNumber'));
			}

			return view('errors.401');
		}

		/**
		 * Show the account edit page for a regular user.
		 * 
		 * @return Response
		 */
		public function editProfile()
		{
			if(Auth::check())
			{
				$user = $this->userRepo->get(Auth::user()->userId);

				if($user->postalId !== null)
				{
					$postal = $this->postalRepo->getById($user->postalId)->code;
				}

				return view('user.editProfile', compact('user', 'postal'));
			}

			return view('errors.401');
		}

		/**
		 * Toggles the user's activation status.
		 * 
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function toggleActivation($id)
		{
			if(Auth::check() && (Auth::user()->hasPermission(PermissionsController::PERMISSION_USERS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_USERS)) && (int)$id !== Auth::user()->userId)
			{
				if($id != 1)
				{
					$user = $this->userRepo->get($id);
					$user->active ? $user->active = false : $user->active = true;
					$this->userRepo->update($user);
				}

				return Redirect::route('user.index');
			}

			return view('errors.403');
		}

		/**
		 * Grant the given user all permissions.
		 *
		 * @param  $id
		 * 
		 * @return void
		 */
		private function grantAllPermissions($id)
		{
			$user = $this->userRepo->get($id);

			$pages = $this->pageRepo->getAllIds();
			$districtSections = $this->districtSectionRepo->getAllIds();
			$permissions = $this->permissionRepo->getAllIds();

			$user->pages()->sync($pages);
			$user->districtSections()->sync($districtSections);
			$user->permissions()->sync($permissions);
		}
	}