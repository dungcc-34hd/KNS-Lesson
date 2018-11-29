<?php


namespace App\Repositories\Province;


use App\Repository\RepositoryInterface;

interface ProvincialRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}