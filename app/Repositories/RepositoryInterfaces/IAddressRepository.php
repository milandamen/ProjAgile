<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IAddressRepository extends IBaseRepository
	{
		public function getByDistrictPostalAndHouseNumber($districtId, $postalId, $houseNumberId);
	}