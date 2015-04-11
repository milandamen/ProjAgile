<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IBaseRepository
	{
		public function get($id);
		public function getAll();
		public function create($attributes);
		public function update($model);
		public function destroy($id);
	}