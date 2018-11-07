<?php


namespace App\Repositories\Area;


use App\Repository\RepositoryInterface;

interface AreaRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}