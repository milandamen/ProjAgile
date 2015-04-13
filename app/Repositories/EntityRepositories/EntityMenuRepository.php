<?php
    namespace App\Repositories\EntityRepositories;
        
    use App\Models\Menu;
    use App\Repositories\RepositoryInterfaces\IMenuRepository;

    class EntityMenuRepository implements IMenuRepository 
    {
        /**
         * Returns a Menu model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return Menu
         */ 
        public function get($id)
        {
            return Menu::find($id);
        }

        /**
         * Returns all the Menu models in the database.
         * 
         * @return Collection -> Menu
         */
        public function getAll()
        {
            return Menu::all();
        }

        /**
         * Creates a Menu record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return Menu
         */
        public function create($attributes)
        {
            return Menu::create($attributes);
        }

        /**
         * Updates a Menu record in the database depending on the Menu model provided.
         * 
         * @param  Menu $model
         * 
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Menu record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Menu::findOrFail($id);
            $model->delete();
        }

        /**
         * Returns a Menu Collection where all the Menus have a state of Published.
         * 
         * @return Collection -> Menu
         */ 
        public function getAllPublic()
        {
            return Menu::where('publish', '=', '1')->get();
        }

        public function getMenu()
        {
            $mainMenuItems = Menu::where('parentId', null)->orderBy('menuOrder')->get();
            $allMenuItems  = $this->orderMenu($mainMenuItems);
            return ($allMenuItems);
        }

        private function orderMenu($categories)
        {
                    $allCategories = array();
                    foreach ($categories as $category) {
                            $subArr = array();
                            $subArr['main'] = $category;
                            $subCategories = Menu::where('parentId', '=', $category->menuId)->get();

                            if (!$subCategories->isEmpty()) {
                                    $result = $this->orderMenu($subCategories);

                                    $subArr['sub'] = $result;
                               }

                $allCategories[] = $subArr;
            }

            return $allCategories;
        }
    }