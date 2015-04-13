<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\MenuItem;

class MenuRepository extends BaseRepository {

    /**
     * Get all models for this table.
     */
    Public function getAll()
    {
        return MenuItem::all();
    }

    public function getAllPublic()
    {
        return MenuItem::where('publish', '=', '1')->get();
    }

    public function get($id)
    {
        return MenuItem::find($id);
    }

    public function create($attributes = array())
    {
        return MenuItem::create($attributes);
    }

    public function deleteAll()
    {
        $menuItems = $this->getAll();

        foreach($menuItems as $menuItem)
        {
            $this->delete($menuItem);
        }
    }

    public function getMenu()
    {
        $mainMenuItems = MenuItem::where('parentId', null)->orderBy('menuOrder')->get();
        $allMenuItems  = $this->orderMenu($mainMenuItems);
        return ($allMenuItems);
    }

    private function orderMenu($categories)
    {
            $allCategories = array();
            foreach ($categories as $category) {
                $subArr = array();
                $subArr['main'] = $category;
                $subCategories = MenuItem::where('parentId', '=', $category->menuId)->get();

                if (!$subCategories->isEmpty()) {
                    $result = $this->orderMenu($subCategories);

                    $subArr['sub'] = $result;
                }

                $allCategories[] = $subArr;
            }

            return $allCategories;
    }
}
?>