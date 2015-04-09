<?php
    namespace App\Repositories\EntityRepositories;
    
    use App\Models\Footer;
    use App\Repositories\RepositoryInterfaces\IFooterRepository;

    class EntityFooterRepository implements IFooterRepository 
    {
        /**
         * Returns a Footer model depending on the id provided
         * 
         * @param  int $id
         * 
         * @return Footer
         */ 
        public function get($id)
        {
            return Footer::find($id);
        }

        /**
         * Returns all the Footer models in the database
         * 
         * @return Collection -> Footer
         */
        public function getAll()
        {
            return Footer::all();
        }

        /**
         * Creates a Footer record in the database
         * 
         * @param  array() $attributes
         * 
         * @return Footer
         */
        public function create($attributes)
        {
            return Footer::create($attributes);
        }

        /**
         * Updates a Footer record in the database depending on the Footer model provided
         * 
         * @param  Footer $model
         * 
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Footer record depending on the id provided
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Footer::findOrFail($id);
            $model->delete();
        }
    }