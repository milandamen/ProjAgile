<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Carousel;

class CarouselRepository extends BaseRepository {

    /**
     * Get all models for this table.
     */
    Public function getAll()
    {
        return Carousel::all();
    }

    /**
     * Find a model with the given id.
     */
    public function get($id)
    {
        return Carousel::find($id);
    }

    /**
     * Create a new model. Optional: attibutes for the new model.
     */
    public function create($attributes = array())
    {
        return Carousel::create();
    }

    /**
     * Deletes all models in database.
     */
    public function deleteAll()
    {
        $this->getAll()->delete();
    }
}
?>