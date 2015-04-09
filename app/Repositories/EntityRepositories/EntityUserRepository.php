<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\User;
    use App\Repositories\RepositoryInterfaces\IUserRepository;

    class UserRepository implements IUserRepository
    {
        /**
         * Returns a User model depending on the id provided
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
         * Returns all the User models in the database
         * 
         * @return Collection -> User
         */
        public function getAll()
        {
            return User::all();
        }

        /**
         * Creates a User record in the database
         * 
         * @param  array() $attributes
         * 
         * @return User
         */
        public function create($attributes)
        {
            return User::create($attributes);
        }

        /**
         * Updates a User record in the database depending on the User model provided
         * 
         * @param  User $model
         * 
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Updates a User record depending on the id provided
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
    }