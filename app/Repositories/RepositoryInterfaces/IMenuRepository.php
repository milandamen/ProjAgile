<?php
    namespace App\Repositories\RepositoryInterfaces;

    interface IMenuRepository extends IBaseRepository
    {
        public function getAllPublic();
    }