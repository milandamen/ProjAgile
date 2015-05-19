<?php
	namespace App\Repositories\EntityRepositories;
	
	use App\Models\Postal;
	use App\Repositories\RepositoryInterfaces\IPostalRepository;

	class EntityPostalRepository implements IPostalRepository
	{
		/**
		 * Returns a Postal model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return Postal
		 */ 
		public function get($id) 
		{
			return Postal::find($id);
		}

		/**
		 * Returns all the Postal models in the database.
		 * 
		 * @return Collection -> Postal
		 */
		public function getAll() 
		{
			return Postal::all();
		}
		
		/**
		 * Creates a Postal record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return Postal
		 */
		public function create($attributes) 
		{
			return Postal::create($attributes);
		}

		/**
		 * Updates a Postal record in the database depending on the Postal model provided.
		 * 
		 * @param  Postal $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a Postal record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = Postal::findOrFail($id);
			$model->delete();
		}

		/**
		 * Returns a Postal record depending on the code provided.
		 *
		 * @param  int $code
		 *
		 * @return Postal
		 */
		public function getByCode($code)
		{
			return Postal::where('code', '=', $code)->first();
		}

		/**
		 * Returns a Postal record depending on the id provided.
		 *
		 * @param  int $postalId
		 *
		 * @return Postal
		 */
		public function getById($postalId)
		{
			return Postal::where('postalId', '=', $postalId)->first();
		}
	}