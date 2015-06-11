<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IPagePanelRepository extends IBaseRepository
	{
		public function getPagePanels($pageId);
		public function deleteAllFromPage($pageId);
		public function search($query);
	}