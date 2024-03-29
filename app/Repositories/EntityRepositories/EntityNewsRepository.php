<?php
	namespace App\Repositories\EntityRepositories;
	
	use App\Models\News;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use Auth;
	use Carbon\Carbon;
	use Illuminate\Database\Eloquent\Collection;

	class EntityNewsRepository implements INewsRepository
	{
		/**
		 * The IDistrictSectionRepository implementation.
		 * 
		 * @var IDistrictSectionRepository
		 */
		private $districtSectionRepo;

		/**
		 * Creates a new EntityNewsRepository instance.
		 * 
		 * @param  IDistrictSectionRepository $districtSectionRepo
		 *
		 * @return void
		 */
		public function __construct(IDistrictSectionRepository $districtSectionRepo)
		{
			$this->districtSectionRepo = $districtSectionRepo;
		}

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
			$curDate = date('Y-m-d H:i:s', time());

			return News::where('publishStartDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->
						 where('hidden', '=', 0)->orderBy('publishStartDate', 'desc')->get();
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
			$news = News::create($attributes);

			foreach($attributes['districtSection'] as $district)
			{
				$news->districtSections()->attach($district);
			}

			return $news;
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
			$model->save();

			return $model;
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
			// 7 days ago
			$date = date('Y-m-d H:i:s', time() - (7 * 86400));
			$curDate = date('Y-m-d H:i:s', time());

			return News::where('publishStartDate', '>=', $date)->where('publishEndDate', '>=', $curDate)->
						 where('hidden', '=', 0)->orderBy('publishStartDate', 'desc')->get();
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

			return News::where('publishEndDate', '>=', $curDate)->where('publishStartDate', '<=', $date)->
						 where('hidden', '=', 0)->orderBy('publishStartDate', 'desc')->get();
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

		/**
		 * Returns a News Collection which contain the specified parameters.
		 *
		 * @param  string $query
		 * 
		 * @return Collection -> News
		 */
		public function search($query, $user)
		{
			$curDate = date('Y-m-d H:i:s', time());
			$news = new Collection;
			$homeDistrictSection = $this->districtSectionRepo->getByName('Home')->name;

			if(isset($user) && !empty($user))
			{
				$address = $user->address;
				$districtSection;

				if(isset($address) && !empty($address))
				{
					$districtSection = $address->districtSection;
				}

				if(isset($districtSection) && !empty($districtSection))
				{
					$userDistrictSection = $districtSection->name;

					$news = News::whereRaw('MATCH(title, content) AGAINST(?)', [$query])->
							 	  where('publishStartDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->
							 	  where('hidden', '=', false)->whereHas('districtSections', function($query) use ($homeDistrictSection, $userDistrictSection)
							 	  {
							 	  		$query->where('name', '=', $homeDistrictSection)->
							 	  			orWhere('name', '=', $userDistrictSection);
							 	  })->get();
				}
				else
				{

  					$news = News::whereRaw('MATCH(title, content) AGAINST(?)', [$query])->
							 	  where('publishStartDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->
							 	  where('hidden', '=', false)->get();
				}
			}
			else
			{
				$news = News::whereRaw('MATCH(title, content) AGAINST(?)', [$query])->
							 	  where('publishStartDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->
							 	  where('hidden', '=', false)->
							 	  whereHas('districtSections', function($query) use ($homeDistrictSection)
							 	  {
							 	  		$query->where('name', '=', $homeDistrictSection);
							 	  })->get();
			}

			return $news;
		}
	}