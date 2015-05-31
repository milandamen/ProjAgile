<?php
	namespace App\Repositories\EntityRepositories;
	
	use App\Models\Address;
	use App\Repositories\RepositoryInterfaces\IAddressRepository;

	class EntityAddressRepository implements IAddressRepository
	{
		/**
		 * Returns a Address model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return Address
		 */ 
		public function get($id) 
		{
			return Address::find($id);
		}

		/**
		 * Returns all the Address models in the database.
		 * 
		 * @return Collection -> Address
		 */
		public function getAll() 
		{
			return Address::all();
		}
		
		/**
		 * Creates a Address record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return Address
		 */
		public function create($attributes) 
		{
			return Address::create($attributes);
		}

		/**
		 * Updates a Address record in the database depending on the Address model provided.
		 * 
		 * @param  Address $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a Address record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = Address::findOrFail($id);
			$model->delete();
		}

		/**
		 * Returns a Address model depending on the postal- and houseNumber- id's provided.
		 * 
		 * @param  int $postal
		 * @param  int $houseNumber
		 * 
		 * @return Address
		 */ 
		public function getByPostalHouseNumber($postal, $houseNumber)
		{
			return Address::where('postalId', '=', $postal)->where('houseNumber', '=', $houseNumber)->first();
		}
	}