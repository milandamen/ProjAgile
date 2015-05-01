<?php
namespace App\Repositories\RepositoryInterfaces;

interface INewOnSiteRepository extends IBaseRepository
{
    public function getAllOrdered();
}