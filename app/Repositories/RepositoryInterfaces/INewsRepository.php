<?php
    namespace App\Repositories\RepositoryInterfaces;

    interface INewsRepository extends IBaseRepository
    {
        public function getByTitle($term);
    }