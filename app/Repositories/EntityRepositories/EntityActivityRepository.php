<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\Activity;
	use App\Repositories\RepositoryInterfaces\IActivityRepository;

	class EntityActivityRepository implements IActivityRepository 
	{
		/**
		 * Returns a Activity model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return Activity
		 */ 
		public function get($id)
		{
			return Activity::find($id);
		}

		/**
		 * Returns all the Activity models in the database.
		 * 
		 * @return Collection -> Activity
		 */
		public function getAll()
		{
			return Activity::all();
		}

		/**
		 * Creates a Activity record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return Activity
		 */
		public function create($attributes)
		{
			return Activity::Create($attributes);
		}

		/**
		 * Updates a Activity record in the database depending on 
		 * the Activity model provided.
		 * 
		 * @param  Activity $model
		 * 
		 * @return void
		 */
		
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a Activity record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = Activity::findOrFail($id);
			$model->delete();
		}
	}