<?php
	namespace App\Repositories\EntityRepositories;
	
	use App\Models\Address;
	use App\Repositories\RepositoryInterfaces\IAddressRepository;

	class EntityAddressRepository implements IAddressRepository
	{
		/**
		 * Returns an Address model depending on the id provided.
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
         * Returns an Address model depending on districtId, postalId and houseNumberId.
         *
         * @return Collection -> Address
         */
        public function getByDistrictPostalAndHouseNumber($districtId, $postalId, $houseNumberId)
        {
            return Address::where('districtSectionId', '=', $districtId)->where('postalId', '=', $postalId)->where('houseNumberId', '=', $houseNumberId)->first();
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
	}