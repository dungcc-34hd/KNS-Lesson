<?php


namespace App\Repositories\School;


use App\Repository\RepositoryInterface;

interface SchoolRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}