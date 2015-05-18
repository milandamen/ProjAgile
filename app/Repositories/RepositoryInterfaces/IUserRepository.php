<?php
	namespace App\Repositories\RepositoryInterfaces;

	interface IUserRepository extends IBaseRepository
	{
		public function isUserAdministrator($user);
		public function isUserContentAdministrator($user);
		public function getAllByUserGroup($userGroupId);
		public function filterAllByUserGroup($userGroupId, $criteria);
	}