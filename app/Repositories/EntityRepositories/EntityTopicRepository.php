<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\Topic;
	use App\Repositories\RepositoryInterfaces\ITopicRepository;

	class EntityTopicRepository implements ITopicRepository 
	{
		/**
		 * Returns a Topic model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return Topic
		 */ 
		public function get($id)
		{
			return Topic::find($id);
		}

		/**
		 * Returns all the Topic models in the database.
		 * 
		 * @return Collection -> Topic
		 */
		public function getAll()
		{
			return Topic::all();
		}

		/**
		 * Creates a Topic record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return Topic
		 */
		public function create($attributes)
		{
			return Topic::Create($attributes);
		}

		/**
		 * Updates a Topic record in the database depending on 
		 * the Topic model provided.
		 * 
		 * @param  Topic $model
		 * 
		 * @return void
		 */
		
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a Topic record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = Topic::findOrFail($id);
			$model->delete();
		}
	}