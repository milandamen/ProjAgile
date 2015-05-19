<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IPanelRepository extends IBaseRepository
	{
		 public function getBySize($size);
	}