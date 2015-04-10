<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\Forum;
    use App\Repositories\RepositoryInterfaces\IForumRepository;

    class EntityForumRepository implements IForumRepository 
    {
        /**
         * Returns a Forum model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return Forum
         */ 
        public function get($id)
        {
            return Forum::find($id);
        }

        /**
         * Returns all the Forum models in the database.
         * 
         * @return Collection -> Forum
         */
        public function getAll()
        {
            return Forum::all();
        }

        /**
         * Creates a Forum record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return Forum
         */
        public function create($attributes)
        {
            return Forum::Create($attributes);
        }

        /**
         * Updates a Forum record in the database depending on 
         * the Forum model provided.
         * 
         * @param  Forum $model
         * 
         * @return void
         */
        
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Forum record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Forum::findOrFail($id);
            $model->delete();
        }
    }