<?php


namespace App\Repositories\ManagerArea;


use App\Repository\RepositoryInterface;

interface ManagerAreaRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}