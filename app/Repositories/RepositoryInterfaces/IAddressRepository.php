<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IAddressRepository extends IBaseRepository
	{
		public function getByPostalHouseNumber($postal, $houseNumber);	
	}