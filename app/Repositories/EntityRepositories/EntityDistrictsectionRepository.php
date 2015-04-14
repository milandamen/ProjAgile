<?php
    namespace App\Repositories\EntityRepositories;
    
	use App\Models\Districtsection;
    use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;

	class EntityDistrictsectionRepository implements IDistrictSectionRepository 
	{
        /**
         * Returns a Districtsection model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return Districtsection
         */ 
        public function get($id)
        {
            return Districtsection::find($id);
        }

        /**
         * Returns all the Districtsection models in the database.
         * 
         * @return Collection -> Districtsection
         */
        public function getAll()
        {
            return Districtsection::all();
        }

        /**
         * Creates a Districtsection record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return Districtsection
         */
        public function create($attributes)
        {
            return Districtsection::Create($attributes);
        }

        /**
         * Updates a Districtsection record in the database depending on 
         * the Districtsection model provided.
         * 
         * @param  Districtsection $model
         * 
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Districtsection record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Districtsection::findOrFail($id);
            $model->delete();
        }

        /**
         * Returns all the Districtsection models from the database and 
         * converts it to a list. This is for select box use only.
         * 
         * @return List -> Districtsection
         */
        public function getAllToList()
        {
            return Districtsection::all()->lists('name', 'districtSectionId');
        }
	}