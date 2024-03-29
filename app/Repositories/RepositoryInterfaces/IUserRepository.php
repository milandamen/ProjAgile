<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IUserRepository extends IBaseRepository
	{
		public function getAllByUserGroup($userGroupId);
		public function filterAllByUserGroup($userGroupId, $criteria);
		public function getAllByDistrictSection($districtSectionId);
		public function getByUsername($username);
		public function getByAddress($addressId, $userId);
		public function getByConfirmationToken($confirmation_Token);
		public function isUserAdministrator($user);
		public function isUserContentAdministrator($user);
	}