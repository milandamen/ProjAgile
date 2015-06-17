<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\Page;
	use Carbon\Carbon;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use Illuminate\Database\Eloquent\Collection;

	class EntityPageRepository implements IPageRepository
	{
		/**
		 * The IDistrictSectionRepository implementation.
		 * 
		 * @var IDistrictSectionRepository
		 */
		private $districtSectionRepo;

		/**
		 * Creates a new EntityPageRepository instance.
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
		 * Returns a Page model depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return Page
		 */ 
		public function get($id) 
		{
			return Page::find($id);
		}

		public function show($id){
			$curDate = Carbon::now('Europe/Amsterdam');

			return Page::where('pageId', '=', $id)->where('publishDate', '<=', $curDate)->
							where('publishEndDate', '>=', $curDate)->get();
		}

		/**
		 * Returns all the Page models in the database.
		 * 
		 * @return Collection -> Page
		 */
		public function getAll() 
		{
			return Page::all();
		}

		/**
		 * Returns all the Page model id's in the database.
		 *
		 * @return Collection -> Integer
		 */
		public function getAllIds()
		{
			$pages =  Page::all();
			$page_ids = [];

			foreach($pages as $page)
			{
				$page_ids[] = $page->pageId;
			}

			return $page_ids;
		}

		/**
		 * Creates a Page record in the database.
		 * 
		 * @param  array() $attributes
		 * 
		 * @return Page
		 */
		public function create($attributes) 
		{
			return Page::create($attributes);
		}

		public function getAllLikeTerm($term)
		{
			return Page::whereHas('introduction', function($q) use ($term)
			{
				$q->where('title', 'LIKE' , '%' . $term . '%');
			})->get();
		}

		/**
		 * Updates a Page record in the database depending on 
		 * the Page model provided.
		 * 
		 * @param  Page $model
		 * 
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
			
			return $model;
		}

		/**
		 * Deletes a Page record depending on the id provided.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function destroy($id)
		{
			$model = Page::findOrFail($id);
			$model->delete();
		}

		/**
		 * Returns all the Page models from the database and 
		 * converts it to a list. This is for select box use only.
		 * 
		 * @return List -> Page
		 */
		public function getAllToList()
		{
			return Page::join('introduction', 'introduction.introductionId', '=' ,'page.introduction_introductionId')->
						 where('page.parentId', '=', null)->lists('title', 'pageId');
		}

		public function getAllChildren($id)
		{
			return Page::where('parentId', '=', $id)->get();
		}

		/**
		 * Returns a Page Collection which contain the specified parameters.
		 *
		 * @param  string $query
		 * 
		 * @return Collection -> Page
		 */
		public function search($query, $user)
		{
			$curDate = date('Y-m-d H:i:s', time());
			$pages = new Collection;

			if(isset($user) && !empty($user))
			{
				if($user->usergroup->name === "Administrator")
				{
					$pages = Page::orWhereHas('introduction', function($q) use($query)
								   {
								   		$q->whereRaw('MATCH(title, subtitle, text) AGAINST(?)', [$query]);
								   })->with('introduction')->
								   orWhereHas('panels', function($q) use($query)
								   {
								   		$q->whereRaw('MATCH(title, text) AGAINST(?)', [$query]);
								   })->with('panels')->
							 	   where('publishDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->
							 	   where('visible', '=', true)->get();
				}
				else
				{
					$userDistrictSection = $user->address->districtSection->name;

					$pages = Page::orWhereHas('introduction', function($q) use($query)
							       {
							   			$q->whereRaw('MATCH(title, subtitle, text) AGAINST(?)', [$query]);
							       })->with('introduction')->
							       orWhereHas('panels', function($q) use($query)
							       {
							   			$q->whereRaw('MATCH(title, text) AGAINST(?)', [$query]);
							       })->with('panels')->
						 	       where('publishDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->
						 	       where('visible', '=', true)->get();
				}
			}
			else
			{
				$pages = Page::whereHas('introduction', function($q) use($query)
						       {
						   			$q->whereRaw('MATCH(title, subtitle, text) AGAINST(?)', [$query]);
						       })->
						       orWhereHas('panels', function($q) use($query)
						       {
						   			$q->whereRaw('MATCH(title, text) AGAINST(?)', [$query]);
						       })->
					 	       where('publishDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->
					 	       where('visible', '=', true)->
					 	       with('introduction')->with('panels')->get();
			}

			return $pages;
		}
	}