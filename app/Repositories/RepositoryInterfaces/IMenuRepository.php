<?php
    namespace App\Repositories\RepositoryInterfaces;

    interface IMenuRepository extends IBaseRepository
    {
        public function getAllPublic();
        public function getMenu();
        public function updateMenuItemOrder($id, $order, $parent);
    }