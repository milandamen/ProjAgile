<?php
    namespace App\Repositories\EntityRepositories;
    
	use App\Models\Districtsection;
    use App\Repositories\RepositoryInterfaces\IDistricsectionRepository;

	class DistrictsectionRepository implements IDistricsectionRepository 
	{
        /**
         * Returns a Districtsection model depending on the id provided
         * @param  int $id
         * @return Districtsection
         */ 
        public function get($id)
        {
            return Districtsection::find($id);
        }

        /**
         * Returns all the Districtsection models in the database
         * @return Collection -> Districtsection
         */
        public function getAll()
        {
            return Districtsection::all();
        }

        /**
         * Creates a Districtsection record in the database
         * @param  array() $attributes
         * @return Districtsection
         */
        public function create($attributes)
        {
            return Districtsection::Create($attributes);
        }

        /**
         * Updates a Districtsection record in the database depending on 
         * the Districtsection model provided
         * @param  Districtsection $model
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Districtsection record depending on the id provided
         * @param  int $id
         * @return void
         */
        public function destroy($id)
        {
            $model = Districtsection::findOrFail($id);
            $model->delete();
        }
	}