<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IPageRepository extends IBaseRepository
	{
		public function getAllLikeTerm($term);
		public function getAllToList();
		public function getAllChildren($id);
		public function getAllIds();
		public function search($query);
	}