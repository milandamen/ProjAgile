<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IPostalRepository extends IBaseRepository
	{
		public function getByCode($code);
	}