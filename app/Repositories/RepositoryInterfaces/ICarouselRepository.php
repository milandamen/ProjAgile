<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface ICarouselRepository extends IBaseRepository
	{
		public function deleteAll();
		public function getAllFiltered();
	}