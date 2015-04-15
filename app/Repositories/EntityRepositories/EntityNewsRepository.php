<?php
    namespace App\Repositories\EntityRepositories;
    
	use App\Models\News;
    use App\Repositories\RepositoryInterfaces\INewsRepository;
    use Auth;
    use Carbon\Carbon;

	class EntityNewsRepository implements INewsRepository
	{
        /**
         * Returns a News model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return News
         */ 
		public function get($id) 
		{
			return News::find($id);
		}

        /**
         * Returns all the News models in the database.
         * 
         * @return Collection -> News
         */
		public function getAll() 
		{
		   	$curDate = date('Y-m-d H:i:s',time());

			return News::where('publishStartDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->where('hidden', '=', 0)->orderBy('publishStartDate', 'desc')->get();
		}
		
        /**
         * Creates a News record in the database
         * 
         * @param  array $attributes
         * 
         * @return News
         */
		public function create($attributes) 
		{
            $attributes['userId'] = Auth::user()->userId;
            $attributes['date'] = Carbon::now();

			return News::create($attributes);
		}

        /**
         * Updates a News record in the database depending on the News model provided.
         * 
         * @param  News $model
         * 
         * @return News
         */
        public function update($model)
        {
            $model->userId = Auth::user()->userId;

            return $model->save();
        }

        /**
         * Deletes a News record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = News::findOrFail($id);
            $model->delete();
        }

        /**
         * Returns a News Collection depending on the term provided.
         * 
         * @param  string $term
         * 
         * @return Collection -> News
         */ 
		public function getByTitle($term) 
		{
			$term = '%' . $term . '%';
			return News::where('title', 'LIKE', $term)->where('hidden', '=', 0)->get();
		}

        /**
         * Returns a News Collection which are published seven days ago until now and are not hidden.
         * 
         * @return Collection -> News
         */
		public function getLastWeek()
        {
        	$date = date('Y-m-d H:i:s', time() - (7 * 86400)); // 7 days ago
        	$curDate = date('Y-m-d H:i:s', time());

        	return News::where('publishStartDate', '>=', $date)->where('publishEndDate', '>=', $curDate)->where('hidden', '=', 0)->orderBy('publishStartDate', 'desc')->get();
        }

        /**
         * Returns a News Collection which are older than seven days ago and are not hidden.
         * 
         * @return Collection -> News
         */
        public function oldNews()
        {
        	$date = date('Y-m-d H:i:s', time() - (7 * 86400)); // 7 days ago
        	$curDate = date('Y-m-d H:i:s', time());

        	return News::where('publishEndDate', '>=', $curDate)->where('publishStartDate', '<=', $date)->where('hidden', '=', 0)->orderBy('publishStartDate', 'desc')->get();
        }

        /**
         * Returns literally all news articles.
         * 
         * @return Collection -> News
         */
        public function getAllHidden()
        {
            return News::orderBy('publishStartDate', 'desc')->get();
        }
    }