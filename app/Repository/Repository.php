<?php
namespace App\Repository;

interface Repository {
	
	/**
	 * Get all models for this table.
	 */
	public function getAll();
	
	/**
	 * Find a model with the given id.
	 */
	public function get($id);
	
	/**
	 * Create a new model. Optional: attibutes for the new model.
	 */
	public function create($attributes = array());
	
	/**
	 * Save this model to the database.
	 */
	public function save($model);
	
	/**
	 * Delete this model from the database.
	 */
	public function delete($model);
}
