<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\Partner;
    use App\Repositories\RepositoryInterfaces\IPartnerRepository;

    class EntityPartnerRepository implements IPartnerRepository 
    {
        /**
         * Returns a Partner model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return Partner
         */ 
        public function get($id)
        {
            return Partner::find($id);
        }

        /**
         * Returns all the Partner models in the database.
         * 
         * @return Collection -> Partner
         */
        public function getAll()
        {
            return Partner::all();
        }

        /**
         * Creates a Partner record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return Partner
         */
        public function create($attributes)
        {
            return Partner::Create($attributes);
        }

        /**
         * Updates a Partner record in the database depending on 
         * the Partner model provided.
         * 
         * @param  Partner $model
         * 
         * @return void
         */
        
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Partner record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Partner::findOrFail($id);
            $model->delete();
        }
    }