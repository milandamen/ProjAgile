<?php
    namespace App\Repositories\EntityRepositories;
        
    use App\Models\MenuItem;
    use App\Repositories\RepositoryInterfaces\IMenuRepository;

    class MenuRepository implements IMenuRepository 
    {
        /**
         * Returns a MenuItem model depending on the id provided
         * @param  int $id
         * @return MenuItem
         */ 
        public function get($id)
        {
            return MenuItem::find($id);
        }

        /**
         * Returns all the MenuItem models in the database
         * @return Collection -> MenuItem
         */
        public function getAll()
        {
            return MenuItem::all();
        }

        /**
         * Creates a MenuItem record in the database
         * @param  array() $attributes
         * @return MenuItem
         */
        public function create($attributes)
        {
            return MenuItem::create($attributes);
        }

        /**
         * Updates a MenuItem record in the database depending on the MenuItem model provided
         * @param  MenuItem $model
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a MenuItem record depending on the id provided
         * @param  int $id
         * @return void
         */
        public function destroy($id)
        {
            $model = MenuItem::findOrFail($id);
            $model->delete();
        }

        /**
         * Returns a MenuItem Collection where all the MenuItems have a state of Published
         * @return Collection -> MenuItem
         */ 
        public function getAllPublic()
        {
            return MenuItem::where('publish', '=', '1')->get();
        }
    }