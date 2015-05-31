<?php
	namespace App\Repositories\EntityRepositories;
	
	use App\Models\HouseNumber;
	use App\Repositories\RepositoryInterfaces\IHouseNumberRepository;

	class EntityHouseNumberRepository implements IHouseNumberRepository
	{
		/**
		 * Returns a HouseNumber model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return HouseNumber
		 */ 
		public function get($id) 
		{
			return HouseNumber::find($id);
		}

		/**
		 * Returns all the HouseNumber models in the database.
		 * 
		 * @return Collection -> HouseNumber
		 */
		public function getAll() 
		{
			return HouseNumber::all();
		}
		
		/**
		 * Creates a HouseNumber record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return HouseNumber
		 */
		public function create($attributes) 
		{
			return HouseNumber::create($attributes);
		}

		/**
		 * Updates a HouseNumber record in the database depending on the HouseNumber model provided.
		 * 
		 * @param  HouseNumber $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a HouseNumber record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = HouseNumber::findOrFail($id);
			$model->delete();
		}

		/**
		 * Returns a HouseNumber model depending on the houseNumber and suffix provided.
		 * 
		 * @param  int 		$houseNumber
		 * @param  mixed 	$suffix
		 * 
		 * @return HouseNumber
		 */ 
		public function getByHouseNumberSuffix($houseNumber, $suffix = null)
		{
			return HouseNumber::where('houseNumber', $houseNumber)->where('suffix', $suffix)->first();
		}
	}