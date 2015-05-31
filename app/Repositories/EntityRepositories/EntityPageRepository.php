<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\Page;
	use App\Repositories\RepositoryInterfaces\IPageRepository;

	class EntityPageRepository implements IPageRepository
	{
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
			$curDate = date('Y-m-d H:i:s',time());
			return Page::where('pageId', '=', $id)->where('publishDate', '<=', $curDate)->where('publishEndDate', '>=', $curDate)->get();
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
			return Page::join('introduction', 'introduction.introductionId', '=' ,'page.introduction_introductionId')->where('page.parentId', '=', null)->lists('title', 'pageId');
		}

		public function getAllChildren($id){
			return Page::where('parentId', '=', $id)->get();
		}

		

	}