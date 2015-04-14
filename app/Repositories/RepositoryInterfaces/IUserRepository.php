<?php
    namespace App\Repositories\RepositoryInterfaces;

    interface IUserRepository extends IBaseRepository
    {
		public function isUserAdministrator($user);
		public function isUserContentAdministrator($user);
    }