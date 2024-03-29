<?php
	namespace App\Repositories\EntityRepositories;
	
	use App\Models\HomeLayoutModule;
	use App\Repositories\RepositoryInterfaces\IHomeLayoutRepository;

	class EntityHomeLayoutRepository implements IHomeLayoutRepository
	{
		/**
		 * Returns a HomeLayoutModule model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return HomeLayoutModule
		 */ 
		public function get($id) 
		{
			return HomeLayoutModule::find($id);
		}

		/**
		 * Returns all the HomeLayoutModule models in the database and order them by orderNumber.
		 * 
		 * @return Collection -> HomeLayoutModule
		 */
		public function getAll() 
		{
			$objects = HomeLayoutModule::all();
			$modules = [];

			// Order modules
			foreach ($objects as $module)
			{
				$modules[$module->orderNumber] = $module;
			}
			return $modules;
		}
		
		/**
		 * Creates a HomeLayoutModule record in the database
		 * 
		 * @param  array() $attributes
		 * 
		 * @return HomeLayoutModule
		 */
		public function create($attributes)
		{
			return HomeLayoutModule::Create($attributes);
		}

		/**
		 * Updates a HomeLayoutModule record in the database depending on 
		 * the HomeLayoutModule model provided.
		 * 
		 * @param  HomeLayoutModule $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a HomeLayoutModule record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$homeLayout = HomeLayoutModule::findOrFail($id);
			$homeLayout->delete();
		}
	}