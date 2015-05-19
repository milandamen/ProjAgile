<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface ISidebarRepository extends IBaseRepository
	{
		public function getByPage($pageNr);
		public function deleteAllFromPage($pageNr);
	}