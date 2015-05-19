<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\Page;
	use App\Repositories\RepositoryInterfaces\IPageRepository;

	class EntityPageRepository implements IPageRepository
	{
		/**
		 * Returns a Page model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return Page
		 */ 
		public function get($id) 
		{
			return Page::find($id);
		}

		/**
		 * Returns all the Page models in the database.
		 * 
		 * @return Collection -> Page
		 */
		public function getAll() 
		{
			return Page::all();
		}

		/**
		 * Creates a Page record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return Page
		 */
		public function create($attributes) 
		{
			return Page::create($attributes);
		}

		/**
		 * Updates a Page record in the database depending on 
		 * the Page model provided.
		 * 
		 * @param  Page $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a Page record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = Page::findOrFail($id);
			$model->delete();
		}

		/**
		 * Returns all the Page models from the database and 
		 * converts it to a list. This is for select box use only.
		 * 
		 * @return List -> Page
		 */
		public function getAllToList()
		{
			return Page::all()->lists('introduction_introductionId', 'pageId');
		}

		

	}