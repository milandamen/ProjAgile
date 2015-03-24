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

    /**
     * Find a model with the given id.
     */
    public function get($id)
    {
        return MenuItem::find($id);
    }

    /**
     * Create a new model. Optional: attibutes for the new model.
     */
    public function create($attributes = array())
    {
        return MenuItem::create($attributes);
        /*
         * Attributes:
         * 0: parentId
         * 1: name
         * 2: relativeUrl
         * 3: menuOrder
         * 4: publish
         */
        /*
        $menuItem = new MenuItem;
        $menuItem->parentId     = $attributes[0];
        $menuItem->name         = $attributes[1];
        $menuItem->relativeUrl  = $attributes[2];
        $menuItem->menuOrder    = $attributes[3];
        $menuItem->publish      = $attributes[4];

        $this->save($menuItem);
        */
    }

    public function deleteAll()
    {
        $menuItems = $this->getAll();

        foreach($menuItems as $menuItem)
        {
            $this->delete($menuItem);
        }
    }
}
?>