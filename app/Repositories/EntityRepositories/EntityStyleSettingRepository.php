<?php
	namespace App\Repositories\EntityRepositories;
	
	use App\Models\StyleSetting;
	use App\Repositories\RepositoryInterfaces\IStyleSettingRepository;

	class EntityStyleSettingRepository implements IStyleSettingRepository
	{
		/**
		 * Returns a StyleSetting model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return StyleSetting
		 */ 
		public function get($item)
		{
			return StyleSetting::find($item);
		}

		/**
		 * Returns all the StyleSetting models in the database.
		 * 
		 * @return Collection -> StyleSetting
		 */
		public function getAll()
		{
			return StyleSetting::all();
		}

		/**
		 * Creates a StyleSetting record in the database
		 * 
		 * @param  array() $attributes
		 * 
		 * @return StyleSetting
		 */
		public function create($attributes)
		{
			return StyleSetting::create($attributes);
		}

		/**
		 * Updates a StyleSetting record in the database depending on the StyleSetting model provided.
		 * 
		 * @param  StyleSetting $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a StyleSetting record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($item)
		{
			$model = StyleSetting::findOrFail($item);
			$model->delete();
		}
	}