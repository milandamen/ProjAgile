<?php
	namespace App\Repositories\EntityRepositories;

	use Auth;
	use App\Models\User;
	use App\Repositories\RepositoryInterfaces\IAddressRepository;
	use App\Repositories\RepositoryInterfaces\IHouseNumberRepository;
	use App\Repositories\RepositoryInterfaces\IPostalRepository;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use App\Repositories\RepositoryInterfaces\IUserGroupRepository;
	use Carbon\Carbon;
	use Hash;

	class EntityUserRepository implements IUserRepository
	{
		/**
		 * The AddressRepository implementation.
		 * 
		 * @var IAddressRepository
		 */
		private $addressRepo;

		/**
		 * The HouseNumberRepository implementation.
		 * 
		 * @var IHouseNumberRepository
		 */
		private $houseNumberRepo;

		/**
		 * The PostalRepository implementation.
		 * 
		 * @var IPostalRepository
		 */
		private $postalRepo;

		/**
		 * The UserGroupRepository implementation.
		 * 
		 * @var IUserGroupRepository
		 */
		private $userGroupRepo;

		/**
		 * Create a new EntityUserRepository instance.
		 *
		 * @return void
		 */
		public function __construct(IAddressRepository $addressRepo, IHouseNumberRepository $houseNumberRepo, IPostalRepository $postalRepo, IUserGroupRepository $userGroupRepo)
		{
			$this->addressRepo = $addressRepo;
			$this->houseNumberRepo = $houseNumberRepo;
			$this->postalRepo = $postalRepo;
			$this->userGroupRepo = $userGroupRepo;
		}

		/**
		 * Returns a User model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return User
		 */ 
		public function get($id)
		{
			return User::find($id);
		}

		/**
		 * Returns all the User models in the database.
		 * 
		 * @return Collection -> User
		 */
		public function getAll()
		{
			return User::all();
		}

		/**
		 * Creates a User record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return User
		 */
		public function create($attributes)
		{
			// UserGroupId is not set when registering
			if(!isset($attributes['userGroupId']))
			{
				$attributes['userGroupId'] = $this->userGroupRepo->getInhabitantUserGroup()->userGroupId;
			}

			// Check if postal and housenumber are provided. These attributes are only required for residents.
			if(isset($attributes['postal']) && !empty($attributes['postal']) && 
			   isset($attributes['houseNumber']) && !empty($attributes['houseNumber']))
			{
				$postalId = $this->postalRepo->getByCode($attributes['postal'])->postalId;
				$houseNumberId = $this->houseNumberRepo->getByHouseNumberSuffix($attributes['houseNumber'], $attributes['suffix'] ? : null)->houseNumberId;
				$addressId = $this->addressRepo->getByPostalHouseNumber($postalId, $houseNumberId)->addressId;

				$attributes['addressId'] = $addressId;
			}
			$attributes['password'] = Hash::make($attributes['password']);
			$attributes['active'] = false;
			$attributes['email'] = strtolower($attributes['email']);
			$attributes['confirmation_Token'] = str_random(100);
			$attributes['loginAttempts'] = 0;
			$attributes['lastLoginAttempt'] = Carbon::now();

			return User::create($attributes);
		}

		/**
		 * Updates a User record in the database depending on the User model provided.
		 * 
		 * @param  User $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->email = isset($model->email) ? strtolower($model->email) : null;
			$model->save();
		}

		/**
		 * Updates a User record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = User::findOrFail($id);
			$model['active'] = false;
			$model->save();
		}

		/**
		 * Returns all the User models in the database filtered by user group.
		 * Note that this will exclude the currently logged in user from the query.
		 *
		 * @return Collection -> User
		 */
		public function getAllByUserGroup($userGroupId)
		{
			return User::where('userGroupId', $userGroupId)->where('userId', '!=', Auth::user()->userId)->get();
		}

		/**
		 * Returns all the User models in the database filtered by user group and search criteria.
		 * Note that this will exclude the currently logged in user from the query.
		 *
		 * @return Collection -> User
		 */
		public function filterAllByUserGroup($userGroupId, $criteria)
		{
			$users = User::where('username', 'LIKE', "%$criteria%")->orWhere('firstName', 'LIKE', "%$criteria%")->
						   orWhere('surname', 'LIKE', "%$criteria%")->orWhere('email', 'LIKE', "%$criteria%")->
						   where('username', '!=', Auth::user()->userId)->get();

			return $users->where('userGroupId', $userGroupId);
		}

		/**
		 * Return a User record in the database depending on the username provided.
		 *
		 * @param  string $username
		 *
		 * @return User
		 */
		public function getByUsername($username)
		{
			return User::where('username', '=', $username)->first();
		}

		/**
		 * Returns a User record in the database depending on the address id provided.
		 * Note that this will exclude the given user id from the query.
		 * 
		 * @param  int $addresId
		 * @param  int $userId
		 * 
		 * @return User
		 */
		public function getByAddress($addressId, $userId)
		{
			return User::where('addressId', '=', $addressId)->where('userId', '!=', $userId)->first();
		}

		/**
		 * Returns a User record in the database depending on the confirmation token provided.
		 * 
		 * @param  string $confirmation_Token
		 * 
		 * @return User
		 */
		public function getByConfirmationToken($confirmation_Token)
		{
			return User::where('confirmation_Token', '=', $confirmation_Token)->where('active', '=', false)->first();	
		}

		/**
		 * Checks if the provided user has the Administrator role.
		 * 
		 * @param  User $user
		 * 
		 * @return bool
		 */
		public function isUserAdministrator($user)
		{
			if ($user->userGroupId == $this->userGroupRepo->getAdministratorUserGroup()->userGroupId)
			{
				return true;
			}

			return false;
		}

		/**
		 * Checks if the provided user has the Content Administrator role.
		 * 
		 * @param  User $user
		 * 
		 * @return bool
		 */
		public function isUserContentAdministrator($user)
		{
			if ($user->userGroupId == $this->userGroupRepo->getContentAdministratorUserGroup()->userGroupId)
			{
				return true;
			}
			
			return false;
		}
	}