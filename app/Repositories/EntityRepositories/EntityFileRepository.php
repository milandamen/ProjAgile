<?php
	namespace App\Repositories\EntityRepositories;
	
	use App\Models\File;
	use App\Repositories\RepositoryInterfaces\IFileRepository;

	class EntityFileRepository implements IFileRepository 
	{
		/**
		 * Returns a File model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return File
		 */ 
		public function get($id)
		{
			return File::find($id);
		}

		/**
		 * Returns all the File models in the database.
		 * 
		 * @return Collection -> File
		 */
		public function getAll()
		{
			return File::all();
		}

		/**
		 * Creates a File record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return File
		 */
		public function create($attributes)
		{
			return File::create($attributes);
		}

		/**
		 * Updates a File record in the database depending on the File model provided.
		 * 
		 * @param  File $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a File record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = File::findOrFail($id);
			$model->delete();
		}

		/**
		 * Returns all the File models in the database depending on the news id provided.
		 * 
		 * @return Collection -> File
		 */
		public function getAllByNewsId($newsId)
		{
			return File::where('newsId', '=', $newsId)->get();
		}

		/**
		 * Deletes all File records depending on the news id provided.
		 * 
		 * @param  int $newsId
		 * 
		 * @return void
		 */
		public function deleteAllByNewsId($newsId)
		{
			File::where('newsId', '=', $newsId)->delete();
		}
	}