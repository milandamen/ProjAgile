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
            $NewMenuOrder = Menu::where('parentId', '=', NULL)->orderBy('menuOrder', 'desc')->first()->menuOrder + 1;
            $attributes = array_add($attributes, 'menuOrder', $NewMenuOrder);
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
            return Menu::where('publish', '=', 1)->get();
        }

        public function getMenu()
        {
            $mainMenuItems = Menu::where('parentId', null)->where('publish', true)->orderBy('menuOrder')->get();
            $allMenuItems  = $this->orderMenu($mainMenuItems, true);

            return ($allMenuItems);
        }

        public function getAllMenuItems()
        {
            $mainMenuItems = Menu::where('parentId', null)->orderBy('menuOrder')->get();
            $allMenuItems  = $this->orderMenu($mainMenuItems, false);

            return ($allMenuItems);
        }

        private function orderMenu($categories, $publishCheck)
        {
            $allCategories = [];

            foreach ($categories as $category)
            {
                $subArr = [];
                $subArr['main'] = $category;

                if ($publishCheck)
                {
                    $subCategories = Menu::where('parentId', '=', $category->menuId)->where('publish', true)->orderBy('menuOrder')->get();
                }
                else
                {
                    $subCategories = Menu::where('parentId', '=', $category->menuId)->orderBy('menuOrder')->get();
                }

                if (!$subCategories->isEmpty())
                {
                    $result = $this->orderMenu($subCategories, $publishCheck);
                    $subArr['sub'] = $result;
                }
                $allCategories[] = $subArr;
            }

            return $allCategories;
        }

        public function updateMenuItemOrder($id, $order, $parent)
        {
            $model = $this->get($id);
            $model->parentId = $parent;
            $model->menuOrder = $order;
            $this->update($model);
        }
    }