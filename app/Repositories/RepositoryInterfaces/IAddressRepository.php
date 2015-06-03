<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IAddressRepository extends IBaseRepository
	{
		public function getByPostalHouseNumber($postalId, $houseNumberId);	
		public function getByDistrictPostalAndHouseNumber($districtId, $postalId, $houseNumberId);
	}