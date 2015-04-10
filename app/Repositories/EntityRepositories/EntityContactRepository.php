<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\Contact;
    use App\Repositories\RepositoryInterfaces\IContactRepository;

    class EntityContactRepository implements IContactRepository 
    {
        /**
         * Returns a Contact model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return Contact
         */ 
        public function get($id)
        {
            return Contact::find($id);
        }

        /**
         * Returns all the Contact models in the database.
         * 
         * @return Collection -> Contact
         */
        public function getAll()
        {
            return Contact::all();
        }

        /**
         * Creates a Contact record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return Contact
         */
        public function create($attributes)
        {
            return Contact::Create($attributes);
        }

        /**
         * Updates a Contact record in the database depending on 
         * the Contact model provided.
         * 
         * @param  Contact $model
         * 
         * @return void
         */
        
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Contact record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Contact::findOrFail($id);
            $model->delete();
        }
    }