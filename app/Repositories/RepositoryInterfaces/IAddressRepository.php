<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IAddressRepository extends IBaseRepository
	{
		public function getByDistrictSectionId($districtSectionId);
		public function getByPostalHouseNumber($postalId, $houseNumberId);	
		public function getByDistrictPostalAndHouseNumber($districtId, $postalId, $houseNumberId);
		public function getAllByDistrictSection($districtSectionId);
	}