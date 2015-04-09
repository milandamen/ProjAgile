<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\UserGroup;
    use App\Repositories\RepositoryInterfaces\IUserGroupRepository;

    class EntityUserGroupRepository implements IUserGroupRepository
    {
        /**
         * Returns a UserGroup model depending on the id provided
         * 
         * @param  int $id
         * 
         * @return UserGroup
         */ 
        public function get($id)
        {
            return UserGroup::find($id);
        }

        /**
         * Returns all the UserGroup models in the database
         * 
         * @return Collection -> UserGroup
         */
        public function getAll()
        {
            return UserGroup::all();
        }

        /**
         * Creates a UserGroup record in the database
         * 
         * @param  array() $attributes
         * 
         * @return UserGroup
         */
        public function create($attributes)
        {
            return UserGroup::create($attributes);
        }

        /**
         * Updates a UserGroup record in the database depending on the UserGroup model provided
         * 
         * @param  UserGroup $model
         * 
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Updates a UserGroup record depending on the id provided
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = UserGroup::findOrFail($id);
            $model->delete();
        }
    }