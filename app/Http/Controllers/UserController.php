<?php
	namespace App\Http\Controllers;

	use App\Http\Requests\User\CreateUserRequest;
	use App\Http\Requests\User\UpdateUserRequest;
	use App\Models\User;
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
		private $userRepo;
		private $userGroupRepo;
		private $postalRepo;
		const ADMIN_GROUP_ID = 1;
		const CONTENT_GROUP_ID = 2;
		const RESIDENT_GROUP_ID = 3;

		public function __construct(IUserRepository $userRepo, IUserGroupRepository $userGroupRepo, IPostalRepository $postalRepo)
		{
			$this->userRepo = $userRepo;
			$this->userGroupRepo = $userGroupRepo;
			$this->postalRepo = $postalRepo;
		}

		public function index()
		{
			if (Auth::check())
			{
				if (Auth::user()->usergroup->name === 'Administrator')
				{
					$admins = $this->userRepo->getAllByUserGroup(self::ADMIN_GROUP_ID);
					$contentmanagers = $this->userRepo->getAllByUserGroup(self::CONTENT_GROUP_ID);
					$residents = $this->userRepo->getAllByUserGroup(self::RESIDENT_GROUP_ID);

					return view('user.index', compact('admins', 'contentmanagers', 'residents'));
				}
				return view('errors.403');
			}
			return view('errors.401');
		}

		public function create()
		{
			if (Auth::check())
			{
				if (Auth::user()->usergroup->name === 'Administrator')
				{
					$user = new User();
					$userGroups = $this->userGroupRepo->getAll()->lists('name', 'userGroupId');
					return view('user.create', compact('user', 'userGroups'));
				}
				return view('errors.403');
			}
			return view('errors.401');
		}

		public function store(CreateUserRequest $userRequest)
		{
			if (Auth::check())
			{
				if (Auth::user()->usergroup->name === 'Administrator')
				{
					$data = $userRequest->input();
					$this->userRepo->create($data);
					return redirect::route('user.index');
				}
				return view('errors.403');
			}
			return view('errors.401');
		}

		public function edit($id)
		{
			if (Auth::check())
			{
				if (Auth::user()->usergroup->name === 'Administrator')
				{
					$user = $this->userRepo->get($id);
					$userGroups = $this->userGroupRepo->getAll()->lists('name', 'userGroupId');
					$postal = '';
					if ($user->postalId !== null)
					{
						$postal = $this->postalRepo->getById($user->postalId)->code;
					}
					return view('user.edit', compact('user', 'userGroups', 'postal'));
				}
				return view('errors.403');
			}
			return view('errors.401');
		}

		public function update(UpdateUserRequest $userRequest, $id = null)
		{
			if (Auth::check())
			{
				if (Auth::user()->usergroup->name === 'Administrator' || $id === null)
				{
					$user = ($id === null ? $this->userRepo->get(Auth::user()->userId) : $this->userRepo->get($id));
					$data = $userRequest->only
					(
						'username',
						'firstName',
						'surname',
						'email',
						'postal',
						'houseNumber',
						'userGroupId'
					);

					$user->fill($data);

					//only change password when given. If the field is emtpy the password need not be changed.
					if ($userRequest->get('password') !== '')
					{
						$user->password =  Hash::make($userRequest->get('password'));
					}

					if ($userRequest->get('postal') !== '')
					{
						$postal = $this->postalRepo->getByCode($userRequest->get('postal'));
						$user->districtSectionId = $postal->districtSectionId;
						$user->postalId = $postal->postalId;
					}
					else
					{
						$user->districtSectionId = null;
						$user->postalId = null;
					}

					$this->userRepo->update($user);

					if ($id === null)
					{
						return redirect::route('user.showProfile');
					}
					return redirect::route('user.index');
				}

				return view('errors.403');
			}

			return view('errors.401');
		}

		public function show($id)
		{
			if(Auth::check())
			{
				if(Auth::user()->usergroup->name === 'Administrator')
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
				else
				{
					return view('errors.403');
				}
			}
			else
			{
				return view('errors.401');
			}
		}

		public function deactivate($id)
		{
			if (Auth::check())
			{
				if (Auth::user()->usergroup->name === 'Administrator') {
					$user = $this->userRepo->get($id);
					$user->active = false;
					$this->userRepo->update($user);

					return redirect::route('user.index');
				}

				return view('errors.403');
			}

			return view('errors.401');
		}

		public function activate($id)
		{
			if (Auth::check())
			{
				if (Auth::user()->usergroup->name === 'Administrator') {
					$user = $this->userRepo->get($id);
					$user->active = true;
					$this->userRepo->update($user);

					return redirect::route('user.index');
				}

				return view('errors.403');
			}

			return view('errors.401');
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

	}