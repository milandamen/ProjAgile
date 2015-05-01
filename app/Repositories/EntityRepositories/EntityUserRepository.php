<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\User;
    use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
    use App\Repositories\RepositoryInterfaces\IPostalRepository;
    use App\Repositories\RepositoryInterfaces\IUserRepository;
    use App\Repositories\RepositoryInterfaces\IUserGroupRepository;
    use Hash;

    class EntityUserRepository implements IUserRepository
    {
        /**
         * The DistrictSectionRepository implementation.
         * 
         * @var IDistrictSectionRepository
         */
        private $districtSectionRepo;


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
        public function __construct(IDistrictSectionRepository $districtSectionRepo, IPostalRepository $postalRepo, IUserGroupRepository $userGroupRepo)
        {
            $this->districtSectionRepo = $districtSectionRepo;
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
         * Returns all the User models in the database filtered by user group.
         *
         * @return Collection -> User
         */
        public function getAllByUserGroup($userGroupId)
        {
            return User::where('userGroupId', $userGroupId)->get();
        }

        /**
         * Returns all the User models in the database filtered by user group and search criteria
         *
         * @return Collection -> User
         */
        public function filterAllByUserGroup($userGroupId, $criteria)
        {
            $users = User::where('username', 'LIKE', "%$criteria%")->orWhere('firstName', 'LIKE', "%$criteria%")->orWhere('surname', 'LIKE', "%$criteria%")->orWhere('email', 'LIKE', "%$criteria%")->get();

            return $users->where('userGroupId', $userGroupId);
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
            $postal = $this->postalRepo->getByCode($attributes['postal']);

            $attributes['userGroupId'] = $this->userGroupRepo->getInhabitantUserGroup()->userGroupId;
            $attributes['districtSectionId'] = $postal->districtSectionId;
            $attributes['postalId'] = $postal->postalId;
            $attributes['password'] = Hash::make($attributes['password']);
            $attributes['active'] = true;

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
            $model['password'] = Hash::make($model['password']);
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