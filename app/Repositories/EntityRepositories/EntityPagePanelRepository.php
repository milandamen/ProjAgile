<?php
    namespace App\Repositories\EntityRepositories;

	use App\Models\PagePanel;
	use App\Repositories\RepositoryInterfaces\IPagePanelRepository;

	class EntityPagePanelRepository implements IPagePanelRepository
	{
        /**
         * Returns a PagePanel model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return PagePanel
         */ 
		public function get($id) 
		{
			return PagePanel::find($id);
		}

        /**
         * Returns all the PagePanel models in the database.
         * 
         * @return Collection -> PagePanel
         */
	    public function getAll() 
	    {
			return PagePanel::all();
		}

        /**
         * Creates a PagePanel record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return PagePanel
         */
		public function create($attributes) 
		{
			return PagePanel::create($attributes);
		}

        /**
         * Updates a PagePanel record in the database depending on 
         * the PagePanel model provided.
         * 
         * @param  PagePanel $model
         * 
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a PagePanel record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = PagePanel::findOrFail($id);
            $model->delete();
        }
		
        /**
         * Returns a PagePanel Collection depending on the page id provided.
         * 
         * @param  int $pageId
         * 
         * @return Collection -> PagePanel
         */ 
		public function getPagePanels($pageId)
		{
			return PagePanel::where('page_id', '=', $pageId);
		}
	}