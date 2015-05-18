<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\TopicComment;
	use App\Repositories\RepositoryInterfaces\ITopicCommentRepository;

	class EntityTopicTopicCommentRepository implements ITopicCommentRepository
	{
		/**
		 * Returns a TopicComment model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return TopicComment
		 */ 
		public function get($id)
		{
			return TopicComment::find($id);
		}

		/**
		 * Returns all the TopicComment models in the database.
		 * 
		 * @return Collection -> TopicComment
		 */
		public function getAll()
		{
			return TopicComment::all();
		}

		/**
		 * Creates a TopicComment record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return TopicComment
		 */
		public function create($attributes)
		{
			return TopicComment::Create($attributes);
		}

		/**
		 * Updates a TopicComment record in the database depending on 
		 * the TopicComment model provided.
		 * 
		 * @param  TopicComment $model
		 * 
		 * @return void
		 */
		
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a TopicComment record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = TopicComment::findOrFail($id);
			$model->delete();
		}
	}