<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\NewOnSite;
	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;

	class EntityNewOnSiteRepository implements INewOnSiteRepository
	{

		private $maxItems = 5;

		/**
		 * Returns a NewsComment model depending on the id provided.
		 *
		 * @param  int $id
		 *
		 * @return NewOnSite
		 */
		public function get($id)
		{
			return NewOnSite::find($id);
		}

		/**
		 * Returns all the NewsComment models in the database.
		 *
		 * @return Collection -> NewOnSite
		 */
		public function getAll()
		{
			return NewOnSite::orderBy('created_at', 'desc')->get();
		}

		public function getAllOrdered()
		{
			return NewOnSite::orderBy('created_at', 'desc')->take($this->maxItems)->get();
		}

		/**
		 * Creates a NewsComment record in the database.
		 *
		 * @param  array() $attributes
		 *
		 * @return NewOnSite
		 */
		public function create($attributes)
		{
			return NewOnSite::Create($attributes);
		}

		/**
		 * Updates a NewsComment record in the database depending on
		 * the NewsComment model provided.
		 *
		 * @param  NewOnSite $model
		 *
		 * @return void
		 */

		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a NewOnSite record depending on the id provided.
		 *
		 * @param  int $id
		 *
		 * @return void
		 */
		public function destroy($id)
		{
			$model = NewOnSite::findOrFail($id);
			$model->delete();
		}
	}