<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IHouseNumberRepository extends IBaseRepository
	{
        public function getByHouseNumberSuffix($houseNumber, $suffix);
	}