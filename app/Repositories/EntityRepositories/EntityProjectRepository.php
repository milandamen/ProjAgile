<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\Project;
    use App\Repositories\RepositoryInterfaces\IProjectRepository;

    class EntityProjectRepository implements IProjectRepository 
    {
        /**
         * Returns a Project model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return Project
         */ 
        public function get($id)
        {
            return Project::find($id);
        }

        /**
         * Returns all the Project models in the database.
         * 
         * @return Collection -> Project
         */
        public function getAll()
        {
            return Project::all();
        }

        /**
         * Creates a Project record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return Project
         */
        public function create($attributes)
        {
            return Project::Create($attributes);
        }

        /**
         * Updates a Project record in the database depending on 
         * the Project model provided.
         * 
         * @param  Project $model
         * 
         * @return void
         */
        
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Project record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Project::findOrFail($id);
            $model->delete();
        }
    }