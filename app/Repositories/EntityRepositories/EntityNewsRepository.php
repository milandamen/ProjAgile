<?php
    namespace App\Repositories\EntityRepositories;
    
	use App\Models\News;
    use App\Repositories\RepositoryInterfaces\INewsRepository;

	class NewsRepository implements INewsRepository
	{
        /**
         * Returns a News model depending on the id provided
         * @param  int $id
         * @return News
         */ 
		public function get($id) 
		{
			return News::find($id);
		}

        /**
         * Returns all the News models in the database
         * @return Collection -> News
         */
		public function getAll() 
		{
			return News::all();
		}
		
        /**
         * Creates a News record in the database
         * @param  array() $attributes
         * @return News
         */
		public function create($attributes) 
		{
			return News::create($attributes);
		}

        /**
         * Updates a News record in the database depending on the News model provided
         * @param  News $model
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a News record depending on the id provided
         * @param  int $id
         * @return void
         */
        public function destroy($id)
        {
            $model = News::findOrFail($id);
            $model->delete();
        }

        /**
         * Returns a News Collection depending on the term provided
         * @param  string $term
         * @return Collection -> News
         */ 
		public function getByTitle($term) 
		{
			$term = '%' . $term . '%';
			return News::where('title', 'LIKE', $term)->where('hidden', '=', 0)->get();
		}
	}