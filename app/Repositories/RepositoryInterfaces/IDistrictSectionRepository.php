<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IDistrictSectionRepository extends IBaseRepository
	{
		public function getByName($name);
		public function getAllToList();
		public function getAllIds();
	}