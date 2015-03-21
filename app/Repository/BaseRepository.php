<?php
namespace App\Repository;
use App\Repository\Repository;

abstract class BaseRepository implements Repository {
	
	/**
	 * Get all models for this table.
	 */
	abstract public function getAll();
	
	/**
	 * Find a model with the given id.
	 */
	abstract public function get($id);
	
	/**
	 * Create a new model. Optional: attibutes for the new model.
	 */
	abstract public function create($attributes = array());

    /**
     * Updates an existing model. Optional: attibutes for the new model.
     */
    abstract public function update($attributes = array());

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
