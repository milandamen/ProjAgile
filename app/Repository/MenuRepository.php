<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\MenuItem;

class MenuRepository implements BaseRepository {

    /**
     * Get all models for this table.
     */
    Public function getAll()
    {
        return MenuItem::all();
    };

    public function getAllPublic()
    {
        return MenuItem::where('publish', '=', '1')->get();
    }

    /**
     * Find a model with the given id.
     */
    public function get($id);
    {
        return MenuItem::find($id)
    }

    /**
     * Create a new model. Optional: attibutes for the new model.
     */
    public function create($attributes)
    {
        /*
         * Attributes:
         * 0: parentId
         * 1: name
         * 2: relativeUrl
         * 3: menuOrder
         * 4: publish
         */

        $menuItem = new MenuItem;
        $menuItem->parentId     = $attributes[0];
        $menuItem->name         = $attributes[1];
        $menuItem->relativeUrl  = $attributes[2];
        $menuItem->menuOrder    = $attributes[3];
        $menuItem->publish      = $attributes[4];

        $this->save($menuItem);

    };

    /**
     * Updates an existing model.
     */
    public function update($attributes)
    {
        /*
         * Attributes:
         * 0: menuId
         * 1: parentId
         * 2: name
         * 3: relativeUrl
         * 4: menuOrder
         * 5: publish
         */

        $menuItem = MenuItem::find($attributes[0]);

        $menuItem->parentId     = $attributes[1];
        $menuItem->name         = $attributes[2];
        $menuItem->relativeUrl  = $attributes[3];
        $menuItem->menuOrder    = $attributes[4];
        $menuItem->publish      = $attributes[5];

        $this->save($menuItem);
    };

    /**
     * Save this model to the database.
     */
    public function save($model) {
        $model->save();
    }

    /**
     * Delete this model from the database.
     */
    public function delete($model) {
        $model->delete();
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