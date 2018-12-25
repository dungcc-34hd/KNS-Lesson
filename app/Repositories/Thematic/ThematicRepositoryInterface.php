<?php


namespace App\Repositories\Thematic;


use App\Repository\RepositoryInterface;

interface ThematicRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}