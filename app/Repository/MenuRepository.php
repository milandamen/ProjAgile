<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\MenuItem;

abstract class MenuRepository implements BaseRepository {

    /**
     * Get all models for this table.
     */
    Public function getAll()
    {
        return MenuItem::all();
    };

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
}
?>