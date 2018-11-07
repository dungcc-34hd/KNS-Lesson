<?php


namespace App\Repositories\LsClass;


use App\Repository\RepositoryInterface;

interface LsClassRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}