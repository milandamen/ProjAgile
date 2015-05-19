<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IPageRepository extends IBaseRepository
	{
		public function getAllLikeTerm($term);
	}