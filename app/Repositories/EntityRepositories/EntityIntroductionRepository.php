<?php
    namespace App\Repositories\EntityRepositories;

	use App\Models\Introduction;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;

	class IntroductionRepository implements IIntroductionRepository
	{
        /**
         * Returns a Introduction model depending on the id provided
         * 
         * @param  int $id
         * 
         * @return Introduction
         */ 
		public function get($id) 
		{
			return Introduction::find($id);
		}

        /**
         * Returns all the Introduction models in the database
         * 
         * @return Collection -> Introduction
         */
	    public function getAll() 
	    {
			return Introduction::all();
		}

        /**
         * Creates a Introduction record in the database
         * 
         * @param  array() $attributes
         * 
         * @return Introduction
         */
		public function create($attributes) 
		{
			return Introduction::create($attributes);
		}

        /**
         * Updates a Introduction record in the database depending on 
         * the Introduction model provided
         * 
         * @param  Introduction $model
         * 
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Introduction record depending on the id provided
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Introduction::findOrFail($id);
            $model->delete();
        }
		
        /**
         * Returns a Introduction Collection depending on the page id provided
         * 
         * @param  int $pageId
         * 
         * @return Collection -> Introduction
         */ 
		public function getPageBar($pageId)
		{
			return Introduction::where('pageId', '=', $pageId);
		}
	}