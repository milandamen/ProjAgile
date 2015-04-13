<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\File;

class FileRepository extends BaseRepository {

    /**
     * Get all models for this table.
     */
    Public function getAll()
    {
        return File::all();
    }

    /**
     * Get all models by newsId
     */
    public function getAllByNewsId($newsId)
    {
        return File::where('newsId', '=', $newsId)->get();
    }

    /**
     * Find a model with the given id.
     */
    public function get($id)
    {
        return File::find($id);
    }

    /**
     * Create a new model. Optional: attibutes for the new model.
     */
    public function create($attributes = array())
    {
        return File::create($attributes);
    }

    /**
     * @param $newsId
     * Deletes all record with specific newsId
     */
    public function deleteAllByNewsId($newsId)
    {
        File::where('newsId', '=', 'newsId')->delete();
    }
}
?>