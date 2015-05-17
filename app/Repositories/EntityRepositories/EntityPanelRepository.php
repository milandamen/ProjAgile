<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\Panel;
	use App\Repositories\RepositoryInterfaces\IPanelRepository;

	class EntityPanelRepository implements IPanelRepository
	{
		/**
		 * Returns a Panel model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return Panel
		 */ 
		public function get($id) 
		{
			return Panel::find($id);
		}

		/**
		 * Returns all the Panel models in the database.
		 * 
		 * @return Collection -> Panel
		 */
		public function getAll() 
		{
			return Panel::all();
		}

		/**
		 * Creates a Panel record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return Panel
		 */
		public function create($attributes) 
		{
			return Panel::create($attributes);
		}

		/**
		 * Updates a Panel record in the database depending on 
		 * the Panel model provided.
		 * 
		 * @param  Panel $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a Panel record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = Panel::findOrFail($id);
			$model->delete();
		}

		public function getBySize($size)
		{
			return Panel::where('size', '=', $size)->first();
		}
	}