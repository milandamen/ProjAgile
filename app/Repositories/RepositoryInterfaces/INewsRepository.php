<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface INewsRepository extends IBaseRepository
	{
		public function getByTitle($term);
		public function getLastWeek();
		public function oldNews();
		public function getAllHidden();
		public function search($query, $user);
	}