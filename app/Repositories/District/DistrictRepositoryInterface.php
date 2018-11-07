<?php


namespace App\Repositories\District;


use App\Repository\RepositoryInterface;

interface DistrictRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}