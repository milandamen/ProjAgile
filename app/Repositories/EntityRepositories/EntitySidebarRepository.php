<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\Sidebar;
    use App\Repositories\RepositoryInterfaces\ISidebarRepository;

    class SidebarRepository implements ISidebarRepository 
    {
        /**
         * Returns a Sidebar model depending on the id provided
         * @param  int $id
         * @return Sidebar
         */ 
        public function get($id)
        {
            return Sidebar::find($id);
        }

        /**
         * Returns all the Sidebar models in the database
         * @return Collection -> Sidebar
         */
        public function getAll()
        {
            return Sidebar::all();
        }

        /**
         * Creates a Sidebar record in the database
         * @param  array() $attributes
         * @return Sidebar
         */
        public function create($attributes)
        {
            return Sidebar::Create($attributes);
        }

        /**
         * Updates a Sidebar record in the database depending on 
         * the Sidebar model provided
         * @param  Sidebar $model
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Sidebar record depending on the id provided
         * @param  int $id
         * @return void
         */
        public function destroy($id)
        {
            $model = Sidebar::findOrFail($id);
            $model->delete();
        }

        /**
         * Returns a Sidebar Collection depending on the page number provided
         * @param  int $pageNr
         * @return Collection -> Sidebar
         */ 
        public function getByPage($pageNr)
        {
            return Sidebar::where('pageNr', '=', $pageNr)->get();
        }

        /**
         * Deletes all the Sidebar records depending on the page number provided
         * @param  int $pageNr
         * @return void
         */ 
        public function deleteAllFromPage($pageNr)
        {
            $this->getByPage($pageNr)->delete();
        }
    }