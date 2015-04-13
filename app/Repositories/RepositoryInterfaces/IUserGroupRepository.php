<?php
    namespace App\Repositories\RepositoryInterfaces;

    interface IUserGroupRepository extends IBaseRepository
    {
    	public function getAdministratorUserGroup();
    	public function getContentAdministratorUserGroup();
    	public function getInhabitantUserGroup();
    }