<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Sidebar;

class SidebarRepository extends BaseRepository {

    /**
     * Get all models for this table.
     */
    Public function getAll()
    {
        return Sidebar::all();
    }

    /**
     * Find a model with the given id.
     */
    public function get($id)
    {
        return Sidebar::find($id);
    }

    public function getByPage($pageNr)
    {
        return Sidebar::where('pageNr', '=', $pageNr)->get();
    }

    /**
     * Create a new model. Optional: attibutes for the new model.
     */
    public function create($attributes = array())
    {
        return Sidebar::Create();
    }

    public function deleteAllFromPage($pageNr)
    {
        $this->getByPage($pageNr)->delete();
    }
}
?>