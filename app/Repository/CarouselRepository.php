<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Carousel;

class CarouselRepository implements BaseRepository {

    /**
     * Get all models for this table.
     */
    Public function getAll()
    {
        return Carousel::all();
    };

    /**
     * Find a model with the given id.
     */
    public function get($id);
    {
        return Carousel::find($id)
    }

    /**
     * Create a new model. Optional: attibutes for the new model.
     */
    public function create($attributes)
    {
        //TODO
    };

    /**
     * Updates an existing model.
     */
    public function update($attributes)
    {
        //TODO
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