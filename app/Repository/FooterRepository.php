<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Footer;

class FooterRepository extends BaseRepository {

    /**
     * Get all models for this table.
     */
    Public function getAll()
    {
        return Footer::all();
    }

    /**
     * Find a model with the given id.
     */
    public function get($id)
    {
        return Footer::find($id);
    }

    /**
     * Create a new model. Optional: attibutes for the new model.
     */
    public function create($attributes = array())
    {
        return Footer::create($attributes);
    }
}
?>