<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IPermissionRepository extends IBaseRepository
	{
		public function getAllIds();
	}