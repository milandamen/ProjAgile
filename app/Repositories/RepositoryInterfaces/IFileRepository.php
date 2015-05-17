<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IFileRepository extends IBaseRepository
	{
		public function getAllByNewsId($newsId);
		public function deleteAllByNewsId($newsId);
	}