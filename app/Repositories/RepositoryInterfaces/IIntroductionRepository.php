<?php
    namespace App\Repositories\RepositoryInterfaces;

    interface IIntroductionRepository extends IBaseRepository
    {
        public function getPageBar($pageId);
    }